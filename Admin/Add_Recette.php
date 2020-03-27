<?php
$bdd = new PDO('mysql:host=127.0.0.1;dbname=blog', 'root', '');
$connect= mysqli_connect("localhost","root","","blog");
$getid = intval($_GET['Id']);
$pos="";
$video="";
$note=0;
if (isset($_POST['Confirm'])) {
      $nom = htmlspecialchars($_POST['titre']); 
      $video = htmlspecialchars($_POST['video']); 
      $desc = str_replace('\n', '<br>', nl2br($_POST['desc'])) ;
      $desc1 = str_replace('\n', '<br>', nl2br($_POST['desc1'])) ;     
      $selected_val = str_replace(' ','',$_POST['categorie']); 
       if (isset($_POST['slider'])) {
      $pos=$_POST['slider'];}
        // Storing Selected Value In Variable
		if ($selected_val!="") {
				if(isset($_FILES['image']) AND !empty($_FILES['image']['name'])) {
				   $tailleMax = 2097152;
				   $extensionsValides = array('jpg', 'jpeg', 'gif', 'png');
				   if($_FILES['image']['size'] <= $tailleMax) {
				      $extensionUpload = strtolower(substr(strrchr($_FILES['image']['name'], '.'), 1));
				      if(in_array($extensionUpload, $extensionsValides)) {
				         $chemin = "images/foods/".$nom.".".$extensionUpload;
                 $chemin=str_replace(' ','-',$chemin); 
				         $resultat = move_uploaded_file($_FILES['image']['tmp_name'], $chemin);
                 
				         if($resultat) {
				         	   $insertmb=$bdd->prepare("INSERT INTO recette(titre,ingredients,etapes,categorie_id,image,pos,moy,video) VALUES (?,?,?,?,?,?,?,?)");
         					 $insertmb->execute(array($nom,$desc,$desc1,$selected_val,$chemin,$pos,$note,$video));
          					 $erreur = "Recette bien ajoutée !";
				         } else {
				            $erreur = "Erreur durant l'importation de La photo  ";
				         }
				      } else {
				         $erreur = "La photo   doit être au format jpg, jpeg, gif ou png";
				      }
				   
				}
 
        } 
}else{
          $erreur="******Selecter une categorie******";
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
						<h3 class="billing-title text-center">Recette</h3>
						<p class="text-center mt-40 mb-30">Ajouter une recettte </p>
						<form method="POST" enctype="multipart/form-data" >
              <input type="text" placeholder="Titre*"  required class="common-input mt-20"  name="titre" id="titre">  
              <textarea required  placeholder="Ingrédients*" style="height: 200px" required  class="common-input mt-20"  name="desc" id="desc" ></textarea>
            				  <br>
                      <textarea required  placeholder="Étapes*" style="height: 200px" required  class="common-input mt-20"  name="desc1" id="desc1" ></textarea>
                      <br>
                       <input type="text" placeholder="Lien video*"  class="common-input mt-20"  name="video" id="video">
           <br> 
             				<div class="box"  >
             				<select name="categorie">
             						<option value="">Choisisssez Categorie </option>
             						<?php $req="select * from categories";
                              $res = mysqli_query($connect,$req);
             							while ($categorie = mysqli_fetch_array($res)) :
             							
             						?>
             						<option value="<?php echo $categorie['Id']; ?>"> <?php echo $categorie['categorie'];?> </option>
             						<?php
             							endwhile;
             						?>
             				</select>
						</div>
            <br>
            <br><br>
        <div align="left"  >
              <input type="checkbox" style=" width: 20px; height: 20px; margin-right:5px  " value="Slide" name="slider" ><label style="color: white;   font-size: 20px;" >Slider</label>
             </div>
             <br> 
    
               
               <br> 
               <label style="font-size: 20px; color: white">Image de couverture</label>  
               <input type="file" name="image" class="up "/>
               
                <?php
                if(isset($imageError)) {
                         echo '<font color="white">'.$imageError."</font>";
                     }
                if(isset($erreur)) {
                         echo '<br>	<font color="white" size="5px">'.$erreur."</font>";
                     }
              ?>
            <input type="reset" class="view-btn color-2 mt-20 w-9">
              <input  type="submit" name="Confirm" id="Confirm" class="view-btn color-2 mt-20 w-100" value="Confirm" />
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