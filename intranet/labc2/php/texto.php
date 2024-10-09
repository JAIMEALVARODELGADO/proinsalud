<?
//Funcion que recibe un texto y lo muestra en lineas sin cortar palabras
//Parámetros: 
//fila: Indica la fila en la cual empieza la impresion
//col_: Indica la columna para la impresion
//texto_: Texto completo a imprimir
//cuantos_: Cantidad de caracteres por línea para imprimir
//pdf: Variable que contiene la creacion del archivo pdf
//up_: puede contener los valores 1 o 0 (1=Le indica que se el texto se imprime en mayúsculas; 0:Indica que el texto se imprime como viene)
function imprimirtexto(&$fila,$col_,$texto_,$cuantos_,&$pdf,$up_)
{
  $control=1;  //Controla el ciclo para el número de lineas
  $inicio=0;  //Controla el numero de caracter desde el cual empieza a tomar la cadena para la línea
  while($control==1){
	$clin=substr($texto_,$inicio,$cuantos_); //Toma una cantidad de caracteres para la línea
	$nesp=substr_count($clin,' ');  //Cuenta el número de espacios que tiene la línea
	$nfin=strrpos($clin,' ');  //toma la posicion del último espacio para cortar la linea en ese punto
	if(empty($nfin)){
	  $nfin=$cuantos_;
	}
	$clin=substr($clin,0,$nfin);  //Toma la cantidad de caracteres hasta la posición anterior
	$inicio=$inicio+$nfin+1;  //aumenta el inico con la cantidad de caracteres tomados anteriormente, que se convierete en la nueva posicion de inicio para el siguiente ciclo
	$pdf->SetXY($col_,$fila);
	
	if($up_==1){
	  $pdf->Cell(40,5,strtoupper($clin),0);} //Imprime la línea en mayúsculas
	else{
	  $pdf->Cell(40,5,$clin,0);} //Imprime la línea en minúsculas
	$fila=$fila+4;
	titulo($pdf,$fila);
	if(empty($clin)){  //Controla el fin del ciclo
	    $fila=$fila-4;
	    $control=0;}  
	}
}
?>
