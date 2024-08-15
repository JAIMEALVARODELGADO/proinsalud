<html>
<head>
</head>
<body>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"><style type="text/css">
<style type="text/css">
<!--
.Estilo6 {font-family: Arial, Helvetica, sans-serif; font-size: 11px; font-weight: bold; color: #333366 }
.Estilo7 {font-family: Arial, Helvetica, sans-serif; font-size: 11px; color: #333366; }
-->
</style>
<script language='javascript'>

function cargar(op)
{
	//alert(op);
	form1.opcex.value=op;
	form1.target='';
	form1.action='camb_exa.php';
	form1.submit();	

}
function cargar2(op,fj)
{
	//alert(op);
	form1.oplb2.value=fj
	form1.opcex.value=op;
	form1.target='';
	form1.action='camb_exa.php';
	form1.submit();	

}

</script>
<form name='form1' target="fr2">
<link rel="stylesheet" href="css/style.css" type="text/css" />
<?
	//echo $iden_labs;
	
	include('php/funciones.php');
		
	$link=Mysql_connect("localhost","root","");
	if(!$link)echo"no hay conexion";
	Mysql_select_db('proinsalud',$link);
	
	echo"<input type=hidden name=iden_uco value=$iden_uco>";
	echo"<input type=hidden name=iden_labs value=$iden_labs>";
	echo"<input type=hidden name=nord_lab value=$nord_lab>";
	
	echo "<table class='Tbl0'>";
	echo "<tr><td class='Th0' width='15%'><strong>IDENTIFICACION</td>
		      <td class='Th0' width='50%'><strong>NOMBRE</td>
			  <td class='Th0' width='10%'><strong>EDAD</td>
			  <td class='Th0' width='10%'><strong>SEXO</td>
			  <td class='Th0' width='15%'><strong>CONTRATO</td></tr>";
	
	$conusu =mysql_query("SELECT NROD_USU,CODI_CON,CODI_USU, PNOM_USU, SNOM_USU, PAPE_USU, SAPE_USU, FNAC_USU, SEXO_USU,
					   TPAF_USU,CONT_UCO,NEPS_CON,IDEN_UCO,CUSU_UCO FROM usuario, ucontrato,contrato WHERE CODI_USU=CUSU_UCO AND CONT_UCO=CODI_CON 
					   AND CUSU_UCO ='$iden_uco'");
	//echo $conusu;
	
	$rowu = mysql_fetch_array($conusu);
	echo "<input type=hidden name=iden_uco value=$iden_uco>";
	echo"<input type=hidden name=fac_num value='$fac_num'>";
	$giden_uco=$rowu['IDEN_UCO'];
	echo "<tr><td class='Td4'>$rowu[NROD_USU]</td>";
	echo"<input type=hidden name=area value=$area>";
	echo"<input type=hidden name=ide_cita value=$ide_cita>";
	$nombre= $rowu[PNOM_USU]." ".$rowu[SNOM_USU]." ".$rowu[PAPE_USU]." ".$rowu[SAPE_USU];
	echo"<td class='Td4'>$nombre</td>";
	$edad=calculaedad($rowu['FNAC_USU']);
	echo"<td class='Td4'>$edad</td>
	<td class='Td4'>$rowu[SEXO_USU]</td>
	<td class='Td4'>$rowu[NEPS_CON]</td></tr></table>";

	
	
	
	
	
	
	
	echo"<table class='Tbl0'>
	<tr>
    <td class='Td1' align='center'>FORMATOS DE LA ORDEN </td>
    </tr></TABLE>";
	
	echo"<br><table width=80% height=20 border=1 align=left cellspacing=1 bordercolor=#BED1DB bgcolor=#FFFFFF>";
	echo "<tr class='Td1' >
	<td class='Td1' width=15%><strong><center>Codigo</strong></td>
	<td class='Td1'><strong><center>Nombre</strong></td>
	<td class='Td1' width=15%><strong><center>Acción</strong></td></tr>";
 
	$conex_=mysql_query("SELECT dl.iden_dlab ,dl.iden_labs,dl.estd_dlab,dl.codigo,dl.nord_dlab,cp.descrip,
			dl.obsv_dlab, dl.refe_dlab,dl.unid_dlab  
		    FROM detalle_labs AS dl
			INNER JOIN cups AS cp ON cp.codigo=dl.codigo
		    WHERE dl.iden_labs=$iden_labs AND dl.estd_dlab<>'EL'");
			
	if (mysql_num_rows($conex_)<>0)
	{		
		
		echo "<tr> <td><span class='Estilo7'>------</span></td>";
		echo "<td><span class='Estilo7'>Otros Examenes</span></td>";
		//echo "<td><span class='Estilo7'></span></td>";
		echo "<td><span class='Estilo7'><a href=# onclick='cargar(21)'><img src=icons/i_yes.gif></a></td>";
		echo"</tr>";
		
	}  






	
	   
	 // $conenc="SELECT iden_dlab,  iden_labs   FROM detalle_labs WHERE iden_labs='$iden_labs' AND ";
	 // echo $conenc;
	  
	  ///consulta en Coprologico
	  $consulta1=mysql_query("SELECT c.iden_dlab,c.cod_examen,c.cod_usu, c.num_fac  FROM coprol c WHERE  c.iden_dlab='$iden_labs'");
	  if ($rowx=mysql_fetch_array($consulta1))
	  {
		
		echo"<tr>
	    <td> <span class='Estilo7'>".$rowx["cod_examen"]."</span></td>
		<td><span class='Estilo7'>FORMATO COPROLOGICOS</span></td>
	    <td><span class='Estilo7'><a href=# onclick='cargar(3)'><img src=icons/i_yes.gif></a></span></td></tr>";
	  
	   }
	   ///Consulta  Espermograma
	   $consulta2=mysql_query("SELECT e.iden_dlab,e.num_fac,e.cod_exames,e.cod_usu FROM esper e WHERE e.iden_dlab='$iden_labs'");
	   
	   if ($rowxx=mysql_fetch_array($consulta2))
	  {
	   
	   echo"<tr>
	   <td><span class='Estilo7'>".$rowxx["cod_exames"]."</span></td>
	   <td><span class='Estilo7'>FORMATO ESPERMOGRAMA</span></td>
	   <td><span class='Estilo7'><a href=# onclick='cargar(6)'><img src=icons/i_yes.gif></a></tr>";
		}
	   
	   ///Consulta Cuadro Hematico
	   $consulta3=mysql_query("SELECT h.iden_dlab,h.num_fac,h.cod_examch ,h.cod_usu FROM cuadroh h WHERE h.iden_dlab='$iden_labs'");
	   if  ($rowxxx=mysql_fetch_array($consulta3))
	  {
	   echo "<tr>
	   <td ><span class='Estilo7'>".$rowxxx["cod_examch"]."</span></td>
	   <td><span class='Estilo7'>FORMATO CUADRO HEMATICO</span></td>
	   <td><span class='Estilo7'><a href=# onclick='cargar(4)'><img src=icons/i_yes.gif></a></tr>";
		}
	   ///Consulta Frotis Vaginal	   
	   $consulta4=mysql_query("SELECT fr.iden_dlab,fr.num_fac,fr.cod_examen ,fr.cod_usu FROM frotis fr WHERE fr.iden_dlab='$iden_labs'");
	   if ($rowx4=mysql_fetch_array($consulta4))
	   {
		echo"<tr>
		   <td ><span class='Estilo7'>".$rowx4["cod_examen"]."</span></td>
		   <td ><span class='Estilo7'>FORMATO FROTIS VAGINAL</span></td>
		   <td ><span class='Estilo7'><a href=# onclick='cargar(2)'><img src=icons/i_yes.gif></a></tr>";
		}
		
	   ///Consulta hcg	   
	   
	   $consulta5=mysql_query("SELECT hc.iden_dlab, hc.num_fac,hc.cod_examen ,hc.cod_usu FROM hcg hc WHERE hc.iden_dlab='$iden_labs'");
		//echo $consulta5;
	   if ($rowx5=mysql_fetch_array($consulta5))
	  {

	   echo "<tr>
	   <td ><span class='Estilo7'>".$rowx5["cod_examen"]."</span></td>
	   <td ><span class='Estilo7'>FORMATO MUJERES EN EMBARAZO</span></td>
	   <td ><span class='Estilo7'><a href=# onclick='cargar(7)'><img src=icons/i_yes.gif></a></a></tr>";
	   
	  }
	  	  
	  ///Consulta Uroanalisis	   
	   
	   $consulta6=mysql_query("SELECT u.iden_dla,u.num_fac,u.cod_examen ,u.ced_usu FROM uroana u WHERE u.iden_dla='$iden_labs' AND `esta_ord`<>'EL'");
		//echo $consulta6;
	  if ($rowx6=mysql_fetch_array($consulta6))
	  {

	   echo "<tr>
	   <td ><span class='Estilo7'>".$rowx6["cod_examen"]."</span></td>
	   <td ><span class='Estilo7'>FORMATO UROANALISIS</span></td>
	   <td ><span class='Estilo7'><a href=# onclick='cargar(1)'><img src=icons/i_yes.gif></a></span></td></tr>";
	  }

	 ///Consulta Liquidos	   
	   
	   $consulta7=mysql_query("SELECT iden_lqd,  iden_dlab,  num_fac,  cod_usu   FROM labo_lqd  WHERE iden_dlab='$iden_labs'");
	   if ($rowx7=mysql_fetch_array($consulta7))
	  {

	   echo "<tr>
	   <td ><span class='Estilo7'>900000</span></td>
	   <td ><span class='Estilo7'>FORMATO LIQUIDOS</span></td>
	   <td ><span class='Estilo7'><a href=# onclick='cargar(9)'><img src=icons/i_yes.gif></a></span></td></tr>";
	  }
	  ///Consulta Datos Varios	   
	   
	  $consulta8=mysql_query("SELECT `iden_dlab`, `fec_rec`, `fec_ent`, `cod_usu`, `cod_examvr`, `datos` FROM `dat_varios` WHERE `iden_dlab`='$iden_labs' ");
	  //echo $consulta8;
	  if ($rowx8=mysql_fetch_array($consulta8))
	  {
	
		 echo"<tr>
		 <td ><span class='Estilo7'>".$rowx8["cod_examvr"]."</span></td>
		 <td ><span class='Estilo7'>FORMATO CUADRO VARIOS</span></td>
		 <td ><span class='Estilo7'><a href=# onclick='cargar(5)'><img src=icons/i_yes.gif></a></tr>";
	  } 
	  
	 ///Consulta Datos BHC	 
	$consulta9=mysql_query("SELECT bh.iden_dlab, bh.num_fac, bh.cod_exam, bh.cod_usu, bh.fec_rec, bh.fec_ent, bh.lab_bhc FROM labo_bhc bh where bh.iden_dlab='$iden_labs'");
	
	if ($rowx9=mysql_fetch_array($consulta9))
	{
		//echo "<Table border=1 BgColor=#FFFFFF BorderColor=#E6E8FA width=806 align=center cellpadding=0 Cellspacing=1>";
		 echo"<tr>
		 <td ><span class='Estilo7'>".$rowx9["cod_exam"]."</span></td>
		 <td ><span class='Estilo7'>FORMATO BHCG</span></td>
		<td ><span class='Estilo7'><a href=# onclick='cargar(10)'><img src=icons/i_yes.gif></a></tr>";
    }
	 
	 
	/////Consulta Datos inmunologicos	 
	$consulta10=mysql_query("SELECT inm.iden_dlab, inm.cod_exam, inm.cod_usu, inm.fec_rec, inm.fec_ent, inm.inmu_rac, inm.inmu_rau, inm.inmu_pcc, inm.inmu_pcu, inm.inmu_asc, inm.inmu_asu, inm.inmu_tioc,
	inm.inmu_tiou, inm.inmu_tihc, inm.inmu_tihu, inm.inmu_pac, inm.inmu_pau, inm.inmu_pbc, inm.inmu_pbu, inm.inm_btc, inm.inm_btu, inm.inm_ptc, inm.inm_ptu
	FROM labo_inm inm where inm.iden_dlab='$iden_labs'");
	
	if ($rowx10=mysql_fetch_array($consulta10))
	{
	
	 echo "<tr>
	 <td ><span class='Estilo7'>".$rowx10["cod_exam"]."</span></td>
	 <td ><span class='Estilo7'>FORMATO INMUNOLOGICOS</span></td>
	 <td ><span class='Estilo7'><a href=# onclick='cargar(8)'><img src=icons/i_yes.gif></a></tr>";
	
	}
	
	
	/////Consulta Datos inmunologicos
	$consulta12=mysql_query("SELECT trm.iden_dlab, trm.cod_exam, trm.cod_usu, trm.fec_rec, trm.fec_ent, trm.lab_trim  FROM labo_tri trm where trm.iden_dlab='$iden_labs'"); 
	
	if ($rowx12=mysql_fetch_array($consulta12))
	{
	
	 echo"<tr>
	 <td ><span class='Estilo7'>".$rowx12["cod_exam"]."</span></td>
	 <td ><span class='Estilo7'>FORMATO TRIMITROPINA</span></td>
	 <td ><span class='Estilo7'><a href=# onclick='cargar(11)'><img src=icons/i_yes.gif></a></tr>";
	
	}
	 
	
	////////////////////Datos  de otros examenes
	
	$consulta13=mysql_query("SELECT iden_loex,  iden_dlab,  num_fac,  cod_loex,  cod_usu FROM labo_oexa WHERE iden_dlab='$iden_labs'"); 
	if ($rowx13=mysql_fetch_array($consulta13))
	{
	
	 echo"<tr>
	 <td ><span class='Estilo7'>------</span></td>
	 <td ><span class='Estilo7'>FORMATOS ESPECIALES</span></td>
	 
	 <td ><span class='Estilo7'><a href=# onclick='cargar(12)'><img src=icons/i_yes.gif></a></tr>";
	
	}
	////////////////////EXTENDIDO DE SANGRE PERIFERICA
	$consulta14=mysql_query("SELECT iden_dlab , num_fac, cod_usu FROM labo_sgre WHERE iden_dlab='$iden_labs'"); 
	if ($rowx14=mysql_fetch_array($consulta14))
	{
	
	 echo"<tr>
	 <td ><span class='Estilo7'>902206</span></td>
	 <td ><span class='Estilo7'>EXTENDIDO DE SANGRE</span></td>
	 
	 <td ><span class='Estilo7'><a href=# onclick='cargar(13)'><img src=icons/i_yes.gif></a></tr>";
	
	}
	/////Consulta Datos Alcohol////////////////////////////
	$consulta15=mysql_query("SELECT `ide_oex2`,`iden_dlab` ,`tipo_mue` ,`num_mue` , `esta_mue` , `valo_mue`,`est_oex2` 
			FROM labo_oex2 WHERE `iden_dlab`='$iden_labs'");
	if(mysql_num_rows($consulta15)<>0)
	{
		$i=1;
		while($rowsgr= mysql_fetch_array($consulta15))
		{
			$valo_mue=$rowsgr["valo_mue"];
			$nom_var='valo_mue'.$i;
			echo "<input type=hidden name='$nom_var' value='$valo_mue'>";	
			$esta_mue=$rowsgr["esta_mue"];
			$nom_var='esta_mue'.$i;
			echo "<input type=hidden name='$nom_var' value='$esta_mue'>";
			$num_mue=$rowsgr["num_mue"];
			$nom_var='num_mue'.$i;
			echo "<input type=hidden name='$nom_var' value='$num_mue'>";
			$ide_oex=$rowsgr["ide_oex2"];
			$nom_var='ide_oex'.$i;
			echo "<input type=hidden name='$nom_var' value='$ide_oex'>";
			
		$i++;
		}
		echo "<input type=hidden name=i value='$i'>";	
		echo"<tr>
		<td ><span class='Estilo7'>901101</span></td>
		<td ><span class='Estilo7'>ALCOHOL RESISTENTE</span></td>
		<td ><span class='Estilo7'><a href=# onclick='cargar2(15,1)'><img src=icons/i_yes.gif></a></tr>";
	 }
	
	////////////////////GRAM
	$consulta16=mysql_query("SELECT `ide_oex2`,`iden_dlab` FROM labo_oex2 WHERE iden_dlab='$iden_labs' AND cod_exam='901107'"); 
	if ($rowx16=mysql_fetch_array($consulta16))
	{
	 echo"<tr>
	 <td ><span class='Estilo7'>901107</span></td>
	 <td ><span class='Estilo7'>COLORACION GRAM</span></td>
	 
	 <td ><span class='Estilo7'><a href=# onclick='cargar2(16,2)'><img src=icons/i_yes.gif></a></tr>";
	
	}
	////////////////////COPROLOGICO/////////////////////
	$cons_cpr=mysql_query("SELECT `ide_oex2`,`iden_dlab` FROM labo_oex2 WHERE iden_dlab='$iden_labs' AND cod_exam='907002'"); 
	if ($rowxcp=mysql_fetch_array($cons_cpr))
	{
	 echo"<tr>
	 <td ><span class='Estilo7'>907002</span></td>
	 <td ><span class='Estilo7'>FORMATO COPROLOGICO</span></td>
	 
	 <td ><span class='Estilo7'><a href=# onclick='cargar2(16,3)'><img src=icons/i_yes.gif></a></tr>";
	}
	
	echo"</table>";
	echo" <input type=hidden name=opcex >";
	echo" <input type=hidden name=oplb2 >";
	

?>

<?
if ($estado_usu=="I"){
  echo "<center><h2>Usuario No tiene FORMATO por Editar...</h2></center>";}
?>


	


</table>
</form>
</body>
</html><html><head></head><body></body></html>