<?php
	$rdata = array_map('to_utf8', array_map('nl2br', array_map('html_attr_tags_ok', $rdata)));
	$jdata = array_map('to_utf8', array_map('nl2br', array_map('html_attr_tags_ok', $jdata)));
?>
<script>
	$j(function() {
		var tn = 'tipo_mobiliario';

		/* data for selected record, or defaults if none is selected */
		var data = {
			grupo_mobi: <?php echo json_encode(array('id' => $rdata['grupo_mobi'], 'value' => $rdata['grupo_mobi'], 'text' => $jdata['grupo_mobi'])); ?>
		};

		/* initialize or continue using AppGini.cache for the current table */
		AppGini.cache = AppGini.cache || {};
		AppGini.cache[tn] = AppGini.cache[tn] || AppGini.ajaxCache();
		var cache = AppGini.cache[tn];

		/* saved value for grupo_mobi */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'grupo_mobi' && d.id == data.grupo_mobi.id)
				return { results: [ data.grupo_mobi ], more: false, elapsed: 0.01 };
			return false;
		});

		cache.start();
	});
</script>

