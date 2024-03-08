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
    comando="form1.fechainicioatencion"+reg_+".disabled=false";
    eval(comando);
    comando="form1.causamotivoatencion"+reg_+".disabled=false";
    eval(comando);
    comando="form1.coddiagnosticoprincipal"+reg_+".disabled=false";
    eval(comando);
    comando="form1.coddiagnosticoprincipale"+reg_+".disabled=false";
    eval(comando);
    comando="form1.coddiagnosticorelacionadoe1"+reg_+".disabled=false";
    eval(comando);
    comando="form1.coddiagnosticorelacionadoe2"+reg_+".disabled=false";
    eval(comando);
    comando="form1.coddiagnosticorelacionadoe3"+reg_+".disabled=false";
    eval(comando);
    comando="form1.condiciondestinousuarioegreso"+reg_+".disabled=false";
    eval(comando);
    comando="form1.coddiagnosticocausamuerte"+reg_+".disabled=false";
    eval(comando);
    comando="form1.fechaegreso"+reg_+".disabled=false";
    eval(comando);
  }
  else{
    comando="form1.fechainicioatencion"+reg_+".disabled=true";
    eval(comando);
    comando="form1.horicausamotivoatencion_fur"+reg_+".disabled=true";
    eval(comando);
    comando="form1.coddiagnosticoprincipal"+reg_+".disabled=true";
    eval(comando);
    comando="form1.coddiagnosticoprincipale"+reg_+".disabled=true";
    eval(comando);
    comando="form1.coddiagnosticorelacionadoe1"+reg_+".disabled=true";
    eval(comando);
    comando="form1.coddiagnosticorelacionadoe2"+reg_+".disabled=true";
    eval(comando);
    comando="form1.coddiagnosticorelacionadoe3"+reg_+".disabled=true";
    eval(comando);
    comando="form1.condiciondestinousuarioegreso"+reg_+".disabled=true";
    eval(comando);
    comando="form1.coddiagnosticocausamuerte"+reg_+".disabled=true";
    eval(comando);
    comando="form1.fechaegreso"+reg_+".disabled=true";
    eval(comando);
  }
}

function validar(cont_){
var i=0,comando='',error='';
	for(i=0;i<cont_;i++){
		comando="form1.fechainicioatencion"+i+".value"
		if(eval(comando)==''){error=error+"Fecha de inicio atención "+i+"\n";}
		comando="form1.causamotivoatencion"+i+".value"
		if(eval(comando)==''){error=error+"Causa motivo de atención "+i+"\n";}
        comando="form1.coddiagnosticoprincipal"+i+".value"
		if(eval(comando)==''){error=error+"Diagnóstico de ingreso "+i+"\n";}
        comando="form1.coddiagnosticoprincipale"+i+".value"
		if(eval(comando)==''){error=error+"Diagnóstico de egreso "+i+"\n";}
        comando="form1.fechaegreso"+i+".value"
		if(eval(comando)==''){error=error+"Fecha de egreso "+i+"\n";}
	}
	if(error!=''){
		alert("Para guardar debe complementar la siguiente información:\n\n"+error);
	}
	else{
		form1.submit();
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
function eliminar(tipo_,reg_){
    var url_='';
    if(confirm("Desea eliminar la estancia?")){
        url_="fac_3borrarips.php?reg="+reg_+"&tipo="+tipo_;
        //alert(url_);
        window.open(url_,"fr02");
    }
}
</script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
</head>
<body>
<form name='form1' method="POST" action='fac_3guardaripsurg.php' target='fr02'>
<table class="Tbl0"><tr><td class="Td0" align='center'>R I P S(2275) de la factura <?echo $gfactura;?></td></tr></table>
<?
include('php/conexion.php');
include('php/funciones.php');
?>
<img src='icons/barra5.png' width='910' height='30' usemap="#actividades" border='0'/>
<map name="actividades">
<area shape="rect" coords="0,0,125,30" href="fac_3muestraripscons.php" alt="Consultas" />
<area shape="rect" coords="130,0,260,30" href="fac_3muestraripsproc.php" alt="Procedimientos" />
<area shape="rect" coords="265,0,380,30" href="fac_3muestraripsmedi.php" alt="Medicamentos" />
<area shape="rect" coords="390,0,515,30" href="fac_3muestraripsotro.php" alt="Otros Servicios" />
<!--<area shape="rect" coords="520,0,645,30" href="fac_4hemuestraurge.php" alt="Est. Urgencias" />-->
<area shape="rect" coords="655,0,800,30" href="fac_4hemuestrahosp.php" alt="Est. Hospitalizaci�n" />
<area shape="rect" coords="800,0,910,30" href="fac_4hemuestrarnac.php" alt="Reci�n Nacidos" />
</map>
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
  <th class="Th0"><b>Fecha inicio atencion</td>
  <th class="Th0"><b>Causa motivo atencion</td>
  <th class="Th0"><b>Diagnósticos</td>
  <th class="Th0"><b>Condición y destino</td>
  <th class="Th0"><b>Fecha de egreso</td>
  
<?
  $cont=0;
  $consultacon="SELECT urg.id_urgencias,urg.fechainicioatencion,urg.causamotivoatencion,urg.coddiagnosticoprincipal,urg.coddiagnosticoprincipale,urg.coddiagnosticorelacionadoe1,urg.coddiagnosticorelacionadoe2,urg.coddiagnosticorelacionadoe3,urg.condiciondestinousuarioegreso,urg.coddiagnosticocausamuerte,urg.fechaegreso,urg.consecutivo,urg.iden_fac,urg.iden_dfa  
  FROM nrurgencias AS urg
  WHERE iden_fac='$giden_fac'";
  //echo $consultacon;
  $consultacon=mysql_query($consultacon);
  while($rowcon=mysql_fetch_array($consultacon)){
    $nomvar="id_urgencias".$cont;
	echo "<input type='hidden' name='$nomvar' value='$rowcon[id_urgencias]'>";
    echo "<tr>";
	$nomvar="chk".$cont;
    echo "<td class='Td2' align='left'><input type='checkbox' name='$nomvar' onclick='activar($cont)'></td>";
    echo "<td class='Td2' align='left'><a href='#' onclick=eliminar('U','$rowcon[id_urgencias]') title='Eliminar Registro'><img src='icons/feed_delete.png' width='15' height='15'></a></td>";

    $nomvar="fechainicioatencion".$cont;
    echo "<td class='Td2' align='center'><input type='text' name='$nomvar' size='16' maxlength='16' value='$rowcon[fechainicioatencion]' disabled></td>";

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
    echo "<td class='Td2' align='center'><b>Ingreso<input type='text' name='$nomvar' size='4' maxlength='4' value='$rowcon[coddiagnosticoprincipal]' disabled><a href='#' onclick='ayuda(\"D\",\"$rowcon[coddiagnosticoprincipal]\",\"$cont\")'><img src='icons/feed_magnify.png' width='15' height='15'></a>";

    $nomvar="coddiagnosticoprincipale".$cont;
	echo "<br>Egreso<input type='text' name='$nomvar' size='4' maxlength='4' value='$rowcon[coddiagnosticoprincipale]' disabled>";

	$nomvar="coddiagnosticorelacionadoe1".$cont;
	echo "<br>Eg.Rel 1<input type='text' name='$nomvar' size='4' maxlength='4' value='$rowcon[coddiagnosticorelacionadoe1]' disabled>";

	$nomvar="coddiagnosticorelacionadoe2".$cont;
	echo "<br>Eg.Rel 2<input type='text' name='$nomvar' size='4' maxlength='4' value='$rowcon[coddiagnosticorelacionadoe2]' disabled>";

    $nomvar="coddiagnosticorelacionadoe3".$cont;
	echo "<br>Eg.Rel 3<input type='text' name='$nomvar' size='4' maxlength='4' value='$rowcon[coddiagnosticorelacionadoe3]' disabled>";

    $nomvar="coddiagnosticocausamuerte".$cont;
	echo "<br>Muerte<input type='text' name='$nomvar' size='4' maxlength='4' value='$rowcon[coddiagnosticocausamuerte]' disabled>";
	echo "</td>";

    $consultades=mysql_query("SELECT valo_des,nomb_des FROM destipos WHERE codt_des='H3'");
    $nomvar="condiciondestinousuarioegreso".$cont;
    echo "<td class='Td2' align='center'><select name='$nomvar' disabled>";
	  while($rowdes=mysql_fetch_array($consultades)){
	    echo "<option value='$rowdes[valo_des]'>$rowdes[valo_des] ".substr($rowdes[nomb_des],0,30);
	  }
	echo "</select>";
	echo "</td>";
	?>
	<script language='javascript'>activasel('<?echo $nomvar;?>','<?echo $rowcon[condiciondestinousuarioegreso];?>');</script>
	<?php  
    
    $nomvar="fechaegreso".$cont;
    echo "<td class='Td2' align='center'><input type='text' name='$nomvar' size='16' maxlength='16' value='$rowcon[fechaegreso]' disabled></td>";
    echo "</tr>";
	$cont++;
  }
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