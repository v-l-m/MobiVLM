<!-- ONGLET 3 -->
<div class="contenu_onglet" id="contenu_onglet_3">
<?php echo $mobivlm->dsp_currents_infos($tpl_dsp_currents_infos); ?>
	<div class="txtbold1" align="center">
	<hr />
	<div class="txtbold1">CARTOGRAPHIE</div>
	<hr />
	<form action="carte.php" method="get" name="go_carto">
	<input type="hidden" name="onglet" value="3">
	<input type="hidden" name="serveur" value="S11">
	<input type="hidden" name="RAC" value="<?php echo $data['RAC']; ?>">
	<input type="hidden" name="map_lat" value="<?php echo $data['map_lat']; ?>">
	<input type="hidden" name="map_lon" value="<?php echo $data['map_lon']; ?>">
	<input type="hidden" name="IDU" value="<?php echo $data['IDU']; ?>">
	<table border="0" cellpadding="1" width="66%">
	<tr>
	<td class="txtbold1" width="33%" bgcolor="#ffffff">HEURE : </td>
	<td class="txtbold1" width="33%" bgcolor="#cccccc">
	<select name="heure">
	  <option value="0" selected>H + 0</option>
	  <option value="1">H + 1</option>
	  <option value="2">H + 2</option>
	  <option value="3">H + 3</option>
	  <option value="4">H + 4</option>
	  <option value="5">H + 5</option>
	  <option value="6">H + 6</option>
	  <option value="9">H + 9</option>
	  <option value="12">H + 12</option>
	  <option value="18">H + 18</option>
	  <option value="24">H + 24</option>
	  <option value="36">H + 36</option>
	  <option value="48">H + 48</option>
	  <option value="60">H + 60</option>
	</select>
	</td>
	</tr>
	<tr>
	<td class="txtbold1" width="33%" bgcolor="#ffffff">ZOOM : </td>
	<td class="txtbold1" width="33%" bgcolor="#cccccc">
	<select name="zoom">
	  <option value="1">1</option>
	  <option value="2">2</option>
	  <option value="3">3</option>
	  <option value="4" selected>4</option>
	  <option value="5">5</option>
	  <option value="6">6</option>
	  <option value="7">7</option>
	  <option value="8">8</option>
	  <option value="9">9</option>
	  <option value="10">10</option>
	  <option value="11">11</option>
	  <option value="12">12</option>
	</select>
	</td>
	</tr>
	<tr>
	<td></td>
	<td>
	<input name="sub_carto" type="submit" value="Visualiser">
	</td>
	</tr>
	</table>
	<hr />
	<br><a href="logout.php">LOGOUT</a><br>
	</form>
	</div>
</div>
