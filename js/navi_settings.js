function nav_config(){
  var w = window.innerWidth;
  
  if(w<700){

    /*  Mobile view */

    /* Change navigation */
    document.getElementById("navigation").classList.add("mini_nav");
        for (var i = 0 ; i < 5; i++) {
          document.getElementById("item"+i).classList.add("mini_nav_itm");
          document.getElementById("link"+i).classList.add("mini_nav_link");
	}
}

else{
       
        /*  PC view */

       /* Change navigation */
        document.getElementById("navigation").classList.add("nav");
        for (var i = 0 ; i < 5; i++) {
          document.getElementById("item"+i).classList.add("navi_item");
          document.getElementById("link"+i).classList.add("navi_link");
        }
	}
}