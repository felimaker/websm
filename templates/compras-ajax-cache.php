<?php
	$rdata = array_map('to_utf8', array_map('nl2br', array_map('html_attr_tags_ok', $rdata)));
	$jdata = array_map('to_utf8', array_map('nl2br', array_map('html_attr_tags_ok', $jdata)));
?>
<script>
	$j(function() {
		var tn = 'compras';

		/* data for selected record, or defaults if none is selected */
		var data = {
			tipo_compra: <?php echo json_encode(array('id' => $rdata['tipo_compra'], 'value' => $rdata['tipo_compra'], 'text' => $jdata['tipo_compra'])); ?>,
			estado: <?php echo json_encode(array('id' => $rdata['estado'], 'value' => $rdata['estado'], 'text' => $jdata['estado'])); ?>
		};

		/* initialize or continue using AppGini.cache for the current table */
		AppGini.cache = AppGini.cache || {};
		AppGini.cache[tn] = AppGini.cache[tn] || AppGini.ajaxCache();
		var cache = AppGini.cache[tn];

		/* saved value for tipo_compra */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'tipo_compra' && d.id == data.tipo_compra.id)
				return { results: [ data.tipo_compra ], more: false, elapsed: 0.01 };
			return false;
		});

		/* saved value for estado */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'estado' && d.id == data.estado.id)
				return { results: [ data.estado ], more: false, elapsed: 0.01 };
			return false;
		});

		cache.start();
	});
</script>

