<?php  
 $connect= mysqli_connect("localhost","root","","blog"); 
 if(isset($_POST["query"]))  
 {  
      $output = '';  
      $query = "SELECT * FROM recette WHERE titre LIKE '%".$_POST["query"]."%'";  
      $result = mysqli_query($connect, $query);  
      $output = '<ul class="list-unstyled ulrech" aria-selected="false" action="click">';  
      if(mysqli_num_rows($result) > 0)  
      {  
           while($row = mysqli_fetch_array($result))  
           {  
                $output .= '<li class="rech" name ="'.$row['Id'].'">'.$row["titre"].'</li>';  
           }  
      }  
      else  
      {  
           $output .= '<li class="rech" name ="999999999">Recette n existe pas</li>';  
      }  
      $output .= '</ul>';  
      echo $output;  
 }  
 ?>  