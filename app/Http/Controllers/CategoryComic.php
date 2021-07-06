<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Illuminate\Support\Facades\Redirect;
session_start();

class CategoryComic extends Controller
{
    //
    public function all(){
        $all_cate = DB::table('tbl_categorycomic')->orderBy('cate_id', 'desc')->get();
          $result = DB::table('tbl_customer')->where('customer_id', Session::get('admin_id'))->first();
        $noti = DB::table('tbl_noti')->where('customer_id', $result->customer_id)->orderBy('noti_id','DESC')->get();
        return view('admin.category.all')->with('all_cate', $all_cate)->with('noti', $noti)->with('result', $result);
    }

    public function add(){
           $result = DB::table('tbl_customer')->where('customer_id', Session::get('admin_id'))->first();
        $noti = DB::table('tbl_noti')->where('customer_id', $result->customer_id)->orderBy('noti_id','DESC')->get();
        return view('admin.category.add')->with('noti', $noti)->with('result', $result);
    }
    public function edit($cate_id){
            $result = DB::table('tbl_customer')->where('customer_id', Session::get('admin_id'))->first();
        $noti = DB::table('tbl_noti')->where('customer_id', $result->customer_id)->orderBy('noti_id','DESC')->get();
        $edit_cate = DB::table('tbl_categorycomic')->where('cate_id',$cate_id)->get();
        $manage_cate = view('admin.category.edit')->with('edit_cate', $edit_cate)->with('noti', $noti)->with('result', $result);
        return view('admin.category.edit')->with('edit_cate', $edit_cate)->with('noti', $noti)->with('result', $result);
    }
    public function changestatus($cate_id){
        $cate = DB::table('tbl_categorycomic')->where('cate_id',$cate_id)->first();
        if($cate && $cate->status==0){
            DB::table('tbl_categorycomic')->where('cate_id',$cate_id)->update(['status'=>1]);
            Session::put('success', 'Danh mục này sẽ được hiển thị');
            return Redirect::to('list-category');
        }elseif($cate && $cate->status==1){
            DB::table('tbl_categorycomic')->where('cate_id',$cate_id)->update(['status'=>0]);
            Session::put('fail', 'Danh mục này sẽ không được hiển thị lên website của bạn');
            return Redirect::to('list-category');
        }
    }

    public function save(Request $request){
        $data = array();
        $data['cate_name'] = trim($request->cate_name);
        $data['cate_desc'] = $request->cate_desc;
        $data['status'] = $request->status;
        if($data['cate_name'] == '' || $data['cate_desc']==''){
            Session::put('fail', 'Không được để trống bất kỳ trường nào!');
            return Redirect::to('add-category');
        }else{
            DB::table('tbl_categorycomic')->insert($data);
            Session::put('success', 'Danh mục đã được thêm vào hệ thống');
    
            return Redirect::to('list-category');
        }
       
    }
    public function update(Request $request, $cate_id){
        $data = array();
        $data['cate_name'] = trim($request->cate_name);
        $data['cate_desc'] = $request->cate_desc;

        if($data['cate_name'] == '' || $data['cate_desc']==''){
            Session::put('fail', 'Không được để trống bất kỳ trường nào!');
            return Redirect::to('edit-category/'.$cate_id);
        }else{
            DB::table('tbl_categorycomic')->where('cate_id',$cate_id)->update($data);
            Session::put('success', 'Cập nhật danh mục thành công');
    
            return Redirect::to('list-category');
        }
    }

    public function delete($cate_id){
        if($cate_id == 1 || $cate_id == 2){
            Session::put('fail', 'Bạn không thể xóa danh mục này!');
            return Redirect::to('list-category');
        }else{
            DB::table('tbl_categorycomic')->where('cate_id',$cate_id)->delete();
            Session::put('success', 'Danh mục đã được ẩn khỏi hệ thống');
            return Redirect::to('list-category');
        }
       
    }
    public function see_cate_client($cate_id){
       $all_comic =  DB::table('tbl_comic')->where('cate_id',$cate_id)->where('comic_status', 1)->where('display', 1)->orderBy('comic_id', 'DESC')->paginate(9);
       $this_cate =  DB::table('tbl_categorycomic')->where('cate_id',$cate_id)->first();
       $all_cate = DB::table('tbl_categorycomic')->where('status', 1)->orderBy('cate_id', 'desc')->get();
       $all_chapter = DB::table('tbl_chapter')->where('status', 1)->where('display', 1)->get();
       $this_customer = DB::table('tbl_customer')->where('customer_id', Session::get('customer_id'))->first();
        if($this_customer){
            $number_noti = $this_customer->number_noti;
        }else{
            $number_noti = 0; 
        }
        $number_comic =  DB::table('tbl_comic')->where('cate_id',$cate_id)->where('comic_status', 1)->where('display', 1)->count();
       return view('customer.category')->with('all_cate', $all_cate)->with('all_comic', $all_comic)->with('this_cate', $this_cate)->with('all_chapter', $all_chapter)->with('number_noti', $number_noti)->with('number_comic', $number_comic);
    }
}