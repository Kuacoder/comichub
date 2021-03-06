<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Illuminate\Support\Facades\Redirect;
session_start();

class CustomerController extends Controller
{
    //
    public function all(){
        $all_customer = DB::table('tbl_customer')->orderby('customer_id', 'DESC')->paginate(8);
         $result = DB::table('tbl_customer')->where('customer_id', Session::get('admin_id'))->first();
        $noti = DB::table('tbl_noti')->where('customer_id', $result->customer_id)->orderBy('noti_id','DESC')->get();
  
        return view('admin.customer.all')->with('all_customer', $all_customer)->with('noti', $noti)->with('result', $result);
    }
    public function login(){
        return view('customer.login');
    }
   
    public function add(){
          $result = DB::table('tbl_customer')->where('customer_id', Session::get('admin_id'))->first();
        $noti = DB::table('tbl_noti')->where('customer_id', $result->customer_id)->orderBy('noti_id','DESC')->get();
        return view('admin.customer.add')->with('noti', $noti)->with('result', $result);
    }
    public function save(Request $request){
        $data = array();
        $data['customer_name'] = trim($request->customer_name);
        $data['customer_email'] = trim($request->customer_email);
        $customer_password = trim($request->customer_password);
        $data['customer_phone'] = trim($request->customer_phone);
        $data['customer_birthday'] = trim($request->customer_birthday);
        $data['customer_gender'] = trim($request->customer_gender);
        $data['customer_address'] = trim($request->customer_address);
        $data['customer_status'] = trim($request->customer_status);
        $data['customer_title'] = trim($request->customer_title);
        $data['number_noti'] = 0;
        $data['customer_cash'] = 0;
        $data['cash_used'] = 0;
        $data['customer_sales'] = 0;
        $data['customer_publish'] = 0;
        $data['customer_date'] = time();
        $data['customer_update'] = 0;
        $email = trim($request->customer_email);
        $email_exist = DB::table('tbl_customer')->where('customer_email',$email)->count();
        if($email_exist > 0){
            Session::put('fail', 'Email n??y ???? t???n t???i!');
            return Redirect::to('add-customer');
        }else{
        if($data['customer_name']== '' || $data['customer_email']== '' ||  $customer_password == ''|| $data['customer_phone']== ''|| $data['customer_birthday']== ''|| $data['customer_gender']== ''|| $data['customer_address']== ''|| $data['customer_status']== ''|| $data['customer_title']== ''){
                Session::put('fail','Vui l??ng kh??ng ????? tr???ng b???t k??? tr?????ng n??o!');
                return Redirect::to('add-customer');
        }else{
            $data['customer_password'] = md5($customer_password);
            $get_image = $request->file('customer_avatar');
            if($get_image){
                $permited = array('jpg','jpeg', 'png', 'gif');
                $file_name = $_FILES['customer_avatar']['name'];
                $file_size = $_FILES['customer_avatar']['size'];
                $file_temp = $_FILES['customer_avatar']['tmp_name'];
    
                $div = explode('.', $file_name);
                $file_ext = strtolower(end($div));
                $unique_image = substr(md5(time()),0, 10).'.'.$file_ext;
                $get_image->move('public/uploads/customer',$unique_image);
                $data['customer_avatar'] = $unique_image;
                DB::table('tbl_customer')->insert($data);
            Session::put('success','Th??m t??i kho???n kh??ch h??ng th??nh c??ng');
            return Redirect::to('list-customer');
            }else{
                $data['customer_avatar'] = '';
                DB::table('tbl_customer')->insert($data);
                Session::put('success','Th??m t??i kho???n kh??ch h??ng th??nh c??ng');
                return Redirect::to('list-customer');
            }
        }
        }
    }

    public function lock($customer_id){
        $customer = DB::table('tbl_customer')->where('customer_id',$customer_id)->first();
        if($customer && $customer->customer_status==0){
            DB::table('tbl_customer')->where('customer_id',$customer_id)->update(['customer_status'=>1]);
            Session::put('success', 'T??i kho???n ???? ???????c m??? kh??a');
            return Redirect::to('list-customer');
        }elseif($customer && $customer->customer_status==1){
            DB::table('tbl_customer')->where('customer_id',$customer_id)->update(['customer_status'=>0]);
            Session::put('success', 'Kh??a t??i kho???n th??nh c??ng');
            return Redirect::to('list-customer');
        }
    }

    public function title($customer_id){
        $customer = DB::table('tbl_customer')->where('customer_id',$customer_id)->first();
        if($customer && $customer->customer_title==0){
            DB::table('tbl_customer')->where('customer_id',$customer_id)->update(['customer_title'=>1]);
            Session::put('success', 'T??i kho???n ???? ???????c chuy???n th??nh t??i kho???n t??c gi???');
            return Redirect::to('list-customer');
        }elseif($customer && $customer->customer_title==1){
            DB::table('tbl_customer')->where('customer_id',$customer_id)->update(['customer_title'=>0]);
            Session::put('success', 'T??i kho???n ???? ???????c chuy???n th??nh t??i kho???n th?????ng');
            return Redirect::to('list-customer');
        }
    }

    public function homepage(Request $request){
        $customer_email = trim($request->customer_email);
        $customer_password = md5($request->customer_password);
        $result = DB::table('tbl_customer')->where('customer_email',$customer_email)->where('customer_password',$customer_password)->first();
       
        if($result){
            if($result->customer_status == 0){
            Session::put('message', 'T??i kho???n n??y hi???n ??ang b??? kh??a vui l??ng li??n h??? qu???n tr??? vi??n theo s??? ??i???n tho???i 0982057893 ????? ???????c h??? tr???');
            return view('customer.login');
            }else{
                Session::put('customer_id', $result->customer_id);
                Session::put('customer_name', $result->customer_name);
                Session::put('customer_title', $result->customer_title);
                Session::put('customer_email', $result->customer_email);
                Session::put('customer_avatar', $result->customer_avatar);
                return Redirect::to('/');
            }
           
        }else{
            Session::put('message', 'T??i kho???n ho???c m???t kh???u kh??ng ????ng');
            return view('customer.login');
        }
        return view('customer.login');
    }
    public function edit($customer_id){
         $result = DB::table('tbl_customer')->where('customer_id', Session::get('admin_id'))->first();
        $noti = DB::table('tbl_noti')->where('customer_id', $result->customer_id)->orderBy('noti_id','DESC')->get();
        $edit_customer = DB::table('tbl_customer')->where('customer_id',$customer_id)->get();
     
        return  view('admin.customer.edit')->with('edit_customer', $edit_customer)->with('noti', $noti)->with('result', $result);
    }
    public function update(Request $request, $customer_id){
        $data = array();
        $data['customer_name'] = $request->customer_name;
        $data['customer_email'] = $request->customer_email;
        $customer_password = trim($request->customer_password);
        $data['customer_phone'] = $request->customer_phone;
        $data['customer_birthday'] = $request->customer_birthday;
        $data['customer_gender'] = $request->customer_gender;
        $data['customer_address'] = $request->customer_address;
        $data['customer_status'] = $request->customer_status;
        $data['customer_title'] = $request->customer_title;
        $data['number_noti'] = $request->number_noti;
        $data['customer_cash'] = $request->customer_cash;
        $data['cash_used'] = $request->cash_used;
        $data['customer_sales'] = $request->customer_sales;
        $data['customer_publish'] = $request->customer_publish;
        $data['customer_date'] = $request->customer_date;
        $data['customer_update'] = time();
        if($data['customer_name']== '' ||  $customer_password == ''|| $data['customer_phone']== '' || $data['customer_address']== ''){
            Session::put('fail','Kh??ng ???????c ????? tr???ng b???t k??? tr?????ng n??o');
            return Redirect::to('edit-customer/'.$customer_id);
        }else{
            $data['customer_password'] = md5($customer_password);
            $get_image = $request->file('customer_avatar');
            if($get_image){
            $permited = array('jpg','jpeg', 'png', 'gif');
            $file_name = $_FILES['customer_avatar']['name'];
            $file_size = $_FILES['customer_avatar']['size'];
            $file_temp = $_FILES['customer_avatar']['tmp_name'];

            $div = explode('.', $file_name);
            $file_ext = strtolower(end($div));
            $unique_image = substr(md5(time()),0, 10).'.'.$file_ext;
            $get_image->move('public/uploads/customer/',$unique_image);
            $data['customer_avatar'] = $unique_image;
            DB::table('tbl_customer')->where('customer_id',$customer_id)->update($data);
            Session::put('success','C???p nh???t t??i kho???n th??nh c??ng');
            return Redirect::to('list-customer');
            }else{
            DB::table('tbl_customer')->where('customer_id',$customer_id)->update($data);
            Session::put('success','C???p nh???t t??i kho???n th??nh c??ng');
            return Redirect::to('list-customer');
            }
        }
    }
    public function add_profile(Request $request, $customer_id){
        $data = array();
        $data['customer_name'] = $request->customer_name;
        $data['customer_email'] = $request->customer_email;
        $data['customer_password'] = $request->customer_password;
        $data['customer_phone'] = $request->customer_phone;
        $data['customer_birthday'] = $request->customer_birthday;
        $data['customer_gender'] = $request->customer_gender;
        $data['customer_address'] = $request->customer_address;
        $data['customer_status'] = $request->customer_status;
        $data['customer_title'] = $request->customer_title;
        $data['number_noti'] = $request->number_noti;
        $data['customer_cash'] = $request->customer_cash;
        $data['cash_used'] = $request->cash_used;
        $data['customer_sales'] = $request->customer_sales;
        $data['customer_publish'] = $request->customer_publish;
        $data['customer_date'] = $request->customer_date;
        $data['customer_update'] = time();
        $get_image = $request->file('customer_avatar');

        if($get_image){
            $permited = array('jpg','jpeg', 'png', 'gif');
            $file_name = $_FILES['customer_avatar']['name'];
            $file_size = $_FILES['customer_avatar']['size'];
            $file_temp = $_FILES['customer_avatar']['tmp_name'];

            $div = explode('.', $file_name);
            $file_ext = strtolower(end($div));
            $unique_image = substr(md5(time()),0, 10).'.'.$file_ext;
            $get_image->move('public/uploads/customer',$unique_image);
            $data['customer_avatar'] = $unique_image;
            DB::table('tbl_customer')->where('customer_id',$customer_id)->update($data);
            if($data['customer_title'] == 0){
                Session::put('mess','C???p nh???t th??ng tin th??nh c??ng gi??? ????y b???n c?? th??? ????ng k?? l??m t??c gi???');
            }else{
                Session::put('mess','C???p nh???t th??ng tin th??nh c??ng');
            }
        
            return Redirect::to('profile-customer/'.$customer_id);
        }
        $data['customer_avatar'] = '';
        DB::table('tbl_customer')->where('customer_id',$customer_id)->update($data);
        if($data['customer_title'] == 0){
                Session::put('mess','C???p nh???t th??ng tin th??nh c??ng gi??? ????y b???n c?? th??? ????ng k?? l??m t??c gi???');
            }else{
                Session::put('mess','C???p nh???t th??ng tin th??nh c??ng');
            }
        return Redirect::to('profile-customer/'.$customer_id);
    }

    public function delete($customer_id){
        DB::table('tbl_customer')->where('customer_id',$customer_id)->delete();
        Session::put('success', 'T??i kho???n ???? ???????c ???n kh???i h??? th???ng');
        return Redirect::to('list-customer');
    }
    public function nap_the(Request $request){
        $data = array();
            $data['customer_id'] = $request->customer_id;
            $data['loaithe'] = $request->loaithe;
            $data['menhgia'] = $request->menhgia;
            $data['serial'] = $request->serial;
            $data['mathe'] = $request->ma_the;
            
            if($data['serial'] == '' || $data['mathe'] == '' || $data['menhgia'] == 0 || $data['loaithe'] == 0){
                Session::put('fail','th??ng tin b???n nh???p kh??ng h???p l??? ho???c b??? b??? tr???ng!');
                return redirect()->back();
            }else{
                $data['payment_history_status'] = 0;
                $data['payment_history_create_date'] = time();
                $data['payment_history_process_date'] = '';
                $customer = DB::table('tbl_customer')->where('customer_id',$data['customer_id'])->first();
                 if($customer){
                    $curent_cash = $customer->customer_cash;
                }
                $add_cash =  $data['menhgia'] + $curent_cash;
                DB::table('tbl_customer')->where('customer_id',$data['customer_id'])->update(['customer_cash'=>$add_cash]);
                DB::table('tbl_paymenthistory')->insert($data);
                Session::put('success','B???n ???? n???p th??nh c??ng '.$data['menhgia'].' nguy???t tinh, vui l??ng ki???m tra l???i t??i kho???n! C???m ??n b???n ???? ???ng h??? Comichub');
                return redirect()->back();
            }
    }
    public function profile($customer_id){
        $result = DB::table('tbl_customer')->where('customer_id', Session::get('admin_id'))->first();
        $noti = DB::table('tbl_noti')->where('customer_id', $result->customer_id)->orderBy('noti_id','DESC')->get();
        $profile = DB::table('tbl_customer')->where('customer_id',$customer_id)->get();
        return view('admin.customer.profile')->with('profile', $profile)->with('noti', $noti)->with('result', $result);
    }
    public function logout(){
        Session::put('customer_name', null);
        Session::put('customer_cash', null);
        Session::put('cash_used', null);
        Session::put('customer_title',null);
        Session::put('customer_email', null );
        Session::put('customer_id', null );
        Session::put('customer_avatar', null );
        return Redirect::to('/');
    }


    //Client
    public function register(){
        return view('customer.register');
    }
    public function register_request(Request $request){
        if($request->customer_password == $request->password_replace){
            $data = array();
            $data['customer_name'] = '';
            $data['customer_email'] = $request->customer_email;
            $data['customer_password'] = md5($request->customer_password);
            $data['customer_phone'] = '';
            $data['customer_birthday'] = '1993-09-07';
            $data['customer_gender'] = 0;
            $data['customer_address'] = '';
            $data['customer_status'] = 1;
            $data['customer_title'] = 0;
            $data['number_noti'] = 0;
            $data['customer_cash'] = 0;
            $data['cash_used'] = 0;
            $data['customer_sales'] = 0;
            $data['customer_publish'] = 0;
            $data['customer_date'] = time();
            $data['customer_update'] = 0;
            $data['customer_avatar'] = '';
            $this_email = DB::table('tbl_customer')->where('customer_email',$request->customer_email)->count();
            if($this_email > 0){
                Session::put('message', 'Email n??y ???? t???n t???i!');
                return Redirect::to('/register-customer');
            }else{
                DB::table('tbl_customer')->insert($data);
                return Redirect::to('/login-customer');
            }
        }
    }
    public function register_author_client($customer_id){
        $data = array();
        $data['customer_id'] = $customer_id;
        $data['register_author_status'] = 0;
        $data['register_author_create_date'] = time();
        $data['register_author_process_date'] = '';
        $this_customer = DB::table('tbl_registerauthor')->where('customer_id', $customer_id)->count();
        if($this_customer > 0){
            Session::put('fail', 'B???n ???? ????ng k?? r???i vui l??ng ch??? duy???t b???n nh??!');
            return Redirect::to('profile-customer/'.$customer_id);
        }else{
            $this_customer2 = DB::table('tbl_customer')->where('customer_id', $customer_id)->first();
             $all_admin = DB::table('tbl_customer')->where('customer_title',2)->get();
                foreach($all_admin as $key => $value){
                $so_noti_hientai = $value->number_noti;
                $tong_noti = $so_noti_hientai+1;
                 DB::table('tbl_customer')->where('customer_id',$value->customer_id)->update(['number_noti'=>$tong_noti]);
                $data_noti = array();
                $data_noti['customer_id'] = $value->customer_id;
                $data_noti['day_create_noti'] = time();
                $data_noti['noti_content'] = trim('<a class="noidungthongbao" href="/view-list-register-author">'.$this_customer2->customer_name.' ???? g???i y??u c???u chuy???n ?????i t??i kho???n th??nh t??c gi???</a>');
                DB::table('tbl_noti')->insert($data_noti);
            }
            DB::table('tbl_registerauthor')->insert($data);
            Session::put('mess', '????ng k?? th??nh c??ng ch??ng t??i s??? ph?? duy???t y??u c???u c???a b???n trong th???i gian s???m nh???t!');
            
            return Redirect::to('profile-customer/'.$customer_id);
        } 
    }
    public function process_register_author($customer_id, $register_author_id){
        DB::table('tbl_registerauthor')->where('register_author_id',$register_author_id)->update(['register_author_status'=>1]);
        $this_customer = DB::table('tbl_customer')->where('customer_id',$customer_id)->first();
        $number_noti = $this_customer->number_noti;
        $current_number_noti = $number_noti + 1;

        $data = array();
        $data['customer_id'] = $customer_id;
        $data['noti_content'] = 
        trim('<a class="noidungthongbao" href="/login-customer">????ng k?? t??c gi??? ???? ???????c duy???t. Vui l??ng ????ng nh???p l???i!</a>');
        $data['day_create_noti'] = time();
        DB::table('tbl_noti')->insert($data);
        DB::table('tbl_customer')->where('customer_id',$customer_id)->update(['number_noti'=>$current_number_noti]);
        DB::table('tbl_customer')->where('customer_id',$customer_id)->update(['customer_title'=>1]);
       
       
        DB::table('tbl_registerauthor')->where('register_author_id',$register_author_id)->update(['register_author_process_date'=>time()]);
        Session::put('success','Author status has been successfully updated');
        return Redirect::to('view-list-register-author');
    }
    public function payment_this_customer($customer_id){
        $data = array();
        $data['customer_id'] = $customer_id;
        $data['payment_history_status'] = 0;
        $data['cash_process'] = 0;
        $data['payment_history_create_date'] = time();
        $data['payment_history_process_date'] = '';
         $all_admin = DB::table('tbl_customer')->where('customer_title',2)->get();
         foreach($all_admin as $key => $value){
            $so_noti_hientai = $value->number_noti;
            $tong_noti = $so_noti_hientai+1;
            DB::table('tbl_customer')->where('customer_id',$value->customer_id)->update(['number_noti'=>$tong_noti]);
            $data_noti = array();
            $data_noti['customer_id'] = $value->customer_id;
            $data_noti['day_create_noti'] = time();
            $data_noti['noti_content'] = trim('<a class="noidungthongbao" href="/list-payment">'.Session::get('customer_name').' ???? g???i y??u c???u n???p nguy???t tinh</a>');
            DB::table('tbl_noti')->insert($data_noti);
        }
        DB::table('tbl_paymenthistory')->insert($data);
        return redirect()->back();
    }
    public function add_more_cash(Request $request, $customer_id){
        $payment_history_id = $request->payment_history_id;
        $cash_more = trim($request->cash_more);
        $payment = DB::table('tbl_paymenthistory')->where('payment_history_id',$payment_history_id)->first();
        $customer = DB::table('tbl_customer')->where('customer_id',$customer_id)->first();

        $number_noti = $customer->number_noti;
        $current_number_noti = $number_noti + 1;

        $data = array();
        $data['customer_id'] = $customer_id;
        $data['noti_content'] = 
        trim('<a class="noidungthongbao">T??i kho???n c???a b???n ???? ???????c c???ng th??m '.$cash_more.' Nguy???t tinh</a>');
        $data['day_create_noti'] = time();
        DB::table('tbl_noti')->insert($data);
        DB::table('tbl_customer')->where('customer_id',$customer_id)->update(['number_noti'=>$current_number_noti]);


        if($payment && $payment->payment_history_status==0){
            DB::table('tbl_paymenthistory')->where('payment_history_id',$payment_history_id)->update(['payment_history_status'=>1]);
            DB::table('tbl_paymenthistory')->where('payment_history_id',$payment_history_id)->update(['payment_history_process_date'=>time()]);
            DB::table('tbl_paymenthistory')->where('payment_history_id',$payment_history_id)->update(['cash_process'=>$cash_more]);
        }
        if($customer){
           $curent_cash = $customer->customer_cash;
        }
        $add_cash =  $cash_more + $curent_cash;
        DB::table('tbl_customer')->where('customer_id',$customer_id)->update(['customer_cash'=>$add_cash]);
        Session::put('success', 'Th??m nguy???t tinh th??nh c??ng');
        return Redirect::to('list-payment');
    }
}