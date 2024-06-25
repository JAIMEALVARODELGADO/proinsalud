<?
session_start();
$usucitas=$_SESSION['usucitas'];  
foreach($_POST as $nombre_campo => $valor)
{ 
   $asignacion = "\$" . $nombre_campo . "='" . $valor . "';"; 
   eval($asignacion); 
} 
?>
<html>
<head>
<link rel="stylesheet" href="style.css" type="text/css"/>
<script language="javascript">
	function salto1()
	{		
		if (event.keyCode == 13)
        {
			uno.action='habilitaref0.php';
			uno.target='';
			uno.submit();
		}
	}		
	function salir()
	{		
		uno.action='habilitaref1.php';
		uno.target='';
		uno.submit();			
	}	
	function habilita(n)
	{		
		fp=uno.finparcial.value;
		val="uno.sel"+n+".checked";
		if(eval(val)==true)
		{
			nom="uno.nuevoesta"+n+".disabled=false";
			eval(nom);
			nom="uno.ncanti"+n+".disabled=false";
			eval(nom);
			if(n>=fp)
			{
				nom="uno.nservi"+n+".disabled=false";
				eval(nom);
			}
		}
		else
		{
			nom="uno.nuevoesta"+n+".disabled=true";
			eval(nom);
			nom="uno.ncanti"+n+".disabled=true";
			eval(nom);
			if(n>=fp)
			{
				nom="uno.nservi"+n+".disabled=true";
				eval(nom);
			}
		}				
	}		
</script>
</head>
<body>
<?	
    
	$dateh=date("Y-m-d");
	$hor= date("H:i:s");
    include ('php/conexion1.php');	
	echo"<form name=uno method=post>	
    
	<table class='tbl' align=center>
	<tr>
	<th>DOCUMENTO</th>
	<th><td align=center><input type=text name=cedula class='caja' onkeypress='salto1()' value='$cedula'></td>
	</tr>
	</table>
	<BR>";
	//echo $cedula;
	if(!empty($cedula))
	{
		
		
		
		$bus=mysql_query("SELECT usuario.NROD_USU, detareferencia.iden_dre, usuario.PNOM_USU, usuario.SNOM_USU, usuario.PAPE_USU, usuario.SAPE_USU, ucontrato.ESTA_UCO, referencia.fech_ref, detareferencia.alse_dre, detareferencia.marc_dre, detareferencia.cant_cit, detareferencia.cant_dre
		FROM (ucontrato INNER JOIN usuario ON ucontrato.CUSU_UCO = usuario.CODI_USU) INNER JOIN (referencia INNER JOIN detareferencia ON referencia.idre_ref = detareferencia.idre_dre) ON ucontrato.IDEN_UCO = referencia.cuco_ref
		WHERE (((usuario.NROD_USU)='$cedula') AND referencia.fech_ref>='2013-01-01')");
		
		
		$n=0;
		if(mysql_num_rows($bus)>0)
		{
			echo"
			<table class='tbl' align=center>
			<tr><th colspan=8>ORDENES INTERNAS</th></tr>
			<tr>
			<th>NUMERO</th>	
			<th>NOMBRE</th>	
			<th>ESTADO</th>	
			<th>FECHA</th>	
			<th>SERVICIO SOLICITADO</th>			
			<th>CANTIDAD</th>	
			<th>CAMBIAR ESTADO</th>
			<th>HABILITAR</th>
			</tr>";			
			while($res=mysql_fetch_array($bus))
			{
				$nombre=$res['PNOM_USU'].' '.$res['SNOM_USU'].' '.$res['PAPE_USU'].' '.$res['SAPE_USU'];
				$estapac=$res['ESTA_UCO'];
				$fecha=$res['fech_ref'];
				$alse=$res['alse_dre'];
				$estacit=$res['marc_dre'];
				$cant=$res['cant_dre'];
				$nomalse=$res['alse'];
				$nomestacit=$res['esci'];
				$numref=$res['iden_dre'];
				
				
				$valcita=0;
				$diasdif=verifica($fecha);
				if($diasdif>60)$valcita=0;
				
				
				$bser=mysql_query("select * from destipos where codi_des='$alse'");
				while($rser=mysql_fetch_array($bser))
				{
					$nomalse=$rser['nomb_des'];
				}
				$bod=mysql_query("select * from destipos where codi_des='$estacit'");
				while($rod=mysql_fetch_array($bod))
				{
					$nomestacit=$rod['nomb_des'];
				}					
				ECHO"
				<tr>
				<td align=center>$numref</td>
				<td>$nombre</td>	
				<td align=center>$estapac</td>	
				<td align=center>$fecha</td>	
				<td>$nomalse</td>";			
				
				$nomvar='ncanti'.$n;				
				echo"<td align=center><input type=text name=$nomvar disabled value=$cant></td>
				";
				$besta=mysql_query("select * from destipos where codt_des='14' order by nomb_des");
				$nomvar='numrefer'.$n;
				echo "<input type=hidden name=$nomvar value='$numref'>";
				$nomvar='nuevoesta'.$n;
				echo "<td><select name=$nomvar disabled>
				<option value='$estacit'>$nomestacit</option>
				<option value='1402'>Autorizada</option>
				</select>
				";
				
				$nomvar='sel'.$n;
				if($valcita==0)
				{
					if($estacit!='1401')echo"<td align=center><input type=checkbox name=$nomvar onclick='habilita($n)' value=1></td>";
					else "<td><input type=hidden name=$nomvar value=''></td>";
				}
				else
				{
					echo "<td><input type=hidden name=$nomvar value=''></td>";
				}
				echo"</td></tr>";	
				$n++;
			}
			echo"						
			<table>
			";			
		}
		echo"<input type=hidden name=finparcial value=$n>";
		echo "<BR><table class='tbl' align=center>
		<tr><th colspan=9>ORDENES INTERNAS</th></tr>
		<tr>
		<th>NUMERO</th>	
		<th>NOMBRE</th>	
		<th>ESTADO</th>	
		<th>FECHA</th>	
		<th>SERVICIO SOLICITADO</th>			
		<th>CANTIDAD</th>
		<th>CAMBIAR SERVICIO</th>		
		<th>CAMBIAR ESTADO</th>
		<th>HABILITAR</th>
		</tr>
		";
		$bref2=mysql_query("SELECT usuario.NROD_USU, usuario.PNOM_USU, usuario.SNOM_USU, usuario.PAPE_USU, usuario.SAPE_USU, referencia2.fech_rf2, ucontrato.CONT_UCO, ucontrato.ESTA_UCO, detareferencia.idre_dre, detareferencia.ccie_dre, detareferencia.desc_dre, detareferencia.codi_dre, detareferencia.cant_dre, detareferencia.marc_dre, detareferencia.numc_dre, detareferencia.tipo_dre, detareferencia.obsv_dre, detareferencia.iden_dre, detareferencia.modi_dre, detareferencia.alse_dre, detareferencia.tiso_dre, detareferencia.fina_dre, detareferencia.cita_dre, detareferencia.cant_cit
		FROM ((usuario INNER JOIN ucontrato ON usuario.CODI_USU = ucontrato.CUSU_UCO) INNER JOIN referencia2 ON ucontrato.IDEN_UCO = referencia2.cuco_rf2) INNER JOIN detareferencia ON referencia2.nume_rf2 = detareferencia.idre_dre
		WHERE (((usuario.NROD_USU)='$cedula') AND ((detareferencia.marc_dre)='1402' Or (detareferencia.marc_dre)='1406') AND referencia2.fech_rf2>='2013-01-01')");
		while($res1=mysql_fetch_array($bref2))
		{		
			$nombre=$res1['PNOM_USU'].' '.$res1['SNOM_USU'].' '.$res1['PAPE_USU'].' '.$res1['SAPE_USU'];
			$estapac=$res1['ESTA_UCO'];
			$fecha=$res1['fech_rf2'];
			$alse=$res1['tipo_dre'];		
			$estacit=$res1['marc_dre'];
			$cant=$res1['cant_dre'];		
			$nomestacit=$res1['esci'];
			$numref=$res1['iden_dre'];	
			
			$valcita=0;
			$diasdif=verifica($fecha);
			if($diasdif>60)$valcita=1;
			
			$bser=mysql_query("select * from destipos where codi_des='$alse'");
			while($rser=mysql_fetch_array($bser))
			{
				$nomalse=$rser['nomb_des'];
			}
			$bod=mysql_query("select * from destipos where codi_des='$estacit'");
			while($rod=mysql_fetch_array($bod))
			{
				$nomestacit=$rod['nomb_des'];
			}
	
			ECHO"
			<tr>
			<td align=center>$numref</td>
			<td>$nombre</td>	
			<td align=center>$estapac</td>	
			<td align=center>$fecha</td>				
			<td>$nomalse</td>";	
			$nomvar='ncanti'.$n;				
			echo"<td align=center><input type=text name=$nomvar disabled value=$cant></td>";
			$bnser=mysql_query("select * from destipos where codt_des='06'");
			$nomvar='nservi'.$n;
			echo"<td><select disabled name=$nomvar>";
			while($rnser=mysql_fetch_array($bnser))
			{
				$cns=$rnser['codi_des'];
				$nns=$rnser['nomb_des'];
				
				if($cns==$alse)echo"<option selected value='$cns'>$nns</option>";
				else echo"<option value='$cns'>$nns</option>";
			}				
			
			$besta=mysql_query("select * from destipos where codt_des='14' order by nomb_des");
			$nomvar='numrefer'.$n;
			echo "<input type=hidden name=$nomvar value='$numref'>";
			$nomvar='nuevoesta'.$n;
			echo "<td><select name=$nomvar disabled>
			<option value='$estacit'>$nomestacit</option>
			<option value='1402'>Autorizada</option>
			</select>
			";
			
			
			
			
			
			
			
			
			
			
			$nomvar='sel'.$n;
			if($valcita==0)
			{
				if($estacit!='1401')echo"<td align=center><input type=checkbox name=$nomvar onclick='habilita($n)' value=1></td>";
				else "<td><input type=hidden name=$nomvar value=''></td>";
			}
			else
			{
				echo "<td><input type=hidden name=$nomvar value=''></td>";
			}
			echo"</td></tr>";	
			$n++;
			
			
		}		
		echo"
		<input type=hidden name=final value=$n>
		</table>
		<br>
		<table align=center class='tbl'>
		<tr><th><INPUT type=button class='boton' name='bot1' value='ACEPTAR' onClick='salir();'></th></tr>	
		</table>";
	}
	echo"
	<form>
	";
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
?>