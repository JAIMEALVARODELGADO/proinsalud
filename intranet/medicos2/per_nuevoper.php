<html>
<head><title>Nueva Persona</title>

<!-- Funcion que valida que no queden en blanco los campos obligatorios -->
<script languaje="javascript">
function validar(form)
{
var error = "Por favor, para continuar,\ncomplete los siguientes campos:\n\n";
var a = ""
    if (form.cod_medi.value == "") { a += "C�digo\n"; }
    if (form.tido_medi.value == "") { a += "Tipo de Identificacion\n"; }
    if (form.ced_medi.value == "") { a += "C�dula\n"; }
    if (form.pnom_medi.value == "") { a += "Primer Nombre\n"; }
    if (form.pape_medi.value == "") { a += "Primer Apellido\n"; }
    if (form.reg_medi.value == "") { a += "Registro\n"; }
    if (form.esta_medi.value == "") { a += "Estado\n"; }
    if (form.areas_ar.value == "") { a += "Area\n"; }
    if (form.espe_med.value == "") { a += "Especialidad\n"; }
    if (a != "") 
    { alert(error + a);return true;}
	form.action="per_guardaper.php"
	form.submit()
}
function validasig(){
	form1.validacod.value='1';
	form1.csii_med.value=(form1.cod_medi.value.substr(form1.cod_medi.value.length-4,4));
	form1.action="per_nuevoper.php";
	form1.submit()
}

</script>
</head>
<body >

<form method="POST" name="form1"><br>
<input type="hidden" name="validacod">
<?
//Conexion con la base
include ('php/conexion.php');
?>
  <center><h2>Nueva Persona</h2></center>
  
  
  
<?php
	$mensa1='';
	if($validacod=='1')
	{
		$bmed=mysql_query("SELECT * FROM medicos WHERE cod_medi='$cod_medi'");
		if(mysql_num_rows($bmed)>0)
		{
			
			$mensa1="El codigo ".$cod_medi." ya existe";
			$cod_medi='';
			$csii_med='';
		}
		else
		{
			
			$bmeds=mysql_query("SELECT * FROM medicos WHERE csii_med='$csii_med'");
			if(mysql_num_rows($bmeds)>0)
			{
				$rep=1;
				while($rep==1)
				{
					$csii_med=$csii_med+1;
					$bmedn=mysql_query("SELECT * FROM medicos WHERE csii_med='$csii_med'");
					if(mysql_num_rows($bmedn)==0)
					{
						$rep=0;
					}
				}
			}
		}
	}
	if($mensa1!='')
	{
		echo"<center><h3><font color=red>$mensa1</font></h3></center><br>";
	}
?>


<table border="1" width="100%" align="center" BorderColor=#FFFFFF bgcolor="#D0D0F0" cellpadding=0 Cellspacing=1 style="font-size:11;font-family:Arial;font-weight:bold">
  <tr>
  <td align="right">Codigo:</td>
  <td><input type=text name="cod_medi" size=20 maxlength=20 value='<?echo $cod_medi?>' onblur="validasig()" ></td>  
  
  <td align="right">Tipo de Identificacion:</td>
  <td><select name="tido_medi">
          <option value=""></option>
          <option value="CC">Cedula de Ciudadania</option>
          <option value="CE">Cedula de Extranjeria</option>
          <option value="PA">Pasaporte</option>
      </select>
  </td>
  <td align="right">Numero:</td>
  <td><input type=text name="ced_medi" size=10 maxlength=10</td>
  </tr>
  <tr>
      <td align="right">Primer Nombre:</td>
      <td><input type=text name="pnom_medi" size=20 maxlength=20></td>
      <td align="right">Segundo Nombre:</td>
      <td><input type=text name="snom_medi" size=30 maxlength=30></td>
      <td align="right">Primer Apellido:</td>
      <td><input type=text name="pape_medi" size=20 maxlength=20></td>
      <td align="right">Segundo Apellido:</td>
      <td><input type=text name="sape_medi" size=30 maxlength=30></td>
  </tr>
  <tr>
      <td align="right">Direccion:</td>
      <td><input type=text name="dir_medi" size=30 maxlength=40></td>
      <td align="right">Telefono:</td>
      <td><input type=text name="telf_medi" size=10 maxlength=10></td>
      <td align="right">Cargo:</td>
      <td><input type=text name="are_medi" size=35 maxlength=40></td>
  </tr>
  <tr>
  <td align="right">Reg M�dico:</td>
  <td><input type=text name="reg_medi" size=20 maxlength=20></td>
  <td align="right">Estado:</td>
  <td><select name="esta_medi">
          <option value=''></option>
          <option value='A' selected='true'>Activo</option>
	</select></td>
  <td align="right">Area:</td>
  <td><select name="areas_ar"><option value=''>
  <?
    $consulta=mysql_query("SELECT cod_areas,nom_areas FROM areas ORDER BY nom_areas");
    while($row=mysql_fetch_array($consulta)){
        echo "<option value='$row[cod_areas]'>$row[nom_areas]";
    }
    mysql_free_result($consulta);
  ?>
  </td>
  </tr>
  <tr>
    <td align="right">Especialidad:</td>
    <td><select name='espe_med'><option value=''>
        <?
        $consulta=mysql_query("SELECT codi_des,nomb_des FROM destipos WHERE codt_des='26' AND valo_des<>'' ORDER BY nomb_des");
        while($row=mysql_fetch_array($consulta)){
            echo "<option value='$row[codi_des]'>$row[nomb_des]";
        }
        mysql_free_result($consulta);        
        ?>
	  </select>
	</td>
    <td align="right">C�d SIIGO:</td>
    <td><?echo $csii_med?></td>
	<input type="hidden" name="csii_med" value='<?echo $csii_med?>'>
  </tr>
  <tr>
    <td align="right">Cód CUPS Primera vez:</td>
    <td><input type="text" name="cupmp_medi" size=6 maxlength=6></td>
    <td align="right">Cód CUPS Control:</td>
    <td><input type="text" name="cupmc_medi" size=6 maxlength=6></td>
  </tr>
 </table>

<center><b><?echo $mensaje?></center>
<br>
<center><input type="button" name="btnnuevo" value="Guardar" onclick="validar(this.form)"></center>
</center>
</form>
</body>
</html>