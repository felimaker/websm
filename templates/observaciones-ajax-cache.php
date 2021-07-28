<?php
	$rdata = array_map('to_utf8', array_map('nl2br', array_map('html_attr_tags_ok', $rdata)));
	$jdata = array_map('to_utf8', array_map('nl2br', array_map('html_attr_tags_ok', $jdata)));
?>
<script>
	$j(function() {
		var tn = 'observaciones';

		/* data for selected record, or defaults if none is selected */
		var data = {
			estado_observacion: <?php echo json_encode(array('id' => $rdata['estado_observacion'], 'value' => $rdata['estado_observacion'], 'text' => $jdata['estado_observacion'])); ?>,
			estado: <?php echo json_encode(array('id' => $rdata['estado'], 'value' => $rdata['estado'], 'text' => $jdata['estado'])); ?>,
			codigo: <?php echo json_encode(array('id' => $rdata['codigo'], 'value' => $rdata['codigo'], 'text' => $jdata['codigo'])); ?>,
			tipo_dispo: <?php echo json_encode($jdata['tipo_dispo']); ?>,
			serial: <?php echo json_encode($jdata['serial']); ?>,
			unidad: <?php echo json_encode(array('id' => $rdata['unidad'], 'value' => $rdata['unidad'], 'text' => $jdata['unidad'])); ?>
		};

		/* initialize or continue using AppGini.cache for the current table */
		AppGini.cache = AppGini.cache || {};
		AppGini.cache[tn] = AppGini.cache[tn] || AppGini.ajaxCache();
		var cache = AppGini.cache[tn];

		/* saved value for estado_observacion */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'estado_observacion' && d.id == data.estado_observacion.id)
				return { results: [ data.estado_observacion ], more: false, elapsed: 0.01 };
			return false;
		});

		/* saved value for estado */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'estado' && d.id == data.estado.id)
				return { results: [ data.estado ], more: false, elapsed: 0.01 };
			return false;
		});

		/* saved value for codigo */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'codigo' && d.id == data.codigo.id)
				return { results: [ data.codigo ], more: false, elapsed: 0.01 };
			return false;
		});

		/* saved value for codigo autofills */
		cache.addCheck(function(u, d) {
			if(u != tn + '_autofill.php') return false;

			for(var rnd in d) if(rnd.match(/^rnd/)) break;

			if(d.mfk == 'codigo' && d.id == data.codigo.id) {
				$j('#tipo_dispo' + d[rnd]).html(data.tipo_dispo);
				$j('#serial' + d[rnd]).html(data.serial);
				return true;
			}

			return false;
		});

		/* saved value for unidad */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'unidad' && d.id == data.unidad.id)
				return { results: [ data.unidad ], more: false, elapsed: 0.01 };
			return false;
		});

		cache.start();
	});
</script>

