//var span = document.getElementById('span');
var body = document.getElementById('body');
var footer = document.getElementById('footer');
var footerbottom = 0;
var bodyheight = 0;
var windowheight = 0;
    
function update() {

    bodyheight = body.clientHeight;
    windowheight = window.innerHeight;
    
    //span.innerHTML = window.innerWidth + ' x ' + windowheight + 'body ' + bodyheight;


if ((windowheight-bodyheight)<100){
        footerbottom = windowheight - bodyheight - 100;
    }
    else {
    footerbottom = 0; 
    } 
    
    //footerbottom = 0;
    footer.style.bottom = footerbottom + "px"

    }
    
update();

window.addEventListener('resize', update);