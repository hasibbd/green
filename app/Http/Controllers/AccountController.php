<?php

namespace App\Http\Controllers;

use App\Models\CompanyWallet;
use App\Models\PointWallet;
use App\Models\StoreManagerWallat;
use App\Models\User;
use App\Models\UserBalanceWallat;
use App\Models\UserReserve;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
   public function pointAccount(Request $request){
       if ($request->ajax()) {
           $data = PointWallet::with('user')->latest()->get();
           return Datatables::of($data)
               ->addIndexColumn()
               ->addColumn('user_id', function($row){
                  return $row->user->user_id;

               })
               ->addColumn('user_name', function($row){
                   return $row->user->name;
               })
               ->addColumn('remarks', function($row){
                   return $row->generate_from;
               })
               ->addColumn('status', function($row){
                   if ($row->status == 1){
                       $btn = '<span class="badge badge-pill badge-success">Done</span>';

                   }else{
                       $btn = '<span class="badge badge-pill badge-warning">Pending</span>';

                   }
                   return $btn;
               })
               ->addColumn('date', function($row){
                   return date("F j, Y, g:i a", strtotime($row->updated_at));
               })
               ->rawColumns(['date','user_name','user_id','status','remarks'])
               ->make(true);
       }
       return view('admin.pages.point-list.index');
   }
   public function userAccount(Request $request){
       if ($request->ajax()) {
           $data = UserBalanceWallat::with('user')->latest()->get();
           return Datatables::of($data)
               ->addIndexColumn()
               ->addColumn('user_id', function($row){
                  return $row->user->user_id;

               })
               ->addColumn('user_name', function($row){
                   return $row->user->name;
               })
               ->addColumn('remarks', function($row){
                   return $row->from;
               })
               ->addColumn('status', function($row){
                   if ($row->status == 1){
                       $btn = '<span class="badge badge-pill badge-success">Done</span>';

                   }else{
                       $btn = '<span class="badge badge-pill badge-warning">Pending</span>';

                   }
                   return $btn;
               })
               ->addColumn('date', function($row){
                   return date("F j, Y, g:i a", strtotime($row->updated_at));
               })
               ->rawColumns(['date','user_name','user_id','status','remarks'])
               ->make(true);
       }
       return view('admin.pages.user-account-list.index');
   }
   public function userReserve(Request $request){
       if ($request->ajax()) {
           $data = UserReserve::with('user')->latest()->get();
           return Datatables::of($data)
               ->addIndexColumn()
               ->addColumn('user_id', function($row){
                  return $row->user->user_id;

               })
               ->addColumn('user_name', function($row){
                   return $row->user->name;
               })
               ->addColumn('remarks', function($row){
                   return $row->from;
               })
               ->addColumn('status', function($row){
                   if ($row->status == 1){
                       $btn = '<span class="badge badge-pill badge-success">Done</span>';

                   }else{
                       $btn = '<span class="badge badge-pill badge-warning">Pending</span>';

                   }
                   return $btn;
               })
               ->addColumn('date', function($row){
                   return date("F j, Y, g:i a", strtotime($row->updated_at));
               })
               ->rawColumns(['date','user_name','user_id','status','remarks'])
               ->make(true);
       }
       return view('admin.pages.user-reserve-list.index');
   }
   public function companyAccount(Request $request){
       if ($request->ajax()) {
           $data = CompanyWallet::with('user')->latest()->get();
           return Datatables::of($data)
               ->addIndexColumn()
               ->addColumn('user_id', function($row){
                  return $row->user->user_id;

               })
               ->addColumn('user_name', function($row){
                   return $row->user->name;
               })
               ->addColumn('status', function($row){
                   if ($row->status == 1){
                       $btn = '<span class="badge badge-pill badge-success">Done</span>';

                   }else{
                       $btn = '<span class="badge badge-pill badge-warning">Pending</span>';

                   }
                   return $btn;
               })
               ->addColumn('date', function($row){
                   return date("F j, Y, g:i a", strtotime($row->updated_at));
               })
               ->rawColumns(['date','user_name','user_id','status'])
               ->make(true);
       }
       return view('admin.pages.company-account-list.index');
   }
   public function storeManagerAccount(Request $request){
       if ($request->ajax()) {
           $data = StoreManagerWallat::with('user')->latest()->get();
           return Datatables::of($data)
               ->addIndexColumn()
               ->addColumn('user_id', function($row){
                  return $row->user->user_id;

               })
               ->addColumn('user_name', function($row){
                   return $row->user->name;
               })
               ->addColumn('vendor', function($row){
                   return User::find('id',$row->vendor_id)->user_id;
               })
               ->addColumn('status', function($row){
                   if ($row->status == 1){
                       $btn = '<span class="badge badge-pill badge-success">Done</span>';

                   }else{
                       $btn = '<span class="badge badge-pill badge-warning">Pending</span>';

                   }
                   return $btn;
               })
               ->addColumn('date', function($row){
                   return date("F j, Y, g:i a", strtotime($row->updated_at));
               })
               ->rawColumns(['date','user_name','user_id','status','vendor'])
               ->make(true);
       }
       return view('admin.pages.store-manager-account-list.index');
   }
}
