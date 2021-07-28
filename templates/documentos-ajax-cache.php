<?php
	$rdata = array_map('to_utf8', array_map('nl2br', array_map('html_attr_tags_ok', $rdata)));
	$jdata = array_map('to_utf8', array_map('nl2br', array_map('html_attr_tags_ok', $jdata)));
?>
<script>
	$j(function() {
		var tn = 'documentos';

		/* data for selected record, or defaults if none is selected */
		var data = {
			dispo_codigo: <?php echo json_encode(array('id' => $rdata['dispo_codigo'], 'value' => $rdata['dispo_codigo'], 'text' => $jdata['dispo_codigo'])); ?>,
			dispo_serial: <?php echo json_encode($jdata['dispo_serial']); ?>,
			tipo_docu: <?php echo json_encode(array('id' => $rdata['tipo_docu'], 'value' => $rdata['tipo_docu'], 'text' => $jdata['tipo_docu'])); ?>
		};

		/* initialize or continue using AppGini.cache for the current table */
		AppGini.cache = AppGini.cache || {};
		AppGini.cache[tn] = AppGini.cache[tn] || AppGini.ajaxCache();
		var cache = AppGini.cache[tn];

		/* saved value for dispo_codigo */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'dispo_codigo' && d.id == data.dispo_codigo.id)
				return { results: [ data.dispo_codigo ], more: false, elapsed: 0.01 };
			return false;
		});

		/* saved value for dispo_codigo autofills */
		cache.addCheck(function(u, d) {
			if(u != tn + '_autofill.php') return false;

			for(var rnd in d) if(rnd.match(/^rnd/)) break;

			if(d.mfk == 'dispo_codigo' && d.id == data.dispo_codigo.id) {
				$j('#dispo_serial' + d[rnd]).html(data.dispo_serial);
				return true;
			}

			return false;
		});

		/* saved value for tipo_docu */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'tipo_docu' && d.id == data.tipo_docu.id)
				return { results: [ data.tipo_docu ], more: false, elapsed: 0.01 };
			return false;
		});

		cache.start();
	});
</script>

