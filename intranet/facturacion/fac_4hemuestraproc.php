<?
session_start();
?>
<html>
<head>
<title>PROGRAMA DE FACTURACIÓN</title>
<link rel="stylesheet" href="css/style.css" type="text/css" />
<script language='javascript'>
function activar(reg_){
var comando='';
  comando="form1.chk"+reg_+".checked";
  if(eval(comando)==true){
    comando="form1.fpro_fpr"+reg_+".disabled=false";
	eval(comando);
    comando="form1.naut_fpr"+reg_+".disabled=false";
    eval(comando);
    comando="form1.cpro_fpr"+reg_+".disabled=false";
    eval(comando);
    comando="form1.ambi_fpr"+reg_+".disabled=false";
    eval(comando);
    comando="form1.fina_fpr"+reg_+".disabled=false";
    eval(comando);
    comando="form1.pers_fpr"+reg_+".disabled=false";
    eval(comando);
    comando="form1.dxpr_fpr"+reg_+".disabled=false";
    eval(comando);
    comando="form1.dxre_fpr"+reg_+".disabled=false";
    eval(comando);
    comando="form1.cpli_fpr"+reg_+".disabled=false";
    eval(comando);
    comando="form1.form_fpr"+reg_+".disabled=false";
    eval(comando);
  }
  else{
    comando="form1.fpro_fpr"+reg_+".disabled=true";
	eval(comando);
    comando="form1.naut_fpr"+reg_+".disabled=true";
    eval(comando);
    comando="form1.cpro_fpr"+reg_+".disabled=true";
    eval(comando);
    comando="form1.ambi_fpr"+reg_+".disabled=true";
    eval(comando);
    comando="form1.fina_fpr"+reg_+".disabled=true";
    eval(comando);
    comando="form1.pers_fpr"+reg_+".disabled=true";
    eval(comando);
    comando="form1.dxpr_fpr"+reg_+".disabled=true";
    eval(comando);
    comando="form1.dxre_fpr"+reg_+".disabled=true";
    eval(comando);
    comando="form1.cpli_fpr"+reg_+".disabled=true";
    eval(comando);
    comando="form1.form_fpr"+reg_+".disabled=true";
    eval(comando);
  }
}
function activasel(var_,val_){
  var comando="form1."+var_+".value='"+val_+"'";
  eval(comando);
}
function ayuda(tipo_,codi_){
var url="fac_ayuda.php?tipo_="+tipo_+"&codi_="+codi_;
  window.open(url,"ventana1","width=400,height=700,scrollbars=1,top=100,left=800") 
}
function validar(cont_){
var i=0,comando='',error='';
  for(i=0;i<cont_;i++){
    comando="form1.fpro_fpr"+i+".value"
    if(eval(comando)==''){error=error+"Fecha de la consulta "+i+"\n"}
	comando="form1.cpro_fpr"+i+".value"
    if(eval(comando)==''){error=error+"Código del procedimiento "+i+"\n"}
  }
  if(error!=''){
    alert("Para guardar debe complementar la siguiente información:\n\n"+error);
  }
  else{
    form1.submit();
  }
}
function eliminar(tipo_,reg_){
    var url_='';
    if(confirm("Desea eliminar este procedimiento?")){
        url_="fac_4herborrareg.php?reg="+reg_+"&tipo="+tipo_;
        //alert(url_);
        window.open(url_,"fr02");
    }
}
</script>
</head>
<body>
<form name='form1' method="POST" action='fac_4heguardapro.php' target='fr02'>
<table class="Tbl0"><tr><td class="Td0" align='center'>R I P S de la factura <?echo $gfactura;?></td></tr></table>
<?
include('php/conexion.php');
include('php/funciones.php');
?>
<img src='icons/barra2.png' width='910' height='30' usemap="#actividades" border='0'/>
<map name="actividades">
<area shape="rect" coords="0,0,125,30" href="fac_4hemuestracons.php" alt="Consultas" />
<!--<area shape="rect" coords="130,0,260,30" href="fac_4hemuestraproc.php" alt="Procedimientos" />-->
<area shape="rect" coords="265,0,380,30" href="fac_4hemuestramedi.php" alt="Medicamentos" />
<area shape="rect" coords="390,0,515,30" href="fac_4hemuestraotro.php" alt="Otros Servicios" />
<area shape="rect" coords="520,0,645,30" href="fac_4hemuestraurge.php" alt="Est. Urgencias" />
<area shape="rect" coords="655,0,800,30" href="fac_4hemuestrahosp.php" alt="Est. Hospitalización" />
<area shape="rect" coords="800,0,910,30" href="fac_4hemuestrarnac.php" alt="Recién Nacidos" />
</map>

<table class="Tbl0" border='0'>
  <th class="Th0" width='10%'><b>Factura Nro:</td>
  <th class="Th0" width='15%'><b>Tp. Identificación:</td>
  <th class="Th0" width='15%'><b>Número</td>
  <th class="Th0" width='50%'><b>Nombre</td>
  <th class="Th0" width='10%'><b>Vr.Factura</td>
<?
  $consulta=mysql_query("SELECT us.tdoc_usu,us.nrod_usu,us.pnom_usu,us.snom_usu,us.pape_usu,us.sape_usu,
  ef.vnet_fac
  FROM encabezado_factura AS ef
  INNER JOIN usuario AS us ON us.codi_usu=ef.codi_usu
  WHERE iden_fac=$giden_fac");
  $row=mysql_fetch_array($consulta);
  $nombre=$row[pnom_usu]." ".$row[snom_usu]." ".$row[pape_usu]." ".$row[sape_usu];
  echo "<tr>";
  echo "<td class='Td2' align='left'>$gfactura</td>";
  echo "<td class='Td2' align='center'>$row[tdoc_usu]</td>";
  echo "<td class='Td2' align='center'>$row[nrod_usu]</td>";
  echo "<td class='Td2' align='center'>$nombre</td>";
  echo "<td class='Td2' align='center'>$row[vnet_fac]</td>";
  echo "</tr>";
?>    
</table>

<table class="Tbl0" border='1'>
  <th class="Th0" width='5%' colspan='2'><b>Sel</td>
  <th class="Th0" width='7%'><b>Fecha</td>
  <th class="Th0" width='6%'><b>Autorización</td>
  <th class="Th0" width='7%'><b>Código</td>
  <th class="Th0" width='13%'><b>Ambito</td>
  <th class="Th0" width='14%'><b>Finalidad</td>
  <th class="Th0" width='14%'><b>Personal</td>
  <th class="Th0" width='20%'><b>Diagnosticos</td>  
  <th class="Th0" width='8%'><b>Forma</td>  
  <th class="Th0" width='6%'><b>Valor</td>  
<?
  $cont=0;
  $total=0;
  /*$consultacon="SELECT pro.regi_fpr,pro.fpro_fpr,pro.naut_fpr,pro.cpro_fpr,pro.ambi_fpr,pro.fina_fpr,
  pro.pers_fpr,pro.dxpr_fpr,pro.dxre_fpr,pro.cpli_fpr,pro.form_fpr,pro.valo_fpr
  FROM fprocedim AS pro
  WHERE numf_fpr='$gfactura'";*/
  $consultacon="SELECT pro.regi_fpr,pro.fpro_fpr,pro.naut_fpr,pro.cpro_fpr,pro.ambi_fpr,pro.fina_fpr,
  pro.pers_fpr,pro.dxpr_fpr,pro.dxre_fpr,pro.cpli_fpr,pro.form_fpr,pro.valo_fpr
  FROM fprocedim AS pro
  WHERE iden_fac='$giden_fac'";
  //echo $consultacon;
  $consultacon=mysql_query($consultacon);
  while($rowcon=mysql_fetch_array($consultacon)){
    $nomvar="regi_fpr".$cont;
    echo "<input type='hidden' name='$nomvar' value='$rowcon[regi_fpr]'>";
    echo "<tr>";
    $nomvar="chk".$cont;
    echo "<td class='Td2' align='left'><input type='checkbox' name='$nomvar' onclick='activar($cont)'></td>";
    echo "<td class='Td2' align='left'><a href='#' onclick=eliminar('P','$rowcon[regi_fpr]') title='Eliminar Registro'><img src='icons/feed_delete.png' width='15' height='15'></a></td>";
    $nomvar="fpro_fpr".$cont;
    echo "<td class='Td2' align='center'><input type='text' name='$nomvar' size='10' maxlength='10' value='$rowcon[fpro_fpr]' disabled></td>";
    $nomvar="naut_fpr".$cont;
    echo "<td class='Td2' align='center'><input type='text' name='$nomvar' size='10' maxlength='15' value='$rowcon[naut_fpr]' disabled></td>";
    $nomvar="cpro_fpr".$cont;
    echo "<td class='Td2' align='center'><input type='text' name='$nomvar' size='8' maxlength='8' value='$rowcon[cpro_fpr]' disabled><a href='#'  onclick='ayuda(\"P\",\"$rowcon[cpro_fpr]\")'><img src='icons/feed_magnify.png' width='15' height='15'></a></td>";
    $consultades=mysql_query("SELECT valo_des,nomb_des FROM destipos WHERE codt_des='32'");
    $nomvar="ambi_fpr".$cont;
    echo "<td class='Td2' align='center'><select name='$nomvar' disabled>";
    while($rowdes=mysql_fetch_array($consultades)){
        echo "<option value='$rowdes[valo_des]'>$rowdes[valo_des] ".substr($rowdes[nomb_des],0,40);
    }
    echo "</select>";
    echo "</td>";
    ?>
        <script language='javascript'>activasel('<?echo $nomvar;?>','<?echo $rowcon[ambi_fpr];?>');</script>
    <?
    $nomvar="fina_fpr".$cont;
    echo "<td class='Td2' align='center'><select name='$nomvar' disabled>";
    echo "<option value='1'>1 Diagnóstico";
    echo "<option value='2'>2 Terapéutico";
    echo "<option value='3'>3 Protección Específica";
    echo "<option value='4'>4 Detección Enf. General";
    echo "<option value='5'>5 Detección Enf. Profes.";
    echo "</select>";
    echo "</td>";
    ?>
	<script language='javascript'>activasel('<?echo $nomvar;?>','<?echo $rowcon[fina_fpr];?>');</script>
    <?
    $nomvar="pers_fpr".$cont;
    echo "<td class='Td2' align='center'><select name='$nomvar' disabled>";
    echo "<option value=''>";
    echo "<option value='1'>1 Médico espec.";
    echo "<option value='2'>2 Médico gener.";
    echo "<option value='3'>3 Enfermera";
    echo "<option value='4'>4 Auxiliar Enf.";
    echo "<option value='5'>5 Otro";
    echo "</select>";
    echo "</td>";
    ?>
	<script language='javascript'>activasel('<?echo $nomvar;?>','<?echo $rowcon[pers_fpr];?>');</script>
    <?
    $nomvar="dxpr_fpr".$cont;
    echo "<td class='Td2' align='center'><b>Pri <input type='text' name='$nomvar' size='4' maxlength='4' value='$rowcon[dxpr_fpr]' disabled><a href='#'  onclick='ayuda(\"D\",\"$rowcon[dxpr_fpr]\")'><img src='icons/feed_magnify.png' width='15' height='15'></a>";	
    $nomvar="dxre_fpr".$cont;
    echo "<br>Rel <input type='text' name='$nomvar' size='4' maxlength='4' value='$rowcon[dxre_fpr]' disabled>";
    $nomvar="cpli_fpr".$cont;
    echo "<br>Com <input type='text' name='$nomvar' size='4' maxlength='4' value='$rowcon[cpli_fpr]' disabled>";
    echo"</td>";
    $nomvar="form_fpr".$cont;
    echo "<td class='Td2' align='center'><select name='$nomvar' disabled>";
    echo "<option value=''>";
    echo "<option value='1'>Unico o Unilateral";
    echo "<option value='2'>Misma via, dif. espec";
    echo "<option value='3'>Misma via, igual espec";
    echo "<option value='4'>Difer. via, difer. espec";
    echo "<option value='5'>Difer. via, igual espec";
    echo "</select>";
    echo"</td>";
    ?>
        <script language='javascript'>activasel('<?echo $nomvar;?>','<?echo $rowcon[form_fpr];?>');</script>
    <?
    $nomvar="valo_fpr".$cont;
    echo "<td class='Td2' align='right'><input type='text' name='$nomvar' size='7' maxlength='7' value='".number_format($rowcon[valo_fpr])."' disabled></td>";
    echo "</tr>";
    $total=$total+$rowcon[valo_fpr];
    $cont++;
    mysql_free_result($consultades);
  }
echo "</tr>";
echo "<td class='Td2' align='right'></td>";
echo "<td class='Td2' align='right'></td>";
echo "<td class='Td2' align='right'></td>";
echo "<td class='Td2' align='right'></td>";
echo "<td class='Td2' align='right'></td>";
echo "<td class='Td2' align='right'></td>";
echo "<td class='Td2' align='right'></td>";
echo "<td class='Td2' align='right'></td>";
echo "<td class='Td2' align='right'><b>Total Procedimientos</td>";
echo "<td class='Td2' align='right'><b>".number_format($total)."</td>";
echo "</tr>";
mysql_free_result($consulta);
mysql_free_result($consultacon);
mysql_close();
?>    
</table>
<br><br>
<center><a href='#' onclick='validar(<?echo $cont;?>)'><img src='icons/feed_disk.png' width='20' height='20'>Guardar</a></center>
<input type='hidden' name='cont' value='<?echo $cont;?>'>
</form>
</body>
</html>
