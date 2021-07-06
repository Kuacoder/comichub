@include('customer.head')
<div class="account-page container-fluid">
    <section class="menu-header-account container-fluid">
        <div class="container">
            <img src="{{URL::to('public/frontend/img/textLogo-header.svg')}}" alt="">
            <ul>
                <li><a href="/" class="menu-header_element">Trang chủ</a></li>
                <li><a href="#" class="menu-header_element active-primary">Tài khoản</a></li>

            </ul>
        </div>
    </section>
    <div class="account-page-body">
        <div class="account-page-body_content">
            <div class="account-page-body_content_menu container-fluid">
                <ul>
                    <?php if($customer_profile->customer_title == 0){ ?>
                    <li><a href="#" class="active-green">Thường</a></li>
                    <li><a>Tác giả</a></li>
                    <?php }else{ ?>
                    <li><a>Thường</a></li>
                    <li><a href="#" class="active-green">Tác giả</a></li>
                    <?php } ?>
                </ul>
            </div>
            <div class="account-page-body_content_sidebar">
                <li class=""><a href="{{URL::to('/profile-customer/'.$customer_profile->customer_id)}}">Cá nhân</a></li>

                <li><a href="{{URL::to('/view-add-infor-customer/'.Session::get('customer_id'))}}">Cập nhật thông tin
                        tài khoản</a></li>

                <?php if(trim($customer_profile->customer_name) != '' && trim($customer_profile->customer_phone) != '' && trim($customer_profile->customer_address) != '' && $customer_profile->customer_title == 0){ ?>
                <li><a href="{{URL::to('/register-author-client/'.$customer_profile->customer_id)}}">Đăng ký tác giả</a>
                </li>
                <?php } ?>

                <!-- <li><a href="./CollectionAccount.html"><i class="fas fa-list"></i>Bộ sưu tập</a></li> -->
                <li><a href="/logout-customer">Đăng xuất</a></li>
            </div>