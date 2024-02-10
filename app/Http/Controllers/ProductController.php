<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index_product()
    {
        if(request()->ajax()) {
            return datatables()->of(Product::select('*'))
            ->addColumn('action', 'action')
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
        }

        return view('index-product');
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function store_product(Request $request)
    {
        $request->all();

        Product::create([
            'name' => $request->name,
            'color' => $request->color,
            'number' => $request->number,
        ]);

        return redirect()->back();

    }

    public function getData($id) {
        $product = Product::find($id);
        return response()->json($product);
    }

    public function updateData(Request $request)
    {

        $product = Product::findOrFail($request->id);
        $product->update([
            'name' => $request->name,
            'color' => $request->color,
            'number' => $request->number,
        ]);
        return response()->json(['success' => true]);
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function destroy_product(Request $request)
    {
        $product = Product::where('id', $request->id)->delete();

        return Response()->json($product);
    }
}