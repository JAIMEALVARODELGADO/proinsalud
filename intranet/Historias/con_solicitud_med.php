<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<link rel="stylesheet" type="text/css" media="all" href="java/calendar/calendar-blue.css" title="win2k-cold-1" />  
<script type="text/javascript" src="java/calendar/calendar.js"></script> 
<script type="text/javascript" src="java/calendar/lang/calendar-es.js"></script> 
<script type="text/javascript" src="java/calendar/calendar-setup.js"></script>
<script language=javascript>
function cambio()
{	
	valor=(document.documentElement.scrollTop+document.body.scrollTop);
	uno.punto.value=valor;
	uno.target='';
	uno.action='con_solicitud_med.php';
	uno.submit()
}
function busca(n)
{	
	val="uno.che"+n+".checked";
	f=uno.fin.value;
	if(eval(val)==true)
	{
		for(i=0;i<f;i++)
		{
			if(i!=n)
			{
				ch="uno.che"+i+".checked=false";
				eval(ch);
			}
		}
	}
	valor=(document.documentElement.scrollTop+document.body.scrollTop);
	uno.punto.value=valor;
	uno.target='';
	uno.action='con_solicitud_med.php';
	uno.submit()
}
function entra()
{		
	var pos=uno.punto.value;	
	window.scrollTo(0,pos);	
}
function detalle(op,ing,pro)
{
	
	fini=uno.fecini.value;
	ffin=uno.fecfin.value;
	uno.target='';
	uno.action='con_solicitud_med.php';
	uno.submit()
	window.open("con_solicitud_med1.php?opcion="+op+"&ingreso="+ing+"&producto="+pro+"&fecini="+fini+"&fecfin="+ffin, "TOP", "Scrollbars=YES,height=550,width=1400,left=50,top=50");
	valor=(document.documentElement.scrollTop+document.body.scrollTop);
	uno.punto.value=valor;
}
</script>
</head>
<body onload='entra()'>
<style>
.sel{
font-size:12;
}
.tbl 
{
	border: 1px solid #bbbbff;
	border-collapse: collapse;
	empty-cells: show;
	background: #FFFFFF;
}
.tbl td 
{	
	font=-family: tahoma;
	color: #0240A3;
	font-size: 8pt;
	text-decoration: none;
	font-weight: 500;
	text-transform: uppercase;
	border: 1px solid #ya sub;
	padding:.3em .4em;	
}
.tbl th
{
	border: 1px solid #bbbbff;
	padding:.6em .8em;
	font=-family: tahoma;
	color: #0240A3;
	font-size: 8pt;
	text-decoration: none;
	font-weight: 700;
	text-transform: uppercase;
	background-Color:#E3E3ED;	
}

.tb2 
{
	border: 1px solid #bbbbff;
	border-collapse: collapse;
	empty-cells: show;
	background: #FFFFFF;

}
.tb2 td 
{	
	font=-family: tahoma;
	color: #0240A3;
	font-size: 8pt;
	text-decoration: none;
	font-weight: 500;
	text-transform: uppercase;
	border: 1px solid #ya sub;
	padding:.3em .4em;	
	background-Color:#F8F8F8;	
	
}
.tb2 th
{
	border: 1px solid #bbbbff;
	padding:.6em .8em;
	font=-family: tahoma;
	color: #0240A3;
	font-size: 8pt;
	text-decoration: none;
	font-weight: 700;
	text-transform: uppercase;	
}
</style>
<?
	foreach($_POST as $nombre_campo => $valor)
	{ 
	   $asignacion = "\$" . $nombre_campo . "='" . $valor . "';"; 
	   eval($asignacion); 
	}
	 foreach($_GET as $nombre_campo => $valor)
	{ 
	   $asignacion = "\$" . $nombre_campo . "='" . $valor . "';"; 
	   eval($asignacion); 
	}	
	set_time_limit (100);
    $fecha=(date("Y-m-d"));
    $hora=(date("H-i"));
	$link=Mysql_connect("localhost","root","");
	if(!$link)echo"no hay conexion";
	Mysql_select_db('proinsalud',$link);
	if(empty($fecini))$fecini=$fecha;
	if(empty($fecfin))$fecfin=$fecha;
	echo"<form name=uno method=post>
	<input type=hidden name=punto value='$punto'>
	<br>
	<table class='tbl' align=center>
	<tr>
	<th colspan=2>SEGUIMIENTO DE PRODUCTOS FARMACEUTICOS</td>	
	</tr>	
	<tr>	
	<th>FECHA INICIO</td>
	<th>FECHA FINAL</td>	
	</tr>
	<tr>	
	<td>
	";	
	?>
		<input type="text" name="fecini" class='caja' size="10" maxlength="10" value="<?echo $fecini;?>" id="fini" <?echo $disp;?>>
		<input type="button" class='caja' id="lanzador1" value="..." <?echo $disp;?>/>
		<!-- script que define y configura el calendario--> 
		<script type="text/javascript"> 
		Calendar.setup({ 
		inputField     :    "fini",     // id del campo de texto 
		ifFormat     :     "%Y-%m-%d",   // formato de la fecha que se escriba en el campo de texto 
		button     :    "lanzador1"     // el id del botn que lanzar el calendario 				
		}); 
		</script> 				
	<?		
	echo"
	</td>	
	<td>";
	?>
		<input type="text" name="fecfin" class='caja' size="10" maxlength="10" value="<?echo $fecfin;?>" id="ffin" <?echo $disp;?>>
		<input type="button" class='caja' id="lanzador2" value="..." <?echo $disp;?>/>
		<!-- script que define y configura el calendario--> 
		<script type="text/javascript"> 
		Calendar.setup({ 
		inputField     :    "ffin",     // id del campo de texto 
		ifFormat     :     "%Y-%m-%d",   // formato de la fecha que se escriba en el campo de texto 
		button     :    "lanzador2"     // el id del botn que lanzar el calendario 				
		}); 
		</script> 				
	<?		
	echo"</td>
	</tr>
	<tr><th colspan=3><input type=button value=buscar onclick='cambio()'>
	</td></tr>
	</table>
	<br>";

	$bpac=mysql_query("SELECT ingreso_hospitalario.id_ing, ingreso_hospitalario.codius_ing, usuario.NROD_USU, usuario.PNOM_USU, usuario.SNOM_USU, usuario.PAPE_USU, usuario.SAPE_USU, contrato.NEPS_CON, destipos_1.nomb_des AS area, destipos.nomb_des AS cama
	FROM ((((ingreso_hospitalario LEFT JOIN destipos ON ingreso_hospitalario.caac_ing = destipos.codi_des) INNER JOIN usuario ON ingreso_hospitalario.codius_ing = usuario.CODI_USU) LEFT JOIN contrato ON ingreso_hospitalario.contra_ing = contrato.CODI_CON) INNER JOIN movi_med ON ingreso_hospitalario.id_ing = movi_med.id_ing) INNER JOIN destipos AS destipos_1 ON destipos.val2_des = destipos_1.codi_des
	WHERE (((movi_med.fsol_mme)>='$fecini' And (movi_med.fsol_mme)<='$fecfin'))
	GROUP BY ingreso_hospitalario.id_ing, ingreso_hospitalario.codius_ing, usuario.NROD_USU, usuario.PNOM_USU, usuario.SNOM_USU, usuario.PAPE_USU, usuario.SAPE_USU, contrato.NEPS_CON, destipos_1.nomb_des, destipos.nomb_des
	ORDER BY destipos_1.nomb_des, destipos.nomb_des;
	");	
	echo "<table align=center class='tbl' cellpadding=2 border=1 bgcolor='#E3F2F2' width=95%>";
	echo "
	<tr align=center>
	<th>VER</td>
	<th>DOCUMENTO</td>
	<th>NOMBRE</td>
	<th>CONTRATO</td>
	<th>AREA</td>
	<th>CAMA</td>
	</tr>";	
	$n=0;
	while($rpac=mysql_fetch_array($bpac))
	{
		$ingreso=$rpac['id_ing'];
		$codusu=$rpac['codius_ing'];
		$cedula=$rpac['NROD_USU'];
		$nombre=$rpac['PNOM_USU'].' '.$rpac['SNOM_USU'].' '.$rpac['PAPE_USU'].' '.$rpac['SAPE_USU'];
		$contrato=$rpac['NEPS_CON'];
		$area=$rpac['area'];
		$cama=$rpac['cama'];
		$nomvar='che'.$n;
		$valor=$$nomvar;
		echo "
		<tr align=center>";
		if($valor==1)echo"<td><input type=checkbox checked name=$nomvar value='1' onclick='busca($n)'></td>";
		else echo"<td><input type=checkbox name=$nomvar value='1' onclick='busca($n)'></td>";
		echo"<td>$cedula</td>
		<td>$nombre</td>
		<td>$contrato</td>
		<td>$area</td>
		<td>$cama</td>
		</tr>";	
		if($valor==1)
		{
			echo"<tr>
			<td colspan=6>
			<br>
			<table align=center class='tb2' width=90% cellpadding=2 border=1 bgcolor='#E3F2F2'>
			<tr>
			<th>CODIGO</td>
			<th>PRODUCTO</td>
			<th><a href='#' onclick='detalle(1,$ingreso,0)'>SOLICITUD<a></td>
			<th><a href='#' onclick='detalle(2,$ingreso,0)'>DISPENSACION<a></td>
			<th><a href='#' onclick='detalle(3,$ingreso,0)'>RECEPCION<a></td>
			<th><a href='#' onclick='detalle(4,$ingreso,0)'>ADMINISTRACION<a></td>
			<th><a href='#' onclick='detalle(5,$ingreso,0)'>DEVOLUCION<a></td>
			<th>SALDO</td>
			<th>ACUMULADO</td>
			</tr>";		
			//solicitado
			//DROP TABLE `movimedtemp`
			$crea=mysql_query("CREATE TEMPORARY TABLE `movimedtemp` (
			`id_ing` INT(7)NOT NULL ,
			`codmed` VARCHAR(13)NOT NULL ,
			`nommed` VARCHAR(100)NOT NULL ,
			`soli` INT(4)NULL ,
			`disp` INT(4)NULL ,
			`reci` INT(4)NULL ,
			`admin` INT(4)NULL ,
			`devol` INT(4)NULL ,
			`sald` INT(4)NULL ,
			`saldsis` INT(4)NULL 
			) ENGINE=MYISAM");

			//solicitado
			$bus1=mysql_query("SELECT medicamentos2.codi_mdi, medicamentos2.nomb_mdi, medicamentos2.noco_mdi, forma_farmaceutica.desc_ffa, Sum(movi_med.ndso_mme) AS SumaDendso_mme
			FROM (medicamentos2 INNER JOIN (movi_med INNER JOIN hdet_med ON movi_med.iden_med = hdet_med.iden_med) ON medicamentos2.codi_mdi = hdet_med.codi_mdi) INNER JOIN forma_farmaceutica ON medicamentos2.coff_mdi = forma_farmaceutica.codi_ffa
			WHERE (((movi_med.fsol_mme)>='$fecini' And (movi_med.fsol_mme)<='$fecfin') AND ((movi_med.id_ing)='$ingreso'))
			GROUP BY medicamentos2.codi_mdi, medicamentos2.nomb_mdi, medicamentos2.noco_mdi, forma_farmaceutica.desc_ffa
			HAVING (((Sum(movi_med.ndso_mme))>0))");
			while($res1=mysql_fetch_array($bus1))
			{
				$codi=$res1['codi_mdi'];
				$medi=$res1['nomb_mdi'].' '.$res1['noco_mdi'].' '.$res1['desc_ffa'];
				$cant=$res1['SumaDendso_mme'];	
				$ins=mysql_query("insert into movimedtemp (id_ing, codmed, nommed, soli) values ('$ingreso','$codi','$medi','$cant')");
			}
			$bus1=mysql_query("SELECT insu_med.codi_ins, insu_med.desc_ins, Sum(movi_ins.caso_mov) AS SumaDecaso_mov
			FROM insu_med INNER JOIN movi_ins ON insu_med.codi_ins = movi_ins.codi_ins
			WHERE (((movi_ins.fsol_mov)>='$fecini' And (movi_ins.fsol_mov)<='$fecfin') AND ((movi_ins.id_ing)='$ingreso'))
			GROUP BY insu_med.codi_ins, insu_med.desc_ins
			HAVING (((Sum(movi_ins.caso_mov))>0))");
			while($res1=mysql_fetch_array($bus1))
			{
				$codi=$res1['codi_ins'];
				$medi=$res1['desc_ins'];
				$cant=$res1['SumaDecaso_mov'];	
				
				$bpro=mysql_query("select * from movimedtemp where codmed='$codi'");
				if(mysql_num_rows($bpro)>0)
				{
					$up=mysql_query("UPDATE movimedtemp SET soli ='$cant' WHERE codmed='$codi'");
				}
				else
				{				
					$ins=mysql_query("insert into movimedtemp (id_ing, codmed, nommed, soli) values ('$ingreso','$codi','$medi','$cant')");
				}
			}			

			//dispensado
			$bus1=mysql_query("SELECT medicamentos2.codi_mdi, medicamentos2.nomb_mdi, medicamentos2.noco_mdi, forma_farmaceutica.desc_ffa, Sum(movi_med.nddi_mme) AS SumaDenddi_mme
			FROM (medicamentos2 INNER JOIN (movi_med INNER JOIN hdet_med ON movi_med.iden_med = hdet_med.iden_med) ON medicamentos2.codi_mdi = hdet_med.codi_mdi) INNER JOIN forma_farmaceutica ON medicamentos2.coff_mdi = forma_farmaceutica.codi_ffa
			WHERE (((movi_med.fdis_mme)>='$fecini' And (movi_med.fdis_mme)<='$fecfin') AND ((movi_med.id_ing)='$ingreso'))
			GROUP BY medicamentos2.codi_mdi, medicamentos2.nomb_mdi, medicamentos2.noco_mdi, forma_farmaceutica.desc_ffa
			HAVING (((Sum(movi_med.nddi_mme))>0))");
			while($res1=mysql_fetch_array($bus1))
			{
				$codi=$res1['codi_mdi'];
				$medi=$res1['nomb_mdi'].' '.$res1['noco_mdi'].' '.$res1['desc_ffa'];
				$cant=$res1['SumaDenddi_mme'];
				$bpro=mysql_query("select * from movimedtemp where codmed='$codi'");
				if(mysql_num_rows($bpro)>0)
				{
					$up=mysql_query("UPDATE movimedtemp SET disp ='$cant' WHERE codmed='$codi'");
				}
				else
				{
					$ins=mysql_query("insert into movimedtemp (id_ing, codmed, nommed, disp) values ('$ingreso','$codi','$medi','$cant')");
				}
			}
			
			$bus1=mysql_query("SELECT insu_med.codi_ins, insu_med.desc_ins, Sum(movi_ins.cdfa_mov) AS SumaDecdfa_mov
			FROM insu_med INNER JOIN movi_ins ON insu_med.codi_ins = movi_ins.codi_ins
			WHERE (((movi_ins.fdis_mov)>='$fecini' And (movi_ins.fdis_mov)<='$fecfin') AND ((movi_ins.id_ing)='$ingreso'))
			GROUP BY insu_med.codi_ins, insu_med.desc_ins
			HAVING (((Sum(movi_ins.cdfa_mov))>0))");
			while($res1=mysql_fetch_array($bus1))
			{
				$codi=$res1['codi_ins'];
				$medi=$res1['desc_ins'];
				$cant=$res1['SumaDecdfa_mov'];
				$bpro=mysql_query("select * from movimedtemp where codmed='$codi'");
				if(mysql_num_rows($bpro)>0)
				{
					$up=mysql_query("UPDATE movimedtemp SET disp ='$cant' WHERE codmed='$codi'");
				}
				else
				{
					$ins=mysql_query("insert into movimedtemp (id_ing, codmed, nommed, disp) values ('$ingreso','$codi','$medi','$cant')");
				}
			}
			
			
			
			//recibido
			$bus1=mysql_query("SELECT medicamentos2.codi_mdi, medicamentos2.nomb_mdi, medicamentos2.noco_mdi, forma_farmaceutica.desc_ffa, Sum(recepcion_insu.cant_rec) AS SumaDecant_rec
			FROM recepcion_insu INNER JOIN (medicamentos2 INNER JOIN forma_farmaceutica ON medicamentos2.coff_mdi = forma_farmaceutica.codi_ffa) ON recepcion_insu.idin_rec = medicamentos2.codi_mdi
			WHERE (((recepcion_insu.fech_rec)>='$fecini' And (recepcion_insu.fech_rec)<='$fecfin') AND ((recepcion_insu.id_ing)='$ingreso'))
			GROUP BY medicamentos2.nomb_mdi, medicamentos2.noco_mdi, forma_farmaceutica.desc_ffa
			HAVING (((Sum(recepcion_insu.cant_rec))>=0))");
			while($res1=mysql_fetch_array($bus1))
			{
				$codi=$res1['codi_mdi'];
				$medi=$res1['nomb_mdi'].' '.$res1['noco_mdi'].' '.$res1['desc_ffa'];
				$cant=$res1['SumaDecant_rec'];
				$bpro=mysql_query("select * from movimedtemp where codmed='$codi'");
				if(mysql_num_rows($bpro)>0)
				{
					$up=mysql_query("UPDATE movimedtemp SET reci ='$cant' WHERE codmed='$codi'");
				}
				else
				{
					$ins=mysql_query("insert into movimedtemp (id_ing, codmed, nommed, reci) values ('$ingreso','$codi','$medi','$cant')");
				}				
			}
			
			$bus1=mysql_query("SELECT insu_med.codi_ins, insu_med.desc_ins, Sum(recepcion_insu.cant_rec) AS SumaDecant_rec
			FROM insu_med INNER JOIN recepcion_insu ON insu_med.codi_ins = recepcion_insu.idin_rec
			WHERE (((recepcion_insu.fech_rec)>='$fecini' And (recepcion_insu.fech_rec)<='$fecfin') AND ((recepcion_insu.id_ing)='$ingreso'))
			GROUP BY insu_med.codi_ins, insu_med.desc_ins
			HAVING (((Sum(recepcion_insu.cant_rec))>=0))");
			while($res1=mysql_fetch_array($bus1))
			{
				$codi=$res1['codi_ins'];
				$medi=$res1['desc_ins'];
				$cant=$res1['SumaDecant_rec'];
				$bpro=mysql_query("select * from movimedtemp where codmed='$codi'");
				if(mysql_num_rows($bpro)>0)
				{
					$up=mysql_query("UPDATE movimedtemp SET reci ='$cant' WHERE codmed='$codi'");
				}
				else
				{
					$ins=mysql_query("insert into movimedtemp (id_ing, codmed, nommed, reci) values ('$ingreso','$codi','$medi','$cant')");
				}				
			}
			
			//administrado
			$bus1=mysql_query("SELECT medicamentos2.codi_mdi,medicamentos2.nomb_mdi, medicamentos2.noco_mdi, forma_farmaceutica.desc_ffa, Sum(administra_insumo.cant_adi) AS SumaDecant_adi
			FROM administra_insumo INNER JOIN (medicamentos2 INNER JOIN forma_farmaceutica ON medicamentos2.coff_mdi = forma_farmaceutica.codi_ffa) ON administra_insumo.idin_adi = medicamentos2.codi_mdi
			WHERE (((administra_insumo.fech_adi)>='$fecini' And (administra_insumo.fech_adi)<='$fecfin') AND ((administra_insumo.id_ing)='$ingreso'))
			GROUP BY medicamentos2.nomb_mdi, medicamentos2.noco_mdi, forma_farmaceutica.desc_ffa
			HAVING (((Sum(administra_insumo.cant_adi))>0))");
			while($res1=mysql_fetch_array($bus1))
			{
				$codi=$res1['codi_mdi'];
				$medi=$res1['nomb_mdi'].' '.$res1['noco_mdi'].' '.$res1['desc_ffa'];
				$cant=$res1['SumaDecant_adi'];
				$bpro=mysql_query("select * from movimedtemp where codmed='$codi'");
				if(mysql_num_rows($bpro)>0)
				{
					$up=mysql_query("UPDATE movimedtemp SET admin ='$cant' WHERE codmed='$codi'");
				}
				else
				{
					$ins=mysql_query("insert into movimedtemp (id_ing, codmed, nommed, admin) values ('$ingreso','$codi','$medi','$cant')");
				}	
			}
			
			
			$bus1=mysql_query("SELECT insu_med.codi_ins, insu_med.desc_ins, Sum(administra_insumo.cant_adi) AS SumaDecant_adi
			FROM insu_med INNER JOIN administra_insumo ON insu_med.codi_ins = administra_insumo.idin_adi
			WHERE (((administra_insumo.fech_adi)>='$fecini' And (administra_insumo.fech_adi)<='$fecfin') AND ((administra_insumo.id_ing)='$ingreso'))
			GROUP BY insu_med.codi_ins, insu_med.desc_ins
			HAVING (((Sum(administra_insumo.cant_adi))>0))");
			while($res1=mysql_fetch_array($bus1))
			{
				$codi=$res1['codi_ins'];
				$medi=$res1['desc_ins'];
				$cant=$res1['SumaDecant_adi'];
				$bpro=mysql_query("select * from movimedtemp where codmed='$codi'");
				if(mysql_num_rows($bpro)>0)
				{
					$up=mysql_query("UPDATE movimedtemp SET admin ='$cant' WHERE codmed='$codi'");
				}
				else
				{
					$ins=mysql_query("insert into movimedtemp (id_ing, codmed, nommed, admin) values ('$ingreso','$codi','$medi','$cant')");
				}	
			}
			
	
	
			//devolucion
			$bus1=mysql_query("SELECT medicamentos2.codi_mdi,medicamentos2.nomb_mdi, medicamentos2.noco_mdi, forma_farmaceutica.desc_ffa, Sum(devol_insumos.cant_dev) AS SumaDecant_dev
			FROM devol_insumos INNER JOIN (medicamentos2 INNER JOIN forma_farmaceutica ON medicamentos2.coff_mdi = forma_farmaceutica.codi_ffa) ON devol_insumos.coin_dev = medicamentos2.codi_mdi
			WHERE (((devol_insumos.id_ing)='$ingreso') AND ((devol_insumos.fech_dev)>='$fecini' And (devol_insumos.fech_dev)<='$fecfin'))
			GROUP BY medicamentos2.nomb_mdi, medicamentos2.noco_mdi, forma_farmaceutica.desc_ffa
			HAVING (((Sum(devol_insumos.cant_dev))>0))");
			while($res1=mysql_fetch_array($bus1))
			{
				$codi=$res1['codi_mdi'];
				$medi=$res1['nomb_mdi'].' '.$res1['noco_mdi'].' '.$res1['desc_ffa'];
				$cant=$res1['SumaDecant_dev'];
				$bpro=mysql_query("select * from movimedtemp where codmed='$codi'");
				if(mysql_num_rows($bpro)>0)
				{
					$up=mysql_query("UPDATE movimedtemp SET devol ='$cant' WHERE codmed='$codi'");
				}
				else
				{
					$ins=mysql_query("insert into movimedtemp (id_ing, codmed, nommed, devol) values ('$ingreso','$codi','$medi','$cant')");
				}	
			}
			
			
			$bus1=mysql_query("SELECT insu_med.codi_ins, insu_med.desc_ins, Sum(devol_insumos.cant_dev) AS SumaDecant_dev
			FROM insu_med INNER JOIN devol_insumos ON insu_med.codi_ins = devol_insumos.coin_dev
			WHERE (((devol_insumos.id_ing)='$ingreso') AND ((devol_insumos.fech_dev)>='$fecini' And (devol_insumos.fech_dev)<='$fecfin'))
			GROUP BY insu_med.codi_ins, insu_med.desc_ins
			HAVING (((Sum(devol_insumos.cant_dev))>0))");
			while($res1=mysql_fetch_array($bus1))
			{
				$codi=$res1['codi_ins'];
				$medi=$res1['desc_ins'];
				$cant=$res1['SumaDecant_dev'];
				$bpro=mysql_query("select * from movimedtemp where codmed='$codi'");
				if(mysql_num_rows($bpro)>0)
				{
					$up=mysql_query("UPDATE movimedtemp SET devol ='$cant' WHERE codmed='$codi'");
				}
				else
				{
					$ins=mysql_query("insert into movimedtemp (id_ing, codmed, nommed, devol) values ('$ingreso','$codi','$medi','$cant')");
				}	
			}

		
			
			//saldo			
			
			
			//saldo sistema			
			$bus1=mysql_query("SELECT medicamentos2.codi_mdi, medicamentos2.nomb_mdi, medicamentos2.noco_mdi, forma_farmaceutica.desc_ffa, saldoinsumoxpac.entr_sxp, saldoinsumoxpac.sali_sxp
			FROM saldoinsumoxpac INNER JOIN (medicamentos2 INNER JOIN forma_farmaceutica ON medicamentos2.coff_mdi = forma_farmaceutica.codi_ffa) ON saldoinsumoxpac.idin_sxp = medicamentos2.codi_mdi
			WHERE (((saldoinsumoxpac.id_ing)='$ingreso'))");
			while($res1=mysql_fetch_array($bus1))
			{
				$codi=$res1['codi_mdi'];
				$medi=$res1['nomb_mdi'].' '.$res1['noco_mdi'].' '.$res1['desc_ffa'];
				$cant=$res1['entr_sxp']-$res1['sali_sxp'];
				$bpro=mysql_query("select * from movimedtemp where codmed='$codi'");
				if(mysql_num_rows($bpro)>0)
				{
					$up=mysql_query("UPDATE movimedtemp SET saldsis ='$cant' WHERE codmed='$codi'");
				}
				else
				{
					if($cant!=0)
					{
						$ins=mysql_query("insert into movimedtemp (id_ing, codmed, nommed, saldsis) values ('$ingreso','$codi','$medi','$cant')");
					}
				}				
			}
			$bus1=mysql_query("SELECT insu_med.codi_ins, insu_med.desc_ins, saldoinsumoxpac.entr_sxp, saldoinsumoxpac.sali_sxp
			FROM saldoinsumoxpac INNER JOIN insu_med ON saldoinsumoxpac.idin_sxp = insu_med.codi_ins
			WHERE (((saldoinsumoxpac.id_ing)='$ingreso'))");
			while($res1=mysql_fetch_array($bus1))
			{
				$codi=$res1['codi_ins'];
				$medi=$res1['desc_ins'];
				$cant=$res1['entr_sxp']-$res1['sali_sxp'];
				$bpro=mysql_query("select * from movimedtemp where codmed='$codi'");
				if(mysql_num_rows($bpro)>0)
				{
					$up=mysql_query("UPDATE movimedtemp SET saldsis ='$cant' WHERE codmed='$codi'");
				}
				else
				{
					if($cant!=0)
					{
					    $ins=mysql_query("insert into movimedtemp (id_ing, codmed, nommed, saldsis) values ('$ingreso','$codi','$medi','$cant')");
					}
				}			
			}			
			$bufin=mysql_query("select * from movimedtemp order by nommed");
			while($rfin=mysql_fetch_array($bufin))
			{			
				$codproduc=$rfin['codmed'];
				$produc=$rfin['nommed'];
				$solicito=$rfin['soli'];
				$dispensa=$rfin['disp'];
				$recepci=$rfin['reci'];
				$administra=$rfin['admin'];
				$devol=$rfin['devol'];
				$acumul=$rfin['saldsis'];
				$saldi=$recepci-$administra-$devol;
				echo"
				<tr>
				<td>$codproduc</td>
				<td>$produc</td>
				<td align=center><a href='#' onclick='detalle(1,$ingreso,\"$codproduc\")'>$solicito</a></td>
				<td align=center><a href='#' onclick='detalle(2,$ingreso,\"$codproduc\")'>$dispensa</a></td>
				<td align=center><a href='#' onclick='detalle(3,$ingreso,\"$codproduc\")'>$recepci</a></td>
				<td align=center><a href='#' onclick='detalle(4,$ingreso,\"$codproduc\")'>$administra</a></td>
				<td align=center><a href='#' onclick='detalle(5,$ingreso,\"$codproduc\")'>$devol</a></td>
				<td align=center>$saldi</td>
				<td align=center>$acumul</td>				
				</tr>";
			}			
			echo"			
			</table>
			<br>
			</td>
			</tr>";
		
		}
		
		$n++;
	}
	
	echo"</table>
	<input type=hidden name=fin value=$n>
	";	
	
	echo"<form>";
?>
</body>
</html>