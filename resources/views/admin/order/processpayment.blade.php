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
                                                <!-- <div class="user-work">
													<h4>work</h4>
													<div class="work-content">
														<h3>HTML Cooker Bangladesh </h3>
														<p>123, South Mugda</p>
														<p>Dhaka, 1214</p>
													</div>
													<div class="work-content">
														<h3>Unix Bangladesh</h3>
														<p>123, South Mugda</p>
														<p>Dhaka, 1214</p>
													</div>
												</div>
												<div class="user-skill">
													<h4>Skill</h4>
													<ul>
														<li><a href="#">Branding</a></li>
														<li><a href="#">UI/UX</a></li>
														<li><a href="#">Web Design</a></li>
														<li><a href="#">Wordpress</a></li>
														<li><a href="#">Magento</a></li>
													</ul>
												</div> -->
                                            </div>
                                            <div class="col-lg-8">
                                                <div class="user-profile-name">{{$files->customer_name}}</div>
                                                <div class="user-Location"><i
                                                        class="ti-location-pin"></i>{{$files->customer_address}}</div>
                                                <div class="user-job-title">Khách hàng</div>
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
                                                                <!-- <div class="website-content">
																	<span class="contact-title">Website:</span>
																	<span class="contact-website">www.vuejscustomer.com</span>
																</div>
																<div class="skype-content">
																	<span class="contact-title">Skype:</span>
																	<span class="contact-skype">vue.js customer </span>
																</div> -->
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
                                                                    <span class="gender"><?php if($files->customer_update == 0){echo 'Không';}else{$timestamp = $files->customer_update;
  																	echo(date("d.m.Y h:i:s", strtotime($timestamp))); }?></span>
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
                                <div class="col-lg-3">
                                    <div class="card">
                                        <div class="stat-widget-one">
                                            <div class="profile-widget">
                                                <div class="stat-text">Số dư tài khoản</div>
                                                <div class="stat-digit"
                                                    style="display:flex; align-items:center; justify-content: center;">
                                                    {{$files->customer_cash}} <img
                                                        style="width:20px; height: 20px; margin-left:10px"
                                                        src="{{URL::to('/public/frontend/img/moon.png')}}" alt=""></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3">
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
                                <div class="col-lg-3">
                                    <div class="card">
                                        <div class="stat-widget-one">
                                            <div class="profile-widget">
                                                <div class="stat-text">Đã xuất bản</div>
                                                <div class="stat-digit "
                                                    style="display:flex; align-items:center; justify-content: center;">
                                                    {{$files->customer_publish}} <span
                                                        style="font-size: 15px; margin-left:5px"> Truyện
                                                        tranh</span></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3">
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
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="card alert">
                                        <div class="card-header">
                                            <h4>Nhập số lượng nguyệt tinh muốn thêm cho tài khoản này</h4>
                                        </div>
                                        <div class="card-body">
                                            <div class="basic-form">
                                                <form action="{{URL::to('add-more-cash/'.$files->customer_id)}}"
                                                    method="POST" onsubmit="return checkaddcash()">
                                                    @csrf
                                                    <input type="hidden" name="payment_history_id"
                                                        value="{{$this_payment->payment_history_id}}">
                                                    <div class="form-group">
                                                        <p class="text-muted m-b-15 f-s-12">Số lượng</p>
                                                        <input id="cash_more" name="cash_more" type="number"
                                                            class="form-control input-focus"
                                                            placeholder="Nhập số lượng">
                                                        <p class="text-danger" id="cash_more_err"></p>
                                                    </div>
                                                    <button type="submit"
                                                        style="border: none;outline: none;padding: 10px 20px 10px 20px;border-radius: 4px;background-color: #FA9144;color:#fff;margin-left:50%;">Thêm</button>
                                                </form>
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