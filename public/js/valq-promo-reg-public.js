(function( $ ) {
	'use strict';

	/**
	 * All of the code for your public-facing JavaScript source
	 * should reside in this file.
	 *
	 * Note: It has been assumed you will write jQuery code here, so the
	 * $ function reference has been prepared for usage within the scope
	 * of this function.
	 *
	 * This enables you to define handlers, for when the DOM is ready:
	 *
	 * $(function() {
	 *
	 * });
	 *
	 * When the window is loaded:
	 *
	 * $( window ).load(function() {
	 *
	 * });
	 *
	 * ...and/or other possibilities.
	 *
	 * Ideally, it is not considered best practise to attach more than a
	 * single DOM-ready or window-load handler for a particular page.
	 * Although scripts in the WordPress core, Plugins and Themes may be
	 * practising this, we should strive to set a better example in our own work.
	 */

	 $( "document" ).ready( function() {

	 	$( "select#valq-promo-reg_country" ).select2();
	 	$( "select#valq-promo-reg_size" ).select2( { minimumResultsForSearch: -1 } );
	 	$( "select#valq-promo-reg_industry" ).select2();

 	    $.validator.addMethod("CheckPhoneNumber", function(phone_number, element) {
 			phone_number = phone_number.replace(/\s+/g, "");
 			return phone_number.match(/^(?=.*[0-9])[- +()0-9]+$/);
 		}, "Please specify a valid phone number");

	    $.validator.addMethod("CheckExistingEmail", function (value, element) {
	    	var emails = PROMO_SETTINGS.existing_emails.split(', ');
	    	is_blocked = false;

	    	for(i = 0; i< emails.length; i++){
	    		if(value == emails[i] ){
	    			is_blocked = true;
	    			break;
	    		}
	    	}

	    	if(is_blocked)
	    		return false;
	    	else
	    		return true;
		}, PROMO_SETTINGS.existing_error);

 		$('form#valq-promo-reg-form').validate({
 			onkeyup: false,
	        rules: {
	        	"valq-promo-reg_fname": {
	        		required: true
	        	},
	        	"valq-promo-reg_lname": {
	        		required: true
	        	},
	        	"valq-promo-reg_phone": {
	        		required: true,
	        		CheckPhoneNumber: true
	        	},
	        	"valq-promo-reg_company": {
	        		required: true
	        	},
	        	"valq-promo-reg_country": {
	        		required: true
	        	},
	        	"valq-promo-reg_size": {
	        		required: true
	        	},
	        	"valq-promo-reg_industry": {
	        		required: true
	        	},
	            "valq-promo-reg_email": {
	                required: true,
	                email: true,
	                CheckExistingEmail: true,
					remote: {
						url: "https://api.visualbi.com/domain-validation/",
						type: "post",
						data: {
							email: function() {
								return $( "#valq-promo-reg_email" ).val();
							}
						}
					}
	            }
	        },
            submitHandler: function () {
    			var fn = $("form#valq-promo-reg-form input#valq-promo-reg_fname").val();
    			var ln = $("form#valq-promo-reg-form input#valq-promo-reg_lname").val();
    			var em = $("form#valq-promo-reg-form input#valq-promo-reg_email").val();
    			var ph = $("form#valq-promo-reg-form input#valq-promo-reg_phone").val();
    			var cm = $("form#valq-promo-reg-form input#valq-promo-reg_company").val();
    			var cn = $("form#valq-promo-reg-form select#valq-promo-reg_country").val();
    			var sz = $("form#valq-promo-reg-form select#valq-promo-reg_size").val();
    			var id = $("form#valq-promo-reg-form select#valq-promo-reg_industry").val();
    			
    			var pd = $("form#valq-promo-reg-form input#valq-promo-reg_product_id").val();
    			var pc = $("form#valq-promo-reg-form input#valq-promo-reg_promo_code").val();

    			var pn = $("form#valq-promo-reg-form input#valq-promo-reg_hub_pagename").val();
    			var pu = $("form#valq-promo-reg-form input#valq-promo-reg_hub_pageurl").val();
    			var hs = $("form#valq-promo-reg-form input#valq-promo-reg_hub_utk").val();
    			var ip = $("form#valq-promo-reg-form input#valq-promo-reg_hub_ipaddr").val();

    			var ua = $("form#valq-promo-reg-form input#valq-promo-reg_useragent").val();

    			var data = {
    			  	action: 'valq_promo_reg_create_order',
    			  	security: PROMO_SETTINGS.security_token,
    			  	fname: fn,
    			  	lname: ln,
    			 	email: em,
    			  	phone: ph,
    			  	company: cm,
    			  	country: cn,
    			  	size: sz,
    			  	industry: id,
    			  	product_id: pd,
    			  	promo_code: pc,
    			  	pagename: pn,
    			  	pageurl: pu,
    			  	hubspotutk: hs,
    			  	ipaddr: ip,
    			  	useragent: ua
    			};

    			console.log(data);

    			var block_config = {
    				message:'<h3>Just a moment...</h3>',
    				css: { 
    			        padding:        '20px 0px', 
    			        margin:         0, 
    			        width:          '80%', 
    			        top:            '40%', 
    			        left:           '10%', 
    			        textAlign:      'center', 
    			        color:          '#fff', 
    			        border:         'none', 
    			        backgroundColor:'rgba(255,255,255,0)', 
    			        cursor:         'wait' 
    			    },
    			    overlayCSS:  { 
    		            backgroundColor: '#fff', 
    		            opacity:         0.6, 
    		            cursor:          'wait' 
    		        },
    			};

    			$('div.valq-promo-reg-container').block(block_config);

    		    $.post(PROMO_SETTINGS.ajax_url, data, function(response){
                	if(response.message == "completed"){
                		$('div.valq-promo-reg-container').html('<div style="text-align:center;"><h3><strong>Thank you for your registration.</strong></h3><p>You will be receiving an email shortly with further instructions.</p><br><br><p>Feel free to reach out to us at <a href="mailto:support@valq.com">support@valq.com</a> for any help.</p></div>');
                	}else if(response.message == "workspace_exists"){
                		$('div#valq-promo-reg_error').html('Workspace name exists. Please try another name.');
                	}else{
                		$('div#valq-promo-reg_error').html('Form Submission Failed. Please try Again.');
                	}
                	$('div.valq-promo-reg-container').unblock();
                });		
            }
        });
	 });

})( jQuery );
