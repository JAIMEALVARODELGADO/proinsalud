<?php
	
		include('php/conexion.php');
		include('php/funciones.php');
		echo"<br>";
		echo"<table width=70%>";
		echo"<tr><th class=Th0 align='center'><STRONG>INFORME DE BASILOSCOPIAS</strong></td></tr>";
		echo"</table>";
		
		$conspro="SELECT encabezado_labs.fchr_labs, usuario.PNOM_USU, usuario.SNOM_USU, usuario.PAPE_USU, usuario.SAPE_USU, usuario.SEXO_USU, usuario.FNAC_USU, usuario.NROD_USU, usuario.DIRE_USU,usuario.TRES_USU, ucontrato.CONT_UCO,contrato.NEPS_CON , detalle_labs.codigo, detalle_labs.nord_dlab, detalle_labs.fech_dlab
                FROM ((((cups INNER JOIN detalle_labs ON cups.codigo = detalle_labs.codigo) INNER JOIN encabezado_labs ON detalle_labs.iden_labs = encabezado_labs.iden_labs) INNER JOIN usuario ON encabezado_labs.codi_usu = usuario.CODI_USU) INNER JOIN ucontrato ON usuario.CODI_USU = ucontrato.CUSU_UCO) INNER JOIN contrato ON ucontrato.CONT_UCO = contrato.CODI_CON
                WHERE (((detalle_labs.codigo) ='105255')AND ((encabezado_labs.fchr_labs) >='$fecini_' AND (encabezado_labs.fchr_labs) <='$fecfin_')) AND estd_dlab='CU'
                GROUP BY detalle_labs.nord_dlab";
		//echo $conspro;
		$consulpro=mysql_query($conspro);
		if(mysql_num_rows($consulpro))
		{
			  $datos="";
			  while($rowcon=mysql_fetch_array($consulpro))
			  {
				  $datos=$datos."$rowcon[nord_dlab],"; 
				  $datos=$datos."$rowcon[fchr_labs],";
                  $nom_usu=$rowcon[PNOM_USU].' '.$rowcon[SNOM_USU].' '.$rowcon[PAPE_USU].' '.$rowcon[SAPE_USU];
				  $datos=$datos."$nom_usu,";
				  $unidad='';
				  $edad=calculaedad2($rowcon[FNAC_USU],$unidad);
				  $datos=$datos."$edad,";
				  $datos=$datos."$rowcon[SEXO_USU],";
				  $datos=$datos."$rowcon[NROD_USU],";
				  $datos=$datos."6,";
				  $datos=$datos."$rowcon[DIRE_USU]"."/"."$rowcon[TRES_USU],";
				  $datos=$datos."EX,";
				  $datos=$datos."$rowcon[NEPS_CON],";
				  $datos=$datos."PROINSALUD S.A,";
				  $datos=$datos."ESPUTO,";
				  $datos=$datos."\n";
				  //echo $datos;

			  }
			  
			  $archivo="AP.csv"; //ruta del archivo a generar 
			  //echo $archivo;
			  unlink($archivo);
			  $fp=fopen($archivo,"w");
			  //
			  fwrite($fp,$datos); 
			   
			  fclose($fp);
			  
			  echo"<tr><td class='Td2' width='90%' align='left'><a href='".$archivo."'><font color=#3300FF size=2>ARCHIVO DESCARGABLES</font></a></td><tr>";
			  
			  
			  /*echo "<tr><td class='Td2' colspan=2 align='center'><br><br><b><font color=#3300FF>Los Archivos debe bajarse en Formato .txt</font></td></tr><tr><td class='Td2' width='10%' align='right'><a href='".$archivo."'><img hspace='8' width='20' height='20' src='imagenes\feed_disk.png' alt='Generar Archivo' border=0></a></td>
			  <td class='Td2' width='90%' align='left'><a href='".$archivo."'><font color=#3300FF>ARCHIVO DE PROCEDIMIENTOS</font></a></td><tr>";  */

			}
			echo "</table>";
	
	echo"<input type=hidden name='control' value=$control>";
	?>

</form>

</body>
</html>
