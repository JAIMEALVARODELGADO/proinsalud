<html>
<head>
<title>PROGRAMA DE FACTURACIÓN</title>
</head>
<link rel="stylesheet" href="css/style.css" type="text/css" />
<script language="javaScript">
marcadorpos=false
function validar(){
var error="";
  if(form1.codi_map.value==""){error=error+"Código CUPS\n";} 
  if(form1.desc_map.value==""){error=error+"Descripción\n";} 
  //if(form1.nivl_map.value==""){error=error+"Nivel (CUPS)\n";} 
  //if(!marcadorpos){error=error+"POS \n";} 
  if(form1.cconcir_map.value==""){error=error+"Código Contable de la Actividad\n";} 
  if(form1.clas_map.value==""){error=error+"Clase\n";} 
  if(form1.espe_map.value==""){error=error+"Especialidad\n";} 
  //if(form1.form_map.value==""){error=error+"Forma\n";} 
  if(error!=""){
    alert("Para continuar debe completar la siguiente información:\n\n"+error);}
  else{
    form1.action="fac_guardaeditamapii.php";
	form1.submit();}
}

function validaniv(niv){
  form1.nivl_map.value=niv;
}

function validaforma(forma){
  form1.forma.value='<?echo $form_mapi;?>';
}
function validaclase(){
  if (form1.clase_map.value=='0109' || form1.clase_map.value=='0111' || form1.clase_map.value=='0112' || form1.clase_map.value=='0113' )
    {
    //alert(form1.sclas_mapii.value);
    form1.soat_map.value='';
    form1.iss1_map.value='';
    form1.iss4_map.value='';
    form1.soat_map.disabled=true;
    form1.iss1_mapi.disabled=true;
    form1.iss4_mapi.disabled=true;
  }
  else
  {
    form1.soat_map.disabled=false;
    form1.iss1_map.disabled=false;
    form1.iss4_map.disabled=false;
  }
}
function buscaact(tar_){
  var comando='';
  comando="window.open('fac_buscaract.php?tarifario="+tar_+"','ventana1','width=400,height=700,scrollbars=YES')";
  eval(comando);
  //window.open('fac_buscaract.php?tar='+tar_+','ventana1','width=400,height=700,scrollbars=YES')   
}
</script>

<body>
<?
include('php/conexion.php');
$consultamap="SELECT cups.codi_cup,codi_map,desc_map,nivl_map,pos_map,mapi_map,grumap_map,nivmap_map,soat_map,grusoa_map,valsoa_map,iss1_map,uvriss_map,valiss_map,iss4_map,vris4_map,cconcir_map,conane_map,conayu_map,conder_map,conmat_map,clas_map,espe_map,form_map 
FROM mapii INNER JOIN cups ON cups.codigo=codi_map WHERE iden_map=$iden_map";
//echo $consultamap;
$consultamap=mysql_query($consultamap);
$rowmap=mysql_fetch_array($consultamap);
?>
<form method="post" name="form1" action="bus_editamapii.php">
<center>
<table class="Tbl0"><tr><td class="Td0" align='center'>EDITA PROCEDIMIENTO</td></tr></table>

<table class="Tbl0" border='0'>
<tr>
  <td class="Td2" align='right'>Código CUPS</td>
  <td class="Td2" align='left'><input type='hidden' name='codi_map' size='10' maxlength='14' value=<?echo $rowmap[codi_map]?>>
  <input type='text' name='codi_cup' size='10' maxlength='14' value=<?echo $rowmap[codi_cup]?> disabled='true'>
  <a href='#' onclick='buscaact("cups")'><img src='icons/feed_magnify.png' border='0' alt='Busqueda Cups'></a></td>
</tr>
<tr>
  <td class="Td2" align='right'>Descripción</td>
  <td class="Td2" align='left'><input type='text' name='desc_map' size='60' maxlength='250' value="<?echo $rowmap[desc_map]?>"></td>
</tr>

<tr>
  <td class="Td2" align='right'>Nivel (CUPS)De Complejidad </td>
  <td class="Td2" align='left'><select name='nivl_map'><option value=''></option>
      <option value='1'>I Nivel</option>
      <option value='2'>II Nivel</option>
      <option value='3'>III Nivel</option>
      <option value='4'>IV nivel</option>
    </select></td>
</tr>
<script language="javaScript">validaniv(<?echo $rowmap[nivl_map]?>);</script>
<tr>
  <td class="Td2" align='right'>POS</td>
  <td class="Td2" align='left'>
    <?
	  if($rowmap[pos_map]=='S'){
        echo "<input type='radio' name='pos_map' value='S' onclick='marcadorpos=true' checked='true'>Si<br>";
	    echo "<input type='radio' name='pos_map' value='N' onclick='marcadorpos=true'>No";
	  }
	  else{
	    echo "<input type='radio' name='pos_map' value='S' onclick='marcadorpos=true'>Si<br>";
	    echo "<input type='radio' name='pos_map' value='N' onclick='marcadorpos=true' checked='true'>No";
	  }
	?>
  </td>
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
        <td class="Td2" align='left'><input type='text' name='mapi_map' size='6' maxlength='6' value='<?echo $rowmap[mapi_map];?>'></td>
	  </tr>
	  <tr>
	    <td class="Td2" align='right'>Grupo MAPIPOS</td>
  	    <td class="Td2" align='left'><select name='grumap_map'><option value=''></option>
          <option value='01'>01</option>
      	  <option value='02'>02</option>
      	  <option value='03'>03</option>
	  	    <option value='04'>04</option>
      	  <option value='05'>05</option>
  	  	  <option value='06'>06</option>
  	  	  <option value='07'>07</option>
  	  	  <option value='08'>08</option>
  	  	  <option value='09'>09</option>
  	  	  <option value='10'>10</option>
  	  	  <option value='11'>11</option>
  	  	  <option value='12'>12</option>
  	  	  <option value='13'>13</option>
  	  	  <option value='14'>14</option>
  	  	  <option value='15'>15</option>
  	  	  <option value='16'>16</option>
  	  	  <option value='17'>17</option>
  	  	  <option value='18'>18</option>
  	  	  <option value='19'>19</option>
  	  	  <option value='20'>20</option>
  	  	  <option value='21'>21</option>
  	  	  <option value='22'>22</option>
  	  	  <option value='23'>23</option>
    	  </select></td>
	  </tr>
	  <script>form1.grumap_map.value='<?echo $rowmap[grumap_map];?>'</script>      	  
	  <tr>
  	    <td class="Td2" align='right'>Nivel MAPIPOS</td>
  	    <td class="Td2" align='left'><select name='nivmap_map'><option value=''></option>
      	  <option value='1'>I Nivel</option>
      	  <option value='2'>II Nivel</option>
      	  <option value='3'>III Nivel</option>
      	  <option value='4'>IV nivel</option>
    	  </select></td>
	  </tr>
	  <script>form1.nivmap_map.value='<?echo $rowmap[nivmap_map];?>'</script>
    </table>
  </td>
  <td>
    <table class="Tbl0" border='0'>
      <tr>
        <td class="Td2" align='right'>Código SOAT</td>
        <td class="Td2" align='left'><input type='text' name='soat_map' size='10' maxlength='10' value=<?echo $rowmap[soat_map];?>>
        <a href='#' onclick='buscaact("soat")'><img src='icons/feed_magnify.png' border='0' alt='Busqueda Soat'></a>&nbsp;
        <?
        //$cons1=mysql_query("select desc_tar from soat WHERE codi_tar='$codi_soat'");
        //while ($row = mysql_fetch_array($cons1)){
        //  echo strtoupper($row[desc_tar]); }
		?>
		</td>
      </tr>
      <tr>
        <td class="Td2" align='right'>Grupo SOAT</td>
        <td class="Td2" align='left'><select name='grusoa_map'><option value=''></option>
          <option value='01'>01</option>
          <option value='02'>02</option>
          <option value='03'>03</option>
	        <option value='04'>04</option>
          <option value='05'>05</option>
	      <option value='06'>06</option>
	      <option value='07'>07</option>
	      <option value='08'>08</option>
	      <option value='09'>09</option>
	      <option value='10'>10</option>
	      <option value='11'>11</option>
	      <option value='12'>12</option>
	      <option value='13'>13</option>
	      <option value='14'>14</option>
	      <option value='15'>15</option>
	      <option value='16'>16</option>
	      <option value='17'>17</option>
	      <option value='18'>18</option>
	      <option value='19'>19</option>
	      <option value='20'>20</option>
	      <option value='21'>21</option>
	      <option value='22'>22</option>
        <option value='23'>23</option>
          </select></td>
      </tr>
	  <script>form1.grusoa_map.value='<?echo $rowmap[grusoa_map]?>'</script>
      <tr>
        <td class="Td2" align='right'>Valor SOAT</td>
        <td class="Td2" align='left'><input type='text' name='valsoa_map' size='7' maxlength='7' onkeypress='if (event.keyCode <45 || event.keyCode  >57) event.returnValue = false' value='<?echo $rowmap[valsoa_map];?>'></td>
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
        <td class="Td2" align='left'><input type='text' name='iss1_map' size='10' maxlength='10' value='<?echo $rowmap[iss1_map];?>'>
        <a href='#' onclick='buscaact("iss_1")'><img src='icons/feed_magnify.png' border='0' alt='Busqueda ISS 2001'></a>&nbsp;
        <?
        //$cons2=mysql_query("select desc_tar from iss1 WHERE codi_tar='$is1_mapi'");
        //while ($rowx = mysql_fetch_array($cons2)) {
        //  echo strtoupper($rowx[desc_tar]); }?>
		</td>
      </tr>	
      <tr>
        <td class="Td2" align='right'>UVR ISS 2001</td>
        <td class="Td2" align='left'><input type='text' name='uvriss_map' size='4' maxlength='4' onkeypress='if (event.keyCode <45 || event.keyCode  >57) event.returnValue = false' value='<?echo $rowmap[uvriss_map];?>'>
        </td>
      </tr>
      <tr>
        <td class="Td2" align='right'>Valor ISS 2001</td>
        <td class="Td2" align='left'><input type='text' name='valiss_map' size='7' maxlength='7' onkeypress='if (event.keyCode <45 || event.keyCode  >57) event.returnValue = false' value='<?echo $rowmap[valiss_map];?>'>
        </td>
      </tr>
      <tr>
        <td class="Td2" align='right'>Código ISS 2004</td>
        <td class="Td2" align='left'><input type='text' name='iss4_map' size='10' maxlength='10' value='<?echo $rowmap[iss4_map];?>'>
        <a href='#' onclick='buscaact("iss_4")'><img src='icons/feed_magnify.png' border='0' alt='Busqueda ISS 2004'></a>&nbsp;
        <?
        //$cons3=mysql_query("select desc_tar from iss4 WHERE codi_tar='$is4_mapi'");
        //while ($rowx = mysql_fetch_array($cons3)) {
        //echo strtoupper($rowx[desc_tar]); }?>        
	       </td>
      </tr> 
      <tr>
        <td class="Td2" align='right'>Valor ISS 2004</td>
        <td class="Td2" align='left'><input type='text' name='vris4_map' size='7' maxlength='7' onkeypress='if (event.keyCode <45 || event.keyCode  >57) event.returnValue = false' value='<?echo $rowmap[vris4_map];?>'>
        </td>
      </tr>
	</table>
  </td>
  <td>
    <table class="Tbl0" border='0'>
      <tr>
        <td class="Td2" align='right'>Actividad o Cirujano</td>
        <td class="Td2" align='left'><input type='text' name='cconcir_map' size='10' maxlength='10' value='<?echo $rowmap[cconcir_map];?>'></td>
      </tr>
      <tr>
        <td class="Td2" align='right'>Anestesiologo</td>
        <td class="Td2" align='left'><input type='text' name='conane_map' size='10' maxlength='10' value='<?echo $rowmap[conane_map];?>'>
        </td>
      </tr>
      <tr>
        <td class="Td2" align='right'>Ayudante</td>
        <td class="Td2" align='left'><input type='text' name='conayu_map' size='10' maxlength='10' value='<?echo $rowmap[conayu_map];?>'>
        </td>
      </tr>
      <tr>
        <td class="Td2" align='right'>Derechos de Sala</td>
        <td class="Td2" align='left'><input type='text' name='conder_map' size='10' maxlength='10' value='<?echo $rowmap[conder_map];?>'>
        </td>
      </tr>
      <tr>
        <td class="Td2" align='right'>Material Quirurgico</td>
        <td class="Td2" align='left'><input type='text' name='conmat_map' size='10' maxlength='10' value='<?echo $rowmap[conmat_map];?>'>
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
  <select name='clas_map'><option value=''>
  <?
    $consulta=mysql_query("SELECT codi_des,nomb_des FROM destipos WHERE codt_des ='18'");
	while($row=mysql_fetch_array($consulta)){
	  echo "<option value='$row[codi_des]'>$row[nomb_des]";}
   ?>
  </select></td>
  <script>form1.clas_map.value='<?echo $rowmap[clas_map];?>'</script>
  <td class="Td2" align='right'>Especialidad</td>
  <td class="Td2" align='left'>
  <select name='espe_map'><option value=''>
  <?
    $consulta=mysql_query("SELECT codi_des,nomb_des FROM destipos WHERE codt_des ='48'");
	while($row=mysql_fetch_array($consulta)){
	  echo "<option value='$row[codi_des]'>$row[nomb_des]";}
   ?>
  </select></td>
  <script>form1.espe_map.value='<?echo $rowmap[espe_map];?>'</script>
  <td class="Td2" align='right'>Forma</td>
  <td class="Td2" align='left'><select name='form_map'>
	  <option value=''>
      <option value='1'>Institucional
      <option value='2'>SubContratado
    </select>
  </td>
  <script>form1.form_map.value='<?echo $rowmap[form_map];?>'</script>
</tr>
</table>
<script language="javaScript">
  validaforma(<?echo $form_mapi?>);
</script>

<br><br>
<table class="Tbl2">
	<tr>
	<td class="Td1"><a href="#" onclick="javascript:validar()"><img hspace=0 width=20 height=20 src='icons\feed_disk.png' alt='Guardar' border=0 align="top"> Guardar </a></td>
	<td class="Td1"><a href="fondo.php" onclick="javascript:history.go(-1)">Cancelar<img hspace=0 width=20 height=20 src='icons\feed.png' alt='Cancelar' border=0 align="top"></a></td>
</table>
<script language="javaScript">
validaclase();
</script>
<?
echo "<input type='hidden' name='iden_map' value='$iden_map'>";
mysql_free_result($consultamap);
mysql_free_result($consulta);
mysql_close();
?>
</form>
</body>
</html>