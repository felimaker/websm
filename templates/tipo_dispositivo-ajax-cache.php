<?php
	$rdata = array_map('to_utf8', array_map('nl2br', array_map('html_attr_tags_ok', $rdata)));
	$jdata = array_map('to_utf8', array_map('nl2br', array_map('html_attr_tags_ok', $jdata)));
?>
<script>
	$j(function() {
		var tn = 'tipo_dispositivo';

		/* data for selected record, or defaults if none is selected */
		var data = {
			grupo_dispo: <?php echo json_encode(array('id' => $rdata['grupo_dispo'], 'value' => $rdata['grupo_dispo'], 'text' => $jdata['grupo_dispo'])); ?>
		};

		/* initialize or continue using AppGini.cache for the current table */
		AppGini.cache = AppGini.cache || {};
		AppGini.cache[tn] = AppGini.cache[tn] || AppGini.ajaxCache();
		var cache = AppGini.cache[tn];

		cache.start();
	});
</script>

