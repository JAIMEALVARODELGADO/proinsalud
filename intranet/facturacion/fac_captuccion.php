<table class="Tbl0">
<tr>
  <td class="Td2" align='right'>Nmero</td>
  <td class="Td2" align='left'><input type='text' name='nume_ctr' size='10' maxlength='10' onblur="valida2(1)" value='<?echo $nume_ctr;?>'><strong><font color='#FF6600'><?echo $msgcod;?></font></strong></td>
  <td class="Td2" align='right'>Entidad</td>
  <td class="Td2" align='left'><select name='codi_con'><option value=''>
  <?
    $consultacon=mysql_query("SELECT codi_con,neps_con FROM contrato ORDER BY neps_con");
	while($rowcon=mysql_fetch_array($consultacon)){
	  echo "<option value='$rowcon[codi_con]'>$rowcon[neps_con]";
	}
  ?>
  </td>
</tr>
<tr>
  <td class="Td2" align='right'>Fecha de inicio</td>
  <td class="Td2" align='left'>
  <!-- formulario con el campo de texto y el botn para lanzar el calendario--> 
  <input type='text' name='fini_ctr' id="fini_" size='10' maxlength='10'>
  <input type="button" id="lanzador" value="..." /> 
  <!-- script que define y configura el calendario--> 
  <script type="text/javascript"> 
     Calendar.setup({ 
     inputField     :    "fini_",     // id del campo de texto 
     ifFormat     :     "%d/%m/%Y",     // formato de la fecha que se escriba en el campo de texto 
     button     :    "lanzador"     // el id del botn que lanzar el calendario 
    }); 
  </script>
  </td>
  <td class="Td2" align='right'>Fecha de finalizacin</td>
  <td class="Td2" align='left'>
  <!-- formulario con el campo de texto y el botn para lanzar el calendario--> 
  <input type='text' name='ffin_ctr' id="ffin_" size='10' maxlength='10'>
  <input type="button" id="lanzador2" value="..." /> 
  <!-- script que define y configura el calendario--> 
  <script type="text/javascript"> 
     Calendar.setup({ 
     inputField     :    "ffin_",     // id del campo de texto 
     ifFormat     :     "%d/%m/%Y",     // formato de la fecha que se escriba en el campo de texto 
     button     :    "lanzador2"     // el id del botn que lanzar el calendario 
    }); 
  </script>
  </td>
</tr>
<tr>
  <td class="Td2" align='right'>Monto contratado</td>
  <td class="Td2" align='left'><input type='text' name='mont_ctr' size='10' maxlength='10' onKeypress='if (event.keyCode > 47 && event.keyCode <58 ||event.keyCode == 46) event.returnValue = true;else event.returnValue = false'></td>
  <td class="Td2" align='right'>Modalidad de contratacin</td>
  <td class="Td2" align='left'><select name='moda_ctr'><option value=''>
      <option value='1'>Capitado
      <option value='2'>Evento
      </select>
  </td>
</tr>
<tr>
  <td class="Td2" align='right'>Codigo contable</td>
  <td class="Td2" align='left'><input type='text' name='ccon_ctr' size='10' maxlength='10' onKeypress='if (event.keyCode > 47 && event.keyCode <58 ||event.keyCode == 46) event.returnValue = true;else event.returnValue = false'></td>
  <td class="Td2" align='right'>Naturaleza</td>
  <td class="Td2" align='left'><select name='debi_ctr'><option value=''>
      <option value='S'>Debito
      <option value='N'>Credito
      </select>
  </td>
</tr>
</table>

<table class="Tbl0">
<tr>
  <td class="Td2" align='left'><input type='checkbox' name='rmon_ctr' value='S'>Requiere validar monto</td>
  <td class="Td2" align='left'><input type='checkbox' name='rcop_ctr' value='S'>Requiere copago</td>
  <td class="Td2" align='left'><input type='checkbox' name='rcuo_ctr' value='S'>Requiere cuota moderadora</td>
</tr>
<tr>
  <td class="Td2" align='left'><input type='checkbox' name='rord_ctr' value='S'>Requiere orden de autorizacin de servicios</td>
  <td class="Td2" align='left'><input type='checkbox' name='rfdo_ctr' value='S'>Requiere fotocopia de documento de identidad</td>
  <td class="Td2" align='left'><input type='checkbox' name='rfca_ctr' value='S'>Requiere fotocopia de carnet</td>
</tr>
<tr>
  <td class="Td2" align='left'><input type='checkbox' name='rdgr_ctr'>Detallar grupo quirurgico en la impresion de la factura</td>
</tr>
<tr>
  <td class="Td2" align='left'><input type='checkbox' name='fmpr_ctr' value='S'>Permitir cambiar el valor a los procedimientos</td>
  <td class="Td2" align='left'><input type='checkbox' name='fmme_ctr' value='S'>Permitir cambiar el valor a los medicamentos</td>
  <td class="Td2" align='left'><input type='checkbox' name='fmin_ctr' value='S'>Permitir cambiar el valor a los insumos</td>
</tr>
</table>

<table class="Tbl0">
<tr>
  <td class="Td2" align='right'>Observacion</td>
  <td class="Td2" align='left'><textarea name="obse_ctr" rows="3" cols="100" onkeyup="validalongitud('obse_ctr',250)"></textarea>
  </td>
</tr>
</table>
<table class="Tbl0" border='0'>
<tr>
  <td class="Td2" align='right'>Estado</td>
  <td class="Td2" align='left'><select name='esta_ctr'><option value=''>
      <option value='A'>Activo
      <option value='I'>Inactivo
    </select>
  </td>
  <td class="Td2" align='right'>Tarifario</td>
  <td class="Td2" align='left'><select name='tari_ctr'>
      <option value=''>
      <option value='1'>Soat
      <option value='2'>Iss 2001
	    <option value='3'>Iss 2004
    </select>
  </td>
  <td class="Td2" align='right'>Porcentaje</td>
  <td class="Td2" align='left'><input type='text' name='pctg_ctr' size='5' maxlength='5' onKeypress='if (event.keyCode > 47 && event.keyCode <58 ||event.keyCode == 46) event.returnValue = true;else event.returnValue = false'>%</td>
  <td class="Td2" align='right'>Tipo</td>
  <td class="Td2" align='left'><select name='tpor_crt'><option value=''>
      <option value='+'>Incremento
      <option value='-'>Descuento
    </select>
  </td>
  <td class="Td2" align='right'>Reportar con codificacin:</td>
  <td class="Td2" align='left'><select name='rcod_ctr'><option value=''>
      <option value='1'>Cups
      <option value='2'>Soat
    </select>
  </td>
</tr>
</table>