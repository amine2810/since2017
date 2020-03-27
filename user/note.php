
<?php

//add_comment.php

$connect = new PDO('mysql:host=localhost;dbname=blog', 'root', '');
$id=$_POST["index"];
$error = '';

if(empty($_POST["note"]))
{
 $error .= '<p class="text-danger">Noter la recette avant</p>';
}
else
{
 $note=$_POST["note"];
}

if($error == '')
{
 		 
 $query = "
 INSERT INTO note
 (Id_rec,note) 
 VALUES (:id,:note)
 ";
 $statement = $connect->prepare($query);
 $statement->execute(
  array( 
   ':id'=>$id,
   ':note'=>$note
  )
 );
 $error = '<label   style="margin-top : 20px; color:black;">Note : '.$note.'/5 </label>';
} 
$data = array(
 'error'  => $error
);

echo json_encode($data);

?> 