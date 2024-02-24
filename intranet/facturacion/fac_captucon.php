<table class="Tbl0">
<tr>
  <td class="Td2" align='right'>Código</td>
  <td class="Td2" align='left'><input type='text' name='codi_' size='3' maxlength='3'><strong><font color='#FF6600'><?echo $msgcod;?></font></strong></td>
  <td class="Td2" align='right'>NIT</td>
  <td class="Td2" align='left'><input type='text' name='nit_con' size='12' maxlength='12'><strong><font color='#FF6600'><?echo $msgnit;?></font></strong></td>
</tr>
<tr>
  <td class="Td2" align='right'>Nombre</td>
  <td class="Td2" align='left'><input type='text' name='neps_con' size='50' maxlength='50'></td>
  <td class="Td2" align='right'>Código EPS</td>
  <td class="Td2" align='left'><input type='text' name='ceps_con' size='6' maxlength='6'></td>
</tr>
<tr>
  <td class="Td2" align='right'>Direccion</td>
  <td class="Td2" align='left'><input type='text' name='dire_con' size='40' maxlength='40'></td>
  <td class="Td2" align='right'>Telefono</td>
  <td class="Td2" align='left'><input type='text' name='tele_con' size='40' maxlength='40'></td>
</tr>
<tr>
  <td class="Td2" align='right'>Representante</td>
  <td class="Td2" align='left'><input type='text' name='repr_con' size='40' maxlength='40'></td>
  <td class="Td2" align='right'>Contacto</td>
  <td class="Td2" align='left'><input type='text' name='pers_con' size='40' maxlength='80'></td>
</tr>
<tr>
  <td class="Td2" align='right'>Cód. Habilitacion</td>
  <td class="Td2" align='left'><input type='text' name='chab_con' size='20' maxlength='20'></td>
  <td class="Td2" align='right'>Clasif. Tributaria</td>
  <td class="Td2" align='left'><select name='ctri_con'><option value=''>
      <option value='1'>Común
      <option value='2'>Simplificado
      <option value='3'>Autoretenedor
      <option value='4'>Gran Contribuyente
      <option value='5'>Entidad Pública
    </select>
</tr>
<tr>
  <td class="Td2" align='right'>Tipo Entidad</td>
  <td class="Td2" align='left'><select name='tpen_con'><option value=''>
  <?
    $consultatp=mysql_query("SELECT codi_des,nomb_des FROM destipos WHERE codt_des='31'");
	while($rowtp=mysql_fetch_array($consultatp)){
	  echo "<option value='$rowtp[codi_des]'>$rowtp[nomb_des]";
	}
  ?>
  </select>
  <td class="Td2" align='right'>Clase Entidad</td>
  <td class="Td2" align='left'><select name='clas_con'><option value=''>
      <option value='1'>Proveedor
	  <option value='2'>Contratante
	  <option value='3'>Proveedor/Contratante
    </select>
  </td>  
</tr>
<tr>
      <td class="Td2" align='right'>Centro de Costos:</td>
      <td class="Td2" align='left'><select name="codi_cdc"><option value=''>
              <?
              $conscc="SELECT * FROM centros_costo ORDER BY nomb_cdc";
              $conscc=mysql_query($conscc);
              while($rowcc=mysql_fetch_array($conscc)){
                  echo "<option value='$rowcc[codi_cdc]'>$rowcc[nomb_cdc](CC: $rowcc[codi_cdc])";
              }
              ?>              
        </select>
      </td>
      <td class="Td2" align='right'>Dias de Vigencia de las Ordenes:</td>
      <td class="Td2" align='left'><select name='vige_con'><option value=''>
              <option value="30">30
              <option value="60">60
              <option value="90">90
              <option value="120">120              
          </select>
      </td>
</tr>
<tr>
      <td class="Td2" align='right'>Nombre para facturación:</td>
      <td class="Td2" align='left' colspan="3"><input type='text' size='100' maxlength='100' name='nomr_con'></td>
</tr>
<tr>
      <td class="Td2" align='right'>Estado del contrato:</td>
      <td class="Td2" align='left'><select name='esta_con'>
              <option value='A' style="color:#04B404">Activo
              <option value='I' style="color:#FF0000">Inactivo
          </select>
      </td>
      <td class="Td2" align='right'>Codigo de Aseguradora:</td>
      <td class="Td2" align='left'><input type='text' size='6' maxlength='6' name='codase_con' onfocus="muestramsg('Este campo es necesario unicamente para recobros por accidente de transito')"></td>
</tr>
</table>
