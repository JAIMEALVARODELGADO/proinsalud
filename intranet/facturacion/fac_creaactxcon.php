<?php
session_start();
if(isset($iden_ctr) OR !empty($iden_ctr)){
  $_SESSION['giden_ctr']=$iden_ctr;
}
?>
<html>
<head>
<title>PROGRAMA DE FACTURACI�N</title>
<link rel="stylesheet" href="css/style.css" type="text/css" />
<!--<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />-->
<!--<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />-->
<script language='javascript'>
function validacod(cont_,iden_){
    var nombre='';
    nombre='form1.codi_'+cont_+'.checked'
    if(eval(nombre)==true){
        nombre='form1.codi_'+cont_+'.value='+iden_;
        eval(nombre);
        nombre='form1.valor_'+cont_+'.focus()';
        eval(nombre);
    }
    else{
        nombre='form1.codi_'+cont_+'.value=""';
        eval(nombre);
    }
}
function validatip(scla_,codscl_){
  var cadena="form1."+scla_+".value='"+codscl_+"'";
  eval(cadena);
}
function validagrupo(grup_,codgru_){
  var cadena="form1."+grup_+".value='"+codgru_+"'";
  eval(cadena);
}
function validasubcl(){
  form1.action='fac_creaactxcon.php';
  form1.submit();
}
function seleccionar(cont_){
    var i,coman;
    for(i=0;i<cont_;i++){
        if(form1.seltodo.checked==true){
            coman="form1.codi_"+i+".checked=true";
            eval(coman);
            coman="form1.codi_"+i+".value=form1.iden_map"+i+".value";
            eval(coman);
        }
        else{
            coman="form1.codi_"+i+".checked=false";
            eval(coman);
            coman="form1.codi_"+i+".value=''";
            eval(coman);
        }  
    }
}

function validaguarda(cont_){
    var error="";
    for(i=0;i<cont_;i++){
        coman="form1.codi_"+i+".checked";
        coman2="form1.valor_"+i+".value";
        if(eval(coman)==true && eval(coman2)==''){
            coman="form1.iden_map"+i+".value";
            error=error+eval(coman)+"\n";
        }
    }
    if(error!=""){
        alert("Existen actividades seleccionadas que no tienen valor \n\nDebe colocar el valor y guardar");}
    else{
        form1.submit();}
}
</script>
</head>
<body>
<form name='form1' method='post' action='fac_guardaactxcon.php'>
<table class="Tbl0"><tr><td class="Td0" align='center'>CONTRATO</td></tr></table>

<?
include('php/funciones.php');
include('php/conexion.php');
$consulta="SELECT con.neps_con,con.codi_con,
ccion.iden_ctr,ccion.nume_ctr,ccion.fini_ctr,ccion.ffin_ctr,ccion.mont_ctr,ccion.pctg_ctr,ccion.tari_ctr,ccion.tpor_crt
FROM contrato AS con
INNER JOIN contratacion AS ccion ON ccion.codi_con=con.codi_con
WHERE iden_ctr='$_SESSION[giden_ctr]'";
//echo "<br>".$consulta;
$consulta=mysql_query($consulta);
$row=mysql_fetch_array($consulta);
$codi_con=$row[codi_con];

echo "<table class='Tbl0'>";
echo "<th class='Th0' width='5%'>NRO</th>
	  <th class='Th0' width='30%'>ENTIDAD</th>
	  <th class='Th0' width='20%'>VIGENCIA</th>
	  <th class='Th0' width='5%'>MONTO</font></th>
	  <th class='Th0' width='40%'>CLAUSULAS</font></th>";
echo "<tr>";
echo "<td class='Td2'>$row[nume_ctr]</td>";
echo "<td class='Td2'>$row[neps_con]</td>";
echo "<td class='Td2'>".cambiafechadmy($row[fini_ctr])." - ".cambiafechadmy($row[ffin_ctr])."</td>";
echo "<td class='Td2'>$row[mont_ctr]</td>";
if(empty($tari_ctr)){$tari_ctr=$row[tari_ctr];}
if($pctg_ctr==""){$pctg_ctr=$row[pctg_ctr];}
if(empty($tpor_crt)){$tpor_crt=$row[tpor_crt];}
$tabla='';
$campo='';
$obser='';
if($tari_ctr=='1'){
  $obser='Soat con ';
}
if($tari_ctr=='2'){
  $obser='ISS 2001 con ';
}
if($tari_ctr=='3'){
  $obser='ISS 2004 con ';
}
if($tpor_crt=='+'){$tipo='de Incremento';}
if($tpor_crt=='-'){$tipo='de Descuento';}

$obser=$obser.'  '.$row[pctg_ctr].'%'.' '.$tipo;

echo "<td class='Td2'>$obser</td>";
echo "</tr>";
echo "</table>";
echo "<table class='Tbl0'><tr><td class='Td0' align='center'>ADICIONA ACTIVIDADES AL CONTRATO</td></tr></table>";

echo "<table class='Tbl0'><tr>";
echo "<td class='Td0' width='25%' align='center'>Clase</td>";
echo "<td class='Td0' width='25%' align='center'>Especialidad</td>";
echo "<td class='Td0' width='25%' align='center'>Tarifario</td>";
echo "<td class='Td0' width='25%' align='center'>Porc.</td>";
echo "<td class='Td0' width='25%' align='center'>Buscar</td>";
echo "</tr>";
echo "<tr>";
echo "<td class='Td2'><select name='clase'><option value=''>Todas";
$consultasc=mysql_query("SELECT codi_des,nomb_des FROM destipos WHERE codt_des='18' ORDER BY nomb_des");
while($rowsc=mysql_fetch_array($consultasc)){
  echo "<option value='$rowsc[codi_des]'>$rowsc[nomb_des]";
}
echo "</select>";
echo "</td>";
echo "<td class='Td2'><select name='espe'><option value=''>Todas";
$consultasc=mysql_query("SELECT codi_des,nomb_des FROM destipos WHERE codt_des='48' ORDER BY nomb_des");
while($rowsc=mysql_fetch_array($consultasc)){
  echo "<option value='$rowsc[codi_des]'>$rowsc[nomb_des]";
}
echo "</select>";
echo "</td>";
echo "<td class='Td2'><select name='tari_ctr'><option value=''>
      <option value='1'>Soat
      <option value='2'>Iss 2001
	  <option value='3'>Iss 2004
    </select>";
echo "</td>";
echo "<td class='Td2'><input type='text' name='pctg_ctr' size='5' maxlength='5' value=$pctg_ctr>
      <select name='tpor_crt'>
        <option value='+'>Incremento
        <option value='-'>Descuento
      </select>";
echo "</td>";
echo "<td class='Td2'>";
echo "<a href='#' onclick='validasubcl()'><img hspace=0 width=20 height=20 src='icons/feed_magnify.png' alt='Buscar' border=0 align='top'></a>";
echo "</td>";
echo "</tr>";
echo "<tr>";
echo "<td class='Td2' align='left'>Código:<input type='text' name='codigo' size='8' maxlength='8' value='$codigo'></td>";
echo "<td class='Td2' align='left'>Descripción:<input type='text' name='descrip' size='40' maxlength='40' value='$descrip'></td>";
echo "<td class='Td2' align='right'>Redondear :</td>";
echo "<td class='Td2'>
      <select name='redondeo'>
        <option value='0'>Sin Redondeo</option>
        <option value='-1'>A la Decena</option>
        <option value='-2'>A la Centena</option>
      </select>";

echo "</tr>";
echo "</table>";
?>
<script language='javascript'>
  form1.clase.value='<?echo $clase;?>'
  form1.espe.value='<?echo $espe;?>'
  form1.tari_ctr.value='<?echo $tari_ctr;?>'
  form1.tpor_crt.value='<?echo $tpor_crt?>';
  form1.redondeo.value='<?echo $redondeo?>';
</script>
<?
//$condicion="tar.iden_ctr is null and map.clas_map<>''";
//$condicion="tarco.iden_ctr is null and ";
$condicion="cups.esta_cup='AC' and mapii.esta_map='AC' and ";
if(!empty($clase)){
  $condicion=$condicion."mapii.clas_map='".$clase."' and ";
}
if(!empty($espe)){
  $condicion=$condicion."mapii.espe_map='".$espe."' and ";
}
if(!empty($codigo)){
  $condicion=$condicion."cups.codi_cup LIKE '%".$codigo."%' and ";
}
if(!empty($descrip)){
  $condicion=$condicion."mapii.desc_map LIKE '%".$descrip."%' and ";
}
//echo $condicion;
$condicion=substr($condicion,0,strlen($condicion)-5);
/*$consulta="SELECT map.iden_map,map.codi_map,map.desc_map,map.clas_map,map.soat_map,map.valsoa_map,map.iss1_map,map.valiss_map,map.iss4_map,map.vris4_map,map.grumap_map,map.grusoa_map,tar.iden_ctr
FROM mapii AS map 
LEFT JOIN tarco AS tar ON tar.iden_map=map.iden_map AND tar.iden_ctr='$iden_ctr' 
WHERE $condicion ORDER BY map.desc_map";*/
$consulta="SELECT mapii.iden_map,mapii.codi_map, mapii.desc_map, mapii.clas_map, mapii.soat_map, mapii.valsoa_map, mapii.iss1_map, mapii.valiss_map, mapii.iss4_map, cups.codi_cup, mapii.vris4_map, mapii.grumap_map, mapii.grusoa_map FROM cups INNER JOIN mapii ON cups.codigo = mapii.codi_map";
if(empty($condicion)){
  $condicion="mapii.desc_map LIKE 'A%'";
}
$consulta=$consulta." WHERE ".$condicion." ORDER BY mapii.desc_map";
//echo "<br>".$consulta;
$consulta=mysql_query($consulta);
if(mysql_num_rows($consulta)!=0){
  echo "<table class='Tbl0'>";
  echo "<th class='Th0' width='5%'>SEL</th>
        <th class='Th0' width='10%'>CODIGO</th>
        <th class='Th0' width='50%'>NOMBRE</th>
        <th class='Th0' width='15%'>TIPO</th>
        <th class='Th0' width='10%'>VALOR</th>
        <th class='Th0' width='10%'>GRUPO</th>";
  $cont=0;
  while($row=mysql_fetch_array($consulta)){
    $contar="SELECT tarco.iden_tco FROM tarco WHERE tarco.iden_map='$row[iden_map]' AND iden_ctr='$_SESSION[giden_ctr]'";
    //echo "<br>".$contar;
    $contar=mysql_query($contar);
    if(mysql_num_rows($contar)==0){
      //$iden_ctr
      $soat_map=$row[soat_map];
      $iss1_map=$row[iss1_map];
      $iss4_map=$row[iss4_map];      

      $grupo=$row[grumap_map];
      if($tari_ctr=='1'){
          $valor=$row[valsoa_map];
          $grupo=$row[grusoa_map];
      }
      if($tari_ctr=='2'){
          $valor=$row[valiss_map];}
      if($tari_ctr=='3'){           
          $valor=$row[vris4_map];}        
      if($tpor_crt=='-'){$valor=$valor-($valor*($pctg_ctr/100));}
      else{$valor=$valor+($valor*($pctg_ctr/100));}
      $valor=round($valor,$redondeo);
      $var='iden_map'.$cont;
      echo "<input type='hidden' name='$var' value='$row[iden_map]'>";
      $var='codi_'.$cont;
      echo "<tr>";
      echo "<td class='Td4'><input type='checkbox' name='$var' onclick=\"validacod('$cont','$row[iden_map]')\" value=''></td>";
      echo "<td class='Td2'>$row[codi_cup]</td>";
      echo "<td class='Td2'>$row[desc_map]</td>";
    	$var='tser_'.$cont;
    	echo "<td class='Td2'><select name='$var'>";
    	$consultatp=mysql_query("SELECT codi_des,nomb_des FROM destipos WHERE codt_des='01'");
    	while($rowtp=mysql_fetch_array($consultatp)){
    	  echo "<option value='$rowtp[codi_des]'>".substr($rowtp[nomb_des],0,35);
    	}
    	echo "</select></td>";
    	$consultacla=mysql_query("SELECT codi_des FROM destipos WHERE codi_des=(SELECT valo_des FROM destipos WHERE codi_des=$row[clas_map])");

    	if(mysql_num_rows($consultacla)<>0){
    	  $rowcla=mysql_fetch_array($consultacla);
    	  $clase=$rowcla[codi_des];
    	}
    	?>
    	<script language='javascript'>
    	  validatip('<?echo $var;?>','<?echo $clase;?>');
    	</script>
    	<?php	
    	$var='valor_'.$cont;
    	echo "<td class='Td2'><input type='text' name='$var' size='10' value='$valor' onKeypress='if (event.keyCode > 47 && event.keyCode <58 ||event.keyCode == 46) event.returnValue = true;else event.returnValue = false'></td>";
    	
    	$var='grqx_'.$cont;
    	echo "<td class='Td2'><select name='$var'><option value=''>";
    	//$consultagr=mysql_query("SELECT codi_gru,nomb_gru FROM grupos");
    	$consultagr=mysql_query("SELECT grup_gqx FROM grupoqx GROUP BY grup_gqx");
    	while($rowgr=mysql_fetch_array($consultagr)){
    	  echo "<option value='$rowgr[grup_gqx]'>$rowgr[grup_gqx]";
    	}
    	echo "</select></td>";
    	//echo $row[grumap_map];
    	?>
  	 <script language='javascript'>
  	    validagrupo('<?echo $var;?>','<?echo $grupo;?>');
  	   //validagrupo('1','2');
  	 </script>
  	 <?
     echo"</tr>";
  	 $cont++;
    }
  }
    echo "</table>";
    echo "<table class='Tbl2'>";
    echo "<tr>";
    echo "<td class='Td1' width='10%'><input type='checkbox' name='seltodo' onclick='seleccionar($cont)'>Seleccionar todos</td>";
    echo "<td class='Td1' width='45%'><a href='#' onclick='validaguarda($cont)'><img hspace=0 width=20 height=20 src='icons/feed_disk.png' alt='Guardar' border=0 align='center'>Guardar</a></td>";
    echo "<td class='Td1' width='45%'><a href='fac_muesccion.php?codi_con=<?echo $codi_con;?>'>Regresar<img hspace=0 width=20 height=20 src='icons/feed.png' alt='Cancelar' border=0 align='center'></a></td>";
    echo "</tr>";
    echo "</table>";
  
}
else{
  echo "<center>";
  echo "<p class=Msg>No existen registros para esta busqueda</p>";
  echo "</center>";
}
mysql_close();
?>
<script language='javascript'>
form1.seltodo.checked=true;
seleccionar('<? echo $cont;?>');
</script>
<input type='hidden' name='numact' value='<?echo $cont;?>'>
<!--<input type='hidden' name='iden_ctr' value='<?echo $iden_ctr;?>'>-->
<input type='hidden' name='codi_con' value='<?echo $codi_con;?>'>
</form>
</body>
</html>