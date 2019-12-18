<?php
session_start();
$_SESSION['pays']['Cle']= array();
$_SESSION['pays']['Cle']['Code']=array();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="Style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css"
   integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ=="
   crossorigin=""/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge">


     <!-- Make sure you put this AFTER Leaflet's CSS -->
 <script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js"
   integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew=="
   crossorigin=""></script>
    <title>Document</title>

</head>
<header>

<?php

// Il me manque un bouton de retour au départ


$api = json_decode(file_get_contents('https://restcountries.eu/rest/v2/all'));


foreach ($api as $key=>$value)

{
array_push ($_SESSION['pays']['Cle'], $key);
array_push ($_SESSION['pays']['Cle']['Code'],$value->alpha3Code);
  
}

?>
<div class='jumbotron change' >
<div class='d-flex justify-content-between'>
    <!-- Répartit le contenu de façon centrée sur la page -->
<div class='p-2 bd-highlight '>
<!-- Box du globe tournant -->    
<img src='terre.gif'height = 110px></div>
<div class='p-2 bd-highlight'>
<!-- Box dy pays -->   
<h1> Pays : <?php echo $api[$_GET['cle']]->name ?> </h1></div
><div class='p-2 bd-highlight'>
<!-- Box du drapeau du pays -->       
<img src= <?php echo $api[$_GET['cle']]->flag ?> class='images_petit'></div>
</div></br><hr class='my-4'>
<p>Retrouvez le détail de la fiche du pays : <?php echo $api[$_GET['cle']]->name ?></p></div>

</header>


<body>

<!-- Ligne Continent -->
<div class="d-flex justify-content-center"><div  class='d-flex align-items-center'><div class='d-flex justify-content-start'>
<!-- Box image du continent -->    
<div class='p-2 bd-highlight '>   
<img src= <?php echo $api[$_GET['cle']]->region ?>.jpg width : 100px height = 60 px></div>
<!-- Box titre continent --> 
<div class='p-2 bd-highlight '>
  <h2> Continent : </h2></div>
<!-- Box nom du continent --> 
<div class='p-2 bd-highlight '>  
<p> <?php echo $api[$_GET['cle']]->region ?></p></div></div></div></div></br>


<!-- Ligne Capitale -->
<div class="d-flex justify-content-center"><div class='d-flex align-items-center'><div class='d-flex justify-content-start'>
<div class='p-2 bd-highlight '>
<!-- Box icone Capitale --> 
<img src = 'Capitale.jpg' width = 80 px height = 60 px></div>
<div class='p-2 bd-highlight '>
<!-- Box titre Capitale --> 
<h2> Capitale : </h2></div>
<div class='p-2 bd-highlight '>
<!-- Box nom Capitale --> 
<p><?php echo $api[$_GET['cle']]->capital ?></p></div></div></div></div></br>

<!-- Ligne Population -->
<div class="d-flex justify-content-center"><div class='d-flex align-items-center'><div class='d-flex justify-content-start'>
<div class='p-2 bd-highlight '>
<!-- Box icone Population--> 
<img src= 'population.png' width = 70 px height = 60 px></div>
<div class='p-2 bd-highlight '>
<!-- Box Titre Population --> 
<h2> Population : </h2></div>
<div class='p-2 bd-highlight '>
<!-- Box nombre d'habitants --> 
<p> <?php echo number_format($api[$_GET['cle']]->population,0,'1',' ') ?> habitants.</p></div></div></div></div></br>

<!-- Ligne Superficie -->
<div class="d-flex justify-content-center"><div class='d-flex align-items-center'><div class='d-flex justify-content-start'>
<div class='p-2 bd-highlight '>
<!-- Box icone Surface --> 
<img src = 'surface.png' width = 60 px height = 60 px></div>
<div class='p-2 bd-highlight '>
<!-- Box titre surface --> 
<h2> Superficie : </h2></div>
<div class='p-2 bd-highlight '>
<!-- Box surface --> 
<p> <?php  echo number_format($api[$_GET['cle']]->area,0,'1',' ')?> km2.</p></div></div></div></div></br>

<?php
$latitude = $api[$_GET['cle']]->latlng[0];
$longitude = $api[$_GET['cle']]->latlng[1];



if(empty($api[$_GET['cle']]->borders))
{
    echo "<div class='d-flex align-items-center'><div class='d-flex justify-content-start'><h2>Pays frontaliers : </h2><p>Ce pays est une île et ne comporte pas de frontières terrestres directes.</div></div></p>";
}

else

{ 

echo "<div class='p-2 bd-highlight '><h2>Pays frontaliers : </div></h2>";

echo "<div class='d-flex flex-wrap'>";

foreach ($api[$_GET['cle']]->borders as $key=>$value)

{

    $CleFrontiere = array_search ($value,$_SESSION['pays']['Cle']['Code']);
    $cleLien = array_keys($_SESSION['pays']['Cle']['Code'], $value);

    echo "<a href='Detail_pays.php?cle=".$cleLien[0]."'target='_blank'><img src=".$api[$CleFrontiere]->flag." class='images_petit'></a>";
    
}

echo "</div>";

}
// et maintenant l'API carte

?>
</br>

<div class='p-2 bd-highlight '><h2>Carte :  </h2></div>
</br>


<div id="mapid">


</div>

<script>

    var mymap = L.map('mapid').setView([<?php echo $latitude.", ".$longitude; ?>], 7);

    L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(mymap);


</script>



</body>
</html>