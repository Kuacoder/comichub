@include('customer.author.head')
<div class="createcenter-body container-fluid">
@include('customer.author.sidebar')
            <div class="createcenter-body-content-home">
                <div class="createcenter-body-content-home_title">
                    <img src="{{url('/public/frontend/img/step1.svg')}}" alt="">
                    <h2>Thông tin tác phẩm</h2>
                    <img class="arr" src="{{url('/public/frontend/img/arrStep-right.svg')}}" alt="">
                    <img src="{{url('/public/frontend/img/step2.svg')}}" alt="">
                    <h2>Ảnh bìa tác phẩm</h2>
                    <img class="arr" src="{{url('/public/frontend/img/arrStep-right.svg')}}" alt="">
                    <img src="{{url('/public/frontend/img/step3.svg')}}" alt="">
                    <h2>Tạo thành công</h2>
                </div>
                <form name="myForm" action="{{URL::to('/save-comic-client')}}" method="POST" enctype="multipart/form-data" onsubmit="return validateformaddcomic()">
                @csrf
                <input type="hidden" name="author_id" value="{{Session::get('customer_id')}}">
                <input type="hidden" name="status" value="0">
                <input type="hidden" name="display" value="1">
                <div class="form-group">
                        <h3><span>*</span> Ảnh truyện:</h3>
                        <input id="comic_img" style="width:30%; margin-left:20px;" name="comic_img" type="file" placeholder="chọn một ảnh bất kỳ">
                        <h4 id="comic_img--err" class="error"></h4>
                </div>
                    <div class="form-group">
                        <h3><span>*</span> Tên truyện:</h3>
                        <input id="comic_name" name="comic_name" type="text" placeholder="Tối đa 15 ký tự, không có ký tự đặc biệt và số">
                        <h4 id="comic_name--err" class="error"></h4>
                    </div>
                    <div class="form-group">
                        <h3><span>*</span> Giới tính:</h3>
                        <label class="radio radio-before">
                            <span class="radio__input" style=" margin-left: 20px;">
                              <input type="radio" value="0" name="comic_gender">
                              <span class="radio__control"></span>
                            </span>
                            <span class="radio__label" style="color: black; font-size: small;margin-top: 2px;">Nam</span>
                          </label>
                          <label class="radio radio-before">
                            <span class="radio__input" style=" margin-left: 50px;">
                              <input type="radio" value="1" name="comic_gender">
                              <span class="radio__control"></span>
                            </span>
                            <span class="radio__label" style="color: black; font-size: small; margin-top: 2px;">Nữ</span>
                          </label>
                          <label class="radio radio-before">
                            <span class="radio__input" style=" margin-left: 50px;">
                              <input type="radio" value="2" name="comic_gender">
                              <span class="radio__control"></span>
                            </span>
                            <span class="radio__label" style="color: black; font-size: small;margin-top: 2px;">Khác</span>
                          </label>
                        <h4 id="comic_gender--err" class="error" style=" margin-left: 193px;"></h4>
                    </div>
                    <div class="form-group">
                        <h3><span>*</span> Chủ đề:</h3>
                        <select name="cate_id" id="cate_id">
                            <option value="0">Chọn chủ đề</option>
                            @foreach($all_cate as $key => $cate)
                            <option value="{{$cate->cate_id}}">{{$cate->cate_name}}</option>
                            @endforeach
                        </select>
                        <h4 id="cate_id--err" class="error"></h4>
                    </div>
                    <div class="form-group">
                        <h3><span>*</span> Tag:</h3>
                        <input name="tag" type="text" placeholder="Nhập các giá trị phân cách bằng dấu phẩy">
                    </div>
                    <div class="form-group" style="margin-top: 15px;">
                        <h3><span>*</span> Giới thiệu:</h3>
                        <textarea name="comic_desc" id="" cols="56" rows="12" placeholder="Vui lòng nhập giới thiệu khoảng 20 - 150 từ"></textarea>
                        <h4 style="color: black; margin-top: 400px;"> 0/150</h4>
                    </div>
                    <div class="form-group" style="margin-top: 215px;">
                        <h3><span>*</span> Tóm tắt ngắn:</h3>
                        <input id="comic_content" name="comic_content" type="text" placeholder="Vui lòng nhập tóm tắt ngắn khoản 15 từ">
                        <h4 id="comic_content--err" class="error"></h4>
                    </div>
                    <div class="form-group">
                        <h3><span>*</span> Khu vực nguồn:</h3>
                        <?php $i=0; foreach($all_area as $key => $area){$i++ ?> 
                        <label class="radio radio-before">
                            <span class="radio__input" style=" margin-left: 20px;">
                              <input type="radio" name="comic_area" value="{{$area->area_id}}">
                              <span class="radio__control"></span>
                            </span>
                            <span class="radio__label" style="color: black;width: 100px; font-size: small;margin-top: 2px;margin-right: 27px;">{{$area->area_name}}</span>
                        </label>
                        <?php if($i==3){break;}} ?>
                        <h4 id="comic_area--err" class="error" style=" margin-left: -53px;"></h4>
                    </div>
                    <div class="form-group" style="margin-top: -20px;">
                        <h3></h3>
                        <?php $i=0; foreach($all_area as $key => $area){$i++; if($i>3){ ?> 
                        <label class="radio radio-before">
                            <span class="radio__input" style=" margin-left: 20px;">
                              <input type="radio" name="comic_area" value="{{$area->area_id}}">
                              <span class="radio__control"></span>
                            </span>
                            <span class="radio__label" style="color: black; width: 100px; font-size: small;margin-top: 2px;margin-right: 27px;">{{$area->area_name}}</span>
                          </label>
                        <?php }elseif($i==6){break;}} ?>
                    </div>
                   
                    <button type="submit">Bước tiếp theo</button>
                </form>
            </div>
        </div>
        <script>
                      function validateformaddcomic(){
                          let avatar = document.getElementById('comic_img');
                          if(avatar.value == ''){
                              let avatar_err = document.getElementById('comic_img--err');
                              avatar_err.textContent = "Vui lòng chọn một ảnh!";
                              return false;
                          }
                          let customer_name = document.getElementById('comic_name');
                          if(customer_name.value == ''){
                              let customer_name_err = document.getElementById('comic_name--err');
                              customer_name_err.textContent = "Vui lòng nhập tên truyện!";
                              return false;
                          }
                          let customer_address = document.getElementById('cate_id');
                          if(customer_address.value == 0){
                              let customer_address_err = document.getElementById('cate_id--err');
                              customer_address_err.textContent = "Vui lòng chọn một chủ đề!";
                              return false;
                          }
                          let customer_birthday = document.getElementById('comic_content');
                          if(customer_birthday.value == ''){
                              let customer_birthday_err = document.getElementById('comic_content--err');
                              customer_birthday_err.textContent = "Vui lòng nhập tóm tắt!";
                              return false;
                          }
                          let comic_area = document.getElementsByName('comic_area');
                            if(comic_area[0].checked == false && comic_area[1].checked == false && comic_area[2].checked == false && comic_area[3].checked == false && comic_area[4].checked == false && comic_area[5].checked == false){
                              let comic_area_err = document.getElementById('comic_area--err');
                              comic_area_err.textContent = "Vui lòng chọn một khu vực!";
                              return false;
                            }
                          let customer_gender = document.getElementsByName('comic_gender');
                         
                            if(customer_gender[0].checked == false && customer_gender[1].checked == false && customer_gender[2].checked == false){
                              let customer_gender_err = document.getElementById('comic_gender--err');
                              customer_gender_err.textContent = "Vui lòng chọn một giới tính!";
                              return false;
                            }
                      }
                    </script>
        @include('customer.author.footer')