<?
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
	$archivo="tmp/ListaCitados.txt";	
	

    
    $dateh=date("Y-m-d");	
    $anoini=substr($dateh,0,4);
    $mesini=substr($dateh,5,2);
    $diaini=substr($dateh,8,2);
    $dateini = gmmktime ( 00, 00, 00, $mesini, $diaini, $anoini);	
    $diaprog=$dateini+86400;
    $fechasig=gmdate ( "Y-m-d", $diaprog);
    if(empty($fechaini))$fechaini=$fechasig;
    if(empty($fechafin))$fechafin=$fechasig;  
    include ('php/conexion1.php');
    $busgru=mysql_query("SELECT * FROM grupos Order By nomb_gru");	//grupos
    
	$fecha=date("Y-m-d");
    $hora=date("H:i:s");
	
	
	if($codarea!='')$cad=" and horarios.Cserv_horario='$codarea'";
	$cadmed=mysql_query("SELECT medicos.cod_medi, medicos.espe_med, medicos.pnom_medi, medicos.pape_medi, medicos.nom_medi, 
	horarios.Cserv_horario, areas.equi_area, usuario.TRES_USU, usuario.TEL2_USU, usuario.TDOC_USU, usuario.NROD_USU, 
	usuario.PNOM_USU, usuario.SNOM_USU, usuario.PAPE_USU, usuario.SAPE_USU, citas.Cotra_citas, contrato.NEPS_CON, horarios.Fecha_horario, 
	horarios.Hora_horario, citas.Tusua_citas, ucontrato.ESTA_UCO, usuario.DCOT_USU, usuario.CODI_USU
	FROM contrato INNER JOIN (((usuario INNER JOIN ((citas INNER JOIN horarios ON citas.ID_horario = horarios.ID_horario) 
	INNER JOIN medicos ON horarios.Cmed_horario = medicos.cod_medi) ON usuario.CODI_USU = citas.Idusu_citas) 
	INNER JOIN ucontrato ON (citas.Cotra_citas = ucontrato.CONT_UCO) AND (usuario.CODI_USU = ucontrato.CUSU_UCO)) 
	INNER JOIN areas ON horarios.Cserv_horario = areas.cod_areas) ON contrato.CODI_CON = ucontrato.CONT_UCO
	WHERE horarios.Fecha_horario>='$fechaini' And horarios.Fecha_horario<='$fechafin' AND citas.Clase_citas<'6' and areas.arci_area='$areatra' $cad
	ORDER BY areas.nom_areas, medicos.nom_medi, horarios.Fecha_horario, horarios.Hora_horario");
	$codusuario='';
	$n=0;
	
	while($rcm=mysql_fetch_array($cadmed))
	{           
		$codmedico=$rcm['cod_medi']; 
		$nommedico=$rcm['nom_medi'];
		$codarea=$rcm['Cserv_horario'];
		$equi_area=$rcm['equi_area'];
		$nombreusu=$rcm['PNOM_USU'].' '.$rcm['PAPE_USU'];
		$tipdoc=$rcm['TDOC_USU'];
		$cedusu=$rcm['NROD_USU'];
		
		$nombarea='';
		$nare=mysql_query("SELECT nom_areas FROM areas WHERE cod_areas='$equi_area'");
		$rare=mysql_fetch_array($nare);
		$nombarea=$rare['nom_areas'];
		
		$codcontrato=$rcm['Cotra_citas'];
		$nomcontrato=$rcm['NEPS_CON'];
		$fechacita=$rcm['Fecha_horario'];
		$doccoti=$rcm['DCOT_USU'];
		$horacita=$rcm['Hora_horario'];
		$tel1=trim($rcm['TRES_USU']);
		$tel2=trim($rcm['TEL2_USU']);
		$nombmedi=$rcm['pnom_medi'].' '.$rcm['pape_medi'];
		
		$espe=$rcm['espe_med'];
		$codi_usu=$rcm['CODI_USU'];
		
		if($codi_usu != $codusuario)
		{
			$n++;
			$ano=substr($fechacita,0,4);
			$mes=substr($fechacita,5,2);
			$dia=substr($fechacita,8,2);
			if($mes=='01')$dmes="ENE";
			if($mes=='02')$dmes="FEB";
			if($mes=='03')$dmes="MAR";
			if($mes=='04')$dmes="ABR";
			if($mes=='05')$dmes="MAY";
			if($mes=='06')$dmes="JUN";
			if($mes=='07')$dmes="JUL";
			if($mes=='08')$dmes="AGO";
			if($mes=='09')$dmes="SEP";
			if($mes=='10')$dmes="OCT";
			if($mes=='11')$dmes="NOV";
			if($mes=='12')$dmes="DIC";
			
			$hora=substr($horacita,11,2);
			$minu=substr($horacita,14,2);
			
			if($hora<12)$ampm="AM";
			if($hora>=12)$ampm="PM";
			$fec=$dia.'-'.$dmes.'-'.$ano;
			if($hora>12)$hora=$hora-12;
			
			$lar1=strlen($tel1);
			$lar2=strlen($tel2);
			if($lar1<10 && $lar2==10)
			{
				$telaux=$tel1;
				$tel1=$tel2;
				$tel2=$telaux;						           
			}
			
			if($lar1==10 && $lar2==10)
			{
				if($tel1 !=$tel2)
				{						
					$dup=2;
				}
				else
				{
					$dup=1;
					$tel2='';
				}
			}
			else $dup=1;
							
			for($i=0;$i<$dup;$i++)
			{
				$dupli='';
				if($i==0 && $dup==2)
				{
					$dupli='DUPLICADO A';
					$telaux=$tel2;
					$tel2='';
				}
				if($i==1 && $dup==2)
				{
					$tel1=$telaux;
					$tel2='';
					$dupli='DUPLICADO B';							
				}
				
				$campo='';
				$nomusu=sanear_string($nombreusu);
				//$nomusu=$nombreusu;
				//compruebo que los caracteres sean los permitidos 
				$permitidos = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ "; 
				for ($i=0; $i<strlen($nomusu); $i++)
				{ 
					if (strpos($permitidos, substr($nomusu,$i,1))===false)
					{ 
						$linea=$n;
						$campo=$campo.' '."NOMBRE USUARIO; ";  
						
					} 
				} 
				
				$nommedi=sanear_string($nombmedi);
				//$nommedi=$nombmedi;
				$permitidos = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ "; 
				for ($i=0; $i<strlen($nommedi); $i++)
				{ 
					if (strpos($permitidos, substr($nommedi,$i,1))===false)
					{ 
						$linea=$n;
						$campo=$campo.' '."NOMBRE MEDICO; ";  
						
					} 
				}
				
				$nomarea=sanear_string($nombarea);	
				//$nomarea=$nombarea;
				$permitidos = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ "; 
				for ($i=0; $i<strlen($nomarea); $i++)
				{ 
					if (strpos($permitidos, substr($nomarea,$i,1))===false)
					{ 
						$linea=$n;
						$campo=$campo.' '."AREA; "; 
						
					} 
				}				

				
				
				if($espe=='2656')$mensaje="SR@ ".$nomusu." PROINSALUD SA LE RECUERDA QUE EL ".$fec." A LAS ".$hora.":".$minu." ".$ampm." TIENE CITA CON ENFERMERIA DE ".$nomarea;
				else $mensaje="SR@ ".$nomusu." PROINSALUD SA LE RECUERDA QUE EL ".$fec." A LAS ".$hora.":".$minu." ".$ampm." TIENE CITA CON EL DR@ ".$nommedi." DE ".$nomarea;
				
				$largo=strlen($mensaje);
				
				if($n==1)
				{
					$objPHPExcel->setActiveSheetIndex(0);
					$objPHPExcel->getActiveSheet()				
					->setCellValue('A'.$n, 'NRO.')
					->setCellValue('B'.$n, 'DOCUMENTO')
					->setCellValue('C'.$n, 'NOMBRE')
					->setCellValue('D'.$n, 'TELEFONO1')
					->setCellValue('E'.$n, 'TELEFONO2')
					->setCellValue('F'.$n, 'DUPLICADO')
					->setCellValue('G'.$n, 'FECHA')
					->setCellValue('H'.$n, 'HORA')
					->setCellValue('I'.$n, 'MEDICO')
					->setCellValue('J'.$n, 'MENSAJE')
					->setCellValue('K'.$n, 'CARACTERES');
				}
				$m=$n+1;
				$objPHPExcel->setActiveSheetIndex(0);
				$objPHPExcel->getActiveSheet()
				->setCellValue('A'.$m, $n)
				->setCellValue('B'.$m, $cedusu)
				->setCellValue('C'.$m, $nomusu)
				->setCellValue('D'.$m, $tel1)
				->setCellValue('E'.$m, $tel2)
				->setCellValue('F'.$m, $dupli)
				->setCellValue('G'.$m, $fechacita)
				->setCellValue('H'.$m, $horacita)
				->setCellValue('I'.$m, $nommedico)
				->setCellValue('J'.$m, $mensaje)
				->setCellValue('K'.$m, $largo);
				
				
			}
		}
		$codusuario=$codi_usu;				
	}
	
		
	$objPHPExcel->getActiveSheet()->freezePane('A2');
	$objPHPExcel->getActiveSheet()->getStyle('A1:H1')->getFont()->setBold(true);
	$objPHPExcel->getActiveSheet()->getStyle('A'.$n.':H'.$n)->getFont()->setBold(true);
	$objPHPExcel->getActiveSheet()->setAutoFilter($objPHPExcel->getActiveSheet()->calculateWorksheetDimension());		
	$objPHPExcel->getActiveSheet()->setTitle('ListaCitados');
	
	
	
	$callStartTime = microtime(true);
	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
	$objWriter->save(str_replace('.php', '.xlsx', __FILE__));
	$callEndTime = microtime(true);
	$callTime = $callEndTime - $callStartTime;
	header('Location: demanda_excel.xlsx?'.time());
	
	
    
	
function sanear_string($string)
{
 
    $string = trim($string);
 
    $string = str_replace(
        array('á', 'à', 'ä', 'â', 'ª', 'Á', 'À', 'Â', 'Ä', 'Ã'),
        array('a', 'a', 'a', 'a', 'a', 'A', 'A', 'A', 'A', 'A'),
        $string
    );
 
    $string = str_replace(
        array('é', 'è', 'ë', 'ê', 'É', 'È', 'Ê', 'Ë'),
        array('e', 'e', 'e', 'e', 'E', 'E', 'E', 'E'),
        $string
    );
 
    $string = str_replace(
        array('í', 'ì', 'ï', 'î', 'Í', 'Ì', 'Ï', 'Î'),
        array('i', 'i', 'i', 'i', 'I', 'I', 'I', 'I'),
        $string
    );
 
    $string = str_replace(
        array('ó', 'ò', 'ö', 'ô', 'Ó', 'Ò', 'Ö', 'Ô'),
        array('o', 'o', 'o', 'o', 'O', 'O', 'O', 'O'),
        $string
    );
 
 
 
 
    $string = str_replace(
        array('ú', 'ù', 'ü', 'û', 'Ú', 'Ù', 'Û', 'Ü'),
        array('u', 'u', 'u', 'u', 'U', 'U', 'U', 'U'),
        $string
    );
 
    $string = str_replace(
        array('ñ', 'Ñ', 'ç', 'Ç', 'Ã‘', 'A‘'  ),
        array('n', 'N', 'c', 'C', 'N', 'N'),
        $string
    );
 
    //Esta parte se encarga de eliminar cualquier caracter extraño
    $string = str_replace(
        array(chr(92), "¨", "º", "-", "~",
             "#", "@", "|", "!", chr(34),
             "·", chr(36), chr(37), chr(38), "/",
             "(", ")", "?", "'", "¡",
             "¿", "[", "^", "<code>", "]",
             "+", "}", "{", "¨", "´",
             ">", "< ", ";", ",", ":",
             "."),
        '',
        $string
    );
    return $string;
}
?>
