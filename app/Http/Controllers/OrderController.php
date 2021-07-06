<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Illuminate\Support\Facades\Redirect;
session_start();

class OrderController extends Controller
{
    public function all(){
        $all_order = DB::table('tbl_chapterunlock')->orderBy('chapterunlock_id','DESC')->paginate(10);
        $result = DB::table('tbl_customer')->where('customer_id', Session::get('admin_id'))->first();
        $noti = DB::table('tbl_noti')->where('customer_id', $result->customer_id)->orderBy('noti_id','DESC')->get();
        return view('admin.order.all')->with('all_order', $all_order) ->with('noti', $noti)->with('result', $result);
    }
    public function loc_order(Request $request){
        $data = $request->all();
        $from_date = $request->from_date;
        $to_date = $request->to_date;
        if($from_date){
            $tu_ngay = $from_date;
        }else{
            $tu_ngay =  date('y-m-d',time() - (7 * 24 * 60 * 60));
        }
        if($to_date){
            $toi_thoidiem_hien_tai = $to_date;
        }else{
            $toi_thoidiem_hien_tai = date('y-m-d',time());
        }
        $day = 0;
        $result = DB::table('tbl_customer')->where('customer_id', Session::get('admin_id'))->first();
        $noti = DB::table('tbl_noti')->where('customer_id', $result->customer_id)->orderBy('noti_id','DESC')->get();
        $all_order = DB::table('tbl_chapterunlock')
        ->whereBetween('tbl_chapterunlock.day_create_order',[$tu_ngay,$toi_thoidiem_hien_tai])
        ->orderBy('chapterunlock_id','DESC')->paginate(10);
        $count = DB::table('tbl_chapterunlock')
        ->whereBetween('tbl_chapterunlock.day_create_order',[$tu_ngay,$toi_thoidiem_hien_tai])
        ->count();
        $i = 0;
        if($count == 0){
            $all_order = DB::table('tbl_chapterunlock')->orderBy('chapterunlock_id','DESC')->paginate(10);
            Session::put('fail','không có chương truyện nào được mở khóa trong khoảng thời gian bạn đã chọn');
            return view('admin.order.all')->with('all_order', $all_order) ->with('noti', $noti)->with('result', $result);
        }else{
        return view('admin.order.all')->with('all_order', $all_order)->with('noti', $noti)->with('result', $result);
        }
    }
}