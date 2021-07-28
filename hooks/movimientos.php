<?php
	// For help on using hooks, please refer to https://bigprof.com/appgini/help/working-with-generated-web-database-application/hooks

	function movimientos_init(&$options, $memberInfo, &$args) {

		return TRUE;
	}

	function movimientos_header($contentType, $memberInfo, &$args) {
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

	function movimientos_footer($contentType, $memberInfo, &$args) {
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

	function movimientos_before_insert(&$data, $memberInfo, &$args) {

		return TRUE;
	}

	function movimientos_after_insert($data, $memberInfo, &$args) {

		// Actualiza despues de guardar, el estado de estado_movi en valor 3 "Abierto".

		$sql = "UPDATE `movimientos` SET `estado_movi` = '3'  WHERE `id_movi`= ".$data['selectedID']."";
		sql($sql,$eo);
			
		return $eo == null;
	}

	function movimientos_before_update(&$data, $memberInfo, &$args) {

		return TRUE;
	}

	function movimientos_after_update($data, $memberInfo, &$args) {

		return TRUE;
	}

	function movimientos_before_delete($selectedID, &$skipChecks, $memberInfo, &$args) {

		return TRUE;
	}

	function movimientos_after_delete($selectedID, $memberInfo, &$args) {

	}

	function movimientos_dv($selectedID, $memberInfo, &$html, &$args) {

	}

	function movimientos_csv($query, $memberInfo, &$args) {

		return $query;
	}
	function movimientos_batch_actions(&$args) {

		return array();
	}
