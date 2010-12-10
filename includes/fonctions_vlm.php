<?php
/* ***************************************************************
LES FONCTIONS
****************************************************************** */
function format_eta($val)
{
str_replace("T"," ",$val);
str_replace("Z"," ",$val);
str_replace("t"," ",$val);
str_replace("z"," ",$val);
return $val;
}

function DMStoDEC($deg,$min,$sec)
{

// Converts DMS ( Degrees / minutes / seconds ) 
// to decimal format longitude / latitude

    return $deg+((($min*60)+($sec))/3600);
}    

function DECtoDMS($dec)
{

// Converts decimal longitude / latitude to DMS
// ( Degrees / minutes / seconds ) 

    $vars = explode(".",$dec);
    $deg = $vars[0];
    $tempma = "0.".$vars[1];

    $tempma = $tempma * 3600;
    $min = floor($tempma / 60);
    $sec = $tempma - ($min*60);

    return array("deg"=>$deg,"min"=>$min,"sec"=>$sec);
}    

function format_query($var)
{
$var = str_replace("%2E",".",$var);
$var = str_replace("%2D",".",$var);
return $var;
}

// CALCUL DE DISTANCE ENTRE DEUX POINTS
function getRiemannDistance($lat_from, $long_from, $lat_to, $long_to)
{
 /*** distance unit ***/

 /*** miles ***/
   // $unit = 3963;
   
 /*** nautical miles ***/
    $unit = 3444;
   
    /*** kilometers ***/
   // $unit = 6371;


 /*** 1 degree = 0.017453292519943 radius ***/
 $degreeRadius = deg2rad(1);
 
 /*** convert longitude and latitude to radians ***/
 $lat_from  *= $degreeRadius;
 $long_from *= $degreeRadius;
 $lat_to    *= $degreeRadius;
 $long_to   *= $degreeRadius;
 
 /*** apply the Great Circle Distance Formula ***/
 $dist = sin($lat_from) * sin($lat_to) + cos($lat_from)
 * cos($lat_to) * cos($long_from - $long_to);
 
 /*** radius of earth * arc cosine ***/
 return ($unit * acos($dist));
}

function calcul_angle_vent($cap, $dir_vent)
{
$angle = $cap-$dir_vent;
if($angle>180)
{ $angle=$angle-360; }
return $angle;
}

function transforme_tps($time)
    {
    if ($time>=86400)
    /* 86400 = 3600*24 c'est à dire le nombre de secondes dans un seul jour ! donc là on vérifie si le nombre de secondes donné contient des jours ou pas */
    {
    // Si c'est le cas on commence nos calculs en incluant les jours

    // on divise le nombre de seconde par 86400 (=3600*24)
    // puis on utilise la fonction floor() pour arrondir au plus petit
    $jour = floor($time/86400);
    // On extrait le nombre de jours
    $reste = $time%86400;

    $heure = floor($reste/3600);
    // puis le nombre d'heures
    $reste = $reste%3600;

    $minute = floor($reste/60);
    // puis les minutes

    $seconde = $reste%60;
    // et le reste en secondes

    // on rassemble les résultats en forme de date
    $result = $jour.'j '.$heure.'h '.$minute.'min '.$seconde.'s';
    }
    elseif ($time < 86400 AND $time>=3600)
    // si le nombre de secondes ne contient pas de jours mais contient des heures
    {
    // on refait la même opération sans calculer les jours
    $heure = floor($time/3600);
    $reste = $time%3600;

    $minute = floor($reste/60);

    $seconde = $reste%60;

    $result = $heure.'h '.$minute.'min '.$seconde.' s';
    }
    elseif ($time<3600 AND $time>=60)
    {
    // si le nombre de secondes ne contient pas d'heures mais contient des minutes
    $minute = floor($time/60);
    $seconde = $time%60;
    $result = $minute.'min '.$seconde.'s';
    }
    elseif ($time < 60)
    // si le nombre de secondes ne contient aucune minutes
    {
    $result = $time.'s';
    }
    return $result;
    }
	
function get_boatinfo($base_url,$pseudo,$password)
	{
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $base_url);
	curl_setopt($ch, CURLOPT_USERPWD, $pseudo.":".$password);
	curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
	// Retourne le résultat au lieu de l'imprimer 
	curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
	$data = curl_exec ($ch);
	curl_close($ch);
	return $data;
	}
	
// UTILE POUR VLM-20
function angle_oppose($val) 
	{
	$val=$val + 180;
	if($val>360) { $val=$val - 360; }
	return $val;
	}
?>