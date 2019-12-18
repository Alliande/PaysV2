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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Hello World !</title>
</head>

<header>

<div class="jumbotron change" )>
  <h1 class="display-4">Hello, world!</h1>
  
  <hr class="my-4">
  <p>ce site vous permet d'accéder aux fiches de 250 pays à travers le monde. </br> Cliquez simplement sur le drapeau et commencez votre voyage !</p>
 
</div>


</header>

<body>
    

<?php 


$api = json_decode(file_get_contents('https://restcountries.eu/rest/v2/all'));



foreach ($api as $key=>$value)

{

    echo "<a href='Detail_pays.php?cle=".$key."'target='_blank'><img src=".$value->flag." class='images_petit'></a>           ";

    
}


//var_dump($api);




?>




</body>
</html>