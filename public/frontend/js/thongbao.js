var close__thongbao = document.getElementById('close__thongbao');
if(close__thongbao != null){
    let popupthongbao = document.getElementById('popupthongbao');
    close__thongbao.addEventListener('click', function(){
        popupthongbao.classList.add('hidden');
    });
    setTimeout(function(){popupthongbao.classList.add('hidden')}, 2000);
}
var close__thongbao1 = document.getElementById('close__thongbao1');
if(close__thongbao1 != null){
    let popupthongbao1 = document.getElementById('popupthongbao1');
    close__thongbao1.addEventListener('click', function(){
        popupthongbao1.classList.add('hidden');
    });
    setTimeout(function(){popupthongbao1.classList.add('hidden')}, 2000);
}
