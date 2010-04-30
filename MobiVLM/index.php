<?php
/* *****************************************************************************
Page principale qui ordonne le déroulement du prog et l'affichage vers le client
******************************************************************************** */
session_start();
	
include("GeoCalc.class.php");
$oGC = new GeoCalc();
include("fonctions_vlm.php");
$base_url = "http://virtual-loup-de-mer.org/ws/boatinfo.php?forcefmt=json";


if(empty($_SESSION['IDU']) && empty($_POST['pseudo']) && empty($_POST['password']))
{//login
include ("login.php");
}
elseif(!empty($_POST['pseudo']) && !empty($_POST['password']))
{ //connexion
$data = get_boatinfo($base_url,$_POST['pseudo'],$_POST['password']);
//echo $data;
$data = json_decode($data, true);
$_SESSION['IDU'] = $data['IDU'];
$_SESSION['pseudo'] = $_POST['pseudo'];
$_SESSION['password'] = $_POST['password'];
$pseudo = str_replace("%20"," ",$_SESSION['pseudo']);
$password = str_replace("%20"," ",$_SESSION['password']);
include("mobile.php");
}
elseif(!empty($_SESSION['IDU']) && empty($_POST['pseudo']) && empty($_POST['password']))
{ //deja connecté
$pseudo = str_replace("%20"," ",$_SESSION['pseudo']);
$password = str_replace("%20"," ",$_SESSION['password']);
$data = get_boatinfo($base_url,$pseudo,$password);
$data = json_decode($data, true);
include("mobile.php");
}
?>

