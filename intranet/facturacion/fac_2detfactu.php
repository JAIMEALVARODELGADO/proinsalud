<?php
session_start();
session_register('iden_fac');
session_register('tipo_');
session_register('cont_');
session_register('servi_');
if(!empty($servi_dfa)){
  $servi_=$servi_dfa;
}
//echo "<br>".$servi_;
//echo $cont_;
$tipo_=$tipo_dfa;
//$cont_=$contrato;
//echo "<br>tipo:".$tipo_;
//echo "<br>contrato:".$cont_;
if(empty($Gidusufac)){
  ?>
  <script language='javascript'>
  alert("La sesion ha finalizado, porfavor ingrese nuevamente a la aplicaci�n");
  window.top.close();
  </script>
  <?
}
?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="css/estyles.css">
<link rel="stylesheet" type="text/css" href="css/jquery.autocomplete.css">
<script type="text/javascript" src="js/jquery.js"></script>
<script type='text/javascript' src='js/jquery.autocomplete.js'></script>
<script type="text/javascript">
$().ready(function() {
	
	$("#course").autocomplete("fac_autocomp2.php", {
		width: 460,
		matchContains: false,
		mustMatch: false,
		selectFirst: false
	});
	
	$("#course").result(function(event, data, formatted) {
		$("#course_val").val(data[1]);
		$("#course_val2").val(data[2]);
	});
        
        $("#course3").autocomplete("fac_autocompmedi.php", {
		width: 260,
		matchContains: false,
		mustMatch: false,
		selectFirst: false
	});
        $("#course3").result(function(event, data, formatted) {
		$("#course_val3").val(data[1]);		
	});
});
</script>
<SCRIPT LANGUAGE=JavaScript>
function totalizargr(pos){
var comando='';
comando="form1.codichk"+pos+".checked";
if(eval(comando)==true){
    comando="form1.valo_tco.value=parseInt(form1.valo_tco.value)+parseInt(form1.valorg"+pos+".value)";
    eval(comando);
    comando="form1.codichk"+pos+".value=form1.codigo"+pos+".value";
    eval(comando);
}
else{
    comando="form1.valo_tco.value=parseInt(form1.valo_tco.value)-parseInt(form1.valorg"+pos+".value)";
    eval(comando);
    comando="form1.codichk"+pos+".value=''";
    eval(comando);
}
//comando="form1.valuni.value=parseInt(form1.valuni.value)+parseInt(form1.valorg"+pos+".value)";
comando="form1.valuni.value=form1.valo_tco.value";
eval(comando);

comando="form1.vato_fac.value=form1.valuni.value";
eval(comando);

}

function calculatot(){
    var comando;
    var valor_;
    valor_=0;
    for(cont_=0;cont_<5;cont_=cont_+1){
        comando="form1.codichk"+cont_+".checked";
        if(eval(comando)==true){
            comando="form1.valorg"+cont_+".value";
            valor_=valor_+parseInt(eval(comando));
            comando="form1.valo_tco.value=valor_";
            eval(comando);
        }
    }
}

function validacod(){
  form1.submit();
}
function calcular() {
 form1.vato_fac.value = form1.can_fac.value*form1.valuni.value;
}

function validag(){
var error='';
  if(form1.iden_tco.value==''){error=error+'Debe seleccionar la actividad\n'}
  if(form1.tipo_dfa.value==''){error=error+'Tipo\n'}
  if(form1.can_fac.value==''){error=error+'Cantidad\n'}
  if(form1.servi_dfa.value==''){error=error+'Servicio\n'}  
  if(form1.medico.value==''){document.form1.cod_medi.value=''}  
  if(error!=''){alert("Para guardar debe llenar la siguiente información\n\n"+error);}
  else{
    form1.action='fac_2guardadeta.php';
    form1.submit();
  }
}


function eliminar(codeli,detal){
  if (confirm("Desea Eliminar el registro?\n" +detal)){
    location.href='fac_2elimap.php?iden_dfa='+codeli;
  }
}

function finaliza(){
  form1.action='fac_2finalfactu.php';
  form1.submit();
}
function tomaval(){
  form1.valuni.value=form1.valo_tco.value;
}

function activar(iden_dfa_){
  var campochk_='chk'+iden_dfa_;
  var campoimg_='imagen'+iden_dfa_;
  var campo_='nauto_dfa'+iden_dfa_;
  var cmd_;
  cmd_="document.form1."+campochk_+".checked";
  if(eval(cmd_)==true){
    cmd_="document.form1."+campoimg_+".hidden=false";
    eval(cmd_);
    cmd_="document.form1."+campo_+".disabled=false";  
    eval(cmd_);
    cmd_="document.form1."+campo_+".focus()";  
    eval(cmd_);
  }
  else{
    cmd_="document.form1."+campoimg_+".hidden=true";
    eval(cmd_);
    cmd_="document.form1."+campo_+".disabled=true";  
    eval(cmd_);
  }
}

function vali_guardaauto(iden_dfa_){
  var campo_='nauto_dfa'+iden_dfa_;
  var cmd_;
  var valor_;
  cmd_="document.form1."+campo_+".value";
  valor_=eval(cmd_);  
  window.open("fac_2guardaauto.php?iden_dfa="+iden_dfa_+"&nauto_dfa="+valor_,"_self");
}
</script>
</head>
<body>
<form name="form1" method="POST" action="fac_2detfactu.php" target='fr02'>
<link rel="stylesheet" href="css/style.css" type="text/css" />
<?
$datos[0]='desc_';
$datos[1]='iden_';
$datos[2]='valo_';
$datos[3]='tarco';
include('php/conexion.php');
include('php/funciones.php');
$consulta="SELECT u.CODI_USU,u.NROD_USU, u.PNOM_USU, u.SNOM_USU, u.PAPE_USU, u.SAPE_USU, u.FNAC_USU,
						ef.iden_fac, ef.tipo_fac, ef.feci_fac, ef.fecf_fac, ef.codi_usu, ef.iden_ctr, ef.cod_cie10, ef.esta_fac, ct.nume_ctr,ef.nauto_fac,
						ct.fmpr_ctr,ct.fmme_ctr,ct.fmin_ctr
						FROM encabezado_factura as ef
						INNER JOIN usuario as u ON u.CODI_USU=ef.codi_usu
						INNER JOIN contratacion as ct ON ct.iden_ctr=ef.iden_ctr 
						WHERE ef.iden_fac='$iden_fac'";
//echo $consulta;
$consulta= mysql_query($consulta);
$row=mysql_fetch_array($consulta);
$cont_=$row[iden_ctr];
//echo $cont_;
echo "<table class='Tbl0'> ";
echo "<tr>
<td class='Td2'><strong>Nombre:</strong> $row[PNOM_USU] $row[SNOM_USU] $row[PAPE_USU] $row[SAPE_USU]</td>
<td class='Td2'><strong>Edad:</strong> ".calculaedad($row[FNAC_USU])."</td>
<td class='Td2'><strong>Fecha Inicio:</strong> ".cambiafechadmy($row[feci_fac])."</td>
<td class='Td2'><strong>Fecha Final:</strong> ".cambiafechadmy($row[fecf_fac])."</td>
<td class='Td2'><strong>Contrataci�n:</strong> $row[nume_ctr]</td></tr></table>";

//Aqui comienzo la lectura del item a facturar
echo "<br><table class='Tbl0'> ";
echo "
<th class='Th0' width='5%'>TIPO</th>
<th class='Th0' width='60%'>NOMBRE</th>
<th class='Th0' width='5%'>CANT</th>
<th class='Th0' width='10%'>VR UNITARIO</th>
<th class='Th0' width='10%'>VR TOTAL</th>
<th class='Th0' width='10%'>AUTORIZACION</th>";

echo "<tr>";
echo "<td class='Td2' align='left'><select name='tipo_dfa' onchange='form1.submit()'>
  <option value=''>
  <option value='I'>Insumo
  <option value='M'>Medicamento
  <option value='P'>Procedimiento
</select></td>";
echo "<td class='Td2' align='left'>";
//*********Captura autocompletado
echo "<input type='text' id='course' class='texto' name='descrip' size='100' value='$descrip'>";
echo "<input type='hidden' id='course_val' name='iden_tco' value='$iden_tco'>";
//echo "<input type='text' id='course_val2' name='valo_tco' value='$valo_tco'>";
$consultatco='';
switch ($tipo_dfa){
  case 'P':
	$consultatco="SELECT map.desc_map as desc_, tar.valo_tco as valo_, tar.grqx_tco,tar.iden_ctr 
	FROM tarco AS tar 
	INNER JOIN mapii AS map ON map.iden_map=tar.iden_map 
	WHERE tar.iden_tco=$iden_tco";
	$fac_manual=$row[fmpr_ctr];
	break;
  case 'I':
	$consultatco="SELECT ins.codi_ins as codi_,ins.desc_ins as desc_,tar.valo_tco AS valo_ 
	FROM insu_med AS ins
	INNER JOIN tarco AS tar ON tar.iden_map=ins.codi_ins
	WHERE tar.iden_tco=$iden_tco";
	$fac_manual=$row[fmin_ctr];
	break;
  case 'M':
	$consultatco="SELECT mdi.codi_mdi as codi_,CONCAT(mdi.nomb_mdi,' ',mdi.noco_mdi) as desc_,tar.valo_tco AS valo_ 
	FROM medicamentos2 AS mdi
	INNER JOIN tarco AS tar ON tar.iden_map=mdi.codi_mdi
	WHERE tar.iden_tco=$iden_tco";
	$fac_manual=$row[fmme_ctr];
	break;
}
//echo "<br>CONSULTA: <br>".$consultatco;
//if(!empty($consultatco)){
if(!empty($iden_tco)){
  $consultatco=mysql_query($consultatco);
  if(mysql_num_rows($consultatco)<>0){
    $rowtco=mysql_fetch_array($consultatco);
    $valor=$rowtco[valo_];}    
}
echo "</td>";
echo "<td class='Td2' aling='center' width='5%'><input type=text name=can_fac size=6 maxlength=6 value='$can_fac' onfocus='tomaval()' onblur='validacod()' onkeypress='if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;'></td>";
//onblur='calcular()'

if($fac_manual=='S'){
  echo "<td class='Td2' width='5%'><input type='text' name=valo_tco size=10 value ='$valor' onkeypress='if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;'>";
  echo "</td>";
}
else{
  echo "<td class='Td2' width='5%'><input type='hidden' id='course_val2' name='valo_tco' size='10' value ='$valo_tco'>";
  echo "<input type='text' name='valuni' value='$valor' disabled></td>";  
}
echo "<td class='Td2' width='5%'><input type=text name=vato_fac disabled></td>";
echo "<td class='Td2' width='5%'><input type=text name=nauto_dfa value='$row[nauto_fac]'></td>";
echo "</tr>";
echo "</table>";

echo "<table>";
echo "<tr>";

echo "<td class='Td2' align='right'><b>Servicio:</td>";
echo "<td class='Td2' align='left'>
  <select name='servi_dfa'><option value=''></option>";
      $consulta=mysql_query("SELECT codi_des,nomb_des FROM destipos WHERE codt_des='06' order by nomb_des ");
      while($row=mysql_fetch_array($consulta)){
          echo "<option value='$row[codi_des]'>$row[nomb_des]</option>";
      }
echo "</select>";
echo "</td>";
//echo "<td class='Td2' align='right'><b>Fecha de prestacion del servicio:</td>";
//echo "<td class='Td2' align='left'><input type='date' name=fecservi_dfa value=$fecha_></td>";


echo "<td class='Td2' align='right'><b>Profesional:</td>";
echo "<td class='Td2' align='left'>";
echo "<input type='text' id='course3' class='texto' name='medico' size='100' value='$medico'>";
echo "<input type='hidden' id='course_val3' name='cod_medi' value='$cod_medi'>";
echo "</tr>";

echo "</table>";
echo "<input type=hidden name=grupo value=$rowtco[grqx_tco]>";
echo "<input type=hidden name=contrato value=$cont_>";
if (!empty($rowtco[grqx_tco])){
  echo "<table class='Tbl0' align='center' border='0'>";
  $consgru="SELECT grp.iden_gxc,grp.iden_ctr,grp.iden_gqx,grp.desc_gxc,grp.valo_gxc,gru.grup_gqx FROM grupoxcont AS grp
		  INNER JOIN grupoqx AS gru ON gru.iden_gqx=grp.iden_gqx
		  WHERE iden_ctr='$cont_' and gru.grup_gqx='$rowtco[grqx_tco]' ORDER BY iden_gqx";
  //echo "<br>".$consgru;
  $sqlgru=mysql_query($consgru);
  $i=0;
  while($rowgru=mysql_fetch_array($sqlgru)){
    echo "<tr align=center>";
    $var='codigo'.$i;
	echo "<input type='hidden' name='$var' value='$rowgru[iden_gxc]'>";
	$var='codichk'.$i;
	echo "<td class='Td2' width='20%' align='right'><input name=$var type=checkbox checked onclick='totalizargr($i)' value='$rowgru[iden_gxc]'></td>";
	echo "<td class='Td2' width='20%' align='left'>$rowgru[desc_gxc]</td>";
	$var='valorg'.$i;
	echo "<td class='Td2' width='60%' align='left'>";
        if($fac_manual=='S')
		{
            echo "<input name=$var type='text' value='$rowgru[valo_gxc]' size='8' maxlength='8' onblur='calculatot()' onkeypress='if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;'>";
        }
        else
		{
            echo "<input name=$var type='hidden' value='$rowgru[valo_gxc]' size='8' maxlength='8' onblur='calculatot()'>$rowgru[valo_gxc]";
        }
        echo "</td></tr>";
	$totgru=$totgru+$rowgru[valo_gxc];
	$i++;
  }
  echo "<input type='hidden' name='i' value='$i'>";
  echo"</table>";
  ?>
	<script language=JavaScript>
      form1.valo_tco.value='<?echo $totgru;?>';
      form1.valuni.value='<?echo $totgru;?>';
      form1.tipo_dfa.value='<?echo $tipo_dfa;?>';      
  </script> 
  <?
}
?>
<script language=JavaScript>
form1.tipo_dfa.value='<?echo $tipo_dfa;?>';
form1.vato_fac.disabled=true;
form1.servi_dfa.value='<?echo $servi_;?>';

calcular();
</script> 

<table class='Tbl2'>
  <tr>
    <td class='Td1' width='45%'><a href='#' onclick='validag()'><img hspace=0 width=20 height=20 src='icons/feed_disk.png' alt='Guardar' border=0 align='center'>Guardar</a></td>
    <td class='Td1' width='45%'><a href='#' onclick='finaliza()'> Finalizar<img hspace=0 width=20 height=20 src='icons/feed.png' alt='Cancelar' border=0 align='center'></a></td>
  </tr>
</table>
<?

//Aqui se muestra el listado de items facturados
echo "<table class='Tbl0'>";
echo "
<th class='Th0' colspan='2'>OPCIONES</th>
<th class='Th0'>CODIGO</th>
<th class='Th0'>SERVICIO</th>
<th class='Th0'>NOMBRE</th>
<th class='Th0'>AUTORIZACION</th>
<th class='Th0'>CANT</th>
<th class='Th0'>VR UNITARIO</th>
<th class='Th0'>VR TOTAL</th>
<th class='Th0'>PROFESIONAL</th>";
$total=0;
/*$consultadet=mysql_query("SELECT dfa.iden_dfa,dfa.tipo_dfa,dfa.iden_tco, dfa.desc_dfa,dfa.cant_dfa,dfa.valu_dfa,dfa.nauto_dfa,med.nom_medi
                          FROM detalle_factura AS dfa 
                          LEFT JOIN medicos AS med ON med.cod_medi=dfa.cod_medi
                          LEFT JOIN destipos AS serv ON serv.codi_des=detalle_factura.servi_dfa
                          WHERE iden_fac=$iden_fac ORDER BY dfa.tipo_dfa");*/
$consultadet="SELECT dfa.iden_dfa,dfa.tipo_dfa,dfa.iden_tco, dfa.desc_dfa,dfa.cant_dfa,dfa.valu_dfa,dfa.nauto_dfa,med.nom_medi,serv.nomb_des AS nomb_servicio
                          FROM detalle_factura AS dfa 
                          LEFT JOIN medicos AS med ON med.cod_medi=dfa.cod_medi
                          LEFT JOIN destipos AS serv ON serv.codi_des=dfa.servi_dfa
                          WHERE iden_fac='$iden_fac' ORDER BY dfa.tipo_dfa";
//echo "<br>".$consultadet;
$consultadet=mysql_query($consultadet);

while ($rowdet=mysql_fetch_array($consultadet)){
  echo "<tr>";
  echo "<td><a href='#' onclick=\"eliminar('$rowdet[iden_dfa]','$rowdet[desc_dfa]')\" title='Elimiar Registro'><img hspace=0 width=15 height=15 src='icons/feed_delete.png' alt='Borrar' border=0 align='center'></a></td>";

  
  $var='chk'.$rowdet[iden_dfa];  
  echo "<td><input type='checkbox' name='$var' title='Editar Autorizaci�n' onclick='activar($rowdet[iden_dfa])'>";
 // <a href='#' onclick=\"Activar('$rowdet[iden_dfa]','$rowdet[desc_dfa]')\" title='Editar Autorizaci�n'><img hspace=0 width=15 height=15 src='icons/feed_delete.png' alt='Editar' border=0 align='center'></a>
  echo "</td>";
  
  $codi_=$rowdet[iden_tco];
  switch ($rowdet[tipo_dfa]){
    case 'P':
            $consultacod="SELECT codi_cup,codi_map FROM mapii AS map
            INNER JOIN tarco AS trc ON map.iden_map=trc.iden_map
            INNER JOIN cups AS cups ON cups.codigo=map.codi_map
            WHERE trc.iden_tco=$rowdet[iden_tco]";
            //echo "<br>".$consultacod;
            $consultacod=mysql_query($consultacod);
            if(mysql_num_rows($consultacod)<>0){
                $rowcod=mysql_fetch_array($consultacod);
                $codi_=$rowcod[codi_cup];
            }
            mysql_free_result($consultacod);
            break;
	case 'M':
	  $consultacod=mysql_query("SELECT mdi.codi_mdi FROM medicamentos2 AS mdi
	              INNER JOIN tarco AS trc ON trc.iden_map=mdi.codi_mdi
				  WHERE trc.iden_tco=$rowdet[iden_tco]");
            if(mysql_num_rows($consultacod)<>0){
	    $rowcod=mysql_fetch_array($consultacod);
	    $codi_=$rowcod[codi_mdi];
	  }
	  mysql_free_result($consultacod);
	  break;
  	case 'I':
	  $consultacod=mysql_query("SELECT ins.codnue FROM insu_med AS ins
            INNER JOIN tarco AS trc ON trc.iden_map=ins.codi_ins
            WHERE trc.iden_tco=$rowdet[iden_tco]");
      if(mysql_num_rows($consultacod)<>0){
	    $rowcod=mysql_fetch_array($consultacod);
	    $codi_=$rowcod[codnue];
	  }
	  mysql_free_result($consultacod);
	  break;
  }
  //echo "<br>".$rowdet[iden_dfa];
  echo "<td class='Td2' align='left'>$codi_</td>";
  //echo "<td class='Td2' align='left'>".cambiafechadmy($rowdet[fecservi_dfa])."</td>";
  echo "<td class='Td2' align='left'>$rowdet[nomb_servicio]</td>";  
  echo "<td class='Td2'>$rowdet[desc_dfa]</td>";
  $var='nauto_dfa'.$rowdet[iden_dfa];  
  echo "<td class='Td2'><input type text name='$var' size='15' maxlength='15' value='$rowdet[nauto_dfa]' disabled='ture'>";
  echo "<a href='#' onclick='vali_guardaauto($rowdet[iden_dfa])' title='Guarda Autorizaci�n'>";
  $var='imagen'.$rowdet[iden_dfa];
  echo "<img hspace=0 width=10 height=10 src='icons/feed_disk.png' alt='Guardar' border=0 align='center' name='$var' hidden=true>";
  echo "</a>";

  echo"</td>";
  //$rowdet[nauto_dfa]
  echo "<td class='Td2' align='right'>$rowdet[cant_dfa]</td>";
  echo "<td class='Td2' align='right'>".number_format($rowdet[valu_dfa],0)."</td>";
  echo "<td class='Td2' align='right'>".number_format($rowdet[cant_dfa]*$rowdet[valu_dfa],0)."</td>";
  echo "<td class='Td2' align='right'>$rowdet[nom_medi]</td></tr>";
  $total=$total+$rowdet[cant_dfa]*$rowdet[valu_dfa];
}
echo "<tr>";
echo "<td class='Td4'></td>";
echo "<td></td>";
echo "<td class='Td2'></td>";
echo "<td class='Td2'></td>";
echo "<td class='Td2'></td>";
echo "<td class='Td2' align='right'><b>Total</td>";
echo "<td class='Td2' aling='center'></td>";
echo "<td class='Td2'></td>";
echo "<td class='Td2' align='right'><b><input type=hidden name=total value=$total>".number_format($total,0)."</td></tr>";
echo "</table>";

mysql_free_result($consulta);
//if(!empty($consultatco)){
if(!empty($iden_tco)){
    mysql_free_result($consultatco);
}
mysql_close();
?>
</form>
</body>
</html>