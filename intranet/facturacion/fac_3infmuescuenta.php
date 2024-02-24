<?
session_start();
//session_register('Gidusufac');
include('php/conexiones_g.php');
base_general();
$consultausu=mysql_query("SELECT nomb_usua,tip_usuario FROM cut WHERE ide_usua='$Gidusufac'");
$rowusu=mysql_fetch_array($consultausu);
$nombreusu=$rowusu[nomb_usua];
?>
<html>
<head>
<title>Cuenta de Cobro</title>
<link rel="stylesheet" href="css/style.css" type="text/css" />
<script language='javascript'>
modif='N';
impre='N';
function cerrar(cuenta_){
  if (confirm("Recuerde que al cerrar la cuenta, no podrá modificar, adicionar o quitar facturas\n Desea cerrar la cuenta?")){
    window.open('fac_3captufechacco.php?iden_cco='+cuenta_,'blank','left=300,top=300,width=200,height=230,toolbar=0,location=0,scrollbars=0');
  }
}
function validar(){
  var error='';
  if(form1.nit.value==''){error=error+"Nit\n";}
  if(form1.concepto.value==''){error=error+"Concepto\n";}
  if(form1.fecha.value==''){error=error+"Fecha\n";}
  if(form1.responsable.value==''){error=error+"Responsable\n";}
  if(form1.anexo.value==''){error=error+"Anexos\n";}
  if(error!=''){
    alert("Para continuar debe completar la siguiente información: \n\n"+error);
    return false;}
  else{
    if(modif=='S'){
	  form1.submit();          
    }
  }
}
function validalongitud(var_,numero){
  var longitud=eval("form1."+var_+".value.length");
  var nuevacad="";
  if(longitud>numero){
	nuevacad=eval("form1."+var_+".value").substr(0,numero);
	nuevacad=eval("form1."+var_+".value='"+nuevacad+"'");
  }
}
function activar(){
 //alert(form1.chkactiva.checked)
  if(form1.chkactiva.checked==true){
    form1.nit.disabled=false;
    form1.concepto.disabled=false;
    form1.fecha.disabled=false;
    form1.responsable.disabled=false;
    form1.anexo.disabled=false;
    form1.nota.disabled=false;
    modif='S';
    impre='N';
  }
  else{
    form1.nit.disabled=true;
    form1.concepto.disabled=true;
    form1.fecha.disabled=true;
    form1.responsable.disabled=true;
    form1.anexo.disabled=true;
    form1.nota.disabled=true;
    modif='S';
    impre='S';
  }
}
function quitarfac(cuenta_){
    document.form1.action='fac_3quitafac.php';
    document.form1.submit();
}

function adicionafac(cuenta_){
    document.form1.action='fac_3adicionafac.php';
    document.form1.submit();
}

function imprimir(cuenta_)
{
var URL="fac_3infcuentaco.php?iden_cco="+cuenta_; 
var titulo="Factura" 
var x=0 
var y=0 
var ancho=1000
var alto=700
var herramientas=0
var direccion=0
var barras=1
ventana= window.open(URL,titulo,"left="+x+",top="+y+",width="+ancho+",height="+alto+",toolbar="+herramientas+",location="+direccion+",scrollbars="+barras) 
}
function cerrada(){
    alert("Cuenta de cobro cerrada para modificaciones");
}
</script>
</head>
<body lang=ES  style='tab-interval:35.4pt'  >
<form name="form1" method="POST" action="fac_3infguardacuenta.php">
<table class="Tbl0"><tr><td class="Td0" align='center'>Cuenta de Cobro</td></tr></table>
<br><br><br>
<?
include('php/funciones.php');
include('php/conexion.php');
$encontrado='N';
$disp='disabled';
$consulta="SELECT iden_cco,rela_cco,nit_cco,cpto_cco,anex_cco,fech_cco,nota_cco,resp_cco,frad_cco,esta_cco 
  FROM cuenta_cobro
  WHERE rela_cco='$relacion'";
//echo "<br>".$consulta;
$consulta=mysql_query($consulta);
if(mysql_num_rows($consulta)<>0){
  $row=mysql_fetch_array($consulta);
  $iden_cco=$row[iden_cco];
  $nit=$row[nit_cco];
  $concepto=$row[cpto_cco];
  $fecha=$row[fech_cco];
  $reponsable=$row[resp_cco];
  $anexo=$row[anex_cco];
  $nota=$row[nota_cco];
  $encontrado='S';
  if($row[esta_cco]=='C'){$estado='Cerrada';}
  else{$estado='Abierta';}  
  $disp='disabled';
  $consultarel="SELECT rela_fac,enti_fac,SUM(vnet_fac) as total FROM encabezado_factura WHERE rela_fac='$relacion' GROUP BY rela_fac";
  //echo "<br>".$consultarel;
  $consultarel=mysql_query($consultarel);
  if(mysql_num_rows($consultarel)<>0){
    $rowrel=mysql_fetch_array($consultarel);
	$valor=$rowrel[total];
	$valorletra=convertir($valor);
  }
  ?><script >impre='S';</script><?
}
else{
  $consultarel=mysql_query("SELECT rela_fac,enti_fac,SUM(vnet_fac) as total FROM encabezado_factura WHERE rela_fac='$relacion' GROUP BY rela_fac");
  if(mysql_num_rows($consultarel)<>0){
    $rowrel=mysql_fetch_array($consultarel);
	$reponsable=$nombreusu;
	$nit=$rowrel[enti_fac];
	$valor=$rowrel[total];
	$valorletra=convertir($valor);
	//$fecha=fechaletra(hoy());
	$encontrado='S';
        $disp='enabled';
        ?><script language='JavaScript'>modif='S';</script><?
  }
}
if($encontrado=='S'){
  ?>
  <table class="Tbl0" border='0'>
    <tr>
      <td class="Td2" align='right'>Relación:</td>
	  <td class="Td2" align='left'><?echo $relacion;?></td>
      <td class="Td2" align='right'>NIT:</td>
	  <td class="Td2" align='left'><input type='text' name='nit' value='<?echo $nit;?>' <?echo $disp;?>></td>
      <td class="Td2" align='right'>Valor:</td>
	  <td class="Td2" align='left'><?echo $valor;?></td>
    </tr>
    <tr>
      <td class="Td2" align='right'>Por concepto de:</td>
      <td class="Td2" align='left' colspan='3'><textarea name='concepto' rows='4' cols='80' onkeyup="validalongitud('concepto',250)" <?echo $disp;?>><?echo $concepto;?></textarea></td>
	  <td class="Td2" align='left' colspan='2'><b><?echo $valorletra;?></td>
    </tr>
    <tr>
      <td class="Td2" align='right'>Fecha en letras:</td>
	  <td class="Td2" align='left' colspan='3'><input type='text' name='fecha' size='40'  maxlength='40' value='<?echo $fecha;?>' <?echo $disp;?>></td>
    </tr>
    <tr>
      <td class="Td2" align='right'>Responsable:</td>
	  <td class="Td2" align='left' colspan='3'><input type='text' name='responsable' size='40'  maxlength='40' value='<?echo $reponsable;?>' <?echo $disp;?>></td>
    </tr>
    <tr>
      <td class="Td2" align='right'>Anexos:</td>
	  <td class="Td2" align='left' colspan='3'><textarea name='anexo' rows='4' cols='80' onkeyup="validalongitud('anexo',250)" <?echo $disp;?>><?echo $anexo;?></textarea></td>
    </tr>
    <tr>
      <td class="Td2" align='right'>Nota:</td>
	  <td class="Td2" align='left' colspan='3'><textarea name='nota' rows='4' cols='80' onkeyup="validalongitud('nota',250)" <?echo $disp;?>><?echo $nota;?></textarea></td>
    </tr>
    <tr>
      <td class="Td2" align='right'>
          <?
          if($row[esta_cco]<>'C'){echo "<input type='checkbox' onclick='activar()' name='chkactiva'>";}
          else{echo "<input type='checkbox' name='chkactiva' disabled>";}
          ?>
      </td>
      <td class="Td2" align='left' colspan='3'>Modificar</td>
      <td class="Td2" align='left'>Estado de la cueta: <b><?echo $estado;?></td>
      <td class="Td2" align='left'>Fecha de radicación:<b><?echo cambiafechadmy($row[frad_cco]);?></td>
    </tr>
  </table>
  <table class="Tbl0" border='0'>
    <tr>
      <td class='Td2' align='center'><a href='#' onclick='validar()'><img src='icons/feed_disk.png' border='0' alt='Guardar' width=20 height=20>Guardar</a></td>
      <td class='Td2' align='center'><a href='#' onclick='imprimir(<?echo $iden_cco;?>)'><img src='icons/print.ico' border='0' alt='Imprimir' width=20 height=20>Imprimir</a>
      <td class='Td2' align='center'>
          <?
          if($row[esta_cco]<>'C'){echo "<a href='#' onclick='adicionafac()'><img src='icons/feed_link.png' border='0' alt='Adicionar Facturas a la Cuenta' width=20 height=20>Adicionar Facturas a la Cuenta</a>";}
          else{echo "<a href='#' onclick='cerrada()'><img src='icons/feed_link.png' border='0' alt='Adicionar Facturas a la Cuenta' width=20 height=20>Adicionar Facturas a la Cuenta</a>";}
          ?>
      </td>
      <td class='Td2' align='center'>
          <?
          if($row[esta_cco]<>'C'){echo "<a href='#' onclick='quitarfac()'><img src='icons/feed_delete.png' border='0' alt='Quitar Facturas de la Cuenta' width=20 height=20>Quitar Facturas de la Cuenta</a>";}
          else{echo "<a href='#' onclick='cerrada()'><img src='icons/feed_delete.png' border='0' alt='Quitar Facturas de la Cuenta' width=20 height=20>Quitar Facturas de la Cuenta</a>";}
          ?>
      </td>
      <td class='Td2' align='center'>
          <?
          if($row[esta_cco]<>'C'){echo "<a href='#' onclick='cerrar(<?echo $iden_cco;?>)'><img src='icons/feed_key.png' border='0' alt='Cerrar Cuenta' width=20 height=20>Cerrar Cuenta</a>";}
          else{echo "<a href='#' onclick='cerrada()'><img src='icons/feed_key.png' border='0' alt='Cerrar Cuenta' width=20 height=20>Cerrar Cuenta</a>";}
          ?>          
      </td>
    </tr>
  </table>
  <?
}
else{
  echo "<center>";
  echo "<p class=Msg>No existen registros para esta busqueda</p>";
  echo "</center>";
}

mysql_close();
?>
<input type='hidden' name='relacion' value='<?echo $relacion;?>'>
</form>
</body>
</html>
