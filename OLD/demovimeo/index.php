<?php
date_default_timezone_set("America/Argentina/Buenos_Aires");
?>
<!doctype html>
<html lang="es">

<head>

<title>Tucano Tours - Demo Vimeo</title>

<link href="modal.css?id=<?php echo rand(1000000000, 9000000000); ?>" rel="stylesheet"> 

</head>

<body>

<h1>Video ejemplo Tucano Tours</h1>

<?php

$lanzamiento = $_GET['a']."-".$_GET['m']."-".$_GET['d']." ".$_GET['h'].":".$_GET['mi'].":00";

$timeFirst  = strtotime($lanzamiento);
$ahora = date("Y-m-d H:i:s");
$timeSecond = strtotime($ahora);
$differenceInSeconds = $timeSecond - $timeFirst;

?>

<h2>Lanzamiento: <?php echo $lanzamiento; ?></h2>

<?php 
if ($differenceInSeconds>0) {
?>
<h3>Video arranca en: <?php echo gmdate("H:i:s", $differenceInSeconds); ?></h3>
<?php 
}
?>

<p>Por favor, ingresa en la url los valores para año, mes, día, hora y segundos. Estos corresponderían al inicio del vivo.</p>
<p>Por ejemplo si queres usar los datos de ahora dentro de 60 segundos, copia esta url: <b>https://workshopdeaereos.com.ar/demovimeo/index.php?a=<?php echo date("Y", strtotime("+60 sec")); ?>&m=<?php echo date("m", strtotime("+60 sec")); ?>&d=<?php echo date("d", strtotime("+60 sec")); ?>&h=<?php echo date("H", strtotime("+60 sec")); ?>&mi=<?php echo date("i", strtotime("+60 sec")); ?></b></p>

<div id="contador" style="width:600px;">

	<table>
		<tr>
			<td><span id="days"></span></td>
			<td><span id="hours"></span></td>
			<td><span id="minutes"></span></td>
			<td><span id="seconds"></span></td>
		</tr>
		<tr>
			<td>DIAS</td>
			<td>HS</td>
			<td>MIN</td>
			<td>SEG</td>
		</tr>
	</table>

</div>


<div id="contenedor" style="width:600px;"></div>

<div id="encuesta" style="width:600px;display:none;">
<h1>Por favor, completa esta encuesta:</h1>
<p>Oculté el video y presento las preguntas para completar inmediatamente después.</p>
</div>

<script src="player.js"></script>
 
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="regresiva.php?dif=<?php echo $differenceInSeconds; ?>&a=<?php echo $_GET['a']; ?>&m=<?php echo $_GET['m']; ?>&d=<?php echo $_GET['d']; ?>&h=<?php echo $_GET['h']; ?>&mi=<?php echo $_GET['mi']; ?>"></script>
 
</body>

</html>