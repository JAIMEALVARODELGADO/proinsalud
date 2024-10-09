<?php
session_start();
$_SESSION[ter_area]=$area;
$_SESSION[ter_codmedi]=$id;
$_SESSION[ter_codmedi_cit]=$id;
if ($_SESSION[ter_area]=='50'){
	$_SESSION[ter_codmedi_cit]='14021641';
}
?>

<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <title>Consulta de Terapia</title>
<script language="JavaScript">
    function cargar(){
        window.open('ter_frminicio.html','_self');
        //alert();
    }
</script>
</head>
<body onload='cargar()'>

</body>
</html>
        