<?php 
include './include/template2.inc.php';
include './include/dbms.inc.php';

$username=addslashes(($_POST['username']));
$password=md5((addslashes(($_POST['password']))));
echo $password;
$query = "SELECT utenti.username,utenti.password,gruppi.nome as role FROM utenti JOIN gruppi on (utenti.gruppo=gruppi.id) WHERE username='{$username}' AND password='{$password}'";

$result=mysql_query($query);
if(!$result){
	echo "errore".mysql_error();
}
else{
	if(mysql_num_rows($result)==0)
		header("Location:error.php?code=login");
	else{
		$user=mysql_fetch_assoc($result);
		session_start();
		$_SESSION['user']=$user['username'];
		$_SESSION['role']=$user['role'];
		if($user['role']=="admin")
			header("Location:admin/administration.php");
		else
			header("Location:index.php");
	}
}
?>