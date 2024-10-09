<?php

function redimensionar_jpeg($img_original, $img_nueva, $img_nueva_anchura, $img_nueva_altura, $img_nueva_calidad)
{ 

	$si=getimagesize($img_original);

	$ancho1=$si[0];
	$alto1=$si[1];


	if($ancho1>$alto1)
	{

		$ratio=$alto1/$ancho1;
		$img_nueva_altura=$img_nueva_anchura*$ratio;
	}
	else
	{
		$ratio=$ancho1/$alto1;
		$img_nueva_anchura=$img_nueva_altura*$ratio;
	}

	// crear una imagen desde el original 
	$img = ImageCreateFromJPEG($img_original); 
	// crear una imagen nueva 
	$thumb = imagecreatetruecolor($img_nueva_anchura,$img_nueva_altura); 
	// redimensiona la imagen original copiandola en la imagen 
	imagecopyresampled($thumb,$img,0,0,0,0,$img_nueva_anchura,$img_nueva_altura,ImageSX($img),ImageSY($img)); 
 	// guardar la nueva imagen redimensionada donde indicia $img_nueva 
	ImageJPEG($thumb,$img_nueva,$img_nueva_calidad);
	ImageDestroy($img);
}

function clas_are($cod_){
  switch ($cod_){
    case 'I':
	  $nom_='Interno';
	  break;
    case 'E':
	  $nom_='Externo';
	  break;
  }
  return $nom_;
}

function tipo_are($cod_){
  switch ($cod_){
    case '1':
	  $nom_='Asistencial';
	  break;
    case '2':
	  $nom_='Administrativo';
	  break;
  }
  return $nom_;
}

function estado($cod_){
  switch ($cod_){
    case 'A':
	  $nom_='Activo';
	  break;
    case 'I':
	  $nom_='Inactivo';
	  break;
  }
  return $nom_;
}
?>