<?php include('configuracion.php');

// LOGOUT
if (isset($_GET['logout'])) {
	
	session_destroy();
	$url = "Location: ".$conf_root;
	header($url);
	
}

// RECORDAR PASSWORD
if (isset($_POST['recordar'])) {
	
	// limpieza
	$email = limpiar_ingreso($_POST['email']);
	
	$clave = 0;
	$sql = "select * 
	from mbc20_usuarios 
	WHERE email = '".$email."'
	LIMIT 1;";
	$ejecutarsql = mysqli_query ($link, $sql);
	while ($dato = mysqli_fetch_assoc($ejecutarsql)) { 
		$clave = $dato['clave'];
		$nombre = $dato['nombre'];
	}

	$creacion = date("Y-m-d H:i:s");
	
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
<A HREF="https://www.merz.com/" target="_blank"><img src="https://www.merz.com/assets/brands/corporate/images/merz_logo.png" /></a>
</td>
</tr>
<tr>
<td class="container-padding content" align="left" style="padding-left:24px;padding-right:24px;padding-top:12px;padding-bottom:12px;background-color:#f3f3f3">
<br>
<div class="title" style="font-family:Helvetica, Arial, sans-serif;font-size:18px;font-weight:600;color:#374550">Hola '.$nombre.'!</div>
<br>
<div class="body-text" style="font-family:Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;text-align:left;color:#333333">
Solicitaste recordar tu clave.<br />
Tus credenciales de acceso son las siguientes:<br />
<b>E-mail</b>: '.$email.'<br />
<b>Clave</b>: '.$clave.'<br /><br>
Merz Beauty Check te invita a volver a intentar el ingreso en el siguiente <a href="'.$conf_root.'" target="_blank">link</a>.
<br><br>
</div>

</td>
</tr>
<tr>
<td class="container-padding content" align="left" style="padding-left:24px;padding-right:24px;padding-top:12px;padding-bottom:12px;">
</td>
</tr>
<tr>
<td class="container-padding footer-text" align="left" style="font-family:Helvetica, Arial, sans-serif;font-size:12px;line-height:16px;color:#aaaaaa;padding-left:24px;padding-right:24px">
<br><br>
<strong>Merz.com.ar</strong><br>
<span class="ios-footer">
Tel/Fax: <br />
Dirección<br />
<a href="mailto:email@email.com">email@email.com</a>
</span>
<br><br>
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

	require_once("class.phpmailer.php");
	require_once("class.smtp.php");
	$destino_email = $email;
	$destino_nombre = "Merz Beauty Check";
	$mensaje = $mail_body;
	$mail = new PHPMailer();
	$mail->IsSMTP();
	$mail->SMTPDebug = 1;
	$mail->SMTPAuth = true;
	$mail->Port = 465;
	$mail->SMTPSecure = 'ssl';
	$mail->IsHTML(true);
	$mail->CharSet = "utf-8";
	$mail->Host = $smtpHost;
	$mail->Username = $smtpUsuario;
	$mail->Password = $smtpClave;
	$mail->From = $smtpUsuario;
	$mail->FromName = "Merz Beauty Check";
	$mail->AddAddress($email, $nombre);
	$mail->AddReplyTo($smtpUsuario, 'Merz Beauty Check');
	$mail->SetFrom($smtpUsuario, 'Merz Beauty Check');
	$mail->Subject = 'Recordar clave';
	$mensajeHtml = nl2br($mensaje);
	$mail->Body = "{$mail_body}"; // Texto del email en formato HTML
	$mail->AltBody = "{$mensaje}"; // Texto sin formato HTML
	
	if ($nombre!="") {
		$estadoEnvio = $mail->Send();
		if($estadoEnvio){
			
			$url = "Location: ".$conf_root."index.php?password-verificar-cuenta=".$email."&password-verificar-nombre=".$nombre;
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

// BUSCAR
if (isset($_GET['buscar'])) {
	
	$sql = "select *, 
	mbc20_motivos.motivo as 'mot'
	from mbc20_pacientes 
	LEFT JOIN mbc20_motivos
	ON mbc20_pacientes.motivo = mbc20_motivos.id
	WHERE idusuario = '".$_SESSION['id_usuario']."'";

	if ( ($_GET['filtro']>0)and($_GET['filtro']<=5) ) {
		$sql .= " AND mbc20_pacientes.motivo = ".$_GET['filtro'];
	}
	if ($_GET['filtro']=="realizado" ) {
		$sql .= " AND mbc20_pacientes.tratamiento_realizado = 1";
	} else if ($_GET['filtro']=="pendiente" ) {
		$sql .= " AND mbc20_pacientes.tratamiento_realizado = 0";
	}
	if ($_GET['buscador']!="" ) {
		$sql .= " AND ( (mbc20_pacientes.nombre LIKE '%".$_GET['buscador']."%')or(mbc20_pacientes.nombre LIKE '%".$_GET['buscador']."')or(mbc20_pacientes.nombre LIKE '".$_GET['buscador']."%')or(mbc20_pacientes.nombre LIKE '".$_GET['buscador']."')or(mbc20_pacientes.apellido LIKE '%".$_GET['buscador']."%')or(mbc20_pacientes.apellido LIKE '%".$_GET['buscador']."')or(mbc20_pacientes.apellido LIKE '".$_GET['buscador']."%')or(mbc20_pacientes.apellido LIKE '".$_GET['buscador']."')or(mbc20_pacientes.idpaciente LIKE '%".$_GET['buscador']."%')or(mbc20_pacientes.idpaciente LIKE '%".$_GET['buscador']."')or(mbc20_pacientes.idpaciente LIKE '".$_GET['buscador']."%')or(mbc20_pacientes.idpaciente LIKE '".$_GET['buscador']."') )";
	}
	
	$sql .= " ORDER BY idpaciente ASC;";
	$ejecutarsql = mysqli_query ($link, $sql);
	$contenido = "";
	while ($dato = mysqli_fetch_assoc($ejecutarsql)) {
		
						$contenido .= '<tr>
							<th scope="row"><a href="#" title="Click para ver detalle">';
							if ($dato['idpaciente']<10) { 
								$contenido .= "0000"; 
							} else if ($dato['idpaciente']<100) { 
								$contenido .= "000"; 
							} else if ($dato['idpaciente']<1000) { 
								$contenido .= "00"; 
							} else if ($dato['idpaciente']<10000) { 
								$contenido .= "0"; 
							}
							$contenido .= $dato['idpaciente'];
							$contenido .= '</a></th>';
							$contenido .= '<td>'.strtoupper($dato['nombre']).' '.strtoupper($dato['apellido']).'</td>';
							$contenido .= '<td>';

							$contenido .= date("d", strtotime($dato['fecha_diagnostico']));
							$contenido .= "/";
							$contenido .= date("m", strtotime($dato['fecha_diagnostico'])); 
							$contenido .= "/";
							$contenido .= date("Y", strtotime($dato['fecha_diagnostico']));
							
							$contenido .= '</td>';
							$contenido .= '<td>'.$dato['mot'].'</td>';
							$contenido .= '<td>';		
								$contenido .= '<input type="date" name="proximo_control" id="proximo_control" value="'.$dato['proximo_control'].'" onChange="';
								$contenido .= "actualizar(this.value,'proximo_control',".$dato['idpaciente'].");";
								$contenido .= '" />';
							$contenido .= '</td>';		
							$contenido .= '<td>';		
								$contenido .= '<input type="checkbox" name="tratamiento_realizado" id="tratamiento_realizado" value="1" onChange="';
								$contenido .= "actualizar(this.value,'tratamiento_realizado',".$dato['idpaciente'].");";
								$contenido .= '" ';
								if ($dato['tratamiento_realizado']==1) { $contenido .= 'checked="checked"'; } $contenido .= " />";
							$contenido .= '</td>';		
							$contenido .= '<td>';		
								$contenido .= '<input type="date" name="fecha_realizacion" id="fecha_realizacion" value="'. $dato['fecha_realizacion'].'" onChange="';
								$contenido .= "actualizar(this.value,'fecha_realizacion',".$dato['idpaciente'].");"; $contenido .= '" />';
							$contenido .= '</td>';
		
						$contenido .= '</tr>';
		
	}
	
	if ($contenido=="") { // no encontró nada
		$contenido = "No se encontraron resultados.";
	}

	$respuesta['status'] = 'ok';
	$respuesta['contenido'] = $contenido;
	$respuesta['sql'] = $sql;
	echo json_encode($respuesta);	
	
}

// ACTUALIZAR
if (isset($_GET['actualizar'])) {
	
	$sql = "UPDATE mbc20_pacientes SET ".$_GET['dato']." = '".$_GET['valor']."' WHERE idusuario = ".$_SESSION['id_usuario']." AND idpaciente = ".$_GET['id']." LIMIT 1;";
	$execute = mysqli_query($link, $sql);

	$respuesta['status'] = 'ok';
	echo json_encode($respuesta);	
	
}

// LOGIN DE USUARIO
if (isset($_POST['ingreso'])) {
	
	$enc=0;
	$sql = "select * 
	from mbc20_usuarios 
	WHERE 
	email = '".$_POST['usuario']."'
	AND clave = '".$_POST['clave']."'
	LIMIT 1;";
	$ejecutarsql = mysqli_query ($link, $sql);
	while ($dato = mysqli_fetch_assoc($ejecutarsql)) {
		$enc++;
		$_SESSION['login']=1;
		$_SESSION['id_usuario']=$dato['id'];
		$_SESSION['nombre_usuario']=$dato['nombre'];
		$_SESSION['apellido_usuario']=$dato['apellido'];
		$_SESSION['email_usuario']=$dato['email'];
	}
	
	// si encontró al usuario
	if ($enc>0) {
		
		$url = "Location: ".$conf_root."?login";
		header($url);
		
	} else {
		
		$url = "Location: ".$conf_root."?error_login";
		header($url);
		
	}
	
}

// CREAR USUARIO
if (isset($_POST['crear_usuario'])) {
	
	// BUSCO ID NUEVO
	$idnuevo = 0;
	$usuarionuevo = 0;
	$sql = "select * 
	from mbc20_usuarios 
	ORDER BY id DESC
	LIMIT 1;";
	$ejecutarsql = mysqli_query ($link, $sql);
	while ($dato = mysqli_fetch_assoc($ejecutarsql)) { 
		$idnuevo = $dato['id']+1;
	}
	
	// limpieza
	$_POST['nombre'] = limpiar_ingreso($_POST['nombre']);
	$_POST['apellido'] = limpiar_ingreso($_POST['apellido']);
	$_POST['especialidad'] = limpiar_ingreso($_POST['especialidad']);
	$_POST['matricula'] = limpiar_ingreso($_POST['matricula']);
	$_POST['cuit'] = limpiar_ingreso($_POST['cuit']);
	$_POST['clinica'] = limpiar_ingreso($_POST['clinica']);
	$_POST['ciudad'] = limpiar_ingreso($_POST['ciudad']);
	$_POST['telefono'] = limpiar_ingreso($_POST['telefono']);
	$_POST['nacimiento'] = limpiar_ingreso($_POST['nacimiento']);
	$_POST['email'] = limpiar_ingreso($_POST['email']);
	
	// validaciones
	if(!preg_match("/^[[:alnum:]][a-z0-9_.-]*@[a-z0-9.-]+\.[a-z]{2,4}$/i", $_POST['email'])) { // valido email
		header("Location: index.php?email_incorrecto");
	}
	
	$conn = new mysqli($conf_host, $conf_user, $conf_pass, $conf_base);
	if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
	}
	$stmt = $conn->prepare("INSERT INTO mbc20_usuarios (id, nombre, apellido, especialidad, matricula, cuit, clinica, ciudad, telefono, email, nacimiento, creacion, clave, habilitado) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
	$stmt->bind_param("isssssssssssss", $id, $nombre, $apellido, $especialidad, $matricula, $cuit, $clinica, $ciudad, $telefono, $email, $nacimiento, $creacion, $password, $habilitado);

	$id = $idnuevo;
	$nombre = $_POST['nombre'];
	$apellido = $_POST['apellido'];
	$especialidad = $_POST['especialidad'];
	$matricula = $_POST['matricula'];
	$cuit = $_POST['cuit'];
	$clinica = $_POST['clinica'];
	$ciudad = $_POST['ciudad'];
	$telefono = $_POST['telefono'];
	$email = $_POST['email'];
	$nacimiento = $_POST['nacimiento'];
	$creacion = date("Y-m-d H:i:s");
	
	$password = codigo_alfanumerico(8);
	$habilitado = 1;
	
	$stmt->execute();
	$stmt->close();
	$conn->close();			
	
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
<A HREF="https://www.merz.com/" target="_blank"><img src="https://www.merz.com/assets/brands/corporate/images/merz_logo.png" /></a>
</td>
</tr>
<tr>
<td class="container-padding content" align="left" style="padding-left:24px;padding-right:24px;padding-top:12px;padding-bottom:12px;background-color:#f3f3f3">
<br>
<div class="title" style="font-family:Helvetica, Arial, sans-serif;font-size:18px;font-weight:600;color:#374550">Bienvenido '.$nombre.'</div>
<br>
<div class="body-text" style="font-family:Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;text-align:left;color:#333333">
Merz Beauty Check se encuentra en proceso de verificar tus datos. A la brevedad recibirás un nuevo mensaje con tus datos de acceso.
<br><br>
</div>

</td>
</tr>
<tr>
<td class="container-padding content" align="left" style="padding-left:24px;padding-right:24px;padding-top:12px;padding-bottom:12px;">
</td>
</tr>
<tr>
<td class="container-padding footer-text" align="left" style="font-family:Helvetica, Arial, sans-serif;font-size:12px;line-height:16px;color:#aaaaaa;padding-left:24px;padding-right:24px">
<br><br>
<strong>Merz.com.ar</strong><br>
<span class="ios-footer">
Tel/Fax: <br />
Dirección<br />
<a href="mailto:email@email.com">email@email.com</a>
</span>
<br><br>
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

	require_once("class.phpmailer.php");
	require_once("class.smtp.php");
	$destino_email = $email;
	$destino_nombre = "Merz Beauty Check";
	$mensaje = $mail_body;
	$mail = new PHPMailer();
	$mail->IsSMTP();
	$mail->SMTPDebug = 1;
	$mail->SMTPAuth = true;
	$mail->Port = 465;
	$mail->SMTPSecure = 'ssl';
	$mail->IsHTML(true);
	$mail->CharSet = "utf-8";
	$mail->Host = $smtpHost;
	$mail->Username = $smtpUsuario;
	$mail->Password = $smtpClave;
	$mail->From = $smtpUsuario;
	$mail->FromName = "Merz Beauty Check";
	$mail->AddAddress($email, $nombre);
	$mail->AddReplyTo($smtpUsuario, 'Merz Beauty Check');
	$mail->SetFrom($smtpUsuario, 'Merz Beauty Check');
	$mail->Subject = 'Tu cuenta esta siendo revisada';
	$mensajeHtml = nl2br($mensaje);
	$mail->Body = "{$mail_body}"; // Texto del email en formato HTML
	$mail->AltBody = "{$mensaje}"; // Texto sin formato HTML
	$estadoEnvio = $mail->Send();
	if($estadoEnvio){
		
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
		<A HREF="https://www.merz.com/" target="_blank"><img src="https://www.merz.com/assets/brands/corporate/images/merz_logo.png" /></a>
		</td>
		</tr>
		<tr>
		<td class="container-padding content" align="left" style="padding-left:24px;padding-right:24px;padding-top:12px;padding-bottom:12px;background-color:#f3f3f3">
		<br>
		<div class="title" style="font-family:Helvetica, Arial, sans-serif;font-size:18px;font-weight:600;color:#374550">Bienvenido '.$nombre.'</div>
		<br>
		<div class="body-text" style="font-family:Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;text-align:left;color:#333333">
		Merz Beauty Check aprobó tu cuenta. Por favor, haz click en el botón a continuación e ingresa tus datos de acceso:<br />
		Usuario: <b>'.$email.'</b><br />Contraseña: <b>'.$password.'</b><br /><br />
		<a href="'.$conf_root.'index.php" target="_blank">INGRESA</a>
		<br><br>
		</div>

		</td>
		</tr>
		<tr>
		<td class="container-padding content" align="left" style="padding-left:24px;padding-right:24px;padding-top:12px;padding-bottom:12px;">
		</td>
		</tr>
		<tr>
		<td class="container-padding footer-text" align="left" style="font-family:Helvetica, Arial, sans-serif;font-size:12px;line-height:16px;color:#aaaaaa;padding-left:24px;padding-right:24px">
		<br><br>
		<strong>Merz.com.ar</strong><br>
		<span class="ios-footer">
		Tel/Fax: <br />
		Dirección<br />
		<a href="mailto:email@email.com">email@email.com</a>
		</span>
		<br><br>
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

			$destino_email = $email;
			$destino_nombre = "Merz Beauty Check";
			$mensaje = $mail_body;
			$mail = new PHPMailer();
			$mail->IsSMTP();
			$mail->SMTPDebug = 1;
			$mail->SMTPAuth = true;
			$mail->Port = 465;
			$mail->SMTPSecure = 'ssl';
			$mail->IsHTML(true);
			$mail->CharSet = "utf-8";
			$mail->Host = $smtpHost;
			$mail->Username = $smtpUsuario;
			$mail->Password = $smtpClave;
			$mail->From = $smtpUsuario;
			$mail->FromName = "Merz Beauty Check";
			$mail->AddAddress($email, $nombre);
			$mail->AddReplyTo($smtpUsuario, 'Merz Beauty Check');
			$mail->SetFrom($smtpUsuario, 'Merz Beauty Check');
			$mail->Subject = 'Tus credenciales de acceso';
			$mensajeHtml = nl2br($mensaje);
			$mail->Body = "{$mail_body}"; // Texto del email en formato HTML
			$mail->AltBody = "{$mensaje}"; // Texto sin formato HTML
			$estadoEnvio = $mail->Send();
		
		$url = "Location: ".$conf_root."index.php?verificar-cuenta=".$email."&verificar-nombre=".$nombre;
		header($url);
	
	} else {
	
		$url = "Location: ".$conf_root."index.php?error-email";
		header($url);
	
	}
	
}

// CREAR PACIENTE
if (isset($_POST['paciente'])) {
	
	// BUSCO ID NUEVO
	$idnuevo = 0;
	$usuarionuevo = 0;
	$sql = "select * 
	from mbc20_pacientes 
	ORDER BY idpaciente DESC
	LIMIT 1;";
	$ejecutarsql = mysqli_query ($link, $sql);
	while ($dato = mysqli_fetch_assoc($ejecutarsql)) { 
		$idnuevo = $dato['idpaciente']+1;
	}
	
	// limpieza
	$_POST['imagen'] = limpiar_ingreso($_POST['imagen']);
	$_POST['nombre'] = limpiar_ingreso($_POST['nombre']);
	$_POST['apellido'] = limpiar_ingreso($_POST['apellido']);
	$_POST['nacimiento'] = limpiar_ingreso($_POST['nacimiento']);
	$_POST['genero'] = limpiar_ingreso($_POST['genero']);
	$_POST['email'] = limpiar_ingreso($_POST['email']);
	$_POST['nro'] = limpiar_ingreso($_POST['nro']);
	$_POST['motivo'] = limpiar_ingreso($_POST['motivo']);
	$_POST['observaciones'] = limpiar_ingreso($_POST['observaciones']);
	
	$conn = new mysqli($conf_host, $conf_user, $conf_pass, $conf_base);
	if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
	}
	$stmt = $conn->prepare("INSERT INTO mbc20_pacientes (idpaciente, idusuario, nombre, apellido, nacimiento, genero, email, nro, motivo, observaciones, fecha_diagnostico, proximo_control, tratamiento_realizado, fecha_realizacion, creado, modificado) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
	$stmt->bind_param("iissssssisssisss", $idpaciente, $idusuario, $nombre, $apellido, $nacimiento, $genero, $email, $nro, $motivo, $observaciones, $fecha_diagnostico, $proximo_control, $tratamiento_realizado, $fecha_realizacion, $creado, $modificado);

	$idpaciente = $idnuevo;
	$idusuario = $_SESSION['id_usuario'];
	$nombre = $_POST['nombre'];
	$apellido = $_POST['apellido'];
	$nacimiento = $_POST['nacimiento'];
	$genero = $_POST['genero'];
	$email = $_POST['email'];
	$nro = $_POST['nro'];
	$motivo = $_POST['motivo'];
	$observaciones = $_POST['observaciones'];
	$fecha_diagnostico = date("Y-m-d");
	$proximo_control = "0000-00-00 00:00:00";
	$tratamiento_realizado = 0;
	$fecha_realizacion = "0000-00-00 00:00:00";
	$creado = date("Y-m-d H:i:s");
	$modificado = date("Y-m-d H:i:s");
	
	$stmt->execute();
	$stmt->close();
	$conn->close();	

	// cargo la foto pre dibujo
	$idfoto = 0;
	$sql = "select * 
	from mbc20_fotos
	ORDER BY idfoto DESC
	LIMIT 1;";
	$ejecutarsql = mysqli_query ($link, $sql);
	while ($dato = mysqli_fetch_assoc($ejecutarsql)) { 
		$idfoto = $dato['idfoto']+1;
	}
	
	$conn = new mysqli($conf_host, $conf_user, $conf_pass, $conf_base);
	if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
	}
	$stmt = $conn->prepare("INSERT INTO mbc20_fotos (idfoto, idpaciente, foto, dibujo) VALUES (?,?,?,?)");
	$stmt->bind_param("iisi", $idfoto, $idpaciente, $foto, $dibujo);

	$idfoto = $idfoto;
	$idpaciente = $idpaciente;
	if ($_POST['imagen']==2) { // si elegí croquis
		$_SESSION['imagen'] = "";
		$foto = "croquis";
	} else {
		$foto = $_SESSION['imagen'];
	}
	$dibujo = 0;
	
	$stmt->execute();
	$stmt->close();
	$conn->close();	
	
	$url = "Location: ".$conf_root."evaluacion.php?informe=".$idnuevo;
	header($url);
	
}

// CREAR EVALUACIÓN
if (isset($_POST['evaluacion'])) {
	
	// BUSCO ID NUEVO
	$idnuevo = 0;
	$usuarionuevo = 0;
	$sql = "select * 
	from mbc20_pacientes 
	ORDER BY idpaciente DESC
	LIMIT 1;";
	$ejecutarsql = mysqli_query ($link, $sql);
	while ($dato = mysqli_fetch_assoc($ejecutarsql)) { 
		$idnuevo = $dato['idpaciente']+1;
	}
	
	// limpieza
	$_POST['observaciones'] = limpiar_ingreso($_POST['observaciones']);
	$_POST['proximo_control'] = limpiar_ingreso($_POST['proximo_control']);
	
	// editar informe paciente
	$modificado = date("Y-m-d H:i:s");
	$sql = "UPDATE `mbc20_pacientes` 
	SET 
	`observaciones` = '".$_POST['observaciones']."',
	`proximo_control` = '".$_POST['proximo_control']."',
	`modificado` = '".$modificado."'
	WHERE `idpaciente` = ".$_POST['idpaciente']." 
	LIMIT 1;";
	$execute = mysqli_query($link, $sql);
	
	for ($i = 1; $i <= 50; $i++) {
		
		if ( (isset($_POST['cantidad_'.$i]))and($_POST['cantidad_'.$i]!="") ) {
			
			$idaplicacion = 0;
			$sql = "select * 
			from mbc20_aplicaciones
			ORDER BY idaplicacion DESC
			LIMIT 1;";
			$ejecutarsql = mysqli_query ($link, $sql);
			while ($dato = mysqli_fetch_assoc($ejecutarsql)) { 
				$idaplicacion = $dato['idaplicacion']+1;
			}
			$conn = new mysqli($conf_host, $conf_user, $conf_pass, $conf_base);
			if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
			}
			$stmt = $conn->prepare("INSERT INTO mbc20_aplicaciones (idaplicacion, idpaciente, idprod, cantidad, zona) VALUES (?,?,?,?,?)");
			$stmt->bind_param("iiiss", $idaplicacion, $idpaciente, $idprod, $cantidad, $zona);

			$idaplicacion = $idaplicacion;
			$idpaciente = $_POST['idpaciente'];
			$idprod = $_POST['idprod_'.$i];
			$cantidad = $_POST['cantidad_'.$i];
			$zona = $_POST['zona_'.$i];
	
			$stmt->execute();
			$stmt->close();
			$conn->close();	
			
		}
		
	}
	
	$url = "Location: ".$conf_root."diagnosticos.php?evaluacion=";
	header($url);
	
}

// GRABAR DIBUJO
if (isset($_GET['grabar_dibujo'])) {
	// 2000/11/FOTO
	
	if ($_SESSION['imagen']=="") { // si elegí croquis
	
		$idfoto = 0;
		$sql = "select * 
		from mbc20_pacientes
		WHERE idpaciente = ".$_GET['grabar_dibujo']."
		LIMIT 1;";
		$ejecutarsql = mysqli_query ($link, $sql);
		while ($dato = mysqli_fetch_assoc($ejecutarsql)) { 
			$fecha_diagnostico = $dato['fecha_diagnostico'];
		}
		$anio = substr($fecha_diagnostico, 0, 4);
		$mes = substr($fecha_diagnostico, 5, 2);
		$ruta = $anio . "/" . $mes . "/";
	} else {
		$ruta = substr($_SESSION['imagen'], 0, 9);
	}
	
	
	
	$img = $_POST['imgBase64'];
	$img = str_replace('data:image/png;base64,', '', $img);
	$img = str_replace(' ', '+', $img);
	$data = base64_decode($img);
	$idunico = uniqid();
	$fotourl = $ruta . $idunico . '.png';
	$file = "../../uploads/" . $ruta . $idunico . '.png';
	$success = file_put_contents($file, $data);
	print $success ? $file : 'Unable to save the file.';
	
	$sql = "DELETE FROM mbc20_fotos WHERE dibujo = 1 AND idpaciente = ".$_GET['grabar_dibujo'].";";
	$ejecutarsql = mysqli_query ($link, $sql);
	
	$idfoto = 0;
	$sql = "select * 
	from mbc20_fotos
	ORDER BY idfoto DESC
	LIMIT 1;";
	$ejecutarsql = mysqli_query ($link, $sql);
	while ($dato = mysqli_fetch_assoc($ejecutarsql)) { 
		$idfoto = $dato['idfoto']+1;
	}
	
	$conn = new mysqli($conf_host, $conf_user, $conf_pass, $conf_base);
	if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
	}
	$stmt = $conn->prepare("INSERT INTO mbc20_fotos (idfoto, idpaciente, foto, dibujo) VALUES (?,?,?,?)");
	$stmt->bind_param("iisi", $idfoto, $idpaciente, $foto, $dibujo);

	$idfoto = $idfoto;
	$idpaciente = $_GET['grabar_dibujo'];
	$foto = $fotourl;
	$dibujo = 1;
	
	$stmt->execute();
	$stmt->close();
	$conn->close();
	
}

?>