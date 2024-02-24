<?
session_register('Gcod_medico');
session_register('Garea');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
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
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"/>
<link rel="shortcut icon" href="/favicon.ico">
<title>Facturaci�n</title>
</head>
	<frameset rows="113,*" border=0 framespacing=0 frameborder=0 >
		<frame src="top.php"  name="topFrame"	frameborder=0 border=0 framespacing=0 marginheight=0 marginwidth=0 scrolling="No" noresize>
		<frameset cols="210,*" border="0" frameborder="0" framespacing="0">
			<frame src="left.php" name="leftFrame" frameborder="0" border="0" noresize scrolling="no" onResize="setScrollInIE();">
			<frame src="fondo.php" name="fr2" frameborder="0" border="0" framespacing="0" marginheight="7" marginwidth="7" noresize scrolling="yes">
		</frameset>
	</frameset><noframes></noframes>
</html>