<?
session_start();
session_register('Gidusuper'); 
$Gidusuper=$id;
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"/>
<link rel="shortcut icon" href="/favicon.ico">
<title>Administracion del Personal</title>
</head>

	<frameset rows="110,*" border=0 framespacing=0 frameborder=0 >
		<frame src="top.php"  name="topFrame"	frameborder=0 border=0 framespacing=0 marginheight=0 marginwidth=0 scrolling="No" noresize>
		<frameset cols="210,*" border="0" frameborder="0" framespacing="0">
			<frame src="left.php" name="leftFrame" frameborder="0" border="0" noresize scrolling="no" onResize="setScrollInIE();">
			<frame src="principal.php" name="fr2" frameborder="0" border="0" framespacing="0" marginheight="7" marginwidth="7" noresize scrolling="yes">
		</frameset>
	</frameset><noframes></noframes>
</html>