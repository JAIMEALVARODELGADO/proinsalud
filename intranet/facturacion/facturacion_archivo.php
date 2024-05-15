<?php
	//include('../conexion/conexion.php');
	include('php/conexion.php');
	set_time_limit(0);
	function clase($idenFac, $idetrc, $link,&$cod_,&$codconta_)
	{
		$sql = "SELECT iden_fac, nume_fac, tser_tco, clas_map, codi_map, codi_cup, cconcir_map,nomb_des
		FROM vista_clase_actividad
		WHERE iden_fac='$idenFac' AND iden_tco='$idetrc'";
		//echo "<br>".$sql;
		$res = mysql_query($sql,$link);
		if(mysql_num_rows($res)>0)
		{
			while($row = mysql_fetch_array($res))
			{
				$nomb_des = $row['nomb_des'];
                $cod_=$row['codi_cup'];
                $codconta_=$row['cconcir_map'];                
			}
		}
		else
		{
			$nomb_des = " ";
		}
		mysql_free_result($res);
		return $nomb_des;
	}
	function BuscarFacturador($codfac,$link)
	{
		//$link_gen = conectar_gen();
		$sql = "SELECT cut.nomb_usua FROM general.cut WHERE (((cut.ide_usua)='$codfac'));";
		//$res = mysql_query($sql,$link);
		$res = mysql_query($sql);
		$row = mysql_fetch_row($res);
		mysql_free_result($res);
        //$link = conectar();
		return $row[0];
		
		
	
	}

	function trae_medicamento($iden_tco_,$iden_fac_,&$codigo_cont){		
		$cod_='';
		$consmed_="SELECT iden_tco, iden_fac, nume_fac, ncsi_medi, nomb_mdi, ctamed_cxs
		FROM vista_medicamento_detalle
		WHERE iden_tco='$iden_tco_' AND iden_fac='$iden_fac_'";
		//echo "<br>".$consmed_;
		$consmed_=mysql_query($consmed_);
		if(mysql_num_rows($consmed_)<>0){
			$row_=mysql_fetch_array($consmed_);
			$cod_=$row_[ncsi_medi];
			$codigo_cont=$row_[ctamed_cxs];
		}		
		return($cod_);
	}

	function trae_insumo($iden_tco_,$iden_fac_,&$codigo_cont){		
		$cod_='';
		$consmed_="SELECT codi_ins, iden_tco, iden_fac, nume_fac, ctains_cxs
		FROM vista_insumo_detalle
		WHERE iden_tco='$iden_tco_' AND iden_fac='$iden_fac_'";
		//echo "<br>".$consmed_;
		$consmed_=mysql_query($consmed_);
		if(mysql_num_rows($consmed_)<>0){
			$row_=mysql_fetch_array($consmed_);
			$cod_=$row_[codi_ins];
			$codigo_cont=$row_[ctains_cxs];
		}
		return($cod_);
	}

// **********************************************************************************************
// **********************************************************************************************
//LEBOC 20220317 - Se genera reporte a archvio directamente
// **********************************************************************************************
// **********************************************************************************************
	//$link=conectar();
	$condicion="";
	$lCondicionSep= "";
		
	if(isset($_POST['band']))
	{
        /*
		$condicion="esta_fac <> '3' ";
		$lCondicionSep= "AND ";
		
        if(!empty($fechaInicio)){
            $condicion=$condicion.$lCondicionSep."(feci_fac Between '$fechaInicio' And '$fechaFin') ";
			$lCondicionSep= "AND ";
        }
        if(!empty($fechacierreInicio)){
            $condicion=$condicion.$lCondicionSep."(fcie_fac Between '$fechacierreInicio' And '$fechacierreFin') ";
			$lCondicionSep= "AND ";
        }
        if(!empty($prefijo)){
        	$condicion=$condicion.$lCondicionSep."pref_fac='$prefijo' ";	
			$lCondicionSep= "AND ";
        }
        if(!empty($entidad)){
        	$condicion=$condicion.$lCondicionSep."enti_fac='$entidad' ";	
			$lCondicionSep= "AND ";
        }
		
		
		$condicion="esta_fac <> '3' "; 
		$condicion=$condicion.$lCondicionSep."(feci_fac Between '2021-01-29' And '2021-01-29') ";
        $condicion=$condicion.$lCondicionSep."(fcie_fac Between '2021-01-29' And '2021-01-29') ";
        //$condicion=$condicion.$lCondicionSep."pref_fac='FE' ";	
        //$condicion=$condicion.$lCondicionSep."enti_fac='900935126-7' ";	
		
		$sql = "SELECT iden_fac, nume_fac, fcie_fac, 
		codi_con, rela_fac, enti_fac, 
		anul_fac, esta_fac, feci_fac, 
		fecf_fac, NEPS_CON,RESPONSABLE_PAGO, cod_cie10, 
		NROD_USU, PNOM_USU, SNOM_USU, 
		PAPE_USU, SAPE_USU, FNAC_USU, 
		desc_dfa, cant_dfa, iden_tco, 
		valu_dfa, vcop_fac, pdes_fac, 
		cmod_fac, usua_fac, SERVICIO, 
		cod_medi,tipo_dfa, nom_medi,
		FLOOR( DATEDIFF( fcie_fac , FNAC_USU ) / 365.25 ) AS edad,servicio_det, 
		pref_fac
		FROM  vista_detalle_factura
		WHERE $condicion";
		
		*/
		
		
		$condicion="";
		$lCondicionSep= "WHERE ";
		
		if(!empty($fechaInicio)){
            $condicion=$condicion.$lCondicionSep."(d_fe.feci_fac Between '$fechaInicio' And '$fechaFin') ";
			$lCondicionSep= "AND ";
        }
        if(!empty($fechacierreInicio)){
            $condicion=$condicion.$lCondicionSep."(d_fe.fcie_fac Between '$fechacierreInicio' And '$fechacierreFin') ";
			$lCondicionSep= "AND ";
        }
        if(!empty($prefijo)){
        	$condicion=$condicion.$lCondicionSep."d_fe.pref_fac='$prefijo' ";	
			$lCondicionSep= "AND ";
        }
        if(!empty($entidad)){
        	$condicion=$condicion.$lCondicionSep."d_fe.enti_fac='$entidad' ";	
			$lCondicionSep= "AND ";
        }
		$condicion=$condicion.$lCondicionSep."d_fe.esta_fac <> '3' ";
		$lCondicionSep= "AND ";
		
		/*
		$condicion="WHERE d_fe.esta_fac <> '3' "; 
		$lCondicionSep= "AND ";
		$condicion=$condicion.$lCondicionSep."(d_fe.feci_fac Between '2021-01-29' And '2021-01-29') ";
        $condicion=$condicion.$lCondicionSep."(d_fe.fcie_fac Between '2021-01-29' And '2021-01-29') ";
        //$condicion=$condicion.$lCondicionSep."pref_fac='FE' ";	
        //$condicion=$condicion.$lCondicionSep."enti_fac='900935126-7' ";	
		*/
		
		$sql="SELECT d_fe.iden_fac,d_fe.pref_fac,d_fe.nume_fac,
		d_fe.fcie_fac,d_fe.codi_con,d_fe.rela_fac,
		d_fe.enti_fac,d_fe.anul_fac,d_fe.esta_fac,
		d_fe.feci_fac,d_fe.fecf_fac,d_c.NEPS_CON,
		d_c.NIT_CON,d_c1.NEPS_CON AS RESPONSABLE_PAGO,d_fe.cod_cie10,d_u.NROD_USU,
		d_u.PNOM_USU,d_u.SNOM_USU,d_u.PAPE_USU,d_u.SAPE_USU,
		d_u.FNAC_USU,d_fd.iden_dfa,d_fd.desc_dfa,d_fd.cant_dfa,
		d_fd.iden_tco,d_fd.valu_dfa,d_fe.vcop_fac,d_fe.pdes_fac,
		d_fe.cmod_fac,d_fe.area_fac,d_dt.nomb_des AS SERVICIO,d_fd.cod_medi,
		d_fd.tipo_dfa,d_pm.nom_medi,d_ptar.tser_tco,destipos_1.nomb_des AS TIP_SERVICIO,
		d_ptar.clas_tco,d_fe.usua_fac,d_cut.nomb_usua,destipos_2.nomb_des AS servicio_det, 
		d_u.mate_usu AS d_mun_ate_codigo, d_mun.nomb_mun AS d_mun_ate_nombre,
		FLOOR( DATEDIFF(d_fe.fcie_fac , d_u.FNAC_USU ) / 365.25 ) AS edad 
		from ((((((((((proinsalud.encabezado_factura d_fe
		join proinsalud.detalle_factura d_fd on((d_fe.iden_fac = d_fd.iden_fac))) 
		left join proinsalud.destipos d_dt on((d_fe.area_fac = d_dt.codi_des))) 
		join proinsalud.contrato d_c on((d_fe.codi_con = d_c.CODI_CON))) 
		join proinsalud.usuario d_u on((d_fe.codi_usu = d_u.CODI_USU))) 
		left join proinsalud.medicos d_pm on((d_fd.cod_medi = d_pm.cod_medi))) 
		left join proinsalud.contrato d_c1 on((d_fe.enti_fac = d_c1.NIT_CON))) 
		left join proinsalud.tarco d_ptar on((d_fd.iden_tco = d_ptar.iden_tco))) 
		left join proinsalud.destipos destipos_1 on((d_ptar.tser_tco = destipos_1.codi_des))) 
		left join proinsalud.destipos destipos_2 on((d_fd.servi_dfa = destipos_2.codi_des))) 
		left join general.cut d_cut on((d_fe.usua_fac = d_cut.ide_usua)))
		left join proinsalud.municipio d_mun ON d_mun.codi_mun = d_u.mate_usu ".
		$condicion;
		//echo "<br>-__-__-<br>$sql<br>-_-<br>";
		//$res = mysql_query($sql,$link);	
		$res = mysql_query($sql);	

		if(mysql_num_rows($res)>0)//Si hay registros se abre archivos
		{    
			$lArcDelimiter = "|";
			$lArcId = fopen('php://memory', 'w');
			//$filename = "costos_cups_" . date('Y-m-d') . ".txt";
			$lArcNom = "FacturacionGeneral". date('Y-m-d') . ".txt";

			$lArcLinea=array("PREFIJO", 
			"#FACTURA", "ESTADO",  
			"CUENTA DE COBRO", "FECHA_CIERRE", "FECHA_INICIAL", 
			"FECHA_FINAL", "NIT", 
			"ENTIDAD PAGADORA", "#IDENTIFICACION",  
			"Dx", "GRUPO", "CODIGO", 
			"DESCRIPCIO","CANTIDAD", "V_UNITARIO", 
			"TOTAL", "AREA", "COPAGO", 
			"DESCUENTO", "CUOTA MODERADORA", "FACTURA ANULADA", 
			"CLASE", "FACTURADOR" 
			);
			
			fputcsv($lArcId, $lArcLinea, $lArcDelimiter);
			
			while($rs = mysql_fetch_array($res)){
				$codigo_cont='';
				$clase='';
				$codigo='';
				$iden_tco = $rs['iden_tco'];
				if($rs['tipo_dfa']=='P'){
					$clase  = clase($rs['iden_fac'], $iden_tco, $link,$codigo,$codigo_cont);
					$grupo="Procedimientos";
				}
				if($rs['tipo_dfa']=='M'){
					$codigo=trae_medicamento($iden_tco,$rs['iden_fac'],$codigo_cont);
					$grupo="Medicamentos";
				}
				if($rs['tipo_dfa']=='I'){
					$codigo=trae_insumo($iden_tco,$rs['iden_fac'],$codigo_cont);
					$grupo="Insumos";
				}
				if($rs['esta_fac']=='1'){ $estado="Abierta";}else{$estado="Cerrada";}
				$factu  = BuscarFacturador($rs['usua_fac'], $link);
				$total = $rs['cant_dfa']* $rs['valu_dfa'];
				
				$lArcLinea=array($rs['pref_fac'], 
				$rs['nume_fac'], $estado, "", 
				$rs['rela_fac'], $rs['fcie_fac'], $rs['feci_fac'], 
				$rs['fecf_fac'], $rs['enti_fac'],  
				STR_REPLACE(CHR(10),"", STR_REPLACE(CHR(13),"", $rs['RESPONSABLE_PAGO'])), $rs['NROD_USU'], 
				$rs['cod_cie10'], $grupo, $codigo, 
				STR_REPLACE(CHR(10),"", STR_REPLACE(CHR(13),"", $rs['desc_dfa'])), $rs['cant_dfa'], $rs['valu_dfa'], 
				$total, STR_REPLACE(CHR(10),"", STR_REPLACE(CHR(13),"", $rs['SERVICIO'])), $rs['vcop_fac'], 
				$rs['pdes_fac'], $rs['cmod_fac'], $rs['anul_fac'], 
				$factu);
				
				fputcsv($lArcId, $lArcLinea, $lArcDelimiter);
						
			}
			
			//move back to beginning of file
			fseek($lArcId, 0);
			//set headers to download file rather than displayed
			header('Content-Type: text/csv');
			header('Content-Disposition: attachment; filename="' . $lArcNom . '";');
			//output all remaining data on a file pointer
			fpassthru($lArcId);
		}//Fin apertura archivo (Si tiene datos
	}
exit;	

?>