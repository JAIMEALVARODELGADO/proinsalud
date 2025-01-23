<html>
<head>
    <title>TERAPIA</title>
    <SCRIPT LANGUAGE='JavaScript'>
    function validar(){
    var error='';
    if(form1.fechaini.value=='' && 
        form1.fechafin.value=='' &&
        form1.identif.value=='' &&
        form1.contra.value==''){error='1';}
    if(error!=''){
        alert("Para continuar debe diligenciar alguno de los par�metros de b�squeda");}
    else{
        form1.submit();}  
    }
    </script>
    <link rel="stylesheet" href="css/estilo_2.css" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body lang=ES  style='tab-interval:35.4pt'  >
<form name="form1" method="POST" action="ter_inf_tf_atendidos.php" target='fr04'>
<center>
<h1>INFORME DE PACIENTES ATENDIDOS</h1>
</center>
<?php
include('php/conexion.php');
include('php/funciones.php');
?>
<center><table class="table2" border='0'>
	<tr>
	  <td align='right'><b>Fecha Inicial:</td>
	  <td align='left'><input type='text' name='fechaini' size='10' maxlength='10' value='<?echo hoy();?>'></td>
	  <td align='right'><b>Contrato:</td>
	  <td align='left'> 
	  <select name='contra'><option value=''>
	  <?php
	    $consultacon=mysql_query("SELECT con.codi_con,con.neps_con FROM contrato AS con ORDER BY con.neps_con");
		  while($rowcon=mysql_fetch_array($consultacon)){
		    echo "<option value='$rowcon[codi_con]'>$rowcon[neps_con]";
		  }
	  ?>
	  </select>
      </td>
	  <td class="Td2" align='left'><a href='#' onclick='validar()' class='btn' title='Buscar'>Buscar <i class="fa-solid fa-magnifying-glass"></i></a></td>    
	</tr>
    <tr>
        <td class="Td2" align='right'><b>Fecha Final:</td>
	    <td class="Td2" align='left'><input type='text' name='fechafin' size='10' maxlength='10' value='<?echo hoy();?>'></td>
        <td class="Td2" align='right'><b>Identificacion:</td>
	  <td class="Td2" align='left'><input type='text' name='identif' size='13 ' maxlength='20'></td>
    </tr>
</table></center>
</form>
</body>
</html>