<?php
//Aqui valido que las fechas sean válidas
function validafecha($xfecha_)
{
  $xdia_=substr($xfecha_,0,2);
  $xmes_=substr($xfecha_,3,2);
  $xanio_=substr($xfecha_,6,4);
  if ($xdia_*1==0 or $xmes_*1==0 or $xanio_*1==0)
    {return 0;}
  else{
    if (checkdate($xmes_,$xdia_,$xanio_))
      {return 1;}
    else{
      return 0;}
  }
}
function hoy()
{
   $hoy_=date("d").'/'.date("m").'/'.date("Y");
   return $hoy_;
}
//Funcion que retorna la fecha actual en el formato "dd/mm/aaaa"


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

//Calcula la edad en años, a partir de una fecha dada comparada con la fecha de hoy
//la fecha viene en formato "yyyy/mm/dd"
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

//Valida el parentesco
function valperentesco($paren_)
{
  $descripcion_="";
  switch ($paren_){
    case "1":
      $descripcion_="Cónyuge o compañero(a) permanente";
      break;
    case "2":
      $descripcion_="Hijo(a)";
      break;
    case "3":
      $descripcion_="Padre o madre";
      break;
    case "4":
      $descripcion_="Segundo grado de consanguinidad";
      break;
    case "5":
      $descripcion_="Tercer grado de consanguinidad";
      break;
    case "6":
      $descripcion_="Menor de 12 años de edad sin consanguinidad";
      break;
    case "7":
      $descripcion_="Padre o madre del cónyuge";
      break;
    case "8":
      $descripcion_="Otros no parientes";
      break;
    case "9":
      $descripcion_="Cotizante principal o Cabeza del grupo familiar";
      break;
    default:
      $descripcion_="Indeterminado";
  }
  return($descripcion_);
}

//Valida el Estrato
function valestrato($estra_)
{
  $descripcion_="";
  switch ($estra_){
    case "1":
      $descripcion_="Uno";
      break;
    case "2":
      $descripcion_="Dos";
      break;
    case "3":
      $descripcion_="Tres";
      break;
    case "4":
      $descripcion_="Especial";
      break;
    default:
      $descripcion_="Indeterminado";
  }
  return($descripcion_);
}


//Funcion que retorna el nombre de la actividad, de acuerdo al tarifario solicitado.
//$tarifario_ recibe el código del tarifario así: 1=soat 2=iss 2001
//$codigo_ recibe el código de la actividad a buscar
function nombredet($tarifario_,$codigo_){
switch ($tarifario_){
  case 1:
    $consultata=mysql_query("SELECT desc_soa FROM tar_soat WHERE cod_soa='$codigo_'");
	$rowta=mysql_fetch_array($consultata);
	$nombre=$rowta[desc_soa];
	break;
  case 2:
    
    $consultata=mysql_query("SELECT desc_is01 FROM tar_is01 WHERE cod_is01='$codigo_'");
	$rowta=mysql_fetch_array($consultata);
	$nombre=$rowta[desc_is01];
	break;
  }
  mysql_free_result($consultata);
  return($nombre);
}

//Funcion que retorna el valor de la actividad, de acuerdo al tarifario solicitado
//$tarifario_ recibe el código del tarifario así: 1=soat 2=iss 2001
//$codigo_ recibe el código de la actividad a buscar
function valoract($tari_,$codigo_){
$valor_=0;
  switch($tari_){
    case 1:
	  $consulta_=mysql_query("SELECT valo_soa FROM tar_soat WHERE cod_soa='$codigo_'");
	  if(mysql_num_rows($consulta_)<>0){
	    $row_=mysql_fetch_array($consulta_);
		$valor_=$row_[valo_soa];
	  }
	break;
    case 2:
	  $consulta_=mysql_query("SELECT valo_is01 FROM tar_is01 WHERE cod_is01='$codigo_'");
	  if(mysql_num_rows($consulta_)<>0){
	    $row_=mysql_fetch_array($consulta_);
		$valor_=$row_[valo_is01];
	  }
	break;	
  }
  mysql_free_result($consulta_);
  return($valor_);
}


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

?>