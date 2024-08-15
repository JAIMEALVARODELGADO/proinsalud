<?session_register('Gideusu');
session_register('Gcod_medico');?>

<html> 
<head> 
<title>INFORMACION USUARIOS *PROINSALUD* </title> 
 <script language='Javascript'>
function enviar()
{
	form1.action='ing_gases.php';
	form1.target='';
	form1.submit();
}

function imprimir(valor)
{
    //alert('toy');
	form1.evol.value=valor
	form1.action='../uci/imp_gases.php';
	form1.target='fr21';
	form1.submit();
}
	

</script>
</head> 
<body >
<form name="form1" method="POST"  action="adi_espe.php" target="fr2">  
<link rel="stylesheet" href="css/style.css" type="text/css" />
<?php
	

	include('php/funciones.php');
	include('php/conexion.php');
	base_proinsalud();
    //$cod_usu=$codiusua;
	//echo $nrod_usu.'<br>'. $contrato.'<br>'.$idcita.'<br>'.' MEDICO'.$msol_ref;
	$conusu=mysql_query("SELECT NROD_USU,CODI_CON,CODI_USU, PNOM_USU, SNOM_USU, PAPE_USU, SAPE_USU, FNAC_USU, SEXO_USU,
						   TPAF_USU,CONT_UCO,NEPS_CON,IDEN_UCO,CUSU_UCO 
						   FROM usuario, ucontrato,contrato 
						   WHERE CODI_USU=CUSU_UCO AND CONT_UCO=CODI_CON 
						   AND NROD_USU ='$nrod_usu' AND CODI_CON='$codi_con'"); 
       
	if(mysql_num_rows($conusu)<>0)
	{
			$rowu=mysql_fetch_array($conusu);
			$cod_usu=$rowu[CODI_USU];
		
			echo"<input type=hidden name=cod_usu value=$cod_usu>";
			echo"<input type=hidden name=codi_con value=$codi_con>";
			echo "<table class='Tbl0'>";
			echo "<tr><td class='Th0' width='15%'><strong>IDENTIFICACION</td>
			<td class='Th0' width='50%'><strong>NOMBRE</td>
			<td class='Th0' width='10%'><strong>EDAD</td>
			<td class='Th0' width='10%'><strong>SEXO</td>
			<td class='Th0' width='15%'><strong>CONTRATO</td></tr>";
		
		
			echo "<tr><td class='Td4'>$rowu[NROD_USU]</td>";
			$nombre= $rowu[PNOM_USU]." ".$rowu[SNOM_USU]." ".$rowu[PAPE_USU]." ".$rowu[SAPE_USU];
			echo"<td class='Td4'>$nombre</td>";
			$edad=calculaedad($rowu['FNAC_USU']);
			echo"<td class='Td4'>$edad</td>
		    <td class='Td4'>$rowu[SEXO_USU]</td>
		    <td class='Td4'>$rowu[NEPS_CON]</td></tr></table>";

		
	   echo"<table class='Tbl0'>
		<tr><td class='Td1' align='center' border=2><STRONG>REPORTE E INGRESO DE GASES ARTERIALES</strong></td></tr>
		</table>";

		echo"<table class='Tbl0'><tr>
		<td bgcolor=#BED1DB align='center' ><b>OPC</td>
		<td bgcolor=#BED1DB align='center'><b>FECHA DE REALIZACION</span></td>
		<td bgcolor=#BED1DB align='center'><b>REPORTADO</span></td></tr>"; 
	   
	   $cons=mysql_Query("SELECT  `iden_gas`, `fech_gas`, `codi_usu`, `codi_gas`,`iden_evo` ,`resu_gas`, `obse_gas`, `resp_gas`, `esta_gas`
            FROM `datos_garteriales` WHERE codi_usu='$cod_usu' AND esta_gas='AC' GROUP BY `iden_evo` ");
            //echo $cons;
            $m=0;
            //$cuan=mysql_num_rows($cons);

            if(mysql_num_rows($cons)<>0)
            {
                    while($rowgas = mysql_fetch_array($cons))
                    {
                        $cuan=$rowgas[iden_gas];
                        $fech_gas=$rowgas[fech_gas];
                        $resp_gas=$rowgas[resp_gas];
						$iden_evo=$rowgas[iden_evo];
						$codi_usu=$rowgas[codi_usu];
						echo"<input type=hidden name=cod_usu value='$codi_usu'>";
						echo"<input type=hidden name=iden_evo value='$iden_evo'>";
						

                        echo"<tr>";
                        echo"<td height=15 class='Td3'><a href='#' onclick=\"imprimir($iden_evo)\"><img name='$nomvar' src='img/feed_magnify.png' border='0' alt='Imprimir' heigth=17 width=17></a>";
                        //echo"<td align='center' class='Td2'>$cuan</td>";
                        echo"<td align='center' class='Td2'>$fech_gas</td>";
						$con_usu=mysql_query("SELECT ced_medi, nom_medi FROM medicos WHERE cod_medi='$resp_gas'");
						$rowus = mysql_fetch_array($con_usu);
						$repo=$rowus[nom_medi];
                        echo"<td align='center'>$repo</td>";
                        echo "</tr>";

                    $m++;
                    }	
                }
		
			echo "<input type=hidden name=evol>";
	 

		echo"</table>";
	}		
	else
		{
			echo "<p align='center'><b>El usuario no tiene Reportes</p>";
			
			
		}		
		



	
	
			
			
?>
	
</form>
</body>
</html>
