<?php

echo "
	//===
// VARIABLES
//===
const DATE_TARGET = new Date('".$_GET['m']."/".$_GET['d']."/".$_GET['a']." ".$_GET['h'].":".$_GET['mi']."');
// DOM for render
const SPAN_DAYS = document.querySelector('span#dias');
const SPAN_DAYS_TXT = document.querySelector('span#dias_txt');
const SPAN_HOURS = document.querySelector('span#horas');
const SPAN_MINUTES = document.querySelector('span#minutos');
const SPAN_SECONDS = document.querySelector('span#segundos');
// Milliseconds for the calculations
const MILLISECONDS_OF_A_SECOND = 1000;
const MILLISECONDS_OF_A_MINUTE = MILLISECONDS_OF_A_SECOND * 60;
const MILLISECONDS_OF_A_HOUR = MILLISECONDS_OF_A_MINUTE * 60;
const MILLISECONDS_OF_A_DAY = MILLISECONDS_OF_A_HOUR * 24

//===
// FUNCTIONS
//===

/**
 * Method that updates the countdown and the sample
 */
function updateCountdown() {
    // Calcs
    const NOW = new Date()
    const DURATION = DATE_TARGET - NOW;
    const REMAINING_DAYS = Math.floor(DURATION / MILLISECONDS_OF_A_DAY);
    const REMAINING_HOURS = Math.floor((DURATION % MILLISECONDS_OF_A_DAY) / MILLISECONDS_OF_A_HOUR);
    const REMAINING_MINUTES = Math.floor((DURATION % MILLISECONDS_OF_A_HOUR) / MILLISECONDS_OF_A_MINUTE);
    const REMAINING_SECONDS = Math.floor((DURATION % MILLISECONDS_OF_A_MINUTE) / MILLISECONDS_OF_A_SECOND);
    // Thanks Pablo Monteserín (https://pablomonteserin.com/cuenta-regresiva/)

    // Render
	if (REMAINING_DAYS<10) { 
		SPAN_DAYS.textContent = '0' + REMAINING_DAYS;
		if (REMAINING_DAYS<2) {
			SPAN_DAYS_TXT.textContent = 'DIA';
		} else {
			SPAN_DAYS_TXT.textContent = 'DIAS';
		}
	} else {
		SPAN_DAYS.textContent = REMAINING_DAYS;
	}
	if (REMAINING_HOURS<10) { 
		SPAN_HOURS.textContent = '0' + REMAINING_HOURS;
	} else {
		SPAN_HOURS.textContent = REMAINING_HOURS;
	}
	if (REMAINING_MINUTES<10) { 
		SPAN_MINUTES.textContent = '0' + REMAINING_MINUTES;
	} else {
		SPAN_MINUTES.textContent = REMAINING_MINUTES;
	}
	if (REMAINING_SECONDS<10) { 
		SPAN_SECONDS.textContent = '0' + REMAINING_SECONDS;
	} else {
		SPAN_SECONDS.textContent = REMAINING_SECONDS;
	}
	if (REMAINING_MINUTES<15) {
		
		
		clearInterval(intervalo);
		console.log('chau counter');
		document.getElementById('cuenta_regresiva').style.display = 'none';
		document.getElementById('tuc-streaming').style.display = 'block';
		document.getElementById('streaming-controles').style.display = 'block';
		
		var isMobile = /iPhone|iPad|iPod|Android/i.test(navigator.userAgent);
		if (isMobile) {
			var options = {
				id: 491388217,
				width: 640,
				autoplay: true,
				responsive: true,
				autopause: 0,
				muted: 1,
				controls: true,
				loop: false
			};
			console.log('mobile');
		} else {
			var options = {
				id: 491388217,
				width: 640,
				autoplay: true,
				responsive: true,
				autopause: 0,
				controls: true,
				loop: false
			};
			console.log('desktop');
		}
		

		var player = new Vimeo.Player('streaming', options);

		player.on('play', function(e) {
			 playing = true;
		});

		player.on('pause', function(e) {
			 playing = false;
		});

		player.setVolume(50);
		
		player.getMuted().then(function(muted) {
			console.log('Sonido muteado'+muted);
			if (muted==false) {
				$('#volumen1').hide();
				$('#volumen0').show();
			} else {
				$('#volumen0').hide();
				$('#volumen1').show();
			}
			// muted = whether muted is turned on or not
		}).catch(function(error) {
			// an error occurred
		});
		
		player.getQuality().then(function(quality) {
			console.log('calidad: '+quality);
			// quality = the current selected quality
		}).catch(function(error) {
			// an error occurred
		});

		$('#streaming')[0].scrollIntoView(true);

		player.on('play', function() {
			console.log('inicio el video');
			player.setVolume(50);
			
			$('#calidad').on('change', function() {
				console.log('cambio a '+this.value);
				var valor_calidad = this.value;
				player.setQuality(valor_calidad).then(function(quality) {
					// quality was successfully set
				}).catch(function(error) {
					switch (error.name) {
						case 'TypeError':
							// the quality selected is not valid
							break;

						default:
							// some other error occurred
							break;
					}
				});
			});
			
			$('#fullscreen').click(function(){
				console.log('pantalla completa');
				player.requestFullscreen().then(function() {
					// the player entered fullscreen
				}).catch(function(error) {
					// an error occurred
				});
			});
			$('#volumen0').click(function(){
				console.log('bajo volumen');
				$('#volumen0').hide();
				$('#volumen1').show();
				player.setVolume(0).then(function(volume) {
					// volume was set
					console.log('volumen ajuste');
				}).catch(function(error) {
					switch (error.name) {
						case 'RangeError':
							console.log('volumen ajuste 2');
							// the volume was less than 0 or greater than 1
							break;

						default:
							console.log('volumen ajuste 3');
							// some other error occurred
							break;
					}
				});
			});			
			$('#volumen1').click(function(){
				console.log('subo volumen');
				$('#volumen1').hide();
				$('#volumen0').show();
				player.setVolume(1).then(function(volume) {
					// volume was set
					console.log('volumen ajuste');
				}).catch(function(error) {
					switch (error.name) {
						case 'RangeError':
							console.log('volumen ajuste 2');
							// the volume was less than 0 or greater than 1
							break;

						default:
							console.log('volumen ajuste 3');
							// some other error occurred
							break;
					}
				});
			});
			
		});
		
		player.setCurrentTime(".$_GET['dif'].".456).then(function(seconds) { // SEGUNDOS sss.456
		}).catch(function(error) {
			switch (error.name) {
				case 'RangeError':
					// si nos pasamos de la duración del video
					break;
				default:
					// otro error
					break;
			}
		});
		
		// termina el video, activo acción
		player.on('ended', function() {
			console.log('termino el video.');
			document.getElementById('tuc-streaming').style.display = 'none';
			document.getElementById('la_encuesta').style.display = 'block';
			$('#popup_encuesta').show();
			//cargar_video_completo();
		});
		
		setTimeout( function(){ 
    $('#streaming').trigger('click');
  }  , 3000 );
		
		
		
		
	}
}

//===
// INIT
//===
updateCountdown();
// Refresh every second

var intervalo = setInterval(updateCountdown, MILLISECONDS_OF_A_SECOND);


";

?>