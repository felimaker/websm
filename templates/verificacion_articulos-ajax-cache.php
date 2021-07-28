<?php
	$rdata = array_map('to_utf8', array_map('nl2br', array_map('html_attr_tags_ok', $rdata)));
	$jdata = array_map('to_utf8', array_map('nl2br', array_map('html_attr_tags_ok', $jdata)));
?>
<script>
	$j(function() {
		var tn = 'verificacion_articulos';

		/* data for selected record, or defaults if none is selected */
		var data = {
			codigo: <?php echo json_encode(array('id' => $rdata['codigo'], 'value' => $rdata['codigo'], 'text' => $jdata['codigo'])); ?>,
			tipo_dispo: <?php echo json_encode($jdata['tipo_dispo']); ?>,
			nombre: <?php echo json_encode($jdata['nombre']); ?>,
			serial: <?php echo json_encode($jdata['serial']); ?>,
			ubicacion: <?php echo json_encode(array('id' => $rdata['ubicacion'], 'value' => $rdata['ubicacion'], 'text' => $jdata['ubicacion'])); ?>,
			abreviado: <?php echo json_encode($jdata['abreviado']); ?>
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
				$j('#tipo_dispo' + d[rnd]).html(data.tipo_dispo);
				$j('#nombre' + d[rnd]).html(data.nombre);
				$j('#serial' + d[rnd]).html(data.serial);
				return true;
			}

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
				$j('#abreviado' + d[rnd]).html(data.abreviado);
				return true;
			}

			return false;
		});

		cache.start();
	});
</script>

