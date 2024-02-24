<!--Actualiza contrato -->
<html>
<head>

<?
//Aqui cargo las funciones
//include("funciones.php");

?>

<script languaje="javascript">
function atras(){
history.go(-1)
}
</script>

</head>
<body bgcolor="#E6E8FA">

<br>
<?
set_time_limit(0);
//Conexion con la base
mysql_connect("localhost","root","VJvj321"); 
//selección de la base de datos con la que vamos a trabajar 
mysql_select_db("proinsalud");
$consulta="SELECT fac.iden_fac,fac.codi_con,fac.iden_ctr,ccion.codi_con 
    FROM encabezado_factura AS fac 
    INNER JOIN contratacion AS ccion ON ccion.iden_ctr=fac.iden_ctr
    WHERE fac.codi_con=''";
echo "<br>".$consulta;
$consulta=mysql_query($consulta);
$contador=0;                       
while($row=mysql_fetch_array($consulta)){
  echo "<br>".$row[iden_fac];
  $contador++;
  $actualiza="UPDATE encabezado_factura SET codi_con='$row[codi_con]' WHERE iden_fac=$row[iden_fac]";
  echo "<br>".$actualiza;
  $actualiza=mysql_query($actualiza);
}
echo "<br>Total...".$contador;
mysql_free_result($consulta);
mysql_close();

?>
</form>
</body>
</html>


