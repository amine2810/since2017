<?php
session_start();
$bdd = new PDO('mysql:host=127.0.0.1;dbname=blog', 'root', '');
//$getid = intval($_GET['Id']);
$getid = 32;
?>

<!-- Start Header Area -->
<header class="default-header">
				
				<nav class="navbar navbar-expand-lg  navbar-light">
					<div class="container">
						  <a class="navbar-brand" href="#">
						  	<img src="logo.png"  width="85">
						  </a>
						 
						  <div class="collapse navbar-collapse justify-content-end align-items-center" id="navbarSupportedContent">
						    <ul class="navbar-nav">
								<li>
								<?php echo '<a href="Home.php?Id='.$getid.'" > Home</a>'?></li>
								<li>
									<?php echo '<a href="recettes.php?Id='.$getid.'" > Recettes</a>'?>	
								</li>
								<li>
									<?php echo '<a href="events.php?Id='.$getid.'" > Events</a>'?>
								</li>
								<li><?php echo '<a href="commentaires.php?Id='.$getid.'" > Commentaires</a>'?></li>
								<li><?php echo '<a href="categories.php?Id='.$getid.'" > Catégories</a>'?></li>
														
						    </ul>
						  </div>						
					</div>
				</nav>
			</header>
			<!-- End Header Area -->