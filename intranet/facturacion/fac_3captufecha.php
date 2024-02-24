<html>
<head>
<title>CIERRE DE FACTURA</title>
<!--Hoja de estilos del calendario --> 
<link rel="stylesheet" type="text/css" media="all" href="java/calendar/calendar-green.css" title="win2k-cold-1" /> 

<!-- librer�a principal del calendario --> 
<script type="text/javascript" src="java/calendar/calendar.js"></script> 

<!-- librer�a para cargar el lenguaje deseado --> 
<script type="text/javascript" src="java/calendar/lang/calendar-es.js"></script> 

<!-- librer�a que declara la funci�n Calendar.setup, que ayuda a generar un calendario en unas pocas l�neas de c�digo --> 
<script type="text/javascript" src="java/calendar/calendar-setup.js"></script> 
<link rel="stylesheet" href="css/style.css" type="text/css" />

<script languaje="Javascript">
function validar(){
    error="";    
    /*if(validafecha(form1.fcie_fac.value)==false){
        error+="Fecha de Cierre de Factura Inv�lida\n"
    }        
    if(validafechamen(form1.fcie_fac.value,fecf_)==true){
        error+="La fecha de cierre es menor a la prestacion del servicio\n"
    }*/
    if(error!=""){
        alert(error);
        return(false);
    }
    else{
		document.form1.btn_validar.disabled=true;
        document.form1.submit();
        window.close();
    }    
}
</script>

<script language='vBscript'>
//Funcion que retorna true si la fecha es v�lida y false si la fecha no es v�lida
//Par�metros: fecha_ : Es la fecha que se va a validar, debe llegar en formato dd/mm/aaaa
function validafecha(fecha_)
  validafecha=IsDate(fecha_)
end function

//Funcion que retorna true si la fecha1 es mayor a fecha2
//Par�metros: fecha_ : Es la fecha que se va a validar, debe llegar en formato dd/mm/aaaa
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
<form name="form1" method="POST" action="fac_3cierra.php" target='fr02'>
<body>
<?
include('php/funciones.php');
//echo $fecf_fac;
?>
<table class="Tbl0"><tr><td class="Td0" align='center'>DATOS DE CIERRE</td></tr></table><br>
<br><br><br>
<table class="Tbl0">
    <tr>
        <td class="Td2" align='right'>Prefijo :</td>
        <td class="Td2" align='left'><select name='pref_fac'>        
        <option value="FE">FE</option>
        <option value="I">I</option>
		<option value="PGP">PGP</option>
        </select>            
        </td>
    </tr>
    <tr>
        <td class="Td2" align='right'>Fecha de Cierre :</td>
        <td class="Td2" align='left'>
            <input type="text" size="10" maxlength="10" name="fcie_fac" value="<?echo hoy()?>">
            <input type="button" id="lanzador1" value="..." />
                                <dd><dd><script type="text/javascript"> 
                                          Calendar.setup({ 
                                          inputField     :    "fcie_fac",     // id del campo de texto 
                                          ifFormat     :     "%d/%m/%Y",     // formato de la fecha que se escriba en el campo de texto 
                                          button     :    "lanzador1"     // el id del bot�n que lanzar� el calendario 
                                          }); 
                                 </script> 
        </td>
    </tr>    
</table>
<input type="hidden" name="iden_fac" value="<?echo $iden_fac;?>">
<br><br><br>

<table class="Tbl0">
    <tr>
        <!--<td class="Td2" align='center'><input type='button' name='cerrar' value='Cerrar Factura' onclick="validar('<?echo $fecf_fac;?>')"></td>-->
        <td class="Td2" align='center'><input type='button' name='cerrar' value='Cerrar Factura' onclick="validar()" id="btn_validar"></td>
        <td class="Td2" align='center'><input type='button' name='cancela' value='Cancelar' onclick='javascript:window.close();'></td>
    </tr>
</table>
</form>
</body>
</html>