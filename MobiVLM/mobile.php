<?php
/* ***************************************************************
L'affichage au client, les formulaires et un peu de d�co
****************************************************************** */
/*
Variables en provenance de VLM= 

    #* WPL : liste de Waypoints (liste)
    #* RAC : numéro de la course (string)
    #* IDB : nom du bateau (string)
    #* RAN : nom de la course (string)
    #* POS : classement dans la course (string - xxx/yyy)
    #* PIP : pilot parameter (string - doit le rester �  causes des WP: x.xx,y.yy
    #* POL : nom de la polaire (sans boat_) (string)
    #* MCR : 'mapCenter' (string), ie centre de la carte
    #* MLY : 'mapLayers' (string), ie type de layers
    #* MOP : 'mapOpponents' (string), ie type d'affichage des concurrents
    #* MTL : 'mapTools' (string), ie 
    #* MPO : 'mapPrefOpponents' (liste), ie concurrents �  suivre
    #* ETA : Date estimée d'arrivé, seulement si pas de wp perso (string)
    #* IDU : numéro de bateau (int)
    #* NWP : numéro du prochain waypoing (int)
    #* PIM : Pilot mode (int)
    #* NUP : nombre de secondes jusqu'�  la prochaine VAC (int)
    #* MWD : 'mapX' (int), ie taille largeur en pixel
    #* MHT : 'mapY' (int), ie taille hauteur en pixel
    #* MAG : 'mapAge' (int), ie age des trajectoires
    #* MAR : 'maparea' (int), ie taille de la carte
    #* MES : 'mapEstime' (int), ie estime
    #* MGD : 'mapMaille' (int), ie taille de la grid de vent
    #* MDT : 'mapDrawtextwp' (string) on/off
    #* BSP : vitesse du bateau (Boat SPeed) (float)
    #* HDG : direction (HeaDinG)
    #* DNM : Distance to next mark (float)
    #* ORT : Cap ortho to next mark (float)
    #* LOX : Cap loxo to next mark (float)
    #* VMG : VMG (float)
    #* TWD : Wind direction (float)
    #* TWS : Wind speed (float)
    #* TWA : Wind angle - Allure (float)
    #* LOC : loch (float)
    #* AVG : vitesse moyenne (float)
    #* WPLAT : latitude du wp perso (float, en degré)
    #* WPLON : longitude du wp perso (float, en degré)
    #* H@WP : mode Heading@WP, (float, degré)
    #* LAT : latitude (float, degré)
    #* LON : longitude (float, degré)
    #* TUP : Time to Update (�  partir de NUP) (int)
    #* TFS : Time From Start (int)
    #* RNK : Rank : classement dans la course (int)
    #* NBS : Number of Boat subscribed (int)
    #* NPD : Notepad (blocnote)
    #* EML : EMail
    #* COL : Color
    #* CNT : Country 
    #* SRV : Servername 
    #* PIL1: Pilototo instruction 1 (id,time,PIM,PIP,status)
    #* PIL2: Pilototo instruction 2 (id,time,PIM,PIP,status)
    #* PIL3: Pilototo instruction 3 (id,time,PIM,PIP,status)
    #* PIL4: Pilototo instruction 4 (id,time,PIM,PIP,status)
    #* PIL5: Pilototo instruction 5 (id,time,PIM,PIP,status)
    #* THM: nom du theme
    #* HID: trace cachée (1) ou visible (0)
    #* VAC: durée de la vacation (en secondes)

*/
$url_actions = "actions_vlm.php";
$IDU = $_SESSION['IDU'];
$PIM = $data['PIM'];
$IDB = $data['IDB'];
$course = $data['RAC'];
$RAC = $data['RAC'];
$RAN = $data['RAN'];
$pseudo_curl = $_SESSION['pseudo'];
$password = $_SESSION['password'];

$cur_date=date("d/m/Y H:i:s");
$heure=date("");
$serveur="s11";

$sep = '&amp;';
$esp = '%20%20%20%20%20%20%20%20';

$LAT = $data['LAT'];
$LON = $data['LON'];
$WPLAT = $data['WPLAT'];
$WPLON = $data['WPLON'];
$BSP = $data['BSP'];
$HDG = $data['HDG'];
$DNM = $data['DNM'];
$ORT = $data['ORT'];
$LOX = $data['LOX'];
$VMG = $data['VMG'];
$LOC = $data['LOC'];
$AVG = $data['AVG'];
$TWD = $data['TWD'];
$TWA = $data['TWA'];
$VTWD = angle_oppose($TWD);
$TWS = $data['TWS'];
$POL = $data['POL'];
$POS = $data['POS'];
$CNT = $data['CNT'];

$current_infos = "<div class=\"txtbold1\" align=\"center\"><img src=\"http://www.virtual-loup-de-mer.org/flagimg.php?idflags=".$CNT."\">&nbsp;&nbsp;&nbsp;".$pseudo." - ".utf8_decode($RAN)."<br>Position : ".$POS." - ".$cur_date."</div>";

if(empty($_GET['onglet'])) { $current_onglet = "1"; } else { $current_onglet = $_GET['onglet']; }
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>MobiVLM 0.1</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<style type="text/css">
<!--
.maindiv {
	background-color: #CCFFFF;
	height: 500px;
	width: 400px;
}
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
body,td,th {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 10px;
}
.btactif {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
	font-weight:bold;
	background-color: #50EF82;
}
.txtbold1 {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
	font-weight:bold;
}
.txtbold2 {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 18px;
	font-weight:bold;
}
		.onglet
        {
                
                margin-left:3px;
                margin-right:3px;
                padding:1px;
                cursor:pointer;
        }
        .onglet_0
        {
				font-family: Arial, Helvetica, sans-serif;
				font-size: 14px;
				font-weight: bold;    
            	padding-bottom:8px;
				background:#bbbbbb;
				               
        }
        .onglet_1
        {
                font-family: Arial, Helvetica, sans-serif;
				font-size: 14px;
				font-weight: bold;    
            	padding-bottom:8px;
        }
        .contenu_onglet
        {
                background-color:#dddddd;
                
                
                display:none;
        }
        ul
        {
                margin-top:0px;
                margin-bottom:0px;
                margin-left:-10px
        }
        h1
        {
                margin:0px;
                padding:0px;
        }
-->
</style>
<script type="text/javascript">
        //<!--
function change_onglet(name)
                {
                        document.getElementById('onglet_'+anc_onglet).className = 'onglet_0 onglet';
                        document.getElementById('onglet_'+name).className = 'onglet_1 onglet';
                        document.getElementById('contenu_onglet_'+anc_onglet).style.display = 'none';
                        document.getElementById('contenu_onglet_'+name).style.display = 'block';
                        anc_onglet = name;
                }

//-->
</script>
</head>

<body>
<div class="maindiv">

<div class="systeme_onglets">
  
     <div class="onglets">&nbsp;&nbsp;&nbsp;
            <span class="onglet_0 onglet" id="onglet_1" onclick="javascript:change_onglet('1');">INFOS</span>
            <span class="onglet_0 onglet" id="onglet_2" onclick="javascript:change_onglet('2');">NAVIG</span>
            <span class="onglet_0 onglet" id="onglet_3" onclick="javascript:change_onglet('3');">CARTO + 0</span>
			<span class="onglet_0 onglet" id="onglet_4" onclick="javascript:change_onglet('4');">CARTO + 12</span>
			<span class="onglet_0 onglet" id="onglet_5" onclick="javascript:change_onglet('5');">CARTO + 24</span>
      </div>
	<br>
<div class="contenu_onglets">

<div class="contenu_onglet" id="contenu_onglet_1">
<?php echo $current_infos; ?>
<table border="0" cellpadding="1" bgcolor="#CCCCCC" align="center" width="300"><tr><td align="center">

<table border="0" cellpadding="1">
<tr align="center"><td class="txtbold1" width="100">Lat</td><td class="txtbold1" width="100">Lon</td></tr>
<tr align="center">
<td bgcolor="#FFFFFF" class="txtbold2"><?php echo (round($LAT)/1000); ?></td>
<td bgcolor="#FFFFFF" class="txtbold2"><?php echo (round($LON)/1000); ?></td>
</tr>
</table>

<table border="0" cellpadding="1">
<tr align="center"><td class="txtbold1" width="100">Speed</td><td class="txtbold1" width="100">Avg</td><td class="txtbold1" width="100">Hdg</td></tr>
<tr align="center">
<td bgcolor="#FFFFFF" class="txtbold2"><?php echo $BSP; ?></td>
<td bgcolor="#FFFFFF" class="txtbold2"><?php echo $AVG; ?></td>
<td bgcolor="#FFFFFF" class="txtbold2"><?php echo (round($HDG*10)/10); ?></td>
</tr>
</table>

<table border="0" cellpadding="1">
<tr align="center"><td class="txtbold1" width="100">Dnm</td><td class="txtbold1" width="100">Loch</td></tr>
<tr align="center">
<td bgcolor="#FFFFFF" class="txtbold2"><?php echo $DNM; ?></td>
<td bgcolor="#FFFFFF" class="txtbold2"><?php echo (round($LOC*10)/10); ?></td>
</tr>
</table>

<table border="0" cellpadding="1">
<tr align="center"><td class="txtbold1" width="100">Ortho</td><td class="txtbold1" width="100">Loxo</td><td class="txtbold1" width="100">Vmg</td></tr>
<tr align="center">
<td bgcolor="#FFFFFF" class="txtbold2"><?php echo (round($ORT*10)/10); ?></td>
<td bgcolor="#FFFFFF" class="txtbold2"><?php echo (round($LOX*10)/10); ?></td>
<td bgcolor="#FFFFFF" class="txtbold2"><?php echo $VMG; ?></td>
</tr>
</table>

</td></tr></table>

<table border="0" cellpadding="1" align="center"><tr><td align="center">
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
</td></tr></table>

<table border="0" cellpadding="1" bgcolor="#CCCCCC" align="center" width="300"><tr><td align="center">

<table border="0" cellpadding="1">
<tr align="center">
<td class="txtbold1" width="100">Wind speed</td>
<td class="txtbold1" width="100">Wind Direction</td>
<td class="txtbold1" width="100">Wind Angle</td>
</tr>
<tr align="center">
<td bgcolor="#FFFFFF" class="txtbold2"><?php echo (round($TWS*10)/10); ?></td>
<td bgcolor="#FFFFFF" class="txtbold2"><?php echo (round($TWD*10)/10); ?></td>
<td bgcolor="#FFFFFF" class="txtbold2"><?php echo calcul_angle_vent($HDG, $TWD); ?></td>
</tr>
</table>

</td></tr></table>

</div>

<!-- ONGLET 2 -->
<div class="contenu_onglet" id="contenu_onglet_2">
<?php echo $current_infos; ?>
<table border="0" cellpadding="1" bgcolor="#CCCCCC" align="center" width="300"><tr><td align="center">

<table border="0" cellpadding="1">
<tr align="center">
<td class="txtbold1" width="100">Speed</td>
<td class="txtbold1" width="100">Hdg</td>
<td class="txtbold1" width="100">Vmg</td>
</tr>
<tr align="center">
<td bgcolor="#FFFFFF" class="txtbold2"><?php echo $BSP; ?></td>
<td bgcolor="#FFFFFF" class="txtbold2"><?php echo (round($HDG*10)/10); ?></td>
<td bgcolor="#FFFFFF" class="txtbold2"><?php echo $VMG; ?></td>
</tr>
</table>
<hr><br>
<table border="0" cellpadding="1">
<tr>
<td class="txtbold1" width="100" align="left" bgcolor="#FFFFFF" colspan="3">Mode Pilote</td>
</tr>
<tr>
<form method="get" action="<?php echo $url_actions; ?>">
<input type="hidden" name="onglet" value="2">
<input type="hidden" name="event" value="pim1">
<td class="txtbold1" width="100" align="left">CAP</td>
<td class="txtbold1" width="100" align="center"><input name="hdg" type="text" value="<?php echo (round($HDG*10)/10); ?>" class="txtbold1"></td>
<td class="txtbold1" width="20" align="left">
<?php
if($PIM == "1") { $btstyle = "btactif"; } else { $btstyle = "txtbold1"; }
?>
<input name="btsub" type="submit" value="CAP FIXE" class="<?php echo $btstyle; ?>">
</td>
</form>
</tr>
<tr><td colspan="3"><br></td></tr>
<form method="get" action="<?php echo $url_actions; ?>">
<input type="hidden" name="onglet" value="2">
<input type="hidden" name="event" value="pim2">
<tr>
<td class="txtbold1" width="100" align="left">ANGLE</td>
<td class="txtbold1" width="100" align="center"><input name="twa" type="text" value="<?php echo calcul_angle_vent($HDG, $TWD); ?>" class="txtbold1"></td>
<td class="txtbold1" width="20" align="left">
<?php
if($PIM == "2") { $btstyle = "btactif"; } else { $btstyle = "txtbold1"; }
?>
<input name="btsub" type="submit" value="REGULATEUR" class="<?php echo $btstyle; ?>">
</td>
</tr>
</form>
<tr><td colspan="3"><hr><br></td></tr>
<tr>
<td class="txtbold1" width="100" align="left" bgcolor="#FFFFFF" colspan="3">Way Point</td>
</tr>
<form method="get" action="<?php echo $url_actions; ?>">
<input type="hidden" name="onglet" value="2">
<input type="hidden" name="event" value="newwp">
<tr>
<td class="txtbold1" width="100" align="left">LATITUDE</td>
<td class="txtbold1" width="100" align="center">
<input name="lat" type="text" value="<?php echo $WPLAT; ?>" class="txtbold1">
</td>
<td class="txtbold1" width="20" align="left"></td>
</tr>
<tr>
<td class="txtbold1" width="100" align="left">LONGITUDE</td>
<td class="txtbold1" width="100" align="center">
<input name="lon" type="text" value="<?php echo $WPLON; ?>" class="txtbold1">
</td>
<td class="txtbold1" width="20" align="left"><input name="btsub" type="submit" value="CHANGER" class="txtbold1"></td>
</tr>
</form>
<tr><td colspan="3"><hr><br></td></tr>
<tr>
<td class="txtbold1" width="100" align="left" bgcolor="#FFFFFF" colspan="3">Mode de suivi du Way Point</td>
</tr>
<tr>
<td class="txtbold1" width="100" align="center">
<form method="get" action="<?php echo $url_actions; ?>">
<input type="hidden" name="onglet" value="2">
<input type="hidden" name="event" value="pim3">
<?php
if($PIM == "3") { $btstyle = "btactif"; } else { $btstyle = "txtbold1"; }
?>
<input name="btsub" type="submit" value="ORTHO" class="<?php echo $btstyle; ?>">
</form>
</td>
<td class="txtbold1" width="100" align="center">
<form method="get" action="<?php echo $url_actions; ?>">
<input type="hidden" name="onglet" value="2">
<input type="hidden" name="event" value="pim4">
<?php
if($PIM == "4") { $btstyle = "btactif"; } else { $btstyle = "txtbold1"; }
?>
<input name="btsub" type="submit" value="BVMG" class="<?php echo $btstyle; ?>">
</form>
</td>
<td class="txtbold1" width="20" align="center">
<form method="get" action="<?php echo $url_actions; ?>">
<input type="hidden" name="onglet" value="2">
<input type="hidden" name="event" value="pim5">
<?php
if($PIM == "5") { $btstyle = "btactif"; } else { $btstyle = "txtbold1"; }
?>
<input name="btsub" type="submit" value="VBVMG" class="<?php echo $btstyle; ?>">
</form>
</td>
</tr>
</table>
</td></tr></table>
<br><br><br>
</div>

<!-- ONGLET 3 -->
	<div class="contenu_onglet" id="contenu_onglet_3">
<?php
$map_lat = $LAT/1000;
$map_lon = $LON/1000;
?>
<?php echo $current_infos; ?>
	<?php
	echo "<img src=\"http://".$serveur.".virtual-loup-de-mer.org/mercator.img.php?idraces=".$RAC."&lat=".$map_lat."&long=".$map_lon."&x=480&y=640&maptype=simple&maparea=4&drawortho=no&drawwind=0&drawtextwp=on&maille=5&proj=mercator&seacolor=ffffff&tracks=on&age=268&estime=100&list=mylist&boat=".$IDU."&text=right\">";
	?>
	</div>
	<div class="contenu_onglet" id="contenu_onglet_4">
<?php echo $current_infos; ?>
	<?php
	echo "<img src=\"http://".$serveur.".virtual-loup-de-mer.org/mercator.img.php?idraces=".$RAC."&lat=".$map_lat."&long=".$map_lon."&x=480&y=640&maptype=simple&maparea=4&drawortho=no&drawwind=12&drawtextwp=on&maille=5&proj=mercator&seacolor=ffffff&tracks=on&age=268&estime=100&list=mylist&boat=".$IDU."&text=right\">";
	?>
	</div>
	<div class="contenu_onglet" id="contenu_onglet_5">
<?php echo $current_infos; ?>
	<?php
	echo "<img src=\"http://".$serveur.".virtual-loup-de-mer.org/mercator.img.php?idraces=".$RAC."&lat=".$map_lat."&long=".$map_lon."&x=480&y=640&maptype=simple&maparea=4&drawortho=no&drawwind=24&drawtextwp=on&maille=5&proj=mercator&seacolor=ffffff&tracks=on&age=268&estime=100&list=mylist&boat=".$IDU."&text=right\">";
	?>
	</div>

    

</div> <!-- contenu_onglets -->
</div> <!-- SYS onglets -->
<script type="text/javascript">
        //<!--
                var anc_onglet = '<?php echo $current_onglet; ?>';
				//fade('contenu_onglet_featured');
				change_onglet(anc_onglet);
        //-->
</script>
</div> <!-- main div -->


<br><br><a href="logout.php">LOGOUT</a><br><br>
<?php
/*
if (!$fp = @fopen('tmp/cookie-'.$IDU.'.txt','rb')) 
	{
	echo "Echec de l'ouverture du fichier";
	exit;
	}
	else 
	{
		while(!feof($fp)) 
			{
		
			$Ligne = fgets($fp,255);
			echo $Ligne."<br>";
				if (preg_match('/(PHPSESSID'.chr(9).'[0-9a-z,-]{32,40})/i', $Ligne, $m)) 
				{
				$sid = '&' . $m[1];
				$sid = str_replace(chr(9),"=",$sid);
				echo "La variable de session sera => ".$sid."<br>";
				}
			}
		fclose($fp); // On ferme le fichier
	}
*/
?>
</body>
</html>
