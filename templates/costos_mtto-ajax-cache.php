<?php
	$rdata = array_map('to_utf8', array_map('nl2br', array_map('html_attr_tags_ok', $rdata)));
	$jdata = array_map('to_utf8', array_map('nl2br', array_map('html_attr_tags_ok', $jdata)));
?>
<script>
	$j(function() {
		var tn = 'costos_mtto';

		/* data for selected record, or defaults if none is selected */
		var data = {
			id_mtto: <?php echo json_encode(array('id' => $rdata['id_mtto'], 'value' => $rdata['id_mtto'], 'text' => $jdata['id_mtto'])); ?>,
			tipo_costo: <?php echo json_encode(array('id' => $rdata['tipo_costo'], 'value' => $rdata['tipo_costo'], 'text' => $jdata['tipo_costo'])); ?>
		};

		/* initialize or continue using AppGini.cache for the current table */
		AppGini.cache = AppGini.cache || {};
		AppGini.cache[tn] = AppGini.cache[tn] || AppGini.ajaxCache();
		var cache = AppGini.cache[tn];

		/* saved value for id_mtto */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'id_mtto' && d.id == data.id_mtto.id)
				return { results: [ data.id_mtto ], more: false, elapsed: 0.01 };
			return false;
		});

		/* saved value for tipo_costo */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'tipo_costo' && d.id == data.tipo_costo.id)
				return { results: [ data.tipo_costo ], more: false, elapsed: 0.01 };
			return false;
		});

		cache.start();
	});
</script>

