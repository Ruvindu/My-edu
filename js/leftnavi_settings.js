function leftnavi_config() {
	
	var w = window.innerWidth;
	
	if (w<700) {
		/*  Mobile view */

	 /* Change left navi*/
      document.getElementById("left_navi").classList.add("mini_left_navi");

	}
	else{
		/*  PC view */

		 /* Change left navi*/
        document.getElementById("left_navi").classList.add("left_navi");
         
	}



}