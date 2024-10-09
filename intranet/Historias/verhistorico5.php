<?
session_register('Gideusu');
session_register('Gcontrato');
session_register('Gsexo');
session_register('Gfecha');
session_register('Gidcita');
echo $cedula;
?> 

<?php
include ('/Inetpub/wwwroot/intranet/Libreria/Php/conexiones_g.php');
include ('/Inetpub/wwwroot/intranet/Libreria/Php/sql.php');
include ('/Inetpub/wwwroot/intranet/Libreria/Php/funciones.php');
base_proinsalud();

foreach($_POST['seleccionhisto'] as $seleccion) { 
//echo "va:$seleccion";
}

?>
<html>
<head>
<title>Principal</title>
<Script Language="JavaScript">
function load(){

document.getElementById('US_Add').submit() 

}

</Script>
</head>
<?
if ($tipos=="historia") {
echo "<FORM name=US_Add action=impre_consul.php METHOD=POST ><br>";
}
else{
//echo "<FORM name=US_Add action=imprehis.php METHOD=POST ><br>";
echo "<FORM name=US_Add action='/intranet/uci/imprehis.php' METHOD=POST ><br>";
echo "<input type=hidden name=iden_evo value='$seleccion'>";
}
echo "<input type=hidden name=t2 value=$ceula>";//ACTION=dar_cita.php
echo "<input type=hidden name=t1 value=$btn3>";//ACTION=dar_cita.php
echo "<input type=hidden name=serie value='$seleccion'>";
echo "<input type=hidden name=histo1 value='on'>";
echo "<input type=hidden name=vista value='on'>";
//onload="javascript:load()"  <a href="javascript:load()">Solicitudes de Informatica</a> 
?>
</form>
<body onload="javascript:load()">
</body>
</html>