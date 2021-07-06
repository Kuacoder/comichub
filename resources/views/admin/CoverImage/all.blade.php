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
                <h3 class="modal_delete_form_h3 text-danger">Bạn có muốn xóa ảnh bìa!</h3>
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
                                    <h1 style="margin-top:10px;">Danh sách ảnh bìa</h1>


                                </div>
                            </div>

                        </div>
                        <div class="col-lg-12" id="list_comic_admin">
                            @foreach($all_image as $key => $CoverImage)
                            <div class="col-lg-2">
                                <div class="card alert">
                                    <div class="card-header"
                                        style="display: flex; justify-content: center;margin-bottom:10px;letter-spacing:0.5px; ">
                                        ------ Ảnh bìa truyện ------
                                    </div>
                                    <div class="card-body">
                                        <img src="{{url('/public/uploads/coverimg/'.$CoverImage->coverimg_picture)}}"
                                            class="img-thumbnail img-responsive" alt="Cinque Terre"
                                            style="min-height: 300px;max-height: 300px;">
                                        <div class="row">
                                            @if($CoverImage->status == 0)
                                            <a href="{{URL::to('/change-status-cover-image/'.$CoverImage->coverimg_id)}}"
                                                type="button" class="btn btn-default col-lg-11 btn-addon m-l-15 m-t-10"
                                                style="max-width: 87%;"><i class="ti-na"></i>Ẩn</a>
                                            @else
                                            <a href="{{URL::to('/change-status-cover-image/'.$CoverImage->coverimg_id)}}"
                                                type="button" class="btn btn-primary col-lg-11 btn-addon m-l-15 m-t-10"
                                                style="max-width: 87%;"><i class="ti-eye"></i>Hiện</a>
                                            @endif
                                            <a href="{{URL::to('/edit-cover-image/'.$CoverImage->coverimg_id)}}"
                                                type="button"
                                                class="col-lg-12 btn btn-primary btn-addon col-lg-11 m-l-15 m-t-10 "
                                                style="max-width: 87%;"><i class="ti-slice"></i>Cập nhật</a>
                                            <!-- <a data-href="{{URL::to('/delete-cover-image/'.$CoverImage->coverimg_id)}}"
                                                type="button" data-toggle="modal" data-target="#confirm-delete"
                                                class="col-lg-12 btn btn-danger btn-addon col-lg-11 m-l-15 m-t-10"
                                                style="max-width: 87%;"><i class="ti-close"></i>Delete</a> -->
                                        </div>
                                    </div>
                                </div>
                            </div>


                            @endforeach

                        </div>
                        <div class="col-lg-12" style="text-align:center;">




                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
// $('#admin_name').keyup(function(){
//     var admin_name = $('#admin_name').val();

//     if(admin_name != '' ){
//         var _token = $('input[name="_token"]').val();

//         $.ajax({
//                     url: "{{ url('/searchAdmin') }}",
//                     type:'POST',
//                     data: {_token:_token, admin_name:admin_name},
//                     success: function(data) {
//                         $('#list_manage').fadeIn();
//                         $('#list_manage').html(data);
//                     }
//                 });

//     }else{

//     }

// });
</script>
@endsection