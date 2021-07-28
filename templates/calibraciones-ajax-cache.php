<?php
	$rdata = array_map('to_utf8', array_map('nl2br', array_map('html_attr_tags_ok', $rdata)));
	$jdata = array_map('to_utf8', array_map('nl2br', array_map('html_attr_tags_ok', $jdata)));
?>
<script>
	$j(function() {
		var tn = 'calibraciones';

		/* data for selected record, or defaults if none is selected */
		var data = {
			codigo: <?php echo json_encode(array('id' => $rdata['codigo'], 'value' => $rdata['codigo'], 'text' => $jdata['codigo'])); ?>,
			serial: <?php echo json_encode($jdata['serial']); ?>,
			tipo_calibracion: <?php echo json_encode(array('id' => $rdata['tipo_calibracion'], 'value' => $rdata['tipo_calibracion'], 'text' => $jdata['tipo_calibracion'])); ?>,
			empresa: <?php echo json_encode(array('id' => $rdata['empresa'], 'value' => $rdata['empresa'], 'text' => $jdata['empresa'])); ?>,
			telefono: <?php echo json_encode($jdata['telefono']); ?>
		};

		/* initialize or continue using AppGini.cache for the current table */
		AppGini.cache = AppGini.cache || {};
		AppGini.cache[tn] = AppGini.cache[tn] || AppGini.ajaxCache();
		var cache = AppGini.cache[tn];

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
				$j('#serial' + d[rnd]).html(data.serial);
				return true;
			}

			return false;
		});

		/* saved value for tipo_calibracion */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'tipo_calibracion' && d.id == data.tipo_calibracion.id)
				return { results: [ data.tipo_calibracion ], more: false, elapsed: 0.01 };
			return false;
		});

		/* saved value for empresa */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'empresa' && d.id == data.empresa.id)
				return { results: [ data.empresa ], more: false, elapsed: 0.01 };
			return false;
		});

		/* saved value for empresa autofills */
		cache.addCheck(function(u, d) {
			if(u != tn + '_autofill.php') return false;

			for(var rnd in d) if(rnd.match(/^rnd/)) break;

			if(d.mfk == 'empresa' && d.id == data.empresa.id) {
				$j('#telefono' + d[rnd]).html(data.telefono);
				return true;
			}

			return false;
		});

		cache.start();
	});
</script>

