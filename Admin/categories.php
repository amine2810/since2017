<?php 
$bdd = new PDO('mysql:host=127.0.0.1;dbname=blog', 'root', '');
$connect= mysqli_connect("localhost","root","","blog");
$req = "select * From categories order by categorie ";
if (isset($_GET['Id'])&&!empty($_GET['Id'])) {
	$getid = intval($_GET['Id']);
}
if (isset($_POST['Rechercher'])) {
	$num = htmlspecialchars($_POST['num']);
	$reqnum = $bdd->prepare("SELECT * FROM categories WHERE Id = ?");
    $reqnum->execute(array($num));
    $numexist = $reqnum->rowCount();

	if($numexist == 0){
		$erreur='num Invalide !';
	}
	else{
		$req = "select * From categories WHERE Id =  '$num'";
	}
}
if (isset($_POST['add'])) {
	header("Location: Add_Categorie.php?Id=".$getid);
}
if (isset($_GET['delete'])&&!empty($_GET['delete'])) {
	$delete_id=intval($_GET['delete']);
	$sql="DELETE From categories WHERE Id = '$delete_id'";
	$bdd->query($sql);
	header("Location: categories.php?Id=".$getid);
}

$res = mysqli_query($connect,$req);
?>
<!DOCTYPE html>
<html lang="zxx" class="no-js">
<?php 
	include("Admin_head.php");
?>
<body>
	<?php 
	include("Admin_header.php");
?>
<br><br><br><br><br>
<h3 class="text-center">CATEGORIES</h3>
<div >
	<form class="form-inline"  method="post" class="text-center">
		<div class="form-group rech">
			<label for="recherche"> Rechercher Categorie : </label>
			<input type="text" name="num" class="form-control " id="¨num" placeholder="Saisir  Num du Categorie" value="<?=((isset($_POST['num']))?$_POST['num']:'');?>">
			<input type="submit" name="Rechercher" value="Rechercher" class="btn btn-primary"><br>
			<?php
	 if(isset($erreur)) 
        echo '<font color="red">'.$erreur."</font>";
    ?> 
		</div>		
	
	<input type="submit" name="add" value="Ajouter Categorie" class="btn btn-info"><br>
	</form>	
	
</div>
<center>
	<div class="col-md-6 mt-100">
	<table class="table table-bordered table-striped" style="margin-top: 10px">
	<thead >
		<th align="center">
			
		</th>
		<th>
			Num Categorie
		</th>
		<th>
			Categorie Name
		</th>

		<th>
			
		</th>
	</thead> 
	<tbody>
		<?php while ($cat = mysqli_fetch_array($res)) :
		?>
		<tr>
			<td>
					<a href="modifier_categorie.php?Id=<?=$getid;?>&Id_cat=<?=$cat['Id']; ?>" class="btn btn-xs btn-default"> <i class="fa fa-pencil"> </i> </a>
			</td>
			<td>
				<?php echo $cat['Id'] ; ?>	
			</td>
			<td>
				<?php echo $cat['categorie'] ; ?>
			</td>
			<td>
				<a href="categories.php?Id=<?=$getid;?>&delete=<?=$cat['Id']; ?>" class="btn btn-xs btn-default"> <i class="fa fa-trash"> </i> </a>
			</td>
		</tr>
		<?php endwhile;
		?>
	</tbody>
	</table>
</body>
</html>