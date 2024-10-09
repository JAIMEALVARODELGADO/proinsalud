<?
//Cargo las funciones del programa
include ('php/texto.php');
include ('php/funciones.php');
require('fpdf.php');

//include ('php/cortatexto.php');
$pag=0;
$fila=16;
function linea($col_,$fil_,$cant_,$car_,&$pdf)
{
  for($n=0;$n<$cant_;$n++){
    $pdf->SetXY($col_+$n,$fil_);
	$pdf->Cell(40,5,$car_,0);
  }
}

function titulo(&$pdf_,&$fila_,$vec_,$pag){
if($fila_>250){
	$pag=$pag+1;
  $pdf_->AddPage();
  $fila_=16;
  $pdf_->Image('img\enca_histo.JPG',1,0,210,0,'','');
  $pdf_->Image('img\controlado.png',205,100,7,30,'','');
  $pdf_->Image('img\PIE1.JPG',2,265,210,0,'',''); 


	$idenevo=$vec_[0];
	$fecevo=$vec_[1];
	$servicio=$vec_[2];
	$nombre=$vec_[3];
	$sexo=$vec_[4];//$Sexo
	$contrato=$vec_[5];//$contrato
	$identificacion=$vec_[6];//$dentificacion
	$direccion=$vec_[7];//$direccion
	$telefono=$vec_[8];//$telefono
	$fnac=$vec_[9];//$fnac=
	$edad=$vec_[10];//=$edad
  
  
	$pdf_->SetXY(5,16);
	$pdf_->Cell(40,5,"SERVICIO: ".$servicio,0);
	$pdf_->SetXY(5,20);
	$pdf_->Cell(40,5,"Nombre:",0);
	$pdf_->SetXY(18,20);
	$pdf_->Cell(40,5,$nombre,0);
	$pdf_->SetXY(80,20);
	$pdf_->Cell(40,5,"Sexo:",0);
	$pdf_->SetXY(88,20);
	$pdf_->Cell(40,5,$sexo,0);
	$pdf_->SetXY(95,20);
	$pdf_->Cell(40,5,"Contrato:",0);
	$pdf_->SetXY(107,20);
	$pdf_->Cell(40,5,$contrato,0);
	$pdf_->SetXY(155,20);
	$pdf_->Cell(40,5,"Identificacion:",0);
	$pdf_->SetXY(175,20);
	$pdf_->Cell(40,5,$identificacion,0);
	$pdf_->SetXY(5,24);
	$pdf_->Cell(40,5,"Direccion:",0);
	$pdf_->SetFont('Arial','',6);
	$pdf_->SetXY(18,24);
	$pdf_->Cell(40,5,$direccion,0);
	$pdf_->SetFont('Arial','',8);
	$pdf_->SetXY(75,24);
	$pdf_->Cell(40,5,"Telefono:",0);
	$pdf_->SetXY(88,24);
	$pdf_->Cell(40,5,$telefono,0);
	$pdf_->SetXY(120,24);
	$pdf_->Cell(40,5,"F. Nacimiento: ".$fnac,0);
	$pdf_->SetXY(165,24);
	$pdf_->Cell(40,5,"Edad:",0);
	$pdf_->SetXY(175,24);
	$pdf_->Cell(40,5,$edad,0);
	$pdf_->SetXY(5,30);
	$pdf_->Cell(40,5,"EVOLUCION No. ".$idenevo."       Pagina No. ".$pag,0);
	$pdf_->SetXY(170,30);
	$pdf_->Cell(40,5,"Fecha: ".$fecevo,0);	  
	$pdf_->line(5,30,205,30);
	$pdf_->line(5,35,205,35);  
	$fila_=36;
	
  
  }
  return $pag;
}

function impresion($iden_evo,&$pdf){
//Consulto la información de la evolución
//$consulta=mysql_query("SELECT codi_usu,id_ing,cod_medi,cod_cie10,tidx_evo,fech_evo,hora_evo,subj_evo,obje_evo,anal_evo,plan_evo,reco_gen,cama_evo,dest_usu,valo_des FROM hist_evo,destipos WHERE codi_des=cama_evo AND iden_evo=$iden_evo");
$consulta=mysql_query("SELECT codi_usu,id_ing,cod_medi,cod_cie10,tidx_evo,fech_evo,hora_evo,subj_evo,obje_evo,anal_evo,plan_evo,reco_gen,cama_evo,dest_usu 
FROM hist_evo 
WHERE iden_evo='$iden_evo'");
$row=mysql_fetch_array($consulta);

//Consulto la información del servicio
$consultaser=mysql_query("SELECT nomb_des FROM destipos WHERE codi_des=(SELECT val2_des FROM destipos WHERE codi_des='$row[cama_evo]')");
if(mysql_num_rows($consultaser)<>0){
  $rowser=mysql_fetch_array($consultaser);
  $servicio=$rowser[nomb_des];
}

$consultausu=mysql_query("SELECT us.nrod_usu,us.pnom_usu,us.snom_usu,us.pape_usu,us.sape_usu,us.sexo_usu,us.fnac_usu,us.dire_usu,us.tres_usu,co.neps_con FROM usuario AS us,ingreso_hospitalario AS ih INNER JOIN contrato AS co ON ih.contra_ing=co.codi_con WHERE ih.id_ing='$row[id_ing]' and us.codi_usu='$row[codi_usu]'");
$rowusu=mysql_fetch_array($consultausu);
$nombre=$rowusu[pnom_usu]." ".$rowusu[snom_usu]." ".$rowusu[pape_usu]." ".$rowusu[sape_usu];
$unidad="";
$edad=calculaedad2($rowusu[fnac_usu],$unidad);
$fechor=$row[fech_evo]." ".$row[hora_evo];

$fila=300;


$vec[0]=$iden_evo;
$vec[1]=$fechor;
$vec[2]=$servicio;
$vec[3]=$nombre;
$vec[4]=$rowusu[sexo_usu];//$Sexo
$vec[5]=$rowusu[neps_con];//$contrato
$vec[6]=$rowusu[nrod_usu];//$dentificacion
$vec[7]=$rowusu[dire_usu];//$direccion
$vec[8]=$rowusu[tres_usu];//$telefono
$vec[9]=cambiafechadmy($rowusu[fnac_usu]);//$fnac=
$vec[10]=$edad." ".$unidad;//=$edad


$pag=titulo($pdf,$fila,$vec,$pag);


$fila=$fila+4;
$pdf->SetXY(5,$fila);
$pdf->MultiCell(200, 5,strtoupper($row[subj_evo]),0, J,0); 
$fila=$pdf->GetY();

//$fila=$fila+4;
//imprimirtexto($fila,5,$row[obje_evo],120,$pdf,1);
$fila=$fila+4;
$pag=titulo($pdf,$fila,$vec,$pag);
$pdf->SetXY(5,$fila);
$pdf->MultiCell(200, 5,strtoupper($row[obje_evo]),0, J,0); 
$fila=$pdf->GetY();

//$fila=$fila+4;
//imprimirtexto($fila,5,$row[anal_evo],120,$pdf,1);
$fila=$fila+4;
$pag=titulo($pdf,$fila,$vec,$pag);
$pdf->SetXY(5,$fila);
$pdf->MultiCell(200, 5,strtoupper($row[anal_evo]),0, J,0); 
$fila=$pdf->GetY();

//$fila=$fila+4;
//imprimirtexto($fila,5,$row[plan_evo],120,$pdf,1);
$fila=$fila+4;
$pag=titulo($pdf,$fila,$vec,$pag);
$pdf->SetXY(5,$fila);
$pdf->MultiCell(200, 5,strtoupper($row[plan_evo]),0, J,0); 
$fila=$pdf->GetY();


//$fila=$fila+4;
$pdf->SetXY(5,$fila);
$fila=$fila+2;
$pag=titulo($pdf,$fila,$vec,$pag);
linea(5,$fila,205,"_",$pdf);
$fila=$fila+4;
$pag=titulo($pdf,$fila,$vec,$pag);
$pdf->SetXY(5,$fila);
$pdf->Cell(40,5,"DIAGNOSTICOS",0);	
$fila=$fila+2;
$pag=titulo($pdf,$fila,$vec,$pag);
linea(5,$fila,205,"_",$pdf);
$fila=$fila+4;
$pag=titulo($pdf,$fila,$vec,$pag);
$pag=titulo($pdf,$fila,$vec,$pag);
$pdf->SetXY(5,$fila);
$pdf->Cell(40,5,$dx,0);
$consucie=mysql_query("SELECT nom_cie10 FROM cie_10 where cod_cie10='$row[cod_cie10]'");
if(mysql_num_rows($consucie)<>0){
  $rowcie=mysql_fetch_array($consucie);
  $pdf->SetXY(5,$fila);
  $pag=titulo($pdf,$fila,$vec,$pag);
  $pdf->Cell(40,5,$row[cod_cie10],0);
  $pdf->SetXY(15,$fila);
  $pdf->Cell(40,5,$rowcie[nom_cie10],0);
}
$fila=$fila+4;
$pag=titulo($pdf,$fila,$vec,$pag);
//$pag=titulo($pdf,$fila,$vec,$pag);
$consultadiax=mysql_query("SELECT cod_cie10 FROM diax_evo WHERE iden_evo='$iden_evo'");
if(mysql_num_rows($consultadiax)<>0){
  while($rowdiax=mysql_fetch_array($consultadiax)){
    $consucie=mysql_query("SELECT nom_cie10 FROM cie_10 where cod_cie10='$rowdiax[cod_cie10]'");
    if(mysql_num_rows($consucie)<>0){
      $rowcie=mysql_fetch_array($consucie);
      $pdf->SetXY(5,$fila);
	  $pag=titulo($pdf,$fila,$vec,$pag);
      $pdf->Cell(40,5,$rowdiax[cod_cie10],0);
      $pdf->SetXY(15,$fila);
      $pdf->Cell(40,5,$rowcie[nom_cie10],0);
	  $fila=$fila+4;
	  $pag=titulo($pdf,$fila,$vec,$pag);
      $pag=titulo($pdf,$fila,$vec,$pag);
    }
  }
}
  
//Recupero medicamentos
$fila=$fila+2;
$pag=titulo($pdf,$fila,$vec,$pag);
linea(5,$fila,205,"_",$pdf);
$fila=$fila+4;
$pag=titulo($pdf,$fila,$vec,$pag);
$pdf->SetXY(5,$fila);
$pdf->Cell(40,5,"MEDICAMENTOS",0);
$fila=$fila+2;
$pag=titulo($pdf,$fila,$vec,$pag);
linea(5,$fila,205,"_",$pdf);
$fila=$fila+4;
$pag=titulo($pdf,$fila,$vec,$pag);
$pdf->SetXY(5,$fila);
$pdf->Cell(40,5,"Medicamento",0);
$pdf->SetXY(125,$fila);
$pdf->Cell(40,5,"Dosis",0);
$pdf->SetXY(135,$fila);
$pdf->Cell(40,5,"Und",0);
$pdf->SetXY(155,$fila);
$pdf->Cell(40,5,"Frec",0);
$pdf->SetXY(180,$fila);
$pdf->Cell(40,5,"Via",0);
$fila=$fila+4;
$pag=titulo($pdf,$fila,$vec,$pag);
$consultamed=mysql_query("SELECT e.obse_med,d.codi_mdi,d.dosi_med,d.unid_med,d.via_med,d.frec_med,d.ufre_med,m.nomb_mdi FROM henc_med e,hdet_med d,medicamentos2 m WHERE e.idor_med=d.idor_med and m.codi_mdi=d.codi_mdi and e.iden_evo='$iden_evo'");
if(mysql_num_rows($consultamed)<>0){
  while($rowmed=mysql_fetch_array($consultamed)){
    $pag=titulo($pdf,$fila,$vec,$pag);
    $pdf->SetXY(5,$fila);
	
    $pdf->Cell(40,5,$rowmed[codi_mdi],0);
	$pdf->SetXY(25,$fila);
    $pdf->Cell(40,5,substr(($rowmed[nomb_mdi]." ".$rowmed[conc_mdi]),0,60),0);
	$pdf->SetXY(125,$fila);
    $pdf->Cell(40,5,$rowmed[dosi_med],0);
	$consultados=mysql_query("SELECT nomb_des FROM destipos WHERE codi_des='$rowmed[unid_med]'");
	$rowdos=mysql_fetch_array($consultados);
	$pdf->SetXY(135,$fila);
    $pdf->Cell(40,5,substr($rowdos[nomb_des],0,10),0);
	$consultafre=mysql_query("SELECT nomb_des FROM destipos WHERE codi_des='$rowmed[ufre_med]'");
	$rowfre=mysql_fetch_array($consultafre);
	$pdf->SetXY(155,$fila);
    $pdf->Cell(40,5,"C/ ".$rowmed[frec_med]." ".substr($rowfre[nomb_des],0,10),0);
	$consultavia=mysql_query("SELECT nomb_des FROM destipos WHERE codi_des='$rowmed[via_med]'");
	$rowvia=mysql_fetch_array($consultavia);
	$pdf->SetXY(180,$fila);
    $pdf->Cell(40,5,$rowvia[nomb_des],0);
	$obse_med=$rowmed[obse_med];
	$fila=$fila+4; 
	$pag=titulo($pdf,$fila,$vec,$pag);	
  }
  //imprimirtexto($fila,5,$obse_med,120,$pdf,1);
  $pdf->SetXY(5,$fila);
  
  $pdf->MultiCell(200, 5,strtoupper($obse_med),0, J,0); 
  
  
  $fila=$pdf->GetY();
}

//Recupero varios
//$fila=$fila+6;
$pag=titulo($pdf,$fila,$vec,$pag);
linea(5,$fila,205,"_",$pdf);
$fila=$fila+4;
$pag=titulo($pdf,$fila,$vec,$pag);


$pdf->SetXY(5,$fila);


$pdf->Cell(40,5,"AYUDAS DIAGNOSTICAS - PROCEDIMIENTOS - INTERCONSULTAS",0);
$fila=$fila+2;
$pag=titulo($pdf,$fila,$vec,$pag);
linea(5,$fila,205,"_",$pdf);
$fila=$fila+4;
$pag=titulo($pdf,$fila,$vec,$pag);
$pdf->SetXY(5,$fila);
$pdf->Cell(40,5,"Clase",0);
$pdf->SetXY(15,$fila);
$pdf->Cell(40,5,"Descripción",0);
$pdf->SetXY(110,$fila);
$pdf->Cell(40,5,"Observaciones",0);
$fila=$fila+4;
$pag=titulo($pdf,$fila,$vec,$pag);
$consultavar=mysql_query("SELECT iden_ser,obse_var,clas_var FROM hist_var WHERE iden_evo='$iden_evo'");
if(mysql_num_rows($consultavar)<>0)
{
	while($rowvar=mysql_fetch_array($consultavar))
	{
		$pag=titulo($pdf,$fila,$vec,$pag);
		$pdf->SetXY(5,$fila);
		$pdf->Cell(40,5,$rowvar[clas_var],0);
		$pdf->SetXY(15,$fila);
		
		if($rowvar[clas_var]<>"I")
		{
			$consultaact=mysql_query("SELECT descrip, codi_cup FROM cups WHERE codigo='$rowvar[iden_ser]'");
			$rowact=mysql_fetch_array($consultaact);
			$descrip=$rowact[descrip];			
			$codigocup=$rowact[codi_cup];
			$pdf->Cell(40,5,$codigocup,0);
		}
		else
		{
			$consultaact=mysql_query("SELECT nomb_des FROM destipos WHERE codi_des='$rowvar[iden_ser]'");
			$rowact=mysql_fetch_array($consultaact);
			$descrip=$rowact[nomb_des];
			$pdf->Cell(40,5,$rowvar[iden_ser],0);
		}
		$pdf->SetXY(25,$fila);
		$pdf->Cell(40,5,substr($descrip,0,45),0);
		$pdf->SetXY(110,$fila);
		$pdf->Cell(40,5,$rowvar[obse_var],0);
		$fila=$fila+4; 
		$pag=titulo($pdf,$fila,$vec,$pag);		
	}
}


//Recupero Generales
$fila=$fila+2;
linea(5,$fila,205,"_",$pdf);


	//titulo$fila=$fila+4;
	//($pdf,$fila);
	//$pdf->SetXY(5,$fila);
	//$pdf->Cell(40,5,"OTRAS ORDENES Y RECOMENDACIONES",0);

$busdieta=mysql_query("SELECT ordenvarias.iden_evo, ordenvarias.codi_ord, orden_nutricion.desa_nut, orden_nutricion.almu_nut, orden_nutricion.cena_nut, 
ordenvarias.obse_ord, ordenvarias.orde_ord, destipos.nomb_des, ordenvarias.fech_ord, ordenvarias.hora_ord
FROM (orden_nutricion INNER JOIN ordenvarias ON orden_nutricion.iden_ord = ordenvarias.iden_ord) INNER JOIN destipos ON ordenvarias.orde_ord = destipos.codi_des
WHERE (((ordenvarias.iden_evo)='$iden_evo') AND ((ordenvarias.codi_ord)='1'))");
if(mysql_num_rows($busdieta)<>0)
{
	$fila=$fila+4;
	$pag=titulo($pdf,$fila,$vec,$pag);
	$pdf->SetXY(5,$fila);
	$pdf->Cell(40,5,"DIETA",0);	
	
	$fila=$fila+2;
	$pag=titulo($pdf,$fila,$vec,$pag);
	linea(5,$fila,205,"_",$pdf);
	
	$fila=$fila+6;
	$pag=titulo($pdf,$fila,$vec,$pag);
	$pdf->SetXY(5,$fila);	
	$pdf->Cell(40,5,'Desayuno',0);	
	$pdf->Cell(45,5,'Almuerzo',0);		
	$pdf->Cell(40,5,'Cena',0);
	$pdf->Cell(40,5,'Observaciones',0);
	$desa='';
	$almu='';
	$cena='';
	while($rowdieta=mysql_fetch_array($busdieta))
	{		
		if($rowdieta[desa_nut]=='S')$desa=$rowdieta[nomb_des];		
		if($rowdieta[almu_nut]=='S')$almu=$rowdieta[nomb_des];
		if($rowdieta[cena_nut]=='S')$cena=$rowdieta[nomb_des];
		$die=$rowdieta[obse_ord];
		$fila=$fila+4;
		$pag=titulo($pdf,$fila,$vec,$pag);
		$pdf->SetXY(5,$fila);		
		$pdf->Cell(40,5,$desa,0);	
		$pdf->Cell(45,5,$almu,0);		
		$pdf->Cell(40,5,$cena,0);
		$pdf->Cell(100,5,$die,0);
	}		
	
}

$busotras=mysql_query("SELECT hist_evo.iden_evo, ordenvarias.codi_ord, ordenvarias.orde_ord, destipos.nomb_des, ordenvarias.obse_ord,ordenvarias.coox_ord
FROM ((ordenvarias INNER JOIN hist_evo ON ordenvarias.iden_evo = hist_evo.iden_evo) INNER JOIN destipos ON ordenvarias.orde_ord = destipos.codi_des) INNER JOIN usuario ON (hist_evo.codi_usu = usuario.CODI_USU) AND (hist_evo.codi_usu = usuario.CODI_USU)
WHERE (((hist_evo.iden_evo)='$iden_evo'))
ORDER BY ordenvarias.codi_ord");


if(mysql_num_rows($busotras)<>0)
{
	$fila=$fila+4;
	$pag=titulo($pdf,$fila,$vec,$pag);
	linea(5,$fila,205,"_",$pdf);
	$numro=mysql_num_rows($busotras);
	$fila=$fila+4;
	$pag=titulo($pdf,$fila,$vec,$pag);
	$pdf->SetXY(5,$fila);
	$pdf->Cell(40,5,"OTRAS ORDENES Y RECOMENDACIONES",0);	
	$fila=$fila+2;
	$pag=titulo($pdf,$fila,$vec,$pag);
	linea(5,$fila,205,"_",$pdf);
	$fila=$fila+6;
	$pag=titulo($pdf,$fila,$vec,$pag);
	$pdf->SetXY(5,$fila);	
	$pdf->Cell(40,5,'Orden',0);	
	$pdf->Cell(45,5,'',0);		
	$pdf->Cell(40,5,'Observacion',0);
	
	$ordoxi='';
	$posi='';
	$signos='';
	$control='';
	$frecu='';
	$oxime='';
	$cura='';
	$medida='';
	$hoja='';
	$venti='';
	$gluco='';
	$gluco='';
	$perime='';
	$silver='';
	$terafi='';
	$terares='';
	$curva='';
	
	
	while($rowotra=mysql_fetch_array($busotras))
	{	
		
		
		if($rowotra[codi_ord]==2)
		{			
			$nomox=mysql_query("select * from destipos where codi_des='$rowotra[coox_ord]'");
			while($rowoxi=mysql_fetch_array($nomox))
			{
				$descox=$rowoxi[nomb_des];
			}
			$ordoxi=$rowotra[nomb_des].' '.$descox;
			$obseordoxi=$rowotra[obse_ord];
		}
		if($rowotra[codi_ord]==3)
		{			
			$posi=$rowotra[nomb_des];
			$obseposi=$rowotra[obse_ord];			
		}
		if($rowotra[codi_ord]==4)
		{
			if($rowotra[orde_ord]==3001)
			{
			    $signos=$rowotra[nomb_des];
				$obsesignos=$rowotra[obse_ord];
			}
			if($rowotra[orde_ord]==3002)
			{
			    $control=$rowotra[nomb_des];
				$obsecontrol=$rowotra[obse_ord];
			}
			if($rowotra[orde_ord]==3003)
			{
			    $frecu=$rowotra[nomb_des];
				$obsefrecu=$rowotra[obse_ord];
			}
			if($rowotra[orde_ord]==3004)
			{
			    $oxime=$rowotra[nomb_des];
				$obseoxime=$rowotra[obse_ord];
			}
			if($rowotra[orde_ord]==3005)
			{
			    $cura=$rowotra[nomb_des];
				$obsecura=$rowotra[obse_ord];
			}
			if($rowotra[orde_ord]==3006)
			{
			    $medida=$rowotra[nomb_des];
				$obsemedida=$rowotra[obse_ord];
			}
			if($rowotra[orde_ord]==3007)
			{
			    $hoja=$rowotra[nomb_des];
				$obsehoja=$rowotra[obse_ord];
			}

			
	
			
			if($rowotra[orde_ord]==3008)
			{
			    $gluco=$rowotra[nomb_des];
				$obsegluco=$rowotra[obse_ord];
			}
			if($rowotra[orde_ord]==3009)
			{
			    $perime=$rowotra[nomb_des];
				$obseperime=$rowotra[obse_ord];
			}
			if($rowotra[orde_ord]==3010)
			{
			    $silver=$rowotra[nomb_des];
				$obsesilver=$rowotra[obse_ord];
			}
			if($rowotra[orde_ord]==3011)
			{
			    $terafi=$rowotra[nomb_des];
				$obseterafi=$rowotra[obse_ord];
			}
			if($rowotra[orde_ord]==3012)
			{
			    $terares=$rowotra[nomb_des];
				$obseterares=$rowotra[obse_ord];
			}
			if($rowotra[orde_ord]==3013)
			{
			    $curva=$rowotra[nomb_des];
				$obsecurva=$rowotra[obse_ord];
			}
			
			
			if($rowotra[orde_ord]==3014)
			{
			    $glucopro=$rowotra[nomb_des];
				$obseglucopro=$rowotra[obse_ord];
			}
			if($rowotra[orde_ord]==3015)
			{
			    $pulsocon=$rowotra[nomb_des];
				$obsepulsocon=$rowotra[obse_ord];
			}
			if($rowotra[orde_ord]==3016)
			{
			    $pulsosin=$rowotra[nomb_des];
				$obsepulsosin=$rowotra[obse_ord];
			}
			
			
			
			
		}
		if($rowotra[codi_ord]==5)
		{
			$venti=$rowotra[nomb_des];
			$obseventi=$rowotra[obse_ord];
		}
	
	}
	
	if($ordoxi<>'')
	{
		$fila=$fila+4;
		$pag=titulo($pdf,$fila,$vec,$pag);
		$pdf->SetXY(5,$fila);	
		$pdf->Cell(40,5,'OXIGENO',0);	
		$pdf->Cell(45,5,$ordoxi,0);		
		$pdf->Cell(45,5,$obseordoxi,0);			
	}
	if($posi<>'')
	{
		$fila=$fila+4;
		$pag=titulo($pdf,$fila,$vec,$pag);
		$pdf->SetXY(5,$fila);	
		$pdf->Cell(40,5,'POSICION',0);	
		$pdf->Cell(45,5,$posi,0);		
		$pdf->Cell(45,5,$obseposi,0);			
	}
	
	
	
	
	if($signos<>'' || $control<>'' || $frecu<>'' || $oxime<>'' || $cura<>'' || $medida<>'' || $hoja<>''	|| $gluco<>'' || $perime<>'' || $silver<>'' || $terafi<>'' || $terares<>'' || $curva<>'' || $glucopro<>'' || $pulsocon<>'' || $pulsosin<>'')
	{
	

		if($signos<>'')
		{
			$fila=$fila+4;
			$pag=titulo($pdf,$fila,$vec,$pag);
			$pdf->SetXY(5,$fila);	
			$pdf->Cell(40,5,'',0);	
			$pdf->Cell(45,5,$signos,0);		
			$pdf->Cell(45,5,$obsesignos,0);			
		}
		if($control<>'')
		{
			$fila=$fila+4;
			$pag=titulo($pdf,$fila,$vec,$pag);
			$pdf->SetXY(5,$fila);	
			$pdf->Cell(40,5,'',0);	
			$pdf->Cell(45,5,$control,0);		
			$pdf->Cell(45,5,$obsecontrol,0);			
		}
		if($frecu<>'')
		{
			$fila=$fila+4;
			$pag=titulo($pdf,$fila,$vec,$pag);
			$pdf->SetXY(5,$fila);	
			$pdf->Cell(40,5,'',0);	
			$pdf->Cell(45,5,$frecu,0);		
			$pdf->Cell(45,5,$obsefrecu,0);			
		}
		if($oxime<>'')
		{
			$fila=$fila+4;
			$pag=titulo($pdf,$fila,$vec,$pag);
			$pdf->SetXY(5,$fila);	
			$pdf->Cell(40,5,'',0);	
			$pdf->Cell(45,5,$oxime,0);		
			$pdf->Cell(45,5,$obseoxime,0);			
		}
		if($cura<>'')
		{
			$fila=$fila+4;
			$pag=titulo($pdf,$fila,$vec,$pag);
			$pdf->SetXY(5,$fila);	
			$pdf->Cell(40,5,'',0);	
			$pdf->Cell(45,5,$cura,0);		
			$pdf->Cell(45,5,$obsecura,0);			
		}
		if($medida<>'')
		{
			$fila=$fila+4;
			$pag=titulo($pdf,$fila,$vec,$pag);
			$pdf->SetXY(5,$fila);	
			$pdf->Cell(40,5,'',0);	
			$pdf->Cell(45,5,$medida,0);		
			$pdf->Cell(45,5,$obsemedida,0);			
		}
		if($hoja<>'')
		{
			$fila=$fila+4;
			$pag=titulo($pdf,$fila,$vec,$pag);
			$pdf->SetXY(5,$fila);	
			$pdf->Cell(40,5,'',0);	
			$pdf->Cell(45,5,$hoja,0);		
			$pdf->Cell(45,5,$obsehoja,0);			
		}
		if($gluco<>'')
		{
			$fila=$fila+4;
			$pag=titulo($pdf,$fila,$vec,$pag);
			$pdf->SetXY(5,$fila);	
			$pdf->Cell(40,5,'',0);	
			$pdf->Cell(45,5,$gluco,0);		
			$pdf->Cell(45,5,$obsegluco,0);			
		}	
		if($glucopro<>'')
		{
			$fila=$fila+4;
			$pag=titulo($pdf,$fila,$vec,$pag);
			$pdf->SetXY(5,$fila);	
			$pdf->Cell(40,5,'',0);	
			$pdf->Cell(45,5,$glucopro,0);		
			$pdf->Cell(45,5,$obseglucopro,0);			
		}	
		
		if($perime<>'')
		{
			$fila=$fila+4;
			$pag=titulo($pdf,$fila,$vec,$pag);
			$pdf->SetXY(5,$fila);	
			$pdf->Cell(40,5,'',0);	
			$pdf->Cell(45,5,$perime,0);		
			$pdf->Cell(45,5,$obseperime,0);			
		}	
		if($silver<>'')
		{
			$fila=$fila+4;
			$pag=titulo($pdf,$fila,$vec,$pag);
			$pdf->SetXY(5,$fila);	
			$pdf->Cell(40,5,'',0);	
			$pdf->Cell(45,5,$silver,0);		
			$pdf->Cell(45,5,$obsesilver,0);			
		}	
		if($terafi<>'')
		{
			$fila=$fila+4;
			$pag=titulo($pdf,$fila,$vec,$pag);
			$pdf->SetXY(5,$fila);	
			$pdf->Cell(40,5,'',0);	
			$pdf->Cell(45,5,$terafi,0);		
			$pdf->Cell(45,5,$obseterafi,0);			
		}	
		if($terares<>'')
		{
			$fila=$fila+4;
			$pag=titulo($pdf,$fila,$vec,$pag);
			$pdf->SetXY(5,$fila);	
			$pdf->Cell(40,5,'',0);	
			$pdf->Cell(45,5,$terares,0);		
			$pdf->Cell(45,5,$obseterares,0);			
		}	
		if($curva<>'')
		{
			$fila=$fila+4;
			$pag=titulo($pdf,$fila,$vec,$pag);
			$pdf->SetXY(5,$fila);	
			$pdf->Cell(40,5,'',0);	
			$pdf->Cell(45,5,$curva,0);		
			$pdf->Cell(45,5,$obsecurva,0);			
		}
		
		if($pulsocon<>'')
		{
			$fila=$fila+4;
			$pag=titulo($pdf,$fila,$vec,$pag);
			$pdf->SetXY(5,$fila);	
			$pdf->Cell(40,5,'',0);	
			$pdf->Cell(45,5,$pulsocon,0);		
			$pdf->Cell(45,5,$obsepulsocon,0);			
		}
		
		if($pulsosin<>'')
		{
			$fila=$fila+4;
			$pag=titulo($pdf,$fila,$vec,$pag);
			$pdf->SetXY(5,$fila);	
			$pdf->Cell(40,5,'',0);	
			$pdf->Cell(45,5,$pulsosin,0);		
			$pdf->Cell(45,5,$obsepulsosin,0);			
		}		
	
	}
	if($venti<>'')
	{
		$fila=$fila+4;
		$pag=titulo($pdf,$fila,$vec,$pag);
		$pdf->SetXY(5,$fila);	
		$pdf->Cell(40,5,'VENTILACION',0);	
		$pdf->Cell(45,5,$venti,0);		
		$pdf->Cell(45,5,$obseventi,0);			
	}

}

$fila=$fila+6;
$pag=titulo($pdf,$fila,$vec,$pag);
$pdf->SetXY(5,$fila);
$pdf->Cell(40,5,"RECOMENDACIONES GENERALES",0);
$fila=$fila+2;
$pag=titulo($pdf,$fila,$vec,$pag);
linea(5,$fila,205,"_",$pdf);
//$fila=$fila+4;
//imprimirtexto($fila,5,$row[reco_gen],120,$pdf,1);
$fila=$fila+4;
$pag=titulo($pdf,$fila,$vec,$pag);
$pdf->SetXY(5,$fila);
$pdf->MultiCell(200, 5,strtoupper($row[reco_gen]),1, J,0); 
$fila=$pdf->GetY();
$fila=$fila+4;
$pag=titulo($pdf,$fila,$vec,$pag);
$pag=titulo($pdf,$fila,$vec,$pag);
$pdf->SetXY(15,$fila);
$pdf->Cell(40,5,'Cama: ',0);
$consultacam=mysql_query("SELECT nomb_des FROM destipos WHERE codi_des='$row[cama_evo]'");
$rowcam=mysql_fetch_array($consultacam);
$pdf->SetXY(25,$fila);
$pdf->Cell(40,5,$rowcam[nomb_des],0);
$pdf->SetXY(45,$fila);
$pdf->Cell(40,5,"Salida a:",0);
$pdf->SetXY(60,$fila);
$consultasal=mysql_query("SELECT nomb_des FROM destipos WHERE codi_des='$row[dest_usu]'");
$rowsal=mysql_fetch_array($consultasal);
$pdf->Cell(40,5,$rowsal[nomb_des],0);

$consultamed=mysql_query("SELECT nom_medi,reg_medi FROM medicos WHERE cod_medi='$row[cod_medi]'");
if(mysql_num_rows($consultamed)<>0){
  $rowmed=mysql_fetch_array($consultamed);
  $nom_medi=$rowmed[nom_medi];
  $reg_medi=$rowmed[reg_medi];
}
$firma="../firmas/".$row[cod_medi].".jpg";
if(file_exists($firma)){
  $pdf->Image($firma,100,$fila,50,15,'','');
}
$fila=$fila+8;
$pag=titulo($pdf,$fila,$vec,$pag);
linea(100,$fila,50,"_",$pdf);
$fila=$fila+4;
$pag=titulo($pdf,$fila,$vec,$pag);
$pdf->SetXY(100,$fila);
$pdf->Cell(40,5,"Dr.".$nom_medi,0);
$fila=$fila+4;
$pdf->SetXY(100,$fila);
$pdf->Cell(40,5,"Reg.".$reg_medi,0);
}



$pdf=new FPDF('P','mm','Letter');
$pdf->SetFont('Arial','',8);
include ('../uci/php/conexion.php');
if(!empty($ingreso)){
	$consulta=mysql_query("SELECT iden_evo FROM hist_evo WHERE id_ing=$ingreso");
	if(mysql_num_rows($consulta)){
		while($row=mysql_fetch_array($consulta)){
			$iden_evo=$row[iden_evo];
			impresion($iden_evo,@$pdf);
		}
	}
}
else{
	impresion($iden_evo,$pdf);
}

$pdf->Output();
mysql_close();

?>

