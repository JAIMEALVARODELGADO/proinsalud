<?php
session_start();
?>
<html>
<head>
<title>PROGRAMA DE FACTURACIÓN</title>

<script language=JavaScript>
function ordenar(campo){

  /*form1.orden.value=campo;
  form1.action="fac_2consulta.php";
  form1.target='fr02';
  form1.submit();*/
}

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
<?include('php/conexion.php');?>
<center><table class="Tbl0" border=1>
	<tr>
	  <?php

        echo"<br>fecha ".$fecha;
        echo"<br>identificacion ".$nrod_usu;
        echo"<br>servicio ".$servicio;
		echo"<br>tarifario ".$tarifario;

	  	$condicion='';
        if(!empty($fecha)){$condicion=$condicion."c.feca_cpl = '$fecha' AND ";}
        if(!empty($nrod_usu)){$condicion=$condicion."u.NROD_USU='$nrod_usu' AND ";}
		if(!empty($servicio)){$condicion=$condicion."c.area_cpl='$servicio' AND ";}		
		if(!empty($contrato)){$condicion=$condicion."e.cont_ehi='$contrato' AND ";}		

		$condicion=SUBSTR($condicion,0,-5);
        echo "<br>Condicion ".$condicion;

        //if(!empty($orden)){$condicion=$condicion." ORDER BY $orden";}

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
                <th class='Th0' width='7%'><a href='#' onclick=\"ordenar('nrod_usu')\">Identificación</a></font></th>
                <th class='Th0' width='15%'><a href='#' onclick=\"ordenar('pnom_usu')\">Nombre</font></a></th>
			    <th class='Th0' width='10%'><a href='#' onclick=\"ordenar('neps_con')\">Contrato</font></a></th>
			    <th class='Th0' width='10%'><a href='#' onclick=\"ordenar('feca_cpl')\">Fecha</font></a></th>";
			while($row = mysql_fetch_array($_pagi_result)){
				echo "<tr>";
				$consultatarifario="SELECT * FROM tarco t WHERE iden_ctr = $tarifario";
				echo "<br>".$consultatarifario;
				//echo "<td><label><input name=codichk type=checkbox onclick=\"location.href='fac_2encab.php?id_ing=$row[id_ing]'\"></label></td>";
				//echo "<td><label><a href='#' onclick='envio()' ><img src='icons/feed_magnify.png' border='0' alt='Continuar' width=20 height=20 title='Buscar'></a></label></td>";
				echo "<td><a href='#' onclick='facturar()'><img src='icons/feed_go.png' border='0' alt='Facturar' width=20 height=20 title='Facturar'></a></td>";
				echo "<td class='Td2'>".$row['NROD_USU']."</td>";
				echo "<td class='Td2'>".$row['nombre']."</td>";
				echo "<td class='Td2'>".$row['NEPS_CON']."</td>";
				echo "<td class='Td2'>".SUBSTR($row['feca_cpl'],0,10)."</td></tr>";
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