<?php
	$rdata = array_map('to_utf8', array_map('nl2br', array_map('html_attr_tags_ok', $rdata)));
	$jdata = array_map('to_utf8', array_map('nl2br', array_map('html_attr_tags_ok', $jdata)));
?>
<script>
	$j(function() {
		var tn = 'prestador';

		/* data for selected record, or defaults if none is selected */
		var data = {
			razon_social: <?php echo json_encode(array('id' => $rdata['razon_social'], 'value' => $rdata['razon_social'], 'text' => $jdata['razon_social'])); ?>,
			nit: <?php echo json_encode($jdata['nit']); ?>
		};

		/* initialize or continue using AppGini.cache for the current table */
		AppGini.cache = AppGini.cache || {};
		AppGini.cache[tn] = AppGini.cache[tn] || AppGini.ajaxCache();
		var cache = AppGini.cache[tn];

		/* saved value for razon_social */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'razon_social' && d.id == data.razon_social.id)
				return { results: [ data.razon_social ], more: false, elapsed: 0.01 };
			return false;
		});

		/* saved value for razon_social autofills */
		cache.addCheck(function(u, d) {
			if(u != tn + '_autofill.php') return false;

			for(var rnd in d) if(rnd.match(/^rnd/)) break;

			if(d.mfk == 'razon_social' && d.id == data.razon_social.id) {
				$j('#nit' + d[rnd]).html(data.nit);
				return true;
			}

			return false;
		});

		cache.start();
	});
</script>

