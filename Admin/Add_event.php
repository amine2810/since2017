<?php
$bdd = new PDO('mysql:host=127.0.0.1;dbname=blog', 'root', '');
$connect= mysqli_connect("localhost","root","","blog");
$getid = intval($_GET['Id']);
if (isset($_POST['Confirm'])) {
      $nom = htmlspecialchars($_POST['titre']);
    $lieu = htmlspecialchars($_POST['lieu']); 
     $desc = htmlspecialchars($_POST['desc']);     
    $date =  ($_POST['date']); 

		if ($nom!="") {
         if ($desc!="") {
         	 if ($lieu!="") {
                    if(isset($_FILES['image']) AND !empty($_FILES['image']['name'])) {
           $tailleMax = 2097152;
           $extensionsValides = array('jpg', 'jpeg', 'gif', 'png');
           if($_FILES['image']['size'] <= $tailleMax) {
              $extensionUpload = strtolower(substr(strrchr($_FILES['image']['name'], '.'), 1));
              if(in_array($extensionUpload, $extensionsValides)) {
                 $chemin = "images/events/".$nom.".".$extensionUpload;
                 $chemin=str_replace(' ','-',$chemin); 
                 $resultat = move_uploaded_file($_FILES['image']['tmp_name'], $chemin);
                 if($resultat) {
                     $insertmb=$bdd->prepare("INSERT INTO events(nom,description,datee,lieu,image) VALUES (?,?,?,?,?)");
                   $insertmb->execute(array($nom,$desc,$date,$lieu,$chemin));
                     $erreur = "Evennement bien ajoutée !";
                 } else {
                    $erreur = "Erreur durant l'importation de La photo  ";
                 }
              } else {
                 $erreur = "La photo   doit être au format jpg, jpeg, gif ou png";
              }
           
        }
 
        }
 							
      }
else{
      	 $erreur="******Saisir le Lieu******";
      }
      
  }      	else{
          $erreur="******Saisir la descreption******";
        }
}else{
          $erreur="******Saisir le nom ******";
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
						<h3 class="billing-title text-center">Evennement</h3>
						<p class="text-center mt-40 mb-30">Ajouter un evennement</p>
						<form method="POST" enctype="multipart/form-data" >
              <input type="text" placeholder="Titre*"  required class="common-input mt-20"  name="titre" id="titre">  
              <input type="text" placeholder="Lieu*"  required class="common-input mt-20"  name="lieu" id="lieu">  <br>
              <input type="date" id="start" name="date"
                       min="2017-01-01" max="2030-12-31">
              <textarea required  placeholder="Description*"  required  class="common-input mt-20"  name="desc" id="desc" ></textarea>
            
               <br><br>
               <label style="font-size: 20px; color: white">Image de couverture</label>  
               <input type="file" name="image" class="up "/>
                <?php
                if(isset($imageError)) {
                         echo '<font color="white">'.$imageError."</font>";
                     }
              ?>
              <input type="reset" class="view-btn color-2 mt-20 w-9">
              <input  type="submit" name="Confirm" id="Confirm" class="view-btn color-2 mt-20 w-100" value="Confirm" />
							
						
                        </form>
                        <form method="POST"4>
                        	<input type="submit" name="Annuler" class="view-btn color-2 mt-20 w-100" value="Annuler" />
                        	<?php
							  if(isset($erreur)) {
           						 echo '<font color="white">'.$erreur."</font>";
        							 }
							?> 
						</form>
					</div>
				</div>
			</div>
		</div>
		</center>	
        </body>
    </html>