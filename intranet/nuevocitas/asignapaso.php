<?
session_start();
$usucitas=$_SESSION['usucitas'];
$_SESSION['areatra']=$areatra;

$dateh=date("Y-m-d");
foreach($_POST as $nombre_campo => $valor)
{ 
   $asignacion = "\$" . $nombre_campo . "='" . $valor . "';"; 
   eval($asignacion); 
} 
foreach($_GET as $nombre_campo => $valor)
{ 
   $asignacion = "\$" . $nombre_campo . "='" . $valor . "';"; 
   eval($asignacion); 
}

?>
<html>
<head>

<script language="javascript">
    function salto()
    {
        if(uno.emple.value=='12991944')
		{
			
			uno.target='';
			uno.action='asigna1.php';			
			uno.submit();
		}
		else
		{
			uno.target='';
			uno.action='asigna1.php';
			uno.submit();
		}
    }
</script>
</head>
<body onload="salto()">

<?

	set_time_limit(300);
	 
	echo"<form name=uno method=post>";	
	include ('php/conexion1.php');
	if($telsi==1)$ctel=mysql_query("UPDATE usuario SET TRES_USU='$telres1', TEL2_USU='$telres2' WHERE CODI_USU='$codusu'");
	
	$fecha=date("Y-m-d");
	$fech=date("Y-m-d",strtotime($fecha."- 180 days"));
	
	if($viene=='REFERENCIA')
	{
		$bcontra=mysql_query("SELECT ucontrato.IDEN_UCO, usuario.NROD_USU, contrato.CODI_CON, contrato.NEPS_CON, ucontrato.ESTA_UCO, usuario.CODI_USU, usuario.TDOC_USU, usuario.PNOM_USU, usuario.SNOM_USU, usuario.PAPE_USU, usuario.SAPE_USU, usuario.FNAC_USU, usuario.SEXO_USU, usuario.DIRE_USU, usuario.TRES_USU, usuario.TEL2_USU, usuario.MRES_USU, usuario.MATE_USU, municipio.NOMB_MUN AS nomuate, usuario.TPAF_USU, usuario.DCOT_USU, ucontrato.IDEN_UCO
		FROM municipio RIGHT JOIN ((ucontrato INNER JOIN usuario ON ucontrato.CUSU_UCO = usuario.CODI_USU) INNER JOIN contrato ON ucontrato.CONT_UCO = contrato.CODI_CON) ON municipio.CODI_MUN = usuario.MATE_USU
		WHERE (((ucontrato.IDEN_UCO)='$iden_uco'))");	
		while($resusu=mysql_fetch_array($bcontra))
		{		
			$nocontra=$resusu['NEPS_CON'];
			$estacontra=$resusu['ESTA_UCO'];
			$codusu=$resusu['CODI_USU'];
			$cedula=$resusu['NROD_USU'];
			$tdocus=$resusu['TDOC_USU'];
			$nomusu=$resusu['PNOM_USU'].' '.$resusu['SNOM_USU'].' '.$resusu['PAPE_USU'].' '.$resusu['SAPE_USU'];
			$fecnac=$resusu['FNAC_USU'];
			$sexusu=$resusu['SEXO_USU'];
			$dirusu=$resusu['DIRE_USU'];
			$tresusu=$resusu['TRES_USU'];
			$tel2usu=$resusu['TEL2_USU'];
			$munres=$resusu['MRES_USU'];
			$munate=$resusu['nomuate'];
			$tipafi=$resusu['TPAF_USU'];
			$docusu=$resusu['DCOT_USU'];
			$iden_uco=$resusu['IDEN_UCO'];
			$n++;
		} 
		$control=1;	
		$igual=1;
		//$usucitas='12991944';
		$_SESSION['usucitas']=$usucitas;
	}
	
	
	
	$baut=mysql_query("SELECT detareferencia.iden_dre
	FROM (referencia INNER JOIN detareferencia ON referencia.idre_ref = detareferencia.idre_dre) INNER JOIN ucontrato ON referencia.cuco_ref = ucontrato.IDEN_UCO
	WHERE (detareferencia.alse_dre<>'' AND detareferencia.reci_dre='S' AND((referencia.fech_ref)>='$fech') AND ((ucontrato.CUSU_UCO)='$codusu') AND ((ucontrato.CONT_UCO)='135' Or (ucontrato.CONT_UCO)='002') AND ((detareferencia.marc_dre)='1401'))");
	while($raut=mysql_fetch_array($baut))
	{
		$iddre=$raut['iden_dre'];
		$upaut=mysql_query("UPDATE detareferencia SET marc_dre='1402' WHERE iden_dre='$iddre'");
	}
	
	
	
    echo"<input type=hidden name=munate value=$munate>";
	echo"<input type=hidden name=viene value=$viene>";
	echo"<input type=hidden name=emple value=$usucitas>";
    echo"<input type=hidden name=codusu value=$codusu>";
    echo"<input type=hidden name=tipafi value=$tipafi>";    
    echo"<input type=hidden name=clasifica value=$clasifica>";
    echo"<input type=hidden name=telres value=$telres>";
    echo"<input type=hidden name=nocontra value='$nocontra'>";
	echo"<input type=hidden name=nombreusu value='$nomusu'>";
	echo"<input type=hidden name=cedulausu value='$cedula'>";	
    echo"<input type=hidden name=valvar value=1>";
	if($igual==1)
	{
		echo"<input type=hidden name=igual value='$igual'>";
		echo"<input type=hidden name=codareauto value='$codareauto'>";
		echo"<input type=hidden name=medico value='$medico'>";
		echo"<input type=hidden name=mes value='$mes'>";
		echo"<input type=hidden name=control value='$control'>";
		echo"<input type=hidden name=desareauto value='$desareauto'>";
		echo"<input type=hidden name=finsigue value='$finsigue'>";
		echo"<input type=hidden name=iden_uco value=$iden_uco>";
		echo"<input type=hidden name=contrauto value='$contrauto'>";		
	} 
	$anin=date("Y");
	$mein=date("m-d");
	$anin=$anin-1;
    //$fech='2020-12-01';
	if($codusu=='13335' || $codusu=='8571' || $codusu=='135' || $codusu=='2455' || $codusu=='5789' || $codusu=='9004' || $codusu=='272085' || $codusu=='3342' || $codusu=='272085' || $codusu=='270399')$fech=date("Y-m-d",strtotime($fecha."- 90 days"));
	
	$contratos="";
	$medicos="";
    $cn=0;
    $bcitant=mysql_query("SELECT citas.Idusu_citas, horarios.Fecha_horario, horarios.Hora_horario, medicos.nom_medi,medicos.cupmp_medi, areas.nom_areas, 
	citas.Clase_citas, citas.esta_cita, citas.tipo_consulta,citas.id_cita,citas.Cotra_citas,citas.iden_dfa,horarios.Cmed_horario 
	FROM ((citas INNER JOIN horarios ON citas.ID_horario = horarios.ID_horario) INNER JOIN medicos ON horarios.Cmed_horario = medicos.cod_medi) INNER JOIN areas ON horarios.Cserv_horario = areas.cod_areas
	WHERE (((citas.Idusu_citas)='$codusu') AND ((horarios.Fecha_horario)>'$fech') AND ((citas.Clase_citas)<'6'))
	ORDER BY horarios.Fecha_horario DESC , horarios.Hora_horario DESC");
	
    while($rcitant=mysql_fetch_array($bcitant))
    {        
		$Fhorario=$rcitant['Fecha_horario'];
        $Hhorario=$rcitant['Hora_horario'];
        $nmedi=$rcitant['nom_medi'];
        $nareas=$rcitant['nom_areas'];
		$estaci=$rcitant['esta_cita'];
		$tipocon=$rcitant['tipo_consulta'];

		$id_cita=$rcitant['id_cita'];
		$cotra_citas=$rcitant['Cotra_citas'];
		$cmed_horario=$rcitant['Cmed_horario'];
		$cupmp_medi=$rcitant['cupmp_medi'];
		$iden_dfa=$rcitant['iden_dfa'];		
		
		$bec=mysql_query("SELECT * FROM esta_cita where cod_estaci='$estaci'");
		$rec=mysql_fetch_array($bec);
		$desesta=$rec['descrip_estaci']; 
		
        $Hhorario=substr($Hhorario,11,5);
        $nomauto='Fhorario'.$cn;
        echo"<input type=hidden name=$nomauto value='$Fhorario'>";
        $nomauto='Hhorario'.$cn;
        echo"<input type=hidden name=$nomauto value='$Hhorario'>";
        $nomauto='nmedi'.$cn;
        echo"<input type=hidden name=$nomauto value='$nmedi'>";
        $nomauto='nareas'.$cn;
        echo"<input type=hidden name=$nomauto value='$nareas'>";
		$nomauto='desesta'.$cn;
        echo"<input type=hidden name=$nomauto value='$desesta'>";
		$nomauto='tipocon'.$cn;
        echo"<input type=hidden name=$nomauto value='$tipocon'>";

		$nomauto='id_cita'.$cn;
        echo"<input type=hidden name=$nomauto value='$id_cita'>";
		$nomauto='cotra_citas'.$cn;
        echo"<input type=hidden name=$nomauto value='$cotra_citas'>";
		$nomauto='cmed_horario'.$cn;
        echo"<input type=hidden name=$nomauto value='$cmed_horario'>";
		$nomauto='cupmp_medi'.$cn;
        echo"<input type=hidden name=$nomauto value='$cupmp_medi'>";
		$nomauto='iden_dfa'.$cn;
        echo"<input type=hidden name=$nomauto value='$iden_dfa'>";
		

		$contratos=$contratos.$cotra_citas.',';
		$medicos=$medicos.$cmed_horario.',';	

        $cn++;
    }	


    echo"<input type=hidden name=fincit value=$cn>";  
    $cn=0;      
    
		mysql_query("CREATE TEMPORARY TABLE usutmp_erney SELECT referencia.asol_ref AS asol_ref, referencia.idre_ref AS idre, detareferencia.obsv_dre AS obsv_dre, detareferencia.codi_dre AS codi, detareferencia.cant_dre AS cant, detareferencia.iden_dre AS iden, referencia.fech_ref AS fech, detareferencia.cant_dre AS ncit, detareferencia.alse_dre AS alse, detareferencia.marc_dre AS marc_dre, detareferencia.cant_cit AS cant_cit, ucontrato.CUSU_UCO, ucontrato.CONT_UCO, ucontrato.ESTA_UCO, referencia.msol_ref AS medisol
		FROM (detareferencia INNER JOIN referencia ON detareferencia.idre_dre = referencia.idre_ref) INNER JOIN ucontrato ON referencia.cuco_ref = ucontrato.IDEN_UCO
		WHERE (((referencia.fech_ref)>='$fech') AND ((detareferencia.alse_dre)<>'') AND ((detareferencia.marc_dre)='1402') AND ((ucontrato.CUSU_UCO)='$codusu') 
		AND ((detareferencia.reci_dre)='S')) OR (((referencia.fech_ref)>='$fech') AND ((detareferencia.cant_dre)>(detareferencia.cant_cit)) AND 
		((detareferencia.alse_dre)<>'') AND ((detareferencia.marc_dre)='1406') AND ((detareferencia.cant_cit)>0) AND ((ucontrato.CUSU_UCO)='$codusu') AND 
		((detareferencia.reci_dre)='S'))");
		
		
		
		mysql_query("INSERT INTO usutmp_erney SELECT referencia.asol_ref AS asol_ref, referencia.idre_ref AS idre, detareferencia.obsv_dre AS obsv_dre, detareferencia.codi_dre AS codi, detareferencia.cant_dre AS cant, detareferencia.iden_dre AS iden, referencia.fech_ref AS fech, detareferencia.cant_dre AS ncit, cups_citas_medicas.especialidad AS alse, detareferencia.marc_dre AS marc_dre, detareferencia.cant_cit AS cant_cit, ucontrato.CUSU_UCO, ucontrato.CONT_UCO, ucontrato.ESTA_UCO, referencia.msol_ref AS medisol
		FROM ((detareferencia INNER JOIN referencia ON detareferencia.idre_dre = referencia.idre_ref) INNER JOIN ucontrato ON referencia.cuco_ref = ucontrato.IDEN_UCO) INNER JOIN cups_citas_medicas ON detareferencia.codi_dre = cups_citas_medicas.codigo
		WHERE (((referencia.fech_ref)>='$fech') AND ((detareferencia.alse_dre)='') AND ((detareferencia.marc_dre)='1402') AND ((ucontrato.CUSU_UCO)='$codusu')) 
		OR (((referencia.fech_ref)>='$fech') AND ((detareferencia.cant_dre)>(detareferencia.cant_cit)) AND ((detareferencia.alse_dre)='') AND 
		((detareferencia.marc_dre)='1406') AND ((detareferencia.cant_cit)>0) AND ((ucontrato.CUSU_UCO)='$codusu'))");
		
		$bref=mysql_query("SELECT * FROM usutmp_erney");
		
	
    $cs=0;
    $cn=0;
    while($rar=mysql_fetch_array($bref))
    {
		$numeroid=$rar['idre'];
        $codproced=$rar['codi'];	//Identificador tabla referencia 
        $codservic=$rar['alse'];	//codigo servicio al que se remite
				
        $cant=$rar['cant'];		//codigo procedimiento 
        $idendetaref=$rar['iden'];	//identificador tabla detareferencia
        $fecharef=$rar['fech'];		//Fecha
        $numcitas=$rar['ncit']; //numero de citas autorizadas
		$aresol=$rar['asol_ref'];
		$citasig=$rar['cant_cit'];		
		$estado=$rar['marc_dre'];
		$obsref=$rar['obsv_dre'];
		$cont_uco=$rar['CONT_UCO'];
		$estacon=$rar['ESTA_UCO'];
		$medisol=$rar['medisol'];
		
		
		
		
		$valcita=0;		
		if($estado=='1406')
		{			
			$bcit=mysql_query("SELECT Min(citas.Fsolusu_citas) AS minfec FROM citas WHERE (((citas.iden_dre) LIKE '%$idendetaref%'))");	
			//ECHO "SELECT Min(citas.Fsolusu_citas) AS minfec FROM citas WHERE (((citas.iden_dre)LIKE '%$idendetaref%'))";			
			$rcit=mysql_fetch_array($bcit);
			$feccita=$rcit['minfec'];
			$diasdif=verifica($feccita);
			if($diasdif>60)$valcita=1;
			
		}
		
		if($valcita==0)
		{
			
			//echo $codservic.' '.$estacon.' '.$idendetaref.'<br>';
			if($codservic=='01' || $codservic=='1')$codservic='0664';
			if($codservic=='04' || $codservic=='4')$codservic='0634';
			
			$busdes=mysql_query("SELECT destipos.codi_des, destipos.valo_des, areas.cod_areas, destipos.nomb_des, areas.nom_areas
			FROM destipos INNER JOIN areas ON destipos.valo_des = areas.equi_area
			WHERE (((destipos.codi_des)='$codservic'))");
			
			
			
			while($rusdes=mysql_fetch_array($busdes))	
			{			
				
				
				
				$nomservic='';   //Nombre servicio al que se remite
				$areades='';
				$nomarea='';
				$nomservic=$rusdes['nomb_des'];   //Nombre servicio al que se remite
				$areades=$rusdes['cod_areas'];
				$nomarea=$rusdes['nom_areas'];
				
				if($aresol=='01' || $aresol=='1')$aresol='0664';
				if($aresol=='04' || $aresol=='4')$aresol='0634';		
				$bsuare=mysql_query("SELECT destipos.codi_des, destipos.valo_des, destipos.nomb_des, areas.nom_areas
				FROM destipos INNER JOIN areas ON destipos.valo_des = areas.cod_areas
				WHERE (((destipos.codi_des)='$aresol'))");
				while($rusar=mysql_fetch_array($bsuare))	
				{			
					$nomsol=$rusar['nomb_des'];   //Nombre servicio al que se remite
					$aresol=$rusar['valo_des'];
					$nomarsol=$rusar['nom_areas'];
				}		
				if(strlen($codproced)>4)
				{	
							
					$busmap=mysql_query("select * from cups where codigo='$codproced'");
					while($rusmap=mysql_fetch_array($busmap))	
					{
						$descrimap=$rusmap['descrip'];			
					}
				}
				$bmedsol=mysql_query("select * from medicos where cod_medi='$medisol'");
				while($rmedsol=mysql_fetch_array($bmedsol))
				{
					$nommedsol=$rmedsol['nom_medi'];
				}				
				$bper=mysql_query("SELECT areas.nom_areas
				FROM areas
				WHERE (((areas.arci_area)='$areatra') AND ((areas.cod_areas)='$areades'))");	


				
				if(mysql_num_rows($bper)>0)
				{  					
					
					
					
					
					$nomautos='cont_uco'.$cs;
					echo"<input type=hidden name=$nomautos value='$cont_uco'>";
					$nomautos='estacon'.$cs;
					echo"<input type=hidden name=$nomautos value='$estacon'>";				
					$nomautos='nomarsol'.$cs;
					echo"<input type=hidden name=$nomautos value='$nomarsol'>";			
					$nomautos='clase'.$cs;
					echo"<input type=hidden name=$nomautos value='S'>";
					$nomautos='fecharef'.$cs;
					echo"<input type=hidden name=$nomautos value=$fecharef>";
					$nomautos='descrimap'.$cs;
					echo"<input type=hidden name=$nomautos value='$descrimap'>";
					$nomautos='nomarea'.$cs;
					echo"<input type=hidden name=$nomautos value='$nomarea'>";
					$nomautos='cant'.$cs;
					echo"<input type=hidden name=$nomautos value=$cant>";
					$nomautos='numeroid'.$cs;
					echo"<input type=hidden name=$nomautos value=$numeroid>";
					$nomautos='areades'.$cs;
					echo"<input type=hidden name=$nomautos value='$areades'>";
					$nomautos='numcitas'.$cs;
					echo"<input type=hidden name=$nomautos value='$numcitas'>";
					$nomautos='idendetaref'.$cs;
					echo"<input type=hidden name=$nomautos value='$idendetaref'>";
					$nomautos='citasig'.$cs;
					echo"<input type=hidden name=$nomautos value='$citasig'>";
					$nomautos='obsref'.$cs;
					echo"<input type=hidden name=$nomautos value='$obsref'>";
					$nomautos='nommedsol'.$cs;
					echo"<input type=hidden name=$nomautos value='$nommedsol'>";
					if($igual==1)
					{
						for($j=0;$j<$finsigue;$j++)
						{
							$nomautos='idennue'.$j;
							$idennue=$$nomautos;
							
							if($idennue==$idendetaref)
							{
								$nomautos='selrefret'.$j;			
								$selrefret=$$nomautos;							
								$nomautos='selref'.$cs;
								
								echo"<input type=hidden name=$nomautos value=$selrefret>";							
							}
						}
					}
					$permi='N';
					$bper=mysql_query("SELECT permisos_citas.iden_per, permisos_citas.tipo_per, permisos_citas.usua_per, permisos_citas.serv_per, permisos_citas.esta_per, permisos_citas.area_per
					FROM permisos_citas
					WHERE (((permisos_citas.usua_per)='$usucitas') AND ((permisos_citas.serv_per)='$areades') AND ((permisos_citas.esta_per)='A') AND ((permisos_citas.area_per)='$areatra'))");
					while($rper=mysql_fetch_array($bper))
					{
						$idenper=$rper['iden_per'];
						$tip=$rper['tipo_per'];
						if($tip=='T')
						{
							$permi='S';
						}
						if($tip=='P')
						{
							$bpercon=mysql_query("SELECT permisos_citascon.iden_per, permisos_citascon.cont_pco, permisos_citascon.esta_pco
							FROM permisos_citascon
							WHERE (((permisos_citascon.iden_per)='$idenper') AND ((permisos_citascon.cont_pco)='$cont_uco') AND ((permisos_citascon.esta_pco)='A'))");
							if(mysql_num_rows($bpercon)>=0)$permi='S';
						}
					}
					$nomautos='permiso'.$cs;
					echo"<input type=hidden name=$nomautos value='$permi'>";
					

					
					/*
					$bpermi=mysql_query("SELECT permisos_citas.area_per, permisos_citas.serv_per, permisos_citas.usua_per, permisos_citascon.cont_pco, permisos_citas.esta_per, permisos_citascon.esta_pco
					FROM permisos_citas INNER JOIN permisos_citascon ON permisos_citas.iden_per = permisos_citascon.iden_per
					WHERE (((permisos_citas.area_per)='$areatra') AND ((permisos_citas.serv_per)='$areades') AND ((permisos_citas.usua_per)='$usucitas') AND ((permisos_citascon.cont_pco)='$cont_uco') AND ((permisos_citas.esta_per)='A') AND ((permisos_citascon.esta_pco)='A'))");
					$nomautos='permiso'.$cs;
					
					if(mysql_num_rows($bpermi)==0)echo"<input type=hidden name=$nomautos value='N'>";
					else echo"<input type=hidden name=$nomautos value='S'>";
					*/
					$cs++;
					
				}
			}
		}
	}
    echo"<input type=hidden name=finrefs value=$cs>";
    echo"<input type=hidden name=finrefn value=$cn>";

	//Aqui se crea el tarifario
	$contratos = substr_replace($contratos, '', -1);
	$medicos = substr_replace($medicos, '', -1);

	$tarifas = array();

	$cups="";	
	if(!empty($medicos)){
		$consultacups="SELECT cupmp_medi 
		FROM medicos
		WHERE cod_medi IN ($medicos)";	
		echo "<br>".$consultacups;
		$consultacups=mysql_query($consultacups);
		if(mysql_num_rows($consultacups) <> 0){
			while($rowcups = mysql_fetch_array($consultacups)){
				if($rowcups['cupmp_medi'] <> ''){
					$cups=$cups.$rowcups['cupmp_medi'].',';
				}		
			}
			$cups = substr_replace($cups, '', -1);
		}
	}
	

	//Aqui se carga el tarifario
	if(!empty($contratos) && !empty($cups)){
		$tarifarios = substr_replace($tarifarios, '', -1);
		$consultatarifa="SELECT t.iden_tco,t.iden_ctr,t.clas_tco , t.valo_tco ,c.nume_ctr 
		,cups.codi_cup,cups.descrip 
		FROM tarco t 
		INNER JOIN contratacion c ON c.iden_ctr = t.iden_ctr 
		INNER JOIN mapii m ON m.iden_map = t.iden_map 
		INNER JOIN cups ON cups.codigo = m.codi_map 
		WHERE c.esta_ctr='A' AND m.esta_map = 'AC' AND t.clas_tco ='P' 
		AND c.codi_con IN ($contratos) 
		AND cups.codi_cup IN ($cups)";	
		//echo "<br>".$consultatarifa;
		$restarifario = mysql_query($consultatarifa);
		while($rowtarifa = mysql_fetch_array($restarifario)){
			$tarifa = new Tarco();
			$tarifa->iden_tco = $rowtarifa['iden_tco'];
			$tarifa->iden_ctr = $rowtarifa['iden_ctr'];
			$tarifa->clas_tco = $rowtarifa['clas_tco'];
			$tarifa->valo_tco = $rowtarifa['valo_tco'];
			$tarifa->codi_cup = $rowtarifa['codi_cup'];
			$tarifa->descrip = $rowtarifa['descrip'];	
		
			$tarifas[] = $tarifa;	
		}
	}
	
	$tarifasJSON = json_encode($tarifas);
	//echo $tarifasJSON;

	echo"<input type=hidden name=tarifas value='$tarifasJSON'>";


    echo"</form>";

	function verifica($fecjus)
	{      
		//defino fecha 1 	 
		$ano1 = substr($fecjus,0,4); 
		$mes1 = substr($fecjus,5,2); 
		$dia1 = substr($fecjus,8,2); 
		//defino fecha 2 	
		$dia2=date("d");
		$mes2=date("m");
		$ano2=date("Y");
		//calculo timestam de las dos fechas 
		$timestamp1 = mktime(0,0,0,$mes1,$dia1,$ano1); 
		$timestamp2 = mktime(4,12,0,$mes2,$dia2,$ano2); 
		//resto a una fecha la otra 
		$segundos_diferencia = $timestamp1 - $timestamp2; 
		//echo $segundos_diferencia; 
		//convierto segundos en das 
		$dias_diferencia = $segundos_diferencia / (60 * 60 * 24); 
		//obtengo el valor absoulto de los das (quito el posible signo negativo) 
		$dias_diferencia = abs($dias_diferencia); 
		//quito los decimales a los das de diferencia 
		$dias_diferencia = floor($dias_diferencia); 
		return $dias_diferencia;         //1=justificado; 2=No justificado
	}	

	


	class Tarco {
		public $iden_tco;
		public $iden_ctr;
		public $clas_tco;
		public $valo_tco;
		public $codi_cup;
		public $descrip;
	}
?>
</body>
</html>