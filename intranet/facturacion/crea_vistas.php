<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<title>Creacion de Vistas</title>
<link rel="stylesheet" href="css/style.css" type="text/css" />
</head>
<body lang=ES  style='tab-interval:35.4pt'  >
<form name="form1" method="POST" action="fac_3magisterio.php" target='fr02'>
<table class="Tbl0"><tr><td class="Td0" align='center'>Creación de Vistas</td></tr></table>
<?php

//include('php/conexion.php');

//Servidor de RIPS externos
//$conexion = mysql_connect("172.10.10.100","root","7336200");

$conexion = mysql_connect("localhost","root","");
//$conexion = mysql_connect("192.168.4.12","root","");
//$conexion = mysql_connect("192.168.3.183","root","VJvj321");
//$conexion = mysql_connect("192.168.4.202","root","");
//mysql_select_db("proinsalud_1",$conexion);
mysql_select_db("proinsalud",$conexion);
//mysql_select_db("ut_saludsur",$conexion);

//include('php/funciones.php');
?>
<table class="Tbl0" border='0'>  
  <?php
  /**************************************************************
  *** Vista para consultar usuarios
  *** Nombre: vista_usuarios
  **************************************************************/
  $sql_vista="CREATE OR REPLACE VIEW vista_usuarios AS
  SELECT usuario.CODI_USU, CONCAT(usuario.NROD_USU,' ',usuario.PNOM_USU,' ', usuario.SNOM_USU, ' ',usuario.PAPE_USU,' ', usuario.SAPE_USU) AS nombre FROM usuario";
  //echo "<br>".$sql_vista;
  $sql_vista=mysql_query($sql_vista);
  if($sql_vista<>1){    
    echo "<tr><td class='Td2' align='left'><b>vista_usuarios NO Creada</b></td></tr>";
  }

  /**************************************************************
  *** Vista para consultar cups
  *** Nombre: vista_cups
  **************************************************************/
  $sql_vista="CREATE OR REPLACE VIEW vista_cups AS
  SELECT cups.codigo, CONCAT(cups.codi_cup,' ',cups.descrip) AS nombre_cups,cups.valor,cups.esta_cup FROM cups WHERE cups.esta_cup='AC'";
  //echo "<br>".$sql_vista;
  $sql_vista=mysql_query($sql_vista);
  if($sql_vista<>1){
    echo "<tr><td class='Td2' align='left'><b>vista_cups NO Creada</b></td></tr>";
  }
  

  /**************************************************************
  *** Vista para consultar cie10(Diagnosticos)
  *** Nombre: vista_cie10
  **************************************************************/
  $sql_vista="CREATE OR REPLACE VIEW vista_cie10 AS
  SELECT cie_10.cod_cie10, CONCAT(cie_10.cod_cie10,' ',cie_10.nom_cie10) AS nombre_cie10 FROM cie_10";
  //echo "<br>".$sql_vista;
  $sql_vista=mysql_query($sql_vista);
  if($sql_vista<>1){
    echo "<tr><td class='Td2' align='left'><b>vista_cie10 NO Creada</b></td></tr>";
  }
  

  /**************************************************************
  *** Vista para consultar medicamentos con descripcion, nombre comercial y forma farmaceutica
  *** Nombre: vista_medicamentos2
  **************************************************************/
  $sql_vista="CREATE OR REPLACE VIEW vista_medicamentos2 AS
  SELECT medicamentos2.codi_mdi, CONCAT(medicamentos2.nomb_mdi,' ', medicamentos2.noco_mdi,' ', forma_farmaceutica.desc_ffa) AS nombre_mdi,medicamentos2.pos_mdi,medicamentos2.valo1_mdi
  FROM medicamentos2 INNER JOIN forma_farmaceutica ON medicamentos2.coff_mdi = forma_farmaceutica.codi_ffa";
  //echo "<br>".$sql_vista;
  $sql_vista=mysql_query($sql_vista);
  if($sql_vista<>1){
    echo "<tr><td class='Td2' align='left'><b>vista_medicamentos2 NO Creada</b></td></tr>";
  }
  

  /**************************************************************
  *** Vista para consultar medicamentos en la aplicacion de consulta:
  *** Nombre: vista_histo_medicamentos
  **************************************************************/
  $sql_vista="CREATE OR REPLACE VIEW vista_histo_medicamentos AS
  SELECT usuario.CODI_USU, medicamentosenv.cmed_men, medicamentos2.nomb_mdi, medicamentosenv.cant_men, medicamentosenv.esta_men, destipos.nomb_des AS estado
  FROM (usuario INNER JOIN (encabesadohistoria INNER JOIN (medicamentos2 INNER JOIN medicamentosenv ON medicamentos2.codi_mdi = medicamentosenv.cmed_men) ON encabesadohistoria.numc_ehi = medicamentosenv.numc_men) ON usuario.CODI_USU = encabesadohistoria.cous_ehi) INNER JOIN destipos ON medicamentosenv.esta_men = destipos.codi_des
  WHERE (((medicamentosenv.esta_men)='1401'))";
  //echo "<br>".$sql_vista;
  $sql_vista=mysql_query($sql_vista);
  if($sql_vista<>1){
    echo "<tr><td class='Td2' align='left'><b>vista_histo_medicamentos NO Creada</b></td></tr>";
  }
  

 /**************************************************************
  *** Vista para consultar medicamentos formulados en consulta externa
  *** Nombre: vista_formulacion_consultaexterna
  **************************************************************/
  $sql_vista="CREATE OR REPLACE VIEW vista_formulacion_consultaexterna AS
  SELECT encabesadoformula.nufo_efo, encabesadoformula.numc_efo, encabesadoformula.feco_efo, encabesadoformula.hoco_efo, encabesadoformula.serv_efo, areas.nom_areas, encabesadoformula.prog_efo, destipos.nomb_des AS nombre_prog, encabesadoformula.cod_medi, medicos.nom_medi, encabesadohistoria.idus_ehi, encabesadohistoria.nomb_ehi, encabesadohistoria.origconsu_ehi, municipio.NOMB_MUN, contrato.NEPS_CON, medicamentosenv.ccie_men, cie_10.nom_cie10, medicamentosenv.cmed_men, medicamentos2.nomb_mdi, medicamentosenv.cant_men, medicamentosenv.esta_men
  FROM (((((((encabesadoformula INNER JOIN encabesadohistoria ON encabesadoformula.numc_efo = encabesadohistoria.numc_ehi) INNER JOIN contrato ON encabesadoformula.codi_con = contrato.CODI_CON) INNER JOIN destipos ON encabesadoformula.prog_efo = destipos.codi_des) INNER JOIN areas ON encabesadoformula.serv_efo = areas.cod_areas) INNER JOIN medicos ON encabesadoformula.cod_medi = medicos.cod_medi) INNER JOIN (medicamentosenv INNER JOIN medicamentos2 ON medicamentosenv.cmed_men = medicamentos2.codi_mdi) ON encabesadoformula.numc_efo = medicamentosenv.numc_men) INNER JOIN cie_10 ON medicamentosenv.ccie_men = cie_10.cod_cie10) LEFT JOIN municipio ON encabesadohistoria.origconsu_ehi = municipio.CODI_MUN";
  //echo "<br>".$sql_vista;
  $sql_vista=mysql_query($sql_vista);
  if($sql_vista<>1){
    echo "<tr><td class='Td2' align='left'><b>vista_formulacion_consultaexterna NO Creada</b></td></tr>";
  }
  
  $sql_vista="CREATE OR REPLACE VIEW vista_histo90_medicamentos AS
  SELECT encabesadohistoria.cous_ehi, consultaprincipal.iden_cpl,consultaprincipal.numc_cpl, consultaprincipal.feca_cpl, medicamentosenv.cmed_men, medicamentos2.nomb_mdi,medicamentosenv.cant_men ,medicamentosenv.esta_men, destipos.nomb_des AS estado, DATEDIFF(CURDATE(),feca_cpl) AS tiempo
  FROM encabesadohistoria INNER JOIN (((consultaprincipal INNER JOIN medicamentosenv ON consultaprincipal.numc_cpl = medicamentosenv.numc_men) INNER JOIN destipos ON medicamentosenv.esta_men = destipos.codi_des) INNER JOIN medicamentos2 ON medicamentosenv.cmed_men = medicamentos2.codi_mdi) ON encabesadohistoria.numc_ehi = consultaprincipal.numc_cpl
  WHERE DATEDIFF(CURDATE(),feca_cpl)<=120 AND consultaprincipal.numc_cpl<>''";
  //echo "<br>".$sql_vista;
  $sql_vista=mysql_query($sql_vista);
  if($sql_vista<>1){
    echo "<tr><td class='Td2' align='left'><b>vista_histo90_medicamentos NO Creada</b></td></tr>";
  }
  
  /**************************************************************
  *** Vista para consultar consultas para el informe de consulta externa
  *** Nombre: vista_consulta_externa
  **************************************************************/  
  /*SELECT consultaprincipal.numc_cpl,examenfisico.numc_efi,examenfisico.peso_efi,examenfisico.tall_efi
FROM consultaprincipal
LEFT JOIN examenfisico ON examenfisico.numc_efi=consultaprincipal.numc_cpl
WHERE feca_cpl BETWEEN "2019-04-01" AND "2019-04-30"*/
/*SELECT consultaprincipal.iden_cpl,usuario.CODI_USU, usuario.TDOC_USU, usuario.NROD_USU, usuario.PNOM_USU, usuario.SNOM_USU, usuario.PAPE_USU, usuario.SAPE_USU, usuario.FNAC_USU, usuario.SEXO_USU, usuario.TPAF_USU, usuario.ZONA_USU, usuario.MATE_USU, usuario.MRES_USU, consultaprincipal.feca_cpl, municipio.NOMB_MUN, encabesadohistoria.telf_ehi, encabesadohistoria.dire_ehi, consultaprincipal.numc_cpl, consultaprincipal.fina_cpl, consultaprincipal.caex_cpl, consultaprincipal.motc_cpl, consultaprincipal.enac_cpl, encabesadohistoria.idus_ehi, encabesadohistoria.nomb_ehi, encabesadohistoria.fnac_ehi, encabesadohistoria.unid_ehi, encabesadohistoria.cont_ehi, contrato.NEPS_CON, encabesadohistoria.feco_ehi, encabesadohistoria.origconsu_ehi, consultaprincipal.hora_cpl, horarios.Cserv_horario, areas.nom_areas, areas.codi_des, areas.ccup_prim, areas.ccup_cont, consultaprincipal.hosa_cpl, consultaprincipal.sire_cpl, consultaprincipal.sipi_cpl, consultaprincipal.come_cpl, medicos.nom_medi, consultaprincipal.cod1_cpl, cie_10.nom_cie10, consultaprincipal.tidx_cpl, consultaprincipal.coan_cpl, consultaprincipal.vers_apli, destipos.nomb_des, consultaprincipal.factu_cpl, citas.id_cita, horarios.Fecha_horario, horarios.Hora_horario
    FROM areas INNER JOIN ((usuario INNER JOIN (((((((encabesadohistoria LEFT JOIN municipio ON encabesadohistoria.origconsu_ehi = municipio.CODI_MUN) INNER JOIN consultaprincipal ON encabesadohistoria.numc_ehi = consultaprincipal.numc_cpl) INNER JOIN medicos ON consultaprincipal.come_cpl = medicos.cod_medi) LEFT JOIN cie_10 ON consultaprincipal.cod1_cpl = cie_10.cod_cie10) INNER JOIN contrato ON encabesadohistoria.cont_ehi = contrato.CODI_CON) INNER JOIN citas ON consultaprincipal.numc_cpl = citas.numc_adx) INNER JOIN horarios ON citas.ID_horario = horarios.ID_horario) ON usuario.CODI_USU = encabesadohistoria.cous_ehi) INNER JOIN destipos ON consultaprincipal.vers_apli = destipos.codi_des) ON areas.cod_areas = horarios.Cserv_horario    
  WHERE consultaprincipal.numc_cpl<>''*/

  $sql_vista="CREATE OR REPLACE VIEW vista_consulta_externa AS
  SELECT consultaprincipal.iden_cpl,usuario.CODI_USU, usuario.TDOC_USU, usuario.NROD_USU, usuario.PNOM_USU, usuario.SNOM_USU, usuario.PAPE_USU, usuario.SAPE_USU, usuario.FNAC_USU, usuario.SEXO_USU, usuario.TPAF_USU, usuario.ZONA_USU, usuario.MATE_USU, usuario.MRES_USU, consultaprincipal.feca_cpl, municipio.NOMB_MUN, encabesadohistoria.telf_ehi, encabesadohistoria.dire_ehi, consultaprincipal.numc_cpl, consultaprincipal.fina_cpl, consultaprincipal.caex_cpl, consultaprincipal.motc_cpl, consultaprincipal.enac_cpl, encabesadohistoria.idus_ehi, encabesadohistoria.nomb_ehi, encabesadohistoria.fnac_ehi, encabesadohistoria.unid_ehi, encabesadohistoria.cont_ehi, contrato.NEPS_CON, encabesadohistoria.feco_ehi, encabesadohistoria.origconsu_ehi, consultaprincipal.hora_cpl, horarios.Cserv_horario, areas.nom_areas, areas.codi_des, areas.ccup_prim, areas.ccup_cont, consultaprincipal.hosa_cpl, consultaprincipal.sire_cpl, consultaprincipal.sipi_cpl, consultaprincipal.come_cpl, medicos.nom_medi, consultaprincipal.cod1_cpl, cie_10.nom_cie10, consultaprincipal.tidx_cpl, consultaprincipal.coan_cpl, consultaprincipal.vers_apli, destipos.nomb_des, consultaprincipal.factu_cpl, citas.id_cita, horarios.Fecha_horario, horarios.Hora_horario,examenfisico.peso_efi,examenfisico.tall_efi
    FROM areas INNER JOIN ((usuario INNER JOIN (((((((encabesadohistoria LEFT JOIN municipio ON encabesadohistoria.origconsu_ehi = municipio.CODI_MUN) INNER JOIN consultaprincipal ON encabesadohistoria.numc_ehi = consultaprincipal.numc_cpl) INNER JOIN medicos ON consultaprincipal.come_cpl = medicos.cod_medi) LEFT JOIN cie_10 ON consultaprincipal.cod1_cpl = cie_10.cod_cie10) INNER JOIN contrato ON encabesadohistoria.cont_ehi = contrato.CODI_CON) INNER JOIN citas ON consultaprincipal.numc_cpl = citas.numc_adx) INNER JOIN horarios ON citas.ID_horario = horarios.ID_horario) ON usuario.CODI_USU = encabesadohistoria.cous_ehi) INNER JOIN destipos ON consultaprincipal.vers_apli = destipos.codi_des) ON areas.cod_areas = horarios.Cserv_horario
    LEFT JOIN examenfisico ON examenfisico.numc_efi=consultaprincipal.numc_cpl
  WHERE consultaprincipal.numc_cpl<>''";
  //echo "<br>".$sql_vista;
  $sql_vista=mysql_query($sql_vista);
  if($sql_vista<>1){
    echo "<tr><td class='Td2' align='left'><b>vista_consulta_externa NO Creada</b></td></tr>";
  }
  
  /**************************************************************
  *** Vista para consultar diagnosticos relacionados
  *** Nombre: vista_diagnosticos2
  **************************************************************/
  $sql_vista="CREATE OR REPLACE VIEW vista_diagnosticos2 AS
  SELECT numc_di2,codc_di2,nom_cie10 FROM diagnosticos2
  INNER JOIN cie_10 WHERE cod_cie10=codc_di2";
  $sql_vista=mysql_query($sql_vista);
  if($sql_vista<>1){
    echo "<tr><td class='Td2' align='left'><b>vista_diagnosticos2 NO Creada</b></td></tr>";
  }

  /**************************************************************
  *** Vista para consultar rips de consulta externa (consultaprincipal)
  *** Nombre: vista_rips_consultaprincipal
  **************************************************************/
  $sql_vista="CREATE OR REPLACE VIEW vista_rips_consultaprincipal AS
  SELECT consultaprincipal.numc_cpl, usuario.TDOC_USU, usuario.NROD_USU, consultaprincipal.feca_cpl, consultaprincipal.area_cpl, consultaprincipal.fina_cpl, consultaprincipal.caex_cpl, consultaprincipal.cod1_cpl, consultaprincipal.tidx_cpl, consultaprincipal.coan_cpl, encabesadohistoria.cont_ehi, usuario.MATE_USU, usuario.MRES_USU, consultaprincipal.come_cpl, usuario.TPAF_USU, encabesadohistoria.fnac_ehi, encabesadohistoria.unid_ehi, usuario.SEXO_USU, usuario.ZONA_USU, consultaprincipal.hora_cpl, areas.nom_areas, areas.ccup_prim, areas.ccup_cont
  FROM (usuario INNER JOIN (encabesadohistoria INNER JOIN consultaprincipal ON encabesadohistoria.numc_ehi = consultaprincipal.numc_cpl) ON usuario.CODI_USU = encabesadohistoria.cous_ehi) INNER JOIN areas ON consultaprincipal.area_cpl = areas.cod_areas";
  //echo "<br>".$sql_vista;
  $sql_vista=mysql_query($sql_vista);
  if($sql_vista<>1){
    echo "<tr><td class='Td2' align='left'><b>vista_rips_consultaprincipal NO Creada</b></td></tr>";
  }
  
  /**************************************************************
  *** Vista para consultar referencias (ayudas dx)
  *** Nombre: vista_detareferencia
  **************************************************************/
  $sql_vista="CREATE OR REPLACE VIEW vista_detareferencia AS
  SELECT usuario.CODI_USU, detareferencia.idre_dre, referencia.fech_ref, cups.codi_cup, cups.descrip, detareferencia.cant_dre, detareferencia.alse_dre, destipos.nomb_des AS servicio, detareferencia.marc_dre, destipos_1.nomb_des AS estado
  FROM (usuario 
  INNER JOIN ucontrato ON usuario.CODI_USU = ucontrato.CUSU_UCO) 
  INNER JOIN (referencia 
  INNER JOIN (((detareferencia 
  INNER JOIN cups ON detareferencia.codi_dre = cups.codigo) 
  INNER JOIN destipos ON detareferencia.alse_dre = destipos.codi_des) 
  INNER JOIN destipos AS destipos_1 ON detareferencia.marc_dre = destipos_1.codi_des) ON referencia.idre_ref = detareferencia.idre_dre) ON ucontrato.IDEN_UCO = referencia.cuco_ref
  WHERE detareferencia.marc_dre='1401' OR detareferencia.marc_dre='1402'";
  //echo "<br>".$sql_vista;
  $sql_vista=mysql_query($sql_vista);
  if($sql_vista<>1){
    echo "<tr><td class='Td2' align='left'><b>vista_detareferencia NO Creada</b></td></tr>";
  }
  

  $sql_vista="CREATE OR REPLACE VIEW vista_90detareferencia AS
  SELECT consultaprincipal.iden_cpl, encabesadohistoria.cous_ehi, consultaprincipal.feca_cpl, detareferencia.idre_dre, cups.codi_cup, cups.descrip, detareferencia.cant_dre, detareferencia.alse_dre, destipos.nomb_des AS servicio, detareferencia.marc_dre, destipos_1.nomb_des AS estado, DATEDIFF(CURDATE(),feca_cpl) AS tiempo
  FROM (encabesadohistoria INNER JOIN consultaprincipal ON encabesadohistoria.numc_ehi = consultaprincipal.numc_cpl) INNER JOIN (referencia INNER JOIN (((detareferencia INNER JOIN cups ON detareferencia.codi_dre = cups.codigo) INNER JOIN destipos ON detareferencia.alse_dre = destipos.codi_des) INNER JOIN destipos AS destipos_1 ON detareferencia.marc_dre = destipos_1.codi_des) ON referencia.idre_ref = detareferencia.idre_dre) ON encabesadohistoria.numc_ehi = referencia.numc_ref
  WHERE DATEDIFF(CURDATE(),feca_cpl)<=120";
  //echo "<br>".$sql_vista;
  $sql_vista=mysql_query($sql_vista);
  if($sql_vista<>1){
    echo "<tr><td class='Td2' align='left'><b>vista_90detareferencia NO Creada</b></td></tr>";
  }
  

  /*************************************************************
  *** Vista para consultar referencias (ordenes)
  *** Nombre: vista_detareferencia_ord
  **************************************************************/
  $sql_vista="CREATE OR REPLACE VIEW vista_detareferencia_ord AS
  SELECT usuario.CODI_USU, detareferencia.idre_dre, detareferencia.codi_dre, destipos_2.codt_des, destipos_2.nomb_des AS actividad, detareferencia.cant_dre, detareferencia.alse_dre, destipos.nomb_des AS servicio, detareferencia.marc_dre, destipos_1.nomb_des AS estado
  FROM ((usuario INNER JOIN ucontrato ON usuario.CODI_USU = ucontrato.CUSU_UCO) INNER JOIN (referencia INNER JOIN ((detareferencia INNER JOIN destipos ON detareferencia.alse_dre = destipos.codi_des) INNER JOIN destipos AS destipos_1 ON detareferencia.marc_dre = destipos_1.codi_des) ON referencia.idre_ref = detareferencia.idre_dre) ON ucontrato.IDEN_UCO = referencia.cuco_ref) INNER JOIN destipos AS destipos_2 ON detareferencia.codi_dre = destipos_2.codi_des
  WHERE (((destipos_2.codt_des)='06') AND ((detareferencia.marc_dre)='1401' Or (detareferencia.marc_dre)='1402'))";
  //echo "<br>".$sql_vista;
  $sql_vista=mysql_query($sql_vista);
  if($sql_vista<>1){
    echo "<tr><td class='Td2' align='left'><b>vista_detareferencia_ord NO Creada</b></td></tr>";
  }
  

  $sql_vista="CREATE OR REPLACE VIEW vista_detareferencia90_ord AS
  SELECT consultaprincipal.iden_cpl, encabesadohistoria.cous_ehi, consultaprincipal.feca_cpl, detareferencia.idre_dre, detareferencia.codi_dre, destipos_2.codt_des, destipos_2.nomb_des AS actividad, detareferencia.cant_dre, detareferencia.alse_dre, destipos.nomb_des AS servicio, detareferencia.marc_dre, destipos_1.nomb_des AS estado, DATEDIFF(CURDATE(),feca_cpl) AS tiempo
  FROM (consultaprincipal INNER JOIN encabesadohistoria ON consultaprincipal.numc_cpl = encabesadohistoria.numc_ehi) INNER JOIN ((referencia INNER JOIN ((detareferencia INNER JOIN destipos ON detareferencia.alse_dre = destipos.codi_des) INNER JOIN destipos AS destipos_1 ON detareferencia.marc_dre = destipos_1.codi_des) ON referencia.idre_ref = detareferencia.idre_dre) INNER JOIN destipos AS destipos_2 ON detareferencia.codi_dre = destipos_2.codi_des) ON consultaprincipal.numc_cpl = referencia.numc_ref
  WHERE destipos_2.codt_des='06' and DATEDIFF(CURDATE(),feca_cpl)<=120";
  //echo "<br>".$sql_vista;
  $sql_vista=mysql_query($sql_vista);
  if($sql_vista<>1){
    echo "<tr><td class='Td2' align='left'><b>vista_detareferencia90_ord NO Creada</b></td></tr>";
  }
  

  /**************************************************************
  *** Vista para consultar referencias con informacion del paciente
  *** Nombre: vista_detareferencia_usuario
  **************************************************************/
  $sql_vista="CREATE OR REPLACE VIEW vista_detareferencia_usuario AS
  SELECT referencia.idre_ref, referencia.fech_ref, usuario.TDOC_USU, usuario.NROD_USU, usuario.PNOM_USU, usuario.SNOM_USU, usuario.PAPE_USU, usuario.SAPE_USU, ucontrato.CONT_UCO, contrato.NEPS_CON, referencia.numc_ref, referencia.cuco_ref, detareferencia.codi_dre, municipio.CODI_MUN, municipio.NOMB_MUN, detareferencia.marc_dre, destipos.nomb_des AS DESC_ESTADO, detareferencia.alse_dre, destipos_1.nomb_des AS SERV_REFERIDO, detareferencia.ccie_dre, cie_10.nom_cie10, referencia.msol_ref, medicos.nom_medi, referencia.usua_ref, vista_cut.nomb_usua AS operador FROM vista_cut INNER JOIN ((((((contrato INNER JOIN ((usuario INNER JOIN ucontrato ON usuario.CODI_USU = ucontrato.CUSU_UCO) INNER JOIN (referencia INNER JOIN detareferencia ON referencia.idre_ref = detareferencia.idre_dre) ON ucontrato.IDEN_UCO = referencia.cuco_ref) ON contrato.CODI_CON = ucontrato.CONT_UCO) INNER JOIN municipio ON usuario.MATE_USU = municipio.CODI_MUN) INNER JOIN destipos ON detareferencia.marc_dre = destipos.codi_des) INNER JOIN destipos AS destipos_1 ON detareferencia.alse_dre = destipos_1.codi_des) LEFT JOIN cie_10 ON detareferencia.ccie_dre = cie_10.cod_cie10) LEFT JOIN medicos ON referencia.msol_ref = medicos.cod_medi) ON vista_cut.ide_usua = referencia.usua_ref";
  //echo "<br>".$sql_vista;
  $sql_vista=mysql_query($sql_vista);
  if($sql_vista<>1){
    echo "<tr><td class='Td2' align='left'><b>vista_detareferencia_usuario NO Creada</b></td></tr>";
  }
  

  /**************************************************************
  *** Vista para consultar referencias de las consultas
  *** Nombre: vista_consulta_detareferencia
  **************************************************************/
  $sql_vista="CREATE OR REPLACE VIEW vista_consulta_detareferencia AS 
  SELECT consultaprincipal.iden_cpl, consultaprincipal.come_cpl, medicos.nom_medi, consultaprincipal.feca_cpl, destipos.nomb_des, referencia.idre_ref, detareferencia.alse_dre, destipos.nomb_des AS SERVICIO_REMITIDO, detareferencia.codi_dre, cups.codi_cup, cups.descrip, usuario.TDOC_USU, usuario.NROD_USU, usuario.PNOM_USU, usuario.SNOM_USU, usuario.PAPE_USU, usuario.SAPE_USU, contrato.NEPS_CON, consultaprincipal.area_cpl, areas.nom_areas, municipio.NOMB_MUN, detareferencia.marc_dre, destipos_1.nomb_des AS ESTADO,detareferencia.cant_dre AS CANTIDAD 
	FROM ((areas INNER JOIN ((usuario INNER JOIN ((((((consultaprincipal INNER JOIN referencia ON consultaprincipal.numc_cpl = referencia.numc_ref) INNER JOIN detareferencia ON referencia.idre_ref = detareferencia.idre_dre) INNER JOIN medicos ON consultaprincipal.come_cpl = medicos.cod_medi) LEFT JOIN destipos ON detareferencia.alse_dre = destipos.codi_des) INNER JOIN cups ON detareferencia.codi_dre = cups.codigo) INNER JOIN encabesadohistoria ON consultaprincipal.numc_cpl = encabesadohistoria.numc_ehi) ON usuario.CODI_USU = encabesadohistoria.cous_ehi) INNER JOIN contrato ON encabesadohistoria.cont_ehi = contrato.CODI_CON) ON areas.cod_areas = consultaprincipal.area_cpl) INNER JOIN municipio ON areas.muni_area = municipio.CODI_MUN) INNER JOIN destipos AS destipos_1 ON detareferencia.marc_dre = destipos_1.codi_des 
	WHERE consultaprincipal.numc_cpl<>''";
  //echo "<br>".$sql_vista;
  $sql_vista=mysql_query($sql_vista);
  if($sql_vista<>1){
    echo "<tr><td class='Td2' align='left'><b>vista_consulta_detareferencia NO Creada</b></td></tr>";
  }
  

  /**************************************************************
  *** Vista para consultar remisiones de las consultas
  *** Nombre: vista_consulta_remision
  ***************************************************************/
  $sql_vista="CREATE OR REPLACE VIEW vista_consulta_remision AS
  SELECT consultaprincipal.numc_cpl, referencia.idre_ref, consultaprincipal.come_cpl, medicos.nom_medi, consultaprincipal.feca_cpl, detareferencia.alse_dre, detareferencia.codi_dre, destipos.nomb_des AS SERVICIO, usuario.NROD_USU, usuario.PNOM_USU, usuario.SNOM_USU, usuario.PAPE_USU, usuario.SAPE_USU, contrato.NEPS_CON, areas.nom_areas, referencia.fech_ref,municipio.nomb_mun AS municipio_servicio
FROM (contrato 
INNER JOIN (usuario 
INNER JOIN (encabesadohistoria 
INNER JOIN ((medicos 
INNER JOIN ((consultaprincipal 
INNER JOIN referencia ON consultaprincipal.numc_cpl = referencia.numc_ref) 
INNER JOIN detareferencia ON referencia.idre_ref = detareferencia.idre_dre) ON medicos.cod_medi = consultaprincipal.come_cpl) 
INNER JOIN destipos ON detareferencia.codi_dre = destipos.codi_des 
INNER JOIN areas ON areas.cod_areas=consultaprincipal.area_cpl)
ON encabesadohistoria.numc_ehi = consultaprincipal.numc_cpl) ON usuario.CODI_USU = encabesadohistoria.cous_ehi) ON contrato.CODI_CON = encabesadohistoria.cont_ehi)
LEFT JOIN municipio ON municipio.CODI_MUN=encabesadohistoria.origconsu_ehi
WHERE consultaprincipal.numc_cpl<>''";
  //echo "<br>".$sql_vista;
  $sql_vista=mysql_query($sql_vista);
  if($sql_vista<>1){
    echo "<tr><td class='Td2' align='left'><b>vista_consulta_remision NO Creada</b></td></tr>";
  }
  
  /**************************************************************
  *** Vista para consultar medicamentos de las consultas
  *** Nombre: vista_consulta_medicamentos
  **************************************************************/
  $sql_vista="CREATE OR REPLACE VIEW vista_consulta_medicamentos AS
  SELECT consultaprincipal.numc_cpl, consultaprincipal.feca_cpl, consultaprincipal.come_cpl, medicos.nom_medi, areas.nom_areas, usuario.NROD_USU, usuario.PNOM_USU, usuario.SNOM_USU, usuario.PAPE_USU, usuario.SAPE_USU, contrato.NEPS_CON, medicamentos2.codi_mdi, medicamentos2.ncsi_medi, medicamentos2.nomb_mdi, medicamentos2.pos_mdi, medicamentosenv.cant_men
  FROM contrato INNER JOIN ((encabesadohistoria INNER JOIN (((areas INNER JOIN (consultaprincipal INNER JOIN medicos ON consultaprincipal.come_cpl = medicos.cod_medi) ON areas.cod_areas = consultaprincipal.area_cpl) INNER JOIN medicamentosenv ON consultaprincipal.numc_cpl = medicamentosenv.numc_men) INNER JOIN medicamentos2 ON medicamentosenv.cmed_men = medicamentos2.codi_mdi) ON encabesadohistoria.numc_ehi = consultaprincipal.numc_cpl) INNER JOIN usuario ON encabesadohistoria.cous_ehi = usuario.CODI_USU) ON contrato.CODI_CON = encabesadohistoria.cont_ehi
  WHERE consultaprincipal.numc_cpl<>''";
  //echo "<br>".$sql_vista;
  $sql_vista=mysql_query($sql_vista);
  if($sql_vista<>1){
    echo "<tr><td class='Td2' align='left'><b>vista_consulta_medicamentos NO Creada</b></td></tr>";
  }
  

  /**************************************************************
  *** Vista para consultar bitacora de citas
  *** Nombre: vista_bitacora_citas
  *************************************************************/
  /*SELECT horarios.Fecha_horario, horarios.Hora_horario, horarios.Cserv_horario, areas.nom_areas, usuario.TDOC_USU, usuario.NROD_USU, usuario.PNOM_USU, usuario.SNOM_USU, usuario.PAPE_USU, usuario.SAPE_USU, usuario.SEXO_USU, usuario.TPAF_USU, citas.Cotra_citas, contrato.NEPS_CON, medicos.cod_medi, medicos.nom_medi, citas.Fsolusu_citas, vitacora.Operacio_Vitaco, usuario.MATE_USU, municipio.NOMB_MUN, vitacora.Nota_Vitaco, vitacora.pete_vitaco, vista_cut.nomb_usua AS operador
FROM ((medicos INNER JOIN (municipio INNER JOIN (usuario INNER JOIN (areas INNER JOIN ((vitacora INNER JOIN citas ON vitacora.Codci_Vitaco = citas.id_cita) INNER JOIN horarios ON citas.ID_horario = horarios.ID_horario) ON areas.cod_areas = horarios.Cserv_horario) ON usuario.CODI_USU = citas.Idusu_citas) ON municipio.CODI_MUN = usuario.MATE_USU) ON medicos.cod_medi = horarios.Cmed_horario) INNER JOIN contrato ON citas.Cotra_citas = contrato.CODI_CON) INNER JOIN vista_cut ON vitacora.Cod_oper_vitaco = vista_cut.ide_usua*/
/*$sql_vista="CREATE OR REPLACE VIEW vista_bitacora_citas AS
SELECT horarios.Fecha_horario, horarios.Hora_horario, horarios.Cserv_horario, areas.nom_areas, areas_1.nom_areas AS area_agrupada, usuario.TDOC_USU, usuario.NROD_USU, usuario.PNOM_USU, usuario.SNOM_USU, usuario.PAPE_USU, usuario.SAPE_USU, usuario.SEXO_USU, usuario.TPAF_USU, citas.Cotra_citas, contrato.NEPS_CON, medicos.cod_medi, medicos.nom_medi, citas.Fsolusu_citas, vitacora.Operacio_Vitaco, usuario.MATE_USU, municipio.NOMB_MUN, citas.Esta_cita, esta_cita.descrip_estaci, citas.Clase_citas, tip_cita.des_ticita, vitacora.Nota_Vitaco, vitacora.pete_vitaco, vista_cut.nomb_usua AS operador
FROM (((((medicos INNER JOIN (municipio INNER JOIN (usuario INNER JOIN (areas INNER JOIN ((vitacora INNER JOIN citas ON vitacora.Codci_Vitaco = citas.id_cita) INNER JOIN horarios ON citas.ID_horario = horarios.ID_horario) ON areas.cod_areas = horarios.Cserv_horario) ON usuario.CODI_USU = citas.Idusu_citas) ON municipio.CODI_MUN = usuario.MATE_USU) ON medicos.cod_medi = horarios.Cmed_horario) INNER JOIN contrato ON citas.Cotra_citas = contrato.CODI_CON) INNER JOIN vista_cut ON vitacora.Cod_oper_vitaco = vista_cut.ide_usua) LEFT JOIN areas AS areas_1 ON areas.equi_area = areas_1.cod_areas) INNER JOIN tip_cita ON citas.Clase_citas = tip_cita.cod_ticita) INNER JOIN esta_cita ON citas.Esta_cita = esta_cita.cod_estaci";*/

$sql_vista="CREATE OR REPLACE VIEW vista_bitacora_citas AS
SELECT vitacora.Codci_Vitaco,horarios.Fecha_horario, horarios.Hora_horario, horarios.Cserv_horario, areas.nom_areas, areas_1.nom_areas AS area_agrupada, 
usuario.TDOC_USU, usuario.NROD_USU, usuario.PNOM_USU, usuario.SNOM_USU, usuario.PAPE_USU, usuario.SAPE_USU, usuario.SEXO_USU, usuario.TPAF_USU, citas.tipo_consulta AS TIPO_CONSULTA, 
citas.Cotra_citas, contrato.NEPS_CON, medicos.cod_medi, medicos.nom_medi, citas.Fsolusu_citas, vitacora.Operacio_Vitaco, usuario.MATE_USU, municipio.NOMB_MUN, 
citas.Esta_cita, esta_cita.descrip_estaci, citas.Clase_citas, tip_cita.des_ticita, vitacora.Nota_Vitaco, vitacora.pete_vitaco, 
vista_cut.nomb_usua AS operador,vitacora.tip_soli,tipo_cancel.des_ticita AS tipo_cancelacion
FROM ((((((medicos INNER JOIN (municipio INNER JOIN (usuario INNER JOIN (areas INNER JOIN ((vitacora INNER JOIN citas ON vitacora.Codci_Vitaco = citas.id_cita) 
INNER JOIN horarios ON citas.ID_horario = horarios.ID_horario) ON areas.cod_areas = horarios.Cserv_horario) ON usuario.CODI_USU = citas.Idusu_citas) 
ON municipio.CODI_MUN = usuario.MATE_USU) ON medicos.cod_medi = horarios.Cmed_horario) INNER JOIN contrato ON citas.Cotra_citas = contrato.CODI_CON) 
INNER JOIN vista_cut ON vitacora.Cod_oper_vitaco = vista_cut.ide_usua) LEFT JOIN areas AS areas_1 ON areas.equi_area = areas_1.cod_areas) 
INNER JOIN tip_cita ON citas.Clase_citas = tip_cita.cod_ticita) LEFT JOIN tip_cita AS tipo_cancel ON vitacora.tip_soli=tipo_cancel.cod_ticita) 
INNER JOIN esta_cita ON citas.Esta_cita = esta_cita.cod_estaci";
  //echo "<br>".$sql_vista;
  $sql_vista=mysql_query($sql_vista);
  if($sql_vista<>1){
    echo "<tr><td class='Td2' align='left'><b>vista_bitacora_citas NO Creada</b></td></tr>";
  }
  

  /**************************************************************
  *** Vista para consultar horarios generados
  *** Nombre: vista_horarios
  **************************************************************/
  $sql_vista="CREATE OR REPLACE VIEW vista_horarios AS
  SELECT horarios.ID_horario, areas.cod_areas, areas.nom_areas, horarios.Fecha_horario, horarios.Hora_horario, horarios.dia_horario, medicos.cod_medi, medicos.nom_medi, horarios.Usado_horario, horarios.ncita_horario
  FROM medicos 
  INNER JOIN (areas 
  INNER JOIN horarios ON areas.cod_areas = horarios.Cserv_horario) ON medicos.cod_medi = horarios.Cmed_horario";
  //echo "<br>".$sql_vista;
  $sql_vista=mysql_query($sql_vista);
  if($sql_vista<>1){
    echo "<tr><td class='Td2' align='left'><b>vista_horarios NO Creada</b></td></tr>";
  }
  

  /**************************************************************
  *** Vista para consultar horarios generados
  *** Nombre: vista_citas
  **************************************************************/

$sql_vista="CREATE OR REPLACE VIEW vista_citas AS
SELECT citas.id_cita, citas.Fsolusu_citas, citas.Hora_cita, departamento.NOMB_DEP, municipio.NOMB_MUN, institucion.NOMB_INS, usuario.CODI_USU, usuario.TPAF_USU, 
usuario.TDOC_USU, usuario.NROD_USU, usuario.PNOM_USU, usuario.SNOM_USU, usuario.PAPE_USU, usuario.SAPE_USU, usuario.MRES_USU, usuario.FNAC_USU, 
usuario.SEXO_USU, citas.Clase_citas, tip_cita.des_ticita, horarios.Fecha_horario, horarios.Hora_horario, horarios.Cmed_horario, medicos.nom_medi,
 horarios.Cserv_horario, areas.nom_areas, areas_1.nom_areas AS area_agrupada, citas.Cotra_citas, contrato.NEPS_CON, citas.Esta_cita, esta_cita.descrip_estaci, 
 citas.conc_cita, destipos.nomb_des AS concesion, citas.obse_cita, tipo_consulta, vitacora.Operacio_Vitaco, vista_cut.nomb_usua AS operador, citas.fecdeseada, citas.primera_cita
FROM (((((contrato INNER JOIN ((((cotadicional RIGHT JOIN (departamento INNER JOIN (municipio INNER JOIN ((usuario INNER JOIN (citas 
INNER JOIN horarios ON citas.ID_horario = horarios.ID_horario) ON usuario.CODI_USU = citas.Idusu_citas) 
INNER JOIN medicos ON horarios.Cmed_horario = medicos.cod_medi) ON municipio.CODI_MUN = usuario.MATE_USU) ON departamento.CODI_DEP = municipio.DEPA_MUN) 
ON cotadicional.CUSU_COT = usuario.CODI_USU) LEFT JOIN institucion ON cotadicional.INST_COT = institucion.CODI_INS) INNER JOIN tip_cita 
ON citas.Clase_citas = tip_cita.cod_ticita) INNER JOIN areas ON horarios.Cserv_horario = areas.cod_areas) ON contrato.CODI_CON = citas.Cotra_citas) 
INNER JOIN esta_cita ON citas.Esta_cita = esta_cita.cod_estaci) LEFT JOIN destipos ON citas.conc_cita = destipos.codi_des) LEFT JOIN areas AS areas_1 ON 
areas.equi_area = areas_1.cod_areas) LEFT JOIN vitacora ON citas.id_cita = vitacora.Codci_Vitaco) LEFT JOIN vista_cut 
ON vitacora.Cod_oper_vitaco = vista_cut.ide_usua";
  //echo "<br>".$sql_vista;
  $sql_vista=mysql_query($sql_vista);
  if($sql_vista<>1){
    echo "<tr><td class='Td2' align='left'><b>vista_citas NO Creada</b></td></tr>";
  }
  

  /**************************************************************
  *** Vista para consultar externa de pyp
  *** Nombre: vista_consulta_pyp
  **************************************************************/
  $sql_vista="CREATE OR REPLACE VIEW vista_consulta_pyp AS
  SELECT encabesadohistoria.feco_ehi, encabesadohistoria.idus_ehi, usuario.PNOM_USU, usuario.SNOM_USU, usuario.PAPE_USU, usuario.SAPE_USU, usuario.FNAC_USU, usuario.SEXO_USU,usuario.MRES_USU,municipio.NOMB_MUN, encabesadohistoria.fnac_ehi, encabesadohistoria.dire_ehi, encabesadohistoria.telf_ehi, examenfisico.tall_efi, examenfisico.peso_efi, pyp_programas.cod_pro,consultaprincipal.codi_cpl,consultaprincipal.coan_cpl,pyp_actividades.nom_act
  FROM ((examenfisico INNER JOIN ((usuario INNER JOIN encabesadohistoria ON usuario.CODI_USU = encabesadohistoria.cous_ehi) INNER JOIN consultaprincipal ON encabesadohistoria.numc_ehi = consultaprincipal.numc_cpl) ON examenfisico.numc_efi = consultaprincipal.numc_cpl) INNER JOIN pyp_actividades ON consultaprincipal.cod_actpyp = pyp_actividades.cod_act) INNER JOIN pyp_programas ON pyp_actividades.cod_pro = pyp_programas.cod_pro
  INNER JOIN municipio ON municipio.CODI_MUN=usuario.MATE_USU
  WHERE consultaprincipal.numc_cpl<>''";
  //echo "<br>".$sql_vista;
  $sql_vista=mysql_query($sql_vista);
  if($sql_vista<>1){
    echo "<tr><td class='Td2' align='left'><b>vista_consulta_pyp NO Creada</b></td></tr>";
  }
  

  /**************************************************************
  *** Vista para consultar aiepi joven v2
  *** Nombre: vista_consulta_joven
  **************************************************************/
  $sql_vista="CREATE OR REPLACE VIEW vista_consulta_joven AS
  SELECT aiepi5antecede.codi_usu, aiepi5antecede.fechate_a5, usuario.TDOC_USU, usuario.NROD_USU, usuario.PNOM_USU, usuario.SNOM_USU, usuario.PAPE_USU, usuario.SAPE_USU, usuario.FNAC_USU, usuario.SEXO_USU,usuario.MATE_USU, municipio.NOMB_MUN, aiepi5antecede.direccion_a5, aiepi5antecede.telefono_a5, antegenaiepi.talla, antegenaiepi.peso, aiepi5antecede.motivo_a5, citas.Cotra_citas, horarios.Cserv_horario, antegenaiepi.pc, aiepi5alimenta.matena_a7, aiepi5tratamiento.adven_a9
    FROM ((((aiepi5antecede 
    INNER JOIN (citas
    INNER JOIN horarios ON citas.ID_horario = horarios.ID_horario) ON aiepi5antecede.cod_cit = citas.id_cita) 
    INNER JOIN usuario ON citas.Idusu_citas = usuario.CODI_USU) 
    INNER JOIN antegenaiepi ON aiepi5antecede.numc_cpl = antegenaiepi.numc_efo) 
    INNER JOIN aiepi5alimenta ON aiepi5antecede.numc_cpl = aiepi5alimenta.numc_cpl) 
    INNER JOIN aiepi5tratamiento ON aiepi5antecede.numc_cpl = aiepi5tratamiento.numc_cpl
    INNER JOIN municipio ON municipio.codi_mun=usuario.mate_usu";
  //echo "<br>".$sql_vista;
  $sql_vista=mysql_query($sql_vista);
  if($sql_vista<>1){
    echo "<tr><td class='Td2' align='left'><b>vista_consulta_joven NO Creada</b></td></tr>";
  }
  

  $sql_vista="CREATE OR REPLACE VIEW vista_consulta2_joven AS
  SELECT aiepi2anevalua.codi_usu, aiepi2anevalua.fechate_b1, usuario.TDOC_USU, usuario.NROD_USU, usuario.PNOM_USU, usuario.SNOM_USU, usuario.PAPE_USU, usuario.SAPE_USU, usuario.FNAC_USU, usuario.SEXO_USU,usuario.MATE_USU, municipio.NOMB_MUN, aiepi2anevalua.direccion_b1, aiepi2anevalua.telefono_b1, antegenaiepi.talla, antegenaiepi.peso, aiepi2anevalua.motivo_b1, citas.Cotra_citas, horarios.Cserv_horario, antegenaiepi.pc, aiepi2alimenta.lechmater_b2
  FROM ((aiepi2anevalua INNER JOIN ((citas INNER JOIN horarios ON citas.ID_horario = horarios.ID_horario) INNER JOIN usuario ON citas.Idusu_citas = usuario.CODI_USU) ON aiepi2anevalua.cod_cit = citas.id_cita) INNER JOIN antegenaiepi ON aiepi2anevalua.numc_cpl = antegenaiepi.numc_efo) 
  INNER JOIN aiepi2alimenta ON aiepi2anevalua.numc_cpl = aiepi2alimenta.numc_cpl
  INNER JOIN municipio ON municipio.codi_mun=usuario.mate_usu";
  //echo "<br>".$sql_vista;
  $sql_vista=mysql_query($sql_vista);
  if($sql_vista<>1){
    echo "<tr><td class='Td2' align='left'><b>vista_consulta2_joven NO Creada</b></td></tr>";
  }
  

  /**************************************************************
  *** Vista para consultar remisiones aiepi menores de 2 meses
  *** Nombre: vista_aiepi2_detaref
  **************************************************************/
  $sql_vista="CREATE OR REPLACE VIEW vista_aiepi2_detaref AS
  SELECT aiepi2anevalua.numc_cpl, aiepi2anevalua.fechate_b1, usuario.NROD_USU, usuario.PNOM_USU, usuario.SNOM_USU, usuario.PAPE_USU, usuario.SAPE_USU, aiepi2anevalua.edadactual_b1, medicos.nom_medi, detareferencia.ccie_dre, cie_10.nom_cie10, cups.codi_cup, cups.descrip, detareferencia.cant_dre, cups.grup_cup
  FROM ((((aiepi2anevalua INNER JOIN medicos ON aiepi2anevalua.cod_medi = medicos.cod_medi) INNER JOIN usuario ON aiepi2anevalua.codi_usu = usuario.CODI_USU) INNER JOIN detareferencia ON aiepi2anevalua.numc_cpl = detareferencia.numc_dre) INNER JOIN cie_10 ON detareferencia.ccie_dre = cie_10.cod_cie10) INNER JOIN cups ON detareferencia.codi_dre = cups.codigo";
  //echo "<br>".$sql_vista;
  $sql_vista=mysql_query($sql_vista);
  if($sql_vista<>1){
    echo "<tr><td class='Td2' align='left'><b>vista_aiepi2_detaref NO Creada</b></td></tr>";
  }
  

  /**************************************************************
  *** Vista para consultar remisiones aiepi de 2 meses a 5 años
  *** Nombre: vista_aiepi5_detaref
  **************************************************************/
  $sql_vista="CREATE OR REPLACE VIEW vista_aiepi5_detaref AS
  SELECT aiepi5antecede.numc_cpl, aiepi5antecede.fechate_a5, usuario.NROD_USU, usuario.PNOM_USU, usuario.SNOM_USU, usuario.PAPE_USU, usuario.SAPE_USU, aiepi5antecede.edadactual_a5, medicos.nom_medi, detareferencia.ccie_dre, cie_10.nom_cie10, cups.codi_cup, cups.descrip, detareferencia.cant_dre, cups.grup_cup
  FROM ((detareferencia INNER JOIN ((aiepi5antecede INNER JOIN medicos ON aiepi5antecede.cod_medi = medicos.cod_medi) INNER JOIN usuario ON aiepi5antecede.codi_usu = usuario.CODI_USU) ON detareferencia.numc_dre = aiepi5antecede.numc_cpl) INNER JOIN cups ON detareferencia.codi_dre = cups.codigo) INNER JOIN cie_10 ON detareferencia.ccie_dre = cie_10.cod_cie10";
  //echo "<br>".$sql_vista;
  $sql_vista=mysql_query($sql_vista);
  if($sql_vista<>1){
    echo "<tr><td class='Td2' align='left'><b>vista_aiepi5_detaref NO Creada</b></td></tr>";
  }
  

  /**************************************************************
  *** Vista para consultar medicamentos aiepi menores de 2 meses
  *** Nombre: vista_aiepi2_medicamento
  **************************************************************/
  $sql_vista="CREATE OR REPLACE VIEW vista_aiepi2_medicamento AS
  SELECT aiepi2anevalua.numc_cpl, aiepi2anevalua.fechate_b1, usuario.NROD_USU, usuario.PNOM_USU, usuario.SNOM_USU, usuario.PAPE_USU, usuario.SAPE_USU, aiepi2anevalua.edadactual_b1, medicos.nom_medi, medicamentosenv.cmed_men, medicamentos2.nomb_mdi, medicamentosenv.dosis_med, medicamentosenv.frec_med, medicamentosenv.tiem_med, medicamentosenv.cant_men
  FROM (medicamentosenv INNER JOIN ((aiepi2anevalua INNER JOIN medicos ON aiepi2anevalua.cod_medi = medicos.cod_medi) INNER JOIN usuario ON aiepi2anevalua.codi_usu = usuario.CODI_USU) ON medicamentosenv.numc_men = aiepi2anevalua.numc_cpl) INNER JOIN medicamentos2 ON medicamentosenv.cmed_men = medicamentos2.codi_mdi";
  //echo "<br>".$sql_vista;
  $sql_vista=mysql_query($sql_vista);
  if($sql_vista<>1){
    echo "<tr><td class='Td2' align='left'><b>vista_aiepi2_medicamento NO Creada</b></td></tr>";    
  }
  
  /**************************************************************
  *** Vista para consultar medicamentos aiepi de 2 meses a 5 años
  *** Nombre: vista_aiepi5_medicamento
  **************************************************************/
  $sql_vista="CREATE OR REPLACE VIEW vista_aiepi5_medicamento AS
  SELECT aiepi5antecede.numc_cpl, aiepi5antecede.fechate_a5, usuario.NROD_USU, usuario.PNOM_USU, usuario.SNOM_USU, usuario.PAPE_USU, usuario.SAPE_USU, aiepi5antecede.edadactual_a5, medicos.nom_medi, medicamentosenv.cmed_men, medicamentos2.nomb_mdi, medicamentosenv.dosis_med, medicamentosenv.frec_med, medicamentosenv.tiem_med, medicamentosenv.cant_men
  FROM (medicamentosenv INNER JOIN ((aiepi5antecede INNER JOIN medicos ON aiepi5antecede.cod_medi = medicos.cod_medi) INNER JOIN usuario ON aiepi5antecede.codi_usu = usuario.CODI_USU) ON medicamentosenv.numc_men = aiepi5antecede.numc_cpl) INNER JOIN medicamentos2 ON medicamentosenv.cmed_men = medicamentos2.codi_mdi";
  //echo "<br>".$sql_vista;
  $sql_vista=mysql_query($sql_vista);
  if($sql_vista<>1){
    echo "<tr><td class='Td2' align='left'><b>vista_aiepi5_medicamento NO Creada</b></td></tr>";
  }
  
  /**************************************************************
  *** Vista para consultar epicrisis
  *** Nombre: vista_epicrisis
  **************************************************************/
  $sql_vista="CREATE OR REPLACE VIEW vista_epicrisis AS
  SELECT usuario.TDOC_USU, usuario.NROD_USU, usuario.PNOM_USU, usuario.SNOM_USU, usuario.PAPE_USU, usuario.SAPE_USU, usuario.FNAC_USU, usuario.SEXO_USU, usuario.MRES_USU, destipos.nomb_des AS SERVICIO, destipos_1.nomb_des AS CAMA, hist_evo.fech_evo, epicrisis.fecing_epi, epicrisis.horing_epi, epicrisis.moting_epi, epicrisis.estgen_epi, epicrisis.antece_epi, epicrisis.revisi_epi, epicrisis.exafis_epi, epicrisis.conduc_epi, epicrisis.evoluc_epi, If(estegr_epi='1','Vivo','Muerto') AS ESTADO_SALIDA, epicrisis.hordef_epi, epicrisis.conegr_epi, epicrisis.incapa_epi, destipos_2.nomb_des AS DESTINO, epicrisis.esptra_epi, medicos.nom_medi
  FROM (destipos AS destipos_1 INNER JOIN ((((epicrisis INNER JOIN hist_evo ON epicrisis.iden_evo = hist_evo.iden_evo) INNER JOIN usuario ON hist_evo.codi_usu = usuario.CODI_USU) LEFT JOIN destipos ON epicrisis.sering_epi = destipos.codi_des) INNER JOIN medicos ON epicrisis.esptra_epi = medicos.cod_medi) ON destipos_1.codi_des = hist_evo.cama_evo) LEFT JOIN destipos AS destipos_2 ON hist_evo.dest_usu = destipos_2.codi_des";
  //echo "<br>".$sql_vista;
  $sql_vista=mysql_query($sql_vista);
  if($sql_vista<>1){
    echo "<tr><td class='Td2' align='left'><b>vista_epicrisis NO Creada</b></td></tr>";
  }
  
  /**************************************************************
  *** Vista para consultar epicrisis2
  *** Nombre: vista_epicrisis2
  **************************************************************/
  /*$sql_vista="CREATE OR REPLACE VIEW vista_epicrisis2 AS
  SELECT usuario.TDOC_USU, usuario.NROD_USU, usuario.PNOM_USU, usuario.SNOM_USU, usuario.PAPE_USU, usuario.SAPE_USU, usuario.FNAC_USU, usuario.SEXO_USU, usuario.MATE_USU, usuario.MRES_USU, hist_evo.id_ing, hist_evo.iden_evo, hist_evo.fech_evo, medicos.nom_medi, hist_evo.cod_cie10, cie_10.nom_cie10, destipos.nomb_des AS CAMA, destipos_2.nomb_des AS SERVICIO, destipos_1.nomb_des AS DESTINO, IF(epicrisis2.estaalta_epiegreso='','',IF(epicrisis2.estaalta_epiegreso='MA','Muert@',IF(epicrisis2.estaalta_epiegreso='MD','Muert@','Viv@'))) AS ESTADO_D,epicrisis2.fecha_epi,epicrisis2. meditratante_epicontra,medico_trat.nom_medi AS nombre_medico_trat
  FROM ((((((hist_evo INNER JOIN destipos ON hist_evo.cama_evo = destipos.codi_des) INNER JOIN destipos AS destipos_1 ON hist_evo.dest_usu = destipos_1.codi_des) INNER JOIN medicos ON hist_evo.cod_medi = medicos.cod_medi) INNER JOIN cie_10 ON hist_evo.cod_cie10 = cie_10.cod_cie10) LEFT JOIN epicrisis2 ON hist_evo.iden_evo = epicrisis2.iden_evo) INNER JOIN usuario ON hist_evo.codi_usu = usuario.CODI_USU) INNER JOIN destipos AS destipos_2 ON destipos.valo_des = destipos_2.codi_des
  INNER JOIN medicos AS medico_trat ON medico_trat.cod_medi=epicrisis2.meditratante_epicontra";*/
  $sql_vista="CREATE OR REPLACE VIEW vista_epicrisis2 AS
  SELECT 
epicrisis2.iden_epi,epicrisis2.id_ing,epicrisis2.fecha_epi,epicrisis2.hora_epi,epicrisis2.iden_evo,epicrisis2.servegres_epiegreso,
  IF(epicrisis2.servegres_epiegreso='04','URGENCIAS',servicio.nomb_des) AS SERVICIO,epicrisis2.diasestan_epiegreso,epicrisis2.fechegres_epiegreso,epicrisis2.horaegres_epiegreso,epicrisis2.meditratante_epicontra,medico_trat.nom_medi AS medico_tratante,epicrisis2.medicoelab_epicontra,medico_elab.nom_medi AS medico_elabora,
  IF(epicrisis2.estaalta_epiegreso='','',IF(epicrisis2.estaalta_epiegreso='MA','Muert@',IF(epicrisis2.estaalta_epiegreso='MD','Muert@','Viv@'))) AS ESTADO_D,hist_evo.cama_evo,cama.nomb_des AS cama,dest_usu,destino.nomb_des AS destino,
  usuario.tdoc_usu,usuario.nrod_usu,CONCAT(usuario.pnom_usu,' ',usuario.snom_usu,' ',usuario.pape_usu,' ',usuario.sape_usu) AS nombre_usu,usuario.fnac_usu,usuario.sexo_usu
  FROM epicrisis2
  LEFT JOIN destipos AS servicio ON servicio.codi_des=epicrisis2.servegres_epiegreso
  INNER JOIN hist_evo ON hist_evo.iden_evo=epicrisis2.iden_evo
  INNER JOIN destipos AS cama ON cama.codi_des=hist_evo.cama_evo
  LEFT JOIN destipos AS destino ON destino.codi_des=hist_evo.dest_usu
  INNER JOIN ingreso_hospitalario ON ingreso_hospitalario.id_ing=epicrisis2.id_ing
  INNER JOIN usuario ON usuario.codi_usu=ingreso_hospitalario.codius_ing
  INNER JOIN medicos AS medico_trat ON medico_trat.cod_medi=epicrisis2.meditratante_epicontra
  INNER JOIN medicos AS medico_elab ON medico_elab.cod_medi=epicrisis2.medicoelab_epicontra";
  //echo "<br>".$sql_vista;
  $sql_vista=mysql_query($sql_vista);
  if($sql_vista<>1){
    echo "<tr><td class='Td2' align='left'><b>vista_epicrisis2 NO Creada</b></td></tr>";
  }
  
  /**************************************************************
  *** Vista para consultar contrareferencia de hospitalización
  *** Nombre: vista_ingreso_contraref
  **************************************************************/
  $sql_vista="CREATE OR REPLACE VIEW vista_ingreso_contraref AS
   SELECT ingreso_hospitalario.fecin_ing, epicrisis2.ipsremite_epicontra, arc_ent_1.razs_ent AS ips_remite, usuario.NROD_USU, usuario.PNOM_USU, usuario.SNOM_USU, usuario.PAPE_USU, usuario.SAPE_USU, usuario.FNAC_USU, usuario.SEXO_USU, usuario.MRES_USU, ingreso_hospitalario.contra_ing, contrato.NEPS_CON, epicrisis2.fecha_epi, epicrisis2.dxpridef_epiegreso, epicrisis2.contraremi_epicontra, epicrisis2.ipscontrare_epicontra, arc_ent.razs_ent AS ips_contrarem, epicrisis2.medicoelab_epicontra, medicos.nom_medi,epicrisis2.meditratante_epicontra
  FROM ((((usuario INNER JOIN ingreso_hospitalario ON usuario.CODI_USU = ingreso_hospitalario.codius_ing) INNER JOIN (epicrisis2 INNER JOIN medicos ON epicrisis2.medicoelab_epicontra = medicos.cod_medi) ON ingreso_hospitalario.id_ing = epicrisis2.id_ing) LEFT JOIN arc_ent ON epicrisis2.ipscontrare_epicontra = arc_ent.iden_ent) INNER JOIN contrato ON ingreso_hospitalario.contra_ing = contrato.CODI_CON) INNER JOIN arc_ent AS arc_ent_1 ON epicrisis2.ipsremite_epicontra = arc_ent_1.iden_ent";
  //echo "<br>".$sql_vista;
  $sql_vista=mysql_query($sql_vista);
  if($sql_vista<>1){
    echo "<tr><td class='Td2' align='left'><b>vista_ingreso_contraref NO Creada</b></td></tr>";
  }
  
  /**************************************************************
  *** Vista para consultar evoluciones
  *** Nombre: vista_evolucion
  **************************************************************/
  $sql_vista="CREATE OR REPLACE VIEW vista_evolucion AS
  SELECT hist_evo.codi_usu, usuario.TDOC_USU, usuario.NROD_USU, usuario.PNOM_USU, usuario.SNOM_USU, usuario.PAPE_USU, usuario.SAPE_USU, usuario.FNAC_USU, ingreso_hospitalario.id_ing, ingreso_hospitalario.fecin_ing, ingreso_hospitalario.hora_ing, ingreso_hospitalario.fecsa_ing, ingreso_hospitalario.horsa_ing, hist_evo.iden_evo, ingreso_hospitalario.contra_ing, contrato.NEPS_CON, hist_evo.fech_evo, hist_evo.hora_evo, hist_evo.cod_medi, medicos.nom_medi, hist_evo.cama_evo, destipos.nomb_des AS CAMA, destipos.valo_des, IF(destipos.valo_des='04','URGENCIAS',destipos_1.nomb_des) AS SERVICIO,destipos.homo_esp AS codi_cup,hist_evo.cod_cie10, cie_10.nom_cie10, hist_evo.esta_evo
  FROM ((((contrato INNER JOIN (usuario INNER JOIN (hist_evo INNER JOIN ingreso_hospitalario ON hist_evo.id_ing = ingreso_hospitalario.id_ing) ON usuario.CODI_USU = ingreso_hospitalario.codius_ing) ON contrato.CODI_CON = ingreso_hospitalario.contra_ing) INNER JOIN medicos ON hist_evo.cod_medi = medicos.cod_medi) LEFT JOIN destipos ON hist_evo.cama_evo = destipos.codi_des) LEFT JOIN destipos AS destipos_1 ON destipos.valo_des = destipos_1.codi_des) INNER JOIN cie_10 ON hist_evo.cod_cie10 = cie_10.cod_cie10";

  //echo "<br>".$sql_vista;
  $sql_vista=mysql_query($sql_vista);
  if($sql_vista<>1){
    echo "<tr><td class='Td2' align='left'><b>vista_evolucion NO Creada</b></td></tr>";
  }
  

  /**************************************************************
  *** Vista para consultar evoluciones con tiempo de egreso del paciente
  *** Nombre: vista_evolucion_tiempo
  **************************************************************/
  $sql_vista="CREATE OR REPLACE VIEW vista_evolucion_tiempo AS
  SELECT usuario.TDOC_USU, usuario.NROD_USU, usuario.PNOM_USU, usuario.SNOM_USU, usuario.PAPE_USU, usuario.SAPE_USU, contrato.NEPS_CON, hist_evo.iden_evo, hist_evo.ordensalida_evo, hist_evo.cod_medi, medicos.nom_medi, hist_evo.cod_cie10, cie_10.nom_cie10, hist_evo.cama_evo, destipos.nomb_des AS cama, destipos.valo_des AS codigo_sev, destipos_1.nomb_des AS servicio
  ,CONCAT(hist_evo.fech_evo,' ',hist_evo.hora_evo) AS fecha_evol,
  CONCAT(hist_evo.fsalida_evo,' ',hist_evo.hsalida_evo) AS fecha_salida_evol,
  TIMEDIFF(CONCAT(hist_evo.fsalida_evo,' ',hist_evo.hsalida_evo),CONCAT(hist_evo.fech_evo,' ',hist_evo.hora_evo)) AS tiempo
  FROM contrato INNER JOIN (usuario INNER JOIN (((((hist_evo INNER JOIN medicos ON hist_evo.cod_medi = medicos.cod_medi) LEFT JOIN cie_10 ON hist_evo.cod_cie10 = cie_10.cod_cie10) INNER JOIN destipos ON hist_evo.cama_evo = destipos.codi_des) INNER JOIN destipos AS destipos_1 ON destipos.valo_des = destipos_1.codi_des) INNER JOIN ingreso_hospitalario ON hist_evo.id_ing = ingreso_hospitalario.id_ing) ON usuario.CODI_USU = ingreso_hospitalario.codius_ing) ON contrato.CODI_CON = ingreso_hospitalario.contra_ing
  WHERE hist_evo.ordensalida_evo='S'";

  //echo "<br>".$sql_vista;
  $sql_vista=mysql_query($sql_vista);
  if($sql_vista<>1){
    echo "<tr><td class='Td2' align='left'><b>vista_evolucion_tiempo NO Creada</b></td></tr>";
  }
  

  /**************************************************************
  *** Vista para consultar ingreso_hospitalario
  *** Nombre: vista_ingreso_hospitalario
  **************************************************************/
  $sql_vista="CREATE OR REPLACE VIEW vista_ingreso_hospitalario AS
  SELECT ingreso_hospitalario.id_ing, usuario.NROD_USU, usuario.PNOM_USU, usuario.SNOM_USU, usuario.PAPE_USU, usuario.SAPE_USU, contrato.NEPS_CON, ingreso_hospitalario.fecin_ing, ingreso_hospitalario.fecsa_ing, destipos.nomb_des AS servicio
  FROM (destipos INNER JOIN (usuario INNER JOIN ingreso_hospitalario ON usuario.CODI_USU = ingreso_hospitalario.codius_ing) ON destipos.codi_des = ingreso_hospitalario.ubica_ing) INNER JOIN contrato ON ingreso_hospitalario.contra_ing = contrato.CODI_CON";
  //echo "<br>".$sql_vista;
  $sql_vista=mysql_query($sql_vista);
  if($sql_vista<>1){
    echo "<tr><td class='Td2' align='left'><b>vista_ingreso_hospitalario NO Creada</b></td></tr>";
  }
  
  /**************************************************************
  *** Vista para consultar hist_traza
  *** Nombre: vista_hist_traza
  **************************************************************/
  $sql_vista="CREATE OR REPLACE VIEW vista_hist_traza AS
  SELECT hist_traza.id_ing, usuario.TDOC_USU, usuario.NROD_USU, usuario.PNOM_USU, usuario.SNOM_USU, usuario.PAPE_USU, usuario.SAPE_USU, usuario.FNAC_USU, usuario.SEXO_USU, usuario.TPAF_USU, usuario.REGI_USU, usuario.ZONA_USU, usuario.MATE_USU, municipio.NOMB_MUN, usuario.MRES_USU, contrato.NEPS_CON, ingreso_hospitalario.contra_ing, ingreso_hospitalario.hora_ing, ingreso_hospitalario.horsa_ing, ingreso_hospitalario.cext_ing, ingreso_hospitalario.via_ing, hist_traza.iden_tra, hist_traza.fecin_tra, hist_traza.horin_tra, hist_traza.fecsa_tra, hist_traza.horsa_tra, hist_traza.horas_tra, hist_traza.ubica_tra, hist_traza.iden_evo, IF(hist_traza.ubica_tra='04','URGENCIAS',destipos.nomb_des) AS SERVICIO, hist_traza.secu_tra
  FROM ((usuario INNER JOIN ((hist_traza LEFT JOIN destipos ON hist_traza.ubica_tra = destipos.codi_des) INNER JOIN ingreso_hospitalario ON hist_traza.id_ing = ingreso_hospitalario.id_ing) ON usuario.CODI_USU = ingreso_hospitalario.codius_ing) INNER JOIN contrato ON ingreso_hospitalario.contra_ing = contrato.CODI_CON) INNER JOIN municipio ON usuario.MATE_USU = municipio.CODI_MUN";

  //echo "<br>".$sql_vista;
  $sql_vista=mysql_query($sql_vista);
  if($sql_vista<>1){
    echo "<tr><td class='Td2' align='left'><b>vista_hist_traza NO Creada</b></td></tr>";
  }
  
  
  /**************************************************************
  *** Vista para consultar hist_traza con evolucion
  *** Nombre: vista_hist_traza_evolucion
  **************************************************************/
  $sql_vista="CREATE OR REPLACE VIEW vista_hist_traza_evolucion AS
  SELECT usuario.CODI_USU, usuario.TDOC_USU, usuario.NROD_USU, usuario.PNOM_USU, usuario.SNOM_USU, usuario.PAPE_USU, usuario.SAPE_USU, usuario.FNAC_USU, contrato.NEPS_CON, hist_traza.id_ing, hist_traza.iden_tra, hist_traza.ubica_tra, destipos.nomb_des, hist_traza.fecin_tra, hist_traza.horin_tra, hist_evo.ordensalida_evo, hist_evo.fsalida_evo, hist_evo.hsalida_evo
  FROM contrato INNER JOIN (usuario INNER JOIN ((destipos RIGHT JOIN (hist_traza INNER JOIN hist_evo ON hist_traza.iden_evo = hist_evo.iden_evo) ON destipos.codi_des = hist_traza.ubica_tra) INNER JOIN ingreso_hospitalario ON hist_traza.id_ing = ingreso_hospitalario.id_ing) ON usuario.CODI_USU = ingreso_hospitalario.codius_ing) ON contrato.CODI_CON = ingreso_hospitalario.contra_ing";
  //echo "<br>".$sql_vista;
  $sql_vista=mysql_query($sql_vista);
  if($sql_vista<>1){
    echo "<tr><td class='Td2' align='left'><b>vista_hist_traza_evolucion NO Creada</b></td></tr>";
  }

  /**************************************************************
  *** Vista para consultar medicamentos de hospitalizacion
  *** Nombre: vista_medicamentos_hosp
  **************************************************************/
  $sql_vista="CREATE OR REPLACE VIEW vista_medicamentos_hosp AS
  SELECT hist_evo.id_ing, hist_evo.iden_evo, hdet_med.codi_mdi, medicamentos2.nomb_mdi
  FROM (((hist_evo INNER JOIN henc_med ON hist_evo.iden_evo = henc_med.iden_evo) INNER JOIN cie_10 ON hist_evo.cod_cie10 = cie_10.cod_cie10) INNER JOIN hdet_med ON henc_med.idor_med = hdet_med.idor_med) INNER JOIN medicamentos2 ON hdet_med.codi_mdi = medicamentos2.codi_mdi";
  //echo "<br>".$sql_vista;
  $sql_vista=mysql_query($sql_vista);
  if($sql_vista<>1){
    echo "<tr><td class='Td2' align='left'><b>vista_medicamentos_hosp NO Creada</b></td></tr>";
  }
  
  /**************************************************************
  *** Vista para consultar insumos de hospitalizacion
  *** Nombre: vista_insumos_hosp
  **************************************************************/
  $sql_vista="CREATE OR REPLACE VIEW vista_insumos_hosp AS
  SELECT ingreso_hospitalario.id_ing, movi_ins.codi_ins, insu_med.desc_ins
  FROM (movi_ins INNER JOIN ingreso_hospitalario ON movi_ins.id_ing = ingreso_hospitalario.id_ing) INNER JOIN insu_med ON movi_ins.codi_ins = insu_med.codi_ins";
  //echo "<br>".$sql_vista;
  $sql_vista=mysql_query($sql_vista);
  if($sql_vista<>1){
    echo "<tr><td class='Td2' align='left'><b>vista_insumos_hosp NO Creada</b></td></tr>";
  }
  

  /**************************************************************
  *** Vista para consultar ordenes de hospitalizacion
  *** Nombre: vista_ordenes_hosp
  **************************************************************/
  $sql_vista="CREATE OR REPLACE VIEW vista_ordenes_hosp AS
 SELECT usuario.CODI_USU, usuario.NROD_USU, usuario.PNOM_USU, usuario.SNOM_USU, usuario.PAPE_USU, usuario.SAPE_USU, usuario.FNAC_USU, contrato.NEPS_CON, ingreso_hospitalario.contra_ing, ingreso_hospitalario.id_ing, hist_evo.iden_evo, hist_var.iden_var, hist_var.iden_ser, hist_var.fech_var, hist_var.hora_var, hist_var.clas_var, hist_var.esta_var, cups.descrip, cups.artic_cup
FROM contrato INNER JOIN (usuario INNER JOIN (((ingreso_hospitalario INNER JOIN hist_evo ON ingreso_hospitalario.id_ing = hist_evo.id_ing) INNER JOIN hist_var ON hist_evo.iden_evo = hist_var.iden_evo) INNER JOIN cups ON hist_var.iden_ser = cups.codigo) ON usuario.CODI_USU = ingreso_hospitalario.codius_ing) ON contrato.CODI_CON = ingreso_hospitalario.contra_ing";
  //echo "<br>".$sql_vista;
  $sql_vista=mysql_query($sql_vista);
  if($sql_vista<>1){
    echo "<tr><td class='Td2' align='left'><b>vista_ordenes_hosp NO Creada</b></td></tr>";
  }
  

  /**************************************************************
  *** Vista para consultar medicamentos administrados
  *** Nombre: vista_administra_insumo
  **************************************************************/
  $sql_vista="CREATE OR REPLACE VIEW vista_administra_insumo AS
  SELECT ingreso_hospitalario.id_ing, usuario.TDOC_USU, usuario.NROD_USU, usuario.MATE_USU, usuario.MRES_USU, municipio.CODI_MUN AS COD_MUNRES, usuario.TPAF_USU, usuario.FNAC_USU, usuario.SEXO_USU, usuario.REGI_USU, usuario.ZONA_USU, ingreso_hospitalario.contra_ing, contrato.NEPS_CON, administra_insumo.idin_adi, insu_med.desc_ins, insu_med.valo1_ins, administra_insumo.tpin_adi, administra_insumo.cant_adi, administra_insumo.fech_adi, administra_insumo.hora_adi, administra_insumo.resp_adi
  FROM ((usuario INNER JOIN ((administra_insumo INNER JOIN insu_med ON administra_insumo.idin_adi = insu_med.codi_ins) INNER JOIN ingreso_hospitalario ON administra_insumo.id_ing = ingreso_hospitalario.id_ing) ON usuario.CODI_USU = ingreso_hospitalario.codius_ing) INNER JOIN contrato ON ingreso_hospitalario.contra_ing = contrato.CODI_CON) INNER JOIN municipio ON usuario.MRES_USU = municipio.NOMB_MUN";
  //echo "<br>".$sql_vista;
  $sql_vista=mysql_query($sql_vista);
  if($sql_vista<>1){
    echo "<tr><td class='Td2' align='left'><b>vista_administra_insumo NO Creada</b></td></tr>";
  }
  
  /**************************************************************
  *** Vista para consultar facturacion
  *** Nombre: vista_factura
  **************************************************************/
  $sql_vista="CREATE OR REPLACE VIEW vista_factura AS
  SELECT encabezado_factura.iden_fac, encabezado_factura.pref_fac,encabezado_factura.nume_fac,encabezado_factura.id_ing, encabezado_factura.fcie_fac, encabezado_factura.codi_con, encabezado_factura.rela_fac, encabezado_factura.enti_fac, encabezado_factura.anul_fac, encabezado_factura.esta_fac, encabezado_factura.feci_fac, encabezado_factura.fecf_fac, contrato.NEPS_CON, encabezado_factura.cod_cie10, usuario.TDOC_USU, usuario.NROD_USU, usuario.PNOM_USU, usuario.SNOM_USU, usuario.PAPE_USU, usuario.SAPE_USU, usuario.FNAC_USU, detalle_factura.desc_dfa, detalle_factura.cant_dfa, detalle_factura.iden_tco, detalle_factura.valu_dfa, encabezado_factura.vcop_fac, encabezado_factura.pdes_fac, encabezado_factura.cmod_fac, encabezado_factura.usua_fac, destipos.codt_des, destipos.nomb_des, detalle_factura.cod_medi,detalle_factura.tipo_dfa, medicos.nom_medi FROM ((((encabezado_factura INNER JOIN detalle_factura ON encabezado_factura.iden_fac = detalle_factura.iden_fac) LEFT JOIN destipos ON encabezado_factura.area_fac = destipos.codi_des) INNER JOIN contrato ON encabezado_factura.codi_con = contrato.CODI_CON) INNER JOIN usuario ON encabezado_factura.codi_usu = usuario.CODI_USU) LEFT JOIN medicos ON detalle_factura.cod_medi = medicos.cod_medi";
  //echo "<br>".$sql_vista;
  $sql_vista=mysql_query($sql_vista);
  if($sql_vista<>1){
    echo "<tr><td class='Td2' align='left'><b>vista_factura NO Creada</b></td></tr>";
  }
  

  /**************************************************************
  *** Vista para consultar facturacion
  *** Nombre: vista_factura_encabezado
  **************************************************************/
  $sql_vista="CREATE OR REPLACE VIEW vista_factura_encabezado AS
  SELECT encabezado_factura.iden_fac, encabezado_factura.id_ing, encabezado_factura.nume_fac, encabezado_factura.pref_fac, encabezado_factura.fcie_fac, encabezado_factura.rela_fac, encabezado_factura.codi_usu, usuario.TDOC_USU, usuario.NROD_USU, usuario.PNOM_USU, usuario.SNOM_USU, usuario.PAPE_USU, usuario.SAPE_USU, usuario.FNAC_USU, encabezado_factura.iden_ctr, encabezado_factura.codi_con, contrato.NEPS_CON, encabezado_factura.cod_cie10, encabezado_factura.area_fac, destipos.nomb_des AS servicio, encabezado_factura.enti_fac, encabezado_factura.anul_fac, encabezado_factura.esta_fac, encabezado_factura.vcop_fac, encabezado_factura.pdes_fac, encabezado_factura.cmod_fac, encabezado_factura.vnet_fac, encabezado_factura.usua_fac
  FROM ((encabezado_factura LEFT JOIN destipos ON encabezado_factura.area_fac = destipos.codi_des) INNER JOIN contrato ON encabezado_factura.codi_con = contrato.CODI_CON) INNER JOIN usuario ON encabezado_factura.codi_usu = usuario.CODI_USU";
  //echo "<br>".$sql_vista;
  $sql_vista=mysql_query($sql_vista);
  if($sql_vista<>1){
    echo "<tr><td class='Td2' align='left'><b>vista_factura_encabezado NO Creada</b></td></tr>";
  }
  
  /**************************************************************
  *** Vista para consultar detalle de facturacion
  *** Nombre: vista_detalle_factura
  **************************************************************/
  $sql_vista="CREATE OR REPLACE VIEW vista_detalle_factura AS
  SELECT encabezado_factura.iden_fac, encabezado_factura.pref_fac, encabezado_factura.nume_fac, encabezado_factura.fcie_fac, encabezado_factura.codi_con, encabezado_factura.rela_fac, encabezado_factura.enti_fac, encabezado_factura.anul_fac, encabezado_factura.esta_fac, encabezado_factura.feci_fac, encabezado_factura.fecf_fac, contrato.NEPS_CON, contrato.NIT_CON, contrato_1.NEPS_CON AS RESPONSABLE_PAGO, encabezado_factura.cod_cie10, usuario.NROD_USU, usuario.PNOM_USU, usuario.SNOM_USU, usuario.PAPE_USU, usuario.SAPE_USU, usuario.FNAC_USU, detalle_factura.iden_dfa, detalle_factura.desc_dfa, detalle_factura.cant_dfa, detalle_factura.iden_tco, detalle_factura.valu_dfa, encabezado_factura.vcop_fac, encabezado_factura.pdes_fac, encabezado_factura.cmod_fac, encabezado_factura.area_fac, destipos.nomb_des AS SERVICIO, detalle_factura.cod_medi, detalle_factura.tipo_dfa, medicos.nom_medi, tarco.tser_tco, destipos_1.nomb_des AS TIP_SERVICIO, tarco.clas_tco, encabezado_factura.usua_fac, cut.nomb_usua,destipos_2.nomb_des AS servicio_det
  FROM (((((((((encabezado_factura INNER JOIN detalle_factura ON encabezado_factura.iden_fac = detalle_factura.iden_fac) LEFT JOIN destipos ON encabezado_factura.area_fac = destipos.codi_des) INNER JOIN contrato ON encabezado_factura.codi_con = contrato.CODI_CON) INNER JOIN usuario ON encabezado_factura.codi_usu = usuario.CODI_USU) LEFT JOIN medicos ON detalle_factura.cod_medi = medicos.cod_medi) LEFT JOIN contrato AS contrato_1 ON encabezado_factura.enti_fac = contrato_1.NIT_CON) LEFT JOIN tarco ON detalle_factura.iden_tco = tarco.iden_tco) LEFT JOIN destipos AS destipos_1 ON tarco.tser_tco = destipos_1.codi_des)LEFT JOIN destipos AS destipos_2 ON detalle_factura.servi_dfa = destipos_2.codi_des) LEFT JOIN cut ON encabezado_factura.usua_fac = cut.ide_usua";
  //echo "<br>".$sql_vista;
  $sql_vista=mysql_query($sql_vista);
  if($sql_vista<>1){
    echo "<tr><td class='Td2' align='left'><b>vista_detalle_factura NO Creada</b></td></tr>";
  }
  
  /**************************************************************
  *** Vista para consultar detalle de facturacion con servicio
  *** Nombre: vista_factura_detalle_servicio
  **************************************************************/
  $sql_vista="CREATE OR REPLACE VIEW vista_factura_detalle_servicio AS
  SELECT detalle_factura.iden_fac, encabezado_factura.nume_fac,encabezado_factura.fcie_fac,encabezado_factura.codi_con,encabezado_factura.enti_fac,encabezado_factura.anul_fac,encabezado_factura.esta_fac,encabezado_factura.feci_fac,encabezado_factura.fecf_fac,encabezado_factura.rela_fac, detalle_factura.iden_dfa, detalle_factura.tipo_dfa, detalle_factura.iden_tco, detalle_factura.desc_dfa, detalle_factura.cant_dfa, detalle_factura.valu_dfa, detalle_factura.esta_dfa, detalle_factura.nauto_dfa, detalle_factura.cod_medi, detalle_factura.servi_dfa, destipos.nomb_des AS servicio, mapii.clas_map, destipos_1.nomb_des AS clase
  FROM ((((detalle_factura INNER JOIN encabezado_factura ON detalle_factura.iden_fac = encabezado_factura.iden_fac) LEFT JOIN destipos ON detalle_factura.servi_dfa = destipos.codi_des) LEFT JOIN tarco ON detalle_factura.iden_tco = tarco.iden_tco) LEFT JOIN mapii ON tarco.iden_map = mapii.iden_map) LEFT JOIN destipos AS destipos_1 ON mapii.clas_map = destipos_1.codi_des"; 
  //echo "<br>".$sql_vista;
  $sql_vista=mysql_query($sql_vista);
  if($sql_vista<>1){
    echo "<tr><td class='Td2' align='left'><b>vista_factura_detalle_servicio NO Creada</b></td></tr>";
  }
  

  /************************************************************************
  *** Vista para consultar detalle de facturacion para traslado a siigo
  *** Nombre: vista_detalle_factura_siigo
  ************************************************************************/
  $sql_vista="CREATE OR REPLACE VIEW vista_detalle_factura_siigo AS
  SELECT detalle_factura.iden_dfa, detalle_factura.tipo_dfa, detalle_factura.iden_fac, detalle_factura.iden_tco, detalle_factura.desc_dfa, detalle_factura.cant_dfa, detalle_factura.valu_dfa, mapii.cconcir_map
  FROM mapii RIGHT JOIN (tarco RIGHT JOIN detalle_factura ON tarco.iden_tco = detalle_factura.iden_tco) ON mapii.iden_map = tarco.iden_map";
  //echo "<br>".$sql_vista;
  $sql_vista=mysql_query($sql_vista);
  if($sql_vista<>1){
    echo "<tr><td class='Td2' align='left'><b>vista_detalle_factura_siigo NO Creada</b></td></tr>";
  }
  
  /************************************************************************
  *** Vista para consultar grupos quirurgicos parametrizados
  *** Nombre: vista_grupoqx_parametrizado
  ************************************************************************/
  $sql_vista="CREATE OR REPLACE VIEW vista_grupoqx_parametrizado AS
  SELECT grupoqx.iden_gqx, grupoqx.grup_gqx, grupoqx.desc_gqx, grupoqx.campo_gqx, grupoqx.cuenta_gqx, grupoxcont.iden_ctr, grupoxcont.valo_gxc, contratacion.codi_con, contratacion.esta_ctr
  FROM (grupoxcont INNER JOIN grupoqx ON grupoxcont.iden_gqx = grupoqx.iden_gqx) INNER JOIN contratacion ON grupoxcont.iden_ctr = contratacion.iden_ctr";
  //echo "<br>".$sql_vista;
  $sql_vista=mysql_query($sql_vista);
  if($sql_vista<>1){
    echo "<tr><td class='Td2' align='left'><b>vista_grupoqx_parametrizado NO Creada</b></td></tr>";
  }
  
  /**************************************************************
  *** Vista para consultar clases de actividad
  *** Nombre: vista_clase_actividad
  **************************************************************/
  $sql_vista="CREATE OR REPLACE VIEW vista_clase_actividad AS
  SELECT encabezado_factura.iden_fac, encabezado_factura.nume_fac, tarco.iden_tco, tarco.tser_tco, mapii.clas_map, mapii.codi_map, cups.codi_cup, mapii.cconcir_map, destipos.nomb_des
  FROM cups INNER JOIN (destipos INNER JOIN (mapii INNER JOIN (tarco INNER JOIN (encabezado_factura INNER JOIN detalle_factura ON encabezado_factura.iden_fac = detalle_factura.iden_fac) ON tarco.iden_tco = detalle_factura.iden_tco) ON mapii.iden_map = tarco.iden_map) ON destipos.codi_des = mapii.clas_map) ON cups.codigo = mapii.codi_map";
  //echo "<br>".$sql_vista;
  $sql_vista=mysql_query($sql_vista);
  if($sql_vista<>1){
    echo "<tr><td class='Td2' align='left'><b>vista_clase_actividad NO Creada</b></td></tr>";
  }
  
  /**************************************************************
  *** Vista para consultar medicamentos de la factura
  *** Nombre: vista_medicamento_detalle
  **************************************************************/
  $sql_vista="CREATE OR REPLACE VIEW vista_medicamento_detalle AS
  SELECT tarco.iden_tco, detalle_factura.iden_fac, encabezado_factura.nume_fac, medicamentos2.ncsi_medi, medicamentos2.nomb_mdi, cuentaxservicio.ctamed_cxs
  FROM (((tarco INNER JOIN medicamentos2 ON tarco.iden_map = medicamentos2.codi_mdi) INNER JOIN detalle_factura ON tarco.iden_tco = detalle_factura.iden_tco) INNER JOIN encabezado_factura ON detalle_factura.iden_fac = encabezado_factura.iden_fac) INNER JOIN cuentaxservicio ON encabezado_factura.area_fac = cuentaxservicio.codi_cxs";
  //echo "<br>".$sql_vista;
  $sql_vista=mysql_query($sql_vista);
  if($sql_vista<>1){
    echo "<tr><td class='Td2' align='left'><b>vista_medicamento_detalle NO Creada</b></td></tr>";
  }
  
  /**************************************************************
  *** Vista para consultar insumos de la factura
  *** Nombre: vista_insumo_detalle
  **************************************************************/
  $sql_vista="CREATE OR REPLACE VIEW vista_insumo_detalle AS
  SELECT insu_med.codi_ins, tarco.iden_tco, detalle_factura.iden_fac, encabezado_factura.nume_fac, cuentaxservicio.ctains_cxs
  FROM insu_med INNER JOIN (((tarco INNER JOIN detalle_factura ON tarco.iden_tco = detalle_factura.iden_tco) INNER JOIN encabezado_factura ON detalle_factura.iden_fac = encabezado_factura.iden_fac) INNER JOIN cuentaxservicio ON encabezado_factura.area_fac = cuentaxservicio.codi_cxs) ON insu_med.codi_ins = tarco.iden_map";
  //echo "<br>".$sql_vista;
  $sql_vista=mysql_query($sql_vista);
  if($sql_vista<>1){
    echo "<tr><td class='Td2' align='left'><b>vista_insumo_detalle NO Creada</b></td></tr>";
  }

  /**************************************************************
  *** Vista para consultar las gestiones de las ordenes
  *** Nombre: vista_gestion_ord
  **************************************************************/
  $sql_vista="CREATE OR REPLACE VIEW vista_gestion_ord AS
  SELECT usuario.TDOC_USU, usuario.NROD_USU, usuario.PNOM_USU, usuario.SNOM_USU, usuario.PAPE_USU, usuario.SAPE_USU, hist_var.iden_var, destipos_2.nomb_des AS CAMA, destipos_2.valo_des AS C_SERVICIO_SOL, IF(destipos_2.valo_des='04','URGENCIAS',destipos_3.nomb_des) AS SERV_SOLICITANTE, hist_var.iden_ser, destipos_1.nomb_des AS SERV_REMITIDO, gestion_ord.fecha_ges, gestion_ord.novedad_ges, destipos.nomb_des AS DESC_NOVEDAD, gestion_ord.descrip_ges, gestion_ord.opera_ges, cut.nomb_usua
  FROM ((((((hist_evo INNER JOIN (gestion_ord INNER JOIN hist_var ON gestion_ord.iden_var = hist_var.iden_var) ON hist_evo.iden_evo = hist_var.iden_evo) INNER JOIN destipos ON gestion_ord.novedad_ges = destipos.codi_des) INNER JOIN usuario ON hist_evo.codi_usu = usuario.CODI_USU) INNER JOIN destipos AS destipos_1 ON hist_var.iden_ser = destipos_1.codi_des) INNER JOIN cut ON gestion_ord.opera_ges = cut.ide_usua) INNER JOIN destipos AS destipos_2 ON hist_evo.cama_evo = destipos_2.codi_des) LEFT JOIN destipos AS destipos_3 ON destipos_2.valo_des = destipos_3.codi_des";
  //echo "<br>".$sql_vista;
  $sql_vista=mysql_query($sql_vista);
  if($sql_vista<>1){
    echo "<tr><td class='Td2' align='left'><b>vista_gestion_ord NO Creada</b></td></tr>";
  }
  
  /**************************************************************
  *** Vista para consultar las ordenes de hospitalizacion
  *** Nombre: vista_hist_var
  **************************************************************/
  $sql_vista="CREATE OR REPLACE VIEW vista_hist_var AS
  SELECT ingreso_hospitalario.id_ing, usuario.TDOC_USU, usuario.NROD_USU, usuario.PNOM_USU, usuario.SNOM_USU, usuario.PAPE_USU, usuario.SAPE_USU, usuario.FNAC_USU, contrato.NEPS_CON, hist_var.fech_var, hist_var.hora_var, hist_var.iden_evo, ingreso_hospitalario.codius_ing, hist_var.iden_var, hist_var.clas_var, hist_var.esta_var, destipos.valo_des, ingreso_hospitalario.caac_ing, destipos.nomb_des AS CAMA, destipos_1.nomb_des AS SERVICIO_REMITIDO, hist_var.especialidad_var
FROM (((usuario INNER JOIN (hist_var INNER JOIN (ingreso_hospitalario INNER JOIN hist_evo ON ingreso_hospitalario.id_ing = hist_evo.id_ing) ON hist_var.iden_evo = hist_evo.iden_evo) ON usuario.CODI_USU = ingreso_hospitalario.codius_ing) INNER JOIN destipos ON ingreso_hospitalario.caac_ing = destipos.codi_des) INNER JOIN destipos AS destipos_1 ON hist_var.iden_ser = destipos_1.codi_des) INNER JOIN contrato ON ingreso_hospitalario.contra_ing = contrato.CODI_CON";
  //echo "<br>".$sql_vista;
  $sql_vista=mysql_query($sql_vista);
  if($sql_vista<>1){
    echo "<tr><td class='Td2' align='left'><b>vista_hist_var NO Creada</b></td></tr>";
  }
  
  /***********************************************************************
  *** Vista para consultar las ordenes de hospitalizacion para facturacion
  *** Nombre: vista_hist_var_cups
  ************************************************************************/
  $sql_vista="CREATE OR REPLACE VIEW vista_hist_var_cups AS
  SELECT usuario.TDOC_USU, usuario.NROD_USU, usuario.PNOM_USU, usuario.SNOM_USU, usuario.PAPE_USU, usuario.SAPE_USU, ingreso_hospitalario.contra_ing, contrato.NEPS_CON, ingreso_hospitalario.id_ing, ingreso_hospitalario.fecin_ing, ingreso_hospitalario.hora_ing, hist_evo.iden_evo, hist_evo.cod_medi, medicos.nom_medi, hist_evo.fech_evo, hist_evo.cama_evo, destipos.nomb_des AS cama, destipos.valo_des AS cod_servicio, hist_var.iden_var, hist_var.fech_var, hist_var.hora_var, hist_var.clas_var, hist_var.iden_ser, cups.codi_cup, cups.descrip, hist_var.fact_var, hist_var.esta_var
  FROM (((contrato INNER JOIN (usuario INNER JOIN ((hist_evo INNER JOIN ingreso_hospitalario ON hist_evo.id_ing = ingreso_hospitalario.id_ing) INNER JOIN hist_var ON hist_evo.iden_evo = hist_var.iden_evo) ON usuario.CODI_USU = ingreso_hospitalario.codius_ing) ON contrato.CODI_CON = ingreso_hospitalario.contra_ing) INNER JOIN medicos ON hist_evo.cod_medi = medicos.cod_medi) INNER JOIN destipos ON hist_evo.cama_evo = destipos.codi_des) INNER JOIN cups ON hist_var.iden_ser = cups.codigo";
  //echo "<br>".$sql_vista;
  $sql_vista=mysql_query($sql_vista);
  if($sql_vista<>1){
    echo "<tr><td class='Td2' align='left'><b>vista_hist_var_cups NO Creada</b></td></tr>";
  }
  
  /**************************************************************
  *** Vista para consultar las lecturas de imagenologia
  *** Nombre: vista_lectura_imagen
  **************************************************************/
  $sql_vista="CREATE OR REPLACE VIEW vista_lectura_imagen AS
  SELECT usuario.CODI_USU, usuario.TDOC_USU, usuario.NROD_USU, usuario.PNOM_USU, usuario.SNOM_USU, usuario.PAPE_USU, usuario.SAPE_USU, usuario.MATE_USU, usuario.MRES_USU, usuario.FNAC_USU, usuario.SEXO_USU, usuario.ZONA_USU, usuario.TPAF_USU, contrato.NEPS_CON, enca_rips.iden_ecr, enca_rips.fech_ecr, enca_rips.fina_ecr, enca_rips.fasi_ecr, enca_rips.oper_ecr, enca_rips.meds_ecr, medicos.nom_medi, enca_rips.ambi_ecr, enca_rips.serv_ecr, enca_rips.hora_ecr, enca_rips.cont_ecr, deta_rips.esta_der, deta_rips.dxpr_der, cie_10.nom_cie10, deta_rips.iden_der, deta_rips.cant_der, deta_rips.factu_der, cups.codigo, cups.codi_cup, cups.descrip, cups.refe_cup, areas.nom_areas AS SERV_SOLICITANTE, lectura_imagen.fech_lec, lectura_imagen.arso_lec, areas.codi_des AS SERV_SOLI, lectura_imagen.lect_lec, lectura_imagen.esta_lec, lectura_imagen.radi_lec, medicos_1.nom_medi AS RADIOLOGO, lectura_imagen.iden_var
  FROM (((cups INNER JOIN (cie_10 INNER JOIN (medicos INNER JOIN (lectura_imagen INNER JOIN ((enca_rips INNER JOIN deta_rips ON enca_rips.iden_ecr = deta_rips.iden_ecr) INNER JOIN usuario ON enca_rips.iden_uco = usuario.CODI_USU) ON lectura_imagen.iden_var = deta_rips.iden_der) ON medicos.cod_medi = enca_rips.meds_ecr) ON cie_10.cod_cie10 = deta_rips.dxpr_der) ON cups.codigo = deta_rips.codp_der) INNER JOIN medicos AS medicos_1 ON lectura_imagen.radi_lec = medicos_1.cod_medi) LEFT JOIN areas ON lectura_imagen.arso_lec = areas.cod_areas) INNER JOIN contrato ON enca_rips.cont_ecr = contrato.CODI_CON";
  //echo "<br>".$sql_vista;
  $sql_vista=mysql_query($sql_vista);
  if($sql_vista<>1){
    echo "<tr><td class='Td2' align='left'><b>vista_lectura_imagen NO Creada</b></td></tr>";
  }

 /**************************************************************
  *** Vista para consultar los rips de procedimientos
  *** Nombre: vista_rips_procedimientos
  **************************************************************/
  $sql_vista="CREATE OR REPLACE VIEW vista_rips_procedimientos AS
  SELECT enca_rips.iden_ecr, usuario.CODI_USU, usuario.TDOC_USU, usuario.NROD_USU, usuario.FNAC_USU, usuario.SEXO_USU, enca_rips.fech_ecr, enca_rips.naut_ecr,deta_rips.codp_der, cups.codi_cup, enca_rips.ambi_ecr, enca_rips.fina_ecr,deta_rips.iden_der, deta_rips.dxpr_der, deta_rips.dxre_der, deta_rips.dxco_der, deta_rips.cant_der, enca_rips.ttod_ecr, enca_rips.ppro_ecr, enca_rips.cont_ecr, usuario.MATE_USU, municipio.CODI_MUN AS MRES_USU, enca_rips.meds_ecr, medicos.espe_med, usuario.TPAF_USU, usuario.REGI_USU, usuario.ZONA_USU, usuario.OCUP_USU, enca_rips.hora_ecr, enca_rips.fasi_ecr, enca_rips.oper_ecr, enca_rips.serv_ecr, enca_rips.area_ecr, destipos.nomb_des, deta_rips.factu_der
FROM ((municipio INNER JOIN ((usuario INNER JOIN (enca_rips INNER JOIN deta_rips ON enca_rips.iden_ecr = deta_rips.iden_ecr) ON usuario.CODI_USU = enca_rips.iden_uco) INNER JOIN cups ON deta_rips.codp_der = cups.codigo) ON municipio.NOMB_MUN = usuario.MRES_USU) INNER JOIN medicos ON enca_rips.meds_ecr = medicos.cod_medi) LEFT JOIN destipos ON enca_rips.serv_ecr = destipos.codi_des";
  //echo "<br>".$sql_vista;
  $sql_vista=mysql_query($sql_vista);
  if($sql_vista<>1){
    echo "<tr><td class='Td2' align='left'><b>vista_rips_procedimientos NO Creada</b></td></tr>";
  }
  

 /**************************************************************
  *** Vista para consultar los rips de procedimientos
  *** Nombre: vista_procedimientos_medicos
  **************************************************************/
  $sql_vista="CREATE OR REPLACE VIEW vista_procedimientos_medicos AS
  SELECT procedimientos_medicos.iden_proc, procedimientos_medicos.codusu_proc, usuario.TDOC_USU, usuario.NROD_USU, usuario.PNOM_USU, usuario.SNOM_USU, usuario.PAPE_USU, usuario.SAPE_USU, usuario.FNAC_USU, usuario.SEXO_USU,usuario.MATE_USU,usuario.MRES_USU,usuario.TPAF_USU,usuario.REGI_USU, usuario.ZONA_USU, procedimientos_medicos.contrato_proc, contrato.NEPS_CON, procedimientos_medicos.medico_proc, medicos.nom_medi, procedimientos_medicos.area_proc, areas.nom_areas, areas.codi_des, procedimientos_medicos.numc_proc, procedimientos_medicos.fecha_proc, procedimientos_medicos.hora_proc, procedimientos_medicos.codproced_proc, cups.codi_cup, cups.descrip, procedimientos_medicos.dxingreso_proc, cie_10.nom_cie10, procedimientos_medicos.descripcion_proc, procedimientos_medicos.dxegreso_proc, procedimientos_medicos.dxrelegreo_proc, procedimientos_medicos.dxcompliegreso_proc, procedimientos_medicos.estado_proc, procedimientos_medicos.finalidad_proc, procedimientos_medicos.ambito_proc, procedimientos_medicos.factu_proc
  FROM (((((usuario 
  INNER JOIN procedimientos_medicos ON usuario.CODI_USU = procedimientos_medicos.codusu_proc) 
  INNER JOIN contrato ON procedimientos_medicos.contrato_proc = contrato.CODI_CON) 
  INNER JOIN medicos ON procedimientos_medicos.medico_proc = medicos.cod_medi) 
  INNER JOIN areas ON procedimientos_medicos.area_proc = areas.cod_areas) 
  INNER JOIN cups ON procedimientos_medicos.codproced_proc = cups.codigo) 
  INNER JOIN cie_10 ON procedimientos_medicos.dxingreso_proc = cie_10.cod_cie10
  WHERE procedimientos_medicos.estado_proc='F'";
  //echo "<br>".$sql_vista;
  $sql_vista=mysql_query($sql_vista);
  if($sql_vista<>1){
    echo "<tr><td class='Td2' align='left'><b>vista_procedimientos_medicos NO Creada</b></td></tr>";
  }
  
  /**************************************************************
  *** Vista para consultar las ordenes fuera del departamento
  *** Nombre: vista_orden
  **************************************************************/
    $sql_vista="CREATE OR REPLACE VIEW vista_orden AS
    SELECT referencia.idre_ref, orden.nume_ord, orden.fech_ord, orden.fcit_ord, orden.esta_ord, destipos_2.nomb_des AS ALTO_COSTO, referencia.moti_ref, usuario.NROD_USU, usuario.PNOM_USU, usuario.SNOM_USU, usuario.PAPE_USU, usuario.SAPE_USU, FLOOR(DATEDIFF(orden.fech_ord,usuario.FNAC_USU)/365.25) AS EDAD, usuario.DIRE_USU, usuario.TRES_USU, usuario.TEL2_USU, contrato.NEPS_CON, arc_ent.tpid_ent, arc_ent.nrid_ent, arc_ent.razs_ent, municipio.NOMB_MUN AS MUN_ENTIDAD, departamento.NOMB_DEP AS DEP_ENTIDAD, actxorden.codi_axo, cups.codi_cup, cups.descrip, actxorden.nota_axo, destipos.nomb_des AS ESPECIALIDAD, destipos_1.nomb_des AS ESTADO, municipio_1.NOMB_MUN AS MUN_ORIGEN, referencia.msol_ref, medicos.nom_medi, orden.asol_ord, areas.nom_areas, orden.conf_ord, orden.oper_ord, vista_cut.nomb_usua AS operador,actxorden.cant_axo AS cantidad
    FROM (((destipos AS destipos_2 
    RIGHT JOIN (municipio AS municipio_1 
    RIGHT JOIN (((((departamento 
    INNER JOIN ((((usuario 
    INNER JOIN ucontrato ON usuario.CODI_USU = ucontrato.CUSU_UCO) 
    INNER JOIN (referencia 
    INNER JOIN orden ON referencia.idre_ref = orden.nume_ref) ON ucontrato.IDEN_UCO = referencia.cuco_ref) 
    INNER JOIN contrato ON ucontrato.CONT_UCO = contrato.CODI_CON) 
    INNER JOIN (municipio 
    INNER JOIN arc_ent ON municipio.CODI_MUN = arc_ent.codi_mun) ON orden.enti_ord = arc_ent.iden_ent) ON departamento.CODI_DEP = municipio.DEPA_MUN) 
    INNER JOIN actxorden ON orden.nume_ord = actxorden.noor_axo) 
    INNER JOIN cups ON actxorden.codi_axo = cups.codigo) 
    INNER JOIN destipos ON orden.espe_ord = destipos.codi_des) 
    INNER JOIN destipos AS destipos_1 ON orden.esta_ord = destipos_1.codi_des) ON municipio_1.CODI_MUN = referencia.origen_ref) ON destipos_2.codi_des = orden.acos_ord) 
    LEFT JOIN medicos ON referencia.msol_ref = medicos.cod_medi) 
    INNER JOIN areas ON orden.asol_ord = areas.cod_areas) 
    LEFT JOIN vista_cut ON orden.oper_ord = vista_cut.ide_usua";
  //echo "<br>".$sql_vista;
  $sql_vista=mysql_query($sql_vista);
  if($sql_vista<>1){
    echo "<tr><td class='Td2' align='left'><b>vista_orden NO Creada</b></td></tr>";
  }
  

  /**************************************************************
  *** Vista para consultar las actividades de quirofano
  *** Nombre: vista_quirofano_detalle
  **************************************************************/
  $sql_vista="CREATE OR REPLACE VIEW vista_quirofano_detalle AS
SELECT encabezado_qx.iden_qxf, encabezado_qx.fech_qxf, encabezado_qx.fecf_pro, encabezado_qx.ccir_qxf, encabezado_qx.hini_qxf, encabezado_qx.hfin_qxf, encabezado_qx.ctro_usu, contrato.NEPS_CON, destipos_1.nomb_des AS PROCEDENCIA, destipos.valo_des AS COD_AMBITO, destipos.nomb_des AS AMBITO, destipos_3.valo_des AS COD_FINALI, destipos_2.nomb_des AS DESTINO, detalle_cirujia.iden_cir, detalle_cirujia.ccup_cir, cups.codi_cup, cups.descrip, encabezado_qx.dxpe_cir, encabezado_qx.dxpo_cir, detalle_cirujia.factu_cir, detalle_cirujia.oper_cir, medicos.nom_medi, usuario.CODI_USU, usuario.TDOC_USU, usuario.NROD_USU, usuario.PNOM_USU, usuario.SNOM_USU, usuario.PAPE_USU, usuario.SAPE_USU, usuario.FNAC_USU, usuario.SEXO_USU, usuario.TPAF_USU, usuario.REGI_USU, usuario.MATE_USU, usuario.MRES_USU, usuario.ZONA_USU
FROM destipos AS destipos_3 INNER JOIN ((destipos AS destipos_2 INNER JOIN ((destipos INNER JOIN ((((detalle_cirujia INNER JOIN encabezado_qx ON detalle_cirujia.iden_qxf = encabezado_qx.iden_qxf) INNER JOIN cups ON detalle_cirujia.ccup_cir = cups.codigo) INNER JOIN contrato ON encabezado_qx.ctro_usu = contrato.CODI_CON) INNER JOIN usuario ON encabezado_qx.iden_uco = usuario.CODI_USU) ON destipos.codi_des = encabezado_qx.ambi_qxf) INNER JOIN destipos AS destipos_1 ON encabezado_qx.proc_qxf = destipos_1.codi_des) ON destipos_2.codi_des = encabezado_qx.dest_qxf) LEFT JOIN medicos ON detalle_cirujia.oper_cir = medicos.cod_medi) ON destipos_3.codi_des = encabezado_qx.fina_qxf";
  //echo "<br>".$sql_vista;
  $sql_vista=mysql_query($sql_vista);
  if($sql_vista<>1){
    echo "<tr><td class='Td2' align='left'><b>vista_quirofano_detalle NO Creada</b></td></tr>";
  }
  

  /**************************************************************
  *** Vista para consultar personal de quirofano que participa en la cirugia
  *** Nombre: vista_personal_qx
  **************************************************************/
  $sql_vista="CREATE OR REPLACE VIEW vista_personal_qx AS
  SELECT personal_qx.iden_qx, medicos.nom_medi, personal_qx.tipp_qx, destipos.nomb_des AS ESPECIALIDAD
  FROM medicos INNER JOIN (destipos INNER JOIN personal_qx ON destipos.codi_des = personal_qx.tipp_qx) ON medicos.cod_medi = personal_qx.codp_qx";
  //echo "<br>".$sql_vista;
  $sql_vista=mysql_query($sql_vista);
  if($sql_vista<>1){
    echo "<tr><td class='Td2' align='left'><b>vista_personal_qx NO Creada</b></td></tr>";
  }
  

  /**************************************************************
  *** Vista para consultar usuarios magisterio con medico familiar
  *** Nombre: vista_usuario_medicofam
  **************************************************************/
  $sql_vista="CREATE OR REPLACE VIEW vista_usuario_medicofam AS
  SELECT usuario.TDOC_USU, usuario.NROD_USU, usuario.PNOM_USU, usuario.SNOM_USU, usuario.PAPE_USU, usuario.SAPE_USU, usuario.FNAC_USU, usuario.SEXO_USU, usuario.DIRE_USU, usuario.TRES_USU, usuario.MATE_USU, municipio.NOMB_MUN, ucontrato.ESTA_UCO, cotadicional.MEDF_COT, medicos.nom_medi
  FROM (((usuario INNER JOIN ucontrato ON usuario.CODI_USU = ucontrato.CUSU_UCO) INNER JOIN cotadicional ON usuario.CODI_USU = cotadicional.CUSU_COT) LEFT JOIN medicos ON cotadicional.MEDF_COT = medicos.cod_medi) INNER JOIN municipio ON usuario.MATE_USU = municipio.CODI_MUN
  WHERE (((ucontrato.ESTA_UCO)='AC') AND ((ucontrato.CONT_UCO)='002'))";
  //echo "<br>".$sql_vista;
  $sql_vista=mysql_query($sql_vista);
  if($sql_vista<>1){
    echo "<tr><td class='Td2' align='left'><b>vista_usuario_medicofam NO Creada</b></td></tr>";
  }
  

  /**************************************************************
  *** Vista para consultar triage
  *** Nombre: vista_consulta_triage
  **************************************************************/
  $sql_vista="CREATE OR REPLACE VIEW vista_consulta_triage AS
  SELECT usuario.NROD_USU, usuario.PNOM_USU, usuario.SNOM_USU, usuario.PAPE_USU, usuario.SAPE_USU,usuario.fnac_usu,TRUNCATE(DATEDIFF(triage_urgencias.fech_tri,usuario.fnac_usu)/365.25,0) AS EDAD, encabesadohistoria.cont_ehi, contrato.NEPS_CON, triage_urgencias.iden_cita, horarios.Fecha_horario, horarios.Hora_horario, triage_urgencias.fech_tri, triage_urgencias.hora_tri, triage_urgencias.clas2_tri, consultaprincipal.numc_cpl, consultaprincipal.feca_cpl, consultaprincipal.hora_cpl, consultaprincipal.hosa_cpl, triage_urgencias.mrsk_tri, destipos.nomb_des, destipos.valo_des, triage_urgencias.obse_tri  
  FROM (contrato INNER JOIN (usuario INNER JOIN (encabesadohistoria INNER JOIN (consultaprincipal INNER JOIN ((citas INNER JOIN triage_urgencias ON citas.id_cita = triage_urgencias.iden_cita) INNER JOIN horarios ON citas.ID_horario = horarios.ID_horario) ON consultaprincipal.numc_cpl = citas.numc_adx) ON encabesadohistoria.numc_ehi = consultaprincipal.numc_cpl) ON usuario.CODI_USU = encabesadohistoria.cous_ehi) ON contrato.CODI_CON = encabesadohistoria.cont_ehi) INNER JOIN destipos ON triage_urgencias.mrsk_tri = destipos.codi_des
  WHERE consultaprincipal.numc_cpl<>''";
  //echo "<br>".$sql_vista;
  $sql_vista=mysql_query($sql_vista);
  if($sql_vista<>1){
    echo "<tr><td class='Td2' align='left'><b>vista_consulta_triage NO Creada</b></td></tr>";
  }
  

  /**************************************************************
  *** Vista para consultar banco de sangre
  *** Nombre: vista_banco_sangre
  **************************************************************/
  $sql_vista="CREATE OR REPLACE VIEW vista_banco_sangre AS
  SELECT banco_sangre.fech_ban, medicamentos2.nomb_mdi, destipos.nomb_des AS PROVEEDOR, If(conc_ban='E','Externo','Devolucion') AS Ingreso, banco_sangre.nuni_ban, banco_sangre.pilo_ban, banco_sangre.fven_ban, banco_sangre.grRH_ban, banco_sangre.scal_ban, banco_sangre.fesa_ban, usuario.TDOC_USU, usuario.NROD_USU, usuario.PNOM_USU, usuario.SNOM_USU, usuario.PAPE_USU, usuario.SAPE_USU, usuario.FNAC_USU, usuario.SEXO_USU, destipos_1.nomb_des AS SERVICIO, cut.nomb_usua, banco_sangre.esta_ban
  FROM (((destipos INNER JOIN (banco_sangre INNER JOIN medicamentos2 ON banco_sangre.codi_mdi = medicamentos2.codi_mdi) ON destipos.codi_des = banco_sangre.prov_ban) INNER JOIN usuario ON banco_sangre.codi_usu = usuario.CODI_USU) INNER JOIN destipos AS destipos_1 ON banco_sangre.area_ban = destipos_1.codi_des) INNER JOIN cut ON banco_sangre.bact_ban = cut.ide_usua";
  //echo "<br>".$sql_vista;
  $sql_vista=mysql_query($sql_vista);
  if($sql_vista<>1){
    echo "<tr><td class='Td2' align='left'><b>vista_banco_sangre NO Creada</b></td></tr>";
  }
  
  /**************************************************************
  *** Vista para consultar facturas para siigo
  *** Nombre: vista_factura_siigo
  **************************************************************/
  
  /*
  $sql_vista="CREATE OR REPLACE VIEW vista_factura_siigo AS
  SELECT encabezado_factura.iden_fac, encabezado_factura.tipo_fac, encabezado_factura.enti_fac, encabezado_factura.pref_fac, encabezado_factura.nume_fac, 
  encabezado_factura.rela_fac, encabezado_factura.fcie_fac, encabezado_factura.vtot_fac, encabezado_factura.vcop_fac, encabezado_factura.cmod_fac, 
  encabezado_factura.pdes_fac, encabezado_factura.vnet_fac, encabezado_factura.area_fac, encabezado_factura.anul_fac, contratacion.ccon_ctr, 
  contratacion.iden_ctr, servicioxdoc.tipfac_sxd, contrato.CODI_CDC, contrato.NIT_CON
  FROM servicioxdoc RIGHT JOIN (contrato INNER JOIN (encabezado_factura INNER JOIN contratacion ON encabezado_factura.iden_ctr = contratacion.iden_ctr) ON 
  contrato.CODI_CON = contratacion.codi_con) ON servicioxdoc.codser_sxd = encabezado_factura.area_fac";
  */
	$sql_vista="CREATE OR REPLACE VIEW vista_factura_siigo AS
	SELECT encabezado_factura.iden_fac,encabezado_factura.id_ing, encabezado_factura.tipo_fac, encabezado_factura.enti_fac, encabezado_factura.pref_fac, encabezado_factura.nume_fac, encabezado_factura.rela_fac, encabezado_factura.feci_fac,encabezado_factura.fecf_fac,encabezado_factura.fcie_fac, encabezado_factura.vtot_fac, encabezado_factura.vcop_fac, encabezado_factura.cmod_fac, encabezado_factura.pdes_fac, encabezado_factura.vnet_fac, encabezado_factura.area_fac, encabezado_factura.anul_fac, encabezado_factura.cod_cie10, contratacion.ccon_ctr, contratacion.iden_ctr,contratacion.rcod_ctr, servicioxdoc.tipfac_sxd, contrato.CODI_CDC, contrato.NIT_CON,
	usuario.NROD_USU,usuario.PNOM_USU ,usuario.SNOM_USU ,usuario.PAPE_USU ,usuario.SAPE_USU,usuario.FNAC_USU,usuario.ESTR_USU,usuario.REGI_USU,usuario.MRES_USU,usuario.TPAF_USU,
	destipos.nomb_des as servicio,cie_10.nom_cie10
	FROM servicioxdoc 
	RIGHT JOIN (contrato 
	INNER JOIN (encabezado_factura 
	INNER JOIN contratacion ON encabezado_factura.iden_ctr = contratacion.iden_ctr) ON contrato.CODI_CON = contratacion.codi_con) ON servicioxdoc.codser_sxd = encabezado_factura.area_fac
	INNER JOIN usuario on usuario.CODI_USU =encabezado_factura.codi_usu
	LEFT JOIN destipos ON destipos.codi_des=encabezado_factura.area_fac
	INNER JOIN cie_10 ON cie_10.cod_cie10=encabezado_factura.cod_cie10";

  
  
  //echo "<br>".$sql_vista;
  $sql_vista=mysql_query($sql_vista);
  if($sql_vista<>1){
    echo "<tr><td class='Td2' align='left'><b>vista_factura_siigo NO Creada</b></td></tr>";
  }
  
  /**************************************************************
  *** Vista para consultar facturas anuladas (notas debito) para siigo
  *** Nombre: vista_anulafac_siigo
  **************************************************************/
  $sql_vista="CREATE OR REPLACE VIEW vista_anulafac_siigo AS
  SELECT anulafac.iden_anu,anulafac.iden_fac,anulafac.fech_anu,anulafac.numerond_anu,
  encabezado_factura.tipo_fac,encabezado_factura.enti_fac,encabezado_factura.pref_fac,encabezado_factura.rela_fac,encabezado_factura.vtot_fac,encabezado_factura.pdes_fac,encabezado_factura.vnet_fac,encabezado_factura.nume_fac,encabezado_factura.area_fac,
	contrato.CODI_CDC,contratacion.ccon_ctr
	FROM anulafac
	INNER JOIN encabezado_factura ON encabezado_factura.iden_fac=anulafac.iden_fac
	INNER JOIN contratacion ON contratacion.iden_ctr=encabezado_factura.iden_ctr
	INNER JOIN contrato ON contrato.codi_con=contratacion.codi_con";
  //echo "<br>".$sql_vista;
  $sql_vista=mysql_query($sql_vista);
  if($sql_vista<>1){
    echo "<tr><td class='Td2' align='left'><b>vista_anulafac_siigo NO Creada</b></td></tr>";
  }
  
  /**************************************************************
  *** Vista para consultar detalle_labs
  *** Nombre: vista_detalle_labs
  **************************************************************/
  $sql_vista="CREATE OR REPLACE VIEW vista_detalle_labs AS
  SELECT detalle_labs.nord_dlab, usuario.CODI_USU, usuario.TDOC_USU, usuario.NROD_USU, usuario.PNOM_USU, usuario.SNOM_USU, usuario.PAPE_USU, usuario.SAPE_USU, usuario.TPAF_USU,usuario.REGI_USU, usuario.FNAC_USU, usuario.SEXO_USU, usuario.MATE_USU, municipio.NOMB_MUN, usuario.MRES_USU, usuario.ZONA_USU, encabezado_labs.iden_labs, encabezado_labs.iden_cita, detalle_labs.iden_dlab, encabezado_labs.fchr_labs, detalle_labs.codigo, cups.codi_cup, cups.descrip, cups.grup_quim, destipos.nomb_des AS DESC_QUIMICA, encabezado_labs.ambi_labs, encabezado_labs.fina_labs, encabezado_labs.dxo_labs, cie_10.nom_cie10, encabezado_labs.ctr_labs, contrato.NEPS_CON, encabezado_labs.cod_medi AS MED_SOLICITA, medicos_1.nom_medi AS NOMBRE_MED_SOL, medicos_1.are_medi AS AREA_MED_SOL, medicos_1.espe_med, destipos_1.nomb_des AS ESPECIALIDAD, detalle_labs.cod_medi AS MED_REALIZA, detalle_labs.estd_dlab, encabezado_labs.hrar_labs, encabezado_labs.prog_labs, encabezado_labs.fche_labs, detalle_labs.fech_dlab, detalle_labs.hora_dlab, encabezado_labs.resp_labs, detalle_labs.obsv_dlab, detalle_labs.refe_dlab, detalle_labs.unid_dlab, detalle_labs.etdv_dlab, encabezado_labs.iden_evo, detalle_labs.lrem_dlab, destipos_2.nomb_des AS REMITIDO, detalle_labs.factu_dlab
  FROM ((((((contrato INNER JOIN (((detalle_labs INNER JOIN encabezado_labs ON detalle_labs.iden_labs = encabezado_labs.iden_labs) INNER JOIN usuario ON encabezado_labs.codi_usu = usuario.CODI_USU) INNER JOIN cups ON detalle_labs.codigo = cups.codigo) ON contrato.CODI_CON = encabezado_labs.ctr_labs) LEFT JOIN destipos ON cups.grup_quim = destipos.codi_des) INNER JOIN medicos AS medicos_1 ON encabezado_labs.cod_medi = medicos_1.cod_medi) INNER JOIN municipio ON usuario.MATE_USU = municipio.CODI_MUN) LEFT JOIN destipos AS destipos_1 ON medicos_1.espe_med = destipos_1.codi_des) LEFT JOIN destipos AS destipos_2 ON detalle_labs.lrem_dlab = destipos_2.codi_des) INNER JOIN cie_10 ON encabezado_labs.dxo_labs = cie_10.cod_cie10";
  //echo "<br>".$sql_vista;
  $sql_vista=mysql_query($sql_vista);
  if($sql_vista<>1){
    echo "<tr><td class='Td2' align='left'><b>vista_detalle_labs NO Creada</b></td></tr>";
  }

  /**************************************************************
  *** Vista para consultar detalle_labs y labo_inter_winsislab
  *** Nombre: vista_labo_inter_winsislab
  **************************************************************/
  $sql_vista="CREATE OR REPLACE VIEW vista_labo_inter_winsislab AS
  SELECT encabezado_labs.prog_labs, detalle_labs.codigo, labo_inter_winsislab.RESULTADO, encabezado_labs.fchr_labs
  FROM (encabezado_labs INNER JOIN detalle_labs ON encabezado_labs.iden_labs = detalle_labs.iden_labs) INNER JOIN labo_inter_winsislab ON detalle_labs.iden_dlab = labo_inter_winsislab.iden_dlab";
  //echo "<br>".$sql_vista;
  $sql_vista=mysql_query($sql_vista);
  if($sql_vista<>1){
    echo "<tr><td class='Td2' align='left'><b>vista_labo_inter_winsislab NO Creada</b></td></tr>";
  }
  
  /**************************************************************
  *** Vista para consultar terapias fisicas
  *** Nombre: vista_terapia_fisica
  **************************************************************/
  $sql_vista="CREATE OR REPLACE VIEW vista_terapia_fisica AS
  SELECT ter_control.iden_tcon, ter_historia.codi_usu, usuario.TDOC_USU, usuario.NROD_USU, usuario.TPAF_USU, usuario.MATE_USU, municipio.CODI_MUN AS COD_MUN_RES, usuario.MRES_USU, usuario.FNAC_USU, usuario.SEXO_USU, usuario.REGI_USU, usuario.ZONA_USU, usuario.OCUP_USU, ter_control.fecha_tcon, ter_control.proced_tcon, cups.codi_cup, cups.descrip, ter_historia.ambit_this, ter_historia.dxprinc_this, ter_historia.cont_this, ter_control.codmedi_tcon, ter_control.factu_tcon
  FROM (((ter_control INNER JOIN ter_historia ON ter_control.iden_this = ter_historia.iden_this) INNER JOIN usuario ON ter_historia.codi_usu = usuario.CODI_USU) INNER JOIN municipio ON usuario.MRES_USU = municipio.NOMB_MUN) INNER JOIN cups ON ter_control.proced_tcon = cups.codigo";
  //echo "<br>".$sql_vista;
  $sql_vista=mysql_query($sql_vista);
  if($sql_vista<>1){
    echo "<tr><td class='Td2' align='left'><b>vista_terapia_fisica NO Creada</b></td></tr>";
  }
  
  /**************************************************************
  *** Vista para consultar terapias respiratoria
  *** Nombre: vista_terapia_respiratoria
  **************************************************************/
  $sql_vista="CREATE OR REPLACE VIEW vista_terapia_respiratoria AS
  SELECT tres_historia.iden_tre, tres_historia.codi_usu, usuario.TDOC_USU, usuario.NROD_USU, usuario.MATE_USU, municipio.CODI_MUN AS COD_MUN_RES, usuario.MRES_USU, usuario.TPAF_USU, usuario.FNAC_USU, usuario.SEXO_USU, usuario.REGI_USU, usuario.ZONA_USU, usuario.OCUP_USU, tres_historia.fecha_tre,tres_historia.tratam_tre, cups.codi_cup, tres_historia.ambit_tre, tres_historia.dxprinc_tre, tres_historia.cont_tre, tres_historia.codmedi_tre, tres_historia.factu_tre
  FROM ((tres_historia INNER JOIN usuario ON tres_historia.codi_usu = usuario.CODI_USU) INNER JOIN cups ON tres_historia.tratam_tre = cups.codigo) INNER JOIN municipio ON (usuario.MRES_USU = municipio.NOMB_MUN) AND (usuario.MRES_USU = municipio.NOMB_MUN)";
  //echo "<br>".$sql_vista;
  $sql_vista=mysql_query($sql_vista);
  if($sql_vista<>1){
    echo "<tr><td class='Td2' align='left'><b>vista_terapia_respiratoria NO Creada</b></td></tr>";
  }
  

  /*******************************************************************
  *** Vista para consultar evoluciones de terapia en hospitalizacion
  *** Nombre: vista_terapia_evolucion
  ******************************************************************/
  $sql_vista="CREATE OR REPLACE VIEW vista_terapia_evolucion AS
  SELECT usuario.TDOC_USU, usuario.NROD_USU, usuario.PNOM_USU, usuario.SNOM_USU, usuario.PAPE_USU, usuario.SAPE_USU, ingreso_hospitalario.contra_ing, contrato.NEPS_CON, terapia_evolucion.iden_ter, terapia_evolucion.id_ing, terapia_evolucion.fech_ter, terapia_evolucion.hora_ter, terapia_evolucion.medi_ter, medicos.nom_medi, terapia_evolucion.cama_ter, destipos_1.nomb_des AS cama, destipos_1.valo_des AS cod_servicio, terapia_evolucion.diag_ter, terapia_evolucion.tipo_ter, destipos.codi_des AS cod_actividad, cups.codi_cup, cups.codigo, cups.descrip, destipos.codt_des, destipos.nomb_des AS actividad, cups.esta_cup, terapia_evolucion.nota_ter, terapia_evolucion.esta_ter, terapia_evolucion.fact_ter
  FROM (contrato INNER JOIN (usuario INNER JOIN ((((terapia_evolucion INNER JOIN destipos ON terapia_evolucion.tipo_ter = destipos.valo_des) INNER JOIN medicos ON terapia_evolucion.medi_ter = medicos.cod_medi) INNER JOIN destipos AS destipos_1 ON terapia_evolucion.cama_ter = destipos_1.codi_des) INNER JOIN ingreso_hospitalario ON terapia_evolucion.id_ing = ingreso_hospitalario.id_ing) ON usuario.CODI_USU = ingreso_hospitalario.codius_ing) ON contrato.CODI_CON = ingreso_hospitalario.contra_ing) INNER JOIN cups ON destipos.val2_des = cups.codigo";
  //echo "<br>".$sql_vista;
  $sql_vista=mysql_query($sql_vista);
  if($sql_vista<>1){
    echo "<tr><td class='Td2' align='left'><b>vista_terapia_evolucion NO Creada</b></td></tr>";
  }
  

  /***************************************************************************
  *** Vista para consultar insumos utilizados en terapias de hospitalizacion
  *** Nombre: vista_terapia_insumos
  ***************************************************************************/
  $sql_vista="CREATE OR REPLACE VIEW vista_terapia_insumos AS
  SELECT usuario.CODI_USU, usuario.TDOC_USU, usuario.NROD_USU, usuario.PNOM_USU, usuario.SNOM_USU, usuario.PAPE_USU, usuario.SAPE_USU, ingreso_hospitalario.id_ing, ingreso_hospitalario.fecin_ing, ingreso_hospitalario.contra_ing, contrato.NEPS_CON, terapia_salinsu.iden_sal, terapia_salinsu.tpin_sal, terapia_salinsu.idin_sal, insu_med.codi_ins, insu_med.desc_ins, terapia_salinsu.fech_sal, terapia_salinsu.hora_sal, terapia_salinsu.admi_sal, terapia_salinsu.devo_sal, terapia_salinsu.esta_sal, terapia_salinsu.resp_sal, medicos.nom_medi, terapia_salinsu.fact_sal
  FROM ((usuario INNER JOIN (contrato INNER JOIN (terapia_salinsu INNER JOIN ingreso_hospitalario ON terapia_salinsu.id_ing = ingreso_hospitalario.id_ing) ON contrato.CODI_CON = ingreso_hospitalario.contra_ing) ON usuario.CODI_USU = ingreso_hospitalario.codius_ing) INNER JOIN medicos ON terapia_salinsu.resp_sal = medicos.cod_medi) INNER JOIN insu_med ON terapia_salinsu.idin_sal = insu_med.codi_ins 
  WHERE terapia_salinsu.tpin_sal='I'";
  //echo "<br>".$sql_vista;
  $sql_vista=mysql_query($sql_vista);
  if($sql_vista<>1){
    echo "<tr><td class='Td2' align='left'><b>vista_terapia_insumos NO Creada</b></td></tr>";
  }
  

  /***************************************************************************
  *** Vista para consultar medicamentos utilizados en terapias de hospitalizacion
  *** Nombre: vista_terapia_medicamentos
  ***************************************************************************/
  $sql_vista="CREATE OR REPLACE VIEW vista_terapia_medicamentos AS
  SELECT usuario.CODI_USU, usuario.TDOC_USU, usuario.NROD_USU, usuario.PNOM_USU, usuario.SNOM_USU, usuario.PAPE_USU, usuario.SAPE_USU, ingreso_hospitalario.id_ing, ingreso_hospitalario.fecin_ing, ingreso_hospitalario.contra_ing, contrato.NEPS_CON, terapia_salinsu.iden_sal, terapia_salinsu.tpin_sal, terapia_salinsu.idin_sal,CONCAT(nomb_mdi,' ',noco_mdi,' ',desc_ffa) AS nombre_mdi, terapia_salinsu.fech_sal, terapia_salinsu.hora_sal, terapia_salinsu.admi_sal, terapia_salinsu.devo_sal, terapia_salinsu.esta_sal, terapia_salinsu.resp_sal, medicos.nom_medi, terapia_salinsu.fact_sal
  FROM (((usuario INNER JOIN (contrato INNER JOIN (terapia_salinsu INNER JOIN ingreso_hospitalario ON terapia_salinsu.id_ing = ingreso_hospitalario.id_ing) ON contrato.CODI_CON = ingreso_hospitalario.contra_ing) ON usuario.CODI_USU = ingreso_hospitalario.codius_ing) INNER JOIN medicamentos2 ON terapia_salinsu.idin_sal = medicamentos2.codi_mdi) INNER JOIN medicos ON terapia_salinsu.resp_sal = medicos.cod_medi) INNER JOIN forma_farmaceutica ON medicamentos2.coff_mdi = forma_farmaceutica.codi_ffa
  WHERE terapia_salinsu.tpin_sal='M'";
  //echo "<br>".$sql_vista;
  $sql_vista=mysql_query($sql_vista);
  if($sql_vista<>1){
    echo "<tr><td class='Td2' align='left'><b>vista_terapia_medicamentos NO Creada</b></td></tr>";
  }

  /*******************************************************************
  *** Vista para consultar las ordenes varias para facturacion
  *** Nombre: vista_ordenvarias
  ******************************************************************/
  $sql_vista="CREATE OR REPLACE VIEW vista_ordenvarias AS
  SELECT usuario.CODI_USU, usuario.TDOC_USU, usuario.NROD_USU, usuario.PNOM_USU, usuario.SNOM_USU, usuario.PAPE_USU, usuario.SAPE_USU, ingreso_hospitalario.id_ing, ingreso_hospitalario.contra_ing, contrato.NEPS_CON, hist_evo.iden_evo, hist_evo.fech_evo, hist_evo.hora_evo, hist_evo.cod_medi, medicos.nom_medi, hist_evo.cama_evo, destipos.nomb_des AS desc_cama, destipos_1.codt_des, destipos.valo_des AS cod_servicio, destipos_1.nomb_des AS servicio, ordenvarias.iden_ord, ordenvarias.codi_ord, ordenvarias.orde_ord, destipos_2.codt_des AS grupo_ord, destipos_2.nomb_des AS descrip_ord, destipos_2.valo_des AS codigo, ordenvarias.coox_ord, ordenvarias.obse_ord, ordenvarias.fech_ord, ordenvarias.hora_ord, ordenvarias.esta_ord, ordenvarias.fact_ord
  FROM usuario INNER JOIN (contrato INNER JOIN (ingreso_hospitalario INNER JOIN ((((destipos INNER JOIN (ordenvarias INNER JOIN hist_evo ON ordenvarias.iden_evo = hist_evo.iden_evo) ON destipos.codi_des = hist_evo.cama_evo) INNER JOIN destipos AS destipos_1 ON destipos.valo_des = destipos_1.codi_des) INNER JOIN medicos ON hist_evo.cod_medi = medicos.cod_medi) INNER JOIN destipos AS destipos_2 ON ordenvarias.orde_ord = destipos_2.codi_des) ON ingreso_hospitalario.id_ing = hist_evo.id_ing) ON contrato.CODI_CON = ingreso_hospitalario.contra_ing) ON usuario.CODI_USU = ingreso_hospitalario.codius_ing";
  //echo "<br>".$sql_vista;
  $sql_vista=mysql_query($sql_vista);
  if($sql_vista<>1){
    echo "<tr><td class='Td2' align='left'><b>vista_ordenvarias NO Creada</b></td></tr>";
  }  

  /**************************************************************
  *** Vista para consultar citas de laboratorios
  *** Nombre: vista_ane_lab_cit
  **************************************************************/
  $sql_vista="CREATE OR REPLACE VIEW vista_ane_lab_cit AS
  SELECT citas.id_cita, citas.ID_horario, citas.Fsolusu_citas, horarios.Fecha_horario, ane_lab_cit.basico, ane_lab_cit.especial, ane_lab_cit.remitidos, citas.Cotra_citas, ane_lab_cit.obser, usuario.MRES_USU, citas.obse_cita, horarios.Cserv_horario
  FROM ((citas INNER JOIN horarios ON citas.ID_horario = horarios.ID_horario) INNER JOIN ane_lab_cit ON citas.id_cita = ane_lab_cit.cod_cita) INNER JOIN usuario ON citas.Idusu_citas = usuario.CODI_USU";
  //echo "<br>".$sql_vista;
  $sql_vista=mysql_query($sql_vista);
  if($sql_vista<>1){
    echo "<tr><td class='Td2' align='left'><b>vista_ane_lab_cit NO Creada</b></td></tr>";
  }
  

  /**************************************************************
  *** Vista para consultar laboratorios de hospitalizacion
  *** Nombre: vista_labs_evo
  **************************************************************/
  $sql_vista="CREATE OR REPLACE VIEW vista_labs_evo AS
  SELECT usuario.NROD_USU, usuario.PNOM_USU, usuario.SNOM_USU, usuario.PAPE_USU, usuario.SAPE_USU, usuario.MRES_USU, detalle_labs.nord_dlab, cups.codigo, cups.codi_cup, cups.descrip, mapii.valsoa_map, detalle_labs.estd_dlab, detalle_labs.fech_dlab, detalle_labs.hora_dlab, hist_evo.cama_evo, destipos.nomb_des AS CAMA, destipos.valo_des, destipos_2.nomb_des AS AREA, encabezado_labs.iden_labs, encabezado_labs.iden_evo, encabezado_labs.cod_medi, medicos.nom_medi, encabezado_labs.fchr_labs, encabezado_labs.hrar_labs, encabezado_labs.ambi_labs, cups.grup_quim, destipos_1.nomb_des AS DESC_QUIMICA, encabezado_labs.ctr_labs, contrato.NEPS_CON
FROM (((((destipos AS destipos_1 RIGHT JOIN ((((cups INNER JOIN detalle_labs ON cups.codigo = detalle_labs.codigo) INNER JOIN encabezado_labs ON detalle_labs.iden_labs = encabezado_labs.iden_labs) INNER JOIN hist_evo ON encabezado_labs.iden_evo = hist_evo.iden_evo) INNER JOIN destipos ON hist_evo.cama_evo = destipos.codi_des) ON destipos_1.codi_des = cups.grup_quim) LEFT JOIN destipos AS destipos_2 ON destipos.valo_des = destipos_2.codi_des) INNER JOIN contrato ON encabezado_labs.ctr_labs = contrato.CODI_CON) INNER JOIN medicos ON encabezado_labs.cod_medi = medicos.cod_medi) LEFT JOIN mapii ON cups.codigo = mapii.codi_map) INNER JOIN usuario ON encabezado_labs.codi_usu = usuario.CODI_USU";

  //echo "<br>".$sql_vista;
  $sql_vista=mysql_query($sql_vista);
  if($sql_vista<>1){
    echo "<tr><td class='Td2' align='left'><b>vista_labs_evo NO Creada</b></td></tr>";
  }
  

  /**************************************************************
  *** Vista para consultar actividades tarifadas
  *** Nombre: vista_tarco
  **************************************************************/
  $sql_vista="CREATE OR REPLACE VIEW vista_tarco AS
  SELECT cups.codigo, cups.codi_cup, cups.descrip, cups.esta_cup, mapii.iden_map, mapii.codi_map, tarco.iden_tco, tarco.iden_ctr, tarco.tser_tco, destipos.nomb_des AS SERVICIO, tarco.clas_tco, tarco.valo_tco, tarco.grqx_tco, tarco.esta_tco
  FROM ((cups INNER JOIN mapii ON cups.codigo = mapii.codi_map) INNER JOIN tarco ON mapii.iden_map = tarco.iden_map) INNER JOIN destipos ON tarco.tser_tco = destipos.codi_des";
  //echo "<br>".$sql_vista;
  $sql_vista=mysql_query($sql_vista);
  if($sql_vista<>1){
    echo "<tr><td class='Td2' align='left'><b>vista_tarco NO Creada</b></td></tr>";
  }
  

  /**************************************************************
  *** Vista para generar autocomplete con codigo cups en la descripción
  *** Nombre: vista_tarco_cups
  **************************************************************/
  $sql_vista="CREATE OR REPLACE VIEW vista_tarco_cups AS
  SELECT tarco.iden_tco, tarco.iden_ctr, tarco.clas_tco, mapii.esta_map, CONCAT(cups.codi_cup,' ',mapii.desc_map) AS descripcion, tarco.valo_tco,tarco.esta_tco
  FROM cups RIGHT JOIN (mapii INNER JOIN tarco ON mapii.iden_map = tarco.iden_map) ON cups.codigo = mapii.codi_map
  WHERE mapii.esta_map='AC'";
  //echo "<br>".$sql_vista;
  $sql_vista=mysql_query($sql_vista);
  if($sql_vista<>1){
    echo "<tr><td class='Td2' align='left'><b>vista_tarco_cups NO Creada</b></td></tr>";  
  }

  /**************************************************************
  *** Vista para consultar los valores de medicamentos parametrizados
  *** Nombre: vista_medicamentos_tarco
  **************************************************************/
  $sql_vista="CREATE OR REPLACE VIEW vista_medicamentos_tarco AS
  SELECT tarco.iden_tco, medicamentos2.codi_mdi, medicamentos2.nomb_mdi, tarco.valo_tco, tarco.iden_ctr
  FROM medicamentos2 INNER JOIN tarco ON medicamentos2.codi_mdi = tarco.iden_map";
  //echo "<br>".$sql_vista;
  $sql_vista=mysql_query($sql_vista);
  if($sql_vista<>1){
    echo "<tr><td class='Td2' align='left'><b>vista_medicamentos_tarco NO Creada</b></td></tr>";
  }

  /**************************************************************
  *** Vista para consultar los valores de insumos parametrizados
  *** Nombre: vista_insumos_tarco
  **************************************************************/
  $sql_vista="CREATE OR REPLACE VIEW vista_insumos_tarco AS
  SELECT tarco.iden_tco, insu_med.codi_ins,insu_med.desc_ins, tarco.valo_tco, tarco.iden_ctr
  FROM insu_med INNER JOIN tarco ON insu_med.codi_ins = tarco.iden_map";
  //echo "<br>".$sql_vista;
  $sql_vista=mysql_query($sql_vista);
  if($sql_vista<>1){
    echo "<tr><td class='Td2' align='left'><b>vista_insumos_tarco NO Creada</b></td></tr>";
  }
  
  /**************************************************************
  *** Vista para consultar rips de consulta
  *** Nombre: vista_rips_consulta
  **************************************************************/
  $sql_vista="CREATE OR REPLACE VIEW vista_rips_consulta AS
  SELECT rips_consulta.iden_fac, 520010066901 AS id_prestador,usuario.CODI_USU, usuario.TDOC_USU, usuario.NROD_USU, rips_consulta.fcon_rip,'' AS autorizacion,rips_consulta.cups_rip, cups.codi_cup, rips_consulta.fina_rip, rips_consulta.cext_rip, rips_consulta.digp_rip, rips_consulta.dgr1_rip, rips_consulta.dgr2_rip, '' AS diag3, rips_consulta.tidx_rip, 0 AS valconsul, 0 AS valcuomod, 0 AS valneto, '' AS presmedic, '' AS laboclini, '' AS radiologi, '' AS ecografi, '' AS otros, '' AS terarespi, '' AS terafisic, '' AS teralengu, '' AS teraocupa, '' AS codremis, '' AS condinter, '' AS condcontr, '' AS condhospi, '' AS condcoext, '' AS condatdom, '' AS condning, rips_consulta.prep_rip AS prime_repe, citas.Cotra_citas, usuario.MATE_USU, municipio.CODI_MUN AS mun_reside, horarios.Cmed_horario, '' AS medreempl, rips_consulta.cmed_rip AS medsolicit, medicos.espe_med, usuario.TPAF_USU, TRUNCATE((DATEDIFF(rips_consulta.fcon_rip,usuario.FNAC_USU))/365.25,0) AS edad, 'A' AS unidad, usuario.SEXO_USU, usuario.REGI_USU, usuario.ZONA_USU, usuario.OCUP_USU, SUBSTRING(horarios.Hora_horario,11,6) AS hora, '' AS programa, rips_consulta.area_rip, rips_consulta.fedg_rip AS fecha_sistema, horarios.Fecha_horario AS fecha_original,horarios.Cserv_horario,rips_consulta.factu_rip
  FROM (medicos INNER JOIN (municipio INNER JOIN ((usuario INNER JOIN (rips_consulta INNER JOIN citas ON rips_consulta.id_cita = citas.id_cita) ON usuario.CODI_USU = citas.Idusu_citas) INNER JOIN cups ON rips_consulta.cups_rip = cups.codigo) ON municipio.NOMB_MUN = usuario.MRES_USU) ON medicos.cod_medi = rips_consulta.cmed_rip) INNER JOIN horarios ON citas.ID_horario = horarios.ID_horario";
  //echo "<br>".$sql_vista;
  $sql_vista=mysql_query($sql_vista);
  if($sql_vista<>1){
    echo "<tr><td class='Td2' align='left'><b>vista_rips_consulta NO Creada</b></td></tr>";
  }
  

  /**************************************************************
  *** Vista para consutar consultas por enfermera de pacientes cronicos
  *** Nombre: vista_enfermera_cronicos
  **************************************************************/
  $sql_vista="CREATE OR REPLACE VIEW vista_enfermera_cronicos AS
  SELECT enferm_cronicos.parm_crn, enferm_cronicos.parn_crn, enferm_cronicos.fenf_crn, pac_cronicos.iden_uco, pac_cronicos.dx1_pcr, cie_10.nom_cie10, enferm_cronicos.oper_crn
  FROM (enferm_cronicos INNER JOIN pac_cronicos ON enferm_cronicos.iden_uco = pac_cronicos.iden_uco) INNER JOIN cie_10 ON pac_cronicos.dx1_pcr = cie_10.cod_cie10";
  //echo "<br>".$sql_vista;
  $sql_vista=mysql_query($sql_vista);
  if($sql_vista<>1){
    echo "<tr><td class='Td2' align='left'><b>vista_enfermera_cronicos NO Creada</b></td></tr>";
  }
  
  /**************************************************************
  *** Vista para consutar consultas de pacientes cronicos
  *** Nombre: vista_consulta_cronicos
  **************************************************************/
  $sql_vista="CREATE OR REPLACE VIEW vista_consulta_cronicos AS
  SELECT cr_signos.tarts1_crn, cr_signos.tarts2_crn, anteced_cronicos.iden_uco, cr_diagnos.hipdx_crn, consultaprincipal.vers_apli, consultaprincipal.feca_cpl, cie_10.nom_cie10
  FROM (consultaprincipal INNER JOIN encabesadohistoria ON consultaprincipal.numc_cpl = encabesadohistoria.numc_ehi) INNER JOIN (((anteced_cronicos INNER JOIN cr_diagnos ON anteced_cronicos.iden_crn = cr_diagnos.iden_crn) INNER JOIN cr_signos ON anteced_cronicos.iden_crn = cr_signos.iden_crn) INNER JOIN cie_10 ON cr_diagnos.hipdx_crn = cie_10.cod_cie10) ON consultaprincipal.numc_cpl = cr_signos.numhisto
  WHERE consultaprincipal.numc_cpl<>''";
  //echo "<br>".$sql_vista;
  $sql_vista=mysql_query($sql_vista);
  if($sql_vista<>1){
    echo "<tr><td class='Td2' align='left'><b>vista_consulta_cronicos NO Creada</b></td></tr>";
  }
  

  /**************************************************************
  *** Vista para consultar formulas dispensadas (formedica)
  *** Nombre: vista_formuladet
  **************************************************************/
  /*$sql_vista="CREATE OR REPLACE VIEW formedica.vista_formuladet AS
  SELECT formedica.formulamae.nume_for, formedica.formuladet.regi_for, formedica.formulamae.fdis_for, formedica.formulamae.tido_for, formedica.tipodocum.desc_tip, formedica.tipodocum.conc_tip, formedica.formulamae.tdis_for, formedica.formulamae.servicio_for, destipos.nomb_des AS servicio, formedica.formulamae.contrato_for, contrato.NEPS_CON, formedica.formulamae.dxprin_for, formedica.formulamae.codi_medi, formedica.formulamae.coduni_usu, formedica.formulamae.codi_usu, formedica.formulamae.nume_con, formedica.formuladet.codi_pro, medicamentos2.ncsi_medi, medicamentos2.nomb_mdi, formedica.formuladet.cdis_for, formedica.formuladet.factu_for
  FROM contrato RIGHT JOIN (destipos RIGHT JOIN (((formedica.formulamae INNER JOIN formedica.formuladet ON formedica.formulamae.nume_for = formedica.formuladet.nume_for) INNER JOIN medicamentos2 ON formedica.formuladet.codi_pro = medicamentos2.codi_mdi) INNER JOIN formedica.tipodocum ON formedica.formulamae.tido_for = formedica.tipodocum.codi_tip) ON destipos.codi_des = formedica.formulamae.servicio_for) ON contrato.CODI_CON = formedica.formulamae.contrato_for";*/

  $sql_vista="CREATE OR REPLACE VIEW formedica.vista_formuladet AS
  SELECT formedica.formulamae.nume_for, formedica.formuladet.regi_for, formedica.formulamae.fdis_for, formedica.formulamae.tido_for, formedica.tipodocum.desc_tip, formedica.tipodocum.conc_tip, formedica.formulamae.tdis_for, formedica.formulamae.servicio_for, destipos.nomb_des AS servicio, formedica.formulamae.contrato_for, contrato.NEPS_CON, formedica.formulamae.dxprin_for, formedica.formulamae.codi_medi, formedica.formulamae.coduni_usu, formedica.formulamae.codi_usu, formedica.formulamae.nume_con, formedica.formuladet.codi_pro, medicamentos2.ncsi_medi, CONCAT(medicamentos2.nomb_mdi,' ',medicamentos2.noco_mdi,' ',forma_farmaceutica.desc_ffa) AS nomb_mdi, formedica.formuladet.cdis_for, formedica.formuladet.factu_for
  FROM contrato 
  RIGHT JOIN (destipos 
  RIGHT JOIN (((formedica.formulamae 
  INNER JOIN formedica.formuladet ON formedica.formulamae.nume_for = formedica.formuladet.nume_for) 
  INNER JOIN medicamentos2 ON formedica.formuladet.codi_pro = medicamentos2.codi_mdi) 
  INNER JOIN formedica.tipodocum ON formedica.formulamae.tido_for = formedica.tipodocum.codi_tip
  INNER JOIN forma_farmaceutica ON forma_farmaceutica.codi_ffa=medicamentos2.coff_mdi
  ) ON destipos.codi_des = formedica.formulamae.servicio_for) ON contrato.CODI_CON = formedica.formulamae.contrato_for";


  //echo "<br>".$sql_vista;
  $sql_vista=mysql_query($sql_vista);
  if($sql_vista<>1){
    echo "<tr><td class='Td2' align='left'><b>vista_formuladet NO Creada</b></td></tr>";
  }
  

  /**************************************************************
  *** Vista para consultar insumos dispensados (formedica)
  *** Nombre: vista_formula_insumos
  **************************************************************/
  $sql_vista="CREATE OR REPLACE VIEW formedica.vista_formula_insumos AS
  SELECT formedica.formulamae.nume_for, formedica.formuladet.regi_for, formedica.formulamae.fdis_for, formedica.formulamae.tido_for, formedica.tipodocum.desc_tip, formedica.tipodocum.conc_tip, formedica.formulamae.tdis_for, formedica.formulamae.servicio_for, destipos.nomb_des AS servicio, formedica.formulamae.contrato_for, contrato.NEPS_CON, formedica.formulamae.dxprin_for, formedica.formulamae.codi_medi, formedica.formulamae.coduni_usu, formedica.formulamae.codi_usu, formedica.formulamae.nume_con, formedica.formuladet.codi_pro, insu_med.codi_ins, insu_med.desc_ins, formedica.formuladet.cdis_for, formedica.formuladet.factu_for
FROM insu_med INNER JOIN (contrato RIGHT JOIN (destipos RIGHT JOIN ((formedica.formulamae INNER JOIN formedica.formuladet ON formedica.formulamae.nume_for = formedica.formuladet.nume_for) INNER JOIN formedica.tipodocum ON formedica.formulamae.tido_for = formedica.tipodocum.codi_tip) ON destipos.codi_des = formedica.formulamae.servicio_for) ON contrato.CODI_CON = formedica.formulamae.contrato_for) ON insu_med.codi_ins = formedica.formuladet.codi_pro";
  //echo "<br>".$sql_vista;
  $sql_vista=mysql_query($sql_vista);
  if($sql_vista<>1){
    echo "<tr><td class='Td2' align='left'><b>vista_formula_insumos NO Creada</b></td></tr>";
  }
  
  /**************************************************************
  *** Vista para consultar la informacion del usuario (general)
  *** Nombre: vista_cut
  **************************************************************/
  $sql_vista="CREATE OR REPLACE VIEW vista_cut AS
  SELECT cut.ide_usua, cut.nomb_usua FROM general.cut";
  //echo "<br>".$sql_vista;
  $sql_vista=mysql_query($sql_vista);
  if($sql_vista<>1){
    echo "<tr><td class='Td2' align='left'><b>vista_cut NO Creada</b></td></tr>";
  }
  

  /**************************************************************
  *** Vista para consultar la informacion de usuario con contrato
  *** Nombre: vista_usuario_contrato
  **************************************************************/
  $sql_vista="CREATE OR REPLACE VIEW vista_usuario_contrato AS
  SELECT usuario.CODI_USU, usuario.TDOC_USU, usuario.NROD_USU, usuario.PNOM_USU, usuario.SNOM_USU, usuario.PAPE_USU, usuario.SAPE_USU, usuario.FNAC_USU, usuario.SEXO_USU, usuario.DIRE_USU, usuario.TRES_USU, usuario.TEL2_USU, usuario.ZONA_USU, usuario.MRES_USU, usuario.MATE_USU, municipio.NOMB_MUN, usuario.REGI_USU, usuario.TPAF_USU, usuario.ESTR_USU, usuario.DCOT_USU, usuario.PARE_USU, ucontrato.MODA_UCO, ucontrato.ESTA_UCO, contrato.CODI_CON, contrato.NEPS_CON,contrato.ESTA_CON
  FROM ((usuario INNER JOIN ucontrato ON usuario.CODI_USU = ucontrato.CUSU_UCO) INNER JOIN contrato ON ucontrato.CONT_UCO = contrato.CODI_CON) INNER JOIN municipio ON usuario.MATE_USU = municipio.CODI_MUN";
  $sql_vista=mysql_query($sql_vista);
  if($sql_vista<>1){
    echo "<tr><td class='Td2' align='left'><b>vista_usuario_contrato NO Creada</b></td></tr>";
  }
  

  /**************************************************************
  *** Vista para consultar la informacion de registros de recaudos
  *** Nombre: vista_recaudo
  **************************************************************/
  $sql_vista="CREATE OR REPLACE VIEW vista_recaudo AS
  SELECT recaudo.id_recaudo, recaudo.codi_usu, usuario.TDOC_USU, usuario.NROD_USU, usuario.PNOM_USU, usuario.SNOM_USU, usuario.PAPE_USU, usuario.SAPE_USU, usuario.MATE_USU, municipio.NOMB_MUN, recaudo.codi_con, contrato.NEPS_CON, recaudo.fechagen_rec, recaudo.tipo_rec, recaudo.nivel_rec, recaudo.valor_rec, recaudo.pagado_rec, recaudo.fechapag_rec, recaudo.estado_rec, destipos.nomb_des AS estado
  FROM (((recaudo INNER JOIN usuario ON recaudo.codi_usu = usuario.CODI_USU) INNER JOIN contrato ON recaudo.codi_con = contrato.CODI_CON) INNER JOIN municipio ON usuario.MATE_USU = municipio.CODI_MUN) INNER JOIN destipos ON recaudo.estado_rec = destipos.codi_des";
  $sql_vista=mysql_query($sql_vista);
  if($sql_vista<>1){
    echo "<tr><td class='Td2' align='left'><b>vista_recaudo NO Creada</b></td></tr>";
  }
  
  
  /**************************************************************
  *** Vista para consultar la informacion de consulta de salud ocupacional
  *** Nombre: vista_consulta_salud_ocupacional
  **************************************************************/
  $sql_vista="CREATE OR REPLACE VIEW vista_consulta_salud_ocupacional AS
  SELECT so_encahistoria.iden_enc, so_encahistoria.nhis_inf, so_encahistoria.dpri_enc, so_infpersonal.codi_usu, so_infpersonal.cont_inf, so_infpersonal.codi_med, so_infpersonal.area_inf, areas.codi_des, destipos.nomb_des AS servicio, so_infpersonal.fech_inf, so_encahistoria.factu_enc, so_infpersonal.tico_inf, areas.ccup_prim, areas.ccup_cont
  FROM ((so_infpersonal INNER JOIN so_encahistoria ON so_infpersonal.nhis_inf = so_encahistoria.nhis_inf) INNER JOIN areas ON so_infpersonal.area_inf = areas.cod_areas) INNER JOIN destipos ON areas.codi_des = destipos.codi_des";  
  $sql_vista=mysql_query($sql_vista);
  if($sql_vista<>1){
    echo "<tr><td class='Td2' align='left'><b>vista_consulta_salud_ocupacional NO Creada</b></td></tr>";
  }
  

  /**************************************************************
  *** Vista para consultar la informacion de citologias
  *** Nombre: vista_citologia
  **************************************************************/
  $sql_vista="CREATE OR REPLACE VIEW vista_citologia AS
  SELECT horarios.ID_horario, horarios.Cserv_horario AS area, areas.nom_areas, areas.codi_des, citas.id_cita, citas.Cotra_citas, contrato.NEPS_CON, histocc_datb.iden_his, histocc_datb.cod_usu, histocc_datb.cod_medi, histocc_datb.fechacon, histocc_datb.hora, histocc_datb.procede, histocc_pararips.cocucon_hpri, histocc_pararips.finacon_hpri, histocc_pararips.caexcon_hpri, histocc_pararips.iden_hpri, histocc_pararips.ciecon10_hpri, histocc_pararips.tipcon_hpri, histocc_pararips.cocupro_hpri, histocc_pararips.ambipro_hpri, histocc_pararips.factu_hpri, histocc_pararips.iden_dfa
  FROM (((citas INNER JOIN (histocc_pararips INNER JOIN histocc_datb ON histocc_pararips.cod_cita = histocc_datb.cod_cita) ON citas.id_cita = histocc_datb.cod_cita) INNER JOIN contrato ON citas.Cotra_citas = contrato.CODI_CON) INNER JOIN horarios ON citas.ID_horario = horarios.ID_horario) INNER JOIN areas ON horarios.Cserv_horario = areas.cod_areas";
  //echo "<br>".$sql_vista;
  $sql_vista=mysql_query($sql_vista);
  if($sql_vista<>1){
    echo "<tr><td class='Td2' align='left'><b>vista_citologia NO Creada</b></td></tr>";  
  }
  
  /**************************************************************
  *** Vista para consultar la informacion de medicamentos para generar SISMED
  *** Nombre: vista_sismed
  **************************************************************/
  $sql_vista="CREATE OR REPLACE VIEW vista_sismed AS
  SELECT CONCAT(month(sismed_006.fecha_fact),sismed_006.tp_operacion,sismed_006.tp_transaccion,sismed_006.expediente,sismed_006.consecutivo) AS codigo,sismed_006.id_sismed,month(sismed_006.fecha_fact) AS mes, sismed_006.numero_fact, sismed_006.tp_operacion, sismed_006.tp_transaccion, sismed_006.ium_nivel1, sismed_006.ium_nivel2, sismed_006.ium_nivel3, sismed_006.expediente,sismed_006.consecutivo,CONCAT(sismed_006.expediente,'-',sismed_006.consecutivo) AS codigo_cum,sismed_006.unidad,sismed_006.cantidad,sismed_006.valor_unitario
	FROM sismed_006";
  $sql_vista=mysql_query($sql_vista);
  if($sql_vista<>1){
    echo "<tr><td class='Td2' align='left'><b>vista_sismed NO Creada</b></td></tr>";  
  }

  ?>
</table>
</form>
</body>
</html>