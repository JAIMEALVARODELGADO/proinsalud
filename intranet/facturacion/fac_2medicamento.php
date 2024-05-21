<?php
session_start();

include('php/conexion.php');

//Aqui creo la lista de tarco
$tarifas = array();
$tarifa = new Tarco();

//Aqui cargo el tarifario
$consultatarifa="SELECT t.iden_tco, t.valo_tco, c.codi_cup, c.descrip 
FROM tarco t 
INNER JOIN mapii m ON m.iden_map = t.iden_map
INNER JOIN cups c ON c.codigo = m.codi_map 
WHERE t.clas_tco ='P' AND t.iden_ctr = '$tarifario' AND c.codi_cup='$codigoconsulta'";
echo "<br>".$consultatarifa;
$resconsulta = mysql_query($consultatarifa);
while($rowtarifa = mysql_fetch_array($resconsulta)){
	$tarifa->iden_tco = $rowtarifa['iden_tco'];
	$tarifa->valo_tco = $rowtarifa['valo_tco'];
	$tarifa->codi_cup = $rowtarifa['codi_cup'];
	$tarifa->descrip = $rowtarifa['descrip'];	
	$tarifas[] = $tarifa;	
}

//Aqui cargo los medicamentos
$medicamentos = array();
$consultamedicamentos="SELECT m.codi_mdi, m.ncsi_medi , m.csii_mdi ,m.nomb_mdi  FROM medicamentos2 m";
//echo "<br>".$consultamedicamentos;
$resconsultamedicamentos = mysql_query($consultamedicamentos);
while($rowmedicamento = mysql_fetch_array($resconsultamedicamentos)){
	$medicamento = new Medicamento();
	$medicamento->codi_mdi = $rowmedicamento['codi_mdi'];
	$medicamento->ncsi_medi = $rowmedicamento['ncsi_medi'];
	$medicamento->csii_mdi = $rowmedicamento['csii_mdi'];
	$medicamento->nomb_mdi = $rowmedicamento['nomb_mdi'];
	
	$medicamentos[] = $medicamento;	
}

//Aqui cargo los insumos
$insumos = array();
$consultainsumos="SELECT im.codi_ins, im.desc_ins FROM insu_med im";

//echo "<br>".$consultainsumos;
$resconsultainsumos = mysql_query($consultainsumos);
while($rowinsumo = mysql_fetch_array($resconsultainsumos)){
	$insumo = new Insumo();
	$insumo->codi_ins = $rowinsumo['codi_ins'];
	$insumo->desc_ins = $rowinsumo['desc_ins'];
	$insumos[] = $insumo;	
}

/*foreach ($insumos as $objetoMed){
	echo "<br> ";
	echo $objetoMed->codi_ins;
	echo " - ".$objetoMed->desc_ins;

}*/


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
				document.getElementById("mensaje").style.display = "block";
        		$('#mensaje').text('Facturando...');
    		},
            success: function(response) { // Función que se ejecuta si la solicitud es exitosa
                console.log(response); // Imprime la respuesta del servidor en la consola
				//alert(response);				
				$('#mensaje').text(response);
				//document.getElementById("mensaje").style.display = "none";
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

<form id="form1" name="form1" method="POST" action="fac_2facturarconsulta_.php" target='fr02'>
<body lang=ES  style='tab-interval:35.4pt'  >
<table class="Tbl0"><tr><td class="Td0" align='center'>INFORMACION DE APLICACIONES </td></tr></table><br>
<div id="mensaje" class="Caja1" style="display: none;"></div>
<center><table class="Tbl0" border=1>
	<tr>
	  <?php

	  	$condicion="ai.fact_adi <> 'S' AND ";
        if(!empty($fecha)){$condicion=$condicion."ai.fech_adi = '$fecha' AND ";}
        if(!empty($nrod_usu)){$condicion=$condicion."u.NROD_USU='$nrod_usu' AND ";}
		if(!empty($servicio)){$condicion=$condicion."ih.ubica_ing='$servicio' AND ";}		
		if(!empty($contrato)){$condicion=$condicion."ih.contra_ing='$contrato' AND ";}		

		$condicion=SUBSTR($condicion,0,-5);

		$_pagi_sql="SELECT ai.iden_adi,ai.tpin_adi,ai.idin_adi , CONCAT(ai.fech_adi,' ',ai.hora_adi) AS fecha,		
		c.CODI_CON ,c.NEPS_CON ,u.NROD_USU , CONCAT(u.PNOM_USU,' ',u.SNOM_USU,' ',u.PAPE_USU,' ',u.SAPE_USU) as nombre,ih.ubica_ing	
		FROM administra_insumo ai 
        INNER JOIN ingreso_hospitalario ih ON ih.id_ing =ai.id_ing 
        INNER JOIN usuario u ON u.CODI_USU = ih.codius_ing 
        INNER JOIN contrato c ON c.CODI_CON = ih.contra_ing         
        WHERE ".$condicion;
        //echo "<br><br>".$_pagi_sql;
		
        $_pagi_result=mysql_query($_pagi_sql);
		if(mysql_num_rows($_pagi_result)!=0){
			echo "<table class='Tbl0'>";
			echo "<th class='Th0' width='3%'>OPC</th>
                <th class='Th0' width='10%'>Identificación</th>
                <th class='Th0' width='20%'>Nombre</th>
			    <th class='Th0' width='20%'>Contrato</th>
			    <th class='Th0' width='10%'>Fecha</th>
				<th class='Th0' width='5%'>Tipo</th>
				<th class='Th0' width='25%'>Medicamento/Insumo</th>
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
				echo "<td class='Td2'>".SUBSTR($row['fecha'],0,16)."</td>";
				
				echo "<td class='Td2'>".$row[tpin_adi]."</td>";

				if($row[tpin_adi] == 'M'){
					$descripcion = buscarMedicamento($medicamentos,$row['idin_adi']);
				}
				else{
					$descripcion = buscarInsumo($insumos,$row['idin_adi']);
				}				

				echo "<td class='Td2'>".$row['idin_adi']." ".$descripcion."</td>";
								
				if (is_null($tarifaFiltro->iden_tco)){						
					echo "<td class='Td2'>Sin tarifario</td>";
				}
				else{						
					echo "<td class='Td2'>".$tarifa->valo_tco."</td>";					
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
	<input type="hidden" id="iden_cpl" name='iden_cpl'>
	<input type="hidden" id="iden_tco" name='iden_tco'>
	<input type="hidden" id="iden_ctr" name='iden_ctr' value='<?php echo $tarifario;?>'>
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

class Medicamento {
	public $codi_mdi;
	public $ncsi_medi;
	public $csii_mdi;
	public $nomb_mdi;
}

class Insumo {
	public $codi_ins;
	public $desc_ins;
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

function buscarMedicamento($medicamentos_,$codigo_){
	$desc_="";
	foreach ($medicamentos_ as $objetoMedicamento){
		if($objetoMedicamento->codi_mdi == $codigo_){
			$desc_ = $objetoMedicamento->nomb_mdi;
		}
	}
	return $desc_;
}

function buscarInsumo($insumos_,$codigo_){
	$desc_="";
	foreach ($insumos_ as $objetoInsumo){
		if($objetoInsumo->codi_ins == $codigo_){
			$desc_ = $objetoInsumo->desc_ins;
		}
	}
	return $desc_;
}
?>