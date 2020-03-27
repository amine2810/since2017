<?php
$bdd = new PDO('mysql:host=127.0.0.1;dbname=blog', 'root', '');
$connect= mysqli_connect("localhost","root","","blog");
	

?>

<!DOCTYPE html>
<html>
<?php 
	include("head.php");
?>
<body style="background-image: url(back.png); ">
<?php 
	include("header.php");
?>

<div >       
<div class="btn__container">
  <a href="https://www.instagram.com/eyasmiri/" target="_blank" class="btn1234 btn123">
    <i class="fab fa-instagram" id="btn-f"></i>
    <span id="btn-fs">instagram</span>
  </a>
    <a href="https://www.facebook.com/since2017.blog/?fref=ts" target="_blank" class="btn-f btn-f1">
    <i class="fab fa-facebook" id="btn-f"></i>
    <span id="btn-fs">facebook</span>
  </a>
</div></div>
 <section class="home-slider owl-carousel">
 	<?php $req1="select * from recette where pos like 'slide' ";
                              $res1 = mysqli_query($connect,$req1);
                          while ($rec = mysqli_fetch_array($res1)) :
                          
                        ?>
      <div class="slider-item">
        <div class="container">
        	 
          <div class="row d-flex slider-text justify-content-center align-items-center" data-scrollax-parent="true">
						
						<div class="img" style="background-image: url(<?php echo "../Admin/".$rec['image']; ?>);"></div>

            <div class="text d-flex align-items-center ftco-animate" style="background-color: #ff5376;" >
            	<div class="text-2 pb-lg-5 mb-lg-4 px-4 px-md-5">
		          	<h3 class="subheading mb-3" style="color: #fff;">Postes en vedette</h3>
		            <h1 class="mb-5" style="color: #fff;"><?php echo $rec['titre']; ?></h1>
		            
                <p   class="mb-md-5" style="color: #fff;line-height:11px;"><?php $des=$rec['ingredients'];
                echo substr($des,0,150);?> ....</p>
                <p><a href="single.php?Id=<?php echo($rec['Id'])?>"><div class="large-12 columns">
      <div class="wrapper1" style="margin-top: 190px;">
        <div class="btn1 btn1--border btn1--primary btn1--animated" style="font-weight: bolder;">Lire la suite</div>
      </div>
    </div></a></p>
              </div>
            </div>

          </div>

        </div>
      </div>
       <?php
                          endwhile;
                        ?>
    </section>


    <section class="ftco-section">
    	<div class="container" style="background-color: #ffffffb3;">
    		<div class="row">
                <div class="col-md-7 heading-section ftco-animate">
                <h2 class="mb-4"><span>Recettes récentes</span></h2>
          </div>
        </div>
    		<div class="row">
    			<div class="col-md-6 order-md-last col-lg-6 ftco-animate">
    				<div class="blog-entry">
              <?php $event=$bdd->prepare("select * from events order by datee DESC LIMIT 1");
                    $event->execute();
                    $event=$event->fetch();
               ?>
    					<div class="img img-big d-flex align-items-end" style="background-image: url(<?php echo "../Admin/".$event['image'] ;?>);">
    						<div class="overlay"></div>
    						<div class="text">
    							<span class="subheading">Evenement</span>
    							<h3><a href="single.html"><?php echo($event['nom']) ;?></a></h3>
                  <p class="mb-0"><a href="single.php?Id=<?php echo($rec['Id'])?>" class="btn-custom">Lire la suite <span class="icon-arrow_forward ml-4"></span></a></p>
    						</div>
	    				</div>
    				</div>
    			</div>

    			
    			<div class="col-md-6">
    				<div class="row">
                        <?php $req1="select * from recette order by date DESC LIMIT 4 ";
                              $res1 = mysqli_query($connect,$req1);
                          while ($rec = mysqli_fetch_array($res1)) :
                               $reqcat=$bdd->prepare("select * from categories where Id=?");
                               $reqcat->execute(array($rec['categorie_id']));
                               $catinfo = $reqcat->fetch(); 
                        ?>
    					<div class="col-md-6 ftco-animate">
    						<div class="blog-entry">
		    					<a href="single.php?Id=<?php echo($rec['Id'])?>" class="img d-flex align-items-end" style="background-image: url(<?php echo "../Admin/".$rec['image']; ?>);">
		    						<div class="overlay"></div>
			    				</a>
			    				<div class="text pt-3"  >
                    <p class="meta d-flex" > </p>
                    <div style="display: flex;">
                   <div>
                    <span  style="background-color: #fff0;" class="pr-3"><?php echo $catinfo['categorie']; ?></span>
                  </div>
                    <div align="right" style="width: 300px"><span class="ml-auto pl-3"  style="background-color: #fff0;"><?php echo substr($rec['date'],0,10) ?></span> </div></div>
	    							<h3><a href="single.php?Id=<?php echo($rec['Id'])?>"><?php echo $rec['titre']; ?></a></h3>
	    							<p class="mb-0"><a  id="btn-draw123" class="btn-draw123" href="single.php?Id=<?php echo($rec['Id'])?>"><span>Lire la suite  <span class="icon-arrow_forward ml-4"></span></span> </a></p>
	    						</div>
		    				</div>
    					</div>
                <?php
                          endwhile;
                        ?>
    				</div>
    			</div>
    		</div>
    	</div>
    </section>

    <section class="ftco-section ftco-no-pt">
    	<div class="container" style="background-color: #ffffffb3;">
        <div class="row">
        	<div class="col-lg-9">
        		<div class="row">
		          <div class="col-md-12 heading-section ftco-animate">
		            <h2 class="mb-4"><span>Postes en vedette</span></h2>
		          </div>
		        </div>
        		<div class="row">
                        <?php  
                       $req1="select * from recette order by moy LIMIT 6 ";
                              $res1 = mysqli_query($connect,$req1);
                          while ($rec = mysqli_fetch_array($res1)) :
                                $reqcat=$bdd->prepare("select * from categories where Id=?");
                               $reqcat->execute(array($rec['categorie_id']));
                               $catinfo = $reqcat->fetch(); 
                            ?>

        			<div class="col-md-4 ftco-animate">
                    
    						<div class="blog-entry">
		    					<a href="single.php?Id=<?php echo($rec['Id'])?>" class="img-2"><img style="height: 250px;" src="<?php echo "../Admin/".$rec['image']; ?>" class="img-fluid" alt="Colorlib Template"></a>
			    				<div class="text pt-3">
	    						<p class="meta d-flex" > </p>
                     <div style="display: flex;">
                      <div><span  style="background-color: #fff0;" class="pr-3"><?php echo $catinfo['categorie']; ?>
                      </span></div>
                      <div align="right" style="width: 300px">
                        <span class="ml-auto pl-3"  style="background-color: #fff0;" ><?php echo substr($rec['date'],0,10) ?></span>
                       </div></div>
	    							<h3><a href="single.php?Id=<?php echo($rec['Id'])?>"><?php echo $rec['titre']; ?></a></h3>
	    							<p class="mb-0"><div class="flex1">
                         <a href="single.php?Id=<?php echo($rec['Id'])?>" class="bttnnn1">Lire la suite <i class='fas fa-arrow-right'></i></a>
                      </div> </p>
	    						</div>
		    				</div>

    					</div>
    				      <?php
                          endwhile;
                        ?>
        		</div>
        	</div>

        	<div class="col-lg-3">
        		<div class="sidebar-wrap">
<?php include("apro.php"); ?>
        	</div>
        </div>
    	</div>
    </section>



    
   	
    <section class="ftco-counter ftco-section ftco-no-pt ftco-no-pb img" id="section-counter">
    	<div class="container">
    		<div class="row d-flex">
    			<div class="col-md-6 d-flex">
    				<div class="img d-flex align-self-stretch" style="background-image:url(images/about.jpg); "></div>
    			</div>
    			<div class="col-md-6 pl-md-5 py-5">
    				<div class="row justify-content-start pb-3">
		          <div class="col-md-12 heading-section ftco-animate">
		            <h2 class="mb-4">About Since2017</h2>
		            <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia</p>
		          </div>
		        </div>
		    		<div class="row">
		          <div class="col-md-6 justify-content-center counter-wrap ftco-animate">
		            <div class="block-18 text-center py-5 bg-light mb-4">
		              <div class="text">
		                <strong class="number" data-number="3">0</strong>
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

		        </div>
	        </div>
        </div>
    	</div>
    </section><br><br>
<?php 
	include("footer.php");
?>
 	</body>
 	</html>