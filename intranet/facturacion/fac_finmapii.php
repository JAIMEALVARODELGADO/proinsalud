<?
session_register('gclase');
session_register('gcod');
session_register('gnom');
unset($_SESSION['gclase']);
unset($_SESSION['gcod']);
unset($_SESSION['gnom']);

echo "<body onload='location.href=\"busq_mapii.php\"'>";

?>