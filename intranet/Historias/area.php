<?
//session_register('Gareh');
?>
<html>
<head>
<style type="text/css">
<!--
.Estilo6 {font-family: Arial, Helvetica, sans-serif; font-size: 11px; font-weight: bold; }
.Estilo5 {font-family: Arial, Helvetica, sans-serif; font-size: 10px; font-weight: bold; }

-->
</style>
<SCRIPT LANGUAGE=JavaScript>
/*function Muestra(){
var texto = form1.value

window.open("gene_hor.php?area="+texto,"Frmh2a")
}*/
function validar()
{
    //alert("aquitoy");
	if (form1.t0.value == "" &&form1.t1.value == "" && form1.t2.value == "" && form1.t3.value == ""  ) 
    { alert("Por favor Ingrese algun parametro de busqueda"); return ; }
	else{
	form1.submit();}
}

</SCRIPT>
<title><h6>PROGRAMA PARA EL MANEJO DE CITAS MEDICAS</h6></title>
</head>
<body  scroll = "no">

<form name="form1" method="post" action="gene_hor.php" target="Frmh2a" >
<table align="center">
<td width =100% align="center" class=estilo6 ><B>GENERAR LISTADO</B></td>
</table>
<table align="center" border=1>
<tr>
<td class=Estilo6>CODIGO MEDICO: <INPUT type=text name="t0" size=8 maxlength=8 ></td>
<td class=Estilo6>IDENTIFICACION: <INPUT type=text name="t1" size=10 maxlength=14></td>
<td class=Estilo6>FECHA INICIO: <INPUT type=text name="t2" size=10></td>
<td class=Estilo6>FECHA FINAL: <INPUT type=text name="t3" size=10 ></td></tr>
<tr><td align="center" colspan=2><input name='btn1' type='button'  value='Generar' onclick='validar()'></td>
<td class=Estilo6 align="center"align="center">Formato: aaaa-mm-dd</td>
<td class=Estilo6 align="center">Formato: aaaa-mm-dd</td>
</tr>
</form>
</body>
</html>
