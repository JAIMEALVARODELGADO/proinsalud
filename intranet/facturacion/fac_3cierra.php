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
  $sql="UPDATE encabezado_factura SET nume_fac='$rowemp[nume_fac]',pref_fac='$rowemp[pref_emp]',fcie_fac='$fcie_fac',frea_fac='$hoy',esta_fac='2',
          vtot_fac=$rowtot[total],vnet_fac=$vrneto WHERE iden_fac=$iden_fac";
  //echo $sql; 
  mysql_query($sql);
  if(mysql_affected_rows()==1){
    $nume_ant=$rowemp[nume_fac];
    $nume_fac=$rowemp[nume_fac]+1;
    $nume_fac=str_pad($nume_fac,strlen($rowemp[nume_fac]),"0",STR_PAD_LEFT);
    if($pref_fac=="FE"){
        $sql="UPDATE empresa SET nume_fac='$nume_fac' WHERE codi_emp=$rowemp[codi_emp]";
    }elseif($pref_fac=="PGP"){
        $sql="UPDATE empresa SET num3_fac='$nume_fac' WHERE codi_emp=$rowemp[codi_emp]";
    }
    else{
        $sql="UPDATE empresa SET num2_fac='$nume_fac' WHERE codi_emp=$rowemp[codi_emp]";
    }    
    mysql_query($sql);

    //Aqui debo genero los rips
    generarRips($iden_fac);

  }
  
  //generarRips($iden_fac);

  mysql_free_result($constot);
  mysql_free_result($consulta);
  mysql_free_result($consultaef);
  mysql_close();
?>
<body onload='form1.submit()'>
<form name="form1" method="POST" action="fac_3lisfacanu.php">
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
  ef.cod_cie10,ef.id_ing
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
      $objDetalle->id_ing=$rowdet[id_ing];
      //echo "<br>tipo.. ".$rowdet[tipo_dfa];
      //echo "<br>tiposervicio.. ".$rowdet[tiposervicio];
      if($rowdet[tipo_dfa] == 'P'){
        switch($rowdet[tiposervicio]){
          case '01':
            $objDetalle->crearConsulta();
            break;
          case '02':
            $objDetalle->crearProcedimiento();
            break;
          case '03':
            $objDetalle->crearProcedimiento();
            break;
          case '04':
            $objDetalle->crearProcedimiento();
            break;
          case '05':
            $objDetalle->crearProcedimiento();
            break;
          case '06':
            $objDetalle->crearOtrosServicios();
            $objDetalle->crearEstancia();
            $objDetalle->crearEstancia2();
            break;
          case '07':
            $objDetalle->crearOtrosServicios();            
            break;
          case '08':
            $objDetalle->crearOtrosServicios();
            break;
          case '09':
            $objDetalle->crearOtrosServicios();
            break;
          case '10':
            $objDetalle->crearOtrosServicios();
            break;
          case '11':
            $objDetalle->crearOtrosServicios();
            break;
          case '12':                 
            $objDetalle->crearMedicamento();
            break;
          case '13':
            $objDetalle->crearMedicamento();            
            break;
          case '14':
            $objDetalle->crearOtrosServicios();            
            break;
        }
      }
      else{
        if($rowdet[tipo_dfa] == 'M'){          
          /*if($tipo=='12'){$tpmed_='1';}
          else{$tpmed_='2';}*/
          
          $objDetalle->crearMedicamento();
      }
      elseif($rowdet[tipo_dfa] == 'I'){
          $objDetalle->crearOtrosServicios();
      }      
      }
    }
    mysql_free_result($consulta);
    mysql_free_result($consultausu);
    mysql_free_result($consultadet);
    
  }
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
  public $id_ing;

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

    mysql_free_result($consultacups);
    mysql_free_result($consultaservicio);
    mysql_free_result($consultaconsecutivo);
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
    mysql_free_result($consultacups);
    mysql_free_result($consultaservicio);
    mysql_free_result($consultaconsecutivo);

  }

  function crearOtrosServicios(){    
    //Aqui consulto el codigo del OS
    $consultapro="SELECT cups.codi_cup,map.codi_map,map.desc_map FROM mapii AS map
    INNER JOIN tarco AS tar ON tar.iden_map=map.iden_map
    LEFT JOIN cups ON cups.codigo=map.codi_map
    WHERE tar.iden_tco='$this->iden_tco'";
    //echo "<br><br>".$consultapro;

    $consultapro=mysql_query($consultapro);    
    if(mysql_num_rows($consultapro)<>0){
      $rowpro=mysql_fetch_array($consultapro);
      $codigo=$rowpro[codi_cup];
      $descripcion=substr(trim($rowpro[desc_map]),0,60);
    }
    else{
      $consultapro="SELECT ins.codi_ins AS codi_map,ins.desc_ins AS desc_map FROM insu_med AS ins
      INNER JOIN tarco AS tar ON tar.iden_map=ins.codi_ins
      WHERE tar.iden_tco='$this->iden_tco'";
      //echo "<br><br>".$consultapro;
      $consultapro=mysql_query($consultapro);
      $rowpro=mysql_fetch_array($consultapro);
      $codigo=$rowpro[codi_map];
      $descripcion=substr(trim($rowpro[desc_map]),0,60);      
    }

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

    mysql_free_result($consultapro);
    mysql_free_result($consultaconsecutivo);
  }


  function crearMedicamento(){   
    
    //Aqui se deben consultar los codigos IUM de medicamentos, como en el momento no hay una tabla, este codigo
    //va a estar vacio. Tampoco existe el tipo de medicamento
    $codigo='';

    //Aqui se consulta el nombre del medicamento
    $consultamed="SELECT CONCAT(med.coan_mdi,med.copa_mdi,med.coff_mdi,med.coco_mdi) AS codigo,med.cum_med
    ,med.nomb_mdi AS nombre,med.coca_mdi AS concen,coum_mdi AS unidad,
    fma.desc_ffa AS forma  
    FROM medicamentos2 AS med
    INNER JOIN tarco AS tar ON tar.iden_map=med.codi_mdi
    LEFT JOIN forma_farmaceutica AS fma ON fma.codi_ffa=med.coff_mdi
    WHERE tar.iden_tco='$this->iden_tco'";
    //echo "<br>".$consultamed;
    $consultamed=mysql_query($consultamed);  
    $rowmed=mysql_fetch_array($consultamed);
    //$codi_=$rowmed[codigo];
    //$codi_=$rowmed[cum_med];
    //echo "<br>".$codi_;
    $nombre=substr(trim($rowmed[nombre]),0,30);
    //$form_=substr($rowmed[forma],0,20);
    //$conc_=$rowmed[concen];
       
    //Aqui consulto el ultimo consecutivo
    $consultaconsecutivo="SELECT MAX(n.consecutivo) as consecutivo FROM nrmedicamento n WHERE n.iden_fac ='$this->iden_fac'";
    //echo "<br><br>".$consultaconsecutivo;
    $consultaconsecutivo=mysql_query($consultaconsecutivo);
    $rowconsecutivo=mysql_fetch_array($consultaconsecutivo);
    $consecutivo=$rowconsecutivo[consecutivo];
    $consecutivo++;

    $vrUnitario=$this->vrservicio;
    $vrTotal=$this->cantidad*$this->vrservicio;

    $sql="INSERT INTO nrmedicamento(numautorizacion,idmipres,fechadispensadmon,coddiagnosticoprincipal,coddiagnosticorelacionado,tipomedicamento,codtecnologia,nomtecnologia,concentracion,unidadmedida,formafarmaceutica,unidadmindispensa,cantidad,diastratamiento,tipodocumentoidentificacion,numdocumentoidentificacion,vrunitmedicamento,vrservicio,conceptorecaudo,valorpagomoderador,numfevpagomoderador,consecutivo,iden_fac,iden_dfa)
    VALUES('$this->numautorizacion'
    ,''
    ,'$this->fechainicioatencion'
    ,'$this->coddiagnosticoprincipal'
    ,''
    ,''
    ,'$codigo'
    ,'$nombre'
    ,'0'
    ,'0'
    ,''
    ,'0'
    ,'$this->cantidad'
    ,'0'
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

    mysql_free_result($consultamed);
    mysql_free_result($consultaconsecutivo);
  }

  function crearEstancia(){   
    
    //Consulta informacion de la epicrisis  
    $consultaepi="SELECT epi.sering_epi AS sering,epi.fecing_epi AS fecing,epi.horing_epi as horing,epi.estegr_epi AS estegr,
    ing.fecin_ing,ing.hora_ing,ing.fecsa_ing,ing.horsa_ing,ing.via_ing AS via,ing.cext_ing AS cext,
    evo.cod_cie10 AS dxingreso,evo.fech_evo AS fechaevo,evo.hora_evo AS horaevo,evo.cama_evo AS cama,evo.dest_usu AS destino
    FROM epicrisis AS epi
    INNER JOIN hist_evo AS evo ON evo.iden_evo=epi.iden_evo
    INNER JOIN ingreso_hospitalario AS ing ON ing.id_ing=evo.id_ing
    WHERE ing.id_ing='$this->id_ing'";    
    //echo "<br><br>".$consultaepi;
    $consultaepi=mysql_query($consultaepi);
    if(mysql_num_rows($consultaepi)<>0){
      $rowepi=mysql_fetch_array($consultaepi);
      $fechaInicioAtencion=substr($rowepi[fecin_ing],0,10).' '.substr($rowepi[hora_ing],0,5);
      $fechaEgreso=substr($rowepi[fecsa_ing],0,10).' '.substr($rowepi[horsa_ing],0,5);
      $destino=$rowepi[destino];
	    $esteg_=$rowepi[estegr];	
	    $dxmuer_='';
      $cama_=$rowepi[cama];
      
      //Consulto la via de ingreso a la institucion
      $consultavia="SELECT val2_des FROM destipos WHERE codi_des='$rowepi[via]'";
      //echo "<br><br>Consulta via... ".$consultavia;
      $consultavia=mysql_query($consultavia);
      $rowvia=mysql_fetch_array($consultavia);
      $viaIngreso=$rowvia[val2_des];
      
      //Consulto la causa externa
      $consultacausaext="SELECT val2_des FROM destipos WHERE codi_des='$rowepi[cext]'";
      //echo "<br>".$consultacausaext;
      $consultacausaext=mysql_query($consultacausaext);
      $rowcex=mysql_fetch_array($consultacausaext);
      $causaExt=$rowcex[val2_des];

      //Consulto el diagnostico de ingreso
      $consultadx="SELECT iden_evo,cod_cie10 FROM hist_evo WHERE iden_evo=(SELECT MIN(iden_evo) FROM hist_evo WHERE id_ing='$this->id_ing')";
      //echo "<br><br>".$consultadx;
      $consultadx=mysql_query($consultadx);
      $rowdx=mysql_fetch_array($consultadx);
      //$diag_=$rowdx[cod_cie10];
      $dxIngreso=$rowdx[cod_cie10];

      //Consulto los diagnosticos de egreso
      $consultadxeg="SELECT iden_evo,cod_cie10 FROM hist_evo WHERE iden_evo=(SELECT MAX(iden_evo) FROM hist_evo WHERE id_ing='$this->id_ing')";
      //echo "<br><br>".$consultadxeg;
      $consultadxeg=mysql_query($consultadxeg);
      $rowdxeg=mysql_fetch_array($consultadxeg);
      //$diag_=$rowdx[cod_cie10];
      $dxEgreso=$rowdxeg[cod_cie10];
      $iden_evo=$rowdx[iden_evo];

      if($esteg_=='2') { $dxmuer_=$dxEgreso; }

      //Aqui se consultan los dx relacionados al egreso
      $consultadxrel="SELECT cod_cie10 FROM diax_evo WHERE iden_evo='$iden_evo'";
      //echo "<br><br>".$consultadxrel;
      $consultadxrel=mysql_query($consultadxrel);
      $cdx=0;
      $diagrel="";
      while($rowdxrel=mysql_fetch_array($consultadxrel) AND $cdx<3){
        $var='$diag_'.$cdx;
        $$var=$rowdxrel[cod_cie10];
        $diagrel=$diagrel."'".$$var."',";
        $cdx++;
      }
      //echo "<br><br>".$cdx;
      if($cdx<3){
        for($i=$cdx;$i<=2;$i++){
          $var='$diag_'.$i;
          $$var='';
          $diagrel=$diagrel."'".$$var."',";
        }
        $diagrel=substr($diagrel,0,strlen($diagrel)-1);        
      }
      //echo "<br><br>".$diagrel;
      //Consulto la ubicacion de la cama para determinar si es hospitalizacion o urgencias 
      $consultaubi="SELECT val2_des FROM destipos WHERE codi_des='$cama_'";
      //echo "<br><br>".$consultaubi;
      $consultaubi=mysql_query($consultaubi);
      $rowubi=mysql_fetch_array($consultaubi);

      //Consulto el destino del paciente
      if(!empty($destino)){
        $consultadest="SELECT homo4_des FROM destipos WHERE codi_des='$destino'";
        //echo "<br><br>".$consultadest;
        $consultadest=mysql_query($consultadest);
        $rowdest=mysql_fetch_array($consultadest);
        $destino=$rowdest[homo4_des];
      }            

      //evaluo si esta en urgencias '0634' para crear au o ah      
      if($rowubi[val2_des]<>'0634'){
        //Aqui consulto el ultimo consecutivo
        $consultaconsecutivo="SELECT MAX(n.consecutivo) as consecutivo FROM nrhospital n WHERE n.iden_fac ='$this->iden_fac'";
        //echo "<br><br>".$consultaconsecutivo;
        $consultaconsecutivo=mysql_query($consultaconsecutivo);
        $rowconsecutivo=mysql_fetch_array($consultaconsecutivo);
        $consecutivo=$rowconsecutivo[consecutivo];
        $consecutivo++;
      
        $sql="INSERT INTO nrhospital(viaingresoservicio,fechainicioatencion,numautorizacion,causamotivoatencion,coddiagnosticoprincipal,coddiagnosticoprincipale,coddiagnosticorelacionadoe1,coddiagnosticorelacionadoe2,coddiagnosticorelacionadoe3,codcomplicacion,condiciondestinoegreso,coddiagnosticocausamuerte,fechaegreso,consecutivo,iden_fac,iden_dfa)
        VALUES('$viaIngreso'
        ,'$fechaInicioAtencion'
        ,'$this->numautorizacion'
        ,'$causaExt'
        ,'$dxIngreso'
        ,'$dxEgreso'
        ,$diagrel
        ,''
        ,'$destino'
        ,'$dxmuer_'
        ,'$fechaEgreso'
        ,'$consecutivo'
        ,'$this->iden_fac'
        ,'$this->iden_dfa')";
        
        //echo "<br><br>".$sql;
        mysql_query($sql);

        /*$consultapro="SELECT regi_fho FROM fhospital WHERE numf_fho=$fac_";    
        //echo "<br>".$consultapro;
        $consultapro=mysql_query($consultapro);
        if(mysql_num_rows($consultapro)==0){        
          $actualiza="INSERT INTO fhospital(regi_fho,iden_fac,numf_fho,codp_fho,tpid_fho,nide_fho,via_fho,feci_fho,hori_fho,naut_fho,cext_fho,dxin_fho,dxeg_fho,dxre1_fho,dxre2_fho,dxre3_fho,comp_fho,ests_fho,cmue_fho,fece_fho,hore_fho)
          VALUES($reg_,'$idfac_',$fac_','$codp_','$tdoc_','$nrod_','$via_','$fecing_','$horing_','$naut_','$cext_','$diag_','$dxegr_',".
          $diagr."'','$esteg_','$dxmuer_','$fecsa_','$horsa_')";
        }
        else{
          $actualiza="UPDATE fhospital SET tpid_fho='$tdoc_',nide_fho='$nrod_'
          WHERE regi_fho=$reg_";
        }*/
      }
      else{
        //Aqui consulto el ultimo consecutivo
        $consultaconsecutivo="SELECT MAX(n.consecutivo) as consecutivo FROM nrurgencias n WHERE n.iden_fac ='$this->iden_fac'";
        //echo "<br><br>".$consultaconsecutivo;
        $consultaconsecutivo=mysql_query($consultaconsecutivo);
        $rowconsecutivo=mysql_fetch_array($consultaconsecutivo);
        $consecutivo=$rowconsecutivo[consecutivo];
        $consecutivo++;
        $sql="INSERT INTO nrurgencias(fechainicioatencion,causamotivoatencion,coddiagnosticoprincipal,coddiagnosticoprincipale,coddiagnosticorelacionadoe1,coddiagnosticorelacionadoe2,coddiagnosticorelacionadoe3,condiciondestinousuarioegreso,coddiagnosticocausamuerte,fechaegreso,consecutivo,iden_fac,iden_dfa)
        VALUES('$fechaInicioAtencion'
        ,'$causaExt'
        ,'$dxIngreso'
        ,'$dxEgreso'
        ,$diagrel
        ,'$destino'
        ,'$dxmuer_'
        ,'$fechaEgreso'
        ,'$consecutivo'
        ,'$this->iden_fac'
        ,'$this->iden_dfa')";

        //echo "<br><br>".$sql;
        mysql_query($sql);

        /*$consultapro=mysql_query("SELECT regi_fur FROM furgencia WHERE numf_fur=$fac_");
        if(mysql_num_rows($consultapro)==0){
              $actualiza="INSERT INTO furgencia(regi_fur,iden_fac,numf_fur,codp_fur,tpid_fur,nide_fur,feci_fur,hori_fur,naut_fur,cext_fur,dxeg_fur,dxre1_fur,dxre2_fur,dxre3_fur,dest_fur,ests_fur,cmue_fur,fece_fur,hore_fur)
              VALUES($reg_,'$idfac_','$fac_','$codp_','$tdoc_','$nrod_','$fecing_','$horing_','$naut_','$cext_','$dxegr_',".
              $diagr."'$dest_','$esteg_','$dxmuer_','$fecsa_','$horsa_')";
        }
        else{
          $actualiza="UPDATE furgencia SET numf_fur='$fac_',codp_fur='$codp_',tpid_fur='$tdoc_',nide_fur='$nrod_'
                WHERE regi_fur=$reg_";
        }*/
      }  
      //echo "<br><br>".$actualiza;
      /*mysql_query($actualiza);*/
      
      mysql_free_result($consultavia);
      mysql_free_result($consultacausaext);
      mysql_free_result($consultadx);
      mysql_free_result($consultadxeg);
      mysql_free_result($consultadxrel);
      mysql_free_result($consultaubi);
      mysql_free_result($consultadest);
      mysql_free_result($consultaconsecutivo);
    }
    mysql_free_result($consultaepi);
  }

  function crearEstancia2(){   
    
    //Consulta informacion de la epicrisis2
    $consultaepi="SELECT ingreso_hospitalario.id_ing, ingreso_hospitalario.arerem_ing, ingreso_hospitalario.fecin_ing, ingreso_hospitalario.hora_ing, epicrisis2.estaalta_epiegreso AS estegr, ingreso_hospitalario.fecsa_ing, ingreso_hospitalario.horsa_ing, ingreso_hospitalario.via_ing AS via, ingreso_hospitalario.cext_ing AS cext, hist_evo.cod_cie10 AS dxegr, hist_evo.fech_evo, hist_evo.hora_evo AS horaevo, hist_evo.cama_evo AS cama, hist_evo.dest_usu AS destino
    FROM epicrisis2 
    INNER JOIN hist_evo ON epicrisis2.iden_evo = hist_evo.iden_evo
    INNER JOIN ingreso_hospitalario ON epicrisis2.id_ing = ingreso_hospitalario.id_ing
    WHERE ingreso_hospitalario.id_ing='$this->id_ing'";
    //echo "<br><br>".$consultaepi;
    $consultaepi=mysql_query($consultaepi);
    if(mysql_num_rows($consultaepi)<>0){
      $rowepi=mysql_fetch_array($consultaepi);
      $fechaInicioAtencion=substr($rowepi[fecin_ing],0,10).' '.substr($rowepi[hora_ing],0,5);
      $fechaEgreso=substr($rowepi[fecsa_ing],0,10).' '.substr($rowepi[horsa_ing],0,5);
      $destino=$rowepi[destino];
	    $esteg_=$rowepi[estegr];	
	    $dxmuer_='';
      $cama_=$rowepi[cama];
      
      //Consulto la via de ingreso a la institucion
      $consultavia="SELECT val2_des FROM destipos WHERE codi_des='$rowepi[via]'";
      //echo "<br><br>Consulta via... ".$consultavia;
      $consultavia=mysql_query($consultavia);
      $rowvia=mysql_fetch_array($consultavia);
      $viaIngreso=$rowvia[val2_des];
      
      //Consulto la causa externa
      $consultacausaext="SELECT val2_des FROM destipos WHERE codi_des='$rowepi[cext]'";
      //echo "<br>".$consultacausaext;
      $consultacausaext=mysql_query($consultacausaext);
      $rowcex=mysql_fetch_array($consultacausaext);
      $causaExt=$rowcex[val2_des];

      //Consulto el diagnostico de ingreso
      $consultadx="SELECT iden_evo,cod_cie10 FROM hist_evo WHERE iden_evo=(SELECT MIN(iden_evo) FROM hist_evo WHERE id_ing='$this->id_ing')";
      //echo "<br><br>".$consultadx;
      $consultadx=mysql_query($consultadx);
      $rowdx=mysql_fetch_array($consultadx);
      //$diag_=$rowdx[cod_cie10];
      $dxIngreso=$rowdx[cod_cie10];

      //Consulto los diagnosticos de egreso
      $consultadxeg="SELECT iden_evo,cod_cie10 FROM hist_evo WHERE iden_evo=(SELECT MAX(iden_evo) FROM hist_evo WHERE id_ing='$this->id_ing')";
      //echo "<br><br>".$consultadxeg;
      $consultadxeg=mysql_query($consultadxeg);
      $rowdxeg=mysql_fetch_array($consultadxeg);
      //$diag_=$rowdx[cod_cie10];
      $dxEgreso=$rowdxeg[cod_cie10];
      $iden_evo=$rowdx[iden_evo];
      
      if($esteg_=='MA' or $esteg_=='MD'){
        $dxmuer_=$dxEgreso;
        $esteg_='2';
      }
      else{$esteg_='1';}
      //if($esteg_=='2') { $dxmuer_=$dxEgreso; }

      //Aqui se consultan los dx relacionados al egreso
      $consultadxrel="SELECT cod_cie10 FROM diax_evo WHERE iden_evo='$iden_evo'";
      //echo "<br><br>".$consultadxrel;
      $consultadxrel=mysql_query($consultadxrel);
      $cdx=0;
      $diagrel="";
      while($rowdxrel=mysql_fetch_array($consultadxrel) AND $cdx<3){
        $var='$diag_'.$cdx;
        $$var=$rowdxrel[cod_cie10];
        $diagrel=$diagrel."'".$$var."',";
        $cdx++;
      }
      //echo "<br>".$diagrel;
      //echo "<br><br>".$cdx;
      if($cdx<3){
        for($i=$cdx;$i<=2;$i++){
          $var='$diag_'.$i;
          $$var='';
          $diagrel=$diagrel."'".$$var."',";
        }
        $diagrel=substr($diagrel,0,strlen($diagrel)-1);        
      }
      //echo "<br><br>dx rel... ".$diagrel;
      //Consulto la ubicacion de la cama para determinar si es hospitalizacion o urgencias 
      $consultaubi="SELECT val2_des FROM destipos WHERE codi_des='$cama_'";
      //echo "<br><br>".$consultaubi;
      $consultaubi=mysql_query($consultaubi);
      $rowubi=mysql_fetch_array($consultaubi);

      //Consulto el destino del paciente
      if(!empty($destino)){
        $consultadest="SELECT homo4_des FROM destipos WHERE codi_des='$destino'";
        //echo "<br><br>".$consultadest;
        $consultadest=mysql_query($consultadest);
        $rowdest=mysql_fetch_array($consultadest);
        $destino=$rowdest[homo4_des];
      }            

      //evaluo si esta en urgencias '0634' para crear au o ah      
      //echo "<br>".$rowubi[val2_des];
      if($rowubi[val2_des]<>'0634'){
        //Aqui consulto el ultimo consecutivo
        $consultaconsecutivo="SELECT MAX(n.consecutivo) as consecutivo FROM nrhospital n WHERE n.iden_fac ='$this->iden_fac'";
        //echo "<br><br>".$consultaconsecutivo;
        $consultaconsecutivo=mysql_query($consultaconsecutivo);
        $rowconsecutivo=mysql_fetch_array($consultaconsecutivo);
        $consecutivo=$rowconsecutivo[consecutivo];
        $consecutivo++;
      
        $sql="INSERT INTO nrhospital(viaingresoservicio,fechainicioatencion,numautorizacion,causamotivoatencion,coddiagnosticoprincipal,coddiagnosticoprincipale,coddiagnosticorelacionadoe1,coddiagnosticorelacionadoe2,coddiagnosticorelacionadoe3,codcomplicacion,condiciondestinoegreso,coddiagnosticocausamuerte,fechaegreso,consecutivo,iden_fac,iden_dfa)
        VALUES('$viaIngreso'
        ,'$fechaInicioAtencion'
        ,'$this->numautorizacion'
        ,'$causaExt'
        ,'$dxIngreso'
        ,'$dxEgreso'
        ,$diagrel
        ,''
        ,'$destino'
        ,'$dxmuer_'
        ,'$fechaEgreso'
        ,'$consecutivo'
        ,'$this->iden_fac'
        ,'$this->iden_dfa')";
        
        //echo "<br><br>".$sql;
        mysql_query($sql);        
      }
      else{
        
        //Aqui consulto el ultimo consecutivo
        $consultaconsecutivo="SELECT MAX(n.consecutivo) as consecutivo FROM nrurgencias n WHERE n.iden_fac ='$this->iden_fac'";
        //echo "<br><br>".$consultaconsecutivo;
        $consultaconsecutivo=mysql_query($consultaconsecutivo);
        $rowconsecutivo=mysql_fetch_array($consultaconsecutivo);
        $consecutivo=$rowconsecutivo[consecutivo];
        $consecutivo++;
        $sql="INSERT INTO nrurgencias(fechainicioatencion,causamotivoatencion,coddiagnosticoprincipal,coddiagnosticoprincipale,coddiagnosticorelacionadoe1,coddiagnosticorelacionadoe2,coddiagnosticorelacionadoe3,condiciondestinousuarioegreso,coddiagnosticocausamuerte,fechaegreso,consecutivo,iden_fac,iden_dfa)
        VALUES('$fechaInicioAtencion'
        ,'$causaExt'
        ,'$dxIngreso'
        ,'$dxEgreso'
        ,$diagrel
        ,'$destino'
        ,'$dxmuer_'
        ,'$fechaEgreso'
        ,'$consecutivo'
        ,'$this->iden_fac'
        ,'$this->iden_dfa')";

        //echo "<br><br>".$sql;
        mysql_query($sql);
      }  
      
      mysql_free_result($consultavia);
      mysql_free_result($consultacausaext);
      mysql_free_result($consultadx);
      mysql_free_result($consultadxeg);
      mysql_free_result($consultadxrel);
      mysql_free_result($consultaubi);      
    }
    mysql_free_result($consultaepi);
  }
}
?>  