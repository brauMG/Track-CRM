<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Models\Companies;
use Barryvdh\Snappy\Facades\SnappyPdf as PDF;
//use DomPDF;
use App\Models\Contact;
use App\Models\Inventory;
use App\Models\Quotation;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class QuotationController extends Controller
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

        if (Auth::user()->is_admin) {
            if (!empty($keyword)) {
                $quotation = DB::table('quotation')
                    ->latest()
                    ->leftJoin('contact', 'quotation.contact_id', 'contact.id')
                    ->leftJoin('users', 'quotation.created_by_id', 'users.id')
                    ->where('company_id', Auth::user()->company_id)
                    ->select('quotation.*', 'contact.first_name as name', 'contact.middle_name as middle_name', 'contact.last_name as last_name', 'users.name as user')
                    ->paginate($perPage);
            } else {
                $quotation = DB::table('quotation')
                    ->latest()
                    ->leftJoin('contact', 'quotation.contact_id', 'contact.id')
                    ->leftJoin('users', 'quotation.created_by_id', 'users.id')
                    ->where('quotation.company_id', Auth::user()->company_id)
                    ->select('quotation.*', 'contact.first_name as name', 'contact.middle_name as middle_name', 'contact.last_name as last_name', 'users.name as user')
                    ->paginate($perPage);
            }
        }
        else {
            if (!empty($keyword)) {
                $quotation = DB::table('quotation')
                    ->latest()
                    ->leftJoin('contact', 'quotation.contact_id', 'contact.id')
                    ->leftJoin('users', 'quotation.created_by_id', 'users.id')
                    ->where('quotation.created_by_id', Auth::user()->id)
                    ->select('quotation.*', 'contact.first_name as name', 'contact.middle_name as middle_name', 'contact.last_name as last_name', 'users.name as user')
                    ->paginate($perPage);
            } else {
                $quotation = DB::table('quotation')
                    ->latest()
                    ->leftJoin('contact', 'quotation.contact_id', 'contact.id')
                    ->leftJoin('users', 'quotation.created_by_id', 'users.id')
                    ->where('quotation.created_by_id', Auth::user()->id)
                    ->select('quotation.*', 'contact.first_name as name', 'contact.middle_name as middle_name', 'contact.last_name as last_name', 'users.name as user')
                    ->paginate($perPage);
            }
        }

        return view('pages.quotation.index', compact('quotation'));
    }

    public function test() {
        return view('pdf.test_quotation');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        if (Auth::user()->is_admin) {
            $contacts = Contact::where('company_id', Auth::user()->company_id)->get();
            $items = Inventory::where('company_id', Auth::user()->company_id)->where('stock', '>', '0')->get();
        }
        else {
            $contacts = Contact::where('assigned_user_id', Auth::user()->id)->get();
            $items = Inventory::where('company_id', Auth::user()->company_id)->where('stock', '>', '0')->get();
        }

        return view('pages.quotation.create', compact('contacts', 'items'));
    }

    public function fill(Request $request){
        $this->validate($request, [
            'name' => 'required',
            'description' => 'required',
            'contact_id' => 'required',
            'items' => 'required'
        ]);
        $items_ids = $request->items;
        $items = Inventory::whereIn('id',$items_ids)->get();
        $name = $request->name;
        $description = $request->description;
        $contact_id = $request->contact_id;

        return view('pages.quotation.fill', compact('items', 'name', 'description', 'contact_id'));
    }

    public function storeFill(Request $request)
    {
        $company = Companies::find(Auth::user()->company_id);

        $items = $request->items;

        $quantities = $request->quantities;

        $items_data[] = array();

        $i = 0;

        foreach ($items as $item) {
                $items_data[$item] = $quantities[$i];
            $i++;
        }

        $items_data = array_filter($items_data);

        $items = DB::table('inventory')
            ->whereIn('id', array_keys($items_data))
            ->get();

        $items_quotation[] = array();

        $precio_total = 0;

        foreach ($items as $item) {
            foreach (array_keys($items_data) as $data) {
                if ($item->id == $data) {
                    $items_quotation[] = [
                        'id' => $item->id,
                        'name' => $item->name,
                        'quantity' => $items_data[$data],
                        'individual_price' => $item->price,
                        'total_price' => $item->price * $items_data[$data]
                    ];
                    $precio_total = $precio_total + ($item->price * $items_data[$data]);
                }
            }
        }

        $items_quotation = array_filter($items_quotation);

        $company_id = Auth::user()->company_id;
        $name = $request->name;
        $datetime = Carbon::now();
        $date = $datetime->toDateString();
        $time = $datetime->toTimeString();
        $datetime = $date . $time;
        $datetime = str_replace(array('-', ':'), '', $datetime);
        $fileName = $name . '-' . $datetime . '-' . $company_id . '.pdf';

        //requesting field names for the database
        $requestData['name'] = $request->name;
        $requestData['description'] = $request->description;
        $requestData['file'] = $fileName;
        $requestData['company_id'] = Auth::user()->company_id;
        $requestData['contact_id'] = $request->contact_id;
        $requestData['created_by_id'] = Auth::user()->id;

        $name = Contact::find($request->contact_id);
        $name = $name->first_name.' '.$name->middle_name.' '.$name->last_name;

        //generating and saving the pdf in the server
        $pdf = PDF::loadView('pdf.quotation', compact('items_quotation', 'precio_total', 'name', 'company'));
        $pdf->setOption('encoding', 'UTF-8');


        checkDirectory("quotation");

        $path = public_path('/uploads/quotation/' . $fileName);

        $output = $pdf->output();

        file_put_contents($path, $output);

        Quotation::create($requestData);

//        echo $pdf->output();

        return redirect('admin/quotation')->with('flash_message', 'Cotización añadida!');
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
        $quotation = Quotation::findOrFail($id);

        return view('pages.quotation.show', compact('quotation'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        Quotation::destroy($id);

        return redirect('admin/quotation')->with('flash_message', 'Cotización eliminada!');
    }
}
