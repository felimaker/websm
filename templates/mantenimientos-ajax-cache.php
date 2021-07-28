<?php
	$rdata = array_map('to_utf8', array_map('nl2br', array_map('html_attr_tags_ok', $rdata)));
	$jdata = array_map('to_utf8', array_map('nl2br', array_map('html_attr_tags_ok', $jdata)));
?>
<script>
	$j(function() {
		var tn = 'mantenimientos';

		/* data for selected record, or defaults if none is selected */
		var data = {
			codigo: <?php echo json_encode(array('id' => $rdata['codigo'], 'value' => $rdata['codigo'], 'text' => $jdata['codigo'])); ?>,
			serial: <?php echo json_encode($jdata['serial']); ?>,
			tipo_dispo: <?php echo json_encode($jdata['tipo_dispo']); ?>,
			tipo_mtto: <?php echo json_encode(array('id' => $rdata['tipo_mtto'], 'value' => $rdata['tipo_mtto'], 'text' => $jdata['tipo_mtto'])); ?>,
			responsable: <?php echo json_encode(array('id' => $rdata['responsable'], 'value' => $rdata['responsable'], 'text' => $jdata['responsable'])); ?>,
			id_responsable: <?php echo json_encode($jdata['id_responsable']); ?>,
			unidad: <?php echo json_encode(array('id' => $rdata['unidad'], 'value' => $rdata['unidad'], 'text' => $jdata['unidad'])); ?>,
			unidad_abreviado: <?php echo json_encode($jdata['unidad_abreviado']); ?>,
			estado_final: <?php echo json_encode(array('id' => $rdata['estado_final'], 'value' => $rdata['estado_final'], 'text' => $jdata['estado_final'])); ?>
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
				$j('#tipo_dispo' + d[rnd]).html(data.tipo_dispo);
				return true;
			}

			return false;
		});

		/* saved value for tipo_mtto */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'tipo_mtto' && d.id == data.tipo_mtto.id)
				return { results: [ data.tipo_mtto ], more: false, elapsed: 0.01 };
			return false;
		});

		/* saved value for responsable */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'responsable' && d.id == data.responsable.id)
				return { results: [ data.responsable ], more: false, elapsed: 0.01 };
			return false;
		});

		/* saved value for responsable autofills */
		cache.addCheck(function(u, d) {
			if(u != tn + '_autofill.php') return false;

			for(var rnd in d) if(rnd.match(/^rnd/)) break;

			if(d.mfk == 'responsable' && d.id == data.responsable.id) {
				$j('#id_responsable' + d[rnd]).html(data.id_responsable);
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

		/* saved value for unidad autofills */
		cache.addCheck(function(u, d) {
			if(u != tn + '_autofill.php') return false;

			for(var rnd in d) if(rnd.match(/^rnd/)) break;

			if(d.mfk == 'unidad' && d.id == data.unidad.id) {
				$j('#unidad_abreviado' + d[rnd]).html(data.unidad_abreviado);
				return true;
			}

			return false;
		});

		/* saved value for estado_final */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'estado_final' && d.id == data.estado_final.id)
				return { results: [ data.estado_final ], more: false, elapsed: 0.01 };
			return false;
		});

		cache.start();
	});
</script>

