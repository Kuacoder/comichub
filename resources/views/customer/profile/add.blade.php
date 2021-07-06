@include('customer.profile.head_sidebar')      
                    <div class="add-customer-profile">
                       <form action="{{URL::to('/add-customer-profile/'.$customer_profile->customer_id)}}" method="POST" enctype="multipart/form-data" onsubmit="return validateformaddprofile()">
                       @csrf
                            <H1>Cập nhật thông tin tài khoản</H1>
                            <input type="hidden" name="customer_email" value="{{$customer_profile->customer_email}}">
                            <input type="hidden" name="customer_password" value="{{$customer_profile->customer_password}}">
                            <input type="hidden" name="customer_status" value="{{$customer_profile->customer_status}}">
                            <input type="hidden" name="customer_title" value="{{$customer_profile->customer_title}}">
                            <input type="hidden" name="customer_cash" value="{{$customer_profile->customer_cash}}">
                            <input type="hidden" name="cash_used" value="{{$customer_profile->cash_used}}">
                            <input type="hidden" name="customer_sales" value="{{$customer_profile->customer_sales}}">
                            <input type="hidden" name="customer_publish" value="{{$customer_profile->customer_publish}}">
                            <input type="hidden" name="number_noti" value="{{$customer_profile->number_noti}}">
                            <input type="hidden" name="customer_date" value="{{$customer_profile->customer_date}}">

                        <div class="form-group">
                            <h3><span>*</span> Ảnh đại diện:</h3>
                            <input id="customer_avatar" name="customer_avatar" type="file" placeholder="chọn một ảnh bất kỳ">
                            <h4 id="customer_avatar_err" class="error"></h4>
                        </div>
                        <div class="form-group">
                            <h3><span>*</span> Tên của bạn:</h3>
                            <input id="customer_name" name="customer_name" type="text" placeholder="Tên của bạn">
                            <h4 id="customer_name_err" class="error"></h4>
                        </div>
                        <div class="form-group">
                            <h3><span>*</span> Số điện thoại:</h3>
                            <input id="customer_phone" name="customer_phone" type="text" placeholder="Số điện thoại của bạn">
                            <h4 id="customer_phone_err" class="error"></h4>
                        </div>
                        <div class="form-group">
                            <h3><span>*</span> Địa chỉ:</h3>
                            <input id="customer_address" name="customer_address" type="text" placeholder="địa chỉ của bạn">
                            <h4 id="customer_address_err" class="error"></h4>
                        </div>
                        <div class="form-group">
                            <h3><span>*</span> Ngày sinh:</h3>
                            <input id="customer_birthday" name="customer_birthday" type="date">
                            <h4 id="customer_birthday_err" class="error"></h4>
                        </div>
                        <div class="form-group">
                        <h3><span>*</span> Giới tính:</h3>
                        <label class="radio2 radio-before2" style="margin-top: 20px; margin-left:-24px;">
                            <span class="radio__input2">
                              <input type="radio" value="0" name="customer_gender">
                              <span class="radio__control2" style="color:#FA9144;"></span>
                            </span>
                            <span class="radio__label2" style="color: black; font-size: small;margin-top: 2px;">Nam</span>
                          </label>
                          <label class="radio2 radio-before2" style="margin-top: 20px;">
                            <span class="radio__input2">
                              <input type="radio" value="1" name="customer_gender">
                              <span class="radio__control2" style="color:#FA9144;"></span>
                            </span>
                            <span class="radio__label2" style="color: black; font-size: small; margin-top: 2px;">Nữ</span>
                          </label>
                          <label class="radio2 radio-before2" style="margin-top: 20px;">
                            <span class="radio__input2">
                              <input type="radio" value="2" name="customer_gender">
                              <span class="radio__control2" style="color:#FA9144;"></span>
                            </span>
                            <span class="radio__label2" style="color: black; font-size: small;margin-top: 2px;margin-right: 35px;">Khác</span>
                          </label>
                        <h4 id="customer_gender_err" class="error"></h4>
                        </div>
                        <p>Sau khi cập nhật đầy đủ thông tin bạn có thể đăng ký tác giả</p>
                        <button type="submit">Cập nhật thông tin tài khoản</button>
                        </form>
                    </div>
                    <script>
                      function validateformaddprofile(){
                          let avatar = document.getElementById('customer_avatar');
                          if(avatar.value == ''){
                              let avatar_err = document.getElementById('customer_avatar_err');
                              avatar_err.textContent = "Vui lòng chọn một ảnh!";
                              return false;
                          }
                          let customer_name = document.getElementById('customer_name');
                          if(customer_name.value == ''){
                              let customer_name_err = document.getElementById('customer_name_err');
                              customer_name_err.textContent = "Vui lòng nhập tên của bạn!";
                              return false;
                          }
                          let customer_phone = document.getElementById('customer_phone');
                          if(customer_phone.value == ''){
                              let customer_phone_err = document.getElementById('customer_phone_err');
                              customer_phone_err.textContent = "Vui lòng nhập số điện thoại của bạn!";
                              return false;
                          }
                          if(isNaN(customer_phone.value)){
                              let customer_phone_err = document.getElementById('customer_phone_err');
                              customer_phone_err.textContent = "Không hợp lệ vui lòng nhập lại!";
                              return false;
                          }
                          let customer_address = document.getElementById('customer_address');
                          if(customer_address.value == ''){
                              let customer_address_err = document.getElementById('customer_address_err');
                              customer_address_err.textContent = "Vui lòng nhập dịa chỉ của bạn!";
                              return false;
                          }
                          let customer_birthday = document.getElementById('customer_birthday');
                          if(customer_birthday.value == ''){
                              let customer_birthday_err = document.getElementById('customer_birthday_err');
                              customer_birthday_err.textContent = "Vui lòng chọn ngày sinh của bạn!";
                              return false;
                          }
                          let customer_gender = document.getElementsByName('customer_gender');
                         
                            if(customer_gender[0].checked == false && customer_gender[1].checked == false && customer_gender[2].checked == false){
                              let customer_gender_err = document.getElementById('customer_gender_err');
                              customer_gender_err.textContent = "Vui lòng chọn một giới tính!";
                              return false;
                            }
                      }
                    </script>
                    @include('customer.profile.footer_script')       