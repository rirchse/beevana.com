<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use App\Products;
use App\Role;
use App\Vendor;
use App\Category;
use App\Subcategory;
use Auth;
use Image;
use Toastr;
use File;
use Session;

class ProductCtrl extends Controller
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
        $products = Product::orderBy('id','desc')->get();
        return view('layouts.products.view_product',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $vendors           = Vendor::all();
        $subcategories     = Subcategory::all();
        $categories        = Category::all();
        return view('layouts.products.create_product',compact('vendors','categories','subcategories'));
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
            'category'     => 'required',
            'brand'        => 'required',
            'mrp_price'    => 'required',
            'mrp_price'    => 'required',
            'vendor'       => 'required',
            'stock'        => 'required',
            'buying_date'  => 'required',
        ]);


        $product = new Product;
        $product->name         = $request->name;
        $product->vendor       = $request->vendor;
        $product->cat_id       = $request->category;
        $product->sub_cat_id   = $request->sub_cat;
        $product->brand        = $request->brand;
        $product->credit_price = $request->credit_price;
        $product->cash_price   = $request->cash_price;
        $product->mrp_price    = $request->mrp_price;
        $product->buying_price = $request->buying_price;
        $product->serial_no    = $request->serial_no;
        $product->stock        = $request->stock;
        $product->buying_date  = $request->buying_date;
        $product->details      = $request->details;
        $product->status       = $request->status ?? 0;
        $product->created_by   = Auth::id();
        
        // if($request->image >0){
        //     $image = $request->file('image');
        //     $img = time() .'.'. $image->getClientOriginalExtension();
        //     $location = public_path('img/product/'.$img);
        //     Image::make($image)->save($location);
        //     $product->image = $img;

        //     }
        $product->save(); 
        $product_id = Product::orderBy('id', 'DESC')->first()->id;

        // Toastr::success('product Successfully Saved' , 'Success');
        Session::flash('success', 'New Product successfully created!');

        return redirect()->route('products.show',$product_id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::find($id);
        return view('layouts.products.read_product',compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $vendors           = Vendor::all();
        $subcategories     = Subcategory::all();
        $categories        = Category::all();
        $product           = Product::find($id);
        return view('layouts.products.edit_product',compact('vendors','categories','subcategories','product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name'         => 'required|max:255',
            'category'     => 'required',            
            'brand'        => 'required',            
            'mrp_price'        => 'required',            
            'mrp_price'   => 'required',            
            'stock'        => 'required',            
            'buying_date'  => 'required',            
        ]);

        $product = Product::find($id);
        $product->name         = $request->name;
        $product->vendor       = $request->vendor;
        $product->cat_id       = $request->category;
        $product->sub_cat_id   = $request->sub_cat;
        $product->brand        = $request->brand;
        $product->credit_price = $request->credit_price;
        $product->cash_price   = $request->cash_price;
        $product->mrp_price    = $request->mrp_price;
        $product->serial_no    = $request->serial_no;
        $product->stock        = $request->stock;
        $product->buying_date  = $request->buying_date;
        $product->details      = $request->details;
        $product->buying_price = $request->buying_price;
        $product->status       = $request->status ?? 0;
        $product->updated_by   = Auth::id();
        
        // if($request->image >0){
        //     if (File::exists('img/product' .$product->image)) {
        //         File::delete('img/product' .$product->image);
        //     }

        //     $image = $request->file('image');
        //     $img = time() .'.'. $image->getClientOriginalExtension();
        //     $location = public_path('img/product/'.$img);
        //     Image::make($image)->save($location);
        //     $product->image = $img;

        //     }
        $product->save(); 
        // Toastr::success('product Successfully Saved' , 'Success');
        Session::flash('success', 'New Product successfully Update!');

        return redirect()->route('products.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
           
             if (File::exists('img/product/' .$product->image)) {
                    File::delete('img/product/' .$product->image);
                }
                $product->delete();
            Session::flash('Success','This Product Successfully delete');
            return redirect()->route('products.index');
    }
    
}
