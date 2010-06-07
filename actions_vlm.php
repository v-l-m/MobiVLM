<?php
/* ***************************************************************
Script qui pousse les ordres vers VLM
!! est très sensible à la façon dont PHP et CURL sont configurés ! 
****************************************************************** */
$serveur_vlm = "s11";
include("fonctions_vlm.php");
session_start();

$pseudo = str_replace(" ", "%20",$_SESSION['pseudo']);
$pseudo_curl = $_SESSION['pseudo'];
$password = $_SESSION['password'];
$IDU = $_SESSION['IDU'];

$event = $_GET['event'];
$onglet = $_GET['onglet'];

define('LOGIN', $pseudo_curl);
define('PASSWORD', $password);
define('LANG', 'fr');
define('TYPE', 'login');

define('AUTHENTIFICATION', 'http://'.$serveur_vlm.'.virtual-loup-de-mer.org/myboat.php');

//AUTHENTIFICATION
$ch = curl_init(AUTHENTIFICATION);
curl_setopt($ch, CURLOPT_POST, TRUE);
curl_setopt($ch, CURLOPT_POSTFIELDS,
    array(
        'pseudo' => LOGIN,
        'password' => PASSWORD,
		'lang' => LANG,
		'type' => TYPE
    )
);
curl_setopt($ch, CURLOPT_COOKIEJAR, './tmp/cookie-'.$IDU.'.txt');
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
curl_setopt($ch, CURLOPT_COOKIESESSION, TRUE);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
$ret = curl_exec($ch);
echo $ret;
if ($ret === FALSE) {
    die(curl_error());
}
curl_close($ch);

// RECUPERATION DE LA SESSION
//chmod('tmp/cookie-'.$IDU.'.txt',0777);
if (!$fp = @fopen('tmp/cookie-'.$IDU.'.txt','rb')) 
	{
	echo "Echec de l'ouverture du fichier";
	exit;
	}
	else 
	{
		while(!feof($fp)) 
			{
		
			$Ligne = fgets($fp,255);
			//echo $Ligne."<br>";
				if (preg_match('/(PHPSESSID'.chr(9).'[0-9a-z,-]{32,40})/i', $Ligne, $m)) 
				{
				$sid = '&' . $m[1];
				$sid = str_replace(chr(9),"=",$sid);
				//echo "La variable de session sera => ".$sid."<br>";
				}
			}
		fclose($fp); // On ferme le fichier
	}

// MAJ WP
if($event=="newwp") {
$nextwplat = format_query($_GET['lat']);
$nextwplon = format_query($_GET['lon']);
$targetandhdg = format_query($_GET['targetandhdg']); // def -1
$andhdg = format_query($_GET['andhdg']); // def off
$url_vlm = "http://".$serveur_vlm.".virtual-loup-de-mer.org/myboat.php?type=savemywp&pseudo=".$pseudo."&password=".$password."&targetlat=".$nextwplat."&targetlong=".$nextwplon."&targetandhdg=".$targetandhdg."&andhdg=".$andhdg;
}

// LA MAJ des prefs carte n'est pas utilisée pour le moment dans MobiVLM
// MAJ PREFERENCES CARTE
if($event=="prefsmap") {
$idraces = format_query($_GET['idraces']);
$lat = format_query($_GET['lat']);
$long = format_query($_GET['long']);
$latwp = format_query($_GET['latwp']);
$longwp = format_query($_GET['longwp']);
$x='980';
$y='1000';
$maptype='simple';
$maparea = format_query($_GET['maparea']);
$drawortho='yes';
$maille = format_query($_GET['maille']);
$proj='mercator';
$seacolor='ffffff';
$tracks='on';
$age = format_query($_GET['age']);
$estime = format_query($_GET['estime']);
$list = format_query($_GET['list']);
$boat = format_query($_GET['boat']);
$text='left';
$save='on';
$drawwind='0';
$mapcenter='myboat';
$drawtextwp='on';
$maplayers='merged';
$maptype='bothcompass';
$tracks='on';
$proj='mercator';
$text='right';

$url_vlm = "http://".$serveur_vlm.".virtual-loup-de-mer.org/map.img.php?maplayers=".$maplayers."&idraces=".$idraces."&boat=".$boat."&save=".$save."&maptype=".$maptype."&list=".$list."&mapcenter=".$mapcenter."&drawtextwp=".$drawtextwp."&maille=".$maille."&estime=".$estime."&age=".$age."&maparea=".$maparea."&x=".$x."&y=".$y."&lat=".$lat."&long=".$long."&latwp=".$latwp."&longwp=".$longwp."&tracks=".$tracks."&proj=".$proj."&text=".$text;
}

//EDITION DU CAP PIM=1
if($event=="pim1") {
$nw_cap = format_query($_GET['hdg']);
$url_vlm = "http://".$serveur_vlm.".virtual-loup-de-mer.org/update_angle.php?expertcookie=yes&lang=fr&idusers=".$IDU."&pilotmode=autopilot&boatheading=".$nw_cap;
}
//EDITION DE L'ANGLE PIM=2
if($event=="pim2") {
$nv_angle = format_query($_GET['twa']);
$url_vlm = "http://".$serveur_vlm.".virtual-loup-de-mer.org/update_angle.php?expertcookie=yes&lang=fr&pilotparameter=".$nv_angle."&idusers=".$IDU."&pilotmode=windangle";
}

//PASSAGE EN PILOTE ORTHO PIM=3
if($event=="pim3") {
$url_vlm = "http://".$serveur_vlm.".virtual-loup-de-mer.org/update_angle.php?expertcookie=yes&lang=fr&idusers=$IDU&pilotmode=orthodromic";
}
//PASSAGE BEST VMG PIM=4
if($event=="pim4") {
$url_vlm = "http://".$serveur_vlm.".virtual-loup-de-mer.org/update_angle.php?expertcookie=yes&lang=fr&idusers=$IDU&pilotmode=bestvmg";
}
//PASSAGE VBVMG PIM=5
if($event=="pim5") {
$url_vlm = "http://".$serveur_vlm.".virtual-loup-de-mer.org/update_angle.php?expertcookie=yes&lang=fr&idusers=$IDU&pilotmode=vbvmg";
}

$url_vlm = $url_vlm.$sid;
define('URLVLM', $url_vlm);

// DECOMMENTER POUR DEBUGAGE => RESULTATS DANS FICHIER DE TRACE
//include("debug.php");

// ENVOI DE LA REQUETE GET
$ch = curl_init(URLVLM);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
//curl_setopt($ch, CURLOPT_COOKIEFILE, realpath('cookie-'.$IDU.'.txt'));
curl_setopt($ch, CURLOPT_COOKIEFILE, './tmp/cookie-'.$IDU.'.txt');
$ret = curl_exec($ch);
if ($ret === FALSE) {
    die(curl_error());
}

// A activer selon les gouts, les ressources et les besoins ...
//unlink('./tmp/cookie-'.$IDU.'.txt');

//DEBUG
//echo $ret;
//var_dump(curl_getinfo($ch));
curl_close($ch);

//header("location: index.php?onglet=".$onglet);
?>
