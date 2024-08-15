<html>
<head>
<title>PROGRAMA DE FACTURACIÓN</title>
</head>
<body>
<form name="form1" method="POST" action="" target='fr02'>
<link rel="stylesheet" href="css/style.css" type="text/css" />
<?
mysql_connect("localhost","root",""); 
mysql_select_db("PROINSALUD");

$concod=mysql_query("SELECT iden_tar,codigo,descrip,tipo,refe_cup,unlab_med FROM cups WHERE codigo='$codi_cir'");
if(mysql_num_rows($concod)==0)
	{
		?>
	       <script language="javaScript">
		   alert("No existe el código Cups");
		   history.go(-1);
		   </script>
		<?
	}
	else
			{
			   echo "<input type=hidden name=codusu value=$codusu>";
			   echo "<input type=hidden name=nord_dlab value='$nord_dlab'>";
			   echo "<input type=hidden name=iden_labs value=$iden_labs>";
			   echo "<input type=hidden name=codi_cir  value=$codi_cir>";
			   $consfac= Mysql_query("SELECT el.iden_labs, dl.estd_dlab,el.codi_usu,dl.codigo
			   FROM detalle_labs AS dl
			   INNER JOIN encabezado_labs AS el ON el.iden_labs = dl.iden_labs
			   WHERE dl.estd_dlab = 'P' AND dl.iden_labs ='$iden_labs'");
				
			   if(mysql_num_rows($consfac)<>0)
			   {
			   
				mysql_query("INSERT INTO detalle_labs ( iden_labs , codigo , nord_dlab , estd_dlab ) 
				VALUES ('$iden_labs', '$codi_cir', '$nord_dlab','P')");
                                
                              
                                
                                $sqlbusinter=mysql_query("SELECT * FROM labo_winsislab WHERE iden_labs='$iden_labs'");
                                $rowinte=mysql_fetch_array($sqlbusinter);
                                $fent=$rowinte[FECHA];
                                $tiden=$rowinte[TIPODOC];
                                $documento=$rowinte[DOCUMENTO];
                                $apellido1=$rowinte[APELLIDO1];
                                $apellido2=$rowinte[APELLIDO2];
                                $nombre1=$rowinte[NOMBRE1];
                                $nombre2=$rowinte[NOMBRE2];
                                $genero=$rowinte[SEXO];
                                $fecnaci=$rowinte[FECHANAC];
                                $piso=$rowinte[PISO];
                                
                                $direcc=$rowinte[DIRECCION];
                                $telefono=$rowinte[TELEFONO];
                                $cciudad=$rowinte[COD_CIUDAD];
                                $zona=$rowinte[COD_ZONA];
                                $celular=$rowinte[CELULAR];
                                $iden_labs=$rowinte[NUM_PETICION];
                                $embzo=$rowinte[EN_EMBARAZO];
                                $tipousuar=$rowinte[TIPO_USUARIO];
                                $amb_usu=$rowinte[TIPOSER];
                                
                                $med_soli=$rowinte[COD_MEDICO];
                                $nomb_medico=$rowinte[NOM_MEDICO];
                                $contrato=$rowinte[COD_CLIENTE];
                                $nomb_ctr=$rowinte[NOM_CLIENTE];
                                $servi=$rowinte[COD_CENCOS];
                                $nservi=$rowinte[NOM_CENCOS];
                                $iden_labs=$rowinte[iden_labs];
                                $ident_labo=$rowinte[iden_dlab];
                                
                                
                                $sqlcups=mysql_query("SELECT * FROM CUPS WHERE codigo='$codi_cir'");
                                $rowcps=mysql_fetch_array($sqlcups);
                                $nom_examen=$rowcps[descrip];
                                
                                 
                                $sqlinterfaz=mysql_query("INSERT INTO `proinsalud`.`labo_winsislab` (`num_orden` ,`fecha` ,`tipodoc`,`documento` ,`apellido1` ,`apellido2` ,
                                        `nombre1` ,`nombre2` ,`sexo` ,`fechanac` ,`direccion` ,`telefono` ,`cod_ciudad` ,`cod_zona` ,`celular` ,`email` ,
                                        `cod_examen` ,`nom_examen` ,`cantidad` ,`num_peticion` ,`piso` ,`en_embarazo` ,`tipo_usuario` ,`tiposer` ,`cod_medico` ,`nom_medico` ,
                                        `cod_cliente` ,`nom_cliente` ,`cod_cencos` ,`nom_cencos` ,`cod_sede` ,`estado`,`iden_labs` ,`iden_dlab`)
                                         VALUES ( '$nord_dlab', '$fent', '$tiden' ,'$documento', '$apellido1', '$apellido2', '$nombre1', '$nombre2', '$genero', '$fecnaci','$direcc', '$telefono', '$cciudad', '$zona', '$celular',
                                         '$email', '$codi_cir', '$nom_examen', '1', '$iden_labs', '$piso','$embzo', '$tipousuar', '$amb_usu', '$med_soli', '$nomb_medico', '$contrato',
                                         '$nomb_ctr', '$servi', '$nservi', '1', '0','$iden_labs','$ident_labo')");
                                
                                //echo  $sqlinterfaz;
                                        
						
                            }
				
				
			}
			
	echo "<body onload='location.href=\"edi_orden.php?codusu=$codusu&iden_labs=$iden_labs&nord_dlab=$nord_dlab\"'>";		
?>		

</form>
</body>
</html>
