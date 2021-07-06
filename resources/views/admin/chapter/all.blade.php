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
        <h1 class="modal--table--h1">notification</h1>
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
                <h3 class="modal_delete_form_h3 text-danger">Bạn có muốn xóa chương truyện này!</h3>
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
                                    <h1 style="margin-top:10px;">Danh sách chương </h1>
                                    @foreach($all_comic as $key => $comic)
                                    <a href="{{URL::to('/add-chapter/'.$comic->comic_id)}}" type="button"
                                        class="btn btn-addon btn-primary m-b-10 m-l-5"><i class="ti-plus"></i>Thêm
                                        chương mới</a>
                                    @endforeach

                                </div>
                                <div class="card-body">
                                    <table class="table table-responsive table-striped">
                                        <thead>
                                            <tr>
                                                <th>
                                                    <h4>Stt</h4>
                                                </th>
                                                <th>
                                                    <h4>Tên chương</h4>
                                                </th>
                                                <th>
                                                    <h4>Mô tả</h4>
                                                </th>
                                                <th>
                                                    <h4>Trạng thái</h4>
                                                </th>
                                                <th>
                                                    <h4>Đã bán</h4>
                                                </th>
                                                <th>
                                                    <h4>Giá bán</h4>
                                                </th>
                                                <th>
                                                    <h4>Ngày tạo</h4>
                                                </th>
                                                <th>
                                                    <h4>Cập nhật lần cuối</h4>
                                                </th>
                                                <th>
                                                    <h4>Hành động</h4>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody id="list_chapter">
                                            <?php $i=1; ?>
                                            @foreach($all_chapter as $key => $chapter)
                                            <?php $i++; ?>
                                            <tr>
                                                <td>{{$i}}</td>
                                                <td>{{$chapter->chapter_name}}</td>
                                                <td><span>{{$chapter->chapter_desc}}</span>
                                                </td>
                                                @if($chapter->status == 0)
                                                <td><a href="{{URL::to('/approved-chapter/'.$chapter->chapter_id.'/'.$chapter->comic_id)}}"
                                                        class="btn btn-primary">Đang chờ duyệt</a></td>
                                                @else
                                                <td><label class="label label-default p-t-7 p-b-7">Đã duyệt</label></td>
                                                @endif

                                                <td>{{$chapter->numberical_order}} chương</td>
                                                <td style="display: flex;align-items: center;">
                                                    {{$chapter->chapter_price}}
                                                    <span><img style="width:20px;height:20px;margin-left:10px"
                                                            src="{{URL::to('/public/frontend/img/moon.png')}}"
                                                            alt=""></span>
                                                </td>
                                                <td><?php $timecreate = $chapter->day_create;
  												echo(date("d.m.Y h:i:s", $timecreate)); ?></td>
                                                @if($chapter->day_update == '')
                                                <td>No</td>
                                                @else
                                                <td><?php $timeupdate = $chapter->day_update;
  												echo(date("d.m.Y h:i:s", $timeupdate)); ?></td>
                                                @endif
                                                <td><a href="{{URL::to('/edit-chapter/'.$chapter->chapter_id.'/'.$chapter->comic_id)}}"
                                                        type="button" class="btn btn-addon btn-primary m-l-5"><i
                                                            class="ti-slice"></i>Cập nhật</a>
                                                    <!-- <a data-href="{{URL::to('/delete-chapter/'.$chapter->chapter_id.'/'.$chapter->comic_id)}}"
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

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @endsection