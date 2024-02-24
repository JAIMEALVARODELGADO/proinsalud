<?php
session_start();
//if(empty($Gidusufac)){
if(!isset($Gidusufac)){ 
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
<title>PROGRAMA DE FACTURACI�N</title>
<SCRIPT LANGUAGE=JavaScript>
function validag(){
form1.action='fac_2guardapref.php';
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
  //alert(comand);
  eval(comand);
}
//comand="form1.codi_dfa"+cont_+".value";
//alert(eval(comand));
}
function activar(cont_){
var i
  if(form1.chktodos.checked){
    for (i=0;i<cont_;i++){
      cmd="form1.codi_dfa"+i+".checked='true'";
      eval(cmd);
      cargacod(i);
    }
  }
  else{
    for (i=0;i<cont_;i++){
      cmd="form1.codi_dfa"+i+".checked=''";
	  //alert(cmd);
      eval(cmd);
      cargacod(i);
    }
  }
}

function activafac(){
  if(form1.chkagrega.checked){
    cmd="form1.agregafac.disabled=false";
	eval(cmd);
  }
  else{
    cmd="form1.agregafac.value=''";
	eval(cmd);
    cmd="form1.agregafac.disabled=true";
	eval(cmd);
  }
}
</script>

<link rel="stylesheet" href="css/style.css" type="text/css" />
</head>
<body lang=ES  style='tab-interval:35.4pt'  >
<form name="form1" method="POST" action="fac_2prefac.php" target='fr02'>
<table class="Tbl0"><tr><td class="Td0" align='center'>PREFACTURA</td></tr></table><br>
<?
//echo "Ingreso: ".$id_ing;
include('php/conexion.php');
include('php/funciones.php');
$consultaing="SELECT u.nrod_usu,u.pnom_usu,u.snom_usu,u.pape_usu,u.sape_usu,u.fnac_usu,u.sexo_usu,u.dire_usu,u.tpaf_usu,u.tres_usu,
m.nomb_mun,ih.fecin_ing,c.neps_con,ih.contra_ing
FROM usuario AS u
INNER JOIN ingreso_hospitalario AS ih ON ih.codius_ing=u.codi_usu
LEFT JOIN municipio AS m ON m.codi_mun=u.mate_usu
LEFT JOIN contrato AS c ON c.codi_con=ih.contra_ing
WHERE ih.id_ing=$id_ing";
//echo $consultaing;
$consultaing=mysql_query($consultaing);
$rowing=mysql_fetch_array($consultaing);
echo "<table class='Tbl0' border='0'>";
echo "<tr>";
echo "<td class='Td2' align='right'><b>Ingreso Nro:</td>";
echo "<td class='Td2'>$id_ing</td>";
echo "<td class='Td2' align='right'><b>Identificaci�n:</td>";
echo "<td class='Td2'>$rowing[nrod_usu]</td>";
echo "<td class='Td2' align='right'><b>Nombre:</td>";
echo "<td class='Td2'>$rowing[pnom_usu] $rowing[snom_usu] $rowing[pape_usu] $rowing[sape_usu]</td>";
echo "</tr>";
echo "<tr>";
echo "<td class='Td2' align='right'><b>Edad:</td>";
echo "<td class='Td2'>".calculaedad($rowing[fnac_usu])."</td>";
echo "<td class='Td2' align='right'><b>Sexo:</td>";
echo "<td class='Td2'>$rowing[sexo_usu]</td>";
echo "<td class='Td2' align='right'><b>Direcci�n:</td>";
echo "<td class='Td2'>$rowing[dire_usu]</td>";
echo "</tr>";
echo "<tr>";
echo "<td class='Td2' align='right'><b>Tipo Afiliado:</td>";
echo "<td class='Td2'>$rowing[tpaf_usu]</td>";
echo "<td class='Td2' align='right'><b>Mun Atenci�n:</td>";
echo "<td class='Td2'>$rowing[nomb_mun]</td>";
echo "<td class='Td2' align='right'><b>Tel�fono:</td>";
echo "<td class='Td2'>$rowing[tres_usu]</td>";
echo "</tr>";
echo "<tr>";
echo "<td class='Td2' align='right'><b>Fecha Ingreso:</td>";
echo "<td class='Td2'>".cambiafechadmy($rowing[fecin_ing])."</td>";
echo "<td class='Td2' align='right'><b>Entidad:</td>";
echo "<td class='Td2'>$rowing[neps_con]</td>";
echo "<td class='Td2' align='right'></td>";
echo "<td class='Td2'></td>";
echo "</tr>";
echo"</table>";

$existe=0;
$archivo="tmp/af".$id_ing.$enti_fac.".txt";
//echo $archivo;
if(file_exists($archivo)){
  $fp = fopen ($archivo, "r" );
  $reg=0;
  while (( $data = fgetcsv ( $fp , 1000 , "|" )) !== FALSE ) { // Mientras hay l�neas que leer...
    $reg++;
    $i = 0;
    foreach($data as $dato){
      $campo[$i]=$dato;
      $i++ ;
    }
    $$campo[0]=$campo[1];
    //echo "<br>".$campo[0]."=".$campo[1];
  }
}
else{
  $existe=1;
}
?>
<table class='Tbl0'>
  <tr>
	<td class='Td2' align='right'><b>Contrato Nro:</td>
    <td class='Td2'><?echo $iden_ctr;?></td>
	<td class='Td2' align='right'><b>Tipo de factura:</td>
	<?
	  if($tipo_fac=='1'){$tipo="Contado";}else{$tipo="Cr�dito";}
	?>
	<td class='Td2'><?echo $tipo;?></td>
	<td class='Td2' align='right'><b>Relaci�n Nro:</td>
	<td class='Td2'><?echo $rela_fac;?></td>
  </tr>
  <tr>
	<td class='Td2' align='right'><b>F. inicio del servicio:</td>
	<td class='Td2'><?echo $feci_fac?></td>
	<td class='Td2' align='right'><b>F. final del servicio:</td>
	<td class='Td2'><?echo $fecf_fac?></td>
  </tr>
  <tr>
    <td class='Td2' align='right'><b>Diagn�stico:</td>
	<td class='Td2' align='left'><?echo $cod_cie10;?> </td>
	<td class='Td2' align='right'><b>Entidad a facturar:</td>
	<td class='Td2' align='left'><select name='enti_fac' onchange='form1.submit()'><option value=''>
	<?php
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
  <th class='Th0' width='10%'>C�digo</th>
  <th class='Th0' width='75%'>Descripci�n</th>
  <th class='Th0' width='10%'>Cant</th>
<?
$c=0;
$cont=0;
$archivo="tmp/ad".$id_ing.$enti_fac.".txt";
//echo $archivo;
if(file_exists($archivo)){
  $fp = fopen ($archivo, "r" );
  $reg=0;
  while (( $data = fgetcsv ( $fp , 1000 , "|" )) !== FALSE ) { // Mientras hay l�neas que leer...
    $reg++;
    $i = 0;
    foreach($data as $dato){
      $campo[$i]=$dato;
      //echo "<br>".$campo[$i];
      $i++ ;
    }    
    $$campo[0]=$campo[1];
    $c++;    
    if($c==4){      
      $font="";
      $disable="";
      switch ($tipo){
        case 'P':
          /*$consultamap=mysql_query("SELECT m.desc_map as descripcion, tar.iden_tco,tar.iden_ctr,m.codi_map AS codi
          FROM mapii AS m
          LEFT JOIN tarco AS tar ON tar.iden_map = m.iden_map AND tar.iden_ctr =$iden_ctr
          LEFT JOIN contratacion AS ctr ON ctr.iden_ctr=tar.iden_ctr 
          WHERE tar.iden_tco='$codigo'");*/
          $consultamap="SELECT m.desc_map as descripcion, tar.iden_tco,tar.iden_ctr,m.codi_map AS codi
          FROM mapii AS m
          LEFT JOIN tarco AS tar ON tar.iden_map = m.iden_map 
          LEFT JOIN contratacion AS ctr ON ctr.iden_ctr=tar.iden_ctr 
          WHERE tar.iden_ctr =$iden_ctr AND tar.iden_tco='$codigo'";
          //echo "<br>".$consultamap;
          $consultamap=mysql_query($consultamap);
          break;
        case 'I':
          //$consultamap=mysql_query("SELECT codnue as codi,desc_ins as descripcion FROM insu_med WHERE codnue='$codigo'");
          $consultamap=mysql_query("SELECT codi_ins as codi,desc_ins as descripcion FROM insu_med WHERE codi_ins='$codigo'");
          break;
        case 'M':
          //$consultamap=mysql_query("SELECT codi_mdi as codi,nomb_mdi as descripcion FROM medicamentos2 WHERE codi_mdi='$codigo'");
          $consultamap=mysql_query("SELECT codi_mdi as codi,nombre_mdi as descripcion FROM vista_medicamentos2 WHERE codi_mdi='$codigo'");
          break;
      }
      $rowmap=mysql_fetch_array($consultamap);
      /*if($rowmap[iden_ctr]==""){
      $font="<font color='#CC9933'>";
      $disable="disabled";
      }*/
      echo "<tr>";
      $var="tipo".$cont;
      echo "<input type='hidden' name='$var' value='$tipo'>";
      $var="codi_dfa".$cont;
      echo "<td class='Td2'><input type='checkbox' name='$var' onclick='cargacod($cont)' $disable></td>";
      $var="codigo".$cont;    
      echo "<td class='Td2'><input type='hidden' name='$var' value='$codigo'>$font $rowmap[codi]";

      $var="servicio".$cont;
      echo "<input type='hidden' name='$var' value='$servicio'>";
      //$var="fecha_ser".$cont;
      //echo "<input type='hidden' name='$var' value='$fecha_ser'>";

      echo "</td>";
      echo "<td class='Td2'>$font $rowmap[descripcion]</td>";
      $var="cant_dfa".$cont;
      echo "<td class='Td2'><input type='hidden' name='$var' value='$cant_dfa'>$font $cant_dfa</td>";
      echo "</tr>";
      $c=0;
      $cont++;
    }
  }
  echo "<tr>";
  echo "<td class='Td2'></td>";
  echo "<td class='Td2'><input type='checkbox' name='chkagrega' onclick='activafac()'></td>";
  echo "<td class='Td2'>Agregar estas actividades a una factura abirta</td>";
  echo "<td class='Td2'><select name='agregafac' disabled='true'>";
  echo "<option>";
  $consfac=mysql_query("SELECT iden_fac,feci_fac,fecf_fac FROM encabezado_factura WHERE esta_fac='1' and id_ing=$id_ing and enti_fac='$enti_fac'");
  if(mysql_num_rows($consfac)<>0){
    while($rowfac=mysql_fetch_array($consfac)){
      echo "<option value='$rowfac[iden_fac]'>$rowfac[feci_fac] - $rowfac[fecf_fac] - $rowfac[iden_fac]";
    }
  }
  echo "</select>";
  echo "</td>";
  echo "</tr>";
    ?>
    <table class='Tbl2'>
      <tr>
          <td class='Td1' width='10%'><input type='checkbox' name='chktodos' onclick='activar(<?echo $cont;?>)'>Act Todos</td>
          <td class='Td1' width='10%'></td>
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
<input type='hidden' name='id_ing' value='<?echo $id_ing;?>'>
<input type='hidden' name='codi_con' value='<?echo $rowing[contra_ing];?>'>
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
<html><head></head><body></body></html>