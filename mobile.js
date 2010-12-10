// *************** VLM FOR MOBILES *****************
// 2010 => Virtual Loup De Mer
// http://www.virtual-loup-de-mer.org
// ************************************************

// SET THE DOMAIN
webhost = window.location.hostname;
baseurl = "http://www.virtual-loup-de-mer.org";

if (webhost.match("virtual-loup-de-mer.org"))
{
    // virtual-loup-de-mer.org
    domain = ".virtual-loup-de-mer.org";
    server = "virtual-loup-de-mer.org";
}

if (webhost.match("mobiles.virtual-loup-de-mer.org"))
{
    // virtual-loup-de-mer.org
    domain = ".virtual-loup-de-mer.org";
    server = "mobiles.virtual-loup-de-mer.org";
}
// If we are on testing, this one match
if (webhost.match("testing.virtual-loup-de-mer.org"))
{
    // virtual-loup-de-mer.org
    domain = ".virtual-loup-de-mer.org";
    server = "testing.virtual-loup-de-mer.org";
}

if (webhost.match("paparazzia.info"))
{
    domain = ".paparazzia.info";
    server ="paparazzia.info";
}

if (webhost.match("caraibes.hd.free.fr"))
{
    // caraibes.hd.free.fr
    domain = "caraibes.hd.free.fr";
    server ="caraibes.hd.free.fr:8000";
}

if (webhost.match("zigszags.com"))
{
    // zigszags.com
    domain = ".zigszags.com";
    server ="www.zigszags.com";
}

SetCookie("server",server);

// THE USER'S FLEET
myfleet = new Array();
boats = new Array();

// DATE NOW FORMATED AS dd/mm/YYYY h:m:s
today = new Date();
var secs = today.getSeconds();
var mns = today.getMinutes();
var hrs = today.getHours();

var dday = today.getDate();
var dmonth = today.getMonth() + 1;
var dyear = today.getFullYear();

current_date = dday + "/" + dmonth + "/" + dyear + " " + hrs + ":" + mns + ":" + secs;

cur_tsp = Math.ceil(new Date().getTime()/1000);

// FOR TRACKS
// 24 h
starttime = cur_tsp-86400;
endtime = cur_tsp;


// EXTEND JQUERY WITH A FUNCTION TO GET VARS IN QUERY STRING
$.extend({
  getUrlVars: function(){
    var vars = [], hash;
    var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
    for(var i = 0; i < hashes.length; i++)
    {
      hash = hashes[i].split('=');
      vars.push(hash[0]);
      vars[hash[0]] = hash[1];
    }
    return vars;
  },
  getUrlVar: function(name){
    return $.getUrlVars()[name];
  }
});

// MASTER FUNCTION CALLED ON LOAD
function start()
{
//alert(window.location.hostname);	
if( GetCookie('username') && GetCookie('password') )
	{
		username = GetCookie('username');
		password = GetCookie('password');
		if( GetCookie('idu') )
			{
				// IF WE HAVE A COOKIE FOR IDU => MANAGE THIS BOAT
				manage_boat(GetCookie('idu'));
			}
			else
			{
				// IF WE HAVE NO COOKIE FOR IDU => DISPLAY FLEET TO SELECT A BOAT
				load_fleet();
			}
	}
	else
	{
		// ELSE NOT LOGGED IN
		load_login();
	}
}

// DISPLAY FLEET
function load_fleet()
	{
		get_racelist()
		get_fleet();
		dsp_myfleet();
	}

// CALLED WHEN CLICKING ON THE LOGIN BUTTON
function initialize()
{
	username = document.getElementById('username').value;
	password = document.getElementById('password').value;
	get_racelist();
	get_fleet();
	dsp_myfleet();
}

// CALLED ON TIME ON LOAD AND INITIALIZE THE FLEET LIST
function get_fleet() {
	document.getElementById('main').innerHTML = "<div align='center' valign='middle' style='width: 100%; height: 100%;'><br/><br/><img src='ajax-loader.gif'/></div>";
//var auth = make_base_auth(username,password);

	$.ajax({
		type: "GET",
		url: "vlm_caller.php",
		async: false,
		dataType: "json",
		cache: false,
		data: "method=get&base_url=fleet&username=" + username + "&password=" + password,
		success: function(answer){
		//alert(answer.success);
		if(answer.success != "false")
			{
			SetCookie("username",username);
			SetCookie("password",password);
			document.getElementById('main').innerHTML = "";
			var i = 0;
			for (k in answer.fleet) {
				// chargement de la flotte
				myfleet[i] = answer.fleet[k];
				// détails d'un bateau
				get_boatinfo(answer.fleet[k].idu);
				i++; }
			}
		else
			{ load_login(); }
		
		},
	error: function(){
                alert("Erreur d'authentification ! " + username + ' ' + password);
				load_login();
				}

	});
}

// THE RACE LIST
function get_racelist()
{
	$.ajax({
		async: false,
		url: "http://" + server + "/ws/raceinfo/list.php",
		dataType: "json",
		cache: false,
		success: function(answer){
			races = new Array();
			for (k in answer)
			{
			/*
			if(answer[k].closetime < cur_tsp)
				{ race_open = "0"; }
				else
				{ race_open = "1"; }
			*/
			races[k] = answer[k];
			}
	
		},
		error:  function() { alert("erreur => display_races_list()!");}
		});
}

// GET BOAT INFO
function get_boatinfo(idu) {
	username = GetCookie('username');
	password = GetCookie('password');
	$.ajax({
		async: false,
		url: "vlm_caller.php",
		dataType: "json",
		cache: false,
		data: "method=get&base_url=boatinfo&idu=" + idu + "&username=" + username + "&password=" + password,
		success: function(answer) { boats[idu] = answer; },
		error:  function() { alert("erreur => get_boatinfo()!");}
		});
	}

// MANAGE ONE BOAT
function manage_boat(idu)
{
	if(idu)
	{
	get_boatinfo(idu);
	SetCookie("idu",idu);
	document.getElementById('main').innerHTML = "<div align='center' valign='middle' style='width: 100%; height: 100%;'><br/><br/><img src='ajax-loader.gif'/></div>";
	var row = "";
	document.getElementById('header').innerHTML =  '<img src="http://www.virtual-loup-de-mer.org/flagimg.php?idflags=' +  boats[idu].CNT + '" width="30" height="20">&nbsp;&nbsp;&nbsp;' + boats[idu].IDB + '&nbsp;&nbsp;&nbsp;' + boats[idu].POS ;
	row = row + '<div class="stitle">' + boats[idu].RAN + '</div>';
	row = row + dsp_informations(idu);
	row = row + dsp_navigation(idu);
	row = row + dsp_carto_vlm(idu);
	//row = row + dsp_pilototo(idu);
	row = row + '<input type="submit" value="<< changer de bateau" onClick="load_fleet();" />  |  <input type="submit" value="logout |X|" onClick="Logout();" />';
	document.getElementById('main').innerHTML = row;
	var tps_vac = parseFloat(boats[idu].NUP);
	chrono(tps_vac,"compteur");
	window.setTimeout("manage_boat(" + idu + ")",tps_vac*1000);
	}
	else
	{
	get_racelist();
	get_fleet();
	dsp_myfleet();
	}
	
}

//SET PIM CASE 1
function set_pim1()
{
	var idu = GetCookie('idu');
	var username = GetCookie('username');
	var password = GetCookie('password');
	var hdg = document.getElementById('hdg').value;
	
	document.getElementById('main').innerHTML = "<div align='center' valign='middle' style='width: 100%; height: 100%;'><br/><br/><img src='ajax-loader.gif'/></div>";
	$.ajax({
		async: false,
		url: "vlm_caller.php",
		dataType: "json",
		cache: false,
		data: "method=get&base_url=pilot_set&idu=" + idu + "&pim=1&pip=" + hdg + "&username=" + username + "&password=" + password,
		success: function(answer) {
			manage_boat(idu);
			},
		error:  function() { alert("erreur => get_boatinfo()!");}
		});
}

//SET PIM CASE 2
function set_pim2()
{
	var idu = GetCookie('idu');
	var username = GetCookie('username');
	var password = GetCookie('password');
	var twa = document.getElementById('twa').value;
	
	document.getElementById('main').innerHTML = "<div align='center' valign='middle' style='width: 100%; height: 100%;'><br/><br/><img src='ajax-loader.gif'/></div>";
	$.ajax({
		async: false,
		url: "vlm_caller.php",
		dataType: "json",
		cache: false,
		data: "method=get&base_url=pilot_set&idu=" + idu + "&pim=2&pip=" + twa + "&username=" + username + "&password=" + password,
		success: function(answer) {
			manage_boat(idu);
			},
		error:  function() { alert("erreur => get_boatinfo()!");}
		});
}

//SET PIM ALL OTHER CASES
function set_pim(pim)
{
	var idu = GetCookie('idu');
	var username = GetCookie('username');
	var password = GetCookie('password');
	
	document.getElementById('main').innerHTML = "<div align='center' valign='middle' style='width: 100%; height: 100%;'><br/><br/><img src='ajax-loader.gif'/></div>";
	$.ajax({
		async: false,
		url: "vlm_caller.php",
		dataType: "json",
		cache: false,
		data: "method=get&base_url=pilot_set&idu=" + idu + "&pim=" + pim + "&username=" + username + "&password=" + password,
		success: function(answer) {
			manage_boat(idu);
			},
		error:  function() { alert("erreur => get_boatinfo()!");}
		});
}

// SET WP TO FOLLOW
function set_wp()
{
	var idu = GetCookie('idu');
	var username = GetCookie('username');
	var password = GetCookie('password');
	var lat = document.getElementById('lat').value;
	var lon = document.getElementById('lon').value;
	var targetandhdg = document.getElementById('targetandhdg').value;
if(targetandhdg == "0" || targetandhdg == "") { targetandhdg = "-1"; }
//'{"pip":{"targetlat":'.$vars['lat'].',"targetlong":'.$vars['lon'].',"targetandhdg":'.$vars['targetandhdg'].'},"idu":'.$idu.'}';
	document.getElementById('main').innerHTML = "<div align='center' valign='middle' style='width: 100%; height: 100%;'><br/><br/><img src='ajax-loader.gif'/></div>";
	$.ajax({
		async: false,
		url: "vlm_caller.php",
		dataType: "json",
		cache: false,
		data: "method=get&base_url=target_set&idu=" + idu + "&lat=" + lat + "&lon=" + lon + "&targetandhdg=" + targetandhdg + "&username=" + username + "&password=" + password,
		success: function(answer) {
			manage_boat(idu);
			},
		error:  function() { alert("erreur => get_boatinfo()!");}
		});


}

// SOME CLEANUP WHEN LOADING NEW CONTEXT
function clear_all()
{
	document.getElementById('header').innerHTML = "";
	document.getElementById('main').innerHTML = "";
}

// LOGOUT :)
function Logout()
{
	clear_all();
	UnsetCookie("username", "");
	UnsetCookie("password", "");
	UnsetCookie("idu", "");
	load_login();
}

// COMPUTE THE REAL FIXED WIND ANGLE
function calcul_angle_vent(hdg, twd)
	{
		var angle = hdg-twd;
		if(angle>180) { angle  =angle-360; }
		return Math.round( (angle*1000))/1000;
	}
		
// VERY USEFULL FOR VLM-20
function angle_oppose(val) 
	{
		angle = val + 180;
		if(angle > 360) { angle = angle - 360; }
		return angle;
	}

// COOKIES FUNCTIONS
function SetCookie (name, value) {

	var path = "/";
	// duree de vie de 365 jours ca evite de retaper sans arret son email avec ses gros doigts sur le p'tit clavier du mobile !
	var expires = new Date();
	expires.setTime(expires.getTime()+(365*24*3600*1000));
	//var secure=(argc > 5) ? argv[5] : false;
	document.cookie=name+"="+escape(value)+
		((expires==null) ? "" : ("; expires="+expires.toGMTString()))+
		((path==null) ? "" : ("; path="+path))+
		((domain==null) ? "" : ("; domain="+domain));
}

function getCookieVal(offset) {
	var endstr=document.cookie.indexOf (";", offset);
	if (endstr==-1)
      		endstr=document.cookie.length;
	return unescape(document.cookie.substring(offset, endstr));
}

function GetCookie (name) {
	var arg=name+"=";
	//var arg=name;
	var alen=arg.length;
	var clen=document.cookie.length;
	var i=0;
	while (i<clen) {
		var j=i+alen;
		if (document.cookie.substring(i, j)==arg)
                        return getCookieVal (j);
                i=document.cookie.indexOf(" ",i)+1;
                        if (i==0) break;}
	return null;
}

function UnsetCookie (name, value) {
	//var domain = domain;
	var path = "/";
	var expires = -1;
	document.cookie=name+"="+escape(value)+
		((expires==null) ? "" : ("; expires="+expires))+
		((path==null) ? "" : ("; path="+path))+
		((domain==null) ? "" : ("; domain="+domain));
}

// VAC COUNTDOWN
function timingBox( sec, min, hour )
{
	this.secondes = sec;
	this.minutes = min;
	this.heures = hour;
}

function chrono(temps,tagid)
{
		var timeBox = new timingBox( 0, 0, 0);
		//Si un temps est passé en parametre (en seconde) on converti pour les minutes et heures
			timeBox.secondes=temps;
		
			if (timeBox.secondes > 60) 
			{
				timeBox.minutes = Math.floor(timeBox.secondes / 60);
				timeBox.secondes = timeBox.secondes - timeBox.minutes * 60;
			}
			if (timeBox.minutes > 60) 
			{
				timeBox.heures = Math.floor(timeBox.minutes / 60);
				timeBox.minutes = Math.floor(timeBox.minutes - timeBox.heures * 60);
			}
		
		//Reajustage des valeurs pour l'affichage
		if (timeBox.heures < 10) rheures = '0'+timeBox.heures; else rheures = timeBox.heures;
		if (timeBox.minutes < 10) rminutes = '0'+timeBox.minutes; else rminutes = timeBox.minutes;
		if (timeBox.secondes < 10) rsecondes = '0'+timeBox.secondes; else rsecondes = timeBox.secondes;

		temps = temps - 1;	
		//Affichage selon l'id
		//document.getElementById(tagid).innerHTML = "<strong>Prochaine vacation dans : "+rheures + ":" + rminutes + ":" + rsecondes + "</strong>";
		document.getElementById(tagid).innerHTML = "<strong>Prochaine vacation dans " + rminutes + ":" + rsecondes + " mn:ss</strong>";
		
		//Reactualisation du chrono si different de 0.
		if ( temps > 0)
		{
			setTimeout("chrono("+temps+", '"+tagid+"')", 1000);
			//window.setTimeout("manage_boat(" + boats[idu].IDU + ")",1000);
		}
		else
		{			
			manage_boat(GetCookie('idu'));
		}		
}