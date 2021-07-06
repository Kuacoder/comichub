@extends('admin.layout')

@section('content')
<!-- END chat Sidebar-->
<?php 
							    $success = Session::get('success');
                                $fail = Session::get('fail');
							    if ($success) { ?>
<div id="modal" style=" ">
    <div class="modal--table">
        <h1 class="modal--table--h1">notification</h1>
        <h3 class="modal--table--h3 text-default"><?php echo $success;
								        Session::put('success',null); ?></h3>
        <div class="modal--table--button"><button class="btn btn-default" id="close_modal">Close</button></div>

    </div>

</div>
<?php 
							    }elseif($fail) { ?>
<div id="modal" style=" ">
    <div class="modal--table">
        <h1 class="modal--table--h1">notification</h1>
        <h3 class="modal--table--h3 text-default"><?php echo $fail;
								        Session::put('fail',null); ?></h3>
        <div class="modal--table--button"><button class="btn btn-default" id="close_modal">Close</button></div>
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
                <div class="col-lg-8 p-0">
                    <div class="page-header">
                        <div class="page-title">
                            <h1>Trang chủ quản trị</h1>
                        </div>
                    </div>
                </div><!-- /# column -->
                <div class="col-lg-4 p-0">
                    <div class="page-header">
                        <div class="page-title">
                            <ol class="breadcrumb text-right">

                            </ol>
                        </div>
                    </div>
                </div><!-- /# column -->
            </div><!-- /# row -->
            <div class="main-content">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card alert">
                            <div class="card-header">
                                <h4>Thống kê doanh thu</h4>
                                <form action="{{URL::to('/fillter-by-date')}}" method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="col-lg-3">
                                            <p>Từ ngày: <input type="date" name="from_date" class="form-control"></p>


                                        </div>
                                        <div class="col-lg-3">
                                            <p>Đến ngày: <input type="date" name="to_date" class="form-control"></p>
                                        </div>
                                        <div class="col-lg-3">
                                            <button type="submit" id="loc" class="btn btn-primary"
                                                style="margin-top:25px;">Lọc</button>
                                        </div>
                                    </div>
                                </form>
                                <div class="sales-chart" style="height:470px; padding:20px 0px 40px 0px">
                                    {!! $sRate->container() !!}
                                </div>
                                {!! $sRate->script() !!}
                            </div>
                        </div>
                    </div><!-- /# column -->

                </div><!-- /# row -->

                <div class="thongketrangchu">
                    <div class="card alert nestable-cart single-card w-30-pt">
                        <div class="card-header">
                            <h4>Độ tuổi</h4>
                        </div>

                        <div class="visit-count">
                            {{$tuoinhonhat}} <span> - </span> {{$tuoilonnhat}} Tuổi
                        </div>
                    </div>

                    <div class="card alert nestable-cart single-card w-30-pt">
                        <div class="card-header">
                            <h4>Giới tính khách hàng</h4>
                        </div>

                        <div class="visit-count">
                            {{$gioitinhmuanhieunhat}}
                        </div>
                    </div>
                    <div class="card alert nestable-cart single-card w-30-pt">
                        <div class="card-header">
                            <h4>Tổng số nguyệt tinh đã giao dịch</h4>
                        </div>

                        <div class="visit-count">
                            <p>{{$sotiengiaodich}} </p><img style="margin-left: 10px; width: 20px; height: 20px;"
                                src="{{URL::to('/public/backend/images/moon.png')}}" alt="">
                        </div>
                    </div>
                </div>

            </div><!-- /# main content -->
        </div><!-- /# container-fluid -->
    </div><!-- /# main -->
</div><!-- /# content wrap -->

@endsection