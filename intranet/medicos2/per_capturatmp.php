  <table border="0" width="100%" align="center" BorderColor=#FFFFFF bgcolor="#D2DAD2" cellpadding=0 Cellspacing=1 style="font-size:11;font-family:Arial;font-weight:bold">
  <tr>
  
  <td align="right">Tipo de Identificacion:</td>
  <td><select name="tipo_iden">
          <option value=""></option>
          <option value="CC">Cedula de Ciudadania</option>
          <option value="CE">Cedula de Extranjeria</option>
          <option value="PA">Pasaporte</option>
      </select>
  </td>
  <td align="right">Numero:</td>
  <td><input type=text name="numer_iden" size='20' maxlength='20' onblur='recargar()'/></td>
  </tr>
  <tr>
      <td align="right">Primer Nombre:</td>
      <td><input type=text name="pnombre" size='20' maxlength='20'></td>
      <td align="right">Segundo Nombre:</td>
      <td><input type=text name="snombre" size='20' maxlength='20'></td>
  </tr>
  <tr>
      <td align="right">Primer Apellido:</td>
      <td><input type=text name="papellido" size='20' maxlength='20'></td>
      <td align="right">Segundo Apellido:</td>
      <td><input type=text name="sapellido" size='20' maxlength='20'></td>
  </tr>
  <tr>
      <td align="right">Fecha de Nacimiento:</td>
      <td><input type='date' name="fecha_nac"></td>

      <td align="right">Sexo:</td>
      <td><select name="sexo">
          <option value=""></option>
          <option value="M">Masculino</option>
          <option value="F">Femenino</option>
        </select>
      </td>
  </tr>
  <tr>
      <td align="right">Direccion:</td>
      <td><input type='text' name="direccion" size='50' maxlength='50'></td>
      <td align="right">Telefono:</td>
      <td><input type='text' name="telefono" size='10' maxlength='10'></td>
  </tr>
  <tr>
  <td align="right">Correo Electrónico:</td>
  <td><input type='text' name="email" size='50' maxlength='50'></td>
  <td align="right">Hemoclasificación:</td>
  <td><select name="hemoclasif">
          <option value=''></option>
          <option value='A+'>A+</option>
          <option value='B+'>B+</option>
          <option value='O+'>O+</option>
          <option value='AB+'>AB+</option>
          <option value='A-'>A-</option>
          <option value='B-'>B-</option>
          <option value='O-'>O-</option>
          <option value='AB-'>AB-</option>
	   </select></td>
  </tr>
 </table>
