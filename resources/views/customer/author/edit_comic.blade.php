@include('customer.author.head')
<div class="createcenter-body container-fluid">
@include('customer.author.sidebar')
            <div class="createcenter-body-content-home">
                <div class="createcenter-body-content-home_title">
                    <img src="{{url('/public/frontend/img/step1.svg')}}" alt="">
                    <h2>Sửa Thông tin tác phẩm</h2>
                    <img class="arr" src="{{url('/public/frontend/img/arrStep-right.svg')}}" alt="">
                    <img src="{{url('/public/frontend/img/step2.svg')}}" alt="">
                    <h2>Sửa Ảnh bìa tác phẩm</h2>
                    <img class="arr" src="{{url('/public/frontend/img/arrStep-right.svg')}}" alt="">
                    <img src="{{url('/public/frontend/img/step3.svg')}}" alt="">
                    <h2>Sửa thành công</h2>
                </div>
                <form name="myForm" action="{{URL::to('/update-comic-client/'.$this_comic->comic_id)}}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="author_id" value="{{Session::get('customer_id')}}">
                <input type="hidden" name="status" value="{{$this_comic->comic_status}}">
                <input type="hidden" name="display" value="{{$this_comic->display}}">
                <input type="hidden" name="session_id" value="{{$this_comic->session_id}}">
                <input type="hidden" name="comic_schedule" value="{{$this_comic->comic_schedule}}">
                <input type="hidden" name="cover_img" value="{{$this_comic->cover_img}}">
                <div class="form-group" style="margin: 50px 0px 70px 0px">
                        <h3><span>*</span> Ảnh truyện:</h3>
                        <img src="{{URL::asset('public/uploads/comic/'.$this_comic->comic_img)}}" alt="">
                        <input name="comic_img" type="file" style="width: 23% !important;" placeholder="chọn một ảnh bất kỳ">
                        
                </div>
                    <div class="form-group">
                        <h3><span>*</span> Tên truyện:</h3>
                        <input name="comic_name" type="text" value="{{$this_comic->comic_name}}">
                        
                    </div>
                    <div class="form-group">
                        <h3><span>*</span> Giới tính:</h3>
                        @if($this_comic->comic_gender == 0)
                        <label class="radio radio-before">
                            <span class="radio__input" style=" margin-left: 20px;">
                              <input checked type="radio" value="0" name="comic_gender">
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
                        @elseif($this_comic->comic_gender == 1)
                        <label class="radio radio-before">
                            <span class="radio__input" style=" margin-left: 20px;">
                              <input type="radio" value="0" name="comic_gender">
                              <span class="radio__control"></span>
                            </span>
                            <span class="radio__label" style="color: black; font-size: small;margin-top: 2px;">Nam</span>
                          </label>
                          <label class="radio radio-before">
                            <span class="radio__input" style=" margin-left: 50px;">
                              <input checked type="radio" value="1" name="comic_gender">
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
                        @else
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
                              <input checked type="radio" value="2" name="comic_gender">
                              <span class="radio__control"></span>
                            </span>
                            <span class="radio__label" style="color: black; font-size: small;margin-top: 2px;">Khác</span>
                          </label>
                        @endif
                       
                       
                    </div>
                    <div class="form-group">
                        <h3><span>*</span> Chủ đề:</h3>
                        <select name="cate_id" id="">
                           
                            @foreach($all_cate as $key => $cate)
                            @if($this_comic->cate_id == $cate->cate_id)
                            <option selected value="{{$cate->cate_id}}">{{$cate->cate_name}}</option>
                            @endif
                            @if($this_comic->cate_id != $cate->cate_id)
                            <option value="{{$cate->cate_id}}">{{$cate->cate_name}}</option>
                            @endif
                            @endforeach
                        </select>
                     
                    </div>
                    <div class="form-group">
                        <h3><span>*</span> Tag:</h3>
                        <input name="tag" type="text" value="{{$this_comic->tag}}">
                       
                    </div>
                    <div class="form-group" style="margin-top: 15px;">
                        <h3><span>*</span> Giới thiệu:</h3>
                        <textarea name="comic_desc" id="" cols="56" rows="12" placeholder="Vui lòng nhập giới thiệu khoảng 20 - 150 từ">{{$this_comic->comic_desc}}</textarea>
                        <h4 style="color: black; margin-top: 400px;"> 0/150</h4>
                    </div>
                    <div class="form-group" style="margin-top: 215px;">
                        <h3><span>*</span> Tóm tắt ngắn:</h3>
                        <input name="comic_content" type="text" value="{{$this_comic->comic_content}}">
                     
                    </div>
                    <div class="form-group">
                        <h3><span>*</span> Khu vực nguồn:</h3>
                        <?php $i=0; foreach($all_area as $key => $area){$i++ ?>
                            @if($this_comic->comic_area == $area->area_id)
                            <label class="radio radio-before">
                            <span class="radio__input" style=" margin-left: 20px;">
                              <input checked type="radio" name="comic_area" value="{{$area->area_id}}">
                              <span class="radio__control"></span>
                            </span>
                            <span class="radio__label" style="color: black;width: 100px; font-size: small;margin-top: 2px;margin-right: 27px;">{{$area->area_name}}</span>
                            </label>
                            @else
                            <label class="radio radio-before">
                            <span class="radio__input" style=" margin-left: 20px;">
                              <input type="radio" name="comic_area" value="{{$area->area_id}}">
                              <span class="radio__control"></span>
                            </span>
                            <span class="radio__label" style="color: black;width: 100px; font-size: small;margin-top: 2px;margin-right: 27px;">{{$area->area_name}}</span>
                            </label>
                            @endif
                       
                        <?php if($i==3){break;}} ?>
                     
                    </div>
                    <div class="form-group" style="margin-top: -20px;">
                        <h3></h3>
                        <?php $i=0; foreach($all_area as $key => $area){$i++; if($i>3){ ?> 
                            @if($this_comic->comic_area == $area->area_id)
                            <label class="radio radio-before">
                            <span class="radio__input" style=" margin-left: 20px;">
                              <input checked type="radio" name="comic_area" value="{{$area->area_id}}">
                              <span class="radio__control"></span>
                            </span>
                            <span class="radio__label" style="color: black;width: 100px; font-size: small;margin-top: 2px;margin-right: 27px;">{{$area->area_name}}</span>
                            </label>
                            @else
                            <label class="radio radio-before">
                            <span class="radio__input" style=" margin-left: 20px;">
                              <input type="radio" name="comic_area" value="{{$area->area_id}}">
                              <span class="radio__control"></span>
                            </span>
                            <span class="radio__label" style="color: black;width: 100px; font-size: small;margin-top: 2px;margin-right: 27px;">{{$area->area_name}}</span>
                            </label>
                            @endif
                        <?php }elseif($i==6){break;}} ?>
                    </div>
                   
                    <button type="submit">Bước tiếp theo</button>
                </form>
            </div>
        </div>
        @include('customer.author.footer')