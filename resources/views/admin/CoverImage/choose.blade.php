@extends('admin.layout')

@section('content')
<div class="content-wrap">
    <div class="main">
        <div class="container-fluid">
            <div class="row">
                <div class="main-content">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card alert">
                                <div class="card-header">
                                    <form action="{{URL::to('/add-coverimg-comic')}}" method="post"
                                        enctype="multipart/form-data">
                                        {{csrf_field()}}
                                        <h1>Ảnh bìa truyện</h1>
                                        <div class="form-group col-lg-12">
                                            <h3 class="form-group-title"
                                                style="display:grid; grid-template-columns: 50% 50%; margin: 10px 0px 10px 0px;">
                                                Bìa đứng</h3>
                                            @foreach($all_image as $key => $cover_img)
                                            <label class="col-lg-6">
                                                <input type="radio" name="cover_img"
                                                    value="{{$cover_img->coverimg_picture}}" checked>
                                                <img
                                                    src="{{URL::to('public/uploads/coverimg/'.$cover_img->coverimg_picture)}}">
                                            </label>
                                            @endforeach
                                        </div>

                                        <div class="form-group" style="margin-left: 110px;">
                                            <h4 class="form-group-title">Hình mẫu</h4>
                                            <img src="./img/khunganh.png" alt="">
                                            <img src="./img/khunganh.png" alt="">
                                        </div>
                                        <div class="focusthis" style="margin-bottom: 50px;">
                                            <h2>Chú ý:</h2>
                                            <p>1. Dung lượng ảnh bìa <span>Không vượt quá 2mb</span></p>
                                            <p>2. ảnh bìa đứng - nằm đáp ứng đúng tỷ lệ <span>840 x 630 PX - 880 x 1500
                                                    px</span></p>
                                            <p>3. Muốn thay ảnh bìa truyện có thể vào cài đặt tác phẩm để thay đổi</p>
                                            <p>4. <span>hạn chế </span>Tải lên những tác phẩm đã có trên trang để tôn
                                                trọng người đi trước</p>
                                            <p>5. <span>nghiêm cấm tải lên bất kỳ nội dung bất hopwj pháp nào như phản
                                                    cảm, tục tĩu hoặc liên quan đến chính trị...</span></p>
                                        </div>
                                        <div class="button">
                                            <a href="/back-to-add-comic/{{Session::get('session_id')}}"
                                                class="btn btn-danger btn-outline m-r-10">Quay lại</a>
                                            <button class="btn btn-primary" type="submit">Thêm truyện</button>
                                        </div>


                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"
    integrity="sha512-XtmMtDEcNz2j7ekrtHvOVR4iwwaD6o/FUJe6+Zq+HgcCsk3kj4uSQQR8weQ2QVj1o0Pk6PwYLohm206ZzNfubg=="
    crossorigin="anonymous"></script>
@endsection