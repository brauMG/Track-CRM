<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\Models\Companies;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CompaniesController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    public function index(Request $request)
    {
        if (Auth::user()->is_super_admin == 1) {
            $keyword = $request->get('search');
            $perPage = 25;

            if (!empty($keyword)) {
                $query = Companies::where('id', '!=', 1)->where('name', 'like', "%$keyword%")->orWhere('email', 'like', "%$keyword%")->get();
            } else {
                $query = Companies::latest()->where('id', '!=', 1);
            }

            $companies = $query->paginate($perPage);

            return view('pages.companies.index', compact('companies'));
        }
        else {
            return view('pages.forbidden.forbidden_area');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('pages.companies.create');
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
            'email' => 'required|email'
        ]);

        $requestData = $request->all();

        Companies::create($requestData);

        return redirect('admin/companies')->with('flash_message', 'Compañia agregada, asegurate de asignarle un departamento en tawk.to');
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
        $company = Companies::findOrFail($id);

        $perPage = 25;

        $admins = User::where('company_id', $id)
            ->where('is_admin', 1)
            ->latest()
            ->paginate($perPage);

        $users = User::where('company_id', $id)
            ->where('is_admin', 0)
            ->latest()
            ->paginate($perPage);


        return view('pages.companies.show', compact('company', 'users', 'admins'));
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
        $company = Companies::findOrFail($id);

        return view('pages.companies.edit', compact('company'));
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
            'email' => 'required|email'
        ]);

        $requestData = $request->all();

        $company = Companies::findOrFail($id);

        $is_active = $request['is_active'];

        if ($company->id == 1) {
            $requestData['is_active'] = 1;
        }
        else {
            if ($is_active == null) {
                $requestData['is_active'] = 0;
                $users = User::where('company_id', $id)->update(['is_active' => 0]);
            }
            if ($is_active == 1) {
                $requestData['is_active'] = 1;
                User::where('company_id', $id)->update(['is_active' => 1]);
            }
            $company->update($requestData);

            if ($company->id == 1) {
                return redirect('admin/companies')->with('flash_message', 'Datos actualizados, excepto el estado, no puedes banear esta compañia');
            } else {
                return redirect('admin/companies')->with('flash_message', 'Compañia actualizada');
            }
        }
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
        if ($id != 1) {
            Companies::destroy($id);

            return redirect('admin/companies')->with('flash_message', 'Compañia eliminada!');
        }
        else {
            return back()->with('flash_message', 'No puedes eliminar esta compañia');
        }
    }
}
