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
<div class="content-wrap ">
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
                                            <h1 style="text-align: center;">Thêm tài khoản khách</h1>
                                        </div>
                                        <div class="card-body">
                                            <div class="basic-form">
                                                <form method="POST" action="{{url('/save-customer')}}"
                                                    enctype="multipart/form-data" name="myForm"
                                                    onsubmit="return validateForm();">
                                                    {{csrf_field()}}
                                                    <div class="form-group">
                                                        <p class="text-muted m-b-15 f-s-12" style="font-size:larger;">
                                                            Tên khách hàng</p>
                                                        <input name="customer_name" type="text"
                                                            class="form-control input-focus"
                                                            placeholder="Nhập tên của bạn">
                                                    </div>
                                                    <div class="form-group">
                                                        <p class="text-muted m-b-15 f-s-12" style="font-size:larger;">
                                                            ảnh đại diện</p>
                                                        <input type="file" name="customer_avatar"
                                                            class="form-control input-focus" placeholder="Choose Avatar"
                                                            id="coverimg_picture">
                                                        <label for="coverimg_picture" class="label_file_vip">Chọn ảnh
                                                            đại diện</label>
                                                    </div>
                                                    <div class="form-group">
                                                        <p class="text-muted m-b-15 f-s-12" style="font-size:larger;">
                                                            Email</p>
                                                        <input id="email_input" name="customer_email" type="email"
                                                            class="form-control input-focus" placeholder="Nhập Email">
                                                        <div id="admin_email_err">

                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <p class="text-muted m-b-15 f-s-12" style="font-size:larger;">
                                                            Mật khẩu</p>
                                                        <input name="customer_password" type="password"
                                                            class="form-control input-focus"
                                                            placeholder="Nhập mật khẩu">
                                                    </div>
                                                    <div class="form-group">
                                                        <p class="text-muted m-b-15 f-s-12" style="font-size:larger;">
                                                            ngày sinh</p>
                                                        <input class="form-control input-focus" type="date"
                                                            id="birthday" name="customer_birthday" min="1970-01-01"
                                                            max="2021-12-31">
                                                    </div>
                                                    <div class="form-group">
                                                        <label style="font-size:larger;">Giới tính</label>
                                                        <select class="form-control input-focus" name="customer_gender">
                                                            <option value="0">Nam</option>
                                                            <option value="1">Nữ</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <p class="text-muted m-b-15 f-s-12" style="font-size:larger;">
                                                            Số điện thoại</p>
                                                        <input name="customer_phone" type="text"
                                                            class="form-control input-focus"
                                                            placeholder="Nhập số điện thoại">
                                                    </div>
                                                    <div class="form-group">
                                                        <p class="text-muted m-b-15 f-s-12" style="font-size:larger;">
                                                            Địa chỉ</p>
                                                        <input name="customer_address" type="text"
                                                            class="form-control input-focus"
                                                            placeholder="Nhập địa chỉ của bạn">
                                                    </div>
                                                    <input type="hidden" name="customer_status" value="1">
                                                    <input type="hidden" name="customer_title" value="0">
                                                    <button type="submit" id="myBtn" class="btn btn-primary "
                                                        style="font-size:larger; margin-left: 45%;">Thêm</button>
                                                </form>
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

</div>
</div>
<script>
function validateEmail(email) {
    const re =
        /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
}
$('#email_input').keyup(function() {
    let email_input = $('#email_input').val();

});

$('#email_input').keyup(function() {
    let email_input = $('#email_input').val();


    if (validateEmail(email_input)) {
        var _token = $('input[name="_token"]').val();
        $.ajax({
            url: "/validate-email",
            type: 'POST',
            data: {
                _token: _token,
                email_input: email_input
            },
            success: function(data) {
                $('#admin_email_err').fadeIn();
                $('#admin_email_err').html(data);
            }
        });

    } else {
        let err = '<p class="m-t-10 text-danger">Email is not valid!</p>'
        $('#admin_email_err').html(err);

    }
});
</script>
@endsection