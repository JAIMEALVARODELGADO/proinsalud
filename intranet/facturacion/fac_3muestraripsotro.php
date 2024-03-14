<?
session_start();
set_time_limit(90);
?>
<html>
<head>
<title>PROGRAMA DE FACTURACIÓN</title>
<link rel="stylesheet" href="css/style.css" type="text/css" />
<script language='javascript'>
function activar(reg_){
var comando='';
  comando="form1.chk"+reg_+".checked";
  if(eval(comando)==true){
    comando="form1.numautorizacion"+reg_+".disabled=false";
    eval(comando);
    comando="form1.idmipres"+reg_+".disabled=false";
    eval(comando);
    comando="form1.fechasuministrotecnologia"+reg_+".disabled=false";
    eval(comando);
    comando="form1.tipoos"+reg_+".disabled=false";
    eval(comando);
    comando="form1.codtecnologia"+reg_+".disabled=false";
    eval(comando);
    comando="form1.nomtecnologia"+reg_+".disabled=false";
    eval(comando);
    comando="form1.conceptorecaudo"+reg_+".disabled=false";
    eval(comando);
    comando="form1.valorpagomoderador"+reg_+".disabled=false";
    eval(comando);
    comando="form1.numfevpagomoderador"+reg_+".disabled=false";
    eval(comando);
  }
  else{
    comando="form1.numautorizacion"+reg_+".disabled=true";
    eval(comando);
    comando="form1.idmipres"+reg_+".disabled=true";
    eval(comando);
    comando="form1.fechasuministrotecnologia"+reg_+".disabled=true";
    eval(comando);
    comando="form1.tipoos"+reg_+".disabled=true";
    eval(comando);
    comando="form1.codtecnologia"+reg_+".disabled=true";
    eval(comando);
    comando="form1.nomtecnologia"+reg_+".disabled=true";
    eval(comando);
    comando="form1.conceptorecaudo"+reg_+".disabled=true";
    eval(comando);
    comando="form1.valorpagomoderador"+reg_+".disabled=true";
    eval(comando);
    comando="form1.numfevpagomoderador"+reg_+".disabled=true";
    eval(comando);
  }
}

function ayuda(tipo_,codi_,c_){
var comando,url
comando="form1.tpser_fos"+c_+".value";
if(eval(comando)==1){
  tipo_='I';
  url="fac_ayuda.php?tipo_="+tipo_+"&codi_="+codi_;}
else{
  tipo_='P';
  url="fac_ayuda.php?tipo_="+tipo_+"&codi_="+codi_;}
  window.open(url,"ventana1","width=400,height=700,scrollbars=1,top=100,left=800");
}

function validar(cont_){
var i=0,comando='',error='';
  for(i=0;i<cont_;i++){    
    comando="form1.fechasuministrotecnologia"+i+".value"
    if(eval(comando)==''){error=error+"Fecha de suministro "+i+"\n";}
    comando="form1.tipoos"+i+".value"
    if(eval(comando)==''){error=error+"Tipo "+i+"\n";}
    comando="form1.codtecnologia"+i+".value"
    if(eval(comando)==''){error=error+"Código del servicio "+i+"\n";}
	comando="form1.nomtecnologia"+i+".value"
    if(eval(comando)==''){error=error+"Nombre del servicio "+i+"\n";}
    comando="form1.conceptorecaudo"+i+".value"
    if(eval(comando)==''){error=error+"Concepto del recaudo "+i+"\n";}
  }
  if(error!=''){
    alert("Para guardar debe complementar la siguiente información:\n\n"+error);
  }
  else{
    form1.submit();
  }
}

function activasel(var_,val_){
  var comando="form1."+var_+".value='"+val_+"'";
  eval(comando);
}

function eliminar(tipo_,reg_){
    var url_='';
    if(confirm("Desea eliminar este servicio?")){
        url_="fac_3borrarips.php?reg="+reg_+"&tipo="+tipo_;
        //alert(url_);
        window.open(url_,"fr02");
    }
}
</script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
</head>
<body>
<div>
  <ul class="menu">
    <li><a href="fac_3muestraripsusua.php">Usuario</a></li>
    <li><a href="fac_3muestraripscons.php">Consultas</a></li>
    <li><a href="fac_3muestraripsproc.php">Procedimientos</a></li>
    <li><a href="fac_3muestraripsmedi.php">Medicamentos</a></li>
    <li><a href="fac_3muestraripsotro.php" class="activo">Otros Servicios</a></li>
    <li><a href="fac_3muestraripsurge.php">Urgencias</a></li>    
    <li><a href="fac_3muestraripshosp.php">Hospitalización</a></li>
    <li><a href="fac_3muestraripsrnac.php">R. Nacidos</a></li>
    <li><a href="fac_3generaripsjson.php">Generar Json</a></li>
  </ul>
</div>  
<form name='form1' method="POST" action='fac_3guardaripsotr.php' target='fr02'>
<table class="Tbl0"><tr><td class="Td0" align='center'><h2>R I P S(2275) de Otros Servicios</h2></td></tr></table>
<?php
include('php/conexion.php');
include('php/funciones.php');
?>

<table class="Tbl0" border='0'>
  <th class="Th1" width='10%'><b>Factura Nro:</td>
  <th class="Th1" width='15%'><b>Tp. Identificación:</td>
  <th class="Th1" width='15%'><b>Número</td>
  <th class="Th1" width='50%'><b>Nombre</td>
  <th class="Th1" width='10%'><b>Vr.Factura</td>
<?
  $consulta="SELECT us.tdoc_usu,us.nrod_usu,us.pnom_usu,us.snom_usu,us.pape_usu,us.sape_usu,
  ef.vnet_fac
  FROM encabezado_factura AS ef
  INNER JOIN usuario AS us ON us.codi_usu=ef.codi_usu
  WHERE iden_fac=$giden_fac";
  $consulta=mysql_query($consulta);
  $row=mysql_fetch_array($consulta);
  $nombre=$row[pnom_usu]." ".$row[snom_usu]." ".$row[pape_usu]." ".$row[sape_usu];
  echo "<tr>";
  echo "<td class='Td2' align='left'><b>$gfactura</td>";
  echo "<td class='Td2' align='center'><b>$row[tdoc_usu]</td>";
  echo "<td class='Td2' align='center'><b>$row[nrod_usu]</td>";
  echo "<td class='Td2' align='center'><b>$nombre</td>";
  echo "<td class='Td2' align='center'><b>$row[vnet_fac]</td>";
  echo "</tr>";
?>    
</table>
<table class="Tbl0" border='1'>
  <th class="Th0"colspan='2'><b>Sel</td>
  <th class="Th0"><b>Autorización</td>
  <th class="Th0"><b>MIPRES</td>
  <th class="Th0"><b>Fecha Suministro</td>
  <th class="Th0"><b>Tipo</td>
  <th class="Th0"><b>Código</td>
  <th class="Th0"><b>Nombre</td>
  <th class="Th0"><b>Cantidad</td>
  <th class="Th0"><b>Valor Unitario</td>  
  <th class="Th0"><b>Valor Total</td>  
  <th class="Th0"><b>Concepto Recaudo</td>
  <th class="Th0"><b>Vr. Moderador</td>
  <th class="Th0"><b>FEV Moderador</td>
<?
  $cont=0;
  $total=0;
  $consultacon="SELECT otr.id_otros,otr.numautorizacion,otr.idmipres,otr.fechasuministrotecnologia,otr.tipoos,otr.codtecnologia,otr.nomtecnologia,otr.cantidados,otr.tipodocumentoidentificacion,otr.numdocumentoidentificacion,otr.vrunitos,otr.vrservicio,otr.conceptorecaudo,otr.valorpagomoderador,otr.numfevpagomoderador,otr.consecutivo,otr.iden_fac,otr.iden_dfa
  FROM nrotroservicios AS otr
  WHERE iden_fac='$giden_fac'";
  //echo $consultacon;
  $consultacon=mysql_query($consultacon);
  while($rowcon=mysql_fetch_array($consultacon)){
    $nomvar="id_otros".$cont;
	  echo "<input type='hidden' name='$nomvar' value='$rowcon[id_otros]'>";
    echo "<tr>";
	  $nomvar="chk".$cont;
    echo "<td class='Td2' align='left'><input type='checkbox' name='$nomvar' onclick='activar($cont)'></td>";
    echo "<td class='Td2' align='left'><a href='#' onclick=eliminar('O','$rowcon[id_otros]') title='Eliminar Registro'><img src='icons/feed_delete.png' width='15' height='15'></a></td>";
	
    $nomvar="numautorizacion".$cont;
    echo "<td class='Td2' align='center'><input type='text' name='$nomvar' size='30' maxlength='30' value='$rowcon[numautorizacion]' disabled></td>";

    $nomvar="idmipres".$cont;
    echo "<td class='Td2' align='center'><input type='text' name='$nomvar' size='15' maxlength='15' value='$rowcon[idmipres]' disabled></td>";
    
    $nomvar="fechasuministrotecnologia".$cont;
    echo "<td class='Td2' align='center'><input type='text' name='$nomvar' size='16' maxlength='16' value='$rowcon[fechasuministrotecnologia]' disabled></td>";

    $consultades=mysql_query("SELECT valo_des,nomb_des FROM destipos WHERE codt_des='H8'");
    $nomvar="tipoos".$cont;
    echo "<td class='Td2' align='center'><select name='$nomvar' disabled>";
    while($rowdes=mysql_fetch_array($consultades)){
        echo "<option value='$rowdes[valo_des]'>$rowdes[valo_des] ".substr($rowdes[nomb_des],0,40);
    }
    echo "</select>";
    echo "</td>";
    ?>
        <script language='javascript'>activasel('<?echo $nomvar;?>','<?echo $rowcon[tipoos];?>');</script>
    <?php
    
	  $nomvar="codtecnologia".$cont;
	  echo "<td class='Td2' align='center'><input type='text' name='$nomvar' size='20' maxlength='20' value='$rowcon[codtecnologia]' disabled><a href='#' onclick='ayuda(\"M\",\"$rowcon[cods_fos]\",\"$cont\")'><img src='icons/feed_magnify.png' width='15' height='15'></a></td>";

    $nomvar="nomtecnologia".$cont;
    echo "<td class='Td2' align='center'><input type='text' name='$nomvar' size='60' maxlength='60' value='$rowcon[nomtecnologia]' disabled></td>";

    $nomvar="cantidados".$cont;
    echo "<td class='Td2' align='center'><input type='text' name='$nomvar' size='5' maxlength='5' value='$rowcon[cantidados]' disabled></td>";
        
    $nomvar="vrunitos".$cont;
    echo "<td class='Td2' align='right'><input type='text' name='$nomvar' size='15' maxlength='15' value='".number_format($rowcon[vrunitos])."' disabled></td>";

	  $nomvar="vrservicio".$cont;
	  echo "<td class='Td2' align='right'><input type='text' name='$nomvar' size='15' maxlength='15' value='".number_format($rowcon[vrservicio])."' disabled></td>";
    
    $consultades=mysql_query("SELECT valo_des,nomb_des FROM destipos WHERE codt_des='H1'");
    $nomvar="conceptorecaudo".$cont;
    echo "<td class='Td2' align='center'><select name='$nomvar' disabled>";
    while($rowdes=mysql_fetch_array($consultades)){
        echo "<option value='$rowdes[valo_des]'>$rowdes[valo_des] ".substr($rowdes[nomb_des],0,40);
    }
    echo "</select>";
    echo "</td>";
    ?>
        <script language='javascript'>activasel('<?echo $nomvar;?>','<?echo $rowcon[conceptorecaudo];?>');</script>
    <?php

    $nomvar="valorpagomoderador".$cont;
    echo "<td class='Td2' align='right'><input type='text' name='$nomvar' size='10' maxlength='10' value='".number_format($rowcon[valorpagomoderador])."' disabled></td>";
    
    $nomvar="numfevpagomoderador".$cont;
    echo "<td class='Td2' align='center'><input type='text' name='$nomvar' size='15' maxlength='20' value='$rowcon[numfevpagomoderador]' disabled></td>";

    echo "</tr>";
	  $total=$total+$rowcon[vrservicio];
	  $cont++;
  }
echo "</tr>";
echo "<td class='Td2' align='right' colspan=10><b>Total </td>";
echo "<td class='Td2' align='right'><b>".number_format($total)."</td>";
echo "</tr>";
mysql_free_result($consulta);
mysql_free_result($consultacon);
mysql_close();
?>    
</table>
<br><br>
<div class='Td6'>
  <center><a href='#' onclick='validar(<?echo $cont;?>)'><img src='icons/feed_disk.png' width='20' height='20'>Guardar</a></center>
</div>
<input type='hidden' name='cont' value='<?echo $cont;?>'>
</form>
</body>
</html>
