@include('customer.head')
<?php  $customer_id = Session::get('customer_id'); ?>
<div class="header--read--comic">
    <a href="{{URL::to('/')}}"><img src="{{URL::to('/public/frontend/img/textLogo-header.svg')}}" alt=""></a>
    <div class="header--read--comic--menu">
        <a href="{{URL::to('/')}}">Trang chủ ></a>
        <a href="{{URL::to('/visit-comic/'.$this_comic->comic_id)}}">{{$this_comic->comic_name}} ></a>
        @if($this_chapter != null)
        <a href="{{URL::to('/read-chapter/'.$this_chapter->chapter_id)}}">{{$this_chapter->chapter_name}}</a>
        @else
        <p>Không có chương nào</p>
        @endif
    </div>
</div>
<div class="body--read--comic">
    <div class="body--read--comic__content">
        <?php if(isset($curent_chapter) &&  $this_chapter->author_id_chapter != null){ ?>
        @foreach($all_chapter_content as $key => $chapter_content)
        <img src="{{URL::to('/public/uploads/chapter/'.$chapter_content->chapter_img)}}" alt="">
        @endforeach
        <?php }elseif(isset($chapter_unlock)
        && $chapter_unlock->chapter_id == $this_chapter->chapter_id 
        && $chapter_unlock->customer_id == $customer_id 
        && $chapter_unlock->comic_id == $this_chapter->comic_id){ ?>
        @foreach($all_chapter_content as $key => $chapter_content)
        <img src="{{URL::to('/public/uploads/chapter/'.$chapter_content->chapter_img)}}" alt="">
        @endforeach
        <?php }else{ ?>
        <?php if($this_chapter == null){ ?>
        <div class="unlock-chapter">
            <h1>Hiện tại bộ truyện này chưa có sẵn để đọc chúng tôi sẽ liên hệ tác giả để tác giả cập nhật sớm! Xin lỗi
                vì sự bất tiện này :(</h1>
        </div>


        <?php }elseif($this_chapter->chapter_price == 0 || $this_chapter->author_id_chapter == $customer_id ){ ?>
        @foreach($all_chapter_content as $key => $chapter_content)
        <img src="{{URL::to('/public/uploads/chapter/'.$chapter_content->chapter_img)}}" alt="">
        @endforeach
        <?php }elseif($this_chapter->chapter_price > 0){ ?>
        <div class="unlock-chapter">
            <h1>Tập truyện bạn đọc có trả phí và bạn cần phải mở khóa để đọc!</h1>
            <?php if(Session::get('customer_id')){ ?>
            <button id="unlock-chapter" type="button">Mở khóa</button>
            <?php }else{ ?>
            <a class="unlock--chapter--button" href="/login-customer" type="button">Đăng nhập để mở khóa</a>
            <?php } ?>

        </div>
        <?php } ?>

        <?php } ?>

    </div>
    <div class="body--read--comic__table">
        <p>Chương</p>
        <?php $i =0; ?>
        <?php foreach($all_chapter as $key => $chapters){ $i++; ?>
        @if($chapters->chapter_price > 0)
        <li><span>[<?php echo $i ?>]</span><a
                href="{{URL::to('/read-chapter/'.$chapters->chapter_id)}}">{{$chapters->chapter_name}}</a><img
                src="{{URL::to('/public/frontend/img/coin.png')}}" alt=""></li>
        @elseif($chapters->chapter_price == 0)
        <li><span>[<?php echo $i ?>]</span><a
                href="{{URL::to('/read-chapter/'.$chapters->chapter_id)}}">{{$chapters->chapter_name}}</a><img
                src="{{URL::to('/public/frontend/img/free.png')}}" alt=""></li>
        @endif
        <?php } ?>

        <p>Tổng <?php echo $i; ?> tập</p>
    </div>
</div>
<?php 
    if($this_chapter && Session::get('customer_id')){
        if($this_chapter->chapter_price < $this_customer->customer_cash){ ?>
<div id="modal" class="hidden">
    <div class="modal--table">
        <div class="modal--table--top">
            <div class="modal--table--top--group">
                <h1>Chương này cần trả phí</h1>
                <p>Ủng hộ tác giả vài nguyệt tinh để ăn sáng</p>
                <p id="close">x</p>
            </div>
            <div class="modal--table--top--group__sup">
                <p>Số dư tài khoản: <span>{{$this_customer->customer_cash}} Nguyệt tinh</span></p>
                <div class="modal--table--top--group__sup1">
                    <a href=""><img src="{{URL::to('/public/frontend/img/question.png')}}" alt="">Mô tả</a>
                    <a href=""><img src="{{URL::to('/public/frontend/img/question.png')}}" alt="">Phản hồi</a>
                </div>
            </div>
        </div>
        <div class="modal--table--bot">
            <div class="modal--table--bot__title">
                <h1>Mua chương này</h1>
            </div>
            <div class="modal--table--bot__content">
                <h4>@foreach($all_comic as $key => $comic)
                    @if($comic->comic_id == $this_chapter->comic_id)
                    {{$comic->comic_name}} @endif @endforeach - chương {{$this_chapter->chapter_name}} -
                    {{$this_chapter->chapter_desc}}</h4>
                <h1><img src="{{URL::to('/public/frontend/img/moon.png')}}" alt=""> {{$this_chapter->chapter_price}}
                    nguyệt tinh</h1>
                <form action="/unlock-chapter" method="post">
                    @csrf
                    <input type="hidden" name="comic_id" value="{{$this_chapter->comic_id}}">
                    <input type="hidden" name="chapter_id" value="{{$this_chapter->chapter_id}}">
                    <input type="hidden" name="numberical_order" value="{{$this_chapter->numberical_order}}">
                    <input type="hidden" name="customer_id" value="{{$customer_id}}">
                    <input type="hidden" name="customer_cash" value="{{$this_customer->customer_cash}}">
                    <input type="hidden" name="cash_used" value="{{$this_customer->cash_used}}">
                    <input type="hidden" name="author_id" value="{{$this_chapter->author_id_chapter}}">
                    <input type="hidden" name="chapter_price" value="{{$this_chapter->chapter_price}}">
                    @foreach($all_comic as $key => $comic)
                    @if($comic->comic_id == $this_chapter->comic_id)
                    <input type="hidden" name="comic_schedule" value="{{$comic->comic_schedule}}">
                    @endif @endforeach
                    <button type="submit" id="subbmit-unlock-chapter">mở khóa</button>
                </form>

            </div>
            <div class="modal--table--bot__checkbox">
                <input type="checkbox">tự động mở khóa
            </div>
        </div>
    </div>
</div>
<?php }else{ ?>
<div id="modal" class="hidden">
    <div class="modal--table--white">
        <div class="modal--table--white--content">
            <div class="modal--table--white--content__title">
                <h1>Thông báo</h1>
            </div>
            <div class="modal--table--white--content__body">
                <h4>Thí chủ, Số dư hiện tại của ngươi không đủ</h4>
                <p>lần mở khóa này cần {{$this_chapter->chapter_price}} nguyệt tinh, nguyệt tinh hiện có
                    {{$this_customer->customer_cash}}</p>
                <a id="buygem" href="#">Nạp thêm</a>
            </div>
        </div>
        <div class="modal--table--white--close">
            <p id="close">X</p>
        </div>
    </div>
</div>
<?php } }?>

<?php if(Session::get('customer_id') != null && $number_noti > 0){ ?>

<div id="popupthongbao1">
    <a class="noidungthongbao2" href="{{URL::to('/profile-customer/'.Session::get('customer_id'))}}">Bạn có
        {{$number_noti}} thông báo mới!</a>
    <p id="close__thongbao1">x</p>
</div>

<?php } ?>




@include('customer.script')