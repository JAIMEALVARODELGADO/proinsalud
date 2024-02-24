<html>
<head>
<title>PROGRAMA DE FACTURACI�N</title>
<meta charset="UTF-8">
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
  form1.action='fac_creamedinsxcon.php';
  form1.submit();
}
function cargaser(var_,val_){
var cad;
  cad="form1."+var_+".value='"+val_+"'";
  eval(cad);
}
function seltodos(cont_){
var i,comando;
  for(i=0;i<cont_;i=i+1){
    if(form1.chktodos.checked==true){
      comando="form1.chkser"+i+".checked=true";}
	else{
	  comando="form1.chkser"+i+".checked=false";}
	eval(comando);
    activar(i);
  }
}
</script>
</head>
<body>
<form name='form1' method='post' action='fac_guardamedinsxcon.php'>
<table class="Tbl0"><tr><td class="Td0" align='center'>CONTRATO</td></tr></table>

<?
include('php/funciones.php');
include('php/conexion.php');
$consulta="SELECT con.neps_con,con.codi_con,
ccion.iden_ctr,ccion.nume_ctr,ccion.fini_ctr,ccion.ffin_ctr,ccion.mont_ctr,ccion.pctg_ctr,ccion.tari_ctr,ccion.tpor_crt
FROM contrato AS con
INNER JOIN contratacion AS ccion ON ccion.codi_con=con.codi_con
WHERE iden_ctr='$iden_ctr'";
//echo $consulta;
$consulta=mysql_query($consulta);
$row=mysql_fetch_array($consulta);
$codi_con=$row[codi_con];
//$tpor_crt=$row[tpor_crt];
//$pctg_ctr=pctg_ctr/100;
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
echo "<table class='Tbl0'><tr><td class='Td0' align='center'>ADICIONAR MEDICAMENTOS E INSUMOS AL CONTRATADOS</td></tr></table>";

echo "<table class='Tbl0' border='0'>";
echo "<tr>";
echo "<td class='Td2' width='20%' align='right'>Adicionar:<br>Con el nombre:</td>";
echo "<td class='Td2' width='20%' align='left'><select name='claseser'>
      <option value='M'>Medicamentos
      <option value='I'>Insumos
      </select>
	  <br><input type='text' name='nombre_' value='$nombre_' size='40' maxlength='15'>
      </td>";
echo "<td class='Td2' width='20%' align='right'>Aplicar el <input type='text' name='porcen' size='5' maxlength='5' onkeypress='if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;' value='$porcen'>% de </td>";
echo "<td class='Td2' width='10%' align='left'>
      <input type='radio' name='tipopor' value='I'>Incremento
	  <br><input type='radio' name='tipopor' value='D'>Descuento
      </td>";
echo "<td class='Td2' width='30%' align='left'><a href='#' onclick='buscar()'><img hspace=0 width=20 height=20 src='icons/feed_magnify.png' alt='Buscar'>Buscar</a></td>";
echo "</tr>";
echo "<tr>";
echo "<td class='Td2' width='20%' align='right'>Código:</td>";
echo "<td class='Td2' width='20%' align='left'><input type='text' name='codigo_' value='$codigo_' size='20' maxlength='20'></td>";
echo "</tr>";
echo "</table>";

?>
<script language='javascript'>
form1.claseser.value='<?echo $claseser;?>';
if('<?echo $tipopor;?>'=='I'){
  form1.tipopor[0].checked=true;}
else{
  form1.tipopor[1].checked=true;}
</script>
<?
$porcen=$porcen/100;
$consulta='';
$condicion='ISNULL(tar.iden_tco)';
if($claseser=='M'){
  if(!empty($nombre_)){
    //$condicion=$condicion." AND (med.nomb_mdi LIKE '%".$nombre_."%' OR med.noco_mdi LIKE '%".$nombre_."%')";
    $condicion=$condicion." AND med.nombre_mdi LIKE '%".$nombre_."%'";
  }
  if(!empty($codigo_)){
    $condicion=$condicion." AND med.codi_mdi LIKE '%".$codigo_."%'";
  }
  //coff_mdi
  //forma_farmaceutica
  
  /*$consulta="SELECT tar.iden_tco,med.codi_mdi AS codi_,CONCAT(med.nomb_mdi,' ',med.noco_mdi,' ',ff.desc_ffa) AS nomb_,med.pos_mdi AS pos,med.valo1_mdi AS valor_ FROM medicamentos2 AS med 
  INNER JOIN forma_farmaceutica AS ff ON ff.codi_ffa=med.coff_mdi
  LEFT JOIN tarco AS tar ON tar.iden_map=med.codi_mdi AND tar.iden_ctr=$iden_ctr
  WHERE ".$condicion." ORDER BY nomb_mdi";*/
  $consulta="SELECT tar.iden_tco,med.codi_mdi AS codi_,med.nombre_mdi AS nomb_,med.pos_mdi AS pos,med.valo1_mdi AS valor_ 
  FROM vista_medicamentos2 AS med   
  LEFT JOIN tarco AS tar ON tar.iden_map=med.codi_mdi AND tar.iden_ctr=$iden_ctr
  WHERE ".$condicion." ORDER BY nombre_mdi";
}
elseif($claseser=='I'){
  if(!empty($nombre_)){
    $condicion=$condicion." AND ins.desc_ins LIKE '%".$nombre_."%'";
  }
  if(!empty($codigo_)){
    $condicion=$condicion." AND ins.codi_ins LIKE '%".$codigo_."%'";
  }
  /*$consulta="SELECT tar.iden_tco,ins.codnue AS codi_,ins.desc_ins AS nomb_,ins.valo1_ins AS valor_ 
  FROM insu_med AS ins 
  LEFT JOIN tarco AS tar ON tar.iden_map=ins.codnue AND tar.iden_ctr=$iden_ctr
  WHERE ".$condicion." ORDER BY ins.desc_ins";*/
  $consulta="SELECT tar.iden_tco,ins.codi_ins AS codi_,ins.desc_ins AS nomb_,ins.valo1_ins AS valor_ 
  FROM insu_med AS ins 
  LEFT JOIN tarco AS tar ON tar.iden_map=ins.codi_ins AND tar.iden_ctr=$iden_ctr
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
      $nomvar='codigoser'.$cont;
      echo "<td class='Td2' align='left'><input type='hidden' name='$nomvar' value='$row[codi_]'>$row[nomb_]</td>";
      if(!empty($row[pos])){
        $pos='01'.$row[pos];}
      else{
        $pos='0109';}
      $nomvar='tser'.$cont;
      $consser=mysql_query("SELECT codi_des,nomb_des FROM destipos WHERE codt_des='01'");
      echo "<td class='Td2' align='left'><select name='$nomvar' disabled>";
      while($rowser=mysql_fetch_array($consser)){
	    echo "<option value='$rowser[codi_des]'>$rowser[nomb_des]";	  
      }
        ?><script language='javascript'>cargaser('<?echo $nomvar;?>','<?echo $pos;?>');</script><?
      echo "</td>";
      if($tipopor=='D'){
        $valor_nue=$row[valor_]-($row[valor_]*$porcen);}
      else{
        $valor_nue=$row[valor_]+($row[valor_]*$porcen);}
      $valor_nue=round($valor_nue,-1);
      $nomvar='valor'.$cont;
      echo "<td class='Td2' align='center'><input type='text' name='$nomvar' value='$valor_nue' size='9' maxlength='9' onkeypress='if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;' disabled></td>";
      $cont++;
      echo "</tr>";
    }
    echo "<tr>";
    echo "<td class='Td2' align='center'><input type='checkbox' name='chktodos' onclick='seltodos($cont)'></td>";
    echo "<td class='Td2' align='left'>Seleccionar todos</td>";
    echo "</tr>";
    mysql_free_result($consulta);
  }
  echo "</table>";
}
mysql_close();
?>
<br><br>
<table class='Tbl2'>
  <tr>
    <td class='Td1' width='45%'><a href='#' onclick='validar(<?echo $cont;?>)'><img hspace=0 width=20 height=20 src='icons\feed_disk.png' alt='Guardar' border=0 align='center'> Guardar </a></td>
    <td class='Td1' width='45%'><a href='#' onclick='history.go(-1)'> Regresar <img hspace=0 width=20 height=20 src='icons\feed.png' alt='Cancelar' border=0 align='center'></a></td>
  </tr>
</table>

<input type='hidden' name='cont' value='<?echo $cont;?>'>
<input type='hidden' name='iden_ctr' value='<?echo $iden_ctr;?>'>
<input type='hidden' name='codi_con' value='<?echo $codi_con;?>'>
</form>
</body>
</html>