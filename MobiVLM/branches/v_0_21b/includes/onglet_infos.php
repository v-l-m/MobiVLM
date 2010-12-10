<!-- ONGLET 1 -->
<div class="ptitle">Informations</div>
<div class="pbloc">
<div align="center" width="100%" align="center">
<table border="0" cellpadding="1" width="66%">
<tr align="center">
<td class="txtbold1" width="10%" bgcolor="#cccccc">Lat</td>
<td bgcolor="#FFFFFF" class="txtbold2" width="23%"><?php echo $data['dsp_lat']; ?></td>
<td class="txtbold1" width="10%" bgcolor="#cccccc">Lon</td>
<td bgcolor="#FFFFFF" class="txtbold2" width="23%"><?php echo $data['dsp_lon']; ?></td>
</tr>
</table>

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

<table border="0" cellpadding="1" width="100%">
<tr align="center">
<td class="txtbold1" width="33%" bgcolor="#cccccc">Distance WP</td>
<td class="txtbold1" width="66%" bgcolor="#cccccc">Temps au WP</td>
</tr>
<tr align="center">
<td bgcolor="#FFFFFF" class="txtbold2"><?php echo $data['DNM']; ?></td>
<td bgcolor="#FFFFFF" class="txtbold2"><?php echo $data['frm_eta']; ?></td>
</tr>
</table>

<table border="0" cellpadding="1" width="100%">
<tr align="center">
<td class="txtbold1" width="33%" bgcolor="#cccccc">Ortho</td>
<td class="txtbold1" width="33%" bgcolor="#cccccc">Loxo</td>
<td class="txtbold1" width="33%" bgcolor="#cccccc">Vmg</td>
</tr>
<tr align="center">
<td bgcolor="#FFFFFF" class="txtbold2"><?php echo $data['dsp_ort']; ?></td>
<td bgcolor="#FFFFFF" class="txtbold2"><?php echo $data['dsp_lox']; ?></td>
<td bgcolor="#FFFFFF" class="txtbold2"><?php echo $data['VMG']; ?></td>
</tr>
</table>

<!-- VLM20 -->
<div align="center">
<img src="<?php echo $mobivlm->dsp_vlm20($data); ?>" ><br>
</div>


<table border="0" cellpadding="1" width="100%">
<tr align="center">
<td class="txtbold1" width="33%" bgcolor="#cccccc">Wind speed</td>
<td class="txtbold1" width="33%" bgcolor="#cccccc">Wind Direction</td>
<td class="txtbold1" width="33%" bgcolor="#cccccc">Wind Angle</td>
</tr>
<tr align="center">
<td bgcolor="#FFFFFF" class="txtbold2"><?php echo $data['dsp_tws']; ?></td>
<td bgcolor="#FFFFFF" class="txtbold2"><?php echo $data['dsp_twd']; ?></td>
<td bgcolor="#FFFFFF" class="txtbold2"><?php echo $data['angle_vent']; ?></td>
</tr>
</table>

</div>

</div>
<br/>

