<?php
//Validaciones para la facturación automática de magisterio
function muestraerror($error_){
    echo "<tr>";
    echo "<td>".$error_."</td>";
    echo "</tr>";
}
function validausu($codi_,$cont_,$nrod_){    
    $conusu_="SELECT nrod_usu,codi_usu,esta_uco FROM usuario LEFT JOIN ucontrato ON cusu_uco=codi_usu WHERE codi_usu='$codi_' AND cont_uco='$cont_'";
    $conusu_=mysql_query($conusu_);
    if(mysql_num_rows($conusu_)==0){
        $error_="El usuario $nrod_ no registrado en el contrato";
        muestraerror($error_);
        $GLOBALS['error']=1;
    }
    else{
        $row_=mysql_fetch_array($conusu_);        
        if($row_[esta_uco]<>'AC'){
            $error_="El usuario $nrod_ se encuentra suspendido";
            muestraerror($error_);
            //$GLOBALS['error']=1;
        }
    }    
}

function validacie10($cod_,$usu_,$cpl_,$modul_){
    $conscie_="SELECT cod_cie10 FROM cie_10 WHERE cod_cie10='$cod_'";
    $conscie_=mysql_query($conscie_);
    if(mysql_num_rows($conscie_)==0){
        $error_="El Diagnóstico $cod_ no existe, usuario $usu_ , ($modul_) $cpl_";
        muestraerror($error_);
        $GLOBALS['error']=1;
    }
}

function validaarea($codides_,$areacpl_,$nomb_){
    if($codides_==""){        
        $error_="Area ".$areacpl_." ".$nomb_." no homologada";
        muestraerror($error_);
        $GLOBALS['error']=1;
    }
}

function validacons($area_,$coancpl_,$cupmp_,$cupmc_){    
    $cups_='';
    if($coancpl_=='1'){
        $cups_=$cupmp_;
    }
    else{
        $cups_=$cupmc_;
    }
    if($cups_=="" OR is_null($cups_)){
        $error_="El area $area_ no tiene codigo CUPS asignado";
        muestraerror($error_);
        $GLOBALS['error']=1;
        $GLOBALS['error_registro']="S";
    }
    else{
        $conscodigo="SELECT codigo FROM cups WHERE codi_cup='$cups_' AND esta_cup='AC'";
        $conscodigo=mysql_query($conscodigo);
        if(mysql_num_rows($conscodigo)<>0){
            $rowcod=mysql_fetch_array($conscodigo);
            $cups_=$rowcod['codigo'];
            //echo "<br>".$cups_;
        }
        else{
            $GLOBALS['error_registro']="S";
            $error_="El código $cups_ del $area_ no está activo";
        }
    }
    return($cups_);
}
function validactr($cups,$iden_ctr,&$iden_tco,&$desc_map,&$valo_tco){       
    $consctr="SELECT iden_tco,iden_map,codi_cup,descrip,codi_map,valo_tco,grqx_tco,esta_tco
    FROM vista_tarco
    WHERE codi_map='$cups' and iden_ctr='$iden_ctr'";
    //echo "<BR><BR>: ".$consctr;
    $consctr=mysql_query($consctr);    
    if(mysql_num_rows($consctr)==0){
        $conscup_="SELECT codi_cup FROM cups WHERE codigo='$cups'";
        $conscup_=mysql_query($conscup_);
        if(mysql_num_rows($conscup_)<>0){
            $rowcup_=mysql_fetch_array($conscup_);
            $codi_cup_=$rowcup_[codi_cup];
        }
        else{
            $codi_cup_=$cups;
        }
        $error_="Cups $codi_cup_ no parametrizado en el contrato";
        muestraerror($error_);
        $GLOBALS['error']=1;
        $GLOBALS['error_registro']='S';        
    }
    else{
        $rowctr=mysql_fetch_array($consctr);
        $iden_tco=$rowctr[iden_tco];        
        $desc_map=$rowctr[descrip];        
        $valo_tco=$rowctr[valo_tco];                
        if($rowctr[grqx_tco]<>'' and $rowctr[valo_tco]==0){
            //echo "<br>Grupo...:".$rowctr[grqx_tco];            
            $consgrupo="SELECT iden_gqx,grup_gqx,iden_ctr,valo_gxc FROM vista_grupoqx_parametrizado WHERE grup_gqx='$rowctr[grqx_tco]' AND iden_ctr='$iden_ctr'";
            //echo "<br>".$consgrupo;
            $consgrupo=mysql_query($consgrupo);
            if(mysql_num_rows($consgrupo)==0){
                $error_="El código $rowctr[codi_cup] no tiene grupo quirurgico asignado";
                muestraerror($error_);
                $GLOBALS['error']=1;
                $GLOBALS['error_registro']='S';
            }
            else{
                while($rowgrupo=mysql_fetch_array($consgrupo)){
                    //echo "<br>".$rowgrupo[valo_gxc];
                    $valo_tco=$valo_tco+$rowgrupo[valo_gxc];
                }
                //echo "<br>Total...:".$rowctr[codi_cup].'  '.$valo_tco;
            }
        }
        if($valo_tco==0){
            $error_="El código $rowctr[codi_cup] no tiene valor";
            muestraerror($error_);
            $GLOBALS['error']=1;
            $GLOBALS['error_registro']='S';
        }
    }    
}

function validamedctr($codi_,$iden_ctr,&$iden_tco,&$desc_map,&$valo_tco,&$tipo_dfa,$ncsi_,$nomb_){
    $encontrado_="N";
    $consctr="SELECT iden_tco,codi_mdi,nomb_mdi,valo_tco
    FROM vista_medicamentos_tarco    
    WHERE codi_mdi='$codi_' and iden_ctr='$iden_ctr'";    
    //echo "<BR><BR>".$consctr;    
    $consctr=mysql_query($consctr);
    if(mysql_num_rows($consctr)<>0){
        $tipo_dfa="M";
        $rowctr=mysql_fetch_array($consctr);
        $iden_tco=$rowctr[iden_tco];
        $desc_map=$rowctr[nomb_mdi];
        $valo_tco=$rowctr[valo_tco];
        if($valo_tco==0){
            $error_="El código $ncsi_ del medicamento no $nomb_ tiene valor";
            muestraerror($error_);
            $GLOBALS['error']=1;
        }
        $encontrado_="S";
    }
    else{
        $consctr="SELECT iden_tco,codi_ins,desc_ins,valo_tco,iden_ctr
        FROM vista_insumos_tarco        
        WHERE codi_ins='$codi_' and iden_ctr='$iden_ctr'";        
        //echo "<BR><BR>".$consctr;
        $consctr=mysql_query($consctr);
        if(mysql_num_rows($consctr)<>0){
            $tipo_dfa="I";
            $rowctr=mysql_fetch_array($consctr);
            $iden_tco=$rowctr[iden_tco];
            $desc_map=$rowctr[desc_ins];
            $valo_tco=$rowctr[valo_tco];            
            if($valo_tco==0){
                $error_="El código $ncsi_ del insumo $nomb_ no tiene valor";
                muestraerror($error_);
                $GLOBALS['error']=1;
            }
            $encontrado_="S";            
        }
    }    
    if($encontrado_=="N"){
        $error_="El código $ncsi_ de medicamento o insumo $nomb_ no parametrizado en el contrato";
        muestraerror($error_);
        $GLOBALS['error']=1;
    }
}

function traeareamed($codi_medi){    
    $area_="";
    $consarea="SELECT destipos.codi_des,destipos.nomb_des FROM destipos WHERE destipos.codi_des=
    (SELECT destipos.homo2_des
    FROM medicos INNER JOIN destipos ON medicos.espe_med = destipos.codi_des
    WHERE (((medicos.csii_med)='$codi_medi')))";      
    echo "<br>".$consarea;    
    $consarea=mysql_query($consarea);
    if(mysql_num_rows($consarea)<>0){        
        $rowarea=mysql_fetch_array($consarea);
        $area_=$rowarea[codi_des];
        //echo "<br>".$area_;
    }
    else{
        //echo "<br>".$codi_medi;
        $error_="La especialidad del médico $codi_medi NO esta homologado en destipos";
        muestraerror($error_);
        $GLOBALS['error']=1;
    }    
    return($area_);
}
?>
<html><head></head><body></body></html>