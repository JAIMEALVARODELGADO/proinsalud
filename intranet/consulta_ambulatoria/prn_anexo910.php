<?php
include('../informinis/php/funciones.php');
include('../informinis/php/conexiones_g.php');
//include('php/texto.php');
ob_end_clean();
include('fpdf.php');
function linea($col_,$fil_,$cant_,$car_,&$pdf)
{
  for($n=0;$n<$cant_;$n++){
    $pdf->SetXY($col_+$n,$fil_);
    $pdf->Cell(1,4,$car_,0);
  }
}

function cuadro($col1_,$fil1_,$col2_,$fil2_,&$pdf)
{
  for($n=$col1_;$n<$col2_;$n++){
    $pdf->SetXY($n,$fil1_);
    $pdf->Cell(1,3,'_',0);
  }
  for($n=$col1_;$n<$col2_;$n++){
    $pdf->SetXY($n,$fil2_);
    $pdf->Cell(1,3,'_',0);
  }
  for($n=$fil1_+2;$n<=$fil2_;$n++){
    $pdf->SetXY($col1_,$n);
    $pdf->Cell(1,3,'|',0);
  }
  for($n=$fil1_+2;$n<=$fil2_;$n++){
    $pdf->SetXY($col2_,$n);
    $pdf->Cell(1,3,'|',0);
  }
}

function imprecuadro($col_,$fil_,$texto_,&$pdf){
  $cols_=strlen($texto_);
  for($c_==0;$c_<$cols_;$c_++){
    $pdf->SetXY($col_,$fil_);
    $pdf->Cell(3,4,substr($texto_,$c_,1),1,4,'C');
    $col_=$col_+3;
  }
}

base_proinsalud();

$pdf=new FPDF('P','mm','Letter');
$pdf->AddPage();

$consultarel="SELECT consultaprincipal.numc_cpl, refer_at910.servorig_rat, refer_at910.idenorig_rat, refer_at910.tipo_rat, refer_at910.infor_rat
FROM consultaprincipal INNER JOIN refer_at910 ON consultaprincipal.iden_cpl = refer_at910.idenorig_rat
WHERE (((refer_at910.servorig_rat)='$servorig_rat') AND ((refer_at910.idenorig_rat)='$idenorig_rat'))";
$consultarel=mysql_query($consultarel);
$rowrel=mysql_fetch_array($consultarel);

$consultaemp="SELECT razo_emp,nite_emp,codp_emp,dire_emp,tele_emp FROM empresa";
$consultaemp=mysql_query($consultaemp);
$rowemp=mysql_fetch_array($consultaemp);
if($servorig_rat=="CE"){
    $consulta="SELECT ref.fech_ref AS fecha,ref.numc_ref,ref.asol_ref,deta.alse_dre AS servrem,
    usu.pnom_usu,snom_usu,pape_usu,sape_usu,usu.nrod_usu,usu.fnac_usu,usu.tdoc_usu,usu.dire_usu,usu.tres_usu,usu.mate_usu,
    con.ceps_con,con.neps_con,
    med.cod_medi,med.nom_medi,med.telf_medi,med.reg_medi,
    serv.nomb_des AS servicio
    FROM detareferencia AS deta
    INNER JOIN referencia AS ref ON ref.idre_ref=deta.idre_dre
    INNER JOIN ucontrato AS uco ON uco.iden_uco=ref.cuco_ref
    INNER JOIN usuario AS usu ON usu.codi_usu=uco.cusu_uco
    INNER JOIN contrato AS con ON con.codi_con=uco.cont_uco
    INNER JOIN medicos AS med ON med.cod_medi=msol_ref
    INNER JOIN destipos AS serv ON serv.codi_des=deta.alse_dre
    WHERE deta.numc_dre='$rowrel[numc_cpl]'";
}
/*else{
    $consulta="SELECT ingreso_hospitalario.id_ing, hist_evo.codi_usu,hist_evo.anal_evo,usuario.tdoc_usu,usuario.nrod_usu,usuario.pnom_usu,usuario.snom_usu,usuario.pape_usu,usuario.sape_usu,usuario.fnac_usu,usuario.dire_usu,usuario.tres_usu,usuario.mate_usu, hist_evo.fech_evo AS fecha,hist_evo.hora_evo AS hora,hist_evo.cama_evo, medicos.nom_medi,hist_var.iden_var,hist_var.clas_var, hist_var.iden_ser AS servrem, ingreso_hospitalario.contra_ing, contrato.neps_con,contrato.ceps_con, ucontrato.ESTA_UCO
    FROM ((((ingreso_hospitalario 
    INNER JOIN (hist_var 
    INNER JOIN hist_evo ON hist_var.iden_evo = hist_evo.iden_evo) ON ingreso_hospitalario.id_ing = hist_evo.id_ing) 
    INNER JOIN usuario ON ingreso_hospitalario.codius_ing = usuario.CODI_USU) 
    INNER JOIN medicos ON hist_evo.cod_medi = medicos.cod_medi) 
    INNER JOIN contrato ON ingreso_hospitalario.contra_ing = contrato.CODI_CON) 
    INNER JOIN ucontrato ON usuario.CODI_USU = ucontrato.CUSU_UCO
    WHERE hist_var.iden_var='$idenorig_rat'";
}*/
//echo $consulta;
$consulta=mysql_query($consulta);
$row=mysql_fetch_array($consulta);
$idusu=$row[cod_medi];
$hora=$row[hora];
$servrem=$row[servrem];
        
$consultamun="SELECT nomb_mun,nomb_dep FROM municipio 
INNER JOIN departamento ON codi_dep=depa_mun
WHERE codi_mun='$row[mate_usu]'";
$consultamun=mysql_query($consultamun);
$rowmun=mysql_fetch_array($consultamun);

if($servorig_rat=="CE"){
    $consultahor="SELECT hora_cpl FROM consultaprincipal
    WHERE numc_cpl='$row[numc_ref]'";
    $consultahor=mysql_query($consultahor);
    $rowhor=mysql_fetch_array($consultahor);
    $hora=$rowhor[hora_cpl];
}

$pdf->Image('../informinis/img/escudo.png',15,7);
$pdf->Image('../informinis/img/proinsalud.png',190,7,10,13);

$pdf->SetXY(80,8);
$pdf->SetFont('Arial','',10);
$pdf->Cell(80,4,"MINISTERIO DE LA PROTECCION SOCIAL",0,4,'C');
$pdf->SetXY(80,15);
if($rowrel[tipo_rat]=='R'){
    $pdf->Cell(80,4,"FORMATO ESTANDARIZADO DE REFERENCIA DE PACIENTES",0,4,'C');
}
else{
    $pdf->Cell(80,4,"FORMATO ESTANDARIZADO DE CONTRAREFERENCIA DE PACIENTES",0,4,'C');
}
$pdf->SetFont('Arial','',7);

   
cuadro(5,4,210,256,$pdf);
$fila=25;

$pdf->SetXY(130,$fila);
$pdf->Cell(10,4,"FECHA: ",0,3,'R');
imprecuadro(140,$fila,cambiafechadmy($row[fecha]),$pdf);

$pdf->SetXY(179,$fila);
$pdf->Cell(10,4,"HORA: ",0,3,'R');
imprecuadro(190,$fila,substr($hora,0,5),$pdf);

$fila=$fila+4;
$pdf->SetXY(7,$fila);

if($rowrel[tipo_rat]=='R'){
    $pdf->Cell(203,4,"INFORMACION DEL PRESTADOR",1,3,'L');
}
else{
    $pdf->Cell(203,4,"INFORMACION DEL PRESTADOR QUE RESPONDE",1,3,'L');
}
$fila=$fila+5;
$pdf->SetXY(7,$fila);
$pdf->Cell(30,4,"Nombre: ",0,3,'L');
imprecuadro(30,$fila,$rowemp[razo_emp],$pdf);

$pdf->SetXY(150,$fila);
$pdf->Cell(4,4,"NIT",0,3,'C');
imprecuadro(156,$fila,'X',$pdf);
imprecuadro(162,$fila,$rowemp[nite_emp],$pdf);

$fila=$fila+4;
$pdf->SetXY(150,$fila);
$pdf->Cell(4,4,"CC",0,3,'C');
imprecuadro(156,$fila,' ',$pdf);

$fila=$fila+4;
$pdf->SetXY(7,$fila);
$pdf->Cell(30,4,"Código: ",0,3,'L');
imprecuadro(30,$fila,$rowemp[codp_emp],$pdf);
$pdf->SetXY(80,$fila);
$pdf->Cell(20,4,"Dirección: ",0,3,'L');
imprecuadro(100,$fila,substr($rowemp[dire_emp],0,30),$pdf);
$fila=$fila+4;
$pdf->SetXY(7,$fila);
$pdf->Cell(30,4,"Teléfono: ",0,3,'L');
imprecuadro(30,$fila,$rowemp[tele_emp],$pdf);
$pdf->SetXY(80,$fila);
$pdf->Cell(20,4,"Departamento: ",0,3,'L');
imprecuadro(100,$fila,"NARIÑO",$pdf);
$pdf->SetXY(155,$fila);
$pdf->Cell(20,4,"Municipio: ",0,3,'L');
imprecuadro(175,$fila,"PASTO",$pdf);

$fila=$fila+6;
$pdf->SetXY(7,$fila);
$pdf->Cell(203,4,"DATOS DEL PACIENTE",1,4,'C');

$fila=$fila+5;
imprecuadro(7,$fila,$row[pnom_usu],$pdf);
imprecuadro(47,$fila,$row[snom_usu],$pdf);
imprecuadro(87,$fila,$row[pape_usu],$pdf);
imprecuadro(127,$fila,$row[sape_usu],$pdf);

$fila=$fila+4;
$pdf->SetXY(7,$fila);
$pdf->Cell(20,4,"1er Nombre",0,4,'L');
$pdf->SetXY(47,$fila);
$pdf->Cell(20,4,"2do Nombre",0,4,'L');
$pdf->SetXY(87,$fila);
$pdf->Cell(20,4,"1er Apellido",0,4,'L');
$pdf->SetXY(127,$fila);
$pdf->Cell(20,4,"2do Apellido",0,4,'L');

$fila=$fila+6;
$pdf->SetXY(7,$fila);
$pdf->Cell(20,4,"Tipo de Documento de Identificación:",0,4,'L');

$fila=$fila+6;
imprecuadro(7,$fila,' ',$pdf);
$pdf->SetXY(10,$fila);
$pdf->Cell(40,4,"Registro Civil",0,4,'L');
imprecuadro(50,$fila,' ',$pdf);
$pdf->SetXY(53,$fila);
$pdf->Cell(40,4,"Pasaporte",0,4,'L');
imprecuadro(140,$fila,$row[nrod_usu],$pdf);

$fila=$fila+4;
imprecuadro(7,$fila,' ',$pdf);
$pdf->SetXY(10,$fila);
$pdf->Cell(40,4,"Tarjeta de Identidad",0,4,'L');
$pdf->SetXY(140,$fila);
$pdf->Cell(40,4,"Número de Documento de Identificación",0,4,'L');
imprecuadro(50,$fila,' ',$pdf);
$pdf->SetXY(53,$fila);
$pdf->Cell(40,4,"Adulto sin Identificación",0,4,'L');

$fila=$fila+4;
imprecuadro(7,$fila,' ',$pdf);
$pdf->SetXY(10,$fila);
$pdf->Cell(40,4,"Cédula de Ciudadania",0,4,'L');
imprecuadro(50,$fila,' ',$pdf);
$pdf->SetXY(53,$fila);
$pdf->Cell(40,4,"Menor sin Identificación",0,4,'L');

$fila=$fila+4;
imprecuadro(7,$fila,' ',$pdf);
$pdf->SetXY(10,$fila);
$pdf->Cell(40,4,"Cédula de Extranjería",0,4,'L');
$pdf->SetXY(113,$fila);
$pdf->Cell(25,4,"Fecha de Nacimiento:",0,4,'L');
imprecuadro(140,$fila,cambiafechadmy($row[fnac_usu]),$pdf);

//$tdoc_="MS";
//switch($tdoc_){
switch($row[tdoc_usu]){
    case 'RC':
        $col_=7.5;
        $fil_=$fila-12;
        break;
    case 'TI':
        $col_=7.5;
        $fil_=$fila-8;
        break;
    case 'CC':
        $col_=7.5;
        $fil_=$fila-4;
        break;
    case 'CE':
        $col_=7.5;
        $fil_=$fila;
        break;
    case 'PA':
        $col_=50.5;
        $fil_=$fila-12;
        break;
    case 'AS':
        $col_=50.5;
        $fil_=$fila-8;
        break;
    case 'MS':
        $col_=50.5;
        $fil_=$fila-4;
        break;
}
$pdf->SetXY($col_,$fil_);
$pdf->Cell(2,4,"X",0,4,'C');

$fila=$fila+4;
$pdf->SetXY(7,$fila);
$pdf->Cell(40,4,"Dirección de Residencia Habitual:",0,4,'L');
imprecuadro(50,$fila,$row[dire_usu],$pdf);
$pdf->SetXY(155,$fila);
$pdf->Cell(40,4,"Teléfono:",0,4,'L');
imprecuadro(170,$fila,$row[tres_usu],$pdf);

$fila=$fila+4;
$pdf->SetXY(7,$fila);
$pdf->Cell(20,4,"Departamento: ",0,3,'L');
imprecuadro(30,$fila,$rowmun[nomb_dep],$pdf);
$pdf->SetXY(100,$fila);
$pdf->Cell(20,4,"Municipio: ",0,3,'L');
imprecuadro(115,$fila,$rowmun[nomb_mun],$pdf);

$fila=$fila+4;
$pdf->SetXY(7,$fila);
$pdf->Cell(20,4,"ENTIDAD RESPONSABLE DEL PAGO: ",0,3,'L');
imprecuadro(55,$fila,$row[neps_con],$pdf);
$pdf->SetXY(168,$fila);
$pdf->Cell(20,4,"CODIGO: ",0,3,'L');
imprecuadro(182,$fila,$row[ceps_con],$pdf);

$fila=$fila+6;
$pdf->SetXY(7,$fila);
$pdf->Cell(203,4,"DATOS DE LA PERSONA RESPONSABLE DEL PACIENTE",1,4,'C');

$consultaaco="SELECT noma_aco,dire_aco,tele_aco,tdoc_aco,ndoc_aco,munr_aco FROM acompanante WHERE numc_aco='$row[numc_ref]'";
//echo $consultaaco;
$consultaaco=mysql_query($consultaaco);
$rowaco=mysql_fetch_array($consultaaco);
$fila=$fila+5;
imprecuadro(7,$fila,$rowaco[noma_aco],$pdf);

$fila=$fila+4;
$pdf->SetXY(7,$fila);
$pdf->Cell(20,4,"Nombre",0,4,'L');

$fila=$fila+6;
$pdf->SetXY(7,$fila);
$pdf->Cell(20,4,"Tipo de Documento de Identificación:",0,4,'L');

$fila=$fila+6;
imprecuadro(7,$fila,' ',$pdf);
$pdf->SetXY(10,$fila);
$pdf->Cell(40,4,"Registro Civil",0,4,'L');
imprecuadro(50,$fila,' ',$pdf);
$pdf->SetXY(53,$fila);
$pdf->Cell(40,4,"Pasaporte",0,4,'L');
imprecuadro(140,$fila,$rowaco[ndoc_aco],$pdf);

$fila=$fila+4;
imprecuadro(7,$fila,' ',$pdf);
$pdf->SetXY(10,$fila);
$pdf->Cell(40,4,"Tarjeta de Identidad",0,4,'L');
$pdf->SetXY(140,$fila);
$pdf->Cell(40,4,"Número de Documento de Identificación",0,4,'L');
imprecuadro(50,$fila,' ',$pdf);
$pdf->SetXY(53,$fila);
$pdf->Cell(40,4,"Adulto sin Identificación",0,4,'L');

$fila=$fila+4;
imprecuadro(7,$fila,' ',$pdf);
$pdf->SetXY(10,$fila);
$pdf->Cell(40,4,"Cédula de Ciudadania",0,4,'L');
imprecuadro(50,$fila,' ',$pdf);
$pdf->SetXY(53,$fila);
$pdf->Cell(40,4,"Menor sin Identificación",0,4,'L');

$fila=$fila+4;
imprecuadro(7,$fila,' ',$pdf);
$pdf->SetXY(10,$fila);
$pdf->Cell(40,4,"Cédula de Extranjería",0,4,'L');
$pdf->SetXY(113,$fila);

switch($rowaco[tdoc_aco]){
    case 'RC':
        $col_=7.5;
        $fil_=$fila-12;
        break;
    case 'TI':
        $col_=7.5;
        $fil_=$fila-8;
        break;
    case 'CC':
        $col_=7.5;
        $fil_=$fila-4;
        break;
    case 'CE':
        $col_=7.5;
        $fil_=$fila;
        break;
    case 'PA':
        $col_=50.5;
        $fil_=$fila-12;
        break;
    case 'AS':
        $col_=50.5;
        $fil_=$fila-8;
        break;
    case 'MS':
        $col_=50.5;
        $fil_=$fila-4;
        break;
}
$pdf->SetXY($col_,$fil_);
$pdf->Cell(2,4,"X",0,4,'C');


$fila=$fila+4;
$pdf->SetXY(7,$fila);
$pdf->Cell(40,4,"Dirección de Residencia Habitual:",0,4,'L');
imprecuadro(50,$fila,$rowaco[dire_aco],$pdf);
$pdf->SetXY(155,$fila);
$pdf->Cell(40,4,"Teléfono:",0,4,'L');
imprecuadro(170,$fila,$rowaco[tele_aco],$pdf);

$fila=$fila+4;
$pdf->SetXY(7,$fila);
$pdf->Cell(20,4,"Departamento: ",0,3,'L');
$consmun="SELECT nomb_dep,nomb_mun FROM municipio INNER JOIN departamento ON departamento.codi_dep=municipio.depa_mun WHERE codi_mun='$rowaco[munr_aco]'";
$consmun=mysql_query($consmun);
if(mysql_num_rows($consmun)<>0){
    $rowmun=mysql_fetch_array($consmun);
    imprecuadro(30,$fila,$rowmun[nomb_dep],$pdf);
    $pdf->SetXY(100,$fila);
    $pdf->Cell(20,4,"Municipio: ",0,3,'L');
    imprecuadro(115,$fila,$rowmun[nomb_mun],$pdf);
}
$fila=$fila+6;
$pdf->SetXY(7,$fila);
if($rowrel[tipo_rat]=='R'){
    $pdf->Cell(203,4,"PROFESIONAL QUE SOLICITA LA REFERENCIA Y SERVICIO AL CUAL SE REMITE",1,4,'C');
}
else{
    $pdf->Cell(203,4,"PROFESIONAL QUE CONTRAREFIERE",1,4,'C');
}

$fila=$fila+5;
$pdf->SetXY(7,$fila);
$pdf->Cell(20,4,"Nombre:",0,4,'L');
imprecuadro(20,$fila,$row[nom_medi],$pdf);
$pdf->SetXY(155,$fila);
$pdf->Cell(20,4,"Teléfono:",0,4,'L');
imprecuadro(170,$fila,$row[telf_medi],$pdf);

if($servorig_rat=="CE"){
    $conserv="SELECT nom_areas AS serv_sol FROM areas WHERE cod_areas='$row[asol_ref]'";
}
else{
    $conserv="SELECT servicio.nomb_des AS serv_sol
    FROM destipos INNER JOIN destipos AS servicio ON destipos.valo_des = servicio.codi_des
    WHERE destipos.codi_des='$row[cama_evo]'";
}
$conserv=mysql_query($conserv);
$rowserv=mysql_fetch_array($conserv);

if(empty($row[clas_var]) OR $row[clas_var]=="I"){
    $conserv_rem="SELECT nomb_des AS nom_serv FROM destipos WHERE codi_des='$servrem'";
}
else{
    $conserv_rem="SELECT descrip AS nom_serv FROM cups WHERE codigo='$servrem'";
}
//echo $conserv_rem;
$conserv_rem=mysql_query($conserv_rem);
$rowserv_rem=mysql_fetch_array($conserv_rem);
        
$fila=$fila+4;
$pdf->SetXY(7,$fila);

if($rowrel[tipo_rat]=='R'){
    $pdf->Cell(20,4,"Servicio que solicita la referencia:",0,4,'L');
    imprecuadro(50,$fila,$rowserv[serv_sol],$pdf);
    $fila=$fila+4;
    $pdf->SetXY(7,$fila);
    $pdf->Cell(20,4,"Servicio para el cual se solicita la referencia:",0,4,'L');
    imprecuadro(60,$fila,$rowserv_rem[nom_serv],$pdf);
}
else{
    $pdf->Cell(20,4,"Servicio que contrarefiere:",0,4,'L');
    imprecuadro(50,$fila,$rowserv[nom_areas],$pdf);    
}

$fila=$fila+6;
$pdf->SetXY(7,$fila);
$pdf->Cell(203,4,"INFORMACION CLINICA RELEVANTE",1,4,'C');

$fila=$fila+6;
$pdf->SetXY(7,$fila);
$pdf->MultiCell(202,4,$rowrel[infor_rat],0,'J');


$fila=251;

//firma 
if(file_exists('../firmas/'.$idusu.'.jpg')){
    $pdf->Image('../firmas/'.$idusu.'.jpg',80,$fila-15,40,20);}
$pdf->SetXY(7,$fila);
$pdf->Cell(203,4,'Reg. '.$row[reg_medi],0,4,'C');
$fila=$fila+4;
$pdf->SetXY(7,$fila);
$pdf->Cell(203,4,"FIRMA Y REGISTRO DEL PROFESIONAL",0,4,'C');

  
$pdf->Output();
 
mysql_free_result($consulta);
mysql_free_result($consultarel);
mysql_free_result($consultaemp);
mysql_free_result($consultamun);
mysql_free_result($consultaaco);

mysql_close();

?> 