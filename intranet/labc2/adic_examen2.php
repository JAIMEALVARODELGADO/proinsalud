<?
session_register('gcod_usu');
session_register('gfac_num');

?>
<html>
<head>
<style type="text/css">
<!--
.Estilo11 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 11px; color: #333366;
}
.Estilo3 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 10px; font-weight: bold; color: #333366;}
-->
</style>
<SCRIPT language='JavaScript'>
function enviar(){
  form1.action='bus_labs.php';
  form1.submit();
}
</script>
<SCRIPT language='JavaScript'>
function validag()
{
var error='';
if(form1.obs_exa.value==''){error=error+'Observaciones\n'}
if(error!=''){alert("Para guardar debe llenar la siguiente información\n\n"+error);}
else{
  form1.action='lab_2add.php';
  form1.submit();
}
}
function validacod(){
  form1.submit();
}
function imprimir(cod,fac){
  
 parent.location.href='anul_sess.php?cod='+cod+'&nume_fact='+fac;
}

</script>
</head>
<body>
<form name="form1" method="POST" action="adic_examen2.php" target='fr02'>
<?
		mysql_connect("localhost","root",""); 
		mysql_select_db("PROINSALUD");

		
		$consulta= mysql_query("SELECT num_fac,cod_usua,cod_exame, nom_examen, obs_examen, uni_examen, ref_examen FROM datos_inter WHERE num_fac='$gfac_num'");
		echo "<table border=1><tr>";
	    echo "<td class='Estilo3'>CODIGO</td>
			  <td class='Estilo3'>DESCRIPCION</td>
			  <td class='Estilo3'>OBSERVACIONES</td>
			  <td class='Estilo3'>UNIDADES</td>
			  <td class='Estilo3'>REFERENCIA</td></tr>";
				
		while ($rowdet=mysql_fetch_array($consulta))

		{
			//echo "<tr><td class='Estilo3'><input name=codchk type=checkbox onclick=\"location.href='qui_2edescir.php?cod1_cup=$row[codigo]'\"></td>";
			echo "<td class='Estilo11'>$rowdet[cod_exame]</td>";
			echo "<td class='Estilo11'>$rowdet[nom_examen]</td>";
			echo "<td class='Estilo11'>$rowdet[obs_examen]</td>";
			echo "<td class='Estilo11'>$rowdet[uni_examen]</td>";
			echo "<td class='Estilo11'>$rowdet[ref_examen]</td></tr>";
			$codigo=$rowdet[cod_usua];
			
		}
	    echo "<td class='Estilo11'><input type=text name='codi_cir' size=6 maxlength=6 onblur='validacod()' value=$codi_cir>";
		echo "<a href='#' onclick='enviar()'><img hspace=0 width=15 height=15 src='icons\bus.gif' alt='Buscar' border=0 align='center'></a></td>";
		echo "<td class='Estilo11'>";
		$consmap=mysql_query("SELECT iden_tar, codigo, descrip,tipo,refe_cup,unlab_med FROM cups WHERE codigo='$codi_cir'");
		$row=mysql_fetch_array($consmap);
	    echo "<input type=hidden name=nom_exa value='$row[descrip]'>$row[descrip]</td>";
		echo "<td class='Estilo11' aling='center'><input type=text name=obs_exa size=6   value='$obs_exam'></td>";
		echo "<td class='Estilo11'><input type='text' name=refe_cup size=10 value ='$row[refe_cup]'>";
		//<input type=text name=valuni value='$row[valo_tco]' disabled></td>
		echo "<td class='Estilo11'><input type=text name=unlab_med  size=10 value='$row[unlab_med]'></td>";
		echo "</tr></table>";
		
?>
	<table class='Estilo11'>
    <tr>
      <td class='Estilo11' width='45%'><a href='#' onclick='validag()'><img hspace=0 width=20 height=20 src='icons\feed_disk.png' alt='Guardar' border=0 align='center'> Guardar</a></td>
	 <?echo"<td class='Estilo11' width='45%'><a href='#' onclick='imprimir($codigo,$gfac_num)'><img hspace=0 width=20 height=20 src='icons\feed_disk.png' alt='Guardar' border=0 align='center'> Imprimir</a></td>";?>
    </tr>
	</table>
	
	
</form>
</body>
</html>

