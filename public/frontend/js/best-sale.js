$(document).ready(function(){
    $(".comic-best-sale_body_cate1").hover(function(){
        $('.comic-best-sale_body_cate_page1').removeClass('hidden');
        $('.comic-best-sale_body_cate1').addClass('active-primary');
        $('.comic-best-sale_body_cate_page2').addClass('hidden');
        $('.comic-best-sale_body_cate2').removeClass('active-primary');
    });
    $(".comic-best-sale_body_cate2").hover(function(){
        $('.comic-best-sale_body_cate_page2').removeClass('hidden');
        $('.comic-best-sale_body_cate2').addClass('active-primary');
        $('.comic-best-sale_body_cate_page1').addClass('hidden');
        $('.comic-best-sale_body_cate1').removeClass('active-primary');
    });
});