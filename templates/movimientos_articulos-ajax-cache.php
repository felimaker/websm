<?php
	$rdata = array_map('to_utf8', array_map('nl2br', array_map('html_attr_tags_ok', $rdata)));
	$jdata = array_map('to_utf8', array_map('nl2br', array_map('html_attr_tags_ok', $jdata)));
?>
<script>
	$j(function() {
		var tn = 'movimientos_articulos';

		/* data for selected record, or defaults if none is selected */
		var data = {
			tipo_dispo: <?php echo json_encode($jdata['tipo_dispo']); ?>,
			nombre: <?php echo json_encode(array('id' => $rdata['nombre'], 'value' => $rdata['nombre'], 'text' => $jdata['nombre'])); ?>,
			serial_dispo: <?php echo json_encode($jdata['serial_dispo']); ?>,
			estado_movi: <?php echo json_encode(array('id' => $rdata['estado_movi'], 'value' => $rdata['estado_movi'], 'text' => $jdata['estado_movi'])); ?>
		};

		/* initialize or continue using AppGini.cache for the current table */
		AppGini.cache = AppGini.cache || {};
		AppGini.cache[tn] = AppGini.cache[tn] || AppGini.ajaxCache();
		var cache = AppGini.cache[tn];

		/* saved value for nombre */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'nombre' && d.id == data.nombre.id)
				return { results: [ data.nombre ], more: false, elapsed: 0.01 };
			return false;
		});

		/* saved value for nombre autofills */
		cache.addCheck(function(u, d) {
			if(u != tn + '_autofill.php') return false;

			for(var rnd in d) if(rnd.match(/^rnd/)) break;

			if(d.mfk == 'nombre' && d.id == data.nombre.id) {
				$j('#tipo_dispo' + d[rnd]).html(data.tipo_dispo);
				$j('#serial_dispo' + d[rnd]).html(data.serial_dispo);
				return true;
			}

			return false;
		});

		/* saved value for estado_movi */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'estado_movi' && d.id == data.estado_movi.id)
				return { results: [ data.estado_movi ], more: false, elapsed: 0.01 };
			return false;
		});

		cache.start();
	});
</script>

