<?php
	$rdata = array_map('to_utf8', array_map('nl2br', array_map('html_attr_tags_ok', $rdata)));
	$jdata = array_map('to_utf8', array_map('nl2br', array_map('html_attr_tags_ok', $jdata)));
?>
<script>
	$j(function() {
		var tn = 'accesorio_dispo_relacion';

		/* data for selected record, or defaults if none is selected */
		var data = {
			id_dispo: <?php echo json_encode(array('id' => $rdata['id_dispo'], 'value' => $rdata['id_dispo'], 'text' => $jdata['id_dispo'])); ?>,
			id_accesorio: <?php echo json_encode(array('id' => $rdata['id_accesorio'], 'value' => $rdata['id_accesorio'], 'text' => $jdata['id_accesorio'])); ?>,
			tipo_dispo: <?php echo json_encode($jdata['tipo_dispo']); ?>,
			serial: <?php echo json_encode($jdata['serial']); ?>,
			marca_modelo: <?php echo json_encode($jdata['marca_modelo']); ?>
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

		/* saved value for id_dispo autofills */
		cache.addCheck(function(u, d) {
			if(u != tn + '_autofill.php') return false;

			for(var rnd in d) if(rnd.match(/^rnd/)) break;

			if(d.mfk == 'id_dispo' && d.id == data.id_dispo.id) {
				$j('#tipo_dispo' + d[rnd]).html(data.tipo_dispo);
				$j('#serial' + d[rnd]).html(data.serial);
				$j('#marca_modelo' + d[rnd]).html(data.marca_modelo);
				return true;
			}

			return false;
		});

		/* saved value for id_accesorio */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'id_accesorio' && d.id == data.id_accesorio.id)
				return { results: [ data.id_accesorio ], more: false, elapsed: 0.01 };
			return false;
		});

		cache.start();
	});
</script>

