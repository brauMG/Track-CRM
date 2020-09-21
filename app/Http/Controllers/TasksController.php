<?php

namespace App\Http\Controllers;

use App\Helpers\MailerFactory;
use App\Models\Contact;
use App\Models\ContactStatus;
use App\Models\Document;
use App\Models\Task;
use App\Models\TaskDocument;
use App\Models\TaskStatus;
use App\Models\TaskType;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use DomPDF;


class TasksController extends Controller
{

    protected $mailer;

    public function __construct(MailerFactory $mailer)
    {
        $this->middleware('admin:index-list_tasks|create-create_task|show-view_task|edit-edit_task|destroy-delete_task|getAssignTask-assign_task|getUpdateStatus-update_task_status', ['except' => ['store', 'update', 'postAssignTask', 'postUpdateStatus']]);

        $this->mailer = $mailer;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $query = Task::where('name', 'like', "%$keyword%");
        } else {
            $query = Task::latest();
        }

        if(\request('assigned_user_id') != null) {
            $query->where('assigned_user_id', \request('assigned_user_id'));
        }

        // if not admin user show tasks if assigned to or created by that user
        if(Auth::user()->is_admin == 0) {

            $query->where(function ($query) {
                $query->where('assigned_user_id', Auth::user()->id)
                    ->orWhere('created_by_id', Auth::user()->id);
            });

        }

        $tasks = $query->paginate($perPage);

        return view('pages.tasks.index', compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $data = $this->getFormData();

        list($users, $statuses, $task_types, $contact_statuses, $documents) = $data;

        return view('pages.tasks.create', compact('users', 'documents', 'statuses', 'task_types', 'contact_statuses'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $this->do_validate($request);

        $requestData = $request->all();

        if(isset($requestData['documents'])) {

            $documents = $requestData['documents'];

            unset($requestData['documents']);

            $documents = array_filter($documents, function ($value) {
                return !empty($value);
            });
        }

        $requestData['created_by_id'] = Auth::user()->id;

        if ($requestData['status'] == 3) {
            $requestData['complete_date'] = Carbon::now()->setTimezone('America/Los_Angeles');
            $task = Task::create($requestData);
        }
        else {
            $requestData['complete_date'] = '';
            $task = Task::create($requestData);
        }

        // insert documents
        if($task && $task->id) {

            if(isset($documents)) {

                $this->insertDocuments($documents, $task->id);
            }
        }


        // send notifications email
        if(getSetting("enable_email_notification") == 1 && isset($requestData['assigned_user_id'])) {

            $this->mailer->sendAssignTaskEmail("Task assigned to you", User::find($requestData['assigned_user_id']), $task);
        }

        return redirect('admin/tasks')->with('flash_message', 'Tarea añadida');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $task = Task::findOrFail($id);

        return view('pages.tasks.show', compact('task'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $data = $this->getFormData($id);

        list($users, $statuses, $task_types, $contact_statuses, $documents, $task, $selected_documents) = $data;

        return view('pages.tasks.edit', compact('task', 'users', 'documents', 'statuses', 'task_types', 'selected_documents', 'contact_statuses'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        $this->do_validate($request);

        $requestData = $request->all();

        if(isset($requestData['documents'])) {

            $documents = $requestData['documents'];

            unset($requestData['documents']);

            $documents = array_filter($documents, function ($value) {
                return !empty($value);
            });
        }

        if(empty($requestData['contact_type'])) {

            $requestData['contact_id'] = null;
        }

        $requestData['modified_by_id'] = Auth::user()->id;

        $task = Task::findOrFail($id);

        $old_assign_user_id = $task->assigned_user_id;

        $old_task_status = $task->status;

        if ($task->status == 3) {
            $requestData['complete_date'] = Carbon::now()->setTimezone('America/Los_Angeles');
            $task->update($requestData);
        }
        else {
            $requestData['complete_date'] = '';
            $task->update($requestData);
        }


        // delete documents if exist
        TaskDocument::where('task_id', $id)->delete();

        // insert documents
        if(isset($documents)) {

            $this->insertDocuments($documents, $id);
        }


        // send notifications emails

        if(getSetting("enable_email_notification") == 1) {

            if (isset($requestData['assigned_user_id']) && $old_assign_user_id != $requestData['assigned_user_id']) {

                $this->mailer->sendAssignTaskEmail("Task assigned to you", User::find($requestData['assigned_user_id']), $task);
            }

            // if status get update then send a notification to both the super admin and the assigned user
            if($old_task_status != $requestData['status']) {

                $super_admin = User::where('is_admin', 1)->first();

                if($super_admin->id == $task->assigned_user_id) {
                    $this->mailer->sendUpdateTaskStatusEmail("Task status update", User::find($task->assigned_user_id), $task);
                } else {
                    $this->mailer->sendUpdateTaskStatusEmail("Task status update", User::find($task->assigned_user_id), $task);

                    $this->mailer->sendUpdateTaskStatusEmail("Task status update", $super_admin, $task);
                }

            }
        }

        return redirect('admin/tasks')->with('flash_message', 'Trea actualizada');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        $task = Task::find($id);

        Task::destroy($id);

        if(getSetting("enable_email_notification") == 1) {
            $this->mailer->sendDeleteTaskEmail("Task deleted", User::find($task->assigned_user_id), $task);
        }

        return redirect('admin/tasks')->with('flash_message', 'Tarea eliminada');
    }


    public function getAssignTask($id)
    {
        $task = Task::find($id);

        $users = User::where('id', '!=', $task->assigned_user_id)->get();

        return view('pages.tasks.assign', compact('users', 'task'));
    }


    public function postAssignTask(Request $request, $id)
    {
        $this->validate($request, [
            'assigned_user_id' => 'required'
        ]);

        $task = Task::find($id);

        $task->update(['assigned_user_id' => $request->assigned_user_id]);

        if(getSetting("enable_email_notification") == 1) {
            $this->mailer->sendAssignTaskEmail("Task assigned to you", User::find($request->assigned_user_id), $task);
        }

        return redirect('admin/tasks')->with('flash_message', 'Tarea asignada');
    }


    public function getUpdateStatus($id)
    {
        $task = Task::find($id);

        $statuses = TaskStatus::all();

        return view('pages.tasks.update_status', compact('task', 'statuses'));
    }

    public function postUpdateStatus(Request $request, $id)
    {
        $this->validate($request, [
            'status' => 'required'
        ]);

        $task = Task::find($id);

        if ($request->status == 3) {
            $task->update([
                'status' => $request->status,
                'complete_date' => Carbon::now()->setTimezone('America/Los_Angeles')
            ]);
        }
        else {
            $task->update([
                'status' => $request->status,
                'complete_date' => null
            ]);
        }


        if(getSetting("enable_email_notification") == 1 && !empty($task->assigned_user_id)) {

            $super_admin = User::where('is_admin', 1)->first();

            if($super_admin->id == $task->assigned_user_id) {

                $this->mailer->sendUpdateTaskStatusEmail("Task status update", User::find($task->assigned_user_id), $task);
            } else {
                $this->mailer->sendUpdateTaskStatusEmail("Task status update", User::find($task->assigned_user_id), $task);

                $this->mailer->sendUpdateTaskStatusEmail("Task status update", $super_admin, $task);
            }
        }

        return redirect('admin/tasks')->with('flash_message', 'Estado de la tarea actualizado');
    }


    /**
     * insert documents
     *
     *
     * @param $documents
     * @param $task_id
     */
    protected function insertDocuments($documents, $task_id)
    {
        foreach ($documents as $document) {

            $taskDocument = new TaskDocument();

            $taskDocument->document_id = $document;

            $taskDocument->task_id = $task_id;

            $taskDocument->save();
        }
    }


    /**
     * do_validate
     *
     *
     * @param $request
     */
    protected function do_validate($request)
    {
        $this->validate($request, [
            'name' => 'required',
            'start_date' => 'nullable|date',
            'end_date'   => 'nullable|date|after_or_equal:start_date'
        ]);
    }


    /**
     * get form data for the tasks form
     *
     *
     *
     * @param null $id
     * @return array
     */
    protected function getFormData($id = null)
    {
        $users = User::where('is_active', 1)->get();

        $statuses = TaskStatus::all();

        $task_types = TaskType::all();

        $contact_statuses = ContactStatus::all();

        if(Auth::user()->is_admin == 1) {
            $documents = Document::where('status', 1)->get();
        } else {
            $super_admin = User::where('is_admin', 1)->first();

            $documents = Document::where('status', 1)->where(function ($query) use ($super_admin) {
                $query->where('created_by_id', Auth::user()->id)
                    ->orWhere('assigned_user_id', Auth::user()->id)
                    ->orWhere('created_by_id', $super_admin->id)
                    ->orWhere('assigned_user_id', $super_admin->id);
            })->get();
        }

        if($id == null) {

            return [$users, $statuses, $task_types, $contact_statuses, $documents];
        }

        $task = Task::findOrFail($id);

        $selected_documents = $task->documents()->pluck('document_id')->toArray();

        return [$users, $statuses, $task_types, $contact_statuses, $documents, $task, $selected_documents];
    }

    public function preparePdf(Request $request) {
        $contacts = Contact::where('company_id', Auth::user()->company_id)->get();
        $users = User::where('company_id', Auth::user()->company_id)->get();
        $status = TaskStatus::all();
        $type = TaskType::all();
        $contact_type = ContactStatus::all();
        $priority = [
            'Baja',
            'Normal',
            'Alta',
            'Urgente'
        ];
        return view('pages.prepareTasks.index', compact('contacts', 'users', 'status', 'type', 'contact_type', 'priority'));
    }

    public function exportPdf(Request $request)
    {
        $desde = $request->input('desde');
        $hasta = $request->input('hasta');
        $usuarios_asignados = $request->input('asignadas_a');
        $estados = $request->input('estados');
        $tipos = $request->input('tipos');
        $contactos = $request->input('contactos');
        $contactos_estados = $request->input('contactos_estados');
        $prioridad = $request->input('prioridad');


        $tareas = DB::table('task')
            ->join('task_status', 'task.status', '=', 'task_status.id')
            ->where(function($query) use ($estados, $request) {
                if ($estados != null) {
                    $query->whereIn('task.status', $estados);
                }
            })
            ->join('task_type', 'task.type_id', '=', 'task_type.id')
            ->where(function($query) use ($tipos, $request) {
                if ($tipos != null) {
                    $query->whereIn('task.type_id', $tipos);
                }
            })
            ->join('contact', 'task.contact_id', '=', 'contact.id')
            ->where(function($query) use ($contactos, $request) {
                if ($contactos != null) {
                    $query->whereIn('task.contact_id', $contactos);
                }
            })
            ->join('contact_status', 'task.contact_type', '=', 'contact_status.id')
            ->where(function($query) use ($contactos_estados, $request) {
                if ($contactos_estados != null) {
                    $query->whereIn('task.contact_type', $contactos_estados);
                }
            })
            ->join('users', 'task.assigned_user_id', '=', 'users.id')
            ->where(function($query) use ($usuarios_asignados, $request) {
                if ($usuarios_asignados != null) {
                    $query->whereIn('task.assigned_user_id', $usuarios_asignados);
                }
            })
            ->where(function($query) use ($desde, $request) {
                if ($desde != null) {
                    $query->whereDate('task.created_at', '>=', $desde);
                }
            })
            ->where(function($query) use ($hasta, $request) {
                if ($hasta != null) {
                    $query->whereDate('task.created_at', '<=', $hasta);
                }
            })
            ->where(function($query) use ($prioridad, $request) {
                if ($prioridad != null) {
                    $query->whereIn('task.priority', $prioridad);
                }
            })
            ->select('task.*', 'task_status.name as task_status', 'task_type.name as task_type', 'contact.*', 'contact_status.name as contact_status', 'users.name as user')
            ->get();


        $pdf = DomPDF::loadView('pdf.tasks', compact('tareas'));

        return $pdf->download('tareas.pdf');
    }
}
