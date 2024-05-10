<?php
session_register('paciente');	
session_register('Gcod_mediconh');
session_register('numcita');
$tiespe=$_SESSION['tiespe'];
session_register('concontrol');
session_register('Gareanh');

	if(empty($paciente))
	{
		echo"<br><br><table align=center class='tbl'>
		<tr><th>POR SEGURIDAD SU SESIÆN SE CERRÆ. EIERRE E INGRESE NUEVAMENTE AL PROGRAMA/th></tr>
		</table>";
		exit;
	}
	
?>
<html>
<head>
<script language="JavaScript">

function salir(prg)
{
	uno.target='';
	uno.action=prg;
	uno.submit();
	uno.target='menu';
	uno.action='menu.php';
	uno.submit();
}

function salir8(prg)
{
	uno.target='';
	uno.action=prg;
	uno.submit();
	uno.target='';
	uno.action='valfamilia1.php';
	uno.submit();
}



function salir1()
{
	alert(uno.numtriage.value);
	uno.target='TOP';
	uno.action='impre_triage1.php';
	uno.submit();	
	uno.target='area';
	uno.action='clasi_triage.php';
	uno.submit();	
}

</script>	
</head>
<?php
	//$mediconsulta=$Gcod_mediconh;
	
	
	
	$archivodolor='tmp/HCDOLOR'.$numcita.'-'.$paciente.'.txt';	
	if ($codiprg!=10)
	{		
		$archivo='tmp/0HC'.$numcita.'-'.$paciente.'.txt';		
		if(file_exists($archivo)==FALSE)	//DATOS GENERALES DE LA CONSULTA
		{
			$fechalar=date('ymdHis');
			$fechaini=date('Y-m-d');
			$horaini=date('H:i:s');
			$numhisto=$Gcod_mediconh.$fechalar;
			$mediconsulta=$Gcod_mediconh;
			$a="0|";
			$a.="horaini|";
			$a.="$horaini\n";
			$p=fopen($archivo,"a");
			if($p)
			{
				fputs($p,$a);
			}			
			$a="0|";
			$a.="numhisto|";
			$a.="$numhisto\n";
			$p=fopen($archivo,"a");
			if($p)
			{
				fputs($p,$a);
			}	
			$a="0|";
			$a.="fechaini|";
			$a.="$fechaini\n";
			$p=fopen($archivo,"a");
			if($p)
			{
				fputs($p,$a);
			}
			$a="0|";
			$a.="mediconsulta|";
			$a.="$mediconsulta\n";
			$p=fopen($archivo,"a");
			if($p)
			{
				fputs($p,$a);
			}
			$a="0|";
			$a.="numcita|";
			$a.="$numcita\n";
			$p=fopen($archivo,"a");
			if($p)
			{
				fputs($p,$a);
			}
			
		}	
	}
		
	echo"<form name=uno method=post>";	
	if ($codiprg==1)	//ANAMNESIS
	{		
		$archivo='tmp/1HC'.$numcita.'-'.$paciente.'.txt';		
		if(file_exists($archivo)==TRUE)
		{
			unlink ($archivo);
		}
		$motivo=str_replace( chr(10), "Æ", $motivo);
		$enfeac=str_replace( chr(10), "Æ", $enfeac);
		$revisi=str_replace( chr(10), "Æ", $revisi);
		$informe=str_replace( chr(10), "Æ", $informe);


		
		
		$a="1|";$a.="etnia|";$a.="$etnia\n";$p=fopen($archivo,"a");if($p){fputs($p,$a);}
		$a="1|";$a.="ocupacion|";$a.="$ocupacion\n";$p=fopen($archivo,"a");if($p){fputs($p,$a);}
		$a="1|";$a.="escolaridad|";$a.="$escolaridad\n";$p=fopen($archivo,"a");if($p){fputs($p,$a);}
		$a="1|";$a.="estadocivil|";$a.="$estadocivil\n";$p=fopen($archivo,"a");if($p){fputs($p,$a);}
		$a="1|";$a.="direccion|";$a.="$direccion\n";$p=fopen($archivo,"a");if($p){fputs($p,$a);}
		$a="1|";$a.="tidoacu|";$a.="$tidoacu\n";$p=fopen($archivo,"a");if($p){fputs($p,$a);}
		$a="1|";$a.="nudoacu|";$a.="$nudoacu\n";$p=fopen($archivo,"a");if($p){fputs($p,$a);}
		$a="1|";$a.="pnomacu|";$a.="$pnomacu\n";$p=fopen($archivo,"a");if($p){fputs($p,$a);}
		$a="1|";$a.="snomacu|";$a.="$snomacu\n";$p=fopen($archivo,"a");if($p){fputs($p,$a);}
		$a="1|";$a.="papeacu|";$a.="$papeacu\n";$p=fopen($archivo,"a");if($p){fputs($p,$a);}
		$a="1|";$a.="sapeacu|";$a.="$sapeacu\n";$p=fopen($archivo,"a");if($p){fputs($p,$a);}
		$a="1|";$a.="parenacu|";$a.="$parenacu\n";$p=fopen($archivo,"a");if($p){fputs($p,$a);}
		$a="1|";$a.="direacu|";$a.="$direacu\n";$p=fopen($archivo,"a");if($p){fputs($p,$a);}
		$a="1|";$a.="teleacu|";$a.="$teleacu\n";$p=fopen($archivo,"a");if($p){fputs($p,$a);}
		$a="1|";$a.="muniacu|";$a.="$muniacu\n";$p=fopen($archivo,"a");if($p){fputs($p,$a);}
		$a="1|";$a.="nommuniacu|";$a.="$nommuniacu\n";$p=fopen($archivo,"a");if($p){fputs($p,$a);}		
		$a="1|";$a.="primera|";$a.="$primera\n";$p=fopen($archivo,"a");if($p){fputs($p,$a);}
		$a="1|";$a.="codciru|";$a.="$codciru\n";$p=fopen($archivo,"a");if($p){fputs($p,$a);}		
		$a="1|";$a.="motivo|";$a.="$motivo\n";$p=fopen($archivo,"a");if($p){fputs($p,$a);}		
		$a="1|";$a.="enfeac|";$a.="$enfeac\n";$p=fopen($archivo,"a");if($p){fputs($p,$a);}			
		$a="1|";$a.="revisi|";$a.="$revisi\n";$p=fopen($archivo,"a");if($p){fputs($p,$a);}			
		$a="1|";$a.="informe|";$a.="$informe\n";$p=fopen($archivo,"a");if($p){fputs($p,$a);}
		$a="1|";$a.="grupo_poblacional|";$a.="$grupo_poblacional\n";$p=fopen($archivo,"a");if($p){fputs($p,$a);}
		$a="1|";$a.="orientacion_sexual|";$a.="$orientacion_sexual\n";$p=fopen($archivo,"a");if($p){fputs($p,$a);}
		$a="1|";$a.="medicoproc_ccl|";$a.="$medicoproc_ccl\n";$p=fopen($archivo,"a");if($p){fputs($p,$a);}
		
		
		

		$archivo='tmp/cov-HC'.$numcita.'-'.$paciente.'.txt';
		echo $archivo;
		if(file_exists($archivo)==TRUE)
		{
			unlink ($archivo);
		}				
		for($n=0;$n<$fincov;$n++)
		{
			$nomvar='codi'.$n;
			$codi=$$nomvar;			
			$a="14|";
			$a.="$nomvar|";
			$a.="$codi\n";
			$p=fopen($archivo,"a");
			if($p)
			{
				fputs($p,$a);
			}
			$nomvar='valor'.$n;
			$valor=$$nomvar;
			$a="14|";
			$a.="$nomvar|";
			$a.="$valor\n";
			$p=fopen($archivo,"a");
			if($p)
			{
				fputs($p,$a);
			}			
		}

		
		echo"<body onload=salir('antece0.php')>
		</body>";
	}	
	if ($codiprg==2)	//ANTECEDENTES
	{		
		$archivo='tmp/2HC'.$numcita.'-'.$paciente.'.txt';		
		if(file_exists($archivo)==TRUE)
		{
			unlink ($archivo);
		}

		$person=str_replace( chr(10), "Æ", $person);
		$familia=str_replace( chr(10), "Æ", $familia);
		$metodo=str_replace( chr(10), "Æ", $metodo);
		$gineco=str_replace( chr(10), "Æ", $gineco);
		
		if(file_exists($archivodolor)==TRUE)
		{
			//if($nuepatologicos=='')$nuepatologicos='Negativo';
			if($nuecardiovasculares=='')$nuecardiovasculares='Negativo';
			if($nuepulmonar=='')$nuepulmonar='Negativo';
			if($nuequirurgicos=='')$nuequirurgicos='Negativo';
			if($neofarmacos=='')$neofarmacos='Negativo';
			if($nuetoxico=='')$nuetoxico='Negativo';
			if($neotransfin=='')$neotransfin='Negativo';
			if($neootros=='')$neootros='Ninguno';
			
			
			//$a="2|";$a.="nuepatologicos|";$a.="$nuepatologicos\n";$p=fopen($archivo,"a");if($p){fputs($p,$a);}
			$a="2|";$a.="nuecardiovasculares|";$a.="$nuecardiovasculares\n";$p=fopen($archivo,"a");if($p){fputs($p,$a);}
			
			$a="2|";$a.="nuepulmonar|";$a.="$nuepulmonar\n";$p=fopen($archivo,"a");if($p){fputs($p,$a);}
			$a="2|";$a.="nuequirurgicos|";$a.="$nuequirurgicos\n";$p=fopen($archivo,"a");if($p){fputs($p,$a);}
			$a="2|";$a.="neofarmacos|";$a.="$neofarmacos\n";$p=fopen($archivo,"a");if($p){fputs($p,$a);}
			$a="2|";$a.="nuetoxico|";$a.="$nuetoxico\n";$p=fopen($archivo,"a");if($p){fputs($p,$a);}
			
			
			$a="2|";$a.="neotransfin|";$a.="$neotransfin\n";$p=fopen($archivo,"a");if($p){fputs($p,$a);}
//			$a="2|";$a.="neogineco|";$a.="$neogineco\n";$p=fopen($archivo,"a");if($p){fputs($p,$a);}
			$a="2|";$a.="neootros|";$a.="$neootros\n";$p=fopen($archivo,"a");if($p){fputs($p,$a);}
		}	
		else
		{
			$a="2|";
			$a.="person|";
			$a.="$person\n";
			$p=fopen($archivo,"a");
			if($p)
			{
				fputs($p,$a);
			}
			$a="2|";
			$a.="familia|";
			$a.="$familia\n";
			$p=fopen($archivo,"a");
			if($p)
			{
				fputs($p,$a);
			}
			
			$a="2|";
			$a.="metodo|";
			$a.="$metodo\n";
			$p=fopen($archivo,"a");
			if($p)
			{
				fputs($p,$a);
			}
		}	
		
		$a="2|";
		$a.="gineco|";
		$a.="$gineco\n";
		$p=fopen($archivo,"a");
		if($p)
		{
			fputs($p,$a);
		}
		
		$a="2|";
		$a.="gestan|";
		$a.="$gestan\n";
		$p=fopen($archivo,"a");
		if($p)
		{
			fputs($p,$a);
		}
		$a="2|";
		$a.="partos|";
		$a.="$partos\n";
		$p=fopen($archivo,"a");
		if($p)
		{
			fputs($p,$a);
		}
		$a="2|";
		$a.="cesareas|";
		$a.="$cesareas\n";
		$p=fopen($archivo,"a");
		if($p)
		{
			fputs($p,$a);
		}
		$a="2|";
		$a.="abortos|";
		$a.="$abortos\n";
		$p=fopen($archivo,"a");
		if($p)
		{
			fputs($p,$a);
		}		
		$a="2|";
		$a.="vivos|";
		$a.="$vivos\n";
		$p=fopen($archivo,"a");
		if($p)
		{
			fputs($p,$a);
		}
		$a="2|";
		$a.="mortinatos|";
		$a.="$mortinatos\n";
		$p=fopen($archivo,"a");
		if($p)
		{
			fputs($p,$a);
		}
		$a="2|";
		$a.="feulme|";
		$a.="$feulme\n";
		$p=fopen($archivo,"a");
		if($p)
		{
			fputs($p,$a);
		}
		
		
		echo"<body onload=salir('examen0.php')>
		</body>";			
	}	
	if ($codiprg==3)	//EXAMEN FISICO
	{		
		if(file_exists($archivodolor)==TRUE)
		{
			$codprograma=1;
			$archivo='tmp/ex_fisi'.$codprograma.'-'.$numcita.'-'.$paciente.'.txt';
			if(file_exists($archivo)==TRUE)
			{
				unlink ($archivo);
			}	
			$a="6|";$a.="peso_exf|";$a.="$peso_exf\n";$p=fopen($archivo,"a");if($p){fputs($p,$a);}		
			$a="6|";$a.="talla_exf|";$a.="$talla_exf\n";$p=fopen($archivo,"a");if($p){fputs($p,$a);}
			
			$a="6|";$a.="imc_exf|";$a.="$imc_exf\n";$p=fopen($archivo,"a");if($p){fputs($p,$a);}
			$a="6|";$a.="dimc_exf|";$a.="$dimc_exf\n";$p=fopen($archivo,"a");if($p){fputs($p,$a);}			
			
			$a="6|";$a.="tempera_exf|";$a.="$tempera_exf\n";$p=fopen($archivo,"a");if($p){fputs($p,$a);}		
			$a="6|";$a.="saturo2_exf|";$a.="$saturo2_exf\n";$p=fopen($archivo,"a");if($p){fputs($p,$a);}			
			$a="6|";$a.="presions_exf|";$a.="$presions_exf\n";$p=fopen($archivo,"a");if($p){fputs($p,$a);}
			$a="6|";$a.="presiond_exf|";$a.="$presiond_exf\n";$p=fopen($archivo,"a");if($p){fputs($p,$a);}
			$a="6|";$a.="frecard_exf|";$a.="$frecard_exf\n";$p=fopen($archivo,"a");if($p){fputs($p,$a);}		
			$a="6|";$a.="freresp_exf|";$a.="$freresp_exf\n";$p=fopen($archivo,"a");if($p){fputs($p,$a);}
			$a="6|";$a.="estado_exf|";$a.="$estado_exf\n";$p=fopen($archivo,"a");if($p){fputs($p,$a);}
			$a="6|";$a.="snc_exf|";$a.="$snc_exf\n";$p=fopen($archivo,"a");if($p){fputs($p,$a);}
			
			$a="6|";$a.="dentsuperior_exf|";$a.="$dentsuperior_exf\n";$p=fopen($archivo,"a");if($p){fputs($p,$a);}
			$a="6|";$a.="dentinferior_exf|";$a.="$dentinferior_exf\n";$p=fopen($archivo,"a");if($p){fputs($p,$a);}
			$a="6|";$a.="dentfija_exf|";$a.="$dentfija_exf\n";$p=fopen($archivo,"a");if($p){fputs($p,$a);}
			$a="6|";$a.="dentmovil_exf|";$a.="$dentmovil_exf\n";$p=fopen($archivo,"a");if($p){fputs($p,$a);}
			$a="6|";$a.="dentparcial_exf|";$a.="$dentparcial_exf\n";$p=fopen($archivo,"a");if($p){fputs($p,$a);}
			$a="6|";$a.="denttotal_exf|";$a.="$denttotal_exf\n";$p=fopen($archivo,"a");if($p){fputs($p,$a);}	
						
			if($anormali_exf=='')$anormali_exf='Normal';
			if($torax_exf=='')$torax_exf='Normal';
			if($pulmones_exf=='')$pulmones_exf='Normal';
			if($corazon_exf=='')$corazon_exf='Normal';
			if($abdomen_exf=='')$abdomen_exf='Normal';
			if($genitouri_exf=='')$genitouri_exf='Normal';
			if($extremi_exf=='')$extremi_exf='Normal';
			if($otros_exf=='')$otros_exf='Ninguno';			
			
			$a="6|";$a.="apertur_exf|";$a.="$apertur_exf\n";$p=fopen($archivo,"a");if($p){fputs($p,$a);}		
			$a="6|";$a.="estadodien_exf|";$a.="$estadodien_exf\n";$p=fopen($archivo,"a");if($p){fputs($p,$a);}
			$a="6|";$a.="imallam_exf|";$a.="$imallam_exf\n";$p=fopen($archivo,"a");if($p){fputs($p,$a);}
			$a="6|";$a.="dmentoh_exf|";$a.="$dmentoh_exf\n";$p=fopen($archivo,"a");if($p){fputs($p,$a);}
			$a="6|";$a.="movilid_exf|";$a.="$movilid_exf\n";$p=fopen($archivo,"a");if($p){fputs($p,$a);}
			$a="6|";$a.="anormali_exf|";$a.="$anormali_exf\n";$p=fopen($archivo,"a");if($p){fputs($p,$a);}
			$a="6|";$a.="torax_exf|";$a.="$torax_exf\n";$p=fopen($archivo,"a");if($p){fputs($p,$a);}
			$a="6|";$a.="pulmones_exf|";$a.="$pulmones_exf\n";$p=fopen($archivo,"a");if($p){fputs($p,$a);}
			$a="6|";$a.="corazon_exf|";$a.="$corazon_exf\n";$p=fopen($archivo,"a");if($p){fputs($p,$a);}
			$a="6|";$a.="abdomen_exf|";$a.="$abdomen_exf\n";$p=fopen($archivo,"a");if($p){fputs($p,$a);}
			$a="6|";$a.="genitouri_exf|";$a.="$genitouri_exf\n";$p=fopen($archivo,"a");if($p){fputs($p,$a);}
			$a="6|";$a.="extremi_exf|";$a.="$extremi_exf\n";$p=fopen($archivo,"a");if($p){fputs($p,$a);}
			$a="6|";$a.="otros_exf|";$a.="$otros_exf\n";$p=fopen($archivo,"a");if($p){fputs($p,$a);}			

			$archivo='tmp/ex_comp'.$codprograma.'-'.$numcita.'-'.$paciente.'.txt';			
			if(file_exists($archivo)==TRUE)
			{
				unlink ($archivo);
			}		
			$a="6|";$a.="hemoglo_exc|";$a.="$hemoglo_exc\n";$p=fopen($archivo,"a");if($p){fputs($p,$a);}		
			$a="6|";$a.="glicemi_exc|";$a.="$glicemi_exc\n";$p=fopen($archivo,"a");if($p){fputs($p,$a);}
			$a="6|";$a.="hemocla_exc|";$a.="$hemocla_exc\n";$p=fopen($archivo,"a");if($p){fputs($p,$a);}		
			$a="6|";$a.="factorrh_exc|";$a.="$factorrh_exc\n";$p=fopen($archivo,"a");if($p){fputs($p,$a);}			
			$a="6|";$a.="hematoc_exc|";$a.="$hematoc_exc\n";$p=fopen($archivo,"a");if($p){fputs($p,$a);}
			$a="6|";$a.="bun_exc|";$a.="$bun_exc\n";$p=fopen($archivo,"a");if($p){fputs($p,$a);}
			$a="6|";$a.="protein_exc|";$a.="$protein_exc\n";$p=fopen($archivo,"a");if($p){fputs($p,$a);}		
			$a="6|";$a.="plaquet_exc|";$a.="$plaquet_exc\n";$p=fopen($archivo,"a");if($p){fputs($p,$a);}
			$a="6|";$a.="creatin_exc|";$a.="$creatin_exc\n";$p=fopen($archivo,"a");if($p){fputs($p,$a);}
			$a="6|";$a.="albumin_exc|";$a.="$albumin_exc\n";$p=fopen($archivo,"a");if($p){fputs($p,$a);}
			$a="6|";$a.="tp_exc|";$a.="$tp_exc\n";$p=fopen($archivo,"a");if($p){fputs($p,$a);}		
			$a="6|";$a.="sodio_exc|";$a.="$sodio_exc\n";$p=fopen($archivo,"a");if($p){fputs($p,$a);}		
			$a="6|";$a.="bilitot_exc|";$a.="$bilitot_exc\n";$p=fopen($archivo,"a");if($p){fputs($p,$a);}
			$a="6|";$a.="tpt_exc|";$a.="$tpt_exc\n";$p=fopen($archivo,"a");if($p){fputs($p,$a);}
			$a="6|";$a.="potasio_exc|";$a.="$potasio_exc\n";$p=fopen($archivo,"a");if($p){fputs($p,$a);}
			$a="6|";$a.="bilidir_exc|";$a.="$bilidir_exc\n";$p=fopen($archivo,"a");if($p){fputs($p,$a);}
			$a="6|";$a.="tiposan_exc|";$a.="$tiposan_exc\n";$p=fopen($archivo,"a");if($p){fputs($p,$a);}
			$a="6|";$a.="calcio_exc|";$a.="$calcio_exc\n";$p=fopen($archivo,"a");if($p){fputs($p,$a);}
			$a="6|";$a.="vdrl_exc|";$a.="$vdrl_exc\n";$p=fopen($archivo,"a");if($p){fputs($p,$a);}
			$a="6|";$a.="coagula_exc|";$a.="$coagula_exc\n";$p=fopen($archivo,"a");if($p){fputs($p,$a);}
			$a="6|";$a.="leucoci_exc|";$a.="$leucoci_exc\n";$p=fopen($archivo,"a");if($p){fputs($p,$a);}
			$a="6|";$a.="prembar_exc|";$a.="$prembar_exc\n";$p=fopen($archivo,"a");if($p){fputs($p,$a);}
			$a="6|";$a.="rxfecha_exc|";$a.="$rxfecha_exc\n";$p=fopen($archivo,"a");if($p){fputs($p,$a);}
			$a="6|";$a.="rxdescrip_exc|";$a.="$rxdescrip_exc\n";$p=fopen($archivo,"a");if($p){fputs($p,$a);}
			$a="6|";$a.="ecgfecha_exc|";$a.="$ecgfecha_exc\n";$p=fopen($archivo,"a");if($p){fputs($p,$a);}
			$a="6|";$a.="ecgdescrip_exc|";$a.="$ecgdescrip_exc\n";$p=fopen($archivo,"a");if($p){fputs($p,$a);}
			$a="6|";$a.="ecofecha_exc|";$a.="$ecofecha_exc\n";$p=fopen($archivo,"a");if($p){fputs($p,$a);}
			$a="6|";$a.="ecodescrip_exc|";$a.="$ecodescrip_exc\n";$p=fopen($archivo,"a");if($p){fputs($p,$a);}
			$a="6|";$a.="otrofecha_exc|";$a.="$otrofecha_exc\n";$p=fopen($archivo,"a");if($p){fputs($p,$a);}
			$a="6|";$a.="freresp_exf|";$a.="$freresp_exf\n";$p=fopen($archivo,"a");if($p){fputs($p,$a);}
			$a="6|";$a.="otrodescrip_exc|";$a.="$otrodescrip_exc\n";$p=fopen($archivo,"a");if($p){fputs($p,$a);}			
			$archivo='tmp/conclu'.$codprograma.'-'.$numcita.'-'.$paciente.'.txt';			
			if(file_exists($archivo)==TRUE)
			{
				unlink ($archivo);
			}		
			$a="6|";$a.="estfisico_ccl|";$a.="$estfisico_ccl\n";$p=fopen($archivo,"a");if($p){fputs($p,$a);}
			$a="6|";$a.="clafuncional_ccl|";$a.="$clafuncional_ccl\n";$p=fopen($archivo,"a");if($p){fputs($p,$a);}
			$a="6|";$a.="anestesia_ccl|";$a.="$anestesia_ccl\n";$p=fopen($archivo,"a");if($p){fputs($p,$a);}
			
			
			for($i=0;$i<4;$i++)
			{
				$j=$i+1;
				$codante="codigociru".$i;
				$codposte="codigociru".$j;
				if($$codante=='')
				{
					$$codante=$$codposte;
					$$codposte='';
				}
			}
			$a="6|";$a.="codigociru0|";$a.="$codigociru0\n";$p=fopen($archivo,"a");if($p){fputs($p,$a);}
			$a="6|";$a.="codigociru1|";$a.="$codigociru1\n";$p=fopen($archivo,"a");if($p){fputs($p,$a);}
			$a="6|";$a.="codigociru2|";$a.="$codigociru2\n";$p=fopen($archivo,"a");if($p){fputs($p,$a);}
			$a="6|";$a.="codigociru3|";$a.="$codigociru3\n";$p=fopen($archivo,"a");if($p){fputs($p,$a);}
			$a="6|";$a.="codigociru4|";$a.="$codigociru4\n";$p=fopen($archivo,"a");if($p){fputs($p,$a);}
			
			
			$a="6|";$a.="vario_ccl|";$a.="$vario_ccl\n";$p=fopen($archivo,"a");if($p){fputs($p,$a);}	
			$a="6|";$a.="anestesia1_ccl|";$a.="$anestesia1_ccl\n";$p=fopen($archivo,"a");if($p){fputs($p,$a);}
			$a="6|";$a.="reserva_ccl|";$a.="$reserva_ccl\n";$p=fopen($archivo,"a");if($p){fputs($p,$a);}
			$a="6|";$a.="reservauci_ccl|";$a.="$reservauci_ccl\n";$p=fopen($archivo,"a");if($p){fputs($p,$a);}			
			$a="6|";$a.="premedica_ccl|";$a.="$premedica_ccl\n";$p=fopen($archivo,"a");if($p){fputs($p,$a);}
			$a="6|";$a.="premedicatxt_ccl|";$a.="$premedicatxt_ccl\n";$p=fopen($archivo,"a");if($p){fputs($p,$a);}
			$a="6|";$a.="tprograma_ccl|";$a.="$tprograma_ccl\n";$p=fopen($archivo,"a");if($p){fputs($p,$a);}
			$a="6|";$a.="anotacion_ccl|";$a.="$anotacion_ccl\n";$p=fopen($archivo,"a");if($p){fputs($p,$a);}
			$a="6|";$a.="aptociru_ccl|";$a.="$aptociru_ccl\n";$p=fopen($archivo,"a");if($p){fputs($p,$a);}
			$a="6|";$a.="reevaluar_ccl|";$a.="$reevaluar_ccl\n";$p=fopen($archivo,"a");if($p){fputs($p,$a);}
			$a="6|";$a.="anotacion1_ccl|";$a.="$anotacion1_ccl\n";$p=fopen($archivo,"a");if($p){fputs($p,$a);}
			$a="6|";$a.="concent_ccl|";$a.="$concent_ccl\n";$p=fopen($archivo,"a");if($p){fputs($p,$a);}
			$a="1|";$a.="medicoproc_ccl|";$a.="$medicoproc_ccl\n";$p=fopen($archivo,"a");if($p){fputs($p,$a);}
			//$a="6|";$a.="observa_ccl|";$a.="$observa_ccl\n";$p=fopen($archivo,"a");if($p){fputs($p,$a);}
			
		}			
		else		
		{		
		
			$archivo='tmp/3HC'.$numcita.'-'.$paciente.'.txt';		
			if(file_exists($archivo)==TRUE)
			{
				unlink ($archivo);
			}
			$otros=str_replace( chr(10), "Æ", $otros);
			$a="3|";
			$a.="fin|";
			$a.="$fin\n";
			$p=fopen($archivo,"a");
			if($p)
			{
				fputs($p,$a);
			}		
			$a="3|";
			$a.="tenar1|";
			$a.="$tenar1\n";
			$p=fopen($archivo,"a");
			if($p)
			{
				fputs($p,$a);
			}
			$a="3|";
			$a.="tenar2|";
			$a.="$tenar2\n";
			$p=fopen($archivo,"a");
			if($p)
			{
				fputs($p,$a);
			}		
			$a="3|";
			$a.="freres|";
			$a.="$freres\n";
			$p=fopen($archivo,"a");
			if($p)
			{
				fputs($p,$a);
			}			
			$a="3|";
			$a.="fc|";
			$a.="$fc\n";
			$p=fopen($archivo,"a");
			if($p)
			{
				fputs($p,$a);
			}
			$a="3|";
			$a.="tempe|";
			$a.="$tempe\n";
			$p=fopen($archivo,"a");
			if($p)
			{
				fputs($p,$a);
			}
			$a="3|";
			$a.="peso|";
			$a.="$peso\n";
			$p=fopen($archivo,"a");
			if($p)
			{
				fputs($p,$a);
			}		
			
			$a="3|";
			$a.="talla|";
			$a.="$talla\n";
			$p=fopen($archivo,"a");
			if($p)
			{
				fputs($p,$a);
			}
			$a="3|";
			$a.="imc|";
			$a.="$imc\n";
			$p=fopen($archivo,"a");
			if($p)
			{
				fputs($p,$a);
			}
			$a="3|";
			$a.="cintura|";
			$a.="$cintura\n";
			$p=fopen($archivo,"a");
			if($p)
			{
				fputs($p,$a);
			}
			$a="3|";
			$a.="cadera|";
			$a.="$cadera\n";
			$p=fopen($archivo,"a");
			if($p)
			{
				fputs($p,$a);
			}
			$a="3|";
			$a.="icc|";
			$a.="$icc\n";
			$p=fopen($archivo,"a");
			if($p)
			{
				fputs($p,$a);
			}
			$a="3|";
			$a.="dimc|";
			$a.="$dimc\n";
			$p=fopen($archivo,"a");
			if($p)
			{
				fputs($p,$a);
			}		
			$a="3|";
			$a.="pc|";
			$a.="$pc\n";
			$p=fopen($archivo,"a");
			if($p)
			{
				fputs($p,$a);
			}		
			$a="3|";
			$a.="otros|";
			$a.="$otros\n";
			$p=fopen($archivo,"a");
			if($p)
			{
				fputs($p,$a);
			}
			
			$a="3|";
			$a.="saox_tri|";
			$a.="$saox_tri\n";
			$p=fopen($archivo,"a");
			if($p)
			{
				fputs($p,$a);
			}
			
			if($tiespe==1)
			{
				for($i=0;$i<$fin;$i++)
				{
					echo $i;
					$nomvar='codiexa'.$i;
					$codiexa=$$nomvar;
					$a="3|";
					$a.="$nomvar|";
					$a.="$codiexa\n";
					$p=fopen($archivo,"a");
					if($p)
					{
						fputs($p,$a);
					}
					
					$nomvar='item'.$i;
					$item=$$nomvar;
					$a="3|";
					$a.="$nomvar|";
					$a.="$item\n";
					$p=fopen($archivo,"a");
					if($p)
					{
						fputs($p,$a);
					}
					
					$nomvar='obseexa'.$i;
					$obseexa=$$nomvar;
					$a="3|";
					$a.="$nomvar|";
					$a.="$obseexa\n";
					$p=fopen($archivo,"a");
					if($p)
					{
						fputs($p,$a);
					}		
				}	
			}
		}
		echo"<body onload=salir('diagnos0.php')></body>";	
	}	
	if ($codiprg==4)	//DIAGNOSTICOS
	{		
		$archivo='tmp/4HC'.$numcita.'-'.$paciente.'.txt';		
		if(file_exists($archivo)==TRUE)
		{
			unlink ($archivo);
		}		
		$a="4|";
		$a.="conti|";
		$a.="$conti\n";
		$p=fopen($archivo,"a");
		if($p)
		{
			fputs($p,$a);
		}			
		$a="4|";
		$a.="causa|";
		$a.="$causa\n";
		$p=fopen($archivo,"a");
		if($p)
		{
			fputs($p,$a);
		}

		$a="4|";
		$a.="final|";
		$a.="$final\n";
		$p=fopen($archivo,"a");
		if($p)
		{
			fputs($p,$a);
		}		
		$a="4|";
		$a.="sintorespi|";
		$a.="$sintorespi\n";
		$p=fopen($archivo,"a");
		if($p)
		{
			fputs($p,$a);
		}		
		
		$a="4|";
		$a.="sintopiel|";
		$a.="$sintopiel\n";
		$p=fopen($archivo,"a");
		if($p)
		{
			fputs($p,$a);
		}		
		$a="4|";
		$a.="causatrab|";
		$a.="$causatrab\n";
		$p=fopen($archivo,"a");
		if($p)
		{
			fputs($p,$a);
		}		
		$a="4|";
		$a.="tipodiag|";
		$a.="$tipodiag\n";
		$p=fopen($archivo,"a");
		if($p)
		{
			fputs($p,$a);
		}
		
		
		$a="4|";
		$a.="patolocronicas|";
		$a.="$patolocronicas\n";
		$p=fopen($archivo,"a");
		if($p)
		{
			fputs($p,$a);
		}			
		
		$a="4|";
		$a.="map|";
		$a.="$map\n";
		$p=fopen($archivo,"a");
		if($p)
		{
			fputs($p,$a);
		}			
		$a="4|";
		$a.="cod|";
		$a.="$cod\n";
		$p=fopen($archivo,"a");
		if($p)
		{
			fputs($p,$a);
		}			
		$a="4|";
		$a.="obse|";
		$a.="$obse\n";
		$p=fopen($archivo,"a");
		if($p)
		{
			fputs($p,$a);
		}
		$a="4|";
		$a.="map1|";
		$a.="$map1\n";
		$p=fopen($archivo,"a");
		if($p)
		{
			fputs($p,$a);
		}			
		$a="4|";
		$a.="cod1|";
		$a.="$cod1\n";
		$p=fopen($archivo,"a");
		if($p)
		{
			fputs($p,$a);
		}	
		$a="4|";
		$a.="obse1|";
		$a.="$obse1\n";
		$p=fopen($archivo,"a");
		if($p)
		{
			fputs($p,$a);
		}	
		$a="4|";
		$a.="map2|";
		$a.="$map2\n";
		$p=fopen($archivo,"a");
		if($p)
		{
			fputs($p,$a);
		}			
		$a="4|";
		$a.="cod2|";
		$a.="$cod2\n";
		$p=fopen($archivo,"a");
		if($p)
		{
			fputs($p,$a);
		}	
		$a="4|";
		$a.="obse2|";
		$a.="$obse2\n";
		$p=fopen($archivo,"a");
		if($p)
		{
			fputs($p,$a);
		}
		$a="4|";
		$a.="map3|";
		$a.="$map3\n";
		$p=fopen($archivo,"a");
		if($p)
		{
			fputs($p,$a);
		}			
		$a="4|";
		$a.="cod3|";
		$a.="$cod3\n";
		$p=fopen($archivo,"a");
		if($p)
		{
			fputs($p,$a);
		}	
		$a="4|";
		$a.="obse3|";
		$a.="$obse3\n";
		$p=fopen($archivo,"a");
		if($p)
		{
			fputs($p,$a);
		}
		$analpv=str_replace( chr(10), "Æ", $analpv);
		$a="4|";
		$a.="analpv|";
		$a.="$analpv\n";
		$p=fopen($archivo,"a");
		if($p)
		{
			fputs($p,$a);
		}
		
		$a="4|";
		$a.="vicviolencia|";
		$a.="$vicviolencia\n";
		$p=fopen($archivo,"a");
		if($p)
		{
			fputs($p,$a);
		}
		
		if($Gareanh=='01')
		{
			echo"<body onload=salir('valfamilia1.php')>
			</body>";
		}
		else
		{
			echo"<body onload=salir('ordenes0.php')>
			</body>";
		}
	}
	
	
	if ($codiprg==5)	//ORDENES Y REMISIONES
	{	
		
		$archivo='tmp/5HC'.$numcita.'-'.$paciente.'.txt';
		//echo $archivo;
		$a="5|";
		$a.="claseorden|";
		$a.="$claseorden\n";
		$p=fopen($archivo,"a");
		if($p)
		{
			fputs($p,$a);
		}			
		$a="5|";
		$a.="codorden|";
		$a.="$codorden\n";
		$p=fopen($archivo,"a");
		if($p)
		{
			fputs($p,$a);
		}			
		$a="5|";
		$a.="desorden|";
		$a.="$desorden\n";
		$p=fopen($archivo,"a");
		if($p)
		{
			fputs($p,$a);
		}	
		$a="5|";
		$a.="nivel|";
		$a.="$nivel\n";
		$p=fopen($archivo,"a");
		if($p)
		{
			fputs($p,$a);
		}				
		$a="5|";
		$a.="obseorden|";
		$a.="$obseorden\n";
		$p=fopen($archivo,"a");
		if($p)
		{
			fputs($p,$a);
		}		
		$a="5|";
		$a.="diagorden|";
		$a.="$diagorden\n";
		$p=fopen($archivo,"a");
		if($p)
		{
			fputs($p,$a);
		}
		$a="5|";
		$a.="cantorden|";
		$a.="$cantorden\n";
		$p=fopen($archivo,"a");
		if($p)
		{
			fputs($p,$a);
		}	
		$a="5|";
		$a.="cama|";
		$a.="$cama\n";
		$p=fopen($archivo,"a");
		if($p)
		{
			fputs($p,$a);
		}
		if($guardapos==1)
		{
			$diagmedi=$diagorden;
			$codmedi=$codorden;
			if($sipos==1)
			{
				$archivos='tmp/posHC'.$numcita.'-'.$paciente.'.txt';
				$a="9|";
				$a.="diagmedi|";
				$a.="$diagmedi\n";
				$p=fopen($archivos,"a");
				if($p)
				{
					fputs($p,$a);
				}
				$a="9|";
				$a.="codmedi|";
				$a.="$codmedi\n";
				$p=fopen($archivos,"a");
				if($p)
				{
					fputs($p,$a);
				}
				$a="9|";
				$a.="diastrasoli|";
				$a.="$diastrasoli\n";
				$p=fopen($archivos,"a");
				if($p)
				{
					fputs($p,$a);
				}
				$a="9|";
				$a.="dosissoli|";
				$a.="$dosissoli\n";
				$p=fopen($archivos,"a");
				if($p)
				{
					fputs($p,$a);
				}
				$a="9|";
				$a.="cproa|";
				$a.="$cproa\n";
				$p=fopen($archivos,"a");
				if($p)
				{
					fputs($p,$a);
				}
				$a="9|";
				$a.="diastraequia|";
				$a.="$diastraequia\n";
				$p=fopen($archivos,"a");
				if($p)
				{
					fputs($p,$a);
				}
				$a="9|";
				$a.="dosisequia|";
				$a.="$dosisequia\n";
				$p=fopen($archivos,"a");
				if($p)
				{
					fputs($p,$a);
				}				
				$a="9|";
				$a.="cprob|";
				$a.="$cprob\n";
				$p=fopen($archivos,"a");
				if($p)
				{
					fputs($p,$a);
				}
				$a="9|";
				$a.="diastraequib|";
				$a.="$diastraequib\n";
				$p=fopen($archivos,"a");
				if($p)
				{
					fputs($p,$a);
				}
				$a="9|";
				$a.="dosisequib|";
				$a.="$dosisequib\n";
				$p=fopen($archivos,"a");
				if($p)
				{
					fputs($p,$a);
				}
				$a="9|";
				$a.="fecdesde|";
				$a.="$fecdesde\n";
				$p=fopen($archivos,"a");
				if($p)
				{
					fputs($p,$a);
				}
				$a="9|";
				$a.="fechasta|";
				$a.="$fechasta\n";
				$p=fopen($archivos,"a");
				if($p)
				{
					fputs($p,$a);
				}
				$a="9|";
				$a.="tiempoesti|";
				$a.="$tiempoesti\n";
				$p=fopen($archivos,"a");
				if($p)
				{
					fputs($p,$a);
				}
				
				$a="9|";
				$a.="resumen|";
				$a.="$resumen\n";
				$p=fopen($archivos,"a");
				if($p)
				{
					fputs($p,$a);
				}
				
				$a="9|";
				$a.="riesgo|";
				$a.="$riesgo\n";
				$p=fopen($archivos,"a");
				if($p)
				{
					fputs($p,$a);
				}
				$a="9|";
				$a.="tiponopos|";
				$a.="$tiponopos\n";
				$p=fopen($archivos,"a");
				if($p)
				{
					fputs($p,$a);
				}
				$a="9|";
				$a.="biblio|";
				$a.="$biblio\n";
				$p=fopen($archivos,"a");
				if($p)
				{
					fputs($p,$a);
				}		
				if($tipodoc!='')
				{
					include ('php/conexion1.php');	
					mysql_query("UPDATE medicos SET tido_medi ='$tipodoc' WHERE cod_medi='$Gcod_mediconh'");
				
				}
			}
			if($solquiro=='S' && $pideuni=='S')
			{
				$archivoquiro='tmp/ciruHC'.$numcita.'-'.$paciente.'.txt';
				$a="9|";
				$a.="diagmedi|";
				$a.="$diagmedi\n";
				$p=fopen($archivoquiro,"a");
				if($p)
				{
					fputs($p,$a);
				}
				$a="9|";
				$a.="codmedi|";
				$a.="$codmedi\n";
				$p=fopen($archivoquiro,"a");
				if($p)
				{
					fputs($p,$a);
				}
				$a="9|";
				$a.="cirugia|";
				$a.="$cirugia\n";
				$p=fopen($archivoquiro,"a");
				if($p)
				{
					fputs($p,$a);
				}
				$a="9|";
				$a.="anestesia|";
				$a.="$anestesia\n";
				$p=fopen($archivoquiro,"a");
				if($p)
				{
					fputs($p,$a);
				}
				$a="9|";
				$a.="fecciru|";
				$a.="$fecciru\n";
				$p=fopen($archivoquiro,"a");
				if($p)
				{
					fputs($p,$a);
				}
				$a="9|";
				$a.="hora|";
				$a.="$hora\n";
				$p=fopen($archivoquiro,"a");
				if($p)
				{
					fputs($p,$a);
				}
				$a="9|";
				$a.="minu|";
				$a.="$minu\n";
				$p=fopen($archivoquiro,"a");
				if($p)
				{
					fputs($p,$a);
				}
				$a="9|";
				$a.="tiho|";
				$a.="$tiho\n";
				$p=fopen($archivoquiro,"a");
				if($p)
				{
					fputs($p,$a);
				}
				$a="9|";
				$a.="requiayudante|";
				$a.="$requiayudante\n";
				$p=fopen($archivoquiro,"a");
				if($p)
				{
					fputs($p,$a);
				}				
				$a="9|";
				$a.="sangre|";
				$a.="$sangre\n";
				$p=fopen($archivoquiro,"a");
				if($p)
				{
					fputs($p,$a);
				}				
				$a="9|";
				$a.="requiequi|";
				$a.="$requiequi\n";
				$p=fopen($archivoquiro,"a");
				if($p)
				{
					fputs($p,$a);
				}				
				$a="9|";
				$a.="duracion|";
				$a.="$duracion\n";
				$p=fopen($archivoquiro,"a");
				if($p)
				{
					fputs($p,$a);
				}				
				$a="9|";
				$a.="unidura|";
				$a.="$unidura\n";
				$p=fopen($archivoquiro,"a");
				if($p)
				{
					fputs($p,$a);
				}				
				$a="9|";
				$a.="resuci|";
				$a.="$resuci\n";
				$p=fopen($archivoquiro,"a");
				if($p)
				{
					fputs($p,$a);
				}				
				$a="9|";
				$a.="requimate|";
				$a.="$requimate\n";
				$p=fopen($archivoquiro,"a");
				if($p)
				{
					fputs($p,$a);
				}
				$a="9|";
				$a.="material|";
				$a.="$material\n";
				$p=fopen($archivoquiro,"a");
				if($p)
				{
					fputs($p,$a);
				}
                                $a="9|";
				$a.="consiste|";
				$a.="$consis\n";
				$p=fopen($archivoquiro,"a");
				if($p)
				{
					fputs($p,$a);
				}
                                $a="9|";
				$a.="riesgo|";
				$a.="$ries\n";
				$p=fopen($archivoquiro,"a");
				if($p)
				{
					fputs($p,$a);
				}
                                $a="9|";
				$a.="beneficios|";
				$a.="$benef\n";
				$p=fopen($archivoquiro,"a");
				if($p)
				{
					fputs($p,$a);
				}
						
			
			}
		}	
		echo"<body onload=salir('ordenes0.php')>";
		echo"</body>";
	}
	if ($codiprg==6)	//MEDICAMENTOS
	{		
		if($clasemedi=='1' || $clasemedi=='2')
		{
			if($codmedi!='' && $desmedi!='' && $canti !='')
			{	
				$archivo='tmp/6HC'.$numcita.'-'.$paciente.'.txt';			
				$a="6|";$a.="clasemedi|";$a.="$clasemedi\n";$p=fopen($archivo,"a");if($p){fputs($p,$a);}			
				$a="6|";$a.="codmedi|";$a.="$codmedi\n";$p=fopen($archivo,"a");if($p){fputs($p,$a);}			
				$a="6|";$a.="desmedi|";$a.="$desmedi\n";$p=fopen($archivo,"a");if($p){fputs($p,$a);}		
				$a="6|";$a.="dosis|";$a.="$dosis\n";$p=fopen($archivo,"a");if($p){fputs($p,$a);}
				$a="6|";$a.="unid|";$a.="$unid\n";$p=fopen($archivo,"a");if($p){fputs($p,$a);}	
				$a="6|";$a.="frecu|";$a.="$frecu\n";$p=fopen($archivo,"a");if($p){fputs($p,$a);}	
				$a="6|";$a.="unidfrecu|";$a.="$unidfrecu\n";$p=fopen($archivo,"a");if($p){fputs($p,$a);}
				$a="6|";$a.="via|";$a.="$via\n";$p=fopen($archivo,"a");if($p){fputs($p,$a);}
				$a="6|";$a.="tiempo|";$a.="$tiempo\n";$p=fopen($archivo,"a");if($p){fputs($p,$a);}
				$a="6|";$a.="obsemed|";$a.="$obsemed\n";$p=fopen($archivo,"a");if($p){fputs($p,$a);}
				$a="6|";$a.="canti|";$a.="$canti\n";$p=fopen($archivo,"a");if($p){fputs($p,$a);}		
				$a="6|";$a.="diagmedi|";$a.="$diagmedi\n";$p=fopen($archivo,"a");if($p){fputs($p,$a);}
				$a="6|";$a.="justifi|";$a.="$justifi\n";$p=fopen($archivo,"a");if($p){fputs($p,$a);}
				$a="6|";$a.="pos|";$a.="$pos\n";$p=fopen($archivo,"a");if($p){fputs($p,$a);}
				if($guardapos==1)
				{				
					$archivopos='tmp/posHC'.$numcita.'-'.$paciente.'.txt';
					$a="9|";$a.="diagmedi|";$a.="$diagmedi\n";$p=fopen($archivopos,"a");if($p){fputs($p,$a);}
					$a="9|";$a.="codmedi|";$a.="$codmedi\n";$p=fopen($archivopos,"a");if($p){fputs($p,$a);}
					$a="9|";$a.="diastrasoli|";$a.="$diastrasoli\n";$p=fopen($archivopos,"a");if($p){fputs($p,$a);}
					$a="9|";$a.="dosissoli|";$a.="$dosissoli\n";$p=fopen($archivopos,"a");if($p){fputs($p,$a);}				
					$a="9|";$a.="unidadpos|";$a.="$unidadpos\n";$p=fopen($archivopos,"a");if($p){fputs($p,$a);}				
					$a="9|";$a.="cproa|";$a.="$cproa\n";$p=fopen($archivopos,"a");if($p){fputs($p,$a);}
					$a="9|";$a.="diastraequia|";$a.="$diastraequia\n";$p=fopen($archivopos,"a");if($p){fputs($p,$a);}
					$a="9|";$a.="dosisequia|";$a.="$dosisequia\n";$p=fopen($archivopos,"a");if($p){fputs($p,$a);}				
					$a="9|";$a.="cprob|";$a.="$cprob\n";$p=fopen($archivopos,"a");if($p){fputs($p,$a);}
					$a="9|";$a.="diastraequib|";$a.="$diastraequib\n";$p=fopen($archivopos,"a");if($p){fputs($p,$a);}
					$a="9|";$a.="dosisequib|";$a.="$dosisequib\n";$p=fopen($archivopos,"a");if($p){fputs($p,$a);}
					$fecdesde=date('Y-m-d');
					$tiempo=86400*$diastrasoli;				
					$ani=substr($fecdesde,0,4);
					$mei=substr($fecdesde,5,2);
					$dii=substr($fecdesde,8,2);
					$tiem=gmmktime ( 0, 0, 0, $mei, $dii, $ani);
					$tie=$tiem+$tiempo;
					$fechasta=gmdate( "Y-m-d",$tie );
					$tiempoesti=$diastrasoli/30;
					$a="9|";$a.="fecdesde|";$a.="$fecdesde\n";$p=fopen($archivopos,"a");if($p){	fputs($p,$a);}
					$a="9|";$a.="fechasta|";$a.="$fechasta\n";$p=fopen($archivopos,"a");if($p){	fputs($p,$a);}
					$a="9|";$a.="tiempoesti|";$a.="$tiempoesti\n";$p=fopen($archivopos,"a");if($p){	fputs($p,$a);}
					$a="9|";$a.="resumen|";$a.="$resumen\n";$p=fopen($archivopos,"a");if($p){	fputs($p,$a);}
					$a="9|";$a.="riesgo|";$a.="$riesgo\n";$p=fopen($archivopos,"a");if($p){	fputs($p,$a);}
					if($clasemedi=='1')$tiponopos='M';
					if($clasemedi=='2')$tiponopos='D';
					$a="9|";$a.="tiponopos|";$a.="$tiponopos\n";$p=fopen($archivopos,"a");if($p){	fputs($p,$a);}
					$a="9|";$a.="biblio|";$a.="$biblio\n";$p=fopen($archivopos,"a");if($p){	fputs($p,$a);}		
				}
				if($tipodoc!='')
				{
					include ('php/conexion1.php');	
					mysql_query("UPDATE medicos SET tido_medi ='$tipodoc' WHERE cod_medi='$Gcod_mediconh'");
				}
			}
			$archivo='tmp/7HC'.$numcita.'-'.$paciente.'.txt';
			if(file_exists($archivo)==TRUE)
			{
				unlink ($archivo);
			}
			$a="7|";
			$a.="repetir|";
			$a.="$repetir\n";
			$p=fopen($archivo,"a");
			if($p)
			{
				fputs($p,$a);
			}	
			echo"<body onload=salir('medica0.php')>";
			echo"</body>";
		}
		
		if($clasemedi=='3')
		{		 	
			if($protoco=='')
			{
			
				$intervalo=$intervalo1.' '.$intervalo2;
				$duracion_tratamiento=$duracion_tratamiento1.' '.$duracion_tratamiento2;
				$archivonco='tmp/medonco'.$numcita.'-'.$paciente.'.txt';						
				$a="19|";$a.="dosis_teorica|";$a.="$dosis_teorica\n";$p=fopen($archivonco,"a");if($p){fputs($p,$a);}
				$a="19|";$a.="unid_dt|";$a.="$unid_dt\n";$p=fopen($archivonco,"a");if($p){fputs($p,$a);}
				$a="19|";$a.="dosis_resultante|";$a.="$dosis_resultante\n";$p=fopen($archivonco,"a");if($p){fputs($p,$a);}
				$a="19|";$a.="unid_dr|";$a.="$unid_dr\n";$p=fopen($archivonco,"a");if($p){fputs($p,$a);}
				$a="19|";$a.="porcentaje_ajuste|";$a.="$porcentaje_ajuste\n";$p=fopen($archivonco,"a");if($p){fputs($p,$a);}
				$a="19|";$a.="dosis_definitiva|";$a.="$dosis_definitiva\n";$p=fopen($archivonco,"a");if($p){fputs($p,$a);}
				$a="19|";$a.="unid_dd|";$a.="$unid_dd\n";$p=fopen($archivonco,"a");if($p){fputs($p,$a);}
				$a="19|";$a.="via_administracion|";$a.="$via_administracion\n";$p=fopen($archivonco,"a");if($p){fputs($p,$a);}
				$a="19|";$a.="vehiculo|";$a.="$vehiculo\n";$p=fopen($archivonco,"a");if($p){fputs($p,$a);}
				$a="19|";$a.="volumen|";$a.="$volumen\n";$p=fopen($archivonco,"a");if($p){fputs($p,$a);}
				$a="19|";$a.="duracion_infusion|";$a.="$duracion_infusion\n";$p=fopen($archivonco,"a");if($p){fputs($p,$a);}
				$a="19|";$a.="frecuencia|";$a.="$frecuencia\n";$p=fopen($archivonco,"a");if($p){fputs($p,$a);}
				$a="19|";$a.="intervalo|";$a.="$intervalo\n";$p=fopen($archivonco,"a");if($p){fputs($p,$a);}
				$a="19|";$a.="duracion_tratamiento|";$a.="$duracion_tratamiento\n";$p=fopen($archivonco,"a");if($p){fputs($p,$a);}
				$a="19|";$a.="cod_mdi|";$a.="$cod_mdi\n";$p=fopen($archivonco,"a");if($p){fputs($p,$a);}
				$a="19|";$a.="desmedi|";$a.="$desmedi\n";$p=fopen($archivonco,"a");if($p){fputs($p,$a);}
				$a="19|";$a.="obsemed|";$a.="$obsemed\n";$p=fopen($archivonco,"a");if($p){fputs($p,$a);}
				$a="19|";$a.="cantidad|";$a.="$cantidad\n";$p=fopen($archivonco,"a");if($p){fputs($p,$a);}
				$a="19|";$a.="ciclo|";$a.="$ciclo\n";$p=fopen($archivonco,"a");if($p){fputs($p,$a);}
				echo "<input type=hidden name=ciclo value='$ciclo'>";
			}
			else
			{
				for($n=0;$n<$finonco;$n++)
				{
					$nomvar='cod_medica'.$n;
					$cod_medica=$$nomvar;
					$nomvar='nombrepro'.$n;
					$nombrepro=$$nomvar;
					$nomvar='tipo_medica'.$n;
					$tipo_medica=$$nomvar;
					$nomvar='dosis_teorica'.$n;
					$dosis_teorica=$$nomvar;
					$nomvar='und_dt'.$n;
					$unid_dt=$$nomvar;
					$nomvar='factor'.$n;
					$factor=$$nomvar;
					$nomvar='dosis_resultante'.$n;
					$dosis_resultante=$$nomvar;
					$nomvar='porcentaje_ajuste'.$n;
					$porcentaje_ajuste=$$nomvar;
					$nomvar='dosis_definitiva'.$n;
					$dosis_definitiva=$$nomvar;
					$nomvar='via_administracion'.$n;
					$via_administracion=$$nomvar;
					$nomvar='vehiculopro'.$n;
					$vehiculopro=$$nomvar;
					$nomvar='volumen_tto'.$n;
					$volumen_tto=$$nomvar;
					$nomvar='tiempo_infusionpro'.$n;
					$tiempo_infusionpro=$$nomvar;
					$nomvar='frecuencia'.$n;
					$frecuencia=$$nomvar;
					$nomvar='intervalo1p'.$n;
					$intervalo1p=$$nomvar;
					$nomvar='intervalo2p'.$n;
					$intervalo2p=$$nomvar;
					$nomvar="duracion_tratamientopro1".$n;
					$duracion_tratamientopro1=$$nomvar;
					$nomvar="duracion_tratamientopro2".$n;
					$duracion_tratamientopro2=$$nomvar;
					$nomvar="cantidadpro".$n;
					$cantidadpro=$$nomvar;
					$nomvar="obserpro".$n;
					$obsemed=$$nomvar;
					if($tipo_medica=='M')
					{
						$intervalo=$intervalo1p.' '.$intervalo2p;
						$duracion_tratamiento=$duracion_tratamientopro1.' '.$duracion_tratamientopro2;
						$archivonco='tmp/medonco'.$numcita.'-'.$paciente.'.txt';						
						$a="19|";$a.="dosis_teorica|";$a.="$dosis_teorica\n";$p=fopen($archivonco,"a");if($p){fputs($p,$a);}
						$a="19|";$a.="unid_dt|";$a.="$unid_dt\n";$p=fopen($archivonco,"a");if($p){fputs($p,$a);}
						$a="19|";$a.="dosis_resultante|";$a.="$dosis_resultante\n";$p=fopen($archivonco,"a");if($p){fputs($p,$a);}
						$a="19|";$a.="unid_dr|";$a.="$unid_dt\n";$p=fopen($archivonco,"a");if($p){fputs($p,$a);}
						$a="19|";$a.="porcentaje_ajuste|";$a.="$porcentaje_ajuste\n";$p=fopen($archivonco,"a");if($p){fputs($p,$a);}
						$a="19|";$a.="dosis_definitiva|";$a.="$dosis_definitiva\n";$p=fopen($archivonco,"a");if($p){fputs($p,$a);}
						$a="19|";$a.="unid_dd|";$a.="$unid_dt\n";$p=fopen($archivonco,"a");if($p){fputs($p,$a);}
						$a="19|";$a.="via_administracion|";$a.="$via_administracion\n";$p=fopen($archivonco,"a");if($p){fputs($p,$a);}
						$a="19|";$a.="vehiculo|";$a.="$vehiculopro\n";$p=fopen($archivonco,"a");if($p){fputs($p,$a);}
						$a="19|";$a.="volumen|";$a.="$volumen_tto\n";$p=fopen($archivonco,"a");if($p){fputs($p,$a);}
						$a="19|";$a.="duracion_infusion|";$a.="$tiempo_infusionpro\n";$p=fopen($archivonco,"a");if($p){fputs($p,$a);}
						$a="19|";$a.="frecuencia|";$a.="$frecuencia\n";$p=fopen($archivonco,"a");if($p){fputs($p,$a);}
						$a="19|";$a.="intervalo|";$a.="$intervalo\n";$p=fopen($archivonco,"a");if($p){fputs($p,$a);}
						$a="19|";$a.="duracion_tratamiento|";$a.="$duracion_tratamiento\n";$p=fopen($archivonco,"a");if($p){fputs($p,$a);}
						$a="19|";$a.="cod_mdi|";$a.="$cod_medica\n";$p=fopen($archivonco,"a");if($p){fputs($p,$a);}
						$a="19|";$a.="desmedi|";$a.="$nombrepro\n";$p=fopen($archivonco,"a");if($p){fputs($p,$a);}
						$a="19|";$a.="obsemed|";$a.="$obsemed\n";$p=fopen($archivonco,"a");if($p){fputs($p,$a);}
						$a="19|";$a.="cantidad|";$a.="$cantidadpro\n";$p=fopen($archivonco,"a");if($p){fputs($p,$a);}
						$a="19|";$a.="ciclo|";$a.="$ciclo\n";$p=fopen($archivonco,"a");if($p){fputs($p,$a);}
						echo "<input type=hidden name=ciclo value='$ciclo'>";
					}
					if($tipo_medica=='P')
					{
						$archivo='tmp/6HC'.$numcita.'-'.$paciente.'.txt';			
						$a="6|";$a.="clasemedi|";$a.="$clasemedi\n";$p=fopen($archivo,"a");if($p){fputs($p,$a);}			
						$a="6|";$a.="codmedi|";$a.="$cod_medica\n";$p=fopen($archivo,"a");if($p){fputs($p,$a);}			
						$a="6|";$a.="desmedi|";$a.="$nombrepro\n";$p=fopen($archivo,"a");if($p){fputs($p,$a);}		
						$a="6|";$a.="dosis|";$a.="$dosis\n";$p=fopen($archivo,"a");if($p){fputs($p,$a);}
						$a="6|";$a.="unid|";$a.="$unid\n";$p=fopen($archivo,"a");if($p){fputs($p,$a);}	
						$a="6|";$a.="frecu|";$a.="$frecu\n";$p=fopen($archivo,"a");if($p){fputs($p,$a);}	
						$a="6|";$a.="unidfrecu|";$a.="$unidfrecu\n";$p=fopen($archivo,"a");if($p){fputs($p,$a);}
						$a="6|";$a.="via|";$a.="$via\n";$p=fopen($archivo,"a");if($p){fputs($p,$a);}
						$a="6|";$a.="tiempo|";$a.="$tiempo\n";$p=fopen($archivo,"a");if($p){fputs($p,$a);}
						$a="6|";$a.="obsemed|";$a.="$obsemed\n";$p=fopen($archivo,"a");if($p){fputs($p,$a);}
						$a="6|";$a.="canti|";$a.="$cantidadpro\n";$p=fopen($archivo,"a");if($p){fputs($p,$a);}		
						$a="6|";$a.="diagmedi|";$a.="$diagmedi\n";$p=fopen($archivo,"a");if($p){fputs($p,$a);}
						$a="6|";$a.="justifi|";$a.="$justifi\n";$p=fopen($archivo,"a");if($p){fputs($p,$a);}
						$a="6|";$a.="pos|";$a.="$pos\n";$p=fopen($archivo,"a");if($p){fputs($p,$a);}
					}
				}
			}		
		}
		echo"<body onload=salir('medica0.php')>";
		echo"</body>";	
	}
	if ($codiprg==18)		//TRANSCRIPCION FORMULA
	{
		$archivomt='tmp/medtraHC'.$numcita.'-'.$paciente.'.txt';		
		if(file_exists($archivomt)==TRUE)
		{
			unlink ($archivomt);
		}
		$a="0|";
		$a.="transcripcion|";
		$a.="$transcripcion\n";
		$p=fopen($archivomt,"a");
		if($p)
		{
			fputs($p,$a);
		}
		$a="0|";
		$a.="medtratante|";
		$a.="$medtratante\n";
		$p=fopen($archivomt,"a");
		if($p)
		{
			fputs($p,$a);
		}
		$a="0|";
		$a.="espetratante|";
		$a.="$espetratante\n";
		$p=fopen($archivomt,"a");
		if($p)
		{
			fputs($p,$a);
		}
		echo"<body onload=salir('medica0.php')>";
		echo"</body>";	
	}
	if ($codiprg==8)		//RECOMENDACIONES
	{		
		$archivo='tmp/8HC'.$numcita.'-'.$paciente.'.txt';		
		if(file_exists($archivo)==TRUE)
		{
			unlink ($archivo);
		}	
		$analpv=str_replace( chr(10), "Æ", $analpv);
		
		$a="8|";
		$a.="tiproxi|";
		$a.="$tiproxi\n";
		$p=fopen($archivo,"a");
		if($p)
		{
			fputs($p,$a);
		}
		
		$a="8|";
		$a.="proxima|";
		$a.="$proxima\n";
		$p=fopen($archivo,"a");
		if($p)
		{
			fputs($p,$a);
		}
		$a="8|";
		$a.="recom|";
		$a.="$recom\n";
		$p=fopen($archivo,"a");
		if($p)
		{
			fputs($p,$a);
		}
		$a="8|";
		$a.="incapacidad|";
		$a.="$incapacidad\n";
		$p=fopen($archivo,"a");
		if($p)
		{
			fputs($p,$a);
		}
		$a="8|";
		$a.="incadias|";
		$a.="$incadias\n";
		$p=fopen($archivo,"a");
		if($p)
		{
			fputs($p,$a);
		}
		$a="8|";
		$a.="incaini|";
		$a.="$incaini\n";
		$p=fopen($archivo,"a");
		if($p)
		{
			fputs($p,$a);
		}		
		/*
		$frase = strtok ($recetario,"\n");		
		$recetario='';		
		while ($frase) 
		{	
			$recetario=$recetario.$frase.'Æ';			
			$frase = strtok ("\n");				
			$n++;	
		}			
		*/
		$recom=str_replace( chr(10), "Æ", $recom);		
		$recetario=$receta;
		$a="8|";
		$a.="recom|";
		$a.="$recom\n";
		$p=fopen($archivo,"a");
		if($p)
		{
			fputs($p,$a);
		}		
		echo"<body onload=salir('contrare0.php')>
		</body>";
	}
	
	if($codiprg=='inca') //INCAPACIDAD
	{
		$archivo='tmp/incaHC'.$numcita.'-'.$paciente.'.txt';		
		if(file_exists($archivo)==TRUE)
		{
			unlink ($archivo);
		}	
		//$analpv=str_replace( chr(10), "Æ", $analpv);
		
		$a="8|";$a.="tipoafi|";$a.="$tipoafi\n";$p=fopen($archivo,"a");if($p){fputs($p,$a);}
		$a="8|";$a.="depar|";$a.="$depar\n";$p=fopen($archivo,"a");if($p){fputs($p,$a);}
		$a="8|";$a.="munilabor|";$a.="$munilabor\n";$p=fopen($archivo,"a");if($p){fputs($p,$a);}
		$a="8|";$a.="colegio|";$a.="$colegio\n";$p=fopen($archivo,"a");if($p){fputs($p,$a);}
		$a="8|";$a.="areaespe|";$a.="$areaespe\n";$p=fopen($archivo,"a");if($p){fputs($p,$a);}
		$a="8|";$a.="jornada|";$a.="$jornada\n";$p=fopen($archivo,"a");if($p){fputs($p,$a);}
		$a="8|";$a.="diasinca|";$a.="$diasinca\n";$p=fopen($archivo,"a");if($p){fputs($p,$a);}
		$a="8|";$a.="letras|";$a.="$letras\n";$p=fopen($archivo,"a");if($p){fputs($p,$a);}
		$a="8|";$a.="fecini|";$a.="$fecini\n";$p=fopen($archivo,"a");if($p){fputs($p,$a);}
		$a="8|";$a.="fecfin|";$a.="$fecfin\n";$p=fopen($archivo,"a");if($p){fputs($p,$a);}
		$a="8|";$a.="diaginca|";$a.="$diaginca\n";$p=fopen($archivo,"a");if($p){fputs($p,$a);}
		$a="8|";$a.="obseinca|";$a.="$obseinca\n";$p=fopen($archivo,"a");if($p){fputs($p,$a);}		
		$a="8|";$a.="tipolic|";$a.="$tipolic\n";$p=fopen($archivo,"a");if($p){fputs($p,$a);}
		$a="8|";$a.="fecparto|";$a.="$fecparto\n";$p=fopen($archivo,"a");if($p){fputs($p,$a);}
		
		echo"<body onload=salir('incapacidad0.php')>";
		echo"</body>";
	}
	
	if ($codiprg==10)	//TRIAGE
	{		
		$fechatri=date('Y-m-d');
		$horatri=date('H:i');
		include ('php/conexion1.php');
		$signos= mysql_query("UPDATE `triage_urgencias` SET `tear1_tri` = '$tenar1', `tear2_tri` = '$tenar2', `frre_tri` = '$freres',
		`frca_tri` = '$fc', `temp_tri` = '$tempe',`clas2_tri` = '$triage',`usua2_tri` = '$Gcod_mediconh',`fech_tri` = '$fechatri', 
		`hora_tri` = '$horatri',`moco_tri` = '$motivo',`mell_tri` = '$medio',`esco_tri` = '$estado', `dest_tri` = '$destino', 
		`obse_tri` = '$observa',`remi_tri` = '$remitido',`peso_tri` = '$peso', `talla_tri` = '$talla', 
		`pulso_tri` = '$pulso', `gluco_tri` = '$gluco', `fcf_tri` = '$fcf',tipo_tri='$chk_tpr',saox_tri='$pulso',
		dolr_tri='$chk_dlr',absx_tri='$chk_absx',mrsk_tri='$chk_tmch'		
		WHERE `iden_cita` = '$numcita'");
		
        //echo $signos;
		if($destino!='U')
		{
			$upcita=mysql_query("UPDATE `citas` SET `Esta_cita` = '2' WHERE `id_cita` ='$numcita'");		
		}
		$bnt=mysql_query("select * from triage_urgencias where `iden_cita` = '$numcita'");
		//echo $bnt;
		while($rbn=mysql_fetch_array($bnt))
		{
			$numtriage=$rbn['iden_tri'];
		}
		for($n=0;$n<$fincov;$n++)
		{
			$nomvar='codi'.$n;
			$codi=$$nomvar;	
			$nomvar='valor'.$n;
			$valor=$$nomvar;
			$incov=mysql_query("INSERT INTO `sintomas_covid` (`iden_sintomas` ,`iden_cita` ,`num_triaje` ,`num_histo` ,`cod_sintoma` ,`valor_sintoma`, `tipo_historia`)
			VALUES ( NULL , '$numcita', '$numtriage', NULL , '$codi', '$valor', 'T')");
		}		
		//echo $numtriage;
		echo"<body onload=salir1()>";
		echo"<input type=hidden name=numtriage value='$numtriage'>";
		echo"</body>";
	}	
	if ($codiprg==11)	//SOAP
	{		
		$archivo='tmp/11HC'.$numcita.'-'.$paciente.'.txt';		
		if(file_exists($archivo)==TRUE)
		{ 
			unlink ($archivo);
		}
		$a="1|";$a.="etnia|";$a.="$etnia\n";$p=fopen($archivo,"a");if($p){fputs($p,$a);}
		$a="1|";$a.="ocupacion|";$a.="$ocupacion\n";$p=fopen($archivo,"a");if($p){fputs($p,$a);}
		$a="1|";$a.="escolaridad|";$a.="$escolaridad\n";$p=fopen($archivo,"a");if($p){fputs($p,$a);}
		$a="1|";$a.="estadocivil|";$a.="$estadocivil\n";$p=fopen($archivo,"a");if($p){fputs($p,$a);}
		$a="1|";$a.="direccion|";$a.="$direccion\n";$p=fopen($archivo,"a");if($p){fputs($p,$a);}
		
		$a="1|";
		$a.="subjetivo|";
		$a.="$subjetivo\n";
		$p=fopen($archivo,"a");
		if($p)
		{
			fputs($p,$a);
		}
		$a="1|";
		$a.="objetivo|";
		$a.="$objetivo\n";
		$p=fopen($archivo,"a");
		if($p)
		{
			fputs($p,$a);
		}			
		$a="1|";
		$a.="analisis|";
		$a.="$analisis\n";
		$p=fopen($archivo,"a");
		if($p)
		{
			fputs($p,$a);
		}		
		if($concontrol==2)
		{
			echo"<body onload=salir('diagnos0.php')></body>";
		}
		else
		{
			echo"<body onload=salir('examen0.php')></body>";
		}
	}
	
	if ($codiprg==12)	//VALORACION DE LA FAMILIA
	{		
		$archivo='tmp/12HC'.$numcita.'-'.$paciente.'.txt';		
		if(file_exists($archivo)==TRUE)
		{
			unlink ($archivo);
		}		
		$a="12|";
		$a.="apgar1|";
		$a.="$apgar1\n";
		$p=fopen($archivo,"a");
		if($p)
		{
			fputs($p,$a);
		}
		$a="12|";
		$a.="apgar2|";
		$a.="$apgar2\n";
		$p=fopen($archivo,"a");
		if($p)
		{
			fputs($p,$a);
		}			
		$a="12|";
		$a.="apgar3|";
		$a.="$apgar3\n";
		$p=fopen($archivo,"a");
		if($p)
		{
			fputs($p,$a);
		}
		$a="12|";
		$a.="apgar4|";
		$a.="$apgar4\n";
		$p=fopen($archivo,"a");
		if($p)
		{
			fputs($p,$a);
		}
		$a="12|";
		$a.="apgar5|";
		$a.="$apgar5\n";
		$p=fopen($archivo,"a");
		if($p)
		{
			fputs($p,$a);
		}		
		$a="12|";
		$a.="httotal1|";
		$a.="$httotal1\n";
		$p=fopen($archivo,"a");
		if($p)
		{
			fputs($p,$a);
		}		
		$a="12|";
		$a.="apgarpunta|";
		$a.="$apgarpunta\n";
		$p=fopen($archivo,"a");
		if($p)
		{
			fputs($p,$a);
		}
		$a="12|";
		$a.="apgarseve|";
		$a.="$apgarseve\n";
		$p=fopen($archivo,"a");
		if($p)
		{
			fputs($p,$a);
		}		
		$a="12|";
		$a.="apgaracci|";
		$a.="$apgaracci\n";
		$p=fopen($archivo,"a");
		if($p)
		{
			fputs($p,$a);
		}
		$a="12|";
		$a.="apgarfrec|";
		$a.="$apgarfrec\n";
		$p=fopen($archivo,"a");
		if($p)
		{
			fputs($p,$a);
		} 		
		$a="12|";
		$a.="phq1|";
		$a.="$phq1\n";
		$p=fopen($archivo,"a");
		if($p)
		{
			fputs($p,$a);
		}
		$a="12|";
		$a.="phq2|";
		$a.="$phq2\n";
		$p=fopen($archivo,"a");
		if($p)
		{
			fputs($p,$a);
		}		
		$a="12|";
		$a.="phq3|";
		$a.="$phq3\n";
		$p=fopen($archivo,"a");
		if($p)
		{
			fputs($p,$a);
		}
		$a="12|";
		$a.="phq4|";
		$a.="$phq4\n";
		$p=fopen($archivo,"a");
		if($p)
		{
			fputs($p,$a);
		}
		$a="12|";
		$a.="phq5|";
		$a.="$phq5\n";
		$p=fopen($archivo,"a");
		if($p)
		{
			fputs($p,$a);
		}
		$a="12|";
		$a.="phq6|";
		$a.="$phq6\n";
		$p=fopen($archivo,"a");
		if($p)
		{
			fputs($p,$a);
		}
		$a="12|";
		$a.="phq7|";
		$a.="$phq7\n";
		$p=fopen($archivo,"a");
		if($p)
		{
			fputs($p,$a);
		}
		$a="12|"; 
		$a.="phq8|";
		$a.="$phq8\n";
		$p=fopen($archivo,"a");
		if($p)
		{
			fputs($p,$a);
		}
		$a="12|";
		$a.="phq9|";
		$a.="$phq9\n";
		$p=fopen($archivo,"a");
		if($p)
		{
			fputs($p,$a);
		}
		$a="12|";
		$a.="httotal2|";
		$a.="$httotal2\n";
		$p=fopen($archivo,"a");
		if($p)
		{
			fputs($p,$a);
		}
		$a="12|";
		$a.="phqpunta|";
		$a.="$phqpunta\n";
		$p=fopen($archivo,"a");
		if($p)
		{
			fputs($p,$a);
		}
		$a="12|";
		$a.="phqseve|";
		$a.="$phqseve\n";
		$p=fopen($archivo,"a");
		if($p)
		{
			fputs($p,$a);
		}
		$a="12|";
		$a.="phqacci|";
		$a.="$phqacci\n";
		$p=fopen($archivo,"a");
		if($p)
		{
			fputs($p,$a);
		}
		$a="12|";
		$a.="phqfrec|";
		$a.="$phqfrec\n";
		$p=fopen($archivo,"a");
		if($p)
		{
			fputs($p,$a);
		}
		echo"<body onload=salir('ordenes0.php')>
		</body>";
//LA FUNCION DE RETORMNO ES SALIR
		//echo"<body onload=salir8('valfamilia1.php')></body>";
/*		
		if($concontrol==2)
		{
			echo"<body onload=salir('diagnos0.php')></body>";
		}
		else
		{
			echo"<body onload=salir('examen0.php')>
			</body>";
		}
*/		
	}
        
    if ($codiprg==13)		//Conducta Referencia/Contrareferencia(anexos 9-10)
	{		
            $archivo='tmp/13HC'.$numcita.'-'.$paciente.'.txt';
            echo $archivo;
            if(file_exists($archivo)==TRUE)
            {
                unlink ($archivo);
            }				
            //$analpv=str_replace( chr(10), "Æ", $analpv);
            $a="13|";
            $a.="tipo_ref|";
            $a.="$tipo_ref\n";
            $p=fopen($archivo,"a");
            if($p)
            {
                fputs($p,$a);
            }
            $a="13|";
            $a.="resumen|";
            $a.="$resumen\n";
            $p=fopen($archivo,"a");
            if($p)
            {
                fputs($p,$a);
            }		
            echo"<body onload=salir('captura_anexos.php')>
            </body>";
	}
	
	if ($codiprg=="juntam")		//Conducta Referencia/Contrareferencia(anexos 9-10)
	{		
            $archivo='tmp/juntam'.$numcita.'-'.$paciente.'.txt';
            			
            //$analpv=str_replace( chr(10), "Æ", $analpv);
            $a="jm|";
            $a.="nommedico|";
            $a.="$nommedico\n";
            $p=fopen($archivo,"a");
            if($p)
            {
                fputs($p,$a);
            }
			
			$a="jm|";
            $a.="espmedico|";
            $a.="$espmedico\n";
            $p=fopen($archivo,"a");
            if($p)
            {
                fputs($p,$a);
            }
			
            $a="jm|";
            $a.="regmedico|";
            $a.="$regmedico\n";
            $p=fopen($archivo,"a");
            if($p)
            {
                fputs($p,$a);
            }		
            echo"<body onload=salir('junta_medica.php')>
            </body>";
	}
	
	echo"<form>";
?>

</HTML>
