<?
function titulo(&$pdf,&$fila){
    if(empty($fila)){$fila=0;}
    global $razo_emp;
    global $nite_emp;
    global $dire_emp;
    global $tele_emp;
    global $enca_emp;
    global $num_fac;
    global $pref_fac;
    global $id_ing;
    global $feci_fac;
    global $fecf_fac;
    global $fcie_fac;
    global $cod;
    global $nombre;
    global $sexo;
    global $fnacim;
    global $edad;
    global $estr_usu;
    global $regi_usu;
    global $con2;
    global $con;
    global $nit_con;
    global $tafil;
    global $muni;
    global $direc;
    global $cod_cie10;
    global $nom_cie10;
    global $area_fac;
    global $pag_;
    global $impretot_;
    global $anul_fac;
    $pdf->AddPage();
    $pdf->Image('icons\encabezado_factura.jpg',15,5,190,16,'','');
    $pdf->Image('icons\pie_factura.JPG',15,254,190,8,'','');
    $pdf->Image('icons\controlado.jpg',200,100,12,30,'','');
    if($anul_fac=='S'){
        $pdf->Image('icons\anulada.JPG',100,80,30,20,'','');
    }
    $pdf->SetFont('Arial','',6);
    $pdf->SetXY(185,16);
    $pdf->Cell(5,4,$pag_,0,0,'C');
    
    $pdf->SetXY(195,16);
    if($impretot_!="S"){
        $pdf->Cell(5,4,'{nb}',0,0,'C');
    }
    $pdf->SetFont('Arial','',8);
    $fila=22;
    $pdf->SetXY(15,$fila);
    $pdf->Cell(40,4,'Fecha Elaboracin de Factura: '.$fcie_fac,0);

    $pdf->SetXY(150,$fila);
    if(!empty($num_fac)){
            $pdf->Cell(20,4,'Factura Nro: ',0);
            $pdf->SetFont('Arial','B',8);
            $pdf->SetXY(170,$fila);
            $pdf->Cell(18,4,$pref_fac.' '.$num_fac,0,2,'R');
            }
    else{
            $pdf->SetFont('Arial','B',8);
            //$pdf->SetXY(185,16);
            $pdf->Cell(22,4,'PREFACTURA',0);            
    }        
    $fila=$fila+4;
    $pdf->SetFont('Arial','',8);
    $pdf->SetXY(15,$fila);
    $pdf->Cell(45,4,"Nombre del Contrato o Particular: ",0);
    
    $pdf->SetXY(60,$fila);
    //$pdf->SetFont('Arial','',6);
    $pdf->Cell(7,4,$con2,0);
    $pdf->SetXY(67,$fila);
    $pdf->Cell(40,4,$con,0);

    $fila=$fila+4;
    $pdf->SetFont('Arial','',8);
    $pdf->SetXY(15,$fila);
    $pdf->Cell(45,4,"Nit: ".$nit_con,0);

    $fila=$fila+4;
    $pdf->SetFont('Arial','B',8);
    $pdf->SetXY(15,$fila);
    $pdf->Cell(190,4,"DEBE A:",0,0,'C');

    $fila=$fila+4;
    $pdf->SetXY(15,$fila);
    $pdf->MultiCell(190,4,$razo_emp,0,'C',0);
    
    $pdf->SetFont('Arial','',7);
    $fila=$fila+4;
    $pdf->SetXY(15,$fila);
    $pdf->multicell(190,4,"Nit: ".$nite_emp,0,'C');
    $fila=$fila+4;
    $pdf->SetXY(15,$fila);
    $pdf->multicell(190,4,$dire_emp." - Tel: ".$tele_emp,0,'C');
    $fila=$fila+4;
    $pdf->SetXY(15,$fila);
    $pdf->multiCell(190,4,$enca_emp,0,'C');
    $fila=$pdf->GetY();
    //$fila=$fila+4;
    //linea(15,$fila,190,'_',$pdf);
    if($pag_==1){
        linea(15,$fila,190,'_',$pdf);
        $fila=$fila+4;
        $pdf->SetXY(15,$fila);
	$pdf->Cell(40,5,"Admisin: ".$id_ing,0);
        $pdf->SetXY(78,$fila);
	$pdf->Cell(40,5,"Identificacin: ".$cod,0);
        $pdf->SetXY(141,$fila);
	$pdf->Cell(40,5,"Autorizacin:",0);
        
        $fila=$fila+4;
        $pdf->SetXY(15,$fila);	
	$pdf->Cell(40,5,"Nombre: ".$nombre,0);
	$pdf->SetXY(78,$fila);
	$pdf->Cell(40,5,"Fecha Nacimiento: ".$fnacim,0);
	$pdf->SetXY(141,$fila);
	$pdf->Cell(40,5,"Edad: ".$edad,0);
        
        $fila=$fila+4;
        $pdf->SetXY(15,$fila);
	$pdf->Cell(40,5,"Municipio: ".$muni,0);
        $pdf->SetXY(78,$fila);
	$pdf->Cell(40,5,"Fecha de Ingreso: ".$feci_fac,0);
        $pdf->SetXY(141,$fila);
	$pdf->Cell(40,5,"Estrato: ".$estr_usu,0);
        
        $fila=$fila+4;
        $pdf->SetXY(15,$fila);
	$pdf->Cell(40,5,"Tipo Afiliacin: ".$tafil,0);        
	$pdf->SetXY(78,$fila);
	$pdf->Cell(40,5,"Fecha de Egreso: ".$fecf_fac,0);
        $pdf->SetXY(141,$fila);
	$pdf->Cell(40,5,"Rgimen: ".$regi_usu,0);
        
        $fila=$fila+4;
        $pdf->SetXY(15,$fila);
	$pdf->Cell(40,5,"Dx: ".$cod_cie10." ".$nom_cie10,0);
        $consultaser=mysql_query("SELECT nomb_des FROM destipos WHERE codi_des='$area_fac'");
        $servicio="";
        if(mysql_num_rows($consultaser)<>0){
            $rowser=mysql_fetch_array($consultaser);
            $servicio=$rowser[nomb_des];
        }
        mysql_free_result($consultaser);
        $pdf->SetXY(141,$fila);
	$pdf->Cell(40,5,"Servicio: ".$servicio,0);

    }
    //Aqui coloco el titulo de las columnas	
    linea(15,$fila,190,'_',$pdf);
    $fila=$fila+4;
    $pdf->SetXY(15,$fila);
    $pdf->Cell(40,4,"CONCP",0);
				
    $pdf->SetXY(25,$fila);
    $pdf->Cell(40,4,"CODIGO",0);

    $pdf->SetXY(42,$fila);
    $pdf->Cell(95,4,"DESCRIPCION",0,2,'C');

    $pdf->SetXY(140,$fila);
    $pdf->Cell(8,4,"CANT",0);

    $pdf->SetXY(155,$fila);
     $pdf->Cell(15,4,"V/UNIT",0,2,'C');

     $pdf->SetXY(180,$fila);
     $pdf->Cell(20,4,"V/TOTAL",0,2,'C');

     linea(15,$fila,190,'_',$pdf);
     $fila=$fila+4;
     $pag_=$pag_+1;
}

function increm($fila,&$pdf,$valor_){
	$fila=$fila+$valor_;        
	if($fila>=234){
                $fila=24;
		titulo($pdf,$fila);
		//$fila=35;
	}
	return ($fila);
}

function linea($col_,$fil_,$cant_,$car_,&$pdf){
  for($n=0;$n<$cant_;$n++){
    $pdf->SetXY($col_+$n,$fil_);
	$pdf->Cell(40,5,$car_,0);
  }
}


function imprefac($iden_fac,&$pdf){
    include('php/conexion.php');
    $fila=increm($fila,$pdf,4);
    $consultatot="SELECT ef.pcop_fac,ef.vcop_fac,ef.pdes_fac,cmod_fac,SUM(df.cant_dfa*df.valu_dfa) AS total FROM detalle_factura AS df 
                  INNER JOIN encabezado_factura AS ef ON ef.iden_fac=df.iden_fac
                  WHERE ef.iden_fac=$iden_fac GROUP BY ef.iden_fac";
    //echo "<br>".$consultatot;
    $consultatot=mysql_query($consultatot);    
    if(mysql_num_rows($consultatot)){
      $rowtot=mysql_fetch_array($consultatot);
      $vlcopa=$rowtot[vcop_fac];
      //$vldescu=round(($rowtot[total]*($rowtot[pdes_fac]/100)),-1);
      $vldescu=round(($rowtot[total]*($rowtot[pdes_fac]/100)),0);
    }
    global $pag_;
    $pag_=1;
    $result="SELECT ef.iden_fac,ef.id_ing,ef.nume_fac, ef.tipo_fac, ef.feci_fac, ef.fecf_fac, ef.rela_fac,ef.pref_fac,ef.fcie_fac,ef.vtot_fac, ef.pcop_fac,ef.vcop_fac, ef.pdes_fac, ef.vnet_fac,ef.cod_cie10,ef.area_fac,ef.usua_fac,ef.anul_fac,
    us.NROD_USU, us.PNOM_USU, us.SNOM_USU, us.PAPE_USU, us.SAPE_USU, us.FNAC_USU, us.SEXO_USU, us.DIRE_USU, us.TRES_USU, us.REGI_USU, us.MRES_USU,us.TPAF_USU,us.DIRE_USU,us.ESTR_USU,
    ct.NOMR_CON, ct.CODI_CON,ct.NIT_CON,con.rcod_ctr
    FROM encabezado_factura AS ef 
    INNER JOIN contratacion AS con ON con.iden_ctr=ef.iden_ctr
    INNER JOIN contrato AS ct ON con.codi_con=ct.CODI_CON
    INNER JOIN usuario AS us ON ef.codi_usu = us.CODI_USU
    WHERE ef.iden_fac='$iden_fac'";
    //echo "<br>".$result;
    $result=mysql_query($result);
    while($row = mysql_fetch_array($result)){
            global $num_fac;   
            global $cod;
            global $nombre;
            global $sexo;
            global $muni;
            global $con;
            global $con2;
            global $nit_con;
            global $estr_usu;
            global $regi_usu;
            global $fnacim;
            global $edad;
            global $tafil;
            global $direc;
            global $feci_fac;
            global $fecf_fac;
            global $pref_fac;
            global $fcie_fac;
            global $cod_cie10;
            global $area_fac;
            global $id_ing;
            global $muni;
            global $nom_cie10;            
            global $anul_fac;
            $num_fac=$row[nume_fac];
            $cod=$row[NROD_USU];
            $nom=$row["PNOM_USU"];
            $nom2=$row["SNOM_USU"];
            $ape=$row["PAPE_USU"];
            $ape2=$row["SAPE_USU"];
            $nombre= $nom." ".$nom2." ".$ape." ".$ape2;
            $sexo=$row["SEXO_USU"];
            $muni=$row["MRES_USU"];
            $con=$row["NOMR_CON"];
            $con2=$row["CODI_CON"];
            $nit_con=$row[NIT_CON];
            $estr_usu=$row["ESTR_USU"];
            $regi_usu=$row["REGI_USU"];
            $fnacim=cambiafechadmy($row[FNAC_USU]);
            $edad=calculaedad($row[FNAC_USU]);
            $tafil=$row[TPAF_USU];
            $direc=$row[DIRE_USU];
            $feci_fac=cambiafechadmy($row[feci_fac]);
            $fecf_fac=cambiafechadmy($row[fecf_fac]);
            $pref_fac=$row[pref_fac];            
            $fcie_fac=cambiafechadmy($row[fcie_fac]);
            $cod_cie10=$row[cod_cie10];
            $area_fac=$row[area_fac];
            $id_ing=$row[id_ing];
            $vtot_fac=$row[vtot_fac];
            $pcop_fac=$row[pcop_fac];
            $vcop_fac=$row[vcop_fac];
            $pdes_fac=$row[pdes_fac];
            $vnet_fac=$row[vnet_fac];
            $usua_fac=$row[usua_fac];            
            $anul_fac=$row[anul_fac];
            $rcod_ctr=$row[rcod_ctr];
            $consultacie=mysql_query("SELECT nom_cie10 FROM cie_10 WHERE cod_cie10='$cod_cie10'");
            if(mysql_num_rows($consultacie)<>0){
                $rowcie=mysql_fetch_array($consultacie);
                $nom_cie10=SUBSTR($rowcie[nom_cie10],0,70);
            }
            mysql_free_result($consultacie);
    }
    titulo($pdf,$fila);

    //Aqui busco la clasificacin de las actividades
    $consultagr=mysql_query("SELECT grupo.codi_des,grupo.nomb_des FROM destipos AS grupo WHERE grupo.codt_des='18'");
    while($rowgr=mysql_fetch_array($consultagr)){        
        $condet="SELECT df.iden_fac, df.tipo_dfa,df.iden_dfa, df.iden_fac,df.iden_tco, df.desc_dfa, df.cant_dfa, df.valu_dfa
        FROM detalle_factura AS df 
        LEFT JOIN tarco AS tco ON tco.iden_tco=df.iden_tco 
        LEFT JOIN mapii AS map ON map.iden_map=tco.iden_map        
        WHERE df.iden_fac=$iden_fac AND map.clas_map='$rowgr[codi_des]' AND df.tipo_dfa='P'";
        $condet=mysql_query($condet);
        if(mysql_num_rows($condet)<>0){
            $pdf->SetFont('Arial','B',7);
            $pdf->SetXY(15,$fila);
            $pdf->Cell(120,4,$rowgr[nomb_des],0,0,'C');
            $pdf->SetFont('Arial','',6);
            $fila=increm($fila,$pdf,4);
            while($rowdet=mysql_fetch_array($condet)){
                $tipo_dfa=$rowdet[tipo_dfa];
                $iden_dfa=$rowdet[iden_dfa];
                $codi_map=$rowdet[codi_map];                
                $iden_tco=$rowdet[iden_tco];
                $desc_dfa=$rowdet[desc_dfa];
                $cant_dfa=$rowdet[cant_dfa];
                $valu_dfa=$rowdet[valu_dfa];
                //$usua_fac=$rowdet[usua_fac];
                //echo $usua_fac;
                $tot_fac=$valu_dfa*$cant_dfa;
                $tser_tco='';
                //$codi_=$rowdet[iden_tco];
                switch ($tipo_dfa){
                    case 'P':
                      //Aqui comparo la codificacion a utilizar de aceurdo a $rcod_ctr  1=Cup 2= Soat
                      if($rcod_ctr=='1'){
                        $consultacod="SELECT codi_map,codi_cup AS codigo FROM mapii AS map
                                              INNER JOIN tarco AS trc ON map.iden_map=trc.iden_map
                                              INNER JOIN cups ON cups.codigo=map.codi_map
                                              WHERE trc.iden_tco=$iden_tco";
                      }
                      else{
                          $consultacod="SELECT soat_map AS codigo FROM mapii AS map
                                              INNER JOIN tarco AS trc ON map.iden_map=trc.iden_map
                                              WHERE trc.iden_tco=$iden_tco";
                      }                  
                      //echo "<br>".$consultacod;
                      $consultacod=mysql_query($consultacod);
                      if(mysql_num_rows($consultacod)<>0){
                            $rowcod=mysql_fetch_array($consultacod);
                            $codi_=$rowcod[codigo];
                      }
                      else{
                        $consultacod="SELECT codi_map AS codigo FROM mapii AS map
                                              INNER JOIN tarco AS trc ON map.iden_map=trc.iden_map                                              
                                              WHERE trc.iden_tco=$iden_tco";
                        $consultacod=mysql_query($consultacod);
                        if(mysql_num_rows($consultacod)<>0){
                            $rowcod=mysql_fetch_array($consultacod);
                            $codi_=$rowcod[codigo];
                        }  
                      }
                      mysql_free_result($consultacod);
                      break;
                }
                //$codi_des=$rowdet[tser_tco];
                $pdf->SetXY(15,$fila);
                $pdf->Cell(8,4,$tser_tco,0);
                $pdf->SetXY(23,$fila);
                //$rcod_ctr 1=Cup 2= Soat
                $pdf->Cell(17,4,$codi_,0);
                $pdf->SetXY(42,$fila);
                //$pdf->cell(95,4,$rowdet[desc_dfa],0);
                $pdf->MultiCell(99,4,$rowdet[desc_dfa],0,L);
                $tempfila=$pdf->GetY();
                $pdf->SetXY(140,$fila);
                $pdf->Cell(8,4,$cant_dfa,0,2,'R');
                $pdf->SetXY(155,$fila);
                $pdf->Cell(15,4,number_format($valu_dfa,0),0,2,'R');
                $pdf->SetXY(180,$fila);
                $pdf->Cell(20,4,number_format($tot_fac,0),0,2,'R');

                $fila=$tempfila;
                $fila=increm($fila,$pdf,0);
                //$fila=increm($fila,$pdf);
                $conqx=mysql_query("SELECT detalle_factura.iden_dfa, detalle_factura.iden_fac, grupoxdeta.iden_gxc, grupoxcont.desc_gxc, grupoxdeta.valo_gxd,grupoqx.grup_gqx
                FROM grupoxcont 
                INNER JOIN grupoqx ON grupoqx.iden_gqx=grupoxcont.iden_gqx
                INNER JOIN grupoxdeta ON grupoxdeta.iden_gxc=grupoxcont.iden_gxc
                INNER JOIN detalle_factura ON detalle_factura.iden_dfa=grupoxdeta.iden_dfa
                WHERE detalle_factura.iden_dfa=$iden_dfa");
                while($rowqx=mysql_fetch_array($conqx)){
                        $desc_gxc=$rowqx[desc_gxc];
                        $valo_gxd=$rowqx[valo_gxd];
                        $grupo=$rowqx[grup_gqx];
                        $pdf->SetXY(45,$fila);
                        $pdf->Cell(40,5,$grupo,0);
                        $pdf->SetXY(50,$fila);
                        $pdf->Cell(40,5,$desc_gxc,0);
                        $pdf->SetXY(150,$fila);
                        $pdf->Cell(15,4,number_format($valo_gxd,0),0,2,'R');
                        $fila=increm($fila,$pdf,4);
                }
            }
        }
    }
    //Aqui imprimo insumos y medicamentos
    $contins=0;
    $contmed=0;
    $condet=mysql_query("SELECT df.iden_fac, df.tipo_dfa,df.iden_dfa, df.iden_fac,df.iden_tco, df.desc_dfa, df.cant_dfa, df.valu_dfa
    FROM detalle_factura AS df
    WHERE df.iden_fac=$iden_fac AND df.tipo_dfa<>'P' ORDER BY df.tipo_dfa desc");
    while($rowdet=mysql_fetch_array($condet)){
        $tipo_dfa=$rowdet[tipo_dfa];
        $iden_dfa=$rowdet[iden_dfa];
        $codi_map=$rowdet[codi_map];
        $iden_tco=$rowdet[iden_tco];
        $desc_dfa=$rowdet[desc_dfa];
        $cant_dfa=$rowdet[cant_dfa];
        $valu_dfa=$rowdet[valu_dfa];
        //$usua_fac=$rowdet[usua_fac];
        $tot_fac=$valu_dfa*$cant_dfa;
        $tser_tco='';
        //$codi_=$rowdet[iden_tco];
        switch ($tipo_dfa){
                    case 'M':
                      $consultacod="SELECT mdi.codi_mdi FROM medicamentos2 AS mdi
                                              INNER JOIN tarco AS trc ON trc.iden_map=mdi.codi_mdi
                                              WHERE trc.iden_tco=$rowdet[iden_tco]";                     
                      //$pdf->SetXY(15,$fila);
                      //$pdf->Cell(120,4,$consultacod,0,0,'C');                  
                      $consultacod=mysql_query($consultacod);
                      if(mysql_num_rows($consultacod)<>0){
                            $rowcod=mysql_fetch_array($consultacod);
                            $codi_=$rowcod[codi_mdi];
                            //$codi_=$rowcod[iden_map];

                      }
                      mysql_free_result($consultacod);
                      break;
                    case 'I':
                      $consultacod=mysql_query("SELECT ins.codnue FROM insu_med AS ins
                                              INNER JOIN tarco AS trc ON trc.iden_map=ins.codnue
                                              WHERE trc.iden_tco=$rowdet[iden_tco]");
                      if(mysql_num_rows($consultacod)<>0){
                            $rowcod=mysql_fetch_array($consultacod);
                            $codi_=$rowcod[codnue];
                      }
                      mysql_free_result($consultacod);
                      break;
        }
        //$codi_des=$rowdet[tser_tco];
        if($tipo_dfa=='I' and $contins==0){
            $pdf->SetFont('Arial','B',7);
            $pdf->SetXY(15,$fila);
            $pdf->Cell(120,4,'Insumos',0,0,'C');
            $pdf->SetFont('Arial','',6);
            $fila=increm($fila,$pdf,4);
            $contins=1;
        }
        if($tipo_dfa=='M' and $contmed==0){
            $pdf->SetFont('Arial','B',7);
            $pdf->SetXY(15,$fila);
            $pdf->Cell(120,4,'Medicamentos',0,0,'C');
            $pdf->SetFont('Arial','',6);
            $fila=increm($fila,$pdf,4);
            $contmed=1;
        }
        $pdf->SetXY(15,$fila);
        $pdf->Cell(8,4,$tser_tco,0);
        $pdf->SetXY(23,$fila);
        $pdf->Cell(17,4,$codi_,0);
        $pdf->SetXY(42,$fila);
        $pdf->MultiCell(99,4,$rowdet[desc_dfa],0,L);
        $tempfila=$pdf->GetY();
        //$pdf->cell(95,4,$rowdet[desc_dfa],0);    
        $pdf->SetXY(140,$fila);
        $pdf->Cell(8,4,$cant_dfa,0,2,'R');
        $pdf->SetXY(155,$fila);
        $pdf->Cell(15,4,number_format($valu_dfa,0),0,2,'R');
        $pdf->SetXY(180,$fila);
        $pdf->Cell(20,4,number_format($tot_fac,0),0,2,'R');
        $fila=$tempfila;
        $fila=increm($fila,$pdf,0);
    }

    linea(15,$fila,190,'_',$pdf);
    $fila=increm($fila,$pdf,4);
    $pdf->SetXY(145,$fila);
    $pdf->Cell(30,4,'SUBTOTAL:',0,2,'R');
    $pdf->SetXY(180,$fila);
    $pdf->multiCell(20,4,number_format($vtot_fac,0),0,'R'); 

    $fila=increm($fila,$pdf,4);
    $pdf->SetXY(145,$fila);
    //$valpco=number_format($vtot_fac*$pcop_fac/100,0);
    //$valpco=$vcop_fac;
    $pdf->Cell(30,4,'Copago:'.'  '.$pcop_fac.'%',0,2,'R');
    $pdf->SetXY(180,$fila);
    $pdf->Cell(20,4,number_format($vcop_fac,0),0,2,'R');      

    $fila=increm($fila,$pdf,4);
    $pdf->SetXY(145,$fila);
    $pdf->Cell(30,4,'Descuento:'.'  '.$pdes_fac.'%',0,2,'R');
    $pdf->SetXY(180,$fila);
    $pdf->Cell(20,4,number_format($vldescu,0),0,2,'R'); 

    $fila=increm($fila,$pdf,4);
    $pdf->SetXY(145,$fila);
    $valcmod=$rowtot[cmod_fac];
    $pdf->Cell(30,4,'Cuota Moderadora: ',0,2,'R');
    $pdf->SetXY(180,$fila);
    $pdf->Cell(20,4,number_format($valcmod,0),0,2,'R'); 

    $fila=increm($fila,$pdf,4);
    $pdf->SetXY(145,$fila);

    $pdf->SetFont('Arial','B',8);
    $pdf->Cell(30,4,'NETO A PAGAR:',0,2,'R');
    $pdf->SetXY(180,$fila);
    $pdf->Cell(20,4,number_format($vnet_fac),0,2,'R');

    $pdf->SetFont('Arial','',7);
    $fila=increm($fila,$pdf,4);
    $pdf->SetXY(15,$fila);
    $pdf->multiCell(190,4,"SON: ".convertir($vnet_fac),1,'L');

    //firma 
    if(file_exists('../firmas/'.$usua_fac.'.jpg')){
        $pdf->Image('../firmas/'.$usua_fac.'.jpg',20,228,40,20);}    
    
    $pdf->SetFont('Arial','',5);
    $pdf->SetXY(15,242);
    $pdf->Cell(40,5,'Firmas:',0);
    //mysql_close();

    //$conexion = mysql_connect("localhost","root","VJvj321");
    //mysql_select_db("general",$conexion);

    base_general();
    $congidus="SELECT nomb_usua FROM cut WHERE ide_usua='$usua_fac'";
    //echo $congidus;
    $congidus=mysql_query($congidus);
    $rowgid=mysql_fetch_array($congidus);    
    $pdf->SetXY(40,242);
    $pdf->Cell(40,5,$rowgid[nomb_usua],0);

    $pdf->SetXY(160,242);
    $pdf->Cell(40,5,$nombre,0);

    $pdf->SetXY(40,244);
    $pdf->Cell(40,5,"Facturador",0);

    
    //linea(15,248,190,'_',$pdf);
    linea(15,238,70,'_',$pdf);
    $pdf->SetXY(15,248);
    $pdf->multiCell(190,2,$rowenca[pie_emp],0,'J');
    $pdf->AliasNbPages();
}

//********************* Funcion para imprimir factura detallada por servicio
function imprefac_2($iden_fac,&$pdf){
    include('php/conexion.php');
    $fila=increm($fila,$pdf,4);
    $consultatot="SELECT ef.pcop_fac,ef.vcop_fac,ef.pdes_fac,cmod_fac,SUM(df.cant_dfa*df.valu_dfa) AS total FROM detalle_factura AS df 
                  INNER JOIN encabezado_factura AS ef ON ef.iden_fac=df.iden_fac
                  WHERE ef.iden_fac=$iden_fac GROUP BY ef.iden_fac";
    //echo "<br>".$consultatot;
    $consultatot=mysql_query($consultatot);    
    if(mysql_num_rows($consultatot)){
      $rowtot=mysql_fetch_array($consultatot);
      $vlcopa=$rowtot[vcop_fac];
      //$vldescu=round(($rowtot[total]*($rowtot[pdes_fac]/100)),-1);
      $vldescu=round(($rowtot[total]*($rowtot[pdes_fac]/100)),0);
    }
    global $pag_;
    $pag_=1;
    $result="SELECT ef.iden_fac,ef.id_ing,ef.nume_fac, ef.tipo_fac, ef.feci_fac, ef.fecf_fac, ef.rela_fac,ef.pref_fac,ef.fcie_fac,ef.vtot_fac, ef.pcop_fac,ef.vcop_fac, ef.pdes_fac, ef.vnet_fac,ef.cod_cie10,ef.area_fac,ef.usua_fac,ef.anul_fac,
    us.NROD_USU, us.PNOM_USU, us.SNOM_USU, us.PAPE_USU, us.SAPE_USU, us.FNAC_USU, us.SEXO_USU, us.DIRE_USU, us.TRES_USU, us.REGI_USU, us.MRES_USU,us.TPAF_USU,us.DIRE_USU,us.ESTR_USU,
    ct.NOMR_CON, ct.CODI_CON,ct.NIT_CON,con.rcod_ctr
    FROM encabezado_factura AS ef 
    INNER JOIN contratacion AS con ON con.iden_ctr=ef.iden_ctr
    INNER JOIN contrato AS ct ON con.codi_con=ct.CODI_CON
    INNER JOIN usuario AS us ON ef.codi_usu = us.CODI_USU
    WHERE ef.iden_fac='$iden_fac'";
    //echo "<br>".$result;
    $result=mysql_query($result);
    while($row = mysql_fetch_array($result)){
            global $num_fac;   
            global $cod;
            global $nombre;
            global $sexo;
            global $muni;
            global $con;
            global $con2;
            global $nit_con;
            global $estr_usu;
            global $regi_usu;
            global $fnacim;
            global $edad;
            global $tafil;
            global $direc;
            global $feci_fac;
            global $fecf_fac;
            global $pref_fac;
            global $fcie_fac;
            global $cod_cie10;
            global $area_fac;
            global $id_ing;
            global $muni;
            global $nom_cie10;            
            global $anul_fac;
            $num_fac=$row[nume_fac];
            $cod=$row[NROD_USU];
            $nom=$row["PNOM_USU"];
            $nom2=$row["SNOM_USU"];
            $ape=$row["PAPE_USU"];
            $ape2=$row["SAPE_USU"];
            $nombre= $nom." ".$nom2." ".$ape." ".$ape2;
            $sexo=$row["SEXO_USU"];
            $muni=$row["MRES_USU"];
            $con=$row["NOMR_CON"];
            $con2=$row["CODI_CON"];
            $nit_con=$row[NIT_CON];
            $estr_usu=$row["ESTR_USU"];
            $regi_usu=$row["REGI_USU"];
            $fnacim=cambiafechadmy($row[FNAC_USU]);
            $edad=calculaedad($row[FNAC_USU]);
            $tafil=$row[TPAF_USU];
            $direc=$row[DIRE_USU];
            $feci_fac=cambiafechadmy($row[feci_fac]);
            $fecf_fac=cambiafechadmy($row[fecf_fac]);
            $pref_fac=$row[pref_fac];            
            $fcie_fac=cambiafechadmy($row[fcie_fac]);
            $cod_cie10=$row[cod_cie10];
            $area_fac=$row[area_fac];
            $id_ing=$row[id_ing];
            $vtot_fac=$row[vtot_fac];
            $pcop_fac=$row[pcop_fac];
            $vcop_fac=$row[vcop_fac];
            $pdes_fac=$row[pdes_fac];
            $vnet_fac=$row[vnet_fac];
            $usua_fac=$row[usua_fac];            
            $anul_fac=$row[anul_fac];
            $rcod_ctr=$row[rcod_ctr];
            $consultacie=mysql_query("SELECT nom_cie10 FROM cie_10 WHERE cod_cie10='$cod_cie10'");
            if(mysql_num_rows($consultacie)<>0){
                $rowcie=mysql_fetch_array($consultacie);
                $nom_cie10=SUBSTR($rowcie[nom_cie10],0,70);
            }
            mysql_free_result($consultacie);
    }
    titulo($pdf,$fila);
    $condet="SELECT iden_fac, tipo_dfa,iden_dfa, iden_fac,iden_tco, desc_dfa, cant_dfa, valu_dfa,servi_dfa,servicio,if(tipo_dfa='M','M',if(tipo_dfa='I','I',clas_map)) AS clas_map,clase 
        FROM vista_factura_detalle_servicio
        WHERE iden_fac='$iden_fac'
        ORDER BY servi_dfa, clas_map,tipo_dfa DESC";
        //echo "<br>".$condet;       
        $condet=mysql_query($condet);
        if(mysql_num_rows($condet)<>0){
            $servi_dfa="";
            $clas_map="";
            while($rowdet=mysql_fetch_array($condet)){
                if($rowdet[servi_dfa]<>$servi_dfa){
                    $pdf->SetFont('Arial','B',7);
                    $pdf->SetXY(15,$fila);
                    $pdf->Cell(120,4,$rowdet[servicio],0,0,'C',true);                    
                    $pdf->SetFont('Arial','',6);
                    $fila=increm($fila,$pdf,4);
                    $servi_dfa=$rowdet[servi_dfa];
                }                

                $tipo_dfa=$rowdet[tipo_dfa];
                $iden_dfa=$rowdet[iden_dfa];
                $codi_map=$rowdet[codi_map];                
                $iden_tco=$rowdet[iden_tco];
                $desc_dfa=$rowdet[desc_dfa];
                $cant_dfa=$rowdet[cant_dfa];
                $valu_dfa=$rowdet[valu_dfa];
                $clase=$rowdet[clase];
                //$usua_fac=$rowdet[usua_fac];
                //echo $usua_fac;
                $tot_fac=$valu_dfa*$cant_dfa;
                $tser_tco='';
                //$codi_=$rowdet[iden_tco];
                switch ($tipo_dfa){
                    case 'P':
                      //Aqui comparo la codificacion a utilizar de aceurdo a $rcod_ctr  1=Cup 2= Soat
                      if($rcod_ctr=='1'){
                        $consultacod="SELECT codi_map,codi_cup AS codigo FROM mapii AS map
                                              INNER JOIN tarco AS trc ON map.iden_map=trc.iden_map
                                              INNER JOIN cups ON cups.codigo=map.codi_map
                                              WHERE trc.iden_tco=$iden_tco";
                      }
                      else{
                          $consultacod="SELECT soat_map AS codigo FROM mapii AS map
                                              INNER JOIN tarco AS trc ON map.iden_map=trc.iden_map
                                              WHERE trc.iden_tco=$iden_tco";
                      }                  
                      //echo "<br>".$consultacod;
                      $consultacod=mysql_query($consultacod);
                      if(mysql_num_rows($consultacod)<>0){
                            $rowcod=mysql_fetch_array($consultacod);
                            $codi_=$rowcod[codigo];
                      }
                      else{
                        $consultacod="SELECT codi_map AS codigo FROM mapii AS map
                                              INNER JOIN tarco AS trc ON map.iden_map=trc.iden_map                                              
                                              WHERE trc.iden_tco=$iden_tco";
                        $consultacod=mysql_query($consultacod);
                        if(mysql_num_rows($consultacod)<>0){
                            $rowcod=mysql_fetch_array($consultacod);
                            $codi_=$rowcod[codigo];
                        }  
                      }
                      mysql_free_result($consultacod);
                      break;
                    case 'M':
                      $clase="Medicamentos";
                      $consultacod="SELECT mdi.codi_mdi,mdi.cum_med FROM medicamentos2 AS mdi
                                              INNER JOIN tarco AS trc ON trc.iden_map=mdi.codi_mdi
                                              WHERE trc.iden_tco=$rowdet[iden_tco]";                     
                      //$pdf->SetXY(15,$fila);
                      //$pdf->Cell(120,4,$consultacod,0,0,'C');                  
                      $consultacod=mysql_query($consultacod);
                      if(mysql_num_rows($consultacod)<>0){
                            $rowcod=mysql_fetch_array($consultacod);
                            $codi_=$rowcod[cum_med];
                            //$codi_=$rowcod[codi_mdi];
                            //$codi_=$rowcod[iden_map];                            
                      }
                      mysql_free_result($consultacod);
                      break;
                    case 'I':
                      $clase="Insumos";
                      $consultacod=mysql_query("SELECT ins.codnue FROM insu_med AS ins
                                              INNER JOIN tarco AS trc ON trc.iden_map=ins.codnue
                                              WHERE trc.iden_tco=$rowdet[iden_tco]");
                      if(mysql_num_rows($consultacod)<>0){
                            $rowcod=mysql_fetch_array($consultacod);
                            $codi_=$rowcod[codnue];
                      }
                      mysql_free_result($consultacod);
                      break;
                }

                if($rowdet[clas_map]<>$clas_map){
                    $pdf->SetFont('Arial','B',7);
                    $pdf->SetXY(15,$fila);
                    $pdf->Cell(120,4,$clase,0,0,'C');
                    $pdf->SetFont('Arial','',6);
                    $fila=increm($fila,$pdf,4);
                    $clas_map=$rowdet[clas_map];
                }

                //$codi_des=$rowdet[tser_tco];
                $pdf->SetXY(15,$fila);
                $pdf->Cell(8,4,$tser_tco,0);
                $pdf->SetXY(23,$fila);
                //$rcod_ctr 1=Cup 2= Soat
                $pdf->Cell(17,4,$codi_,0);
                $pdf->SetXY(42,$fila);
                //$pdf->cell(95,4,$rowdet[desc_dfa],0);
                $pdf->MultiCell(99,4,$rowdet[desc_dfa],0,L);
                $tempfila=$pdf->GetY();
                $pdf->SetXY(140,$fila);
                $pdf->Cell(8,4,$cant_dfa,0,2,'R');
                $pdf->SetXY(155,$fila);
                $pdf->Cell(15,4,number_format($valu_dfa,0),0,2,'R');
                $pdf->SetXY(180,$fila);
                $pdf->Cell(20,4,number_format($tot_fac,0),0,2,'R');

                $fila=$tempfila;
                $fila=increm($fila,$pdf,0);
                //$fila=increm($fila,$pdf);
                $conqx=mysql_query("SELECT detalle_factura.iden_dfa, detalle_factura.iden_fac, grupoxdeta.iden_gxc, grupoxcont.desc_gxc, grupoxdeta.valo_gxd,grupoqx.grup_gqx
                FROM grupoxcont 
                INNER JOIN grupoqx ON grupoqx.iden_gqx=grupoxcont.iden_gqx
                INNER JOIN grupoxdeta ON grupoxdeta.iden_gxc=grupoxcont.iden_gxc
                INNER JOIN detalle_factura ON detalle_factura.iden_dfa=grupoxdeta.iden_dfa
                WHERE detalle_factura.iden_dfa=$iden_dfa");
                while($rowqx=mysql_fetch_array($conqx)){
                        $desc_gxc=$rowqx[desc_gxc];
                        $valo_gxd=$rowqx[valo_gxd];
                        $grupo=$rowqx[grup_gqx];
                        $pdf->SetXY(45,$fila);
                        $pdf->Cell(40,5,$grupo,0);
                        $pdf->SetXY(50,$fila);
                        $pdf->Cell(40,5,$desc_gxc,0);
                        $pdf->SetXY(150,$fila);
                        $pdf->Cell(15,4,number_format($valo_gxd,0),0,2,'R');
                        $fila=increm($fila,$pdf,4);
                }
            }
        }


    linea(15,$fila,190,'_',$pdf);
    $fila=increm($fila,$pdf,4);
    $pdf->SetXY(145,$fila);
    $pdf->Cell(30,4,'SUBTOTAL:',0,2,'R');
    $pdf->SetXY(180,$fila);
    $pdf->multiCell(20,4,number_format($vtot_fac,0),0,'R'); 

    $fila=increm($fila,$pdf,4);
    $pdf->SetXY(145,$fila);
    //$valpco=number_format($vtot_fac*$pcop_fac/100,0);
    //$valpco=$vcop_fac;
    $pdf->Cell(30,4,'Copago:'.'  '.$pcop_fac.'%',0,2,'R');
    $pdf->SetXY(180,$fila);
    $pdf->Cell(20,4,number_format($vcop_fac,0),0,2,'R');      

    $fila=increm($fila,$pdf,4);
    $pdf->SetXY(145,$fila);
    $pdf->Cell(30,4,'Descuento:'.'  '.$pdes_fac.'%',0,2,'R');
    $pdf->SetXY(180,$fila);
    $pdf->Cell(20,4,number_format($vldescu,0),0,2,'R'); 

    $fila=increm($fila,$pdf,4);
    $pdf->SetXY(145,$fila);
    $valcmod=$rowtot[cmod_fac];
    $pdf->Cell(30,4,'Cuota Moderadora: ',0,2,'R');
    $pdf->SetXY(180,$fila);
    $pdf->Cell(20,4,number_format($valcmod,0),0,2,'R'); 

    $fila=increm($fila,$pdf,4);
    $pdf->SetXY(145,$fila);

    $pdf->SetFont('Arial','B',8);
    $pdf->Cell(30,4,'NETO A PAGAR:',0,2,'R');
    $pdf->SetXY(180,$fila);
    $pdf->Cell(20,4,number_format($vnet_fac),0,2,'R');

    $pdf->SetFont('Arial','',7);
    $fila=increm($fila,$pdf,4);
    $pdf->SetXY(15,$fila);
    $pdf->multiCell(190,4,"SON: ".convertir($vnet_fac),1,'L');

    //firma 
    if(file_exists('../firmas/'.$usua_fac.'.jpg')){
        $pdf->Image('../firmas/'.$usua_fac.'.jpg',20,228,40,20);}    
    
    $pdf->SetFont('Arial','',5);
    $pdf->SetXY(15,242);
    $pdf->Cell(40,5,'Firmas:',0);
    //mysql_close();

    //$conexion = mysql_connect("localhost","root","VJvj321");
    //mysql_select_db("general",$conexion);

    base_general();
    $congidus="SELECT nomb_usua FROM cut WHERE ide_usua='$usua_fac'";
    //echo $congidus;
    $congidus=mysql_query($congidus);
    $rowgid=mysql_fetch_array($congidus);    
    $pdf->SetXY(40,242);
    $pdf->Cell(40,5,$rowgid[nomb_usua],0);

    $pdf->SetXY(160,242);
    $pdf->Cell(40,5,$nombre,0);

    $pdf->SetXY(40,244);
    $pdf->Cell(40,5,"Facturador",0);

    
    //linea(15,248,190,'_',$pdf);
    linea(15,238,70,'_',$pdf);
    $pdf->SetXY(15,248);
    $pdf->multiCell(190,2,$rowenca[pie_emp],0,'J');
    $pdf->AliasNbPages();
}

?>