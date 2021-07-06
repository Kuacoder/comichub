@extends('customer.layout')
@include('customer.sidebar')
@section('content')
<!-- BODY -->
<div class="container">
@foreach($this_comic as $key => $comic)
    <div class="comic-info">
        <div class="comic-info-left">
            <div class="comic-info-left_top">
                <div class="comic-info-left_img">
                    <a  href="{{URL::to('/read-comic/'.$comic->comic_id)}}">
                        <div class="comic-info-left_img1">
                            <img src="{{URL::to('/public/uploads/comic/'.$comic->comic_img)}}" alt=""><p class="comic-info-left_img2">Đang tải</p>
                        </div>
                    </a>   
                </div>
                <div class="comic-info-left_desc">
                    <div class="comic-info-left_desc_top">
                        <p>{{$comic->comic_name}}</p>
                        <p>Vui lòng đánh giá:</p>
                        <div class="comic-info-left_desc_top_star">
                            @for($count = 1; $count <= 5;$count++)

                            <?php 
                                if($count<=$rating){
                                    $color = 'color: #FF9A6A';
                                }else{
                                    $color = 'color: #E8E8E8';
                                }
                            ?>
                            <a href="/rating-comic/{{$comic->comic_id}}/{{$count}}" id="{{$comic->comic_id}}-{{$count}}" data-index="{{$count}}" data-comic_id="{{$comic->comic_id}}" data-rating="{{$rating}}" class="rating" style="{{$color}}">&#9733;</a>
                            
                            
                            
                            @endfor
                        </div>
                        <p class="comic-info-left_desc_top_rank">Điểm đánh giá: <span style="color: #FF9A6A"><?php if($rating_comic){ echo $rating_comic;}else{echo 0;} ?></span> ( {{$number_rating}} lượt đánh giá)</p>
                        <br>
                        <span>Tác giả: {{$comic->customer_name}}</span>
                        <p class="comic-info-left_desc_top_content">{{$comic->comic_desc}}</p>
                    </div>
                   
                    <div class="comic-info-left_desc_bot">
                        <div class="comic-info-left_desc_bot_tag">
                            <span>TAG:</span><a href="#">{{$comic->tag}}</a><a href="#" class="comic-info-left_desc_bot_tag_more">+ Thêm</a>
                           
                        </div>
                        <ul>
                      
                       <li>
                       <a href="{{URL::to('/read-comic/'.$comic->comic_id)}}">đọc ngay</a></li>
                        </ul>
                    </div>
                </div>
            </div>
           
           
        </div>
        <div class="offer-comic-list">
                <div class="offer-comic-list_title">
                    <p>DE XUAT</p>
                </div>
                <div class="offer-comic-list_comic ">
                    <div class="offer-comic-list_comic_element_part">
                    <?php $i=0; foreach($relate_comic_bestsale as $key => $value){ $i++;?>
                        <div class="offer-comic-list_comic_element_part1">
                            <a class="offer-comic-list_comic_element_part1_img" href="{{URL::to('/visit-comic/'.$value->comic_id)}}"><img src="{{URL::to('/public/uploads/comic/'.$value->comic_img)}}" alt=""></a>
                            <a href="#" class="offer-comic-list_comic_element_part1_name">{{$value->comic_name}}</a>
                        </div>
                        <?php if($i==1){break;}} ?>
                        <?php $i=0; foreach($relate_comic_bestsale as $key => $value){ $i++;if($i==2){?>
                        <div class="offer-comic-list_comic_element_part2">
                            <a class="offer-comic-list_comic_element_part2_img" href="{{URL::to('/visit-comic/'.$value->comic_id)}}"><img src="{{URL::to('/public/uploads/comic/'.$value->comic_img)}}" alt=""></a>
                            <a href="#" class="offer-comic-list_comic_element_part2_name">{{$value->comic_name}}</a>
                        </div>
                        <?php }if($i==2){break;}} ?>
                    </div>
                    <div class="offer-comic-list_comic_element_part">
                        <?php $i=0; foreach($relate_comic_bestsale as $key => $value){ $i++;if($i==3){?>
                        <div class="offer-comic-list_comic_element_part1">
                            <a class="offer-comic-list_comic_element_part1_img" href="{{URL::to('/visit-comic/'.$value->comic_id)}}"><img src="{{URL::to('/public/uploads/comic/'.$value->comic_img)}}" alt=""></a>
                            <a href="#" class="offer-comic-list_comic_element_part1_name">{{$value->comic_name}}</a>
                        </div>
                        <?php }if($i==3){break;}} ?>
                        <?php $i=0; foreach($relate_comic_bestsale as $key => $value){ $i++;if($i==4){?>
                        <div class="offer-comic-list_comic_element_part2">
                            <a class="offer-comic-list_comic_element_part2_img" href="{{URL::to('/visit-comic/'.$value->comic_id)}}"><img src="{{URL::to('/public/uploads/comic/'.$value->comic_img)}}" alt=""></a>
                            <a href="#" class="offer-comic-list_comic_element_part2_name">{{$value->comic_name}}</a>
                        </div>
                        <?php }if($i==4){break;}} ?>
                    </div>
                </div>
            </div>
        
    </div>
@endforeach
</div>

<div class="container" style="margin-top: 50px;">
    <div class="author-sub">
        <div class="author-left">
            <div class="author-left_sub">
                <div class="author-left_sub_left">
                    ủng hộ tác giả
                </div>
                <div class="author-left_sub_right">
                @foreach($this_comic as $key => $value)
                    <p>"{{$value->comic_name}}" Tác giả: {{$value->customer_name}}</p>
                    @endforeach
                    <p class="author-left_sub_right_p">Tác phẩm</p>
                    <div class="marqee">
                        <div class="marquee-run">
                            <!-- 25 patch thui nhe -->
                            @foreach($allcomic_author as $key => $value)
                            <a href="{{URL::to('/visit-comic/'.$value->comic_id)}}">{{$value->comic_name}}</a>
                            @endforeach
                        </div>   
                    </div>
                    <p>Mới nhất: {{$newcomic_author->comic_name}}</p>
                </div>
            </div>
            <div class="comic-suggestion-list">
        <div class="comic-suggestion-comment">
            <div class="comic-suggestions">
                <div class="comic-suggestions_title">Có thể bạn cũng thích</div>
                <div class="comic-suggestions_comic">
                    <div class="row">
                    @foreach($relate_comic as $key=> $value)
                        <div class="col-2">
                            <a href="{{URL::to('/visit-comic/'.$value->comic_id)}}" class="comic-suggestions_comic_img">
                                <img src="{{URL::to('/public/uploads/comic/'.$value->comic_img)}}" alt="">
                                <p>Chapter X</p>
                            </a>
                            <a href="#">{{$value->comic_name}}</a>
                            <p class="comic-suggestions_comic_desc">{{$value->comic_desc}}</p>
                        </div>
                        @endforeach
                       
                    </div>  
                </div>
                <img src="{{URL::to('/public/frontend/img/page_works_stack_bg.png')}}" alt="" class="comic-suggestions_border">
            </div>
         
        </div>
      
       
    </div>
   



        </div>
        <div class="new-comic-list-andOffer">
            <div class="new-comic-list">
                <div class="new-comic-list_title">
                   <a class="new-comic-list_title1" href="#">Danh sach moi</a>
                   <a class="new-comic-list_title2" href="#">Luot doc</a>
                </div>
                <div class="new-comic-list_top">
                <?php $i=0; foreach($comic_bestview as $key => $value){ $i++; if($i == 1){ ?>
                    <div class="new-comic-list_top_img">
                        <a href="{{URL::to('/visit-comic/'.$value->comic_id)}}">
                            <img class="new-comic-list_top_img_rank" src="{{URL::to('/public/frontend/img/rank1.png')}}" alt="">
                            <img src="{{URL::to('/public/uploads/comic/'.$value->comic_img)}}" alt="">
                        </a>
                    </div>
                    <div class="new-comic-list_top_desc">
                        <a class="new-comic-list_top_name" href="{{URL::to('/visit-comic/'.$value->comic_id)}}">{{$value->comic_name}}</a>
                        <p>Lượt đọc: {{$value->comic_view}}</p>
                    </div>
                <?php }} ?> 
                </div>
                <?php $i=0; foreach($comic_bestview as $key => $value){ $i++; if($i >= 2){ ?>
                <div class="new-comic-list_second">
                    <div class="new-comic-list_second_stt1">{{$i}}</div>
                    <a href="{{URL::to('/visit-comic/'.$value->comic_id)}}">{{$value->comic_name}}</a>
                    <p>{{$value->comic_view}}</p>
                </div>
                <?php }if($i==3){break;}} ?>
                <?php $i=0; foreach($comic_bestview as $key => $value){ $i++; if($i >= 4){ ?>
                <div class="new-comic-list_second">
                    <div class="new-comic-list_second_stt2">{{$i}}</div>
                    <a href="{{URL::to('/visit-comic/'.$value->comic_id)}}">{{$value->comic_name}}</a>
                    <p>{{$value->comic_view}}</p>
                </div>
                <?php }} ?>
            </div>
          
        </div>
       
    </div>
    
</div>
<div class="container ">
<div class="user-comment">
                <div class="user-comment_menu">
                    <a href="#">BÌNH luận</a>
                </div>
                <div class="user-comment-pagination">
                    <div class="user-comment-pagination_left">
                    <?php $count=0; foreach($all_comment as $key => $value){$count++;}?>
                        Tất cả {{$count}} Bình luận
                    </div>
                    <!-- <div class="user-comment-pagination_right">
                        <a class="button_prev" href="#">Quay lại</a>
                        <a href="#">1</a>
                        <a href="#">2</a>
                        <a href="#">3</a>
                        <p>...</p>
                        <a href="#">98</a>
                        <a href="#">99</a>
                        <a href="#">100</a>
                        <a class="button_next" href="#">Tiếp</a>
                    </div> -->
                </div>
                <form action="{{URL::to('/add-comment')}}" method="POST" style="border-top: 1px solid #C1B6A9;display: flex; align-items: center;">
                @csrf
                @foreach($this_comic as $key => $comic)
                    <input type="hidden" name="comic_id" value="{{$comic->comic_id}}">
                    <input type="hidden" name="author_id" value="{{$comic->author_id_comic}}">
                    <input type="hidden" name="customer_id" value="{{Session::get('customer_id')}}">
                    <input type="hidden" name="comment_parent_id" value="0">
                @endforeach
                    <textarea name="comment" id="" style="outline:#F79056;resize: none;padding:20px;margin: 10px 0px 10px 20px;" cols="84" rows="5" placeholder="nhập bình luận của bạn"></textarea>
                    <button type="submit" style="background-color: #F79056; border:none; outline: none;color:#fff;padding: 10px 20px 10px 20px;border-radius: 4px; cursor:pointer;margin-left:20px;">Thêm bình luận</button>
                </form>
                <?php $max=0; ?>
                <?php foreach($all_comment as $key => $value){  ?>
                <?php if($value->comment_parent_id == 0 ){$max++;?>
                <div class="user-comment-element">
                    <div class="user-comment-element_left">
                        <img src="{{URL::to('/public/uploads/customer/'.$value->customer_avatar)}}" alt="">
                        <a href="#">{{$value->customer_name}}</a>
                    </div>
                    <div class="user-comment-element_right">
                        <div class="user-comment-element_right_top">
                            {{$value->comment}}
                        </div>
                        <div class="user-comment-element_right_bot">
                           
                            <a class="open_rep_comment" style="cursor: pointer;">trả lời
                            <p class="an_cai_nay date--comment"><?php echo date('F,m.Y H:I:S', $value->comment_date) ?></p>
                                <div id="user--rep--comment" class="user--rep--comment hidden">
                                    <form id="form_rep_comment" action="{{URL::to('/add-comment')}}" method="POST" style="display: flex; align-items: center;">
                                    @csrf
                                    @foreach($this_comic as $key => $comic)
                                        <input type="hidden" name="comic_id" value="{{$comic->comic_id}}">
                                        <input type="hidden" name="author_id" value="{{$comic->author_id_comic}}">
                                        <input type="hidden" name="customer_id" value="{{Session::get('customer_id')}}">
                                        <input type="hidden" name="comment_parent_id" value="{{$value->comment_id}}">

                                    @endforeach
                                        <textarea style="resize:none; border:1px solid #F79056;outline:none;" name="comment" id="text_rep" cols="65" rows="1" placeholder="nhập bình luận của bạn"></textarea>
                                        <button id="submit_rep_comment">Trả lời bình luận</button>
                                    </form>
                                </div>
                            </a>
                        </div>
                    </div>
                    
                </div>
                <?php }?>
                <?php foreach($all_comment as $key => $value1){  ?>
                <?php if($value1->comment_parent_id == $value->comment_id ){$max++;?>
                <div class="user-comment-element" style="width: 83.8%; margin-left:13.5%;">
                    <div class="user-comment-element_left">
                        <img src="{{URL::to('/public/uploads/customer/'.$value1->customer_avatar)}}" alt="">
                        <a href="#">{{$value1->customer_name}}</a>
                    </div>
                    <div class="user-comment-element_right">
                        <div class="user-comment-element_right_top">
                            Trả lời {{$value->customer_name}}: {{$value1->comment}}
                        </div>
                        <div class="user-comment-element_right_bot">
                           
                            <a class="open_rep_comment" style="cursor: pointer;">trả lời
                            <p class="an_cai_nay date--comment"><?php echo date('F,m.Y H:I:S', $value1->comment_date) ?></p>
                                <div id="user--rep--comment" class="user--rep--comment hidden">
                                    <form id="form_rep_comment" action="{{URL::to('/add-comment')}}" method="POST" style="display: flex; align-items: center;">
                                    @csrf
                                    @foreach($this_comic as $key => $comic)
                                        <input type="hidden" name="comic_id" value="{{$comic->comic_id}}">
                                        <input type="hidden" name="author_id" value="{{$comic->author_id_comic}}">
                                        <input type="hidden" name="customer_id" value="{{Session::get('customer_id')}}">
                                        <input type="hidden" name="comment_parent_id" value="{{$value1->comment_id}}">

                                    @endforeach
                                        <textarea style="resize:none; border:1px solid #F79056;outline:none;" name="comment" id="text_rep" cols="53" rows="1" placeholder="nhập bình luận của bạn"></textarea>
                                        <button id="submit_rep_comment">Trả lời bình luận</button>
                                    </form>
                                </div>
                            </a>
                        </div>
                    </div>
                    
                </div>
                <?php }?>
               <?php } ?>
               <?php if($max == $count){break;}} ?>
            </div>
</div>

<!-- BODY -->


    <div class="container-fluid">
        <section class="footer">
            <div class="footer-top">
            </div>
            <div class="footer-body">
                <div class="footer-body_QR">
                    <img src="{{URL::to('/public/frontend/img/ac_qr_img.jpg')}}" alt="">
                    <p>Ứng dụng khách</p>
                    <p>Tencent</p>
                    <p>Animation</p>
                </div>
                <div class="footer-body_QR">
                    <img src="{{URL::to('/public/frontend/img/ac_wx_img.jpg')}}" alt="">
                    <p>Tencent</p>
                    <p>Animation Wechat</p>
                </div>
                <ul>
                    <li><a href="#">Sơ đồ trang web</a></li>
                    <li><a href="#">Trung tâm trợ giúp</a></li>
                    <li><a href="#">Thỏa thuận dịch vụ</a></li>
                    <li><a href="#">Blog chính thức</a></li>
                    <li><a href="#">Phản hồi vi phạm</a></li>
                    <li><a href="#">Hợp tác kinh doanh</a></li>
                    <li>Liên hệ: <a href="#">ac.qq.com</a></li>
                </ul>
                <pre>
                    ICP Quảng Đông số 16117015-1 Quảng Đông Wangwen (2019) Số 2460-563
                    Bản quyền © 1998-2021 Tencent. Mọi quyền được bảo lưu
                    Thâm Quyến Tencent Animation Co., Ltd. Mọi quyền được bảo lưu
                </pre>
            </div>
        </section>
    </div>

<script>
    
            $('.rating').mouseover(function () {
                resetStarColors();
                var currentIndex = parseInt($(this).data('index'));
                setStars(currentIndex);
            });

            $('.rating').mouseleave(function () {
                resetStarColors();
                var rating = $(this).data("rating");
                setStars(rating);
              
              
            });
            function setStars(max) {
            for (var i=0; i < max; i++)
                $('.rating:eq('+i+')').css('color', '#FF9A6A');
        }

        function resetStarColors() {
            $('.rating').css('color', '#E8E8E8');
        }
</script>
@endsection