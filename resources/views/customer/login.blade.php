@include('customer.head')
<div class="register-account-page container-fluid">
    <div class="register-account">
        <div class="register-account-title">
            <li><a class="active-primary" class="" href="{{URL::to('/login-customer')}}">Đăng nhập</a></li>
            <li><a href="{{URL::to('/register-customer')}}">Đăng ký tài khoản</a></li>
            <a class="close" href="/"><i class="far fa-times-circle"></i></a>
        </div>
        <form name="myForm" action="/login-customer-request" method="POST" name="myForm"
            onsubmit="return validateFormlogin();">
            @csrf
            <div class="form-title">
                <h4>Đăng nhập để tận hưởng những bộ truyện hay và hấp dẫn hơn</h4>
            </div>
            <div class="left">
                <h3>Tự bảo vệ bản thân, tránh để lộ thông tin tài khoản cho người khác.</h3>
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
                <input id="login_email" name="customer_email" type="text" placeholder="Email">
                <p class="text-do m-l-20" id="email_error"></p>
                <input name="customer_password" type="password" placeholder="Mật khẩu">
                <p class="text-do m-l-20" id="password_error"></p>
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
            <button type="submit">đăng nhập</button>
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
    $('#login_admin_err').addClass('hidden');
    if (validateEmail(login_email)) {
        document.getElementById("email_error").innerHTML = "";
        return true;
    } else {
        document.getElementById("email_error").innerHTML = "Email không hợp lệ!";
        return false;
    }
});

function validateFormlogin() {
    var customer_email = document.forms["myForm"]["customer_email"].value;
    var customer_password = document.forms["myForm"]["customer_password"].value;

    if (customer_email == "") {
        document.getElementById("email_error").innerHTML = "Không được để trống phần này!";
        return false;
    }
    if (customer_password == "") {
        document.getElementById("password_error").innerHTML = "Không được để trống phần này!";
        return false;
    }
}
</script>
@include('customer.script')