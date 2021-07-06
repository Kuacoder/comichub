@extends('admin.layout')

@section('content')
<?php use Carbon\Carbon; ?>
<?php use Illuminate\Support\Collection; ?>
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
								        Session::put('success',null); ?></h3>
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
                <h3 class="modal_delete_form_h3 text-danger">bạn có muốn xóa tài khoản này!</h3>
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
                                    <h1 style="margin-top:10px;">Danh sách tài khoản khách</h1>
                                    <form autocomplete="off">
                                        @csrf

                                        <div class="input-group input-group-default"
                                            style="width: 20%; position: absolute;top: 45px; left: 78%;">
                                            <span class="input-group-btn"><button class="btn btn-primary"
                                                    type="submit"><i class="ti-search"></i></button></span>
                                            <input type="text" id="customer_name" placeholder="Tìm tài khoản"
                                                name="customer_name" class="form-control">
                                        </div>
                                    </form>
                                </div>
                                <div class="card-body">
                                    <table class="table table-responsive table-striped">
                                        <thead>
                                            <tr>
                                                <th>
                                                    <h4>Tên khách hàng</h4>
                                                </th>
                                                <th>
                                                    <h4>Ngày sinh</h4>
                                                </th>
                                                <th>
                                                    <h4>Giới tính</h4>
                                                </th>
                                                <th>
                                                    <h4>Email</h4>
                                                </th>
                                                <th>
                                                    <h4>Số điện thoại</h4>
                                                </th>
                                                <th>
                                                    <h4>Loại tài khoản</h4>
                                                </th>
                                                <th>
                                                    <h4>Trạng thái</h4>
                                                </th>
                                                <th>
                                                    <h4>Hành động</h4>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody id="list_customer">
                                            @foreach($all_customer as $key => $customer)
                                            @if($customer->customer_title == 0 || $customer->customer_title == 1)
                                            <?php $myDateTime = Carbon::create($customer->customer_birthday);
                                    $formattedweddingdate = $myDateTime->format('d.m.Y'); ?>
                                            <tr>
                                                <td style="display: flex !important; align-items:center;"><img
                                                        style="width: 50px; height: 50px; border-radius: 50%;"
                                                        class='m-r-10'
                                                        src="{{URL::to('/public/uploads/customer/'.$customer->customer_avatar)}}"
                                                        alt="">
                                                    <p>{{$customer->customer_name}}</p>
                                                </td>

                                                <td><?php echo $formattedweddingdate; ?></td>
                                                <td>@if($customer->customer_gender == 0)Nam @else Nữ @endif</td>
                                                <td><span
                                                        class="badge badge-default">{{$customer->customer_email}}</span>
                                                </td>

                                                <td>{{$customer->customer_phone}}</td>

                                                <td>@if($customer->customer_title == 0)<a
                                                        href="{{URL::to('/title-customer/'.$customer->customer_id)}}"
                                                        type="button" class="btn btn-default btn-addon m-l-5"><i
                                                            class="ti-user"></i>Thường</a> @else <a
                                                        href="{{URL::to('/title-customer/'.$customer->customer_id)}}"
                                                        type="button" class="btn btn-primary btn-addon m-l-5"><i
                                                            class="ti-pencil"></i>Tác giả</a> @endif</td>

                                                <td>@if($customer->customer_status == 0)<a
                                                        href="{{URL::to('/lock-customer/'.$customer->customer_id)}}"
                                                        type="button" class="btn btn-default btn-addon m-l-5"><i
                                                            class="ti-lock"></i>Khóa</a> @else <a
                                                        href="{{URL::to('/lock-customer/'.$customer->customer_id)}}"
                                                        type="button" class="btn btn-primary btn-addon m-l-5"><i
                                                            class="ti-unlock"></i>Mở khóa</a> @endif</td>
                                                <td>
                                                    <a href="{{URL::to('/profile-customer-admin/'.$customer->customer_id)}}"
                                                        type="button" class="btn btn-addon btn-default "><i
                                                            class="ti-file"></i>Xem chi tiết</a>
                                                    <a href="{{URL::to('/edit-customer/'.$customer->customer_id)}}"
                                                        type="button" class="btn btn-addon btn-primary m-l-5"><i
                                                            class="ti-slice"></i>Cập nhật</a>
                                                    <!-- <a data-href="{{URL::to('/delete-customer/'.$customer->customer_id)}}"
                                                        type="button" data-toggle="modal" data-target="#confirm-delete"
                                                        class="btn btn-danger btn-addon m-l-5 open_delete_customer"><i
                                                            class="ti-close"></i>Delete</a> -->
                                                </td>
                                            </tr>
                                            @endif
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                            <div class="col-lg-12" style="text-align:center;">

                                {{ $all_customer->links() }}


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
    $('#customer_name').keyup(function() {
        var customer_name = $('#customer_name').val();

        if (customer_name != '') {
            var _token = $('input[name="_token"]').val();

            $.ajax({
                url: "{{ url('/searchCustomer') }}",
                type: 'POST',
                data: {
                    _token: _token,
                    customer_name: customer_name
                },
                success: function(data) {
                    $('#list_customer').fadeIn();
                    $('#list_customer').html(data);
                }
            });

        } else {

        }

    });
    </script>
    @endsection