<?php

namespace App\Http\Controllers;

use App\Traits\TViewRole;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    use TViewRole;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if(Auth::user()->role_id == 1)
            return $this->renderTemplate('home');

        if(Auth::user()->role_id == 2)
            return $this->renderTemplate('home', [], Auth::user()->person->seller->id);

        if(Auth::user()->role_id == 3)
            return $this->renderTemplate('home', [], Auth::user()->person->buyer->id);
    }
}
