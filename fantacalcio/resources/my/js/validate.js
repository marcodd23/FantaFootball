function isValidEmail(emailAddress) {
	    var pattern = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

	    var pattern = new RegExp(/^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i);
	    return pattern.test(emailAddress);
	};


/* CONTACT FROM */

jQuery(function() {
    if(jQuery("#subscription_form").length){

        /*$('#name').prop('minlength', 2);
        $('#comments').prop('minlength', 10);*/

        // show a simple loading indicator
        var loader = jQuery('<div id="loader"><img src="http://localhost/fantacalcio/resources/superweb/images/loading.gif" alt="loading..." /></div>')
        .css({
          position: "relative", 
          top: "1em", 
          left: "25em", 
          display: "inline"
      })
        .appendTo("body")
        .hide();
        jQuery().ajaxStart(function() {
          loader.show();
      }).ajaxStop(function() {
          loader.hide();
      }).ajaxError(function(a, b, e) {
          throw e;
      });

      var v = jQuery("#subscription_form").validate({
          // debug: true,
          errorPlacement: function(error, element) {
            error.insertBefore( element );
        },
        submitHandler: function(form) {
            form.submit();
        },
        rules: {
            name: {
                required: true,
                minlength: 1
            },
            surname: {
                required: true,
                minlength: 1
            },
            email: {
                required: true,
                email: true
            },
            username: {
                required: true,
                minlength: 6,
            },
            password: {
                required: true,
                minlength: 8,
            }
        }
    });
  }

});
jQuery(function() {
    if(jQuery("#update_form").length){

        /*$('#name').prop('minlength', 2);
        $('#comments').prop('minlength', 10);*/

        // show a simple loading indicator
        var loader = jQuery('<div id="loader"><img src="http://localhost/fantacalcio/resources/superweb/images/loading.gif" alt="loading..." /></div>')
        .css({
          position: "relative", 
          top: "1em", 
          left: "25em", 
          display: "inline"
      })
        .appendTo("body")
        .hide();
        jQuery().ajaxStart(function() {
          loader.show();
      }).ajaxStop(function() {
          loader.hide();
      }).ajaxError(function(a, b, e) {
          throw e;
      });

      var v = jQuery("#update_form").validate({
          // debug: true,
          errorPlacement: function(error, element) {
            error.insertBefore( element );
        },
        submitHandler: function(form) {
            form.submit();
        },
        rules: {
            name: {
                required: true,
                minlength: 1
            },
            surname: {
                required: true,
                minlength: 1
            },
            email: {
                required: true,
                email: true
            },
            username: {
                required: true,
                minlength: 6
            },
            password: {
                required: false,
                minlength: 8
            }
        }
    });
  }

});
jQuery(function() {
    if(jQuery("#retrieve_form").length){

        /*$('#name').prop('minlength', 2);
        $('#comments').prop('minlength', 10);*/

        // show a simple loading indicator
        var loader = jQuery('<div id="loader"><img src="http://localhost/fantacalcio/resources/superweb/images/loading.gif" alt="loading..." /></div>')
        .css({
          position: "relative", 
          top: "1em", 
          left: "25em", 
          display: "inline"
      })
        .appendTo("body")
        .hide();
        jQuery().ajaxStart(function() {
          loader.show();
      }).ajaxStop(function() {
          loader.hide();
      }).ajaxError(function(a, b, e) {
          throw e;
      });

      var v = jQuery("#retrieve_form").validate({
          // debug: true,
          errorPlacement: function(error, element) {
            error.insertBefore( element );
        },
        submitHandler: function(form) {
            form.submit();
        },
        rules: {
            email: {
                required: true,
                email: true
            }
        }
    });
  }

});
jQuery(function() {
    if(jQuery("#league_form").length){

        /*$('#name').prop('minlength', 2);
        $('#comments').prop('minlength', 10);*/

        // show a simple loading indicator
        var loader = jQuery('<div id="loader"><img src="http://localhost/fantacalcio/resources/superweb/images/loading.gif" alt="loading..." /></div>')
        .css({
          position: "relative", 
          top: "1em", 
          left: "25em", 
          display: "inline"
      })
        .appendTo("body")
        .hide();
        jQuery().ajaxStart(function() {
          loader.show();
      }).ajaxStop(function() {
          loader.hide();
      }).ajaxError(function(a, b, e) {
          throw e;
      });

      var v = jQuery("#league_form").validate({
          // debug: true,
          errorPlacement: function(error, element) {
            error.insertBefore( element );
        },
        submitHandler: function(form) {
            form.submit();
        },
        rules: {
        	 name: {
                 required: true
             },
             teams:{
            	 number:true,
            	 min:2
             },
            gf: {
                number: true
            },
            gs: {
                number: true
            },
            assist: {
                number: true
            },
            amm: {
                number: true
            },
            esp: {
                number: true
            },
            ag: {
                number: true
            },
            rp: {
                number: true
            },
            rs: {
                number: true
            },
            gv: {
                number: true,
            },
            gp: {
                number: true
            }
        }
    });
  }

});
jQuery(function() {
	jQuery.validator.addMethod("complete",function(element,value){
		var rosa=$("#rosa_text").val()
		//alert(rosa);
		var rosa_array=rosa.split(",");//value.split(",");
		//alert(value);
		//alert(rosa_array.length);
		return (rosa_array.length==26);
	},"La rosa deve essere completa");
    if(jQuery("#team_form").length){

        /*$('#name').prop('minlength', 2);
        $('#comments').prop('minlength', 10);*/

        // show a simple loading indicator
        var loader = jQuery('<div id="loader"><img src="http://localhost/fantacalcio/resources/superweb/images/loading.gif" alt="loading..." /></div>')
        .css({
          position: "relative", 
          top: "1em", 
          left: "25em", 
          display: "inline"
      })
        .appendTo("body")
        .hide();
        jQuery().ajaxStart(function() {
          loader.show();
      }).ajaxStop(function() {
          loader.hide();
      }).ajaxError(function(a, b, e) {
          throw e;
      });

      var v = jQuery("#team_form").validate({
          // debug: true,
          errorPlacement: function(error, element) {
            error.insertBefore( element );
        },
        submitHandler: function(form,event) {
        	//event.preventDefault();
        	 form.submit();
        },
        onfocusot:false,
        onkeyup:false,
        onclick:false,
        
        rules: {
            name: {
                required: true,
                minlength: 1
            },
            rosa:{
            	//required: true,
            	complete:true
            }
        }
    });
  }

});
jQuery(function() {
	jQuery.validator.addMethod("complete",function(element,value){
		var rosa=$("#rosa_text").val()
		var riserve=$("#riserve_text").val()
		//alert("valido");
		var rosa_array=rosa.split(",");//value.split(",");
		var riserve_array=riserve.split(",");//value.split(",");
		
		//alert(value);
		//alert(rosa_array.length);
		return (rosa_array.length==13&&riserve_array.length==9);
	},"La formazione deve essere completa");
    if(jQuery("#formation_form").length){

        /*$('#name').prop('minlength', 2);
        $('#comments').prop('minlength', 10);*/

        // show a simple loading indicator
        var loader = jQuery('<div id="loader"><img src="http://localhost/fantacalcio/resources/superweb/images/loading.gif" alt="loading..." /></div>')
        .css({
          position: "relative", 
          top: "1em", 
          left: "25em", 
          display: "inline"
      })
        .appendTo("body")
        .hide();
        jQuery().ajaxStart(function() {
          loader.show();
      }).ajaxStop(function() {
          loader.hide();
      }).ajaxError(function(a, b, e) {
          throw e;
      });

      var v = jQuery("#formation_form").validate({
          // debug: true,
          errorPlacement: function(error, element) {
            error.insertBefore( element );
        },
        submitHandler: function(form,event) {
    		//alert("valido");
        	//event.preventDefault();
        	form.submit();
        },
        onfocusot:false,
        onkeyup:false,
        onclick:false,
        
        rules: {
            name: {
                required: true,
                minlength: 1
            },
            rosa_text:{
            	//required: true,
            	complete:true
            }
        }
    });
  }

});
