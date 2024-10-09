<?
session_register('Gnombre');
session_register('Gidenti');
session_register('Gtipoafi');
session_register('Gestado');
session_register('Gcodi');
session_register('Gcontra');
session_register('Gcodmed');
session_register('Gfeini');
session_register('Gffini');
session_register('Garea');
session_register('Ghora');
session_register('Gtodos');
?> 
<html>
<head>
<title><h6>PROGRAMA PARA EL MANEJO DE CITAS MEDICAS</h6></title>
</head>
<body  scroll = "no">
<table width =100% align="center" border=1 cellpadding="0" cellpacing="1">
<th bgcolor="#8F8FBD"><font size=2>Nombre</font></th><th bgcolor="#8F8FBD"><font size=2>Identificacion</th><th bgcolor="#8F8FBD"><font size=2>Tipo Usuario</th><th bgcolor="#8F8FBD"><font size=2>Estado</th>
<?
$ced2=$Gidenti;
$ced=$Gcodi; 
$nombr=$Gnombre;
$est=$Gestado;
$contro=$Gcontra;
$tipot=$Gtipoafi;

echo "<tr><td><font size=3><b>$nombr</b></font><br></td>";
echo "<td><font size=2><b>$ced2</b></font></td>";
echo "<td><font size=1><b>$tipot</b></font></td>";
echo "<td><font size=2><b>$est</b></font></td></tr>";

?>
</td>
</body>

</html>
