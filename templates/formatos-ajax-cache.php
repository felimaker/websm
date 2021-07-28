<?php
	$rdata = array_map('to_utf8', array_map('nl2br', array_map('html_attr_tags_ok', $rdata)));
	$jdata = array_map('to_utf8', array_map('nl2br', array_map('html_attr_tags_ok', $jdata)));
?>
<script>
	$j(function() {
		var tn = 'formatos';

		/* data for selected record, or defaults if none is selected */
		var data = {
			tipo_formato: <?php echo json_encode(array('id' => $rdata['tipo_formato'], 'value' => $rdata['tipo_formato'], 'text' => $jdata['tipo_formato'])); ?>,
			tipo_dispositivo: <?php echo json_encode(array('id' => $rdata['tipo_dispositivo'], 'value' => $rdata['tipo_dispositivo'], 'text' => $jdata['tipo_dispositivo'])); ?>
		};

		/* initialize or continue using AppGini.cache for the current table */
		AppGini.cache = AppGini.cache || {};
		AppGini.cache[tn] = AppGini.cache[tn] || AppGini.ajaxCache();
		var cache = AppGini.cache[tn];

		/* saved value for tipo_formato */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'tipo_formato' && d.id == data.tipo_formato.id)
				return { results: [ data.tipo_formato ], more: false, elapsed: 0.01 };
			return false;
		});

		/* saved value for tipo_dispositivo */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'tipo_dispositivo' && d.id == data.tipo_dispositivo.id)
				return { results: [ data.tipo_dispositivo ], more: false, elapsed: 0.01 };
			return false;
		});

		cache.start();
	});
</script>

