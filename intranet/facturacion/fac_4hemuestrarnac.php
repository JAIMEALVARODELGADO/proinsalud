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
    comando="form1.fnac_fna"+reg_+".disabled=false";
	eval(comando);
    comando="form1.hnac_fna"+reg_+".disabled=false";
    eval(comando);
    comando="form1.edge_fna"+reg_+".disabled=false";
    eval(comando);
    comando="form1.contr_fna"+reg_+".disabled=false";
    eval(comando);
    comando="form1.sexo_fna"+reg_+".disabled=false";
    eval(comando);
    comando="form1.peso_fna"+reg_+".disabled=false";
    eval(comando);
    comando="form1.diag_fna"+reg_+".disabled=false";
    eval(comando);
    comando="form1.cmue_fna"+reg_+".disabled=false";
    eval(comando);
    comando="form1.fmue_fna"+reg_+".disabled=false";
    eval(comando);
    comando="form1.hmue_fna"+reg_+".disabled=false";
    eval(comando);
  }
  else{
    comando="form1.fnac_fna"+reg_+".disabled=true";
	eval(comando);
    comando="form1.hnac_fna"+reg_+".disabled=true";
    eval(comando);
    comando="form1.edge_fna"+reg_+".disabled=true";
    eval(comando);
    comando="form1.contr_fna"+reg_+".disabled=true";
    eval(comando);
    comando="form1.sexo_fna"+reg_+".disabled=true";
    eval(comando);
    comando="form1.peso_fna"+reg_+".disabled=true";
    eval(comando);
    comando="form1.diag_fna"+reg_+".disabled=true";
    eval(comando);
    comando="form1.cmue_fna"+reg_+".disabled=true";
    eval(comando);
    comando="form1.fmue_fna"+reg_+".disabled=true";
    eval(comando);
    comando="form1.hmue_fna"+reg_+".disabled=true";
    eval(comando);
  }
}

function activar2(){
var comando='';
  comando="form1.chknuevo.checked";
  if(eval(comando)==true){
    comando="form1.fnac_fna.disabled=false";
	eval(comando);
    comando="form1.hnac_fna.disabled=false";
	eval(comando);
	comando="form1.edge_fna.disabled=false";
	eval(comando);
	comando="form1.contr_fna.disabled=false";
	eval(comando);
	comando="form1.sexo_fna.disabled=false";
	eval(comando);
	comando="form1.peso_fna.disabled=false";
	eval(comando);
	comando="form1.diag_fna.disabled=false";
	eval(comando);
	comando="form1.cmue_fna.disabled=false";
	eval(comando);
	comando="form1.fmue_fna.disabled=false";
	eval(comando);
	comando="form1.hmue_fna.disabled=false";
	eval(comando);
  }
  else{
    comando="form1.fnac_fna.disabled=true";
	eval(comando);
    comando="form1.hnac_fna.disabled=true";
	eval(comando);
	comando="form1.edge_fna.disabled=true";
	eval(comando);
	comando="form1.contr_fna.disabled=true";
	eval(comando);
	comando="form1.sexo_fna.disabled=true";
	eval(comando);
	comando="form1.peso_fna.disabled=true";
	eval(comando);
	comando="form1.diag_fna.disabled=true";
	eval(comando);
	comando="form1.cmue_fna.disabled=true";
	eval(comando);
	comando="form1.fmue_fna.disabled=true";
	eval(comando);
	comando="form1.hmue_fna.disabled=true";
	eval(comando);
  }
}

function validar(cont_){
var i=0,comando='',error='';
  if(form1.chknuevo.checked=='true'){
	if(form1.fnac_fna.value==''){error=error+"Fecha de nacimiento\n";}
	if(form1.hnac_fna.value==''){error=error+"Hora de nacimiento\n";}
	if(form1.edge_fna.value==''){error=error+"Edad gestacional\n";}
	if(form1.peso_fna.value==''){error=error+"Peso\n";}
	if(form1.diag_fna.value==''){error=error+"Diagnóstico\n";}
	if(form1.cmue_fna.value!='' && form1.fmue_fna.value==''){error=error+"Fecha de muerte\n";}
	if(form1.cmue_fna.value!='' && form1.hmue_fna.value==''){error=error+"Hora de muerte\n";}
  }
  else{
	for(i=0;i<cont_;i++){
		comando="form1.fnac_fna"+i+".value"
		if(eval(comando)==''){error=error+"Fecha de nacimiento "+i+"\n";}
		comando="form1.hnac_fna"+i+".value"
		if(eval(comando)==''){error=error+"Hora de nacimiento "+i+"\n";}
		comando="form1.edge_fna"+i+".value"
		if(eval(comando)==''){error=error+"Edad gestacional "+i+"\n";}
		comando="form1.peso_fna"+i+".value"
		if(eval(comando)==''){error=error+"Peso "+i+"\n";}
		comando="form1.diag_fna"+i+".value"
		if(eval(comando)==''){error=error+"Diagnóstico "+i+"\n";}
		comando="form1.cmue_fna"+i+".value";
		comando2="form1.fmue_fna"+i+".value";
		if(eval(comando)!='' && eval(comando2)==''){error=error+"Fecha de muerte "+i+"\n";}
		comando2="form1.hmue_fna"+i+".value";
		if(eval(comando)!='' && eval(comando2)==''){error=error+"Hora de muerte "+i+"\n";}
	}
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

function borrareg(regi_){
var url='';
  if(confirm("Desea borrar el registro del recien nacido?")){
    url="fac_4heguardanac.php?regi_fna="+regi_+"&borra=S"
    window.open(url,"fr02") 
  }
}
</script>
</head>
<body>
<form name='form1' method="POST" action='fac_4heguardanac.php' target='fr02'>
<table class="Tbl0"><tr><td class="Td0" align='center'>R I P S de la factura <?echo $gfactura;?></td></tr></table>
<?
include('php/conexion.php');
include('php/funciones.php');
?>
<img src='icons/barra7.png' width='910' height='30' usemap="#actividades" border='0'/>
<map name="actividades">
<area shape="rect" coords="0,0,125,30" href="fac_4hemuestracons.php" alt="Consultas" />
<area shape="rect" coords="130,0,260,30" href="fac_4hemuestraproc.php" alt="Procedimientos" />
<area shape="rect" coords="265,0,380,30" href="fac_4hemuestramedi.php" alt="Medicamentos" />
<area shape="rect" coords="390,0,515,30" href="fac_4hemuestraotro.php" alt="Otros Servicios" />
<area shape="rect" coords="520,0,645,30" href="fac_4hemuestraurge.php" alt="Est. Urgencias" />
<area shape="rect" coords="655,0,800,30" href="fac_4hemuestrahosp.php" alt="Est. Hospitalización" />
<!--<area shape="rect" coords="800,0,910,30" href="fac_4hemuestrarnac.php" alt="Recién Nacidos" />-->
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
  <th class="Th0" width='5%'><b>Sel</td>
  <th class="Th0" width='10%'><b>Fecha Nac</td>
  <th class="Th0" width='5%'><b>Hora Nac</td>
  <th class="Th0" width='10%'><b>Edad Ges</td>
  <th class="Th0" width='10%'><b>Control</td>
  <th class="Th0" width='10%'><b>Sexo</td>
  <th class="Th0" width='10%'><b>Peso</td>
  <th class="Th0" width='10%'><b>Diag.</td>
  <th class="Th0" width='10%'><b>Causa Muerte</td>
  <th class="Th0" width='10%'><b>F.Muerte</td>
  <th class="Th0" width='5%'><b>H.Muerte</td>
<?
  $cont=0;
  /*$consultacon="SELECT rna.regi_fna,rna.numf_fna,rna.fnac_fna,rna.hnac_fna,rna.edge_fna,rna.contr_fna,rna.sexo_fna,rna.peso_fna,rna.diag_fna,rna.cmue_fna,rna.fmue_fna,rna.hmue_fna 
  FROM fnacidos AS rna
  WHERE rna.numf_fna='$gfactura'";*/
  $consultacon="SELECT rna.regi_fna,rna.numf_fna,rna.fnac_fna,rna.hnac_fna,rna.edge_fna,rna.contr_fna,rna.sexo_fna,rna.peso_fna,rna.diag_fna,rna.cmue_fna,rna.fmue_fna,rna.hmue_fna 
  FROM fnacidos AS rna
  WHERE rna.iden_fac='$giden_fac'";
  //echo $consultacon;
  $consultacon=mysql_query($consultacon);
  while($rowcon=mysql_fetch_array($consultacon)){
    $nomvar="regi_fna".$cont;
	echo "<input type='hidden' name='$nomvar' value='$rowcon[regi_fna]'>";
    echo "<tr>";
	$nomvar="chk".$cont;
    echo "<td class='Td2' align='left'><input type='checkbox' name='$nomvar' onclick='activar($cont)'>
	<a href='#' onclick='borrareg($rowcon[regi_fna])'><img src='icons/feed_delete.png' width='15' height='15'></a>
	</td>";
    $nomvar="fnac_fna".$cont;
    echo "<td class='Td2' align='center'><input type='text' name='$nomvar' size='10' maxlength='10' value='$rowcon[fnac_fna]' disabled></td>";
	$nomvar="hnac_fna".$cont;
    echo "<td class='Td2' align='center'><input type='text' name='$nomvar' size='5' maxlength='5' value='$rowcon[hnac_fna]' disabled></td>";
	$nomvar="edge_fna".$cont;
    echo "<td class='Td2' align='center'><input type='text' name='$nomvar' size='2' maxlength='2' value='$rowcon[edge_fna]' disabled>Sem</td>";
	$nomvar="contr_fna".$cont;
    echo "<td class='Td2' align='center'><select name='$nomvar' disabled>
	  <option value='1'>Si
	  <option value='2'>No";
	echo "</td>";
	?>
	<script language='javascript'>activasel('<?echo $nomvar;?>','<?echo $rowcon[contr_fna];?>');</script>
	<?
	$nomvar="sexo_fna".$cont;
    echo "<td class='Td2' align='center'><select name='$nomvar' disabled>
	  <option value='F'>Femenino
	  <option value='M'>Masculino";
	echo "</td>";
	?>
	<script language='javascript'>activasel('<?echo $nomvar;?>','<?echo $rowcon[sexo_fna];?>');</script>
	<?
	$nomvar="peso_fna".$cont;
    echo "<td class='Td2' align='center'><input type='text' name='$nomvar' size='4' maxlength='4' value='$rowcon[peso_fna]' disabled>Gr</td>";
	$nomvar="diag_fna".$cont;
	echo "<td class='Td2' align='center'><input type='text' name='$nomvar' size='4' maxlength='4' value='$rowcon[diag_fna]' disabled><a href='#' onclick='ayuda(\"D\",\"$rowcon[diag_fna]\")'><img src='icons/feed_magnify.png' width='15' height='15'></a></td>";
	$nomvar="cmue_fna".$cont;
	echo "<td class='Td2' align='center'><input type='text' name='$nomvar' size='4' maxlength='4' value='$rowcon[cmue_fna]' disabled><a href='#' onclick='ayuda(\"D\",\"$rowcon[cmue_fna]\")'><img src='icons/feed_magnify.png' width='15' height='15'></a></td>";
    $nomvar="fmue_fna".$cont;
    echo "<td class='Td2' align='center'><input type='text' name='$nomvar' size='10' maxlength='10' value='$rowcon[fmue_fna]' disabled></td>";
    $nomvar="hmue_fna".$cont;
    echo "<td class='Td2' align='center'><input type='text' name='$nomvar' size='5' maxlength='5' value='$rowcon[hmue_fna]' disabled></td>";
    echo "</tr>";
	$cont++;
  }
  echo "<tr>";
  echo "<td class='Td2' align='left'><input type='checkbox' name='chknuevo' onclick='activar2()'>Nuevo</td>";
  echo "<td class='Td2' align='center'><input type='text' name='fnac_fna' size='10' maxlength='10' disabled></td>";
  echo "<td class='Td2' align='center'><input type='text' name='hnac_fna' size='5' maxlength='5' disabled></td>";
  echo "<td class='Td2' align='center'><input type='text' name='edge_fna' size='2' maxlength='2' disabled>Sem</td>";
  echo "<td class='Td2' align='center'><select name='contr_fna' disabled>
	  <option value='1'>Si
	  <option value='2'>No";
  echo "</td>";
  echo "<td class='Td2' align='center'><select name='sexo_fna' disabled>
	  <option value='F'>Femenino
	  <option value='M'>Masculino";
  echo "</td>";
  echo "<td class='Td2' align='center'><input type='text' name='peso_fna' size='4' maxlength='4' disabled>Gr</td>";
  echo "<td class='Td2' align='center'><input type='text' name='diag_fna' size='4' maxlength='4' disabled><a href='#' onclick='ayuda(\"D\",\"$diag_fna\")'><img src='icons/feed_magnify.png' width='15' height='15'></a></td>";
  echo "<td class='Td2' align='center'><input type='text' name='cmue_fna' size='4' maxlength='4' disabled><a href='#' onclick='ayuda(\"D\",\"$cmue_fna\")'><img src='icons/feed_magnify.png' width='15' height='15'></a></td>";
  echo "<td class='Td2' align='center'><input type='text' name='fmue_fna' size='10' maxlength='10' disabled></td>";
  echo "<td class='Td2' align='center'><input type='text' name='hmue_fna' size='5' maxlength='5' disabled></td>";
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
