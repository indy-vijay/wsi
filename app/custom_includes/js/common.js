jQuery(function(){
		jQuery("#user-register").validate({
			rules: {
					first_name: "required",
					last_name: "required",
					"address_1" : "required",
					"city"     : "required",
					"state"  : "required",
					"zip"    : "required",
					"email"  : "required"
			},
			messages: {
				first_name: "Please enter your firstname",
				last_name: "Please enter your lastname",
				"address_1" : "Please enter your address",
				"city"   : "Please enter your city",
				"state"  : "Please enter your state",
				"zip"     : "Please enter your zip",
				"email"   : "Please enter your email"
			}
		})	
})