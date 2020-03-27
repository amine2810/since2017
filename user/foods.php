<?php
$bdd = new PDO('mysql:host=127.0.0.1;dbname=blog', 'root', '');
$connect= mysqli_connect("localhost","root","","blog");
	$getid='';
	$getid_cat=0;
if (isset($_GET['Id'])&&!empty($_GET['Id'])) {
	$getid = ($_GET['Id']);
}

if (isset($_GET['Id_cat'])&&!empty($_GET['Id_cat'])) {
	$getid_cat = intval($_GET['Id_cat']);
}
if ($getid_cat!=0) {
                $req1 = $bdd->prepare("SELECT * from categories where Id= ?  ");
                    $req1->execute(array($getid_cat));
                    $req = $req1->fetch();
                    $aff=$req['categorie'];
                    $img=$req['image'];
              }
              else{ $aff='Recherche';
              }
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
    <section class="hero-wrap hero-wrap-2" style="background-image: url('<?php echo"../Admin/".$img; ?>');   background-attachment: fixed;margin-top: -130px;">
      <div class="overlay"></div>
      <div class="container">
        <div class="row no-gutters slider-text align-items-end justify-content-center">
          <div class="col-md-9 ftco-animate pb-5 text-center">
            <h1 class="mb-3 bread"><?php 
             echo $aff;?></h1>
            <p class="breadcrumbs"><span class="mr-2"><a href="Accueil.php">Home <i class="ion-ios-arrow-forward"></i></a></span> <span>Foods </i></span></p>
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
                     <?php if ($getid_cat!=0) {
                $req1 = ("SELECT * from recette  where categorie_id=$getid_cat order by date ");
                   
              }
              else{
                $req1 =("SELECT * from recette  where titre LIKE '%$getid%' order by date ");
                    }
        
                $res = mysqli_query($connect,$req1);
                    while ($rec = mysqli_fetch_array($res)) :
                
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


		<br><br>
<?php 
	include("footer.php");
?>
 	</body>
 	</html>


 	