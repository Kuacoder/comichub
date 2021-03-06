@extends('customer.layout')

@section('content')
<div class="container ">
    <div class="banner-fix">
        <div class="banner">
            <section id="banner1" class="banner1 carousel_item">
                @foreach($banner_1 as $key => $value)
                <a class="banner1-item item-of-banner" href="{{URL::to('/visit-comic/'.$value->comic_id)}}">
                    <img class="banner1-item_img" src="{{URL::to('/public/uploads/comic/'.$value->comic_img)}}" alt="">
                    <div href="#" class="banner__conten__element__vip">

                        <p>{{$value->comic_content}}</p>

                    </div>
                    <div class="tentruyen_banner_vip1">
                        <p>{{$value->comic_name}}</p>
                    </div>
                </a>
                @endforeach
            </section>
            <section id="banner2" class="banner2 carousel_item hidden">
                <?php $i=0; ?>
                <?php  foreach($banner_2 as $key => $value){$i++; ?>
                <a class="banner2-item<?php echo $i; ?> item-of-banner banner2-item"
                    href="{{URL::to('/visit-comic/'.$value->comic_id)}}"><img
                        src="{{URL::to('/public/uploads/comic/'.$value->comic_img)}}" alt="">
                    <div class="banner__conten__element__vip">
                        <p>{{$value->comic_content}}</p>
                    </div>
                    <div class="tentruyen_banner_vip2">
                        <p>{{$value->comic_name}}</p>
                    </div>
                </a>
                <?php } ?>
            </section>
            <section id="banner3" class="banner3 carousel_item hidden">
                <?php $i=0; ?>
                <?php  foreach($banner_3 as $key => $value){$i++; ?>
                <a class="banner3-item<?php echo $i; ?> item-of-banner banner3-item"
                    href="{{URL::to('/visit-comic/'.$value->comic_id)}}"><img
                        src="{{URL::to('/public/uploads/comic/'.$value->comic_img)}}" alt="">
                    <div href="#" class="banner__conten__element__vip">
                        <p>{{$value->comic_content}}</p>
                    </div>
                    <div class="tentruyen_banner_vip3">
                        <p>{{$value->comic_name}}</p>
                    </div>
                </a>
                <?php } ?>
            </section>

            <div class="banner-button">
                <button id="btn-prev" class="banner-button-btn banner-button-btn_rev"><img
                        src="{{URL::to('/public/frontend/img/right-chevron.svg')}}" alt=""></button>
                <button id="btn-next" class="banner-button-btn banner-button-btn_next"><img
                        src="{{URL::to('/public/frontend/img/right-chevron.svg')}}" alt=""></button>
            </div>

            <div class="line-btn-section">
                <div class="row line-btn-section__row">
                    <button id="line-btn1" class="line-btn line-btn1 col-4" style="background-color: orange;"></button>
                    <button id="line-btn2" class="line-btn line-btn2 col-4"
                        style="background-color: greenyellow;"></button>
                    <button id="line-btn3" class="line-btn line-btn3 col-4" style="background-color: yellow;"></button>
                </div>
                <div class="line-btn-section line-btn-section_active">
                    <div class="row line-btn-section__row">
                        <div class="line-btn-active line-btn-active1  col-4" style="background-color: red;">
                            <img class="image-btn-active" src="{{URL::to('/public/frontend/img/zero.gif')}}" alt="">
                        </div>
                        <div class="line-btn-active line-btn-active2 hidden col-4" style="background-color: red;">
                            <img class="image-btn-active" src="{{URL::to('/public/frontend/img/zero.gif')}}" alt="">
                        </div>
                        <div class="line-btn-active line-btn-active3 hidden col-4" style="background-color: red;">
                            <img class="image-btn-active" src="{{URL::to('/public/frontend/img/zero.gif')}}" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="hop-rank">
            <div class="hop-rank--title">
                <div class="hop-rank--title--element">X???p h???ng
                    <div class="hop-rank--body">
                        <?php $i = 0; foreach($xephang as $key => $value){$i++; ?>
                        @if($i <=3) <div class="hop-rank--body--element">
                            <div class="hop-rank--body--element--number bg-cam">{{$i}}</div>
                            <a class="hop-rank--body--element--name"
                                href="{{URL::to('visit-comic/'.$value->comic_id)}}">{{$value->comic_name}}</a>
                    </div>
                    @else
                    <div class="hop-rank--body--element">
                        <div class="hop-rank--body--element--number  bg-black">{{$i}}</div>
                        <a class="hop-rank--body--element--name"
                            href="{{URL::to('visit-comic/'.$value->comic_id)}}">{{$value->comic_name}}</a>
                    </div>
                    @endif
                    <?php } ?>
                </div>
            </div>
            <div class="hop-rank--title--element">Riman
                <div class="hop-rank--body hidden">
                    <?php $i = 0; foreach($riman as $key => $value){$i++; ?>
                    @if($i <=3) <div class="hop-rank--body--element">
                        <div class="hop-rank--body--element--number bg-cam">{{$i}}</div>
                        <a class="hop-rank--body--element--name"
                            href="{{URL::to('visit-comic/'.$value->comic_id)}}">{{$value->comic_name}}</a>
                </div>
                @else
                <div class="hop-rank--body--element">
                    <div class="hop-rank--body--element--number  bg-black">{{$i}}</div>
                    <a class="hop-rank--body--element--name"
                        href="{{URL::to('visit-comic/'.$value->comic_id)}}">{{$value->comic_name}}</a>
                </div>
                @endif
                <?php } ?>
            </div>
        </div>
        <div class="hop-rank--title--element">Guoman
            <div class="hop-rank--body hidden">
                <?php $i = 0; foreach($guoman as $key => $value){$i++; ?>
                @if($i <=3) <div class="hop-rank--body--element">
                    <div class="hop-rank--body--element--number bg-cam">{{$i}}</div>
                    <a class="hop-rank--body--element--name"
                        href="{{URL::to('visit-comic/'.$value->comic_id)}}">{{$value->comic_name}}</a>
            </div>
            @else
            <div class="hop-rank--body--element">
                <div class="hop-rank--body--element--number  bg-black">{{$i}}</div>
                <a class="hop-rank--body--element--name"
                    href="{{URL::to('visit-comic/'.$value->comic_id)}}">{{$value->comic_name}}</a>
            </div>
            @endif
            <?php } ?>
        </div>
    </div>
    <div class="hop-rank--title--element">To??n b???
        <div class="hop-rank--body hidden">
            <?php $i = 0; foreach($toanbo as $key => $value){$i++; ?>
            @if($i <=3) <div class="hop-rank--body--element">
                <div class="hop-rank--body--element--number bg-cam">{{$i}}</div>
                <a class="hop-rank--body--element--name"
                    href="{{URL::to('visit-comic/'.$value->comic_id)}}">{{$value->comic_name}}</a>
        </div>
        @else
        <div class="hop-rank--body--element">
            <div class="hop-rank--body--element--number  bg-black">{{$i}}</div>
            <a class="hop-rank--body--element--name"
                href="{{URL::to('visit-comic/'.$value->comic_id)}}">{{$value->comic_name}}</a>
        </div>
        @endif
        <?php } ?>
    </div>
</div>
</div>


</div>
</div>


</section>
<section class="slide-recomment">
    <div class="slide-recomment_top">
        <div class="slide-recomment_top_content">Khuy???n ngh??? m???nh m???</div>
        <div class="slide-recomment_top_line"></div>

    </div>
    <div class="slide-recomment_body slider">
        @foreach($all_khuyennghi as $key => $comic)
        <div class="comic-homePage ">
            <a href="{{URL::to('/visit-comic/'.$comic->comic_id)}}"><img
                    src="{{URL::to('/public/uploads/comic/'.$comic->comic_img)}}" alt="">
                <h6>Update</h6>
            </a>
            <h4><a href="{{URL::to('/visit-comic/'.$comic->comic_id)}}">{{$comic->comic_name}}</a></h4>
            <a href="{{URL::to('/visit-comic/'.$comic->comic_id)}}">{{$comic->comic_content}}</a>
        </div>
        @endforeach
    </div>
</section>
</div>
<div class="container">
    <div class="list-best-sale-comicHomePage">
        <section class="comic-best-sale">
            <div class="comic-best-sale_title">
                Truy???n tranh b??n ch???y nh???t
            </div>
            <div class="comic-best-sale_body">
                <ul>
                    <li><a class="comic-best-sale_body_cate1 active-primary" href="{{URL::to('/see-all-comic')}}">T???t c???
                            truy???n</a>
                        <div class="comic-best-sale_body_cate_page1 comic-best-sale_body_cate_page">
                            <?php $i=0; ?>
                            <?php foreach($banchaynhat_8 as $key => $value){$i++; ?>
                            <div class="comic-homePage">
                                <a href="{{URL::to('/visit-comic/'.$value->comic_id)}}"><img
                                        src="{{URL::to('/public/uploads/comic/'.$value->comic_img)}}" alt="">
                                    <h6>Update</h6>
                                </a>
                                <a href="{{URL::to('/visit-comic/'.$value->comic_id)}}">{{$value->comic_desc}}</a>
                            </div>
                            <?php if($i==6){break;} } ?>
                        </div>
                    </li>

                </ul>
            </div>
        </section>
        <section class="list-best-sale">
            <div class="list-best-sale_title">
                <img src="{{URL::to('/public/frontend/img/icon-top-sale.png')}}" alt="">
                <p>Danh s??ch b??n ch???y nh???t</p>
            </div>
            <div class="row">
                <div class="col-6">
                    <ul>
                        <?php $i=0; ?>
                        @foreach($banchaynhat_8 as $key => $value)<?php $i++; ?>
                        @if($i == 1)
                        <li>
                            <div class="table-ranking_list_top">{{$i}}</div><a
                                href="{{URL::to('/visit-comic/'.$value->comic_id)}}">{{$value->comic_name}}</a>
                        </li>
                        @else
                        <li>
                            <div class="table-ranking_list_second">{{$i}}</div><a
                                href="{{URL::to('/visit-comic/'.$value->comic_id)}}">{{$value->comic_name}}</a>
                        </li>
                        @endif
                        @endforeach
                    </ul>
                </div>
                <div class="col-6">
                    <ul>
                        <?php $i=8; ?>
                        @foreach($banchaynhat_16 as $key => $value)<?php $i++; ?>
                        <li>
                            <div class="table-ranking_list_second">{{$i}}</div><a
                                href="{{URL::to('/visit-comic/'.$value->comic_id)}}">{{$value->comic_name}}</a>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </section>
    </div>
</div>

<div class="container">
    <section class="comic-gender">
        <div class="comic-gender-left">
            <div class="comic-gender-left_top">
                <div class="comic-gender-left_title">
                    <p>Truy???n tranh nam</p>
                    <img class="comic-gender-left_title_img" src="{{URL::to('/public/frontend/img/colum-chart.png')}}"
                        alt="">
                    <a href="{{URL::to('/see-comic-gender/0')}}" class="comic-gender-left_title_list_name">Danh s??ch c???u
                        b??</a>
                    <a href="{{URL::to('/see-comic-gender/0')}}" class="more">Th??m <span><img
                                src="{{URL::to('/public/frontend/img/right-chevron.svg')}}" alt=""></span><span><img
                                src="{{URL::to('/public/frontend/img/right-chevron.svg')}}" alt=""></span></a>
                </div>
                @foreach($comic_boy as $key => $value)
                <div class="comic-homePage comic-homePage1">
                    <a href="{{URL::to('/visit-comic/'.$value->comic_id)}}">
                        <img src="{{URL::to('/public/uploads/comic/'.$value->comic_img)}}" alt="">
                        <h6>Update</h6>
                    </a>
                    <a href="{{URL::to('/visit-comic/'.$value->comic_id)}}">{{$value->comic_name}}</a>
                    <p>{{$value->comic_content}}</p>
                </div>
                @endforeach
            </div>
            <div class="comic-gender-left_bot">
                <div class="comic-gender-left_title">
                    <p>Truy???n tranh n???</p>
                    <img class="comic-gender-left_title_img" src="{{URL::to('/public/frontend/img/colum-chart.png')}}"
                        alt="">
                    <a href="{{URL::to('/see-comic-gender/1')}}" class="comic-gender-left_title_list_name">Danh s??ch c??
                        g??i</a>
                    <a href="{{URL::to('/see-comic-gender/1')}}" class="more">Th??m <span><img
                                src="{{URL::to('/public/frontend/img/right-chevron.svg')}}" alt=""></span><span><img
                                src="{{URL::to('/public/frontend/img/right-chevron.svg')}}" alt=""></span></a>
                </div>
                @foreach($comic_girl as $key => $value)
                <div class="comic-homePage comic-homePage1">
                    <a href="{{URL::to('/visit-comic/'.$value->comic_id)}}">
                        <img src="{{URL::to('/public/uploads/comic/'.$value->comic_img)}}" alt="">
                        <h6>Update</h6>
                    </a>
                    <a href="{{URL::to('/visit-comic/'.$value->comic_id)}}">{{$value->comic_name}}</a>
                    <p>{{$value->comic_content}}</p>
                </div>
                @endforeach
            </div>
        </div>
        <div class="comic-gender-right">
            <div class="comic-gender-right_title comic-gender-left_title">
                <h6>TOP TI??U S??I</h6>

            </div>
            <div class="comic-gender-right_title2">
                <p>T??N</p>
                <p>???? TI??U S??I</p>
            </div>
            <?php $i=0;
                foreach($toptieusai as $key => $value){$i++;
                if($i <= 3){
            ?>
            <div class="comic-gender-right_rank">
                <div class="comic-gender-right_rank_stt comic-gender-right_rank_stt_top">{{$i}}</div>
                <div class="comic-gender-right_rank_account">{{$value->customer_name}}</div>
                <div class="comic-gender-right_rank_cash">{{$value->cash_used}} <span><img
                            src="{{URL::to('/public/frontend/img/moon.png')}}" alt=""></span></div>
            </div>
            <?php }else{ ?>
            <div class="comic-gender-right_rank">
                <div class="comic-gender-right_rank_stt comic-gender-right_rank_stt_second">{{$i}}</div>
                <div class="comic-gender-right_rank_account">{{$value->customer_name}}</div>
                <div class="comic-gender-right_rank_cash">{{$value->cash_used}} <span><img
                            src="{{URL::to('/public/frontend/img/moon.png')}}" alt=""></span></div>
            </div>
            <?php } }?>
        </div>
    </section>
</div>

<div class="container-fluid">
    <section class="footer">
        <div class="footer-top">
        </div>
        <div class="footer-body">
            <div class="footer-body_QR">
                <img src="{{URL::to('/public/frontend/img/ac_qr_img.jpg')}}" alt="">
                <p>???ng d???ng kh??ch</p>
                <p>Tencent</p>
                <p>Animation</p>
            </div>
            <div class="footer-body_QR">
                <img src="{{URL::to('/public/frontend/img/ac_wx_img.jpg')}}" alt="">
                <p>Tencent</p>
                <p>Animation Wechat</p>
            </div>
            <ul>
                <li><a href="#">S?? ????? trang web</a></li>
                <li><a href="#">Trung t??m tr??? gi??p</a></li>
                <li><a href="#">Th???a thu???n d???ch v???</a></li>
                <li><a href="#">Blog ch??nh th???c</a></li>
                <li><a href="#">Ph???n h???i vi ph???m</a></li>
                <li><a href="#">H???p t??c kinh doanh</a></li>
                <li>Li??n h???: <a href="#">ac.qq.com</a></li>
            </ul>
            <pre>
                ICP Qu???ng ????ng s??? 16117015-1 Qu???ng ????ng Wangwen (2019) S??? 2460-563
                B???n quy???n ?? 1998-2021 Tencent. M???i quy???n ???????c b???o l??u
                Th??m Quy???n Tencent Animation Co., Ltd. M???i quy???n ???????c b???o l??u
            </pre>
        </div>
    </section>
</div>

@include('customer.sidebar')
@endsection