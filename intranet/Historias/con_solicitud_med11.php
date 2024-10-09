<html>
<head>
<link rel="stylesheet" type="text/css" media="all" href="java/calendar/calendar-blue.css" title="win2k-cold-1" />  
<script type="text/javascript" src="java/calendar/calendar.js"></script> 
<script type="text/javascript" src="java/calendar/lang/calendar-es.js"></script> 
<script type="text/javascript" src="java/calendar/calendar-setup.js"></script> 
<link rel="stylesheet" href="style.css" type="text/css"/> 
<script language=javascript>
function cambio()
{		
	
	uno.target='';
	uno.action='con_solicitud_med1.php';
	uno.submit()
}

function orden(or)
{
	
	uno.ordenado.value=or;
	uno.target='';
	uno.action='con_solicitud_med1.php';
	uno.submit()
}
function salir()
{
	uno.target='TOP';
	uno.action='con_solicitud_med2.php';
	uno.submit()
}
</script>
</head>
<body>

<style>
.sel{
font-size:9;
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
	if($producto==0)$producto='';
	if(empty($cedula))$cedula=$ingreso;
	if($tipoconsul=='')$tipoconsul='1';
	echo"<form name=uno method=post>
	<input type=hidden name=ordenado value='$ordenado'>	
	<input type=hidden name=fecini value='$fecini'>
	<input type=hidden name=fecfin value='$fecfin'>	
	<input type=hidden name=horaini value='$horaini'>
	<input type=hidden name=minuini value='$minuini'>
	<input type=hidden name=horafin value='$horafin'>
	<input type=hidden name=minufin value='$minufin'>
	<input type=hidden name=fechorini value='$fechorini'>
	<input type=hidden name=fechorfin value='$fechorfin'>
	<input type=hidden name=opcion value='$opcion'>
	<br><br>";
	
	$crea=mysql_query("CREATE TEMPORARY TABLE `medsoltmp` (
	`fecsol` VARCHAR(10)NULL ,
	`horsol` VARCHAR(5)NULL ,
	`ususol` TEXT NULL ,
	`nomsol` VARCHAR(100)NULL ,
	`cedu` INT(7)NULL ,
	`nompac` VARCHAR(100)NULL ,
	`codmed` VARCHAR(13)NULL ,
	`prod` VARCHAR(100)NULL ,
	`canti` INT(4)NULL ,
	`servi` VARCHAR(100)NULL
	) ENGINE=MYISAM");
	

	if($opcion==1)	//SOLICITUD
	{		
		//medicamentos de movimed
		$ntab=mysql_query("INSERT INTO medsoltmp SELECT movi_med.fsol_mme AS fecsol, movi_med.hsol_mme AS horsol, movi_med.usso_mme AS ususol, movi_med.nomb_usu AS nomsol, movi_med.id_ing AS cedu, CONCAT(usuario.PAPE_USU,' ',usuario.SAPE_USU,' ',usuario.PNOM_USU,' ',usuario.SNOM_USU) AS nompac, medicamentos2.codi_mdi AS codmed, CONCAT(medicamentos2.nomb_mdi,' ',medicamentos2.noco_mdi,' ',forma_farmaceutica.desc_ffa) AS prod, movi_med.ndso_mme AS canti, destipos.nomb_des AS servi
		FROM (forma_farmaceutica INNER JOIN ((((movi_med INNER JOIN ingreso_hospitalario ON movi_med.id_ing = ingreso_hospitalario.id_ing) INNER JOIN usuario ON ingreso_hospitalario.codius_ing = usuario.CODI_USU) INNER JOIN hdet_med ON movi_med.iden_med = hdet_med.iden_med) INNER JOIN medicamentos2 ON hdet_med.codi_mdi = medicamentos2.codi_mdi) ON forma_farmaceutica.codi_ffa = medicamentos2.coff_mdi) INNER JOIN destipos ON movi_med.area_mme = destipos.valo_des
		WHERE (((concat(movi_med.fsol_mme,movi_med.hsol_mme))>='$fechorini' And (concat(movi_med.fsol_mme,movi_med.hsol_mme))<='$fechorfin') AND ((destipos.codt_des)='20'));
		");
		
				
		//insumos de insumed
		$ntab1=mysql_query("INSERT INTO medsoltmp SELECT movi_ins.fsol_mov  AS fecsol, movi_ins.hsol_mov AS horsol, movi_ins.emple_mov AS ususol, 
		movi_ins.nomb_usu AS nomsol, movi_ins.id_ing AS cedu, CONCAT(usuario.PAPE_USU,' ',usuario.SAPE_USU,' ',usuario.PNOM_USU,' ',usuario.SNOM_USU) AS nompac, 
		insu_med.codi_ins AS codmed, insu_med.desc_ins AS prod, movi_ins.caso_mov AS canti, destipos.nomb_des AS servi
		FROM (((movi_ins INNER JOIN ingreso_hospitalario ON movi_ins.id_ing = ingreso_hospitalario.id_ing) INNER JOIN usuario ON ingreso_hospitalario.codius_ing = usuario.CODI_USU) INNER JOIN insu_med ON movi_ins.codi_ins = insu_med.codi_ins) LEFT JOIN destipos ON movi_ins.area_mov = destipos.valo_des
		WHERE (((concat(movi_ins.fsol_mov,movi_ins.hsol_mov))>='$fechorini' And (concat(movi_ins.fsol_mov,movi_ins.hsol_mov))<='$fechorfin') AND ((destipos.codt_des)='20'))");
		//medicamentos de insumed
		$ntab2=mysql_query("insert into medsoltmp SELECT movi_ins.fsol_mov AS fecsol, movi_ins.hsol_mov AS horsol, movi_ins.emple_mov AS ususol, movi_ins.nomb_usu AS nomsol, movi_ins.id_ing AS cedu, CONCAT(usuario.PAPE_USU,' ',usuario.SAPE_USU,' ',usuario.PNOM_USU,' ',usuario.SNOM_USU) AS nompac, medicamentos2.codi_mdi AS codmed, CONCAT(medicamentos2.nomb_mdi,' ',medicamentos2.noco_mdi,' ',forma_farmaceutica.desc_ffa) AS prod, movi_ins.caso_mov AS canti, destipos.nomb_des AS servi
		FROM (forma_farmaceutica INNER JOIN (medicamentos2 INNER JOIN ((movi_ins INNER JOIN ingreso_hospitalario ON movi_ins.id_ing = ingreso_hospitalario.id_ing) INNER JOIN usuario ON ingreso_hospitalario.codius_ing = usuario.CODI_USU) ON medicamentos2.codi_mdi = movi_ins.codi_ins) ON forma_farmaceutica.codi_ffa = medicamentos2.coff_mdi) LEFT JOIN destipos ON movi_ins.area_mov = destipos.valo_des
		WHERE (((concat(movi_ins.fsol_mov,movi_ins.hsol_mov))>='$fechorini' And (concat(movi_ins.fsol_mov,movi_ins.hsol_mov))<='$fechorfin') AND ((destipos.codt_des)='20'))");
		$cad="SOLICITUD";
	}	
	if($opcion==2)	//DISPENSACION
	{		
		//medicamentos de movimed
		$ntab=mysql_query("insert into medsoltmp SELECT movi_med.fdis_mme AS fecsol, movi_med.hdis_mme AS horsol, movi_med.usdi_mme AS ususol, movi_med.nudi_mme AS nomsol, movi_med.id_ing AS cedu, CONCAT(usuario.PAPE_USU,' ',usuario.SAPE_USU,' ',usuario.PNOM_USU,' ',usuario.SNOM_USU) AS nompac, medicamentos2.codi_mdi AS codmed, CONCAT(medicamentos2.nomb_mdi,' ',medicamentos2.noco_mdi,' ',forma_farmaceutica.desc_ffa) AS prod, movi_med.nddi_mme AS canti, destipos.nomb_des AS servi
		FROM (forma_farmaceutica INNER JOIN ((((movi_med INNER JOIN ingreso_hospitalario ON movi_med.id_ing = ingreso_hospitalario.id_ing) INNER JOIN usuario ON ingreso_hospitalario.codius_ing = usuario.CODI_USU) INNER JOIN hdet_med ON movi_med.iden_med = hdet_med.iden_med) INNER JOIN medicamentos2 ON hdet_med.codi_mdi = medicamentos2.codi_mdi) ON forma_farmaceutica.codi_ffa = medicamentos2.coff_mdi) LEFT JOIN destipos ON movi_med.area_mme = destipos.valo_des
		WHERE (((concat(movi_med.fdis_mme,movi_med.hdis_mme))>='$fechorini' And (concat(movi_med.fdis_mme,movi_med.hdis_mme))<='$fechorfin') AND ((destipos.codt_des)='20'))");
		
		
		//insumos de insumed
		$ntab1=mysql_query("insert into medsoltmp SELECT movi_ins.fdis_mov AS fecsol, movi_ins.hodi_mov AS horsol, movi_ins.udis_mov AS ususol, movi_ins.nudi_mov AS nomsol, movi_ins.id_ing AS cedu, CONCAT(usuario.PAPE_USU,' ',usuario.SAPE_USU,' ',usuario.PNOM_USU,' ',usuario.SNOM_USU) AS nompac, insu_med.codi_ins AS codmed, insu_med.desc_ins AS prod, movi_ins.cdfa_mov AS canti, destipos.nomb_des AS servi
		FROM (((movi_ins INNER JOIN ingreso_hospitalario ON movi_ins.id_ing = ingreso_hospitalario.id_ing) INNER JOIN usuario ON ingreso_hospitalario.codius_ing = usuario.CODI_USU) INNER JOIN insu_med ON movi_ins.codi_ins = insu_med.codi_ins) LEFT JOIN destipos ON movi_ins.area_mov = destipos.valo_des
		WHERE (((concat(movi_ins.fdis_mov,movi_ins.hodi_mov))>='$fechorini' And (concat(movi_ins.fdis_mov,movi_ins.hodi_mov))<='$fechorfin') AND ((destipos.codt_des)='20'))");
		//medicamentos de insumed
		$ntab2=mysql_query("insert into medsoltmp SELECT movi_ins.fdis_mov AS fecsol, movi_ins.hodi_mov AS horsol, movi_ins.udis_mov AS ususol, movi_ins.nudi_mov AS nomsol, movi_ins.id_ing AS cedu, CONCAT(usuario.PAPE_USU,' ',usuario.SAPE_USU,' ',usuario.PNOM_USU,' ',usuario.SNOM_USU) AS nompac, medicamentos2.codi_mdi AS codmed, CONCAT(medicamentos2.nomb_mdi,' ',medicamentos2.noco_mdi,' ',forma_farmaceutica.desc_ffa) AS prod, movi_ins.cdfa_mov AS canti, destipos.nomb_des AS servi
		FROM (forma_farmaceutica INNER JOIN (medicamentos2 INNER JOIN ((movi_ins INNER JOIN ingreso_hospitalario ON movi_ins.id_ing = ingreso_hospitalario.id_ing) INNER JOIN usuario ON ingreso_hospitalario.codius_ing = usuario.CODI_USU) ON medicamentos2.codi_mdi = movi_ins.codi_ins) ON forma_farmaceutica.codi_ffa = medicamentos2.coff_mdi) INNER JOIN destipos ON movi_ins.area_mov = destipos.valo_des
		WHERE (((concat(movi_ins.fdis_mov,movi_ins.hodi_mov))>='$fechorini' And (concat(movi_ins.fdis_mov,movi_ins.hodi_mov))<='$fechorfin') AND ((destipos.codt_des)='20'))");
		$cad="DISPENSACION";
	}	
	if($opcion==3)	//RECEPCION
	{
		$ntab=mysql_query("insert into medsoltmp SELECT recepcion_insu.fech_rec AS fecsol, recepcion_insu.hora_rec AS horsol, recepcion_insu.usua_rec AS ususol, recepcion_insu.nomb_usu AS nomsol, recepcion_insu.id_ing AS cedu, CONCAT(usuario.PAPE_USU,' ',usuario.SAPE_USU,' ',usuario.PNOM_USU,' ',usuario.SNOM_USU) AS nompac, medicamentos2.codi_mdi AS codmed, CONCAT(medicamentos2.nomb_mdi,' ',medicamentos2.noco_mdi,' ',forma_farmaceutica.desc_ffa) AS prod, recepcion_insu.cant_rec AS canti, destipos.nomb_des AS servi
		FROM ((usuario INNER JOIN ((recepcion_insu INNER JOIN medicamentos2 ON recepcion_insu.idin_rec = medicamentos2.codi_mdi) INNER JOIN ingreso_hospitalario ON recepcion_insu.id_ing = ingreso_hospitalario.id_ing) ON usuario.CODI_USU = ingreso_hospitalario.codius_ing) INNER JOIN forma_farmaceutica ON medicamentos2.coff_mdi = forma_farmaceutica.codi_ffa) LEFT JOIN destipos ON recepcion_insu.area_rec = destipos.valo_des
		WHERE (((concat(recepcion_insu.fech_rec,recepcion_insu.hora_rec))>='$fechorini' And (concat(recepcion_insu.fech_rec,recepcion_insu.hora_rec))<='$fechorfin') AND ((recepcion_insu.tpin_rec)='M') AND ((destipos.codt_des)='20'))");
		
		
				
		$ntab1=mysql_query("insert into medsoltmp SELECT recepcion_insu.fech_rec AS fecsol, recepcion_insu.hora_rec AS horsol, recepcion_insu.usua_rec AS ususol, recepcion_insu.nomb_usu AS nomsol, recepcion_insu.id_ing AS cedu, CONCAT(usuario.PAPE_USU,' ',usuario.SAPE_USU,' ',usuario.PNOM_USU,' ',usuario.SNOM_USU) AS nompac, insu_med.codi_ins AS codmed, insu_med.desc_ins AS prod, recepcion_insu.cant_rec AS canti, destipos.nomb_des AS servi
		FROM ((usuario INNER JOIN (recepcion_insu INNER JOIN ingreso_hospitalario ON recepcion_insu.id_ing = ingreso_hospitalario.id_ing) ON usuario.CODI_USU = ingreso_hospitalario.codius_ing) INNER JOIN insu_med ON recepcion_insu.idin_rec = insu_med.codi_ins) LEFT JOIN destipos ON recepcion_insu.area_rec = destipos.valo_des
		WHERE (((concat(recepcion_insu.fech_rec,recepcion_insu.hora_rec))>='$fechorini' And (concat(recepcion_insu.fech_rec,recepcion_insu.hora_rec))<='$fechorfin') AND ((recepcion_insu.tpin_rec)='I') AND ((destipos.codt_des)='20'))");
		
		$cad="RECEPCION";
	
	}
	if($opcion==4)	//ADMINISTRACION
	{
				
		$ntab=mysql_query("insert into medsoltmp SELECT administra_insumo.fech_realadm AS fecsol, administra_insumo.hora_realadm AS horsol, administra_insumo.obse_adi AS ususol, administra_insumo.nomb_usu AS nomsol, administra_insumo.id_ing AS cedu, CONCAT(usuario.PAPE_USU,' ',usuario.SAPE_USU,' ',usuario.PNOM_USU,' ',usuario.SNOM_USU) AS nompac, medicamentos2.codi_mdi AS codmed, CONCAT(medicamentos2.nomb_mdi,' ',medicamentos2.noco_mdi,' ',forma_farmaceutica.desc_ffa) AS prod, administra_insumo.cant_adi AS canti, destipos_1.nomb_des AS servi
		FROM (((medicamentos2 INNER JOIN ((usuario INNER JOIN ingreso_hospitalario ON usuario.CODI_USU = ingreso_hospitalario.codius_ing) INNER JOIN administra_insumo ON ingreso_hospitalario.id_ing = administra_insumo.id_ing) ON medicamentos2.codi_mdi = administra_insumo.idin_adi) INNER JOIN forma_farmaceutica ON medicamentos2.coff_mdi = forma_farmaceutica.codi_ffa) LEFT JOIN destipos ON administra_insumo.cama_adi = destipos.codi_des) LEFT JOIN destipos AS destipos_1 ON destipos.valo_des = destipos_1.valo_des
		WHERE (((concat(administra_insumo.fech_realadm,administra_insumo.hora_realadm))>='$fechorini' And (concat(administra_insumo.fech_realadm,administra_insumo.hora_realadm))<='$fechorfin') AND ((administra_insumo.tpin_adi)='M') AND ((destipos.codt_des)='19') AND ((destipos_1.codt_des)='20'))");
		/*	
	ECHO"insert into medsoltmp SELECT administra_insumo.fech_realadm AS fecsol, administra_insumo.hora_realadm AS horsol, administra_insumo.obse_adi AS ususol, administra_insumo.nomb_usu AS nomsol, administra_insumo.id_ing AS cedu, CONCAT(usuario.PAPE_USU,' ',usuario.SAPE_USU,' ',usuario.PNOM_USU,' ',usuario.SNOM_USU) AS nompac, medicamentos2.codi_mdi AS codmed, CONCAT(medicamentos2.nomb_mdi,' ',medicamentos2.noco_mdi,' ',forma_farmaceutica.desc_ffa) AS prod, administra_insumo.cant_adi AS canti, destipos_1.nomb_des AS servi
		FROM (((medicamentos2 INNER JOIN ((usuario INNER JOIN ingreso_hospitalario ON usuario.CODI_USU = ingreso_hospitalario.codius_ing) INNER JOIN administra_insumo ON ingreso_hospitalario.id_ing = administra_insumo.id_ing) ON medicamentos2.codi_mdi = administra_insumo.idin_adi) INNER JOIN forma_farmaceutica ON medicamentos2.coff_mdi = forma_farmaceutica.codi_ffa) LEFT JOIN destipos ON administra_insumo.cama_adi = destipos.codi_des) LEFT JOIN destipos AS destipos_1 ON destipos.valo_des = destipos_1.valo_des
		WHERE (((concat(administra_insumo.fech_realadm,administra_insumo.hora_realadm))>='$fechorini' And (concat(administra_insumo.fech_realadm,administra_insumo.hora_realadm))<='$fechorfin') AND ((administra_insumo.tpin_adi)='M') AND ((destipos.codt_des)='19') AND ((destipos_1.codt_des)='20'))<BR><BR>";
	*/


		
		$ntab1=mysql_query("insert into medsoltmp SELECT administra_insumo.fech_realadm AS fecsol, administra_insumo.hora_realadm AS horsol, administra_insumo.obse_adi AS ususol, administra_insumo.nomb_usu AS nomsol, administra_insumo.id_ing AS cedu, CONCAT(usuario.PAPE_USU,' ',usuario.SAPE_USU,' ',usuario.PNOM_USU,' ',usuario.SNOM_USU) AS nompac, insu_med.codi_ins AS codmed, insu_med.desc_ins AS prod, administra_insumo.cant_adi AS canti, destipos_1.nomb_des AS servi
		FROM ((insu_med INNER JOIN ((usuario INNER JOIN ingreso_hospitalario ON usuario.CODI_USU = ingreso_hospitalario.codius_ing) INNER JOIN administra_insumo ON ingreso_hospitalario.id_ing = administra_insumo.id_ing) ON insu_med.codi_ins = administra_insumo.idin_adi) LEFT JOIN destipos ON administra_insumo.cama_adi = destipos.codi_des) LEFT JOIN destipos AS destipos_1 ON destipos.valo_des = destipos_1.valo_des
		WHERE (((concat(administra_insumo.fech_realadm,administra_insumo.hora_realadm))>='$fechorini' And (concat(administra_insumo.fech_realadm,administra_insumo.hora_realadm))<='$fechorfin') AND ((administra_insumo.tpin_adi)='I') AND ((destipos.codt_des)='19') AND ((destipos_1.codt_des)='20'))");
		$cad="ADMINISTRACION";
		/*
		ECHO"SELECT administra_insumo.fech_realadm AS fecsol, administra_insumo.hora_realadm AS horsol, administra_insumo.obse_adi AS ususol, administra_insumo.nomb_usu AS nomsol, administra_insumo.id_ing AS cedu, CONCAT(usuario.PAPE_USU,' ',usuario.SAPE_USU,' ',usuario.PNOM_USU,' ',usuario.SNOM_USU) AS nompac, insu_med.codi_ins AS codmed, insu_med.desc_ins AS prod, administra_insumo.cant_adi AS canti, destipos_1.nomb_des AS servi
		FROM ((insu_med INNER JOIN ((usuario INNER JOIN ingreso_hospitalario ON usuario.CODI_USU = ingreso_hospitalario.codius_ing) INNER JOIN administra_insumo ON ingreso_hospitalario.id_ing = administra_insumo.id_ing) ON insu_med.codi_ins = administra_insumo.idin_adi) LEFT JOIN destipos ON administra_insumo.cama_adi = destipos.codi_des) LEFT JOIN destipos AS destipos_1 ON destipos.valo_des = destipos_1.valo_des
		WHERE (((concat(administra_insumo.fech_realadm,administra_insumo.hora_realadm))>='$fechorini' And (concat(administra_insumo.fech_realadm,administra_insumo.hora_realadm))<='$fechorfin') AND ((administra_insumo.tpin_adi)='I') AND ((destipos.codt_des)='19') AND ((destipos_1.codt_des)='20'))<BR>";	
		*/
		
		
		
	}	
	if($opcion==5)	//DEVOLUCION
	{
		$ntab=mysql_query("insert into medsoltmp SELECT devol_insumos.fech_dev AS fecsol, devol_insumos.hora_dev AS horsol, devol_insumos.resp_dev AS ususol, devol_insumos.nomb_usu AS nomsol, devol_insumos.id_ing AS cedu, CONCAT(usuario.PAPE_USU,' ',usuario.SAPE_USU,' ',usuario.PNOM_USU,' ',usuario.SNOM_USU) AS nompac, medicamentos2.codi_mdi AS codmed, CONCAT(medicamentos2.nomb_mdi,' ',medicamentos2.noco_mdi,' ',forma_farmaceutica.desc_ffa) AS prod, devol_insumos.cant_dev AS canti, destipos.nomb_des
		FROM (forma_farmaceutica INNER JOIN (((usuario INNER JOIN ingreso_hospitalario ON usuario.CODI_USU = ingreso_hospitalario.codius_ing) INNER JOIN devol_insumos ON ingreso_hospitalario.id_ing = devol_insumos.id_ing) INNER JOIN medicamentos2 ON devol_insumos.coin_dev = medicamentos2.codi_mdi) ON forma_farmaceutica.codi_ffa = medicamentos2.coff_mdi) LEFT JOIN destipos ON devol_insumos.area_dev = destipos.valo_des
		WHERE (((concat(devol_insumos.fech_realdev,devol_insumos.hora_realdev))>='$fechorini' And (concat(devol_insumos.fech_realdev,devol_insumos.hora_realdev))<='$fechorfin') AND ((devol_insumos.tipo_dev)='M') AND ((destipos.codt_des)='20'))");
				
		$ntab1=mysql_query("insert into medsoltmp SELECT devol_insumos.fech_dev AS fecsol, devol_insumos.hora_dev AS horsol, devol_insumos.resp_dev AS ususol, devol_insumos.nomb_usu AS nomsol, devol_insumos.id_ing AS cedu, CONCAT(usuario.PAPE_USU,' ',usuario.SAPE_USU,' ',usuario.PNOM_USU,' ',usuario.SNOM_USU) AS nompac, insu_med.codi_ins AS codmed, insu_med.desc_ins AS prod, devol_insumos.cant_dev AS canti, destipos.nomb_des
		FROM (((usuario INNER JOIN ingreso_hospitalario ON usuario.CODI_USU = ingreso_hospitalario.codius_ing) INNER JOIN devol_insumos ON ingreso_hospitalario.id_ing = devol_insumos.id_ing) INNER JOIN insu_med ON devol_insumos.coin_dev = insu_med.codi_ins) LEFT JOIN destipos ON devol_insumos.area_dev = destipos.valo_des
		WHERE (((concat(devol_insumos.fech_realdev,devol_insumos.hora_realdev))>='$fechorini' And (concat(devol_insumos.fech_realdev,devol_insumos.hora_realdev))<='$fechorfin') AND ((devol_insumos.tipo_dev)='I') AND ((destipos.codt_des)='20'))");	
		$cad="DEVOLUCION";
	}
	
		//seleccion para empleado
		$cadena1='';
		if($fechasol!='')$cadena1=$cadena1." and medsoltmp.fecsol='$fechasol'";
		if($cedula!='')$cadena1=$cadena1." and medsoltmp.cedu='$cedula'";
		if($producto!='')$cadena1=$cadena1." and medsoltmp.codmed='$producto'";
		if($servicio!='')$cadena1=$cadena1." and medsoltmp.servi='$servicio'";
		
		//echo $cadena1.'<br>';
		$bemp=mysql_query("SELECT Max(medsoltmp.usso_mme) AS MxDeusso_mme, medsoltmp.nomsol
		FROM medsoltmp
		WHERE 1 $cadena1
		GROUP BY medsoltmp.nomsol");	
	
		//seleccion para fecha
		$cadena2='';
		if($empleado!='')$cadena2=$cadena2." and  medsoltmp.usso_mme='$empleado'";
		if($cedula!='')$cadena2=$cadena2." and medsoltmp.cedu='$cedula'";
		if($producto!='')$cadena2=$cadena2." and medsoltmp.codmed='$producto'";	
		if($servicio!='')$cadena2=$cadena2." and medsoltmp.servi='$servicio'";
		//echo $cadena2.'<br>';
		$bfec=mysql_query("SELECT medsoltmp.fecsol, Max(medsoltmp.fecsol) AS MxDefecsol
		FROM medsoltmp WHERE 1 $cadena2 GROUP BY medsoltmp.fecsol ORDER BY Max(medsoltmp.fecsol)");
		
		//seleccion para paciente
		$cadena3='';
		if($empleado!='')$cadena3=$cadena3." and  medsoltmp.usso_mme='$empleado'";
		if($fechasol!='')$cadena3=$cadena3." and medsoltmp.fecsol='$fechasol'";
		if($producto!='')$cadena3=$cadena3." and medsoltmp.codmed='$producto'";
		if($servicio!='')$cadena3=$cadena3." and medsoltmp.servi='$servicio'";
		//echo $cadena3.'<br>';
		$bpac=mysql_query("SELECT Max(medsoltmp.cedu) AS MxDecedu, medsoltmp.nompac
		FROM medsoltmp WHERE 1 $cadena3 GROUP BY medsoltmp.nompac ORDER BY medsoltmp.nompac");
		
				
		
		//seleccion para producto
		$cadena4='';
		if($empleado!='')$cadena4=$cadena4." and  medsoltmp.usso_mme='$empleado'";
		if($cedula!='')$cadena4=$cadena4." and medsoltmp.cedu='$cedula'";
		if($fechasol!='')$cadena4=$cadena4." and medsoltmp.fecsol='$fechasol'";
		if($servicio!='')$cadena4=$cadena4." and medsoltmp.servi='$servicio'";
		//echo $cadena4.'<br>';		
		$bpro=mysql_query("SELECT Max(medsoltmp.codmed) AS MxDecodi_mdi, medsoltmp.prod
		FROM medsoltmp WHERE 1 $cadena4 GROUP BY medsoltmp.prod ORDER BY medsoltmp.prod");
		
		//seleccion para servicio
		$cadena5='';
		if($empleado!='')$cadena5=$cadena5." and  medsoltmp.usso_mme='$empleado'";
		if($cedula!='')$cadena5=$cadena5." and medsoltmp.cedu='$cedula'";
		if($fechasol!='')$cadena5=$cadena5." and medsoltmp.fecsol='$fechasol'";		
		if($producto!='')$cadena5=$cadena5." and medsoltmp.codmed='$producto'";
		
		//echo $cadena4.'<br>';		
		$bser=mysql_query("SELECT Max(medsoltmp.servi) AS MxDeservi, medsoltmp.servi
		FROM medsoltmp WHERE 1 $cadena5 GROUP BY medsoltmp.servi ORDER BY medsoltmp.servi");
		
		
		
	$sel1="";$sel2="";
	if($tipoconsul=='1')
	{
		$cad1='DETALLE';
		$sel1="selected";
	}	
	if($tipoconsul=='2')
	{
		$cad1='RESUMEN';
		$sel2="selected";
	}
	$nominfo=$cad1.' '.$cad." DE PRODUCTOS FARMACEUTICOS";
	
	ECHO"<input type=hidden name=nominfo value='$nominfo'>
	<table align=center class='tbl' cellpadding=2 border=1 bgcolor='#E3F2F2'>
	<tr>
	<th>
	$cad1 $cad DE PRODUCTOS FARMACEUTICOS
	</td>
	</tr>
	<tr>
	<td align=center>
	TIPO DE INFORME 
	<select name=tipoconsul onchange='cambio()'>
	<option $sel1 value='1'>DETALLE</option>
	<option $sel2 value='2'>RESUMEN</option>
	</select>
	</td>
	</tr>
	</table>";	
	
	
				
	
	
	if($tipoconsul==1)
	{
		if(!empty($opcion))
		{
			if(mysql_fetch_array($bpro)>=0)
			{
				echo"	
				
				<BR>
				<table align=center class='tbl' cellpadding=2 border=1 bgcolor='#E3F2F2'>
				<tr align=center>
				<th><a href='#' onclick='orden(\"fecsol\")'>FECHA</a></td>
				<th><a href='#' onclick='orden(\"horsol\")'>HORA</a></td>
				<th><a href='#' onclick='orden(\"servi\")'>SERVICIO</a></td>
				<th>CAMA</a></td>
				<th><a href='#' onclick='orden(\"nomsol\")'>FUNCIONARIO</a></td>
				<th><a href='#' onclick='orden(\"nompac\")'>PACIENTE</a></td>
				<th><a href='#' onclick='orden(\"prod\")'>PRODUCTO</a></td>
				<th><a href='#' onclick='orden(\"canti\")'>CANTIDAD</a></td>";
				if($opcion==4)echo"<th><a href='#' onclick='orden(\"canti\")'>OBSERVACION</a></td>";
				//<th>ESTADO</td>	
				ECHO"<tr>
				<tr align=center>
				<td>
				<select name=fechasol class='sel' onchange=cambio()>
				<option value=''></option>";
				while($remp=mysql_fetch_array($bfec))
				{
					$fecsol=$remp['fecsol'];
					if($fechasol==$fecsol)echo"<option value='$fecsol' selected>$fecsol</option>";
					else echo"<option value='$fecsol'>$fecsol</option>";
				}	
				echo"</select>
				</td>
				<td></td>
				
				<td>
				<select name=servicio class='sel' onchange=cambio()>
				<option value=''></option>";
				while($rser=mysql_fetch_array($bser))
				{
					$sersol=$rser['servi'];
					if($servicio==$sersol)echo"<option value='$sersol' selected>$sersol</option>";
					else echo"<option value='$sersol'>$sersol</option>";
				}	
				echo"</select>
				</td>
				
				<td></td>
				
				<td>
				<select name=empleado class='sel' onchange=cambio()>
				<option value=''></option>";
				while($remp=mysql_fetch_array($bemp))
				{
					
					$codemp=$remp['MxDeusso_mme'];
					$nomemp=$remp['nomsol'];
					if($codemp==$empleado)echo"<option value='$codemp' selected>$nomemp</option>";
					else echo"<option value='$codemp'>$nomemp</option>";
				}	
				echo"</select>
				</td>
				<td>
				<select name=cedula class='sel' onchange=cambio()>
				<option value=''></option>";
				while($rpac=mysql_fetch_array($bpac))
				{
					$codpac=$rpac['MxDecedu'];
					$nompac=$rpac['nompac'];
					if($codpac==$cedula)echo"<option value='$codpac' selected>$nompac</option>";
					else echo"<option value='$codpac'>$nompac</option>";
				}	
				echo"</select>	
				</td>	
				<td>
				<select name=producto class='sel' onchange=cambio()>
				<option value=''></option>";
				while($rpac=mysql_fetch_array($bpro))
				{
					$codpro=$rpac['MxDecodi_mdi'];
					$nompro=strtoupper(substr($rpac['prod'],0,70));
					if($codpro==$producto)echo"<option value='$codpro' selected>$nompro</option>";
					else echo"<option value='$codpro'>$nompro</option>";
				}	
				echo"</select>	
				</td>
				<td></td>	
				</tr>";
				$cadena6='';
				if($empleado!='')$cadena6=$cadena6." and  medsoltmp.usso_mme='$empleado'";
				if($cedula!='')$cadena6=$cadena6." and medsoltmp.cedu='$cedula'";
				if($fechasol!='')$cadena6=$cadena6." and medsoltmp.fecsol='$fechasol'";
				if($producto!='')$cadena6=$cadena6." and medsoltmp.codmed='$producto'";
				if($servicio!='')$cadena6=$cadena6." and medsoltmp.servi='$servicio'";
				//echo 'cad 5 '.$cadena6.'<br>';
				
				if(empty($ordenado))$ordenado='fecsol';
				$btodo=mysql_Query("select * from medsoltmp where 1 $cadena6 ORDER BY $ordenado");
				
				//echo mysql_num_rows($btodo);
				
				$numre=mysql_num_rows($btodo);
				//echo "numer ".$numre;
				$n=0;
				while($rtodo=mysql_fetch_array($btodo))
				{
					$fecbus=$rtodo['fecsol'];
					$horbus=$rtodo['horsol'];
					$funbus=strtoupper($rtodo['nomsol']);
					$pacbus=strtoupper($rtodo['nompac']);
					$probus=strtoupper(substr($rtodo['prod'],0,70));		
					$canbus=$rtodo['canti'];
					$serbus=strtoupper($rtodo['servi']);
					$ingcama=strtoupper($rtodo['cedu']);
					if($opcion==4)$obser=strtoupper($rtodo['ususol']);
					$bcam=mysql_query("SELECT destipos.nomb_des
					
					FROM ingreso_hospitalario INNER JOIN destipos ON ingreso_hospitalario.caac_ing = destipos.codi_des
					WHERE (((ingreso_hospitalario.id_ing)='$ingcama'))");
					while($rcam=mysql_fetch_array($bcam))
					{
						$camaac=$rcam['nomb_des'];
					
					}
					$esta=$rtodo['estado'];					
					if($esta=='CU')$estado='CUMPLIDO';
					if($esta=='DI')$estado='DISPENSADO';
					if($esta=='SO')$estado='SOLICITADO';
					if($esta=='SU')$estado='SUAPENDIDO';
					if($esta=='PE')$estado='SOLICITADO';
					if($esta=='RE')$estado='CUMPLIDO';					
					echo"<tr>
					<td align=center>$fecbus</td>
					<td align=center>$horbus</td>
					<td align=center>$serbus</td>
					<td align=center>$camaac</td>
					<td>$funbus</td>
					<td>$pacbus</td>
					<td>$probus</td>
					<td  align=center>$canbus</td>";
					if($opcion==4)
					{
						echo"<td>$obser</td>";
					}
					ECHO"</tr>";
					$nomvar='fecbus'.$n;
					echo"<input type=hidden name=$nomvar value='$fecbus'>";
					$nomvar='camaac'.$n;
					echo"<input type=hidden name=$nomvar value='$camaac'>";
					$nomvar='horbus'.$n;
					echo"<input type=hidden name=$nomvar value='$horbus'>";					
					$nomvar='serbus'.$n;
					echo"<input type=hidden name=$nomvar value='$serbus'>";					
					$nomvar='funbus'.$n;
					echo"<input type=hidden name=$nomvar value='$funbus'>";
					$nomvar='pacbus'.$n;
					echo"<input type=hidden name=$nomvar value='$pacbus'>";
					$nomvar='probus'.$n;
					echo"<input type=hidden name=$nomvar value='$probus'>";
					$nomvar='canbus'.$n;
					echo"<input type=hidden name=$nomvar value='$canbus'>";					
					$n++;				
				}				
				echo"<input type=hidden name=fin value=$n>
				</table>";
			}
		}	
	}
	if($tipoconsul=='2')
	{		
		
		echo"		
		<BR>
		<table align=center class='tbl' cellpadding=2 border=1 bgcolor='#E3F2F2'>
		<tr align=center>
		<th><a href='#' onclick='orden(\"servi\")'>SERVICIO</a></td>
		<th>CAMA</a></td>
		<th><a href='#' onclick='orden(\"nompac\")'>PACIENTE</a></td>
		<th><a href='#' onclick='orden(\"prod\")'>PRODUCTO</a></td>
		<th><a href='#' onclick='orden(\"SumaDecanti\")'>CANTIDAD</a></td>
		</tr>
		
		<tr align=center>
		
		<td>
		<select name=servicio class='sel' onchange=cambio()>
		<option value=''></option>";
		while($rser=mysql_fetch_array($bser))
		{
			$sersol=$rser['servi'];
			if($servicio==$sersol)echo"<option value='$sersol' selected>$sersol</option>";
			else echo"<option value='$sersol'>$sersol</option>";
		}	
		echo"</select>
		</td>
		<td></td>
		<td>
		<select name=cedula class='sel' onchange=cambio()>
		<option value=''></option>";
		while($rpac=mysql_fetch_array($bpac))
		{
			$codpac=$rpac['MxDecedu'];
			$nompac=$rpac['nompac'];
			if($codpac==$cedula)echo"<option value='$codpac' selected>$nompac</option>";
			else echo"<option value='$codpac'>$nompac</option>";
		}	
		echo"</select>	
		</td>	
		<td>
		<select name=producto class='sel' onchange=cambio()>
		<option value=''></option>";
		while($rpac=mysql_fetch_array($bpro))
		{
			$codpro=$rpac['MxDecodi_mdi'];
			$nompro=strtoupper(substr($rpac['prod'],0,70));
			if($codpro==$producto)echo"<option value='$codpro' selected>$nompro</option>";
			else echo"<option value='$codpro'>$nompro</option>";
		}	
		echo"</select>	
		</td>
		<td></td>	
		</tr>";
		$cadena6='';
		
		if($servicio!='')$cadena6=$cadena6." and medsoltmp.servi='$servicio'";
		if($cedula!='')$cadena6=$cadena6." and medsoltmp.cedu='$cedula'";
		if($producto!='')$cadena6=$cadena6." and medsoltmp.codmed='$producto'";
	
		
		if(empty($ordenado))$ordenado='nompac';
		$bresu=mysql_query("SELECT medsoltmp.servi, medsoltmp.cedu, medsoltmp.nompac, medsoltmp.prod, Sum(medsoltmp.canti) AS SumaDecanti		
		FROM medsoltmp where 1 $cadena6 GROUP BY medsoltmp.servi, medsoltmp.cedu, medsoltmp.nompac, medsoltmp.prod ORDER BY $ordenado");
		
		$n=0;
		while($res=mysql_fetch_array($bresu))
		{
			$pacbus=strtoupper($res['nompac']);
			$probus=strtoupper($res['prod']);
			$canbus=$res['SumaDecanti'];
			$serbus=strtoupper($res['servi']);
			$ingcama=strtoupper($res['cedu']);
			$bcam=mysql_query("SELECT destipos.nomb_des
			FROM ingreso_hospitalario INNER JOIN destipos ON ingreso_hospitalario.caac_ing = destipos.codi_des
			WHERE (((ingreso_hospitalario.id_ing)='$ingcama'))");
			while($rcam=mysql_fetch_array($bcam))
			{
				$camaac=$rcam['nomb_des'];
			
			}
			echo"
			<tr>
			<td>$serbus</td>
			<td>$camaac</td>
			<td>$pacbus</td>
			<td>$probus</td>
			<td>$canbus</td>		
			</tr>";
			$nomvar='serbus'.$n;
			echo"<input type=hidden name=$nomvar value='$serbus'>";
			$nomvar='camaac'.$n;
			echo"<input type=hidden name=$nomvar value='$camaac'>";
			$nomvar='pacbus'.$n;
			echo"<input type=hidden name=$nomvar value='$pacbus'>";
			$nomvar='probus'.$n;
			echo"<input type=hidden name=$nomvar value='$probus'>";
			$nomvar='canbus'.$n;
			echo"<input type=hidden name=$nomvar value='$canbus'>";
			$n++;
		}		
		echo"<input type=hidden name=fin value=$n>
		</table>";	
	}
	if($n>0)
	{
		echo"
		<br><table align=center class='tbl' cellpadding=2 border=1 bgcolor='#E3F2F2'>
		<input type=button class=boton value='Imprimir' onclick='salir()'>
		</table>";
	}	
	echo"<form>";
?>
</body>
</html>