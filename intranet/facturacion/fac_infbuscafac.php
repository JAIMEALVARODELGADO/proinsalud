<html>
<head>
<title>PROGRAMA DE FACTURACI�N</title>



<SCRIPT LANGUAGE=JavaScript>

function validar(){
var vacio='';
  if(form1.fac1.value!=''){vacio='N';}
  if(form1.fac2.value!=''){vacio='N';}
  if(form1.fecini1.value!=''){vacio='N';}
  if(form1.fecini2.value!=''){vacio='N';}
  if(form1.fecfin1.value!=''){vacio='N';}
  if(form1.fecfin2.value!=''){vacio='N';}
  if(form1.fec1.value!=''){vacio='N';}
  if(form1.fec2.value!=''){vacio='N';}
  if(form1.identifica.value!=''){vacio='N';}
  if(form1.contrato.value!=''){vacio='N';}
  if(form1.relac.value!=''){vacio='N';}
  if(form1.anulada.checked==true){vacio='N';}  
  if(form1.entidad.value!=''){vacio='N';}
  if(vacio==''){alert('Debe digitar al menos un par�metro para generar el informe.');}
  else{form1.submit()}
}
function recargar(){
    document.form1.action="fac_infbuscafac.php";
    document.form1.target="fr01";
    document.form1.submit();    
}
function activar(var_){
var comando="";
    comando="document.form1."+var_+".checked=true";
    //alert(comando);
    eval(comando);
}
</script>
<link rel="stylesheet" href="css/style.css" type="text/css" />
</head>
<?php
//include('php/funciones.php');
include('php/conexion.php');

?>
<form name="form1" method="POST" action="fac_inffactura.php" target='fr02'>
<body lang=ES  style='tab-interval:35.4pt'  >
<table class="Tbl0">
  <tr><td class="Td0" align='center'>LISTADO DE FACTURAS</td></tr>
</table>
<br>
<center>
<table class="Tbl0" border='0'>
<tr>
  <td class="Td2" align='left' colspan='3'><b>Par�metros de B�squeda</td>
</tr>
<tr>
  <td class="Td2" align='right'><b>Factura Desde:</td>
  <td class="Td2" align='left'><input type='text' name='fac1' size='10' maxlength='10' value='<?echo $fac1;?>'></td>
  <td class="Td2" align='right'><b>Fecha Inicio Serv. Desde:</td>
  <td class="Td2" align='left'><input type='date' name='fecini1' size='10' maxlength='10' value='<?echo $fecini1;?>'></td>
  <td class="Td2" align='right' ><b>Fecha Final Serv. Desde:</td>
  <td class="Td2" align='left' ><input type='date' name='fecfin1' size='10' maxlength='10' value='<?echo $fecfin1;?>'></td>
  <td class="Td2" align='right'><b>Fecha Cierre Desde:</td>
  <td class="Td2" align='left'><input type='date' name='fec1' size='10' maxlength='10' value='<?echo $fec1;?>'></td>
</tr>

<tr>
  <td class="Td2" align='right'><b>Hasta:</td>
  <td class="Td2" align='left'><input type='text' name='fac2' size='10' maxlength='10' value='<?echo $fac2;?>'></td>
  <td class="Td2" align='right'><b>Hasta:</td>
  <td class="Td2" align='left'><input type='date' name='fecini2' size='10' maxlength='10' value='<?echo $fecini2;?>'></td>
  <td class="Td2" align='right'><b>Hasta:</td>
  <td class="Td2" align='left'><input type='date' name='fecfin2' size='10' maxlength='10' value='<?echo $fecfin2;?>'></td>
  
  <td class="Td2" align='right'><b>Hasta:</td>
  <td class="Td2" align='left'><input type='date' name='fec2' size='10' maxlength='10' value='<?echo $fec2;?>'></td>    
</tr>
<tr>
  <td class="Td2" align='right'><b>Servicio:</td>
  <td class="Td2" align='left' colspan='2'><select name='servic'><option value=''>
  <?
    $consulta=mysql_query("SELECT codi_des,nomb_des FROM destipos WHERE codt_des='06' ORDER BY nomb_des");
    while($row=mysql_fetch_array($consulta)){
        echo "<option value='$row[codi_des]'>".substr($row[nomb_des],0,20)."</option>";
    }
  ?>
  </select>
  </td>
  <td class="Td2" align='right'></td>
  <td class="Td2" align='right'><b>Cuenta de Cobro:</td>
  <td class="Td2" align='left'><input type='text' name='relac' size='8' maxlength='8' value='<?echo $relac;?>'></td>
  
  <td class="Td2" align='right'><b>Ent. Pagadora:</td>
  <td class="Td2" align='left'><select name='entidad' onchange='recargar()'><option value=''>
  <?
    $consulta=mysql_query("SELECT nit_con,neps_con FROM contrato WHERE nit_con<>'' ORDER BY neps_con");
	while($row=mysql_fetch_array($consulta)){
	  echo "<option value='$row[nit_con]'>".substr($row[neps_con],0,25)."</option>";
	}
  ?>
  </select>
  </td>  
</tr>
<tr>
    <td class="Td2" align='right'><b>Identificaci�n:</td>
    <td class="Td2" align='left' colspan="2"><input type='text' name='identifica' size='20' maxlength='20' value='<?echo $identifica;?>'></td>
    <td class="Td2" align='right'></td>
    <td class="Td2" align='right'><b>Prefijo:</td>
    <td class="Td2" align='left'><select name='pref_fac' >
		<option value=""></option>
    <?php
      $consultaconsec="select c.prefijo from consecutivo c WHERE c.estado ='A' ORDER BY prefijo";
      $consultaconsec=mysql_query($consultaconsec);
      while($row=mysql_fetch_array($consultaconsec)){
          echo "<option value='$row[prefijo]'>$row[prefijo]</option>";
      }
    ?>    
    </select>        
    </td>
    <td class="Td2" align='right'><b>Contrato:</td>
    <td class="Td2" align='left'><select name='contrato'><option value=''>Todos
    <?
    $consulta=mysql_query("SELECT codi_con,neps_con FROM contrato ORDER BY neps_con");
        while($row=mysql_fetch_array($consulta)){
          echo "<option value='$row[codi_con]'>".substr($row[neps_con],0,25)."</option>";
        }
    ?>
    </select>
    </td>
</tr>
<tr>
  <td class="Td2" align='right'><b>Fact. Cerradas:</td>
  <td class="Td2" align='left'><input type='checkbox' name='cerrada' checked></td>
  <td class="Td2" align='right'><b>Facturas Abiertas:</td>
  <td class="Td2" align='left'><input type='checkbox' name='abierta'></td>
  <td class="Td2" align='right'><b>Facturas Anuladas:</td>
  <td class="Td2" align='left'><input type='checkbox' name='anulada'></td>  
  <td class="Td2" align='right'><b>Nro de contrato:</td>
  <td class="Td2" align='left' colspan='2'><select name='nrocontr'><option value=''>
  <?
    //echo $entidad;
    $consulta=mysql_query("SELECT ctr.iden_ctr,ctr.nume_ctr FROM contratacion AS ctr
            INNER JOIN contrato AS con ON con.codi_con=ctr.codi_con
            WHERE con.nit_con='$entidad'");
    while($row=mysql_fetch_array($consulta)){
        echo "<option value='$row[iden_ctr]'>$row[nume_ctr]";
    }
  ?>
  </select>
  </td>
</tr>
</table>
</center>

<script language='JavaScript'>
    document.form1.contrato.value='<?echo $contrato?>';
    document.form1.servic.value='<?echo $servic?>';
    document.form1.entidad.value='<?echo $entidad?>';    
</script>
<?
if($cerrada=='on'){?><script language=''>activar('cerrada');</script><?}
if($abierta=='on'){?><script language=''>activar('abierta');</script><?}
if($anulada=='on'){?><script language=''>activar('anulada');</script><?}
//document.form1.cerrada.value='<?echo $cerrada
?>
<center>
<a href='#' onclick='validar()'><img src='icons/feed_magnify.png' border='0' alt='Buscar' width=20 height=20>Buscar</a>
</center>

</form>
</body>
</html>
<html><head></head><body></body></html>