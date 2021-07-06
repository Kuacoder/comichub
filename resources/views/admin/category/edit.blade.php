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
                                    <h1 style="text-align: center;">Cập nhật danh mục</h1>
                                </div>
                                <div class="card-body row">
                                    <div class="col-lg-6" style="margin-left: 25%;">
                                        <div class="basic-form">
                                            @foreach($edit_cate as $key => $edit_value)
                                            <form method="POST"
                                                action="{{url('/update-category/'.$edit_value->cate_id)}}">
                                                {{csrf_field()}}

                                                <input type="hidden" name="cate_id" value="{{$edit_value->cate_id}}">
                                                <div class="form-group">
                                                    <p class="text-muted m-b-15 f-s-12" style="font-size:larger;">
                                                        Tên danh mục</p>
                                                    <input name="cate_name" type="text" class="form-control input-focus"
                                                        value="{{$edit_value->cate_name}}">
                                                </div>
                                                <div class="form-group">
                                                    <label style="font-size:larger;">Mô tả danh mục</label>
                                                    <textarea name="cate_desc" style="resize: none"
                                                        class="form-control input-focus"
                                                        rows="8">{{$edit_value->cate_desc}}</textarea>
                                                </div>

                                                @endforeach
                                                <button type="submit" class="btn btn-primary "
                                                    style="font-size:larger; margin-left: 45%;">Cập nhật</button>
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