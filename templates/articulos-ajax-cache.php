<?php
	$rdata = array_map('to_utf8', array_map('nl2br', array_map('html_attr_tags_ok', $rdata)));
	$jdata = array_map('to_utf8', array_map('nl2br', array_map('html_attr_tags_ok', $jdata)));
?>
<script>
	$j(function() {
		var tn = 'articulos';

		/* data for selected record, or defaults if none is selected */
		var data = {
			tipo_dispo: <?php echo json_encode(array('id' => $rdata['tipo_dispo'], 'value' => $rdata['tipo_dispo'], 'text' => $jdata['tipo_dispo'])); ?>,
			marca: <?php echo json_encode(array('id' => $rdata['marca'], 'value' => $rdata['marca'], 'text' => $jdata['marca'])); ?>,
			modelo: <?php echo json_encode(array('id' => $rdata['modelo'], 'value' => $rdata['modelo'], 'text' => $jdata['modelo'])); ?>,
			presentacion: <?php echo json_encode(array('id' => $rdata['presentacion'], 'value' => $rdata['presentacion'], 'text' => $jdata['presentacion'])); ?>,
			familia: <?php echo json_encode(array('id' => $rdata['familia'], 'value' => $rdata['familia'], 'text' => $jdata['familia'])); ?>,
			codigo_proveedor: <?php echo json_encode($jdata['codigo_proveedor']); ?>,
			imagen: (<?php echo strlen($jdata['imagen']); ?> > 0 ? '<a href="<?php echo getUploadDir('') . addslashes(str_replace(["\r", "\n"], '', $jdata['imagen'])); ?>" data-lightbox="articulos_dv"><img src="thumbnail.php?i=<?php echo urlencode($jdata['imagen']); ?>&t=marca_modelo&f=img&v=dv" class="img-thumbnail"></a>' : '<img src="photo.gif" class="img-thumbnail">'),
			estado: <?php echo json_encode(array('id' => $rdata['estado'], 'value' => $rdata['estado'], 'text' => $jdata['estado'])); ?>
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

		/* saved value for modelo autofills */
		cache.addCheck(function(u, d) {
			if(u != tn + '_autofill.php') return false;

			for(var rnd in d) if(rnd.match(/^rnd/)) break;

			if(d.mfk == 'modelo' && d.id == data.modelo.id) {
				$j('#imagen' + d[rnd]).html(data.imagen);
				return true;
			}

			return false;
		});

		/* saved value for presentacion */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'presentacion' && d.id == data.presentacion.id)
				return { results: [ data.presentacion ], more: false, elapsed: 0.01 };
			return false;
		});

		/* saved value for familia */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'familia' && d.id == data.familia.id)
				return { results: [ data.familia ], more: false, elapsed: 0.01 };
			return false;
		});

		/* saved value for familia autofills */
		cache.addCheck(function(u, d) {
			if(u != tn + '_autofill.php') return false;

			for(var rnd in d) if(rnd.match(/^rnd/)) break;

			if(d.mfk == 'familia' && d.id == data.familia.id) {
				$j('#codigo_proveedor' + d[rnd]).html(data.codigo_proveedor);
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

		cache.start();
	});
</script>

