<!-- Lista de usuarios.-->
<html>
<head><title>Consulta de Derechos</title>

</head>
<body >
<br>

<?
//Conexion con la base
mysql_connect("localhost","root",""); 
//selección de la base de datos con la que vamos a trabajar 
mysql_select_db("proinsalud");

//Aqui genero las condiciones de búsqueda
$condicion="";
if(!empty($identificacion)){
  $condicion=$condicion."NROD_USU='".$identificacion."' and ";
}
if(!empty($pnombre)){
  $condicion=$condicion."PNOM_USU='".$pnombre."' and ";
}
if(!empty($snombre)){
  $condicion=$condicion."SNOM_USU='".$snombre."' and ";
}
if(!empty($papelli)){
  $condicion=$condicion."PAPE_USU='".$papelli."' and ";
}
if(!empty($sapelli)){
  $condicion=$condicion."SAPE_USU='".$sapelli."' and ";
}
$condicion=substr($condicion,0,strlen($condicion)-5);
$consulta=mysql_query("SELECT CODI_USU, NROD_USU,PNOM_USU, SNOM_USU, PAPE_USU, SAPE_USU,TPAF_USU,DCOT_USU FROM usuario WHERE $condicion");

if (mysql_num_rows($consulta)==0){
   echo "<h2>Usuario no Encontrado</h2>";
}
else{
  echo "<Table border=1 BgColor=#FFFFFF BorderColor=#E6E8FA width=100% align=center cellpadding=0 Cellspacing=1>";
  echo "<th bgcolor=#D0D0F0>Identificación</th><th bgcolor=#D0D0F0>P. Nombre</th><th bgcolor=#D0D0F0>S. Nombre</th><th bgcolor=#D0D0F0>P. Apellido</th><th bgcolor=#D0D0F0>S. Apellido</th><th bgcolor=#D0D0F0>Tp Af</th><th bgcolor=#D0D0F0>Cotizante</th></TR>";
  $color="#CCCCCC";
  while ($row=mysql_fetch_array($consulta)){
    echo "<tr><td width=15% align=left bgcolor=$color><font size=2 face=arial>".$row['NROD_USU']."</font></td>";
    echo "<td width=15% align=left bgcolor=$color><font size=2 face=arial>".$row['PNOM_USU']."</font></td>";
    echo "<td width=15% align=left bgcolor=$color><font size=2 face=arial>".$row['SNOM_USU']."</font></td>";
    echo "<td width=15% align=left bgcolor=$color><font size=2 face=arial>".$row['PAPE_USU']."</font></td>";
    echo "<td width=15% align=left bgcolor=$color><font size=2 face=arial>".$row['SAPE_USU']."</font></td>";
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
    echo "<td width=15% align=left bgcolor=$color><font size=2 face=arial>".$tipoafi."</font></td>";
    echo "<td width=10% align=left bgcolor=$color><font size=2 face=arial>".$row['DCOT_USU']."</font></td>";
    if ($color=="#CCCCCC"){
      $color="#DFDFDF";}
    else{
      $color="#CCCCCC";}
  }
}
mysql_free_result($consulta);
mysql_close();

?>

</body>
</html>