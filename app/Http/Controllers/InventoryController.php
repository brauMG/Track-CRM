<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use Illuminate\Support\Facades\File;
use App\Models\Inventory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InventoryController extends Controller
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
            $inventory = Inventory::latest()->where('company_id', Auth::user()->company_id)->paginate($perPage);
        } else {
            $inventory = Inventory::latest()->where('company_id', Auth::user()->company_id)->paginate($perPage);
        }

        return view('pages.inventory.index', compact('inventory'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('pages.inventory.create');
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
            'description' => 'required',
            'stock' => 'required|numeric',
            'price' => 'required|numeric',
            'image' => 'image|mimes:jpeg,png,jpg,gif|required'
        ]);

        checkDirectory("inventory");

        $requestData['name'] = $request->name;

        $requestData['stock'] = $request->stock;

        $requestData['price'] = $request->price;

        $requestData['description'] = $request->description;

        $requestData['image'] = uploadFile($request, 'image', public_path('uploads/inventory'));

        $requestData['company_id'] = Auth::user()->company_id;

        Inventory::create($requestData);

        return redirect('admin/inventory')->with('flash_message', 'Artículo añadido');
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
        $inventory = Inventory::findOrFail($id);

        return view('pages.inventory.show', compact('inventory'));
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
        $inventory = Inventory::findOrFail($id);

        return view('pages.inventory.edit', compact('inventory'));
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
            'description' => 'required',
            'stock' => 'required|numeric',
            'price' => 'required|numeric',
            'image' => 'image|mimes:jpeg,png,jpg,gif'
        ]);

        if ($request->hasFile('image')) {
            checkDirectory("inventory");
            $imageName = Inventory::where('id', $id)->get();
            $imageName = $imageName[0]['image'];
            File::delete('uploads/inventory/'.$imageName);
            $requestData['image'] = uploadFile($request, 'image', public_path('uploads/inventory'));
        }

        $inventory = Inventory::findOrFail($id);

        $requestData['name'] = $request->name;

        $requestData['stock'] = $request->stock;

        $requestData['price'] = $request->price;

        $requestData['description'] = $request->description;

        $requestData['company_id'] = Auth::user()->company_id;

        $inventory = Inventory::findOrFail($id);

        $inventory->update($requestData);

        return redirect('admin/inventory')->with('flash_message', 'Artículo actualizado');
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
        Inventory::destroy($id);

        return redirect('admin/inventory')->with('flash_message', 'Artículo eliminado');
    }
}
