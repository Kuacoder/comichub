<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Charts\UserChart;
use DB;
use Session;
use Illuminate\Support\Facades\Redirect;
session_start();

class HomeController extends Controller
{
    public function index(){
        if(Session::get('admin_id') == null || Session::get('admin_id') == ''){
           return view('admin.login');
        }
        $result = DB::table('tbl_customer')->where('customer_id', Session::get('admin_id'))->first();
        $noti = DB::table('tbl_noti')->where('customer_id', $result->customer_id)->orderBy('noti_id','DESC')->get();
        $day = 0;
        $current_date = date('Y-m-d');
        $toi_thoidiem_hien_tai = date('y-m-d',time());
        $tu_ngay =  date('y-m-d',time() - (7 * 24 * 60 * 60));
      
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
        $tuoinhonhat = min($tuoi);
        $tuoilonnhat = max($tuoi);


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
           $usersChart->dataset('Tryện tranh khác', 'bar', $value_khac) 
        ->color("rgba(240, 240, 240, 1)")
        ->backgroundcolor("rgba(240, 240, 240, 0.7)");
        }
       
        return view('admin.home')->with('sRate', $usersChart)
        ->with('tuoinhonhat', $tuoinhonhat)
        ->with('tuoilonnhat', $tuoilonnhat)
        ->with('noti', $noti)->with('result', $result)
        ->with('gioitinhmuanhieunhat', $gioitinhmuanhieunhat)
        ->with('sotiengiaodich', $sotiengiaodich);
    }
    public function login(){
        return view('customer.login');
    }
    public function profile($admin_id){
        $result = DB::table('tbl_customer')->where('customer_id', Session::get('admin_id'))->first();
        $noti = DB::table('tbl_noti')->where('customer_id', $result->customer_id)->orderBy('noti_id','DESC')->get();
        $profile = DB::table('tbl_customer')->where('customer_id',$admin_id)->get();
        return view('admin.profile')->with('profile', $profile)->with('noti', $noti)->with('result', $result);
    }
    public function homepage(){
        $all_comic = DB::table('tbl_comic')->orderBy('comic_id', 'desc')->where('comic_status', 1)->where('display', 1)->get();
        $all_khuyennghi = DB::table('tbl_comic')->orderBy('comic_id', 'desc')->where('comic_status', 1)->where('display', 1)->paginate(32);
        $toanbo = DB::table('tbl_comic')->orderBy('comic_id', 'desc')->where('comic_status', 1)->where('display', 1)->paginate(16);
        $xephang = DB::table('tbl_comic')->orderBy('comic_schedule', 'desc')->where('comic_status', 1)->where('display', 1)->paginate(16);

        $all_cate = DB::table('tbl_categorycomic')->where('status', 1)->get();
        $banner_1 = DB::table('tbl_comic')->where('comic_status', 1)->where('display', 1)->orderBy('comic_id','DESC')->skip(0)->take(1)->get();
        $banner_2 = DB::table('tbl_comic')->where('comic_status', 1)->where('display', 1)->orderBy('comic_id','DESC')->skip(1)->take(5)->get();
        $banner_3 = DB::table('tbl_comic')->where('comic_status', 1)->where('display', 1)->orderBy('comic_id','DESC')->skip(6)->take(5)->get();
        $banchaynhat_8 = DB::table('tbl_comic')->where('comic_status', 1)->where('display', 1)->orderBy('comic_schedule', 'DESC')->skip(0)->take(8)->get();
        $banchaynhat_16 = DB::table('tbl_comic')->where('comic_status', 1)->where('display', 1)->orderBy('comic_schedule', 'DESC')->skip(8)->take(8)->get();
        $guoman = DB::table('tbl_comic')->where('cate_id',1)->where('comic_status', 1)->where('display', 1)->orderBy('comic_schedule', 'DESC')->paginate(16);
       

        $riman = DB::table('tbl_comic')->where('cate_id',2)->where('comic_status', 1)->where('display', 1)->orderBy('comic_schedule', 'DESC')->paginate(16);
    

        $comic_boy = DB::table('tbl_comic')->where('comic_gender',0)->where('comic_status', 1)->where('display', 1)->orderBy('comic_id', 'DESC')->paginate(6);
        $comic_girl = DB::table('tbl_comic')->where('comic_gender',1)->where('comic_status', 1)->where('display', 1)->orderBy('comic_id', 'DESC')->paginate(6);

        $toptieusai = DB::table('tbl_customer')->orderBy('cash_used', 'DESC')->where('customer_status', 1)->paginate(10);
        if(Session::get('customer_id') != null){
            $this_customer = DB::table('tbl_customer')->where('customer_id', Session::get('customer_id'))->first();
            $number_noti = $this_customer->number_noti;
        }else{
            $number_noti = 0;
        }
        
        return view('customer.home')
        ->with('all_comic', $all_comic)
        ->with('all_khuyennghi', $all_khuyennghi)
        ->with('toanbo', $toanbo)
        ->with('xephang', $xephang)
        ->with('banner_1', $banner_1)
        ->with('banner_2', $banner_2)
        ->with('banner_3', $banner_3)
        ->with('banchaynhat_8', $banchaynhat_8)
        ->with('banchaynhat_16', $banchaynhat_16)
        ->with('guoman', $guoman)
        ->with('riman', $riman)
        ->with('comic_boy', $comic_boy)
        ->with('comic_girl', $comic_girl)
        ->with('toptieusai', $toptieusai)
        ->with('number_noti', $number_noti)
        ->with('all_cate', $all_cate);
    }
    public function payment(){
        $result = DB::table('tbl_customer')->where('customer_id', Session::get('admin_id'))->first();
        $noti = DB::table('tbl_noti')->where('customer_id', $result->customer_id)->orderBy('noti_id','DESC')->get();
        $all_customer = DB::table('tbl_paymenthistory')
        ->join('tbl_customer','tbl_customer.customer_id','=','tbl_paymenthistory.customer_id')
        ->orderBy('payment_history_create_date', 'desc')->paginate(12);
        $toi_thoidiem_hien_tai = time();
        $tu_ngay =  (time() - (7 * 24 * 60 * 60));
        
        $tong_doanhthu = DB::table('tbl_paymenthistory')
        ->join('tbl_customer','tbl_customer.customer_id','=','tbl_paymenthistory.customer_id')
        ->whereBetween('tbl_paymenthistory.payment_history_create_date',[$tu_ngay,$toi_thoidiem_hien_tai])
        ->sum('menhgia');
        $dang_ngay = 'tuần qua';
        return view('admin.order.payment')->with('all_customer', $all_customer)->with('tong_doanhthu', $tong_doanhthu)->with('dang_ngay', $dang_ngay)->with('noti', $noti)->with('result', $result);
    }
    public function thongke_payment(){
        $result = DB::table('tbl_customer')->where('customer_id', Session::get('admin_id'))->first();
        $noti = DB::table('tbl_noti')->where('customer_id', $result->customer_id)->orderBy('noti_id','DESC')->get();
        $all_customer = DB::table('tbl_paymenthistory')
        ->join('tbl_customer','tbl_customer.customer_id','=','tbl_paymenthistory.customer_id')
        ->orderBy('payment_history_create_date', 'desc')->paginate(12);
        
        $tong_doanhthu = DB::table('tbl_paymenthistory')
        ->join('tbl_customer','tbl_customer.customer_id','=','tbl_paymenthistory.customer_id')
        ->sum('menhgia');
        $dang_ngay = 'tuần qua';
        return view('admin.order.payment')->with('all_customer', $all_customer)->with('tong_doanhthu', $tong_doanhthu)->with('noti', $noti)->with('result', $result);
    }
    
    public function profile_customer($customer_id){
        $customer_profile = DB::table('tbl_customer')->where('customer_id', $customer_id)->first();
        $truyendamua = DB::table('tbl_chapterunlock')->where('customer_id', $customer_id)->get();
        if(Session::get('customer_id') != null){
            $this_customer = DB::table('tbl_customer')->where('customer_id', Session::get('customer_id'))->first();
            $number_noti = $this_customer->number_noti;
        }else{
            $number_noti = 0;
        }
        $all_noti = DB::table('tbl_noti')->where('customer_id', Session::get('customer_id'))->orderBy('day_create_noti', 'DESC')->get();
        return view('customer.profile.profile')->with('customer_profile', $customer_profile)->with('number_noti', $number_noti)->with('all_noti', $all_noti)->with('truyendamua', $truyendamua);
    }
    public function view_add_profile($customer_id){
        $customer_profile = DB::table('tbl_customer')->where('customer_id', $customer_id )->first();
        
        return view('customer.profile.add')->with('customer_profile', $customer_profile);
    }
    public function process_payment_customer($customer_id, $payment_history_id){
        $profile = DB::table('tbl_customer')->where('customer_id',$customer_id)->get();
         $result = DB::table('tbl_customer')->where('customer_id', Session::get('admin_id'))->first();
        $noti = DB::table('tbl_noti')->where('customer_id', $result->customer_id)->orderBy('noti_id','DESC')->get();
        $this_payment = DB::table('tbl_paymenthistory')->where('payment_history_id',$payment_history_id)->first();
        return view('admin.order.processpayment')->with('profile', $profile)->with('this_payment', $this_payment)->with('noti', $noti)->with('result', $result);
    }
    public function xac_nhan_thanh_toan($customer_id, $payment_history_id){
        // $customer = DB::table('tbl_customer')->where('customer_id',$customer_id)->first();
        // $this_order = DB::table('tbl_paymenthistory')->where('payment_history_id',$payment_history_id)->first();
        // $number_noti = $customer->number_noti;
        // $current_number_noti = $number_noti + 1;

        // $data = array();
        // $data['customer_id'] = $customer_id;
        // $data['noti_content'] = 
        // trim('<a class="noidungthongbao">Tài khoản của bạn đã được cộng thêm '.$this_order->menhgia.' Nguyệt tinh</a>');
        // $data['day_create_noti'] = time();
        // DB::table('tbl_noti')->insert($data);
        // DB::table('tbl_customer')->where('customer_id',$customer_id)->update(['number_noti'=>$current_number_noti]);

        // if($customer){
        //    $curent_cash = $customer->customer_cash;
        // }
        // $add_cash =  $this_order->menhgia + $curent_cash;
        // DB::table('tbl_customer')->where('customer_id',$customer_id)->update(['customer_cash'=>$add_cash]);
        DB::table('tbl_paymenthistory')->where('payment_history_id',$payment_history_id)->update(['payment_history_status'=>1]);
        DB::table('tbl_paymenthistory')->where('payment_history_id',$payment_history_id)->update(['payment_history_process_date'=>time()]);
        return redirect()->back();
    }
    public function view_list_register_author(){
         $result = DB::table('tbl_customer')->where('customer_id', Session::get('admin_id'))->first();
        $noti = DB::table('tbl_noti')->where('customer_id', $result->customer_id)->orderBy('noti_id','DESC')->get();
        $register_author = DB::table('tbl_registerauthor')
        ->join('tbl_customer','tbl_customer.customer_id','=','tbl_registerauthor.customer_id')
        ->orderBy('register_author_create_date', 'desc')->paginate(12);
        return view('admin.author.allregister')->with('register_author', $register_author)->with('noti', $noti)->with('result', $result);
    }



    public function fillter_by_date(Request $request){
          $result = DB::table('tbl_customer')->where('customer_id', Session::get('admin_id'))->first();
        $noti = DB::table('tbl_noti')->where('customer_id', $result->customer_id)->orderBy('noti_id','DESC')->get();
        $data = $request->all();
        $from_date = $data['from_date'];
        $to_date = $data['to_date'];
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
      
        $all_order = DB::table('tbl_chapterunlock')
        ->join('tbl_customer','tbl_customer.customer_id','=','tbl_chapterunlock.customer_id')
        ->whereBetween('tbl_chapterunlock.day_create_order',[$tu_ngay,$toi_thoidiem_hien_tai])
        ->orderBy('tbl_chapterunlock.chapterunlock_id', 'desc')->get();
        $all_order_count = DB::table('tbl_chapterunlock')
        ->join('tbl_customer','tbl_customer.customer_id','=','tbl_chapterunlock.customer_id')
        ->whereBetween('tbl_chapterunlock.day_create_order',[$tu_ngay,$toi_thoidiem_hien_tai])
        ->orderBy('tbl_chapterunlock.chapterunlock_id', 'desc')->count();
        // TÍNH TUỔI
        if($all_order_count <= 0){
                Session::put('fail', 'Không có giao dịch trong khoảng thời gian bạn đã chọn!');
                return Redirect::to('admin-home');
            }else{
               
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
            $gioithinhkhac = 0;

            foreach($all_order as $key => $value){
                if($value->customer_gender == 0){
                    $gioitinhnam += 1;
                }
                if($value->customer_gender == 1){
                    $gioitinhnu += 1;
                }
            }
            if($gioitinhnam > $gioitinhnu){
                $gioitinhmuanhieunhat = 'Nam';
            }
            if($gioitinhnu > $gioitinhnam){
                $gioitinhmuanhieunhat = 'Nữ';
            }
            if($gioitinhnu == $gioitinhnam || $gioitinhnam == 0 || $gioitinhnu == 0){
                $gioitinhmuanhieunhat = 'Khác';
            }
            if($tuoi != null || $tuoi != ''){
                $tuoinhonhat = min($tuoi);
                $tuoilonnhat = max($tuoi);
            }else{
                  Session::put('fail', 'Không có giao dịch trong khoảng thời gian bạn đã chọn!');
                return Redirect::to('admin-home');
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
           $usersChart->dataset('Truyện tranh khác', 'bar', $value_khac) 
        ->color("rgba(240, 240, 240, 1)")
        ->backgroundcolor("rgba(240, 240, 240, 0.7)");
        }
       

            return view('admin.home')->with('sRate', $usersChart)
            ->with('tuoinhonhat', $tuoinhonhat)
            ->with('tuoilonnhat', $tuoilonnhat)
            ->with('gioitinhmuanhieunhat', $gioitinhmuanhieunhat)
             ->with('noti', $noti)->with('result', $result)
            ->with('sotiengiaodich', $sotiengiaodich);
            }
        
    }
}