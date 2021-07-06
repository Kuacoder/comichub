@include('customer.author.head')
<div class="createcenter-body container-fluid">
    @include('customer.author.sidebar')
    <div class="createcenter-body-content-home">
        <form name="myForm" action="{{URL::to('/update-chapter-client/'.$this_chapter->chapter_id)}}" method="POST"
            enctype="multipart/form-data">
            @csrf

            <input name="comic_id" type="hidden" value="{{$this_comic->comic_id}}">

            <input name="author_id" type="hidden" value="<?php echo Session::get('customer_id'); ?>">
            <input name="status" type="hidden" value="{{$this_chapter->status}}">
            <input name="display" type="hidden" value="{{$this_chapter->display}}">
            <input name="numberical_order" type="hidden" value="{{$this_chapter->numberical_order}}">
            <input name="day_create" type="hidden" value="{{$this_chapter->day_create}}">
            <input name="sid" type="hidden" value="{{$this_chapter->session_chapter}}">
            <div class="form-group">
                <h3><span>*</span>Tên Chương:</h3>
                <input name="chapter_name" type="text" class="form-control" value="{{$this_chapter->chapter_name}}">

            </div>
            <div class="form-group" style="margin-top: 15px;">
                <h3><span>*</span>Mô tả:</h3>
                <textarea name="chapter_desc" id="" cols="56" rows="12"
                    placeholder="Vui lòng nhập giới thiệu khoảng 20 - 150 từ">{{$this_chapter->chapter_desc}}</textarea>
                <h4 style="color: black; margin-top: 400px;"> 0/150</h4>
            </div>

            <div class="form-group" style="margin-top: 215px;">
                <h3><span>*</span>Giá bán:</h3>
                <input name="chapter_price" type="number" class="form-control" value="{{$this_chapter->chapter_price}}">

            </div>
            <div class="form-group">
                <h3><span>*</span>Thêm Nội dung:</h3>
                <input id="chapter_img" style="width:30%; margin-left:20px;" type="file" accept="image/*" multiple
                    name="chapter_img_more[]" class="form-control " placeholder="Choose Img">
                <h4 id="chapter_img__err" class="error"></h4>
            </div>
            <div class="form-content-chapter">
                <h3><span>*</span>Nội dung:</h3>
                <div class="form-content-chapter--main--content">
                    @foreach($all_content_chapter as $key => $value)
                    <label class="content-chapter-box" for="file-{{$value->chaptercontent_id}}">
                        <img class="content-chapter-img"
                            src="{{URL::to('public/uploads/chapter/'.$value->chapter_img)}}" alt="">
                        <input type="file" id="file-{{$value->chaptercontent_id}}" name="chapter_img"
                            class="content-chapter-input" data-gal_id="{{$value->chaptercontent_id}}"
                            value="{{$value->chapter_img}}" accept="image/*">
                    </label>
                    @endforeach
                </div>

            </div>
            <button class="content-chapter-submit" type="submit">sửa chương này</button>
        </form>
    </div>
</div>
<script>
$(document).on('change', '.content-chapter-input', function() {
    var gal_id = $(this).data('gal_id');
    var _token = "{{ csrf_token() }}";

    if (gal_id) {
        var image = document.getElementById('file-' + gal_id).files[0];
        var form_data = new FormData();
        form_data.append("chapter_img", document.getElementById('file-' + gal_id).files[0]);
        form_data.append("gal_id", gal_id);
        form_data.append("_token", _token);
        $.ajax({
            url: "{{url('/update-content-chapter')}}",
            method: "POST",
            data: form_data,
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                $('.form-content-chapter--main--content').fadeIn();
                $('.form-content-chapter--main--content').html(data);
            }
        });
    }

});
</script>
@include('customer.author.footer')