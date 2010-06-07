<?php
session_start();
include("includes/config.php");

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

//header("location: http://".$serveur.".virtual-loup-de-mer.org/mercator.img.php?idraces=".$RAC."&lat=".$map_lat."&long=".$map_lon."&x=".$map_larg."&y=".$map_haut."&maptype=simple&maparea=".$zoom_carte."&drawortho=no&drawwind=".$heure_carte."&drawtextwp=on&maille=5&proj=mercator&seacolor=ffffff&tracks=on&age=268&estime=100&list=mylist&boat=".$IDU."&text=right");
$url_img = "http://".$serveur.".virtual-loup-de-mer.org/mercator.img.php?idraces=".$RAC."&lat=".$map_lat."&long=".$map_lon."&x=".$map_larg."&y=".$map_haut."&maptype=simple&maparea=".$zoom_carte."&drawortho=no&drawwind=".$heure_carte."&drawtextwp=on&maille=5&proj=mercator&seacolor=ffffff&tracks=on&age=268&estime=100&list=mylist&boat=".$IDU."&text=right";

if($heure_carte<72)
{ $newheure = $heure_carte+1; } else { $newheure = $heure_carte; }

$new_query_string = array('onglet'=>$_GET['onglet'],
							'RAC'=>$RAC,
							'map_lat'=>$map_lat,
							'map_lon'=>$map_lon,
							'IDU'=>$IDU,
							'map_haut'=>$map_haut,
							'map_larg'=>$map_larg,
							'heure'=>$newheure,
							'zoom'=>$zoom_carte);

$new_query_string = http_build_query($new_query_string);

?>
<!DOCTYPE html PUBLIC "-//WAPFORUM//DTD XHTML Mobile 1.1//EN" "http://www.openmobilealliance.org/tech/DTD/xhtml-mobile11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?php echo $version; ?></title>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
<meta http-equiv="Cache-Control" content="public"/>
<link href="css/styles.css" rel="stylesheet" type="text/css" />
</head>
<body>
<input name="retour" type="button" onclick="javascript:document.location='index.php?onglet=<?php echo $_GET['onglet']; ?>';" value="Retour" class="txtbold1" /> - </input>Météo Heure H +<?php echo $newheure-1; ?> - <input name="plus" type="button" onclick="javascript:document.location='carte.php?<?php echo $new_query_string; ?>';" value="+1 heure" class="txtbold1" /> (maxi 72 heures)
<img src="<?php echo $url_img; ?>"></img>
<?php // echo $_SERVER['QUERY_STRING']; ?>
</body>
</html>
