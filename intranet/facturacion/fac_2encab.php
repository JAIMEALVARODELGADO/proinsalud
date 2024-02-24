<?php
session_start();
if(empty($Gidusufac)){
  ?>
  <script language='javascript'>
  alert("La sesion ha finalizado, porfavor ingrese nuevamente a la aplicación");
  window.top.close();
  </script>
  <?
}
?>
<html>
<head>
<title>PROGRAMA DE FACTURACION - PREFACTU</title>
<meta charset=utf-8>
<meta name=description content="">
<meta name=viewport content="width=device-width, initial-scale=1">
<SCRIPT LANGUAGE=JavaScript>
function activaest(cont_){    
    var comando='';
    comando="document.form1.chkestan"+cont_+".checked";
    if((eval(comando))==false){
        comando="document.form1.diasest"+cont_+".disabled=true";
        eval(comando);
    }
    else{
        comando="document.form1.diasest"+cont_+".disabled=false";
        eval(comando);
        comando="document.form1.diasest"+cont_+".focus()";
        eval(comando);
    }
}

function actcons(cod_,cont_){
var comando='';
  comando='form1.desc_con'+cont_+'.value='+cod_;
  eval(comando);
  comando='form1.codigo'+cont_+'.value='+cod_;
  eval(comando);
}

function validactr(){
form1.action='fac_2encab.php';
form1.submit();
}
function validag(conte_){
var error="",ce=0;
  if(form1.iden_ctr.value==""){error=error+"Nro de contrato\n";}
  if(form1.tipo_fac.value==""){error=error+"Tipo de factura\n";}
  if(form1.feci_fac.value==""){error=error+"Fecha inicial\n";}
  if(form1.fecf_fac.value==""){error=error+"Fecha final\n";}
  if(form1.cod_cie10.value==""){error=error+"Diagnostico\n";}
  /*if(validafecha(form1.feci_fac.value)==false){
    error+="Fecha de inicio del servicio inválida\n";
  }
  if(validafecha(form1.fecf_fac.value)==false){
    error+="Fecha final del servicio inválida\n";
  }
  if(validahoy(form1.feci_fac.value)==false){
    error+="La fecha inicial del servicio no puede ser mayor a la de hoy\n";
  }
  if(validahoy(form1.fecf_fac.value)==false){
    error+="La fecha final del servicio no puede ser mayor a la de hoy\n";
  }
  if(error==""){
      if(validafechamen(form1.fecf_fac.value,form1.feci_fac.value)==true){
        error+="La fecha de inicio del servicio debe ser menor o igual a la de finalización\n";
      }
  }*/
  if(error!=""){
    alert(error);
  }
  else{
    for(ce=0;ce<=conte_;ce++){
	  //cmd="form1.diasest"+ce+".disabled=false";
	  //eval(cmd);
    }
    form1.cantvalo.disabled=false;
    form1.cantvalini.disabled=false;
    form1.submit();
  }
}

function validaact(cont_){
  var cmd="";  
  cmd="form1.codigo"+cont_+".value=form1.desc_con"+cont_+".value";
  eval(cmd);
}

function validaser(cont_){
  var cmd="";
  cmd="form1.codi_ser"+cont_+".value=form1.desc_ser"+cont_+".value";
  eval(cmd);
}

function activar(cont_){
  var cmd="";
  cmd="form1.chkevo"+cont_+".checked";
  if(eval(cmd)==true){
    cmd="form1.codigo"+cont_+".disabled=false";
    eval(cmd);
    cmd="form1.desc_con"+cont_+".disabled=false";
    eval(cmd);
  }
  else{
    cmd="form1.codigo"+cont_+".value=''";
    eval(cmd);
    cmd="form1.desc_con"+cont_+".value=''";
    eval(cmd);
    cmd="form1.codigo"+cont_+".disabled=true";
    eval(cmd);
    cmd="form1.desc_con"+cont_+".disabled=true";
    eval(cmd);
  }
}

function actiser(cont_){
  var cmd="";
  cmd="form1.chkser"+cont_+".checked";
  if(eval(cmd)==true){
    //cmd="form1.codi_ser"+cont_+".disabled=false";
    //eval(cmd);
    cmd="form1.desc_ser"+cont_+".disabled=false";
    eval(cmd);
  }
  else{
    cmd="form1.codi_ser"+cont_+".value=''";
    eval(cmd);
    cmd="form1.desc_ser"+cont_+".value=''";
    eval(cmd);
    //cmd="form1.codi_ser"+cont_+".disabled=true";
    //eval(cmd);
    cmd="form1.desc_ser"+cont_+".disabled=true";
    eval(cmd);
  }
}

function cargaadm(cont_){
  var cmd;
  cmd="form1.chkadmin"+cont_+".checked";
  if(eval(cmd)==true){
    cmd="form1.chkadmin"+cont_+".value=form1.codi_adm"+cont_+".value";
    eval(cmd);
	cmd="form1.cant_adi"+cont_+".disabled=false";
    eval(cmd);
	cmd="form1.cant_adi"+cont_+".focus()";
    eval(cmd);
  }
  else{
    cmd="form1.chkadmin"+cont_+".value=''";
    eval(cmd);
	cmd="form1.cant_adi"+cont_+".disabled=true";
    eval(cmd);
  }
}

function cargater(cont_){
  var cmd;
  cmd="form1.chkter"+cont_+".checked";
  if(eval(cmd)==true){
    cmd="form1.chkter"+cont_+".value=form1.codi_ter"+cont_+".value";
    eval(cmd);
  }
  else{
    cmd="form1.chkter"+cont_+".value=''";
    eval(cmd);
  }
}

function cargaterins(cont_){
  var cmd;
  cmd="form1.chkterins"+cont_+".checked";
  if(eval(cmd)==true){
    cmd="form1.chkterins"+cont_+".value=form1.codi_terins"+cont_+".value";
    eval(cmd);
    cmd="form1.cant_terins"+cont_+".disabled=false";
    eval(cmd);
  }
  else{
    cmd="form1.chkterins"+cont_+".value=''";
    eval(cmd);
    cmd="form1.cant_terins"+cont_+".disabled=true";
    eval(cmd);
  }  
}

function cargatermed(cont_){
  var cmd;
  cmd="form1.chktermed"+cont_+".checked";  
  if(eval(cmd)==true){
    cmd="form1.chktermed"+cont_+".value=form1.codi_termed"+cont_+".value";
    eval(cmd);
    cmd="form1.cant_termed"+cont_+".disabled=false";
    eval(cmd);
  }
  else{
    cmd="form1.chktermed"+cont_+".value=''";
    eval(cmd);
    cmd="form1.cant_termed"+cont_+".disabled=true";
    eval(cmd);
  }  
}

function cargavar(cont_){
  var cmd;
  cmd="form1.chkvar"+cont_+".checked";
  if(eval(cmd)==true){
    cmd="form1.chkvar"+cont_+".value=form1.codi_var"+cont_+".value";
    eval(cmd);}
  else{
    cmd="form1.chkvar"+cont_+".value=''";
    eval(cmd);}
}

function activarval(){
  var cmd="form1.chkvaldia.checked";
  if(eval(cmd)==true){
    cmd="form1.valoracion.disabled=false";
    eval(cmd);
    cmd="form1.desc_val.disabled=false";
    eval(cmd);
    cmd="form1.cantvalo.disabled=false";
    eval(cmd);    
  }
  else{
    cmd="form1.valoracion.disabled=true";
    eval(cmd);
    cmd="form1.desc_val.disabled=true";
    eval(cmd);
    cmd="form1.valoracion.value=''";
    eval(cmd);
    cmd="form1.desc_val.value=''";
    eval(cmd);
    cmd="form1.cantvalo.disabled=true";
    eval(cmd);
  }
}

function validaval(){
  var cmd="";  
  cmd="form1.valoracion.value=form1.desc_val.value";
  eval(cmd);
}

function activarini(){
  var cmd="form1.chkvalini.checked";
  if(eval(cmd)==true){
    cmd="form1.valoracionini.disabled=false";
    eval(cmd);
    cmd="form1.desc_valini.disabled=false";
    eval(cmd);
    cmd="form1.cantvalini.disabled=false";
    eval(cmd);
  }
  else{
    cmd="form1.valoracionini.disabled=true";
    eval(cmd);
    cmd="form1.desc_valini.disabled=true";
    eval(cmd);
    cmd="form1.cantvalini.disabled=true";
    eval(cmd);
    cmd="form1.valoracionini.value=''";
    eval(cmd);
    cmd="form1.desc_valini.value=''";
    eval(cmd);
  }
}

function validaini(){
  var cmd="";  
  cmd="form1.valoracionini.value=form1.desc_valini.value";
  eval(cmd);
}

function seleccionar(cont_){
  vrble="form1.desc_con"+cont_+".value=form1.codigo"+cont_+".value";
  eval(vrble);
}
</script>

<script language='vBscript'>
//Funcion que retorna true si la fecha es válida y false si la fecha no es válida
//Parámetros: fecha_ : Es la fecha que se va a validar, debe llegar en formato dd/mm/aaaa
function validafecha(fecha_)
  validafecha=IsDate(fecha_)
end function

//Funcion que retorna true si la fecha1 es mayor a fecha2
//Parámetros: fecha_ : Es la fecha que se va a validar, debe llegar en formato dd/mm/aaaa
function validafechamen(fecha1_,fecha2_)
  diferencia=(DateDiff("d",fecha2_,fecha1_))  
  if(diferencia>=0) then
    validafechamen=false
  else
    validafechamen=true
  end if
end function

//Funcion que retorna true si la fecha es menor a la fecha actual
//Parámetros: fecha_ : Es la fecha que se va a validar, debe llegar en formato dd/mm/aaaa
function validahoy(fecha_)
  hoy=now
  hoy=mid(hoy,1,10)
  if IsDate(fecha_) then
    diferencia=(DateDiff("d",fecha_,hoy))
  else
    diferencia=0
  end if
  if(diferencia>=0) then
    validahoy=true
  else
    validahoy=false
  end if
end function
</script>


<link rel="stylesheet" href="css/style.css" type="text/css" />
</head>
<body lang=ES  style='tab-interval:35.4pt'  >
<form name="form1" method="POST" action="fac_2guardaenc.php" target='fr02'>

<table class="Tbl0"><tr><td class="Td0" align='center'>ENCABEZADO DE LA FACTURA</td></tr></table><br>
<?
//echo $iden_ctr;
set_time_limit(0);
include('php/conexion.php');
include('php/funciones.php');
$_pagi_sql="SELECT ih.id_ing,ih.contra_ing,u.codi_usu,u.tdoc_usu,u.nrod_usu,concat(u .pnom_usu,' ',u.snom_usu,' ',u.pape_usu,' ',u.sape_usu) AS nombre,u.fnac_usu,
        u.sexo_usu,u.dire_usu,u.tpaf_usu,u.tres_usu,u.mate_usu,
		c.neps_con,ih.fecin_ing,ih.hora_ing,ih.fecsa_ing,
		tr.fecsa_tra,tr.horas_tra,tr.ubica_tra
		FROM ingreso_hospitalario AS ih 
		INNER JOIN hist_traza AS tr ON ih.id_ing=tr.id_ing
		INNER JOIN usuario AS u ON ih.codius_ing=u.codi_usu
		INNER JOIN ucontrato AS uc ON u.codi_usu=uc.cusu_uco
		INNER JOIN contrato AS c ON uc.cont_uco=c.codi_con
		WHERE ih.id_ing='$id_ing' AND c.codi_con=ih.contra_ing";
//echo "$_pagi_sql";
$consulta=mysql_query($_pagi_sql);
if(mysql_num_rows($consulta)!=0){
  $row = mysql_fetch_array($consulta);
  $consultamun=mysql_query("SELECT nomb_mun FROM municipio WHERE codi_mun='$row[mate_usu]'");
  if(mysql_num_rows($consultamun)<>0){
    $rowmun=mysql_fetch_array($consultamun);
	$nomb_mun=$rowmun[nomb_mun];
  }
  mysql_free_result($consultamun);
  echo "<table class='Tbl0'>";
  echo "<tr>";
  echo "<td class='Td2' align='right'><b>Ingreso Nro:</td>";
  echo "<td class='Td2'>$id_ing</td>";
  echo "<td class='Td2' align='right'><b>Identificación:</td>";
  echo "<td class='Td2'>$row[tdoc_usu] $row[nrod_usu]</td>";
  echo "<td class='Td2' align='right'><b>Nombre:</td>";
  echo "<td class='Td2'>$row[nombre]</td>";
  echo "</tr>";
  echo "<tr>";
  echo "<td class='Td2' align='right'><b>Edad:</td>";
  echo "<td class='Td2'>".calculaedad($row[fnac_usu])."</td>";
  echo "<td class='Td2' align='right'><b>Sexo:</td>";
  echo "<td class='Td2'>$row[sexo_usu]</td>";
  echo "<td class='Td2' align='right'><b>Dirección:</td>";
  echo "<td class='Td2'>$row[dire_usu]</td>";
  echo "</tr>";
  echo "<tr>";
  echo "<td class='Td2' align='right'><b>Tipo Afiliado:</td>";
  echo "<td class='Td2'>$row[tpaf_usu]</td>";
  echo "<td class='Td2' align='right'><b>Mun Atención:</td>";
  echo "<td class='Td2'>$nomb_mun</td>";
  echo "<td class='Td2' align='right'><b>Teléfono:</td>";
  echo "<td class='Td2'>$row[tres_usu]</td>";
  echo "</tr>";
  echo "<tr>";
  echo "<td class='Td2' align='right'><b>Fecha Ingreso:</td>";
  echo "<td class='Td2'>".cambiafechadmy(substr($row[fecin_ing],0,10))."</td>";
  echo "<td class='Td2' align='right'><b>Entidad:</td>";
  echo "<td class='Td2'>$row[neps_con]</td>";
  echo "<td class='Td2' align='right'></td>";
  echo "<td class='Td2'></td>";
  echo "</tr>";
  echo"</table>";  
  ?>
  <br>
  <table class='Tbl0'>
      <tr>
          <td class='Td2' align='right'><b>Entidad a facturar:</td>
	  <td class='Td2' align='left'><select name='enti_fac' onchange='validactr()'><option value=''>
	    <?
            //mysql_free_result($consultacon);
            $consultaent=mysql_query("SELECT nit_con,neps_con
		  FROM contrato WHERE esta_con='A' AND nit_con<>'' ORDER BY neps_con");
		  while($rowent=mysql_fetch_array($consultaent)){
		    echo "<option value='$rowent[nit_con]'>$rowent[neps_con]";
		  }
		  mysql_free_result($consultaent);
		?>
		</select>
	  </td>
          <td class='Td2' align='right'><b>Contrato Nro:</td>
          <?
          //echo "<br>".$enti_fac;
          ?>
          <td class='Td2'><select name='iden_ctr' onchange='validactr()'><option value=''>
	    <?            
            //$consultacon="SELECT iden_ctr,nume_ctr FROM contratacion WHERE codi_con='$row[contra_ing]' AND esta_ctr='A'";
            $consultacon="SELECT ccio.iden_ctr,ccio.nume_ctr FROM contratacion AS ccio
            INNER JOIN contrato AS con ON con.codi_con=ccio.codi_con
            WHERE con.nit_con='$enti_fac' AND ccio.esta_ctr='A'";
            //echo "<br>".$consultacon;
            $consultacon=mysql_query($consultacon);
            while($rowcon=mysql_fetch_array($consultacon)){
		 echo "<option value='$rowcon[iden_ctr]'>$rowcon[nume_ctr]";
            }
            mysql_free_result($consultacon);
            ?>
            </select>
	  </td>
	  <td class='Td2' align='right'><b>Tipo de factura:</td>
	  <td class='Td2'><select name='tipo_fac'><option value=''>
          <option value='1'>Contado
		<option value='2'>Crédito
		</select>
	  </td>

      </tr>      
        <tr>
	  <td class='Td2' align='right'><b>Relación Nro:</td>
	  <td class='Td2'><input type='text' name='rela_fac' size='8' maxlength='8' value='<?echo $rela_fac;?>'></td>
	  <td class='Td2' align='right'><b>F. inicio del servicio:</td>
	  <td class='Td2'><input type='text' name='feci_fac' size='10' maxlength='10' value='<?echo cambiafechadmy($row[fecin_ing]);?>'></td>
	  <td class='Td2' align='right'><b>F. final del servicio:</td>
	  <td class='Td2'><input type='text' name='fecf_fac' size='10' maxlength='10' value='<?echo cambiafechadmy($row[fecsa_tra]);?>'></td>          
	</tr>
	<tr>
	  <td class='Td2' align='right'><b>Servicio:</td>
	  <td class='Td2'><select name='servicio' onchange='validactr()'>
	    <option value=''>Todos
	    <?
		  mysql_data_seek($consulta,0);
		  while($rowubica=mysql_fetch_array($consulta)){
		    $ubica_=$rowubica[ubica_tra];
			if($ubica_=='04'){$ubica_='0634';}
			$consubica=mysql_query("SELECT nomb_des FROM destipos WHERE codi_des='$ubica_'");
			$rowarea=mysql_fetch_array($consubica);
		    echo "<option value='$rowubica[ubica_tra]'>$rowarea[nomb_des]";
		  }
		?>
	    </select>
	  </td>
          <td class='Td2' align='right'><b>Diagnóstico:</td>
	  <td class='Td2' align='left'><select name='cod_cie10'><option value=''>
	    <?
          $consultadx=mysql_query("SELECT h.cod_cie10,c.nom_cie10 
		  FROM hist_evo AS h 
		  INNER JOIN cie_10 AS c ON c.cod_cie10=h.cod_cie10 
		  WHERE h.id_ing='$id_ing' AND h.cod_cie10<>'' GROUP BY h.cod_cie10");
		  while($rowdx=mysql_fetch_array($consultadx)){
		    echo "<option value='$rowdx[cod_cie10]'>$rowdx[cod_cie10]";
		  }
		  mysql_free_result($consultadx);
		?>
		</select>
	  </td>
	  <td align='right'><b>Nro Autorización:</td>
	  <td class="Td2" align='left'><input type='text' name='nauto_fac' size='15' maxlength='15' value=<?echo $nauto_fac;?>></td>
	</tr>
        <tr>
            <td class='Td2' align='right' colspan="6"><a href="fac_2prefac.php?id_ing=<?echo $id_ing;?>"><b>Finalizar<img hspace=0 width=20 height=20 src='icons/feed.png' alt='Finalizar' border=0 align='center'></a></td>            
        </tr>
  </table>
  <table class="Tbl0"><tr><td class="Td0" align='center'>ESTANCIA/VALORACIONES</td></tr></table><br>
  <table class='Tbl0'>
    <th class='Th0' width='2%'>Sel</th>
    <th class='Th0' width='8%'>Código</th>
    <th class='Th0' width='30%'>Descripción</th>
  	<th class='Th0' width='25%'>Servicio</th>
  	<th class='Th0' width='15%'>Fecha</th>
  	<th class='Th0' width='5%'>Cant</th>
  	<th class='Th0' width='15%'></th>
	<?
	//****Aqui calculo la estancia        
	$condser="esta_evo='C' and id_ing='$id_ing'";
	if(!empty($servicio)){
	  $condser=$condser." and valo_des='$servicio'";
	}

  $consultaest="SELECT id_ing,MIN(fech_evo) AS fecha_min,MAX(fech_evo) AS fecha_max,DATEDIFF(MAX(fech_evo),MIN(fech_evo)) AS dias,codi_cup AS cups_serv, valo_des AS cod_servicio,cama
  FROM vista_evolucion 
  WHERE $condser
  GROUP BY id_ing,codi_cup
  ORDER BY iden_evo";
  //echo "<BR>".$consultaest;
  $consultaest=mysql_query($consultaest);
	$cup='';
  $fini='';
  $ffin='';
	$conte=0;
	if(mysql_num_rows($consultaest)<>0){    
	  while($rowest=mysql_fetch_array($consultaest)){
      $fini=cambiafechadmy($rowest[fecha_min]);
      $ffin=cambiafechadmy($rowest[fecha_max]);
      $cod_servicio=$rowest[cod_servicio];
      $cama=$rowest[CAMA];      
      $cup=$rowest['cups_serv'];
      $dias=$rowest['dias'];        
      echo "<tr>";
      $nomvar='chkestan'.$conte;        
      echo "<td class='Td2'><input type='checkbox' name='$nomvar' onclick='activaest($conte)'></td>";
      if($cod_servicio=='04'){
        $cod_servicio='0634';
        $cons_serv="SELECT codt_des,val2_des,homo_esp FROM destipos WHERE codt_des='19' AND val2_des='$cod_servicio'";
        $cons_serv=mysql_query($cons_serv);
        $row_serv=mysql_fetch_array($cons_serv);
        $cup=$row_serv['homo_esp'];
      }
      $consultadet="SELECT iden_tco,iden_ctr,codi_map,codi_cup,descrip,esta_cup,esta_tco FROM vista_tarco WHERE esta_cup='AC' AND esta_tco='AC' AND iden_ctr='$iden_ctr' and codi_cup='$cup'";

      $consultadet=mysql_query($consultadet);
      if(mysql_num_rows($consultadet)<>0){          
        $rowdet=mysql_fetch_array($consultadet);
        echo "<td class='Td2'>$cup</td>";        
        echo "<td class='Td2'>";
        echo SUBSTR($rowdet[descrip],0,80);
        $nomvar='estancia'.$conte;
        echo "<input type='hidden' name='$nomvar' size='8' value='$rowdet[iden_tco]'>";
        mysql_free_result($consultadet);
        echo "</td>";
      }
      else{
        echo "<td></td>";
        echo "<td></td>";
      }
      echo "<td class='Td2'>estancia $cama";
      echo "</td>";
      echo "<td class='Td2'>$fini - $ffin</td>";
      $nomvar='diasest'.$conte;
      echo "<td class='Td2'><input type='text' name='$nomvar' value='$dias' disabled size='2'></td>";
      $nomvar='servicio'.$conte;
      //  echo "<br>".$nomvar;
      echo "<td><input type='hidden' name='$nomvar' value='$cod_servicio'></td>";

      echo "</tr>";
      $cama=$rowest[nomb_des];  		  
      $conte++;
	  }
    
	  echo "<tr>";
	  $nomvar='chkestan'.$conte;
	  echo "<td class='Td2'><input type='checkbox' name='$nomvar' onclick='activaest($conte)'></td>";          
	  
    $consultadet="SELECT iden_tco,codi_map,descrip,esta_tco FROM vista_tarco WHERE esta_tco='AC' AND iden_ctr='$iden_ctr' AND codi_cup='$cup'";
    //echo "<br>".$consultadet;
    // and codi_map='S11302'
    $consultadet=mysql_query($consultadet);
	  if(mysql_num_rows($consultadet)<>0){
  		$rowdet=mysql_fetch_array($consultadet);
      //echo "<td class='Td2'>$rowdet[codi_cup]</td>";
      echo "<td class='Td2'>$cup</td>";
  		echo "<td class='Td2'>";
  		echo SUBSTR($rowdet[descrip],0,80);
  		$nomvar='estancia'.$conte;      
  		echo "<input type='hidden' name='$nomvar' size='8' value='$rowdet[iden_tco]'>";
      mysql_free_result($consultadet);
  		echo "</td>";
	  }
	  else{
  		echo "<td></td>";
  		echo "<td></td>";
	  }
    echo "<td class='Td2'>Estancia $cama";
    if($cod_servicio=='04'){$cod_servicio='0634';}
    $nomvar='servicio'.$conte;
    //echo "<br>".$nomvar;
    echo "<input type='hidden' name='$nomvar' value='$cod_servicio'>";
    echo "</td>";
	  echo "<td class='Td2'>$fini - $ffin";
    //$nomvar='fecha_ser'.$conte;    
    //echo "<input type='hidden' name='$nomvar' value='$ffin'>";
    //echo $nomvar;
    echo "</td>";
	  $nomvar='diasest'.$conte;
	  echo "<td class='Td2'><input type='text' name='$nomvar' value='$dias' disabled size='2'></td>";
	  echo "</tr>";
  }
  
	//Aqui solicito las valoraciones diarias
	echo "<tr>";
	echo "<td class='Td2'><input type='checkbox' name='chkvaldia' onclick=activarval()></td>";
	echo "<td class='Td2'><input type='hidden' name='valoracion' size='8' disabled></td>";
  
  $consultaval="SELECT iden_tco,codi_map,descrip,esta_tco FROM vista_tarco
	WHERE esta_tco='AC' AND iden_ctr='$iden_ctr' AND descrip LIKE 'CONSULTA DE CONTROL%'";
  //echo "<br>".$consultaval;
	echo "<td class='Td2'><select name='desc_val' onchange='validaval()' disabled>
	<option value=''>";	
  $consultaval=mysql_query($consultaval);
  //echo "<br>".mysql_num_rows($consultaval);
	while($rowval=mysql_fetch_array($consultaval)){
	  //echo "<option value='$rowval[codi_map]'>".SUBSTR($rowval[desc_map],0,80);
	  echo "<option value='$rowval[iden_tco]'>".SUBSTR($rowval[descrip],0,90);
  }
	//mysql_free_result($consultaval);
	echo "</select></td>";
	echo "<td class='Td2'>Valoraciones diarias";

  echo "<input type='hidden' name='serviciovalo' value='$cod_servicio'>";
  echo "</td>";
  echo "<td class='Td2'>$fini - $ffin";  
  //echo "<input type='hidden' name='fecha_valo' value='$ffin'>";  
  echo "</td>";

	$dias=calculadias($fini,$ffin);
	echo "<td class='Td2'><input type='text' name='cantvalo' value='$dias' size='2' disabled></td>";
	echo "<td class='Td2'></td>";
	echo "</tr>";
	//Aqui solicito la valoracion inicial
	echo "<tr>";
	echo "<td class='Td2'><input type='checkbox' name='chkvalini' onclick=activarini()></td>";
	echo "<td class='Td2'><input type='hidden' name='valoracionini' size='8' disabled></td>";        
	
  $consultaval="SELECT iden_tco,codi_map,descrip,esta_tco FROM vista_tarco WHERE esta_tco='AC' AND iden_ctr='$iden_ctr' AND descrip LIKE 'CONSULTA DE PRIMERA%'";
  //echo "<br>".$consultaval;
	echo "<td class='Td2'><select name='desc_valini' onchange='validaini()' disabled>
	<option value=''>";
  $consultaval=mysql_query($consultaval);
	while($rowval=mysql_fetch_array($consultaval)){
	  //echo "<option value='$rowval[codi_map]'>".SUBSTR($rowval[desc_map],0,80);
	  echo "<option value='$rowval[iden_tco]'>".SUBSTR($rowval[descrip],0,90);
  }
	mysql_free_result($consultaval);
	echo "</select></td>";
	echo "<td class='Td2'>Valoracion inicial";

  echo "<input type='hidden' name='servicioini' value='$cod_servicio'>";
  echo "</td>";
  echo "<td class='Td2'>";
  //echo "<input type='hidden' name='fecha_ini' value='$fini'>";
  echo "</td>";

	echo "<td class='Td2'><input type='text' name='cantvalini' value='1' disabled size='2'></td>";
	echo "<td class='Td2'></td>";
	echo "</tr>";
	?>
  </table>
  <table class="Tbl0"><tr><td class="Td0" align='center'>EVOLUCIONES</td></tr></table><br>
  <table class='Tbl0'>
    <th class='Th0' width='2%'>Fac</th>
    <th class='Th0' width='2%'>No F</th>
    <th class='Th0' width='5%'>Código</th>
    <!--<th class='Th0' width='5%'>No Se Factura</th>-->
    <th class='Th0' width='36%'>Descripción</th>
  	<th class='Th0' width='20%'>Cama/Servicio</th>
  	<th class='Th0' width='15%'>Fecha</th>
  	<th class='Th0' width='5%'>Cant</th>
  	<th class='Th0' width='15%'>Profesional</th>
	<?php
	//****Aqui hago el listado de evoluciones
	$contc=0;
  $consultaevo="SELECT h.iden_evo,h.cod_medi,h.fech_evo,h.cama_evo,h.esta_evo,h.hora_evo,m.nom_medi,
	h.cod_medi,m.espe_med,des.val2_des,m.mapip_med,m.mapic_med,cama.valo_des
	FROM hist_evo AS h 
	LEFT JOIN medicos AS m ON m.cod_medi=h.cod_medi
	LEFT JOIN destipos AS des ON des.codi_des=m.espe_med
  LEFT JOIN destipos AS cama ON cama.codi_des=h.cama_evo
	WHERE h.id_ing='$id_ing' AND (h.fact_evo='' OR ISNULL(h.fact_evo))";
  //echo "<br>".$consultaevo;
  if(!empty($servicio)){
      $consultaevo=$consultaevo." AND cama.valo_des='$servicio'";
  }
  $consultaevo=$consultaevo." ORDER BY h.fech_evo,m.nom_medi";
  //echo $consultaevo;
	$consultaevo=mysql_query($consultaevo);
	while($rowevo=mysql_fetch_array($consultaevo)){
	  echo "<tr>";
	  $var="iden_evo".$contc;
	  echo "<input type=hidden name=$var value=$rowevo[iden_evo]>";
	  $var="chkevo".$contc;
	  echo "<td class='Td2'><input type='checkbox' name='$var' onclick=activar($contc)></td>";
	  
	  $var="chknfevo".$contc;
	  echo "<td class='Td2'><input type='checkbox' name='$var' onclick=activar($contc)></td>";	  
	  $var="codigo".$contc;    
	  echo "<td class='Td2'>
	  <input type='hidden' name='$var' size='8' onblur='seleccionar($contc)' disabled></td>";
	  //echo "<td class='Td2'><input type='hidden' name='$var' size='8'  disabled></td>";
	  $var="desc_con".$contc;
    
    $consultacon="SELECT iden_tco,codi_map,codi_cup,descrip,esta_tco
    FROM vista_tarco
    WHERE esta_tco='AC' AND (codi_cup='$rowevo[mapip_med]' OR codi_cup='$rowevo[mapic_med]') AND iden_ctr='$iden_ctr'";
    //echo "<br>".$consultacon;
	  echo "<td class='Td2'><select name='$var' onchange='validaact($contc)' disabled>
	    <option value=''>";
		$consultacon=mysql_query($consultacon);
		//echo "<br>".$rowevo[mapip_med]."  y   ".$rowevo[mapic_med];
    if(mysql_num_rows($consultacon)<>0){
        while($rowcon=mysql_fetch_array($consultacon)){
          //echo "<option value='$rowcon[codi_map]'>".SUBSTR($rowcon[desc_map],0,80);
          echo "<option value='$rowcon[iden_tco]'>".SUBSTR($rowcon[descrip],0,80);
        }
    }
		mysql_free_result($consultacon);
	  echo "</select></td>";
	  $$var=substr($rowevo[val2_des],2,6);
	  ?>
	    <script language='javascript'>actcons('<?echo $$var;?>','<?echo $contc?>');</script>
	  <?
	  //echo $$var;
	  $consultacam=mysql_query("SELECT nomb_des FROM destipos WHERE codi_des='$rowevo[cama_evo]'");
	  $rowcam=mysql_fetch_array($consultacam);
	  
	  $consultaser=mysql_query("SELECT nomb_des FROM destipos WHERE codi_des=(SELECT val2_des FROM destipos WHERE codi_des='$rowevo[cama_evo]')");
	  $rowser=mysql_fetch_array($consultaser);
	  
	  echo "<td class='Td2'>$rowcam[nomb_des] / $rowser[nomb_des]";
    $var="servicio_evo".$contc;    
    echo "<input type='hidden' name='$var' value='$rowevo[valo_des]'>";
    echo "</td>";
	  echo "<td class='Td2'>".cambiafechadmy($rowevo[fech_evo]).'-'.$rowevo[hora_evo];
    $var="fecha_evo".$contc;    
    echo "<input type='hidden' name='$var' value='".cambiafechadmy($rowevo[fech_evo])."'>";
    echo "</td>";
	  echo "<td class='Td2'>1</td>";
	  echo "<td class='Td2'>".$rowevo[nom_medi];
	  $consultaesp=mysql_query("SELECT nomb_des FROM destipos WHERE codi_des='$rowevo[espe_med]'");
	  if(mysql_num_rows($consultaesp)<>0){
	    $rowesp=mysql_fetch_array($consultaesp);
		  echo "<br><b>".$rowesp[nomb_des];
	  }
	  echo "</td>";
	  echo "</tr>";
	  mysql_free_result($consultacam);
	  mysql_free_result($consultaser);
	  $contc++;
	}
	//mysql_free_result($consultaevo);
	?>
  </table>
  <table class="Tbl0"><tr><td class="Td0" align='center'>ADMINISTRACIONES</td></tr></table>
  <table class='Tbl0'>
    <th class='Th0' width='2%'>Fac</th>
    <th class='Th0' width='2%'>No F</th>
    <th class='Th0' width='8%'>Código</th>
    <th class='Th0' width='30%'>Descripción</th>
  	<th class='Th0' width='25%'>Clase</th>
  	<th class='Th0' width='13%'>Fecha</th>
  	<th class='Th0' width='5%'>Cant</th>
  	<th class='Th0' width='15%'>Responsable</th>
  	<?
	//Aqui hago el listado de aplicacion de medicamentos e insumos
	$conta=0;                
  $consultaadm="SELECT adm.iden_adi,adm.tpin_adi,adm.idin_adi,adm.fech_adi,adm.hora_adi,adm.tipo_adi,adm.cant_adi,adm.resp_adi,adm.id_ing,adm.cama_adi,m.nom_medi,map.desc_map,cama.valo_des
	FROM administra_insumo AS adm 
	LEFT JOIN medicos AS m ON m.cod_medi=adm.resp_adi 
  LEFT JOIN destipos AS cama ON cama.codi_des=adm.cama_adi
	LEFT JOIN mapii AS map ON map.codi_map=adm.idin_adi 
	WHERE adm.tipo_adi='A' and adm.fact_adi<>'S' and id_ing='$id_ing'";
  if(!empty($servicio)){
    $consultaadm=$consultaadm." AND cama.valo_des='$servicio'";
  }
  $consultaadm=$consultaadm." ORDER BY adm.fech_adi";
  //echo $consultaadm;
	$consultaadm=mysql_query($consultaadm);
	while($rowadm=mysql_fetch_array($consultaadm)){
	  $descripcion=$rowadm[desc_map];
	  $actdisp='';
    $servicio=$rowadm[valo_des];
    if($servicio=='04'){$servicio='0634';}
    $font="<font color=''>";    
    $tpin_adi=$rowadm[tpin_adi];
    if(strlen($rowadm[idin_adi])==6 AND $tpin_adi=='I'){
      $tpin_adi='M';      
    }
	  switch ($tpin_adi){
	    case 'I':
  		  $desctpin_adi='Insumo';
  		  //Aqui consulto el codigo nuevo del insumo ya que en la administracion esta con el codigo anterior
  		  //$consultaact=mysql_query("SELECT codnue,desc_ins FROM insu_med WHERE codi_ins='$rowadm[idin_adi]'");
        $consultaact=mysql_query("SELECT codi_ins,desc_ins FROM insu_med WHERE codi_ins='$rowadm[idin_adi]'");
  		  $rowact=mysql_fetch_array($consultaact);
  		  $descripcion=$rowact[desc_ins];
  		  $codigo_act=$rowact[codi_ins];
  		  //Aqui consulto si el insumo esta contratado
  		  $consultaact=mysql_query("SELECT iden_tco FROM tarco WHERE iden_map='$codigo_act' AND iden_ctr=$iden_ctr");
  		  if(mysql_num_rows($consultaact)==0){
  		    $actdisp="disabled='true'";
  			$font="<font color='#CC9933'>";
  		  }		  
  		  mysql_free_result($consultaact);
  		  break;
	    case 'M':
  		  $desctpin_adi='Medicamento';
  		  //Aqui consulto el nombre del medicamento y si esta contratado o no
  		  /*$consultaact=mysql_query("SELECT tar.iden_tco,CONCAT(mdi.nomb_mdi,' ',mdi.noco_mdi,' ',ff.desc_ffa) AS desc_
        FROM medicamentos2 AS mdi 
        INNER JOIN forma_farmaceutica AS ff ON ff.codi_ffa=mdi.coff_mdi
  		  LEFT JOIN tarco AS tar ON tar.iden_map=mdi.codi_mdi AND tar.iden_ctr=$iden_ctr 
  		  WHERE mdi.codi_mdi='$rowadm[idin_adi]'");*/
        $consultaact="SELECT tar.iden_tco,mdi.nombre_mdi AS desc_
        FROM vista_medicamentos2 AS mdi         
        LEFT JOIN tarco AS tar ON tar.iden_map=mdi.codi_mdi AND tar.iden_ctr=$iden_ctr 
        WHERE mdi.codi_mdi='$rowadm[idin_adi]'";
        //echo "<br>".$consultaact;
        $consultaact=mysql_query($consultaact);
  		  $rowact=mysql_fetch_array($consultaact);
        //$descripcion=$rowact[nomb_mdi];
        $descripcion=$rowact[desc_];
  		  $codigo_act=$rowadm[idin_adi];
  		  if(IS_NULL($rowact[iden_tco])){
  		    $actdisp="disabled='true'";
    			$font="<font color='#CC9933'>";
	   	  }	
  		  mysql_free_result($consultaact);
  		  break;
	    case 'P':
  		  $desctpin_adi='Procedimiento';
       
  		  $consultaact=mysql_query("SELECT tar.iden_tco,map.desc_map FROM mapii AS map
  		  LEFT JOIN tarco AS tar ON tar.iden_map=map.iden_map AND tar.iden_ctr=$iden_ctr 
  		  WHERE map.codi_map='$rowadm[idin_adi]'");
  		  $rowact=mysql_fetch_array($consultaact);
  		  //$descripcion=$rowact[nomb_mdi];
  		  //$codigo_act=$rowadm[idin_adi];
  		  $codigo_act=$rowact[iden_tco];
  		  if(IS_NULL($rowact[iden_tco])){
  		    $actdisp="disabled='true'";
  			$font="<font color='#CC9933'>";
  		  }	
  		  mysql_free_result($consultaact);		  
  		  break;
	  }
	  echo "<tr>";
	  $var="tpid_adi".$conta;
	  //echo "<input type='hidden' name=$var value='$rowadm[tpin_adi]'>";
    echo "<input type='hidden' name=$var value='$tpin_adi'>";
	  $var="iden_adi".$conta;
	  echo "<input type='hidden' name=$var value='$rowadm[iden_adi]'>";
	  $var="chkadmin".$conta;
	  echo "<td class='Td2'><input type='checkbox' name='$var' onclick='cargaadm($conta)' $actdisp></td>";
	  $var="chknfadmin".$conta;
	  echo "<td class='Td2'><input type='checkbox' name='$var'></td>";
	  $var="codi_adm".$conta;
	  echo "<input type='hidden' name='$var' value='$codigo_act'>";
    echo "<td class='Td2'>$font $codigo_act</td>";
	  //echo "<td class='Td2'>$font </td>";
	  echo "<td class='Td2'>$font $descripcion</td>";
	  echo "<td class='Td2'>$font $desctpin_adi";    
    $var="servicio_adi".$conta;
    echo "<input type='hidden' name='$var' value='$servicio'>";
    echo  "</td>";
	  echo "<td class='Td2'>$font".cambiafechadmy($rowadm[fech_adi]).'-'.$rowadm[hora_adi];        
    $var="fecha_adi".$conta;
    echo "<input type='hidden' name='$var' value='".cambiafechadmy($rowadm[fech_adi])."'>";
    echo "</td>";
	  $var="cant_adi".$conta;
	  echo "<td class='Td2'><input type='text' size='4' name='$var' value='$rowadm[cant_adi]' disabled></td>";
	  echo "<td class='Td2'>$font".$rowadm[nom_medi]."</td>";
	  echo "</tr>";
	  $conta++;
	}
	mysql_free_result($consultaadm);
	?>
  </table>
  
  <table class="Tbl0"><tr><td class="Td0" align='center'>AYUDAS DIAGNOSTICAS</td></tr></table>
  <table class='Tbl0'>
  <th class='Th0' width='2%'>Fac</th>
	<th class='Th0' width='2%'>No F</th>
  <th class='Th0' width='8%'>Código</th>
  <th class='Th0' width='30%'>Descripción</th>
	<th class='Th0' width='15%'>Clase</th>
	<th class='Th0' width='10%'>Fecha</th>
  <th class='Th0' width='8%'>Estado</th>
	<th class='Th0' width='5%'>Cant</th>
	<th class='Th0' width='20%'>Profesional</th>
 	<?php
	//Aqui hago el listado de varios
	$contv=0;        
  
  $consultavar="SELECT NROD_USU, PNOM_USU, SNOM_USU, PAPE_USU, SAPE_USU, contra_ing, NEPS_CON, id_ing, fecin_ing, iden_evo, cama_evo, cama, cod_servicio, cod_medi, nom_medi, iden_var, clas_var, iden_ser,codi_cup,descrip,fech_var, fact_var, esta_var, hora_var   FROM vista_hist_var_cups WHERE fact_var<>'S' AND clas_var='A' AND id_ing='$id_ing'";
  //echo "<br>".$consultavar;
  if(!empty($servicio)){    
    $consultavar=$consultavar." AND cod_servicio='$servicio'";
  }
  $consultavar=$consultavar." ORDER BY fech_var,nom_medi";
  //echo "<br>".$consultavar;
	$consultavar=mysql_query($consultavar);
	while($rowvar=mysql_fetch_array($consultavar)){
	  $descripcion=$rowvar[descrip];
    $servicio=$rowvar[cod_servicio];
    if($servicio=='04'){$servicio='0634';}
	  $font="<font color=''>";
	  $disp="";
    $codigo=$rowvar[iden_ser];
    $codi_cup=$rowvar[codi_cup];
    $iden_tco='';
    $consultamap="SELECT iden_tco,codigo,codi_cup,iden_ctr,esta_tco FROM vista_tarco WHERE esta_tco='AC' AND iden_ctr='$iden_ctr' AND codigo='$codigo'";
    //echo "<br>".$consultamap;
    $consultamap=mysql_query($consultamap);
    if(mysql_num_rows($consultamap)!=0){
      $rowmap=mysql_fetch_array($consultamap);
      $iden_tco=$rowmap[iden_tco];      
    }
    else{
      $font="<font color='#CC9933'>";
  		$disp="disabled='true'";
    }

	  switch ($rowvar[clas_var]){
	    case 'I':
  		  $clas_var='Interconsulta';
  		  break;
	    case 'P':
  		  $clas_var='Procedimiento';
  		  break;
	    case 'A':
  		  $clas_var='Ayuda Dx';
  		  break;
	  }	  
	  echo "<tr>";
	  //echo "<br>".$rowvar[iden_tco];
	  $var="iden_var".$contv;
	  echo "<input type='hidden' name='$var' value='$rowvar[iden_var]'>";
	  $var="chkvar".$contv;
	  echo "<td class='Td2'><input type='checkbox' name='$var' onclick='cargavar($contv)' $disp></td>";
	  $var="chknfvar".$contv;
	  echo "<td class='Td2'><input type='checkbox' name='$var'></td>";
	  $var="codi_var".$contv;	  
	  echo "<input type='hidden' name='$var' value='$iden_tco'>";    
    echo "<td class='Td2'>$font $codi_cup</td>";
	  echo "<td class='Td2'>$font $descripcion</td>";
	  echo "<td class='Td2'>$font $clas_var";
    $var="servicio_var".$contv;    
    echo "<input type='hidden' name='$var' value='$servicio'>";    
    echo "</td>";
	  echo "<td class='Td2'>$font".cambiafechadmy($rowvar[fech_var]).'-'.$rowvar[hora_var];
    //$var="fecha_var".$contv;    
    //echo "<input type='hidden' name='$var' value='".cambiafechadmy($rowvar[fech_var])."'>";
    echo "</td>";
    echo "<td class='Td2'>$font".$rowvar[esta_var]."</td>";
	  echo "<td class='Td2'>$font 1</td>";
	  echo "<td class='Td2'>$font".$rowvar[nom_medi]."</td>";    
	  echo "</tr>";
	  $contv++;
	}
	mysql_free_result($consultavar);
	?>
  </table>
  
  <table class="Tbl0"><tr><td class="Td0" align='center'>TERAPIAS</td></tr></table>
  <table class='Tbl0'>
  <th class='Th0' width='2%'>Fac</th>
  <th class='Th0' width='2%'>No F</th>
  <th class='Th0' width='8%'>Código</th>
  <th class='Th0' width='30%'>Descripción</th>
  <th class='Th0' width='25%'>Servicio</th>
  <th class='Th0' width='13%'>Fecha</th>
  <th class='Th0' width='5%'>Cant</th>
  <th class='Th0' width='15%'>Profesional</th>
  	<?
	//Aqui hago el listado de terapia
	     $contt=0;	     

       //Destipos, grupo 56 debe estar con el codigo de la tabla cups 
      $consultater="SELECT iden_ter,id_ing,fech_ter,hora_ter,actividad,nom_medi,cod_servicio,codi_cup,codigo,descrip,nom_medi FROM vista_terapia_evolucion WHERE ISNULL(fact_ter) AND codt_des='56' AND id_ing='$id_ing' AND esta_ter='C'";
      if(!empty($servicio)){
        $consultater=$consultater." AND cod_servicio='$servicio'";
      }
      $consultater=$consultater." ORDER BY fech_ter";
      //echo $consultater;
      $consultater=mysql_query($consultater);
      if(mysql_numrows($consultater)<>0){
        while($rowter=mysql_fetch_array($consultater)){
          $servicio=$rowter[cod_servicio];
          $iden_tco='';
          $font="<font color=''>";
          if($servicio=='04'){$servicio='0634';}
          $consultamap="SELECT iden_tco,codigo,codi_cup,iden_ctr,esta_tco FROM vista_tarco WHERE esta_tco='AC' AND iden_ctr='$iden_ctr' AND codigo='$rowter[codigo]'";
          //echo "<br>".$consultamap;
          $consultamap=mysql_query($consultamap);
          if(mysql_num_rows($consultamap)!=0){
            $rowmap=mysql_fetch_array($consultamap);
            $iden_tco=$rowmap[iden_tco];      
          }
          else{
            $font="<font color='#CC9933'>";
            $disp="disabled='true'";
          }

          echo "<tr>";
          $var="iden_ter".$contt;
          echo "<input type='hidden' name='$var' value='$rowter[iden_ter]'>";
          $var="chkter".$contt;
          echo "<td class='Td2'><input type='checkbox' name='$var' onclick='cargater($contt)'></td>";
          $var="chknfter".$contt;
          echo "<td class='Td2'><input type='checkbox' name='$var' onclick='actiser($contt)'></td>";
          $var="codi_ter".$contt;
          echo "<td class='Td2'>$rowter[codi_cup] <input type='hidden' name='$var' size='8' value='$iden_tco'></td>";
          $var="desc_ter".$contt;
          echo "<td class='Td2'>";
          echo SUBSTR($rowter[descrip],0,60);
          echo "</td>";
          echo "<td class='Td2'>$font $rowter[actividad]";
          $var="servicio_ter".$contt;
          echo "<input type='hidden' name='$var' value='$servicio'>";
          echo "</td>";
          echo "<td class='Td2'>$font".cambiafechadmy($rowter[fech_ter]).' - '.$rowter[hora_ter];
          //$var="fecha_ter".$contt;
          //echo "<input type='hidden' name='$var' value='".cambiafechadmy($rowter[fech_ter])."'>";
          echo "</td>";
          echo "<td class='Td2'>$font 1</td>";
          echo "<td class='Td2'>$font".$rowter[nom_medi]."</td>";
          echo "</tr>";
          $contt++;
        }
      }
	mysql_free_result($consultater);
	?>
  </table>

<table class="Tbl0"><tr><td class="Td0" align='center'>INSUMOS DE TERAPIAS</td></tr></table>
  <table class='Tbl0'>
    <th class='Th0' width='2%'>Fac</th>
	  <th class='Th0' width='2%'>No F</th>
    <th class='Th0' width='8%'>Código</th>
    <th class='Th0' width='30%'>Descripción</th>
    <th class='Th0' width='25%'>Servicio</th>
    <th class='Th0' width='13%'>Fecha</th>
    <th class='Th0' width='5%'>Cant</th>
    <th class='Th0' width='15%'>Profesional</th>
  	<?
      $contti=0;
      /*$consultaterins="SELECT iden_sal,id_ing,fech_sal,hora_sal,admi_sal,esta_sal,idin_sal,codnue,desc_ins,nom_medi FROM vista_terapia_insumos WHERE (ISNULL(fact_sal) OR fact_sal='') AND id_ing='$id_ing' AND admi_sal<>0";*/
      $consultaterins="SELECT iden_sal,id_ing,fech_sal,hora_sal,admi_sal,esta_sal,idin_sal,codi_ins,desc_ins,nom_medi FROM vista_terapia_insumos WHERE (ISNULL(fact_sal) OR fact_sal='') AND id_ing='$id_ing' AND admi_sal<>0";
      $consultaterins=$consultaterins." ORDER BY fech_sal";
      //echo $consultaterins;
      $consultaterins=mysql_query($consultaterins);
      if(mysql_numrows($consultaterins)<>0){
        while($rowterins=mysql_fetch_array($consultaterins)){          
          //$iden_tco='';
          $font="<font color=''>";          
          $consultaact="SELECT iden_tco,iden_map FROM tarco WHERE iden_map='$rowterins[codi_ins]' AND iden_ctr='$iden_ctr'";
          //echo "<br>".$consultaact;
          $consultaact=mysql_query($consultaact);
          if(mysql_num_rows($consultaact)==0){
            $actdisp="disabled='true'";
            $font="<font color='#CC9933'>";
          }
          else{
            $rowact=mysql_fetch_array($consultaact);
            //$iden_tco=$rowact[iden_tco];            
          }
          mysql_free_result($consultaact);

          echo "<tr>";
          $var="iden_sal".$contti;
          echo "<input type='hidden' name='$var' value='$rowterins[iden_sal]'>";
          $var="chkterins".$contti;
          echo "<td class='Td2'><input type='checkbox' name='$var' onclick='cargaterins($contti)'></td>";
          $var="chknfterins".$contti;
          echo "<td class='Td2'><input type='checkbox' name='$var' onclick='actiser($contti)'></td>";
          $var="codi_terins".$contti;
          echo "<td class='Td2'>$rowterins[codi_ins] <input type='hidden' name='$var' size='8' value='$rowterins[codi_ins]'></td>";
          $var="desc_terins".$contti;
          echo "<td class='Td2'>";
          echo SUBSTR($rowterins[desc_ins],0,60);
          echo "</td>";
          echo "<td class='Td2'>$font $rowterins[actividad]";
          $var="servicio_terins".$contti;
          echo "<input type='hidden' name='$var' value='$servicio'>";
          echo "</td>";
          echo "<td class='Td2'>$font".cambiafechadmy($rowterins[fech_sal]).' - '.$rowterins[hora_sal];
          //$var="fecha_terins".$contti;
          //echo "<input type='hidden' name='$var' value='".cambiafechadmy($rowterins[fech_sal])."'>";
          echo "</td>";
          $var="cant_terins".$contti;
          echo "<td class='Td2'>$font <input type='text' size='4' name='$var' value='$rowterins[admi_sal]' disabled></td>";

          
          echo "<td class='Td2'>$font".$rowterins[nom_medi]."</td>";
          echo "</tr>";
          $contti++;
        }
      }
	mysql_free_result($consultaterins);
	?>
  </table>


<table class="Tbl0"><tr><td class="Td0" align='center'>MEDICAMENTOS DE TERAPIAS</td></tr></table>
  <table class='Tbl0'>
    <th class='Th0' width='2%'>Fac</th>
	  <th class='Th0' width='2%'>No F</th>
    <th class='Th0' width='8%'>Código</th>
    <th class='Th0' width='30%'>Descripción</th>
    <th class='Th0' width='25%'>Servicio</th>
    <th class='Th0' width='13%'>Fecha</th>
    <th class='Th0' width='5%'>Cant</th>
    <th class='Th0' width='15%'>Profesional</th>
  	<?
      $conttm=0;
      $consultatermed="SELECT iden_sal,id_ing,fech_sal,hora_sal,admi_sal,esta_sal,idin_sal,nombre_mdi,nom_medi FROM vista_terapia_medicamentos WHERE (ISNULL(fact_sal) OR fact_sal='') AND id_ing='$id_ing' AND admi_sal<>0";
      $consultatermed=$consultatermed." ORDER BY fech_sal";
      //echo $consultatermed;
      $consultatermed=mysql_query($consultatermed);
      if(mysql_numrows($consultatermed)<>0){
        while($rowtermed=mysql_fetch_array($consultatermed)){          
          //$iden_tco='';
          $font="<font color=''>";
          $consultaact="SELECT iden_tco,iden_map FROM tarco WHERE iden_map='$rowtermed[idin_sal]' AND iden_ctr='$iden_ctr'";
          //echo "<br>".$consultaact;
          $consultaact=mysql_query($consultaact);
          if(mysql_num_rows($consultaact)==0){
            $actdisp="disabled='true'";
            $font="<font color='#CC9933'>";
          }
          else{
            $rowact=mysql_fetch_array($consultaact);
            //$iden_tco=$rowact[iden_tco];            
          }
          mysql_free_result($consultaact);

          echo "<tr>";
          $var="iden_salmed".$conttm;
          echo "<input type='hidden' name='$var' value='$rowtermed[iden_sal]'>";
          $var="chktermed".$conttm;
          echo "<td class='Td2'><input type='checkbox' name='$var' onclick='cargatermed($conttm)'></td>";
          $var="chknftermed".$conttm;
          echo "<td class='Td2'><input type='checkbox' name='$var' onclick='actiser($conttm)'></td>";
          $var="codi_termed".$conttm;
          echo "<td class='Td2'>$rowtermed[idin_sal] <input type='hidden' name='$var' size='8' value='$rowtermed[idin_sal]'></td>";
          $var="desc_termed".$conttm;
          echo "<td class='Td2'>";
          echo $rowtermed[nombre_mdi];
          echo "</td>";
          echo "<td class='Td2'>$font $rowtermed[nomb_mdi]";
          $var="servicio_termed".$conttm;
          echo "<input type='hidden' name='$var' value='$servicio'>";
          echo "</td>";
          echo "<td class='Td2'>$font".cambiafechadmy($rowtermed[fech_sal]).' - '.$rowtermed[hora_sal];
          //$var="fecha_termed".$conttm;
          //echo "<input type='hidden' name='$var' value='".cambiafechadmy($rowtermed[fech_sal])."'>";
          echo "</td>";
          $var="cant_termed".$conttm;
          echo "<td class='Td2'>$font <input type='text' size='4' name='$var' value='$rowtermed[admi_sal]' disabled></td>";
          echo "<td class='Td2'>$font".$rowtermed[nom_medi]."</td>";
          echo "</tr>";
          $conttm++;
        }
      }
	mysql_free_result($consultatermed);
	?>
  </table>

  <table class="Tbl0"><tr><td class="Td0" align='center'>OTROS SERVICIOS</td></tr></table>
  <table class='Tbl0'>
    <th class='Th0' width='2%'>Fac</th>
    <th class='Th0' width='2%'>No F</th>
    <th class='Th0' width='8%'>Código</th>
    <th class='Th0' width='30%'>Descripción</th>
    <th class='Th0' width='25%'>Servicio</th>
    <th class='Th0' width='13%'>Fecha</th>
    <th class='Th0' width='5%'>Cant</th>
    <th class='Th0' width='15%'>Profesional</th>
  	<?
	//Aqui hago el listado de varios
	$conts=0;
  
  //Destipos, grupo 30 debe estar con el codigo de la tabla cups 
  $consultaord="SELECT iden_ord,id_ing,orde_ord,fech_ord,hora_ord,desc_cama,nom_medi,codigo,cod_servicio,descrip_ord
  FROM vista_ordenvarias 
  WHERE grupo_ord='30' AND fact_ord='' AND id_ing='$id_ing' AND orde_ord<>'3011' AND orde_ord<>'3012' AND esta_ord='SO'";
  if(!empty($servicio)){
    $consultaord=$consultaord." AND cod_servicio='$servicio'";
  }
  $consultaord=$consultaord." ORDER BY fech_ord";
  //echo "<br>".$consultaord;
	$consultaord=mysql_query($consultaord);
	while($roword=mysql_fetch_array($consultaord)){
    //$servicio=$roword[valo_des];
    $servicio=$roword[cod_servicio];
	  echo "<tr>";
	  $var="iden_ser".$conts;
	  echo "<input type='hidden' name='$var' value='$roword[iden_ord]'>";
	  $var="chkser".$conts;
	  echo "<td class='Td2'><input type='checkbox' name='$var' onclick='actiser($conts)'></td>";
	  $var="chknfser".$conts;
	  echo "<td class='Td2'><input type='checkbox' name='$var' onclick='actiser($conts)'></td>";
	  $var="codi_ser".$conts;
	  echo "<td class='Td2'><input type='hidden' name='$var' size='8'>$roword[codigo]	</td>";
    $var="desc_ser".$conts;
    
    $consultacon="SELECT iden_tco,codi_map,codi_cup,descrip,esta_tco
    FROM vista_tarco
    WHERE esta_tco='AC' AND iden_ctr='$iden_ctr' AND codi_cup='$roword[codigo]'";
    //echo "<br>".$consultacon;
	  echo "<td class='Td2'><select name='$var' onchange='validaser($conts)' disabled>
	    <option value=''>";
		$consultacon=mysql_query($consultacon);
    while($rowcon=mysql_fetch_array($consultacon)){
		  echo "<option value='$rowcon[iden_tco]'>".SUBSTR($rowcon[descrip],0,40);
		}
		mysql_free_result($consultacon);
	  echo "</select></td>";
	  echo "<td class='Td2'>$font $roword[nomb_des]";

    $var="servicio_ser".$conts;
    //echo $var;
    echo "<input type='hidden' name='$var' value='$servicio'>$roword[descrip_ord]"; 
    echo "</td>";
	  echo "<td class='Td2'>$font".cambiafechadmy($roword[fech_ord]).' - '.$roword[hora_ord];
    //$var="fecha_ser".$conts;
    //echo $var;
    //echo "<input type='hidden' name='$var' value='".cambiafechadmy($roword[fech_ord])."'>";

    echo "</td>";
	  echo "<td class='Td2'>$font 1</td>";
	  echo "<td class='Td2'>$font".$roword[nom_medi]."</td>";
	  echo "</tr>";
	  $conts++;
	}
	mysql_free_result($consultaord);
	?>
  </table>
  <br>
  <table class='Tbl2'>
    <tr>
        <td class='Td1' width='5%'></td>
        <td class='Td1' width='30%'><a href='#' onclick='validag(<?echo $conte;?>)'><img hspace=0 width=20 height=20 src='icons/feed_disk.png' alt='Subir los elementos seleccionados' border=0 align='center'>Subir Prefactura</a></td>
  	<td class='Td1' width='30%'><a href="fac_2prefac.php?id_ing=<?echo $id_ing;?>">Finalizar<img hspace=0 width=20 height=20 src='icons/feed.png' alt='Cancelar' border=0 align='center'></a></td>
        <td class='Td1' width='30%'><a href='fondo.php'>Cancelar<img hspace=0 width=20 height=20 src='icons/feed.png' alt='Cancelar' border=0 align='center'></a></td>
	<td class='Td1' width='5%'></td>
    </tr>
  </table>
  <input type='hidden' name='id_ing' value='<?echo $id_ing;?>'>
  <input type='hidden' name='conte' value='<?echo $conte;?>'>
  <input type='hidden' name='contc' value='<?echo $contc;?>'>
  <input type='hidden' name='conta' value='<?echo $conta;?>'>
  <input type='hidden' name='conts' value='<?echo $conts;?>'>
  <input type='hidden' name='contv' value='<?echo $contv;?>'>
  <input type='hidden' name='contt' value='<?echo $contt;?>'>
  <input type='hidden' name='contti' value='<?echo $contti;?>'>
  <input type='hidden' name='conttm' value='<?echo $conttm;?>'>
  <input type='hidden' name='codi_usu' value='<?echo $row[codi_usu];?>'>
  <script language='javascript'>
  form1.iden_ctr.value='<?echo $iden_ctr;?>';
  form1.tipo_fac.value='<?echo $tipo_fac;?>';
  form1.cod_cie10.value='<?echo $cod_cie10;?>';
  form1.enti_fac.value='<?echo $enti_fac;?>';
  form1.servicio.value='<?echo $servicio;?>';
  </script>
  <?
}
mysql_free_result($consulta);
mysql_close();
?>

</form>
</body>
</html>

<!--
  insumos de terapia
  terapia_insumos
  terapia_evolucion
  terapia_salinsu
--><html><head></head><body></body></html>