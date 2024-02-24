<html>
<head>
<title>PROGRAMA DE FACTURACIÓN - PROFACTU</title>
<SCRIPT LANGUAGE=JavaScript>
function validag(){
form1.action='fac_3guardapref.php';
form1.submit();
}
function cargacod(cont_){
var comand="";
comand="form1.codi_dfa"+cont_+".checked";
if(eval(comand)==true){
  comand="form1.codi_dfa"+cont_+".value=form1.codigo"+cont_+".value";
  eval(comand);
}
else{
  comand="form1.codi_dfa"+cont_+".value=''";
  eval(comand);
}
}
function activar(cont_){
var campo='',comando='',i=0;
  comando='form1.codi_dfa'+cont_+'.checked';
  if(eval(comando)==true){
    for(i=0;i<=4;i++){
	  campo='codi_via'+cont_+'_'+i;
	  comando="form1."+campo+".disabled=false";
	  eval(comando);
    }
  }
  else{
    for(i=0;i<=4;i++){
	  campo='codi_via'+cont_+'_'+i;
	  comando="form1."+campo+".checked=false";
	  eval(comando);
	  comando="form1."+campo+".disabled=true";
	  eval(comando);
	}
  }
}
</script>

<link rel="stylesheet" href="css/style.css" type="text/css" />
</head>
<body lang=ES  style='tab-interval:35.4pt'  >
<form name="form1" method="POST" action="fac_3prefac.php" target='fr02'>
<table class="Tbl0"><tr><td class="Td0" align='center'>PREFACTURA</td></tr></table><br>
<?
include('php/conexion.php');
include('php/funciones.php');
$condicion="us.codi_usu=uc.cusu_uco AND uc.iden_uco=qx.iden_uco AND uc.cont_uco=con.codi_con AND qx.iden_qxf=$iden_qxf"; 
$consultausu=mysql_query("SELECT qx.iden_qxf,qx.fech_qxf,qx.dxpo_cir,us.tdoc_usu,us.nrod_usu,us.pnom_usu,us.snom_usu,us.pape_usu,us.sape_usu,us.fnac_usu,us.sexo_usu,
        us.codi_usu,us.dire_usu,us.tpaf_usu,us.mate_usu,us.tres_usu,con.neps_con,con.codi_con,
		qx.ccir_qxf,qx.cane_qxf,qx.cay1_qxf,qx.cins_qxf,qx.fina_qxf,qx.ambi_qxf,qx.codi_via,qx.hini_qxf,qx.hfin_qxf
		FROM encabezado_qx AS qx,usuario AS us,ucontrato AS uc,contrato AS con 
		WHERE $condicion");
$row=mysql_fetch_array($consultausu);
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
<?
$existe=0;
$archivo="tmp/af".$iden_qxf.$enti_fac.".txt";
if(file_exists($archivo)){
  $fp = fopen ($archivo, "r" );
  $reg=0;
  while (( $data = fgetcsv ( $fp , 1000 , "|" )) !== FALSE ) { // Mientras hay líneas que leer...
    $reg++;
    $i = 0;
    foreach($data as $dato){
      $campo[$i]=$dato;
      $i++ ;
    }
    $$campo[0]=$campo[1];
  }
}
else{
  $existe=1;
}

?>
<table class='Tbl0' border='0'>
  <tr>
	<td class='Td2' align='right' width='20%'><b>Contrato Nro:</td>
    <td class='Td2' width='20%'><?echo $iden_ctr;?></td>
	<td class='Td2' align='right' width='15%'><b>Tipo de factura:</td>
	<?
	  if($tipo_fac=='1'){$tipo="Contado";}else{$tipo="Crédito";}
	?>
	<td class='Td2' width='15%'><?echo $tipo;?></td>
	<td class='Td2' align='right' width='15%'><b>Relación Nro:</td>
	<td class='Td2' width='15%'><?echo $rela_fac;?></td>
  </tr>
  <tr>
	<td class='Td2' align='right'><b>F. inicio del servicio:</td>
	<td class='Td2'><?echo $feci_fac?></td>
	<td class='Td2' align='right'><b>F. final del servicio:</td>
	<td class='Td2'><?echo $fecf_fac?></td>
  </tr>
  <tr>
    <td class='Td2' align='right'><b>Diagnóstico:</td>
	<td class='Td2' align='left'><?echo $cod_cie10;?> </td>
	<td class='Td2' align='right'><b>Entidad a facturar:</td>
	<td class='Td2' align='left'><select name='enti_fac' onchange='form1.submit()'><option value=''>
	<?
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
	<td></td>
  </tr>
</table>

<table class="Tbl0"><tr><td class="Td0" align='center'>DETALLES</td></tr></table>
<table class='Tbl0'>
  <th class='Th0' width='5%'>Sel</th>
  <th class='Th0' width='10%'>Código</th>
  <th class='Th0' width='75%'>Descripción</th>
  <th class='Th0' width='10%'>Cant/Valor</th>
<?
$c=0;
$cont=0;
$archivo="tmp/qx".$iden_qxf.$enti_fac.".txt";
if(file_exists($archivo)){
  $fp = fopen ($archivo, "r" );
  $reg=0;
  while (( $data = fgetcsv ( $fp , 1000 , "|" )) !== FALSE ){ // Mientras hay líneas que leer...
    $reg++;
    $i = 0;
    foreach($data as $dato){
      $campo[$i]=$dato;
      $i++ ;
    }
    $$campo[0]=$campo[1];
	$c++;
	if($c==1){
	  $font="";
	  $disable="";
	  /*$consultamap="SELECT m.desc_map, tar.iden_tco,tar.iden_ctr,tar.grqx_tco 
      FROM mapii AS m
      LEFT JOIN tarco AS tar ON tar.iden_map = m.iden_map AND tar.iden_ctr =$iden_ctr 
      LEFT JOIN contratacion AS ctr ON ctr.iden_ctr=tar.iden_ctr 
      WHERE m.codi_map = '$codigo'";
	  echo $consultamap;*/
	  $consultamap=mysql_query("SELECT m.desc_map, tar.iden_tco,tar.iden_ctr,tar.grqx_tco 
      FROM mapii AS m
      LEFT JOIN tarco AS tar ON tar.iden_map = m.iden_map AND tar.iden_ctr =$iden_ctr 
      LEFT JOIN contratacion AS ctr ON ctr.iden_ctr=tar.iden_ctr 
      WHERE m.codi_map = '$codigo'");
	  $rowmap=mysql_fetch_array($consultamap);
	  if($rowmap[iden_ctr]==""){
	    $font="<font color='#CC9933'>";
		$disable="disabled";
	  }
	  echo "<tr>";
	  $var="codi_dfa".$cont;
	  echo "<td class='Td2'><input type='checkbox' name='$var' $disable onclick='activar($cont)'></td>";
	  $var="iden_tco".$cont;
	  echo "<input type='hidden' name='$var' value='$rowmap[iden_tco]'>";
	  echo "<td class='Td2'>$font $codigo</td>";
	  
	  echo "<td class='Td2'>$font $rowmap[desc_map]</td>";
	  $var="cant_dfa".$cont;
	  echo "<td class='Td2'><input type='hidden' name='$var' value='$cant_dfa'>$font 1</td>";
	  echo "</tr>";
	  $contser=0;
	  /*$consgrp="SELECT gqx.desc_gqx,gcon.valo_gxc,gqx.campo_gqx,gcon.iden_gxc 
	  FROM grupoqx AS gqx
	  INNER JOIN grupoxcont AS gcon ON gcon.iden_gqx=gqx.iden_gqx
	  WHERE gqx.grup_gqx='$rowmap[grqx_tco]'";
	  echo $consgrp;*/
	  $consgrp=mysql_query("SELECT gqx.desc_gqx,gcon.valo_gxc,gqx.campo_gqx,gcon.iden_gxc 
	  FROM grupoqx AS gqx
	  INNER JOIN grupoxcont AS gcon ON gcon.iden_gqx=gqx.iden_gqx
	  WHERE gqx.grup_gqx='$rowmap[grqx_tco]'");
	  while($rowgrp=mysql_fetch_array($consgrp)){
	    echo "<tr>";
		echo "<td class='Td2'></td>";
		$var="codi_via".$cont."_".$contser;
		echo "<td class='Td2' align='right'><input type='checkbox' name='$var' disabled></td>";
		echo "<td class='Td2'>$rowgrp[desc_gqx]</td>";
		$var='iden_gxc'.$cont."_".$contser;;
		echo "<input type='hidden' name='$var' value='$rowgrp[iden_gxc]'>";
		$valor=0;
		
		//if($reg==1){
		//  echo "<td class='Td2'>$rowgrp[valo_gxc]</td>";
		//  $valor=$rowgrp[valo_gxc];}
		//else{
		  switch ($rowgrp[campo_gqx]){
		    case 1:
			  $var='ciru_via';
			  break;  
		    case 2:
			  $var='anes_via';
			  break;
		    case 3:
			  $var='ayud_via';
			  break;
		    case 4:
			  $var='sala_via';
			  break;
		    case 5:
			  $var='mate_via';
			  break;
		  }
		  //$consultavia="SELECT ".$var." FROM vias_qx WHERE codi_via='$row[codi_via]'";
		  //echo "<br>".$consultavia;		  
		  $consultavia=mysql_query("SELECT ".$var." FROM vias_qx WHERE codi_via='$row[codi_via]'");
		  $rowporce=mysql_fetch_array($consultavia);
		  $valor=$rowgrp[valo_gxc]*($rowporce[$var]/100);
		  echo  "<td class='Td2'>$valor</td>";
		//}
		$var="valor".$cont."_".$contser;
		echo "<input type='hidden' name='$var' value='$valor'>";
		echo "</tr>";
		$contser++;
	  }
	  $c=0;
	  $cont++;
    }
  }
  ?>
  <table class='Tbl2'>
    <tr>
	  <td class='Td1' width='20%'></td>
      <td class='Td1' width='30%'><a href='#' onclick='validag()'><img hspace=0 width=20 height=20 src='icons\feed_disk.png' alt='Subir los elementos seleccionados' border=0 align='center'>Prefacturar</a></td>
      <td class='Td1' width='30%'><a href='fondo.php'>Cancelar<img hspace=0 width=20 height=20 src='icons\feed.png' alt='Cancelar' border=0 align='center'></a></td>
	  <td class='Td1' width='20%'></td>
    </tr>
  </table>
  <?
}
else{
  $existe=1;
}
?>
</table>
<input type='hidden' name='iden_qxf' value='<?echo $iden_qxf;?>'>
<input type='hidden' name='cont' value='<?echo $cont;?>'>
<script language='javascript'>
  form1.enti_fac.value='<?echo $enti_fac;?>';
</script>

<?
if($existe==1){
  echo "<br><br><br>";
  echo "<table class='Tbl2'>";
  echo "<tr>";
  echo "<td class='Td4'><b>No hay prefactura seleccionada para este ingreso con esta entidad</td>";
  echo "</tr>";
  echo "<table>";
}
?>
</form>
</body>
</html>