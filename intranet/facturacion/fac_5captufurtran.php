<table class="Tbl0"><tr><td class="Td0" align='center'>DATOS DEL RECOBRO</td></tr></table><br>
<table class='Tbl0' border="0">
    <tr>
        <td class='Td2' align='right'><b>Respuesta a Glosa:</td>
        <td class='Td2' align='left'><select name="resp_rec" onblur="activarrad2()">
                <option value=''>Nueva Reclamacion
                <option value='0'>Glosa Total
                <option value='1'>Pago Parcial
                </select>
        </td>
        <td class='Td2' align='right'><b>No Radicado Anterior:</td>
        <td class='Td2' align='left'><input type='text' name="radant_rec" size="10" maxlength="10" disabled="true"></td>
    </tr>
    <tr>
        <td class='Td2' align='right'><b>Tipo de Evento:</td>
        <td class='Td2' align='left'><select name="tipeve_rec">
                <option value=""></option>
                <option value="1">Accidente de Transito</option>
                <option value="2">Evento Catastrofico</option>
                <option value="3">Evento Terrorista</option>
            </select>
        </td>
        <td class='Td2' align='right'><b>Direccion donde se Recoge a la Victima:</td>
        <td class='Td2' align='left'><input type='text' name="dire_rec" size="40" maxlength="40"></td>            
    </tr>
    <tr>
        <td class='Td2' align='right'><b>Municipio:</td>
        <td class='Td2' align='left'>
            <input type='text' id='course' class='texto' name='nommuni' size='80'>
            <input type='hidden' id='course_val' name='muni_rec'>
        </td>
        <td class='Td2' align='right'><b>Zona donde se recoge a la victima:</td>
        <td class='Td2' align='left'><select name="zona_rec">
                <option value=''>
                <option value='U'>Urbana
                <option value='R'>Rural
                </select>
        </td>
    </tr>
    <tr>
        <td class='Td2' align='right'><b>Fecha de Traslado:</td>
        <td class='Td2' align='left'><input type='text' name="fectra_rec" size="10" maxlength="10">
            <button type="button" id="lanzador1"><div align="center"><img src=icons\feed.png border='0' width="10" height="15"></div>
            <!-- script que define y configura el calendario--> 
            <script type="text/javascript"> 
                    Calendar.setup({ 
                    inputField   :    "fectra_rec",     // id del campo de texto 
                    ifFormat     :    "%d/%m/%Y",     // formato de la fecha que se escriba en el campo de texto 
                    button       :    "lanzador1"     // el id del botn que lanzar el calendario 
                    });
            </script></button>
            
            
            <b>Hora:
            <input type='text' name="hortra_rec" size="5" maxlength="5">
        </td>        
        <td class='Td2' align='right'><b>Total Folios</td>
        <td class='Td2' align='left'><input type='text' name="totfol_rec" size="3" maxlength="3"></td>
    </tr>   
</table>