<?php

namespace App\Traits;

use App\Models\Buyer;
use App\Models\Category;
use App\Models\Product;
use App\Models\SaleProduct;
use App\Models\Seller;
use Illuminate\Support\Facades\Auth;

trait TViewRole
{
    public static function renderTemplate($view, $collection = [], $value = null) {

        $data = [
            'full_name' => Auth::user()->person->pers_full_name,
        ];

        if(Auth::user()->role_id == 1) {

            $data += [
                'products' => Product::count(),
                'buyers' => Buyer::count(),
                'sellers' => Seller::count(),
                'saleProducts' => SaleProduct::count(),
                'categories' => Category::count(),
                'data' => $collection,
                'value' => isset($value) ? $value : NULL
            ];

            return view($view, $data);
        }

        if(Auth::user()->role_id == 2) {
            $data += [
                'saleProducts' => SaleProduct::where('seller_id', Auth::user()->person->seller->id)->count(),
                'data' => $collection,
                'products' => Product::count(),
                'value' => isset($value) ? $value : NULL
            ];

            return view($view, $data);
        }

        if(Auth::user()->role_id == 3) {
            $data += [
                'saleProducts' => SaleProduct::where('buyer_id', Auth::user()->person->buyer->id)->count(),
                'products' => SaleProduct::whereRaw('buyer_id is null')->count(),
                'value' => isset($value) ? $value : NULL
            ];
            return view($view, $data);
        }
    }
}
