<html>
<head><title>Muestra Areas del Médico</title>

<script languaje="javascript">
function atras()
{
  history.go(-1)
}

function especialidad(){
  //alert();
  document.per_muesaremed.action='per_nuevaespemed.php';
  document.per_muesaremed.submit();
}

function borrar_espe(id_mesp,desc_){  
  if(confirm("Desea Eliminar la Especialidad: "+desc_+" ?")){    
    document.per_muesaremed.id_mesp.value=id_mesp;
    document.per_muesaremed.action="per_borraespmed.php";
    document.per_muesaremed.submit();
  }
}
</script>

</head>
<body >

<form name="per_muesaremed" method="POST" action='per_nuevaarexmed.php'><br>
<?
include ('php/funciones.php');
//Conexion con la base
include ('php/conexion.php');
$consulta=mysql_query("SELECT m.cod_medi,m.nom_medi,m.dir__medi,m.telf_medi FROM medicos m WHERE m.cod_medi='$cod_medi'");
$row=mysql_fetch_array($consulta);
?>
<table border="1" width="80%" align="center" BorderColor=#FFFFFF bgcolor="#D0D0F0" cellpadding=0 Cellspacing=1>
<tr>
  <td width="15%" align="right"><b><font size=2 face="arial">Codigo:</font></td>
  <td width="35%"><?echo $cod_medi;?></td>
  <td width="15%" align="right"><b><font size=2 face="arial">Nombre:</font></td>
  <td width="35%"><?echo $row[nom_medi];?></td>
</tr>
<tr>
  <td width="15%" align="right"><b><font size=2 face="arial">Dirección:</font></td>
  <td width="35%"><?echo $row['dir__medi'];?></td>
  <td width="15%" align="right"><b><font size=2 face="arial">Teléfono:</font></td>
  <td width="35%"><?echo $row[telf_medi];?></td>
</tr>

</table>


  <!-- Aqui se captura areas -->
  <Table border="0" BgColor="#FFFFFF" BorderColor=#E6E8FA width="80%" align="center" cellpadding=0 Cellspacing=1>    
    <th>Areas</th><th>Especialidades</th>
    <tr>
      <td>
        <Table border="0" BgColor="#FFFFFF" BorderColor=#E6E8FA width="80%" align="center" cellpadding=0 Cellspacing=1>    
          <th bgcolor="#D0D0F0">Descripción</th><th bgcolor="#D0D0F0">Estado</th><th bgcolor="#D0D0F0" colspan='3'>Opciones</th>
          <?
          //$consulta=mysql_query("SELECT m.cod_medi,a.nom_areas,d.cod_ar,d.esta_ar FROM medicos m,areas a,areas_medic d WHERE m.cod_medi=d.cod_med_ar and d.areas_ar=a.cod_areas and m.cod_medi='$cod_medi' ORDER BY nom_areas");
          $consulta="SELECT m.cod_medi,a.nom_areas,d.cod_ar,d.esta_ar 
          FROM medicos m
          inner join areas_medic d on m.cod_medi=d.cod_med_ar
          inner join areas a on a.cod_areas=d.areas_ar
          WHERE m.cod_medi='$cod_medi' ORDER BY nom_areas";
          $consulta=mysql_query($consulta);
          $colfondo="#D8E5F9";
          while($row=mysql_fetch_array($consulta)){
            echo "<tr>";
            $nom_est=estado($row[esta_ar]);
            echo "<td width='60%' align='left' bgcolor=$colfondo><font size=2>$row[nom_areas]</font></td>";
            echo "<td width='20%' align='left' bgcolor=$colfondo><font size=2>$nom_est</font></td>";
            if($row[esta_ar]=='A'){
              echo "<td width='10%' align=center bgcolor=$colfondo><a href='per_estarexmed.php?cod_medi=$row[cod_medi]&cod_ar=$row[cod_ar]&esta_ar=$row[esta_ar]'><img hspace=5 width=22 height=22 src='imagenes\inactivar.ico' title='Inctivar' border=0></a></td>";}
            else{
              echo "<td width='10%' align=center bgcolor=$colfondo><a href='per_estarexmed.php?cod_medi=$row[cod_medi]&cod_ar=$row[cod_ar]&esta_ar=$row[esta_ar]'><img hspace=5 width=22 height=22 src='imagenes\activar.ico' title='Activar' border=0></a></td>";}
            echo "<td width='10%' align=center bgcolor=$colfondo><a href='per_nuevaarexmed.php?cod_medi=$row[cod_medi]'><img hspace=5 width=25 height=25 src='imagenes\DOC11D.ICO' title='Agregar Area' border=0></a></td>";
            echo "</tr>";
            if ($colfondo=="#D8E5F9"){
              $colfondo="#FAFAD4";}
            else{
              $colfondo="#D8E5F9";}
          }
         
          ?>
          <tr><td colspan='4' align='center'><input type="submit" name="nuevo" value="Asignar Nueva Area"></td></tr>
        </table>
      </td>

      <!-- Aqui se captura especialidades -->
      <td>
        <Table border="0" BgColor="#FFFFFF" BorderColor=#E6E8FA width="80%" align="center" cellpadding=0 Cellspacing=1>    
          <th bgcolor="#D0D0F0">Descripción</th><th bgcolor="#D0D0F0" colspan='3'>Opciones</th>
          <?  
          $colfondo="#D8E5F9";
          $consulta="SELECT id_mesp,cod_medi,nomb_des FROM medico_especialidad
          INNER JOIN destipos ON destipos.codi_des =medico_especialidad.espe_medi 
          WHERE cod_medi='$cod_medi'
          ORDER BY nomb_des";
          //echo $consulta;
          $consulta=mysql_query($consulta);
          while($row=mysql_fetch_array($consulta)){
            echo "<tr>";
            echo "<td width='60%' align='left' bgcolor=$colfondo><font size=2>$row[nomb_des]</font></td>";
            //echo "<td width='20%' align='left' bgcolor=$colfondo><font size=2>$nom_est</font></td>";
            /*if($row[esta_ar]=='A'){
              echo "<td width='10%' align=center bgcolor=$colfondo><a href='per_estarexmed.php?cod_medi=$row[cod_medi]&cod_ar=$row[cod_ar]&esta_ar=$row[esta_ar]'><img hspace=5 width=22 height=22 src='imagenes\inactivar.ico' title='Inctivar' border=0></a></td>";}
            else{
              echo "<td width='10%' align=center bgcolor=$colfondo><a href='per_estarexmed.php?cod_medi=$row[cod_medi]&cod_ar=$row[cod_ar]&esta_ar=$row[esta_ar]'><img hspace=5 width=22 height=22 src='imagenes\activar.ico' title='Activar' border=0></a></td>";
            }*/
            //per_nuevaespemed.php?cod_medi=$row[cod_medi]
            echo "<td width='10%' align=center bgcolor=$colfondo><a href='#' onclick='borrar_espe($row[id_mesp],\"$row[nomb_des]\")'><img hspace=5 width=25 height=25 src='imagenes\Doc-234' title='Eliminar Especialidad' border=0></a></td>";
            echo "</tr>";
            if ($colfondo=="#D8E5F9"){
              $colfondo="#FAFAD4";}
            else{
              $colfondo="#D8E5F9";}
          }
         
          ?>
          <tr><td colspan='4' align='center'><input type="button" name="nuevo" value="Asignar Especialidad" onclick="especialidad()"></td></tr>
        </table>
      </td>
  </tr>
  
  </table>

  
  <input type="hidden" name="cod_medi" value="<?echo $cod_medi;?>">
  <input type="hidden" name="id_mesp" value="">
  <table border="0" width="80%" align="center" cellpadding=0 Cellspacing=1>
    <tr>
	  <td width='50%' align='center'><input type="button" name="regresar" value="Regresar" onclick="atras()"></td>
	  
    <tr>
  </table>
</form>
</body>
<?php
  mysql_free_result($consulta);
  mysql_close();
?>
</html>