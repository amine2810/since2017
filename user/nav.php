<head> 	 
	<link rel="stylesheet"  href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
           <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  
           <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
           
</head>
	  <nav class="navbar navbar-expand-lg navbar-dark bg-dark ftco-navbar-light" id="ftco-navbar">
	    <div class="container"  >
	      <a class="navbar-brand" href="Accueil.php"><img src="images/logo.png" style="width: 130px; height: 70px;"> </a>
	      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
	        <span class="oi oi-menu"></span> Menu
	      </button>
			<div class="sidebar-box p-4 ftco-animate col-lg-4 col-sm-2" style="margin-top: 50px;" >
	              <form method="POST" class="search-form">
	                  <a href="" id="lien"><span class="icon icon-search" style="margin-right: 15px; color: blue;">
	                  </span> </a>
	                  <input type="text" id="titre" name="titre" class="form-control" placeholder="Chercher une recette">
	                   <div id="recetteList"></div> 
	              </form>
	         </div>
	      <div class="collapse navbar-collapse" id="ftco-nav">
	        <ul class="navbar-nav ml-auto">
	          <li class="nav-item active"><a href="Accueil.php" class="nav-link">Accueil</a></li>
	          <li class="nav-item"><a href="apropos.php" class="nav-link">A propos</a></li>
	          <li class="nav-item Dropdown"><a href="" class="nav-link dropdown-toggle" role="button" data-toggle="dropdown">Recettes</a>
                <div class="dropdown-menu " >
                	<?php
                		$req="select * from categories";	
						$res = mysqli_query($connect,$req);
                		while ($rec = mysqli_fetch_array($res)) :
                          
                        ?>
                    <a class="dropdown-item categorie" href="<?php echo "foods.php?Id_cat=".$rec['Id']  ?>"><?php echo $rec['categorie']; ?></a>
                   <?php endwhile; ?>
                  </div>
                </li>
	          <li class="nav-item"><a href="lifestyle.html" class="nav-link">Evenements</a></li>
	          <li class="nav-item"><a href="contact.html" class="nav-link">Contact</a></li>
	      <li class="nav-item" style="margin-top: 30px; margin-left: 60px">
	      
	     	 <div class="social-menu  ">
	      		<ul class="social ">
	      			<li  class="lisocial nav-item"><a class="asocial" href="https://www.facebook.com/since2017.blog/?fref=ts" target="_blank"><i class="fa fa-facebook"></i></a></li>
	      			<li class="lisocial nav-item"><a class="asocial" href="https://www.instagram.com/eyasmiri/" target="_blank"><i class="fa fa-instagram"></i></a></li>
	      		</ul>
	      </div>
      </li></ul></div>
	    </div>
	  </nav>