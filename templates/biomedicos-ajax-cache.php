<?php
	$rdata = array_map('to_utf8', array_map('nl2br', array_map('html_attr_tags_ok', $rdata)));
	$jdata = array_map('to_utf8', array_map('nl2br', array_map('html_attr_tags_ok', $jdata)));
?>
<script>
	$j(function() {
		var tn = 'biomedicos';

		/* data for selected record, or defaults if none is selected */
		var data = {
			id_contacto: <?php echo json_encode(array('id' => $rdata['id_contacto'], 'value' => $rdata['id_contacto'], 'text' => $jdata['id_contacto'])); ?>,
			nombre: <?php echo json_encode($jdata['nombre']); ?>
		};

		/* initialize or continue using AppGini.cache for the current table */
		AppGini.cache = AppGini.cache || {};
		AppGini.cache[tn] = AppGini.cache[tn] || AppGini.ajaxCache();
		var cache = AppGini.cache[tn];

		/* saved value for id_contacto */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'id_contacto' && d.id == data.id_contacto.id)
				return { results: [ data.id_contacto ], more: false, elapsed: 0.01 };
			return false;
		});

		/* saved value for id_contacto autofills */
		cache.addCheck(function(u, d) {
			if(u != tn + '_autofill.php') return false;

			for(var rnd in d) if(rnd.match(/^rnd/)) break;

			if(d.mfk == 'id_contacto' && d.id == data.id_contacto.id) {
				$j('#nombre' + d[rnd]).html(data.nombre);
				return true;
			}

			return false;
		});

		cache.start();
	});
</script>

