
             <?php  $req11 = $bdd->prepare("SELECT SUM(note) , count(*) from note where Id_rec=?   ");
                    $req11->execute(array($getid) );
                    $req2 = $req11->fetch();
                    $req3 = $bdd->prepare("SELECT SUM(note) , count(*) from evaluation where Id_rec=?   ");
                    $req3->execute(array($getid) );
                    $req31 = $req3->fetch(); 
                    $moy2=0;
                    $moy1=0;
                    if ($req2[1]!=0) {
                      $moy1 = $req2[0]/$req2[1];
                    }
                    if ($req31[1]!=0) {
                      $moy2=$req31[0]/$req31[1];
                    }
                    $moy = ($moy1+$moy2)/2; 
                    $moy=round($moy);
                         
            $output .= '            <span class="fa fa-star   <?php if($moy>=1){echo'checked';} ?>  "></span>
              <span class="fa fa-star  <?php if($moy>=2){echo'checked';} ?>  "></span>
              <span class="fa fa-star  <?php if($moy>=3){echo'checked';} ?>  "></span>
              <span class="fa fa-star  <?php if($moy>=4){echo'checked';} ?> "></span>
              <span class="fa fa-star  <?php if($moy>=5){echo'checked';} ?> "></span>
              <h5><?php if($moy>0){ echo($moy.'/5');} ?> (<?php echo($req2[1]+$req31[1]); ?> votes)</h5>;
echo $output;   
  