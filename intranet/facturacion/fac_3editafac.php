<html>
<head>
<title>PROGRAMA DE FACTURACI�N - PROFACTU</title>
<link rel="stylesheet" href="css/style.css" type="text/css" />
<!--Hoja de estilos del calendario --> 
<link rel="stylesheet" type="text/css" media="all" href="java/calendar/calendar-blue.css" title="win2k-cold-1" /> 
<!-- librer�a principal del calendario --> 
<script type="text/javascript" src="java/calendar/calendar.js"></script> 
<!-- librer�a para cargar el lenguaje deseado --> 
<script type="text/javascript" src="java/calendar/lang/calendar-es.js"></script> 
<!-- librer�a que declara la funci�n Calendar.setup, que ayuda a generar un calendario en unas pocas l�neas de c�digo --> 
<script type="text/javascript" src="java/calendar/calendar-setup.js"></script> 


<SCRIPT LANGUAGE=JavaScript>
	function envio()
	{
	    form1.action='fac_3lisfacanu.php';
	    //form1.action='fac_2encapre.php';
		form1.target='fr02';
		form1.submit();
	}
</script>
</head>

<form name="form1" method="POST" action="fac_3editafac.php" target='fr01'>
<body lang=ES  style='tab-interval:35.4pt'  >
<table class="Tbl0"><tr><td class="Td0" align='center'>BUSQUEDA - EDITAR </td></tr></table><br>
<?include('php/conexion.php');?>
<center><table class="Tbl1" border="0">
<tr>
    <td class="Td2" align='right' width='10%'><b>Identificaci�n:</td>
    <td class="Td2" align='left' width='15%'><input type='text' name='cod_usu' size='15' maxlength='20'></td>
    <td class="Td2" align='right' width='10%'><b>Factura:</td>
    <td class="Td2" align='left' width='15%'>
        <select name='pref_fac'>
        <option value=""></option>
        <?php
            $consultaconsec="select c.prefijo from consecutivo c WHERE c.estado ='A' ORDER BY prefijo";
            $consultaconsec=mysql_query($consultaconsec);
            while($row=mysql_fetch_array($consultaconsec)){
                echo "<option value='$row[prefijo]'>$row[prefijo]</option>";
            }
        ?>
        
        </select>
        <input type='text' name='num_fac' size='10' maxlength='10'></td>
    <td class="Td2" align='right' width='10%'><b>Contrato:</td>
    <?
    include('php/conexion.php');
    $concont=mysql_query("SELECT codi_con,neps_con FROM contrato ORDER BY neps_con");
    echo"<td class='Td2' align='left'  width='40%' colspan='2'><b><select name='codi_con'>";
    echo"<option value=''></option>";
    while ($rowcon = mysql_fetch_array($concont)){
        echo"<option value='$rowcon[codi_con]'>".SUBSTR($rowcon[neps_con],0,30);
    }
    echo "</select>";?>
    <!--<td class="Td2" align='right' width='10%'></td>-->
</tr>
<tr>
    <td class='Td2' align='right'><b>Fecha Inicial: </td>
    <td class='Td2' align='left'><b><input type=text name=fech_ini  id=fenti size='11' />
    <input type="button" id="lanzador1" value="..." />
    <dd><dd><script type="text/javascript"> 
    Calendar.setup({ 
    inputField     :    "fenti",     // id del campo de texto 
    ifFormat     :     "%d/%m/%Y",     // formato de la fecha que se escriba en el campo de texto 
    button     :    "lanzador1"     // el id del bot�n que lanzar� el calendario 
    }); 
    </script> 
    </td>
    <td class='Td2' align='right'><b>Fecha Final: </td>
    <td class='Td2' align='left'><b><input type=text name=fech_fin  id=fenfi size='11' />
    <input type="button" id="lanzador2" value="..." />
    <dd><dd><script type="text/javascript"> 
    Calendar.setup({ 
    inputField     :    "fenfi",     // id del campo de texto 
    ifFormat     :     "%d/%m/%Y",     // formato de la fecha que se escriba en el campo de texto 
    button     :    "lanzador2"     // el id del bot�n que lanzar� el calendario 
    }); 
    </script> 	
    </td>
    <td class="Td2" align='right'><b>Nro de Ingreso:</td>
    <td class="Td2" align='left'><input type='text' name='ingreso' size='10' maxlength='10'></td>
    
</tr>
<tr>
    <td class='Td2' align='right'><b>Nro de Registros: </td>    
    <td class='Td2' align='left'><b><input type=text name=registros  id=registros size='6' value=200 />    
    </td>
    <td></td>
    <td class="Td2" align='left' colspan='1'><input type='checkbox' name='fabierta'><b>Facturas Abiertas<a href='#' onclick='envio()' ><img src='icons/feed_magnify.png' border='0' alt='Continuar' width=20 height=20></a></td>
</tr>
</table></center>
</form>
</body>
</html>
