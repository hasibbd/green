<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class OrderController extends Controller
{
    public function showOrderList(Request $request)
    {
        $query = "SELECT b.name AS customer_name, c.name AS vendor_name, a.* FROM `order_mains` a
                LEFT JOIN `users` b ON a.created_by = b.id
                LEFT JOIN `users` c ON a.vendor_id = c.id";

        $data = DB::select($query);
        if ($request->ajax()) {
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){

                    $btn = '<a href="javascript:void(0)" class="edit btn btn-primary btn-sm">View</a>';

                    return $btn;
                }) ->addColumn('status', function($row){
                    if($row->status == 0){
                        return '<span class="badge badge-warning">Pending</span>';
                    }
                    else{
                        return ' <span class="badge badge-success">Success</span>';
                    }
                })
                ->addColumn('is_paid', function($row){
                    if($row->is_paid == 0){
                        return '<span class="badge badge-warning">Due</span>';
                    }
                    else{
                        return '<span class="badge badge-success">Paid</span>';
                    }
                })
                ->rawColumns(['action','status','is_paid'])
                ->make(true);
        }

        return view('admin.pages.order-list.index');
    }
}
