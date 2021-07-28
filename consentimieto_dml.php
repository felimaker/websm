<?php

// Data functions (insert, update, delete, form) for table consentimieto

// This script and data application were generated by AppGini 5.97
// Download AppGini for free from https://bigprof.com/appgini/download/

function consentimieto_insert(&$error_message = '') {
	global $Translation;

	// mm: can member insert record?
	$arrPerm = getTablePermissions('consentimieto');
	if(!$arrPerm['insert']) return false;

	$data = [
		'identificacion' => Request::lookup('id_perfil'),
		'acepto' => Request::checkBox('acepto', ''),
		'creado' => parseCode('<%%creationDateTime%%>', true, true),
		'creado_por' => parseCode('<%%creatorUsername%%>', true),
	];

	if($data['acepto'] === '') {
		echo StyleSheet() . "\n\n<div class=\"alert alert-danger\">{$Translation['error:']} 'Acepto y estoy deacuerdo con la Pol&#237;tica de tratamiento de datos': {$Translation['field not null']}<br><br>";
		echo '<a href="" onclick="history.go(-1); return false;">' . $Translation['< back'] . '</a></div>';
		exit;
	}

	// hook: consentimieto_before_insert
	if(function_exists('consentimieto_before_insert')) {
		$args = [];
		if(!consentimieto_before_insert($data, getMemberInfo(), $args)) {
			if(isset($args['error_message'])) $error_message = $args['error_message'];
			return false;
		}
	}

	$error = '';
	// set empty fields to NULL
	$data = array_map(function($v) { return ($v === '' ? NULL : $v); }, $data);
	insert('consentimieto', backtick_keys_once($data), $error);
	if($error)
		die("{$error}<br><a href=\"#\" onclick=\"history.go(-1);\">{$Translation['< back']}</a>");

	$recID = db_insert_id(db_link());

	// automatic id_perfil if passed as filterer
	if($_REQUEST['filterer_id_perfil']) {
		sql("UPDATE `consentimieto` SET `id_perfil`='" . makeSafe($_REQUEST['filterer_id_perfil']) . "' WHERE `id`='" . makeSafe($recID, false) . "'", $eo);
	}

	update_calc_fields('consentimieto', $recID, calculated_fields()['consentimieto']);

	// hook: consentimieto_after_insert
	if(function_exists('consentimieto_after_insert')) {
		$res = sql("SELECT * FROM `consentimieto` WHERE `id`='" . makeSafe($recID, false) . "' LIMIT 1", $eo);
		if($row = db_fetch_assoc($res)) {
			$data = array_map('makeSafe', $row);
		}
		$data['selectedID'] = makeSafe($recID, false);
		$args=[];
		if(!consentimieto_after_insert($data, getMemberInfo(), $args)) { return $recID; }
	}

	// mm: save ownership data
	set_record_owner('consentimieto', $recID, getLoggedMemberID());

	// if this record is a copy of another record, copy children if applicable
	if(!empty($_REQUEST['SelectedID'])) consentimieto_copy_children($recID, $_REQUEST['SelectedID']);

	return $recID;
}

function consentimieto_copy_children($destination_id, $source_id) {
	global $Translation;
	$requests = []; // array of curl handlers for launching insert requests
	$eo = ['silentErrors' => true];
	$safe_sid = makeSafe($source_id);

	// launch requests, asynchronously
	curl_batch($requests);
}

function consentimieto_delete($selected_id, $AllowDeleteOfParents = false, $skipChecks = false) {
	// insure referential integrity ...
	global $Translation;
	$selected_id = makeSafe($selected_id);

	// mm: can member delete record?
	if(!check_record_permission('consentimieto', $selected_id, 'delete')) {
		return $Translation['You don\'t have enough permissions to delete this record'];
	}

	// hook: consentimieto_before_delete
	if(function_exists('consentimieto_before_delete')) {
		$args = [];
		if(!consentimieto_before_delete($selected_id, $skipChecks, getMemberInfo(), $args))
			return $Translation['Couldn\'t delete this record'] . (
				!empty($args['error_message']) ?
					'<div class="text-bold">' . strip_tags($args['error_message']) . '</div>'
					: '' 
			);
	}

	sql("DELETE FROM `consentimieto` WHERE `id`='{$selected_id}'", $eo);

	// hook: consentimieto_after_delete
	if(function_exists('consentimieto_after_delete')) {
		$args = [];
		consentimieto_after_delete($selected_id, getMemberInfo(), $args);
	}

	// mm: delete ownership data
	sql("DELETE FROM `membership_userrecords` WHERE `tableName`='consentimieto' AND `pkValue`='{$selected_id}'", $eo);
}

function consentimieto_update(&$selected_id, &$error_message = '') {
	global $Translation;

	// mm: can member edit record?
	if(!check_record_permission('consentimieto', $selected_id, 'edit')) return false;

	$data = [
		'identificacion' => Request::lookup('id_perfil'),
		'acepto' => Request::checkBox('acepto', ''),
	];

	if($data['acepto'] === '') {
		echo StyleSheet() . "\n\n<div class=\"alert alert-danger\">{$Translation['error:']} 'Acepto y estoy deacuerdo con la Pol&#237;tica de tratamiento de datos': {$Translation['field not null']}<br><br>";
		echo '<a href="" onclick="history.go(-1); return false;">' . $Translation['< back'] . '</a></div>';
		exit;
	}
	// get existing values
	$old_data = getRecord('consentimieto', $selected_id);
	if(is_array($old_data)) {
		$old_data = array_map('makeSafe', $old_data);
		$old_data['selectedID'] = makeSafe($selected_id);
	}

	$data['selectedID'] = makeSafe($selected_id);

	// hook: consentimieto_before_update
	if(function_exists('consentimieto_before_update')) {
		$args = ['old_data' => $old_data];
		if(!consentimieto_before_update($data, getMemberInfo(), $args)) {
			if(isset($args['error_message'])) $error_message = $args['error_message'];
			return false;
		}
	}

	$set = $data; unset($set['selectedID']);
	foreach ($set as $field => $value) {
		$set[$field] = ($value !== '' && $value !== NULL) ? $value : NULL;
	}

	if(!update(
		'consentimieto', 
		backtick_keys_once($set), 
		['`id`' => $selected_id], 
		$error_message
	)) {
		echo $error_message;
		echo '<a href="consentimieto_view.php?SelectedID=' . urlencode($selected_id) . "\">{$Translation['< back']}</a>";
		exit;
	}


	$eo = ['silentErrors' => true];

	update_calc_fields('consentimieto', $data['selectedID'], calculated_fields()['consentimieto']);

	// hook: consentimieto_after_update
	if(function_exists('consentimieto_after_update')) {
		$res = sql("SELECT * FROM `consentimieto` WHERE `id`='{$data['selectedID']}' LIMIT 1", $eo);
		if($row = db_fetch_assoc($res)) $data = array_map('makeSafe', $row);

		$data['selectedID'] = $data['id'];
		$args = ['old_data' => $old_data];
		if(!consentimieto_after_update($data, getMemberInfo(), $args)) return;
	}

	// mm: update ownership data
	sql("UPDATE `membership_userrecords` SET `dateUpdated`='" . time() . "' WHERE `tableName`='consentimieto' AND `pkValue`='" . makeSafe($selected_id) . "'", $eo);
}

function consentimieto_form($selected_id = '', $AllowUpdate = 1, $AllowInsert = 1, $AllowDelete = 1, $ShowCancel = 0, $TemplateDV = '', $TemplateDVP = '') {
	// function to return an editable form for a table records
	// and fill it with data of record whose ID is $selected_id. If $selected_id
	// is empty, an empty form is shown, with only an 'Add New'
	// button displayed.

	global $Translation;

	// mm: get table permissions
	$arrPerm = getTablePermissions('consentimieto');
	if(!$arrPerm['insert'] && $selected_id=='') return $Translation['tableAccessDenied'];
	$AllowInsert = ($arrPerm['insert'] ? true : false);
	// print preview?
	$dvprint = false;
	if($selected_id && $_REQUEST['dvprint_x'] != '') {
		$dvprint = true;
	}

	$filterer_id_perfil = thisOr($_REQUEST['filterer_id_perfil'], '');

	// populate filterers, starting from children to grand-parents

	// unique random identifier
	$rnd1 = ($dvprint ? rand(1000000, 9999999) : '');
	// combobox: id_perfil
	$combo_id_perfil = new DataCombo;

	if($selected_id) {
		// mm: check member permissions
		if(!$arrPerm['view']) return $Translation['tableAccessDenied'];

		// mm: who is the owner?
		$ownerGroupID = sqlValue("SELECT `groupID` FROM `membership_userrecords` WHERE `tableName`='consentimieto' AND `pkValue`='" . makeSafe($selected_id) . "'");
		$ownerMemberID = sqlValue("SELECT LCASE(`memberID`) FROM `membership_userrecords` WHERE `tableName`='consentimieto' AND `pkValue`='" . makeSafe($selected_id) . "'");

		if($arrPerm['view'] == 1 && getLoggedMemberID() != $ownerMemberID) return $Translation['tableAccessDenied'];
		if($arrPerm['view'] == 2 && getLoggedGroupID() != $ownerGroupID) return $Translation['tableAccessDenied'];

		// can edit?
		$AllowUpdate = 0;
		if(($arrPerm['edit'] == 1 && $ownerMemberID == getLoggedMemberID()) || ($arrPerm['edit'] == 2 && $ownerGroupID == getLoggedGroupID()) || $arrPerm['edit'] == 3) {
			$AllowUpdate = 1;
		}

		$res = sql("SELECT * FROM `consentimieto` WHERE `id`='" . makeSafe($selected_id) . "'", $eo);
		if(!($row = db_fetch_array($res))) {
			return error_message($Translation['No records found'], 'consentimieto_view.php', false);
		}
		$combo_id_perfil->SelectedData = $row['id_perfil'];
		$urow = $row; /* unsanitized data */
		$row = array_map('safe_html', $row);
	} else {
		$combo_id_perfil->SelectedData = $filterer_id_perfil;
	}
	$combo_id_perfil->HTML = '<span id="id_perfil-container' . $rnd1 . '"></span><input type="hidden" name="id_perfil" id="id_perfil' . $rnd1 . '" value="' . html_attr($combo_id_perfil->SelectedData) . '">';
	$combo_id_perfil->MatchText = '<span id="id_perfil-container-readonly' . $rnd1 . '"></span><input type="hidden" name="id_perfil" id="id_perfil' . $rnd1 . '" value="' . html_attr($combo_id_perfil->SelectedData) . '">';

	ob_start();
	?>

	<script>
		// initial lookup values
		AppGini.current_id_perfil__RAND__ = { text: "", value: "<?php echo addslashes($selected_id ? $urow['id_perfil'] : htmlspecialchars($filterer_id_perfil, ENT_QUOTES)); ?>"};

		jQuery(function() {
			setTimeout(function() {
				if(typeof(id_perfil_reload__RAND__) == 'function') id_perfil_reload__RAND__();
			}, 50); /* we need to slightly delay client-side execution of the above code to allow AppGini.ajaxCache to work */
		});
		function id_perfil_reload__RAND__() {
		<?php if(($AllowUpdate || $AllowInsert) && !$dvprint) { ?>

			$j("#id_perfil-container__RAND__").select2({
				/* initial default value */
				initSelection: function(e, c) {
					$j.ajax({
						url: 'ajax_combo.php',
						dataType: 'json',
						data: { id: AppGini.current_id_perfil__RAND__.value, t: 'consentimieto', f: 'id_perfil' },
						success: function(resp) {
							c({
								id: resp.results[0].id,
								text: resp.results[0].text
							});
							$j('[name="id_perfil"]').val(resp.results[0].id);
							$j('[id=id_perfil-container-readonly__RAND__]').html('<span id="id_perfil-match-text">' + resp.results[0].text + '</span>');
							if(resp.results[0].id == '<?php echo empty_lookup_value; ?>') { $j('.btn[id=perfil_view_parent]').hide(); } else { $j('.btn[id=perfil_view_parent]').show(); }


							if(typeof(id_perfil_update_autofills__RAND__) == 'function') id_perfil_update_autofills__RAND__();
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
					data: function(term, page) { return { s: term, p: page, t: 'consentimieto', f: 'id_perfil' }; },
					results: function(resp, page) { return resp; }
				},
				escapeMarkup: function(str) { return str; }
			}).on('change', function(e) {
				AppGini.current_id_perfil__RAND__.value = e.added.id;
				AppGini.current_id_perfil__RAND__.text = e.added.text;
				$j('[name="id_perfil"]').val(e.added.id);
				if(e.added.id == '<?php echo empty_lookup_value; ?>') { $j('.btn[id=perfil_view_parent]').hide(); } else { $j('.btn[id=perfil_view_parent]').show(); }


				if(typeof(id_perfil_update_autofills__RAND__) == 'function') id_perfil_update_autofills__RAND__();
			});

			if(!$j("#id_perfil-container__RAND__").length) {
				$j.ajax({
					url: 'ajax_combo.php',
					dataType: 'json',
					data: { id: AppGini.current_id_perfil__RAND__.value, t: 'consentimieto', f: 'id_perfil' },
					success: function(resp) {
						$j('[name="id_perfil"]').val(resp.results[0].id);
						$j('[id=id_perfil-container-readonly__RAND__]').html('<span id="id_perfil-match-text">' + resp.results[0].text + '</span>');
						if(resp.results[0].id == '<?php echo empty_lookup_value; ?>') { $j('.btn[id=perfil_view_parent]').hide(); } else { $j('.btn[id=perfil_view_parent]').show(); }

						if(typeof(id_perfil_update_autofills__RAND__) == 'function') id_perfil_update_autofills__RAND__();
					}
				});
			}

		<?php } else { ?>

			$j.ajax({
				url: 'ajax_combo.php',
				dataType: 'json',
				data: { id: AppGini.current_id_perfil__RAND__.value, t: 'consentimieto', f: 'id_perfil' },
				success: function(resp) {
					$j('[id=id_perfil-container__RAND__], [id=id_perfil-container-readonly__RAND__]').html('<span id="id_perfil-match-text">' + resp.results[0].text + '</span>');
					if(resp.results[0].id == '<?php echo empty_lookup_value; ?>') { $j('.btn[id=perfil_view_parent]').hide(); } else { $j('.btn[id=perfil_view_parent]').show(); }

					if(typeof(id_perfil_update_autofills__RAND__) == 'function') id_perfil_update_autofills__RAND__();
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
		$template_file = is_file("./{$TemplateDVP}") ? "./{$TemplateDVP}" : './templates/consentimieto_templateDVP.html';
		$templateCode = @file_get_contents($template_file);
	} else {
		$template_file = is_file("./{$TemplateDV}") ? "./{$TemplateDV}" : './templates/consentimieto_templateDV.html';
		$templateCode = @file_get_contents($template_file);
	}

	// process form title
	$templateCode = str_replace('<%%DETAIL_VIEW_TITLE%%>', 'Consentimieto details', $templateCode);
	$templateCode = str_replace('<%%RND1%%>', $rnd1, $templateCode);
	$templateCode = str_replace('<%%EMBEDDED%%>', ($_REQUEST['Embedded'] ? 'Embedded=1' : ''), $templateCode);
	// process buttons
	if($AllowInsert) {
		if(!$selected_id) $templateCode = str_replace('<%%INSERT_BUTTON%%>', '<button type="submit" class="btn btn-success" id="insert" name="insert_x" value="1" onclick="return consentimieto_validateData();"><i class="glyphicon glyphicon-plus-sign"></i> ' . $Translation['Save New'] . '</button>', $templateCode);
		$templateCode = str_replace('<%%INSERT_BUTTON%%>', '<button type="submit" class="btn btn-default" id="insert" name="insert_x" value="1" onclick="return consentimieto_validateData();"><i class="glyphicon glyphicon-plus-sign"></i> ' . $Translation['Save As Copy'] . '</button>', $templateCode);
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
			$templateCode = str_replace('<%%UPDATE_BUTTON%%>', '<button type="submit" class="btn btn-success btn-lg" id="update" name="update_x" value="1" onclick="return consentimieto_validateData();" title="' . html_attr($Translation['Save Changes']) . '"><i class="glyphicon glyphicon-ok"></i> ' . $Translation['Save Changes'] . '</button>', $templateCode);
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
		$jsReadOnly .= "\tjQuery('#acepto').prop('disabled', true);\n";
		$jsReadOnly .= "\tjQuery('.select2-container').hide();\n";

		$noUploads = true;
	} elseif($AllowInsert) {
		$jsEditable = "\tjQuery('form').eq(0).data('already_changed', true);"; // temporarily disable form change handler
		$jsEditable .= "\tjQuery('form').eq(0).data('already_changed', false);"; // re-enable form change handler
	}

	// process combos
	$templateCode = str_replace('<%%COMBO(id_perfil)%%>', $combo_id_perfil->HTML, $templateCode);
	$templateCode = str_replace('<%%COMBOTEXT(id_perfil)%%>', $combo_id_perfil->MatchText, $templateCode);
	$templateCode = str_replace('<%%URLCOMBOTEXT(id_perfil)%%>', urlencode($combo_id_perfil->MatchText), $templateCode);

	/* lookup fields array: 'lookup field name' => array('parent table name', 'lookup field caption') */
	$lookup_fields = array('id_perfil' => array('perfil', 'Nombre'), );
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
	$templateCode = str_replace('<%%UPLOADFILE(id_perfil)%%>', '', $templateCode);
	$templateCode = str_replace('<%%UPLOADFILE(acepto)%%>', '', $templateCode);
	$templateCode = str_replace('<%%UPLOADFILE(creado)%%>', '', $templateCode);
	$templateCode = str_replace('<%%UPLOADFILE(creado_por)%%>', '', $templateCode);

	// process values
	if($selected_id) {
		if( $dvprint) $templateCode = str_replace('<%%VALUE(id)%%>', safe_html($urow['id']), $templateCode);
		if(!$dvprint) $templateCode = str_replace('<%%VALUE(id)%%>', html_attr($row['id']), $templateCode);
		$templateCode = str_replace('<%%URLVALUE(id)%%>', urlencode($urow['id']), $templateCode);
		$templateCode = str_replace('<%%VALUE(id_perfil)%%>', safe_html($urow['id_perfil']), $templateCode);
		$templateCode = str_replace('<%%URLVALUE(id_perfil)%%>', urlencode($urow['id_perfil']), $templateCode);
		$templateCode = str_replace('<%%CHECKED(acepto)%%>', ($row['acepto'] ? "checked" : ""), $templateCode);
		$templateCode = str_replace('<%%VALUE(creado)%%>', app_datetime($row['creado'], 'dt'), $templateCode);
		$templateCode = str_replace('<%%URLVALUE(creado)%%>', urlencode(app_datetime($urow['creado'], 'dt')), $templateCode);
		$templateCode = str_replace('<%%VALUE(creado_por)%%>', safe_html($urow['creado_por']), $templateCode);
		$templateCode = str_replace('<%%URLVALUE(creado_por)%%>', urlencode($urow['creado_por']), $templateCode);
	} else {
		$templateCode = str_replace('<%%VALUE(id)%%>', '', $templateCode);
		$templateCode = str_replace('<%%URLVALUE(id)%%>', urlencode(''), $templateCode);
		$templateCode = str_replace('<%%VALUE(id_perfil)%%>', '', $templateCode);
		$templateCode = str_replace('<%%URLVALUE(id_perfil)%%>', urlencode(''), $templateCode);
		$templateCode = str_replace('<%%CHECKED(acepto)%%>', '', $templateCode);
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

	$templateCode .= "\tid_perfil_update_autofills$rnd1 = function() {\n";
	$templateCode .= "\t\t\$j.ajax({\n";
	if($dvprint) {
		$templateCode .= "\t\t\turl: 'consentimieto_autofill.php?rnd1=$rnd1&mfk=id_perfil&id=' + encodeURIComponent('".addslashes($row['id_perfil'])."'),\n";
		$templateCode .= "\t\t\tcontentType: 'application/x-www-form-urlencoded; charset=" . datalist_db_encoding . "',\n";
		$templateCode .= "\t\t\ttype: 'GET'\n";
	} else {
		$templateCode .= "\t\t\turl: 'consentimieto_autofill.php?rnd1=$rnd1&mfk=id_perfil&id=' + encodeURIComponent(AppGini.current_id_perfil{$rnd1}.value),\n";
		$templateCode .= "\t\t\tcontentType: 'application/x-www-form-urlencoded; charset=" . datalist_db_encoding . "',\n";
		$templateCode .= "\t\t\ttype: 'GET',\n";
		$templateCode .= "\t\t\tbeforeSend: function() { \$j('#id_perfil$rnd1').prop('disabled', true); \$j('#id_perfilLoading').html('<img src=loading.gif align=top>'); },\n";
		$templateCode .= "\t\t\tcomplete: function() { " . (($arrPerm[1] || (($arrPerm[3] == 1 && $ownerMemberID == getLoggedMemberID()) || ($arrPerm[3] == 2 && $ownerGroupID == getLoggedGroupID()) || $arrPerm[3] == 3)) ? "\$j('#id_perfil$rnd1').prop('disabled', false); " : "\$j('#id_perfil$rnd1').prop('disabled', true); ")."\$j('#id_perfilLoading').html(''); \$j(window).resize(); }\n";
	}
	$templateCode .= "\t\t});\n";
	$templateCode .= "\t};\n";
	if(!$dvprint) $templateCode .= "\tif(\$j('#id_perfil_caption').length) \$j('#id_perfil_caption').click(function() { id_perfil_update_autofills$rnd1(); });\n";


	$templateCode.="});";
	$templateCode.="</script>";
	$templateCode .= $lookups;

	// handle enforced parent values for read-only lookup fields
	if( $_REQUEST['FilterField'][1]=='2' && $_REQUEST['FilterOperator'][1]=='<=>') {
		$templateCode.="\n<input type=hidden name=id_perfil value=\"" . html_attr($_REQUEST['FilterValue'][1]) . "\">\n";
	}

	// don't include blank images in lightbox gallery
	$templateCode = preg_replace('/blank.gif" data-lightbox=".*?"/', 'blank.gif"', $templateCode);

	// don't display empty email links
	$templateCode=preg_replace('/<a .*?href="mailto:".*?<\/a>/', '', $templateCode);

	/* default field values */
	$rdata = $jdata = get_defaults('consentimieto');
	if($selected_id) {
		$jdata = get_joined_record('consentimieto', $selected_id);
		if($jdata === false) $jdata = get_defaults('consentimieto');
		$rdata = $row;
	}
	$templateCode .= loadView('consentimieto-ajax-cache', array('rdata' => $rdata, 'jdata' => $jdata));

	// hook: consentimieto_dv
	if(function_exists('consentimieto_dv')) {
		$args=[];
		consentimieto_dv(($selected_id ? $selected_id : FALSE), getMemberInfo(), $templateCode, $args);
	}

	return $templateCode;
}