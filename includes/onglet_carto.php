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
	<td class="txtbold1" width="33%" bgcolor="#ffffff">Hauteur : </td>
	<td class="txtbold1" width="33%" bgcolor="#cccccc">
	<?php if(isset($_SESSION['map_haut'])) { $map_haut = $_SESSION['map_haut']; } else { $map_haut = "640"; }?>
	<input type="text" name="map_haut" value="<?php echo $map_haut; ?>" size="10" class="txtbold1">
	</td>
	</tr>
	<tr>
	<td class="txtbold1" width="33%" bgcolor="#ffffff">Largeur : </td>
	<td class="txtbold1" width="33%" bgcolor="#cccccc">
	<?php if(isset($_SESSION['map_larg'])) { $map_larg = $_SESSION['map_larg']; } else { $map_larg = "480"; }?>
	<input type="text" name="map_larg" value="<?php echo $map_larg; ?>" size="10" class="txtbold1">
	</td>
	</tr>
	<tr>
	<td class="txtbold1" width="33%" bgcolor="#ffffff">HEURE : </td>
	<td class="txtbold1" width="33%" bgcolor="#cccccc">
	<select name="heure">
	  <option value="0" <?php if(isset($_SESSION['heure'])) { if($_SESSION['heure']=="0") { echo "selected"; } } else { echo "selected"; }?>>H + 0</option>
	  <option value="1" <?php if(isset($_SESSION['heure'])) { if($_SESSION['heure']=="1") { echo "selected"; } } ?>>H + 1</option>
	  <option value="2" <?php if(isset($_SESSION['heure'])) { if($_SESSION['heure']=="2") { echo "selected"; } } ?>>H + 2</option>
	  <option value="3" <?php if(isset($_SESSION['heure'])) { if($_SESSION['heure']=="3") { echo "selected"; } } ?>>H + 3</option>
	  <option value="4" <?php if(isset($_SESSION['heure'])) { if($_SESSION['heure']=="4") { echo "selected"; } } ?>>H + 4</option>
	  <option value="5" <?php if(isset($_SESSION['heure'])) { if($_SESSION['heure']=="5") { echo "selected"; } } ?>>H + 5</option>
	  <option value="6" <?php if(isset($_SESSION['heure'])) { if($_SESSION['heure']=="6") { echo "selected"; } } ?>>H + 6</option>
	  <option value="9" <?php if(isset($_SESSION['heure'])) { if($_SESSION['heure']=="9") { echo "selected"; } } ?>>H + 9</option>
	  <option value="12" <?php if(isset($_SESSION['heure'])) { if($_SESSION['heure']=="12") { echo "selected"; } } ?>>H + 12</option>
	  <option value="18" <?php if(isset($_SESSION['heure'])) { if($_SESSION['heure']=="18") { echo "selected"; } } ?>>H + 18</option>
	  <option value="24" <?php if(isset($_SESSION['heure'])) { if($_SESSION['heure']=="24") { echo "selected"; } } ?>>H + 24</option>
	  <option value="36" <?php if(isset($_SESSION['heure'])) { if($_SESSION['heure']=="36") { echo "selected"; } } ?>>H + 36</option>
	  <option value="48" <?php if(isset($_SESSION['heure'])) { if($_SESSION['heure']=="48") { echo "selected"; } } ?>>H + 48</option>
	  <option value="60" <?php if(isset($_SESSION['heure'])) { if($_SESSION['heure']=="60") { echo "selected"; } } ?>>H + 60</option>
	</select>
	</td>
	</tr>
	<tr>
	<td class="txtbold1" width="33%" bgcolor="#ffffff">ZOOM : </td>
	<td class="txtbold1" width="33%" bgcolor="#cccccc">
	<select name="zoom">
	  <option value="2" <?php if(isset($_SESSION['zoom'])) { if($_SESSION['zoom']=="2") { echo "selected"; } } ?>>2</option>
	  <option value="3" <?php if(isset($_SESSION['zoom'])) { if($_SESSION['zoom']=="3") { echo "selected"; } } ?>>3</option>
	  <option value="4" <?php if(isset($_SESSION['zoom'])) { if($_SESSION['zoom']=="4") { echo "selected"; } } else { echo "selected"; }?>>4</option>
	  <option value="5" <?php if(isset($_SESSION['zoom'])) { if($_SESSION['zoom']=="5") { echo "selected"; } } ?>>5</option>
	  <option value="6" <?php if(isset($_SESSION['zoom'])) { if($_SESSION['zoom']=="6") { echo "selected"; } } ?>>6</option>
	  <option value="7" <?php if(isset($_SESSION['zoom'])) { if($_SESSION['zoom']=="7") { echo "selected"; } } ?>>7</option>
	  <option value="8" <?php if(isset($_SESSION['zoom'])) { if($_SESSION['zoom']=="8") { echo "selected"; } } ?>>8</option>
	  <option value="9" <?php if(isset($_SESSION['zoom'])) { if($_SESSION['zoom']=="9") { echo "selected"; } } ?>>9</option>
	  <option value="10" <?php if(isset($_SESSION['zoom'])) { if($_SESSION['zoom']=="10") { echo "selected"; } } ?>>10</option>
	  <option value="11" <?php if(isset($_SESSION['zoom'])) { if($_SESSION['zoom']=="11") { echo "selected"; } } ?>>11</option>
	  <option value="12" <?php if(isset($_SESSION['zoom'])) { if($_SESSION['zoom']=="12") { echo "selected"; } } ?>>12</option>
	  <option value="13" <?php if(isset($_SESSION['zoom'])) { if($_SESSION['zoom']=="13") { echo "selected"; } } ?>>13</option>
	  <option value="14" <?php if(isset($_SESSION['zoom'])) { if($_SESSION['zoom']=="14") { echo "selected"; } } ?>>14</option>
	  <option value="15" <?php if(isset($_SESSION['zoom'])) { if($_SESSION['zoom']=="15") { echo "selected"; } } ?>>15</option>
	  <option value="16" <?php if(isset($_SESSION['zoom'])) { if($_SESSION['zoom']=="16") { echo "selected"; } } ?>>16</option>
	  <option value="17" <?php if(isset($_SESSION['zoom'])) { if($_SESSION['zoom']=="17") { echo "selected"; } } ?>>17</option>
	  <option value="18" <?php if(isset($_SESSION['zoom'])) { if($_SESSION['zoom']=="18") { echo "selected"; } } ?>>18</option>
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
