<?php

// Data functions (insert, update, delete, form) for table accesorios

// This script and data application were generated by AppGini 5.97
// Download AppGini for free from https://bigprof.com/appgini/download/

function accesorios_insert(&$error_message = '') {
	global $Translation;

	// mm: can member insert record?
	$arrPerm = getTablePermissions('accesorios');
	if(!$arrPerm['insert']) return false;

	$data = [
		'tipo_accesorio' => Request::lookup('tipo_accesorio', ''),
		'nombre_accesorio' => Request::val('nombre_accesorio', ''),
		'descripcion' => br2nl(Request::val('descripcion', '')),
		'id_dispo' => Request::lookup('id_dispo', ''),
		'creado' => parseCode('<%%creationDateTime%%>', true, true),
		'creado_por' => parseCode('<%%creatorUsername%%>', true),
	];

	if($data['nombre_accesorio'] === '') {
		echo StyleSheet() . "\n\n<div class=\"alert alert-danger\">{$Translation['error:']} 'Nombre del accesorio': {$Translation['field not null']}<br><br>";
		echo '<a href="" onclick="history.go(-1); return false;">' . $Translation['< back'] . '</a></div>';
		exit;
	}

	// hook: accesorios_before_insert
	if(function_exists('accesorios_before_insert')) {
		$args = [];
		if(!accesorios_before_insert($data, getMemberInfo(), $args)) {
			if(isset($args['error_message'])) $error_message = $args['error_message'];
			return false;
		}
	}

	$error = '';
	// set empty fields to NULL
	$data = array_map(function($v) { return ($v === '' ? NULL : $v); }, $data);
	insert('accesorios', backtick_keys_once($data), $error);
	if($error)
		die("{$error}<br><a href=\"#\" onclick=\"history.go(-1);\">{$Translation['< back']}</a>");

	$recID = db_insert_id(db_link());

	update_calc_fields('accesorios', $recID, calculated_fields()['accesorios']);

	// hook: accesorios_after_insert
	if(function_exists('accesorios_after_insert')) {
		$res = sql("SELECT * FROM `accesorios` WHERE `id`='" . makeSafe($recID, false) . "' LIMIT 1", $eo);
		if($row = db_fetch_assoc($res)) {
			$data = array_map('makeSafe', $row);
		}
		$data['selectedID'] = makeSafe($recID, false);
		$args=[];
		if(!accesorios_after_insert($data, getMemberInfo(), $args)) { return $recID; }
	}

	// mm: save ownership data
	set_record_owner('accesorios', $recID, getLoggedMemberID());

	// if this record is a copy of another record, copy children if applicable
	if(!empty($_REQUEST['SelectedID'])) accesorios_copy_children($recID, $_REQUEST['SelectedID']);

	return $recID;
}

function accesorios_copy_children($destination_id, $source_id) {
	global $Translation;
	$requests = []; // array of curl handlers for launching insert requests
	$eo = ['silentErrors' => true];
	$safe_sid = makeSafe($source_id);

	// launch requests, asynchronously
	curl_batch($requests);
}

function accesorios_delete($selected_id, $AllowDeleteOfParents = false, $skipChecks = false) {
	// insure referential integrity ...
	global $Translation;
	$selected_id = makeSafe($selected_id);

	// mm: can member delete record?
	if(!check_record_permission('accesorios', $selected_id, 'delete')) {
		return $Translation['You don\'t have enough permissions to delete this record'];
	}

	// hook: accesorios_before_delete
	if(function_exists('accesorios_before_delete')) {
		$args = [];
		if(!accesorios_before_delete($selected_id, $skipChecks, getMemberInfo(), $args))
			return $Translation['Couldn\'t delete this record'] . (
				!empty($args['error_message']) ?
					'<div class="text-bold">' . strip_tags($args['error_message']) . '</div>'
					: '' 
			);
	}

	sql("DELETE FROM `accesorios` WHERE `id`='{$selected_id}'", $eo);

	// hook: accesorios_after_delete
	if(function_exists('accesorios_after_delete')) {
		$args = [];
		accesorios_after_delete($selected_id, getMemberInfo(), $args);
	}

	// mm: delete ownership data
	sql("DELETE FROM `membership_userrecords` WHERE `tableName`='accesorios' AND `pkValue`='{$selected_id}'", $eo);
}

function accesorios_update(&$selected_id, &$error_message = '') {
	global $Translation;

	// mm: can member edit record?
	if(!check_record_permission('accesorios', $selected_id, 'edit')) return false;

	$data = [
		'tipo_accesorio' => Request::lookup('tipo_accesorio', ''),
		'nombre_accesorio' => Request::val('nombre_accesorio', ''),
		'descripcion' => br2nl(Request::val('descripcion', '')),
		'id_dispo' => Request::lookup('id_dispo', ''),
	];

	if($data['nombre_accesorio'] === '') {
		echo StyleSheet() . "\n\n<div class=\"alert alert-danger\">{$Translation['error:']} 'Nombre del accesorio': {$Translation['field not null']}<br><br>";
		echo '<a href="" onclick="history.go(-1); return false;">' . $Translation['< back'] . '</a></div>';
		exit;
	}
	// get existing values
	$old_data = getRecord('accesorios', $selected_id);
	if(is_array($old_data)) {
		$old_data = array_map('makeSafe', $old_data);
		$old_data['selectedID'] = makeSafe($selected_id);
	}

	$data['selectedID'] = makeSafe($selected_id);

	// hook: accesorios_before_update
	if(function_exists('accesorios_before_update')) {
		$args = ['old_data' => $old_data];
		if(!accesorios_before_update($data, getMemberInfo(), $args)) {
			if(isset($args['error_message'])) $error_message = $args['error_message'];
			return false;
		}
	}

	$set = $data; unset($set['selectedID']);
	foreach ($set as $field => $value) {
		$set[$field] = ($value !== '' && $value !== NULL) ? $value : NULL;
	}

	if(!update(
		'accesorios', 
		backtick_keys_once($set), 
		['`id`' => $selected_id], 
		$error_message
	)) {
		echo $error_message;
		echo '<a href="accesorios_view.php?SelectedID=' . urlencode($selected_id) . "\">{$Translation['< back']}</a>";
		exit;
	}


	$eo = ['silentErrors' => true];

	update_calc_fields('accesorios', $data['selectedID'], calculated_fields()['accesorios']);

	// hook: accesorios_after_update
	if(function_exists('accesorios_after_update')) {
		$res = sql("SELECT * FROM `accesorios` WHERE `id`='{$data['selectedID']}' LIMIT 1", $eo);
		if($row = db_fetch_assoc($res)) $data = array_map('makeSafe', $row);

		$data['selectedID'] = $data['id'];
		$args = ['old_data' => $old_data];
		if(!accesorios_after_update($data, getMemberInfo(), $args)) return;
	}

	// mm: update ownership data
	sql("UPDATE `membership_userrecords` SET `dateUpdated`='" . time() . "' WHERE `tableName`='accesorios' AND `pkValue`='" . makeSafe($selected_id) . "'", $eo);
}

function accesorios_form($selected_id = '', $AllowUpdate = 1, $AllowInsert = 1, $AllowDelete = 1, $ShowCancel = 0, $TemplateDV = '', $TemplateDVP = '') {
	// function to return an editable form for a table records
	// and fill it with data of record whose ID is $selected_id. If $selected_id
	// is empty, an empty form is shown, with only an 'Add New'
	// button displayed.

	global $Translation;

	// mm: get table permissions
	$arrPerm = getTablePermissions('accesorios');
	if(!$arrPerm['insert'] && $selected_id=='') return $Translation['tableAccessDenied'];
	$AllowInsert = ($arrPerm['insert'] ? true : false);
	// print preview?
	$dvprint = false;
	if($selected_id && $_REQUEST['dvprint_x'] != '') {
		$dvprint = true;
	}

	$filterer_tipo_accesorio = thisOr($_REQUEST['filterer_tipo_accesorio'], '');
	$filterer_id_dispo = thisOr($_REQUEST['filterer_id_dispo'], '');

	// populate filterers, starting from children to grand-parents

	// unique random identifier
	$rnd1 = ($dvprint ? rand(1000000, 9999999) : '');
	// combobox: tipo_accesorio
	$combo_tipo_accesorio = new DataCombo;
	// combobox: id_dispo
	$combo_id_dispo = new DataCombo;

	if($selected_id) {
		// mm: check member permissions
		if(!$arrPerm['view']) return $Translation['tableAccessDenied'];

		// mm: who is the owner?
		$ownerGroupID = sqlValue("SELECT `groupID` FROM `membership_userrecords` WHERE `tableName`='accesorios' AND `pkValue`='" . makeSafe($selected_id) . "'");
		$ownerMemberID = sqlValue("SELECT LCASE(`memberID`) FROM `membership_userrecords` WHERE `tableName`='accesorios' AND `pkValue`='" . makeSafe($selected_id) . "'");

		if($arrPerm['view'] == 1 && getLoggedMemberID() != $ownerMemberID) return $Translation['tableAccessDenied'];
		if($arrPerm['view'] == 2 && getLoggedGroupID() != $ownerGroupID) return $Translation['tableAccessDenied'];

		// can edit?
		$AllowUpdate = 0;
		if(($arrPerm['edit'] == 1 && $ownerMemberID == getLoggedMemberID()) || ($arrPerm['edit'] == 2 && $ownerGroupID == getLoggedGroupID()) || $arrPerm['edit'] == 3) {
			$AllowUpdate = 1;
		}

		$res = sql("SELECT * FROM `accesorios` WHERE `id`='" . makeSafe($selected_id) . "'", $eo);
		if(!($row = db_fetch_array($res))) {
			return error_message($Translation['No records found'], 'accesorios_view.php', false);
		}
		$combo_tipo_accesorio->SelectedData = $row['tipo_accesorio'];
		$combo_id_dispo->SelectedData = $row['id_dispo'];
		$urow = $row; /* unsanitized data */
		$row = array_map('safe_html', $row);
	} else {
		$combo_tipo_accesorio->SelectedData = $filterer_tipo_accesorio;
		$combo_id_dispo->SelectedData = $filterer_id_dispo;
	}
	$combo_tipo_accesorio->HTML = '<span id="tipo_accesorio-container' . $rnd1 . '"></span><input type="hidden" name="tipo_accesorio" id="tipo_accesorio' . $rnd1 . '" value="' . html_attr($combo_tipo_accesorio->SelectedData) . '">';
	$combo_tipo_accesorio->MatchText = '<span id="tipo_accesorio-container-readonly' . $rnd1 . '"></span><input type="hidden" name="tipo_accesorio" id="tipo_accesorio' . $rnd1 . '" value="' . html_attr($combo_tipo_accesorio->SelectedData) . '">';
	$combo_id_dispo->HTML = '<span id="id_dispo-container' . $rnd1 . '"></span><input type="hidden" name="id_dispo" id="id_dispo' . $rnd1 . '" value="' . html_attr($combo_id_dispo->SelectedData) . '">';
	$combo_id_dispo->MatchText = '<span id="id_dispo-container-readonly' . $rnd1 . '"></span><input type="hidden" name="id_dispo" id="id_dispo' . $rnd1 . '" value="' . html_attr($combo_id_dispo->SelectedData) . '">';

	ob_start();
	?>

	<script>
		// initial lookup values
		AppGini.current_tipo_accesorio__RAND__ = { text: "", value: "<?php echo addslashes($selected_id ? $urow['tipo_accesorio'] : htmlspecialchars($filterer_tipo_accesorio, ENT_QUOTES)); ?>"};
		AppGini.current_id_dispo__RAND__ = { text: "", value: "<?php echo addslashes($selected_id ? $urow['id_dispo'] : htmlspecialchars($filterer_id_dispo, ENT_QUOTES)); ?>"};

		jQuery(function() {
			setTimeout(function() {
				if(typeof(tipo_accesorio_reload__RAND__) == 'function') tipo_accesorio_reload__RAND__();
				if(typeof(id_dispo_reload__RAND__) == 'function') id_dispo_reload__RAND__();
			}, 50); /* we need to slightly delay client-side execution of the above code to allow AppGini.ajaxCache to work */
		});
		function tipo_accesorio_reload__RAND__() {
		<?php if(($AllowUpdate || $AllowInsert) && !$dvprint) { ?>

			$j("#tipo_accesorio-container__RAND__").select2({
				/* initial default value */
				initSelection: function(e, c) {
					$j.ajax({
						url: 'ajax_combo.php',
						dataType: 'json',
						data: { id: AppGini.current_tipo_accesorio__RAND__.value, t: 'accesorios', f: 'tipo_accesorio' },
						success: function(resp) {
							c({
								id: resp.results[0].id,
								text: resp.results[0].text
							});
							$j('[name="tipo_accesorio"]').val(resp.results[0].id);
							$j('[id=tipo_accesorio-container-readonly__RAND__]').html('<span id="tipo_accesorio-match-text">' + resp.results[0].text + '</span>');
							if(resp.results[0].id == '<?php echo empty_lookup_value; ?>') { $j('.btn[id=tipo_accesorio_view_parent]').hide(); } else { $j('.btn[id=tipo_accesorio_view_parent]').show(); }


							if(typeof(tipo_accesorio_update_autofills__RAND__) == 'function') tipo_accesorio_update_autofills__RAND__();
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
					data: function(term, page) { return { s: term, p: page, t: 'accesorios', f: 'tipo_accesorio' }; },
					results: function(resp, page) { return resp; }
				},
				escapeMarkup: function(str) { return str; }
			}).on('change', function(e) {
				AppGini.current_tipo_accesorio__RAND__.value = e.added.id;
				AppGini.current_tipo_accesorio__RAND__.text = e.added.text;
				$j('[name="tipo_accesorio"]').val(e.added.id);
				if(e.added.id == '<?php echo empty_lookup_value; ?>') { $j('.btn[id=tipo_accesorio_view_parent]').hide(); } else { $j('.btn[id=tipo_accesorio_view_parent]').show(); }


				if(typeof(tipo_accesorio_update_autofills__RAND__) == 'function') tipo_accesorio_update_autofills__RAND__();
			});

			if(!$j("#tipo_accesorio-container__RAND__").length) {
				$j.ajax({
					url: 'ajax_combo.php',
					dataType: 'json',
					data: { id: AppGini.current_tipo_accesorio__RAND__.value, t: 'accesorios', f: 'tipo_accesorio' },
					success: function(resp) {
						$j('[name="tipo_accesorio"]').val(resp.results[0].id);
						$j('[id=tipo_accesorio-container-readonly__RAND__]').html('<span id="tipo_accesorio-match-text">' + resp.results[0].text + '</span>');
						if(resp.results[0].id == '<?php echo empty_lookup_value; ?>') { $j('.btn[id=tipo_accesorio_view_parent]').hide(); } else { $j('.btn[id=tipo_accesorio_view_parent]').show(); }

						if(typeof(tipo_accesorio_update_autofills__RAND__) == 'function') tipo_accesorio_update_autofills__RAND__();
					}
				});
			}

		<?php } else { ?>

			$j.ajax({
				url: 'ajax_combo.php',
				dataType: 'json',
				data: { id: AppGini.current_tipo_accesorio__RAND__.value, t: 'accesorios', f: 'tipo_accesorio' },
				success: function(resp) {
					$j('[id=tipo_accesorio-container__RAND__], [id=tipo_accesorio-container-readonly__RAND__]').html('<span id="tipo_accesorio-match-text">' + resp.results[0].text + '</span>');
					if(resp.results[0].id == '<?php echo empty_lookup_value; ?>') { $j('.btn[id=tipo_accesorio_view_parent]').hide(); } else { $j('.btn[id=tipo_accesorio_view_parent]').show(); }

					if(typeof(tipo_accesorio_update_autofills__RAND__) == 'function') tipo_accesorio_update_autofills__RAND__();
				}
			});
		<?php } ?>

		}
		function id_dispo_reload__RAND__() {
		<?php if(($AllowUpdate || $AllowInsert) && !$dvprint) { ?>

			$j("#id_dispo-container__RAND__").select2({
				/* initial default value */
				initSelection: function(e, c) {
					$j.ajax({
						url: 'ajax_combo.php',
						dataType: 'json',
						data: { id: AppGini.current_id_dispo__RAND__.value, t: 'accesorios', f: 'id_dispo' },
						success: function(resp) {
							c({
								id: resp.results[0].id,
								text: resp.results[0].text
							});
							$j('[name="id_dispo"]').val(resp.results[0].id);
							$j('[id=id_dispo-container-readonly__RAND__]').html('<span id="id_dispo-match-text">' + resp.results[0].text + '</span>');
							if(resp.results[0].id == '<?php echo empty_lookup_value; ?>') { $j('.btn[id=dispositivos_view_parent]').hide(); } else { $j('.btn[id=dispositivos_view_parent]').show(); }


							if(typeof(id_dispo_update_autofills__RAND__) == 'function') id_dispo_update_autofills__RAND__();
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
					data: function(term, page) { return { s: term, p: page, t: 'accesorios', f: 'id_dispo' }; },
					results: function(resp, page) { return resp; }
				},
				escapeMarkup: function(str) { return str; }
			}).on('change', function(e) {
				AppGini.current_id_dispo__RAND__.value = e.added.id;
				AppGini.current_id_dispo__RAND__.text = e.added.text;
				$j('[name="id_dispo"]').val(e.added.id);
				if(e.added.id == '<?php echo empty_lookup_value; ?>') { $j('.btn[id=dispositivos_view_parent]').hide(); } else { $j('.btn[id=dispositivos_view_parent]').show(); }


				if(typeof(id_dispo_update_autofills__RAND__) == 'function') id_dispo_update_autofills__RAND__();
			});

			if(!$j("#id_dispo-container__RAND__").length) {
				$j.ajax({
					url: 'ajax_combo.php',
					dataType: 'json',
					data: { id: AppGini.current_id_dispo__RAND__.value, t: 'accesorios', f: 'id_dispo' },
					success: function(resp) {
						$j('[name="id_dispo"]').val(resp.results[0].id);
						$j('[id=id_dispo-container-readonly__RAND__]').html('<span id="id_dispo-match-text">' + resp.results[0].text + '</span>');
						if(resp.results[0].id == '<?php echo empty_lookup_value; ?>') { $j('.btn[id=dispositivos_view_parent]').hide(); } else { $j('.btn[id=dispositivos_view_parent]').show(); }

						if(typeof(id_dispo_update_autofills__RAND__) == 'function') id_dispo_update_autofills__RAND__();
					}
				});
			}

		<?php } else { ?>

			$j.ajax({
				url: 'ajax_combo.php',
				dataType: 'json',
				data: { id: AppGini.current_id_dispo__RAND__.value, t: 'accesorios', f: 'id_dispo' },
				success: function(resp) {
					$j('[id=id_dispo-container__RAND__], [id=id_dispo-container-readonly__RAND__]').html('<span id="id_dispo-match-text">' + resp.results[0].text + '</span>');
					if(resp.results[0].id == '<?php echo empty_lookup_value; ?>') { $j('.btn[id=dispositivos_view_parent]').hide(); } else { $j('.btn[id=dispositivos_view_parent]').show(); }

					if(typeof(id_dispo_update_autofills__RAND__) == 'function') id_dispo_update_autofills__RAND__();
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
		$template_file = is_file("./{$TemplateDVP}") ? "./{$TemplateDVP}" : './templates/accesorios_templateDVP.html';
		$templateCode = @file_get_contents($template_file);
	} else {
		$template_file = is_file("./{$TemplateDV}") ? "./{$TemplateDV}" : './templates/accesorios_templateDV.html';
		$templateCode = @file_get_contents($template_file);
	}

	// process form title
	$templateCode = str_replace('<%%DETAIL_VIEW_TITLE%%>', 'Accesorios Detalles', $templateCode);
	$templateCode = str_replace('<%%RND1%%>', $rnd1, $templateCode);
	$templateCode = str_replace('<%%EMBEDDED%%>', ($_REQUEST['Embedded'] ? 'Embedded=1' : ''), $templateCode);
	// process buttons
	if($AllowInsert) {
		if(!$selected_id) $templateCode = str_replace('<%%INSERT_BUTTON%%>', '<button type="submit" class="btn btn-success" id="insert" name="insert_x" value="1" onclick="return accesorios_validateData();"><i class="glyphicon glyphicon-plus-sign"></i> ' . $Translation['Save New'] . '</button>', $templateCode);
		$templateCode = str_replace('<%%INSERT_BUTTON%%>', '<button type="submit" class="btn btn-default" id="insert" name="insert_x" value="1" onclick="return accesorios_validateData();"><i class="glyphicon glyphicon-plus-sign"></i> ' . $Translation['Save As Copy'] . '</button>', $templateCode);
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
			$templateCode = str_replace('<%%UPDATE_BUTTON%%>', '<button type="submit" class="btn btn-success btn-lg" id="update" name="update_x" value="1" onclick="return accesorios_validateData();" title="' . html_attr($Translation['Save Changes']) . '"><i class="glyphicon glyphicon-ok"></i> ' . $Translation['Save Changes'] . '</button>', $templateCode);
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
		$jsReadOnly .= "\tjQuery('#tipo_accesorio').prop('disabled', true).css({ color: '#555', backgroundColor: '#fff' });\n";
		$jsReadOnly .= "\tjQuery('#tipo_accesorio_caption').prop('disabled', true).css({ color: '#555', backgroundColor: 'white' });\n";
		$jsReadOnly .= "\tjQuery('#nombre_accesorio').replaceWith('<div class=\"form-control-static\" id=\"nombre_accesorio\">' + (jQuery('#nombre_accesorio').val() || '') + '</div>');\n";
		$jsReadOnly .= "\tjQuery('#descripcion').replaceWith('<div class=\"form-control-static\" id=\"descripcion\">' + (jQuery('#descripcion').val() || '') + '</div>');\n";
		$jsReadOnly .= "\tjQuery('#id_dispo').prop('disabled', true).css({ color: '#555', backgroundColor: '#fff' });\n";
		$jsReadOnly .= "\tjQuery('#id_dispo_caption').prop('disabled', true).css({ color: '#555', backgroundColor: 'white' });\n";
		$jsReadOnly .= "\tjQuery('.select2-container').hide();\n";

		$noUploads = true;
	} elseif($AllowInsert) {
		$jsEditable = "\tjQuery('form').eq(0).data('already_changed', true);"; // temporarily disable form change handler
		$jsEditable .= "\tjQuery('form').eq(0).data('already_changed', false);"; // re-enable form change handler
	}

	// process combos
	$templateCode = str_replace('<%%COMBO(tipo_accesorio)%%>', $combo_tipo_accesorio->HTML, $templateCode);
	$templateCode = str_replace('<%%COMBOTEXT(tipo_accesorio)%%>', $combo_tipo_accesorio->MatchText, $templateCode);
	$templateCode = str_replace('<%%URLCOMBOTEXT(tipo_accesorio)%%>', urlencode($combo_tipo_accesorio->MatchText), $templateCode);
	$templateCode = str_replace('<%%COMBO(id_dispo)%%>', $combo_id_dispo->HTML, $templateCode);
	$templateCode = str_replace('<%%COMBOTEXT(id_dispo)%%>', $combo_id_dispo->MatchText, $templateCode);
	$templateCode = str_replace('<%%URLCOMBOTEXT(id_dispo)%%>', urlencode($combo_id_dispo->MatchText), $templateCode);

	/* lookup fields array: 'lookup field name' => array('parent table name', 'lookup field caption') */
	$lookup_fields = array('tipo_accesorio' => array('tipo_accesorio', 'Dispositivo'), 'id_dispo' => array('dispositivos', 'Id dispo'), );
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
	$templateCode = str_replace('<%%UPLOADFILE(codigo_accesorio)%%>', '', $templateCode);
	$templateCode = str_replace('<%%UPLOADFILE(tipo_accesorio)%%>', '', $templateCode);
	$templateCode = str_replace('<%%UPLOADFILE(nombre_accesorio)%%>', '', $templateCode);
	$templateCode = str_replace('<%%UPLOADFILE(descripcion)%%>', '', $templateCode);
	$templateCode = str_replace('<%%UPLOADFILE(id_dispo)%%>', '', $templateCode);
	$templateCode = str_replace('<%%UPLOADFILE(creado)%%>', '', $templateCode);
	$templateCode = str_replace('<%%UPLOADFILE(creado_por)%%>', '', $templateCode);

	// process values
	if($selected_id) {
		if( $dvprint) $templateCode = str_replace('<%%VALUE(id)%%>', safe_html($urow['id']), $templateCode);
		if(!$dvprint) $templateCode = str_replace('<%%VALUE(id)%%>', html_attr($row['id']), $templateCode);
		$templateCode = str_replace('<%%URLVALUE(id)%%>', urlencode($urow['id']), $templateCode);
		$templateCode = str_replace('<%%VALUE(codigo_accesorio)%%>', safe_html($urow['codigo_accesorio']), $templateCode);
		$templateCode = str_replace('<%%URLVALUE(codigo_accesorio)%%>', urlencode($urow['codigo_accesorio']), $templateCode);
		if( $dvprint) $templateCode = str_replace('<%%VALUE(tipo_accesorio)%%>', safe_html($urow['tipo_accesorio']), $templateCode);
		if(!$dvprint) $templateCode = str_replace('<%%VALUE(tipo_accesorio)%%>', html_attr($row['tipo_accesorio']), $templateCode);
		$templateCode = str_replace('<%%URLVALUE(tipo_accesorio)%%>', urlencode($urow['tipo_accesorio']), $templateCode);
		if( $dvprint) $templateCode = str_replace('<%%VALUE(nombre_accesorio)%%>', safe_html($urow['nombre_accesorio']), $templateCode);
		if(!$dvprint) $templateCode = str_replace('<%%VALUE(nombre_accesorio)%%>', html_attr($row['nombre_accesorio']), $templateCode);
		$templateCode = str_replace('<%%URLVALUE(nombre_accesorio)%%>', urlencode($urow['nombre_accesorio']), $templateCode);
		if($dvprint || (!$AllowUpdate && !$AllowInsert)) {
			$templateCode = str_replace('<%%VALUE(descripcion)%%>', safe_html($urow['descripcion']), $templateCode);
		} else {
			$templateCode = str_replace('<%%VALUE(descripcion)%%>', safe_html($urow['descripcion'], true), $templateCode);
		}
		$templateCode = str_replace('<%%URLVALUE(descripcion)%%>', urlencode($urow['descripcion']), $templateCode);
		if( $dvprint) $templateCode = str_replace('<%%VALUE(id_dispo)%%>', safe_html($urow['id_dispo']), $templateCode);
		if(!$dvprint) $templateCode = str_replace('<%%VALUE(id_dispo)%%>', html_attr($row['id_dispo']), $templateCode);
		$templateCode = str_replace('<%%URLVALUE(id_dispo)%%>', urlencode($urow['id_dispo']), $templateCode);
		$templateCode = str_replace('<%%VALUE(creado)%%>', app_datetime($row['creado'], 'dt'), $templateCode);
		$templateCode = str_replace('<%%URLVALUE(creado)%%>', urlencode(app_datetime($urow['creado'], 'dt')), $templateCode);
		$templateCode = str_replace('<%%VALUE(creado_por)%%>', safe_html($urow['creado_por']), $templateCode);
		$templateCode = str_replace('<%%URLVALUE(creado_por)%%>', urlencode($urow['creado_por']), $templateCode);
	} else {
		$templateCode = str_replace('<%%VALUE(id)%%>', '', $templateCode);
		$templateCode = str_replace('<%%URLVALUE(id)%%>', urlencode(''), $templateCode);
		$templateCode = str_replace('<%%VALUE(codigo_accesorio)%%>', '', $templateCode);
		$templateCode = str_replace('<%%URLVALUE(codigo_accesorio)%%>', urlencode(''), $templateCode);
		$templateCode = str_replace('<%%VALUE(tipo_accesorio)%%>', '', $templateCode);
		$templateCode = str_replace('<%%URLVALUE(tipo_accesorio)%%>', urlencode(''), $templateCode);
		$templateCode = str_replace('<%%VALUE(nombre_accesorio)%%>', '', $templateCode);
		$templateCode = str_replace('<%%URLVALUE(nombre_accesorio)%%>', urlencode(''), $templateCode);
		$templateCode = str_replace('<%%VALUE(descripcion)%%>', '', $templateCode);
		$templateCode = str_replace('<%%URLVALUE(descripcion)%%>', urlencode(''), $templateCode);
		$templateCode = str_replace('<%%VALUE(id_dispo)%%>', '', $templateCode);
		$templateCode = str_replace('<%%URLVALUE(id_dispo)%%>', urlencode(''), $templateCode);
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
	$rdata = $jdata = get_defaults('accesorios');
	if($selected_id) {
		$jdata = get_joined_record('accesorios', $selected_id);
		if($jdata === false) $jdata = get_defaults('accesorios');
		$rdata = $row;
	}
	$templateCode .= loadView('accesorios-ajax-cache', array('rdata' => $rdata, 'jdata' => $jdata));

	// hook: accesorios_dv
	if(function_exists('accesorios_dv')) {
		$args=[];
		accesorios_dv(($selected_id ? $selected_id : FALSE), getMemberInfo(), $templateCode, $args);
	}

	return $templateCode;
}