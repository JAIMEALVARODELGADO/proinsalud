<?
session_start();
//echo "<br>".$_SESSION[pa_idcita];
//echo "<br>".$_SESSION[pa_area];
/*session_register('Garea');
session_register('iden_mat');
session_register('idcita');
session_register('dxpp_a');
session_register('desc_a');
session_register('dayu_con');*/
//$dxpp_a="";
//$desc_a="";
switch($controlviene){
  case 1:
    $archivo="tmp/ex_comp".$_SESSION[pa_idcita].".txt";
    $fp = fopen($archivo, 'w+');
    $cadena="hemoglo_exc|$hemoglo_exc\n";
    fwrite($fp, $cadena);
    $cadena="glicemi_exc|$glicemi_exc\n";
    fwrite($fp, $cadena);
    $cadena="hemocla_exc|$hemocla_exc\n";
    fwrite($fp, $cadena);
    $cadena="hematoc_exc|$hematoc_exc\n";
    fwrite($fp, $cadena);
    $cadena="bun_exc|$bun_exc\n";
    fwrite($fp, $cadena);
    $cadena="protein_exc|$protein_exc\n";
    fwrite($fp, $cadena);
    $cadena="plaquet_exc|$plaquet_exc\n";
    fwrite($fp, $cadena);
    $cadena="creatin_exc|$creatin_exc\n";
    fwrite($fp, $cadena);
    $cadena="albumin_exc|$albumin_exc\n";
    fwrite($fp, $cadena);
    $cadena="tp_exc|$tp_exc\n";
    fwrite($fp, $cadena);
    $cadena="sodio_exc|$sodio_exc\n";
    fwrite($fp, $cadena);
    $cadena="bilitot_exc|$bilitot_exc\n";
    fwrite($fp, $cadena);
    $cadena="tpt_exc|$tpt_exc\n";
    fwrite($fp, $cadena);
    $cadena="potasio_exc|$potasio_exc\n";
    fwrite($fp, $cadena);
    $cadena="bilidir_exc|$bilidir_exc\n";
    fwrite($fp, $cadena);
    $cadena="tiposan_exc|$tiposan_exc\n";
    fwrite($fp, $cadena);
    $cadena="calcio_exc|$calcio_exc\n";
    fwrite($fp, $cadena);
    $cadena="vdrl_exc|$vdrl_exc\n";
    fwrite($fp, $cadena);
    $cadena="coagula_exc|$coagula_exc\n";
    fwrite($fp, $cadena);
    $cadena="leucoci_exc|$leucoci_exc\n";
    fwrite($fp, $cadena);
    $cadena="prembar_exc|$prembar_exc\n";
    fwrite($fp, $cadena);
    $cadena="rxfecha_exc|$rxfecha_exc\n";
    fwrite($fp, $cadena);
    $cadena="rxdescrip_exc|$rxdescrip_exc\n";
    fwrite($fp, $cadena);
    $cadena="ecgfecha_exc|$ecgfecha_exc\n";
    fwrite($fp, $cadena);
    $cadena="ecgdescrip_exc|$ecgdescrip_exc\n";
    fwrite($fp, $cadena);
    $cadena="ecofecha_exc|$ecofecha_exc\n";
    fwrite($fp, $cadena);
    $cadena="ecodescrip_exc|$ecodescrip_exc\n";
    fwrite($fp, $cadena);
    $cadena="otrofecha_exc|$otrofecha_exc\n";
    fwrite($fp, $cadena);
    $cadena="otrodescrip_exc|$otrodescrip_exc\n";
    fwrite($fp, $cadena);
    fclose($fp);
    break;
  case 2:
    $archivo="tmp/ex_fisi".$_SESSION[pa_idcita].".txt";
    $fp = fopen($archivo, 'w+');
    $cadena="peso_exf|$peso_exf\n";
    fwrite($fp, $cadena);
    $cadena="talla_exf|$talla_exf\n";
    fwrite($fp, $cadena);
    $cadena="tempera_exf|$tempera_exf\n";
    fwrite($fp, $cadena);
    $cadena="saturo2_exf|$saturo2_exf\n";
    fwrite($fp, $cadena);
    $cadena="presion_exf|$presion_exf\n";
    fwrite($fp, $cadena);
    $cadena="frecard_exf|$frecard_exf\n";
    fwrite($fp, $cadena);
    $cadena="freresp_exf|$freresp_exf\n";
    fwrite($fp, $cadena);
    $cadena="estado_exf|$estado_exf\n";
    fwrite($fp, $cadena);
    $cadena="snc_exf|$snc_exf\n";
    fwrite($fp, $cadena);
    $cadena="dentpro_exf|$dentpro_exf\n";
    fwrite($fp, $cadena);
    $cadena="apertur_exf|$apertur_exf\n";
    fwrite($fp, $cadena);
    $cadena="estadodien_exf|$estadodien_exf\n";
    fwrite($fp, $cadena);
    $cadena="imallam_exf|$imallam_exf\n";
    fwrite($fp, $cadena);
    $cadena="dmentoh_exf|$dmentoh_exf\n";
    fwrite($fp, $cadena);
    $cadena="movilid_exf|$movilid_exf\n";
    fwrite($fp, $cadena);
    $cadena="anormali_exf|$anormali_exf\n";
    fwrite($fp, $cadena);
    $cadena="torax_exf|$torax_exf\n";
    fwrite($fp, $cadena);
    $cadena="pulmones_exf|$pulmones_exf\n";
    fwrite($fp, $cadena);
    $cadena="corazon_exf|$corazon_exf\n";
    fwrite($fp, $cadena);
    $cadena="abdomen_exf|$abdomen_exf\n";
    fwrite($fp, $cadena);
    $cadena="genitouri_exf|$genitouri_exf\n";
    fwrite($fp, $cadena);
    $cadena="extremi_exf|$extremi_exf\n";
    fwrite($fp, $cadena);
    $cadena="otros_exf|$otros_exf\n";
    fwrite($fp, $cadena);
    fclose($fp);
    break;
  case 3:
    $archivo="tmp/conclu".$_SESSION[pa_idcita].".txt";
    $fp = fopen($archivo, 'w+');
    $cadena="estfisico_ccl|$estfisico_ccl\n";
    fwrite($fp, $cadena);
    $cadena="clafuncional_ccl|$clafuncional_ccl\n";
    fwrite($fp, $cadena);
    $cadena="aptociru_ccl|$aptociru_ccl\n";
    fwrite($fp, $cadena);
    $cadena="anestesia_ccl|$anestesia_ccl\n";
    fwrite($fp, $cadena);
    $cadena="reserva_ccl|$reserva_ccl\n";
    fwrite($fp, $cadena);
    $cadena="premedica_ccl|$premedica_ccl\n";
    fwrite($fp, $cadena);
    $cadena="tprograma_ccl|$tprograma_ccl\n";
    fwrite($fp, $cadena);
    $cadena="anotacion_ccl|$anotacion_ccl\n";
    fwrite($fp, $cadena);
    $cadena="reevaluar_ccl|$reevaluar_ccl\n";
    fwrite($fp, $cadena);
    $cadena="observa_ccl|$observa_ccl\n";
    fwrite($fp, $cadena);
    $cadena="concent_ccl|$concent_ccl\n";
    fwrite($fp, $cadena);        
    fclose($fp);
    break;
/*  case 4:
    $archivo="tmp/ge".$idcita.".txt";
    $fp = fopen($archivo, 'w+');
    $cadena="pant_ges|$pant_\n";
	fwrite($fp, $cadena);
    $cadena="fulm_ges|$fulm_\n";
	fwrite($fp, $cadena);
    $cadena="ecfu_ges|$ecfu_\n";
	fwrite($fp, $cadena);
    $cadena="ecec_ges|$ecec_\n";
	fwrite($fp, $cadena);
    $cadena="avig_ges|$avig_\n";
	fwrite($fp, $cadena);
    $cadena="dosi_ges|$dosi_\n";
	fwrite($fp, $cadena);
    $cadena="mges_ges|$mges_\n";
	fwrite($fp, $cadena);
    $cadena="apre_ges|$apre_\n";
	fwrite($fp, $cadena);
    $cadena="aemb_ges|$aemb_\n";
	fwrite($fp, $cadena);
    fclose($fp);
    break;  
  case 5:
    $dxpp_a=$diag_;
    $desc_a=$ddia_;
	$dayu_con=$dayu_;
    $archivo="tmp/ce".$idcita.".txt";
    $fp = fopen($archivo, 'w+');
    $cadena="dxpp_con|$diag_\n";
	fwrite($fp, $cadena);
    $cadena="obse_con|$obse_\n";
	fwrite($fp, $cadena);
    $cadena="iden_ayu|$cayu_\n";
	fwrite($fp, $cadena);
    $cadena="prep_ayu|$prep_\n";
	fwrite($fp, $cadena);
    fclose($fp);
    break;
  case 7:
    $dxpp_a=$diag_;
    $desc_a=$ddia_;
    $dxpp_con=$diag_;
    $desc_dia=$ddia_;
    $archivo="tmp/ce".$idcita.".txt";
    if(file_exists($archivo)){
      $fp = fopen ($archivo, "r" );
      $reg=0;
      while (( $data = fgetcsv ( $fp , 1000 , "|" )) !== FALSE ) { // Mientras hay líneas que leer...
        $reg++;
        $i = 0;
        foreach($data as $dato){
          $campo[$i]=$dato;
          $i++ ;
        }
        $$campo[0]=$campo[1];
      }
    }
	fclose($fp);
    $archivo="tmp/ce".$idcita.".txt";
    $fp = fopen($archivo, 'w+');
    $cadena="dxpp_con|$diag_\n";
	fwrite($fp, $cadena);
    $cadena="obse_con|$obse_con\n";
	fwrite($fp, $cadena);
    $cadena="iden_ayu|$iden_ayu\n";
	fwrite($fp, $cadena);
    $cadena="prep_ayu|$prep_ayu\n";
	fwrite($fp, $cadena);
    fclose($fp);
    break;	
  case 8:
	$iden_ayu=$cayu_;
	$dayu_con=$dayu_;
	if($controlva==5){
      $archivo="tmp/ad".$idcita.".txt";
      $fp = fopen($archivo, 'a');
      $cadena="cayu_con|$cayu_\n";
	  fwrite($fp, $cadena);
	  fclose($fp);
	}
    break;*/
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<link rel="stylesheet" href="css/style.css" type="text/css" />
</head>
<?
switch($controlva){
  case 1:
    echo "<body onload=window.open('preanes_cap_examen_comple.php','_self')>";
    echo "</body>";  
    break;
  case 2:
    echo "<body onload=window.open('preanes_cap_examen_fisico.php','_self')>";
    echo "</body>";
	break;
  case 3:
    echo "<body onload=window.open('preanes_cap_conclusion.php','_self')>";
    echo "</body>";	
    break;
/*  case 4:
    echo "<body onload=window.open('02enfermera_4.php','_self')>";
    echo "</body>";		
	break;
  case 5:
    echo "<body onload=window.open('02enfermera_5.php','_self')>";
    echo "</body>";		
	break;	
  case 6:
    echo "<div id='header3'>";
    echo "<div id='nav2'>";
	?>
	<br><br>
	<table class="Tbl0">
	<tr>
	<td class="Td0" align="center">La siguiente información es obligatoria</td>
	</tr>
	</table>
	<br>
	<table class="Tbl1">
	  <th class="Th0" colspan=1>Opción</th><th class="Th0" colspan=1>Sección</th><th class="Th0" colspan=1>Campo</th>
	  <?
	    //Cargo el archivo de antecedentes personales
	    $archivo="tmp/ap".$idcita.".txt";
	    if(file_exists($archivo)){
  	      $fp = fopen ($archivo, "r" );
  	      $reg=0;
  	      while (( $data = fgetcsv ( $fp , 1000 , "|" )) !== FALSE ) { // Mientras hay líneas que leer...
    	    $reg++;
    	    $i = 0;
	        foreach($data as $dato){
      	      $campo[$i]=$dato;
	          $i++ ;
	        }
	        $$campo[0]=$campo[1];
  	      }
	    }
	    fclose($fp);
		
	    //Cargo el archivo de antecedentes obstétricos
	    $archivo="tmp/ao".$idcita.".txt";
	    if(file_exists($archivo)){
  	      $fp = fopen ($archivo, "r" );
  	      $reg=0;
  	      while (( $data = fgetcsv ( $fp , 1000 , "|" )) !== FALSE ) { // Mientras hay líneas que leer...
    	    $reg++;
    	    $i = 0;
	        foreach($data as $dato){
      	      $campo[$i]=$dato;
	          $i++ ;
	        }
	        $$campo[0]=$campo[1];
  	      }
	    }
	    fclose($fp);

	    //Cargo el archivo de antecedentes familiares
	    $archivo="tmp/af".$idcita.".txt";
	    if(file_exists($archivo)){
  	      $fp = fopen ($archivo, "r" );
  	      $reg=0;
  	      while (( $data = fgetcsv ( $fp , 1000 , "|" )) !== FALSE ) { // Mientras hay líneas que leer...
    	    $reg++;
    	    $i = 0;
	        foreach($data as $dato){
      	      $campo[$i]=$dato;
	          $i++ ;
	        }
	        $$campo[0]=$campo[1];
  	      }
	    }
	    fclose($fp);

	    //Cargo el archivo de la gestación actual
	    $archivo="tmp/ge".$idcita.".txt";
	    if(file_exists($archivo)){
  	      $fp = fopen ($archivo, "r" );
  	      $reg=0;
  	      while (( $data = fgetcsv ( $fp , 1000 , "|" )) !== FALSE ) { // Mientras hay líneas que leer...
    	    $reg++;
    	    $i = 0;
	        foreach($data as $dato){
      	      $campo[$i]=$dato;
	          $i++ ;
	        }
	        $$campo[0]=$campo[1];
  	      }
	    }
	    fclose($fp);
		
		//Cargo el archivo de la consulta
	    $archivo="tmp/ce".$idcita.".txt";
	    if(file_exists($archivo)){
  	      $fp = fopen ($archivo, "r" );
  	      $reg=0;
  	      while (( $data = fgetcsv ( $fp , 1000 , "|" )) !== FALSE ) { // Mientras hay líneas que leer...
    	    $reg++;
    	    $i = 0;
	        foreach($data as $dato){
      	      $campo[$i]=$dato;
	          $i++ ;
	        }
	        $$campo[0]=$campo[1];
  	      }
		  fclose($fp);
	    }
	    
	    $error=0;
        if(empty($diab_ape)){
	      $error=1;
		  echo "<tr>";
		  echo "<td class='Td0'><a href='02enfermera_1.php'><img src='img/feed_add.png'><a></td>";
		  echo "<td class='Td0'>Antecedentes Personales</td>";
		  echo "<td class='Td0'>Diabetes</td>";
          echo "</tr>";}
        if(empty($frac_aob)){
	      $error=1;
		  echo "<tr>";
		  echo "<td class='Td0'><a href='02enfermera_2.php'><img src='img/feed_add.png'><a></td>";
		  echo "<td class='Td0'>Antecedentes Obstetricos</td>";
		  echo "<td class='Td0'>Fracaso método anticonceptivo</td>";
          echo "</tr>";}
        if(empty($fuma_aob)){
	      $error=1;
	      echo "<tr>";
		  echo "<td class='Td0'><a href='02enfermera_2.php'><img src='img/feed_add.png'><a></td>";
          echo "<td class='Td0'>Antecedentes Obstetricos</td>";
          echo "<td class='Td0'>Fuma</td>";
          echo "</tr>";}
        if(empty($pant_ges)){
  	      $error=1;
  	      echo "<tr>";
		  echo "<td class='Td0'><a href='02enfermera_4.php'><img src='img/feed_add.png'><a></td>";
	      echo "<td class='Td0'>Gestación Actual</td>";
	      echo "<td class='Td0'>Peso anterior</td>";
          echo "</tr>";}
        if(empty($fulm_ges)){
	      $error=1;
	      echo "<tr>";
		  echo "<td class='Td0'><a href='02enfermera_4.php'><img src='img/feed_add.png'><a></td>";
	      echo "<td class='Td0'>Gestación Actual</td>";
	      echo "<td class='Td0'>Fecha última mestruación</td>";
          echo "</tr>";}
	      //Conexion con la base
          include ('php/conexion.php');
	      $consulta=mysql_query("SELECT cod_cie10 FROM cie_10 WHERE cod_cie10='$dxpp_con'");
	      if(mysql_num_rows($consulta)==0){
	        $error=1;
	        echo "<tr>";
			echo "<td class='Td0'><a href='02enfermera_5.php'><img src='img/feed_add.png'><a></td>";
	        echo "<td class='Td0'>Consulta</td>";
	        echo "<td class='Td0'>Diagnóstico errado</td>";
            echo "</tr>";}
          mysql_free_result($consulta);
          mysql_close();
	  ?>
    </table>
	<?	  
	  if($error==0){
        echo "<body onload=window.open('02guardaenf.php','_self')>";
	  }
	  else{
	    echo"<center><a href='#' onclick='history.go(-1)'><img hspace=0 width=18 height=18 src='img\feed_go.png' alt='Regresar' border='0'>Regresar</a></center>";}
    echo "</div>";
    echo "</div>";
    echo "</body>";
	break;
  case 7:
    echo "<body onload=window.open('02enfer5buscadia.php','_self')>";
    break;
  case 8:
    echo "<body onload=window.open('02enfer5buscapro.php','_self')>";
    break;*/
}

//Scripts para guardar los datos
/*INSERT INTO preanes_examencomple(
iden_exc,iden_consulta,hemoglo_exc,glicemi_exc,hemocla_exc,hematoc_exc,bun_exc,protein_exc,plaquet_exc,creatin_exc,albumin_exc,tp_exc,
sodio_exc,bilitot_exc,tpt_exc,potasio_exc,bilidir_exc,tiposan_exc,calcio_exc,vdrl_exc,coagula_exc,leucoci_exc,prembar_exc,
rxfecha_exc,rxdescrip_exc,ecgfecha_exc,ecgdescrip_exc,ecofecha_exc,ecodescrip_exc,otrofecha_exc,otrodescrip_exc)
VALUES(0,'$iden_consulta','$hemoglo_exc','$glicemi_exc','$hemocla_exc','$hematoc_exc','$bun_exc','$protein_exc','$plaquet_exc','$creatin_exc','$albumin_exc','$tp_exc','$sodio_exc','$bilitot_exc','$tpt_exc','$potasio_exc','$bilidir_exc','$tiposan_exc','$calcio_exc','$vdrl_exc','$coagula_exc','$leucoci_exc','$prembar_exc','$rxfecha_exc','$rxdescrip_exc','$ecgfecha_exc','$ecgdescrip_exc','$ecofecha_exc','$ecodescrip_exc','$otrofecha_exc','$otrodescrip_exc')

INSERT INTO preanes_examenfisico(
iden_exf,iden_consulta,peso_exf,talla_exf,tempera_exf,saturo2_exf,presion_exf,frecard_exf,freresp_exf,estado_exf,snc_exf,dentpro_exf,apertur_exf,estadodien_exf,imallam_exf,dmentoh_exf,movilid_exf,anormali_exf,torax_exf,pulmones_exf,corazon_exf,abdomen_exf,genitouri_exf,extremi_exf,otros_exf)
VALUES(0,'$iden_consulta','$peso_exf','$talla_exf','$tempera_exf','$saturo2_exf','$presion_exf','$frecard_exf','$freresp_exf','$estado_exf','$snc_exf','$dentpro_exf','$apertur_exf','$estadodien_exf','$imallam_exf','$dmentoh_exf','$movilid_exf','$anormali_exf','$torax_exf','$pulmones_exf','$corazon_exf','$abdomen_exf','$genitouri_exf','$extremi_exf','$otros_exf')

        
INSERT INTO preanes_conclusion(iden_ccl,iden_consulta,estfisico_ccl,clafuncional_ccl,aptociru_ccl,anestesia_ccl,reserva_ccl,premedica_ccl,tprograma_ccl,anotacion_ccl,reevaluar_ccl,observa_ccl,concent_ccl)
VALUES(0,'$iden_consulta','$estfisico_ccl','$clafuncional_ccl','$aptociru_ccl','$anestesia_ccl','$reserva_ccl','$premedica_ccl','$tprograma_ccl','$anotacion_ccl','$reevaluar_ccl','$observa_ccl','$concent_ccl')*/
?>
</html>