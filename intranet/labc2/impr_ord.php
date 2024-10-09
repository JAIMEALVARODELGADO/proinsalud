<?
session_register('id_ing');
//Cargo las funciones del programa
require('fpdf.php');
include ('php/texto.php');
include ('php/funciones.php');
//include ('php/conexion.php');
$pdf=new FPDF('P','mm','Letter');
$pdf->SetFont('Arial','',8);

function linea($col_,$fil_,$cant_,$car_,&$pdf)
{
  for($n=0;$n<$cant_;$n++){
    $pdf->SetXY($col_+$n,$fil_);
	$pdf->Cell(40,5,$car_,0);
  }
}

$link=Mysql_connect("localhost","root","");
if(!$link)echo"no hay conexion";
Mysql_select_db('proinsalud',$link);

$fila=15;

//Consulto la información de la evolución
$consulta=mysql_query("SELECT codi_usu,id_ing,cod_medi,cod_cie10,tidx_evo,fech_evo,hora_evo,subj_evo,obje_evo,anal_evo,plan_evo,reco_gen,cama_evo 
                       FROM hist_evo WHERE iden_evo='$iden_evo'");
$row=mysql_fetch_array($consulta);
$dx=$row[cod_cie10];

//Consulto la información del Cama
$cons_cama=mysql_query("select * from ingreso_hospitalario where id_ing=$id_ing");
$rowm=mysql_fetch_array($cons_cama);
$causa=$rowm[id_ing];

$consultacama=mysql_query("SELECT codi_des,nomb_des FROM destipos WHERE codi_des='$rowm[caac_ing]'");
$rowcama=mysql_fetch_array($consultacama);
$cama=$rowcama[nomb_des];



//Consulto Causa Externa
$consultacex=mysql_query("SELECT codi_des,nomb_des FROM destipos WHERE codi_des='$causa'");
$rowcex=mysql_fetch_array($consultacex);
$cext=$rowcex[nomb_des];




//Consulto servicio
$consultaser=mysql_query("SELECT nomb_des FROM destipos WHERE codi_des=(SELECT val2_des FROM destipos WHERE codi_des='$rowm[caac_ing]')");
if(mysql_num_rows($consultaser)<>0){
  $rowser=mysql_fetch_array($consultaser);
  $servicio=$rowser[nomb_des];
}

//consulto Usuario
$consultausu=mysql_query("SELECT us.nrod_usu,us.pnom_usu,us.snom_usu,us.pape_usu,us.sape_usu,us.sexo_usu,us.fnac_usu,us.dire_usu,us.tres_usu,co.neps_con 
                          FROM usuario AS us 
						  INNER JOIN ingreso_hospitalario as ih on ih.codius_ing=us.codi_usu
						  INNER JOIN contrato AS co ON ih.contra_ing=co.codi_con 
						  WHERE ih.id_ing='$id_ing'");
$rowusu=mysql_fetch_array($consultausu);

$nombre=$rowusu[pnom_usu]." ".$rowusu[snom_usu]." ".$rowusu[pape_usu]." ".$rowusu[sape_usu];
$unidad="";
$edad=calculaedad2($rowusu[fnac_usu],$unidad);

$consultaact=mysql_query("SELECT hv.iden_ser,hv.obse_var,hv.clas_var,cp.descrip 
			                          FROM hist_var as hv
									  INNER JOIN cups AS cp ON cp.codigo=hv.iden_ser
									  WHERE hv.iden_evo='$iden_evo' AND cp.artic_cup='19'");
if(mysql_num_rows($consultaact)<>0)
{
	
	$pdf->AddPage();

	
	$pdf->Image('img\enca_orden.jpg',1,0,210,0,'','');
	$pdf->Image('img\controlado.png',205,100,7,30,'','');
	$pdf->Image('img\pie_orden.JPG',2,265,210,0,'','');
	$fila=$fila+4;
	$pdf->SetXY(5,$fila);
	$pdf->Cell(40,5,"SERVICIO: ".$servicio,0);
	$pdf->SetXY(95,$fila);
	$pdf->Cell(40,5,"CAMA:".$id_ing,0);
	$pdf->SetXY(165,$fila);
	$pdf->Cell(40,5,"Contingencia:".$cext,0);
    
	$fila=$pdf->GetY();
	$fila=$fila+4;
				
	$pdf->SetXY(5,$fila);
	$pdf->Cell(40,5,"Nombre:",0);

	$pdf->SetXY(18,$fila);
	$pdf->Cell(40,5,$nombre,0);

	$pdf->SetXY(80,$fila);
	$pdf->Cell(40,5,"Sexo:",0);

	$pdf->SetXY(88,$fila);
	$pdf->Cell(40,5,$rowusu[sexo_usu],0);

	
	$pdf->SetXY(95,$fila);
	$pdf->Cell(40,5,"Contrato:",0);

	$pdf->SetXY(107,$fila);
	$pdf->Cell(40,5,$rowusu[neps_con],0);

	$pdf->SetXY(155,$fila);
	$pdf->Cell(40,5,"Identificacion:",0);

	$pdf->SetXY(175,$fila);
	$pdf->Cell(40,5,$rowusu[nrod_usu],0);

	$fila=$fila+4;
	
	$pdf->SetXY(5,$fila);
	$pdf->Cell(40,5,"Direccion:",0);
	$pdf->SetFont('Arial','',6);
	$pdf->SetXY(18,$fila);
	$pdf->Cell(40,5,$rowusu[dire_usu],0);
	
	$pdf->SetFont('Arial','',8);
	$pdf->SetXY(75,$fila);
	$pdf->Cell(40,5,"Telefono:",0);

	$pdf->SetXY(88,$fila);
	$pdf->Cell(40,5,$rowusu[tres_usu],0);

	$pdf->SetXY(120,$fila);
	$pdf->Cell(40,5,"F. Nacimiento: ".cambiafechadmy($rowusu[fnac_usu]),0);

	$pdf->SetXY(165,$fila);
	$pdf->Cell(40,5,"Edad:",0);

	$pdf->SetXY(175,$fila);
	$pdf->Cell(40,5,$edad." ".$unidad,0);
	
	$fila=$pdf->GetY();
	$fila=$fila+4;
	linea(5,$fila,205,"_",$pdf);
	$fila=$fila+4;
	$pdf->SetXY(5,$fila);
	$pdf->Cell(40,5,"LABORATORIO CLINICO",0);
	$pdf->SetXY(170,$fila);
	$pdf->Cell(40,5,"Fecha: ".cambiafechadmy($row[fech_evo])." ".$row[hora_evo],0);
	$fila=$fila+1;
	linea(5,$fila,205,"_",$pdf);
	$fila=$fila+4;
	$pdf->SetXY(5,$fila);


	$pdf->Cell(40,5,"AYUDAS DIAGNOSTICAS",0);
	$fila=$fila+2;
	linea(5,$fila,205,"_",$pdf);
	$fila=$fila+4;
		
	$pdf->SetXY(5,$fila);
	$pdf->Cell(40,5,"Clase",0);
	$pdf->SetXY(80,$fila);
	$pdf->Cell(40,5,"Descripción",0);
	$pdf->SetXY(150,$fila);
	$pdf->Cell(40,5,"Observaciones",0);
	$fila=$fila+4;
	while($rowact=mysql_fetch_array($consultaact))
	{
		$pdf->SetXY(5,$fila);
		$pdf->Cell(40,5,$rowact[clas_var],0);
		$pdf->SetXY(15,$fila);
		$pdf->Cell(40,5,$rowact[iden_ser],0);
		$descrip=$rowact[descrip];
		$obse_var=$rowact[obse_var];
		$pdf->SetFont('Arial','',7);
		$pdf->SetXY(28,$fila);
		$pdf->multicell(115,5,$descrip,0,'J',0);
		$x1=$pdf->GetY(); 
		$pdf->SetXY(150,$fila);
		$pdf->multicell(60,5,$obse_var,0,'J',0);
		$x2=$pdf->GetY();
		if($x1>$x2){
		  $fila=$x1+4;}
		else{
		  $fila=$x2+4;}
		
	}
	
	$pdf->SetXY(5,$fila);
	$fila=$fila+2;
	linea(5,$fila,205,"_",$pdf);
	$fila=$fila+4;
	$pdf->SetXY(5,$fila);
	$pdf->Cell(40,5,"DIAGNOSTICOS",0);	
	$fila=$fila+2;
	linea(5,$fila,205,"_",$pdf);
	$fila=$fila+4;
	$consucie=mysql_query("SELECT nom_cie10 FROM cie_10 where cod_cie10='$dx'");
	if(mysql_num_rows($consucie)<>0){
	  $rowcie=mysql_fetch_array($consucie);
	  $pdf->SetXY(5,$fila);
	  $pdf->Cell(40,5,$row[cod_cie10],0);
	  $pdf->SetXY(15,$fila);
	  $pdf->Cell(40,5,$rowcie[nom_cie10],0);
	}
	
	$consultamed=mysql_query("SELECT nom_medi,reg_medi FROM medicos WHERE cod_medi='$row[cod_medi]'");
	if(mysql_num_rows($consultamed)<>0)
	{
		$rowmed=mysql_fetch_array($consultamed);
		$nom_medi=$rowmed[nom_medi];
		$reg_medi=$rowmed[reg_medi];
	}
	$firma="../firmas/".$row[cod_medi].".jpg";
	if(file_exists($firma)){
	$pdf->Image($firma,100,$fila,50,15,'','');
	}
	$fila=$fila+8;
	linea(100,$fila,50,"_",$pdf);
	$fila=$fila+4;
	$pdf->SetXY(100,$fila);
	$pdf->Cell(40,5,"Dr.".$nom_medi,0);
	$fila=$fila+4;
	$pdf->SetXY(100,$fila);
	$pdf->Cell(40,5,"Reg.".$reg_medi,0);
	
	
	
	
	
	
	
}

$consultaact=mysql_query("SELECT hv.iden_ser,hv.obse_var,hv.clas_var,cp.descrip 
			                          FROM hist_var as hv
									  INNER JOIN cups AS cp ON cp.codigo=hv.iden_ser
									  WHERE hv.iden_evo='$iden_evo' AND cp.artic_cup='21'");
if(mysql_num_rows($consultaact)<>0)
{
	$pdf->AddPage();
	$pdf->Image('img\enca_orden.jpg',1,0,210,0,'','');
	$pdf->Image('img\controlado.png',205,100,7,30,'','');
	$pdf->Image('img\pie_orden.jpg',2,265,210,0,'','');
	$fila=18;
	$pdf->SetXY(5,$fila);
	$pdf->Cell(40,5,"SERVICIO: ".$servicio,0);
	$pdf->SetXY(95,$fila);
	$pdf->Cell(40,5,"CAMA:".$cama,0);
	$pdf->SetXY(165,$fila);
	$pdf->Cell(40,5,"Contingencia:".$cext,0);
    
	$fila=$pdf->GetY();
	$fila=$fila+4;
				
	$pdf->SetXY(5,$fila);
	$pdf->Cell(40,5,"Nombre:",0);

	$pdf->SetXY(18,$fila);
	$pdf->Cell(40,5,$nombre,0);

	$pdf->SetXY(80,$fila);
	$pdf->Cell(40,5,"Sexo:",0);

	$pdf->SetXY(88,$fila);
	$pdf->Cell(40,5,$rowusu[sexo_usu],0);

	
	$pdf->SetXY(95,$fila);
	$pdf->Cell(40,5,"Contrato:",0);

	$pdf->SetXY(107,$fila);
	$pdf->Cell(40,5,$rowusu[neps_con],0);

	$pdf->SetXY(155,$fila);
	$pdf->Cell(40,5,"Identificacion:",0);

	$pdf->SetXY(175,$fila);
	$pdf->Cell(40,5,$rowusu[nrod_usu],0);

	$fila=$fila+4;
	
	$pdf->SetXY(5,$fila);
	$pdf->Cell(40,5,"Direccion:",0);
	$pdf->SetFont('Arial','',6);
	$pdf->SetXY(18,$fila);
	$pdf->Cell(40,5,$rowusu[dire_usu],0);
	
	$pdf->SetFont('Arial','',8);
	$pdf->SetXY(75,$fila);
	$pdf->Cell(40,5,"Telefono:",0);

	$pdf->SetXY(88,$fila);
	$pdf->Cell(40,5,$rowusu[tres_usu],0);

	$pdf->SetXY(120,$fila);
	$pdf->Cell(40,5,"F. Nacimiento: ".cambiafechadmy($rowusu[fnac_usu]),0);

	$pdf->SetXY(165,$fila);
	$pdf->Cell(40,5,"Edad:",0);

	$pdf->SetXY(175,$fila);
	$pdf->Cell(40,5,$edad." ".$unidad,0);
	
	$fila=$pdf->GetY();
	$fila=$fila+4;
	linea(5,$fila,205,"_",$pdf);
	$fila=$fila+4;
	$pdf->SetXY(5,$fila);
	$pdf->Cell(40,5,"IMAGENOLOGIA",0);
	$pdf->SetXY(170,$fila);
	$pdf->Cell(40,5,"Fecha: ".cambiafechadmy($row[fech_evo])." ".$row[hora_evo],0);
	$fila=$fila+1;
	linea(5,$fila,205,"_",$pdf);
	$fila=$fila+4;
	$pdf->SetXY(5,$fila);


	$pdf->Cell(40,5,"AYUDAS DIAGNOSTICAS",0);
	$fila=$fila+2;
	linea(5,$fila,205,"_",$pdf);
	$fila=$fila+4;
		
	$pdf->SetXY(5,$fila);
	$pdf->Cell(40,5,"Clase",0);
	$pdf->SetXY(80,$fila);
	$pdf->Cell(40,5,"Descripción",0);
	$pdf->SetXY(150,$fila);
	$pdf->Cell(40,5,"Observaciones",0);
	$fila=$fila+4;
	
	while($rowact=mysql_fetch_array($consultaact))
	{
		$pdf->SetXY(5,$fila);
		$pdf->Cell(40,5,$rowact[clas_var],0);
		$pdf->SetXY(15,$fila);
		$pdf->Cell(40,5,$rowact[iden_ser],0);
		$descrip=$rowact[descrip];
		$obse_var=$rowact[obse_var];
		$pdf->SetFont('Arial','',7);
		$pdf->SetXY(28,$fila);
		$pdf->multicell(115,5,$descrip,0,'J',0);
		$x1=$pdf->GetY(); 
		$pdf->SetXY(150,$fila);
		$pdf->multicell(60,5,$obse_var,0,'J',0);
		$x2=$pdf->GetY();
		if($x1>$x2){
		  $fila=$x1+4;}
		else{
		  $fila=$x2+4;}
	}
	
	
	$pdf->SetXY(5,$fila);
	$fila=$fila+2;
	linea(5,$fila,205,"_",$pdf);
	$fila=$fila+4;
	$pdf->SetXY(5,$fila);
	$pdf->Cell(40,5,"DIAGNOSTICOS",0);	
	$fila=$fila+2;
	linea(5,$fila,205,"_",$pdf);
	$fila=$fila+4;
	$consucie=mysql_query("SELECT nom_cie10 FROM cie_10 where cod_cie10='$dx'");
	if(mysql_num_rows($consucie)<>0){
	  $rowcie=mysql_fetch_array($consucie);
	  $pdf->SetXY(5,$fila);
	  $pdf->Cell(40,5,$row[cod_cie10],0);
	  $pdf->SetXY(15,$fila);
	  $pdf->Cell(40,5,$rowcie[nom_cie10],0);
	}
		
	$consultamed=mysql_query("SELECT nom_medi,reg_medi FROM medicos WHERE cod_medi='$row[cod_medi]'");
	if(mysql_num_rows($consultamed)<>0)
	{
		$rowmed=mysql_fetch_array($consultamed);
		$nom_medi=$rowmed[nom_medi];
		$reg_medi=$rowmed[reg_medi];
	}
	$firma="../firmas/".$row[cod_medi].".jpg";
	if(file_exists($firma)){
	$pdf->Image($firma,100,$fila,50,15,'','');
	}
	$fila=$fila+8;
	linea(100,$fila,50,"_",$pdf);
	$fila=$fila+4;
	$pdf->SetXY(100,$fila);
	$pdf->Cell(40,5,"Dr.".$nom_medi,0);
	$fila=$fila+4;
	$pdf->SetXY(100,$fila);
	$pdf->Cell(40,5,"Reg.".$reg_medi,0);
	
}

$pdf->Output();

mysql_close();
?>
