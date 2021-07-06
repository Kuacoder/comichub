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
                    <h3 class="modal_delete_form_h3 text-danger">Do you want to delete this Chapter!</h3>
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
                <a href="{{URL::to('/view-add-chapter/'.$this_comic->comic_id)}}" type="button" class="btn--cam">Thêm
                    chương mới</a>
                <h1>Danh sách chương của truyện <span style="color: red !important;">{{$this_comic->comic_name}}</span>
                </h1>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-responsive table-striped">
                <thead>
                    <tr>
                        <th>
                            <h4 class="h4_vippro">Stt</h4>
                        </th>
                        <th>
                            <h4 class="h4_vippro">Chapter's Name</h4>
                        </th>
                        <th>
                            <h4 class="h4_vippro">Chapter's Description</h4>
                        </th>
                        <th>
                            <h4 class="h4_vippro">approval</h4>
                        </th>
                        <th>
                            <h4 class="h4_vippro">order</h4>
                        </th>
                        <th>
                            <h4 class="h4_vippro">amount crystal</h4>
                        </th>
                        <th>
                            <h4 class="h4_vippro">create</h4>
                        </th>
                        <th>
                            <h4 class="h4_vippro">last update</h4>
                        </th>
                        <th>
                            <h4 class="h4_vippro">Action</h4>
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
                        <td><span class="badge badge-default">{{$chapter->chapter_desc}}</span></td>
                        @if($chapter->status == 0)
                        <td><label class="btn--do">Awaiting Approval</label></td>
                        @else
                        <td><label class="btn--cam">approved</label></td>
                        @endif

                        <td>{{$chapter->numberical_order}}</td>
                        <td>{{$chapter->chapter_price}}</td>
                        <td><?php $timecreate = $chapter->day_create;
  												echo(date("F.d, Y h:i:s", $timecreate)); ?></td>
                        @if($chapter->day_update == '')
                        <td>No</td>
                        @else
                        <td><?php $timeupdate = $chapter->day_update;
  												echo(date("F.d, Y h:i:s", $timeupdate)); ?></td>
                        @endif
                        <td><a href="{{URL::to('/edit-chapter-client/'.$chapter->chapter_id.'/'.$chapter->comic_id)}}"
                                type="button" class="btn--vangcut">Edit</a>
                            <a data-href="{{URL::to('/delete-chapter-client/'.$chapter->chapter_id.'/'.$chapter->comic_id)}}"
                                type="button" data-toggle="modal" data-target="#confirm-delete"
                                class="btn--do">Delete</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
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