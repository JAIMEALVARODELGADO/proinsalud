<?php
	ini_set('display_errors', TRUE);
	ini_set('display_startup_errors', TRUE);
	date_default_timezone_set('America/Bogota');

	define('EOL',(PHP_SAPI == 'cli') ? PHP_EOL : '<br />');

	//date_default_timezone_set('Europe/London');

	/** Include PHPExcel */
	//require_once dirname(__FILE__) . 'phpexcel/Classes/PHPExcel.php';
	require 'phpexcel/Classes/PHPExcel.php';

	// Create new PHPExcel object
	$objPHPExcel = new PHPExcel();

	// Set document properties
	$objPHPExcel->getProperties()->setCreator("Maarten Balliauw")
	->setLastModifiedBy("Maarten Balliauw")
	->setTitle("Office 2007 XLSX Test Document")
	->setSubject("Office 2007 XLSX Test Document")
	->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
	->setKeywords("office 2007 openxml php")
	->setCategory("Test result file");
	set_time_limit(0);
	
	$fechaini=$fecharep.' 00:00:00';
	$fechafin=$fecharep.' 23:23:59';
	$cadena='';
	if($munisel!='9999')$cadena="AND ((areas.muni_area)='$munisel')";
	include ('php/conexion1.php');
	
	
	
	
	
	$cad=mysql_query("SELECT citas.id_cita, gestion_factura_enca.id_enca, gestion_factura_enca.num_factura, min(gestion_factura_deta.fecha) AS MinDefecha1, 
	usuario.NROD_USU, usuario.PNOM_USU, usuario.SNOM_USU, usuario.PAPE_USU, usuario.SAPE_USU, areas.nom_areas, contrato.NEPS_CON, 
	municipio.NOMB_MUN, gestion_factura_enca.estado, esta_cita.descrip_estaci
	FROM ((((((gestion_factura_deta INNER JOIN gestion_factura_enca ON gestion_factura_deta.id_enca = gestion_factura_enca.id_enca) 
	INNER JOIN (citas INNER JOIN horarios ON citas.ID_horario = horarios.ID_horario) ON gestion_factura_enca.numero_cita = citas.id_cita) 
	INNER JOIN areas ON horarios.Cserv_horario = areas.cod_areas) INNER JOIN usuario ON citas.Idusu_citas = usuario.CODI_USU) 
	INNER JOIN contrato ON citas.Cotra_citas = contrato.CODI_CON) INNER JOIN municipio ON gestion_factura_enca.municipio = municipio.CODI_MUN) 
	INNER JOIN esta_cita ON citas.Esta_cita = esta_cita.cod_estaci
	WHERE (((gestion_factura_deta.fecha)>='$fechaini' And (gestion_factura_deta.fecha)<='$fechafin') $cadena)
	GROUP BY gestion_factura_enca.id_enca, gestion_factura_enca.num_factura, usuario.NROD_USU, usuario.PNOM_USU, usuario.SNOM_USU, 
	usuario.PAPE_USU, usuario.SAPE_USU, areas.nom_areas, contrato.NEPS_CON, municipio.NOMB_MUN, gestion_factura_enca.estado, 
	esta_cita.descrip_estaci");
	if(!$cad)echo mysql_error();
	
	
	
	if(mysql_num_rows($cad)>0)
	{
		
			
		
		$m=1;	
		while($row=mysql_fetch_array($cad))
		{				
			
			
			$idcita=$row['id_cita'];
			$iden=$row['id_enca'];
			$NOMB_MUN=$row['NOMB_MUN'];
			$nom_areas=$row['nom_areas'];
			$NEPS_CON=$row['NEPS_CON'];
			$num_factura=$row['num_factura'];
			$fecsol=$row['MínDefecha1'];
			$cedula=$row['NROD_USU'];
			$nombre=$row['PNOM_USU'].' '.$row['SNOM_USU'].' '.$row['PAPE_USU'].' '.$row['SAPE_USU'];				
			$estacita=$row['descrip_estaci'];
			$estafac=$row['estado'];
			$bfac=mysql_query("SELECT gestion_factura_enca.id_enca, gestion_factura_enca.num_factura, gestion_factura_deta.fecha, gestion_factura_deta.usuario, cut.nomb_usua
			FROM (gestion_factura_deta INNER JOIN gestion_factura_enca ON gestion_factura_deta.id_enca = gestion_factura_enca.id_enca) INNER JOIN general.cut ON gestion_factura_deta.usuario = cut.ide_usua
			WHERE (((gestion_factura_enca.id_enca)='$iden') AND ((gestion_factura_deta.estado)='FA'))");
			$factura='';
			$fechafac='';
			$nomusuario='';
			while($rfac=mysql_fetch_array($bfac))
			{
				$factura=$rfac['num_factura'];
				$fechafac=$rfac['fecha'];
				$nomusuario=$rfac['nomb_usua'];
				
			}
			if(empty($estafac))$estafac="PE";
			if($estafac=="PE")$estado="PENDIENTE";
			if($estafac=="SO")$estado="SOLICITADO";
			if($estafac=="FA")$estado="FACTURADO";
			if($estafac=="FI")$estado="FINALIZADO";
			if($m==1)
			{
				$objPHPExcel->setActiveSheetIndex(0);
				$objPHPExcel->getActiveSheet()				
				->setCellValue('A'.$m, 'MUNICIPIO')
				->setCellValue('B'.$m, 'AREA')
				->setCellValue('C'.$m, 'PACIENTE')
				->setCellValue('D'.$m, 'CONTRATO')
				->setCellValue('E'.$m, 'ESTADO CONSULTA')
				->setCellValue('F'.$m, 'FACTURA')
				->setCellValue('G'.$m, 'FECHA FACTURA')
				->setCellValue('H'.$m, 'FUNCIONARIO FACTURA')
				->setCellValue('I'.$m, 'FUNCIONARIO FACTURA')
				->setCellValue('J'.$m, 'ESTADO FACTURA');
			}
			
			$n=$m+1;
			$objPHPExcel->setActiveSheetIndex(0);
			$objPHPExcel->getActiveSheet()
			->setCellValue('A'.$n, $NOMB_MUN)
			->setCellValue('B'.$n, $nom_areas)
			->setCellValue('C'.$n, $cedula)
			->setCellValue('D'.$n, $nombre)
			->setCellValue('E'.$n, $NEPS_CON)
			->setCellValue('F'.$n, $estacita)
			->setCellValue('G'.$n, $factura)
			->setCellValue('H'.$n, $fechafac)
			->setCellValue('I'.$n, $nomusuario)
			->setCellValue('J'.$n, $estado);
			
			$m++;	
		}
	}
	
	$fectitulo=substr($fechaini,0,10);
	$objPHPExcel->getActiveSheet()->freezePane('A2');
	$objPHPExcel->getActiveSheet()->getStyle('A1:J1')->getFont()->setBold(true);
	$objPHPExcel->getActiveSheet()->getStyle('A'.$n.':J'.$n)->getFont()->setBold(false);
	$objPHPExcel->getActiveSheet()->setAutoFilter($objPHPExcel->getActiveSheet()->calculateWorksheetDimension());		
	$objPHPExcel->getActiveSheet()->setTitle($fectitulo);
	
	
	
	$callStartTime = microtime(true);
	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
	$objWriter->save(str_replace('.php', '.xlsx', __FILE__));
	$callEndTime = microtime(true);
	$callTime = $callEndTime - $callStartTime;
	header('Location: factura_reporte_excel.xlsx?'.time());
	?>
		
			
			
			
			
			
			
			
			
			
			
			
			
			
			
	