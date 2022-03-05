<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use App\Traits\TViewRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Throwable;
use Yajra\DataTables\DataTables;

class CategoryController extends Controller
{
    use TViewRole;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->role_id == 1)
            return $this->renderTemplate('categories.index');

        return view('categories.index', ['full_name' => Auth::user()->person->pers_full_name]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Auth::user()->role_id == 1)
            return $this->renderTemplate('categories.create');

        return view('categories.create', ['full_name' => Auth::user()->person->pers_full_name]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        DB::beginTransaction();
        try {
            $category = new Category($request->all());
            $category->save();
            DB::commit();
            return redirect()->route('categories.create')->with('msg', 'Datos creados correctamente');

        } catch (Throwable $ex) {
            DB::rollBack();
            return redirect()->back()->withInput()->with('error', $ex->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        //
    }

    public function findAll()
    {
        $categories = Category::get();
        return DataTables::of($categories)
            ->addColumn('category', function ($category) {
                return $category->name != null ? $category->name : 'Sin categoria';
            })
            ->addColumn('products', function ($category) {
                return count($category->products) ?? 0;
            })
            ->make(true);
    }
}
