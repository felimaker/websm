<?php
	$rdata = array_map('to_utf8', array_map('nl2br', array_map('html_attr_tags_ok', $rdata)));
	$jdata = array_map('to_utf8', array_map('nl2br', array_map('html_attr_tags_ok', $jdata)));
?>
<script>
	$j(function() {
		var tn = 'mobiliario';

		/* data for selected record, or defaults if none is selected */
		var data = {
			grupo: <?php echo json_encode(array('id' => $rdata['grupo'], 'value' => $rdata['grupo'], 'text' => $jdata['grupo'])); ?>,
			tipo_mobiliario: <?php echo json_encode(array('id' => $rdata['tipo_mobiliario'], 'value' => $rdata['tipo_mobiliario'], 'text' => $jdata['tipo_mobiliario'])); ?>,
			ubicacion: <?php echo json_encode(array('id' => $rdata['ubicacion'], 'value' => $rdata['ubicacion'], 'text' => $jdata['ubicacion'])); ?>,
			ubicacion_abreviado: <?php echo json_encode($jdata['ubicacion_abreviado']); ?>,
			unidad: <?php echo json_encode(array('id' => $rdata['unidad'], 'value' => $rdata['unidad'], 'text' => $jdata['unidad'])); ?>,
			uni_abreviado: <?php echo json_encode($jdata['uni_abreviado']); ?>
		};

		/* initialize or continue using AppGini.cache for the current table */
		AppGini.cache = AppGini.cache || {};
		AppGini.cache[tn] = AppGini.cache[tn] || AppGini.ajaxCache();
		var cache = AppGini.cache[tn];

		/* saved value for grupo */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'grupo' && d.id == data.grupo.id)
				return { results: [ data.grupo ], more: false, elapsed: 0.01 };
			return false;
		});

		/* saved value for tipo_mobiliario */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'tipo_mobiliario' && d.id == data.tipo_mobiliario.id)
				return { results: [ data.tipo_mobiliario ], more: false, elapsed: 0.01 };
			return false;
		});

		/* saved value for ubicacion */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'ubicacion' && d.id == data.ubicacion.id)
				return { results: [ data.ubicacion ], more: false, elapsed: 0.01 };
			return false;
		});

		/* saved value for ubicacion autofills */
		cache.addCheck(function(u, d) {
			if(u != tn + '_autofill.php') return false;

			for(var rnd in d) if(rnd.match(/^rnd/)) break;

			if(d.mfk == 'ubicacion' && d.id == data.ubicacion.id) {
				$j('#ubicacion_abreviado' + d[rnd]).html(data.ubicacion_abreviado);
				$j('#uni_abreviado' + d[rnd]).html(data.uni_abreviado);
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

