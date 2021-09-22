<div class="aviso"></div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="<?php echo $conf_root; ?>assets/bootstrap/js/bootstrap.bundle.js"></script>

<?php if (isset($evaluacion)) { ?>
<script src="<?php echo $conf_root; ?>assets/js/dibujo.js"></script>
<?php } ?>

<script src="<?php echo $conf_root; ?>assets/js/jquery.dataTables.min.js"></script>
<script src="<?php echo $conf_root; ?>assets/js/data-table-act.js"></script>

<script src="https://unpkg.com/dropzone"></script>
<script src="https://unpkg.com/cropperjs"></script>

<script type="text/javascript">

$(document).ready(function() {
	
	var $modal = $('#modal');

	var image = document.getElementById('sample_image');

	var cropper;

	$('#upload_image, #upload_image2').change(function(event){
		var files = event.target.files;

		var done = function(url){
			image.src = url;
			$modal.modal('show');
		};

		if(files && files.length > 0)
		{
			reader = new FileReader();
			reader.onload = function(event)
			{
				done(reader.result);
			};
			reader.readAsDataURL(files[0]);
		}
	});

	$modal.on('shown.bs.modal', function() {
		cropper = new Cropper(image, {
			aspectRatio: 1,
			viewMode: 1,
			preview:'.preview'
		});
	}).on('hidden.bs.modal', function(){
		cropper.destroy();
   		cropper = null;
	});

	$('#crop').click(function(){
		canvas = cropper.getCroppedCanvas({
			width:480,
			height:480
		});

		canvas.toBlob(function(blob){
			url = URL.createObjectURL(blob);
			var reader = new FileReader();
			reader.readAsDataURL(blob);
			reader.onloadend = function(){
				var base64data = reader.result;
				$.ajax({
					url:'assets/inc/upload.php',
					method:'POST',
					data:{image:base64data},
					success:function(data)
					{
						$modal.modal('hide');
						$('.merz-modificar-upload').show();
						$('#uploaded_image').attr('src', data);
					}
				});
			};
		});
	});
	
	$('.aviso').hide();	
	
	$('#imagen').change(function(event){
		var valor = $('#imagen').val();
		if (valor==2) {
			var cargarimagen = document.getElementById('uploaded_image');
			cargarimagen.src = '<?php echo $conf_root; ?>assets/img/pics/croquis.jpg';
		}
	});
	
	
	
	<?php 
	if (isset($_GET['nuevo'])) {
	?>
	$( ".aviso" ).html("Nuevo paciente ingresado con éxito.");
	$('.aviso').show();
	setTimeout(function() {  $('.aviso').fadeOut('slow'); }, 5000);
	<?php
	}
	?>
	
	<?php 
	if (isset($_GET['evaluacion'])) {
	?>
	$( ".aviso" ).html("La evaluación se realizó con éxito.");
	$('.aviso').show();
	setTimeout(function() {  $('.aviso').fadeOut('slow'); }, 5000);
	<?php
	}
	?>
	
	<?php 
	if (isset($_GET['password-verificar-cuenta'])) {
	?>
	var mensaje = "Hola <b><?php echo $_GET['password-verificar-nombre']; ?></b>! Revisa tu casilla de correo (<b><?php echo $_GET['password-verificar-cuenta']; ?></b>) donde encontrarás tus credenciales de acceso.";
	$( ".aviso" ).html(mensaje);
	$('.aviso').show();
	setTimeout(function() {  $('.aviso').fadeOut('slow'); }, 10000);
	<?php
	}
	?>
	
	<?php 
	if (isset($_GET['verificar-cuenta'])) {
	?>
	var mensaje = "Hola <b><?php echo $_GET['verificar-nombre']; ?></b>! En breve te enviaremos por email tus credenciales de acceso. Muchas gracias!";
	$( ".aviso" ).html(mensaje);
	$('.aviso').show();
	setTimeout(function() {  $('.aviso').fadeOut('slow'); }, 10000);
	<?php
	}
	?>
	
	<?php 
	if (isset($_GET['error-email'])) {
	?>
	$( ".aviso" ).html("Tus datos son incorrectos. Por favor, intentalo nuevamente.");
	$('.aviso').show();
	setTimeout(function() {  $('.aviso').fadeOut('slow'); }, 10000);
	<?php
	}
	?>
	
	$('#acepto').click(function(event){
		$('form#crearusuario').submit();
	});
	
});

function buscar() {

	var filtro = $('#filtro').val();
	var buscador = $('#buscador').val();
	var data = new FormData(); 
	var xhr = new XMLHttpRequest(); 
	var destino = '<?php echo $conf_root; ?>assets/inc/procesar.php?buscar=1&filtro='+filtro+'&buscador='+buscador;
	xhr.open('POST', destino, true); 
	xhr.send(data);
	console.log(filtro+buscador);
	xhr.onload = function () {
		var respuesta = JSON.parse(xhr.responseText);
		if(xhr.status === 200 && respuesta.status == 'ok'){
			$( "#listado_diagnosticos" ).html(respuesta.contenido);
			console.log(respuesta.sql);
			console.log(respuesta.contenido);
			$( ".aviso" ).html("Filtro aplicado");
			$('.aviso').show();
			setTimeout(function() {  $('.aviso').fadeOut('slow'); }, 5000);
		} else {
		}
	};
			
}

function actualizar(valor,dato,id) {

			var data = new FormData(); 
			var xhr = new XMLHttpRequest(); 
			var destino = '<?php echo $conf_root; ?>assets/inc/procesar.php?actualizar=1&valor='+valor+'&dato='+dato+'&id='+id;
			xhr.open('POST', destino, true); 
			xhr.send(data);
			xhr.onload = function () {
				var respuesta = JSON.parse(xhr.responseText);
				if(xhr.status === 200 && respuesta.status == 'ok'){
					$( ".aviso" ).html("Informe actualizado");
					$('.aviso').show();
					setTimeout(function() {  $('.aviso').fadeOut('slow'); }, 5000);
				} else {
							
				}
			};
			
}

function terminos_condiciones(){
	
	document.getElementById('terminos_condiciones').style.display="block";
	
	var $modal = $('#terminos_condiciones');
	$modal.modal('show');
	
}

<?php
if (isset($evaluacion)) { 
?>
function guardar_imagen() {
			
			canvas = document.getElementById('imageView');
			var dataURL = canvas.toDataURL();
			console.log(dataURL);
			$.ajax({
			  type: "POST",
			  url: "<?php echo $conf_root; ?>assets/inc/procesar.php?grabar_dibujo=<?php echo $data_inf; ?>",
			  data: { 
				 imgBase64: dataURL
			  }
			}).done(function(o) {
				$('#imagen_fue_editada').val(1);
				$( ".aviso" ).html("Las anotaciones fueron guardadas.");
				$('.aviso').show();
				setTimeout(function() {  $('.aviso').fadeOut('slow'); }, 5000);
			  console.log('dibujo grabado con exito'); 
			});
			
}
<?php
}
?>

</script>