<?
session_start();
session_register('giden');
session_register('gcotr');
session_register('gtipo_fac');
session_register('grela_fac');
session_register('gfeci_fac');
session_register('gfecf_fac');
session_register('genti');

$giden=$iden;
$genti=$enti;
$gidefac=$idefac;
$gcotr=$cotr;

?>
<html>
<head>
<title>PROGRAMA DE FACTURACIÓN - PROFACTU</title>
<!--Hoja de estilos del calendario --> 
<link rel="stylesheet" type="text/css" media="all" href="java/calendar/calendar-blue.css" title="win2k-cold-1" /> 

<!-- librería principal del calendario --> 
<script type="text/javascript" src="java/calendar/calendar.js"></script> 

<!-- librería para cargar el lenguaje deseado --> 
<script type="text/javascript" src="java/calendar/lang/calendar-es.js"></script> 

<!-- librería que declara la función Calendar.setup, que ayuda a generar un calendario en unas pocas líneas de código --> 
<script type="text/javascript" src="java/calendar/calendar-setup.js"></script> 

<link rel="stylesheet" href="css/style.css" type="text/css" />

<SCRIPT LANGUAGE=JavaScript>
function busqueda() {
form1.action="fac_2busqc10.php";
form1.control.value='1';
form1.submit();
}

function validag(){
var error="";
  if(form1.tipo_fac.value==""){error=error+"Tipo De Factura\n";}
  /*if(validafecha(form1.feci_fac.value)==false){
    error+="Fecha de inicio del servicio inválida\n";
  }
  if(validafecha(form1.fecf_fac.value)==false){
    error+="Fecha final del servicio inválida\n";
  }
  if(validahoy(form1.feci_fac.value)==false){
    error+="La fecha inicial del servicio no puede ser mayor a la de hoy\n";
  }
  if(validahoy(form1.fecf_fac.value)==false){
    error+="La fecha final del servicio no puede ser mayor a la de hoy\n";
  }
  if(error==""){
      if(validafechamen(form1.fecf_fac.value,form1.feci_fac.value)==true){
        error+="La fecha de inicio del servicio debe ser menor o igual a la de finalización\n";
      }
  }*/
  if(error!=""){
    alert("Para continuar debe corregir la siguiente información:\n"+error);}
  else{
    form1.action="fac_3guardedit.php";
    form1.submit();
  }
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

//Funcion que retorna true si la fecha es menor a la fecha actual
//Parámetros: fecha_ : Es la fecha que se va a validar, debe llegar en formato dd/mm/aaaa
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
/*$_pagi_sql="SELECT NROD_USU,CODI_CON,CODI_USU, PNOM_USU, SNOM_USU, PAPE_USU, SAPE_USU, FNAC_USU, SEXO_USU,TPAF_USU,MATE_USU,CONT_UCO,NEPS_CON,DIRE_USU,
			IDEN_UCO,MRES_USU,TRES_USU, concat(Pnom_usu, ' ',Snom_usu, ' ', Pape_usu, ' ',Sape_usu) AS DNom 
			FROM usuario
INNER JOIN ucontrato ON CODI_USU=CUSU_UCO
INNER JOIN contrato ON CONT_UCO=CODI_CON
WHERE CONT_UCO='$genti' AND NROD_USU ='$giden'";*/
$_pagi_sql="SELECT NROD_USU,CODI_USU, CONCAT(PNOM_USU, ' ',SNOM_USU, ' ', PAPE_USU, ' ',SAPE_USU) AS DNom,FNAC_USU, SEXO_USU,TPAF_USU,MATE_USU,DIRE_USU,
			MRES_USU,TRES_USU
			FROM usuario
WHERE NROD_USU ='$giden'";
//echo "<br>".$_pagi_sql;

//$_pagi_sql2="SELECT ctr.nume_ctr, ctr.iden_ctr  FROM contratacion as ctr WHERE ctr.codi_con='$genti'";
//echo "<br>".$_pagi_sql2;

/*$_pagi_sql3="SELECT cod_cie10, nom_cie10, sex_cie10, inf_cie10, sup_cie10, grupo_vie10 FROM cie_10 order by  nom_cie10 ";
echo "<br>".$_pagi_sql3;*/

$_pagi_sql4="SELECT CODI_CON, NEPS_CON FROM contrato WHERE CODI_CON ='$genti' ";

$_pagi_sql5="SELECT ef.iden_fac,ef.feci_fac,ef.fecf_fac,ef.rela_fac,ef.tipo_fac,ef.cod_cie10,ef.nauto_fac,
contratacion.nume_ctr,contrato.neps_con
FROM encabezado_factura AS ef 
INNER JOIN contratacion ON ef.iden_ctr = contratacion.iden_ctr
INNER JOIN contrato ON contratacion.codi_con = contrato.CODI_CON
INNER JOIN usuario ON ef.codi_usu = usuario.CODI_USU 
WHERE ef.iden_fac='$idefac'";

//echo $_pagi_sql5;
$consulta4=mysql_query($_pagi_sql4);
//$consulta3=mysql_query($_pagi_sql3);
//$consulta2=mysql_query($_pagi_sql2);
$consulta=mysql_query($_pagi_sql);
$consulta5=mysql_query($_pagi_sql5);

	if(mysql_num_rows($consulta4)!=0)
	{
	$rowenti = mysql_fetch_array($consulta4);
	$nomenti=$rowenti[NEPS_CON];
	}
	
	/*if(mysql_num_rows($consulta2)!=0)
	{
	  $row2 = mysql_fetch_array($consulta2);
	  $nume_ctr=$row2[nume_ctr];
	}*/
	
	if(mysql_num_rows($consulta5)!=0)
	{
	  $rowdaf = mysql_fetch_array($consulta5);
	  $gtipo_fac=$rowdaf[tipo_fac];
	  $cod_cie10=$rowdaf[cod_cie10];
	  $gfeci_fac=cambiafechadmy($rowdaf[feci_fac]);
	  $gfecf_fac=cambiafechadmy($rowdaf[fecf_fac]);
	  $grela_fac=$rowdaf[rela_fac];
	  $nauto_fac=$rowdaf[nauto_fac];
      $nume_ctr=$rowdaf[nume_ctr];
      $nom_cont=$rowdaf[neps_con];
	  echo"<input type=hidden name=idefac value='$gidefac'>";
	}

	if(mysql_num_rows($consulta)!=0)
	{
	  $row = mysql_fetch_array($consulta);
	  $consultamun=mysql_query("SELECT nomb_mun FROM municipio WHERE codi_mun='$row[MATE_USU]'");
    
	if(mysql_num_rows($consultamun)<>0)
	  {
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
	  //echo "<td class='Td2' align='right'><b>Fecha Ingreso:</td>";
	  //echo "<td class='Td2'>".hoy()."</td>";
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
		  <td class='Td2' align='right'><b>Contrato Nro:</td>
	      <td class='Td2'><input type='hidden' name='num_ctr' size='8' maxlength='8' value=<?echo $nume_ctr;?>><?echo $nume_ctr.' '.$nom_cont;?></td>
		  <td class='Td2' align='right'><b>Tipo de factura:</td>
		  <td class='Td2'><select name='tipo_fac'><option value='<?echo $tipo_fac;?>'>
	        <option value='1'>Contado
			<option value='2'>Crédito
		  </td><script language="javaScript">form1.tipo_fac.value='<?echo $gtipo_fac;?>';</script>
		  <td class='Td2' align='right'><b>Relación Nro:</td>
		  <td class='Td2'><input type='text' name='rela_fac' size='8' maxlength='8' value=<?echo $grela_fac;?>></td>
		</tr>
		<tr>
			<td class='Td2' align='right'><b>F. inicio del servicio:</td>
			<td class='Td2'><?php echo "<input type=text name=feci_fac id=frec size='10' value=$gfeci_fac />*";?>
			<button type="button" id="lanzador1"><div align="center"><img src=icons\feed.png border='0'></div>
			<!-- script que define y configura el calendario--> 
			<script type="text/javascript"> 
				Calendar.setup({ 
				inputField   :    "frec",     // id del campo de texto 
				ifFormat     :    "%d/%m/%Y",     // formato de la fecha que se escriba en el campo de texto 
				button       :    "lanzador0"     // el id del botón que lanzará el calendario 
				});
			</script></button> </td>
			<td class='Td2' align='right'><b>F. final del servicio:</td>
			<td class='Td2'><?php echo "<input type=text name=fecf_fac id=ffin size='10' value=$gfecf_fac />*";?>
			<button type="button" id="lanzador2"><div align="center"><img src=icons\feed.png border='0'></div>
			<!-- script que define y configura el calendario--> 
			<script type="text/javascript"> 
				Calendar.setup({ 
				inputField   :    "ffin",     // id del campo de texto 
				ifFormat     :    "%d/%m/%Y",     // formato de la fecha que se escriba en el campo de texto 
				button       :    "lanzador3"     // el id del botón que lanzará el calendario 
				});
			</script></button></td>
			<td class='Td2' align='right'><b>Nro Autorización:</td>
			<td class="Td2" align='left'><input type='text' name='nauto_fac' size='15' maxlength='15' value=<?echo $nauto_fac;?>></td>
		</tr>
		<tr>
			    <td class='Td2' align='right'><b>Diagnóstico:</td>
			    <td class='Td2'><input type="text" name="cod_cie10" size="4" maxlength="4"   value=<?echo $cod_cie10;?> disabled>
				<!--<a href='#' onclick="busqueda()"> <img hspace='0' width='20' height='20' src='icons\feed_magnify.png' alt='Buscar' border='0' align='center' ></a>--></td>
				<td class='Td2' colspan='3' ><?echo $nom_cie10;?></td>
				<td></td></tr></table>
	<br><br><br>
	<table class='Tbl2'>
    <tr>
      <td class='Td1' width='45%'><a href='#' onclick='validag()'><img hspace=0 width=20 height=20 src='icons\feed_disk.png' alt='Guardar' border=0 align='center'>Guardar</a></td>
      <td class='Td1' width='45%'><a href='fondo.php'>Cancelar<img hspace=0 width=20 height=20 src='icons\feed.png' alt='Cancelar' border=0 align='center'></a></td>
    </tr>
	</table>
	<input type='hidden' name='control'>
	<?
	}
		mysql_free_result($consulta);
		mysql_close();
	?>
</form>
</body>
</html>