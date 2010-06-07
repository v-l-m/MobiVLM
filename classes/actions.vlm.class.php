<?php
/* ***************************************************************
Classe qui pousse les ordres vers VLM
!! est trés sensible à la façon dont PHP et CURL sont configurés ! 
****************************************************************** */

class actionsvlm { 
	
function open_session($pseudo,$password,$IDU,$serveur)
	{
	$pseudo_curl = $pseudo; // 
	$pseudo = str_replace(" ", "%20",$pseudo); // PSEUDO FORMATE POUR LE PASSER DANS LES URLS
	$password = $password; 
	
	//AUTHENTIFICATION
	$this->ch = curl_init('http://'.$serveur.'.virtual-loup-de-mer.org/myboat.php');
	$this_header = array(
    "getip: ".$ip,
	"getfullip: ".$fullip
	); // envoi des infos du client réel
	//curl_setopt($this->ch, CURLOPT_HTTPHEADER, $this_header);
	curl_setopt($this->ch, CURLOPT_POST, TRUE);
	//curl_setopt($ch, CURLOPT_USERAGENT, $userAgent);
	curl_setopt($this->ch, CURLOPT_POSTFIELDS,
	    array(
	        'pseudo' => $pseudo_curl,
	        'password' => $password,
			'lang' => 'fr',
			'type' => 'login'
	    )
	);
	curl_setopt($this->ch, CURLOPT_COOKIEJAR, './tmp/cookie-'.$IDU.'.txt');
	curl_setopt($this->ch, CURLOPT_FOLLOWLOCATION, TRUE);
	curl_setopt($this->ch, CURLOPT_COOKIESESSION, TRUE);
	curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, TRUE);
	$ret = curl_exec($this->ch);
	if ($ret === FALSE) {
	    die(curl_error());
	}
	curl_close($this->ch);
	
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
				if (preg_match('/(PHPSESSID'.chr(9).'[0-9a-z,-]{32,40})/i', $Ligne, $m)) 
					{
					$this->sid = '&' . $m[1];
					$this->sid = str_replace(chr(9),"=",$sid);
					}
				}
			fclose($fp); // On ferme le fichier
		}
		return $this->sid;
	} // function open_session
	
function make_event($event,$vars_get,$pseudo,$password,$IDU,$serveur,$sid)
	{
		// MAJ WP
		if($event=="newwp") {
		$nextwplat = format_query($vars_get['lat']);
		$nextwplon = format_query($vars_get['lon']);
		$targetandhdg = format_query($vars_get['targetandhdg']); // def -1
		$andhdg = format_query($vars_get['andhdg']); // def off
		$this->url = "http://".$serveur.".virtual-loup-de-mer.org/myboat.php?type=savemywp&targetlat=".$nextwplat."&targetlong=".$nextwplon."&targetandhdg=".$targetandhdg."&andhdg=".$andhdg;
		}
		
		//EDITION DU CAP PIM=1
		if($event=="pim1") {
		$nw_cap = format_query($vars_get['hdg']);
		$this->url = "http://".$serveur.".virtual-loup-de-mer.org/update_angle.php?expertcookie=yes&lang=fr&idusers=".$IDU."&pilotmode=autopilot&boatheading=".$nw_cap;
		}
		//EDITION DE L'ANGLE PIM=2
		if($event=="pim2") {
		$nv_angle = format_query($vars_get['twa']);
		$this->url = "http://".$serveur.".virtual-loup-de-mer.org/update_angle.php?expertcookie=yes&lang=fr&pilotparameter=".$nv_angle."&idusers=".$IDU."&pilotmode=windangle";
		}
		
		//PASSAGE EN PILOTE ORTHO PIM=3
		if($event=="pim3") {
		$this->url = "http://".$serveur.".virtual-loup-de-mer.org/update_angle.php?expertcookie=yes&lang=fr&idusers=$IDU&pilotmode=orthodromic";
		}
		//PASSAGE BEST VMG PIM=4
		if($event=="pim4") {
		$this->url = "http://".$serveur.".virtual-loup-de-mer.org/update_angle.php?expertcookie=yes&lang=fr&idusers=$IDU&pilotmode=bestvmg";
		}
		//PASSAGE VBVMG PIM=5
		if($event=="pim5") {
		$this->url = "http://".$serveur.".virtual-loup-de-mer.org/update_angle.php?expertcookie=yes&lang=fr&idusers=$IDU&pilotmode=vbvmg";
		}

		$this->url = $this->url.$sid;
		return $this->url;	
	}
	
function exec_event($url,$IDU)
	{
		$this->ch = curl_init($url);
		curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, TRUE);
		//curl_setopt($ch, CURLOPT_COOKIEFILE, realpath('cookie-'.$IDU.'.txt'));
		curl_setopt($this->ch, CURLOPT_COOKIEFILE, './tmp/cookie-'.$IDU.'.txt');
		curl_setopt($this->ch, CURLOPT_FOLLOWLOCATION, TRUE);
		$ret = curl_exec($this->ch);
		if ($ret === FALSE) 
		{ die(curl_error()); }
		curl_close($this->ch);
	}
	
}
?>
