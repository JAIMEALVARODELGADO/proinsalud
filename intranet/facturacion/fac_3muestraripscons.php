<?php
session_start();
set_time_limit(100);
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
    comando="form1.fechainicioatencion"+reg_+".disabled=false";
	  eval(comando);
    comando="form1.numautorizacion"+reg_+".disabled=false";
    eval(comando);
    comando="form1.codconsulta"+reg_+".disabled=false";
    eval(comando);
    comando="form1.modalidadgruposervicio"+reg_+".disabled=false";
    eval(comando);
    comando="form1.gruposervicios"+reg_+".disabled=false";
    eval(comando);
    comando="form1.codservicio"+reg_+".disabled=false";
    eval(comando);
    comando="form1.finalidadtecnologia"+reg_+".disabled=false";
    eval(comando);
    comando="form1.causamotivoatencion"+reg_+".disabled=false";
    eval(comando);
    comando="form1.coddiagnosticoprincipal"+reg_+".disabled=false";
    eval(comando);
    comando="form1.coddiagnosticorelacinado1"+reg_+".disabled=false";
    eval(comando);
    comando="form1.coddiagnosticorelacinado2"+reg_+".disabled=false";
    eval(comando);
    comando="form1.coddiagnosticorelacinado3"+reg_+".disabled=false";
    eval(comando);
    comando="form1.tipodiagnosticoprincipal"+reg_+".disabled=false";
    eval(comando);
    comando="form1.conceptorecaudo"+reg_+".disabled=false";
    eval(comando);
    comando="form1.valorpagomoderador"+reg_+".disabled=false";
    eval(comando);
    comando="form1.numfevpagomoderador"+reg_+".disabled=false";
    eval(comando);
  }
  else{
    comando="form1.fechainicioatencion"+reg_+".disabled=true";
	  eval(comando);
	  comando="form1.numautorizacion"+reg_+".disabled=true";
    eval(comando);
    comando="form1.codconsulta"+reg_+".disabled=true";
    eval(comando);
    comando="form1.modalidadgruposervicio"+reg_+".disabled=true";
    eval(comando);
    comando="form1.gruposervicios"+reg_+".disabled=true";
    eval(comando);
    comando="form1.codservicio"+reg_+".disabled=true";
    eval(comando);
    comando="form1.finalidadtecnologia"+reg_+".disabled=true";
    eval(comando);
    comando="form1.causamotivoatencion"+reg_+".disabled=true";
    eval(comando);
    comando="form1.coddiagnosticoprincipal"+reg_+".disabled=true";
    eval(comando);
    comando="form1.coddiagnosticorelacinado1"+reg_+".disabled=true";
    eval(comando);

    comando="form1.coddiagnosticorelacinado1"+reg_+".disabled=true";
    eval(comando);
    comando="form1.coddiagnosticorelacinado2"+reg_+".disabled=true";
    eval(comando);
    comando="form1.coddiagnosticorelacinado3"+reg_+".disabled=true";
    eval(comando);
    comando="form1.tipodiagnosticoprincipal"+reg_+".disabled=true";
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

function activasel(var_,val_){
  var comando="form1."+var_+".value='"+val_+"'";
  eval(comando);
}

function validar(cont_){
var i=0,comando='',error='';
  for(i=0;i<cont_;i++){
    comando="form1.fechainicioatencion"+i+".value"
    if(eval(comando)==''){error=error+"Fecha de la consulta "+i+"\n"}

	  comando="form1.codconsulta"+i+".value"
    if(eval(comando)==''){error=error+"Código de la consulta "+i+"\n"}

    comando="form1.modalidadgruposervicio"+i+".value"
    if(eval(comando)==''){error=error+"Modalidad Atención "+i+"\n"}

    comando="form1.gruposervicios"+i+".value"
    if(eval(comando)==''){error=error+"Servicios "+i+"\n"}
    
    comando="form1.finalidadtecnologia"+i+".value"
    if(eval(comando)==''){error=error+"Finalidad "+i+"\n"}

    comando="form1.causamotivoatencion"+i+".value"
    if(eval(comando)==''){error=error+"Causa Externa "+i+"\n"}

	  comando="form1.coddiagnosticoprincipal"+i+".value"
    if(eval(comando)==''){error=error+"Diagnostico principal "+i+"\n"}

    comando="form1.tipodiagnosticoprincipal"+i+".value"
    if(eval(comando)==''){error=error+"Tipo de diagnostico principal "+i+"\n"}

    comando="form1.conceptorecaudo"+i+".value"
    if(eval(comando)==''){error=error+"Concepto Recaudo "+i+"\n"}

  }
  if(error!=''){
    alert("Para guardar debe complementar la siguiente información:\n\n"+error);
  }
  else{
    form1.submit();
  }
}
function eliminar(tipo_,reg_){
    var url_='';
    if(confirm("Desea eliminar esta consulta?")){
        url_="fac_3borrarips.php?reg="+reg_+"&tipo="+tipo_;
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
    <li><a href="fac_3muestraripscons.php" class="activo">Consultas</a></li>
    <li><a href="fac_3muestraripsproc.php">Procedimientos</a></li>
    <li><a href="fac_3muestraripsmedi.php">Medicamentos</a></li>
    <li><a href="fac_3muestraripsotro.php">Otros Servicios</a></li>
    <li><a href="fac_3muestraripsurge.php">Urgencias</a></li>    
    <li><a href="fac_3muestraripshosp.php">Hospitalización</a></li>
    <li><a href="fac_3muestraripsrnac.php">R. Nacidos</a></li>
    <li><a href="fac_3generaripsjson.php">Generar Json</a></li>
  </ul>
</div>  
  

<form name='form1' method="POST" action='fac_3guardaripscon.php' target='fr02'>
<table class="Tbl0"><tr><td class="Td0" align='center'><h2>R I P S(2275) de Consulta</h2></td></tr></table>
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
  //echo "<br><br>".$consulta;
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
  <th class="Th0" colspan='2'><b>Sel</td>
  <th class="Th0"><b>Fecha Inicio Atención</td>
  <th class="Th0"><b>Autorización</td>
  <th class="Th0"><b>Código</td>
  <th class="Th0"><b>Modalidad Atención</td>
  <th class="Th0"><b>Grupo de Servicios</td>
  <th class="Th0"><b>Servicio</td>
  <th class="Th0"><b>Finalidad</td>
  <th class="Th0"><b>Causa Externa</td>
  <th class="Th0"><b>Diagnosticos</td>
  <th class="Th0"><b>Tipo Dx Pr</td>  
  <th class="Th0"><b>Valor</td>
  <th class="Th0"><b>Concepto Recaudo</td>
  <th class="Th0"><b>Vr. Moderador</td>
  <th class="Th0"><b>FEV Moderador</td>
<?php
  $cont=0;
  $total=0;  
  $consultacon="SELECT con.id_consulta,con.fechainicioatencion,con.numautorizacion,con.codconsulta,con.modalidadgruposervicio,con.gruposervicios,con.codservicio,con.finalidadtecnologia,con.causamotivoatencion,con.coddiagnosticoprincipal,con.coddiagnosticorelacinado1,con.coddiagnosticorelacinado2,con.coddiagnosticorelacinado3,con.tipodiagnosticoprincipal,con.tipodocumentoidentificacion,con.numdocumentoidentificacion,con.vrservicio,con.conceptorecaudo,con.valorpagomoderador,con.numfevpagomoderador,con.consecutivo,con.iden_fac,con.iden_dfa 
  FROM nrconsulta AS con
  WHERE iden_fac='$giden_fac'";
  //echo $consultacon;
  $consultacon=mysql_query($consultacon);
  while($rowcon=mysql_fetch_array($consultacon)){    
    $nomvar="id_consulta".$cont;
    echo "<input type='hidden' name='$nomvar' value='$rowcon[id_consulta]'>";
    echo "<tr>";
    $nomvar="chk".$cont;
    echo "<td class='Td2' align='left'><input type='checkbox' name='$nomvar' onclick='activar($cont)'></td>";
    echo "<td class='Td2' align='left'><a href='#' onclick=eliminar('C','$rowcon[id_consulta]') title='Eliminar Registro'><img src='icons/feed_delete.png' width='15' height='15'></a></td>";
    
    $nomvar="fechainicioatencion".$cont;
    echo "<td class='Td2' align='center'><input type='text' name='$nomvar' size='10' maxlength='10' value='$rowcon[fechainicioatencion]' disabled></td>";
    
    $nomvar="numautorizacion".$cont;
    echo "<td class='Td2' align='center'><input type='text' name='$nomvar' size='15' maxlength='15' value='$rowcon[numautorizacion]' disabled></td>";
    
    $nomvar="codconsulta".$cont;
    echo "<td class='Td2' align='center'><input type='text' name='$nomvar' size='8' maxlength='8' value='$rowcon[codconsulta]' disabled><a href='#'  onclick='ayuda(\"P\",\"$rowcon[codconsulta]\")'><img src='icons/feed_magnify.png' width='15' height='15'></a></td>";

    $consultades=mysql_query("SELECT valo_des,nomb_des FROM destipos WHERE codt_des='G4'");
    $nomvar="modalidadgruposervicio".$cont;
    echo "<td class='Td2' align='center'><select name='$nomvar' disabled>";
    while($rowdes=mysql_fetch_array($consultades)){
        echo "<option value='$rowdes[valo_des]'>$rowdes[valo_des] ".substr($rowdes[nomb_des],0,40);
    }
    echo "</select>";
    echo "</td>";
    ?>
    <script language='javascript'>activasel('<?echo $nomvar;?>','<?echo $rowcon[modalidadgruposervicio];?>');</script>
    <?php

    $consultades=mysql_query("SELECT valo_des,nomb_des FROM destipos WHERE codt_des='G5'");
    $nomvar="gruposervicios".$cont;
    echo "<td class='Td2' align='center'><select name='$nomvar' disabled>";
    while($rowdes=mysql_fetch_array($consultades)){
        echo "<option value='$rowdes[valo_des]'>$rowdes[valo_des] ".substr($rowdes[nomb_des],0,40);
    }
    echo "</select>";
    echo "</td>";
    ?>
    <script language='javascript'>activasel('<?echo $nomvar;?>','<?echo $rowcon[gruposervicios];?>');</script>
    <?php

    $consultades=mysql_query("SELECT valo_des,nomb_des FROM destipos WHERE codt_des='G6'");
    $nomvar="codservicio".$cont;
    echo "<td class='Td2' align='center'><select name='$nomvar' disabled>";
    while($rowdes=mysql_fetch_array($consultades)){
        echo "<option value='$rowdes[valo_des]'>$rowdes[valo_des] ".substr($rowdes[nomb_des],0,40);
    }
    echo "</select>";
    echo "</td>";
    ?>
    <script language='javascript'>activasel('<?echo $nomvar;?>','<?echo $rowcon[codservicio];?>');</script>
    <?php

    $consultades=mysql_query("SELECT valo_des,nomb_des FROM destipos WHERE codt_des='G7'");
    $nomvar="finalidadtecnologia".$cont;
    echo "<td class='Td2' align='center'><select name='$nomvar' disabled>";
    while($rowdes=mysql_fetch_array($consultades)){
        echo "<option value='$rowdes[valo_des]'>$rowdes[valo_des] ".substr($rowdes[nomb_des],0,40);
    }
    echo "</select>";
    echo "</td>";
    ?>
    <script language='javascript'>activasel('<?echo $nomvar;?>','<?echo $rowcon[finalidadtecnologia];?>');</script>
    <?php

    $consultades=mysql_query("SELECT valo_des,nomb_des FROM destipos WHERE codt_des='G8'");
    $nomvar="causamotivoatencion".$cont;
    echo "<td class='Td2' align='center'><select name='$nomvar' disabled>";
    while($rowdes=mysql_fetch_array($consultades)){
        echo "<option value='$rowdes[valo_des]'>$rowdes[valo_des] ".substr($rowdes[nomb_des],0,20);
    }
    echo "</select>";
    echo "</td>";
    ?>
    <script language='javascript'>activasel('<?echo $nomvar;?>','<?echo $rowcon[causamotivoatencion];?>');</script>
    <?php

    $nomvar="coddiagnosticoprincipal".$cont;
    echo "<td class='Td2' align='center'><b>Principal <input type='text' name='$nomvar' size='4' maxlength='4' value='$rowcon[coddiagnosticoprincipal]' disabled><a href='#'  onclick='ayuda(\"D\",\"$rowcon[coddiagnosticoprincipal]\")'><img src='icons/feed_magnify.png' width='15' height='15'></a>";
    $nomvar="coddiagnosticorelacinado1".$cont;
    echo "<br>Rel.1<input type='text' name='$nomvar' size='4' maxlength='4' value='$rowcon[coddiagnosticorelacinado1]' disabled>";
    $nomvar="coddiagnosticorelacinado2".$cont;
    echo "<br>Rel.2<input type='text' name='$nomvar' size='4' maxlength='4' value='$rowcon[coddiagnosticorelacinado2]' disabled>";
    $nomvar="coddiagnosticorelacinado3".$cont;
    echo "<br>Rel.3<input type='text' name='$nomvar' size='4' maxlength='4' value='$rowcon[coddiagnosticorelacinado3]' disabled>";
    echo"</td>";

    $consultades=mysql_query("SELECT valo_des,nomb_des FROM destipos WHERE codt_des='G9'");
    $nomvar="tipodiagnosticoprincipal".$cont;
    echo "<td class='Td2' align='center'><select name='$nomvar' disabled>";
    while($rowdes=mysql_fetch_array($consultades)){
        echo "<option value='$rowdes[valo_des]'>$rowdes[valo_des] ".substr($rowdes[nomb_des],0,20);
    }
    echo "</select>";
    echo "</td>";
    ?>
    <script language='javascript'>activasel('<?echo $nomvar;?>','<?echo $rowcon[tipodiagnosticoprincipal];?>');</script>
    <?php    

    $nomvar="vrservicio".$cont;
    echo "<td class='Td2' align='right'><input type='text' name='$nomvar' size='7' maxlength='7' value='".number_format($rowcon[vrservicio])."' disabled></td>";

    $consultades=mysql_query("SELECT valo_des,nomb_des FROM destipos WHERE codt_des='H1'");
    $nomvar="conceptorecaudo".$cont;
    echo "<td class='Td2' align='center'><select name='$nomvar' disabled>";
    while($rowdes=mysql_fetch_array($consultades)){
        echo "<option value='$rowdes[valo_des]'>$rowdes[valo_des] ".substr($rowdes[nomb_des],0,20);
    }
    echo "</select>";
    echo "</td>";
    ?>
    <script language='javascript'>activasel('<?echo $nomvar;?>','<?echo $rowcon[conceptorecaudo];?>');</script>
    <?php

    $nomvar="valorpagomoderador".$cont;
    echo "<td class='Td2' align='right'><input type='text' name='$nomvar' size='7' maxlength='7' value='".number_format($rowcon[valorpagomoderador])."' disabled></td>";

    $nomvar="numfevpagomoderador".$cont;
    echo "<td class='Td2' align='center'><input type='text' name='$nomvar' size='15' maxlength='15' value='$rowcon[numfevpagomoderador]' disabled></td>";

    echo "</tr>";
    $total=$total+$rowcon[vrservicio];
    $cont++;
    mysql_free_result($consultades);
  }
echo "</tr>";

echo "<td class='Td2' align='right' colspan=12><b>Total Consultas</td>";
echo "<td class='Td2' align='right'><b>".number_format($total)."</td>";
echo "</tr>";
mysql_free_result($consulta);
mysql_free_result($consultacon);
mysql_close();
?>    
</table>
<br><br>
<center><a href='#' onclick='validar(<?echo $cont;?>)'><img src='icons/feed_disk.png' width='20' height='20'>Guardar</a></center>
<input type='hidden' name='cont' value='<?echo $cont;?>'>
</form>
</body>
</html>
