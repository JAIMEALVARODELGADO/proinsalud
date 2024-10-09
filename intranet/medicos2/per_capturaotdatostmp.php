
<table border="1" width="100%" align="center" BorderColor="#FFFFFF"  cellpadding=2 Cellspacing=0 style="font-size:11;font-family:Arial;font-weight:bold">
  <tr>
    <td align="center" bgcolor="#E1DECB"><input type='checkbox' name='chkasistencial' onclick='activa_asistencial()'>Datos Personal Asistencial</td>
    <td align="center" bgcolor="#CBDCE1"><input type='checkbox' name='chkocupacional' onclick='activa_ocupacional()'>Datos Para Historia Clínica (Salud Ocupacional)</td>
  </tr>
  <tr>
    <td>
      <table border="0" width="100%" align="center" BorderColor="#FFFFFF" bgcolor="#E1DECB" cellpadding=2 Cellspacing=0 style="font-size:11;font-family:Arial;font-weight:bold">
      <tr>
        <td align="right">Código:</td>
        <td><input type=text name="cod_medi" size='20' maxlength='20' onblur='recargar()'></td>
      </tr>
      <tr>
        <td align="right">Cargo:</td>
        <td><input type=text name="are_medi" size='40' maxlength='40'></td>
      </tr>
      <tr>
        <td align="right">Reg. Médico:</td>
        <td><input type=text name="reg_medi" size='20' maxlength='20'></td>
      </tr>
      <tr>
        <td align="right">Area:</td>
        <td><select name="areas_ar"><option value=''></option>>
          <?
            $consulta=mysql_query("SELECT cod_areas,nom_areas FROM areas ORDER BY nom_areas");
            while($row=mysql_fetch_array($consulta)){
                echo "<option value='$row[cod_areas]'>$row[nom_areas]</option>";
            }            
            mysql_free_result($consulta);
          ?>
          </select>          
        </td>
      </tr>
      <tr>
        <td align="right">Especialidad:</td>
        <td><select name='espe_med'><option value=''></option>>
        <?
        $consulta=mysql_query("SELECT codi_des,nomb_des FROM destipos WHERE codt_des='26' AND valo_des<>'' ORDER BY nomb_des");
        while($row=mysql_fetch_array($consulta)){
            echo "<option value='$row[codi_des]'>$row[nomb_des]</option>";
        }
        mysql_free_result($consulta);        
        ?>
        </select>
        </td>
      </tr>
      <tr>
        <td align="right">Código SIIGO:</td>
        <td><input type=text name="csii_med" size='4' maxlength='4' onblur='recargar()'></td>
        <!---->
      </tr>
      </table>
    </td>

    <td>    
      <table border="0" width="100%" align="center" BorderColor="#FFFFFF" bgcolor='#CBDCE1' cellpadding=2 Cellspacing=0 style="font-size:11;font-family:Arial;font-weight:bold">
      <tr>
        <td align="right">Pertenencia Etnia:</td>
        <td><select name="etnia"><option value=""></option>
          <?php
            $consulta=mysql_query("SELECT codi_des,nomb_des FROM destipos WHERE codt_des='75'");
            while ($row=mysql_fetch_array($consulta)){
              echo "<option value=".$row['codi_des'].">".$row['nomb_des']."</option>";
            }
          ?>
          </select>          
        </td>
      </tr>
      <tr>
        <td align="right">Nivel Educativo:</td>
        <td><select name="niveledu"><option value=""></option>
          <?php
            $consulta=mysql_query("SELECT codi_des,nomb_des FROM destipos WHERE codt_des='76'");    
            while ($row=mysql_fetch_array($consulta)){
              echo "<option value=".$row['codi_des'].">".$row['nomb_des']."</option>";
            }
          ?>
          </select>          
        </td>
      </tr>
      <tr>
        <td align="right">Ocupaci�n:</td>
        <td><input type="text" id='course' class='texto' name="ocupa" size="40" maxlength="40">
          <input type='hidden' name='codigo_ciuo' id='course_val'>
        </td>
      </tr>
      <tr>
        <td align="right">Estado Civil:</td>
        <td><select name="eciv"><option value="">
          <?php
            $consulta=mysql_query("SELECT codi_des,nomb_des FROM destipos WHERE codt_des='A7'");    
            while ($row=mysql_fetch_array($consulta)){
              echo "<option value=".$row['codi_des'].">".$row['nomb_des'];
            }
          ?>
          </select>      
        </td>
      </tr>
      </tr>
      </table>    
    </td>
  </tr>  
 </table>
<html><head></head><body></body></html>