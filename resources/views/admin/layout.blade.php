@include('admin.head')

<body>
    @include('admin.sidebar')

    <div class="header">
        <div class="pull-left">
            <div class="logo" id="sideLogo">
                <a href="index.html">
                    <img class="full-logo" src="{{url('/public/backend/images/textLogo-header.svg')}}" alt="comichub">
                    <img class="small-logo" style="max-height: 35px;"
                        src="{{url('/public/backend/images/logo-small.png')}}" alt="comichub">
                </a>
            </div>
            <div class="hamburger sidebar-toggle">
                <span class="ti-menu"></span>
            </div>
        </div>

        <div class="pull-right p-r-15">
            <ul>
                <li id="this_noti" class="header-icon dib"><i class="ti-bell">
                        <input id="customer_id_vip" type="hidden" value="{{Session::get('admin_id')}}">
                        <?php $i = 0; if($result->number_noti > 0){ ?>
                        <div class="gadget_vip_admin">{{$result->number_noti}}</div>
                        <?php } ?>

                    </i>
                    <div class="drop-down">
                        <div class="dropdown-content-heading">
                            <span class="text-left">Thông báo gần đây</span>
                        </div>
                        <div class="dropdown-content-body">
                            @foreach($noti as $key => $value)
                            <div class="dropdown-content-body--element">
                                <?php echo $value->noti_content ?>
                                <?php $date_hien_tai = time() - $value->day_create_noti; ?>
                                <p class="text-end">{{date("H:i:s",$date_hien_tai)}} trước</p>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </li>
                <script>
                $('#this_noti').click(function() {
                    let customer_id_vip = $('#customer_id_vip').val();
                    $('.gadget_vip_admin').addClass('hidden');
                    xmlhttp = new XMLHttpRequest();
                    xmlhttp.open("GET", "/reset-number-noti/" + customer_id_vip, false);
                    xmlhttp.send();
                });
                </script>
                <li class="header-icon dib"><img class="avatar-img"
                        src="{{url('/public/uploads/customer/'.Session::get('admin_avatar'))}}" alt="" />
                    <?php 
                        $name = Session::get('admin_name');
                        echo $name;  
                    ?>
                    <span class="user-avatar"><i class="ti-angle-down f-s-10"></i></span>
                    <div class="drop-down dropdown-profile">
                        <div class="dropdown-content-heading">
                            <span class="text-left">Tùy chọn</span>
                        </div>
                        <div class="dropdown-content-body1">
                            <ul>

                                <li><a href="{{URL::to('/logout')}}"><i class="ti-power-off"></i>
                                        <span>Đăng xuất</span></a></li>
                            </ul>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>


    @yield('content')

    @include('admin.script')