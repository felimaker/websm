<?php
	// For help on using hooks, please refer to https://bigprof.com/appgini/help/working-with-generated-web-database-application/hooks

	function mobiliario_init(&$options, $memberInfo, &$args) {

		return TRUE;
	}

	function mobiliario_header($contentType, $memberInfo, &$args) {
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

	function mobiliario_footer($contentType, $memberInfo, &$args) {
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

	function mobiliario_before_insert(&$data, $memberInfo, &$args) {

		
		return TRUE;
	}

	function mobiliario_after_insert($data, $memberInfo, &$args) {

		$a = $data['id_mobiliario'];
		$b = $data['descripcion'];
		
		$data['codigo '] = $a . $b ;
		
		return TRUE;
	}

	function mobiliario_before_update(&$data, $memberInfo, &$args) {

		return TRUE;
	}

	function mobiliario_after_update($data, $memberInfo, &$args) {
		
		return TRUE;
	}

	function mobiliario_before_delete($selectedID, &$skipChecks, $memberInfo, &$args) {

		return TRUE;
	}

	function mobiliario_after_delete($selectedID, $memberInfo, &$args) {

	}

	function mobiliario_dv($selectedID, $memberInfo, &$html, &$args) {

	}

	function mobiliario_csv($query, $memberInfo, &$args) {

		return $query;
	}
	function mobiliario_batch_actions(&$args) {

		return array();
	}
