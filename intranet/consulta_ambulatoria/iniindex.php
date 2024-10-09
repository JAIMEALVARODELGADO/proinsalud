<html>
<head>
<title>CONSULTA AMBULATORIA</title>  
	<script language="JavaScript1.2">
	window.moveTo(0,0);
	if (document.all) {
	top.window.resizeTo(screen.availWidth,screen.availHeight);
	}
		else if (document.layers||document.getElementById) {
		if (top.window.outerHeight<screen.availHeight||top.window.outerWidth<screen.availWidth){
			top.window.outerHeight = screen.availHeight;
			top.window.outerWidth = screen.availWidth;
		}
	}
</script>
</head>
	<FRAMESET rows=122,40,* border=1 >
		<FRAME SRC="cabeza1.php" name=cabeza1 scrolling=NO noresize>		
		<FRAME SRC="titulo.php" name=titulo scrolling=NO noresize>	
		<FRAMESET cols=185,* border=0 id="marco">
			<FRAME SRC="blanco.php" name=menu scrolling=NO noresize>	
			<FRAME SRC="lista_pacientes.php" name=area scrolling=YES noresize>	
		</FRAMESET>
	</FRAMESET>
</html>



