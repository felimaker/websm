<?php

// Data functions (insert, update, delete, form) for table compras

// This script and data application were generated by AppGini 5.97
// Download AppGini for free from https://bigprof.com/appgini/download/

function compras_insert(&$error_message = '') {
	global $Translation;

	// mm: can member insert record?
	$arrPerm = getTablePermissions('compras');
	if(!$arrPerm['insert']) return false;

	$data = [
		'tipo_compra' => Request::lookup('tipo_compra', ''),
		'fecha_compra' => Request::dateComponents('fecha_compra', ''),
		'comprador' => Request::val('comprador', ''),
		'resumen' => Request::val('resumen', ''),
		'estado' => Request::lookup('estado', ''),
		'creado' => parseCode('<%%creationDateTime%%>', true, true),
		'creado_por' => parseCode('<%%creatorUsername%%>', true),
	];

	if($data['tipo_compra'] === '') {
		echo StyleSheet() . "\n\n<div class=\"alert alert-danger\">{$Translation['error:']} 'Tipo': {$Translation['field not null']}<br><br>";
		echo '<a href="" onclick="history.go(-1); return false;">' . $Translation['< back'] . '</a></div>';
		exit;
	}
	if($data['fecha_compra'] === '') {
		echo StyleSheet() . "\n\n<div class=\"alert alert-danger\">{$Translation['error:']} 'Fecha de transaccion': {$Translation['field not null']}<br><br>";
		echo '<a href="" onclick="history.go(-1); return false;">' . $Translation['< back'] . '</a></div>';
		exit;
	}

	// hook: compras_before_insert
	if(function_exists('compras_before_insert')) {
		$args = [];
		if(!compras_before_insert($data, getMemberInfo(), $args)) {
			if(isset($args['error_message'])) $error_message = $args['error_message'];
			return false;
		}
	}

	$error = '';
	// set empty fields to NULL
	$data = array_map(function($v) { return ($v === '' ? NULL : $v); }, $data);
	insert('compras', backtick_keys_once($data), $error);
	if($error)
		die("{$error}<br><a href=\"#\" onclick=\"history.go(-1);\">{$Translation['< back']}</a>");

	$recID = db_insert_id(db_link());

	update_calc_fields('compras', $recID, calculated_fields()['compras']);

	// hook: compras_after_insert
	if(function_exists('compras_after_insert')) {
		$res = sql("SELECT * FROM `compras` WHERE `id`='" . makeSafe($recID, false) . "' LIMIT 1", $eo);
		if($row = db_fetch_assoc($res)) {
			$data = array_map('makeSafe', $row);
		}
		$data['selectedID'] = makeSafe($recID, false);
		$args=[];
		if(!compras_after_insert($data, getMemberInfo(), $args)) { return $recID; }
	}

	// mm: save ownership data
	set_record_owner('compras', $recID, getLoggedMemberID());

	// if this record is a copy of another record, copy children if applicable
	if(!empty($_REQUEST['SelectedID'])) compras_copy_children($recID, $_REQUEST['SelectedID']);

	return $recID;
}

function compras_copy_children($destination_id, $source_id) {
	global $Translation;
	$requests = []; // array of curl handlers for launching insert requests
	$eo = ['silentErrors' => true];
	$safe_sid = makeSafe($source_id);

	// launch requests, asynchronously
	curl_batch($requests);
}

function compras_delete($selected_id, $AllowDeleteOfParents = false, $skipChecks = false) {
	// insure referential integrity ...
	global $Translation;
	$selected_id = makeSafe($selected_id);

	// mm: can member delete record?
	if(!check_record_permission('compras', $selected_id, 'delete')) {
		return $Translation['You don\'t have enough permissions to delete this record'];
	}

	// hook: compras_before_delete
	if(function_exists('compras_before_delete')) {
		$args = [];
		if(!compras_before_delete($selected_id, $skipChecks, getMemberInfo(), $args))
			return $Translation['Couldn\'t delete this record'] . (
				!empty($args['error_message']) ?
					'<div class="text-bold">' . strip_tags($args['error_message']) . '</div>'
					: '' 
			);
	}

	// child table: facturas
	$res = sql("SELECT `id` FROM `compras` WHERE `id`='{$selected_id}'", $eo);
	$id = db_fetch_row($res);
	$rires = sql("SELECT COUNT(1) FROM `facturas` WHERE `id_compras`='" . makeSafe($id[0]) . "'", $eo);
	$rirow = db_fetch_row($rires);
	if($rirow[0] && !$AllowDeleteOfParents && !$skipChecks) {
		$RetMsg = $Translation["couldn't delete"];
		$RetMsg = str_replace('<RelatedRecords>', $rirow[0], $RetMsg);
		$RetMsg = str_replace('<TableName>', 'facturas', $RetMsg);
		return $RetMsg;
	} elseif($rirow[0] && $AllowDeleteOfParents && !$skipChecks) {
		$RetMsg = $Translation['confirm delete'];
		$RetMsg = str_replace('<RelatedRecords>', $rirow[0], $RetMsg);
		$RetMsg = str_replace('<TableName>', 'facturas', $RetMsg);
		$RetMsg = str_replace('<Delete>', '<input type="button" class="button" value="' . $Translation['yes'] . '" onClick="window.location = \'compras_view.php?SelectedID=' . urlencode($selected_id) . '&delete_x=1&confirmed=1\';">', $RetMsg);
		$RetMsg = str_replace('<Cancel>', '<input type="button" class="button" value="' . $Translation[ 'no'] . '" onClick="window.location = \'compras_view.php?SelectedID=' . urlencode($selected_id) . '\';">', $RetMsg);
		return $RetMsg;
	}

	// child table: cantidad_dispomedico
	$res = sql("SELECT `id` FROM `compras` WHERE `id`='{$selected_id}'", $eo);
	$id = db_fetch_row($res);
	$rires = sql("SELECT COUNT(1) FROM `cantidad_dispomedico` WHERE `id_compra`='" . makeSafe($id[0]) . "'", $eo);
	$rirow = db_fetch_row($rires);
	if($rirow[0] && !$AllowDeleteOfParents && !$skipChecks) {
		$RetMsg = $Translation["couldn't delete"];
		$RetMsg = str_replace('<RelatedRecords>', $rirow[0], $RetMsg);
		$RetMsg = str_replace('<TableName>', 'cantidad_dispomedico', $RetMsg);
		return $RetMsg;
	} elseif($rirow[0] && $AllowDeleteOfParents && !$skipChecks) {
		$RetMsg = $Translation['confirm delete'];
		$RetMsg = str_replace('<RelatedRecords>', $rirow[0], $RetMsg);
		$RetMsg = str_replace('<TableName>', 'cantidad_dispomedico', $RetMsg);
		$RetMsg = str_replace('<Delete>', '<input type="button" class="button" value="' . $Translation['yes'] . '" onClick="window.location = \'compras_view.php?SelectedID=' . urlencode($selected_id) . '&delete_x=1&confirmed=1\';">', $RetMsg);
		$RetMsg = str_replace('<Cancel>', '<input type="button" class="button" value="' . $Translation[ 'no'] . '" onClick="window.location = \'compras_view.php?SelectedID=' . urlencode($selected_id) . '\';">', $RetMsg);
		return $RetMsg;
	}

	// child table: cantidad_articulos
	$res = sql("SELECT `id` FROM `compras` WHERE `id`='{$selected_id}'", $eo);
	$id = db_fetch_row($res);
	$rires = sql("SELECT COUNT(1) FROM `cantidad_articulos` WHERE `id_compras`='" . makeSafe($id[0]) . "'", $eo);
	$rirow = db_fetch_row($rires);
	if($rirow[0] && !$AllowDeleteOfParents && !$skipChecks) {
		$RetMsg = $Translation["couldn't delete"];
		$RetMsg = str_replace('<RelatedRecords>', $rirow[0], $RetMsg);
		$RetMsg = str_replace('<TableName>', 'cantidad_articulos', $RetMsg);
		return $RetMsg;
	} elseif($rirow[0] && $AllowDeleteOfParents && !$skipChecks) {
		$RetMsg = $Translation['confirm delete'];
		$RetMsg = str_replace('<RelatedRecords>', $rirow[0], $RetMsg);
		$RetMsg = str_replace('<TableName>', 'cantidad_articulos', $RetMsg);
		$RetMsg = str_replace('<Delete>', '<input type="button" class="button" value="' . $Translation['yes'] . '" onClick="window.location = \'compras_view.php?SelectedID=' . urlencode($selected_id) . '&delete_x=1&confirmed=1\';">', $RetMsg);
		$RetMsg = str_replace('<Cancel>', '<input type="button" class="button" value="' . $Translation[ 'no'] . '" onClick="window.location = \'compras_view.php?SelectedID=' . urlencode($selected_id) . '\';">', $RetMsg);
		return $RetMsg;
	}

	// child table: cantidad_mobiliario
	$res = sql("SELECT `id` FROM `compras` WHERE `id`='{$selected_id}'", $eo);
	$id = db_fetch_row($res);
	$rires = sql("SELECT COUNT(1) FROM `cantidad_mobiliario` WHERE `id_compra`='" . makeSafe($id[0]) . "'", $eo);
	$rirow = db_fetch_row($rires);
	if($rirow[0] && !$AllowDeleteOfParents && !$skipChecks) {
		$RetMsg = $Translation["couldn't delete"];
		$RetMsg = str_replace('<RelatedRecords>', $rirow[0], $RetMsg);
		$RetMsg = str_replace('<TableName>', 'cantidad_mobiliario', $RetMsg);
		return $RetMsg;
	} elseif($rirow[0] && $AllowDeleteOfParents && !$skipChecks) {
		$RetMsg = $Translation['confirm delete'];
		$RetMsg = str_replace('<RelatedRecords>', $rirow[0], $RetMsg);
		$RetMsg = str_replace('<TableName>', 'cantidad_mobiliario', $RetMsg);
		$RetMsg = str_replace('<Delete>', '<input type="button" class="button" value="' . $Translation['yes'] . '" onClick="window.location = \'compras_view.php?SelectedID=' . urlencode($selected_id) . '&delete_x=1&confirmed=1\';">', $RetMsg);
		$RetMsg = str_replace('<Cancel>', '<input type="button" class="button" value="' . $Translation[ 'no'] . '" onClick="window.location = \'compras_view.php?SelectedID=' . urlencode($selected_id) . '\';">', $RetMsg);
		return $RetMsg;
	}

	sql("DELETE FROM `compras` WHERE `id`='{$selected_id}'", $eo);

	// hook: compras_after_delete
	if(function_exists('compras_after_delete')) {
		$args = [];
		compras_after_delete($selected_id, getMemberInfo(), $args);
	}

	// mm: delete ownership data
	sql("DELETE FROM `membership_userrecords` WHERE `tableName`='compras' AND `pkValue`='{$selected_id}'", $eo);
}

function compras_update(&$selected_id, &$error_message = '') {
	global $Translation;

	// mm: can member edit record?
	if(!check_record_permission('compras', $selected_id, 'edit')) return false;

	$data = [
		'tipo_compra' => Request::lookup('tipo_compra', ''),
		'fecha_compra' => Request::dateComponents('fecha_compra', ''),
		'comprador' => Request::val('comprador', ''),
		'resumen' => Request::val('resumen', ''),
		'estado' => Request::lookup('estado', ''),
	];

	if($data['tipo_compra'] === '') {
		echo StyleSheet() . "\n\n<div class=\"alert alert-danger\">{$Translation['error:']} 'Tipo': {$Translation['field not null']}<br><br>";
		echo '<a href="" onclick="history.go(-1); return false;">' . $Translation['< back'] . '</a></div>';
		exit;
	}
	if($data['fecha_compra'] === '') {
		echo StyleSheet() . "\n\n<div class=\"alert alert-danger\">{$Translation['error:']} 'Fecha de transaccion': {$Translation['field not null']}<br><br>";
		echo '<a href="" onclick="history.go(-1); return false;">' . $Translation['< back'] . '</a></div>';
		exit;
	}
	// get existing values
	$old_data = getRecord('compras', $selected_id);
	if(is_array($old_data)) {
		$old_data = array_map('makeSafe', $old_data);
		$old_data['selectedID'] = makeSafe($selected_id);
	}

	$data['selectedID'] = makeSafe($selected_id);

	// hook: compras_before_update
	if(function_exists('compras_before_update')) {
		$args = ['old_data' => $old_data];
		if(!compras_before_update($data, getMemberInfo(), $args)) {
			if(isset($args['error_message'])) $error_message = $args['error_message'];
			return false;
		}
	}

	$set = $data; unset($set['selectedID']);
	foreach ($set as $field => $value) {
		$set[$field] = ($value !== '' && $value !== NULL) ? $value : NULL;
	}

	if(!update(
		'compras', 
		backtick_keys_once($set), 
		['`id`' => $selected_id], 
		$error_message
	)) {
		echo $error_message;
		echo '<a href="compras_view.php?SelectedID=' . urlencode($selected_id) . "\">{$Translation['< back']}</a>";
		exit;
	}


	$eo = ['silentErrors' => true];

	update_calc_fields('compras', $data['selectedID'], calculated_fields()['compras']);

	// hook: compras_after_update
	if(function_exists('compras_after_update')) {
		$res = sql("SELECT * FROM `compras` WHERE `id`='{$data['selectedID']}' LIMIT 1", $eo);
		if($row = db_fetch_assoc($res)) $data = array_map('makeSafe', $row);

		$data['selectedID'] = $data['id'];
		$args = ['old_data' => $old_data];
		if(!compras_after_update($data, getMemberInfo(), $args)) return;
	}

	// mm: update ownership data
	sql("UPDATE `membership_userrecords` SET `dateUpdated`='" . time() . "' WHERE `tableName`='compras' AND `pkValue`='" . makeSafe($selected_id) . "'", $eo);
}

function compras_form($selected_id = '', $AllowUpdate = 1, $AllowInsert = 1, $AllowDelete = 1, $ShowCancel = 0, $TemplateDV = '', $TemplateDVP = '') {
	// function to return an editable form for a table records
	// and fill it with data of record whose ID is $selected_id. If $selected_id
	// is empty, an empty form is shown, with only an 'Add New'
	// button displayed.

	global $Translation;

	// mm: get table permissions
	$arrPerm = getTablePermissions('compras');
	if(!$arrPerm['insert'] && $selected_id=='') return $Translation['tableAccessDenied'];
	$AllowInsert = ($arrPerm['insert'] ? true : false);
	// print preview?
	$dvprint = false;
	if($selected_id && $_REQUEST['dvprint_x'] != '') {
		$dvprint = true;
	}

	$filterer_tipo_compra = thisOr($_REQUEST['filterer_tipo_compra'], '');
	$filterer_estado = thisOr($_REQUEST['filterer_estado'], '');

	// populate filterers, starting from children to grand-parents

	// unique random identifier
	$rnd1 = ($dvprint ? rand(1000000, 9999999) : '');
	// combobox: tipo_compra
	$combo_tipo_compra = new DataCombo;
	// combobox: fecha_compra
	$combo_fecha_compra = new DateCombo;
	$combo_fecha_compra->DateFormat = "dmy";
	$combo_fecha_compra->MinYear = 1900;
	$combo_fecha_compra->MaxYear = 2100;
	$combo_fecha_compra->DefaultDate = parseMySQLDate('', '');
	$combo_fecha_compra->MonthNames = $Translation['month names'];
	$combo_fecha_compra->NamePrefix = 'fecha_compra';
	// combobox: estado
	$combo_estado = new DataCombo;

	if($selected_id) {
		// mm: check member permissions
		if(!$arrPerm['view']) return $Translation['tableAccessDenied'];

		// mm: who is the owner?
		$ownerGroupID = sqlValue("SELECT `groupID` FROM `membership_userrecords` WHERE `tableName`='compras' AND `pkValue`='" . makeSafe($selected_id) . "'");
		$ownerMemberID = sqlValue("SELECT LCASE(`memberID`) FROM `membership_userrecords` WHERE `tableName`='compras' AND `pkValue`='" . makeSafe($selected_id) . "'");

		if($arrPerm['view'] == 1 && getLoggedMemberID() != $ownerMemberID) return $Translation['tableAccessDenied'];
		if($arrPerm['view'] == 2 && getLoggedGroupID() != $ownerGroupID) return $Translation['tableAccessDenied'];

		// can edit?
		$AllowUpdate = 0;
		if(($arrPerm['edit'] == 1 && $ownerMemberID == getLoggedMemberID()) || ($arrPerm['edit'] == 2 && $ownerGroupID == getLoggedGroupID()) || $arrPerm['edit'] == 3) {
			$AllowUpdate = 1;
		}

		$res = sql("SELECT * FROM `compras` WHERE `id`='" . makeSafe($selected_id) . "'", $eo);
		if(!($row = db_fetch_array($res))) {
			return error_message($Translation['No records found'], 'compras_view.php', false);
		}
		$combo_tipo_compra->SelectedData = $row['tipo_compra'];
		$combo_fecha_compra->DefaultDate = $row['fecha_compra'];
		$combo_estado->SelectedData = $row['estado'];
		$urow = $row; /* unsanitized data */
		$row = array_map('safe_html', $row);
	} else {
		$combo_tipo_compra->SelectedData = $filterer_tipo_compra;
		$combo_estado->SelectedData = $filterer_estado;
	}
	$combo_tipo_compra->HTML = '<span id="tipo_compra-container' . $rnd1 . '"></span><input type="hidden" name="tipo_compra" id="tipo_compra' . $rnd1 . '" value="' . html_attr($combo_tipo_compra->SelectedData) . '">';
	$combo_tipo_compra->MatchText = '<span id="tipo_compra-container-readonly' . $rnd1 . '"></span><input type="hidden" name="tipo_compra" id="tipo_compra' . $rnd1 . '" value="' . html_attr($combo_tipo_compra->SelectedData) . '">';
	$combo_estado->HTML = '<span id="estado-container' . $rnd1 . '"></span><input type="hidden" name="estado" id="estado' . $rnd1 . '" value="' . html_attr($combo_estado->SelectedData) . '">';
	$combo_estado->MatchText = '<span id="estado-container-readonly' . $rnd1 . '"></span><input type="hidden" name="estado" id="estado' . $rnd1 . '" value="' . html_attr($combo_estado->SelectedData) . '">';

	ob_start();
	?>

	<script>
		// initial lookup values
		AppGini.current_tipo_compra__RAND__ = { text: "", value: "<?php echo addslashes($selected_id ? $urow['tipo_compra'] : htmlspecialchars($filterer_tipo_compra, ENT_QUOTES)); ?>"};
		AppGini.current_estado__RAND__ = { text: "", value: "<?php echo addslashes($selected_id ? $urow['estado'] : htmlspecialchars($filterer_estado, ENT_QUOTES)); ?>"};

		jQuery(function() {
			setTimeout(function() {
				if(typeof(tipo_compra_reload__RAND__) == 'function') tipo_compra_reload__RAND__();
				if(typeof(estado_reload__RAND__) == 'function') estado_reload__RAND__();
			}, 50); /* we need to slightly delay client-side execution of the above code to allow AppGini.ajaxCache to work */
		});
		function tipo_compra_reload__RAND__() {
		<?php if(($AllowUpdate || $AllowInsert) && !$dvprint) { ?>

			$j("#tipo_compra-container__RAND__").select2({
				/* initial default value */
				initSelection: function(e, c) {
					$j.ajax({
						url: 'ajax_combo.php',
						dataType: 'json',
						data: { id: AppGini.current_tipo_compra__RAND__.value, t: 'compras', f: 'tipo_compra' },
						success: function(resp) {
							c({
								id: resp.results[0].id,
								text: resp.results[0].text
							});
							$j('[name="tipo_compra"]').val(resp.results[0].id);
							$j('[id=tipo_compra-container-readonly__RAND__]').html('<span id="tipo_compra-match-text">' + resp.results[0].text + '</span>');
							if(resp.results[0].id == '<?php echo empty_lookup_value; ?>') { $j('.btn[id=tipo_compra_view_parent]').hide(); } else { $j('.btn[id=tipo_compra_view_parent]').show(); }


							if(typeof(tipo_compra_update_autofills__RAND__) == 'function') tipo_compra_update_autofills__RAND__();
						}
					});
				},
				width: '100%',
				formatNoMatches: function(term) { return '<?php echo addslashes($Translation['No matches found!']); ?>'; },
				minimumResultsForSearch: 5,
				loadMorePadding: 200,
				ajax: {
					url: 'ajax_combo.php',
					dataType: 'json',
					cache: true,
					data: function(term, page) { return { s: term, p: page, t: 'compras', f: 'tipo_compra' }; },
					results: function(resp, page) { return resp; }
				},
				escapeMarkup: function(str) { return str; }
			}).on('change', function(e) {
				AppGini.current_tipo_compra__RAND__.value = e.added.id;
				AppGini.current_tipo_compra__RAND__.text = e.added.text;
				$j('[name="tipo_compra"]').val(e.added.id);
				if(e.added.id == '<?php echo empty_lookup_value; ?>') { $j('.btn[id=tipo_compra_view_parent]').hide(); } else { $j('.btn[id=tipo_compra_view_parent]').show(); }


				if(typeof(tipo_compra_update_autofills__RAND__) == 'function') tipo_compra_update_autofills__RAND__();
			});

			if(!$j("#tipo_compra-container__RAND__").length) {
				$j.ajax({
					url: 'ajax_combo.php',
					dataType: 'json',
					data: { id: AppGini.current_tipo_compra__RAND__.value, t: 'compras', f: 'tipo_compra' },
					success: function(resp) {
						$j('[name="tipo_compra"]').val(resp.results[0].id);
						$j('[id=tipo_compra-container-readonly__RAND__]').html('<span id="tipo_compra-match-text">' + resp.results[0].text + '</span>');
						if(resp.results[0].id == '<?php echo empty_lookup_value; ?>') { $j('.btn[id=tipo_compra_view_parent]').hide(); } else { $j('.btn[id=tipo_compra_view_parent]').show(); }

						if(typeof(tipo_compra_update_autofills__RAND__) == 'function') tipo_compra_update_autofills__RAND__();
					}
				});
			}

		<?php } else { ?>

			$j.ajax({
				url: 'ajax_combo.php',
				dataType: 'json',
				data: { id: AppGini.current_tipo_compra__RAND__.value, t: 'compras', f: 'tipo_compra' },
				success: function(resp) {
					$j('[id=tipo_compra-container__RAND__], [id=tipo_compra-container-readonly__RAND__]').html('<span id="tipo_compra-match-text">' + resp.results[0].text + '</span>');
					if(resp.results[0].id == '<?php echo empty_lookup_value; ?>') { $j('.btn[id=tipo_compra_view_parent]').hide(); } else { $j('.btn[id=tipo_compra_view_parent]').show(); }

					if(typeof(tipo_compra_update_autofills__RAND__) == 'function') tipo_compra_update_autofills__RAND__();
				}
			});
		<?php } ?>

		}
		function estado_reload__RAND__() {
		<?php if(($AllowUpdate || $AllowInsert) && !$dvprint) { ?>

			$j("#estado-container__RAND__").select2({
				/* initial default value */
				initSelection: function(e, c) {
					$j.ajax({
						url: 'ajax_combo.php',
						dataType: 'json',
						data: { id: AppGini.current_estado__RAND__.value, t: 'compras', f: 'estado' },
						success: function(resp) {
							c({
								id: resp.results[0].id,
								text: resp.results[0].text
							});
							$j('[name="estado"]').val(resp.results[0].id);
							$j('[id=estado-container-readonly__RAND__]').html('<span id="estado-match-text">' + resp.results[0].text + '</span>');
							if(resp.results[0].id == '<?php echo empty_lookup_value; ?>') { $j('.btn[id=tipo_estado_compra_view_parent]').hide(); } else { $j('.btn[id=tipo_estado_compra_view_parent]').show(); }


							if(typeof(estado_update_autofills__RAND__) == 'function') estado_update_autofills__RAND__();
						}
					});
				},
				width: '100%',
				formatNoMatches: function(term) { return '<?php echo addslashes($Translation['No matches found!']); ?>'; },
				minimumResultsForSearch: 5,
				loadMorePadding: 200,
				ajax: {
					url: 'ajax_combo.php',
					dataType: 'json',
					cache: true,
					data: function(term, page) { return { s: term, p: page, t: 'compras', f: 'estado' }; },
					results: function(resp, page) { return resp; }
				},
				escapeMarkup: function(str) { return str; }
			}).on('change', function(e) {
				AppGini.current_estado__RAND__.value = e.added.id;
				AppGini.current_estado__RAND__.text = e.added.text;
				$j('[name="estado"]').val(e.added.id);
				if(e.added.id == '<?php echo empty_lookup_value; ?>') { $j('.btn[id=tipo_estado_compra_view_parent]').hide(); } else { $j('.btn[id=tipo_estado_compra_view_parent]').show(); }


				if(typeof(estado_update_autofills__RAND__) == 'function') estado_update_autofills__RAND__();
			});

			if(!$j("#estado-container__RAND__").length) {
				$j.ajax({
					url: 'ajax_combo.php',
					dataType: 'json',
					data: { id: AppGini.current_estado__RAND__.value, t: 'compras', f: 'estado' },
					success: function(resp) {
						$j('[name="estado"]').val(resp.results[0].id);
						$j('[id=estado-container-readonly__RAND__]').html('<span id="estado-match-text">' + resp.results[0].text + '</span>');
						if(resp.results[0].id == '<?php echo empty_lookup_value; ?>') { $j('.btn[id=tipo_estado_compra_view_parent]').hide(); } else { $j('.btn[id=tipo_estado_compra_view_parent]').show(); }

						if(typeof(estado_update_autofills__RAND__) == 'function') estado_update_autofills__RAND__();
					}
				});
			}

		<?php } else { ?>

			$j.ajax({
				url: 'ajax_combo.php',
				dataType: 'json',
				data: { id: AppGini.current_estado__RAND__.value, t: 'compras', f: 'estado' },
				success: function(resp) {
					$j('[id=estado-container__RAND__], [id=estado-container-readonly__RAND__]').html('<span id="estado-match-text">' + resp.results[0].text + '</span>');
					if(resp.results[0].id == '<?php echo empty_lookup_value; ?>') { $j('.btn[id=tipo_estado_compra_view_parent]').hide(); } else { $j('.btn[id=tipo_estado_compra_view_parent]').show(); }

					if(typeof(estado_update_autofills__RAND__) == 'function') estado_update_autofills__RAND__();
				}
			});
		<?php } ?>

		}
	</script>
	<?php

	$lookups = str_replace('__RAND__', $rnd1, ob_get_contents());
	ob_end_clean();


	// code for template based detail view forms

	// open the detail view template
	if($dvprint) {
		$template_file = is_file("./{$TemplateDVP}") ? "./{$TemplateDVP}" : './templates/compras_templateDVP.html';
		$templateCode = @file_get_contents($template_file);
	} else {
		$template_file = is_file("./{$TemplateDV}") ? "./{$TemplateDV}" : './templates/compras_templateDV.html';
		$templateCode = @file_get_contents($template_file);
	}

	// process form title
	$templateCode = str_replace('<%%DETAIL_VIEW_TITLE%%>', 'Compra details', $templateCode);
	$templateCode = str_replace('<%%RND1%%>', $rnd1, $templateCode);
	$templateCode = str_replace('<%%EMBEDDED%%>', ($_REQUEST['Embedded'] ? 'Embedded=1' : ''), $templateCode);
	// process buttons
	if($AllowInsert) {
		if(!$selected_id) $templateCode = str_replace('<%%INSERT_BUTTON%%>', '<button type="submit" class="btn btn-success" id="insert" name="insert_x" value="1" onclick="return compras_validateData();"><i class="glyphicon glyphicon-plus-sign"></i> ' . $Translation['Save New'] . '</button>', $templateCode);
		$templateCode = str_replace('<%%INSERT_BUTTON%%>', '<button type="submit" class="btn btn-default" id="insert" name="insert_x" value="1" onclick="return compras_validateData();"><i class="glyphicon glyphicon-plus-sign"></i> ' . $Translation['Save As Copy'] . '</button>', $templateCode);
	} else {
		$templateCode = str_replace('<%%INSERT_BUTTON%%>', '', $templateCode);
	}

	// 'Back' button action
	if($_REQUEST['Embedded']) {
		$backAction = 'AppGini.closeParentModal(); return false;';
	} else {
		$backAction = '$j(\'form\').eq(0).attr(\'novalidate\', \'novalidate\'); document.myform.reset(); return true;';
	}

	if($selected_id) {
		if(!$_REQUEST['Embedded']) $templateCode = str_replace('<%%DVPRINT_BUTTON%%>', '<button type="submit" class="btn btn-default" id="dvprint" name="dvprint_x" value="1" onclick="$j(\'form\').eq(0).prop(\'novalidate\', true); document.myform.reset(); return true;" title="' . html_attr($Translation['Print Preview']) . '"><i class="glyphicon glyphicon-print"></i> ' . $Translation['Print Preview'] . '</button>', $templateCode);
		if($AllowUpdate) {
			$templateCode = str_replace('<%%UPDATE_BUTTON%%>', '<button type="submit" class="btn btn-success btn-lg" id="update" name="update_x" value="1" onclick="return compras_validateData();" title="' . html_attr($Translation['Save Changes']) . '"><i class="glyphicon glyphicon-ok"></i> ' . $Translation['Save Changes'] . '</button>', $templateCode);
		} else {
			$templateCode = str_replace('<%%UPDATE_BUTTON%%>', '', $templateCode);
		}
		if(($arrPerm[4]==1 && $ownerMemberID==getLoggedMemberID()) || ($arrPerm[4]==2 && $ownerGroupID==getLoggedGroupID()) || $arrPerm[4]==3) { // allow delete?
			$templateCode = str_replace('<%%DELETE_BUTTON%%>', '<button type="submit" class="btn btn-danger" id="delete" name="delete_x" value="1" onclick="return confirm(\'' . $Translation['are you sure?'] . '\');" title="' . html_attr($Translation['Delete']) . '"><i class="glyphicon glyphicon-trash"></i> ' . $Translation['Delete'] . '</button>', $templateCode);
		} else {
			$templateCode = str_replace('<%%DELETE_BUTTON%%>', '', $templateCode);
		}
		$templateCode = str_replace('<%%DESELECT_BUTTON%%>', '<button type="submit" class="btn btn-default" id="deselect" name="deselect_x" value="1" onclick="' . $backAction . '" title="' . html_attr($Translation['Back']) . '"><i class="glyphicon glyphicon-chevron-left"></i> ' . $Translation['Back'] . '</button>', $templateCode);
	} else {
		$templateCode = str_replace('<%%UPDATE_BUTTON%%>', '', $templateCode);
		$templateCode = str_replace('<%%DELETE_BUTTON%%>', '', $templateCode);
		$templateCode = str_replace('<%%DESELECT_BUTTON%%>', ($ShowCancel ? '<button type="submit" class="btn btn-default" id="deselect" name="deselect_x" value="1" onclick="' . $backAction . '" title="' . html_attr($Translation['Back']) . '"><i class="glyphicon glyphicon-chevron-left"></i> ' . $Translation['Back'] . '</button>' : ''), $templateCode);
	}

	// set records to read only if user can't insert new records and can't edit current record
	if(($selected_id && !$AllowUpdate && !$AllowInsert) || (!$selected_id && !$AllowInsert)) {
		$jsReadOnly = '';
		$jsReadOnly .= "\tjQuery('#tipo_compra').prop('disabled', true).css({ color: '#555', backgroundColor: '#fff' });\n";
		$jsReadOnly .= "\tjQuery('#tipo_compra_caption').prop('disabled', true).css({ color: '#555', backgroundColor: 'white' });\n";
		$jsReadOnly .= "\tjQuery('#fecha_compra').prop('readonly', true);\n";
		$jsReadOnly .= "\tjQuery('#fecha_compraDay, #fecha_compraMonth, #fecha_compraYear').prop('disabled', true).css({ color: '#555', backgroundColor: '#fff' });\n";
		$jsReadOnly .= "\tjQuery('#comprador').replaceWith('<div class=\"form-control-static\" id=\"comprador\">' + (jQuery('#comprador').val() || '') + '</div>');\n";
		$jsReadOnly .= "\tjQuery('#resumen').replaceWith('<div class=\"form-control-static\" id=\"resumen\">' + (jQuery('#resumen').val() || '') + '</div>');\n";
		$jsReadOnly .= "\tjQuery('#estado').prop('disabled', true).css({ color: '#555', backgroundColor: '#fff' });\n";
		$jsReadOnly .= "\tjQuery('#estado_caption').prop('disabled', true).css({ color: '#555', backgroundColor: 'white' });\n";
		$jsReadOnly .= "\tjQuery('.select2-container').hide();\n";

		$noUploads = true;
	} elseif($AllowInsert) {
		$jsEditable = "\tjQuery('form').eq(0).data('already_changed', true);"; // temporarily disable form change handler
		$jsEditable .= "\tjQuery('form').eq(0).data('already_changed', false);"; // re-enable form change handler
	}

	// process combos
	$templateCode = str_replace('<%%COMBO(tipo_compra)%%>', $combo_tipo_compra->HTML, $templateCode);
	$templateCode = str_replace('<%%COMBOTEXT(tipo_compra)%%>', $combo_tipo_compra->MatchText, $templateCode);
	$templateCode = str_replace('<%%URLCOMBOTEXT(tipo_compra)%%>', urlencode($combo_tipo_compra->MatchText), $templateCode);
	$templateCode = str_replace('<%%COMBO(fecha_compra)%%>', ($selected_id && !$arrPerm[3] ? '<div class="form-control-static">' . $combo_fecha_compra->GetHTML(true) . '</div>' : $combo_fecha_compra->GetHTML()), $templateCode);
	$templateCode = str_replace('<%%COMBOTEXT(fecha_compra)%%>', $combo_fecha_compra->GetHTML(true), $templateCode);
	$templateCode = str_replace('<%%COMBO(estado)%%>', $combo_estado->HTML, $templateCode);
	$templateCode = str_replace('<%%COMBOTEXT(estado)%%>', $combo_estado->MatchText, $templateCode);
	$templateCode = str_replace('<%%URLCOMBOTEXT(estado)%%>', urlencode($combo_estado->MatchText), $templateCode);

	/* lookup fields array: 'lookup field name' => array('parent table name', 'lookup field caption') */
	$lookup_fields = array('tipo_compra' => array('tipo_compra', 'Tipo'), 'estado' => array('tipo_estado_compra', 'Estado'), );
	foreach($lookup_fields as $luf => $ptfc) {
		$pt_perm = getTablePermissions($ptfc[0]);

		// process foreign key links
		if($pt_perm['view'] || $pt_perm['edit']) {
			$templateCode = str_replace("<%%PLINK({$luf})%%>", '<button type="button" class="btn btn-default view_parent hspacer-md" id="' . $ptfc[0] . '_view_parent" title="' . html_attr($Translation['View'] . ' ' . $ptfc[1]) . '"><i class="glyphicon glyphicon-eye-open"></i></button>', $templateCode);
		}

		// if user has insert permission to parent table of a lookup field, put an add new button
		if($pt_perm['insert'] /* && !$_REQUEST['Embedded']*/) {
			$templateCode = str_replace("<%%ADDNEW({$ptfc[0]})%%>", '<button type="button" class="btn btn-success add_new_parent hspacer-md" id="' . $ptfc[0] . '_add_new" title="' . html_attr($Translation['Add New'] . ' ' . $ptfc[1]) . '"><i class="glyphicon glyphicon-plus-sign"></i></button>', $templateCode);
		}
	}

	// process images
	$templateCode = str_replace('<%%UPLOADFILE(id)%%>', '', $templateCode);
	$templateCode = str_replace('<%%UPLOADFILE(tipo_compra)%%>', '', $templateCode);
	$templateCode = str_replace('<%%UPLOADFILE(fecha_compra)%%>', '', $templateCode);
	$templateCode = str_replace('<%%UPLOADFILE(comprador)%%>', '', $templateCode);
	$templateCode = str_replace('<%%UPLOADFILE(resumen)%%>', '', $templateCode);
	$templateCode = str_replace('<%%UPLOADFILE(estado)%%>', '', $templateCode);
	$templateCode = str_replace('<%%UPLOADFILE(creado)%%>', '', $templateCode);
	$templateCode = str_replace('<%%UPLOADFILE(creado_por)%%>', '', $templateCode);

	// process values
	if($selected_id) {
		if( $dvprint) $templateCode = str_replace('<%%VALUE(id)%%>', safe_html($urow['id']), $templateCode);
		if(!$dvprint) $templateCode = str_replace('<%%VALUE(id)%%>', html_attr($row['id']), $templateCode);
		$templateCode = str_replace('<%%URLVALUE(id)%%>', urlencode($urow['id']), $templateCode);
		if( $dvprint) $templateCode = str_replace('<%%VALUE(tipo_compra)%%>', safe_html($urow['tipo_compra']), $templateCode);
		if(!$dvprint) $templateCode = str_replace('<%%VALUE(tipo_compra)%%>', html_attr($row['tipo_compra']), $templateCode);
		$templateCode = str_replace('<%%URLVALUE(tipo_compra)%%>', urlencode($urow['tipo_compra']), $templateCode);
		$templateCode = str_replace('<%%VALUE(fecha_compra)%%>', @date('d/m/Y', @strtotime(html_attr($row['fecha_compra']))), $templateCode);
		$templateCode = str_replace('<%%URLVALUE(fecha_compra)%%>', urlencode(@date('d/m/Y', @strtotime(html_attr($urow['fecha_compra'])))), $templateCode);
		if( $dvprint) $templateCode = str_replace('<%%VALUE(comprador)%%>', safe_html($urow['comprador']), $templateCode);
		if(!$dvprint) $templateCode = str_replace('<%%VALUE(comprador)%%>', html_attr($row['comprador']), $templateCode);
		$templateCode = str_replace('<%%URLVALUE(comprador)%%>', urlencode($urow['comprador']), $templateCode);
		if( $dvprint) $templateCode = str_replace('<%%VALUE(resumen)%%>', safe_html($urow['resumen']), $templateCode);
		if(!$dvprint) $templateCode = str_replace('<%%VALUE(resumen)%%>', html_attr($row['resumen']), $templateCode);
		$templateCode = str_replace('<%%URLVALUE(resumen)%%>', urlencode($urow['resumen']), $templateCode);
		if( $dvprint) $templateCode = str_replace('<%%VALUE(estado)%%>', safe_html($urow['estado']), $templateCode);
		if(!$dvprint) $templateCode = str_replace('<%%VALUE(estado)%%>', html_attr($row['estado']), $templateCode);
		$templateCode = str_replace('<%%URLVALUE(estado)%%>', urlencode($urow['estado']), $templateCode);
		$templateCode = str_replace('<%%VALUE(creado)%%>', app_datetime($row['creado'], 'dt'), $templateCode);
		$templateCode = str_replace('<%%URLVALUE(creado)%%>', urlencode(app_datetime($urow['creado'], 'dt')), $templateCode);
		$templateCode = str_replace('<%%VALUE(creado_por)%%>', safe_html($urow['creado_por']), $templateCode);
		$templateCode = str_replace('<%%URLVALUE(creado_por)%%>', urlencode($urow['creado_por']), $templateCode);
	} else {
		$templateCode = str_replace('<%%VALUE(id)%%>', '', $templateCode);
		$templateCode = str_replace('<%%URLVALUE(id)%%>', urlencode(''), $templateCode);
		$templateCode = str_replace('<%%VALUE(tipo_compra)%%>', '', $templateCode);
		$templateCode = str_replace('<%%URLVALUE(tipo_compra)%%>', urlencode(''), $templateCode);
		$templateCode = str_replace('<%%VALUE(fecha_compra)%%>', '', $templateCode);
		$templateCode = str_replace('<%%URLVALUE(fecha_compra)%%>', urlencode(''), $templateCode);
		$templateCode = str_replace('<%%VALUE(comprador)%%>', '', $templateCode);
		$templateCode = str_replace('<%%URLVALUE(comprador)%%>', urlencode(''), $templateCode);
		$templateCode = str_replace('<%%VALUE(resumen)%%>', '', $templateCode);
		$templateCode = str_replace('<%%URLVALUE(resumen)%%>', urlencode(''), $templateCode);
		$templateCode = str_replace('<%%VALUE(estado)%%>', '', $templateCode);
		$templateCode = str_replace('<%%URLVALUE(estado)%%>', urlencode(''), $templateCode);
		$templateCode = str_replace('<%%VALUE(creado)%%>', '<%%creationDateTime%%>', $templateCode);
		$templateCode = str_replace('<%%URLVALUE(creado)%%>', urlencode('<%%creationDateTime%%>'), $templateCode);
		$templateCode = str_replace('<%%VALUE(creado_por)%%>', '<%%creatorUsername%%>', $templateCode);
		$templateCode = str_replace('<%%URLVALUE(creado_por)%%>', urlencode('<%%creatorUsername%%>'), $templateCode);
	}

	// process translations
	$templateCode = parseTemplate($templateCode);

	// clear scrap
	$templateCode = str_replace('<%%', '<!-- ', $templateCode);
	$templateCode = str_replace('%%>', ' -->', $templateCode);

	// hide links to inaccessible tables
	if($_REQUEST['dvprint_x'] == '') {
		$templateCode .= "\n\n<script>\$j(function() {\n";
		$arrTables = getTableList();
		foreach($arrTables as $name => $caption) {
			$templateCode .= "\t\$j('#{$name}_link').removeClass('hidden');\n";
			$templateCode .= "\t\$j('#xs_{$name}_link').removeClass('hidden');\n";
		}

		$templateCode .= $jsReadOnly;
		$templateCode .= $jsEditable;

		if(!$selected_id) {
		}

		$templateCode.="\n});</script>\n";
	}

	// ajaxed auto-fill fields
	$templateCode .= '<script>';
	$templateCode .= '$j(function() {';


	$templateCode.="});";
	$templateCode.="</script>";
	$templateCode .= $lookups;

	// handle enforced parent values for read-only lookup fields

	// don't include blank images in lightbox gallery
	$templateCode = preg_replace('/blank.gif" data-lightbox=".*?"/', 'blank.gif"', $templateCode);

	// don't display empty email links
	$templateCode=preg_replace('/<a .*?href="mailto:".*?<\/a>/', '', $templateCode);

	/* default field values */
	$rdata = $jdata = get_defaults('compras');
	if($selected_id) {
		$jdata = get_joined_record('compras', $selected_id);
		if($jdata === false) $jdata = get_defaults('compras');
		$rdata = $row;
	}
	$templateCode .= loadView('compras-ajax-cache', array('rdata' => $rdata, 'jdata' => $jdata));

	// hook: compras_dv
	if(function_exists('compras_dv')) {
		$args=[];
		compras_dv(($selected_id ? $selected_id : FALSE), getMemberInfo(), $templateCode, $args);
	}

	return $templateCode;
}