<!-- Muestra la información básica del usuario cuando es encontrado.-->
<html>
<head><title>Consulta de Epicrisis</title>

<SCRIPT LANGUAGE=JavaScript>
function validar2(){
window.open("dar_cita.php","fr2")
}
</SCRIPT>


<?
//Aqui cargo las funciones
include("funciones.php");
?>
</head>
<body >
<br>
<?


include ('php/conexion2.php');
$consulta="SELECT epi.iden_epi,epi.iden_evo,evo.fech_evo,usu.pnom_usu,usu.snom_usu,usu.pape_usu,usu.sape_usu,med.nom_medi
 FROM epicrisis as epi
 INNER JOIN hist_evo as evo ON evo.iden_evo=epi.iden_evo
 INNER JOIN usuario as usu ON evo.codi_usu=usu.codi_usu
 INNER JOIN medicos as med ON med.cod_medi=evo.cod_medi
 WHERE NROD_USU='$identificacion'";

//echo $consulta;
 
$consulta=mysql_query($consulta);
 
/*echo "SELECT epi.iden_epi,epi.iden_evo,evo.fech_evo,usu.pnom_usu,usu.snom_usu,usu.pape_usu,usu.sape_usu,med.nom_medi
 FROM epicrisis as epi
 INNER JOIN hist_evo as evo ON evo.iden_evo=epi.iden_evo
 INNER JOIN usuario as usu ON evo.codi_usu=usu.codi_usu
 INNER JOIN medicos as med ON med.cod_medi=evo.cod_medi
 WHERE NROD_USU='$identificacion'";*/
if(mysql_num_rows($consulta)==0){
   echo "<h2>Usuario no Encontrado</h2>";
}
else{
	

  echo "<Table border=1 BgColor=#DFDFDF BorderColor=#E6E8FA width=100% align=center cellpadding=0 Cellspacing=0>";
  echo "<th>Opciones</th><th>Nombre</th><th>Fecha</th><th>Profesional</th><th>Servicio</th>";
  while($row=mysql_fetch_array($consulta)){
	$iden_evo=$row[iden_evo];
	$bin=mysql_query("select * from hist_evo where   iden_evo='$iden_evo'");
	$rin=mysql_fetch_array($bin);
	$id_ing=$rin['id_ing'];
	
    $nombre=$row[pnom_usu].' '.$row[snom_usu].' '.$row[pape_usu].' '.$row[sape_usu];
    echo "<tr>";
    echo "<td bgcolor='#ffffff' align='center'>$id_ing <a href='../uci/impreepi.php?iden_evo=$iden_evo'><img src='img/32px-Crystal_Clear_action_fileprint.png' height='25' width='25' alt='Visualizar' border=0></a></td>";
	echo "<td bgcolor='#ffffff'><font size=2>$nombre</font></td>";
	echo "<td bgcolor='#ffffff'><font size=2>".cambiafechadmy($row[fech_evo])."</font></td>";
	echo "<td bgcolor='#ffffff'><font size=2>$row[nom_medi]</font></td>";
	$consultacama=mysql_query("SELECT evo.cama_evo, des.nomb_des FROM hist_evo AS evo
    INNER JOIN destipos AS des ON des.codi_des = evo.cama_evo
    WHERE iden_evo=$row[iden_evo]");
	if(mysql_num_rows($consultacama)<>0){
	  $rowcama=mysql_fetch_array($consultacama);
	  $cama=$rowcama[cama_evo];
      $descama=$rowcama[nomb_des];		  
	  $consultaser=mysql_query("SELECT nomb_des FROM destipos WHERE codi_des = (SELECT valo_des FROM destipos WHERE codi_des='$cama')");
	  $rowser=mysql_fetch_array($consultaser);
	  $servicio=$rowser[nomb_des];
	}
	echo "<td bgcolor='#ffffff'>".$descama.' '.$servicio."</td>";
	echo "</tr>";
  }
  echo "</table>";
}





$consulta="SELECT epi.id_ing, epi.iden_epi,epi.iden_evo,evo.fech_evo,usu.pnom_usu,usu.snom_usu,usu.pape_usu,usu.sape_usu,med.nom_medi
 FROM epicrisis2 as epi
 INNER JOIN hist_evo as evo ON evo.iden_evo=epi.iden_evo
 INNER JOIN usuario as usu ON evo.codi_usu=usu.codi_usu
 INNER JOIN medicos as med ON med.cod_medi=evo.cod_medi
 WHERE NROD_USU='$identificacion'";
 //echo $consulta;
 $consulta=mysql_query($consulta);
 
/*echo "SELECT epi.iden_epi,epi.iden_evo,evo.fech_evo,usu.pnom_usu,usu.snom_usu,usu.pape_usu,usu.sape_usu,med.nom_medi
 FROM epicrisis as epi
 INNER JOIN hist_evo as evo ON evo.iden_evo=epi.iden_evo
 INNER JOIN usuario as usu ON evo.codi_usu=usu.codi_usu
 INNER JOIN medicos as med ON med.cod_medi=evo.cod_medi
 WHERE NROD_USU='$identificacion'";*/
if(mysql_num_rows($consulta)>0){
  echo "<br><Table border=1 BgColor=#DFDFDF BorderColor=#E6E8FA width=100% align=center cellpadding=0 Cellspacing=0>";
  echo "<tr><th colspan=5>NUEVA EPICRISIS</th></tr>";
 echo "<tr><th>Opciones</th><th>Nombre</th><th>Fecha</th><th>Profesional</th><th>Servicio</th></tr>";
  while($row=mysql_fetch_array($consulta)){
	$iden_evo=$row[iden_evo];
	$id_ing=$row[id_ing];
  
    $nombre=$row[pnom_usu].' '.$row[snom_usu].' '.$row[pape_usu].' '.$row[sape_usu];
    echo "<tr>";
    echo "<td bgcolor='#ffffff' align='center'>$id_ing <a href='../uci/impreepinue.php?iden_evo=$iden_evo'><img src='img/32px-Crystal_Clear_action_fileprint.png' height='25' width='25' alt='Visualizar' border=0></a></td>";
	echo "<td bgcolor='#ffffff'><font size=2>$nombre</font></td>";
	echo "<td bgcolor='#ffffff'><font size=2>".cambiafechadmy($row[fech_evo])."</font></td>";
	echo "<td bgcolor='#ffffff'><font size=2>$row[nom_medi]</font></td>";
	$consultacama=mysql_query("SELECT evo.cama_evo, des.nomb_des FROM hist_evo AS evo
    INNER JOIN destipos AS des ON des.codi_des = evo.cama_evo
    WHERE iden_evo=$row[iden_evo]");
	if(mysql_num_rows($consultacama)<>0){
	  $rowcama=mysql_fetch_array($consultacama);
	  $cama=$rowcama[cama_evo];
      $descama=$rowcama[nomb_des];		  
	  $consultaser=mysql_query("SELECT nomb_des FROM destipos WHERE codi_des = (SELECT valo_des FROM destipos WHERE codi_des='$cama')");
	  $rowser=mysql_fetch_array($consultaser);
	  $servicio=$rowser[nomb_des];
	}
	echo "<td bgcolor='#ffffff'>".$descama.' '.$servicio."</td>";
	echo "</tr>";
  }
  echo "</table>";
}


?>



</body>
</html>