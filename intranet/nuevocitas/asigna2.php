<?
session_start();
$usucitas=$_SESSION['usucitas'];
$areatra=$_SESSION['areatra'];
?>
<html>
<head>
<link rel="stylesheet" href="style.css" type="text/css"/>
<script language="javascript">
	function salir()
	{		
		uno.action='asignapaso.php';
		uno.target='area';
		uno.submit();			
	}		
</script>
</head>
<?	
    //$codcontra
	//areas
	set_time_limit(300);
	if(empty($usucitas))
    {
        echo" <table align=center class='tbl'>
        <tr><th>POR SEGURIDAD SU SESION SE CERRO</th></tr>
        </table>";
        exit;
    }
	if($usucitas=='252525252525')
	{
		//echo 'mmmmm '.$codusu.' ';		
		//echo $areas.' ';
		$codcontra=substr($areas,0,3);
		$arelab=substr($areas,3,5);	
		$areas=substr($areas,3,5);		
		echo $areas.' '.$codcontra.' '.$arelab.' '.$numcon;
		exit();
	}
	else
	{
		include ('php/conexion1.php');
		$codcontra=substr($areas,0,3);
		$arelab=substr($areas,3,5);	
		$areas=substr($areas,3,5);	
		
		$bcon=mysql_query("select * from contrato where CODI_CON='$codcontra'");
		$numcon=mysql_num_rows($bcon);
		if($numcon==0 || $codcontra=='' || $codcontra=='0')
		{	
			echo" <table align=center class='tbl'>
			<tr><th>CITA NO ASIGNADA. POR FAVOR REINICIE LA APLICACION</th></tr>
			</table>";
			exit();		
		}
		$noguar=0;
		echo"<form name=uno method=post>";
		if(empty($usucitas))
		{
			echo" <table align=center class='tbl'>
			<tr><th>POR SEGURIDAD SU SESION SE CERRO</th></tr>
			</table>";
			exit();
		}
		$dateh=date("Y-m-d");
		foreach($_POST as $nombre_campo => $valor)
		{ 
		   $asignacion = "\$" . $nombre_campo . "='" . $valor . "';"; 
		   eval($asignacion); 
		} 	
		$hor=date("Y-m-d")." ". date("H").":".date("i").":".date("s");
		
		$horaope=date("H").":".date("i");
		if ($valusado=="0")
		{         
			$mensaje="CITA YA ASIGNADA";
			echo "mm";
			$noguar=1;
		}	
		else
		{
			
			
			
			
			$nose='0';			
			if($turxcita==1)
			{				
				$bnu1=mysql_query("SELECT Count(citas.id_cita) AS cuenta, horarios.ncita_horario, horarios.Usado_horario
				FROM horarios INNER JOIN citas ON horarios.ID_horario = citas.ID_horario
				WHERE (((citas.Clase_citas)<'6') AND ((horarios.ID_horario)='$seleccion'))
				GROUP BY horarios.ncita_horario, horarios.Usado_horario");
				while($rnu1=mysql_fetch_array($bnu1))
				{
					$nasigna1=$rnu1['cuenta'];
					$ncitahor1=$rnu1['ncita_horario'];
					$usado1=$rnu1['Usado_horario'];
					if($nasigna1>=$ncitahor1 || $usado1=='0')$nose='1';
				}			
			}
			if($turxcita==2)
			{
				$bnu2=mysql_query("SELECT Count(citas.id_cita) AS cuenta, horarios.ncita_horario, horarios.Usado_horario
				FROM horarios INNER JOIN citas ON horarios.ID_horario = citas.ID_horario
				WHERE (((citas.Clase_citas)<'6') AND ((horarios.ID_horario)='$seleccion'))
				GROUP BY horarios.ncita_horario, horarios.Usado_horario");
				while($rnu2=mysql_fetch_array($bnu2))
				{
					$nasigna2=$rnu2['cuenta'];
					$ncitahor2=$rnu2['ncita_horario'];
					$usado2=$rnu2['Usado_horario'];
					if($nasigna2>=$ncitahor2 || $usado2=='0')$nose='1';
				}
				$bnu3=mysql_query("SELECT Count(citas.id_cita) AS cuenta, horarios.ncita_horario, horarios.Usado_horario
				FROM horarios INNER JOIN citas ON horarios.ID_horario = citas.ID_horario
				WHERE (((citas.Clase_citas)<'6') AND ((horarios.ID_horario)='$horsig'))
				GROUP BY horarios.ncita_horario, horarios.Usado_horario");
				while($rnu3=mysql_fetch_array($bnu3))
				{
					$nasigna3=$rnu3['cuenta'];
					$ncitahor3=$rnu3['ncita_horario'];
					$usado3=$rnu3['Usado_horario'];
					if($nasigna3>=$ncitahor3 || $usado3=='0')$nose='1';
				}
			}
			if($turxcita==3)
			{
				$bnu4=mysql_query("SELECT Count(citas.id_cita) AS cuenta, horarios.ncita_horario, horarios.Usado_horario
				FROM horarios INNER JOIN citas ON horarios.ID_horario = citas.ID_horario
				WHERE (((citas.Clase_citas)<'6') AND ((horarios.ID_horario)='$seleccion'))
				GROUP BY horarios.ncita_horario, horarios.Usado_horario");
				while($rnu4=mysql_fetch_array($bnu4))
				{
					$nasigna4=$rnu4['cuenta'];
					$ncitahor4=$rnu4['ncita_horario'];
					$usado4=$rnu4['Usado_horario'];
					if($nasigna4>=$ncitahor4 || $usado4=='0')$nose='1';
				}
				$bnu5=mysql_query("SELECT Count(citas.id_cita) AS cuenta, horarios.ncita_horario, horarios.Usado_horario
				FROM horarios INNER JOIN citas ON horarios.ID_horario = citas.ID_horario
				WHERE (((citas.Clase_citas)<'6') AND ((horarios.ID_horario)='$horsig'))
				GROUP BY horarios.ncita_horario, horarios.Usado_horario");
				while($rnu5=mysql_fetch_array($bnu5))
				{
					$nasigna5=$rnu5['cuenta'];
					$ncitahor5=$rnu5['ncita_horario'];
					$usado5=$rnu5['Usado_horario'];
					if($nasigna5>=$ncitahor5 || $usado5=='0')$nose='1';
				}
				$bnu6=mysql_query("SELECT Count(citas.id_cita) AS cuenta, horarios.ncita_horario, horarios.Usado_horario
				FROM horarios INNER JOIN citas ON horarios.ID_horario = citas.ID_horario
				WHERE (((citas.Clase_citas)<'6') AND ((horarios.ID_horario)='$horsig1'))
				GROUP BY horarios.ncita_horario, horarios.Usado_horario");
				while($rnu6=mysql_fetch_array($bnu6))
				{
					$nasigna6=$rnu6['cuenta'];
					$ncitahor6=$rnu6['ncita_horario'];
					$usado6=$rnu6['Usado_horario'];
					if($nasigna6>=$ncitahor6 || $usado6=='0')$nose='1';
				}
				if($seleccion==0 || $seleccion=='')
				{
					$nose='1';
				}
			}
			
			
			if($nose=='0')
			{
			
				for($i=1;$i<=$turxcita;$i++)
				{
					if($i==1)$seleccion=$seleccion;
					if($i==2)$seleccion=$horsig;
					if($i==3)$seleccion=$horsig1;
					
					$valorusado=$valusado-1;
					if($valorusado<0)$valorusado=0;
					$modhor=mysql_query("update horarios Set Usado_horario ='$valorusado' where ID_horario='$seleccion'");		
					if($tipafi=='C')$tipafilia='Cotizante';
					if($tipafi=='B')$tipafilia='Beneficiario';
					if($tipafi=='A')$tipafilia='Adicional';
					if($tipafi=='F')$tipafilia='Cabeza de flia';
					if($tipafi=='O')$tipafilia='Otro miembro GF';	

					$bhor=mysql_query("select * from horarios where ID_horario='$seleccion'");
					while($rhor=mysql_fetch_array($bhor))
					{
						$codmedico=$rhor['Cmed_horario'];
						$codarea=$rhor['Cserv_horario'];
						$fechahor=$rhor['Fecha_horario'];
						$horahor=$rhor['Hora_horario'];
					}
						
					mysql_query("insert into citas (id_cita,ID_horario,Idusu_citas,Tusua_citas,Cotra_citas,Clase_citas,Fsolusu_citas,Esta_cita,Hora_cita,bono_cita,REF,consul_cita,conc_cita,obse_cita, primera_cita, tipo_consulta, paciente_covid, fecdeseada) 
					values (NULL, '$seleccion','$codusu','$tipafilia','$codcontra','$tipoci','$dateh','1', '$hor','','','','$concesion','$obsecit','$pricita', '$tipocon', '$covid', '$fecreque')");		
					$numerocita=Mysql_insert_id();	
					//AREA, MEDICO, HORA_HORARIO, FECHA_HORARIO
					mysql_query("insert into vitacora (Codci_Vitaco ,Fopera_Vitaco, Hopera_Vitaco ,Operacio_Vitaco, pete_vitaco ,Cod_oper_vitaco,cmed_horario,cserv_horario,fecha_horario,hora_horario) values 
					($numerocita,'$dateh','$horaope','Create_Cita','$tipoci','$usucitas','$codmedico','$codarea','$fechahor','$horahor')");
					if($arelab=='80')
					{
						$bas='';$esp='';$rem='';
						if($tipoex=='B')$bas='Basico';
						if($tipoex=='E')$esp='Especial';
						if($tipoex=='R')$rem='Remitido';
						$obsecitlab=strtoupper($obsecitlab);
						mysql_query("insert into ane_lab_cit (cod_cita,  basico,  especial,  remitidos,  obser ) 
						values ('$numerocita', '$bas','$esp','$rem','$obsecitlab')");
					}
					$veciden='';
					$igual=0;
					$j=0;
					for($n=0;$n<$finrefs;$n++)
					{				
						$nomautos='selref'.$n;			
						$selref=$$nomautos;
						echo"<input type=hidden name=$nomautos value=$selref>";
						if($selref==1)
						{
							
							$nomautos='numcitas'.$n;
							$numcitas=$$nomautos;				
							$nomautos='idendetaref'.$n;
							$idendetaref=$$nomautos;
							
							$nomautos='idennue'.$j;				
							echo"<input type=hidden name=$nomautos value=$idendetaref>";
							$nomautos='citasig'.$n;
							$citasig=$$nomautos;
							$ncitasig=$citasig+1;
							
							$modhor=mysql_query("update detareferencia Set cita_dre ='$numerocita', marc_dre='1406', cant_cit='$ncitasig' where iden_dre='$idendetaref'");						
							$borden=mysql_query("SELECT detareferencia.idre_dre
							FROM detareferencia
							WHERE (((detareferencia.iden_dre)='$idendetaref'))");
							$rorden=mysql_fetch_array($borden);
							$idrefer=$rorden['idre_dre'];				
							$modorden=mysql_query("update orden Set esta_ord ='1406' where nume_ref='$idrefer'");	
							
							
							
							//SELECT orden.esta_ord, orden.nume_ref FROM orden WHERE (((orden.nume_ref)='$iden'));

							//echo "update detareferencia Set cita_dre ='$numerocita', marc_dre='1406', cant_cit='$ncitasig' where iden_dre='$idendetaref'";
							
							$veciden=$veciden.$idendetaref.'-';
							//echo $numcitas.' > '.$ncitasig;								
							if($numcitas>$ncitasig)
							{					
								$igual=1;					
								$nomautos='selrefret'.$j;
								echo"<input type=hidden name=$nomautos value='1'>";	
							}
							else
							{					
								$nomautos='selrefret'.$j;
								echo"<input type=hidden name=$nomautos value='0'>";	
							}	
							$j++;				
							
						}
					}
					$modcit=mysql_query("update citas Set iden_dre ='$veciden' where id_cita='$numerocita'");	
					
				}
			}
			else
			{
				$noguar=1;
				$mensaje="CITA NO ASIGNADA";		
			}
		}
		echo"<input type=hidden name=codusu value=$codusu>";
		echo"<input type=hidden name=tipafi value=$tipafi>";    
		echo"<input type=hidden name=clasifica value=$clasifica>";
		echo"<input type=hidden name=telres value=$telres>";
		echo"<input type=hidden name=tipafi value='$tipafi'>";
		echo"<input type=hidden name=tipafi value='$clasi'>";
		echo"<input type=hidden name=codcontra value='$codcontra'>";
		echo"<input type=hidden name=nocontra value=$nocontra>";
		echo"<input type=hidden name=mensaje value=$mensaje>";
		echo"<input type=hidden name=iden_uco value=$iden_uco>";
		echo"<input type=hidden name=viene value=$viene>";
		
		
		
		if($igual==1)
		{		 
			 echo"<input type=hidden name=finsigue value='$j'>";
			 echo"<input type=hidden name=igual value='$igual'>";
			 echo"<input type=hidden name=medico value='$medico'>";
			 echo"<input type=hidden name=mes value='$mes'>";	
			 echo"<input type=hidden name=control value='$control'>";
			 echo"<input type=hidden name=desareauto value='$desareauto'>";
			 echo"<input type=hidden name=codareauto value='$codareauto'>";
			 echo"<input type=hidden name=contrauto value='$contrauto'>";
			echo"<input type=hidden name=munate value=$munate>";
		}
		
		/*
		if($igual==1)
		{
			 echo"<input type=hidden name=finsigue value='$j'>";
			 echo"<input type=hidden name=igual value='$igual'>";
			 echo"<input type=hidden name=codareauto value='$areas'>";
			 echo"<input type=hidden name=medico value='$medico'>";
			 echo"<input type=hidden name=mes value='$mes'>";	
			 echo"<input type=hidden name=control value='$control'>";
			 echo"<input type=hidden name=desareauto value='$desareauto'>";
			 echo"<input type=hidden name=codareauto value='$codareauto'>";
		}
		*/
		
		
		
		if($noguar==1)
		{
			echo"
			<body>
			<br><br><br><br>
			<table align=center class='tbl' width=98%>
			<tr><th colspan=5 align=center>$mensaje</th></tr>
			<tr><th>
			 <INPUT type=button class='boton' value='Aceptar' onClick='salir();'>
			 </td></tr>
			 </table>
			 </body>";
		}	
		else
		{
			echo"<body onload='salir()'>
			</body>";
		}	
		echo"</form>";	
	}
	
?>

</html>