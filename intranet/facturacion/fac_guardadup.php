<html>
<head>
<title>PROGRAMA DE FACTURACIÓN</title>
<script languaje="javascript">
function regresar(codi_){
    alert("H E C H O");
    window.open("fac_muesccion.php?codi_con="+codi_,"fr02");
}
</script>
</head>
<link rel="stylesheet" href="css/style.css" type="text/css" />
<?
set_time_limit(0);
include('php/funciones.php');
include('php/conexion.php');

/*echo "<br>Contrato ".$codi_con;
echo "<br>Contratacion ".$contrato;
echo "<br>".$procedim;
echo "<br>% act: ".$poract;
echo "<br>Tp :".$tpporact;
echo "<br>".$grupo;
echo "<br>% Grupo: ".$porgru;
echo "<br>Tp: ".$tpporgru;
echo "<br>".$medicam;
echo "<br>".$pormed;
echo "<br>".$tppormed;
echo "<br>".$insumo;
echo "<br>".$porins;
echo "<br>".$tpporins;
echo "<br>Redondeo: ".$redondeo;
echo "<br>".$iden_ctr;
echo "<br>";
echo "<br>";*/

//Aqui comienzo a duplicar actividades
if($procedim=='on'){
    $consultaorg="SELECT * FROM tarco AS tar WHERE tar.clas_tco='P' and tar.iden_ctr=$contrato and tar.esta_tco='AC'";
    $consultaorg=mysql_query($consultaorg);
    while($roworg=mysql_fetch_array($consultaorg)){
        //Aquí consulto si la actividad ya esta parametrizada
        $consultaex="SELECT iden_tco FROM tarco WHERE iden_map='$roworg[iden_map]' AND iden_ctr=$iden_ctr AND clas_tco='$roworg[clas_tco]'";
        $consultaex=mysql_query($consultaex);
        if(mysql_num_rows($consultaex)==0){
            $valor=$roworg[valo_tco];
            if($tpporact=="+"){$valor=$roworg[valo_tco]+($roworg[valo_tco]*($poract/100));}
            else{$valor=$roworg[valo_tco]-($roworg[valo_tco]*($poract/100));}
            //echo "<br>".$valor;
            $valor=round($valor,$redondeo);
            $guarda="INSERT INTO tarco(iden_tco,iden_map,iden_ctr,tser_tco,clas_tco,valo_tco,grqx_tco,esta_tco)
                values(0,$roworg[iden_map],$iden_ctr,'$roworg[tser_tco]','$roworg[clas_tco]',$valor,'$roworg[grqx_tco]','$roworg[esta_tco]')";
            $guarda=mysql_query($guarda);
            //echo "<br>".$guarda;
        }        
    }
    mysql_free_result($consultaorg);
}

//Aqui comienzo a duplicar medicamentos
if($medicam=='on'){
    $consultaorg="SELECT * FROM tarco AS tar WHERE tar.clas_tco='M' and tar.iden_ctr=$contrato";
    $consultaorg=mysql_query($consultaorg);
    while($roworg=mysql_fetch_array($consultaorg)){
        //Aquí consulto si el medicamento ya esta parametrizado
        $consultaex="SELECT iden_tco FROM tarco WHERE iden_map='$roworg[iden_map]' AND iden_ctr=$iden_ctr AND clas_tco='$roworg[clas_tco]'";
        //echo "<br>".$consultaex;
        $consultaex=mysql_query($consultaex);
        if(mysql_num_rows($consultaex)==0){
            $valor=$roworg[valo_tco];
            if($tppormed=="+"){$valor=$roworg[valo_tco]+($roworg[valo_tco]*($pormed/100));}
            else{$valor=$roworg[valo_tco]-($roworg[valo_tco]*($pormed/100));}
            //echo "<br>".$valor;
            $valor=round($valor,$redondeo);
            $guarda="INSERT INTO tarco(iden_tco,iden_map,iden_ctr,tser_tco,clas_tco,valo_tco,grqx_tco,esta_tco)
                values(0,'$roworg[iden_map]',$iden_ctr,'$roworg[tser_tco]','$roworg[clas_tco]',$valor,'$roworg[grqx_tco]','$roworg[esta_tco]')";
            $guarda=mysql_query($guarda);
            //echo "<br>".$guarda;
        }
        //else{echo "<br>Existe!!";}
    }
    mysql_free_result($consultaorg);
}

//Aqui comienzo a duplicar insumos
if($insumo=='on'){
    $consultaorg="SELECT * FROM tarco AS tar WHERE tar.clas_tco='I' and tar.iden_ctr=$contrato";    
    $consultaorg=mysql_query($consultaorg);
    while($roworg=mysql_fetch_array($consultaorg)){
        //Aquí consulto si el insumo ya esta parametrizado
        $consultaex="SELECT iden_tco FROM tarco WHERE iden_map='$roworg[iden_map]' AND iden_ctr=$iden_ctr AND clas_tco='$roworg[clas_tco]'";
        //echo "<br>".$consultaex;
        $consultaex=mysql_query($consultaex);
        if(mysql_num_rows($consultaex)==0){
            $valor=$roworg[valo_tco];
            if($tpporins=="+"){$valor=$roworg[valo_tco]+($roworg[valo_tco]*($porins/100));}
            else{$valor=$roworg[valo_tco]-($roworg[valo_tco]*($porins/100));}
            //echo "<br>".$valor;
            $valor=round($valor,$redondeo);
            $guarda="INSERT INTO tarco(iden_tco,iden_map,iden_ctr,tser_tco,clas_tco,valo_tco,grqx_tco,esta_tco)
                values(0,'$roworg[iden_map]',$iden_ctr,'$roworg[tser_tco]','$roworg[clas_tco]',$valor,'$roworg[grqx_tco]','$roworg[esta_tco]')";
            $guarda=mysql_query($guarda);
            //echo "<br>".$guarda;
        }
        //else{echo "<br>Existe!!";}
    }
    mysql_free_result($consultaorg);
}

//Aqui comienzo a duplicar grupos
if($grupo=='on'){
    $consultaorg="SELECT * FROM grupoxcont AS grp WHERE grp.iden_ctr=$contrato";
    //echo "<br>".$consultaorg;
    $consultaorg=mysql_query($consultaorg);
    while($roworg=mysql_fetch_array($consultaorg)){
        //Aquí consulto si el insumo ya esta parametrizado
        $consultaex="SELECT iden_gxc FROM grupoxcont WHERE iden_ctr=$iden_ctr AND iden_gqx='$roworg[iden_gqx]'";
        //echo "<br>".$consultaex;
        $consultaex=mysql_query($consultaex);
        if(mysql_num_rows($consultaex)==0){            
            $valor=$roworg[valo_gxc];
            if($tpporgru=="+"){$valor=$roworg[valo_gxc]+($roworg[valo_gxc]*($porgru/100));}
            else{$valor=$roworg[valo_gxc]-($roworg[valo_gxc]*($porgru/100));}
            $valor=round($valor,$redondeo);
            $guarda="INSERT INTO grupoxcont(iden_gxc,iden_ctr,iden_gqx,desc_gxc,valo_gxc) 
                values(0,$iden_ctr,$roworg[iden_gqx],'$roworg[desc_gxc]',$valor)";
            $guarda=mysql_query($guarda);
            //echo "<br>".$guarda;
        }
        //else{echo "<br>Existe!!";}
    }
    mysql_free_result($consultaorg);
}
mysql_close();
echo "<body onload='regresar(\"$codi_con\")'>";
?>  
</body>
</html>