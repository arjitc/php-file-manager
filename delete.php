<?php
$filename = $_POST['filename'];
$path = $_POST['directory'];
if(file_exists($path."/".$filename)) { 
 unlink($path."/".$filename); //delete file
}
?>
