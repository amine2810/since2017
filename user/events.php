
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
            <h1 class="mb-3 bread">Evénement</h1>
            <p class="breadcrumbs"><span class="mr-2"><a href="index.html">Accueil <i class="ion-ios-arrow-forward"></i></a></span> <span>Evénement <i class="ion-ios-arrow-forward"></i></span></p>
          </div>
        </div>
      </div>
    </section>


    <section class="ftco-section">
    	<div class="container">
        <div class="row">
        	<div class="col-lg-9">
        		<div class="row">
 	<?php $req1="select * from events order by datee DESC ";
                              $res1 = mysqli_query($connect,$req1);
                          while ($rec = mysqli_fetch_array($res1)) :
                          
                        ?>
        			<div class="col-md-6 col-lg-12 ftco-animate">
    						<div class="blog-entry d-lg-flex" style="background-color: #ffffffb3;">
    							<div class="half">
			    					<a href="single.html" class="img d-flex align-items-end" 
			    							style="background-image: url(<?php echo "../Admin/".$rec['image']; ?>);">
			    						<div class="overlay"></div>
				    				</a>
			    				</div>
			    				<div class="text px-md-4 px-lg-5 half pt-3">
	    					<div style="display: flex;">
	    								<span class="pr-3"><?php echo $rec['lieu'].' ';?><i class='fas fa-map-marker-alt' style='color :#999999 ;'></i></span>
                          <p class="meta d-flex" style="width: 170px; margin-top: 7px"></p>
	    								<span class="ml-auto pl-3"><?php echo $rec['datee'].' ';?><i class='fas fa-calendar-alt' style='color :#999999 ;'></i></span>
	    							</div>
	    							<h3><a href="single.html"><?php echo $rec['nom'];?> </a></h3>
	    							<p>      <?php $des=$rec['description'];
               								   echo substr($des,0,280);?> ...
									</p>
	    							  <p class="mb-0"><div class="flex1">
                         <a href="#0" class="bttnnn1">Lire la suite <i class='fas fa-arrow-right'></i></a>
                      </div> </p>
	    						</div>
		    				</div>
    					</div>
 				<?php endwhile; ?>
        		</div>
        	</div>

        	<div class="col-lg-3">
        		<div class="sidebar-wrap">
	        		<?php include("apro.php"); ?>
            </div>
        	</div>
        </div>
    	</div>
    </section>

		

<?php include("footer.php");?>
    
  </body>
</html>