<?php

namespace App\Http\Controllers;

use App\Helpers\MailerFactory;
use App\Http\Requests;

use App\Models\Companies;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class AdminsController extends Controller
{
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
            $users = DB::table('users')
                ->leftJoin('companies', 'users.company_id', 'companies.id')
                ->where('users.name', 'like', "%$keyword%")
                ->where('users.is_admin', 1)
                ->orWhere('users.email', 'like', "%$keyword%")
                ->where('users.is_admin', 1)
                ->orWhere('companies.name', 'like', "%$keyword%")
                ->where('users.is_admin', 1)
                ->select('users.*', 'companies.name as company')
                ->where('users.is_admin', 1)
                ->paginate($perPage);
        } else {
            $users = DB::table('users')
                ->leftJoin('companies', 'users.company_id', 'companies.id')
                ->where('users.is_admin', 1)
                ->select('users.*', 'companies.name as company')
                ->latest()
                ->paginate($perPage);
        }

        return view('pages.admins.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $companies = Companies::all();

        return view('pages.admins.create', compact('companies'));
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
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif',
            'company_id' => 'required'
        ]);

        $requestData = $request->except(['is_profile', '_token']);

        $requestData['password'] = bcrypt($requestData['password']);

        $requestData['is_active'] = isset($requestData['is_active'])?1:0;

        if ($request->hasFile('image')) {

            checkDirectory("users");

            $requestData['image'] = uploadFile($request, 'image', public_path('uploads/users'));
        }

        if(($count = User::all()->count()) && $count == 0) {

            $requestData['is_admin'] = 1;
        }

        $requestData['is_admin'] = 1;

        User::create($requestData);

        return redirect('admin/admins')->with('flash_message', 'Usuario añadido');
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
        $user = DB::table('users')
            ->leftJoin('companies', 'users.company_id', 'companies.id')
            ->where('users.id', $id)
            ->select('users.*', 'companies.name as company')
            ->get();

        $user = $user[0];

        return view('pages.admins.show', compact('user'));
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
        $user = User::findOrFail($id);

        $companies = Companies::all();

        return view('pages.admins.edit', compact('user', 'companies'));
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
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'image' => 'image|mimes:jpeg,png,jpg,gif',
        ]);

        $requestData = $request->except(['_token']);

        if ($request->hasFile('image')) {
            checkDirectory("users");
            $requestData['image'] = uploadFile($request, 'image', public_path('uploads/users'));
        }

        $user = User::findOrFail($id);

        $old_is_active = $user->is_active;

        if ($user->company_id == 1) {
            $requestData['is_active'] = 1;
        }
        else {
            $requestData['is_active'] = isset($requestData['is_active']) ? 1 : 0;
        }

        $user->update($requestData);


        // send notification email
        if($user->is_admin == 0 && getSetting("enable_email_notification") == 1 && $requestData['is_active'] != $old_is_active) {

            if($requestData['is_active'] == 1) {
                $subject = "Tu cuenta en CRM Track ha sido activada";
            } else {
                $subject = "Tu cuenta en CRM Track ha sido desactivada";
            }

            $this->mailer->sendActivateBannedEmail($subject, $user);
        }

        return redirect('admin/admins')->with('flash_message', 'Usuario actualizado');
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
        User::destroy($id);

        return redirect('admin/admins')->with('flash_message', 'Usuario eliminado');
    }
}
