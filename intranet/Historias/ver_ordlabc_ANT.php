<?php 
session_start();
session_register('cod_usu');
if(!empty($cod)){$cod=$usu;}
else{  $cod=$usu;}


?>
<html> 
<head> 
<?	//Aqui cargo las funciones para php
	include("funciones.php");
?>
<title>INFORMACION USUARIOS *PROINSALUD* </title> 
<style type="text/css">
<!--
.Estilo11 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 11px; color: #333366;
}
.Estilo3 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; font-weight: bold; color: #333366; align=center}
-->
</style>
</head> 
<body ><hr align="center"width="100%">
<form name="Impresion De Los Datos Del Usuario" method="POST"  action="adi_espe.php" target="fr2">  
<p align="center" class="Estilo6"><strong>
<?php
	$cod_usu=$usu;
	//echo"iden:'.$cod_usu'";
	//echo"iden:'$usu'";
	//selección de la base de datos con la que vamos a trabajar 
	mysql_connect("localhost","root",""); 
	mysql_select_db("PROINSALUD");
	
	$resultusu =mysql_query("SELECT usuario.NROD_USU, contrato.CODI_CON, usuario.CODI_USU, usuario.PNOM_USU, usuario.SNOM_USU, usuario.PAPE_USU, usuario.SAPE_USU, usuario.FNAC_USU, usuario.SEXO_USU, usuario.TPAF_USU, usuario.MATE_USU, ucontrato.CONT_UCO, contrato.NEPS_CON, ucontrato.IDEN_UCO, usuario.MRES_USU
	FROM (factura INNER JOIN datos_inter ON factura.num_fac = datos_inter.num_fac) INNER JOIN ((usuario INNER JOIN ucontrato ON usuario.CODI_USU = ucontrato.CUSU_UCO) INNER JOIN contrato ON ucontrato.CONT_UCO = contrato.CODI_CON) ON datos_inter.cod_usua = usuario.NROD_USU
	WHERE factura.cod_usu = '$usu' AND factura.cod_usu = usuario.`NROD_USU` and usuario.CODI_USU=ucontrato.CUSU_UCO AND ucontrato.CONT_UCO=contrato.CODI_CON GROUP BY factura.num_fac");
	//ECHO $resultusu;
	if (mysql_num_rows($resultusu)<>0)
	{
	
	$rowusu=mysql_fetch_array($resultusu);
	
	$edad=calculaedad($rowusu['FNAC_USU']);
	$nombre= "$rowusu[PNOM_USU] $rowusu[SNOM_USU]  $rowusu[PAPE_USU]";
	$sexo=" $rowusu[SEXO_USU]";
	$mres_usu ="$rowusu[MRES_USU]";
	$contrato="$rowusu[NEPS_CON]"; 
	echo"<table width=600 border=1 align=center>
	<tr bgcolor=#D0D0F0><td><span class=Estilo3> $nombre</span>
	<td ><span class=Estilo3> $sexo</span>
	<td ><span class=Estilo3> $edad</span>
	<td ><span class=Estilo3>$mres_usu </span>
	<td ><span class=Estilo3>$contrato</span></td></tr>";

	$result = mysql_query("SELECT factura.num_fac, factura.mine, factura.cod_usu, factura.cod_emp, factura.nom_med, datos_inter.nom_usua
	FROM datos_inter INNER JOIN factura ON datos_inter.num_fac = factura.num_fac
    WHERE factura.cod_usu = '$usu'  GROUP BY factura.num_fac ORDER BY factura.mine DESC");
	
	// recorrido del array
   echo"<table width=600 border=1 align=center>";
	echo "<tr bgcolor=#FFFFFF height='15'><th bgcolor='#D0D0F0' colspan='7'><span class='Estilo3'>LISTADO DE EXAMENES REALIZADOS</th></span></tr>
		  <tr bgcolor=#FFFFFF height='15'>
		  <td><span class='Estilo3' align=center>Opciones</span></td>
		  <td><span class='Estilo3'>Norden</span></td>
		  <td><span class='Estilo3'>Fecha De Realización</span></td>
		  <td><span class='Estilo3'>Médico Solicitante</span></td></tr>"; 
	
	while ($rowx = mysql_fetch_array($result))
    {
	
		echo "<tr><td>$field->buscar</td> \n";
		echo "</tr> \n";
 //echo"$num_fac";
        //echo"$rowx[num_fac]";
		 
		echo"<tr bgcolor=#FFFFFF class=Estilo11 align=center>";
		/*<td><a href=edit_examen.php?cod_usu=$usu&num_fac=$rowx[num_fac]><img src='icons/edit.png' border=0 width=20 height=20 alt='Editar' ></a>
		<td><a href=frm_agrega.php?cod=$usu&nume_fa=$rowx[num_fac] target=fr2><img src='icons/adicionar.png' border=0 width=20 height=20 alt='Adicionar' ></a>
		<td><a href=exp_fac.php?cod=$usu&fac_num=$rowx[num_fac]><img src='icons/eliminar.png' border=0 width=20 height=20 alt='Eliminar'></a>*/
	    echo "<td><a href=imphis_labc.php?cod=$usu&fac_num=$rowx[num_fac]><img src='icons/imp02.png' border=0 width=20 height=20 alt='Imprimir' ></a>
	    <td><span bgcolor=#FFFFFF>$rowx[num_fac]<input  type=hidden name=fac_num value='$rowx[num_fac]'>
	    <td ><span bordercolor=#D0D0F0 bgcolor=#FFFFFF>$rowx[mine]
	 	<td ><span bordercolor=#D0D0F0 bgcolor=#FFFFFF>$rowx[nom_med]<input  type=hidden name=nom_medi value='$rowx[nom_med]'></td>
        </tr>";
	}
    echo" </table>";
	}
else{
   echo "<tr bgcolor=ffffff class=Estilo11 ><td colspan=2><strong>No Existen Examenes - Realizados a $usu </strong></td></tr>";
}
	//echo"$rowx[cod_usu]<input  type=text name=NROD_USU value='$usu'><input  type=text name=cod_empr value='$rowx[cod_emp]'>";
    //echo"$rowx[PNOM_USU] $rowx[SNOM_USU] $rowx[PAPE_USU] $rowx[SAPE_USU]";
	//echo "<tr bgcolor=ffffff class=Estilo1 >	  <td colspan=2><strong>No existen Examenes - Realizados a $usu </strong></td></tr>";
	 mysql_free_result($result);
	 mysql_free_result($resultusu);
	 mysql_close();
?>
	
</form>
</body>
</html>