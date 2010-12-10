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

if(isset($_GET['onglet']) )
{ $onglet = $_GET['onglet']; }

if(!empty($_GET['select_idu']) )
{
$current_IDU = $_GET['select_idu'];
$_SESSION['IDU'] = $current_IDU; 
}

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

// CAS 1 CONNEXION
elseif(empty($_SESSION['IDU']) && !empty($_POST['pseudo']) && !empty($_POST['password']))
	{ //connexion FLEET
	$fleet = $mobivlm->get_fleet($fleet_url,$_POST['pseudo'],$_POST['password']);
	// si on a pas de flotte c'est un echec de connexion
	if(empty($fleet))
		{ include ("includes/login.php"); }
	else
		{
		$_SESSION['pseudo'] = $_POST['pseudo'];
		$_SESSION['password'] = $_POST['password'];
		$pseudo = str_replace("%20"," ",$_SESSION['pseudo']);
		$password = str_replace("%20"," ",$_SESSION['password']);
		
		$dsp_case = "fleet";
		include("includes/fleet.php");
		}
	}
	
// CAS 2 DEJA CONNECTE
elseif( !empty($_GET['fleet']) )
	{ 
	$fleet = $mobivlm->get_fleet($fleet_url,$_SESSION['pseudo'],$_SESSION['password']);
	$pseudo = str_replace("%20"," ",$_SESSION['pseudo']);
	$password = str_replace("%20"," ",$_SESSION['password']);
	// si on a pas de flotte c'est peut etre une perte de la session
	if(empty($fleet))
	{ include ("includes/login.php"); }
	else
	{
	$dsp_case = "fleet";
	include("includes/fleet.php");
	}
	}
/*
elseif(!empty($_POST['pseudo']) && !empty($_POST['password']))
	{ //connexion
	$data = $mobivlm->alldatas($base_url,$_SESSION['pseudo'],$_SESSION['password']);
	
	//$_SESSION['IDU'] = $data['IDU'];
	//$_SESSION['pseudo'] = $_POST['pseudo'];
	//$_SESSION['password'] = $_POST['password'];
	$pseudo = str_replace("%20"," ",$_SESSION['pseudo']);
	$password = str_replace("%20"," ",$_SESSION['password']);
	
	include("includes/mobile.php");
	}
*/
elseif(!empty($_SESSION['IDU']) && empty($_POST['pseudo']) && empty($_POST['password']))
	{ //deja connecté
	$pseudo = str_replace("%20"," ",$_SESSION['pseudo']);
	$password = str_replace("%20"," ",$_SESSION['password']);
	$data = $mobivlm->alldatas($base_url,$pseudo,$password,$_SESSION['IDU']);
	include("includes/mobile.php");
	}
	
//$oGC->finish();
//$boatsetup->finish();
//$mobivlm->finish();
?>

