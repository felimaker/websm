<?php
	$rdata = array_map('to_utf8', array_map('nl2br', array_map('html_attr_tags_ok', $rdata)));
	$jdata = array_map('to_utf8', array_map('nl2br', array_map('html_attr_tags_ok', $jdata)));
?>
<script>
	$j(function() {
		var tn = 'facturas';

		/* data for selected record, or defaults if none is selected */
		var data = {
			id_dispo: <?php echo json_encode(array('id' => $rdata['id_dispo'], 'value' => $rdata['id_dispo'], 'text' => $jdata['id_dispo'])); ?>,
			proveedor: <?php echo json_encode(array('id' => $rdata['proveedor'], 'value' => $rdata['proveedor'], 'text' => $jdata['proveedor'])); ?>,
			identificacion: <?php echo json_encode($jdata['identificacion']); ?>,
			id_compras: <?php echo json_encode(array('id' => $rdata['id_compras'], 'value' => $rdata['id_compras'], 'text' => $jdata['id_compras'])); ?>
		};

		/* initialize or continue using AppGini.cache for the current table */
		AppGini.cache = AppGini.cache || {};
		AppGini.cache[tn] = AppGini.cache[tn] || AppGini.ajaxCache();
		var cache = AppGini.cache[tn];

		/* saved value for id_dispo */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'id_dispo' && d.id == data.id_dispo.id)
				return { results: [ data.id_dispo ], more: false, elapsed: 0.01 };
			return false;
		});

		/* saved value for proveedor */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'proveedor' && d.id == data.proveedor.id)
				return { results: [ data.proveedor ], more: false, elapsed: 0.01 };
			return false;
		});

		/* saved value for proveedor autofills */
		cache.addCheck(function(u, d) {
			if(u != tn + '_autofill.php') return false;

			for(var rnd in d) if(rnd.match(/^rnd/)) break;

			if(d.mfk == 'proveedor' && d.id == data.proveedor.id) {
				$j('#identificacion' + d[rnd]).html(data.identificacion);
				return true;
			}

			return false;
		});

		/* saved value for id_compras */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'id_compras' && d.id == data.id_compras.id)
				return { results: [ data.id_compras ], more: false, elapsed: 0.01 };
			return false;
		});

		cache.start();
	});
</script>

