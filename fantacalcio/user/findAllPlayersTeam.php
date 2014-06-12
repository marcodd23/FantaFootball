<?php
include '../include/auth.inc.php';


$totalItems=0;
$items=array();

$where="";
$order="";
if(isset($_POST['search'])){
	if($_POST['search']!=""){
	$search=$_POST['search'];
	$where.=" AND (g.nome LIKE '%".$search."%' OR g.cognome LIKE '%".$search."%')";
	}
}
if(isset($_POST['role'])){
	if($_POST['role']!=""){
	$role=$_POST['role'];
	$where.=" AND ruoli.nome = '".$role."'";
	}
}
if(isset($_POST['team'])){
	if($_POST['team']!=""){
	$team=$_POST['team'];
	$where.=" AND s.nome = '".$team."'";
	}
}

if(isset($_POST['itemSort'])){
	if($_POST['itemSort']!=""){
	$itemSort=$_POST['itemSort'];
	$order.=" ORDER BY ".$itemSort." ".$_POST['dirSort'];
	}
}
$from=$_POST['itemsForPage']*$_POST['page']-$_POST['itemsForPage'];
$to=$_POST['itemsForPage'];
$limit=" LIMIT ".$from.",".$to;

$id_rosa=$_POST['rosa'];
$baseQuery="SELECT g.id, g.nome, g.cognome,g.quotazione,ruoli.nome as ruolo,s.nome as squadra
						FROM rose AS r JOIN (acquisti AS a, giocatori AS g,ruoli,squadre as s) 
						ON ( r.id = a.rosa AND a.giocatore = g.id AND g.ruolo=ruoli.id AND g.squadra=s.id) 
						WHERE a.rosa =${id_rosa}";
$query=$baseQuery;
if(!$where=="")$query.=$where;
if(!$order=="")$query.=$order;

$result=mysql_query($query);
$totalItems=mysql_num_rows($result);

$result=mysql_query($query.$limit);
$i=0;
while($item=mysql_fetch_assoc($result)){
	$items[$i]=$item;
	$i++;
}
$filterDataResponse=array('totalItems'=>$totalItems,"items"=>$items,"query"=>$query);

header('Content-Type: application/json');
echo json_encode($filterDataResponse);
?>