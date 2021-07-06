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
<!-- 
START MODAL DELETE -->

<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal_delete_customer_table">

            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Thông báo</h4>
            </div>

            <div class="modal_delete_acction">
                <h3 class="modal_delete_form_h3 text-danger">Bạn có muốn xóa danh mục này!</h3>
            </div>

            <div class="modal_delete_acction">
                <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
                <a class="btn btn-danger btn-ok">Xóa</a>
            </div>
        </div>
    </div>
</div>
<!-- 
END -->
<div class="content-wrap">
    <div class="main">
        <div class="container-fluid">
            <div class="row">
                <div class="main-content">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card alert">
                                <div class="card-header">
                                    <h1>Danh sách danh mục </h1>
                                    <div class="card-header-right-icon">

                                    </div>
                                </div>
                                <div class="card-body">
                                    <table class="table table-responsive table-striped">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Tên danh mục</th>
                                                <th>Mô tả</th>
                                                <th>Trạng thái</th>
                                                <th>Hành động</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($all_cate as $key => $cate)
                                            <tr>
                                                <th scope="row">{{$cate->cate_id}}</th>
                                                <td>{{$cate->cate_name}}</td>
                                                <td><span class="">{{$cate->cate_desc}}</span></td>
                                                <td>@if($cate->status == 0)
                                                    <a href="{{URL::to('/change-status-category/'.$cate->cate_id)}}"
                                                        type="button" class="btn btn-addon  btn-default "><i
                                                            class="ti-na"></i>Không hiển thị</a>
                                                    @else
                                                    <a href="{{URL::to('/change-status-category/'.$cate->cate_id)}}"
                                                        type="button" class="btn btn-addon  btn-primary "><i
                                                            class="ti-eye"></i>Hiển thị</a>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="{{URL::to('/edit-category/'.$cate->cate_id)}}"
                                                        type="button" class="btn btn-addon  btn-primary "><i
                                                            class="ti-slice"></i>Cập nhật</a>
                                                    <!-- <a data-href="{{URL::to('/delete-category/'.$cate->cate_id)}}"
                                                        type="button" data-toggle="modal" data-target="#confirm-delete"
                                                        class="btn btn-addon  btn-danger m-l-5"><i
                                                            class="ti-close"></i>Delete</a> -->
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection