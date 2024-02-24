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
    comando="form1.via_fho"+reg_+".disabled=false";
    eval(comando);
    comando="form1.feci_fho"+reg_+".disabled=false";
    eval(comando);
    comando="form1.hori_fho"+reg_+".disabled=false";
    eval(comando);
    comando="form1.naut_fho"+reg_+".disabled=false";
    eval(comando);
    comando="form1.cext_fho"+reg_+".disabled=false";
    eval(comando);
    comando="form1.dxin_fho"+reg_+".disabled=false";
    eval(comando);
    comando="form1.dxeg_fho"+reg_+".disabled=false";
    eval(comando);
    comando="form1.dxre1_fho"+reg_+".disabled=false";
    eval(comando);
    comando="form1.dxre2_fho"+reg_+".disabled=false";
    eval(comando);
    comando="form1.dxre3_fho"+reg_+".disabled=false";
    eval(comando);
    comando="form1.comp_fho"+reg_+".disabled=false";
    eval(comando);
    comando="form1.ests_fho"+reg_+".disabled=false";
    eval(comando);
    comando="form1.cmue_fho"+reg_+".disabled=false";
    eval(comando);
    comando="form1.fece_fho"+reg_+".disabled=false";
    eval(comando);
    comando="form1.hore_fho"+reg_+".disabled=false";
    eval(comando);
  }
  else{
    comando="form1.via_fho"+reg_+".disabled=true";
	eval(comando);
    comando="form1.feci_fho"+reg_+".disabled=true";
    eval(comando);
    comando="form1.hori_fho"+reg_+".disabled=true";
    eval(comando);
    comando="form1.naut_fho"+reg_+".disabled=true";
    eval(comando);
    comando="form1.cext_fho"+reg_+".disabled=true";
    eval(comando);
    comando="form1.dxin_fho"+reg_+".disabled=true";
    eval(comando);
    comando="form1.dxeg_fho"+reg_+".disabled=true";
    eval(comando);
    comando="form1.dxre1_fho"+reg_+".disabled=true";
    eval(comando);
    comando="form1.dxre2_fho"+reg_+".disabled=true";
    eval(comando);
    comando="form1.dxre3_fho"+reg_+".disabled=true";
    eval(comando);
    comando="form1.comp_fho"+reg_+".disabled=true";
    eval(comando);
    comando="form1.ests_fho"+reg_+".disabled=true";
    eval(comando);
    comando="form1.cmue_fho"+reg_+".disabled=true";
    eval(comando);
    comando="form1.fece_fho"+reg_+".disabled=true";
    eval(comando);
    comando="form1.hore_fho"+reg_+".disabled=true";
    eval(comando);
  }
}

function validar(cont_){
var i=0,comando='',error='';
	for(i=0;i<cont_;i++){
		comando="form1.via_fho"+i+".value"
		if(eval(comando)==''){error=error+"Vía de ingreso "+i+"\n";}
		comando="form1.feci_fho"+i+".value"
		if(eval(comando)==''){error=error+"Fecha de ingreso "+i+"\n";}
		comando="form1.hori_fho"+i+".value"
		if(eval(comando)==''){error=error+"Hora de ingreso "+i+"\n";}
		comando="form1.dxin_fho"+i+".value"
		if(eval(comando)==''){error=error+"Diagnóstico de Ingreso "+i+"\n";}
		comando="form1.dxeg_fho"+i+".value"
		if(eval(comando)==''){error=error+"Diagnóstico de egreso "+i+"\n";}
		comando="form1.ests_fho"+i+".value";
		comando2="form1.cmue_fho"+i+".value";
		if(eval(comando)=='2' && eval(comando2)==''){error=error+"Causa de muerte "+i+"\n";}
		if(eval(comando)=='1' && eval(comando2)!=''){
			comando="form1.cmue_fho"+i+".value=''";
			eval(comando);
		}
		comando="form1.fece_fho"+i+".value"
		if(eval(comando)==''){error=error+"Fecha de egreso "+i+"\n";}
		comando="form1.hore_fho"+i+".value"
		if(eval(comando)==''){error=error+"Hora de egreso "+i+"\n";}
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
        url_="fac_4herborrareg.php?reg="+reg_+"&tipo="+tipo_;
        //alert(url_);
        window.open(url_,"fr02");
    }
}
</script>
</head>
<body>
<form name='form1' method="POST" action='fac_4heguardahos.php' target='fr02'>
<table class="Tbl0"><tr><td class="Td0" align='center'>R I P S de la factura <?echo $gfactura;?></td></tr></table>
<?
include('php/conexion.php');
include('php/funciones.php');
?>
<img src='icons/barra6.png' width='910' height='30' usemap="#actividades" border='0'/>
<map name="actividades">
<area shape="rect" coords="0,0,125,30" href="fac_4hemuestracons.php" alt="Consultas" />
<area shape="rect" coords="130,0,260,30" href="fac_4hemuestraproc.php" alt="Procedimientos" />
<area shape="rect" coords="265,0,380,30" href="fac_4hemuestramedi.php" alt="Medicamentos" />
<area shape="rect" coords="390,0,515,30" href="fac_4hemuestraotro.php" alt="Otros Servicios" />
<area shape="rect" coords="520,0,645,30" href="fac_4hemuestraurge.php" alt="Est. Urgencias" />
<!--<area shape="rect" coords="655,0,800,30" href="fac_4hemuestrahosp.php" alt="Est. Hospitalización" />-->
<area shape="rect" coords="800,0,910,30" href="fac_4hemuestrarnac.php" alt="Recién Nacidos" />
</map>
<table class="Tbl0" border='0'>
  <th class="Th0" width='10%'><b>Factura Nro:</td>
  <th class="Th0" width='15%'><b>Tp. Identificación:</td>
  <th class="Th0" width='15%'><b>Número</td>
  <th class="Th0" width='50%'><b>Nombre</td>
  <th class="Th0" width='10%'><b>Vr.Factura</td>
<?
  $consulta=mysql_query("SELECT us.tdoc_usu,us.nrod_usu,us.pnom_usu,us.snom_usu,us.pape_usu,us.sape_usu,
  ef.vnet_fac
  FROM encabezado_factura AS ef
  INNER JOIN usuario AS us ON us.codi_usu=ef.codi_usu
  WHERE iden_fac=$giden_fac");
  $row=mysql_fetch_array($consulta);
  $nombre=$row[pnom_usu]." ".$row[snom_usu]." ".$row[pape_usu]." ".$row[sape_usu];
  echo "<tr>";
  echo "<td class='Td2' align='left'>$gfactura</td>";
  echo "<td class='Td2' align='center'>$row[tdoc_usu]</td>";
  echo "<td class='Td2' align='center'>$row[nrod_usu]</td>";
  echo "<td class='Td2' align='center'>$nombre</td>";
  echo "<td class='Td2' align='center'>$row[vnet_fac]</td>";
  echo "</tr>";
?>    
</table>
<table class="Tbl0" border='1'>
  <th class="Th0" width='5%' colspan='2'><b>Sel</td>
  <th class="Th0" width='10%'><b>Via de Ing</td>
  <th class="Th0" width='8%'><b>F.Ingreso</td>
  <th class="Th0" width='5%'><b>Hora Ing</td>
  <th class="Th0" width='9%'><b>Autorizacion</td>
  <th class="Th0" width='15%'><b>Causa Ext</td>
  <th class="Th0" width='15%'><b>Diagnost</td>
  <th class="Th0" width='10%'><b>Est.Salida</td>
  <th class="Th0" width='10%'><b>Causa Muerte</td>
  <th class="Th0" width='8%'><b>F.Egreso</td>
  <th class="Th0" width='5%'><b>Hora Eg</td>
<?
  $cont=0;
  /*$consultacon="SELECT hos.regi_fho,hos.via_fho,hos.feci_fho,hos.hori_fho,hos.naut_fho,hos.cext_fho,hos.dxin_fho,hos.dxeg_fho,
  hos.dxre1_fho,hos.dxre2_fho,hos.dxre3_fho,hos.comp_fho,hos.ests_fho,hos.cmue_fho,hos.fece_fho,hos.hore_fho 
  FROM fhospital AS hos
  WHERE numf_fho='$gfactura'";*/
  $consultacon="SELECT hos.regi_fho,hos.via_fho,hos.feci_fho,hos.hori_fho,hos.naut_fho,hos.cext_fho,hos.dxin_fho,hos.dxeg_fho,
  hos.dxre1_fho,hos.dxre2_fho,hos.dxre3_fho,hos.comp_fho,hos.ests_fho,hos.cmue_fho,hos.fece_fho,hos.hore_fho 
  FROM fhospital AS hos
  WHERE iden_fac='$giden_fac'";
  //echo $consultacon;
  $consultacon=mysql_query($consultacon);
  while($rowcon=mysql_fetch_array($consultacon)){
    $nomvar="regi_fho".$cont;
	echo "<input type='hidden' name='$nomvar' value='$rowcon[regi_fho]'>";
    echo "<tr>";
	$nomvar="chk".$cont;
    echo "<td class='Td2' align='left'><input type='checkbox' name='$nomvar' onclick='activar($cont)'></td>";
    echo "<td class='Td2' align='left'><a href='#' onclick=eliminar('H','$rowcon[regi_fho]') title='Eliminar Registro'><img src='icons/feed_delete.png' width='15' height='15'></a></td>";
    $nomvar="via_fho".$cont;
    echo "<td class='Td2' align='center'><select name='$nomvar' disabled>";
		echo "<option value='1'>Urgencias";
		echo "<option value='2'>Consulta Externa";
		echo "<option value='3'>Remitido";
		echo "<option value='4'>Nacido en la Inst.";
	echo "</select>";
	echo "</td>";
	?>
	<script language='javascript'>activasel('<?echo $nomvar;?>','<?echo $rowcon[via_fho];?>');</script>
	<?
    $nomvar="feci_fho".$cont;
    echo "<td class='Td2' align='center'><input type='text' name='$nomvar' size='10' maxlength='10' value='$rowcon[feci_fho]' disabled></td>";
    $nomvar="hori_fho".$cont;
    echo "<td class='Td2' align='center'><input type='text' name='$nomvar' size='5' maxlength='5' value='$rowcon[hori_fho]' disabled></td>";	
	$nomvar="naut_fho".$cont;
    echo "<td class='Td2' align='center'><input type='text' name='$nomvar' size='15' maxlength='15' value='$rowcon[naut_fho]' disabled></td>";
	$consultades=mysql_query("SELECT valo_des,nomb_des FROM destipos WHERE codt_des='12'");
	$nomvar="cext_fho".$cont;
    echo "<td class='Td2' align='center'><select name='$nomvar' disabled>";
	  while($rowdes=mysql_fetch_array($consultades)){
	    echo "<option value='$rowdes[valo_des]'>$rowdes[valo_des] ".substr($rowdes[nomb_des],0,20);
	  }
	echo "</select>";
	echo "</td>";
	?>
	<script language='javascript'>activasel('<?echo $nomvar;?>','<?echo $rowcon[cext_fho];?>');</script>
	<?
	$nomvar="dxin_fho".$cont;
    echo "<td class='Td2' align='center'><b>Ing.<input type='text' name='$nomvar' size='4' maxlength='4' value='$rowcon[dxin_fho]' disabled><a href='#' onclick='ayuda(\"D\",\"$rowcon[dxin_fho]\",\"$cont\")'><img src='icons/feed_magnify.png' width='15' height='15'></a>";
	$nomvar="dxeg_fho".$cont;
	echo "<br>Egr. <input type='text' name='$nomvar' size='4' maxlength='4' value='$rowcon[dxeg_fho]' disabled>";
	$nomvar="dxre1_fho".$cont;
	echo "<br>Rel 1<input type='text' name='$nomvar' size='4' maxlength='4' value='$rowcon[dxre1_fho]' disabled>";
	$nomvar="dxre2_fho".$cont;
	echo "<br>Rel 2<input type='text' name='$nomvar' size='4' maxlength='4' value='$rowcon[dxre2_fho]' disabled>";
	$nomvar="dxre3_fho".$cont;
	echo "<br>Rel 3<input type='text' name='$nomvar' size='4' maxlength='4' value='$rowcon[dxre3_fho]' disabled>";
	$nomvar="comp_fho".$cont;
	echo "<br>Comp<input type='text' name='$nomvar' size='4' maxlength='4' value='$rowcon[comp_fho]' disabled>";
	echo "</td>";
    $nomvar="ests_fho".$cont;
	echo "<td class='Td2' align='center'><select name='$nomvar' disabled>";
		echo "<option value='1'>Vivo";
		echo "<option value='2'>Muerto";
	echo "</select>";
	echo "</td>";
	?>
	<script language='javascript'>activasel('<?echo $nomvar;?>','<?echo $rowcon[ests_fho];?>');</script>
	<?		
    $nomvar="cmue_fho".$cont;
    echo "<td class='Td2' align='center'><input type='text' name='$nomvar' size='4' maxlength='4' value='$rowcon[cmue_fho]' disabled></td>";
	$nomvar="fece_fho".$cont;
    echo "<td class='Td2' align='center'><input type='text' name='$nomvar' size='10' maxlength='10' value='$rowcon[fece_fho]' disabled></td>";
    $nomvar="hore_fho".$cont;
    echo "<td class='Td2' align='center'><input type='text' name='$nomvar' size='5' maxlength='5' value='$rowcon[hore_fho]' disabled></td>";
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
