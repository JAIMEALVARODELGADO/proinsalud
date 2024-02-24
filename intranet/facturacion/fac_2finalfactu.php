<?
session_start();
session_register('iden_fac');
?>
<html>
<head>
<script language=javascript>
function calcular() {
     //alert(form1.subtotal.value);
     //form1.vldescu.value=Math.round(form1.subtotal.value*(form1.descu.value/100)/100)*100;
     //form1.vldescu.value=Math.round(form1.subtotal.value*(form1.descu.value/100)/10)*10;
     form1.vldescu.value=Math.round(form1.subtotal.value*(form1.descu.value/100)/1)*1;
     form1.vlnet.value=form1.subtotal.value-form1.vldescu.value-form1.vlcmod.value-form1.vlcopa.value;
     //form1.vlnet.value=Math.round(form1.vlnet.value/100)*100;
     form1.vlnet2.value=form1.subtotal.value-form1.vldescu.value-form1.vlcmod.value-form1.vlcopa.value;
     //form1.vlnet2.value=Math.round(form1.vlnet2.value/100)*100;
}

function calculacop(){
  form1.vlcopa.value=form1.subtotal.value*(form1.copago.value/100);
  form1.vlcopa.value=Math.round(form1.vlcopa.value/10)*10;
  calcular();
}

function calculacop2(){
  form1.copago.value=0;
  calcular();
}

function finaliza() {
  form1.action='fac_2guardafin.php';
  form1.submit();
}

function previo() {
  form1.target='fr03';
  form1.action='fac_2previo.php';
  form1.submit();
}

function cerrar(idfac,fecf_){
  if(confirm("Recuerde que al cerrar la factura genera el consecutivo y no podr ser modificada\n\nDesea cerarr la factura?")){      
    //form1.cerrarfac.value='S';
    //form1.action='fac_2guardafin.php';
    //form1.submit();
    window.open('fac_3captufecha.php?iden_fac='+idfac+'&fecf_fac='+fecf_,'blank','left=300,top=300,width=200,height=230,toolbar=0,location=0,scrollbars=0');
  }
}
</script>
</head>
<body>
<form name="form1" method="POST" action="fac_2detfactu.php" target='fr02'>
<link rel="stylesheet" href="css/style.css" type="text/css" />
<?
		include('php/conexion.php');
		include('php/funciones.php');
		$consulta= mysql_query("SELECT u.CODI_USU,u.NROD_USU, u.PNOM_USU, u.SNOM_USU, u.PAPE_USU, u.SAPE_USU, u.FNAC_USU,
								ef.iden_fac, ef.tipo_fac, ef.feci_fac, ef.fecf_fac, ef.codi_usu, ef.iden_ctr, ef.cod_cie10, ef.esta_fac, ef.vtot_fac,  ef.pcop_fac,ef.vcop_fac,  ef.pdes_fac,ef.cmod_fac,ef.vnet_fac,  ct.iden_ctr, ct.nume_ctr  
								FROM encabezado_factura as ef
								INNER JOIN usuario as u ON u.CODI_USU=ef.codi_usu
								INNER JOIN contratacion as ct ON ct.iden_ctr=ef.iden_ctr 
								WHERE ef.iden_fac='$iden_fac'");
		$row = mysql_fetch_array($consulta);
		$cmod_fac=$row[cmod_fac];
        $fecf_fac=$row[fecf_fac];
		echo"<table class='Tbl0' > ";
		echo "<tr>
				<td><input type=hidden name=iden_fac value=$iden_fac><td>
				<td class='Td2'><strong>Nombre:</strong> $row[PNOM_USU] $row[SNOM_USU] $row[PAPE_USU] $row[SAPE_USU]</td>
				<td class='Td2'><strong>Edad:</strong> ".calculaedad($row[FNAC_USU])."</td>
				<td class='Td2'><strong>Fecha Inicio:</strong> ".cambiafechadmy($row[feci_fac])."</td>
				<td class='Td2'><strong>Fecha Final:</strong> ".cambiafechadmy($row[fecf_fac])."</td>
				<td class='Td2'><strong>Contratacin:</strong> $row[nume_ctr]</td></tr></table>";

		if(empty($total)){
		  $total=$row[vtot_fac];}
		$disp='';
		if($row[esta_fac]=='2'){
		  //Si la factura esta cerrada, se inactivan los campos de texto
		  $disp="disabled='true'";
		}
		echo "<table class='Tbl0' ><th class='Th0'>VALORES TOTALES</th></table>";
		echo "<table class='Tbl0' border=0 align=center>";
		echo "<tr><td class='Td2' width='50%' align=right>SUBTOTAL:</td>";
		echo "<td class='Td2' width='50%'><input type=hidden name=subtotal value=$total>$total </td></tr>";
		echo "<tr><td class='Td2' width='50%' align=right>% COPAGO</td>";
		echo "<td class='Td2' width='50%' ><input type=text name=copago onchange='calculacop()' size='4' maxlength='4' value=$row[pcop_fac] $disp></td></tr>";
		echo "<tr><td class='Td2' width='50%' align=right>VALOR COPAGO</td>";
		echo "<td class='Td2' width='50%'><input type=text name=vlcopa  size='7' maxlength='7' onchange='calculacop2()' value=$row[vcop_fac]></td></tr>";
		echo "<tr><td class='Td2' width='50%' align=right>% DESCUENTO</td>";
		echo "<td class='Td2' width='50%'><input type=text name=descu  onblur='calcular()' size='4' maxlength='4' value=$row[pdes_fac] $disp></td></tr>";
		echo "<tr><td class='Td2' width='50%' align=right>VALOR DESCUENTO</td>";
		echo "<td class='Td2' width='50%'><input type=text name=vldescu  size='9' maxlength='9'></td></tr>";
		echo "<tr><td class='Td2' width='50%' align=right>VALOR CUOTA MODERADORA</td>";
		echo "<td class='Td2' width='50%'><input type=text name=vlcmod onblur='calcular()' size='5' maxlength='5' value='$cmod_fac' $disp></td></tr>";
		echo "<tr><td class='Td2' width='50%' align=right>VALOR NETO</td>";
		echo "<td class='Td2' width='50%'><input type=text name=vlnet  size='9' maxlength='9'></td></tr>";
		echo "</tr><input type=hidden name=vlnet2 size='9' maxlength='9'></table>";						
		?>
		<script language=JavaScript>
			form1.vldescu.disabled=true;
			form1.vlnet.disabled=true;
			calcular();
		</script>
	<table class='Tbl2'>
    <tr>
	  <?
	    if($row[esta_fac]=='2'){
                echo "<td class='Td1' width='35%'><img hspace=0 width=20 height=20 src='icons\feed_disk.png' alt='Guardar' border=0 align='center'>Guardar</td>";
                echo "<td class='Td1' width='30%'><a href='#' onclick='previo()'><img hspace=0 width=20 height=20 src='icons\listado.gif' alt='Visualiza' border=0 align='center'>Previsualizacin</a></td>";
                echo "<td class='Td1' width='35%'><img hspace=0 width=20 height=20 src='icons\feed_key.png' alt='Cerrar Factura' border=0 align='center'>Cerrar Factura</td>";
            }
            else{
                echo "<td class='Td1' width='35%'><a href='#' onclick='finaliza()'><img hspace=0 width=20 height=20 src='icons\feed_disk.png' alt='Guardar' border=0 align='center'>Guardar</a></td>";
                echo "<td class='Td1' width='30%'><a href='#' onclick='previo()'><img hspace=0 width=20 height=20 src='icons\listado.gif' alt='Visualiza' border=0 align='center'>Previsualizacin</a></td>";
                echo "<td class='Td1' width='35%'><a href='#' onclick='cerrar($iden_fac,$fecf_fac)'><img hspace=0 width=20 height=20 src='icons\feed_key.png' alt='Cerrar Factura' border=0 align='center'>Cerrar Factura</a></td>";
            }
	  ?>
    </tr>
	</table>
	<input type='hidden' name='cerrarfac' value='N'>
</form>
</body>
</html>
