<?php

/**
 * PHPExcel
 *
 * Copyright (C) 2006 - 2014 PHPExcel
 *
 * This library is free software; you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation; either
 * version 2.1 of the License, or (at your option) any later version.
 *
 * This library is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
 * Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public
 * License along with this library; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301  USA
 *
 * @category   PHPExcel
 * @package    PHPExcel
 * @copyright  Copyright (c) 2006 - 2014 PHPExcel (http://www.codeplex.com/PHPExcel)
 * @license    http://www.gnu.org/licenses/old-licenses/lgpl-2.1.txt	LGPL
 * @version    1.8.0, 2014-03-02
 */

/** Error reporting */
   ini_set ('memory_limit', '-1');
	foreach($_POST as $nombre_campo => $valor)
	{ 
		$asignacion = "\$" . $nombre_campo . "='" . $valor . "';"; 
		eval($asignacion);
	}
	foreach($_GET as $nombre_campo => $valor)
	{ 
		$asignacion = "\$" . $nombre_campo . "='" . $valor . "';";
		eval($asignacion);
	}
	if(empty($sel1))$sel1=2;
	if(empty($sel2))$sel2=2;
	if(empty($sel3))$sel3=2;
	if(empty($sel4))$sel4=2;
	if(empty($sel5))$sel5=2;
	if(empty($sel6))$sel6=2;
	if(empty($sel7))$sel7=2;
	if(empty($sel8))$sel8=2;
	if(empty($sel9))$sel9=2;
	if(empty($sel10))$sel10=2;
	if(empty($sel11))$sel11=2;
	if(empty($sel12))$sel12=2;
	if(empty($sel13))$sel13=2;
	if(empty($sel14))$sel14=2;
	if(empty($sel15))$sel15=2;
	if(empty($sel16))$sel16=2;
	if(empty($sel17))$sel17=2;
	if(empty($sel18))$sel18=2;
	if(empty($sel19))$sel19=2;
	if(empty($sel20))$sel20=2;
	if(empty($sel21))$sel21=2;
	if(empty($sel22))$sel22=2;
	if(empty($sel23))$sel23=2;
	if(empty($sel24))$sel24=2;
	if(empty($sel25))$sel25=2;
	if(empty($sel26))$sel26=2;
	set_time_limit (360);
	/*
	$serverName = "winserver_SIIGO\SQLExpress"; //serverName\instanceName
	$connectionInfo = array( "Database"=>"SIIGOCONECT", "UID"=>"sa", "PWD"=>"VJvj321");
	$conn = sqlsrv_connect( $serverName, $connectionInfo);
	if(!$conn )echo  "No se pudo establecer la coneccion a sql_server";	
	*/
	$conexion = mysql_connect("192.168.4.20","root","");
    if(!$conexion)
    {
       echo "Error de conexion a la base de datos, Intente mas tarde.";
       exit();
    }	
	
	
	
	$anoinforme=substr($periodo,0,4);
	$mesinforme=substr($periodo,4,2);	
    mysql_select_db("formedica",$conexion);
	error_reporting(E_ALL);
	ini_set('display_errors', TRUE);
	ini_set('display_startup_errors', TRUE);
	date_default_timezone_set('America/Bogota');

	define('EOL',(PHP_SAPI == 'cli') ? PHP_EOL : '<br />');

	//date_default_timezone_set('Europe/London');

	/** Include PHPExcel */
	require_once dirname(__FILE__) . '/../Classes/PHPExcel.php';


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

	/*
	// Add some data
	$objPHPExcel->setActiveSheetIndex(0);
	$objPHPExcel->getActiveSheet()->setCellValue('A1', 'Firstname:')
	->setCellValue('A2', 'Lastname:')
	->setCellValue('A3', 'Fullname:')
	->setCellValue('B1', 'Maarten')
	->setCellValue('B2', 'Balliauw')
	->setCellValue('B3', '=B1 & " " & B2');
	*/				  
	
	$ind=0;
	if($sel1==1)
	{
		//medicos

		$busca=mysql_query("SELECT costos_final.nmedico, Sum(costos_final.citas) AS citas, Sum(costos_final.formagis) AS formagis, Sum(costos_final.cosmagis) AS cosmagis, Sum(costos_final.forotros) AS forotros, Sum(costos_final.cosotros) AS cosotros, Sum(formagis+forotros) AS totformulas, Sum(cosmagis+cosotros) AS totcosto
		FROM costos_final
		WHERE (((costos_final.ano)='$anoinforme') AND ((costos_final.mes)='$mesinforme'))
		GROUP BY costos_final.nmedico
		ORDER BY costos_final.nmedico");
		$tc=0;
		$tfm=0;
		$tcm=0;
		$tfo=0;
		$tco=0;
		$ttf=0;
		$ttc=0;
		
		$m=1;
		while($res=mysql_fetch_array($busca))
		{
			if($m==1)
			{		
				$objPHPExcel->setActiveSheetIndex($ind);
				$objPHPExcel->getActiveSheet()				
			    ->setCellValue('A'.$m, 'MEDICO')
			    ->setCellValue('B'.$m, 'CITAS')
			    ->setCellValue('C'.$m, 'FORMULAS MAGISTERIO')
			    ->setCellValue('D'.$m, 'COSTO MAGISTRRIO')
				->setCellValue('E'.$m, 'FORMULAS OTROS:')
			    ->setCellValue('F'.$m, 'COSTO OTROS')
			    ->setCellValue('G'.$m, 'TOTAL FORMULAS')
			    ->setCellValue('H'.$m, 'TOTAL COSTO');
			}
			$n=$m+1;
			
			$objPHPExcel->setActiveSheetIndex($ind);
			$objPHPExcel->getActiveSheet()
			->setCellValue('A'.$n, $res['nmedico'])
			->setCellValue('B'.$n, $res['citas'])
			->setCellValue('C'.$n, $res['formagis'])
			->setCellValue('D'.$n, $res['cosmagis'])
			->setCellValue('E'.$n, $res['forotros'])
			->setCellValue('F'.$n, $res['cosotros'])
			->setCellValue('G'.$n, $res['totformulas'])
			->setCellValue('H'.$n, $res['totcosto']);
			$tc=$res['citas']+$tc;
			$tfm=$res['formagis']+$tfm;
			$tcm=$res['cosmagis']+$tcm;
			$tfo=$res['forotros']+$tfo;
			$tco=$res['cosotros']+$tco;
			$ttf=$res['totformulas']+$ttf;
			$ttc=$res['totcosto']+$ttc;
			$m++;
		}
		$n=$m+1;
		$objPHPExcel->setActiveSheetIndex($ind);
		$objPHPExcel->getActiveSheet()		
		->setCellValue('A'.$n, 'TOTALES')
		->setCellValue('B'.$n, $tc)
		->setCellValue('C'.$n, $tfm)
		->setCellValue('D'.$n, $tcm)
		->setCellValue('E'.$n, $tfo)
		->setCellValue('F'.$n, $tco)
		->setCellValue('G'.$n, $ttf)
		->setCellValue('H'.$n, $ttc);
		
		$objPHPExcel->getActiveSheet()->freezePane('A2');
		$objPHPExcel->getActiveSheet()->getStyle('A1:H1')->getFont()->setBold(true);
		$objPHPExcel->getActiveSheet()->getStyle('A'.$n.':H'.$n)->getFont()->setBold(true);
		$objPHPExcel->getActiveSheet()->setAutoFilter($objPHPExcel->getActiveSheet()->calculateWorksheetDimension());		
		$objPHPExcel->getActiveSheet()->setTitle('MEDICOS');
		$ind=$ind+1;
	}	
	if($sel2==1)
	{	
		//ESPECIALIDAD
		// Create a new worksheet, after the default sheet
		if($ind!=0)$objPHPExcel->createSheet();
		// Add some data to the second sheet, resembling some different data types
			
		$busca=mysql_query("SELECT costos_final.nespe, Sum(costos_final.citas) AS SumaDecitas, Sum(costos_final.formagis) AS SumaDeformagis, Sum(costos_final.cosmagis) AS SumaDecosmagis, Sum(costos_final.forotros) AS SumaDeforotros, Sum(costos_final.cosotros) AS SumaDecosotros, Sum(formagis+forotros) AS totformulas, Sum(cosmagis+cosotros) AS totcosto
		FROM costos_final
		WHERE (((costos_final.ano)='$anoinforme') AND ((costos_final.mes)='$mesinforme'))
		GROUP BY costos_final.nespe
		ORDER BY costos_final.nespe");
		$tc=0;
		$tfm=0;
		$tcm=0;
		$tfo=0;
		$tco=0;
		$ttf=0;
		$ttc=0;
		$m=1;
		while($res=mysql_fetch_array($busca))
		{
			if($m==1)
			{				
				$objPHPExcel->setActiveSheetIndex($ind);
				$objPHPExcel->getActiveSheet()
				->setCellValue('A'.$m, 'ESPECIALIDAD')
			    ->setCellValue('B'.$m, 'CITAS')
			    ->setCellValue('C'.$m, 'FORMULAS MAGISTERIO')
			    ->setCellValue('D'.$m, 'COSTO MAGISTRRIO')
				->setCellValue('E'.$m, 'FORMULAS OTROS:')
			    ->setCellValue('F'.$m, 'COSTO OTROS')
			    ->setCellValue('G'.$m, 'TOTAL FORMULAS')
			    ->setCellValue('H'.$m, 'TOTAL COSTO');
				
				
			}
			$n=$m+1;			
			$objPHPExcel->setActiveSheetIndex($ind);
			$objPHPExcel->getActiveSheet()
			->setCellValue('A'.$n, $res['nespe'])
			->setCellValue('B'.$n, $res['SumaDecitas'])
			->setCellValue('C'.$n, $res['SumaDeformagis'])
			->setCellValue('D'.$n, $res['SumaDecosmagis'])
			->setCellValue('E'.$n, $res['SumaDeforotros'])
			->setCellValue('F'.$n, $res['SumaDecosotros'])
			->setCellValue('G'.$n, $res['totformulas'])
			->setCellValue('H'.$n, $res['totcosto']);
			$tc=$res['SumaDecitas']+$tc;
			$tfm=$res['SumaDeformagis']+$tfm;
			$tcm=$res['SumaDecosmagis']+$tcm;
			$tfo=$res['SumaDeforotros']+$tfo;
			$tco=$res['SumaDecosotros']+$tco;
			$ttf=$res['totformulas']+$ttf;
			$ttc=$res['totcosto']+$ttc;
			$m++;			
		}
		$n=$m+1;
		$objPHPExcel->setActiveSheetIndex($ind);
		$objPHPExcel->getActiveSheet()		
		->setCellValue('A'.$n, 'TOTALES')
		->setCellValue('B'.$n, $tc)
		->setCellValue('C'.$n, $tfm)
		->setCellValue('D'.$n, $tcm)
		->setCellValue('E'.$n, $tfo)
		->setCellValue('F'.$n, $tco)
		->setCellValue('G'.$n, $ttf)
		->setCellValue('H'.$n, $ttc);
			
		// Resolve range
		// Rename worksheet
		$objPHPExcel->getActiveSheet()->freezePane('A2');
		$objPHPExcel->getActiveSheet()->getStyle('A1:H1')->getFont()->setBold(true);
		$objPHPExcel->getActiveSheet()->getStyle('A'.$n.':H'.$n)->getFont()->setBold(true);
		$objPHPExcel->getActiveSheet()->setAutoFilter($objPHPExcel->getActiveSheet()->calculateWorksheetDimension());
		$objPHPExcel->getActiveSheet()->setTitle('ESPECIALIDADES');
		// Set active sheet index to the first sheet, so Excel opens this as the first sheet
		$ind=$ind+1;

	}	
	if($sel3==1)
	{
		//MEDICOS MEDICINA ESPECIALIZADA
		// Create a new worksheet, after the default sheet
		if($ind!=0)$objPHPExcel->createSheet();
		// Add some data to the second sheet, resembling some different data types			
		$busca=mysql_query("SELECT costos_final.nmedico, Sum(costos_final.citas) AS SumaDecitas, Sum(costos_final.formagis) AS SumaDeformagis, 
		Sum(costos_final.cosmagis) AS SumaDecosmagis, Sum(costos_final.forotros) AS SumaDeforotros, Sum(costos_final.cosotros) AS SumaDecosotros, 
		Sum(formagis+forotros) AS totformulas, Sum(cosmagis+cosotros) AS totcosto
		FROM costos_final
		WHERE (((costos_final.especi)<>'2655' And (costos_final.especi)<>'2656' And (costos_final.especi)<>'2661' And (costos_final.especi)<>'2619') AND ((costos_final.ano)='$anoinforme') AND ((costos_final.mes)='$mesinforme'))
		GROUP BY costos_final.nmedico
		ORDER BY costos_final.nmedico");	
		$tc=0;
		$tfm=0;
		$tcm=0;
		$tfo=0;
		$tco=0;
		$ttf=0;
		$ttc=0;
		$m=1;
		while($res=mysql_fetch_array($busca))
		{
			if($m==1)
			{				
				$objPHPExcel->setActiveSheetIndex($ind);
				$objPHPExcel->getActiveSheet()
				->setCellValue('A'.$m, 'MEDICO')
				->setCellValue('B'.$m, 'CITAS')
				->setCellValue('C'.$m, 'FORMULAS MAGISTERIO')
				->setCellValue('D'.$m, 'COSTO MAGISTRRIO')
				->setCellValue('E'.$m, 'FORMULAS OTROS:')
				->setCellValue('F'.$m, 'COSTO OTROS')
				->setCellValue('G'.$m, 'TOTAL FORMULAS')
				->setCellValue('H'.$m, 'TOTAL COSTO');
			}
			$n=$m+1;			
			$objPHPExcel->setActiveSheetIndex($ind);
			$objPHPExcel->getActiveSheet()
			->setCellValue('A'.$n, $res['nmedico'])
			->setCellValue('B'.$n, $res['SumaDecitas'])
			->setCellValue('C'.$n, $res['SumaDeformagis'])
			->setCellValue('D'.$n, $res['SumaDecosmagis'])
			->setCellValue('E'.$n, $res['SumaDeforotros'])
			->setCellValue('F'.$n, $res['SumaDecosotros'])
			->setCellValue('G'.$n, $res['totformulas'])
			->setCellValue('H'.$n, $res['totcosto']);
			$tc=$res['SumaDecitas']+$tc;
			$tfm=$res['SumaDeformagis']+$tfm;
			$tcm=$res['SumaDecosmagis']+$tcm;
			$tfo=$res['SumaDeforotros']+$tfo;
			$tco=$res['SumaDecosotros']+$tco;
			$ttf=$res['totformulas']+$ttf;
			$ttc=$res['totcosto']+$ttc;
			$m++;			
		}
		$n=$m+1;
		$objPHPExcel->setActiveSheetIndex($ind);
		$objPHPExcel->getActiveSheet()		
		->setCellValue('A'.$n, 'TOTALES')
		->setCellValue('B'.$n, $tc)
		->setCellValue('C'.$n, $tfm)
		->setCellValue('D'.$n, $tcm)
		->setCellValue('E'.$n, $tfo)
		->setCellValue('F'.$n, $tco)
		->setCellValue('G'.$n, $ttf)
		->setCellValue('H'.$n, $ttc);
		// Resolve range
		// Rename worksheet
		$objPHPExcel->getActiveSheet()->freezePane('A2');
		$objPHPExcel->getActiveSheet()->getStyle('A1:H1')->getFont()->setBold(true);
		$objPHPExcel->getActiveSheet()->getStyle('A'.$n.':H'.$n)->getFont()->setBold(true);
		$objPHPExcel->getActiveSheet()->setAutoFilter($objPHPExcel->getActiveSheet()->calculateWorksheetDimension());
		$objPHPExcel->getActiveSheet()->setTitle('MEDICOS ME');
		// Set active sheet index to the first sheet, so Excel opens this as the first sheet
		$ind=$ind+1;
	}
	if($sel4==1)
	{
		//MEDICOS MEDICINA GENERAL
		if($ind!=0)$objPHPExcel->createSheet();
		$busca=mysql_query("SELECT costos_final.nmedico, Sum(costos_final.citas) AS SumaDecitas, Sum(costos_final.formagis) AS SumaDeformagis, 
		Sum(costos_final.cosmagis) AS SumaDecosmagis, Sum(costos_final.forotros) AS SumaDeforotros, Sum(costos_final.cosotros) AS SumaDecosotros, 
		Sum(formagis+forotros) AS totformulas, Sum(cosmagis+cosotros) AS totcosto
		FROM costos_final
		WHERE ((((costos_final.especi)='2655' Or (costos_final.especi)='2656' Or (costos_final.especi)='2661' Or (costos_final.especi)='2619')) AND ((costos_final.ano)='$anoinforme') AND ((costos_final.mes)='$mesinforme'))
		GROUP BY costos_final.nmedico
		ORDER BY costos_final.nmedico");
		$tc=0;
		$tfm=0;
		$tcm=0;
		$tfo=0;
		$tco=0;
		$ttf=0;
		$ttc=0;
		$m=1;
		while($res=mysql_fetch_array($busca))
		{
			if($m==1)
			{				
				$objPHPExcel->setActiveSheetIndex($ind);
				$objPHPExcel->getActiveSheet()
				->setCellValue('A'.$m, 'MEDICO')
				->setCellValue('B'.$m, 'CITAS')
				->setCellValue('C'.$m, 'FORMULAS MAGISTERIO')
				->setCellValue('D'.$m, 'COSTO MAGISTRRIO')
				->setCellValue('E'.$m, 'FORMULAS OTROS:')
				->setCellValue('F'.$m, 'COSTO OTROS')
				->setCellValue('G'.$m, 'TOTAL FORMULAS')
				->setCellValue('H'.$m, 'TOTAL COSTO');
			}
			$n=$m+1;			
			$objPHPExcel->setActiveSheetIndex($ind);
			$objPHPExcel->getActiveSheet()
			->setCellValue('A'.$n, $res['nmedico'])
			->setCellValue('B'.$n, $res['SumaDecitas'])
			->setCellValue('C'.$n, $res['SumaDeformagis'])
			->setCellValue('D'.$n, $res['SumaDecosmagis'])
			->setCellValue('E'.$n, $res['SumaDeforotros'])
			->setCellValue('F'.$n, $res['SumaDecosotros'])
			->setCellValue('G'.$n, $res['totformulas'])
			->setCellValue('H'.$n, $res['totcosto']);
			$tc=$res['SumaDecitas']+$tc;
			$tfm=$res['SumaDeformagis']+$tfm;
			$tcm=$res['SumaDecosmagis']+$tcm;
			$tfo=$res['SumaDeforotros']+$tfo;
			$tco=$res['SumaDecosotros']+$tco;
			$ttf=$res['totformulas']+$ttf;
			$ttc=$res['totcosto']+$ttc;
			$m++;			
		}
		$n=$m+1;
		$objPHPExcel->setActiveSheetIndex($ind);
		$objPHPExcel->getActiveSheet()		
		->setCellValue('A'.$n, 'TOTALES')
		->setCellValue('B'.$n, $tc)
		->setCellValue('C'.$n, $tfm)
		->setCellValue('D'.$n, $tcm)
		->setCellValue('E'.$n, $tfo)
		->setCellValue('F'.$n, $tco)
		->setCellValue('G'.$n, $ttf)
		->setCellValue('H'.$n, $ttc);
		$objPHPExcel->getActiveSheet()->freezePane('A2');
		$objPHPExcel->getActiveSheet()->getStyle('A1:H1')->getFont()->setBold(true);
		$objPHPExcel->getActiveSheet()->getStyle('A'.$n.':H'.$n)->getFont()->setBold(true);
		$objPHPExcel->getActiveSheet()->setAutoFilter($objPHPExcel->getActiveSheet()->calculateWorksheetDimension());
		$objPHPExcel->getActiveSheet()->setTitle('MEDICOS MG');
		$ind=$ind+1;
	}
	
	
	if($sel5==1)
	{
		//CONTRATOS
		if($ind!=0)$objPHPExcel->createSheet();
		$busca=mysql_query("SELECT costos_enca.nomccos, Count(costos_enca.formu) AS CuentaDeformu, Sum(costos_enca.registros) AS SumaDeregistros, 
		Sum(costos_enca.tcos) AS SumaDetcos
		FROM costos_enca WHERE ((costos_enca.ano)='$anoinforme') AND ((costos_enca.mes)='$mesinforme')
		GROUP BY costos_enca.nomccos");
		
		$tf=0;
		$tr=0;
		$tt=0;		
		$m=1;
		while($res=mysql_fetch_array($busca))
		{
			if($m==1)
			{				
				$objPHPExcel->setActiveSheetIndex($ind);
				$objPHPExcel->getActiveSheet()
				->setCellValue('A'.$m, 'CONTRATO')
				->setCellValue('B'.$m, 'FORMULAS')
				->setCellValue('C'.$m, 'REGISTROS')
				->setCellValue('D'.$m, 'TOTAL COSTO');
			}
			$n=$m+1;			
			$objPHPExcel->setActiveSheetIndex($ind);
			$objPHPExcel->getActiveSheet()
			->setCellValue('A'.$n, $res['nomccos'])
			->setCellValue('B'.$n, $res['CuentaDeformu'])
			->setCellValue('C'.$n, $res['SumaDeregistros'])
			->setCellValue('D'.$n, $res['SumaDetcos']);
			$tf=$res['CuentaDeformu']+$tf;
			$tr=$res['SumaDeregistros']+$tr;
			$tt=$res['SumaDetcos']+$tt;
			$m++;			
			
		}
		$n=$m+1;
		$objPHPExcel->setActiveSheetIndex($ind);
		$objPHPExcel->getActiveSheet()		
		->setCellValue('A'.$n, 'TOTALES')
		->setCellValue('B'.$n, $tf)
		->setCellValue('C'.$n, $tr)
		->setCellValue('D'.$n, $tt);
		$objPHPExcel->getActiveSheet()->freezePane('A2');
		$objPHPExcel->getActiveSheet()->getStyle('A1:D1')->getFont()->setBold(true);
		$objPHPExcel->getActiveSheet()->getStyle('A'.$n.':D'.$n)->getFont()->setBold(true);
		$objPHPExcel->getActiveSheet()->setAutoFilter($objPHPExcel->getActiveSheet()->calculateWorksheetDimension());		
		$objPHPExcel->getActiveSheet()->setTitle('CONTRATOS');
		$ind=$ind+1;
	}
	
	if($sel6==1)
	{
		//AREAS
		if($ind!=0)$objPHPExcel->createSheet();
		$busca=mysql_query("SELECT costos_final.nomscco, Sum(costos_final.citas) AS SumaDecitas, Sum(costos_final.formagis) AS SumaDeformagis, Sum(costos_final.cosmagis) AS SumaDecosmagis, 
		Sum(costos_final.forotros) AS SumaDeforotros, Sum(costos_final.cosotros) AS SumaDecosotros, Sum(formagis+forotros) AS totformula, 
		Sum(cosmagis+cosotros) AS totcosto
		FROM costos_final WHERE ((costos_final.ano)='$anoinforme') AND ((costos_final.mes)='$mesinforme')
		GROUP BY costos_final.nomscco
		ORDER BY costos_final.nomscco");
		$tc=0;
		$tfm=0;
		$tcm=0;
		$tfo=0;
		$tco=0;
		$ttf=0;
		$ttc=0;
		$m=1;
		while($res=mysql_fetch_array($busca))
		{
			if($m==1)
			{				
				$objPHPExcel->setActiveSheetIndex($ind);
				$objPHPExcel->getActiveSheet()
				->setCellValue('A'.$m, 'AREA')
				->setCellValue('B'.$m, 'CITAS')
				->setCellValue('C'.$m, 'FORMULAS MAGISTERIO')
				->setCellValue('D'.$m, 'COSTO MAGISTRRIO')
				->setCellValue('E'.$m, 'FORMULAS OTROS:')
				->setCellValue('F'.$m, 'COSTO OTROS')
				->setCellValue('G'.$m, 'TOTAL FORMULAS')
				->setCellValue('H'.$m, 'TOTAL COSTO');
			}
			$n=$m+1;			
			$objPHPExcel->setActiveSheetIndex($ind);
			$objPHPExcel->getActiveSheet()
			->setCellValue('A'.$n, $res['nomscco'])
			->setCellValue('B'.$n, $res['SumaDecitas'])
			->setCellValue('C'.$n, $res['SumaDeformagis'])
			->setCellValue('D'.$n, $res['SumaDecosmagis'])
			->setCellValue('E'.$n, $res['SumaDeforotros'])
			->setCellValue('F'.$n, $res['SumaDecosotros'])
			->setCellValue('G'.$n, $res['totformula'])
			->setCellValue('H'.$n, $res['totcosto']);
			$tc=$res['SumaDecitas']+$tc;
			$tfm=$res['SumaDeformagis']+$tfm;
			$tcm=$res['SumaDecosmagis']+$tcm;
			$tfo=$res['SumaDeforotros']+$tfo;
			$tco=$res['SumaDecosotros']+$tco;
			$ttf=$res['totformula']+$ttf;
			$ttc=$res['totcosto']+$ttc;
			$m++;			
		}
		$n=$m+1;
		$objPHPExcel->setActiveSheetIndex($ind);
		$objPHPExcel->getActiveSheet()		
		->setCellValue('A'.$n, 'TOTALES')
		->setCellValue('B'.$n, $tc)
		->setCellValue('C'.$n, $tfm)
		->setCellValue('D'.$n, $tcm)
		->setCellValue('E'.$n, $tfo)
		->setCellValue('F'.$n, $tco)
		->setCellValue('G'.$n, $ttf)
		->setCellValue('H'.$n, $ttc);
		$objPHPExcel->getActiveSheet()->freezePane('A2');
		$objPHPExcel->getActiveSheet()->getStyle('A1:H1')->getFont()->setBold(true);
		$objPHPExcel->getActiveSheet()->getStyle('A'.$n.':H'.$n)->getFont()->setBold(true);
		$objPHPExcel->getActiveSheet()->setAutoFilter($objPHPExcel->getActiveSheet()->calculateWorksheetDimension());		
		$objPHPExcel->getActiveSheet()->setTitle('AREAS MG');
		$ind=$ind+1;
	}
	
	if($sel7==1)
	{
		//BODEGAS
		if($ind!=0)$objPHPExcel->createSheet();
		$busca=mysql_query("SELECT costos_enca.nombod, Count(costos_enca.formu) AS CuentaDeformu, Sum(costos_enca.registros) AS SumaDeregistros, 
		Sum(costos_enca.tcos) AS SumaDetcos
		FROM costos_enca WHERE ((costos_enca.ano)='$anoinforme') AND ((costos_enca.mes)='$mesinforme')
		GROUP BY costos_enca.nombod");
		$tf=0;
		$tr=0;
		$tt=0;	
		$m=1;
		while($res=mysql_fetch_array($busca))
		{
			if($m==1)
			{				
				$objPHPExcel->setActiveSheetIndex($ind);
				$objPHPExcel->getActiveSheet()
				->setCellValue('A'.$m, 'NOMBRE BODEGA')
				->setCellValue('B'.$m, 'FORMULAS')
				->setCellValue('C'.$m, 'REGISTROS')
				->setCellValue('D'.$m, 'TOTAL COSTO');
			}
			$n=$m+1;			
			$objPHPExcel->setActiveSheetIndex($ind);
			$objPHPExcel->getActiveSheet()
			->setCellValue('A'.$n, $res['nombod'])
			->setCellValue('B'.$n, $res['CuentaDeformu'])
			->setCellValue('C'.$n, $res['SumaDeregistros'])
			->setCellValue('D'.$n, $res['SumaDetcos']);
			$tf=$res['CuentaDeformu']+$tf;
			$tr=$res['SumaDeregistros']+$tr;
			$tt=$res['SumaDetcos']+$tt;
			$m++;			
			
		}
		$n=$m+1;
		$objPHPExcel->setActiveSheetIndex($ind);
		$objPHPExcel->getActiveSheet()		
		->setCellValue('A'.$n, 'TOTALES')
		->setCellValue('B'.$n, $tf)
		->setCellValue('C'.$n, $tr)
		->setCellValue('D'.$n, $tt);
		$objPHPExcel->getActiveSheet()->freezePane('A2');
		$objPHPExcel->getActiveSheet()->getStyle('A1:D1')->getFont()->setBold(true);
		$objPHPExcel->getActiveSheet()->getStyle('A'.$n.':D'.$n)->getFont()->setBold(true);
		$objPHPExcel->getActiveSheet()->setAutoFilter($objPHPExcel->getActiveSheet()->calculateWorksheetDimension());
		$objPHPExcel->getActiveSheet()->setTitle('BODEGAS');
		$ind=$ind+1;
	}
	if($sel8==1)
	{
		//ALTO COSTO POR MEDICO
		if($ind!=0)$objPHPExcel->createSheet();
		$busca=mysql_query("SELECT costos_deta.nmedico, Count(costos_deta.formu) AS CuentaDeformu, Count(costos_deta.regis) AS CuentaDeregis, Sum(costos_deta.tcos) AS SumaDetcos
		FROM costos_deta
		WHERE (((costos_deta.altocosto)='S') AND ((costos_deta.ano)='$anoinforme') AND ((costos_deta.mes)='$mesinforme'))
		GROUP BY costos_deta.nmedico
		ORDER BY costos_deta.nmedico");
		$tf=0;
		$tr=0;
		$tt=0;	
		$m=1;
		while($res=mysql_fetch_array($busca))
		{
			if($m==1)
			{				
				$objPHPExcel->setActiveSheetIndex($ind);
				$objPHPExcel->getActiveSheet()
				->setCellValue('A'.$m, 'MEDICO')
				->setCellValue('B'.$m, 'FORMULAS')
				->setCellValue('C'.$m, 'REGISTROS')
				->setCellValue('D'.$m, 'TOTAL COSTO');
			}
			$n=$m+1;			
			$objPHPExcel->setActiveSheetIndex($ind);
			$objPHPExcel->getActiveSheet()
			->setCellValue('A'.$n, $res['nmedico'])
			->setCellValue('B'.$n, $res['CuentaDeformu'])
			->setCellValue('C'.$n, $res['CuentaDeregis'])
			->setCellValue('D'.$n, $res['SumaDetcos']);
			$tf=$res['CuentaDeformu']+$tf;
			$tr=$res['CuentaDeregis']+$tr;
			$tt=$res['SumaDetcos']+$tt;
			$m++;			
			
		}
		$n=$m+1;
		$objPHPExcel->setActiveSheetIndex($ind);
		$objPHPExcel->getActiveSheet()		
		->setCellValue('A'.$n, 'TOTALES')
		->setCellValue('B'.$n, $tf)
		->setCellValue('C'.$n, $tr)
		->setCellValue('D'.$n, $tt);
		$objPHPExcel->getActiveSheet()->freezePane('A2');
		$objPHPExcel->getActiveSheet()->getStyle('A1:D1')->getFont()->setBold(true);
		$objPHPExcel->getActiveSheet()->getStyle('A'.$n.':D'.$n)->getFont()->setBold(true);
		$objPHPExcel->getActiveSheet()->setAutoFilter($objPHPExcel->getActiveSheet()->calculateWorksheetDimension());
		$objPHPExcel->getActiveSheet()->setTitle('ALTO COSTO');
		$ind=$ind+1;
	}
	
	if($sel9==1)
	{
		//ALTO COSTO POR CONTRATO
		if($ind!=0)$objPHPExcel->createSheet();
		$busca=mysql_query("SELECT costos_deta.nomccos, Count(costos_deta.formu) AS CuentaDeformu, Count(costos_deta.regis) AS CuentaDeregis, Sum(costos_deta.tcos) AS SumaDetcos
		FROM costos_deta
		WHERE (((costos_deta.altocosto)='S') AND ((costos_deta.ano)='$anoinforme') AND ((costos_deta.mes)='$mesinforme'))
		GROUP BY costos_deta.nomccos ORDER BY costos_deta.nomccos");
		$m=1;
		$tf=0;
		$tr=0;
		$tt=0;	
		while($res=mysql_fetch_array($busca))
		{
			if($m==1)
			{				
				$objPHPExcel->setActiveSheetIndex($ind);
				$objPHPExcel->getActiveSheet()
				->setCellValue('A'.$m, 'CONTRATO')
				->setCellValue('B'.$m, 'FORMULAS')
				->setCellValue('C'.$m, 'REGISTROS')
				->setCellValue('D'.$m, 'TOTAL COSTO');
			}
			$n=$m+1;			
			$objPHPExcel->setActiveSheetIndex($ind);
			$objPHPExcel->getActiveSheet()
			->setCellValue('A'.$n, $res['nomccos'])
			->setCellValue('B'.$n, $res['CuentaDeformu'])
			->setCellValue('C'.$n, $res['CuentaDeregis'])
			->setCellValue('D'.$n, $res['SumaDetcos']);
			$tf=$res['CuentaDeformu']+$tf;
			$tr=$res['CuentaDeregis']+$tr;
			$tt=$res['SumaDetcos']+$tt;
			$m++;			
			
		}
		$n=$m+1;
		$objPHPExcel->setActiveSheetIndex($ind);
		$objPHPExcel->getActiveSheet()		
		->setCellValue('A'.$n, 'TOTALES')
		->setCellValue('B'.$n, $tf)
		->setCellValue('C'.$n, $tr)
		->setCellValue('D'.$n, $tt);
		$objPHPExcel->getActiveSheet()->freezePane('A2');
		$objPHPExcel->getActiveSheet()->getStyle('A1:D1')->getFont()->setBold(true);
		$objPHPExcel->getActiveSheet()->getStyle('A'.$n.':D'.$n)->getFont()->setBold(true);
		$objPHPExcel->getActiveSheet()->setAutoFilter($objPHPExcel->getActiveSheet()->calculateWorksheetDimension());		
		$objPHPExcel->getActiveSheet()->setTitle('ALTO COSTO CONTRATO');
		$ind=$ind+1;
	}
	
	if($sel10==1)
	{
		//ALTO COSTO POR AREA
		if($ind!=0)$objPHPExcel->createSheet();
		$busca=mysql_query("SELECT costos_deta.nomscco, Count(costos_deta.formu) AS CuentaDeformu, Count(costos_deta.regis) AS CuentaDeregis, Sum(costos_deta.tcos) AS SumaDetcos
		FROM costos_deta
		WHERE (((costos_deta.altocosto)='S') AND  ((costos_deta.ano)='$anoinforme') AND ((costos_deta.mes)='$mesinforme'))
		GROUP BY costos_deta.nomscco ORDER BY costos_deta.nomscco");
		$m=1;
		$tf=0;
		$tr=0;
		$tt=0;	
		while($res=mysql_fetch_array($busca))
		{
			if($m==1)
			{				
				$objPHPExcel->setActiveSheetIndex($ind);
				$objPHPExcel->getActiveSheet()
				->setCellValue('A'.$m, 'AREA')
				->setCellValue('B'.$m, 'FORMULAS')
				->setCellValue('C'.$m, 'REGISTROS')
				->setCellValue('D'.$m, 'TOTAL COSTO');
			}
			$n=$m+1;			
			$objPHPExcel->setActiveSheetIndex($ind);
			$objPHPExcel->getActiveSheet()
			->setCellValue('A'.$n, $res['nomscco'])
			->setCellValue('B'.$n, $res['CuentaDeformu'])
			->setCellValue('C'.$n, $res['CuentaDeregis'])
			->setCellValue('D'.$n, $res['SumaDetcos']);
			$tf=$res['CuentaDeformu']+$tf;
			$tr=$res['CuentaDeregis']+$tr;
			$tt=$res['SumaDetcos']+$tt;
			$m++;			
			
		}
		$n=$m+1;
		$objPHPExcel->setActiveSheetIndex($ind);
		$objPHPExcel->getActiveSheet()		
		->setCellValue('A'.$n, 'TOTALES')
		->setCellValue('B'.$n, $tf)
		->setCellValue('C'.$n, $tr)
		->setCellValue('D'.$n, $tt);
		$objPHPExcel->getActiveSheet()->freezePane('A2');
		$objPHPExcel->getActiveSheet()->getStyle('A1:D1')->getFont()->setBold(true);
		$objPHPExcel->getActiveSheet()->getStyle('A'.$n.':D'.$n)->getFont()->setBold(true);
		$objPHPExcel->getActiveSheet()->setAutoFilter($objPHPExcel->getActiveSheet()->calculateWorksheetDimension());
		$objPHPExcel->getActiveSheet()->setTitle('ALTO COSTO AREA');
		$ind=$ind+1;
	}
	
	if($sel11==1)
	{
		//PRODUCTOS ALTO COSTO
		if($ind!=0)$objPHPExcel->createSheet();
		$busca=mysql_query("SELECT costos_deta.nombrepro, Count(costos_deta.formu) AS CuentaDeformu, Count(costos_deta.regis) AS CuentaDeregis, Sum(costos_deta.tcos) AS SumaDetcos
		FROM costos_deta WHERE (((costos_deta.altocosto)='S') AND ((costos_deta.ano)='$anoinforme') AND ((costos_deta.mes)='$mesinforme'))
		GROUP BY costos_deta.nombrepro
		ORDER BY costos_deta.nombrepro");
		$m=1;
		$tf=0;
		$tr=0;
		$tt=0;	
		while($res=mysql_fetch_array($busca))
		{
			if($m==1)
			{				
				$objPHPExcel->setActiveSheetIndex($ind);
				$objPHPExcel->getActiveSheet()
				->setCellValue('A'.$m, 'PRODUCTO')
				->setCellValue('B'.$m, 'FORMULAS')
				->setCellValue('C'.$m, 'REGISTROS')
				->setCellValue('D'.$m, 'TOTAL COSTO');
			}
			$n=$m+1;			
			$objPHPExcel->setActiveSheetIndex($ind);
			$objPHPExcel->getActiveSheet()
			->setCellValue('A'.$n, $res['nombrepro'])
			->setCellValue('B'.$n, $res['CuentaDeformu'])
			->setCellValue('C'.$n, $res['CuentaDeregis'])
			->setCellValue('D'.$n, $res['SumaDetcos']);
			$tf=$res['CuentaDeformu']+$tf;
			$tr=$res['CuentaDeregis']+$tr;
			$tt=$res['SumaDetcos']+$tt;
			$m++;			
			
		}
		$n=$m+1;
		$objPHPExcel->setActiveSheetIndex($ind);
		$objPHPExcel->getActiveSheet()		
		->setCellValue('A'.$n, 'TOTALES')
		->setCellValue('B'.$n, $tf)
		->setCellValue('C'.$n, $tr)
		->setCellValue('D'.$n, $tt);
		$objPHPExcel->getActiveSheet()->freezePane('A2');
		$objPHPExcel->getActiveSheet()->getStyle('A1:D1')->getFont()->setBold(true);
		$objPHPExcel->getActiveSheet()->getStyle('A'.$n.':D'.$n)->getFont()->setBold(true);
		$objPHPExcel->getActiveSheet()->setAutoFilter($objPHPExcel->getActiveSheet()->calculateWorksheetDimension());
		$objPHPExcel->getActiveSheet()->setTitle('ALTO COSTO PRODUCTOS');
		$ind=$ind+1;
	}
	
	if($sel12==1)
	{
		//MEDICOS POR AREA
		$tc=0;
		$tfm=0;
		$tcm=0;
		$tfo=0;
		$tco=0;
		$ttf=0;
		$ttc=0;
		if($ind!=0)$objPHPExcel->createSheet();
		$busca=mysql_query("SELECT costos_final.nomscco, costos_final.nmedico, Sum(costos_final.citas) AS SumaDecitas, Sum(costos_final.formagis) AS SumaDeformagis, 
		Sum(costos_final.cosmagis) AS SumaDecosmagis, Sum(costos_final.forotros) AS SumaDeforotros, 
		Sum(costos_final.cosotros) AS SumaDecosotros, Sum(formagis+forotros) AS totformula, 
		Sum(cosmagis+cosotros) AS totcosto
		FROM costos_final WHERE ((costos_final.ano)='$anoinforme') AND ((costos_final.mes)='$mesinforme')
		GROUP BY costos_final.nomscco, costos_final.nmedico
		ORDER BY costos_final.nomscco");
		$m=1;
		while($res=mysql_fetch_array($busca))
		{
			if($m==1)
			{				
				$objPHPExcel->setActiveSheetIndex($ind);
				$objPHPExcel->getActiveSheet()
				->setCellValue('A'.$m, 'AREA')
				->setCellValue('B'.$m, 'MEDICO')
				->setCellValue('C'.$m, 'CITAS')
				->setCellValue('D'.$m, 'FORMULAS MAGISTERIO')
				->setCellValue('E'.$m, 'COSTO MAGISTRRIO')
				->setCellValue('F'.$m, 'FORMULAS OTROS:')
				->setCellValue('G'.$m, 'COSTO OTROS')
				->setCellValue('H'.$m, 'TOTAL FORMULAS')
				->setCellValue('I'.$m, 'TOTAL COSTO');
			}
			$n=$m+1;			
			$objPHPExcel->setActiveSheetIndex($ind);
			$objPHPExcel->getActiveSheet()
			->setCellValue('A'.$n, $res['nomscco'])
			->setCellValue('C'.$n, $res['nmedico'])
			->setCellValue('C'.$n, $res['SumaDecitas'])
			->setCellValue('D'.$n, $res['SumaDeformagis'])
			->setCellValue('E'.$n, $res['SumaDecosmagis'])
			->setCellValue('F'.$n, $res['SumaDeforotros'])
			->setCellValue('G'.$n, $res['SumaDecosotros'])
			->setCellValue('H'.$n, $res['totformula'])
			->setCellValue('I'.$n, $res['totcosto']);
			$tc=$res['SumaDecitas']+$tc;
			$tfm=$res['SumaDeformagis']+$tfm;
			$tcm=$res['SumaDecosmagis']+$tcm;
			$tfo=$res['SumaDeforotros']+$tfo;
			$tco=$res['SumaDecosotros']+$tco;
			$ttf=$res['totformula']+$ttf;
			$ttc=$res['totcosto']+$ttc;
			$m++;			
		}
		$n=$m+1;
		$objPHPExcel->setActiveSheetIndex($ind);
		$objPHPExcel->getActiveSheet()		
		->setCellValue('A'.$n, 'TOTALES')		
		->setCellValue('B'.$n, '')
		->setCellValue('C'.$n, $tc)
		->setCellValue('D'.$n, $tfm)
		->setCellValue('E'.$n, $tcm)
		->setCellValue('F'.$n, $tfo)
		->setCellValue('G'.$n, $tco)
		->setCellValue('H'.$n, $ttf)
		->setCellValue('I'.$n, $ttc);
		$objPHPExcel->getActiveSheet()->freezePane('A2');
		$objPHPExcel->getActiveSheet()->getStyle('A1:I1')->getFont()->setBold(true);
		$objPHPExcel->getActiveSheet()->getStyle('A'.$n.':I'.$n)->getFont()->setBold(true);
		$objPHPExcel->getActiveSheet()->setAutoFilter($objPHPExcel->getActiveSheet()->calculateWorksheetDimension());
		$objPHPExcel->getActiveSheet()->setTitle('MEDICOS POR AREA');
		$ind=$ind+1;
	}
	
	if($sel13==1)
	{
		//CONTRATOS POR AREA
		if($ind!=0)$objPHPExcel->createSheet();
		$busca=mysql_query("SELECT costos_enca.nomscco, costos_enca.nomccos, Count(costos_enca.formu) AS CuentaDeformu, Sum(costos_enca.registros) AS SumaDeregistros, Sum(costos_enca.tcos) AS SumaDetcos
		FROM costos_enca WHERE ((costos_enca.ano)='$anoinforme') AND ((costos_enca.mes)='$mesinforme')
		GROUP BY costos_enca.nomscco, costos_enca.nomccos
		ORDER BY costos_enca.nomscco");
		$m=1;
		while($res=mysql_fetch_array($busca))
		{
			if($m==1)
			{				
				$objPHPExcel->setActiveSheetIndex($ind);
				$objPHPExcel->getActiveSheet()
				->setCellValue('A'.$m, 'AREA')
				->setCellValue('B'.$m, 'CONTRATO')
				->setCellValue('C'.$m, 'FORMULAS')
				->setCellValue('D'.$m, 'REGISTROS')
				->setCellValue('E'.$m, 'TOTAL COSTO');
			}
			$n=$m+1;			
			$objPHPExcel->setActiveSheetIndex($ind);
			$objPHPExcel->getActiveSheet()
			->setCellValue('A'.$n, $res['nomscco'])
			->setCellValue('B'.$n, $res['nomccos'])
			->setCellValue('C'.$n, $res['CuentaDeformu'])
			->setCellValue('D'.$n, $res['SumaDeregistros'])
			->setCellValue('E'.$n, $res['SumaDetcos']);
			$m++;			
			
		}
		$objPHPExcel->getActiveSheet()->freezePane('A2');
		$objPHPExcel->getActiveSheet()->getStyle('A1:D1')->getFont()->setBold(true);
		$objPHPExcel->getActiveSheet()->getStyle('A'.$n.':D'.$n)->getFont()->setBold(true);
		$objPHPExcel->getActiveSheet()->setAutoFilter($objPHPExcel->getActiveSheet()->calculateWorksheetDimension());
		$objPHPExcel->getActiveSheet()->setTitle('CONTRATOS POR AREA');
		$ind=$ind+1;
	}
	
	
	if($sel14==1)
	{
		//MUNICIPIOS
		if($ind!=0)$objPHPExcel->createSheet();
		$busca=mysql_query("SELECT costos_enca.nombod, costos_enca.nmedico, Count(costos_enca.formu) AS CuentaDeformu, Sum(costos_enca.registros) AS SumaDeregistros, Sum(costos_enca.tcos) AS SumaDetcos
		FROM costos_enca WHERE (((costos_enca.cbod)<>2 And (costos_enca.cbod)<>5 And (costos_enca.cbod)<>12 And (costos_enca.cbod)<>203) AND ((costos_enca.ano)='$anoinforme') AND ((costos_enca.mes)='$mesinforme'))
		GROUP BY costos_enca.nombod, costos_enca.nmedico
		ORDER BY costos_enca.nombod, costos_enca.nmedico");
		$m=1;
		while($res=mysql_fetch_array($busca))
		{
			if($m==1)
			{				
				$objPHPExcel->setActiveSheetIndex($ind);
				$objPHPExcel->getActiveSheet()
				->setCellValue('A'.$m, 'BODEGA')
				->setCellValue('B'.$m, 'MEDICO')
				->setCellValue('C'.$m, 'FORMULAS')
				->setCellValue('D'.$m, 'REGISTROS')
				->setCellValue('E'.$m, 'TOTAL COSTO');
			}
			$n=$m+1;			
			$objPHPExcel->setActiveSheetIndex($ind);
			$objPHPExcel->getActiveSheet()
			->setCellValue('A'.$n, $res['nombod'])
			->setCellValue('B'.$n, $res['nmedico'])
			->setCellValue('C'.$n, $res['CuentaDeformu'])
			->setCellValue('D'.$n, $res['SumaDeregistros'])
			->setCellValue('E'.$n, $res['SumaDetcos']);
			$m++;			
			
		}
		$objPHPExcel->getActiveSheet()->freezePane('A2');
		$objPHPExcel->getActiveSheet()->getStyle('A1:D1')->getFont()->setBold(true);
		$objPHPExcel->getActiveSheet()->getStyle('A'.$n.':D'.$n)->getFont()->setBold(true);
		$objPHPExcel->getActiveSheet()->setAutoFilter($objPHPExcel->getActiveSheet()->calculateWorksheetDimension());
		$objPHPExcel->getActiveSheet()->setTitle('MUNICIPIOS');
		$ind=$ind+1;
	}
	
	if($sel15==1)
	{
		//COSTO X PRODUCTO
		if($ind!=0)$objPHPExcel->createSheet();
		$busca=mysql_query("SELECT costos_deta.nombrepro, Count(costos_deta.regis) AS CuentaDeregis, Sum(costos_deta.canti) AS SumaDecanti, Sum(costos_deta.tcos) AS SumaDetcos
		FROM costos_deta WHERE ((costos_deta.ano)='$anoinforme') AND ((costos_deta.mes)='$mesinforme')
		GROUP BY costos_deta.nombrepro
		ORDER BY Sum(costos_deta.tcos) DESC");
		$m=1;
		$tf=0;
		$tr=0;
		$tt=0;
		
		while($res=mysql_fetch_array($busca))
		{
			if($m==1)
			{				
				$objPHPExcel->setActiveSheetIndex($ind);
				$objPHPExcel->getActiveSheet()
				->setCellValue('A'.$m, 'PRODUCTO')
				->setCellValue('B'.$m, 'REGISTROS')
				->setCellValue('C'.$m, 'CANTIDAD')
				->setCellValue('D'.$m, 'TOTAL COSTO');
			}
			$n=$m+1;			
			$objPHPExcel->setActiveSheetIndex($ind);
			$objPHPExcel->getActiveSheet()
			->setCellValue('A'.$n, $res['nombrepro'])
			->setCellValue('B'.$n, $res['CuentaDeregis'])
			->setCellValue('C'.$n, $res['SumaDecanti'])
			->setCellValue('D'.$n, $res['SumaDetcos']);
			$tf=$res['CuentaDeregis']+$tf;
			$tr=$res['SumaDecanti']+$tr;
			$tt=$res['SumaDetcos']+$tt;
			$m++;			
			
		}
		$n=$m+1;
		$objPHPExcel->setActiveSheetIndex($ind);
		$objPHPExcel->getActiveSheet()		
		->setCellValue('A'.$n, 'TOTALES')
		->setCellValue('B'.$n, $tf)
		->setCellValue('C'.$n, $tr)
		->setCellValue('D'.$n, $tt);
		$objPHPExcel->getActiveSheet()->freezePane('A2');
		$objPHPExcel->getActiveSheet()->getStyle('A1:D1')->getFont()->setBold(true);
		$objPHPExcel->getActiveSheet()->getStyle('A'.$n.':D'.$n)->getFont()->setBold(true);
		$objPHPExcel->getActiveSheet()->setAutoFilter($objPHPExcel->getActiveSheet()->calculateWorksheetDimension());
		$objPHPExcel->getActiveSheet()->setTitle('COSTO POR PRODUCTO');
		$ind=$ind+1;
	}
	
	if($sel16==1)
	{
		//FORMULAS POR USUARIO
		if($ind!=0)$objPHPExcel->createSheet();
		$busca=mysql_query("SELECT costos_enca.cedu, costos_enca.nomusu, Count(costos_enca.formu) AS CuentaDeformu, 
		Sum(costos_enca.registros) AS SumaDeregistros, Sum(costos_enca.tcos) AS SumaDetcos
		FROM costos_enca WHERE ((costos_enca.ano)='$anoinforme') AND ((costos_enca.mes)='$mesinforme')
		GROUP BY costos_enca.cedu, costos_enca.nomusu
		ORDER BY Count(costos_enca.formu) DESC");
		$m=1;
		while($res=mysql_fetch_array($busca))
		{
			if($m==1)
			{				
				$objPHPExcel->setActiveSheetIndex($ind);
				$objPHPExcel->getActiveSheet()
				->setCellValue('A'.$m, 'DOCUMENTO')
				->setCellValue('B'.$m, 'NOMBRE USUARIO')
				->setCellValue('C'.$m, 'FORMULAS')
				->setCellValue('D'.$m, 'REGISTROS')
				->setCellValue('E'.$m, 'TOTAL COSTO');
			}
			$n=$m+1;			
			$objPHPExcel->setActiveSheetIndex($ind);
			$objPHPExcel->getActiveSheet()
			->setCellValue('A'.$n, $res['cedu'])
			->setCellValue('B'.$n, $res['nomusu'])
			->setCellValue('C'.$n, $res['CuentaDeformu'])
			->setCellValue('D'.$n, $res['SumaDeregistros'])
			->setCellValue('E'.$n, $res['SumaDetcos']);
			$m++;			
			
		}
		$objPHPExcel->getActiveSheet()->freezePane('A2');
		$objPHPExcel->getActiveSheet()->getStyle('A1:D1')->getFont()->setBold(true);
		$objPHPExcel->getActiveSheet()->getStyle('A'.$n.':D'.$n)->getFont()->setBold(true);
		$objPHPExcel->getActiveSheet()->setAutoFilter($objPHPExcel->getActiveSheet()->calculateWorksheetDimension());			
		$objPHPExcel->getActiveSheet()->setTitle('FORMULAS POR USUARIO');
		$ind=$ind+1;
	}
	
	
	if($sel17==1)
	{
		//FORMULAS X USUARIO CE
		if($ind!=0)$objPHPExcel->createSheet();
		$busca=mysql_query("SELECT costos_enca.cedu, costos_enca.nomusu, Count(costos_enca.formu) AS CuentaDeformu, Sum(costos_enca.registros) AS SumaDeregistros, Sum(costos_enca.tcos) AS SumaDetcos, costos_enca.scco
		FROM costos_enca WHERE ((costos_enca.ano)='$anoinforme') AND ((costos_enca.mes)='$mesinforme')
		GROUP BY costos_enca.cedu, costos_enca.nomusu, costos_enca.scco
		HAVING (((costos_enca.scco)<>6 And (costos_enca.scco)<>4 And (costos_enca.scco)<>18 And (costos_enca.scco)<>20 And (costos_enca.scco)<>7))
		ORDER BY Count(costos_enca.formu) DESC");
		$m=1;
		while($res=mysql_fetch_array($busca))
		{
			if($m==1)
			{				
				$objPHPExcel->setActiveSheetIndex($ind);
				$objPHPExcel->getActiveSheet()
				->setCellValue('A'.$m, 'DOCUMENTO')
				->setCellValue('B'.$m, 'NOMBRE USUARIO')
				->setCellValue('C'.$m, 'FORMULAS')
				->setCellValue('D'.$m, 'REGISTROS')
				->setCellValue('E'.$m, 'TOTAL COSTO');
			}
			$n=$m+1;			
			$objPHPExcel->setActiveSheetIndex($ind);
			$objPHPExcel->getActiveSheet()
			->setCellValue('A'.$n, $res['cedu'])
			->setCellValue('B'.$n, $res['nomusu'])
			->setCellValue('C'.$n, $res['CuentaDeformu'])
			->setCellValue('D'.$n, $res['SumaDeregistros'])
			->setCellValue('E'.$n, $res['SumaDetcos']);
			$m++;			
			
		}
		$objPHPExcel->getActiveSheet()->freezePane('A2');
		$objPHPExcel->getActiveSheet()->getStyle('A1:D1')->getFont()->setBold(true);
		$objPHPExcel->getActiveSheet()->getStyle('A'.$n.':D'.$n)->getFont()->setBold(true);
		$objPHPExcel->getActiveSheet()->setAutoFilter($objPHPExcel->getActiveSheet()->calculateWorksheetDimension());
		$objPHPExcel->getActiveSheet()->setTitle('FORMULAS X USUARIO CE');
		$ind=$ind+1;
	}
	
	
	if($sel18==1)
	{
		//FORMULAS X MEDICO
		if($ind!=0)$objPHPExcel->createSheet();
		$busca=mysql_query("SELECT costos_enca.nmedico, Count(costos_enca.formu) AS CuentaDeformu, Sum(costos_enca.registros) AS SumaDeregistros, Sum(costos_enca.tcos) AS SumaDetcos
		FROM costos_enca WHERE ((costos_enca.ano)='$anoinforme') AND ((costos_enca.mes)='$mesinforme')
		GROUP BY costos_enca.nmedico
		ORDER BY Count(costos_enca.formu) DESC");
		$tf=0;
		$tr=0;
		$tt=0;
		$m=1;
		while($res=mysql_fetch_array($busca))
		{
			if($m==1)
			{				
				$objPHPExcel->setActiveSheetIndex($ind);
				$objPHPExcel->getActiveSheet()
				->setCellValue('A'.$m, 'MEDICO')
				->setCellValue('B'.$m, 'FORMULAS')
				->setCellValue('C'.$m, 'REGISTROS')
				->setCellValue('D'.$m, 'TOTAL COSTO');
			}
			$n=$m+1;			
			$objPHPExcel->setActiveSheetIndex($ind);
			$objPHPExcel->getActiveSheet()
			->setCellValue('A'.$n, $res['nmedico'])
			->setCellValue('B'.$n, $res['CuentaDeformu'])
			->setCellValue('C'.$n, $res['SumaDeregistros'])
			->setCellValue('D'.$n, $res['SumaDetcos']);
			$tf=$res['CuentaDeformu']+$tf;
			$tr=$res['SumaDeregistros']+$tr;
			$tt=$res['SumaDetcos']+$tt;
			$m++;			
			
		}
		$n=$m+1;
		$objPHPExcel->setActiveSheetIndex($ind);
		$objPHPExcel->getActiveSheet()		
		->setCellValue('A'.$n, 'TOTALES')
		->setCellValue('B'.$n, $tf)
		->setCellValue('C'.$n, $tr)
		->setCellValue('D'.$n, $tt);
		$objPHPExcel->getActiveSheet()->freezePane('A2');
		$objPHPExcel->getActiveSheet()->getStyle('A1:D1')->getFont()->setBold(true);
		$objPHPExcel->getActiveSheet()->getStyle('A'.$n.':D'.$n)->getFont()->setBold(true);
		$objPHPExcel->getActiveSheet()->setAutoFilter($objPHPExcel->getActiveSheet()->calculateWorksheetDimension());
		$objPHPExcel->getActiveSheet()->setTitle('FORMULAS POR MEDICO');
		$ind=$ind+1;
	}
	
	if($sel19==1)
	{
		//FORMULAS POR CONTRATO
		$tf=0;
		$tr=0;
		$tt=0;
		if($ind!=0)$objPHPExcel->createSheet();
		$busca=mysql_query("SELECT costos_enca.nomccos, Count(costos_enca.formu) AS CuentaDeformu, Sum(costos_enca.registros) AS SumaDeregistros, Sum(costos_enca.tcos) AS SumaDetcos
		FROM costos_enca WHERE ((costos_enca.ano)='$anoinforme') AND ((costos_enca.mes)='$mesinforme')
		GROUP BY costos_enca.nomccos
		ORDER BY Count(costos_enca.formu) DESC");
		$m=1;
		while($res=mysql_fetch_array($busca))
		{
			if($m==1)
			{				
				$objPHPExcel->setActiveSheetIndex($ind);
				$objPHPExcel->getActiveSheet()
				->setCellValue('A'.$m, 'CONTRATO')
				->setCellValue('B'.$m, 'FORMULAS')
				->setCellValue('C'.$m, 'REGISTROS')
				->setCellValue('D'.$m, 'TOTAL COSTO');
			}
			$n=$m+1;			
			$objPHPExcel->setActiveSheetIndex($ind);
			$objPHPExcel->getActiveSheet()
			->setCellValue('A'.$n, $res['nomccos'])
			->setCellValue('B'.$n, $res['CuentaDeformu'])
			->setCellValue('C'.$n, $res['SumaDeregistros'])
			->setCellValue('D'.$n, $res['SumaDetcos']);
			$tf=$res['CuentaDeformu']+$tf;
			$tr=$res['SumaDeregistros']+$tr;
			$tt=$res['SumaDetcos']+$tt;
			$m++;			
			
		}
		$n=$m+1;
		$objPHPExcel->setActiveSheetIndex($ind);
		$objPHPExcel->getActiveSheet()		
		->setCellValue('A'.$n, 'TOTALES')
		->setCellValue('B'.$n, $tf)
		->setCellValue('C'.$n, $tr)
		->setCellValue('D'.$n, $tt);

		//$objPHPExcel->getActiveSheet()->getStyle('A1:D1')->getFont()->setBold(true);
		//$objPHPExcel->getActiveSheet()->setAutoFilter($objPHPExcel->getActiveSheet()->calculateWorksheetDimension());
		$objPHPExcel->getActiveSheet()->freezePane('A2');
		$objPHPExcel->getActiveSheet()->getStyle('A1:D1')->getFont()->setBold(true);
		$objPHPExcel->getActiveSheet()->getStyle('A'.$n.':D'.$n)->getFont()->setBold(true);
		$objPHPExcel->getActiveSheet()->setAutoFilter($objPHPExcel->getActiveSheet()->calculateWorksheetDimension());
		$objPHPExcel->getActiveSheet()->setTitle('FORMULAS POR CONTRATO');
		$ind=$ind+1;
	}
	/*
	if($sel20==1)
	{
		//FORMULAS POR AREA
		$tf=0;
		$tr=0;
		$tt=0;
		if($ind!=0)$objPHPExcel->createSheet();
		$busca=mysql_query("SELECT costos_enca.nomscco, Count(costos_enca.formu) AS CuentaDeformu, Sum(costos_enca.registros) AS SumaDeregistros, Sum(costos_enca.tcos) AS SumaDetcos
		FROM costos_enca WHERE ((costos_enca.ano)='$anoinforme') AND ((costos_enca.mes)='$mesinforme')
		GROUP BY costos_enca.nomscco
		ORDER BY Count(costos_enca.formu) DESC");
		$m=1;
		while($res=mysql_fetch_array($busca))
		{
			if($m==1)
			{				
				$objPHPExcel->setActiveSheetIndex($ind);
				$objPHPExcel->getActiveSheet()
				->setCellValue('A'.$m, 'AREA')
				->setCellValue('B'.$m, 'FORMULAS')
				->setCellValue('C'.$m, 'REGISTROS')
				->setCellValue('D'.$m, 'TOTAL COSTO');
			}
			$n=$m+1;			
			$objPHPExcel->setActiveSheetIndex($ind);
			$objPHPExcel->getActiveSheet()
			->setCellValue('A'.$n, $res['nomscco'])
			->setCellValue('B'.$n, $res['CuentaDeformu'])
			->setCellValue('C'.$n, $res['SumaDeregistros'])
			->setCellValue('D'.$n, $res['SumaDetcos']);
			$tf=$res['CuentaDeformu']+$tf;
			$tr=$res['SumaDeregistros']+$tr;
			$tt=$res['SumaDetcos']+$tt;
			$m++;			
			
		}
		$n=$m+1;
		$objPHPExcel->setActiveSheetIndex($ind);
		$objPHPExcel->getActiveSheet()		
		->setCellValue('A'.$n, 'TOTALES')
		->setCellValue('B'.$n, $tf)
		->setCellValue('C'.$n, $tr)
		->setCellValue('D'.$n, $tt);
		$objPHPExcel->getActiveSheet()->freezePane('A2');
		$objPHPExcel->getActiveSheet()->getStyle('A1:D1')->getFont()->setBold(true);
		$objPHPExcel->getActiveSheet()->getStyle('A'.$n.':D'.$n)->getFont()->setBold(true);
		$objPHPExcel->getActiveSheet()->setAutoFilter($objPHPExcel->getActiveSheet()->calculateWorksheetDimension());
		$objPHPExcel->getActiveSheet()->setTitle('FORMULAS POR AREA');
		$ind=$ind+1;
	}
	
	if($sel21==1)
	{
		//PACIENTES POR CONTRATO		
		if($ind!=0)$objPHPExcel->createSheet();
		$busca=mysql_query("CREATE TEMPORARY TABLE costotmp SELECT contrato.NSII_CON, formulamae.codi_usu
		FROM formulamae INNER JOIN contrato ON formulamae.ccos_for = contrato.CSII_CON
		WHERE (((formulamae.anodis_for)='$anoinforme' And (formulamae.mesdis_for )='$mesinforme'))
		GROUP BY contrato.NSII_CON, formulamae.codi_usu");
		$resul=mysql_query("SELECT costotmp.NSII_CON, Count(costotmp.codi_usu) AS CuentaDecodi_usu
		FROM costotmp
		GROUP BY costotmp.NSII_CON");
		$m=1;
		while($res=mysql_fetch_array($resul))
		{
			if($m==1)
			{				
				$objPHPExcel->setActiveSheetIndex($ind);
				$objPHPExcel->getActiveSheet()
				->setCellValue('A'.$m, 'AREA')				
				->setCellValue('B'.$m, 'PACIENTES');
			}
			$n=$m+1;			
			$objPHPExcel->setActiveSheetIndex($ind);
			$objPHPExcel->getActiveSheet()
			->setCellValue('A'.$n, $res['NSII_CON'])
			->setCellValue('B'.$n, $res['CuentaDecodi_usu']);
			$m++;			
		}	
		$objPHPExcel->getActiveSheet()->freezePane('A2');
		$objPHPExcel->getActiveSheet()->getStyle('A1:D1')->getFont()->setBold(true);
		$objPHPExcel->getActiveSheet()->getStyle('A'.$n.':D'.$n)->getFont()->setBold(true);
		$objPHPExcel->getActiveSheet()->setAutoFilter($objPHPExcel->getActiveSheet()->calculateWorksheetDimension());		
		$objPHPExcel->getActiveSheet()->setTitle('PACIENTES POR CONTRATO');
		$ind=$ind+1;
	}	
	if($sel22==1)
	{
		//PACIENTES POR AREA
		if($ind!=0)$objPHPExcel->createSheet();
		$busca=mysql_query("CREATE TEMPORARY TABLE costoare SELECT subcen.desc, formulamae.codi_usu
		FROM subcen INNER JOIN formulamae ON subcen.codi = formulamae.scco_for
		WHERE (((formulamae.anodis_for)>='$anoinforme' And (formulamae.mesdis_for)<='$mesinforme'))
		GROUP BY subcen.desc, formulamae.codi_usu");
		$resul=mysql_query("SELECT costoare.desc, Count(costoare.codi_usu) AS CuentaDecodi_usu1
		FROM costoare
		GROUP BY costoare.desc
		ORDER BY Count(costoare.codi_usu) DESC");
		$m=1;
		while($res=mysql_fetch_array($resul))
		{
			if($m==1)
			{				
				$objPHPExcel->setActiveSheetIndex($ind);
				$objPHPExcel->getActiveSheet()
				->setCellValue('A'.$m, 'AREA')				
				->setCellValue('B'.$m, 'PACIENTES');
			}
			$n=$m+1;			
			$objPHPExcel->setActiveSheetIndex($ind);
			$objPHPExcel->getActiveSheet()
			->setCellValue('A'.$n, $res['desc'])
			->setCellValue('B'.$n, $res['CuentaDecodi_usu1']);
			$m++;			
		}	
		$objPHPExcel->getActiveSheet()->freezePane('A2');
		$objPHPExcel->getActiveSheet()->getStyle('A1:D1')->getFont()->setBold(true);
		$objPHPExcel->getActiveSheet()->getStyle('A'.$n.':D'.$n)->getFont()->setBold(true);
		$objPHPExcel->getActiveSheet()->setAutoFilter($objPHPExcel->getActiveSheet()->calculateWorksheetDimension());			
		$objPHPExcel->getActiveSheet()->setTitle('PACIENTES POR AREA');
		$ind=$ind+1;
	}
	if($sel23==1)
	{
		//PACIENTES MULTIFORMULADOS		
		if($ind!=0)$objPHPExcel->createSheet();
		$cadmed=Mysql_query("SELECT formulamae.codi_usu, formulamae.fdis_for, formulamae.ccos_for, formulamae.scco_for, formulamae.tido_for, formulamae.codi_medi, formulamae.codi_bod, formuladet.codi_pro, 
		formuladet.cdis_for,formuladet.regi_for
		FROM formulamae INNER JOIN formuladet ON formulamae.nume_for = formuladet.nume_for
		WHERE (((formulamae.anodis_for)='$anoinforme' And (formulamae.mesdis_for )='$mesinforme') AND (formulamae.codi_bod)='2' AND ((formulamae.scco_for)='5' Or (formulamae.scco_for)='15' Or (formulamae.scco_for)='17') and formuladet.cdis_for>0 AND ((formulamae.tido_for)='1' Or (formulamae.tido_for)='2'))
		ORDER BY formulamae.codi_usu, formuladet.codi_pro, formulamae.fdis_for");
		$m=1;
		$n=0;
		while($row0 = mysql_fetch_array($cadmed))
		{				
			if($n==0)
			{
				$cedula1=$row0['codi_usu'];  
				$fecha1=$row0['fdis_for'];
				$codprod1=$row0['codi_pro'];				
				$registro1=$row0['regi_for'];
				$codcontra1=$row0['ccos_for'];
				$codarea1=$row0['scco_for'];
				$tipodoc1=$row0['tido_for'];
				$codmedico1=$row0['codi_medi'];	
				$codbodega1=$row0['codi_bod'];		
				$canti1=$row0['cdis_for'];
			}
			if($n==1)
			{
				$cedula2=$row0['codi_usu'];  
				$fecha2=$row0['fdis_for'];
				$codprod2=$row0['codi_pro'];				
				$registro2=$row0['regi_for'];
				$codcontra2=$row0['ccos_for'];
				$codarea2=$row0['scco_for'];
				$tipodoc2=$row0['tido_for'];
				$codmedico2=$row0['codi_medi'];	
				$codbodega2=$row0['codi_bod'];		
				$canti2=$row0['cdis_for'];
			}
			if($n>1)
			{			
				$cedula3=$row0['codi_usu'];  
				$fecha3=$row0['fdis_for'];
				$codprod3=$row0['codi_pro'];				
				$registro3=$row0['regi_for'];
				$codcontra3=$row0['ccos_for'];
				$codarea3=$row0['scco_for'];
				$tipodoc3=$row0['tido_for'];
				$codmedico3=$row0['codi_medi'];	
				$codbodega3=$row0['codi_bod'];		
				$canti3=$row0['cdis_for'];
				$ced1=$cedula1;
				$fec1=$fecha1;
				$cod1=$codprod1;
				$ced2=$cedula2;
				$fec2=$fecha2;
				$cod2=$codprod2;
				$ced3=$cedula3;
				$fec3=$fecha3;
				$cod3=$codprod3;									
				$an1=substr($fec1,0,4);
				$me1=substr($fec1,5,2);
				$di1=substr($fec1,8,2);
				$an2=substr($fec2,0,4);
				$me2=substr($fec2,5,2);
				$di2=substr($fec2,8,2);
				$an3=substr($fec3,0,4);
				$me3=substr($fec3,5,2);
				$di3=substr($fec3,8,2);
				$tim1=mktime(0,0,0,$me1,$di1,$an1);
				$tim2=mktime(0,0,0,$me2,$di2,$an2);
				$tim3=mktime(0,0,0,$me3,$di3,$an3);
				$cuenta=60*60*24*15;
				$tiempo1=$tim2-$tim1;
				$tiempo2=$tim3-$tim2;
				$entra=0;
				if($ced1==$ced2 && $cod1==$cod2 && $tiempo1<$cuenta)$entra=1;
				if($ced2==$ced3 && $cod2==$cod3 && $tiempo2<$cuenta)$entra=1;
				//echo $ebtra.'<br>';
				if($entra==1)
				{				
					$nombodega='';
					$nomarea='';
					$nomcontra='';
					$costou='';
					$nomusu='';
					$nommedico='';
					$nombre='';
					$codsiigo='';
					Mysql_select_db('proinsalud');
					$bussub=mysql_query("select * from usuario where NROD_USU='$cedula2'");
					$row2 = mysql_fetch_array($bussub);
					$nomusu=$row2['PNOM_USU'].' '.$row2['SNOM_USU'].' '.$row2['PAPE_USU'].' '.$row2['SAPE_USU'];
					$bussub=mysql_query("select * from medicos where csii_med='$codmedico2'");
					$row2 = mysql_fetch_array($bussub);
					$nommedico=$row2['nom_medi'];
					$busmedi=mysql_query("select * from medicamentos2 where codi_mdi='$codprod2'");
					$row2 = mysql_fetch_array($busmedi);
					$nombre=$row2['nomb_mdi'];
					$codsiigo=$row2['ncsi_medi'];
					Mysql_select_db('formedica');
					$busbod=mysql_query("select * from bodegas where codi_bod='$codbodega2'");					
					$row2 = mysql_fetch_array($busbod);
					$nombodega=$row2['desc_bod'];
					if(empty($nombodega))$nombodega='NO';
					$bussub=mysql_query("select * from subcentro where codigo='$codarea2'");
					$row2 = mysql_fetch_array($bussub);
					$nomarea=$row2['NomSubCenteo'];
					$bussub=mysql_query("select * from centro where codigo='$codcontra2'");
					$row2 = mysql_fetch_array($bussub);
					$nomcontra=$row2['NomCentro'];
					$bcos=mysql_query("select * from producto2013 where CODSIIGO='$codsiigo'");
					$rcos=mysql_fetch_array($bcos);
					$costou=$rcos['COSTO_UNITARIO'];
					$costot=$costou*$canti2;
					if($m==1)
					{				
						$objPHPExcel->setActiveSheetIndex($ind);
						$objPHPExcel->getActiveSheet()
						->setCellValue('A'.$m, 'NUMERO')
						->setCellValue('B'.$m, 'REGISTRO')
						->setCellValue('C'.$m, 'CEDULA')
						->setCellValue('D'.$m, 'PACIENTE')
						->setCellValue('E'.$m, 'FECHA')
						->setCellValue('F'.$m, 'CODCONTRA')
						->setCellValue('G'.$m, 'CONTRATO')
						->setCellValue('H'.$m, 'CODAREA')
						->setCellValue('I'.$m, 'AREA')
						->setCellValue('J'.$m, 'CODMEDICO')
						->setCellValue('K'.$m, 'MEDICO')
						->setCellValue('L'.$m, 'CODBODEGA')
						->setCellValue('M'.$m, 'BODEGA')
						->setCellValue('N'.$m, 'CODPROD')
						->setCellValue('O'.$m, 'PRODUCTO')
						->setCellValue('P'.$m, 'CANTIDAD')
						->setCellValue('Q'.$m, 'COSTO UNI')
						->setCellValue('R'.$m, 'COSTO TOT');						
					}					
					$p=$m+1;			
					$objPHPExcel->setActiveSheetIndex($ind);
					$objPHPExcel->getActiveSheet()
					->setCellValue('A'.$p, $n)
					->setCellValue('B'.$p, $registro2)
					->setCellValue('C'.$p, $cedula2)
					->setCellValue('D'.$p, $nomusu)
					->setCellValue('E'.$p, $fecha2)
					->setCellValue('F'.$p, $codcontra2)
					->setCellValue('G'.$p, $nomcontra)
					->setCellValue('H'.$p, $codarea2)			
					->setCellValue('I'.$p, $nomarea)			
					->setCellValue('J'.$p, $codmedico2)
					->setCellValue('K'.$p, $nommedico)
					->setCellValue('L'.$p, $codbodega2)
					->setCellValue('M'.$p, $nombodega)
					->setCellValue('N'.$p, $codprod2)
					->setCellValue('O'.$p, $nombre)
					->setCellValue('P'.$p, $canti2)
					->setCellValue('Q'.$p, $costou)
					->setCellValue('R'.$p, $costot);
					$m++;
					$p++;					
				}
				$cedula1=$cedula2; 
				$fecha1=$fecha2;
				$codprod1=$codprod2;				
				$registro1=$registro2;
				$codcontra1=$codcontra2;
				$codarea1=$codarea2;
				$tipodoc1=$tipodoc2;
				$codmedico1=$codmedico2;	
				$codbodega1=$codbodega2;		
				$canti1=$canti2;				
				$cedula2=$cedula3; 
				$fecha2=$fecha3;
				$codprod2=$codprod3;				
				$registro2=$registro3;
				$codcontra2=$codcontra3;
				$codarea2=$codarea3;
				$tipodoc2=$tipodoc3;
				$codmedico2=$codmedico3;	
				$codbodega2=$codbodega3;		
				$canti2=$canti3;
			}
			$n++;
		}	
		$objPHPExcel->getActiveSheet()->freezePane('A2');
		$objPHPExcel->getActiveSheet()->getStyle('A1:D1')->getFont()->setBold(true);
		$objPHPExcel->getActiveSheet()->getStyle('A'.$n.':D'.$n)->getFont()->setBold(true);
		$objPHPExcel->getActiveSheet()->setAutoFilter($objPHPExcel->getActiveSheet()->calculateWorksheetDimension());	
		$objPHPExcel->getActiveSheet()->setTitle('MULTIFORMULADOS');
		$ind=$ind+1;
	}
	
	
	if($sel24==1)
	{
	
	}
	*/
	if($sel20==1)
	{
		//NUMERO DE FORMULAS Y NUMERO DE REGISTROS
		$bfor=mysql_query("SELECT Count(costos_enca.formu) AS CuentaDeformu, Sum(costos_enca.registros) AS SumaDeregistros
		FROM costos_enca WHERE (((costos_enca.ano)='$anoinforme') AND ((costos_enca.mes)='$mesinforme'))");
		$rfor=mysql_fetch_array($bfor);
		$formulas=$rfor['CuentaDeformu'];
		$registros=$rfor['SumaDeregistros'];	
		
		
		//NUMERO DE USUARIOS
		$busu=mysql_query("CREATE TEMPORARY TABLE nuusu SELECT costos_enca.cedu FROM costos_enca
		WHERE (((costos_enca.ano)='$anoinforme') AND ((costos_enca.mes)='$mesinforme'))
		GROUP BY costos_enca.cedu");		
		$nusu=mysql_query("SELECT Count(nuusu.cedu) AS ncedu FROM nuusu");
		$rusu=mysql_fetch_array($nusu);
		$cuentausu=$rusu['ncedu'];
		
		//NUMERO DE PRODUCTOS
		$bpro=mysql_query("CREATE TEMPORARY TABLE numpro SELECT costos_deta.cproducto FROM costos_deta
		WHERE (((costos_deta.ano)='$anoinforme') AND ((costos_deta.mes)='$mesinforme'))
		GROUP BY costos_deta.cproducto");
		$npro=mysql_query("SELECT Count(numpro.cproducto) AS ncproducto FROM numpro");
		$rpro=mysql_fetch_array($npro);
		$cuentapro=$rpro['ncproducto'];
		
		//NUMERO DE ESPECIALIDADES
		$besp=mysql_query("CREATE TEMPORARY TABLE numesp SELECT costos_enca.nespe FROM costos_enca
		GROUP BY costos_enca.nespe");
		$nesp=mysql_query("SELECT Count(numesp.nespe) AS nnespe FROM numesp");
		$resp=mysql_fetch_array($nesp);
		$cuentaesp=$resp['nnespe'];

		//NUMERO DE PRODUCTOS ALTO COSTO
		$bpac=mysql_query("CREATE TEMPORARY TABLE numpac SELECT costos_deta.cproducto
		FROM costos_deta
		WHERE (((costos_deta.altocosto)='S') AND ((costos_deta.ano)='$anoinforme') AND ((costos_deta.mes)='$mesinforme'))
		GROUP BY costos_deta.cproducto");
		$npac=mysql_query("SELECT Count(numpac.cproducto) AS ncproductoac FROM numpac");
		$rpac=mysql_fetch_array($npac);
		$cuentapac=$rpac['ncproductoac'];
		
		if($ind!=0)$objPHPExcel->createSheet();
		$objPHPExcel->setActiveSheetIndex($ind);
		$objPHPExcel->getActiveSheet()
		->setCellValue('A1', 'NUMERO DE FORMULAS DISPENSADAS')
		->setCellValue('A2', 'NUMERO DE REGISTROS FORMULADOS')
		->setCellValue('A3', 'NUMERO DE USUARIOS DIGITADOS')
		->setCellValue('A4', 'NUMERO DE PRODUCTOS DISPENSADOS')
		->setCellValue('A5', 'NUMERO DE ESPECIALIDADES QUE FORMULARON')
		->setCellValue('A6', 'NUMERO DE PRODUCTOS ALTO COSTO DISPENSADOS')
		->setCellValue('B1', $formulas)
		->setCellValue('B2', $registros)
		->setCellValue('B3', $cuentausu)
		->setCellValue('B4', $cuentapro)
		->setCellValue('B5', $cuentaesp)
		->setCellValue('B6', $cuentapac);		
		$objPHPExcel->getActiveSheet()->setTitle('DATOS ESTADISTICOS');
		$ind=$ind+1;
	}


	
	if($sel21==1)
	{
		//INFORME PARA COSTOS
		if($ind!=0)$objPHPExcel->createSheet();
		$busca=mysql_query("SELECT costos_deta.ano, costos_deta.mes, costos_deta.tipodoc, costos_deta.nomtip, costos_deta.ccos, costos_deta.nomccos, costos_deta.scco, costos_deta.nomscco, costos_deta.cbod, costos_deta.nombod, costos_deta.cmedico, costos_deta.codintmed, costos_deta.nmedico, costos_deta.especi, costos_deta.nespe, costos_deta.cproducto, costos_deta.tipo, costos_deta.csiigo, costos_deta.nombrepro, costos_deta.altocosto, costos_deta.posi, Sum(costos_deta.canti) AS SumaDecanti, costos_deta.costo, costos_deta.ultcom, Sum(costos_deta.tcos) AS SumaDetcos, Sum(costos_deta.tuco) AS SumaDetuco, Sum(costos_deta.tucomas50) AS SumaDetucomas50, costos_deta.servicio
		FROM costos_deta
		GROUP BY costos_deta.ano, costos_deta.mes, costos_deta.tipodoc, costos_deta.nomtip, costos_deta.ccos, costos_deta.nomccos, costos_deta.scco, costos_deta.nomscco, costos_deta.cbod, costos_deta.nombod, costos_deta.cmedico, costos_deta.codintmed, costos_deta.nmedico, costos_deta.especi, costos_deta.nespe, costos_deta.cproducto, costos_deta.tipo, costos_deta.csiigo, costos_deta.nombrepro, costos_deta.altocosto, costos_deta.posi, costos_deta.costo, costos_deta.ultcom, costos_deta.servicio
		HAVING (((costos_deta.ano)='$anoinforme') AND ((costos_deta.mes)='$mesinforme'))");
		
		$m=1;
		while($res=mysql_fetch_array($busca))
		{
			if($m==1)
			{				
				$objPHPExcel->setActiveSheetIndex($ind);
				$objPHPExcel->getActiveSheet()
				->setCellValue('A'.$m, 'AÑO')
				->setCellValue('B'.$m, 'MES')
				->setCellValue('C'.$m, 'TIPODOCUMENTO')
				->setCellValue('D'.$m, 'CODCONTRATO')
				->setCellValue('E'.$m, 'NOMCONTRATO')
				->setCellValue('F'.$m, 'CODAREA:')
				->setCellValue('G'.$m, 'NOMAREA')
				->setCellValue('H'.$m, 'CODBODEGA')
				->setCellValue('I'.$m, 'NOMBODEGA')
				->setCellValue('J'.$m, 'CODSIIGOMEDICO')
				->setCellValue('K'.$m, 'CODMEDICO')
				->setCellValue('L'.$m, 'NOMMEDICO')
				->setCellValue('M'.$m, 'CODESPE')
				->setCellValue('N'.$m, 'NOMESPECIALIDAD')
				->setCellValue('O'.$m, 'SERVICIO')
				->setCellValue('P'.$m, 'CODPRODUCTO')
				->setCellValue('Q'.$m, 'TIPOPRODUCTO')
				->setCellValue('R'.$m, 'CODSIIGOPRODUCTO')				
				->setCellValue('S'.$m, 'NOMPRODUCTO')
				->setCellValue('T'.$m, 'ALTOCOSTO')
				->setCellValue('U'.$m, 'POS')
				->setCellValue('V'.$m, 'CANTIDAD')
				->setCellValue('W'.$m, 'COSTOUNITARIO')
				->setCellValue('X'.$m, 'VALORULTCOMPRA')
				->setCellValue('Y'.$m, 'TOTALCOSTO')
				->setCellValue('Z'.$m, 'TOTALULTCOMPRA')
				->setCellValue('AA'.$m, 'ULTCOM-MAS-50');
			}
			$n=$m+1;			
			$objPHPExcel->setActiveSheetIndex($ind);
			$objPHPExcel->getActiveSheet()
			->setCellValue('A'.$n, $res['ano'])
			->setCellValue('B'.$n, $res['mes'])
			->setCellValue('C'.$n, $res['tipodoc'])
			->setCellValue('D'.$n, $res['ccos'])
			->setCellValue('E'.$n, $res['nomccos'])
			->setCellValue('F'.$n, $res['scco'])
			->setCellValue('G'.$n, $res['nomscco'])
			->setCellValue('H'.$n, $res['cbod'])			
			->setCellValue('I'.$n, $res['nombod'])			
			->setCellValue('J'.$n, $res['cmedico'])
			->setCellValue('K'.$n, $res['codintmed'])
			->setCellValue('L'.$n, $res['nmedico'])
			->setCellValue('M'.$n, $res['especi'])
			->setCellValue('N'.$n, $res['nespe'])			
			->setCellValue('O'.$n, $res['servicio'])
			->setCellValue('P'.$n, $res['cproducto'])
			->setCellValue('Q'.$n, $res['tipo'])
			->setCellValue('R'.$n, $res['csiigo'])
			->setCellValue('S'.$n, $res['nombrepro'])		
			->setCellValue('T'.$n, $res['altocosto'])			
			->setCellValue('U'.$n, $res['posi'])
			->setCellValue('V'.$n, $res['SumaDecanti'])
			->setCellValue('W'.$n, $res['costo'])
			->setCellValue('X'.$n, $res['ultcom'])
			->setCellValue('Y'.$n, $res['SumaDetcos'])
			->setCellValue('Z'.$n, $res['SumaDetuco'])
			->setCellValue('AA'.$n, $res['SumaDetucomas50']);
			$m++;			
		}	
		$objPHPExcel->getActiveSheet()->freezePane('A2');
		$objPHPExcel->getActiveSheet()->getStyle('A1:D1')->getFont()->setBold(true);
		$objPHPExcel->getActiveSheet()->getStyle('A'.$n.':D'.$n)->getFont()->setBold(true);
		$objPHPExcel->getActiveSheet()->setAutoFilter($objPHPExcel->getActiveSheet()->calculateWorksheetDimension());			
		$objPHPExcel->getActiveSheet()->setTitle('CONSUMOS');
		$ind=$ind+1;
	}
	
	if($sel22==1)
	{
		//FORMULAS X MEDICO CE		
		if($ind!=0)$objPHPExcel->createSheet();
		$busca=mysql_query("SELECT costos_enca.nmedico, costos_enca.nespe, costos_enca.nomscco, Count(costos_enca.formu) 
		AS CuentaDeformu, Sum(costos_enca.registros) AS SumaDeregistros, Sum(costos_enca.tcos) AS SumaDetcos
		FROM costos_enca
		WHERE (((costos_enca.ano)='$anoinforme') AND ((costos_enca.mes)='$mesinforme'))
		GROUP BY costos_enca.nmedico, costos_enca.nespe, costos_enca.nomscco
		ORDER BY costos_enca.nmedico, costos_enca.nespe, costos_enca.nomscco");
		$m=1;
		while($res=mysql_fetch_array($busca))
		{
			if($m==1)
			{			
				$objPHPExcel->setActiveSheetIndex($ind);
				$objPHPExcel->getActiveSheet()
				->setCellValue('A'.$m, 'MEDICOS')
				->setCellValue('B'.$m, 'ESPECIALIDAD')
				->setCellValue('C'.$m, 'CENTRO COSTO')
				->setCellValue('D'.$m, 'FORMULAS')
				->setCellValue('E'.$m, 'REGISTROS')
				->setCellValue('F'.$m, 'TOTAL COSTO');
			}
			$n=$m+1;			
			$objPHPExcel->setActiveSheetIndex($ind);
			$objPHPExcel->getActiveSheet()
			->setCellValue('A'.$n, $res['nmedico'])
			->setCellValue('B'.$n, $res['nespe'])
			->setCellValue('C'.$n, $res['nomscco'])
			->setCellValue('D'.$n, $res['CuentaDeformu'])
			->setCellValue('E'.$n, $res['SumaDeregistros'])
			->setCellValue('F'.$n, $res['SumaDetcos']);
			$m++;			
			
		}
		$objPHPExcel->getActiveSheet()->freezePane('A2');
		$objPHPExcel->getActiveSheet()->getStyle('A1:D1')->getFont()->setBold(true);
		$objPHPExcel->getActiveSheet()->getStyle('A'.$n.':D'.$n)->getFont()->setBold(true);
		$objPHPExcel->getActiveSheet()->setAutoFilter($objPHPExcel->getActiveSheet()->calculateWorksheetDimension());
		$objPHPExcel->getActiveSheet()->setTitle('FORMULAS X MEDICO2');
		$ind=$ind+1;
	}
	
	
	if($sel23==1)
	{
		$fechaini=$anoinforme.'-'.$mesinforme.'-01';
		$fechafin=$anoinforme.'-'.$mesinforme.'-31';
		
		//INFORME PARA COSTOS DEVOLUCIONES
		if($ind!=0)$objPHPExcel->createSheet();
		$busca=mysql_query("SELECT formulamae.anodis_for AS ano, formulamae.mesdis_for AS mes, formulamae.ccos_for, centro.NomCentro, formulamae.scco_for, subcentro.NomSubCenteo, formulamae.codi_bod, bodegas.desc_bod, formulamae.codi_medi, formuladet.codi_pro, Sum(formuladet.cdis_for) AS SumaDecdis_for
		FROM (((formuladet INNER JOIN formulamae ON formuladet.nume_for = formulamae.nume_for) LEFT JOIN subcentro ON formulamae.scco_for = subcentro.codigo) LEFT JOIN centro ON formulamae.ccos_for = centro.codigo) LEFT JOIN bodegas ON formulamae.codi_bod = bodegas.codi_bod
		WHERE (((formulamae.fdis_for)>='$fechaini' And (formulamae.fdis_for)<='$fechafin') AND ((formulamae.tido_for)=9 Or (formulamae.tido_for)=10))
		GROUP BY formulamae.anodis_for, formulamae.mesdis_for, formulamae.ccos_for, centro.NomCentro, formulamae.scco_for, subcentro.NomSubCenteo, formulamae.codi_bod, bodegas.desc_bod, formulamae.codi_medi, formuladet.codi_pro
		HAVING (((Sum(formuladet.cdis_for))>0))
		ORDER BY formulamae.mesdis_for, formulamae.codi_medi, formuladet.codi_pro");
		
		$m=1;
		while($row0=mysql_fetch_array($busca))
		{
			if($m==1)
			{				
				$objPHPExcel->setActiveSheetIndex($ind);
				$objPHPExcel->getActiveSheet()
				->setCellValue('A'.$m, 'AÑO')
				->setCellValue('B'.$m, 'MES')
				->setCellValue('C'.$m, 'CODCONTRATO')
				->setCellValue('D'.$m, 'NOMCONTRATO')
				->setCellValue('E'.$m, 'CODAREA:')
				->setCellValue('F'.$m, 'NOMAREA')
				->setCellValue('G'.$m, 'CODBODEGA')
				->setCellValue('H'.$m, 'NOMBODEGA')
				->setCellValue('I'.$m, 'CODSIIGOMEDICO')
				->setCellValue('J'.$m, 'CODMEDICO')
				->setCellValue('K'.$m, 'NOMMEDICO')
				->setCellValue('L'.$m, 'CODESPE')
				->setCellValue('M'.$m, 'NOMESPECIALIDAD')
				->setCellValue('N'.$m, 'CODPRODUCTO')
				->setCellValue('O'.$m, 'TIPOPRODUCTO')
				->setCellValue('P'.$m, 'CODSIIGOPRODUCTO')
				->setCellValue('Q'.$m, 'NOMPRODUCTO')
				->setCellValue('R'.$m, 'CANTIDAD')
				->setCellValue('S'.$m, 'COSTOUNITARIO')
				->setCellValue('T'.$m, 'VALORULTCOMPRA')
				->setCellValue('U'.$m, 'TOTALCOSTO')
				->setCellValue('V'.$m, 'TOTALULTCOMPRA')
				->setCellValue('W'.$m, 'ULTCOM-MAS-50');
			}
			
			
			$ano=$row0['ano'];
			$mes=$row0['mes'];
			$ccos=$row0['ccos_for'];
			$nomccos=$row0['NomCentro'];
			$scco=$row0['scco_for'];
			$nomscco=$row0['NomSubCenteo'];
			$cbod=$row0['codi_bod'];
			$nombod=$row0['desc_bod'];
			$cmedico=$row0['codi_medi'];
			$cproducto=$row0['codi_pro'];
			$canti=$row0['SumaDecdis_for'];
			$nmedico='';
			$codintmed='';
			$especi='';
			Mysql_select_db('proinsalud',$conexion);
			$busmedico=mysql_query("select * from medicos where csii_med = '$cmedico'");
			while($row1 = mysql_fetch_array($busmedico))
			{	
				$nmedico=$row1['nom_medi'];
				$codintmed=$row1['cod_medi'];
				$especi=$row1['espe_med'];
			}
			$nespe='';
			$bespe=mysql_query("SELECT * FROM `destipos` where codi_des='$especi'");
			while($resp = mysql_fetch_array($bespe))
			{	
				$nespe=$resp['nomb_des'];
			}
			$nompro='';
			$csiigo='';
			$largo=strlen($cproducto);			
			if($largo==6)
			{
				
				$cproducto=trim($cproducto);
				$bpro=mysql_query("SELECT medicamentos2.codi_mdi, medicamentos2.nomb_mdi, medicamentos2.noco_mdi, forma_farmaceutica.desc_ffa, medicamentos2.ncsi_medi
				FROM medicamentos2 INNER JOIN forma_farmaceutica ON medicamentos2.coff_mdi = forma_farmaceutica.codi_ffa
				WHERE (((medicamentos2.codi_mdi)='$cproducto'))");
				while($rnop=mysql_fetch_array($bpro))
				{
					$nompro=$rnop['nomb_mdi'].' '.$rnop['noco_mdi'].' '.$rnop['desc_ffa'];
					$csiigo=$rnop['ncsi_medi'];						
				}
				$tipo="MEDICAMENTO";		
			}
			else
			{
				$bpro=mysql_query("SELECT * from insu_med where codi_ins='$cproducto'");
				while($rnop=mysql_fetch_array($bpro))
				{
					$nompro=$rnop['desc_ins'];
					$csiigo=$rnop['codnue'];					
				}
				$tipo="DISPOSITIVO";
			}			
			$pos=strrpos( $nompro, chr(10));
			if(substr($nompro,$pos,1)==chr(10))	$nombrepro=substr($nompro,0,$pos-1);
			else $nombrepro=$nompro;
	
			
			
			
			$costo=0;
			$ultcom=0;
			$valido=0;
			

			Mysql_select_db('formedica',$conexion);		
			$precio=mysql_query("select * from producto2017 where  ProductoInv ='$csiigo'");		
			while($rcos=mysql_fetch_array($precio))
			{
				$costo=$rcos['UnitarioInv'];
				$ultcom=$rcos['CompraInv'];
				$valido=1;
			}
			if($valido==0)
			{
				//echo"producto: ".$nompro.' '.$csiigo.' '.$cproducto.'<br>';
			}
		
			Mysql_select_db('proinsalud',$conexion);			
			
			$tcos=$costo*$canti;
			$tuco=$ultcom*$canti;
			$tucomas50=$tuco+($tuco/2);			
			
			$n=$m+1;			
			$objPHPExcel->setActiveSheetIndex($ind);
			$objPHPExcel->getActiveSheet()
			->setCellValue('A'.$n, $ano)
			->setCellValue('B'.$n, $mes)
			->setCellValue('C'.$n, $ccos)
			->setCellValue('D'.$n, $nomccos)
			->setCellValue('E'.$n, $scco)
			->setCellValue('F'.$n, $nomscco)
			->setCellValue('G'.$n, $cbod)			
			->setCellValue('H'.$n, $nombod)			
			->setCellValue('I'.$n, $cmedico)
			->setCellValue('J'.$n, $codintmed)
			->setCellValue('K'.$n, $nmedico)
			->setCellValue('L'.$n, $especi)
			->setCellValue('M'.$n, $nespe)
			->setCellValue('N'.$n, $cproducto)
			->setCellValue('O'.$n, $tipo)
			->setCellValue('P'.$n, $csiigo)
			->setCellValue('Q'.$n, $nombrepro)		
			->setCellValue('R'.$n, $canti)
			->setCellValue('S'.$n, $costo)
			->setCellValue('T'.$n, $ultcom)
			->setCellValue('U'.$n, $tcos)
			->setCellValue('V'.$n, $tuco)
			->setCellValue('W'.$n, $tucomas50);
			$m++;
		}	
		$objPHPExcel->getActiveSheet()->freezePane('A2');
		$objPHPExcel->getActiveSheet()->getStyle('A1:D1')->getFont()->setBold(true);
		$objPHPExcel->getActiveSheet()->getStyle('A'.$n.':D'.$n)->getFont()->setBold(true);
		$objPHPExcel->getActiveSheet()->setAutoFilter($objPHPExcel->getActiveSheet()->calculateWorksheetDimension());			
		$objPHPExcel->getActiveSheet()->setTitle('DEVOLUCIONES');
		$ind=$ind+1;
	}	
	
	if($sel24==1)
	{
		$mesi=intval($mesinforme)-1;
		if($mesi==0)
		{
			$mesini=12;
			$anoini=$anoinforme-1;
		}
		else
		{
			$mesini=$mesi;
			$anoini=$anoinforme;
		}
		$fechaini=$anoini.'-'.$mesini.'-25';
		$fechafin=$anoinforme.'-'.$mesinforme.'-31';
		date_default_timezone_set ('America/Bogota');
		//MULTIFORMULADOS
		if($ind!=0)$objPHPExcel->createSheet();		
		$busca=mysql_query("SELECT formulamae.codi_usu, formulamae.fdis_for, formulamae.ccos_for, formulamae.scco_for, 
		formulamae.tido_for, formulamae.codi_medi, formulamae.codi_bod, formuladet.codi_pro, 
		formuladet.cdis_for,formuladet.regi_for
		FROM formulamae INNER JOIN formuladet ON formulamae.nume_for = formuladet.nume_for
		WHERE ((((formulamae.fdis_for)>='$fechaini') and (formulamae.fdis_for)<='$fechafin') AND (formulamae.codi_bod)='2' AND ((formulamae.scco_for)='5' Or (formulamae.scco_for)='15' Or (formulamae.scco_for)='17') and formuladet.cdis_for>0 AND ((formulamae.tido_for)='1' Or (formulamae.tido_for)='2'))
		ORDER BY formulamae.codi_usu, formuladet.codi_pro, formulamae.fdis_for");
		$p=0;
		$q=0;
		$m=1;
		while($row0=mysql_fetch_array($busca))
		{
			if($m==1)
			{				
				$objPHPExcel->setActiveSheetIndex($ind);
				$objPHPExcel->getActiveSheet()
				->setCellValue('A'.$m, 'NUMERO')
				->setCellValue('B'.$m, 'REGISTRO')
				->setCellValue('C'.$m, 'CEDULA')
				->setCellValue('D'.$m, 'PACIENTE')
				->setCellValue('E'.$m, 'FECHA')
				->setCellValue('F'.$m, 'CODCONTRA')
				->setCellValue('G'.$m, 'CONTRATO')
				->setCellValue('H'.$m, 'CODAREA')
				->setCellValue('I'.$m, 'AREA')
				->setCellValue('J'.$m, 'CODMEDICO')
				->setCellValue('K'.$m, 'MEDICO')
				->setCellValue('L'.$m, 'CODBODEGA')
				->setCellValue('M'.$m, 'BODEGA')
				->setCellValue('N'.$m, 'CODPROD')
				->setCellValue('O'.$m, 'PRODUCTO')
				->setCellValue('P'.$m, 'CANTIDAD')
				->setCellValue('Q'.$m, 'COSTO');				
			}
			if($q==0)
			{
				$cedula1=$row0['codi_usu'];  
				$fecha1=$row0['fdis_for'];
				$codprod1=$row0['codi_pro'];				
				$registro1=$row0['regi_for'];
				$codcontra1=$row0['ccos_for'];
				$codarea1=$row0['scco_for'];
				$tipodoc1=$row0['tido_for'];
				$codmedico1=$row0['codi_medi'];	
				$codbodega1=$row0['codi_bod'];		
				$canti1=$row0['cdis_for'];
			}
			if($q==1)
			{
				$cedula2=$row0['codi_usu'];  
				$fecha2=$row0['fdis_for'];
				$codprod2=$row0['codi_pro'];				
				$registro2=$row0['regi_for'];
				$codcontra2=$row0['ccos_for'];
				$codarea2=$row0['scco_for'];
				$tipodoc2=$row0['tido_for'];
				$codmedico2=$row0['codi_medi'];	
				$codbodega2=$row0['codi_bod'];		
				$canti2=$row0['cdis_for'];
			}
			
			if($q>1)
			{			
				$cedula3=$row0['codi_usu'];  
				$fecha3=$row0['fdis_for'];
				$codprod3=$row0['codi_pro'];				
				$registro3=$row0['regi_for'];
				$codcontra3=$row0['ccos_for'];
				$codarea3=$row0['scco_for'];
				$tipodoc3=$row0['tido_for'];
				$codmedico3=$row0['codi_medi'];	
				$codbodega3=$row0['codi_bod'];		
				$canti3=$row0['cdis_for'];
				
				$ced1=$cedula1;
				$fec1=$fecha1;
				$cod1=$codprod1;
				$ced2=$cedula2;
				$fec2=$fecha2;
				$cod2=$codprod2;
				$ced3=$cedula3;
				$fec3=$fecha3;
				$cod3=$codprod3;
									
				$an1=substr($fec1,0,4);
				$me1=substr($fec1,5,2);
				$di1=substr($fec1,8,2);
				$an2=substr($fec2,0,4);
				$me2=substr($fec2,5,2);
				$di2=substr($fec2,8,2);
				$an3=substr($fec3,0,4);
				$me3=substr($fec3,5,2);
				$di3=substr($fec3,8,2);		
				
				$tim1=mktime(0,0,0,$me1,$di1,$an1);
				$tim2=mktime(0,0,0,$me2,$di2,$an2);
				$tim3=mktime(0,0,0,$me3,$di3,$an3);
				
				$cuenta=60*60*24*15;
				$tiempo1=$tim2-$tim1;
				$tiempo2=$tim3-$tim2;
				
				$entra=0;
				if($ced1==$ced2 && $cod1==$cod2 && $tiempo1<$cuenta)$entra=1;
				if($ced2==$ced3 && $cod2==$cod3 && $tiempo2<$cuenta)$entra=1;
				//echo $ebtra.'<br>';
				if($entra==1)
				{				
					$nombodega='';
					$nomarea='';
					$nomcontra='';
					$costou='';
					$nomusu='';
					$nommedico='';
					$nombre='';
					$codsiigo='';
					Mysql_select_db('proinsalud');
					$bussub=mysql_query("select * from usuario where NROD_USU='$cedula2'");
					$row2 = mysql_fetch_array($bussub);
					$nomusu=$row2['PNOM_USU'].' '.$row2['SNOM_USU'].' '.$row2['PAPE_USU'].' '.$row2['SAPE_USU'];
					$bussub=mysql_query("select * from medicos where csii_med='$codmedico2'");
					$row2 = mysql_fetch_array($bussub);
					$nommedico=$row2['nom_medi'];
					$busmedi=mysql_query("select * from medicamentos2 where codi_mdi='$codprod2'");
					$row2 = mysql_fetch_array($busmedi);
					$nombre=$row2['nomb_mdi'];
					$codsiigo=$row2['ncsi_medi'];
					Mysql_select_db('formedica');
					$busbod=mysql_query("select * from bodegas where codi_bod='$codbodega2'");
					$row2 = mysql_fetch_array($busbod);
					$nombodega=$row2['desc_bod'];
					$bussub=mysql_query("select * from subcentro where codigo='$codarea2'");
					$row2 = mysql_fetch_array($bussub);
					$nomarea=$row2['NomSubCenteo'];
					$bussub=mysql_query("select * from centro where codigo='$codcontra2'");
					$row2 = mysql_fetch_array($bussub);
					$nomcontra=$row2['NomCentro'];					
					$costo=0;
					
							
					$precio=mysql_query("select * from producto2017 where  ProductoInv ='$codsiigo'");		
					while($rcos=mysql_fetch_array($precio))
					{
						$costou=$rcos['UnitarioInv'];
					}
					
				
					Mysql_select_db('proinsalud',$conexion);
					

					
					$tcos=$costou*$canti2;
					
					$n=$m+1;			
					$objPHPExcel->setActiveSheetIndex($ind);
					$objPHPExcel->getActiveSheet()
					->setCellValue('A'.$n, $q)
					->setCellValue('B'.$n, $registro2)
					->setCellValue('C'.$n, $cedula2)
					->setCellValue('D'.$n, $nomusu)
					->setCellValue('E'.$n, $fecha2)
					->setCellValue('F'.$n, $codcontra2)
					->setCellValue('G'.$n, $nomcontra)			
					->setCellValue('H'.$n, $codarea2)			
					->setCellValue('I'.$n, $nomarea)
					->setCellValue('J'.$n, $codmedico2)
					->setCellValue('K'.$n, $nommedico)
					->setCellValue('L'.$n, $codbodega2)
					->setCellValue('M'.$n, $nombodega)
					->setCellValue('N'.$n, $codprod2)
					->setCellValue('O'.$n, $nombre)
					->setCellValue('P'.$n, $canti2)
					->setCellValue('Q'.$n, $tcos);
					$m++;					
					$p++;			
				}
				$cedula1=$cedula2; 
				$fecha1=$fecha2;
				$codprod1=$codprod2;				
				$registro1=$registro2;
				$codcontra1=$codcontra2;
				$codarea1=$codarea2;
				$tipodoc1=$tipodoc2;
				$codmedico1=$codmedico2;	
				$codbodega1=$codbodega2;		
				$canti1=$canti2;
				$cedula2=$cedula3; 
				$fecha2=$fecha3;
				$codprod2=$codprod3;				
				$registro2=$registro3;
				$codcontra2=$codcontra3;
				$codarea2=$codarea3;
				$tipodoc2=$tipodoc3;
				$codmedico2=$codmedico3;	
				$codbodega2=$codbodega3;		
				$canti2=$canti3;
			}
			$q++;			
		}	
		$objPHPExcel->getActiveSheet()->freezePane('A2');
		$objPHPExcel->getActiveSheet()->getStyle('A1:D1')->getFont()->setBold(true);
		$objPHPExcel->getActiveSheet()->getStyle('A'.$n.':D'.$n)->getFont()->setBold(true);
		$objPHPExcel->getActiveSheet()->setAutoFilter($objPHPExcel->getActiveSheet()->calculateWorksheetDimension());			
		$objPHPExcel->getActiveSheet()->setTitle('MULTIFORMULADOS');
		$ind=$ind+1;
	}	
//$objPHPExcel->setActiveSheetIndex(7);
// Save Excel 2007 file

$callStartTime = microtime(true);
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save(str_replace('.php', '.xlsx', __FILE__));
$callEndTime = microtime(true);
$callTime = $callEndTime - $callStartTime;
header('Location: costo1.xlsx?'.time());





