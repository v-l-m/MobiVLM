<?php
$version = "MobiVLM V 0.2";
$userAgent = "IE 7 - Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1; .NET CLR 1.1.4322; .NET CLR 2.0.50727; .NET CLR 3.0.04506.30)";
$serveur = "testing";

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
//$url_actions = "actions_vlm.php";
$url_actions = "index.php";

$sep = '&amp;';
$esp = '%20%20%20%20%20%20%20%20';

$tpl_dsp_currents_infos = "<div class=\"txtbold1\" align=\"center\"><img src=\"http://www.virtual-loup-de-mer.org/flagimg.php?idflags=%s\">&nbsp;&nbsp;&nbsp;%s - %s<br>Position : %s - %s (Last VAC)</div>";

?>
