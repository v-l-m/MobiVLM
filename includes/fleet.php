<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>VLM Mobiles</title>
<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;" />
<meta name="apple-touch-fullscreen" content="YES" />
<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
<meta http-equiv="Cache-Control" content="public"/>
<link href="css/styles.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div class="maindiv">
<div id="header">Ma flotte</div>
<?php

foreach($fleet as $key1=>$value1)
{
	if($key1 == "fleet")
		{
		foreach($value1 as $key2=>$boat)
			{
			if($boat['engaged']!="0")
				{
				$data = $mobivlm->alldatas($base_url,$pseudo,$password,$key2);
				echo "<div class='ptitle'><img src='http://www.virtual-loup-de-mer.org/flagimg.php?idflags=".$data['CNT']."'>&nbsp;&nbsp;&nbsp;".$key2." - ".$boat['boatpseudo']."</div>";
				echo "<div class='pbloc'>";
				echo "<div class='stitle'>Course : ".$data['RAN']."<br/>";
				echo "Classement : ".$data['POS']."</div><br/>";
				?>
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
				</div>
				<div align="center">
				<form action="index.php" method="get">
				<input type="hidden" name="select_idu" value="<?php echo $key2; ?>" />
				<input name="change" type="submit" value="Gerer ce bateau" class="txtbold1" />
				</form>
				</div>
				</div><br>
				<?php
				
				}
			}
		}
}
/*
echo "<pre>";
print_r($fleet);
echo "</pre>";

echo "<pre>";
print_r($_SESSION);
echo "</pre>";
*/
?>

<?php include("includes/footer.php"); ?>
</div> <!-- main div -->
<?php
//echo $_SESSION['pseudo'];
?>
</body>
</html>
