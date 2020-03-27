<?php
$bdd = new PDO('mysql:host=127.0.0.1;dbname=blog', 'root', '');
$connect= mysqli_connect("localhost","root","","blog");
if (isset($_GET['Id'])&&!empty($_GET['Id'])) {
 $getid = ($_GET['Id']);
   $reqrec = $bdd->prepare('SELECT * FROM recette WHERE Id = ?');
   $reqrec->execute(array($getid));
   $recinfos = $reqrec->fetch();
 }
 
?>

<!DOCTYPE html>
<html>
<?php 
	include("head.php");
?>
<style>
.checked {
  color: orange;
}
</style>
<body>
<?php 
	include("header.php");
?> 
  
 

    <section class="ftco-section">
      <div class="container">
        <div class="row">
          <div class="col-lg-8 order-lg-last ftco-animate">
            <h2 class="mb-3 mt-5" style="font-family: Rockwell; font-size: 50px; display: inline;"><?php echo $recinfos['titre']; ?></h2>
             <?php  $req11 = $bdd->prepare("SELECT SUM(note) , count(*) from note where Id_rec=?   ");
                    $req11->execute(array($getid) );
                    $req2 = $req11->fetch(); 
                    $moy1=0;
                    $moy=0;
                    if ($req2[1]!=0) {
                      $moy1 = $req2[0]/$req2[1];
                    } 
                    $moy=round($moy1);
                    
                    ?>
                    <div align="right">      
              <span   class="fa fa-star   <?php if($moy>=1){echo'checked';} ?>"  ></span>
              <span class="fa fa-star  <?php if($moy>=2){echo'checked';} ?>  "></span>
              <span class="fa fa-star  <?php if($moy>=3){echo'checked';} ?>  "></span>
              <span class="fa fa-star  <?php if($moy>=4){echo'checked';} ?> "></span>
              <span class="fa fa-star  <?php if($moy>=5){echo'checked';} ?> "></span> 
              <h5 style="display: inline;"><?php if($moy>0){ echo($moy.'/5');} ?> (<?php echo($req2[1] ); ?> votes)</h5>
            </div>  <!-- <div class="flex1">
                         <a href="#0" class="bttnnn">Commander <i class='fas fa-cart-arrow-down'></i></a>
                      </div> -->
  <div class="main-container" style="margin-top: 20px">
    <div class="main wrapper clearfix">
      <article>
        <section>
            <?php 
                    $req1 = $bdd->prepare("SELECT * from  recette where Id=?   ");
                    $req1->execute(array($getid));
                    $req = $req1->fetch();  
                  if($req['video']!="")
                     echo '<video  width="740" height="440" controls>
                      <source src="'.$req['video'].'" type="video/mp4"> 
                      </video>';
            ?>

          <div  style="margin-top: 20PX;" id="mygallery" class="gallery">
            <div class="images"> 
              <div class="active" style="background-image: url(<?php echo "../Admin/".$req['image']; ?>)"></div>
                 <?php
                    $req="select * from image_recette where Id_rec=$getid  ";  
                    $res = mysqli_query($connect,$req);
                    while ($rec = mysqli_fetch_array($res)) :
                 ?>
              <div style="background-image: url(<?php echo "../Admin/".$rec['image']; ?>)"></div>
              <?php endwhile; ?>
              <span class="left"></span>
              <span class="right"></span>
            </div>
            <div class="thumbs" style="background-color: #d8d6d6;">
              <?php  
              $req1 = $bdd->prepare("SELECT * from recette where Id=?  ");
                    $req1->execute(array($getid));
                    $req = $req1->fetch(); ?>
              <div class="active" style="background-image: url(<?php echo "../Admin/".$req['image']; ?>)"></div>
             <?php
                    $req="select * from image_recette where Id_rec=$getid  ";  
            $res = mysqli_query($connect,$req);
            if ($res) { 
                    while ($rec = mysqli_fetch_array($res)) :
                          
                        ?>
              <div style="background-image: url(<?php echo "../Admin/".$rec['image']; ?>)"></div>
               <?php endwhile;} ?>
            </div>
          </div>
        </section>
        </article>
      </div>
    </div>
            <h3 style="color: #fd5f00;">Ingrédients : </h3>
            <p style="margin-top: 30px; font-family: inherit; font-size: 15px;line-height:15px;"><?php echo $recinfos['ingredients']; ?></p>
             <br>
             <h3 style="color: #fd5f00">Étapes : </h3>
            <p style="margin-top: 30px; font-family: inherit; font-size: 15px; background : #efeded ;line-height:15px;" ><?php echo $recinfos['etapes']; ?></p>
            <div class="pt-5 mt-5">
             <center> 
                <!--  <div class="flex1">
                         <a href="#0" class="bttnnn">Commander <i class='fas fa-cart-arrow-down'></i></a>
                      </div> -->
            </center>
              <div class="panel">
              <div class="comment-form-wrap pt-5">
                <h3 class="mb-5">Noter la recette</h3>
                <form method ="POST" accept="POST" class="p-5 bg-light" id="note_form" >
                    <div class="form-group"  >
                      
                  <div class="form-group col-md-6">
                                
<div class="stars" >
  <form method="POST">
    <input class="star star-5" id="star-5" type="radio"  name="star" value="5" />
    <label class="star star-5" for="star-5"></label>
    <input class="star star-4" id="star-4" type="radio" name="star" value="4" />
    <label class="star star-4" for="star-4"></label>
    <input class="star star-3" id="star-3" type="radio" name="star" value="3" />
    <label class="star star-3" for="star-3"></label>
    <input class="star star-2" id="star-2" type="radio" name="star" value="2" />
    <label class="star star-2" for="star-2"></label>
    <input class="star star-1" id="star-1" type="radio" name="star" value="1" />
    <label class="star star-1" for="star-1"></label>
  </form>
</div>

                   </div>
                   <div id="display_note"></div>
                  <div class="form-group"  align="right" >
                      <input type="submit" name="submitnote" id="submit" value="Noter"  style="font-size:17px " class="btn py-3 px-5 btn-primary">
                  </div>
                </form>
  </div>
 </div>
              </div>
                <?php $reqeva = $bdd->prepare('SELECT * FROM evaluation WHERE Id_rec = ?');
                 $reqeva->execute(array($getid));
                 $eva = $reqrec->fetch(); 
                  $evaexist = $reqeva->rowCount();?>
              <h3 class="mb-5"><?php echo $evaexist;
              if ($evaexist>1) {
                echo " Commentaires";
              }else{
               echo" Commentaire";}?> </h3>
              

     <div class="panel">
              <div class="comment-form-wrap pt-5">
                <h3 class="mb-5">laissez un commentaire</h3>
                <form method ="POST" class="p-5 bg-light"id="comment_form" >
                  <div class="form-group">
                      <div class="form-group col-md-6">
                        <label for="name">Name *</label>
                        <input type="text" required name="comment_name" id="comment_name" class="form-control" placeholder="Saisir votre nom ">
                      </div>
                      <div class="form-group col-md-6">
                        <label for="name">Prenom *</label>
                        <input type="text" required name="comment_pname" id="comment_pname" class="form-control" placeholder="Saisir votre nom">
                      </div>
                  </div>
                  <div class="form-group">
                    <label for="email">Email *</label>
                    <input type="email" required class="form-control" name="email" id="email">
                  </div>
                 <input type="hidden" name="rec_id" id="rec_id" value="<?php echo($getid);?>" />

                  <div class="form-group">
                    <label for="message">Message</label>
                    <textarea required id="comment_content" name="comment_content" cols="30" rows="10" class="form-control"></textarea>
                  </div>
                  <div class="form-group">
                    <input type="hidden" name="comment_id" id="comment_id" value="0" />
                    <input type="submit" name="submit" id="submit" value="Commenter" class="btn py-3 px-4 btn-primary">
                  </div>

                </form>
              </div>
</div>
   <span id="comment_message"></span>
   <br />
   <div id="display_comment"></div>               
             </div>

          </div> <!-- .col-md-8 -->
          <div class="col-lg-4 sidebar pr-lg-5 ftco-animate">
 
 
            <div class="sidebar-box ftco-animate" style="background-color: #ffffffb3; margin-top: 90px">
              <ul class="categories">
                <h3 class="heading mb-4">Categories</h3>
                <?php
                    $req="select * from categories ";  
                    $res = mysqli_query($connect,$req);
                    while ($rec = mysqli_fetch_array($res)) :
                          
                $nbr = $bdd->prepare("SELECT * FROM recette WHERE categorie_id = ?  ");
                $nbr->execute(array($rec['Id']));
                $nbr1 = $nbr->rowCount();
                        ?>
                <li><a href="<?php echo "foods.php?Id_cat=".$rec['Id'] ?>"> <?php echo $rec['categorie']; ?> <span><?php echo $nbr1; ?></span></a></li>
               
                 <?php
                    endwhile; 
                  ?>
              </ul>
            </div>

            <div class="sidebar-box ftco-animate" style="background-color: #ffffffb3;">
              <h3 class="heading mb-4">Posts Récents</h3>

              <?php $req1="select * from recette order by date DESC LIMIT 3  ";
                              $res1 = mysqli_query($connect,$req1);
                          while ($rec = mysqli_fetch_array($res1)) :
                               $reqcat=$bdd->prepare("select * from categories where Id=?");
                               $reqcat->execute(array($rec['categorie_id']));
                               $catinfo = $reqcat->fetch(); 
                        ?>
              <div class="block-21 mb-4 d-flex">
                <a class="blog-img mr-4" href="<?php echo"single.php?Id=".$rec['Id'];?>"   style="background-image: url(<?php echo "../Admin/".$rec['image']; ?>);"></a>
                <div class="text">
                  <h3><a href="<?php echo"single.php?Id=".$rec['Id'];?>" ><?php echo $rec['titre']; ?></a></h3>
                  <div class="meta">
                    <div><a href="<?php echo"single.php?Id=".$rec['Id'];?>" ><span class="icon-calendar"></span> <?php echo substr($rec['date'],0,10); ?></a></div>
                    <div><a href="<?php echo"single.php?Id=".$rec['Id'];?>" ><i class="fa fa-list-alt" aria-hidden="true"></i> <?php echo $catinfo['categorie']; ?></a></div>
                     
                  </div>
                </div>
              </div>
             <?php
                          endwhile;
                        ?>
            
            </div>
     <div class="sidebar-box ftco-animate" style="background-color: #ffffffb3;">
              <h3 class="heading mb-4">Recent Events</h3>

              <?php $req1="select * from events order by datee LIMIT 3 ";
                              $res1 = mysqli_query($connect,$req1);
                          while ($rec = mysqli_fetch_array($res1)) :
                               
                        ?>
              <div class="block-21 mb-4 d-flex">
                <a class="blog-img mr-4" href="<?php echo"single.php?Id=".$rec['Id'];?>"   style="background-image: url(<?php echo "../Admin/".$rec['image']; ?>);"></a>
                <div class="text">
                  <h3><a href="<?php echo"single.php?Id=".$rec['Id'];?>" ><?php echo $rec['nom']; ?></a></h3>
                  <div class="meta">
                    <div><a href="<?php echo"single.php?Id=".$rec['Id'];?>" ><span class="icon-calendar"></span> <?php echo $rec['datee']; ?></a></div>
                    <div><a href="<?php echo"single.php?Id=".$rec['Id'];?>" ><i class='fas fa-map-marker-alt' style='color :#999999 ;'></i> <?php echo $rec['lieu']; ?></a></div>
                     
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
    </section> <!-- .section -->
    <script type="text/javascript">
 $(document).ready(function(){  
   $('#note_form').on('submit', function(event){
  event.preventDefault();
var note = $('#raiting').attr('name');
 var radioValue = $("input[name='star']:checked").val();
 var id = $('#rec_id').attr('value');         
 $.ajax({
   url:"note.php",
   method:"POST",
   data:{note:radioValue,index:id},
   dataType:"JSON",
   success:function(data)
   { if(data.error != '')
    {
  
    $('#display_note').html(data.error);
   
    }
    }
   
  })
 });


 $('#comment_form').on('submit', function(event){
  event.preventDefault();
  var form_data = $(this).serialize();
  $.ajax({
   url:"add_comment.php",
   method:"POST",
   data:form_data,
   dataType:"JSON",
   success:function(data)
   {
    if(data.error != '')
    {
     $('#comment_form')[0].reset();
     $('#comment_message').html(data.error);
     $('#comment_id').val('0');
     load_comment();
    }
   }
  })
 });

 load_comment();

 function load_comment()
 {var id = $('#rec_id').attr('value'); 
  $.ajax({
   url:"fetch_comment.php",
   method:"POST",
   data:{index:id},
   success:function(data)
   {
    $('#display_comment').html(data);
   }
  })
 }

 $(document).on('click', '.reply', function(){
  var comment_id = $(this).attr("id");
  $('#comment_id').val(comment_id);
  $('#comment_name').focus();
 });
 
});
 
 
</script>
   
  <script src="bower_components/hammerjs/hammer.min.js"></script>
  <script src="dist/js/gallery.min.js"></script>
  <script src="dist/js/main.min.js"></script>

<?php 
	include("footer.php");
?>
 	</body>
 	</html>