<?php
/*$descdxpr=buscacie(dxprinc_);
    $descdxr1=buscacie(dxrel1_);
    $descdxr2=buscacie(dxrel2_);
    $descdxr3=buscacie(dxrel3_);*/
    $consultausu="SELECT nrod_usu,CONCAT(pnom_usu,' ',snom_usu,' ',pape_usu,' ',snom_usu) AS nombre,dire_usu,fnac_usu,tres_usu,tel2_usu,neps_con
        FROM usuario
        INNER JOIN citas ON idusu_citas=codi_usu
        INNER JOIN contrato ON codi_con=cotra_citas
        WHERE id_cita='$_SESSION[id_cita]'";
    //echo "<br>".$consultausu;
    $consultausu=mysql_query($consultausu);
    $rowusu=mysql_fetch_array($consultausu);
    $edad=calculaedad($rowusu[fnac_usu]);
    ?>
    <table border="0">
        <tr>
            <td align="right">Identificación:</td>
            <td align="left"><?php echo $rowusu[nrod_usu];?></td>
            <td align="right">Nombres y Apellidos:</td>
            <td align="left"><?php echo $rowusu[nombre];?></td>
            <td align="right">Contrato:</td>
            <td align="left"><?php echo $rowusu[neps_con];?></td>
        </tr>
        <tr>
            <td align="right">Dirección:</td>
            <td align="left"><?php echo $rowusu[dire_usu];?></td>
            <td align="right">Telefono:</td>
            <td align="left"><?php echo $rowusu[tres_usu].' '.$rowusu[tel2_usu];?></td>
            <td align="right">Edad:</td>
            <td align="left"><?php echo $edad;?></td>
        </tr>
    </table>

