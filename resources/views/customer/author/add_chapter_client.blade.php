@include('customer.author.head')
<div class="createcenter-body container-fluid">
    @include('customer.author.sidebar')
    <div class="createcenter-body-content-home">
        <form name="myForm" action="{{URL::to('/add-chapter-client')}}" method="POST" enctype="multipart/form-data"
            onsubmit="return validateformaddchapter()">
            @csrf

            <input name="comic_id" type="hidden" value="{{$this_comic->comic_id}}">

            <input name="author_id" type="hidden" value="<?php echo Session::get('customer_id'); ?>">
            <div class="form-group">
                <h3><span>*</span>Tên Chương:</h3>
                <input id="chapter_name" name="chapter_name" type="text" class="form-control"
                    placeholder="Chapter Name">
                <h4 id="chapter_name__err" class="error"></h4>
            </div>
            <div class="form-group" style="margin-top: 15px;">
                <h3><span>*</span>Mô tả:</h3>
                <textarea name="chapter_desc" id="" cols="56" rows="12"
                    placeholder="Vui lòng nhập giới thiệu khoảng 20 - 150 từ"></textarea>
                <h4 style="color: black; margin-top: 400px;"> 0/150</h4>
            </div>
            <div class="form-group" style="margin-top: 215px;">
                <h3><span>*</span>Giá bán:</h3>
                <input id="chapter_price" name="chapter_price" type="number" class="form-control "
                    placeholder="Enter number crystal">
                <h4 id="chapter_price__err" class="error"></h4>
            </div>
            <div class="form-group">
                <h3><span>*</span>Nội dung:</h3>
                <input id="chapter_img" style="width:30%; margin-left:20px;" type="file" accept="image/*" multiple
                    name="chapter_img[]" class="form-control " placeholder="Choose Img">
                <h4 id="chapter_img__err" class="error"></h4>
            </div>
            <button type="submit">thêm chương này</button>
        </form>
    </div>
</div>
<script>
function validateformaddchapter() {
    let avatar = document.getElementById('chapter_img');
    if (avatar.value == '') {
        let avatar_err = document.getElementById('chapter_img__err');
        avatar_err.textContent = "Không được để trống trường này!";
        return false;
    }

    let chapter_price = document.getElementById('chapter_price');
    if (isNaN(chapter_price.value)) {
        let chapter_price__err = document.getElementById('chapter_price__err');
        chapter_price__err.textContent = "Giá bán phải là số!";
        return false;
    }

    if (chapter_price.value == '') {
        let chapter_price__err = document.getElementById('chapter_price__err');
        chapter_price__err.textContent = "Không được để trống trường này!";
        return false;
    }
    let chapter_name = document.getElementById('chapter_name');
    if (chapter_name.value == '') {
        let chapter_name__err = document.getElementById('chapter_name__err');
        chapter_name__err.textContent = "Không được để trống trường này!";
        return false;
    }
}
$('#chapter_img').change(function() {
    var files = $('#chapter_img')[0].files;
    if (files.length > 6) {
        $('#chapter_img__err').text('Vui lòng chọn tối đa 6 ảnh');
        return false;
    }
});
</script>
@include('customer.author.footer')