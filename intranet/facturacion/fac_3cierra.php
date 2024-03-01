<?php
session_start();
if(empty($Gidusufac)){
  ?>
  <script language='javascript'>
  alert("La sesion ha finalizado, porfavor ingrese nuevamente a la aplicación");
  window.top.close();
  </script>
  <?
}
else{
?>
<html>
<head>
	<title>FACTURACION</title>
	<link rel="stylesheet" href="css/style.css" type="text/css" />
</head>
<?
  include('php/conexion.php');
  include('php/funciones.php');
  if(!empty($fcie_fac)){$fcie_fac=cambiafecha($fcie_fac);}
  else{$fcie_fac=cambiafecha(hoy());}
  //echo "<br>".$iden_fac;
  //echo "<br>".$fcie_fac
  /*pcop_fac
  pdes_fac
  vcop_fac
  cmod_fac*/
  $consultaef="SELECT ef.pcop_fac,ef.vcop_fac,ef.pdes_fac,ef.cmod_fac FROM encabezado_factura AS ef WHERE ef.iden_fac=$iden_fac";
  //echo "<br>".$consultaef;
  $consultaef=mysql_query($consultaef);
  $rowef=mysql_fetch_array($consultaef);  
  $constot=mysql_query("SELECT SUM(cant_dfa*valu_dfa) as total FROM detalle_factura WHERE iden_fac=$iden_fac");
  $rowtot=mysql_fetch_array($constot);  
  $descuento=round(($rowtot[total]*($rowef[pdes_fac]/100)),0);
  
  if($pref_fac=="FE"){
	  $consulta="SELECT codi_emp,pref_emp,nume_fac FROM empresa";
  }elseif($pref_fac=="PGP"){
	  $consulta="SELECT codi_emp,pref3_emp AS pref_emp,num3_fac AS nume_fac FROM empresa";
  }
  else{//Tipo Interna
      $consulta="SELECT codi_emp,pref2_emp AS pref_emp,num2_fac AS nume_fac FROM empresa";
  }
  
  //echo "<br>".$consulta;
  $consulta=mysql_query($consulta);
  $rowemp=mysql_fetch_array($consulta);
  
  $hoy=cambiafecha(hoy());
  $vrneto=$rowtot[total]-$rowef[vcop_fac]-$rowef[cmod_fac]-$descuento;  
  //$sql="UPDATE encabezado_factura SET nume_fac='$rowemp[nume_fac]',pref_fac='$rowemp[pref_emp]',fcie_fac='$fcie_fac',frea_fac='$hoy',esta_fac='2',
  //        vtot_fac=$rowtot[total],vnet_fac=$vrneto WHERE iden_fac=$iden_fac";
  //echo $sql; 
  mysql_query($sql);
  if(mysql_affected_rows()==1){
    $nume_ant=$rowemp[nume_fac];
    $nume_fac=$rowemp[nume_fac]+1;
    $nume_fac=str_pad($nume_fac,strlen($rowemp[nume_fac]),"0",STR_PAD_LEFT);
    if($pref_fac=="FE"){
        //$sql="UPDATE empresa SET nume_fac='$nume_fac' WHERE codi_emp=$rowemp[codi_emp]";
    }elseif($pref_fac=="PGP"){
        //$sql="UPDATE empresa SET num3_fac='$nume_fac' WHERE codi_emp=$rowemp[codi_emp]";
    }
    else{
        //$sql="UPDATE empresa SET num2_fac='$nume_fac' WHERE codi_emp=$rowemp[codi_emp]";
    }    
    mysql_query($sql);

    //Aqui debo genero los rips
    generarRips();


  }

  generarRips($iden_fac);

  echo "<br>aqui estoy...";
  mysql_free_result($constot);
  mysql_free_result($consulta);
  mysql_free_result($consultaef);
  mysql_close();
?>
<body onload='form1.submit()'>
<!--<form name="form1" method="POST" action="fac_3lisfacanu.php">-->
<input type='hidden' name='num_fac' value='<?echo $nume_ant;?>'>
</form>
</body>
</html>
<?php
}
?>

<?php
function generarRips($iden_fac){

  //Aqui se trae la información del usuario
  $consulta="SELECT us.TDOC_USU,us.NROD_USU, us.TPAF_USU,us.FNAC_USU ,us.MRES_USU ,us.ZONA_USU,us.REGI_USU ,sexo.valo_des as SEXO,mun.CODI_MUN as municipioatencion,
  ef.nume_fac,ef.feci_fac
  FROM encabezado_factura ef 
  INNER JOIN usuario us ON us.CODI_USU = ef.codi_usu 
  LEFT JOIN destipos as sexo on sexo.homo_esp = us.SEXO_USU 
  LEFT JOIN municipio mun ON mun.NOMB_MUN = us.MRES_USU 
  WHERE ef.iden_fac = $iden_fac AND sexo.codt_des='H9'";
  //echo "<br><br>".$consulta;

  $consulta=mysql_query($consulta);
  if(mysql_num_rows($consulta)!=0){
    $row=mysql_fetch_array($consulta);
    $consultausu="SELECT COUNT(*) as total FROM nrusuario WHERE iden_fac='$iden_fac'";
    
    $consultausu=mysql_query($consultausu);
    $rowusu=mysql_fetch_array($consultausu);
    
    if($rowusu[total] == 0){
      $sql="INSERT INTO nrusuario(tipodocumento,numdocumento,tipousuario,fechanacimiento,codsexo,codpaisresidencia,codmunicipioresidencia,codzonaresidencia,incapacidad,codpaisorigen,iden_fac)
      VALUES('$row[TDOC_USU]','$row[NROD_USU]','','$row[FNAC_USU]','$row[SEXO]','170','$row[municipioatencion]','','','',$iden_fac)";
      mysql_query($sql);
    }
  }

  //Aqui se consulta el detalle de la factura
  $consultadet="SELECT df.iden_dfa,df.iden_fac,df.tipo_dfa,df.desc_dfa,df.cant_dfa ,df.valu_dfa,df.nauto_dfa,df.servi_dfa ,df.iden_tco,
  tpservicio.valo_des as tiposervicio,
  ctr.rcod_ctr,
  ef.cod_cie10
  FROM detalle_factura df
  INNER JOIN encabezado_factura AS ef ON ef.iden_fac=df.iden_fac
  INNER JOIN contratacion AS ctr ON ctr.iden_ctr=ef.iden_ctr
  LEFT JOIN tarco AS tco ON tco.iden_tco=df.iden_tco
  LEFT JOIN destipos AS tpservicio ON tpservicio.codi_des=tco.tser_tco
  WHERE df.iden_fac='$iden_fac'";
  //echo "<br><br>".$consultadet;

  $consultadet=mysql_query($consultadet);
  if(mysql_num_rows($consultadet)!=0){
    while($rowdet = mysql_fetch_array($consultadet)){

      $objDetalle = new Detalle();
      $objDetalle->fechainicioatencion=$row[feci_fac];
      $objDetalle->numautorizacion=$rowdet[nauto_dfa];
      $objDetalle->iden_tco=$rowdet[iden_tco];
      $objDetalle->servi_dfa=$rowdet[servi_dfa];
      $objDetalle->coddiagnosticoprincipal=$rowdet[cod_cie10];
      $objDetalle->tipodocumentoidentificacion=$row[TDOC_USU];
      $objDetalle->numdocumentoidentificacion=$row[NROD_USU];
      $objDetalle->vrservicio=$rowdet[valu_dfa];
      $objDetalle->iden_fac=$iden_fac;
      $objDetalle->iden_dfa=$rowdet[iden_dfa];
      $objDetalle->cantidad=$rowdet[cant_dfa];
      //echo "<br>tipo.. ".$rowdet[tipo_dfa];
      //echo "<br>tiposervicio.. ".$rowdet[tiposervicio];
      if($rowdet[tipo_dfa] == 'P'){
        switch($rowdet[tiposervicio]){
          case '01':
            //$objDetalle->crearConsulta();
            break;
          case '02':
            //$objDetalle->crearProcedimiento();
            break;
          case '03':
            //$objDetalle->crearProcedimiento();
            break;
          case '04':
            //$objDetalle->crearProcedimiento();
            break;
          case '05':
            //$objDetalle->crearProcedimiento();
            break;
          case '06':
            //$objDetalle->crearOtrosServicios();
            break;
        }
      }
      else{
        if($rowdet[tipo_dfa] == 'M'){          
          /*if($tipo=='12'){$tpmed_='1';}
          else{$tpmed_='2';}
          creamedicamentos2($iden_fac,$iden_dfa,$nume_fac,$codp_emp,$tdoc_usu,$nrod_usu,$tpmed_,$iden_tco,$cant_dfa,$valu_dfa,$total,$nauto_dfa);*/
      }
      elseif($rowdet[tipo_dfa] == 'I'){
          $objDetalle->crearOtrosServicios();
          //creaotros($iden_fac,$iden_dfa,$nume_fac,$codp_emp,$tdoc_usu,$nrod_usu,'2',$iden_tco,$cant_dfa,$valu_dfa,$total,$nauto_dfa);
      }      
      }
    }    
  }
    /*
         case '06':                
           creaotros($iden_fac,$iden_dfa,$nume_fac,$codp_emp,$tdoc_usu,$nrod_usu,'3',$iden_tco,$cant_dfa,$valu_dfa,$total,$nauto_dfa);
           creaestan($iden_fac,$iden_dfa,$nume_fac,$codp_emp,$tdoc_usu,$nrod_usu,$id_ing,$feci_fac,$fecf_fac,$nauto_dfa);
           creaestan2($iden_fac,$iden_dfa,$nume_fac,$codp_emp,$tdoc_usu,$nrod_usu,$id_ing,$feci_fac,$fecf_fac,$nauto_dfa);
           //echo "<br>".$tipo;
           break;
         case '07':
           creaotros($iden_fac,$iden_dfa,$nume_fac,$codp_emp,$tdoc_usu,$nrod_usu,'4',$iden_tco,$cant_dfa,$valu_dfa,$total,$nauto_dfa);
           break;
         case '08':
           creaotros($iden_fac,$iden_dfa,$nume_fac,$codp_emp,$tdoc_usu,$nrod_usu,'3',$iden_tco,$cant_dfa,$valu_dfa,$total,$nauto_dfa);
           break;
         case '09':
           creaotros($iden_fac,$iden_dfa,$nume_fac,$codp_emp,$tdoc_usu,$nrod_usu,'1',$iden_tco,$cant_dfa,$valu_dfa,$total,$nauto_dfa);
           break;
         case '10':
           creaotros($iden_fac,$iden_dfa,$nume_fac,$codp_emp,$tdoc_usu,$nrod_usu,'1',$iden_tco,$cant_dfa,$valu_dfa,$total,$nauto_dfa);
           break;
         case '11':
           creaotros($iden_fac,$iden_dfa,$nume_fac,$codp_emp,$tdoc_usu,$nrod_usu,'1',$iden_tco,$cant_dfa,$valu_dfa,$total,$nauto_dfa);
           break;
         case '12':                 
            creamedicamentos($iden_fac,$iden_dfa,$nume_fac,$codp_emp,$tdoc_usu,$nrod_usu,'1',$iden_tco,$cant_dfa,$valu_dfa,$total,$nauto_dfa);
            break;
         case '13':
            creamedicamentos($iden_fac,$iden_dfa,$nume_fac,$codp_emp,$tdoc_usu,$nrod_usu,'2',$iden_tco,$cant_dfa,$valu_dfa,$total,$nauto_dfa);
            break;
         case '14':
           creaotros($iden_fac,$iden_dfa,$nume_fac,$codp_emp,$tdoc_usu,$nrod_usu,'2',$iden_tco,$cant_dfa,$valu_dfa,$total,$nauto_dfa);
           break;
     }
   }        
   else{            
       if($tipo_dfa=='M'){
           //echo "<br>".$tipo;
           if($tipo=='12'){$tpmed_='1';}
           else{$tpmed_='2';}
           creamedicamentos2($iden_fac,$iden_dfa,$nume_fac,$codp_emp,$tdoc_usu,$nrod_usu,$tpmed_,$iden_tco,$cant_dfa,$valu_dfa,$total,$nauto_dfa);
       }
       elseif($tipo_dfa=='I'){
           creaotros($iden_fac,$iden_dfa,$nume_fac,$codp_emp,$tdoc_usu,$nrod_usu,'2',$iden_tco,$cant_dfa,$valu_dfa,$total,$nauto_dfa);
       }
   }*/

}

class Detalle{
  public $fechainicioatencion;
  public $numautorizacion;
  public $iden_tco;
  public $servi_dfa;
  public $coddiagnosticoprincipal;
  public $tipodocumentoidentificacion;
  public $numdocumentoidentificacion;
  public $vrservicio;
  public $conceptorecaudo;
  public $valorpagomoderador;
  public $numfevpagomoderador;
  public $consecutivo;
  public $iden_fac;
  public $iden_dfa;
  public $cantidad;

  function crearConsulta(){
    
    //Aqui consulto el codigo cups de la consulta
    $consultacups="SELECT cups.codi_cup AS codigo,map.codi_map FROM mapii AS map
      INNER JOIN tarco AS tar ON tar.iden_map=map.iden_map
      LEFT JOIN cups ON cups.codigo=map.codi_map
      WHERE tar.iden_tco='$this->iden_tco'";
    //echo "<br><br>".$consultacups;
    $consultacups=mysql_query($consultacups);
    $rowcups=mysql_fetch_array($consultacups);
    $codigo=$rowcups[codigo];

    //Aqui se consulta el grupoServicios homologado en destipos
    $consultaservicio="SELECT d.homo4_des 
    FROM destipos d 
    WHERE codi_des ='$this->servi_dfa'";
    $consultaservicio=mysql_query($consultaservicio);
    $rowservicio=mysql_fetch_array($consultaservicio);
    $gruposervicios=$rowservicio[homo4_des];


    //Aqui genero el ciclo para crear un registro por consulta
    for($cont = 1; $cont<=$this->cantidad; $cont++){
      //Aqui consulto el ultimo consecutivo
      $consultaconsecutivo="SELECT MAX(n.consecutivo) as consecutivo FROM nrconsulta n WHERE n.iden_fac ='$this->iden_fac'";
      //echo "<br><br>".$consultaconsecutivo;
      $consultaconsecutivo=mysql_query($consultaconsecutivo);
      $rowconsecutivo=mysql_fetch_array($consultaconsecutivo);
      $consecutivo=$rowconsecutivo[consecutivo];
      $consecutivo++;

      $sql="INSERT INTO nrconsulta(fechainicioatencion,numautorizacion,codconsulta,modalidadgruposervicio,gruposervicios,codservicio,finalidadtecnologia,causamotivoatencion,coddiagnosticoprincipal,coddiagnosticorelacinado1,coddiagnosticorelacinado2,coddiagnosticorelacinado3,tipodiagnosticoprincipal,tipodocumentoidentificacion,numdocumentoidentificacion,vrservicio,conceptorecaudo,valorpagomoderador,numfevpagomoderador,consecutivo,iden_fac,iden_dfa)
      VALUES('$this->fechainicioatencion'
      ,'$this->numautorizacion'
      ,'$codigo'
      ,''
      ,'$gruposervicios'
      ,'0'
      ,''
      ,''
      ,'$this->coddiagnosticoprincipal'
      ,''
      ,''
      ,''
      ,''
      ,'$this->tipodocumentoidentificacion'
      ,'$this->numdocumentoidentificacion'
      ,'$this->vrservicio'
      ,''
      ,'0'
      ,''
      ,'$consecutivo'
      ,'$this->iden_fac'
      ,'$this->iden_dfa')";
      //echo "<br><br>".$sql;
      mysql_query($sql); 
    }    
  }

  function crearProcedimiento(){
    //Aqui consulto el codigo cups del procedimiento
    $consultacups="SELECT cups.codi_cup AS codigo,map.codi_map FROM mapii AS map
      INNER JOIN tarco AS tar ON tar.iden_map=map.iden_map
      LEFT JOIN cups ON cups.codigo=map.codi_map
      WHERE tar.iden_tco='$this->iden_tco'";
    //echo "<br><br>".$consultacups;
    $consultacups=mysql_query($consultacups);
    $rowcups=mysql_fetch_array($consultacups);
    $codigo=$rowcups[codigo];

    //Aqui se consulta el grupoServicios homologado en destipos
    $consultaservicio="SELECT d.homo4_des 
    FROM destipos d 
    WHERE codi_des ='$this->servi_dfa'";
    //echo "<br><br>".$consultaservicio;
    $consultaservicio=mysql_query($consultaservicio);
    $rowservicio=mysql_fetch_array($consultaservicio);
    $gruposervicios=$rowservicio[homo4_des];


    //Aqui genero el ciclo para crear un registro por consulta
    for($cont = 1; $cont <= $this->cantidad; $cont++){
      //Aqui consulto el ultimo consecutivo
      $consultaconsecutivo="SELECT MAX(n.consecutivo) as consecutivo FROM nrprocedimiento n WHERE n.iden_fac ='$this->iden_fac'";
      //echo "<br><br>".$consultaconsecutivo;
      $consultaconsecutivo=mysql_query($consultaconsecutivo);
      $rowconsecutivo=mysql_fetch_array($consultaconsecutivo);
      $consecutivo=$rowconsecutivo[consecutivo];
      $consecutivo++;

      $sql="INSERT INTO nrprocedimiento(fechainicioatencion,idmipres,numautorizacion,codprocedimiento,viaingresoservicio,modalidadgruposervicio,gruposervicios,codservicio,finalidadtecnologia,tipodocumentoidentificacion,numdocumentoidentificacion,coddiagnositicoprincipal,coddiagnosticorelacionado,codcomplicacion,vrservicio,conceptorecaudo,valorpagomoderador,numfevpagomoderador,consecutivo,
      iden_fac,iden_dfa)
      VALUES('$this->fechainicioatencion'      
      ,''
      ,'$this->numautorizacion'
      ,'$codigo'
      ,''
      ,''
      ,'$gruposervicios'
      ,'0'
      ,''
      ,'$this->tipodocumentoidentificacion'
      ,'$this->numdocumentoidentificacion'
      ,'$this->coddiagnosticoprincipal'
      ,''
      ,''
      ,'$this->vrservicio'
      ,''
      ,'0'
      ,''
      ,'$consecutivo'
      ,'$this->iden_fac'
      ,'$this->iden_dfa')";
      //echo "<br><br>".$sql;
      mysql_query($sql); 
    }
  }

  function crearOtrosServicios(){    
    //Aqui consulto el codigo del OS
    $consultapro="SELECT ins.codi_ins AS codi_map,ins.desc_ins AS desc_map FROM insu_med AS ins
    INNER JOIN tarco AS tar ON tar.iden_map=ins.codi_ins
    WHERE tar.iden_tco='$this->iden_tco'";
    //echo "<br>".$consultapro;
    $consultapro=mysql_query($consultapro);
    $rowpro=mysql_fetch_array($consultapro);
    $codigo=$rowpro[codi_map];
    $descripcion=substr(trim($rowpro[desc_map]),0,60);
       
    //Aqui consulto el ultimo consecutivo
    $consultaconsecutivo="SELECT MAX(n.consecutivo) as consecutivo FROM nrotroservicios n WHERE n.iden_fac ='$this->iden_fac'";
    //echo "<br><br>".$consultaconsecutivo;
    $consultaconsecutivo=mysql_query($consultaconsecutivo);
    $rowconsecutivo=mysql_fetch_array($consultaconsecutivo);
    $consecutivo=$rowconsecutivo[consecutivo];
    $consecutivo++;

    $vrUnitario=$this->vrservicio;
    $vrTotal=$this->cantidad*$this->vrservicio;

    $sql="INSERT INTO nrotroservicios(numautorizacion,idmipres,fechasuministrotecnologia,tipoos,codtecnologia,nomtecnologia,cantidados,tipodocumentoidentificacion,numdocumentoidentificacion,vrunitos,vrservicio,conceptorecaudo,valorpagomoderador,numfevpagomoderador,consecutivo,iden_fac,iden_dfa)
    VALUES('$this->numautorizacion'
    ,'0'
    ,'$this->fechainicioatencion'
    ,''
    ,'$codigo'
    ,'$descripcion'
    ,'$this->cantidad'
    ,'$this->tipodocumentoidentificacion'
    ,'$this->numdocumentoidentificacion'
    ,'$vrUnitario'
    ,'$vrTotal'
    ,''
    ,'0'
    ,''
    ,'$consecutivo'
    ,'$this->iden_fac'
    ,'$this->iden_dfa')";
    //echo "<br><br>".$sql;
    mysql_query($sql); 

  }
}
?>  