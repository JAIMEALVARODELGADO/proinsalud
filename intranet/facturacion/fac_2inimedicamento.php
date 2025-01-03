<?php
session_start();
?>
<html>
<head>
<title>PROGRAMA DE FACTURACIÓN</title>
<SCRIPT LANGUAGE=JavaScript>
	var origen="";

	function activar(){
		origen=document.getElementById('origen').value;
		//alert(origen);		
		if(origen==='DI'){
			document.getElementById('servicio').disabled=true;
			document.getElementById('tipo').disabled=true;			
			document.getElementById('numero').disabled=false;
			document.getElementById('tarifario').disabled=true;
								
			const id_contrato = document.getElementById('id_contrato');
			id_contrato.innerHTML = '<b>Facturar al Contrato</b>';		
		}
		if(origen==='AP'){
			document.getElementById('servicio').disabled=false;
			document.getElementById('tipo').disabled=false;
			document.getElementById('numero').disabled=true;
			document.getElementById('tarifario').disabled=false;
			
			const id_contrato = document.getElementById('id_contrato');
			id_contrato.innerHTML = '<b>Contrato</b>';		
		}
	}

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
		error="";				
		origen = document.getElementById('origen').value;
		if(origen==='AP'){
			if(document.getElementById("fecha").value===""){			
				error="Debe elegir la fecha";
			}
			if(error!=""){
				alert(error);
			}
			else{
				form1.action='fac_2medicamento.php';
				form1.target='fr02';
				form1.submit();
			}			
		}
		else{
			if(form1.contrato.value==""){
				error=error+"\n Debe seleccionar el contrato";
			}
			if(error!=""){
				alert(error);
			}
			else{
				form1.action='fac_2medicamdispensados.php';
				form1.target='fr02';
				form1.submit();
			}
		}
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
      <td class="Td2" align='right' width='10%'><b>Origen:</td>
	  <td class="Td2" align='left' width='10%'>
	  <select id='origen' name='origen' onchange="activar()">
		<option value='AP'>Aplicaión-Hospitalización</option>
		<option value='DI'>Dispensación-Servicio Farmacéutico</option>
	  </select></td>
	  <td class="Td2" align='right' width='10%'><b>Número de dispensación:</td>
	  <td class="Td2" align='left' width='10%'><input type='text' name='numero' id='numero' size='14' maxlength='20' disabled=false></td>
	</tr>
	<tr>
      <td class="Td2" align='right' width='10%'><b>Fecha:</td>
	  <td class="Td2" align='left' width='10%'><input type='date' id='fecha' name='fecha' size='10' maxlength='10'></td>
	  <td class="Td2" align='right' width='10%'><b>Identificación:</td>
	  <td class="Td2" align='left' width='10%'><input type='text' name='nrod_usu' size='14' maxlength='20'></td>
	  <td class="Td2" align='right' width='10%'><b>Servicio:</td>
	  <td class="Td2" align='left' width='10%'>
	  <select name='servicio' id='servicio'><option value=''>
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
		<td class="Td2" align='right' width='10%'>
			<label for="id_contrato" id='id_contrato'><b>Contrato</b></label>			
		</td>
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

		<td class="Td2" align='right' width='10%'><b>Tipo</td>
		<td class="Td2" align='left' width='10%'>
	  	<select id='tipo' name='tipo'>
			<option value=''></option>
			<option value='M'>Medicamento</option>
			<option value='I'>Insumo</option>	  	 
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