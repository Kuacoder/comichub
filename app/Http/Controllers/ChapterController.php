<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Illuminate\Support\Facades\Redirect;
session_start();

class ChapterController extends Controller
{
    public function all($comic_id){
         $result = DB::table('tbl_customer')->where('customer_id', Session::get('admin_id'))->first();
        $noti = DB::table('tbl_noti')->where('customer_id', $result->customer_id)->orderBy('noti_id','DESC')->get();
        $all_chapter = DB::table('tbl_chapter')->where('comic_id',$comic_id)->orderBy('chapter_id','DESC')->get();
        $all_comic = DB::table('tbl_comic')->where('comic_id',$comic_id)->get();
   
        return view('admin.chapter.all')
        ->with('all_chapter', $all_chapter)
        ->with('all_comic', $all_comic)->with('noti', $noti)->with('result', $result);
    }
   
    public function add($comic_id){
          $result = DB::table('tbl_customer')->where('customer_id', Session::get('admin_id'))->first();
        $noti = DB::table('tbl_noti')->where('customer_id', $result->customer_id)->orderBy('noti_id','DESC')->get();
        $all_comic = DB::table('tbl_comic')->where('comic_id',$comic_id)->get();
        return view('admin.chapter.add')
        ->with('all_comic', $all_comic)->with('noti', $noti)->with('result', $result);
    }
    public function edit($chapter_id, $comic_id){
        $result = DB::table('tbl_customer')->where('customer_id', Session::get('admin_id'))->first();
        $noti = DB::table('tbl_noti')->where('customer_id', $result->customer_id)->orderBy('noti_id','DESC')->get();
        $this_comic = DB::table('tbl_comic')->where('comic_id',$comic_id)->first();
        $this_chapter = DB::table('tbl_chapter')->where('chapter_id',$chapter_id)->first();
        $all_content_chapter =  DB::table('tbl_contentchapter')->where('session_chapter',$this_chapter->session_chapter)->orderBy('chaptercontent_id', 'ASC')->get();
      
        return view('admin.chapter.edit')
        ->with('this_comic', $this_comic)
        ->with('this_chapter', $this_chapter)
        ->with('all_content_chapter', $all_content_chapter)->with('noti', $noti)->with('result', $result);
    }
  
    public function approved($chapter_id, $comic_id){
        $result = DB::table('tbl_customer')->where('customer_id', Session::get('admin_id'))->first();
        $noti = DB::table('tbl_noti')->where('customer_id', $result->customer_id)->orderBy('noti_id','DESC')->get();
        $chapter = DB::table('tbl_chapter')->where('chapter_id',$chapter_id)->first();
        if($chapter && $chapter->status==0){
            DB::table('tbl_chapter')->where('chapter_id',$chapter_id)->update(['status'=>1]);
            Session::put('success', 'Duyệt thành công');
            $all_chapter = DB::table('tbl_chapter')->where('comic_id',$comic_id)->get();
            $all_comic = DB::table('tbl_comic')->where('comic_id',$comic_id)->get();
            return view('admin.chapter.all')
            ->with('all_chapter', $all_chapter)
            ->with('all_comic', $all_comic)->with('noti', $noti)->with('result', $result);
        }
    }

    public function save(Request $request){
        $data = array();
        $sId = session_id();
        $data['comic_id'] = $request->comic_id;
        $data['author_id_chapter'] = $request->author_id;
        $data['chapter_name'] = trim($request->chapter_name);
        $chapter_desc = $request->chapter_desc;
        if($chapter_desc == null){
            $data['chapter_desc'] = '';
        }else{
            $data['chapter_desc'] = $chapter_desc;
        }
        $data['status'] = 0;
        $data['display'] = 1;
        $data['numberical_order'] = 0;
        $data['chapter_price'] = trim($request->chapter_price);
        $data['day_create'] = time();
        $data['day_update'] = '';
        $data['session_chapter'] = $sId;
        if($data['chapter_name'] == '' || $data['chapter_price'] == ''){
            Session::put('fail', 'Không được để trống bất kỳ trường nào!');
            return Redirect::to('/add-chapter/'.$data['comic_id']);
        }else{
            $get_image = $request->file('chapter_img');
            if($get_image){
                $data1 = array();
                $i = 0;
                foreach($get_image as $image){
                    $i++;
                }
                 if($i>6){
                        Session::put('fail','bạn chỉ có thể tải lên tối đa là 6 nội dung!');
                        return Redirect::to('/add-chapter/'.$data['comic_id']);
                       
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
                DB::table('tbl_chapter')->insert($data);
                session_regenerate_id(true);
                Session::put('success','Chương truyện của bạn đã được thêm vào hệ thống');
                return Redirect::to('/list-chapter/'.$data['comic_id']);
            }elseif($get_image == ''){
                Session::put('fail','Vui lòng thêm nội dung cho truyện!');
                return Redirect::to('/add-chapter/'.$data['comic_id']);
            }
            
        }
       
    }
    public function update_chapter(Request $request, $chapter_id){
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
             Session::put('fail','Không được để trống bất kỳ trường nào');
            return Redirect::to('/edit-chapter/'.$chapter_id.'/'.$data['comic_id']);
        }else{
            $get_image = $request->file('chapter_img_more');
            if($get_image){
                $data1 = array();
                 $i = 0;
                foreach($get_image as $image){
                  $i++;
                    }
                 if($i>6){
                       Session::put('fail','Vui lòng tải tối đa 6 nội dung!');
                        return Redirect::to('/edit-chapter/'.$chapter_id.'/'.$data['comic_id']);
                       
                    }else{
                         foreach($get_image as $image){
                    $get_name_image = $image->getClientOriginalName();
                    $name_image = current(explode('.',$get_name_image));
                    $new_image = $name_image.rand(0,99).'.'.$image->getClientOriginalExtension();
                    $image->move('public/uploads/chapter/',$new_image);
                    $data1['session_chapter'] = $sid;
                    $data1['chapter_img'] = $new_image;
                    DB::table('tbl_contentchapter')->insert($data1);
                         }
                    }
                
                DB::table('tbl_chapter')->where('chapter_id',$chapter_id)->update($data);
                Session::put('success','Chương truyện của bạn đã được cập nhật');
                return Redirect::to('/list-chapter/'.$data['comic_id']);
            }elseif($get_image == ''){
                 DB::table('tbl_chapter')->where('chapter_id',$chapter_id)->update($data);
                Session::put('success','Chương truyện của bạn đã được cập nhật');
                return Redirect::to('/list-chapter/'.$data['comic_id']);
            }
        }
    }


    public function delete($chapter_id, $comic_id){
         $result = DB::table('tbl_customer')->where('customer_id', Session::get('admin_id'))->first();
        $noti = DB::table('tbl_noti')->where('customer_id', $result->customer_id)->orderBy('noti_id','DESC')->get();
        $this_chapter = DB::table('tbl_chapter')->where('chapter_id',$chapter_id)->first();
        DB::table('tbl_chapter')->where('chapter_id',$chapter_id)->delete();
        DB::table('tbl_contentchapter')->where('session_chapter',$this_chapter->session_chapter)->delete();
        Session::put('success', 'Chương truyện đã được ẩn khỏi hệ thống');
        $all_chapter = DB::table('tbl_chapter')->where('comic_id',$comic_id)->get();
        $all_comic = DB::table('tbl_comic')->where('comic_id',$comic_id)->get();
        return view('admin.chapter.all')
        ->with('all_chapter', $all_chapter)
        ->with('all_comic', $all_comic)->with('noti', $noti)->with('result', $result);
    }
    public function read($chapter_id){
        $this_chapter = DB::table('tbl_chapter')->where('chapter_id', $chapter_id)->where('display', 1)->where('status', 1)->first();
        $all_chapter =  DB::table('tbl_chapter')->where('comic_id', $this_chapter->comic_id)->where('display', 1)->where('status', 1)->get();
        $all_comic =  DB::table('tbl_comic')->where('comic_status', 1)->where('display', 1)->get();
        
        $chapter_unlock = DB::table('tbl_chapterunlock')->where('chapter_id', $chapter_id)->where('comic_id', $this_chapter->comic_id)->first();
        $this_comic = DB::table('tbl_comic')->where('comic_id', $this_chapter->comic_id)->first();
        $currentview = $this_comic->comic_view;
        $totalview = $currentview + 1;
        $this_customer = DB::table('tbl_customer')->where('customer_id', Session::get('customer_id'))->first();
         $curent_chapter = DB::table('tbl_chapterunlock')->where('comic_id', $this_comic->comic_id)->where('chapter_id', $this_chapter->chapter_id)->where('customer_id', Session::get('customer_id'))->first();
        if($this_customer){
            $number_noti = $this_customer->number_noti;
        }else{
            $number_noti = 0; 
        }
        if($this_chapter == null){
            Session::put('fail', 'Hiện tại bộ truyện này chưa có sẵn để đọc chúng tôi sẽ liên hệ tác giả để tác giả cập nhật sớm! Xin lỗi vì sự bất tiện này :(');
            return Redirect::to('/visit-comic/'. $this_chapter->comic_id);
        }else{
            $all_chapter_content =  DB::table('tbl_contentchapter')->where('session_chapter', $this_chapter->session_chapter)->orderBy('chaptercontent_id', 'ASC')->get();
        }
        DB::table('tbl_comic')->where('comic_id', $this_chapter->comic_id)->update(['comic_view' => $totalview]);
        if($chapter_unlock){
            return view('customer.readcomic')->with('number_noti', $number_noti)->with('all_chapter', $all_chapter)->with('this_chapter', $this_chapter)->with('all_comic', $all_comic)->with('this_customer', $this_customer)->with('chapter_unlock', $chapter_unlock)->with('this_comic', $this_comic)->with('all_chapter_content', $all_chapter_content)->with('curent_chapter', $curent_chapter);
        }else{
            $chapter_unlock = null;
            return view('customer.readcomic')->with('number_noti', $number_noti)->with('all_chapter', $all_chapter)->with('this_chapter', $this_chapter)->with('all_comic', $all_comic)->with('this_customer', $this_customer)->with('chapter_unlock', $chapter_unlock)->with('this_comic', $this_comic)->with('all_chapter_content', $all_chapter_content)->with('curent_chapter', $curent_chapter);
        }
    }
    public function unlock_chapter(Request $request){
        $data = array();
        $comic_id = $request->comic_id;
        $chapter_id = $request->chapter_id;
        $customer_id = $request->customer_id;

        $this_comic = DB::table('tbl_comic')->where('comic_id', $comic_id)->first();
        $this_author_comic = DB::table('tbl_customer')->where('customer_id', $this_comic->author_id_comic)->first();
        $this_chapter = DB::table('tbl_chapter')->where('chapter_id', $chapter_id)->first();
        $this_author_chapter = DB::table('tbl_customer')->where('customer_id', $this_chapter->author_id_chapter)->first();
        $this_buyer = DB::table('tbl_customer')->where('customer_id',$customer_id)->first();

        $data['chapter_id'] = $chapter_id;
        $data['comic_id'] = $comic_id;
        $data['customer_id'] = $customer_id;
        $data['comic_name'] = $this_comic->comic_name;
        $data['author_comic'] = $this_author_comic->customer_name;
        $data['chapter_name'] = $this_chapter->chapter_name;
        $data['author_chapter'] = $this_author_chapter->customer_name;
        $data['chapter_price'] = $this_chapter->chapter_price;
        $data['buyer'] = $this_buyer->customer_email;
        
        $data['day_create_order'] = date('Y-m-d',time());
        $current_comic_price = $this_comic->comic_price;
        $total_comic_price = $current_comic_price + $this_chapter->chapter_price;

        $comic_schedule = $this_comic->comic_schedule;
        $total_sale = $comic_schedule + 1;

        $numberical_order = $this_chapter->numberical_order;
        $total_numberical_order = $numberical_order + 1;

        $cash_used = $this_buyer->cash_used;
        $customer_cash = $this_buyer->customer_cash;

        $chapter_price = $request->chapter_price;
        $total_cash_used = $cash_used + $chapter_price;

        $total_cash = $customer_cash - $chapter_price;
 

        $author_cash = $this_author_chapter->customer_cash;
        $total_author_cash = $author_cash + $chapter_price;

      
        DB::table('tbl_chapterunlock')->insert($data);
        DB::table('tbl_customer')->where('customer_id', $customer_id)
        ->update(['cash_used'=> $total_cash_used]);
        DB::table('tbl_customer')->where('customer_id', $customer_id)-> update(['customer_cash'=> $total_cash]);
        DB::table('tbl_customer')->where('customer_id', $this_author_chapter->customer_id)->update(['customer_cash'=> $total_author_cash]);
        DB::table('tbl_chapter')->where('chapter_id', $this_chapter->chapter_id)->update(['numberical_order'=> $total_numberical_order]);
        DB::table('tbl_comic')->where('comic_id', $this_comic->comic_id)->update(['comic_schedule'=> $total_sale]);
        DB::table('tbl_comic')->where('comic_id', $this_comic->comic_id)->update(['comic_price'=> $total_comic_price]);
        return Redirect::to('/read-chapter/'. $this_chapter->chapter_id);
    }
}