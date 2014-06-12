<?php
include '../include/template2.inc.php';
include '../include/auth.inc.php';

checkAuthorization("user/acceptInvite.php");
if(isset($_GET['id'])){
	$code=$_GET['id'];
	$username=$_SESSION['user'];
	$result=mysql_query("SELECT inviti.id, inviti.invitato, inviti.lega 
			FROM inviti JOIN utenti ON (inviti.invitato=utenti.id)
			 WHERE codice='{$code}' AND utenti.username='{$username}'");
	if(mysql_num_rows($result)==0){
		header("Location:../error.php?code=500");
	}
	else{
		$invito=mysql_fetch_assoc($result);
		$invito_id=$invito['id'];
		$invitato=$invito['invitato'];
		$lega=$invito['lega'];
		if(!mysql_query("INSERT INTO partecipazioni (utente, lega, ruolo) 
				VALUES ({$invitato},{$lega},3)"))
			echo mysql_error();
		if(!mysql_query("DELETE FROM inviti WHERE id={$invito_id}"))
			echo mysql_error();
		header("Location:../success.php?code=invite");
	}
}
else{
	header("Location:../error.php?code=500");
}
?>