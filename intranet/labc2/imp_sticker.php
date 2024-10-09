<html>
<head>
<title></title>
<link rel="stylesheet" href="css/style.css" type="text/css" />
<table class="Tbl0">
   <tr><td class="Td1" align='center'><STRONG>IMPRESION DE STICKER</strong></td></tr>
 </table>
<SCRIPT LANGUAGE='JavaScript'>
function cambiar()
{		
		color=form1.clr_imp.value;
		alert("El número de Orden es:\n".color);
		
		
}
function imprimir()
{	
	
	cod=form1.cod.value;
	nord_lab=form1.nord_lab.value;
	form1.action='sticker_.php';
	form1.target='fr22';
	form1.submit();
	
	/*m=form1.m.value;
	color="uno.clr_imp"+j+".value";
	clr_imp=eval(color)
	window.open("sticker_.php?cod="+cod+"&nord_lab="+nord_lab+"&m="+m+"&clr_imp"=+clr_imp, "TOP", "Scrollbars=YES,height=200,width=100,left=50,top=50")*/
		
}
function regresar2()
{		
		
		form1.target='';
		form1.action='principal.php';
		form1.submit();	
		
}


</script>
<form name="form1" method="POST" >
<body>


<?
	
	include('php/conexion.php');
	include('php/funciones.php');
	echo "<input type=hidden name=cod value=$cod>";
	echo "<input type=hidden name=nord_lab value=$nord_lab>";
	
	$consulta=mysql_query("SELECT  us.NROD_USU, us.CODI_USU, us.PNOM_USU, us.SNOM_USU, us.PAPE_USU, us.SAPE_USU,us.FNAC_USU,el.iden_labs,el.dxo_labs,dl.nord_dlab
				FROM detalle_labs AS dl
				INNER JOIN encabezado_labs AS el ON el.iden_labs = dl.iden_labs
				INNER JOIN usuario AS us ON us.codi_usu = el.codi_usu
				WHERE el.CODI_USU= '$cod' AND dl.nord_dlab='$nord_lab' ");
				
	$row_=mysql_fetch_array($consulta);
				
		
		$nord_dlab=$row_[nord_dlab];
		$nrod_usu=$row_[NROD_USU];
		$nom_usu=$row_[PNOM_USU].' '.$row_[SNOM_USU].' '.$row_[PAPE_USU].' '.$row_[SAPE_USU];
		$edad=calculaedad($row_[FNAC_USU]);
		$dx=$row_[dxo_labs];
		$iden_labs=$row_[iden_labs];
		echo"<table width=70%>";
		echo"<tr>";
		echo"<td class=Th0 align='center'><STRONG>Orden</strong></td>";
		echo"<td class=Th0 align='center'><STRONG>Identificacion</strong></td>";
		echo"<td class=Th0 align='center'><STRONG>Nombre</strong></td>";
		echo"<td class=Th0 align='center'><STRONG>Edad</strong></td>";
		echo"<td class=Th0 align='center'><STRONG>Dx</strong></td>";
		echo"</tr>";
			
		echo"<tr><td class=Th0 align='center'>$nord_dlab</strong></td>";
		echo"<td class=Th0 align='center'>$nrod_usu</strong></td>";
		echo"<td class=Th0 align='center'>$nom_usu</strong></td>";
		echo"<td class=Th0 align='center'>$edad</strong></td>";
		echo"<td class=Th0 align='center'>$dx/$iden_labs</strong></td>";
		echo"</tr>";
	
	
	$consulta2=mysql_query("SELECT cups.grup_quim, destipos.nomb_des
	FROM (detalle_labs INNER JOIN cups ON detalle_labs.codigo = cups.codigo) INNER JOIN destipos ON cups.grup_quim = destipos.codi_des
	WHERE detalle_labs.iden_labs='$iden_labs' AND detalle_labs.nord_dlab='$nord_lab' AND cups.esta_cup='AC'
	GROUP BY cups.grup_quim, destipos.nomb_des");
	
	//echo $consulta2;
	
	echo "<table  width='70%'>
    <tr><td class='Td1'width='1%'><br></td>	
	<td class='Td1' width='14%'>Examen</td>
	<td class='Td1' width='3%'>Order</td>
	<td class='Td1' width='3%'>Color</td>
	</tr>";
	echo "<br>";
	$con_cuenta=mysql_query("Select detalle_labs.codigo FROM detalle_labs as detalle_labs
			WHERE detalle_labs.iden_labs='$iden_labs' AND detalle_labs.nord_dlab='$nord_lab'  ");
	$cuenta=mysql_num_rows($con_cuenta);
	$m=0;
	while($rowx_=mysql_fetch_array($consulta2))
	{
		echo"<tr>";
		echo"<td class='Td1' colspan=6>$rowx_[nomb_des]</td></tr>";
			
		$grup=$rowx_[grup_quim];
	   
	   $conexa=mysql_query("SELECT cups.descrip,destipos.val2_des,cups.prep_cup
		FROM (detalle_labs INNER JOIN cups ON detalle_labs.codigo = cups.codigo) INNER JOIN destipos ON cups.grup_quim = destipos.codi_des
		WHERE detalle_labs.iden_labs='$iden_labs' AND detalle_labs.nord_dlab='$nord_lab' AND  cups.grup_quim='$grup' AND cups.esta_cup='AC'
		GROUP BY cups.descrip");
           //echo $conexa;
		while($rowex=mysql_fetch_array($conexa))
		{
			
			$nomvar='descrip'.$m;
			$descrip=$rowex[descrip];
			
			echo"<tr><td><br></td>";
			echo"<td><input type=hidden name='$nomvar' value='$rowex[descrip]'>$rowex[descrip]</td>";
						
			$nomvar='ord_'.$m;
			$ord_imp=$$nomvar;
			
			echo"<td align='center'><select name='$nomvar' value='$ord_imp'>";
			echo"<option></option>";
			
			for($i=1;$i<=$cuenta;$i++)
			{
				echo"<option value=$i>$i</option>";
				
			}
			$nomvar='clr_imp'.$m;
			$clr_imp=$rowex[val2_des];
			
			echo"</td>";
			echo"<td align='left'><input type=hidden name='$nomvar' value='$clr_imp'>$clr_imp</td>";
			echo"</tr>";

			$nomvar='prep_cup'.$m;
			$prep_cup=$rowex[prep_cup];
			echo"<input type=hidden name='$nomvar' value='$prep_cup'>";
		
		
			$m++;	
		}
	
	
	}
	
	echo "<input type=hidden name=m value='$m'>";
	
?>	
</table>
<table class='Tbl2'>
    <tr>
	<td class='Td1' width='45%'><a href='#' onclick='imprimir()'><img  width=20 height=20 src='icons\regresar01.jpg' alt='Imprimir' border=0 align='center'>Vista Previa</a></td>
    <td class='Td1' width='45%'><a href='#' onclick='regresar2()'><img  width=20 height=20 src='icons\regresar01.jpg' alt='Regresar' border=0 align='center'>Regresar</a></td>
     </tr>
</table>

</form>
</body>
</html>
