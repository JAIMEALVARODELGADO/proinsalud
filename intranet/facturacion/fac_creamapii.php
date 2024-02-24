<?php 
session_start();
session_register('codi_mapii');
session_register('des_mapi');
session_register('nive_map');
session_register('pos_map');
session_register('mapi_map');
session_register('grumap_map');
session_register('nivmap_map');
session_register('codi_soat');
session_register('grusoa_map');
session_register('valsoa_map');
session_register('is1_mapi');
session_register('uvriss_map');
session_register('valiss_map');
session_register('is4_mapi');
session_register('cconcir_map');
session_register('cconane_map');
session_register('cconayu_map');
session_register('cconder_map');
session_register('cconmat_map');
session_register('clas_map');
session_register('espe_map');
session_register('form_mapi');

/*
session_register('cod_con');
session_register('sbcla_map');
*/

if(!empty($cod_mapii)){$codi_=$codi_mapii;}
if(!empty($codi_cup)){$codi_cup=$codi_cup;}
//if(!empty($des_mapi)){$desc_=$des_mapi;}
if(!empty($codi_)){$codi_mapii=trim($codi_);}
if(!empty($desc_)){$des_mapi=trim($desc_);}

switch($vcod){
  case '2':
    if(!empty($codigo_)){$codi_soat=trim($codigo_);}
	break;
  case '3':
    if(!empty($codigo_)){$is1_mapi=trim($codigo_);}
	break;
  case '4':
    if(!empty($codigo_)){$is4_mapi=trim($codigo_);}
	break;
}

?>
<html>
<head>
<title>PROGRAMA DE FACTURACIÓN</title>
</head>
<link rel="stylesheet" href="css/style.css" type="text/css" />
<script language="javaScript">
marcadorpos=false
function validar(){
var error="";
  if(form1.cod_mapi.value==""){error=error+"Código CUPS\n";} 
  if(form1.desc_mapii.value==""){error=error+"Descripción\n";} 
  if(form1.nivl_.value==""){error=error+"Nivel (CUPS)\n";} 
  if(!marcadorpos){error=error+"POS \n";} 
  if(form1.cconcir_.value==""){error=error+"Código Contable de la Actividad\n";} 
  if(form1.clas_mapii.value==""){error=error+"Clase\n";} 
  if(form1.espe_.value==""){error=error+"Especialidad\n";} 
  if(form1.forma.value==""){error=error+"Forma\n";} 
  if(error!=""){
    alert("Para continuar debe completar la siguiente información:\n\n"+error);}
  else{
    form1.action="facguardamapii.php";
	form1.submit();}
}

function valida2(op){
//if(form1.clas_mapii.value==""){
//  alert ("Debe selecionar la Clase");}
//else{
  if(op==1){
    form1.vcod.value=op;
    document.form1.codi_cup.enabled=true;
    form1.submit();}
  else{
    form1.vcod.value=op;
    form1.action="bus_soamapii.php";
    form1.submit();}
  //}
}

function validaniv(niv){
  form1.nivl_.value=niv;
}
function validaforma(forma){
  form1.forma.value='<?echo $form_mapi;?>';
}
function validaclase(){
  if (form1.sclas_mapii.value=='0109' || form1.sclas_mapii.value=='0111' || form1.sclas_mapii.value=='0112' || form1.sclas_mapii.value=='0113' )
    {
    //alert(form1.sclas_mapii.value);
    form1.soat_map.value='';
    form1.iss1_mapii.value='';
    form1.iss4_mapii.value='';
    form1.soat_map.disabled=true;
    form1.iss1_mapii.disabled=true;
    form1.iss4_mapii.disabled=true;
  }
  else
  {
    form1.soat_map.disabled=false;
    form1.iss1_mapii.disabled=false;
    form1.iss4_mapii.disabled=false;
  }
}
function validapos(){
var pos_='<?echo $pos_map;?>';
  form1.pos_.value='<?echo $pos_map;?>';
  if(pos_=='S'){form1.pos_[0].checked=true;}
  else{form1.pos_[1].checked=true;}
  marcadorpos=true;
}
</script>

<body>
<?
include('php/conexion.php');
?>
<form method="post" name="form1" action="bus_cupsmapii.php">
<center>
<table class="Tbl0"><tr><td class="Td0" align='center'>INGRESO DE NUEVO PROCEDIMIENTO</td></tr></table>
<br>
<table class="Tbl0" border='0'>
<tr>
  <td class="Td2" align='right'>Código</td>
  <td class="Td2" align='left'><input type='hidden' name='cod_mapi' size='10' maxlength='14' value=<?echo $codi_mapii?>>
  <input type='text' name='codi_cup' size='10' maxlength='14' value='<?echo $codi_cup?>' disabled='true'>
  <a href='#' onclick= 'valida2(1)'><img src='icons/feed_magnify.png' border='0' alt='Busqueda Cups'></a></td>
</tr>
<tr>
  <td class="Td2" align='right'>Descripción</td>
  <td class="Td2" align='left'><input type='text' name='desc_mapii' size='60' maxlength='250' value="<?echo $des_mapi;?>"></td>
</tr>

<tr>
  <td class="Td2" align='right'>Nivel (CUPS)De Complejidad </td>
  <td class="Td2" align='left'><select name='nivl_'><option value=''>
      <option value='1'>I Nivel
      <option value='2'>II Nivel
      <option value='3'>III Nivel
      <option value='4'>IV nivel
    </select></td>
</tr>
<script language="javaScript">validaniv(<?echo $nive_map?>);</script>
<tr>
  <td class="Td2" align='right'>POS</td>
  <td class="Td2" align='left'>
    <input type='radio' name='pos_' value='S' onclick='marcadorpos=true'>Si<br>
	<input type='radio' name='pos_' value='N' onclick='marcadorpos=true'>No
  </td>
  <td><input type='checkbox' name='valicups'>No Validar Código CUPS</td>
</tr>
</table>

<table class="Tbl0" border='1'>
<th class='Th0' width='50%'>Homologación MAPIPOS</th>
<th class='Th0' width='50%'>Homologación SOAT</th>
<tr>
  <td>
    <table class="Tbl0" border='0'>
      <tr>
        <td class="Td2" align='right'>Código MAPIPOS </td>
        <td class="Td2" align='left'><input type='text' name='mapi_' size='6' maxlength='6' value='<?echo $mapi_map;?>'></td>
	  </tr>
	  <tr>
	    <td class="Td2" align='right'>Grupo MAPIPOS</td>
  	    <td class="Td2" align='left'><select name='grumap_'><option value=''>
      	  <option value='01'>01
      	  <option value='02'>02
      	  <option value='03'>03
	  	  <option value='04'>04
      	  <option value='05'>05
	  	  <option value='06'>06
	  	  <option value='07'>07
	  	  <option value='08'>08
	  	  <option value='09'>09
	  	  <option value='10'>10
	  	  <option value='11'>11
	  	  <option value='12'>12
	  	  <option value='13'>13
	  	  <option value='14'>14
	  	  <option value='15'>15
	  	  <option value='16'>16
	  	  <option value='17'>17
	  	  <option value='18'>18
	  	  <option value='19'>19
	  	  <option value='20'>20
	  	  <option value='21'>21
	  	  <option value='22'>22
	  	  <option value='23'>23
    	  </select></td>
	  </tr>	  
	  <tr>
  	    <td class="Td2" align='right'>Nivel MAPIPOS</td>
  	    <td class="Td2" align='left'><select name='nivmap_'><option value=''>
      	  <option value='1'>I Nivel
      	  <option value='2'>II Nivel
      	  <option value='3'>III Nivel
      	  <option value='4'>IV nivel
    	  </select></td>
	  </tr>
    </table>
  </td>
  <td>
    <table class="Tbl0" border='0'>
      <tr>
        <td class="Td2" align='right'>Código SOAT</td>
        <td class="Td2" align='left'><input type='text' name='soat_map' size='10' maxlength='10' value=<?echo $codi_soat;?>>
        <a id='btn1' href='#' onclick= 'valida2(2)'><img src='icons/feed_magnify.png' border='0' alt='Busqueda Soat'></a>&nbsp;
        <?
        $cons1=mysql_query("select desc_tar from soat WHERE codi_tar='$codi_soat'");
        while ($row = mysql_fetch_array($cons1)){
          echo strtoupper($row[desc_tar]); }
		?>
		</td>
      </tr>
      <tr>
        <td class="Td2" align='right'>Grupo SOAT</td>
        <td class="Td2" align='left'><select name='grusoa_'><option value=''>
          <option value='01'>01
          <option value='02'>02
          <option value='03'>03
	      <option value='04'>04
          <option value='05'>05
	      <option value='06'>06
	      <option value='07'>07
	      <option value='08'>08
	      <option value='09'>09
	      <option value='10'>10
	      <option value='11'>11
	      <option value='12'>12
	      <option value='13'>13
	      <option value='14'>14
	      <option value='15'>15
	      <option value='16'>16
	      <option value='17'>17
	      <option value='18'>18
	      <option value='19'>19
	      <option value='20'>20
	      <option value='21'>21
	      <option value='22'>22	
          </select></td>
      </tr>
      <tr>
        <td class="Td2" align='right'>Valor SOAT</td>
        <td class="Td2" align='left'><input type='text' name='valsoa_' size='7' maxlength='7' onkeypress='if (event.keyCode <45 || event.keyCode  >57) event.returnValue = false' value='<?echo $valsoa_map;?>'></td>
      </tr>
	  
    </table>
  </td>
</tr>
</table>

<table class="Tbl0" border='1'>
<th class='Th0' width='50%'>Homologación ISS</th>
<th class='Th0' width='50%'>Códigos Contables</th>
<tr>
  <td>
    <table class="Tbl0" border='0'>
      <tr>
        <td class="Td2" align='right'>Código ISS 2001</td>
        <td class="Td2" align='left'><input type='text' name='iss1_mapii' size='10' maxlength='10'value=<?echo $iss1_mapi?>>
        <a href='#' onclick= 'valida2(3)'><img src='icons/feed_magnify.png' border='0' alt='Busqueda ISS 2001'></a>&nbsp;
        <?
        $cons2=mysql_query("select desc_tar from iss1 WHERE codi_tar='$is1_mapi'");
        while ($rowx = mysql_fetch_array($cons2)) {
          echo strtoupper($rowx[desc_tar]); }?></td>
      </tr>	
      <tr>
        <td class="Td2" align='right'>UVR ISS 2001</td>
        <td class="Td2" align='left'><input type='text' name='uvriss_' size='4' maxlength='4' onkeypress='if (event.keyCode <45 || event.keyCode  >57) event.returnValue = false' value=<?echo $uvriss_map;?>>
        </td>
      </tr>
      <tr>
        <td class="Td2" align='right'>Valor ISS 2001</td>
        <td class="Td2" align='left'><input type='text' name='valiss_' size='7' maxlength='7' onkeypress='if (event.keyCode <45 || event.keyCode  >57) event.returnValue = false' value=<?echo $valiss_map;?>>
        </td>
      </tr>
      <tr>
        <td class="Td2" align='right'>Código ISS 2004</td>
        <td class="Td2" align='left'><input type='text' name='iss4_mapii' size='10' maxlength='10' value=<?echo $is4_mapi?>>
        <a href='#' onclick= 'valida2(4)'><img src='icons/feed_magnify.png' border='0' alt='Busqueda ISS 2004'></a>&nbsp;
        <?
        $cons3=mysql_query("select desc_tar from iss4 WHERE codi_tar='$is4_mapi'");
        while ($rowx = mysql_fetch_array($cons3)) {
        echo strtoupper($rowx[desc_tar]); }?></td>
      </tr> 
	</table>
  </td>
  <td>
    <table class="Tbl0" border='0'>
      <tr>
        <td class="Td2" align='right'>Actividad o Cirujano</td>
        <td class="Td2" align='left'><input type='text' name='cconcir_' size='10' maxlength='10' value=<?echo $cconcir_map;?>></td>
      </tr>
      <tr>
        <td class="Td2" align='right'>Anestesiologo</td>
        <td class="Td2" align='left'><input type='text' name='cconane_' size='10' maxlength='10' value=<?echo $cconane_map;?>>
        </td>
      </tr>
      <tr>
        <td class="Td2" align='right'>Ayudante</td>
        <td class="Td2" align='left'><input type='text' name='cconayu_' size='10' maxlength='10' value=<?echo $cconayu_map;?>>
        </td>
      </tr>
      <tr>
        <td class="Td2" align='right'>Derechos de Sala</td>
        <td class="Td2" align='left'><input type='text' name='cconder_' size='10' maxlength='10' value=<?echo $cconder_map;?>>
        </td>
      </tr>
      <tr>
        <td class="Td2" align='right'>Material Quirurgico</td>
        <td class="Td2" align='left'><input type='text' name='cconmat_' size='10' maxlength='10' value=<?echo $cconmat_map;?>>
        </td>
      </tr>	  
	</table>
  </td>
</tr>
</table>
<table class="Tbl0" border='0'>
<th class='Th0' width='100%' colspan='6'>CLASIFICACION</th>
<tr>
  <td class="Td2" align='right'>Clase </td>
  <td class="Td2" align='left'>
  <select name='clas_mapii'><option value=''>
  <?
    $consulta=mysql_query("SELECT codi_des,nomb_des FROM destipos WHERE codt_des ='18'");
	while($row=mysql_fetch_array($consulta)){
	  echo "<option value='$row[codi_des]'>$row[nomb_des]";}
   ?>
  </select></td>
  <td class="Td2" align='right'>Especialidad</td>
  <td class="Td2" align='left'>
  <select name='espe_'><option value=''>
  <?
    $consulta=mysql_query("SELECT codi_des,nomb_des FROM destipos WHERE codt_des ='48'");
	while($row=mysql_fetch_array($consulta)){
	  echo "<option value='$row[codi_des]'>$row[nomb_des]";}
   ?>
  </select></td>
  <td class="Td2" align='right'>Forma</td>
  <td class="Td2" align='left'><select name='forma'>
	  <option value=''>
      <option value='1'>Institucional
      <option value='2'>SubContratado
    </select></td>
</tr>
</table>

<script language="javaScript">
	//form1.sclas_mapii.value='<?echo $clas_map;?>';
	//form1.sbcla_mapii.value='<?echo $sbcla_map;?>';
</script>

<script language="javaScript">validaforma(<?echo $form_mapi?>);</script>

<br><br>
<table class="Tbl2">
	<tr>
	<td class="Td1"><a href="#" onclick="javascript:validar()"><img hspace=0 width=20 height=20 src='icons\feed_disk.png' alt='Guardar' border=0 align="top"> Guardar </a></td>
	<td class="Td1"><a href="fondo.php" onclick="javascript:history.go(-1)">Cancelar<img hspace=0 width=20 height=20 src='icons\feed.png' alt='Cancelar' border=0 align="top"></a></td>
</table>
<input type="hidden" name="vcod" value=0>
<script language="javaScript">
form1.grumap_.value='<?echo $grumap_map;?>';
form1.nivmap_.value='<?echo $nivmap_map;?>';
form1.grusoa_.value='<?echo $grusoa_map;?>';
form1.clas_mapii.value='<?echo $clas_map;?>';
form1.espe_.value='<?echo $espe_map;?>';
//validaclase();
validapos();
</script>
<?
mysql_free_result($consulta);
mysql_close();
?>
</form>
</body>
</html>