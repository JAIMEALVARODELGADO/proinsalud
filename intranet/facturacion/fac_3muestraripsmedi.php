<?
session_start();
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
    comando="form1.fechadispensadmon"+reg_+".disabled=false";
    eval(comando);
    comando="form1.coddiagnosticoprincipal"+reg_+".disabled=false";
    eval(comando);
    comando="form1.coddiagnosticorelacionado"+reg_+".disabled=false";
    eval(comando);
    comando="form1.tipomedicamento"+reg_+".disabled=false";
    eval(comando);
    comando="form1.codtecnologia"+reg_+".disabled=false";
    eval(comando);
    comando="form1.nomtecnologia"+reg_+".disabled=false";
    eval(comando);
    comando="form1.concentracion"+reg_+".disabled=false";
    eval(comando);
    comando="form1.unidadmedida"+reg_+".disabled=false";
    eval(comando);
    comando="form1.formafarmaceutica"+reg_+".disabled=false";
    eval(comando);
    comando="form1.unidadmindispensa"+reg_+".disabled=false";
    eval(comando);
    comando="form1.diastratamiento"+reg_+".disabled=false";
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
    comando="form1.fechadispensadmon"+reg_+".disabled=true";
    eval(comando);
    comando="form1.coddiagnosticoprincipal"+reg_+".disabled=true";
    eval(comando);
    comando="form1.coddiagnosticorelacionado"+reg_+".disabled=true";
    eval(comando);
    comando="form1.tipomedicamento"+reg_+".disabled=true";
    eval(comando);
    comando="form1.codtecnologia"+reg_+".disabled=true";
    eval(comando);
    comando="form1.nomtecnologia"+reg_+".disabled=true";
    eval(comando);
    comando="form1.concentracion"+reg_+".disabled=true";
    eval(comando);
    comando="form1.unidadmedida"+reg_+".disabled=true";
    eval(comando);
    comando="form1.formafarmaceutica"+reg_+".disabled=true";
    eval(comando);
    comando="form1.unidadmindispensa"+reg_+".disabled=true";
    eval(comando);
    comando="form1.diastratamiento"+reg_+".disabled=true";
    eval(comando);
    comando="form1.conceptorecaudo"+reg_+".disabled=true";
    eval(comando);
    comando="form1.valorpagomoderador"+reg_+".disabled=true";
    eval(comando);
    comando="form1.numfevpagomoderador"+reg_+".disabled=true";
    eval(comando);
  }
}

function ayuda(tipo_,codi_){
var url="fac_ayuda.php?tipo_="+tipo_+"&codi_="+codi_;
  window.open(url,"ventana1","width=400,height=700,scrollbars=1,top=100,left=800") 
}

function validar(cont_){
var i=0,comando='',error='';
  for(i=0;i<cont_;i++){
    comando="form1.fechadispensadmon"+i+".value"
    if(eval(comando)==''){error=error+"Fecha de dispensación "+i+"\n";}

    comando="form1.coddiagnosticoprincipal"+i+".value"
    if(eval(comando)==''){error=error+"Diagnóstico principal "+i+"\n";}

    comando="form1.tipomedicamento"+i+".value"
    if(eval(comando)==''){error=error+"Tipo de medicamento "+i+"\n";}
    
	comando="form1.codtecnologia"+i+".value"
    if(eval(comando)==''){error=error+"Código del medicamento "+i+"\n";}

    comando="form1.unidadmindispensa"+i+".value"
    if(eval(comando)==''){error=error+"Unidad dispensada "+i+"\n";}

    comando="form1.diastratamiento"+i+".value"
    if(eval(comando)==''){error=error+"Días de tratamiento "+i+"\n";}
    
    comando="form1.conceptorecaudo"+i+".value"
    if(eval(comando)==''){error=error+"Concepto recaudo "+i+"\n";}
	
  }
  if(error!=''){
    alert("Para guardar debe complementar la siguiente informaci�n:\n\n"+error);
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
    if(confirm("Desea eliminar este medicamento?")){
        url_="fac_3borrarips.php?reg="+reg_+"&tipo="+tipo_;
        //alert(url_);
        window.open(url_,"fr02");
    }
}
</script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
</head>
<div>
  <ul class="menu">
    <li><a href="fac_3muestraripsusua.php">Usuario</a></li>
    <li><a href="fac_3muestraripscons.php">Consultas</a></li>
    <li><a href="fac_3muestraripsproc.php">Procedimientos</a></li>
    <li><a href="fac_3muestraripsmedi.php" class="activo">Medicamentos</a></li>
    <li><a href="fac_3muestraripsotro.php">Otros Servicios</a></li>
    <li><a href="fac_3muestraripsurge.php">Urgencias</a></li>    
    <li><a href="fac_3muestraripshosp.php">Hospitalización</a></li>
    <li><a href="fac_3muestraripsrnac.php">R. Nacidos</a></li>
    <li><a href="fac_3generaripsjson.php">Generar Json</a></li>
  </ul>
</div>  
<body>
<form name='form1' method="POST" action='fac_3guardaripsmed.php' target='fr02'>
<table class="Tbl0"><tr><td class="Td0" align='center'><h2>R I P S(2275) de Medicamentos</h2></td></tr></table>
<?
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
  $consulta=mysql_query("SELECT us.tdoc_usu,us.nrod_usu,us.pnom_usu,us.snom_usu,us.pape_usu,us.sape_usu,
  ef.vnet_fac
  FROM encabezado_factura AS ef
  INNER JOIN usuario AS us ON us.codi_usu=ef.codi_usu
  WHERE iden_fac=$giden_fac");
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
  <th class="Th0" colspan='2'><b>Sel</td>
  <th class="Th0"><b>Autorización</td>
  <th class="Th0"><b>MIPRES</td>
  <th class="Th0"><b>Fecha disensación</td>
  <th class="Th0"><b>Diagnósticos</td>
  <th class="Th0"><b>Tipo de medicamento</td>
  <th class="Th0"><b>Código IUM</td>  
  <th class="Th0"><b>Nombre</td>
  <th class="Th0"><b>Concentración</td>
  <th class="Th0"><b>Unidad de medida</td>
  <th class="Th0"><b>Forma farmacéutica</td>
  <th class="Th0"><b>Unidad de medida dispensada</td>
  <th class="Th0"><b>Cantidad</td>
  <th class="Th0"><b>Días tratamiento</td>
  <th class="Th0"><b>Valor unitario</td>
  <th class="Th0"><b>Valor Total</td>
  <th class="Th0"><b>Concepto Recaudo</td>
  <th class="Th0"><b>Vr. Moderador</td>
  <th class="Th0"><b>FEV Moderador</td>
<?
  $cont=0;
  $total=0;
  $consultacon="SELECT med.id_medicamento,med.numautorizacion,med.idmipres,med.fechadispensadmon,med.coddiagnosticoprincipal,med.coddiagnosticorelacionado,med.tipomedicamento,med.codtecnologia,med.nomtecnologia,med.concentracion,med.unidadmedida,med.formafarmaceutica,med.unidadmindispensa,med.cantidad,med.diastratamiento,med.tipodocumentoidentificacion,med.numdocumentoidentificacion,med.vrunitmedicamento,med.vrservicio,med.conceptorecaudo,med.valorpagomoderador,med.numfevpagomoderador,med.consecutivo,med.iden_fac,med.iden_dfa
  FROM nrmedicamento AS med
  WHERE iden_fac='$giden_fac'";
  //echo $consultacon;
  $consultacon=mysql_query($consultacon);
  while($rowcon=mysql_fetch_array($consultacon)){
    $nomvar="id_medicamento".$cont;
	  echo "<input type='hidden' name='$nomvar' value='$rowcon[id_medicamento]'>";
    echo "<tr>";
	  $nomvar="chk".$cont;
    echo "<td class='Td2' align='left'><input type='checkbox' name='$nomvar' onclick='activar($cont)'></td>";
    echo "<td class='Td2' align='left'><a href='#' onclick=eliminar('M','$rowcon[id_medicamento]') title='Eliminar Registro'><img src='icons/feed_delete.png' width='15' height='15'></a></td>";
	
    $nomvar="numautorizacion".$cont;
    echo "<td class='Td2' align='center'><input type='text' name='$nomvar' size='30' maxlength='30' value='$rowcon[numautorizacion]' disabled></td>";

    $nomvar="idmipres".$cont;
    echo "<td class='Td2' align='center'><input type='text' name='$nomvar' size='15' maxlength='15' value='$rowcon[idmipres]' disabled></td>";    

    $nomvar="fechadispensadmon".$cont;
    echo "<td class='Td2' align='center'><input type='text' name='$nomvar' size='16' maxlength='16' value='$rowcon[fechadispensadmon]' disabled></td>";
    
    $nomvar="coddiagnosticoprincipal".$cont;
    echo "<td class='Td2' align='center'><b>Principal <input type='text' name='$nomvar' size='25' maxlength='25' value='$rowcon[coddiagnosticoprincipal]' disabled><a href='#'  onclick='ayuda(\"D\",\"$rowcon[coddiagnosticoprincipal]\")'><img src='icons/feed_magnify.png' width='15' height='15'></a>";	

    $nomvar="coddiagnosticorelacionado".$cont;
    echo "<br>Relacionado <input type='text' name='$nomvar' size='25' maxlength='25' value='$rowcon[coddiagnosticorelacionado]' disabled>";
        
    $consultades=mysql_query("SELECT valo_des,nomb_des FROM destipos WHERE codt_des='H4'");
    $nomvar="tipomedicamento".$cont;
    echo "<td class='Td2' align='center'><select name='$nomvar' disabled>";
    while($rowdes=mysql_fetch_array($consultades)){
        echo "<option value='$rowdes[valo_des]'>$rowdes[valo_des] ".substr($rowdes[nomb_des],0,40);
    }
    echo "</select>";
    echo "</td>";
    ?>
        <script language='javascript'>activasel('<?echo $nomvar;?>','<?echo $rowcon[tipomedicamento];?>');</script>
    <?php

	  $nomvar="codtecnologia".$cont;
    echo "<td class='Td2' align='center'><input type='text' name='$nomvar' size='20' maxlength='20' value='$rowcon[codtecnologia]' disabled><!--<a href='#'  onclick='ayuda(\"M\",\"$rowcon[codtecnologia]\")'><img src='icons/feed_magnify.png' width='15' height='15'></a>--></td>";
	
	  $nomvar="nomtecnologia".$cont;
    echo "<td class='Td2' align='center'><input type='text' name='$nomvar' size='30' maxlength='30' value='$rowcon[nomtecnologia]' disabled></td>";

    $nomvar="concentracion".$cont;
    echo "<td class='Td2' align='center'><input type='text' name='$nomvar' size='3' maxlength='3' value='$rowcon[concentracion]' disabled></td>";

    $consultades=mysql_query("SELECT valo_des,nomb_des FROM destipos WHERE codt_des='H5'");
    $nomvar="unidadmedida".$cont;
    echo "<td class='Td2' align='center'><select name='$nomvar' disabled>";
    while($rowdes=mysql_fetch_array($consultades)){
        echo "<option value='$rowdes[valo_des]'>$rowdes[valo_des] ".substr($rowdes[nomb_des],0,40);
    }
    echo "</select>";
    echo "</td>";
    ?>
        <script language='javascript'>activasel('<?echo $nomvar;?>','<?echo $rowcon[unidadmedida];?>');</script>
    <?php	
    
    $consultades=mysql_query("SELECT valo_des,nomb_des FROM destipos WHERE codt_des='H6'");
    $nomvar="formafarmaceutica".$cont;
    echo "<td class='Td2' align='center'><select name='$nomvar' disabled>";
    while($rowdes=mysql_fetch_array($consultades)){
        echo "<option value='$rowdes[valo_des]'>$rowdes[valo_des] ".substr($rowdes[nomb_des],0,40);
    }
    echo "</select>";
    echo "</td>";
    ?>
        <script language='javascript'>activasel('<?echo $nomvar;?>','<?echo $rowcon[formafarmaceutica];?>');</script>
    <?php

    $consultades=mysql_query("SELECT valo_des,nomb_des FROM destipos WHERE codt_des='H7'");
    $nomvar="unidadmindispensa".$cont;
    echo "<td class='Td2' align='center'><select name='$nomvar' disabled>";
    while($rowdes=mysql_fetch_array($consultades)){
        echo "<option value='$rowdes[valo_des]'>$rowdes[valo_des] ".substr($rowdes[nomb_des],0,40);
    }
    echo "</select>";
    echo "</td>";
    ?>
        <script language='javascript'>activasel('<?echo $nomvar;?>','<?echo $rowcon[unidadmindispensa];?>');</script>
    <?php

    $nomvar="cantidad".$cont;
	  echo "<td class='Td2' align='center'><input type='text' name='$nomvar' size='10' maxlength='10' value='$rowcon[cantidad]' disabled></td>";
    
    $nomvar="diastratamiento".$cont;
	  echo "<td class='Td2' align='center'><input type='text' name='$nomvar' size='3' maxlength='3' value='$rowcon[diastratamiento]' disabled></td>";

    $nomvar="vrunitmedicamento".$cont;
	  echo "<td class='Td2' align='center'><input type='text' name='$nomvar' size='15' maxlength='20' value='$rowcon[vrunitmedicamento]' disabled></td>";

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
echo "<td class='Td2' align='right' colspan=16><b>Total </td>";
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
