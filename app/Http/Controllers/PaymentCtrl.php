<?php

namespace App\Http\Controllers;

use App\Payment;
use Illuminate\Http\Request;
use App\Sale;
use App\Customer;
use App\Product;
use App\User;
use App\Role;
use Auth;
use Image;
use Session;
use File;

class PaymentCtrl extends Controller
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
        $payments = Payment::leftJoin('sales', 'sales.id', 'payments.sales_id')
        ->leftJoin('customers', 'customers.id', 'sales.customer_id')
        ->select('payments.*', 'customers.full_name', 'customers.contact', 'sales.gtotal', 'sales.paid', 'sales.due', 'sales.id as order_number')
        ->orderBy('payments.id', 'ASC')
        ->get();
        $type='';
        return view('layouts.sales.view_payment', compact('payments', 'type'));
    }

    public function getPaymentByType($type)
    {
        if($type == 'All'){
            return $this->index();
        }

        $payments = Payment::leftJoin('sales', 'sales.id', 'payments.sales_id')
        ->leftJoin('customers', 'customers.id', 'sales.customer_id')
        ->where('payments.payment_type', $type)
        ->select('payments.*', 'customers.full_name', 'customers.contact', 'sales.gtotal', 'sales.paid', 'sales.due', 'sales.id as order_number')
        ->orderBy('payments.id', 'ASC')
        ->get();
        return view('layouts.sales.view_payment', compact('payments', 'type'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function getPayment($id)
    {   
        $sale = Sale::leftJoin('customers', 'customers.id', 'sales.customer_id')
        ->select('sales.*', 'customers.full_name', 'customers.contact')->find($id);
        return view('layouts.sales.create_payment', compact('sale'));
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
            'sales_id'      => 'required',
            'paid_amount'   => 'required',
            'payment_type'  => 'required',
            'date'          => 'required',
            'note'          => 'max:9000'
            ]);

        $sale = Sale::find($request->sales_id);

        $payment = new Payment;
        $payment->sales_id      = $request->sales_id;
        $payment->paid_amount   = $request->paid_amount;
        $payment->payment_date  = date('Y-m-d H:i:s', strtotime($request->date));
        $payment->payment_type  = $request->payment_type;
        $payment->received_by   = Auth::id();
        $payment->details       = $request->note;
        $payment->status        = 1;
        $payment->created_by    = Auth::id();
        $payment->save();

        $total_payments = Payment::where('sales_id', $sale->id)->sum('paid_amount');

        if($sale->due > 0){
            $update_sale = Sale::find($sale->id);
            $update_sale->paid = $total_payments;
            $update_sale->due = $sale->gtotal-$total_payments;
            $update_sale->save();
        }

        Session::flash('Success', 'Payment Successfully Saved.');
        return redirect('/sale/'.$request->sales_id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */

    public function show($id)
    {
        $sale = Sale::leftJoin('customers', 'customers.id', 'sales.customer_id')
        ->select('sales.*', 'customers.full_name')
        ->find($id);
        $payment = Payment::find($id);
        return view('layouts.sales.read_payment', compact('sale','payment'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {        
        $payment = Payment::find($id);
        return view('layouts.sales.edit_payment', compact('payment'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $payment = Payment::find($id);
        $payment->paid_amount   = $request->paid_amount;
        $payment->payment_date  = date('Y-m-d H:i:s');
        $payment->received_by   = Auth::id();
        $payment->details       = $request->details;
        $payment->status        = 1;
        $payment->updated_by    = Auth::id();
        $payment->save();
        Session::flash('success', 'Payment successfully saved.');
        return redirect('/payment/'.$id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $payment = Payment::find($id);
        $payment->delete();
        Session::flash('success', 'This payment successfully deleted.');
        return redirect('/payment');
    }
}
