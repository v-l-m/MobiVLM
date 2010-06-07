<?php
/* ***************************************************************
L'affichage au client, les formulaires et un peu de dco
****************************************************************** */
/*
Variables en provenance de VLM= 

    #* WPL : liste de Waypoints (liste)
    #* RAC : numéro de la course (string)
    #* IDB : nom du bateau (string)
    #* RAN : nom de la course (string)
    #* POS : classement dans la course (string - xxx/yyy)
    #* PIP : pilot parameter (string - doit le rester   causes des WP: x.xx,y.yy
    #* POL : nom de la polaire (sans boat_) (string)
    #* MCR : 'mapCenter' (string), ie centre de la carte
    #* MLY : 'mapLayers' (string), ie type de layers
    #* MOP : 'mapOpponents' (string), ie type d'affichage des concurrents
    #* MTL : 'mapTools' (string), ie 
    #* MPO : 'mapPrefOpponents' (liste), ie concurrents   suivre
    #* ETA : Date estimée d'arrivé, seulement si pas de wp perso (string)
    #* IDU : numéro de bateau (int)
    #* NWP : numéro du prochain waypoing (int)
    #* PIM : Pilot mode (int)
    #* NUP : nombre de secondes jusqu'  la prochaine VAC (int)
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
    #* TUP : Time to Update (  partir de NUP) (int)
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
$MAR = $data['MAR']; //zoom carte
$nextvac = $data['NUP'];
$ETA = $data['ETA'];

$current_infos = "<div class=\"txtbold1\" align=\"center\"><img src=\"http://www.virtual-loup-de-mer.org/flagimg.php?idflags=".$CNT."\">&nbsp;&nbsp;&nbsp;".$pseudo." - ".utf8_decode($RAN)."<br>Position : ".$POS." - ".$cur_date."</div>";

if(empty($_GET['onglet'])) { $current_onglet = "1"; } else { $current_onglet = $_GET['onglet']; }

if(empty($nextvac) || $nextvac == "0" || $nextvac < 0 )
{ $nextvac = "60"; }
?>
<!DOCTYPE html PUBLIC "-//WAPFORUM//DTD XHTML Mobile 1.1//EN" "http://www.openmobilealliance.org/tech/DTD/xhtml-mobile11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>MobiVLM 0.1</title>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
<meta http-equiv="Cache-Control" content="public"/>
<link href="styles.css" rel="stylesheet" type="text/css" />
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
		<!-- JEU D'ONGLETS -->
		 <div class="onglets">&nbsp;&nbsp;&nbsp;
				<span class="onglet_0 onglet" id="onglet_1" onclick="javascript:change_onglet('1');">INFOS</span>
				<span class="onglet_0 onglet" id="onglet_2" onclick="javascript:change_onglet('2');">NAVIG</span>
				<span class="onglet_0 onglet" id="onglet_3" onclick="javascript:change_onglet('3');">CARTO</span>
		  </div>
		<br/>
		<div class="contenu_onglets">
		<!-- ONGLET 1 INFORMATIONS -->
		<?php include("onglet_infos.php"); ?>
		<!-- ONGLET 2 NAVIGATION (ORDRES) -->
		<?php include("onglet_nav.php"); ?>
		<!-- ONGLET 3 CARTOGRAPHIE -->
		<?php include("onglet_carto.php"); ?>
		</div>  <!-- contenu_onglets -->
	</div> <!-- </div>SYS onglets -->
	<script type="text/javascript">
			//<!--
					var anc_onglet = '<?php echo $current_onglet; ?>';
					//fade('contenu_onglet_featured');
					change_onglet(anc_onglet);
			//-->
	</script>
</div> <!-- main div -->
</body>
</html>
