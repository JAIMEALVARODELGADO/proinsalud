<html>
<head>
<title>PROGRAMA DE FACTURACIÓN</title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<link rel="stylesheet" href="css/style.css" type="text/css" />
<meta charset="UTF-8">
</head>
<script language='javascript'>
	function validar(){
		var error="";
		if(document.getElementById("prefijo").value==""){
			error=error+"El prefijo es requerido\n";
		}
		if(document.getElementById("consecutivo").value==""){
			error=error+"El consecutivo es requerido\n";
		}
		if(document.getElementById("encabezado").value==""){
			error=error+"El texto para el encabezado de la factura es requerido\n";
		}
		if(document.getElementById("pie").value==""){
			error=error+"El texto para el pié de la factura es requerido\n";
		}
		


		if(error!=""){
			alert(error);
		}
		else{
			guardar()
		}
		
	}

	function activarCaptura(){
		document.getElementById("formularioCaptura").style.display = "block";
	}
	
	function guardar(){
		$.ajax({			
				url: 'fac_guardaconsecutivo.php', // Ruta al script PHP
				type: 'POST', // Método de envío de datos
				data:{
					id_consecutivo:document.getElementById("id_consecutivo").value,
					prefijo:document.getElementById("prefijo").value,
					consecutivo:document.getElementById("consecutivo").value,
					encabezado:document.getElementById("encabezado").value,
					pie:document.getElementById("pie").value,
					estado:document.getElementById("estado").value
				},
				beforeSend: function() {
					document.getElementById("mensaje").style.display = "block";
					$('#mensaje').text('Guardando...');
				},
				success: function(response) { 
					//console.log(response); // Imprime la respuesta del servidor en la consola
					$('#mensaje').text(response);					
					document.getElementById("mensaje").style.display = "none";					
					cancelar();
					location.reload();					
				},
				error: function(jqXHR, textStatus, errorThrown) {
					console.error(textStatus, errorThrown); // Imprime el error en la consola
				}
			});
	}	

	function cancelar(){
		document.getElementById("id_consecutivo").value = "";
		document.getElementById("prefijo").value="";
		document.getElementById("consecutivo").value="";
		document.getElementById("encabezado").value="";
		document.getElementById("pie").value="";
		document.getElementById("estado").value="";
		document.getElementById("formularioCaptura").style.display = "none";
	}

	function editar(consecutivo){		
		consultar(consecutivo)
	}

	function consultar(consec_){
		$.ajax({			
				url: 'fac_consultarconsecutivo.php', // Ruta al script PHP
				type: 'POST', // Método de envío de datos
				data:{
					id_consecutivo:consec_
				},
				beforeSend: function() {
					document.getElementById("mensaje").style.display = "block";
					$('#mensaje').text('Consultando...');
				},
				success: function(response) { 
					//console.log(response); // Imprime la respuesta del servidor en la consola					
					document.getElementById("mensaje").style.display = "none";					
					actualizarRegistro(response);
					
				},
				error: function(jqXHR, textStatus, errorThrown) {
					console.error(textStatus, errorThrown); // Imprime el error en la consola
				}
			});
	}
	
	function actualizarRegistro(data){		
		const consec_ = JSON.parse(data);		
		activarCaptura();		
		document.getElementById("id_consecutivo").value = consec_.id_consecutivo;
		document.getElementById("prefijo").value = consec_.prefijo;
		document.getElementById("consecutivo").value = consec_.numero_fac;
		document.getElementById("encabezado").value = consec_.encabezado_fac;
		document.getElementById("pie").value = consec_.pie_fac;
		document.getElementById("estado").value = consec_.estado;		

	}
</script>
<body>
<table class='Tbl0'><tr><td class='Td0' align='center'>LISTADO DE CONSECUTIVOS</td></tr></table>
<?
include('php/funciones.php');
include('php/conexion.php');

echo "<table class='Tbl0'>";
echo "<th class='Th0' width='10%'>Opc</th>
      <th class='Th0' width='10%'>PREFIJO</th>
	  <th class='Th0' width='10%'>CONSECUTIVO</th>
	  <th class='Th0' width='30%'>ENCABEZADO PARA FACTURA</th>
	  <th class='Th0' width='30%'>PIE PARA FACTURA</th>
	  <th class='Th0' width='10%'>ESTADO</th>";
$consultapref=mysql_query("SELECT c.id_consecutivo,c.prefijo,c.numero_fac,c.encabezado_fac,c.pie_fac,c.estado  FROM consecutivo c");
if(mysql_num_rows($consultapref)<>0){
  while($rowpref=mysql_fetch_array($consultapref)){
    echo "<tr>";
	echo "<td class='Td2'><a href='#'><img src='icons/feed_edit.png' border='0' alt='Editar' onclick='editar($rowpref[id_consecutivo])'></a></td>";
    echo "<td class='Td2'>$rowpref[prefijo]</td>";
    echo "<td class='Td2'>$rowpref[numero_fac]</td>";
	echo "<td class='Td2'>$rowpref[encabezado_fac]</td>";
	echo "<td class='Td2'>$rowpref[pie_fac]</td>";
	if($rowpref['estado']=='A'){
		$estado="Activo";
	}
	else{
		$estado="Inactivo";
	}
	echo "<td class='Td2'>$estado</td>";

    echo "</tr>";
  }
}
else{
  echo "<center>";
  echo "<p class=Msg>No existen registros para esta busqueda</p>";
  echo "</center>";
}
echo "</table>";
mysql_free_result($consultapref);
mysql_close();
?>
<br><br><div align='center'><button class='BtnGuardar' onclick=activarCaptura()>Crear nuevo</button></div>
<form action="">
	<div id="formularioCaptura" class="Formulario" style="display: none;">
		<!-- style="display: none;" -->
		<input type="hidden" id="id_consecutivo" name="id_consecutivo">
		<label for="prefijo">Prefijo</label>
		<br>
		<input type="text" id="prefijo" name="prefijo" size="10" maxlenght="10">
		<br>
		<label for="consecutivo">Consecutivo</label>
		<br>
		<input type="text" id="consecutivo" name="consecutivo" size="10" maxlenght="10s">
		<br>
		<label for="encabezado">Texto para el encabezado de la factura</label>
		<br>
		<textarea name="encabezado" id="encabezado" cols="150" rows="3"></textarea>
		<br>
		<label for="pie">Texto para pié de la factura</label>
		<br>
		<textarea name="pie" id="pie" cols="150" rows="3"></textarea>
		<br>
		<label for="estado">Estado</label>
		<br>
		<select name="estado" id="estado">
			<option value=""></option>
			<option value="A">Activo</option>
			<option value="I">Inactivo</option>
		</select>

		<br><br><br>
		<div class="contenedor">
			<div class="col1" align='center'>
				<input type='button' value='Guardar'  class='BtnGuardar' onclick='validar()'>
			</div>
			<div class="col1" align='center'>
				<input type='button' value='Cancelar'  class='BtnGuardar' onclick='cancelar()'>
			</div>
		</div>
	</div>
</form>

<div id="mensaje" class="Caja1" style="display: none;"></div>
</body>
</html>