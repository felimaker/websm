<?php
	$rdata = array_map('to_utf8', array_map('nl2br', array_map('html_attr_tags_ok', $rdata)));
	$jdata = array_map('to_utf8', array_map('nl2br', array_map('html_attr_tags_ok', $jdata)));
?>
<script>
	$j(function() {
		var tn = 'ubicacion_articulo';

		/* data for selected record, or defaults if none is selected */
		var data = {
			id_articulo: <?php echo json_encode(array('id' => $rdata['id_articulo'], 'value' => $rdata['id_articulo'], 'text' => $jdata['id_articulo'])); ?>,
			ubicacion: <?php echo json_encode(array('id' => $rdata['ubicacion'], 'value' => $rdata['ubicacion'], 'text' => $jdata['ubicacion'])); ?>
		};

		/* initialize or continue using AppGini.cache for the current table */
		AppGini.cache = AppGini.cache || {};
		AppGini.cache[tn] = AppGini.cache[tn] || AppGini.ajaxCache();
		var cache = AppGini.cache[tn];

		/* saved value for id_articulo */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'id_articulo' && d.id == data.id_articulo.id)
				return { results: [ data.id_articulo ], more: false, elapsed: 0.01 };
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

