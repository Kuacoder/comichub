@extends('admin.layout')

@section('content')
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
                <h3 class="modal_delete_form_h3 text-danger">Bạn có muốn xóa truyện này!</h3>
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
                        <div class="col-lg-12" style=' width:98.3% !important;margin-left: 15px !important;'>
                            <div class="card alert">
                                <div class="card-header" style="positon: relative;">
                                    <h1 style="margin-top:10px;">Danh sách truyện tranh</h1>

                                    <form method="POST" action="{{URL::to('/search-comic-vip')}}">
                                        {{csrf_field()}}
                                        <select class="form-control" name="cate_id" id="cate_id"
                                            style="width: 15%; position: absolute;top: 45px; left: 62%;">
                                            <?php foreach($all_cate as $key => $cate){ ?>
                                            <option value="<?php echo $cate->cate_id; ?>">
                                                <?php echo $cate->cate_name; ?></option>
                                            <?php } ?>
                                        </select>
                                        <div class="input-group input-group-default"
                                            style="width: 20%; position: absolute;top: 45px; left: 78%;">
                                            <span class="input-group-btn"><button class="btn btn-primary"
                                                    type="submit"><i class="ti-search"></i></button></span>
                                            <input type="text" id="comic_name" placeholder="Tìm truyện"
                                                name="comic_name" class="form-control">
                                        </div>
                                    </form>

                                </div>

                            </div>

                        </div>
                        <div class="col-lg-12" id="list_comic_admin">
                            @foreach($all_comic as $key => $comic)
                            <div class="col-lg-2">
                                <div class="card alert">
                                    <div class="card-header" style="display: flex; justify-content: space-between; ">
                                        <h4 style=" width: 60%;
                                            overflow: hidden;
                                            text-overflow: ellipsis;
                                            -webkit-line-clamp: 1;
                                            display: -webkit-box;
                                            -webkit-box-orient: vertical;
                                        ">{{$comic->comic_name}}</h4>
                                        <?php if($comic->comic_status == 0){?>
                                        <a href="{{URL::to('/approved-comic/'.$comic->comic_id)}}"
                                            class="btn btn-primary">Chờ duyệt</a>
                                        <?php }else{ ?>
                                        <label class="label label-success p-t-7 p-b-7">Đã duyệt</label>
                                        <?php } ?>
                                    </div>
                                    <div class="card-body">
                                        <p class="text-muted m-b-10">Danh mục: {{$comic->cate_name}}</p>
                                        <p class="text-muted m-b-10">Tác giả: {{$comic->customer_name}}</p>
                                        <p class="text-muted m-b-10">Đã bán:
                                            <code>{{$comic->comic_price}}</code> chương
                                        </p>
                                        <img src="{{url('/public/uploads/comic/'.$comic->comic_img)}}"
                                            class="img-thumbnail img-responsive" alt="Cinque Terre"
                                            style="min-height: 300px;max-height: 300px;">
                                        <div class="row">
                                            @if($comic->display == 0)
                                            <a href="{{URL::to('/display-comic/'.$comic->comic_id)}}" type="button"
                                                class="btn btn-default col-lg-11 btn-addon m-l-15 m-t-10"
                                                style="max-width: 87%;"><i class="ti-na"></i>Ẩn</a>
                                            @else
                                            <a href="{{URL::to('/display-comic/'.$comic->comic_id)}}" type="button"
                                                class="btn btn-primary col-lg-11 btn-addon m-l-15 m-t-10"
                                                style="max-width: 87%;"><i class="ti-eye"></i>Hiển thị</a>
                                            @endif
                                            <a href="{{URL::to('/list-chapter/'.$comic->comic_id)}}" type="button"
                                                class="col-lg-12 btn btn-primary btn-addon m-l-15 m-t-10"
                                                style="max-width: 87%;"><i class="ti-files"></i>Chương truyện</a>

                                            <a href="{{URL::to('/edit-comic/'.$comic->comic_id)}}" type="button"
                                                class="col-lg-12 btn btn-primary btn-addon col-lg-11 m-l-15 m-t-10 "
                                                style="max-width: 87%;"><i class="ti-slice"></i>Cập nhật</a>
                                            <!-- <a data-href="{{URL::to('/delete-comic/'.$comic->comic_id)}}" type="button"
                                                data-toggle="modal" data-target="#confirm-delete"
                                                class="col-lg-12 btn btn-danger btn-addon col-lg-11 m-l-15 m-t-10"
                                                style="max-width: 87%;"><i class="ti-close"></i>Delete</a> -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
    $('#comic_name').keyup(function() {
        var cate_id = $('#cate_id').val();
        var comic_name = $('#comic_name').val();

        if (comic_name != '') {
            var _token = $('input[name="_token"]').val();

            $.ajax({
                url: "{{ url('/searchComic') }}",
                type: 'POST',
                data: {
                    _token: _token,
                    cate_id: cate_id,
                    comic_name: comic_name
                },
                success: function(data) {
                    $('#list_comic_admin').fadeIn();
                    $('#list_comic_admin').html(data);
                }
            });

        } else {

        }
    });
    </script>
    @endsection