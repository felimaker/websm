<?php
	$rdata = array_map('to_utf8', array_map('nl2br', array_map('html_attr_tags_ok', $rdata)));
	$jdata = array_map('to_utf8', array_map('nl2br', array_map('html_attr_tags_ok', $jdata)));
?>
<script>
	$j(function() {
		var tn = 'dispositivos';

		/* data for selected record, or defaults if none is selected */
		var data = {
			foto: (<?php echo strlen($jdata['foto']); ?> > 0 ? '<a href="<?php echo getUploadDir('') . addslashes(str_replace(["\r", "\n"], '', $jdata['foto'])); ?>" data-lightbox="dispositivos_dv"><img src="thumbnail.php?i=<?php echo urlencode($jdata['foto']); ?>&t=marca_modelo&f=img&v=dv" class="img-thumbnail"></a>' : '<img src="photo.gif" class="img-thumbnail">'),
			tipo_dispositivo: <?php echo json_encode(array('id' => $rdata['tipo_dispositivo'], 'value' => $rdata['tipo_dispositivo'], 'text' => $jdata['tipo_dispositivo'])); ?>,
			marca: <?php echo json_encode(array('id' => $rdata['marca'], 'value' => $rdata['marca'], 'text' => $jdata['marca'])); ?>,
			modelo: <?php echo json_encode(array('id' => $rdata['modelo'], 'value' => $rdata['modelo'], 'text' => $jdata['modelo'])); ?>,
			ubicacion: <?php echo json_encode(array('id' => $rdata['ubicacion'], 'value' => $rdata['ubicacion'], 'text' => $jdata['ubicacion'])); ?>,
			ubicacion_abre: <?php echo json_encode($jdata['ubicacion_abre']); ?>,
			clasificacion_riesgo: <?php echo json_encode(array('id' => $rdata['clasificacion_riesgo'], 'value' => $rdata['clasificacion_riesgo'], 'text' => $jdata['clasificacion_riesgo'])); ?>,
			estado: <?php echo json_encode(array('id' => $rdata['estado'], 'value' => $rdata['estado'], 'text' => $jdata['estado'])); ?>,
			id_compra_ingreso: <?php echo json_encode(array('id' => $rdata['id_compra_ingreso'], 'value' => $rdata['id_compra_ingreso'], 'text' => $jdata['id_compra_ingreso'])); ?>
		};

		/* initialize or continue using AppGini.cache for the current table */
		AppGini.cache = AppGini.cache || {};
		AppGini.cache[tn] = AppGini.cache[tn] || AppGini.ajaxCache();
		var cache = AppGini.cache[tn];

		/* saved value for tipo_dispositivo */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'tipo_dispositivo' && d.id == data.tipo_dispositivo.id)
				return { results: [ data.tipo_dispositivo ], more: false, elapsed: 0.01 };
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
				$j('#foto' + d[rnd]).html(data.foto);
				return true;
			}

			return false;
		});

		/* saved value for ubicacion */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'ubicacion' && d.id == data.ubicacion.id)
				return { results: [ data.ubicacion ], more: false, elapsed: 0.01 };
			return false;
		});

		/* saved value for ubicacion autofills */
		cache.addCheck(function(u, d) {
			if(u != tn + '_autofill.php') return false;

			for(var rnd in d) if(rnd.match(/^rnd/)) break;

			if(d.mfk == 'ubicacion' && d.id == data.ubicacion.id) {
				$j('#ubicacion_abre' + d[rnd]).html(data.ubicacion_abre);
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

		/* saved value for id_compra_ingreso */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'id_compra_ingreso' && d.id == data.id_compra_ingreso.id)
				return { results: [ data.id_compra_ingreso ], more: false, elapsed: 0.01 };
			return false;
		});

		cache.start();
	});
</script>

