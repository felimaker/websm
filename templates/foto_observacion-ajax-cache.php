<?php
	$rdata = array_map('to_utf8', array_map('nl2br', array_map('html_attr_tags_ok', $rdata)));
	$jdata = array_map('to_utf8', array_map('nl2br', array_map('html_attr_tags_ok', $jdata)));
?>
<script>
	$j(function() {
		var tn = 'foto_observacion';

		/* data for selected record, or defaults if none is selected */
		var data = {
			id_observacion: <?php echo json_encode(array('id' => $rdata['id_observacion'], 'value' => $rdata['id_observacion'], 'text' => $jdata['id_observacion'])); ?>
		};

		/* initialize or continue using AppGini.cache for the current table */
		AppGini.cache = AppGini.cache || {};
		AppGini.cache[tn] = AppGini.cache[tn] || AppGini.ajaxCache();
		var cache = AppGini.cache[tn];

		/* saved value for id_observacion */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'id_observacion' && d.id == data.id_observacion.id)
				return { results: [ data.id_observacion ], more: false, elapsed: 0.01 };
			return false;
		});

		cache.start();
	});
</script>

