<HTML>
<HEAD>
	<?
	//coloco en una variable el nombre de la base de datos de la aplicación
    define("base_de_datos", "proinsalud");
	require('Libreria.Inc');
	?>
	<link rel="stylesheet" type="text/css" href="css/estilos.css">
	<script language="JavaScript" type="text/javascript">
	function click(){
		if(event.button==2){
			alert('Funcion desabilitada');
		}
	}
	document.onmousedown=click
	//-->
	</script>
</HEAD>
<BODY>
<?PHP
$xcon=conectar_bd();
// ACTUALIZAR CODIGOS ENOS
$archivoagrupa='codenos.txt';
if(file_exists($archivoagrupa))
{	
	$fp6 = fopen ($archivoagrupa, "r" );
	$reg=0;
	$cont=1;
	while (( $data = fgetcsv ( $fp6, 1000 , "," )) !== FALSE ) 
	{ 
		$reg++;
		$i = 0;
		foreach($data as $dato)
		{
			$campo[$i]=$dato;
			$i++ ;
		}
		$$campo[1]=$campo[2];
		echo $cont.'   '.$data[0].'   '.$data[1].'<br>';
		$cad2="UPDATE cie_10 SET grupo_vie10='$data[0]' WHERE cod_cie10 = '$data[1]'"; 
		$resul2 = @Mysql_query($cad2);
		$cont++;
	}
	fclose($fp6);
}
desconectar_bd();
?>
</BODY>
</HTML>