<?php
/* ***************************************************************
La page de login utilise en include par index.php
****************************************************************** */
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>VLM Mobiles - LOGIN</title>
<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;" />
<meta name="apple-touch-fullscreen" content="YES" />
<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
<meta http-equiv="Cache-Control" content="public"/>
<link href="css/styles.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div align="center"><img src="img/ban_vlm_mobi.jpg" width="240" height="25" /></div>
<div class="txtbold1" align="center">Connexion VLM<hr></div>
<div align="center">
<form name="form1" method="post" action="">
  <table width="80%" border="0">
  <tr>
    <td width="30%"><div align="right"><strong>Email : </strong></div></td>
    <td width="50%"><input name="pseudo" type="text" size="12"></td>
  </tr>
  <tr>
    <td><div align="right"><strong>PSWD : </strong></div></td>
    <td><input type="password" name="password" size="12"></td>
  </tr>
  
  <tr>
    <td>&nbsp;</td>
    <td>
      <input type="submit" name="Submit" value="Envoyer">    </td>
  </tr>
</table>
</form>
<p>&nbsp;</p>
</div>
</body>
</html>