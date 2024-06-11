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
		$res = mysql_query($sql);
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
	?>
<html>
<head>
<title></title>
<link rel="stylesheet" type="text/css" media="all" href="../js/calendar/calendar-blue.css" title="win2k-cold-1" /> 
	<script type="text/javascript" src="../js/calendar/calendar.js"></script> 
	<script type="text/javascript" src="../js/calendar/lang/calendar-es.js"></script> 
	<script type="text/javascript" src="../js/calendar/calendar-setup.js"></script> 
	<script type="text/javascript">
	function ejecutarConsulta()
	{
		var miForm = document.forms[0];
		miForm.band.value = 1;
		miForm.method = "POST";
		miForm.action = "<? echo $_SERVER['PHP_SELF']; ?>"; 
		miForm.submit();
		
	}
	
	function fPlanoMovimientos()
	{
		var miForm = document.forms[0];
		miForm.band.value = 1;
		miForm.method = "POST";
		miForm.action = "facturacion_archivo.php"; 
		miForm.submit();
		
	}
	</script>
</head>
<body>
<form name='frm_fact' method='POST'>
<?php

//$link=conectar();

echo "<table border='0' name='tbl_fecRegistro' id='tbl_entreFechas' width='100%' style='display: block;margin-top:15px;'>
        <tr>
            <td style='width:25%;text-align:right'>Fecha Inicio (De inicio de facturacion)</td>
            <td class='izquierda'>
                <input type='date' name='fechaInicio' id='fechaInicio' value='$fechaInicio' size='8'/>
                <!--<input type='button' value='...' alt='Calendario' id='lnzfechaInicio'>
                <script type='text/javascript'> 
                    Calendar.setup({ 
                    inputField     :    'fechaInicio',     // id del campo de texto 
                    ifFormat     :     '%Y-%m-%d',   // formato de la fecha que se escriba en el campo de texto 
                    button     :    'lnzfechaInicio'     // el id del botón que lanzará el calendario 				
                    }); 
                </script>-->
            </td>
            <td style='width:25%;text-align:right'>Fecha Fin (De inicio de facturacion)</td>
            <td>
                <input type='date' name='fechaFin' id='fechaFin' value='$fechaFin' size='8'/>
                <!--<input type='button' value='...' alt='Calendario' id='lnzfechaFin'>
                <script type='text/javascript'> 
                    Calendar.setup({ 
                    inputField     :    'fechaFin',     // id del campo de texto 
                    ifFormat     :     '%Y-%m-%d',   // formato de la fecha que se escriba en el campo de texto 
                    button     :    'lnzfechaFin'     // el id del botón que lanzará el calendario 				
                    }); 
                </script>-->
            </td>
        </tr>


		<tr>
			<td colspan='2' align='center'><input type='button' value='EJECUTAR CONSULTA' onclick='ejecutarConsulta()'></td>
        	<td align='center'><input type='button' value='EXPORTAR ARCHIVO PLANO' onclick='fPlanoMovimientos()'></td>
		</tr>
  </table>";
echo "<input type='hidden' name='band' value=''>";
	
	//informe_entreFechas($fechaInicio, $fechaFin);
        
	if(isset($_POST['band']))
	{
        $condicion="esta_fac <> '3' and ";
        if(!empty($fechaInicio)){
            $condicion=$condicion."(feci_fac Between '$fechaInicio' And '$fechaFin') and ";
        }
        if(!empty($fechacierreInicio)){
            $condicion=$condicion."(fcie_fac Between '$fechacierreInicio' And '$fechacierreFin') and ";
        }
        if(!empty($prefijo)){
        	$condicion=$condicion."pref_fac='$prefijo' and ";	
        }
        if(!empty($entidad)){
        	$condicion=$condicion."enti_fac='$entidad' and ";	
        }
        $condicion=SUBSTR($condicion,0,STRLEN($condicion)-5);
    
	$sql = "SELECT iden_dfa,iden_fac, nume_fac, fcie_fac, codi_con, rela_fac, enti_fac, anul_fac, esta_fac, feci_fac, fecf_fac, NEPS_CON,RESPONSABLE_PAGO, cod_cie10, NROD_USU, PNOM_USU, SNOM_USU, PAPE_USU, SAPE_USU, FNAC_USU, desc_dfa, cant_dfa, iden_tco, valu_dfa, vcop_fac, pdes_fac, cmod_fac, usua_fac, SERVICIO, cod_medi,tipo_dfa, nom_medi,FLOOR( DATEDIFF( fcie_fac , FNAC_USU ) / 365.25 ) AS edad,servicio_det,pref_fac
		FROM  vista_detalle_factura
		WHERE $condicion";
	
	//echo "<br>".$sql;
	echo "<br>";
	//$res = mysql_query($sql,$link);	
	$res = mysql_query($sql);	
	echo "INFORME DE FACTURACION <hr/>
	Fecha Inicio(De inicio de facturacion): $fechaInicio<br/>
	Fecha Fin(De inicio de facturacion): $fechaFin<br/>
	Numero de Registros: " .mysql_num_rows($res);
	echo "<br>";
        
    
	if(mysql_num_rows($res)>0)
	{    
		echo "<table border='1' style='font-size:8px'>";
		echo "<tr>";
		echo "<th>PREFIJO</th>"; 
		echo "<th>#FACTURA</th>"; 
        echo "<th>ESTADO</th>"; 
		echo "<th>CUENTA DE COBRO</th>"; 
		echo "<th>FECHA_CIERRE</th>"; 
        echo "<th>FECHA_INICIAL</th>"; 
        echo "<th>FECHA_FINAL</th>"; 
		echo "<th>NIT</th>"; 
		echo "<th>ENTIDAD PAGADORA</th>"; 
		echo "<th>#IDENTIFICACION</th>"; 
        echo "<th>Dx</th>"; 
        echo "<th>GRUPO</th>";  
        echo "<th>CODIGO</th>";  
		echo "<th>DESC. PROC</th>"; 
		echo "<th>CANTIDAD</th>"; 
		echo "<th>VLR UNIT</th>"; 
		echo "<th>TOTAL</th>"; 
		echo "<th>AREA</th>"; 
		echo "<th>COPAGO</th>"; 
		echo "<th>DESCUENTO</th>"; 
		echo "<th>CUOTA MODERADORA</th>"; 
		echo "<th>FACTURA ANULADA</th>"; 		
		echo "<th>CLASE</th>";  
		echo "<th>FACTURADOR</th>";  
		echo "<th>IDEN_DFA</th>";  
		echo "</tr>";  
		$excel=$excel."FAC,ESTADO,MES,CUENTA DE COBRO,FEC. CIERRE,FEC. INIC,FEC. FINAL,NIT,CONTRATO,ENTIDAD PAGADORA,IDENTIFICACION,FNACIMIENTO,EDAD,Dx,CODIGO,DESC. PROC,CANTIDAD,VLR UNIT,TOTAL,AREA,COPAGO,DESCUENTO,CUOTA MODERADORA,FACTURA ANULADA,SERVICIO,CLASE,FACTURADOR,CUENTA,COD_MEDIC,NOMB_MEDICL\n";
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

                    echo "<tr>";
                    echo "<td>" . $rs['pref_fac'] . "</td>"; 
                    echo "<td>" . $rs['nume_fac'] . "</td>"; 
					echo "<td>" . $estado . "</td>"; 
                    echo "<td>" . $rs['rela_fac'] . "</td>"; 
                    echo "<td>" . $rs['fcie_fac'] . "</td>"; 
                    echo "<td>" . $rs['feci_fac'] . "</td>"; 
                    echo "<td>" . $rs['fecf_fac'] . "</td>"; 
                    echo "<td>" . $rs['enti_fac'] . "</td>"; 
                    echo "<td>" . $rs['RESPONSABLE_PAGO'] . "</td>";                      
                    echo "<td>" . $rs['NROD_USU'] . "</td>"; 
                    echo "<td>" . $rs['cod_cie10'] . "</td>";  
                    echo "<td>" . $grupo. "</td>"; 
                    echo "<td>" . $codigo. "</td>"; 
                    echo "<td>" . $rs['desc_dfa'] . "</td>"; 
                    echo "<td>" . $rs['cant_dfa'] . "</td>";  
                    echo "<td>" . $rs['valu_dfa'] . "</td>";  
                    $total = $rs['cant_dfa']* $rs['valu_dfa'];  
                    echo "<td>" . $total . "</td>"; 
                    echo "<td>" . $rs['SERVICIO']. "</td>"; 
                    //copago
                    echo "<td>" . $rs['vcop_fac']. "</td>"; 
                    //descuento
                    echo "<td>" . $rs['pdes_fac']. "</td>"; 
                    //cuota moderadora
                    echo "<td>" . $rs['cmod_fac']. "</td>"; 
                    echo "<td>" . $rs['anul_fac']. "</td>";                                                     
                    echo "<td>" . $clase . " </td>"; 
                    //facturador			
                    echo "<td>" . $factu . "</td>"; 
					echo "<td>" . $rs['iden_dfa'] . "</td>"; 
                    echo "</tr>";
                    
                    
		}
		echo "</table>";
                /*$scarpeta=""; //carpeta donde guardar el archivo. 
                //debe tener permisos 775 por lo menos 
                $sfile="../planos/informefac".$Giden_usu.".csv"; //ruta del archivo a generar 
                $fp=fopen($sfile,"w"); 
                fwrite($fp,$excel); 
                fclose($fp);
                echo "<br><center><b><a href='".$sfile."'><img width=20 height=20 src='../images/excel.jpg' alt='Generar Archivo' border=0>Exportar</a></center>";
				*/
	}
	}
		

?>
</form>
</body>
</html>