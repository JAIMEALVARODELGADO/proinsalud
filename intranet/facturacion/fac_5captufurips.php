<table class='Tbl0'>
    <tr>
        <td class='Td2' align='left'><b>Nombre: </b><?echo $rowusu[nombre];?></td>
        <td class='Td2' align='left'><b>Identificacion: </b><?echo $rowusu[nrod_usu];?></td>
        <td class='Td2' align='left'><b>Fecha de Nacimiento: </b><?echo cambiafechadmy($rowusu[fnac_usu]);?></td>
    </tr>
    <tr>
        <td class='Td2' align='left'><b>Sexo: </b><?echo $rowusu[sexo_usu];?></td>
        <td class='Td2' align='left'><b>Direccion: </b><?echo $rowusu[dire_usu];?></td>
        <td class='Td2' align='left'><b>Municipio: </b><?echo $rowusu[mate_usu];?></td>
    </tr>
</table>
<table class="Tbl0"><tr><td class="Td0" align='center'>DATOS DEL RECOBRO</td></tr></table><br>
<table class='Tbl0' border="0">
    <tr>
        <td class='Td2' align='right'><b>Respuesta a Glosa:</td>
        <td class='Td2' align='left'><select name="resp_rec" onblur="activarrad()">
                <option value=''>Nueva Reclamacion</option>
                <option value='0'>Glosa Total</option>
                <option value='1'>Pago Parcial</option>                
                </select>
        </td>
        <td class='Td2' align='right'><b>No Radicado Anterior:</td>
        <td class='Td2' align='left'><input type='text' name="radant_rec" size="10" maxlength="10" disabled="true"></td>
        <td class='Td2' align='right'><b>No Factura:</td>
        <td class='Td2' align='left'><input type='text' name="fact_rec" size="20" maxlength="20" value='<?php echo $num_fac?>' disabled></td>
    </tr>
    <tr>
        <td class='Td2' align='right'><b>Naturaleza del Evento:</td>
        <td class='Td2' align='left'><select name="natu_rec" onblur="activaotro()"><option value="">
            <?
            $consnat="SELECT valo_des,nomb_des FROM destipos WHERE codt_des='77'";
            $consnat=mysql_query($consnat);
            while($rownat=mysql_fetch_array($consnat)){
                echo "<option value='$rownat[valo_des]'>$rownat[nomb_des]";
            }
            ?>
            </select>
        </td>
        <td class='Td2' align='right'><b>Descripcion:</td>
        <!--<input type='text' name="desot_rec" size="25" maxlength="25">-->
        <td class='Td2' align='left' colspan="3"><textarea name="desot_rec" cols="80" rows="3"></textarea></td>
    </tr>
    <tr>
        <td class='Td2' align='right'><b>Condicion de la Victima:</td>
        <td class='Td2' align='left'><select name="cond_rec">
                <option value=''>
                <option value='1'>Conductor
                <option value='2'>Peaton
                <option value='3'>Ocupante
                <option value='4'>Ciclista
                </select>            
        </td>        
    </tr>
    <tr>
        <td class='Td2' align='right'><b>Direccion de Ocurrencia del Evento:</td>
        <td class='Td2' align='left' colspan="2"><input type='text' name="direoc_rec" size="50" maxlength="40"></td>
        <td class='Td2' align='right'><b>Fecha del Evento:(dd/mm/aaaa)</td>
        <td class='Td2' align='left'><input type='text' name="fechoc_rec" size="10" maxlength="10">
            <button type="button" id="lanzador1"><div align="center"><img src=icons\feed.png border='0' width="10" height="15"></div>
            <!-- script que define y configura el calendario--> 
            <script type="text/javascript"> 
                    Calendar.setup({ 
                    inputField   :    "fechoc_rec",     // id del campo de texto 
                    ifFormat     :    "%d/%m/%Y",     // formato de la fecha que se escriba en el campo de texto 
                    button       :    "lanzador1"     // el id del botn que lanzar el calendario 
                    });
            </script></button>
        </td>
        <td class='Td2' align='left'><b>Hora:(HH:mm)
        <input type='text' name="horaoc_rec" size="5" maxlength="5">        
        </td>
    </tr>
    <tr>
        <td class='Td2' align='right'><b>Municipio del Evento:</td>
        <td class='Td2' align='left' colspan="3">
            <input type='text' id='course' class='texto' name='nommuni' size='80'>
            <input type='hidden' id='course_val' name='munioc_rec'>
        </td>
        <td class='Td2' align='right'><b>Zona del Evento:</td>
        <td class='Td2' align='left'><select name="zonaoc_rec">
                <option value=''>
                <option value='U'>Urbana
                <option value='R'>Rural
                </select>
        </td>        
    </tr>
    
</table>

<table class="Tbl0"><tr><td class="Td0" align='center'>DATOS DEL VEHICULO</td></tr></table><br>
<table class='Tbl0' border="0">
    <tr>
        <td class='Td2' align='right'><b>Estado de Aseguramiento:</td>
        <td class='Td2' align='left'><select name="estase_veh" onblur="activavehi()">
                <option value=''>
                <option value='1'>Asegurado
                <option value='2'>No Asegurado
                <option value='3'>Vehiculo Fantasma
                <option value='4'>Poliza Falsa
                <option value='5'>Vehiculo en Fuga
                </select>
        </td>
        <td class='Td2' align='right'><b>Marca:</td>
        <td class='Td2' align='left'><input type='text' name="marca_veh" size="15" maxlength="15"></td>
        <td class='Td2' align='right'><b>Placa:</td>
        <td class='Td2' align='left'><input type='text' name="placa_veh" size="6" maxlength="6"></td>
    </tr>
    <tr>
        <td class='Td2' align='right'><b>Tipo de Vehiculo:</td>
        <td class='Td2' align='left'><select name="tipo_veh">
                <option value=''>
                <option value='3'>Particular
                <option value='4'>Publico
                <option value='5'>Oficial
                <option value='6'>De Emergencia
                <option value='7'>Diplomatico o consular
                <option value='8'>Transporte Masivo
                <option value='9'>Escolar
                </select>
        </td>
        <td class='Td2' align='right'><b>Aseguradora:</td>        
        <td class='Td2' align='left'><select name="codi_con">
                <option value=''></option>
                <?php
                $conseg="SELECT codi_con,neps_con FROM contrato WHERE codase_con<>'' ORDER BY neps_con";
                $conseg=mysql_query($conseg);
                while($rowseg=mysql_fetch_array($conseg)){
                    echo "<option value='$rowseg[codi_con]'>$rowseg[neps_con]</option>";
                }
                ?>
                <!--<option value='AT1301'>Colseguros</option>
                <option value='AT1306'>Seguros Colpatria</option>
                <option value='AT1307'>Agricola de Seguros</option>
                <option value='AT1309'>Central de Seguros</option>
                <option value='AT1315'>Roya & Sun Alliance Seguros</option>
                <option value='AT1317'>Mundial de Seguros</option>
                <option value='AT1318'>Compañia Suramericana de Seguros</option>
                <option value='AT1324'>La Previsora S.A</option>
                <option value='AT1333'>Liberty Seguros</option>-->
            </select>
        </td>
        <td class='Td2' align='right'><b>Número de Poliza:</td>
        <td class='Td2' align='left'><input type='text' name="poliza_veh" size="25" maxlength="20"></td>
    </tr>
    <tr>
        <td class='Td2' align='right'><b>Fecha de Inicio de la Poliza:</td>
        <td class='Td2' align='left'>
            <input type='text' name="finipol_veh" size="10" maxlength="10">
            <button type="button" id="lanzador6"><div align="center"><img src=icons\feed.png border='0' width="10" height="15"></div>
            <!-- script que define y configura el calendario--> 
            <script type="text/javascript"> 
                    Calendar.setup({ 
                    inputField   :    "finipol_veh",     // id del campo de texto 
                    ifFormat     :    "%d/%m/%Y",     // formato de la fecha que se escriba en el campo de texto 
                    button       :    "lanzador6"     // el id del botn que lanzar el calendario 
                    });
            </script></button>
        </td>
        <td class='Td2' align='right'><b>Fecha Final de la Poliza:</td>
        <td class='Td2' align='left'>
            <input type='text' name="ffinpol_veh" size="10" maxlength="10">
            <button type="button" id="lanzador7"><div align="center"><img src=icons\feed.png border='0' width="10" height="15"></div>
            <!-- script que define y configura el calendario--> 
            <script type="text/javascript"> 
                    Calendar.setup({ 
                    inputField   :    "ffinpol_veh",     // id del campo de texto 
                    ifFormat     :    "%d/%m/%Y",     // formato de la fecha que se escriba en el campo de texto 
                    button       :    "lanzador7"     // el id del botn que lanzar el calendario 
                    });
            </script></button>
        </td>
        <td class='Td2' align='right'><b>Intervencion de Autoridad:</td>
        <td class='Td2' align='left'><select name="inter_veh">
                <option value=''>
                <option value='0'>No</option>
                <option value='1'>Si</option>                
                </select>
        </td>
    </tr>
        <tr>
        <td class='Td2' align='right'></td>
        <td class='Td2' align='left'></td>
        <td class='Td2' align='right'></td>
        <td class='Td2' align='left'></td>
        <td class='Td2' align='right'><b>Cobro por Excedente de la poliza:</td>
        <td class='Td2' align='left'><select name="exced_veh">
                <option value=''>
                <option value='0'>No</option>
                <option value='1'>Si</option>                
                </select>
        </td>
    </tr>
</table>
<table class="Tbl0"><tr><td class="Td0" align='center'>DATOS DE OTROS VEHICULOS</td></tr></table>
<table class='Tbl0' border="1">
    <th class='Th1' colspan="2">SEGUNDO VEHICULO</th>
    <th class='Th1' colspan="2">TERCER VEHICULO</th>
    <tr>
        <td class='Td2' align='right'><b>Placa:</td>
        <td class='Td2' align='left'><input type='text' name="placaseg_veh" size="6" maxlength="6"></td>
        <td class='Td2' align='right'><b>Placa:</td>
        <td class='Td2' align='left'><input type='text' name="placater_veh" size="6" maxlength="6"></td>
    </tr>
    <tr>
        <td class='Td2' align='right'><b>Tipo de Documento de Identificacion del Propietario:</td>
        <td class='Td2' align='left'><select name="tdocseg_veh">
                <option value=""></option>
                <option value="CC">Cedula de Ciudadania</option>
                <option value="CE">Cedula de Extrangeria</option>
                <option value="PA">Pasaporte</option>
                <option value="TI">Tarjeta de Identidad</option>
                <option value="RC">Registro Civil</option>
                <option value="NI">Numero de Ident. Tributaria</option>
            </select>
        </td>
        <td class='Td2' align='right'><b>Tipo de Documento de Identificacion del Propietario:</td>
        <td class='Td2' align='left'><select name="tdocter_veh">
                <option value=""></option>
                <option value="CC">Cedula de Ciudadania</option>
                <option value="CE">Cedula de Extrangeria</option>
                <option value="PA">Pasaporte</option>
                <option value="TI">Tarjeta de Identidad</option>
                <option value="RC">Registro Civil</option>
                <option value="NI">Numero de Ident. Tributaria</option>
            </select>
        </td>
    </tr>
    <tr>
        <td class='Td2' align='right'><b>Numero:</td>
        <td class='Td2' align='left'><input type='text' name="ndocseg_veh" size="16" maxlength="16"></td>
        <td class='Td2' align='right'><b>Numero:</td>
        <td class='Td2' align='left'><input type='text' name="ndocter_veh" size="16" maxlength="16"></td>
    </tr>
</table>

<table class="Tbl0"><tr><td class="Td0" align='center'>DATOS DEL PROPIETARIO</td></tr></table><br>
<table class='Tbl0' border="0">
    <tr>
        <td class='Td2' align='right'><b>Tipo de Documento de Identidad:</td>
        <td class='Td2' align='left'><select name="tdoc_pro">
                <option value=""></option>
                <option value="CC">Cedula de Ciudadania</option>
                <option value="CE">Cedula de Extrangeria</option>
                <option value="PA">Pasaporte</option>
                <option value="TI">Tarjeta de Identidad</option>
                <option value="RC">Registro Civil</option>
                <option value="NI">Numero de Ident. Tributaria</option>
            </select>
        </td>
        <td class='Td2' align='right'><b>Numero:</td>
        <td class='Td2' align='left'><input type='text' name="ndoc_pro" size="16" maxlength="16"></td>
    </tr>
    <tr>
        <td class='Td2' align='right'><b>Primer Apellido:</td>
        <td class='Td2' align='left'><input type='text' name="pape_pro" size="40" maxlength="40"></td>
        <td class='Td2' align='right'><b>Segundo Apellido:</td>
        <td class='Td2' align='left'><input type='text' name="sape_pro" size="30" maxlength="30"></td>
    </tr>
    <tr>
        <td class='Td2' align='right'><b>Primer Nombre:</td>
        <td class='Td2' align='left'><input type='text' name="pnom_pro" size="20" maxlength="20"></td>
        <td class='Td2' align='right'><b>Segundo Nombre:</td>
        <td class='Td2' align='left'><input type='text' name="snom_pro" size="30" maxlength="30"></td>
    </tr>
    <tr>
        <td class='Td2' align='right'><b>Direccion de Residencia:</td>
        <td class='Td2' align='left'><input type='text' name="dire_pro" size="40" maxlength="40"></td>
        <td class='Td2' align='right'><b>Telefono:</td>
        <td class='Td2' align='left'><input type='text' name="tele_pro" size="10" maxlength="10"></td>
    </tr>
    <tr>
        <td class='Td2' align='right'><b>Municipio de Residencia:</td>
        <td class='Td2' align='left' colspan="2">
            <input type='text' id='course2' class='texto' name='nommunpro' size='80'>
            <input type='hidden' id='course_val2' name='mres_pro'>
        </td>
    </tr>
</table>
    
<table class="Tbl0"><tr><td class="Td0" align='center'>DATOS DEL CONDUCTOR</td></tr></table><br>
<table class='Tbl0' border="0">
    <tr>
        <td class='Td2' align='right'><b>Tipo de Documento de Identidad:</td>
        <td class='Td2' align='left'><select name="tdoc_con">
                <option value=""></option>
                <option value="CC">Cedula de Ciudadania</option>
                <option value="CE">Cedula de Extrangeria</option>
                <option value="PA">Pasaporte</option>
                <option value="TI">Tarjeta de Identidad</option>
                <option value="AS">Adulto sin Identificacion</option>                
            </select>
        </td>
        <td class='Td2' align='right'><b>Numero:</td>
        <td class='Td2' align='left'><input type='text' name="ndoc_con" size="16" maxlength="16"></td>
    </tr>
    <tr>
        <td class='Td2' align='right'><b>Primer Apellido:</td>
        <td class='Td2' align='left'><input type='text' name="pape_con" size="20" maxlength="20"></td>
        <td class='Td2' align='right'><b>Segundo Apellido:</td>
        <td class='Td2' align='left'><input type='text' name="sape_con" size="30" maxlength="30"></td>
    </tr>
    <tr>
        <td class='Td2' align='right'><b>Primer Nombre:</td>
        <td class='Td2' align='left'><input type='text' name="pnom_con" size="20" maxlength="20"></td>
        <td class='Td2' align='right'><b>Segundo Nombre:</td>
        <td class='Td2' align='left'><input type='text' name="snom_con" size="30" maxlength="30"></td>
    </tr>
    <tr>
        <td class='Td2' align='right'><b>Direccion de Residencia:</td>
        <td class='Td2' align='left'><input type='text' name="dire_con" size="40" maxlength="40"></td>
        <td class='Td2' align='right'><b>Telefono:</td>
        <td class='Td2' align='left'><input type='text' name="tele_con" size="10" maxlength="10"></td>
    </tr>
    <tr>
        <td class='Td2' align='right'><b>Municipio de Residencia:</td>
        <td class='Td2' align='left' colspan="2">
            <input type='text' id='course3' class='texto' name='nommuncon' size='80'>
            <input type='hidden' id='course_val3' name='muni_con'>
        </td>
    </tr>
</table>

<table class="Tbl0"><tr><td class="Td0" align='center'>DATOS DE LA REMISION</td></tr></table><br>
<table class='Tbl0' border="0">
    <tr>
        <td class='Td2' align='right'><b>Tipo de Referencia:</td>
        <td class='Td2' align='left'><select name="tipo_rem">
                <option value=''>
                <option value='1'>Remision
                <option value='2'>Orden de Servicio
                </select>
        </td>
        <td class='Td2' align='right'><b>Fecha de Remision:</td>
        <td class='Td2' align='left'>
            <input type='text' name="fech_rem" size="10" maxlength="10">
            <button type="button" id="lanzador2"><div align="center"><img src=icons\feed.png border='0' width="10" height="15"></div>
            <!-- script que define y configura el calendario--> 
            <script type="text/javascript"> 
                    Calendar.setup({ 
                    inputField   :    "fech_rem",     // id del campo de texto 
                    ifFormat     :    "%d/%m/%Y",     // formato de la fecha que se escriba en el campo de texto 
                    button       :    "lanzador2"     // el id del botn que lanzar el calendario 
                    });
            </script></button>
        </td>
        <td class='Td2' align='right'><b>Hora de Salida:</td>
        <td class='Td2' align='left'><input type='text' name="hsal_rem" size="5" maxlength="5"></td>
    </tr>
    <tr>
        <td class='Td2' align='right'><b>Profesional que Remite:</td>
        <td class='Td2' align='left'><input type='text' name="nomb_rem" size="60" maxlength="60"></td>
        <td class='Td2' align='right'><b>Cargo:</td>
        <td class='Td2' align='left'><input type='text' name="cargo_rem" size="30" maxlength="30"></td>
    </tr>
    <tr>
        <td class='Td2' align='right'><b>IPS que Recibe:</td>
        <td class='Td2' align='left'><input type='text' name="ipsrec_rem" size="35" maxlength="35"></td>
        <td class='Td2' align='right'><b>Direccion IPS que Recibe:</td>
        <td class='Td2' align='left'><input type='text' name="direips_rem" size="35" maxlength="35"></td>        
    </tr>
    <tr>
        <td class='Td2' align='right'><b>Fecha de Ingreso:</td>
        <td class='Td2' align='left'>
            <input type='text' name="fing_rem" size="10" maxlength="10">
            <button type="button" id="lanzador3"><div align="center"><img src=icons\feed.png border='0' width="10" height="15"></div>
            <!-- script que define y configura el calendario--> 
            <script type="text/javascript"> 
                    Calendar.setup({ 
                    inputField   :    "fing_rem",     // id del campo de texto 
                    ifFormat     :    "%d/%m/%Y",     // formato de la fecha que se escriba en el campo de texto 
                    button       :    "lanzador3"     // el id del botn que lanzar el calendario 
                    });
            </script></button>
        </td>
        <td class='Td2' align='right'><b>Hora de Ingreso:</td>
        <td class='Td2' align='left'><input type='text' name="hing_rem" size="10" maxlength="10"></td>        
    </tr>
    <tr>
        <td class='Td2' align='right'><b>Profesional que Recibe:</td>
        <td class='Td2' align='left'><input type='text' name="nomrec_rem" size="65" maxlength="60"></td>
        <td class='Td2' align='right'><b>Cargo:</td>
        <td class='Td2' align='left'><input type='text' name="carrec_rem" size="35" maxlength="30"></td>
    </tr>
     <tr>
        <td class='Td2' align='right'><b>Municipio que Recibe:</td>
        <td class='Td2' align='left' colspan="2">
            <input type='text' id='course11' class='texto' name='nommunrec' size='80'>
            <input type='hidden' id='course_val11' name='munrec_rem'>
        </td>
    </tr>
</table>

<table class="Tbl0"><tr><td class="Td0" align='center'>DATOS DEL TRANSPORTE Y MOVILIZACION DE LA VICTIMA</td></tr></table><br>
<table class='Tbl0' border="0">
    <tr>
        <td class='Td2' align='right'><b>Tipos de Identificacion del Conductor:</td>
        <td class='Td2' align='left'><select name="tdoc_tra">
                <option value=""></option>
                <option value="CC">Cedula de Ciudadania</option>
                <option value="CE">Cedula de Extrangeria</option>
                <option value="PA">Pasaporte</option>                
            </select>
        </td>
        <td class='Td2' align='right'><b>Numero:</td>
        <td class='Td2' align='left'><input type='text' name="ndoc_tra" size="16" maxlength="16"></td>
    </tr>
    <tr>
        <td class='Td2' align='right'><b>Primer Nombre:</td>
        <td class='Td2' align='left'><input type='text' name="pnom_tra" size="30" maxlength="30"></td>
        <td class='Td2' align='right'><b>Segundo Nombre:</td>
        <td class='Td2' align='left'><input type='text' name="snom_tra" size="30" maxlength="30"></td>
    </tr>
    <tr>
        <td class='Td2' align='right'><b>Primer Apellido:</td>
        <td class='Td2' align='left'><input type='text' name="pape_tra" size="30" maxlength="30"></td>
        <td class='Td2' align='right'><b>Segundo Apellido:</td>
        <td class='Td2' align='left'><input type='text' name="sape_tra" size="30" maxlength="30"></td>
    </tr>
    <tr>
        <td class='Td2' align='right'><b>Placa:</td>
        <td class='Td2' align='left'><input type='text' name="placa_tra" size="6" maxlength="6"></td>
        <td class='Td2' align='right'><b>Direccion Inicio del Recorrido:</td>
        <td class='Td2' align='left'><input type='text' name="recini_tra" size="40" maxlength="40"></td>
        <td class='Td2' align='right'><b>Hasta:</td>
        <td class='Td2' align='left'><input type='text' name="recfin_tra" size="40" maxlength="40"></td>
    </tr>
    <tr>
        <td class='Td2' align='right'><b>Tipo de Servicio:</td>
        <td class='Td2' align='left'><select name="tipser_tra">
                <option value=''>
                <option value='1'>Ambulancia Basica
                <option value='2'>Ambulancia Medicalizada
                </select>
        </td>
        <td class='Td2' align='right'><b>Zona Donde se Recoge a la Victima:</td>
        <td class='Td2' align='left'><select name="zona_tra">
                <option value=''>
                <option value='U'>Urbana
                <option value='R'>Rural
                </select>
        </td>
    </tr>
</table>

<table class="Tbl0"><tr><td class="Td0" align='center'>DATOS DE LA ATENCION MEDICA</td></tr></table><br>
<table class='Tbl0' border="0">
    <tr>
        <td class='Td2' align='right'><b>Fecha de Ingreso:</td>
        <td class='Td2' align='left'>
            <input type='text' name="fecing_ate" size="10" maxlength="10">
            <button type="button" id="lanzador4"><div align="center"><img src=icons\feed.png border='0' width="10" height="15"></div>
            <!-- script que define y configura el calendario--> 
            <script type="text/javascript"> 
                    Calendar.setup({ 
                    inputField   :    "fecing_ate",     // id del campo de texto 
                    ifFormat     :    "%d/%m/%Y",     // formato de la fecha que se escriba en el campo de texto 
                    button       :    "lanzador4"     // el id del botn que lanzar el calendario 
                    });
            </script></button>
        </td>
        <td class='Td2' align='right'><b>Hora:</td>
        <td class='Td2' align='left'><input type='text' name="horing_ate" size="5" maxlength="5"></td>        
        <td class='Td2' align='right'><b>Fecha de Salida:</td>
        <td class='Td2' align='left'>
            <input type='text' name="fecsal_ate" size="10" maxlength="10">
            <button type="button" id="lanzador5"><div align="center"><img src=icons\feed.png border='0' width="10" height="15"></div>
            <!-- script que define y configura el calendario--> 
            <script type="text/javascript"> 
                    Calendar.setup({ 
                    inputField   :    "fecsal_ate",     // id del campo de texto 
                    ifFormat     :    "%d/%m/%Y",     // formato de la fecha que se escriba en el campo de texto 
                    button       :    "lanzador5"     // el id del botn que lanzar el calendario 
                    });
            </script></button>
        </td>        
        <td class='Td2' align='right'><b>Hora:</td>
        <td class='Td2' align='left'><input type='text' name="horsa_ate" size="5" maxlength="5"></td>
    </tr>
    <th class='Th1' colspan="4">DEL INGRESO</th>
    <th class='Th1' colspan="4">DEL EGRESO</th>
    <tr>
        <td class='Td2' align='right'><b>Dx Principal:</td>
        <td class='Td2' align='left' colspan="3">            
            <input type='text' id='course_val4' class='texto' name='diapri_ate' size='4'>
            <input type='text' id='course4' name='desdiapri_ate' size='80'>
            
        </td>
        <td class='Td2' align='right'><b>Dx Principal:</td>
        <td class='Td2' align='left' colspan="3">
            <input type='text' id='course_val5' class='texto' name='dxprieg_ate' size='4'>
            <input type='text' id='course5' name='desdxprieg_ate' size='80'>
        </td>
    </tr>
    <tr>
        <td class='Td2' align='right'><b>Dx Asociado 1:</td>
        <td class='Td2' align='left' colspan="3">
            <input type='text' id='course_val6' class='texto' name='diaas1_ate' size='4'>
            <input type='text' id='course6' name='desdiaas1_ate' size='80'>
        </td>
        <td class='Td2' align='right'><b>Dx Asociado 1:</td>
        <td class='Td2' align='left' colspan="3">
            <input type='text' id='course_val7' class='texto' name='dxaseg1_ate' size='4'>
            <input type='text' id='course7' name='desdxaseg1_ate' size='80'>
        </td>
    </tr>
    <tr>
        <td class='Td2' align='right'><b>Dx Asociado 2:</td>
        <td class='Td2' align='left' colspan="3">
            <input type='text' id='course_val8' class='texto' name='diaas2_ate' size='4'>
            <input type='text' id='course8' name='desdiaas2_ate' size='80'>
        </td>
        <td class='Td2' align='right'><b>Dx Asociado 2:</td>
        <td class='Td2' align='left' colspan="3">            
            <input type='text' id='course_val9' class='texto' name='dxaseg2_ate' size='4'>
            <input type='text' id='course9' name='desdxaseg2_ate' size='80'>
        </td>
    </tr>
    <tr>
        <td class='Td2' align='right'><b>Medico Tratante:</td>
        <td class='Td2' align='left' colspan="4">                        
            <input type='text' id='course10' name='nomb_medi' size='80'>
            <input type='hidden' id='course_val10' class='texto' name='cod_medi'>
        </td>
    </tr>
</table>
<table class="Tbl0"><tr><td class="Td0" align='center'>AMPAROS QUE RECLAMA</td></tr></table><br>
<table class='Tbl0' border="0">
    <th class='Th1' width="30%"></th>
    <th class='Th1' width="15%">Valor Total Facturado</th>
    <th class='Th1' width="15%">Valor Reclamado al Fosyga</th>
    <th class='Th1' width="40%"></th>
    <tr>
        <td class='Td2' align='right'><b>Gastos Medico Quirurgicos:</td>
        <td class='Td2' align='center'><input type='text' name="totfac_ate" size="15" maxlength="15" disabled></td>
        <td class='Td2' align='center'><input type='text' name="totrec_ate" size="15" maxlength="15" disabled></td>
    </tr>
    <tr>
        <td class='Td2' align='right'><b>Gastos de Transporte y Movilizacion de la Victima:</td>
        <td class='Td2' align='center'><input type='text' name="totftra_ate" size="15" maxlength="15" disabled></td>        
        <td class='Td2' align='center'><input type='text' name="totrtra_ate" size="15" maxlength="15" disabled></td>        
    </tr>
    <tr>
        <td class='Td2' align='right'><b>Total Folios:</td>
        <td class='Td2' align='left'><input type='text' name="foli_ate" size="3" maxlength="3"></td>
    </tr>
</table>
