<?php

require('fpdf.php');
include('php/conexion.php');
//include('php/funciones.php');

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
	
	}
}

$pdf=new FPDF('P','mm','sticker');
$pdf->SetFont('Arial','',12);
$fila=6;

$nu =date("Y-m-d"); 
$ho=strftime("%I:%M:%S");
	

	
	
		$consulta=mysql_query("SELECT  us.NROD_USU, us.CODI_USU, us.PNOM_USU, us.SNOM_USU, us.PAPE_USU, us.SAPE_USU,us.FNAC_USU,el.iden_labs,el.dxo_labs,dl.nord_dlab
				FROM detalle_labs AS dl
				INNER JOIN encabezado_labs AS el ON el.iden_labs = dl.iden_labs
				INNER JOIN usuario AS us ON us.codi_usu = el.codi_usu
				WHERE el.CODI_USU= '$cod' AND dl.nord_dlab='$nord_lab'");
				
		$row_=mysql_fetch_array($consulta);
				
		
		
		$nord_dlab=$row_[nord_dlab];
		$nrod_usu=$row_[NROD_USU];
		$nom_usu=$row_[PNOM_USU].' '.$row_[PAPE_USU];
		$edad=calculaedad($row_[FNAC_USU]);
		$dx=$row_[dxo_labs];
		$iden_labs=$row_[iden_labs];
		$con=0;
		$desc='';
		for($i=0;$i<$m;$i++)
		{
			
			$nomvar='ord_'.$i;
			$ord_imp=$$nomvar;
			$valor=$ord_imp;
			
			$nomvar='descrip'.$i;
			$descrip=substr($$nomvar,0,3);
		
			$nomvar='clr_imp'.$i;
			$clr_imp=$$nomvar;
			
			$nomvar='prep_cup'.$i;
			$prep_cup=$$nomvar;
			
			$f=0;
			if($i>0)
			{
				for($k=0;$k<$i;$k++)
				{
					$nomvar='ord_'.$k;
					$ord_imp3=$$nomvar;					
					if($ord_imp==$ord_imp3)
					{
						$f=$f+1;				
					}
				}
			}
			
			if($f==0)
			{
				for($j=$i+1;$j<$m;$j++)
				{
					$nomvar='ord_'.$j;
					$ord_imp2=$$nomvar;
					
					$nomvar='descrip'.$j;
					$descrip_=substr($$nomvar,0,3);
					
					$nomvar='clr_imp'.$i;
					$clr_imp2=$$nomvar;

					$nomvar='prep_cup'.$j;
					$prep_=$$nomvar;


					if($ord_imp==$ord_imp2)
					{
						$valor=$valor.' - '.$ord_imp2.' - ';						
						$descrip=$descrip.' - '.$descrip_;
						$clr_imp=$clr_imp.' - '.$clr_imp2;
						$prep_cup=$prep_cup.'-'.$prep_;

					}
					
				
				}
				$t[$con][0]=$valor;
				$t[$con][1]=$descrip;
				$t[$con][2]=$clr_imp;
				$t[$con][3]=$prep_cup;
				$con=$con+1;
				
			}
			
			
		}
		
		//linea(15,$fila+2,70,"_",$pdf);
		for($i=0;$i<$con;$i++)
		{
			
			$pdf->AddPage();
			$descrip=$t[$i][1];
			$clr_imp=$t[$i][2];
			$prep_cup=$t[$i][3];
			//linea(2,1,60,"_",$pdf);
			$pdf->SetXY(2,$fila+1);
			$pdf->Cell(15,3,"HC: ".$nrod_usu,0);
			$pdf->SetXY(35,$fila+1);
			$pdf->Cell(15,3,"Orden: ".$nord_dlab,0);
			$pdf->SetXY(2,$fila+5);
			$pdf->Cell(15,3,"Usuario: ".$nom_usu,0);
			$pdf->SetXY(2,$fila+9);
			$pdf->Cell(15,3,"Edad: ". $edad,0);
			$pdf->SetXY(2,$fila+13);
			$pdf->Cell(15,3,"Tubo: ". $clr_imp,0);
			$pdf->SetXY(2,$fila+17);
			$pdf->Cell(15,3,"EX: ". $prep_cup,0);
			$pdf->SetXY(2,$fila+21);
			$pdf->Cell(15,3,"Fecha: ". $nu." ".$ho,0);
			//linea(15,80,190,"_",$pdf);
			
			
			
		}
		$pdf->Output();
		
		
	function calculaedad($fecha_)
	{
	  $unidad_=" Años";
	  $ano_=substr($fecha_,0,4);
	  $mes_=substr($fecha_,5,2);
	  $dia_=substr($fecha_,8,2);
	  $edad_=date("Y")-$ano_;
	  if (date("m")<=$mes_){
		 $edad_=$edad_-1;
		if (date("m")==$mes_ and $dia_<=date("d")){
		  $edad_=$edad_+1;
		}
	}
	  return($edad_.$unidad_);
}
?>

