<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\SaleProduct;
use App\Models\Seller;
use App\Traits\TViewRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class SellerController extends Controller
{
    use TViewRole;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->renderTemplate('sellers.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = Product::get();
        return $this->renderTemplate('sellers.create', $products);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Seller  $seller
     * @return \Illuminate\Http\Response
     */
    public function show(Seller $seller)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Seller  $seller
     * @return \Illuminate\Http\Response
     */
    public function edit(Seller $seller)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Seller  $seller
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Seller $seller)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Seller  $seller
     * @return \Illuminate\Http\Response
     */
    public function destroy(Seller $seller)
    {
        //
    }

    /**
     * findAll
     *
     * @return void
     */
    public function findAll()
    {
        $sellers = Seller::get();
        return DataTables::of($sellers)
            ->addColumn('seller', function ($seller) {
                return $seller->person->pers_full_name != null ? $seller->person->pers_full_name : 'Sin vendedor';
            })
            ->addColumn('products', function ($seller) {
                return count($seller->saleProducts) ?? 0;
            })
            ->make(true);
    }

    public function productsSoldBySeller($value)
    {
        $sellerProducts = SaleProduct::where('seller_id', $value)->get();

        return DataTables::of($sellerProducts)
            ->addColumn('product', function ($sellerProduct) {
                return $sellerProduct->product->name != null ? $sellerProduct->product->name : 'Sin producto';
            })->addColumn('price', function ($sellerProduct) {
                return $sellerProduct->product->price != null ? $sellerProduct->product->price : 'Sin precio';
            })->addColumn('buyer', function ($sellerProduct) {
                return $sellerProduct->buyer != null ? $sellerProduct->buyer->person->pers_full_name : 'Sin Comprador';
            })->addColumn('date_sold', function ($sellerProduct) {
                return $sellerProduct->created_at != null ? $sellerProduct->created_at->diffForHumans() : 'Sin fecha de venta';
            })
            ->make(true);
    }
}
