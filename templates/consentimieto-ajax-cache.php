<?php
	$rdata = array_map('to_utf8', array_map('nl2br', array_map('html_attr_tags_ok', $rdata)));
	$jdata = array_map('to_utf8', array_map('nl2br', array_map('html_attr_tags_ok', $jdata)));
?>
<script>
	$j(function() {
		var tn = 'consentimieto';

		/* data for selected record, or defaults if none is selected */
		var data = {
			id_perfil: <?php echo json_encode(array('id' => $rdata['id_perfil'], 'value' => $rdata['id_perfil'], 'text' => $jdata['id_perfil'])); ?>,
			identificacion: <?php echo json_encode($jdata['identificacion']); ?>
		};

		/* initialize or continue using AppGini.cache for the current table */
		AppGini.cache = AppGini.cache || {};
		AppGini.cache[tn] = AppGini.cache[tn] || AppGini.ajaxCache();
		var cache = AppGini.cache[tn];

		/* saved value for id_perfil */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'id_perfil' && d.id == data.id_perfil.id)
				return { results: [ data.id_perfil ], more: false, elapsed: 0.01 };
			return false;
		});

		/* saved value for id_perfil autofills */
		cache.addCheck(function(u, d) {
			if(u != tn + '_autofill.php') return false;

			for(var rnd in d) if(rnd.match(/^rnd/)) break;

			if(d.mfk == 'id_perfil' && d.id == data.id_perfil.id) {
				$j('#identificacion' + d[rnd]).html(data.identificacion);
				return true;
			}

			return false;
		});

		cache.start();
	});
</script>

