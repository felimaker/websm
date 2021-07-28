<?php
	// For help on using hooks, please refer to https://bigprof.com/appgini/help/working-with-generated-web-database-application/hooks

	function doc_mtto_init(&$options, $memberInfo, &$args) {

		return TRUE;
	}

	function doc_mtto_header($contentType, $memberInfo, &$args) {
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

	function doc_mtto_footer($contentType, $memberInfo, &$args) {
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

	function doc_mtto_before_insert(&$data, $memberInfo, &$args) {

		return TRUE;
	}

	function doc_mtto_after_insert($data, $memberInfo, &$args) {

		return TRUE;
	}

	function doc_mtto_before_update(&$data, $memberInfo, &$args) {

		return TRUE;
	}

	function doc_mtto_after_update($data, $memberInfo, &$args) {

		return TRUE;
	}

	function doc_mtto_before_delete($selectedID, &$skipChecks, $memberInfo, &$args) {

		return TRUE;
	}

	function doc_mtto_after_delete($selectedID, $memberInfo, &$args) {

	}

	function doc_mtto_dv($selectedID, $memberInfo, &$html, &$args){
		
		/* if this is the print preview, don't modify the detail view */
		
		if(isset($_REQUEST['dvprint_x'])) return;
		
		ob_start(); ?>
		
		<script>
			$j(function(){
				<?php if($selectedID){ ?>
					$j('#doc_mtto_dv_action_buttons .btn-toolbar').append(
						'<div class="btn-group-vertical btn-group-lg" style="width: 100%;">' +
							'<button type="button" class="btn btn-default btn-lg" onclick="print_invoice()">' +
								'<i class="glyphicon glyphicon-print"></i> Imprimir Doc</button>' +
					//		'<button type="button" class="btn btn-warning btn-lg" onclick="do_something_else()">' +
					//			'<i class="glyphicon glyphicon-ok"></i> Hacer algo!</button>' +
						'</div>'
					);
				<?php } ?>
			});
			
			function print_invoice(){
				var selectedID = '<?php echo urlencode($selectedID); ?>';
				window.location = 'doc_mtto_PRINT.php?id_doc=' + selectedID;
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

	function doc_mtto_csv($query, $memberInfo, &$args) {

		return $query;
	}
	function doc_mtto_batch_actions(&$args) {

		return [];
	}
