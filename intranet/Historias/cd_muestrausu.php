<?
session_register('Gnombre');
session_register('Gidenti');
session_register('Gtipoafi');
session_register('Gestado');
session_register('Gcodi');
session_register('Gcontra');
session_register('Gmun');

?> 
<!-- Muestra la información básica del usuario cuando es encontrado.-->



<html>
<head><title>Consulta de Derechos</title>

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
//Conexion con la base
mysql_connect("localhost","root",""); 
//selección de la base de datos con la que vamos a trabajar 
mysql_select_db("proinsalud");
//Aqui realizo la consulta del usuario y sus contratos
$consulta=mysql_query("SELECT CODI_CON,CODI_USU, PNOM_USU, SNOM_USU, PAPE_USU, SAPE_USU, MRES_USU, FNAC_USU, SEXO_USU, TRES_USU, TEL2_USU, REGI_USU, TPAF_USU, ESTR_USU, PARE_USU, DCOT_USU, CONT_UCO,NEPS_CON,NOMB_MUN,IDEN_UCO FROM usuario, ucontrato,contrato,municipio WHERE CUSU_UCO = CODI_USU AND CODI_CON=CONT_UCO AND MATE_USU=CODI_MUN AND ESTA_USU='A' AND CONT_UCO='$contrato' AND NROD_USU = '$identificacion'");
if (mysql_num_rows($consulta)==0){
   echo "<h2>Usuario no Encontrado</h2>";
}
else{
  $row=mysql_fetch_array($consulta);
  $codigo_uco=$row['IDEN_UCO'];

  echo "<Table border=0 BgColor=#DFDFDF BorderColor=#E6E8FA width=100% align=center cellpadding=0 Cellspacing=1>";
  echo "<tr><td width=50% align=right bgcolor=#DFDFDF><font size=2 face=arial><b>Contrato:</font></td>";
  echo "<td width=50% align=left bgcolor=#DFDFDF><font size=2 face=arial>".$row['NEPS_CON']."</font></td></tr>";

  echo "<tr><td width=50% align=right bgcolor=#CCCCCC><font size=2 face=arial><b>Modalidad:</font></td>";
  if ($row['MODA_UCO']=="C"){
    $modalidad="Capitación";
  }
  else{
    $modalidad="Evento";
  }
  echo "<td width=50% align=left bgcolor=#CCCCCC><font size=2 face=arial>$modalidad</font></td></tr>";

  echo "<tr><td width=50% align=right bgcolor=#DFDFDF><font size=2 face=arial><b>Identificación:</font></td>";
  echo "<td width=50% align=left bgcolor=#DFDFDF><font size=2 face=arial>".$identificacion."</font></td></tr>";

  echo "<tr><td width=50% align=right bgcolor=#CCCCCC><font size=2 face=arial><b>Nombre:</font></td>";
  echo "<td width=50% align=left bgcolor=#CCCCCC><font size=2 face=arial>".$row['PNOM_USU'].' '.$row['SNOM_USU'].' '.$row['PAPE_USU'].' '.$row['SAPE_USU']."</font></td></tr>";

  echo "<tr><td width=50% align=right bgcolor=#DFDFDF><font size=2 face=arial><b>Municipio de Atención:</font></td>";
  echo "<td width=50% align=left bgcolor=#DFDFDF><font size=2 face=arial>".$row['NOMB_MUN']."</font></td></tr>";

echo "<tr><td width=50% align=right bgcolor=#DFDFDF><font size=2 face=arial><b>Municipio de Residencia:</font></td>";
  echo "<td width=50% align=left bgcolor=#DFDFDF><font size=2 face=arial>".$row['MRES_USU']."</font></td></tr>";  



$mu=$row['NOMB_MUN'];
  echo "<tr><td width=50% align=right bgcolor=#CCCCCC><font size=2 face=arial><b>Fecha de Nacimiento:</font></td>";
  $edad=calculaedad($row['FNAC_USU']);
  echo "<td width=50% align=left bgcolor=#CCCCCC><font size=2 face=arial>".substr($row['FNAC_USU'],8,2).'/'.substr($row['FNAC_USU'],5,2).'/'.substr($row['FNAC_USU'],0,4)." Edad: $edad</font></td></tr>";

  echo "<tr><td width=50% align=right bgcolor=#DFDFDF><font size=2 face=arial><b>Sexo:</font></td>";
  switch ($row['SEXO_USU']){
    case "M":
      $sexo="Masculino";
      break;
    case "F":
      $sexo="Femenino";
      break;
    default:
      $sexo="Indeterminado";
  }
  echo "<td width=50% align=left bgcolor=#DFDFDF><font size=2 face=arial>$sexo</font></td></tr>";

  echo "<tr><td width=50% align=right bgcolor=#CCCCCC><font size=2 face=arial><b>Teléfonos:</font></td>";
  echo "<td width=50% align=left bgcolor=#CCCCCC><font size=2 face=arial>".$row['TRES_USU'].' - '.$row['TEL2_USU']."</font></td></tr>";

  echo "<tr><td width=50% align=right bgcolor=#DFDFDF><font size=2 face=arial><b>Régimen:</font></td>";
  switch ($row['REGI_USU']){
    case "1":
      $regimen="Contributivo";
      break;
    case "2":
      $regimen="Subsidiado";
      break;
    case "3":
      $regimen="Vinculado";
      break;
    case "4":
      $regimen="Particular";
      break;
    case "5":
      $regimen="Otro";
      break;
    case "6":
      $regimen="Especial";
      break;
    default:
      $regimen="Indeterminado";
  }
  echo "<td width=50% align=left bgcolor=#DFDFDF><font size=2 face=arial>$regimen</font></td></tr>";

  echo "<tr><td width=50% align=right bgcolor=#CCCCCC><font size=2 face=arial><b>Tipo de Afiliado:</font></td>";
  switch ($row['TPAF_USU']){
    case "C":
      $tipoafi="Cotizante";
      break;
    case "B":
      $tipoafi="Beneficiario";
      break;
    case "A":
      $tipoafi="Adicional";
      break;
    case "F":
      $tipoafi="Cabeza de Familia";
      break;
    case "O":
      $tipoafi="Otro miembro del grupo familiar";
      break;
    default:
      $tipoafi="Indeterminado";
  }
  echo "<td width=50% align=left bgcolor=#CCCCCC><font size=2 face=arial>$tipoafi</font></td></tr>";

  echo "<tr><td width=50% align=right bgcolor=#DFDFDF><font size=2 face=arial><b>Estrato:</font></td>";
  switch ($row['ESTR_USU']){
    case "1":
      $estrato="Uno";
      break;
    case "2":
      $estrato="Dos";
      break;
    case "3":
      $estrato="Tres";
      break;
    case "4":
      $estrato="Régimen Especial";
      break;
    default:
      $estrato="Indeterminado";
  }
  echo "<td width=50% align=left bgcolor=#DFDFDF><font size=2 face=arial>$estrato</font></td></tr>";

  echo "<tr><td width=50% align=right bgcolor=#CCCCCC><font size=2 face=arial><b>Parentesco:</font></td>";
  switch ($row['PARE_USU']){
    case "1":
      $parentesco="Cónyuge o compañero(a) permanente";
      break;
    case "2":
      $parentesco="Hijo(a)";
      break;
    case "3":
      $parentesco="Padre o madre";
      break;
    case "4":
      $parentesco="Segundo grado de consanguinidad";
      break;
    case "5":
      $parentesco="Tercer grado de consanguinidad";
      break;
    case "6":
      $parentesco="Menor de 12 años de edad sin consanguinidad";
      break;
    case "7":
      $parentesco="Padre o madre del cónyuge";
      break;
    case "8":
      $parentesco="Otros no parientes";
      break;
    case "9":
      $parentesco="Cabeza del grupo familiar o cotizante principal";
      break;
    default:
      $parentesco="Indeterminado";
  }
  echo "<td width=50% align=left bgcolor=#CCCCCC><font size=2 face=arial>$parentesco</font></td></tr>";

  echo "<tr><td width=50% align=right bgcolor=#DFDFDF><font size=2 face=arial><b>Identificación del Cotizante:</font></td>";
  echo "<td width=50% align=left bgcolor=#DFDFDF><font size=2 face=arial>".$row['DCOT_USU']."</font></td></tr>";

  echo "<tr><td width=50% align=right bgcolor=#CCCCCC><font size=2 face=arial><b>Estado:</font></td>";

  //Aqui recojo el codigo de la ultima novedad del usuario en el contrato
  $consulta2=mysql_query("SELECT MAX(CODI_NUS) FROM nusuario WHERE IUCO_NUS= $codigo_uco");
  $row2=mysql_fetch_array($consulta2);
  $codigo_nus=$row2['MAX(CODI_NUS)'];

  //Aqui recojo el estado de la ultima novedad del usuario en el contrato
  $consulta2=mysql_query("SELECT FINI_NUS,FFIN_NUS,ESTA_NUS,DESC_DTI FROM nusuario,dtipo WHERE CODI_DTI=ESTA_NUS AND CODI_NUS= $codigo_nus");
  $row2=mysql_fetch_array($consulta2);
  $estado=valestado($row2['ESTA_NUS'],$row2['FFIN_NUS'],$row2['DESC_DTI']);
  $estado=trim($estado);
  //Aqui valido los derechos de los beneficiarios de Magisterio mayores de 18 años
  if($row['PARE_USU']=="2" & $contrato=="002" & substr($edad,0,2)>=19 & substr($edad,3,4)=="Años" & $estado=="Activo"){
    $codigo=$row['CODI_USU'];
    $consultaben=mysql_query("SELECT DISC_BEN,COND_BEN FROM benadicional WHERE CUSU_BEN=$codigo");
    if (mysql_num_rows($consultaben)<>0){
      $rowben=mysql_fetch_array($consultaben);
      if($rowben['COND_BEN']=="" & substr($edad,0,2)>=19 & substr($edad,3,4)=="Años"){
        $estado="Suspendido por mayoría de edad";
      }
      if($rowben['COND_BEN']=="E" & substr($edad,0,2)>=26 & substr($edad,3,4)=="Años"){
        $estado="Suspendido por mayoría de edad";
      }
    }
    mysql_free_result($consultaben);
  }


  echo "<td width=50% align=left bgcolor=#CCCCCC><font size=2 face=arial>$estado</font></td></tr></table>";
$codm=$row['CODI_USU'];	 

  mysql_free_result($consulta2);
  mysql_free_result($consulta);
  mysql_close();
}
?>
<?

$contrm=$row['CODI_CON'];

$nombm=$row['PNOM_USU']." ".$row['SNOM_USU']." ".$row['PAPE_USU']." ".$row['SAPE_USU'];
$tipm=$tipoafi;
$estm=$estado;
$vacti="Activo";

if (substr($estm,0,6)==$vacti)  {



$Gnombre =$GLOBALS["nombm"] ;
$Gidenti=$GLOBALS["identificacion"] ;
$Gtipoafi=$GLOBALS["tipm"] ;
$Gestado=$GLOBALS["estm"] ;
$Gcodi=$GLOBALS["codm"] ;
$Gcontra=$GLOBALS["contrm"] ;
$Gmun= $GLOBALS["mu"];




}
else{





$identificacion="";
$Gidenti=$GLOBALS["identificacion"] ;


$nombm="Usuario sin Derecho";
$Gnombre = $GLOBALS["nombm"] ;
$sest="";
$Gestado=$GLOBALS["sest"] ;
}
echo '<input type="button" name="btn2" value="Ver Historicos" onclick="validar2()">';

?>






</body>
</html>