<?php
if(isset($_COOKIE['map_haut']) ) { $map_haut = $_COOKIE['map_haut']; }
elseif(isset($_SESSION['map_haut']) ) { $map_haut = $_SESSION['map_haut']; }
else { $map_haut = "640"; }

if(isset($_COOKIE['map_larg']) ) { $map_larg = $_COOKIE['map_larg']; }
elseif(isset($_SESSION['map_larg']) ) { $map_larg = $_SESSION['map_larg']; }
else { $map_larg = "480"; }

if(isset($_COOKIE['heure_carte']) ) { $heure_carte = $_COOKIE['heure_carte']; }
elseif(isset($_SESSION['heure_carte']) ) { $heure_carte = $_SESSION['heure_carte']; }


if(isset($_COOKIE['zoom']) ) { $zoom = $_COOKIE['zoom']; }
elseif(isset($_SESSION['zoom']) ) { $zoom = $_SESSION['zoom']; }


if(isset($_COOKIE['list']) ) { $list = $_COOKIE['list']; }
elseif(isset($_SESSION['list']) ) { $list = $_SESSION['list']; }
else { $list = "myboat"; }

if(isset($_COOKIE['estime']) ) { $estime = $_COOKIE['estime']; }
elseif(isset($_SESSION['estime']) ) { $estime = $_SESSION['estime']; }
else { $estime = "100"; }
?>

<!-- ONGLET 3 -->

<div class="ptitle">Cartographie</div>
<div class="pbloc">
	<div class="txtbold1" align="center">
	
	<form action="carte.php" method="get" name="go_carto">
	<input type="hidden" name="onglet" value="3">
	<input type="hidden" name="RAC" value="<?php echo $data['RAC']; ?>">
	<input type="hidden" name="map_lat" value="<?php echo $data['map_lat']; ?>">
	<input type="hidden" name="map_lon" value="<?php echo $data['map_lon']; ?>">
	<input type="hidden" name="IDU" value="<?php echo $data['IDU']; ?>">
	<table border="0" cellpadding="1" width="66%">
	
	<tr>
	<td class="txtbold1" width="33%" bgcolor="#ffffff">Hauteur : </td>
	<td class="txtbold1" width="33%" bgcolor="#cccccc">
	<input type="text" name="map_haut" value="<?php echo $map_haut; ?>" size="10" class="txtbold1">
	</td>
	</tr>

	<tr>
	<td class="txtbold1" width="33%" bgcolor="#ffffff">Largeur : </td>
	<td class="txtbold1" width="33%" bgcolor="#cccccc">
	<input type="text" name="map_larg" value="<?php echo $map_larg; ?>" size="10" class="txtbold1">
	</td>
	</tr>

	<tr>
	<td class="txtbold1" width="33%" bgcolor="#ffffff">HEURE : </td>
	<td class="txtbold1" width="33%" bgcolor="#cccccc">
	<select name="heure">
	  <option value="0" <?php if(isset($heure_carte)) { if($heure_carte=="0") { echo "selected"; } } else { echo "selected"; }?>>H + 0</option>
	  <option value="1" <?php if(isset($heure_carte)) { if($heure_carte=="1") { echo "selected"; } } ?>>H + 1</option>
	  <option value="2" <?php if(isset($heure_carte)) { if($heure_carte=="2") { echo "selected"; } } ?>>H + 2</option>
	  <option value="3" <?php if(isset($heure_carte)) { if($heure_carte=="3") { echo "selected"; } } ?>>H + 3</option>
	  <option value="4" <?php if(isset($heure_carte)) { if($heure_carte=="4") { echo "selected"; } } ?>>H + 4</option>
	  <option value="5" <?php if(isset($heure_carte)) { if($heure_carte=="5") { echo "selected"; } } ?>>H + 5</option>
	  <option value="6" <?php if(isset($heure_carte)) { if($heure_carte=="6") { echo "selected"; } } ?>>H + 6</option>
	  <option value="9" <?php if(isset($heure_carte)) { if($heure_carte=="9") { echo "selected"; } } ?>>H + 9</option>
	  <option value="12" <?php if(isset($heure_carte)) { if($heure_carte=="12") { echo "selected"; } } ?>>H + 12</option>
	  <option value="18" <?php if(isset($heure_carte)) { if($heure_carte=="18") { echo "selected"; } } ?>>H + 18</option>
	  <option value="24" <?php if(isset($heure_carte)) { if($heure_carte=="24") { echo "selected"; } } ?>>H + 24</option>
	  <option value="36" <?php if(isset($heure_carte)) { if($heure_carte=="36") { echo "selected"; } } ?>>H + 36</option>
	  <option value="48" <?php if(isset($heure_carte)) { if($heure_carte=="48") { echo "selected"; } } ?>>H + 48</option>
	  <option value="60" <?php if(isset($heure_carte)) { if($heure_carte=="60") { echo "selected"; } } ?>>H + 60</option>
	</select>
	</td>
	</tr>

	<tr>
	<td class="txtbold1" width="33%" bgcolor="#ffffff">ZOOM : </td>
	<td class="txtbold1" width="33%" bgcolor="#cccccc">
	<select name="zoom">
	  <option value="2" <?php if(isset($zoom)) { if($zoom=="2") { echo "selected"; } } ?>>2</option>
	  <option value="3" <?php if(isset($zoom)) { if($zoom=="3") { echo "selected"; } } ?>>3</option>
	  <option value="4" <?php if(isset($zoom)) { if($zoom=="4") { echo "selected"; } } else { echo "selected"; }?>>4</option>
	  <option value="5" <?php if(isset($zoom)) { if($zoom=="5") { echo "selected"; } } ?>>5</option>
	  <option value="6" <?php if(isset($zoom)) { if($zoom=="6") { echo "selected"; } } ?>>6</option>
	  <option value="7" <?php if(isset($zoom)) { if($zoom=="7") { echo "selected"; } } ?>>7</option>
	  <option value="8" <?php if(isset($zoom)) { if($zoom=="8") { echo "selected"; } } ?>>8</option>
	  <option value="9" <?php if(isset($zoom)) { if($zoom=="9") { echo "selected"; } } ?>>9</option>
	  <option value="10" <?php if(isset($zoom)) { if($zoom=="10") { echo "selected"; } } ?>>10</option>
	  <option value="11" <?php if(isset($zoom)) { if($zoom=="11") { echo "selected"; } } ?>>11</option>
	  <option value="12" <?php if(isset($zoom)) { if($zoom=="12") { echo "selected"; } } ?>>12</option>
	  <option value="13" <?php if(isset($zoom)) { if($zoom=="13") { echo "selected"; } } ?>>13</option>
	  <option value="14" <?php if(isset($zoom)) { if($zoom=="14") { echo "selected"; } } ?>>14</option>
	  <option value="15" <?php if(isset($zoom)) { if($zoom=="15") { echo "selected"; } } ?>>15</option>
	  <option value="16" <?php if(isset($zoom)) { if($zoom=="16") { echo "selected"; } } ?>>16</option>
	  <option value="17" <?php if(isset($zoom)) { if($zoom=="17") { echo "selected"; } } ?>>17</option>
	  <option value="18" <?php if(isset($zoom)) { if($zoom=="18") { echo "selected"; } } ?>>18</option>
	</select>
	</td>
	</tr>

	<tr>
	<td class="txtbold1" width="33%" bgcolor="#ffffff">Estime : </td>
	<td class="txtbold1" width="33%" bgcolor="#cccccc">
	<?php if(isset($_SESSION['estime'])) { $estime = $_SESSION['estime']; } else { $estime = "100"; }?>
	<input type="text" name="estime" value="<?php echo $estime; ?>" size="10" class="txtbold1">
	</td>
	</tr>

	<tr>
	<td class="txtbold1" width="33%" bgcolor="#ffffff">Bateaux affich&eacute;s : </td>
	<td class="txtbold1" width="33%" bgcolor="#cccccc">

	<select name="list">
	  <option value="myboat" <?php if(isset($list)) { if($list=="myboat") { echo "selected"; } } else { echo "selected"; }?>>Seulement le mien</option>
	  <option value="my5opps" <?php if(isset($list)) { if($list=="my5opps") { echo "selected"; } } ?>>5 voisins</option>
	  <option value="my10opps" <?php if(isset($list)) { if($list=="my10opps") { echo "selected"; } } ?>>10 voisins</option>
	  <option value="meandtop10" <?php if(isset($list)) { if($list=="meandtop10") { echo "selected"; } } ?>>Top 10</option>
	  <option value="mylist" <?php if(isset($list)) { if($list=="mylist") { echo "selected"; } } ?>>Ma s&eacute;lection</option>
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
	</form>
	</div>
</div>
<br/>