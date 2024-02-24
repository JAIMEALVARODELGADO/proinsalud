<html>
<head>
<title>PROGRAMA DE FACTURACIÓN</title>
<link rel="stylesheet" href="css/style.css" type="text/css" />
</head>
<body>
<table class="Tbl0"><tr><td class="Td0" align='center'>ENTIDADES</td></tr></table>
<?
include('php/conexion.php');
$condicion="";
if(!empty($nit)){
  $condicion=$condicion."nit_con='$nit' AND ";}
if(!empty($razons)){
  $condicion=$condicion."neps_con LIKE '%$razons%' AND ";}
if(!empty($condicion)){
  $condicion=substr($condicion,0,(strlen($condicion)-5));
}

if(!empty($condicion)){
  $_pagi_sql="SELECT codi_con,nit_con,neps_con,dire_con,tele_con,repr_con,pers_con,chab_con,ctri_con,tpen_con,clas_con,esta_con FROM contrato WHERE $condicion ORDER BY neps_con";}
else{
  $_pagi_sql="SELECT codi_con,nit_con,neps_con,dire_con,tele_con,repr_con,pers_con,chab_con,ctri_con,tpen_con,clas_con,esta_con FROM contrato ORDER BY neps_con";}

//$_pagi_cuantos = 20; 
//include("php/paginator.inc.php"); 
$_pagi_sql=mysql_query($_pagi_sql);  
//if(mysql_num_rows($_pagi_result)!=0) {
if(mysql_num_rows($_pagi_sql)!=0) {
  echo "<table class='Tbl0'>";
  echo "<th class='Th0' width='10%'>OPCIONES</th>
        <th class='Th0' width='10%'>CODIGO</th>
        <th class='Th0' width='40%'>NOMBRE</th>
        <th class='Th0' width='15%'>NIT</th>
        <th class='Th0' width='15%'>TELEFONO</th>
        <th class='Th0' width='10%'>ESTADO</th>";
  //while($row=mysql_fetch_array($_pagi_result)){
  while($row=mysql_fetch_array($_pagi_sql)){
    echo "<tr>";
    echo "<td class='Td4'><a href='fac_editcont.php?codi_con=$row[codi_con]'><img src='icons/feed_edit.png' border='0' alt='Editar'></a></td>";
    echo "<td class='Td2'>$row[codi_con]</td>";
    echo "<td class='Td2'>$row[neps_con]</td>";
    echo "<td class='Td2'>$row[nit_con]</td>";
    echo "<td class='Td2'>$row[tele_con]</td>";
    if($row[esta_con]=='A'){$estado='Activo';}
    elseif($row[esta_con]=='I'){$estado='Inactivo';}
    echo "<td class='Td2'>$estado</td>";
    echo"</tr>";
  }
  echo "</table>";
  
  /*echo "<table class='Tbl2'>";
  echo "<tr>";
  echo "<td class='Td1'>".$_pagi_navegacion."</td>";
  echo "<td class='Td1'>Contratos: ".$_pagi_info."</td>";
  echo "</tr>";
  echo "</table>";*/
}
else{
  echo "<center>";
  echo "<p class=Msg>No existen registros para esta busqueda</p>";
  echo "</center>";
}
mysql_free_result($_pagi_sql);
mysql_close();
?>

</body>
</html>