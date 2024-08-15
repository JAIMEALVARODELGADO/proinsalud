<HTML>
<?php ?>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Censo por contrato</title>
<link rel="stylesheet" href="css/style.css" type="text/css" />
<style type="text/css">
<!--
.Estilo6 {font-family: Arial, Helvetica, sans-serif; font-size: 11px; }
.Estilo5 {font-family: Arial, Helvetica, sans-serif; font-size: 11px; font-weight: bold; }
-->
</style>
</head>
<body>
<form method="POST" name="form1" action="">
<table class="Tbl0">
<tr><td class="Estilo5" align='CENTER'><b>LISTADO DE PACIENTES HOSPITALIZADOS POR CONTRATO </td></tr>
</table>

<?php
		
	include("php/conexion2.php");
	//CREAR TABLA
	echo "<Table border=1  width=100% align=center cellpadding=0 Cellspacing=0>";
	echo "<th class=Estilo5>Cama</th>
		  <th class=Estilo5>Identificación</th>
		  <th class=Estilo5>Nombre</th>
		  <th class=Estilo5>Servicio</th>
		  <th class=Estilo5>Ingreso</th>
		  <th class=Estilo5>Dias Estancia</th>
		  <th class=Estilo5>Prefacturado</th>";
	//echo $area;
  
	$_pagi_sql=mysql_query(
		"SELECT 
				e.caac_ing, Max(e.id_ing) AS DCodHis, u.TDOC_USU, u.NROD_USU, e.caac_ing AS camaan, 
				concat(u.Pnom_usu,' ',u.Snom_usu,' ',u.Pape_usu,' ',u.Sape_usu) AS DNom, u.FNAC_USU, 
				uc.ESTA_UCO AS DEst, e.fecin_ing,c.NEPS_CON AS DEps, IF ( ht.Horas_tra > -1, ht.Horas_tra, 
				( SUBSTRING( TIMEDIFF( SYSDATE( ) , CONCAT( DATE( ht.Fecin_tra ) , ' ', ht.Horin_tra ) ) , 1, 
				( LENGTH( TIMEDIFF( SYSDATE( ) , ht.Fecin_tra ) ) -6 ) ) +0 ) ) AS DHoras, 
				CONCAT( DATE( ht.Fecin_tra ) , ' ', ht.Horin_tra ) AS DInicio, e.codius_ing AS DIdeUsu, u.PNOM_USU, 
				u.SNOM_USU, u.PAPE_USU, u.SAPE_USU, ht.ubica_tra AS cod_servicio
		FROM 
				(((Ingreso_hospitalario AS e INNER JOIN Hist_traza AS ht ON e.id_ing = ht.id_ing) 
				INNER JOIN Usuario AS u ON e.codius_ing = u.CODI_USU) 
				INNER JOIN Ucontrato AS uc ON (e.contra_ing = uc.CONT_UCO) AND (e.codius_ing = uc.CUSU_UCO)) 
				INNER JOIN Contrato AS c ON uc.CONT_UCO = c.CODI_CON
		WHERE 
				(((c.CODI_CON)='$area') AND ((ht.horas_tra)=-1) AND ((e.caac_ing)<>'RE'))
		GROUP BY 
				e.caac_ing, u.TDOC_USU, u.NROD_USU, e.caac_ing, 
				concat(u.Pnom_usu,' ',u.Snom_usu,' ',u.Pape_usu,' ',u.Sape_usu), 
				u.FNAC_USU, uc.ESTA_UCO, c.NEPS_CON, IF 
				( ht.Horas_tra > -1, ht.Horas_tra, ( SUBSTRING( TIMEDIFF( SYSDATE( ) , 
				CONCAT( DATE( ht.Fecin_tra ) , ' ', ht.Horin_tra ) ) , 1, 
				( LENGTH( TIMEDIFF( SYSDATE( ) , ht.Fecin_tra ) ) -6 ) ) +0 ) ), 
				CONCAT( DATE( ht.Fecin_tra ) , ' ', ht.Horin_tra ), e.codius_ing, 
				u.PNOM_USU, u.SNOM_USU, u.PAPE_USU, u.SAPE_USU
		ORDER BY 
				ht.ubica_tra, u.PNOM_USU");
	
	
	$i=0;
	 while($row=mysql_fetch_array($_pagi_sql))
	{
		$servicio='';
		$cod_servicio=$row['cod_servicio'];
		
		if($cod_servicio == '04'){
			$servicio = 'URGENCIAS';
		} else {
			$buscar=mysql_query("select nomb_des from destipos where codi_des='$cod_servicio'");
			while($fil=mysql_fetch_array($buscar)){
				$servicio=$fil['nomb_des'];
			}						
		}
		
		$camaactu=$row['camaan'];
		$buscam=mysql_query("select nomb_des from destipos where codi_des='$camaactu'");
		while($fil=mysql_fetch_array($buscam)){
			$camasi=$fil['nomb_des'];
		}
		
		//consultar el valor prefacturado a la fecha, se filtra por el número de ingreso 
		$ingreso=$row['DCodHis'];		
		$vprefac=null;
		$prefac=mysql_query("SELECT vtot_fac FROM encabezado_factura WHERE id_ing = '$ingreso' ");
		while($valor=mysql_fetch_array($prefac))
		{
			$vprefac=$valor['vtot_fac'];
		}
		if($vprefac==null){$vprefac=0;} //si no hay prefactura coloca el valor en cero
		
		$fechaing=$row['fecin_ing'];
		$horaing=$row['hora_ing'];
		$dia_est=estancia($fechaing,$horaing);
		if($cod_servicio=='0699')
		{
			if($area!='110')
			{
				echo "<tr>";
				echo "<td class='Estilo6'>".$camasi."</td>";
				echo "<td class='Estilo6'>".$row['NROD_USU']."</td>";
				echo "<td class='Estilo6'>".$row['DNom']."</td>";
				echo "<td class='Estilo6'>".$servicio."</td>";		
				echo "<td class='Estilo6'>".$row['DInicio']."</td>";
				echo "<td class='Estilo6'>".$dia_est."</td>";	
				echo "<td style='text-align: right;'>".NUMBER_FORMAT($vprefac,0,",",".")."</td>";	
				echo "</tr>";
				$i++;
			}
		}
		else
		{
			echo "<tr>";
			echo "<td class='Estilo6'>".$camasi."</td>";
			echo "<td class='Estilo6'>".$row['NROD_USU']."</td>";
			echo "<td class='Estilo6'>".$row['DNom']."</td>";
			echo "<td class='Estilo6'>".$servicio."</td>";		
			echo "<td class='Estilo6'>".$row['DInicio']."</td>";
			echo "<td class='Estilo6'>".$dia_est."</td>";	
			echo "<td style='text-align: right;'>".NUMBER_FORMAT($vprefac,0,",",".")."</td>";	
			echo "</tr>";
			$i++;	
		}
	}
	echo "</table>";	
	
	
	?>
	
</form>
<?
	echo "<br>";	
	function estancia($fechaing,$horaing)
    {
        //Esta funcion toma una fecha de nacimiento
        //desde una base de datos mysql
        //en formato aaaa/mm/dd y calcula la edad en nmeros enteros

        $anno=date('Y');	
		$mes=date('m');	
		$dia=date('d');	
		$hora=date('H');
		$minu=date('i');
		$segu=date('s');
		$numeroact= gmmktime ( $hora, $minu, $segu, $mes, $dia, $anno);//convierte a numero timestamp (int)

        //descomponer fecha de nacimiento
        $dia=substr($fechaing, 8, 2);
        $mes=substr($fechaing, 5, 2);
        $anno=substr($fechaing, 0, 4);		
		$segu=substr($horaing, 6, 2);
        $minu=substr($horaing, 3, 2);
        $hora=substr($horaing, 0, 2);
		$numeroing= gmmktime ( $hora, $minu, $segu, $mes, $dia, $anno);//convierte a numero timestamp (int)
		$difer=$numeroact-$numeroing;		
		$num1=floor($difer/60);
		$seg=$difer%60;	
		$num2=floor($num1/60);
		$min=$num1%60;		
		$dias=floor($num2/24);
		$horas=$num2%24;		
        $tiempo=$dias.' Dias  '.$horas.' Horas  ';
        return $tiempo;
	}
	?>
	
<center>
    <form method="POST" action="generar_excel.php">
        <input type="hidden" name="area" value="<?php echo $area; ?>"> 	
		<br>
        <input type="submit" value="Descargar reporte">
    </form>
</center>
</form>		
</body>
</HTML>

