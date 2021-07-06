@include('admin.head')

<body class="bg-primary">
    <div class="unix-login">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-lg-offset-3">
                    <div class="login-content">
                        <div class="login-logo">
                            <a href="index.html"><span><img
                                        src="{{URL::to('/public/backend/images/textLogo-header.svg')}}"
                                        alt=""></span></a>
                        </div>
                        <div class="login-form">
                            <h4>Administratior Login</h4>
                            <?php 
							$message = Session::get('message');
							if ($message) { ?>
                            <div id="login_admin_err" class="alert alert-danger center">
                                <?php echo $message;
								Session::put('message',null); ?>
                            </div>
                            <?php 
							}else {
								Session::put('message',null);
							}
							?>
                            <form method="POST" action="{{URL::to('/admin-dashboard')}}" name="myForm"
                                onsubmit="return validateFormlogin();">
                                {{csrf_field()}}
                                <div class="form-group">
                                    <label>Email</label>
                                    <input id="login_email" name="admin_email" type="text" class="form-control"
                                        placeholder="Nhập email">
                                    <p class="text-danger m-t-10" id="email_error"></p>
                                </div>
                                <div class="form-group">
                                    <label>Mật khẩu</label>
                                    <input id="login_password" name="admin_password" type="password"
                                        class="form-control" placeholder="Nhập mật khẩu">
                                    <p class="text-danger" id="password_error"></p>
                                </div>

                                <button type="submit" class="btn btn-primary btn-flat m-b-30 m-t-30">Đăng nhập</button>
                            </form>
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
        var admin_email = document.forms["myForm"]["admin_email"].value;
        var admin_password = document.forms["myForm"]["admin_password"].value;

        if (admin_email == "") {
            document.getElementById("email_error").innerHTML = "Không được để trống bất kỳ trường nào!";
            return false;
        }
        if (admin_password == "") {
            document.getElementById("password_error").innerHTML = "Không được để trống bất kỳ trường nào!";
            return false;
        }
    }
    </script>
    @include('admin.script')