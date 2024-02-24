<?php
require('fpdf.php');
include('php/funciones.php');
include('php/conexion.php');
include('php/conexiones_g.php');
//include('funciones_impre2.php');
include('funciones_impre.php');


$consultatot=mysql_query("SELECT ef.pcop_fac,ef.vcop_fac,ef.pdes_fac,cmod_fac,SUM(df.cant_dfa*df.valu_dfa) AS total FROM detalle_factura AS df 
                          INNER JOIN encabezado_factura AS ef ON ef.iden_fac=df.iden_fac
						  WHERE ef.iden_fac='$iden_fac' GROUP BY ef.iden_fac");
if(mysql_num_rows($consultatot)){
  $rowtot=mysql_fetch_array($consultatot);
  $vlcopa=$rowtot[vcop_fac];
  //$vldescu=round(($rowtot[total]*($rowtot[pdes_fac]/100)),-1);
  $vldescu=round(($rowtot[total]*($rowtot[pdes_fac]/100)),0);
}

$pdf=new FPDF('P','mm','Letter');
/*$pdf->AddPage();*/
$pdf->SetFont('Arial','',7);
$fila=0;
$col=20;
$pdf->SetFillColor(213, 219, 219); 
$conenca=mysql_query("SELECT codi_emp, nume_fac, nite_emp,razo_emp, dire_emp, tele_emp, enca_emp, pie_emp 
                      FROM empresa WHERE nite_emp='800176807-4'");
$rowenca=mysql_fetch_array($conenca);
$razo_emp=$rowenca[razo_emp];
$nite_emp=$rowenca[nite_emp];
$dire_emp=$rowenca[dire_emp];
$tele_emp=$rowenca[tele_emp];
$enca_emp=$rowenca[enca_emp];
$fila=increm($fila,$pdf,4);
//$nu=date("Y-m-d"); 
//$ho=strftime("%I:%M:%S");
//estos datos hay que trerlos de la tabla creada el viernes

$pag_=1;
//imprefac($iden_fac,$pdf);
imprefac_2($iden_fac,$pdf);

$pdf->Output();
mysql_close();
?>
