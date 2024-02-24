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
    comando="form1.naut_fos"+reg_+".disabled=false";
    eval(comando);
    comando="form1.tpser_fos"+reg_+".disabled=false";
    eval(comando);
    comando="form1.cods_fos"+reg_+".disabled=false";
    eval(comando);
    comando="form1.noms_fos"+reg_+".disabled=false";
    eval(comando);
  }
  else{
    comando="form1.naut_fos"+reg_+".disabled=true";
    eval(comando);
    comando="form1.tpser_fos"+reg_+".disabled=true";
    eval(comando);
    comando="form1.cods_fos"+reg_+".disabled=true";
    eval(comando);
    comando="form1.noms_fos"+reg_+".disabled=true";
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
	comando="form1.cods_fos"+i+".value"
    if(eval(comando)==''){error=error+"Código del servicio "+i+"\n";}
	comando="form1.noms_fos"+i+".value"
    if(eval(comando)==''){error=error+"Nombre del servicio "+i+"\n";}
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
        url_="fac_4herborrareg.php?reg="+reg_+"&tipo="+tipo_;
        //alert(url_);
        window.open(url_,"fr02");
    }
}
</script>
</head>
<body>
<form name='form1' method="POST" action='fac_4heguardaotr.php' target='fr02'>
<table class="Tbl0"><tr><td class="Td0" align='center'>R I P S de la factura <?echo $gfactura;?></td></tr></table>
<?
include('php/conexion.php');
include('php/funciones.php');
?>
<img src='icons/barra4.png' width='910' height='30' usemap="#actividades" border='0'/>
<map name="actividades">
<area shape="rect" coords="0,0,125,30" href="fac_4hemuestracons.php" alt="Consultas" />
<area shape="rect" coords="130,0,260,30" href="fac_4hemuestraproc.php" alt="Procedimientos" />
<area shape="rect" coords="265,0,380,30" href="fac_4hemuestramedi.php" alt="Medicamentos" />
<!--<area shape="rect" coords="390,0,515,30" href="fac_4hemuestraotro.php" alt="Otros Servicios" />-->
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
  $consulta="SELECT us.tdoc_usu,us.nrod_usu,us.pnom_usu,us.snom_usu,us.pape_usu,us.sape_usu,
  ef.vnet_fac
  FROM encabezado_factura AS ef
  INNER JOIN usuario AS us ON us.codi_usu=ef.codi_usu
  WHERE iden_fac=$giden_fac";
  $consulta=mysql_query($consulta);
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
  <th class="Th0" width='5%'colspan='2'><b>Sel</td>
  <th class="Th0" width='15%'><b>Autorización</td>
  <th class="Th0" width='15%'><b>Tipo</td>
  <th class="Th0" width='15%'><b>Código</td>
  <th class="Th0" width='44%'><b>Nombre</td>
  <th class="Th0" width='6%'><b>Valor</td>  
<?
  $cont=0;
  $total=0;
  /*$consultacon="SELECT otr.regi_fos,otr.naut_fos,otr.tpser_fos,otr.cods_fos,otr.noms_fos,otr.vtot_fos
  FROM fotros_servicios AS otr
  WHERE numf_fos='$gfactura'";*/
  $consultacon="SELECT otr.regi_fos,otr.naut_fos,otr.tpser_fos,otr.cods_fos,otr.noms_fos,otr.vtot_fos
  FROM fotros_servicios AS otr
  WHERE iden_fac='$giden_fac'";
  //echo $consultacon;
  $consultacon=mysql_query($consultacon);
  while($rowcon=mysql_fetch_array($consultacon)){
    $nomvar="regi_fos".$cont;
	echo "<input type='hidden' name='$nomvar' value='$rowcon[regi_fos]'>";
    echo "<tr>";
	$nomvar="chk".$cont;
    echo "<td class='Td2' align='left'><input type='checkbox' name='$nomvar' onclick='activar($cont)'></td>";
    echo "<td class='Td2' align='left'><a href='#' onclick=eliminar('O','$rowcon[regi_fos]') title='Eliminar Registro'><img src='icons/feed_delete.png' width='15' height='15'></a></td>";
	$nomvar="naut_fos".$cont;
    echo "<td class='Td2' align='center'><input type='text' name='$nomvar' size='15' maxlength='15' value='$rowcon[naut_fos]' disabled></td>";
	$nomvar="tpser_fos".$cont;
	echo "<td class='Td2' align='center'><select name='$nomvar' disabled>";
		echo "<option value='1'>Materiales e insumos";
		echo "<option value='2'>Traslados";
		echo "<option value='3'>Estancias";
		echo "<option value='4'>Honorarios";
	echo "</select>";
	echo "</td>";
	?>
	<script language='javascript'>activasel('<?echo $nomvar;?>','<?echo $rowcon[tpser_fos];?>');</script>
	<?	
	$nomvar="cods_fos".$cont;
	echo "<td class='Td2' align='center'><input type='text' name='$nomvar' size='20' maxlength='20' value='$rowcon[cods_fos]' disabled><a href='#' onclick='ayuda(\"M\",\"$rowcon[cods_fos]\",\"$cont\")'><img src='icons/feed_magnify.png' width='15' height='15'></a></td>";
	$nomvar="noms_fos".$cont;
    echo "<td class='Td2' align='center'><input type='text' name='$nomvar' size='65' maxlength='60' value='$rowcon[noms_fos]' disabled></td>";
	$nomvar="vtot_fos".$cont;
	echo "<td class='Td2' align='right'><input type='text' name='$nomvar' size='7' maxlength='7' value='".number_format($rowcon[vtot_fos])."' disabled></td>";
    echo "</tr>";
	$total=$total+$rowcon[vtot_fos];
	$cont++;
  }
echo "</tr>";
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
