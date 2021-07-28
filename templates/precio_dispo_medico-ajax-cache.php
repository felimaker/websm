<?php
	$rdata = array_map('to_utf8', array_map('nl2br', array_map('html_attr_tags_ok', $rdata)));
	$jdata = array_map('to_utf8', array_map('nl2br', array_map('html_attr_tags_ok', $jdata)));
?>
<script>
	$j(function() {
		var tn = 'precio_dispo_medico';

		/* data for selected record, or defaults if none is selected */
		var data = {
			dispo_medico: <?php echo json_encode(array('id' => $rdata['dispo_medico'], 'value' => $rdata['dispo_medico'], 'text' => $jdata['dispo_medico'])); ?>
		};

		/* initialize or continue using AppGini.cache for the current table */
		AppGini.cache = AppGini.cache || {};
		AppGini.cache[tn] = AppGini.cache[tn] || AppGini.ajaxCache();
		var cache = AppGini.cache[tn];

		/* saved value for dispo_medico */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'dispo_medico' && d.id == data.dispo_medico.id)
				return { results: [ data.dispo_medico ], more: false, elapsed: 0.01 };
			return false;
		});

		cache.start();
	});
</script>

