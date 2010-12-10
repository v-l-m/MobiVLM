<?php
$version = "MobiVLM V 0.21b";
$userAgent = "MobiVLM V 0.21b";
$serveur = "www";

$dateheure_ref_gmt = mktime(
gmdate("H",time()), gmdate("i",time()), gmdate("s",time()),
gmdate("m",time()), gmdate("d",time()), gmdate("Y",time())
 );
$date_ref_gmt = mktime(
0, 0, 0,
gmdate("m",time()), gmdate("d",time()), gmdate("Y",time())
 );
$heure_ref_gmt = mktime(
gmdate("H",time()), gmdate("i",time()), gmdate("s",time()),
0, 0, 0
 );
 
$base_url = "http://".$serveur.".virtual-loup-de-mer.org/ws/boatinfo.php?forcefmt=json";
$fleet_url = "http://".$serveur.".virtual-loup-de-mer.org/ws/playerinfo/fleet.php";
//$url_actions = "actions_vlm.php";
$url_actions = "index.php";

$sep = '&amp;';
$esp = '%20%20%20%20%20%20%20%20';

$tpl_dsp_currents_infos = "<div class=\"txtbold1\" align=\"center\"><img src=\"http://www.virtual-loup-de-mer.org/flagimg.php?idflags=%s\">&nbsp;&nbsp;&nbsp;%s - %s<br>Position : %s - %s (Last VAC)</div>";

?>
