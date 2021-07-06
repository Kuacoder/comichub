<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Charts\UserChart;
use DB;
use Session;
use Carbon\Carbon;
use Illuminate\Support\Facades\Redirect;
session_start();

class AdminController extends Controller
{
    //
    public function all(){
        $all_admin = DB::table('tbl_customer')->where('customer_title', 2)->paginate(12);
        $result = DB::table('tbl_customer')->where('customer_id', Session::get('admin_id'))->first();
        $noti = DB::table('tbl_noti')->where('customer_id', $result->customer_id)->orderBy('noti_id','DESC')->get();
       
       
        return view('admin.all')->with('all_admin', $all_admin)->with('noti', $noti)->with('result', $result);
    }
    public function login(){
        return view('admin.login');
    }

    public function add(){
         $result = DB::table('tbl_customer')->where('customer_id', Session::get('admin_id'))->first();
        $noti = DB::table('tbl_noti')->where('customer_id', $result->customer_id)->orderBy('noti_id','DESC')->get();
        return view('admin.add')->with('noti', $noti)->with('result', $result);
    }
    public function logout(){
        Session::put('admin_id',null);
        
        return view('admin.login');
    }
    public function save(Request $request){
        $data = array();
        $data['customer_email'] = trim($request->admin_email);
        $data['customer_password'] = md5($request->admin_password);
        $data['customer_name'] = trim($request->admin_name);
        $data['customer_phone'] = trim($request->admin_phone);
        $data['customer_birthday'] = trim($request->admin_birthday);
        $data['customer_gender'] = trim($request->admin_gender);
        $data['customer_address'] = trim($request->admin_address);
        $data['customer_status'] = 1;
        $data['customer_title'] = 2;
        $data['number_noti'] = 0;
        $data['customer_cash'] = 0;
        $data['cash_used'] = 0;
        $data['customer_sales'] = 0;
        $data['customer_publish'] = 0;
        $data['customer_date'] = time();
        $data['customer_update'] = '';
        $email = trim($request->admin_email);
        $email_exist = DB::table('tbl_customer')->where('customer_email',$email)->count();
        if($email_exist > 0){
            Session::put('fail', 'Email này đã tồn tại!');
            return Redirect::to('add-admin');
        }else{
            $get_image = $request->file('admin_avatar');
            if($get_image){
                $permited = array('jpg','jpeg', 'png', 'gif');
                $file_name = $_FILES['admin_avatar']['name'];
                $file_size = $_FILES['admin_avatar']['size'];
                $file_temp = $_FILES['admin_avatar']['tmp_name'];
    
                $div = explode('.', $file_name);
                $file_ext = strtolower(end($div));
                $unique_image = substr(md5(time()),0, 10).'.'.$file_ext;
                $get_image->move('public/uploads/customer/',$unique_image);
                $data['customer_avatar'] = $unique_image;
                DB::table('tbl_customer')->insert($data);
                Session::put('success', 'Tài khoản quản trị mới đã được thêm vào hệ thống');
                return Redirect::to('list-admin');
            }
            $data['customer_avatar'] = '';
            DB::table('tbl_customer')->insert($data);
            Session::put('success', 'Tài khoản quản trị mới đã được thêm vào hệ thống');
            return Redirect::to('list-admin');
        }
    }
    public function dashboard(Request $request){
        $admin_email = $request->admin_email;
        $admin_password = md5($request->admin_password);

        $day = 0;
        $current_date = date('Y-m-d');
        $toi_thoidiem_hien_tai = date('y-m-d',time());
        $tu_ngay =  date('y-m-d',time() - (7 * 24 * 60 * 60));
        $result = DB::table('tbl_customer')->where('customer_email',$admin_email)
        ->where('customer_password',$admin_password)->where('customer_title',2)->first();
        $all_order = DB::table('tbl_chapterunlock')
        ->join('tbl_customer','tbl_customer.customer_id','=','tbl_chapterunlock.customer_id')
        ->whereBetween('tbl_chapterunlock.day_create_order',[$tu_ngay,$toi_thoidiem_hien_tai])
        ->orderBy('tbl_chapterunlock.chapterunlock_id', 'desc')->get();
        // TÍNH TUỔI
        $namhientai = (int)date('Y',time());
        foreach($all_order as $key => $value){
            $tuoinguoidung = (int)date('Y',strtotime($value->customer_birthday));
            $tuoi[] = ($namhientai - $tuoinguoidung);
        }
        $sotiengiaodich = 0;
        foreach($all_order as $key => $value){
            $sotiengiaodich = $sotiengiaodich + $value->chapter_price;
        }
        
        $gioitinhnam = 0;
        $gioitinhnu = 0;

        foreach($all_order as $key => $value){
            if($value->customer_gender == 0){
                $gioitinhnam += 1;
            }
            if($value->customer_gender == 1){
                $gioitinhnu += 1;
            }
        }
        if($gioitinhnam > $gioitinhnu){
            $gioitinhmuanhieunhat = 'nam';
        }
        if($gioitinhnu > $gioitinhnam){
            $gioitinhmuanhieunhat = 'nữ';
        }
        if(isset($tuoi)){
            $tuoinhonhat = min($tuoi);
            $tuoilonnhat = max($tuoi);
        }else{
            $tuoinhonhat = '';
            $tuoilonnhat = '';
        }
       


        // KẾT QUẢ CỦA TUẦN HIỆN TẠI
       
        $comic_boy = DB::table('tbl_chapterunlock')
        ->join('tbl_comic','tbl_comic.comic_id','=','tbl_chapterunlock.comic_id')
        ->whereBetween('tbl_chapterunlock.day_create_order',[$tu_ngay,$toi_thoidiem_hien_tai])
        ->where('tbl_comic.comic_gender',0)
        ->orderBy('tbl_chapterunlock.day_create_order','ASC')->get();
        $comic_girl = DB::table('tbl_chapterunlock')
        ->join('tbl_comic','tbl_comic.comic_id','=','tbl_chapterunlock.comic_id')
        ->whereBetween('tbl_chapterunlock.day_create_order',[$tu_ngay,$toi_thoidiem_hien_tai])
        ->where('tbl_comic.comic_gender',1)
        ->orderBy('tbl_chapterunlock.day_create_order','ASC')->get();
        $comic_other = DB::table('tbl_chapterunlock')
        ->join('tbl_comic','tbl_comic.comic_id','=','tbl_chapterunlock.comic_id')
        ->whereBetween('tbl_chapterunlock.day_create_order',[$tu_ngay,$toi_thoidiem_hien_tai])
        ->where('tbl_comic.comic_gender',2)
        ->orderBy('tbl_chapterunlock.day_create_order','ASC')->get();
       
        foreach($comic_boy as $key => $value){
            $ngay[] = $value->day_create_order;
        }
        foreach($comic_boy as $key => $value){
            $value_cuaboy[] =  $value->chapter_price;
        }
        foreach($comic_girl as $key => $value){
            $value_cuagirl[] =  $value->chapter_price;
        }
        foreach($comic_other as $key => $value){
            $value_khac[] =  $value->chapter_price;
        }
        
        // VẼ VỜI Ở ĐÂY
        $usersChart = new UserChart;
        $usersChart->labels($ngay);
        $usersChart->dataset('Truyện tranh nam', 'bar', $value_cuaboy) 
        ->color("rgba(249, 99, 50,1)")
        ->backgroundcolor("rgba(249, 99, 50,1)");
          if(isset($value_cuagirl)){
            $usersChart->dataset('Truyện tranh nữ', 'bar', $value_cuagirl) 
            ->color("rgba(180, 180, 180, 1)")
            ->backgroundcolor("rgba(180, 180, 180, 1)");
        }
        if(isset($value_khac)){
           $usersChart->dataset('Thể loại khác', 'bar', $value_khac) 
        ->color("rgba(240, 240, 240, 1)")
        ->backgroundcolor("rgba(240, 240, 240, 0.7)");
        }
       
        if($result){
            Session::put('admin_name', $result->customer_name);
            Session::put('admin_id', $result->customer_id);
            Session::put('admin_email', $result->customer_email);
            Session::put('admin_avatar', $result->customer_avatar);
             if($result->customer_status == 0){
            Session::put('message', 'Tài khoản này hiện tại đang bị khóa, vui lòng liên hệ quản trị viên theo số điện thoại 0982057893 để được tư vấn');
            return view('admin.login');
        }
        $noti = DB::table('tbl_noti')->where('customer_id', $result->customer_id)->orderBy('noti_id','DESC')->get();
            return view('admin.home')->with('sRate', $usersChart)
            ->with('tuoinhonhat', $tuoinhonhat)
            ->with('tuoilonnhat', $tuoilonnhat)
            ->with('gioitinhmuanhieunhat', $gioitinhmuanhieunhat)
            ->with('noti', $noti)
            ->with('result', $result)
            ->with('sotiengiaodich', $sotiengiaodich);
        }else{
            Session::put('message', 'Email hoặc mật khẩu không đúng');
            return view('admin.login');
        }
        return view('admin.login');
    }
    public function edit($admin_id){
         $result = DB::table('tbl_customer')->where('customer_id', Session::get('admin_id'))->first();
        $noti = DB::table('tbl_noti')->where('customer_id', $result->customer_id)->orderBy('noti_id','DESC')->get();
        $edit_admin = DB::table('tbl_customer')->where('customer_id',$admin_id)->get();
        
        return view('admin.edit')->with('edit_admin', $edit_admin)->with('noti', $noti)->with('result', $result);
    }
    public function update(Request $request, $admin_id){
        $data = array();
        $data['customer_password'] = md5($request->admin_password);
        $data['customer_name'] = trim($request->admin_name);
        $data['customer_phone'] = trim($request->admin_phone);
        $data['customer_birthday'] = trim($request->admin_birthday);
        $data['customer_gender'] = trim($request->admin_gender);
        $data['customer_address'] = trim($request->admin_address);
        $data['customer_status'] = trim($request->admin_status);
        $data['customer_cash'] = trim($request->admin_cash);
        $data['cash_used'] = trim($request->cash_used);
        $data['customer_sales'] = trim($request->admin_sales);
        $data['customer_publish'] = trim($request->admin_publish);
        $data['number_noti'] = trim($request->number_noti);
        $data['customer_date'] = trim($request->admin_date);
        $data['customer_update'] = time();

        if($data['customer_password'] == '' || $data['customer_name'] == '' || $data['customer_phone'] == '' || $data['customer_birthday'] == '' || $data['customer_gender'] == '' || $data['customer_status'] == '' || $data['customer_cash'] == '' || $data['cash_used'] == ''|| $data['customer_sales'] == '' || $data['customer_publish'] == '' || $data['number_noti'] == ''){
            Session::put('fail', 'Không được để trống bất kỳ trường nào!');
    
            return Redirect::to('/edit-admin/'.$admin_id);
        }else{
          
            $get_image = $request->file('admin_avatar');
            if($get_image){
            $permited = array('jpg','jpeg', 'png', 'gif');
            $file_name = $_FILES['admin_avatar']['name'];
            $file_size = $_FILES['admin_avatar']['size'];
            $file_temp = $_FILES['admin_avatar']['tmp_name'];

            $div = explode('.', $file_name);
            $file_ext = strtolower(end($div));
            $unique_image = substr(md5(time()),0, 10).'.'.$file_ext;
            $get_image->move('public/uploads/customer/',$unique_image);
            $data['customer_avatar'] = $unique_image;
            DB::table('tbl_customer')->where('customer_id',$admin_id)->update($data);
            Session::put('success', 'Tài khoản quản trị đã được cập nhật');
    
            return Redirect::to('list-admin');
            }else{
                DB::table('tbl_customer')->where('customer_id',$admin_id)->update($data);
                Session::put('success', 'Tài khoản quản trị đã được cập nhật');
        
                return Redirect::to('list-admin');
            }
        }
    }

    public function delete($admin_id){
        $this_customer = DB::table('tbl_customer')->where('customer_id',$admin_id)->first();
        if($this_customer->customer_id == Session::get('admin_id')){
            Session::put('fail', 'Tài khoản quản trị hiện đang được sử dụng và bạn không thể xóa tài khoản lúc này');
            return Redirect::to('list-admin');
        }else{
            DB::table('tbl_customer')->where('customer_id',$admin_id)->delete();
            Session::put('success', 'Tài khoản quản trị đã được ẩn khỏi hệ thống');
            return Redirect::to('list-admin');
        }
       
    }
        public function lock($customer_id){
        $customer = DB::table('tbl_customer')->where('customer_id',$customer_id)->first();
        if($customer && $customer->customer_status==0){
            DB::table('tbl_customer')->where('customer_id',$customer_id)->update(['customer_status'=>1]);
            Session::put('success', 'Mở khóa tài khoản thành công');
            return Redirect::to('list-admin');
        }elseif($customer && $customer->customer_status==1){
            DB::table('tbl_customer')->where('customer_id',$customer_id)->update(['customer_status'=>0]);
            Session::put('success', 'Tài khoản đã được khóa');
            return Redirect::to('list-admin');
        }
    }
}