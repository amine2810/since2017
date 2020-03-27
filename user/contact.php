
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
            <h1 class="mb-3 bread">Contacter nous</h1>
            <p class="breadcrumbs"><span class="mr-2"><a href="index.html">Accueil <i class="ion-ios-arrow-forward"></i></a></span> <span>Contact <i class="ion-ios-arrow-forward"></i></span></p>
          </div>
        </div>
      </div>
    </section>

    <section class="ftco-section ftco-no-pb contact-section">
    	
      <div class="container">
      	<center>
        <div class="row block-9">
          <div class="col-md-9 order-md-last d-flex ">
            <form action="#" class="bg-light p-5 contact-form">
             <div class="form-group " >
                <input type="text" class="form-control" required="" placeholder="Nom">
              </div>
               <div class="form-group ">
                <input type="text" class="form-control" required="" placeholder="Prenom">
              </div>
              <div class="form-group">
                <input type="Email" class="form-control" required="" placeholder="Email">
              </div>
              <div class="form-group">
                <textarea name="" id="" cols="30" rows="7" required="" class="form-control" placeholder="Message"></textarea>
              </div>
              <div class="form-group">
                <input type="submit" name="submit" value="Send Message" class="btn btn-primary py-3 px-5">
              </div>
            </form>
          
          </div>
 
        </div>
        </center>
      </div>

    </section>
		
		<section class="ftco-section contact-section">
      <div class="container">
        <div class="row d-flex contact-info">
          <div class="col-md-3 d-flex">
          	<div class="align-self-stretch box p-4 text-center">
          		   <a href="https://www.facebook.com/since2017.blog/?fref=ts"><div class="icon d-flex align-items-center justify-content-center">
					<span class="icon-facebook"></span>
          		</div></a>
          		<h3 class="mb-4">Facebook</h3>
	            <p><a href="https://www.facebook.com/since2017.blog/?fref=ts"> Since2017 Blog</p></a>
	          </div>
          </div>
          <div class="col-md-3 d-flex">
          	<div class="align-self-stretch box p-4 text-center">
          		<a href="https://www.instagram.com/eyasmiri/">
	          		<div class="icon d-flex align-items-center justify-content-center">
	          			<span class="icon-instagram"></span>
	          		</div>
	          	</a>
          		<h3 class="mb-4">Instagram</h3>
	            <p><a href="https://www.instagram.com/eyasmiri/">@eyasmiri</a></p>
	          </div>
          </div>
          <div class="col-md-3 d-flex">
          	<div class="align-self-stretch box p-4 text-center">
          		<a href="mailto:ayouta.smiri@gmail.com">
          		<div class="icon d-flex align-items-center justify-content-center">
          			<span class="icon-paper-plane"></span>
          		</div>
          	</a>
          		<h3 class="mb-4">Email Address</h3>
	            <p><a href="mailto:ayouta.smiri@gmail.com">ayouta.smiri@gmail.com</a></p>
	          </div>
          </div>
          <div class="col-md-3 d-flex">
          	<div class="align-self-stretch box p-4 text-center">
          		<div class="icon d-flex align-items-center justify-content-center">
          			<span class="icon-globe"></span>
          		</div>
          		<h3 class="mb-4">Website</h3>
	            <p><a href="#">since2017.com</a></p>
	          </div>
          </div>
        </div>

    </section>
 

  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
  <script src="js/google-map.js"></script>
  <?php include("footer.php"); ?>
  </body>
</html>