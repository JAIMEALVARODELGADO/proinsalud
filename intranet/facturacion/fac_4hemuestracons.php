<?
session_start();
session_register('gfactura');
session_register('giden_fac');
if(!empty($factura)){
  $gfactura=$factura;
  $giden_fac=$iden_fac;
}
?>
<html>
<head>
<title>PROGRAMA DE FACTURACI�N</title>
<link rel="stylesheet" href="css/style.css" type="text/css" />
<script language='javascript'>
function activar(reg_){
var comando='';
  comando="form1.chk"+reg_+".checked";
  if(eval(comando)==true){
    comando="form1.fcon_fco"+reg_+".disabled=false";
	eval(comando);
    comando="form1.naut_fco"+reg_+".disabled=false";
    eval(comando);
    comando="form1.ccon_fco"+reg_+".disabled=false";
    eval(comando);
    comando="form1.fina_fco"+reg_+".disabled=false";
    eval(comando);
    comando="form1.cext_fco"+reg_+".disabled=false";
    eval(comando);
    comando="form1.dxpr_fco"+reg_+".disabled=false";
    eval(comando);
    comando="form1.tpdx_fco"+reg_+".disabled=false";
    eval(comando);
    comando="form1.dxr1_fco"+reg_+".disabled=false";
    eval(comando);
    comando="form1.dxr2_fco"+reg_+".disabled=false";
    eval(comando);
    comando="form1.dxr3_fco"+reg_+".disabled=false";
    eval(comando);
  }
  else{
    comando="form1.fcon_fco"+reg_+".disabled=true";
	eval(comando);
	comando="form1.naut_fco"+reg_+".disabled=true";
    eval(comando);
    comando="form1.ccon_fco"+reg_+".disabled=true";
    eval(comando);
    comando="form1.fina_fco"+reg_+".disabled=true";
    eval(comando);
    comando="form1.cext_fco"+reg_+".disabled=true";
    eval(comando);
    comando="form1.dxpr_fco"+reg_+".disabled=true";
    eval(comando);
    comando="form1.tpdx_fco"+reg_+".disabled=true";
    eval(comando);
    comando="form1.dxr1_fco"+reg_+".disabled=true";
    eval(comando);
    comando="form1.dxr2_fco"+reg_+".disabled=true";
    eval(comando);
    comando="form1.dxr3_fco"+reg_+".disabled=true";
    eval(comando);
  }
}
function ayuda(tipo_,codi_){
var url="fac_ayuda.php?tipo_="+tipo_+"&codi_="+codi_;
  window.open(url,"ventana1","width=400,height=700,scrollbars=1,top=100,left=800") 
}
function activasel(var_,val_){
var comando="form1."+var_+".value='"+val_+"'";
eval(comando);
}
function validar(cont_){
var i=0,comando='',error='';
  for(i=0;i<cont_;i++){
    comando="form1.fcon_fco"+i+".value"
    if(eval(comando)==''){error=error+"Fecha de la consulta "+i+"\n"}
	comando="form1.ccon_fco"+i+".value"
    if(eval(comando)==''){error=error+"C�digo de la consulta "+i+"\n"}
	comando="form1.dxpr_fco"+i+".value"
    if(eval(comando)==''){error=error+"Diagnostico principal "+i+"\n"}
  }
  if(error!=''){
    alert("Para guardar debe complementar la siguiente informaci�n:\n\n"+error);
  }
  else{
    form1.submit();
  }
}
function eliminar(tipo_,reg_){
    var url_='';
    if(confirm("Desea eliminar esta consulta?")){
        url_="fac_4herborrareg.php?reg="+reg_+"&tipo="+tipo_;
        window.open(url_,"fr02");
    }
}
</script>
</head>
<body>
<form name='form1' method="POST" action='fac_4heguardacon.php' target='fr02'>
<table class="Tbl0"><tr><td class="Td0" align='center'>R I P S de la factura <?echo $gfactura;?></td></tr></table>
<?
include('php/conexion.php');
include('php/funciones.php');
?>
<img src='icons/barra1.png' width='910' height='30' usemap="#actividades" border='0'/>
<map name="actividades">
<!--<area shape="rect" coords="0,0,125,30" href="fac_4hemuestracons.php" alt="Consultas" />-->
<area shape="rect" coords="130,0,260,30" href="fac_4hemuestraproc.php" alt="Procedimientos" />
<area shape="rect" coords="265,0,380,30" href="fac_4hemuestramedi.php" alt="Medicamentos" />
<area shape="rect" coords="390,0,515,30" href="fac_4hemuestraotro.php" alt="Otros Servicios" />
<area shape="rect" coords="520,0,645,30" href="fac_4hemuestraurge.php" alt="Est. Urgencias" />
<area shape="rect" coords="655,0,800,30" href="fac_4hemuestrahosp.php" alt="Est. Hospitalizaci�n" />
<area shape="rect" coords="800,0,910,30" href="fac_4hemuestrarnac.php" alt="Reci�n Nacidos" />
</map>
<table class="Tbl0" border='0'>
  <th class="Th0" width='10%'><b>Factura Nro:</td>
  <th class="Th0" width='15%'><b>Tp. Identificaci�n:</td>
  <th class="Th0" width='15%'><b>N�mero</td>
  <th class="Th0" width='50%'><b>Nombre</td>
  <th class="Th0" width='10%'><b>Vr.Factura</td>
<?
/*ECHO "SELECT us.tdoc_usu,us.nrod_usu,us.pnom_usu,us.snom_usu,us.pape_usu,us.sape_usu,
ef.vnet_fac
FROM encabezado_factura AS ef
INNER JOIN usuario AS us ON us.codi_usu=ef.codi_usu
WHERE iden_fac=$giden_fac";*/
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
  <th class="Th0" width='8%'><b>Fecha</td>
  <th class="Th0" width='10%'><b>Autorizaci�n</td>
  <th class="Th0" width='10%'><b>C�digo</td>
  <th class="Th0" width='18%'><b>Finalidad</td>
  <th class="Th0" width='18%'><b>Causa Ext</td>
  <th class="Th0" width='15%'><b>Diagnosticos</td>
  <th class="Th0" width='10%'><b>Tipo Dx Pr</td>  
  <th class="Th0" width='6%'><b>Valor</td>  
<?
  $cont=0;
  $total=0;
  /*$consultacon="SELECT con.regi_fco,con.fcon_fco,con.naut_fco,con.ccon_fco,con.fina_fco,con.cext_fco,
  con.dxpr_fco,con.dxr1_fco,con.dxr2_fco,con.dxr3_fco,con.tpdx_fco,con.neto_fco
  FROM fconsulta AS con
  WHERE numf_fco='$gfactura'";*/
  $consultacon="SELECT con.regi_fco,con.fcon_fco,con.naut_fco,con.ccon_fco,con.fina_fco,con.cext_fco,
  con.dxpr_fco,con.dxr1_fco,con.dxr2_fco,con.dxr3_fco,con.tpdx_fco,con.neto_fco
  FROM fconsulta AS con
  WHERE iden_fac='$giden_fac'";
  //echo $consultacon;
  $consultacon=mysql_query($consultacon);
  while($rowcon=mysql_fetch_array($consultacon)){    
    $nomvar="regi_fco".$cont;
    echo "<input type='hidden' name='$nomvar' value='$rowcon[regi_fco]'>";
    echo "<tr>";
    $nomvar="chk".$cont;
    echo "<td class='Td2' align='left'><input type='checkbox' name='$nomvar' onclick='activar($cont)'></td>";
    echo "<td class='Td2' align='left'><a href='#' onclick=eliminar('C','$rowcon[regi_fco]') title='Eliminar Registro'><img src='icons/feed_delete.png' width='15' height='15'></a></td>";
    $nomvar="fcon_fco".$cont;
    echo "<td class='Td2' align='center'><input type='text' name='$nomvar' size='10' maxlength='10' value='$rowcon[fcon_fco]' disabled></td>";
    $nomvar="naut_fco".$cont;
    echo "<td class='Td2' align='center'><input type='text' name='$nomvar' size='15' maxlength='15' value='$rowcon[naut_fco]' disabled></td>";
    $nomvar="ccon_fco".$cont;
    echo "<td class='Td2' align='center'><input type='text' name='$nomvar' size='8' maxlength='8' value='$rowcon[ccon_fco]' disabled><a href='#'  onclick='ayuda(\"P\",\"$rowcon[ccon_fco]\")'><img src='icons/feed_magnify.png' width='15' height='15'></a></td>";
    $consultades=mysql_query("SELECT valo_des,nomb_des FROM destipos WHERE codt_des='11'");
    $nomvar="fina_fco".$cont;
    echo "<td class='Td2' align='center'><select name='$nomvar' disabled>";
    while($rowdes=mysql_fetch_array($consultades)){
        echo "<option value='$rowdes[valo_des]'>$rowdes[valo_des] ".substr($rowdes[nomb_des],0,40);
    }
    echo "</select>";
    echo "</td>";
    ?>
    <script language='javascript'>activasel('<?echo $nomvar;?>','<?echo $rowcon[fina_fco];?>');</script>
    <?
    $consultades=mysql_query("SELECT valo_des,nomb_des FROM destipos WHERE codt_des='12'");
    $nomvar="cext_fco".$cont;
    echo "<td class='Td2' align='center'><select name='$nomvar' disabled>";
    while($rowdes=mysql_fetch_array($consultades)){
        echo "<option value='$rowdes[valo_des]'>$rowdes[valo_des] ".substr($rowdes[nomb_des],0,20);
    }
    echo "</select>";
    echo "</td>";
    ?>
    <script language='javascript'>activasel('<?echo $nomvar;?>','<?echo $rowcon[cext_fco];?>');</script>
    <?
    $nomvar="dxpr_fco".$cont;
    echo "<td class='Td2' align='center'><b>Pri <input type='text' name='$nomvar' size='4' maxlength='4' value='$rowcon[dxpr_fco]' disabled><a href='#'  onclick='ayuda(\"D\",\"$rowcon[dxpr_fco]\")'><img src='icons/feed_magnify.png' width='15' height='15'></a>";
    $nomvar="dxr1_fco".$cont;
    echo "<br>Rel.1<input type='text' name='$nomvar' size='4' maxlength='4' value='$rowcon[dxr1_fco]' disabled>";
    $nomvar="dxr2_fco".$cont;
    echo "<br>Rel.2<input type='text' name='$nomvar' size='4' maxlength='4' value='$rowcon[dxr2_fco]' disabled>";
    $nomvar="dxr3_fco".$cont;
    echo "<br>Rel.3<input type='text' name='$nomvar' size='4' maxlength='4' value='$rowcon[dxr3_fco]' disabled>";
    echo"</td>";
    $nomvar="tpdx_fco".$cont;
    echo "<td class='Td2' align='center'><select name='$nomvar' disabled>";
    echo "<option value='1'>Impresion Dx";
    echo "<option value='2'>Conf. Nuevo";
    echo "<option value='3'>Conf. Repetido";
    echo "</select>";
    echo"</td>";
    ?>
    <script language='javascript'>activasel('<?echo $nomvar;?>','<?echo $rowcon[tpdx_fco];?>');</script>
    <?
    $nomvar="neto_fco".$cont;
    echo "<td class='Td2' align='right'><input type='text' name='$nomvar' size='7' maxlength='7' value='".number_format($rowcon[neto_fco])."' disabled></td>";
    echo "</tr>";
    $total=$total+$rowcon[neto_fco];
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
echo "<td class='Td2' align='right'><b>Total Consultas</td>";
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
