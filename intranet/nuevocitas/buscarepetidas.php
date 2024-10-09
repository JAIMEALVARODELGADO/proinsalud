<html>
<head>
<link rel="stylesheet" href="style.css" type="text/css"/>
</head
<body>
<?
include ('php/conexion1.php');

$bhor=mysql_query("SELECT * from horarios where Fecha_horario>='2013-08-03'"); 
$n=0;
while($rhor=mysql_fetch_array($bhor))
{
	$idhor=$rhor['ID_horario'];
	$numci=$rhor['ncita_horario'];
	
	$bcit=mysql_query("SELECT Count(citas.id_cita) AS cuenta FROM citas
	WHERE (((citas.ID_horario)='$idhor') AND ((citas.Clase_citas)<'6'))");
	while($rcit=mysql_fetch_array($bcit))
	{
		$numasig=$rcit['cuenta'];	
	}
	/*
	$res=$numci-$numasig;
	echo $numci.' '.$numasig.' ...... '.$res.'<br>';
	*/
	if($numci<$numasig)
	{
		$vec1[$n]=$idhor;
		$n++;
	}
}

echo "<table align=center class='tbl' width=98%>
<tr>
<th>IDCITA</th>
<th>CEDULA</th>
<th>NOMBRE PACIENTE</th>
<th>TELEFONO 1</th>
<th>TELEFONO 2</th>
<th>MEDICO</th>
<th>FECHA</th>
<th>HORA</th>
<th>FSOL</th>
<th>HSOL</th>
<th>NCITAS</th>
</TR>";

for($i=0;$i<$n;$i++)
{
	$hor=$vec1[$i];
	$bcitas=mysql_query("SELECT citas.id_cita, citas.ID_horario, citas.Idusu_citas, usuario.NROD_USU, usuario.PNOM_USU, usuario.SNOM_USU, usuario.PAPE_USU, usuario.SAPE_USU, 
	usuario.TRES_USU, usuario.TEL2_USU, horarios.Cserv_horario, horarios.Cmed_horario, medicos.nom_medi, horarios.Fecha_horario, horarios.Hora_horario, citas.Clase_citas, citas.Fsolusu_citas, 
	citas.Hora_cita, horarios.ncita_horario
	FROM medicos INNER JOIN ((citas INNER JOIN horarios ON citas.ID_horario = horarios.ID_horario) INNER JOIN usuario ON citas.Idusu_citas = usuario.CODI_USU) ON medicos.cod_medi = horarios.Cmed_horario
	WHERE (((citas.ID_horario)='$hor') AND ((citas.Clase_citas)<'6'))
	ORDER BY horarios.Cserv_horario, horarios.Cmed_horario, horarios.Fecha_horario, horarios.Hora_horario");
	while($rcitas=mysql_fetch_array($bcitas))
	{
		$id_cita=$rcitas['id_cita'];
		$ID_horario=$rcitas['ID_horario'];
		$Idusu_citas=$rcitas['Idusu_citas'];
		$cedula=$rcitas['NROD_USU'];
		$nompac=$rcitas['PNOM_USU'].' '.$rcitas['SNOM_USU'].' '.$rcitas['PAPE_USU'].' '.$rcitas['SAPE_USU'];
		$tel1=$rcitas['TRES_USU'];
		$tel2=$rcitas['TEL2_USU'];
		$Cserv_horario=$rcitas['Cserv_horario'];
		$Cmed_horario=$rcitas['Cmed_horario'];
		$nommedico=$rcitas['nom_medi'];
		$Fecha_horario=$rcitas['Fecha_horario'];
		$Hora_horario=$rcitas['Hora_horario'];
		$Clase_citas=$rcitas['Clase_citas'];
		$Fsolusu_citas=$rcitas['Fsolusu_citas'];
		$Hora_cita=$rcitas['Hora_cita'];
		$ncita_horario=$rcitas['ncita_horario'];
		
	
		
		echo"
		<tr>		
		<td>$id_cita</td>
		<td>$cedula</td>
		<td>$nompac</td>
		<td>$tel1</td>
		<td>$tel2</td>
		<td>$nommedico</td>
		<td>$Fecha_horario</td>
		<td>$Hora_horario</td>
		<td>$Fsolusu_citas</td>
		<td>$Hora_cita</td>
		<td>$ncita_horario</td>
		</tr>";
	}
	echo"<tr><td height=20></td></tr>";

}
echo"<table>";

/*

$bus=mysql_query("SELECT citas.id_cita, citas.ID_horario, citas.Idusu_citas, horarios.Cserv_horario, horarios.Cmed_horario, horarios.Fecha_horario, 
horarios.Hora_horario, citas.Clase_citas, citas.Fsolusu_citas, citas.Hora_cita,horarios.ncita_horario
FROM citas INNER JOIN horarios ON citas.ID_horario = horarios.ID_horario
WHERE (((horarios.Fecha_horario)>='2013-08-03') AND ((citas.Clase_citas)<'6'))
ORDER BY horarios.Cserv_horario, horarios.Cmed_horario, horarios.Fecha_horario, horarios.Hora_horario"); 
$n=0;
while($res=mysql_fetch_array($bus))
{
	$vec[$n][1]=$res['id_cita'];
	$vec[$n][2]=$res['ID_horario'];
	$vec[$n][3]=$res['Idusu_citas'];
	$vec[$n][4]=$res['Cserv_horario'];
	$vec[$n][5]=$res['Cmed_horario'];
	$vec[$n][6]=$res['Fecha_horario'];
	$vec[$n][7]=$res['Hora_horario'];
	$vec[$n][8]=$res['Clase_citas'];
	$vec[$n][9]=$res['Fsolusu_citas'];
	$vec[$n][10]=$res['Hora_cita'];
	$vec[$n][11]=$res['ncita_horario'];
	$n++;
}
echo "<table align=center class='tbl' width=98%>
<tr>
<th>NUM</th>
<th>IDCITA</th>
<th>IDHORARIO</th>
<th>IDUSUARIO</th>
<th>AREA</th>
<th>MEDICO</th>
<th>FECHA</th>
<th>HORA</th>
<th>FSOL</th>
<th>HSOL</th>
<th>NCITAS</th>
</TR>";
$j=1;
for($i=0;$i<$n;$i++)
{
	if($vec[$i][5]==$vec[$i+1][5] && $vec[$i][6]==$vec[$i+1][6] && $vec[$i][7]==$vec[$i+1][7])
	{	
		$id_cita=$vec[$i][1];
		$ID_horario=$vec[$i][2];
		$Idusu_citas=$vec[$i][3];
		$Cserv_horario=$vec[$i][4];
		$Cmed_horario=$vec[$i][5];
		$Fecha_horario=$vec[$i][6];
		$Hora_horario=$vec[$i][7];
		$Clase_citas=$vec[$i][8];
		$Fsolusu_citas=$vec[$i][9];
		$Hora_cita=$vec[$i][10];
		$ncita_horario=$vec[$i][11];
		echo"
		<tr>
		<td>$j</td>
		<td>$id_cita</td>
		<td>$ID_horario</td>
		<td>$Idusu_citas</td>
		<td>$Cserv_horario</td>
		<td>$Cmed_horario</td>
		<td>$Fecha_horario</td>
		<td>$Hora_horario</td>
		<td>$Fsolusu_citas</td>
		<td>$Hora_cita</td>
		<td>$ncita_horario</td>
		</tr>";
		$id_cita=$vec[$i+1][1];
		$ID_horario=$vec[$i+1][2];
		$Idusu_citas=$vec[$i+1][3];
		$Cserv_horario=$vec[$i+1][4];
		$Cmed_horario=$vec[$i+1][5];
		$Fecha_horario=$vec[$i+1][6];
		$Hora_horario=$vec[$i+1][7];
		$Clase_citas=$vec[$i+1][8];
		$Fsolusu_citas=$vec[$i+1][9];
		$Hora_cita=$vec[$i+1][10];
		$ncita_horario=$vec[$i+1][11];
		echo"
		<tr>
		<td>$j</td>
		<td>$id_cita</td>
		<td>$ID_horario</td>
		<td>$Idusu_citas</td>
		<td>$Cserv_horario</td>
		<td>$Cmed_horario</td>
		<td>$Fecha_horario</td>
		<td>$Hora_horario</td>
		<td>$Fsolusu_citas</td>
		<td>$Hora_cita</td>
		<td>$ncita_horario</td>
		</tr>
		<tr>
		<td height=20></td>
		</tr>
		";
		$j++;
	}
}
*/
?>
</body>
</html>




