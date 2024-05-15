<?php
session_start();

include('php/conexion.php');
//Aqui consulto los codigos de las consultas
$consulta = mysql_query("SELECT a.ccup_prim FROM areas a WHERE cod_areas ='$servicio'");
//echo "<br><br>".$consulta;
if(mysql_num_rows($consulta)){
	$rowcon = mysql_fetch_array($consulta);
	$codigoconsulta = $rowcon['ccup_prim'];	
}

//Aqui creo la lista de tarco
$tarifas = array();
$tarifa = new Tarco();

//Aqui cargo el tarifario
$consultatarifa="SELECT t.iden_tco, t.valo_tco, c.codi_cup, c.descrip 
FROM tarco t 
INNER JOIN mapii m ON m.iden_map = t.iden_map
INNER JOIN cups c ON c.codigo = m.codi_map 
WHERE t.clas_tco ='P' AND t.iden_ctr = '$tarifario' AND c.codi_cup='$codigoconsulta'";
//echo "<br>".$consultatarifa;
$resconsulta = mysql_query($consultatarifa);
while($rowtarifa = mysql_fetch_array($resconsulta)){
	$tarifa->iden_tco = $rowtarifa['iden_tco'];
	$tarifa->valo_tco = $rowtarifa['valo_tco'];
	$tarifa->codi_cup = $rowtarifa['codi_cup'];
	$tarifa->descrip = $rowtarifa['descrip'];	
	$tarifas[] = $tarifa;	
}
?>

<html>
<head>
<title>PROGRAMA DE FACTURACIÓN</title>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>


function facturar(iden_cpl,iden_tco){	
	document.getElementById("iden_cpl").value = iden_cpl;
	document.getElementById("iden_tco").value = iden_tco;
	//document.form1.submit();
	
	$.ajax({			
            url: 'fac_2facturarconsulta.php', // Ruta al script PHP
            type: 'POST', // Método de envío de datos
			data:{
				iden_cpl:$('#iden_cpl').val(),
				iden_tco:$('#iden_tco').val(),
				iden_ctr:$('#iden_ctr').val()
			},
			beforeSend: function() {
        		// Este código se ejecuta antes de enviar la petición
        		// Puedes generar tu mensaje aquí
        		$('#mensaje').text('Facturando...');
    		},
            success: function(response) { // Función que se ejecuta si la solicitud es exitosa
                console.log(response); // Imprime la respuesta del servidor en la consola
				alert(response);
				$('#mensaje').text('');
				recargar();
            },
            error: function(jqXHR, textStatus, errorThrown) { // Función que se ejecuta si hay un error
                console.error(textStatus, errorThrown); // Imprime el error en la consola
            }
        });

}

function recargar(){
	// Almacenar los datos en localStorage
	localStorage.setItem('postdata', JSON.stringify(postdata));

	// Recargar la página
	location.reload();

	// Después de la recarga, recuperar los datos
	var postdata = JSON.parse(localStorage.getItem('postdata'));

	// Limpiar los datos de localStorage
	localStorage.removeItem('postdata');
}
</script>

<link rel="stylesheet" href="css/style.css" type="text/css" />
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

</head>

<form id="form1" name="form1" method="POST" action="fac_2facturarconsulta.php" target='fr02'>
<body lang=ES  style='tab-interval:35.4pt'  >
<table class="Tbl0"><tr><td class="Td0" align='center'>INFORMACION DE CONSULTAS </td></tr></table><br>
<div id="mensaje"></div>
<center><table class="Tbl0" border=1>
	<tr>
	  <?php

	  	$condicion='c.iden_dfa = 0 AND ';
        if(!empty($fecha)){$condicion=$condicion."c.feca_cpl = '$fecha' AND ";}
        if(!empty($nrod_usu)){$condicion=$condicion."u.NROD_USU='$nrod_usu' AND ";}
		if(!empty($servicio)){$condicion=$condicion."c.area_cpl='$servicio' AND ";}		
		if(!empty($contrato)){$condicion=$condicion."e.cont_ehi='$contrato' AND ";}		

		$condicion=SUBSTR($condicion,0,-5);

		$_pagi_sql="SELECT e.cous_ehi,c.iden_cpl,e.cont_ehi,c.feca_cpl,c.area_cpl,
        u.NROD_USU, CONCAT(U.PNOM_USU,' ',U.SNOM_USU,' ',U.PAPE_USU,' ',U.SAPE_USU) nombre,
        ct.NEPS_CON 
        FROM encabesadohistoria e
        INNER JOIN consultaprincipal c ON c.numc_cpl = e.numc_ehi
        INNER JOIN usuario u ON u.CODI_USU = e.cous_ehi
        INNER JOIN contrato ct on ct.CODI_CON = e.cont_ehi 
        WHERE ".$condicion;
        echo "<br><br>".$_pagi_sql;
		
        $_pagi_result=mysql_query($_pagi_sql);
		if(mysql_num_rows($_pagi_result)!=0){
			echo "<table class='Tbl0'>";
			echo "<th class='Th0' width='3%'>OPC</th>
                <th class='Th0' width='10%'>Identificación</th>
                <th class='Th0' width='30%'>Nombre</th>
			    <th class='Th0' width='30%'>Contrato</th>
			    <th class='Th0' width='10%'>Fecha</th>
				<th class='Th0' width='10%'>Código</th>
				<th class='Th0' width='7%'>Valor</th>";
			while($row = mysql_fetch_array($_pagi_result)){
				echo "<tr>";
				$tarifaFiltro = filtrarTarco($tarifas,$codigoconsulta);				
				if (is_null($tarifaFiltro->iden_tco)){					
					echo "<td></td>";
				}
				else{
					echo "<td><a href='#' onclick='facturar($row[iden_cpl],$tarifaFiltro->iden_tco)'><img src='icons/feed_go.png' border='0' alt='Facturar' width=20 height=20 title='Facturar'></a></td>";
				}				
				echo "<td class='Td2'>".$row['NROD_USU']."</td>";
				echo "<td class='Td2'>".$row['nombre']."</td>";
				echo "<td class='Td2'>".$row['NEPS_CON']."</td>";
				echo "<td class='Td2'>".SUBSTR($row['feca_cpl'],0,10)."</td>";
				if(empty($codigoconsulta)){
					echo "<td class='Td2'>Sin tarifario</td>";
				}				
				else{
					echo "<td class='Td2'>".$codigoconsulta."</td>";					
					if (is_null($tarifaFiltro->iden_tco)){						
						echo "<td class='Td2'>Sin tarifario</td>";
					}
					else{						
						echo "<td class='Td2'>".$tarifa->valo_tco."</td>";					
					}					
				}
				echo "</tr>";
			}
			echo"</table></center>";
			echo "<table class='Tbl2'>";
			echo "<tr>";
			echo "<td class='Td1'></td>";			
		}
		echo"<input name=orden type=hidden>";
	  ?>
	</tr>
	</table>
	<input type="text" id="iden_cpl" name='iden_cpl'>
	<input type="text" id="iden_tco" name='iden_tco'>
	<input type="text" id="iden_ctr" name='iden_ctr' value='<?php echo $tarifario;?>'>
</form>
</body>
</html>

<?php 
class Tarco {
	public $iden_tco;
	public $valo_tco;
	public $codi_cup;
	public $descrip;
	
	
}

function filtrarTarco($tarifas_,$codigo_){
	$tarifaEncontrada = new Tarco();
	foreach ($tarifas_ as $objetoTarifa){
		if($objetoTarifa->codi_cup == $codigo_){
			$tarifaEncontrada = $objetoTarifa;
		}
	}
	return $tarifaEncontrada;
}
?>