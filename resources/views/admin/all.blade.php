@extends('admin.layout')

@section('content')
<?php use Carbon\Carbon; ?>
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
                <h3 class="modal_delete_form_h3 text-danger">Bạn có chắc chắn muốn xóa tài khoản này!</h3>
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
                                    <h1 style="margin-top:10px;">Danh sách tài khoản quản trị viên</h1>


                                    <form action="{{URL::to('/searchAdmin')}}" method="POST">
                                        @csrf

                                        <div class="input-group input-group-default"
                                            style="width: 20%; position: absolute;top: 45px; left: 78%;">
                                            <span class="input-group-btn"><button class="btn btn-primary"
                                                    type="submit"><i class="ti-search"></i></button></span>
                                            <input type="text" id="admin_name" placeholder="Tìm tài khoản"
                                                name="customer_name" class="form-control">
                                        </div>
                                    </form>
                                </div>
                                <div class="card-body">
                                    <table class="table table-responsive table-striped">
                                        <thead>
                                            <tr>
                                                <th>Stt</th>
                                                <th>Tên tài khoản</th>
                                                <th>Ngày sinh</th>
                                                <th>Giới tính</th>
                                                <th>Email</th>
                                                <th>Số điện thoại</th>
                                                <th>Trạng thái</th>
                                                <th>Hành động</th>
                                            </tr>
                                        </thead>
                                        <tbody id="list_manage">
                                            @foreach($all_admin as $key => $admin)
                                            <?php $myDateTime = Carbon::create($admin->customer_birthday);
                                    $formattedweddingdate = $myDateTime->format('d.m.Y'); ?>
                                            <tr>
                                                <th scope="row">{{$admin->customer_id}}</th>
                                                <td>{{$admin->customer_name}}</td>
                                                <td><?php echo $formattedweddingdate; ?></td>
                                                <td>@if($admin->customer_gender == 0)Nam @else Nữ @endif</td>
                                                <td><span class="badge badge-default">{{$admin->customer_email}}</span>
                                                </td>
                                                <td>{{$admin->customer_phone}}</td>
                                                <td>@if($admin->customer_status == 0)<a
                                                        href="{{URL::to('/lock-admin/'.$admin->customer_id)}}"
                                                        type="button" class="btn btn-default btn-addon m-l-5"><i
                                                            class="ti-lock"></i>Khóa</a> @else <a
                                                        href="{{URL::to('/lock-admin/'.$admin->customer_id)}}"
                                                        type="button" class="btn btn-primary btn-addon m-l-5"><i
                                                            class="ti-unlock"></i>Mở khóa</a> @endif</td>

                                                <td>
                                                    <a href="{{URL::to('/profile/'.$admin->customer_id)}}" type="button"
                                                        class="btn btn-addon btn-default "><i class="ti-file"></i>Xem
                                                        chi tiết</a>
                                                    <a href="{{URL::to('/edit-admin/'.$admin->customer_id)}}"
                                                        type="button" class="btn btn-primary btn-addon"><i
                                                            class="ti-slice"></i>Cập nhật</a>
                                                    <!-- <a data-href="{{URL::to('/delete-admin/'.$admin->customer_id)}}"
                                                        type="button" data-toggle="modal" data-target="#confirm-delete"
                                                        class="btn btn-danger btn-addon m-l-5"><i
                                                            class="ti-close"></i>Delete</a> -->
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                            <div class="col-lg-12" style="text-align:center;">

                                {{ $all_admin->links() }}


                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
    $('#close_modal').click(function() {
        $('#modal').addClass('hidden');
    });
    $('#admin_name').keyup(function() {
        var admin_name = $('#admin_name').val();

        if (admin_name != '') {
            var _token = $('input[name="_token"]').val();

            $.ajax({
                url: "{{ url('/searchAdmin') }}",
                type: 'POST',
                data: {
                    _token: _token,
                    admin_name: admin_name
                },
                success: function(data) {
                    $('#list_manage').fadeIn();
                    $('#list_manage').html(data);
                }
            });

        } else {

        }

    });
    </script>
    @endsection