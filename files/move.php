<?php
if($_FILES['uplod']){
    $path=$_FILES['uplod']['name'];
    $uplod_path="/files/move/".$path;
    move_uploaded_file($_FILES['uplod']['tmp_name'],$uplod_path || die("Path not found"));
    echo "file uploded successful";
}
?>