<?php
	$rdata = array_map('to_utf8', array_map('nl2br', array_map('html_attr_tags_ok', $rdata)));
	$jdata = array_map('to_utf8', array_map('nl2br', array_map('html_attr_tags_ok', $jdata)));
?>
<script>
	$j(function() {
		var tn = 'movi_recepcion_articulos';

		/* data for selected record, or defaults if none is selected */
		var data = {
			id_movi: <?php echo json_encode(array('id' => $rdata['id_movi'], 'value' => $rdata['id_movi'], 'text' => $jdata['id_movi'])); ?>,
			destino: <?php echo json_encode(array('id' => $rdata['destino'], 'value' => $rdata['destino'], 'text' => $jdata['destino'])); ?>,
			o_direccion: <?php echo json_encode($jdata['o_direccion']); ?>,
			ciudad: <?php echo json_encode($jdata['ciudad']); ?>,
			nombre: <?php echo json_encode(array('id' => $rdata['nombre'], 'value' => $rdata['nombre'], 'text' => $jdata['nombre'])); ?>,
			telefono: <?php echo json_encode($jdata['telefono']); ?>
		};

		/* initialize or continue using AppGini.cache for the current table */
		AppGini.cache = AppGini.cache || {};
		AppGini.cache[tn] = AppGini.cache[tn] || AppGini.ajaxCache();
		var cache = AppGini.cache[tn];

		/* saved value for id_movi */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'id_movi' && d.id == data.id_movi.id)
				return { results: [ data.id_movi ], more: false, elapsed: 0.01 };
			return false;
		});

		/* saved value for destino */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'destino' && d.id == data.destino.id)
				return { results: [ data.destino ], more: false, elapsed: 0.01 };
			return false;
		});

		/* saved value for destino autofills */
		cache.addCheck(function(u, d) {
			if(u != tn + '_autofill.php') return false;

			for(var rnd in d) if(rnd.match(/^rnd/)) break;

			if(d.mfk == 'destino' && d.id == data.destino.id) {
				$j('#o_direccion' + d[rnd]).html(data.o_direccion);
				$j('#ciudad' + d[rnd]).html(data.ciudad);
				return true;
			}

			return false;
		});

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
				$j('#telefono' + d[rnd]).html(data.telefono);
				return true;
			}

			return false;
		});

		cache.start();
	});
</script>

