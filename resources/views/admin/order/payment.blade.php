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
<div class="content-wrap">
    <div class="main">
        <div class="container-fluid">
            <div class="row">
                <div class="main-content">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card alert">
                                <div class="card-header">
                                    <h1>Danh sách giao dịch</h1>
                                    <h6>Tổng doanh thu: <span style="color: #FF8449;">{{ $tong_doanhthu }}</span> VNĐ
                                    </h6>
                                    <form autocomplete="off" style="margin-bottom: 20px">
                                        @csrf
                                        <div class="input-group input-group-default"
                                            style="width: 20%; position: absolute;top: 45px; left: 78%;">
                                            <span class="input-group-btn"><button class="btn btn-primary"
                                                    type="submit"><i class="ti-search"></i></button></span>
                                            <input type="text" id="customer_email"
                                                placeholder="Tìm email người nạp nguyệt tinh" class="form-control">
                                        </div>
                                    </form>
                                </div>
                                <div class="card-body">
                                    <table class="table table-responsive table-striped">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Tên khách hàng</th>
                                                <th>Email khách hàng</th>
                                                <th>Ngày sinh</th>
                                                <th>Đã nạp</th>
                                                <th>Loại thẻ</th>
                                                <th>Ngày tạo</th>
                                                <th>Ngày xác nhận</th>
                                                <th>Hành động</th>
                                            </tr>
                                        </thead>
                                        <tbody id="list_payment_vip">
                                            <?php $i = 0; ?>
                                            @foreach($all_customer as $key => $cust)
                                            <?php $i++ ?>
                                            <?php $myDateTime = Carbon::create($cust->customer_birthday);
                                            $formattedweddingdate = $myDateTime->format('d.m.Y'); ?>
                                            <tr>
                                                <td>{{$i}}</td>
                                                <td>{{$cust->customer_name}}</td>
                                                <td>{{$cust->customer_email}}</td>
                                                <td><?php echo $formattedweddingdate; ?></td>
                                                <td>{{$cust->menhgia}}</td>
                                                <td>@if($cust->loaithe == 1)
                                                    Viettel
                                                    @elseif($cust->loaithe == 2)
                                                    Mobiphone
                                                    @elseif($cust->loaithe == 3)
                                                    Vinaphone
                                                    @endif
                                                </td>
                                                <td><?php echo date('d.m.Y H:i:s',$cust->payment_history_create_date); ?>
                                                </td>

                                                @if($cust->payment_history_process_date == '')
                                                <td>Chưa cập nhật</td>
                                                @else
                                                <td><?php echo date('d.m.Y H:i:s',$cust->payment_history_process_date); ?>
                                                </td>
                                                @endif
                                                <td>
                                                    @if($cust->payment_history_status == 0)
                                                    <a href="{{URL::to('/xac-nhan-thanh-toan/'.$cust->customer_id.'/'.$cust->payment_history_id)}}"
                                                        type="button" class="btn btn-addon  btn-primary m-l-5"><i
                                                            class="ti-money"></i>Xác nhận</a>
                                                    @else
                                                    <p class="label label-default p-t-10 p-b-12">Đã xác nhận</p>
                                                    @endif
                                                </td>
                                            </tr>

                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
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
    <script>
    $('#customer_email').keyup(function() {
        let customer_email = $('#customer_email').val();
        if (customer_email != '') {
            let _token = $('input[name="_token"]').val();

            $.ajax({
                url: "{{ url('/search-payment') }}",
                type: 'POST',
                data: {
                    _token: _token,
                    customer_email: customer_email,
                },
                success: function(data) {
                    $('#list_payment_vip').fadeIn();
                    $('#list_payment_vip').html(data);
                }
            });
        }
    });
    </script>
    @endsection