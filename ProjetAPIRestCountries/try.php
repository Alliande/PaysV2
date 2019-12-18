<?php

var_dump ($_GET);


$api = json_decode(file_get_contents("https://restcountries.eu/rest/v2/name/".$_GET['name']));

var_dump ($api);

echo $api[0]->name;
echo $api[0]->capital;

?>

