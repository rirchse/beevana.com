<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;
use Auth;
use Image;
use Toastr;
use File;
use Session;


class CustomerCtrl extends Controller
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
        $customers = Customer::latest()->get();
        return view('layouts.customers.view_customer', compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('layouts.customers.create_customer');
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
        'full_name' => 'required|max:255',
        'contact'   => 'required|regex:/(01)[0-9]{9}/|max:11',
        'email'     => 'email|max:32|nullable',
        'address'   => 'required|max:255',
        'status'    => 'max:10',
        'details'   => 'max:99999',
    ]);


     $customer = new Customer;
     $customer->full_name  = $request->full_name;
     $customer->email      = $request->email;
     $customer->contact    = $request->contact;
     $customer->address    = $request->address;
     $customer->details    = $request->details;
     $customer->status     = 1;
     $customer->created_by = Auth::id();

     if($request->image >0){
        $image = $request->file('image');
        $img = time() .'.'. $image->getClientOriginalExtension();
        $location = public_path('img/customer/'.$img);
        Image::make($image)->save($location);
        $customer->image = $img;
    }

    $customer->save(); 

    $customer_id = Customer::orderBy('id', 'DESC')->first()->id;

    Session::flash('success', 'Customer Successfully Saved');
    return redirect()->route('customer.show',$customer_id);
}

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $customer = Customer::find($id);
        return view('layouts.customers.read_customer',compact('customer'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $customer = Customer::find($id);
        return view('layouts.customers.edit_customer',compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'full_name' => 'required|max:255',
            'contact'   => 'required|regex:/(01)[0-9]{9}/|max:11',
            'email'     => 'email|max:32|nullable',
            'address'   => 'required|max:255',
            'status'    => 'max:10',
            'details'   => 'max:99999',
        ]);


        $customer = Customer::find($id);
        $customer->full_name  = $request->full_name;
        $customer->email      = $request->email;
        $customer->contact    = $request->contact;
        $customer->address    = $request->address;
        $customer->details    = $request->details;
        $customer->status     = 1;
        $customer->created_by = Auth::id();
        $customer->save();

        Session::flash('success', 'Customer information successfully updated.');
        return redirect('/customer/'.$id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $customer = Customer::find($id);           
        if (File::exists('img/customer/' .$customer->image)) {
            File::delete('img/customer/' .$customer->image);
        }
        $customer->delete();
        Session::flash('success', 'Customer Successfully Delete');
        return redirect()->route('customer.index');
    }

    public function searchCustomer($mobile_number)
    {
        $customer = Customer::where('contact', $mobile_number)->select('full_name', 'address')->first();
        return response()->json([
            'success' => $customer
        ]);
    }
}
