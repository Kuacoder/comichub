<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Illuminate\Support\Facades\Redirect;
session_start();

class CoverImageController extends Controller
{
    public function all(){
        $all_image = DB::table('tbl_coverimage')->paginate(6);
        // $all_customer = DB::table('tbl_customer')->get();
         $result = DB::table('tbl_customer')->where('customer_id', Session::get('admin_id'))->first();
        $noti = DB::table('tbl_noti')->where('customer_id', $result->customer_id)->orderBy('noti_id','DESC')->get();
        return view('admin.CoverImage.all')
        ->with('all_image', $all_image)->with('noti', $noti)->with('result', $result);
    }
    public function add(){
          $result = DB::table('tbl_customer')->where('customer_id', Session::get('admin_id'))->first();
        $noti = DB::table('tbl_noti')->where('customer_id', $result->customer_id)->orderBy('noti_id','DESC')->get();
        return view('admin.CoverImage.add')->with('noti', $noti)->with('result', $result);
    }
    public function add_coverimg_comic(Request $request){
        $session_id = Session::get('session_id');
        
        $data = array();
        $data['cover_img'] = $request->cover_img;
        
        $comic = DB::table('tbl_comic')->where('session_id',$session_id)->first();

        DB::table('tbl_comic')->where('session_id',$session_id)->update(['cover_img'=>$data['cover_img']]);
        
        Session::put('success', 'Truyện của bạn đã được thêm vào hệ thống');
        session_regenerate_id(true);
        return Redirect::to('/list-comic');
    }
    public function choose(){
        $all_image = DB::table('tbl_coverimage')->paginate(6);
        // $all_customer = DB::table('tbl_customer')->get();
         $result = DB::table('tbl_customer')->where('customer_id', Session::get('admin_id'))->first();
        $noti = DB::table('tbl_noti')->where('customer_id', $result->customer_id)->orderBy('noti_id','DESC')->get();
      
        return view('admin.CoverImage.choose')
        ->with('all_image', $all_image)->with('noti', $noti)->with('result', $result);
    }
    public function changestatus($coverimg_id){
        $cover_img = DB::table('tbl_coverimage')->where('coverimg_id',$coverimg_id)->first();
        if($cover_img && $cover_img->status==0){
            DB::table('tbl_coverimage')->where('coverimg_id',$coverimg_id )->update(['status'=>1]);
            Session::put('success', 'Ảnh bìa truyện đang được hiển thị');
            return Redirect::to('list-cover-image');
        }elseif($cover_img && $cover_img->status==1){
            DB::table('tbl_coverimage')->where('coverimg_id',$coverimg_id )->update(['status'=>0]);
            Session::put('fail', 'Ảnh bìa truyện sẽ không được hiển thị');
            return Redirect::to('list-cover-image');
        }
    }
    public function save(Request $request){
        $data = array();
        $data['status'] = 1;
        $get_image = $request->file('coverimg_picture');
        if($get_image){
            $permited = array('jpg','jpeg', 'png', 'gif');
            $file_name = $_FILES['coverimg_picture']['name'];
            $file_size = $_FILES['coverimg_picture']['size'];
            $file_temp = $_FILES['coverimg_picture']['tmp_name'];

            $div = explode('.', $file_name);
            $file_ext = strtolower(end($div));
            $unique_image = substr(md5(time()),0, 10).'.'.$file_ext;
            $get_image->move('public/uploads/coverimg',$unique_image);
            $data['coverimg_picture'] = $unique_image;
            DB::table('tbl_coverimage')->insert($data);
        Session::put('success','Thêm ảnh bìa truyện thành công');
        return Redirect::to('list-cover-image');
        }else{
            Session::put('fail','Vui lòng chọn một ảnh bìa!');
            return Redirect::to('add-cover-image');
        }
    }

    public function edit($coverimg_id){
        $all_coverimg = DB::table('tbl_coverimage')->where('coverimg_id', $coverimg_id)->get();
            $result = DB::table('tbl_customer')->where('customer_id', Session::get('admin_id'))->first();
        $noti = DB::table('tbl_noti')->where('customer_id', $result->customer_id)->orderBy('noti_id','DESC')->get();
        $manage_cover = view('admin.CoverImage.edit')
        ->with('all_coverimg', $all_coverimg)->with('noti', $noti)->with('result', $result);
        return view('admin.CoverImage.edit')
        ->with('all_coverimg', $all_coverimg)->with('noti', $noti)->with('result', $result);
    }
    public function update(Request $request, $coverimg_id){
        $data = array();
        $data['status'] = $request->status;
        $get_image = $request->file('coverimg_picture');
        if($get_image){
            $permited = array('jpg','jpeg', 'png', 'gif');
            $file_name = $_FILES['coverimg_picture']['name'];
            $file_size = $_FILES['coverimg_picture']['size'];
            $file_temp = $_FILES['coverimg_picture']['tmp_name'];

            $div = explode('.', $file_name);
            $file_ext = strtolower(end($div));
            $unique_image = substr(md5(time()),0, 10).'.'.$file_ext;
            $get_image->move('public/uploads/coverimg',$unique_image);
            $data['coverimg_picture'] = $unique_image;
            DB::table('tbl_coverimage')->where('coverimg_id',$coverimg_id)->update($data);
            Session::put('success','Ảnh bìa truyện đã được cập nhật');
            return Redirect::to('list-cover-image');
        }else{
            Session::put('fail','Vui lòng chọn ảnh bìa truyện!');
            return Redirect::to('update-cover-image/'.$coverimg_id);
        }
    }
    public function delete($coverimg_id){
            DB::table('tbl_coverimage')->where('coverimg_id',$coverimg_id)->delete();
            Session::put('success', 'ảnh bìa truyện đã ẩn khỏi hệ thống');
            return Redirect::to('list-cover-image');
    }
}