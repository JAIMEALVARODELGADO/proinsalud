<html>
<head>
<title>PROGRAMA DE FACTURACI�N</title>

<SCRIPT LANGUAGE=JavaScript>

function validar(){
var vacio='';
  if(form1.fac1.value!=''){vacio='N';}
  if(form1.fac2.value!=''){vacio='N';}
  if(form1.fec1.value!=''){vacio='N';}
  if(form1.fec2.value!=''){vacio='N';}
  if(form1.id_ing.value!=''){vacio='N';}  
  if(form1.entidad.value!=''){vacio='N';}
  if(vacio==''){alert('Debe digitar al menos un par�metro para generar el informe.');}
  else{form1.submit()}
}

function recargar(){
    document.form1.action="fac_4hebuscarelacion.php";
    document.form1.target="fr01";
    document.form1.submit();    
}

</script>
<link rel="stylesheet" href="css/style.css" type="text/css" />
</head>
<?
//include('php/funciones.php');
include('php/conexion.php');
//$consultarel=mysql_query("SELECT rela_emp FROM empresa");
//$rowrel=mysql_fetch_array($consultarel);
?>
<form name="form1" method="POST" action="fac_4herelaciona.php" target='fr02'>
<body lang=ES  style='tab-interval:35.4pt'>
<table class="Tbl0">
  <tr><td class="Td0" align='center'>Relacionar Facturas</td></tr>
</table>
<br>
<center>
<table class="Tbl0" border='0'>
<!--<tr>
  <td class="Td1" align='left' colspan='2'><b>Factura a Relacionar con el N�mero:  <font color='#003333'><?echo $rowrel[rela_emp];?></td>
</tr>-->
<tr>
  <td class="Td2" align='right'><b>Factura Desde:</td>
  <td class="Td2" align='left'><input type='text' name='fac1' size='10' maxlength='10'></td>
  <td class="Td2" align='right'><b>Fecha de Cierre de Factura Desde:</td>
  <td class="Td2" align='left'><input type='date' name='fec1' size='10' maxlength='10'></td>
  <td class="Td2" align='right'><b>Servicio</td>
  <td class="Td2" align='left' rowspan="8">
      <select multiple name="codi_des[]" size="8">
        <?php
        $consultaserv=mysql_query("SELECT codi_des,nomb_des FROM destipos WHERE codt_des='06' ORDER BY nomb_des");
        while($rowserv=mysql_fetch_array($consultaserv)){
          echo "<option value='$rowserv[codi_des]'>$rowserv[nomb_des]</option>";
        }
      ?>
      </select>
    </td>
</tr>


<tr>
  <td class="Td2" align='right'><b>Hasta:</td>
  <td class="Td2" align='left'><input type='text' name='fac2' size='10' maxlength='10'></td>
  <td class="Td2" align='right'><b>Hasta:</td>
  <td class="Td2" align='left'><input type='date' name='fec2' size='10' maxlength='10'></td>
  
</tr>
<tr>
    <td class="Td2" align='right'><b>Prefijo:</td>
    <td class="Td2" align='left'><select name='pref_fac' >
      <?php
        $consultaconsec="select c.prefijo from consecutivo c WHERE c.estado ='A' ORDER BY prefijo";
        $consultaconsec=mysql_query($consultaconsec);
        while($row=mysql_fetch_array($consultaconsec)){
            echo "<option value='$row[prefijo]'>$row[prefijo]</option>";
        }
      ?> 
      </select>
    </td>
    <td class="Td2" align='right'><b>Entidad Pagadora:</td>
    <td class="Td2" align='left'><select name='entidad' onchange='recargar()'><option value=''>Todos
    <?
      $consulta=mysql_query("SELECT nit_con,neps_con FROM contrato WHERE nit_con<>'' ORDER BY neps_con");
      while($row=mysql_fetch_array($consulta)){
        echo "<option value='$row[nit_con]'>$row[neps_con]";
      }
    ?>
    </select>
    </td>    
</tr>
<tr>
  <td class="Td2" align='right'><b>Admisión:</td>
  <td class="Td2" align='left'><input type='text' name='id_ing' size='7' maxlength='7'></td>
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
<script language="JavaScript">
    document.form1.fac1.value='<?php echo $fac1;?>';
    document.form1.fac2.value='<?php echo $fac2;?>';
    document.form1.id_ing.value='<?php echo $id_ing;?>';
    document.form1.fec1.value='<?php echo $fec1;?>';
    document.form1.fec2.value='<?php echo $fec2;?>';
    document.form1.entidad.value='<?php echo $entidad;?>';
    document.form1.nrocontr.value='<?php echo $nrocontr;?>';
</script>
</center>
<center>
<a href='#' onclick='validar()'><img src='icons/feed_magnify.png' border='0' alt='Buscar' width=20 height=20>Buscar</a>
</center>
<?
//echo "<input type='hidden' name='relacion' value='$rowrel[rela_emp]'>";
mysql_free_result($consulta);
mysql_close();
?>
</form>
</body>
</html>



  <html><head></head><body></body></html>