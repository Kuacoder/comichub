@extends('admin.layout')

@section('content')
<?php 
							    $success = Session::get('success');
                                $fail = Session::get('fail');
							    if ($success) { ?>
<div id="modal" style=" ">
    <div class="modal--table">
        <h1 class="modal--table--h1">Thông báo</h1>
        <h3 class="modal--table--h3 text-default"><?php echo $success;
								        Session::put('success',null); ?></h3>
        <div class="modal--table--button"><button class="btn btn-default" id="close_modal">Đóng</button></div>

    </div>

</div>
<?php 
							    }elseif($fail) { ?>
<div id="modal" style=" ">
    <div class="modal--table">
        <h1 class="modal--table--h1">Thông báo</h1>
        <h3 class="modal--table--h3 text-default"><?php echo $fail;
								        Session::put('fail',null); ?></h3>
        <div class="modal--table--button"><button class="btn btn-default" id="close_modal">Đóng</button></div>
    </div>
</div>
<?php }else{
								Session::put('success',null);
                                Session::put('fail',null);
							    }
							    ?>
<div class="content-wrap">
    <div class="main">
        <div class="container-fluid">
            <div class="row">
                <div class="main-content">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card alert">
                                <div class="row">
                                    <div class="col-lg-6" style="margin-left: 25%;">
                                        <div class="card-header">
                                            <h1 style="text-align: center;">Cập nhật tài khoản khách</h1>
                                        </div>

                                        <div class="card-body">
                                            <div class="basic-form">
                                                @foreach($edit_customer as $key => $customer_edit)
                                                <form method="POST"
                                                    action="{{url('/update-customer/'.$customer_edit->customer_id)}}"
                                                    enctype="multipart/form-data">
                                                    {{csrf_field()}}
                                                    <div class="form-group">
                                                        <p class="text-muted m-b-15 f-s-12" style="font-size:larger;">
                                                            Tên khách hàng</p>
                                                        <input name="customer_name" type="text"
                                                            class="form-control input-focus"
                                                            value="{{$customer_edit->customer_name}}">
                                                    </div>
                                                    <div class="form-group">
                                                        <p class="text-muted m-b-15 f-s-12" style="font-size:larger;">
                                                            Ngày sinh</p>
                                                        <input class="form-control input-focus" type="date"
                                                            id="birthday" value="{{$customer_edit->customer_birthday}}"
                                                            name="customer_birthday" min="1970-01-01" max="2021-12-31">
                                                    </div>
                                                    <div class="form-group">
                                                        <label style="font-size:larger;">Giới tính</label>
                                                        <select class="form-control input-focus"
                                                            name="customer_gender">@if($customer_edit->customer_gender
                                                            ==0)
                                                            <option selected value="0">Nam</option>
                                                            <option value="1">Nữ</option>
                                                            @else
                                                            <option value="0">nam</option>
                                                            <option selected value="1">Nữ</option>
                                                            @endif

                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <p class="text-muted m-b-15 f-s-12" style="font-size:larger;">
                                                            Cập nhật ảnh đại diện</p>
                                                        <img src="{{URL::to('/public/uploads/customer/'.$customer_edit->customer_avatar)}}"
                                                            alt=""
                                                            style="width: 100px;
                                                                                                                                        height: 150px;
                                                                                                                                        float: left;">
                                                        <input type="file" name="customer_avatar"
                                                            class="form-control input-focus"
                                                            value="{{$customer_edit->customer_avatar}}" style="
                                                width: 86.5%;
                                                margin-top: 65px;" id="coverimg_picture">
                                                        <label for="coverimg_picture" class="label_file_vip"
                                                            style="left: 115px">Chọn ảnh
                                                            đại diện</label>
                                                    </div>
                                                    <div class="form-group">
                                                        <p class="text-muted m-b-15 f-s-12"
                                                            style="margin-top: 70px;font-size:larger;">Email
                                                        </p>
                                                        <input name="customer_email" type="text" class="form-control"
                                                            readonly value="{{$customer_edit->customer_email}}">
                                                    </div>
                                                    <div class="form-group">
                                                        <p class="text-muted m-b-15 f-s-12">Mật khẩu</p>
                                                        <input name="customer_password" type="password"
                                                            class="form-control input-focus"
                                                            placeholder="Enter Password">
                                                    </div>
                                                    <div class="form-group">
                                                        <p class="text-muted m-b-15 f-s-12">Số điện thoại</p>
                                                        <input name="customer_phone" type="text"
                                                            class="form-control input-focus"
                                                            value="{{$customer_edit->customer_phone}}">
                                                    </div>
                                                    <div class="form-group">
                                                        <p class="text-muted m-b-15 f-s-12">Địa chỉ</p>
                                                        <input name="customer_address" type="text"
                                                            class="form-control input-focus"
                                                            value="{{$customer_edit->customer_address}}">
                                                    </div>
                                                    <input type="hidden" name="customer_status"
                                                        value="{{$customer_edit->customer_status}}">
                                                    <input type="hidden" name="cash_used"
                                                        value="{{$customer_edit->cash_used}}">
                                                    <input type="hidden" name="customer_title"
                                                        value="{{$customer_edit->customer_title}}">
                                                    <input type="hidden" name="customer_cash"
                                                        value="{{$customer_edit->customer_cash}}">
                                                    <input type="hidden" name="customer_sales"
                                                        value="{{$customer_edit->customer_sales}}">
                                                    <input type="hidden" name="customer_publish"
                                                        value="{{$customer_edit->customer_publish}}">
                                                    <input type="hidden" name="customer_date"
                                                        value="{{$customer_edit->customer_date}}">
                                                    <input type="hidden" name="number_noti"
                                                        value="{{$customer_edit->number_noti}}">
                                                    <button type="submit" class="btn btn-primary"
                                                        style="margin-left: 45%;">Cập nhật</button>
                                                </form>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection