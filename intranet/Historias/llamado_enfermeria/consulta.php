<?php
    
    function conexion2(){
        $conexion = mysql_connect("localhost","root","");
	    if(!$conexion){
	  	    echo "Error de conexion a la base de datos, Intente mas tarde.";
		    exit();
	    }
	    mysql_select_db("proinsalud",$conexion);

	    //include("php/conexion2.php");
    }    


    function crear_array($area){
        $datosPacientes = array();
        
        $_pagi_sql=mysql_query("SELECT e.caac_ing, Max(e.id_ing) AS DCodHis, u.TDOC_USU, u.NROD_USU, e.caac_ing AS camaan, concat(u.Pnom_usu,' ',u.Snom_usu,' ',u.Pape_usu,' ',u.Sape_usu) AS DNom, u.FNAC_USU, uc.ESTA_UCO AS DEst, e.fecin_ing,c.NEPS_CON AS DEps, IF ( ht.Horas_tra > -1, ht.Horas_tra, ( SUBSTRING( TIMEDIFF( SYSDATE( ) , CONCAT( DATE( ht.Fecin_tra ) , ' ', ht.Horin_tra ) ) , 1, ( LENGTH( TIMEDIFF( SYSDATE( ) , ht.Fecin_tra ) ) -6 ) ) +0 ) ) AS DHoras, CONCAT( DATE( ht.Fecin_tra ) , ' ', ht.Horin_tra ) AS DInicio, e.codius_ing AS DIdeUsu, u.PNOM_USU, u.SNOM_USU, u.PAPE_USU, u.SAPE_USU
		FROM (((Ingreso_hospitalario AS e INNER JOIN Hist_traza AS ht ON e.id_ing = ht.id_ing) INNER JOIN Usuario AS u ON e.codius_ing = u.CODI_USU) INNER JOIN Ucontrato AS uc ON (e.contra_ing = uc.CONT_UCO) AND (e.codius_ing = uc.CUSU_UCO)) INNER JOIN Contrato AS c ON uc.CONT_UCO = c.CODI_CON
		WHERE (((ht.ubica_tra)='$area') AND ((ht.horas_tra)=-1) AND ((e.caac_ing)<>'RE'))
		GROUP BY e.caac_ing, u.TDOC_USU, u.NROD_USU, e.caac_ing, concat(u.Pnom_usu,' ',u.Snom_usu,' ',u.Pape_usu,' ',u.Sape_usu), u.FNAC_USU, uc.ESTA_UCO, c.NEPS_CON, IF ( ht.Horas_tra > -1, ht.Horas_tra, ( SUBSTRING( TIMEDIFF( SYSDATE( ) , CONCAT( DATE( ht.Fecin_tra ) , ' ', ht.Horin_tra ) ) , 1, ( LENGTH( TIMEDIFF( SYSDATE( ) , ht.Fecin_tra ) ) -6 ) ) +0 ) ), CONCAT( DATE( ht.Fecin_tra ) , ' ', ht.Horin_tra ), e.codius_ing, u.PNOM_USU, u.SNOM_USU, u.PAPE_USU, u.SAPE_USU
		ORDER BY e.caac_ing, u.PNOM_USU, u.SNOM_USU, u.PAPE_USU, u.SAPE_USU");
    	
        while($row=mysql_fetch_array($_pagi_sql)){
    		$camaactu=$row['camaan'];
		    $buscam=mysql_query("select nomb_des from destipos where codi_des='$camaactu'");
		    while($fil=mysql_fetch_array($buscam)){
			    $camasi=$fil['nomb_des'];
    		}
            $fechaing=$row['fecin_ing'];
            $horaing=$row['hora_ing'];
            $nro_usu=$row['NROD_USU'];
            $paciente=$row['DNom'];
            $edad=calculaedad($row['FNAC_USU']);
            $eps=$row['DEps'];
            $fecha_ingreso= $row['DInicio'];
            $ingreso=$fecha_ingreso.' '.$horaing;
            $dia_est=estancia($fechaing,$horaing);
            array_push($datosPacientes, $camasi, $nro_usu,  $paciente, $edad, $eps, $ingreso, $dia_est); 
	    }
        return $datosPacientes;
    }    
	
	function estancia($fechaing,$horaing)
    {
        $anno=date('Y');	
		$mes=date('m');	
		$dia=date('d');	
		$hora=date('H');
		$minu=date('i');
		$segu=date('s');
		$numeroact= gmmktime ( $hora, $minu, $segu, $mes, $dia, $anno);
        $dia=substr($fechaing, 8, 2);
        $mes=substr($fechaing, 5, 2);
        $anno=substr($fechaing, 0, 4);		
		$segu=substr($horaing, 6, 2);
        $minu=substr($horaing, 3, 2);
        $hora=substr($horaing, 0, 2);
		$numeroing= gmmktime ( $hora, $minu, $segu, $mes, $dia, $anno);
		$difer=$numeroact-$numeroing;		
		$num1=floor($difer/60);
		$seg=$difer%60;	
		$num2=floor($num1/60);
		$min=$num1%60;		
		$dias=floor($num2/24);
		$horas=$num2%24;		
        $tiempo=$dias.' Dias  '.$horas.' Horas  ';
        return $tiempo;
    
	}
	
    function calculaedad($fecha_)
	{
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