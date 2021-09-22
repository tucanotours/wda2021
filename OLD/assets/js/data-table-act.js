(function ($) {
 "use strict";
	
	$(document).ready(function() {
		 $('#data-table-basic, #data-table-basic2').DataTable({
        "order": [[ 0, "desc" ]]
		} );
		$('.polizas-vencimiento').DataTable({
        "order": [[ 0, "asc" ]]
		} );
	});
 
})(jQuery); 