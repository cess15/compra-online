<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\SaleProduct;
use App\Models\User;
use App\Services\MailService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Throwable;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Str;

class SaleProductController extends Controller
{
    private $mailService;

    public function __construct(MailService $mailService)
    {
        $this->mailService = $mailService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $product)
    {
        DB::beginTransaction();
        try {
            if(Auth::user()->role_id == 2) {
                $saleProduct = new SaleProduct();
                $saleProduct->product_id = intval($product);
                $saleProduct->seller_id = Auth::user()->person->seller->id;
                $saleProduct->save();
                DB::commit();
                return redirect()->route('products.index')->with('msg', 'Producto puesto en venta');

            }
            if(Auth::user()->role_id == 3) {
                $saleProduct = SaleProduct::find($product);
                $saleProduct->buyer_id = Auth::user()->person->buyer->id;
                $saleProduct->update();

                $codeVerification = Str::random(5);

                $user = User::find(Auth::user()->id);
                $user->code_verification = $codeVerification;
                $user->save();


                $product = Product::find($saleProduct->product_id);
                $product->status_id = 2;
                $product->save();

                $params = [
                    "subject"   => "Registro de compra",
                    "view"      => "mails.buy",
                    "to" => array(
                        ["name" => NULL, "email" => Auth::user()->email]
                    ),
                    "params" => [
                        "CODE" => $codeVerification,
                        "APP_NAME" => env('APP_NAME'),
                        "DATE" => date('Y'),
                    ],
                ];

                $this->mailService->sendMail($params);
                DB::commit();
                return redirect()->route('products.index')->with('msg', 'Producto en proceso de compra. Se le ha enviado un correo electrónico para seguir con la compra');
            }
            } catch (Throwable $ex) {
            DB::rollBack();
            return redirect()->back()->withInput()->with('error', $ex->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SaleProduct  $saleProduct
     * @return \Illuminate\Http\Response
     */
    public function show(SaleProduct $saleProduct)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SaleProduct  $saleProduct
     * @return \Illuminate\Http\Response
     */
    public function edit(SaleProduct $saleProduct)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SaleProduct  $saleProduct
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SaleProduct $saleProduct)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SaleProduct  $saleProduct
     * @return \Illuminate\Http\Response
     */
    public function destroy(SaleProduct $saleProduct)
    {
        //
    }

    public function findAll()
    {
        if(Auth::user()->role_id == 3) {

            $buyerProducts = SaleProduct::whereRaw('buyer_id is null')->get();

            return DataTables::of($buyerProducts)
                ->addColumn('category', function ($buyerProduct) {
                    return $buyerProduct->product != null ? $buyerProduct->product->category->name : 'Sin categoria';
                })->addColumn('product', function ($buyerProduct) {
                    return $buyerProduct->product != null ? $buyerProduct->product->name : 'Sin producto';
                })->addColumn('price', function ($buyerProduct) {
                    return $buyerProduct->product != null ? $buyerProduct->product->price : 'Sin precio';
                })->addColumn('seller', function ($buyerProduct) {
                    return $buyerProduct->seller != null ? $buyerProduct->seller->person->pers_full_name : 'Sin Vendedor';
                })->addColumn('status', function ($buyerProduct) {
                    return $buyerProduct->product != null ? $buyerProduct->product->status->st_name : 'Sin estado';
                })->addColumn('options','products.actions')
                ->rawColumns(['options'])
            ->make(true);
        }

        $saleProducts = SaleProduct::get();

        return DataTables::of($saleProducts)
            ->addColumn('product', function ($saleProduct) {
                return $saleProduct->product != null ? $saleProduct->product->name : 'Sin producto';
            })
            ->addColumn('price', function ($saleProduct) {
                return $saleProduct->product != null ? $saleProduct->product->price : 'Sin precio';
            })
            ->addColumn('seller', function ($saleProduct) {
                return $saleProduct->seller != null ? $saleProduct->seller->person->pers_full_name : 'Sin vendedor';
            })
            ->addColumn('buyer', function ($saleProduct) {
                return $saleProduct->buyer != null ? $saleProduct->buyer->person->pers_full_name : 'Sin comprador';
            })
            ->make(true);
    }

    public function validateBuy(Request $request, $product)
    {
        DB::beginTransaction();
        try {

            if(Auth::user()->code_verification == $request->code) {
                $saleProduct = SaleProduct::find($product);
                $product = Product::find($saleProduct->product_id);
                $product->status_id = 3;
                $product->save();
                DB::commit();
                return redirect()->route('home')->with('msg', 'Producto validado con éxito');
            }

            return redirect()->back()->withInput()->with('error', 'El código ingresado es incorrecto');
        }
        catch(Throwable $ex) {
            DB::rollBack();
            return redirect()->back()->withInput()->with('error', $ex->getMessage());
        }
    }
}
