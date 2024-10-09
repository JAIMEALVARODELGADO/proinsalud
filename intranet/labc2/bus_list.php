<html>
<head>
<title></title>
<link rel="stylesheet" href="css/style.css" type="text/css" />
<SCRIPT language=JavaScript>
 function buscar()
 {
    form1.action='bus_list.php';
	form1.target='';
	form1.submit();				
	
 }

function inactivar()
{
	form1.action='inac_personal.php';
	form1.target='';
	form1.submit();	

}


</script>
</head>
<link rel="stylesheet" href="css/style.css" type="text/css" />
<!--Hoja de estilos del calendario --> 
<link rel="stylesheet" type="text/css" media="all" href="java/calendar/calendar-blue.css" title="win2k-cold-1" /> 

<!-- librería principal del calendario --> 
<script type="text/javascript" src="java/calendar/calendar.js"></script> 

<!-- librería para cargar el lenguaje deseado --> 
<script type="text/javascript" src="java/calendar/lang/calendar-es.js"></script> 

<!-- librería que declara la función Calendar.setup, que ayuda a generar un calendario en unas pocas líneas de código --> 
<script type="text/javascript" src="java/calendar/calendar-setup.js"></script> 


 <table class="Tbl0">
   <tr><td class="Td1" align='center'><STRONG>BUSQUEDAS</strong></td></tr>
 </table>


<form name="form1" method="POST" >
<body >
	
 <?
	
	include('php/funciones.php');
	include('php/conexion.php');
	
	$link=Mysql_connect("localhost","root","");
	if(!$link)echo"no hay conexion";
	Mysql_select_db('proinsalud',$link);
	
	
	echo "<table width=80% align=center border=1>";
	echo "<tr>
			<td ><strong>Identificación:</td>
			<td><input type=text name=codusu size=14 maxlength=14 value=$codusu></td>";
			
	echo"	<td ><strong>Nº.Orden:</td>
			<td><input type=text name=num_fac size=14 maxlength=14 value=$num_fac></td>";
			
	echo"	<td ><strong>Fecha De Ingreso:</td>
				<td><b><input type=text name=fein_per  value='$fein_per' size=10 maxlength=10 >";?>
				<input type="button" id="lanzador" value="..." />
				<script type="text/javascript"> 
				  Calendar.setup({ 
				  inputField     :    "fein_per",     // id del campo de texto 
				  ifFormat     :     "%Y/%m/%d",     // formato de la fecha que se escriba en el campo de texto 
				  button     :    "lanzador"     // el id del botón que lanzará el calendario 
				  }); 
			</script> 
			<script language="javaScript">form1.fein_per.value='<?echo $fein_per;?>';</script><?
			
			
	echo"</td>";
	
	
	echo"<td ><strong>Fecha De Engreso:</td>
				<td><b><input type=text name=feeg_per  value='$feeg_per' size=10 maxlength=10 >";?>
				<input type="button" id="lanzador1" value="..." />
				<script type="text/javascript"> 
				  Calendar.setup({ 
				  inputField     :    "feeg_per",     // id del campo de texto 
				  ifFormat     :     "%Y/%m/%d",     // formato de la fecha que se escriba en el campo de texto 
				  button     :    "lanzador1"     // el id del botón que lanzará el calendario 
				  }); 
			</script> 
			<script language="javaScript">form1.feeg_per.value='<?echo $feeg_per;?>';</script><?
			
	echo"</td>";
	echo"<td><a href='#' onclick='buscar()'><img hspace=0 width=20 height=22 src='icons\lupa.png' alt='Buscar' border=0 align='center'></a></td></tr>";
	echo"</tr></table>";
	
	$condicion=" codi_usu<>0 and  ";
		
	if(!empty($codusu)){
	    $condicion=$condicion."cod_usu='$codusu'  AND ";}
		
	if(!empty($num_fac)){
	    $condicion=$condicion."num_fac='$num_fac' AND ";}
		
	if(!empty($fein_per)){
	    $condicion=$condicion."fec_ent='$fein_per' AND ";}
	
	if(!empty($feeg_per)){
	    $condicion=$condicion."fec_rec='$feeg_per' AND ";}
	
	if(!empty($condicion)){
	  $condicion=substr($condicion,0,(strlen($condicion)-5));}
	
		
	if(!empty($condicion)){
	$_pagi_sql="SELECT num_fac, fec_rec, fec_ent,cod_usu,codi_usu  FROM factura WHERE $condicion  ORDER BY cod_usu";}
	else{
	$_pagi_sql="SELECT num_fac, fec_rec, fec_ent,cod_usu,codi_usu  FROM factura WHERE fec_rec='2010/08/20' and fec_ent='2010/08/20' ORDER BY cod_usu";}
	  
    $_pagi_cuantos = 18; 
	
	//echo $_pagi_sql;
	include("php/paginator.inc.php"); 
	
	if(mysql_num_rows($_pagi_result)!=0) 
	{ 
	  echo "<table class='Tbl0'>";
	  echo "<th class='Td1' width='5%'>OPCION</th>";
	  echo "<th class='Td1' width='10%'>IDEN</font></th>
		    <th class='Td1' width='30%'>NOMBRE</font></th>
			<th class='Td1' width='10%'>SEXO</font></th>
			<th class='Td1' width='10%'>EDAD</font></th>
			<th class='Td1' width='10%'>CONTRATO</font></th>";
	  
	  while($row=mysql_fetch_array($_pagi_result))
	  {
		  echo "<tr>";
		  $cod_usu=$row[codi_usu];
		  $cons_usu=mysql_query("SELECT NROD_USU,CODI_CON,CODI_USU, PNOM_USU, SNOM_USU, PAPE_USU, SAPE_USU, FNAC_USU, SEXO_USU,TPAF_USU,MATE_USU,CONT_UCO,NEPS_CON,IDEN_UCO,MRES_USU 
		   FROM usuario, ucontrato,contrato 
		   WHERE CODI_USU=CUSU_UCO AND CONT_UCO=CODI_CON AND CODI_USU = '$cod_usu'"); 
		
		  $rowusu = mysql_fetch_array($cons_usu);
		   echo "<td class='Td2'>
		   <a href='#' onclick='buscar()'><img hspace=0 width=10 height=12 src='icons\lupa.png' alt='Buscar' border=0 align='center'></a>
		   <a href='#' onclick='buscar()'><img hspace=0 width=10 height=12 src='icons\i_yes.gif' alt='Buscar' border=0 align='center'></a>
		   </td>";
		  echo "<td class='Td2'>$rowusu[NROD_USU]</td>";
		  echo "<td class='Td2'>$rowusu[PNOM_USU] $rowusu[SNOM_USU] $rowusu[PAPE_USU] $rowusu[SAPE_USU]</td>";
		  echo "<td class='Td2'>$rowusu[SEXO_USU]</td>"; 
		  $fnac=$rowusu['FNAC_USU'];
		  $edad=calcuedad($fnac);
		  echo "<td class='Td2'>$edad</td>"; 
		  echo "<td class='Td2'>$rowusu[NEPS_CON]</td>";
		  echo"</tr>";
	  }
	 
	  echo "</table>";
  
	  echo "<table class='Tbl2'>";
	  echo "<tr>";
      echo "<td class='Td1'>".$_pagi_navegacion."</td>";
  
	  echo "</tr>";
      echo "</table>";
    }
	else
	{
	  echo "<center>";
	  echo "<p class=Msg>No existen registros para esta busqueda</p>";
	  echo "</center>";
	}
	function calcuedad($fecha_nac)
    {
        //Esta funcion toma una fecha de nacimiento
        //desde una base de datos mysql
        //en formato aaaa/mm/dd y calcula la edad en nmeros enteros

        $dia=date("j");
        $mes=date("m");
        $anno=date("Y");

        //descomponer fecha de nacimiento
        $dia_nac=substr($fecha_nac, 8, 2);
        $mes_nac=substr($fecha_nac, 5, 2);
        $anno_nac=substr($fecha_nac, 0, 4);


        if($mes_nac>$mes)
        {
            $calc_edad= $anno-$anno_nac-1;
        }
        else
        {
            if($mes==$mes_nac AND $dia_nac>$dia)
            {
                $calc_edad= $anno-$anno_nac-1;
            }
            else
            {
                $calc_edad= $anno-$anno_nac;
            }
        }
        return $calc_edad;
    }
?>
 

</form>
</body>
</html>
