<html>
<head>
<title>PROGRAMA DE FACTURACIN</title>
<link rel="stylesheet" href="css/style.css" type="text/css" />
<script language='javascript'>
function validar(){
  form1.submit();
}
</script>
</head>
<body>
<form name='form1' method="POST" action='fac_4heguardarel.php' target='fr02'>
<table class="Tbl0"><tr><td class="Td0" align='center'>ARCHIVO PLANO PARA TRASLADO A  S I I G O</td></tr></table>
<?
set_time_limit(0);
include('php/conexion.php');
//include('php/conexiones_g.php');
include('php/funciones.php');
//base_420();
$consultaemp="SELECT ctades_emp,ctacaj_emp FROM empresa";
$consultaemp=mysql_query($consultaemp);
$rowemp=mysql_fetch_array($consultaemp);
$ctades=$rowemp[ctades_emp];
$ctacaja=$rowemp[ctacaj_emp];

//Ciclo para  filtrar las entidades

$condicion=$condicion."(";
for ($i=0;$i<count($nit);$i++){
  if($nit[$i]<>''){
    $condicion=$condicion."enti_fac='$nit[$i]' OR ";
  }
}
if(substr($condicion,-1)<>"("){
  $condicion=substr($condicion,0,strlen($condicion)-4).") AND ";
}
else{
    $condicion=substr($condicion,0,strlen($condicion)-1);   
}

$condicion=$condicion."nume_fac<>'' AND anul_fac<>'S' AND ";
if($chkcta<>'on'){$condicion=$condicion."rela_fac<>'' AND ";}
if(!empty($factura)){$condicion=$condicion."nume_fac='$factura' AND ";}
if(!empty($pref_fac)){$condicion=$condicion."pref_fac='$pref_fac' AND ";}
if(!empty($tipo_fac)){$condicion=$condicion."tipo_fac='$tipo_fac' AND ";}
if(!empty($fechaini)){
    $fechaini=cambiafecha($fechaini);
    $condicion=$condicion."fcie_fac>='$fechaini' AND ";
}
if(!empty($fechafin)){
    $fechafin=cambiafecha($fechafin);
    $condicion=$condicion."fcie_fac<='$fechafin' AND ";
}
$condicion=substr($condicion,0,strlen($condicion)-5);
//echo $condicion;
    /*$consulta="SELECT ef.tipo_fac,ef.enti_fac,ef.iden_fac,ef.pref_fac,ef.nume_fac,ef.fcie_fac,ef.vtot_fac,ef.vcop_fac,ef.cmod_fac,ef.pdes_fac,ef.vnet_fac,ef.area_fac
    ,ccion.ccon_ctr,ccion.iden_ctr
    ,sxd.tipfac_sxd,con.codi_cdc
    FROM encabezado_factura AS ef    
    INNER JOIN contratacion AS ccion ON ccion.iden_ctr=ef.iden_ctr
    INNER JOIN contrato AS con ON con.codi_con=ccion.codi_con
    LEFT JOIN servicioxdoc AS sxd ON sxd.codser_sxd=ef.area_fac
    WHERE $condicion ORDER BY ef.nume_fac";*/

$consulta="SELECT tipo_fac,enti_fac,iden_fac,pref_fac,nume_fac,fcie_fac,vtot_fac,vcop_fac,cmod_fac,pdes_fac,vnet_fac,area_fac,ccon_ctr,iden_ctr,tipfac_sxd,codi_cdc
FROM vista_factura_siigo
WHERE $condicion ORDER BY nume_fac";
//echo "<br>".$consulta;
$consulta=mysql_query($consulta);
if(mysql_num_rows($consulta)<>0){
  $siigo="TIPO DE COMPROBANTE,CODIGO COMPROBANTE,NUMERO DE DOCUMENTO,CUENTA CONTABLE,DEBITO O CRÉDITO,VALOR DE LA SECUENCIA,AÑO DEL DOCUMENTO,MES DEL DOCUMENTO,DIA DEL DOCUMENTO,CODIGO DEL VENDEDOR,CODIGO DE LA CIUDAD,CODIGO DE LA ZONA,SECUENCIA,CENTRO DE COSTO,SUBCENTRO DE COSTO,NIT,SUCURSAL,DESCRIPCION DE LA SECUENCIA,NUMERO DE CHEQUE,COMPROBANTE ANULADO,CODIGO DEL MOTIVO DE DEVOLUCION,TIPO DOCUMENTO DE PEDIDO,CODIGO COMPROBANTE DE PEDIDO,NUMERO DE COMPROBANTE PEDIDO,SECUENCIA DE PEDIDO,TIPO Y COMPROBANTE CRUCE,NUMERO DE DOCUMENTO CRUCE,NUMERO DE VENCIMIENTO,AÑO VENCIMIENTO DE DOCUMENTO CRUCE,MES VENCIMIENTO DE DOCUMENTO CRUCE,DÍA VENCIMIENTO DE DOCUMENTO CRUCE\r\n";  
  echo "<table class='Tbl0' border='0'>";
  echo "<th class='Th0'>ERRORES</th>";
  echo "</table>";
  echo "<table class='Tbl0' border='0'>";
  echo "<th class='Th0'>Factura</th>
        <th class='Th0'>Error</th>
        <th class='Th0'>Detalle</th>
        ";
  $cont=0;
  $error=0;
  while($row=mysql_fetch_array($consulta)){
        $consec=1;
        if($color<>'#dddddd'){$color='#dddddd';}else{$color='';}        
        $descuento=round(($row[vtot_fac]*($row[pdes_fac]/100)),0);
        $nume_fac=str_pad($row[nume_fac],11,"0",STR_PAD_LEFT);
        $centrocos=$row[CODI_CDC];
        if(strstr($row[enti_fac],'-')){
            $nit=str_pad(substr($row[enti_fac],0,strpos($row[enti_fac],"-")),13,"0",STR_PAD_LEFT);
        }
        else{
            $nit=str_pad(trim($row[enti_fac]),13,"0",STR_PAD_LEFT);
        }
        $fcie_fac=substr($row[fcie_fac],0,4).substr($row[fcie_fac],5,2).substr($row[fcie_fac],8,2);
        if($row[pref_fac]=="I"){
            $tipdoc="F,004";
        }
        else{
            $tipdoc="F,090";
            if(!IS_NULL($row[tipfac_sxd])){
                $tipdoc=SUBSTR($row[tipfac_sxd],0,1).',';
                $tipdoc=$tipdoc.SUBSTR($row[tipfac_sxd],1,3);                
            }
        }
        $consultadet="SELECT iden_dfa,tipo_dfa,iden_fac,iden_tco,desc_dfa,cant_dfa,valu_dfa,
        cconcir_map AS cuenta
        FROM vista_detalle_factura_siigo     
        WHERE iden_fac='$row[iden_fac]'";
        //echo "<br>".$consultadet;
        $consultadet=mysql_query($consultadet);
        $valormayor=0;
        $cuentamay='';
        $debito=0;
        $credito=0;
        $ctamed="";
        $ctains="";
        $consultaotr="SELECT ctamed_cxs,ctains_cxs FROM cuentaxservicio
        WHERE codi_cxs='$row[area_fac]'";
        //echo "<br>".$consultaotr;
        $consultaotr=mysql_query($consultaotr);      
        if(mysql_num_rows($consultaotr)<>0){
            $rowotr=mysql_fetch_array($consultaotr);
            $ctamed=$rowotr[ctamed_cxs];
            $ctains=$rowotr[ctains_cxs];
        }
        else{
            echo "<tr>";
            echo "<td class='Td2' align='left' bgcolor='$color'>$row[nume_fac]</td>";
            echo "<td class='Td2' align='left' bgcolor='$color'>El Servicio NO tiene codigo contable</td>";
            echo "<td class='Td2' align='left' bgcolor='$color'>$row[area_fac]</td>";
            echo "</tr>";
        }
        while($rowdet=mysql_fetch_array($consultadet)){
            $desc_dfa=str_replace(",",".",$rowdet[desc_dfa]);
            $desc_dfa=ereg_replace('[[:space:]]+',' ',$desc_dfa); //Quito el enter(salto de linea
            $cuenta=$rowdet[cuenta];
            $valor=$rowdet[cant_dfa]*$rowdet[valu_dfa];
			$cantisiigo=ceros(15, ceil(abs($rowdet[cant_dfa])*100000));
			
			
			
			
			if($rowdet[tipo_dfa]=='M'){
                $cuenta=$ctamed;
            }
            elseif($rowdet[tipo_dfa]=='I'){
                $cuenta=$ctains;                
            }
            
            $ciru='N';
            if($ciru=='N'){
                //Aqui genero el registro si no es una cirugia                
                $descripcion=substr($desc_dfa,0,50);
                $descripcion=str_pad($descripcion,50,' ',STR_PAD_RIGHT);
                $siigo=$siigo.$tipdoc.',';
                $siigo=$siigo.$nume_fac.',';
                $siigo=$siigo.str_pad($cuenta,10,"0",STR_PAD_RIGHT).',';
                $siigo=$siigo."C,";
                //$siigo=$siigo.str_pad($valor,13,'0',STR_PAD_LEFT)."00".',';
                $siigo=$siigo.$valor.',';
                $siigo=$siigo.substr($fcie_fac,0,4).',';
                $siigo=$siigo.substr($fcie_fac,4,2).',';
                $siigo=$siigo.substr($fcie_fac,6,2).',';
                $siigo=$siigo.',,,';
                $siigo=$siigo.str_pad($consec,5,"0",STR_PAD_LEFT).',';
                $siigo=$siigo.$centrocos.',';
                $siigo=$siigo."509,";
                $siigo=$siigo.$nit.',';
                $siigo=$siigo.",";
                $siigo=$siigo.$descripcion.',';
                $siigo=$siigo.",";
                $siigo=$siigo."N,,,,,,";                
                $siigo=$siigo.str_replace(',','-',$tipdoc).',';
                $siigo=$siigo.$nume_fac.',';
                $siigo=$siigo."1,";
                $siigo=$siigo.substr($fcie_fac,0,4).',';
                $siigo=$siigo.substr($fcie_fac,4,2).',';
                $siigo=$siigo.substr($fcie_fac,6,2).',';
                $siigo=$siigo."\r\n";
                //echo "<br>".$siigo;
                $debito=$debito+$valor;
                //echo "<br>".$debito;
                //echo "<br>".$valor;
            }			
            if($valor>$valormayor){
                $valormayor=$valor;
                $cuentamay=$cuenta;                
            }
            if(empty($cuenta)){
                echo "<tr>";
                echo "<td class='Td2' align='left' bgcolor='$color'>$row[nume_fac]</td>";
                echo "<td class='Td2' align='left' bgcolor='$color'>La cuenta est vacia</td>";
                echo "<td class='Td2' align='left' bgcolor='$color'>$desc_dfa</td>";
                echo "</tr>";
                $error=1;
            }
            $consec=$consec+1;
            //echo "<br>C ".$cuenta;
        }
        // Aqui finalizo el registro de los detalles (naturaleza C
        //Aqui hago el registro del valor neto facturado
        $descripcion="SERVICIOS MES ".substr($row[fcie_fac],5,2)." DE ".substr($row[fcie_fac],0,4);
        $descripcion=str_pad($descripcion,50,' ',STR_PAD_RIGHT);
        $siigo=$siigo.$tipdoc.',';
        $siigo=$siigo.$nume_fac.',';
        if($row[tipo_fac]=='2'){
            $siigo=$siigo.str_pad($row[ccon_ctr],10,"0",STR_PAD_RIGHT).',';            
        }
        else{
            $siigo=$siigo.str_pad($ctacaja,10,"0",STR_PAD_RIGHT).',';}
        $siigo=$siigo."D,";
        //$siigo=$siigo.str_pad($row[vnet_fac],13,'0',STR_PAD_LEFT)."00".',';
        $siigo=$siigo.$row[vnet_fac].',';
        $siigo=$siigo.substr($fcie_fac,0,4).',';
        $siigo=$siigo.substr($fcie_fac,4,2).',';
        $siigo=$siigo.substr($fcie_fac,6,2).',';
        $siigo=$siigo.',,,';
        $siigo=$siigo.str_pad($consec,5,"0",STR_PAD_LEFT).',';
        $siigo=$siigo.$centrocos.',';
        $siigo=$siigo."509,";
        $siigo=$siigo.$nit.',';
        $siigo=$siigo.",";
        $siigo=$siigo.$descripcion.',';
        $siigo=$siigo.",";
        $siigo=$siigo."N,,,,,,";
        $siigo=$siigo.str_replace(',','-',$tipdoc).',';
        $siigo=$siigo.$nume_fac.',';
        $siigo=$siigo."1,";
        $siigo=$siigo.substr($fcie_fac,0,4).',';
        $siigo=$siigo.substr($fcie_fac,4,2).',';
        $siigo=$siigo.substr($fcie_fac,6,2).',';
        $siigo=$siigo."\r\n";
        $credito=$credito+$row[vnet_fac];
        if(empty($row[ccon_ctr])){
            echo "<tr>";
            echo "<td class='Td2' align='left' bgcolor='$color'>$row[nume_fac]</td>";
            echo "<td class='Td2' align='left' bgcolor='$color'>La cuenta est vacia</td>";
            echo "<td class='Td2' align='left' bgcolor='$color'>La entidad no tiene creada la cuenta</td>";
            echo "</tr>";
            $error=1;
        }        
        $consec=$consec+1;        
        //Aqui hago el registro del descuento
        if($descuento<>0){
            $descripcion="SERVICIOS MES ".substr($row[fcie_fac],5,2)." DE ".substr($row[fcie_fac],0,4);
            $descripcion=str_pad($descripcion,50,' ',STR_PAD_RIGHT);
            $siigo=$siigo.$tipdoc.',';
            $siigo=$siigo.$nume_fac.',';
            $siigo=$siigo.str_pad($row[cuen_con],10,"0",STR_PAD_RIGHT).',';
            $siigo=$siigo."D,";
            //$siigo=$siigo.str_pad($descuento,13,'0',STR_PAD_LEFT)."00".',';
            $siigo=$siigo.$descuento.',';
            $siigo=$siigo.substr($fcie_fac,0,4).',';
            $siigo=$siigo.substr($fcie_fac,4,2).',';
            $siigo=$siigo.substr($fcie_fac,6,2).',';
            $siigo=$siigo.',,,';
            $siigo=$siigo.str_pad($consec,5,"0",STR_PAD_LEFT).',';
            $siigo=$siigo.$centrocos.',';
            $siigo=$siigo."509,";
            $siigo=$siigo.$nit.',';
            $siigo=$siigo.",";
            $siigo=$siigo.$descripcion.',';
            $siigo=$siigo.",";
            $siigo=$siigo."N,,,,,,";
            $siigo=$siigo.str_replace(',','-',$tipdoc).',';
            $siigo=$siigo.$nume_fac.',';
            $siigo=$siigo."1,";
            $siigo=$siigo.substr($fcie_fac,0,4).',';
            $siigo=$siigo.substr($fcie_fac,4,2).',';
            $siigo=$siigo.substr($fcie_fac,6,2).',';
            $siigo=$siigo."\r\n";
            $consec=$consec+1;
            $credito=$credito+$descuento;
        }
        if($row[vcop_fac]<>0){
            $descripcion="SERVICIOS MES ".substr($row[fcie_fac],5,2)." DE ".substr($row[fcie_fac],0,4);
            $descripcion=str_pad($descripcion,50,' ',STR_PAD_RIGHT);
            $siigo=$siigo.$tipdoc.',';            
            $siigo=$siigo.$nume_fac.',';
            $siigo=$siigo.str_pad($cuentamay,10,"0",STR_PAD_RIGHT).',';
            $siigo=$siigo."D,";
            //$siigo=$siigo.str_pad($row[vcop_fac],13,'0',STR_PAD_LEFT)."00".',';
            $siigo=$siigo.$row[vcop_fac].',';
            $siigo=$siigo.substr($fcie_fac,0,4).',';
            $siigo=$siigo.substr($fcie_fac,4,2).',';
            $siigo=$siigo.substr($fcie_fac,6,2).',';
            $siigo=$siigo.',,,';
            $siigo=$siigo.str_pad($consec,5,"0",STR_PAD_LEFT).',';
            $siigo=$siigo.$centrocos.',';
            $siigo=$siigo."509,";
            $siigo=$siigo.$nit.',';
            $siigo=$siigo.",";
            $siigo=$siigo.$descripcion.',';
            $siigo=$siigo.",";
            $siigo=$siigo."N,,,,,,";
            $siigo=$siigo.str_replace(',','-',$tipdoc).',';
            $siigo=$siigo.$nume_fac.',';
            $siigo=$siigo."1,";
            $siigo=$siigo.substr($fcie_fac,0,4).',';
            $siigo=$siigo.substr($fcie_fac,4,2).',';
            $siigo=$siigo.substr($fcie_fac,6,2).',';
            $siigo=$siigo."\r\n";
            $consec=$consec+1;
            $credito=$credito+$row[vcop_fac];
        }
        if($row[cmod_fac]<>0){
            $descripcion="SERVICIOS MES ".substr($row[fcie_fac],5,2)." DE ".substr($row[fcie_fac],0,4);
            $descripcion=str_pad($descripcion,50,' ',STR_PAD_RIGHT);
            $siigo=$siigo.$tipdoc.',';
            $siigo=$siigo.$nume_fac.',';
            $siigo=$siigo.str_pad($cuentamay,10,"0",STR_PAD_RIGHT).',';
            $siigo=$siigo."D,";
            //$siigo=$siigo.str_pad($row[cmod_fac],13,'0',STR_PAD_LEFT)."00".',';
            $siigo=$siigo.$row[cmod_fac].',';
            $siigo=$siigo.substr($fcie_fac,0,4).',';
            $siigo=$siigo.substr($fcie_fac,4,2).',';
            $siigo=$siigo.substr($fcie_fac,6,2).',';
            $siigo=$siigo.',,,';
            $siigo=$siigo.str_pad($consec,5,"0",STR_PAD_LEFT).',';
            $siigo=$siigo.$centrocos.',';
            $siigo=$siigo."509,";
            $siigo=$siigo.$nit.',';
            $siigo=$siigo.",";
            $siigo=$siigo.$descripcion.',';
            $siigo=$siigo.",";
            $siigo=$siigo."N,,,,,,";
            $siigo=$siigo.str_replace(',','-',$tipdoc).',';
            $siigo=$siigo.$nume_fac.',';
            $siigo=$siigo."1,";
            $siigo=$siigo.substr($fcie_fac,0,4).',';
            $siigo=$siigo.substr($fcie_fac,4,2).',';
            $siigo=$siigo.substr($fcie_fac,6,2).',';
            $siigo=$siigo."\r\n";
            $consec=$consec+1;
            $credito=$credito+$row[cmod_fac];
        }
        if(($debito-$credito)<>0){
            echo "<tr>";
            echo "<td class='Td2' align='left' bgcolor='$color'>$row[nume_fac]</td>";
            echo "<td class='Td2' align='left' bgcolor='$color'>Los crditos y los debitos no cuadran</td>";
            echo "<td class='Td2' align='left' bgcolor='$color'>$debito-$credito</td>";
            echo "</tr>";
        }
    }
    echo "</table>";
    mysql_free_result($consultadet);
    //if($error==0){
       $scarpeta=""; //carpeta donde guardar el archivo. 
      //debe tener permisos 775 por lo menos 
      $sfile="siigofac1.csv"; //ruta del archivo a generar 
      $fp=fopen($sfile,"w"); 
      fwrite($fp,$siigo); 
      fclose($fp); 
      echo "<br><table class='Tbl0' border='0'>";
      echo "<td class='Td0' align='right'><a href='".$sfile."'><img width=20 height=20 src='icons/feed_disk.png' alt='Generar Archivo' border=0></a></td>";
      echo "<td class='Td0' align='left'><a href='".$sfile."'><b>Guardar Archivo de Facturacin</a></td>";
      echo "</table>";
    //}
  }
  else{
      echo "<center>";
      echo "<p class=Msg>No existen registros para esta busqueda</p>";
      echo "</center>";
  }
echo "<input type='hidden' name='cont' value='$cont'>";
echo "<input type='hidden' name='relacion' value='$relacion'>";
mysql_free_result($consultaemp);
mysql_free_result($consulta);
mysql_close();

function ceros($largo,$variable)
{
	$tamaño=$largo-strlen($variable);
	$cadena='';
	for($k=0;$k<$tamaño;$k++)
	{
		$cadena=$cadena.'0';
	}
	$cadena=$cadena.$variable;
	return $cadena;
}

?>
</form>
</body>
</html>
