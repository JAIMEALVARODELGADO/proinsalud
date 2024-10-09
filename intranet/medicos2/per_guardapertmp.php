<?php
session_start();
include("php/conexion.php");
//Aqui guardo la informacion de la persona
$sql_="INSERT INTO persona (id_persona, tipo_iden, numer_iden, pnombre, snombre, papellido, sapellido, fecha_nac, direccion, telefono, sexo, email, hemoclasif) 
VALUES (0, '$tipo_iden', '$numer_iden', '$pnombre', '$snombre', '$papellido', '$sapellido', '$fecha_nac', '$direccion', '$telefono', '$sexo', '$email', '$hemoclasif')";
//echo $sql_;
mysql_query($sql_);
$id_persona=mysql_insert_id();
$mensaje="";
//Aqui guardo al profesional de salud
if($chkasistencial=='on'){
  $consulta="SELECT cod_medi FROM medicos WHERE cod_medi='$cod_medi'";
  //echo "<br>".$consulta;
  $consulta=mysql_query($consulta);
  if(mysql_num_rows($consulta)==0){
    if($csii_med<>0){
      $consultacsii="SELECT csii_med FROM medicos WHERE csii_med='$csii_med'";
      $consultacsii=mysql_query($consultacsii);
      if(mysql_num_rows($consultacsii)<>0){
        $csii_med=0;
        $mensaje='El código SIIGO está duplicado. El registro se guardó con cero(0) en este código';
      }
    }

    $nom_medi=$pnombre;
    if(!empty($snombre)){$nom_medi.' '.$snombre;}
    if(!empty($papellido)){$nom_medi.' '.$papellido;}
    if(!empty($sapellido)){$nom_medi.' '.$sapellido;}
    $sql_="INSERT INTO medicos (cod_medi,nom_medi,dir__medi,telf_medi,are_medi,esta_medi,ced_medi,reg_medi,csii_med,espe_med,tido_medi,pnom_medi,snom_medi,pape_medi,sape_medi) VALUES ('$cod_medi','$nom_medi','$direccion','$telefono','$are_medi','A','$numer_iden','$reg_medi','$csii_med','$espe_med','$tipo_iden','$pnombre','$snombre','$papellido','$sapellido')";
    //echo "<br>".$sql_;
    mysql_query($sql_);
    $sql_="INSERT INTO areas_medic (areas_ar,cod_med_ar,esta_ar) VALUES ('$areas_ar','$cod_medi','A')";
    //echo "<br>".$sql_;
    mysql_query($sql_);
    if($mensaje<>''){
      ?>
      <script languge="JavaSctipt">alert(<?php echo $mensaje;?>);</script>
      <?php
    }
  }
  else{
    ?>
    <script languge="JavaSctipt">alert("El profesional de la salud no fué guardado, el codigo ya existe");</script>
    <?php
  }
}

$hoy=date("Y-m-d");
//echo "<br>".$hoy;
//Aqui guardo la informacion como paciente (usuario)
if($chkocupacional=='on'){
  $consulta="SELECT codi_usu FROM usuario WHERE tdoc_usu='$tipo_iden' AND nrod_usu='$numer_iden'";
  //echo "<br>".$consulta;
  $consulta=mysql_query($consulta);
  $cont_uco='130';
  if(mysql_num_rows($consulta)==0){
    $sql_="INSERT INTO usuario(CODI_USU,TDOC_USU,NROD_USU,PNOM_USU,SNOM_USU,PAPE_USU,SAPE_USU,FNAC_USU,SEXO_USU,DIRE_USU,TRES_USU,TEL2_USU,ZONA_USU,MRES_USU,MATE_USU,REGI_USU,TPAF_USU,FING_USU,ESTR_USU,DCOT_USU,PARE_USU,FVIN_USU,HEMO_USU,ESTA_USU,EMAI_USU,IDMA_USU,ETNI_USU,NEDU_USU,OCUP_USU,ECIV_USU,OPER_USU) VALUES (0,'$tipo_iden','$numer_iden','$pnombre','$snombre','$papellido','$sapellido','$fecha_nac','$sexo','$direccion','$telefono','','U','PASTO','52001','1','C','$hoy','1','$numer_iden','9','','$hemoclasif','A','$email','','$etnia','$niveledu','$codigo_ciuo','$eciv','$Gidusuper')";
    //echo "<br>".$sql_;
    mysql_query($sql_);
    $codi_usu=mysql_insert_id();    
    $sql_="INSERT INTO ucontrato(IDEN_UCO,	CUSU_UCO,  CONT_UCO,	MODA_UCO,	ESTA_UCO,	OPER_UCO) values (0,'$codi_usu','$cont_uco','E','AC','$Gidusuper')";
    //echo "<br>".$sql_;
    mysql_query($sql_);
    $iden_uco=mysql_insert_id();
    $sql_="INSERT INTO nusuario (CODI_NUS, IUCO_NUS,CNOV_NUS, FECH_NUS, FINI_NUS, FFIN_NUS, VALO_NUS, ESTA_NU, OPER_NUS) VALUES (0,'$iden_uco','I02','$hoy','$hoy','','','AC','$Gidusuper')";
    //echo "<br>".$sql_;
    mysql_query($sql_);
  }
  else{
    $rowusu=mysql_fetch_array($consulta);
    $codi_usu=$rowusu[codi_usu];
    $consultacon="SELECT iden_uco FROM ucontrato WHERE CUSU_UCO='$codi_usu' AND CONT_UCO='$cont_uco'";
    //echo "<br>".$consultacon;
    $consultacon=mysql_query($consultacon);
    if(mysql_num_rows($consultacon)==0){
      $sql_="INSERT INTO ucontrato(IDEN_UCO,  CUSU_UCO,  CONT_UCO,  MODA_UCO, ESTA_UCO, OPER_UCO) values (0,'$codi_usu','$cont_uco','E','AC','$Gidusuper')";
      //echo "<br>".$sql_;
      mysql_query($sql_);
      $iden_uco=mysql_insert_id();
      $sql_="INSERT INTO nusuario (CODI_NUS, IUCO_NUS,CNOV_NUS, FECH_NUS, FINI_NUS, FFIN_NUS, VALO_NUS, ESTA_NUS, OPER_NUS) VALUES (0,'$iden_uco','I02','$hoy','$hoy','','ACTIVACION PARA SGSST','AC','$Gidusuper')";
      //echo "<br>".$sql_;
      mysql_query($sql_);
    }
  }
}
mysql_close();
?>
<!-- Regresa a la pagina anterior -->
<HTML>
<head>
<title>Regresa a la pagina anterior</title>
<Script Language="JavaScript">
function cargar(){
    document.form1.submit();
}
</Script>
</head>
<body bgcolor='#E6E8FA' onload='javascript:cargar()'>
<form name='form1' method='post' action='per_muestrapertmp.php'>
  <input type='hidden' name='id_persona' value='<?echo $id_persona;?>'>
</form>
</body>
</HTML>
<html><head></head><body></body></html>