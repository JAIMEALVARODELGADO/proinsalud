<html>
<head>
<title>PROGRAMA DE FACTURACIÓN - PROFACTU</title>
<SCRIPT LANGUAGE=JavaScript>
function validactr(){
form1.action='fac_3encab.php';
form1.submit();
}
function validag(cont_){
  var error="",comando='',i=0;
  if(form1.iden_ctr.value==""){error=error+"Nro de contrato\n";}
  if(form1.tipo_fac.value==""){error=error+"Tipo de factura\n";}
  if(form1.feci_fac.value==""){error=error+"Fecha inicial\n";}
  if(form1.fecf_fac.value==""){error=error+"Fecha final\n";}
  if(form1.cod_cie10.value==""){error=error+"Diagnóstico\n";}
  if(error!=""){
    alert(error);
  }
  else{
    for(i=0;i<cont_;i++){
      comando="form1.codigo"+i+".disabled=false";
	  eval(comando);
	}
    form1.submit();
  }
}

</script>

<link rel="stylesheet" href="css/style.css" type="text/css" />
</head>
<body lang=ES  style='tab-interval:35.4pt'  >
<form name="form1" method="POST" action="fac_3guardaenc.php" target='fr02'>
<table class="Tbl0"><tr><td class="Td0" align='center'>ENCABEZADO DE LA FACTURA</td></tr></table>
<?
//echo $iden_qxf;
include('php/conexion.php');
include('php/funciones.php');
$condicion="us.codi_usu=uc.cusu_uco AND uc.iden_uco=qx.iden_uco AND uc.cont_uco=con.codi_con AND qx.iden_qxf=$iden_qxf"; 
$_pagi_sql="SELECT qx.iden_qxf,qx.fech_qxf,qx.dxpo_cir,us.tdoc_usu,us.nrod_usu,us.pnom_usu,us.snom_usu,us.pape_usu,us.sape_usu,us.fnac_usu,us.sexo_usu,
        us.codi_usu,us.dire_usu,us.tpaf_usu,us.mate_usu,us.tres_usu,con.neps_con,con.codi_con, 
        qx.ccir_qxf,qx.cane_qxf,qx.cay1_qxf,qx.cins_qxf,qx.fina_qxf,qx.ambi_qxf,qx.codi_via,qx.hini_qxf,qx.hfin_qxf
		FROM encabezado_qx AS qx,usuario AS us,ucontrato AS uc,contrato AS con 
		WHERE $condicion";

//echo "$_pagi_sql";
$consulta=mysql_query($_pagi_sql);
	
if(mysql_num_rows($consulta)!=0){
  $row = mysql_fetch_array($consulta);
  $consultamun=mysql_query("SELECT nomb_mun FROM municipio WHERE codi_mun='$row[mate_usu]'");
  if(mysql_num_rows($consultamun)<>0){
    $rowmun=mysql_fetch_array($consultamun);
	$nomb_mun=$rowmun[nomb_mun];
  }
  mysql_free_result($consultamun);
  echo "<table class='Tbl0'>";
  echo "<tr>";
  echo "<td class='Td2' align='right'><b>Identificación:</td>";
  echo "<td class='Td2'>$row[tdoc_usu] $row[nrod_usu]</td>";
  echo "<td class='Td2' align='right'><b>Nombre:</td>";
  echo "<td class='Td2'>$row[pnom_usu] $row[snom_usu] $row[pape_usu] $row[sape_usu]</td>";
  echo "<td class='Td2' align='right'><b>Edad:</td>";
  echo "<td class='Td2'>".calculaedad($row[fnac_usu])."</td>";
  echo "</tr>";
  echo "<tr>";
  echo "<td class='Td2' align='right'><b>Sexo:</td>";
  echo "<td class='Td2'>$row[sexo_usu]</td>";
  echo "<td class='Td2' align='right'><b>Dirección:</td>";
  echo "<td class='Td2'>$row[dire_usu]</td>";
  echo "<td class='Td2' align='right'><b>Tipo Afiliado:</td>";
  echo "<td class='Td2'>$row[tpaf_usu]</td>";
  echo "</tr>";
  echo "<tr>";
  echo "<td class='Td2' align='right'><b>Mun Atención:</td>";
  echo "<td class='Td2'>$nomb_mun</td>";
  echo "<td class='Td2' align='right'><b>Teléfono:</td>";
  echo "<td class='Td2'>$row[tres_usu]</td>";
  echo "<td class='Td2' align='right'><b>Entidad:</td>";
  echo "<td class='Td2'>$row[neps_con]</td>";
  echo "</tr>";
  echo"</table>";
  ?>
  <table class="Tbl0"><tr><td class="Td0" align='center'>INFORMACION DE LA INTERVECION</td></tr></table><br>
  <table class='Tbl0' border='0'>
  <tr>
    <td class='Td2' align='right'><b>Cirujano:</td>
	<?
	$consmedi=mysql_query("SELECT nom_medi FROM medicos WHERE cod_medi='$row[ccir_qxf]'");
	$rowmedi=mysql_fetch_array($consmedi);
	?>
	<td class='Td2'><?echo $rowmedi[nom_medi];?></td>
	<td class='Td2' align='right'><b>Anestesiólogo:</td>
	<?
	$consmedi=mysql_query("SELECT nom_medi FROM medicos WHERE cod_medi='$row[cane_qxf]'");
	$rowmedi=mysql_fetch_array($consmedi);
	?>
	<td class='Td2'><?echo $rowmedi[nom_medi];?></td>
	<td class='Td2' align='right'><b>Ayudante:</td>
	<?
	$consmedi=mysql_query("SELECT nom_medi FROM medicos WHERE cod_medi='$row[cay1_qxf]'");
	$rowmedi=mysql_fetch_array($consmedi);
	?>
	<td class='Td2'><?echo $rowmedi[nom_medi];?></td>
  </tr>
  <tr>
    <td class='Td2' align='right'><b>Instrumentador:</td>
	<?
	$consmedi=mysql_query("SELECT nom_medi FROM medicos WHERE cod_medi='$row[cins_qxf]'");
	$rowmedi=mysql_fetch_array($consmedi);
	?>
	<td class='Td2'><?echo $rowmedi[nom_medi];?></td>
	<td class='Td2' align='right'><b>Inicio:</td>
	<td class='Td2'><?echo cambiafechadmy($row[fech_qxf])." ".$row[hini_qxf];?></td>
	<td class='Td2' align='right'><b>Finalización:</td>
	<td class='Td2'><?echo $row[hfin_qxf];?></td>
  </tr>
    <tr>
    <td class='Td2' align='right'><b>Finalidad:</td>
	<?
	$constip=mysql_query("SELECT nomb_des FROM destipos WHERE codi_des='$row[fina_qxf]'");
	$rowtip=mysql_fetch_array($constip);
	?>
	<td class='Td2'><?echo $rowtip[nomb_des];?></td>
	<td class='Td2' align='right'><b>Ambito:</td>
	<?
	$constip=mysql_query("SELECT nomb_des FROM destipos WHERE codi_des='$row[ambi_qxf]'");
	$rowtip=mysql_fetch_array($constip);
	?>
	<td class='Td2'><?echo $rowtip[nomb_des];?></td>
	<td class='Td2' align='right'><b>Forma de realización:</td>
	<?
	$consvia=mysql_query("SELECT desc_via FROM vias_qx WHERE codi_via='$row[codi_via]'");
	$rowvia=mysql_fetch_array($consvia);
	?>
	<td class='Td2'><?echo $rowvia[desc_via];?></td>
  </tr>
  </table>
  <table class='Tbl0'>
    <tr>
	  <td class='Td2' align='right'><b>Contrato Nro:</td>
      <td class='Td2'><select name='iden_ctr' onchange='validactr()'><option value=''>
	    <?
          $consultacon=mysql_query("SELECT iden_ctr,nume_ctr FROM contratacion WHERE codi_con='$row[codi_con]' AND esta_ctr='A'");
          while($rowcon=mysql_fetch_array($consultacon)){
		    echo "<option value='$rowcon[iden_ctr]'>$rowcon[nume_ctr]";
		  }
		  mysql_free_result($consultacon);
		?>
		</select>
	  </td>
	  <td class='Td2' align='right'><b>Tipo de factura:</td>
	  <td class='Td2'><select name='tipo_fac'><option value=''>
        <option value='1'>Contado
		<option value='2'>Crédito
		</select>
	  </td>
	  <td class='Td2' align='right'><b>Relación Nro:</td>
	  <td class='Td2'><input type='text' name='rela_fac' size='8' maxlength='8' value='<?echo $rela_fac;?>'></td>
	</tr>
	<tr>
	  <td class='Td2' align='right'><b>F. inicio del servicio:</td>
	  <td class='Td2'><input type='text' name='feci_fac' size='10' maxlength='10' value='<?echo cambiafechadmy($row[fech_qxf]);?>'></td>
	  <td class='Td2' align='right'><b>F. final del servicio:</td>
	  <td class='Td2'><input type='text' name='fecf_fac' size='10' maxlength='10' value='<?echo hoy();?>'></td>
	</tr>
	<tr>
      <td class='Td2' align='right'><b>Diagnóstico:</td>
	  <td class='Td2' align='left'><select name='cod_cie10'><option value=''>
	    <?
          $consultadx=mysql_query("SELECT c.cod_cie10,c.nom_cie10 
		  FROM cie_10 AS c 
		  WHERE c.cod_cie10='$row[dxpo_cir]'");
		  while($rowdx=mysql_fetch_array($consultadx)){
		    echo "<option value='$rowdx[cod_cie10]'>$rowdx[cod_cie10]";
		  }
		  mysql_free_result($consultadx);
		?>
		</select>
	  </td>
	  <td class='Td2' align='right'><b>Entidad a facturar:</td>
	  <td class='Td2' align='left'><select name='enti_fac'><option value=''>
	    <?
		  //mysql_free_result($consultacon);
          $consultaent=mysql_query("SELECT nit_con,neps_con
		  FROM contrato WHERE nit_con<>'' ORDER BY neps_con");
		  while($rowent=mysql_fetch_array($consultaent)){
		    echo "<option value='$rowent[nit_con]'>$rowent[neps_con]";
		  }
		  mysql_free_result($consultaent);
		?>
		</select>
	  </td>
	  <td></td>
	  <td><a href="fac_3prefac.php?iden_qxf=<?echo $iden_qxf;?>"><b>Finalizar<img hspace=0 width=20 height=20 src='icons\feed.png' alt='Cancelar' border=0 align='center'></a></td>
	</tr>
  </table>

  <table class="Tbl0"><tr><td class="Td0" align='center'>PROCEDIMIENTOS QUIRURGICOS REALIZADOS</td></tr></table><br>
  <table class='Tbl0'>
    <th class='Th0' width='2%'>Sel</th>
    <th class='Th0' width='8%'>Código</th>
    <th class='Th0' width='30%'>Descripción</th>
	<th class='Th0' width='5%'>Cant</th>
	<th class='Th0' width='15%'></th>
	<?
	//****Aquicalculo genero los procedimientos qx
	$consultacir=mysql_query("SELECT cir.iden_qxf,cir.ccup_cir,map.desc_map
	FROM detalle_cirujia AS cir
	INNER JOIN mapii AS map ON map.codi_map=cir.ccup_cir
	WHERE cir.iden_qxf='$iden_qxf'");
	$contc=0;
	while($rowcir=mysql_fetch_array($consultacir)){
	  echo "<tr>";
	  //$var="iden_cir".$contc;
	  //echo "<input type=hidden name=$var value=$rowcir[iden_evo]>";
	  $var="chkcir".$contc;
	  echo "<td class='Td2'><input type='checkbox' name='$var'></td>";
	  $var="codigo".$contc;
	  echo "<td class='Td2'><input type='text' name='$var' size='8' disabled value='$rowcir[ccup_cir]'></td>";
	  $var="desc_con".$contc;
	  echo "<td class='Td2'><input type='text' name='$var' size='100' disabled value='$rowcir[desc_map]'></td>";
	  echo "<td class='Td2' align='center'>1</td>";
	  echo "</tr>";
	  $contc++;
	}
    mysql_free_result($consultacir);
	?>
  </table>
  <br>
  <table class='Tbl2'>
    <tr>
	  <td class='Td1' width='5%'></td>
      <td class='Td1' width='30%'><a href='#' onclick='validag(<?echo $contc;?>)'><img hspace=0 width=20 height=20 src='icons\feed_disk.png' alt='Subir los elementos seleccionados' border=0 align='center'>Subir Prefactura</a></td>
  	  <td class='Td1' width='30%'><a href="fac_3prefac.php?iden_qxf=<?echo $iden_qxf;?>">Finalizar<img hspace=0 width=20 height=20 src='icons\feed.png' alt='Cancelar' border=0 align='center'></a></td>
      <td class='Td1' width='30%'><a href='fondo.php'>Cancelar<img hspace=0 width=20 height=20 src='icons\feed.png' alt='Cancelar' border=0 align='center'></a></td>
	  <td class='Td1' width='5%'></td>
    </tr>
  </table>
  <input type='hidden' name='iden_qxf' value='<?echo $iden_qxf;?>'>
  <input type='hidden' name='contc' value='<?echo $contc;?>'>
  <input type='hidden' name='codi_usu' value='<?echo $row[codi_usu];?>'>
  <script language='javascript'>
  form1.iden_ctr.value='<?echo $iden_ctr;?>';
  form1.tipo_fac.value='<?echo $tipo_fac;?>';
  form1.cod_cie10.value='<?echo $cod_cie10;?>';
  </script>
  <?
}
mysql_free_result($consulta);
mysql_close();
?>

</form>
</body>
</html>