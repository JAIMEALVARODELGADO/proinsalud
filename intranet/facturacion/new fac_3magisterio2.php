<?php
session_start();
$errores=0;
//$nume_fac=0;
if($Gidusufac==''){
  ?>
  <script language='javascript'>
  alert("La sesion ha finalizado, porfavor ingrese nuevamente a la aplicación");
  window.top.close();
  </script>
  <?php
}
include("fac_validmag.php");
SET_TIME_LIMIT(0);
?>
<html>
<head>
<title>PROGRAMA DE FACTURACION</title>
<SCRIPT LANGUAGE=JavaScript>
function validar(nfac_){
    if(confirm("Desea generar facturas de "+nfac_+" registros?")){
        document.form1.submit();
    }
}
</script>


<link rel="stylesheet" href="css/style.css" type="text/css" />
</head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<body lang=ES  style='tab-interval:35.4pt'>
<!-------------------------------------------- -->
<div ID="waitDiv" style="position:absolute;left:380;top:80;visibility:hidden">
<center>
<table border=0 cellpadding=0 cellspacing=0 width="250"><tr><td bgcolor="#000000">
<table cellpadding=2 cellspacing=1 border=0 width="100%"><tr><td bgcolor="#ffffff">
<center><font color="#0174DF" face="Verdana, Arial, Helvetica, sans-serif" size="3">Procesando la información...</font>
<br><img src="icons/espera.gif" height="40" width="40"><br>
<font size="2" color="#0174DF" face="Verdana, Arial, Helvetica, sans-serif">Espere por favor...</font></center>
</td>
</tr>
</table>
</td></tr>
</table>
</center>
</div>

<script>
    var DHTML = (document.getElementById || document.all || document.layers);
    function ap_getObj(name) {
      if (document.getElementById) {
        return document.getElementById(name).style;
      } else if (document.all) {
        return document.all[name].style;
      } else if (document.layers) {
        return document.layers[name];
      }
    }
    function ap_showWaitMessage(div,flag)  {
      if (!DHTML)
        return;
      var x = ap_getObj(div);
      x.visibility = (flag) ? 'visible':'hidden'
      if(! document.getElementById)
        if(document.layers)
          x.left=280/2;
//      return true;
    }
    ap_showWaitMessage('waitDiv', 1);

</SCRIPT>
<!---------------------------------------------->
    
<form name="form1" method="POST" action="fac_3magfacturar.php" target='fr02'>
<table class="Tbl0"><tr><td class="Td0" align='center'>ACTIVIDADES REALIZADAS</td></tr></table><br>
<?php
include('php/conexiones_g.php');
base_proinsalud();
include('php/funciones.php');
?>
<center><table class="Tbl0" border=1>	
	  <?php
            $error=0;            
            //$nfacturas=0;    
            //Aqui se valida la informacion de consulta externa, se valida que no sean consultas de pyp            
            //$condicion="CODI_USU<>0 AND cont_ehi='$codi_con' AND area_cpl<>'82' AND factu_cpl<>'S' AND ";
            $condicion="CODI_USU<>0 AND cont_ehi='$codi_con' AND factu_cpl<>'S' AND ";
            if(!empty($fechaini)){$condicion=$condicion."feca_cpl between '".$fechaini."' AND ";}
            if(!empty($fechafin)){$condicion=$condicion."'".$fechafin."' AND ";}
            $condicion=substr($condicion,0,strlen($condicion)-5);
            //echo "<br>".$condicion;
            $cons_nit="SELECT NIT_CON FROM CONTRATO WHERE CODI_CON='$codi_con'";
            $cons_nit=mysql_query($cons_nit);
            $row_nit=mysql_fetch_array($cons_nit);
            $nit_con=$row_nit[NIT_CON];
            createmporal();
            //cargamedicamentos($fechaini,$fechafin);
            validaconsultaext($condicion,$iden_ctr,$codi_con,$nit_con,$fechaini_,$fechafin_);

            //Aqui se valida la informacion de laboratorio            
            $condicion="CODI_USU<>0 AND ctr_labs='$codi_con' AND factu_dlab<>'S' AND (ambi_labs='1' OR ambi_labs='3') AND ";            
            //if(!empty($fechaini)){$condicion=$condicion."fche_labs between '".$fechaini."' AND ";}
            if(!empty($fechaini)){$condicion=$condicion."fech_dlab between '".$fechaini."' AND ";}
            if(!empty($fechafin)){$condicion=$condicion."'".$fechafin."' AND ";}
            $condicion=$condicion."(estd_dlab = 'CU' OR estd_dlab = 'RE') ORDER BY iden_labs";
            //echo "<br>".$condicion;
            validalabo($condicion,$iden_ctr,$codi_con,$nit_con);
                        
            //Aqui se valida la informacion de imagenologia            
            //Se filtra el campo enca_rips.serv_ecr='0601', porque en esta tabla se almacenan rips de diferentes servicios
            //$condicion="CODI_USU<>0 AND cont_ecr='002' AND (ISNULL(factu_der) OR factu_der<>'S') AND (ambi_ecr='1' OR ambi_ecr='3') AND serv_ecr='0601' AND esta_lec='LE' AND ";
            $condicion="CODI_USU<>0 AND cont_ecr='$codi_con' AND (ISNULL(factu_der) OR factu_der<>'S') AND (ambi_ecr='1' OR ambi_ecr='3') AND serv_ecr='0601' AND ";
            if(!empty($fechaini)){$condicion=$condicion."(fech_lec between '".$fechaini." 00:00' AND ";}
            if(!empty($fechafin)){$condicion=$condicion."'".$fechafin." 23:59') AND ";}
            $condicion=substr($condicion,0,strlen($condicion)-5);
            $condicion=$condicion." ORDER BY iden_ecr";
            //echo "<br>".$condicion;            
            validaimagen($condicion,$iden_ctr,$codi_con,$nit_con);
            
            //Aqui se valida la informacion de medicamentos(formulacion)            
            /*$condicion="ccos_for='3' AND (tido_for='1' Or tido_for='2' Or tido_for='6') AND cdis_for>0 AND (ISNULL(factu_for) Or factu_for<>'S') AND (scco_for='4' Or scco_for='5' Or scco_for='12' Or scco_for='15' Or scco_for='16' Or scco_for='17') AND ";*/
            $condicion="contrato_for='$codi_con' AND (tido_for='1' Or tido_for='2' Or tido_for='6') AND cdis_for>0 AND (ISNULL(factu_for) Or factu_for<>'S') AND tdis_for<>'S' AND ";
            if(!empty($fechaini)){$condicion=$condicion."fdis_for between '".$fechaini."' AND ";}
            if(!empty($fechafin)){$condicion=$condicion."'".$fechafin."' AND ";}
            $condicion=substr($condicion,0,strlen($condicion)-5);
            $condicion=$condicion." ORDER BY nume_for";
            //echo "<br>".$condicion;
            validamedicam($condicion,$iden_ctr,$codi_con,$nit_con);

            //Aqui se valida la informacion de terapia fisica
            $condicion="cont_this='$codi_con' AND (ISNULL(factu_tcon) Or factu_tcon<>'S') AND ";
            if(!empty($fechaini)){$condicion=$condicion."fecha_tcon between '".$fechaini." 00:00' AND ";}
            if(!empty($fechafin)){$condicion=$condicion."'".$fechafin." 23:59' AND ";}
            $condicion=substr($condicion,0,strlen($condicion)-5);
            $condicion=$condicion." ORDER BY iden_tcon";
            //echo "<br>".$condicion;
            validaterapiafis($condicion,$iden_ctr,$codi_con,$nit_con);
            
            //Aqui se valida la informacion de terapia respiratoria
            $condicion="cont_tre='$codi_con' AND (ISNULL(factu_tre) Or factu_tre<>'S') AND ";
            if(!empty($fechaini)){$condicion=$condicion."fecha_tre between '".$fechaini." 00:00' AND ";}
            if(!empty($fechafin)){$condicion=$condicion."'".$fechafin." 23:59' AND ";}
            $condicion=substr($condicion,0,strlen($condicion)-5);
            $condicion=$condicion." ORDER BY iden_tre";
            //echo "<br>".$condicion;
            //echo "<br>iden_ctr...: ".$iden_ctr;
            validaterapiares($condicion,$iden_ctr,$codi_con,$nit_con);

            //Aqui se valida la informacion de quirofano
            $condicion="ctro_usu='$codi_con' AND (ISNULL(factu_cir) Or factu_cir<>'S') AND ";
            if(!empty($fechaini)){$condicion=$condicion."fech_qxf between '".$fechaini." 00:00' AND ";}
            if(!empty($fechafin)){$condicion=$condicion."'".$fechafin." 23:59' AND ";}
            $condicion=substr($condicion,0,strlen($condicion)-5);
            $condicion=$condicion." ORDER BY iden_qxf";
            //echo "<br>".$condicion;            
            ////validaqx($condicion,$iden_ctr,$codi_con,$nit_con);

            //Aqui se valida la informacion de rips de consulta            
            $condicion="CODI_USU<>0 AND Cotra_citas='$codi_con' AND (ISNULL(factu_rip) OR factu_rip<>'S') AND ";
            if(!empty($fechaini)){$condicion=$condicion."(fcon_rip between '".$fechaini."' AND ";}
            if(!empty($fechafin)){$condicion=$condicion."'".$fechafin."') AND ";}
            $condicion=substr($condicion,0,strlen($condicion)-5);
            $condicion=$condicion." ORDER BY iden_fac";
            //echo "<br>".$condicion;            
            validarips_consulta($condicion,$iden_ctr,$codi_con,$nit_con);

            //Aqui se valida la informacion de rips de procedimientos
            //Se filtra el campo enca_rips.serv_ecr<>'0601', porque es servicio de imagenología que ya está facturado como imagenología
            $condicion="serv_ecr<>'0601' AND CODI_USU<>0 AND cont_ecr='$codi_con' AND (ISNULL(factu_der) OR factu_der<>'S') AND ";
            if(!empty($fechaini)){$condicion=$condicion."(fech_ecr between '".$fechaini."' AND ";}
            if(!empty($fechafin)){$condicion=$condicion."'".$fechafin."') AND ";}
            $condicion=substr($condicion,0,strlen($condicion)-5);
            $condicion=$condicion." ORDER BY iden_der";
            //echo "<br>".$condicion;            
            validarips_procedim($condicion,$iden_ctr,$codi_con,$nit_con);

            //Aqui se valida la informacion de consulta de salud ocupacional            
            $condicion="codi_usu<>0 AND cont_inf='$codi_con' AND (ISNULL(factu_enc) OR factu_enc<>'S') AND ";
            if(!empty($fechaini)){$condicion=$condicion."(fech_inf between '".$fechaini."' AND ";}
            if(!empty($fechafin)){$condicion=$condicion."'".$fechafin."') AND ";}
            $condicion=substr($condicion,0,strlen($condicion)-5);
            $condicion=$condicion." ORDER BY iden_enc";
            //echo "<br>".$condicion;                        
            validasaludocupa($condicion,$iden_ctr,$codi_con,$nit_con);

            //Aqui se valida la informacion de citologias
            $condicion="cod_usu<>0 AND cotra_citas='$codi_con' AND (ISNULL(factu_hpri) OR factu_hpri<>'S') AND ";
            if(!empty($fechaini)){$condicion=$condicion."(fechacon between '".$fechaini."' AND ";}
            if(!empty($fechafin)){$condicion=$condicion."'".$fechafin."') AND ";}
            $condicion=substr($condicion,0,strlen($condicion)-5);
            $condicion=$condicion." ORDER BY iden_his";
            //echo "<br>".$condicion;                        
            validacitol($condicion,$iden_ctr,$codi_con,$nit_con);
	  ?>
	</table>
        <?php
            if($errores!=0){
            // and $nfacturas<>0){
				echo "<br><b>Exiten errores</b>";
            }
            //else{
                creafacturas($fechaini,$fechafin,$fcie_fac,$Gidusufac);
            //}			
        ?>    
    <br><input type='hidden' name='fechaini' value="<?php echo $fechaini?>">
    <br><input type='hidden' name='fechafin' value="<?php echo $fechafin?>">
    <br><input type='hidden' name='fcie_fac' value="<?php echo $fcie_fac?>">    
    <br><input type='hidden' name='iden_ctr' value="<?php echo $iden_ctr?>">
    <br><input type="hidden" name="chk_cextern" value="<?php echo $chk_cextern?>">
    <br><input type="hidden" name="chk_laborat" value="<?php echo $chk_laborat?>">
    <br><input type="hidden" name="chk_imageno" value="<?php echo $chk_imageno?>">
    <br><input type="hidden" name="chk_medicam" value="<?php echo $chk_medicam?>">
</form>
<?php
mysql_close();
?>

<script language="javascript" type="text/javascript">
<!--
ap_showWaitMessage('waitDiv', 0);
//-->
</SCRIPT>
</body>
</html>


<?php
function validaconsultaext($condi_,$iden_ctr,$cont_,$nit_con,$fechaini_,$fechafin_){    
    $sql_="SELECT iden_cpl,numc_cpl,id_cita,CODI_USU,NROD_USU,area_cpl,nom_areas,codi_des,feca_cpl,cod1_cpl,coan_cpl,ccup_prim,ccup_cont,come_cpl FROM vista_consulta_externa
    WHERE $condi_";
    echo "<br>".$sql_;
    $sql_=mysql_query($sql_);
    $fcie_fac=cambiafecha($fcie_fac);
    $feci_fac=$fechaini_;
    $fecf_fac=$fechaini_;
    while($row=mysql_fetch_array($sql_)){
        $GLOBALS['error_registro']="N";
        $cod_cie10=STRTOUPPER($row[cod1_cpl]);
        $tipo_dfa="P";
        $cups="";
        $cups=validacons($row[area_cpl].' '.$row[nom_areas],$row[coan_cpl],$row[ccup_prim],$row[ccup_cont]);
        $iden_tco='';
        validactr($cups,$iden_ctr,$iden_tco,$desc_map,$valo_tco);
        if($row[codi_des]=''){
            muestraerror("Servicio no homologado ".$row[nom_areas]);
            $GLOBALS['error']=1;
            $GLOBALS['error_registro']='S';  
        }
        //Esta es la informacion para facturar
        if($GLOBALS['error_registro']=='N'){
            guardaregistro($row[CODI_USU],$cont_,$iden_ctr,$row[cod1_cpl],$row[codi_des],$nit_con,$row[iden_cpl],'consultaprincipal','iden_cpl','factu_cpl',$tipo_dfa,$iden_tco,$desc_map,1,$valo_tco,$row['come_cpl']);
        }
    }
}

function validalabo($condicion_,$iden_ctr,$cont_,$nit_con){        
    $tipo_dfa='P';
    $conslab_="SELECT iden_dlab, iden_labs,descrip,iden_cita,fech_dlab,codi_usu,ctr_labs,dxo_labs AS cod_cie10,MED_REALIZA, nord_dlab,codigo,codi_cup,factu_dlab
    FROM vista_detalle_labs
    WHERE $condicion_";
    //echo "<br><br>".$conslab_;
	$conslab_=mysql_query($conslab_);
    if(mysql_num_rows($conslab_)<>0){        
        while($row_=mysql_fetch_array($conslab_)){
            $valor=0;
            $encontrado='N';
            $error_reg_='N';
            //echo "<br>".$row_[iden_cita];
            $constco="SELECT codigo,iden_map,iden_map,iden_tco,iden_ctr,valo_tco,esta_tco FROM vista_tarco WHERE codigo='$row_[codigo]' AND iden_ctr='$iden_ctr'";
            //echo "<br>".$constco;
            $constco=mysql_query($constco);
            //echo "<br>".mysql_num_rows($constco);
            if(mysql_num_rows($constco)<>0){
                $rowtco=mysql_fetch_array($constco);
                $encontrado='S';
                $valor=$rowtco[valo_tco];            
            }
            if($encontrado=='N'){
                $error_="Cups ".$row_[codi_cup]." NO parametrizado en el contrato";
                muestraerror($error_);
                $GLOBALS['errores']++;
                $error_reg_='S';
            }
            if($valor==0){
                $error_="El código: ".$row_[codi_cup]." NO tiene valor";            
                muestraerror($error_);
                $GLOBALS['errores']++;
                $error_reg_='S';
            }            
            if($error_reg_=='N'){
                guardaregistro($row_[CODI_USU],$cont_,$iden_ctr,$row_[cod_cie10],'0631',$nit_con,$row_['iden_dlab'],'detalle_labs','iden_dlab','factu_dlab',$tipo_dfa,$rowtco[iden_tco],$row_[descrip],1,$valor,$row_[MED_REALIZA]);
            }
        }
    }
}

function validaimagen($condi_,$iden_ctr,$cont_,$nit_con){    
    $tipo_dfa="P";
    $sql_="SELECT iden_der,codi_usu, nrod_usu, fech_ecr, iden_ecr,ambi_ecr, dxpr_der, serv_ecr, fasi_ecr, meds_ecr, codi_cup,codigo,descrip, cant_der, cont_ecr, esta_der,factu_der, fech_lec, arso_lec,SERV_SOLI, esta_lec
    FROM vista_lectura_imagen
    WHERE $condi_";
    //echo "<br><br>".$sql_;
    $sql_=mysql_query($sql_);
    //$GLOBALS['nfacturas']=$GLOBALS['nfacturas']+mysql_num_rows($sql_);
    while($row=mysql_fetch_array($sql_)){
        $valor=0;
        $encontrado='N';
        $error_reg_='N';
        //$feci_fac=$row[fech_ecr];
        //$fecf_fac=$row[fech_ecr];
        $cod_cie10=STRTOUPPER($row[dxpr_der]);        
        //$cups=$row[codp_der];        
        $area=$row[SERV_SOLI];
        //$constco="SELECT codigo,iden_map,iden_map,iden_tco,iden_ctr,valo_tco,esta_tco FROM vista_tarco WHERE codigo='$row[codigo]' AND iden_ctr='$iden_ctr'";
        
        //Nota: Se debe revisar la aplicacion de imagenología para que capture el codigo unico y se debe activar la consulta anterior
        $constco="SELECT codigo,iden_map,iden_map,iden_tco,iden_ctr,valo_tco,esta_tco FROM vista_tarco WHERE codi_cup='$row[codigo]' AND iden_ctr='$iden_ctr' AND esta_tco='AC'";
        //echo "<br>".$constco;
        $constco=mysql_query($constco);
        //echo "<br>".mysql_num_rows($constco);
        if(mysql_num_rows($constco)<>0){
            $rowtco=mysql_fetch_array($constco);
            $encontrado='S';
            $valor=$rowtco[valo_tco];            
        }
        if($encontrado=='N'){
            $error_="Cups ".$row[codi_cup]." NO parametrizado en el contrato";
            muestraerror($error_);
            $GLOBALS['errores']++;
            $error_reg_='S';
        }
        if($valor==0){
            $error_="El código: ".$row[codi_cup]." NO tiene valor";            
            muestraerror($error_);
            $GLOBALS['errores']++;
            $error_reg_='S';
        }        
        if($error_reg_=='N'){            
            guardaregistro($row[CODI_USU],$cont_,$iden_ctr,$cod_cie10,'0631',$nit_con,$row[iden_der],'deta_rips','iden_der','factu_der',$tipo_dfa,$rowtco[iden_tco],$row[descrip],$row['cant_der'],$valor,$row[meds_ecr]);
        }
    }
}

function validamedicam($condi_,$iden_ctr,$cont_,$nit_con){
    /*$consmed_="SELECT nume_for,regi_for,fdis_for,codi_medi,coduni_usu,codi_usu,ccos_for,scco_for,area,tido_for,codi_pro,ncsi_medi,nomb_mdi,cdis_for,factu_for
    FROM formedica.vista_formuladet
    WHERE $condi_";*/
    $consmed_="SELECT nume_for,coduni_usu,servicio_for,dxprin_for,regi_for,fdis_for,codi_pro,ncsi_medi,nomb_mdi,cdis_for
    FROM formedica.vista_formuladet
    WHERE $condi_";
    //echo "<br>".$consmed_;
    $consmed_=mysql_query($consmed_);
    if(mysql_num_rows($consmed_)<>0){
        while($row=mysql_fetch_array($consmed_)){            
            $codi_=$row[codi_pro];            
            $iden_tco='';
            $desc_map='';
            $tipo_dfa='';
            $valo_tco=0;
            validamedctr($codi_,$iden_ctr,$iden_tco,$desc_map,$valo_tco,$tipo_dfa,$row[ncsi_medi],$row[nomb_mdi]);
            if($valo_tco<>0){                
                guardaregistro($row[coduni_usu],$cont_,$iden_ctr,$row[dxprin_for],$row[servicio_for],$nit_con,$row['regi_for'],'formedica.formuladet','regi_for','factu_for',$tipo_dfa,$iden_tco,$desc_map,$row[cdis_for],$valo_tco,'');
            }
        }
    }
}

function validaterapiafis($condi_,$iden_ctr,$cont_,$nit_con){
    $conster_="SELECT iden_tcon,fecha_tcon,codmedi_tcon,codi_usu,cont_this,dxprinc_this,proced_tcon,codi_cup,codmedi_tcon
    FROM vista_terapia_fisica
    WHERE $condi_";
    //echo "<br>".$conster_;
    $conster_=mysql_query($conster_);
    while($row=mysql_fetch_array($conster_)){
        $GLOBALS['error_registro']="N";
        $cod_cie10=STRTOUPPER($row[dxprinc_this]);
        $tipo_dfa="P";
        $cups=$row[proced_tcon];
        $area='0614';
        $iden_tco='';
        //echo "<br>".$cups;
        validactr($cups,$iden_ctr,$iden_tco,$desc_map,$valo_tco);
        //Esta es la informacion para facturar
        if($GLOBALS['error_registro']=='N'){            
            guardaregistro($row[codi_usu],$cont_,$iden_ctr,$cod_cie10,$area,$nit_con,$row[iden_tcon],'ter_control','iden_tcon','factu_tcon',$tipo_dfa,$iden_tco,$desc_map,1,$valo_tco,$row['codmedi_tcon']);
        }
    }
}

function validaterapiares($condi_,$iden_ctr,$cont_,$nit_con){
    $conster_="SELECT iden_tre,fecha_tre,codmedi_tre,codi_usu,cont_tre,dxprinc_tre,tratam_tre,codi_cup,codmedi_tre
    FROM vista_terapia_respiratoria
    WHERE $condi_";
    //echo "<br>".$conster_;
    $conster_=mysql_query($conster_);
    while($row=mysql_fetch_array($conster_)){
        $GLOBALS['error_registro']="N";
        $cod_cie10=STRTOUPPER($row[dxprinc_tre]);
        $tipo_dfa="P";
        $cups=$row[tratam_tre];
        $area='0615';
        $iden_tco='';
        $desc_map='';
        $valo_tco=0;
        //echo "<br>---> ".$cups.' '.$iden_ctr.' '.$iden_tco.' '.$desc_map.' '.$valo_tco;
        validactr($cups,$iden_ctr,$iden_tco,$desc_map,$valo_tco);
        //echo "<br>".$iden_tco.' '.$desc_map.' '.$valo_tco;        
        
        //Esta es la informacion para facturar
        if($GLOBALS['error_registro']=='N'){                        
            guardaregistro($row[codi_usu],$cont_,$iden_ctr,$cod_cie10,$area,$nit_con,$row[iden_tre],'tres_historia','iden_tre','factu_tre',$tipo_dfa,$iden_tco,$desc_map,1,$valo_tco,$row['codmedi_tre']);
        }
    }
}


function validaqx($condi_,$iden_ctr,$cont_,$nit_con){
    $consqx_="SELECT iden_qxf,fech_qxf,iden_cir,oper_cir,codi_usu,ctro_usu,dxpe_cir,ccup_cir,codi_cup
    FROM vista_quirofano_detalle
    WHERE $condi_";
    //echo "<br>".$consqx_;
    $consqx_=mysql_query($consqx_);
    while($row=mysql_fetch_array($consqx_)){
        $GLOBALS['error_registro']="N";
        $cod_cie10=STRTOUPPER($row[dxpe_cir]);
        $tipo_dfa="P";
        $cups=$row[ccup_cir];
        //echo "<br>".$cups;
        $area='0698';
        $iden_tco='';
        $desc_map='';
        $valo_tco=0;
        //echo "<br>---> ".$cups.' '.$iden_ctr.' '.$iden_tco.' '.$desc_map.' '.$valo_tco;
        validactr($cups,$iden_ctr,$iden_tco,$desc_map,$valo_tco);
        //echo "<br>".$iden_tco.' '.$desc_map.' '.$valo_tco;        
        
        //Esta es la informacion para facturar
        if($GLOBALS['error_registro']=='N'){            
            guardaregistro($row[CODI_USU],$cont_,$iden_ctr,$cod_cie10,$area,$nit_con,$row[iden_cir],'detalle_cirujia','iden_cir','factu_cir',$tipo_dfa,$iden_tco,$desc_map,'1',$valo_tco,$row['oper_cir']);
        }
    }
}

function validarips_consulta($condi_,$iden_ctr,$cont_,$nit_con){    
    $tipo_dfa="P";
    $cantidad='1';
    $sql_="SELECT iden_fac,codi_usu, nrod_usu,digp_rip,codi_cup,cups_rip,Cserv_horario,Cmed_horario, fcon_rip
    FROM vista_rips_consulta
    WHERE $condi_";
    //echo "<br><br>".$sql_;
    $sql_=mysql_query($sql_);
    $GLOBALS['nfacturas']=$GLOBALS['nfacturas']+mysql_num_rows($sql_);
    //echo mysql_num_rows($sql_);
    while($row=mysql_fetch_array($sql_)){
        $valor=0;
        $encontrado='N';
        $error_reg_='N';
        $cod_cie10=STRTOUPPER($row[digp_rip]);        
        //$cups=$row[codp_der];
        $conserv="SELECT areas.cod_areas, areas.nom_areas, areas.codi_des FROM areas WHERE areas.cod_areas='$row[Cserv_horario]'";
        //echo "<br>".$conserv;
        $conserv=mysql_query($conserv);
        $rowserv=mysql_fetch_array($conserv);
        $area=$rowserv[codi_des];
        if(empty($rowserv['codi_des'])){
            $GLOBALS['errores']++;
            $error_reg_='S';
            $error_="El área: ".$row[Cserv_horario]." NO está homologada con el servicio";            
            muestraerror($error_);
        }
        
        $constco="SELECT codigo,codi_cup,iden_map,iden_map,iden_tco,iden_ctr,descrip,valo_tco,esta_tco FROM vista_tarco WHERE codigo='$row[cups_rip]' AND iden_ctr='$iden_ctr'";
        //echo "<br>".$constco;
        $constco=mysql_query($constco);
        //echo "<br>".mysql_num_rows($constco);
        if(mysql_num_rows($constco)<>0){
            $rowtco=mysql_fetch_array($constco);
            $encontrado='S';
            $valor=$rowtco[valo_tco];            
        }
        if($encontrado=='N'){
            $error_="Cups ".$row[codi_cup]." NO parametrizado en el contrato";
            muestraerror($error_);
            $GLOBALS['errores']++;
            $error_reg_='S';
        }
        if($valor==0){
            $error_="El código: ".$row[codi_cup]." NO tiene valor";            
            muestraerror($error_);
            $GLOBALS['errores']++;
            $error_reg_='S';
        }        
        if($error_reg_=='N'){            
            guardaregistro($row[CODI_USU],$cont_,$iden_ctr,$cod_cie10,$area,$nit_con,$row[iden_fac],'rips_consulta','iden_fac','factu_rip',$tipo_dfa,$rowtco[iden_tco],$rowtco[descrip],$cantidad,$valor,$row[Cmed_horario]);
        }
    }
}

function validarips_procedim($condi_,$iden_ctr,$cont_,$nit_con){            
    $tipo_dfa="P";
    $cantidad='1';
    $sql_="SELECT iden_der,codi_usu, nrod_usu,dxpr_der,codp_der,codi_cup,area_ecr,serv_ecr,meds_ecr, fech_ecr,cant_der
    FROM vista_rips_procedimientos
    WHERE $condi_";
    //echo "<br><br>".$sql_;
    $sql_=mysql_query($sql_);
    $GLOBALS['nfacturas']=$GLOBALS['nfacturas']+mysql_num_rows($sql_);
    //echo mysql_num_rows($sql_);
    while($row=mysql_fetch_array($sql_)){
        $valor=0;
        $encontrado='N';
        $error_reg_='N';
        $cod_cie10=STRTOUPPER($row[dxpr_der]);
        $area=$row[serv_ecr];
        //$constco="SELECT codigo,codi_cup,iden_map,iden_map,iden_tco,iden_ctr,descrip,valo_tco,esta_tco FROM vista_tarco WHERE codigo='$row[codp_der]' AND iden_ctr='$iden_ctr' AND esta_tco='AC' AND esta_cup='AC'";
        $constco="SELECT codigo,codi_cup,iden_map,iden_map,iden_tco,iden_ctr,descrip,valo_tco,esta_tco FROM vista_tarco WHERE codigo='$row[codp_der]' AND iden_ctr='$iden_ctr'";
        //echo "<br>".$constco;
        $constco=mysql_query($constco);
        //echo "<br>".mysql_num_rows($constco);
        if(mysql_num_rows($constco)<>0){
            $rowtco=mysql_fetch_array($constco);
            $encontrado='S';
            $valor=$rowtco[valo_tco];            
        }         
        if($encontrado=='N'){
            $error_="Cups ".$row[codi_cup]." NO parametrizado en el contrato";
            muestraerror($error_);
            $GLOBALS['errores']++;
            $error_reg_='S';
        }
        if($valor==0){
            $error_="El código: ".$row[codi_cup]." NO tiene valor";            
            muestraerror($error_);
            $GLOBALS['errores']++;
            $error_reg_='S';
        }
        if($area==''){
            $error_="Servicio ".$row[area_ecr]." NO homologado";
            muestraerror($error_);
            $GLOBALS['errores']++;
            $error_reg_='S';
        }
        if($error_reg_=='N'){            
            guardaregistro($row[CODI_USU],$cont_,$iden_ctr,$cod_cie10,$area,$nit_con,$row[iden_der],'deta_rips','iden_der','factu_der',$tipo_dfa,$rowtco[iden_tco],$rowtco[descrip],$row[cant_der],$valor,$row[meds_ecr]);
        }
    }
}

function validasaludocupa($condi_,$iden_ctr,$cont_,$nit_con){
    $sql_="SELECT iden_enc,codi_usu,dpri_enc,cont_inf,area_inf,codi_des,servicio,tico_inf,ccup_prim,ccup_cont,codi_med FROM vista_consulta_salud_ocupacional
    WHERE $condi_";
    //echo "<br>".$sql_;
    $sql_=mysql_query($sql_);    
    while($row=mysql_fetch_array($sql_)){        
        $GLOBALS['error_registro']="N";
        $cod_cie10=STRTOUPPER($row[dpri_enc]);        
        $tipo_dfa="P";
        //Aqui determino si la consulta es de primera vez o de control
        if($row[tico_inf]=='CONSULTA' OR $row[tico_inf]=='CONSULTA_FUN'){
            $coan_cpl='1';
        }
        else{
            $coan_cpl='2';
        }
        $cups="";
        $cups=validacons($row[area_inf].' '.$row[servicio],$coan_cpl,$row[ccup_prim],$row[ccup_cont]);        
        $iden_tco='';
        validactr($cups,$iden_ctr,$iden_tco,$desc_map,$valo_tco);        
        //Esta es la informacion para facturar
        if($GLOBALS['error_registro']=='N'){
            guardaregistro($row[codi_usu],$cont_,$iden_ctr,$row[dpri_enc],$row[codi_des],$nit_con,$row[iden_enc],'so_encahistoria','iden_enc','factu_enc',$tipo_dfa,$iden_tco,$desc_map,1,$valo_tco,$row['codi_med']);            
        }
    }
}

function validacitol($condi_,$iden_ctr,$cont_,$nit_con){    
    $sql_="SELECT iden_hpri,cod_usu,ciecon10_hpri,cotra_citas,area,codi_des,nom_areas,cocucon_hpri,cocupro_hpri,cod_medi FROM vista_citologia
    WHERE $condi_";
    //echo "<br>".$sql_;
    $sql_=mysql_query($sql_);
    while($row=mysql_fetch_array($sql_)){
        $GLOBALS['error_registro']="N";
        $cod_cie10=STRTOUPPER($row[ciecon10_hpri]);
        $tipo_dfa="P";
        $cups=$row[cocucon_hpri];
        $area=$row[codi_des];
        $iden_tco='';
        $desc_map='';
        $valo_tco=0;
        //echo "<br>---> ".$cups.' '.$iden_ctr.' '.$iden_tco.' '.$desc_map.' '.$valo_tco;
        validactr($cups,$iden_ctr,$iden_tco,$desc_map,$valo_tco);
        //echo "<br>".$iden_tco.' '.$desc_map.' '.$valo_tco;                
        //Esta es la informacion para facturar la educacion(consulta) de citología
        if($GLOBALS['error_registro']=='N'){
            guardaregistro($row[cod_usu],$cont_,$iden_ctr,$cod_cie10,$area,$nit_con,$row[iden_hpri],'histocc_pararips','iden_hpri','factu_hpri',$tipo_dfa,$iden_tco,$desc_map,1,$valo_tco,$row['cod_medi']);
        }

        $cups=$row[cocupro_hpri];        
        $iden_tco='';
        $desc_map='';
        $valo_tco=0;
        validactr($cups,$iden_ctr,$iden_tco,$desc_map,$valo_tco);
        //echo "<br>".$iden_tco.' '.$desc_map.' '.$valo_tco.' err: '.$GLOBALS['error_registro'];
        //Esta es la informacion para facturar el procedimiento de citología
        if($GLOBALS['error_registro']=='N'){            
            guardaregistro($row[cod_usu],$cont_,$iden_ctr,$cod_cie10,$area,$nit_con,$row[iden_hpri],'histocc_pararips','iden_hpri','factu_hpri',$tipo_dfa,$iden_tco,$desc_map,1,$valo_tco,$row['cod_medi']);
        }
    }
}

function cargamedicamentos($fechaini_,$fechafin_){
    $sql_="CREATE TEMPORARY TABLE medicamentos_dispensacion AS 
    SELECT nume_for,regi_for,nume_con,fdis_for,codi_medi,coduni_usu,codi_usu,ccos_for,scco_for,area,tido_for,codi_pro,cdis_for,factu_for
    FROM formedica.vista_formuladet WHERE fdis_for between '$fechaini_' AND '$fechafin_'";    
    echo "<br><br>".$sql_;
    $sql_=mysql_query($sql_);
    $sql_="CREATE INDEX nume_con ON medicamentos_dispensacion(nume_con)";
    //echo "<br><br>".$sql_;
    $sql_=mysql_query($sql_);
}

function createmporal(){
    $sql_="CREATE TEMPORARY TABLE tmp_factura(        
        codi_usu int(7),
        codi_con varchar(3),
        iden_ctr int(7),
        cod_cie10 varchar(4),
        area_fac varchar(4),
        enti_fac varchar(12), 
        registro int(7),
        tabla varchar(70),
        llave varchar(30),
        campo varchar(30),
        tipo_dfa char(1),
        iden_tco varchar(15),
        desc_dfa varchar(250),
        cant_dfa int(6),
        valu_dfa int(9),
        cod_medi varchar(20)
        )";
    $sql_=mysql_query($sql_);    
}

function guardaregistro($codi_usu_,$contrato_,$iden_ctr_,$cie_10_,$codi_des_,$nit_con_,$iden_cpl_,$tabla_,$llave_,$campo_,$tipo_dfa_,$iden_tco_,$desc_map_,$cantidad_,$valo_tco_,$come_cpl_){    
    $sql_="INSERT INTO tmp_factura(codi_usu,codi_con,iden_ctr,cod_cie10,area_fac,enti_fac,registro,tabla,llave,campo,tipo_dfa,iden_tco,desc_dfa,cant_dfa,valu_dfa,cod_medi) values('$codi_usu_','$contrato_','$iden_ctr_','$cie_10_','$codi_des_','$nit_con_','$iden_cpl_','$tabla_','$llave_','$campo_','$tipo_dfa_','$iden_tco_','$desc_map_','$cantidad_','$valo_tco_','$come_cpl_')";
    //echo "<br><br>".$sql_;
    mysql_query($sql_);
    //echo "<br>".mysql_affected_rows();    
}
function creafacturas($fechaini,$fechafin,$fcie_fac,$usufac_){
    $consfac="SELECT pref2_emp,num2_fac FROM empresa";
    $consfac=mysql_query($consfac);
    $rowfac=mysql_fetch_array($consfac);
    $pref2_emp=$rowfac['pref2_emp'];
    $num2_fac=$rowfac['num2_fac'];
    $hoy=cambiafecha(hoy());    
    $nfacturas=0;

    //Aqui se consulta la informacion del encabezado de la factura
    $consfac_="SELECT codi_usu,codi_con,iden_ctr,cod_cie10,area_fac,enti_fac FROM tmp_factura GROUP BY codi_usu ORDER BY codi_usu";
    //echo "<br>".$consfac_;
    $consfac_=mysql_query($consfac_);
    //echo "<br>Registros: ".mysql_num_rows($consfac_);
    while($row_=mysql_fetch_array($consfac_)){
        $nfacturas++;        
        ////Aqui se guarda la informacion del encabezado de la factura
        $sqlfac_="INSERT INTO encabezado_factura(nume_fac,pref_fac,tipo_fac,feci_fac,fecf_fac,fcie_fac,rela_fac,codi_usu,codi_con,iden_ctr,cod_cie10,area_fac,vtot_fac,pcop_fac,vcop_fac,pdes_fac,cmod_fac,vnet_fac,esta_fac,enti_fac,anul_fac,usua_fac,frea_fac,nauto_fac) VALUES('$num2_fac','$pref2_emp','1','$fechaini','$fechafin','$fcie_fac','','$row_[codi_usu]','$row_[codi_con]','$row_[iden_ctr]','$row_[cod_cie10]','$row_[area_fac]','0','0','0','0','0','0','2','$row_[enti_fac]','N','$usufac_','$hoy','')";
        //echo "<br>".$sqlfac_;
        mysql_query($sqlfac_);
        $iden_fac=mysql_insert_id();
        ////Aqui se consulta la informacion del detalle de la factura
        $consdet_="SELECT tipo_dfa,area_fac,codi_usu,registro,tabla,llave,campo,iden_tco,desc_dfa,cant_dfa,valu_dfa,cod_medi FROM tmp_factura WHERE codi_usu='$row_[codi_usu]'";
        //echo "<br>".$consdet_;
        $consdet_=mysql_query($consdet_);
        if(mysql_num_rows($consdet_)<>0){
            $total=0;
            while($rowdet_=mysql_fetch_array($consdet_)){                
                //Aqui se guarda la informacion del detalle de la factura
                $sqldet_="INSERT INTO detalle_factura(tipo_dfa,iden_fac,iden_tco,desc_dfa,cant_dfa,valu_dfa,esta_dfa,nauto_dfa,cod_medi,servi_dfa) VALUES('$rowdet_[tipo_dfa]','$iden_fac','$rowdet_[iden_tco]','$rowdet_[desc_dfa]','$rowdet_[cant_dfa]','$rowdet_[valu_dfa]','1','','$rowdet_[cod_medi]','$rowdet_[area_fac]')";
                //echo "<br>".$sqldet_;
                mysql_query($sqldet_);
                $iden_dfa=mysql_insert_id();
                $total=$total+($rowdet_[cant_dfa]*$rowdet_[valu_dfa]);
                //echo "<br>".$total;
                //Aqui se cambia el estado a facturado en las tablas respectivas                
                $sqlestado_="UPDATE $rowdet_[tabla] SET $rowdet_[campo]='S',iden_dfa='$iden_dfa' WHERE $rowdet_[llave]='$rowdet_[registro]'";
                //echo "<br>".$sqlestado_;
                mysql_query($sqlestado_);
                //echo "<br>".mysql_affected_rows();
            }
            $sqlactfac_="UPDATE encabezado_factura SET vtot_fac='$total',vnet_fac='$total' WHERE iden_fac='$iden_fac'";
            //echo "<br>".$sqlactfac_;
            mysql_query($sqlactfac_);
        }
        $num2_fac++;
        $sqlnewfac_="UPDATE empresa SET num2_fac='$num2_fac'";
        //echo "<br>".$sqlnewfac_;
        mysql_query($sqlnewfac_);
    }
    echo "<br>Se procesaron ".$nfacturas." facturas ";
}
?>
<html><head></head><body></body></html>