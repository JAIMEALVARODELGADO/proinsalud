<?php
session_start();

include('php/conexion.php');

//Aqui creo la lista de tarco
$tarifas = array();

//1.Permitir seleccionar el tarifario al cual van los medicamentos
//2.Permitir seleccionar el contrato al cual va el cobro
//3.Adicionar los insumos
//4.Crear un chequeo para seleccionar cual medicamento se va a facturar


//Aqui cargo el tarifario

$consultatarifa="
SELECT t.iden_tco,t.clas_tco , t.valo_tco,m.codi_mdi, m.nomb_mdi
FROM tarco t
INNER JOIN medicamentos2 m ON m.codi_mdi = t.iden_map 
WHERE t.iden_ctr = '$tarifario'";

/*UNION
SELECT t.iden_tco,t.clas_tco , t.valo_tco, im.codi_ins AS codi_mdi, im.desc_ins AS nomb_mdi
FROM tarco t
INNER JOIN insu_med im  ON im.codi_ins = t.iden_map 
WHERE t.esta_tco = 'AC' AND t.iden_ctr = '$tarifario'*/

//echo "<br>".$consultatarifa;
$restarifario = mysql_query($consultatarifa);
while($rowtarifa = mysql_fetch_array($restarifario)){
	$tarifa = new Tarco();

	$tarifa->iden_tco = $rowtarifa['iden_tco'];
	$tarifa->clas_tco = $rowtarifa['clas_tco'];
	$tarifa->valo_tco = $rowtarifa['valo_tco'];
	$tarifa->codi_mdi = $rowtarifa['codi_mdi'];
	$tarifa->nomb_mdi = $rowtarifa['nomb_mdi'];	

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




?>

<html>
<head>
<title>PROGRAMA DE FACTURACIÓN</title>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>

function facturar(nume_for,tarifario){	
	
	$.ajax({			
            url: 'fac_2facturarmedicamentosdispensados.php', // Ruta al script PHP
            type: 'POST', // Método de envío de datos
			data:{
				nume_for:nume_for,
				iden_ctr:tarifario				
			},
			beforeSend: function() {
        		// Este código se ejecuta antes de enviar la petición
        		// Puedes generar tu mensaje aquí
				document.getElementById("mensaje").style.display = "block";
        		$('#mensaje').text('Facturando...');
    		},
            success: function(response) { // Función que se ejecuta si la solicitud es exitosa
                //console.log(response); // Imprime la respuesta del servidor en la consola
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

<form id="form1" name="form1" method="POST" action="" target='fr02'>
<body lang=ES  style='tab-interval:35.4pt'  >
<table class="Tbl0"><tr><td class="Td0" align='center'>INFORMACION DE DISPENSACIONES </td></tr></table><br>
<div id="mensaje" class="Caja1" style="display: none;"></div>

<center><table class="Tbl0" border=1>
	<tr>
	  <?php

        $condicion="";
        if(!empty($fecha)){$condicion=$condicion."f.fdis_for = '$fecha' AND ";}
        if(!empty($nrod_usu)){$condicion=$condicion."u.NROD_USU='$nrod_usu' AND ";}
        if(!empty($contrato)){$condicion=$condicion."c.codi_con='$contrato' AND ";}		
		if(!empty($numero)){$condicion=$condicion."f.nume_for='$numero' AND ";}		
		
		$condicion=SUBSTR($condicion,0,-5);
		//echo $condicion;    
        /*$_pagi_sql="SELECT f.nume_for,
        u.NROD_USU, CONCAT(u.PNOM_USU,' ',u.SNOM_USU,' ',u.PAPE_USU,' ',u.SAPE_USU) as nombre,
        c.NEPS_CON        
        FROM formedica.formulamae f 
        INNER JOIN usuario u ON u.NROD_USU = f.codi_usu
        INNER JOIN contrato c ON c.CSII_CON =f.ccos_for
        WHERE ".$condicion." ORDER BY f.nume_for";*/
        
		$_pagi_sql="SELECT f.nume_for, u.NROD_USU, CONCAT(u.PNOM_USU,' ',u.SNOM_USU,' ',u.PAPE_USU,' ',u.SAPE_USU) as nombre, c.NEPS_CON
		,(SELECT COUNT(*) FROM formedica.formuladet fd
		WHERE fd.factu_for <> 'S' AND LENGTH(fd.codi_pro)=6 AND fd.nume_for =f.nume_for) cantidadRegistros
		FROM formedica.formulamae f 
		INNER JOIN usuario u ON u.NROD_USU = f.codi_usu 
		INNER JOIN contrato c ON c.CSII_CON =f.ccos_for 
		WHERE ".$condicion."
		AND (SELECT COUNT(*) FROM formedica.formuladet fd		
		WHERE (ISNULL(fd.factu_for) OR fd.factu_for<>'S') AND LENGTH(fd.codi_pro)=6 AND fd.nume_for =f.nume_for) > 0
		ORDER BY f.nume_for";
		//echo "<br><br>".$_pagi_sql;        
		
        $_pagi_result=mysql_query($_pagi_sql);
		if(mysql_num_rows($_pagi_result)!=0){
			echo "<table class='Tbl0'>";
			
			while($row = mysql_fetch_array($_pagi_result)){
                echo "<th class='Th0' width='3%'>OPC</th>
                <th class='Th0' width='10%'>Número</th>
                <th class='Th0' width='10%'>Identificación</th>
                <th class='Th0' width='15%'>Nombre</th>				
			    <th class='Th0' width='15%'>Contrato</th>";
                echo "<tr>";
                
                echo "<td><a href='#' onclick='facturar($row[nume_for],$tarifario)'><img src='icons/feed_go.png' border='0' alt='Facturar' width=20 height=20 title='Facturar'></a></td>";
                echo "<td class='Td2'>".$row['nume_for']."</td>";
				echo "<td class='Td2'>".$row['NROD_USU']."</td>";
				echo "<td class='Td2'>".$row['nombre']."</td>";				
				echo "<td class='Td2'>".$row['NEPS_CON']."</td>";
				
                		
				echo "</tr>";
                $consultadet="SELECT f.codi_pro,f.cdis_for  FROM formedica.formuladet f 
                WHERE LENGTH(f.codi_pro)=6 AND (ISNULL(f.factu_for) OR f.factu_for<>'S') AND f.nume_for ='$row[nume_for]'";
                //echo "<br>".$consultadet;
                $consultadet=mysql_query($consultadet);				
		        if(mysql_num_rows($consultadet)!=0){
                    
        		    echo "<th class='Th1'></th>
                        <th class='Th1'>Código</th>
                        <th class='Th1'>Medicamento</th>
				        <th class='Th1'>Cantidad</th>
				        <th class='Th1'>Valor</th>";
			        while($rowdet = mysql_fetch_array($consultadet)){
                        echo "<tr>";
                        $descripcion = buscarMedicamento($medicamentos,$rowdet['codi_pro']);
                        echo "<td></td>";
				        echo "<td class='Td2'>".$rowdet['codi_pro']."</td>";
                        echo "<td class='Td2'>".$descripcion."</td>";
				        echo "<td class='Td2' align='center'>".$rowdet['cdis_for']."</td>";
                        
                        $tarifaFiltro = filtrarTarco($tarifas,$rowdet['codi_pro']);				
				        if (is_null($tarifaFiltro->iden_tco)){						
					        echo "<td class='Td5'>Sin tarifario</td>";
				        }
				        else{						
					        echo "<td class='Td5'>".number_format($tarifaFiltro->valo_tco,0, '.', ',')."</td>";					
				        }
                        echo "</tr>";
			        }                                        
                }                
            }
			
		}		
	  ?>
	</tr>
	</table>	

</form>
</body>
</html>

<?php 
class Tarco {
	public $iden_tco;
	public $clas_tco;
	public $valo_tco;
	public $codi_mdi;
	public $nomb_mdi;
}

class Medicamento {
	public $codi_mdi;
	public $ncsi_medi;
	public $csii_mdi;
	public $nomb_mdi;
}


function filtrarTarco($tarifas_,$codigo_){
	$tarifaEncontrada = new Tarco();
	foreach ($tarifas_ as $objetoTarifa){
		if($objetoTarifa->codi_mdi == $codigo_){
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

?>