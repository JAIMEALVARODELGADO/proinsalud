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
  $anos_=$ano2_-$ano1_;
  $meses_=$mes2_-$mes1_;
  $dias_=$dia2_-$dia1_;
  $dias_=$dias_+($anos_*364)+($meses_*30);
  return($dias_);
}


//Calcula la edad en años, meses o días, a partir de una fecha dada comparada con la segunda fecha dada
//la fecha viene en formato "yyyy/mm/dd"
//ej: calculaedad3($fecha_final,$fecha_inicia,$unidad)
function calculaedad3($fechaini_,$fechafin_,&$unidad_){
  $anoini_=substr($fechaini_,0,4);
  $mesini_=substr($fechaini_,5,2);
  $diaini_=substr($fechaini_,8,2);
  if($mesini_==2){
    $diasmes_=28;}
  else{
    if($mesini_==1 || $mesini_==3 || $mesini_==5 || $mesini_==7 || $mesini_==8 || $mesini_==10 || $mesini_==12){
      $diasmes_=31;}
    else{
      $diasmes_=30;}
  }
  $anofin_=substr($fechafin_,0,4);
  $mesfin_=substr($fechafin_,5,2);
  $diafin_=substr($fechafin_,8,2);
  $anos_=$anofin_-$anoini_;
  $meses_=$mesfin_-$mesini_;
  $dias_=$diafin_-$diaini_;
  if($dias_<0){
    if($meses_>0){$meses_=$meses_-1;}
    $dias_=$diasmes_+$dias_;
  }

  if($meses_<0){
    $meses_=12+$meses_;
    if($diafin_-$diaini_<0){
      $meses_=$meses_-1;}
      $anos_=$anos_-1;
  }
  if($meses_==0 & $diafin_-$diaini_<0 & $anos_>0){
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

function traedx($cod_){
    $sql_="SELECT nom_cie10 FROM cie_10 WHERE cod_cie10='$cod_'";
    $sql_=mysql_query($sql_);
    if(mysql_num_rows($sql_)<>0){
        $row_=mysql_fetch_array($sql_);
        $desc_=$row_[nom_cie10];
    }
    return($desc_);
}

function traetipdx($tipo_){
    switch ($tipo_){
        case '1':
            $desc_='Impresión Diagnóstica';
            break;
        case '2':
            $desc_='Confirmado Nuevo';
            break;
        case '1':
            $desc_='Confirmado Repetido';
            break;        
    }
    return($desc_);
}

function trae_medico($codi_){
    $nombre_='';
    $cons_="SELECT nom_medi FROM medicos WHERE cod_medi='$codi_'";
    $cons_=mysql_query($cons_);
    if(mysql_num_rows($cons_)<>0){
        $row_=mysql_fetch_array($cons_);
        $nombre_=$row_[nom_medi];
    }
    return($nombre_);
}

function trae_est($est_){
    switch ($est_){
        case 'S':
            $desc_='Si';
            break;
        case 'N':
            $desc_='No';
            break;
        case 'NA':
            $desc_='No Aplica';
            break;
    }
    return($desc_);
}

function trae_cups($cod_,&$codi_cup){
    $cons_="SELECT codi_cup,descrip FROM cups WHERE codigo='$cod_'";
    $cons_=mysql_query($cons_);
    if(mysql_num_rows($cons_)<>0){
        $rowcup=mysql_fetch_array($cons_);
        $desc_=$rowcup[descrip];
        $codi_cup=$rowcup[codi_cup];        
    }
    return($desc_);
}

?>