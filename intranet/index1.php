<?
//session_start();
?>
<html>
<style type="text/css"> 
<!-- 
SELECT 
{ 
font-family: Verdana, Arial, Helvetica, sans-serif; 
font-size: 9px; 
background-color: #F5F5F5; 
color: #000000; 
} 
--> 

</style>
<head>
  <title>FONDO</title>
  <script language="JavaScript">
	function salto(n)
	{		
		if(n==1)
		{
			if(form1.clave.value!='' && form1.usuario.value!='')
			{
				form1.target='';
				form1.action='index1.php';
				form1.submit();	
			}
		}
		if(n==2)
		{
			if (event.keyCode == 13 || event.keyCode == 9)
			{
				if(form1.clave.value!='' && form1.usuario.value!='')
				{
					form1.target='';
					form1.action='index1.php';
					form1.submit();	
				}
			}
		}		
	}
	function salir()
	{		
		form1.target='';
		form1.action='index2.php';
		form1.submit();	
	}
	function foco()
	{
		
		if(form1.clave.value=='')form1.clave.focus();		
		if(form1.usuario.value=='')form1.usuario.focus();	
		
	}
	function foco()
	{
		if(form1.nresa.value>0)
		{
			form1.destino.focus();
			if(form1.abrearea.value==1)
			{
				form1.abrearea.focus();			
			}
		}
		if(form1.boton.value=='1')
		{
			form1.bt1.focus();
		}
		if(form1.boton.value=='2')
		{
			form1.bt2.focus();
		}
		if(form1.boton.value=='3')
		{
			form1.bt3.focus();
		}
	}
	
</script>

</head>

<body bgcolor="#FFFFFF" onload=foco()>
<? echo "<font size=1>$ip</font>";?>
<p>
<p>
<br>
<br>
<br>
<center>
	<form name="form1" method="post" action="index2.php">
	<table border="0" cellspacing="0" cellpadding="0" width="763" height="360">
	<tr align="left" valign="top">
	<td rowspan="1" colspan="1" height="1" width="1"></td>
	<td rowspan="1" colspan="1" height="1" width="456"></td>
	<td rowspan="1" colspan="1" height="1" width="113"></td>
	<td rowspan="1" colspan="1" height="1" width="181"></td>
	<td rowspan="1" colspan="1" height="1" width="12"></td>
	</tr>

	<tr align="left" valign="top">
	<td rowspan="1" colspan="1" width="1" height="133"></td>
	<td rowspan="8" colspan="1" width="456" height="359"><img border="0" width="456" height="359" src="Imagenes/FONDOR1C1.jpg" alt=""></td>
	<td rowspan="1" colspan="2" width="294" height="133"><img border="0" width="294" height="133" src="Imagenes/FONDOR1C2.jpg" alt=""></td>
	<td rowspan="8" colspan="1" width="12" height="359"><img border="0" width="12" height="359" src="Imagenes/FONDOR1C4.jpg" alt=""></td>
	</tr>  
  
  
	<?
	echo"
	<tr align='left' valign='top'>
    <td rowspan='1' colspan='1' width='1' height='29'></td>
    <td rowspan='1' colspan='1' width='113' height='29' background='Imagenes/FONDOR2C2.jpg'><FONT FACE='Arial Black' COLOR='#003399'>Usuario:</font></td>
    <td rowspan='1' colspan='1' width='181' height='29' background='Imagenes/FONDOR2C3.jpg'>
	<input type=text name='usuario' size=20 maxlength=20 onkeypress='salto(2)' onblur='salto(1)' value='$usuario'></td>
	</tr>
		
	<tr align='left' valign='top'>
    <td rowspan='1' colspan='1' width='1' height='29'></td>
    <td rowspan='1' colspan='1' width='113' height='29' background='Imagenes/FONDOR3C2.jpg'><FONT FACE='Arial Black' COLOR='#003399' >Contraseña:</font></td>
    <td rowspan='1' colspan='1' width='181' height='29' background='Imagenes/FONDOR3C3.jpg'><input type=password name='clave' size=20 maxlength=20 onkeypress='salto(2)' onblur='salto(1)' value='$clave'></td>
	</tr>";
		
	//mysql_connect("localhost","root","");
	mysql_connect("192.168.4.12","root","");
	mysql_select_db("general");	
	$cla=md5($clave);	
	$pas=substr($cla,0,12);
	$busu=mysql_query("select * from cut where cut.login_usua='$usuario' AND cut.pass_usua='$pas'");
	//ECHO "select * from cut where cut.login_usua='$usuario' AND cut.pass_usua='$pas'";
	
	$rusu=mysql_fetch_array($busu);
	$codiusu=$rusu['ide_usua'];
	$sSQL = "SELECT desarrollo.nomb_apli, desarrollo.cod_apli
	FROM cut INNER JOIN (desarrollo INNER JOIN aplicacion ON desarrollo.cod_apli = aplicacion.cod_apli) ON cut.ide_usua = aplicacion.id_usu
	WHERE (((cut.login_usua)='$usuario') AND ((cut.pass_usua)='$pas'))
	GROUP BY desarrollo.nomb_apli, desarrollo.cod_apli
	ORDER BY desarrollo.nomb_apli";
	//echo $sSQL;
	$result=mysql_query($sSQL);
	$nres=mysql_num_rows($result);
	echo"<input type=hidden name=nresa value='$nres'>";
	$habil='';
	$bot='0';
	//echo $nres;
	
	//echo $nres;
	
	if($nres==0)$habil='disabled';
	
	//{
		
		echo"<tr align='left' valign='top'>		
		<td rowspan='1' colspan='1' width='1' height='30'></td>
		<td rowspan='1' colspan='1' width='113' height='30' background='Imagenes/FONDOR4C2.jpg'><FONT FACE='Arial Black' COLOR='#003399'>Aplicación:</font></td>
		<td rowspan='1' colspan='1' width='181' height='30' background='Imagenes/FONDOR4C3.jpg'>";
		echo "<select name='destino' $habil  onchange='salto(1)'>";
		echo '<option value="">--------'; 
		while ($row=mysql_fetch_array($result))
		{
			$capli=$row['cod_apli'];
			$napli=$row['nomb_apli'];
			if($capli==$destino)echo "<option selected value='$capli'>$napli</option>";
			else echo "<option value='$capli'>$napli</option>";
		}
		echo"
		</select></td>   
		</td>
		</tr>";
		if(empty($destino))$abrearea=0;
		else $abrearea=1;
		echo"<input type=hidden name=abrearea value='$abrearea'>";
	//ECHO $codiusu;
		if(!empty($destino))
		{			
			mysql_select_db("proinsalud");
			$conauditor="SELECT id_auditor FROM usuario_auditor WHERE ide_usua='$codiusu'";
			
			$conauditor=mysql_query($conauditor);
			if(mysql_num_rows($conauditor)<>0){
				echo "<input type='hidden' name='auditor' value='$codiusu'>";
			}

			//if($destino=='38' || $destino=='51' || $destino=='27')
			//echo $destino;
			if($destino=='38' || $destino=='51' || $destino=='52' || $destino=='53' || $destino=='27' || $destino=='58' || $destino=='59' || $destino=='60' || $destino=='74')
			{
				//con area obligatoria
				
				echo"
				<tr align='left' valign='top'>
				<td rowspan='1' colspan='1' width='1' height='32'></td>
				<td rowspan='1' colspan='1' width='113' height='32' background='Imagenes/FONDOR5C2.jpg'><FONT FACE='Arial Black' COLOR='#003399'>Area:</font></td>
				<td rowspan='1' colspan='1' width='181' height='32'background='Imagenes/FONDOR5C3.jpg'>";
				$sSQL="SELECT areas.cod_areas, areas.nom_areas
				FROM areas INNER JOIN areas_medic ON areas.cod_areas = areas_medic.areas_ar
				WHERE (((areas_medic.cod_med_ar)='$codiusu')) AND areas_medic.esta_ar='A'
				GROUP BY areas.cod_areas, areas.nom_areas";
				
				
				
				//echo $sSQL;
				
				$result=mysql_query($sSQL);
				echo "<select name='area' onchange='salto(1)'>";
				//Generamos el menu desplegable
				echo "<option >--------</option>"; 				
				while ($row1=mysql_fetch_array($result))
				{
					$cd=$row1['cod_areas'];
					$nm=$row1['nom_areas'];
					if($cd==$area)echo "<option selected value='$cd'>$nm</option>";
					else echo "<option value='$cd'>$nm</option>";
				}
				echo"</select>
				</td>
				</tr>
				";
				if(!empty($area))
				{					
					$bot='1';
					echo"
					<tr align='left' valign='top'>
					<td rowspan='1' colspan='1' width='1' height='31'></td>
					<td rowspan='1' colspan='1' width='113' height='31' background='Imagenes/FONDOR6C2.jpg'></td>
					<td rowspan='1' colspan='1' width='181' height='31' background='Imagenes/FONDOR6C3.jpg'><input type=button name='bt1' value='Aceptar' onclick='salir()' ></td>
					</tr>";
				}
				else
				{					
					echo"
					<tr align='left' valign='top'>
					<td rowspan='1' colspan='1' width='1' height='31'></td>
					<td rowspan='1' colspan='1' width='113' height='31' background='Imagenes/FONDOR6C2.jpg'></td>
					<td rowspan='1' colspan='1' width='181' height='31' background='Imagenes/FONDOR6C3.jpg'></td>
					</tr>";
				}
				
			}
			else if($destino=='50' || $destino=='41')
			{
				//con area no obligatoria
				echo"
				<tr align='left' valign='top'>
				<td rowspan='1' colspan='1' width='1' height='32'></td>
				<td rowspan='1' colspan='1' width='113' height='32' background='Imagenes/FONDOR5C2.jpg'><FONT FACE='Arial Black' COLOR='#003399'>Area:</font></td>
				<td rowspan='1' colspan='1' width='181' height='32'background='Imagenes/FONDOR5C3.jpg'>";
				$sSQL="SELECT areas.cod_areas, areas.nom_areas
				FROM areas INNER JOIN areas_medic ON areas.cod_areas = areas_medic.areas_ar
				WHERE (((areas_medic.cod_med_ar)='$codiusu')) AND areas_medic.esta_ar='A'
				GROUP BY areas.cod_areas, areas.nom_areas";
				
				
				$result=mysql_query($sSQL);
				echo "<select name='area' onchange='salto(1)'>";
				//Generamos el menu desplegable
				echo "<option >--------</option>"; 				
				while ($row1=mysql_fetch_array($result))
				{
					$cd=$row1['cod_areas'];
					$nm=$row1['nom_areas'];
					if($cd==$area)echo "<option selected value='$cd'>$nm</option>";
					else echo "<option value='$cd'>$nm</option>";
				}
				echo"</select>
				</td>
				</tr>
				";
					
					$bot='1';
					echo"
					<tr align='left' valign='top'>
					<td rowspan='1' colspan='1' width='1' height='31'></td>
					<td rowspan='1' colspan='1' width='113' height='31' background='Imagenes/FONDOR6C2.jpg'></td>
					<td rowspan='1' colspan='1' width='181' height='31' background='Imagenes/FONDOR6C3.jpg'><input type=button name='bt1' value='Aceptar' onclick='salir()' ></td>
					</tr>";
				
			}
			
			//else if($destino=='41' || $destino=='17')
			else if($destino=='17')
			{				
				// con areas online
				echo"
				<tr align='left' valign='top'>
				<td rowspan='1' colspan='1' width='1' height='32'></td>
				<td rowspan='1' colspan='1' width='113' height='32' background='Imagenes/FONDOR5C2.jpg'><FONT FACE='Arial Black' COLOR='#003399'>Area:</font></td>
				<td rowspan='1' colspan='1' width='181' height='32'background='Imagenes/FONDOR5C3.jpg'>";
				$sSQL="SELECT areas.nom_areas, area_online.care_line FROM area_online INNER JOIN areas ON area_online.care_line = areas.cod_areas;";
				//echo $sSQL;
				$result=mysql_query($sSQL);
				echo "<select name='area' onchange='salto(1)'>";
				//Generamos el menu desplegable
				echo "<option >--------</option>"; 
				while ($row1=mysql_fetch_array($result))
				{
					$cd=$row1['care_line'];
					$nm=$row1['nom_areas'];
					if($cd==$area)echo "<option selected value='$cd'>$nm</option>";
					else echo "<option value='$cd'>$nm</option>";
				}
				echo"</select>
				</td>
				</tr>
				";			
				/*
				$sSQL="SELECT areas.nom_areas, area_online.care_line FROM area_online INNER JOIN areas ON area_online.care_line = areas.cod_areas;";
				$result=mysql_query($sSQL);
				echo "<select name='area'>";
				//Generamos el menu desplegable
				echo "<option >--------</option>"; 
				while ($row1=mysql_fetch_array($result))
				{
					$cd=$row1['care_line'];
					$nm=$row1['nom_areas'];
					echo "<option value='$cd'>$nm</option>";
				}
				echo"</select>";
				*/
				if(!empty($area))
				{					
					$bot='2';
					echo"
					<tr align='left' valign='top'>
					<td rowspan='1' colspan='1' width='1' height='31'></td>
					<td rowspan='1' colspan='1' width='113' height='31' background='Imagenes/FONDOR6C2.jpg'></td>
					<td rowspan='1' colspan='1' width='181' height='31' background='Imagenes/FONDOR6C3.jpg'><input type=button name='bt2' value='Aceptar' onclick='salir()' ></td>
					</tr>";
				}
				else
				{					
					echo"
					<tr align='left' valign='top'>
					<td rowspan='1' colspan='1' width='1' height='31'></td>
					<td rowspan='1' colspan='1' width='113' height='31' background='Imagenes/FONDOR6C2.jpg'></td>
					<td rowspan='1' colspan='1' width='181' height='31' background='Imagenes/FONDOR6C3.jpg'></td>
					</tr>";
				}
				
			}			
			else
			{
				echo"
				<tr align='left' valign='top'>
				<td rowspan='1' colspan='1' width='1' height='32'></td>
				<td rowspan='1' colspan='1' width='113' height='32' background='Imagenes/FONDOR5C2.jpg'><FONT FACE='Arial Black' COLOR='#003399'></font></td>
				<td rowspan='1' colspan='1' width='181' height='32'background='Imagenes/FONDOR5C3.jpg'>";
				$bot='3';
				echo"
				<tr align='left' valign='top'>
				<td rowspan='1' colspan='1' width='1' height='31'></td>
				<td rowspan='1' colspan='1' width='113' height='31' background='Imagenes/FONDOR6C2.jpg'></td>
				<td rowspan='1' colspan='1' width='181' height='31' background='Imagenes/FONDOR6C3.jpg'><input type=button name='bt3' value='Aceptar' onclick='salir()' ></td>
				</tr>";
			}
		}
		else
		{
			echo"
			<tr align='left' valign='top'>
			<td rowspan='1' colspan='1' width='1' height='32'></td>
			<td rowspan='1' colspan='1' width='113' height='32' background='Imagenes/FONDOR5C2.jpg'><FONT FACE='Arial Black' COLOR='#003399'></font></td>
			<td rowspan='1' colspan='1' width='181' height='32'background='Imagenes/FONDOR5C3.jpg'>			
			</td>
			</tr>
			<tr align='left' valign='top'>
			<td rowspan='1' colspan='1' width='1' height='31'></td>
			<td rowspan='1' colspan='1' width='113' height='31' background='Imagenes/FONDOR6C2.jpg'></td>
			<td rowspan='1' colspan='1' width='181' height='31' background='Imagenes/FONDOR6C3.jpg'></td>
			</tr>";
			
		}
	//}
	/*
	else
	{
		echo"<tr align='left' valign='top'>
		<td rowspan='1' colspan='1' width='1' height='30'></td>
		<td rowspan='1' colspan='1' width='113' height='30' background='Imagenes/FONDOR4C2.jpg'><FONT FACE='Arial Black' COLOR='#003399'></font></td>
		<td rowspan='1' colspan='1' width='181' height='30' background='Imagenes/FONDOR4C3.jpg'>		 
		</td>
		</tr>
	
		<tr align='left' valign='top'>
		<td rowspan='1' colspan='1' width='1' height='32'></td>
		<td rowspan='1' colspan='1' width='113' height='32' background='Imagenes/FONDOR5C2.jpg'><FONT FACE='Arial Black' COLOR='#003399'></font></td>
		<td rowspan='1' colspan='1' width='181' height='32'background='Imagenes/FONDOR5C3.jpg'>		
		</td>
		</tr>
		
		<tr align='left' valign='top'>
		<td rowspan='1' colspan='1' width='1' height='31'></td>
		<td rowspan='1' colspan='1' width='113' height='31' background='Imagenes/FONDOR6C2.jpg'></td>
		<td rowspan='1' colspan='1' width='181' height='31' background='Imagenes/FONDOR6C3.jpg'></td>
		</tr>";
	}
	*/
	echo"<input type=hidden name=boton value='$bot'>";
	
?>  
	<tr align="left" valign="top">
	<td rowspan="1" colspan="1" width="1" height="31"></td>
	<td rowspan="1" colspan="1" width="113" height="31"><img border="0" width="113" height="31" src="Imagenes/FONDOR7C2.jpg" alt=""></td>
	<td rowspan="1" colspan="1" width="181" height="31"><img border="0" width="181" height="31" src="Imagenes/FONDOR7C3.jpg" alt=""></td>
	</tr>
	<tr align="left" valign="top">
	<td rowspan="1" colspan="1" width="1" height="44"></td>
	<td rowspan="1" colspan="2" width="294" height="44"><img border="0" width="294" height="44" src="Imagenes/FONDOR8C2.jpg" alt=""></td>
	</tr>
</table>
</form>
</center>
</body>

</html>
