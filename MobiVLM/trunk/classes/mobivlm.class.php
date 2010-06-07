<?php
class mobivlm {
	function alldatas($base_url,$pseudo,$password)
		{
		$this->ch = curl_init();
		curl_setopt($this->ch, CURLOPT_URL, $base_url);
		curl_setopt($this->ch, CURLOPT_USERPWD, $pseudo.":".$password);
		curl_setopt($this->ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
		// Retourne le resultat au lieu de l'imprimer 
		curl_setopt ($this->ch, CURLOPT_RETURNTRANSFER, 1);
		$this->data = curl_exec ($this->ch);
		$this->data = json_decode($this->data, true);
		curl_close($this->ch);
		
		$this->data['cur_date']=date("d/m/Y H:i:s");
		$this->data['vac_date']=date("d/m/Y H:i:s",$this->data['LUP']);
		$this->data['heure']=date("");
		$this->data['current_infos'] = array($this->data['CNT'],$pseudo,utf8_decode($this->data['RAN']),$this->data['POS'],$this->data['vac_date']);
		
		$this->data['dsp_lat']=(round($this->data['LAT'])/1000);
		$this->data['dsp_lon']=(round($this->data['LON'])/1000);
		$this->data['dsp_hdg']=round($this->data['HDG']);
		$this->data['map_lat'] = $this->data['LAT']/1000;
		$this->data['map_lon'] = $this->data['LON']/1000;
		$this->data['frm_eta'] = $this->format_eta($this->data['ETA']);
		$this->data['dsp_ort']=round($this->data['ORT']);
		$this->data['dsp_lox']=round($this->data['LOX']);
		$this->data['dsp_tws']=round($this->data['TWS']);
		$this->data['dsp_twd']=round($this->data['TWD']);
		$this->data['angle_vent'] = $this->calcul_angle_vent($this->data['HDG'], $this->data['TWD']);
		
		return $this->data;
		}
		
	function format_eta($val)
		{
		str_replace("T"," ",$val);
		str_replace("Z"," ",$val);
		str_replace("t"," ",$val);
		str_replace("z"," ",$val);
		return $this->val;
		}
		
	function calcul_angle_vent($cap, $dir_vent)
		{
		$this->angle = $cap-$dir_vent;
		if($this->angle>180) { $this->angle=$this->angle-360; }
		return $this->angle;
		}
		
	// UTILE POUR VLM-20
	function angle_oppose($val) 
		{
		$this->angle = $val + 180;
		if($this->angle > 360) { $this->angle = $this->angle - 360; }
		return $this->angle;
		}
	
	function dsp_currents_infos($tpl)
		{
		$this->dsp = vsprintf($tpl, $this->data['current_infos']);
		return $this->dsp;
		}
		
	function format_query($var)
		{
		$this->query = str_replace("%2E",".",$var);
		$this->query = str_replace("%2D",".",$this->query);
		return $this->query;
		}
		
	function dsp_vlm20($data)
	{
		$sep = '&amp;';
		$esp = '%20%20%20%20%20%20%20%20';
		$this->vlm20 = 'http://www.virtual-loup-de-mer.org/windangle.php?' . $esp
		. 'wheading=' . angle_oppose($data['TWD']) . $sep . $esp
		. 'boatheading=' . $data['HDG'] . $sep . $esp
		. 'wspeed=' . $data['TWS'] . $sep . $esp
		. 'roadtoend=' . $data['ORT'] . $sep . $esp
		. 'boattype=' . $data['POL'];
		return $this->vlm20;
	}
}
?>