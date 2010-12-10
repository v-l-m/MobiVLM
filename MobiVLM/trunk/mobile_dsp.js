// *************** VLM FOR MOBILES *****************
// 2010 => Virtual Loup De Mer
// http://www.virtual-loup-de-mer.org
// ************************************************

// ALL THE FUNCTIONS FOR  DISPLAYING

// LOAD LOGIN FORM
function load_login()
{
	var row;	
	document.getElementById('main').innerHTML = "<div align='center' valign='middle' style='width: 100%; height: 100%;'><br/><br/><img src='ajax-loader.gif'/></div>";
	
	row = '<div class="pbloc">';
	row = row + '<form>';
	row = row + '<input type="text" name="username" id="username"><br/>';
	row = row + '<input type="password" name="password" id="password"><br/>';
	row = row + '<input type="button" name="connexion" value="Connexion" onClick="initialize();">';
	row = row + '</form>';
	row = row + '</div>';
	
	document.getElementById('header').innerHTML = "Connexion VLM";
	document.getElementById('main').innerHTML = row;
}

// DISPLAY THE PLAYER'S FLEET
function dsp_myfleet()
{
	var row = "";
	document.getElementById('header').innerHTML = "Ma flotte";
	document.getElementById('main').innerHTML = "<div align='center' valign='middle' style='width: 100%; height: 100%;'><br/><br/><img src='ajax-loader.gif'/></div>";
	for(var i = 0; i < myfleet.length; i++)
    	{
		if( myfleet[i].engaged != "0" )
			{
			row = row + '<div class="ptitle">' + myfleet[i].idu + ' - ' + myfleet[i].boatpseudo + '</div>';
			row = row + '<div class="pbloc">' + myfleet[i].boatname + ' - ' + races[myfleet[i].engaged].racename + '<br/>';
			row = row + 'BSP = ' + boats[myfleet[i].idu].BSP + '<br/>';
			row = row + '<input type="button" name="manage_boat" value="Gerer ce bateau >>" onClick="manage_boat(' + myfleet[i].idu + ');" /></div><br/>';
			}
		}
	row = row + '<input type="button" value="logout" onClick="Logout();" />';
	document.getElementById('main').innerHTML = row;
}

// DISPLAY IN ONE TIME THE MOST USED BOAT INFOS
function dsp_informations(idu)
{
var row = "";
row = row + '<div class="ptitle">Informations</div>';
row = row + '<div class="pbloc">';
row = row + '<div id="compteur"></div>';
row = row + '<table border="0" cellpadding="1" width="100%">';
row = row + '<tr align="center"> ';
row = row + '<td class="txtbold1" width="15%" bgcolor="#cccccc">Lat</td> ';
row = row + '<td bgcolor="#FFFFFF" class="txtbold2" width="35%">' + Math.round( parseFloat(boats[idu].LAT) )/1000 + '</td> ';
row = row + '<td class="txtbold1" width="15%" bgcolor="#cccccc">Lon</td> ';
row = row + '<td bgcolor="#FFFFFF" class="txtbold2" width="35%">' + Math.round( parseFloat(boats[idu].LON)  )/1000 + '</td> ';
row = row + '</tr> ';
row = row + '</table> ';
 
row = row + '<table border="0" cellpadding="1" width="100%"> ';
row = row + '<tr align="center"> ';
row = row + '<td class="txtbold1" width="33%" bgcolor="#cccccc">Speed</td> ';
row = row + '<td class="txtbold1" width="33%" bgcolor="#cccccc">Hdg</td> ';
row = row + '<td class="txtbold1" width="33%" bgcolor="#cccccc">Vmg</td> ';
row = row + '</tr> ';
row = row + '<tr align="center"> ';
row = row + '<td bgcolor="#FFFFFF" class="txtbold2">' + boats[idu].BSP + '</td> ';
row = row + '<td bgcolor="#FFFFFF" class="txtbold2">' + boats[idu].HDG + '</td> ';
row = row + '<td bgcolor="#FFFFFF" class="txtbold2">' + boats[idu].VMG + '</td> ';
row = row + '</tr> ';
row = row + '</table> ';
 
row = row + '<table border="0" cellpadding="1" width="100%"> ';
row = row + '<tr align="center"> ';
row = row + '<td class="txtbold1" width="50%" bgcolor="#cccccc">Distance WP</td> ';
row = row + '<td class="txtbold1" width="50%" bgcolor="#cccccc">Loch</td> ';
row = row + '</tr> ';
row = row + '<tr align="center"> ';
row = row + '<td bgcolor="#FFFFFF" class="txtbold2">' + boats[idu].DNM + '</td> ';
row = row + '<td bgcolor="#FFFFFF" class="txtbold2">' + boats[idu].LOC + '</td> ';
row = row + '</tr> ';
row = row + '</table> ';
 
row = row + '<table border="0" cellpadding="1" width="100%"> ';
row = row + '<tr align="center"> ';
row = row + '<td class="txtbold1" width="33%" bgcolor="#cccccc">Ortho</td> ';
row = row + '<td class="txtbold1" width="33%" bgcolor="#cccccc">Loxo</td> ';
row = row + '<td class="txtbold1" width="33%" bgcolor="#cccccc">AVG (Moyenne)</td> ';
row = row + '</tr> ';
row = row + '<tr align="center"> ';
row = row + '<td bgcolor="#FFFFFF" class="txtbold2">' + boats[idu].ORT + '</td> ';
row = row + '<td bgcolor="#FFFFFF" class="txtbold2">' + boats[idu].LOX + '</td> ';
row = row + '<td bgcolor="#FFFFFF" class="txtbold2">' + boats[idu].AVG + '</td> ';
row = row + '</tr> ';
row = row + '</table> ';

<!-- VLM20 --> 
row = row + '<div align="center">';
row = row + dsp_vlm20(idu);
row = row + '<br></div> ';

row = row + '<table border="0" cellpadding="1" width="100%"> ';
row = row + '<tr align="center"> ';
row = row + '<td class="txtbold1" width="33%" bgcolor="#cccccc">Wind speed</td> ';
row = row + '<td class="txtbold1" width="33%" bgcolor="#cccccc">Wind Direction</td> ';
row = row + '<td class="txtbold1" width="33%" bgcolor="#cccccc">Wind Angle</td> ';
row = row + '</tr> ';
row = row + '<tr align="center"> ';
row = row + '<td bgcolor="#FFFFFF" class="txtbold2">' + boats[idu].TWS + '</td> ';
row = row + '<td bgcolor="#FFFFFF" class="txtbold2">' + boats[idu].TWD + '</td> ';
row = row + '<td bgcolor="#FFFFFF" class="txtbold2">' + calcul_angle_vent( parseFloat(boats[idu].HDG), parseFloat(boats[idu].TWD) ) + '</td> ';
row = row + '</tr> ';
row = row + '</table>';
row = row + '</div><br/>';
return row;
}

// DISPLAY THE VLM20 GAUGE
function dsp_vlm20(idu)
{
	var row = '';
	var esp = '%20%20%20%20%20%20%20%20';
	row = row + '<img src="http://www.virtual-loup-de-mer.org/windangle.php?' + esp +'wheading=' + angle_oppose( parseFloat(boats[idu].TWD) ) + '&amp;' + esp +'boatheading=' + boats[idu].HDG + '&amp;' + esp +'wspeed=' + boats[idu].TWS + '&amp;' + esp +'roadtoend=' + boats[idu].ORT + '&amp;' + esp +'boattype=' + boats[idu].POL + '" >';	
	return row;
}

// DISPLAY NAVIGATION OPTIONS
function dsp_navigation(idu)
{
var boat = boats[idu];
var row = "";
row = row + '<div class="ptitle">Navigation</div>';
row = row + '<div class="pbloc">';
if(boat['PIM']== "1") { mode_nav = "Cap fixe"; }
else if(boat['PIM']== "2") { mode_nav = "Angle fixe"; }
else if(boat['PIM']== "3") { mode_nav = "Suivi WP ortho fixe"; }
else if(boat['PIM']== "4") { mode_nav = "Suivi WP BVMG"; }
else if(boat['PIM']== "5") { mode_nav = "Suivi WP VBVMG"; }
else { mode_nav = "Aucun"; }
row = row + '<div class="ban1">Mode actuel : ' + mode_nav + '</div>';

row = row + '<table border="0" cellpadding="1" width="100%"> ';
row = row + '<tr align="center"> ';
row = row + '<td class="txtbold1" width="33%" bgcolor="#cccccc">Speed</td> ';
row = row + '<td class="txtbold1" width="33%" bgcolor="#cccccc">Hdg</td> ';
row = row + '<td class="txtbold1" width="33%" bgcolor="#cccccc">Vmg</td> ';
row = row + '</tr> ';
row = row + '<tr align="center"> ';
row = row + '<td bgcolor="#FFFFFF" class="txtbold2">' + boat['BSP'] + '</td> ';
row = row + '<td bgcolor="#FFFFFF" class="txtbold2">' + boat['HDG'] + '</td> ';
row = row + '<td bgcolor="#FFFFFF" class="txtbold2">' + boat['VMG'] + '</td> ';
row = row + '</tr> ';
row = row + '</table> ';
row = row + '<hr> ';

row = row + '<table border="0" cellpadding="1"> ';
row = row + '<tr> ';
row = row + '<td class="txtbold1" align="left" bgcolor="#FFFFFF" colspan="3">Mode Pilote</td> ';
row = row + '</tr> ';
row = row + '<tr> ';
row = row + '<td class="txtbold1" width="30%" align="left" bgcolor="#cccccc">CAP</td> ';
row = row + '<td class="txtbold1" width="30%" align="center"> ';
row = row + '<input name="hdg" id="hdg" type="text" value="' + boat['HDG'] + '" class="txtbold1" size="8"></td> ';
row = row + '<td class="txtbold1" width="40%" align="left"> ';
row = row + '<input name="btsub" type="submit" value="CAP FIXE" class="txtbold1" onClick="set_pim1();" /> ';
row = row + '</td> ';
row = row + '</tr> ';

row = row + '<tr><td colspan="3"></td></tr> ';

row = row + '<tr> ';
row = row + '<td class="txtbold1" width="30%" align="left" bgcolor="#cccccc">ANGLE</td> ';
row = row + '<td class="txtbold1" width="30%" align="center"> ';
row = row + '<input name="twa" id="twa" type="text" value="' + calcul_angle_vent( parseFloat(boat['HDG']), parseFloat(boat['TWD']) ) + '" class="txtbold1" size="8"></td> ';
row = row + '<td class="txtbold1" width="40%" align="left"> ';
row = row + '<input name="btsub" type="submit" value="ANGLE FIXE" class="txtbold1" onClick="set_pim2();" /> ';
row = row + '</td> ';
row = row + '</tr> ';

row = row + '<tr><td colspan="3"><hr></td></tr> ';
row = row + '<tr> ';
row = row + '<td class="txtbold1" align="left" bgcolor="#FFFFFF" colspan="3">Way Point</td> ';
row = row + '</tr> ';

row = row + '<tr> ';
row = row + '<td class="txtbold1" width="30%" align="left" bgcolor="#cccccc">LATITUDE</td> ';
row = row + '<td class="txtbold1" width="30%" align="center"> ';
row = row + '<input name="lat" id="lat" type="text" value="' + boat['WPLAT'] + '" class="txtbold1" size="8"> ';
row = row + '</td> ';
row = row + '<td class="txtbold1" width="40%" align="left"></td> ';
row = row + '</tr> ';

row = row + '<tr> ';
row = row + '<td class="txtbold1" width="30%" align="left" bgcolor="#cccccc">LONGITUDE</td> ';
row = row + '<td class="txtbold1" width="30%" align="center"> ';
row = row + '<input name="lon" id="lon" type="text" value="' + boat['WPLON'] + '" class="txtbold1" size="8"> ';
row = row + '</td> ';
row = row + '<td class="txtbold1" width="40%" align="left"></td> ';
row = row + '</tr> ';

row = row + '<tr> ';
row = row + '<td class="txtbold1" width="30%" align="left" bgcolor="#cccccc">@WPH</td> ';
row = row + '<td class="txtbold1" width="30%" align="center"> ';
row = row + '<input name="targetandhdg" id="targetandhdg" type="text" value="' + boat['H@WP'] + '" class="txtbold1" size="8"> ';
row = row + '</td> ';

row = row + '<td class="txtbold1" width="40%" align="left"> ';
row = row + '<input name="btsub" type="submit" value="CHANGER" class="txtbold1" onClick="set_wp();" /> ';
row = row + '</td> ';
row = row + '</tr> ';
row = row + '</table>';

row = row + '<table border="0" cellpadding="1" width="100%"> ';
row = row + '<tr><td colspan="3"><hr></td></tr> ';
row = row + '<tr> ';
row = row + '<td class="txtbold1" width="100%" align="left" bgcolor="#FFFFFF" colspan="3">Mode de suivi du Way Point</td> ';
row = row + '</tr> ';

row = row + '<tr> ';
row = row + '<td class="txtbold1" width="33%" align="center"> ';
row = row + '<input name="btsub" type="submit" value="ORTHO" class="txtbold1" onClick="set_pim(3);" /> ';
row = row + '</td> ';

row = row + '<td class="txtbold1" width="33%" align="center"> ';
row = row + '<input name="btsub" type="submit" value="BVMG" class="btactif" onClick="set_pim(4);" /> ';
row = row + '</td> ';

row = row + '<td class="txtbold1" width="33%" align="center"> ';
row = row + '<input name="btsub" type="submit" value="VBVMG" class="txtbold1" onClick="set_pim(5);" /> ';
row = row + '</td> ';

row = row + '</tr> ';
row = row + '</table> ';

row = row + '</div><br/>';
return row;
}

// DISPLAY OPTIONS FOR MAP
function dsp_carto_vlm(idu)
{
var row = "";
row = row + '<div class="ptitle">Cartographie</div>';
row = row + '<div class="pbloc">';

row = row + '<form action="carte.php" method="get" name="go_carto"> ';
row = row + '	<table border="0" cellpadding="1" width="66%"> ';
row = row + '	<tr> ';
row = row + '	<td class="txtbold1" width="33%" bgcolor="#ffffff">Hauteur : </td> ';
row = row + '	<td class="txtbold1" width="33%" bgcolor="#cccccc"> ';
if(GetCookie('map_haut')) { map_haut = GetCookie('map_haut'); } else { map_haut = '640'; }
row = row + '		<input type="text" name="map_haut" id="map_haut" value="' + map_haut + '" size="10" class="txtbold1"> ';
row = row + '	</td> ';
row = row + '	</tr> ';
row = row + '	<tr> ';
row = row + '	<td class="txtbold1" width="33%" bgcolor="#ffffff">Largeur : </td> ';
row = row + '	<td class="txtbold1" width="33%" bgcolor="#cccccc"> ';
if(GetCookie('map_larg')) { map_larg = GetCookie('map_larg'); } else { map_larg = '480'; }
row = row + '		<input type="text" name="map_larg" id="map_larg" value="' + map_larg + '" size="10" class="txtbold1"> ';
row = row + '	</td> ';
row = row + '	</tr> ';
row = row + '	<tr> ';
row = row + '	<td class="txtbold1" width="33%" bgcolor="#ffffff">HEURE : </td> ';
row = row + '	<td class="txtbold1" width="33%" bgcolor="#cccccc"> ';
if(GetCookie('heure_carte')) { heure_carte = GetCookie('heure_carte'); } else { heure_carte = '0'; }
row = row + '	<select name="heure_carte" id="heure_carte"> ';
row = row + '	  <option value="0"' + dsp_selected("0",heure_carte) + '>H + 0</option> ';
row = row + '	  <option value="1"' + dsp_selected("1",heure_carte) + '>H + 1</option> ';
row = row + '	  <option value="2"' + dsp_selected("2",heure_carte) + '>H + 2</option> ';
row = row + '	  <option value="3"' + dsp_selected("3",heure_carte) + '>H + 3</option> ';
row = row + '	  <option value="4"' + dsp_selected("4",heure_carte) + '>H + 4</option> ';
row = row + '	  <option value="5"' + dsp_selected("5",heure_carte) + '>H + 5</option> ';
row = row + '	  <option value="6"' + dsp_selected("6",heure_carte) + '>H + 6</option> ';
row = row + '	  <option value="9"' + dsp_selected("9",heure_carte) + '>H + 9</option> ';
row = row + '	  <option value="12"' + dsp_selected("12",heure_carte) + '>H + 12</option> ';
row = row + '	  <option value="18"' + dsp_selected("18",heure_carte) + '>H + 18</option> ';
row = row + '	  <option value="24"' + dsp_selected("24",heure_carte) + '>H + 24</option> ';
row = row + '	  <option value="36"' + dsp_selected("36",heure_carte) + '>H + 36</option> ';
row = row + '	  <option value="48"' + dsp_selected("48",heure_carte) + '>H + 48</option> ';
row = row + '	  <option value="60"' + dsp_selected("60",heure_carte) + '>H + 60</option> ';
row = row + '	</select> ';
row = row + '	</td> ';
row = row + '	</tr> ';
row = row + '	<tr> ';
row = row + '	<td class="txtbold1" width="33%" bgcolor="#ffffff">ZOOM : </td> ';
row = row + '	<td class="txtbold1" width="33%" bgcolor="#cccccc"> ';
if(GetCookie('zoom_carte')) { zoom_carte = GetCookie('zoom_carte'); } else { zoom_carte = '4'; }
row = row + '	<select name="zoom_carte" id="zoom_carte"> ';
row = row + '	  <option value="2"' + dsp_selected("2",zoom_carte) + '>2</option> ';
row = row + '	  <option value="3"' + dsp_selected("3",zoom_carte) + '>3</option> ';
row = row + '	  <option value="4"' + dsp_selected("4",zoom_carte) + '>4</option> ';
row = row + '	  <option value="5"' + dsp_selected("5",zoom_carte) + '>5</option> ';
row = row + '	  <option value="6"' + dsp_selected("6",zoom_carte) + '>6</option> ';
row = row + '	  <option value="7"' + dsp_selected("7",zoom_carte) + '>7</option> ';
row = row + '	  <option value="8"' + dsp_selected("8",zoom_carte) + '>8</option> ';
row = row + '	  <option value="9"' + dsp_selected("9",zoom_carte) + '>9</option> ';
row = row + '	  <option value="10"' + dsp_selected("10",zoom_carte) + '>10</option> ';
row = row + '	  <option value="11"' + dsp_selected("11",zoom_carte) + '>11</option> ';
row = row + '	  <option value="12"' + dsp_selected("12",zoom_carte) + '>12</option> ';
row = row + '	  <option value="13"' + dsp_selected("13",zoom_carte) + '>13</option> ';
row = row + '	  <option value="14"' + dsp_selected("14",zoom_carte) + '>14</option> ';
row = row + '	  <option value="15"' + dsp_selected("15",zoom_carte) + '>15</option> ';
row = row + '	  <option value="16"' + dsp_selected("16",zoom_carte) + '>16</option> ';
row = row + '	  <option value="17"' + dsp_selected("17",zoom_carte) + '>17</option> ';
row = row + '	  <option value="18"' + dsp_selected("18",zoom_carte) + '>18</option> ';
row = row + '	</select> ';
row = row + '	</td> ';
row = row + '	</tr> ';
row = row + '	<tr> ';
row = row + '	<td></td> ';
row = row + '	<td> ';
row = row + '	<input name="sub_carto" type="button" value="Visualiser" onClick="dsp_carte_vlm(' + boats[idu].IDU + ');"> ';
row = row + '	</td> ';
row = row + '	</tr> ';
row = row + '	</table> ';
row = row + '	<hr /> ';
row = row + '	</form> ';

row = row + '</div><br/>';
return row;
}

// LOAD MAP IMG
function dsp_carte_vlm(idu)
{
//document.getElementById('header').innerHTML = 'Carte VLM';

var row = "";
var map_lat = parseFloat(boats[idu].LAT)/1000;
var map_lon = parseFloat(boats[idu].LON)/1000;
var map_larg = document.getElementById('map_larg').value;
SetCookie("map_larg",map_larg);
var map_haut = document.getElementById('map_haut').value;
SetCookie("map_haut",map_haut);
var zoom_carte = document.getElementById('zoom_carte').value;
SetCookie("zoom_carte",zoom_carte);
var heure_carte = document.getElementById('heure_carte').value;
SetCookie("heure_carte",heure_carte);
var idu = boats[idu].IDU;

//document.getElementById('header').innerHTML = 'Carte VLM';

//row = "<img src='http://" + server + "/mercator.img.php?idraces=" + boats[idu].RAC + "&lat=" + map_lat + "&long=" + map_lon + "&x=" + map_larg + "&y=" + map_haut + "&maptype=simple&maparea=" + zoom_carte + "&drawortho=no&drawwind=" + heure_carte + "&drawtextwp=on&maille=5&proj=mercator&seacolor=ffffff&tracks=on&age=268&estime=100&list=mylist&boat=" + idu + "&text=right'/>";
//row = row + '<input type="button" value="<< retour" onClick="manage_boat(' + idu + ');" />';
//document.getElementById('main').innerHTML = row;
if(GetCookie('server') == "testing.virtual-loup-de-mer.org" )
{ map_server = "testing.virtual-loup-de-mer.org" }
else
{ map_server = "virtual-loup-de-mer.org" }
location.href = "http://" + map_server + "/mercator.img.php?idraces=" + boats[idu].RAC + "&lat=" + map_lat + "&long=" + map_lon + "&x=" + map_larg + "&y=" + map_haut + "&maptype=simple&maparea=" + zoom_carte + "&drawortho=no&drawwind=" + heure_carte + "&drawtextwp=on&maille=5&proj=mercator&seacolor=ffffff&tracks=on&age=268&estime=100&list=mylist&boat=" + idu + "&text=right";
}

// DISPLAY PILOTOTO (NEXT TIME, WORKING ON JS ADAPTATION FROM PHP VERSION)
function dsp_pilototo(idu)
{
var row = "";
row = row + '<div class="ptitle">Pilototo</div>';
row = row + '<div class="pbloc">';

row = row + '<table border="0" width="100%">';
row = row + '<tr>';
row = row + '<td class="txtbold1" bgcolor="#FFFFFF">Date ordre</td>';
row = row + '<td class="txtbold1" bgcolor="#FFFFFF">Type d\'ordre</td>';

row = row + '<td class="txtbold1" bgcolor="#FFFFFF">Ordre</td>';
row = row + '</tr>';

row = row + '<tr><td colspan="3"><hr></td></tr>';
row = row + '<tr><td colspan="3" class="txtbold1" bgcolor="#FFFFFF">Ajout d\'un programme</td></tr>';
row = row + '<form method="get" action="">';
row = row + '<input type="hidden" name="onglet" value="4">';
row = row + '<input type="hidden" name="event" value="pilototo">';
row = row + '<input type="hidden" name="taskid" value="">';
row = row + '<tr bgcolor="#ffffff">';
row = row + '<td class="txtbold1">';
row = row + '<select name="tts_day" class="txtbold1"> ';
row = row + '    <option value="06,12,2010">06/12/2010</option>';

row = row + '	<option value="07,12,2010">07/12/2010</option>';
row = row + '	<option value="08,12,2010">08/12/2010</option>';
row = row + '	<option value="09,12,2010">09/12/2010</option>';
row = row + '	<option value="10,12,2010">10/12/2010</option>';
row = row + '	<option value="11,12,2010">11/12/2010</option>';
row = row + '	<option value="12,12,2010">12/12/2010</option>';

row = row + '	<option value="13,12,2010">13/12/2010</option>';
row = row + '	</select>';
row = row + '<br>';
row = row + '	H <select name="tts_heure" class="txtbold1"> ';
row = row + '				<option value="0">0</option>';
row = row + '				<option value="1">1</option>';
row = row + '				<option value="2">2</option>';

row = row + '				<option value="3">3</option>';
row = row + '				<option value="4">4</option>';
row = row + '				<option value="5">5</option>';
row = row + '				<option value="6">6</option>';
row = row + '				<option value="7">7</option>';
row = row + '				<option value="8">8</option>';

row = row + '				<option value="9">9</option>';
row = row + '				<option value="10">10</option>';
row = row + '				<option value="11">11</option>';
row = row + '				<option value="12">12</option>';
row = row + '				<option value="13">13</option>';
row = row + '				<option value="14">14</option>';

row = row + '				<option value="15">15</option>';
row = row + '				<option value="16">16</option>';
row = row + '				<option value="17">17</option>';
row = row + '				<option value="18">18</option>';
row = row + '				<option value="19">19</option>';
row = row + '				<option value="20">20</option>';

row = row + '				<option value="21">21</option>';
row = row + '				<option value="22">22</option>';
row = row + '				<option value="23">23</option>';
row = row + '				<option value="24">24</option>';
row = row + '			</select>';

row = row + '	MN <select name="tts_min" class="txtbold1"> ';
row = row + '				<option value="0">0</option>';

row = row + '				<option value="1">1</option>';
row = row + '				<option value="2">2</option>';
row = row + '				<option value="3">3</option>';
row = row + '				<option value="4">4</option>';
row = row + '				<option value="5">5</option>';
row = row + '				<option value="6">6</option>';

row = row + '				<option value="7">7</option>';
row = row + '				<option value="8">8</option>';
row = row + '				<option value="9">9</option>';
row = row + '				<option value="10">10</option>';
row = row + '				<option value="11">11</option>';
row = row + '				<option value="12">12</option>';

row = row + '				<option value="13">13</option>';
row = row + '				<option value="14">14</option>';
row = row + '				<option value="15">15</option>';
row = row + '				<option value="16">16</option>';
row = row + '				<option value="17">17</option>';
row = row + '				<option value="18">18</option>';

row = row + '				<option value="19">19</option>';
row = row + '				<option value="20">20</option>';
row = row + '				<option value="21">21</option>';
row = row + '				<option value="22">22</option>';
row = row + '				<option value="23">23</option>';
row = row + '				<option value="24">24</option>';

row = row + '				<option value="25">25</option>';
row = row + '				<option value="26">26</option>';
row = row + '				<option value="27">27</option>';
row = row + '				<option value="28">28</option>';
row = row + '				<option value="29">29</option>';
row = row + '				<option value="30">30</option>';

row = row + '				<option value="31">31</option>';
row = row + '				<option value="32">32</option>';
row = row + '				<option value="33">33</option>';
row = row + '				<option value="34">34</option>';
row = row + '				<option value="35">35</option>';
row = row + '				<option value="36">36</option>';

row = row + '				<option value="37">37</option>';
row = row + '				<option value="38">38</option>';
row = row + '				<option value="39">39</option>';
row = row + '				<option value="40">40</option>';
row = row + '				<option value="41">41</option>';
row = row + '				<option value="42">42</option>';

row = row + '				<option value="43">43</option>';
row = row + '				<option value="44">44</option>';
row = row + '				<option value="45">45</option>';
row = row + '				<option value="46">46</option>';
row = row + '				<option value="47">47</option>';
row = row + '				<option value="48">48</option>';

row = row + '				<option value="49">49</option>';
row = row + '				<option value="50">50</option>';
row = row + '				<option value="51">51</option>';
row = row + '				<option value="52">52</option>';
row = row + '				<option value="53">53</option>';
row = row + '				<option value="54">54</option>';

row = row + '				<option value="55">55</option>';
row = row + '				<option value="56">56</option>';

row = row + '				<option value="57">57</option>';
row = row + '				<option value="58">58</option>';
row = row + '				<option value="59">59</option>';
row = row + '				<option value="60">60</option>';

row = row + '			</select>';

row = row + '	</td>';
row = row + '	<td>';
row = row + '	<select name="pim" class="txtbold1">'; 
row = row + '    <option value="1">1:Cap fixe</option>';
row = row + '	<option value="2">2:Angle fixe</option>';
row = row + '	<option value="3">3:Pilote Ortho</option>';

row = row + '	<option value="4">4:BVMG</option>';
row = row + '	<option value="5">5:VBVMG</option>';
row = row + '	</select>';
row = row + '	</td>';
row = row + '	<td>';
row = row + '	<input name="pip" type="text" value="" class="txtbold1" size="15">';
row = row + '	</td>';
row = row + '</tr>';

row = row + '<tr>';
row = row + '<td colspan="2"><input name="pilototo_add" type="submit" value="Ajouter" class="txtbold1"></td>';
row = row + '<td></td>';
row = row + '</tr>';
row = row + '</form>';
row = row + '</table>';


row = row + '</div><br/>';
return row;
}

// NEXT TIME
function dsp_ranking(rac)
{
var row = "";
row = row + '<div class="ptitle">Pilototo</div>';
row = row + '<div class="pbloc">';
row = row + '</div><br/>';
return row;
}

// LITTLE FUNCTION FOR DISPLAY THE GOOD SELECTED OPTION
function dsp_selected(val1,val2)
{
	var dsp;
	if( parseFloat(val1) == parseFloat(val2) )
	{ dsp = " selected"; }
	else { dsp = ""; }
	return dsp;
}