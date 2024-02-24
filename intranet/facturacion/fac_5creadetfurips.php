<?php
session_start();
if(!empty($iden_rec1)){
    $_SESSION['iden_rec']=$iden_rec1;
}
?>
<html>
<head>
<title>PROGRAMA DE FACTURACION - FURIPS DETALLE</title>

<link rel="stylesheet" href="css/style.css" type="text/css" />

<link rel="stylesheet" type="text/css" href="css/estyles.css">
<script type="text/javascript" src="js/jquery.js"></script>

<SCRIPT LANGUAGE=JavaScript>
function borrar(iden_det,desc_){
    if(confirm("Desea eliminar este registro?\n "+desc_)){
        window.open("fac_5borradetfurip.php?iden_det="+iden_det,"fr02");
    }
    return false;
}
function activar(cont_){
var campo_='';
    campo_='form1.chkhabil'+cont_+'.checked';
    //alert(campo_);
    //alert(eval(campo_));
    if(eval(campo_)==true){
        campo_='form1.codi_det'+cont_+'.disabled=false';        
        eval(campo_);
        campo_='form1.codi_det'+cont_+'.focus()';        
        eval(campo_);
    }
    else{
        campo_='form1.codi_det'+cont_+'.disabled=true';
        eval(campo_);
    }
}

function guardar(iden_,cont_){
var campo_='',valor_='';
    campo_='form1.chkhabil'+cont_+'.checked';    
    if(eval(campo_)==true){
        campo_='form1.codi_det'+cont_+'.value';        
        if(eval(campo_)==''){
            alert("El Codigo NO debe estar vacio");
            campo_='form1.codi_det'+cont_+'.focus()';        
            eval(campo_);
        }
        else{            
            valor_=eval(campo_);            
            window.open("fac_5guardadetfurip.php?iden_det="+iden_+"&codi_det="+valor_,"fr02");
        }        
    }
}

</script>

</head>
<body>
<form name="form1" method="POST" action="fac_2guardaenc.php" target='fr02'>
<table class="Tbl0"><tr><td class="Td0" align='center'>DATOS DE LA VICTIMA</td></tr></table><br>
<?
include('php/conexion.php');
include('php/funciones.php');
$consusu="SELECT CONCAT(pnom_usu,' ',snom_usu,' ',pape_usu,' ',sape_usu) AS nombre,nrod_usu,fnac_usu,sexo_usu,dire_usu,mate_usu,recla.iden_fac
    FROM fr_reclamacion AS recla
    INNER JOIN usuario AS usu ON usu.codi_usu=recla.codi_usu
    WHERE iden_rec='$_SESSION[iden_rec]'";
//echo $consusu;
$consusu=mysql_query($consusu);
if(mysql_num_rows($consusu)==0){
    echo "<table class='Tbl0'><tr><td class='Td1' align='center'>Usuario NO Encontrado</td></tr></table>";}
else{
    $rowusu=mysql_fetch_array($consusu);
}
?>

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
<table class="Tbl0"><tr><td class="Td0" align='center'>DATOS DEL DETALLE DE LA RECLAMACION</td></tr></table><br>
<table class='Tbl0' border="0">
    <th class='Th0' colspan="2">Opc</Th>
    <th class='Th0'>Tipo</Th>
    <th class='Th0'>Codigo</Th>
    <th class='Th0'>Descripcion</Th>
    <th class='Th0'>Cantidad</Th>
    <th class='Th0'>Vr. Unitario</Th>
    <th class='Th0'>Vr. Total</Th>
    <th class='Th0'>Vr. Reclamado</Th>
    <th class='Th0'>Eliminar</Th>
    <tr>
    <?php
    $total=0;
    $consultadet="SELECT iden_dfa,tipo_dfa,iden_tco,desc_dfa,cant_dfa,valu_dfa FROM detalle_factura WHERE iden_fac='$rowusu[iden_fac]'";
    //echo $consultadet;
    $consultadet=mysql_query($consultadet);    
    while($row=mysql_fetch_array($consultadet)){
        $total=$total+($row[cant_dfa]*$row[valu_dfa]);
        $cons_dfr="SELECT iden_dfa FROM fr_detalle_rec WHERE iden_dfa='$row[iden_dfa]'";
        //echo "<br>".$cons_dfr;
        //echo "<br>".$row[tipo_dfa];
        $cons_dfr=mysql_query($cons_dfr);        
        if(mysql_num_rows($cons_dfr)==0){
            if($row[tipo_dfa]=='M'){
                $tipser_det='1';
                $consultacod="SELECT mdi.codi_mdi FROM medicamentos2 AS mdi
                                                  INNER JOIN tarco AS trc ON trc.iden_map=mdi.codi_mdi
                                                  WHERE trc.iden_tco='$row[iden_tco]'";                
                $consultacod=mysql_query($consultacod);
                //echo "<br>".mysql_num_rows($consultacod);
                $rowcod=mysql_fetch_array($consultacod);                
                //$codi_det=$rowcod[codi_mdi];
                $codi_det=traecum($rowcod[codi_mdi]);

            }
            elseif($row[tipo_dfa]=='I'){
                $tipser_det='5';
                $consultacod="SELECT ins.codnue FROM insu_med AS ins
                    INNER JOIN tarco AS trc ON trc.iden_map=ins.codnue
                    WHERE trc.iden_tco='$row[iden_tco]'";
                // echo "<br>".$consultacod;
                $consultacod=mysql_query($consultacod);            
                $rowcod=mysql_fetch_array($consultacod);
                $codi_det=$rowcod[codnue];
            }
            else{
                $tipser_det='2';
                $consutacod="SELECT map.soat_map
                    FROM detalle_factura AS df 
                    INNER JOIN tarco AS tar ON tar.iden_tco=df.iden_tco
                    INNER JOIN mapii AS map ON map.iden_map=tar.iden_map
                    WHERE  df.iden_dfa='$row[iden_dfa]'";
                //echo "<br>".$consutacod;
                $consutacod=mysql_query($consutacod);
                $rowcod=mysql_fetch_array($consutacod);
                $codi_det=$rowcod[soat_map];
            }
            $desc_det=substr(str_replace(',','.',$row[desc_dfa]),0,40);
            //echo "<br>".$desc_det;
            $valtot_det=$row[cant_dfa]*$row[valu_dfa];
            $valrec_det=$row[cant_dfa]*$row[valu_dfa];
            $sql_="INSERT INTO fr_detalle_rec(iden_det,iden_rec,iden_dfa,tipser_det,codi_det,desc_det,cant_det,valuni_det,valtot_det,valrec_det)
            VALUES(0,'$_SESSION[iden_rec]','$row[iden_dfa]','$tipser_det','$codi_det','$desc_det','$row[cant_dfa]','$row[valu_dfa]','$valtot_det','$valrec_det')";
            //echo "<br>".$sql_;
            $sql_=mysql_query($sql_);
        }
    }
    //echo "<br>".$total;
    $sql_="UPDATE fr_atencion SET totrec_ate=$total,totfac_ate=$total WHERE iden_rec='$_SESSION[iden_rec]'";
    mysql_query($sql_);
    $consultadet="SELECT * FROM fr_detalle_rec WHERE iden_rec='$_SESSION[iden_rec]' ORDER BY tipser_det,desc_det";    
    //echo $consultadet;
    $consultadet=mysql_query($consultadet);
    $cont=0;
    while($rowdet=mysql_fetch_array($consultadet)){
        $tipser=traeser($rowdet[tipser_det]);
        $codi_det=$rowdet[codi_det];
        echo "<tr>";        
        $nomvar='chkhabil'.$cont;
        echo "<td class='Td2' align='center'>";
        echo $row[tipser_det];        
        if($rowdet[tipser_det]=='1'){            
            echo "<a href='#' onclick='guardar($rowdet[iden_det],$cont)' title='Guardar'><img src='icons/feed_disk.png' alt='Guardar' disabled></a>";
        }
        echo "</td>";
        echo "<td class='Td2' align='center'>";
        if($rowdet[tipser_det]=='1'){
            echo "<input type='checkbox' name='$nomvar' onclick='activar(\"$cont\")'>";
        }
        else{            
            if(empty($rowdet[codi_det])){
                act_codigo($rowdet[iden_det],$rowdet[iden_dfa],$codi_det);
            }
        }
        echo "</td>";        
        echo "<td class='Td2' align='left'>$tipser</td>";
        $nomvar='codi_det'.$cont;        
        echo "<td class='Td2' align='left'><input type='text' name='$nomvar' value='$codi_det' size=15 maxlength=15 disabled=true></td>";
        echo "<td class='Td2' align='left'>$rowdet[desc_det]</td>";
        echo "<td class='Td2' align='right'>$rowdet[cant_det]</td>";
        echo "<td class='Td2' align='right'>$rowdet[valuni_det]</td>";        
        echo "<td class='Td2' align='right'>$rowdet[valtot_det]</td>";
        echo "<td class='Td2' align='right'>$rowdet[valrec_det]</td>";
        echo "<td class='Td2' align='center'><a href='#' onclick='borrar(\"$rowdet[iden_det]\",\"$rowdet[desc_det]\")' title='Borrar el Registro'><img src='icons/feed_delete.png' alt='Borrar el Registro'></a></td>";
        echo "</tr>";
        $cont++;
    }
    ?>
</table>

<table class="Tbl0"><tr><td class="Td1" align='center'><a href="fondo.php"><img src="icons/feed.png">Finalizar</a></td></tr></table>
</form>
</body>
</html>

<?php
function traeser($tip_){
switch($tip_){
    case "1":
        $desc_="Medicametos";
        break;
    case "2":
        $desc_="Servicios medicos quirurgicos";
        break;
    case "3":
        $desc_="Transporte primario";
        break;
    case "4":
        $desc_="Transporte secundario";
        break;
    case "5":
        $desc_="Otros(Insumos)";
        break;
}
return($desc_);
}


function act_codigo($iden_det_,$iden_dfa_,&$codi_det){
    $consultacod="SELECT map.soat_map FROM detalle_factura AS df INNER JOIN tarco AS tar ON tar.iden_tco=df.iden_tco
    INNER JOIN mapii AS map ON map.iden_map=tar.iden_map
    WHERE  df.iden_dfa='$iden_dfa_'";
    $consultacod=mysql_query($consultacod);
    if(mysql_num_rows($consultacod)<>0){
        $row=mysql_fetch_array($consultacod);
        $sql_="UPDATE fr_detalle_rec SET codi_det='$row[soat_map]' WHERE iden_det='$iden_det_'";
        //echo "<br>".$sql_;
        mysql_query($sql_);
    }
    $codi_det=$row[soat_map];
}

function traecum($codi_mdi_){
    $codi_cum='';
    $conscum="SELECT codi_cum FROM cum WHERE codi_mdi='$codi_mdi_'";    
    $conscum=mysql_query($conscum);
    if(mysql_num_rows($conscum)<>0){
        $row_=mysql_fetch_array($conscum);
        $codi_cum=$row_[codi_cum];        
    }
    return($codi_cum);
}
?>