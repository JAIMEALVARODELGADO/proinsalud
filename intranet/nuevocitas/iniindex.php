<html>
<head>
<title>CITAS </title> 
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
	</SCRIPT>
	</head>
		<FRAMESET rows=122,40,* border=1 >
			<FRAME SRC="cabeza1.php" name=cabeza1 scrolling=NO noresize>		
			<FRAME SRC="titulo.php" name=titulopag scrolling=NO noresize>	
			<FRAMESET cols=200,* border=0>
				<FRAME SRC="menu.php" name=menu scrolling=YES noresize>	
				<FRAME SRC="blanco.php" name=area scrolling=YES noresize>
			</FRAMESET>
		</FRAMESET>
	</html>