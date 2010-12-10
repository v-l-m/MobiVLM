<!-- ONGLET 2 -->
<div class="ptitle">Navigation</div>
<div class="pbloc">
<div bgcolor="#CCCCCC" align="center" width="100%" align="center">

<table border="0" cellpadding="1" width="100%">
<tr align="center">
<td class="txtbold1" width="33%" bgcolor="#cccccc">Speed</td>
<td class="txtbold1" width="33%" bgcolor="#cccccc">Hdg</td>
<td class="txtbold1" width="33%" bgcolor="#cccccc">Vmg</td>
</tr>
<tr align="center">
<td bgcolor="#FFFFFF" class="txtbold2"><?php echo $data['BSP']; ?></td>
<td bgcolor="#FFFFFF" class="txtbold2"><?php echo $data['dsp_hdg']; ?></td>
<td bgcolor="#FFFFFF" class="txtbold2"><?php echo $data['VMG']; ?></td>
</tr>
</table>
<hr>
<table border="0" cellpadding="1">
<tr>
<td class="txtbold1" align="left" bgcolor="#FFFFFF" colspan="3">Mode Pilote</td>
</tr>
<tr>
<form method="get" action="<?php echo $url_actions; ?>">
<input type="hidden" name="onglet" value="2">
<input type="hidden" name="event" value="pim1">
<td class="txtbold1" width="33%" align="left" bgcolor="#cccccc">CAP</td>
<td class="txtbold1" width="33%" align="center">
<input name="hdg" type="text" value="<?php echo $data['dsp_hdg']; ?>" class="txtbold1" size="10"></td>
<td class="txtbold1" width="33%" align="left">
<?php
if($data['PIM'] == "1") { $btstyle = "btactif"; } else { $btstyle = "txtbold1"; }
?>
<input name="btsub" type="submit" value="CAP FIXE" class="<?php echo $btstyle; ?>">
</td>
</form>
</tr>
<tr><td colspan="3"></td></tr>
<form method="get" action="<?php echo $url_actions; ?>">
<input type="hidden" name="onglet" value="2">
<input type="hidden" name="event" value="pim2">
<tr>
<td class="txtbold1" width="33%" align="left" bgcolor="#cccccc">ANGLE</td>
<td class="txtbold1" width="33%" align="center">
<input name="twa" type="text" value="<?php echo $data['angle_vent']; ?>" class="txtbold1" size="10"></td>
<td class="txtbold1" width="33%" align="left">
<?php
if($data['PIM'] == "2") { $btstyle = "btactif"; } else { $btstyle = "txtbold1"; }
?>
<input name="btsub" type="submit" value="REGULATEUR" class="<?php echo $btstyle; ?>">
</td>
</tr>
</form>
<tr><td colspan="3"><hr></td></tr>
<tr>
<td class="txtbold1" width="33%" align="left" bgcolor="#FFFFFF" colspan="3">Way Point</td>
</tr>
<form method="get" action="<?php echo $url_actions; ?>">
<input type="hidden" name="onglet" value="2">
<input type="hidden" name="event" value="newwp">
<tr>
<td class="txtbold1" width="33%" align="left" bgcolor="#cccccc">LATITUDE</td>
<td class="txtbold1" width="33%" align="center">
<input name="lat" type="text" value="<?php echo $data['WPLAT']; ?>" class="txtbold1" size="10%">
</td>
<td class="txtbold1" width="33%" align="left"></td>
</tr>
<tr>
<td class="txtbold1" width="33%" align="left" bgcolor="#cccccc">LONGITUDE</td>
<td class="txtbold1" width="33%" align="center">
<input name="lon" type="text" value="<?php echo $data['WPLON']; ?>" class="txtbold1" size="10">
</td>
<td class="txtbold1" width="33%" align="left"></td>
</tr>
<tr>
<td class="txtbold1" width="33%" align="left" bgcolor="#cccccc">@WPH</td>
<td class="txtbold1" width="33%" align="center">
<input name="targetandhdg" type="text" value="<?php echo $data['H@WP']; ?>" class="txtbold1" size="10">
</td>
<td class="txtbold1" width="33%" align="left">
<input name="btsub" type="submit" value="CHANGER" class="txtbold1">
</td>
</tr>
</form>
<tr><td colspan="3"><hr></td></tr>
<tr>
<td class="txtbold1" width="33%" align="left" bgcolor="#FFFFFF" colspan="3">Mode de suivi du Way Point</td>
</tr>
<tr>
<td class="txtbold1" width="33%" align="center">
<form method="get" action="<?php echo $url_actions; ?>">
<input type="hidden" name="onglet" value="2">
<input type="hidden" name="event" value="pim3">
<?php
if($data['PIM'] == "3") { $btstyle = "btactif"; } else { $btstyle = "txtbold1"; }
?>
<input name="btsub" type="submit" value="ORTHO" class="<?php echo $btstyle; ?>">
</form>
</td>
<td class="txtbold1" width="33%" align="center">
<form method="get" action="<?php echo $url_actions; ?>">
<input type="hidden" name="onglet" value="2">
<input type="hidden" name="event" value="pim4">
<?php
if($data['PIM'] == "4") { $btstyle = "btactif"; } else { $btstyle = "txtbold1"; }
?>
<input name="btsub" type="submit" value="BVMG" class="<?php echo $btstyle; ?>">
</form>
</td>
<td class="txtbold1" width="33%" align="center">
<form method="get" action="<?php echo $url_actions; ?>">
<input type="hidden" name="onglet" value="2">
<input type="hidden" name="event" value="pim5">
<?php
if($data['PIM'] == "5") { $btstyle = "btactif"; } else { $btstyle = "txtbold1"; }
?>
<input name="btsub" type="submit" value="VBVMG" class="<?php echo $btstyle; ?>">
</form>
</td>
</tr>
</table>
</div>
</div>
<br/>
