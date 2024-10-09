<?php
session_start();
    $usucitas=$_SESSION['usucitas'];
foreach($_POST as $nombre_campo => $valor)
{ 
   $asignacion = "\$" . $nombre_campo . "='" . $valor . "';"; 
   eval($asignacion); 
} 
	

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
	
	//192.168.4.20/intraweb/intranet/Historias/censo_clinica.php	
	include("php/conexion2.php");
	//CREAR TABLA
	
	 if($area=='0634')
	{ $area='04';}
	//echo $area;
  
	$_pagi_sql=mysql_query("SELECT e.caac_ing, Max(e.id_ing) AS DCodHis, u.TDOC_USU, u.NROD_USU, e.caac_ing AS camaan, 
	concat(u.Pnom_usu,' ',u.Snom_usu,' ',u.Pape_usu,' ',u.Sape_usu) AS DNom, u.FNAC_USU, uc.ESTA_UCO AS DEst, e.fecin_ing,
	c.NEPS_CON AS DEps, IF ( ht.Horas_tra > -1, ht.Horas_tra, ( SUBSTRING( TIMEDIFF( SYSDATE( ) , 
	CONCAT( DATE( ht.Fecin_tra ) , ' ', ht.Horin_tra ) ) , 1, ( LENGTH( TIMEDIFF( SYSDATE( ) , ht.Fecin_tra ) ) -6 ) ) +0 ) ) AS DHoras, 
	CONCAT( DATE( ht.Fecin_tra ) , ' ', ht.Horin_tra ) AS DInicio, e.codius_ing AS DIdeUsu, u.PNOM_USU, u.SNOM_USU, u.PAPE_USU, u.SAPE_USU,
	ht.ubica_tra
	FROM (((Ingreso_hospitalario AS e INNER JOIN Hist_traza AS ht ON e.id_ing = ht.id_ing) INNER JOIN Usuario AS u ON e.codius_ing = u.CODI_USU) 
	INNER JOIN Ucontrato AS uc ON (e.contra_ing = uc.CONT_UCO) AND (e.codius_ing = uc.CUSU_UCO)) 
	INNER JOIN Contrato AS c ON uc.CONT_UCO = c.CODI_CON
	WHERE (((ht.horas_tra)=-1) AND ((e.caac_ing)<>'RE'))
	GROUP BY e.caac_ing, u.TDOC_USU, u.NROD_USU, e.caac_ing, concat(u.Pnom_usu,' ',u.Snom_usu,' ',u.Pape_usu,' ',u.Sape_usu), u.FNAC_USU, uc.ESTA_UCO, c.NEPS_CON, IF ( ht.Horas_tra > -1, ht.Horas_tra, ( SUBSTRING( TIMEDIFF( SYSDATE( ) , CONCAT( DATE( ht.Fecin_tra ) , ' ', ht.Horin_tra ) ) , 1, ( LENGTH( TIMEDIFF( SYSDATE( ) , ht.Fecin_tra ) ) -6 ) ) +0 ) ), CONCAT( DATE( ht.Fecin_tra ) , ' ', ht.Horin_tra ), e.codius_ing, u.PNOM_USU, u.SNOM_USU, u.PAPE_USU, u.SAPE_USU
	ORDER BY ht.ubica_tra, e.caac_ing, u.PNOM_USU, u.SNOM_USU, u.PAPE_USU, u.SAPE_USU");
	
	$n=0;
	$i=0;
	while($row=mysql_fetch_array($_pagi_sql))
	{
		$camasi='';
		$ubica_tra=$row['ubica_tra']; 
		if($ubica_tra=='04')$ubica_tra='0634';
		$ubicacion='';
		$bubi=mysql_query("SELECT destipos.nomb_des
		FROM destipos
		WHERE (((destipos.codi_des)='$ubica_tra') AND ((destipos.homo2_des)='F') AND ((destipos.codt_des)='06')) AND destipos.codi_des!='0698' AND destipos.codi_des!='0699'");
		while($rubi=mysql_fetch_array($bubi))
		{
			$ubicacion=$rubi['nomb_des'];
		}
		
		if($ubicacion!='')
		{
			$camaactu=$row['camaan'];
			$buscam=mysql_query("select nomb_des from destipos where codi_des='$camaactu'");
			while($fil=mysql_fetch_array($buscam))
			{
				$camasi=$fil['nomb_des'];
			}
			$fechaing=$row['fecin_ing'];
			$horaing=$row['hora_ing'];
			$ingreso=$row['DCodHis'];			
			$bcie=mysql_query("SELECT hist_evo.iden_evo, hist_evo.cod_cie10, cie_10.nom_cie10
			FROM hist_evo INNER JOIN cie_10 ON hist_evo.cod_cie10 = cie_10.cod_cie10
			WHERE (((hist_evo.id_ing)='$ingreso'))
			ORDER BY hist_evo.iden_evo");
			while($rcie=mysql_fetch_array($bcie))
			{
				$codcie=$rcie['cod_cie10'];
				$nomcie=$rcie['nom_cie10'];
			}
			
			//consultar el valor prefacturado a la fecha, se filtra por el número de ingreso 
			$vprefac=null;
			$prefac=mysql_query("SELECT vtot_fac FROM encabezado_factura WHERE id_ing = '$ingreso' ");
			while($valor=mysql_fetch_array($prefac))
			{
				$vprefac=$valor['vtot_fac'];
			}
			if($vprefac==null){$vprefac=0;} //si no hay prefactura coloca el valor en cero
			
			$dia_est=estancia($fechaing,$horaing);
			
			$n++;
			
			if($n==1)
			{
				$objPHPExcel->setActiveSheetIndex(0);
				$objPHPExcel->getActiveSheet()
				->setCellValue('A'.$n, 'SERVICIO')			
				->setCellValue('B'.$n, 'CAMA')
				->setCellValue('C'.$n, 'IDENTIFICACION')
				->setCellValue('D'.$n, 'NOMBRE')
				->setCellValue('E'.$n, 'EDAD')
				->setCellValue('F'.$n, 'CONTRATO')
				->setCellValue('G'.$n, 'INGRESO')
				->setCellValue('H'.$n, 'DIAS ESTANCIA')
				->setCellValue('I'.$n, 'DIAGNOSTICO')
				->setCellValue('J'.$n, 'PREFACTURADO');
			}
			$m=$n+1;
			$objPHPExcel->setActiveSheetIndex(0);
			$objPHPExcel->getActiveSheet()
			->setCellValue('A'.$m, $ubicacion)
			->setCellValue('B'.$m, $camasi)
			->setCellValue('C'.$m, $row['NROD_USU'])
			->setCellValue('D'.$m, $row['DNom'])
			->setCellValue('E'.$m, calculaedad($row['FNAC_USU']))
			->setCellValue('F'.$m, $row['DEps'])
			->setCellValue('G'.$m, $row['DInicio'])
			->setCellValue('H'.$m, $dia_est)
			->setCellValue('I'.$m, $codcie." - ".$nomcie)
			->setCellValue('J'.$m, NUMBER_FORMAT($vprefac,0,",",""));
		}
	}	
	
	$objPHPExcel->getActiveSheet()->freezePane('A2');
	$objPHPExcel->getActiveSheet()->getStyle('A1:H1')->getFont()->setBold(true);
	$objPHPExcel->getActiveSheet()->getStyle('A'.$n.':H'.$n)->getFont()->setBold(true);
	$objPHPExcel->getActiveSheet()->setAutoFilter($objPHPExcel->getActiveSheet()->calculateWorksheetDimension());		
	$objPHPExcel->getActiveSheet()->setTitle('ControlHorarios');
		
	$callStartTime = microtime(true);
	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
	$objWriter->save(str_replace('.php', '.xlsx', __FILE__));
	$callEndTime = microtime(true);
	$callTime = $callEndTime - $callStartTime;
	header('Location: censo_clinica.xlsx?'.time());
	
	
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
	function calculaedad($fecha_)
	{
		$ano_=substr($fecha_,0,4);
		$mes_=substr($fecha_,5,2);
		$dia_=substr($fecha_,8,2);
		if($mes_==2){
		$diasmes_=28;}
		else{
		if($mes_==1 || $mes_==3 || $mes_==5 || $mes_==7 || $mes_==8 || $mes_==10 || $mes_==12){
		  $diasmes_=31;}
		else{
		  $diasmes_=30;}
		}
		$anos_=date("Y")-$ano_;
		$meses_=date("m")-$mes_;
		$dias_=date("d")-$dia_;

		if($dias_<0){
		if($meses_>0){$meses_=$meses_-1;}
		$dias_=$diasmes_+$dias_;
		}
		if($meses_<0){
		$meses_=12+$meses_;
		if(date("d")-$dia_<0){
		  $meses_=$meses_-1;}
		  $anos_=$anos_-1;
		}
		if($meses_==0 & date("d")-$dia_<0 & $anos_>0){
		if(date("m")-$mes_==0 & date("d")-$dia_<0){$anos_=$anos_-1;}
		 $meses_=11;
		}

		if($anos_<>0)
		{
		$edad_=$anos_;
		if($edad_==1){
		  $unidad_=" Año";}
		else{
		  $unidad_=" Años";}
		}
		else
		{
		if($meses_<>0){
		  $edad_=$meses_;
		  if($edad_==1){
			$unidad_=" Mes";}
		  else{
			$unidad_=" Meses";}
		}
		else{
		  $edad_=$dias_;
		  if($edad_==1){
			$unidad_=" Día";}
		  else{
			$unidad_=" Días";}
		}
		}
		return($edad_.$unidad_);
}
	
	
	
	?>

</form>		
</body>
</HTML>

