@include('customer.author.head')
<div class="createcenter-body container-fluid">
@include('customer.author.sidebar')
           
            <div class="createcenter-body-content-home2 createcenter-body-content-home">
            <div class="createcenter-body-content-home_title">
                    <img src="{{url('/public/frontend/img/donestep.svg')}}" alt="">
                    <h2>Thông tin tác phẩm</h2>
                    <img class="arr" src="{{url('/public/frontend/img/arrStep-right.svg')}}" alt="">
                    <img src="{{url('/public/frontend/img/donestep.svg')}}" alt="">
                    <h2>Ảnh bìa tác phẩm</h2>
                    <img class="arr" src="{{url('/public/frontend/img/arrStep-right.svg')}}" alt="">
                    <img src="{{url('/public/frontend/img/step3-black.svg')}}" alt="">
                    <h2>Tạo thành công</h2>
                </div>
               <div class="createcenter-body-content-home2-done">
                   <img src="/public/frontend/img/create-success.png" alt="">
                   <h2 style="margin-bottom: 50px;">Sản phẩm được cập nhật thành công</h2>
                   <a href="/list-comic-author/{{Session::get('customer_id')}}" style="text-decoration: none;">quay lại danh sách truyện</a>
                  
               </div>
            </div>
        </div>
        @include('customer.author.footer')