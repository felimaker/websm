<?php
	// For help on using hooks, please refer to https://bigprof.com/appgini/help/working-with-generated-web-database-application/hooks

	function movi_envio_init(&$options, $memberInfo, &$args) {
		/* Inserted by Search Page Maker for AppGini on 2021-08-02 10:38:29 */
		$options->FilterPage = 'hooks/movi_envio_filter.php';
		/* End of Search Page Maker for AppGini code */


		return TRUE;
	}

	function movi_envio_header($contentType, $memberInfo, &$args) {
		$header='';

		switch($contentType) {
			case 'tableview':
				$header='';
				break;

			case 'detailview':
				$header='';
				break;

			case 'tableview+detailview':
				$header='';
				break;

			case 'print-tableview':
				$header='';
				break;

			case 'print-detailview':
				$header='';
				break;

			case 'filters':
				$header='';
				break;
		}

		return $header;
	}

	function movi_envio_footer($contentType, $memberInfo, &$args) {
		$footer='';

		switch($contentType) {
			case 'tableview':
				$footer='';
				break;

			case 'detailview':
				$footer='';
				break;

			case 'tableview+detailview':
				$footer='';
				break;

			case 'print-tableview':
				$footer='';
				break;

			case 'print-detailview':
				$footer='';
				break;

			case 'filters':
				$footer='';
				break;
		}

		return $footer;
	}

	function movi_envio_before_insert(&$data, $memberInfo, &$args) {

		return TRUE;
	}

	function movi_envio_after_insert($data, $memberInfo, &$args) {

			//Selecciono el id de movimienotos cuando envio is es igual//
			$nuevoestado= sqlValue(
			"SELECT `id_movi` FROM `movimientos` where id_movi=".$data['id_movi']."" );
			
			//Estados: 1 EN PROCESO, 2 COMPLETADO

			$table = "movimientos"; //Actualiza testado en tabla moviientos //
			$sql = "UPDATE `" . $table . "` SET `estado_movi` = '1'  WHERE `id_movi`=" . $nuevoestado . "";
			sql($sql,$eo);
		return $eo == null;
	}

	function movi_envio_before_update(&$data, $memberInfo, &$args) {

		return TRUE;
	}

	function movi_envio_after_update($data, $memberInfo, &$args) {

		return TRUE;
	}

	function movi_envio_before_delete($selectedID, &$skipChecks, $memberInfo, &$args) {

		return TRUE;
	}

	function movi_envio_after_delete($selectedID, $memberInfo, &$args) {

	}

	function movi_envio_dv($selectedID, $memberInfo, &$html, &$args) {
		/* if this is the print preview, don't modify the detail view */
		if(isset($_REQUEST['dvprint_x'])) return;
		
		ob_start(); ?>
		
		<script>
			$j(function(){
				<?php if($selectedID){ ?>
					$j('#movi_envio_dv_action_buttons .btn-toolbar').append(
						'<div class="btn-group-vertical btn-group-lg" style="width: 100%;">' +
							'<button type="button" class="btn btn-default btn-lg" onclick="print_invoice()">' +
								'<i class="glyphicon glyphicon-print"></i> Imprimir Envío</button>' +
							'<button type="button" class="btn btn-warning btn-lg" onclick="do_something_else()">' +
								'<i class="glyphicon glyphicon-ok"></i> Hacer algo!</button>' +
						'</div>'
					);
				<?php } ?>
			});
			
			function print_invoice(){
				var selectedID = '<?php echo urlencode($selectedID); ?>';
				window.location = 'movi_envio_print.php?id=' + selectedID;
			}
			
			function do_something_else(){
				alert("We're doing something else!");
			}
		</script>
		
		<?php
		$form_code = ob_get_contents();
		ob_end_clean();
		
		$html .= $form_code;
	}


	function movi_envio_csv($query, $memberInfo, &$args) {

		return $query;
	}
	function movi_envio_batch_actions(&$args) {

		return [];
	}
