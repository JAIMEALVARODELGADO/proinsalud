<?php
session_start();
?>
<html>
<head>
<title>PROGRAMA DE FACTURACIÓN</title>
<SCRIPT LANGUAGE=JavaScript>

    function capturafecha(){
        var hoy = new Date();
        var dia = String(hoy.getDate()).padStart(2, '0');
        var mes = String(hoy.getMonth() + 1).padStart(2, '0'); // Enero es 0!
        var anio = hoy.getFullYear();
        hoy = anio + '-' + mes + '-' + dia;
        document.getElementById('fecha').value=hoy;
    }    

	
	function envio()
	{
	    form1.action='fac_2medicamento.php';
		form1.target='fr02';
		form1.submit();
	}

	function mostrarTarifario()
	{
		let contrato = document.getElementById("contrato").value;
		
		let select = document.getElementById("tarifario");

		// Limpiamos las opciones existentes
		select.innerHTML = "";

		// Agregamos las nuevas opciones
		let resultado = tarifarios.filter(objtar => objtar.codi_con === contrato);

		resultado.forEach(objeto => {
			let opcion = document.createElement("option");
			opcion.text = objeto.nume_ctr;
			opcion.value = objeto.iden_ctr;
			select.add(opcion);
		});

	}
</script>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link rel="stylesheet" href="css/style.css" type="text/css" />
</head>

<form name="form1" method="POST" action="fac_2medicamento.php" target='fr01'>
<body lang=ES  style='tab-interval:35.4pt'  >
<table class="Tbl0"><tr><td class="Td0" align='center'>FACTURACION - MEDICAMENTOS</td></tr></table><br>
<?php 
    include('php/conexion.php');
?>
<center><table class="Tbl0">
	<tr>
      <td class="Td2" align='right' width='10%'><b>Fecha:</td>
	  <td class="Td2" align='left' width='10%'><input type='date' id='fecha' name='fecha' size='10' maxlength='10'></td>
	  <td class="Td2" align='right' width='10%'><b>Identificación:</td>
	  <td class="Td2" align='left' width='10%'><input type='text' name='nrod_usu' size='14' maxlength='20'></td>
	  <td class="Td2" align='right' width='10%'><b>Servicio:</td>
	  <td class="Td2" align='left' width='10%'>
	  <select name='servicio'><option value=''>
	  <?php
		  	$consulta=mysql_query("SELECT codi_des,nomb_des FROM destipos WHERE codt_des='06' and homo2_des='F' order by nomb_des ");            
		    while($row=mysql_fetch_array($consulta)){
	            echo "<option value='$row[codi_des]'>$row[nomb_des]</option>";
            }
	  ?>
	  </select></td>

	  <td class="Td2" align='left' width='10%'><a href='#' onclick='envio()' ><img src='icons/feed_magnify.png' border='0' alt='Continuar' width=20 height=20 title='Buscar'></a></td>
	</tr>
	<tr>
		<td class="Td2" align='right' width='10%'><b>Contrato</td>
		<td class="Td2" align='left' width='10%'>
	  	<select id='contrato' name='contrato' onchange='mostrarTarifario()'><option value=''></option>
	  	<?php			
            $consulta=mysql_query("SELECT CODI_CON, NEPS_CON FROM contrato c WHERE c.ESTA_CON ='A' ORDER BY NEPS_CON");
		    while($row=mysql_fetch_array($consulta)){
	            echo "<option value='$row[CODI_CON]'>$row[NEPS_CON]</option>";
            }
	  	?>
	  	</select>
		</td>

		<td class="Td2" align='right' width='10%'><b>Tarifario</td>
		<td class="Td2" align='left' width='10%'>
	  	<select id='tarifario' name='tarifario'><option value=''></option>
	  	 
	  	</select>
		</td>
	</tr>
</table></center>
</form>
</body>
</html>

<?php
	$consultatarifa=mysql_query("SELECT iden_ctr,nume_ctr,codi_con FROM contratacion c WHERE esta_ctr ='A'");
	while($rowtarifa = mysql_fetch_assoc($consultatarifa)){
		$tarifario[] = $rowtarifa;
	}
	$json = json_encode($tarifario);
?>

<script>
    capturafecha();

	let tarifarios = JSON.parse('<?php echo $json; ?>');

</script>