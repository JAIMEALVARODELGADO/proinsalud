<?php

function redimensionar_jpeg($img_original, $img_nueva, $img_nueva_anchura, $img_nueva_altura, $img_nueva_calidad)
{ 

	$si=getimagesize($img_original);

	$ancho1=$si[0];
	$alto1=$si[1];


	if($ancho1>$alto1)
	{

		$ratio=$alto1/$ancho1;
		$img_nueva_altura=$img_nueva_anchura*$ratio;
	}
	else
	{
		$ratio=$ancho1/$alto1;
		$img_nueva_anchura=$img_nueva_altura*$ratio;
	}

	// crear una imagen desde el original 
	$img = ImageCreateFromJPEG($img_original); 
	// crear una imagen nueva 
	$thumb = imagecreatetruecolor($img_nueva_anchura,$img_nueva_altura); 
	// redimensiona la imagen original copiandola en la imagen 
	imagecopyresampled($thumb,$img,0,0,0,0,$img_nueva_anchura,$img_nueva_altura,ImageSX($img),ImageSY($img)); 
 	// guardar la nueva imagen redimensionada donde indicia $img_nueva 
	ImageJPEG($thumb,$img_nueva,$img_nueva_calidad);
	ImageDestroy($img);
}

function clas_are($cod_){
  switch ($cod_){
    case 'I':
	  $nom_='Interno';
	  break;
    case 'E':
	  $nom_='Externo';
	  break;
  }
  return $nom_;
}

function tipo_are($cod_){
  switch ($cod_){
    case '1':
	  $nom_='Asistencial';
	  break;
    case '2':
	  $nom_='Administrativo';
	  break;
  }
  return $nom_;
}

function estado($cod_){
  switch ($cod_){
    case 'A':
	  $nom_='Activo';
	  break;
    case 'I':
	  $nom_='Inactivo';
	  break;
  }
  return $nom_;
}

//Calcula la edad en años, a partir de una fecha dada comparada con la fecha de hoy
function calculaedad($fecha_){
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
    if(date("m")-$mes_==0 & date("d")-$dia_<0){$anos_=$anos_-1;}
     $meses_=11;
  }

  if($anos_<>0)
  {
    $edad_=$anos_;
    if($edad_==1){
      $unidad_=" Año";}
    else{
      $unidad_=" Años";}
  }
  else
  {
    if($meses_<>0){
      $edad_=$meses_;
      if($edad_==1){
        $unidad_=" Mes";}
      else{
        $unidad_=" Meses";}
    }
    else{
      $edad_=$dias_;
      if($edad_==1){
        $unidad_=" Día";}
      else{
        $unidad_=" Días";}
    }
  }
  return($edad_.$unidad_);
}

//Valida si el estado del usuario es "AC" y la fecha de vencimiento de la novedad es mayor a hoy, retorna el estado "SU"
//toma el estado del usuario, la fecha de finalización de la novedad y la descripcion de la novedad.
function valestado($estado_,$ffinal_,$descripcion)
{
  if ($ffinal_<>"0000-00-00" and $estado_=="AC"){
    $hoy_=date("Y")."-".date("m")."-".date("d");
    if($ffinal_<$hoy_){
      $descripcion="Suspendido por vencimiento de la novedad";
    }
  }
  return($descripcion);
}

//Funcion que retorna la fecha actual en el formato "dd/mm/aaaa"
function hoy()
{
   $hoy_=date("d").'/'.date("m").'/'.date("Y");
   return $hoy_;
}

//Funcion que cambia el formato de la fecha que recibe
//la recibe en formato "dd/mm/yyyy" y la retorna en formato "yyyy/mm/dd"
function cambiafecha($xfecha_)
{
  $xdia_=substr($xfecha_,0,2);
  $xmes_=substr($xfecha_,3,2);
  $xanio_=substr($xfecha_,6,4);
  $xfecha_=$xanio_."/".$xmes_."/".$xdia_;
  return $xfecha_;
}

//Funcion que cambia el formato de la fecha que recibe
//la recibe en formato "yyyy-mm-dd"  y la retorna en formato "dd/mm/yyyy"
function cambiafechadmy($xfecha_)
{
  $xanio_=substr($xfecha_,0,4);
  $xmes_=substr($xfecha_,5,2);
  $xdia_=substr($xfecha_,8,2);
  $xfecha_=$xdia_."/".$xmes_."/".$xanio_;
  return $xfecha_;
}

//Calcula la edad en años, meses o días, a partir de una fecha dada comparada con la fecha de hoy
//la fecha viene en formato "dd/mm/yyyy"
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
      $unidad_="Año";}
    else{
      $unidad_="Años";}
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
        $unidad_="Día";}
      else{
        $unidad_="Días";}
    }
  }
  return($edad_);
}

//Suma una cantidad de dias a la fecha
//la fecha viene en formato "dd/mm/yyyy"
function sumadias($fecha_,$dias_){
  $xdia_=substr($fecha_,0,2);
  $xmes_=substr($fecha_,3,2);
  $xanio_=substr($fecha_,6,4);
  $mes_=floor($dias_/30);
  $xdiass_=$dias_%30;
  $xdia_=$xdia_+$xdiass_;
  if($xdia_>30){
    $xmes_=$xmes_+1;
	$xdia_=str_pad($xdia_-30,2,'0',str_pad_left);
  }
  $xmes_=$xmes_+$mes_;
  if($xmes_>12){
    $xanio_=$xanio_+1;
	$xmes_=str_pad($xmes_-12,2,'0',str_pad_left);
  }
  $fecha_=$xdia_.'/'.$xmes_."/".$xanio_;  
  return($fecha_);
}

//Calcula los dias trascurridos entre dos fechas
//parámetros: fecha inicial, fechafinal en formato dd/mm/yyyy
function calculadias($fecha1_,$fecha2_){
  $ano1_=substr($fecha1_,6,4);
  $mes1_=substr($fecha1_,3,2);
  $dia1_=substr($fecha1_,0,2);
  $ano2_=substr($fecha2_,6,4);
  $mes2_=substr($fecha2_,3,2);
  $dia2_=substr($fecha2_,0,2);
  
  //calculo timestam de las dos fechas
  $timestamp1 = mktime(0,0,0,$mes1_,$dia1_,$ano1_);
  $timestamp2 = mktime(4,12,0,$mes2_,$dia2_,$ano2_);
  //resto a una fecha la otra
  $segundos_diferencia = $timestamp1 - $timestamp2;
  //echo $segundos_diferencia;
  //convierto segundos en días
  $dias_= $segundos_diferencia / (60 * 60 * 24);
  //obtengo el valor absoulto de los días (quito el posible signo negativo)
  $dias_= abs($dias_);
  //quito los decimales a los días de diferencia
  $dias_=floor($dias_);
  //echo "dias funcion  ".$dias_; 




  
  /*$anos_=$ano2_-$ano1_;
  $meses_=$mes2_-$mes1_;
  $dias_=$dia2_-$dia1_;
  $dias_=$dias_+($anos_*364)+($meses_*30);*/
  return($dias_);
}

//convertir valores en texto

function unidad($numuero){
	switch ($numuero)
	{
		case 9:
		{
			$numu = "NUEVE";
			break;
		}
		case 8:
		{
			$numu = "OCHO";
			break;
		}
		case 7:
		{
			$numu = "SIETE";
			break;
		}		
		case 6:
		{
			$numu = "SEIS";
			break;
		}		
		case 5:
		{
			$numu = "CINCO";
			break;
		}		
		case 4:
		{
			$numu = "CUATRO";
			break;
		}		
		case 3:
		{
			$numu = "TRES";
			break;
		}		
		case 2:
		{
			$numu = "DOS";
			break;
		}		
		case 1:
		{
			$numu = "UN";
			break;
		}		
		case 0:
		{
			$numu = "";
			break;
		}		
	}
	return $numu;	
}

function decena($numdero){
	
		if ($numdero >= 90 && $numdero <= 99)
		{
			$numd = "NOVENTA ";
			if ($numdero > 90)
				$numd = $numd."Y ".(unidad($numdero - 90));
		}
		else if ($numdero >= 80 && $numdero <= 89)
		{
			$numd = "OCHENTA ";
			if ($numdero > 80)
				$numd = $numd."Y ".(unidad($numdero - 80));
		}
		else if ($numdero >= 70 && $numdero <= 79)
		{
			$numd = "SETENTA ";
			if ($numdero > 70)
				$numd = $numd."Y ".(unidad($numdero - 70));
		}
		else if ($numdero >= 60 && $numdero <= 69)
		{
			$numd = "SESENTA ";
			if ($numdero > 60)
				$numd = $numd."Y ".(unidad($numdero - 60));
		}
		else if ($numdero >= 50 && $numdero <= 59)
		{
			$numd = "CINCUENTA ";
			if ($numdero > 50)
				$numd = $numd."Y ".(unidad($numdero - 50));
		}
		else if ($numdero >= 40 && $numdero <= 49)
		{
			$numd = "CUARENTA ";
			if ($numdero > 40)
				$numd = $numd."Y ".(unidad($numdero - 40));
		}
		else if ($numdero >= 30 && $numdero <= 39)
		{
			$numd = "TREINTA ";
			if ($numdero > 30)
				$numd = $numd."Y ".(unidad($numdero - 30));
		}
		else if ($numdero >= 20 && $numdero <= 29)
		{
			if ($numdero == 20)
				$numd = "VEINTE ";
			else
				$numd = "VEINTI".(unidad($numdero - 20));
		}
		else if ($numdero >= 10 && $numdero <= 19)
		{
			switch ($numdero){
			case 10:
			{
				$numd = "DIEZ ";
				break;
			}
			case 11:
			{		 		
				$numd = "ONCE ";
				break;
			}
			case 12:
			{
				$numd = "DOCE ";
				break;
			}
			case 13:
			{
				$numd = "TRECE ";
				break;
			}
			case 14:
			{
				$numd = "CATORCE ";
				break;
			}
			case 15:
			{
				$numd = "QUINCE ";
				break;
			}
			case 16:
			{
				$numd = "DIECISEIS ";
				break;
			}
			case 17:
			{
				$numd = "DIECISIETE ";
				break;
			}
			case 18:
			{
				$numd = "DIECIOCHO ";
				break;
			}
			case 19:
			{
				$numd = "DIECINUEVE ";
				break;
			}
			}	
		}
		else
			$numd = unidad($numdero);
	return $numd;
}

	function centena($numc){
		if ($numc >= 100)
		{
			if ($numc >= 900 && $numc <= 999)
			{
				$numce = "NOVECIENTOS ";
				if ($numc > 900)
					$numce = $numce.(decena($numc - 900));
			}
			else if ($numc >= 800 && $numc <= 899)
			{
				$numce = "OCHOCIENTOS ";
				if ($numc > 800)
					$numce = $numce.(decena($numc - 800));
			}
			else if ($numc >= 700 && $numc <= 799)
			{
				$numce = "SETECIENTOS ";
				if ($numc > 700)
					$numce = $numce.(decena($numc - 700));
			}
			else if ($numc >= 600 && $numc <= 699)
			{
				$numce = "SEISCIENTOS ";
				if ($numc > 600)
					$numce = $numce.(decena($numc - 600));
			}
			else if ($numc >= 500 && $numc <= 599)
			{
				$numce = "QUINIENTOS ";
				if ($numc > 500)
					$numce = $numce.(decena($numc - 500));
			}
			else if ($numc >= 400 && $numc <= 499)
			{
				$numce = "CUATROCIENTOS ";
				if ($numc > 400)
					$numce = $numce.(decena($numc - 400));
			}
			else if ($numc >= 300 && $numc <= 399)
			{
				$numce = "TRESCIENTOS ";
				if ($numc > 300)
					$numce = $numce.(decena($numc - 300));
			}
			else if ($numc >= 200 && $numc <= 299)
			{
				$numce = "DOSCIENTOS ";
				if ($numc > 200)
					$numce = $numce.(decena($numc - 200));
			}
			else if ($numc >= 100 && $numc <= 199)
			{
				if ($numc == 100)
					$numce = "CIEN ";
				else
					$numce = "CIENTO ".(decena($numc - 100));
			}
		}
		else
			$numce = decena($numc);
		
		return $numce;	
}

	function miles($nummero){
		if ($nummero >= 1000 && $nummero < 2000){
			$numm = "MIL ".(centena($nummero%1000));
		}
		if ($nummero >= 2000 && $nummero <10000){
			$numm = unidad(Floor($nummero/1000))." MIL ".(centena($nummero%1000));
		}
		if ($nummero < 1000)
			$numm = centena($nummero);
		
		return $numm;
	}

	function decmiles($numdmero){
		if ($numdmero == 10000)
			$numde = "DIEZ MIL";
		if ($numdmero > 10000 && $numdmero <20000){
			$numde = decena(Floor($numdmero/1000))."MIL ".(centena($numdmero%1000));		
		}
		if ($numdmero >= 20000 && $numdmero <100000){
			$numde = decena(Floor($numdmero/1000))." MIL ".(miles($numdmero%1000));		
		}		
		if ($numdmero < 10000)
			$numde = miles($numdmero);
		
		return $numde;
	}		

	function cienmiles($numcmero){
		if ($numcmero == 100000)
			$num_letracm = "CIEN MIL";
		if ($numcmero >= 100000 && $numcmero <1000000){
			$num_letracm = centena(Floor($numcmero/1000))." MIL ".(centena($numcmero%1000));		
		}
		if ($numcmero < 100000)
			$num_letracm = decmiles($numcmero);
		return $num_letracm;
	}	
	
	function millon($nummiero){
		if ($nummiero >= 1000000 && $nummiero <2000000){
			$num_letramm = "UN MILLON ".(cienmiles($nummiero%1000000));
		}
		if ($nummiero >= 2000000 && $nummiero <10000000){
			$num_letramm = unidad(Floor($nummiero/1000000))." MILLONES ".(cienmiles($nummiero%1000000));
		}
		if ($nummiero < 1000000)
			$num_letramm = cienmiles($nummiero);
		
		return $num_letramm;
	}	

	function decmillon($numerodm){
		if ($numerodm == 10000000)
			$num_letradmm = "DIEZ MILLONES";
		if ($numerodm > 10000000 && $numerodm <20000000){
			$num_letradmm = decena(Floor($numerodm/1000000))."MILLONES ".(cienmiles($numerodm%1000000));		
		}
		if ($numerodm >= 20000000 && $numerodm <100000000){
			$num_letradmm = decena(Floor($numerodm/1000000))." MILLONES ".(millon($numerodm%1000000));		
		}
		if ($numerodm < 10000000)
			$num_letradmm = millon($numerodm);
		
		return $num_letradmm;
	}

	function cienmillon($numcmeros){
		if ($numcmeros == 100000000)
			$num_letracms = "CIEN MILLONES";
		if ($numcmeros >= 100000000 && $numcmeros <1000000000){
			$num_letracms = centena(Floor($numcmeros/1000000))." MILLONES ".(millon($numcmeros%1000000));		
		}
		if ($numcmeros < 100000000)
			$num_letracms = decmillon($numcmeros);
		return $num_letracms;
	}	

	function milmillon($nummierod){
		if ($nummierod >= 1000000000 && $nummierod <2000000000){
			$num_letrammd = "MIL ".(cienmillon($nummierod%1000000000));
		}
		if ($nummierod >= 2000000000 && $nummierod <10000000000){
			$num_letrammd = unidad(Floor($nummierod/1000000000))." MIL ".(cienmillon($nummierod%1000000000));
		}
		if ($nummierod < 1000000000)
			$num_letrammd = cienmillon($nummierod);
		
		return $num_letrammd;
	}	
			
		
function convertir($numero){
		   $numf = milmillon($numero);
		return $numf." PESOS MCTE";
}

function traenomcie($cod_){
    $concie_="SELECT nom_cie10 FROM cie_10 WHERE cod_cie10='$cod_'";
    $concie_=mysql_query($concie_);
    $rowcie_=mysql_fetch_array($concie_);
    return $rowcie_[nom_cie10];
}
?>