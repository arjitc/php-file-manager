<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Simple file manager</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="//netdna.bootstrapcdn.com/bootswatch/2.3.2/cosmo/bootstrap.min.css" rel="stylesheet">
    <style type="text/css">
      body {
        padding-top: 40px;
        padding-bottom: 40px;
        background-color: #f5f5f5;
      }

      .form-signin {
        max-width: 600px;
        padding: 19px 29px 29px;
        margin: 0 auto 20px;
        background-color: #fff;
        border: 1px solid #e5e5e5;
        -webkit-border-radius: 5px;
           -moz-border-radius: 5px;
                border-radius: 5px;
        -webkit-box-shadow: 0 1px 2px rgba(0,0,0,.05);
           -moz-box-shadow: 0 1px 2px rgba(0,0,0,.05);
                box-shadow: 0 1px 2px rgba(0,0,0,.05);
      }
      .form-signin .form-signin-heading,
      .form-signin .checkbox {
        margin-bottom: 10px;
      }
      .form-signin input[type="text"],
      .form-signin input[type="password"] {
        font-size: 16px;
        height: auto;
        margin-bottom: 15px;
        padding: 7px 9px;
      }

    </style>
    <link href="../assets/css/bootstrap-responsive.css" rel="stylesheet">

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="../assets/js/html5shiv.js"></script>
    <![endif]-->
  </head>

  <body>

    <div class="container">

      <form class="form-signin">
<h3>Simple PHP file manager</h3>
       <?php
$directory  = "."; 
$images = scandir($directory);
$ignore = Array(".", "..", "index.php", "delete.php");
$count=1;
echo '<table class="table table-bordered">';
foreach($images as $dispimage){
    if(!in_array($dispimage, $ignore)){
    $rawsize=filesize($dispimage)/1024;
    $truesize=sprintf('%0.2f', $rawsize);
    echo "<tr id='del$count'><td>$count</td><td><a href='http://wiki.crowncloud.net/filemanager/$dispimage'>$dispimage</td><td>$truesize KB</td><td><input type='button' class='btn btn-danger' id='delete$count' value='Delete' onclick='deleteFile(\"$dispimage\",$count,\"$directory\");'></td></tr>";
    $count++;
    }
}
echo '</table>';
?>
<script type="text/javascript" src="http://code.jquery.com/jquery-2.0.3.min.js"></script>
<script>
function deleteFile(fname,rowid,directory)
{
var x;
var r=confirm("Confirm delete?");
if (r==true)
 {
    $.ajax({ url: "delete.php",
        data: {"filename":fname,"directory":directory},
        type: 'post',
        success: function(output) {
          alert(output); 
          $("#del"+rowid).remove();
        }
    });
}
else
  {
  x="";
  }
}
</script>     
<?php
$totalSize = 0;
foreach( new DirectoryIterator('.') as $file) {
    if($file->isFile()) {
        $totalSize += $file->getSize();
    }
}
    $rawsize=$totalSize/(1024*1024);
    $truesize=sprintf('%0.2f', $rawsize);
?>
Total storage used : <?php echo $truesize; ?> MB
<hr>
 </form>
    </div> <!-- /container -->

  </body>
</html>


