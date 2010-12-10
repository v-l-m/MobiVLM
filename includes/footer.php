<br>
<?php
if($dsp_case != "fleet")
{
?>
<table border="0" width="100%" bgcolor="#ffffff">
<tr>
<td align="center">
<form action="index.php?fleet=1" method="get">
<input type="hidden" name="fleet" value="1" />
<input name="change" type="submit" value="<< Changer de bateau" class="txtbold1" />
</form>
</td>
<td align="center">
<form action="index.php" method="get">
<input name="actualiser" type="submit" value="Actualiser" class="txtbold1" />
</form>
</td>
<td align="center">
<form action="logout.php" method="get">
<input name="logout" type="submit" value="Logout" class="txtbold1" />
</form>
</td>
</tr>
</table>
<?php
}
else
{
?>
<table border="0" width="100%" bgcolor="#ffffff">
<tr>
<td align="center">
<form action="logout.php" method="get">
<input name="logout" type="button" onclick="javascript:document.location='logout.php';" value="Logout" class="txtbold1" />
</form>
</td>
</tr>
</table>
<?php
}
?>
<br>