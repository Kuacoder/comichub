@extends('admin.layout')

@section('content')
<?php 
							    $success = Session::get('success');
                                $fail = Session::get('fail');
							    if ($success) { ?>
<div id="modal" style=" ">
    <div class="modal--table">
        <h1 class="modal--table--h1">Thông báo</h1>
        <h3 class="modal--table--h3 text-default"><?php echo $success;
								        Session::put('success',null); ?></h3>
        <div class="modal--table--button"><button class="btn btn-default" id="close_modal">Đóng</button></div>

    </div>

</div>
<?php 
							    }elseif($fail) { ?>
<div id="modal" style=" ">
    <div class="modal--table">
        <h1 class="modal--table--h1">Thông báo</h1>
        <h3 class="modal--table--h3 text-default"><?php echo $fail;
								        Session::put('fail',null); ?></h3>
        <div class="modal--table--button"><button class="btn btn-default" id="close_modal">Đóng</button></div>
    </div>
</div>
<?php }else{
								Session::put('success',null);
                                Session::put('fail',null);
							    }
							    ?>
<div class="content-wrap">
    <div class="main">
        <div class="container-fluid">
            <div class="row">
                <div class="main-content">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card alert">
                                <div class="row">
                                    <div class="col-lg-6" style="margin-left: 25%;">
                                        <div class="card-header">
                                            <h1 style="text-align: center;">Thêm truyện</h1>
                                        </div>

                                        <div class="card-body">
                                            <div class="basic-form">
                                                <form method="POST" action="{{url('/save-comic')}}"
                                                    enctype="multipart/form-data">
                                                    {{csrf_field()}}
                                                    <input name="author_id" type="hidden"
                                                        value="<?php echo Session::get('admin_id'); ?>">
                                                    <div class="form-group">
                                                        <p class="text-muted m-b-15 f-s-12" style="font-size:larger;">
                                                            Tên truyện</p>
                                                        <input name="comic_name" type="text"
                                                            class="form-control input-focus"
                                                            placeholder="Nhập tên truyện">
                                                    </div>
                                                    <div class="form-group">
                                                        <label style="font-size:larger;">Giới tính</label>
                                                        <select class="form-control input-focus" name="comic_gender">
                                                            <option value="0">Truyện tranh nam</option>
                                                            <option value="1">Truyện tranh nữ</option>
                                                        </select>
                                                    </div>

                                                    <div class="form-group">
                                                        <label style="font-size:larger;">Tóm tắt nội dung</label>
                                                        <textarea name="comic_desc" style="resize: none"
                                                            class="form-control input-focus" rows="8"
                                                            placeholder="Tóm tắt"></textarea>
                                                    </div>
                                                    <div class="form-group">
                                                        <p class="text-muted m-b-15 f-s-12" style="font-size:larger;">
                                                            Mô tả ngắn</p>
                                                        <input name="comic_content" type="text"
                                                            class="form-control input-focus" placeholder="mô tả">
                                                    </div>
                                                    <div class="form-group">
                                                        <p class="text-muted m-b-15 f-s-12" style="font-size:larger;">
                                                            Ảnh đại diện</p>
                                                        <input type="file" id="comic_img" name="comic_img"
                                                            class="form-control input-focus"
                                                            placeholder="Choose Avatar">
                                                        <label for="comic_img" class="label_file_vip">Chọn ảnh đại
                                                            diện</label>
                                                    </div>
                                                    <div class="form-group">
                                                        <label style="font-size:larger;">Khu vực</label>
                                                        <select class="form-control input-focus" name="comic_area">
                                                            <option value="0">Việt nam</option>
                                                            <option value="1">Nhật bản</option>
                                                            <option value="2">Hàn Quốc</option>
                                                            <option value="3">Trung quốc</option>
                                                            <option value="4">Hoa kỳ</option>
                                                            <option value="5">Khác</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label style="font-size:larger;">Thể loại</label>
                                                        <select class="form-control input-focus" name="cate_id">
                                                            <option value="0">Chọn danh mục</option>
                                                            @foreach($all_cate as $key => $cate)
                                                            <option value="{{$cate->cate_id}}">{{$cate->cate_name}}
                                                            </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <p class="text-muted m-b-15 f-s-12" style="font-size:larger;">
                                                            Gắn thẻ</p>
                                                        <input name="tag" type="text" class="form-control input-focus"
                                                            placeholder="thẻ">
                                                    </div>
                                                    <input type="hidden" value="0" name="status">
                                                    <input type="hidden" value="1" name="display">
                                                    <input type="hidden" value="0" name="comic_price">
                                                    <button type="submit" class="btn btn-primary "
                                                        style="font-size:larger;margin-left: 45%;">Bước tiếp
                                                        theo</button>
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
        </div>
    </div>
    @endsection