
<meta http-equiv="Context-Type" content="text/html; charset=UTF-8">
<?
session_start();
$datos[0]='desc_';
$datos[1]='iden_';
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<title>PROGRAMA DE FACTURACION - PROFACTU</title>
<!--Hoja de estilos del calendario --> 
<link rel="stylesheet" type="text/css" media="all" href="java/calendar/calendar-blue.css" title="win2k-cold-1" /> 

<!-- librera principal del calendario --> 
<script type="text/javascript" src="java/calendar/calendar.js"></script> 

<!-- librera para cargar el lenguaje deseado --> 
<script type="text/javascript" src="java/calendar/lang/calendar-es.js"></script> 

<!-- librera que declara la funcin Calendar.setup, que ayuda a generar un calendario en unas pocas lneas de cdigo --> 
<script type="text/javascript" src="java/calendar/calendar-setup.js"></script> 

<link rel="stylesheet" href="css/style.css" type="text/css" />

<link rel="stylesheet" type="text/css" href="css/estyles.css">
<link rel="stylesheet" type="text/css" href="css/jquery.autocomplete.css">
<script type="text/javascript" src="js/jquery.js"></script>
<script type='text/javascript' src='js/jquery.autocomplete.js'></script>
<script type="text/javascript">
$().ready(function() {
	
	$("#course").autocomplete("fac_autocompcie.php", {
		width: 260,
		matchContains: false,
		mustMatch: false,
		selectFirst: false
	});
	
	$("#course").result(function(event, data, formatted) {
		$("#course_val").val(data[1]);
		$("#course_val2").val(data[2]);
	});
});
</script>

<SCRIPT LANGUAGE=JavaScript>

function validactr(){
form1.action='fac_2encapre.php';
form1.submit();
}

function validag(){
var error="";
  if(form1.enti_fac.value==""){error=error+"Entidad a facturar\n";} 
  if(form1.iden_ctr.value==""){error=error+"Número de contrato\n";} 
  if(form1.tipo_fac.value==""){error=error+"Tipo De Factura\n";} 
  if(form1.feci_fac.value==""){error=error+"Fecha De Inicio Del Servicio\n";} 
  if(form1.fecf_fac.value==""){error=error+"Fecha De Finalización Del Servicio\n";}  
  if(form1.cod_cie10.value==""){error=error+"Diagnóstico\n";}
  if(form1.servicio.value==""){error=error+"Servicio\n";}
  /*if(validafecha(form1.feci_fac.value)==false){
    error+="Fecha de inicio del servicio invlida\n";
  }
  if(validafecha(form1.fecf_fac.value)==false){
    error+="Fecha final del servicio invlida\n";
  }
  if(validahoy(form1.feci_fac.value)==false){
    error+="La fecha inicial del servicio no puede ser mayor a la de hoy\n";
  }
  if(validahoy(form1.fecf_fac.value)==false){
    error+="La fecha final del servicio no puede ser mayor a la de hoy\n";
  }
  if(error==""){
      if(validafechamen(form1.fecf_fac.value,form1.feci_fac.value)==true){
        error+="La fecha de inicio del servicio debe ser menor o igual a la de finalizacin\n";
      }
  }*/
  if(error!=""){
    alert("Para continuar debe completar la siguiente información:\n"+error);}
  else{
    form1.action="fac_2guardapre.php";
    form1.submit();
  }
}
</script>

<script language='vBscript'>
//Funcion que retorna true si la fecha es vlida y false si la fecha no es vlida
//Parmetros: fecha_ : Es la fecha que se va a validar, debe llegar en formato dd/mm/aaaa
function validafecha(fecha_)
  validafecha=IsDate(fecha_)
end function

//Funcion que retorna true si la fecha1 es mayor a fecha2
//Parmetros: fecha_ : Es la fecha que se va a validar, debe llegar en formato dd/mm/aaaa
function validafechamen(fecha1_,fecha2_)
  diferencia=(DateDiff("d",fecha2_,fecha1_))  
  if(diferencia>=0) then
    validafechamen=false
  else
    validafechamen=true
  end if
end function

//Funcion que retorna true si la fecha es menor a la fecha actual
//Parmetros: fecha_ : Es la fecha que se va a validar, debe llegar en formato dd/mm/aaaa
function validahoy(fecha_)
  hoy=now
  hoy=mid(hoy,1,10)
  if IsDate(fecha_) then
    diferencia=(DateDiff("d",fecha_,hoy))
  else
    diferencia=0
  end if
  if(diferencia>=0) then
    validahoy=true
  else
    validahoy=false
  end if
end function

</script>

</head>
<body>
<form name="form1" method="POST" action="fac_2guardaenc.php" target='fr02'>
<table class="Tbl0"><tr><td class="Td0" align='center'>ENCABEZADO DE LA FACTURA </td></tr></table><br>
<?
include('php/conexion.php');
include('php/funciones.php');
if(empty($feci_fac))$feci_fac=hoy();
if(empty($fecf_fac))$fecf_fac=hoy();

$_pagi_sql="SELECT NROD_USU,CODI_CON,CODI_USU, PNOM_USU, SNOM_USU, PAPE_USU, SAPE_USU, FNAC_USU, SEXO_USU,TPAF_USU,MATE_USU,CONT_UCO,NEPS_CON,DIRE_USU,
			IDEN_UCO,MRES_USU,TRES_USU, concat(Pnom_usu, ' ',Snom_usu, ' ', Pape_usu, ' ',Sape_usu) AS DNom 
			FROM usuario
                        INNER JOIN ucontrato ON CUSU_UCO=CODI_USU
                        INNER JOIN contrato ON CONT_UCO=CODI_CON
                        WHERE CONT_UCO='$enti' AND NROD_USU ='$iden'";
//echo $_pagi_sql;
$consulta=mysql_query($_pagi_sql);
if(mysql_num_rows($consulta)!=0){
  $row = mysql_fetch_array($consulta);
  $consultamun=mysql_query("SELECT nomb_mun FROM municipio WHERE codi_mun='$row[MATE_USU]'");
  if(mysql_num_rows($consultamun)<>0){
    $rowmun=mysql_fetch_array($consultamun);
	$nomb_mun=$rowmun[nomb_mun];
  }
  echo "<table class='Tbl0'>";
  echo "<tr>";
  echo "<td class='Td2' align='right'><b>Identificación:</td>";
  echo "<td class='Td2'><input type=hidden name=codi_usu value=$row[CODI_USU]>$row[TDoc_usu] $row[NROD_USU]</td>";
  echo "<td class='Td2' align='right'><b>Nombre:</td>";
  echo "<td class='Td2'><input type=hidden name=nom_usu value='$row[DNom]'>$row[DNom]</td>";
  echo "</tr>";
  echo "<td class='Td2' align='right'><b>Edad:</td>";
  echo "<td class='Td2'><input type=hidden name=edad value=".calculaedad($row[FNAC_USU]).">".calculaedad($row[FNAC_USU])."</td>";
  echo "<td class='Td2' align='right'><b>Sexo:</td>";
  echo "<td class='Td2'>$row[SEXO_USU]</td>";
  echo "<td class='Td2' align='right'><b>Dirección:</td>";
  echo "<td class='Td2'>$row[DIRE_USU]</td>";
  echo "</tr>";
  echo "</tr>";
  echo "<td class='Td2' align='right'><b>Tipo Afiliado:</td>";
  echo "<td class='Td2'>$row[TPAF_USU]</td>";
  echo "<td class='Td2' align='right'><b>Mun Atención:</td>";
  echo "<td class='Td2'>$nomb_mun</td>";
  echo "<td class='Td2' align='right'><b>Teléfono:</td>";
  echo "<td class='Td2'>$row[TRES_USU]</td>";
  echo "</tr>";
  echo "<tr>";
  echo "<td class='Td2' align='right'><b>Fecha Ingreso:</td>";
  echo "<td class='Td2'>".hoy()."</td>";
  echo "<td class='Td2' align='right'><b>Entidad:</td>";
  echo "<td class='Td2'>$nomenti</td>";
  echo "<td class='Td2' align='right'></td>";
  echo "<td class='Td2'></td>";
  echo "</tr>";
  echo"</table>";
  mysql_free_result($consultamun);
  ?>
  <br>
  <table class='Tbl0' border='0'>
        <tr>
            <td class='Td2' align='right'><b>Entidad a facturar:</td>
            <td class='Td2' align='left'><select name='enti_fac' onchange='validactr()'><option value=''>
            <?
            //mysql_free_result($consultacon);
            $consultaent=mysql_query("SELECT nit_con,neps_con
            FROM contrato WHERE nit_con<>'' ORDER BY neps_con");
            while($rowent=mysql_fetch_array($consultaent)){
                echo "<option value='$rowent[nit_con]'>$rowent[neps_con]";
            }
            mysql_free_result($consultaent);
            ?>
            </select>
            </td>
            <td class='Td2' align='right'><b>Contrato Nro:</td>
            <td class='Td2'><select name='iden_ctr'><option value=''>
            <?                       
            $consultacon="SELECT ccio.iden_ctr,ccio.nume_ctr FROM contratacion AS ccio
            INNER JOIN contrato AS con ON con.codi_con=ccio.codi_con
            WHERE con.nit_con='$enti_fac' AND ccio.esta_ctr='A'";            
            $consultacon=mysql_query($consultacon);
            while($rowcon=mysql_fetch_array($consultacon)){
            echo "<option value='$rowcon[iden_ctr]'>$rowcon[nume_ctr]";
            }
            mysql_free_result($consultacon);
            ?>
            </select>
            </td>
        </tr>

        <tr>
            <td class='Td2' align='right'><b>Tipo de factura:</td>
            <td class='Td2'><select name='tipo_fac'><option value=''>
            <option value='1'>Contado
            <option value='2'>Crédito
            </select>
            </td>
            <td class='Td2' align='right'><b>Relación Nro:</td>
            <td class='Td2'><input type='text' name='rela_fac' size='8' maxlength='8' value=<?echo $rela_fac;?>></td>
	</tr>
	<tr>
		<td class='Td2' align='right'><b>F. inicio del servicio:</td>
		<td class='Td2'><?php echo "<input type=text name=feci_fac id=frec size='10' value=$feci_fac>*";?>
		<button type="button" id="lanzador1"><div align="center"><img src=icons\feed.png border='0'></div>
		<!-- script que define y configura el calendario--> 
		<script type="text/javascript"> 
			Calendar.setup({ 
			inputField   :    "frec",     // id del campo de texto 
			ifFormat     :    "%d/%m/%Y",     // formato de la fecha que se escriba en el campo de texto 
			button       :    "lanzador1"     // el id del botn que lanzar el calendario 
			});
		</script></button> </td>
		<td class='Td2' align='right'><b>F. final del servicio:</td>
		<td class='Td2'><?php echo "<input type=text name=fecf_fac id=ffin size='10' value=$fecf_fac>*";?>
		<button type="button" id="lanzador2"><div align="center"><img src=icons\feed.png border='0'></div>
		<!-- script que define y configura el calendario--> 
		<script type="text/javascript"> 
			Calendar.setup({ 
			inputField   :    "ffin",     // id del campo de texto 
			ifFormat     :    "%d/%m/%Y",     // formato de la fecha que se escriba en el campo de texto 
			button       :    "lanzador2"     // el id del botn que lanzar el calendario 
			});
		</script></button></td>
             </tr>
            <tr>
                <td class='Td2' align='right'><b>Servicio:</td>
                <td class="Td2" align='left' width='10%'>
                <select name='servicio'><option value=''></option>
                <?
                $consulta=mysql_query("SELECT codi_des,nomb_des FROM destipos WHERE codt_des='06' order by nomb_des ");
                while($row=mysql_fetch_array($consulta)){
                    echo "<option value='$row[codi_des]'>$row[nomb_des]</option>";
                }
                ?>
                </select>
                </td>
                <td class='Td2' align='right'><b>Diagnóstico:</td>
                <td class='Td2'>
                    <!--//*********Captura autocompletado-->
                    <input type='text' id='course' class='texto' name='desc_cie' size='100' value='<?echo $desc_cie;?>'>
                    <b>Cod:<input type='text' id='course_val' name='cod_cie10' value='<?echo $cod_cie10;?>' size='4' maxlength='4'>
                </td>
                <td class='Td2' colspan='3'><?echo $nom_cie10;?></td>
            </tr>
             <tr>
                <td class='Td2' align='right'><b>Nro Autorización:</td>
                <td class="Td2" align='left'><input type='text' name='nauto_fac' size='15' maxlength='15' value=<?echo $nauto_fac;?>></td>
             </tr>
        </table>
	<br><br><br>
        <script language='javascript'>
        form1.enti_fac.value='<?echo $enti_fac;?>';
        form1.num_ctr.value='<?echo $iden_ctr;?>';
        form1.tipo_fac.value='<?echo $tipo_fac;?>';
        form1.servicio.value='<?echo $servicio;?>';
        form1.cod_cie10.value='<?echo $cod_cie10;?>';                
        </script>
	<table class='Tbl2'>
    <tr>
      <td class='Td1' width='45%'><a href='#' onclick='validag()'><img hspace=0 width=20 height=20 src='icons\feed_disk.png' alt='Guardar' border=0 align='center'>Guardar</a></td>
      <td class='Td1' width='45%'><a href='fondo.php'>Cancelar<img hspace=0 width=20 height=20 src='icons\feed.png' alt='Cancelar' border=0 align='center'></a></td>
    </tr>
	</table>
	<input type='hidden' name='control'>
        <!--<input type='hidden' name='nit_con' value="<?echo $nit_con;?>">-->
        <input type='hidden' name='iden' value="<?echo $iden;?>">
        <input type='hidden' name='enti' value="<?echo $enti;?>">
	<?
	}
		mysql_free_result($consulta);
		mysql_close();
	?>
</form>
</body>
</html><html><head></head><body></body></html>