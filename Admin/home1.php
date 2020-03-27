
<!DOCTYPE html>
<html lang="zxx" class="no-js">
		<link rel="stylesheet" type="text/css" href="css/menu.css">
		<meta charset="utf-8">
	<?php 
		include("Admin_head.php");
	?>
   <body  >
 
<br><br><br><br><br>
		<div class="col-md-13" >
					<div class="register-form">
								
						<h3 class="billing-title text-center">Bienvenue <?php echo $admininfo['nom']; ?>  </h3>
						<p class="text-center mt-40">Maintenant vous pouvez........  </p>
					<br><br>
				
				<div class="menu text-center "  >

		<ul style="font-size: 28px;">
				<li>
					<?php echo '<a href="recettes.php?Id='.$getid.'" > GERER Recettes</a>'
					?>
				</li>
				<LI>
					<?php echo '<a href="events.php?Id='.$getid.'" > GERER Evenements</a>'
					?>
				</LI>
				<LI>
					<?php echo '<a href="commentaires.php?Id='.$getid.'" > GERER Commentaires</a>'
					?>
				</LI>
				<LI>
					<?php echo '<a href="categories.php?Id='.$getid.'" > GERER CATEGORIES</a>'
					?>
				</LI>
			
		</ul>		

		</div>	
			</div> 
		
   </body>
</html>