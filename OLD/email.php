<?php

$email = "nicolasmentasti@gmail.com";
$nombre = "Nicolas";
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
<A HREF="https://www.tucanotours.com.ar/" target="_blank"><img src="https://www.tucanotours.com.ar/img/logos/tucano-tours.png" /></a>
</td>
</tr>
<tr>
<td class="container-padding content" align="left" style="padding-left:24px;padding-right:24px;padding-top:12px;padding-bottom:12px;background-color:#f3f3f3">
<br>
<div class="title" style="font-family:Helvetica, Arial, sans-serif;font-size:18px;font-weight:600;color:#374550">Ingres?? un nuevo registro al sitio web.</div>
<br>
<div class="body-text" style="font-family:Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;text-align:left;color:#333333">
Los datos son los siguientes:<br />
Nombre: <b>'.$nombre.'</b><br />
Apellido: <b>'.$apellido.'</b><br />
Agencia: <b>'.$agencia.'</b><br />
Tel??fono: <b>'.$telefono.'</b><br />
Celular: <b>'.$celular.'</b><br />
Localidad: <b>'.$localidad.'</b><br />
Pa??s: <b>'.$pais.'</b><br />
E-mail: <b>'.$email.'</b><br />
Fecha y hora: <b>'.$fecha.'</b><br />
<br />
Esta informaci??n y los registros anteriores se pueden encontrar en la base de datos de <b>Workshopsdeaereos.com.ar</b>.

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
<strong>Tucanotours.com.ar</strong><br>
<span class="ios-footer">
Tel/Fax: <br />
Direcci??n<br />
<a href="mailto:email@Tucanotours.com.ar">email@Tucanotours.com.ar</a>
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

	require_once("assets/inc/class.phpmailer.php");
	require_once("assets/inc/class.smtp.php");
	$destino_email = "nicolasmentasti@gmail.com";
	$destino_nombre = "Workshops de A??reos";
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
	$mail->FromName = "Workshops de A??reos";
	$mail->AddAddress('nicolasmentasti@gmail.com', 'Workshops de A??reos');
	$mail->AddReplyTo($email, $nombre);
	$mail->SetFrom($smtpUsuario, 'Workshops de A??reos');
	$mail->Subject = 'Nuevo registro en sitio web';
	$mensajeHtml = nl2br($mensaje);
	$mail->Body = "{$mail_body}"; // Texto del email en formato HTML
	$mail->AltBody = "{$mensaje}"; // Texto sin formato HTML
	$estadoEnvio = $mail->Send();

	if($estadoEnvio){
			echo "ok";
	}

?>