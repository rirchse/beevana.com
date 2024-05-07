<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Role;
use App\Vendor;
use Auth;
use Image;
use File;
use Session;


class VendorCtrl extends Controller
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
        $vendors = Vendor::orderBy('id','desc')->get();
        return view('layouts.vendors.view_vendor', compact('vendors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('layouts.vendors.create_vendor');
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
            'name'              => 'required|max:255',
            'business_name'     => 'required|max:255',
            'contact'           => 'required|max:11',            
        ]);


        $vendor = new Vendor;
        $vendor->name           = $request->name;
        $vendor->business_name  = $request->business_name;
        $vendor->address        = $request->address;
        $vendor->contact        = $request->contact;
        $vendor->email          = $request->email;
        $vendor->details        = $request->details;
        $vendor->status         = $request->status ?? 0;

        $vendor->created_by     = Auth::id();
        
        if($request->image >0){
            $image = $request->file('image');
            $img = time() .'.'. $image->getClientOriginalExtension();
            $location = public_path('img/vendor/'.$img);
            Image::make($image)->save($location);
            $vendor->image = $img;

            }
            $vendor->save(); 
        $vendor_id = Vendor::orderBy('id', 'DESC')->first()->id;

        Session::flash('success', 'Vendor Successfully Saved');
        return redirect()->route('vendor.show', $vendor_id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\vendor  $vendor
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $vendor =Vendor::find($id);
        return view('layouts.vendors.read_vendor', compact('vendor'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\vendor  $vendor
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $vendor =vendor::find($id);
        return view('layouts.vendors.edit_vendor', compact('vendor'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\vendor  $vendor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name'              => 'required|max:255',
            'business_name'     => 'required|max:255',
            'contact'           => 'required|max:11',            
        ]);
        
        $vendor =Vendor::find($id);
        $vendor->name           = $request->name;
        $vendor->business_name  = $request->business_name;
        $vendor->address        = $request->address;
        $vendor->contact        = $request->contact;
        $vendor->email          = $request->email;
        $vendor->details        = $request->details;
        $vendor->status         = $request->status ?? 0;
        $vendor->created_by     = Auth::id();
        
        if($request->image >0){
            if (File::exists('img/vendor/' .$vendor->image)) {
                File::delete('img/vendor/' .$vendor->image);
            }

            $image = $request->file('image');
            $img = time() .'.'. $image->getClientOriginalExtension();
            $location = public_path('img/vendor/'.$img);
            Image::make($image)->save($location);
            $vendor->image = $img;

            }
            $vendor->save(); 
        Session::flash('success', 'Vendor Successfully Update');
        return redirect()->route('vendor.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\vendor  $vendor
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $vendor = Vendor::find($id);
             if (File::exists('img/vendor/' .$vendor->image)) {
                File::delete('img/vendor/' .$vendor->image);
            }
            $vendor->delete();
        Session::flash('success', 'Vendor Successfully Delete');
        return redirect()->route('vendor.index');
    }
    
}
