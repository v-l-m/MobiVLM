<?php
/* ***************************************************************
La page de login utilse en include par index.php
****************************************************************** */
?>
<!DOCTYPE html PUBLIC "-//WAPFORUM//DTD XHTML Mobile 1.1//EN" "http://www.openmobilealliance.org/tech/DTD/xhtml-mobile11.dtd">
<html>
<head>
<title>LOGIN MobiVLM</title>
<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
<meta http-equiv="Cache-Control" content="public"/>
<link href="styles.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div align="center"><img src="ban_vlm_mobi.jpg" width="240" height="25" /></div>
<div class="txtbold1" align="center">Connexion VLM<hr></div>
<div align="center">
<form name="form1" method="post" action="">
  <table width="80%" border="0">
  <tr>
    <td width="30%"><div align="right"><strong>Pseudo : </strong></div></td>
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