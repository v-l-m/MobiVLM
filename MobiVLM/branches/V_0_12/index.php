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
include("classes/actions.vlm.class.php");
include("classes/mobivlm.class.php");

$oGC = new GeoCalc();
$actions_vlm = new actionsvlm();
$mobivlm = new mobivlm();

$onglet = $_GET['onglet'];

// GESTION DES EVENTS
if(isset($_GET['event']) && isset($_SESSION['IDU']) )
{
	$event = $_GET['event'];
	$IDU = $_SESSION['IDU'];
	//$pseudo = str_replace("%20"," ",$_SESSION['pseudo']);
	//$pseudo2 = str_replace(" ","+",$_SESSION['pseudo']);
	
	$pseudo = $_SESSION['pseudo'];
	$password = str_replace("%20"," ",$_SESSION['password']);
	
	// CONNEXION ET RECUPERATION DU SID DE SESSION
	$sid = $actions_vlm->open_session($pseudo,$password,$IDU,$serveur);
	
	// GESTION DES DONNEES ET URL DE RETOUR
	$url_event = $actions_vlm->make_event($event,$_GET,$pseudo,$password,$IDU,$serveur,$sid);
	
	// ENVOI DE LA REQUETE GET
	$actions_vlm->exec_event($url_event,$IDU);
}

//AFFICHAGE AU CLIENT
if(empty($_SESSION['IDU']) && empty($_GET['pseudo']) && empty($_GET['password']))
	{//login
	include ("includes/login.php");
	}
elseif(!empty($_GET['pseudo']) && !empty($_GET['password']))
	{ //connexion
	$data = $mobivlm->alldatas($base_url,$_GET['pseudo'],$_GET['password']);
	
	$_SESSION['IDU'] = $data['IDU'];
	$_SESSION['pseudo'] = $_GET['pseudo'];
	$_SESSION['password'] = $_GET['password'];
	$pseudo = str_replace("%20"," ",$_SESSION['pseudo']);
	$password = str_replace("%20"," ",$_SESSION['password']);
	
	include("includes/mobile.php");
	}
elseif(!empty($_SESSION['IDU']) && empty($_GET['pseudo']) && empty($_GET['password']))
	{ //deja connecté
	$pseudo = str_replace("%20"," ",$_SESSION['pseudo']);
	$password = str_replace("%20"," ",$_SESSION['password']);
	$data = $mobivlm->alldatas($base_url,$pseudo,$password);
	include("includes/mobile.php");
	}
?>

