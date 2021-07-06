<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Carbon\Carbon;
use Illuminate\Support\Facades\Redirect;
session_start();

class AuthorController extends Controller
{
    public function author_center(){
        return view('customer.author.center');
    }
    public function create(){
        $all_cate = DB::table('tbl_categorycomic')->get();
        $all_area = DB::table('tbl_area')->get();
        return view('customer.author.create_comic')->with('all_cate', $all_cate)->with('all_area', $all_area);
    }
    public function all($author_id){
        $all_comic = DB::table('tbl_comic')
        ->join('tbl_categorycomic','tbl_categorycomic.cate_id','=','tbl_comic.cate_id')
        ->join('tbl_customer','tbl_comic.author_id_comic','=','tbl_customer.customer_id')
        ->where('tbl_comic.author_id_comic',$author_id)
        ->get();
        foreach($all_comic as $key => $value){
            if($value->comic_id){
                return view('customer.author.allcomic')->with('all_comic', $all_comic);
            }else{
                return view('customer.author.allcomic');
            }
        } 
         return view('customer.author.allcomic'); 
    }
    public function choose_cover_image(){
        $all_image = DB::table('tbl_coverimage')->paginate(6);
        $this_customer = DB::table('tbl_customer')->where('customer_id',Session::get('customer_id'))->first();
        $this_publish = $this_customer->customer_publish;
        $total_publish = $this_publish + 1;
        DB::table('tbl_customer')->where('customer_id',Session::get('customer_id'))->update(['customer_publish'=>$total_publish]);
        return view('customer.author.choosecoverimage')->with('all_image', $all_image);
    }
    public function add_coverimg_comic(Request $request){
        $session_id = Session::get('session_id');
        $data = array();
        $data['cover_img'] = $request->cover_img;
        $comic = DB::table('tbl_comic')->where('session_id',$session_id)->first();

        DB::table('tbl_comic')->where('session_id',$session_id)->update(['cover_img'=>$data['cover_img']]);
        $all_admin = DB::table('tbl_customer')->where('customer_title',2)->get();
        foreach($all_admin as $key => $value){
            $so_noti_hientai = $value->number_noti;
            $tong_noti = $so_noti_hientai+1;
            DB::table('tbl_customer')->where('customer_id',$value->customer_id)->update(['number_noti'=>$tong_noti]);
            $data_noti = array();
            $data_noti['customer_id'] = $value->customer_id;
            $data_noti['day_create_noti'] = time();
            $data_noti['noti_content'] = trim('<a class="noidungthongbao" href="/list-comic">'.Session::get('customer_name').' đang chờ duyệt tác phẩm</a>');
            DB::table('tbl_noti')->insert($data_noti);
        }
        
        Session::put('success', 'Truyện mới của bạn đã được tạo thành công.');
        session_regenerate_id(true);
        return view('customer.author.create_comic_done');
    }
    public function save(Request $request){
        $data = array();
        $sId = session_id();
        $data['cate_id'] = $request->cate_id;
        $data['author_id_comic'] = $request->author_id;
        $data['session_id'] = $sId;
        $data['comic_name'] = $request->comic_name;
        $data['comic_gender'] = $request->comic_gender;
        $data['comic_area'] = $request->comic_area;
        $data['cover_img'] = '';
        $data['comic_schedule'] = 0;
        $data['comic_view'] = 0;
        $comic_desc = $request->comic_desc;
        $comic_tag =  $request->tag;
        if( $comic_desc == null){
            $data['comic_desc'] = '';
        }else{
            $data['comic_desc']= $comic_desc;
        }
        if( $comic_tag == null){
            $data['tag'] = '';
        }else{
            $data['tag']= $comic_tag;
        }
        
        $data['comic_content'] = $request->comic_content;
        $data['comic_status'] = $request->status;
        $data['display'] = $request->display;
        
        $data['day_create'] = time();
        $data['day_update'] = '';
        $data['comic_price'] = 0;
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
        return Redirect::to('/choose-cover-image-client');
        }
        $data['comic_img'] = '';
        Session::put('session_id', $sId);
        DB::table('tbl_comic')->insert($data);
        return Redirect::to('/choose-cover-image');
    }

    public function view_add_chapter($comic_id){
        $this_comic = DB::table('tbl_comic')->where('comic_id',$comic_id)->first();
        return view('customer.author.add_chapter_client')->with('this_comic', $this_comic);
    }

    public function view_list_chapter($comic_id){
        $all_chapter = DB::table('tbl_chapter')->where('comic_id',$comic_id)->get();
        $this_comic = DB::table('tbl_comic')->where('comic_id',$comic_id)->first();
       
        return view('customer.author.list_chapter')->with('all_chapter', $all_chapter)->with('this_comic', $this_comic);
    }
    public function delete_chapter($chapter_id, $comic_id){
        $this_chapter = DB::table('tbl_chapter')->where('chapter_id',$chapter_id)->first();
        DB::table('tbl_chapter')->where('chapter_id',$chapter_id)->delete();
       
        DB::table('tbl_contentchapter')->where('session_chapter',$this_chapter->session_chapter)->delete();
        Session::put('success', 'Chương này đã được xóa thành công.');
        $all_chapter = DB::table('tbl_chapter')->where('comic_id',$comic_id)->get();
        $this_comic = DB::table('tbl_comic')->where('comic_id',$comic_id)->first();
    
        return view('customer.author.list_chapter')->with('all_chapter', $all_chapter)->with('this_comic', $this_comic);
    }

    public function add_chapter(Request $request){
        $data = array();
        $sId = session_id();
        $data['comic_id'] = $request->comic_id;
        $data['author_id_chapter'] = $request->author_id;
        $data['chapter_name'] = $request->chapter_name;
        $chapter_desc = $request->chapter_desc;
        if($chapter_desc == null){
            $data['chapter_desc'] = '';
        }else{
            $data['chapter_desc'] = $chapter_desc;
        }
        $data['status'] = 0;
        $data['display'] = 1;
        $data['numberical_order'] = 0;
        $data['chapter_price'] = $request->chapter_price;
        $data['day_create'] = time();
        $data['day_update'] = '';
        $data['session_chapter'] = $sId;
        $get_image = $request->file('chapter_img');
        if($get_image){
            $data1 = array();
             $i = 0;
            foreach($get_image as $image){
               $i++;
                    }
                 if($i>6){
                       Session::put('fail','Vui lòng chọn tối đa 6 ảnh!');
                        return Redirect::to('/view-add-chapter/'.$data['comic_id']);
                       
                    }else{
                         foreach($get_image as $image){
                $get_name_image = $image->getClientOriginalName();
                $name_image = current(explode('.',$get_name_image));
                $new_image = $name_image.rand(0,99).'.'.$image->getClientOriginalExtension();
                $image->move('public/uploads/chapter',$new_image);
                $data1['session_chapter'] = $sId;
                $data1['chapter_img'] = $new_image;
                DB::table('tbl_contentchapter')->insert($data1);
                         }
            }
            $all_admin = DB::table('tbl_customer')->where('customer_title',2)->get();
            foreach($all_admin as $key => $value){
                $so_noti_hientai = $value->number_noti;
                $tong_noti = $so_noti_hientai+1;
                 DB::table('tbl_customer')->where('customer_id',$value->customer_id)->update(['number_noti'=>$tong_noti]);
                $data_noti = array();
                $data_noti['customer_id'] = $value->customer_id;
                $data_noti['day_create_noti'] = time();
                $data_noti['noti_content'] = trim('<a class="noidungthongbao" href="/list-chapter/'.$request->comic_id.'">'.Session::get('customer_name').' đang chờ duyệt chương</a>');
                DB::table('tbl_noti')->insert($data_noti);
            }
            DB::table('tbl_chapter')->insert($data);
            session_regenerate_id(true);
            Session::put('success','Chương mới của bạn đang được tạo vui lòng chờ duyệt!');
            return Redirect::to('/list-chapter-client/'.$data['comic_id']);
        }else{
            return Redirect::to('/list-chapter-client/'.$data['comic_id']);
        }
    }

    public function view_update_chapter($chapter_id, $comic_id){
        $this_comic = DB::table('tbl_comic')->where('comic_id',$comic_id)->first();
        $this_chapter = DB::table('tbl_chapter')->where('chapter_id',$chapter_id)->first();
        $all_content_chapter =  DB::table('tbl_contentchapter')->where('session_chapter',$this_chapter->session_chapter)->orderBy('chaptercontent_id', 'ASC')->get();
        return view('customer.author.edit_chapter')->with('this_chapter', $this_chapter)->with('this_comic', $this_comic)->with('all_content_chapter', $all_content_chapter);
    }


    public function update_chapter(Request $request,$chapter_id){
        $data = array();
         $sid = $request->sid;
        $data['comic_id'] = $request->comic_id;
        $data['author_id_chapter'] = $request->author_id;
        $data['chapter_name'] = $request->chapter_name;
        $chapter_desc = $request->chapter_desc;
        if($chapter_desc == null){
            $data['chapter_desc'] = '';
        }else{
            $data['chapter_desc'] = $chapter_desc;
        }
        $data['status'] = $request->status;
        $data['display'] = $request->display;
        $data['numberical_order'] = $request->numberical_order;
        $data['chapter_price'] = trim($request->chapter_price);
        $data['day_create'] = $request->day_create;
        $data['day_update'] = time();
       if($data['chapter_name'] == '' || $data['chapter_price'] == null){
             Session::put('fail','Vui lòng không để trống bất kỳ trường nào!');
            return Redirect::to('/edit-chapter-client/'.$chapter_id.'/'.$data['comic_id']);
        }else{
            $get_image = $request->file('chapter_img_more');
            if($get_image){
                $data1 = array();
                   $i = 0;
            foreach($get_image as $image){
               $i++;
                    }
                 if($i>6){
                       Session::put('fail','Vui lòng chọn tối đa 6 ảnh!');
                        return Redirect::to('/edit-chapter-client/'.$chapter_id.'/'.$data['comic_id']);
                       
                    }else{
                         foreach($get_image as $image){
                
                    $get_name_image = $image->getClientOriginalName();
                    $name_image = current(explode('.',$get_name_image));
                    $new_image = $name_image.rand(0,99).'.'.$image->getClientOriginalExtension();
                    $image->move('public/uploads/chapter/',$new_image);
                    $data1['session_chapter'] = $sid;
                    $data1['chapter_img'] = $new_image;
                    DB::table('tbl_contentchapter')->insert($data1);}
                }
                DB::table('tbl_chapter')->where('chapter_id',$chapter_id)->update($data);
                Session::put('success','Bạn đã cập nhật chương thành công');
                return Redirect::to('/list-chapter-client/'.$data['comic_id']);
            }elseif($get_image == ''){
                 DB::table('tbl_chapter')->where('chapter_id',$chapter_id)->update($data);
                Session::put('success','Bạn đã cập nhật chương thành công');
                return Redirect::to('/list-chapter-client/'.$data['comic_id']);
            }
        }
    }

    public function delete_comic($comic_id){
        DB::table('tbl_comic')->where('comic_id',$comic_id)->delete();
        Session::put('success', 'Truyện này đã được xóa thành công.');
        return Redirect::to('list-comic-author/'.Session::get('customer_id'));
    }
    public function view_update_comic($comic_id){
        $this_comic = DB::table('tbl_comic')->where('comic_id',$comic_id)->first();
        $all_cate = DB::table('tbl_categorycomic')->get();
        $all_area = DB::table('tbl_area')->get();
        return view('customer.author.edit_comic')->with('this_comic', $this_comic)->with('all_cate', $all_cate)->with('all_area', $all_area);
    }
    public function view_update_coverimg_comic($comic_id){
        $this_comic = DB::table('tbl_comic')->where('comic_id',$comic_id)->first();
        $all_image = DB::table('tbl_coverimage')->get();
        return view('customer.author.update_coverimg_comic')->with('this_comic', $this_comic)->with('all_image', $all_image);
    }
    public function update_coverimg_comic(Request $reques, $comic_id){
        DB::table('tbl_comic')->where('comic_id',$comic_id)->update(['cover_img'=>$reques->cover_img]);
        Session::put('success', 'Truyện của bạn đã được cập nhật thành công.');
        return view('customer.author.update_comic_done');
    }

    public function update_comic(Request $request, $comic_id){
        $data = array();
        $data['cate_id'] = $request->cate_id;
        $data['author_id_comic'] = $request->author_id;
        $data['session_id'] = $request->session_id;
        $data['comic_name'] = $request->comic_name;
        $data['comic_gender'] = $request->comic_gender;
        $data['comic_area'] = $request->comic_area;
        $data['comic_schedule'] = $request->comic_schedule;
        $data['cover_img'] = $request->cover_img;
        $data['comic_desc'] = $request->comic_desc;
        $data['comic_content'] = $request->comic_content;
        $data['tag'] = $request->tag;
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
           
            return Redirect::to('edit-coverimg-comic-client/'.$comic_id);
        }else{
            DB::table('tbl_comic')->where('comic_id',$comic_id)->update($data);
           
            return Redirect::to('edit-coverimg-comic-client/'.$comic_id);
        }
    }
}