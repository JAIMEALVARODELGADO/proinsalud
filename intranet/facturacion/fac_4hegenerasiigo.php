<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>PROGRAMA DE FACTURACIN</title>
<link rel="stylesheet" href="css/style.css" type="text/css" />
<script language='javascript'>
function validar(){
  form1.submit();
}
</script>
</head>
<body>
<form name='form1' method="POST" action='fac_4heguardarel.php' target='fr02'>
<table class="Tbl0"><tr><td class="Td0" align='center'>ARCHIVO PLANO PARA TRASLADO A  S I I G O</td></tr></table>
<?
set_time_limit(0);
include('php/conexion.php');
//include('php/conexiones_g.php');
include('php/funciones.php');
//base_420();
$consultaemp="SELECT ctades_emp,ctacaj_emp,ctacopago_emp FROM empresa";
$consultaemp=mysql_query($consultaemp);
$rowemp=mysql_fetch_array($consultaemp);
$ctades=$rowemp[ctades_emp];
$ctacaja=$rowemp[ctacaj_emp];
$ctacopago_emp=$rowemp[ctacopago_emp];

//Ciclo para  filtrar las entidades

$condicion=$condicion."(";
for ($i=0;$i<count($nit);$i++){
	if($nit[$i]<>''){
		$condicion=$condicion."enti_fac='$nit[$i]' OR ";
	}
}
if(substr($condicion,-1)<>"("){
	$condicion=substr($condicion,0,strlen($condicion)-4).") AND ";
}
else{
	$condicion=substr($condicion,0,strlen($condicion)-1);   
}

//$condicion=$condicion."nume_fac<>'' AND anul_fac<>'S' AND ";
$condicion=$condicion."nume_fac<>'' AND ";
if($chkcta<>'on'){$condicion=$condicion."rela_fac<>'' AND ";}
if(!empty($factura)){$condicion=$condicion."nume_fac='$factura' AND ";}
if(!empty($pref_fac)){$condicion=$condicion."pref_fac='$pref_fac' AND ";}
//if(!empty($nit)){$condicion=$condicion."ef.enti_fac='$nit' AND ";}
if(!empty($tipo_fac)){$condicion=$condicion."tipo_fac='$tipo_fac' AND ";}
if(!empty($fechaini)){
	$fechaini=cambiafecha($fechaini);
	$condicion=$condicion."fcie_fac>='$fechaini' AND ";
}
if(!empty($fechafin)){
	$fechafin=cambiafecha($fechafin);
	$condicion=$condicion."fcie_fac<='$fechafin' AND ";
}
$condicion=substr($condicion,0,strlen($condicion)-5);
//echo $condicion;
$consulta="SELECT id_ing,tipo_fac,enti_fac,iden_fac,pref_fac,nume_fac,fcie_fac,vtot_fac,vcop_fac,cmod_fac,pdes_fac,vnet_fac,area_fac,ccon_ctr,iden_ctr,tipfac_sxd,codi_cdc,rcod_ctr,CONCAT(pnom_usu,' ',snom_usu,' ',pape_usu,' ',sape_usu) AS nombre,nrod_usu,truncate((DATEDIFF(fcie_fac,fnac_usu)/365.25),0) as edad,mres_usu,estr_usu,regi_usu,tpaf_usu,servicio,feci_fac,fecf_fac,cod_cie10,nom_cie10
    FROM vista_factura_siigo
    WHERE $condicion ORDER BY nume_fac";
    //echo "<br>".$consulta;
$consulta=mysql_query($consulta);


//***Aqui genero la condición para las notas debitos
$condicionnd="(";
for ($i=0;$i<count($nit);$i++){
	if($nit[$i]<>''){
		$condicionnd=$condicionnd."enti_fac='$nit[$i]' OR ";
	}
}
if(substr($condicionnd,-1)<>"("){
	$condicionnd=substr($condicionnd,0,strlen($condicionnd)-4).") AND ";
}
else{
	$condicionnd=substr($condicionnd,0,strlen($condicionnd)-1);
}
//$condicion=$condicion."nume_fac<>'' AND ";
if($chkcta<>'on'){$condicionnd=$condicionnd."rela_fac<>'' AND ";}
if(!empty($factura)){$condicionnd=$condicionnd."nume_fac='$factura' AND ";}
if(!empty($pref_fac)){$condicionnd=$condicionnd."pref_fac='$pref_fac' AND ";}
if(!empty($tipo_fac)){$condicionnd=$condicionnd."tipo_fac='$tipo_fac' AND ";}
if(!empty($fechaini)){
	$condicionnd=$condicionnd."fech_anu>='$fechaini 00:00' AND ";
}
if(!empty($fechafin)){
	$condicionnd=$condicionnd."fech_anu<='$fechafin 23:59' AND ";
}
$condicionnd=substr($condicionnd,0,strlen($condicionnd)-5);
//echo "<br>".$condicionnd;
//************
echo "<table class='Tbl0' border='0'>";
	echo "<th class='Th0'>ERRORES</th>";
	echo "</table>";
	echo "<table class='Tbl0' border='0'>";
	echo "<th class='Th0'>Factura</th>
	<th class='Th0'>Error</th>
	<th class='Th0'>Detalle</th>
	";
$encontrados=0;
if(mysql_num_rows($consulta)<>0){
	$encontrados++;
	$siigo="";
	$encabezado_siigo="";
	$cont=0;
	$error=0;	
	while($row=mysql_fetch_array($consulta)){
		$consec=1;
		$rcod_ctr=$row[rcod_ctr];
		if($color<>'#dddddd'){$color='#dddddd';}else{$color='';}
		//echo $row[cuen_con];
		$descuento=round(($row[vtot_fac]*($row[pdes_fac]/100)),0);
		$nume_fac=str_pad($row[nume_fac],11,"0",STR_PAD_LEFT);        
		//echo "<br>".$nume_fac;
		$centrocos=$row[CODI_CDC];
		//echo "<br>cc".$centrocos;
		if(strstr($row[enti_fac],'-')){
			$nit=str_pad(substr($row[enti_fac],0,strpos($row[enti_fac],"-")),13,"0",STR_PAD_LEFT);
		}
		else{
			$nit=str_pad(trim($row[enti_fac]),13,"0",STR_PAD_LEFT);
		}
		//echo "<br>".$nit;
		$fcie_fac=substr($row[fcie_fac],0,4).substr($row[fcie_fac],5,2).substr($row[fcie_fac],8,2);
		//echo "<br>".$row[pref_fac];
		if($row[pref_fac]=="I"){
			$tipdoc="F004";
		}
		else{
			//$tipdoc="F090";
			$tipdoc="F010";
			if(!IS_NULL($row[tipfac_sxd])){
				$tipdoc=$row[tipfac_sxd];            
			}
		}
		$debito=0;
		$credito=0;

		//***********************
		//Aqui capturo la información del encabezado de la factura
		$encabezado_siigo=$encabezado_siigo.$tipdoc;
		$encabezado_siigo=$encabezado_siigo.$nume_fac;
		$encabezado_siigo=$encabezado_siigo.'Admisión: '.$row['id_ing'].', ';
		$encabezado_siigo=$encabezado_siigo.'Paciente: '.$row['NROD_USU'].', '.$row['nombre'].', ';
		$encabezado_siigo=$encabezado_siigo.'Edad: '.$row['edad'].', ';		
		$encabezado_siigo=$encabezado_siigo.'Servicio: '.$row['servicio'].', ';
		$encabezado_siigo=$encabezado_siigo.'Ingreso: '.$row['feci_fac'].', ';
		$encabezado_siigo=$encabezado_siigo.'Egreso: '.$row['fecf_fac'].', ';
		$encabezado_siigo=$encabezado_siigo.'Dx: '.$row['cod_cie10'].' '.SUBSTR($row['nom_cie10'],0,50).', ';
		$encabezado_siigo=$encabezado_siigo.'Municipio: '.SUBSTR($row['MRES_USU'],0,10).', ';
		$encabezado_siigo=$encabezado_siigo.'Estrato: '.$row['ESTR_USU'].', ';
		$encabezado_siigo=$encabezado_siigo.'Régimen: '.$row['REGI_USU'].', ';		
		$encabezado_siigo=$encabezado_siigo.'Tp.Afiliación: '.$row['TPAF_USU'];

		$encabezado_siigo=$encabezado_siigo."\r\n";
		//echo "<br>".$encabezado_siigo;		
		/*F01000000005596
		Admisión: 125001, Paciente: 2301558 JOSE HECTOR GONZALES MARTINEZ, Edad: 74, Servicio: UCI ADULTOS, Ingreso: 2020-09-03, Egreso: 2020-09-04, Dx: K922 HEMORRAGIA GASTROINTESTINAL, NO ESPECIFICADA, Municipio: PASTO, Estrato: 1, Régimen: 2, Tp. Afiliación: C
		*/		
		//***********************
		
		//echo "<br>".$tipdoc;
		//*** Aqui comienzo el registro de los detalles (naruraleza C)
		$consultadet="SELECT iden_dfa,tipo_dfa,iden_fac,iden_tco,desc_dfa,cant_dfa,valu_dfa,
		cconcir_map AS cuenta
		FROM vista_detalle_factura_siigo
		WHERE iden_fac=$row[iden_fac]";		
		$consultadet=mysql_query($consultadet);
		$valormayor=0;
		$cuentamay='';
		$ctamed="";
		$ctains="";
		$consultaotr="SELECT ctamed_cxs,ctains_cxs FROM cuentaxservicio        
		WHERE codi_cxs='$row[area_fac]'";
		//echo "<br>".$consultaotr;
		$consultaotr=mysql_query($consultaotr);      
		if(mysql_num_rows($consultaotr)<>0){
			$rowotr=mysql_fetch_array($consultaotr);
			$ctamed=$rowotr[ctamed_cxs];
			$ctains=$rowotr[ctains_cxs];
		}
		else{
			echo "<tr>";
			echo "<td class='Td2' align='left' bgcolor='$color'>$row[nume_fac]</td>";
			echo "<td class='Td2' align='left' bgcolor='$color'>El Servicio NO tiene codigo contable.</td>";
			echo "<td class='Td2' align='left' bgcolor='$color'>$row[area_fac]</td>";
			echo "</tr>";
		}
		//echo "<br>".$row[nume_fac];
		while($rowdet=mysql_fetch_array($consultadet)){
			$desc_dfa=str_replace(",",".",$rowdet[desc_dfa]);			
			$desc_dfa=ereg_replace('[[:space:]]+',' ',$desc_dfa); //Quito el enter(salto de linea
			$no_permitidas= array ("á","é","í","ó","ú","Á","É","Í","Ó","Ú","ñ","À","Ã","Ì","Ò","Ù","Ã™","Ã ","Ã¨","Ã¬","Ã²","Ã¹","ç","Ç","Ã¢","ê","Ã®","Ã´","Ã»","Ã‚","ÃŠ","ÃŽ","Ã”","Ã›","ü","Ã¶","Ã–","Ã¯","Ã¤","«","Ò","Ã","Ã„","Ã‹","ñ","Ñ");
			$permitidas= array ("a","e","i","o","u","A","E","I","O","U","n","N","A","E","I","O","U","a","e","i","o","u","c","C","a","e","i","o","u","A","E","I","O","U","u","o","O","i","a","e","U","I","A","E",'n','N');
			$desc_dfa = str_replace($no_permitidas, $permitidas ,$desc_dfa); //Aqui le quito las tildes y ñs

			//echo "<br>".$desc_dfa;
			$cuenta=$rowdet[cuenta];
			//echo "<br>".$cuenta.$rowdet[tipo_dfa];
			$valor=$rowdet[cant_dfa]*$rowdet[valu_dfa];
			
			$cantisiigo=ceros(15, ceil(abs($rowdet[cant_dfa])*100000));
			
			//echo "<br>".$valor;
			//echo "<br>".$rowdet[tipo_dfa];

			//******************			
			switch ($rowdet['tipo_dfa']){
                case 'P':
                  //Aqui comparo la codificacion a utilizar de aceurdo a $rcod_ctr  1=Cup 2= Soat
                  if($rcod_ctr=='1'){
                    $consultacod="SELECT codi_map,codi_cup AS codigo FROM mapii AS map
                                          INNER JOIN tarco AS trc ON map.iden_map=trc.iden_map
                                          INNER JOIN cups ON cups.codigo=map.codi_map
                                          WHERE trc.iden_tco=$rowdet[iden_tco]";
                  }
                  else{
                      $consultacod="SELECT soat_map AS codigo FROM mapii AS map
                                          INNER JOIN tarco AS trc ON map.iden_map=trc.iden_map
                                          WHERE trc.iden_tco=$rowdet[iden_tco]";
                  }                       
                  $consultacod=mysql_query($consultacod);
                  if(mysql_num_rows($consultacod)<>0){
                        $rowcod=mysql_fetch_array($consultacod);
                        $codi_=$rowcod[codigo];
                  }
                  else{
                    $consultacod="SELECT codi_map AS codigo FROM mapii AS map
                                          INNER JOIN tarco AS trc ON map.iden_map=trc.iden_map
                                          WHERE trc.iden_tco=$rowdet[iden_tco]";
                    $consultacod=mysql_query($consultacod);
                    if(mysql_num_rows($consultacod)<>0){
                        $rowcod=mysql_fetch_array($consultacod);
                        $codi_=$rowcod[codigo];
                    }  
                  }
                  mysql_free_result($consultacod);
                  break;
                case 'M':
                  $clase="Medicamentos";
                  $consultacod="SELECT mdi.codi_mdi,mdi.cum_med FROM medicamentos2 AS mdi
                                          INNER JOIN tarco AS trc ON trc.iden_map=mdi.codi_mdi
                                          WHERE trc.iden_tco=$rowdet[iden_tco]";                     
                  $consultacod=mysql_query($consultacod);
                  if(mysql_num_rows($consultacod)<>0){
                        $rowcod=mysql_fetch_array($consultacod);
                        $codi_=$rowcod[cum_med];
                        //$codi_=$rowcod[codi_mdi];
                        //$codi_=$rowcod[iden_map];                            
                  }
                  mysql_free_result($consultacod);
                  break;
                case 'I':
                  $clase="Insumos";
                  $consultacod=mysql_query("SELECT ins.codi_ins FROM insu_med AS ins
                                          INNER JOIN tarco AS trc ON trc.iden_map=ins.codi_ins
                                          WHERE trc.iden_tco=$rowdet[iden_tco]");
                  if(mysql_num_rows($consultacod)<>0){
                        $rowcod=mysql_fetch_array($consultacod);
                        $codi_=$rowcod[codi_ins];
                  }
                  mysql_free_result($consultacod);
                  break;
            }			
			$desc_dfa=$codi_.' '.$desc_dfa;//Aqui adiciono el código a la descripción
			//echo "<br>".$desc_dfa;
			//******************
			if($rowdet[tipo_dfa]=='M'){
				$cuenta=$ctamed;                
			}
			elseif($rowdet[tipo_dfa]=='I'){
				$cuenta=$ctains;                
			}
			//echo "<br>".$cuenta;
			$ciru='N';	
			if($ciru=='N'){
				//*Aqui genero el registro si no es una cirugia                
				$descripcion=substr($desc_dfa,0,50);				
				$descripcion=str_pad($descripcion,50,' ',STR_PAD_RIGHT);
				//echo "<br>".$rowdet['iden_dfa'].'-'.$descripcion;				
				$siigo=$siigo.$tipdoc;
				$siigo=$siigo.$nume_fac;
				$siigo=$siigo.str_pad($consec,5,"0",STR_PAD_LEFT);
				$siigo=$siigo.$nit;
				$siigo=$siigo."000";
				$siigo=$siigo.str_pad($cuenta,10,"0",STR_PAD_RIGHT);
				$siigo=$siigo."0000000000000";            
				$siigo=$siigo.$fcie_fac;            
				//$siigo=$siigo."0004";
				$siigo=$siigo.$centrocos;
				$siigo=$siigo."509";                                                
				$siigo=$siigo.$descripcion;
				$siigo=$siigo."C";
				$siigo=$siigo.str_pad($valor,13,'0',STR_PAD_LEFT)."00";
				$siigo=$siigo."000000000000000";
				$siigo=$siigo."0001";
				$siigo=$siigo."0000";
				$siigo=$siigo."000";
				$siigo=$siigo."0000";
				$siigo=$siigo."000";
				$siigo=$siigo.str_pad($rowdet[cant_dfa],10,'0',STR_PAD_LEFT)."00000";            
				$siigo=$siigo.$tipdoc;
				$siigo=$siigo.$nume_fac;
				$siigo=$siigo."001";
				$siigo=$siigo.$fcie_fac;
				$siigo=$siigo."0000";
				$siigo=$siigo."00\r\n";
				//echo "<br>".$siigo;
				$debito=$debito+$valor;
				//echo "<br>".$debito;
				//echo "<br>".$valor;
			}			
			if($valor>$valormayor){
				$valormayor=$valor;
				$cuentamay=$cuenta;                
			}
			if(empty($cuenta)){
				echo "<tr>";
				echo "<td class='Td2' align='left' bgcolor='$color'>$row[nume_fac]</td>";
				echo "<td class='Td2' align='left' bgcolor='$color'>La cuenta esta vacia.</td>";
				echo "<td class='Td2' align='left' bgcolor='$color'>$desc_dfa</td>";
				echo "</tr>";
				$error=1;
			}
			$consec=$consec+1;
			//echo "<br>C ".$cuenta;
		}
		//*** Aqui finalizo el registro de los detalles (naturaleza C
	
		/****************/
		
		if($row[cmod_fac]<>0){
			$descripcion="SERVICIOS MES ".substr($row[fcie_fac],5,2)." DE ".substr($row[fcie_fac],0,4);
			$descripcion=str_pad($descripcion,50,' ',STR_PAD_RIGHT);
			$siigo=$siigo.$tipdoc;
			$siigo=$siigo.$nume_fac;
			$siigo=$siigo.str_pad($consec,5,"0",STR_PAD_LEFT);
			$siigo=$siigo.$nit;
			$siigo=$siigo."000";            
			$siigo=$siigo.str_pad($cuentamay,10,"0",STR_PAD_RIGHT);
			$siigo=$siigo."0000000000000";
			$siigo=$siigo.$fcie_fac;
			//$siigo=$siigo."0004";
			$siigo=$siigo.$centrocos;
			$siigo=$siigo."509";
			$siigo=$siigo.$descripcion;
			$siigo=$siigo."D";
			$siigo=$siigo.str_pad($row[cmod_fac],13,'0',STR_PAD_LEFT)."00";
			$siigo=$siigo."000000000000000";
			$siigo=$siigo."0001";
			$siigo=$siigo."0000";
			$siigo=$siigo."000";
			$siigo=$siigo."0000";
			$siigo=$siigo."000";
			$siigo=$siigo."000000000000000";
			$siigo=$siigo.$tipdoc;
			$siigo=$siigo.$nume_fac;
			$siigo=$siigo."001";
			$siigo=$siigo.$fcie_fac;
			$siigo=$siigo."0000";
			$siigo=$siigo."00\r\n";
			$consec=$consec+1;
			$credito=$credito+$row[cmod_fac];
			//echo "<br>".$siigo;
		}
		/***************/
		//Aqui hago el registro del valor neto facturado
		$descripcion="SERVICIOS MES ".substr($row[fcie_fac],5,2)." DE ".substr($row[fcie_fac],0,4);
		$descripcion=str_pad($descripcion,50,' ',STR_PAD_RIGHT);
		$siigo=$siigo.$tipdoc;        
		$siigo=$siigo.$nume_fac;
		$siigo=$siigo.str_pad($consec,5,"0",STR_PAD_LEFT);
		$siigo=$siigo.$nit;
		$siigo=$siigo."000";
		//echo "<br>".$row[tipo_fac];
		//if($row[tipo_fac]=='2'){
			$siigo=$siigo.str_pad($row[ccon_ctr],10,"0",STR_PAD_RIGHT);            
		/*}
		else{
			$siigo=$siigo.str_pad($ctacaja,10,"0",STR_PAD_RIGHT);}*/
		$siigo=$siigo."0000000000000";
		$siigo=$siigo.$fcie_fac;
		//echo "<br>".$siigo;
		//$siigo=$siigo."0004";
		$siigo=$siigo.$centrocos;
		$siigo=$siigo."509";
		$siigo=$siigo.$descripcion;
		$siigo=$siigo."D";
		//echo "<br>".$nume_fac."D";
		$siigo=$siigo.str_pad($row[vnet_fac],13,'0',STR_PAD_LEFT)."00";
		$siigo=$siigo."000000000000000";
		$siigo=$siigo."0001";
		$siigo=$siigo."0000";
		$siigo=$siigo."000";
		$siigo=$siigo."0000";
		$siigo=$siigo."000";
		$siigo=$siigo."000000000000000";
		$siigo=$siigo.$tipdoc;
		$siigo=$siigo.$nume_fac;
		$siigo=$siigo."001";
		$siigo=$siigo.$fcie_fac;
		$siigo=$siigo."0000";
		$siigo=$siigo."00\r\n";
		$credito=$credito+$row[vnet_fac];
		//echo "<br>".$credito;
		//echo "<br>".$row[ccon_ctr];

		//******************************************************
		//******** NOTA: Esta parte debe quedar despues de la cuenta 13		
		//Aqui hago el registro del descuento				
		//echo $descuento;
		if($descuento<>0){
			$descripcion="SERVICIOS MES ".substr($row[fcie_fac],5,2)." DE ".substr($row[fcie_fac],0,4);
			$descripcion=str_pad($descripcion,50,' ',STR_PAD_RIGHT);
			$siigo=$siigo.$tipdoc;
			$siigo=$siigo.$nume_fac;
			$siigo=$siigo.str_pad($consec,5,"0",STR_PAD_LEFT);
			$siigo=$siigo.$nit;
			$siigo=$siigo."000";
			//$siigo=$siigo.str_pad($row[cuen_con],10,"0",STR_PAD_RIGHT);			
			$siigo=$siigo.str_pad($ctades,10,"0",STR_PAD_RIGHT);
			$siigo=$siigo."0000000000000";
			$siigo=$siigo.$fcie_fac;
			//$siigo=$siigo."0004";
			$siigo=$siigo.$centrocos;
			$siigo=$siigo."509";
			$siigo=$siigo.$descripcion;
			$siigo=$siigo."D";
			$siigo=$siigo.str_pad($descuento,13,'0',STR_PAD_LEFT)."00";
			$siigo=$siigo."000000000000000";
			$siigo=$siigo."0001";
			$siigo=$siigo."0000";
			$siigo=$siigo."000";
			$siigo=$siigo."0000";
			$siigo=$siigo."000";
			$siigo=$siigo."000000000000000";
			$siigo=$siigo.$tipdoc;
			$siigo=$siigo.$nume_fac;
			$siigo=$siigo."001";
			$siigo=$siigo.$fcie_fac;
			$siigo=$siigo."0000";
			$siigo=$siigo."00\r\n";
			$consec=$consec+1;
			$credito=$credito+$descuento;
		}
		//******************************************************
		//$consec=$consec+1;
		//Aqui hago el registro del copago (naturaleza debito)
		if($row[vcop_fac]<>0){
			$descripcion="SERVICIOS MES ".substr($row[fcie_fac],5,2)." DE ".substr($row[fcie_fac],0,4);
			$descripcion=str_pad($descripcion,50,' ',STR_PAD_RIGHT);
			$siigo=$siigo.$tipdoc;            
			$siigo=$siigo.$nume_fac;
			$siigo=$siigo.str_pad($consec,5,"0",STR_PAD_LEFT);
			$siigo=$siigo.$nit;
			$siigo=$siigo."000";
			//echo "<br>".$ctacopago_emp;			
			$siigo=$siigo.str_pad($ctacopago_emp,10,"0",STR_PAD_RIGHT);
			$siigo=$siigo."0000000000000";
			$siigo=$siigo.$fcie_fac;
			//$siigo=$siigo."0004";
			$siigo=$siigo.$centrocos;
			$siigo=$siigo."509";
			$siigo=$siigo.$descripcion;
			$siigo=$siigo."D";
			$siigo=$siigo.str_pad($row[vcop_fac],13,'0',STR_PAD_LEFT)."00";
			$siigo=$siigo."000000000000000";
			$siigo=$siigo."0001";
			$siigo=$siigo."0000";
			$siigo=$siigo."000";
			$siigo=$siigo."0000";
			$siigo=$siigo."000";
			$siigo=$siigo."000000000000000";
			$siigo=$siigo.$tipdoc;
			$siigo=$siigo.$nume_fac;
			$siigo=$siigo."001";
			$siigo=$siigo.$fcie_fac;
			$siigo=$siigo."0000";
			$siigo=$siigo."00\r\n";
			$consec=$consec+1;
			$credito=$credito+$row[vcop_fac];
		}
		if(empty($row[ccon_ctr])){
			echo "<tr>";
			echo "<td class='Td2' align='left' bgcolor='$color'>$row[nume_fac]</td>";
			echo "<td class='Td2' align='left' bgcolor='$color'>La cuenta esta vacia..</td>";
			echo "<td class='Td2' align='left' bgcolor='$color'>La entidad no tiene creada la cuenta</td>";
			echo "</tr>";
			$error=1;
		}        
		//echo "<br>".$siigo;
		//echo "<br>".$debito;
		if(($debito-$credito)<>0){
			echo "<tr>";
			echo "<td class='Td2' align='left' bgcolor='$color'>$row[nume_fac]</td>";
			echo "<td class='Td2' align='left' bgcolor='$color'>Los crditos y los debitos no cuadran</td>";
			echo "<td class='Td2' align='left' bgcolor='$color'>$debito-$credito</td>";
			echo "</tr>";
		}
	}    
    mysql_free_result($consultadet);
}
trasladond($condicionnd,$siigo,$encontrados);
echo "</table>";
if($encontrados>0){
	$scarpeta=""; //carpeta donde guardar el archivo. 
	//debe tener permisos 775 por lo menos 
	$sfile="siigofac1.txt"; //ruta del archivo a generar 
	$fp=fopen($sfile,"w"); 		
	//$siigo= iconv("UTF-8", "ISO-8859-1//TRANSLIT", $siigo); //Convierto la informacion a tipo ANSI
	fwrite($fp,$siigo);
	fclose($fp); 

	//***********
	//Aqui genero el archivo de encabezado
	$sfile_encabezado="siigo_encabezado.txt"; //ruta del archivo a generar 
	$fencabezado=fopen($sfile_encabezado,"w"); 	
	//$encabezado_siigo= iconv("UTF-8", "ISO-8859-1//TRANSLIT", $encabezado_siigo); //Convierto la informacion a tipo ANSI
	fwrite($fencabezado,$encabezado_siigo);
	fclose($fencabezado);
	//***********
	echo "<br><table class='Tbl0' border='0'>";
	echo "<td class='Td0' align='right'><a href='".$sfile."' download><img width=20 height=20 src='icons/feed_disk.png' title='Generar Archivo' border=0></a></td>";
	echo "<td class='Td0' align='left'><a href='".$sfile."' download><b>Guardar Archivo de Facturación</a></td>";

	echo "<td class='Td0' align='right'><a href='".$sfile_encabezado."' download><img width=20 height=20 src='icons/feed_disk.png' title='Generar Archivo' border=0></a></td>";
	echo "<td class='Td0' align='left'><a href='".$sfile_encabezado."' download><b>Guardar Archivo de Encabezado</a></td>";
	echo "</table>";	
}
	
	/*else{	  
		echo "<center>";
		echo "<p class=Msg>No existen registros para esta busqueda</p>";
		echo "</center>";
	}*/
echo "<input type='hidden' name='cont' value='$cont'>";
echo "<input type='hidden' name='relacion' value='$relacion'>";
mysql_free_result($consultaemp);
mysql_free_result($consulta);
mysql_close();
?>
</form>
</body>
</html>

<?php
function trasladond($condicion,&$siigo,&$encontrados){	
	$consultaemp="SELECT ctades_emp,ctacaj_emp FROM empresa";
	$consultaemp=mysql_query($consultaemp);
	$rowemp=mysql_fetch_array($consultaemp);
	$ctades=$rowemp[ctades_emp];
	/*$consultand="SELECT anulafac.iden_anu,anulafac.iden_fac,anulafac.fech_anu,anulafac.numerond_anu,
encabezado_factura.tipo_fac,encabezado_factura.enti_fac,encabezado_factura.pref_fac,encabezado_factura.rela_fac,encabezado_factura.vtot_fac,encabezado_factura.pdes_fac,encabezado_factura.vnet_fac,encabezado_factura.nume_fac,encabezado_factura.area_fac,
	contrato.CODI_CDC,contratacion.ccon_ctr
	FROM anulafac
	INNER JOIN encabezado_factura ON encabezado_factura.iden_fac=anulafac.iden_fac
	INNER JOIN contratacion ON contratacion.iden_ctr=encabezado_factura.iden_ctr
	INNER JOIN contrato ON contrato.codi_con=contratacion.codi_con
	WHERE ".$condicion." ORDER BY nume_fac";*/
	$consultand="SELECT iden_anu,iden_fac,fech_anu,numerond_anu,tipo_fac,enti_fac,pref_fac,rela_fac,vtot_fac,pdes_fac,vnet_fac,nume_fac,area_fac,
	CODI_CDC,ccon_ctr
	FROM vista_anulafac_siigo	
	WHERE ".$condicion." ORDER BY nume_fac";
	//echo "<br>".$consultand;
	$consultand=mysql_query($consultand);
	if(mysql_num_rows($consultand)<>0){
		$encontrados++;
		$cont=0;
		$error=0;
		while($row=mysql_fetch_array($consultand)){
			$consec=1;		
			if($color<>'#dddddd'){$color='#dddddd';}else{$color='';}			
			$descuento=round(($row[vtot_fac]*($row[pdes_fac]/100)),0);
			$numerond_anu=str_pad($row[numerond_anu],11,"0",STR_PAD_LEFT);
			$nume_fac=str_pad($row[nume_fac],11,"0",STR_PAD_LEFT);
			//echo "<br>".$nume_fac;
			$centrocos=$row[CODI_CDC];
			//echo "<br>cc".$centrocos;
			if(strstr($row[enti_fac],'-')){
				$nit=str_pad(substr($row[enti_fac],0,strpos($row[enti_fac],"-")),13,"0",STR_PAD_LEFT);
			}
			else{
				$nit=str_pad(trim($row[enti_fac]),13,"0",STR_PAD_LEFT);
			}
			//echo "<br>".$nit;
			$fech_anu=substr($row[fech_anu],0,4).substr($row[fech_anu],5,2).substr($row[fech_anu],8,2);
			//echo "<br>".$fech_anu;
			$tipdoc="D004";
			/*if(!IS_NULL($row[tipfac_sxd])){
				$tipdoc=$row[tipfac_sxd];            
			}*/			
			$debito=0;
			$credito=0;
			//echo "<br>".$tipdoc;
			//*** Aqui comienzo el registro de los detalles (naruraleza C)
			$consultadet="SELECT iden_dfa,tipo_dfa,iden_fac,iden_tco,desc_dfa,cant_dfa,valu_dfa,
			cconcir_map AS cuenta
			FROM vista_detalle_factura_siigo
			WHERE iden_fac=$row[iden_fac]";
			//echo "<br>".$consultadet;
			$consultadet=mysql_query($consultadet);
			$valormayor=0;
			$cuentamay='';
			$ctamed="";
			$ctains="";
			$consultaotr="SELECT ctamed_cxs,ctains_cxs FROM cuentaxservicio        
			WHERE codi_cxs='$row[area_fac]'";
			//echo "<br>".$consultaotr;
			$consultaotr=mysql_query($consultaotr);      
			if(mysql_num_rows($consultaotr)<>0){
				$rowotr=mysql_fetch_array($consultaotr);
				$ctamed=$rowotr[ctamed_cxs];
				$ctains=$rowotr[ctains_cxs];
			}
			else{
				echo "<tr>";
				echo "<td class='Td2' align='left' bgcolor='$color'>$row[nume_fac]</td>";
				echo "<td class='Td2' align='left' bgcolor='$color'>El Servicio NO tiene codigo contable..</td>";
				echo "<td class='Td2' align='left' bgcolor='$color'>$row[area_fac]</td>";
				echo "</tr>";
			}
			while($rowdet=mysql_fetch_array($consultadet)){
				$desc_dfa=str_replace(",",".",$rowdet[desc_dfa]);
				$desc_dfa=ereg_replace('[[:space:]]+',' ',$desc_dfa); //Quito el enter(salto de linea 
				//echo "<br>".$desc_dfa;
				$cuenta=$rowdet[cuenta];
				//echo "<br>".$cuenta.$rowdet[tipo_dfa];
				$valor=$rowdet[cant_dfa]*$rowdet[valu_dfa];
				$cantisiigo=ceros(15, ceil(abs($rowdet[cant_dfa])*100000));
				//echo "<br>".$valor;
				//echo "<br>".$rowdet[tipo_dfa];
				if($rowdet[tipo_dfa]=='M'){
					$cuenta=$ctamed;                
				}
				elseif($rowdet[tipo_dfa]=='I'){
					$cuenta=$ctains;                
				}
				$descripcion=substr($desc_dfa,0,50);
				$descripcion=str_pad($descripcion,50,' ',STR_PAD_RIGHT);				
				$siigo=$siigo.$tipdoc;
				//$siigo=$siigo.$nume_fac;
				$siigo=$siigo.$numerond_anu;
				$siigo=$siigo.str_pad($consec,5,"0",STR_PAD_LEFT);				
				$siigo=$siigo.$nit;				
				$siigo=$siigo."000";
				$siigo=$siigo.str_pad($cuenta,10,"0",STR_PAD_RIGHT);
				$siigo=$siigo."0000000000000";            
				$siigo=$siigo.$fech_anu;				
				$siigo=$siigo.$centrocos;				
				$siigo=$siigo."509";                                                
				$siigo=$siigo.$descripcion;
				$siigo=$siigo."D";
				$siigo=$siigo.str_pad($valor,13,'0',STR_PAD_LEFT)."00";				
				$siigo=$siigo."000000000000000";
				$siigo=$siigo."0001";
				$siigo=$siigo."0000";
				$siigo=$siigo."000";
				$siigo=$siigo."0000";
				$siigo=$siigo."000";
				$siigo=$siigo.str_pad($rowdet[cant_dfa],10,'0',STR_PAD_LEFT)."00000";
				$tipdocfact="F010";
				$siigo=$siigo.$tipdocfact;
				$siigo=$siigo.$nume_fac;
				$siigo=$siigo."001";
				$siigo=$siigo.$fech_anu;				
				$siigo=$siigo."0000";
				$siigo=$siigo."00\r\n";				
				//echo "<br>".$siigo;
				$debito=$debito+$valor;
				//echo "<br>".$debito;
				//echo "<br>".$valor;		
				if($valor>$valormayor){
					$valormayor=$valor;
					$cuentamay=$cuenta;                
				}
				if(empty($cuenta)){
					echo "<tr>";
					echo "<td class='Td2' align='left' bgcolor='$color'>$row[nume_fac]</td>";
					echo "<td class='Td2' align='left' bgcolor='$color'>La cuenta esta vacia...</td>";
					echo "<td class='Td2' align='left' bgcolor='$color'>$desc_dfa</td>";
					echo "</tr>";
					$error=1;
				}
				$consec=$consec+1;
			}
			//*** Aqui finalizo el registro de los detalles (naturaleza D)			
			/****************/
			//$consec=$consec+1;		
			//Aqui hago el registro del descuento
			if($descuento<>0){
				$descripcion="SERVICIOS MES ".substr($row[fcie_fac],5,2)." DE ".substr($row[fcie_fac],0,4);
				$descripcion=str_pad($descripcion,50,' ',STR_PAD_RIGHT);
				$siigo=$siigo.$tipdoc;				
				//$siigo=$siigo.$nume_fac;
				$siigo=$siigo.$numerond_anu;
				$siigo=$siigo.str_pad($consec,5,"0",STR_PAD_LEFT);
				$siigo=$siigo.$nit;
				$siigo=$siigo."000";				
				$siigo=$siigo.str_pad($ctades,10,"0",STR_PAD_RIGHT);				
				$siigo=$siigo."0000000000000";
				$siigo=$siigo.$fech_anu;				
				$siigo=$siigo.$centrocos;				
				$siigo=$siigo."509";
				$siigo=$siigo.$descripcion;				
				$siigo=$siigo."C";				
				$siigo=$siigo.str_pad($descuento,13,'0',STR_PAD_LEFT)."00";
				$siigo=$siigo."000000000000000";
				$siigo=$siigo."0001";
				$siigo=$siigo."0000";
				$siigo=$siigo."000";
				$siigo=$siigo."0000";
				$siigo=$siigo."000";
				$siigo=$siigo.$cantisiigo;
				$tipdocfact="F010";
				$siigo=$siigo.$tipdocfact;
				$siigo=$siigo.$nume_fac;				
				$siigo=$siigo."001";
				$siigo=$siigo.$fech_anu;				
				$siigo=$siigo."0000";
				$siigo=$siigo."00\r\n";
				$consec=$consec+1;
				$credito=$credito+$descuento;
			}
			if($row[vcop_fac]<>0){
				$descripcion="SERVICIOS MES ".substr($row[fcie_fac],5,2)." DE ".substr($row[fcie_fac],0,4);
				$descripcion=str_pad($descripcion,50,' ',STR_PAD_RIGHT);
				$siigo=$siigo.$tipdoc;            
				$siigo=$siigo.$numerond_anu;
				$siigo=$siigo.str_pad($consec,5,"0",STR_PAD_LEFT);
				$siigo=$siigo.$nit;
				$siigo=$siigo."000";            
				$siigo=$siigo.str_pad($cuentamay,10,"0",STR_PAD_RIGHT);
				$siigo=$siigo."0000000000000";
				$siigo=$siigo.$fech_anu;				
				$siigo=$siigo.$centrocos;
				$siigo=$siigo."509";
				$siigo=$siigo.$descripcion;
				$siigo=$siigo."C";
				$siigo=$siigo.str_pad($row[vcop_fac],13,'0',STR_PAD_LEFT)."00";
				$siigo=$siigo."000000000000000";
				$siigo=$siigo."0001";
				$siigo=$siigo."0000";
				$siigo=$siigo."000";
				$siigo=$siigo."0000";
				$siigo=$siigo."000";
				$siigo=$siigo.$cantisiigo;
				$tipdocfact="F010";
				$siigo=$siigo.$tipdocfact;
				$siigo=$siigo.$nume_fac;
				$siigo=$siigo."001";
				$siigo=$siigo.$fech_anu;
				$siigo=$siigo."0000";
				$siigo=$siigo."00\r\n";
				$consec=$consec+1;
				$credito=$credito+$row[vcop_fac];
			}
			if($row[cmod_fac]<>0){
				$descripcion="SERVICIOS MES ".substr($row[fcie_fac],5,2)." DE ".substr($row[fcie_fac],0,4);
				$descripcion=str_pad($descripcion,50,' ',STR_PAD_RIGHT);
				$siigo=$siigo.$tipdoc;
				$siigo=$siigo.$numerond_anu;
				$siigo=$siigo.str_pad($consec,5,"0",STR_PAD_LEFT);
				$siigo=$siigo.$nit;
				$siigo=$siigo."000";    
				$siigo=$siigo.str_pad($cuentamay,10,"0",STR_PAD_RIGHT);
				$siigo=$siigo."0000000000000";
				$siigo=$siigo.$fech_anu;
				//$siigo=$siigo."0004";
				$siigo=$siigo.$centrocos;
				$siigo=$siigo."509";
				$siigo=$siigo.$descripcion;
				$siigo=$siigo."C";
				$siigo=$siigo.str_pad($row[cmod_fac],13,'0',STR_PAD_LEFT)."00";
				$siigo=$siigo."000000000000000";
				$siigo=$siigo."0001";
				$siigo=$siigo."0000";
				$siigo=$siigo."000";
				$siigo=$siigo."0000";
				$siigo=$siigo."000";
				$siigo=$siigo.$cantisiigo;
				$tipdocfact="F010";
				$siigo=$siigo.$tipdocfact;				
				$siigo=$siigo.$nume_fac;
				$siigo=$siigo."001";
				$siigo=$siigo.$fech_anu;
				$siigo=$siigo."0000";
				$siigo=$siigo."00\r\n";
				$consec=$consec+1;
				$credito=$credito+$row[cmod_fac];
				//echo "<br>".$siigo;
			}
			/***************/
			//Aqui hago el registro del valor neto facturado
			$descripcion="SERVICIOS MES ".substr($row[fcie_fac],5,2)." DE ".substr($row[fcie_fac],0,4);
			$descripcion=str_pad($descripcion,50,' ',STR_PAD_RIGHT);
			$siigo=$siigo.$tipdoc;			
			$siigo=$siigo.$numerond_anu;
			$siigo=$siigo.str_pad($consec,5,"0",STR_PAD_LEFT);
			$siigo=$siigo.$nit;
			$siigo=$siigo."000";
			//echo "<br>".$row[tipo_fac];
			//if($row[tipo_fac]=='2'){
				$siigo=$siigo.str_pad($row[ccon_ctr],10,"0",STR_PAD_RIGHT);            
			/*}
			else{
				$siigo=$siigo.str_pad($ctacaja,10,"0",STR_PAD_RIGHT);}*/
			$siigo=$siigo."0000000000000";
			$siigo=$siigo.$fech_anu;			
			$siigo=$siigo.$centrocos;			
			$siigo=$siigo."509";
			$siigo=$siigo.$descripcion;
			$siigo=$siigo."C";						
			$siigo=$siigo.str_pad($row[vnet_fac],13,'0',STR_PAD_LEFT)."00";			
			$siigo=$siigo."000000000000000";
			$siigo=$siigo."0001";
			$siigo=$siigo."0000";
			$siigo=$siigo."000";
			$siigo=$siigo."0000";
			$siigo=$siigo."000";
			$siigo=$siigo.$cantisiigo;
			$tipdocfact="F010";
			$siigo=$siigo.$tipdocfact;			
			$siigo=$siigo.$nume_fac;			
			$siigo=$siigo."001";
			$siigo=$siigo.$fech_anu;			
			$siigo=$siigo."0000";
			$siigo=$siigo."00\r\n";
			$credito=$credito+$row[vnet_fac];
			//echo "<br>".$credito;
			if(empty($row[ccon_ctr])){
				echo "<tr>";
				echo "<td class='Td2' align='left' bgcolor='$color'>$row[nume_fac]</td>";
				echo "<td class='Td2' align='left' bgcolor='$color'>La cuenta esta vacia....</td>";
				echo "<td class='Td2' align='left' bgcolor='$color'>La entidad no tiene creada la cuenta</td>";
				echo "</tr>";
				$error=1;
			}        
			//echo "<br>".$siigo;
			//echo "<br>".$debito;
			if(($debito-$credito)<>0){
				echo "<tr>";
				echo "<td class='Td2' align='left' bgcolor='$color'>$row[nume_fac]</td>";
				echo "<td class='Td2' align='left' bgcolor='$color'>Los crditos y los debitos no cuadran</td>";
				echo "<td class='Td2' align='left' bgcolor='$color'>$debito-$credito</td>";
				echo "</tr>";
			}			
		}		
		mysql_free_result($consultadet);		
	}
}
function ceros($largo,$variable)
{
	$tamaño=$largo-strlen($variable);
	$cadena='';
	for($k=0;$k<$tamaño;$k++)
	{
		$cadena=$cadena.'0';
	}
	$cadena=$cadena.$variable;
	return $cadena;
}
?>