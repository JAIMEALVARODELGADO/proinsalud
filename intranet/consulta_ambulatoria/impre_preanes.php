<?php
//Quitar esto------------
    /*require('fpdf.php');
    $pdf=new FPDF('P','mm','Letter');
    $pdf->AddPage();
    $pdf->SetFont('Arial','',8);
    include ('php/conexion.php');
    base_proinsalud();
    $fila=5;
    $pdf->SetXY(5,$fila);*/
//Hasta aqui------------
		
		
		
		
		
		$fila=$fila+$h;		
		$consultaef="select * from preanes_examenfisico where numero_cons='$numhisto'";
        $consultaef=mysql_query($consultaef);
		$rowexaf=mysql_fetch_array($consultaef);	
                        
		$fila=$pdf->GetY();
		$fila=$fila+$h+4;
		$pdf->SetXY(100,$fila);
		$pdf->SetFillColor($col);	
		$pdf->rect(5,$fila,205,4,F);
		$pdf->Cell(20,4,'EXAMEN FISICO',0,0,L);
		
		$fila=$fila+$h+4;
		$pdf->SetXY(5,$fila);
		$pdf->Cell(40,4,'Peso: '.$rowexaf[peso_exf],0,0,L);
		$pdf->Cell(40,4,'Talla: '.$rowexaf[talla_exf],0,0,L);
		$pdf->Cell(40,4,'Temperatura: '.$rowexaf[tempera_exf],0,0,L);
		$pdf->Cell(40,4,'IMC: '.$imc,0,0,L);

		$fila=$fila+$h+4;
		$pdf->SetXY(5,$fila);
		$pdf->Cell(40,4,'Saturacion de O2: '.$rowexaf[saturo2_exf],0,0,L);
		$pdf->Cell(40,4,'Presion Arterial: '.$rowexaf[presion_exf],0,0,L);
		$pdf->Cell(40,4,'Frecuencia Cardiaca: '.$rowexaf[frecard_exf],0,0,L);
		$pdf->Cell(40,4,'Frecuencia Respiratoria: '.$rowexaf[freresp_exf],0,0,L);
				
		$fila=$fila+$h+4;
		$pdf->SetXY(5,$fila);
		$pdf->Cell(200,4,'Estado General: '.$rowexaf[estado_exf],0,0,L);
				
		$fila=$fila+$h+4;
		$pdf->SetXY(5,$fila);
		$pdf->MultiCell(200,4,'Sistema Nervioso Central: '.$rowexaf[snc_exf],0,J);

		switch ($rowexaf[dentpro_exf]){
			case 'SU':
				$dentpro_='SUPERIOR';
				break;
			case 'IN':
				$dentpro_='INFERIOR';
				break;
			case 'FI':
				$dentpro_='FIJA';
				break;
			case 'MO':
				$dentpro_='MOVIL';
				break;
			case 'PA':
				$dentpro_='PARCIAL';
				break;
			case 'TO':
				$dentpro_='TOTAL';
				break;
		}
		//$fila=$fila+$h+4;
		$fila=$pdf->GetY()+$h;
		$pdf->SetXY(5,$fila);
		$pdf->Cell(40,4,'Dentadura: '.$dentpro_,0,0,L);
		$pdf->Cell(40,4,'Apertura Bucal: '.$rowexaf[apertur_exf].' Cm',0,0,L);
		$pdf->Cell(80,4,'Estado de los Dientes: '.$rowexaf[estadodien_exf],0,0,L);

		$fila=$fila+$h+4;
		$pdf->SetXY(5,$fila);
		$pdf->Cell(40,4,'I.Mallampati: '.$rowexaf[imallam_exf],0,0,L);
		$pdf->Cell(40,4,'Distancia Mentohioidea: '.$rowexaf[dmentoh_exf].' Cm',0,0,L);
		switch ($rowexaf[movilid_exf]){
			case 'N':
				$movilid_='Normal';
				break;
			case 'D':
				$movilid_='Disminuida';
				break;
		}
		$pdf->Cell(80,4,'Movilidad Cervical: '.$movilid_,0,0,L);
		
		$fila=$fila+$h+4;
		$pdf->SetXY(5,$fila);
		$pdf->MultiCell(200,4,'Anormalidades del Cuello/Maxilar: '.$rowexaf[anormali_exf],0,J);
		
		$fila=$pdf->GetY()+$h;
		$pdf->SetXY(5,$fila);
		$pdf->MultiCell(200,4,'Torax: '.$rowexaf[torax_exf],0,J);

		$fila=$pdf->GetY()+$h;
		$pdf->SetXY(5,$fila);
		$pdf->MultiCell(200,4,'Pulmones: '.$rowexaf[pulmones_exf],0,J);
		
		$fila=$pdf->GetY()+$h;
		$pdf->SetXY(5,$fila);
		$pdf->MultiCell(200,4,'Corazon: '.$rowexaf[corazon_exf],0,J);
		
		$fila=$pdf->GetY()+$h;
		$pdf->SetXY(5,$fila);
		$pdf->MultiCell(200,4,'Abdomen: '.$rowexaf[abdomen_exf],0,J);
		
		$fila=$pdf->GetY()+$h;
		$pdf->SetXY(5,$fila);
		$pdf->MultiCell(200,4,'Genitourinario: '.$rowexaf[genitouri_exf],0,J);
		
		$fila=$pdf->GetY()+$h;
		$pdf->SetXY(5,$fila);
		$pdf->MultiCell(200,4,'Extremidades: '.$rowexaf[extremi_exf],0,J);
		
		$fila=$pdf->GetY()+$h;
		$pdf->SetXY(5,$fila);
		$pdf->MultiCell(200,4,'Otros: '.$rowexaf[genitouri_exf],0,J);
		
		
		$fila=$fila+$h;		
		$consultaef="select * from preanes_examencomple where numero_cons='$numhisto'";
		$consultaef=mysql_query($consultaef);
		$rowexaf=mysql_fetch_array($consultaef);	
		

		
		
		
		$pdf->AddPage();
		
		
		

		
		$fila=$pdf->GetY();
		$fila=$fila+$h+4;
		$pdf->SetXY(100,$fila);
		$pdf->SetFillColor($col);	
		$pdf->rect(5,$fila,205,4,F);
		$pdf->Cell(20,4,'EXAMENES COMPLEMENTARIOS',0,0,L);
		
		$fila=$fila+$h+4;
		$pdf->SetXY(5,$fila);
		$pdf->Cell(65,4,'Hemoglobina: '.$rowexaf[hemoglo_exc],1,0,L);
		$pdf->Cell(65,4,'Glicemia: '.$rowexaf[glicemi_exc],1,0,L);
		$pdf->Cell(65,4,'Hemoclasificacion: '.$rowexaf[hemocla_exc],1,0,L);
		
		$fila=$fila+$h+4;
		$pdf->SetXY(5,$fila);
		$pdf->Cell(65,4,'Hematocrito: '.$rowexaf[hematoc_exc],1,0,L);
		$pdf->Cell(65,4,'BUN: '.$rowexaf[bun_exc],1,0,L);
		$pdf->Cell(65,4,'Proteinas Total: '.$rowexaf[protein_exc],1,0,L);
		
		$fila=$fila+$h+4;
		$pdf->SetXY(5,$fila);
		$pdf->Cell(65,4,'Plaquetas: '.$rowexaf[plaquet_exc],1,0,L);
		$pdf->Cell(65,4,'Creatinina: '.$rowexaf[creatin_exc],1,0,L);
		$pdf->Cell(65,4,'Albumina: '.$rowexaf[albumin_exc],1,0,L);
		
		$fila=$fila+$h+4;
		$pdf->SetXY(5,$fila);
		$pdf->Cell(65,4,'Tiempo de Protombina '.$rowexaf[tp_exc],1,0,L);
		$pdf->Cell(65,4,'Na+: '.$rowexaf[sodio_exc],1,0,L);
		$pdf->Cell(65,4,'Bilirrubina Total: '.$rowexaf[bilitot_exc],1,0,L);
		
		$fila=$fila+$h+4;
		$pdf->SetXY(5,$fila);
		$pdf->Cell(65,4,'Tiempo Parcial de Tromboplastina: '.$rowexaf[tpt_exc],1,0,L);
		$pdf->Cell(65,4,'K+: '.$rowexaf[potasio_exc],1,0,L);
		$pdf->Cell(65,4,'Bilirrubina Directa: '.$rowexaf[bilidir_exc],1,0,L);
		
		$fila=$fila+$h+4;
		$pdf->SetXY(5,$fila);
		$pdf->Cell(65,4,'Tipo de Sangra: '.$rowexaf[tiposan_exc],1,0,L);
		$pdf->Cell(65,4,'Calcio: '.$rowexaf[calcio_exc],1,0,L);
		$pdf->Cell(65,4,'V.D.R.L : '.$rowexaf[vdrl_exc],1,0,L);
		
		switch ($rowexaf[prembar_exc]){
			case 'P':
				$prembar_='Positiva';
				break;
			case 'N':
				$prembar_='Negativa';
				break;
		}
		$fila=$fila+$h+4;
		$pdf->SetXY(5,$fila);
		$pdf->Cell(65,4,'T. Coagulacion: '.$rowexaf[coagula_exc],1,0,L);
		$pdf->Cell(65,4,'Leucocitos: '.$rowexaf[leucoci_exc],1,0,L);
		$pdf->Cell(65,4,'Prueba de Embarazo: '.$prembar_,1,0,L);
		
		$fila=$fila+$h+5;
		$pdf->SetXY(5,$fila);
		$pdf->Cell(20,4,'EXAMEN',1,0,C);
		$pdf->Cell(20,4,'FECHA',1,0,C);
		$pdf->MultiCell(160,4,'LECTURA',1,J);
		
		$fila=$fila+$h+4;
		$pdf->SetXY(5,$fila);
		$pdf->Cell(20,4,'Rayos X: ',0,0,L);
		$pdf->Cell(20,4,$rowexaf[rxfecha_exc],0,0,L);
		$pdf->MultiCell(160,4,$rowexaf[rxdescrip_exc],0,J);
		
		$fila=$pdf->GetY()+$h;
		$pdf->SetXY(5,$fila);
		$pdf->Cell(20,4,'E.C.G:',0,0,L);
		$pdf->Cell(20,4,$rowexaf[ecgfecha_exc],0,0,L);
		$pdf->MultiCell(160,4,$rowexaf[ecgdescrip_exc],0,J);
		
		$fila=$pdf->GetY()+$h;
		$pdf->SetXY(5,$fila);
		$pdf->Cell(20,4,'ECO:',0,0,L);
		$pdf->Cell(20,4,$rowexaf[ecofecha_exc],0,0,L);
		$pdf->MultiCell(160,4,$rowexaf[ecodescrip_exc],0,J);
		
		$fila=$pdf->GetY()+$h;
		$pdf->SetXY(5,$fila);
		$pdf->Cell(20,4,'OTRO:',0,0,L);
		$pdf->Cell(20,4,$rowexaf[otrofecha_excc],0,0,L);
		$pdf->MultiCell(160,4,$rowexaf[otrodescrip_exc],0,J);
		
		$fila=$fila+$h;		
		$consultaef="select * from preanes_conclusion where numero_cons='$numhisto'";
		$consultaef=mysql_query($consultaef);
		$rowexaf=mysql_fetch_array($consultaef);
		
		$fila=$pdf->GetY();
		$fila=$fila+$h+4;
		$pdf->SetXY(100,$fila);
		$pdf->SetFillColor($col);	
		$pdf->rect(5,$fila,205,4,F);
		$pdf->Cell(20,4,'CONCLUSIONES',0,0,L);
		
		$fila=$fila+$h+4;
		$pdf->SetXY(5,$fila);
		$pdf->Cell(65,4,'Estado Fisico: A.S.A. '.$rowexaf[estfisico_ccl],0,0,L);
		$pdf->Cell(65,4,'Clase Funcional: '.$rowexaf[clafuncional_ccl],0,0,L);
		
		$fila=$fila+$h+6;
		$pdf->SetXY(5,$fila);
		$pdf->Cell(200,4,'PLAN',0,0,C);
		
		$fila=$fila+$h+4;
		$pdf->SetXY(5,$fila);
		$pdf->Cell(65,4,'APTO PARA CIRUGIA: '.$rowexaf[aptociru_ccl],0,0,L);
		
		$fila=$fila+$h+4;
		$pdf->SetXY(10,$fila);
		$pdf->Cell(195,4,'1.Anestesia Propuesta: '.$rowexaf[anestesia_ccl],0,0,L);

		$fila=$fila+$h+4;
		$pdf->SetXY(10,$fila);
		$pdf->Cell(195,4,'2.Reserva Sanguinea: '.$rowexaf[reserva_ccl],0,0,L);
		
		$fila=$fila+$h+4;
		$pdf->SetXY(10,$fila);
		$pdf->Cell(195,4,'3.Premedicacion: '.$rowexaf[premedica_ccl],0,0,L);
		
		switch ($rowexaf[programa_ccl]){
			case 'A':
				$programa_='Ambulatorio';
				break;
			case 'H':
				$programa_='Hospitalizar';
				break;
		}
		$fila=$fila+$h+4;
		$pdf->SetXY(10,$fila);
		$pdf->Cell(195,4,'4.Programar: '.' '.$programa_.' '.$rowexaf[anotacion_ccl],0,0,L);
		
		$fila=$fila+$h+4;
		$pdf->SetXY(5,$fila);
		$pdf->Cell(195,4,'RE-EVALUAR EN SALA DE CIRUGIA: '.$rowexaf[reevaluar_ccl],0,0,L);
		
		$fila=$fila+$h+4;
		$pdf->SetXY(5,$fila);
		$pdf->MultiCell(200,4,'Interconsultas y Observaciones: '.$rowexaf[observa_ccl],1,J);
		
		$fila=$pdf->GetY();
		$fila=$fila+$h+4;
		$pdf->SetXY(5,$fila);
		if($rowexaf[concent_ccl]=='S'){
			$pdf->Cell(3,4,'X',1,0,L);}
		else{
			$pdf->Cell(3,4,' ',1,0,L);}
		$pdf->MultiCell(200,4,'SE EXPLICA ALTERNATIVAS Y RIESGOS ANESTESICOS, SIENDO ENTENDIDAS Y ACEPTADAS POR EL PACIENTE Y/O ACUDIENTE',0,J);
//$pdf->Output();
?>
