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
                                <div class="row">
                                    <div class="col-lg-6" style="margin-left: 25%;">
                                        <div class="card-header">
                                            <h1 style="text-align: center;">Cập nhật chương truyện</h1>
                                        </div>

                                        <div class="card-body">
                                            <div class="basic-form">

                                                <form method="POST"
                                                    action="{{url('/update-chapter/'.$this_chapter->chapter_id)}}"
                                                    enctype="multipart/form-data">
                                                    {{csrf_field()}}

                                                    <input name="comic_id" type="hidden"
                                                        value="{{$this_comic->comic_id}}">

                                                    <input name="author_id" type="hidden"
                                                        value="{{$this_chapter->author_id_chapter}}">
                                                    <div class="form-group">
                                                        <p class="text-muted m-b-15 f-s-12" style="font-size:larger;">
                                                            Tên chương</p>
                                                        <input name="chapter_name" type="text"
                                                            class="form-control input-focus"
                                                            value="{{$this_chapter->chapter_name}}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label style="font-size:larger;">Mô tả chương</label>
                                                        <textarea name="chapter_desc" style="resize: none"
                                                            class="form-control input-focus"
                                                            rows="8">{{$this_chapter->chapter_desc}}</textarea>
                                                    </div>
                                                    <div class="form-group">
                                                        <p class="text-muted m-b-15 f-s-12" style="font-size:larger;">
                                                            Giá bán</p>
                                                        <input name="chapter_price" type="number"
                                                            class="form-control input-focus"
                                                            value="{{$this_chapter->chapter_price}}">
                                                    </div>
                                                    <div class="form-group">
                                                        <p class="text-muted m-b-15 f-s-12" style="font-size:larger;">
                                                            Thêm nội dung</p>
                                                        <input type="file" accept="image/*" multiple
                                                            name="chapter_img_more[]" class="form-control input-focus"
                                                            placeholder="Choose Img" id="chapter_img">
                                                        <label for="chapter_img" class="label_file_vip">Thêm nội dung
                                                            truyện</label>
                                                    </div>
                                                    <div class="form-group" style="margin-top:20px;">
                                                        <label style="font-size:larger;">Trạng thái</label>
                                                        <select class="form-control input-focus" name="display">
                                                            @if($this_chapter->display == 1)
                                                            <option value="0">Ẩn</option>
                                                            <option selected value="1">Hiển thị</option>
                                                            @else
                                                            <option selected value="0">Ẩn</option>
                                                            <option value="1">Hiển thị</option>
                                                            @endif
                                                        </select>
                                                    </div>
                                                    <div class="form-group do_anh_vao_day">
                                                        <p class="text-muted m-b-15 f-s-12" style="font-size:larger;">
                                                            Nội dung</p>
                                                        <div class="do_anh_vao_day2">
                                                            @foreach($all_content_chapter as $key => $value)
                                                            <label class="khoi_anh_chapter"
                                                                for="file-{{$value->chaptercontent_id}}">
                                                                <img src="{{URL::to('public/uploads/chapter/'.$value->chapter_img)}}"
                                                                    alt="">
                                                                <input type="file"
                                                                    id="file-{{$value->chaptercontent_id}}"
                                                                    name="chapter_img"
                                                                    class="form-control input-focus content-chapter-input"
                                                                    data-gal_id="{{$value->chaptercontent_id}}"
                                                                    value="{{$value->chapter_img}}" accept="image/*">
                                                            </label>
                                                            @endforeach
                                                        </div>

                                                    </div>

                                                    <input type="hidden" name="day_create"
                                                        value="{{$this_chapter->day_create}}">
                                                    <input type="hidden" name="sid"
                                                        value="{{$this_chapter->session_chapter}}">
                                                    <input type="hidden" name="status"
                                                        value="{{$this_chapter->status}}">
                                                    <input type="hidden" name="numberical_order"
                                                        value="{{$this_chapter->numberical_order}}">
                                                    <button type="submit" class="edit_chapter_vip btn btn-primary "
                                                        style="font-size:larger;margin-left: 45%;">Cập nhật chương
                                                        này</button>
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
    <script>
    $(document).on('change', '.content-chapter-input', function() {
        var gal_id = $(this).data('gal_id');
        var _token = "{{ csrf_token() }}";
        var image = document.getElementById('file-' + gal_id).files[0];
        var form_data = new FormData();
        form_data.append("chapter_img", document.getElementById('file-' + gal_id).files[0]);
        form_data.append("gal_id", gal_id);
        form_data.append("_token", _token);
        if (gal_id) {

            $.ajax({
                url: "{{url('/update-content-chapter-admin')}}",
                method: "POST",
                data: form_data,
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    $('.do_anh_vao_day2').fadeIn();
                    $('.do_anh_vao_day2').html(data);
                }
            });
        }
    });
    </script>
    @endsection