<?php

$bdd = new PDO('mysql:host=127.0.0.1;dbname=blog', 'root', '');
$connect= mysqli_connect("localhost","root","","blog");
 	 
if(isset($_GET['Id_rec']) AND $_GET['Id_rec'] > 0) {
   $getid_rec = intval($_GET['Id_rec']);
   $reqrec = $bdd->prepare('SELECT * FROM recette WHERE Id = ?');
   $reqrec->execute(array($getid_rec));
   $recinfo = $reqrec->fetch();
}
 
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/style.css">
    <title>Web pages</title>
	<?php 
	include("Admin_head.php");
?>
  </head>
 
<frameset rows="19%,10%,*" border="0">

	 <frame name="menu" src="Admin_header1.php" noresize=></frame>
	 <frame name="Accueil" src="web.php" noresize></frame>
	 <frameset cols="20%,*"  >
	 	 <frame name="list" src="Accueil.php" noresize></frame>
	 	 <frame name="Contenue" src="Slide.php" noresize>	</frame>
	 </frameset>
</frameset>
 
</html>

