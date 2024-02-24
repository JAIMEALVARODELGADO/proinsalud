<html>
<head>
<title>CIERRE DE CUENTA DE COBRO</title>
<!--Hoja de estilos del calendario --> 
<link rel="stylesheet" type="text/css" media="all" href="java/calendar/calendar-green.css" title="win2k-cold-1" /> 

<!-- librería principal del calendario --> 
<script type="text/javascript" src="java/calendar/calendar.js"></script> 

<!-- librería para cargar el lenguaje deseado --> 
<script type="text/javascript" src="java/calendar/lang/calendar-es.js"></script> 

<!-- librería que declara la función Calendar.setup, que ayuda a generar un calendario en unas pocas líneas de código --> 
<script type="text/javascript" src="java/calendar/calendar-setup.js"></script> 
<link rel="stylesheet" href="css/style.css" type="text/css" />

<script languaje="Javascript">
function validar(fecf_){
    error="";    
    if(validafecha(form1.frad_cco.value)==false){
        error+="Fecha Inválida\n"
    }
    if(validafechamen(fecf_,form1.frad_cco.value)==true){
        error+="La fecha de radicacion no puede ser mayor a la actual\n"
    }
    if(error!=""){
        alert(error);
        return(false);
    }
    else{
        document.form1.submit();
        window.close();
    }
    //javascript:form1.submit();window.close();
}
</script>

<script language='vBscript'>
//Funcion que retorna true si la fecha es válida y false si la fecha no es válida
//Parámetros: fecha_ : Es la fecha que se va a validar, debe llegar en formato dd/mm/aaaa
function validafecha(fecha_)
  validafecha=IsDate(fecha_)
end function

//Funcion que retorna true si la fecha1 es mayor a fecha2
//Parámetros: fecha_ : Es la fecha que se va a validar, debe llegar en formato dd/mm/aaaa
function validafechamen(fecha1_,fecha2_)
  diferencia=(DateDiff("d",fecha2_,fecha1_))  
  if(diferencia>=0) then
    validafechamen=false
  else
    validafechamen=true
  end if
end function
</script>

</head>
<form name="form1" method="POST" action="fac_3infguardacuenta.php" target='fr02'>
<body>
<?
include('php/funciones.php');
//echo $fecf_fac;
$hoy=hoy();
?>
<table class="Tbl0"><tr><td class="Td0" align='center'>FECHA DE RADICACION</td></tr></table><br>
<br><br><br><center><input type="text" size="10" maxlength="10" name="frad_cco" value="<?echo hoy()?>">
    <input type="button" id="lanzador1" value="..." />
			<dd><dd><script type="text/javascript"> 
				  Calendar.setup({ 
				  inputField     :    "frad_cco",     // id del campo de texto 
				  ifFormat     :     "%d/%m/%Y",     // formato de la fecha que se escriba en el campo de texto 
				  button     :    "lanzador1"     // el id del botón que lanzará el calendario 
				  }); 
			 </script> 
</center>
<input type="hidden" name="iden_cco" value="<?echo $iden_cco;?>">
<input type="hidden" name="tipo" value="C">
<br><br><br>

<table class="Tbl0">
    <tr><td class="Td2" align='center'><input type='button' name='cerrar' value='Cerrar Cuenta' onclick="validar('<?echo $hoy;?>')"></td>
    <td class="Td2" align='center'><input type='button' name='cancela' value='Cancelar' onclick='javascript:window.close();'></td></tr>
</table>
</form>
</body>
</html>