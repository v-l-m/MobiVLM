<?php
/* *****************************************************************************
Page principale qui ordonne le d�roulement du prog et l'affichage vers le client
******************************************************************************** */
session_start();
	
include("GeoCalc.class.php");
$oGC = new GeoCalc();
include("fonctions_vlm.php");
$base_url = "http://virtual-loup-de-mer.org/ws/boatinfo.php?forcefmt=json";
$onglet = $_GET['onglet'];
if(empty($_SESSION['IDU']) && empty($_GET['pseudo']) && empty($_GET['password']))
{//login
include ("login.php");
}
elseif(!empty($_GET['pseudo']) && !empty($_GET['password']))
{ //connexion
$data = get_boatinfo($base_url,$_GET['pseudo'],$_GET['password']);
//echo $data;
$data = json_decode($data, true);
$_SESSION['IDU'] = $data['IDU'];
$_SESSION['pseudo'] = $_GET['pseudo'];
$_SESSION['password'] = $_GET['password'];
$pseudo = str_replace("%20"," ",$_SESSION['pseudo']);
$password = str_replace("%20"," ",$_SESSION['password']);
include("mobile.php");
}
elseif(!empty($_SESSION['IDU']) && empty($_GET['pseudo']) && empty($_GET['password']))
{ //deja connect�
$pseudo = str_replace("%20"," ",$_SESSION['pseudo']);
$password = str_replace("%20"," ",$_SESSION['password']);
$data = get_boatinfo($base_url,$pseudo,$password);
$data = json_decode($data, true);
include("mobile.php");
}
?>

