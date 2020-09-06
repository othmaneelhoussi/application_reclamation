<?php

$servername ="localhost"; //a changer selon le serveur !!!
$dBUsername ="root";
$dBPassword = "";
$dBName = "application_reclamation";

$conn = mysqli_connect($servername, $dBUsername, $dBPassword, $dBName);


if (!$conn){
    die("Connection failed: ".mysqli_connect_error());
}