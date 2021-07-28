<?php
	$rdata = array_map('to_utf8', array_map('nl2br', array_map('html_attr_tags_ok', $rdata)));
	$jdata = array_map('to_utf8', array_map('nl2br', array_map('html_attr_tags_ok', $jdata)));
?>
<script>
	$j(function() {
		var tn = 'cantidad_articulos';

		/* data for selected record, or defaults if none is selected */
		var data = {
			nombre_articulo: <?php echo json_encode(array('id' => $rdata['nombre_articulo'], 'value' => $rdata['nombre_articulo'], 'text' => $jdata['nombre_articulo'])); ?>,
			presentacion: <?php echo json_encode($jdata['presentacion']); ?>,
			descripcion: <?php echo json_encode($jdata['descripcion']); ?>,
			serial: <?php echo json_encode($jdata['serial']); ?>,
			estado: <?php echo json_encode(array('id' => $rdata['estado'], 'value' => $rdata['estado'], 'text' => $jdata['estado'])); ?>,
			id_compras: <?php echo json_encode(array('id' => $rdata['id_compras'], 'value' => $rdata['id_compras'], 'text' => $jdata['id_compras'])); ?>,
			tipo_compra: <?php echo json_encode($jdata['tipo_compra']); ?>
		};

		/* initialize or continue using AppGini.cache for the current table */
		AppGini.cache = AppGini.cache || {};
		AppGini.cache[tn] = AppGini.cache[tn] || AppGini.ajaxCache();
		var cache = AppGini.cache[tn];

		/* saved value for nombre_articulo */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'nombre_articulo' && d.id == data.nombre_articulo.id)
				return { results: [ data.nombre_articulo ], more: false, elapsed: 0.01 };
			return false;
		});

		/* saved value for nombre_articulo autofills */
		cache.addCheck(function(u, d) {
			if(u != tn + '_autofill.php') return false;

			for(var rnd in d) if(rnd.match(/^rnd/)) break;

			if(d.mfk == 'nombre_articulo' && d.id == data.nombre_articulo.id) {
				$j('#presentacion' + d[rnd]).html(data.presentacion);
				$j('#descripcion' + d[rnd]).html(data.descripcion);
				$j('#serial' + d[rnd]).html(data.serial);
				return true;
			}

			return false;
		});

		/* saved value for estado */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'estado' && d.id == data.estado.id)
				return { results: [ data.estado ], more: false, elapsed: 0.01 };
			return false;
		});

		/* saved value for id_compras */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'id_compras' && d.id == data.id_compras.id)
				return { results: [ data.id_compras ], more: false, elapsed: 0.01 };
			return false;
		});

		/* saved value for id_compras autofills */
		cache.addCheck(function(u, d) {
			if(u != tn + '_autofill.php') return false;

			for(var rnd in d) if(rnd.match(/^rnd/)) break;

			if(d.mfk == 'id_compras' && d.id == data.id_compras.id) {
				$j('#tipo_compra' + d[rnd]).html(data.tipo_compra);
				return true;
			}

			return false;
		});

		cache.start();
	});
</script>

