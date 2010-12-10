<?php
include("includes/config.php");
session_start();
$RAC = $_GET['RAC'];
$map_haut = $_GET['map_haut'];
$_SESSION['map_haut']=$map_haut;
setcookie("map_haut", $map_haut, time()+2419200); 
$map_larg = $_GET['map_larg'];
$_SESSION['map_larg']=$map_larg;
setcookie("map_larg", $map_larg, time()+2419200); 
$map_lat = $_GET['map_lat'];
$map_lon = $_GET['map_lon'];
$IDU = $_GET['IDU'];
$heure_carte = $_GET['heure'];
$_SESSION['heure_carte']=$heure_carte;
setcookie("heure_carte", $heure_carte, time()+2419200); 
$zoom_carte = $_GET['zoom'];
$_SESSION['zoom']=$zoom_carte;
setcookie("zoom", $zoom, time()+2419200); 
$estime = $_GET['estime'];
$_SESSION['$estime']=$estime;
setcookie("estime", $estime, time()+2419200); 
/*

myboat
my5opps
my10opps
meandtop10
mylist
*/
$list = $_GET['list'];
$_SESSION['list']=$list;
setcookie("list", $list, time()+2419200); 

header("location: http://".$serveur.".virtual-loup-de-mer.org/mercator.img.php?idraces=".$RAC."&lat=".$map_lat."&long=".$map_lon."&x=".$map_larg."&y=".$map_haut."&maptype=simple&maparea=".$zoom_carte."&drawortho=no&drawwind=".$heure_carte."&drawtextwp=on&maille=5&proj=mercator&seacolor=ffffff&tracks=on&age=268&estime=".$estime."&list=".$list."&boat=".$IDU."&text=right");
?>