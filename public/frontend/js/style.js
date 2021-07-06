let slidePosition = 0;
const slides = document.getElementsByClassName('carousel_item');
const linesBtnActive = document.getElementsByClassName('line-btn-active');
const totalSlides = slides.length;
autoslide();
var timer;
var timer1;
function autoslide(){ 
    timer1 = setTimeout(moveToNextSlide, 5000)
    timer = setTimeout(autoslide, 5000);
}
$(document).ready(function(){
    $(".item-of-banner").hover(function(){
      clearTimeout(timer);
      clearTimeout(timer1);
      linesBtnActive[slidePosition].classList.add('hidden');
    });
    $(".item-of-banner").mouseleave(function(){
        linesBtnActive[slidePosition].classList.remove('hidden');
        autoslide();
    });
});

document.getElementById('line-btn2').addEventListener("click", function(){
    slidePosition = 1;
    updateSlidePosition();
});
document.getElementById('line-btn3').addEventListener("click", function(){
    slidePosition = 2;
    updateSlidePosition();
});
document.getElementById('line-btn1').addEventListener("click", function(){
    slidePosition = 0;
    updateSlidePosition();
});
document.getElementById('btn-next').addEventListener("click", function(){
    moveToNextSlide();
});
document.getElementById('btn-prev').addEventListener("click", function(){
    moveToPrevSlide();
});
function updateSlidePosition(){
    for(let slide of slides){
        slide.classList.add("hidden");
    }
    for(let lineBtn of linesBtnActive){
        lineBtn.classList.add("hidden");
    }
    slides[slidePosition].classList.remove('hidden');
    linesBtnActive[slidePosition].classList.remove('hidden');
}
function  moveToNextSlide(){
    if(slidePosition == totalSlides-1){
        slidePosition = 0;
    }else{
        slidePosition++;
    }
  
    updateSlidePosition();
}
function  moveToPrevSlide(){
    if(slidePosition == 0){
        slidePosition = totalSlides - 1;
       
    }else{
        slidePosition--;
    }
    updateSlidePosition();
}



               