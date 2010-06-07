<!-- ONGLET 1 -->
<div class="contenu_onglet" id="contenu_onglet_1">
<?php echo $current_infos; ?>
<div align="center" width="100%" align="center">

<table border="0" cellpadding="1" width="66%">
<tr align="center">
<td class="txtbold1" width="10%" bgcolor="#cccccc">Lat</td>
<td bgcolor="#FFFFFF" class="txtbold2" width="23%"><?php echo (round($LAT)/1000); ?></td>
<td class="txtbold1" width="10%" bgcolor="#cccccc">Lon</td>
<td bgcolor="#FFFFFF" class="txtbold2" width="23%"><?php echo (round($LON)/1000); ?></td>
</tr>
</table>

<table border="0" cellpadding="1" width="100%">
<tr align="center">
<td class="txtbold1" width="33%" bgcolor="#cccccc">Speed</td>
<td class="txtbold1" width="33%" bgcolor="#cccccc">Hdg</td>
<td class="txtbold1" width="33%" bgcolor="#cccccc">Vmg</td>
</tr>
<tr align="center">
<td bgcolor="#FFFFFF" class="txtbold2"><?php echo $BSP; ?></td>
<td bgcolor="#FFFFFF" class="txtbold2"><?php echo (round($HDG*10)/10); ?></td>
<td bgcolor="#FFFFFF" class="txtbold2"><?php echo $VMG; ?></td>
</tr>
</table>

<table border="0" cellpadding="1" width="100%">
<tr align="center">
<td class="txtbold1" width="33%" bgcolor="#cccccc">Distance WP</td>
<td class="txtbold1" width="66%" bgcolor="#cccccc">Temps au WP</td>
</tr>
<tr align="center">
<td bgcolor="#FFFFFF" class="txtbold2"><?php echo $DNM; ?></td>
<td bgcolor="#FFFFFF" class="txtbold2"><?php echo format_eta($ETA); ?></td>
</tr>
</table>

<table border="0" cellpadding="1" width="100%">
<tr align="center">
<td class="txtbold1" width="33%" bgcolor="#cccccc">Ortho</td>
<td class="txtbold1" width="33%" bgcolor="#cccccc">Loxo</td>
<td class="txtbold1" width="33%" bgcolor="#cccccc">Vmg</td>
</tr>
<tr align="center">
<td bgcolor="#FFFFFF" class="txtbold2"><?php echo (round($ORT*10)/10); ?></td>
<td bgcolor="#FFFFFF" class="txtbold2"><?php echo (round($LOX*10)/10); ?></td>
<td bgcolor="#FFFFFF" class="txtbold2"><?php echo $VMG; ?></td>
</tr>
</table>



<div align="center">
<?php
// WIND ANGLE
$urlbase_wind_angle = 'http://www.virtual-loup-de-mer.org/windangle.php?';
$url_wind_angle = $urlbase_wind_angle . $esp
		. 'wheading=' . $VTWD . $sep . $esp
		. 'boatheading=' . $HDG . $sep . $esp
		. 'wspeed=' . $TWS . $sep . $esp
		. 'roadtoend=' . $ORT . $sep . $esp
		. 'boattype=' . $POL;
?>
<img src="<?php echo $url_wind_angle; ?>" ><br>
</div>



<table border="0" cellpadding="1" width="100%">
<tr align="center">
<td class="txtbold1" width="33%" bgcolor="#cccccc">Wind speed</td>
<td class="txtbold1" width="33%" bgcolor="#cccccc">Wind Direction</td>
<td class="txtbold1" width="33%" bgcolor="#cccccc">Wind Angle</td>
</tr>
<tr align="center">
<td bgcolor="#FFFFFF" class="txtbold2"><?php echo (round($TWS*10)/10); ?></td>
<td bgcolor="#FFFFFF" class="txtbold2"><?php echo (round($TWD*10)/10); ?></td>
<td bgcolor="#FFFFFF" class="txtbold2"><?php echo calcul_angle_vent($HDG, $TWD); ?></td>
</tr>
</table>

</div>

</div>

