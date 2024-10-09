<html> 
<head> 
<title>INFORMACION PROINSALUD* </title> 
<style type="text/css">
<!--
.Estilo3{
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 11px; color: #333366;;
}
.Estilo1 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px;  color: #333366;},usu,dlab
.Estilo6 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px;  font-weight: bold; color: #333366;}

-->
</style>


<script language="javascript">
function eliminar(control,usu,dlab,dva,cod)
{
	  
	   if (window.confirm("¿Desea Eliminar el Examen?")) 
	   {
		  form1.cont.value=control;
		 // form1.iden_labs.value=iden;
		  form1.iden_dlab.value=dlab;
		  form1.dva.value=dva;
		  form1.usu.value=usu;
		  form1.cod.value=cod;
		 // alert(form1.dva.value);
		  form1.action='eli_exq.php';
		  form1.submit();
		 
	   }
	
}

</script>
<link rel="stylesheet" href="css/style.css" type="text/css" />
</head> 
<body><hr align="center"width="100%">
<form name='form1' method="POST"  action="" target="fr2">  
<p align="center" class="Estilo6"><strong>
<?php

	include('php/conexion.php');
	
	echo"<table class='Tbl0'>
	<tr>
    <td class='Td1' align='center'>DATOS REFERENTES A LA ORDEN </td>
    </tr></TABLE>";
	
	echo"<input type=hidden name=iden_dlab>";
	echo"<input type=hidden name=cont>";
	echo"<input type=hidden name=usu>";
	echo"<input type=hidden name=dva>";
	echo"<input type=hidden name=cod>";
	echo"<input type=hidden name=iden_uco value=$iden_uco>";
	echo"<input type=hidden name=iden_labs value=$iden_labs>";
	echo"<input type=hidden name=nord_lab value=$nord_lab>";
	
	
	$result=mysql_query("SELECT detalle_labs.iden_dlab,detalle_labs.codigo, encabezado_labs.iden_labs,cups.descrip, encabezado_labs.codi_usu
	FROM cups
	INNER JOIN detalle_labs AS detalle_labs ON detalle_labs.codigo = cups.codigo
	INNER JOIN encabezado_labs AS encabezado_labs ON detalle_labs.iden_labs = encabezado_labs.iden_labs
	WHERE encabezado_labs.codi_usu=$iden_uco and encabezado_labs.iden_labs=$iden_labs AND detalle_labs.estd_dlab<>'EL'");
	
	//echo $result;

	if(mysql_num_rows($result)<>0)
	{
	  echo"<table class='Tbl0' border=0>";
	  echo "<tr class='Td1' >
	  <td class='Td1' colspan=2><strong><center>Codigo</strong></td>
	  <td class='Td1' colspan=3><strong><center>Nombre</strong></td>
	  <td class='Td1' colspan=2width=15%><strong><center>Acción</strong></td></tr>";
	  while($row=mysql_fetch_array($result))
	  {
		$usu=$row[codi_usu];
		$num_ord=$row[nord_lab];
		$ide_lab=$row[iden_labs];
		$codi=$row[codigo];
		$dlab=$row[iden_dlab];
		echo"<tr bgcolor='ffffff' >
		<td bordercolor='#D0D0F0' align='center' colspan=2><span class='Estilo1'>".$row[codigo]."</span></td> 
		<td  bordercolor=#D0D0F0 colspan=3><span class='Estilo1'>".$row[descrip]."</span></td>
		<td  bordercolor=#D0D0F0  align='center' colspan=2><a href='#' onclick='eliminar(1,$usu,$ide_lab,$dlab,$codi)'><img src=icons/btn_remove-selected_bg.gif></a></td>";
		echo"</tr>";
	 }
	
	
	 ///consulta en Coprologico
	  $consulta1=mysql_query("SELECT c.iden_cop,c.iden_dlab,c.cod_examen,c.cod_usu, c.num_fac  FROM coprol c WHERE c.cod_usu='$iden_uco' and c.iden_dlab='$iden_labs' AND c.esta_ord<>'EL' ");
	  if (mysql_num_rows($consulta1)<>0)
	  {
		while($rowx=mysql_fetch_array($consulta1))
		{
			
			$usu=$rowx[cod_usu];
			$ide_lab=$rowx[iden_dlab];
			$codi=$rowx[cod_examen];
			$cop=$rowx[iden_cop];
			echo"<tr bgcolor=#FFFFFF class=Estilo1 >
			<td bordercolor=#D0D0F0  align='center' colspan=2><span class='Estilo1'>".$rowx["cod_examen"]."</span></td>
			<td bordercolor=#D0D0F0  colspan=3><span class='Estilo1'>EXAMENES COPROLOGICOS</span></td>
			<td  bordercolor=#D0D0F0  align='center' colspan=2><a href='#' onclick='eliminar(2,\"$usu\",\"$ide_lab\",\"$cop\")'><img src=icons/btn_remove-selected_bg.gif></a></td>
			</tr>";
		}
	  }
	   ///Consulta  Espermograma
	   $consulta2=mysql_query("SELECT e.iden_esp,e.iden_dlab,e.num_fac,e.cod_exames,e.cod_usu FROM esper e WHERE e.cod_usu='$iden_uco' and e.iden_dlab='$iden_labs' AND e.esta_ord<>'EL'");
	   
	   if (mysql_num_rows($consulta2)<>0)
	   {
		while($rowxx=mysql_fetch_array($consulta2))
	    {
		   	$usu=$rowxx[cod_usu];
			$ide_lab=$rowxx[iden_dlab];
			$codi=$rowxx[cod_exames];
			$esp=$rowxx[iden_esp];
			echo"<tr bgcolor=#FFFFFF class=Estilo1>
		   <td bordercolor=#D0D0F0  align='center' colspan=2><span class='Estilo1'>".$rowxx["cod_exames"]."</span></td>
		   <td bordercolor=#D0D0F0 colspan=3><span class='Estilo1'>EXAMENES ESPERMOGRAMA</span></td>
		   <td  bordercolor=#D0D0F0  align='center' colspan=2><a href='#' onclick='eliminar(3,\"$usu\",\"$ide_lab\",\"$esp\")'><img src=icons/btn_remove-selected_bg.gif></a></td>
		   </tr>";
		   
		}
	   }
	   
	   ///Consulta Cuadro Hematico
	   $consulta3=mysql_query("SELECT h.iden_che,h.iden_dlab,h.num_fac,h.cod_examch ,h.cod_usu FROM cuadroh h WHERE h.cod_usu='$iden_uco' and h.iden_dlab='$iden_labs'AND h.esta_ord<>'EL' ");
	   
	   if (mysql_num_rows($consulta3)<>0)
	   {
		while ($rowxxx=mysql_fetch_array($consulta3))
	    {
			$usu=$rowxxx[cod_usu];
			$ide_lab=$rowxxx[iden_dlab];
			$codi=$rowxxx[cod_examch];
			$che =$rowxxx[iden_che];
		    echo"<tr bgcolor=#FFFFFF>
		    <td bordercolor=#D0D0F0  align='center' colspan=2><span class='Estilo1'>".$rowxxx["cod_examch"]."</span></td>
		    <td bordercolor=#D0D0F0  colspan=3><span class='Estilo1'>EXAMENES CUADRO HEMATICO</span></td>
		    <td  bordercolor=#D0D0F0  align='center' colspan=2><a href='#' onclick='eliminar(4,\"$usu\",\"$ide_lab\",\"$che\")'><img src=icons/btn_remove-selected_bg.gif></a></td>
		    </tr>";
        }
	  }

	  ///Consulta Frotis Vaginal	   
	   $consulta4=mysql_query("SELECT fr.iden_fro,fr.iden_dlab,fr.num_fac,fr.cod_examen ,fr.cod_usu FROM frotis fr WHERE fr.cod_usu='$iden_uco' and fr.iden_dlab='$iden_labs' AND fr.esta_ord<>'EL' ");
	   if (mysql_num_rows($consulta4)<>0)
	   {
		  while($rowx4=mysql_fetch_array($consulta4))
	      {
			$usu=$rowx4[cod_usu];
			$ide_lab=$rowx4[iden_dlab];
			$codi=$rowx4[cod_examen];
			$fro=$rowx4[iden_fro];
			echo"<tr bgcolor=#FFFFFF>
		   <td bordercolor=#D0D0F0  align='center' colspan=2><span class='Estilo1'>".$rowx4["cod_examen"]."</span></td>
		   <td bordercolor=#D0D0F0  colspan=3><span class='Estilo1'>EXAMENES FROTIS VAGINAL</span></td>
		    <td  bordercolor=#D0D0F0  align='center' colspan=2><a href='#' onclick='eliminar(5,\"$usu\",\"$ide_lab\",\"$fro\")'><img src=icons/btn_remove-selected_bg.gif></a></td>
		   </tr>";
		  }
	  }
		
	   ///Consulta hcg	   
	   
	   $consulta5=mysql_query("SELECT hc.iden_hcg,hc.iden_dlab, hc.num_fac,hc.cod_examen ,hc.cod_usu FROM hcg hc WHERE hc.cod_usu='$iden_uco' and hc.iden_dlab='$iden_labs' AND hc.esta_ord<>'EL'");
	   
	   if (mysql_num_rows($consulta5)<>0)
	   {
		 while ($rowx5=mysql_fetch_array($consulta5))
	     {
		   $usu=$rowx5[cod_usu];
		   $ide_lab=$rowx5[iden_dlab];
		   $codi=$rowx5[cod_examen];
		   $hcg =$rowx5[iden_hcg];
		   echo "<tr bgcolor=#FFFFFF>
		   <td bordercolor=#D0D0F0  align='center' colspan=2><span class='Estilo1'>".$rowx5["cod_examen"]."</span></td>
		   <td bordercolor=#D0D0F0  colspan=3><span class='Estilo1'>EXAMENES MUJERES EN EMBARAZO</span></td>
		   <td  bordercolor=#D0D0F0  align='center' colspan=2><a href='#' onclick='eliminar(6,\"$usu\",\"$ide_lab\",\"$hcg\")'><img src=icons/btn_remove-selected_bg.gif></a></td>
		   </tr>";
	     }
	   }
	  	  
	  ///Consulta Uroanalisis	
		
	
	  $consulta6=mysql_query("SELECT u.iden_uro, u.iden_dla,u.num_fac,u.cod_examen ,u.ced_usu FROM uroana u WHERE u.ced_usu='$iden_uco' and u.iden_dla='$iden_labs' AND u.`esta_ord`<>'EL'");
	  
	  if (mysql_num_rows($consulta6)<>0)
	   {
		while ($rowx6=mysql_fetch_array($consulta6))
	    {
		   $usu=$rowx6[ced_usu];
		   $ide_lab=$rowx6[iden_dla];
		   $codi=$rowx6[cod_examen];	
		   $uro =$rowx6[iden_uro]; 
		   echo "<tr bgcolor=#FFFFFF>
		   <td bordercolor=#D0D0F0  align='center' colspan=2><span class='Estilo1'>".$rowx6["cod_examen"]."</span></td>
		   <td bordercolor=#D0D0F0 colspan=3><span class='Estilo1'>EXAMENES UROANALISIS</span></td>
		   <td  bordercolor=#D0D0F0  align='center' colspan=2><a href='#' onclick='eliminar(7,\"$usu\",\"$ide_lab\",\"$uro\")'><img src=icons/btn_remove-selected_bg.gif></a></td>
		   </tr>";
		}
	  }

	 ///Consulta Liquidos	   
	   
	  $consulta7=mysql_query("SELECT l.iden_liq,l.iden_dlab,l.num_fac,l.cod_examen ,l.cod_usu FROM liquidos l WHERE l.cod_usu='$iden_uco' and l.iden_dlab='$iden_labs' AND l.esta_ord<>'EL'");
	  if (mysql_num_rows($consulta7)<>0)
	   {
		while($rowx7=mysql_fetch_array($consulta7))
	    {
	   		$usu=$rowx7[cod_usu];
			$ide_lab=$rowx7[iden_dlab];
			$codi=$rowx7[cod_examen];
			$liq=$rowx7[iden_liq];
		   echo "<tr bgcolor=#FFFFFF>
		   <td bordercolor=#D0D0F0 align='center' colspan=2><span class='Estilo1'>".$rowx7["cod_examen"]."</span></td>
		   <td bordercolor=#D0D0F0  colspan=3><span class='Estilo1'>EXAMENES LIQUIDOS</span></td>
		   <td  bordercolor=#D0D0F0  align='center' colspan=2><a href='#' onclick='eliminar(8,\"$usu\",\"$ide_lab\",\"$liq\")'><img src=icons/btn_remove-selected_bg.gif></a></td>
		   </tr>";
	    }
	 }
	  
	 ///Consulta Datos Varios	   
	   
	   $consulta8=mysql_query("SELECT dv.iden_dva,dv.iden_dlab,dv.cod_examvr ,dv.cod_usu FROM dat_varios dv WHERE dv.iden_dlab='$iden_labs'");
	  
	   if (mysql_num_rows($consulta8)<>0)
	   {
		while($rowx8=mysql_fetch_array($consulta8))
		{
			$usu=$rowx8[cod_usu];
			$ide_lab=$rowx8[iden_dlab];
			$codi=$rowx8[cod_examvr];
			$dva=$rowx8[iden_dva];
			
			echo"<tr bgcolor=#FFFFFF>
			<td bordercolor=#D0D0F0  align='center' colspan=2><span class='Estilo1'>".$rowx8["cod_examvr"]."</span></td>
			<td bordercolor=#D0D0F0  colspan=3><span class='Estilo1'>EXAMENES CUADRO VARIOS</span></td>
			<td  bordercolor=#D0D0F0  colspan=2 align='center'><a href='#' onclick='eliminar(9,\"$usu\",\"$ide_lab\",\"$dva\")'><img src=icons/btn_remove-selected_bg.gif></a></td>
			</tr>";
		}
	  } 
	    //examenes de bhcg
	
	$consulta9=mysql_query("SELECT bh.iden_bhc,bh.iden_dlab, bh.num_fac, bh.cod_exam, bh.cod_usu, bh.fec_rec, bh.fec_ent, bh.lab_bhc FROM labo_bhc bh where bh.cod_usu='$iden_uco' and bh.iden_dlab='$iden_labs' AND bh.esta_ord<>'EL' ");
	if (mysql_num_rows($consulta9)<>0)
	{
	  while($rowx9=mysql_fetch_array($consulta9))
	  {
		$usu=$rowx9[cod_usu];
		$ide_lab=$rowx9[iden_dlab];
		$codi=$rowx9[cod_exam];
		$bhc=$rowx9[iden_bhc];
		echo"<tr bgcolor=#FFFFFF >
		 <td bordercolor=#D0D0F0  colspan=2 align='center'><span class='Estilo1'>".$rowx9["cod_exam"]."</span></td>
		 <td bordercolor=#D0D0F0  colspan=3 ><span class='Estilo1'>EXAMENES BHCG</span></td>
		 <td bordercolor=#D0D0F0  colspan=2 align='center'><a href='#' onclick='eliminar(10,\"$usu\",\"$ide_lab\",\"$bhc\")'><img src=icons/btn_remove-selected_bg.gif></a></td>
		 </tr>";
       }
	}
	///examenes de inmunologia
	
	$consulta10=mysql_query("SELECT inm.iden_inm,inm.iden_dlab, inm.cod_exam, inm.cod_usu, inm.fec_rec, inm.fec_ent, inm.inmu_rac, inm.inmu_rau, inm.inmu_pcc, inm.inmu_pcu, inm.inmu_asc, inm.inmu_asu, inm.inmu_tioc,
	inm.inmu_tiou, inm.inmu_tihc, inm.inmu_tihu, inm.inmu_pac, inm.inmu_pau, inm.inmu_pbc, inm.inmu_pbu, inm.inm_btc, inm.inm_btu, inm.inm_ptc, inm.inm_ptu
	FROM labo_inm inm where inm.cod_usu='$iden_uco' and inm.iden_dlab='$iden_labs' AND inm.esta_ord<>'EL'");
	
	if (mysql_num_rows($consulta10)<>0)
	{
	  while($rowx10=mysql_fetch_array($consulta10))
	  {
		$usu=$rowx10[cod_usu];
		$ide_lab=$rowx10[iden_dlab];
		$codi=$rowx10[cod_exam];
		$inm=$rowx10[iden_inm];
	
		 echo"<tr bgcolor=#FFFFFF >
		 <td bordercolor=#D0D0F0 colspan=2 align='center'><span class='Estilo1'>".$rowx10["cod_exam"]."</span></td>
		 <td bordercolor=#D0D0F0 colspan=3><span class='Estilo1'>EXAMENES INMUNOLOGICOS</span></td>
		 <td bordercolor=#D0D0F0 colspan=2  align='center'><a href='#' onclick='eliminar(11,\"$usu\",\"$ide_lab\",\"$inm\")'><img src=icons/btn_remove-selected_bg.gif></a></td>
		 </tr>";
		}
		
	}
	//examenes trimitropina
	$consulta12=mysql_query("SELECT trm.iden_tri,trm.iden_dlab, trm.cod_exam, trm.cod_usu, trm.fec_rec, trm.fec_ent, trm.lab_trim  FROM labo_tri trm where trm.cod_usu='$iden_uco' and trm.iden_dlab='$iden_labs' AND trm.esta_ord<>'EL'"); 
	if (mysql_num_rows($consulta12)<>0)
	{
	  while ($rowx12=mysql_fetch_array($consulta12))
	  {
		$usu=$rowx12[cod_usu];
		$ide_lab=$rowx12[iden_dlab];
		$codi=$rowx12[cod_exam];
		$tri =$rowx12[iden_tri];
		
		 echo"<tr bgcolor=#FFFFFF>
		 <td bordercolor=#D0D0F0 colspan=2 align='center'><span class='Estilo1'>".$rowx12["cod_exam"]."</span></td>
		 <td bordercolor=#D0D0F0 colspan=3><span class='Estilo1'>EXAMENES TRIMITROPINA</span></td>
		 <td bordercolor=#D0D0F0 colspan=2 align='center'><a href='#' onclick='eliminar(12,\"$usu\",\"$ide_lab\",\"$tri\")'><img src=icons/btn_remove-selected_bg.gif></a></td>
		 </tr>";
	  }
	
	}
	
	//// FORMATO DE OTROS EXAMENES DE LABORATORIO
	$conotrex=mysql_query("SELECT `iden_loex`, `iden_dlab`, `num_fac`, `cod_loex`, `cod_usu`, `fec_recp`, `fec_entr`, `fsh_loex`, `obs_fsh`, `lsh_loex`, `obs_lsh`,
	`pgs_loex`, `obs_pgs`, `tst_loex`, `obs_tst`, `est_loex`, `obs_est`, `ige_loex`, `obs_ige`,
	`fnd_mcn`, `end_mcn`, `fni_mcn`, `eni_mcn`, `obs_mcn`,`khi_oex`,`khv_oex`,`esta_ord`
	FROM `labo_oexa` WHERE iden_dlab='$iden_labs' AND esta_ord<>'EL'");
	
	

	if(mysql_num_rows($conotrex)<>0)
	{

		while($rowcot=mysql_fetch_array($conotrex))

		{	
			$ide_lab=$rowcot[iden_dlab];
			$codi=$rowcot[cod_loex];
			$fsh_loex=$rowcot[fsh_loex];
			$obs_fsh= $rowcot[obs_fsh];
			$lsh_loex=$rowcot[lsh_loex]; 
			$obs_lsh= $rowcot[obs_lsh];
			$pgs_loex=$rowcot[pgs_loex]; 
			$obs_pgs= $rowcot[obs_pgs];
			$tst_loex=$rowcot[tst_loex];
			$obs_tst= $rowcot[obs_tst];
			$est_loex=$rowcot[est_loex];
			$obs_est= $rowcot[obs_est];
			$ige_loex=$rowcot[ige_loex]; 
			$obs_ige= $rowcot[obs_ige];
			$hgc_loex=$rowcot[hgc_loex];
			
			if($codi=='904105')
			{
				 echo"<tr bgcolor=#FFFFFF>
				 <td bordercolor=#D0D0F0 colspan=2 align='center'><span class='Estilo1'>904105</span></td>
				 <td bordercolor=#D0D0F0 colspan=3><span class='Estilo1'>HORMONA FOLÍCULO ESTIMULANTE -FSH</span></td>
				 <td bordercolor=#D0D0F0 colspan=2 align='center'><a href='#' onclick='eliminar(13,\"$usu\",\"$ide_lab\",\"$codi\")'><img src=icons/btn_remove-selected_bg.gif></a></td>
				 </tr>";
			}
			if($codi=='904107')
			{
				 echo"<tr bgcolor=#FFFFFF>
				 <td bordercolor=#D0D0F0 colspan=2 align='center'><span class='Estilo1'>904107</span></td>
				 <td bordercolor=#D0D0F0 colspan=3><span class='Estilo1'>HORMONA FOLÍCULO ESTIMULANTE - LSH</span></td>
				 <td bordercolor=#D0D0F0 colspan=2 align='center'><a href='#' onclick='eliminar(14,\"$usu\",\"$ide_lab\",\"$codi\")'><img src=icons/btn_remove-selected_bg.gif></a></td>
				 </tr>";
			}
			if($codi=='904510')
			{
				echo"<tr bgcolor=#FFFFFF>
				 <td bordercolor=#D0D0F0 colspan=2 align='center'><span class='Estilo1'>904510</span></td>
				 <td bordercolor=#D0D0F0 colspan=3><span class='Estilo1'>PROGESTERONA</span></td>
				 <td bordercolor=#D0D0F0 colspan=2 align='center'><a href='#' onclick='eliminar(15,\"$usu\",\"$ide_lab\",\"$codi\")'><img src=icons/btn_remove-selected_bg.gif></a></td>
				 </tr>";
			}
			if($codi=='904601')
			{
				echo"<tr bgcolor=#FFFFFF>
				 <td bordercolor=#D0D0F0 colspan=2 align='center'><span class='Estilo1'>904601</span></td>
				 <td bordercolor=#D0D0F0 colspan=3><span class='Estilo1'>TESTOSTERONA</span></td>
				 <td bordercolor=#D0D0F0 colspan=2 align='center'><a href='#' onclick='eliminar(16,\"$usu\",\"$ide_lab\",\"$codi\")'><img src=icons/btn_remove-selected_bg.gif></a></td>
				 </tr>";
			}
			if($codi=='904503')
			{
				echo"<tr bgcolor=#FFFFFF>
				 <td bordercolor=#D0D0F0 colspan=2 align='center'><span class='Estilo1'>904503</span></td>
				 <td bordercolor=#D0D0F0 colspan=3><span class='Estilo1'>ESTRADIOL</span></td>
				 <td bordercolor=#D0D0F0 colspan=2 align='center'><a href='#' onclick='eliminar(17,\"$usu\",\"$ide_lab\",\"$codi\")'><img src=icons/btn_remove-selected_bg.gif></a></td>
				 </tr>";
			
			
			}
			if($codi=='906446')
			{
				echo"<tr bgcolor=#FFFFFF>
				 <td bordercolor=#D0D0F0 colspan=2 align='center'><span class='Estilo1'>906446</span></td>
				 <td bordercolor=#D0D0F0 colspan=3><span class='Estilo1'>ANTÍGENOS IgE</span></td>
				 <td bordercolor=#D0D0F0 colspan=2 align='center'><a href='#' onclick='eliminar(18,\"$usu\",\"$ide_lab\",\"$codi\")'><img src=icons/btn_remove-selected_bg.gif></a></td>
				 </tr>";
			
			}
			if($codi=='903427')
			{
				echo"<tr bgcolor=#FFFFFF>
				 <td bordercolor=#D0D0F0 colspan=2 align='center'><span class='Estilo1'>903427</span></td>
				 <td bordercolor=#D0D0F0 colspan=3><span class='Estilo1'>HEMOGLOBINA - GLICOSILADA</span></td>
				 <td bordercolor=#D0D0F0 colspan=2 align='center'><a href='#' onclick='eliminar(19,\"$usu\",\"$ide_lab\",\"$codi\")'><img src=icons/btn_remove-selected_bg.gif></a></td>
				 </tr>";
			
			}
			if($codi=='902219')
			{
				echo"<tr bgcolor=#FFFFFF>
				 <td bordercolor=#D0D0F0 colspan=2 align='center'><span class='Estilo1'>903427</span></td>
				 <td bordercolor=#D0D0F0 colspan=3><span class='Estilo1'>MOCO NASAL</span></td>
				 <td bordercolor=#D0D0F0 colspan=2 align='center'><a href='#' onclick='eliminar(20,\"$usu\",\"$ide_lab\",\"$codi\")'><img src=icons/btn_remove-selected_bg.gif></a></td>
				 </tr>";
			
			}
			if($codi=='901305')
			{
				echo"<tr bgcolor=#FFFFFF>
				 <td bordercolor=#D0D0F0 colspan=2 align='center'><span class='Estilo1'>901305</span></td>
				 <td bordercolor=#D0D0F0 colspan=3><span class='Estilo1'>EXAMEN DIRECTO PARA HONGOS - KOH</span></td>
				 <td bordercolor=#D0D0F0 colspan=2 align='center'><a href='#' onclick='eliminar(22,\"$usu\",\"$ide_lab\",\"$codi\")'><img src=icons/btn_remove-selected_bg.gif></a></td>
				 </tr>";
			
			}
			if($codi=='904903')
			{
				echo"<tr bgcolor=#FFFFFF>
				 <td bordercolor=#D0D0F0 colspan=2 align='center'><span class='Estilo1'>904903</span></td>
				 <td bordercolor=#D0D0F0 colspan=3><span class='Estilo1'>TSH NEONATAL</span></td>
				 <td bordercolor=#D0D0F0 colspan=2 align='center'><a href='#' onclick='eliminar(26,\"$usu\",\"$ide_lab\",\"$codi\")'><img src=icons/btn_remove-selected_bg.gif></a></td>
				 </tr>";
			
			}
			if($codi=='906610')
			{
				echo"<tr bgcolor=#FFFFFF>
				 <td bordercolor=#D0D0F0 colspan=2 align='center'><span class='Estilo1'>906610</span></td>
				 <td bordercolor=#D0D0F0 colspan=3><span class='Estilo1'>ANTIGENO PROSTATICO</span></td>
				 <td bordercolor=#D0D0F0 colspan=2 align='center'><a href='#' onclick='eliminar(28,\"$usu\",\"$ide_lab\",\"$codi\")'><img src=icons/btn_remove-selected_bg.gif></a></td>
				 </tr>";
			
			}
			
		}
	}

	$result20=mysql_query("SELECT `iden_dlab`,`cod_usu` ,`gbl_esp`, `nume_esp`, `nnom_esp`,`hip_esp`, 
	`ani_esp`, `mcr_esp`, `mic_esp`, `pqu_esp`, `dic_esp`, `esq_esp`, `otr_mcn`, `org_esp`, `poli_esp`, `obsv_esp`, `esta_esp` 
	FROM `labo_sgre` WHERE `iden_dlab`='$iden_labs'  AND `esta_esp`<>'EL'");
	if(mysql_num_rows($result20)<>0)
	{
	
		while($rowsan=mysql_fetch_array($result20))

		{	
			$ide_lab=$rowsan[iden_dlab];
			$codi='902206';		
			$usu=$rowsan[cod_usu];
			echo"<tr bgcolor=#FFFFFF>
			<td bordercolor=#D0D0F0 colspan=2 align='center'><span class='Estilo1'>903427</span></td>
			<td bordercolor=#D0D0F0 colspan=3><span class='Estilo1'>EXTENDIDO DE SANGRE PERIFERICA</span></td>
			<td bordercolor=#D0D0F0 colspan=2 align='center'><a href='#' onclick='eliminar(21,\"$usu\",\"$ide_lab\",\"$codi\")'><img src=icons/btn_remove-selected_bg.gif></a></td>
			</tr>";
		
		
		}
	}
	//examenes Acido Alcohol
	$consulta15=mysql_query("SELECT `iden_dlab` ,`tipo_mue` ,`num_mue` , `esta_mue` , `valo_mue`,`est_oex2` 
			FROM labo_oex2 WHERE `iden_dlab`='$iden_labs' AND `est_oex2`<>'EL'");
	
	if (mysql_num_rows($consulta15)<>0)
	{
		while ($rowx15=mysql_fetch_array($consulta15))
		{
			$ide_lab=$rowx15[iden_dlab];
		}
		 echo"<tr bgcolor=#FFFFFF>
		 <td bordercolor=#D0D0F0 colspan=2 align='center'><span class='Estilo1'>901101</span></td>
		 <td bordercolor=#D0D0F0 colspan=3><span class='Estilo1'>EXAMENES ACIDO ALCOHOL RESISTENTE</span></td>
		 <td bordercolor=#D0D0F0 colspan=2 align='center'><a href='#' onclick='eliminar(23,\"$usu\",\"$ide_lab\",\"$tri\")'><img src=icons/btn_remove-selected_bg.gif></a></td>
		 </tr>";
	  
	
	}
	$cons_gram=mysql_query("SELECT `iden_dlab` ,`tipo_mue` ,`num_mue` , `esta_mue` , `valo_mue`,`est_oex2` 
			FROM labo_oex2 WHERE `iden_dlab`='$iden_labs' AND `est_oex2`<>'EL' AND cod_exam='901107'");
	
	if (mysql_num_rows($cons_gram)<>0)
	{
		while ($rowgr=mysql_fetch_array($cons_gram))
		{
			$ide_lab=$rowgr[iden_dlab];
		}
		 echo"<tr bgcolor=#FFFFFF>
		 <td bordercolor=#D0D0F0 colspan=2 align='center'><span class='Estilo1'>901107</span></td>
		 <td bordercolor=#D0D0F0 colspan=3><span class='Estilo1'>COLORACION GRAM</span></td>
		 <td bordercolor=#D0D0F0 colspan=2 align='center'><a href='#' onclick='eliminar(24,\"$usu\",\"$ide_lab\",\"$tri\")'><img src=icons/btn_remove-selected_bg.gif></a></td>
		 </tr>";
	  
	
	}
	$cons_cpr=mysql_query("SELECT `iden_dlab` ,`tipo_mue` ,`num_mue` , `esta_mue` , `valo_mue`,`est_oex2` 
			FROM labo_oex2 WHERE `iden_dlab`='$iden_labs' AND `est_oex2`<>'EL' AND cod_exam='907002'");
	
	if (mysql_num_rows($cons_cpr)<>0)
	{
		while ($rowcpr=mysql_fetch_array($cons_cpr))
		{
			$ide_lab=$rowcpr[iden_dlab];
		}
		 echo"<tr bgcolor=#FFFFFF>
		 <td bordercolor=#D0D0F0 colspan=2 align='center'><span class='Estilo1'>907002</span></td>
		 <td bordercolor=#D0D0F0 colspan=3><span class='Estilo1'>FORMATO COPROLOGICO</span></td>
		 <td bordercolor=#D0D0F0 colspan=2 align='center'><a href='#' onclick='eliminar(27,\"$usu\",\"$ide_lab\",\"$tri\")'><img src=icons/btn_remove-selected_bg.gif></a></td>
		 </tr>";
	  
	
	}
	
	
	
	//echo"<tr><td class='Td1' colspan=7><a href=imprimir_.php?codusu=$iden_uco&iden_labs=$iden_labs  target='fr011'><img src=icons/feed_magnify.png>Imprimir Factura</a></td></tr>";
    
	echo"</table>";

}
else
{
	echo "NO EXISTEN EXAMENES PARA ELIMINAR EN ESTA ORDEN";
}

?>
	
</form>
</body>
</html>