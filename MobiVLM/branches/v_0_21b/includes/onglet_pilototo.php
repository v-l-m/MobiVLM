<!-- ONGLET 3 -->
<div class="ptitle">Pilototo</div>
<div class="pbloc">
	<div class="txtbold1" align="center">
	
<table border="0" width="100%">
<tr>
<td class="txtbold1" bgcolor="#FFFFFF">Date ordre</td>
<td class="txtbold1" bgcolor="#FFFFFF">Type d'ordre</td>
<td class="txtbold1" bgcolor="#FFFFFF">Ordre</td>
</tr>
<?php
foreach ($data['PIL'] as $val) {
if($val['STS']=="pending") { $rowbgcolor ="#50EF82"; } else { $rowbgcolor ="#996666"; }
?>
<form method="get" action="">
<input type="hidden" name="onglet" value="4">
<input type="hidden" name="event" value="pilototo">
<input type="hidden" name="taskid" value="<?php echo $val['TID']; ?>">
<tr bgcolor="<?php echo $rowbgcolor; ?>">
	<td class="txtbold1" colspan="3">
	<select name="tts_day" class="txtbold1"> 
    <option value="<?php echo date("d,m,Y",time() ); ?>" <?php if(date("d/m/Y",$val['TTS'])==date("d/m/Y",time() )) { echo "selected"; } ?>><?php echo gmdate("d/m/Y",time() ); ?></option>
	<option value="<?php echo date("d,m,Y",time() + 86400 ); ?>" <?php if(date("d/m/Y",$val['TTS'])==date("d/m/Y",time()  + 86400 )) { echo "selected"; } ?>><?php echo gmdate("d/m/Y",time() + 86400 ); ?></option>
	<option value="<?php echo date("d,m,Y",time() + (2*86400) ); ?>" <?php if(date("d/m/Y",$val['TTS'])==date("d/m/Y",time() + (2*86400) )) { echo "selected"; } ?>><?php echo gmdate("d/m/Y",time() + (2*86400) ); ?></option>
	<option value="<?php echo date("d,m,Y",time() + (3*86400) ); ?>" <?php if(date("d/m/Y",$val['TTS'])==date("d/m/Y",time() + (3*86400) )) { echo "selected"; } ?>><?php echo gmdate("d/m/Y",time() + (3*86400) ); ?></option>
	<option value="<?php echo date("d,m,Y",time() + (4*86400) ); ?>" <?php if(date("d/m/Y",$val['TTS'])==date("d/m/Y",time() + (4*86400) )) { echo "selected"; } ?>><?php echo gmdate("d/m/Y",time() + (4*86400) ); ?></option>
	<option value="<?php echo date("d,m,Y",time() + (5*86400) ); ?>" <?php if(date("d/m/Y",$val['TTS'])==date("d/m/Y",time() + (5*86400) )) { echo "selected"; } ?>><?php echo gmdate("d/m/Y",time() + (5*86400) ); ?></option>
	<option value="<?php echo date("d,m,Y",time() + (6*86400) ); ?>" <?php if(date("d/m/Y",$val['TTS'])==date("d/m/Y",time() + (6*86400) )) { echo "selected"; } ?>><?php echo gmdate("d/m/Y",time() + (6*86400) ); ?></option>
	<option value="<?php echo date("d,m,Y",time() + (7*86400) ); ?>" <?php if(date("d/m/Y",$val['TTS'])==date("d/m/Y",time() + (7*86400) )) { echo "selected"; } ?>><?php echo gmdate("d/m/Y",time() + (7*86400) ); ?></option>
	</select>

	&nbsp;&nbsp;&nbsp;H <select name="tts_heure" class="txtbold1"> 
		<?php
		for($i = 0; $i < 25; ++$i)
		{
		?>
		<option value="<?php echo $i; ?>" <?php if(date("H",$val['TTS'])==$i) { echo "selected"; } ?>><?php echo $i; ?></option>
		<?php
		}
		?>
	</select>
	
	&nbsp;&nbsp;MN <select name="tts_min" class="txtbold1"> 
		<?php
		for($i = 0; $i < 61; ++$i)
		{
		?>
		<option value="<?php echo $i; ?>" <?php if(date("i",$val['TTS'])==$i) { echo "selected"; } ?>><?php echo $i; ?></option>
		<?php
		}
		?>
	</select>
<br/><br/>
	</td>
	</tr><tr bgcolor="<?php echo $rowbgcolor; ?>">
	<td></td>
	<td>
	<select name="pim" class="txtbold1"> 
    <option value="1" <?php if($val['PIM']=="1") { echo "selected"; } ?>>1:Cap fixe</option>
	<option value="2" <?php if($val['PIM']=="2") { echo "selected"; } ?>>2:Angle fixe</option>
	<option value="3" <?php if($val['PIM']=="3") { echo "selected"; } ?>>3:Pilote Ortho</option>
	<option value="4" <?php if($val['PIM']=="4") { echo "selected"; } ?>>4:BVMG</option>
	<option value="5" <?php if($val['PIM']=="5") { echo "selected"; } ?>>5:VBVMG</option>
	</select>
	</td>
	<td>
	<input name="pip" type="text" value="<?php echo $val['PIP']; ?>" class="txtbold1" size="15">
	</td>
</tr>
<tr>
<td colspan="2"><input name="pilototo_update" type="submit" value="Modifier" class="btactif"></td>
<td><input name="pilototo_delete" type="submit" value="Supprimer" class="btred"></td>
</tr>
</form>

<?php
}
?>
<!-- PILOTOTO_ADD -->
<tr><td colspan="3"><hr></td></tr>
<tr><td colspan="3" class="txtbold1" bgcolor="#FFFFFF">Ajout d'un programme</td></tr>
<form method="get" action="">
<input type="hidden" name="onglet" value="4">
<input type="hidden" name="event" value="pilototo">
<input type="hidden" name="taskid" value="<?php echo $val['TID']; ?>">
<tr bgcolor="#ffffff">
	<td class="txtbold1" colspan="3">
	<select name="tts_day" class="txtbold1"> 
    <option value="<?php echo date("d,m,Y",time() ); ?>"><?php echo gmdate("d/m/Y",time() ); ?></option>
	<option value="<?php echo date("d,m,Y",time() + 86400 ); ?>"><?php echo gmdate("d/m/Y",time() + 86400 ); ?></option>
	<option value="<?php echo date("d,m,Y",time() + (2*86400) ); ?>"><?php echo gmdate("d/m/Y",time() + (2*86400) ); ?></option>
	<option value="<?php echo date("d,m,Y",time() + (3*86400) ); ?>"><?php echo gmdate("d/m/Y",time() + (3*86400) ); ?></option>
	<option value="<?php echo date("d,m,Y",time() + (4*86400) ); ?>"><?php echo gmdate("d/m/Y",time() + (4*86400) ); ?></option>
	<option value="<?php echo date("d,m,Y",time() + (5*86400) ); ?>"><?php echo gmdate("d/m/Y",time() + (5*86400) ); ?></option>
	<option value="<?php echo date("d,m,Y",time() + (6*86400) ); ?>"><?php echo gmdate("d/m/Y",time() + (6*86400) ); ?></option>
	<option value="<?php echo date("d,m,Y",time() + (7*86400) ); ?>"><?php echo gmdate("d/m/Y",time() + (7*86400) ); ?></option>
	</select>

	&nbsp;&nbsp;&nbsp;H <select name="tts_heure" class="txtbold1"> 
		<?php
		for($i = 0; $i < 25; ++$i)
		{
		?>
		<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
		<?php
		}
		?>
	</select>
	
	&nbsp;&nbsp;MN <select name="tts_min" class="txtbold1"> 
		<?php
		for($i = 0; $i < 61; ++$i)
		{
		?>
		<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
		<?php
		}
		?>
	</select>
<br/><br/>
	</td>
	</tr><tr>
	<td></td>
	<td>
	<select name="pim" class="txtbold1"> 
    <option value="1">1:Cap fixe</option>
	<option value="2">2:Angle fixe</option>
	<option value="3">3:Pilote Ortho</option>
	<option value="4">4:BVMG</option>
	<option value="5">5:VBVMG</option>
	</select>
	</td>
	<td>
	<input name="pip" type="text" value="" class="txtbold1" size="15">
	</td>
</tr>
<tr>
<td colspan="2"><input name="pilototo_add" type="submit" value="Ajouter" class="txtbold1"></td>
<td></td>
</tr>
</form>
</table>
	</div>
</div>
<br/>