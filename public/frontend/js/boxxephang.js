var mo = document.getElementsByClassName('hop-rank--title--element');
var caicanmo = document.getElementsByClassName('hop-rank--body');
var vitri = 0;
caiduocmo(vitri);
for(let j =0 ;j<mo.length;j++){
    mo[j].addEventListener('mouseenter', function(){
        vitri = j;
        caiduocmo(vitri);
    });
}
function caiduocmo(vitri){
    for(let i =0 ;i < caicanmo.length ; i++){
        caicanmo[i].classList.add('hidden');
        mo[i].classList.remove('bor-bot-cam');
    }
    caicanmo[vitri].classList.remove('hidden');
    mo[vitri].classList.add('bor-bot-cam');
}