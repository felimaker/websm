<?php
	// For help on using hooks, please refer to https://bigprof.com/appgini/help/working-with-generated-web-database-application/hooks

	function verificacion_init(&$options, $memberInfo, &$args) {
		/* Inserted by Search Page Maker for AppGini on 2021-08-02 10:38:29 */
		$options->FilterPage = 'hooks/verificacion_filter.php';
		/* End of Search Page Maker for AppGini code */


		return TRUE;
	}

	function verificacion_header($contentType, $memberInfo, &$args) {
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

	function verificacion_footer($contentType, $memberInfo, &$args) {
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

	function verificacion_before_insert(&$data, $memberInfo, &$args) {

		return TRUE;
	}

	function verificacion_after_insert($data, $memberInfo, &$args) {

			//Selecciono el id de movimienotos cuando envio is es igual//
			$nuevoestado= sqlValue(
			"SELECT `id_dispo` FROM `dispositivos` where id_dispo=".$data['codigo']."" );
			
			//Estados: 1 EN PROCESO, 2 COMPLETADO

			$table = "dispositivos"; //Actualiza testado en tabla moviientos //
			$sql = "UPDATE `" . $table . "` SET `ubicacion` = '{$data['ubicacion']}'  WHERE `id_dispo`=" . $nuevoestado . "";
			sql($sql,$eo);
		return $eo == null;
	}

	function verificacion_before_update(&$data, $memberInfo, &$args) {

		return TRUE;
	}

	function verificacion_after_update($data, $memberInfo, &$args) {

		return TRUE;
	}

	function verificacion_before_delete($selectedID, &$skipChecks, $memberInfo, &$args) {

		return TRUE;
	}

	function verificacion_after_delete($selectedID, $memberInfo, &$args) {

	}

	function verificacion_dv($selectedID, $memberInfo, &$html, &$args) {

	}

	function verificacion_csv($query, $memberInfo, &$args) {

		return $query;
	}
	function verificacion_batch_actions(&$args) {

		return array();
	}
