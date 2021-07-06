<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Carbon\Carbon;
use Illuminate\Support\Facades\Redirect;
session_start();


class ajaxController extends Controller
{
    public function searchAdmin(Request $request){
        $data = $request->all();
        $all_admin = DB::table('tbl_customer')->where('customer_name','LIKE','%'.$data['admin_name'].'%')->where('customer_title', 2)->paginate(12);
        foreach($all_admin as $key => $admin){
            $myDateTime = Carbon::create($admin->customer_birthday);
            $formattedweddingdate = $myDateTime->format('F.d,Y');
            echo '<tr><th scope="row">'.$admin->customer_id.'</th>
            <td>'.$admin->customer_name.'</td>
            <td>'.$formattedweddingdate.'</td>';
            if($admin->customer_gender == 0){
                echo '<td>Nam</td>';
            }else{
                echo '<td>Nữ</td>';
            }
            echo '<td><span class="badge badge-default">'.$admin->customer_email.'</span></td>
            <td>'.$admin->customer_phone.'</td>';
             if($admin->customer_status == 0){
                echo '<td> <a
                href="/lock-admin/'.$admin->customer_id.'"
                type="button" class="btn btn-default btn-addon m-l-5"><i
                    class="ti-lock"></i>Khóa</a>';
            }
            else{
                echo '<td> <a href="/lock-admin/'.$admin->customer_id.'"
                type="button" class="btn btn-primary btn-addon m-l-5"><i
                    class="ti-unlock"></i>Mở khóa</a></td>';
            }echo'
            <td>
                <a href="/profile/'.$admin->customer_id.'" type="button" class="btn btn-addon btn-default "><i class="ti-file"></i>Xem chi tiết</a>
                <a href="/edit-admin/'.$admin->customer_id.'" type="button" class="btn btn-primary btn-addon"><i class="ti-slice"></i>Cập nhật</a>
            </td>
            </tr>';
        }
    }
    public function searchCustomer(Request $request){
        $data = $request->all();
        $all_customer = DB::table('tbl_customer')->where('customer_name','LIKE','%'.$data['customer_name'].'%')->paginate(8);
        foreach($all_customer as $key => $customer){
            $myDateTime = Carbon::create($customer->customer_birthday);
            $formattedweddingdate = $myDateTime->format('d.m.Y');
            echo '<tr><td style="display: flex !important; align-items:center;"><img style="width: 50px; height: 50px; border-radius: 50%;" class="m-r-10" src="/public/uploads/customer/'.$customer->customer_avatar.'">'.$customer->customer_name.'</td>
            <td>'.$formattedweddingdate.'</td>';
            if($customer->customer_gender == 0){
                echo '<td>Nam</td>';
            }else{
                echo '<td>Nữ</td>';
            }
            echo '
            <td><span class="badge badge-default">'.$customer->customer_email.'</span></td>

                <td>'.$customer->customer_phone.'</td>

                <td>';
                if($customer->customer_title == 0){
                    echo '<a href="/title-customer/'.$customer->customer_id.'" type="button" class="btn btn-default btn-addon m-l-5"><i class="ti-user"></i>Thường</a>';
                }else{
                    echo '<a href="/title-customer/'.$customer->customer_id.'" type="button" class="btn btn-primary btn-addon m-l-5"><i class="ti-pencil"></i>Tác giả</a></td>';
                }echo '<td>';
                if($customer->customer_status == 0){
                    echo '<a href="/lock-customer/'.$customer->customer_id.'" type="button" class="btn btn-default btn-addon m-l-5"><i class="ti-lock"></i>Khóa</a>';
                }else{
                    echo '<a href="/lock-customer/'.$customer->customer_id.'" type="button" class="btn btn-primary btn-addon m-l-5"><i class="ti-unlock"></i>Mở khóa</a></td>
                    ';
                } 
                echo '<td>
                    <a href="/profile-customer/'.$customer->customer_id.'" type="button" class="btn btn-addon btn-default "><i class="ti-file"></i>Xem chi tiết</a>
                    <a href="/edit-customer/'.$customer->customer_id.'" type="button" class="btn btn-addon btn-primary m-l-5"><i class="ti-slice"></i>Sửa</a>
                  
                </td>
            </tr>
            ';
        }
    }

    public function searchComic(Request $request){
        $data = $request->all();
        $all_comic = DB::table('tbl_comic')->where('comic_name','LIKE','%'.$data['comic_name'].'%')->where('cate_id',$data['cate_id'])->where('display',1)->where('comic_status',1)->paginate(6);
        if($all_comic){
            foreach($all_comic as $key => $comic){
                $all_cate = DB::table('tbl_categorycomic')->where('cate_id',$comic->cate_id)->get();
                $all_admin = DB::table('tbl_customer')->where('customer_id',$comic->author_id_comic)->get();
                echo '
                <div class="col-lg-2">
                            <div class="card alert">
                                <div class="card-header" style="display: flex; justify-content: space-between; ">
                                    <h4 style=" width: 50% !important;
                                                display: block;
                                                text-overflow: ellipsis;
                                                overflow: hidden;">'.$comic->comic_name.'</h4>';
                                                if($comic->comic_status == 0){
                                                    echo ' <a href="/approved-comic/'.$comic->comic_id.'" class="btn btn-primary">Chờ duyệt</a>';
                                                }else{
                                                    echo '<label class="label label-success p-t-7 p-b-7">Đã duyệt</label>';
                                                }
                                                echo '    
                                                
                                            </div>
                                            <div class="card-body">
                                                <p class="text-muted m-b-10">Thể loại:';
                                                foreach($all_cate as $key=>$cate){
                                                    if($comic->cate_id == $cate->cate_id){
                                                        echo $cate->cate_name;
                                                    }
                                                }
                                                echo '</p>
                                                <p class="text-muted m-b-10">Tác giả:';
                                                foreach($all_admin as $key=>$admin){
                                                    if($comic->author_id_comic == $admin->customer_id){
                                                        echo $admin->customer_name;
                                                    }
                                                }
                                                echo '</p>
                                                <p class="text-muted m-b-10">Đã bán: <code>'.$comic->comic_price.'</code></p>
                                                <img src="/public/uploads/comic/'.$comic->comic_img.'" class="img-thumbnail img-responsive" alt="Cinque Terre" style="min-height: 300px;max-height: 300px;">
                                                <div class="row">';
                                                if($comic->display == 0){
                                                    echo ' <a href="/display-comic/'.$comic->comic_id.'" type="button" class="btn btn-default col-lg-11 btn-addon m-l-15 m-t-10" style="max-width: 87%;"><i class="ti-na"></i>Ẩn</a>';
                                                }else{
                                                    echo ' <a href="/display-comic/'.$comic->comic_id.'" type="button" class="btn btn-primary col-lg-11 btn-addon m-l-15 m-t-10" style="max-width: 87%;"><i class="ti-eye" ></i>Hiện</a>
                                                    ';
                                                }
                                                echo '  
                                                    <a href="/list-chapter/'.$comic->comic_id.'" type="button" class="col-lg-12 btn btn-primary btn-addon m-l-15 m-t-10" style="max-width: 87%;"><i class="ti-files"></i>Chương truyện</a>
                
                                                    <a href="/edit-comic/'.$comic->comic_id.'" type="button" class="col-lg-12 btn btn-primary btn-addon col-lg-11 m-l-15 m-t-10 " style="max-width: 87%;"><i class="ti-slice"></i>Sửa</a>
                                                    
                
                                                            
                                    </div>
                                </div>
                            </div>
                        </div>
                ';
            }
         
        }elseif($all_comic == -1){
            echo '<div class="col-lg-12" style"text-align:center;color:red;">Truyện tranh không tồn tại!</div>';
        }
    }
    public function searchorder(Request $request){
        $buyer = $request->buyer;
        $all_order = DB::table('tbl_chapterunlock')->where('buyer','LIKE','%'.$buyer.'%')->paginate(12);
        foreach($all_order as $key => $order){echo '
            <tr> 
            <td scope="row">'.$order->chapterunlock_id.'</td>
            <td scope="row">'.$order->comic_name.'</td>
            <td scope="row">'.$order->author_comic.'</td>
            <td scope="row">'.$order->chapter_name.'</td>
            <td scope="row">'.$order->chapter_price.'<img style="margin-left: 20px; width: 20px; height: 20px;" src="/public/backend/images/moon.png" alt=""></td>
            <td scope="row">'.$order->author_chapter.'</td>
            <td scope="row">'.$order->buyer.'</td>
            <td scope="row">'.date("F.d, Y h:i:s", strtotime($order->day_create_order)).'</td>
            </tr>
            ';
        }
    }
    public function validate_email(Request $request){
        $this_email = DB::table('tbl_customer')->where('customer_email',$request->email_input)->first();
        if($this_email){
            echo '<p class="m-t-10 text-danger">Email không hợp lệ!</p>';
        }elseif($this_email == null){
            echo '<p class="m-t-10 text-success">Email hợp lệ</p>';
        }
    }
    public function validate_email_customer(Request $request){
        $this_email = DB::table('tbl_customer')->where('customer_email',$request->login_email)->count();
        if($this_email > 0){
            echo 'Email này đã tồn tại!';
        }else{
            echo '';
        }
    }
    public function reset_number_noti($customer_id){
        DB::table('tbl_customer')->where('customer_id',$customer_id)->update(['number_noti'=>0]);
    }
    public function update_content_chapter(Request $request){
        $get_image = $request->file('chapter_img');
        $gal_id = $request->gal_id;
        $data1 = array();
        if($get_image){
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('public/uploads/chapter',$new_image);
            $this_image = DB::table('tbl_contentchapter')->where('chaptercontent_id',$gal_id)->first();
            unlink('public/uploads/chapter/'.$this_image->chapter_img);
            $data1['chapter_img'] = $new_image;
            DB::table('tbl_contentchapter')->where('chaptercontent_id',$gal_id)->update($data1);
        }else{
           
        }
        $this_content = DB::table('tbl_contentchapter')->where('chaptercontent_id',$gal_id)->first();
        $session_chapter = $this_content->session_chapter;
        $all_content_chapter = DB::table('tbl_contentchapter')->where('session_chapter',$session_chapter)->get();
        foreach($all_content_chapter as $key => $value){
            echo '
            <label class="content-chapter-box">
                <img class="content-chapter-img" src="/public/uploads/chapter/'.$value->chapter_img.'" alt="">
                <input type="file" id="file-'.$value->chaptercontent_id.'" name="chapter_img" class="content-chapter-input" data-gal_id="'.$value->chaptercontent_id.'" value="'.$value->chapter_img.'" accept="image/*">
            </label>
            ';
        }
    }
    public function update_content_chapter_admin(Request $request){
        $get_image = $request->file('chapter_img');
        $gal_id = $request->gal_id;
        $data1 = array();
        if($get_image){
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('public/uploads/chapter',$new_image);
            $this_image = DB::table('tbl_contentchapter')->where('chaptercontent_id',$gal_id)->first();
            unlink('public/uploads/chapter/'.$this_image->chapter_img);
            $data1['chapter_img'] = $new_image;
            DB::table('tbl_contentchapter')->where('chaptercontent_id',$gal_id)->update($data1);
        }else{
           
        }
        $this_content = DB::table('tbl_contentchapter')->where('chaptercontent_id',$gal_id)->first();
        $session_chapter = $this_content->session_chapter;
        $all_content_chapter = DB::table('tbl_contentchapter')->where('session_chapter',$session_chapter)->get();
        foreach($all_content_chapter as $key => $value){
            echo '
            <label class="khoi_anh_chapter">
                <img class="content-chapter-img" src="/public/uploads/chapter/'.$value->chapter_img.'" alt="">
                <input type="file" id="file-'.$value->chaptercontent_id.'" name="chapter_img" class="form-control input-focus  content-chapter-input" data-gal_id="'.$value->chaptercontent_id.'" value="'.$value->chapter_img.'" accept="image/*">
            </label>
            ';
        }
    }
    public function searchPayment(Request $request){
        $customer_email = $request->customer_email;
        $all_order = DB::table('tbl_paymenthistory')
        ->join('tbl_customer','tbl_customer.customer_id','=','tbl_paymenthistory.customer_id')
        ->orWhere('tbl_customer.customer_email','LIKE','%'.$customer_email.'%')
        ->orWhere('tbl_paymenthistory.payment_history_id', 'LIKE','%'.$customer_email.'%')
        ->paginate(12);
        $i = 0;
        foreach($all_order as $key => $cust){
            $i++;
            $myDateTime = Carbon::create($cust->customer_birthday);
            $formattedweddingdate = $myDateTime->format('F.d,Y');
            echo '
            <tr>
                <td>'.$i.'</td>
                <td>'.$cust->customer_name.'</td>
                <td>'.$cust->customer_email.'</td>
                <td>'.$formattedweddingdate.'</td>
                <td>'.$cust->menhgia.'</td>
                <td>';
                if($cust->loaithe == 1){
                    echo 'Viettel';
                }elseif($cust->loaithe == 2){
                    echo 'Mobiphone';
                }elseif($cust->loaithe == 3){
                    echo 'Vinaphone';
                }
                echo '
                </td>
                <td>'.date('F.d,Y H:i:s',$cust->payment_history_create_date).'</td>';

                if($cust->payment_history_process_date == ''){
                    echo '<td>Chưa cập nhật</td>';
                }else{
                    echo '<td>'.date('F.d,Y H:i:s',$cust->payment_history_process_date).'</td>';
                }
                echo '<td>';
                if($cust->payment_history_status == 0){
                    echo '<a href="/xac-nhan-thanh-toan/'.$cust->customer_id.'/'.$cust->payment_history_id.'" type="button"
                    class="btn btn-addon  btn-primary m-l-5"><i class="ti-money"></i>Xác nhận</a>';
                }else{
                    echo '<p class="label label-default p-t-10 p-b-12">Đã xác nhận</p>';
                }
                echo '</td>
                </tr>';
            
        }
    }
}