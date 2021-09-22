<?php

echo "
	//===
// VARIABLES
//===
const DATE_TARGET = new Date('12/17/2020 10:00');
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
	if (REMAINING_SECONDS<0) {
		
		/*
		clearInterval(intervalo);
		console.log('chau counter');
		document.getElementById('contador').style.display = 'none';
		
		var options = {
			id: 16738348,
			width: 640,
			autoplay: true,
			responsive: true,
			controls: false,
			loop: false
		};

		var player = new Vimeo.Player('contenedor', options);

		player.setVolume(0);

		player.on('play', function() {
			console.log('inicio el video');
		});
		
		player.setCurrentTime(000.456).then(function(seconds) { // SEGUNDOS sss.456
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
			document.getElementById('contenedor').style.display = 'none';
			document.getElementById('encuesta').style.display = 'block';
		});
		*/
		
		
	}
}

//===
// INIT
//===
updateCountdown();
// Refresh every second


setInterval(updateCountdown, MILLISECONDS_OF_A_SECOND);



";

?>