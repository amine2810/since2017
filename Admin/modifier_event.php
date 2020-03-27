<?php 
$bdd = new PDO('mysql:host=127.0.0.1;dbname=blog', 'root', '');
$connect= mysqli_connect("localhost","root","","blog");
$req = "select * From recette order by date ";

if (isset($_GET['Id'])&&!empty($_GET['Id'])) {
  $getid = intval($_GET['Id']);
}

if(isset($_GET['Id_event']) AND $_GET['Id_event'] > 0) {
   $getid_event = intval($_GET['Id_event']);
   $reqevent = $bdd->prepare('SELECT * FROM events WHERE Id = ?');
   $reqevent->execute(array($getid_event));
   $eventinfo = $reqevent->fetch();
}
 
 $ref = $getid_event;
 $pos="";
if (isset($_POST['Annuler'])){
   	header('Location: events.php?Id='.$getid);
   }
   if (isset($_POST['modify'])) {
      $nom = htmlspecialchars($_POST['nom']); 
      $desc = htmlspecialchars($_POST['desc']);     
      $lieu=htmlspecialchars($_POST['lieu']);
      $date=$_POST['date'];
        if ($nom!="") {
        $insertmb1=$bdd->prepare("UPDATE events SET nom = ?  WHERE Id=?");
        $insertmb1->execute(array($nom,$getid_rec));
        $erreur = "Event à jour !";

        $insertmb1=$bdd->prepare("UPDATE events SET description = ?  WHERE Id=?");
        $insertmb1->execute(array($desc,$getid_rec));
        $erreur = "Event à jour !";

        $insertmb1=$bdd->prepare("UPDATE events SET lieu = ?  WHERE Id=?");
        $insertmb1->execute(array($lieu,$getid_rec));
        $erreur = "Event à jour !";
        
        $insertmb1=$bdd->prepare("UPDATE events SET datee = ?  WHERE Id=?");
        $insertmb1->execute(array($date,$getid_rec));
        $erreur = "Event à jour !";
      
        
        }
        if(isset($_FILES['image']) AND !empty($_FILES['image']['name'])) {
           $tailleMax = 2097152;
           $extensionsValides = array('jpg', 'jpeg', 'gif', 'png');
           if($_FILES['image']['size'] <= $tailleMax) {
              $extensionUpload = strtolower(substr(strrchr($_FILES['image']['name'], '.'), 1));
              if(in_array($extensionUpload, $extensionsValides)) {
                 $chemin = "images/events/".$nom.".".$extensionUpload;
                 $resultat = move_uploaded_file($_FILES['image']['tmp_name'], $chemin);
                 if($resultat) {
                     $insertmb=$bdd->prepare("UPDATE event SET image = ? WHERE Id=?");
                     $insertmb->execute(array($chemin,$getid_rec));
                     $erreur = "Event à jour !";
                 } else {
                    $erreur = "Erreur durant l'importation de La photo  ";
                 }
              } else {
                 $erreur = "La photo   doit être au format jpg, jpeg, gif ou png";
              }
           
        }
        }
        
        
       
} 
?>

<!DOCTYPE html>
    <html lang="zxx" class="no-js">
<?php 
	include("head.php");
?>
   <body>
	<?php 
	include("Admin_header.php");
?>
		<br><br><br><br><br>
		<center>
				<div class="col-md-6">
					<div class="register-form">
						<h3 class="billing-title text-center">Event</h3>
						<p class="text-center mt-40 mb-30">Modifier les informations d'evennement'</p>

							 
						<form method="POST" enctype="multipart/form-data">
							<input type="text" placeholder="Name*"  required class="common-input mt-20"  name="nom" id="nom" value="<?php echo $eventinfo['nom']; ?>">
							 <input type="date" id="start" name="date" value="<?=$eventinfo['datee']?>" >
              <textarea placeholder="Description*" onfocus="this.placeholder=''" onblur="this.placeholder = 'Description'" required class="common-input mt-20"  name="desc" id="desc" ><?php echo $eventinfo['description']?></textarea>
             
	              <br>
                <br> 
               <label style="font-size: 20px; color: white">Image de couverture</label>  
              
              <img class="prd" src="<?php echo $eventinfo['image']?>">
              <input type="file" name="image" class="up "/>
              <br>
              <input type="submit" name="modify" id="modify" class="view-btn color-2 mt-20 w-100" value="Confirm" />
              <?php
							  if(isset($erreur)) {
           							 echo '<font color="white">'.$erreur."</font>";
        						 }
						  ?>
            </form>
            <form method="POST">
            	<input type="submit" name="Annuler" class="view-btn color-2 mt-20 w-100" value="Annuler" />
						</form>
					</div>
				</div>
			</div>
		</div>
		</center>	
        </body>
    </html>