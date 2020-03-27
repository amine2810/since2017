<?php
$bdd = new PDO('mysql:host=127.0.0.1;dbname=blog', 'root', '');
$connect= mysqli_connect("localhost","root","","blog");
	

?>

<!DOCTYPE html>
<html>
<?php 
	include("head.php");
?>
<body>
<?php 
	include("header.php");
?>


    <section class="hero-wrap hero-wrap-2" style="background-image: url('images/bg_4.jpg');  background-attachment: fixed; margin-top: -20px; height: 400px">
      <div class="overlay"></div>
      <div class="container">
        <div class="row no-gutters slider-text align-items-end justify-content-center">
          <div class="col-md-9 ftco-animate pb-5 text-center" style="margin-bottom: 150px;">
            <h1 class="mb-3 bread">À propos de nous</h1>
            <p class="breadcrumbs"><span class="mr-2"><a href="index.html">Accueil <i class="ion-ios-arrow-forward"></i></a></span> <span>À propos de nous </span></p>
          </div>
        </div>
      </div>
    </section>
<br><br>


		<section class="ftco-counter ftco-section ftco-no-pt ftco-no-pb img" id="section-counter">
    	<div class="container">
    		<div class="row d-flex">
    			<div class="col-md-6 d-flex">
    				<div class="img d-flex align-self-stretch" style="background-image:url(images/about.jpg);"></div>
    			</div>
    			<div class="col-md-6 pl-md-5 py-5">
    				<div class="row justify-content-start pb-3">
		          <div class="col-md-12 heading-section ftco-animate">
		            <h2 class="mb-4"><span>À propos de since2017</span></h2>
		            <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia</p>
		          </div>
		        </div>
		    		<div class="row">
		          <div class="col-md-6 justify-content-center counter-wrap ftco-animate">
		            <div class="block-18 text-center py-5 bg-light mb-4">
		              <div class="text">
		                <strong class="number" data-number="10">0</strong>
		                <span>Years of Experienced</span>
		              </div>
		            </div>
		          </div>
		          <div class="col-md-6 justify-content-center counter-wrap ftco-animate">
		            <div class="block-18 text-center py-5 bg-light mb-4">
		              <div class="text">
		                <strong class="number" data-number="200">0</strong>
		                <span>Foods</span>
		              </div>
		            </div>
		          </div>
		          <div class="col-md-6 justify-content-center counter-wrap ftco-animate">
		            <div class="block-18 text-center py-5 bg-light mb-4">
		              <div class="text">
		                <strong class="number" data-number="300">0</strong>
		                <span>Lifestyle</span>
		              </div>
		            </div>
		          </div>
		          <div class="col-md-6 justify-content-center counter-wrap ftco-animate">
		            <div class="block-18 text-center py-5 bg-light mb-4">
		              <div class="text">
		                <strong class="number" data-number="40">0</strong>
		                <span>Happy Customers</span>
		              </div>
		            </div>
		          </div>
		        </div>
	        </div>
        </div>
    	</div>
    </section>
<br> <br>
    <section class="ftco-section ftco-no-pt ftco-section-about ftco-no-pb bg-darken">
    	<div class="container-fluid">
    		<div class="row">
					<div class="col-sm-6 col-md-6 col-lg-5 order-md-last img py-5" style="background-image: url(images/eya.jpg);  background-size: 750px 750px;  height: 700px;"></div>

	        <div class="col-sm-6 col-md-6 col-lg-7 py-4 text d-flex align-items-center ftco-animate"> 
	        	<div class="text-2 py-5 px-4">
	            <h1 class="mb-5">SMIRI EYA </h1>
	            <p class="mb-md-5"> On dit souvent que «  L’amour se cuisine tous les jours », cette passion a commencé avec un amour
pour la photographie de la nourriture appétissante, un amour pour le partage, un amour des
ingrédients, un amour pour la recherche et l’innovation gastronomique.<br>
Je commence toujours par une bonne recherche des recettes, des photos et des techniques.<br> J’essaye
toujours de faire un mixte presque parfait pour avoir la bonne recette.<br>
Ce site est la conclusion à tout ce que vous venez de lire où je partage la recette idéale, je vous
donne aussi la possibilité de la déguster en passant une commande (Seulement les Weekends).<br>
J’espère avoir proposé un menu aussi varié à vos goût mais que je vais l’enrichir petit à petit.<br>
Bonne visite, j’attends vos interactions et n’hésitez pas à me contacter pour n’importe quel question,
réclamation ou proposition.</p>
	            <span class="signature">SMIRI.eya</span>
	          </div>
	        </div>
    		</div>
    	</div>
    </section>
		
 

<?php 
	include("footer.php");
?>
 	</body>
 	</html>