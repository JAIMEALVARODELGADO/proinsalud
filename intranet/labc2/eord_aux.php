<html> 
<head> 
<title>INFORMACION PROINSALUD* </title> 
<style type="text/css">
<!--
.Estilo3{
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 11px; color: #333366;;
}
.Estilo1 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px;  color: #333366;},usu,dlab
.Estilo6 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px;  font-weight: bold; color: #333366;}

-->
</style>


<script language="javascript">
function eliminar(control,usu,dlab,dva)
{
	  
	   if (window.confirm("¿Desea Eliminar el Examen?")) 
	   {
		  form1.cont.value=control;
		 // form1.iden_labs.value=iden;
		  form1.iden_dlab.value=dlab;
		  form1.dva.value=dva;
		  form1.usu.value=usu;
		  form1.opc_aux.value=1;
		 // alert(form1.dva.value);
		  form1.action='eli_exq.php';
		  form1.submit();
		 
	   }
	
}

</script>
<link rel="stylesheet" href="css/style.css" type="text/css" />
</head> 
<body><hr align="center"width="100%">
<form name='form1' method="POST"  action="" target="fr2">  
<p align="center" class="Estilo6"><strong>
<?php

	$link=Mysql_connect("localhost","root","");
	if(!$link)echo"no hay conexion";
	Mysql_select_db('proinsalud',$link);
	
	echo"<table class='Tbl0'>
	<tr>
    <td class='Td1' align='center'>DATOS REFERENTES A LA ORDEN </td>
    </tr></TABLE>";
	
	echo"<input type=hidden name=iden_dlab>";
	echo"<input type=hidden name=cont>";
	echo"<input type=hidden name=usu>";
	echo"<input type=hidden name=dva>";
	echo"<input type=hidden name=iden_uco value=$iden_uco>";
	echo"<input type=hidden name=iden_labs value=$iden_labs>";
	echo"<input type=hidden name=opc_aux >";
	
	
	$result=mysql_query("SELECT detalle_labs.iden_dlab,detalle_labs.codigo, encabezado_labs.iden_labs,cups.descrip, encabezado_labs.codi_usu
	FROM cups
	INNER JOIN detalle_labs AS detalle_labs ON detalle_labs.codigo = cups.codigo
	INNER JOIN encabezado_labs AS encabezado_labs ON detalle_labs.iden_labs = encabezado_labs.iden_labs
	WHERE encabezado_labs.codi_usu=$iden_uco and encabezado_labs.iden_labs=$iden_labs AND detalle_labs.estd_dlab='P'");
	
	//echo $result;

	if(mysql_num_rows($result)<>0)
	{
	  echo"<table class='Tbl0' border=0>";
	  echo "<tr class='Td1' >
	  <td class='Td1' colspan=2><strong><center>Codigo</strong></td>
	  <td class='Td1' colspan=3><strong><center>Nombre</strong></td>
	  <td class='Td1' colspan=2width=15%><strong><center>Acción</strong></td></tr>";
	  while($row=mysql_fetch_array($result))
	  {
		$usu=$row[codi_usu];
		$num_ord=$row[nord_lab];
		$ide_lab=$row[iden_labs];
		$codi=$row[codigo];
		$dlab=$row[iden_dlab];
		echo"<tr bgcolor='ffffff' >
		<td bordercolor='#D0D0F0' align='center' colspan=2><span class='Estilo1'>".$row[codigo]."</span></td> 
		<td  bordercolor=#D0D0F0 colspan=3><span class='Estilo1'>".$row[descrip]."</span></td>
		<td  bordercolor=#D0D0F0  align='center' colspan=2><a href='#' onclick='eliminar(1,$usu,$ide_lab,$dlab)'><img src=icons/btn_remove-selected_bg.gif></a></td>";
		echo"</tr>";
	 }
	
	   
	echo"</table>";

}
else
{
	echo"<td bordercolor=#D0D0F0 align='center' colspan=7><span class='Estilo1'>La Identificacion no tiene facturas Pendientes </span></td>";
}

?>
	
</form>
</body>
</html>