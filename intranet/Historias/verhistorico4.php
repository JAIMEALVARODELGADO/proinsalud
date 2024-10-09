<html><head><title>Antecedentes</title>
<script language="JavaScript1.2" src="style1.js"></script>
<script language='javascript'>
function imprimir(serie_) 
{
var URL="../consultav3/impre_consul.php?serie="+serie_+"&histo1=on";
//var URL="impre_consul.php?serie="+serie_;
var titulo="Historia" 
var x=0 
var y=0 
var ancho=1000
var alto=700
var herramientas=0
var direccion=0
var barras=1
ventana= window.open(URL,titulo,"left="+x+",top="+y+",width="+ancho+",height="+alto+",toolbar="+herramientas+",location="+direccion+",scrollbars="+barras) 
} 

function imprimir2(iden_evo) 
{
var URL="/intranet/uci/imprehis.php?iden_evo="+iden_evo;
var titulo="Historia" 
var x=0 
var y=0 
var ancho=1000
var alto=700
var herramientas=0
var direccion=0
var barras=1
ventana= window.open(URL,titulo,"left="+x+",top="+y+",width="+ancho+",height="+alto+",toolbar="+herramientas+",location="+direccion+",scrollbars="+barras) 
} 
</script>

</head>
<body>
<form name="form21" method="POST">
<BR>
<?
if ($areac==01){
  echo "<table border=0><tr><td bgcolor=#FFCC33><b>Historias Clinicas</b></td></tr></table>";}
else{
  echo "<table border=0><tr><td bgcolor=#FFCC33><b>Evoluciones</b></td></tr></table>";}
?>

<?php
//$Gcontme="verdadero";
//$Gbanderaref="false";
include ('../Libreria/Php/conexiones_g.php');
include ('../Libreria/Php/sql.php');

base_proinsalud();
$cad="select * from usuario where NROD_USU='$cedula'";
$resusu=mysql_query($cad);
$fila=mysql_fetch_array($resusu);
$idusu=$fila['CODI_USU'];
$nom1=$fila['PNOM_USU'];
$nom2=$fila['SNOM_USU'];
$ape1=$fila['PAPE_USU'];
$ape2=$fila['SAPE_USU'];

$nombre= $nom1.' '.$nom2.' '.$ape1.' '.$ape2;
echo "<table border=0><tr>
<td bgcolor=#FFCC33><b>Identificación:</td>
<td>$cedula</td>
<td bgcolor=#FFCC33><b>Nombre:</td>
<td>$nombre</td>
</tr></table>";
?>
<center>
<table border='1'  bordercolor='#FFCC66' width='100%'>
  <th width='5%' bgcolor='#FFCC33' align='center'><font face='Arial' size='2'><b>Opc</b></font></td>
  <th width='8%' bgcolor='#FFCC33' align='center'><font face='Arial' size='2'><b>Fecha</b></font></td>
  <th width='10%' bgcolor='#FFCC33' align='center'><font face='Arial' size='2'><b>Medico</b></font></td>
  <th width='5%' bgcolor='#FFCC33' align='center'><font face='Arial' size='2'><b>Dx</b> </font></td>
  <th width='24%' bgcolor='#FFCC33' align='center'><font face='Arial' size='2'><b>Ayudas</b></font></td>
  <th width='24%' bgcolor='#FFCC33' align='center'><font face='Arial' size='2'><b>Referencias</b></font></td>
  <th width='24%' bgcolor='#FFCC33' align='center'><font face='Arial' size='2'><b>Medicamentos</b></font></td>
<?
if ($areac==01 ){
  $consulta=mysql_query("SELECT numc_ehi,nomb_ehi,muat_ehi,telf_ehi, sexo_ehi,fnac_ehi,dire_ehi,cont_ehi,idus_ehi,cous_ehi,feco_ehi 
                         FROM encabesadohistoria  WHERE cous_ehi='$idusu' ORDER BY encabesadohistoria.feco_ehi DESC");
  if(mysql_num_rows($consulta)==0){
     echo "</table><h2>No hay Historico de Este usuario</h2>";}
  else{
    while($row=mysql_fetch_array($consulta)){
      $consultamed=mysql_query("SELECT consultaprincipal.cod1_cpl, consultaprincipal.numc_cpl, medicos.nom_medi 
	              FROM consultaprincipal INNER JOIN medicos ON consultaprincipal.come_cpl = medicos.cod_medi 
				  WHERE (((consultaprincipal.numc_cpl)='$row[numc_ehi]'))");
      while($rowmed=mysql_fetch_array($consultamed)){
        $medico=$rowmed["nom_medi"];
        $dx_prin=$rowmed["cod1_cpl"];
      }
	  $consultaayu=mysql_query("SELECT ayudasdiagnosticas.numc_adx, cie_10.cod_cie10, cie_10.nom_cie10, mapipos.nomb_map
                                FROM (ayudasdiagnosticas
                                INNER JOIN cie_10 ON ayudasdiagnosticas.ccie_adx = cie_10.cod_cie10 )
                                INNER JOIN mapipos ON ayudasdiagnosticas.coda_adx = mapipos.codi_map
                                WHERE ayudasdiagnosticas.numc_adx ='$row[numc_ehi]'");
      $ayuda_dx="";
      while($rowayu=mysql_fetch_array($consultaayu)){
        $ayuda_dx=$ayuda_dx." ".$rowayu["nomb_map"];
	  }
	  $consultamto=mysql_query("SELECT medicamentosenv.cant_men, medicamentosenv.obse_men, medicamentos.nomb_mdi, medicamentosenv.numc_men
                                FROM ( medicamentosenv
                                INNER JOIN medicamentos ON medicamentosenv.cmed_men = medicamentos.codi_mdi )
                                INNER JOIN cie_10 ON medicamentosenv.ccie_men = cie_10.cod_cie10
                                WHERE medicamentosenv.numc_men='$row[numc_ehi]'");
      $med_dx="";
      while($rowmto=mysql_fetch_array($consultamto)){
        $med_dx=$med_dx." ".$rowmto["nomb_mdi"];
      }
      // referencia
	  $consultaref=mysql_query("SELECT referencia.alse_ref, referencia.numc_ref, destipos.nomb_des, referencia.ccie_ref
                                FROM referencia INNER JOIN destipos ON referencia.alse_ref = destipos.codi_des
                                WHERE numc_ref='$row[numc_ehi]'");
      $ref_dx="";
      while($rowref=mysql_fetch_array($consultaref)){
        $ref_dx=$ref_dx." ".$rowp44["nomb_des"];
      }
      $historia=$row["idus_ehi"];
      $nombre=$row["nomb_ehi"];
      $feco=$row["feco_ehi"];
	  echo "<tr>";
	  echo "<td><a href='#' onclick='imprimir(\"$row[numc_ehi]\")'><img src='img/feed_magnify.png' border=0></a></td>";
      echo '<td align=left bgcolor=#F2F4F9><font size=1>'.$feco.'</font></td>';
      echo '<td align=left bgcolor=#F2F4F9><font size=1>'.strtolower($medico).'</font></td>';    
      echo '<td align=left bgcolor=#F2F4F9><font size=1>'.$dx_prin.'</font></td>';
      echo '<td align=left bgcolor=#F2F4F9><font size=1>'.$ayuda_dx.'</font></td>';
      echo '<td align=left bgcolor=#F2F4F9><font size=1>'.$ref_dx.'</font></td>';  
      echo '<td align=left bgcolor=#F2F4F9><font size=1>'.strtolower($med_dx).'</font></td>';
	  echo '</tr>';
   }
 }
}
else{
  $consulta=mysql_query("SELECT hist_evo.iden_evo, medicos.nom_medi, hist_evo.cod_cie10, hist_evo.fech_evo, hist_evo.cama_evo, hist_evo.esta_evo, hist_evo.codi_usu, usuario.NROD_USU
                         FROM (hist_evo INNER JOIN medicos ON hist_evo.cod_medi = medicos.cod_medi) INNER JOIN usuario ON hist_evo.codi_usu = usuario.CODI_USU
                         WHERE (((hist_evo.codi_usu)='$idusu')) ORDER BY hist_evo.fech_evo DESC");
  if(mysql_num_rows($consulta)==0){
    echo "</table><h2>No hay Historico de Este usuario</h2>";
  }
  else{
	while($row=mysql_fetch_array($consulta)){
      $fech_evo=$row["fech_evo"];
      $medico=$row["nom_medi"];
      $dx_prin=$row["cod_cie10"];
      $numeroconsulta=$row["iden_evo"];
      $consultamed=mysql_query("SELECT hist_evo.iden_evo, hist_evo.codi_usu, hdet_med.codi_mdi, hdet_med.dosi_med, hdet_med.unid_med, hdet_med.via_med, hdet_med.frec_med, medicamentos2.nomb_mdi, hdet_med.esta_med
                                FROM (hist_evo INNER JOIN (hdet_med INNER JOIN henc_med ON hdet_med.idor_med = henc_med.idor_med) ON hist_evo.iden_evo = henc_med.iden_evo) INNER JOIN medicamentos2 ON hdet_med.codi_mdi = medicamentos2.codi_mdi
                                WHERE (((hist_evo.iden_evo)='$numeroconsulta'))");
      $med_dx="";
      while($rowmed=mysql_fetch_array($consultamed)){ 
        $med_dx=$med_dx." ".$rowmed["nomb_mdi"];
      }
	  $consultaayu=mysql_query("SELECT hist_evo.iden_evo, hist_evo.codi_usu, cups.descrip, hist_var.obse_var, hist_var.clas_var, hist_var.esta_var
                                FROM (hist_evo INNER JOIN hist_var ON hist_evo.iden_evo = hist_var.iden_evo) INNER JOIN cups ON hist_var.iden_ser = cups.codigo
                                WHERE (((hist_evo.iden_evo)='$numeroconsulta'))");
      $ayuda_dx="";
      while($rowayu=mysql_fetch_array($consultaayu)){ 
        $ayuda_dx=$ayuda_dx." ".$rowayu["descrip"];
      }
	  $consultaref=mysql_query("SELECT hist_evo.iden_evo, hist_evo.codi_usu, hist_var.iden_ser, destipos.nomb_des, hist_var.obse_var, hist_var.clas_var, hist_var.esta_var
                                FROM (hist_evo INNER JOIN hist_var ON hist_evo.iden_evo = hist_var.iden_evo) INNER JOIN destipos ON hist_var.iden_ser = destipos.codi_des
                                WHERE (((hist_evo.iden_evo)='$numeroconsulta'))");
      while($rowref=mysql_fetch_array($consultaref)){ 
        $ref_dx=$ref_dx." ".$rowp43["nomb_des"];
      }
	  echo "<tr>";
	  echo "<td><a href='#' onclick='imprimir2(\"$numeroconsulta\")'><img src='img/feed_magnify.png' border=0></a></td>";
	  echo '<td bgcolor=#F2F4F9><font size=1>'.$fech_evo.'</font></td>';
	  echo '<td align=left bgcolor=#F2F4F9><font size=1>'.strtolower($medico).'</font></td>';
      echo '<td align=left bgcolor=#F2F4F9><font size=1>'.$dx_prin.'</font></td>';          //CODIGO USUARIO
      echo '<td bgcolor=#F2F4F9><font size=2>'.strtolower($ayuda_dx).'</font></td>';    
      echo '<td bgcolor=#F2F4F9><font size=2>'.$ref_dx.'</font></td>';  
      echo '<td bgcolor=#F2F4F9><font size=2>'.strtolower($med_dx).'</font></td>';
	  echo "</tr>";
    }
  }
}

?>
</table>
<br>
</form >
</center>
</center>
</body>
</html>