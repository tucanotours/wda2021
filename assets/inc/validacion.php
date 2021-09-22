<script type="text/javascript">
	
	
	function validar_encuesta(form){	
		ErrorText=""; 
		var rating1 = document.querySelector('input[name="rating1"]:checked');
		var rating2 = document.querySelector('input[name="rating2"]:checked');
		var rating3 = document.querySelector('input[name="rating3"]:checked');
		var rating4 = document.querySelector('input[name="rating4"]:checked');
		if ( (rating1==null)||(rating2==null)||(rating3==null)||(rating4==null) ) {
			ErrorText += ".";
			$('#popupencuesta').show();
		}
		if (ErrorText=="") { form.submit() } 
	}
	
	function validar_encuesta_popup(form){	
		ErrorText=""; 
		console.log("encuesta popup empiezo a procesar");
		var ratingpop1 = document.querySelector('input[name="ratingpop1"]:checked');
		var ratingpop2 = document.querySelector('input[name="ratingpop2"]:checked');
		var ratingpop3 = document.querySelector('input[name="ratingpop3"]:checked');
		var ratingpop4 = document.querySelector('input[name="ratingpop4"]:checked');
		$('#formencuesta').submit();
		if ( (ratingpop1==null)||(ratingpop2==null)||(ratingpop3==null)||(ratingpop4==null) ) {
			ErrorText += ".";
			console.log("problema enc");
			$('#encuesta_mensaje').html("Por favor, completa las cuatro preguntas de la encuesta.");
		} else {
			console.log("sin problema enc");
			ErrorText=""; 
		}
		if (ErrorText=="") {
			console.log("proceso encuesta popup");
			 $('#formencuesta').submit();
		} 
	}
	
	function validar_registro(form){	
		ErrorText=""; 
		if (form.nombre.value=="") { ErrorText += "."; verde("nombre"); } else { blanco("nombre"); }
		if (form.apellido.value=="") { ErrorText += "."; verde("apellido"); } else { blanco("apellido"); }
		if (form.agencia.value=="") { ErrorText += "."; verde("agencia"); } else { blanco("agencia"); }
		if (form.telefono.value=="") { ErrorText += "."; verde("telefono"); } else { blanco("telefono"); }
		if (form.celular.value=="") { ErrorText += "."; verde("celular"); } else { blanco("celular"); }
		if (form.localidad.value=="") { ErrorText += "."; verde("localidad"); } else { blanco("localidad"); }
		if (form.pais.value=="") { ErrorText += "."; verde("pais"); } else { blanco("pais"); }
		
		if ((form.email.value == "")||(form.email.value=="EMAIL")) { 
			ErrorText += "."; verde("email");
		} else {
			var x=form.email.value;
			var arroba=x.indexOf("@");
			var punto=x.lastIndexOf(".");
			if (arroba<1 || punto<arroba+2 || punto+2>=x.length) {
				ErrorText += "\n* ingresa una dirección de correo valida."; verde("email");
			} else {
				blanco("email");
			}
		}
		
		if (ErrorText!="") { 
			document.getElementById("errromsg").innerHTML = "Por favor, complet&aacute; los campos sombreados.";
		} 
		if (ErrorText=="") { form.submit() } 
	}
	
	function blanco(x) {
		document.getElementById(x).style.borderBottom = "1px solid #fff";
		var x = "label_"+x;
		document.getElementById(x).style.color="#5D5E5E";
		
	}
	function verde(x) {
		document.getElementById(x).placeholder='* Por favor, completar';
		document.getElementById(x).style.borderBottom = "1px solid #01A569";
		var x = "label_"+x;
		document.getElementById(x).style.color="#01A569";	
	}
</script>