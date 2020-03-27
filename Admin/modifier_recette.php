<?php 
$bdd = new PDO('mysql:host=127.0.0.1;dbname=blog', 'root', '');
$connect= mysqli_connect("localhost","root","","blog");
$req = "select * From recette order by date ";

if (isset($_GET['Id'])&&!empty($_GET['Id'])) {
  $getid = intval($_GET['Id']);
}

if(isset($_GET['Id_rec']) AND $_GET['Id_rec'] > 0) {
   $getid_rec = intval($_GET['Id_rec']);
   $reqrec = $bdd->prepare('SELECT * FROM recette WHERE Id = ?');
   $reqrec->execute(array($getid_rec));
   $recinfo = $reqrec->fetch();
}
 
 $ref = $getid_rec;
 $pos="";
if (isset($_POST['Annuler'])){
   	header('Location: recettes.php?Id='.$getid);
   }
   if (isset($_POST['modify'])) {
      $nom = htmlspecialchars($_POST['nom']); 
      if (strpos($_POST['desc'],"<br />")) {
        $desc=$_POST['desc'];
      }else{
      $desc = str_replace('\n', '<br>', nl2br($_POST['desc'])) ;}
      if (strpos($_POST['desc1'],"<br />")) {
        $desc1=$_POST['desc1'];
      }else{
      $desc1 = str_replace('\n', '<br>', nl2br($_POST['desc1'])) ;}
      $selected_val = str_replace(' ','',$_POST['categorie']); 
      if (isset($_POST['slider'])) {
      $pos=$_POST['slider'];}
       // Storing Selected Value In Variable
        
        if ($nom!="") {
        $insertmb1=$bdd->prepare("UPDATE recette SET titre = ?  WHERE Id=?");
        $insertmb1->execute(array($nom,$getid_rec));
        $erreur = "Recette à jour !";

        $insertmb1=$bdd->prepare("UPDATE recette SET ingredients = ?  WHERE Id=?");
        $insertmb1->execute(array($desc,$getid_rec));
        $erreur = "Recette à jour !"; 

        $insertmb1=$bdd->prepare("UPDATE recette SET etapes = ?  WHERE Id=?");
        $insertmb1->execute(array($desc1,$getid_rec));
        $erreur = "Recette à jour !";

        $insertmb1=$bdd->prepare("UPDATE recette SET categorie_id = ?  WHERE Id=?");
        $insertmb1->execute(array($selected_val,$getid_rec));
        $erreur = "Recette à jour !";
        
        $insertmb1=$bdd->prepare("UPDATE recette SET pos = ?  WHERE Id=?");
        $insertmb1->execute(array($pos,$getid_rec));
        $erreur = "Recette à jour !";
      
        
        }
        if(isset($_FILES['image']) AND !empty($_FILES['image']['name'])) {
           $tailleMax = 2097152;
           $extensionsValides = array('jpg', 'jpeg', 'gif', 'png');
           if($_FILES['image']['size'] <= $tailleMax) {
              $extensionUpload = strtolower(substr(strrchr($_FILES['image']['name'], '.'), 1));
              if(in_array($extensionUpload, $extensionsValides)) {
                 $chemin = "images/foods/".$nom.".".$extensionUpload;
                 $resultat = move_uploaded_file($_FILES['image']['tmp_name'], $chemin);
                 if($resultat) {
                     $insertmb=$bdd->prepare("UPDATE recette SET image = ? WHERE Id=?");
                     $insertmb->execute(array($chemin,$getid_rec));
                     $erreur = "Recette à jour 11!";
                 } else {
                    $erreur = "Erreur durant l'importation de La photo  ";
                 }
              } else {
                 $erreur = "La photo   doit être au format jpg, jpeg, gif ou png";
              }
           
        }
        }
        
        header('Location: recettes.php?Id='.$getid);
       
} 
 

$cat=$recinfo['categorie_id'];
 
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
						<p class="text-center mt-40 mb-30">Modifier les informations du recette</p>

							<h3  aligne="right">
							<font color="white">	Num ° : <?php echo $recinfo['Id']; ?>
							</font></h3>
						<form method="POST" enctype="multipart/form-data">
							<label for="nom"  style="color: white">Titre</label> <input type="text" placeholder="Name*"  required class="common-input mt-20"  name="nom" id="nom" value="<?php echo $recinfo['titre']; ?>">
							<label for="desc" style="color: white">Ingrédients</label>
              <textarea placeholder="Ingrédients*" onfocus="this.placeholder=''" onblur="this.placeholder = 'Description'" required class="common-input"  name="desc" id="desc" ><?php echo $recinfo['ingredients']?></textarea>
              <label for="desc1" style="color: white">Etapes</label>
              <textarea placeholder="Etapes*" onfocus="this.placeholder=''" onblur="this.placeholder = 'Description'" required class="common-input "  name="desc1" id="desc1" ><?php echo $recinfo['etapes']?></textarea>
             
	  <br>
                    <div class="box"  >
                    <select name="categorie">
                      <?php
                        $req = "select * from categories where Id= '$cat'";
                        $res = mysqli_query($connect,$req);
                        $categorie = mysqli_fetch_array($res);
                      ?>
                        <option value="<?php echo $categorie['Id'];?>"><?php echo $categorie['categorie'];?></option>
                        <?php $req="select * from categories where Id != '$cat'";
                              $res = mysqli_query($connect,$req);
                          while ($categorie = mysqli_fetch_array($res)) :   
                        ?>
                        <option value="<?php echo $categorie['Id']; ?>"><?php echo $categorie['categorie'];?> </option>
                        <?php
                          endwhile;
                        ?>
                    </select>
            </div>
            <br><br><br><br> 
            <div align="left" >
              <input type="checkbox" <?php if ($recinfo['pos']!="") {
                echo("checked");
              } ?> style=" width: 20px; height: 20px; margin-right:5px  " id="slider" value="Slide" name="slider" ><label style="color: white;   font-size: 20px;" >Slider</label>
             </div>
               <br> 
               <label style="font-size: 20px; color: white">Image de couverture</label>  
              
              <img class="prd" src="<?php echo $recinfo['image']?>">
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