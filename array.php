<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    


</body>
</html>
<?php

$user = [
    ["shailesh", "gond", "shailesh@gmail.com"],
    ["vishal", "gond", "vishal@gmail.com"],
    ["rohan", "devdhar", "rohan@gmail.com"],
    ["lucky", "bholsekar", "lucky@gmail.com"],
    ["sangam", "shinde", "sangam@gmail.com"],
];

echo"<table border='5'>";
for($i=0;$i<count($user); $i++){
    echo"<tr>";
    for($j=0; $j<count($user[$i]);$j++){
        echo"<td>";
        echo$user[$i][$j];
        echo"</td>";
    }
    echo"</tr>";
}
echo"</table><br><br><br><br><br>";



$assuser = [
    ["name"=>"shailesh" , "surname"=>"gond",      "email"=> "shailesh@gmail.com"],
    ["name"=>"vishal",    "surname"=>"gond",      "email"=> "vishal@gmail.com"],
    ["name"=>"rohan",     "surname"=>"devdhar",   "email"=> "rohan@gmail.com"],
    ["name"=>"lucky",     "surname"=>"bholsekar", "email"=> "lucky@gmail.com"],
    ["name"=>"sangam",    "surname"=>"shinde",    "email"=> "sangam@gmail.com"]
];

echo"<table border='5'>";
foreach($assuser as $key=>$entries){
    echo"<tr>";
   foreach($entries as $item){
    echo"<td>";
    echo $item;
    echo"</td>";
   }
   echo"</tr>";
}
echo"</table>";


    $arr=["shailesh" , "gond", "shailesh@gmail.com"]; //created an sd array
    print_r($arr)   ;
    array_push($arr,8858,"tybca",);//two values added by using push function
    echo"<br>";
    print_r($arr);
    echo"<br>";

    array_splice($arr,-3);// three element removed from the array
    echo"<br>";

    print_r($arr);// Array printed After the Remving values

    echo"<br>";
    //type casting or casting

    $a=100;
    $a=(string)$a;//number to string
    var_dump($a);
    echo"<br>";

    $b="true";      
    $b=(string)$b;
    var_dump($b);
    echo"<br>";

    $c=100;
    $c=(string)$c;
    var_dump($c);
    echo"<br>";


?>