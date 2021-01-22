<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{
  if (is_uploaded_file($_FILES['my_upload']['tmp_name'])) 
  { 
  $upload_file_name = $_FILES['my_upload']['name'];

  	//replace any non-alpha-numeric characters in th file name
  	$upload_file_name = preg_replace("/[^A-Za-z0-9 \\s\.\-_]/", '', $upload_file_name);
  	$upload_file_name=preg_replace("'/\s+/'", '', $upload_file_name);
    $dest=__DIR__.'/uploads/'.$upload_file_name;
    if (move_uploaded_file($_FILES['my_upload']['tmp_name'], $dest)) 
    {
        include('pdftotext/PdfToText.phpclass');
$fname=$dest;
		$pdf	=  new PdfToText( $fname ) ;
		$data=$pdf -> Text ;
		$path = $fname."converted.txt";
		$path1=$fname;
$file = fopen($path, "a+") or die("Unable to open file!");
fwrite($file,$data);
fclose($file);

header('Content-Type: application/octet-stream');
header("Content-Transfer-Encoding: Binary"); 
header("Content-disposition: attachment; filename=\"" . basename($path) . "\""); 
readfile($path); 
unlink( $path );
unlink($path1);
    }
  }
  else{
      
      //echo'<script>document.getElementById("hhh").innerHTML="<b>No file selected! Please select any file</b>";</script>';
  header("Location: https://nirmaltechfully.000webhostapp.com");
die();

     // echo "<center><b><p style='color:red'>No file selected! Please select any file</p><br/><a href='https://nirmaltechfully.000webhostapp.com'>Click here to go back</a></b></center>";
  }
}







            ?>