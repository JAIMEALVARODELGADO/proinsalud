<html>
<head>
<title></title>
<SCRIPT LANGUAGE='JavaScript'>
function cargar()
{		
			form1.action='ing_cups2.php';
			form1.target='';
			form1.submit();
	
}


</script>
</head>
<link rel="stylesheet" href="css/style.css" type="text/css" />

 <table class="Tbl0">
   <tr><td class="Td1" align='center'><STRONG>INFORMACION DEL USUARIO</strong></td></tr>
 </table>


<form name="form1" method="POST" >
<body onload='cargar()'>
	
 <?
	
	$link=Mysql_connect("localhost","root","");
	if(!$link)echo"no hay conexion";
	Mysql_select_db('proinsalud',$link);
	
	include('php/funciones.php');
	//include('php/conexion.php');

	
	echo "<br><table class='Tbl0' border=1>";
	
	$conprc=mysql_query("SELECT iden_dlab,  iden_labs,  codigo,  cod_medi,  obsv_dlab,  refe_dlab,  unid_dlab  
	FROM detalle_labs  WHERE iden_labs='$iden_labs'");
	
	//$mcu=mysql_num_rows($conprc);
	$mcu=1;
	while($rowd=mysql_fetch_array($conprc))
	{
		$codi=$rowd['codigo'];
		$observ=$rowd['obsv_dlab'];
		$unlabcup=$rowd['unid_dlab'];
		$refercup=$rowd['refe_dlab'];
	
	
	
		echo"<tr>";
		$nomvar='selec'.$mcu;
		$selec=$$nomvar;
		echo"<td align=center><input type=hidden name=$nomvar value=1></td>";		
				
		$nomvar='cod'.$mcu;
		$cod=$$nomvar;	
		echo"<td width='15%'><input type=text name=$nomvar value=$codi></td>";
		
		$nomvar='obs'.$mcu;
		$obs=$$nomvar;
		echo"<td width='15%'><input type=text name=$nomvar value=$observ></td>";
		
		$nomvar='uni'.$mcu;
		echo"<td width='15%'><input type=text name=$nomvar value=$unlabcup></td>";
		
		$nomvar='ref'.$mcu;
		//$ref=$$nomvar;
		echo"<td width='15%'><input type=text name=$nomvar value=$refercup></td>";
		$mcu++;
	}
		echo "<input type=hidden name=mcu value=$mcu>";
		echo "<input type=text name=iden_labs value=$iden_labs>";
		echo "<input type=text name=codig_usu value=$codig_usu>";
		
		
		
	?>
<br><br>
<table class='Tbl2'>
    <tr>
      <!--<td class='Td1' width='45%'><a href='#' onclick='imprimir()'><img  width=20 height=20 src='icons\imp02.png' alt='Regresar' border=0 align='center'>Imprimir</a></td>-->
	  <td class='Td1' width='45%'><a href='#' onclick='imprimir()'>IMPRIMIR</a></td>
    </tr>
</table>
 <input type='hidden' name='cont' value='<?echo $cont;?>'> 
 <input type='hidden' name='format'>

 


</form>
</body>
</html>
