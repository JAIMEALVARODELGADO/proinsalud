<?
session_register('iden_pac');
	//session_register('enti_pac');
	if(!empty($iden)){$iden_pac=$iden;}
	//if(!empty($enti)){$enti_pac=$enti;}
	//echo"$iden";
	echo"$iden_pac";
	echo"$enti";
?>
<html>
<head>
<title>PROGRAMA DE FACTURACIÓN - PROFACTU</title>
<SCRIPT LANGUAGE=JavaScript>
	function comprobar()
	{
		form1.submit()
	}
</script>
<link rel="stylesheet" href="css/style.css" type="text/css" />
</head>

<form name="form1" method="POST" action="fac_2inicio.php" target='fr01'>
<body lang=ES  style='tab-interval:35.4pt'  >
<table class="Tbl0"><tr><td class="Td0" align='center'>INFORMACION DEL USUARIO</td></tr></table><br>
<?include('php/conexion.php');?>
<center><table class="Tbl0" border=1>
	<tr>
	  <?
		$consulta=mysql_query("SELECT NROD_USU,CODI_CON,CODI_USU, PNOM_USU, SNOM_USU, PAPE_USU, SAPE_USU, FNAC_USU, SEXO_USU,TPAF_USU,MATE_USU,CONT_UCO,NEPS_CON,IDEN_UCO,MRES_USU FROM usuario, ucontrato,contrato WHERE CODI_USU=CUSU_UCO AND CONT_UCO=CODI_CON AND CONT_UCO='$enti' AND NROD_USU = '$iden_pac'");
		if(mysql_num_rows($consulta)!=0)
		{
			while ($row = mysql_fetch_array($consulta))			
			{			
				echo "<tr>
				<td class='Td2' align='left'>Identificacion:
				$row[NROD_USU]<input name=NROD_USU  type=hidden  value=$rowx[NROD_USU] size='12' maxlength='12'></td>";
				echo"<td class='Td2' align='left'>Nombre:";
				$nombre=$row[PNOM_USU].$row[SNOM_USU].$row[PAPE_USU].$row[SAPE_USU];
				ECHO"$nombre<input name=NROD_USU  type=hidden  value=$rowx[NROD_USU] size='12' maxlength='12'></td>";
			}
		}
	  ?>
	</tr>
</table></center>
</form>
</body>
</html>
