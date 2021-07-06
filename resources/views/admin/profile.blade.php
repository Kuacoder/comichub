@extends('admin.layout')

@section('content')
<?php use Carbon\Carbon; ?>
<div class="content-wrap">
    <div class="main">
        <div class="container-fluid">
            <div class="row">
                <div class="main-content">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="card alert">
                                <div class="card-body">
                                    @foreach($profile as $key => $files)
                                    <div class="user-profile">
                                        <div class="row">
                                            <div class="col-lg-4">
                                                <div class="user-photo m-b-30">
                                                    <img class="img-responsive"
                                                        src="{{URL::to('/public/uploads/customer/'.$files->customer_avatar)}}"
                                                        alt="">
                                                </div>

                                            </div>
                                            <div class="col-lg-8">
                                                <div class="user-profile-name">{{$files->customer_name}}</div>
                                                <div class="user-Location"><i
                                                        class="ti-location-pin"></i>{{$files->customer_address}}</div>
                                                <div class="user-job-title">Quản trị viên</div>

                                                <div class="custom-tab user-profile-tab">
                                                    <ul class="nav nav-tabs" role="tablist">
                                                        <li role="presentation" class="active"><a href="#1"
                                                                aria-controls="1" role="tab" data-toggle="tab">Thông tin
                                                                chi tiết</a>
                                                        </li>
                                                    </ul>
                                                    <div class="tab-content">
                                                        <div role="tabpanel" class="tab-pane active" id="1">
                                                            <div class="contact-information">
                                                                <h4>Thông tin liên hệ</h4>
                                                                <div class="phone-content">
                                                                    <span class="contact-title">Số điện thoại:</span>
                                                                    <span
                                                                        class="phone-number">{{$files->customer_phone}}</span>
                                                                </div>
                                                                <div class="address-content">
                                                                    <span class="contact-title">Địa chỉ:</span>
                                                                    <span
                                                                        class="mail-address">{{$files->customer_address}}</span>
                                                                </div>
                                                                <div class="email-content">
                                                                    <span class="contact-title">Email:</span>
                                                                    <span
                                                                        class="contact-email">{{$files->customer_email}}</span>
                                                                </div>


                                                            </div>
                                                            <div class="basic-information">
                                                                <h4>Thông tin cơ bản</h4>
                                                                <div class="birthday-content">
                                                                    <?php $myDateTime = Carbon::create($files->customer_birthday);
																$Datecreate = Carbon::create($files->customer_date);
																$DateUpdate = Carbon::create($files->customer_update);
                                    								$formattedweddingdate = $myDateTime->format('d.m.Y'); 
                                    								$DatecreatedFormat = $Datecreate->format('d.m.Y');
                                    								$DateUpdateformat = $DateUpdate->format('d.m.Y'); ?>
                                                                    <span class="contact-title">Ngày sinh:</span>
                                                                    <span
                                                                        class="birth-date"><?php echo $formattedweddingdate; ?></span>
                                                                </div>
                                                                <div class="gender-content">
                                                                    <span class="contact-title">Giới tính:</span>
                                                                    <span class="gender">@if($files->customer_gender
                                                                        ==0) Nam @else Nữ @endif</span>
                                                                </div>
                                                                <div class="gender-content">
                                                                    <span class="contact-title">Ngày tạo:</span>
                                                                    <span class="gender"><?php $timestamp = $files->customer_date;
  																	echo(date("d.m.Y h:i:s", strtotime($timestamp))); ?></span>
                                                                </div>
                                                                <div class="gender-content">
                                                                    <span class="contact-title">Cập nhật lần
                                                                        cuối:</span>
                                                                    <span class="gender"><?php if($files->customer_update != ''){$timestamp = $files->customer_update;
																	echo(date("d.m.Y h:i:s", $timestamp));	
																}else{echo '';}
  																	 ?></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div><!-- /# column -->
                        @foreach($profile as $key => $files)
                        <div class="col-lg-6">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="card">
                                        <div class="stat-widget-one">
                                            <div class="profile-widget">
                                                <div class="stat-text">Số dư trong tài khoản</div>
                                                <div class="stat-digit"
                                                    style="display:flex; align-items:center; justify-content: center;">
                                                    {{$files->customer_cash}} <img
                                                        style="width:20px; height: 20px; margin-left:10px"
                                                        src="{{URL::to('/public/frontend/img/moon.png')}}" alt=""></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="card">
                                        <div class="stat-widget-one">
                                            <div class="profile-widget">
                                                <div class="stat-text">Doanh thu</div>
                                                <div class="stat-digit"
                                                    style="display:flex; align-items:center; justify-content: center;">
                                                    {{$files->customer_sales}}<img
                                                        style="width:20px; height: 20px; margin-left:10px"
                                                        src="{{URL::to('/public/frontend/img/moon.png')}}" alt=""></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="card">
                                        <div class="stat-widget-one">
                                            <div class="profile-widget">
                                                <div class="stat-text">Đã xuất bản</div>
                                                <div class="stat-digit "
                                                    style="display:flex; align-items:center; justify-content: center;">
                                                    {{$files->customer_publish}} Truyện tranh</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="card">
                                        <div class="stat-widget-one">
                                            <div class="profile-widget">
                                                <div class="stat-text">Đã tiêu</div>
                                                <div class="stat-digit"
                                                    style="display:flex; align-items:center; justify-content: center;">
                                                    {{$files->cash_used}} <img
                                                        style="width:20px; height: 20px; margin-left:10px"
                                                        src="{{URL::to('/public/frontend/img/moon.png')}}" alt=""></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><!-- /# column -->
                        @endforeach
                    </div><!-- /# row -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection