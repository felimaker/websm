<?php
// This script and data application were generated by AppGini 5.97
// Download AppGini for free from https://bigprof.com/appgini/download/

	$currDir = dirname(__FILE__);
	include_once("{$currDir}/lib.php");
	@include_once("{$currDir}/hooks/financiero.php");
	include_once("{$currDir}/financiero_dml.php");

	// mm: can the current member access this page?
	$perm = getTablePermissions('financiero');
	if(!$perm['access']) {
		echo error_message($Translation['tableAccessDenied']);
		exit;
	}

	$x = new DataList;
	$x->TableName = 'financiero';

	// Fields that can be displayed in the table view
	$x->QueryFieldsTV = [
		"`financiero`.`id`" => "id",
		"IF(    CHAR_LENGTH(`dispositivos1`.`id_dispo`), CONCAT_WS('',   `dispositivos1`.`id_dispo`), '') /* Id dispo */" => "id_dispo",
		"`financiero`.`precio`" => "precio",
		"IF(    CHAR_LENGTH(`unidades1`.`nombre`), CONCAT_WS('',   `unidades1`.`nombre`), '') /* Unidad */" => "unidad",
		"`financiero`.`enlace`" => "enlace",
		"if(`financiero`.`creado`,date_format(`financiero`.`creado`,'%d/%m/%Y %h:%i %p'),'')" => "creado",
		"`financiero`.`creado_por`" => "creado_por",
		"if(`financiero`.`editado`,date_format(`financiero`.`editado`,'%d/%m/%Y %h:%i %p'),'')" => "editado",
		"`financiero`.`editado_por`" => "editado_por",
	];
	// mapping incoming sort by requests to actual query fields
	$x->SortFields = [
		1 => '`financiero`.`id`',
		2 => '`dispositivos1`.`id_dispo`',
		3 => '`financiero`.`precio`',
		4 => 4,
		5 => 5,
		6 => '`financiero`.`creado`',
		7 => 7,
		8 => '`financiero`.`editado`',
		9 => 9,
	];

	// Fields that can be displayed in the csv file
	$x->QueryFieldsCSV = [
		"`financiero`.`id`" => "id",
		"IF(    CHAR_LENGTH(`dispositivos1`.`id_dispo`), CONCAT_WS('',   `dispositivos1`.`id_dispo`), '') /* Id dispo */" => "id_dispo",
		"`financiero`.`precio`" => "precio",
		"IF(    CHAR_LENGTH(`unidades1`.`nombre`), CONCAT_WS('',   `unidades1`.`nombre`), '') /* Unidad */" => "unidad",
		"`financiero`.`enlace`" => "enlace",
		"if(`financiero`.`creado`,date_format(`financiero`.`creado`,'%d/%m/%Y %h:%i %p'),'')" => "creado",
		"`financiero`.`creado_por`" => "creado_por",
		"if(`financiero`.`editado`,date_format(`financiero`.`editado`,'%d/%m/%Y %h:%i %p'),'')" => "editado",
		"`financiero`.`editado_por`" => "editado_por",
	];
	// Fields that can be filtered
	$x->QueryFieldsFilters = [
		"`financiero`.`id`" => "ID",
		"IF(    CHAR_LENGTH(`dispositivos1`.`id_dispo`), CONCAT_WS('',   `dispositivos1`.`id_dispo`), '') /* Id dispo */" => "Id dispo",
		"`financiero`.`precio`" => "Precio",
		"IF(    CHAR_LENGTH(`unidades1`.`nombre`), CONCAT_WS('',   `unidades1`.`nombre`), '') /* Unidad */" => "Unidad",
		"`financiero`.`enlace`" => "Enlace",
		"`financiero`.`creado`" => "Creado",
		"`financiero`.`creado_por`" => "Creado por",
		"`financiero`.`editado`" => "Editado",
		"`financiero`.`editado_por`" => "Editado por",
	];

	// Fields that can be quick searched
	$x->QueryFieldsQS = [
		"`financiero`.`id`" => "id",
		"IF(    CHAR_LENGTH(`dispositivos1`.`id_dispo`), CONCAT_WS('',   `dispositivos1`.`id_dispo`), '') /* Id dispo */" => "id_dispo",
		"`financiero`.`precio`" => "precio",
		"IF(    CHAR_LENGTH(`unidades1`.`nombre`), CONCAT_WS('',   `unidades1`.`nombre`), '') /* Unidad */" => "unidad",
		"`financiero`.`enlace`" => "enlace",
		"if(`financiero`.`creado`,date_format(`financiero`.`creado`,'%d/%m/%Y %h:%i %p'),'')" => "creado",
		"`financiero`.`creado_por`" => "creado_por",
		"if(`financiero`.`editado`,date_format(`financiero`.`editado`,'%d/%m/%Y %h:%i %p'),'')" => "editado",
		"`financiero`.`editado_por`" => "editado_por",
	];

	// Lookup fields that can be used as filterers
	$x->filterers = ['id_dispo' => 'Id dispo', ];

	$x->QueryFrom = "`financiero` LEFT JOIN `dispositivos` as dispositivos1 ON `dispositivos1`.`id_dispo`=`financiero`.`id_dispo` LEFT JOIN `unidades` as unidades1 ON `unidades1`.`id_unidades`=`dispositivos1`.`ubicacion` ";
	$x->QueryWhere = '';
	$x->QueryOrder = '';

	$x->AllowSelection = 1;
	$x->HideTableView = ($perm['view'] == 0 ? 1 : 0);
	$x->AllowDelete = $perm['delete'];
	$x->AllowMassDelete = (getLoggedAdmin() !== false);
	$x->AllowInsert = $perm['insert'];
	$x->AllowUpdate = $perm['edit'];
	$x->SeparateDV = 1;
	$x->AllowDeleteOfParents = 0;
	$x->AllowFilters = 1;
	$x->AllowSavingFilters = (getLoggedAdmin() !== false);
	$x->AllowSorting = 1;
	$x->AllowNavigation = 1;
	$x->AllowPrinting = 1;
	$x->AllowPrintingDV = 1;
	$x->AllowCSV = 1;
	$x->RecordsPerPage = 10;
	$x->QuickSearch = 1;
	$x->QuickSearchText = $Translation['quick search'];
	$x->ScriptFileName = 'financiero_view.php';
	$x->RedirectAfterInsert = 'financiero_view.php?SelectedID=#ID#';
	$x->TableTitle = 'Financiero D';
	$x->TableIcon = 'resources/table_icons/coins.png';
	$x->PrimaryKey = '`financiero`.`id`';
	$x->DefaultSortField = '`financiero`.`creado`';
	$x->DefaultSortDirection = 'desc';

	$x->ColWidth = [150, 150, 150, 150, 150, ];
	$x->ColCaption = ['Id dispo', 'Precio', 'Unidad', 'Enlace', 'Creado', ];
	$x->ColFieldName = ['id_dispo', 'precio', 'unidad', 'enlace', 'creado', ];
	$x->ColNumber  = [2, 3, 4, 5, 6, ];

	// template paths below are based on the app main directory
	$x->Template = 'templates/financiero_templateTV.html';
	$x->SelectedTemplate = 'templates/financiero_templateTVS.html';
	$x->TemplateDV = 'templates/financiero_templateDV.html';
	$x->TemplateDVP = 'templates/financiero_templateDVP.html';

	$x->ShowTableHeader = 1;
	$x->TVClasses = "";
	$x->DVClasses = "";
	$x->HasCalculatedFields = false;
	$x->AllowConsoleLog = false;
	$x->AllowDVNavigation = true;

	// hook: financiero_init
	$render = true;
	if(function_exists('financiero_init')) {
		$args = [];
		$render = financiero_init($x, getMemberInfo(), $args);
	}

	if($render) $x->Render();

	// hook: financiero_header
	$headerCode = '';
	if(function_exists('financiero_header')) {
		$args = [];
		$headerCode = financiero_header($x->ContentType, getMemberInfo(), $args);
	}

	if(!$headerCode) {
		include_once("{$currDir}/header.php"); 
	} else {
		ob_start();
		include_once("{$currDir}/header.php");
		echo str_replace('<%%HEADER%%>', ob_get_clean(), $headerCode);
	}

	echo $x->HTML;

	// hook: financiero_footer
	$footerCode = '';
	if(function_exists('financiero_footer')) {
		$args = [];
		$footerCode = financiero_footer($x->ContentType, getMemberInfo(), $args);
	}

	if(!$footerCode) {
		include_once("{$currDir}/footer.php"); 
	} else {
		ob_start();
		include_once("{$currDir}/footer.php");
		echo str_replace('<%%FOOTER%%>', ob_get_clean(), $footerCode);
	}
