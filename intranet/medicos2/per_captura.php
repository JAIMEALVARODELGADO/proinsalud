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
  <td align="right">Reg Médico:</td>
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
    <td align="right">Cód SIIGO:</td>
    <td><input type="text" name="csii_med" size=4 maxlength=4></td>
  </tr>
 </table> 