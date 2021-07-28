<?php
	$rdata = array_map('to_utf8', array_map('nl2br', array_map('html_attr_tags_ok', $rdata)));
	$jdata = array_map('to_utf8', array_map('nl2br', array_map('html_attr_tags_ok', $jdata)));
?>
<script>
	$j(function() {
		var tn = 'ubicacion_mobiliario';

		/* data for selected record, or defaults if none is selected */
		var data = {
			id_mobiliario: <?php echo json_encode(array('id' => $rdata['id_mobiliario'], 'value' => $rdata['id_mobiliario'], 'text' => $jdata['id_mobiliario'])); ?>,
			ubicacion: <?php echo json_encode(array('id' => $rdata['ubicacion'], 'value' => $rdata['ubicacion'], 'text' => $jdata['ubicacion'])); ?>
		};

		/* initialize or continue using AppGini.cache for the current table */
		AppGini.cache = AppGini.cache || {};
		AppGini.cache[tn] = AppGini.cache[tn] || AppGini.ajaxCache();
		var cache = AppGini.cache[tn];

		/* saved value for id_mobiliario */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'id_mobiliario' && d.id == data.id_mobiliario.id)
				return { results: [ data.id_mobiliario ], more: false, elapsed: 0.01 };
			return false;
		});

		/* saved value for ubicacion */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'ubicacion' && d.id == data.ubicacion.id)
				return { results: [ data.ubicacion ], more: false, elapsed: 0.01 };
			return false;
		});

		cache.start();
	});
</script>

