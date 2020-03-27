<?php 
session_start();
$bdd = new PDO('mysql:host=127.0.0.1;dbname=blog', 'root', '');
if(isset($_GET['Id']) AND $_GET['Id'] > 0) {
   $getid = intval($_GET['Id']);
   $reqadmin = $bdd->prepare('SELECT * FROM admin WHERE Id = ?');
   $reqadmin->execute(array($getid));
   $admininfo = $reqadmin->fetch();
}
if ($admininfo['nom']!="") {
	include("home1.php");
}
else{
	echo("erreur!!!");
}
?>
