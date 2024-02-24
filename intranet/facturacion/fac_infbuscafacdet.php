<html>
<head>
<title>PROGRAMA DE FACTURACIÓN</title>

<!--Hoja de estilos del calendario --> 
<link rel="stylesheet" type="text/css" media="all" href="java/calendar/calendar-green.css" title="win2k-cold-1" /> 

<!-- librería principal del calendario --> 
<script type="text/javascript" src="java/calendar/calendar.js"></script> 

<!-- librería para cargar el lenguaje deseado --> 
<script type="text/javascript" src="java/calendar/lang/calendar-es.js"></script> 

<!-- librería que declara la función Calendar.setup, que ayuda a generar un calendario en unas pocas líneas de código --> 
<script type="text/javascript" src="java/calendar/calendar-setup.js"></script> 

<SCRIPT LANGUAGE=JavaScript>

function validar(){
var vacio='';
  if(form1.fac1.value!=''){vacio='N';}
  if(form1.fac2.value!=''){vacio='N';}
  if(form1.fecini1.value!=''){vacio='N';}
  if(form1.fecini2.value!=''){vacio='N';}
  if(form1.fec1.value!=''){vacio='N';}
  if(form1.fec2.value!=''){vacio='N';}
  if(form1.contrato.value!=''){vacio='N';}
  if(form1.relac.value!=''){vacio='N';}
  //if(form1.anulada.checked==true){vacio='N';}  
  if(form1.entidad.value!=''){vacio='N';}
  if(vacio==''){alert('Debe digitar al menos un parámetro para generar el informe.');}
  else{form1.submit()}
}
function recargar(){
    document.form1.action="fac_infbuscafacdet.php";
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
<?
//include('php/funciones.php');
include('php/conexion.php');
?>
<form name="form1" method="POST" action="fac_inffacturadet.php" target='fr02'>
<body lang=ES  style='tab-interval:35.4pt'  >
<table class="Tbl0">
  <tr><td class="Td0" align='center'>LISTADO DETALLADO DE FACTURAS</td></tr>
</table>
<br>
<center>
<table class="Tbl0" border='0'>
<tr>
  <td class="Td2" align='left' colspan='3'><b>Parámetros de Búsqueda</td>
</tr>
<tr>
  <td class="Td2" align='right'><b>Factura Desde:</td>
  <td class="Td2" align='left'><input type='text' name='fac1' size='10' maxlength='10' value='<?echo $fac1;?>'></td>
  <td class="Td2" align='right'><b>Fecha Inicio Serv. Desde:</td>
  <td class="Td2" align='left'><input type='text' name='fecini1' size='10' maxlength='10' value='<?echo $fecini1;?>'>
      <input type="button" id="lanzador3" value="..." />
			<dd><dd><script type="text/javascript"> 
				  Calendar.setup({ 
				  inputField     :    "fecini1",     // id del campo de texto 
				  ifFormat     :     "%d/%m/%Y",     // formato de la fecha que se escriba en el campo de texto 
				  button     :    "lanzador3"     // el id del botón que lanzará el calendario 
				  }); 
			 </script> 
  </td>
  
  <td class="Td2" align='right'><b>Fecha de Cierre Desde:</td>
  <td class="Td2" align='left'><input type='text' name='fec1' size='10' maxlength='10' value='<?echo $fec1;?>'>
      <input type="button" id="lanzador1" value="..." />
			<dd><dd><script type="text/javascript"> 
				  Calendar.setup({ 
				  inputField     :    "fec1",     // id del campo de texto 
				  ifFormat     :     "%d/%m/%Y",     // formato de la fecha que se escriba en el campo de texto 
				  button     :    "lanzador1"     // el id del botón que lanzará el calendario 
				  }); 
			 </script> 
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
  <td class="Td2" align='right'><b>Hasta:</td>
  <td class="Td2" align='left'><input type='text' name='fac2' size='10' maxlength='10' value='<?echo $fac2;?>'></td>
  <td class="Td2" align='right'><b>Hasta:</td>
  <td class="Td2" align='left'><input type='text' name='fecini2' size='10' maxlength='10' value='<?echo $fecini2;?>'>
      <input type="button" id="lanzador4" value="..." />
			<dd><dd><script type="text/javascript"> 
				  Calendar.setup({ 
				  inputField     :    "fecini2",     // id del campo de texto 
				  ifFormat     :     "%d/%m/%Y",     // formato de la fecha que se escriba en el campo de texto 
				  button     :    "lanzador4"     // el id del botón que lanzará el calendario 
				  }); 
			 </script>
  </td>
  
  <td class="Td2" align='right'><b>Hasta:</td>
  <td class="Td2" align='left'><input type='text' name='fec2' size='10' maxlength='10' value='<?echo $fec2;?>'>
      <input type="button" id="lanzador2" value="..." />
			<dd><dd><script type="text/javascript"> 
				  Calendar.setup({ 
				  inputField     :    "fec2",     // id del campo de texto 
				  ifFormat     :     "%d/%m/%Y",     // formato de la fecha que se escriba en el campo de texto 
				  button     :    "lanzador2"     // el id del botón que lanzará el calendario 
				  }); 
			 </script>
  </td>
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

  <td class="Td2" align='right'><b>Servicio:</td>
  <td class="Td2" align='left' colspan='2'><select name='servic'><option value=''>
  <?
    $consulta=mysql_query("SELECT codi_des,nomb_des FROM destipos WHERE codt_des='06' ORDER BY nomb_des");
    while($row=mysql_fetch_array($consulta)){
        echo "<option value='$row[codi_des]'>$row[nomb_des]";
    }
  ?>
  </select>
  </td>
  <td class="Td2" align='right'></td>
  <td class="Td2" align='right'><b>Cuenta de Cobro:</td>
  <td class="Td2" align='left'><input type='text' name='relac' size='8' maxlength='8' value='<?echo $relac;?>'></td>
  
  <td class="Td2" align='right'><b>Nro de contrato:</td>
  <td class="Td2" align='left'><select name='nrocontr'><option value=''>
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

<tr>
  <td class="Td2" align='right'><b>Prefijo:</td>
  <td class="Td2" align='left'><select name='pref_fac' >
        <option value="FE">FE</option>
        <option value="I">I</option>
		<option value="R">R</option>
        </select>
  </td>
  <td class="Td2" align='right'><!--<b>Facturas Abiertas:--></td>
  <td class="Td2" align='left'><!--<b><input type='checkbox' name='abierta'>--></td>
  <td class="Td2" align='right'><!--<b><b>Facturas Anuladas:--></td>
  <td class="Td2" align='left'><!--<b><input type='checkbox' name='anulada'>--></td>
  
  <td class="Td2" align='right'></td>
  <td class="Td2" align='left' colspan='2'>
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
//document.form1.cerrada.value='<?echo $cerrada
?>
<center>
<a href='#' onclick='validar()'><img src='icons/feed_magnify.png' border='0' alt='Buscar' width=20 height=20>Buscar</a>
</center>

</form>
</body>
</html>
