<?php
	$rdata = array_map('to_utf8', array_map('nl2br', array_map('html_attr_tags_ok', $rdata)));
	$jdata = array_map('to_utf8', array_map('nl2br', array_map('html_attr_tags_ok', $jdata)));
?>
<script>
	$j(function() {
		var tn = 'docu_modelo';

		/* data for selected record, or defaults if none is selected */
		var data = {
			tipo_dispo: <?php echo json_encode(array('id' => $rdata['tipo_dispo'], 'value' => $rdata['tipo_dispo'], 'text' => $jdata['tipo_dispo'])); ?>,
			marca: <?php echo json_encode(array('id' => $rdata['marca'], 'value' => $rdata['marca'], 'text' => $jdata['marca'])); ?>,
			modelo: <?php echo json_encode(array('id' => $rdata['modelo'], 'value' => $rdata['modelo'], 'text' => $jdata['modelo'])); ?>,
			tipo_documento: <?php echo json_encode(array('id' => $rdata['tipo_documento'], 'value' => $rdata['tipo_documento'], 'text' => $jdata['tipo_documento'])); ?>
		};

		/* initialize or continue using AppGini.cache for the current table */
		AppGini.cache = AppGini.cache || {};
		AppGini.cache[tn] = AppGini.cache[tn] || AppGini.ajaxCache();
		var cache = AppGini.cache[tn];

		/* saved value for tipo_dispo */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'tipo_dispo' && d.id == data.tipo_dispo.id)
				return { results: [ data.tipo_dispo ], more: false, elapsed: 0.01 };
			return false;
		});

		/* saved value for marca */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'marca' && d.id == data.marca.id)
				return { results: [ data.marca ], more: false, elapsed: 0.01 };
			return false;
		});

		/* saved value for modelo */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'modelo' && d.id == data.modelo.id)
				return { results: [ data.modelo ], more: false, elapsed: 0.01 };
			return false;
		});

		/* saved value for tipo_documento */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'tipo_documento' && d.id == data.tipo_documento.id)
				return { results: [ data.tipo_documento ], more: false, elapsed: 0.01 };
			return false;
		});

		cache.start();
	});
</script>

