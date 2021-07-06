<div class="sidebar sidebar-hide-to-small sidebar-shrink sidebar-gestures">
    <div class="nano">
        <div class="nano-content">
            <ul>
                <li class="label">Menu</li>
                <li class=""><a href="{{url('/admin-home')}}"><i class="ti-home"></i> Trang chủ </a></li>


                <li><a href="{{URL::to('/profile/'.Session::get('admin_id'))}}"><i class="ti-user"></i> Thông tin tài
                        khoản</a></li>


                <li><a class="sidebar-sub-toggle"><i class="ti-layout"></i> Người dùng <span
                            class="sidebar-collapse-icon ti-angle-down"></span></a>
                    <ul>
                        <li><a href="{{URL::to('/list-admin')}}"><i class="ti-user"></i>Tài khoản quản trị</a></li>
                        <li><a href="{{URL::to('/list-customer')}}"><i class="ti-id-badge"></i>Tài khoản khách hàng</a>
                        </li>
                        <li><a href="{{URL::to('/add-admin')}}"><i class="ti-plus"></i>Thêm tài khoản quản trị</a></li>
                        <li><a href="{{URL::to('/add-customer')}}"><i class="ti-plus"></i>Thêm tài khoản khách</a>
                        </li>
                    </ul>
                </li>
                <li><a class="sidebar-sub-toggle"><i class="ti-bookmark-alt"></i> Danh mục <span
                            class="sidebar-collapse-icon ti-angle-down"></span></a>
                    <ul>
                        <li><a href="{{url('/list-category')}}"><i class="ti-layout-list-thumb-alt"></i>Danh sách danh
                                mục</a></li>
                        <li><a href="{{url('/add-category')}}"><i class="ti-plus"></i>Thêm danh mục</a></li>
                    </ul>
                </li>
                <li><a class="sidebar-sub-toggle"><i class="ti-book"></i> Truyện tranh <span
                            class="sidebar-collapse-icon ti-angle-down"></span></a>
                    <ul>
                        <li><a href="{{url('/list-comic')}}"><i class="ti-view-list-alt"></i>Danh sách truyện tranh</a>
                        </li>
                        <li><a href="{{url('/add-comic')}}"><i class="ti-plus"></i>Thêm truyện tranh</a></li>
                    </ul>
                </li>
                <li><a class="sidebar-sub-toggle"><i class="ti-image"></i>Ảnh bìa truyện <span
                            class="sidebar-collapse-icon ti-angle-down"></span></a>
                    <ul>
                        <li><a href="{{url('/list-cover-image')}}"><i class="ti-view-list-alt"></i>Danh sách ảnh bìa
                                truyện</a></li>
                        <li><a href="{{url('/add-cover-image')}}"><i class="ti-plus"></i>Thêm ảnh bìa truyện</a></li>
                    </ul>
                </li>
                <li><a class="sidebar-sub-toggle"><i class="ti-money"></i>Đơn hàng và giao dịch<span
                            class="sidebar-collapse-icon ti-angle-down"></span></a>
                    <ul>
                        <li><a href="{{url('/list-order')}}"><i class="ti-agenda"></i>Danh sách đơn hàng</a></li>
                        <li><a href="{{url('/list-payment')}}"><i class="ti-wallet"></i>Lịch sử nạp</a></li>
                    </ul>
                </li>
                <li><a class="sidebar-sub-toggle"><i class="ti-ink-pen"></i>Tác giả<span
                            class="sidebar-collapse-icon ti-angle-down"></span></a>
                    <ul>
                        <li><a href="{{url('/view-list-register-author')}}"><i class="ti-write"></i>Danh sách đăng ký
                            </a></li>
                    </ul>
                </li>

            </ul>
        </div>

    </div>

</div>
<div class="coppyright_vip">
    © 2021 Bản quyền thuộc về ComicHub.com
</div>