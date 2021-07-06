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
        <div class="modal--table--button"><button class="btn btn-default" id="close_modal">Close</button></div>

    </div>

</div>
<?php 
							    }elseif($fail) { ?>
<div id="modal" style=" ">
    <div class="modal--table">
        <h1 class="modal--table--h1">Thông báo</h1>
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
                <div class="main-content">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card alert">
                                <div class="row">
                                    <div class="col-lg-6" style="margin-left: 25%;">
                                        <div class="card-header">
                                            <h1 style="text-align: center;">Thêm chương truyện</h1>
                                        </div>

                                        <div class="card-body">
                                            <div class="basic-form">
                                                <form method="POST" action="{{url('/save-chapter')}}"
                                                    enctype="multipart/form-data">
                                                    {{csrf_field()}}
                                                    @foreach($all_comic as $key => $comic)
                                                    <input name="comic_id" type="hidden" value="{{$comic->comic_id}}">
                                                    @endforeach
                                                    <input name="author_id" type="hidden"
                                                        value="<?php echo Session::get('admin_id'); ?>">
                                                    <div class="form-group">
                                                        <p class="text-muted m-b-15 f-s-12" style="font-size:larger;">
                                                            Tên chương</p>
                                                        <input name="chapter_name" type="text"
                                                            class="form-control input-focus"
                                                            placeholder="Nhập tên chương">
                                                    </div>
                                                    <div class="form-group">
                                                        <label style="font-size:larger;">Mô tả</label>
                                                        <textarea name="chapter_desc" style="resize: none"
                                                            class="form-control input-focus" rows="8"
                                                            placeholder="Nhập mô tả"></textarea>
                                                    </div>
                                                    <div class="form-group">
                                                        <p class="text-muted m-b-15 f-s-12" style="font-size:larger;">
                                                            Giá</p>
                                                        <input name="chapter_price" type="number"
                                                            class="form-control input-focus"
                                                            placeholder="Nhập số lượng nguyệt tinh">
                                                    </div>
                                                    <div class="form-group">
                                                        <p class="text-muted m-b-15 f-s-12" style="font-size:larger;">
                                                            Nội dung</p>
                                                        <input type="file" accept="image/*" multiple
                                                            name="chapter_img[]" id="chapter_img"
                                                            class="form-control input-focus" placeholder="Choose Img">
                                                        <label for="chapter_img" class="label_file_vip">Thêm nội dung
                                                            truyện</label>
                                                    </div>
                                                    <button type="submit" class="btn btn-primary "
                                                        style="font-size:larger;margin-left: 45%;">Thêm chương</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection