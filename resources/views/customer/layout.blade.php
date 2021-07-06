@include('customer.head')
<header class="header">
    <div class="container">
        <div class="header-logo">
            <a class="header-logo_link" href="#">
                <img class="header-logo_img" src="{{URL::to('public/frontend/img/ac_logo.png')}}" alt="logoheader">
            </a>
        </div>
        <div class="header-search">
            <form action="{{URL::to('/search-comic-client')}}" method="POST">
                @csrf
                <input id="header-search_input" type="text" name="value_search" class="header-search_input"
                    placeholder="Vui lòng nhập tên tác phẩm">

                <button type="submit" class="header-search_button float-right btn btn-black"><img
                        src="{{URL::to('public/frontend/img/search.svg')}}" alt=""></button>
            </form>

        </div>

    </div>
</header>
<section class="menu-header container-fluid" style="margin-bottom: 50px;">
    <div class="container">
        <div class="menu-header-inside">
            <ul>
                <li><a href="/" class="menu-header_element">Trang chủ</a></li>
                @foreach($all_cate as $key => $cate)
                <li><a href="{{URL::to('see-cate-client/'.$cate->cate_id)}}"
                        class="menu-header_element">{{$cate->cate_name}}</a></li>
                @endforeach
            </ul>
            <div class="float-right center_buy_gem">
                <?php $customer_title = Session::get('customer_title'); if($customer_title && $customer_title == 1){ ?>
                <a href="{{URL::to('/create-comic-client')}}" class="btn-author-center btn btn-black-author-center">
                    <img src="{{URL::to('public/frontend/img/pencil.svg')}}" alt="">
                    Trung tâm tác giả -
                </a>
                <?php } ?>
                <?php $customer_id = Session::get('customer_id'); if($customer_id){ ?>
                <a id="buygem" class="btn-buy-gem btn btn-orange2">
                    <img src="{{URL::to('public/frontend/img/moneybag.svg')}}" alt="">
                    Mua đá quý
                </a>
                <?php }else{ ?>
                <a href='/login-customer' style="text-decoration:none;  padding: 5px 0px 0px 5px !important;"
                    class="btn-buy-gem btn btn-orange2">
                    Login / Register
                </a>
                <?php } ?>
            </div>
        </div>

    </div>
</section>



@yield('content')

@include('customer.script')