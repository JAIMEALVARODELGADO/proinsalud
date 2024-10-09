
<?
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

//Funcion que cambia el formato de la fecha que recibe
//la recibe en formato "dd/mm/yyyy" y la retorna en formato "yyyy/mm/aa"
function cambiafecha($xfecha_)
{
  $xdia_=substr($xfecha_,0,2);
  $xmes_=substr($xfecha_,3,2);
  $xanio_=substr($xfecha_,6,4);
  $xfecha_=$xanio_."/".$xmes_."/".$xdia_;
  return $xfecha_;
}

//Calcula la edad en años, a partir de una fecha dada comparada con la fecha de hoy
function calculaedad($fecha_){
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
?>
