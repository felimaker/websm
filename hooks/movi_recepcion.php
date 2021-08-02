<?php
	// For help on using hooks, please refer to https://bigprof.com/appgini/help/working-with-generated-web-database-application/hooks

	function movi_recepcion_init(&$options, $memberInfo, &$args) {
		/* Inserted by Search Page Maker for AppGini on 2021-08-02 10:38:29 */
		$options->FilterPage = 'hooks/movi_recepcion_filter.php';
		/* End of Search Page Maker for AppGini code */


		return TRUE;
	}

	function movi_recepcion_header($contentType, $memberInfo, &$args) {
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

	function movi_recepcion_footer($contentType, $memberInfo, &$args) {
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

	function movi_recepcion_before_insert(&$data, $memberInfo, &$args) {

		return TRUE;
	}

	function movi_recepcion_after_insert($data, $memberInfo, &$args) {

			//Selecciono el id de movimienotos cuando envio is es igual//
			$nuevoestado= sqlValue(
			"SELECT `id_movi` FROM `movimientos` where id_movi=".$data['id_movi']."" );
			
			//Estados: 1 EN PROCESO, 2 COMPLETADO

			$table = "movimientos"; //Actualiza testado en tabla moviientos //
			$sql = "UPDATE `" . $table . "` SET `estado_movi` = '2'  WHERE `id_movi`=" . $nuevoestado . "";
			sql($sql,$eo);
			
			//Funcion2
			
			//JOIN Selecciono el id de movimienotos cuando envio is es igual//
			$nuevoestado2= sqlValue(
			"SELECT `tipo_dispo` FROM `movi_recepcion` JOIN `movimientos` on `movimientos`.`id_movi` = `movi_recepcion`.`id_movi` where `movi_recepcion`.`id` = ".$data['id']."");
			
			print_r($nuevoestado2);
			
			$table2 = "dispositivos"; //Actualiza testado en tabla moviientos //
			$sql2 = "UPDATE `" . $table2 . "` SET `ubicacion` = '{$data['destino']}'  WHERE `id_dispo`=" . $nuevoestado2;
			sql($sql2,$eo);
			
		return $eo == null;
	}

	function movi_recepcion_before_update(&$data, $memberInfo, &$args) {

		return TRUE;
	}

	function movi_recepcion_after_update($data, $memberInfo, &$args) {

		return TRUE;
	}

	function movi_recepcion_before_delete($selectedID, &$skipChecks, $memberInfo, &$args) {

		return TRUE;
	}

	function movi_recepcion_after_delete($selectedID, $memberInfo, &$args) {

	}

	function movi_recepcion_dv($selectedID, $memberInfo, &$html, &$args) {

	}

	function movi_recepcion_csv($query, $memberInfo, &$args) {

		return $query;
	}
	function movi_recepcion_batch_actions(&$args) {

		return [];
	}
