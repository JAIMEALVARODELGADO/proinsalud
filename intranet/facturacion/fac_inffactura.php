<html>
<head>
<title>PROGRAMA DE FACTURACION</title>
<link rel="stylesheet" href="css/style.css" type="text/css" />
</head>
<SCRIPT LANGUAGE=JavaScript>
function imprimir(factu_){
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

function imprimirtodo(){
  document.form1.submit();
} 

function abrir(orden_) {
  document.form1.action='fac_inffactura.php';
  document.form1.target='';
  document.form1.orden.value=orden_;
  form1.submit();
}
</script>

<body>
<form name="form1" method="post" action="fac_previotot.php" target="new">
<table class="Tbl0"><tr><td class="Td0" align='center'>LISTADO DE FACTURAS</td></tr></table>
<?
set_time_limit(0);
include('php/conexiones_g.php');
include('php/funciones.php');
base_proinsalud();
$condicion="fa.esta_fac<>'3' AND ";
if($abierta=='on'){
    $condicion=$condicion."fa.esta_fac='1' AND ";
}
if($cerrada=='on'){
    $condicion=$condicion."fa.esta_fac='2' AND ";
}
if($abierta=='on' and $cerrada=='on'){
    $condicion="(fa.esta_fac='1' OR fa.esta_fac='2') AND ";    
}
if(!empty($fac1)){
  $condicion=$condicion."fa.nume_fac>='$fac1' AND ";}
if(!empty($pref_fac)){
  $condicion=$condicion."fa.pref_fac='$pref_fac' AND ";}
if(!empty($fac2)){
  $condicion=$condicion."fa.nume_fac<='$fac2' AND ";}  
if(!empty($fec1)){
  //$fec1=cambiafecha($fec1);
  $condicion=$condicion."fa.fcie_fac>='$fec1' AND ";}
if(!empty($fecini1)){
  //$fecini1=cambiafecha($fecini1);
  $condicion=$condicion."fa.feci_fac>='$fecini1' AND ";}  
if(!empty($fecini2)){
  //$fecini2=cambiafecha($fecini2);
  $condicion=$condicion."fa.feci_fac<='$fecini2' AND ";}
if(!empty($fecfin1)){
  //$fecfin1=cambiafecha($fecfin1);
  $condicion=$condicion."fa.fecf_fac>='$fecfin1' AND ";}
if(!empty($fecfin2)){
  //$fecfin2=cambiafecha($fecfin2);
  $condicion=$condicion."fa.fecf_fac<='$fecfin2' AND ";}
if(!empty($fec2)){
  //$fec2=cambiafecha($fec2);
  $condicion=$condicion."fa.fcie_fac<='$fec2' AND ";}  
if(!empty($identifica)){
  $condicion=$condicion."us.nrod_usu='$identifica' AND ";}
if(!empty($contrato)){
  $condicion=$condicion."con.codi_con='$contrato' AND ";}  
//echo "<br>".$anulada;
if($anulada=='on'){
  $condicion=$condicion."fa.anul_fac='S' AND ";}
if(!empty($entidad)){
  $condicion=$condicion."fa.enti_fac='$entidad' AND ";}
if(!empty($servic)){
  $condicion=$condicion."fa.area_fac='$servic' AND ";}
if(!empty($relac)){
  $condicion=$condicion."fa.rela_fac='$relac' AND ";}
if(!empty($nrocontr)){
  $condicion=$condicion."fa.iden_ctr='$nrocontr' AND ";}  
if(!empty($condicion)){
  $condicion=substr($condicion,0,(strlen($condicion)-5));
}
if(empty($orden)){
  $orden='nrod_usu';
}
//echo $condicion;
$consulta="SELECT fa.iden_fac,fa.pref_fac,fa.nume_fac,fa.fcie_fac,fa.feci_fac,fa.fecf_fac,fa.vnet_fac,fa.anul_fac,fa.rela_fac,fa.area_fac,fa.usua_fac,
 us.tdoc_usu,us.nrod_usu,CONCAT(us.pnom_usu,' ',us.snom_usu,' ',us.pape_usu,' ',us.sape_usu) as nombre,us.mate_usu,
 con.neps_con
 FROM encabezado_factura AS fa 
 INNER JOIN usuario AS us ON us.codi_usu=fa.codi_usu
 INNER JOIN contratacion AS ctr ON ctr.iden_ctr=fa.iden_ctr
 INNER JOIN contrato AS con ON con.codi_con=ctr.codi_con  
 WHERE $condicion ORDER BY $orden";
//echo $consulta;
$consulta=mysql_query($consulta);
if(mysql_num_rows($consulta)!=0) {
  echo "<table class='Tbl0' border='0'>";
  echo "<th class='Th0' width='5%'><a href='#' onclick=abrir('nume_fac')>Número</a></th>
        <th class='Th0' width='5%'><a href='#' onclick=abrir('rela_fac')>Cta Cob.</a></th>
        <th class='Th0' width='5%'><a href='#' onclick=abrir('feci_fac')>F. Inicio</a></th>
        <th class='Th0' width='5%'><a href='#' onclick=abrir('fecf_fac')>F. final</a></th>
        <th class='Th0' width='5%'><a href='#' onclick=abrir('fcie_fac')>F. Cierre</a></th>
        <th class='Th0' width='10%'><a href='#' onclick=abrir('mate_usu')>Mun.At</a></th>
	      <th class='Th0' width='10%'><a href='#' onclick=abrir('nrod_usu')>Identificación</a></th>
	      <th class='Th0' width='25%'><a href='#' onclick=abrir('nombre')>Nombre</a></th>
        <th class='Th0' width='10%'><a href='#' onclick=abrir('neps_con')>Contrato</a></th>
        <th class='Th0' width='15%'><a href='#' onclick=abrir('area_fac')>Servicio</a></th>
	      <th class='Th0' width='10%'><a href='#' onclick=abrir('vnet_fac')>Vr. Neto</a></th>
	      <th class='Th0' width='5%'><a href='#' onclick=abrir('anul_fac')>Est</a></th>
        <th class='Th0' width='5%'><a href='#' onclick=abrir('usua_fac')>Usuario</a></th>";
  $total=0;
  while($row=mysql_fetch_array($consulta)){
    echo "<tr>";
    echo "<td class='Td2' align='left'><a href='#' onclick='imprimir($row[iden_fac])'>$row[pref_fac] $row[nume_fac]</a></td>";
    echo "<td class='Td2' align='left'>$row[rela_fac]</td>";
    echo "<td class='Td2'>".cambiafechadmy($row[feci_fac])."</td>";
    echo "<td class='Td2'>".cambiafechadmy($row[fecf_fac])."</td>";    
    echo "<td class='Td2'>".cambiafechadmy($row[fcie_fac])."</td>";
    $consultamun="SELECT nomb_mun FROM municipio WHERE codi_mun='$row[mate_usu]'";
    //echo "<br>".$consultamun;
    $consultamun=mysql_query($consultamun);
    $rowmun=mysql_fetch_array($consultamun);
    echo "<td class='Td2'>$rowmun[nomb_mun]</td>";
    echo "<td class='Td2'>$row[nrod_usu]</td>";
    echo "<td class='Td2'>$row[nombre]</td>";
    echo "<td class='Td2'>$row[neps_con]</td>";
    $consultaser="SELECT nomb_des FROM destipos  WHERE codi_des='$row[area_fac]'";
    $consultaser=mysql_query($consultaser);
    $rowser=mysql_fetch_array($consultaser);
    //echo "<br>".$consultaser;
    echo "<td class='Td2'>$rowser[nomb_des]</td>";
    echo "<td class='Td5'>$row[vnet_fac]</td>";
	if($row[anul_fac]=='S'){
	  echo "<td class='Td2'><font color='#990000'>Anulada</td>";}
	else{
	  $total=$total+$row[vnet_fac];
	  echo "<td class='Td2'></td>";}
    $facturador=traeusu($row[usua_fac]);
    echo "<td class='Td2'>$facturador</td>";
    echo"</tr>";
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
  echo "<td class='Td5'><b>Total:</td>";
  echo "<td class='Td5'><b>$total</td>";
  echo "</tr>";
  echo "</table>";    
  echo "<center><a href='#' onclick='imprimirtodo()'><img src='icons/print.ico' border='0' alt='Imprimir' width=30 height=30>Imprimir Todo</a></center>";
}
else{
  echo "<center>";
  echo "<p class=Msg>No existen registros para esta busqueda</p>";
  echo "</center>";
}
mysql_free_result($consulta);
mysql_close();
?>
<input type='hidden' name="abierta" value="<?echo $abierta;?>">
<input type='hidden' name="cerrada" value="<?echo $cerrada;?>">
<input type='hidden' name="fac1" value="<?echo $fac1;?>">
<input type='hidden' name="pref_fac" value="<?echo $pref_fac;?>">
<input type='hidden' name="fac2" value="<?echo $fac2;?>">
<input type='hidden' name="fec1" value="<?echo $fec1;?>">
<input type='hidden' name="fec2" value="<?echo $fec2;?>">
<input type='hidden' name="fecini1" value="<?echo $fecini1;?>">
<input type='hidden' name="fecini2" value="<?echo $fecini2;?>">
<input type='hidden' name="fecfin1" value="<?echo $fecfin1;?>">
<input type='hidden' name="fecfin2" value="<?echo $fecfin2;?>">
<input type='hidden' name="identifica" value="<?echo $identifica;?>">
<input type='hidden' name="contrato" value="<?echo $contrato;?>">
<input type='hidden' name="anulada" value="<?echo $anulada;?>">
<input type='hidden' name="entidad" value="<?echo $entidad;?>">
<input type='hidden' name="servic" value="<?echo $servic;?>">
<input type='hidden' name="relac" value="<?echo $relac;?>">
<input type='hidden' name="nrocontr" value="<?echo $nrocontr;?>">
<input type='hidden' name='orden' value="<?echo $orden;?>">

</form>
</body>
</html>

<?php
function traeusu($codi_){
    $nomb_="";
    base_general();
    $consoper_="SELECT nomb_usua FROM cut WHERE ide_usua='$codi_'";
    $consoper_=mysql_query($consoper_);
    if(mysql_num_rows($consoper_)<>0){
         $row_=mysql_fetch_array($consoper_);
         $nomb_=$row_["nomb_usua"];
    }    
    base_proinsalud();
    return($nomb_);
}
?>