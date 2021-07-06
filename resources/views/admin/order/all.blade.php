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
                                <div class="card-header" style="positon: relative;">
                                    <h1 style="margin-top:10px;">Danh sách đơn hàng </h1>
                                    <form action="{{URL::to('/loc-order')}}" method="POST">
                                        @csrf
                                        <div class="row">
                                            <div class="col-lg-3">
                                                <p>Từ ngày: <input type="date" name="from_date" class="form-control">
                                                </p>
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

                                    <div class="input-group input-group-default"
                                        style="width: 20%; position: absolute;top: 45px; left: 78%;">
                                        <span class="input-group-btn"><button class="btn btn-primary"><i
                                                    class="ti-search"></i></button></span>
                                        <input type="text" id="buyer" placeholder="Search buyer" class="form-control">
                                    </div>
                                </div>
                                <div class="card-body">
                                    <table class="table table-responsive table-striped">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Tên truyện</th>
                                                <th>Tác giả truyện</th>
                                                <th>Tên chương</th>
                                                <th>Giá bán</th>
                                                <th>Tác giả của chương</th>
                                                <th>Email Người mua</th>
                                                <th>Ngày mua</th>

                                            </tr>
                                        </thead>
                                        <tbody id="list-of-order">
                                            @foreach($all_order as $key => $order)
                                            <tr>
                                                <td scope="row">{{$order->chapterunlock_id}}</td>
                                                <td scope="row">{{$order->comic_name}}</td>
                                                <td scope="row">{{$order->author_comic}}</td>
                                                <td scope="row">{{$order->chapter_name}}</td>
                                                <td scope="row" style="display:flex; align-items:center">
                                                    {{$order->chapter_price}} <img
                                                        style="margin-left: 10px; width: 20px; height: 20px;"
                                                        src="{{URL::to('/public/backend/images/moon.png')}}" alt="">
                                                </td>
                                                <td scope="row">{{$order->author_chapter}}</td>
                                                <td scope="row">{{$order->buyer}}</td>
                                                <td scope="row">
                                                    <?php echo date("d.m.Y h:i:s", strtotime($order->day_create_order)) ?>
                                                </td>

                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12" style="text-align:center;">

                        {{ $all_order->links() }}


                    </div>
                </div>

            </div>
        </div>
    </div>
    <script>
    $('#buyer').keyup(function() {
        let buyer = $('#buyer').val();
        if (buyer != '') {
            let _token = $('input[name="_token"]').val();

            $.ajax({
                url: "{{ url('/searchorder') }}",
                type: 'POST',
                data: {
                    _token: _token,
                    buyer: buyer,
                },
                success: function(data) {
                    $('#list-of-order').fadeIn();
                    $('#list-of-order').html(data);
                }
            });
        }
    });
    </script>
    @endsection