<?php
/* ***************************************************************
L'affichage au client, les formulaires et un peu de dco
****************************************************************** */

if(empty($_GET['onglet'])) { $current_onglet = "1"; } else { $current_onglet = $_GET['onglet']; }

if(empty($nextvac) || $nextvac == "0" || $nextvac < 0 )
{ $nextvac = "60"; }
?>
<!DOCTYPE html PUBLIC "-//WAPFORUM//DTD XHTML Mobile 1.1//EN" "http://www.openmobilealliance.org/tech/DTD/xhtml-mobile11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?php echo $version; ?></title>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
<meta http-equiv="Cache-Control" content="public"/>
<link href="css/styles.css" rel="stylesheet" type="text/css" />
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
				<span class="onglet_0 onglet" id="onglet_4" onclick="javascript:change_onglet('4');">PILOTOTO</span>
		  </div>
		<br/>
		<div class="contenu_onglets">
		<!-- ONGLET 1 INFORMATIONS -->
		<?php include("includes/onglet_infos.php"); ?>
		<!-- ONGLET 2 NAVIGATION (ORDRES) -->
		<?php include("includes/onglet_nav.php"); ?>
		<!-- ONGLET 3 CARTOGRAPHIE -->
		<?php include("includes/onglet_carto.php"); ?>
		<!-- ONGLET 4 PILOTOTO -->
		<?php include("includes/onglet_pilototo.php"); ?>
		</div>  <!-- contenu_onglets -->
	</div> <!-- </div>SYS onglets -->
	<script type="text/javascript">
			//<!--
					var anc_onglet = '<?php echo $current_onglet; ?>';
					//fade('contenu_onglet_featured');
					change_onglet(anc_onglet);
			//-->
	</script>
	<?php include("includes/footer.php"); ?>
</div> <!-- main div -->
</body>
</html>
