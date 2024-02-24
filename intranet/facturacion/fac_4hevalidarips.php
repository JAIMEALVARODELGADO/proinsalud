<html>
<head>
<title>PROGRAMA DE FACTURACIN</title>
<link rel="stylesheet" href="css/style.css" type="text/css" />
<script language='JavaScript'>
function validar(){
    error="";
    //if(document.form1.fecha_ini.value==''){error+='Fecha inicial\n'}
    //if(document.form1.fecha_fin.value==''){error+='Fecha final\n'}
    if(error!=''){
        alert("Para continuar debe completar la siguiente informacin:\n"+error);
        return(false);
    }
    document.form1.submit();
}
</script>
</head>
<body>
<form name='form1' method="POST" action='fac_4creaplanos.php' target='fr02'>
<table class="Tbl0"><tr><td class="Td0" align='center'>Validacin de R I P S</td></tr></table>
<?
set_time_limit(0);
include('php/conexion.php');
include('php/funciones.php');
$error=0;
$condicion="";
if(!empty($factura)){
  $condicion=$condicion."ef.nume_fac='$factura' AND ";}
if(!empty($relacion)){
  $condicion=$condicion."ef.rela_fac='$relacion' AND ";}
if(!empty($pref_fac)){
  $condicion=$condicion."ef.pref_fac='$pref_fac' AND ";}
if(!empty($condicion)){$condicion=substr($condicion,0,strlen($condicion)-5);}

echo "<table class='Tbl0' border='0'>";
echo "<th class='Th0' width='5%'>Sel</th>
      <th class='Th0' width='10%'>Concepto</th>
      <th class='Th0' width='10%'>Factura</th>
      <th class='Th0' width='60%'>Error</th>
      <th class='Th0' width='20%'>Valor</th>";
$consulta="SELECT ef.iden_fac,ef.nume_fac,ef.fcie_fac,ef.vtot_fac,ef.pcop_fac,ef.vcop_fac,ef.pdes_fac,ef.vnet_fac,ef.cmod_fac
FROM encabezado_factura AS ef
WHERE $condicion ORDER BY ef.nume_fac";
//ECHO $consulta;
$consulta=mysql_query($consulta);
//Aqui valido la fecha de las facturas
if(mysql_num_rows($consulta)!=0){
  while($row=mysql_fetch_array($consulta)){
    $hoy=date("Y-m-d");
	$fcie_fac=$row[fcie_fac];        
	if(strtotime($fcie_fac)>strtotime($hoy)){
	  if($color<>'#dddddd'){$color='#dddddd';}else{$color='';}
	  muetraerror($color,'AF',$row[iden_fac],$row[nume_fac],'Fecha de cierre mayor a la fecha actual',cambiafechadmy($row[fcie_fac]));	  
	  $error++;
	}
	$totdet=0;
    $valpde=round($row[vtot_fac]*($row[pdes_fac]/100),0);
	//$valorfac=$row[vnet_fac]+$valpde+$row[vcop_fac]+$row[cmod_fac];
    $valorfac=$row[vtot_fac];
    $vnet_fac=$row[vnet_fac]+$valpde+$row[vcop_fac]+$row[cmod_fac];
	//Aqui consulto el valor de las consultas
	//$consulta2="SELECT SUM(neto_fco) AS total FROM fconsulta WHERE numf_fco='$row[nume_fac]'";
	$consulta2="SELECT SUM(neto_fco) AS total FROM fconsulta WHERE iden_fac='$row[iden_fac]'";
    //echo "<br>".$consulta2;
    $consulta2=mysql_query($consulta2);
	$row2=mysql_fetch_array($consulta2);
	$totdet=$totdet+$row2[total];
	//Aqui consulto el valor de los procedimientos
	//$consulta2="SELECT SUM(valo_fpr) AS total FROM fprocedim WHERE numf_fpr='$row[nume_fac]'";
	$consulta2="SELECT SUM(valo_fpr) AS total FROM fprocedim WHERE iden_fac='$row[iden_fac]'";
    //echo "<br>".$consulta2;
    $consulta2=mysql_query($consulta2);
	$row2=mysql_fetch_array($consulta2);
	$totdet=$totdet+$row2[total];
	//Aqui consulto el valor de los medicamentos
	//$consulta2="SELECT SUM(vtot_fme) AS total FROM fmedicamento WHERE numf_fme='$row[nume_fac]'";
	$consulta2="SELECT SUM(vtot_fme) AS total FROM fmedicamento WHERE iden_fac='$row[iden_fac]'";
    //echo "<br>".$consulta2;
    $consulta2=mysql_query($consulta2);
	$row2=mysql_fetch_array($consulta2);
	$totdet=$totdet+$row2[total];
	//Aqui consulto el valor de los insumos
	//$consulta2="SELECT SUM(vtot_fos) AS total FROM fotros_servicios WHERE numf_fos='$row[nume_fac]'";
	$consulta2="SELECT SUM(vtot_fos) AS total FROM fotros_servicios WHERE iden_fac='$row[iden_fac]'";
    //echo "<br>".$consulta2;
    $consulta2=mysql_query($consulta2);
	$row2=mysql_fetch_array($consulta2);
	$totdet=$totdet+$row2[total];
    //echo "<br>".$row[nume_fac]." ".$valorfac." ".$totdet;
    //echo "<br>".$vnet_fac." ".$totdet;
	if($vnet_fac<>$totdet){
	  if($color<>'#dddddd'){$color='#dddddd';}else{$color='';}
	  muetraerror($color,'AF',$row[iden_fac],$row[nume_fac],'El valor de los detalle no coincide con el total de la factura',$totdet);	  
	  $error++;
	}
	//echo "<br>".$consulta2;
	mysql_free_result($consulta2);
  }
}
//Aqui valido los usuarios
$consulta="SELECT us.tdoc_usu,us.nrod_usu,us.regi_usu,us.pape_usu,us.sape_usu,us.pnom_usu,us.snom_usu,us.fnac_usu,us.sexo_usu,us.mate_usu,us.zona_usu,
con.ceps_con
FROM usuario AS us 
INNER JOIN encabezado_factura AS ef ON ef.codi_usu=us.codi_usu
INNER JOIN contratacion AS ccion ON ccion.iden_ctr=ef.iden_ctr
INNER JOIN contrato AS con ON con.codi_con=ccion.codi_con
WHERE $condicion GROUP BY us.nrod_usu";
//echo "<br>".$consulta;
$consulta=mysql_query($consulta);
if(mysql_num_rows($consulta)!=0){
  while($row=mysql_fetch_array($consulta)){
	if($row[regi_usu]==''){
	  if($color<>'#dddddd'){$color='#dddddd';}else{$color='';}
	  muetraerror($color,'US',$row[nrod_usu],'',$row[nrod_usu].' Tipo de usuario (Regimen), no debe estar vacio',$row[regi_usu]);	  
	  $error++;
	}
	if($row[pape_usu]==''){
	  if($color<>'#dddddd'){$color='#dddddd';}else{$color='';}
	  muetraerror($color,'US',$row[nrod_usu],'',$row[nrod_usu].' Primer apellido del usuario, no debe estar vacio',$row[pape_usu]);	  
	  $error++;
	}
	if($row[pnom_usu]==''){
	  if($color<>'#dddddd'){$color='#dddddd';}else{$color='';}
	  muetraerror($color,'US',$row[nrod_usu],'',$row[nrod_usu].' Primer nombre del usuario, no debe estar vacio',$row[pnom_usu]);	  
	  $error++;
	}
	if($row[sexo_usu]<>'F' and $row[sexo_usu]<>'M'){
	  if($color<>'#dddddd'){$color='#dddddd';}else{$color='';}
	  muetraerror($color,'US',$row[nrod_usu],'',$row[nrod_usu].' Verifique el sexo del usuario',$row[sexo_usu]);  
	  $error++;
	}
  }
}

//Aqui valido las consultas
/*$consulta="SELECT cons.fcon_fco,cons.fina_fco,cons.cext_fco,cons.dxpr_fco,cons.dxr1_fco,cons.dxr2_fco,cons.dxr3_fco,cons.tpdx_fco,
ef.iden_fac,ef.nume_fac
FROM fconsulta AS cons
INNER JOIN encabezado_factura AS ef ON ef.nume_fac=cons.numf_fco
WHERE $condicion";*/
$consulta="SELECT cons.fcon_fco,cons.fina_fco,cons.cext_fco,cons.dxpr_fco,cons.dxr1_fco,cons.dxr2_fco,cons.dxr3_fco,cons.tpdx_fco,
ef.iden_fac,ef.nume_fac
FROM fconsulta AS cons
INNER JOIN encabezado_factura AS ef ON ef.iden_fac=cons.iden_fac
WHERE $condicion";
//echo "<br>".$consulta;
$consulta=mysql_query($consulta);
if(mysql_num_rows($consulta)!=0){
  while($row=mysql_fetch_array($consulta)){
    $hoy=date("Y-m-d");
	$fcon_fco=cambiafecha($row[fcon_fco]);
    if(strtotime($fcon_fco)>strtotime($hoy)){
	  if($color<>'#dddddd'){$color='#dddddd';}else{$color='';}
	  muetraerror($color,'AC',$row[iden_fac],$row[nume_fac],'Fecha de la consulta mayor a la fecha actual',$row[fcon_fco]);
	  $error++;
	}
	//Aqui valido Finalidad
	if($row[fina_fco]<'01' or $row[fina_fco]>'10'){
	  if($color<>'#dddddd'){$color='#dddddd';}else{$color='';}
	  muetraerror($color,'AC',$row[iden_fac],$row[nume_fac],'Finalidad no valida',$row[fina_fco]);
	  $error++;
	}
	//Aqui valido Causa externa
	if($row[cext_fco]<'01' or $row[cext_fco]>'15'){
	  if($color<>'#dddddd'){$color='#dddddd';}else{$color='';}
	  muetraerror($color,'AC',$row[iden_fac],$row[nume_fac],'Causa externa no valida',$row[cext_fco]);
	  $error++;
	}
	//Aqui valido Dx
	$consulta2=mysql_query("SELECT cod_cie10 FROM cie_10 WHERE cod_cie10='$row[dxpr_fco]'");
	if(mysql_num_rows($consulta2)==0){
	  if($color<>'#dddddd'){$color='#dddddd';}else{$color='';}
	  muetraerror($color,'AC',$row[iden_fac],$row[nume_fac],'Dx principal no encontrado',$row[dxpr_fco]);
	  $error++;
	}
	//Aqui valido Dx relacionado 1
	if($row[dxr1_fco]!=''){
	  $consulta2=mysql_query("SELECT cod_cie10 FROM cie_10 WHERE cod_cie10='$row[dxr1_fco]'");
	  if(mysql_num_rows($consulta2)==0){
	    if($color<>'#dddddd'){$color='#dddddd';}else{$color='';}
		muetraerror($color,'AC',$row[iden_fac],$row[nume_fac],'Dx Relacionado 1',$row[dxr1_fco]);
        $error++;
	  }
	}
	//Aqui valido Dx relacionado 2
	if($row[dxr2_fco]!=''){
	  $consulta2=mysql_query("SELECT cod_cie10 FROM cie_10 WHERE cod_cie10='$row[dxr2_fco]'");
	  if(mysql_num_rows($consulta2)==0){
	    if($color<>'#dddddd'){$color='#dddddd';}else{$color='';}
		muetraerror($color,'AC',$row[iden_fac],$row[nume_fac],'Dx Relacionado 2',$row[dxr2_fco]);
	    $error++;
	  }
	}
	//Aqui valido Dx relacionado 3
	if($row[dxr3_fco]!=''){
	  $consulta2=mysql_query("SELECT cod_cie10 FROM cie_10 WHERE cod_cie10='$row[dxr3_fco]'");
	  if(mysql_num_rows($consulta2)==0){
	    if($color<>'#dddddd'){$color='#dddddd';}else{$color='';}
		muetraerror($color,'AC',$row[iden_fac],$row[nume_fac],'Dx Relacionado 3',$row[dxr3_fco]);
        $error++;
	  }
	}
	//Aqui valido el tipo de Dx principal
	if($row[tpdx_fco]<'1' or $row[tpdx_fco]>'3'){
	  if($color<>'#dddddd'){$color='#dddddd';}else{$color='';}
	  muetraerror($color,'AC',$row[iden_fac],$row[nume_fac],'Tipo de diagnostico principal',$row[tpdx_fco]);
	  $error++;
	}
	mysql_free_result($consulta2);
  }
}
//Aqui valido procedimientos
/*$consulta="SELECT pro.fpro_fpr,pro.ambi_fpr,pro.fina_fpr,pro.cpro_fpr,pro.dxpr_fpr,pro.dxre_fpr,pro.cpli_fpr,pro.form_fpr,
ef.iden_fac,ef.nume_fac
FROM fprocedim AS pro
INNER JOIN encabezado_factura AS ef ON ef.nume_fac=pro.numf_fpr
WHERE $condicion";*/
$consulta="SELECT pro.fpro_fpr,pro.ambi_fpr,pro.fina_fpr,pro.cpro_fpr,pro.dxpr_fpr,pro.dxre_fpr,pro.cpli_fpr,pro.form_fpr,
ef.iden_fac,ef.nume_fac
FROM fprocedim AS pro
INNER JOIN encabezado_factura AS ef ON ef.iden_fac=pro.iden_fac
WHERE $condicion";
//echo "<br>".$consulta;
$consulta=mysql_query($consulta);
if(mysql_num_rows($consulta)!=0){
  while($row=mysql_fetch_array($consulta)){
    $hoy=date("Y-m-d");
	$fpro_fpr=cambiafecha($row[fpro_fpr]);
        if(strtotime($fpro_fpr)>strtotime($hoy)){
	  if($color<>'#dddddd'){$color='#dddddd';}else{$color='';}
	  muetraerror($color,'AP',$row[iden_fac],$row[nume_fac],'Fecha del procedimiento mayor a la fecha actual',$row[fpro_fpr]);
	  $error++;
	}
	//Aqui valido el ambito
	if($row[ambi_fpr]<'1' or $row[ambi_fpr]>'3'){
	  if($color<>'#dddddd'){$color='#dddddd';}else{$color='';}
	  muetraerror($color,'AP',$row[iden_fac],$row[nume_fac],'Ambito',$row[ambi_fpr]);
	  $error++;
	}
	//Aqui valido la finalidad del procedimiento
	if($row[fina_fpr]<'1' or $row[fina_fpr]>'5'){
	  if($color<>'#dddddd'){$color='#dddddd';}else{$color='';}
	  muetraerror($color,'AP',$row[iden_fac],$row[nume_fac],'Finalidad',$row[fina_fpr]);
	  $error++;
	}
	//Aqui valido Dx
	$consulta2=mysql_query("SELECT cod_cie10 FROM cie_10 WHERE cod_cie10='$row[dxpr_fpr]'");
	if(mysql_num_rows($consulta2)==0){
	  if($color<>'#dddddd'){$color='#dddddd';}else{$color='';}
	  muetraerror($color,'AP',$row[iden_fac],$row[nume_fac],'Dx principal no encontrado',$row[dxpr_fpr]);
	  $error++;
	}
	//Aqui valido Dx relacionado 
	if($row[dxre_fpr]!=''){
	  $consulta2=mysql_query("SELECT cod_cie10 FROM cie_10 WHERE cod_cie10='$row[dxre_fpr]'");
	  if(mysql_num_rows($consulta2)==0){
	    if($color<>'#dddddd'){$color='#dddddd';}else{$color='';}
		muetraerror($color,'AP',$row[iden_fac],$row[nume_fac],'Dx Relacionado',$row[dxre_fpr]);
		$error++;
	  }
	}
	//Aqui valido la complicacin
	if($row[cpli_fpr]!=''){
	  $consulta2=mysql_query("SELECT cod_cie10 FROM cie_10 WHERE cod_cie10='$row[cpli_fpr]'");
	  if(mysql_num_rows($consulta2)==0){
	    if($color<>'#dddddd'){$color='#dddddd';}else{$color='';}
		muetraerror($color,'AP',$row[iden_fac],$row[nume_fac],'Complicacin',$row[cpli_fpr]);
                $error++;
	  }
	}
        mysql_free_result($consulta2);
        //Aqui valido la forma de realizacion del acto qx
        //echo "<br>".$row[form.fpr]." - ".$row[cpro_fpr];
        //1811
        $consulta2="SELECT clas_map FROM mapii WHERE codi_map='$row[cpro_fpr]' ";
        $consulta2=mysql_query($consulta2);
        if(mysql_num_rows($consulta2)<>0){
            $row2=mysql_fetch_array($consulta2);            
            if($row2[clas_map]=="1801" AND empty($row[form_fpr])){
                if($color<>'#dddddd'){$color='#dddddd';}else{$color='';}
		muetraerror($color,'AP',$row[iden_fac],$row[nume_fac],'Forma de realizacion del acto qx '.$row[cpro_fpr],$row[cpli_fpr]);
                $error++;
            }
        }
  }
}
//Aqui valido la estancia en hospitalizacin
/*$consulta="SELECT hos.via_fho,hos.feci_fho,hos.fece_fho,hos.hori_fho,hos.hore_fho,hos.cext_fho,hos.dxin_fho,hos.dxeg_fho,hos.dxre1_fho,hos.dxre2_fho,hos.dxre3_fho,hos.comp_fho,hos.ests_fho,hos.cmue_fho,
ef.iden_fac,ef.nume_fac
FROM fhospital AS hos
INNER JOIN encabezado_factura AS ef ON ef.nume_fac=hos.numf_fho
WHERE $condicion";*/
$consulta="SELECT hos.via_fho,hos.feci_fho,hos.fece_fho,hos.hori_fho,hos.hore_fho,hos.cext_fho,hos.dxin_fho,hos.dxeg_fho,hos.dxre1_fho,hos.dxre2_fho,hos.dxre3_fho,hos.comp_fho,hos.ests_fho,hos.cmue_fho,
ef.iden_fac,ef.nume_fac
FROM fhospital AS hos
INNER JOIN encabezado_factura AS ef ON ef.iden_fac=hos.iden_fac
WHERE $condicion";
//echo "<br>".$consulta;
$consulta=mysql_query($consulta);
if(mysql_num_rows($consulta)!=0){
  while($row=mysql_fetch_array($consulta)){
    $hoy=date("Y-m-d");
	$feci_fho=cambiafecha($row[feci_fho]);
    if(strtotime($feci_fho)>strtotime($hoy)){
	  if($color<>'#dddddd'){$color='#dddddd';}else{$color='';}
	  muetraerror($color,'AH',$row[iden_fac],$row[nume_fac],'Fecha de ingreso mayor a la actual',$row[feci_fho]);
	  $error++;
	}
	$fece_fho=cambiafecha($row[fece_fho]);
    if(strtotime(fece_fho)>strtotime($hoy)){
	  if($color<>'#dddddd'){$color='#dddddd';}else{$color='';}
	  muetraerror($color,'AH',$row[iden_fac],$row[nume_fac],'Fecha de egreso mayor a la actual',$row[fece_fho]);
	  $error++;
	}
	if(strtotime($feci_fho)>strtotime($fece_fho)){
	  if($color<>'#dddddd'){$color='#dddddd';}else{$color='';}
	  $val=$row[feci_fho]." - ".$row[fece_fho];
	  muetraerror($color,'AH',$row[iden_fac],$row[nume_fac],'Fecha de ingreso mayor a la fecha de egreso',$val);
	  $error++;
	}
	//Aqui valido la via de ingreso
	if($row[via_fho]<'1' or $row[via_fho]>'4'){
	  if($color<>'#dddddd'){$color='#dddddd';}else{$color='';}
	  muetraerror($color,'AH',$row[iden_fac],$row[nume_fac],'Via de ingreso',$row[via_fho]);
	  $error++;
	}
	//Aqui valido la hora de ingreso y salida
	if(strlen(trim($row[hori_fho]))<5 or strlen(trim($row[hore_fho]))<5){
	  if($color<>'#dddddd'){$color='#dddddd';}else{$color='';}
	  $val=$row[hori_fho].' - '.$row[hore_fho];
	  muetraerror($color,'AH',$row[iden_fac],$row[nume_fac],'La hora de ingreso o egreso esta errada',$val);
	  $error++;
	}
	//Aqui valido la causa externa
	if($row[cext_fho]<'01' or $row[cext_fho]>'15'){
	  if($color<>'#dddddd'){$color='#dddddd';}else{$color='';}
	  muetraerror($color,'AH',$row[iden_fac],$row[nume_fac],'Causa externa',$row[cext_fho]);
	  $error++;
	}
	//Aqui valido Dx de ingreso
	$consulta2=mysql_query("SELECT cod_cie10 FROM cie_10 WHERE cod_cie10='$row[dxin_fho]'");
	if(mysql_num_rows($consulta2)==0){
	  if($color<>'#dddddd'){$color='#dddddd';}else{$color='';}
	  muetraerror($color,'AH',$row[iden_fac],$row[nume_fac],'Diagnostico de ingreso',$row[dxin_fho]);
	  $error++;
	}
	//Aqui valido Dx de salida
	$consulta2=mysql_query("SELECT cod_cie10 FROM cie_10 WHERE cod_cie10='$row[dxeg_fho]'");
	if(mysql_num_rows($consulta2)==0){
	  if($color<>'#dddddd'){$color='#dddddd';}else{$color='';}
	  muetraerror($color,'AH',$row[iden_fac],$row[nume_fac],'Diagnostico de egreso',$row[dxeg_fho]);
	  $error++;
	}
	//Aqui valido Dx relacionado 1
	if($row[dxre1_fho]!=''){
	  $consulta2=mysql_query("SELECT cod_cie10 FROM cie_10 WHERE cod_cie10='$row[dxre1_fho]'");
	  if(mysql_num_rows($consulta2)==0){
	    if($color<>'#dddddd'){$color='#dddddd';}else{$color='';}
		muetraerror($color,'AH',$row[iden_fac],$row[nume_fac],'Dx Relacionado 1',$row[dxre1_fho]);
        $error++;
	  }
	}
	//Aqui valido Dx relacionado 2
	if($row[dxre2_fho]!=''){
	  $consulta2=mysql_query("SELECT cod_cie10 FROM cie_10 WHERE cod_cie10='$row[dxre2_fho]'");
	  if(mysql_num_rows($consulta2)==0){
	    if($color<>'#dddddd'){$color='#dddddd';}else{$color='';}
		  muetraerror($color,'AH',$row[iden_fac],$row[nume_fac],'Dx Relacionado 2',$row[dxre2_fho]);
	      $error++;
	    }
	}
	//Aqui valido Dx relacionado 3
	if($row[dxre3_fho]!=''){
	  $consulta2=mysql_query("SELECT cod_cie10 FROM cie_10 WHERE cod_cie10='$row[dxre3_fho]'");
	  if(mysql_num_rows($consulta2)==0){
	    if($color<>'#dddddd'){$color='#dddddd';}else{$color='';}
		muetraerror($color,'AH',$row[iden_fac],$row[nume_fac],'Dx Relacionado 3',$row[dxre3_fho]);
        $error++;
	  }
	}
	//Aqui valido la complicacion
	if($row[comp_fho]!=''){
	  $consulta2=mysql_query("SELECT cod_cie10 FROM cie_10 WHERE cod_cie10='$row[comp_fho]'");
	  if(mysql_num_rows($consulta2)==0){
	    if($color<>'#dddddd'){$color='#dddddd';}else{$color='';}
		muetraerror($color,'AH',$row[iden_fac],$row[nume_fac],'Complicacin',$row[comp_fho]);
        $error++;
	  }
	}
	if($row[ests_fho]<'1' or $row[ests_fho]>'2'){
	  if($color<>'#dddddd'){$color='#dddddd';}else{$color='';}
	  muetraerror($color,'AH',$row[iden_fac],$row[nume_fac],'Estado a la salida del paciente',$row[ests_fho]);
	  $error++;
	}
	if($row[ests_fho]=='2'){
	  $consulta2=mysql_query("SELECT cod_cie10 FROM cie_10 WHERE cod_cie10='$row[cmue_fho]'");
	  if(mysql_num_rows($consulta2)==0){
	    if($color<>'#dddddd'){$color='#dddddd';}else{$color='';}
		muetraerror($color,'AH',$row[iden_fac],$row[nume_fac],'Causa de muerte',$row[cmue_fho]);
	    $error++;
	  }
	}
  }
}
//Aqui valido la observacion en urgencias
/*$consulta="SELECT urg.feci_fur,urg.fece_fur,urg.hori_fur,urg.hore_fur,urg.cext_fur,urg.dxeg_fur,
urg.dxre1_fur,urg.dxre2_fur,urg.dxre3_fur,urg.dest_fur,urg.ests_fur,urg.cmue_fur,
ef.iden_fac,ef.nume_fac
FROM furgencia AS urg
INNER JOIN encabezado_factura AS ef ON ef.nume_fac=urg.numf_fur
WHERE $condicion";*/
$consulta="SELECT urg.feci_fur,urg.fece_fur,urg.hori_fur,urg.hore_fur,urg.cext_fur,urg.dxeg_fur,
urg.dxre1_fur,urg.dxre2_fur,urg.dxre3_fur,urg.dest_fur,urg.ests_fur,urg.cmue_fur,
ef.iden_fac,ef.nume_fac
FROM furgencia AS urg
INNER JOIN encabezado_factura AS ef ON ef.iden_fac=urg.iden_fac
WHERE $condicion";
//echo "<br>".$consulta;
$consulta=mysql_query($consulta);
if(mysql_num_rows($consulta)!=0){
  while($row=mysql_fetch_array($consulta)){
    $hoy=date("Y-m-d");
	$feci_fur=cambiafecha($row[feci_fur]);
    if(strtotime($feci_fur)>strtotime($hoy)){
	  if($color<>'#dddddd'){$color='#dddddd';}else{$color='';}
	  muetraerror($color,'AU',$row[iden_fac],$row[nume_fac],'Fecha de ingreso mayor a la actual',$row[feci_fur]);
	  $error++;
	}
	$fece_fur=cambiafecha($row[fece_fur]);
    if(strtotime($fece_fur)>strtotime($hoy)){
	  if($color<>'#dddddd'){$color='#dddddd';}else{$color='';}
	  muetraerror($color,'AU',$row[iden_fac],$row[nume_fac],'Fecha de egreso mayor a la actual',$row[fece_fur]);
	  $error++;
	}
	if(strtotime($feci_fur)>strtotime($fece_fur)){
	  if($color<>'#dddddd'){$color='#dddddd';}else{$color='';}
	  $val=$row[feci_fur].' - '.$row[fece_fur];
	  muetraerror($color,'AU',$row[iden_fac],$row[nume_fac],'Fecha de ingreso mayor a la fecha de egreso',$val);
	  $error++;
	}
	//Aqui valido la hora de ingreso y salida	
	if(strlen(trim($row[hori_fur]))<5 or strlen(trim($row[hore_fur]))<5){
	  if($color<>'#dddddd'){$color='#dddddd';}else{$color='';}
	  $val=$row[hori_fur].' - '.$row[hore_fur];
	  muetraerror($color,'AU',$row[iden_fac],$row[nume_fac],'La hora de ingreso o egreso esta errada',$val);
	  $error++;
	}
	//Aqui valido la via de ingreso
	if($row[cext_fur]<'01' or $row[cext_fur]>'15'){
	  if($color<>'#dddddd'){$color='#dddddd';}else{$color='';}
	  muetraerror($color,'AU',$row[iden_fac],$row[nume_fac],'Causa externa',$row[cext_fur]);
	  $error++;
	}
	//Aqui valido Dx de salida
	$consulta2=mysql_query("SELECT cod_cie10 FROM cie_10 WHERE cod_cie10='$row[dxeg_fur]'");
	if(mysql_num_rows($consulta2)==0){
	  if($color<>'#dddddd'){$color='#dddddd';}else{$color='';}
	  muetraerror($color,'AU',$row[iden_fac],$row[nume_fac],'Diagnostico de egreso',$row[dxeg_fur]);
	  $error++;
	}
	//Aqui valido Dx relacionado 1
	if($row[dxre1_fur]!=''){
	  $consulta2=mysql_query("SELECT cod_cie10 FROM cie_10 WHERE cod_cie10='$row[dxre1_fur]'");
	  if(mysql_num_rows($consulta2)==0){
	    if($color<>'#dddddd'){$color='#dddddd';}else{$color='';}
		muetraerror($color,'AU',$row[iden_fac],$row[nume_fac],'Dx Relacionado 1',$row[dxre1_fur]);
	    $error++;
	  }
	}
	//Aqui valido Dx relacionado 2
	if($row[dxre2_fur]!=''){
	  $consulta2=mysql_query("SELECT cod_cie10 FROM cie_10 WHERE cod_cie10='$row[dxre2_fur]'");
	  if(mysql_num_rows($consulta2)==0){
	    if($color<>'#dddddd'){$color='#dddddd';}else{$color='';}
		  muetraerror($color,'AU',$row[iden_fac],$row[nume_fac],'Dx Relacionado 2',$row[dxre2_fur]);
	      $error++;
	    }
	}
	//Aqui valido Dx relacionado 3
	if($row[dxre3_fur]!=''){
	  $consulta2=mysql_query("SELECT cod_cie10 FROM cie_10 WHERE cod_cie10='$row[dxre3_fur]'");
	  if(mysql_num_rows($consulta2)==0){
	    if($color<>'#dddddd'){$color='#dddddd';}else{$color='';}
		  muetraerror($color,'AU',$row[iden_fac],$row[nume_fac],'Dx Relacionado 3',$row[dxre3_fur]);
	      $error++;
	    }
	}
	if($row[dest_fur]<'1' or $row[dest_fur]>'3'){
	  if($color<>'#dddddd'){$color='#dddddd';}else{$color='';}
	  muetraerror($color,'AU',$row[iden_fac],$row[nume_fac],'Destino del paciente',$row[dest_fur]);
	  $error++;
	}
	if($row[ests_fur]<'1' or $row[ests_fur]>'2'){
	  if($color<>'#dddddd'){$color='#dddddd';}else{$color='';}
	  muetraerror($color,'AU',$row[iden_fac],$row[nume_fac],'Estado del paciente a la salida',$row[ests_fur]);
	  $error++;
	}
	if($row[ests_fur]=='2'){
	  $consulta2=mysql_query("SELECT cod_cie10 FROM cie_10 WHERE cod_cie10='$row[cmue_fur]'");
	  if(mysql_num_rows($consulta2)==0){
	    if($color<>'#dddddd'){$color='#dddddd';}else{$color='';}
		muetraerror($color,'AU',$row[iden_fac],$row[nume_fac],'Causa de muerte',$row[cmue_fur]);
	    $error++;
	  }
	}	
  }
}
//Aqui valido los medicamentos
/*$consulta="SELECT med.tipo_fme,med.codi_fme,med.nomb_fme,
ef.iden_fac,ef.nume_fac
FROM fmedicamento AS med
INNER JOIN encabezado_factura AS ef ON ef.nume_fac=med.numf_fme
WHERE $condicion";*/
$consulta="SELECT med.tipo_fme,med.codi_fme,med.nomb_fme,
ef.iden_fac,ef.nume_fac
FROM fmedicamento AS med
INNER JOIN encabezado_factura AS ef ON ef.iden_fac=med.iden_fac
WHERE $condicion";
//echo "<br>".$consulta;
$consulta=mysql_query($consulta);
if(mysql_num_rows($consulta)!=0){
  while($row=mysql_fetch_array($consulta)){
    if($row[tipo_fme]<'1' or $row[tipo_fme]>'2'){
	  if($color<>'#dddddd'){$color='#dddddd';}else{$color='';}
	  muetraerror($color,'AM',$row[iden_fac],$row[nume_fac],'Tipo de medicamento',$row[tipo_fme]);
	  $error++;
	}
    if(empty($row[codi_fme])){
	  if($color<>'#dddddd'){$color='#dddddd';}else{$color='';}
	  muetraerror($color,'AM',$row[iden_fac],$row[nume_fac],'Codigo del medicamento',$row[codi_fme]);
	  $error++;
	}
    if(empty($row[nomb_fme])){
	  if($color<>'#dddddd'){$color='#dddddd';}else{$color='';}
	  muetraerror($color,'AM',$row[iden_fac],$row[nume_fac],'Nombre del medicamento',$row[nomb_fme]);
	  $error++;
	}
  }
}
//Aqui valido otros servicios
/*$consulta="SELECT otr.tpser_fos,otr.cods_fos,otr.noms_fos,
ef.iden_fac,ef.nume_fac
FROM fotros_servicios AS otr
INNER JOIN encabezado_factura AS ef ON ef.nume_fac=otr.numf_fos
WHERE $condicion";*/
$consulta="SELECT otr.tpser_fos,otr.cods_fos,otr.noms_fos,
ef.iden_fac,ef.nume_fac
FROM fotros_servicios AS otr
INNER JOIN encabezado_factura AS ef ON ef.iden_fac=otr.iden_fac
WHERE $condicion";
//echo "<br>".$consulta;
$consulta=mysql_query($consulta);
if(mysql_num_rows($consulta)!=0){
  while($row=mysql_fetch_array($consulta)){
    if($row[tpser_fos]<'1' or $row[tpser_fos]>'4'){
	  if($color<>'#dddddd'){$color='#dddddd';}else{$color='';}
	  muetraerror($color,'AT',$row[iden_fac],$row[nume_fac],'Tipo de servicio',$row[tpser_fos]);
	  $error++;
	}
	if(empty($row[cods_fos])){
	  if($color<>'#dddddd'){$color='#dddddd';}else{$color='';}
	  muetraerror($color,'AT',$row[iden_fac],$row[nume_fac],'Codigo del servicio',$row[cods_fos]);
	  $error++;
	}
    if(empty($row[noms_fos])){
	  if($color<>'#dddddd'){$color='#dddddd';}else{$color='';}
	  muetraerror($color,'AT',$row[iden_fac],$row[nume_fac],'Nombre del servicio',$row[noms_fos]);
	  $error++;
	}
  }
}
//Aqui valido los recien nacidos
/*$consulta="SELECT fna.fnac_fna,fna.hnac_fna,fna.edge_fna,fna.contr_fna,fna.sexo_fna,fna.peso_fna,fna.diag_fna,fna.cmue_fna,fna.fmue_fna,fna.hmue_fna,
ef.iden_fac,ef.nume_fac
FROM fnacidos AS fna
INNER JOIN encabezado_factura AS ef ON ef.nume_fac=fna.numf_fna
WHERE $condicion";*/
$consulta="SELECT fna.fnac_fna,fna.hnac_fna,fna.edge_fna,fna.contr_fna,fna.sexo_fna,fna.peso_fna,fna.diag_fna,fna.cmue_fna,fna.fmue_fna,fna.hmue_fna,
ef.iden_fac,ef.nume_fac
FROM fnacidos AS fna
INNER JOIN encabezado_factura AS ef ON ef.iden_fac=fna.iden_fac
WHERE $condicion";
//echo "<br>".$consulta;
$consulta=mysql_query($consulta);
if(mysql_num_rows($consulta)!=0){
  while($row=mysql_fetch_array($consulta)){
    $hoy=date("Y-m-d");
	$fnac_fna=cambiafecha($row[fnac_fna]);
	//Aqui valido la fecha de nacimiento
    if(strtotime($fnac_fna)>strtotime($hoy)){
	  if($color<>'#dddddd'){$color='#dddddd';}else{$color='';}
	  muetraerror($color,'AN',$row[iden_fac],$row[nume_fac],'Fecha de nacimiento mayor a la actual',$row[fnac_fna]);
	  $error++;
	}
	//Aqui valido la hora de nacimiento
	if(strlen(trim($row[hnac_fna]))<5){
	  if($color<>'#dddddd'){$color='#dddddd';}else{$color='';}
	  muetraerror($color,'AN',$row[iden_fac],$row[nume_fac],'La hora de nacimiento esta errada',$row[hnac_fna]);
	  $error++;
	}
	//Aqui valido la edad gestacional
	if($row[edge_fna]<24 or $row[edge_fna]>39){
	  if($color<>'#dddddd'){$color='#dddddd';}else{$color='';}
	  muetraerror($color,'AN',$row[iden_fac],$row[nume_fac],'La edad gestacional esta errada',$row[edge_fna]);
	  $error++;
	}
	//Aqui valido el control prenatal
	if($row[contr_fna]<'1' or $row[contr_fna]>'2'){
	  if($color<>'#dddddd'){$color='#dddddd';}else{$color='';}
	  muetraerror($color,'AN',$row[iden_fac],$row[nume_fac],'La control prenatal esta errada',$row[contr_fna]);
	  $error++;
	}
	//Aqui valido el sexo del recien nacido
	if($row[sexo_fna]<>'M' and $row[sexo_fna]<>'F'){
	  if($color<>'#dddddd'){$color='#dddddd';}else{$color='';}
	  muetraerror($color,'AN',$row[iden_fac],$row[nume_fac],'El sexo del recien nacido esta errado',$row[sexo_fna]);
	  $error++;
	}
	//Aqui valido el peso
	if($row[peso_fna]<1000 or $row[peso_fna]>4000){
	  if($color<>'#dddddd'){$color='#dddddd';}else{$color='';}
	  muetraerror($color,'AN',$row[iden_fac],$row[nume_fac],'Revise el peso del recien nacido',$row[peso_fna]);
	  //$error++;
	}
	//Aqui valido Dx del recien nacido
	$consulta2=mysql_query("SELECT cod_cie10 FROM cie_10 WHERE cod_cie10='$row[diag_fna]'");
	if(mysql_num_rows($consulta2)==0){
	  if($color<>'#dddddd'){$color='#dddddd';}else{$color='';}
	  muetraerror($color,'AN',$row[diag_fna],'Diagnstico errado del recien nacido',$row[diag_fna]);
	  $error++;
	}
	if($row[diag_fna]=='0000' or $row[diag_fna]=='1111'){
	  if($color<>'#dddddd'){$color='#dddddd';}else{$color='';}
	  muetraerror($color,'AN',$row[iden_fac],$row[nume_fac],'Diagnstico errado del recien nacido',$row[diag_fna]);
	  $error++;
	}
	//Aqui valildo la causa de muerte del recien nacido
	if(!empty($row[cmue_fna])){
      $consulta2=mysql_query("SELECT cod_cie10 FROM cie_10 WHERE cod_cie10='$row[cmue_fna]'");
	  if(mysql_num_rows($consulta2)==0){
	    if($color<>'#dddddd'){$color='#dddddd';}else{$color='';}
	    muetraerror($color,'AN',$row[iden_fac],$row[nume_fac],'Causa de muerte del recien nacido',$row[cmue_fna]);
	    $error++;
	  }
	}
	if(!empty($row[cmue_fna]) and strlen(trim($row[hmue_fna]))<5){
	  if($color<>'#dddddd'){$color='#dddddd';}else{$color='';}
	  muetraerror($color,'AN',$row[iden_fac],$row[nume_fac],'Hora de muerte del recien nacido',$row[hmue_fna]);
	  $error++;
	}
  }
}
echo "</table>";
//if($error==0){  
  $fcie_fac=cambiafechadmy($fcie_fac);
  $fini_fac="01/".substr($fcie_fac,3,8);
  echo "<table class='Tbl0'>
      <tr><td class='Td0' align='center' colspan='2'>PARA AF</td></tr>
      <tr>
        <td class='Td2' align='right'><b>Fecha inicial: <!--<input type='text' name='fecha_ini' size='10' maxlength='10' value='$fini_fac'>--></td>
        <td class='Td2' align='left'><b>Fecha final: <!--<input type='text' name='fecha_fin' size='10' maxlength='10' value='$fcie_fac'>--></td>
      </tr>
      </table>";  
  echo "<br><center><a href='#' onclick='validar()'><img src='icons/1273718947326355398.png' height='40' width='40' alt='Generar archivos planos'>Generar Archivos Planos</a></center>";
//}
echo "<input type='hidden' name='factura' value='$factura'>";
echo "<input type='hidden' name='relacion' value='$relacion'>";
echo "<input type='hidden' name='pref_fac' value='$pref_fac'>";
mysql_free_result($consulta);
mysql_close();
?>
</form>
</body>
</html>

<?
function muetraerror($color_,$cpt_,$idfac_,$fac_,$desc_,$val_){
	echo "<tr>";
	echo "<td class='Td2' align='center' bgcolor='$color_'><a href='fac_4heenviarips.php?iden_fac=$idfac_&factura=$fac_&cpt=$cpt_'><img width=15 height=15 src='icons/feed_edit.png' alt='Ir a los rips de la factura' border=0></a></td>";
	echo "<td class='Td2' align='center' bgcolor='$color_'>".$cpt_."</td>";
	echo "<td class='Td2' align='left' bgcolor='$color_'>".$fac_."</td>";
	echo "<td class='Td2' align='left' bgcolor='$color_'>".$desc_."</td>";
	echo "<td class='Td2' align='left' bgcolor='$color_'>".$val_."</td>";
	echo "</tr>";
}
?>
