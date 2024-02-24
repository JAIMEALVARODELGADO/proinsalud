<html>
<head>
<title>PROGRAMA DE FACTURACIÓN</title>
<link rel="stylesheet" href="css/style.css" type="text/css" />
<script language='javascript'>
function validar(cont_){
var i,comando,error,marcados;
error='';
marcados=0;
  for(i=0;i<cont_;i=i+1){
    comando="form1.chkser"+i+".checked";
    if(eval(comando)==true){
	  marcados=marcados+1;
	  comando="form1.valor"+i+".value";
      if(eval(comando)<=0){
	    error="No deben existir valores en cero(0)";
	  }
	}
  }
  if(marcados==0){
    error='Para guardar, debe seleccionar almenos un elemento de la lista';}
  if(error!=''){
    alert(error);}
  else{
    form1.submit()}
}
function activar(cont_){
var comando;
  comando="form1.chkser"+cont_+".checked";
  if(eval(comando)==true){
    comando="form1.tser"+cont_+".disabled=false";
    eval(comando);
    comando="form1.valor"+cont_+".disabled=false";
    eval(comando);
	comando="form1.valor"+cont_+".focus()";
    eval(comando);
  }
  else{
    comando="form1.tser"+cont_+".disabled=true";
    eval(comando);
    comando="form1.valor"+cont_+".disabled=true";
    eval(comando);
  }
}

function buscar(){
  form1.action='fac_editmedinsxcon.php';
  form1.submit();
}
function cargaser(var_,val_){
var cad;
  cad="form1."+var_+".value='"+val_+"'";
  eval(cad);
}
function validaelim(){
  if(confirm("Desea eliminar las actividades seleccionadas")){
    form1.control.value='2';
    form1.action="fac_geditmedinsxcon.php";
    form1.submit();
  }
}
</script>
</head>
<body>
<form name='form1' method='post' action='fac_geditmedinsxcon.php'>
<table class="Tbl0"><tr><td class="Td0" align='center'>CONTRATO</td></tr></table>

<?
include('php/funciones.php');
include('php/conexion.php');
$consulta=mysql_query("SELECT con.neps_con,con.codi_con,
ccion.iden_ctr,ccion.nume_ctr,ccion.fini_ctr,ccion.ffin_ctr,ccion.mont_ctr,ccion.pctg_ctr,ccion.tari_ctr,ccion.tpor_crt
FROM contrato AS con
INNER JOIN contratacion AS ccion ON ccion.codi_con=con.codi_con
WHERE iden_ctr='$iden_ctr'");
$row=mysql_fetch_array($consulta);
$codi_con=$row[codi_con];
echo "<table class='Tbl0'>";
echo "<th class='Th0' width='10%'>NRO</th>
	  <th class='Th0' width='30%'>ENTIDAD</th>
	  <th class='Th0' width='15%'>VIGENCIA</th>
	  <th class='Th0' width='5%'>MONTO</font></th>
	  <th class='Th0' width='40%'>CLAUSULAS</font></th>";
echo "<tr>";
echo "<td class='Td2'>$row[nume_ctr]</td>";
echo "<td class='Td2'>$row[neps_con]</td>";
echo "<td class='Td2'>".cambiafechadmy($row[fini_ctr])." - ".cambiafechadmy($row[ffin_ctr])."</td>";
echo "<td class='Td2'>$row[mont_ctr]</td>";
echo "<td class='Td2'></td>";
echo "</tr>";
echo "</table>";
echo "<table class='Tbl0'><tr><td class='Td0' align='center'>EDITAR MEDICAMENTOS E INSUMOS CONTRATADOS</td></tr></table>";

echo "<table class='Tbl0' border='0'>";
echo "<tr>";
echo "<td class='Td0' width='20%' align='right'>Clase:</td>";
echo "<td class='Td0' width='20%' align='left'><select name='claseser'>
      <option value='M'>Medicamentos
      <option value='I'>Insumos
      </select>
      </td>";
echo "<td class='Td0' width='20%' align='left'>Código: <input type='text' name='codigo_' size='15' maxlength='15' value='$codigo_'></td>";
echo "<td class='Td0' width='20%' align='left'>Nombre: <input type='text' name='nombre_' size='20' maxlength='40' value='$nombre_'></td>";
echo "<td class='Td0' width='20%' align='left'><a href='#' onclick='buscar()'><img hspace=0 width=20 height=20 src='icons/feed_magnify.png' alt='Buscar'>Buscar</a></td>";
echo "</tr>";
echo "</table>";
?>
<script language='javascript'>form1.claseser.value='<?echo $claseser;?>'</script>
<?
$consulta='';
$condicion="";
if($claseser=='M'){
  $condicion="tar.clas_tco='M'";
  if(!empty($codigo_)){
    $condicion=$condicion." AND med.codi_mdi = '".$codigo_."'";}
  if(!empty($nombre_)){
    //$condicion=$condicion." AND (med.nomb_mdi LIKE '%".$nombre_."%' OR med.noco_mdi LIKE '%".$nombre_."%')";}
    $condicion=$condicion." AND med.nombre_mdi LIKE '%".$nombre_."%'";}
  /*$consulta="SELECT tar.iden_tco AS iden_,med.codi_mdi AS codi_,CONCAT(med.nomb_mdi,' ',med.noco_mdi) AS nomb_,tar.tser_tco AS tser_,tar.valo_tco AS valor_ 
  FROM tarco AS tar
  INNER JOIN medicamentos2 AS med ON med.codi_mdi=tar.iden_map AND tar.iden_ctr=$iden_ctr
  WHERE ".$condicion." ORDER BY nomb_mdi";*/
  $consulta="SELECT tar.iden_tco AS iden_,med.codi_mdi AS codi_,med.nombre_mdi AS nomb_,tar.tser_tco AS tser_,tar.valo_tco AS valor_ 
  FROM tarco AS tar
  INNER JOIN vista_medicamentos2 AS med ON med.codi_mdi=tar.iden_map AND tar.iden_ctr=$iden_ctr
  WHERE ".$condicion." ORDER BY nombre_mdi";
}
elseif($claseser=='I'){
  $condicion="tar.clas_tco='I'";
  if(!empty($codigo_)){
    $condicion=$condicion." AND ins.codi_ins = '".$codigo_."'";}
  if(!empty($nombre_)){
    $condicion=$condicion." AND ins.desc_ins LIKE '%".$nombre_."%'";}
  /*$consulta="SELECT tar.iden_tco AS iden_,ins.codnue AS codi_,ins.desc_ins AS nomb_,tar.tser_tco AS tser_,tar.valo_tco AS valor_ 
  FROM tarco AS tar
  INNER JOIN insu_med AS ins ON ins.codnue=tar.iden_map AND tar.iden_ctr=$iden_ctr
  WHERE ".$condicion." ORDER BY ins.desc_ins";*/
  $consulta="SELECT tar.iden_tco AS iden_,ins.codi_ins AS codi_,ins.desc_ins AS nomb_,tar.tser_tco AS tser_,tar.valo_tco AS valor_ 
  FROM tarco AS tar
  INNER JOIN insu_med AS ins ON ins.codi_ins=tar.iden_map AND tar.iden_ctr=$iden_ctr
  WHERE ".$condicion." ORDER BY ins.desc_ins";
}
//echo $consulta;
if(!empty($consulta)){
  $consulta=mysql_query($consulta);
  echo "<table class='Tbl0'><tr>";
  echo "<th class='Th0' width='5%' align='center'>Sel</td>";
  echo "<th class='Th0' width='10%' align='center'>Código</td>";
  echo "<th class='Th0' width='55%' align='center'>Nombre</td>";
  echo "<th class='Th0' width='20%' align='center'>Tipo</td>";
  echo "<th class='Th0' width='10%' align='center'>Valor</td>";
  if(mysql_num_rows($consulta)<>0){
    $cont=0;
    while($row=mysql_fetch_array($consulta)){
      echo "<tr>";
      $nomvar='chkser'.$cont;
      echo "<td class='Td2' align='center'><input type='checkbox' name='$nomvar' onclick='activar($cont)'></td>";
      echo "<td class='Td2' align='left'>$row[codi_]</td>";
      $nomvar='iden_tco'.$cont;
      echo "<td class='Td2' align='left'><input type='hidden' name='$nomvar' value='$row[iden_]'>$row[nomb_]</td>";
      $nomvar='tser'.$cont;
      $consser=mysql_query("SELECT codi_des,nomb_des FROM destipos WHERE codt_des='01'");
      echo "<td class='Td2' align='left'><select name='$nomvar' disabled>";
      while($rowser=mysql_fetch_array($consser)){
	       echo "<option value='$rowser[codi_des]'>$rowser[nomb_des]";	  
      }
	   echo "</select>";
      ?><script language='javascript'>cargaser('<?echo $nomvar;?>','<?echo $row[tser_];?>');</script><?
      echo "</td>";
      $nomvar='valor'.$cont;
      echo "<td class='Td2' align='center'><input type='text' name='$nomvar' value='$row[valor_]' size='9' maxlength='9' onkeypress='if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;' disabled></td>";
      $cont++;
      echo "</tr>";
    }
    mysql_free_result($consulta);
  }
  echo "</table>";
}
mysql_close();
137794
?>
<br><br>
<table class='Tbl2'>
  <tr>
    <td class='Td1'><a href='#' onclick='validar(<?echo $cont;?>)'><img hspace=0 width=20 height=20 src='icons\feed_disk.png' alt='Guardar' border=0 align='center'> Guardar </a></td>
	<td class='Td1'><a href='#' onclick='validaelim()'><img hspace=0 width=20 height=20 src='icons\feed_delete.png' alt='Eliminar elementos seleccionados' border=0 align='top'>Eliminar elementos selecciondos</a></td>
    <td class='Td1'><a href='#' onclick='history.go(-1)'> Regresar <img hspace=0 width=20 height=20 src='icons\feed.png' alt='Cancelar' border=0 align='center'></a></td>
  </tr>
</table>

<input type='hidden' name='cont' value='<?echo $cont;?>'>
<input type='hidden' name='iden_ctr' value='<?echo $iden_ctr;?>'>
<input type='hidden' name='codi_con' value='<?echo $codi_con;?>'>
<input type='hidden' name='control' value='1'>
</form>
</body>
</html>