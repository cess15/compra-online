<?php

namespace App\Http\Controllers;

use App\Models\Buyer;
use App\Models\SaleProduct;
use App\Traits\TViewRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class BuyerController extends Controller
{
    use TViewRole;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->renderTemplate('buyers.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return $this->renderTemplate('buyers.create');
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
     * @param  \App\Models\Buyer  $buyer
     * @return \Illuminate\Http\Response
     */
    public function show(Buyer $buyer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Buyer  $buyer
     * @return \Illuminate\Http\Response
     */
    public function edit(Buyer $buyer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Buyer  $buyer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Buyer $buyer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Buyer  $buyer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Buyer $buyer)
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
        $buyers = Buyer::get();
        return DataTables::of($buyers)
            ->addColumn('buyer', function ($buyer) {
                return $buyer->person != null ? $buyer->person->pers_full_name : 'Sin comprador';
            })
            ->addColumn('products', function ($buyer) {
                return count($buyer->saleProducts) ?? '0';
            })
            ->make(true);
    }

    public function productsBoughtByBuyer($value)
    {
        $buyerProducts = SaleProduct::where('buyer_id', $value)->get();

        return DataTables::of($buyerProducts)
            ->addColumn('product', function ($buyerProduct) {
                return $buyerProduct->product != null ? $buyerProduct->product->name : 'Sin producto';
            })->addColumn('price', function ($buyerProduct) {
                return $buyerProduct->product != null ? $buyerProduct->product->price : 'Sin precio';
            })->addColumn('seller', function ($buyerProduct) {
                return $buyerProduct->seller != null ? $buyerProduct->seller->person->pers_full_name : 'Sin Vendedor';
            })->addColumn('status', function ($buyerProduct) {
                return $buyerProduct->product != null ? $buyerProduct->product->status->st_name : 'Sin Estado';
            })->addColumn('date_bought', function ($buyerProduct) {
                return $buyerProduct->created_at->diffForHumans() != null ? $buyerProduct->created_at->diffForHumans() : 'Sin fecha de compra';
            })->addColumn('options','buyers.actions')
            ->rawColumns(['options'])
            ->make(true);
    }
}
