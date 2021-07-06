let menu_user = document.querySelector('.user-comment_menu');
let offer_comic_list = document.querySelector('.offer-comic-list');

let bodyscroll = window.addEventListener("scroll", function(event) {
    var body_scroll_y = this.scrollY;
    if(body_scroll_y >2387){
        menu_user.classList.add('user-comment-menu-fix');
    }else{
        menu_user.classList.remove('user-comment-menu-fix');
    }
    if(body_scroll_y >2448){
        offer_comic_list.classList.add('offer-comic-fix');
    }else{
        offer_comic_list.classList.remove('offer-comic-fix');
    }
});
