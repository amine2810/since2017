<?php
$connect= mysqli_connect("localhost","root","","blog");
$bdd = new PDO('mysql:host=127.0.0.1;dbname=blog', 'root', '');
if(isset($_GET['Id_rec']) AND $_GET['Id_rec'] > 0) {
   $getid_rec = intval($_GET['Id_rec']);
   $reqrec = $bdd->prepare('SELECT * FROM image_recette WHERE Id_rec = ?');
   $reqrec->execute(array($getid_rec));
   $res = $reqrec->fetchAll();
}
if (isset($_GET['Id'])&&!empty($_GET['Id'])) {
    $getid = intval($_GET['Id']);
}

if (isset($_GET['delete'])&&!empty($_GET['delete'])) {
    $delete_Id=intval($_GET['delete']);
    $sup1=$bdd->prepare("SELECT image from image_recette where Id =?");
    $sup1->execute(array($delete_Id));
    $sup=$sup1->fetch();
    unlink($sup[0]);
    $sql="DELETE From image_recette WHERE Id ='$delete_Id'";
    $bdd->query($sql);
    header("Location: add_images.php?Id=".$getid."&Id_rec=".$getid_rec);
} 

if(isset($_POST['submit'])){
    // Include the database configuration file
    $db = new PDO('mysql:host=127.0.0.1;dbname=blog', 'root', '');
    // File upload configuration
    $targetDir = "images/foods/";
    $allowTypes = array('jpg','png','jpeg','gif','PNG','JPG','JPEG');
    
    $statusMsg = $errorMsg = $insertValuesSQL = $errorUpload = $errorUploadType = '';
    if(!empty(array_filter($_FILES['files']['name']))){
        foreach($_FILES['files']['name'] as $key=>$val){
            // File upload path
            $fileName = basename($_FILES['files']['name'][$key]);
            $targetFilePath = $targetDir . $fileName;
            $targetFilePath=str_replace(' ','-',$targetFilePath); 
            // Check whether file type is valid
            $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
            if(in_array($fileType, $allowTypes)){
                // Upload file to server
                if(move_uploaded_file($_FILES["files"]["tmp_name"][$key], $targetFilePath)){
                    // Image db insert sql
                    $insertValuesSQL .= "('".$fileName."', NOW()),";
                }else{
                    $errorUpload .= $_FILES['files']['name'][$key].', ';
                }
            }else{
                $errorUploadType .= $_FILES['files']['name'][$key].', ';
            }
        
            $chemin="images/foods/".$_FILES['files']['name'][$key];
            $chemin=str_replace(' ','-',$chemin); 
            $insert = $db->prepare("INSERT INTO image_recette (image, id_rec) VALUES (?,?)");
            $insert->execute(array($chemin,$getid_rec));   

            if($insert){
                $errorUpload = !empty($errorUpload)?'Upload Error: '.$errorUpload:'';
                $errorUploadType = !empty($errorUploadType)?'File Type Error: '.$errorUploadType:'';
                $errorMsg = !empty($errorUpload)?'<br/>'.$errorUpload.'<br/>'.$errorUploadType:'<br/>'.$errorUploadType;
                $statusMsg = "Files are uploaded successfully.".$errorMsg;
            }else{
                $statusMsg = "Sorry, there was an error uploading your file.";
            }}
        }else{
        $statusMsg = 'Please select a file to upload.';
    }
 header("Location: add_images.php?Id=".$getid."&Id_rec=".$getid_rec);

    }
    
    // Display status message
 //   echo $statusMsg;
            ?>

<!DOCTYPE html>
<html>
<head>
    <?php 
    include("Admin_head.php");
?>
</head>
<body>
<?php 
 include("Admin_header.php"); 
?>
<body>

                <div>
              <form  method="post" enctype="multipart/form-data">
                <br><br><br><br><br>
                <label style="font-size: 20px; color: white">Selectionner des images</label> 
                <input type="file" name="files[]" multiple >
                <input type="submit" name="submit" value="UPLOAD">
          </form>
        </div>

<center>
    <div class="col-md-8 mt-100">
        <table class="table table-bordered table-striped" style="margin-top: 10px">
    <thead >
      
        
        <th>
            Image
        </th>
    <th>
            Date
        </th>
        <th>
            
        </th>
    </thead> 
    <tbody>
        <?php 
            foreach($res as $image)
            {
        ?>
        <tr>
               
 
            <td>
                <img style="width: 200px; height: 200px" src=" <?php  
                        echo $image['image'] ; ?>" >
            </td>
            <td>
                <a href="add_images.php?Id=<?=$getid;?>&Id_rec=<?=$image['id_rec'];?>&delete=<?=$image['Id'];?>" class="btn btn-xs btn-default"> <i class="fa fa-trash"> </i> </a>
            </td>
        </tr>
        <?php  } ?>
 </tbody>
    </table></div></center>

</body>
</html>