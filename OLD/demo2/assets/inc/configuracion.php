<?php session_start();
date_default_timezone_set("America/Argentina/Buenos_Aires");
$conf_root = "http://c1400332.ferozo.com/workshopsaereos.com.ar/";
$conf_root = "https://workshopdeaereos.com.ar/";
$conf_root = "http://localhost/tucanotours.com.ar/";

/*
$conf_host = "localhost:3306";
$conf_user = "workshop";
$conf_pass = "Y&YFYKeA@ou0f6@";
$conf_base = "worktur122020_bd";
*/

$smtpHost = "smtp.gmail.com";
$smtpUsuario = "registracion@workshopdeaereos.com.ar"; 
$smtpClave = "l;HHS~IB";

/* CONEXION A BASE DE DATOS */
/* ---------------------------------------------------------------- */

/*
$link = mysqli_connect($conf_host,$conf_user,$conf_pass,$conf_base);


$sql = "select * 
from testeo
;";
$ejecutarsql = mysqli_query ($link, $sql);
while ($dato = mysqli_fetch_assoc($ejecutarsql)) { 
}
*/


// CÓDIGO ALFANUMERICO
function codigo_alfanumerico($x) {
	$length = $x;
	$chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890';
	$chars_length = (strlen($chars) - 1);
	$string = $chars{rand(0, $chars_length)};
	for ($i = 1; $i < $length; $i = strlen($string)) {
	$r = $chars{rand(0, $chars_length)};
	if ($r != $string{$i - 1}) $string .=  $r;
	}
	return $string;
}	

function mostrar_nombre($x) {
	
	$conf_host = "localhost";
	$conf_user = "root";
	$conf_pass = "";
	$conf_base = "rem_grin_2020";
	
	$conf_host = "50.62.209.151:3306";
	$conf_user = "gg_remate_user";
	$conf_pass = "7&bsE44w72BItopimi345fgDF";
	$conf_base = "ph11175669848_rem2020";
	
	$link = mysqli_connect($conf_host,$conf_user,$conf_pass,$conf_base); 
	$sql = "select * 
	from rem_lote 
	where 
	lot_id = ".$x."
	;";
	$ejecutarsql = mysqli_query ($link, $sql);
	while ($dato = mysqli_fetch_assoc($ejecutarsql)) { 
		echo $dato['lot_titulo'];
	}
}

// LIMPIAR INGRESOS DE FORMULARIOS
function limpiar_ingreso($x) {
	// quito comillas simples
	$x = str_replace("'", "", $x);
	// devuelvo cadena
	return $x;
}

// calculo de mes desde bbdd
function mes($x) {
	
	switch($x) {
		case 1: return "ENERO"; break;
		case 2: return "FEBRERO"; break;
		case 3: return "MARZO"; break;
		case 4: return "ABRIL"; break;
		case 5: return "MAYO"; break;
		case 6: return "JUNIO"; break;
		case 7: return "JULIO"; break;
		case 8: return "AGOSTO"; break;
		case 9: return "SEPTIEMBRE"; break;
		case 10: return "OCTUBRE"; break;
		case 11: return "NOVIEMBRE"; break;
		case 12: return "DICIEMBRE"; break;	
	}
	
}

function formato_fecha($x) {

		echo date("j", strtotime($x));
		echo " de ";
		$mes = date("n", strtotime($x)); 
		switch($mes) {
			case 1: echo "Enero"; break;
			case 2: echo "Febrero"; break;
			case 3: echo "Marzo"; break;
			case 4: echo "Abril"; break;
			case 5: echo "Mayo"; break;
			case 6: echo "Junio"; break;
			case 7: echo "Julio"; break;
			case 8: echo "Agosto"; break;
			case 9: echo "Septiembre"; break;
			case 10: echo "Octubre"; break;
			case 11: echo "Noviembre"; break;
			case 12: echo "Diciembre"; break;
		}
		echo " de ";
		echo date("Y", strtotime($x));

}

function ddmmaaaa($x) {

		echo date("d", strtotime($x));
		echo "/";
		echo date("m", strtotime($x)); 
		echo "/";
		echo date("Y", strtotime($x));

}


?>