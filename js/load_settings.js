/* loading page center */

 function resizing(){
            var h = window.innerHeight;
            var w = window.innerWidth;
            var mt = (h/2)-180 + "px"; 
            var ml = (w/2)-200 + "px";
            document.getElementById("load").style.marginTop = mt;
            document.getElementById("load").style.marginLeft = ml;
}
