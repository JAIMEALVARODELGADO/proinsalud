<?php
include('php/conexion.php');
?>
<!-- Página de Inicio  -->
<HTML>
<HEAD>
<title>Inicio</title>
</HEAD>
<body bgcolor="#E6E8FA" onload="javascript:cargar()">
    <?php
    $cons="SELECT iden_fac,nume_fac FROM encabezado_factura WHERE nume_fac<>'' and LENGTH(nume_fac)=7 ORDER BY iden_fac";
    $cons=mysql_query($cons);
    while($row=mysql_fetch_array($cons)){
        echo "<br>".$row[nume_fac];
        $nuevonum=substr($row[nume_fac],1,6);        
        //echo "<br>".$nuevonum;
        $sql="UPDATE encabezado_factura SET nume_fac='$nuevonum' WHERE iden_fac='$row[iden_fac]'";
        echo "<br>".$sql;
        mysql_query($sql);
    }
    
    $cons="SELECT iden_fpr,numf_fpr FROM fprocedim WHERE numf_fpr<>'' and LENGTH(numf_fpr)=7 ORDER BY iden_fpr";
    $cons=mysql_query($cons);
    while($row=mysql_fetch_array($cons)){
        echo "<br>".$row[numf_fpr];
        $nuevonum=substr($row[numf_fpr],1,6);        
        //echo "<br>".$nuevonum;
        $sql="UPDATE fprocedim SET numf_fpr='$nuevonum' WHERE iden_fpr='$row[iden_fpr]'";
        echo "<br>".$sql;
        mysql_query($sql);
    }
    
    $cons="SELECT regi_fur,numf_fur FROM furgencia WHERE numf_fur<>'' and LENGTH(numf_fur)=7 ORDER BY regi_fur";
    $cons=mysql_query($cons);
    while($row=mysql_fetch_array($cons)){
        echo "<br>".$row[numf_fur];
        $nuevonum=substr($row[numf_fur],1,6);        
        //echo "<br>".$nuevonum;
        $sql="UPDATE furgencia SET numf_fur='$nuevonum' WHERE regi_fur='$row[regi_fur]'";
        echo "<br>".$sql;
        mysql_query($sql);
    }
    
    $cons="SELECT regi_fho,numf_fho FROM fhospital WHERE numf_fho<>'' and LENGTH(numf_fho)=7 ORDER BY regi_fho";
    $cons=mysql_query($cons);
    while($row=mysql_fetch_array($cons)){
        echo "<br>".$row[numf_fho];
        $nuevonum=substr($row[numf_fho],1,6);        
        //echo "<br>".$nuevonum;
        $sql="UPDATE fhospital SET numf_fho='$nuevonum' WHERE regi_fho='$row[regi_fho]'";
        echo "<br>".$sql;
        mysql_query($sql);
    }
    
    $cons="SELECT regi_fme,numf_fme FROM fmedicamento WHERE numf_fme<>'' and LENGTH(numf_fme)=7 ORDER BY regi_fme";
    $cons=mysql_query($cons);
    while($row=mysql_fetch_array($cons)){
        echo "<br>".$row[numf_fme];
        $nuevonum=substr($row[numf_fme],1,6);
        //echo "<br>".$nuevonum;
        $sql="UPDATE fmedicamento SET numf_fme='$nuevonum' WHERE regi_fme='$row[regi_fme]'";
        echo "<br>".$sql;
        mysql_query($sql);
    }
    
    $cons="SELECT regi_fna,numf_fna FROM fnacidos WHERE numf_fna<>'' and LENGTH(numf_fna)=7 ORDER BY regi_fna";
    $cons=mysql_query($cons);
    while($row=mysql_fetch_array($cons)){
        echo "<br>".$row[numf_fna];
        $nuevonum=substr($row[numf_fna],1,6);
        //echo "<br>".$nuevonum;
        $sql="UPDATE fnacidos SET numf_fna='$nuevonum' WHERE regi_fna='$row[regi_fna]'";
        echo "<br>".$sql;
        mysql_query($sql);
    }
    
    $cons="SELECT iden_fco,numf_fco FROM fconsulta WHERE numf_fco<>'' and LENGTH(numf_fco)=7 ORDER BY iden_fco";
    $cons=mysql_query($cons);
    while($row=mysql_fetch_array($cons)){
        echo "<br>".$row[numf_fco];
        $nuevonum=substr($row[numf_fco],1,6);
        //echo "<br>".$nuevonum;
        $sql="UPDATE fconsulta SET numf_fco='$nuevonum' WHERE iden_fco='$row[iden_fco]'";
        echo "<br>".$sql;
        mysql_query($sql);
    }
    mysql_free_result($cons);
    mysql_close();
    ?>
</body>
</HTML>
