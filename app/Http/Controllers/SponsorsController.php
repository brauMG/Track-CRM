<?php

namespace App\Http\Controllers;

use App\Compania;
use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\Models\Companies;
use App\Models\Inventory;
use App\Models\Sponsors;
use App\Models\SponsorsCompanies;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class SponsorsController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        if (Auth::user()->is_super_admin == true) {
            $keyword = $request->get('search');
            $perPage = 25;

            if (!empty($keyword)) {
                $sponsors = Sponsors::latest()->paginate($perPage);
            } else {
                $sponsors = Sponsors::latest()->paginate($perPage);
            }

            return view('pages.sponsors.index', compact('sponsors'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        if (Auth::user()->is_super_admin == true)
        {
            $companies = Companies::all();
            return view('pages.sponsors.create', compact('companies'));
        }
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
        if (Auth::user()->is_super_admin == true) {

            $companies = $request->input('companies');
            $request->validate([
                'name' => ['required', 'string'],
                'description' => ['required', 'string', 'max:5000'],
                'link' => ['required', 'string', 'regex:/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/'],
                'image' => ['image','mimes:jpeg,png,jpg,gif','required'],
            ]);

            checkDirectory("sponsors");

            $requestData['name'] = $request->name;

            $requestData['link'] = $request->link;

            $requestData['show'] = $request->show;

            $requestData['description'] = $request->description;

            $requestData['image'] = uploadFile($request, 'image', public_path('uploads/sponsors'));

            $addSponsors = Sponsors::create($requestData);

            foreach ($companies as $company) {
                $addSponsors->companies()->attach($company);
            }

            return redirect('admin/sponsors')->with('flash_message', 'Patrocinador agregado');
        }
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
        if (Auth::user()->is_super_admin == true)
        {
            $sponsor = Sponsors::findOrFail($id);

            $companies = Companies::join('sponsors_companies', 'sponsors_companies.companyId', 'companies.id')
                ->where('sponsors_companies.sponsorId', $id)
                ->get()->toArray();

            return view('pages.sponsors.show', compact('sponsor', 'companies'));
        }
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
        if (Auth::user()->is_super_admin == true) {

            $sponsor = Sponsors::where('sponsorId', $id)->firstOrFail();
            $companies = Companies::all();
            $sponsors_companies = Companies::join('sponsors_companies', 'sponsors_companies.companyId', 'companies.id')
                ->where('sponsors_companies.sponsorId', $id)
                ->get();

            $valid = false;
            $array_companies = array();
            foreach ($companies as $company) {
                foreach ($sponsors_companies as $SC) {
                    if ($company->id == $SC->companyId) {
                        $valid = true;
                    }
                }
                $array_companies[] = array('valid' => $valid, 'name' => $company->name, 'id' => $company->id);
                $valid = false;
            }

            return view('pages.sponsors.edit', compact('sponsor', 'array_companies', 'sponsor'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $sponsorId)
    {

        $companies = $request->input('companies');
        $show = $request->input('show');

        $image_name = $request->hidden_image;
        $image = $request->file('image');

        if ($request->hasFile('image')) {
            $request->validate([
                'name' => ['string'],
                'description' => ['string', 'max:5000'],
                'link' => ['string', 'regex:/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/'],
                'image' => ['image', 'mimes:png'],
            ]);
            checkDirectory("sponsors");
            $imageName = Sponsors::where('sponsorId', $sponsorId)->get();
            $imageName = $imageName[0]['image'];
            File::delete('uploads/sponsors/'.$imageName);
            $requestData['image'] = uploadFile($request, 'image', public_path('uploads/sponsors'));
        }

        $requestData['name'] = $request->name;

        $requestData['link'] = $request->link;

        $requestData['show'] = $request->show;

        $requestData['description'] = $request->description;

        $addSponsors = Sponsors::where('sponsorId', $sponsorId)->update($requestData);

        SponsorsCompanies::where('sponsorId', $sponsorId)->delete();

        foreach ($companies as $company) {
            SponsorsCompanies::insert([
                'sponsorId' => $sponsorId,
                'companyId' => $company
            ]);
        }

        return redirect('admin/sponsors')->with('flash_message', 'Patrocinador actualizado');
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
        Sponsors::where('sponsorId', $id)->delete();

        return redirect('admin/sponsors')->with('flash_message', 'Patrocinador eliminado');
    }
}
