<?php
/*
*****************************************************************************
Page principale qui ordonne le déroulement du prog et l'affichage vers le client
********************************************************************************
*/
session_start();
include("includes/config.php");
include("includes/fonctions_vlm.php"); // NE SERT PLUS SI JE N'AI RIEN OUBLIE DANS LES CLASSES
include("classes/GeoCalc.class.php");
include("classes/boatsetup.class.php");
include("classes/mobivlm.class.php");

$oGC = new GeoCalc();
$boatsetup = new boatsetup();
$mobivlm = new mobivlm();

$onglet = $_GET['onglet'];

// GESTION DES EVENTS
if(isset($_GET['event']) && isset($_SESSION['IDU']) )
{
	$event = $_GET['event'];
	$IDU = $_SESSION['IDU'];
	$pseudo = $_SESSION['pseudo'];
	$password = $_SESSION['password'];
	
	$ordre = $boatsetup->majboat($pseudo,$password,$_GET,$IDU,$serveur);
	//echo $ordre;
	//$reponse_ordre = json_decode($ordre);
	//if($reponse_ordre['success'])
}

//AFFICHAGE AU CLIENT
if(empty($_SESSION['IDU']) && empty($_POST['pseudo']) && empty($_POST['password']))
	{//login
	include ("includes/login.php");
	}
elseif(!empty($_POST['pseudo']) && !empty($_POST['password']))
	{ //connexion
	$data = $mobivlm->alldatas($base_url,$_POST['pseudo'],$_POST['password']);
	
	$_SESSION['IDU'] = $data['IDU'];
	$_SESSION['pseudo'] = $_POST['pseudo'];
	$_SESSION['password'] = $_POST['password'];
	$pseudo = str_replace("%20"," ",$_SESSION['pseudo']);
	$password = str_replace("%20"," ",$_SESSION['password']);
	
	include("includes/mobile.php");
	}
elseif(!empty($_SESSION['IDU']) && empty($_POST['pseudo']) && empty($_POST['password']))
	{ //deja connecté
	$pseudo = str_replace("%20"," ",$_SESSION['pseudo']);
	$password = str_replace("%20"," ",$_SESSION['password']);
	$data = $mobivlm->alldatas($base_url,$pseudo,$password);
	include("includes/mobile.php");
	}
	
//$oGC->finish();
//$boatsetup->finish();
//$mobivlm->finish();
?>

