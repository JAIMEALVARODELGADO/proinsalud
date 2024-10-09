<?		
	session_register('Gcod_mediconh'); 
	session_register('paciente');	
	session_register('numcita');
	session_register('Gareanh');		
?>
<html>
<head>
<link rel="stylesheet" href="style.css" type="text/css"/>
<SCRIPT LANGUAGE="JavaScript">
	function salir()
	{
		
		uno.vinculo.value='121';	
		uno.valregre.value='LP';
		uno.target='area'; 
		uno.action='regresa.php';
		uno.submit();
		
		uno.vinculo.value='121';
		uno.target='';
		uno.action='titulo.php';
		uno.submit();		
	}
	function salir2()
	{
		
		uno.vinculo.value='121';
		uno.valregre.value='LT';
		uno.target='area'; 
		uno.action='regresa.php';
		uno.submit();		
		uno.target='';
		uno.action='titulo.php';
		uno.submit();		
	}
</script>
</head>
<body bgcolor="#4F81BD" style='position:absolute;margin-top:10'>
<style>
a:link{
	color: #FFFFD9;
}

a:visited{
	color: #FFFFD9;
}

a:active{
	color: #FF8040;
}

a:hover{
	text-decoration: Underline;
	color: #FF8040;
} 

</style>
<?php
	
	if($vinculo==121)
	{
		$paciente='';
		$numcita='';
	}
	//echo 'cita'.$numcita.'paciente'.$paciente;
	
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
		$nommed=$rmed['nom_medi'];		
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
	<form name=uno method=post>
	<input type=hidden name=valregre>
	<table width='100%'>	
	<tr>	
	<td width=20%><font size=2 color='#FFFFFF'>Medico: <B>$nommed</font></td>";
	if($paciente!='' && $paciente!='')
	{
		echo"<td width=20%><font size=2 color='#FFFFFF'>Paciente: <b>$nompac</font></td>		
		<td width=15%><font size=2 color='#FFFFFF'>Identificacion: <b>$docu</font></td>
		<td width=20%><font size=2 color='#FFFFFF'>Contrato: <b>$nomcontra</font></td>
		<td width=9%><font size=2 color='#FFFFFF'>Edad: <b>$edad</font></td>";		
	}

	if($Gareanh=='04')
	{
		echo"	
		<td width=8% align=right><a href='#' onclick='salir()'>CONSULTA</a></td>	
		<td width=8% align=right><a href='#' onclick='salir2()'>TRIAGE</a></td>";
	}
	
	echo"
	<td width=8% align=right><a href='../modiformula/index.php' target='top'><font face=arial color='#ffffff' size=2><b>MODIFICAR FORMULA</b></font></a></td>
	</tr>
	
	</table>
	
	<input type=hidden name=vinculo>
	</form>";
	
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
      $unidad_=" A�o";}
    else{
      $unidad_=" A�os";}
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
        $unidad_=" D�a";}
      else{
        $unidad_=" D�as";}
    }
  }
  return($edad_.$unidad_);
}

?>
</body>
</html>