<?php

namespace App\Http\Controllers;

use App\Models\Buyer;
use App\Models\Category;
use App\Models\Product;
use App\Models\SaleProduct;
use App\Models\Seller;
use App\Traits\TViewRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Throwable;
use Yajra\DataTables\DataTables;

class ProductController extends Controller
{
    use TViewRole;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->renderTemplate('products.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::get();

        if(Auth::user()->role_id == 1)
            return $this->renderTemplate('products.create', $categories);

        return view('products.create', ['full_name' => Auth::user()->person->pers_full_name]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $product = new Product($request->all());
            $product->status_id = 1;
            $product->save();
            DB::commit();
            return redirect()->route('products.create')->with('msg', 'Datos creados correctamente');
        } catch (Throwable $ex) {
            DB::rollBack();
            return redirect()->back()->withInput()->with('error', $ex->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }

    public function findAll()
    {
        $products = Product::get();
        return DataTables::of($products)
            ->addColumn('category', function ($product) {
                return $product->category != null ? $product->category->name : 'Sin categoria';
            })
            ->addColumn('product', function ($product) {
                return $product->name != null ? $product->name :  'Sin producto';
            })
            ->addColumn('price', function ($product) {
                return $product->price != null ? $product->price : 'Sin precio';
            })->addColumn('options','products.actions')
            ->rawColumns(['options'])
            ->make(true);
    }
}
