<?php 
$bdd = new PDO('mysql:host=127.0.0.1;dbname=blog', 'root', '');
$connect= mysqli_connect("localhost","root","","blog");
$req = "select * From events ";

if (isset($_GET['Id'])&&!empty($_GET['Id'])) {
	$getid = intval($_GET['Id']);
}
if (isset($_POST['Rechercher'])) {
	$Id = htmlspecialchars($_POST['Id']);
	$reqId = $bdd->prepare("SELECT Id FROM events WHERE Id = ?");
    $reqId->execute(array($Id));
    $Idexist = $reqId->rowCount();

	if($Idexist == 0){
		$erreur='Titre Invalide !';
	}
	else{
		$req = "select * From events WHERE Id =  '$reqId'";
	}
}
if (isset($_POST['add'])) {
	header("Location: Add_event.php?Id=".$getid);
}
if (isset($_GET['delete'])&&!empty($_GET['delete'])) {
	$delete_Id=intval($_GET['delete']);
	$sup1=$bdd->prepare("SELECT image from events where Id =?");
    $sup1->execute(array($delete_Id));
    $sup=$sup1->fetch();
    unlink($sup[0]);
	$sql="DELETE From events WHERE Id = '$delete_Id'";
	$bdd->query($sql);
	header("Location: events.php?Id=".$getid);
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
<h3 class="text-center">Events</h3>
<div >
	<form class="form-inline"  method="post" class="text-center">
		<div class="form-group rech">
			<label for="recherche"> Rechercher événement  : </label>
			<input type="text" name="pseudo" class="form-control " id="¨pseudo" placeholder="Saisir  nom de l'événement" value="">
			<input type="submit" name="Rechercher" value="Rechercher" class="btn btn-primary"><br>
			<?php
	 if(isset($erreur)) 
        echo '<font color="red">'.$erreur."</font>";
    ?> 
		</div>		
	
	<input type="submit" name="add" value="Ajouter evenement" class="btn btn-info"><br>
	</form>	
	
</div>
<center>
	<div class="col-md-6 mt-100">
	<table class="table table-bordered table-striped" style="margin-top: 10px">
	<thead >
		<th align="center">
			
		</th>
		<th>
			Nom
		</th>
		<th>
			Descreption
		</th>
		<th>
			Date
		</th>
		<th>
			Lieu
		</th>
		<th>
			Image 
		</th>
		<th>
			Ajouter images
		</th>
		<th>
			
		</th>
	</thead> 
	<tbody>
		<?php while ($event = mysqli_fetch_array($res)) :
		?>
		<tr>
			<td>
					<a href="modifier_event.php?Id=<?=$getid;?>&Id_event=<?=$event['Id']; ?>" class="btn btn-xs btn-default"> <i class="fa fa-pencil"> </i> </a>
			</td>
			<td>
				<?php echo $event['nom'] ; ?>	
			</td>
			<td> <?php $des=$event['description'];
                echo substr($des,0,110);?> ...
				 
			</td>
			<td>
				<?php echo $event['datee'] ; ?>
			</td>
			<td>
				<?php echo $event['lieu'] ; ?>
			</td>
			<td>
			   <img style="width: 100px; height: 100px" src="	<?php echo  $event['image'] ; ?>">
			</td>
				</td>
				<td>
				<a href="add_images_event.php?Id=<?=$getid;?>&Id_event=<?=$event['Id']; ?>" class="btn btn-xs btn-default"> <i class="fa fa-plus"> </i> </a>
			</td>
			<td>
				<a href="events.php?Id=<?=$getid;?>&delete=<?=$event['Id']; ?>" class="btn btn-xs btn-default"> <i class="fa fa-trash"> </i> </a>
			</td>
		</tr>
		<?php endwhile;
		?>
	</tbody>
	</table>
</body>
</html>
