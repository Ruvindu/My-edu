function dp_config() {
	
	var w = window.innerWidth;
	
	if (w<700) {
		/*  Mobile view */

	/* Change user */ 
      document.getElementById("user").classList.add("mini_user");
      document.getElementById("dp").classList.add("mini_dp");
      document.getElementById("display_name").classList.add("mini_display_name");
      document.getElementById("display_other").classList.add("mini_display_other");

	}
	else{
		/*  PC view */

		/* Change user */ 
        document.getElementById("user").classList.add("user");
        document.getElementById("dp").classList.add("dp");
        document.getElementById("display_name").classList.add("display_name");
        document.getElementById("display_other").classList.add("display_other");
	}



}