<html>
<head>
<title>PROGRAMA DE FACTURACI�N</title>
<link rel="stylesheet" href="css/style.css" type="text/css" />
<script language='javascript'>
function validar(){
  form1.submit();
}
function selec_todo(cont_){
var cchk=0,comando=''
    if(document.form1.chktodo.checked==true){
        for(cchk=0;cchk<cont_;cchk=cchk+1){
            comando="document.form1.chkiden"+cchk+".checked=true";
            eval(comando);            
        }
    }
    else{
         for(cchk=0;cchk<cont_;cchk=cchk+1){
            comando="document.form1.chkiden"+cchk+".checked=false";
            eval(comando);
            //alert(comando);
        }
    }
}
</script>
</head>
<body>
<form name='form1' method="POST" action='fac_4heguardarel.php' target='fr02'>
<table class="Tbl0"><tr><td class="Td0" align='center'>LISTADO DE FACTURAS A RELACIONAR</td></tr></table>
<!--<table class="Tbl0" border='0'>
<<tr>
  <td class="Td1" align='left' colspan='2'><b>Factura a Relacionar con el N�mero:  <font color='#003333'><?echo $relacion;?></td>
</tr>
</table>-->
<?
include('php/conexion.php');
include('php/funciones.php');



$condicion="rela_fac='' AND anul_fac<>'S' AND esta_fac='2' AND ";
if(!empty($fac1)){
  $condicion=$condicion."nume_fac>='$fac1' AND ";}
if(!empty($fac2)){
  $condicion=$condicion."nume_fac<='$fac2' AND ";}  
if(!empty($pref_fac)){
  $condicion=$condicion."pref_fac='$pref_fac' AND ";}    
if(!empty($fec1)){
  //$fec1=cambiafecha($fec1);
  $condicion=$condicion."fcie_fac>='$fec1' AND ";}
if(!empty($fec2)){
  //$fec2=cambiafecha($fec2);
  $condicion=$condicion."fcie_fac<='$fec2' AND ";}  
if(!empty($entidad)){
  $condicion=$condicion."enti_fac='$entidad' AND ";}
if(!empty($id_ing)){
  $condicion=$condicion."id_ing='$id_ing' AND ";}
if(!empty($nrocontr)){
  $condicion=$condicion."iden_ctr='$nrocontr' AND ";}


if(!empty($codi_des)){
    //$condicion=$condicion."area_fac='$codi_des' AND ";  
  $condicion=$condicion.'(';
  for ($i=0;$i<count($codi_des);$i++){     
    $condicion=$condicion."area_fac='$codi_des[$i]' OR ";
  }
  $condicion=substr($condicion,0,(strlen($condicion)-4));
  $condicion=$condicion.') AND ';  
}


if(!empty($condicion)){
  $condicion=substr($condicion,0,(strlen($condicion)-5));
}
//echo $condicion;
/*$consulta="SELECT fa.iden_fac,fa.id_ing,fa.pref_fac,fa.nume_fac,fa.fcie_fac,us.tdoc_usu,us.nrod_usu,CONCAT(us.pnom_usu,' ',us.snom_usu,' ',us.pape_usu,' ',us.sape_usu) as nombre, fa.vnet_fac,fa.anul_fac,con.neps_con
 FROM encabezado_factura AS fa 
 INNER JOIN usuario AS us ON us.codi_usu=fa.codi_usu
 INNER JOIN contratacion AS ctr ON ctr.iden_ctr=fa.iden_ctr
 INNER JOIN contrato AS con ON con.codi_con=ctr.codi_con  
 WHERE $condicion ORDER BY fa.nume_fac";*/
 $consulta="SELECT iden_fac,id_ing,pref_fac,nume_fac,fcie_fac,tdoc_usu,nrod_usu,CONCAT(pnom_usu,' ',snom_usu,' ',pape_usu,' ',sape_usu) as nombre, vnet_fac,anul_fac,neps_con,servicio
 FROM vista_factura_encabezado
 WHERE $condicion ORDER BY nume_fac";
//echo "<BR>".$consulta;
$consulta=mysql_query($consulta);
if(mysql_num_rows($consulta)!=0){
  echo "<table class='Tbl0' border='0'>";
  echo "<th class='Th0'>Sel</th>
        <th class='Th0'>Número Fac</th>
        <th class='Th0'>Admision</th>
        <th class='Th0'>Entidad</th>
        <th class='Th0'>Servicio</th>
        <th class='Th0'>Fecha Cierre</th>
        <th class='Th0'>Identificación</th>
        <th class='Th0'>Nombre</th>
        <th class='Th0'>Vr. Neto</th>";
  $cont=0;
  while($row=mysql_fetch_array($consulta)){
    if($color<>'#dddddd'){$color='#dddddd';}else{$color='';}
      echo "<tr>";
      echo "<td class='Td2' bgcolor='$color'>";
      $var="chkiden".$cont;
      echo "<input type='checkbox' name='$var'>";
      $var="iden_fac".$cont;
      echo "<input type='hidden' name='$var' value='$row[iden_fac]'>";
      echo "</td>";
      echo "<td class='Td2' align='left' bgcolor='$color'>$row[pref_fac] $row[nume_fac]</td>";
      echo "<td class='Td2' align='left' bgcolor='$color'>$row[id_ing]</td>";
      echo "<td class='Td2' align='left' bgcolor='$color'>$row[NEPS_CON]</td>";
      echo "<td class='Td2' align='left' bgcolor='$color'>$row[servicio]</td>";
      echo "<td class='Td2' bgcolor='$color'>".cambiafechadmy($row[fcie_fac])."</td>";
      echo "<td class='Td2' bgcolor='$color'>$row[NROD_USU]</td>";
      echo "<td class='Td2' bgcolor='$color'>$row[nombre]</td>";
      echo "<td class='Td5' bgcolor='$color'>$row[vnet_fac]</td>";
      echo"</tr>";
      $cont++;
    }
    echo "<tr>";
    if($color<>'#dddddd'){$color='#dddddd';}else{$color='';}
    echo "<td class='Td2' bgcolor='$color'>";
    echo "<input type='checkbox' name='chktodo' onclick='selec_todo($cont)'>";
    echo "</td>";
    echo "<td class='Td2' bgcolor='$color'><b>Seleccionar Todo</td>";
    echo "</tr>";
    echo "</table>";
    echo "<center>";
    echo "<a href='#' onclick='validar()'><img src='icons/feed_disk.png' border='0' alt='Buscar' width=20 height=20>Guardar</a>";
    echo "</center>";
}
else{
  echo "<center>";
  echo "<p class=Msg>No existen registros para esta busqueda</p>";
  echo "</center>";
}
echo "<input type='hidden' name='cont' value='$cont'>";
echo "<input type='hidden' name='relacion' value='$relacion'>";
mysql_free_result($consulta);
mysql_close();
?>

</form>
</body>
</html><html><head></head><body></body></html>