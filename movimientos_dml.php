<?php

// Data functions (insert, update, delete, form) for table movimientos

// This script and data application were generated by AppGini 5.97
// Download AppGini for free from https://bigprof.com/appgini/download/

function movimientos_insert(&$error_message = '') {
	global $Translation;

	// mm: can member insert record?
	$arrPerm = getTablePermissions('movimientos');
	if(!$arrPerm['insert']) return false;

	$data = [
		'tipo_dispo' => Request::lookup('codigo_dispo'),
		'codigo_dispo' => Request::lookup('codigo_dispo', ''),
		'serial_dispo' => Request::lookup('codigo_dispo'),
		'creado' => parseCode('<%%creationDateTime%%>', true, true),
		'creado_por' => parseCode('<%%creatorUsername%%>', true),
	];

	if($data['codigo_dispo'] === '') {
		echo StyleSheet() . "\n\n<div class=\"alert alert-danger\">{$Translation['error:']} 'Codigo': {$Translation['field not null']}<br><br>";
		echo '<a href="" onclick="history.go(-1); return false;">' . $Translation['< back'] . '</a></div>';
		exit;
	}

	// hook: movimientos_before_insert
	if(function_exists('movimientos_before_insert')) {
		$args = [];
		if(!movimientos_before_insert($data, getMemberInfo(), $args)) {
			if(isset($args['error_message'])) $error_message = $args['error_message'];
			return false;
		}
	}

	$error = '';
	// set empty fields to NULL
	$data = array_map(function($v) { return ($v === '' ? NULL : $v); }, $data);
	insert('movimientos', backtick_keys_once($data), $error);
	if($error)
		die("{$error}<br><a href=\"#\" onclick=\"history.go(-1);\">{$Translation['< back']}</a>");

	$recID = db_insert_id(db_link());

	// automatic estado_movi if passed as filterer
	if($_REQUEST['filterer_estado_movi']) {
		sql("UPDATE `movimientos` SET `estado_movi`='" . makeSafe($_REQUEST['filterer_estado_movi']) . "' WHERE `id_movi`='" . makeSafe($recID, false) . "'", $eo);
	}

	update_calc_fields('movimientos', $recID, calculated_fields()['movimientos']);

	// hook: movimientos_after_insert
	if(function_exists('movimientos_after_insert')) {
		$res = sql("SELECT * FROM `movimientos` WHERE `id_movi`='" . makeSafe($recID, false) . "' LIMIT 1", $eo);
		if($row = db_fetch_assoc($res)) {
			$data = array_map('makeSafe', $row);
		}
		$data['selectedID'] = makeSafe($recID, false);
		$args=[];
		if(!movimientos_after_insert($data, getMemberInfo(), $args)) { return $recID; }
	}

	// mm: save ownership data
	set_record_owner('movimientos', $recID, getLoggedMemberID());

	// if this record is a copy of another record, copy children if applicable
	if(!empty($_REQUEST['SelectedID'])) movimientos_copy_children($recID, $_REQUEST['SelectedID']);

	return $recID;
}

function movimientos_copy_children($destination_id, $source_id) {
	global $Translation;
	$requests = []; // array of curl handlers for launching insert requests
	$eo = ['silentErrors' => true];
	$safe_sid = makeSafe($source_id);

	// launch requests, asynchronously
	curl_batch($requests);
}

function movimientos_delete($selected_id, $AllowDeleteOfParents = false, $skipChecks = false) {
	// insure referential integrity ...
	global $Translation;
	$selected_id = makeSafe($selected_id);

	// mm: can member delete record?
	if(!check_record_permission('movimientos', $selected_id, 'delete')) {
		return $Translation['You don\'t have enough permissions to delete this record'];
	}

	// hook: movimientos_before_delete
	if(function_exists('movimientos_before_delete')) {
		$args = [];
		if(!movimientos_before_delete($selected_id, $skipChecks, getMemberInfo(), $args))
			return $Translation['Couldn\'t delete this record'] . (
				!empty($args['error_message']) ?
					'<div class="text-bold">' . strip_tags($args['error_message']) . '</div>'
					: '' 
			);
	}

	// child table: movi_envio
	$res = sql("SELECT `id_movi` FROM `movimientos` WHERE `id_movi`='{$selected_id}'", $eo);
	$id_movi = db_fetch_row($res);
	$rires = sql("SELECT COUNT(1) FROM `movi_envio` WHERE `id_movi`='" . makeSafe($id_movi[0]) . "'", $eo);
	$rirow = db_fetch_row($rires);
	if($rirow[0] && !$AllowDeleteOfParents && !$skipChecks) {
		$RetMsg = $Translation["couldn't delete"];
		$RetMsg = str_replace('<RelatedRecords>', $rirow[0], $RetMsg);
		$RetMsg = str_replace('<TableName>', 'movi_envio', $RetMsg);
		return $RetMsg;
	} elseif($rirow[0] && $AllowDeleteOfParents && !$skipChecks) {
		$RetMsg = $Translation['confirm delete'];
		$RetMsg = str_replace('<RelatedRecords>', $rirow[0], $RetMsg);
		$RetMsg = str_replace('<TableName>', 'movi_envio', $RetMsg);
		$RetMsg = str_replace('<Delete>', '<input type="button" class="button" value="' . $Translation['yes'] . '" onClick="window.location = \'movimientos_view.php?SelectedID=' . urlencode($selected_id) . '&delete_x=1&confirmed=1\';">', $RetMsg);
		$RetMsg = str_replace('<Cancel>', '<input type="button" class="button" value="' . $Translation[ 'no'] . '" onClick="window.location = \'movimientos_view.php?SelectedID=' . urlencode($selected_id) . '\';">', $RetMsg);
		return $RetMsg;
	}

	// child table: movi_recepcion
	$res = sql("SELECT `id_movi` FROM `movimientos` WHERE `id_movi`='{$selected_id}'", $eo);
	$id_movi = db_fetch_row($res);
	$rires = sql("SELECT COUNT(1) FROM `movi_recepcion` WHERE `id_movi`='" . makeSafe($id_movi[0]) . "'", $eo);
	$rirow = db_fetch_row($rires);
	if($rirow[0] && !$AllowDeleteOfParents && !$skipChecks) {
		$RetMsg = $Translation["couldn't delete"];
		$RetMsg = str_replace('<RelatedRecords>', $rirow[0], $RetMsg);
		$RetMsg = str_replace('<TableName>', 'movi_recepcion', $RetMsg);
		return $RetMsg;
	} elseif($rirow[0] && $AllowDeleteOfParents && !$skipChecks) {
		$RetMsg = $Translation['confirm delete'];
		$RetMsg = str_replace('<RelatedRecords>', $rirow[0], $RetMsg);
		$RetMsg = str_replace('<TableName>', 'movi_recepcion', $RetMsg);
		$RetMsg = str_replace('<Delete>', '<input type="button" class="button" value="' . $Translation['yes'] . '" onClick="window.location = \'movimientos_view.php?SelectedID=' . urlencode($selected_id) . '&delete_x=1&confirmed=1\';">', $RetMsg);
		$RetMsg = str_replace('<Cancel>', '<input type="button" class="button" value="' . $Translation[ 'no'] . '" onClick="window.location = \'movimientos_view.php?SelectedID=' . urlencode($selected_id) . '\';">', $RetMsg);
		return $RetMsg;
	}

	sql("DELETE FROM `movimientos` WHERE `id_movi`='{$selected_id}'", $eo);

	// hook: movimientos_after_delete
	if(function_exists('movimientos_after_delete')) {
		$args = [];
		movimientos_after_delete($selected_id, getMemberInfo(), $args);
	}

	// mm: delete ownership data
	sql("DELETE FROM `membership_userrecords` WHERE `tableName`='movimientos' AND `pkValue`='{$selected_id}'", $eo);
}

function movimientos_update(&$selected_id, &$error_message = '') {
	global $Translation;

	// mm: can member edit record?
	if(!check_record_permission('movimientos', $selected_id, 'edit')) return false;

	$data = [
		'tipo_dispo' => Request::lookup('codigo_dispo'),
		'codigo_dispo' => Request::lookup('codigo_dispo', ''),
		'serial_dispo' => Request::lookup('codigo_dispo'),
		'editado' => parseCode('<%%editingDateTime%%>', false, true),
		'editado_por' => parseCode('<%%editorUsername%%>', false),
	];

	if($data['codigo_dispo'] === '') {
		echo StyleSheet() . "\n\n<div class=\"alert alert-danger\">{$Translation['error:']} 'Codigo': {$Translation['field not null']}<br><br>";
		echo '<a href="" onclick="history.go(-1); return false;">' . $Translation['< back'] . '</a></div>';
		exit;
	}
	// get existing values
	$old_data = getRecord('movimientos', $selected_id);
	if(is_array($old_data)) {
		$old_data = array_map('makeSafe', $old_data);
		$old_data['selectedID'] = makeSafe($selected_id);
	}

	$data['selectedID'] = makeSafe($selected_id);

	// hook: movimientos_before_update
	if(function_exists('movimientos_before_update')) {
		$args = ['old_data' => $old_data];
		if(!movimientos_before_update($data, getMemberInfo(), $args)) {
			if(isset($args['error_message'])) $error_message = $args['error_message'];
			return false;
		}
	}

	$set = $data; unset($set['selectedID']);
	foreach ($set as $field => $value) {
		$set[$field] = ($value !== '' && $value !== NULL) ? $value : NULL;
	}

	if(!update(
		'movimientos', 
		backtick_keys_once($set), 
		['`id_movi`' => $selected_id], 
		$error_message
	)) {
		echo $error_message;
		echo '<a href="movimientos_view.php?SelectedID=' . urlencode($selected_id) . "\">{$Translation['< back']}</a>";
		exit;
	}


	$eo = ['silentErrors' => true];

	update_calc_fields('movimientos', $data['selectedID'], calculated_fields()['movimientos']);

	// hook: movimientos_after_update
	if(function_exists('movimientos_after_update')) {
		$res = sql("SELECT * FROM `movimientos` WHERE `id_movi`='{$data['selectedID']}' LIMIT 1", $eo);
		if($row = db_fetch_assoc($res)) $data = array_map('makeSafe', $row);

		$data['selectedID'] = $data['id_movi'];
		$args = ['old_data' => $old_data];
		if(!movimientos_after_update($data, getMemberInfo(), $args)) return;
	}

	// mm: update ownership data
	sql("UPDATE `membership_userrecords` SET `dateUpdated`='" . time() . "' WHERE `tableName`='movimientos' AND `pkValue`='" . makeSafe($selected_id) . "'", $eo);
}

function movimientos_form($selected_id = '', $AllowUpdate = 1, $AllowInsert = 1, $AllowDelete = 1, $ShowCancel = 0, $TemplateDV = '', $TemplateDVP = '') {
	// function to return an editable form for a table records
	// and fill it with data of record whose ID is $selected_id. If $selected_id
	// is empty, an empty form is shown, with only an 'Add New'
	// button displayed.

	global $Translation;

	// mm: get table permissions
	$arrPerm = getTablePermissions('movimientos');
	if(!$arrPerm['insert'] && $selected_id=='') return $Translation['tableAccessDenied'];
	$AllowInsert = ($arrPerm['insert'] ? true : false);
	// print preview?
	$dvprint = false;
	if($selected_id && $_REQUEST['dvprint_x'] != '') {
		$dvprint = true;
	}

	$filterer_codigo_dispo = thisOr($_REQUEST['filterer_codigo_dispo'], '');
	$filterer_estado_movi = thisOr($_REQUEST['filterer_estado_movi'], '');

	// populate filterers, starting from children to grand-parents

	// unique random identifier
	$rnd1 = ($dvprint ? rand(1000000, 9999999) : '');
	// combobox: codigo_dispo
	$combo_codigo_dispo = new DataCombo;
	// combobox: estado_movi
	$combo_estado_movi = new DataCombo;

	if($selected_id) {
		// mm: check member permissions
		if(!$arrPerm['view']) return $Translation['tableAccessDenied'];

		// mm: who is the owner?
		$ownerGroupID = sqlValue("SELECT `groupID` FROM `membership_userrecords` WHERE `tableName`='movimientos' AND `pkValue`='" . makeSafe($selected_id) . "'");
		$ownerMemberID = sqlValue("SELECT LCASE(`memberID`) FROM `membership_userrecords` WHERE `tableName`='movimientos' AND `pkValue`='" . makeSafe($selected_id) . "'");

		if($arrPerm['view'] == 1 && getLoggedMemberID() != $ownerMemberID) return $Translation['tableAccessDenied'];
		if($arrPerm['view'] == 2 && getLoggedGroupID() != $ownerGroupID) return $Translation['tableAccessDenied'];

		// can edit?
		$AllowUpdate = 0;
		if(($arrPerm['edit'] == 1 && $ownerMemberID == getLoggedMemberID()) || ($arrPerm['edit'] == 2 && $ownerGroupID == getLoggedGroupID()) || $arrPerm['edit'] == 3) {
			$AllowUpdate = 1;
		}

		$res = sql("SELECT * FROM `movimientos` WHERE `id_movi`='" . makeSafe($selected_id) . "'", $eo);
		if(!($row = db_fetch_array($res))) {
			return error_message($Translation['No records found'], 'movimientos_view.php', false);
		}
		$combo_codigo_dispo->SelectedData = $row['codigo_dispo'];
		$combo_estado_movi->SelectedData = $row['estado_movi'];
		$urow = $row; /* unsanitized data */
		$row = array_map('safe_html', $row);
	} else {
		$combo_codigo_dispo->SelectedData = $filterer_codigo_dispo;
		$combo_estado_movi->SelectedData = $filterer_estado_movi;
	}
	$combo_codigo_dispo->HTML = '<span id="codigo_dispo-container' . $rnd1 . '"></span><input type="hidden" name="codigo_dispo" id="codigo_dispo' . $rnd1 . '" value="' . html_attr($combo_codigo_dispo->SelectedData) . '">';
	$combo_codigo_dispo->MatchText = '<span id="codigo_dispo-container-readonly' . $rnd1 . '"></span><input type="hidden" name="codigo_dispo" id="codigo_dispo' . $rnd1 . '" value="' . html_attr($combo_codigo_dispo->SelectedData) . '">';
	$combo_estado_movi->HTML = '<span id="estado_movi-container' . $rnd1 . '"></span><input type="hidden" name="estado_movi" id="estado_movi' . $rnd1 . '" value="' . html_attr($combo_estado_movi->SelectedData) . '">';
	$combo_estado_movi->MatchText = '<span id="estado_movi-container-readonly' . $rnd1 . '"></span><input type="hidden" name="estado_movi" id="estado_movi' . $rnd1 . '" value="' . html_attr($combo_estado_movi->SelectedData) . '">';

	ob_start();
	?>

	<script>
		// initial lookup values
		AppGini.current_codigo_dispo__RAND__ = { text: "", value: "<?php echo addslashes($selected_id ? $urow['codigo_dispo'] : htmlspecialchars($filterer_codigo_dispo, ENT_QUOTES)); ?>"};
		AppGini.current_estado_movi__RAND__ = { text: "", value: "<?php echo addslashes($selected_id ? $urow['estado_movi'] : htmlspecialchars($filterer_estado_movi, ENT_QUOTES)); ?>"};

		jQuery(function() {
			setTimeout(function() {
				if(typeof(codigo_dispo_reload__RAND__) == 'function') codigo_dispo_reload__RAND__();
				if(typeof(estado_movi_reload__RAND__) == 'function') estado_movi_reload__RAND__();
			}, 50); /* we need to slightly delay client-side execution of the above code to allow AppGini.ajaxCache to work */
		});
		function codigo_dispo_reload__RAND__() {
		<?php if(($AllowUpdate || $AllowInsert) && !$dvprint) { ?>

			$j("#codigo_dispo-container__RAND__").select2({
				/* initial default value */
				initSelection: function(e, c) {
					$j.ajax({
						url: 'ajax_combo.php',
						dataType: 'json',
						data: { id: AppGini.current_codigo_dispo__RAND__.value, t: 'movimientos', f: 'codigo_dispo' },
						success: function(resp) {
							c({
								id: resp.results[0].id,
								text: resp.results[0].text
							});
							$j('[name="codigo_dispo"]').val(resp.results[0].id);
							$j('[id=codigo_dispo-container-readonly__RAND__]').html('<span id="codigo_dispo-match-text">' + resp.results[0].text + '</span>');
							if(resp.results[0].id == '<?php echo empty_lookup_value; ?>') { $j('.btn[id=dispositivos_view_parent]').hide(); } else { $j('.btn[id=dispositivos_view_parent]').show(); }


							if(typeof(codigo_dispo_update_autofills__RAND__) == 'function') codigo_dispo_update_autofills__RAND__();
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
					data: function(term, page) { return { s: term, p: page, t: 'movimientos', f: 'codigo_dispo' }; },
					results: function(resp, page) { return resp; }
				},
				escapeMarkup: function(str) { return str; }
			}).on('change', function(e) {
				AppGini.current_codigo_dispo__RAND__.value = e.added.id;
				AppGini.current_codigo_dispo__RAND__.text = e.added.text;
				$j('[name="codigo_dispo"]').val(e.added.id);
				if(e.added.id == '<?php echo empty_lookup_value; ?>') { $j('.btn[id=dispositivos_view_parent]').hide(); } else { $j('.btn[id=dispositivos_view_parent]').show(); }


				if(typeof(codigo_dispo_update_autofills__RAND__) == 'function') codigo_dispo_update_autofills__RAND__();
			});

			if(!$j("#codigo_dispo-container__RAND__").length) {
				$j.ajax({
					url: 'ajax_combo.php',
					dataType: 'json',
					data: { id: AppGini.current_codigo_dispo__RAND__.value, t: 'movimientos', f: 'codigo_dispo' },
					success: function(resp) {
						$j('[name="codigo_dispo"]').val(resp.results[0].id);
						$j('[id=codigo_dispo-container-readonly__RAND__]').html('<span id="codigo_dispo-match-text">' + resp.results[0].text + '</span>');
						if(resp.results[0].id == '<?php echo empty_lookup_value; ?>') { $j('.btn[id=dispositivos_view_parent]').hide(); } else { $j('.btn[id=dispositivos_view_parent]').show(); }

						if(typeof(codigo_dispo_update_autofills__RAND__) == 'function') codigo_dispo_update_autofills__RAND__();
					}
				});
			}

		<?php } else { ?>

			$j.ajax({
				url: 'ajax_combo.php',
				dataType: 'json',
				data: { id: AppGini.current_codigo_dispo__RAND__.value, t: 'movimientos', f: 'codigo_dispo' },
				success: function(resp) {
					$j('[id=codigo_dispo-container__RAND__], [id=codigo_dispo-container-readonly__RAND__]').html('<span id="codigo_dispo-match-text">' + resp.results[0].text + '</span>');
					if(resp.results[0].id == '<?php echo empty_lookup_value; ?>') { $j('.btn[id=dispositivos_view_parent]').hide(); } else { $j('.btn[id=dispositivos_view_parent]').show(); }

					if(typeof(codigo_dispo_update_autofills__RAND__) == 'function') codigo_dispo_update_autofills__RAND__();
				}
			});
		<?php } ?>

		}
		function estado_movi_reload__RAND__() {
		<?php if(($AllowUpdate || $AllowInsert) && !$dvprint) { ?>

			$j("#estado_movi-container__RAND__").select2({
				/* initial default value */
				initSelection: function(e, c) {
					$j.ajax({
						url: 'ajax_combo.php',
						dataType: 'json',
						data: { id: AppGini.current_estado_movi__RAND__.value, t: 'movimientos', f: 'estado_movi' },
						success: function(resp) {
							c({
								id: resp.results[0].id,
								text: resp.results[0].text
							});
							$j('[name="estado_movi"]').val(resp.results[0].id);
							$j('[id=estado_movi-container-readonly__RAND__]').html('<span id="estado_movi-match-text">' + resp.results[0].text + '</span>');
							if(resp.results[0].id == '<?php echo empty_lookup_value; ?>') { $j('.btn[id=tipo_estado_movi_view_parent]').hide(); } else { $j('.btn[id=tipo_estado_movi_view_parent]').show(); }


							if(typeof(estado_movi_update_autofills__RAND__) == 'function') estado_movi_update_autofills__RAND__();
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
					data: function(term, page) { return { s: term, p: page, t: 'movimientos', f: 'estado_movi' }; },
					results: function(resp, page) { return resp; }
				},
				escapeMarkup: function(str) { return str; }
			}).on('change', function(e) {
				AppGini.current_estado_movi__RAND__.value = e.added.id;
				AppGini.current_estado_movi__RAND__.text = e.added.text;
				$j('[name="estado_movi"]').val(e.added.id);
				if(e.added.id == '<?php echo empty_lookup_value; ?>') { $j('.btn[id=tipo_estado_movi_view_parent]').hide(); } else { $j('.btn[id=tipo_estado_movi_view_parent]').show(); }


				if(typeof(estado_movi_update_autofills__RAND__) == 'function') estado_movi_update_autofills__RAND__();
			});

			if(!$j("#estado_movi-container__RAND__").length) {
				$j.ajax({
					url: 'ajax_combo.php',
					dataType: 'json',
					data: { id: AppGini.current_estado_movi__RAND__.value, t: 'movimientos', f: 'estado_movi' },
					success: function(resp) {
						$j('[name="estado_movi"]').val(resp.results[0].id);
						$j('[id=estado_movi-container-readonly__RAND__]').html('<span id="estado_movi-match-text">' + resp.results[0].text + '</span>');
						if(resp.results[0].id == '<?php echo empty_lookup_value; ?>') { $j('.btn[id=tipo_estado_movi_view_parent]').hide(); } else { $j('.btn[id=tipo_estado_movi_view_parent]').show(); }

						if(typeof(estado_movi_update_autofills__RAND__) == 'function') estado_movi_update_autofills__RAND__();
					}
				});
			}

		<?php } else { ?>

			$j.ajax({
				url: 'ajax_combo.php',
				dataType: 'json',
				data: { id: AppGini.current_estado_movi__RAND__.value, t: 'movimientos', f: 'estado_movi' },
				success: function(resp) {
					$j('[id=estado_movi-container__RAND__], [id=estado_movi-container-readonly__RAND__]').html('<span id="estado_movi-match-text">' + resp.results[0].text + '</span>');
					if(resp.results[0].id == '<?php echo empty_lookup_value; ?>') { $j('.btn[id=tipo_estado_movi_view_parent]').hide(); } else { $j('.btn[id=tipo_estado_movi_view_parent]').show(); }

					if(typeof(estado_movi_update_autofills__RAND__) == 'function') estado_movi_update_autofills__RAND__();
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
		$template_file = is_file("./{$TemplateDVP}") ? "./{$TemplateDVP}" : './templates/movimientos_templateDVP.html';
		$templateCode = @file_get_contents($template_file);
	} else {
		$template_file = is_file("./{$TemplateDV}") ? "./{$TemplateDV}" : './templates/movimientos_templateDV.html';
		$templateCode = @file_get_contents($template_file);
	}

	// process form title
	$templateCode = str_replace('<%%DETAIL_VIEW_TITLE%%>', 'Movimientos Detalles', $templateCode);
	$templateCode = str_replace('<%%RND1%%>', $rnd1, $templateCode);
	$templateCode = str_replace('<%%EMBEDDED%%>', ($_REQUEST['Embedded'] ? 'Embedded=1' : ''), $templateCode);
	// process buttons
	if($AllowInsert) {
		if(!$selected_id) $templateCode = str_replace('<%%INSERT_BUTTON%%>', '<button type="submit" class="btn btn-success" id="insert" name="insert_x" value="1" onclick="return movimientos_validateData();"><i class="glyphicon glyphicon-plus-sign"></i> ' . $Translation['Save New'] . '</button>', $templateCode);
		$templateCode = str_replace('<%%INSERT_BUTTON%%>', '<button type="submit" class="btn btn-default" id="insert" name="insert_x" value="1" onclick="return movimientos_validateData();"><i class="glyphicon glyphicon-plus-sign"></i> ' . $Translation['Save As Copy'] . '</button>', $templateCode);
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
			$templateCode = str_replace('<%%UPDATE_BUTTON%%>', '<button type="submit" class="btn btn-success btn-lg" id="update" name="update_x" value="1" onclick="return movimientos_validateData();" title="' . html_attr($Translation['Save Changes']) . '"><i class="glyphicon glyphicon-ok"></i> ' . $Translation['Save Changes'] . '</button>', $templateCode);
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
		$jsReadOnly .= "\tjQuery('#codigo_dispo').prop('disabled', true).css({ color: '#555', backgroundColor: '#fff' });\n";
		$jsReadOnly .= "\tjQuery('#codigo_dispo_caption').prop('disabled', true).css({ color: '#555', backgroundColor: 'white' });\n";
		$jsReadOnly .= "\tjQuery('.select2-container').hide();\n";

		$noUploads = true;
	} elseif($AllowInsert) {
		$jsEditable = "\tjQuery('form').eq(0).data('already_changed', true);"; // temporarily disable form change handler
		$jsEditable .= "\tjQuery('form').eq(0).data('already_changed', false);"; // re-enable form change handler
	}

	// process combos
	$templateCode = str_replace('<%%COMBO(codigo_dispo)%%>', $combo_codigo_dispo->HTML, $templateCode);
	$templateCode = str_replace('<%%COMBOTEXT(codigo_dispo)%%>', $combo_codigo_dispo->MatchText, $templateCode);
	$templateCode = str_replace('<%%URLCOMBOTEXT(codigo_dispo)%%>', urlencode($combo_codigo_dispo->MatchText), $templateCode);
	$templateCode = str_replace('<%%COMBO(estado_movi)%%>', $combo_estado_movi->HTML, $templateCode);
	$templateCode = str_replace('<%%COMBOTEXT(estado_movi)%%>', $combo_estado_movi->MatchText, $templateCode);
	$templateCode = str_replace('<%%URLCOMBOTEXT(estado_movi)%%>', urlencode($combo_estado_movi->MatchText), $templateCode);

	/* lookup fields array: 'lookup field name' => array('parent table name', 'lookup field caption') */
	$lookup_fields = array('codigo_dispo' => array('dispositivos', 'Codigo'), 'estado_movi' => array('tipo_estado_movi', 'Estado'), );
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
	$templateCode = str_replace('<%%UPLOADFILE(id_movi)%%>', '', $templateCode);
	$templateCode = str_replace('<%%UPLOADFILE(img)%%>', '', $templateCode);
	$templateCode = str_replace('<%%UPLOADFILE(codigo_dispo)%%>', '', $templateCode);
	$templateCode = str_replace('<%%UPLOADFILE(estado_movi)%%>', '', $templateCode);
	$templateCode = str_replace('<%%UPLOADFILE(origen)%%>', '', $templateCode);
	$templateCode = str_replace('<%%UPLOADFILE(destino)%%>', '', $templateCode);
	$templateCode = str_replace('<%%UPLOADFILE(creado)%%>', '', $templateCode);
	$templateCode = str_replace('<%%UPLOADFILE(creado_por)%%>', '', $templateCode);
	$templateCode = str_replace('<%%UPLOADFILE(editado)%%>', '', $templateCode);
	$templateCode = str_replace('<%%UPLOADFILE(editado_por)%%>', '', $templateCode);

	// process values
	if($selected_id) {
		if( $dvprint) $templateCode = str_replace('<%%VALUE(id_movi)%%>', safe_html($urow['id_movi']), $templateCode);
		if(!$dvprint) $templateCode = str_replace('<%%VALUE(id_movi)%%>', html_attr($row['id_movi']), $templateCode);
		$templateCode = str_replace('<%%URLVALUE(id_movi)%%>', urlencode($urow['id_movi']), $templateCode);
		$templateCode = str_replace('<%%VALUE(img)%%>', safe_html($urow['img']), $templateCode);
		$templateCode = str_replace('<%%URLVALUE(img)%%>', urlencode($urow['img']), $templateCode);
		if( $dvprint) $templateCode = str_replace('<%%VALUE(codigo_dispo)%%>', safe_html($urow['codigo_dispo']), $templateCode);
		if(!$dvprint) $templateCode = str_replace('<%%VALUE(codigo_dispo)%%>', html_attr($row['codigo_dispo']), $templateCode);
		$templateCode = str_replace('<%%URLVALUE(codigo_dispo)%%>', urlencode($urow['codigo_dispo']), $templateCode);
		$templateCode = str_replace('<%%VALUE(estado_movi)%%>', safe_html($urow['estado_movi']), $templateCode);
		$templateCode = str_replace('<%%URLVALUE(estado_movi)%%>', urlencode($urow['estado_movi']), $templateCode);
		$templateCode = str_replace('<%%VALUE(origen)%%>', safe_html($urow['origen']), $templateCode);
		$templateCode = str_replace('<%%URLVALUE(origen)%%>', urlencode($urow['origen']), $templateCode);
		$templateCode = str_replace('<%%VALUE(destino)%%>', safe_html($urow['destino']), $templateCode);
		$templateCode = str_replace('<%%URLVALUE(destino)%%>', urlencode($urow['destino']), $templateCode);
		$templateCode = str_replace('<%%VALUE(creado)%%>', app_datetime($row['creado'], 'dt'), $templateCode);
		$templateCode = str_replace('<%%URLVALUE(creado)%%>', urlencode(app_datetime($urow['creado'], 'dt')), $templateCode);
		$templateCode = str_replace('<%%VALUE(creado_por)%%>', safe_html($urow['creado_por']), $templateCode);
		$templateCode = str_replace('<%%URLVALUE(creado_por)%%>', urlencode($urow['creado_por']), $templateCode);
		$templateCode = str_replace('<%%VALUE(editado)%%>', app_datetime($row['editado'], 'dt'), $templateCode);
		$templateCode = str_replace('<%%URLVALUE(editado)%%>', urlencode(app_datetime($urow['editado'], 'dt')), $templateCode);
		$templateCode = str_replace('<%%VALUE(editado_por)%%>', safe_html($urow['editado_por']), $templateCode);
		$templateCode = str_replace('<%%URLVALUE(editado_por)%%>', urlencode($urow['editado_por']), $templateCode);
	} else {
		$templateCode = str_replace('<%%VALUE(id_movi)%%>', '', $templateCode);
		$templateCode = str_replace('<%%URLVALUE(id_movi)%%>', urlencode(''), $templateCode);
		$templateCode = str_replace('<%%VALUE(img)%%>', '', $templateCode);
		$templateCode = str_replace('<%%URLVALUE(img)%%>', urlencode(''), $templateCode);
		$templateCode = str_replace('<%%VALUE(codigo_dispo)%%>', '', $templateCode);
		$templateCode = str_replace('<%%URLVALUE(codigo_dispo)%%>', urlencode(''), $templateCode);
		$templateCode = str_replace('<%%VALUE(estado_movi)%%>', '', $templateCode);
		$templateCode = str_replace('<%%URLVALUE(estado_movi)%%>', urlencode(''), $templateCode);
		$templateCode = str_replace('<%%VALUE(origen)%%>', '', $templateCode);
		$templateCode = str_replace('<%%URLVALUE(origen)%%>', urlencode(''), $templateCode);
		$templateCode = str_replace('<%%VALUE(destino)%%>', '', $templateCode);
		$templateCode = str_replace('<%%URLVALUE(destino)%%>', urlencode(''), $templateCode);
		$templateCode = str_replace('<%%VALUE(creado)%%>', '<%%creationDateTime%%>', $templateCode);
		$templateCode = str_replace('<%%URLVALUE(creado)%%>', urlencode('<%%creationDateTime%%>'), $templateCode);
		$templateCode = str_replace('<%%VALUE(creado_por)%%>', '<%%creatorUsername%%>', $templateCode);
		$templateCode = str_replace('<%%URLVALUE(creado_por)%%>', urlencode('<%%creatorUsername%%>'), $templateCode);
		$templateCode = str_replace('<%%VALUE(editado)%%>', '<%%editingDateTime%%>', $templateCode);
		$templateCode = str_replace('<%%URLVALUE(editado)%%>', urlencode('<%%editingDateTime%%>'), $templateCode);
		$templateCode = str_replace('<%%VALUE(editado_por)%%>', '<%%editorUsername%%>', $templateCode);
		$templateCode = str_replace('<%%URLVALUE(editado_por)%%>', urlencode('<%%editorUsername%%>'), $templateCode);
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

	$templateCode .= "\tcodigo_dispo_update_autofills$rnd1 = function() {\n";
	$templateCode .= "\t\t\$j.ajax({\n";
	if($dvprint) {
		$templateCode .= "\t\t\turl: 'movimientos_autofill.php?rnd1=$rnd1&mfk=codigo_dispo&id=' + encodeURIComponent('".addslashes($row['codigo_dispo'])."'),\n";
		$templateCode .= "\t\t\tcontentType: 'application/x-www-form-urlencoded; charset=" . datalist_db_encoding . "',\n";
		$templateCode .= "\t\t\ttype: 'GET'\n";
	} else {
		$templateCode .= "\t\t\turl: 'movimientos_autofill.php?rnd1=$rnd1&mfk=codigo_dispo&id=' + encodeURIComponent(AppGini.current_codigo_dispo{$rnd1}.value),\n";
		$templateCode .= "\t\t\tcontentType: 'application/x-www-form-urlencoded; charset=" . datalist_db_encoding . "',\n";
		$templateCode .= "\t\t\ttype: 'GET',\n";
		$templateCode .= "\t\t\tbeforeSend: function() { \$j('#codigo_dispo$rnd1').prop('disabled', true); \$j('#codigo_dispoLoading').html('<img src=loading.gif align=top>'); },\n";
		$templateCode .= "\t\t\tcomplete: function() { " . (($arrPerm[1] || (($arrPerm[3] == 1 && $ownerMemberID == getLoggedMemberID()) || ($arrPerm[3] == 2 && $ownerGroupID == getLoggedGroupID()) || $arrPerm[3] == 3)) ? "\$j('#codigo_dispo$rnd1').prop('disabled', false); " : "\$j('#codigo_dispo$rnd1').prop('disabled', true); ")."\$j('#codigo_dispoLoading').html(''); \$j(window).resize(); }\n";
	}
	$templateCode .= "\t\t});\n";
	$templateCode .= "\t};\n";
	if(!$dvprint) $templateCode .= "\tif(\$j('#codigo_dispo_caption').length) \$j('#codigo_dispo_caption').click(function() { codigo_dispo_update_autofills$rnd1(); });\n";


	$templateCode.="});";
	$templateCode.="</script>";
	$templateCode .= $lookups;

	// handle enforced parent values for read-only lookup fields
	if( $_REQUEST['FilterField'][1]=='6' && $_REQUEST['FilterOperator'][1]=='<=>') {
		$templateCode.="\n<input type=hidden name=estado_movi value=\"" . html_attr($_REQUEST['FilterValue'][1]) . "\">\n";
	}

	// don't include blank images in lightbox gallery
	$templateCode = preg_replace('/blank.gif" data-lightbox=".*?"/', 'blank.gif"', $templateCode);

	// don't display empty email links
	$templateCode=preg_replace('/<a .*?href="mailto:".*?<\/a>/', '', $templateCode);

	/* default field values */
	$rdata = $jdata = get_defaults('movimientos');
	if($selected_id) {
		$jdata = get_joined_record('movimientos', $selected_id);
		if($jdata === false) $jdata = get_defaults('movimientos');
		$rdata = $row;
	}
	$templateCode .= loadView('movimientos-ajax-cache', array('rdata' => $rdata, 'jdata' => $jdata));

	// hook: movimientos_dv
	if(function_exists('movimientos_dv')) {
		$args=[];
		movimientos_dv(($selected_id ? $selected_id : FALSE), getMemberInfo(), $templateCode, $args);
	}

	return $templateCode;
}