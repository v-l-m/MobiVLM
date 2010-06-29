<?php
//CLASSE DE MISE A JOUR DES ORDRES DE NAVIGATION
class boatsetup { 
	
function majboat($pseudo,$password,$vars,$IDU,$serveur)
	{
	$mode_debug = "false";
	$ip = $this->getip();
	$fullip = $this->getfullip();
	$proxypass = "proxypass";
	$userAgent = $_SERVER['HTTP_USER_AGENT'];
	
	switch ($vars['event'])
		{
		case "pim1": // CAP FIXE
		$script = "pilot_set.php";
		$parms = '{"pim":1,"pip":'.$vars['hdg'].',"debug":'.$mode_debug.',"idu":'.$IDU.'}';
		break;
		case "pim2": // ANGLE FIXE
		$script = "pilot_set.php";
		$parms = '{"pim":2,"pip":'.$vars['twa'].',"debug":'.$mode_debug.',"idu":'.$IDU.'}';
		break;
		case "pim3": // PILOTE ORTHO
		$script = "pilot_set.php";
		$parms = '{"pim":3,"idu":'.$IDU.'}';
		break;
		case "pim4": // PILOTE BVMG
		$script = "pilot_set.php";
		$parms = '{"pim":4,"idu":'.$IDU.'}';
		break;
		case "pim5": // PILOTE VBVMG
		$script = "pilot_set.php";
		$parms = '{"pim":5,"idu":'.$IDU.'}';
		break;
		case "newwp": // MAJ WP
		$script = "target_set.php";
		$parms = '{"pip":{"targetlat":'.$vars['lat'].',"targetlong":'.$vars['lon'].',"targetandhdg":'.$vars['targetandhdg'].'},"debug":'.$mode_debug.',"idu":'.$IDU.'}';
		break;
		case "pilototo": // PILOTOTO QUOI ...
		$tab_date = explode(",",$vars['tts_day']);
		$mktts = mktime($vars['tts_heure'], $vars['tts_min'], 0, $tab_date[1], $tab_date[0], $tab_date[2]);
		if(isset($vars['pilototo_add']))
			{
			$script = "pilototo_add.php";
				if($vars['pim']=="1" || $vars['pim']=="2")
				{
				$parms = '{"tasktime":'.$mktts.',"pim":'.$vars['pim'].',"pip":'.$vars['pip'].',"debug":'.$mode_debug.',"idu":'.$IDU.'}';
				}
				if($vars['pim']=="3" || $vars['pim']=="4" || $vars['pim']=="5")
				{
				$pip = str_replace("@",",",$vars['pip']);
				$pip = explode(",",$pip);
				$parms = '{"tasktime":'.$mktts.',"pim":'.$vars['pim'].',"pip":{"targetlat":'.$pip[0].',"targetlong":'.$pip[1].',"targetandhdg":'.$pip[2].'},"debug":'.$mode_debug.',"idu":'.$IDU.'}';
				}
			}
		if(isset($vars['pilototo_update']))
			{
			$script = "pilototo_update.php";
				if($vars['pim']=="1" || $vars['pim']=="2")
				{
				$parms = '{"taskid":'.$vars['taskid'].',"tasktime":'.$mktts.',"pim":'.$vars['pim'].',"pip":'.$vars['pip'].',"debug":'.$mode_debug.',"idu":'.$IDU.'}';
				}
				if($vars['pim']=="3" || $vars['pim']=="4" || $vars['pim']=="5")
				{
				$pip = str_replace("@",",",$vars['pip']);
				$pip = explode(",",$pip);
				$parms = '{"taskid":'.$vars['taskid'].',"tasktime":'.$mktts.',"pim":'.$vars['pim'].',"pip":{"targetlat":'.$pip[0].',"targetlong":'.$pip[1].',"targetandhdg":'.$pip[2].'},"debug":'.$mode_debug.',"idu":'.$IDU.'}';
				}
			}
		if(isset($vars['pilototo_delete']))
			{
			$script = "pilototo_delete.php";
			$parms = '{"taskid":'.$vars['taskid'].',"debug":'.$mode_debug.',"idu":'.$IDU.'}';
			}
		break;
		}  
		
		// DEBUG
		//echo "ordre = ".$parms." pip = ".$pip." - ".$pip[0]." - ".$pip[1]." - ".$pip[2]."<hr>";
		
	$this->ch = curl_init('http://'.$serveur.'.virtual-loup-de-mer.org/ws/boatsetup/'.$script);
	curl_setopt($this->ch, CURLOPT_USERPWD, "$pseudo:$password");
	curl_setopt($this->ch, CURLOPT_HTTPHEADER, array("VLM_PROXY_AGENT: MobiVLM/0.21 (user=".$_SESSION['IDU'].")"));
	curl_setopt($this->ch, CURLOPT_HTTPHEADER, array("VLM_PROXY_PASS: ".$proxypass));
	curl_setopt($this->ch, CURLOPT_HTTPHEADER, array("VLM_CLIENT_IP: ".$ip));
	curl_setopt($this->ch, CURLOPT_HTTPHEADER, array("VLM_CLIENT_FULLIP: ".$fullip));
	curl_setopt($this->ch, CURLOPT_USERAGENT, $userAgent);
	curl_setopt($this->ch, CURLOPT_HEADER, FALSE);
	curl_setopt($this->ch, CURLOPT_POST, TRUE);
	curl_setopt($this->ch, CURLOPT_POSTFIELDS,
	    array(
	        'parms' => $parms
	    )
	);
	curl_setopt($this->ch, CURLOPT_FOLLOWLOCATION, TRUE);
	curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, TRUE);
	
	$this->ret = curl_exec($this->ch);
	if ($this->ret === FALSE) {
	    die(curl_error());
	}
	curl_close($this->ch);
		return $this->ret;
	} // function majboat

	function majprefs($pseudo,$password,$vars,$IDU,$serveur)
	{
	$mode_debug = "false";
	$ip = $this->getip();
	$proxypass = $this->getfullip();
	$proxyagent = $_SERVER['HTTP_USER_AGENT'];
	
	//http://testing.virtual-loup-de-mer.org/ws/boatsetup/prefs_set.php?parms={"prefs":{mobivl_,}}
	}

	function validip($ip) {
		if (!empty($ip) && ip2long($ip)!=-1) {
	 
			$reserved_ips = array (
				array('0.0.0.0','2.255.255.255'),
				array('10.0.0.0','10.255.255.255'),
				array('127.0.0.0','127.255.255.255'),
				array('169.254.0.0','169.254.255.255'),
				array('172.16.0.0','172.31.255.255'),
				array('192.0.2.0','192.0.2.255'),
				array('192.168.0.0','192.168.255.255'),
				array('255.255.255.0','255.255.255.255')
			);
	 
			foreach ($reserved_ips as $r) { 
				$min = ip2long($r[0]);
				$max = ip2long($r[1]);
				if ((ip2long($ip) >= $min) && (ip2long($ip) <= $max)) return false;
			}
			return true;
		} else {
			return false;
		}
	}
	
	function getip() { 
		if ($this->validip($_SERVER["HTTP_CLIENT_IP"])) {
			return $_SERVER["HTTP_CLIENT_IP"];
		}
	
		foreach (explode(",",$_SERVER["HTTP_X_FORWARDED_FOR"]) as $ip) {
			if ($this->validip(trim($ip))) {
				return $ip;
			}
		}
		 
		if ($this->validip($_SERVER["HTTP_X_FORWARDED"])) {
			return $_SERVER["HTTP_X_FORWARDED"];
		} elseif ($this->validip($_SERVER["HTTP_FORWARDED_FOR"])) {
			return $_SERVER["HTTP_FORWARDED_FOR"];
		} elseif ($this->validip($_SERVER["HTTP_FORWARDED"])) {
			return $_SERVER["HTTP_FORWARDED"];
		} else {
			return $_SERVER["REMOTE_ADDR"];
		}
	}
	
	function getfullip() {
	
		$ipvars = Array("HTTP_CLIENT_IP", "HTTP_X_FORWARDED_FOR", "HTTP_X_FORWARDED", "HTTP_FORWARDED", "REMOTE_ADDR");
		
		$ipstr = "";
		foreach($ipvars as $varname) {
			if (isset($_SERVER[$varname])) $ipstr = $ipstr . $varname . "=" . $_SERVER[$varname] . ", ";
		}
		return $ipstr;
	}

}
?>
