<?php
/* ***************************************************************
La page de login utilsée en include par index.php
****************************************************************** */
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>LOGIN VLM</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<style type="text/css">
<!--
body,td,th {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 10px;
}
-->
</style>
</head>
<body>
<form name="form1" method="post" action="">
<table width="400" border="0">
  <tr>
    <td width="112"><div align="right"><strong>Pseudo : </strong></div></td>
    <td width="278"><input type="text" name="pseudo"></td>
  </tr>
  <tr>
    <td><div align="right"><strong>Mot de passe : </strong></div></td>
    <td><input type="password" name="password"></td>
  </tr>
  
  <tr>
    <td>&nbsp;</td>
    <td>
      <input type="submit" name="Submit" value="Envoyer">    </td>
  </tr>
</table>
</form>
<p>&nbsp;</p>
</body>
</html>