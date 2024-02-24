<?
session_register('Gidusufac');
$Gidusufac=$id;
?>
<!-- P�gina de Inicio  -->
<HTML>
<HEAD>
<title>Inicio</title>
<Script Language="JavaScript">
function cargar() {
var load = window.open('frm_factu0.php','','scrollbars=1,menubar=no,height=760,width=1020,top=0, left=0, resizable=yes,toolbar=no,location=si,status=no');
window.opener = top;
window.close();
}
</Script>
</HEAD>
<body bgcolor="#E6E8FA" onload="javascript:cargar()">
</body>
</HTML>
