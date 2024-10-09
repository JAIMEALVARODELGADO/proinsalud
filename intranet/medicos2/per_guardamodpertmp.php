<?php
session_start();
include("php/conexion.php");
//Aqui guardo la informacion de la persona
$sql_="UPDATE persona SET tipo_iden='$tipo_iden', numer_iden='$numer_iden', pnombre='$pnombre', snombre='$snombre', papellido='$papellido', sapellido='$sapellido', fecha_nac='$fecha_nac', direccion='$direccion', telefono='$telefono', sexo='$sexo', email='$email', hemoclasif='$hemoclasif' WHERE id_persona='$id_persona'";
//echo $sql_;
mysql_query($sql_);
//Aqui guardo al profesional de salud
if($chkasistencial=='on'){
  $consulta="SELECT cod_medi FROM medicos WHERE cod_medi='$cod_medi'";
  //echo "<br>".$consulta;
  $consulta=mysql_query($consulta);
  if(mysql_num_rows($consulta)==0){
    $nom_medi=$pnombre;
    if(!empty($snombre)){$nom_medi.' '.$snombre;}
    if(!empty($papellido)){$nom_medi.' '.$papellido;}
    if(!empty($sapellido)){$nom_medi.' '.$sapellido;}
    $sql_="INSERT INTO medicos (cod_medi,nom_medi,dir__medi,telf_medi,are_medi,esta_medi,ced_medi,reg_medi,csii_med,espe_med,tido_medi,pnom_medi,snom_medi,pape_medi,sape_medi) VALUES ('$cod_medi','$nom_medi','$direccion','$telefono','$are_medi','A','$numer_iden','$reg_medi','$csii_med','$espe_med','$tipo_iden','$pnombre','$snombre','$papellido','$sapellido')";   
    //echo "<br>".$sql_;
    mysql_query($sql_);
  }
  else{
    $consulta="SELECT cod_medi FROM medicos WHERE cod_medi!='$cod_medi' AND tido_medi='$tipo_iden' AND ced_medi='$numer_iden'";
    //echo "<br>".$consulta;
    $consulta=mysql_query($consulta);
    if(mysql_num_rows($consulta)==0){
      $nom_medi=$pnombre;
      if(!empty($snombre)){$nom_medi.' '.$snombre;}
      if(!empty($papellido)){$nom_medi.' '.$papellido;}
      if(!empty($sapellido)){$nom_medi.' '.$sapellido;}
      $sql_="UPDATE medicos SET nom_medi='$nom_medi',dir__medi='$direccion',telf_medi='$telefono',are_medi='$are_medi',ced_medi='$numer_iden',reg_medi='$reg_medi',csii_med='$csii_med',espe_med='$espe_med',tido_medi='$tipo_iden',pnom_medi='$pnombre',snom_medi='$snombre',pape_medi='$papellido',sape_medi='$sapellido' WHERE cod_medi='$cod_medi'";
      //echo "<br>".$sql_;
      mysql_query($sql_);
    }
    else{
      ?>
      <script languge="JavaSctipt">alert("El profesional de la salud no fu� guardado, el codigo ya existe");</script>
      <?php
    }
  }
}
//Aqui guardo la informacion como paciente (usuario)
if($chkocupacional=='on'){
    if(!empty($codi_usu)){      
      $sql_="UPDATE usuario SET ETNI_USU='$etnia',NEDU_USU='$niveledu',OCUP_USU='$codigo_ciuo',ECIV_USU='$eciv' WHERE CODI_USU='$codi_usu'";
      //echo "<br>".$sql_;
      mysql_query($sql_);      
    }
    else{
      //echo "Vacio";      
      //$sql_="";
      $consulta="SELECT codi_usu FROM usuario WHERE tdoc_usu='$tipo_iden' AND nrod_usu='$numer_iden'";
      echo "<br>".$consulta;
      $consulta=mysql_query($consulta);
      $cont_uco='130';
      if(mysql_num_rows($consulta)==0){        
        $sql_="INSERT INTO usuario(CODI_USU,TDOC_USU,NROD_USU,PNOM_USU,SNOM_USU,PAPE_USU,SAPE_USU,FNAC_USU,SEXO_USU,DIRE_USU,TRES_USU,TEL2_USU,ZONA_USU,MRES_USU,MATE_USU,REGI_USU,TPAF_USU,FING_USU,ESTR_USU,DCOT_USU,PARE_USU,FVIN_USU,HEMO_USU,ESTA_USU,EMAI_USU,IDMA_USU,ETNI_USU,NEDU_USU,OCUP_USU,ECIV_USU,OPER_USU) VALUES (0,'$tipo_iden','$numer_iden','$pnombre','$snombre','$papellido','$sapellido','$fecha_nac','$sexo','$direccion','$telefono','','U','PASTO','52001','1','C','$hoy','1','$numer_iden','9','','$hemoclasif','A','$email','','$etnia','$niveledu','$codigo_ciuo','$eciv','$Gidusuper')";
        //echo "<br>".$sql_;
        mysql_query($sql_);
        $codi_usu=mysql_insert_id();    
        $sql_="INSERT INTO ucontrato(IDEN_UCO,  CUSU_UCO,  CONT_UCO,  MODA_UCO, ESTA_UCO, OPER_UCO) values (0,'$codi_usu','$cont_uco','E','AC','$Gidusuper')";
        //echo "<br>".$sql_;
        mysql_query($sql_);
        $iden_uco=mysql_insert_id();
        $sql_="INSERT INTO nusuario (CODI_NUS, IUCO_NUS,CNOV_NUS, FECH_NUS, FINI_NUS, FFIN_NUS, VALO_NUS, ESTA_NUS, OPER_NUS) VALUES (0,'$iden_uco','I02','$hoy','$hoy','','','AC','$Gidusuper')";
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