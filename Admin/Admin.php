<?php 
$bdd = new PDO('mysql:host=127.0.0.1;dbname=blog', 'root', '');


if (isset($_POST['connexion'])) {
	session_start();
	$pseudo1=htmlspecialchars($_POST['pseudo1']);
	$mdp1 = $_POST['mdp1'] ;
	 		   $reqadmin = $bdd->prepare("SELECT * FROM admin WHERE pseudo = ? AND motdepasse=? ");
               $reqadmin->execute(array($pseudo1,$mdp1));
               $adminexist = $reqadmin->rowCount();
               if($adminexist == 1){
	               	 $admininfo = $reqadmin->fetch();
			         $_SESSION['Id'] = $admininfo['Id'];
			         $_SESSION['pseudo'] = $admininfo['pseudo'];
			    	  header("Location: home.php?Id=".$_SESSION['Id']);
               }
               else{
               	 $erreur1 = "Mauvais pseudo ou mot de passe !";
               }
}
?>

<!DOCTYPE html>
    <html lang="zxx" class="no-js">
<?php 
	include("Admin_head.php");
?>
   <body>
	<br><br><br>
	<center>
		<div class="col-md-5">
					<div class="register-form">
						<h3 class="billing-title text-center">Login Administrateur </h3>
						<p class="text-center mt-40 mb-30">Nous saluons le retour! Connectez-vous à votre compte  </p>
						<form method="POST">
							<input type="text" placeholder="Pseudo*" onfocus="this.placeholder=''" onblur="this.placeholder = 'Pseudo*'" required class="common-input mt-20" id="pseudo1" name="pseudo1">
							<input type="password" placeholder="Mot de passe*" onfocus="this.placeholder=''" onblur="this.placeholder = 'Mot de passe*'" required class="common-input mt-20" id="mdp1" name="mdp1">
							<input type="submit" name="connexion" class="view-btn color-2 mt-20 w-100" value='Login'/>
							<?php
							  if(isset($erreur1)) {
           						 echo '<font color="white">'.$erreur1."</font>";
        							 }
							?> 
							<div class="mt-20 d-flex align-items-center justify-content-between">
								<div class="d-flex align-items-center"><input type="checkbox" class="pixel-checkbox" id="login-1"><label for="login-1" style="color: white" > Souviens-toi de moi</label></div>
								<a href="#" style="color: white">Mot de passe oublié ?</a>
							</div>
                        </form>
					</div>
				</div>
			</div>
		</div>
	</center>
        	 <br>	
        </body>
    </html>