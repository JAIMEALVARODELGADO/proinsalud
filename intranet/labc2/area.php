<html>
<head><title>Solicitudes por áreas</title>
</head>
<body>
<form name="form1" method="POST" action="busq_area.php" target="Fr04">
<?	$con = mysql_connect("localhost","root","") or die (mysql_error()); 
	mysql_select_db("proinsalud",$con) or die (mysql_error());?>
<Table width="40%" align="center" cellpadding='0' Cellspacing='1'>
  <td width="15%" align="right"><b><font size=2 face="arial">Servicio:</font></td>
  <td width="35%"><select name="ser"><option value=''>
   <?
		  $ser=mysql_query("SELECT codi_des,nomb_des,codt_des FROM destipos WHERE codt_des LIKE '06' order by nomb_des");
		  while ($rowx=mysql_fetch_array($ser))
		  {
	      echo "<option value='$rowx[codi_des]'>$rowx[nomb_des]";
		   
		  }
  ?>
  </select>
  
  </td>
    <td ><button type=submit value=Cargar name="B">
      <div align="center"><img src=imagenes\busqueda.gif border=0>
	     </div>
    </button></td>
</tr>
</table>
</form>
</body>
</html>
