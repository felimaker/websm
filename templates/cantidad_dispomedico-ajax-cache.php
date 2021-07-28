<?php
	$rdata = array_map('to_utf8', array_map('nl2br', array_map('html_attr_tags_ok', $rdata)));
	$jdata = array_map('to_utf8', array_map('nl2br', array_map('html_attr_tags_ok', $jdata)));
?>
<script>
	$j(function() {
		var tn = 'cantidad_dispomedico';

		/* data for selected record, or defaults if none is selected */
		var data = {
			nombre_dispo: <?php echo json_encode(array('id' => $rdata['nombre_dispo'], 'value' => $rdata['nombre_dispo'], 'text' => $jdata['nombre_dispo'])); ?>,
			serial: <?php echo json_encode($jdata['serial']); ?>,
			marca_modelo: <?php echo json_encode($jdata['marca_modelo']); ?>,
			descripcion: <?php echo json_encode($jdata['descripcion']); ?>,
			estado: <?php echo json_encode(array('id' => $rdata['estado'], 'value' => $rdata['estado'], 'text' => $jdata['estado'])); ?>,
			id_compra: <?php echo json_encode(array('id' => $rdata['id_compra'], 'value' => $rdata['id_compra'], 'text' => $jdata['id_compra'])); ?>
		};

		/* initialize or continue using AppGini.cache for the current table */
		AppGini.cache = AppGini.cache || {};
		AppGini.cache[tn] = AppGini.cache[tn] || AppGini.ajaxCache();
		var cache = AppGini.cache[tn];

		/* saved value for nombre_dispo */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'nombre_dispo' && d.id == data.nombre_dispo.id)
				return { results: [ data.nombre_dispo ], more: false, elapsed: 0.01 };
			return false;
		});

		/* saved value for nombre_dispo autofills */
		cache.addCheck(function(u, d) {
			if(u != tn + '_autofill.php') return false;

			for(var rnd in d) if(rnd.match(/^rnd/)) break;

			if(d.mfk == 'nombre_dispo' && d.id == data.nombre_dispo.id) {
				$j('#serial' + d[rnd]).html(data.serial);
				$j('#marca_modelo' + d[rnd]).html(data.marca_modelo);
				$j('#descripcion' + d[rnd]).html(data.descripcion);
				return true;
			}

			return false;
		});

		/* saved value for estado */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'estado' && d.id == data.estado.id)
				return { results: [ data.estado ], more: false, elapsed: 0.01 };
			return false;
		});

		/* saved value for id_compra */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'id_compra' && d.id == data.id_compra.id)
				return { results: [ data.id_compra ], more: false, elapsed: 0.01 };
			return false;
		});

		cache.start();
	});
</script>

