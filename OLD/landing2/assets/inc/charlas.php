<?php date_default_timezone_set("America/Argentina/Buenos_Aires");
			
if(isset($_POST) == true){
	/* SEGMENTO / FINALIZACION DENTRO DE VIDEO / EXPRESADO EN SEGUNDOS
	apertura - 18:02
	aereolineas - 39:11
	Aireurope - 1:04:01
	Airfrance - 1:26:31
	Americans airlines - 1:48:59
	Latam airlines - 2:08:27
	Lufthansa - 2:29:24
	Turkish airlines 2:51:45
	Cierre - 2:55:42
	
1982
3251
4741
6091
7439
8607
9864
11205
11442

	*/
	$fecha1 = date("Y-m-d H:i:s", (strtotime(date($_GET['lanzamiento'])) + 1982));
	$fecha2 = date("Y-m-d H:i:s", (strtotime(date($_GET['lanzamiento'])) + 3251));
	$fecha3 = date("Y-m-d H:i:s", (strtotime(date($_GET['lanzamiento'])) + 4741));
	$fecha4 = date("Y-m-d H:i:s", (strtotime(date($_GET['lanzamiento'])) + 6091));
	$fecha5 = date("Y-m-d H:i:s", (strtotime(date($_GET['lanzamiento'])) + 7439));
	$fecha6 = date("Y-m-d H:i:s", (strtotime(date($_GET['lanzamiento'])) + 8607));
	$fecha7 = date("Y-m-d H:i:s", (strtotime(date($_GET['lanzamiento'])) + 9864));
	$fecha8 = date("Y-m-d H:i:s", (strtotime(date($_GET['lanzamiento'])) + 11205));
	$fecha9 = date("Y-m-d H:i:s", (strtotime(date($_GET['lanzamiento'])) + 11442));
	
	$contenido = "";
				// nombre - imagen - link - hora habilitacion
				$charlas = array (
				array("APERTURA","","490743921",$fecha1),
				array("AEROLINEAS ARGENTINAS","previa-argentinas.jpg","490718012",$fecha2),
				array("AIR EUROPA","previa-europa.jpg","490723398",$fecha3),
				array("AIR FRANCE KLM","previa-airfrance.jpg","490701403",$fecha4),
				array("AMERICAN AIRLINES","previa-american.jpg","490704117",$fecha5),
				array("LATAM AIRLINES","previa-latam.jpg","490697982",$fecha6),
				array("LUFTHANSA GROUP","previa-lufthansa.jpg","490709985",$fecha7),
				array("TURKISH AIRLINES","previa-turkish.jpg","489945563",$fecha8),
				array("CIERRE","previa-tucano.jpg","490696521",$fecha9)
				);
				$limite = count($charlas)-1;
				$horaactual = date("Y-m-d H:i:s");
				$horaactual = strtotime($horaactual);
				
				
				for ($row = 0; $row <= $limite; $row++) {
					// verifico si esta habilitado por hora
					$horahabilitado = strtotime($charlas[$row][3]);
					if ($horaactual>$horahabilitado) {
				
						$contenido .= '<div class="col-lg-4 col-md-4 col-sm-12">';
							$contenido .= '<a data-toggle="modal" data-target="#popup_video" rel="'.$charlas[$row][2].'" title="Ver charla">';
								$contenido .= '<span><img src="';
								if ($charlas[$row][1]!="") { 
									$contenido .= 'assets/img/charlas/'.$charlas[$row][1]; 
								} else { 
									$contenido .= 'assets/img/charlas/default.jpg';
								}
								$contenido .= '" alt="Ver charla" /></span>';
								$contenido .= '<h1>'.$charlas[$row][0].'</h1>';
							$contenido .= '</a>';
						$contenido .= '</div>';
				
					}
				}
				
	$response['status'] = 'ok';
	$response['contenido'] = $contenido;
	
    // DEVUELVO RESPUESTA
    echo json_encode($response);
	//echo $response['contenido'];
	
}

?>