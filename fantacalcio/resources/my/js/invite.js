$(document).ready(function(){
	$( "#dialog" ).dialog({
	    autoOpen: false,
	    modal:true,
	    position: { my: "center top", at: "top top+250", of: window }
	  });
	 $("#invited").click(function(event){
		  event.preventDefault();
	  });
});

function openDialog(team_number){
    	//event.preventDefault();
    	$("#team_number").val(team_number);
        $( "#email" ).autocomplete({
            source: availableEmails,
            autoFocus: true
          });
      $( "#dialog" ).dialog( "open" );
}

  function validateEmail(){
		event.preventDefault();
	  var email=$("#email").val();
	  var valid=false;
	  if(isValidEmail(email)){
		  for(var i=0;i<availableEmails.length;i++)
			  if(availableEmails[i]==email)
				  valid=true;
	  }
	  if(valid){
		  sendMailAjax();
	  }
	  else{
		  $("#email_error").html("Devi scegliere un indirizzo email tra quelli suggeriti");
	  }
  }
  function sendMailAjax(){
	//alert("porco dio");
	var dataForm=$("#email_form").serialize();
		$("#dialog").dialog("close");
		  $("#loading").show();

	   $.ajax({
		  url:"http://localhost/fantacalcio/user/sendInvite.php",
		  type:"POST",
		  data:dataForm,
		  dataType:"json",
		  success:function(data){
			  $("#loading").hide();
			  var type="";
			  var text="";
			  var html="";
			  if(!data.error){
				  type+="alert-success";
				  text+='<h4><strong>'+data.message+'</strong></h4> Il tuo invito è stato inviato correttamente via mail</h4>';
				  var team_number=$("#team_number").val();
				  $("#"+team_number).html('<a title="Rimuovi invito" href="removeInvite.php?id='+data.id_invito+'" id="opener" class="btn btn-inverse tips"><i class="icon-ccw "></i></a>');
				 //alert(data.username);
				  $("#"+team_number+"_img").attr("src","../resources/my/images/icon-user-invited.jpg");
				  $("#"+team_number+"_username").html(data.username);
				  $("#invited").click(function(event){
					  event.preventDefault();
				  });
			  }
			  else{
				  type+="alert-error";
				  text+='<h4><strong>Attenzione<strong>: </h4>'+data.message;
			  }
		 	 html+='<div style="margin-right: 4px;" class="alert alert-block '+type+'"><button type="button" class="close" data-dismiss="alert">&times;</button>'+text+ '</div>';
		  $("#result").html(html);
			  //alert(data);
		  },
		  error: function(xhr, status, error) {
			  $("#loading").hide();

  			var err = eval("(" + xhr.responseText + ")");
  			alert(err.Message);
			}
	  });
  }