<?php
	$rdata = array_map('to_utf8', array_map('nl2br', array_map('html_attr_tags_ok', $rdata)));
	$jdata = array_map('to_utf8', array_map('nl2br', array_map('html_attr_tags_ok', $jdata)));
?>
<script>
	$j(function() {
		var tn = 'cronograma_mtto';

		/* data for selected record, or defaults if none is selected */
		var data = {
			id_programa: <?php echo json_encode(array('id' => $rdata['id_programa'], 'value' => $rdata['id_programa'], 'text' => $jdata['id_programa'])); ?>,
			ano: <?php echo json_encode($jdata['ano']); ?>,
			codigo: <?php echo json_encode(array('id' => $rdata['codigo'], 'value' => $rdata['codigo'], 'text' => $jdata['codigo'])); ?>,
			tipo_dispo: <?php echo json_encode($jdata['tipo_dispo']); ?>,
			marca: <?php echo json_encode(array('id' => $rdata['marca'], 'value' => $rdata['marca'], 'text' => $jdata['marca'])); ?>,
			modelo: <?php echo json_encode($jdata['modelo']); ?>,
			periodicidad: <?php echo json_encode(array('id' => $rdata['periodicidad'], 'value' => $rdata['periodicidad'], 'text' => $jdata['periodicidad'])); ?>
		};

		/* initialize or continue using AppGini.cache for the current table */
		AppGini.cache = AppGini.cache || {};
		AppGini.cache[tn] = AppGini.cache[tn] || AppGini.ajaxCache();
		var cache = AppGini.cache[tn];

		/* saved value for id_programa */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'id_programa' && d.id == data.id_programa.id)
				return { results: [ data.id_programa ], more: false, elapsed: 0.01 };
			return false;
		});

		/* saved value for id_programa autofills */
		cache.addCheck(function(u, d) {
			if(u != tn + '_autofill.php') return false;

			for(var rnd in d) if(rnd.match(/^rnd/)) break;

			if(d.mfk == 'id_programa' && d.id == data.id_programa.id) {
				$j('#ano' + d[rnd]).html(data.ano);
				return true;
			}

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
				$j('#modelo' + d[rnd]).html(data.modelo);
				return true;
			}

			return false;
		});

		/* saved value for marca */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'marca' && d.id == data.marca.id)
				return { results: [ data.marca ], more: false, elapsed: 0.01 };
			return false;
		});

		/* saved value for periodicidad */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'periodicidad' && d.id == data.periodicidad.id)
				return { results: [ data.periodicidad ], more: false, elapsed: 0.01 };
			return false;
		});

		cache.start();
	});
</script>

