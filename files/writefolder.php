<?php
//creating file using taking input from user and save that file at perticular loacation
if(isset($_POST['file'])){
$filename="../uplods/".$_POST['file'];

$name=$_POST['name'];

$file= fopen($filename,"w") OR die("unable to create file");

fwrite($file,$name);

fclose($file);
echo"file created successful with inputed data";
}
?>