<?php 
$bdd = new PDO('mysql:host=127.0.0.1;dbname=blog', 'root', '');
$connect= mysqli_connect("localhost","root","","blog");
$req = "select * From recette order by date ";

if (isset($_GET['Id'])&&!empty($_GET['Id'])) {
  $getid = intval($_GET['Id']);
}

if(isset($_GET['Id_cat']) AND $_GET['Id_cat'] > 0) {
   $getid_cat = intval($_GET['Id_cat']);
   $reqrec = $bdd->prepare('SELECT * FROM categories WHERE Id = ?');
   $reqrec->execute(array($getid_cat));
   $recinfo = $reqrec->fetch();
}
 
if (isset($_POST['Annuler'])){
    header('Location: categories.php?Id='.$getid);
   }
   if (isset($_POST['modify'])) {
      $nom = htmlspecialchars($_POST['nom']); 
        
        if ($nom!="") {
        $insertmb1=$bdd->prepare("UPDATE categories SET categorie = ?  WHERE Id=?");
        $insertmb1->execute(array($nom,$getid_cat));
        $erreur = "Recette à jour !";

        }
        if(isset($_FILES['image']) AND !empty($_FILES['image']['name'])) {
           $tailleMax = 2097152;
           $extensionsValides = array('jpg', 'jpeg', 'gif', 'png');
           if($_FILES['image']['size'] <= $tailleMax) {
              $extensionUpload = strtolower(substr(strrchr($_FILES['image']['name'], '.'), 1));
              if(in_array($extensionUpload, $extensionsValides)) {
                 $chemin = "images/categories/".$nom.".".$extensionUpload;
                   $chemin=str_replace(' ','-',$chemin);
                 $resultat = move_uploaded_file($_FILES['image']['tmp_name'], $chemin);
                 if($resultat) {
                     $insertmb=$bdd->prepare("UPDATE categories SET image = ? WHERE Id=?");
                     $insertmb->execute(array($chemin,$getid_cat));
                     $erreur = "Catégorie à jour !";
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
            <h3 class="billing-title text-center">Catégorie</h3>
            <p class="text-center mt-40 mb-30">Modifier les informations du categorie</p>

              <h3  aligne="right">
              <font color="white">  Num ° : <?php echo $recinfo['Id']; ?>
              </font></h3>
            <form method="POST" enctype="multipart/form-data">
              <input type="text" placeholder="Name*"  required class="common-input mt-20"  name="nom" id="nom" value="<?php echo $recinfo['categorie']; ?>">
             
            
               <br> <br><br>
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
     
    </center> 
        </body>
    </html>