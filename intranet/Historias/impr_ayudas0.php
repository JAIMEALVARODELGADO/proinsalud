<html>
<HEAD>
	<script languaje=javascript>
	    function pasar()
		{				
			//window.open("impr_ayudas.php", "TOP", "height=200,width=300,left=100,top=100");
		
		//	window.open("impr_ayudas.php", "TOP", "directories=no, menubar=no,status=no,toolbar=no,location=no,scrollbars=no,fullscreen=no,height=200,width=300,left=100,top=100");
			uno.target='';
			uno.action='impr_ayudas.php';
			uno.submit();		
		}
	</script>
</head>
<?
	
	$anofac=substr($fecdia,0,4);
	$mesfac=substr($fecdia,5,2);
	$disfac=substr($fecdia,8,2);
	$fecdia=$anofac.'/'.$mesfac.'/'.$disfac;
	echo"<form name='uno' method='post' action='impr_ayudas.php' target='TOP'>";
	$link=Mysql_connect("localhost","root","");
    if(!$link)echo"no hay conexion";
    Mysql_select_db('proinsalud',$link);
	$fact=mysql_query("SELECT factura.num_fac, factura.fec_ent, factura.cod_usu
	FROM factura WHERE (((factura.fec_ent)='$fecdia') AND ((factura.cod_usu)='$usuar'))");
	$n=0;	
	while($row=mysql_fetch_array($fact))
	{
		$nume_fact=$row[num_fac];		
		$nomvar='factu'.$n;
		echo"<input type=hidden name='$nomvar' value=$nume_fact>";
		$n=$n+1;
	}
	
	echo"<input type=hidden name=final value=$n>
	<input type=hidden name=usuar value=$usuar>
	<input type=hidden name=fecdia value='$fecdia'>
	<body onload='pasar()'>
	</body>
	</form>";
	
?>
</html>