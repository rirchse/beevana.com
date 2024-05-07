<?php

namespace App\Http\Controllers;

use App\Subcategory;
use Illuminate\Http\Request;
use App\Category;
use App\User;
use Auth;
use Image;
use Toastr;
use File;
use DB;
use Session;

class SubCategoryCtrl extends Controller
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
        $sub_categoris = Subcategory::orderBy('id', 'DESC')->get();
        return view('layouts.sub_categories.view_sub_category', compact('sub_categoris'));
    }

    /*sub categories by cat id*/
    public function subCats($catid)
    {
        $subcats = Subcategory::where('parent_id', $catid)->get();
        return response()->json([
            'success' => $subcats,
            'subcats' => $subcats
            ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categoris = Category::all();
        return view('layouts.sub_categories.create_sub_category', compact('categoris'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $this->validate($request, [
        'name'         => 'required|max:255',
        'parent_id'    => 'required',            
    ]);


       $sub_categorys              = new Subcategory;
       $sub_categorys->name        = $request->name;
       $sub_categorys->parent_id   = $request->parent_id;
       $sub_categorys->details     = $request->details;
       $sub_categorys->status      = $request->status ?? 0;
       $sub_categorys->created_by = Auth::id();
       
       if($request->image >0){
        $image = $request->file('image');
        $img = time() .'.'. $image->getClientOriginalExtension();
        $location = public_path('img/category/sub_category/'.$img);
        Image::make($image)->save($location);
        $sub_categorys->image = $img;

    }
    $sub_categorys->save(); 
    Session::flash('success', 'Sub-Category Successfully Save');
    return redirect()->route('sub_categories.index');
}

    /**
     * Display the specified resource.
     *
     * @param  \App\sub_category  $sub_category
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $categoris = Category::orderBy('name','asc')->get();
        $sub_category = Subcategory::find($id);
        return view('layouts.sub_categories.read_sub_category',compact('sub_category','categoris'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\sub_category  $sub_category
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categoris = Category::all();
        $sub_category =Subcategory::find($id);
        return view('layouts.sub_categories.edit_sub_category',compact('sub_category','categoris'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\sub_category  $sub_category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {$this->validate($request, [
        'name'         => 'required|max:255',
        'parent_id'    => 'required',            
    ]);
        $sub_categorys              = Subcategory::find($id);
        $sub_categorys->name        = $request->name;
        $sub_categorys->parent_id   = $request->parent_id;
        $sub_categorys->details     = $request->details;
        $sub_categorys->status      = $request->status ?? 0;
        $sub_categorys->updated_by  = Auth::id();
        
        if($request->image >0){
           if (File::exists('img/category/sub_category' .$categorys->image)) {
            File::delete('img/category/sub_category' .$categorys->image);
        }

        $image = $request->file('image');
        $img = time() .'.'. $image->getClientOriginalExtension();
        $location = public_path('img/category/sub_category/'.$img);
        Image::make($image)->save($location);
        $sub_categorys->image = $img;

    }
    $sub_categorys->save(); 
    Session::flash('success', 'Sub-Category Successfully Update');
    return redirect()->route('sub_categories.index');
}

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\sub_category  $sub_category
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        $sub_category = Subcategory::find($id);
        
        if (File::exists('img/category/sub_category/' .$sub_category->image)) {
            File::delete('img/category/sub_category/' .$sub_category->image);
        }
        $sub_category->delete();
        Session::flash('success', 'Sub-Category Successfully Delete');
        return redirect()->route('sub_categories.index');
    }
    
}
