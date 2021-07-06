@include('customer.author.head')
<div class="createcenter-body container-fluid">
    @include('customer.author.sidebar')
    <!-- 
START MODAL DELETE -->
    <script data-require="jquery@*" data-semver="2.0.3" src="http://code.jquery.com/jquery-2.0.3.min.js"></script>
    <script data-require="bootstrap@*" data-semver="3.1.1"
        src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
    <link data-require="bootstrap-css@3.1.1" data-semver="3.1.1" rel="stylesheet"
        href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css" />
    <div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal_delete_customer_table">

                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Confirm Delete</h4>
                </div>

                <div class="modal_delete_acction">
                    <h3 class="modal_delete_form_h3 text-danger">Do you want to delete this comic!</h3>
                </div>

                <div class="modal_delete_acction">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-danger btn-ok">Delete</a>
                </div>
            </div>
        </div>
    </div>
    <!-- 
END -->
    <div class="createcenter-body-content">
        <div class="createcenter-body-content3">
            <div class="createcenter-body-content3_title">
                <h1>Danh sách truyện của tác giả</h1>
            </div>
        </div>

        <div class="row all--comic--element">
            <?php if(isset($all_comic)){ ?>
            @foreach($all_comic as $key => $comic)

            <div class="comic--element">
                <p class="comic--element--name">Tên truyện: {{$comic->comic_name}}</p>
                @if($comic->comic_status == 0)

                <span class="approval btn--cam">chờ duyệt</span>
                @else
                <span class="approval btn--do">đã duyệt</span>
                @endif
                <p>Chủ đề: {{$comic->cate_name}}</p>
                <p>Đã bán: <span>{{$comic->comic_schedule}}</span></p>
                <div class="comic--element--img">
                    <img src="/public/uploads/comic/{{$comic->comic_img}}" alt="">
                </div>
                <a href="{{URL::to('/view-list-chapter/'.$comic->comic_id)}}" class="add--chapter--client btn--cam">Thêm
                    chương</a>
                <a href="{{URL::to('/view-update-comic/'.$comic->comic_id)}}" class="edit--comic--client btn--xanh">Sửa
                    truyện</a>
                <a data-href="{{URL::to('/delete-comic-client/'.$comic->comic_id)}}" data-toggle="modal"
                    data-target="#confirm-delete" class="delete--comic--client btn--do">Xóa truyện</a>
            </div>
            @endforeach
            <?php }else{echo '<h2 style="width: 100%;text-align: center;color: #EC5245">Ngươi chưa đăng tải truyện!</h2>';}?>
        </div>
    </div>
</div>


<script>
$('#confirm-delete').on('show.bs.modal', function(e) {
    $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));

    $('.debug-url').html('Delete URL: <strong>' + $(this).find('.btn-ok').attr('href') + '</strong>');
});
</script>


@include('customer.author.footer')