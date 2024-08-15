<?
session_register('Gareh');
session_register('Gmed');
?>
<HTML>
<style type="text/css"> 
<!-- 
BODY { 
color :#000000;
font-family: Verdana, Arial, Helvetica; 
font-size: 12px; 
background-color:#E6E8FA ; 
background-image: none; 
} 

A:link { TEXT-DECORATION: none; color: #386898 } 
A:visited { TEXT-DECORATION: none; color: #386898 } 
A:hover { TEXT-DECORATION: underline; color: #386898 }.texto_normal 
{ 
font-family: Verdana, Arial, Helvetica, sans-serif; 
font-size: 12px; 
} 
.texto_mini 
{ 
font-family: Verdana, Arial, Helvetica, sans-serif; 
font-size: 12px; 
} 
.texto_big 
{ 
font-family: Verdana, Arial, Helvetica, sans-serif; 
font-size: 12px; 
font-weight: bold; 
} 
SELECT 
{ 
font-family: Verdana, Arial, Helvetica, sans-serif; 
font-size: 10px; 
background-color: #F5F5F5; 
color: #000000; 
} 
TEXTAREA, .tabla_input 
{ 
font-family: Verdana,Arial,Helvetica, sans-serif; 
background-color: #F5F5F5; 
color: #000000; 
font-size: 12px; 
} 
.tabla_titulo 
{ 
color: #FFFFFF; 
background-color: #386898; 
background-image: none; 
font-family: Verdana, Arial, Helvetica, sans-serif; 
font-size: 1px; 
font-weight: bold; 
} 
.texto_titulo 
{ 
color: #FFFFFF; 
font-family: Verdana, Arial, Helvetica, sans-serif; 
font-size: 5px; 
font-weight: bold; 
TEXT-DECORATION: none; 
} 
A.texto_titulo:link, A.texto_titulo:visited 
{ 
color: #FFFFFF; 
TEXT-DECORATION: none; 
} 
A.texto_titulo:hover 
{ 
color: #FFFFFF; 
TEXT-DECORATION: underline; 
} 
.tabla_texto_1, .tabla_sombra_1 
{ 
color: #000000; 
background-color: #FFFFFF; 
background-image: none; 
font-family: Verdana, Arial, Helvetica, sans-serif; 
font-size: 11px; 
TEXT-DECORATION: none; 
} 
.texto_1, .sombra_1 
{ 
color: #000000; 
font-family: Verdana, Arial, Helvetica, sans-serif; 
font-size: 11px; 
TEXT-DECORATION: none; 
} 
A.texto_1:link, A.texto_1:visited, A.sombra_1:link, A.sombra_1:visited 
{ 
color: #A0E8FF; 
TEXT-DECORATION: none; 
} 
A.texto_1:hover, A.sombra_1:hover 
{ 
color: #A0E8FF; 
TEXT-DECORATION: underline; 
} 
.tabla_texto_2, .tabla_sombra_2 
{ 
color: #000000; 
background-color: #DDDDDD; 
background-image: none; 
font-family: Verdana, Arial, Helvetica, sans-serif; 
font-size: 11px; 
TEXT-DECORATION: none; 
} 
.texto_2, .sombra_2 
{ 
color: #000000; 
font-family: Verdana, Arial, Helvetica, sans-serif; 
font-size: 11px; 
TEXT-DECORATION: none; 
} 
A.texto_2:link, A.texto_2:visited, A.sombra_2:link, A.sombra_2:visited 
{ 
color: #306890; 
TEXT-DECORATION: none; 
} 
A.texto_2:hover, A.sombra_2:hover 
{ 
color: #306890; 
TEXT-DECORATION: underline; 
} 
.tabla_categorias 
{ 
color: #FFFFFF; 
background-color: #3F3F3F; 
background-image: none; 
font-family: Verdana, Arial, Helvetica, sans-serif; 
font-size: 12px; 
font-weight: bold; 
TEXT-DECORATION: none; 
} 
.texto_categorias 
{ 
color: #FFFFFF; 
font-family: Verdana, Arial, Helvetica, sans-serif; 
font-size: 12px; 
font-weight: bold; 
TEXT-DECORATION: none; 
} 
A.texto_categorias:link, A.texto_categorias:visited 
{ 
color: #FFFFFF; 
TEXT-DECORATION: none; 
} 
A.texto_categorias:hover 
{ 
color: #FFFFFF; 
TEXT-DECORATION: underline; 
} 
.tabla_boton 
{ 
background-color: #F5F5F5; 
color: #000000; 
border-bottom: e1e1e1 1px outset; 
border-left: ffffff 1px outset; 
border-right: e1e1e1 1px outset; 
border-top: ffffff 1px outset; 
font-family: Verdana, Arial, Helvetica, sans-serif; 
font-size: 10px; 
height: 20px; 
font-weight: bold; 
} 
--> 
</style>





<HEAD>
<TITLE>res_genho.php</TITLE>


<SCRIPT LANGUAGE=JavaScript>
  function carga(page2) {
    parent.Fr2.location.href=page2;
  }
</SCRIPT>



</HEAD>
<BODY bgcolor="#E6E8FA">
<form name="US_Add"  action="ver_hor.php" >
<?

function fechamsq($fecha,$ndias)
            
 
{

           
 
      if (preg_match("/[0-9]{1,2}\/[0-9]{1,2}\/([0-9][0-9]){1,2}/",$fecha))
            
 
              list($dia,$mes,$año)=split("/", $fecha);
            
 
      if (preg_match("/[0-9]{1,2}-[0-9]{1,2}-([0-9][0-9]){1,2}/",$fecha))
            
 
              list($dia,$mes,$año)=split("-",$fecha);
        $nueva = mktime(0,0,0, $mes,$dia,$año) + $ndias * 24 * 60 * 60;
      
         $nuevafecha=date("Y-m-d",$nueva);    
 
      return ($nuevafecha);  
            
 
}

?>



<?

function suma_fechas($fecha,$ndias)
            
 
{

        
 
      if (preg_match("/[0-9]{1,2}\/[0-9]{1,2}\/([0-9][0-9]){1,2}/",$fecha))
            
 
              list($dia,$mes,$año)=split("/", $fecha);
            
 
      if (preg_match("/[0-9]{1,2}-[0-9]{1,2}-([0-9][0-9]){1,2}/",$fecha))
            
 
              list($dia,$mes,$año)=split("-",$fecha);
        $nueva = mktime(0,0,0, $mes,$dia,$año) + $ndias * 24 * 60 * 60;
    
        $nuevafecha=date("d-m-Y",$nueva);    
 
      return ($nuevafecha);  
            
 
}




?>


<?


function DiaSemana  ($fecha,$texto=1) 
  

{ 
    list($dia,$mes,$año) = explode("-",$fecha);
    $numerodiasemana = date('w', mktime(0,0,0,$mes,$dia,$ano));
     
      if ($texto == 0)
        return $numerodiasemana;
      
      switch($numerodiasemana)
      {
      case 0: return "Domingo";
        case 1: return "Lunes";
         case 2: return "Martes";
         case 3: return "Miércoles";
         case 4: return "Jueves";
         case 5: return "Viernes";
         case 6: return "Sábado";
      }
 } 


?>


<?


//Conexion con la base
$con=mysql_connect("localhost","root","")or die (mysql_error()); 

//selección de la base de datos con la que vamos a trabajar 
mysql_select_db("proinsalud",$con) or die (mysql_error()); 


if ($lunes=="lunes")
 { 

//Creamos la sentencia SQL y la ejecutamos
$sSQL="Update semana Set med_seman='$medico' Where dia_seman='$lunes'";
mysql_query($sSQL);

}

else
{

$sSQL="Update semana Set med_seman='' Where dia_seman='lunes'";
mysql_query($sSQL);


}

if ($martes=="martes")
 { 

//Creamos la sentencia SQL y la ejecutamos
$sSQL="Update semana Set med_seman='$medico' Where dia_seman='$martes'";
mysql_query($sSQL);

}

else
{

$sSQL="Update semana Set med_seman='' Where dia_seman='martes'";
mysql_query($sSQL);


}



if ($miercoles=="miercoles")
 { 

//Creamos la sentencia SQL y la ejecutamos

$sSQL="Update semana Set med_seman='$medico' Where dia_seman='$miercoles'";
mysql_query($sSQL);

}

else
{

$sSQL="Update semana Set med_seman='' Where dia_seman='miercoles'";
mysql_query($sSQL);


}


if ($jueves=="jueves")
 { 

//Creamos la sentencia SQL y la ejecutamos
$sSQL="Update semana Set med_seman='$medico' Where dia_seman='$jueves'";
mysql_query($sSQL);

}

else
{

$sSQL="Update semana Set med_seman='' Where dia_seman='jueves'";
mysql_query($sSQL);


}



if ($viernes=="viernes")
 { 

//Creamos la sentencia SQL y la ejecutamos
$sSQL="Update semana Set med_seman='$medico' Where dia_seman='$viernes'";
mysql_query($sSQL);

}

else
{

$sSQL="Update semana Set med_seman='' Where dia_seman='viernes'";
mysql_query($sSQL);


}


if ($sabado=="sabado")
 { 

//Creamos la sentencia SQL y la ejecutamos
$sSQL="Update semana Set med_seman='$medico' Where dia_seman='$sabado'";
mysql_query($sSQL);

}

else
{

$sSQL="Update semana Set med_seman='' Where dia_seman='sabado'";
mysql_query($sSQL);


}




if ($domingo=="domingo")
 { 

//Creamos la sentencia SQL y la ejecutamos
$sSQL="Update semana Set med_seman='$medico' Where dia_seman='$domingo'";
mysql_query($sSQL);

}

else
{

$sSQL="Update semana Set med_seman='' Where dia_seman='domingo'";
mysql_query($sSQL);


}


mysql_query("DELETE FROM tmp_horarios");
mysql_query("DELETE FROM tbldiasw");
mysql_query("DELETE FROM tblcitas");
mysql_query("DELETE FROM tblhoras");
mysql_query("DELETE FROM tmp_horariosf");
//mysql_query("DELETE FROM horarios"); borrar horarios

// HASTA AQUI LO QUE ASE ES MARCAR EN LA TABLA SEMANA LOS DIAS QUE VA A TRABAJAR EL MEDICO


// GENERAR LA TABLA DE FECHAS DE CITAS


 
$deffecha = true;

$datem=$date23-1;


while ($datem<$date2){


$f11=suma_fechas($date23,$cont);
           
$fmsql=fechamsq($date23,$cont);

$diax=diasemana($f11);



//echo "$date23 $cont  es  $f11   dia: $diax <br>";

	
//echo " $xdiax <br>";


 

 


mysql_query("insert into tblcitas ( codmed_tbci, fecha_tbci, dia_tbci, area_tbcit, usado_tbci ) values ('$medico','$fmsql','$diax','$Gareh','$V23')");









$datem=$datem+1;
$cont=$cont+1;



}

//Aqui se generan los horarios

$hini=$V20;
$hfi=$V21;
$mini=$V20m;

$hini= $hini;
$mini= $mini;
$res="60"-$V22;

$hinif="";
$minif="";
$ho="";


while ($hinif<$V21 and $minif<=$V21m )
 {


   $conts=$conts+1;
   $sdia=substr($f11,0,-5);
   $xdiax=substr($medico,3);
   $xdiax=$xdiax.$Gareh.$conts.$sdia;


   if ($mini<"60"){ 

       if ($mini != ""){


           $sim=":";
           $fe="0001-01-01 ";
           $ho=$fe.$hini.$sim.$mini;


        }
       else
        {
          $fe="0001-01-01 ";
          $c="00";
          $ho=$fe.$hini.$sim.$c;
        }

          mysql_query("insert into tblhoras ( codmed_tbhor , horas_tbhor, dia_tbhor,id_tbhor  ) values ('$medico','$ho','$diax','$xdiax' )");

     }


    if ($mini>="60"){
 	  	
          $mini="00";
          $hini=$hini+1;
	  	
       }
    else 
       {
         
          $mini=$mini+$V22;

        }



if ($hini==$V21 and $mini==$V21m ){  
        $hinif=$hini;


	}



   if( $mini==$V21m)
       {
       	
	if ($hinif==$V21){
		
	$minif=$mini;
	

        }
   	


       }

}

///////////////fin proceso se generar los horarios







/////////////llena una tabla temporal

$espa=" ";

$Gmed=$medico;
mysql_query("INSERT INTO tbldiasw ( codmed_tbci,fecha_tbci,dia_seman,area_tbc, usado_tbc)
SELECT tblcitas.codmed_tbci, tblcitas.fecha_tbci, semana.dia_seman,  tblcitas.area_tbcit , tblcitas.usado_tbci 
FROM semana
INNER  JOIN tblcitas ON semana.dia_seman = tblcitas.dia_tbci
WHERE ( ( ( semana.med_seman ) <> '$espa' ) )");

 

/////// pasa las tablas temporales a la tabla fija   horarios

mysql_query("INSERT INTO tmp_horarios ( Hora_horario, Fecha_horario,Cmed_horario,dia_horario,Usado_horario,Cserv_horario, ncita_horario  )

SELECT tblhoras. horas_tbhor, tbldiasw.fecha_tbci, tbldiasw.codmed_tbci, tbldiasw.dia_seman, tbldiasw.usado_tbc, tbldiasw.area_tbc,tbldiasw.usado_tbc
FROM tbldiasw INNER JOIN tblhoras ON tbldiasw. codmed_tbci = tblhoras.  codmed_tbhor" )  ;

//// 1

mysql_query("INSERT INTO tmp_horariosf ( Cmed_horario, Cserv_horario, Fecha_horario, Hora_horario, Usado_horario, dia_horario, ID_horario, ncita_horario )
SELECT tmp_horarios.Cmed_horario, tmp_horarios.Cserv_horario, tmp_horarios.Fecha_horario, tmp_horarios.Hora_horario, tmp_horarios.Usado_horario, tmp_horarios.dia_horario, tmp_horarios.ID_horario, tmp_horarios.ncita_horario
FROM tmp_horarios INNER JOIN horarios ON (tmp_horarios.Fecha_horario = horarios.Fecha_horario) AND (tmp_horarios.Cserv_horario = horarios.Cserv_horario) AND (tmp_horarios.Cmed_horario = horarios.Cmed_horario) AND (tmp_horarios.Hora_horario = horarios.Hora_horario)");



$d=mysql_query("select * from tmp_horariosf");




if (mysql_num_rows($d)==0){

mysql_query("INSERT INTO horarios ( Hora_horario, Fecha_horario,Cmed_horario,dia_horario,Usado_horario,Cserv_horario, ncita_horario  )

SELECT tblhoras. horas_tbhor, tbldiasw.fecha_tbci, tbldiasw.codmed_tbci, tbldiasw.dia_seman, tbldiasw.usado_tbc, tbldiasw.area_tbc,tbldiasw.usado_tbc
FROM tbldiasw INNER JOIN tblhoras ON tbldiasw. codmed_tbci = tblhoras.  codmed_tbhor" )  ;


}

else 

/////2
{

mysql_query("INSERT INTO horarios ( Cmed_horario, Cserv_horario, Fecha_horario, Hora_horario, Usado_horario, dia_horario, ncita_horario)
SELECT tmp_horarios.Cmed_horario, tmp_horarios.Cserv_horario, tmp_horarios.Fecha_horario, tmp_horarios.Hora_horario, tmp_horarios.Usado_horario, tmp_horarios.dia_horario, tmp_horarios.ncita_horario
FROM tmp_horarios LEFT JOIN tmp_horariosf ON tmp_horarios.ID_horario = tmp_horariosf.ID_horario
WHERE (((tmp_horariosf.ID_horario) Is Null))");

}





?>

<p>
<p>
<p>
<p>
<p>
<p>
<p>
<p>
<p>
<p>
<p>
<p>

<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>

<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>


<CENTER><h2>Horarios Creados Satisfactoriamente</h2><CENTER>

<br>

<a onclick="carga('ver_hor.php')"><input type=submit value="Ver Horarios Generados">

</form>




</BODY>
</HTML> 