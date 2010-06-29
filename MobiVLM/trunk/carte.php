<?php
include("includes/config.php");
session_start();
$RAC = $_GET['RAC'];
$map_haut = $_GET['map_haut'];
$_SESSION['map_haut']=$map_haut;
$map_larg = $_GET['map_larg'];
$_SESSION['map_larg']=$map_larg;
$map_lat = $_GET['map_lat'];
$map_lon = $_GET['map_lon'];
$IDU = $_GET['IDU'];
$heure_carte = $_GET['heure'];
$_SESSION['heure']=$heure_carte;
$zoom_carte = $_GET['zoom'];
$_SESSION['zoom']=$zoom_carte;
header("location: http://".$serveur.".virtual-loup-de-mer.org/mercator.img.php?idraces=".$RAC."&lat=".$map_lat."&long=".$map_lon."&x=".$map_larg."&y=".$map_haut."&maptype=simple&maparea=".$zoom_carte."&drawortho=no&drawwind=".$heure_carte."&drawtextwp=on&maille=5&proj=mercator&seacolor=ffffff&tracks=on&age=268&estime=100&list=mylist&boat=".$IDU."&text=right");
?>