<?php
session_start();
$errores=0;
$nume_fac=0;
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
        $nfacturas=0;
        
        //Aqui se valida la informacion de consulta externa, se valida que no sean consultas de pyp        
        $fechaini=cambiafecha($fechaini);
        $fechafin=cambiafecha($fechafin);
        $fcie_fac=cambiafecha($fcie_fac);

        $condicion="CODI_USU<>0 AND cont_ehi='002' AND area_cpl<>'82' AND factu_cpl<>'S' AND ";
        if(!empty($fechaini)){$condicion=$condicion."feca_cpl between '".$fechaini."' AND ";}
        if(!empty($fechafin)){$condicion=$condicion."'".$fechafin."' AND ";}
        $condicion=substr($condicion,0,strlen($condicion)-5);
        //echo "<br>".$condicion;
        $cons_nit="SELECT NIT_CON FROM CONTRATO WHERE CODI_CON='002'";
        $cons_nit=mysql_query($cons_nit);
        $row_nit=mysql_fetch_array($cons_nit);
        $nit_con=$row_nit[NIT_CON];
        createmporal();
        cargamedicamentos($fechaini);
        validaconsultaext($condicion,$iden_ctr,$nit_con);
	  ?>
	</table>
        <?php
            if($errores!=0 and $nfacturas<>0){
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
function validaconsultaext($condi_,$iden_ctr,$nit_con){    
    $sql_="SELECT iden_cpl,numc_cpl,id_cita,CODI_USU,NROD_USU,area_cpl,nom_areas,codi_des,feca_cpl,cod1_cpl,coan_cpl,ccup_prim,ccup_cont,come_cpl FROM vista_consulta_externa
    WHERE $condi_";
    //echo "<br>".$sql_;
    $sql_=mysql_query($sql_);
    if(mysql_num_rows($sql_)<>0){
        $fcie_fac=cambiafecha($fcie_fac);
        $GLOBALS['nfacturas']=$GLOBALS['nfacturas']+mysql_num_rows($sql_);    
        while($row=mysql_fetch_array($sql_)){
            $GLOBALS['error_registro']="N";
            $feci_fac=$row[feca_cpl];
            $fecf_fac=$row[feca_cpl];
            $cod_cie10=STRTOUPPER($row[cod1_cpl]);
            $tipo_dfa="P";
            //echo "<br>".$row[codi_des];
            $cups="";
            $cups=validacons($row[area_cpl].' '.$row[nom_areas],$row[coan_cpl],$row[ccup_prim],$row[ccup_cont]);
            $iden_tco='';
            validactr($cups,$iden_ctr,$iden_tco,$desc_map,$valo_tco);
            //Esta es la informacion para facturar
            if($GLOBALS['error_registro']=='N'){
                $GLOBALS['nume_fac']++;
                guardaregistro($GLOBALS[nume_fac],$row[CODI_USU],'002',$iden_ctr,$cod_cie10,$row[codi_des],$nit_con,$row[iden_cpl],'consultaprincipal','iden_cpl','factu_cpl',$tipo_dfa,$iden_tco,$desc_map,1,$valo_tco,$row[come_cpl],$row[codi_des],$row[feca_cpl]);
            }
            //echo "<br>".$row[id_cita].' '.$iden_ctr;
            validalabo($row[id_cita],$iden_ctr,$cod_cie10,$row[codi_des],$nit_con);
            //validaimagen($row[id_cita],$iden_ctr);
            validamedicam($row[numc_cpl],$iden_ctr,$row[cod1_cpl],$row[codi_des],$nit_con,$row['come_cpl']);
        }
    }
}

function validalabo($id_cita,$iden_ctr,$cod_cie10_,$area_,$nit_con){
    $valor=0;
    $encontrado='N';
    $error_reg_='N';
    $tipo_dfa='P';
    $conslab_="SELECT iden_dlab, iden_labs,descrip,iden_cita,fech_dlab,codi_usu,ctr_labs,dxo_labs AS cod_cie10,MED_REALIZA, nord_dlab,codigo,codi_cup,factu_dlab
    FROM vista_detalle_labs
    WHERE (estd_dlab = 'CU' OR estd_dlab = 'RE') AND factu_dlab<>'S' AND iden_cita='$id_cita'";    
    //echo "<br><br>".$conslab_;
	$conslab_=mysql_query($conslab_);
    if(mysql_num_rows($conslab_)<>0){
        echo "<br>".$id_cita.' '.$iden_ctr;
        while($row_=mysql_fetch_array($conslab_)){
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
                guardaregistro($GLOBALS[nume_fac],$row_[CODI_USU],'002',$iden_ctr,$cod_cie10_,$area_,$nit_con,$row_[iden_dlab],'detalle_labs','iden_dlab','factu_dlab',$tipo_dfa,$rowtco[iden_tco],$row_[descrip],1,$valor,$row_[MED_REALIZA],$area_,$row_[fech_dlab]);
            }
        }
    }
}

function validaimagen($condi_,$iden_ctr){           
    $sql_="SELECT usuario.codi_usu, usuario.nrod_usu, enca_rips.fech_ecr, enca_rips.iden_ecr,enca_rips.ambi_ecr, deta_rips.dxpr_der, enca_rips.serv_ecr, enca_rips.fasi_ecr, enca_rips.meds_ecr, deta_rips.codp_der, deta_rips.cant_der, enca_rips.cont_ecr, deta_rips.esta_der,deta_rips.factu_der, lectura_imagen.fech_lec, lectura_imagen.arso_lec, lectura_imagen.esta_lec
    FROM ((deta_rips INNER JOIN enca_rips ON deta_rips.iden_ecr = enca_rips.iden_ecr) INNER JOIN lectura_imagen ON deta_rips.iden_der = lectura_imagen.iden_var) INNER JOIN usuario ON enca_rips.iden_uco = usuario.CODI_USU
	WHERE $condi_";
    //echo "<br><br>".$sql_;
    /*$sql_=mysql_query($sql_);
    //$fcie_fac=cambiafecha($fcie_fac);    
    $GLOBALS['nfacturas']=$GLOBALS['nfacturas']+mysql_num_rows($sql_);
    while($row=mysql_fetch_array($sql_)){
        $feci_fac=$row[fech_ecr];
        $fecf_fac=$row[fech_ecr];
        $cod_cie10=STRTOUPPER($row[dxpr_der]);        
        $tipo_dfa="P";                
        $cups=$row[codp_der];        
        
        $area=$row[arso_lec];                
        $consarea="SELECT codi_des,nom_areas FROM areas WHERE cod_areas='$area'";        
        $consarea=mysql_query($consarea);
        $rowarea=mysql_fetch_array($consarea);        

        //validausu($row[codi_usu],$row[cont_ecr],$row[nrod_usu]);        
        validacie10($cod_cie10,$row[nrod_usu],$row[iden_ecr],'Imagenologia');
        $iden_tco='';
        validactr($cups,$iden_ctr,$iden_tco,$desc_map,$valo_tco);
        validaarea($rowarea[codi_des],$area,$rowarea[nom_areas]);
        if(empty($arso_lec)){
            muestraerror("El Servicio Solicitante, en imagenología, no debe estar vacío");
        }
        //echo "<br>".$cups." ".$iden_ctr." ".$iden_tco." ".$desc_map." ".$valo_tco;
    }*/
}

function validamedicam($numc_cpl,$iden_ctr,$cod_cie10_,$area_,$nit_con,$come_cpl_){
    /*$consmed_="SELECT nume_for,regi_for,fdis_for,codi_medi,coduni_usu,codi_usu,ccos_for,scco_for,area,tido_for,codi_pro,ncsi_medi,nomb_mdi,cdis_for
    FROM medicamentos_dispensacion
    WHERE nume_con='$numc_cpl'";*/

    $consmed_="SELECT nume_for,regi_for,fdis_for,codi_medi,coduni_usu,codi_usu,ccos_for,scco_for,area,tido_for,codi_pro,ncsi_medi,nomb_mdi,cdis_for,factu_for
    FROM formedica.vista_formuladet
    WHERE nume_con='$numc_cpl'";        

    //echo "<br>".$consmed_;
    $consmed_=mysql_query($consmed_);
    if(mysql_num_rows($consmed_)<>0){
        while($row=mysql_fetch_array($consmed_)){
            $feci_fac=$row[fdis_for];
            $fecf_fac=$row[fdis_for];            
            $codi_=$row[codi_pro];
            //if(empty($area_fac)){
            //    $area_fac=traeareamed($row[codi_medi]);
            //}
            $iden_tco='';
            $tipo_dfa='';     
            validamedctr($codi_,$iden_ctr,$iden_tco,$desc_map,$valo_tco,$tipo_dfa,$row[ncsi_medi],$row[nomb_mdi]);
            if($valo_tco<>0){
                //echo "<br>".$GLOBALS['nume_fac'].' '.$row['coduni_usu'].' '.'002'.' '.$iden_ctr.' '.$cod_cie10_.' '.$area_.' '.$nit_con.' '.$row['regi_for'].' '.'formedica.formuladet'.' '.'regi_for'.' '.'factu_for'.' '.$tipo_dfa.' '.$iden_tco.' '.$desc_map.' '.$row[cdis_for].' '.$valo_tco.' '.$come_cpl_;
                guardaregistro($GLOBALS['nume_fac'],$row['coduni_usu'],'002',$iden_ctr,$cod_cie10_,$area_,$nit_con,$row['regi_for'],'formedica.formuladet','regi_for','factu_for',$tipo_dfa,$iden_tco,$desc_map,$row[cdis_for],$valo_tco,$come_cpl_,$area_,$row[fdis_for]);
            }
        }
    }
}

function cargamedicamentos($fechaini_){
    $sql_="CREATE TEMPORARY TABLE medicamentos_dispensacion AS 
    SELECT nume_for,regi_for,nume_con,fdis_for,codi_medi,coduni_usu,codi_usu,ccos_for,scco_for,area,tido_for,codi_pro,cdis_for
    FROM formedica.vista_formuladet WHERE fdis_for>='$fechaini_'";    
    //echo "<br><br>".$sql_;
    $sql_=mysql_query($sql_);
    $sql_="CREATE INDEX nume_con ON medicamentos_dispensacion(nume_con)";
    //echo "<br><br>".$sql_;
    $sql_=mysql_query($sql_);    
}

function createmporal(){
    $sql_="CREATE TEMPORARY TABLE tmp_factura(
        nume_fac int(7),
        codi_usu int(7),
        codi_con varchar(3),
        iden_ctr int(7),
        cod_cie10 varchar(4),
        area_fac varchar(4),
        enti_fac varchar(12), 
        registro int(7),
        tabla varchar(30),
        llave varchar(30),
        campo varchar(30),
        tipo_dfa char(1),        
        iden_tco varchar(15),
        desc_dfa varchar(250),        
        cant_dfa int(6),
        valu_dfa int(9),
        cod_medi varchar(20),
        servi_dfa varchar(4),
        fecservi_dfa date
        )";
    $sql_=mysql_query($sql_);
}

function guardaregistro($nume_fac_,$codi_usu_,$contrato_,$iden_ctr_,$cie_10_,$codi_des_,$nit_con_,$iden_cpl_,$tabla_,$llave_,$campo_,$tipo_dfa_,$iden_tco_,$desc_map_,$cantidad_,$valo_tco_,$come_cpl_,$servi_dfa_,$fecservi_dfa_){
    $sql_="INSERT INTO tmp_factura(nume_fac,codi_usu,codi_con,iden_ctr,cod_cie10,area_fac,enti_fac,registro,tabla,llave,campo,tipo_dfa,iden_tco,desc_dfa,cant_dfa,valu_dfa,cod_medi,servi_dfa,fecservi_dfa) values('$nume_fac_','$codi_usu_','$contrato_','$iden_ctr_','$cie_10_','$codi_des_','$nit_con_','$iden_cpl_','$tabla_','$llave_','$campo_','$tipo_dfa_','$iden_tco_','$desc_map_','$cantidad_','$valo_tco_','$come_cpl_','$servi_dfa_','$fecservi_dfa_')";
    //echo "<br>".$sql_;
    mysql_query($sql_);
    //echo "<br>".mysql_affected_rows();
}


function creafacturas($fechaini,$fechafin,$fcie_fac,$usufac_){
    $consfac="SELECT pref2_emp,num2_fac FROM empresa";
    $consfac=mysql_query($consfac);
    $rowfac=mysql_fetch_array($consfac);
    $pref2_emp=$rowfac['pref2_emp'];
    $num2_fac=$rowfac['num2_fac'];
    //echo "<br>".$num2_fac;
    $hoy=cambiafecha(hoy());
    $nfacturas=0;
    //Aqui se consulta la informacion del encabezado de la factura
    $consfac_="SELECT nume_fac,codi_usu,codi_con,iden_ctr,cod_cie10,area_fac,enti_fac FROM tmp_factura GROUP BY nume_fac ORDER BY nume_fac";
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
        $consdet_="SELECT tipo_dfa,codi_usu,registro,tabla,llave,campo,iden_tco,desc_dfa,cant_dfa,valu_dfa,cod_medi FROM tmp_factura WHERE nume_fac='$row_[nume_fac]'";
        echo "<br>".$consdet_;
        $consdet_=mysql_query($consdet_);
        if(mysql_num_rows($consdet_)<>0){
            $total=0;
            while($rowdet_=mysql_fetch_array($consdet_)){                
                //Aqui se guarda la informacion del detalle de la factura
                $sqldet_="INSERT INTO detalle_factura(tipo_dfa,iden_fac,iden_tco,desc_dfa,cant_dfa,valu_dfa,esta_dfa,nauto_dfa,cod_medi,servi_dfa,fecservi_dfa) VALUES('$rowdet_[tipo_dfa]','$iden_fac','$rowdet_[iden_tco]','$rowdet_[desc_dfa]','$rowdet_[cant_dfa]','$rowdet_[valu_dfa]','1','','$rowdet_[cod_medi]','$rowdet_[servi_dfa]','$rowdet_[fecservi_dfa]')";
                echo "<br>".$sqldet_;
                mysql_query($sqldet_);
                $total=$total+($rowdet_[cant_dfa]*$rowdet_[valu_dfa]);                
                //Aqui se cambia el estado a facturado en las tablas respectivas
                //echo "<br>".$rowdet_[registro]." ".$rowdet_[tabla]." ".$rowdet_[llave]." ".$rowdet_[campo];
                $sqlestado_="UPDATE $rowdet_[tabla] SET $rowdet_[campo]='S' WHERE $rowdet_[llave]='$rowdet_[registro]'";
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
