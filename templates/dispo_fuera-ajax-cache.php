<?php
	$rdata = array_map('to_utf8', array_map('nl2br', array_map('html_attr_tags_ok', $rdata)));
	$jdata = array_map('to_utf8', array_map('nl2br', array_map('html_attr_tags_ok', $jdata)));
?>
<script>
	$j(function() {
		var tn = 'dispo_fuera';

		/* data for selected record, or defaults if none is selected */
		var data = {
			img: <?php echo json_encode($jdata['img']); ?>,
			codigo: <?php echo json_encode(array('id' => $rdata['codigo'], 'value' => $rdata['codigo'], 'text' => $jdata['codigo'])); ?>,
			serial: <?php echo json_encode($jdata['serial']); ?>,
			ubicacion_final: <?php echo json_encode($jdata['ubicacion_final']); ?>,
			tipo_fuera_servicio: <?php echo json_encode(array('id' => $rdata['tipo_fuera_servicio'], 'value' => $rdata['tipo_fuera_servicio'], 'text' => $jdata['tipo_fuera_servicio'])); ?>
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
				$j('#img' + d[rnd]).html(data.img);
				$j('#serial' + d[rnd]).html(data.serial);
				$j('#ubicacion_final' + d[rnd]).html(data.ubicacion_final);
				return true;
			}

			return false;
		});

		/* saved value for tipo_fuera_servicio */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'tipo_fuera_servicio' && d.id == data.tipo_fuera_servicio.id)
				return { results: [ data.tipo_fuera_servicio ], more: false, elapsed: 0.01 };
			return false;
		});

		cache.start();
	});
</script>

