let canvas = document.querySelector('canvas');
let mark_value = document.getElementsByClassName('comic-info-left_bot_chart_number_value');
let xGrid = 8;
let yGrid = 8;
let cellSize = 8;
let ctx = canvas.getContext('2d');

let data={
    "arr0": mark_value[0].value,
    "arr1": mark_value[1].value,
    "arr2": mark_value[2].value,
    "arr3": mark_value[3].value,
    "arr4": mark_value[4].value,
    "arr5": mark_value[5].value,
    "arr6": mark_value[6].value,
    "arr7": mark_value[7].value,
}

const entries=Object.entries(data);

function drawGrids(){
    ctx.beginPath();
    while(xGrid<canvas.height){
        ctx.moveTo(0,xGrid);
        ctx.lineTo(canvas.width, xGrid);
        xGrid+=cellSize;
    }
    while(yGrid<canvas.width){
        ctx.moveTo(yGrid,0);
        ctx.lineTo(yGrid, canvas.height);
        yGrid+=cellSize;
    }
    ctx.strokeStyle="gray"
    ctx.stroke();
}
function blocks(count){
    return count*cellSize;
}
function drawAxis(){
    let yPlot = 15;
    let pop = 0;
    ctx.beginPath();
    ctx.strokeStyle='black';
    ctx.moveTo(blocks(0),blocks(0));
    ctx.lineTo(blocks(0),blocks(15));
    ctx.lineTo(blocks(32),blocks(15));
    ctx.moveTo(blocks(4),blocks(10));
    for(let i =1; i<=10; i++)
    {
        ctx.strokeText(pop,blocks(0),blocks(yPlot));
        yPlot-=3;
        pop+=500;
    }
    ctx.stroke();
}
function drawChart(){
    ctx.beginPath();
    ctx.strokeStyle = 'black';
    ctx.moveTo(blocks(0),blocks(15));
    var xPlot = 4;

    for(const[icon, value] of entries){
        var valueBlock=value/100;
        ctx.strokeStyle = '#FA9144';
        ctx.lineTo(blocks(xPlot),blocks(15-valueBlock));
        ctx.arc(blocks(xPlot),blocks(15-valueBlock),2,0,Math.PI*2,true);
        xPlot+=4;
    }
    
    ctx.stroke();
}
drawChart();

