<?php
	// For help on using hooks, please refer to https://bigprof.com/appgini/help/working-with-generated-web-database-application/hooks

	function dispositivos_init(&$options, $memberInfo, &$args) {
		/* Inserted by Search Page Maker for AppGini on 2021-08-02 10:38:29 */
		$options->FilterPage = 'hooks/dispositivos_filter.php';
		/* End of Search Page Maker for AppGini code */

		
		return TRUE;
	}

	function dispositivos_header($contentType, $memberInfo, &$args) {
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

	function dispositivos_footer($contentType, $memberInfo, &$args) {
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

	function dispositivos_before_insert(&$data, $memberInfo, &$args) {

		return TRUE;
	}

	function dispositivos_after_insert($data, $memberInfo, &$args) {

		return TRUE;
	}

	function dispositivos_before_update(&$data, $memberInfo, &$args) {

		return TRUE;
	}

	function dispositivos_after_update($data, $memberInfo, &$args) {

		return TRUE;
	}

	function dispositivos_before_delete($selectedID, &$skipChecks, $memberInfo, &$args) {

		return TRUE;
	}

	function dispositivos_after_delete($selectedID, $memberInfo, &$args) {

	}

	function dispositivos_dv($selectedID, $memberInfo, &$html, &$args) {

	}

	function dispositivos_csv($query, $memberInfo, &$args) {

		return $query;
	}
	function dispositivos_batch_actions(&$args) {

		return array();
	}
