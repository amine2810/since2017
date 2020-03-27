
<?php

//fetch_comment.php

$connect = new PDO('mysql:host=localhost;dbname=blog', 'root', '');
$Id=$_POST['index'];
$query = "
SELECT * FROM evaluation  
WHERE Id_pere =0 and Id_rec =? 
ORDER BY datetime DESC
";

$statement = $connect->prepare($query);

$statement->execute(array($Id));

$result = $statement->fetchAll();
$output = '';
foreach($result as $row)
{
 $output .= '
 <div class="panel panel-default">
  <div class="panel-heading">By <b>'.$row["nom"].' '.$row['prenom'].'</b> on <i>'.$row["datetime"].'</i></div>
  <div class="panel-body">'.$row["commentaire"].'</div>
  <div class="panel-footer" align="right"><button type="button" class="btn btn-default reply" id="'.$row["Id"].'">Reply</button></div>
 </div>
 ';
 $output .= get_reply_comment($connect, $row["Id"]);
}

echo $output;

function get_reply_comment($connect, $parent_id = 0, $marginleft = 0)
{
 $query = "
 SELECT * FROM evaluation WHERE Id_pere = '".$parent_id."'
 ";
 $output = '';
 $statement = $connect->prepare($query);
 $statement->execute();
 $result = $statement->fetchAll();
 $count = $statement->rowCount();
 if($parent_id == 0)
 {
  $marginleft = 0;
 }
 else
 {
  $marginleft = $marginleft + 48;
 }
 if($count > 0)
 {
  foreach($result as $row)
  {
   $output .= '
   <div class="panel panel-default" style="margin-left:'.$marginleft.'px">
    <div class="panel-heading">By <b>'.$row["nom"].' '.$row["prenom"].'</b> on <i>'.$row["datetime"].'</i></div>
    <div class="panel-body">'.$row["commentaire"].'</div>
    <div class="panel-footer" align="right"><button type="button" class="btn btn-default reply" id="'.$row["Id"].'">Reply</button></div>
   </div>
   ';
   $output .= get_reply_comment($connect, $row["Id"], $marginleft);
  }
 }
 return $output;
}

?>