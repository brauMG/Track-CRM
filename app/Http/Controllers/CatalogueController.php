<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Models\Companies;
use App\Models\Inventory;
use Carbon\Carbon;
use Barryvdh\Snappy\Facades\SnappyPdf as PDF;
use App\Models\Catalogue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CatalogueController extends Controller
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
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $catalogue = Catalogue::latest()->where('company_id', Auth::user()->company_id)->paginate($perPage);
        } else {
            $catalogue = Catalogue::latest()->where('company_id', Auth::user()->company_id)->paginate($perPage);
        }

        return view('pages.catalogue.index', compact('catalogue'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $items = Inventory::where('company_id', Auth::user()->company_id)->where('stock', '>', '0')->get();

        if (count($items) == 0) {
            return redirect('admin/catalogue')->with('flash_message', 'No hay articulos');
        }

        return view('pages.catalogue.create', compact('items'));
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
        $company = Companies::find(Auth::user()->company_id);

        $this->validate($request, [
            'name' => 'required',
            'description' => 'required',
            'items' => 'required'
        ]);

        $items = $request->items;

        $items = Inventory::whereIn('id', $items)->get();

        $company_id = Auth::user()->company_id;
        $name = $request->name;
        $datetime = Carbon::now();
        $date = $datetime->toDateString();
        $time = $datetime->toTimeString();
        $datetime = $date.$time;
        $datetime = str_replace(array('-',':'), '', $datetime);
        $fileName = $name.'-'.$datetime.'-'.$company_id.'.pdf';

        //requesting field names for the database
        $requestData['name'] = $request->name;
        $requestData['description'] = $request->description;
        $requestData['file'] = $fileName;
        $requestData['company_id'] = Auth::user()->company_id;

        //generating and saving the pdf in the server
        $pdf = PDF::loadView('pdf.catalogue', compact('items', 'company'));
        $pdf->setOption('encoding', 'UTF-8');
        $pdf->setOption('images', true);
        $pdf->setOption('margin-top', 2);
        $pdf->setOption('margin-bottom', 2);
        $pdf->setOption('margin-left', 2);
        $pdf->setOption('margin-right', 2);

        checkDirectory("catalogue");

        $catalogue = $pdf->output($fileName);

        $path = public_path('/uploads/catalogue/'.$fileName);

        file_put_contents($path, $catalogue);

        Catalogue::create($requestData);

        return redirect('admin/catalogue')->with('flash_message', 'Catalogo añadido');
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
        Catalogue::destroy($id);

        return redirect('admin/catalogue')->with('flash_message', 'Catalogo eliminado');
    }
}
