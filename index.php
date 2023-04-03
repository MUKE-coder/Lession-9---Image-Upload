<?php
if(isset($_FILES['image']) && $_FILES['image']['error']==0){
  // Check if the Uploads folder exists
  // print_r($_FILES['image']);
  if(!file_exists('Uploads')){
    mkdir('Uploads');
  } 
  // Generate Unique filename
  $temp_name =$_FILES['image']['tmp_name'];
  $name =uniqid()."_".$_FILES['image']['name'];
  $path ="Uploads/".$name;
 
  // Check for Image Size
  $image_size =$_FILES['image']['size'];
  if($image_size >1048576){
    echo "Image size should be Less than 1 MB";
  }else{
    // Other Checks
    // Get the image file type
    $image_type =$_FILES["image"]["type"];
    $allowed_extensions = array("webp", "png", "jpg", "jpeg");
    $image_extension = strtolower(pathinfo($name, PATHINFO_EXTENSION));
      // print_r($image_extension);
      // -check for image type and check for image extension

      if(($image_type=="image/webp" ||$image_type=="image/png" || $image_type=="image/jpg" || $image_type=="image/jpeg") && (in_array($image_extension,$allowed_extensions))){
        //Move the image into Uploads folder
        move_uploaded_file($temp_name,$path);
        echo "Image Uploaded Successfully";
        // Save the Image to the Database=> image pATH
      }else{
        echo "Invalid Image, Image should be of type webp, png, jpg, jpeg";
      }
  }
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>

<body>
  <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST" enctype="multipart/form-data">
    <input type="file" name="image">
    <input type="submit" value="Upload">
  </form>
  <?php if(isset($path)){ ?>
  <img width="200" height="200" src="<?php echo $path ?>" style="border-radius:50%;" alt="">
  <?php }?>
</body>

</html>