<?php
/* ***************************************************************
  LOGOUT comme sont nom l'indique
****************************************************************** */
session_start();
session_destroy();
unset($_SESSION['IDU']);
//$_SESSION['IDU']="";
header("location: index.php");
?>
