<?php session_start();

//upload.php

if(isset($_POST['image']))
{
	
	// creo carpeta, si no existe
	$anio = date("Y");
	$mes = date("m");
	$carpeta = "../../uploads/".$anio."/".$mes;
	if (!file_exists($carpeta)) {
		
		mkdir($carpeta, 0777, true);
		
	}
	
	$data = $_POST['image'];

	$image_array_1 = explode(";", $data);

	$image_array_2 = explode(",", $image_array_1[1]);

	$data = base64_decode($image_array_2[1]);

	$image_name = '../../uploads/' . $anio . '/' . $mes . '/' . time() . '.jpg';
	$image_url = 'uploads/' . $anio . '/' . $mes . '/' . time() . '.jpg';
	$_SESSION['imagen'] = $anio . '/' . $mes . '/' . time() . '.jpg';

	file_put_contents($image_name, $data);

	echo $image_url;
}

?>