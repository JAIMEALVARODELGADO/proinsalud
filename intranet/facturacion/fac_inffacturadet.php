<html>
<head>
<title>PROGRAMA DE FACTURACIÓN</title>
<link rel="stylesheet" href="css/style.css" type="text/css" />
</head>
<SCRIPT LANGUAGE=JavaScript>
function imprimir(factu_) 
{
var URL="fac_2previo.php?iden_fac="+factu_; 
var titulo="Factura" 
var x=0 
var y=0 
var ancho=1000
var alto=700
var herramientas=0
var direccion=0
var barras=1
ventana= window.open(URL,titulo,"left="+x+",top="+y+",width="+ancho+",height="+alto+",toolbar="+herramientas+",location="+direccion+",scrollbars="+barras) 
} 

function imprimirtodo(abierta)
{
document.form1.submit();
} 
</script>

<body>
<form name="form1" method="post" action="fac_previotot.php" target="new">
<table class="Tbl0"><tr><td class="Td0" align='center'>LISTADO DETALLADO DE FACTURAS</td></tr></table>
<?
include('php/conexiones_g.php');
base_proinsalud();
include('php/funciones.php');
$condicion="";
/*if($abierta=='on'){
    $condicion=$condicion."ef.esta_fac='1' AND ";
}*/
//if($cerrada=='on'){
    $condicion=$condicion."ef.esta_fac='2' AND ";
//}
/*if($abierta=='on' and $cerrada=='on'){
    $condicion="(ef.esta_fac='1' OR ef.esta_fac='2') AND ";    
}*/

if(!empty($fac1)){
  $condicion=$condicion."ef.nume_fac>='$fac1' AND ";}
if(!empty($pref_fac)){
  $condicion=$condicion."ef.pref_fac='$pref_fac' AND ";}  
if(!empty($fac2)){
  $condicion=$condicion."ef.nume_fac<='$fac2' AND ";}
if(!empty($fecini1)){
  $fecini1=cambiafecha($fecini1);
  $condicion=$condicion."ef.feci_fac>='$fecini1' AND ";}  
if(!empty($fecini2)){
  $fecini2=cambiafecha($fecini2);
  $condicion=$condicion."ef.feci_fac<='$fecini2' AND ";}  
if(!empty($fec1)){
  $fec1=cambiafecha($fec1);
  $condicion=$condicion."ef.fcie_fac>='$fec1' AND ";}
if(!empty($fec2)){
  $fec2=cambiafecha($fec2);
  $condicion=$condicion."ef.fcie_fac<='$fec2' AND ";}  
if(!empty($contrato)){
  $condicion=$condicion."con.codi_con='$contrato' AND ";}
if(!empty($entidad)){
  $condicion=$condicion."ef.enti_fac='$entidad' AND ";}
if(!empty($nrocontr)){
  $condicion=$condicion."ef.iden_ctr='$nrocontr' AND ";}  
if(!empty($servic)){
  $condicion=$condicion."ef.area_fac='$servic' AND ";}

//echo "<br>".$anulada;
//if($anulada=='on'){
  $condicion=$condicion."ef.anul_fac='N' AND ";
if(!empty($relac)){
  $condicion=$condicion."ef.rela_fac='$relac' AND ";}
if(!empty($condicion)){
  $condicion=substr($condicion,0,(strlen($condicion)-5));
}
//echo $condicion;
$consulta="SELECT df.tipo_dfa,df.iden_tco,df.desc_dfa,df.cant_dfa,df.valu_dfa,df.cant_dfa*df.valu_dfa AS total,
    ef.tipo_fac,ef.pref_fac,ef.nume_fac,ef.rela_fac,ef.codi_con,ef.area_fac,ef.feci_fac,ef.fecf_fac,ef.fcie_fac,ef.esta_fac,ef.usua_fac,ef.anul_fac,
    con.neps_con,
    area.nomb_des AS nomb_area,
    serv.nomb_des AS nomb_ser,
    clase.nomb_des AS nomb_clas
    FROM detalle_factura AS df
    INNER JOIN encabezado_factura AS ef ON ef.iden_fac=df.iden_fac
    INNER JOIN contrato AS con ON con.codi_con=ef.codi_con
    INNER JOIN destipos AS area ON area.codi_des=ef.area_fac
    INNER JOIN tarco AS tar ON tar.iden_tco=df.iden_tco
    INNER JOIN destipos AS serv ON serv.codi_des=tar.tser_tco
    INNER JOIN mapii AS map ON map.iden_map=tar.iden_map
    INNER JOIN destipos AS clase ON clase.codi_des=map.clas_map
    WHERE $condicion";
//echo $consulta;
$consulta=mysql_query($consulta);
if(mysql_num_rows($consulta)!=0) {
  echo "<table class='Tbl0' border='0'>";
  echo "<th class='Th0'>Número</th>
        <th class='Th0'>Cta Cob.</th>
        <th class='Th0'>F. Cierre</th>
        <th class='Th0'>F.At.Ini</th>
	<th class='Th0'>F.At.Fin</th>	
        <th class='Th0'>Contrato</th>
        <th class='Th0'>Area</th>
        <th class='Th0'>Tip</th>
        <th class='Th0'>Servicio</th>
        <th class='Th0'>Clase</th>        
        <th class='Th0'>Descripción</th>
        <th class='Th0'>Cant</th>
        <th class='Th0'>Vr.Unit</th>
        <th class='Th0'>Vr.Total</th>        
	<th class='Th0'>Usuario</th>";
  $total=0;
  while($row=mysql_fetch_array($consulta)){
    echo "<tr>";
    echo "<td class='Td2' align='left'>$row[pref_fac] $row[nume_fac]</td>";
    echo "<td class='Td2' align='left'>$row[rela_fac]</td>";
    echo "<td class='Td2'>".cambiafechadmy($row[fcie_fac])."</td>";    
    echo "<td class='Td2'>".cambiafechadmy($row[feci_fac])."</td>";
    echo "<td class='Td2'>".cambiafechadmy($row[fecf_fac])."</td>";
    echo "<td class='Td2'>$row[neps_con]</td>";
    echo "<td class='Td2'>$row[nomb_area]</td>";
    echo "<td class='Td2'>$row[tipo_dfa]</td>";
    echo "<td class='Td2'>$row[nomb_ser]</td>";
    echo "<td class='Td2'>$row[nomb_clas]</td>";    
    echo "<td class='Td2'>$row[desc_dfa]</td>";
    echo "<td class='Td2'>$row[cant_dfa]</td>";
    echo "<td class='Td2'>$row[valu_dfa]</td>";
    echo "<td class='Td2'>$row[total]</td>";
    $operador=traeusu($row[usua_fac]);
    echo "<td class='Td2'>$operador</td>";
    echo"</tr>";
    $total=$total+$row[total];
  }
}

$condicion=$condicion." and df.tipo_dfa<>'P' ";
base_proinsalud();
$consulta="SELECT df.tipo_dfa,df.iden_tco,df.desc_dfa,df.cant_dfa,df.valu_dfa,df.cant_dfa*df.valu_dfa AS total,
    ef.tipo_fac,ef.nume_fac,ef.rela_fac,ef.codi_con,ef.area_fac,ef.feci_fac,ef.fecf_fac,ef.fcie_fac,ef.esta_fac,ef.usua_fac,ef.anul_fac,
    con.neps_con,
    area.nomb_des AS nomb_area
    FROM detalle_factura AS df
    INNER JOIN encabezado_factura AS ef ON ef.iden_fac=df.iden_fac
    INNER JOIN contrato AS con ON con.codi_con=ef.codi_con
    INNER JOIN destipos AS area ON area.codi_des=ef.area_fac
    WHERE $condicion";
//serv.nomb_des AS nomb_ser,
//clase.nomb_des AS nomb_clas
//INNER JOIN tarco AS tar ON tar.iden_tco=df.iden_tco
//INNER JOIN destipos AS serv ON serv.codi_des=tar.tser_tco
//INNER JOIN mapii AS map ON map.iden_map=tar.iden_map
//INNER JOIN destipos AS clase ON clase.codi_des=map.clas_map
//echo $consulta;
$consulta=mysql_query($consulta);
if(mysql_num_rows($consulta)!=0){
  while($row=mysql_fetch_array($consulta)){
    echo "<tr>";
    echo "<td class='Td2' align='left'>$row[nume_fac]</td>";
    echo "<td class='Td2' align='left'>$row[rela_fac]</td>";
    echo "<td class='Td2'>".cambiafechadmy($row[fcie_fac])."</td>";    
    echo "<td class='Td2'>".cambiafechadmy($row[feci_fac])."</td>";
    echo "<td class='Td2'>".cambiafechadmy($row[fecf_fac])."</td>";
    echo "<td class='Td2'>$row[neps_con]</td>";
    echo "<td class='Td2'>$row[nomb_area]</td>";
    echo "<td class='Td2'>$row[tipo_dfa]</td>";
    echo "<td class='Td2'>$row[nomb_ser]</td>";
    echo "<td class='Td2'>$row[nomb_clas]</td>";    
    echo "<td class='Td2'>$row[desc_dfa]</td>";
    echo "<td class='Td2'>$row[cant_dfa]</td>";
    echo "<td class='Td2'>$row[valu_dfa]</td>";
    echo "<td class='Td2'>$row[total]</td>";
    $operador=traeusu($row[usua_fac]);
    echo "<td class='Td2'>$operador</td>";
    echo"</tr>";
    $total=$total+$row[total];
  }

  echo "<tr>";
  echo "<td class='Td5'></td>";
  echo "<td class='Td5'></td>";
  echo "<td class='Td5'></td>";
  echo "<td class='Td5'></td>";
  echo "<td class='Td5'></td>";
  echo "<td class='Td5'></td>";
  echo "<td class='Td5'></td>";
  echo "<td class='Td5'></td>";
  echo "<td class='Td5'></td>";
  echo "<td class='Td5'></td>";
  echo "<td class='Td5'></td>";
  echo "<td class='Td5'></td>";
  echo "<td class='Td5'><b>Total:</td>";
  echo "<td class='Td5'>$total</td>";
  echo "</tr>";
  echo "</table>";    
  //echo "<center><a href='#' onclick='imprimirtodo()'><img src='icons/print.ico' border='0' alt='Imprimir' width=30 height=30>Imprimir Todo</a></center>";
}
/*else{
  echo "<center>";
  echo "<p class=Msg>No existen registros para esta busqueda</p>";
  echo "</center>";
}*/
mysql_free_result($consulta);
mysql_close();
?>
<!--<input type='hidden' name="abierta" value="<?echo $abierta;?>">
<input type='hidden' name="cerrada" value="<?echo $cerrada;?>">
<input type='hidden' name="fac1" value="<?echo $fac1;?>">
<input type='hidden' name="fac2" value="<?echo $fac2;?>">
<input type='hidden' name="fec1" value="<?echo $fec1;?>">
<input type='hidden' name="fec2" value="<?echo $fec2;?>">
<input type='hidden' name="fecini1" value="<?echo $fecini1;?>">
<input type='hidden' name="fecini2" value="<?echo $fecini2;?>">
<input type='hidden' name="identifica" value="<?echo $identifica;?>">
<input type='hidden' name="contrato" value="<?echo $contrato;?>">
<input type='hidden' name="anulada" value="<?echo $anulada;?>">
<input type='hidden' name="entidad" value="<?echo $entidad;?>">
<input type='hidden' name="servic" value="<?echo $servic;?>">
<input type='hidden' name="relac" value="<?echo $relac;?>">
<input type='hidden' name="nrocontr" value="<?echo $nrocontr;?>">-->
</form>
</body>
</html>

<?php
function traeusu($usua_){
    //echo "<br>".$usua_;
    base_general();
    $consultausu="SELECT nomb_usua FROM cut WHERE ide_usua='$usua_'";
    $consultausu=mysql_query($consultausu);
    $rowusu=mysql_fetch_array($consultausu);    
    return ($rowusu[nomb_usua]);
}
?>