<?php
session_start();
$_session['pays']= array();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="Style.css">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    

<?php 


$api = json_decode(file_get_contents('https://restcountries.eu/rest/v2/all'));



foreach ($api as $key=>$value)

{

    echo "<a href='try.php?name=".$value->name."'><img src=".$value->flag." class='images_petit'></a>           ";

    
}


//var_dump($api);




?>




</body>
</html>