<?php 
if(!isset($_SESSION)){
	session_start();
}
?>
<meta http-equiv="Context-Type" content="text/html; charset=UTF-8">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<title>PROGRAMA DE FACTURACIï¿œN</title>
<SCRIPT LANGUAGE='JavaScript'>
function validar(opc_){
var error='';
  /*if(form1.fechaini.value=='' && 
    form1.fechafin.value=='' &&
    form1.identif.value=='' &&
    form1.contra.value==''){error='1';}*/
  if(form1.fechaini.value==''){error=error+"Fecha Inicial\n";}
  if(form1.fechafin.value==''){error=error+"Fecha Final\n";}
  if(form1.fcie_fac.value==''){error=error+"Fecha para el Cierre\n";}
  if(form1.codi_con.value==''){error=error+"Contrato\n";}
  if(form1.iden_ctr.value==''){error=error+"Número del contrato\n";}
  if(error!=''){
    alert("Para continuar debe complementar la siguiente información:\n"+error);}
  else{
    if(opc_==1){
      document.form1.action="fac_3magisterio.php";
      form1.submit();
    }
    else{
      document.form1.action="fac_3magisterio2.php";
      document.form1.submit();
    }
  }
}
function validactr(){
  document.form1.action="fac_3inimagisterio.php";
  document.form1.target="fr01";
  document.form1.submit();
}
</script>
<link rel="stylesheet" href="css/style.css" type="text/css" />
</head>
<body lang=ES  style='tab-interval:35.4pt'  >
<form name="form1" method="POST" action="fac_3magisterio.php" target='fr02'>
<table class="Tbl0"><tr><td class="Td0" align='center'>FACTURAR MAGISTERIO</td></tr></table>
<?php
include('php/conexion.php');
include('php/funciones.php');
?>
<center><table class="Tbl0" border='0'>
	<tr>
            <td class="Td2" align='left'><b>Consulta Externa</b></td>
            <td class="Td2" align='right'><b>Fecha Inicial:</td>
            <td class="Td2" align='left'><input type='date' name='fechaini' size='10' maxlength='10' value='<?echo $fechaini;?>'></td>
            <td class="Td2" align='right'><b>Contrato:</td>
            <td class="Td2" align='left'>
              <select name='codi_con' onchange='validactr()'><option value=''>
              <?php              
              $conscon="SELECT CODI_CON,NEPS_CON FROM contrato WHERE esta_con='A' ORDER BY NEPS_CON";              
              $conscon=mysql_query($conscon);
              while($row=mysql_fetch_array($conscon)){
                   echo "<option value='$row[CODI_CON]'>$row[NEPS_CON]";
              }
              mysql_free_result($conscon);
              ?>
              </select>
            </td>
        </tr>
        <tr>
            <td class="Td2" align='left'><b>Laboratorio</b></td>	  
            <td class="Td2" align='right'><b>Fecha Final:</td>
            <td class="Td2" align='left'><input type='date' name='fechafin' size='10' maxlength='10' value='<?echo $fechafin;?>'></td>          
            <td class='Td2' align='right'><b>Nro:</td>
            <td class='Td2'><select name='iden_ctr'><option value=''>
              <?                        
              /*$consultacon="SELECT ccio.iden_ctr,ccio.nume_ctr FROM contratacion AS ccio
              INNER JOIN contrato AS con ON con.codi_con=ccio.codi_con
              WHERE con.codi_con='002' AND ccio.esta_ctr='A'";*/
              /*$consultacon="SELECT ccio.iden_ctr,ccio.nume_ctr FROM contratacion AS ccio
              INNER JOIN contrato AS con ON con.codi_con=ccio.codi_con
              WHERE con.regmag_con='S' AND ccio.esta_ctr='A'";*/
              $consultacon="SELECT ccio.iden_ctr,ccio.nume_ctr FROM contratacion AS ccio
              INNER JOIN contrato AS con ON con.codi_con=ccio.codi_con
              WHERE con.codi_con='$codi_con' AND ccio.esta_ctr='A'";
              //echo "<br>".$consultacon;
              $consultacon=mysql_query($consultacon);
              while($rowcon=mysql_fetch_array($consultacon)){
                   echo "<option value='$rowcon[iden_ctr]'>$rowcon[nume_ctr]";
              }
              mysql_free_result($consultacon);
              ?>
              </select>
            </td>
	</tr>
        <tr>
            <td class="Td2" align='left'><b>Imagenología</b></td>
            <td class="Td2" align='right'><b>Fecha Para el Cierre de la Factura:</td>
            <td class="Td2" align='left'><input type='date' name='fcie_fac' size='10' maxlength='10' value='<?echo $fcie_fac;?>'></td> 

            
        </tr>
        <tr>
            <td class="Td2" align='left'><b>Formulación</b></td>
        </tr>
        <tr>
            <td class="Td2" align='left'><b>Terapia Física</b></td>
            <td class="Td2" align='right'><a href='#' onclick='validar(1)' ><img src='icons/feed_add.png' border='0' alt='Facturar por Consulta' width='20' height='20'>Facturar por Consulta</a></td>
            <td class="Td2" align='right'><a href='#' onclick='validar(2)' ><img src='icons/feed_add.png' border='0' alt='Facturar por Paciente' width='20' height='20'>Facturar por Paciente</a></td>
        </tr>
        <tr>
            <td class="Td2" align='left'><b>Terapia Respiratoria</b></td>
        </tr>
        <tr>
            <td class="Td2" align='left'><b>Quirofano</b></td>
        </tr>
        <tr>
            <td class="Td2" align='left'><b>Rips</b></td>
        </tr>
</table>
</center>
<script language="JavaScript">
  document.form1.codi_con.value='<?php echo $codi_con;?>';
</script>
</form>
</body>
</html><html><head></head><body></body></html>