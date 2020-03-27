<?php 
$bdd = new PDO('mysql:host=127.0.0.1;dbname=blog', 'root', '');
$connect= mysqli_connect("localhost","root","","blog");
$req = "select * From evaluation order by datetime ";

if (isset($_GET['Id'])&&!empty($_GET['Id'])) {
	$getid = intval($_GET['Id']);
}
if (isset($_POST['Rechercher'])) {
	$rech = htmlspecialchars($_POST['rech']);
	$reqref = $bdd->prepare("SELECT * FROM evaluation WHERE nom LIKE '%?%'");
    $reqref->execute(array($rech));
    $refexist = $reqref->rowCount();

	if($refexist == 0){
		$erreur="Nom n'existe pas !";
	}
	else{
		$req = "select * From evaluation WHERE nom like '%'.$rech.'%'";
	}
}

if (isset($_POST['add'])) {
	header("Location: Add_Recette.php?Id=".$getid);
}
if (isset($_GET['delete'])&&!empty($_GET['delete'])) {
	$delete_Id=intval($_GET['delete']);
	$sql="DELETE From evaluation WHERE Id ='$delete_Id'";
	$bdd->query($sql);
	header("Location: commentaires.php?Id=".$getid);
} 

$res = mysqli_query($connect,$req);
?>
<!DOCTYPE html>
<html>
<head>
	<?php 
	include("Admin_head.php");
?>
</head>
<body>
<?php 
	include("Admin_header.php"); 
?>
<br><br><br><br><br>
<h3 class="text-center">Commentaires</h3>
<div>
	<form class="form-inline"  method="post" class="text-center">
		<div class="form-group rech">
			<label for="recherche"> Rechercher Commentaires : </label>
			<input type="text" name="rech" class="form-control " id="¨Id" placeholder="Saisir recette" value="<?=((isset($_POST['rech']))?$_POST['rech']:'');?>">
			<input type="submit" name="Rechercher" value="Rechercher" class="btn btn-primary"><br>
				<?php
	 if(isset($erreur)) 
        echo '<font color="red">'.$erreur."</font>";
    ?>
		</div>		
	</form>	
	
</div>
<center>
	<div class="col-md-8 mt-100">
	<table class="table table-bordered table-striped" style="margin-top: 10px">
	<thead >
	 
		<th>
			Id  
		</th>
		<th>
			Nom & prenom
		</th>
	
		<th>
			<center>
				commentaire
			</center>
		</th>
	<th>
			Date
		</th>
		<th>
			Recette
		</th>
		<th>
			
		</th>
	</thead> 
	<tbody>
		<?php while ($recette = mysqli_fetch_array($res)) :
		?>
		<tr>
		 	
			<td>
				<?php echo $recette['Id'] ; ?>	
			</td>
			<td>
				<?php echo $recette['nom']." ".$recette['prenom'] ; ?>
			</td>
		 
			<td >
			 <?php echo $recette['commentaire'];
                 ?>
			</td>
		    <td>
				<?php echo $recette['datetime'] ; ?>
			</td>
			<td>
				<?php    $cat = $recette['Id_rec']; 
							 
							$reqcat =  "select titre From recette WHERE Id = '$cat ' ";
							$cat = mysqli_query($connect,$reqcat);
						   $nom_cat= mysqli_fetch_array($cat);
						echo $nom_cat[0] ; ?>
			</td>
			<td>
				<a href="commentaires.php?Id=<?=$getid;?>&delete=<?=$recette['Id']; ?>" class="btn btn-xs btn-default"> <i class="fa fa-trash"> </i> </a>
			</td>
		</tr>
		<?php endwhile; ?>
 </tbody>
	</table>
</body>
</html> 