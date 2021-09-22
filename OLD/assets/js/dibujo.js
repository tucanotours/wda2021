/* © 2009 ROBO Design
 * http://www.robodesign.ro
 */
 
 
 /*
 COLOR LINEA
 context.strokeStyle = '#ff0000';
  context.strokeStyle = color_select.value;
 
 */

// Keep everything in anonymous function, called on window load.
if(window.addEventListener) {
window.addEventListener('load', function () {
  var canvas, context, canvaso, contexto;

  var colorelegido;
  // The active tool instance.
  var tool;
  var tool_default = 'line';
  
  var color;
  var color_default = '#000000';

  function init () {
    // Find the canvas element.
    canvaso = document.getElementById('imageView');
    if (!canvaso) {
      //alert('Error: I cannot find the canvas element!');
      return;
    }

    if (!canvaso.getContext) {
      ////alert('Error: no canvas.getContext!');
      return;
    }

    // Get the 2D canvas context.
    contexto = canvaso.getContext('2d');
    if (!contexto) {
      ////alert('Error: failed to getContext!');
      return;
    }

    // Add the temporary canvas.
    var container = canvaso.parentNode;
    canvas = document.createElement('canvas');
    if (!canvas) {
      ////alert('Error: I cannot create a new canvas element!');
      return;
    }

    canvas.id     = 'imageTemp';
    canvas.width  = canvaso.width;
    canvas.height = canvaso.height;
    container.appendChild(canvas);

    context = canvas.getContext('2d');

    // Get the tool select input.
	
    var tool_select = document.getElementById('dtool');
	//alert(tool_select);
    if (!tool_select) {
      ////alert('Error: failed to get the dtool element!');
      return;
    }
    tool_select.addEventListener('change', ev_tool_change, false);
	
	var inputs=document.querySelectorAll("input[name=modo]"),
    x=inputs.length;
	while(x--)
	inputs[x].addEventListener("change", ev_tool_change, false); 
	
	var inputs=document.querySelectorAll("input[name=rgb]"),
    x=inputs.length;
	while(x--)
	inputs[x].addEventListener("change", ev_color_change, this.value); 

    // Activate the default tool.
    if (tools[tool_default]) {
      tool = new tools[tool_default]();
      tool_select.value = tool_default;
	  console.log("modo: "+tool_select.value);
    }

    // Attach the mousedown, mousemove and mouseup event listeners.
    canvas.addEventListener('mousedown', ev_canvas, false);
    canvas.addEventListener('mousemove', ev_canvas, false);
    canvas.addEventListener('mouseup',   ev_canvas, false);
  }

  // The general-purpose event handler. This function just determines the mouse 
  // position relative to the canvas element.
  function ev_canvas (ev) {
    if (ev.layerX || ev.layerX == 0) { // Firefox
      ev._x = ev.layerX;
      ev._y = ev.layerY;
    } else if (ev.offsetX || ev.offsetX == 0) { // Opera
      ev._x = ev.offsetX;
      ev._y = ev.offsetY;
    }

    // Call the event handler of the tool.
    var func = tool[ev.type];
    if (func) {
      func(ev);
    }
  }

  function cambiar_herramienta(x) {
	console.log("cambiar modo: "+x);
    if (tools[x]) {
      tool = new tools[x]();
    }
  }

  // The event handler for any changes made to the tool selector.
  function ev_tool_change (ev) {
	console.log("cambio modo: "+this.value);
    if (tools[this.value]) {
      tool = new tools[this.value]();
    }
  }
  
  // The event handler for any changes made to the color selector.
  function ev_color_change (ev) {
	colorelegido = this.value;
  }

  // This function draws the #imageTemp canvas on top of #imageView, after which 
  // #imageTemp is cleared. This function is called each time when the user 
  // completes a drawing operation.
  function img_update () {
		contexto.drawImage(canvas, 0, 0);
		context.clearRect(0, 0, canvas.width, canvas.height);
  }

  // This object holds the implementation of each drawing tool.
  var tools = {};

  // The drawing pencil.
  tools.pencil = function () {
    var tool = this;
    this.started = false;

    // This is called when you start holding down the mouse button.
    // This starts the pencil drawing.
    this.mousedown = function (ev) {
        context.beginPath();
        context.moveTo(ev._x, ev._y);
        tool.started = true;
    };

    // This function is called every time you move the mouse. Obviously, it only 
    // draws if the tool.started state is set to true (when you are holding down 
    // the mouse button).
    this.mousemove = function (ev) {
      if (tool.started) {
        context.lineTo(ev._x, ev._y);
		context.setLineDash([0, 0]);
		context.strokeStyle = colorelegido;
        context.stroke();
      }
    };

    // This is called when you release the mouse button.
    this.mouseup = function (ev) {
      if (tool.started) {
        tool.mousemove(ev);
        tool.started = false;
        img_update();
      }
    };
  };
  
  // CIRCULO
  tools.circle = function () {
    var tool = this;
    this.started = false;

    this.mousedown = function (ev) {
      tool.started = true;
      tool.x0 = ev._x;
      tool.y0 = ev._y;
    };

    this.mousemove = function (ev) {
      if (!tool.started) {
        return;
      }

      var x = Math.min(ev._x,  tool.x0),
          y = Math.min(ev._y,  tool.y0),
          w = Math.abs(ev._x - tool.x0),
          h = Math.abs(ev._y - tool.y0);

      context.clearRect(0, 0, canvas.width, canvas.height);
	  
	  //var canvas = document.getElementById('myCanvas');
      //var context = canvas.getContext('2d');
      var centerX = x;
      var centerY = y;
      var radius = (w) / 2;

      context.beginPath();
	  context.setLineDash([0, 0]);
      context.arc(centerX, centerY, radius, 0, 2 * Math.PI, false);
	  context.closePath();
	  context.strokeStyle = colorelegido;
      context.lineWidth = 1;
	  
	  context.clearRect(0, 0, canvas.width, canvas.height);

      if (!w || !h) {
        return;
      }

      //context.strokeRect(x, y, w, h);
	  context.stroke();
	  //context.strokeRect(x, y, w, h);
    };

    this.mouseup = function (ev) {
      if (tool.started) {
        tool.mousemove(ev);
        tool.started = false;
        img_update();
      }
    };
  };

  // borrar
  tools.borrar = function () {
		//confirm("Estas seguro que queres borrar la evaluación?");
		var opcion = confirm("Estas seguro que queres borrar la evaluación?");
		if (opcion == true) {
			var canvas = document.getElementById('imageView');
			var context = canvas.getContext('2d');
			context.clearRect(0, 0, canvas.width, canvas.height);
		} else {
		}
		

  };
  
  // texto
  tools.texto = function () {
	  
		var mensaje;
		var opcion = prompt("Introduzca el texto y luego haga click en la zona donde quiere colocar el texto:", "");
 
		if (opcion == null || opcion == "") {
			
        } else {
            //mensaje = "Hola " + opcion;
			
			var tool = this;
			this.started = false;

			this.mousedown = function (ev) {
			  tool.started = true;
			  tool.x0 = ev._x;
			  tool.y0 = ev._y;
			};

			this.mousemove = function (ev) {
			  if (!tool.started) {
				return;
			  }

			  var x = Math.min(ev._x,  tool.x0),
				  y = Math.min(ev._y,  tool.y0),
				  w = Math.abs(ev._x - tool.x0),
				  h = Math.abs(ev._y - tool.y0);
				  
			  //console.log("X: "+x+" Y: "+y+" W: "+w+" H: "+h)

			  //context.clearRect(0, 0, canvas.width, canvas.height);

			  if (!w || !h) {
				return;
			  }
			  context.setLineDash([0, 0]);
			  context.fillStyle = colorelegido;
			  //context.strokeRect(x, y, w, h);
			  dibujartexto(x, y, opcion);
			  opcion="";
			  
			};

			this.mouseup = function (ev) {
			  if (tool.started) {
				tool.mousemove(ev);
				tool.started = false;
				img_update();
				console.log("listo");
			  }
			};
			
			
        }
	  
  };

  // The rectangle tool.
  tools.rect = function () {
    var tool = this;
    this.started = false;

    this.mousedown = function (ev) {
      tool.started = true;
      tool.x0 = ev._x;
      tool.y0 = ev._y;
    };

    this.mousemove = function (ev) {
      if (!tool.started) {
        return;
      }

      var x = Math.min(ev._x,  tool.x0),
          y = Math.min(ev._y,  tool.y0),
          w = Math.abs(ev._x - tool.x0),
          h = Math.abs(ev._y - tool.y0);
		  
	  //console.log("X: "+x+" Y: "+y+" W: "+w+" H: "+h)

      context.clearRect(0, 0, canvas.width, canvas.height);

      if (!w || !h) {
        return;
      }
	  context.setLineDash([0, 0]);
      context.strokeStyle = colorelegido;
      context.strokeRect(x, y, w, h);
	  console.log("mover");
    };

    this.mouseup = function (ev) {
      if (tool.started) {
        tool.mousemove(ev);
        tool.started = false;
        img_update();
		console.log("listo");
      }
    };
  };
  
  // ESTRELLA
  tools.estrella = function () {
    var tool = this;
    this.started = false;

    this.mousedown = function (ev) {
      tool.started = true;
      tool.x0 = ev._x;
      tool.y0 = ev._y;
    };

    this.mousemove = function (ev) {
      if (!tool.started) {
        return;
      }

      var x = Math.min(ev._x,  tool.x0),
          y = Math.min(ev._y,  tool.y0),
          w = Math.abs(ev._x - tool.x0),
          h = Math.abs(ev._y - tool.y0);

      context.clearRect(0, 0, canvas.width, canvas.height);

      if (!w || !h) {
        return;
      }
	  context.setLineDash([0, 0]);
      context.strokeStyle = colorelegido;
      //context.strokeRect(x, y, w, h);
	  drawStar(x, y, 5, 30, 7);
    };

    this.mouseup = function (ev) {
      if (tool.started) {
        tool.mousemove(ev);
        tool.started = false;
        img_update();
      }
    };
  };

  // The line tool.
  tools.line = function () {
    var tool = this;
    this.started = false;

    this.mousedown = function (ev) {
      tool.started = true;
      tool.x0 = ev._x;
      tool.y0 = ev._y;
    };

    this.mousemove = function (ev) {
      if (!tool.started) {
        return;
      }

      context.clearRect(0, 0, canvas.width, canvas.height);
      context.strokeStyle = colorelegido;
	  context.beginPath();
	  context.setLineDash([0, 0]);
      context.moveTo(tool.x0, tool.y0);
      context.lineTo(ev._x,   ev._y);
      context.stroke();
      context.closePath();
    };

    this.mouseup = function (ev) {
      if (tool.started) {
        tool.mousemove(ev);
        tool.started = false;
        img_update();
      }
    };
  };
  
  // LINEA PUNTEADA
  tools.punteada = function () {
    var tool = this;
    this.started = false;

    this.mousedown = function (ev) {
      tool.started = true;
      tool.x0 = ev._x;
      tool.y0 = ev._y;
    };

    this.mousemove = function (ev) {
      if (!tool.started) {
        return;
      }

      context.clearRect(0, 0, canvas.width, canvas.height);
      context.strokeStyle = colorelegido;

	  context.setLineDash([10, 10]);/*dashes are 5px and spaces are 3px*/
	  context.beginPath();
	  
      context.moveTo(tool.x0, tool.y0);
      context.lineTo(ev._x,   ev._y);
      context.stroke();
      context.closePath();
    };

    this.mouseup = function (ev) {
      if (tool.started) {
        tool.mousemove(ev);
        tool.started = false;
        img_update();
      }
    };
  };
  
  function dibujartexto(x, y, opcion) {

	    context.font = "20px Arial";
		context.fillText(opcion,x,y);
		opcion = "";
	  
  }
  
  function drawStar(cx, cy, spikes, outerRadius, innerRadius) {
		
		var rot = Math.PI / 2 * 3;
		var x = cx;
		var y = cy;
		var step = Math.PI / spikes;

		context.strokeSyle = "#000";
		context.beginPath();
		context.moveTo(cx, cy - outerRadius)
		for (i = 0; i < spikes; i++) {
			x = cx + Math.cos(rot) * outerRadius;
			y = cy + Math.sin(rot) * outerRadius;
			context.lineTo(x, y)
			rot += step

			x = cx + Math.cos(rot) * innerRadius;
			y = cy + Math.sin(rot) * innerRadius;
			context.lineTo(x, y)
			rot += step
		}
		context.lineTo(cx, cy - outerRadius)
		context.closePath();
		context.strokeStyle=colorelegido;
		context.stroke();
		context.fillStyle=colorelegido;
		context.fill();

	}

  init();

}, false); }

// vim:set spell spl=en fo=wan1croql tw=80 ts=2 sw=2 sts=2 sta et ai cin fenc=utf-8 ff=unix:
