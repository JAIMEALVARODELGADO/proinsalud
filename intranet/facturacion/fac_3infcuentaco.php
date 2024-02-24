<?php
require('fpdf.php');
include('php/funciones.php');
include('php/conexion.php');
function increm($fil_,&$pdf,$razo_,$nit_,$dire_,$tele_,&$pag){
  $fil_=$fil_+4;
  if($fil_>=234){
    $fil_=15;
    $pag++;
    $pdf->AddPage();    
    $pdf->Image('icons\encabezado_cuentac.jpg',15,5,190,16,'','');
    $pdf->Image('icons\pie_cuentac.jpg',15,254,190,8,'','');
    $pdf->Image('icons\controlado.jpg',205,100,10,30,'','');
    /*$pdf->SetXY(15,10);
    $pdf->multicell(190,5,$razo_,0,'C');
    $pdf->SetXY(15,13);
    $pdf->multicell(190,5,"Nit: ".$nit_,0,'C');
    $pdf->SetXY(15,16);
    $pdf->multicell(190,5,$dire_." - Tel: ".$tele_,0,'C');*/
    $pdf->SetXY(185,16);
    $pdf->cell(4,4,$pag,0,0,'C');
    $pdf->SetXY(194,16);
    $pdf->Cell(4,4,'{nb}',0,0,'C');    
    
    if($pag==1){$fil_=76;}
    else{$fil_=$fil_+6;}
    
    linea(15,$fil_,190,'_',$pdf);
    $fil_=$fil_+4;
    $pdf->SetXY(15,$fil_);
    $pdf->Cell(5,4,'Con',0,0,'C');    
    $pdf->SetXY(20,$fil_);
    $pdf->Cell(12,4,'Factura',0,0,'C');
    $pdf->SetXY(32,$fil_);
    $pdf->Cell(15,4,'Fecha',0,0,'C');
    $pdf->SetXY(47,$fil_);
    $pdf->Cell(20,4,'Identificacin',0,0,'C');
    $pdf->SetXY(67,$fil_);
    $pdf->Cell(60,4,'Nombre',0,0,'C');
    $pdf->SetXY(127,$fil_);
    $pdf->Cell(15,4,'Vr Facturado',0,0,'R');    
    $pdf->SetXY(142,$fil_);
    $pdf->Cell(14,4,'Copago',0,0,'R');    
    $pdf->SetXY(156,$fil_);
    $pdf->Cell(14,4,'C.Mod',0,0,'R');     
    $pdf->SetXY(170,$fil_);
    $pdf->Cell(14,4,'Desc.',0,0,'R');    
    $pdf->SetXY(185,$fil_);
    $pdf->Cell(20,4,'Vr Neto',0,0,'R');
    linea(15,$fil_,190,'_',$pdf);
    $fil_=$fil_+4;    
  }
  return($fil_);
}

function linea($col_,$fil_,$cant_,$car_,&$pdf){
  for($n=0;$n<$cant_;$n++){
    $pdf->SetXY($col_+$n,$fil_);
	$pdf->Cell(40,5,$car_,0);
  }
}
$pdf=new FPDF('P','mm','Letter');
$pdf->SetFont('Arial','',7);

$conenca=mysql_query("SELECT codi_emp, nume_fac, nite_emp,razo_emp, dire_emp, tele_emp, enca_emp, pie_emp 
                      FROM empresa WHERE nite_emp='800176807-4'");
$rowenca=mysql_fetch_array($conenca);

$concta=mysql_query("SELECT cco.iden_cco,cco.rela_cco,cco.nit_cco,cco.cpto_cco,cco.anex_cco,cco.fech_cco,cco.nota_cco,cco.resp_cco,con.nomr_con,con.nit_con
FROM cuenta_cobro AS cco
INNER JOIN contrato AS con ON con.nit_con=cco.nit_cco
WHERE cco.iden_cco=$iden_cco");
$rowcta=mysql_fetch_array($concta);

$conrel=mysql_query("SELECT ef.rela_fac,SUM(ef.vnet_fac) as total FROM encabezado_factura AS ef 
WHERE ef.rela_fac='$rowcta[rela_cco]' GROUP BY ef.rela_fac");
$rowrel=mysql_fetch_array($conrel);
$fila=250;
$pag=0;
$fila=increm($fila,$pdf,$rowenca[razo_emp],$rowenca[nite_emp],$rowenca[dire_emp],$rowenca[tele_emp],$pag);

$pdf->SetFont('Arial','',10);
$pdf->SetXY(15,24);
$pdf->cell(190,5,'CUENTA DE COBRO',0,0,'C');

$pdf->SetXY(15,24);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(190,5,'Nro: '.$rowcta[rela_cco],0,0,'R');
$pdf->SetFont('Arial','',10);
$pdf->SetXY(15,30);
$pdf->Cell(190,5,$rowcta[nomr_con],0,0,'C');
$pdf->SetXY(15,36);
$pdf->Cell(190,5,'NIT '.$rowcta[nit_con],0,0,'C');

$pdf->SetXY(15,42);
$pdf->Cell(190,5,'DEBE A:',0,0,'C');
$pdf->SetXY(15,50);
$pdf->Cell(190,5,$rowenca[razo_emp],0,0,'C');
$pdf->SetXY(15,56);
$pdf->Cell(190,5,'NIT '.$rowenca[nite_emp],0,0,'C');
$pdf->SetFont('Arial','',7);
$pdf->SetXY(15,62);
$pdf->Cell(190,4,'La suma de: '.convertir($rowrel[total]),0,0,'L');
$pdf->SetXY(15,66);
$pdf->Cell(190,4,'Valor: $ '.number_format($rowrel[total],0),0,0,'L');
$pdf->SetXY(15,70);
$pdf->multicell(190,4,'Por concepto de: '.$rowcta[cpto_cco],0,'J');
$condet=mysql_query("SELECT fac.nume_fac,fac.fcie_fac,fac.vtot_fac,fac.vcop_fac,fac.pdes_fac,fac.cmod_fac,fac.vnet_fac,
usu.nrod_usu,CONCAT(usu.pnom_usu,' ',usu.snom_usu,' ',usu.pape_usu,' ',usu.sape_usu,' ') AS nombre
FROM encabezado_factura AS fac
INNER JOIN usuario AS usu ON usu.codi_usu=fac.codi_usu
WHERE fac.rela_fac='$rowcta[rela_cco]' ORDER BY fac.nume_fac");
$totfac=0;
$totcop=0;
$totmod=0;
$totdes=0;  
$cont=1;
while($rowdet=mysql_fetch_array($condet)){
  $pdf->SetXY(15,$fila);
  $pdf->Cell(5,4,$cont,0,0,'R');
  $pdf->SetXY(20,$fila);
  $pdf->Cell(20,4,$rowdet[nume_fac],0,0,'L');  
  $pdf->SetXY(32,$fila);
  $pdf->Cell(15,4,cambiafechadmy($rowdet[fcie_fac]),0,0,'C');
  $pdf->SetXY(47,$fila);
  $pdf->Cell(20,4,$rowdet[nrod_usu],0,0,'L');
  $pdf->SetXY(67,$fila);
  $nombre=substr($rowdet[nombre],0,50);
  $pdf->Cell(60,4,$nombre,0,0,'L');
  $pdf->SetXY(127,$fila);
  $pdf->Cell(15,4,number_format($rowdet[vtot_fac]),0,0,'R');
  $pdf->SetXY(142,$fila);
  $pdf->Cell(14,4,number_format($rowdet[vcop_fac]),0,0,'R');  
  $pdf->SetXY(156,$fila);
  $pdf->Cell(14,4,number_format($rowdet[cmod_fac]),0,0,'R');  
  $descuento=number_format($rowdet[vtot_fac]*$rowdet[pdes_fac]/100,0);
  $pdf->SetXY(170,$fila);
  $pdf->Cell(14,4,$descuento,0,0,'R');  
  $pdf->SetXY(185,$fila);
  $pdf->Cell(20,4,number_format($rowdet[vnet_fac],0),0,0,'R');
  $fila=increm($fila,$pdf,$rowenca[razo_emp],$rowenca[nite_emp],$rowenca[dire_emp],$rowenca[tele_emp],$pag);
  $totfac=$totfac+$rowdet[vtot_fac];
  $totcop=$totcop+$rowdet[vcop_fac];
  $totmod=$totmod+$rowdet[cmod_fac];
  $totdes=$totdes+$descuento;
  $cont++;
}
linea(15,$fila,190,'_',$pdf);
$fila=$fila+4;
$pdf->SetXY(80,$fila);
$pdf->Cell(35,4,'TOTAL',0,2,'R');
$pdf->SetXY(127,$fila);
$pdf->Cell(15,4,number_format($totfac),0,0,'R');
$pdf->SetXY(142,$fila);
$pdf->Cell(14,4,number_format($totcop),0,0,'R');
$pdf->SetXY(156,$fila);
$pdf->Cell(14,4,number_format($totmod),0,0,'R');
$pdf->SetXY(170,$fila);
$pdf->Cell(14,4,number_format($totdes),0,0,'R');
$pdf->SetXY(185,$fila);
$pdf->cell(20,4,number_format($rowrel[total],0),0,0,'R'); 
linea(15,$fila,190,'_',$pdf);
$fila=$fila+4;
$pdf->SetXY(15,$fila);
$pdf->Cell(30,4,'Cordialmente:',0,0,'L');
$fila=$fila+8;
$pdf->SetXY(25,$fila);
$pdf->Cell(60,4,$rowcta[resp_cco],0,0,'C');
$fila=$fila+1;
$pdf->SetXY(25,$fila);
$pdf->Cell(60,4,'____________________________________________',0,0,'C');
$pdf->SetXY(115,$fila);
$pdf->Cell(60,4,'____________________________________________',0,0,'C');

$fila=$fila+4;
$pdf->SetXY(25,$fila);
$pdf->Cell(60,4,'FUNCIONARIO RESPONSABLE',0,0,'C');
$pdf->SetXY(115,$fila);
$pdf->Cell(60,4,'Vo.Bo',0,0,'C');

$fila=$fila+4;
$pdf->SetXY(25,$fila);
$pdf->Cell(60,4,'AREA FACTURACION',0,0,'C');
$pdf->SetXY(115,$fila);
$pdf->Cell(60,4,'COORDINADOR DE FACTURACION',0,0,'C');

$fila=$fila+6;
$pdf->SetXY(15,$fila);
$pdf->multicell(190,4,'Se anexa: '.$rowcta[anex_cco],0,'J');
$fila=$pdf->Gety()+2;
$pdf->SetXY(15,$fila);
$pdf->Cell(100,4,'Se firma en San Juan de Pasto, a los '.$rowcta[fech_cco],0,0,'L'); 
$fila=$fila+6;
$pdf->SetXY(15,$fila);
$pdf->multicell(190,4,$rowcta[nota_cco],0,'J');
$fila=$fila+4;
linea(15,$fila,190,'_',$pdf);
$pdf->AliasNbPages();
$pdf->Output();
?>
