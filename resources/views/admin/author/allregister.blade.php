@extends('admin.layout')

@section('content')
<?php use Carbon\Carbon; ?>
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
                                    <h1>Lịch sử đăng ký tác giả</h1>
                                    <div class="card-header-right-icon">

                                    </div>
                                </div>
                                <div class="card-body">
                                    <table class="table table-responsive table-striped">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Tên người dùng</th>
                                                <th>Email người dùng</th>
                                                <th>Ngày sinh</th>
                                                <th>Ngày đăng ký</th>
                                                <th>Ngày xử lý</th>
                                                <th>Hành động</th>
                                            </tr>
                                        </thead>
                                        <tbody><?php $i = 0; ?>
                                            @foreach($register_author as $key => $register)
                                            <?php $i++; ?>
                                            <?php $myDateTime = Carbon::create($register->customer_birthday);
                                    $formattedweddingdate = $myDateTime->format('d.m.Y'); ?>
                                            <tr>
                                                <td>{{$i}}</td>
                                                <td>{{$register->customer_name}}</td>
                                                <td>{{$register->customer_email}}</td>
                                                <td><?php echo $formattedweddingdate; ?></td>
                                                <td><?php echo date('d.m.Y H:i:s',$register->register_author_create_date); ?>
                                                </td>
                                                @if($register->register_author_process_date == '')
                                                <td>No</td>
                                                @else
                                                <td><?php echo date('d.m.Y H:i:s',$register->register_author_create_date); ?>
                                                </td>
                                                @endif

                                                <td>
                                                    @if($register->register_author_status == 0)
                                                    <a href="{{URL::to('process-register-author/'.$register->customer_id.'/'.$register->register_author_id)}}"
                                                        type="button" class="btn btn-addon  btn-primary m-l-5"><i
                                                            class="ti-wand"></i>Xử lý</a>
                                                    @else
                                                    <p class="label label-default p-t-10 p-b-12">Đã xử lý</p>
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

                            {{ $register_author->links() }}


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection