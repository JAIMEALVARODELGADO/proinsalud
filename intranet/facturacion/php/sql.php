
<?php

////////////////////////////////////  SQL DE CONSULTA  MEDICA
function sq01($Gideusu) 
{
/*
Consulta que permite saber si es la primera consulta en el año 
*/
$sql1="SELECT idus_ehi, feco_ehi, numc_ehi,cous_ehi FROM encabesadohistoria where cous_ehi='$Gideusu'";
return $sql1;
 }
	 
function sq02($tmp_table,$indx,$campo) 
{
/*
Consulta que permite recopilar la informacion  las pestaña 
*/
$sql2="SELECT id, campo FROM ".$tmp_table." where indx='$indx'and id like '%$campo%' order by id";
return $sql2;

 }
	 
function sq03() 
{
/*
Consulta que lista las areas 
*/
$sql3="Select cod_areas,nom_areas From areas Order By nom_areas";
return $sql3;

 }

function sq03a() 
{
/*
Consulta que lista las areas 
*/
$sql3="Select cod_areas,nom_areas From areas, area_online where cod_areas=care_line  Order By nom_areas";
return $sql3;

 }
 
	
function sq04($Gcod_medico) 
{
/*
Consulta que lista los medico
*/
$sql4="SELECT * FROM medicos where cod_medi=$Gcod_medico";
return $sql4;

 }

function sq05($Garea) 
{
/*
Consulta un codigo de area
*/
$sql5="Select cod_areas,nom_areas From areas where cod_areas='$Garea'Order By nom_areas";
return $sql5;

 }

 function sq06($Gideusu,$Gcod_medico,$Gfecha,$est,$Garea,$Gserial) 
{
/*
cambia el estado en citas 
*/

$num="5";

$pagi31="SELECT id_cita, Idusu_citas,Esta_cita,descrip_estaci, Cotra_citas, nom_areas,nom_medi,citas.Clase_citas,horarios.Cserv_horario, horarios.Fecha_horario,horarios.Hora_horario,horarios.Cmed_horario, citas.Idusu_citas,citas.Esta_cita FROM horarios,citas,areas,medicos,esta_cita  where cod_estaci=Esta_cita and  Idusu_citas=$Gideusu and Cmed_horario=$Gcod_medico and Clase_citas<=$num and  horarios.ID_horario = citas.ID_horario and cod_areas=Cserv_horario and cod_medi =Cmed_horario and Fecha_horario='$Gfecha'"; 

if ($Garea=="04"){
	$pagi31="SELECT id_cita, Idusu_citas,Esta_cita,descrip_estaci, Cotra_citas, nom_areas,nom_medi,citas.Clase_citas,horarios.Cserv_horario, horarios.Fecha_horario,horarios.Hora_horario,horarios.Cmed_horario, citas.Idusu_citas,citas.Esta_cita FROM horarios,citas,areas,medicos,esta_cita  where cod_estaci=Esta_cita and  Idusu_citas=$Gideusu and Cmed_horario=1101 and Clase_citas<=$num and  horarios.ID_horario = citas.ID_horario and cod_areas=Cserv_horario and cod_medi =Cmed_horario and Fecha_horario='$Gfecha' and Esta_cita<>'2'"; 
}
if ($Garea=="01"){
	$pagi31="SELECT id_cita, Idusu_citas,Esta_cita,descrip_estaci, Cotra_citas, nom_areas,nom_medi,citas.Clase_citas,horarios.Cserv_horario, horarios.Fecha_horario,horarios.Hora_horario,horarios.Cmed_horario, citas.Idusu_citas,citas.Esta_cita FROM horarios,citas,areas,medicos,esta_cita  where cod_estaci=Esta_cita and  Idusu_citas=$Gideusu and Cmed_horario=$Gcod_medico and Clase_citas<=$num and  horarios.ID_horario = citas.ID_horario and cod_areas=Cserv_horario and cod_medi =Cmed_horario and Fecha_horario='$Gfecha'"; 
}

if ($Garea=="81"){
	$pagi31="SELECT id_cita, Idusu_citas,Esta_cita,descrip_estaci, Cotra_citas, nom_areas,nom_medi,citas.Clase_citas,horarios.Cserv_horario, horarios.Fecha_horario,horarios.Hora_horario,horarios.Cmed_horario, citas.Idusu_citas,citas.Esta_cita FROM horarios,citas,areas,medicos,esta_cita  where cod_estaci=Esta_cita and  Idusu_citas=$Gideusu and Cmed_horario=1102229 and Clase_citas<=$num and  horarios.ID_horario = citas.ID_horario and cod_areas=Cserv_horario and cod_medi =Cmed_horario and Fecha_horario='$Gfecha' and Esta_cita<>'2'"; 
}



$pagi41=mysql_query($pagi31);
while($rowYx = mysql_fetch_array($pagi41)){ 
$ate=$rowYx["descrip_estaci"];
$a=$rowYx["id_cita"];

}
if ($ate<>"ATENDIDA"){ 
$sSQL21="Update citas Set Esta_cita ='$est' Where id_cita='$a'";
mysql_query($sSQL21);
$sSQL21a="Update citas Set consul_cita='$Gserial' Where id_cita='$a'";
mysql_query($sSQL21a);
 }
 
 
 
 }
 
  function sq07() 
{
/*
consulta CAUSA EXTERNA 
*/
$sql7="Select codi_des ,codt_des ,nomb_des ,valo_des    From destipos where codt_des =12 Order By codi_des "; 
return $sql7;
 }
	
	
  function sq08() 
{
/*
consulta CONTINGENCIA
*/
$sql8="Select codi_des ,codt_des ,nomb_des ,valo_des    From destipos where codt_des =13 Order By codi_des"; 
return $sql8;	
}	
  function sq08a() 
{
/*
consulta causa externa
*/
$sql8a="Select codi_des ,codt_des ,nomb_des ,valo_des  From destipos where codt_des =11 Order By codi_des"; 
return $sql8a;	
}	



  function sq09($Gideusu,$Gseldx) 
{
/*
consulta los antecedentes de un usuario
*/
$sql9="SELECT idus_apa, codi_apa, feca_apa, numc_apa, obse_apa   FROM antepatologicos  WHERE (((idus_apa)= '$Gideusu') AND ((codp_apa)='$Gseldx') )"; 
return $sql9;	
}

function sq10($dx,$Gseldx,$Gseldx1,$Gseldx2,$Gseldx3) 
{
/*
lista ayudas del protocolo seleccionadas
*/
$sql10="SELECT protocolos.codi_pcl, coma_apr, coci_pcl , nomb_apr, sexo_apr FROM ayuda_protocolo INNER JOIN protocolos ON ayuda_protocolo.codi_pcl = protocolos.codi_pcl where (coci_pcl='$Gseldx' or coci_pcl='$Gseldx1' or  coci_pcl='$Gseldx2' or coci_pcl='$Gseldx3') and coma_apr='$dx'  GROUP  BY coma_apr "; 
return $sql10;	
}

function sq11($Gseldx,$Gseldx1,$Gseldx2,$Gseldx3) 
{
/*
lista ayudas del protocolo 
*/
$sql11="SELECT protocolos.codi_pcl, coma_apr, coci_pcl , nomb_apr, sexo_apr FROM ayuda_protocolo INNER JOIN protocolos ON ayuda_protocolo.codi_pcl = protocolos.codi_pcl where coci_pcl='$Gseldx' or coci_pcl='$Gseldx1' or  coci_pcl='$Gseldx2' or coci_pcl='$Gseldx3' GROUP  BY  coma_apr  "; 
return $sql11;	
}

function sq12($Gdxpyp,$pyp) 
{
/*
lista ayudas seleccionadas  del protocolo pyp
*/
$sql12="SELECT protocolos.codi_pcl, protocolos.nomb_pcl, ayuda_protocolo.coma_apr, ayuda_protocolo.nomb_apr, tblobpyp.strrango,sexo_apr FROM (protocolos INNER JOIN ayuda_protocolo ON protocolos.codi_pcl = ayuda_protocolo.codi_pcl) INNER JOIN tblobpyp ON ayuda_protocolo.codi_pcl = tblobpyp.STRCODIGO  WHERE tblobpyp.strrango='$Gdxpyp' and coma_apr='$pyp'"; 
return $sql12;	
}

function sq13($Gdxpyp) 
{
/*
lista ayudas del protocolo pyp
*/
$sql13="SELECT protocolos.codi_pcl, protocolos.nomb_pcl, ayuda_protocolo.coma_apr, ayuda_protocolo.nomb_apr, tblobpyp.strrango,sexo_apr FROM (protocolos INNER JOIN ayuda_protocolo ON protocolos.codi_pcl = ayuda_protocolo.codi_pcl) INNER JOIN tblobpyp ON ayuda_protocolo.codi_pcl = tblobpyp.STRCODIGO WHERE tblobpyp.strrango='$Gdxpyp'"; 
return $sql13;	
}

function sq14($selayu) 
{
/*
lista ayudas seleciconadas
*/
$sql14="SELECT codi_map, nomb_map , sexo_map, tipo_map  FROM mapipos WHERE  codi_map='$selayu'";

return $sql14;	
}

function sq15($tmp_table,$dea) 
{
/*
lista ayudas seleciconadas para eliminar
*/
$sql15="select id,campo,indx from $tmp_table WHERE indx='H' and campo='$dea'";
return $sql15;	
}

function sq16($tmp_table) 
{
/*
lista ayudas seleciconadas para eliminar
*/
$sql16="select id,campo,indx from $tmp_table WHERE indx='H' ";
return $sql16;	
}

function sq17($tmp_table,$deref) 
{
/*
lista ayudas seleciconadas para eliminar
*/
$sql17="select id,campo,indx from $tmp_table WHERE indx='K' and campo='$deref'";
return $sql17;	
}

function sq18($tmp_table) 
{
/*
lista ayudas seleciconadas para eliminar
*/
$sql18="select id,campo,indx from $tmp_table WHERE indx='K' ";
return $sql18;	
}


function sq19($tmp_table,$deay) 
{
/*
lista ayudas seleciconadas para eliminar
*/
$sql19="select id,campo,indx from $tmp_table WHERE indx='O' and campo='$deay'";
return $sql19;	
}

function sq20($tmp_table) 
{
/*
lista ayudas seleciconadas para eliminar
*/
$sql20="select id,campo,indx from $tmp_table WHERE indx='O' ";
return $sql20;	
}

function sq21($tmp_table,$demed) 
{
/*
lista ayudas seleciconadas para eliminar
*/
$sql21="select id,campo,indx from $tmp_table WHERE indx='R' and campo='$demed'";
return $sql21;	
}

function sq22($tmp_table) 
{
/*
lista ayudas seleciconadas para eliminar
*/
$sql22="select id,campo,indx from $tmp_table WHERE indx='R' ";
return $sql22;	
}

function sq23($tmp_table,$dea) 
{
/*
lista ayudas seleciconadas para eliminar
*/
$sql23="select id,campo,indx from $tmp_table WHERE indx='3' and campo='$dea'";
return $sql23;	
}
function sq24($tmp_table) 
{
/*
lista ayudas seleciconadas para eliminar
*/
$sql24="select id,campo,indx from $tmp_table WHERE indx='3' ";
return $sql24;	
}

function sq25($tmp_table, $selarre1) 
{
/*
lista ayudas seleciconadas para eliminar
*/
$sql25="select id,campo,indx from $tmp_table WHERE indx='9' and campo='$selarre1'";
return $sql25;	
}

function sq26($tmp_table) 
{
/*
lista ayudas seleciconadas para eliminar
*/
$sql26="select id,campo,indx from $tmp_table WHERE indx='9' ";
return $sql26;	
}

function sq27($tmp_table, $selarre) 
{
/*
lista ayudas seleciconadas para eliminar
*/
$sql27="select id,campo,indx from $tmp_table WHERE indx='7' and campo='$selarre'";
return $sql27;	
}

function sq28($tmp_table) 
{
/*
lista ayudas seleciconadas para eliminar
*/
$sql28="select id,campo,indx from $tmp_table WHERE indx='7' ";
return $sql28;	
}

function sq29($tmp_table, $selarre2) 
{
/*
lista ayudas seleciconadas para eliminar
*/
$sql29="select id,campo,indx from $tmp_table WHERE indx='¿' and campo='$selarre2'";
return $sql29;	
}

function sq30($tmp_table) 
{
/*
lista ayudas seleciconadas para eliminar
*/
$sql30="select id,campo,indx from $tmp_table WHERE indx='¿' ";
return $sql30;	
}








function inserp1($tmp_table,$nacu,$dacu,$tacu,$mconsulta,$eactual,$rsistema,$rayuda,$fconsulta,$hconsulta,$obser) 
{ 
 mysql_query("DELETE  from $tmp_table WHERE indx='A'");
 mysql_query("insert into $tmp_table (id, campo,indx) values ('A1','$nacu','A')");
 mysql_query("insert into $tmp_table (id, campo,indx) values ('A2','$dacu','A')");
 mysql_query("insert into $tmp_table (id, campo,indx) values ('A3','$tacu','A')");
 mysql_query("insert into $tmp_table (id, campo,indx) values ('A4','$mconsulta','A')");
 mysql_query("insert into $tmp_table (id, campo,indx) values ('A5','$eactual','A')");
 mysql_query("insert into $tmp_table (id, campo,indx) values ('A6','$rsistema','A')");
 mysql_query("insert into $tmp_table (id, campo,indx) values ('A7','$rayuda','A')");
 mysql_query("insert into $tmp_table (id, campo,indx) values ('A8','$fconsulta','A')");
 mysql_query("insert into $tmp_table (id, campo,indx) values ('A9','$hconsulta','A')");
 mysql_query("insert into $tmp_table (id, campo,indx) values ('Aa1','$obser','A')");	
 }

function inserp1a($tmp_table,$rayuda) 
{ 

 mysql_query("DELETE  from $tmp_table WHERE id='A7'");
 mysql_query("insert into $tmp_table (id, campo,indx) values ('A7','$rayuda','A')");
	
 }




 function inserp2($tmp_table,$ocupa,$toxi,$fami,$gesta,$partos,$cesareas,$abortos,$vivos,$mortinatos,$mes,$ano,$otros,$dia) 
{ 


 mysql_query("DELETE  from $tmp_table WHERE indx='B'");
 mysql_query("insert into $tmp_table (id, campo,indx) values ('B1','$ocupa','B')");
 mysql_query("insert into $tmp_table (id, campo,indx) values ('B2','$toxi','B')");
 mysql_query("insert into $tmp_table (id, campo,indx) values ('B3','$fami','B')");
 mysql_query("insert into $tmp_table (id, campo,indx) values ('B4','$gesta','B')");
 mysql_query("insert into $tmp_table (id, campo,indx) values ('B5','$partos','B')");
 mysql_query("insert into $tmp_table (id, campo,indx) values ('B6','$cesareas','B')");
 mysql_query("insert into $tmp_table (id, campo,indx) values ('B7','$abortos','B')");
 mysql_query("insert into $tmp_table (id, campo,indx) values ('B8','$vivos','B')");
 mysql_query("insert into $tmp_table (id, campo,indx) values ('B9','$mortinatos','B')");
 mysql_query("insert into $tmp_table (id, campo,indx) values ('Ba1','$mes','B')");
 mysql_query("insert into $tmp_table (id, campo,indx) values ('Ba2','$ano','B')");
 mysql_query("insert into $tmp_table (id, campo,indx) values ('Ba3','$otros','B')");
 mysql_query("insert into $tmp_table (id, campo,indx) values ('Ba4','$dia','B')");
 }
 
 
  function inserp3($tmp_table,$ta12,$pe12,$ta1,$pe1,$temperatura,$imc,$tension1,$tension2,$frecuenciar,$frecuenciac,$perimetroc,$sintomatico,$sintomaticop,$aspectog,$taspectos,$piel,$tpiel,$craneo,$tcraneo,$ojos,$tojos,$oido,$toido,$cuello,$tcuello,$cardio,$tcardio,$senos,$tsenos,$abdomen,$tabdomen,$genitales,$tgenitales,$rectal,$trectal,$neuro,$tneuro, $osteo,$tosteo,$otrosa)

{ 

 mysql_query("DELETE  from $tmp_table WHERE indx='C'");
 mysql_query("insert into $tmp_table (id, campo,indx) values ('C1','$ta12','C')");
 mysql_query("insert into $tmp_table (id, campo,indx) values ('C2','$pe12','C')");
 mysql_query("insert into $tmp_table (id, campo,indx) values ('C3','$ta1','C')");
 mysql_query("insert into $tmp_table (id, campo,indx) values ('C4','$pe1','C')");
 mysql_query("insert into $tmp_table (id, campo,indx) values ('C5','$temperatura','C')");
 mysql_query("insert into $tmp_table (id, campo,indx) values ('C6','$imc','C')");
 mysql_query("insert into $tmp_table (id, campo,indx) values ('C7','$tension1','C')");
 mysql_query("insert into $tmp_table (id, campo,indx) values ('C8','$tension2','C')");
 mysql_query("insert into $tmp_table (id, campo,indx) values ('C9','$frecuenciar','C')");
 mysql_query("insert into $tmp_table (id, campo,indx) values ('Ca1','$frecuenciac','C')");
 mysql_query("insert into $tmp_table (id, campo,indx) values ('Ca2','$perimetroc','C')");
 mysql_query("insert into $tmp_table (id, campo,indx) values ('Ca3','$sintomatico','C')");
 mysql_query("insert into $tmp_table (id, campo,indx) values ('Ca4','$sintomaticop','C')");
 mysql_query("insert into $tmp_table (id, campo,indx) values ('Ca5','$aspectog','C')");
 mysql_query("insert into $tmp_table (id, campo,indx) values ('Ca6','$taspectos','C')");
 mysql_query("insert into $tmp_table (id, campo,indx) values ('Ca7','$piel','C')");
 mysql_query("insert into $tmp_table (id, campo,indx) values ('Ca8','$tpiel','C')");
 mysql_query("insert into $tmp_table (id, campo,indx) values ('Ca9','$craneo','C')");
 mysql_query("insert into $tmp_table (id, campo,indx) values ('Cb1','$tcraneo','C')");
 mysql_query("insert into $tmp_table (id, campo,indx) values ('Cb2','$ojos','C')");
 mysql_query("insert into $tmp_table (id, campo,indx) values ('Cb3','$tojos','C')");
 mysql_query("insert into $tmp_table (id, campo,indx) values ('Cb4','$oido','C')");
 mysql_query("insert into $tmp_table (id, campo,indx) values ('Cb5','$toido','C')");
 mysql_query("insert into $tmp_table (id, campo,indx) values ('Cb6','$cuello','C')");
 mysql_query("insert into $tmp_table (id, campo,indx) values ('Cb7','$tcuello','C')");
 mysql_query("insert into $tmp_table (id, campo,indx) values ('Cb8','$cardio','C')");
 mysql_query("insert into $tmp_table (id, campo,indx) values ('Cb9','$tcardio','C')");
 mysql_query("insert into $tmp_table (id, campo,indx) values ('Cc1','$senos','C')");
 mysql_query("insert into $tmp_table (id, campo,indx) values ('Cc2','$tsenos','C')");
 mysql_query("insert into $tmp_table (id, campo,indx) values ('Cc3','$abdomen','C')");
 mysql_query("insert into $tmp_table (id, campo,indx) values ('Cc4','$tabdomen','C')");
 mysql_query("insert into $tmp_table (id, campo,indx) values ('Cc5','$genitales','C')");
 mysql_query("insert into $tmp_table (id, campo,indx) values ('Cc6','$tgenitales','C')");
 mysql_query("insert into $tmp_table (id, campo,indx) values ('Cc7','$rectal','C')");
 mysql_query("insert into $tmp_table (id, campo,indx) values ('Cc8','$trectal','C')");
 mysql_query("insert into $tmp_table (id, campo,indx) values ('Cc9','$neuro','C')");
 mysql_query("insert into $tmp_table (id, campo,indx) values ('Cd1','$tneuro','C')");
 mysql_query("insert into $tmp_table (id, campo,indx) values ('Cd2','$osteo','C')");
 mysql_query("insert into $tmp_table (id, campo,indx) values ('Cd3','$tosteo','C')");
 mysql_query("insert into $tmp_table (id, campo,indx) values ('Cd4','$otrosa','C')");

 }
 
  function inserp4($tmp_table,$enfepro,$cexterna,$contingencia,$tdx,$finalidad) 
{ 

 mysql_query("DELETE  from $tmp_table WHERE indx='D'");
 mysql_query("insert into $tmp_table (id, campo,indx) values ('D1','$enfepro','D')");
 mysql_query("insert into $tmp_table (id, campo,indx) values ('D2','$cexterna','D')");
 mysql_query("insert into $tmp_table (id, campo,indx) values ('D3','$contingencia','D')");
 mysql_query("insert into $tmp_table (id, campo,indx) values ('D4','$tdx','D')");
 mysql_query("insert into $tmp_table (id, campo,indx) values ('D5','$finalidad','D')");	
 }
 
  function inserp41($tmp_table,$Gseldx,$Gdesdx) 
{ 
 mysql_query("DELETE  from $tmp_table WHERE id='E5'");
 mysql_query("insert into $tmp_table (id, campo,indx) values ('E5','$Gseldx','E')");
 mysql_query("insert into $tmp_table (id, campo,indx) values ('Ea1','$Gdesdx','E')");
 }

  function inserp42($tmp_table,$Gseldx1,$Gdesdx1) 
{ 
 mysql_query("DELETE  from $tmp_table WHERE id='E6'");
 mysql_query("insert into $tmp_table (id, campo,indx) values ('E6','$Gseldx1','E')");
  mysql_query("insert into $tmp_table (id, campo,indx) values ('Ea2','$Gdesdx1','E')");
 }

  function inserp43($tmp_table,$Gseldx2,$Gdesdx2) 
{ 
 mysql_query("DELETE  from $tmp_table WHERE id='E7'");
 mysql_query("insert into $tmp_table (id, campo,indx) values ('E7','$Gseldx2','E')");
 mysql_query("insert into $tmp_table (id, campo,indx) values ('Ea3','$Gdesdx2','E')");
 } 
 
   function inserp44($tmp_table,$Gseldx3,$Gdesdx3) 
{ 
 mysql_query("DELETE  from $tmp_table WHERE id='E8'");
 mysql_query("insert into $tmp_table (id, campo,indx) values ('E8','$Gseldx3','E')");
 mysql_query("insert into $tmp_table (id, campo,indx) values ('Ea4','$Gdesdx3','E')");
 }

   function inserp45($tmp_table,$Gdxpyp) 
{ 
mysql_query("DELETE  from $tmp_table WHERE id='E9'");
mysql_query("insert into $tmp_table (id, campo,indx) values ('E9','$Gdxpyp','E')");
 } 
 
    function inserp46($tmp_table,$Gobdx) 
{ 
mysql_query("DELETE  from $tmp_table WHERE id='E10'");
mysql_query("insert into $tmp_table (id, campo,indx) values ('E10','$Gobdx','E')");
 } 
 
  function inserp5($tmp_table,$apyp,$g) 
{ 
 //arreglos
 $F="F".$g;
 mysql_query("insert into $tmp_table (id, campo,indx) values ('$F','$apyp','F')");
 } 
   
   function inserp5a($tmp_table,$aobpyp,$ga) 
{ 
 //arreglos
 $F="|".$ga;
 mysql_query("insert into $tmp_table (id, campo,indx) values ('$F','$aobpyp','|')");
 } 
 
 
   function inserp6($tmp_table,$apdx,$g) 
{ 
 $G="G".$g;
 mysql_query("insert into $tmp_table (id, campo,indx) values ('$G','$apdx','G')");
 } 
 
    function inserp6a($tmp_table,$aobpyp1,$ga) 
{ 
 $G=">".$ga;
 mysql_query("insert into $tmp_table (id, campo,indx) values ('$G','$aobpyp1','>')");
 } 
 
 
   function inserp7($tmp_table,$selayu,$Gnu) 
{ 
 $H="H".$Gnu;
 mysql_query("insert into $tmp_table (id, campo,indx) values ('$H','$selayu','H')");
 } 
  function inserp8($tmp_table,$dx,$con) 
{ 
 $H="I".$con;
 mysql_query("insert into $tmp_table (id, campo,indx) values ('$H','$dx','I')");

 }
 
   function inserp9($tmp_table,$da,$cony) 
{ 
 $H="J".$cony;
 mysql_query("insert into $tmp_table (id, campo,indx) values ('$H','$da','J')");

 }
  
   function inserp10($tmp_table,$servicio,$dir) 
{ 
 $H="K".$dir;
 mysql_query("insert into $tmp_table (id, campo,indx) values ('$H','$servicio','K')");

 }
 
    function inserp11($tmp_table,$Dxref,$dir) 
{ 
 $H="L".$dir;
 mysql_query("insert into $tmp_table (id, campo,indx) values ('$H','$Dxref','L')");

 }
 
     function inserp12($tmp_table,$motref,$b) 
{ 
 $H="N".$b;
 mysql_query("insert into $tmp_table (id, campo,indx) values ('$H','$motref','N')");

 }
     function inserp13($tmp_table,$teref,$c) 
{ 
 $H="M".$c;
 mysql_query("insert into $tmp_table (id, campo,indx) values ('$H','$teref','M')");

 }
 
    function inserp14($tmp_table,$seleccionaex1,$diray) 
{ 
 $H="O".$diray;
 mysql_query("insert into $tmp_table (id, campo,indx) values ('$H','$seleccionaex1','O')");

 }
 
      function inserp15($tmp_table,$motay,$b1) 
{ 
 $H="P".$b1;
 mysql_query("insert into $tmp_table (id, campo,indx) values ('$H','$motay','P')");

 }
       function inserp16($tmp_table,$dx,$d) 
{ 
 $H="Q".$d;
 mysql_query("insert into $tmp_table (id, campo,indx) values ('$H','$dx','Q')");

 }
 
        function inserp17($tmp_table,$seleccionmex1,$dirme) 
{ 
 $H="R".$dirme;
 mysql_query("insert into $tmp_table (id, campo,indx) values ('$H','$seleccionmex1','R')");

 }
 
        function inserp18($tmp_table,$dx2,$d2) 
{ 
 $H="S".$d2;
 mysql_query("insert into $tmp_table (id, campo,indx) values ('$H','$dx2','S')");

 }

        function inserp19($tmp_table,$cati,$b3) 
{ 
 $H="T".$b3;
 mysql_query("insert into $tmp_table (id, campo,indx) values ('$H','$cati','T')");

 }

         function inserp20($tmp_table,$pos,$c3) 
{ 
 $H="U".$c3;
 mysql_query("insert into $tmp_table (id, campo,indx) values ('$H','$pos','U')");

 }
 
          function inserp21($tmp_table,$mot,$cs4) 
{ 
 $H="V".$cs4;
 mysql_query("insert into $tmp_table (id, campo,indx) values ('$H','$mot','V')");

 }
 
   function inserp22($tmp_table,$apyp,$g) 
{ 
 //arreglos
 $F="W".$g;
 mysql_query("insert into $tmp_table (id, campo,indx) values ('$F','$apyp','W')");
 } 
 
    function inserp23($tmp_table,$mp1,$g1) 
{ 
 //arreglos
 $F="X".$g1;
 mysql_query("insert into $tmp_table (id, campo,indx) values ('$F','$mp1','X')");
 } 

     function inserp24($tmp_table,$mp2,$g2) 
{ 
 //arreglos
 $F="Y".$g2;
 mysql_query("insert into $tmp_table (id, campo,indx) values ('$F','$mp2','Y')");
 } 
 
 
   function inserp25($tmp_table,$apyp,$g) 
{ 
 //arreglos
 $F="Z".$g;
 mysql_query("insert into $tmp_table (id, campo,indx) values ('$F','$apyp','Z')");
 } 
 
    function inserp26($tmp_table,$mp1,$g1) 
{ 
 //arreglos
 $F="1".$g1;
 mysql_query("insert into $tmp_table (id, campo,indx) values ('$F','$mp1','1')");
 } 

     function inserp27($tmp_table,$mp2,$g2) 
{ 
 //arreglos
 $F="2".$g2;
 mysql_query("insert into $tmp_table (id, campo,indx) values ('$F','$mp2','2')");
 } 
 
      function inserp28($tmp_table,$seleccionmedi,$Gnu) 
{ 
 //arreglos
 $F="3".$Gnu;
 mysql_query("insert into $tmp_table (id, campo,indx) values ('$F','$seleccionmedi','3')");
 } 
 
      function inserp29($tmp_table,$dx,$d) 
{ 
 //arreglos
 $F="4".$d;
 mysql_query("insert into $tmp_table (id, campo,indx) values ('$F','$dx','4')");
 }  
 
       function inserp30($tmp_table,$da,$d1) 
{ 
 //arreglos
 $F="5".$d1;
 mysql_query("insert into $tmp_table (id, campo,indx) values ('$F','$da','5')");
 } 
 
       function inserp31($tmp_table,$da11,$d2) 
{ 
 //arreglos
 $F="6".$d2;
 mysql_query("insert into $tmp_table (id, campo,indx) values ('$F','$da11','6')");
 } 
 
        function inserp32($tmp_table,$seleccion,$Gnu) 
{ 
 //arreglos
 $F="7".$Gnu;
 mysql_query("insert into $tmp_table (id, campo,indx) values ('$F','$seleccion','7')");
 } 
 
         function inserp33($tmp_table,$obsv,$Gnu1) 
{ 
 //arreglos
 $F="8".$Gnu1;
 mysql_query("insert into $tmp_table (id, campo,indx) values ('$F','$obsv','8')");
 } 
 
         function inserp34($tmp_table,$seleccionq,$Gnuq) 
{ 
 //arreglos
 $F="9".$Gnuq;
 mysql_query("insert into $tmp_table (id, campo,indx) values ('$F','$seleccionq','9')");
 }  
 
         function inserp35($tmp_table,$obsvq,$Gnuq1) 
{ 
 //arreglos
 $F="?".$Gnuq1;
 mysql_query("insert into $tmp_table (id, campo,indx) values ('$F','$obsvq','?')");
 }   
 

         function inserp36($tmp_table,$selecciont,$Gnut) 
{ 
 //arreglos
 $F="¿".$Gnut;
 mysql_query("insert into $tmp_table (id, campo,indx) values ('$F','$selecciont','¿')");
 }    
          function inserp37($tmp_table,$obsvt,$Gnut1) 
{ 
 //arreglos
 $F="¡".$Gnut1;
 mysql_query("insert into $tmp_table (id, campo,indx) values ('$F','$obsvt','¡')");
 }    
 
           function inserp38($tmp_table,$control) 
{ 
 //arreglos
 $F="-"."1";
 mysql_query("insert into $tmp_table (id, campo,indx) values ('$F','$control','-')");
 }   
 
            function inserp39($tmp_table,$obse) 
{ 
 //arreglos
 $F="-"."2";
 mysql_query("insert into $tmp_table (id, campo,indx) values ('$F','$obse','-')");
 }   
 
 
 function del01($tmp_table) 
{ 
 mysql_query("DELETE  from $tmp_table WHERE indx='F'");
 
 } 
 function del02($tmp_table) 
{ 
 mysql_query("DELETE  from $tmp_table WHERE indx='G'");
 
 } 
 
  function del03($tmp_table) 
{ 
 mysql_query("DELETE  from $tmp_table WHERE indx='|'");
 
 } 
 
   function del04($tmp_table) 
{ 
 mysql_query("DELETE  from $tmp_table WHERE indx='>'");
 
 } 
 
 /*	 
	 function sql_base($sql) 
{
para traer sqls de la base de datos
Consulta que permite saber si es la primera consulta en el año 

$pagisql=mysql_query("SELECT Cod_Sql, Des_Sql, Val_Sql FROM sqls where Cod_Sql='$sql'");
while($rowsql = mysql_fetch_array($pagisql)){ 
$sql2=$rowsql["Val_Sql"];

}
$sql3=$sql2;
return $sql3;
 }
	 
	*/ 
	 
 function validar($tmp_table) 
{ 
 mysql_query("select * from $tmp_table");
 
 } 	 
	 
	 
	 


/////////////////////////////////// Fin CONSULTA externa 	 

	 ?>