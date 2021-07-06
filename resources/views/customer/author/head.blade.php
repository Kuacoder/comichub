@include('customer.head')
        <header class="header-registerAuthorandCreatCenter">
            <div class="header-registerAuthor_logo">
                <a href="/"><img src="{{('/public/frontend/img/textLogo-header.svg')}}" style="margin-top: 5px;" alt=""></a>
                <p> * Trung tâm sáng tạo</p>
            </div>
            <div class="header-registerAuthor_profile">
                
                <a href="{{URL::to('/profile-customer/'.Session::get('customer_id'))}}" class="header-registerAuthor_profile_user">
                    <?php $customer_avatar = Session::get('customer_avatar'); ?>
                    <img src="{{('/public/uploads/customer/'.$customer_avatar)}}" alt=""> <p>{{Session::get('customer_name')}}</p>
                </a>
                <a href="#" class="header-registerAuthor_profile_arrMenu">
                    <img src="./img/down-arr-menu.svg" alt="">
                </a>
            </div>
        </header>
    