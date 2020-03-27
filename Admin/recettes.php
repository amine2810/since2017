<?php 
$bdd = new PDO('mysql:host=127.0.0.1;dbname=blog', 'root', '');
$connect= mysqli_connect("localhost","root","","blog");
$req = "select * From recette order by date DESC ";

if (isset($_GET['Id'])&&!empty($_GET['Id'])) {
	$getid = intval($_GET['Id']);
}
if (isset($_POST['Rechercher'])) {
	$rech = htmlspecialchars($_POST['rech']);
	$reqref = $bdd->prepare("SELECT * FROM recette WHERE titre LIKE '%?%'");
    $reqref->execute(array($rech));
    $refexist = $reqref->rowCount();

	if($refexist == 0){
		$erreur="Recette n'existe pas !";
	}
	else{
		$req = "select * From recette WHERE titre like '%'.$rech.'%'";
	}
}

if (isset($_POST['add'])) {
	header("Location: Add_Recette.php?Id=".$getid);
}
if (isset($_GET['delete'])&&!empty($_GET['delete'])) {
	$delete_Id=intval($_GET['delete']);
	$sup1=$bdd->prepare("SELECT image from recette where Id =?");
    $sup1->execute(array($delete_Id));
    $sup=$sup1->fetch();
    unlink($sup[0]);
    $req3="SELECT image From image_recette where Id_rec=$delete_Id";
    $res3 = mysqli_query($connect,$req3);
    while ($del = mysqli_fetch_array($res3)){
    	unlink($del[0]);
    }
	$sql="DELETE From recette WHERE Id ='$delete_Id'";
	$bdd->query($sql);
	header("Location: recettes.php?Id=".$getid);
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
<h3 class="text-center">Recette</h3>
<div>
	<form class="form-inline"  method="post" class="text-center">
		<div class="form-group rech">
			<label for="recherche"> Rechercher Recette : </label>
			<input type="text" name="rech" class="form-control " id="¨Id" placeholder="Saisir recette" value="<?=((isset($_POST['rech']))?$_POST['rech']:'');?>">
			<input type="submit" name="Rechercher" value="Rechercher" class="btn btn-primary"><br>
				<?php
	 if(isset($erreur)) 
        echo '<font color="red">'.$erreur."</font>";
    ?>
		</div>		
	
	<input type="submit" name="add" value="Ajouter Recette" class="btn btn-info"><br>
	</form>	
	
</div>
<center>
	<div class="col-md-8 mt-100">
	<table class="table table-bordered table-striped" style="margin-top: 10px">
	<thead >
		<th align="center">
	
		</th>
		<th>
			Code recette
		</th>
		<th>
			Nom du recette
		</th>
	
		<th>
			<center>
				Ingrédients
			</center>
		</th>
		<th>
			<center>
				Etapes
			</center>
		</th>
	<th>
			Date
		</th>
		<th>
			Catégorie
		</th>
		<th>
			Image de couverture
		</th>
		<th>
			Ajouter Images
		</th>
		<th>
			
		</th>
	</thead> 
	<tbody>
		<?php while ($recette = mysqli_fetch_array($res)) :
		?>
		<tr>
			<td>
				<a href="modifier_recette.php?Id=<?=$getid;?>&Id_rec=<?=$recette['Id']; ?>" class="btn btn-xs btn-default"> <i class="fa fa-pencil"> </i> </a>
			</td>	
			<td>
				<?php echo $recette['Id'] ; ?>	
			</td>
			<td>
				<?php echo $recette['titre'] ; ?>
			</td>
		 
			<td >
			 <?php $des=$recette['ingredients'];
                echo substr($des,0,80);?> ...
			</td><td >
			 <?php $des=$recette['etapes'];
                echo substr($des,0,80);?> ...
			</td>
		    <td>
				<?php echo $recette['date'] ; ?>
			</td>
			<td>
				<?php    $cat = $recette['categorie_id']; 
							 
							$reqcat =  "select * From categories WHERE Id = '$cat ' ";
							$cat = mysqli_query($connect,$reqcat);
						   $nom_cat= mysqli_fetch_array($cat);
						echo $nom_cat['categorie'] ; ?>
			</td>
			<td>
				<img style="width: 100px; height: 100px" src=" <?php  
						echo $recette['image'] ; ?>" >
			</td>
				<td>
				<a href="add_images.php?Id=<?=$getid;?>&Id_rec=<?=$recette['Id']; ?>" class="btn btn-xs btn-default"> <i class="fa fa-plus"> </i> </a>
			</td>
			<td>
				<a href="recettes.php?Id=<?=$getid;?>&delete=<?=$recette['Id']; ?>" class="btn btn-xs btn-default"> <i class="fa fa-trash"> </i> </a>
			</td>
		</tr>
		<?php endwhile; ?>
 </tbody>
	</table>
</body>
</html> 