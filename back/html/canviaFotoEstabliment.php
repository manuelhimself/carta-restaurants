<?php
if (isset($_FILES['file']['name']) && isset($_REQUEST['filename'])) {
   $filename = $_FILES["file"]["name"];
   $file_basename = substr($filename, 0, strripos($filename, '.')); // get file extention
   $file_ext = substr($filename, strripos($filename, '.')); // get file name
   $allowed_file_types = array('.jpg');
   $newfilename = $_REQUEST['filename'];
   $dir = "/images/establiment/";

   if (in_array($file_ext, $allowed_file_types)) {
      if (move_uploaded_file($_FILES["file"]["tmp_name"],  getcwd() . $dir . $newfilename)) {
         header("Location: index.php");
      };
   } elseif (empty($file_basename)) {

      // file selection error
      echo "Please select a file to upload.";
   } elseif ($_FILES["file"]["size"] > 3000000) {

      // file size error
      echo "The file you are trying to upload is too large.";
   } else {

      // file type error
      echo "Only these file typs are allowed for upload: " . implode(', ', $allowed_file_types);
      unlink($_FILES["file"]["tmp_name"]);
   }
}
