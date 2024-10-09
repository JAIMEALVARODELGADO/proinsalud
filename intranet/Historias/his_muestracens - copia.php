<HTML>
<?php ?>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Censo</title>
<link rel="stylesheet" href="css/style.css" type="text/css" />
<style type="text/css">
<!--
.Estilo6 {font-family: Arial, Helvetica, sans-serif; font-size: 11px; }
.Estilo5 {font-family: Arial, Helvetica, sans-serif; font-size: 11px; font-weight: bold; }

-->
</style>
</head>
<body>
<form method="POST" name="form1" action="">
<table class="Tbl0">
<tr><td class="Estilo5" align='CENTER'><b>LISTADO DE PACIENTES HOSPITALIZADOS </td></tr>
</table>

<?php
		
	include("php/conexion2.php");
	//CREAR TABLA
	echo "<Table border=1  width=100% align=center cellpadding=0 Cellspacing=0>";
	echo "<th class=Estilo5>Cama</th><th class=Estilo5>Identificación</th><th class=Estilo5>Nombre</th><th class=Estilo5>Edad</th><th class=Estilo5>Contrato</th><th class=Estilo5>Ingreso</th><th class=Estilo5>Dias Estancia</th><th class=Estilo5>Diagnóstico</th>";
    if($area=='0634')
	{ $area='04';}
	//echo $area;
  
	$_pagi_sql=mysql_query("SELECT e.caac_ing, Max(e.id_ing) AS DCodHis, u.TDOC_USU, u.NROD_USU, e.caac_ing AS camaan, concat(u.Pnom_usu,' ',u.Snom_usu,' ',u.Pape_usu,' ',u.Sape_usu) AS DNom, u.FNAC_USU, uc.ESTA_UCO AS DEst, e.fecin_ing,c.NEPS_CON AS DEps, IF ( ht.Horas_tra > -1, ht.Horas_tra, ( SUBSTRING( TIMEDIFF( SYSDATE( ) , CONCAT( DATE( ht.Fecin_tra ) , ' ', ht.Horin_tra ) ) , 1, ( LENGTH( TIMEDIFF( SYSDATE( ) , ht.Fecin_tra ) ) -6 ) ) +0 ) ) AS DHoras, CONCAT( DATE( ht.Fecin_tra ) , ' ', ht.Horin_tra ) AS DInicio, e.codius_ing AS DIdeUsu, u.PNOM_USU, u.SNOM_USU, u.PAPE_USU, u.SAPE_USU
		FROM (((Ingreso_hospitalario AS e INNER JOIN Hist_traza AS ht ON e.id_ing = ht.id_ing) INNER JOIN Usuario AS u ON e.codius_ing = u.CODI_USU) INNER JOIN Ucontrato AS uc ON (e.contra_ing = uc.CONT_UCO) AND (e.codius_ing = uc.CUSU_UCO)) INNER JOIN Contrato AS c ON uc.CONT_UCO = c.CODI_CON
		WHERE (((ht.ubica_tra)='$area') AND ((ht.horas_tra)=-1) AND ((e.caac_ing)<>'RE'))
		GROUP BY e.caac_ing, u.TDOC_USU, u.NROD_USU, e.caac_ing, concat(u.Pnom_usu,' ',u.Snom_usu,' ',u.Pape_usu,' ',u.Sape_usu), u.FNAC_USU, uc.ESTA_UCO, c.NEPS_CON, IF ( ht.Horas_tra > -1, ht.Horas_tra, ( SUBSTRING( TIMEDIFF( SYSDATE( ) , CONCAT( DATE( ht.Fecin_tra ) , ' ', ht.Horin_tra ) ) , 1, ( LENGTH( TIMEDIFF( SYSDATE( ) , ht.Fecin_tra ) ) -6 ) ) +0 ) ), CONCAT( DATE( ht.Fecin_tra ) , ' ', ht.Horin_tra ), e.codius_ing, u.PNOM_USU, u.SNOM_USU, u.PAPE_USU, u.SAPE_USU
		ORDER BY e.caac_ing, u.PNOM_USU, u.SNOM_USU, u.PAPE_USU, u.SAPE_USU");
	
	//echo $_pagi_sql;
	
	$i=0;
	 while($row=mysql_fetch_array($_pagi_sql))
	{
   
		
		$camaactu=$row['camaan'];
		$buscam=mysql_query("select nomb_des from destipos where codi_des='$camaactu'");
		while($fil=mysql_fetch_array($buscam))
		{
			$camasi=$fil['nomb_des'];
		}
		$fechaing=$row['fecin_ing'];
		$horaing=$row['hora_ing'];
		$ingreso=$row['DCodHis'];
		
		
		
		$bcie=mysql_query("SELECT hist_evo.iden_evo, hist_evo.cod_cie10, cie_10.nom_cie10
		FROM hist_evo INNER JOIN cie_10 ON hist_evo.cod_cie10 = cie_10.cod_cie10
		WHERE (((hist_evo.id_ing)='$ingreso'))
		ORDER BY hist_evo.iden_evo");
		while($rcie=mysql_fetch_array($bcie))
		{
			$codcie=$rcie['cod_cie10'];
			$nomcie=$rcie['nom_cie10'];
		}
		
		$dia_est=estancia($fechaing,$horaing);
		echo "<tr>";
		echo "<td class='Estilo6'>".$camasi."</td>";
		echo "<td class='Estilo6'>".$row['NROD_USU']."</td>";
		echo "<td class='Estilo6'>".$row['DNom']."</td>";
		echo "<td class='Estilo6'>".calculaedad($row['FNAC_USU'])."</td>";
		echo "<td class='Estilo6'>".$row['DEps']."</td>";
		//echo "<td class='Estilo6'>".$row['DEst']."</td>";
		echo "<td class='Estilo6'>".$row['DInicio']."</td>";
		echo "<td class='Estilo6'>".$dia_est."</td>";
		echo "<td class='Estilo6'>".$codcie." - ".$nomcie."</td>";		
		echo "</tr>";
		$i++;
		
		
		
	}
	echo "</table>";	
	function estancia($fechaing,$horaing)
    {
        //Esta funcion toma una fecha de nacimiento
        //desde una base de datos mysql
        //en formato aaaa/mm/dd y calcula la edad en nmeros enteros

        $anno=date('Y');	
		$mes=date('m');	
		$dia=date('d');	
		$hora=date('H');
		$minu=date('i');
		$segu=date('s');
		$numeroact= gmmktime ( $hora, $minu, $segu, $mes, $dia, $anno);//convierte a numero timestamp (int)

        //descomponer fecha de nacimiento
        $dia=substr($fechaing, 8, 2);
        $mes=substr($fechaing, 5, 2);
        $anno=substr($fechaing, 0, 4);		
		$segu=substr($horaing, 6, 2);
        $minu=substr($horaing, 3, 2);
        $hora=substr($horaing, 0, 2);
		$numeroing= gmmktime ( $hora, $minu, $segu, $mes, $dia, $anno);//convierte a numero timestamp (int)
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

</form>		
</body>
</HTML>

