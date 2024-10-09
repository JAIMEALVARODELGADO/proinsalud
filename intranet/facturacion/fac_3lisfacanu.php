<?php
session_start();
unset($iden_fac); 
//session_register('giden_fac');
//if(!empty($iden_fac)){$giden_fac=$iden_fac;}
include('php/funciones.php');
?>
<html>
<head>
<title>FACTURACION ANULAR</title>
<link rel="stylesheet" href="css/style.css" type="text/css" />
<SCRIPT LANGUAGE=JavaScript>
function abrir(orden_) {
  form1.orden.value=orden_;
  form1.submit();
}

function eliminar(idus,idfac,clase,rela_){  
    if(rela_!=""){alert("Antes de anular la factura, debe eliminarla de la cuenta de cobro");}
    else{
        if (confirm("Desea Anular la Factura del Usuario?\n" +idus)){
            location.href='fac_elimfact.php?iden_fac='+idfac+'&clase='+clase;
        }
        else{
            return(false);
        }
    }
}

function cerrar(idfac,fecf_){
  if (confirm("Recuerde que al cerrar la factura genera el consecutivo y no podr� ser modificada\n\nDesea cerarr la factura?")){
    //fecha_=window.prompt("Fecha de cierre: ",fecha_);
    //location.href='fac_3cierra.php?iden_fac='+idfac+'&fcie_fac='+fecha_;
    window.open('fac_3captufecha.php?iden_fac='+idfac+'&fecf_fac='+fecf_,'blank','left=300,top=300,width=300,height=230,toolbar=0,location=0,scrollbars=0');
  }
}

function asigna_relacion(idfac,nume_){
  if (confirm("Desea asignar relacion a la factura "+nume_+"?")){
    //fecha_=window.prompt("Fecha de cierre: ",fecha_);
    //location.href='fac_3cierra.php?iden_fac='+idfac+'&fcie_fac='+fecha_;
    window.open('fac_3capturela.php?iden_fac='+idfac,'blank','left=300,top=300,width=500,height=230,toolbar=0,location=0,scrollbars=0');
  }
}

function imprimir(factu_) 
{
var URL="fac_2previo.php?iden_fac="+factu_; 
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
</script>
	
</head>
<form name="form1" method="POST" action="fac_3lisfacanu.php" target='fr02'>
<body >
<table class="Tbl0"><tr><td class="Td0" align='center'>LISTADO DE FACTURAS</td></tr></table><br>
 <?
 if(!ISSET($registros)){$registros=200;}
	include('php/conexion.php');
	//$condicion="ef.anul_fac =' ' AND ";

  $consultafecha = "SELECT fechainifactura FROM empresa";
  $consultafecha = mysql_query($consultafecha);
  $rowfecha = mysql_fetch_array($consultafecha);
  $fechainifactura = $rowfecha['fechainifactura'];

  //echo "<br>".$fechainifactura;

	$condicion="ef.esta_fac<>'3' AND ";
	if(!empty($cod_usu)){
	  $condicion=$condicion."usuario.NROD_USU='$cod_usu' AND ";}
	if(!empty($pref_fac)){
	  $condicion=$condicion."ef.pref_fac='$pref_fac' AND ";}
	if(!empty($num_fac)){
	  $condicion=$condicion."ef.nume_fac='$num_fac' AND ";}
	/*if(!empty($codi_con)){
	  $condicion=$condicion."contrato.CODI_CON='$codi_con' AND ";}*/
        if(!empty($codi_con)){
	  $condicion=$condicion."ef.codi_con='$codi_con' AND ";}
	if(!empty($fech_ini)){
	  $fech_ini=cambiafecha($fech_ini);
	  $condicion=$condicion."ef.fcie_fac>='$fech_ini' AND ";}
	if(!empty($fech_fin)){
	  $fech_fin=cambiafecha($fech_fin);
	  $condicion=$condicion."ef.fcie_fac<='$fech_fin' AND ";}
	if(!empty($ingreso)){	  
	  $condicion=$condicion."ef.id_ing='$ingreso' AND ";}          
	if($fabierta=='on'){
	  $condicion=$condicion."ef.nume_fac='' AND ";
    if(empty($fech_ini) AND empty($fech_fin)){
      //$fech_ini=cambiafecha($fech_ini);
      $condicion=$condicion."ef.feci_fac>='$fechainifactura' AND ";
    }
	}
	if(!empty($condicion)){
	  $condicion=substr($condicion,0,(strlen($condicion)-5));}
	if(empty($orden)){
	  //$orden='nrod_usu';
    $orden='feci_fac';
	}
  $_pagi_sql="SELECT ef.iden_fac,ef.id_ing,ef.rela_fac,ef.fcie_fac,ef.feci_fac,ef.fecf_fac,ef.codi_usu,ef.codi_con,ef.pref_fac,ef.nume_fac,ef.iden_ctr,ef.esta_fac,ef.anul_fac,
            usuario.NROD_USU,usuario.PNOM_USU,usuario.SNOM_USU,usuario.PAPE_USU,usuario.SAPE_USU,
            contrato.CODI_CON,contrato.NEPS_CON,cut.nomb_usua
            FROM encabezado_factura AS ef 
            INNER JOIN usuario ON ef.codi_usu = usuario.CODI_USU
            INNER JOIN contrato ON ef.codi_con = contrato.CODI_CON
            LEFT JOIN general.cut cut ON cut.ide_usua = ef.usua_fac ";
	if(!empty($condicion)){
            $_pagi_sql=$_pagi_sql."WHERE $condicion ORDER BY $orden LIMIT $registros";
        }
	else{
            $_pagi_sql=$_pagi_sql."ORDER BY $orden LIMIT $registros";
        }
        //echo "$_pagi_sql<BR>";
	//$_pagi_cuantos = 15; 
	//include("php/paginator.inc.php"); 
        $_pagi_sql=mysql_query($_pagi_sql);
        //$fecha=hoy();
	if(mysql_num_rows($_pagi_sql)!=0) 
	{

		echo "<table class='Tbl0'>";
    echo "<tr>
      <th class='Th0' colspan='6'>OPCIONES</th>
      <th class='Th0'><a href='#' onclick=abrir('nume_fac')>FACTURA</a></th>
      <th class='Th0'><a href='#' onclick=abrir('rela_fac')>RELACION</a></th>
      <th class='Th0'><a href='#' onclick=abrir('id_ing')>INGRESO</a></th>
      <th class='Th0'><a href='#' onclick=abrir('nrod_usu')>IDENTIFICACION</a></th>      
      <th class='Th0'><a href='#' onclick=abrir('pnom_usu')>NOMBRE</a></th>
      <th class='Th0'><a href='#' onclick=abrir('neps_con')>CONTRATO</a></th>
      <th class='Th0'><a href='#' onclick=abrir('neps_con')>RESP PAGO</a></th>
      <th class='Th0'><a href='#' onclick=abrir('feci_fac')>F.INI</a></th>
      <th class='Th0'><a href='#' onclick=abrir('fecf_fac')>F.FIN</a></th>
      <th class='Th0'><a href='#' onclick=abrir('fcie_fac')>FECHA</a></th>
      <th class='Th0'>ESTADO</th>
      <th class='Th0'>FACTURADOR</th>";
		 while($row=mysql_fetch_array($_pagi_sql)){      
                     $fecf_fac=cambiafechadmy($row[fecf_fac]);                     
                     echo "<tr>";
                     if(empty($row[nume_fac])){                         
                       echo "<td class='Td2'><a href='fac_3editenca.php?iden=$row[NROD_USU]&enti=$row[CODI_CON]&idefac=$row[iden_fac]&cotr=$row[iden_ctr]' title='Editar Factura'><img src='icons/feed_edit.png' border='0' alt='Editar'></a></td>";}
                     else{
                       echo "<td class='Td2'><a href='#' title='Factura cerrada para modificaciones'><img src='icons/feed_edit.png' border='0' alt='Factura cerrada para modificaciones'></a></td>";}
                     if($row[anul_fac]=='S'){
                         echo "<td class='Td2'><img src='icons/feed_delete.png' border='0' alt=''></td>";}
                     else{
                         if(empty($row[nume_fac])){
                            echo "<td class='Td2'><a href='#' onclick=\"eliminar('$row[NROD_USU]','$row[iden_fac]','E','$row[rela_fac]')\" title='Eliminar Factura'><img src='icons/feed_delete.png' border='0' alt='Eliminar Factura'></a></td>";}
                        else{
                            echo "<td class='Td2'><a href='#' onclick=\"eliminar('$row[NROD_USU]','$row[iden_fac]','A','$row[rela_fac]')\" title='Anular Factura'><img src='icons/feed_delete.png' border='0' alt='Anular Factura'></a></td>";}
                     }
                     echo "<td class='Td2'><a href='#' onclick='imprimir($row[iden_fac])' title='Imprimir'><img src='icons/feed_magnify.png' border='0' alt='Imprimir'></a></td>";		  
                     if(empty($row[nume_fac])){
                        echo "<td class='Td2'><a href='#' onclick=\"cerrar('$row[iden_fac]','$fecf_fac')\" title='Cerrar Factura'><img src='icons/feed_key.png' border='0' alt='Cerrar Factura'></a></td>";}
                     else{
                        echo "<td class='Td2'><a href='#' title='Factura cerrada'><img src='icons/feed_key.png' border='0' alt='Factura cerrada'></a></td>";}
                      if(empty($row[rela_fac]) and $row[esta_fac]=='2' and $row[anul_fac]!='S'){
                        echo "<td class='Td2'><a href='#' onclick=\"asigna_relacion('$row[iden_fac]','$row[nume_fac]')\" title='Asignar Relacion'><img src='icons/feed_link.png' border='0' alt='Asignar Relacion'></a></td>";}
                      else{
                        echo "<td class='Td2'><a href='#' title='Asignar Relacion'><img src='icons/feed_link.png' border='0' alt='Asignar Relacion'></a></td>";}                        
                      
                      echo "<td class='Td2' align='center' bgcolor='$color'><a href='fac_3muestraripsusua.php?factura=$row[nume_fac]&iden_fac=$row[iden_fac]' title='Editar RIPS 2275'><img src='icons/feed_go.png' alt='Editar RIPS 2275'></a></td>";

                      echo "<td class='Td2'>$row[pref_fac] $row[nume_fac]</td>";
                      echo "<td class='Td2'>$row[rela_fac]</td>";
                      echo "<td class='Td2'>$row[id_ing]</td>";
                      echo "<td class='Td2'>$row[NROD_USU]</td>";
                      echo "<td class='Td2'>$row[PNOM_USU] $row[SNOM_USU] $row[PAPE_USU] $row[SAPE_USU]</td>";
                      echo "<td class='Td2'>$row[NEPS_CON] $row[nume_ctr]</td>";
                      $conresp="SELECT con.neps_con 
                          FROM encabezado_factura AS ef
                          INNER JOIN contratacion AS ccion ON ccion.iden_ctr=ef.iden_ctr
                          INNER JOIN contrato AS con ON con.codi_con=ccion.codi_con
                          WHERE ef.iden_fac=$row[iden_fac]";
                      //echo "<br>".$conresp;
                      $conresp=mysql_query($conresp);
                      $rowresp=mysql_fetch_array($conresp);
                      echo "<td class='Td2'>$rowresp[neps_con]</td>";
                      echo "<td class='Td2'>".cambiafechadmy($row[feci_fac])."</td>";
                      echo "<td class='Td2'>".cambiafechadmy($row[fecf_fac])."</td>";
                      echo "<td class='Td2'>".cambiafechadmy($row[fcie_fac])."</td>";
                      $estado='';
                      //echo $row[anul_fac];
                      if($row[esta_fac]=='1'){
                        $estado='Abierta';
                        $colorest='#00CC00';
                      }
                      else{
                        $estado='Cerrada';
                        $colorest='#006666';
                      }
                      if($row[anul_fac]=='S'){
                        $estado='Anulada';
                        $colorest='#ff0033';
                      }
                      echo "<td class='Td2'><font color='$colorest'>$estado</font></td>";
                      echo "<td class='Td2'>$row[nomb_usua]</td>";
                      echo"</tr>";		 
		}
		echo "<table class='Tbl2'>";
		echo "<tr>";
		echo "<td class='Td1'>".$_pagi_navegacion." Limite ".$registros." Reg</td>";
		echo "</tr>";
		echo "</table>";
    }
	else
	{
	  echo "<center>";
	  echo "<p class=Msg>No existen registros para esta busqueda</p>";
	  echo "</center>";
	}
	mysql_close();
	echo "<input type='hidden' name='cod_usu' value=$cod_usu>";
	echo "<input type='hidden' name='num_fac' value=$num_fac>";
	echo "<input type='hidden' name='codi_con' value=$codi_con>";
	if(!empty($fech_ini)){
	  echo "<input type='hidden' name='fech_ini' value=".cambiafechadmy($fech_ini).">";}
	if(!empty($fech_fin)){
	  echo "<input type='hidden' name='fech_fin' value=".cambiafechadmy($fech_fin).">";}
  echo "<input type='hidden' name='fabierta' value=$fabierta>";
  echo "<input type='hidden' name='registros' value=$registros>";
	echo "<input type='hidden' name='orden'>";
?>

</form>
</body>
</html>