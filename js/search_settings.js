function search_config() {
	
	var w = window.innerWidth;
	
	if (w<700) {
		/*  Mobile view */

	 /* Change search*/
      document.getElementById("search").classList.add("mini_search");
      document.getElementById("s_input").classList.add("mini_search_input");
      document.getElementById("s_btn").classList.add("mini_search_btn");

	}
	else{
		/*  PC view */

		 /* Change search*/
        document.getElementById("search").classList.add("search");
        document.getElementById("s_input").classList.add("search_input");
        document.getElementById("s_btn").classList.add("search_btn");
         
	}



}