<?
session_register('Garea'); 
session_register('codapli');
session_register('gauditor');
$Garea=$area;
$gauditor=$auditor;

?>
<html>

<head>
<title>FONDO</title>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"/>
<meta http-equiv="Content-Script-Type" content="text/javascript"/>
<meta name="Generator" content="Corel PHOTO-PAINT 12.0"/>

<Script Language="JavaScript">
function load() {
texto=form1.formad.value
window.open("index1.php","workFrame")
var load = window.open(texto,"mainFrame");
window.close(); 
}
</Script>
  
  </head>
<?
 function getRealIP()
{
   
   if( $_SERVER['HTTP_X_FORWARDED_FOR'] != '' )
   {
      $client_ip =
         ( !empty($_SERVER['REMOTE_ADDR']) ) ?
            $_SERVER['REMOTE_ADDR']
            :
            ( ( !empty($_ENV['REMOTE_ADDR']) ) ?
               $_ENV['REMOTE_ADDR']
               :
               "unknown" );
   
      // los proxys van añadiendo al final de esta cabecera
      // las direcciones ip que van "ocultando". Para localizar la ip real
      // del usuario se comienza a mirar por el principio hasta encontrar
      // una dirección ip que no sea del rango privado. En caso de no
      // encontrarse ninguna se toma como valor el REMOTE_ADDR
   
      $entries = split('[, ]', $_SERVER['HTTP_X_FORWARDED_FOR']);
   
      reset($entries);
      while (list(, $entry) = each($entries))
      {
         $entry = trim($entry);
         if ( preg_match("/^([0-9]+\.[0-9]+\.[0-9]+\.[0-9]+)/", $entry, $ip_list) )
         {
            // http://www.faqs.org/rfcs/rfc1918.html
            $private_ip = array(
                  '/^0\./',
                  '/^127\.0\.0\.1/',
                  '/^192\.168\..*/',
                  '/^172\.((1[6-9])|(2[0-9])|(3[0-1]))\..*/',
                  '/^10\..*/');
   
            $found_ip = preg_replace($private_ip, $client_ip, $ip_list[1]);
   
            if ($client_ip != $found_ip)
            {
               $client_ip = $found_ip;
               break;
            }
         }		
      }
   }
   else
   {
      $client_ip =
         ( !empty($_SERVER['REMOTE_ADDR']) ) ?
            $_SERVER['REMOTE_ADDR']
            :
            ( ( !empty($_ENV['REMOTE_ADDR']) ) ?
               $_ENV['REMOTE_ADDR']
               :
               "unknown" );
   }
   
   return $client_ip;
}
$ip=getRealIP();


$cadena = $ip;
$tok = strtok ($cadena,".");
$n=0;
while ($tok) 
{	
	$tok = strtok (".");
	$vec[$n]=$tok;
	$n++;	
}
$rango=$vec[1];

 
 //var load = window.open('index0.php');
//include ('libreria/php/conexion.php');
echo "<font size=1>$ip</font>";


echo "<form name=form1 METHOD=POST ACTION=index1.php target=workFrame>";

/*
echo "var: $destino";
echo $clave;
echo $usuario;
echo $ip;*/
//include ('/Inetpub/wwwroot/intranet/Libreria/Php/conexiones_g.php');

//echo "var: $destino";
$codapli=$destino;
include ('Libreria/Php/conexiones_g.php');
base_general();
$cla=md5($clave);
$pas=substr($cla,0,12);
$ssql = "SELECT cut.ide_usua, cut.nomb_usua, cut.login_usua, cut.pass_usua, aplicacion.nomb_apli, aplicacion.cod_apli 
FROM cut INNER JOIN aplicacion ON cut.ide_usua = aplicacion.id_usu 
where (cut.login_usua='$usuario') and  (cut.pass_usua='$pas') and (aplicacion.cod_apli='$destino') "; 
ECHO $ssql;
$rs = mysql_query($ssql); 
//echo mysql_num_rows($rs);
if (mysql_num_rows($rs)!=0){ 
	while ($row=mysql_fetch_array($rs))
	{
		$v1=$row["ide_usua"];
		$v2=$row["nomb_usua"];
		$v3=$row["login_usua"];
		$v4=$row["pass_usua"];
		$v5=$row["nomb_apli"];
		$us_valido="OK";
	}
	$fecha=date("Y-m-d");
	$hora=date("H-i");
	base_proinsalud_1();
	mysql_query("insert into seguimiento_acceso (usua_seg,nomusua_seg, apli_seg,nomapli_seg, area_seg, ip_seg, fech_seg, hora_seg) 
	values ('$v1','$v2','$destino','$v5','$area','$ip','$fecha','$hora')");
	base_general();
 echo $destino;
  if($us_valido="OK")
  {
	//$sql_insusu = "INSERT INTO usuarios(usuarios.nom_usu,usuarios.pas_usu) VALUES('$usuario', '$clave')";
	//$res_insusu = mysql_query($sql_insusu);
  }

  if  ($destino=='07' ){
 
		if ($us_valido=="OK"){ 
    //    $dir="consulta/inicio.php?id=$v1";
		$dir="consultav3/inicio.php?id=$v1";
		echo "<input type=text name=formad value='$dir'>";
		echo"<body  bgcolor=#E6E8FA onload=javascript:load() >";
  }
  }
  
  
  if  ($destino=='17' ){
    if ($us_valido=="OK"){ 
	$dir="uci/inicio.php?id=$v1&areasel=$area";
	echo "<input type=text name=formad value='$dir'>";
   	echo"<body  bgcolor=#E6E8FA onload=javascript:load() >";
  }
  }

if  ($destino=='18' ){
    if ($us_valido=="OK"){ 
	$dir="admision/inicio.php?id=$v1";
	echo "<input type=text name=formad value='$dir'>";
   	echo"<body  bgcolor=#E6E8FA onload=javascript:load() >";
  }
  }
  

  
  	 if  ($destino=='03' ){
   if ($us_valido=="OK"){  
 $dir="derechos/inicio.php?id=$v1";
		echo "<input type=text name=formad value='$dir'>";
   	echo"<body  bgcolor=#E6E8FA onload=javascript:load() >";
           }
  }
  
  
  
  
  if  ($destino=='19' )
	{
		if ($us_valido=="OK")
		{
			
			if ($v1=='12991944' || $v1=='59707704')	
			{				
				$dir="formula/inicio.php?id=$v1";	
				//$dir="http://192.168.4.3:8080/intraweb/intranet/formula/inicio.php?id=$v1";		
				echo "<input type=text name=formad value='$dir'>";	
			
			}
			else
			
			{			
				$dir="formula/inicio.php?id=$v1";	
				//$dir="formula/inicio.php?id=$v1";			
				echo "<input type=text name=formad value='$dir'>";			
			}			
		}
	}
	if  ($destino=='21')
	{		
		if ($v1=='12991944')
		{
			$dir="admin_insumos/index.php?id=$v1";
			//$dir="admin_insumos/index.php?id=$v1";			
			echo "<input type=text name=formad value='$dir'>";
		
		}	
		else		
		{
			$dir="admin_insumos/index.php?id=$v1";
			//$dir="admin_insumos/index.php?id=$v1";
			echo "<input type=text name=formad value='$dir'>";			
		}	
		
		echo"<body  bgcolor=#E6E8FA onload=javascript:load() >";
	}
  
//$ssql2 = "SELECT id_usu, ip_usu   FROM ipus where (id_usu='$v1') and  (ip_usu='$ip') "; 
$ssql2 = "SELECT id_usu, ip_usu   FROM ipus where (id_usu='$v1')"; 
//echo $ssql2;
//$rs2 = mysql_query($ssql2);
//  if (mysql_num_rows($rs2)!=0){ 
        
        if  ($destino=='01' ){
        $dir="citasv2/inicio.php?id=$v1";
		echo "<input type=hidden name=formad value='$dir'>";

           }
	
	   if  ($destino=='02' ){
        $dir="ryc/inicio.php?id=$v1";
		echo "<input type=text name=formad value='$dir'>";

           }

	if  ($destino=='04' ){
        $dir="urgencias/inicio.php?id=$v1";
		echo "<input type=text name=formad value='$dir'>";

           }
	if  ($destino=='05' ){
        $dir="historias/inicio.php?id=$v1";
		echo "<input type=text name=formad value='$dir'>";

           }
	
	
	if  ($destino=='06' ){
        $dir="cut/inicio.php?id=$v1";
		echo "<input type=text name=formad value='$dir'>";

           }
		   

	if  ($destino=='09' ){
        $dir="labc/inicio.php?id=$v1";
		echo "<input type=text name=formad value='$dir'>";

           }
		   
    if  ($destino=='48' ){
        $dir="rips_municipio/inicio.php?id=$v1";
		echo "<input type=text name=formad value='$dir'>";

           }
	
	
	if  ($destino=='10' ){
        $dir="conlab/inicio.php?id=$v1";
		echo "<input type=text name=formad value='$dir'>";

           }

	if  ($destino=='12' ){
        $dir="referencia/inicio.php?id=$v1";
		echo "<input type=text name=formad value='$dir'>";

           }

	if  ($destino=='13' ){
        $dir="ordenes/inicio.php?id=$v1";
		echo "<input type=text name=formad value='$dir'>";

           }

	   
		   
		if  ($destino=='14' ){
        $dir="medicos2/index.php?id=$v1";
		echo "<input type=text name=formad value='$dir'>";

           }
	
	
		if  ($destino=='15' ){
        $dir="radica/inicio.php?id=$v1";
		echo "<input type=text name=formad value='$dir'>";

           }
	
	
		
		if  ($destino=='20' ){
        $dir="autorizacion/inicio.php?id=$v1";
		echo "<input type=text name=formad value='$dir'>";

           }
		
		if  ($destino=='22' )
		{
			
				$dir="uci/crear_insumo.php?id=$v1";
				echo "<input type=text name=formad value='$dir'>";
			

        }	
	
       if  ($destino=='60' ){
        //$dir="hcmp/inicio.php?id=$v1";
		//$dir="hcmpv2/inicio.php?id=$v1";
		$dir="hcmpv2.1/inicio.php?id=$v1&Garea=$area";		
		echo "<input type=text name=formad value='$dir'>";

           }
		if  ($destino=='24' ){
        $dir="modiformula/index.php?id=$v1";
		echo "<input type=text name=formad value='$dir'>";

           }
		if  ($destino=='25' ){
        $dir="imagenologia/inicio.php?id=$v1";
		echo "<input type=text name=formad value='$dir'>";

           }
		   
		if  ($destino=='26' ){
        $dir="banco_sangre/index.php?id=$v1";
		echo "<input type=text name=formad value='$dir'>";

           }
	
        if  ($destino=='27' ){
        $dir="ucicop/inicio.php?id=$v1&dirip=$rango";
		//$dir="ucicop/index.php?id=$v1";
		echo "<input type=text name=formad value='$dir'>";
		}
		
		 if  ($destino=='28' ){
        $dir="informinis/inicio.php?id=$v1";
		echo "<input type=text name=formad value='$dir'>";

           }
		   
		  if  ($destino=='29' ){
        $dir="citasv2cop/inicio.php?id=$v1";
		echo "<input type=text name=formad value='$dir'>";

           }
		if  ($destino=='30' ){
        $dir="actualiza/index.php?id=$v1";
		echo "<input type=text name=formad value='$dir'>";

           }
		if  ($destino=='31' ){
        $dir="triage/inicio.php?id=$v1";
		echo "<input type=text name=formad value='$dir'>";

           }
		   
		if  ($destino=='32' ){
        $dir="quirofano/inicio.php?id=$v1";
		echo "<input type=text name=formad value='$dir'>";

           }
		
		if  ($destino=='33' ){
        $dir="rips_consulta/inicio.php?id=$v1";
		echo "<input type=text name=formad value='$dir'>";

           }

		if  ($destino=='34' ){
        $dir="medicamentos/index.php?id=$v1";
		echo "<input type=text name=formad value='$dir'>";

           }
		
		if  ($destino=='35' ){
        $dir="facturacion/index.php?id=$v1";
		echo "<input type=text name=formad value='$dir'>";
        }
		
		
		if  ($destino=='36' ){
        $dir="personal/inicio.php?id=$v1";
		echo "<input type=text name=formad value='$dir'>";
        }
		
		if  ($destino=='37' ){
        $dir="labc2/inicio.php?id=$v1";
		echo "<input type=text name=formad value='$dir'>";
        }
		if  ($destino=='38' ){
        $dir="nuevahc/inicio.php?id=$v1&dirip=$rango";
		echo "<input type=text name=formad value='$dir'>";
        }
		if  ($destino=='39' ){
        $dir="cronicos/inicio.php?id=$v1";
		echo "<input type=text name=formad value='$dir'>";
        }


		if  ($destino=='41' ){		        
		$dir="aiepi/index.php?id=$v1&Garea=$area";
		echo "<input type=text name=formad value='$dir'>";
        }
		
		if  ($destino=='45' ){
			session_start(true);
			$_SESSION["Gcod_medico"]=$v1;
			//$dir="mod_odontologia/index.php?ide_admin=$v1";
			//$dir="mod_odontologia/index.php?ide_admin=".$_SESSION['Gcod_medico']."&sid=".session_id();
			//$dir="mod_odontologia/test.php?ide_admin=".$_SESSION['Gcod_medico']."&sid=".session_id();
			$dir="mod_odontologia/";
			echo "<input type=text name=formad value='$dir'>";			
        }
		
		if  ($destino=='47' ){		
        $dir="rips/inicio.php?id=$v1";
		echo "<input type=text name=formad value='$dir'>";
        }
		if  ($destino=='49' ){
        $dir="Radica_v2/inicio.php?id=$v1";
		echo "<input type=text name=formad value='$dir'>";

		}
		//50 PROMOCION Y PREVENCION
		if  ($destino=='50' ){
        $dir="pyp/index.php?id=$v1&areapp=$Garea";
		echo "<input type=text name=formad value='$dir'>";
        }
		if  ($destino=='51' ){		
        $dir="salud_ocupacional/inicio.php?id=$v1";
		echo "<input type=text name=formad value='$dir'>";
        }
		if  ($destino=='44' ){		
        $dir="nuevocitas/inicio.php?id=$v1";
		echo "<input type=text name=formad value='$dir'>";
        }
		if  ($destino=='52' ||  $destino=='53'){
        $dir="consulta/inicio.php?id=$v1";
		//$dir="ucicop/index.php?id=$v1";
		echo "<input type=text name=formad value='$dir'>";
		}
		if  ($destino=='54' ){
			$dir="referenciav2/inicio.php?id=$v1";
			echo "<input type=text name=formad value='$dir'>";
        }
		if  ($destino=='55' ){
			$dir="ordenesv2/inicio.php?id=$v1";
			echo "<input type=text name=formad value='$dir'>";
        }
		if  ($destino=='56' ){
			$dir="autorizacionv2/inicio.php?id=$v1";
			echo "<input type=text name=formad value='$dir'>";
        }
		if  ($destino=='57' ){
			$dir="modiformula/index.php?id=$v1";
			echo "<input type=text name=formad value='$dir'>";
        }
		if  ($destino=='58' ){
			$dir="terapia/index.php?id=$v1&area=$area";			
			echo "<input type=text name=formad value='$dir'>";
        }		
		if  ($destino=='59' ){
        $dir="consulta_ambulatoria/inicio.php?id=$v1&dirip=$rango&Garea=$Garea";
		//$dir="ucicop/index.php?id=$v1";
		echo "<input type=text name=formad value='$dir'>";
		}
		if  ($destino=='64' ){
        $dir="pcronicos/inicio.php?id=$v1&dirip=$rango";
		//$dir="ucicop/index.php?id=$v1";
		echo "<input type=text name=formad value='$dir'>";
		}
		if  ($destino=='65' ){
        $dir="costo_unitario/index.php?id=$v1";
		//$dir="ucicop/index.php?id=$v1";
		echo "<input type=text name=formad value='$dir'>";
		}
		
		if  ($destino=='67' ){
        $dir="cuentas/inicio.php?id=$v1";
		//$dir="ucicop/index.php?id=$v1";
		echo "<input type=text name=formad value='$dir'>";
		}
		
		if  ($destino=='71' ){
        $dir="depura_historia/index.php?id=$v1";
		//$dir="ucicop/index.php?id=$v1";
		echo "<input type=text name=formad value='$dir'>";
		}
		
		if  ($destino=='72' ){
        $dir="genreportes/index.php?id=$v1";
		//$dir="ucicop/index.php?id=$v1";
		echo "<input type=text name=formad value='$dir'>";
		}
		echo"<body  bgcolor=#E6E8FA onload=javascript:load() >";
		if  ($destino=='73' ){
        $dir="rips_web/inicio.php?id=$v1";		
		echo "<input type=text name=formad value='$dir'>";
		}
		echo"<body  bgcolor=#E6E8FA onload=javascript:load() >";
		
		if  ($destino=='74' ){
        $dir="procedimientos/inicio.php?id=$v1&Garea=$area";
		//$dir="ucicop/index.php?id=$v1";
		echo "<input type=text name=formad value='$dir'>";
        }
        if($destino=='75'){
            $dir="imagenologia_version2/inicio.php?id=$v1";
            echo "<input type=text name=formad value='$dir'>";
        }
		
		 if($destino=='77'){
            $dir="audiologia/inicio.php?id=$v1";
            echo "<input type=text name=formad value='$dir'>";
        }
		if($destino=='80'){
            $dir="covid/inicio.php?id=$v1";
            echo "<input type=text name=formad value='$dir'>";
        }
		
		if($destino=='83'){
            $dir="epsresolucion202/index.php?id=$v1";
            echo "<input type=text name=formad value='$dir'>";
        }
		
		echo"<body  bgcolor=#E6E8FA onload=javascript:load() >";
//	}
//  else{
//   echo "<body>";
 
//  }
  
 }

else  
  {
  echo "<body>";

  
  }

?>

<p>
<p>
<p>
<br>
<br>
<br>
<center>
<table border="0" cellspacing="0" cellpadding="0" width="763" height="360">
  <tr align="left" valign="top">
    <td rowspan="1" colspan="1" height="1" width="1"></td>
    <td rowspan="1" colspan="1" height="1" width="456"></td>
    <td rowspan="1" colspan="1" height="1" width="113"></td>
    <td rowspan="1" colspan="1" height="1" width="181"></td>
    <td rowspan="1" colspan="1" height="1" width="12"></td>
  </tr>
  <tr align="left" valign="top">
    <td rowspan="1" colspan="1" width="1" height="133"></td>
    <td rowspan="8" colspan="1" width="456" height="359"><img border="0" width="456" height="359" src="Imagenes/FONDOR1C1.jpg" alt=""></td>
    <td rowspan="1" colspan="2" width="294" height="133"><img border="0" width="294" height="133" src="Imagenes/FONDOR1C2.jpg" alt=""></td>
    <td rowspan="8" colspan="1" width="12" height="359"><img border="0" width="12" height="359" src="Imagenes/FONDOR1C4.jpg" alt=""></td>
  </tr>
  <tr align="left" valign="top">
    <td rowspan="1" colspan="1" width="1" height="29"></td>
    <td rowspan="1" colspan="1" width="113" height="29"><img border="0" width="113" height="29" src="Imagenes/FONDOR2C2a.jpg" alt=""></td>
    <td rowspan="1" colspan="1" width="181" height="29"><img border="0" width="181" height="29" src="Imagenes/FONDOR2C3a.jpg" alt=""></td>
  </tr>
  <tr align="left" valign="top">
    <td rowspan="1" colspan="1" width="1" height="29"></td>
    <td rowspan="1" colspan="1" width="113" height="29"><img border="0" width="113" height="29" src="Imagenes/FONDOR3C2a.jpg" alt=""></td>
    <td rowspan="1" colspan="1" width="181" height="29"><img border="0" width="181" height="29" src="Imagenes/FONDOR3C3a.jpg" alt=""></td>
  </tr>
  <tr align="left" valign="top">
    <td rowspan="1" colspan="1" width="1" height="30"></td>
    <td rowspan="1" colspan="1" width="113" height="30"><img border="0" width="113" height="30" src="Imagenes/FONDOR4C2a.jpg" alt=""></td>
    <td rowspan="1" colspan="1" width="181" height="30"><img border="0" width="181" height="30" src="Imagenes/FONDOR4C3a.jpg" alt=""></td>
  </tr>
  <tr align="left" valign="top">
    <td rowspan="1" colspan="1" width="1" height="32"></td>
    <td rowspan="1" colspan="1" width="113" height="32" ><img border="0" width="113" height="32" src="Imagenes/FONDOR5C2a.jpg" alt=""></td>
    <td rowspan="1" colspan="1" width="181" height="32"><img border="0" width="181" height="32" src="Imagenes/FONDOR5C3a.jpg" alt=""></td>
  </tr>
  <tr align="left" valign="top">
    <td rowspan="1" colspan="1" width="1" height="31"></td>
    <td rowspan="1" colspan="1" width="113" height="31" background="Imagenes/FONDOR6C2a.jpg"></td>
    <td rowspan="1" colspan="1" width="181" height="31"background="Imagenes/FONDOR6C3a.jpg"><input type=submit name="bt1" value="Aceptar" ></td>
  </tr>
  <tr align="left" valign="top">
    <td rowspan="1" colspan="1" width="1" height="31"></td>
    <td rowspan="1" colspan="1" width="113" height="31"><img border="0" width="113" height="31" src="Imagenes/FONDOR7C2a.jpg" alt=""></td>
    <td rowspan="1" colspan="1" width="181" height="31"><img border="0" width="181" height="31" src="Imagenes/FONDOR7C3a.jpg" alt=""></td>
  </tr>
  <tr align="left" valign="top">
    <td rowspan="1" colspan="1" width="1" height="44"></td>
    <td rowspan="1" colspan="2" width="294" height="44"><img border="0" width="294" height="44" src="Imagenes/FONDOR8C2.jpg" alt=""></td>
  </tr>
</table>
</center>
</body>

</html>
