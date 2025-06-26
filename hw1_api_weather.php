<?php
// WEATHER_API

$weather_key = "64b9a8143485484d81c124008222905";
$weather_url = 'http://api.weatherapi.com/v1/';


$curl = curl_init();


$q = $_GET["luogo"];


curl_setopt($curl, CURLOPT_URL, "http://api.weatherapi.com/v1/current.json?key=64b9a8143485484d81c124008222905&q=".$q."&aqi=no");
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

$result = curl_exec($curl);

curl_close($curl);


echo $result;
?>