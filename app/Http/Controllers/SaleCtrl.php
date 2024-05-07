<?php

namespace App\Http\Controllers;

use App\Sale;
use Illuminate\Http\Request;
use App\Customer;
use App\Product;
use App\Payment;
use App\User;
use App\Role;
use Auth;
use Image;
use App\OrderItem;
use File;
use Session;

class SaleCtrl extends Controller
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
        return $this->viewSalesByType('All', 'view');
    }

    public function viewSalesByType($type, $daily)
    {
        $status = [];
        if($type == 'All'){
            $status = [0, 1, 2, 3, 4];
        }elseif($type == 'New'){
            $status = [0];
        }elseif($type == 'Confirmed'){
            $status = [1];
        }elseif($type == 'Completed'){
            $status = [2];
        }elseif($type == 'Cancelled'){
            $status = [3];
        }

        $sales = [];
        if($daily == 'Daily'){
            $sales = Sale::leftJoin('customers', 'customers.id', 'sales.customer_id')
            ->select('sales.*', 'customers.full_name', 'customers.contact', 'customers.address')->whereIn('sales.status', $status)->orderBy('sales.id','DESC')->where('sales_date', 'like', '%'.date('Y-m-d').'%')->paginate(20);
        }else{
            $sales = Sale::leftJoin('customers', 'customers.id', 'sales.customer_id')
            ->select('sales.*', 'customers.full_name', 'customers.contact', 'customers.address')->whereIn('sales.status', $status)->orderBy('sales.id','DESC')->paginate(20);
        }
        
        return view('layouts.sales.view_sale', compact('sales', 'type', 'daily'));
    }
    
    public function create()
    {
        $order_no = 1;
        $ext_order_no = Sale::max('order_no');
        if($ext_order_no){
            $order_no = $ext_order_no+1;
        }
        return view('layouts.sales.create-sale', compact('order_no'));
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
            'customer_name'     => 'required',
            'mobile'            => 'required',
            'sales_date'        => 'required',
            'address'           => '',
            'email'             => 'email|nullable',
            'order_no'          => 'required|numeric',
            'sub_total'         => 'required|numeric',
            'discount'          => 'numeric',
            'shipping'          => 'numeric',
            'gtotal'            => 'required|numeric',
            'paid'              => 'numeric',
            'due'               => 'numeric',
            'sold_by'           => '',
            'status'            => 'required|numeric',
            'shipping_address'  => '',
            'note'              => ''
        ]);

        $customer_id = '';

        $exist_customer = Customer::where('contact', $request->mobile)->first();
        if($exist_customer == null){
            $customer = new Customer;
            $customer->full_name   = $request->customer_name;
            $customer->contact     = $request->mobile;
            $customer->address     = $request->address;
            $customer->email       = $request->email;
            $customer->status      = 1;
            $customer->created_by  = Auth::id();
            $customer->save();

            $customer_id = Customer::orderBy('id', 'DESC')->first()->id;
        }else{
            $customer_id = $exist_customer->id;
        }

        $sale = new Sale;
        $sale->order_no          = $request->order_no;
        $sale->customer_id       = $customer_id;
        $sale->sub_total         = $request->sub_total;
        $sale->discount          = $request->discount;
        $sale->shipping          = $request->shipping;
        $sale->gtotal            = $request->gtotal;
        $sale->paid              = $request->paid;
        $sale->due               = $request->due;
        $sale->sales_date        = date('Y-m-d H:i:s', strtotime($request->sales_date));
        $sale->payment_type      = $request->payment_type;
        $sale->details           = $request->note;
        $sale->shipping_address  = $request->shipping_address;
        $sale->sold_by           = Auth::id();
        $sale->status            = $request->status ?? 0;
        $sale->created_by        = Auth::id();
        $sale->save(); 

        $sale_id = Sale::orderBy('id','DESC')->first()->id;

        foreach($request->itemname as $key => $value){
            $item = new OrderItem;
            $item->sales_id   = $sale_id;
            $item->name       = $request->itemname[$key];
            $item->price      = $request->price[$key];
            $item->qty        = $request->qty[$key];
            $item->total      = $request->total[$key];
            $item->save();
        }

        Session::flash('success', 'Sale Successfully Saved.');
        if($request->paid){
            return redirect('/payment/'.$sale_id.'/get');
        }
        return redirect()->route('sale.show', $sale_id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $sale = Sale::find($id);
        return view('layouts.sales.read_sale', compact('sale'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $sale= Sale::leftJoin('customers', 'customers.id', 'sales.customer_id')->select('sales.*', 'customers.full_name', 'customers.contact', 'customers.address')->find($id);
        return view('layouts.sales.edit_sale', compact('sale'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'customer_name' => 'required',
            'mobile'        => 'required',
            'sales_date'    => 'required',
            'address'       => '',
            'email'         => 'email|nullable',
            'sub_total'     => 'required|numeric',
            'discount'      => 'numeric',
            'shipping'      => 'numeric',
            'gtotal'        => 'required|numeric',
            'paid'          => 'numeric',
            'due'           => 'numeric',
            'sold_by'       => '',
            'shipping_address' => '',
            'note'          => ''
        ]);

        $sale = Sale::find($id);
        $sale->sub_total     = $request->sub_total;
        $sale->discount      = $request->discount;
        $sale->shipping      = $request->shipping;
        $sale->gtotal        = $request->gtotal;
        $sale->paid          = $request->paid;
        $sale->due           = $request->due;
        $sale->sales_date    = date('Y-m-d H:i:s', strtotime($request->sales_date));
        $sale->payment_type  = $request->payment_type;
        $sale->details       = $request->note;
        $sale->shipping_address = $request->shipping_address;
        $sale->status        = $request->status ?? 0;
        $sale->updated_by    = Auth::id();
        $sale->save();
        
        //collect item ids and create a simple array
        $dbitemids = [];
        foreach (OrderItem::where('sales_id', $id)->select('id')->get() as $dbitemid) {
            array_push($dbitemids, $dbitemid->id);
        }

        //separate deleted items ids
        $del_itemids = array_diff($dbitemids, $request->itemId);

        foreach($request->itemname as $key => $value){
            if(!empty($request->itemId[$key])){
                $item = OrderItem::find($request->itemId[$key]);
                $item->name       = $request->itemname[$key];
                $item->price      = $request->price[$key];
                $item->qty        = $request->qty[$key];
                $item->total      = $request->total[$key];
                $item->save();

            }else{

                $item = new OrderItem;
                $item->sales_id   = $id;
                $item->name       = $request->itemname[$key];
                $item->price      = $request->price[$key];
                $item->qty        = $request->qty[$key];
                $item->total      = $request->total[$key];
                $item->save();
            }
            
        }

        //delete items
        OrderItem::whereIn('id', $del_itemids)->delete();

        Session::flash('success', 'Sale Successfully Updated.');
        return redirect('/sale/'.$id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $sale = Sale::find($id);
        $sale->delete();
        Session::flash('success', 'The order successfully deleted.');
        return redirect('/sale');
    }

    public function print($id)
    {
        $sale = Sale::find($id);
        return view('layouts.sales.print_sale', compact('sale'));
    }

    public function search($value)
    {
        $orders = Sale::leftJoin('customers', 'customers.id', 'sales.customer_id')
        ->leftJoin('users', 'users.id', 'sales.created_by')
        ->where('customers.full_name', 'like','%'.$value.'%')
        ->orWhere('customers.contact', 'like','%'.$value.'%')
        ->orWhere('gtotal',  'like','%'.$value.'%')
        ->select('sales.*', 'customers.full_name', 'customers.contact', 'customers.address', 'users.name')
        ->limit(5)->get();
        return response()->json([
            'success' => $orders
        ]);
    }

    public function getNames()
    {
        $items = OrderItem::groupBy('name')->select('name')->limit(10)->get();
        return response()->json([
            'success' => $items
        ]);
    }

    public function changePrintStatus($id)
    {
        $print_status = 1;
        $sale = Sale::find($id);
        if($sale->print_status){
            $print_status = $sale->print_status+1;
        }
        
        $update = Sale::find($id);
        $update->print_status = $print_status;
        $update->save();

        return response()->json('true');
    }
}
