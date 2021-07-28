<?php
	$rdata = array_map('to_utf8', array_map('nl2br', array_map('html_attr_tags_ok', $rdata)));
	$jdata = array_map('to_utf8', array_map('nl2br', array_map('html_attr_tags_ok', $jdata)));
?>
<script>
	$j(function() {
		var tn = 'financiero';

		/* data for selected record, or defaults if none is selected */
		var data = {
			id_dispo: <?php echo json_encode(array('id' => $rdata['id_dispo'], 'value' => $rdata['id_dispo'], 'text' => $jdata['id_dispo'])); ?>,
			unidad: <?php echo json_encode($jdata['unidad']); ?>
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
				$j('#unidad' + d[rnd]).html(data.unidad);
				return true;
			}

			return false;
		});

		cache.start();
	});
</script>

