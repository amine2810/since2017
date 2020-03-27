
<?php

//add_comment.php

$connect = new PDO('mysql:host=localhost;dbname=blog', 'root', '');

$error = '';
$comment_name = '';
$comment_content = '';

if(empty($_POST["comment_name"]))
{
 $error .= '<p class="text-danger">Name is required</p>';
}
else
{
 $comment_name = $_POST["comment_name"];
 $comment_pname=$_POST["comment_pname"];
 $email=$_POST["email"];
 $Id=$_POST["rec_id"];
}

if(empty($_POST["comment_content"]))
{
 $error .= '<p class="text-danger">Comment is required</p>';
}
else
{
 $comment_content = $_POST["comment_content"];

}

if($error == '')
{
 $query = "
 INSERT INTO evaluation 
 (Id_pere, commentaire, nom , prenom , email , Id_rec) 
 VALUES (:parent_comment_id, :comment, :comment_sender_name , :comment_sender_pname ,:email, :Id)
 ";
 $statement = $connect->prepare($query);
 $statement->execute(
  array(
   ':parent_comment_id' => $_POST["comment_id"],
   ':comment'    => $comment_content,
   ':comment_sender_name' => $comment_name,
   ':comment_sender_pname' => $comment_pname,
   ':email' => $email,
   ':Id' => $Id
  )
 );
 $error = '<label class="text-success">Comment Added</label>';
}

$data = array(
 'error'  => $error
);

echo json_encode($data);

?>