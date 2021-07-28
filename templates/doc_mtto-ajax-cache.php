<?php
	$rdata = array_map('to_utf8', array_map('nl2br', array_map('html_attr_tags_ok', $rdata)));
	$jdata = array_map('to_utf8', array_map('nl2br', array_map('html_attr_tags_ok', $jdata)));
?>
<script>
	$j(function() {
		var tn = 'doc_mtto';

		/* data for selected record, or defaults if none is selected */
		var data = {
			id_mtto: <?php echo json_encode(array('id' => $rdata['id_mtto'], 'value' => $rdata['id_mtto'], 'text' => $jdata['id_mtto'])); ?>,
			tipo_mtto: <?php echo json_encode($jdata['tipo_mtto']); ?>,
			mtto: <?php echo json_encode($jdata['mtto']); ?>,
			nombre_biomedico: <?php echo json_encode(array('id' => $rdata['nombre_biomedico'], 'value' => $rdata['nombre_biomedico'], 'text' => $jdata['nombre_biomedico'])); ?>,
			registro_invima: <?php echo json_encode($jdata['registro_invima']); ?>,
			firma_biomedico: '<img src="thumbnail.php?i=<?php echo urlencode($jdata['firma_biomedico']); ?>&t=biomedicos&f=firma&v=dv" class="img-thumbnail">'
		};

		/* initialize or continue using AppGini.cache for the current table */
		AppGini.cache = AppGini.cache || {};
		AppGini.cache[tn] = AppGini.cache[tn] || AppGini.ajaxCache();
		var cache = AppGini.cache[tn];

		/* saved value for id_mtto */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'id_mtto' && d.id == data.id_mtto.id)
				return { results: [ data.id_mtto ], more: false, elapsed: 0.01 };
			return false;
		});

		/* saved value for id_mtto autofills */
		cache.addCheck(function(u, d) {
			if(u != tn + '_autofill.php') return false;

			for(var rnd in d) if(rnd.match(/^rnd/)) break;

			if(d.mfk == 'id_mtto' && d.id == data.id_mtto.id) {
				$j('#tipo_mtto' + d[rnd]).html(data.tipo_mtto);
				$j('#mtto' + d[rnd]).html(data.mtto);
				return true;
			}

			return false;
		});

		/* saved value for nombre_biomedico */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'nombre_biomedico' && d.id == data.nombre_biomedico.id)
				return { results: [ data.nombre_biomedico ], more: false, elapsed: 0.01 };
			return false;
		});

		/* saved value for nombre_biomedico autofills */
		cache.addCheck(function(u, d) {
			if(u != tn + '_autofill.php') return false;

			for(var rnd in d) if(rnd.match(/^rnd/)) break;

			if(d.mfk == 'nombre_biomedico' && d.id == data.nombre_biomedico.id) {
				$j('#registro_invima' + d[rnd]).html(data.registro_invima);
				$j('#firma_biomedico' + d[rnd]).html(data.firma_biomedico);
				return true;
			}

			return false;
		});

		cache.start();
	});
</script>

