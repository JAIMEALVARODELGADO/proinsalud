<?    	
	
	require('fpdf.php');
	$pdf=new FPDF('P','mm','A4');
	$pdf->SetMargins(10, 0 , 10);
	$pdf->SetAutoPageBreak(true,1); 
	//$numtriage='209309';
	include ('php/conexion1.php');
	$bdat=mysql_query("SELECT triage_urgencias.peso_tri, triage_urgencias.talla_tri, triage_urgencias.gluco_tri, triage_urgencias.pulso_tri, triage_urgencias.fcf_tri, usuario.NROD_USU, usuario.TRES_USU, usuario.MATE_USU, usuario.SEXO_USU, usuario.TDOC_USU, medicos.cod_medi, usuario.FNAC_USU, usuario.PNOM_USU, usuario.SNOM_USU, usuario.PAPE_USU, citas.Cotra_citas, usuario.SAPE_USU, triage_urgencias.iden_tri, triage_urgencias.iden_cita, triage_urgencias.tear1_tri, triage_urgencias.tear2_tri, triage_urgencias.frre_tri, triage_urgencias.frca_tri, triage_urgencias.temp_tri, triage_urgencias.clas_tri, triage_urgencias.clas2_tri, triage_urgencias.usua_tri, triage_urgencias.usua2_tri, triage_urgencias.fech_tri, triage_urgencias.hora_tri, triage_urgencias.moco_tri, triage_urgencias.mell_tri, triage_urgencias.esco_tri, triage_urgencias.dest_tri, triage_urgencias.obse_tri, triage_urgencias.mrsk_tri,medicos.nom_medi, medicos.ced_medi, medicos.reg_medi, citas.Esta_cita, triage_urgencias.dolr_tri
	FROM ((triage_urgencias INNER JOIN citas ON triage_urgencias.iden_cita = citas.id_cita) INNER JOIN usuario ON citas.Idusu_citas = usuario.CODI_USU) INNER JOIN medicos ON triage_urgencias.usua2_tri = medicos.cod_medi
	WHERE (((triage_urgencias.iden_tri)='$numtriage'))");
	$n=0;
	while($rdat = mysql_fetch_array($bdat))
	{		
		$esta_cita=$rdat['Esta_cita'];
		$tipodoc=$rdat['TDOC_USU'];
		$sexo=$rdat['SEXO_USU'];
		$muniate=$rdat['MATE_USU'];
		$telefono=$rdat['TRES_USU'];
		$fecha_nac=$rdat['FNAC_USU'];			
		$cedula=$rdat['NROD_USU'];	//Cedula paciente
		$nombre=$rdat['PNOM_USU'].' '.$rdat['SNOM_USU'].' '.$rdat['PAPE_USU'].' '.$rdat['SAPE_USU'];	//nombre paciente
		$contra=$rdat['Cotra_citas'];	//contrato del paciente
		$nommedico=$rdat['nom_medi'];
		$regmedico=$rdat['reg_medi'];
		$cedmedico=$rdat['ced_medi'];
		$codimedico=$rdat['cod_medi'];		
		$iden_tri=$rdat['iden_tri'];	//identificador de tabla triage_urgencias
		$iden_cita=$rdat['iden_cita'];	//identificador tabla citas
		$tear1_tri=$rdat['tear1_tri'];	//tension arterial
		$tear2_tri=$rdat['tear2_tri'];	//tension arterial
		$frecurespi=$rdat['frre_tri'];	//frecuencia respiratoria
		$frecucardi=$rdat['frca_tri'];	//frecuencia cardiaca
		$tempera=$rdat['temp_tri'];	//temperatura
		$clas_tri=$rdat['clas_tri'];	//clasificacion primaria	*	
		//$clasifica=$rdat['clas2_tri'];	//clasificacion triage 		*
		$clasifica=$rdat['mrsk_tri'];	//clasificacion triage 		*
		
		$usua_tri=$rdat['usua_tri'];	//funcionario clasificacion primaria	
		$usua2_tri=$rdat['usua2_tri'];	//funcionario clasificacion triage
		$fecha=$rdat['fech_tri'];	//fecha triage
		$hora=$rdat['hora_tri'];	//hora perfecto
		$motivocon=$rdat['moco_tri'];	//motivo de consulta
		$mediollegada=$rdat['mell_tri'];	//medio de llegada		*
		$estadoconcien=$rdat['esco_tri'];	//estado de conciencia	
		$dest_tri=$rdat['dest_tri'];	//destino de salida		*
		$observa=$rdat['obse_tri'];	//observaciones		
		$peso=$rdat['peso_tri'];
		$talla=$rdat['talla_tri'];
		$gluco=$rdat['gluco_tri'];
		$pulso=$rdat['pulso_tri'];
		$fcf=$rdat['fcf_tri'];
		$dolor=$rdat['dolr_tri'];
		
		$bdol=mysql_query("select * from destipos where  codi_des='$dolor'");
		while($rdol=mysql_fetch_array($bdol))
		{
			$dolortri=$rdol['nomb_des'];
		}
		$anos=edad($fecha_nac,$fecha);
		$buscon=mysql_query("select * from contrato where CODI_CON='$contra'");
		while($rcon=mysql_fetch_array($buscon))
		{
			$contrato=$rcon['NEPS_CON'];
		}		
		//$pacienause=$rdat['paus_tri']; //paciente ausente
	}
	$fila=21;
	$pdf->AddPage();
	$pdf->SetFont('Arial','',8);
	$pdf->SetXY(95,$fila);
	$pdf->Cell(6,5,$tipodoc.':',0);
	$pdf->SetXY(102,$fila);
	$pdf->Cell(20,5,$cedula,0);		
	$pdf->SetXY(5,$fila);
	$pdf->Cell(40,5,"Nombre:",0);
	$pdf->SetXY(20,$fila);
	$pdf->Cell(40,5,$nombre,0);		
	$pdf->SetXY(125,$fila);
	$pdf->Cell(34,5,"Genero:",0);
	$pdf->SetXY(137,$fila);
	$pdf->Cell(14,5,$sexo,0);		
	$pdf->SetXY(145,$fila);
	$pdf->Cell(20,5,"Edad:",0);
	$pdf->SetXY(155,$fila);
	$pdf->Cell(20,5,$anos,0);
	$pdf->SetXY(175,$fila);
	$pdf->Cell(20,5,"Teléfono:",0);
	$pdf->SetXY(190,$fila);
	$pdf->Cell(20,5,$telefono,0);		
	$fila=$fila+5;
	$pdf->SetXY(5,$fila);
	$pdf->Cell(20,5,"Contrato:",0);
	$pdf->SetXY(20,$fila);
	$pdf->Cell(20,5,$contrato,0);		
	$pdf->SetXY(95,$fila);
	$pdf->Cell(40,5,"M. atención:",0);
	$pdf->SetXY(112,$fila);
	$pdf->Cell(40,5,$muniate,0);		
	$pdf->SetXY(145,$fila);
	$pdf->Cell(20,5,"M. servicio:",0);
	$pdf->SetXY(163,$fila);
	$pdf->Cell(20,5,'PASTO',0);	
	$fila=$fila+7;
	$col=200;
	$pdf->SetFillColor($col);	
	$pdf->rect(5,$fila,205,5,F);	
	$pdf->SetXY(5,$fila);
	$pdf->Cell(40,5,"Consecutivo No.  ".$numtriage,0);
	$pdf->SetXY(80,$fila);
	$pdf->Cell(40,5,"Servicio: URGENCIAS",0);
	$pdf->SetXY(150,$fila);
	$pdf->Cell(40,5,"Fecha: ".$fecha,0);
	$pdf->SetXY(187,$fila);
	$pdf->Cell(40,5,"Hora: ".$hora,0);
	$fila=$fila+8;	
	
	$bman=mysql_query("SELECT destipos.nomb_des, destipos.codi_des, sintomas_covid.valor_sintoma
	FROM sintomas_covid LEFT JOIN destipos ON sintomas_covid.cod_sintoma = destipos.codi_des
	WHERE sintomas_covid.num_triaje = '$numtriage' AND tipo_historia='T' AND cod_sintoma='E001'");
	while($rman=mysql_fetch_array($bman))
	{
		$val_sintoma=$rman['valor_sintoma'];
		$nom_sintoma=$rman['nomb_des'];
		if($val_sintoma=='S')
		{
			$pdf->SetXY(5,$fila);
			$pdf->SetFont('Arial','',8);
			$pdf->MultiCell(190,5,$nom_sintoma,0,J,0);
			$fila=$pdf->GetY();					
			$fila=$fila+5;
		}
	}
	
	$bman=mysql_query("SELECT destipos.nomb_des, destipos.codi_des, sintomas_covid.valor_sintoma
	FROM sintomas_covid LEFT JOIN destipos ON sintomas_covid.cod_sintoma = destipos.codi_des
	WHERE sintomas_covid.num_triaje = '$numtriage' AND tipo_historia='T' AND cod_sintoma='E002'");
	while($rman=mysql_fetch_array($bman))
	{
		$val_sintoma=$rman['valor_sintoma'];
		$nom_sintoma=$rman['nomb_des'];
		if($val_sintoma=='S')
		{
			$pdf->SetXY(5,$fila);
			$pdf->SetFont('Arial','',8);
			$pdf->MultiCell(190,5,$nom_sintoma,0,J,0);
			$fila=$pdf->GetY();					
			$fila=$fila+5;
		}
	}
	
	$bcovid=mysql_query("SELECT destipos.nomb_des, destipos.codi_des, sintomas_covid.valor_sintoma
	FROM sintomas_covid LEFT JOIN destipos ON sintomas_covid.cod_sintoma = destipos.codi_des
	WHERE sintomas_covid.num_triaje = '$numtriage' AND tipo_historia='T' ORDER BY `codi_des` ASC");
	if(mysql_fetch_array($bcovid)>0)
	{
		$n=0;
		$m=0;
		while($rcovid=mysql_fetch_array($bcovid))	
		{
			$codsin=$rcovid['codi_des'];
			$nomsin=$rcovid['nomb_des'];
			$valsin=$rcovid['valor_sintoma'];
			if($codsin != 'E001' && $codsin != 'E002')
			{
				if($m==0)
				{
					$pdf->SetXY(5,$fila);					
					$pdf->SetXY(5,$fila);
					$pdf->SetFont('Arial','B',8);
					$pdf->Cell(20,4,'Sintomas COVID-19:',0,0,L);
					$fila=$fila+5;
					$pdf->SetXY(30,$fila);		
				}				
				
				if($n % 4==0)
				{
					$fila=$fila+5;
					$pdf->SetXY(30,$fila);
					$n=0;
				}
				if($valsin=='N')$val='NO';
				if($valsin=='S')$val='SI';
				$pdf->Cell(40,5,$nomsin.': '.$val,1,0,C);
				$n++;
				$m++;
			}
		}
	}

	
	
	$fila=$fila+8;
	$pdf->SetXY(5,$fila);
	$pdf->SetFont('Arial','B',8);
	$pdf->Cell(1,5,"MOTIVO DE CONSULTA: ",0,0,c);
	$ver=$fila+5;
	$pdf->SetXY(5,$ver);	
	$pdf->SetFont('Arial','',8);
	$pdf->MultiCell(190,5,$motivocon,0,J,0);
	$ver=$pdf->GetY();
	$ver=$ver+2;
	if($mediollegada==1)$melle='Caminando';
	if($mediollegada==2)$melle='En ambulancia';
	if($mediollegada==3)$melle='Llegada vehículo';
	if($mediollegada==4)$melle='Vehículo policía';
	if($mediollegada==5)$melle='Otro';
	$pdf->SetXY(5,$ver);
	$pdf->SetFont('Arial','B',8);	
	$pdf->Cell(30,5,"MEDIO DE LLEGADA: ",0,0,c);
	$pdf->SetFont('Arial','',8);	
	$pdf->Cell(45,5,$melle,0,0,c);
	//$pdf->Line(33, $ver+4, 75, $ver+4);
	$ver=$ver+7;
	$pdf->SetXY(5,$ver);	
	$pdf->SetFont('Arial','B',8);	
	$pdf->Cell(30,5,"EXAMEN FISICO: ",0,0,c);
	$pdf->SetFillColor($col);	
	$ver=$ver+5;
	$pdf->rect(75,$ver,60,4,F);
	$pdf->SetFont('Arial','B',8);
	$pdf->SetXY(75,$ver);
	$pdf->Cell(40,4,"SIGNO",1,0,c);
	$pdf->Cell(20,4,"VALOR",1,0,C);
	$ver=$ver+4;
	$pdf->SetFont('Arial','',8);
	$pdf->SetXY(75,$ver);
	$pdf->Cell(40,4,"Peso",1,0,c);
	$pdf->Cell(20,4,$peso,1,0,C);
	$ver=$ver+4;
	$pdf->SetFont('Arial','',8);
	$pdf->SetXY(75,$ver);	
	$pdf->Cell(40,4,"Talla",1,0,c);
	$pdf->Cell(20,4,$talla,1,0,C);
	
	if($talla>0)
	{
		if($talla>3)$tal=$talla/100;
		$imc=$peso/($tal*$tal);
		$imc=number_format ($imc , 2 , "." , "," );
		
	}
	$ver=$ver+4;
	$pdf->SetFont('Arial','',8);
	$pdf->SetXY(75,$ver);	
	$pdf->Cell(40,4,"IMC",1,0,c);
	$pdf->Cell(20,4,$imc,1,0,C);
	
	$ver=$ver+4;
	$pdf->SetFont('Arial','',8);
	$pdf->SetXY(75,$ver);
	$pdf->Cell(40,4,"Tensión Arterial",1,0,c);
	$pdf->Cell(20,4,$tear1_tri.' - '.$tear2_tri,1,0,C);
	$ver=$ver+4;
	$pdf->SetFont('Arial','',8);
	$pdf->SetXY(75,$ver);
	$pdf->Cell(40,4,"Frecuencia cardiaca",1,0,c);
	$pdf->Cell(20,4,$frecucardi,1,0,C);
	$ver=$ver+4;
	$pdf->SetFont('Arial','',8);
	$pdf->SetXY(75,$ver);
	$pdf->Cell(40,4,"Frecuencia respiratoria",1,0,c);
	$pdf->Cell(20,4,$frecurespi,1,0,C);
	$ver=$ver+4;
	$pdf->SetFont('Arial','',8);
	$pdf->SetXY(75,$ver);
	$pdf->Cell(40,4,"Temperatura",1,0,c);
	$pdf->Cell(20,4,$tempera,1,0,C);
	$ver=$ver+4;
	$pdf->SetFont('Arial','',8);
	$pdf->SetXY(75,$ver);
	$pdf->Cell(40,4,"Pulsosimetría",1,0,c);
	$pdf->Cell(20,4,$pulso,1,0,C);
	$ver=$ver+4;
	$pdf->SetFont('Arial','',8);
	$pdf->SetXY(75,$ver);
	$pdf->Cell(40,4,"Glucometría",1,0,c);
	$pdf->Cell(20,4,$gluco,1,0,C);
	$ver=$ver+4;
	$pdf->SetFont('Arial','',8);
	$pdf->SetXY(75,$ver);
	$pdf->Cell(40,4,"Frecuencia cardiaca fetal",1,0,c);
	$pdf->Cell(20,4,$fcf,1,0,C);
	/*if($clasifica==1)$clas="  (ROJO)";
	if($clasifica==2)$clas="  (AMARILLO)";
	if($clasifica==3)$clas="  (VERDE)";
	if($clasifica==4)$clas="  (CONSULTA PRIORITARIA)";*/
	$conultatriage="SELECT homo_esp FROM destipos WHERE codi_des='$clasifica'";
	//echo $conultatriage;
	$conultatriage=mysql_query($conultatriage);
	if(mysql_num_rows($conultatriage)<>0){
		$rowtriage=mysql_fetch_array($conultatriage);
		$clas=$rowtriage[homo_esp];
	}
	$ver=$ver+7;
	$pdf->SetXY(5,$ver);
	$pdf->SetFont('Arial','B',8);	
	$pdf->Cell(30,5,"ESCALA DE DOLOR: ",0,0,c);
	$pdf->SetFont('Arial','',8);	
	$pdf->Cell(45,5,$dolortri,0,0,c);
	
	
	
	$ver=$ver+10;
	$pdf->SetFillColor($col);	
	$pdf->rect(5,$ver,205,5,F);
	$pdf->SetXY(5,$ver);	
	$pdf->SetFont('Arial','B',9);	
	//$pdf->Cell(205,5,"CLASIFICACION TRIAGE:    ".$clasifica.$clas,0,0,C);
	$pdf->Cell(205,5,"CLASIFICACION TRIAGE:    ".$clas,0,0,C);
	$ver=$ver+7;
	$pdf->SetXY(5,$ver);	
	$pdf->SetFont('Arial','B',8);	
	$pdf->Cell(31,5,"Observaciones",0,0,c);
	$ver=$ver+5;
	$pdf->SetXY(5,$ver);	
	$pdf->SetFont('Arial','',8);	
	$pdf->MultiCell(190,5,$observa,0,J,0);		
	$ver=$pdf->GetY();	
	$pdf->SetFont('Arial','',8);	
	$firma="../firmas/".$codimedico.".jpg";
	if(file_exists($firma))
	{
		$pdf->Image($firma,5,$ver+10,50,15,'','');
	}		
	$pdf->Line(5,$ver+25,$hor+52,$ver+25);        
	$pdf->Text(5, $ver+28,$nommedico);
	$pdf->Text(5, $ver+31,'Cédula y Registro Médico');
	$pdf->Text(5, $ver+34,$cedmedico.'   '.$regmedico); 	
	$pdf->Image('img\enca_triage.JPG',0,0,210,0,'','');
	$pdf->Image('img\controlado.png',265,100,7,30,'','');
	$pdf->Image('img\pie_triage.JPG',0,270,210,0,'','');
	$pdf->Output();	
	function edad($fechanac, $fechatri)
    {
        $ano_=substr($fechanac,0,4);
		$mes_=substr($fechanac,5,2);
		$dia_=substr($fechanac,8,2);
		if($mes_==2)
		{
			$diasmes_=28;
		}
		else
		{
			if($mes_==1 || $mes_==3 || $mes_==5 || $mes_==7 || $mes_==8 || $mes_==10 || $mes_==12){
			$diasmes_=31;}
			else{$diasmes_=30;}
		}		
		$anos_=substr($fechatri,0,4)-$ano_;
		$meses_=substr($fechatri,5,2)-$mes_;
		$dias_=substr($fechatri,8,2)-$dia_;    
		if($dias_<0)
		{
			if($meses_>0){$meses_=$meses_-1;}
			$dias_=$diasmes_+$dias_;
		}
		if($meses_<0)
		{
			$meses_=12+$meses_;
			if(substr($fechatri,8,2)-$dia_<0){
			$meses_=$meses_-1;}
			$anos_=$anos_-1;
		}
		if($meses_==0 & substr($fechatri,8,2)-$dia_<0 & $anos_>0)
		{
			if(substr($fechatri,5,2)-$mes_==0 & substr($fechatri,8,2)-$dia_<0){$anos_=$anos_-1;}
			 $meses_=11;
		}
		if($anos_<>0)
		{
			$edad_=$anos_;
			if($edad_==1)
			{
				$unidad_=" Año";
			}
			else
			{
				$unidad_=" Años";
			}
		}
		else
		{
			if($meses_<>0)
			{
				$edad_=$meses_;
				if($edad_==1)
				{
					$unidad_=" Mes";
				}
				else
				{
					$unidad_=" Meses";
				}
			}
			else
			{
				$edad_=$dias_;
				if($edad_==1)
				{
					$unidad_=" Día";
				}
				else
				{
					$unidad_=" Días";
				}
			}
		}
		return($edad_.$unidad_);  
    }
	function estancia($fechaing,$horaing)
    {
        //Esta funcion toma una fecha de nacimiento
        //desde una base de datos mysql
        //en formato aaaa/mm/dd y calcula la edad en números enteros
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

