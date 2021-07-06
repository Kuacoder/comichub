window.onload = slick;
function slick(){
    $('.slider').slick({
        dots: true,
        infinite: true,
        speed: 1000,
        slidesToShow: 8,
        slidesToScroll: 8,
        prevArrow: '<button class="slick-btn-prev"><img src="/public/frontend/img/right-chevron.svg" alt=""></button>',
        nextArrow: '<button class="slick-btn-next"><img src="/public/frontend/img/right-chevron.svg" alt=""></button>',
        responsive: [
          {
            breakpoint: 1024,
            settings: {
              slidesToShow: 3,
              slidesToScroll: 3,
              infinite: true,
              dots: true
            }
          },
          {
            breakpoint: 600,
            settings: {
              slidesToShow: 2,
              slidesToScroll: 2
            }
          },
          {
            breakpoint: 480,
            settings: {
              slidesToShow: 1,
              slidesToScroll: 1
            }
          }
        ]
})};