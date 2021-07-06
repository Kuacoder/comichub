@include('customer.author.head')
<div class="createcenter-body container-fluid">
@include('customer.author.sidebar')
            <div class="createcenter-body-content-home">
                <div class="createcenter-body-content-home_title">
                    <img src="{{URL::asset('/public/frontend/img/donestep.png')}}" alt="">
                    <h2>Thông tin tác phẩm</h2>
                    <img class="arr" src="{{URL::asset('/public/frontend/img/arrStep-right.svg')}}" alt="">
                    <img src="{{URL::asset('/public/frontend/img/step2-black.png')}}" alt="">
                    <h2>Ảnh bìa tác phẩm</h2>
                    <img class="arr" src="{{URL::asset('/public/frontend/img/arrStep-right.svg')}}" alt="">
                    <img src="{{URL::asset('/public/frontend/img/step3.svg')}}" alt="">
                    <h2>Tạo thành công</h2>
                </div>
                <div class="createcenter-body-content-home_cover_img">
                    <form  action="{{URL::to('/update-coverimg-comic-client/'.$this_comic->comic_id)}}" method="post" enctype="multipart/form-data" name="myForm">
                    @csrf
                        <h2>Ảnh bìa truyện</h2>
                        <div class="form-group">
                            <h4 class="form-group-title">Bìa đứng</h4>
                            @foreach($all_image as $key => $image)
                            @if($this_comic->cover_img == $image->coverimg_picture)
                            <label class="anhbiatruyenvip" >
                                <input checked type="radio" name="cover_img" value="{{$image->coverimg_picture}}">
                                <img class="w-h-100" src="/public/uploads/coverimg/{{$image->coverimg_picture}}">
                              </label>
                            @else
                            <label class="anhbiatruyenvip">
                                <input type="radio" name="cover_img" value="{{$image->coverimg_picture}}">
                                <img class="w-h-100" src="/public/uploads/coverimg/{{$image->coverimg_picture}}">
                              </label>
                            @endif
                            @endforeach
                        </div>
                       
                        <div class="form-group" style="margin-left: 110px;" >
                            <h4 class="form-group-title">Hình mẫu</h4>
                            <img src="/public/frontend/img/khunganh.png" alt="">     
                        </div>
                        <div class="focusthis">
                            <h2>Chú ý:</h2>
                            <p>1. Dung lượng ảnh bìa <span>Không vượt quá 2mb</span></p>
                            <p>2. ảnh bìa đứng - nằm đáp ứng đúng tỷ lệ <span>840 x 630 PX - 880 x 1500 px</span></p>
                            <p>3. Muốn thay ảnh bìa truyện có thể vào cài đặt tác phẩm để thay đổi</p>
                            <p>4. <span>hạn chế </span>Tải lên những tác phẩm đã có trên trang để tôn trọng người đi trước</p>
                            <p>5. <span>nghiêm cấm tải lên bất kỳ nội dung bất hopwj pháp nào như phản cảm, tục tĩu hoặc liên quan đến chính trị...</span></p>
                        </div>
                        <div class="button">
                            <button type="submit">Bước tiếp theo</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
        @include('customer.author.footer')