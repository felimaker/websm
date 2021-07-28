<?php
	$rdata = array_map('to_utf8', array_map('nl2br', array_map('html_attr_tags_ok', $rdata)));
	$jdata = array_map('to_utf8', array_map('nl2br', array_map('html_attr_tags_ok', $jdata)));
?>
<script>
	$j(function() {
		var tn = 'acceso_remoto';

		/* data for selected record, or defaults if none is selected */
		var data = {
			unidad: <?php echo json_encode(array('id' => $rdata['unidad'], 'value' => $rdata['unidad'], 'text' => $jdata['unidad'])); ?>,
			ciudad: <?php echo json_encode($jdata['ciudad']); ?>,
			codigo_equipo: <?php echo json_encode(array('id' => $rdata['codigo_equipo'], 'value' => $rdata['codigo_equipo'], 'text' => $jdata['codigo_equipo'])); ?>,
			equipo: <?php echo json_encode($jdata['equipo']); ?>
		};

		/* initialize or continue using AppGini.cache for the current table */
		AppGini.cache = AppGini.cache || {};
		AppGini.cache[tn] = AppGini.cache[tn] || AppGini.ajaxCache();
		var cache = AppGini.cache[tn];

		/* saved value for unidad */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'unidad' && d.id == data.unidad.id)
				return { results: [ data.unidad ], more: false, elapsed: 0.01 };
			return false;
		});

		/* saved value for unidad autofills */
		cache.addCheck(function(u, d) {
			if(u != tn + '_autofill.php') return false;

			for(var rnd in d) if(rnd.match(/^rnd/)) break;

			if(d.mfk == 'unidad' && d.id == data.unidad.id) {
				$j('#ciudad' + d[rnd]).html(data.ciudad);
				return true;
			}

			return false;
		});

		/* saved value for codigo_equipo */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'codigo_equipo' && d.id == data.codigo_equipo.id)
				return { results: [ data.codigo_equipo ], more: false, elapsed: 0.01 };
			return false;
		});

		/* saved value for codigo_equipo autofills */
		cache.addCheck(function(u, d) {
			if(u != tn + '_autofill.php') return false;

			for(var rnd in d) if(rnd.match(/^rnd/)) break;

			if(d.mfk == 'codigo_equipo' && d.id == data.codigo_equipo.id) {
				$j('#equipo' + d[rnd]).html(data.equipo);
				return true;
			}

			return false;
		});

		cache.start();
	});
</script>

