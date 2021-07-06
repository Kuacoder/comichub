
    <div class="menu-fixed menu-fixed_right">
        <ul class="menu-fixed_right_top">
            <li><a class="menu-fixed_right_top1" href="<?php $customer_id = Session::get('customer_id');
            if($customer_id){
                echo "/profile-customer/$customer_id";
            }else{
                echo "/login-customer";
            }
            ?>"><img src="{{URL::to('/public/frontend/img/top_face_no_bg.jpg')}}" alt=""></a></li>
            <!-- <li><a href=""><img src="{{URL::to('/public/frontend/img/history-menu-fix.png')}}" alt=""><p>Lịch sử</p></a></li>
            <li><a href=""><img src="{{URL::to('/public/frontend/img/star-menu-fix.png')}}" alt=""><p>Yêu thích</p></a></li>
        </ul>
        <ul class="menu-fixed_right_bot">
            <li><a href=""><img src="{{URL::to('/public/frontend/img/comment-menu-fix.png')}}" alt=""><p>Phản hồi</p></a></li> -->
            <li><a id="cainaylabuttondautrang" href="#dautrangdaynheahihi">ĐẦU TRANG</a></li>
        </ul>
    </div>
    <?php if(Session::get('customer_id') != null && $number_noti > 0){ ?>
              
                <div id="popupthongbao">
                    <a class="noidungthongbao2" href="{{URL::to('/profile-customer/'.Session::get('customer_id'))}}">Bạn có {{$number_noti}} thông báo mới!</a>
                    <p id="close__thongbao">x</p>
                </div>
         
            <?php } ?>