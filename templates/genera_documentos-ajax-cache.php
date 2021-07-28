<?php
	$rdata = array_map('to_utf8', array_map('nl2br', array_map('html_attr_tags_ok', $rdata)));
	$jdata = array_map('to_utf8', array_map('nl2br', array_map('html_attr_tags_ok', $jdata)));
?>
<script>
	$j(function() {
		var tn = 'genera_documentos';

		/* data for selected record, or defaults if none is selected */
		var data = {
			ciudad: <?php echo json_encode(array('id' => $rdata['ciudad'], 'value' => $rdata['ciudad'], 'text' => $jdata['ciudad'])); ?>,
			entidad: <?php echo json_encode(array('id' => $rdata['entidad'], 'value' => $rdata['entidad'], 'text' => $jdata['entidad'])); ?>
		};

		/* initialize or continue using AppGini.cache for the current table */
		AppGini.cache = AppGini.cache || {};
		AppGini.cache[tn] = AppGini.cache[tn] || AppGini.ajaxCache();
		var cache = AppGini.cache[tn];

		/* saved value for ciudad */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'ciudad' && d.id == data.ciudad.id)
				return { results: [ data.ciudad ], more: false, elapsed: 0.01 };
			return false;
		});

		/* saved value for entidad */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'entidad' && d.id == data.entidad.id)
				return { results: [ data.entidad ], more: false, elapsed: 0.01 };
			return false;
		});

		cache.start();
	});
</script>

