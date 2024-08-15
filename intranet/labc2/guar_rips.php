<?
session_register('Gidusulab'); 
?>
<html>
<head>
<title>RIPS</title>
</head>
<SCRIPT LANGUAGE='JavaScript'>
function enviar()
{		
		//alert("El n�mero de Orden es:\n"+form1.iden_labs.value);
		form1.control.value=2
		form1.target='';
		form1.esta_ncf.value=2
		form1.action='imp_sticker.php';
		form1.submit();	
		
}


function regresar()
	{
		alert("El n�mero de Factura ya esta ingresada Verifique");
		form1.action='ing_cups.php'
		form1.control.value=3
		//form1.target='area'
		form1.submit();
					
	}
	
	
function regresar2()
	{
		alert("El n�mero de Factura ya esta ingresada Verifique");
		form1.action='gen_rips_hospi.php'
		//form1.control.value=3
		//form1.target='area'
		form1.submit();
					
	}
</script>
<form name="form1" method="POST" >
<?		


		//$link=Mysql_connect("localhost","root","");
		$link=Mysql_connect("192.168.4.12","root","");
		if(!$link)echo"no hay conexion";
		Mysql_select_db('proinsalud',$link);
		
		$fecha=time();
		$fec=date ("Y-m-d",$fecha);
		$hor=date ("H:i",$fecha);
		echo $format;
		//echo $fat;
		//echo $Gidusulab;
	
		echo"<input type='hidden' name=obs_dx value='$obs_dx'>";
		echo"<input type='hidden' name=cod_cie value='$cod_cie'>";
		echo"<input type=hidden name=contrato value=$contrato>";
		echo "<input type=hidden name=iden_var value=$iden_var>";
		echo "<input type=hidden name=codusu value=$codusu>";
		echo "<input type=hidden name=control value=2>";
		echo "<input type=hidden name=codig_usu value=$codig_usu>";
		echo"<input type=hidden name=idein value=$idein>";
		//echo"<input type=hidden name=med_soli value=$med_soli>";
		echo"<input type=hidden name=amb_usu  value='$amb_usu'>";
		echo"<input type=hidden name=fin_con  value='$fin_con'>";
		echo"<input type=hidden name=condu  value='$condu'>";
		echo"<input type=hidden name=progu  value='$progu'>";
		echo"<input type=hidden name=med_soli  value='$med_soli'>";
		echo"<input type=hidden name=fent value=$fent>";
		echo"<input type=hidden name='iden_evo' value='$iden_evo'>";
		echo"<input type=hidden name=ide_cita value=$ide_cita>";
		echo"<input type=hidden name=num_ord value=$num_ord >";
		echo"<input type=hidden name=obs_labs value='$obs_labs'>";
		echo "<input type=hidden name=cod value=$cod>";
		echo "<input type=hidden name=nord_lab value=$nord_lab>";
		echo "<input type=hidden name=it value=$it>";
		echo "<input type=hidden name=jt value=$jt>";
		echo "<input type=hidden name=ctr_usu value=$ctr_usu>";
		echo"<input type=hidden name=esta_ncf value=$esta_ncf>";
		echo"<input type=hidden name=format value=$format>";
		echo"<input type=hidden name=mcu value=$mcu>";
		echo"<input type=hidden name=fin value=$fin>";
		echo"<input type=hidden name=nord_lab value=$num_ord >";
		echo "<input type=hidden name=idcita value=$idcita>";
		echo "<input type=hidden name=msol_ref value=$msol_ref>";
		echo"<input type=hidden name='servi' value='$servi'>";
		//echo"<input type=hidden name=iden_labs value=$iden_labs>";
		
		echo "FORMATO".$format;
		
		if(empty($med_soli))$med_soli=$msol_ref;
		$concam="SELECT caac_ing  FROM `ingreso_hospitalario` WHERE id_ing='$idein'";
		//echo $concam;
		$concam=mysql_query($concam);
		while($rowcam=mysql_fetch_array($concam))
		{	
			$cam=$rowcam['caac_ing'];
		}		
		if(empty($codusu)) $codusu=$codig_usu;
		//echo $codusu;
		if($format==1)
		{

			$conenc=mysql_query("SELECT iden_labs,nord_dlab FROM detalle_labs WHERE nord_dlab='$num_ord'");
			
			if(mysql_num_rows($conenc)==0)
			{
							
				$inselabc="INSERT INTO encabezado_labs ( iden_labs,codi_usu,cod_medi,iden_evo,ctr_labs,fchr_labs,fche_labs,hrar_labs,hrae_labs,ambi_labs,codu_labs,prog_labs,fina_labs,dxo_labs,obs_labs,resp_labs) 
				VALUES (0,'$codusu', '$med_soli','$iden_evo','$contrato','$fent', '$fec', '$hor', '$hor' , '$amb_usu', '$condu','$progu', '$fin_con', '$cod_cie','$obs_dx' ,'$Gidusulab')";
				//echo "<br>".$inselabc;
				$inselabc=mysql_query($inselabc);
				
				$iden_labs=mysql_insert_id();
				//echo $iden_labs;
			
				echo "<input type=hidden name=iden_labs value=$iden_labs>";
			
				for($i=0;$i<$mcu;$i++)
				{
					$nomvar='selec'.$it.$jt.$i;
					$sel=$$nomvar;	
					
					$nomvar='cod'.$it.$jt.$i;
					$cod=$$nomvar;	
			
					$nomvar='chk_rem'.$it.$jt.$i;
					$chk_rem=$$nomvar;
					
					
					$nomvar='selec'.$it.$jt.$i;
					echo"<input type=hidden name=$nomvar value=$sel>";
					
					$nomvar='cod'.$it.$jt.$i;
					echo"<input type=text name=$nomvar value=$cod>";
					
					$nomvar='chk_rem'.$it.$jt.$i;
					echo"<input type=text name=$nomvar value=$chk_rem>";
					
						
					if($sel==1)
					{
						if($chk_rem==1)
						{
							$sql_="INSERT INTO detalle_labs (iden_dlab, iden_labs, codigo,nord_dlab,cod_medi, obsv_dlab, refe_dlab, unid_dlab,fech_dlab,hora_dlab,estd_dlab) 
							VALUES (0, '$iden_labs', '$cod', '$num_ord','11', 'RMTD', '-', '-','$fec','$hor','RE')";
							//echo "<br>".$sql_;
							$sql_=mysql_query($sql_);
						}
						else
						{
							$sql_=mysql_query("INSERT INTO detalle_labs (iden_dlab, iden_labs, codigo,nord_dlab,cod_medi, obsv_dlab, refe_dlab, unid_dlab, estd_dlab) 
							VALUES (0, '$iden_labs', '$cod', '$num_ord','', '', '', '','P')");
							//echo "<br>".$sql_;
							$sql_=mysql_query($sql_);						
						}
                                            
                                        $ident_labo=mysql_insert_id();
                                        ///INTERFAZ DE DESARROLLO
                                        $sqlusu=Mysql_query("SELECT * FROM USUARIO WHERE CODI_USU='$codig_usu'");
                                        $rowusin=mysql_fetch_array($sqlusu);
                                        $tiden=$rowusin[TDOC_USU];
                                        $codi_usu=$rowusin[CODI_USU];
                                        $documento=$rowusin[NROD_USU];
                                        $nombre1=$rowusin[PNOM_USU];
                                        $nombre2=$rowusin[SNOM_USU];
                                        $apellido1=$rowusin[PAPE_USU];
                                        $apellido2=$rowusin[SAPE_USU];
                                        $genero=$rowusin[SEXO_USU];
                                        $fecnaci=$rowusin[FNAC_USU];
                                        $direcc=$rowusin[DIRE_USU];
                                        $telefono=$rowusin[TRES_USU];
                                        $cciudad=$rowusin[MATE_USU];
                                        $zona=$rowusin[ZONA_USU];
                                        $celular=$rowusin[TEL2_USU];
                                        $email=$rowusin[EMAI_USU];
                                        $tipousuar=$rowusin[TPAF_USU];
                                        
                                        $cosexam=Mysql_Query("SELECT codigo,descrip FROM cups WHERE codigo='$cod'");
                                        $rowexa=mysql_fetch_array($cosexam);
                                        $nom_examen=$rowexa[descrip];
                                        
                                        $codmedc=Mysql_Query("SELECT cod_medi,nom_medi FROM medicos WHERE cod_medi='$med_soli'");
                                        $rowmedic=mysql_fetch_array($codmedc);
                                        $nomb_medico=$rowmedic[nom_medi];
                                        
                                        $codctr=Mysql_Query("SELECT CODI_CON, CEPS_CON ,NIT_CON ,NEPS_CON  FROM contrato  WHERE CODI_CON='$contrato'");
                                        $rowctr=mysql_fetch_array($codctr);
                                        $nomb_ctr=$rowctr[NEPS_CON];
                                        
                                        $codpiso=Mysql_Query("SELECT codi_des,codt_des,nomb_des FROM destipos  WHERE codi_des='$servi'");
                                        $rowpiso=mysql_fetch_array($codpiso);
                                        $nservi=$rowpiso[nomb_des];
                                      
                                        if($condu=='4'){ $embzo='F';} else{ $embzo='V';}


                                        $sqlinterfaz=mysql_query("INSERT INTO `proinsalud`.`labo_winsislab` (`num_orden` ,`fecha` ,`tipodoc`,`documento` ,`apellido1` ,`apellido2` ,
                                        `nombre1` ,`nombre2` ,`sexo` ,`fechanac` ,`direccion` ,`telefono` ,`cod_ciudad` ,`cod_zona` ,`celular` ,`email` ,
                                        `cod_examen` ,`nom_examen` ,`cantidad` ,`num_peticion` ,`piso` ,`en_embarazo` ,`tipo_usuario` ,`tiposer` ,`cod_medico` ,`nom_medico` ,
                                        `cod_cliente` ,`nom_cliente` ,`cod_cencos` ,`nom_cencos` ,`cod_sede` ,`estado`,`iden_labs` ,`iden_dlab`)
                                         VALUES ( '$num_ord', '$fent', '$tiden' ,'$documento', '$apellido1', '$apellido2', '$nombre1', '$nombre2', '$genero', '$fecnaci', '$direcc', '$telefono', '$cciudad', '$zona', '$celular',
                                         '$email', '$cod', '$nom_examen', '1', '$iden_labs', '','$embzo', '$tipousuar', '$amb_usu', '$med_soli', '$nomb_medico', '$contrato',
                                         '$nomb_ctr', '$servi', '$nservi', '1', '0','$iden_labs','$ident_labo')");
                                                
                                                
                                                
                                                
                                                
                                                
					}
					mysql_query("Update hist_var SET esta_var='CU' WHERE iden_evo='$iden_evo' AND iden_ser='$cod'");
				}
			}
		
		///Si la factura ya existe
		else
		{
			for($i=0;$i<$mcu;$i++)
			{
					$nomvar='selec'.$it.$jt.$i;
					$sel=$$nomvar;	
					
					$nomvar='cod'.$it.$jt.$i;
					$cod=$$nomvar;	
			
					
					$nomvar='selec'.$it.$jt.$i;
					echo"<input type=hidden name=$nomvar value=$sel>";
					
					$nomvar='cod'.$it.$jt.$i;
					//echo $$nomvar;
					echo"<input type=hidden name=$nomvar value=$cod>";
					
			}	
						
			echo "<body onload='regresar2()'>";

		}

					
	}
		///////INGRESO DEL PACIENTE QUE NO TIENE EMITIDO UNA ORDEN
		
		if($format==2)
		{
					
			for($i=0;$i<$fin;$i++)
			{
				$nomvar='selec'.$i;
				$sel=$$nomvar;	
				$nomvar='cod'.$i;
				$cod=$$nomvar;	
				$nomvar='obs'.$i;
				$obs=$$nomvar;
				$nomvar='uni'.$i;
				$unlabc=$$nomvar;
				$nomvar='ref'.$i;
				$ref=$$nomvar;
						
				$nomvar='selec'.$i;
				echo"<input type=hidden name=$nomvar value=$sel>";
				$nomvar='cod'.$i;
				echo"<input type=hidden name=$nomvar value=$cod>";
				$nomvar='obs'.$i;
				echo"<input type=hidden name=$nomvar value='$obs'>";
				$nomvar='uni'.$i;
				echo"<input type=hidden name=$nomvar value='$unlabc'>";
				$nomvar='ref'.$i;
				echo"<input type=hidden name=$nomvar value='$ref'>";			
				
			}
			
			if(empty($ide_cita)){$ide_cita=$servi;}
			//if(empty($codusu)) $codusu=$codig_usu;
			
			$inselabc="INSERT INTO encabezado_labs (codi_usu, iden_cita,ctr_labs,cod_medi,fchr_labs,fche_labs,hrar_labs,hrae_labs,ambi_labs,codu_labs,prog_labs,fina_labs,dxo_labs,obs_labs,resp_labs) 
			VALUES ('$codig_usu','$ide_cita','$contrato','$med_soli', '$fent', '$fent', '$hor', '$hor' , '$amb_usu','$condu', '$progu', '$fin_con', '$cod_cie', '$obs_dx','$Gidusulab')";
			//echo $inselabc;
			$inselabc=mysql_query($inselabc);

			$iden_labs=mysql_insert_id();
			echo "<input type=hidden name=iden_labs value=$iden_labs>";
			
			for($i=0;$i<$fin;$i++)
			{
				$nomvar='selec'.$i;
				$sel=$$nomvar;	
				$nomvar='cod'.$i; 
				$cod=$$nomvar;	
				$nomvar='chk_rem'.$i;
				$chk_rem=$$nomvar;
						
				$nomvar='selec'.$i;
				echo"<input type=hidden name=$nomvar value=$sel>";
				$nomvar='cod'.$i;
				echo"<input type=hidden name=$nomvar value=$cod>";
				$nomvar='chk_rem'.$i;
				echo"<input type=text name=$nomvar value=$chk_rem>";
				
				
				
				if($sel==1)
				{
					if($chk_rem==1)
					{
						$sql1="INSERT INTO detalle_labs (iden_dlab, iden_labs, codigo,nord_dlab,cod_medi, obsv_dlab, refe_dlab, unid_dlab, fech_dlab,hora_dlab,estd_dlab) 
						VALUES (0, '$iden_labs', '$cod','$num_ord','11', 'RMTD', '-', '-','$fec','$hor','RE')";
						//echo $sql1;
						$cont=mysql_query($sql1);
						
						
					}
					else
					{
						$sql2="INSERT INTO detalle_labs (iden_dlab, iden_labs, codigo,nord_dlab,estd_dlab) 
						VALUES (0, '$iden_labs', '$cod','$num_ord','P')";
						$cont2=mysql_query($sql2);
						//echo $sql2;
                                                
					
					}	
                                        
                                        $ident_labo=mysql_insert_id();
                                        ///INTERFAZ DE DESARROLLO
                                        $sqlusu=Mysql_query("SELECT * FROM USUARIO WHERE CODI_USU='$codig_usu'");
                                        $rowusin=mysql_fetch_array($sqlusu);
                                        $tiden=$rowusin[TDOC_USU];
                                        $codi_usu=$rowusin[CODI_USU];
                                        $documento=$rowusin[NROD_USU];
                                        $nombre1=$rowusin[PNOM_USU];
                                        $nombre2=$rowusin[SNOM_USU];
                                        $apellido1=$rowusin[PAPE_USU];
                                        $apellido2=$rowusin[SAPE_USU];
                                        $genero=$rowusin[SEXO_USU];
                                        $fecnaci=$rowusin[FNAC_USU];
                                        $direcc=$rowusin[DIRE_USU];
                                        $telefono=$rowusin[TRES_USU];
                                        $cciudad=$rowusin[MATE_USU];
                                        $zona=$rowusin[ZONA_USU];
                                        $celular=$rowusin[TEL2_USU];
                                        $email=$rowusin[EMAI_USU];
                                        $tipousuar=$rowusin[TPAF_USU];
                                        
                                        $cosexam=Mysql_Query("SELECT codigo,descrip FROM cups WHERE codigo='$cod'");
                                        $rowexa=mysql_fetch_array($cosexam);
                                        $nom_examen=$rowexa[descrip];
                                        
                                        $codmedc=Mysql_Query("SELECT cod_medi,nom_medi FROM medicos WHERE cod_medi='$med_soli'");
                                        $rowmedic=mysql_fetch_array($codmedc);
                                        $nomb_medico=$rowmedic[nom_medi];
                                        
                                        $codctr=Mysql_Query("SELECT CODI_CON, CEPS_CON ,NIT_CON ,NEPS_CON  FROM contrato  WHERE CODI_CON='$contrato'");
                                        $rowctr=mysql_fetch_array($codctr);
                                        $nomb_ctr=$rowctr[NEPS_CON];
                                        
                                        $codpiso=Mysql_Query("SELECT codi_des,codt_des,nomb_des FROM destipos  WHERE codi_des='$servi'");
                                        $rowpiso=mysql_fetch_array($codpiso);
                                        $nservi=$rowpiso[nomb_des];
                                      
                                        if($condu=='4'){ $embzo='F';} else{ $embzo='V';}


                                        $sqlinterfaz="INSERT INTO `proinsalud`.`labo_winsislab` (`num_orden` ,`fecha` ,`tipodoc`,`documento` ,`apellido1` ,`apellido2` ,
                                        `nombre1` ,`nombre2` ,`sexo` ,`fechanac` ,`direccion` ,`telefono` ,`cod_ciudad` ,`cod_zona` ,`celular` ,`email` ,
                                        `cod_examen` ,`nom_examen` ,`cantidad` ,`num_peticion` ,`piso` ,`en_embarazo` ,`tipo_usuario` ,`tiposer` ,`cod_medico` ,`nom_medico` ,
                                        `cod_cliente` ,`nom_cliente` ,`cod_cencos` ,`nom_cencos` ,`cod_sede` ,`estado`,`iden_labs` ,`iden_dlab`)
                                         VALUES ( '$num_ord', '$fent', '$tiden' ,'$documento', '$apellido1', '$apellido2', '$nombre1', '$nombre2', '$genero', '$fecnaci', '$direcc', '$telefono', '$cciudad', '$zona', '$celular',
                                         '$email', '$cod', '$nom_examen', '1', '$iden_labs', '$nservi', '$embzo', '$tipousuar', '$amb_usu', '$med_soli', '$nomb_medico', '$contrato',
                                         '$nomb_ctr', '$servi', '$nservi', '1', '0','$iden_labs','$ident_labo')";
                                        //echo $sqlinterfaz;
                                        $sqlinterfaz=mysql_query($sqlinterfaz);
                                                                               
				}
			
			}
			if(empty($ide_cita))$ide_cita=$idcita;
			//echo" Update citas SET rips_citas='1' WHERE id_cita='$ide_cita'";
                        
	    
	
	}	
?>
<input type=text name=esta_ncf>
<input type=text name=fin>
<body onload='enviar()'>
</form>
</body>
</html><html><head></head><body></body></html>