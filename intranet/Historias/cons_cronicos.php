<html> 
<head> 
<?	//Aqui cargo las funciones para php
	include("php/funciones.php");
?>
<title>INFORMACION USUARIOS *PROINSALUD* </title> 
<SCRIPT LANGUAGE=JavaScript>
function verificar(numhis,lab,med,i){
	
	form1.imp2.value=1;
	form1.numhisto.value=numhis;
	form1.lab.value=lab;
	form1.med.value=med;
	form1.frep.value=i;
	form1.his.value=1;
	//alert(med);
	//alert(form1.numhisto.value);
	form1.action="../cronicos/imprimir_.php";
	form1.target='fr021';
	form1.submit();
	}
	function editar(numhis,frep)
	{
		//alert(numhis);
		form1.numhisto.value=numhis;
		form1.frep.value=frep;
		form1.action="gformula.php";
		//form1.action="edi_formula.php";
		//form1.target='fr021';
		form1.submit();
	
	}
	function mirar(numhis,frep)
	{
		//alert(numhis);
		form1.numhisto.value=numhis;
		form1.frep.value=frep;
		form1.action="modi_his.php";
		//form1.action="edi_formula.php";
		//form1.target='fr021';
		form1.submit();
	
	}
</script>
</head> 
<body >
<form name="form1" method="POST"  action="adi_espe.php" target="fr2">  
<link rel="stylesheet" href="css/style.css" type="text/css" />
<?php

	//include('php/funciones.php');
	include('php/conexion.php');
        base_proinsalud();
	$cons=mysql_query("SELECT usuario.CODI_USU, usuario.NROD_USU, usuario.PNOM_USU, usuario.SNOM_USU, usuario.PAPE_USU, usuario.SAPE_USU, usuario.FNAC_USU, usuario.SEXO_USU, usuario.DIRE_USU, usuario.TRES_USU, usuario.TPAF_USU, contrato.CODI_CON, contrato.NEPS_CON
	FROM usuario
	INNER JOIN ucontrato ON usuario.CODI_USU = ucontrato.CUSU_UCO
	INNER JOIN contrato ON ucontrato.CONT_UCO = contrato.CODI_CON
	WHERE ((usuario.NROD_USU)='$cod_usu' AND contrato.CODI_CON=$codi_con)");
        //echo $cons;
	if(mysql_num_rows($cons)<>0)
	{
		while($rcrn=mysql_fetch_array($cons))
		{
			$codi=$rcrn['CODI_USU'];
			$cedu=$rcrn['NROD_USU'];
			$nombre=$rcrn['PNOM_USU'].' '.$rcrn['SNOM_USU'].' '.$rcrn['PAPE_USU'].' '.$rcrn['SAPE_USU'];
			$contrato=$rcrn['NEPS_CON'];
			$edad=$rcrn['FNAC_USU'];
			$edad=calculaedad($edad);
			$sexo=$rcrn['SEXO_USU'];

			echo"<br><br><br><table class='Tbl2' border=0>
				<tr bgcolor=#BED1DB align='center'>
				<td><b>$cedu</td>
				<td><b>$nombre</td>
				<td><b>$edad</td>
				<td><b>$contrato</td></tr>";
			echo"<tr><td colspan=5><font size=1 face=arial color=red><b>NOTA: En las Formulas entregadas no se pueden Adicionar Medicamentos</td></tr>";
		}				
		$cons=Mysql_query("SELECT enferm_cronicos.idef_crn,enferm_cronicos.hist_crn, enferm_cronicos.fenf_crn, encabesadoformula.nufo_efo, enferm_cronicos.iden_uco
		FROM (enferm_cronicos INNER JOIN encabesadoformula ON enferm_cronicos.hist_crn = encabesadoformula.numc_efo) 
		INNER JOIN encabesadohistoria ON enferm_cronicos.hist_crn = encabesadohistoria.numc_ehi
		WHERE enferm_cronicos.iden_uco='$codi' GROUP BY enferm_cronicos.hist_crn ORDER BY enferm_cronicos.fenf_crn");
		 
		 ECHO $cons;
	 
		echo"<table class='Tbl0'>
		<tr><td class='Td1' align='center'><STRONG>Historia y Formulacin De Cronicos </strong></td></tr>
		</table>";
		
		echo"<table class='Tbl0' border=0>
		  <tr>
		  <td class='Td1' align='center'><b>OPC</td>
		  <td class='Td1' align='left'><b>N Historia</span></td>
		  <td class='Td1' align='left'><b>FECHA DE REALIZACION</span></td>
		</tr>"; 
		
		$i=0;
		$lab=0;
		$med=0;
		while ($rowexa=mysql_fetch_array($cons))
		{
						 
			$numc_ehi=$rowexa['hist_crn'];
			$idef_crn=$rowexa['idef_crn'];
			//echo $idef_crn;
			$brem1=mysql_query("SELECT ayudasdiagnosticas.numc_adx, ayudasdiagnosticas.cant_adx 
			FROM ayudasdiagnosticas WHERE ayudasdiagnosticas.numc_adx='$numc_ehi' group by ayudasdiagnosticas.numc_adx");	
			if(mysql_num_rows($brem1)<>0)$lab=1;
			$bdrf=mysql_query("select * from medicamentosenv where numc_men='$numc_ehi' GROUP BY fref_med ");
			//echo $bdrf;
			if(mysql_num_rows($bdrf)>0)$frep=mysql_num_rows($bdrf);
			$bmed=mysql_query("select * from medicamentosenv where numc_men='$numc_ehi'");
			if(mysql_num_rows($bmed)>0)$nummed='SI';			
			if($nummed=="SI")
			{
				$cmed=mysql_query("select * from medicamentosenv where numc_men='$numc_ehi' GROUP BY fref_med");
				
				$e=0;
				while($rowmed=mysql_fetch_array($cmed))
				{
					$med=1;
					$fref_med=$rowmed[fref_med];
					$nomvar='fref'.$i.$e;
					echo"<input type=hidden name=$nomvar value='$fref_med'>";
					
					$esta_men=$rowmed[esta_men];
					$nomvar='esta_men'.$i.$e;
					
					echo"<input type=hidden name=$nomvar value='$esta_men'>";
					//echo $esta_men;
					
					
					$codi_mdi=$rowmed[codi_mdi];
					$nomvar='codi_'.$i.$e;
					echo"<input type=hidden name=$nomvar value='$codi_mdi'>";
			
					$ccie_men=$rowmed[ccie_men];
					$nomvar='ccie_'.$i.$e;
					echo"<input type=hidden name=$nomvar value='$ccie_men'>";
					$e++;
				}
					$nomvar='regi'.$i;
					echo"<input type=hidden name=$nomvar value='$e'>";
					
					echo " <tr><td align='center'>";	
					
					//echo $lab;
				
					
					//if($esta_men=='1401')
					//{
						//echo"<a href='#' onclick='mirar(\"$numc_ehi\",$frep)'><img src='icons/feed_edit.png' border=0 width=17 height=17 alt='Historia Clinica' ></a>  ";
						//echo"<a href='#' onclick='editar(\"$numc_ehi\",$frep)'><img src='icons/feed_add.png' border=0 width=17 height=17 alt='Adicionar' ></a>  ";
						//echo"<a href='#' onclick='verificar(\"$numc_ehi\",$lab,$med,$i)'><img src='icons/feed_magnify.png' border=0 width=17 height=17 alt='Imprimir'></a>  ";
				
					//}
				
					//else
					//{
						//echo"<a href='#' onclick='mirar(\"$numc_ehi\",$frep)'><img src='icons/feed_edit.png' border=0 width=17 height=17 alt='Historia Clinica' ></a>  ";
						echo"<a href='#' onclick='verificar(\"$numc_ehi\",$lab,$med,$i)'><img src='icons/feed_magnify.png' border=0 width=17 height=17 alt='Imprimir'></a>  ";
					//}			
					echo"<td align='center'>$numc_ehi</td><td align='left'>$fref_med</td></tr>";
					
				$i++;
				
				
			}
		echo"<input type=hidden name='total' value='$i'>";
		
	}
			
		
		
	}
		
	else
	{
		
		echo "<tr><td align='CENTER'><B>NO EXISTEN EXEMENES PARA LA ORDEN  O EL USUARIO </td></tr>";
		
	
	}
	echo "</table>";
	echo "<input type=hidden name=it>";
	echo "<input type=hidden name=mcu>";		
	echo"<input type=hidden name=numhisto>";
	echo"<input type=hidden name=med>";
	echo"<input type=hidden name=his>";
	echo"<input type=hidden name=frep>";
	echo"<input type=hidden name=lab>";
	echo"<input type=hidden name=imp2>";
	echo"<input type=hidden name=cod_usu value=$cod_usu>";
	echo"<input type=hidden name=codi_con value='$codi_con'>";
	echo"<input type=hidden name=fech_>";

	
	function calcuedad($fecha_nac)
    {
        //Esta funcion toma una fecha de nacimiento
        //desde una base de datos mysql
        //en formato aaaa/mm/dd y calcula la edad en nmeros enteros

        $dia=date("j");
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
			
			
?>
	
</form>
</body>
</html>