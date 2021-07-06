@extends('customer.layout')
@include('customer.sidebar')
@section('content')
<!-- BODY -->
<div class="container">
    <div class="cate--vip">
        <div class="cate--vip--title">
            <a href="/" class="cate--vip--title--element">Trang chủ /</a>
            <a href="" class="cate--vip--title--element">Tất cả truyện</a>
            <p>/ Số lượng: <span class="cate--vip--so--truyen">{{$number_comic}}</span> Tác Phẩm</p>
        </div>
        <div class="cate--truyen">
            <?php foreach($all_comic as $key => $value){ ?> 
            <a href="{{URL::to('/visit-comic/'.$value->comic_id)}}" class="cate--truyen--element">
                <div class="cate--truyen--element--img">
                    <img src="{{URL::asset('/public/uploads/comic/'.$value->comic_img)}}" alt="">
                    <div class="cate--truyen--element--ten"><p>{{$value->comic_name}}</p></div>
                </div>
                <div class="cate--truyen--element--chapter">
                    
                    <p> Hiện có : <span class="cate--vip--so--truyen"><?php $j=0; ?> @foreach($all_chapter as $key => $chapter)
                    @if($chapter->comic_id == $value->comic_id)<?php $j++; ?> @endif @endforeach{{$j}}</span> Chương</p>
                </div>
                <div class="cate--truyen--element--chapter">
                    
                    <p>Đã bán : <span class="cate--vip--so--truyen"><?php $k=0; ?> @foreach($daban as $key => $dabandc)
                    @if($dabandc->comic_id == $value->comic_id)<?php $k++; ?> @endif @endforeach{{$k}}</span> Chương</p>
                </div>
            </a>
            <?php } ?>
        </div>
    </div>
    <div class="phantrang-cate">
                   
                   {{ $all_comic->links() }}
               
              
    </div>
              

</div>
<div class="container-fluid">
        <section class="footer">
            <div class="footer-top">
            </div>
            <div class="footer-body">
                <div class="footer-body_QR">
                    <img src="{{URL::to('/public/frontend/img/ac_qr_img.jpg')}}" alt="">
                    <p>Ứng dụng khách</p>
                    <p>Tencent</p>
                    <p>Animation</p>
                </div>
                <div class="footer-body_QR">
                    <img src="{{URL::to('/public/frontend/img/ac_wx_img.jpg')}}" alt="">
                    <p>Tencent</p>
                    <p>Animation Wechat</p>
                </div>
                <ul>
                    <li><a href="#">Sơ đồ trang web</a></li>
                    <li><a href="#">Trung tâm trợ giúp</a></li>
                    <li><a href="#">Thỏa thuận dịch vụ</a></li>
                    <li><a href="#">Blog chính thức</a></li>
                    <li><a href="#">Phản hồi vi phạm</a></li>
                    <li><a href="#">Hợp tác kinh doanh</a></li>
                    <li>Liên hệ: <a href="#">ac.qq.com</a></li>
                </ul>
                <pre>
                    ICP Quảng Đông số 16117015-1 Quảng Đông Wangwen (2019) Số 2460-563
                    Bản quyền © 1998-2021 Tencent. Mọi quyền được bảo lưu
                    Thâm Quyến Tencent Animation Co., Ltd. Mọi quyền được bảo lưu
                </pre>
            </div>
        </section>
    </div>
    @endsection