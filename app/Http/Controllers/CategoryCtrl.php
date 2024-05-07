<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use File;
use Auth;
use Session;

// use App\Category;
class CategoryCtrl extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::latest()->get();
        return view('layouts.categories.view_category', compact('categories'));
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('layouts.categories.create_new_category');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name'  => 'required|unique:categories'
        ]);

        $categoris = new Category;
        $categoris->name        = $request->name;
        $categoris->details     = $request->details;
        $categoris->status      = $request->status? 1 : 0;
        $categoris->created_by  = Auth::id();
        $categoris->save();

        $last_cat_id = Category::orderBy('id', 'DESC')->first()->id;
        Session::flash('success', 'Category Successfully Saved');

        return redirect()->route('category.show', $last_cat_id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
     $category = Category::find($id);
     return view('layouts.categories.read_category', compact('category'));
 }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category =Category::find($id);
        return view('layouts.categories.edit_category', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $category = Category::find($id);
        $category->name        = $request->name;
        $category->details     = $request->details;
        $category->status      = $request->status ?? 0;

        $category->updated_by  = Auth::id();

        //multipul image uplode to use this puction======================
        if($request->image >0){

            if (File::exists('img/category/' .$category->image)) {
                File::delete('img/category/' .$category->image);
            }

            $image      = $request->file('image');
            $img        = time() .'.'. $image->getClientOriginalExtension();
            $location   = public_path('img/category/'.$img);
            Image::make($image)->save($location);
            $category->image = $img;
        }
        $category->save();
        Session::flash('success', 'Category Successfully Updated');

        return redirect()->route('category.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::find($id);
            // if (!is_null($category)) {

            //       //delete all the districts for the category
            //     $posts = Post::where('category_id', $category->id)->get();
            //     foreach ($posts as $post) {
            //         $post->delete();
            //     }
            //     $category->delete();
            // }
        if (File::exists('img/category/' .$category->image)) {
            File::delete('img/category/' .$category->image);
        }
        $category->delete();
        Session::flash('success', 'Category Successfully Delete');
        return redirect()->route('category.index');
    }
}
