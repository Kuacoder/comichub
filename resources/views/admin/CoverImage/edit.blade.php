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
                                <div class="card-header">
                                    <h1 style="text-align: center;">Cập nhật ảnh bìa</h1>
                                </div>

                                <div class="card-body row">
                                    <div class="col-lg-6" style="margin-left: 25%;">
                                        <div class="basic-form">
                                            @foreach($all_coverimg as $key => $coverimg)
                                            <form method="POST"
                                                action="{{url('/update-cover-image/'.$coverimg->coverimg_id)}}"
                                                enctype="multipart/form-data" onsubmit="return checkcoverimg()">
                                                {{csrf_field()}}
                                                <div class="form-group">
                                                    <p class="text-muted m-b-15 f-s-12" style="font-size:larger;">Chọn
                                                        ảnh bìa</p>
                                                    <img src="{{URL::to('/public/uploads/coverimg/'.$coverimg->coverimg_picture)}}"
                                                        alt="" style="width: 100px;
                                                                                        height: 150px;
                                                                                        float: left;">
                                                    <input id="this_coverimg" type="file" name="coverimg_picture"
                                                        class="form-control input-focus" style="
                                                width: 86.5%;
                                                margin-top: 65px;" value="{{$coverimg->coverimg_picture}}">
                                                    <label for="this_coverimg" class="label_file_vip"
                                                        style="left: 115px;">Chọn ảnh
                                                        bìa</label>
                                                    <p class="text-danger m-t-10" id="cover_img_err"
                                                        style="position: absolute; left: 115px;"></p>
                                                </div>
                                                <input type="hidden" name="status" value="{{$coverimg->status}}">
                                                <button type="submit" class="btn btn-primary"
                                                    style="font-size:larger; margin-left: 35%; margin-top: 70px;">Cập
                                                    nhật</button>
                                            </form>
                                            @endforeach
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