<html>
<head>
<title>PROGRAMA DE FACTURACI�N</title>
<link rel="stylesheet" href="css/style.css" type="text/css" />
<script language='javascript'>
function crear(iden_,cont_){    //fac_editmedinsxcon.php?iden_ctr=$row[iden_ctr]
    if(confirm("Desea tomar la parametrizaci�n de otro ontrato, para el contrato "+cont_)){
        //alert(iden_);
        //alert(cont_);
        window.open("fac_duplicaccion.php?iden_ctr="+iden_,"fr02");
    }
    return(false);
}

</script>

</head>
<body>
<?
include('php/funciones.php');
include('php/conexion.php');
$condicion="";
if(!empty($codi_con)){
  $condicion=$condicion."codi_con='$codi_con' AND ";}

if(!empty($condicion)){
  $condicion=substr($condicion,0,(strlen($condicion)-5));
}
$consultacon=mysql_query("SELECT nit_con,neps_con,dire_con,tele_con,pers_con FROM contrato WHERE $condicion");
$rowcon=mysql_fetch_array($consultacon);
echo "<table class='Tbl0'>";
echo "<th class='Th0' width='15%'>NIT</th>
	  <th class='Th0' width='40%'>ENTIDAD</th>
	  <th class='Th0' width='15%'>CONTACTO</th>
	  <th class='Th0' width='15%'>TELEFONO</font></th>";
echo "<tr>";
echo "<td class='Td2'>$rowcon[nit_con]</td>";
echo "<td class='Td2'>$rowcon[neps_con]</td>";
echo "<td class='Td2'>$rowcon[pers_con]</td>";
echo "<td class='Td2'>$rowcon[tele_con]</td>";
echo "</tr>";
echo "</table>";
echo "<br>";
echo "<table class='Tbl0'><tr><td class='Td0' align='center'>LISTADO DE CONTRATOS</td></tr></table>";
$sql="SELECT iden_ctr,nume_ctr,fini_ctr,ffin_ctr,mont_ctr,moda_ctr,esta_ctr FROM contratacion WHERE $condicion";
$sql=mysql_query($sql);
//include("php/paginator.inc.php"); 
if(mysql_num_rows($sql)!=0) {
  echo "<table class='Tbl0'>";
  echo "<th class='Th0' width='20%' colspan='11'>OPCIONES</th>
        <th class='Th0' width='15%'>N�mero</th>
	<th class='Th0' width='15%'>Fecha Inicial</th>
	<th class='Th0' width='15%'>Fecha Final</th>
	<th class='Th0' width='15%'>Monto</th>
	<th class='Th0' width='15%'>Modalidad</th>
	<th class='Th0' width='8%'>Estado</th>";
		
  while($row=mysql_fetch_array($sql)){
    echo "<tr>";
    //echo $row[iden_ctr];
    echo "<td class='Td4'><a href='fac_editccion.php?iden_ctr=$row[iden_ctr]' title='Editar Contrato'><img src='icons/feed_edit.png' border='0' alt='Editar Contrato'></a></td>";
    echo "<td class='Td4'><a href='fac_creaactxcon.php?iden_ctr=$row[iden_ctr]' title='Adicionar Actividades al Contrato'><img src='icons/feed_add.png' border='0' alt='Adicionar Actividades al Contrato'></a></td>";
    echo "<td class='Td4'><a href='fac_editactxcon.php?iden_ctr=$row[iden_ctr]' title='Edita Actividades Contratadas'><img src='icons/feed_go.png' border='0' alt='Edita Actividades Contratadas'></a></td>";
    echo "<td class='Td4'><a href='fac_creagrpxcon.php?iden_ctr=$row[iden_ctr]' title='Adicionar grupos Qx al Contrato'><img src='icons/feed_link.png' border='0' alt='Adicionar grupos Qx al Contrato'></a></td>";
    echo "<td class='Td4'><a href='fac_editgrpxcon.php?iden_ctr=$row[iden_ctr]' title='Edita grupos Qx del Contrato'><img src='icons/feed.png' border='0' alt='Edita grupos Qx del Contrato'></a></td>";
    echo "<td class='Td4'><a href='fac_creamedinsxcon.php?iden_ctr=$row[iden_ctr]' title='Adicionar Medicamentos e Insumos al Contrato'><img src='icons/feedmedicamento1.png' border='0' alt='Adicionar Medicamentos e Insumos al Contrato' width='18' height='18'></a></td>";
    echo "<td class='Td4'><a href='fac_editmedinsxcon.php?iden_ctr=$row[iden_ctr]' title='Editar Medicamentos e Insumos del Contrato'><img src='icons/rss-noreflection.png' border='0' alt='Editar Medicamentos e Insumos del Contrato' width='18' height='18'></a></td>";
    echo "<td class='Td4'><a href='#' onclick='crear($row[iden_ctr],\"$row[nume_ctr]\")' title='Tomar Actividades Parametrizadas de Otro Contrato'><img src='icons/herra.gif' border='0' alt='Tomar Actividades Parametrizadas de Otro Contrato' width='18' height='18'></a></td>";
    echo "<td class='Td4'><a href='fac_impreccion.php?iden_ctr=$row[iden_ctr]' target='blank' title='Listar lo contratado'><img src='icons/feed_magnify.png' border='0' alt='Listar lo contratado'></a></td>";
    echo "<td class='Td4'><a href='fac_editavaloractiv.php?iden_ctr=$row[iden_ctr]&codi_con=\"$codi_con\"' title='Incrementar o Decrementar el Valor'><img src='icons/feed_porcentaje2.png' border='0' alt='Incrementar o Decrementar el Valor' width='17' height='17'></a></td>";
    echo "<td class='Td4'><a href='fac_parametrizartarifas1.php?iden_ctr=$row[iden_ctr]&codi_con=$codi_con' title='Parametrizar desde un archivo plano'><img src='icons/pos.png' border='0' alt='Parametrizar desde un archivo plano' width='17' height='17'></a></td>";
    echo "<td class='Td2'>$row[nume_ctr]</td>";
    echo "<td class='Td2'>".cambiafechadmy($row[fini_ctr])."</td>";
    echo "<td class='Td2'>".cambiafechadmy($row[ffin_ctr])."</td>";
    echo "<td class='Td2'>$row[mont_ctr]</td>";
    if($row[moda_ctr]=='1'){$modalidad='Capitado';}
    else{$modalidad='Evento';}
    echo "<td class='Td2'>$modalidad</td>";
    echo "<td class='Td2'>$row[esta_ctr]</td>";
    echo"</tr>";
  }
  echo "</table>";
  echo "<table class='Tbl2'>";
  echo "<tr>";
  //echo "<td class='Td1'>".$_pagi_navegacion."</td>";
  //echo "<td class='Td1'>Contratos: ".$_pagi_info."</td>";
  echo "</tr>";
  echo "</table>";
  mysql_free_result($sql);
}
else{
  echo "<center>";
  echo "<p class=Msg>No existen registros para esta busqueda</p>";
  echo "</center>";
}
mysql_free_result($consultacon);
mysql_close();
?>

</body>
</html>