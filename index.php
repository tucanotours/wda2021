<?php include('assets/inc/configuracion.php'); ?>
<?php
$_GET['a']=2020;
$_GET['m']=12;
$_GET['d']=17;
if (!isset($_GET['h'])) { $_GET['h']=9; } 
if (!isset($_GET['mi'])) { $_GET['mi']=59; } 
$lanzamiento = $_GET['a']."-".$_GET['m']."-".$_GET['d']." ".$_GET['h'].":".$_GET['mi'].":00";
//$lanzamiento = "2020-12-17 10:00:00";
$limite_de_tiempo_para_ver = date("Y-m-d H:i:s", (strtotime(date($lanzamiento)) + 10672));
$arranque_real_15min_antes = date("Y-m-d H:i:s", (strtotime(date($lanzamiento)) - 900));
echo "<!-- LIMITE PARA VER: ".$limite_de_tiempo_para_ver." -->";
echo "<!-- LANZAMIENTO: ".$lanzamiento." -->";
$timeFirst  = strtotime($lanzamiento);
$arranque_real_15min_antes  = strtotime($arranque_real_15min_antes);
$ahora = date("Y-m-d H:i:s");
$timeSecond = strtotime($ahora);
$differenceInSeconds = $timeSecond - $arranque_real_15min_antes;
//$differenceInSeconds = $timeSecond - $timeFirst;
?>
<!doctype html>
<html lang="es">

<head>
<!--
<?php
echo $_SERVER['HTTP_REFERER'];
?>
-->

<title>Workshop de Aereos - Edición Virtual - Tucano Tours</title>

<?php include('assets/inc/meta.php'); ?>

<?php include('assets/inc/fonts.php'); ?>

<?php include('assets/inc/css.php'); ?>
<link href="assets/css/modal.css" rel="stylesheet"> 
<link href="assets/css/encuesta.css" rel="stylesheet"> 
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

<?php include('assets/inc/favicon.php'); ?>

<?php include('assets/inc/validacion.php'); ?>

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-GZ6RVQSZVX"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-GZ6RVQSZVX');
</script>

</head>

<body>

<a id="linkfalso" style="display:none;"></a>

<main>
	
	<div id="tuc-fondo"></div>
	
	<div class="container-fluid tuc-logos">
	
		<div class="row justify-content-between">
			
			<div class="col-lg-6 col-md-6 col-sm-6">
				
				<h3 data-aos="fade-right">Tucano Tours</h3>
				
			</div>
				
			<div class="col-lg-6 col-md-6 col-sm-6 tuc-logo-workshop">
				
				<h3 data-aos="fade-left">Workshop de Aéreos</h3>
				<a data-toggle="modal" data-target="#popup_video" class="boton_coris" rel="490866810"><h4 data-aos="fade-left">Coris Asistencia al Viajero</h4></a>
				
			</div>
			
		</div>

	</div>
	
	<div class="container-fluid tuc-logos tuc-logos2">
	
		<div class="row justify-content-between">
			
			<div class="col-lg-12 col-md-12 col-sm-12">
				
				<h1 data-aos="fade-up">Tucano Tours</h1>
				<h2 data-aos="fade-up">Coris Asistencia al Viajero</h2>
				<h3 data-aos="fade-up">Workshop de Aéreos</h3>
				
			</div>
			
		</div>

	</div>

	<!--
	<div class="container-fluid tuc-counter">
	
		<div class="container">
		
			<h1 data-aos="fade-down">
				<span data-aos="flip-up" data-aos-delay="500"></span>
				<span data-aos="zoom-in" data-aos-delay="900"></span>
			</h1>
			
			<h2 data-aos="flip-left" data-aos-delay="500">17DIC - 10AM</h2>	
			
			<div class="row justify-content-between" id="cuenta_regresiva">
				
				<div class="col-lg-8 col-md-12 col-sm-12">
				
					<div class="row tuc-regresiva">
			
						<div class="col-lg-3 col-md-3 col-sm-3 col-3">
							<span id="dias" data-aos="flip-up" data-aos-delay="500">03</span>
							<span id="dias_txt" data-aos="fade-up">DIAS</span>
						</div>
						
						<div class="col-lg-3 col-md-3 col-sm-3 col-3">
							<span id="horas" data-aos="flip-up" data-aos-delay="700">02</span>
							<span data-aos="fade-up">HS</span>
						</div>
						
						<div class="col-lg-3 col-md-3 col-sm-3 col-3">
							<span id="minutos" data-aos="flip-up" data-aos-delay="900">16</span>
							<span data-aos="fade-up">MIN</span>
						</div>
						
						<div class="col-lg-3 col-md-3 col-sm-3 col-3">
							<span id="segundos" data-aos="flip-up" data-aos-delay="1100">47</span>
							<span data-aos="fade-up">SEG</span>
						</div>
						
					</div>
				
				</div>
			
			</div>
		
		</div>
	
	</div>	
	-->
	
	<!--
	<?php 
	if ($ahora<$limite_de_tiempo_para_ver) { 
	?>
	<div class="container-fluid tuc-ondemand" id="tuc-streaming" style="display:none;">
	
		<div class="container">
		
			<div id="contenedor" style="width:600px;"></div>
		
			<div class="row justify-content-between">
			
				<div class="col-lg-12 col-md-12 col-sm-12">
				
					<span data-aos="fade-in" id="streaming"></span>
					<div id="streaming-controles" style="display:none;">
						<a id="volumen1" class="botones_control"><span class="fa fa-volume-off fa-lg"></span></a>
						<a id="volumen0" class="botones_control"><span class="fa fa-volume-up fa-lg"></span></a>
						<select id="calidad">
							<option value="auto">Auto</option>
							<option value="240p">240p</option>
							<option value="360p">360p</option>
							<option value="540p">540p</option>
							<option value="720p">720p</option>
							<option value="1080p">1080p</option>
							<option value="2K">2K</option>
							<option value="4K">4K</option>
						</select>
						<a id="fullscreen" class="botones_control"><span class="fa fa-arrows-alt fa-lg"></span></a>
						
						<p>SI PAUSÁS EL EVENTO, PODÉS RETOMAR LA TRANSMISIÓN DIRECTA REFRESCANDO LA PÁGINA.</a>
					</div>
				
				</div>
				
			</div>
			
			<div class="row justify-content-between">
				
				UNA VEZ FINALIZADO EL EVENTO, SE PODRÁ ACCEDER AL CONTENIDO <strong>ON DEMAND</strong>.
	
			</div>
			
		</div>
	
	</div>
	<?php 
	} 
	?>
	-->
	
	<div class="container-fluid tuc-slider">
	
		<div class="container">
		
			<div class="row">
			
				<div class="col-lg-12 col-md-12 col-sm-12 tuc-slider-titulos">
				
					<a data-toggle="modal" data-target="#popup_video" class="boton_coris" rel="490866810"><h5><img src="assets/img/logo/coris.png" title="Coris - Asistencia de viajero" /></h5></a>
				
					<h1 data-aos="zoom-in">STANDS VIRTUALES</h1>
					
					<p>Las siguientes compañías nos acompañan en esta Nueva Edición del Workshop de Aéreos, y comparten sus novedades.</p>
					
					<div class="tuc-categorias">
					
						<a title="Aerolineas" class="activo" id="cat1">Aerolineas</a>
						<a title="GDS" id="cat2">GDS</a>
						<a title="Asistencias al Viajero" id="cat3">Asistencias al Viajero</a>
						
					</div>
				
				</div>
			
				<ul class="lightSlider">
				
					<?php
					// nombre - imagen - link = ppt
					$sponsor = array (
					array("Aerolineas Argentinas","aerolineasARG.png","490740201", "", ""),
					array("Aeromexico","aeromexico.png","490740466", "", ""),
					array("Air Canada","aircanada.png","493299198", "", ""),
					array("Air France - KLM","airfrance-klm.png","490741286", "", ""),
					array("Air Europa","air europa.png","490740651", "", ""),
					array("Alitalia","alitalia.png","490741695", "", ""),
					array("All Nipon","all-nippon-airways-logo.png","490742794", "", ""),
					array("American Airlines","americanairlines.png","490743225", "", ""),
					array("Avianca","avianca.png","490750775", "", ""),
					array("Boa","boa.png","", "", "Workshop_Tucano_Boa.pptx"),
					array("British Airlines","british.png","490743379", "", ""),
					array("Cathai","Cathay-Pacific.jpg","490743520", "", ""),
					array("Copa Airlines","copa.png","490743854", "", ""),
					array("Delta","delta.png","", "DELTA_Tucano_Tours_WDA_2020.pptx", ""),
					array("Etihad","etihad.png","490745079", "", ""),
					array("Ethiopian","ethiopian.jpg","490744016", "", ""),
					array("Finnair","finnair.jpg","490745389", "", ""),
					array("Fly Emirates Airlines","fly-emirates.png","490750685", "", ""),
					array("Gol","gol.jpg","491618998", "", ""),
					array("Hahn Air","hahn.jpg","490745752", "", ""),
					array("Iberia","iberia.png","490746195", "", ""),
					array("JetSmart","jetsmart.png","490746362", "", ""),
					array("LATAM","latam.jpg","490746607", "", ""),
					array("Lufthansa","lufthansa_group.jpg","490748909", "", ""),
					array("Parannair","paranair.png","490749272", "", ""),
					array("Sky Airlines","sky.jpg","494174799", "", ""),
					array("Turkish Airlines","turkish.png","490749662", "", ""),
					array("United Airlines","unitedairlines.jpg","490750170", "", ""),
					array("Amadeus","Amadeus.png","490915499", "", ""),
					array("Travelport","travelport.png","", "", ""),
					array("Sabre","Sabre_Corporation.png","490749284", "", ""),
					array("Coris","coris.png","490743940", "", "")
					);
					$limite = count($sponsor)-1;
					$habilitopopup=0;
					for ($row = 0; $row <= $limite; $row++) {
						if ( ($sponsor[$row][2]!="")or($sponsor[$row][3]!="") ) {
							$habilitopopup=1;
						} else {
							$habilitopopup=0;
						}
					?>
					<li data-aos="flip-left" data-aos-delay="500">
						<a <?php if ($sponsor[$row][4]!="") { ?> href="assets/ppt/<?php echo $sponsor[$row][4]; ?>" target="_blank"<?php } ?> <?php if ($habilitopopup==1) { ?>data-toggle="modal" data-target="#popup_video"<?php } ?> title="<?php echo $sponsor[$row][0]; ?>" rel="<?php echo $sponsor[$row][2]; ?>" ppt="<?php echo $sponsor[$row][3]; ?>">
							<span><img src="assets/img/sponsors/<?php echo $sponsor[$row][1]; ?>" alt="<?php echo $sponsor[$row][0]; ?>" /></span>
						</a>
					</li>
					<?php
					}
					?>
				
				</ul>
	
			</div>
			
		</div>
	
	</div>
	
	<div class="container-fluid tuc-charlas" style="display:none;">
	
		<div class="container">
		
			<div class="row">
			
				<div class="col-lg-12 col-md-12 col-sm-12">
				
					<h2 data-aos="zoom-in">Reviví las charlas</h2>
					
					<h1>On demand</h1>
				
				</div>
				
			</div>
			
			<div class="row" id="modulo_charlas">
			
			</div>
			
		</div>
	
	</div>
	
	<div class="container-fluid tuc-charlas tuc-encuesta" id="la_encuesta" style="display:none;">
	
		<div class="container">

			<div class="row">
			
				<div class="col-lg-12 col-md-12 col-sm-12">
				
					<h2 data-aos="zoom-in">Tu opinión nos interesa</h2>
					
					<h1>CALIFICANOS</h1>
				
				</div>
	
			</div>
			
			<form action="procesar.php" method="post" class="rating">
			
				<input type="hidden" name="encuesta" id="encuesta" value="1" />
				
				<input type="hidden" name="a1" id="a1" value="<?php if (isset($_GET['a'])) { echo $_GET['a']; } ?>" />
				<input type="hidden" name="m1" id="m1" value="<?php if (isset($_GET['m'])) { echo $_GET['m']; } ?>" />
				<input type="hidden" name="d1" id="d1" value="<?php if (isset($_GET['d'])) { echo $_GET['d']; } ?>" />
				<input type="hidden" name="h1" id="h1" value="<?php if (isset($_GET['h'])) { echo $_GET['h']; } ?>" />
				<input type="hidden" name="mi1" id="mi1" value="<?php if (isset($_GET['mi'])) { echo $_GET['mi']; } ?>" />
			
				<div class="row justify-content-between">
				
					<div class="col-lg-3 col-md-6 col-sm-12">
					
						<h3>Duración Workshop</h3>
					
						<fieldset class="star-rating">
						<div class="star-rating__stars">
						  <input class="star-rating__input" type="radio" name="rating1" value="1" id="rating1-1" />
						  <label class="star-rating__label" for="rating1-1" aria-label="One"></label>
						  <input class="star-rating__input" type="radio" name="rating1" value="2" id="rating1-2" />
						  <label class="star-rating__label" for="rating1-2" aria-label="Two"></label>
						  <input class="star-rating__input" type="radio" name="rating1" value="3" id="rating1-3" />
						  <label class="star-rating__label" for="rating1-3" aria-label="Three"></label>
						  <input class="star-rating__input" type="radio" name="rating1" value="4" id="rating1-4" />
						  <label class="star-rating__label" for="rating1-4" aria-label="Four"></label>
						  <input class="star-rating__input" type="radio" name="rating1" value="5" id="rating1-5" />
						  <label class="star-rating__label" for="rating1-5" aria-label="Five"></label>
						  <div class="star-rating__focus"></div>
						</div>
					  </fieldset>
					
					</div>
					
					<div class="col-lg-3 col-md-6 col-sm-12">
					
						<h3>Contenido charlas</h3>
					
						<fieldset class="star-rating">
						<div class="star-rating__stars">
						  <input class="star-rating__input" type="radio" name="rating2" value="1" id="rating2-1" />
						  <label class="star-rating__label" for="rating2-1" aria-label="One"></label>
						  <input class="star-rating__input" type="radio" name="rating2" value="2" id="rating2-2" />
						  <label class="star-rating__label" for="rating2-2" aria-label="Two"></label>
						  <input class="star-rating__input" type="radio" name="rating2" value="3" id="rating2-3" />
						  <label class="star-rating__label" for="rating2-3" aria-label="Three"></label>
						  <input class="star-rating__input" type="radio" name="rating2" value="4" id="rating2-4" />
						  <label class="star-rating__label" for="rating2-4" aria-label="Four"></label>
						  <input class="star-rating__input" type="radio" name="rating2" value="5" id="rating2-5" />
						  <label class="star-rating__label" for="rating2-5" aria-label="Five"></label>
						  <div class="star-rating__focus"></div>
						</div>
					  </fieldset>
					
					</div>
					
					<div class="col-lg-3 col-md-6 col-sm-12">
					
						<h3>Claridad oradores</h3>
					
						<fieldset class="star-rating">
						<div class="star-rating__stars">
						  <input class="star-rating__input" type="radio" name="rating3" value="1" id="rating3-1" />
						  <label class="star-rating__label" for="rating3-1" aria-label="One"></label>
						  <input class="star-rating__input" type="radio" name="rating3" value="2" id="rating3-2" />
						  <label class="star-rating__label" for="rating3-2" aria-label="Two"></label>
						  <input class="star-rating__input" type="radio" name="rating3" value="3" id="rating3-3" />
						  <label class="star-rating__label" for="rating3-3" aria-label="Three"></label>
						  <input class="star-rating__input" type="radio" name="rating3" value="4" id="rating3-4" />
						  <label class="star-rating__label" for="rating3-4" aria-label="Four"></label>
						  <input class="star-rating__input" type="radio" name="rating3" value="5" id="rating3-5" />
						  <label class="star-rating__label" for="rating3-5" aria-label="Five"></label>
						  <div class="star-rating__focus"></div>
						</div>
					  </fieldset>
					
					</div>
					
					<div class="col-lg-3 col-md-6 col-sm-12">
					
						<h3>Modo virtual</h3>
					
						<fieldset class="star-rating">
						<div class="star-rating__stars">
						  <input class="star-rating__input" type="radio" name="rating4" value="1" id="rating4-1" />
						  <label class="star-rating__label" for="rating4-1" aria-label="One"></label>
						  <input class="star-rating__input" type="radio" name="rating4" value="2" id="rating4-2" />
						  <label class="star-rating__label" for="rating4-2" aria-label="Two"></label>
						  <input class="star-rating__input" type="radio" name="rating4" value="3" id="rating4-3" />
						  <label class="star-rating__label" for="rating4-3" aria-label="Three"></label>
						  <input class="star-rating__input" type="radio" name="rating4" value="4" id="rating4-4" />
						  <label class="star-rating__label" for="rating4-4" aria-label="Four"></label>
						  <input class="star-rating__input" type="radio" name="rating4" value="5" id="rating4-5" />
						  <label class="star-rating__label" for="rating4-5" aria-label="Five"></label>
						  <div class="star-rating__focus"></div>
						</div>
					  </fieldset>
					
					</div>
					
				</div>
				
				<div class="row justify-content-between">
				
					<input type="button" name="enviar-encuesta2" id="enviar-encuesta2" value="ENVIAR" class="" onclick="validar_encuesta(this.form);" data-aos="zoom-in" />
					
				</div>
				
			</form>
			
		</div>
	
	</div>
	
	<div class="container-fluid tuc-registro tuc-registro-nuevo">
	
		<div class="container">
		
			<div class="row">
			
				<div class="col-lg-12 col-md-12 col-sm-12">
				
					<h2 data-aos="zoom-in">Para recibir nuestra información actualizada</h2>
					
					<h1>REGISTRATE ACÁ</h1>
				
				</div>
	
			</div>
		
			<div class="row justify-content-between">
				
				<div class="tuc-formulario">
				
					<form action="procesar.php" method="post">
					
						<input type="hidden" name="a2" id="a2" value="<?php if (isset($_GET['a'])) { echo $_GET['a']; } ?>" />
						<input type="hidden" name="m2" id="m2" value="<?php if (isset($_GET['m'])) { echo $_GET['m']; } ?>" />
						<input type="hidden" name="d2" id="d2" value="<?php if (isset($_GET['d'])) { echo $_GET['d']; } ?>" />
						<input type="hidden" name="h2" id="h2" value="<?php if (isset($_GET['h'])) { echo $_GET['h']; } ?>" />
						<input type="hidden" name="mi2" id="mi2" value="<?php if (isset($_GET['mi'])) { echo $_GET['mi']; } ?>" />
					
						<input type="hidden" name="nuevo_registro" id="nuevo_registro" value="1" />
					
						<input type="text" name="nombre" id="nombre" placeholder="" class="" data-aos="fade-in" />
						<label id="label_nombre" data-aos="flip-up">NOMBRE</label>
						
						<input type="text" name="apellido" id="apellido" placeholder="" class="" data-aos="fade-in" />
						<label id="label_apellido" data-aos="flip-up">APELLIDO</label>
						
						<input type="text" name="agencia" id="agencia" placeholder="" class="" data-aos="fade-in" />
						<label id="label_agencia" data-aos="flip-up">AGENCIA / COMPAÑIA</label>
						
						<input type="text" name="telefono" id="telefono" placeholder="" class="" data-aos="fade-in" />
						<label id="label_telefono" data-aos="flip-up">TELÉFONO</label>
						
						<input type="text" name="celular" id="celular" placeholder="" class="" data-aos="fade-in" />
						<label id="label_celular" data-aos="flip-up">CELULAR</label>
						
						<input type="email" name="email" id="email" placeholder="" class="" data-aos="fade-in" />
						<label id="label_email" data-aos="flip-up">E-MAIL</label>
						
						<input type="text" name="localidad" id="localidad" placeholder="" class="" data-aos="fade-in" />
						<label id="label_localidad" data-aos="flip-up">LOCALIDAD</label>
						
						<input type="text" name="pais" id="pais" placeholder="" class="" data-aos="fade-in" />
						<label id="label_pais" data-aos="flip-up">PAÍS</label>
						
						<input type="button" name="enviar" id="enviar" value="REGISTRARME" class="" onclick="validar_registro(this.form);" data-aos="zoom-in" />
					
					</form>
			
				</div>
			
			</div>
		
		</div>
		
	</div>

</main>

<footer>

	<div class="container">
	
		<div class="row justify-content-between">
			
			<div class="col-lg-4 col-md-4 col-sm-12">
				
				<div class="tuc-iconos-tabla">
				
					<ul class="tuc-iconos">
					
						<li><a href="https://instagram.com/Tucanotours" target="_blank" class="fa fa-instagram fa-lg"></a></li>
						<li><a href="https://ar.linkedin.com/company/tucano-tours" target="_blank" class="fa fa-linkedin fa-lg"></a></li>
						
					</ul>
					
				</div>
			
				<h2>VER WORKSHOPS ANTERIORES</h2>
				
				<a href="http://historico.workshopdeaereos.com.ar/" title="Historico" target="_blank"><h3>historico.workshopdeaereos.com.ar
</h3></a>

				<a href="mailto:workshopdeaereos@tucanotours.com.ar" title="Esribinos"><h3>workshopdeaereos@tucanotours.com.ar</h3></a>
				
				<a href="https://www.tucanotours.com.ar" title="Historico" target="_blank"><h4>www.tucanotours.com.ar</h4></a>
			
			</div>
			
			<div class="col-lg-12 col-md-12 col-sm-12">
			
				<p>&copy; Tucano Tours <?php echo date("Y"); ?> | Todos los derechos reservados</p>
			
			</div>
		
		</div>
	
	</div>

</footer>

<div id="avion1">

	<svg width="1200" height="300" viewBox="0 0 800 200">
  <path id="motionPath" fill="none" stroke="#FFFFFF" stroke-dasharray="5" stroke-miterlimit="0" d="M0.7140000000000128,192.18C28.034000000000006,164.33800000000002 59.136,151.553 99.54,152.883C138.847,154.17800000000003 176.709,168.14700000000002 211.967,143.19400000000002C227.04500000000002,132.523 249.67800000000003,110.185 250.72500000000002,91.048C251.781,71.74900000000001 236.68200000000002,47.13600000000001 221.872,35.91100000000001C204.87500000000003,23.022000000000013 184.47400000000005,23.30500000000001 168.95300000000003,36.28200000000001C155.09300000000002,47.87000000000001 147.67400000000004,62.423000000000016 147.39300000000003,80.07700000000001C146.159,157.604 231.115,170.104 231.115,170.104C311.738,180.29500000000002 338.369,36.887 288.529,0.81
        "/>
  
  <g id="plane" style="" transform="scale(0.5, 0.5) translate(0,-25)">
  <defs id="defs0" />
  <path
     d="M0,25.969c1.335-5.102,17.13-3.942,17.13-3.942l5.044-9.119l-2.02-0.012l0.021-3.564l3.92,0.021L29.496,0
	l2.138,0.01l-4.39,19.818l-0.015,2.613l14.606,1.271l4.804-9.002l2.615,0.014l-1.956,9.733c0,0,4.51,0.62,5.455,1.695v0.081
	c-0.958,1.064-5.476,1.633-5.476,1.633l1.846,9.753l-2.613-0.015l-4.701-9.056l-14.621,1.104l-0.014,2.613l4.162,19.866
	l-2.139-0.013l-5.292-9.417l-3.921-0.021l0.021-3.565l2.021,0.012l-4.939-9.177c0,0-15.809,0.978-17.085-4.136L0,25.969z"
     style="opacity:1;color:#000000;fill:#FFFFFF;fill-opacity:1;fill-rule:nonzero;stroke:none;marker:none;visibility:visible;display:inline;overflow:visible"
     id="path1" />
</g>
   
  <animateMotion 
           xlink:href="#plane"
           dur="200s"
           begin="0s" 
           fill="freeze"
           repeatCount="indefinite"
           rotate="auto-reverse">
    <mpath xlink:href="#motionPath" />
  </animateMotion>
</svg>

</div>

<div id="avion2">

	<svg width="1200" height="300" viewBox="0 0 800 200">
  <path id="motionPath2" fill="none" stroke="#FFFFFF" stroke-dasharray="5" stroke-miterlimit="0" d="M0.503,175.135
	c12.092-3.143,24.547-3.403,37.037-6.211c30.801-6.924,55.418-35.602,67.029-63.691c12.084-29.229,10.629-69.921-13.781-92.376
	C78.452,1.509,56.439-5.14,48.545,14.605c-7.081,17.716,3.063,40.108,19.153,48.242c24.895,12.592,47.463,3.073,69.894-9.295
	c50.133-27.641,147.866-60.935,202.526-23.768
        "/>
  
  <g id="plane2" style="" transform="scale(0.5, 0.5) translate(0,-25)">
  <defs id="defs02" />
  <path
     d="M0,25.969c1.335-5.102,17.13-3.942,17.13-3.942l5.044-9.119l-2.02-0.012l0.021-3.564l3.92,0.021L29.496,0
	l2.138,0.01l-4.39,19.818l-0.015,2.613l14.606,1.271l4.804-9.002l2.615,0.014l-1.956,9.733c0,0,4.51,0.62,5.455,1.695v0.081
	c-0.958,1.064-5.476,1.633-5.476,1.633l1.846,9.753l-2.613-0.015l-4.701-9.056l-14.621,1.104l-0.014,2.613l4.162,19.866
	l-2.139-0.013l-5.292-9.417l-3.921-0.021l0.021-3.565l2.021,0.012l-4.939-9.177c0,0-15.809,0.978-17.085-4.136L0,25.969z"
     style="opacity:1;color:#000000;fill:#FFFFFF;fill-opacity:1;fill-rule:nonzero;stroke:none;marker:none;visibility:visible;display:inline;overflow:visible"
     id="path1" />
</g>
   
  <animateMotion 
           xlink:href="#plane2"
           dur="200s"
           begin="0s" 
           fill="freeze"
           repeatCount="indefinite"
           rotate="auto-reverse">
    <mpath xlink:href="#motionPath2" />
  </animateMotion>
</svg>

</div>

<?php
if (isset($_GET['cuenta'])) {
?>
<div class="modal" id="cuenta" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">

  <div class="modal-dialog" role="document">
   
	   <div class="modal-content">
	   
		  <div class="modal-top">
		  
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			  <span aria-hidden="true">X</span>
			</button>
		  
		  </div>
		  
		  <div class="modal-logos">
				
				<h1>Tucano Tours</h1>
				<h2>Workshop de Aéreos</h2>
				<h3>Coris Asistencia al Viajero</h3>
		  
		  </div>
		  <div class="modal-body" style="background:#fff;">
				<p>Gracias <b><?php echo $_GET['nombre']; ?></b> por dejarnos tus datos. Te vamos a mantener constantemente informado acerca de nuestras actividades.</p>
		  </div>
		  
		  <div class="modal-bottom">
		  </div>
		  <div class="modal-bottom2">
		  </div>
		  
		</div>
	
  </div>
  
</div>
<?php
}
?>
<?php
if (isset($_GET['emailyaexiste'])) {
?>
<div class="modal" id="emailyaexiste" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">

  <div class="modal-dialog" role="document">
   
	   <div class="modal-content">
	   
		  <div class="modal-top">
		  
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			  <span aria-hidden="true">X</span>
			</button>
		  
		  </div>
		  
		  <div class="modal-logos">
				
				<h1>Tucano Tours</h1>
				<h2>Workshop de Aéreos</h2>
				<h3>Coris Asistencia al Viajero</h3>
		  
		  </div>
		  <div class="modal-body" style="background:#fff;">
				<p>La dirección de correo <b><?php echo $_GET['emailyaexiste']; ?></b>	ya esta registrada. Por favor, utiliza otra dirección de correo.</p>
		  </div>
		  
		  <div class="modal-bottom">
		  </div>
		  <div class="modal-bottom2">
		  </div>
		  
		</div>
	
  </div>
  
</div>
<?php
}
?>

<div class="modal" id="popupencuesta" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static" style="display:none;">
  <div class="modal-dialog" role="document">
	   <div class="modal-content">
		  <div class="modal-top">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			  <span aria-hidden="true">X</span>
			</button>
		  </div>
		  <div class="modal-logos">
				<h1>Tucano Tours</h1>
				<h2>Workshop de Aéreos</h2>
				<h3>Coris Asistencia al Viajero</h3>
		  </div>
		  <div class="modal-body" style="background:#fff;">
				<p style="text-align:center;">Por favor, completa las cuatro preguntas de la encuesta.</p>
		  </div>
		  <div class="modal-bottom">
		  </div>
		  <div class="modal-bottom2">
		  </div>
		</div>
  </div>
</div>

<?php
if (isset($_GET['encuesta'])) {
?>
<div class="modal" id="encuestaexito" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">

  <div class="modal-dialog" role="document">
   
	   <div class="modal-content">
	   
		  <div class="modal-top">
		  
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			  <span aria-hidden="true">X</span>
			</button>
		  
		  </div>
		  
		  <div class="modal-logos">
				
				<h1>Tucano Tours</h1>
				<h2>Workshop de Aéreos</h2>
				<h3>Coris Asistencia al Viajero</h3>
		  
		  </div>
		  <div class="modal-body" style="background:#fff;">
				<p>Gracias por participar de nuestra encuesta!</p>
		  </div>
		  
		  <div class="modal-bottom">
		  </div>
		  <div class="modal-bottom2">
		  </div>
		  
		</div>
	
  </div>
  
</div>
<?php
}
?>

<?php
if (isset($_GET['error-email'])) {
?>
<div class="modal" id="erroremail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">

  <div class="modal-dialog" role="document">
   
	   <div class="modal-content">
	   
		  <div class="modal-top">
		  
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			  <span aria-hidden="true">X</span>
			</button>
		  
		  </div>
		  
		  <div class="modal-logos">
				
				<h1>Tucano Tours</h1>
				<h2>Workshop de Aéreos</h2>
				<h3>Coris Asistencia al Viajero</h3>
		  
		  </div>
		  <div class="modal-body" style="background:#fff;">
				<p>Se produjo un error al enviar tu mensaje. Por favor, intentalo nuevamente.</p>
		  </div>
		  
		  <div class="modal-bottom">
		  </div>
		  <div class="modal-bottom2">
		  </div>
		  
		</div>
	
  </div>
  
</div>
<?php
}
?>
<div class="modal" id="popup_video" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">

  <div class="modal-dialog" role="document">
   
	   <div class="modal-content">
	   
		  <div class="modal-top">
		  
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			  <span aria-hidden="true">X</span>
			</button>
		  
		  </div>
		  
		  <div class="modal-logos">
				
				<h1>Tucano Tours</h1>
				<h2>Workshop de Aéreos</h2>
				<h3>Coris Asistencia al Viajero</h3>
		  
		  </div>
		  <div class="modal-body">
				
		  </div>
		  
		  <div class="modal-bottom">
		  </div>
		  <div class="modal-bottom2">
		  </div>
		  
		</div>
	
  </div>
  
</div>


<div class="modal" id="popup_encuesta" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">

  <div class="modal-dialog" role="document">
   
	   <div class="modal-content">
	   
		  <div class="modal-top">
		  
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			  <span aria-hidden="true">X</span>
			</button>
		  
		  </div>
		  
		  <div class="modal-logos">
				
				<h1>Tucano Tours</h1>
				<h2>Workshop de Aéreos</h2>
				<h3>Coris Asistencia al Viajero</h3>
		  
		  </div>
		  <div class="modal-body">
				
			<div class="row justify-content-between">
			
				<div class="col-lg-12 col-md-12 col-sm-12">
				
					<h2 data-aos="zoom-in">Tu opinión nos interesa</h2>
					
					<h1>CALIFICANOS</h1>
				
				</div>
	
			</div>
			
			<div class="row justify-content-between">
			
			<form action="procesar.php" method="post" class="rating" id="formencuesta">
			
				<input type="hidden" name="encuestapopup" id="encuestapopup" value="1" />
				
				<input type="hidden" name="a" id="a" value="<?php if (isset($_GET['a'])) { echo $_GET['a']; } ?>" />
				<input type="hidden" name="m" id="m" value="<?php if (isset($_GET['m'])) { echo $_GET['m']; } ?>" />
				<input type="hidden" name="d" id="d" value="<?php if (isset($_GET['d'])) { echo $_GET['d']; } ?>" />
				<input type="hidden" name="h" id="h" value="<?php if (isset($_GET['h'])) { echo $_GET['h']; } ?>" />
				<input type="hidden" name="mi" id="mi" value="<?php if (isset($_GET['mi'])) { echo $_GET['mi']; } ?>" />
			
					<div class="col-lg-12 col-md-12 col-sm-12">
					
						<h3>Duración Workshop</h3>
					
						<fieldset class="star-rating">
						<div class="star-rating__stars">
						  <input class="star-rating__input" type="radio" name="popuprating1" value="1" id="popuprating1-1" />
						  <label class="star-rating__label" for="popuprating1-1" aria-label="One"></label>
						  <input class="star-rating__input" type="radio" name="popuprating1" value="2" id="popuprating1-2" />
						  <label class="star-rating__label" for="popuprating1-2" aria-label="Two"></label>
						  <input class="star-rating__input" type="radio" name="popuprating1" value="3" id="popuprating1-3" />
						  <label class="star-rating__label" for="popuprating1-3" aria-label="Three"></label>
						  <input class="star-rating__input" type="radio" name="popuprating1" value="4" id="popuprating1-4" />
						  <label class="star-rating__label" for="popuprating1-4" aria-label="Four"></label>
						  <input class="star-rating__input" type="radio" name="popuprating1" value="5" id="popuprating1-5" />
						  <label class="star-rating__label" for="popuprating1-5" aria-label="Five"></label>
						  <div class="star-rating__focus"></div>
						</div>
					  </fieldset>
					
					</div>
					
					<div class="col-lg-12 col-md-12 col-sm-12">
					
						<h3>Contenido charlas</h3>
					
						<fieldset class="star-rating">
						<div class="star-rating__stars">
						  <input class="star-rating__input" type="radio" name="popuprating2" value="1" id="popuprating2-1" />
						  <label class="star-rating__label" for="popuprating2-1" aria-label="One"></label>
						  <input class="star-rating__input" type="radio" name="popuprating2" value="2" id="popuprating2-2" />
						  <label class="star-rating__label" for="popuprating2-2" aria-label="Two"></label>
						  <input class="star-rating__input" type="radio" name="popuprating2" value="3" id="popuprating2-3" />
						  <label class="star-rating__label" for="popuprating2-3" aria-label="Three"></label>
						  <input class="star-rating__input" type="radio" name="popuprating2" value="4" id="popuprating2-4" />
						  <label class="star-rating__label" for="popuprating2-4" aria-label="Four"></label>
						  <input class="star-rating__input" type="radio" name="popuprating2" value="5" id="popuprating2-5" />
						  <label class="star-rating__label" for="popuprating2-5" aria-label="Five"></label>
						  <div class="star-rating__focus"></div>
						</div>
					  </fieldset>
					
					</div>
					
					<div class="col-lg-12 col-md-12 col-sm-12">
					
						<h3>Claridad oradores</h3>
					
						<fieldset class="star-rating">
						<div class="star-rating__stars">
						  <input class="star-rating__input" type="radio" name="popuprating3" value="1" id="popuprating3-1" />
						  <label class="star-rating__label" for="popuprating3-1" aria-label="One"></label>
						  <input class="star-rating__input" type="radio" name="popuprating3" value="2" id="popuprating3-2" />
						  <label class="star-rating__label" for="popuprating3-2" aria-label="Two"></label>
						  <input class="star-rating__input" type="radio" name="popuprating3" value="3" id="popuprating3-3" />
						  <label class="star-rating__label" for="popuprating3-3" aria-label="Three"></label>
						  <input class="star-rating__input" type="radio" name="popuprating3" value="4" id="popuprating3-4" />
						  <label class="star-rating__label" for="popuprating3-4" aria-label="Four"></label>
						  <input class="star-rating__input" type="radio" name="popuprating3" value="5" id="popuprating3-5" />
						  <label class="star-rating__label" for="popuprating3-5" aria-label="Five"></label>
						  <div class="star-rating__focus"></div>
						</div>
					  </fieldset>
					
					</div>
					
					<div class="col-lg-12 col-md-12 col-sm-12">
					
						<h3>Modo virtual</h3>
					
						<fieldset class="star-rating">
						<div class="star-rating__stars">
						  <input class="star-rating__input" type="radio" name="popuprating4" value="1" id="popuprating4-1" />
						  <label class="star-rating__label" for="popuprating4-1" aria-label="One"></label>
						  <input class="star-rating__input" type="radio" name="popuprating4" value="2" id="popuprating4-2" />
						  <label class="star-rating__label" for="popuprating4-2" aria-label="Two"></label>
						  <input class="star-rating__input" type="radio" name="popuprating4" value="3" id="popuprating4-3" />
						  <label class="star-rating__label" for="popuprating4-3" aria-label="Three"></label>
						  <input class="star-rating__input" type="radio" name="popuprating4" value="4" id="popuprating4-4" />
						  <label class="star-rating__label" for="popuprating4-4" aria-label="Four"></label>
						  <input class="star-rating__input" type="radio" name="popuprating4" value="5" id="popuprating4-5" />
						  <label class="star-rating__label" for="popuprating4-5" aria-label="Five"></label>
						  <div class="star-rating__focus"></div>
						</div>
					  </fieldset>
					
					</div>
				
					<div class="col-lg-12 col-md-12 col-sm-12 tuc-encuesta-popup-boton">
					
						<input type="button" name="enviar-encuesta" id="enviar-encuesta" value="ENVIAR" class="" onclick="validar_encuesta_popup(this.form);" data-aos="zoom-in" />
						
						<div id="encuesta_mensaje"></div>
						
					</div>
				
				</form>
			
			</div>
				
				
				
		  </div>
		  
		  <div class="modal-bottom">
		  </div>
		  <div class="modal-bottom2">
		  </div>
		  
		</div>
	
  </div>
  
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

<script src="assets/bootstrap/js/bootstrap.bundle.js"></script>
<script src="assets/js/player.js"></script>

<script src="assets/js/regresiva.php?dif=<?php echo $differenceInSeconds; ?>&a=<?php echo $_GET['a']; ?>&m=<?php echo $_GET['m']; ?>&d=<?php echo $_GET['d']; ?>&h=<?php echo $_GET['h']; ?>&mi=<?php echo $_GET['mi']; ?>"></script>
<!--
<script src="assets/js/regresiva.php?dif=0&a=2020&m=12&d=17&h=10&mi=00"></script>
-->
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
AOS.init({
  // Global settings:
  disable: false, // accepts following values: 'phone', 'tablet', 'mobile', boolean, expression or function
  startEvent: 'DOMContentLoaded', // name of the event dispatched on the document, that AOS should initialize on
  initClassName: 'aos-init', // class applied after initialization
  animatedClassName: 'aos-animate', // class applied on animation
  useClassNames: false, // if true, will add content of `data-aos` as classes on scroll
  disableMutationObserver: false, // disables automatic mutations' detections (advanced)
  debounceDelay: 0, // the delay on debounce used while resizing window (advanced)
  throttleDelay: 99, // the delay on throttle used while scrolling the page (advanced)
  // Settings that can be overridden on per-element basis, by `data-aos-*` attributes:
  offset: 0, // offset (in px) from the original trigger point
  delay: 0, // values from 0 to 3000, with step 50ms
  duration: 1000, // values from 0 to 3000, with step 50ms
  easing: 'ease', // default easing for AOS animations
  once: true, // whether animation should happen only once - while scrolling down
  mirror: false, // whether elements should animate out while scrolling past them
  anchorPlacement: 'top-bottom', // defines which position of the element regarding to window should trigger the animation

});

$(document).ready(function() {
	
	<?php 
	if (isset($_GET['cuenta'])) {
	?>
	$('#cuenta').show();
	$('#cuenta .close').click(function(event){
		$('#cuenta').hide();
	});
	<?php
	}
	?>
	
	<?php 
	if (isset($_GET['emailyaexiste'])) {
	?>
	$('#emailyaexiste').show();
	$('#emailyaexiste .close').click(function(event){
		$('#emailyaexiste').hide();
	});
	<?php
	}
	?>
	
	<?php 
	if (isset($_GET['error-email'])) {
	?>
	$('#erroremail').show();
	$('#erroremail .close').click(function(event){
		$('#erroremail').hide();
	});
	<?php
	}
	?>
	
	<?php 
	if (isset($_GET['encuesta'])) {
	?>
	$('#encuestaexito').show();
	$('#encuestaexito .close').click(function(event){
		$('#encuestaexito').hide();
	});
	<?php
	}
	?>
	
	<?php 
	if (isset($_GET['spon'])) {
	?>
	$('#tuc_modal2').show();
	$('#tuc_modal2 .close').click(function(event){
		$('#tuc_modal2').hide();
	});
	<?php
	}
	?>
	
	
	$('#popup_encuesta .close').click(function(event){
		$('#popup_encuesta').hide();
	});
	
	$('#popup_video .close').click(function(event){
		$( ".modal-body" ).html("");
		$('#popup_video').hide();
	});
	
	$('#popupencuesta .close').click(function(event){
		$('#popupencuesta').hide();
	});
	
});

</script>

<script src="assets/js/lightslider.js"></script>
<script rel="preload" src="https://unpkg.com/imagesloaded@4/imagesloaded.pkgd.min.js"></script>
<script rel="preload" type="text/javascript">
$(document).ready(function() {

	$('body').imagesLoaded( function() {
		
		var slider = $(".lightSlider").lightSlider({
			item: 4,
			autoWidth: false,
			slideMove: 1, // slidemove will be 1 if loop is true
			slideMargin: 0,
			addClass: '',
			mode: "slide",
			useCSS: true,
			cssEasing: 'ease', //'cubic-bezier(0.25, 0, 0.25, 1)',//
			easing: 'linear', //'for jquery animation',////
			speed: 500, //ms'
			auto: false,
			loop: true,
			slideEndAnimation: true,
			pause: 2500,
	 
			keyPress: false,
			controls: true,
			prevHtml: '',
			nextHtml: '',
	 
			rtl:false,
			adaptiveHeight:true,
	 
			vertical:false,
			verticalHeight:500,
	 
			thumbItem:10,
			pager: false,
			gallery: false,
			galleryMargin: 0,
			thumbMargin: 0,
			currentPagerPosition: 'middle',
	 
			enableTouch:true,
			enableDrag:true,
			freeMove:true,
			swipeThreshold: 40,
	 
			responsive : [
				{
					breakpoint:850,
					settings: {
						item:3,
						slideMove:1,
					  }
				},
				{
					breakpoint:576,
					settings: {
						item:2,
						slideMove:1,
					  }
				}
			],
	 
			onBeforeStart: function (el) {},
			onSliderLoad: function (el) {},
			onBeforeSlide: function (el) {},
			onAfterSlide: function (el) {
				var dato = $('.lightSlider').find(".active").find("a").attr("title");
				if (dato=="Aerolineas Argentinas") {
					$("#cat2, #cat3").removeClass("activo");
					$("#cat1").addClass("activo");
				} else if (dato=="Amadeus") {
					$("#cat1, #cat3").removeClass("activo");
					$("#cat2").addClass("activo");
				} else if (dato=="Coris") {
					$("#cat2, #cat1").removeClass("activo");
					$("#cat3").addClass("activo");
				} 
			},
			onBeforeNextSlide: function (el) {},
			onBeforePrevSlide: function (el) {}
		});
		
		$('#cat1').click(function(){
			slider.goToSlide(1);  
			$("#cat2, #cat3").removeClass("activo");
			$("#cat1").addClass("activo");
		});
		$('#cat2').click(function(){
			slider.goToSlide(29);  
			$("#cat1, #cat3").removeClass("activo");
			$("#cat2").addClass("activo");
		});
		$('#cat3').click(function(){
			slider.goToSlide(32); 
			$("#cat2, #cat1").removeClass("activo");
			$("#cat3").addClass("activo");
		});
			
	});
	
	
	
	$(function () {
	  $(document).scroll(function () {
		var $nav = $(".tuc-logos");
		$nav.toggleClass('scrolled', $(this).scrollTop() > $nav.height());
	  });
	});
	
	$('.lightSlider li a').click(function(){
		var ppt = $(this).attr("ppt");
		var link = $(this).attr("rel");
		if (ppt!="") { 
			var codigo_video = '<iframe src="https://view.officeapps.live.com/op/embed.aspx?src=https://workshopdeaereos.com.ar/assets/ppt/'+ppt+'" width="962px" height="565px" frameborder="0"></iframe>';
			$( "#popup_video .modal-body" ).html(codigo_video);
		} else if (link!="")  {
			var codigo_video = '<iframe src="https://player.vimeo.com/video/'+link+'?autoplay=1&loop=0&autopause=0&api=1&controls=1&playsinline=0" frameborder="0" allow="autoplay; fullscreen" allowfullscreen playsinline webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>';
			$( "#popup_video .modal-body" ).html(codigo_video);
		}
    });
	
	$('.tuc-charlas a, .boton_coris').click(function(){
		var link = $(this).attr("rel");
		var codigo_video = '<iframe src="https://player.vimeo.com/video/'+link+'?autoplay=1&loop=0&autopause=0&api=1&controls=1&playsinline=0" frameborder="0" allow="autoplay; fullscreen" allowfullscreen playsinline webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>';
		$( "#popup_video .modal-body" ).html(codigo_video);
    });
	
});

function cargar_video_completo() {
	console.log("cargar video completo");
	var codigo_video = '<iframe src="https://player.vimeo.com/video/491388217?autoplay=0&loop=0&autopause=0&api=1&controls=1&playsinline=0" frameborder="0" allow="autoplay; fullscreen" allowfullscreen playsinline webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>';
	$( "#streaming" ).html(codigo_video);
}

function cargar_charlas() {
	console.log("ejecuto accion charlas");
	var data = new FormData(); 
	var xhr = new XMLHttpRequest(); 
	var destino = 'assets/inc/charlas.php?lanzamiento=<?php echo $lanzamiento; ?>';
	xhr.open('POST', destino, true); 
	xhr.send(data);
	xhr.onload = function () {
		var respuesta = JSON.parse(xhr.responseText);
		if(xhr.status === 200 && respuesta.status == 'ok'){
			if (respuesta.contenido!="") {
				$('.tuc-charlas').show();
			}
			$( "#modulo_charlas" ).html(respuesta.contenido);
			//console.log(respuesta.contenido);
			
			$('.tuc-charlas a, #boton_coris').click(function(){
				var link = $(this).attr("rel");
				var codigo_video = '<iframe src="https://player.vimeo.com/video/'+link+'?autoplay=1&loop=1&autopause=0&api=1&controls=1?playsinline=0" frameborder="0" allow="autoplay; fullscreen" allowfullscreen playsinline webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>';
				$( "#popup_video .modal-body" ).html(codigo_video);
			});
			//$( ".aviso" ).html("Filtro aplicado");
			//$('.aviso').show();
			//setTimeout(function() {  $('.aviso').fadeOut('slow'); }, 5000);
		} else {
			console.log("problemas");
		}
	};
}

cargar_charlas();
var intervalo2 = setInterval(cargar_charlas, 10000);
</script>

</body>

</html>
