<?php

namespace App\Http\Controllers;

use App\Actividad;
use App\Helpers\MailerFactory;
use App\Imports\ContactsImport;
use App\Models\Campaigns;
use App\Models\Contact;
use App\Models\ContactDocument;
use App\Models\ContactEmail;
use App\Models\ContactPhone;
use App\Models\ContactStatus;
use App\Models\Document;
use App\User;
use DomPDF;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class ContactsController extends Controller
{

    protected $mailer;

    public function __construct(MailerFactory $mailer)
    {
        $this->middleware(['auth', 'verified']);

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
            $query = Contact::where('first_name', 'like', "%$keyword%")
                ->where('company_id', Auth::user()->company_id)
                ->orWhere('middle_name', 'like', "%$keyword%")->where('company_id', Auth::user()->company_id)->orWhere('last_name', 'like', "%$keyword%")->where('contact.company_id', Auth::user()->company_id);
        } else {
            $query = Contact::latest()->where('company_id', Auth::user()->company_id);
        }

        if(\request('status_name') != null) {
            $query->where('status', '=', ContactStatus::where('name', \request('status_name'))->first()->id);
        }

        if(\request('assigned_user_id') != null) {
            $query->where('assigned_user_id', \request('assigned_user_id'));
        }

        if(\request('campaign_id') != null) {
            $query->where('campaign_id', \request('campaign_id'));
        }

        // if not admin user show contacts if assigned to or created by that user
        if(Auth::user()->is_admin == 0) {

            $query->where(function ($query) {
                $query->where('assigned_user_id', Auth::user()->id)
                    ->orWhere('created_by_id', Auth::user()->id);
            });

        }

        $contacts = $query->paginate($perPage);
        $today = Carbon::today();
        $campaigns = Campaigns::where('company_id', Auth::user()->company_id)->where('last_day', '>', $today)->get();

        return view('pages.contacts.index', compact('contacts', 'campaigns'));
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function create()
    {
        $data = $this->getFormData();

        list($statuses, $users, $documents) = $data;

        $today = Carbon::today();

        $campaigns = Campaigns::where('company_id', Auth::user()->company_id)->where('last_day', '>', $today)->get();

        if (count($campaigns) == 0) {
            return back()->with('danger', 'Para crear un contacto primero debes haber creado una campaña vigente');
        }

        $selected_campaign = null;

        return view('pages.contacts.create', compact('statuses', 'users', 'documents', 'campaigns', 'selected_campaign'));
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

        $email = $requestData['email'];

        $requestData['company_id'] = Auth::user()->company_id;

        $phone = $request['phone'];

        unset($requestData['email'], $requestData['phone']);

        if(isset($requestData['documents'])) {

            $documents = $requestData['documents'];

            unset($requestData['documents']);

            $documents = array_filter($documents, function ($value) {
                return !empty($value);
            });
        }

        $requestData['created_by_id'] = Auth::user()->id;
        $requestData['campaign_id'] = $request->campaign;

        $contact = Contact::create($requestData);

        $reached = Contact::where('campaign_id', $request->campaign)->get();
        $reached = count($reached);

        Campaigns::where('id', $request->campaign)->update([
            'contacts_reached' => $reached
        ]);

        if ($phone == null){
            $phone = 'sin asignar';
        }

        if ($email == null){
            $email = 'sin asignar';
        }

        // insert emails & phones
        if($contact && $contact->id) {

            $this->insertEmails($email, $contact->id);

            $this->insertPhones($phone, $contact->id);

            if(isset($documents)) {

                $this->insertDocuments($documents, $contact->id);
            }
        }

        // send notifications email
        if(getSetting("enable_email_notification") == 1 && isset($requestData['assigned_user_id'])) {

            $this->mailer->sendAssignContactEmail("Se te ha asignado un contacto", User::find($requestData['assigned_user_id']), $contact);
        }

        return redirect('admin/contacts')->with('flash_message', 'Contacto añadido');
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
        $contact = Contact::findOrFail($id);

        return view('pages.contacts.show', compact('contact'));
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

        list($statuses, $users, $documents, $contact, $selected_documents) = $data;

        $has_campaign = Contact::where('id', $id)->get()->toArray();
        $has_campaign = $has_campaign[0]['campaign_id'];

        if ($has_campaign != null) {
            $selected_campaign = $has_campaign;
        }
        else {
            $selected_campaign = null;
        }

        $today = Carbon::today();

        $campaigns = Campaigns::where('company_id', Auth::user()->company_id)->where('last_day', '>', $today)->get();

        return view('pages.contacts.edit', compact('contact', 'statuses', 'users', 'documents', 'selected_documents', 'selected_campaign', 'campaigns'));
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

        $email = $requestData['email'];

        $phone = $request['phone'];

        unset($requestData['email'], $requestData['phone']);

        if ($phone == null){
            $phone = 'sin asignar';
        }

        if ($email == null){
            $email = 'sin asignar';
        }

        if(isset($requestData['documents'])) {

            $documents = $requestData['documents'];

            unset($requestData['documents']);

            $documents = array_filter($documents, function ($value) {
                return !empty($value);
            });
        }

        $requestData['modified_by_id'] = Auth::user()->id;
        $requestData['campaign_id'] = $request->campaign;

        $contact = Contact::findOrFail($id);

        $old_assign_user_id = $contact->assigned_user_id;

        $old_contact_status = $contact->status;

        $contact->update($requestData);

        // delete emails if exist
        ContactEmail::where('contact_id', $id)->delete();

        if($email) {

            // insert
            $this->insertEmails($email, $id);
        }

        // delete phones if exist
        ContactPhone::where('contact_id', $id)->delete();

        if($phone) {

            // insert
            $this->insertPhones($phone, $id);
        }

        // delete documents if exist
        ContactDocument::where('contact_id', $id)->delete();

        if(isset($documents)) {

            // insert
            $this->insertDocuments($documents, $id);
        }

        // send notifications email
        if(getSetting("enable_email_notification") == 1) {

            if (isset($requestData['assigned_user_id']) && $old_assign_user_id != $requestData['assigned_user_id']) {

                $this->mailer->sendAssignContactEmail("Se te ha asignado un contacto", User::find($requestData['assigned_user_id']), $contact);
            }

            // send two emails about the contact update one for the assigned user and one for the super admin

            if($old_contact_status != $requestData['status']) {

                $super_admin = User::where('is_admin', 1)->first();

                if($super_admin->id == $contact->assigned_user_id) {
                    $this->mailer->sendUpdateContactEmail("Estado del contacto actualizado", User::find($contact->assigned_user_id), $contact);
                } else {
                    $this->mailer->sendUpdateContactEmail("Estado del contacto actualizado", User::find($contact->assigned_user_id), $contact);

                    $this->mailer->sendUpdateContactEmail("Estado del contacto actualizado", $super_admin, $contact);
                }
            }
        }

        return redirect('admin/contacts')->with('flash_message', 'Contacto actualizado');
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
        $contact = Contact::find($id);
        $contact_id = $contact->id;
        $contact_phone = ContactPhone::where('id', $contact_id);
        $contact_email = ContactEmail::where('id', $contact_id);
        $contact_document = ContactDocument::where('id', $contact_id);

        $contact->delete();
        $contact_phone->delete();
        $contact_email->delete();
        $contact_document->delete();

        if(getSetting("enable_email_notification") == 1) {
            $this->mailer->sendDeleteContactEmail("Contact deleted", User::find($contact->assigned_user_id), $contact);
        }

        return redirect('admin/contacts')->with('flash_message', 'Contacto eliminado');
    }


    public function getAssignContact($id)
    {
        $contact = Contact::find($id);

        $users = User::where('id', '!=', $contact->assigned_user_id)->where('company_id', Auth::user()->company_id)->get();

        return view('pages.contacts.assign', compact('users', 'contact'));
    }


    public function postAssignContact(Request $request, $id)
    {
        $this->validate($request, [
            'assigned_user_id' => 'required'
        ]);

        $contact = Contact::find($id);

        $contact->update(['assigned_user_id' => $request->assigned_user_id]);

        if(getSetting("enable_email_notification") == 1) {
            $this->mailer->sendAssignContactEmail("Se te ha asignado un contacto", User::find($request->assigned_user_id), $contact);
        }

        return redirect('admin/contacts')->with('flash_message', 'Contacto asignado');
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
            'first_name' => 'required',
            'last_name' => 'required',
            'campaign' => 'required',
            'email' => 'required|email'
        ]);
    }


    /**
     * insert emails
     *
     *
     * @param $email
     * @param $contact_id
     */
    protected function insertEmails($email, $contact_id)
    {
            $contactEmail = new ContactEmail();

            $contactEmail->email = $email;

            $contactEmail->contact_id = $contact_id;

            $contactEmail->save();
    }


    /**
     * insert phones
     *
     *
     * @param $phone
     * @param $contact_id
     */
    protected function insertPhones($phone, $contact_id)
    {

            $contactPhone = new ContactPhone();

            $contactPhone->phone = $phone;

            $contactPhone->contact_id = $contact_id;

            $contactPhone->save();
    }


    /**
     * insert documents
     *
     *
     * @param $documents
     * @param $contact_id
     */
    protected function insertDocuments($documents, $contact_id)
    {
        foreach ($documents as $document) {

            $contactDocument = new ContactDocument();

            $contactDocument->document_id = $document;

            $contactDocument->contact_id = $contact_id;

            $contactDocument->save();
        }
    }

    /**
     * get form data for the contacts form
     *
     *
     *
     * @param null $id
     * @return array
     */
    protected function getFormData($id = null)
    {
        $statuses = ContactStatus::all();

        $users = User::where('is_active', 1)->where('company_id', Auth::user()->company_id)->get();

        if(Auth::user()->is_admin == 1) {
            $documents = Document::where('status', 1)->where('company_id', Auth::user()->company_id)->get();
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

            return [$statuses, $users, $documents];
        }

        $contact = Contact::findOrFail($id);

        $selected_documents = $contact->documents()->pluck('document_id')->toArray();

        return [$statuses, $users, $documents, $contact, $selected_documents];
    }

    public function getContactsByStatus(Request $request)
    {
        if(!$request->status)
            return [];


        $contacts = Contact::where('contact.status', $request->status);


        if(Auth::user()->is_admin == 1) {

            return $contacts->get();
        }

        return $contacts->where(function ($query) {
            $query->where('assigned_user_id', Auth::user()->id)
                ->orWhere('created_by_id', Auth::user()->id);
        })->get();
    }

    public function editStatus($id) {
        $contactoEstado = Contact::where('id', $id)->get()->toArray();
        $contactoEstado = $contactoEstado[0];
        $estados= [
            1,
            2,
            3,
            4
        ];
        return view('pages.contacts.editStatus', compact('estados', 'contactoEstado'));
    }

    public function updateStatus(Request $request, $id)
    {
        $status = $request->validate([
            'status' => ['required']
        ]);

        Contact::where('id', $id)->update([
            'status' => $status['status'],
        ]);

        return back()->with('success', 'Estado actualizado correctamente');
    }

    public function import(Request $request)
    {
        $file = $request->file('file');
        $campaign_id = $request->campaign;
        $created_by_id = Auth::user()->id;
        $assigned_user_id = Auth::user()->id;
        $company_id = Auth::user()->company_id;
        Excel::import(new ContactsImport($campaign_id, $created_by_id, $assigned_user_id, $company_id), $file);
        return back()->with('flash_message', 'Importación de contactos realizada');
    }

    public function preparePdf(Request $request) {
//        $usuarios= User::where('company_id', Auth::user()->company_id)->where('is_super_admin', '!=', 1)->get();
        $usuarios= User::where('company_id', Auth::user()->company_id)->get();
        $campanias = Campaigns::where('company_id', Auth::user()->company_id)->get();
        $estados = [
            1,
            2,
            3,
            4
        ];
        return view('pages.prepareContacts.index', compact('usuarios', 'campanias', 'estados'));
    }

    public function exportPdf(Request $request)
    {
        $desde = $request->input('desde');
        $hasta = $request->input('hasta');
        $usuarios = $request->input('asignados_a');
        $campanias = $request->input('campanias');
        $estados = $request->input('estados');

        $contactos = DB::table('contact')
            ->join('contact_status', 'contact.status', '=', 'contact_status.id')
            ->where(function($query) use ($estados, $request) {
                if ($estados != null) {
                    $query->whereIn('contact.status', $estados);
                }
            })
            ->join('users', 'contact.assigned_user_id', '=', 'users.id')
            ->where(function($query) use ($usuarios, $request) {
                if ($usuarios != null) {
                    $query->whereIn('contact.assigned_user_id', $usuarios);
                }
            })
            ->join('campaigns', 'contact.campaign_id', '=', 'campaigns.id')
            ->where(function($query) use ($campanias, $request) {
                if ($campanias != null) {
                    $query->whereIn('contact.campaign_id', $campanias);
                }
            })
            ->where(function($query) use ($desde, $request) {
                if ($desde != null) {
                    $query->whereDate('contact.created_at', '>=', $desde);
                }
            })
            ->where(function($query) use ($hasta, $request) {
                if ($hasta != null) {
                    $query->whereDate('contact.created_at', '<=', $hasta);
                }
            })
            ->join('contact_email', 'contact.id', '=', 'contact_email.contact_id')
            ->join('contact_phone', 'contact.id', '=', 'contact_phone.contact_id')
            ->select('contact.*', 'campaigns.name as campaign', 'users.name as user', 'contact_email.email as contactEmail', 'contact_phone.phone as contactPhone', 'contact_status.name as contactStatus')
            ->get();


        $pdf = DomPDF::loadView('pdf.contacts', compact('contactos'));

        return $pdf->download('contactos.pdf');
    }
}
