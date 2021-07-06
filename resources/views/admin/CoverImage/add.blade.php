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
                                    <h1 style="text-align: center;">Thêm ảnh bìa truyện</h1>
                                </div>
                                <div class="card-body row">
                                    <div class="col-lg-6" style="margin-left: 25%;">
                                        <div class="basic-form">
                                            <form method="POST" action="{{url('/save-cover-image')}}"
                                                enctype="multipart/form-data">
                                                {{csrf_field()}}
                                                <div class="form-group">
                                                    <p class="text-muted m-b-15 f-s-12" style="font-size:larger;">Chọn
                                                        một ảnh bìa</p>
                                                    <input id="coverimg_picture" type="file" name="coverimg_picture"
                                                        class="form-control input-focus" placeholder="Chọn
                                                        một ảnh bìa">
                                                    <label for="coverimg_picture" class="label_file_vip">Chọn ảnh
                                                        bìa</label>
                                                </div>

                                                <button type="submit" class="btn btn-primary "
                                                    style="font-size:larger; margin-left: 45%;">Thêm ảnh bìa</button>
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
    @endsection