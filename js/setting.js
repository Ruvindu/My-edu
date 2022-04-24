

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

    /* Change user */ 
      document.getElementById("user").classList.add("mini_user");
      document.getElementById("dp").classList.add("mini_dp");
      document.getElementById("display_name").classList.add("mini_display_name");
      document.getElementById("display_other").classList.add("mini_display_other");

    /* Change search*/
      document.getElementById("search").classList.add("mini_search");
      document.getElementById("s_input").classList.add("mini_search_input");
      document.getElementById("s_btn").classList.add("mini_search_btn");
          

     /* Change left navi*/
      document.getElementById("left_navi").classList.add("mini_left_navi");
  }
    else{
       
        /*  PC view */

       /* Change navigation */
        document.getElementById("navigation").classList.add("nav");
        for (var i = 0 ; i < 5; i++) {
          document.getElementById("item"+i).classList.add("navi_item");
          document.getElementById("link"+i).classList.add("navi_link");
        }

        /* Change user */ 
        document.getElementById("user").classList.add("user");
        document.getElementById("dp").classList.add("dp");
        document.getElementById("display_name").classList.add("display_name");
        document.getElementById("display_other").classList.add("display_other");


         /* Change search*/
        document.getElementById("search").classList.add("search");
        document.getElementById("s_input").classList.add("search_input");
        document.getElementById("s_btn").classList.add("search_btn");
         

        /* Change left navi*/
        document.getElementById("left_navi").classList.add("left_navi");
    }
}