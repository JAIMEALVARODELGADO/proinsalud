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

/*if ($tarifas === null || empty($tarifas) ){
	echo "es null";
}*/
/*foreach ($tarifas as $objetoTarifa) {
    echo " desde el arreglo iden_tco: " . $objetoTarifa->iden_tco . ", 
	codi_cup: " . $objetoTarifa->codi_cup . ",
	descrip: " . $objetoTarifa->descrip . ",
	valo_tco: " . $objetoTarifa->valo_tco . "<br>";
	
}*/
//echo "<br>iden_tco--- ".$tarifas[0].iden_tco;
//$json = json_encode($tarifas);
//echo $json;
?>

<html>
<head>
<title>PROGRAMA DE FACTURACIÓN</title>

<script>

function facturar(){
	alert("Si");
	document.form1.submit();
}
</script>

<link rel="stylesheet" href="css/style.css" type="text/css" />
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
</head>

<form name="form1" method="POST" action="fac_2facturarconsulta.php" target='fr02'>
<body lang=ES  style='tab-interval:35.4pt'  >
<table class="Tbl0"><tr><td class="Td0" align='center'>INFORMACION DE CONSULTAS </td></tr></table><br>

<center><table class="Tbl0" border=1>
	<tr>
	  <?php

        /*echo"<br>fecha ".$fecha;
        echo"<br>identificacion ".$nrod_usu;
        echo"<br>servicio ".$servicio;
		echo"<br>tarifario ".$tarifario;*/

	  	$condicion='';
        if(!empty($fecha)){$condicion=$condicion."c.feca_cpl = '$fecha' AND ";}
        if(!empty($nrod_usu)){$condicion=$condicion."u.NROD_USU='$nrod_usu' AND ";}
		if(!empty($servicio)){$condicion=$condicion."c.area_cpl='$servicio' AND ";}		
		if(!empty($contrato)){$condicion=$condicion."e.cont_ehi='$contrato' AND ";}		

		$condicion=SUBSTR($condicion,0,-5);
        //echo "<br>Condicion ".$condicion;

        //if(!empty($orden)){$condicion=$condicion." ORDER BY $orden";}

		$_pagi_sql="SELECT e.cous_ehi,c.iden_cpl,e.cont_ehi,c.feca_cpl,c.area_cpl,
        u.NROD_USU, CONCAT(U.PNOM_USU,' ',U.SNOM_USU,' ',U.PAPE_USU,' ',U.SAPE_USU) nombre,
        ct.NEPS_CON 
        FROM encabesadohistoria e
        INNER JOIN consultaprincipal c ON c.numc_cpl = e.numc_ehi
        INNER JOIN usuario u ON u.CODI_USU = e.cous_ehi
        INNER JOIN contrato ct on ct.CODI_CON = e.cont_ehi 
        WHERE ".$condicion;
        //echo "<br><br>".$_pagi_sql;
		
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
				//$valor = traevalor($codigoconsulta,$resconsulta);
				//$consultatarifario="SELECT * FROM tarco t WHERE iden_ctr = $tarifario";
				//echo "<br>".$consultatarifario;
				//echo "<td><label><input name=codichk type=checkbox onclick=\"location.href='fac_2encab.php?id_ing=$row[id_ing]'\"></label></td>";
				//echo "<td><label><a href='#' onclick='envio()' ><img src='icons/feed_magnify.png' border='0' alt='Continuar' width=20 height=20 title='Buscar'></a></label></td>";
				$tarifaFiltro = filtrarTarco($tarifas,$codigoconsulta);
				//echo "<br>".$tarifa->iden_tco;
				//echo "<br>Tarifa reusltante...".$tarifa->valo_tco;

				//echo $tarifa->valo_tco;
				echo "<td><a href='#' onclick='facturar()'><img src='icons/feed_go.png' border='0' alt='Facturar' width=20 height=20 title='Facturar'></a></td>";
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
	//echo "<br>cod...".$cod;
	//echo "<br>cantidad ".count($arr);
	$tarifaEncontrada = new Tarco();
	foreach ($tarifas_ as $objetoTarifa){
		//echo "<br>obj... ".$objetoTarifa->codi_cup." == var--- ".$codigo_;
		//echo "<br>Son iguales? ".$objetoTarifa->codi_cup == $codigo_;
		if($objetoTarifa->codi_cup == $codigo_){
			//echo "<br>Si son iguales---";
			$tarifaEncontrada = $objetoTarifa;
		}
	}
	//echo "<br>En la funcion---".$tarifaEncontrada->valo_tco;
	return $tarifaEncontrada;
}
?>