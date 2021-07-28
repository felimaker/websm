<?php
	$rdata = array_map('to_utf8', array_map('nl2br', array_map('html_attr_tags_ok', $rdata)));
	$jdata = array_map('to_utf8', array_map('nl2br', array_map('html_attr_tags_ok', $jdata)));
?>
<script>
	$j(function() {
		var tn = 'contactos';

		/* data for selected record, or defaults if none is selected */
		var data = {
			tipo_contacto: <?php echo json_encode(array('id' => $rdata['tipo_contacto'], 'value' => $rdata['tipo_contacto'], 'text' => $jdata['tipo_contacto'])); ?>,
			tipo_iden: <?php echo json_encode(array('id' => $rdata['tipo_iden'], 'value' => $rdata['tipo_iden'], 'text' => $jdata['tipo_iden'])); ?>,
			ciudad: <?php echo json_encode(array('id' => $rdata['ciudad'], 'value' => $rdata['ciudad'], 'text' => $jdata['ciudad'])); ?>,
			tipo_relacion: <?php echo json_encode(array('id' => $rdata['tipo_relacion'], 'value' => $rdata['tipo_relacion'], 'text' => $jdata['tipo_relacion'])); ?>
		};

		/* initialize or continue using AppGini.cache for the current table */
		AppGini.cache = AppGini.cache || {};
		AppGini.cache[tn] = AppGini.cache[tn] || AppGini.ajaxCache();
		var cache = AppGini.cache[tn];

		/* saved value for tipo_iden */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'tipo_iden' && d.id == data.tipo_iden.id)
				return { results: [ data.tipo_iden ], more: false, elapsed: 0.01 };
			return false;
		});

		/* saved value for ciudad */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'ciudad' && d.id == data.ciudad.id)
				return { results: [ data.ciudad ], more: false, elapsed: 0.01 };
			return false;
		});

		/* saved value for tipo_relacion */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'tipo_relacion' && d.id == data.tipo_relacion.id)
				return { results: [ data.tipo_relacion ], more: false, elapsed: 0.01 };
			return false;
		});

		cache.start();
	});
</script>

