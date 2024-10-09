<?		
	session_register('Gcod_mediconh'); 
	session_register('paciente');	
	session_register('numcita');	
?>
<html>
<head>
</head>
<body bgcolor="#4F81BD" style='position:absolute;margin-top:10'>
<?
		
	include ('php/conexion1.php');
	$cadcon=mysql_query("SELECT contrato.NEPS_CON
	FROM citas INNER JOIN contrato ON citas.Cotra_citas = contrato.CODI_CON
	WHERE (((citas.id_cita)='$numcita'))");
	while($rcon=mysql_fetch_array($cadcon))
	{
		$nomcontra=$rcon['NEPS_CON'];		
	}	
	$cadmed=mysql_query("select * from medicos where cod_medi = '$Gcod_mediconh'");
	while($rmed=mysql_fetch_array($cadmed))
	{
		$nommed=$rmed['nom_medi'].' '.$rmed['ape_medi'];		
	}
	$cadpac=mysql_query("select * from usuario where CODI_USU = '$paciente'");
	while($rpac=mysql_fetch_array($cadpac))
	{
		$nompac=$rpac['PNOM_USU'].' '.$rpac['SNOM_USU'].' '.$rpac['PAPE_USU'].' '.$rpac['SAPE_USU'];	
		$docu=$rpac['NROD_USU'];
		$fnac=$rpac['FNAC_USU'];
		$edad=calculaedad($fnac);
	}		
	echo"
	<table width=100%>
	<tr>	
	<td><font size=2 color='#FFFFFF'>Médico: <B>$nommed</font></td>";
	if($paciente!='' && $paciente!='')
	{
		echo"<td><font size=2 color='#FFFFFF'>Paciente: <b>$nompac</font></td>		
		<td><font size=2 color='#FFFFFF'>Identificacion: <b>$docu</font></td>
		<td><font size=2 color='#FFFFFF'>Contrato: <b>$nomcontra</font></td>
		<td><font size=2 color='#FFFFFF'>Edad: <b>$edad</font></td>";
		
		
	}	
	echo"</tr>
	</table>";	
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

?>
</body>
</html>