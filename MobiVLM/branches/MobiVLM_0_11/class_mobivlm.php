<?php
class mobivlm {
	function get_boatinfo($base_url,$pseudo,$password)
		{
		$this->ch = curl_init();
		curl_setopt($this->ch, CURLOPT_URL, $base_url);
		curl_setopt($this->ch, CURLOPT_USERPWD, $pseudo.":".$password);
		curl_setopt($this->ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
		// Retourne le résultat au lieu de l'imprimer 
		curl_setopt ($this->ch, CURLOPT_RETURNTRANSFER, 1);
		$this->data = curl_exec ($this->ch);
		$this->data = json_decode($this->data, true);
		curl_close($this->ch);
		
		return $this->data;
		}
}
?>