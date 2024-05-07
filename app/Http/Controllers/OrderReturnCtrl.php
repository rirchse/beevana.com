<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Sale;
use App\OrderReturn;
use Session;

class OrderReturnCtrl extends Controller
{
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

    public function index()
    {
        $returns = OrderReturn::leftJoin('sales', 'sales.id', 'order_returns.sales_id')
        ->leftJoin('customers', 'customers.id', 'sales.customer_id')
        ->select('order_returns.*', 'sales.order_no', 'sales.gtotal', 'customers.full_name', 'customers.contact')->orderBy('order_returns.id', 'DESC')->get();
        return view('layouts.sales.view_return_order', compact('returns'));
    }
    
    public function getReturn($id)
    {
        $sale = Sale::leftJoin('customers', 'customers.id', 'sales.customer_id')->select('sales.*', 'customers.full_name', 'customers.contact')->find($id);
        return view('layouts.sales.return_order', compact('sale'));
    }

    public function storeReturn(Request $request)
    {
        $this->validate($request, [
            'sales_id' => 'required',
            'comment' => 'required',
            'date' => 'required',
            'delivery_man' => ''
            ]);

        $store = New OrderReturn;
        $store->sales_id = $request->sales_id;
        $store->comment = $request->comment;
        $store->return_date = $request->date;
        $store->delivery_man = $request->delivery_man;
        $store->created_by = Auth::id();
        $store->save();

        $update = Sale::find($request->sales_id);
        $update->status = 3;
        $update->save();

        Session::flash('success', 'Order successfully added to return.');
        return redirect('/return');
    }

    public function delete($id)
    {
        OrderReturn::find($id)->delete();
        Session::flash('success', 'Order retured items successfully delete.');
        return redirect('/return');
    }
}
