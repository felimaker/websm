<?php
	$rdata = array_map('to_utf8', array_map('nl2br', array_map('html_attr_tags_ok', $rdata)));
	$jdata = array_map('to_utf8', array_map('nl2br', array_map('html_attr_tags_ok', $jdata)));
?>
<script>
	$j(function() {
		var tn = 'marca_presetacion';

		/* data for selected record, or defaults if none is selected */
		var data = {
			modelo: <?php echo json_encode(array('id' => $rdata['modelo'], 'value' => $rdata['modelo'], 'text' => $jdata['modelo'])); ?>,
			unidad_medida: <?php echo json_encode(array('id' => $rdata['unidad_medida'], 'value' => $rdata['unidad_medida'], 'text' => $jdata['unidad_medida'])); ?>
		};

		/* initialize or continue using AppGini.cache for the current table */
		AppGini.cache = AppGini.cache || {};
		AppGini.cache[tn] = AppGini.cache[tn] || AppGini.ajaxCache();
		var cache = AppGini.cache[tn];

		/* saved value for modelo */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'modelo' && d.id == data.modelo.id)
				return { results: [ data.modelo ], more: false, elapsed: 0.01 };
			return false;
		});

		/* saved value for unidad_medida */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'unidad_medida' && d.id == data.unidad_medida.id)
				return { results: [ data.unidad_medida ], more: false, elapsed: 0.01 };
			return false;
		});

		cache.start();
	});
</script>

