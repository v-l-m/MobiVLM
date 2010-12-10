<?php
//$server = "testing.virtual-loup-de-mer.org";
$server = "www.virtual-loup-de-mer.org";
//"http://www.virtual-loup-de-mer.org/ws/playerinfo/fleet.php?select_idu=".$idu;
//"http://www.virtual-loup-de-mer.org/ws/boatinfo.php?select_idu=".$idu."&forcefmt=json";
if($_COOKIE['server'] == "testing.virtual-loup-de-mer.org")
{ $server = "testing.virtual-loup-de-mer.org"; }
else
{ $server = "virtual-loup-de-mer.org"; }

if(!empty($_GET['method']))
{
$vars = $_GET;
}
elseif
(!empty($_POST['method']))
{
$vars = $_POST;
}
//$idu = $vars['idu'];
$username = $vars['username'];
$password = $vars['password'];

$base_url = $vars['base_url'];
switch($base_url)
{

case "fleet" :
$url = "http://".$server."/ws/playerinfo/fleet.php?select_idu=".$idu;
echo get_auth_infos($url,$username,$password);
break;

case "boatinfo" :
$idu = $vars['idu'];
$url = "http://".$server."/ws/boatinfo.php?select_idu=".$idu."&forcefmt=json";
echo get_auth_infos($url,$username,$password);
break;

case "pilot_set" :
$idu = $vars['idu'];
$pim = $vars['pim'];
$pip = $vars['pip'];

if($pim == "1")
{ $parms = '{"pim":1,"pip":'.$pip.',"idu":'.$idu.'}'; }
if($pim == "2")
{ $parms = '{"pim":2,"pip":'.$pip.',"idu":'.$idu.'}'; }
if($pim == "3")
{ $parms = '{"pim":3,"idu":'.$idu.'}'; }
if($pim == "4")
{ $parms = '{"pim":4,"idu":'.$idu.'}'; }
if($pim == "5")
{ $parms = '{"pim":5,"idu":'.$idu.'}'; }

$url = "http://".$server."/ws/boatsetup/pilot_set.php?select_idu=".$idu;
set_parms($url,$username,$password,$parms);
break;

case "target_set" :
$idu = $vars['idu'];
$script = "target_set.php";
$parms = '{"pip":{"targetlat":'.$vars['lat'].',"targetlong":'.$vars['lon'].',"targetandhdg":'.$vars['targetandhdg'].'},"idu":'.$idu.'}';
$url = "http://".$server."/ws/boatsetup/target_set.php?select_idu=".$idu;
set_parms($url,$username,$password,$parms);
}


function get_auth_infos($url,$username,$password)
{
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	if(!empty($username))
	{
	curl_setopt($ch, CURLOPT_USERPWD, $username.":".$password);
	curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
	}
	curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
	$data = curl_exec ($ch);
	return $data;
}

function set_parms($url,$username,$password,$parms)
{
	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_USERPWD, "$username:$password");
	curl_setopt($ch, CURLOPT_HEADER, FALSE);
	curl_setopt($ch, CURLOPT_POST, TRUE);
	curl_setopt($ch, CURLOPT_POSTFIELDS,
	    array(
	        'parms' => $parms
	    )
	);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
	
	$ret = curl_exec($ch);
	if ($ret === FALSE) {
	    die(curl_error());
	}
	curl_close($ch);
}
?>