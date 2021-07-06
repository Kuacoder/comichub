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
                                            <h1 style="text-align: center;">Cập nhật truyện tranh</h1>
                                        </div>

                                        <div class="card-body">
                                            <div class="basic-form">
                                                @foreach($edit_comic as $key => $edit_value)
                                                <form method="POST"
                                                    action="{{url('/update-comic/'.$edit_value->comic_id)}}"
                                                    enctype="multipart/form-data">
                                                    {{csrf_field()}}

                                                    <input name="session_id" type="hidden"
                                                        value="{{$edit_value->session_id}}">


                                                    <div class="form-group">
                                                        <p class="text-muted m-b-15 f-s-12" style="font-size:larger;">
                                                            Tên truyện</p>
                                                        <input name="comic_name" type="text"
                                                            class="form-control input-focus"
                                                            value="{{$edit_value->comic_name}}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label style="font-size:larger;">Tóm tắt nội dung</label>
                                                        <textarea name="comic_desc" style="resize: none"
                                                            class="form-control input-focus"
                                                            rows="8">{{$edit_value->comic_desc}}</textarea>
                                                    </div>
                                                    <div class="form-group">
                                                        <p class="text-muted m-b-15 f-s-12" style="font-size:larger;">
                                                            Mô tả ngắn</p>
                                                        <input name="comic_content" type="text"
                                                            class="form-control input-focus"
                                                            value="{{$edit_value->comic_content}}">
                                                    </div>
                                                    <div class="form-group">
                                                        <p class="text-muted m-b-15 f-s-12" style="font-size:larger;">
                                                            Ảnh đại diện</p>
                                                        <img src="{{URL::to('/public/uploads/comic/'.$edit_value->comic_img)}}"
                                                            alt="" style="width: 100px;
                                                                                        height: 150px;
                                                                                        float: left;">
                                                        <input id="comic_img" type="file" name="comic_img"
                                                            class="form-control input-focus"
                                                            value="{{$edit_value->comic_img}}" style="
                                                width: 86.5%;
                                                margin-top: 65px;">
                                                        <label for="comic_img" class="label_file_vip"
                                                            style="left: 115px;">Chọn ảnh đại diện</label>
                                                    </div>
                                                    <div class="form-group" style="margin-top: 70px;">
                                                        <label style="font-size:larger;">Danh mục</label>
                                                        <select class="form-control input-focus" name="cate_id">
                                                            @foreach($all_cate as $key => $cate)
                                                            @if($edit_value->cate_id==$cate->cate_id)
                                                            <option selected value="{{$cate->cate_id}}">
                                                                {{$cate->cate_name}}</option>
                                                            @endif
                                                            <option value="{{$cate->cate_id}}">{{$cate->cate_name}}
                                                            </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <p class="text-muted m-b-15 f-s-12" style="font-size:larger;">
                                                            Gắn thẻ</p>
                                                        <input name="tag" type="text" class="form-control input-focus"
                                                            value="{{$edit_value->tag}}">
                                                    </div>
                                                    @endforeach
                                                    <button type="submit" class="btn btn-primary "
                                                        style="font-size:larger;margin-left: 45%;">Cập nhật</button>
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