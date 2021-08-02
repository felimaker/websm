<?php
	// For help on using hooks, please refer to https://bigprof.com/appgini/help/working-with-generated-web-database-application/hooks

	function articulos_init(&$options, $memberInfo, &$args) {
		/* Inserted by Search Page Maker for AppGini on 2021-08-02 10:38:29 */
		$options->FilterPage = 'hooks/articulos_filter.php';
		/* End of Search Page Maker for AppGini code */


		return TRUE;
	}

	function articulos_header($contentType, $memberInfo, &$args) {
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

	function articulos_footer($contentType, $memberInfo, &$args) {
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

	function articulos_before_insert(&$data, $memberInfo, &$args) {

		return TRUE;
	}

	function articulos_after_insert($data, $memberInfo, &$args) {

		return TRUE;
	}

	function articulos_before_update(&$data, $memberInfo, &$args) {

		return TRUE;
	}

	function articulos_after_update($data, $memberInfo, &$args) {

		return TRUE;
	}

	function articulos_before_delete($selectedID, &$skipChecks, $memberInfo, &$args) {

		return TRUE;
	}

	function articulos_after_delete($selectedID, $memberInfo, &$args) {

	}

	function articulos_dv($selectedID, $memberInfo, &$html, &$args) {

	}

	function articulos_csv($query, $memberInfo, &$args) {

		return $query;
	}
	function articulos_batch_actions(&$args) {

		return [];
	}
