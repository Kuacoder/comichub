<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Illuminate\Support\Facades\Redirect;
session_start();

class ComicController extends Controller
{
    public function all(){
        $all_cate = DB::table('tbl_categorycomic')->get();
        $result = DB::table('tbl_customer')->where('customer_id', Session::get('admin_id'))->first();
        $noti = DB::table('tbl_noti')->where('customer_id', $result->customer_id)->orderBy('noti_id','DESC')->get();
        $all_comic = DB::table('tbl_comic')
        ->join('tbl_customer','tbl_comic.author_id_comic','=','tbl_customer.customer_id')
        ->join('tbl_categorycomic','tbl_categorycomic.cate_id','=','tbl_comic.cate_id')
        ->orderBy('comic_id', 'desc')->paginate(6);
        return  view('admin.comic.all')
        ->with('all_comic', $all_comic)
        ->with('all_cate', $all_cate)
        ->with('noti', $noti)->with('result', $result);
    }
   
    public function add(){
         $result = DB::table('tbl_customer')->where('customer_id', Session::get('admin_id'))->first();
        $noti = DB::table('tbl_noti')->where('customer_id', $result->customer_id)->orderBy('noti_id','DESC')->get();
        $all_cate = DB::table('tbl_categorycomic')->get();
        return view('admin.comic.add')->with('all_cate', $all_cate)->with('noti', $noti)->with('result', $result);
    }
    public function edit($comic_id){
         $result = DB::table('tbl_customer')->where('customer_id', Session::get('admin_id'))->first();
        $noti = DB::table('tbl_noti')->where('customer_id', $result->customer_id)->orderBy('noti_id','DESC')->get();
        $all_cate = DB::table('tbl_categorycomic')->get();
        $edit_comic = DB::table('tbl_comic')->where('comic_id',$comic_id)->get();
      
        return view('admin.comic.edit')->with('all_cate', $all_cate)->with('edit_comic', $edit_comic)->with('noti', $noti)->with('result', $result);
    }
    public function display($comic_id){
        $comic = DB::table('tbl_comic')->where('comic_id',$comic_id)->first();
        if($comic && $comic->display==1){
            DB::table('tbl_comic')->where('comic_id',$comic_id)->update(['display'=>0]);
            Session::put('fail', 'Truyện tranh này sẽ không được hiển thị');
            return Redirect::to('list-comic');
        }else{
            DB::table('tbl_comic')->where('comic_id',$comic_id)->update(['display'=>1]);
            Session::put('success', 'Truyện tranh này đã được hiển thị');
            return Redirect::to('list-comic');
        }
    }
    public function approved($comic_id){
        $comic = DB::table('tbl_comic')->where('comic_id',$comic_id)->first();
        if($comic && $comic->comic_status==0){
            DB::table('tbl_comic')->where('comic_id',$comic_id)->update(['comic_status'=>1]);
            Session::put('success', 'Truyện tranh đã được duyệt');
            return Redirect::to('list-comic');
        }
    }

    public function save(Request $request){
        $data = array();
        $sId = session_id();
        $data['cate_id'] = $request->cate_id;
        $data['author_id_comic'] = $request->author_id;
        $data['session_id'] = $sId;
        $data['comic_name'] = trim($request->comic_name);
        $data['comic_gender'] = $request->comic_gender;
        $data['comic_area'] = $request->comic_area;
        $data['cover_img'] = '';
        $data['comic_schedule'] = 0;
        $data['comic_view'] = 0;
        $comic_desc = $request->comic_desc;
        if($comic_desc == ''){
            $data['comic_desc'] = '';
        }else{
            $data['comic_desc'] = $comic_desc;
        }
        $data['comic_content'] = $request->comic_content;
        $data['comic_status'] = $request->status;
        $data['display'] = $request->display;
        $tag = $request->tag;
        if($tag == null){
            $data['tag'] = '';
        }else{
            $data['tag'] = $tag;
        }
        $data['day_create'] = time();
        $data['day_update'] = '';
        $data['comic_price'] = $request->comic_price;
        if($data['comic_name'] == '' || $data['comic_content'] == '' || $data['cate_id'] == 0){
            Session::put('fail', 'Không được để trống bất kỳ trường nào!');
            return Redirect::to('/add-comic');
        }else{
            $get_image = $request->file('comic_img');
            if($get_image){
                $permited = array('jpg','jpeg', 'png', 'gif');
                $file_name = $_FILES['comic_img']['name'];
                $file_size = $_FILES['comic_img']['size'];
                $file_temp = $_FILES['comic_img']['tmp_name'];
    
                $div = explode('.', $file_name);
                $file_ext = strtolower(end($div));
                $unique_image = substr(md5(time()),0, 10).'.'.$file_ext;
                $get_image->move('public/uploads/comic',$unique_image);
                $data['comic_img'] = $unique_image;
                DB::table('tbl_comic')->insert($data);
                Session::put('session_id', $sId);
                return Redirect::to('/choose-cover-image');
            }elseif($get_image == ''){
                Session::put('fail', 'Vui lòng chọn ảnh đại diện cho truyện của bạn!');
                return Redirect::to('/add-comic');
            }
        }
    }
    public function update(Request $request, $comic_id){
        $data = array();
        $data['cate_id'] = $request->cate_id;
        $data['comic_name'] = $request->comic_name;
        $comic_desc = $request->comic_desc;
        if($comic_desc == ''){
            $data['comic_desc'] = '';
        }else{
            $data['comic_desc'] = $comic_desc;
        }
        $data['comic_content'] = $request->comic_content;
        $data['day_update'] = time();
        $tag = $request->tag;
        if($tag == null){
            $data['tag'] = '';
        }else{
            $data['tag'] = $tag;
        }
        $this_comic = DB::table('tbl_comic')->where('comic_id',$comic_id)->first();
        $this_image_comic = $this_comic->comic_img;
        if($data['comic_name'] == '' || $data['comic_content'] == ''){
            Session::put('fail', 'Không được để trống bất kỳ trường nào!');
            return Redirect::to('edit-comic/'.$comic_id);
        }else{
            $get_image = $request->file('comic_img');
            if($get_image){
                $permited = array('jpg','jpeg', 'png', 'gif');
                $file_name = $_FILES['comic_img']['name'];
                $file_size = $_FILES['comic_img']['size'];
                $file_temp = $_FILES['comic_img']['tmp_name'];
    
                $div = explode('.', $file_name);
                $file_ext = strtolower(end($div));
                $unique_image = substr(md5(time()),0, 10).'.'.$file_ext;
                $get_image->move('public/uploads/comic',$unique_image);
                $data['comic_img'] = $unique_image;
                DB::table('tbl_comic')->where('comic_id',$comic_id)->update($data);
                Session::put('success','Truyện của bạn đã được cập nhật');
                return Redirect::to('list-comic');
            }elseif($get_image == ''){
                $data['comic_img'] = $this_image_comic;
                DB::table('tbl_comic')->where('comic_id',$comic_id)->update($data);
                Session::put('success','Truyện của bạn đã được cập nhật');
                return Redirect::to('list-comic');
            }
        }
    }

    public function delete($comic_id){
        DB::table('tbl_comic')->where('comic_id',$comic_id)->delete();
        Session::put('success', 'Truyện này sẽ không được hiển thị');
        return Redirect::to('list-comic');
    }
    public function back_to_add($session_id){
        DB::table('tbl_comic')->where('session_id',$session_id)->delete();
        return Redirect::to('add-comic');
    }
    public function back_to_add_client($session_id){
        DB::table('tbl_comic')->where('session_id',$session_id)->delete();
        return Redirect::to('create-comic-client');
    }

    public function searchComic(Request $request){
        $data = array();
        $data['cate_id'] = $request->cate_id;
        $data['comic_name'] = $request->comic_name;
        $cate_phantrang = $request->cate_id;
        $comic_phantrang = $request->comic_name;
        $tranghientai_vip = 1;
        $all_comic = DB::table('tbl_comic')
        ->join('tbl_customer','tbl_comic.author_id_comic','=','tbl_customer.customer_id')
        ->join('tbl_categorycomic','tbl_categorycomic.cate_id','=','tbl_comic.cate_id')
        ->where('status',1)
        ->where('display',1)
        ->where('tbl_comic.comic_name','LIKE','%'.$data['comic_name'].'%')
        ->where('tbl_comic.cate_id', $data['cate_id'])
        ->orderBy('tbl_comic.comic_id', 'desc')
        ->get();
          $tongsotruyen_vip = DB::table('tbl_comic')
        ->join('tbl_customer','tbl_comic.author_id_comic','=','tbl_customer.customer_id')
        ->join('tbl_categorycomic','tbl_categorycomic.cate_id','=','tbl_comic.cate_id')
        ->where('tbl_comic.comic_name','LIKE','%'.$data['comic_name'].'%')
        ->where('tbl_comic.cate_id', $data['cate_id'])
        ->orderBy('tbl_comic.comic_id', 'desc')
        ->get();
        $all_cate = DB::table('tbl_categorycomic')->where('cate_id', $data['cate_id'])->get();
        $all_cate_search = DB::table('tbl_categorycomic')->get();
        $result = DB::table('tbl_customer')->where('customer_id', Session::get('admin_id'))->first();
        $noti = DB::table('tbl_noti')->where('customer_id', $result->customer_id)->orderBy('noti_id','DESC')->get();
        foreach($all_comic as $key => $comic){
            $all_customer= DB::table('tbl_customer')->where('customer_id',$comic->author_id_comic)->get();

            return view('admin.comic.search')
            ->with('all_customer', $all_customer)
            // ->with('all_sustomer', $all_customer)
            ->with('all_cate', $all_cate)
            ->with('all_comic', $all_comic)
            ->with('tongsotruyen_vip', $tongsotruyen_vip)
            ->with('cate_phantrang', $cate_phantrang)
            ->with('comic_phantrang', $comic_phantrang)
            ->with('tranghientai_vip', $tranghientai_vip)
            ->with('result', $result)
            ->with('noti', $noti)
            ->with('all_cate_search', $all_cate_search);
        }
    }
    public function phantrang($cate_id , $comic_name, $trang){
        $sotruyen = 6 * $trang;
         $cate_phantrang = $cate_id;
        $comic_phantrang = $comic_name;
        $tranghientai_vip = $trang;
        $all_comic = DB::table('tbl_comic')
        ->join('tbl_customer','tbl_comic.author_id_comic','=','tbl_customer.customer_id')
        ->join('tbl_categorycomic','tbl_categorycomic.cate_id','=','tbl_comic.cate_id')
        ->where('tbl_comic.comic_name','LIKE','%'.$comic_name.'%')
        ->where('tbl_comic.cate_id', $cate_id)
        ->orderBy('tbl_comic.comic_id', 'desc')
        ->offset($sotruyen)
        ->limit(6)
        ->get();
         $tongsotruyen_vip = DB::table('tbl_comic')
        ->join('tbl_customer','tbl_comic.author_id_comic','=','tbl_customer.customer_id')
        ->join('tbl_categorycomic','tbl_categorycomic.cate_id','=','tbl_comic.cate_id')
        ->where('tbl_comic.comic_name','LIKE','%'.$comic_name.'%')
        ->where('tbl_comic.cate_id', $cate_id)
        ->orderBy('tbl_comic.comic_id', 'desc')
        ->get();
        $all_cate = DB::table('tbl_categorycomic')->where('cate_id', $cate_id)->get();
        $all_cate_search = DB::table('tbl_categorycomic')->get();
         $result = DB::table('tbl_customer')->where('customer_id', Session::get('admin_id'))->first();
        $noti = DB::table('tbl_noti')->where('customer_id', $result->customer_id)->orderBy('noti_id','DESC')->get();
        foreach($all_comic as $key => $comic){
            $all_customer= DB::table('tbl_customer')->where('customer_id',$comic->author_id_comic)->get();

            return view('admin.comic.search')
            ->with('all_customer', $all_customer)
            // ->with('all_sustomer', $all_customer)
            ->with('all_cate', $all_cate)
            ->with('all_comic', $all_comic)
            ->with('tongsotruyen_vip', $tongsotruyen_vip)
            ->with('cate_phantrang', $cate_phantrang)
            ->with('comic_phantrang', $comic_phantrang)
            ->with('tranghientai_vip', $tranghientai_vip)
            ->with('result', $result)
            ->with('noti', $noti)
            ->with('all_cate_search', $all_cate_search);
        }
    }
    public function visit($comic_id){
        $this_comic = DB::table('tbl_comic')
        ->join('tbl_categorycomic','tbl_categorycomic.cate_id','=','tbl_comic.cate_id')
        ->join('tbl_customer','tbl_customer.customer_id','=','tbl_comic.author_id_comic')
        ->where('tbl_comic.comic_id',$comic_id)->paginate(1);
        $this_comic1 = DB::table('tbl_comic')
        ->join('tbl_categorycomic','tbl_categorycomic.cate_id','=','tbl_comic.cate_id')
        ->join('tbl_customer','tbl_customer.customer_id','=','tbl_comic.author_id_comic')
        ->where('tbl_comic.comic_id',$comic_id)->count();
        if($this_comic1 == 0){
            Session::put('fail', 'Truyện hiện tại đang bị khóa hoặc có thể đã bị xóa bởi tác giả!');
            return Redirect::to('/');
        }else{
            $all_cate = DB::table('tbl_categorycomic')->get();
            foreach ($this_comic as $key => $comic){
                $cate_id = $comic->cate_id;
                $comic_id = $comic->comic_id;
                $author_id = $comic->author_id_comic;
            }
            $all_comment = DB::table('tbl_comment')
            ->join('tbl_customer','tbl_customer.customer_id','=','tbl_comment.customer_id')
            ->where('tbl_comment.comic_id',$comic_id)->get();
            $rating_comic = DB::table('tbl_rating')->where('comic_id', $comic_id)->avg('rating');
            $number_rating = DB::table('tbl_rating')->where('comic_id', $comic_id)->count();
            $rating = round($rating_comic);
            $relate_comic = DB::table('tbl_comic')
            ->where('tbl_comic.cate_id', $cate_id)
            ->where('comic_status', 1)->where('display', 1)
            ->whereNotIn('tbl_comic.comic_id',[$comic_id])
            ->paginate(5);
            $allcomic_author = DB::table('tbl_comic')
            ->where('tbl_comic.author_id_comic', $author_id)
            ->where('comic_status', 1)->where('display', 1)
            ->whereNotIn('tbl_comic.comic_id',[$comic_id])
            ->paginate(25);
            $relate_comic_bestsale = DB::table('tbl_comic')
            ->where('comic_status', 1)->where('display', 1)
            ->whereNotIn('tbl_comic.comic_id',[$comic_id])
            ->orderBy('comic_schedule','DESC')
            ->paginate(4);

            $newcomic_author = DB::table('tbl_comic')
            ->where('tbl_comic.author_id_comic', $author_id)
            ->where('comic_status', 1)->where('display', 1)
            ->orderBy('comic_id','DESC')
            ->first();

            $comic_bestview = DB::table('tbl_comic')
            ->where('comic_status', 1)->where('display', 1)
            ->orderBy('comic_view','DESC')
            ->paginate(10);

            if(Session::get('customer_id') != null){
                $this_customer = DB::table('tbl_customer')->where('customer_id', Session::get('customer_id'))->first();
                $number_noti = $this_customer->number_noti;
            }else{
                $number_noti = 0;
            }
            return view('customer.visitcomic')->with('this_comic', $this_comic)->with('all_cate', $all_cate)->with('relate_comic', $relate_comic)->with('rating', $rating)->with('rating_comic', $rating_comic)->with('all_comment', $all_comment)->with('number_rating', $number_rating)->with('relate_comic_bestsale', $relate_comic_bestsale)->with('comic_bestview', $comic_bestview)->with('allcomic_author', $allcomic_author)->with('newcomic_author', $newcomic_author)->with('number_noti', $number_noti);
        }
    }
    public function read($comic_id){
        $this_chapter = DB::table('tbl_chapter')->where('comic_id', $comic_id)->where('display', 1)->where('status', 1)->first();
        $all_chapter =  DB::table('tbl_chapter')->where('comic_id', $comic_id)->where('display', 1)->where('status', 1)->get();
        $all_comic =  DB::table('tbl_comic')->where('comic_status', 1)->where('display', 1)->get();
        $this_comic =  DB::table('tbl_comic')->where('comic_id', $comic_id)->where('comic_status', 1)->where('display', 1)->first();
        
        if($this_chapter != null){
            $curent_chapter_id = $this_chapter->chapter_id;
            
        }else{
            $curent_chapter_id = -1;
        }
        if(Session::get('customer_id') != null){
            $this_customer = DB::table('tbl_customer')->where('customer_id', Session::get('customer_id'))->first();
            $number_noti = $this_customer->number_noti;
        }else{
            $number_noti = 0;
        }
        if($this_chapter == null){
            Session::put('fail', 'Hiện tại bộ truyện này chưa có sẵn để đọc chúng tôi sẽ liên hệ tác giả để tác giả cập nhật sớm! Xin lỗi vì sự bất tiện này :(');
            return Redirect::to('/visit-comic/'.$comic_id);
        }else{
            $all_chapter_content =  DB::table('tbl_contentchapter')->where('session_chapter', $this_chapter->session_chapter)->orderBy('chaptercontent_id', 'ASC')->get();
        }
        $curent_chapter = DB::table('tbl_chapterunlock')->where('comic_id', $comic_id)->where('chapter_id', $curent_chapter_id)->where('customer_id', Session::get('customer_id'))->first();
        $this_customer = DB::table('tbl_customer')->where('customer_id', Session::get('customer_id'))->first();
        return view('customer.readcomic')->with('all_chapter', $all_chapter)->with('this_chapter', $this_chapter)->with('this_customer', $this_customer)->with('all_comic', $all_comic)->with('curent_chapter', $curent_chapter)->with('number_noti', $number_noti)->with('this_comic', $this_comic)->with('all_chapter_content', $all_chapter_content);
    }
    public function rating_comic($comic_id, $rating){
        if(Session::get('customer_id') == null){
            Session::put('fail', 'Vui lòng đăng nhập để đánh giá!');
            return Redirect::to('visit-comic/'.$comic_id);
        }else{
            $da_danh_gia = DB::table('tbl_rating')->where('customer_id', Session::get('customer_id'))->where('comic_id',$comic_id)->count();
            if($da_danh_gia > 0){
            Session::put('fail','Mỗi tài khoản chỉ có thể đánh giá một lần duy nhất cho một tác phẩm!');
            return redirect()->back();
        }
        else{
            $data = array();
            $data['customer_id'] = Session::get('customer_id');
            $data['comic_id'] = $comic_id;
            $data['rating'] = $rating;
            $rating =  DB::table('tbl_rating')->insert($data);
            return Redirect::to('visit-comic/'.$comic_id);
        }
        }
       
        
    }
    public function see_comic_gender($comic_gender){
        $all_comic =  DB::table('tbl_comic')->where('comic_gender',$comic_gender)->where('comic_status', 1)->where('display', 1)->orderBy('comic_id', 'DESC')->paginate(9);
        $number_comic =  DB::table('tbl_comic')->where('comic_gender',$comic_gender)->where('comic_status', 1)->where('display', 1)->count();
        foreach($all_comic as $key => $value){
            $this_gender = $value->comic_gender;
        }
        $this_customer = DB::table('tbl_customer')->where('customer_id', Session::get('customer_id'))->first();
        if($this_customer){
            $number_noti = $this_customer->number_noti;
        }else{
            $number_noti = 0; 
        }
        $all_cate = DB::table('tbl_categorycomic')->where('status', 1)->orderBy('cate_id', 'desc')->get();
        $all_chapter = DB::table('tbl_chapter')->where('status', 1)->where('display', 1)->get();
        return view('customer.comicgender')->with('all_cate', $all_cate)->with('all_comic', $all_comic)->with('this_gender', $this_gender)->with('all_chapter', $all_chapter)->with('number_noti', $number_noti)->with('number_comic', $number_comic);
    }
    public function see_all_comic(){
        $all_comic =  DB::table('tbl_comic')->where('comic_status', 1)->where('display', 1)->orderBy('comic_schedule', 'DESC')->paginate(9);
        $daban =  DB::table('tbl_chapterunlock')->get();
        $all_cate = DB::table('tbl_categorycomic')->where('status', 1)->orderBy('cate_id', 'desc')->get();
        $all_chapter = DB::table('tbl_chapter')->where('status', 1)->where('display', 1)->get();
        $this_customer = DB::table('tbl_customer')->where('customer_id', Session::get('customer_id'))->first();
        if($this_customer){
            $number_noti = $this_customer->number_noti;
        }else{
            $number_noti = 0; 
        }
        $number_comic =  DB::table('tbl_comic')->where('comic_status', 1)->where('display', 1)->count();
        return view('customer.allcomic')->with('all_cate', $all_cate)->with('number_noti', $number_noti)->with('all_comic', $all_comic)->with('all_chapter', $all_chapter)->with('daban', $daban)->with('number_comic', $number_comic);
    }
    public function search_comic_client(Request $request){
        $value = $request->value_search;
        $all_comic =  DB::table('tbl_comic')->where('comic_name', 'like', '%'.$value.'%')->where('comic_status', 1)->where('display', 1)->get();
        $all_cate = DB::table('tbl_categorycomic')->where('status', 1)->orderBy('cate_id', 'desc')->get();
        $all_chapter = DB::table('tbl_chapter')->where('status', 1)->where('display', 1)->get();
        $this_customer = DB::table('tbl_customer')->where('customer_id', Session::get('customer_id'))->first();
        if($this_customer){
            $number_noti = $this_customer->number_noti;
        }else{
            $number_noti = 0; 
        }
        $daban =  DB::table('tbl_chapterunlock')->get();
        $number_comic =  DB::table('tbl_comic')->where('comic_name', 'like', '%'.$value.'%')->where('comic_status', 1)->where('display', 1)->count();
        return view('customer.searchcomic')->with('all_cate', $all_cate)->with('number_noti', $number_noti)->with('all_comic', $all_comic)->with('all_chapter', $all_chapter)->with('number_comic', $number_comic)->with('daban', $daban);
    }
}