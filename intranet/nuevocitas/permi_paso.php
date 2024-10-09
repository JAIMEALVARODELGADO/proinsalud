<?
	session_start();
    $usucitas=$_SESSION['usucitas'];

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>

<script language="javascript">
	function salir()
	{		
		alert("YA ESTA");
		uno.action='permi_usua0.php';
		uno.target='';
		//uno.submit();	
	}		
</script>
</head>
<body onload='salir()'>
<?	
    foreach($_POST as $nombre_campo => $valor)
	{ 
	   $asignacion = "\$" . $nombre_campo . "='" . $valor . "';"; 
	   eval($asignacion); 
	} 
	set_time_limit (300);
	
    include ('php/conexion1.php');
    echo"<form name=uno method=post>	
	<input type=hidden name='nomemple' value='$nomemple'></td>
    <input type='hidden' name='emple' value='$emple'> 
    <input type=hidden name=areatra value='$areatra'>";
	$n=0;
	$m=0;
	$p=0;
	$are='1000000';
	echo"<table>";
	if(!empty($emple) && !empty($areatra))        
    {		
		$busca=mysql_query("SELECT areas.cod_areas, areas.nom_areas, contrato.CODI_CON, contrato.NEPS_CON, permisos_citas.iden_per, permisos_citascon.iden_pco, permisos_citas.esta_per, permisos_citascon.esta_pco, permisos_citascon.cidi_pco, permisos_citas.tipo_per
		FROM areas INNER JOIN ((permisos_citas INNER JOIN permisos_citascon ON permisos_citas.iden_per = permisos_citascon.iden_per) RIGHT JOIN contrato ON permisos_citascon.cont_pco = contrato.CODI_CON) ON areas.cod_areas = permisos_citas.serv_per
		WHERE (((areas.arci_area)='$areatra') AND ((permisos_citas.usua_per)='$emple') AND ((contrato.ESTA_CON)='A'))
		ORDER BY areas.nom_areas, contrato.NEPS_CON");
		while($row=mysql_fetch_array($busca))
		{
			
			$codar=$row['cod_areas'];
			$nomar=$row['nom_areas'];
			$codcon=$row['CODI_CON'];
			$nomcon=$row['NEPS_CON'];			
			$estapermi=$row['esta_per'];
			$estacon=$row['esta_pco'];
			$cidicon=$row['cidi_pco'];
			$tipoper=$row['tipo_per'];
			$idenper=$row['iden_per'];
			$idenpco=$row['iden_pco'];
			if($are!=$codar)
			{
				if($p!=0)				
				{
					$vecarea[$n][5]=$m;
					/*
					$nomvar='finm'.$n;
					echo"<input type=hidden name=$nomvar value='$m'>";
					*/
					$m=0;
					$n++;				
				}
				/*
				echo"
				<tr>
				<td>$nomar</td>
				<td></td>
				</tr>";
				*/
				/*				
				$vecarea[$n][0]=$codar;		//areas.cod_areas
				$vecarea[$n][1]=$nomar;		//areas.nom_areas
				$vecarea[$n][2]=$tipoper;	//permisos_citas.tipo_per
				$vecarea[$n][3]=$idenper;	//permisos_citas.iden_per
				*/
				$nomvar='codar'.$n;
				echo"<input type=hidden name=$nomvar value='$codar'>";	//areas.cod_areas
				$nomvar='nomar'.$n;
				echo"<input type=hidden name=$nomvar value='$nomar'>";	//areas.nom_areas
				$nomvar='tipoper'.$n;
				echo"<input type=hidden name=$nomvar value='$tipoper'>";	//permisos_citas.tipo_per
				$nomvar='idenper'.$n;
				echo"<input type=hidden name=$nomvar value='$idenper'>";	//permisos_citas.iden_per
				$m=0;				
				$are=$codar;	
							
			}
			/*
			echo"
			<tr>
			<td></td>
			<td>$nomcon</td>
			</tr>";
			*/	
			/*
			$vecontra[$n][$m][0]=$idenpco;	//permisos_citascon.iden_pco
			$vecontra[$n][$m][1]=$codcon;	//contratos.CODI_CON
			$vecontra[$n][$m][2]=$nomcon;	//contratos.NEPS_CON
			$vecontra[$n][$m][3]=$estacon;	//permisos_citascon.esta_pco
			$vecontra[$n][$m][3]=$cidicon;	//permisos_citascon.cidi_pco
			*/
			/*
			$nomvar='idenpco'.$n.'A'.$m;
			echo"<input type=hidden name=$nomvar value='$idenpco'>";	//permisos_citascon.iden_pco			
			$nomvar='codcon'.$n.'A'.$m;			
			echo"<input type=hidden name=$nomvar value='$codcon'>";		//contratos.CODI_CON				
			$nomvar='nomcon'.$n.'A'.$m;				
			echo"<input type=hidden name=$nomvar value='$nomcon'>";		//contratos.NEPS_CON			
			$nomvar='estacon'.$n.'A'.$m;			
			echo"<input type=hidden name=$nomvar value='$estacon'>";	//permisos_citascon.esta_pco			
			$nomvar='cidicon'.$n.'A'.$m;
			echo"<input type=hidden name=$nomvar value='$cidicon'>";	//permisos_citascon.cidi_pco
			*/
			
			$nomvar1='idenpco'.$n.'A'.$m;
			echo"<input type=hidden name=$nomvar value='A'>";	//permisos_citascon.iden_pco			
			$nomvar1='codcon'.$n.'A'.$m;			
			echo"<input type=hidden name=$nomvar value='B>";		//contratos.CODI_CON				
			$nomvar1='nomcon'.$n.'A'.$m;				
			echo"<input type=hidden name=$nomvar value='C'>";		//contratos.NEPS_CON			
			$nomvar1='estacon'.$n.'A'.$m;			
			echo"<input type=hidden name=$nomvar value='D'>";	//permisos_citascon.esta_pco			
			$nomvar1='cidicon'.$n.'A'.$m;
			echo"<input type=hidden name=$nomvar value='E'>";	//permisos_citascon.cidi_pco
			
			$m++;
			$p++;				
		}
		echo $n.' ';
			
	}
	echo '<br> final '.$n;
	echo"<input type='hidden' name='finn' value='$n'>";
	echo"</form>";
	//$_SESSION['vecarea']=$vecarea;
	//$_SESSION['vecontra']=$vecontra;
?>
</body>
</html>

