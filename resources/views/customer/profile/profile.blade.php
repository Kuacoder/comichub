@include('customer.profile.head_sidebar')
<div class="account-page-body_content_details">
    <div class="account-page-body_content_details_top">
        <div class="account-page-body_content_details_top_img"><img
                src="/public/uploads/customer/<?= $customer_profile->customer_avatar ?>" alt=""></div>
        <div class="account-page-body_content_details_top_content">
            <li class="relative" style="border-bottom: 1px dashed #C1B7A9;font-size: 17px;">Tên:
                {{$customer_profile->customer_name}}
                <a class="thongbao--box">
                    <input id="customer_id_vip" type="hidden" value="{{Session::get('customer_id')}}">
                    @if($number_noti > 0)
                    <div id="number_noti" class="thongbao--box--gadget">{{$number_noti}}</div>
                    @endif
                    <img id="this_noti" class="thongbao--box--bell" src="{{('/public/frontend/img/bell.svg')}}" alt="">
                    <div class="thongbao--content--nay hidden">
                        <?php foreach($all_noti as $key => $value){
                                            echo $value->noti_content;
                                            $curren_time = time() - $value->day_create_noti; ?>
                        <p class="text-end">{{date("H:i:s",$curren_time)}} trước</p>
                        <?php } ?>
                    </div>
                </a>
            </li>
            <div class="content-group" style="margin-top: 10px;">
                <li><img src="{{URL::to('public/frontend/img/d.png')}}" alt="">Điểm còn lại: <span
                        class="mark">{{$customer_profile->customer_cash}}</span><a href="#">Chi tiet</a></li>
                <a id="buygem" href="#" class="mark-plus mark-plus-hover">Thêm điểm</a>
            </div>
            <li><img src="{{URL::to('public/frontend/img/used-mark.png')}}" alt="">Điểm đã dùng: <span
                    class="mark">{{$customer_profile->cash_used}}</span><a href="#">Chi tiet</a></li>

            <div class="content-group2">
                <div class="content-group2_element">
                    Tủ truyện: <span>{{$customer_profile->customer_publish}}</span>
                </div>

            </div>

        </div>

    </div>
    <div class="account-page-body_content_collection">

        <div class="account-page-body_content_collection_title_bought border-bot-dashed">
            <?php $i = 0 ; foreach($truyendamua as $key => $damua){ $i++;} ?>
            <h2 class="border-left-blue">Tác phẩm đã mua</h2>Đã mua <span> {{$i}} </span> tác phẩm
        </div>

        @if($i > 0)
        <div class="table_damua_vip">
            <div class="table_damua_vip3">
                <p>Tác phẩm</p>
                <p>Chương</p>
                <p>Tác giả</p>
            </div>
            <div class="table_damua_vip1">
                <?php  foreach($truyendamua as $key => $damua){ ?>
                <div class="table_damua_vip2">
                    <a href="{{URL::to('visit-comic/'.$damua->comic_id)}}">{{$damua->comic_name}}</a>
                    <a href="{{URL::to('read-chapter/'.$damua->chapter_id)}}">{{$damua->chapter_name}}</a>
                    <p>{{$damua->author_comic}}</p>
                </div>
                <?php } ?>
            </div>
        </div>


        @else
        <div class="account-page-body_content_collection_list border-bot-dashed">
            <div class="account-page-body_content_collection_list_nolist ">
                <img src="{{URL::asset('/public/frontend/img/you-dont-buy-anything.png')}}" alt="">
            </div>
        </div>
        @endif
    </div>
</div>
<?php $mess=Session::get('mess'); $fail = Session::get('fail');  if($mess){ ?>
<div id="modal--noti--cus--profile">
    <div class="modal--noti--cus--profile--table">
        <h1 class="modal--noti--cus--profile--table--title">Thông báo</h1>
        <p class="modal--noti--cus--profile--table--content chu--xanh">{{$mess}}</p>
        <button style="font-family: astro;" id="close--noti--cus--profile"><?php Session::put('mess', null); ?>Đã
            hiểu</button>
    </div>
</div>
<?php } ?>
<?php if($fail){ ?>
<div id="modal--noti--cus--profile">
    <div class="modal--noti--cus--profile--table">
        <h1 class="modal--noti--cus--profile--table--title">Thông báo</h1>
        <p class="modal--noti--cus--profile--table--content chu--do">{{$fail}}</p>
        <button style="font-family: astro;" id="close--noti--cus--profile"><?php Session::put('fail', null); ?>Đã
            hiểu</button>
    </div>
</div>
<?php } ?>
<script>
var close__mess__noti = document.getElementById('close--noti--cus--profile');
if (close__mess__noti != null) {
    let modal__mess = document.getElementById('modal--noti--cus--profile');
    close__mess__noti.addEventListener('click', function() {
        modal__mess.classList.add('hidden');
    });
}
</script>

<script>
$('#this_noti').click(function() {
    let customer_id_vip = $('#customer_id_vip').val();
    $('#number_noti').addClass('hidden');
    $('.thongbao--content--nay').toggleClass('hidden');
    xmlhttp = new XMLHttpRequest();
    xmlhttp.open("GET", "/reset-number-noti/" + customer_id_vip, false);
    xmlhttp.send();
});
</script>
@include('customer.profile.footer_script')