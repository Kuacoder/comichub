<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use DB;
use Session;
use Illuminate\Support\Facades\Redirect;
session_start();

class CommentController extends Controller
{
    public function add_comment(Request $request){
        
        $data = array();
        $datanoti = array();
        $data['comment'] = $request->comment;
        $data['customer_id'] = $request->customer_id;
        $data['comment_date'] = time();
        $data['comic_id'] = $request->comic_id;
        $data['comment_parent_id'] = $request->comment_parent_id;
       
        $this_author = DB::table('tbl_customer')->where('customer_id', $request->author_id)->first();
        if(Session::get('customer_id') == null){
            Session::put('fail','Bạn phải đăng nhập trước khi bình luận!');
            return Redirect::to('/visit-comic/'.$data['comic_id']);
        }
       if($data['comment'] == null){
           Session::put('fail','Bạn không thể gửi bình luận ko có nội dung!');
           return Redirect::to('/visit-comic/'.$data['comic_id']);
       }
        if($data['comment_parent_id'] == 0 && $data['customer_id'] == $request->author_id){

            $data['comment_parent_id'] = 0;
            DB::table('tbl_comment')->insert($data);
            return Redirect::to('/visit-comic/'.$data['comic_id']);
        }elseif($data['comment_parent_id'] == 0 && $data['customer_id'] != $request->author_id){
            $this_customer = DB::table('tbl_customer')->where('customer_id', $request->customer_id)->first();

            $current_noti = $this_author->number_noti;
            $total_noti = $current_noti + 1;
    
            $datanoti['customer_id'] = $this_author->customer_id;

            $datanoti['noti_content'] = trim('<a class="noidungthongbao" href="/visit-comic/'.$request->comic_id.'"><p class="bold">'.$this_customer->customer_name.'</p> đã bình luận về truyện của bạn</a>');
            $datanoti['day_create_noti'] = time();
            DB::table('tbl_noti')->insert($datanoti);
            DB::table('tbl_customer')->where('customer_id', $this_author->customer_id)->update(['number_noti'=>$total_noti]);
            DB::table('tbl_comment')->insert($data);
            return Redirect::to('/visit-comic/'.$data['comic_id']);
        }
        if($data['customer_id'] == $this_author->customer_id){
            $parrent_comment = DB::table('tbl_comment')->where('comment_id', $request->comment_parent_id)->first();
            $customer_comment = DB::table('tbl_customer')->where('customer_id', $parrent_comment->customer_id)->first();
        
            $this_customer = DB::table('tbl_customer')->where('customer_id', $request->customer_id)->first();

            $current_noti = $customer_comment->number_noti;
            $total_noti = $current_noti + 1;
    
            $datanoti['customer_id'] = $customer_comment->customer_id;

            $datanoti['noti_content'] = trim('<a class="noidungthongbao" href="/visit-comic/'.$request->comic_id.'"><p class="bold">'.$this_customer->customer_name.'</p> đã trả lời bình luận của bạn</a>');
            $datanoti['day_create_noti'] = time();
            DB::table('tbl_noti')->insert($datanoti);
            DB::table('tbl_customer')->where('customer_id', $customer_comment->customer_id)->update(['number_noti'=>$total_noti]);
            DB::table('tbl_comment')->insert($data);
            return Redirect::to('/visit-comic/'.$data['comic_id']);
        }else{
            $parrent_comment = DB::table('tbl_comment')->where('comment_id', $request->comment_parent_id)->first();
            $customer_comment = DB::table('tbl_customer')->where('customer_id', $parrent_comment->customer_id)->first();
            $this_customer = DB::table('tbl_customer')->where('customer_id', $request->customer_id)->first();

            $current_noti = $this_author->number_noti;
            $total_noti = $current_noti + 1;
    
            $datanoti['customer_id'] = $request->author_id;
            $datanoti['noti_content'] = trim('<a class="noidungthongbao" href="/visit-comic/'.$request->comic_id.'"><p class="bold">'.$this_customer->customer_name.'</p> đã trả lời bình luận của bạn</a>');
            $datanoti['day_create_noti'] = time();
            DB::table('tbl_noti')->insert($datanoti);
            DB::table('tbl_customer')->where('customer_id', $request->author_id)->update(['number_noti'=>$total_noti]);
            DB::table('tbl_comment')->insert($data);
            return Redirect::to('/visit-comic/'.$data['comic_id']);
        }
       
    }
}