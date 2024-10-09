<?php
	session_register('paciente');
	session_register('Gcod_mediconh');	
	session_register('Gareanh'); 
	session_register('Gcontratonh');
	session_register('numcita');
?>
<html>
<head>
<script language="JavaScript">
	function salir()
	{		
		uno.action='valfamilia1.php';
		uno.target='';
		uno.submit();
	}
</script>
</head>	

<?php	
	function getRealIP() 
	{
		if (!empty($_SERVER['HTTP_CLIENT_IP']))return $_SERVER['HTTP_CLIENT_IP'];
		if (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))return $_SERVER['HTTP_X_FORWARDED_FOR'];
		return $_SERVER['REMOTE_ADDR'];
	}
	$ip=getRealIP();
	$tok = strtok ($ip,".");
	$n=0;
	while ($tok) 
	{	
		$tok = strtok (".");
		$vec[$n]=$tok;
		$n++;	
	}
	$rangoip=$vec[1];
	include ('php/conexion1.php');
	$busori=mysql_query("select * from origen_consulta where codi_ori='$rangoip'");
	$codimunicipio='NOHAY';
	while($rusori=mysql_fetch_array($busori))
	{
		$codimunicipio=$rusori['codmuni_ori'];		
	}
				
	$archivoquiro='tmp/12HC'.$numcita.'-'.$paciente.'.txt';	
	if(file_exists($archivoquiro))
	{		
		$fp = fopen ($archivoquiro, "r" );
		$reg=0;
		while (( $data = fgetcsv ( $fp , 0 , "|" )) !== FALSE ) 
		{ 
			$reg++;
			$i = 0;
			foreach($data as $dato)
			{
				$campo[$i]=$dato;
				$i++ ;
			}
			$$campo[1]=$campo[2];
			if($reg % 16 == 0)
			{			
				if($tiho=='PM')$hora=$hora+12;
				$horasol=$hora.':'.$minu;				
				if($unidura=='MM')$dura=$duracion.' Minutos';
				if($unidura=='HH')$dura=$duracion.' Horas';
				$cad5=mysql_query("INSERT INTO `conambfam` ( `iden_cpl` ,`codi_usu`, `apgar1_cfa` , `apgar2_cfa` , `apgar3_cfa` , `apgar4_cfa`, `apgar5_cfa` , `apgpun_cfa` , `phq1_cfa`, `phq2_cfa`, `phq3_cfa`, `phq4_cfa`, `phq5_cfa`, `phq6_cfa`, `phq7_cfa`, `phq8_cfa`, `phq9_cfa`, `phqpun_cfa`)				
				VALUES                                     ('$numhisto', '$paciente', '$apgar1',     '$apgar2',    '$apgar3',       '$apgar4',    '$apgar5',    '$httotal1',   '$phq1',    '$phq2',    '$phq3',    '$phq4',    '$phq5',    '$phq6',    '$phq7',    '$phq8',    '$phq9',   '$httotal2')");				
			}				
		}
		fclose ($fp);
//		unlink ($archivoquiro);
	}

	if(file_exists($archivolis))unlink ($archivolis);
	if(file_exists($archivo0))unlink ($archivo0);
	if(file_exists($archivo1))unlink ($archivo1);
	if(file_exists($archivo2))unlink ($archivo2);
	if(file_exists($archivo4))unlink ($archivo4);
	if(file_exists($archivo8))unlink ($archivo8);
	
	
	echo "<body onload='salir()'>
	</body>";

	function calcula_edad($fecha_nac)
    {
        //Esta funcion toma una fecha de nacimiento
        //desde una base de datos mysql
        //en formato aaaa/mm/dd y calcula la edad en nmeros enteros
        $dia=date("d");
        $mes=date("m");
        $anno=date("Y");
        //descomponer fecha de nacimiento
        $dia_nac=substr($fecha_nac, 8, 2);
        $mes_nac=substr($fecha_nac, 5, 2);
        $anno_nac=substr($fecha_nac, 0, 4);
        if($mes_nac>$mes)
        {
            $calc_edad= $anno-$anno_nac-1;
        }
        else
        {
            if($mes==$mes_nac AND $dia_nac>$dia)
            {
                $calc_edad= $anno-$anno_nac-1;
            }
            else
            {
                $calc_edad= $anno-$anno_nac;
            }
        }
        return $calc_edad;
    }
	function calculaedadund($fecha_)
	{
	$ano_=substr($fecha_,0,4);
	$mes_=substr($fecha_,5,2);
	$dia_=substr($fecha_,8,2);
	if($mes_==2)
	{
    $diasmes_=28;}
	else
	{
		if($mes_==1 || $mes_==3 || $mes_==5 || $mes_==7 || $mes_==8 || $mes_==10 || $mes_==12){
		$diasmes_=31;}
		else{$diasmes_=30;}
	}
	$anos_=date("Y")-$ano_;
	$meses_=date("m")-$mes_;
	$dias_=date("d")-$dia_;    
	if($dias_<0)
	{
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
  //$edad_.$unidad_
  return($unidad_);  
}
	
?>
</body>
</html>