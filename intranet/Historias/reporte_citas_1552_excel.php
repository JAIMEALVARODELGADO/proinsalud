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
	$archivo="tmp/valores.txt";	
	include ('php/conexion2.php');
	if($contrato=='00')$cad="";
	else $cad="AND ((citas.Cotra_citas)='$contrato')";
	$ini=mysql_query("SELECT municipio.CODI_MUN, municipio.NOMB_MUN, usuario.NROD_USU, usuario.TDOC_USU, 
	usuario.PNOM_USU,' ',usuario.SNOM_USU,' ',usuario.PAPE_USU,' ',usuario.SAPE_USU, usuario.DIRE_USU, usuario.TRES_USU, 
	usuario.TEL2_USU, destipos.nomb_des AS especialidad, citas.Cotra_citas, citas.primera_cita,
	esta_cita.descrip_estaci, MAX(cups_citas_medicas.codi_cup) as codi_cup, 
	MAX(cups_citas_medicas.Nombre) as nomcups, citas.Fsolusu_citas, citas.fecdeseada, horarios.Fecha_horario
	FROM ((((((horarios INNER JOIN citas ON horarios.ID_horario = citas.ID_horario) INNER JOIN areas ON horarios.Cserv_horario = areas.cod_areas) 
	INNER JOIN destipos ON areas.codi_des = destipos.codi_des) INNER JOIN cups_citas_medicas ON destipos.codi_des = cups_citas_medicas.especialidad) 
	INNER JOIN usuario ON citas.Idusu_citas = usuario.CODI_USU) LEFT JOIN municipio ON areas.muni_area = municipio.CODI_MUN) 
	INNER JOIN esta_cita ON citas.Esta_cita = esta_cita.cod_estaci
	WHERE (((horarios.Fecha_horario)>='$fecini' And (horarios.Fecha_horario)<='$fecfin') AND ((areas.arci_area)='5801') $cad)
	GROUP BY municipio.CODI_MUN, municipio.NOMB_MUN, usuario.NROD_USU, usuario.TDOC_USU, 
	CONCAT(usuario.PNOM_USU,' ',usuario.SNOM_USU,' ',usuario.PAPE_USU,' ',usuario.SAPE_USU), usuario.DIRE_USU, usuario.TRES_USU, 
	usuario.TEL2_USU, destipos.nomb_des, citas.primera_cita,
	esta_cita.descrip_estaci, citas.Fsolusu_citas, citas.fecdeseada, horarios.Fecha_horario, citas.Cotra_citas");
	
	$m=1;	
	while($rini=mysql_fetch_array($ini))
	{
		$codmuni=$rini['CODI_MUN'];
		
		$lar=strlen($codmuni);
		if($lar==4)
		{
			$depar=substr($codmuni,0,1);
			$muni=substr($codmuni,1,3);
		}
		if($lar==5)
		{
			$depar=substr($codmuni,0,2);
			$muni=substr($codmuni,2,3);
		}
		
		$nommuni=$rini['NOMB_MUN'];
		$documen=$rini['NROD_USU'];
		$tipodoc=$rini['TDOC_USU'];
		$pnom=$rini['PNOM_USU'];
		$snom=$rini['SNOM_USU'];
		$pape=$rini['PAPE_USU'];
		$sape=$rini['SAPE_USU'];
		$direc=$rini['DIRE_USU'];
		$tele1=$rini['TRES_USU'];
		$tele2=$rini['TEL2_USU'];
		if($tele1=='')$tele1=$tele2;
		$especialidad=$rini['especialidad'];
		$contra=$rini['Cotra_citas'];
		$bcontra=mysql_query("select * from contrato where CODI_CON='$contra'");
		$rcon=mysql_fetch_array($bcontra);
		$contrato=$rcon['NEPS_CON'];
		
		if($rini['primera_cita']=='S')$tipocita="PRIMERA VEZ";
		else if($rini['primera_cita']=='N')$tipocita="CONTROL";
		else $tipocita="";
		
		
		
		$estado=$rini['descrip_estaci'];
		$codicup=$rini['codi_cup'];
		$nomcup=$rini['nomcups'];
		$fsolicitud=date("d/m/Y", strtotime($rini['Fsolusu_citas']));
		$fecdeseada=date("d/m/Y", strtotime($rini['fecdeseada']));
		$fechaatencion=date("d/m/Y", strtotime($rini['Fecha_horario']));
		if($m==1)
		{
			$objPHPExcel->setActiveSheetIndex(0);
			$objPHPExcel->getActiveSheet()
			->setCellValue('A'.$m, 'NUMERO')
			->setCellValue('B'.$m, 'TIPO DOCUMENTO')
			->setCellValue('C'.$m, 'NUMERO DE IDENTIFICACION')
			->setCellValue('D'.$m, 'PRIMER NOMBRES')
			->setCellValue('E'.$m, 'SEGUNDO NOMBRES')
			->setCellValue('F'.$m, 'PRIMER APELLIDO')
			->setCellValue('G'.$m, 'SEGUNDO APELLIDO')
			->setCellValue('H'.$m, 'DIRECCION')	
			->setCellValue('I'.$m, 'TELEFONO')
			->setCellValue('J'.$m, 'CONTRATO')			
			->setCellValue('K'.$m, 'MUNICIPIO')
			->setCellValue('L'.$m, 'DEPARTAMENTO')
			->setCellValue('M'.$m, 'NOMBRE MUNICIPIO')
			->setCellValue('N'.$m, 'ESTADO CITA')
			->setCellValue('O'.$m, 'CODIGO DEL SERVICIO (CUPS)')
			->setCellValue('P'.$m, 'SERVICIO PRESTADO')
			->setCellValue('Q'.$m, 'ESPECIALIDAD')
			->setCellValue('R'.$m, 'FECHA SOLICITUD')
			->setCellValue('S'.$m, 'FECHA DESEADA POR EL USUARIO')
			->setCellValue('T'.$m, 'FECHA ASIGNACIÓN')
			->setCellValue('U'.$m, 'TIPO CITA');
			
		}
		
		
		$n=$m+1;
		$objPHPExcel->setActiveSheetIndex(0);
		$objPHPExcel->getActiveSheet()
		->setCellValue('A'.$n, $m)
		->setCellValue('B'.$n, $tipodoc)
		->setCellValue('C'.$n, $documen)
		->setCellValue('D'.$n, $pnom)
		->setCellValue('E'.$n, $snom)
		->setCellValue('F'.$n, $pape)
		->setCellValue('G'.$n, $sape)		
		->setCellValue('H'.$n, $direc)
		->setCellValue('I'.$n, $tele1)
		->setCellValue('J'.$n, $contrato)	
		->setCellValue('K'.$n, $muni)
		->setCellValue('L'.$n, $depar)
		->setCellValue('M'.$n, $nommuni)
		->setCellValue('N'.$n, $estado)
		->setCellValue('O'.$n, $codicup)
		->setCellValue('P'.$n, $nomcup)
		->setCellValue('Q'.$n, $especialidad)
		->setCellValue('R'.$n, $fsolicitud)
		->setCellValue('S'.$n, $fecdeseada)
		->setCellValue('T'.$n, $fechaatencion)
		->setCellValue('U'.$n, $tipocita);
		$m++;	
	}
	
	//$objPHPExcel->getActiveSheet()->getCell('G:H')->setDataType(PHPExcel_Cell_DataType::TYPE_STRING);
	$objPHPExcel->getActiveSheet()->freezePane('A2');
	$objPHPExcel->getActiveSheet()->getStyle('A1:I1')->getFont()->setBold(true);
	$objPHPExcel->getActiveSheet()->getStyle('A'.$n.':U'.$n)->getFont()->setBold(true);
	$objPHPExcel->getActiveSheet()->setAutoFilter($objPHPExcel->getActiveSheet()->calculateWorksheetDimension());		
	$objPHPExcel->getActiveSheet()->setTitle('reporte_citas_1552');
	
	
	
	$callStartTime = microtime(true);
	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
	$objWriter->save(str_replace('.php', '.xlsx', __FILE__));
	$callEndTime = microtime(true);
	$callTime = $callEndTime - $callStartTime;
	header('Location: reporte_citas_1552_excel.xlsx?'.time());
	?>

