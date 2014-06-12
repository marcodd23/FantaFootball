<?php 

require '../include/mailer.inc.php';
include '../include/auth.inc.php';
	
checkAuthorization("user/removeInvite.php");
if(isset($_GET['id'])){	
	$id=$_GET['id'];
	$result=mysql_query("SELECT * FROM inviti WHERE id = {$id}");
	if(mysql_num_rows($result)==0){
		header("Location:../error.php?code=500");
		exit();
	}
	$invito=mysql_fetch_assoc($result);
	$lega=$invito['lega'];
	checkIfIsLeagueAdmin($lega);
	if(!mysql_query("DELETE FROM inviti WHERE id={$id}")) echo mysql_error();
	else header("Location:league.php?id=".$lega);
		
}
else{
	header("Location:../error.php?code=500");		
}
	
	
?>
