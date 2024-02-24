<html>
<head>
<title>PROGRAMA DE FACTURACION</title>
<link rel="stylesheet" href="css/style.css" type="text/css" />
<script language='javascript'>
function validar(){
  form1.submit();
}
</script>
</head>
<body>
<form name='form1' method="POST" action='fac_4heguardarel.php' target='fr02'>
<table class="Tbl0"><tr><td class="Td0" align='center'>R I P S</td></tr></table>
<?
set_time_limit(0);
include('php/conexion.php');
include('php/funciones.php');
$consultaemp=mysql_query("SELECT codp_emp FROM empresa");
$rowemp=mysql_fetch_array($consultaemp);
$codp_emp=$rowemp[codp_emp];

$condicion="";
if(!empty($factura)){
    $condicion=$condicion."ef.nume_fac='$factura' and ";}
if(!empty($pref_fac)){
    $condicion=$condicion."ef.pref_fac='$pref_fac' and ";}    
if(!empty($relacion)){
    $condicion=$condicion."ef.rela_fac='$relacion' and ";}
if(!empty($condicion)){
    $condicion=substr($condicion,0,strlen($condicion)-5);
}
//echo $condicion;
$consulta="SELECT df.iden_fac,df.iden_dfa,df.tipo_dfa,df.iden_tco,df.cant_dfa,df.valu_dfa,df.nauto_dfa,tco.tser_tco,des.valo_des,
 ef.nume_fac,ef.id_ing,ef.feci_fac,ef.fecf_fac,ef.cod_cie10,ef.vnet_fac,
 ctr.rcod_ctr,
 us.tdoc_usu,us.nrod_usu
 FROM detalle_factura AS df
 INNER JOIN encabezado_factura AS ef ON ef.iden_fac=df.iden_fac
 INNER JOIN contratacion AS ctr ON ctr.iden_ctr=ef.iden_ctr
 INNER JOIN usuario AS us ON us.codi_usu=ef.codi_usu
 LEFT JOIN tarco AS tco ON tco.iden_tco=df.iden_tco
 LEFT JOIN destipos AS des ON des.codi_des=tco.tser_tco
 WHERE $condicion ORDER BY ef.nume_fac";
//echo "<br>".$consulta;
$consulta=mysql_query($consulta);
if(mysql_num_rows($consulta)!=0){
  echo "<table class='Tbl0' border='0'>";
  echo "<th class='Th0' width='10%'>Sel</th>
        <th class='Th0' width='15%'>Factura</th>
	<th class='Th0' width='25%'>Concepto</th>
        <th class='Th0' width='25%'>Fecha Cierre</th>
	<th class='Th0' width='25%'>Identificacin</th>";
  $cont=0;
  while($row=mysql_fetch_array($consulta)){
        if($color<>'#dddddd'){$color='#dddddd';}else{$color='';}

	//Asigno los resultados de la consulta, a variables
	$tipo=$row[valo_des];
  $iden_fac=$row[iden_fac];  
	$iden_dfa=$row[iden_dfa];
	$nume_fac=$row[nume_fac];
	$id_ing=$row[id_ing];
	$tdoc_usu=$row[tdoc_usu];
	$nrod_usu=$row[nrod_usu];
	$feci_fac=cambiafechadmy($row[feci_fac]);
  $fecf_fac=cambiafechadmy($row[fecf_fac]);
	$tser_tco=$row[tser_tco];
	$tipo_dfa=$row[tipo_dfa];
	$iden_tco=$row[iden_tco];
  $rcod_ctr=$row[rcod_ctr];
	$cod_cie10=$row[cod_cie10];
	$cant_dfa=$row[cant_dfa];
	$valu_dfa=$row[valu_dfa];
	$total=$cant_dfa*$valu_dfa;
  $nauto_dfa=$row[nauto_dfa];
	//echo "<br>".$tipo_dfa;
        //echo "<br>".$tipo;
        if($tipo_dfa=='P'){          
           switch($tipo){
              case '01':                
                creaconsulta($iden_fac,$iden_dfa,$nume_fac,$codp_emp,$tdoc_usu,$nrod_usu,$feci_fac,$tipo_dfa,$iden_tco,$cod_cie10,$cant_dfa,$valu_dfa,$rcod_ctr,$nauto_dfa);                
                break;
              case '02':
                creaproced($iden_fac,$iden_dfa,$nume_fac,$codp_emp,$tdoc_usu,$nrod_usu,$feci_fac,$tipo_dfa,$iden_tco,$cod_cie10,$cant_dfa,$valu_dfa,'1',$rcod_ctr,$nauto_dfa);
                break;
              case '03':
                creaproced($iden_fac,$iden_dfa,$nume_fac,$codp_emp,$tdoc_usu,$nrod_usu,$feci_fac,$tipo_dfa,$iden_tco,$cod_cie10,$cant_dfa,$valu_dfa,'2',$rcod_ctr,$nauto_dfa);
                break;
              case '04':
                creaproced($iden_fac,$iden_dfa,$nume_fac,$codp_emp,$tdoc_usu,$nrod_usu,$feci_fac,$tipo_dfa,$iden_tco,$cod_cie10,$cant_dfa,$valu_dfa,'3',$rcod_ctr,$nauto_dfa);
                break;
              case '05':
                creaproced($iden_fac,$iden_dfa,$nume_fac,$codp_emp,$tdoc_usu,$nrod_usu,$feci_fac,$tipo_dfa,$iden_tco,$cod_cie10,$cant_dfa,$valu_dfa,'4',$rcod_ctr,$nauto_dfa);
                break;
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
        }
        //echo"</tr>";
	$cont++;
  }  
  echo "</table>";
  echo "<br><br><br><center>R I P S Generados satisfactoriamente</center>";  
  //echo "<br><br><br><center><a href='fac_4hemuestrarips.php?nit=$nit&&relacion=$relacion'>Ir a RIPS</a></center>";  
}
else{
  echo "<center>";
  echo "<p class=Msg>No existen registros para esta busqueda</p>";
  echo "</center>";
}
echo "<input type='hidden' name='cont' value='$cont'>";
echo "<input type='hidden' name='relacion' value='$relacion'>";
mysql_free_result($consulta);
mysql_free_result($consultaemp);
mysql_close();
?>
</form>
</body>
</html>

<?
function creaconsulta($idfac_,$reg_,$fac_,$codp_,$tdoc_,$nrod_,$feci_,$tipo_,$idtco_,$diag_,$cant_,$valu_,$rcod_,$naut_){
  //echo "<br>Aqui:  ".$rcod_;
  if($rcod_=='2'){
      $consultapro="SELECT map.soat_map AS codigo FROM mapii AS map
      INNER JOIN tarco AS tar ON tar.iden_map=map.iden_map
      WHERE tar.iden_tco='$idtco_'";      
  }
  else{
      $consultapro="SELECT cups.codi_cup AS codigo,map.codi_map FROM mapii AS map
      INNER JOIN tarco AS tar ON tar.iden_map=map.iden_map
      LEFT JOIN cups ON cups.codigo=map.codi_map
      WHERE tar.iden_tco='$idtco_'";
  }
  //echo "<br>".$consultapro;
  $consultapro=mysql_query($consultapro);
  $rowpro=mysql_fetch_array($consultapro);
  $codi_map=$rowpro[codigo];

  //$codi_map=$rowpro[codi_cup];
  
  $consultacon=mysql_query("SELECT regi_fco FROM fconsulta WHERE regi_fco=$reg_");
  if(mysql_num_rows($consultacon)<>0){
      $actualiza="DELETE FROM fconsulta WHERE regi_fco=$reg_";
      mysql_query($actualiza);
  }
  for($i=1;$i<=$cant_;$i++){
      //echo "<br>".$i;
      $actualiza="INSERT INTO fconsulta(iden_fco,regi_fco,iden_fac,numf_fco,codp_fco,tpid_fco,nide_fco,fcon_fco,naut_fco,ccon_fco,fina_fco,cext_fco,dxpr_fco,dxr1_fco,dxr2_fco,dxr3_fco,tpdx_fco,valo_fco,cmod_fco,neto_fco)
      VALUES(0,$reg_,'$idfac_',$fac_,'$codp_','$tdoc_','$nrod_','$feci_','$naut_','$codi_map','10','13','$diag_','','','','1',$valu_,0,$valu_)";
      //echo "<br>".$actualiza;
      mysql_query($actualiza);      
  }
  //echo "<br>".$actualiza;
  //mysql_query($actualiza);  
  mysql_free_result($consultacon);
}

function creaproced($idfac_,$reg_,$fac_,$codp_,$tdoc_,$nrod_,$feci_,$tipo_,$idtco_,$diag_,$cant_,$valu_,$fina_,$rcod_,$naut_){
  if($rcod_=='2'){
      $consultapro="SELECT map.soat_map AS codigo FROM mapii AS map
      INNER JOIN tarco AS tar ON tar.iden_map=map.iden_map
      WHERE tar.iden_tco='$idtco_'";
      //echo "<br>".$fac_;
  }
  else{
      $consultapro="SELECT map.codi_map,cups.codi_cup AS codigo FROM mapii AS map
      INNER JOIN tarco AS tar ON tar.iden_map=map.iden_map
      INNER JOIN cups ON cups.codigo=map.codi_map
      WHERE tar.iden_tco='$idtco_'";
  }
  //echo "<br>".$consultapro;
  $consultapro=mysql_query($consultapro);
  $rowpro=mysql_fetch_array($consultapro);
  $codi_map=$rowpro[codigo];
  //$codi_map=$rowpro[codi_cup];
  //echo "<br>".$codi_map;
  $consultapro=mysql_query("SELECT regi_fpr FROM fprocedim WHERE regi_fpr=$reg_");
  if(mysql_num_rows($consultapro)<>0){
      $actualiza="DELETE FROM fprocedim WHERE regi_fpr=$reg_";
      mysql_query($actualiza);
  }
  for($i=1;$i<=$cant_;$i++){
      //echo "<br>".$i;
      $actualiza="INSERT INTO fprocedim(iden_fpr,regi_fpr,iden_fac,numf_fpr,codp_fpr,tpid_fpr,nide_fpr,fpro_fpr,naut_fpr,cpro_fpr,ambi_fpr,fina_fpr,pers_fpr,dxpr_fpr,dxre_fpr,cpli_fpr,form_fpr,valo_fpr)
      VALUES(0,$reg_,'$idfac_','$fac_','$codp_','$tdoc_','$nrod_','$feci_','$naut_','$codi_map','2','$fina_','','$diag_','','','',$valu_)";
      //echo "<br>".$actualiza;
      mysql_query($actualiza);
  }
  //echo $actualiza;
  //mysql_query($actualiza);
  mysql_free_result($consultapro);
}

function creaotros($idfac_,$reg_,$fac_,$codp_,$tdoc_,$nrod_,$tipo_,$idtco_,$cant_,$valu_,$total_,$naut_){
  $consultapro="SELECT cups.codi_cup,map.codi_map,map.desc_map FROM mapii AS map
  INNER JOIN tarco AS tar ON tar.iden_map=map.iden_map
  LEFT JOIN cups ON cups.codigo=map.codi_map
  WHERE tar.iden_tco=$idtco_";
  //echo "<br>".$consultapro;
  $consultapro=mysql_query($consultapro);  
  $rowpro=mysql_fetch_array($consultapro);
  if(mysql_num_rows($consultapro)<>0){
    //$codi_map=$rowpro[codi_map];
	  //echo "<br>".$codi_map;
    $codi_map=$rowpro[codi_cup];
    //echo "<br>".$codi_map;
    $desc_map=substr(trim($rowpro[desc_map]),0,60);
  }
  else{
    $consultapro="SELECT ins.codi_ins AS codi_map,ins.desc_ins AS desc_map FROM insu_med AS ins
    INNER JOIN tarco AS tar ON tar.iden_map=ins.codi_ins
    WHERE tar.iden_tco=$idtco_";
    //echo "<br>".$consultapro;
    $consultapro=mysql_query($consultapro);
    $rowpro=mysql_fetch_array($consultapro);
    $codi_map=$rowpro[codi_map];
    $desc_map=substr(trim($rowpro[desc_map]),0,60);
    //echo "<br>".$codi_map." ".$desc_map;
  }
  //Aqui le quito comas,comillas y enter
  $desc_map=str_replace(","," ",$desc_map);
  $desc_map=str_replace('"'," ",$desc_map);
  $desc_map=str_replace("'"," ",$desc_map);
  $desc_map=str_replace(chr(13)," ",$desc_map);
  //echo "<br>".$desc_map;
  $consultapro=mysql_query("SELECT regi_fos FROM fotros_servicios WHERE regi_fos=$reg_");
  if(mysql_num_rows($consultapro)==0){
    $actualiza="INSERT INTO fotros_servicios(regi_fos,iden_fac,numf_fos,codp_fos,tpid_fos,nide_fos,naut_fos,tpser_fos,cods_fos,noms_fos,cant_fos,vuni_fos,vtot_fos)
    VALUES($reg_,'$idfac_','$fac_','$codp_','$tdoc_','$nrod_','$naut_','$tipo_','$codi_map','$desc_map',$cant_,$valu_,$total_)";
  }
  else{
    //$actualiza="UPDATE fotros_servicios SET numf_fos='$fac_',codp_fos='$codp_',tpid_fos='$tdoc_',nide_fos='$nrod_',tpser_fos='$tipo_',cods_fos='$codi_map',noms_fos='$desc_map',cant_fos=$cant_,vuni_fos=$valu_,vtot_fos=$total_
	//WHERE regi_fos=$reg_";
	$actualiza="UPDATE fotros_servicios SET numf_fos='$fac_',codp_fos='$codp_',tpid_fos='$tdoc_',nide_fos='$nrod_',cant_fos=$cant_,vuni_fos=$valu_,vtot_fos=$total_
	WHERE regi_fos=$reg_";	
  }
  //echo "<br>".$actualiza;
  mysql_query($actualiza);
  mysql_free_result($consultapro);
}

//Funcion que crea la estancia a partir de epicrisis
function creaestan($idfac_,$reg_,$fac_,$codp_,$tdoc_,$nrod_,$ingr_,$fecing_,$fecsa_,$naut_){
  //Consulta informacion de la epicrisis  
  $consultapro="SELECT epi.sering_epi AS sering,epi.fecing_epi AS fecing,epi.horing_epi as horing,epi.estegr_epi AS estegr,
  ing.fecin_ing,ing.hora_ing,ing.fecsa_ing,ing.horsa_ing,ing.via_ing AS via,ing.cext_ing AS cext,
  evo.cod_cie10 AS dxegr,evo.fech_evo AS fechaevo,evo.hora_evo AS horaevo,evo.cama_evo AS cama,evo.dest_usu AS destino
  FROM epicrisis AS epi
  INNER JOIN hist_evo AS evo ON evo.iden_evo=epi.iden_evo
  INNER JOIN ingreso_hospitalario AS ing ON ing.id_ing=evo.id_ing
  WHERE ing.id_ing='$ingr_'";
  //echo "<br>".$consultapro;
  $consultapro=mysql_query($consultapro);
  if(mysql_num_rows($consultapro)<>0){
	$rowpro=mysql_fetch_array($consultapro);
	//$fecing_=cambiafechadmy($rowpro[fecing]);
	//$horing_=substr($rowpro[horing],0,5);
	//$fecing_=cambiafechadmy($rowpro[fecin_ing]);
	$horing_=substr($rowpro[hora_ing],0,5);
	$dxegr_=$rowpro[dxegr];
	$esteg_=$rowpro[estegr];
	//$fecsa_=cambiafechadmy($rowpro[fechaevo]);
	$horsa_=substr($rowpro[horaevo],0,5);
	//$fecsa_=cambiafechadmy($rowpro[fecsa_ing]);
	//$horsa_=substr($rowpro[horsa_ing],0,5);
	$cama_=$rowpro[cama];
	$dest_=$rowpro[destino];
	$dxmuer_='';
	if($esteg_=='2'){$dxmuer_=$dxegr_;}
	//Consulto la via de ingreso a la institucion
	$consultades=mysql_query("SELECT valo_des FROM destipos WHERE codi_des='$rowpro[via]'");
	$rowdes=mysql_fetch_array($consultades);
	$via_=$rowdes[valo_des];
	//Consulto la causa externa
	$consultades=mysql_query("SELECT valo_des FROM destipos WHERE codi_des='$rowpro[cext]'");
	$rowdes=mysql_fetch_array($consultades);
	$cext_=$rowdes[valo_des];
	//Consulto los diagnosticos
	$consultadx=mysql_query("SELECT iden_evo,cod_cie10 FROM hist_evo WHERE iden_evo=(SELECT MIN(iden_evo) FROM hist_evo WHERE id_ing=$ingr_)");
	$rowdx=mysql_fetch_array($consultadx);
	$diag_=$rowdx[cod_cie10];
	$iden_evo=$rowdx[iden_evo];
	$consultadx=mysql_query("SELECT cod_cie10 FROM diax_evo WHERE iden_evo=$iden_evo");
	$cdx=0;
	$diagr="";
	while($rowdx=mysql_fetch_array($consultadx) AND $cdx<3){
        $var='$diag_'.$cdx;
		$$var=$rowdx[cod_cie10];
		$diagr=$diagr."'".$$var."',";
		$cdx++;
	}
	//echo $cdx;
	if($cdx<3){
		for($i=$cdx;$i<=2;$i++){
			$var='$diag_'.$i;
			$$var='';
			$diagr=$diagr."'".$$var."',";
		}
	}
	//echo $diagr;
	//Consulto la ubicacion de la cama
	$consultaubi=mysql_query("SELECT val2_des FROM destipos WHERE codi_des='$cama_'");
	$rowubi=mysql_fetch_array($consultaubi);
	//Consulto el destino del paciente
	$consultadest=mysql_query("SELECT homo2_des FROM destipos WHERE codi_des='$dest_'");
	$rowdest=mysql_fetch_array($consultadest);
	$dest_=$rowdest[homo2_des];
	//evaluo si esta en urgencias '0634' para crear au o ah
	if($rowubi[val2_des]<>'0634'){
		//echo "<br>".$fac_;
		//$consultapro="SELECT regi_fho FROM fhospital WHERE regi_fho=$reg_";    
		$consultapro="SELECT regi_fho FROM fhospital WHERE numf_fho=$fac_";    
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
		}
	}
	else{
		//$consultapro=mysql_query("SELECT regi_fur FROM furgencia WHERE regi_fur=$reg_");
		$consultapro=mysql_query("SELECT regi_fur FROM furgencia WHERE numf_fur=$fac_");
		if(mysql_num_rows($consultapro)==0){
          $actualiza="INSERT INTO furgencia(regi_fur,iden_fac,numf_fur,codp_fur,tpid_fur,nide_fur,feci_fur,hori_fur,naut_fur,cext_fur,dxeg_fur,dxre1_fur,dxre2_fur,dxre3_fur,dest_fur,ests_fur,cmue_fur,fece_fur,hore_fur)
          VALUES($reg_,'$idfac_','$fac_','$codp_','$tdoc_','$nrod_','$fecing_','$horing_','$naut_','$cext_','$dxegr_',".
          $diagr."'$dest_','$esteg_','$dxmuer_','$fecsa_','$horsa_')";
		}
		else{
			$actualiza="UPDATE furgencia SET numf_fur='$fac_',codp_fur='$codp_',tpid_fur='$tdoc_',nide_fur='$nrod_'
            WHERE regi_fur=$reg_";
		}
	}  
	//echo "<br><br>".$actualiza;
	mysql_query($actualiza);
	mysql_free_result($consultades);
	mysql_free_result($consultadx);
	mysql_free_result($consultaubi);
	mysql_free_result($consultadest);	
  }
  mysql_free_result($consultapro);
}

//Funcion que crea la estancia a partir de epicrisis2
function creaestan2($idfac_,$reg_,$fac_,$codp_,$tdoc_,$nrod_,$ingr_,$fecing_,$fecsa_,$naut_){
  /*
  Convenciones para estaalta
  ME=mejor
  AV=alta voluntaria
  MA=muerto antes de 48h
  IP=igual o peor 
  FU=fuga 
  MD=muerte despues de 48h
  */
  //factuta 480456  
  //Consulta informacion de la epicrisis2
  $consultapro="SELECT ingreso_hospitalario.id_ing, ingreso_hospitalario.arerem_ing, ingreso_hospitalario.fecin_ing, ingreso_hospitalario.hora_ing, epicrisis2.estaalta_epiegreso AS estegr, ingreso_hospitalario.fecsa_ing, ingreso_hospitalario.horsa_ing, ingreso_hospitalario.via_ing AS via, ingreso_hospitalario.cext_ing AS cext, hist_evo.cod_cie10 AS dxegr, hist_evo.fech_evo, hist_evo.hora_evo AS horaevo, hist_evo.cama_evo AS cama, hist_evo.dest_usu AS destino
  FROM (epicrisis2 INNER JOIN hist_evo ON epicrisis2.iden_evo = hist_evo.iden_evo) INNER JOIN ingreso_hospitalario ON epicrisis2.id_ing = ingreso_hospitalario.id_ing
  WHERE (((ingreso_hospitalario.id_ing)='$ingr_'))";
  //echo "<br>Epicrisis 2: ".$consultapro;

  $consultapro=mysql_query($consultapro);
  if(mysql_num_rows($consultapro)<>0){
    $rowpro=mysql_fetch_array($consultapro);
    $horing_=substr($rowpro[hora_ing],0,5);    
    $dxegr_=$rowpro[dxegr];
    $esteg_=$rowpro[estegr];      
    $horsa_=substr($rowpro[horaevo],0,5);
    $cama_=$rowpro[cama];
    $dest_=$rowpro[destino];
    $dxmuer_='';
    if($esteg_=='MA' or $esteg_=='MD'){
      $dxmuer_=$dxegr_;
      $esteg_='2';
    }
    else{$esteg_='1';}
    //Consulto la via de ingreso a la institucion
    $consultades="SELECT valo_des FROM destipos WHERE codi_des='$rowpro[via]'";
    //echo "<br>".$consultades;
    $consultades=mysql_query($consultades);
    $rowdes=mysql_fetch_array($consultades);
    $via_=$rowdes[valo_des];        
    //Consulto la causa externa
    $consultades="SELECT valo_des FROM destipos WHERE codi_des='$rowpro[cext]'";    
    $consultades=mysql_query($consultades);
    $rowdes=mysql_fetch_array($consultades);
    $cext_=$rowdes[valo_des];
    //Consulto los diagnosticos
    $consultadx="SELECT iden_evo,cod_cie10 FROM hist_evo WHERE iden_evo=(SELECT MIN(iden_evo) FROM hist_evo WHERE id_ing='$ingr_')";    
    $consultadx=mysql_query($consultadx);
    $rowdx=mysql_fetch_array($consultadx);
    $diag_=$rowdx[cod_cie10];
    $iden_evo=$rowdx[iden_evo];
    $consultadx="SELECT cod_cie10 FROM diax_evo WHERE iden_evo='$iden_evo'";
    $consultadx=mysql_query($consultadx);
    $cdx=0;
    $diagr="";
    while($rowdx=mysql_fetch_array($consultadx) AND $cdx<3){
      $var='$diag_'.$cdx;
      $$var=$rowdx[cod_cie10];
      $diagr=$diagr."'".$$var."',";
      $cdx++;
    }    
    if($cdx<3){
      for($i=$cdx;$i<=2;$i++){
        $var='$diag_'.$i;
        $$var='';
        $diagr=$diagr."'".$$var."',";
      }
    }
    //Consulto la ubicacion de la cama
    $consultaubi="SELECT val2_des FROM destipos WHERE codi_des='$cama_'";    
    $consultaubi=mysql_query($consultaubi);
    $rowubi=mysql_fetch_array($consultaubi);
    //Consulto el destino del paciente
    $consultadest="SELECT homo2_des FROM destipos WHERE codi_des='$dest_'";
    $consultadest=mysql_query($consultadest);
    $rowdest=mysql_fetch_array($consultadest);
    $dest_=$rowdest[homo2_des];
    //evaluo si esta en urgencias '0634' para crear au o ah
    if($rowubi[val2_des]<>'0634'){
      $consultapro="SELECT regi_fho FROM fhospital WHERE numf_fho='$fac_'";    
      //echo "<br>".$consultapro;
      $consultapro=mysql_query($consultapro);
      if(mysql_num_rows($consultapro)==0){        
        $actualiza="INSERT INTO fhospital(regi_fho,iden_fac,numf_fho,codp_fho,tpid_fho,nide_fho,via_fho,feci_fho,hori_fho,naut_fho,cext_fho,dxin_fho,dxeg_fho,dxre1_fho,dxre2_fho,dxre3_fho,comp_fho,ests_fho,cmue_fho,fece_fho,hore_fho)
        VALUES($reg_,'$idfac_','$fac_','$codp_','$tdoc_','$nrod_','$via_','$fecing_','$horing_','$naut_','$cext_','$diag_','$dxegr_',".
        $diagr."'','$esteg_','$dxmuer_','$fecsa_','$horsa_')";        
      }
      else{
        $actualiza="UPDATE fhospital SET tpid_fho='$tdoc_',nide_fho='$nrod_'
        WHERE regi_fho=$reg_";
      }
    }
    else{      
      $consultapro=mysql_query("SELECT regi_fur FROM furgencia WHERE numf_fur='$fac_'");
      if(mysql_num_rows($consultapro)==0){
          $actualiza="INSERT INTO furgencia(regi_fur,iden_fac,numf_fur,codp_fur,tpid_fur,nide_fur,feci_fur,hori_fur,naut_fur,cext_fur,dxeg_fur,dxre1_fur,dxre2_fur,dxre3_fur,dest_fur,ests_fur,cmue_fur,fece_fur,hore_fur)
          VALUES($reg_,'$idfac_','$fac_','$codp_','$tdoc_','$nrod_','$fecing_','$horing_','$naut_','$cext_','$dxegr_',".
          $diagr."'$dest_','$esteg_','$dxmuer_','$fecsa_','$horsa_')";
      }
      else{
        $actualiza="UPDATE furgencia SET numf_fur='$fac_',codp_fur='$codp_',tpid_fur='$tdoc_',nide_fur='$nrod_'
            WHERE regi_fur=$reg_";
      }
    }  
  mysql_query($actualiza);
  mysql_free_result($consultades);
  mysql_free_result($consultadx);
  mysql_free_result($consultaubi);
  mysql_free_result($consultadest);
  }
  mysql_free_result($consultapro);
}


function creamedicamentos($idfac_,$reg_,$fac_,$codp_,$tdoc_,$nrod_,$tipo_,$idtco_,$cant_,$valu_,$total_,$naut_){  
  $consultamed="SELECT CONCAT(med.coan_mdi,med.copa_mdi,med.coff_mdi,med.coco_mdi) AS codigo,med.cum_med
  ,med.nomb_mdi AS nombre,med.coca_mdi AS concen,coum_mdi AS unidad,
  fma.desc_ffa AS forma  
  FROM medicamentos2 AS med
  INNER JOIN tarco AS tar ON tar.iden_map=med.codi_mdi
  LEFT JOIN forma_farmaceutica AS fma ON fma.codi_ffa=med.coff_mdi
  WHERE tar.iden_tco='$idtco_'";
  //echo "<br>".$consultamed;
  $consultamed=mysql_query($consultamed);  
  $rowmed=mysql_fetch_array($consultamed);
  //$codi_=$rowmed[codigo];
  $codi_=$rowmed[cum_med];
  //echo "<br>".$codi_;
  $desc_=substr(trim($rowmed[nombre]),0,30);
  $form_=substr($rowmed[forma],0,20);
  $conc_=$rowmed[concen];
  
  $desc_=str_replace(","," ",$desc_);
  $desc_=str_replace('"'," ",$desc_);
  $desc_=str_replace("'"," ",$desc_);
  $desc_=str_replace(chr(13)," ",$desc_);  
  $form_=str_replace(","," ",$form_);
  $form_=str_replace('"'," ",$form_);
  $form_=str_replace("'"," ",$form_);
  $form_=str_replace(chr(13)," ",$form_);
  $conc_=str_replace(","," ",$conc_);
  $conc_=str_replace('"'," ",$conc_);
  $conc_=str_replace("'"," ",$conc_);
  $conc_=str_replace(chr(13)," ",$conc_);
  
  $unid_=$rowmed[unidad];
  $consultapro=mysql_query("SELECT regi_fme FROM fmedicamento WHERE regi_fme=$reg_");
  if(mysql_num_rows($consultapro)==0){
    $actualiza="INSERT INTO fmedicamento(regi_fme,iden_fac,numf_fme,codp_fme,tpid_fme,nide_fme,naut_fme,codi_fme,tipo_fme,nomb_fme,form_fme,conc_fme,unid_fme,cant_fme,vuni_fme,vtot_fme)
    VALUES($reg_,'$idfac_','$fac_','$codp_','$tdoc_','$nrod_','$naut_','$codi_','$tipo_','$desc_','$form_','$conc_','$unid_',$cant_,$valu_,$total_)";
  }
  else{
    //$actualiza="UPDATE fmedicamento SET numf_fme='$fac_',codp_fme='$codp_',tpid_fme='$tdoc_',nide_fme='$nrod_',codi_fme='$codi_',tipo_fme='$tipo_',nomb_fme='$desc_',form_fme='$form_',conc_fme='$conc_',unid_fme='$unid_',cant_fme=$cant_,vuni_fme=$valu_,vtot_fme=$total_
	//WHERE regi_fme=$reg_";
	$actualiza="UPDATE fmedicamento SET numf_fme='$fac_',codp_fme='$codp_',tpid_fme='$tdoc_',nide_fme='$nrod_',cant_fme=$cant_,vuni_fme=$valu_,vtot_fme=$total_
	WHERE regi_fme=$reg_";
  }
  //echo "<br><br>".$actualiza;
  mysql_query($actualiza);
  mysql_free_result($consultamed);
  mysql_free_result($consultapro);
}

function creamedicamentos2($idfac_,$reg_,$fac_,$codp_,$tdoc_,$nrod_,$tipo_,$idtco_,$cant_,$valu_,$total_,$naut_){
  $consultamed="SELECT CONCAT(med.coan_mdi,med.copa_mdi,med.coff_mdi,med.coco_mdi) AS codigo,med.cum_med
  ,med.nomb_mdi AS nombre,med.coca_mdi AS concen,med.coum_mdi AS unidad,fma.desc_ffa AS forma   
  FROM tarco AS tar
  INNER JOIN medicamentos2 AS med ON med.codi_mdi=tar.iden_map
  LEFT JOIN forma_farmaceutica AS fma ON fma.codi_ffa=med.coff_mdi 
  WHERE tar.iden_tco='$idtco_'";
  //echo "<br>".$consultamed;
  $consultamed=mysql_query($consultamed);
  $rowmed=mysql_fetch_array($consultamed);
  //$codi_=$rowmed[codigo];
  $codi_=$rowmed[cum_med];
  //echo "<br>".$codi_;
  $desc_=substr(trim($rowmed[nombre]),0,30);
  $form_=substr($rowmed[forma],0,20);
  $conc_=$rowmed[concen];
  $unid_=$rowmed[unidad];
  
  //Aqui elimino comas, comillas y enter
  $desc_=str_replace(","," ",$desc_);
  $desc_=str_replace('"'," ",$desc_);
  $desc_=str_replace("'"," ",$desc_);
  $desc_=str_replace(chr(13)," ",$desc_);  
  $form_=str_replace(","," ",$form_);
  $form_=str_replace('"'," ",$form_);
  $form_=str_replace("'"," ",$form_);
  $form_=str_replace(chr(13)," ",$form_);
  $conc_=str_replace(","," ",$conc_);
  $conc_=str_replace('"'," ",$conc_);
  $conc_=str_replace("'"," ",$conc_);
  $conc_=str_replace(chr(13)," ",$conc_);
  //echo "<br>".$tipo_." ".$desc_;
  $consultapro=mysql_query("SELECT regi_fme FROM fmedicamento WHERE regi_fme=$reg_");  
  if(mysql_num_rows($consultapro)==0){
    $actualiza="INSERT INTO fmedicamento(regi_fme,iden_fac,numf_fme,codp_fme,tpid_fme,nide_fme,naut_fme,codi_fme,tipo_fme,nomb_fme,form_fme,conc_fme,unid_fme,cant_fme,vuni_fme,vtot_fme)
    VALUES($reg_,'$idfac_','$fac_','$codp_','$tdoc_','$nrod_','$naut_','$codi_','$tipo_','$desc_','$form_','$conc_','$unid_',$cant_,$valu_,$total_)";
  }
  else{
	$actualiza="UPDATE fmedicamento SET numf_fme='$fac_',codp_fme='$codp_',tpid_fme='$tdoc_',nide_fme='$nrod_',cant_fme=$cant_,vuni_fme=$valu_,vtot_fme=$total_
	WHERE regi_fme=$reg_";
  }
  //echo "<br><br>".$actualiza;
  mysql_query($actualiza);
  mysql_free_result($consultamed);
  mysql_free_result($consultapro);
}
?>
