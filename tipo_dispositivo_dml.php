<?php

// Data functions (insert, update, delete, form) for table tipo_dispositivo

// This script and data application were generated by AppGini 5.97
// Download AppGini for free from https://bigprof.com/appgini/download/

function tipo_dispositivo_insert(&$error_message = '') {
	global $Translation;

	// mm: can member insert record?
	$arrPerm = getTablePermissions('tipo_dispositivo');
	if(!$arrPerm['insert']) return false;

	$data = [
		'tipo_dispositivo' => Request::val('tipo_dispositivo', ''),
		'grupo_dispo' => Request::lookup('grupo_dispo', ''),
		'prefijo' => Request::val('prefijo', ''),
		'descripcion' => br2nl(Request::val('descripcion', '')),
	];

	if($data['tipo_dispositivo'] === '') {
		echo StyleSheet() . "\n\n<div class=\"alert alert-danger\">{$Translation['error:']} 'Tipo de dispositivo': {$Translation['field not null']}<br><br>";
		echo '<a href="" onclick="history.go(-1); return false;">' . $Translation['< back'] . '</a></div>';
		exit;
	}
	if($data['grupo_dispo'] === '') {
		echo StyleSheet() . "\n\n<div class=\"alert alert-danger\">{$Translation['error:']} 'Grupo': {$Translation['field not null']}<br><br>";
		echo '<a href="" onclick="history.go(-1); return false;">' . $Translation['< back'] . '</a></div>';
		exit;
	}
	if($data['prefijo'] === '') {
		echo StyleSheet() . "\n\n<div class=\"alert alert-danger\">{$Translation['error:']} 'Prefijo': {$Translation['field not null']}<br><br>";
		echo '<a href="" onclick="history.go(-1); return false;">' . $Translation['< back'] . '</a></div>';
		exit;
	}

	// hook: tipo_dispositivo_before_insert
	if(function_exists('tipo_dispositivo_before_insert')) {
		$args = [];
		if(!tipo_dispositivo_before_insert($data, getMemberInfo(), $args)) {
			if(isset($args['error_message'])) $error_message = $args['error_message'];
			return false;
		}
	}

	$error = '';
	// set empty fields to NULL
	$data = array_map(function($v) { return ($v === '' ? NULL : $v); }, $data);
	insert('tipo_dispositivo', backtick_keys_once($data), $error);
	if($error)
		die("{$error}<br><a href=\"#\" onclick=\"history.go(-1);\">{$Translation['< back']}</a>");

	$recID = db_insert_id(db_link());

	update_calc_fields('tipo_dispositivo', $recID, calculated_fields()['tipo_dispositivo']);

	// hook: tipo_dispositivo_after_insert
	if(function_exists('tipo_dispositivo_after_insert')) {
		$res = sql("SELECT * FROM `tipo_dispositivo` WHERE `id_tipodispo`='" . makeSafe($recID, false) . "' LIMIT 1", $eo);
		if($row = db_fetch_assoc($res)) {
			$data = array_map('makeSafe', $row);
		}
		$data['selectedID'] = makeSafe($recID, false);
		$args=[];
		if(!tipo_dispositivo_after_insert($data, getMemberInfo(), $args)) { return $recID; }
	}

	// mm: save ownership data
	set_record_owner('tipo_dispositivo', $recID, getLoggedMemberID());

	// if this record is a copy of another record, copy children if applicable
	if(!empty($_REQUEST['SelectedID'])) tipo_dispositivo_copy_children($recID, $_REQUEST['SelectedID']);

	return $recID;
}

function tipo_dispositivo_copy_children($destination_id, $source_id) {
	global $Translation;
	$requests = []; // array of curl handlers for launching insert requests
	$eo = ['silentErrors' => true];
	$safe_sid = makeSafe($source_id);

	// launch requests, asynchronously
	curl_batch($requests);
}

function tipo_dispositivo_delete($selected_id, $AllowDeleteOfParents = false, $skipChecks = false) {
	// insure referential integrity ...
	global $Translation;
	$selected_id = makeSafe($selected_id);

	// mm: can member delete record?
	if(!check_record_permission('tipo_dispositivo', $selected_id, 'delete')) {
		return $Translation['You don\'t have enough permissions to delete this record'];
	}

	// hook: tipo_dispositivo_before_delete
	if(function_exists('tipo_dispositivo_before_delete')) {
		$args = [];
		if(!tipo_dispositivo_before_delete($selected_id, $skipChecks, getMemberInfo(), $args))
			return $Translation['Couldn\'t delete this record'] . (
				!empty($args['error_message']) ?
					'<div class="text-bold">' . strip_tags($args['error_message']) . '</div>'
					: '' 
			);
	}

	// child table: dispositivos
	$res = sql("SELECT `id_tipodispo` FROM `tipo_dispositivo` WHERE `id_tipodispo`='{$selected_id}'", $eo);
	$id_tipodispo = db_fetch_row($res);
	$rires = sql("SELECT COUNT(1) FROM `dispositivos` WHERE `tipo_dispositivo`='" . makeSafe($id_tipodispo[0]) . "'", $eo);
	$rirow = db_fetch_row($rires);
	if($rirow[0] && !$AllowDeleteOfParents && !$skipChecks) {
		$RetMsg = $Translation["couldn't delete"];
		$RetMsg = str_replace('<RelatedRecords>', $rirow[0], $RetMsg);
		$RetMsg = str_replace('<TableName>', 'dispositivos', $RetMsg);
		return $RetMsg;
	} elseif($rirow[0] && $AllowDeleteOfParents && !$skipChecks) {
		$RetMsg = $Translation['confirm delete'];
		$RetMsg = str_replace('<RelatedRecords>', $rirow[0], $RetMsg);
		$RetMsg = str_replace('<TableName>', 'dispositivos', $RetMsg);
		$RetMsg = str_replace('<Delete>', '<input type="button" class="button" value="' . $Translation['yes'] . '" onClick="window.location = \'tipo_dispositivo_view.php?SelectedID=' . urlencode($selected_id) . '&delete_x=1&confirmed=1\';">', $RetMsg);
		$RetMsg = str_replace('<Cancel>', '<input type="button" class="button" value="' . $Translation[ 'no'] . '" onClick="window.location = \'tipo_dispositivo_view.php?SelectedID=' . urlencode($selected_id) . '\';">', $RetMsg);
		return $RetMsg;
	}

	// child table: docu_modelo
	$res = sql("SELECT `id_tipodispo` FROM `tipo_dispositivo` WHERE `id_tipodispo`='{$selected_id}'", $eo);
	$id_tipodispo = db_fetch_row($res);
	$rires = sql("SELECT COUNT(1) FROM `docu_modelo` WHERE `tipo_dispo`='" . makeSafe($id_tipodispo[0]) . "'", $eo);
	$rirow = db_fetch_row($rires);
	if($rirow[0] && !$AllowDeleteOfParents && !$skipChecks) {
		$RetMsg = $Translation["couldn't delete"];
		$RetMsg = str_replace('<RelatedRecords>', $rirow[0], $RetMsg);
		$RetMsg = str_replace('<TableName>', 'docu_modelo', $RetMsg);
		return $RetMsg;
	} elseif($rirow[0] && $AllowDeleteOfParents && !$skipChecks) {
		$RetMsg = $Translation['confirm delete'];
		$RetMsg = str_replace('<RelatedRecords>', $rirow[0], $RetMsg);
		$RetMsg = str_replace('<TableName>', 'docu_modelo', $RetMsg);
		$RetMsg = str_replace('<Delete>', '<input type="button" class="button" value="' . $Translation['yes'] . '" onClick="window.location = \'tipo_dispositivo_view.php?SelectedID=' . urlencode($selected_id) . '&delete_x=1&confirmed=1\';">', $RetMsg);
		$RetMsg = str_replace('<Cancel>', '<input type="button" class="button" value="' . $Translation[ 'no'] . '" onClick="window.location = \'tipo_dispositivo_view.php?SelectedID=' . urlencode($selected_id) . '\';">', $RetMsg);
		return $RetMsg;
	}

	// child table: formatos
	$res = sql("SELECT `id_tipodispo` FROM `tipo_dispositivo` WHERE `id_tipodispo`='{$selected_id}'", $eo);
	$id_tipodispo = db_fetch_row($res);
	$rires = sql("SELECT COUNT(1) FROM `formatos` WHERE `tipo_dispositivo`='" . makeSafe($id_tipodispo[0]) . "'", $eo);
	$rirow = db_fetch_row($rires);
	if($rirow[0] && !$AllowDeleteOfParents && !$skipChecks) {
		$RetMsg = $Translation["couldn't delete"];
		$RetMsg = str_replace('<RelatedRecords>', $rirow[0], $RetMsg);
		$RetMsg = str_replace('<TableName>', 'formatos', $RetMsg);
		return $RetMsg;
	} elseif($rirow[0] && $AllowDeleteOfParents && !$skipChecks) {
		$RetMsg = $Translation['confirm delete'];
		$RetMsg = str_replace('<RelatedRecords>', $rirow[0], $RetMsg);
		$RetMsg = str_replace('<TableName>', 'formatos', $RetMsg);
		$RetMsg = str_replace('<Delete>', '<input type="button" class="button" value="' . $Translation['yes'] . '" onClick="window.location = \'tipo_dispositivo_view.php?SelectedID=' . urlencode($selected_id) . '&delete_x=1&confirmed=1\';">', $RetMsg);
		$RetMsg = str_replace('<Cancel>', '<input type="button" class="button" value="' . $Translation[ 'no'] . '" onClick="window.location = \'tipo_dispositivo_view.php?SelectedID=' . urlencode($selected_id) . '\';">', $RetMsg);
		return $RetMsg;
	}

	// child table: compra_dispo
	$res = sql("SELECT `id_tipodispo` FROM `tipo_dispositivo` WHERE `id_tipodispo`='{$selected_id}'", $eo);
	$id_tipodispo = db_fetch_row($res);
	$rires = sql("SELECT COUNT(1) FROM `compra_dispo` WHERE `tipo_dispositivo`='" . makeSafe($id_tipodispo[0]) . "'", $eo);
	$rirow = db_fetch_row($rires);
	if($rirow[0] && !$AllowDeleteOfParents && !$skipChecks) {
		$RetMsg = $Translation["couldn't delete"];
		$RetMsg = str_replace('<RelatedRecords>', $rirow[0], $RetMsg);
		$RetMsg = str_replace('<TableName>', 'compra_dispo', $RetMsg);
		return $RetMsg;
	} elseif($rirow[0] && $AllowDeleteOfParents && !$skipChecks) {
		$RetMsg = $Translation['confirm delete'];
		$RetMsg = str_replace('<RelatedRecords>', $rirow[0], $RetMsg);
		$RetMsg = str_replace('<TableName>', 'compra_dispo', $RetMsg);
		$RetMsg = str_replace('<Delete>', '<input type="button" class="button" value="' . $Translation['yes'] . '" onClick="window.location = \'tipo_dispositivo_view.php?SelectedID=' . urlencode($selected_id) . '&delete_x=1&confirmed=1\';">', $RetMsg);
		$RetMsg = str_replace('<Cancel>', '<input type="button" class="button" value="' . $Translation[ 'no'] . '" onClick="window.location = \'tipo_dispositivo_view.php?SelectedID=' . urlencode($selected_id) . '\';">', $RetMsg);
		return $RetMsg;
	}

	// child table: articulos
	$res = sql("SELECT `id_tipodispo` FROM `tipo_dispositivo` WHERE `id_tipodispo`='{$selected_id}'", $eo);
	$id_tipodispo = db_fetch_row($res);
	$rires = sql("SELECT COUNT(1) FROM `articulos` WHERE `tipo_dispo`='" . makeSafe($id_tipodispo[0]) . "'", $eo);
	$rirow = db_fetch_row($rires);
	if($rirow[0] && !$AllowDeleteOfParents && !$skipChecks) {
		$RetMsg = $Translation["couldn't delete"];
		$RetMsg = str_replace('<RelatedRecords>', $rirow[0], $RetMsg);
		$RetMsg = str_replace('<TableName>', 'articulos', $RetMsg);
		return $RetMsg;
	} elseif($rirow[0] && $AllowDeleteOfParents && !$skipChecks) {
		$RetMsg = $Translation['confirm delete'];
		$RetMsg = str_replace('<RelatedRecords>', $rirow[0], $RetMsg);
		$RetMsg = str_replace('<TableName>', 'articulos', $RetMsg);
		$RetMsg = str_replace('<Delete>', '<input type="button" class="button" value="' . $Translation['yes'] . '" onClick="window.location = \'tipo_dispositivo_view.php?SelectedID=' . urlencode($selected_id) . '&delete_x=1&confirmed=1\';">', $RetMsg);
		$RetMsg = str_replace('<Cancel>', '<input type="button" class="button" value="' . $Translation[ 'no'] . '" onClick="window.location = \'tipo_dispositivo_view.php?SelectedID=' . urlencode($selected_id) . '\';">', $RetMsg);
		return $RetMsg;
	}

	sql("DELETE FROM `tipo_dispositivo` WHERE `id_tipodispo`='{$selected_id}'", $eo);

	// hook: tipo_dispositivo_after_delete
	if(function_exists('tipo_dispositivo_after_delete')) {
		$args = [];
		tipo_dispositivo_after_delete($selected_id, getMemberInfo(), $args);
	}

	// mm: delete ownership data
	sql("DELETE FROM `membership_userrecords` WHERE `tableName`='tipo_dispositivo' AND `pkValue`='{$selected_id}'", $eo);
}

function tipo_dispositivo_update(&$selected_id, &$error_message = '') {
	global $Translation;

	// mm: can member edit record?
	if(!check_record_permission('tipo_dispositivo', $selected_id, 'edit')) return false;

	$data = [
		'tipo_dispositivo' => Request::val('tipo_dispositivo', ''),
		'grupo_dispo' => Request::lookup('grupo_dispo', ''),
		'prefijo' => Request::val('prefijo', ''),
		'descripcion' => br2nl(Request::val('descripcion', '')),
	];

	if($data['tipo_dispositivo'] === '') {
		echo StyleSheet() . "\n\n<div class=\"alert alert-danger\">{$Translation['error:']} 'Tipo de dispositivo': {$Translation['field not null']}<br><br>";
		echo '<a href="" onclick="history.go(-1); return false;">' . $Translation['< back'] . '</a></div>';
		exit;
	}
	if($data['grupo_dispo'] === '') {
		echo StyleSheet() . "\n\n<div class=\"alert alert-danger\">{$Translation['error:']} 'Grupo': {$Translation['field not null']}<br><br>";
		echo '<a href="" onclick="history.go(-1); return false;">' . $Translation['< back'] . '</a></div>';
		exit;
	}
	if($data['prefijo'] === '') {
		echo StyleSheet() . "\n\n<div class=\"alert alert-danger\">{$Translation['error:']} 'Prefijo': {$Translation['field not null']}<br><br>";
		echo '<a href="" onclick="history.go(-1); return false;">' . $Translation['< back'] . '</a></div>';
		exit;
	}
	// get existing values
	$old_data = getRecord('tipo_dispositivo', $selected_id);
	if(is_array($old_data)) {
		$old_data = array_map('makeSafe', $old_data);
		$old_data['selectedID'] = makeSafe($selected_id);
	}

	$data['selectedID'] = makeSafe($selected_id);

	// hook: tipo_dispositivo_before_update
	if(function_exists('tipo_dispositivo_before_update')) {
		$args = ['old_data' => $old_data];
		if(!tipo_dispositivo_before_update($data, getMemberInfo(), $args)) {
			if(isset($args['error_message'])) $error_message = $args['error_message'];
			return false;
		}
	}

	$set = $data; unset($set['selectedID']);
	foreach ($set as $field => $value) {
		$set[$field] = ($value !== '' && $value !== NULL) ? $value : NULL;
	}

	if(!update(
		'tipo_dispositivo', 
		backtick_keys_once($set), 
		['`id_tipodispo`' => $selected_id], 
		$error_message
	)) {
		echo $error_message;
		echo '<a href="tipo_dispositivo_view.php?SelectedID=' . urlencode($selected_id) . "\">{$Translation['< back']}</a>";
		exit;
	}


	$eo = ['silentErrors' => true];

	update_calc_fields('tipo_dispositivo', $data['selectedID'], calculated_fields()['tipo_dispositivo']);

	// hook: tipo_dispositivo_after_update
	if(function_exists('tipo_dispositivo_after_update')) {
		$res = sql("SELECT * FROM `tipo_dispositivo` WHERE `id_tipodispo`='{$data['selectedID']}' LIMIT 1", $eo);
		if($row = db_fetch_assoc($res)) $data = array_map('makeSafe', $row);

		$data['selectedID'] = $data['id_tipodispo'];
		$args = ['old_data' => $old_data];
		if(!tipo_dispositivo_after_update($data, getMemberInfo(), $args)) return;
	}

	// mm: update ownership data
	sql("UPDATE `membership_userrecords` SET `dateUpdated`='" . time() . "' WHERE `tableName`='tipo_dispositivo' AND `pkValue`='" . makeSafe($selected_id) . "'", $eo);
}

function tipo_dispositivo_form($selected_id = '', $AllowUpdate = 1, $AllowInsert = 1, $AllowDelete = 1, $ShowCancel = 0, $TemplateDV = '', $TemplateDVP = '') {
	// function to return an editable form for a table records
	// and fill it with data of record whose ID is $selected_id. If $selected_id
	// is empty, an empty form is shown, with only an 'Add New'
	// button displayed.

	global $Translation;

	// mm: get table permissions
	$arrPerm = getTablePermissions('tipo_dispositivo');
	if(!$arrPerm['insert'] && $selected_id=='') return $Translation['tableAccessDenied'];
	$AllowInsert = ($arrPerm['insert'] ? true : false);
	// print preview?
	$dvprint = false;
	if($selected_id && $_REQUEST['dvprint_x'] != '') {
		$dvprint = true;
	}

	$filterer_grupo_dispo = thisOr($_REQUEST['filterer_grupo_dispo'], '');

	// populate filterers, starting from children to grand-parents

	// unique random identifier
	$rnd1 = ($dvprint ? rand(1000000, 9999999) : '');
	// combobox: grupo_dispo
	$combo_grupo_dispo = new DataCombo;

	if($selected_id) {
		// mm: check member permissions
		if(!$arrPerm['view']) return $Translation['tableAccessDenied'];

		// mm: who is the owner?
		$ownerGroupID = sqlValue("SELECT `groupID` FROM `membership_userrecords` WHERE `tableName`='tipo_dispositivo' AND `pkValue`='" . makeSafe($selected_id) . "'");
		$ownerMemberID = sqlValue("SELECT LCASE(`memberID`) FROM `membership_userrecords` WHERE `tableName`='tipo_dispositivo' AND `pkValue`='" . makeSafe($selected_id) . "'");

		if($arrPerm['view'] == 1 && getLoggedMemberID() != $ownerMemberID) return $Translation['tableAccessDenied'];
		if($arrPerm['view'] == 2 && getLoggedGroupID() != $ownerGroupID) return $Translation['tableAccessDenied'];

		// can edit?
		$AllowUpdate = 0;
		if(($arrPerm['edit'] == 1 && $ownerMemberID == getLoggedMemberID()) || ($arrPerm['edit'] == 2 && $ownerGroupID == getLoggedGroupID()) || $arrPerm['edit'] == 3) {
			$AllowUpdate = 1;
		}

		$res = sql("SELECT * FROM `tipo_dispositivo` WHERE `id_tipodispo`='" . makeSafe($selected_id) . "'", $eo);
		if(!($row = db_fetch_array($res))) {
			return error_message($Translation['No records found'], 'tipo_dispositivo_view.php', false);
		}
		$combo_grupo_dispo->SelectedData = $row['grupo_dispo'];
		$urow = $row; /* unsanitized data */
		$row = array_map('safe_html', $row);
	} else {
		$combo_grupo_dispo->SelectedData = $filterer_grupo_dispo;
	}
	$combo_grupo_dispo->HTML = $combo_grupo_dispo->MatchText = '<span id="grupo_dispo-container' . $rnd1 . '"></span>';

	ob_start();
	?>

	<script>
		// initial lookup values
		AppGini.current_grupo_dispo__RAND__ = { text: "", value: "<?php echo addslashes($selected_id ? $urow['grupo_dispo'] : htmlspecialchars($filterer_grupo_dispo, ENT_QUOTES)); ?>"};

		jQuery(function() {
			setTimeout(function() {
				if(typeof(grupo_dispo_reload__RAND__) == 'function') grupo_dispo_reload__RAND__();
			}, 50); /* we need to slightly delay client-side execution of the above code to allow AppGini.ajaxCache to work */
		});
		function grupo_dispo_reload__RAND__() {
			$j.ajax({
				url: 'ajax_combo.php',
				data: {
					t: 'tipo_dispositivo',
					f: 'grupo_dispo',
					id: AppGini.current_grupo_dispo__RAND__.value,
					text: AppGini.current_grupo_dispo__RAND__.text,
					o: <?php echo (($AllowUpdate || $AllowInsert) && !$dvprint ? '1' : '0'); ?>

				},
				success: function(html) {
					$j('#grupo_dispo-container__RAND__').html(html);
				},
				complete: function() { grupo_dispo_changed__RAND__() },
			});
		}

		function grupo_dispo_changed__RAND__() {
			if($j("input[name=grupo_dispo]").length) {
				if($j("input[name=grupo_dispo]:checked").length) {
					AppGini.current_grupo_dispo__RAND__.value = $j("input[name=grupo_dispo]:checked").val();
					AppGini.current_grupo_dispo__RAND__.text = "";
				} else {
					AppGini.current_grupo_dispo__RAND__.value = "";
					AppGini.current_grupo_dispo__RAND__.text = "";
				}
				AppGini.hideViewParentLinks();
			}

			if(typeof(grupo_dispo_update_autofills__RAND__) == 'function') grupo_dispo_update_autofills__RAND__();
		}
	</script>
	<?php

	$lookups = str_replace('__RAND__', $rnd1, ob_get_contents());
	ob_end_clean();


	// code for template based detail view forms

	// open the detail view template
	if($dvprint) {
		$template_file = is_file("./{$TemplateDVP}") ? "./{$TemplateDVP}" : './templates/tipo_dispositivo_templateDVP.html';
		$templateCode = @file_get_contents($template_file);
	} else {
		$template_file = is_file("./{$TemplateDV}") ? "./{$TemplateDV}" : './templates/tipo_dispositivo_templateDV.html';
		$templateCode = @file_get_contents($template_file);
	}

	// process form title
	$templateCode = str_replace('<%%DETAIL_VIEW_TITLE%%>', 'Tipo dispositivo details', $templateCode);
	$templateCode = str_replace('<%%RND1%%>', $rnd1, $templateCode);
	$templateCode = str_replace('<%%EMBEDDED%%>', ($_REQUEST['Embedded'] ? 'Embedded=1' : ''), $templateCode);
	// process buttons
	if($AllowInsert) {
		if(!$selected_id) $templateCode = str_replace('<%%INSERT_BUTTON%%>', '<button type="submit" class="btn btn-success" id="insert" name="insert_x" value="1" onclick="return tipo_dispositivo_validateData();"><i class="glyphicon glyphicon-plus-sign"></i> ' . $Translation['Save New'] . '</button>', $templateCode);
		$templateCode = str_replace('<%%INSERT_BUTTON%%>', '<button type="submit" class="btn btn-default" id="insert" name="insert_x" value="1" onclick="return tipo_dispositivo_validateData();"><i class="glyphicon glyphicon-plus-sign"></i> ' . $Translation['Save As Copy'] . '</button>', $templateCode);
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
			$templateCode = str_replace('<%%UPDATE_BUTTON%%>', '<button type="submit" class="btn btn-success btn-lg" id="update" name="update_x" value="1" onclick="return tipo_dispositivo_validateData();" title="' . html_attr($Translation['Save Changes']) . '"><i class="glyphicon glyphicon-ok"></i> ' . $Translation['Save Changes'] . '</button>', $templateCode);
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
		$jsReadOnly .= "\tjQuery('#tipo_dispositivo').replaceWith('<div class=\"form-control-static\" id=\"tipo_dispositivo\">' + (jQuery('#tipo_dispositivo').val() || '') + '</div>');\n";
		$jsReadOnly .= "\tjQuery('#grupo_dispo').prop('disabled', true).css({ color: '#555', backgroundColor: '#fff' });\n";
		$jsReadOnly .= "\tjQuery('#grupo_dispo_caption').prop('disabled', true).css({ color: '#555', backgroundColor: 'white' });\n";
		$jsReadOnly .= "\tjQuery('#prefijo').replaceWith('<div class=\"form-control-static\" id=\"prefijo\">' + (jQuery('#prefijo').val() || '') + '</div>');\n";
		$jsReadOnly .= "\tjQuery('#descripcion').replaceWith('<div class=\"form-control-static\" id=\"descripcion\">' + (jQuery('#descripcion').val() || '') + '</div>');\n";
		$jsReadOnly .= "\tjQuery('.select2-container').hide();\n";

		$noUploads = true;
	} elseif($AllowInsert) {
		$jsEditable = "\tjQuery('form').eq(0).data('already_changed', true);"; // temporarily disable form change handler
		$jsEditable .= "\tjQuery('form').eq(0).data('already_changed', false);"; // re-enable form change handler
	}

	// process combos
	$templateCode = str_replace('<%%COMBO(grupo_dispo)%%>', $combo_grupo_dispo->HTML, $templateCode);
	$templateCode = str_replace('<%%COMBOTEXT(grupo_dispo)%%>', $combo_grupo_dispo->MatchText, $templateCode);
	$templateCode = str_replace('<%%URLCOMBOTEXT(grupo_dispo)%%>', urlencode($combo_grupo_dispo->MatchText), $templateCode);

	/* lookup fields array: 'lookup field name' => array('parent table name', 'lookup field caption') */
	$lookup_fields = array('grupo_dispo' => array('dispositivo_tipo_grupo', 'Grupo'), );
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
	$templateCode = str_replace('<%%UPLOADFILE(id_tipodispo)%%>', '', $templateCode);
	$templateCode = str_replace('<%%UPLOADFILE(tipo_dispositivo)%%>', '', $templateCode);
	$templateCode = str_replace('<%%UPLOADFILE(grupo_dispo)%%>', '', $templateCode);
	$templateCode = str_replace('<%%UPLOADFILE(prefijo)%%>', '', $templateCode);
	$templateCode = str_replace('<%%UPLOADFILE(descripcion)%%>', '', $templateCode);

	// process values
	if($selected_id) {
		if( $dvprint) $templateCode = str_replace('<%%VALUE(id_tipodispo)%%>', safe_html($urow['id_tipodispo']), $templateCode);
		if(!$dvprint) $templateCode = str_replace('<%%VALUE(id_tipodispo)%%>', html_attr($row['id_tipodispo']), $templateCode);
		$templateCode = str_replace('<%%URLVALUE(id_tipodispo)%%>', urlencode($urow['id_tipodispo']), $templateCode);
		if( $dvprint) $templateCode = str_replace('<%%VALUE(tipo_dispositivo)%%>', safe_html($urow['tipo_dispositivo']), $templateCode);
		if(!$dvprint) $templateCode = str_replace('<%%VALUE(tipo_dispositivo)%%>', html_attr($row['tipo_dispositivo']), $templateCode);
		$templateCode = str_replace('<%%URLVALUE(tipo_dispositivo)%%>', urlencode($urow['tipo_dispositivo']), $templateCode);
		if( $dvprint) $templateCode = str_replace('<%%VALUE(grupo_dispo)%%>', safe_html($urow['grupo_dispo']), $templateCode);
		if(!$dvprint) $templateCode = str_replace('<%%VALUE(grupo_dispo)%%>', html_attr($row['grupo_dispo']), $templateCode);
		$templateCode = str_replace('<%%URLVALUE(grupo_dispo)%%>', urlencode($urow['grupo_dispo']), $templateCode);
		if( $dvprint) $templateCode = str_replace('<%%VALUE(prefijo)%%>', safe_html($urow['prefijo']), $templateCode);
		if(!$dvprint) $templateCode = str_replace('<%%VALUE(prefijo)%%>', html_attr($row['prefijo']), $templateCode);
		$templateCode = str_replace('<%%URLVALUE(prefijo)%%>', urlencode($urow['prefijo']), $templateCode);
		if($dvprint || (!$AllowUpdate && !$AllowInsert)) {
			$templateCode = str_replace('<%%VALUE(descripcion)%%>', safe_html($urow['descripcion']), $templateCode);
		} else {
			$templateCode = str_replace('<%%VALUE(descripcion)%%>', safe_html($urow['descripcion'], true), $templateCode);
		}
		$templateCode = str_replace('<%%URLVALUE(descripcion)%%>', urlencode($urow['descripcion']), $templateCode);
	} else {
		$templateCode = str_replace('<%%VALUE(id_tipodispo)%%>', '', $templateCode);
		$templateCode = str_replace('<%%URLVALUE(id_tipodispo)%%>', urlencode(''), $templateCode);
		$templateCode = str_replace('<%%VALUE(tipo_dispositivo)%%>', '', $templateCode);
		$templateCode = str_replace('<%%URLVALUE(tipo_dispositivo)%%>', urlencode(''), $templateCode);
		$templateCode = str_replace('<%%VALUE(grupo_dispo)%%>', '', $templateCode);
		$templateCode = str_replace('<%%URLVALUE(grupo_dispo)%%>', urlencode(''), $templateCode);
		$templateCode = str_replace('<%%VALUE(prefijo)%%>', '', $templateCode);
		$templateCode = str_replace('<%%URLVALUE(prefijo)%%>', urlencode(''), $templateCode);
		$templateCode = str_replace('<%%VALUE(descripcion)%%>', '', $templateCode);
		$templateCode = str_replace('<%%URLVALUE(descripcion)%%>', urlencode(''), $templateCode);
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
	$rdata = $jdata = get_defaults('tipo_dispositivo');
	if($selected_id) {
		$jdata = get_joined_record('tipo_dispositivo', $selected_id);
		if($jdata === false) $jdata = get_defaults('tipo_dispositivo');
		$rdata = $row;
	}
	$templateCode .= loadView('tipo_dispositivo-ajax-cache', array('rdata' => $rdata, 'jdata' => $jdata));

	// hook: tipo_dispositivo_dv
	if(function_exists('tipo_dispositivo_dv')) {
		$args=[];
		tipo_dispositivo_dv(($selected_id ? $selected_id : FALSE), getMemberInfo(), $templateCode, $args);
	}

	return $templateCode;
}