<?php

require('fpdf.php');

function increm($fil,&$pdf,&$cod,&$nd)
{
  $fil=$fil+4;
  if($fil>=244)
  {
    $fil=40;
	$pdf->AddPage();
	
	$pdf->SetXY(15,30);
	$pdf->SetFont('Arial','',7);
	$pdf->Cell(40,5,'C.C: '.$cod,0);
	
	$con_usu=mysql_query("SELECT usuario.NROD_USU, usuario.CODI_USU, usuario.PNOM_USU, usuario.SNOM_USU, usuario.PAPE_USU, usuario.SAPE_USU, usuario.FNAC_USU, usuario.SEXO_USU,usuario.DIRE_USU, usuario.TRES_USU ,usuario.MRES_USU,usuario.TPAF_USU 
	FROM usuario
	INNER JOIN ucontrato AS ucontrato ON ucontrato.CUSU_UCO=usuario.CODI_USU
	INNER JOIN contrato AS contrato ON contrato.CODI_CON=ucontrato.CONT_UCO
	WHERE usuario.NROD_USU='$cod' AND ucontrato.ESTA_UCO='AC'");
	
	$rowu=mysql_fetch_array($con_usu);
	$pdf->SetXY(35,30);
	$pdf->SetFont('Arial','',7);
	$pdf->Cell(40,5,'Nombre: '.$rowu['PNOM_USU'].' '.$rowu['SNOM_USU'].' '.$rowu['PAPE_USU'].' '.$rowu['SAPE_USU'],0);
	$pdf->SetXY(170,30);
	$pdf->Cell(40,5,'Orden: '.$nd);
	linea(15,33,190,"_",$pdf);
	$pdf->Image('imagenes\du.JPG',5,10,204,0,'','');
    $pdf->Image('imagenes\PIE1.JPG',5,254,204,0,'','');
    $pdf->Image('imagenes\control.jpg',209,233,0,30,0,'','');
  }
   $pdf->SetFont('Arial','',10);
  return ($fil);
}

function linea($col_,$fil_,$cant_,$car_,&$pdf)
{
  for($n=0;$n<$cant_;$n++)
  {
    $pdf->SetXY($col_+$n,$fil_);
	$pdf->Cell(40,5,$car_,0);
  }
}

function titulo(&$pdf_,&$fila_)
{
	if($fila_>245)
	{
	  $pdf_->AddPage();
	  $fila_=16;
	  //$pdf_->Image($nomimg,1,0,210,0,'','');
	  //$pdf_->Image('img\controlado.png',205,100,7,30,'','');
	 // $pdf->SetXY(5,$fila);
	 // $pdf->Cell(40,5,'PR: Examen Preliminar - VL: Examen Validado' ,0);
	  //$pdf_->Image('img\PIE1.JPG',2,265,210,0,'','');
	}
}

$pdf=new FPDF('P','mm','Letter');
$pdf->AddPage();
$pdf->SetFont('Arial','',10);
$fila=62;
$col=20;
$pdf->Image('imagenes\du.JPG',5,10,204,0,'','');
$pdf->SetFont('Arial','',7);
$pdf->SetXY(5,254);
$pdf->Cell(40,5,'PR: Examen Preliminar - VL: Examen Validado    *: Examen Confirmado ' ,0);
$pdf->SetFont('Arial','',10);
$pdf->Image('imagenes\PIE1.JPG',5,254,204,0,'','');
$pdf->Image('imagenes\control.jpg',209,233,0,30,0,'','');
$nu=date("Y-m-d"); 
$ho=strftime("%I:%M:%S");


	
	$cont=$cont+0;	
	
	$link=Mysql_connect("localhost","root","");
	if(!$link)echo"no hay conexion";
	Mysql_select_db('proinsalud',$link);
	
	$nomvar='codusu'.$it;
	$codusu=$$nomvar;	

	
	$nomvar='num_ord'.$it;
	$num_ord=$$nomvar;

	
	$nomvar='iden_labs'.$it;
	$iden_labs=$$nomvar;
	

	$inf=mysql_query("SELECT el.iden_labs, el.codi_usu, el.cod_medi, el.iden_evo, el.iden_cita, el.fchr_labs, el.fche_labs, 
	el.hrar_labs, el.hrae_labs, el.ambi_labs, el.codu_labs, el.prog_labs, el.fina_labs, el.dxo_labs, el.obs_labs,el.resp_labs,dl.fech_dlab,dl.hora_dlab  
	FROM encabezado_labs AS el
	INNER JOIN detalle_labs AS dl ON dl.iden_labs=el.iden_labs
	WHERE el.codi_usu='$codusu'");
	
		
	while($row = mysql_fetch_array($inf))
	{
		$mine=$row[fchr_labs];
		$minr=$row[hrar_labs];
		$mine2=$row[fech_dlab];
		$minr2=$row[hora_dlab];
		$idlab=$row[iden_labs];
		$cod=$row[codi_usu];
		$codi_med=$row[cod_medi];
		$iden_evo=$row[iden_evo];

	}
	
	$con_cam=mysql_query("SELECT ingreso_hospitalario.caac_ing, destipos.nomb_des
		FROM ((encabezado_labs INNER JOIN hist_evo ON encabezado_labs.iden_evo = hist_evo.iden_evo) INNER JOIN ingreso_hospitalario ON hist_evo.id_ing = ingreso_hospitalario.id_ing) 
		INNER JOIN destipos ON ingreso_hospitalario.caac_ing = destipos.codi_des
		WHERE encabezado_labs.iden_evo='$iden_evo'
		GROUP BY ingreso_hospitalario.caac_ing, destipos.nomb_des");
		
		$rowcam=mysql_fetch_array($con_cam);
		$cama=$rowcam[nomb_des];
	

	$conmed= Mysql_query("SELECT nom_medi FROM MEDICOS WHERE cod_medi='$codi_med'");
	$rowme=mysql_fetch_array($conmed);
	$nom_med=$rowme[nom_medi];
	
	


	/*
	if($hospit=='1')
	{
		$conexavar=mysql_query("SELECT Count(encabezado_labs.iden_evo) AS CuentaDeiden_evo
		FROM (encabezado_labs INNER JOIN hist_var ON encabezado_labs.iden_evo = hist_var.iden_evo) INNER JOIN cups ON hist_var.iden_ser = cups.codigo
		WHERE (((encabezado_labs.iden_labs)=$idlab) AND ((cups.tipo)='1803'))");
		
		$rowcta = mysql_fetch_array($conexavar);
		$valor1=$rowcta[CuentaDeiden_evo];
	
	
		$conexdt=mysql_query("SELECT Count(encabezado_labs.iden_labs) AS CuentaDeiden_labs
		FROM encabezado_labs INNER JOIN detalle_labs ON encabezado_labs.iden_labs = detalle_labs.iden_labs
		WHERE encabezado_labs.iden_labs=$idlab");
		
		$rowexdt = mysql_fetch_array($conexdt);
		$valor2=$rowexdt[CuentaDeiden_labs];
		
	}*/
	
	
	
	
	
	$result=mysql_query("SELECT usuario.NROD_USU, usuario.CODI_USU, usuario.PNOM_USU, usuario.SNOM_USU, usuario.PAPE_USU, usuario.SAPE_USU, usuario.FNAC_USU, usuario.SEXO_USU,usuario.DIRE_USU, usuario.TRES_USU ,contrato.NEPS_CON, usuario.MRES_USU,usuario.TPAF_USU 
	FROM usuario
	INNER JOIN ucontrato AS ucontrato ON ucontrato.CUSU_UCO=usuario.CODI_USU
	INNER JOIN contrato AS contrato ON contrato.CODI_CON=ucontrato.CONT_UCO
	WHERE usuario.CODI_USU='$cod' AND ucontrato.ESTA_UCO='AC'");
	
	$bandera="true";
	while($row = mysql_fetch_array($result))

	{ 
		$idcod=$row["CODI_USU"];
		$cod=$row ["NROD_USU"];
		$nom=$row ["PNOM_USU"];
		$nom2=$row ["SNOM_USU"];
		$ape=$row ["PAPE_USU"];
		$ape2=$row["SAPE_USU"];
		$tip=$row["TPAF_USU"];
		//$edad=$row["eda_usua"];
		$genero=$row["SEXO_USU"];
		$cod_emp=$row[NEPS_CON];
		$cod_muni=$row["MRES_USU"];
		$fecn=$row["FNAC_USU"];
		$nombre= $nom." ".$nom2." ".$ape." ".$ape2;


	}
	
	if ($bandera=="true"){
	
	$pdf->SetXY(15,8);
	$pdf->SetFont('Arial','',5);
	$pdf->Cell(40,5,$iden_labs,0);
	
	$pdf->SetXY(15,30);
	$pdf->SetFont('Arial','',10);
	$pdf->Cell(40,5,'Fecha de Recepcion:',0);
	$pdf->SetXY(50,30);
	$pdf->SetFont('Arial','',8);
	$pdf->Cell(40,5,$mine.' / '.$minr,0);


	$pdf->SetXY(85,30);
	$pdf->SetFont('Arial','',10);
	$pdf->Cell(40,5,'Fecha de Entrega:',0);
	$pdf->SetXY(116,30);
	$pdf->SetFont('Arial','',8);
	$pdf->Cell(40,5,$mine2.' / '.$minr2,0);


	$pdf->SetXY(150,30);
	$pdf->SetFont('Arial','',10);
	$pdf->Cell(40,5,'Fecha Impresion:',0);
	$pdf->SetXY(179,30);
	$pdf->SetFont('Arial','',8);
	$pdf->Cell(40,5,$nu,0);
	
	
	$pdf->SetXY(15,35);
	$pdf->SetFont('Arial','',10);
	$pdf->Cell(40,5,"Identificaci�n:",0);
	 
	$pdf->SetXY(38,35);
	$pdf->SetFont('Arial','',8); 
	$pdf->Cell(40,5,$cod,0);


	$pdf->SetXY(65,35);
	$pdf->SetFont('Arial','',10);
	$pdf->Cell(40,5,"Nombres:",0);


	$pdf->SetXY(82,35);
	$pdf->SetFont('Arial','',8);
	$pdf->Cell(40,5,$nombre,0);

	///Numero de factura
	 
	/*$pdf->SetXY(115,35);
	$pdf->SetFont('Arial','',10);
	$pdf->Cell(40,5,"N�.Orden:",0);

	$pdf->SetXY(132,35);
	$pdf->SetFont('Arial','',10);
	 $pdf->Cell(40,5,$num_ord,0);*/

	///Numero De Orden
	$pdf->SetXY(150,35);
	$pdf->SetFont('Arial','',10);
	$fila=increm($fila,$pdf,$cod,$num_ord);
	$pdf->Cell(40,5,"Edad:",0);

	$pdf->SetXY(160,35);
	$uni=$uni;
	$ed=calculaedad2($fecn,$uni);
	$pdf->SetFont('Arial','',8);
	$pdf->Cell(40,5,$ed.' '.$uni,0);

	//Cedula Del usuario

	$pdf->SetXY(15,40);
	$pdf->SetFont('Arial','',10);
	$pdf->Cell(40,5,"Sexo:",0);

	$pdf->SetXY(30,40);
	$pdf->SetFont('Arial','',8);

	$pdf->Cell(40,5,$genero,0);

	//Nombre Del usuario

	$pdf->SetXY(65,40);
	$pdf->SetFont('Arial','',10);
	$pdf->Cell(40,5,"Municipio:",0);

	$pdf->SetXY(82,40);
	$pdf->SetFont('Arial','',8);
	$pdf->Cell(40,5,$cod_muni,0);

	//Genero Del Usuario

	$pdf->SetXY(150,40);
	$pdf->SetFont('Arial','',10);
	$pdf->Cell(40,5,"Contrato:",0);

	$pdf->SetXY(165,40);
	$pdf->SetFont('Arial','',8);
	$pdf->Cell(40,5,$cod_emp,0);

	//Empresa Remitente

	$pdf->SetXY(15,45);
	$pdf->SetFont('Arial','',10);
	$pdf->Cell(40,5,"Cama:",0);


	$pdf->SetXY(30,45);
	$pdf->SetFont('Arial','',7);
	//$pdf->Cell(40,5,$cama,0);

	///Nombre Medico Remitente

	$pdf->SetXY(65,45);
	$pdf->SetFont('Arial','',10);
	$pdf->Cell(40,5,"Medico Remitente:",0);


	$pdf->SetXY(95,45);
	$pdf->SetFont('Arial','',7);
	$pdf->Cell(40,5,$nom_med,0);


	//Tipo De Usuario

	$pdf->SetXY(150,45);
	$pdf->SetFont('Arial','',10);
	$pdf->Cell(40,5,"TpUsuario:",0);
	$pdf->SetXY(168,45);
	$pdf->SetFont('Arial','',8);
	$pdf->Cell(40,5,$tip,0);


}


//1. Examenes Varios listado
$result2=Mysql_query("SELECT cups.codi_cup,detalle_labs.iden_dlab,detalle_labs.iden_labs, encabezado_labs.codi_usu,encabezado_labs.resp_labs, detalle_labs.codigo, cups.descrip, detalle_labs.obsv_dlab,
detalle_labs.refe_dlab, detalle_labs.unid_dlab, detalle_labs.cod_medi,detalle_labs.estd_dlab
FROM detalle_labs
INNER JOIN encabezado_labs ON detalle_labs.iden_labs = encabezado_labs.iden_labs
INNER JOIN cups AS cups ON detalle_labs.codigo = cups.codigo
WHERE  detalle_labs.nord_dlab='$nord_lab'  AND detalle_labs.estd_dlab<>'EL' AND detalle_labs.estd_dlab<>'P'");

$bandera="true";
$i=0;
$fila=49;



while($rowm= mysql_fetch_array($result2))
{ 

if ($bandera=="true")
{
////ENCABEZADOS DATOS IMPORTANTES DE LOS EXAMENES

///// linea de Separacion - DATOS DE EXAMENES

	$pdf->SetXY(179,$fila);
	$pdf->settextcolor(180,20,30);
	$pdf->SetFont('Arial','',9);
	$pdf->Cell(40,2,'Orden/ '.$nord_lab,0);
	$pdf->settextcolor(180,20,30);
	$pdf->settextcolor(0,0,0);
	
	

	linea(15,$fila,190,"_",$pdf);

	$fila=$fila+4;
	$pdf->SetFont('Arial','',7);

	$pdf->SetXY(15,$fila+2);
	$pdf->Cell(40,5,"CODIGO",0);

	$pdf->SetXY(35,$fila+2);
	$pdf->Cell(40,5,"NOMBRE - PRUEBA",0);

	$pdf->SetXY(125,$fila+2);
	$pdf->Cell(40,5,"RESULTADO",0);


	$pdf->SetXY(150,$fila+2);
	$pdf->Cell(40,5,"UNIDADES",0);

	$pdf->SetXY(172,$fila+2);
	$pdf->Cell(40,5,"VALOR REFERENCIA",0);

	$pdf->SetFont('Arial','',5);
	$pdf->SetXY(200,$fila+2);
	$pdf->Cell(40,5,"ESTADO",0);

	linea(15,$fila+4,190,"_",$pdf);

	$bandera="false";

	$pdf->SetFont('Arial','',9);
}
	$idenlb=$rowm["iden_dlab"];	
	if($fila>=190)
	{	
	
		$pdf->AddPage();
		$pdf->Image('imagenes\du.JPG',5,10,204,0,'','');
		//$pdf->SetFont('Arial','',10);
		$pdf->Image('imagenes\PIE1.JPG',5,256,204,0,'','');
		$pdf->Image('imagenes\control.jpg',209,233,0,30,0,'','');
		$fila=30;
		$pdf->setxy(15,$fila);
		$pdf->cell(40,5,substr($rowm["codi_cup"],0,60));
		
		$pdf->setxy(35,$fila);
		$pdf->cell(40,5,substr($rowm["descrip"],0,40));
		
		$res_val=$rowm["obsv_dlab"];
                        
                $consvrf=mysql_query("SELECT codigo,sexo_ire,coin_ire,edin_ire,unin_ire,cosp_ire,edsp_ire,unsp_ire,vlin_ire,vlsu_ire 
			FROM  labo_vlref  WHERE codigo='$rowm[codi_cup]'");
                        
		while($rowrefer = mysql_fetch_array($consvrf))
		{
			$cod_rein=$rowrefer[vlin_ire];
			$cod_refin=$rowrefer[vlsu_ire];
			if(($res_val<=$cod_rein) || ($res_val>=$cod_refin))
			{
			   $pdf->setxy(203,$fila);
			   $pdf->cell(40,5,'*',0,60); 
			}
			
		}    
		
		//$pdf->SetFont('Arial','',8);
		$pdf->setxy(125,$fila);
		$pdf->cell(40,5,substr($rowm["obsv_dlab"],0,60));
		
		
		$pdf->SetFont('Arial','',8);
		$pdf->setxy(175,$fila);
		$pdf->cell(40,5,substr($rowm["refe_dlab"],0,60));
		
		$pdf->setxy(150,$fila);
		$pdf->cell(40,5,substr($rowm["unid_dlab"],0,60));
		//$pdf->SetFont('Arial','',7);
		
		
		
		
		if($rowm[estd_dlab]=='PR')
		{
			$pdf->settextcolor(180,20,30);
			$pdf->SetFont('Arial','',5);
			$pdf->setxy(200,$fila);
			$pdf->cell(40,5,substr($rowm["estd_dlab"],0,60));
		}
		else
		{
			if($rowm[estd_dlab]=='CU')
			{
				$pdf->settextcolor(0,0,0);
				$pdf->SetFont('Arial','',5);
				$pdf->setxy(200,$fila);
				$pdf->cell(40,5,'VL',0,60);
			}
		}
	}
	else
	{
		$fila=$fila+8;
		$pdf->setxy(15,$fila);
		$pdf->cell(40,5,substr($rowm["codi_cup"],0,60));
		
		$pdf->setxy(35,$fila);
		$pdf->cell(40,5,substr($rowm["descrip"],0,40));
		
		$res_val=$rowm["obsv_dlab"];
                        
        $consvrf=mysql_query("SELECT codigo,sexo_ire,coin_ire,edin_ire,unin_ire,cosp_ire,edsp_ire,unsp_ire,vlin_ire,vlsu_ire 
			FROM  labo_vlref  WHERE codigo='$rowm[codigo]'");
                        
		while($rowrefer = mysql_fetch_array($consvrf))
		{
			$cod_rein=$rowrefer[vlin_ire];
			$cod_refin=$rowrefer[vlsu_ire];
			if(($res_val<=$cod_rein) || ($res_val>=$cod_refin))
			{
			   $pdf->setxy(203,$fila);
			   $pdf->cell(40,5,'*',0,60); 
			}
			
		}    
		
		//$pdf->SetFont('Arial','',8);
		$pdf->setxy(125,$fila);
		$pdf->cell(40,5,substr($rowm["obsv_dlab"],0,60));
		
		
		$pdf->SetFont('Arial','',8);
		$pdf->setxy(175,$fila);
		$pdf->cell(40,5,substr($rowm["refe_dlab"],0,60));
		
		$pdf->setxy(150,$fila);
		$pdf->cell(40,5,substr($rowm["unid_dlab"],0,60));
		//$pdf->SetFont('Arial','',7);
	
		if($rowm[estd_dlab]=='PR')
		{
			$pdf->settextcolor(180,20,30);
			$pdf->SetFont('Arial','',5);
			$pdf->setxy(200,$fila);
			$pdf->cell(40,5,substr($rowm["estd_dlab"],0,60));
		}
		else
		{
			if($rowm[estd_dlab]=='CU')
			{
				$pdf->settextcolor(0,0,0);
				$pdf->SetFont('Arial','',5);
				$pdf->setxy(200,$fila);
				$pdf->cell(40,5,'VL',0,60);
			}
		}
		$sql_vitc=mysql_query("SELECT nord_lab,cup_vord,fech_vord,hora_vord,codu_vord,eord_vord,resp_vord 
			FROM  vitac_orden WHERE nord_lab='$nd_' and iden_evo='$idenlb' ");
			while ($rowcor = mysql_fetch_array($sql_vitc)) 
			{
				$cod_ex=$rowcor["cup_vord"];
				$fech_=$rowcor["fech_vord"];
				$hora_=$rowcor["hora_vord"];
				$resp_=$rowcor["resp_vord"];
				$cod_=$rowm["codigo"];
				$fec=$fech_.'-'.$hora_;
				if($cod_ex==$cod_)
				{
					$pdf->setxy(150,$fila+2);
					$pdf->cell(40,5,'MDF-'.$fec.' '.$resp_,0,60);
				   
				}
			}
	
	}
	$pdf->settextcolor(0,0,0);
	$pdf->SetFont('Arial','',10);
}
//$cont=$cont+10;


//impresion de datos Coprologicos

$result1=mysql_query("SELECT `iden_dlab`, `cod_examen`, `fec_rec`, `fec_ent`, `cod_usu`, `consistenc`, `bh`,
`blastocyst`, `qc`, `QEColi`, `color`, `ch`, `chilomasti`, `ph`, `tz`, 
`trofozoito`, `moco`, `sangreocul`, `otros`, `azucaresre`,`leuc_cpr`, `hema_cpr`, `writh`, `levadura`,
`neutrofilo`, `micelios`, `linfocitos`, `grasa_neut`, `eosinofilo`, `flora_bact`,
`qh`, `qehistolyt`, `qn`, `qemana`, `observaciones`, `no`, `val` FROM coprol WHERE `iden_dlab`='$iden_labs' AND `esta_ord`<>'EL'");
if(mysql_num_rows($result1)<>0)
{
while($rowx = mysql_fetch_array($result1))

{
$no=$rowx["no"];
$val=$rowx["val"];
$consistenc=$rowx["consistenc"];
$blastocyst=$rowx["blastocyst"];
$bh=$rowx["bh"];
$qc=$rowx["qc"];
$QEColi =$rowx["QEColi"];
$color  =$rowx["color"];
$ch=$rowx["ch"];
$chilomasti =$rowx["chilomasti"];
$ph =$rowx["ph"];
$tz =$rowx["tz"];
$trofozoito =$rowx["trofozoito"];
$moco =$rowx["moco"];
$sangreocul =$rowx["sangreocul"];
$otros=$rowx["otros"];
$azucaresre =$rowx["azucaresre"];
$writh =$rowx["writh"];
$levadura =$rowx["levadura"];
$neutrofilo =$rowx["neutrofilo"];
$micelios =$rowx["micelios"];
$linfocitos =$rowx["linfocitos"];
$grasa_neut =$rowx["grasa_neut"];
$eosinofilo =$rowx["eosinofilo"];
$flora_bact =$rowx["flora_bact"];
$qh =$rowx["qh"];
$qehistolyt =$rowx["qehistolyt"];
$qn =$rowx["qn"];
$qemana =$rowx["qemana"];
$leuc_cpr=$rowx["leuc_cpr"];
$hema_cpr=$rowx["hema_cpr"];
$observaciones =$rowx["observaciones"];
 
//if de examenes Coprologicos
$fila=increm($fila+4,$pdf,$cod,$num_ord);

$pdf->SetXY(15,$fila);
$pdf->Cell(40,5,"______________________________________________________________________________________________________________________________________________",0);

$fila=increm($fila+2,$pdf,$cod,$num_ord);
$pdf->SetXY(80,$fila);
$pdf->Cell(40,5,"EXAMENES DATOS COPROSCOPICOS",0);

$pdf->SetXY(15,$fila);
$pdf->Cell(40,5,"______________________________________________________________________________________________________________________________________________",0);


//////////////////////CARACTERISTICAS DE LOS EXAMENES DATOS COPROSCOPICOS


$fila=increm($fila+2,$pdf,$cod,$num_ord);

$pdf->SetXY(15,$fila);
$pdf->Cell(40,5,'COPROSCOPICO',0);

$fila=increm($fila,$pdf,$cod,$num_ord);
$pdf->SetXY(15,$fila);
$pdf->Cell(40,5,'PH:',0);

//resultados

$pdf->SetXY(25,$fila);
$pdf->Cell(40,5,$ph,0);

$pdf->SetXY(46,$fila);
$pdf->Cell(40,5,'COLOR:',0);

//resultados

$pdf->SetXY(64,$fila);
$pdf->Cell(40,5,$color,0);


$pdf->SetXY(90,$fila);
$pdf->Cell(40,5,'CONSISTENCIA:',0);

//resultados
$pdf->SetXY(128,$fila);
$pdf->Cell(40,5,$consistenc,0);

$fila=increm($fila,$pdf,$cod,$num_ord);
$pdf->SetXY(15,$fila);
$pdf->Cell(40,5,'SANGRE OCULTA:',0);

//resultados

$pdf->SetXY(53,$fila);
$pdf->Cell(40,5,$sangreocul,0);



$pdf->SetXY(90,$fila);
$pdf->Cell(40,5,'AZU.REDUCTORES:',0);

//resultados

$pdf->SetXY(133,$fila);
$pdf->Cell(40,5,$azucaresre ,0);

$pdf->SetXY(153,$fila);
$pdf->Cell(40,5,$val ,0);

$pdf->SetXY(162,$fila);
$pdf->Cell(40,5,'mg/l' ,0);

$fila=increm($fila,$pdf,$cod,$num_ord);

$pdf->SetXY(15,$fila);
$pdf->Cell(40,5,'LEUCOCITOS:  '.$leuc_cpr.' /mm�',0);

$pdf->SetXY(90,$fila);
$pdf->Cell(40,5,'HEMATIES:  '.$hema_cpr.' /ul' ,0);

$fila=increm($fila,$pdf,$cod,$num_ord);

$pdf->SetXY(15,$fila);
$pdf->Cell(40,5,'COPROLOGICO',0);

$fila=increm($fila,$pdf,$cod,$num_ord);
$pdf->SetXY(15,$fila);
$pdf->Cell(40,5,'MOCO:',0);

//resultados

$pdf->SetXY(30,$fila);
$pdf->Cell(40,5,$moco,0);

$pdf->SetXY(50,$fila);
$pdf->Cell(40,5,'LEVADURAS:',0);
//resultados
$pdf->SetXY(77,$fila);
$pdf->Cell(40,5,$levadura,0);


$pdf->SetXY(90,$fila);
$pdf->Cell(40,5,'MICELIOS:',0);

//resultados

$pdf->SetXY(113,$fila);
$pdf->Cell(40,5,$micelios,0);

/*$fila=increm($fila,$pdf,$cod,$num_ord);
$pdf->SetXY(15,$fila);
$pdf->Cell(40,5,'GRASAS NEUTRAS:',0);

//resultados

$pdf->SetXY(60,$fila);
$pdf->Cell(40,5,$grasa_neut,0);

$pdf->SetXY(90,$fila);
$pdf->Cell(40,5,'FLORA BACTERIANA:',0);

//resultados

$pdf->SetXY(135,$fila);
$pdf->Cell(40,5,$flora_bact,0);*/

$fila=increm($fila,$pdf,$cod,$num_ord);
$pdf->SetXY(15,$fila);
$pdf->Cell(40,5,$qc,0);

//resultados



$pdf->SetXY(45,$fila);
$pdf->Cell(40,5,$QEColi,0);



$pdf->SetXY(90,$fila);
$pdf->Cell(40,5,$qh,0);

//resultados

$pdf->SetXY(130,$fila);
$pdf->Cell(40,5,$qehistolyt,0);


$fila=increm($fila,$pdf,$cod,$num_ord);

$pdf->SetXY(15,$fila);
$pdf->Cell(40,5,$qn,0);

//resultados

$pdf->SetXY(45,$fila);
$pdf->Cell(40,5,$qemana,0);


$pdf->SetXY(90,$fila);
$pdf->Cell(40,5,$bh,0);

//resultados

$pdf->SetXY(130,$fila);
$pdf->Cell(40,5,$blastocyst,0);

$fila=increm($fila,$pdf,$cod,$num_ord);
$pdf->SetXY(15,$fila);
$pdf->Cell(40,5,$ch,0);

//resultados

$pdf->SetXY(55,$fila);
$pdf->Cell(40,5,$chilomasti,0);



$pdf->SetXY(90,$fila);
$pdf->Cell(40,5,$tz,0);

//resultados

$pdf->SetXY(120,$fila);
$pdf->Cell(40,5,$trofozoito,0);

$fila=increm($fila,$pdf,$cod,$num_ord);
$pdf->SetXY(15,$fila);
$pdf->Cell(40,5,'Otros:',0);

//resultados

$pdf->SetXY(15,$fila+4);
$pdf->Cell(40,5,$otros,0);

$pdf->SetXY(90,$fila);
$pdf->Cell(40,5,$no,0);


$fila=increm($fila+4,$pdf,$cod,$num_ord);
$pdf->SetXY(15,$fila);
$pdf->Cell(40,5,'Wright:',0);

//resultados

$pdf->SetXY(45,$fila);
$pdf->Cell(40,5,$writh,0);

$pwri=$writh;

if($pwri=='Negativo')
{
	$pdf->SetXY(45,$fila);
	$pdf->Cell(40,5,'',0);
}
else
{
	$fila=increm($fila,$pdf,$cod,$num_ord);
	$pdf->SetXY(15,$fila);
	$pdf->Cell(40,5,'Neutrofilos:',0);

	//resultados

	$pdf->SetXY(45,$fila);
	$pdf->Cell(40,5,$neutrofilo,0);

	$pdf->SetXY(55,$fila);
	$pdf->Cell(40,5,'%',0);

	$pdf->SetXY(90,$fila);
	$pdf->Cell(40,5,'Linfoncito:',0);

	//resultados

	$pdf->SetXY(120,$fila);
	$pdf->Cell(40,5,$linfocitos,0);


	$pdf->SetXY(130,$fila);
	$pdf->Cell(40,5,'%',0);


	$pdf->SetXY(150,$fila);
	$pdf->Cell(40,5,'Eosinofilos:',0);

	//resultados

	$pdf->SetXY(175,$fila);
	$pdf->Cell(40,5,$eosinofilo,0);

	$pdf->SetXY(185,$fila);
	$pdf->Cell(40,5,'%',0);
	}
}
}
// Impresion de Cuadro Hematico
$result2=mysql_query("SELECT iden_dlab,`num_fac`, `cod_examch`, `fec_rec`, `fec_ent`, `cod_usu`, `hemoglobin`, `neutrofilos`, `hematrocit`, `cayados`, `vsg1h`, `linfocito`, `leococitos`, `eosinofilos`, `monocitos`, `basofilos`,
 `plaquetas`, `reticuloci`,`vcm_ch`, `hcm_ch`, `chcm_ch`, `ide_ch` , `observacion`  FROM `cuadroh` WHERE `iden_dlab`='$iden_labs' AND `esta_ord`<>'EL'");
if(mysql_num_rows($result2)<>0)
{
 while($rowy = mysql_fetch_array($result2))

{
$hemoglobin=$rowy["hemoglobin"];
$neutrofilos=$rowy["neutrofilos"];
$hematrocit=$rowy["hematrocit"];
$cayados=$rowy["cayados"];
$vsg1h =$rowy["vsg1h"];
$linfocito =$rowy["linfocito"]; 
$leococitos=$rowy["leococitos"];
$eosinofilos =$rowy["eosinofilos"];
$monocitos =$rowy["monocitos"];
$basofilos =$rowy["basofilos"];
$plaquetas =$rowy["plaquetas"];
$reticuloci =$rowy["reticuloci"];
$vcm_ch=$rowy["vcm_ch"];
$hcm_ch=$rowy["hcm_ch"];
$chcm_ch=$rowy["chcm_ch"];
$ide_ch=$rowy["ide_ch"];
$observacion =$rowy["observacion"];
 

//If de cuadro hematico

$fila=increm($fila+4,$pdf,$cod,$num_ord);
$pdf->SetXY(15,$fila);
$pdf->Cell(40,5,"______________________________________________________________________________________________________________________________________________",0);

$fila=increm($fila+2,$pdf,$cod,$num_ord);
$pdf->SetXY(45,$fila);
$pdf->Cell(40,5,"EXAMENES CUADRO HEMATICO O HEMOGRAMA HEMATOCRITO Y LEOCOCITOS ",0);


$pdf->SetXY(15,$fila);
$pdf->Cell(40,5,"______________________________________________________________________________________________________________________________________________",0);

$fila=increm($fila+2,$pdf,$cod,$num_ord);
$pdf->SetXY(15,$fila);
$pdf->Cell(40,5,'HEMOGLOBINA:',0);

$pdf->SetXY(72,$fila);
$pdf->Cell(40,5,'gr / dl',0);

//resultados
$pdf->SetXY(50,$fila);
$pdf->Cell(40,5,$hemoglobin,0);


$pdf->SetXY(120,$fila);
$pdf->Cell(40,5,'NEUTROFILOS:',0);

//resultados
$pdf->SetXY(160,$fila);
$pdf->Cell(40,5,$neutrofilos,0);

$pdf->SetXY(179,$fila);
$pdf->Cell(40,5,'%',0);


$fila=increm($fila,$pdf,$cod,$num_ord);
$pdf->SetXY(120,$fila);
$pdf->Cell(40,5,'CAYADOS:',0);

//resultados
$pdf->SetXY(160,$fila);
$pdf->Cell(40,5,$cayados,0);

$pdf->SetXY(179,$fila);
$pdf->Cell(40,5,'%',0);

$pdf->SetXY(15,$fila);
$pdf->Cell(40,5,'HEMATOCRITO:',0);

//resultados

$pdf->SetXY(50,$fila);
$pdf->Cell(40,5,$hematrocit,0);

$pdf->SetXY(72,$fila);
$pdf->Cell(40,5,'%',0);

$fila=increm($fila,$pdf,$cod,$num_ord);
$pdf->SetXY(120,$fila);
$pdf->Cell(40,5,'LINFONCITOS:',0);

//resultados

$pdf->SetXY(160,$fila);
$pdf->Cell(40,5,$linfocito,0);

$pdf->SetXY(179,$fila);
$pdf->Cell(40,5,'%',0);

$pdf->SetXY(15,$fila);
$pdf->Cell(40,5,'VSG1h',0);

//resultados
$pdf->SetXY(50,$fila);
$pdf->Cell(40,5,$vsg1h,0);

$pdf->SetXY(72,$fila);
$pdf->Cell(40,5,'m.m/h',0);


$fila=increm($fila,$pdf,$cod,$num_ord);
$pdf->SetXY(120,$fila);
$pdf->Cell(40,5,'EOSINOFILOS:',0);

//resultados

$pdf->SetXY(160,$fila);
$pdf->Cell(40,5,$eosinofilos,0);

$pdf->SetXY(179,$fila);
$pdf->Cell(40,5,'%',0);

$pdf->SetXY(15,$fila);
$pdf->Cell(40,5,'LEUCOCITOS:',0);

//resultados

$pdf->SetXY(50,$fila);
$pdf->Cell(40,5,$leococitos,0);

$pdf->SetXY(72,$fila);
$pdf->Cell(40,5,'/mm�',0);


$fila=increm($fila,$pdf,$cod,$num_ord);
$pdf->SetXY(120,$fila);
$pdf->Cell(40,5,'MONOCITOS:',0);

//resultados


$pdf->SetXY(160,$fila);
$pdf->Cell(40,5,$monocitos,0);

$pdf->SetXY(179,$fila);
$pdf->Cell(40,5,'%',0);


////VCM

$pdf->SetXY(15,$fila+4);
$pdf->Cell(40,5,'VCM:',0);

$pdf->SetXY(50,$fila+4);
$pdf->Cell(40,5,$vcm_ch,0);

$pdf->SetXY(72,$fila+4);
$pdf->Cell(40,5,'um',0);
////VCM
$pdf->SetXY(15,$fila+8);
$pdf->Cell(40,5,'HCM:',0);

$pdf->SetXY(50,$fila+8);
$pdf->Cell(40,5,$hcm_ch,0);

$pdf->SetXY(72,$fila+8);
$pdf->Cell(40,5,'pg',0);


$pdf->SetXY(15,$fila);
$pdf->Cell(40,5,'PLAQUETAS:',0);

//resultados

$pdf->SetXY(50,$fila);
$pdf->Cell(40,5,$plaquetas,0);

$pdf->SetXY(72,$fila);
$pdf->Cell(40,5,'/mm�',0);


$fila=increm($fila,$pdf,$cod,$num_ord);
$pdf->SetXY(120,$fila);
$pdf->Cell(40,5,'BASOFILOS:',0);

//resultados


$pdf->SetXY(160,$fila);
$pdf->Cell(40,5,$basofilos,0);

$pdf->SetXY(179,$fila);
$pdf->Cell(40,5,'%',0);


$fila=increm($fila,$pdf,$cod,$num_ord);
$pdf->SetXY(120,$fila);
$pdf->Cell(40,5,'RETICULOCITOS:',0);
//reticulos

$pdf->SetXY(160,$fila);
$pdf->Cell(40,5,$reticuloci,0);

$pdf->SetXY(179,$fila);
$pdf->Cell(40,5,'%',0);

////VCM
//$fila=increm($fila,$pdf,$cod,$num_ord);
$pdf->SetXY(15,$fila+4);
$pdf->Cell(40,5,'CHCM:',0);

$pdf->SetXY(50,$fila+4);
$pdf->Cell(40,5,$chcm_ch,0);

$pdf->SetXY(72,$fila+4);
$pdf->Cell(40,5,'g/dL',0);

$fila=increm($fila,$pdf,$cod,$num_ord);
$pdf->SetXY(120,$fila);
$pdf->Cell(40,5,'IDE:',0);

//resultados


$pdf->SetXY(160,$fila);
$pdf->Cell(40,5,$ide_ch,0);

$pdf->SetXY(179,$fila);
$pdf->Cell(40,5,'%',0);

$fila=increm($fila,$pdf,$cod,$num_ord);
$pdf->SetXY(15,$fila);
$pdf->Cell(40,5,"OBSERVACIONES:",0);

//$pdf->multiCell(200,5,$datos,0,'J');
//resultados
$pdf->SetXY(50,$fila);
$pdf->multiCell(150,5,$observacion,0,'J');
}
}

//impresion datos espermograma
$result3=mysql_query("SELECT `iden_dlab`, `fec_rec`, `fec_ent`, `cod_usu`, `cod_exames`, `fech_reco`, `hor_reco`, `min_rec`, `ph_exa`, `vol_exa`, `dis_visc`, `nor_visc`, `aum_visc`, `1cc_fila`, `3cc_fila`, `m3cc_fila`, `otro__fila`, `20m_licu`, 
`30m_licu`, `otro_licu`, `leoco_dir`, `hema_dir`, `bact_uno`, `tri_mas`, `trim_menos`, `koh_mas`, `koh_menos`, `movprog_mov`, `movpend_mov`, `inmo_mov`, `vivos_vit`, `mue_vit`, `recu_esperm`, `pmn0xc_gram`, `1-5xc_gram`, `neutr_wrig`, `linfo_wrig`,
`norm_morfo`, `micro_morfo`, `macro_morfo`, `enroll_morfo`,`amorf_morfo`,`scabe_morfo`,`scola_morfo`,`dcab_morfo`, `otro_morfo` FROM `esper` WHERE `iden_dlab`='$iden_labs' AND `esta_ord`<>'EL' ");

if(mysql_num_rows($result3)<>0)
{
while($rowxxx = mysql_fetch_array($result3))

{
$fech_reco =$rowxxx["fech_reco"];
$hor_reco =$rowxxx["hor_reco"];
$min_rec =$rowxxx["min_rec"];
$ph_exa =$rowxxx["ph_exa"];
$vol_exa =$rowxxx["vol_exa"];
$dis_visc =$rowxxx["dis_visc"];
$nor_visc=$rowxxx["nor_visc"]; 
$aum_visc =$rowxxx["aum_visc"];
$cc1_fila =$rowxxx["1cc_fila"];
$cc3_fila =$rowxxx["3cc_fila"];
$m3cc_fila =$rowxxx["m3cc_fila"];
$otro__fila=$rowxxx["otro__fila"];
$m_licu20 =$rowxxx["20m_licu"];
$m_licu30 =$rowxxx["30m_licu"];
$otro_licu =$rowxxx["otro_licu"];
$leoco_dir =$rowxxx["leoco_dir"];
$hema_dir  =$rowxxx["hema_dir"];
$bact_uno =$rowxxx["bact_uno"];
$tri_mas  =$rowxxx["tri_mas"];
$trim_menos=$rowxxx["trim_menos"];
$koh_mas =$rowxxx["koh_mas"];
$koh_menos=$rowxxx["koh_menos"];
$movprog_mov =$rowxxx["movprog_mov"];
$movpend_mov =$rowxxx["movpend_mov"];
$inmo_mov =$rowxxx["inmo_mov"];
$vivos_vit =$rowxxx["vivos_vit"];
$mue_vit =$rowxxx["mue_vit"];
$recu_esperm =$rowxxx["recu_esperm"];
$pmn0xc_gram =$rowxxx["pmn0xc_gram"];
$x15c_gram =$rowxxx["1-5xc_gram"];
$neutr_wrig =$rowxxx["neutr_wrig"];
$linfo_wrig =$rowxxx["linfo_wrig"];
$norm_morfo =$rowxxx["norm_morfo"];
$micro_morfo =$rowxxx["micro_morfo"];
$macro_morfo =$rowxxx["macro_morfo"];
$enroll_morfo =$rowxxx["enroll_morfo"];
$amorf_morfo =$rowxxx["amorf_morfo"];
$scabe_morfo =$rowxxx["scabe_morfo"];
$scola_morfo =$rowxxx["scola_morfo"];
$dcab_morfo =$rowxxx["dcab_morfo"];
$otro_morfo =$rowxxx["otro_morfo"];

//if del espermograma

$fila=increm($fila+4,$pdf,$cod,$num_ord);
$pdf->SetXY(15,$fila);
$pdf->Cell(40,5,"______________________________________________________________________________________________________________________________________________",0);

$fila=increm($fila+2,$pdf,$cod,$num_ord);
$pdf->SetXY(80,$fila);
$pdf->Cell(40,5,"EXAMENES ESPERMOGRAMA ",0);

$pdf->SetXY(15,$fila);
$pdf->Cell(40,5,"______________________________________________________________________________________________________________________________________________",0);


////DETALLES DE LOS EXAMENES - LABORATORIO CLINICO 

//$pdf->SetFont('times','B',8);
$fila=increm($fila+2,$pdf,$cod,$num_ord);
$pdf->SetXY(15,$fila);
$pdf->Cell(40,5,'CARACTERISTICAS',0);

$pdf->SetXY(60,$fila);
$pdf->Cell(40,5,'Fecha De Recoleccion:',0);

$pdf->SetXY(100,$fila);
$pdf->Cell(40,5,$fech_reco,0);


$pdf->SetXY(130,$fila);
$pdf->Cell(40,5,'Hora De Procesamiento:',0);

$pdf->SetXY(180,$fila);
$pdf->Cell(40,5,$hor_reco,0);

//resultados
$fila=increm($fila,$pdf,$cod,$num_ord);
$pdf->SetXY(15,$fila);
$pdf->Cell(40,5,'Ph:',0);


//resultados

$pdf->SetXY(25,$fila);
$pdf->Cell(40,5,$ph_exa,0);

//$pdf->SetXY(30,$fila);
//$pdf->Cell(40,5,'%',0);


$pdf->SetXY(60,$fila);
$pdf->Cell(40,5,'Volumen:',0);

//resultados
$pdf->SetXY(80,$fila);
$pdf->Cell(40,5,$vol_exa.' cc',0);



$pdf->SetXY(93,$fila);
$pdf->Cell(40,5,'Viscosidad:',0);

//resultados
if($dis_visc<>'')
{ 
	$pdf->SetXY(115,$fila);
	$pdf->Cell(40,5,'Disminuida-  '. $dis_visc,0);
}

//$pdf->SetXY(130,$fila);
//$pdf->Cell(40,5,'Disminuida:',0);

//resultados
if($nor_visc<>'')
{ 
	$pdf->SetXY(115,$fila);
	$pdf->Cell(40,5,'Normal-  '. $nor_visc,0);
}
if($aum_visc<>'')
{
	$pdf->SetXY(115,$fila);
	$pdf->Cell(40,5,'Aumentada-  '. $aum_visc ,0);
}
/////////////////////////////////////////////////////////1�columna//////////////////////////////

$fila=increm($fila,$pdf,$cod,$num_ord);
$pdf->SetXY(15,$fila);
$pdf->Cell(40,5,'Filancia:',0);

$pdf->SetXY(35,$fila);
$pdf->Cell(40,5,$cc1_fila);

$pdf->SetXY(45,$fila);
$pdf->Cell(40,5,$cc3_fila);

$pdf->SetXY(55,$fila);
$pdf->Cell(40,5,$m3cc_fila );

$pdf->SetXY(65,$fila);
$pdf->Cell(40,5,$otro__fila);


$pdf->SetXY(93,$fila);
$pdf->Cell(40,5,'Licuefacion:',0);

$pdf->SetXY(118,$fila);
$pdf->Cell(40,5,$m_licu20.' �',0);

$pdf->SetXY(125,$fila);
$pdf->Cell(40,5,$m_licu30.' �',0);

$pdf->SetXY(135,$fila);
$pdf->Cell(40,5,$otro_licu.' �',0);

$fila=increm($fila,$pdf,$cod,$num_ord);
$pdf->SetXY(15,$fila);
$pdf->Cell(40,5,'DIRECTO',0);


$fila=increm($fila,$pdf,$cod,$num_ord);
$pdf->SetXY(15,$fila);
$pdf->Cell(40,5,'Leucocitos:');

//resultados

$pdf->SetXY(40,$fila);
$pdf->Cell(40,5,$leoco_dir.' xc',0);

//$pdf->SetXY(50,$fila);
//$pdf->Cell(40,5,'xc',0);

$pdf->SetXY(65,$fila);
$pdf->Cell(40,5,'Hematitis:',0);

//resultados

$pdf->SetXY(95,$fila);
$pdf->Cell(40,5,$hema_dir.' xc',0);


//$pdf->SetXY(105,$fila);
//$pdf->Cell(40,5,'xc',0);


$pdf->SetXY(125,$fila);
$pdf->Cell(40,5,'Bacterias:',0);

//resultados 

$pdf->SetXY(150,$fila);
$pdf->Cell(40,5,$bact_uno,0);

$fila=increm($fila,$pdf,$cod,$num_ord);
$pdf->SetXY(15,$fila);
$pdf->Cell(40,5,'Tricomonas:',0);

//resultados

$pdf->SetXY(40,$fila);
$pdf->Cell(40,5,$tri_mas,0);

$pdf->SetXY(50,$fila);
$pdf->Cell(40,5,$trim_menos,0);



$pdf->SetXY(65,$fila);
$pdf->Cell(40,5,'Koh:',0);

//resultados

$pdf->SetXY(75,$fila);
$pdf->Cell(40,5,$koh_mas,0);

$pdf->SetXY(80,$fila);
$pdf->Cell(40,5,$koh_menos,0);


//////////////////////////////////////////////////////////2� columna////////////////////////////////////////////


$fila=increm($fila+4,$pdf,$cod,$num_ord);
$pdf->SetXY(15,$fila);
$pdf->Cell(40,5,'MOVILIDAD',0);

$pdf->SetXY(50,$fila);
$pdf->Cell(40,5,'Moviles Progresivos:',0);

$pdf->SetXY(93,$fila);
$pdf->Cell(40,5,$movprog_mov.'%',0);

$pdf->SetXY(105,$fila);
$pdf->Cell(40,5,'Moviles Pendulantes:',0);

$pdf->SetXY(145,$fila);
$pdf->Cell(40,5,$movpend_mov.' %',0);

$pdf->SetXY(160,$fila);
$pdf->Cell(40,5,'Inmoviles:',0);

$pdf->SetXY(180,$fila);
$pdf->Cell(40,5,$inmo_mov.' %',0);

//////////////////////////////////////////////////////////2� columna////////////////////////////////////////////

$fila=increm($fila,$pdf,$cod,$num_ord);
$pdf->SetXY(15,$fila);
$pdf->Cell(40,5,'VITALIDAD',0);



$pdf->SetXY(65,$fila);
$pdf->Cell(40,5,'Vivos:',0);

$pdf->SetXY(77,$fila);
$pdf->Cell(40,5,$vivos_vit ,0);

$pdf->SetXY(89,$fila);
$pdf->Cell(40,5,'%',0);

$pdf->SetXY(110,$fila);
$pdf->Cell(40,5,'Muertos:',0);

$pdf->SetXY(128,$fila);
$pdf->Cell(40,5,$mue_vit,0);

$pdf->SetXY(145,$fila);
$pdf->Cell(40,5,'%',0);

/////////////////////////////////////////////////////////3 columna ///////////////////////////////

$fila=increm($fila,$pdf,$cod,$num_ord);
$pdf->SetXY(15,$fila);
$pdf->Cell(40,5,'RECUENTO ESPERMATICO:',0);

$pdf->SetXY(65,$fila);
$pdf->Cell(40,5,$recu_esperm.'/mm3',0);

$pdf->SetXY(95,$fila);
$pdf->Cell(40,5,' (vr 15 000.000 - 45 0000.000)',0);

////////////////////////////////////////////////////////////3� columna///////////////////////////////////////////////

$fila=increm($fila,$pdf,$cod,$num_ord);
$pdf->SetXY(15,$fila);
$pdf->Cell(40,5,'GRAM:',0);

$pdf->SetXY(65,$fila);
$pdf->Cell(40,5,'PMN  '. $x15c_gram,0);

$pdf->SetXY(90,$fila);
$pdf->Cell(40,5,'  '.$pmn0xc_gram,0);

/////////////////////////////////////////////////////////4� columna///////////////////////////////////////////////////
$fila=increm($fila,$pdf,$cod,$num_ord);
$pdf->SetXY(15,$fila);
$pdf->Cell(40,5,'WRIGTH',0);

$pdf->SetXY(65,$fila);
$pdf->Cell(40,5,'Neutrofilos:',0);

$pdf->SetXY(90,$fila);
$pdf->Cell(40,5,$neutr_wrig.' %',0);

$pdf->SetXY(110,$fila);
$pdf->Cell(40,5,'Linfoncitos:',0);

$pdf->SetXY(133,$fila);
$pdf->Cell(40,5,$linfo_wrig .' %',0);

/////////////////////////////////////////////////////////5� columna///////////////////////////////////////////////////

$fila=increm($fila,$pdf,$cod,$num_ord);
$pdf->SetXY(15,$fila);
$pdf->Cell(40,5,'MORFOLOGIA',0);

//titulo
$fila=increm($fila,$pdf,$cod,$num_ord);
$pdf->SetXY(15,$fila);
$pdf->Cell(40,5,'Normales:');

//resultados

$pdf->SetXY(35,$fila);
$pdf->Cell(40,5,$norm_morfo,0);

$pdf->SetXY(48,$fila);
$pdf->Cell(40,5,'%',0);
//titulo

$pdf->SetXY(65,$fila);
$pdf->Cell(40,5,'Microcefalos:',0);


$pdf->SetXY(93,$fila);
$pdf->Cell(40,5,$micro_morfo,0);

$pdf->SetXY(100,$fila);
$pdf->Cell(40,5,'%',0);

$pdf->SetXY(110,$fila);
$pdf->Cell(40,5,'Macrocefalos:',0);

//resultados 

$pdf->SetXY(139,$fila);
$pdf->Cell(40,5,$macro_morfo,0);


$pdf->SetXY(145,$fila);
$pdf->Cell(40,5,'%',0);

//resultados

$pdf->SetXY(155,$fila);
$pdf->Cell(40,5,'Enrollados:',0);


$pdf->SetXY(177,$fila);
$pdf->Cell(40,5,$enroll_morfo,0);


$pdf->SetXY(185,$fila);
$pdf->Cell(40,5,'%',0);

$fila=increm($fila,$pdf,$cod,$num_ord);
$pdf->SetXY(15,$fila);
$pdf->Cell(40,5,'Amorfos:',0);

$pdf->SetXY(35,$fila);
$pdf->Cell(40,5,$amorf_morfo,0);


$pdf->SetXY(48,$fila);
$pdf->Cell(40,5,'%',0);


$pdf->SetXY(65,$fila);
$pdf->Cell(40,5,'Sin Cabeza:',0);

$pdf->SetXY(93,$fila);
$pdf->Cell(40,5,$scabe_morfo ,0);


$pdf->SetXY(100,$fila);
$pdf->Cell(40,5,'%',0);


$pdf->SetXY(110,$fila);
$pdf->Cell(40,5,'Sin Cola:',0);

$pdf->SetXY(129,$fila);
$pdf->Cell(40,5,$scola_morfo,0);


$pdf->SetXY(140,$fila);
$pdf->Cell(40,5,'%',0);

$pdf->SetXY(155,$fila);
$pdf->Cell(40,5,'Doble Cabeza:',0);


$pdf->SetXY(185,$fila);
$pdf->Cell(40,5,$dcab_morfo,0);


$pdf->SetXY(190,$fila);
$pdf->Cell(40,5,'%',0);


//////////////////////////////////////////////////////////////6� COLUMNA//////////////////////////////////////

$fila=increm($fila+4,$pdf,$cod,$num_ord);
$pdf->SetXY(15,$fila);
$pdf->Cell(40,5,'Otros:');

//resultados
$pdf->SetXY(35,$fila);
$pdf->Cell(40,5,$otro_morfo,0);

}
}

//examenes  frotis Vaginal
$result4=mysql_query("SELECT `iden_dlab`, `cod_examen`, `fec_ent`, `fec_rec`, `cod_usu`, `ph`, `testaminas`, `koh`, `trichomava`, `pmn`, `celulasgui`, `levaduras`, `seudomicel`, `lactobacil`, `cocos`, `bacilos`, `cocobacilo`, `grampositi`, `gramnegati`, `granv`, 
`pmnxcamcer`, `diplointra`, `diploextra`, `observaciones` FROM `frotis` WHERE `iden_dlab`='$iden_labs'  AND `esta_ord`<>'EL'");
if(mysql_num_rows($result4)<>0)
{
while($rowxy= mysql_fetch_array($result4))

{
$ph =$rowxy["ph"];
$testaminas =$rowxy["testaminas"];
$koh =$rowxy["koh"];
$trichomava =$rowxy["trichomava"];
$pmn =$rowxy["pmn"];
$celulasgui =$rowxy["celulasgui"];
$levaduras =$rowxy["levaduras"];
$seudomicel =$rowxy["seudomicel"];
$lactobacil =$rowxy["lactobacil"];
$cocos =$rowxy["cocos"];
$bacilos =$rowxy["bacilos"];
$cocobacilo =$rowxy["cocobacilo"];
$grampositi =$rowxy["grampositi"];
$gramnegati =$rowxy["gramnegati"];
$granv =$rowxy["granv"];
$pmnxcamcer =$rowxy["pmnxcamcer"];
$diplointra =$rowxy["diplointra"];
$diploextra =$rowxy["diploextra"];
$observaciones =$rowxy["observaciones"];


//if de Frotis Vaginal
$fila=increm($fila,$pdf,$cod,$num_ord);
$pdf->SetXY(15,$fila);
$pdf->Cell(40,5,"______________________________________________________________________________________________________________________________________________",0);

$fila=increm($fila+2,$pdf,$cod,$num_ord);
$pdf->SetXY(80,$fila);
$pdf->Cell(40,5,"EXAMENES FROTIS VAGINAL ",0);

$pdf->SetXY(15,$fila);
$pdf->Cell(40,5,"______________________________________________________________________________________________________________________________________________",0);






////DETALLES DE LOS EXAMENES - LABORATORIO CLINICO 
$fila=increm($fila+2,$pdf,$cod,$num_ord);
//$pdf->SetFont('times','B',8);
$pdf->SetXY(15,$fila);
$pdf->Cell(40,5,'CARACTERISTICAS',0);

$fila=increm($fila,$pdf,$cod,$num_ord);
$pdf->SetXY(15,$fila);
$pdf->Cell(40,5,'FRESCO:',0);

$fila=increm($fila,$pdf,$cod,$num_ord);
$pdf->SetXY(15,$fila);
$pdf->Cell(40,5,'PH:',0);


//resultados

$pdf->SetXY(25,$fila);
$pdf->Cell(40,5,$ph,0);

//$pdf->SetXY(30,$fila);
//$pdf->Cell(40,5,'%',0);


$pdf->SetXY(40,$fila);
$pdf->Cell(40,5,'TEST DE AMINAS:',0);

//resultados

$pdf->SetXY(78,$fila);
$pdf->Cell(40,5,$testaminas,0);



$pdf->SetXY(100,$fila);
$pdf->Cell(40,5,'K.O.H:',0);

//resultados

$pdf->SetXY(115,$fila);
$pdf->Cell(40,5,$koh,0);


$pdf->SetXY(135,$fila);
$pdf->Cell(40,5,'TRICHOMA VAGINAL:',0);

//resultados

$pdf->SetXY(179,$fila);
$pdf->Cell(40,5,$trichomava ,0);


/////////////////////////////////////////////////////////1�columna//////////////////////////////
$fila=increm($fila,$pdf,$cod,$num_ord);

$pdf->SetXY(15,$fila);
$pdf->Cell(40,5,'GRAMA VAGINAL:',0);

$fila=increm($fila,$pdf,$cod,$num_ord);
$pdf->SetXY(15,$fila);
$pdf->Cell(40,5,'PMN (X CAMPO):',0);

//resultados

$pdf->SetXY(50,$fila);
$pdf->Cell(40,5,$pmn,0);

$pdf->SetXY(63,$fila);
$pdf->Cell(40,5,'XC',0);


$pdf->SetXY(73,$fila);
$pdf->Cell(40,5,'CELULAS GUIAS:',0);

//resultados

$pdf->SetXY(110,$fila);
$pdf->Cell(40,5,$celulasgui,0);


$pdf->SetXY(135,$fila);
$pdf->Cell(40,5,'LEVADURAS:',0);

//resultados

$pdf->SetXY(163,$fila);
$pdf->Cell(40,5,$levaduras,0);

$fila=increm($fila+2,$pdf,$cod,$num_ord);
$pdf->SetXY(15,$fila);
$pdf->Cell(40,5,'PSEUDOMICELIOS:',0);

//resultados

$pdf->SetXY(53,$fila);
$pdf->Cell(40,5,$seudomicel,0);

$pdf->SetXY(85,$fila);
$pdf->Cell(40,5,'LACTOBACILOS:',0);

//resultados

$pdf->SetXY(125,$fila);
$pdf->Cell(40,5,$lactobacil,0);


//////////////////////////////////////////////////////////2� columna////////////////////////////////////////////


$fila=increm($fila,$pdf,$cod,$num_ord);

$pdf->SetXY(15,$fila);
$pdf->Cell(40,5,'FLORA PREDOMINANTE:',0);

$fila=increm($fila,$pdf,$cod,$num_ord);
$pdf->SetXY(15,$fila);
$pdf->Cell(40,5,'MORFOLOGIA:',0);

//resultados

$pdf->SetXY(45,$fila);
$pdf->Cell(40,5,$cocos,0);

$pdf->SetXY(60,$fila);
$pdf->Cell(40,5,$bacilos,0);

$pdf->SetXY(75,$fila);
$pdf->Cell(40,5,$cocobacilo,0);

$pdf->SetXY(100,$fila);
$pdf->Cell(40,5,$grampositi,0);

$pdf->SetXY(125,$fila);
$pdf->Cell(40,5,$gramnegati,0);

$pdf->SetXY(155,$fila);
$pdf->Cell(40,5,$granv,0);



////////////////////////////////////////////////////////////3� columna///////////////////////////////////////////////


$fila=increm($fila,$pdf,$cod,$num_ord);
$pdf->SetXY(15,$fila);
$pdf->Cell(40,5,'GRAMA CERVICAL:',0);

$fila=increm($fila,$pdf,$cod,$num_ord);

$pdf->SetXY(15,$fila);
$pdf->Cell(40,5,'PMN (X CAMPO):',0);

//resultados

$pdf->SetXY(55,$fila);
$pdf->Cell(40,5,$pmnxcamcer,0);

$pdf->SetXY(68,$fila);
$pdf->Cell(40,5,'XC',0);
$fila=increm($fila,$pdf,$cod,$num_ord);
$pdf->SetXY(15,$fila);
$pdf->Cell(40,5,'DIPLOCOCOS GRAM NEGATIVOS INTRACELULARES:',0);

//resultados

$pdf->SetXY(130,$fila);
$pdf->Cell(40,5,$diplointra,0);

$fila=increm($fila,$pdf,$cod,$num_ord);
$pdf->SetXY(15,$fila);
$pdf->Cell(40,5,'DIPLOCOCOS GRAM NEGATIVA ESTRACELULARES:',0);

//resultados

$pdf->SetXY(130,$fila);
$pdf->Cell(40,5,$diploextra,0);



//////////////////////////////////////////////////////////////4� COLUMNA//////////////////////////////////////
$fila=increm($fila,$pdf,$cod,$num_ord);

$pdf->SetXY(15,$fila);
$pdf->Cell(40,5,'OBSERVACIONES:',0);


//resultados
$fila=increm($fila,$pdf,$cod,$num_ord);
$pdf->Cell(40,5,$observaciones,0);

}
}

//impresion de HCG
$result6=mysql_query("SELECT `iden_dlab`, `cod_examen`, `fec_rec`, `fec_ent`, `cod_usu`, `resul_exam`, `observaciones` FROM `hcg` WHERE `iden_dlab`='$iden_labs' AND `esta_ord`<>'EL' ");

if(mysql_num_rows($result6)<>0)
{
while($rowxxy= mysql_fetch_array($result6))

{
 $resul_exam =$rowxxy["resul_exam"];
 $observaciones =$rowxxy["observaciones"];

 
$fila=increm($fila,$pdf,$cod,$num_ord);
$pdf->SetXY(15,$fila);
$pdf->Cell(40,5,"______________________________________________________________________________________________________________________________________________",0);

$fila=increm($fila+2,$pdf,$cod,$num_ord);
$pdf->SetXY(80,$fila);
$pdf->Cell(40,5,"EXAMENES HCG MUJERES EN EMBARAZO",0);

$pdf->SetXY(15,$fila);
$pdf->Cell(40,5,"______________________________________________________________________________________________________________________________________________",0);

////DETALLES DE LOS EXAMENES - LABORATORIO CLINICO 
/////////////////////////////////////////////////////////1�columna//////////////////////////////
$fila=increm($fila+4,$pdf,$cod,$num_ord);
$pdf->SetXY(15,$fila);
$pdf->Cell(40,5,'CARACTERISTICAS',0);

$fila=increm($fila,$pdf,$cod,$num_ord);
$pdf->SetXY(15,$fila);
$pdf->Cell(40,5,'RESULTADOS:',0);


//resultados

$pdf->SetXY(55,$fila);
$pdf->Cell(40,5,$resul_exam,0);

$pdf->SetXY(90,$fila);
$pdf->Cell(40,5,'m UI/ml',0);

$fila=increm($fila,$pdf,$cod,$num_ord);
$pdf->SetXY(15,$fila);
$pdf->Cell(40,5,'SEMANA',0);
$pdf->SetFont('Arial','',7);
$cdeshcg=mysql_query("SELECT codi_des,nomb_des,valo_des FROM DESTIPOS WHERE codt_des='54' and val2_des='HCG'");
while($rowcdes=mysql_fetch_array($cdeshcg))
	{
			$valo_des=$rowcdes[valo_des];
			$nomb_des=$rowcdes[nomb_des];
			
			$fila=increm($fila,$pdf,$cod,$num_ord);
			$pdf->SetXY(15,$fila);
			$pdf->Cell(40,5,$valo_des,0);


			$pdf->SetXY(65,$fila);
			$pdf->multiCell(150,5,$nomb_des,0,'J');

			
	}
$fila=increm($fila,$pdf,$cod,$num_ord);
$pdf->SetFont('Arial','',9);
/*$pdf->SetXY(15,$fila);
$pdf->Cell(40,5,'4',0);

$pdf->SetXY(65,$fila);
$pdf->Cell(40,5,'196-3537',0);

$fila=increm($fila,$pdf,$cod,$num_ord);
$pdf->SetXY(15,$fila);
$pdf->Cell(40,5,'5',0);


$pdf->SetXY(65,$fila);
$pdf->Cell(40,5,'1026-30964',0);


//resultados
$fila=increm($fila,$pdf,$cod,$num_ord);
$pdf->SetXY(15,$fila);
$pdf->Cell(40,5,'6',0);

$pdf->SetXY(65,$fila);
$pdf->Cell(40,5,'4250-81172',0);

$fila=increm($fila,$pdf,$cod,$num_ord);
$pdf->SetXY(15,$fila);
$pdf->Cell(40,5,'7 - 8',0);

$pdf->SetXY(65,$fila);
$pdf->Cell(40,5,'6002-114430',0);

$fila=increm($fila,$pdf,$cod,$num_ord);
$pdf->SetXY(15,$fila);
$pdf->Cell(40,5,'9-10',0);


$pdf->SetXY(65,$fila);
$pdf->Cell(40,5,'18344-98807');

$fila=increm($fila,$pdf,$cod,$num_ord);
$pdf->SetXY(15,$fila);
$pdf->Cell(40,5,'11-14',0);

$pdf->SetXY(65,$fila);
$pdf->Cell(40,5,'21874-120766');

$fila=increm($fila,$pdf,$cod,$num_ord);
$pdf->SetXY(15,$fila);
$pdf->Cell(40,5,'15-22',0);

//resultados

$pdf->SetXY(65,$fila);
$pdf->Cell(40,5,'40106-57393',0);*/





//////////////////////////////////////////////////////////////4� COLUMNA//////////////////////////////////////
$fila=increm($fila,$pdf,$cod,$num_ord);
$pdf->SetXY(15,$fila);
$pdf->Cell(40,5,'OBSERVACIONES:',0);

//resultados
$pdf->SetXY(60,$fila);
$pdf->Cell(40,5,$observaciones,0);
}
}

/////////////////////////////////////////////////////////////////LIQUIDOS BIOLOGICOS/////////////
$result7=mysql_query("SELECT iden_dlab,
			clas_lqd , asp_lqd , colr_lqd , dens_lqd , gbla_lqd , groj_lqd , 
			norm_lqd , cren_lqd , ntro_lqd ,linf_lqd , mono_lqd , otro_lqd ,
			gram_lqd , ph_lqd,koh_lqd ,gluc_lqd,prot_lqd , ldho_lqd , otrs_lqd , obse_lqd 
			FROM labo_lqd WHERE iden_dlab='$iden_labs' AND `esta_ord`<>'EL'");

if(mysql_num_rows($result7)<>0)
{
while($rowz= mysql_fetch_array($result7))
{
$clas_lqd=$rowz["clas_lqd"];
$asp_lqd =$rowz["asp_lqd"];
$colr_lqd =$rowz["colr_lqd"];
$dens_lqd=$rowz["dens_lqd"];
$gbla_lqd =$rowz["gbla_lqd"];
$groj_lqd =$rowz["groj_lqd"];
$norm_lqd =$rowz["norm_lqd"];
$cren_lqd =$rowz["cren_lqd"];
$ntro_lqd =$rowz["ntro_lqd"];
$linf_lqd =$rowz["linf_lqd"];
$mono_lqd =$rowz["mono_lqd"];
$otro_lqd =$rowz["otro_lqd"];
$gram_lqd =$rowz["gram_lqd"];
$gluc_lqd =$rowz["gluc_lqd"];
$prot_lqd =$rowz["prot_lqd"];
$ldho_lqd =$rowz["ldho_lqd"];
$otrs_lqd =$rowz["otrs_lqd"];
$obse_lqd =$rowz["obse_lqd"];
$ph_lqd  =$rowz["ph_lqd"];
$koh_lqd =$rowz["koh_lqd"];


$fila=increm($fila+4,$pdf,$cod,$num_ord);
$pdf->SetXY(15,$fila);
$pdf->Cell(40,5,"______________________________________________________________________________________________________________________________________________",0);

$fila=increm($fila+2,$pdf,$cod,$num_ord);
$pdf->SetXY(80,$fila);
$pdf->Cell(40,5,"EXAMENES LIQUIDOS BIOLOGICOS ",0);

$pdf->SetXY(15,$fila);
$pdf->Cell(40,5,"______________________________________________________________________________________________________________________________________________",0);


////DETALLES DE LOS EXAMENES - LABORATORIO CLINICO 
$fila=increm($fila+2,$pdf,$cod,$num_ord);
$pdf->SetXY(15,$fila);
$pdf->Cell(40,5,"Clase de Liquido: ".$clas_lqd,0);


$pdf->SetXY(70,$fila);
$pdf->Cell(40,5,"Color: ".$colr_lqd,0);


$pdf->SetXY(110,$fila);
$pdf->Cell(40,5,"Aspectos: ".$asp_lqd,0);


$pdf->SetXY(170,$fila);
$pdf->Cell(40,5,"Densidad:".$dens_lqd,0);



/////////////////////////////////////////////////////////1�columna//////////////////////////////
///

$fila=increm($fila,$pdf,$cod,$num_ord);
$pdf->SetXY(15,$fila);
$pdf->Cell(40,5,"RECUENTO DE GLOBULOS",0);


//resultados
$fila=increm($fila,$pdf,$cod,$num_ord);
$pdf->SetXY(15,$fila);
$pdf->Cell(40,5,"R.Globulos Blancos: ".$gbla_lqd.' /mm�',0);

$pdf->SetXY(70,$fila);
$pdf->Cell(40,5,"R.Globulos Rojos: ".$groj_lqd.' /mm�',0);

$fila=increm($fila,$pdf,$cod,$num_ord);
$pdf->SetXY(15,$fila);
$pdf->Cell(40,5,"Normales: ".$norm_lqd.' %',0);

$pdf->SetXY(70,$fila);
$pdf->Cell(40,5,"Crenados: ".$cren_lqd.' %',0);



//////////////////////////////////////////////////////////2� columna////////////////////////////////////////////

$fila=increm($fila,$pdf,$cod,$num_ord);
$pdf->SetXY(15,$fila);
$pdf->Cell(40,5,"DIFERENCIALES",0);


$fila=increm($fila,$pdf,$cod,$num_ord);

$pdf->SetXY(15,$fila);
$pdf->Cell(40,5,"Neutrofilos: ".$ntro_lqd.' %',0);


$pdf->SetXY(60,$fila);
$pdf->Cell(40,5,"Linfoncitos: ".$linf_lqd.' %',0);

$pdf->SetXY(95,$fila);
$pdf->Cell(40,5,"Monocitos: ".$mono_lqd.' %',0);

$pdf->SetXY(160,$fila);
$pdf->Cell(40,5,"Otras Celulas: ".$otro_lqd.' %',0);

$fila=increm($fila,$pdf,$cod,$num_ord);
$pdf->SetXY(15,$fila);
$pdf->Cell(40,5,'Gram: '.$gram_lqd,0);

$fila=increm($fila,$pdf,$cod,$num_ord);
$pdf->SetXY(15,$fila);
$pdf->Cell(40,5,'PH: '.$ph_lqd,0);

$fila=increm($fila,$pdf,$cod,$num_ord);
$pdf->SetXY(15,$fila);
$pdf->Cell(40,5,'KOH: '.$koh_lqd,0);

$fila=increm($fila,$pdf,$cod,$num_ord);
$pdf->SetXY(15,$fila);
$pdf->Cell(40,5,'Glucosa: '.$gluc_lqd,0);

$pdf->SetXY(60,$fila);
$pdf->Cell(40,5,'Proteinas: '.$prot_lqd,0);

$pdf->SetXY(155,$fila);
$pdf->Cell(40,5,"LDH: ".$ldho_lqd,0);


$fila=increm($fila,$pdf,$cod,$num_ord);

$pdf->SetXY(15,$fila);
$pdf->multiCell(200,5,'Celulas indiferenciales: '.$otrs_lqd,0,'J');


$fila=increm($fila,$pdf,$cod,$num_ord);

$pdf->SetXY(15,$fila);
$pdf->multiCell(200,5,'Observaciones: '.$obse_lqd,0,'J');



}
}

//impresion de Examenes Uruanalisis
$result8=mysql_query("SELECT `iden_dla`, `cod_examen`, `fec_rec`, `fec_ent`, `ced_usu`, `aspectos`, `color`, `ph`, `densidad`, `albumina`, `valo_gluc`,`glucosa`, `cetonas`, `pigm_biliares`, `sangre`, `urobilinogeno`,`val_uru`, `nitritos`, `leucocitos`, `epiteliales`, `hermaties`,`valo_hem`,`cilidros`, `cristales`, `valo_cri`, `cris_uru2`,
`moco`,`esc2`, `levadura`, `bacterias`,`esc`, `tricomonas`, `obervaciones`, `alt`, `con`, `esp` FROM `uroana` where `iden_dla`='$iden_labs' AND ced_usu='$idcod' and esta_ord <>'EL'");
if(mysql_num_rows($result8)<>0)
{

while($rowr= mysql_fetch_array($result8))
{
$aspectos =$rowr["aspectos"]; 
$color =$rowr["color"];
$ph =$rowr["ph"];
$densidad =$rowr["densidad"];
$albumina=$rowr["albumina"]; 
$glucosa=$rowr["glucosa"];
$cetonas=$rowr["cetonas"];
$pigm_biliares =$rowr["pigm_biliares"];
$sangre=$rowr["sangre"];
$urobilinogeno =$rowr["urobilinogeno"]; 
$val_uru =$rowr["val_uru"];
$nitritos =$rowr["nitritos"];
$leucocitos =$rowr["leucocitos"];
$epiteliales =$rowr["epiteliales"]; 
$hermaties =$rowr["hermaties"];
$valo_hem =$rowr["valo_hem"];
$cilidros =$rowr["cilidros"]; 
$cristales =$rowr["cristales"];
$valo_cri =$rowr["valo_cri"];;
$cris_uru2=$rowr["cris_uru2"];;
$moco =$rowr["moco"];
$esc2 =$rowr["esc2"];
$levadura =$rowr["levadura"]; 
$bacterias =$rowr["bacterias"]; 
$esc =$rowr["esc"];
$tricomonas =$rowr["tricomonas"]; 
$obervaciones =$rowr["obervaciones"];
$con =$rowr["con"]; 
$esp =$rowr["esp"];
$alt =$rowr["alt"];
$valo_gluc=$rowr["valo_gluc"];



$fila=increm($fila+4,$pdf,$cod,$nd_);

$pdf->SetXY(15,$fila);
$pdf->Cell(40,5,"______________________________________________________________________________________________________________________________________________",0);

$fila=increm($fila+2,$pdf,$cod,$nd_);
$pdf->SetXY(80,$fila);
$pdf->Cell(40,5,"EXAMENES UROANALISIS",0);


$pdf->SetXY(15,$fila);
$pdf->Cell(40,5,"______________________________________________________________________________________________________________________________________________",0);


////DETALLES DE LOS EXAMENES - LABORATORIO CLINICO 

$fila=increm($fila+2,$pdf,$cod,$nd_);
$pdf->SetFont('Arial','',7);
$pdf->SetXY(15,$fila);
$pdf->Cell(40,5,"ASPECTO: " .$aspectos,0);

$pdf->SetFont('Arial','',7);
$pdf->SetXY(90,$fila);
$pdf->Cell(40,5,"LEUCOCITOS: ".$leucocitos." ul "." VN:0-4/ul",0);


$fila=increm($fila,$pdf,$cod,$nd_);
$pdf->SetFont('Arial','',7);
$pdf->SetXY(15,$fila);
$pdf->Cell(40,5,"COLOR: ".$color,0);

$pdf->SetFont('Arial','',7);
$pdf->SetXY(90,$fila);
$pdf->Cell(40,5,"C. EPITELIALES: ". $epiteliales ." ul ". $alt,0);

//resultados

$fila=increm($fila,$pdf,$cod,$nd_);
$pdf->SetFont('Arial','',7);
$pdf->SetXY(15,$fila);
$pdf->Cell(40,5,"PH: ".$ph,0);

//resultados


$pdf->SetFont('Arial','',7);
$pdf->SetXY(90,$fila);
$pdf->Cell(40,5,"HEMATIES: ". $hermaties."  ". $valo_hem." VN: 0 - 2/ul",0);

//resultados


$fila=increm($fila,$pdf,$cod,$nd_);
$pdf->SetFont('Arial','',7);
$pdf->SetXY(15,$fila);
$pdf->Cell(40,5,"DENSIDAD: ".$densidad,0);


$pdf->SetFont('Arial','',7);
$pdf->SetXY(90,$fila);
$pdf->Cell(40,5,"CILINDROS: ".$cilidros .' ul',0);


$fila=increm($fila,$pdf,$cod,$nd_);
$pdf->SetFont('Arial','',7);
$pdf->SetXY(15,$fila);
$pdf->Cell(40,5,"ALBUMINA: ".$albumina.' mg/dl',0);



////////////////////////////////////////////////////////////3? columna///////////////////////////////////////////////
$pdf->SetFont('Arial','',7);
$pdf->SetXY(90,$fila);
$pdf->Cell(40,5,"CRISTALES: ".$cristales." ".$cris_uru2." ".$valo_cri." "."/ul",0);
//reticulos


$fila=increm($fila,$pdf,$cod,$nd_);
$pdf->SetFont('Arial','',7);
$pdf->SetXY(15,$fila);
$pdf->Cell(40,5,"GLUCOSA: ".$valo_gluc." ".$glucosa." mg/dl",0);

//resultados

$pdf->SetFont('Arial','',7);
$pdf->SetXY(90,$fila);
$pdf->Cell(40,5,"MOCO: ". $moco." ".$esc2,0);



//////////////////////////////////////////////////////////////4? COLUMNA//////////////////////////////////////


$fila=increm($fila,$pdf,$cod,$nd_);
$pdf->SetFont('Arial','',7);
$pdf->SetXY(15,$fila);
$pdf->Cell(40,5,"CETONAS: ".$cetonas.' mg/dl',0);

$pdf->SetFont('Arial','',7);
$pdf->SetXY(90,$fila);
$pdf->Cell(40,5,"LEVADURAS: ".$levadura,0);


$fila=increm($fila,$pdf,$cod,$nd_);
$pdf->SetFont('Arial','',7);
$pdf->SetXY(15,$fila);
$pdf->Cell(40,5,"PIGMENTOS BILIARES: ".$pigm_biliares,0);


$pdf->SetFont('Arial','',7);
$pdf->SetXY(90,$fila);
$pdf->Cell(40,5,"BACTERIAS: ".$bacterias." ".$esc,0);



//////////////////////////////////////////////////5? columna///////////////////////////////////////////////////
$fila=increm($fila,$pdf,$cod,$nd_);
$pdf->SetFont('Arial','',7);
$pdf->SetXY(15,$fila);
$pdf->Cell(40,5,"SANGRE: ".$sangre." mg/dl",0);

$pdf->SetXY(90,$fila);
$pdf->SetFont('Arial','',7);
$pdf->Cell(40,5,"TRICOMONAS: ".$tricomonas,0);



/////////////////////////////////////////////ULTIMA COLUMNA
$fila=increm($fila,$pdf,$cod,$nd_);
$pdf->SetFont('Arial','',7);
$pdf->SetXY(15,$fila);
$pdf->Cell(40,5,"UROBILINOGENO: ".$urobilinogeno." ".$val_uru,0);



$fila=increm($fila,$pdf,$cod,$nd_);
$pdf->SetFont('Arial','',7);
$pdf->SetXY(15,$fila);
$pdf->Cell(40,5,"NITRITOS: ".$nitritos,0);


$fila=increm($fila,$pdf,$cod,$nd_);
$pdf->SetFont('Arial','',7);
$pdf->SetXY(15,$fila);
$pdf->Cell(40,5,"ESPERMATOZOIDES: ".$esp,0);


$fila=increm($fila,$pdf,$cod,$nd_);
$pdf->SetFont('Arial','',7);
$pdf->SetXY(15,$fila);
$pdf->Cell(40,5,"OBSERVACIONES: ".$obervaciones,0);


$fila=increm($fila,$pdf,$cod,$nd_);
$pdf->SetFont('Arial','',7);
$pdf->SetXY(15,$fila);
$pdf->Cell(40,5,"OTROS: ".$con,0);

}
}
//Impresion de inmunologia

$result9=mysql_query("SELECT `iden_dlab`,`inmu_rac`, `inmu_rau`, `inmu_pcc`, `inmu_pcu`, `inmu_asc`, `inmu_asu`, `inmu_tioc`, `inmu_tiou`, `inmu_tihc`, `inmu_tihu`, `inmu_pac`, `inmu_pau`, `inmu_pbc`,`inmu_pbu`,`inm_btc`, `inm_btu`, `inm_ptc`, `inm_ptu` FROM `labo_inm` where iden_dlab='$iden_labs' AND `esta_ord`<>'EL' ");
if(mysql_num_rows($result9)<>0)
{
while($rowx=mysql_fetch_array($result9))

{
	
	$inmu_rac=$rowx["inmu_rac"];
	$inmu_rau=$rowx["inmu_rau"];
	$inmu_pcc=$rowx["inmu_pcc"];
	$inmu_pcu=$rowx["inmu_pcu"];
	$inmu_asc=$rowx["inmu_asc"];
	$inmu_asu=$rowx["inmu_asu"];
	$inmu_tioc=$rowx["inmu_tioc"];
	$inmu_tiou=$rowx["inmu_tiou"];
	$inmu_tihc=$rowx["inmu_tihc"];
	$inmu_tihu=$rowx["inmu_tihu"];
	$inmu_pac=$rowx["inmu_pac"];
	$inmu_pau=$rowx["inmu_pau"];
	$inmu_pbc=$rowx["inmu_pbc"];
	$inmu_pbu=$rowx["inmu_pbu"];
	$inm_btc=$rowx["inm_btc"];
	$inm_btu=$rowx["inm_btu"];
	$inm_ptc=$rowx["inm_ptc"];
	$inm_ptu=$rowx["inm_ptu"];
	
			
//if de examenes Coprologicos
$fila=increm($fila+4,$pdf,$cod,$num_ord);

$pdf->SetXY(15,$fila);
$pdf->Cell(40,5,"______________________________________________________________________________________________________________________________________________",0);

$fila=increm($fila+2,$pdf,$cod,$num_ord);
$pdf->SetXY(80,$fila);
$pdf->Cell(40,5,"EXAMENES INMUNOLOGICOS",0);

$pdf->SetXY(15,$fila);
$pdf->Cell(40,5,"______________________________________________________________________________________________________________________________________________",0);


//////////////////////CARACTERISTICAS DE LOS EXAMENES DATOS INMUNOLOGICOS


$fila=increm($fila+2,$pdf,$cod,$num_ord);
$pdf->SetXY(15,$fila);
$pdf->Cell(40,5,'RA:',0);

//resultados

$pdf->SetXY(25,$fila);
$pdf->Cell(40,5,$inmu_rac,0);

//resultados

$pdf->SetXY(45,$fila);
$pdf->Cell(40,5,$inmu_rau,0);


$pdf->SetXY(55,$fila);
$pdf->Cell(40,5,'UI/ml',0);

//resultados

$pdf->SetXY(70,$fila);
$pdf->Cell(40,5,'PCR:',0);

$pdf->SetXY(82,$fila);
$pdf->Cell(40,5,$inmu_pcc,0);

$pdf->SetXY(105,$fila);
$pdf->Cell(40,5,$inmu_pcu,0);

$pdf->SetXY(118,$fila);
$pdf->Cell(40,5,'mg/L',0);

$pdf->SetXY(130,$fila);
$pdf->Cell(40,5,'ASTOS:',0);

$pdf->SetXY(150,$fila);
$pdf->Cell(40,5,$inmu_asc,0);

$pdf->SetXY(175,$fila);
$pdf->Cell(40,5,$inmu_asu,0);

/////////SEGUNDA FILA

$fila=increm($fila,$pdf,$cod,$num_ord);
$pdf->SetXY(15,$fila);
$pdf->Cell(40,5,'ANTIGENOS FEBRILES:',0);

//resultados
$fila=increm($fila,$pdf,$cod,$num_ord);
$pdf->SetXY(15,$fila);
$pdf->Cell(40,5,'Tifo O:' ,0);

$pdf->SetXY(30,$fila);
$pdf->Cell(40,5,$inmu_tioc,0);

$pdf->SetXY(50,$fila);
$pdf->Cell(40,5,$inmu_tiou,0);

$pdf->SetXY(65,$fila);
$pdf->Cell(40,5,'Tifo H:',0);

$pdf->SetXY(80,$fila);
$pdf->Cell(40,5,$inmu_tihc,0);

$pdf->SetXY(100,$fila);
$pdf->Cell(40,5,$inmu_tihu,0);

$fila=increm($fila,$pdf,$cod,$num_ord);

$pdf->SetXY(15,$fila);
$pdf->Cell(40,5,'Paratifo A:',0);

$pdf->SetXY(38,$fila);
$pdf->Cell(40,5,$inmu_pac,0);

$pdf->SetXY(60,$fila);
$pdf->Cell(40,5,$inmu_pau,0);


$pdf->SetXY(80,$fila);
$pdf->Cell(40,5,'Paratifo B:',0);

$pdf->SetXY(100,$fila);
$pdf->Cell(40,5,$inmu_pbc,0);

$pdf->SetXY(120,$fila);
$pdf->Cell(40,5,$inmu_pbu,0);

$fila=increm($fila,$pdf,$cod,$num_ord);

$pdf->SetXY(15,$fila);
$pdf->Cell(40,5,'Brucella abortus:',0);

$pdf->SetXY(50,$fila);
$pdf->Cell(40,5,$inm_btc,0);

$pdf->SetXY(70,$fila);
$pdf->Cell(40,5,$inm_btu,0);

$fila=increm($fila,$pdf,$cod,$num_ord);

$pdf->SetXY(15,$fila);
$pdf->Cell(40,5,'Proteus OX19:',0);


$pdf->SetXY(50,$fila);
$pdf->Cell(40,5,$inm_ptc,0);

$pdf->SetXY(70,$fila);
$pdf->Cell(40,5,$inm_ptu,0);

}
}

///impresion de bhc
$result10=mysql_query("SELECT `iden_dlab`, `lab_bhc` FROM `labo_bhc` where iden_dlab='$iden_labs' AND `esta_ord`<>'EL'  ");
if(mysql_num_rows($result10)<>0)
{
while($rowa=mysql_fetch_array($result10))

{
	
	$num_fac=$rowa["num_fac"];
	$lab_bhc=$rowa["lab_bhc"];
		
//if de examenes Coprologicos
$fila=increm($fila+4,$pdf,$cod,$num_ord);

$pdf->SetXY(15,$fila);
$pdf->Cell(40,5,"______________________________________________________________________________________________________________________________________________",0);

$fila=increm($fila+2,$pdf,$cod,$num_ord);
$pdf->SetXY(80,$fila);
$pdf->Cell(40,5,"EXAMENES BHCG",0);

$pdf->SetXY(15,$fila);
$pdf->Cell(40,5,"______________________________________________________________________________________________________________________________________________",0);


//////////////////////CARACTERISTICAS DE LOS EXAMENES DATOS COPROSCOPICOS


$fila=increm($fila+2,$pdf,$cod,$num_ord);
$pdf->SetXY(15,$fila);
$pdf->Cell(40,5,'Determinacion Cualitativa en suero de HORMONA GANADOTROPINA CORIONICA (HCG):',0);

//resultados
$fila=increm($fila+2,$pdf,$cod,$num_ord);
$pdf->SetXY(15,$fila);
$pdf->Cell(40,5,$lab_bhc,0);

//resultados

$pdf->SetXY(35,$fila);
$pdf->Cell(40,5,'mUI/ml ',0);

$fila=increm($fila,$pdf,$cod,$num_ord);
$pdf->SetXY(15,$fila);
$pdf->Cell(40,5,'Nota: ',0);

$fila=increm($fila,$pdf,$cod,$num_ord);
$pdf->SetXY(15,$fila);
$pdf->Cell(40,5,'Tecnica Microelisa rapida sensibilidad 25 mIU/ml',0);

}
}

///impresion de trimtropina
$result11=mysql_query("SELECT `iden_dlab`, `lab_trim` FROM `labo_tri`  WHERE `iden_dlab`='$iden_labs' AND `esta_ord`<>'EL' ");
if(mysql_num_rows($result11)<>0)
{
while($rowb=mysql_fetch_array($result11))

{
	
	$num_fac=$rowb["num_fac"];
	$lab_trim=$rowb["lab_trim"];
		
//if de examenes Coprologicos
$fila=increm($fila+4,$pdf,$cod,$num_ord);

$pdf->SetXY(15,$fila);
$pdf->Cell(40,5,"______________________________________________________________________________________________________________________________________________",0);

$fila=increm($fila+2,$pdf,$cod,$num_ord);
$pdf->SetXY(80,$fila);
$pdf->Cell(40,5,"EXAMENES TROPONINA",0);

$pdf->SetXY(15,$fila);
$pdf->Cell(40,5,"______________________________________________________________________________________________________________________________________________",0);


//////////////////////CARACTERISTICAS DE LOS EXAMENES DATOS COPROSCOPICOS


$fila=increm($fila+2,$pdf,$cod,$num_ord);
$pdf->SetXY(15,$fila);
$pdf->Cell(40,5,'Triponima I : ',0);

//resultados

$pdf->SetXY(45,$fila);
$pdf->Cell(40,5,$lab_trim,0);

//resultados

$pdf->SetXY(70,$fila);
$pdf->Cell(40,5,'Sensibilidad 1 ng / ml  ',0);

$fila=increm($fila,$pdf,$cod,$num_ord);
$pdf->SetXY(15,$fila);
$pdf->Cell(40,5,'Nota: ',0);

$fila=increm($fila,$pdf,$cod,$nd_);
$pdf->SetXY(15,$fila);
$pdf->Cell(40,5,'Hasta 0.034(Negativa) ng/ml',0);

$fila=increm($fila,$pdf,$cod,$nd_);
$pdf->SetXY(15,$fila);
$pdf->Cell(40,5,'Valor Critico  0.034 a 0.120 ng/ml / Metodo Quimioluminicencia',0);


}
}

$conotrex=mysql_query("SELECT `iden_loex`, `iden_dlab`, `num_fac`, `cod_loex`, `cod_usu`, `fec_recp`, `fec_entr`, `fsh_loex`, `obs_fsh`, `lsh_loex`, `obs_lsh`, `pgs_loex`, 
`obs_pgs`, `tst_loex`, `obs_tst`, `est_loex`, `obs_est`, `ige_loex`, `obs_ige`,`hgc_loex`,
`fnd_mcn`, `end_mcn`, `fni_mcn`, `eni_mcn`, `obs_mcn`,`khi_oex`,`khv_oex`,`esta_ord` 
FROM `labo_oexa` WHERE iden_dlab=$iden_labs AND `esta_ord`<>'EL'");

if(mysql_num_rows($conotrex)<>0)
{

	while($rowcot=mysql_fetch_array($conotrex))

	{	
		$cod_loex=$rowcot[cod_loex];
		$fsh_loex=$rowcot[fsh_loex];
		$obs_fsh= $rowcot[obs_fsh];
		$lsh_loex=$rowcot[lsh_loex]; 
		$obs_lsh= $rowcot[obs_lsh];
		$pgs_loex=$rowcot[pgs_loex]; 
		$obs_pgs= $rowcot[obs_pgs];
		$tst_loex=$rowcot[tst_loex];
		$obs_tst= $rowcot[obs_tst];
		$est_loex=$rowcot[est_loex];
		$obs_est= $rowcot[obs_est];
		$ige_loex=$rowcot[ige_loex]; 
		$obs_ige= $rowcot[obs_ige];
		$hgc_loex=$rowcot[obs_ige];
		
		$fnd_mcn=$rowcot[fnd_mcn];
		$end_mcn=$rowcot[end_mcn];
		$fni_mcn=$rowcot[fni_mcn];
		$eni_mcn=$rowcot[eni_mcn];
		$obs_mcn=$rowcot[obs_mcn];
		
		
		$khi_oex=$rowcot[khi_oex];
		$khv_oex=$rowcot[khv_oex];
		
		if($cod_loex=='904105')
		{
			
			$fila=increm($fila+4,$pdf,$cod,$num_ord);

			$pdf->SetXY(15,$fila);
			$pdf->Cell(40,5,"_________________________________________________________________________________________________",0);

			$fila=increm($fila+2,$pdf,$cod,$num_ord);
			$pdf->SetXY(80,$fila);
			$pdf->Cell(40,5,"HORMONA FOL�CULO ESTIMULANTE - FSH",0);

			$pdf->SetXY(15,$fila);
			$pdf->Cell(40,5,"_________________________________________________________________________________________________",0);

			
			$fila=increm($fila+2,$pdf,$cod,$num_ord);
			$pdf->SetXY(15,$fila);
			$pdf->Cell(40,5,'CARACTERISTICAS',0);

			$fila=increm($fila,$pdf,$cod,$num_ord);
			$pdf->SetXY(15,$fila);
			$pdf->Cell(40,5,'RESULTADOS: '.$fsh_loex,0);


			//resultados

			$fila=increm($fila,$pdf,$cod,$num_ord);
			$pdf->SetXY(15,$fila);
			$pdf->Cell(40,5,'Hombres: 1-14',0);

			$fila=increm($fila,$pdf,$cod,$num_ord);
			$pdf->SetXY(15,$fila);
			$pdf->Cell(40,5,'Mujeres',0);
			
			$fila=increm($fila,$pdf,$cod,$num_ord);
			$pdf->SetXY(15,$fila);
			$pdf->Cell(40,5,'Fase Folicular         3.0 - 12.0',0);

			$fila=increm($fila,$pdf,$cod,$num_ord);
			$pdf->SetXY(15,$fila);
			$pdf->Cell(40,5,'Fase Ovulatoria      8.0 - 22 - 0 ',0);

			
			$fila=increm($fila,$pdf,$cod,$num_ord);
			$pdf->SetXY(15,$fila);
			$pdf->Cell(40,5,'Fase Luteal             2 - 12',0);

			//resultados
			$fila=increm($fila,$pdf,$cod,$num_ord);
			$pdf->SetXY(15,$fila);
			$pdf->Cell(40,5,'Post Menopausia    35 - 181 ',0);

			
			$fila=increm($fila,$pdf,$cod,$num_ord);
			$pdf->SetXY(15,$fila);
			$pdf->multiCell(200,5,'OBSERVACIONES: '.$obs_fsh,0,'J');
		
		}
		
		if($cod_loex=='904107')
		{
			
			$fila=increm($fila+4,$pdf,$cod,$num_ord);

			$pdf->SetXY(15,$fila);
			$pdf->Cell(40,5,"_________________________________________________________________________________________________",0);

			$fila=increm($fila+2,$pdf,$cod,$num_ord);
			$pdf->SetXY(80,$fila);
			$pdf->Cell(40,5,"HORMONA LEUTERNIZANTE - LH",0);

			$pdf->SetXY(15,$fila);
			$pdf->Cell(40,5,"_________________________________________________________________________________________________",0);

			
			$fila=increm($fila+2,$pdf,$cod,$num_ord);
			$pdf->SetXY(15,$fila);
			$pdf->Cell(40,5,'CARACTERISTICAS',0);

			$fila=increm($fila,$pdf,$cod,$num_ord);
			$pdf->SetXY(15,$fila);
			$pdf->Cell(40,5,'RESULTADOS: '.$lsh_loex,0);


			//resultados

			$fila=increm($fila,$pdf,$cod,$num_ord);
			$pdf->SetXY(15,$fila);
			$pdf->Cell(40,5,'Hombres: 1.7 - 8.6',0);

			$fila=increm($fila,$pdf,$cod,$num_ord);
			$pdf->SetXY(15,$fila);
			$pdf->Cell(40,5,'Mujeres',0);
			
			$fila=increm($fila,$pdf,$cod,$num_ord);
			$pdf->SetXY(15,$fila);
			$pdf->Cell(40,5,'Fase Folicular         2.4 - 12 - 6',0);

			$fila=increm($fila,$pdf,$cod,$num_ord);
			$pdf->SetXY(15,$fila);
			$pdf->Cell(40,5,'Fase Ovulatoria      14 - 96 ',0);

			
			$fila=increm($fila,$pdf,$cod,$num_ord);
			$pdf->SetXY(15,$fila);
			$pdf->Cell(40,5,'Fase Luteal             1.0 - 11.4',0);

			//resultados
			$fila=increm($fila,$pdf,$cod,$num_ord);
			$pdf->SetXY(15,$fila);
			$pdf->Cell(40,5,'Post Menopausia    7.7 - 59 ',0);

			$fila=increm($fila,$pdf,$cod,$num_ord);
			$pdf->SetXY(15,$fila);
			$pdf->multiCell(200,5,'OBSERVACIONES: '.$obs_lsh,0,'J');
		}
		
		if($cod_loex=='904510')
		{
			$fila=increm($fila+4,$pdf,$cod,$num_ord);

			$pdf->SetXY(15,$fila);
			$pdf->Cell(40,5,"_________________________________________________________________________________________________",0);

			$fila=increm($fila+2,$pdf,$cod,$num_ord);
			$pdf->SetXY(80,$fila);
			$pdf->Cell(40,5,"PROGESTERONA",0);

			$pdf->SetXY(15,$fila);
			$pdf->Cell(40,5,"_________________________________________________________________________________________________",0);

			
			$fila=increm($fila+2,$pdf,$cod,$num_ord);
			$pdf->SetXY(15,$fila);
			$pdf->Cell(40,5,'CARACTERISTICAS',0);

			$fila=increm($fila,$pdf,$cod,$num_ord);
			$pdf->SetXY(15,$fila);
			$pdf->Cell(40,5,'RESULTADOS: '.$pgs_loex,0);


			//resultados

			$fila=increm($fila,$pdf,$cod,$num_ord);
			$pdf->SetXY(15,$fila);
			$pdf->Cell(40,5,'Hombres: 0.2 - 1.4',0);

			$fila=increm($fila,$pdf,$cod,$num_ord);
			$pdf->SetXY(15,$fila);
			$pdf->Cell(40,5,'Mujeres',0);
			
			$fila=increm($fila,$pdf,$cod,$num_ord);
			$pdf->SetXY(15,$fila);
			$pdf->Cell(40,5,'Fase Folicular         0.2 - 1.5 ',0);

			$fila=increm($fila,$pdf,$cod,$num_ord);
			$pdf->SetXY(15,$fila);
			$pdf->Cell(40,5,'Fase Ovulatoria      0.8 - 3.0 ',0);

			
			$fila=increm($fila,$pdf,$cod,$num_ord);
			$pdf->SetXY(15,$fila);
			$pdf->Cell(40,5,'Fase Luteal             1.7 - 2.7',0);

			//resultados
			$fila=increm($fila,$pdf,$cod,$num_ord);
			$pdf->SetXY(15,$fila);
			$pdf->Cell(40,5,'Post Menopausia    0.1 -0.8 ',0);

			$fila=increm($fila,$pdf,$cod,$num_ord);
			$pdf->SetXY(15,$fila);
			$pdf->multiCell(200,5,'OBSERVACIONES: '.$obs_pgs,0,'J');
		
		}
		
		if($cod_loex=='904601')
		{
			$fila=increm($fila+4,$pdf,$cod,$num_ord);

			$pdf->SetXY(15,$fila);
			$pdf->Cell(40,5,"_________________________________________________________________________________________________",0);

			$fila=increm($fila+2,$pdf,$cod,$num_ord);
			$pdf->SetXY(80,$fila);
			$pdf->Cell(40,5,"TESTOSTERONA",0);

			$pdf->SetXY(15,$fila);
			$pdf->Cell(40,5,"_________________________________________________________________________________________________",0);

			
			$fila=increm($fila+2,$pdf,$cod,$num_ord);
			$pdf->SetXY(15,$fila);
			$pdf->Cell(40,5,'CARACTERISTICAS',0);

			$fila=increm($fila,$pdf,$cod,$num_ord);
			$pdf->SetXY(15,$fila);
			$pdf->Cell(40,5,'RESULTADOS: '.$tst_loex,0);


			//resultados

			$fila=increm($fila,$pdf,$cod,$num_ord);
			$pdf->SetXY(15,$fila);
			$pdf->Cell(40,5,'Hombres: 2.8 - 8.0',0);

			$fila=increm($fila,$pdf,$cod,$num_ord);
			$pdf->SetXY(15,$fila);
			$pdf->Cell(40,5,'Mujeres: 0.06 - 0.82',0);
			
			$fila=increm($fila,$pdf,$cod,$num_ord);
			$pdf->SetXY(15,$fila);
			$pdf->Cell(40,5,'1 A�o              0.12 - 0.21  ',0);

			$fila=increm($fila,$pdf,$cod,$num_ord);
			$pdf->SetXY(15,$fila);
			$pdf->Cell(40,5,'1 - 6 A�os       0.03 - 0.32 ',0);

			
			$fila=increm($fila,$pdf,$cod,$num_ord);
			$pdf->SetXY(15,$fila);
			$pdf->Cell(40,5,'7 - 12 A�os     0.03 - 0.68',0);

			//resultados
			$fila=increm($fila,$pdf,$cod,$num_ord);
			$pdf->SetXY(15,$fila);
			$pdf->Cell(40,5,'13 - 17 A�os   0.28 - 11.1 ',0);

			$fila=increm($fila,$pdf,$cod,$num_ord);
			$pdf->SetXY(15,$fila);
			$pdf->multiCell(200,5,'OBSERVACIONES: '.$obs_tst,0,'J');
		
		}
		
		if($cod_loex=='904503')
		{
			$fila=increm($fila+4,$pdf,$cod,$num_ord);

			$pdf->SetXY(15,$fila);
			$pdf->Cell(40,5,"_________________________________________________________________________________________________",0);

			$fila=increm($fila+2,$pdf,$cod,$num_ord);
			$pdf->SetXY(80,$fila);
			$pdf->Cell(40,5,"ESTRADIOL",0);

			$pdf->SetXY(15,$fila);
			$pdf->Cell(40,5,"_________________________________________________________________________________________________",0);

			
			$fila=increm($fila+2,$pdf,$cod,$num_ord);
			$pdf->SetXY(15,$fila);
			$pdf->Cell(40,5,'CARACTERISTICAS',0);

			$fila=increm($fila,$pdf,$cod,$num_ord);
			$pdf->SetXY(15,$fila);
			$pdf->Cell(40,5,'RESULTADOS: '.$est_loex,0);


			//resultados

			$fila=increm($fila,$pdf,$cod,$num_ord);
			$pdf->SetXY(15,$fila);
			$pdf->Cell(40,5,'Hombres: 7.63 - 42.6',0);

			$fila=increm($fila,$pdf,$cod,$num_ord);
			$pdf->SetXY(15,$fila);
			$pdf->Cell(40,5,'Mujeres: 0.06 - 0.82',0);
			
			$fila=increm($fila,$pdf,$cod,$num_ord);
			$pdf->SetXY(15,$fila);
			$pdf->Cell(40,5,'Mujeres',0);
			
			$fila=increm($fila,$pdf,$cod,$num_ord);
			$pdf->SetXY(15,$fila);
			$pdf->Cell(40,5,'Fase Folicular         12.5 - 166',0);

			$fila=increm($fila,$pdf,$cod,$num_ord);
			$pdf->SetXY(15,$fila);
			$pdf->Cell(40,5,'Fase Ovulatoria      85.5 - 498',0);

			
			$fila=increm($fila,$pdf,$cod,$num_ord);
			$pdf->SetXY(15,$fila);
			$pdf->Cell(40,5,'Fase Luteal             43.8 - 211',0);

			//resultados
			$fila=increm($fila,$pdf,$cod,$num_ord);
			$pdf->SetXY(15,$fila);
			$pdf->Cell(40,5,'Post Menopausia    <50 -547',0);

			$fila=increm($fila,$pdf,$cod,$num_ord);
			$pdf->SetXY(15,$fila);
			$pdf->multiCell(200,5,'OBSERVACIONES: '.$obs_est,0,'J');
			
		}
		
		if($cod_loex=='906446')
		{
		
			$fila=increm($fila+4,$pdf,$cod,$num_ord);

			$pdf->SetXY(15,$fila);
			$pdf->Cell(40,5,"_________________________________________________________________________________________________",0);

			$fila=increm($fila+2,$pdf,$cod,$num_ord);
			$pdf->SetXY(80,$fila);
			$pdf->Cell(40,5,"INMUNOGLOBULINA  - IgE",0);

			$pdf->SetXY(15,$fila);
			$pdf->Cell(40,5,"_________________________________________________________________________________________________",0);

			
			$fila=increm($fila+2,$pdf,$cod,$num_ord);
			$pdf->SetXY(15,$fila);
			$pdf->Cell(40,5,'CARACTERISTICAS',0);

			$fila=increm($fila,$pdf,$cod,$num_ord);
			$pdf->SetXY(15,$fila);
			$pdf->Cell(40,5,'RESULTADOS: '.$ige_loex,0);


			//resultados

			$fila=increm($fila,$pdf,$cod,$num_ord);
			$pdf->SetXY(15,$fila);
			$pdf->Cell(40,5,'Hombres: 2.8 - 8.0',0);

			$fila=increm($fila,$pdf,$cod,$num_ord);
			$pdf->SetXY(15,$fila);
			$pdf->Cell(40,5,'Neonatos: Hasta 1.5',0);
			
			$fila=increm($fila,$pdf,$cod,$num_ord);
			$pdf->SetXY(15,$fila);
			$pdf->Cell(40,5,'1 A�o                  Hasta 15',0);
			
			$fila=increm($fila,$pdf,$cod,$num_ord);
			$pdf->SetXY(15,$fila);
			$pdf->Cell(40,5,'1 - 5 A�os           Hasta 60',0);

			$fila=increm($fila,$pdf,$cod,$num_ord);
			$pdf->SetXY(15,$fila);
			$pdf->Cell(40,5,'6 - 9 A�os           Hasta 90',0);

			
			$fila=increm($fila,$pdf,$cod,$num_ord);
			$pdf->SetXY(15,$fila);
			$pdf->Cell(40,5,'10 - 15 A�os       Hasta 200',0);

			//resultados
			$fila=increm($fila,$pdf,$cod,$num_ord);
			$pdf->SetXY(15,$fila);
			$pdf->Cell(40,5,'Adultos               Hasta 100',0);

			$fila=increm($fila,$pdf,$cod,$num_ord);
			$pdf->SetXY(15,$fila);
			$pdf->multiCell(200,5,'OBSERVACIONES: '.$obs_ige,0,'J');
	
		}
		if($cod_loex=='903427')
		{
		
			$fila=increm($fila+4,$pdf,$cod,$num_ord);

			$pdf->SetXY(15,$fila);
			$pdf->Cell(40,5,"_________________________________________________________________________________________________",0);

			$fila=increm($fila+2,$pdf,$cod,$num_ord);
			$pdf->SetXY(80,$fila);
			$pdf->Cell(40,5,"HEMOGLOBINA GLICOSILADA",0);

			$pdf->SetXY(15,$fila);
			$pdf->Cell(40,5,"_________________________________________________________________________________________________",0);

			
			$fila=increm($fila+2,$pdf,$cod,$num_ord);
			$pdf->SetXY(15,$fila);
			$pdf->Cell(40,5,'CARACTERISTICAS',0);


			//resultados

			$fila=increm($fila,$pdf,$cod,$num_ord);
			$pdf->SetXY(15,$fila);
			$pdf->Cell(40,5,'NO DIABETICOS: 4.0 - 6.0',0);

			$fila=increm($fila,$pdf,$cod,$num_ord);
			$pdf->SetXY(15,$fila);
			$pdf->Cell(40,5,'OBJETIVO: 6.0 - 6.5',0);
			
			
			$fila=increm($fila,$pdf,$cod,$num_ord);
			$pdf->SetXY(15,$fila);
			$pdf->Cell(40,5,'BUEN CONTROL:  6.5 - 8.0',0);

			$fila=increm($fila,$pdf,$cod,$num_ord);
			$pdf->SetXY(15,$fila);
			$pdf->Cell(40,5,'PRECISA ACTUACION: >8.0',0);

		}
		
	if($cod_loex=='902219')
		{
		
			$fila=increm($fila+4,$pdf,$cod,$num_ord);

			$pdf->SetXY(15,$fila);
			$pdf->Cell(40,5,"_________________________________________________________________________________________________",0);

			$fila=increm($fila+2,$pdf,$cod,$num_ord);
			$pdf->SetXY(80,$fila);
			$pdf->Cell(40,5,"EOSINOFILOS - MOCO NASAL",0);

			$pdf->SetXY(15,$fila);
			$pdf->Cell(40,5,"_________________________________________________________________________________________________",0);

			//resultados

			$fila=increm($fila+2,$pdf,$cod,$num_ord);
			$pdf->SetXY(15,$fila);
			$pdf->Cell(40,5,'Fosa Nasal Derecha:    '.$fnd_mcn.'               Reaccion Leucocitaria',0);
			
			$fila=increm($fila,$pdf,$cod,$num_ord);
			$pdf->SetXY(15,$fila);
			$pdf->Cell(40,5,'Eosinofolos:  '.$end_mcn.'%',0);
			
			$fila=increm($fila,$pdf,$cod,$num_ord);
			$pdf->SetXY(15,$fila);
			$pdf->Cell(40,5,'Fosa Nasal Izquierda:   '.$fni_mcn.'  		           Reaccion Leucocitaria',0);
			
			
			$fila=increm($fila,$pdf,$cod,$num_ord);
			$pdf->SetXY(15,$fila);
			$pdf->Cell(40,5,'Eosinofolos:  '.$eni_mcn.'%',0);

			$fila=increm($fila,$pdf,$cod,$num_ord);
			$pdf->SetXY(15,$fila);
			$pdf->multiCell(200,5,'Observaciones: '.$obs_mcn,0,'J');

		}
		if($cod_loex=='901305')
		{
			$fila=increm($fila+4,$pdf,$cod,$num_ord);

			$pdf->SetXY(15,$fila);
			$pdf->Cell(40,5,"_________________________________________________________________________________________________",0);

			$fila=increm($fila+2,$pdf,$cod,$num_ord);
			$pdf->SetXY(80,$fila);
			$pdf->Cell(40,5,"KOH - EXAMEN DIRECTO PARA HONGOS",0);

			$pdf->SetXY(15,$fila);
			$pdf->Cell(40,5,"_________________________________________________________________________________________________",0);

			//resultados

			$fila=increm($fila+2,$pdf,$cod,$num_ord);
			$pdf->SetXY(15,$fila);
			$pdf->Cell(40,5,'Tipo de Muestra:    '.$khi_oex,0);
			
			if($khv_oex==1)
			{
				$fila=increm($fila+2,$pdf,$cod,$num_ord);
				$pdf->SetXY(15,$fila);
				$pdf->Cell(40,5,'Positivo Para Estructuras Micoticas',0);
			}
			else
			{
				$fila=increm($fila+2,$pdf,$cod,$num_ord);
				$pdf->SetXY(15,$fila);
				$pdf->Cell(40,5,'Negativo Para Estructuras Micoticas',0);
			
			
			}
		}
		
		if($cod_loex=='904903')
		{
		
			$cdes=mysql_query("SELECT codi_des,nomb_des FROM DESTIPOS WHERE codi_des='5401'");
			$rowcdes=mysql_fetch_array($cdes);
			$tecnica=$rowcdes[nomb_des];
		
			$fila=increm($fila+4,$pdf,$cod,$num_ord);

			$pdf->SetXY(15,$fila);
			$pdf->Cell(40,5,"_________________________________________________________________________________________________",0);

			$fila=increm($fila+2,$pdf,$cod,$num_ord);
			$pdf->SetXY(80,$fila);
			$pdf->Cell(40,5,"TSH NEONATAL",0);

			$pdf->SetXY(15,$fila);
			$pdf->Cell(40,5,"_________________________________________________________________________________________________",0);

			
			$fila=increm($fila+2,$pdf,$cod,$num_ord);
			$pdf->SetXY(15,$fila);
			$pdf->Cell(40,5,'CARACTERISTICAS',0);


			//resultados

			$fila=increm($fila,$pdf,$cod,$num_ord);
			$pdf->SetXY(15,$fila);
			$pdf->multiCell(200,5,$tecnica,0,'J');

			/*$fila=increm($fila,$pdf,$cod,$num_ord);
			$pdf->SetXY(15,$fila);
			$pdf->Cell(40,5,'TECNICA: MICROELISA ',0);
			
			
			$fila=increm($fila,$pdf,$cod,$num_ord);
			$pdf->SetXY(15,$fila);
			$pdf->Cell(40,5,'LOTE DE REACTIVO: WV704/A',0);

			$fila=increm($fila,$pdf,$cod,$num_ord);
			$pdf->SetXY(15,$fila);
			$pdf->Cell(40,5,'FECHA DE VENCIMIENTO: 18-01-2012',0);*/

		}
		
		if($cod_loex=='906610')
		{
			$fila=increm($fila+4,$pdf,$cod,$num_ord);

			$pdf->SetXY(15,$fila);
			$pdf->Cell(40,5,"_________________________________________________________________________________________________",0);

			$fila=increm($fila+2,$pdf,$cod,$num_ord);
			$pdf->SetXY(80,$fila);
			$pdf->Cell(40,5,"ANTIGENO PROSTATICO ESPECIFICO",0);

			$pdf->SetXY(15,$fila);
			$pdf->Cell(40,5,"_________________________________________________________________________________________________",0);

			//resultados

			
			$fila=increm($fila,$pdf,$cod,$num_ord);
			$pdf->SetXY(15,$fila+2);
			$pdf->Cell(40,5,'Hombres 35 - 40 A�os: 0.5 - 1.3 ng/ml',0);

			$fila=increm($fila,$pdf,$cod,$num_ord);
			$pdf->SetXY(15,$fila+2);
			$pdf->Cell(40,5,'Hombres 46 - 55 A�os: 0.6 - 2.1 ng/ml',0);
			
			$fila=increm($fila,$pdf,$cod,$num_ord);
			$pdf->SetXY(15,$fila+2);
			$pdf->Cell(40,5,'Hombres 56 - 65 A�os: 0.7 - 3.2 ng/ml',0);
                        
			$fila=increm($fila,$pdf,$cod,$num_ord);
			$pdf->SetXY(15,$fila+2);
			$pdf->Cell(40,5,'Hombres 65 - 81 A�os: 1.3 - 6.4 ng/ml',0);

			
		}
		if($cod_loex=='E904004')
		{
			$fila=increm($fila+4,$pdf,$cod,$num_ord);

			$pdf->SetXY(15,$fila);
			$pdf->Cell(40,5,"_________________________________________________________________________________________________",0);

			$fila=increm($fila+2,$pdf,$cod,$num_ord);
			$pdf->SetXY(80,$fila);
			$pdf->Cell(40,5,"PEPTIDO NATRIURETICO CEREBRAL (BNP)",0);

			$pdf->SetXY(15,$fila);
			$pdf->Cell(40,5,"_________________________________________________________________________________________________",0);

			//resultados

			
			$fila=increm($fila,$pdf,$cod,$num_ord);
			$pdf->SetXY(15,$fila+2);
			$pdf->Cell(40,5,'Menos de 50 A�os: 450 pg/ml',0);

			$fila=increm($fila,$pdf,$cod,$num_ord);
			$pdf->SetXY(15,$fila+2);
			$pdf->Cell(40,5,'De 50 A�os: 900 pg/ml',0);
			
			$fila=increm($fila,$pdf,$cod,$num_ord);
			$pdf->SetXY(15,$fila+2);
			$pdf->Cell(40,5,'Mayores 75 A�os: 1800 pg/ml',0);
                        
			
			
		}
	
	}
}
$result20=mysql_query("SELECT `iden_dlab`, `gbl_esp`, `nume_esp`,`nnom_esp`,`hip_esp`, 
`ani_esp`, `mcr_esp`, `mic_esp`, `pqu_esp`, `dic_esp`, `esq_esp`, `otr_mcn`, `org_esp`, `poli_esp`, `obsv_esp`, `esta_esp`,`pla_esp`, `plaq_esp`
FROM `labo_sgre` WHERE `iden_dlab`='$iden_labs'  AND `esta_esp`<>'EL'");
if(mysql_num_rows($result20)<>0)
{
while($rowsgr= mysql_fetch_array($result20))

{
	$gbl_esp=$rowsgr["gbl_esp"];
	$nume_esp=$rowsgr["nume_esp"];
	$hip_esp=$rowsgr["hip_esp"];
	$ani_esp=$rowsgr["ani_esp"];
	$mcr_esp=$rowsgr["mcr_esp"];
	$mic_esp=$rowsgr["mic_esp"];
	$pqu_esp=$rowsgr["pqu_esp"];
	$dic_esp=$rowsgr["dic_esp"];
	$esq_esp=$rowsgr["esq_esp"];
	$otr_mcn=$rowsgr["otr_mcn"];
	$org_esp=$rowsgr["org_esp"];
	$poli_esp=$rowsgr["poli_esp"];
	$obsv_esp=$rowsgr["obsv_esp"];
	$nnom_esp=$rowsgr["nnom_esp"];
	$pla_esp=$rowsgr["pla_esp"];
	$plaq_esp=$rowsgr["plaq_esp"];

	$fila=increm($fila+4,$pdf,$cod,$num_ord);

	$pdf->SetXY(15,$fila);
	$pdf->Cell(40,5,"_________________________________________________________________________________________________",0);

	$fila=increm($fila+2,$pdf,$cod,$num_ord);
	$pdf->SetXY(80,$fila);
	$pdf->Cell(40,5,"EXTENDIDO DE SANGRE PERIFERICA",0);

	$pdf->SetXY(15,$fila);
	$pdf->Cell(40,5,"_________________________________________________________________________________________________",0);

	//resultados

	$fila=increm($fila+2,$pdf,$cod,$num_ord);
	$pdf->SetXY(15,$fila);
	$pdf->Cell(40,5,'Globulos Blancos',0);
	
	$fila=increm($fila,$pdf,$cod,$num_ord);
	$pdf->SetXY(15,$fila);
	$pdf->Cell(40,5,''.$gbl_esp. ' ' .$nume_esp,0);

	$fila=increm($fila+2,$pdf,$cod,$num_ord);
	$pdf->SetXY(15,$fila);
	$pdf->Cell(40,5,'Globulos Rojos:',0);
	
	if($nnom_esp=='1')
	{
		$fila=increm($fila,$pdf,$cod,$num_ord);
		$pdf->SetXY(15,$fila);
		$pdf->Cell(40,5,'Normociticos Normocromicos',0);
		
		
	}
	else
	{
			if(!empty($hip_esp))
			{
				$fila=increm($fila,$pdf,$cod,$num_ord);
				$pdf->SetXY(15,$fila);
				$pdf->Cell(40,5,'Hipocromia:   '.$hip_esp,0);
			}
			
			if(!empty($ani_esp))
			{
				$fila=increm($fila,$pdf,$cod,$num_ord);
				$pdf->SetXY(15,$fila);
				$pdf->Cell(40,5,'Anisocitosis:  '.$ani_esp,0);
			}
			if(!empty($mcr_esp))
			{
				$fila=increm($fila,$pdf,$cod,$num_ord);
				$pdf->SetXY(55,$fila);
				$pdf->Cell(40,5,'Con Macrocitocis  '.$mcr_esp,0);
			}
			if(!empty($mic_esp))
			{
				$fila=increm($fila,$pdf,$cod,$num_ord);
				$pdf->SetXY(55,$fila);
				$pdf->Cell(40,5,'Con Microcitocis: '.$mic_esp,0);
			
			}
			/*else
			{
				if($mcr_esp=='')
				{
					$fila=increm($fila,$pdf,$cod,$num_ord);
					$pdf->SetXY(55,$fila);
					$pdf->Cell(40,5,'Con Microcitos: '.$mic_esp,0);
				}
			
				if($mic_esp=='')
				{
					$fila=increm($fila,$pdf,$cod,$num_ord);
					$pdf->SetXY(55,$fila);
					$pdf->Cell(40,5,'Con Macrocitos  '.$mcr_esp,0);
				
				
				}
			}*/
			
			
			if(!empty($pqu_esp))
			{
				$fila=increm($fila,$pdf,$cod,$num_ord);
				$pdf->SetXY(15,$fila);
				$pdf->Cell(40,5,'Poiquilocitosis:  '.$pqu_esp,0);
			}
			
			if((!empty($dic_esp)) AND (!empty($esq_esp)) AND (!empty($otr_mcn)) AND !empty($org_esp))
			{
				$fila=increm($fila,$pdf,$cod,$num_ord);
				$pdf->SetXY(55,$fila);
				$pdf->Cell(40,5,'Con Dianocitos:  '.$dic_esp.'          Con Esquistocitos: '.$esq_esp.'          Con:  '.$otr_mcn.'     '.$org_esp,0);
			}
				
			if(!empty($poli_esp))
			{			
				$fila=increm($fila,$pdf,$cod,$num_ord);
				$pdf->SetXY(15,$fila);
				$pdf->Cell(40,5,'Policromatofilia:   '.$poli_esp,0);
			
			}

	}
			$fila=increm($fila+2,$pdf,$cod,$num_ord);
			$pdf->SetXY(15,$fila);
			$pdf->Cell(40,5,'Plaquetas ',0);
			
			$fila=increm($fila,$pdf,$cod,$num_ord);
			$pdf->SetXY(15,$fila);
			$pdf->Cell(40,5,''.$pla_esp. '    ' .$plaq_esp,0);
	

			$fila=increm($fila+2,$pdf,$cod,$num_ord);
			$pdf->SetXY(15,$fila);
			$pdf->multiCell(200,5,'Observaciones: '.$obsv_esp,0,'J');


     	}
	

	}
/////////////////////////////////////////////////Alcohol Resistente
	
	$res_alc=mysql_query("SELECT `iden_dlab` ,`tipo_mue` ,`num_mue` , `esta_mue` , `valo_mue`,`est_oex2` 
	FROM labo_oex2 WHERE `iden_dlab`='$iden_labs'  AND `est_oex2`<>'EL' AND `cod_exam`='901101' ORDER BY `num_mue` ASC");
	
		
	if(mysql_num_rows($res_alc)<>0)
	{
		$cant=mysql_num_rows($res_alc);
		
		$fila=increm($fila+4,$pdf,$cod,$num_ord);

			$pdf->SetXY(15,$fila);
			$pdf->Cell(40,5,"_________________________________________________________________________________________________",0);

			$fila=increm($fila+2,$pdf,$cod,$num_ord);
			$pdf->SetXY(80,$fila);
			$pdf->Cell(40,5,"COLORACION ACIDO ALCOHOL RESISTENTE",0);

			$pdf->SetXY(15,$fila);
			$pdf->Cell(40,5,"_________________________________________________________________________________________________",0);

		while($rowalc= mysql_fetch_array($res_alc))
		{
			$tipo_mue=$rowalc["tipo_mue"];
			$num_mue=$rowalc["num_mue"];
			$esta_mue=$rowalc["esta_mue"];
			$valo_mue=$rowalc["valo_mue"];
		
						
			$fila=increm($fila+2,$pdf,$cod,$num_ord);
			if($num_mue=='1')
			{
				if($esta_mue=='P')
				{
				$pdf->SetXY(15,$fila);
				$pdf->Cell(40,5,'Muestra N� 1  Positivo Para BAAR en 100 campos Observados'.'  '.$valo_mue,0);
				}
				else
				{
				$pdf->SetXY(15,$fila);
				$pdf->Cell(40,5,'Muestra N� 1  No se Observan BAAR en 100 campos Observados'.'  '.$valo_mue,0);
				}
			
			}
			if($num_mue=='2')
			{
				if($esta_mue=='P')
				{
				$pdf->SetXY(15,$fila);
				$pdf->Cell(40,5,'Muestra N� 2  Positivo Para BAAR en 100 campos Observados'.'  '.$valo_mue,0);
				}
				else
				{
				$pdf->SetXY(15,$fila);
				$pdf->Cell(40,5,'Muestra N� 2  No se Observan BAAR en 100 campos Observados'.'  '.$valo_mue,0);
				}
			
			}
			if($num_mue=='3')
			{
				if($esta_mue=='P')
				{
				$pdf->SetXY(15,$fila);
				$pdf->Cell(40,5,'Muestra N� 3  Positivo Para BAAR en 100 campos Observados'.'  '.$valo_mue,0);
				}
				else
				{
				$pdf->SetXY(15,$fila);
				$pdf->Cell(40,5,'Muestra N� 3  No se Observan BAAR en 100 campos Observados'.'  '.$valo_mue,0);
				}
			
			}
		
		
		}
		$fila=increm($fila+2,$pdf,$cod,$num_ord);
		$pdf->SetXY(15,$fila);
		$pdf->Cell(40,5,'Tipo De Muestra:  '.$tipo_mue,0);

	}
	
	////////////////////////////GRAM//////////////////////
	$res_gram=mysql_query("SELECT  `iden_dlab`, `cod_exam`, `tipo_mue`, `esta_mue`, `coco_grm`, `baci_grm`, 
	`cbac_grm`, `gpos_grm`, `gneg_grm`, `gvar_grm`, `otro_grm` 
	 FROM labo_oex2 WHERE `iden_dlab`='$iden_labs'  AND `est_oex2`<>'EL' AND `cod_exam`='901107'");
	 
	if(mysql_num_rows($res_gram)<>0)
	{
			$fila=increm($fila+4,$pdf,$cod,$num_ord);

			$pdf->SetXY(15,$fila);
			$pdf->Cell(40,5,"_________________________________________________________________________________________________",0);

			$fila=increm($fila+2,$pdf,$cod,$num_ord);
			$pdf->SetXY(80,$fila);
			$pdf->Cell(40,5,"COLORACION GRAM Y LECTURA PARA CUALQUIER MUESTRA",0);

			$pdf->SetXY(15,$fila);
			$pdf->Cell(40,5,"_________________________________________________________________________________________________",0);

		while($rowgr= mysql_fetch_array($res_gram))
		{
			$tgr_mue=$rowgr["tipo_mue"];
			$egrm_mue=$rowgr["esta_mue"];
			$coco_grm=$rowgr["coco_grm"];
			$baci_grm=$rowgr["baci_grm"];
			$cbac_grm=$rowgr["cbac_grm"];
			$gpos_grm=$rowgr["gpos_grm"];
			$gneg_grm=$rowgr["gneg_grm"];
			$gvar_grm=$rowgr["gvar_grm"];
			$otro_grm=$rowgr["otro_grm"];
			
		}
		$fila=increm($fila+4,$pdf,$cod,$num_ord);
		$pdf->SetXY(15,$fila);
		$pdf->Cell(40,5,'CARACTERISTICAS GENERALES - DATOS:',0);
		
		$fila=increm($fila+2,$pdf,$cod,$num_ord);
		$pdf->SetXY(15,$fila);
		$pdf->Cell(40,5,'Tipo De Muestra:  '.$tgr_mue.'                          PMN: '.$egrm_mue,0);
		$fila=increm($fila+2,$pdf,$cod,$num_ord);
		$pdf->SetXY(15,$fila);
		$pdf->Cell(40,5,'MORFOLOGIA BACTERIANA:  ',0);
		//$fila=increm($fila+2,$pdf,$cod,$num_ord);
		if($coco_grm==1)
		{
			$Cocos='Cocos';
		}
		if($baci_grm==1)
		{
			$Bacilos='Bacilos';
		}
		if($cbac_grm==1)
		{
			$CBaci='CocosBacilos';
		}
		if($gpos_grm==1)
		{
			$grpos='Gram Positivos';
		}
		if($gneg_grm==1)
		{
			$grneg='Gram Negativos';
		}
		if($gvar_grm==1)
		{
			$ggvar='Gram Variable';
		}
		$fila=increm($fila+2,$pdf,$cod,$num_ord);
		$pdf->SetXY(15,$fila);
		$pdf->Cell(40,5,'                       '.$Cocos.'  '.$Bacilos.'  '.$CBaci,0);
		
		$fila=increm($fila+2,$pdf,$cod,$num_ord);
		$pdf->SetXY(15,$fila);
		$pdf->Cell(40,5,'                       '.$grpos.'  '.$grneg.'  '.$ggvar,0);
		
		
		if($otro_grm!=' ')
		{
			$fila=increm($fila+2,$pdf,$cod,$num_ord);
			$pdf->SetXY(15,$fila);
			$pdf->Cell(40,5,'Otros:  '.$otro_grm,0);
		}


		
	}
////////////////////////////COPROLOGICO//////////////////////
	$res_cpr=mysql_query("SELECT `iden_dlab`, `nume_fac`, `cod_exam`, `cod_usua`, `fech_recp`, 
	`fech_entr`, `tipo_mue`, `num_mue`, `esta_mue`, `valo_mue`, `coco_grm`, `baci_grm`, `cbac_grm`, 
	`gpos_grm`, `gneg_grm`, `gvar_grm`, `otro_grm`, `qbho_cpr`, `nobs_cpr`, `obse_cpr`, `est_oex2` 
	FROM `labo_oex2` WHERE `iden_dlab`='$iden_labs'  AND `est_oex2`<>'EL' AND `cod_exam`='907002'");
	 
	if(mysql_num_rows($res_cpr)<>0)
	{
			$fila=increm($fila+4,$pdf,$cod,$num_ord);

			$pdf->SetXY(15,$fila);
			$pdf->Cell(40,5,"_________________________________________________________________________________________________",0);

			$fila=increm($fila+2,$pdf,$cod,$num_ord);
			$pdf->SetXY(80,$fila);
			$pdf->Cell(40,5,"COPROLOGICO",0);

			$pdf->SetXY(15,$fila);
			$pdf->Cell(40,5,"_________________________________________________________________________________________________",0);

		while($rowcpr= mysql_fetch_array($res_cpr))
		{
			$col_mues=$rowcpr["tipo_mue"];
			$asp_mues=$rowcpr["esta_mue"];
			$qui_eth=$rowcpr["valo_mue"];
			$trz_amb=$rowcpr["coco_grm"];
			$qui_etmb=$rowcpr["baci_grm"];
			$qui_gins=$rowcpr["cbac_grm"];
			$qui_exna=$rowcpr["gpos_grm"];
			$trz_gins=$rowcpr["gneg_grm"];
			$qui_blh=$rowcpr["gvar_grm"];
			$otr_pst=$rowcpr["otro_grm"];
			$chk_=$rowcpr["qbho_cpr"];
			$nsp_mues=$rowcpr["nobs_cpr"];
			$obs_mcn=$rowcpr["obse_cpr"];
			
		}
		$fila=increm($fila+4,$pdf,$cod,$num_ord);
		$pdf->SetXY(15,$fila);
		$pdf->Cell(40,5,'CARACTERISTICAS GENERALES',0);
		
		$fila=increm($fila+2,$pdf,$cod,$num_ord);
		$pdf->SetXY(15,$fila);
		$pdf->Cell(40,5,'COLOR:  '.$col_mues.'                          ASPECTO: '.$asp_mues,0);
		$fila=increm($fila+2,$pdf,$cod,$num_ord);
		$pdf->SetXY(15,$fila);
		$pdf->Cell(40,5,'PARASITOLOGICO:  ',0);
		//$fila=increm($fila+2,$pdf,$cod,$num_ord);
		if($qui_eth==1)
		{
			$fila=increm($fila+2,$pdf,$cod,$num_ord);
			$pdf->SetXY(15,$fila);
			$pdf->Cell(40,5,'Quistes de Entamoeba Histolytica',0);
		}
		if($trz_amb==1)
		{
			$fila=increm($fila+2,$pdf,$cod,$num_ord);
			$pdf->SetXY(15,$fila);
			$pdf->Cell(40,5,'Trofozoitos de Amebas',0);
		}
		if($qui_etmb==1)
		{
			$fila=increm($fila+2,$pdf,$cod,$num_ord);
			$pdf->SetXY(15,$fila);
			$pdf->Cell(40,5,'Quistes de Entomoeba Coli',0);
		}
		if($qui_gins==1)
		{
			$fila=increm($fila+2,$pdf,$cod,$num_ord);
			$pdf->SetXY(15,$fila);
			$pdf->Cell(40,5,'Quisites de Giardia Intestinalis',0);
		}
		if($qui_exna==1)
		{
			$fila=increm($fila+2,$pdf,$cod,$num_ord);
			$pdf->SetXY(15,$fila);
			$pdf->Cell(40,5,'Quistes de Endolimax Nana',0);
		}
		if($trz_gins==1)
		{
			$fila=increm($fila+2,$pdf,$cod,$num_ord);
			$pdf->SetXY(15,$fila);
			$pdf->Cell(40,5,'Trofozoitos de Giardia Intestinalis',0);
		}
		
		if($qui_blh==1)
		{
			$fila=increm($fila+2,$pdf,$cod,$num_ord);
			$pdf->SetXY(15,$fila);
			$pdf->Cell(40,5,'Quistes de Blastocystis Hominis:  '.$chk_,0);
		}
		
		if($otr_pst!=' ')
		{
			$fila=increm($fila+2,$pdf,$cod,$num_ord);
			$pdf->SetXY(15,$fila);
			$pdf->Cell(40,5,'Otros:  '.$otr_pst,0);
		}
		if($nsp_mues==1)
		{
			$fila=increm($fila+2,$pdf,$cod,$num_ord);
			$pdf->SetXY(15,$fila);
			$pdf->Cell(40,5,'No se observan parasitos intestinales en la muestra analizada',0);
		} 

		if($obs_mcn!=' ')
		{
			$fila=increm($fila+2,$pdf,$cod,$num_ord);
			$pdf->SetXY(15,$fila);
			$pdf->multiCell(200,5,'Observaciones: '.$obs_mcn,0,'J');
		} 
		
		

		
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
//impresion Examenes Varios ( 888)

$result12=mysql_query("SELECT `iden_dlab`, `fec_rec`, `fec_ent`, `cod_usu`, `cod_examvr`, `datos` FROM `dat_varios` WHERE `iden_dlab`='$iden_labs' AND `esta_ord`<>'EL'");
$val="SELECT `iden_dlab`, `fec_rec`, `fec_ent`, `cod_usu`, `cod_examvr`, `datos` FROM `dat_varios` WHERE `iden_dlab`='$iden_labs' AND `esta_ord`<>'EL'";
//echo $val;
if(mysql_num_rows($result12)<>0)
{
while($rowc=mysql_fetch_array($result12))

{
	$num_fac=$rowc["num_fac"];
	$datos=$rowc["datos"];
	
	$fila=increm($fila+4,$pdf,$cod,$nd_);
	
	if($fila>=240)
	{
	
		$pdf->AddPage();
		$pdf->SetXY(15,$fila);
		$pdf->Cell(40,5,"______________________________________________________________________________________________________________________________________________",0);

		$fila=increm($fila+2,$pdf,$cod,$nd_);
		$pdf->SetXY(80,$fila);
		$pdf->Cell(40,5,"OBSERVACIONES GENERALES",0);

		$pdf->SetXY(15,$fila);
		$pdf->Cell(40,5,"______________________________________________________________________________________________________________________________________________",0);
		
		$fila=increm($fila+2,$pdf,$cod,$nd_);
		$pdf->SetXY(15,$fila);
		$pdf->Cell(40,5,'INFORMACION GENERAL:',0);
		
		$fila=increm($fila,$pdf,$cod,$nd_);
		$pdf->SetXY(15,$fila);
		
		

	
		//$pdf->Image('imagenes\du.JPG',5,10,204,0,'','');
	   // $pdf->Image('imagenes\PIE1.JPG',5,254,204,0,'','');
	    //$pdf->Image('imagenes\CONTROLADO2.JPG',150,235,0,15,'','');
		$fila=85;
		$fila=$pdf->GetY();
		
		
	    $pdf->SetXY(15,$fila);
		$pdf->multiCell(200,5,$datos,0,'J');
  
	}
	else
	{
		$fila=$pdf->GetY()+5;
		
		$pdf->SetXY(15,$fila);
		$pdf->Cell(40,5,"______________________________________________________________________________________________________________________________________________",0);

		$fila=increm($fila+2,$pdf,$cod,$nd_);
		$pdf->SetXY(80,$fila);
		$pdf->Cell(40,5,"OBSERVACIONES GENERALES",0);

		$pdf->SetXY(15,$fila);
		$pdf->Cell(40,5,"______________________________________________________________________________________________________________________________________________",0);
		
		$fila=increm($fila+2,$pdf,$cod,$nd_);
		$pdf->SetXY(15,$fila);
		$pdf->Cell(40,5,'INFORMACION GENERAL:',0);
		
		$fila=increm($fila,$pdf,$cod,$nd_);
		$pdf->SetXY(15,$fila);
	
	
		$fila=$pdf->GetY();
		$pdf->SetXY(15,$fila);
		$pdf->multiCell(200,5,$datos,0,'J');
	}
	
		$tama�o=strlen($datos);
		$fin=40;
		$line=$tama�o/$fin;
		
	
	}
}
		
		$fila=$pdf->GetY()+10;
		//$pdf->SetXY(15,$fila);
		//$pdf->multiCell(180,5,$fila,0,'J');
		if($fila>=236)
		{
	
			//$pdf->AddPage();
			$fila=increm($fila+4,$pdf,$cod,$num_ord);
			//$pdf->Image('imagenes\du.JPG',5,10,204,0,'','');
			//$pdf->SetFont('Arial','',10);
			//$pdf->Image('imagenes\PIE1.JPG',5,256,204,0,'','');
			//$pdf->Image('imagenes\control.jpg',209,233,0,30,0,'','');
			//$pdf->SetFont('Arial','',7);
			//$pdf->SetXY(5,254);
			//$pdf->Cell(40,5,'PR: Examen Preliminar - VL: Examen Validado' ,0);

			$consultamed=mysql_query("SELECT medicos.cod_medi, medicos.nom_medi, medicos.are_medi, Count(medicos.cod_medi) AS CuentaDecod_medi, detalle_labs.iden_labs
			FROM detalle_labs 
			INNER JOIN medicos ON detalle_labs.cod_medi = medicos.ced_medi
			WHERE detalle_labs.iden_labs='$iden_labs' AND detalle_labs.estd_dlab='CU' 
			GROUP BY medicos.cod_medi, medicos.nom_medi, medicos.are_medi, detalle_labs.iden_labs");
			
			if(mysql_num_rows($consultamed)<>0)
			{
				$fila=40;
				$colm=30;
				while($rowmed=mysql_fetch_array($consultamed))
				{
				  
				  $nom_medi=$rowmed[nom_medi];
				  $reg_medi=$rowmed[reg_medi];
				  $cod_medi=$rowmed[cod_medi];
				  $firma="../firmas/".$rowmed[cod_medi].".jpg";
				 
				  //$pdf->SetXY($colm,$fila);
				  //$pdf->Cell(40,5,"Reg.". $firma,0);
				   
				 if(file_exists($firma))
				  {
					titulo($pdf,$fila,$nomimg);	
					$pdf->SetXY($colm,$fila);
					//$pdf->Cell(50,5,"Reg.".$colm.$firma,1);
					$pdf->Image($firma,$colm,$fila+10,25,25,'','');//15+fila manejan el abajo 
					$colm=$pdf->GetX()+30;//separacion de firmas
						
				  }
				}  
			}
		}
		
		
		else
		{
			$consultamed=mysql_query("SELECT medicos.cod_medi, medicos.nom_medi, medicos.are_medi, Count(medicos.cod_medi) AS CuentaDecod_medi, detalle_labs.iden_labs
			FROM detalle_labs 
			INNER JOIN medicos ON detalle_labs.cod_medi = medicos.ced_medi
			WHERE detalle_labs.iden_labs='$iden_labs' AND detalle_labs.estd_dlab='CU'
			GROUP BY medicos.cod_medi, medicos.nom_medi, medicos.are_medi, detalle_labs.iden_labs");
			
			if(mysql_num_rows($consultamed)<>0)
			{
			
				$colm=30;
				while($rowmed=mysql_fetch_array($consultamed))
				{
				
				  $nom_medi=$rowmed[nom_medi];
				  $reg_medi=$rowmed[reg_medi];
				  $cod_medi=$rowmed[cod_medi];
				  $firma="../firmas/".$rowmed[cod_medi].".jpg";
				 
				  //$pdf->SetXY($colm,$fila);
				  //$pdf->Cell(40,5,"Reg.". $firma,0);
				   
				 if(file_exists($firma))
				  {
					titulo($pdf,$fila,$nomimg);	
					$pdf->SetXY($colm,$fila);
					//$pdf->Cell(50,5,"Reg.".$colm.$firma,1);
					$pdf->Image($firma,$colm,$fila+8,35,25,'','');//15+fila manejan el abajo 
					$colm=$pdf->GetX()+40;//separacion de firmas
						
				  }
				}  
			}
		
		
		
		}
		
		
		//$fhoy=date("Y-m-d"); 
		//$fila=$fila+8;
		titulo($pdf,$fila,$nomimg);
		//linea(100,$fila,50,"_",$pdf);
		//$fila=$fila+4;
		titulo($pdf,$fila,$nomimg);
		//$pdf->SetXY(120,$fila);
		//$pdf->Cell(40,5,$consultamed,0);
		//$pdf->Cell(40,5,"Bacteriolog@-".$fhoy,0);
		//$fila=$fila+4;
		//$pdf->SetXY(100,$fila);
		//$pdf->Cell(40,5,"Reg.".$reg_medi .'-'. $nom_esp,0);


	



	$pdf->Output();

	function calculaedad2($fecha_,&$unidad_){
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
		if($anos_>0){$anos_=$anos_-1;}
		$meses_=11;
	  }

	  if($anos_<>0)
	  {
		$edad_=$anos_;
		if($edad_==1){
		  $unidad_="A�o";}
		else{
		  $unidad_="A�os";}
	  }
	  else
	  {
		if($meses_<>0){
		  $edad_=$meses_;
		  if($edad_==1){
			$unidad_="Mes";}
		  else{
			$unidad_="Meses";}
		}
		else{
		  $edad_=$dias_;
		  if($edad_==1){
			$unidad_="D�a";}
		  else{
			$unidad_="D�as";}
		}
	  }
		return($edad_);
	}


?>