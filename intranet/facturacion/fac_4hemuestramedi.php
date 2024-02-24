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
    comando="form1.naut_fme"+reg_+".disabled=false";
    eval(comando);
    comando="form1.codi_fme"+reg_+".disabled=false";
    eval(comando);
    comando="form1.tipo_fme"+reg_+".disabled=false";
    eval(comando);
    comando="form1.nomb_fme"+reg_+".disabled=false";
    eval(comando);
    comando="form1.form_fme"+reg_+".disabled=false";
    eval(comando);
    comando="form1.conc_fme"+reg_+".disabled=false";
    eval(comando);
    comando="form1.unid_fme"+reg_+".disabled=false";
    eval(comando);
  }
  else{
        comando="form1.naut_fme"+reg_+".disabled=true";
    eval(comando);
    comando="form1.codi_fme"+reg_+".disabled=true";
    eval(comando);
    comando="form1.tipo_fme"+reg_+".disabled=true";
    eval(comando);
    comando="form1.nomb_fme"+reg_+".disabled=true";
    eval(comando);
    comando="form1.form_fme"+reg_+".disabled=true";
    eval(comando);
    comando="form1.conc_fme"+reg_+".disabled=true";
    eval(comando);
    comando="form1.unid_fme"+reg_+".disabled=true";
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
	comando="form1.codi_fme"+i+".value"
    if(eval(comando)==''){error=error+"Código del medicamento "+i+"\n";}
	comando="form1.nomb_fme"+i+".value"
    if(eval(comando)==''){error=error+"Nombre del medicamento "+i+"\n";}
	comando="form1.tipo_fme"+i+".value"
	comando2="form1.form_fme"+i+".value"
	if(eval(comando)=='2' && eval(comando2)==''){error=error+"Forma Farmacéutica "+i+"\n";}
	comando2="form1.conc_fme"+i+".value"
	if(eval(comando)=='2' && eval(comando2)==''){error=error+"Concentración "+i+"\n";}
	comando2="form1.unid_fme"+i+".value"
	if(eval(comando)=='2' && eval(comando2)==''){error=error+"Unidad de medida "+i+"\n";}
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
    if(confirm("Desea eliminar este medicamento?")){
        url_="fac_4herborrareg.php?reg="+reg_+"&tipo="+tipo_;
        //alert(url_);
        window.open(url_,"fr02");
    }
}
</script>
</head>
<body>
<form name='form1' method="POST" action='fac_4heguardamed.php' target='fr02'>
<table class="Tbl0"><tr><td class="Td0" align='center'>R I P S de la factura <?echo $gfactura;?></td></tr></table>
<?
include('php/conexion.php');
include('php/funciones.php');
?>
<img src='icons/barra3.png' width='910' height='30' usemap="#actividades" border='0'/>
<map name="actividades">
<area shape="rect" coords="0,0,125,30" href="fac_4hemuestracons.php" alt="Consultas" />
<area shape="rect" coords="130,0,260,30" href="fac_4hemuestraproc.php" alt="Procedimientos" />
<!--<area shape="rect" coords="265,0,380,30" href="fac_4hemuestramedi.php" alt="Medicamentos" />-->
<area shape="rect" coords="390,0,515,30" href="fac_4hemuestraotro.php" alt="Otros Servicios" />
<area shape="rect" coords="520,0,645,30" href="fac_4hemuestraurge.php" alt="Est. Urgencias" />
<area shape="rect" coords="655,0,800,30" href="fac_4hemuestrahosp.php" alt="Est. Hospitalización" />
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
  <th class="Th0" width='8%'><b>Autorización</td>
  <th class="Th0" width='14%'><b>Código</td>
  <th class="Th0" width='10%'><b>Tipo</td>
  <th class="Th0" width='14%'><b>Nombre</td>
  <th class="Th0" width='14%'><b>Forma Farm.</td>
  <th class="Th0" width='14%'><b>Concentracion</td>  
  <th class="Th0" width='15%'><b>Und de Medida</td>
  <th class="Th0" width='6%'><b>Valor</td>  
<?
  $cont=0;
  $total=0;
  /*$consultacon="SELECT med.regi_fme,med.naut_fme,med.codi_fme,med.tipo_fme,med.nomb_fme,
  med.form_fme,med.conc_fme,med.unid_fme,med.vtot_fme
  FROM fmedicamento AS med
  WHERE numf_fme='$gfactura'";*/
  $consultacon="SELECT med.regi_fme,med.naut_fme,med.codi_fme,med.tipo_fme,med.nomb_fme,
  med.form_fme,med.conc_fme,med.unid_fme,med.vtot_fme
  FROM fmedicamento AS med
  WHERE iden_fac='$giden_fac'";
  //echo $consultacon;
  $consultacon=mysql_query($consultacon);
  while($rowcon=mysql_fetch_array($consultacon)){
    $nomvar="regi_fme".$cont;
	echo "<input type='hidden' name='$nomvar' value='$rowcon[regi_fme]'>";
    echo "<tr>";
	$nomvar="chk".$cont;
    echo "<td class='Td2' align='left'><input type='checkbox' name='$nomvar' onclick='activar($cont)'></td>";
    echo "<td class='Td2' align='left'><a href='#' onclick=eliminar('M','$rowcon[regi_fme]') title='Eliminar Registro'><img src='icons/feed_delete.png' width='15' height='15'></a></td>";
	$nomvar="naut_fme".$cont;
    echo "<td class='Td2' align='center'><input type='text' name='$nomvar' size='10' maxlength='15' value='$rowcon[naut_fme]' disabled></td>";
	$nomvar="codi_fme".$cont;
    echo "<td class='Td2' align='center'><input type='text' name='$nomvar' size='20' maxlength='20' value='$rowcon[codi_fme]' disabled><a href='#'  onclick='ayuda(\"M\",\"$rowcon[codi_fme]\")'><img src='icons/feed_magnify.png' width='15' height='15'></a></td>";
	$nomvar="tipo_fme".$cont;
	echo "<td class='Td2' align='center'><select name='$nomvar' disabled>";
		echo "<option value='1'>POS";
		echo "<option value='2'>No POS";
	echo "</select>";
	echo "</td>";
	?>
	<script language='javascript'>activasel('<?echo $nomvar;?>','<?echo $rowcon[tipo_fme];?>');</script>
	<?	
	$nomvar="nomb_fme".$cont;
    echo "<td class='Td2' align='center'><input type='text' name='$nomvar' size='30' maxlength='30' value='$rowcon[nomb_fme]' disabled></td>";
	$nomvar="form_fme".$cont;
    echo "<td class='Td2' align='center'><input type='text' name='$nomvar' size='20' maxlength='20' value='$rowcon[form_fme]' disabled></td>";
	$nomvar="conc_fme".$cont;
	echo "<td class='Td2' align='center'><input type='text' name='$nomvar' size='15' maxlength='20' value='$rowcon[conc_fme]' disabled></td>";
	$nomvar="unid_fme".$cont;
	echo "<td class='Td2' align='center'><input type='text' name='$nomvar' size='15' maxlength='20' value='$rowcon[unid_fme]' disabled></td>";
	$nomvar="vtot_fme".$cont;
	echo "<td class='Td2' align='right'><input type='text' name='$nomvar' size='7' maxlength='7' value='".number_format($rowcon[vtot_fme])."' disabled></td>";
    echo "</tr>";
	$total=$total+$rowcon[vtot_fme];
	$cont++;
  }
echo "</tr>";
echo "<td class='Td2' align='right'></td>";
echo "<td class='Td2' align='right'></td>";
echo "<td class='Td2' align='right'></td>";
echo "<td class='Td2' align='right'></td>";
echo "<td class='Td2' align='right'></td>";
echo "<td class='Td2' align='right'></td>";
echo "<td class='Td2' align='right'></td>";
echo "<td class='Td2' align='right'><b>Total </td>";
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
