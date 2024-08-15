<HTML>
<HEAD>
	<link rel="stylesheet" href="css/style.css" type="text/css" />
      <script language='Javascript'>
      function ver1(form,a)
      {
          
		  form.cuenta.value=(10/1)*a/1;
          form.target='';
          form.action='buscacup.php';
          form.submit();
      }
      function ver3(form)
      {
         
		 form.producto1.value='';
         form.producto.value='';
         form.target='';
         form.action='gen_rips_hospi.php';
		 form.submit();
      }
      function ver(valor,nombre,form)
      {
        j=form.mcu.value;
		k=form.it.value;
		l=form.jt.value;
		
		ref="form.cod"+k+l+j+".value=valor.value";
		eval(ref);
		ref="form.codcp1"+k+l+j+".value=nombre.value";
		eval(ref);
		form.mcu.value=(form.mcu.value/1)+1/1;
		form.target='';
		form.action='gen_rips_hospi.php';
		form.submit();
      }         
      </script>
</HEAD>
<BODY>
<?
	//echo $codcp1;

	if(empty($cuenta))$cuenta=0;
		$producto1=trim($codcp1);
		$cadena1='%'.$producto1.'%';
	
	$link=Mysql_connect("localhost","root","");
	if(!$link)echo"no hay conexion";
	Mysql_select_db('proinsalud',$link);
	
		$cad="SELECT *FROM `cups`WHERE prmt_cup='13' AND esta_cup='AC' AND `descrip` LIKE '$cadena1' or `descrip` = '$cadena1'";
		$resul=Mysql_query($cad,$link);

		echo"<form name=busca method=post action=gen_rips.php target=''>";
		echo "<input type=hidden name=it value=$it>";
		echo "<input type=hidden name=jt value=$jt>";
		for($i=0;$i<$mcu;$i++)
		{
			$nomvar='selec'.$it.$jt.$i;
			$sel=$$nomvar;	
			$nomvar='cod'.$it.$jt.$i;
			$cod=$$nomvar;	
			$nomvar='chk_rem'.$it.$jt.$i;
			$chk_rem=$$nomvar;
			
			$nomvar='selec'.$it.$jt.$i;
			echo"<input type=hidden name=$nomvar value=$sel>";
			$nomvar='cod'.$it.$jt.$i;
			echo"<input type=hidden name=$nomvar value=$cod>";
			$nomvar='chk_rem'.$it.$jt.$i;
			echo"<input type=hidden name=$nomvar value='$chk_rem'>";
				
		}
		$nomvar='cod'.$it.$jt.$mcu;
		$cod=$$nomvar;
		echo"<input type=hidden name=$nomvar value='$cod'>";
		
		$nomvar='codcp1'.$it.$jt.$mcu;
		$codcp12=$$nomvar;
		echo"<input type=hidden name=$nomvar value='$codcp12'>";
		
		$nomvar='selec'.$it.$jt.$mcu;
		echo"<input type=hidden name=$nomvar value='1'>";
		
		$nomvar='chk_rem'.$it.$jt.$mcu;
		$chk_rem=$$nomvar;
		echo"<input type=hidden name=$nomvar value='$chk_rem'>";
		
		echo "<input type=hidden name=idein value=$idein>";
		echo"<input type=hidden name=mcu value=$mcu>";
//////////////////////////////////////////////BUSQUEDA DE CUPS ////////////////////////////////////////////////
		echo"<br><br>
		<table align=center width=70% >
		<tr bgcolor=#BED1DB>
		<td align=center><font FACE=arial color=#000000 size=2><b>MOTOR DE BUSQUEDA LABORATORIOS</b></FONT></td>
		</tr>
		</table>
		
		<br><br>
		<table align=center width=80% >
		<tr>
		<td> 
		<table align=center width=80%  cellspacing=0 cellpadding=0 border=1>
		<tr BGCOLOR=#BED1DB>
		<td BGCOLOR=#BED1DB align=center><font FACE=arial color=#000000 size=1><b>AGREGAR</b></FONT></td>
		<td BGCOLOR=#BED1DB align=center><font FACE=arial color=#000000 size=1><b>DESCRIPCION</b></FONT></td>
		</tr>
		<tr><td height=10></td></tr>
		
		<input type=hidden name=dx_ing value='$dx_ing'>
		<input type=hidden name=idenevo value=$idenevo>
		<input type=hidden name=registro value=$registro>	
		<input type=hidden name=codusu value=$codusu>
		<input type=hidden name=opc_fin value=$opc_fin>		
		<input type=hidden name=fin_con value=$fin_con>		
		<input type=hidden name=dx_1 value=$dx_1>
		<input type=hidden name=codi_cir value=$codi_cir>		
		<input type=hidden name=codayuda value=$codi_cup>		
		<input type=hidden name=cant_pro value=$cant_pro>		
		<input type=hidden name=producto value=$producto>
		<input type=hidden name=producto1 value=$producto1>
		<input type=hidden name=nomayuda value='$nomayuda'>
		<input type=hidden name=codi_cup value='$codi_cup'>
		<input type=hidden name=codusu value='$codusu'>
		<input type=hidden name=codarea value='$codarea'>
		<input type=hidden name=codi_selec value='$codi_selec'>
		<input type=hidden name=produc>
		<input type=hidden name=produc1>";
		echo "<input type=hidden name=contrato value=$contrato>";
		echo"<input type=hidden name=codusu value=$codusu>";
		echo"<input type=hidden name=amb_usu  value='$amb_usu'>";
		echo"<input type=hidden name=fin_con  value='$fin_con'>";
		echo"<input type=hidden name=condu  value='$condu'>";
		echo"<input type=hidden name=progu  value='$progu'>";
		echo"<input type=hidden name=med_soli  value='$med_soli'>";
		echo"<input type=hidden name=fent value=$fent>";
		
		echo"<input type=hidden name=ide_cita value=$ide_cita>";
		echo"<input type=hidden name=area value=$area>";
		
		
		echo "<input type=hidden name=num_ord value='$num_ord'>";
		echo "<input type=hidden name=obs_labs value='$obs_labs'>";
		echo "<input type=hidden name=iden_var value=$iden_var>";
		echo "<input type=hidden name=control value=$control>";
		echo"<input type=hidden name=iden_labs value=$iden_labs>";
		echo "<input type=hidden name=cod value='$codusu'>";
		echo "<input type=hidden name=nord_lab value='$num_ord'>";
		echo"<input type=hidden name=hospit value=1>";
		echo"<input type=hidden name=codcp1 value='$codcp1'>";
		echo"<input type=hidden name=contr value=$contr>";
		echo"<input type=hidden name=contrato value=$contrato>";
		echo"<input type=hidden name='iden_evo' value='$iden_evo'>";
		
		$n=0;
		while($row = mysql_fetch_array($resul))
		{
			$vector[$n]=$row['codigo'];       
			$codpro=$vector[$n];
			$maximo2="SELECT * FROM `cups` WHERE `codigo` = '$codpro'";
			Mysql_select_db('proinsalud',$link);
			$resul2=Mysql_query($maximo2,$link);
			while($row2 = mysql_fetch_array($resul2))
			{
				$nommedicam=$row2['descrip'];    //Nombre CUPS
				$nombrito[$n][2]=$row2['pos_mdi'];
			}
			$nombre[$n]= $nommedicam;
			$nombrito[$n][0]=$nommedicam;
			$nombrito[$n][1]=$desmedica;
			$n=$n+1;
		}
		if($n>$cuenta+10)$fin=$cuenta+10;
		else $fin=$n;
		$h=0;

		for($i=$cuenta;$i<$fin;$i++)
		{
			$item=$vector[$i];
			$nombrepro=$nombre[$i];
			$nomb=$nombrito[$i][0];
			$des=$nombrito[$i][1];
			$clase=$nombrito[$i][2];
			
			if ($h==0)
			{
				echo"<input type=hidden name=nom1 value='$nombrepro'>
				<input type=hidden name=val1 value='$item'>
				<input type=hidden name=clas1 value='$clase'>"; 
				echo"<td align=center><input type=button value='...' onClick='ver(val1,nom1,busca)'></td>";
			}
			if ($h==1)
			{

				echo"<input type=hidden name=nom2 value='$nombrepro'>
				<input type=hidden name=val2 value='$item'>
				<input type=hidden name=clas2 value='$clase'>";    
				echo"<td align=center><input type=button value='...' onClick='ver(val2,nom2,busca)'></td>";
				   
			}
			if ($h==2)
			{
				echo"<input type=hidden name=nom3 value='$nombrepro'>
				<input type=hidden name=val3 value='$item'>
				<input type=hidden name=clas3 value='$clase'>";            
				echo"<td align=center><input type=button value='...' onClick='ver(val3,nom3,busca)'></td>";
			}
			if ($h==3)
			{
				echo"<input type=hidden name=nom4 value='$nombrepro'>
				<input type=hidden name=val4 value='$item'>
				<input type=hidden name=clas4 value='$clase'>";
			   echo"<td align=center><input type=button value='...' onClick='ver(val4,nom4,busca)'></td>";
			}
			if ($h==4)
			{
				echo"<input type=hidden name=nom5 value='$nombrepro'>
				<input type=hidden name=val5 value='$item'>
				<input type=hidden name=clas5 value='$clase'>";
				echo"<td align=center><input type=button value='...' onClick='ver(val5,nom5,busca)'></td>";
			}
			if ($h==5)
			{
				echo"<input type=hidden name=nom6 value='$nombrepro'>
				<input type=hidden name=val6 value='$item'>
				<input type=hidden name=clas6 value='$clase'>";
				echo"<td align=center><input type=button value='...' onClick='ver(val6,nom6,busca)'></td>"; 
			}
			if ($h==6)
			{
				echo"<input type=hidden name=nom7 value='$nombrepro'>
				<input type=hidden name=val7 value='$item'>
				<input type=hidden name=clas7 value='$clase'>";
				echo"<td align=center><input type=button value='...' onClick='ver(val7,nom7,busca)'></td>"; 
			}
			if ($h==7)
			{
				echo"<input type=hidden name=nom8 value='$nombrepro'>
				<input type=hidden name=val8 value='$item'>
				<input type=hidden name=clas8 value='$clase'>";
				echo"<td align=center><input type=button value='...' onClick='ver(val8,nom8,busca)'></td>";
			}
			if ($h==8)
			{
				echo"<input type=hidden name=nom9 value='$nombrepro'>
				<input type=hidden name=val9 value='$item'>
				<input type=hidden name=clas9 value='$clase'>";
				echo"<td align=center><input type=button value='...' onClick='ver(val9,nom9,busca)'></td>"; 
			}
			if ($h==9)
			{
				echo"<input type=hidden name=nom10 value='$nombrepro'>
				<input type=hidden name=val10 value='$item'>
				<input type=hidden name=clas10 value='$clase'>";
				echo"<td align=center><input type=button value='...' onClick='ver(val10,nom10,busca)'></td>";
			}
			echo"
				<td><font FACE=Arial size=1 color=#000000><b>$nombrepro</b></font></td>

			</tr>";
			$h=$h+1;
		 }
		 $h=$h-1;
		 echo"
		 </table>
		 <table align=center width=65%>
		 <input type=hidden name=descripcion value='$descripcion'>
		 <input type=hidden name=cuenta value=$cuenta>
			
		<tr><td align=center colspan=9 height=40 valign=center>";
		$pagi=floor($n/10);
		if($n % 10==0)$pagi=$pagi-1;
		echo"<BR><table align=center width=65% bgcolor=#FFFFFF>
		<tr><td align=center>";
		for ($j=0;$j<=$pagi;$j++)
		{
			$pag=$j+1;
			if (floor($cuenta/10)==$j)
			{
				echo"<input type=button value=$pag style='font-family: tahoma; font-size: 8 pt; color: #CCCCCC; font-weight: 900;  background-color: #FFFFFF; border-color:#FFFFFF;border-width:0;  width: 20 ;height:16'></font>";
			}
			else
			{
				echo"<input type=button value=$pag onclick='ver1(this.form,$j)' style='font-family: tahoma; font-size: 8 pt; color: #000000; font-weight: 400;  background-color: #FFFFFF; border-color:#FFFFFF;border-width:0;  width: 18 ;height:16'></font>";
			}
			if(($j+1)%38==0 && $j!=0)echo'<br>';
		}
		 echo"</td></tr>
		 </table ></td>
		 <table align=center width=80%>
		 <tr><td align=center height=30 bgcolor=#BED1DB><input type=button value=Cancelar onclick='ver3(this.form)' style='font-family: tahoma; font-size: 9 pt; color: #000000; font-weight: 600;  background-color: #FFFFFF; border-color:#FFFFFF;border-width:0;  width: 120 ;height:16'>
		 </tr></table>
		 </form>";
	
?>

</BODY>
</HTML>
