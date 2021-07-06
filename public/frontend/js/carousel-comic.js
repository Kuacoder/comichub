let comicslidePosition = 0;
const comicslides = document.getElementsByClassName('comic-carousel_item');
const comicslidesdots = document.getElementsByClassName('comic-carousel_dots_dot');
const comictotalSlides = comicslides.length;
const comictotalslidesdots = comicslidesdots.length;
comicautoslide();
function comicautoslide(){ 
    timer1 = setTimeout(comicmoveToNextSlide, 3000)
    timer = setTimeout(comicautoslide, 5000);
}

document.getElementById('comic-carousel_button-next').addEventListener("click", function(){
    comicmoveToNextSlide();
});
document.getElementById('comic-carousel_button-prev').addEventListener("click", function(){
    comicmoveToPrevSlide();
});
for(let dot = 0; dot< comictotalslidesdots; dot++){
    comicslidesdots[dot].addEventListener("click", function(){
        comicslidesdots[dot].classList.add("dot-active");
        comicslidePosition = dot;
        comicupdateSlidePosition();
    });
}
function comicupdateSlidePosition(){
    for(let comicslide of comicslides){
        comicslide.classList.add("hidden");
    }
    for(let comicslidedot of comicslidesdots){
        comicslidedot.classList.remove("dot-active");
    }
    comicslides[comicslidePosition].classList.remove("hidden");
    comicslidesdots[comicslidePosition].classList.add("dot-active");
}
function  comicmoveToNextSlide(){
    if(comicslidePosition == comictotalSlides-1){
        comicslidePosition = 0;
    }else{
        comicslidePosition++;
    }
  
    comicupdateSlidePosition();
}
function  comicmoveToPrevSlide(){
    if(comicslidePosition == 0){
        comicslidePosition = comictotalSlides - 1;
       
    }else{
        comicslidePosition--;
    }
    comicupdateSlidePosition();
}