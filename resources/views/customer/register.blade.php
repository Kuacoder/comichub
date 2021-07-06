@include('customer.head')
<div class="register-account-page container-fluid">
    <div class="register-account">
        <div class="register-account-title">
            <li><a href="{{URL::to('/login-customer')}}">Đăng nhập</a></li>
            <li><a class="active-primary" href="{{URL::to('/register-customer')}}">Đăng ký tài khoản</a></li>

            <a class="close" href="/"><i class="far fa-times-circle"></i></a>
        </div>
        <form name="myForm" action="{{URL::to('/register-customer-request')}}" method="POST" name="myForm"
            onsubmit="return validateFormRegister();">
            @csrf
            <div class="form-title">
                <h4>hãy nhập chính xác thông tin của bạn vào biểu mẫu đăng ký</h4>
            </div>
            <div class="left">
                <?php 
                                $message = Session::get('message');
                              if ($message) { ?>
                <div id="login_admin_err" class="text-do center">
                    <?php echo $message;
                                Session::put('message',null); ?>
                </div>
                <?php 
                              }else {
                                Session::put('message',null); 
                              }
                              ?>
                <input id="login_email" type="text" name="customer_email" placeholder="Email">
                <p class="text-do m-l-20" id="email_error"></p>
                <input type="password" name="customer_password" placeholder="Mật khẩu">
                <p class="text-do m-l-20" id="password_error"></p>
                <input type="password" name="password_replace" placeholder="nhập lại mật khẩu">
                <p class="text-do m-l-20" id="password2_error"></p>
                <!-- <div class="left2"> <input type="text" placeholder="mã xác minh"> <a href="#">Nhận mã</a></div> -->
            </div>
            <!-- <div class="right">
                            <h4>Quyền của chúng tôi</h4>
                            <div class="form-group">
                                <label class="checkbox" style=>
                                    <span class="checkbox__input">
                                      <input type="checkbox" name="checkbox">
                                      <span class="checkbox__control">
                                        <svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' aria-hidden="true" focusable="false">
                                          <path fill='none' stroke='currentColor' stroke-width='3' d='M1.73 12.91l6.37 6.37L22.79 4.59' /></svg>
                                      </span>
                                    </span>
                                    <span class="radio__label" style="margin: 3px 0px 0px -5px; color: black; font-size: small;">Đồng ý</span>
                                  </label>
                            </div>
                            <div class="form-group">
                                <label class="checkbox" >
                                    <span class="checkbox__input">
                                      <input type="checkbox" name="checkbox">
                                      <span class="checkbox__control">
                                        <svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' aria-hidden="true" focusable="false">
                                          <path fill='none' stroke='currentColor' stroke-width='3' d='M1.73 12.91l6.37 6.37L22.79 4.59' /></svg>
                                      </span>
                                    </span>
                                    <span class="radio__label" style="margin: 3px 0px 0px -5px; color: black; font-size: small;">Xem tên, ảnh đại diện, giới tính</span>
                                  </label>
                            </div>
                            <h4>Đồng ý coi như bạn đã chấp nhận với <span>Điều khoản</span> của chúng tôi</h4>
                        </div> -->

            <button type="submit">đăng ký</button>
        </form>
    </div>
</div>
<script>
function validateEmail(email) {
    const re =
        /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
}
$('#login_email').keyup(function() {
    let login_email = $('#login_email').val();


    if (validateEmail(login_email)) {
        var _token = $('input[name="_token"]').val();
        $.ajax({
            url: "/validate-email-customer",
            type: 'POST',
            data: {
                _token: _token,
                login_email: login_email
            },
            success: function(data) {
                $('#email_error').fadeIn();
                $('#email_error').html(data);
            }
        });

    } else {
        let err = '<p class="m-l-10 text-do">Email không hợp lệ!</p>'
        $('#email_error').html(err);

    }
});

function validateFormRegister() {
    var customer_email = document.forms["myForm"]["customer_email"].value;
    var customer_password = document.forms["myForm"]["customer_password"].value;
    var password_replace = document.forms["myForm"]["password_replace"].value;

    if (customer_email == "") {
        document.getElementById("email_error").innerHTML = "Không được để trống phần này!";
        return false;
    }
    if (password_replace == "") {
        document.getElementById("password2_error").innerHTML = "Không được để trống phần này!";
        return false;
    }
    if (customer_password == "") {
        document.getElementById("password_error").innerHTML = "Không được để trống phần này!";
        return false;
    }
    if (customer_password != password_replace) {
        document.getElementById("password2_error").innerHTML = "Mật khẩu nhập lại phải giống với mật khẩu trên!";
        return false;
    }
}
</script>
@include('customer.script')