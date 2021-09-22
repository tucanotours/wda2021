<?php include('assets/inc/configuracion.php');

// NUEVO REGISTRO
if (isset($_POST['nuevo_registro'])) {
	
	require("assets/inc/class.phpmailer.php");
	require("assets/inc/class.smtp.php");
	
	// BUSCO ID NUEVO
	$idnuevo = 0;
	$sql = "select * 
	from wstt_12_20_registros 
	ORDER BY id DESC
	LIMIT 1;";
	$ejecutarsql = mysqli_query ($link, $sql);
	while ($dato = mysqli_fetch_assoc($ejecutarsql)) { 
		$idnuevo = $dato['id']+1;
	}
	
	// limpieza
	$_POST['nombre'] = limpiar_ingreso($_POST['nombre']);
	$_POST['apellido'] = limpiar_ingreso($_POST['apellido']);
	$_POST['agencia'] = limpiar_ingreso($_POST['agencia']);
	$_POST['telefono'] = limpiar_ingreso($_POST['telefono']);
	$_POST['celular'] = limpiar_ingreso($_POST['celular']);
	$_POST['localidad'] = limpiar_ingreso($_POST['localidad']);
	$_POST['pais'] = limpiar_ingreso($_POST['pais']);
	$_POST['email'] = limpiar_ingreso($_POST['email']);
	
	$encontroemail = 0;
	$sql = "select * 
	from wstt_12_20_registros 
	WHERE email = '".$_POST['email']."'
	LIMIT 1;";
	$ejecutarsql = mysqli_query ($link, $sql);
	while ($dato = mysqli_fetch_assoc($ejecutarsql)) { 
		$encontroemail++;
	}
	
	if ($encontroemail==1) {
		$url = "Location: ".$conf_root."index.php?emailyaexiste=".$_POST['email'];
		header($url);
	} else {
	
		// validaciones
		if(!preg_match("/^[[:alnum:]][a-z0-9_.-]*@[a-z0-9.-]+\.[a-z]{2,4}$/i", $_POST['email'])) { // valido email
			header("Location: index.php?email_incorrecto");
		}
		
		$conn = new mysqli($conf_host, $conf_user, $conf_pass, $conf_base);
		if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
		}
		$stmt = $conn->prepare("INSERT INTO wstt_12_20_registros (id, nombre, apellido, agencia, telefono, celular, email, localidad, pais, fecha, ip, clave, conexion, browser, pais2, ciudad, provincia, latitud, longitud) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
		$stmt->bind_param("issssssssssssssssss", $id, $nombre, $apellido, $agencia, $telefono, $celular, $email, $localidad, $pais, $fecha, $ip, $clave, $conexion, $browser, $pais2, $ciudad, $provincia, $latitud, $longitud);

		$id = $idnuevo;
		
		$nombre = $_POST['nombre'];
		$apellido = $_POST['apellido'];
		$agencia = $_POST['agencia'];
		$telefono = $_POST['telefono'];
		$celular = $_POST['celular'];
		$localidad = $_POST['localidad'];
		$pais = $_POST['pais'];
		$email = $_POST['email'];
		$fecha = date("Y-m-d H:i:s");
		$ip = $_SERVER['REMOTE_ADDR'];
		$clave = codigo_alfanumerico(8);
		$conexion = gethostbyaddr($_SERVER['REMOTE_ADDR']);
		$browser = $_SERVER['HTTP_USER_AGENT'];
		
		$ipdat = @json_decode(file_get_contents( 
		"http://www.geoplugin.net/json.gp?ip=" . $_SERVER['REMOTE_ADDR'])); 
		
		$pais2 = $ipdat->geoplugin_countryName;
		$ciudad = $ipdat->geoplugin_city;
		$provincia = $ipdat->geoplugin_region;
		$latitud = $ipdat->geoplugin_latitude;
		$longitud = $ipdat->geoplugin_longitude;
		
		$stmt->execute();
		$stmt->close();
		$conn->close();	

	$mail_body = '<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
	<html xmlns="http://www.w3.org/1999/xhtml" 
	xmlns:v="urn:schemas-microsoft-com:vml"
	xmlns:o="urn:schemas-microsoft-com:office:office">
	<head>
	<!--[if gte mso 9]><xml>
	<o:OfficeDocumentSettings>
	<o:AllowPNG/>
	<o:PixelsPerInch>96</o:PixelsPerInch>
	</o:OfficeDocumentSettings>
	</xml><![endif]-->
	<!-- fix outlook zooming on 120 DPI windows devices -->
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1"> <!-- So that mobile will display zoomed in -->
	<meta http-equiv="X-UA-Compatible" content="IE=edge"> <!-- enable media queries for windows phone 8 -->
	<meta name="format-detection" content="date=no"> <!-- disable auto date linking in iOS 7-9 -->
	<meta name="format-detection" content="telephone=no"> <!-- disable auto telephone linking in iOS 7-9 -->
	<title>Ganagrin</title>
	<style type="text/css">
	body {
	margin: 0;
	padding: 0;
	-ms-text-size-adjust: 100%;
	-webkit-text-size-adjust: 100%;
	}
	table {
	border-spacing: 0;
	}
	table td {
	border-collapse: collapse;
	}
	.ExternalClass {
	width: 100%;
	}
	.ExternalClass,
	.ExternalClass p,
	.ExternalClass span,
	.ExternalClass font,
	.ExternalClass td,
	.ExternalClass div {
	line-height: 100%;
	}
	.ReadMsgBody {
	width: 100%;
	background-color: #ebebeb;
	}
	table {
	mso-table-lspace: 0pt;
	mso-table-rspace: 0pt;
	}
	img {
	-ms-interpolation-mode: bicubic;
	}
	.yshortcuts a {
	border-bottom: none !important;
	}
	@media screen and (max-width: 599px) {
	.force-row,
	.container {
	width: 100% !important;
	max-width: 100% !important;
	}
	}
	@media screen and (max-width: 400px) {
	.container-padding {
	padding-left: 12px !important;
	padding-right: 12px !important;
	}
	}
	.ios-footer a {
	color: #aaaaaa !important;
	text-decoration: underline;
	}
	a[href^="x-apple-data-detectors:"],
	a[x-apple-data-detectors] {
	color: inherit !important;
	text-decoration: none !important;
	font-size: inherit !important;
	font-family: inherit !important;
	font-weight: inherit !important;
	line-height: inherit !important;
	}
	</style>
	</head>

	<body style="margin:0; padding:0;" bgcolor="#ffffff" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">

	<!-- 100% background wrapper (grey background) -->
	<table border="0" width="100%" height="100%" cellpadding="0" cellspacing="0" bgcolor="#ffffff">
	<tr>
	<td align="center" valign="top" bgcolor="#ffffff" style="background-color: #ffffff;">

	<br>

	<!-- 600px container (white background) -->
	<table border="0" width="600" cellpadding="0" cellspacing="0" class="container" style="width:600px;max-width:600px">
	<tr>
	<td class="container-padding header" align="center" style="font-family:Helvetica, Arial, sans-serif;font-size:24px;font-weight:bold;padding-bottom:12px;color:#DF4726;padding-left:24px;padding-right:24px">
	<A HREF="https://www.workshopdeaereos.com.ar/" target="_blank"><img src="https://workshopdeaereos.com.ar/assets/img/pics/banner.jpg" style="width:100%;height:auto;" /></a>
	</td>
	</tr>
	<tr>
	<td class="container-padding content" align="left" style="padding-left:24px;padding-right:24px;padding-top:12px;padding-bottom:12px;background-color:#f3f3f3">
	<br>
	<div class="title" style="font-family:Helvetica, Arial, sans-serif;font-size:18px;font-weight:600;color:#374550">Gracias <b>'.$nombre.'</b>!</div>
	<br>
	<div class="body-text" style="font-family:Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;text-align:left;color:#333333">
	Gracias por registrarte a nuestro Workshop de Aéreos &reg; 2020 - Edición Virtual.<br />
	Te esperamos el Jueves 17 de Diciembre a las 10hs en<br /> 
	<a href="https://www.workshopdeaereos.com.ar/" target="_blank">www.workshopdeaereos.com.ar</a>
	<br><br>
	</div>

	</td>
	</tr>
	<tr>
	<td class="container-padding content" align="left" style="padding-left:24px;padding-right:24px;padding-top:12px;padding-bottom:12px;">
	</td>
	</tr>
	<tr>
	<td class="container-padding header" align="center" style="font-family:Helvetica, Arial, sans-serif;font-size:24px;font-weight:bold;padding-bottom:12px;color:#DF4726;padding-left:24px;padding-right:24px">
	<A HREF="https://www.workshopdeaereos.com.ar/" target="_blank"><img src="https://workshopdeaereos.com.ar/assets/img/pics/banner2.jpg" style="width:100%;height:auto;" /></a>
	</td>
	</tr>
	</table>
	<!--/600px container -->
	</td>
	</tr>
	</table>
	<!--/100% background wrapper-->
	</body>
	</html>';
			
			$destino_email = "nicolasmentasti@gmail.com";
			$destino_nombre = "Workshops de Aéreos";
			$mensaje = $mail_body;
			$mail = new PHPMailer(true);
			$mail->IsSMTP();
			$mail->SMTPDebug = 1;
			$mail->SMTPAuth = true;
			$mail->Port = 587;
			$mail->SMTPSecure = 'tls';
			$mail->IsHTML(true);
			$mail->CharSet = "utf-8";
			$mail->Host = $smtpHost;
			$mail->Username = $smtpUsuario;
			$mail->Password = $smtpClave;
			$mail->From = $smtpUsuario;
			$mail->FromName = "Workshop de Aereos";
			$mail->AddAddress($email, $nombre);
			$mail->AddReplyTo($smtpUsuario, 'Workshops de Aereos');
			$mail->SetFrom($smtpUsuario, 'Workshops de Aereos');
			$mail->Subject = 'Gracias por registrarte a nuestro Workshop';
			$mensajeHtml = nl2br($mensaje);
			$mail->Body = "{$mail_body}"; // Texto del email en formato HTML
			$mail->AltBody = "{$mensaje}"; // Texto sin formato HTML
			$estadoEnvio = $mail->Send();
			
		
		if($estadoEnvio){
			
			// ENVIAR EMAIL

		$mail_body = '<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
	<html xmlns="http://www.w3.org/1999/xhtml" 
	xmlns:v="urn:schemas-microsoft-com:vml"
	xmlns:o="urn:schemas-microsoft-com:office:office">
	<head>
	<!--[if gte mso 9]><xml>
	<o:OfficeDocumentSettings>
	<o:AllowPNG/>
	<o:PixelsPerInch>96</o:PixelsPerInch>
	</o:OfficeDocumentSettings>
	</xml><![endif]-->
	<!-- fix outlook zooming on 120 DPI windows devices -->
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1"> <!-- So that mobile will display zoomed in -->
	<meta http-equiv="X-UA-Compatible" content="IE=edge"> <!-- enable media queries for windows phone 8 -->
	<meta name="format-detection" content="date=no"> <!-- disable auto date linking in iOS 7-9 -->
	<meta name="format-detection" content="telephone=no"> <!-- disable auto telephone linking in iOS 7-9 -->
	<title>Ganagrin</title>
	<style type="text/css">
	body {
	margin: 0;
	padding: 0;
	-ms-text-size-adjust: 100%;
	-webkit-text-size-adjust: 100%;
	}
	table {
	border-spacing: 0;
	}
	table td {
	border-collapse: collapse;
	}
	.ExternalClass {
	width: 100%;
	}
	.ExternalClass,
	.ExternalClass p,
	.ExternalClass span,
	.ExternalClass font,
	.ExternalClass td,
	.ExternalClass div {
	line-height: 100%;
	}
	.ReadMsgBody {
	width: 100%;
	background-color: #ebebeb;
	}
	table {
	mso-table-lspace: 0pt;
	mso-table-rspace: 0pt;
	}
	img {
	-ms-interpolation-mode: bicubic;
	}
	.yshortcuts a {
	border-bottom: none !important;
	}
	@media screen and (max-width: 599px) {
	.force-row,
	.container {
	width: 100% !important;
	max-width: 100% !important;
	}
	}
	@media screen and (max-width: 400px) {
	.container-padding {
	padding-left: 12px !important;
	padding-right: 12px !important;
	}
	}
	.ios-footer a {
	color: #aaaaaa !important;
	text-decoration: underline;
	}
	a[href^="x-apple-data-detectors:"],
	a[x-apple-data-detectors] {
	color: inherit !important;
	text-decoration: none !important;
	font-size: inherit !important;
	font-family: inherit !important;
	font-weight: inherit !important;
	line-height: inherit !important;
	}
	</style>
	</head>

	<body style="margin:0; padding:0;" bgcolor="#ffffff" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">

	<!-- 100% background wrapper (grey background) -->
	<table border="0" width="100%" height="100%" cellpadding="0" cellspacing="0" bgcolor="#ffffff">
	<tr>
	<td align="center" valign="top" bgcolor="#ffffff" style="background-color: #ffffff;">

	<br>

	<!-- 600px container (white background) -->
	<table border="0" width="600" cellpadding="0" cellspacing="0" class="container" style="width:600px;max-width:600px">
	<tr>
	<td class="container-padding header" align="center" style="font-family:Helvetica, Arial, sans-serif;font-size:24px;font-weight:bold;padding-bottom:12px;color:#DF4726;padding-left:24px;padding-right:24px">
	<A HREF="https://www.workshopdeaereos.com.ar/" target="_blank"><img src="https://workshopdeaereos.com.ar/assets/img/pics/banner.jpg" style="width:100%;height:auto;" /></a>
	</td>
	</tr>
	<tr>
	<td class="container-padding content" align="left" style="padding-left:24px;padding-right:24px;padding-top:12px;padding-bottom:12px;background-color:#f3f3f3">
	<br>
	<div class="title" style="font-family:Helvetica, Arial, sans-serif;font-size:18px;font-weight:600;color:#374550">Ingresó un nuevo registro al sitio web.</div>
	<br>
	<div class="body-text" style="font-family:Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;text-align:left;color:#333333">
	Los datos son los siguientes:<br />
	Nombre: <b>'.$nombre.'</b><br />
	Apellido: <b>'.$apellido.'</b><br />
	Agencia: <b>'.$agencia.'</b><br />
	Teléfono: <b>'.$telefono.'</b><br />
	Celular: <b>'.$celular.'</b><br />
	Localidad: <b>'.$localidad.'</b><br />
	País: <b>'.$pais.'</b><br />
	E-mail: <b>'.$email.'</b><br />
	Fecha y hora: <b>'.$fecha.'</b><br />
	IP: <b>'.$ip.'</b><br />
	Conexión: <b>'.$conexion.'</b><br />
	Ciudad de conexión: <b>'.$ciudad.'</b><br />
	Provincia de conexión: <b>'.$provincia.'</b><br />
	País de conexión: <b>'.$pais2.'</b><br />
	Latitud: <b>'.$latitud.'</b><br />
	Longitud: <b>'.$longitud.'</b><br />
	<br />
	Esta información y los registros anteriores se pueden encontrar en la base de datos de <b>Workshopsdeaereos.com.ar</b>.

	<br><br>
	</div>

	</td>
	</tr>
	<tr>
	<td class="container-padding content" align="left" style="padding-left:24px;padding-right:24px;padding-top:12px;padding-bottom:12px;">
	</td>
	</tr>
	<tr>
	<td class="container-padding header" align="center" style="font-family:Helvetica, Arial, sans-serif;font-size:24px;font-weight:bold;padding-bottom:12px;color:#DF4726;padding-left:24px;padding-right:24px">
	<A HREF="https://www.workshopdeaereos.com.ar/" target="_blank"><img src="https://workshopdeaereos.com.ar/assets/img/pics/banner2.jpg" style="width:100%;height:auto;" /></a>
	</td>
	</tr>
	</table>
	<!--/600px container -->
	</td>
	</tr>
	</table>
	<!--/100% background wrapper-->
	</body>
	</html>';

		$destino_email = "registracion@workshopdeaereos.com.ar";
		$destino_nombre = "Workshops de Aéreos";
		$mensaje = $mail_body;
		$mail = new PHPMailer(true);
		$mail->IsSMTP();
		$mail->SMTPDebug = 1;
		$mail->SMTPAuth = true;
		$mail->Port = 587;
		$mail->SMTPSecure = 'tls';
		$mail->IsHTML(true);
		$mail->CharSet = "utf-8";
		$mail->Host = $smtpHost;
		$mail->Username = $smtpUsuario;
		$mail->Password = $smtpClave;
		$mail->From = $smtpUsuario;
		$mail->FromName = "Workshops de Aereos";
		$mail->AddAddress($destino_email, $destino_nombre);
		$mail->AddReplyTo($email, $nombre);
		$mail->SetFrom($smtpUsuario, 'Workshops de Aereos');
		$mail->Subject = 'Registro: '.$nombre.' '.$apellido;
		$mensajeHtml = nl2br($mensaje);
		$mail->Body = "{$mail_body}"; // Texto del email en formato HTML
		$mail->AltBody = "{$mensaje}"; // Texto sin formato HTML
		$estadoEnvio2 = $mail->Send();
		
			if($estadoEnvio){
			
				$url = "Location: ".$conf_root."index.php?cuenta=".$email."&nombre=".$nombre;
				header($url);
			
			} else {
				
				$url = "Location: ".$conf_root."index.php?error-email";
				header($url);
				
			}
			
		} else {
		
			$url = "Location: ".$conf_root."index.php?error-email";
			header($url);
		
		}
		
	}
	
}


?>