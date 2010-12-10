<?php
/* ***************************************************************
L'affichage au client, les formulaires et un peu de dco
****************************************************************** */

if(empty($_GET['onglet'])) { $current_onglet = "1"; } else { $current_onglet = $_GET['onglet']; }

if(empty($nextvac) || $nextvac == "0" || $nextvac < 0 )
{ $nextvac = "60"; }
?>
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
<?php
echo "<div id='header'><img src='http://www.virtual-loup-de-mer.org/flagimg.php?idflags=".$data['CNT']."'>&nbsp;&nbsp;&nbsp;".$data['IDU']." - ".$data['IDB']."</div>";
echo "<div class='stitle'>Course : ".$data['RAN']."<br/>";
echo "Classement : ".$data['POS']."</div>";
?>
		 
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

<?php include("includes/footer.php"); ?>

</div> <!-- main div -->

</body>
</html>
