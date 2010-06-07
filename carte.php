<?php
$RAC = $_GET['RAC'];
$map_lat = $_GET['map_lat'];
$map_lon = $_GET['map_lon'];
$IDU = $_GET['IDU'];
$heure_carte = $_GET['heure'];
$zoom_carte = $_GET['zoom'];
$serveur = $_GET['serveur'];
header("location: http://".$serveur.".virtual-loup-de-mer.org/mercator.img.php?idraces=".$RAC."&lat=".$map_lat."&long=".$map_lon."&x=480&y=640&maptype=simple&maparea=".$zoom_carte."&drawortho=no&drawwind=".$heure_carte."&drawtextwp=on&maille=5&proj=mercator&seacolor=ffffff&tracks=on&age=268&estime=100&list=mylist&boat=".$IDU."&text=right");

?>
