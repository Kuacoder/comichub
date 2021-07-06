@extends('admin.layout')

@section('content')
<?php 
							    $success = Session::get('success');
                                $fail = Session::get('fail');
							    if ($success) { ?>
<div id="modal" style=" ">
    <div class="modal--table">
        <h1 class="modal--table--h1">notification</h1>
        <h3 class="modal--table--h3 text-primary"><?php echo $success;
								        Session::put('success',null); ?></h3>
        <div class="modal--table--button"><button class="modal--table--button2" id="close_modal">Close</button></div>

    </div>

</div>
<?php 
							    }elseif($fail) { ?>
<div id="modal" style=" ">
    <div class="modal--table">
        <h1 class="modal--table--h1">notification</h1>
        <h3 class="modal--table--h3 text-default"><?php echo $fail;
								        Session::put('fail',null); ?></h3>
        <div class="modal--table--button"><button class="modal--table--button2" id="close_modal">Close</button></div>
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
                                    <h1 style="text-align: center;">Thêm danh mục</h1>
                                </div>
                                <div class="card-body row">
                                    <div class="col-lg-6" style="margin-left: 25%;">
                                        <div class="basic-form">
                                            <form id="formAddCate" method="POST" action="{{url('/save-category')}}">
                                                {{csrf_field()}}
                                                <div class="form-group">
                                                    <p class="text-muted m-b-15 f-s-12" style="font-size:larger;">
                                                        Tên danh mục</p>
                                                    <input name="cate_name" type="text" class="form-control input-focus"
                                                        placeholder="Nhập tên danh mục">
                                                </div>
                                                <div class="form-group">
                                                    <label style="font-size:larger;">Mô tả danh mục</label>
                                                    <textarea name="cate_desc" style="resize: none"
                                                        class="form-control input-focus" rows="8"
                                                        placeholder="Nhập mô tả danh mục"></textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label style="font-size:larger;">Trạng thái</label>
                                                    <select class="form-control input-focus" name="status">
                                                        <option value="0">Ẩn</option>
                                                        <option value="1">Hiển thị</option>
                                                    </select>
                                                </div>
                                                <button type="submit" id="myBtn" class="btn btn-primary "
                                                    style="font-size:larger; margin-left: 45%;">Thêm</button>
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