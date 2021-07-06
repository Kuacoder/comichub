<?php 
							    $success = Session::get('success');
                                $fail = Session::get('fail');
							    if ($success) { ?>
<div id="modal--noti--cus--profile">
    <div class="modal--noti--cus--profile--table">
        <h1 class="modal--noti--cus--profile--table--title">Thông báo</h1>
        <p class="modal--noti--cus--profile--table--content">{{$success}}</p>
        <button style="font-family: astro;" id="close--noti--cus--profile"><?php Session::put('success', null); ?>Đã
            hiểu</button>
    </div>
</div>
<?php
							    }elseif($fail) { ?>
<div id="modal--noti--cus--profile">
    <div class="modal--noti--cus--profile--table">
        <h1 class="modal--noti--cus--profile--table--title">Thông báo</h1>
        <p class="modal--noti--cus--profile--table--content">{{$fail}}</p>
        <button style="font-family: astro;" id="close--noti--cus--profile"><?php Session::put('fail', null); ?>Đã
            hiểu</button>
    </div>
</div>
<?php }else{
								Session::put('success',null);
                                Session::put('fail',null);
							    }
							    ?>
<?php $mess=Session::get('mess'); $fail = Session::get('fail');  if($mess){ ?>
<div id="modal--noti--cus--profile">
    <div class="modal--noti--cus--profile--table">
        <h1 class="modal--noti--cus--profile--table--title">Thông báo</h1>
        <p class="modal--noti--cus--profile--table--content">{{$mess}}</p>
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
<div id="modal--buy" class="hidden">
    <div class="modal--buy--table">
        <div class="modal--buy--table__title">
            <h1>nạp nguyệt tinh</h1>
            <div class="modal--buy--table__title__close">
                <p id="close--buy">X</p>
            </div>
        </div>
        <form class="modal--buy--table__buy" action="{{URL::to('/napthe')}}" method="POST">
            @csrf
            <input type="hidden" name="customer_id" value="<?php echo Session::get('customer_id') ?>">
            <div class="modal--buy--table__body">
                <div class="modal--buy--table__body__left">
                    <select name="loaithe" id="loaithe">
                        <option value="0">Chọn loại thẻ</option>
                        <option value="1">Viettel</option>
                        <option value="2">Mobiphone</option>
                        <option value="3">Vinaphone</option>
                    </select>
                    <select name="menhgia" id="menhgia">
                        <option value="0">Mệnh giá</option>
                        <option value="10000">10.000</option>
                        <option value="20000">20.000</option>
                        <option value="30000">30.000</option>
                        <option value="50000">50.000</option>
                        <option value="100000">100.000</option>
                        <option value="200000">200.000</option>
                        <option value="500000">500.000</option>
                    </select>
                    <input type="text" id="serial" name="serial" placeholder="Nhập serial">
                    <input type="text" id="ma_the" name="ma_the" placeholder="Nhập mã thẻ">
                </div>
                <div class="modal--buy--table__body__right">
                    <h4>Chú ý:</h4>
                    <p>- Yêu cầu điền đúng thông tin thẻ</p>
                    <p>- Comichub không chịu trách nhiệm khi bạn nạp sai thẻ.</p>
                    <h4 style="margin-top: 20px;">Tỉ lệ quy đổi:</h4>
                    <p>1.000 VNĐ = 1.000 Nguyệt tinh</p>
                </div>
            </div>
            <div class="modal--buy--table__bot">
                <div class="nhap_lai">Nhập lại</div>
                <button class="napthe" type="submit">Nạp thẻ</button>
            </div>

        </form>
    </div>
</div>

<script>
var close__mess__noti = document.getElementById('close--noti--cus--profile');
if (close__mess__noti != null) {
    let modal__mess = document.getElementById('modal--noti--cus--profile');
    close__mess__noti.addEventListener('click', function() {
        modal__mess.classList.add('hidden');
    });
}
$('.open_rep_comment').click(function() {
    $(this).find('.user--rep--comment').removeClass('hidden');
    $(this).find('.an_cai_nay').addClass('hidden');
});
$('#submit_rep_comment').click(function() {
    $('#form_rep_comment').submit();
});
$('#close--buy').click(function() {
    $('#modal--buy').addClass('hidden');
    $('#modal--buy').removeClass('display');
});
$('#buygem').click(function() {
    $('#modal').addClass('hidden');
    $('#modal').removeClass('display');
    $('#modal--buy').removeClass('hidden');
    $('#modal--buy').addclass('display');

});
$('#close').click(function() {
    $('#modal').addClass('hidden');
    $('#modal').removeClass('display');
});
$('#unlock-chapter').click(function() {
    $('#modal').removeClass('hidden');
    $('#modal').addClass('display');
});
</script>
<script src="{{URL::asset('/public/backend/js/lib/jquery.min.js')}}"></script><!-- jquery vendor -->
<script src="{{URL::asset('/public/frontend/js/boxxephang.js')}}"></script>
<script src="{{URL::asset('/public/frontend/js/thongbao.js')}}"></script>
<script src="{{URL::asset('/public/frontend/js/myscript.js')}}"></script>
<script src="{{URL::asset('/public/frontend/js/style.js')}}"></script>
<script src="{{URL::asset('/public/frontend/js/slick.js')}}"></script>
<script src="{{URL::asset('/public/frontend/js/best-sale.js')}}"></script>
<script src="{{URL::asset('/public/frontend/js/table-best-sale-on-month.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"
    integrity="sha512-XtmMtDEcNz2j7ekrtHvOVR4iwwaD6o/FUJe6+Zq+HgcCsk3kj4uSQQR8weQ2QVj1o0Pk6PwYLohm206ZzNfubg=="
    crossorigin="anonymous"></script>

</body>

</html>