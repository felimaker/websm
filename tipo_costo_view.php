<?php
// This script and data application were generated by AppGini 5.97
// Download AppGini for free from https://bigprof.com/appgini/download/

	$currDir = dirname(__FILE__);
	include_once("{$currDir}/lib.php");
	@include_once("{$currDir}/hooks/tipo_costo.php");
	include_once("{$currDir}/tipo_costo_dml.php");

	// mm: can the current member access this page?
	$perm = getTablePermissions('tipo_costo');
	if(!$perm['access']) {
		echo error_message($Translation['tableAccessDenied']);
		exit;
	}

	$x = new DataList;
	$x->TableName = 'tipo_costo';

	// Fields that can be displayed in the table view
	$x->QueryFieldsTV = [
		"`tipo_costo`.`id`" => "id",
		"`tipo_costo`.`tipo_costo`" => "tipo_costo",
		"`tipo_costo`.`descripcion`" => "descripcion",
	];
	// mapping incoming sort by requests to actual query fields
	$x->SortFields = [
		1 => '`tipo_costo`.`id`',
		2 => 2,
		3 => 3,
	];

	// Fields that can be displayed in the csv file
	$x->QueryFieldsCSV = [
		"`tipo_costo`.`id`" => "id",
		"`tipo_costo`.`tipo_costo`" => "tipo_costo",
		"`tipo_costo`.`descripcion`" => "descripcion",
	];
	// Fields that can be filtered
	$x->QueryFieldsFilters = [
		"`tipo_costo`.`id`" => "ID",
		"`tipo_costo`.`tipo_costo`" => "Tipo costo",
		"`tipo_costo`.`descripcion`" => "Descripcion",
	];

	// Fields that can be quick searched
	$x->QueryFieldsQS = [
		"`tipo_costo`.`id`" => "id",
		"`tipo_costo`.`tipo_costo`" => "tipo_costo",
		"`tipo_costo`.`descripcion`" => "descripcion",
	];

	// Lookup fields that can be used as filterers
	$x->filterers = [];

	$x->QueryFrom = "`tipo_costo` ";
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
	$x->ScriptFileName = 'tipo_costo_view.php';
	$x->RedirectAfterInsert = 'tipo_costo_view.php?SelectedID=#ID#';
	$x->TableTitle = 'Tipo costo';
	$x->TableIcon = 'resources/table_icons/cog_add.png';
	$x->PrimaryKey = '`tipo_costo`.`id`';

	$x->ColWidth = [150, 150, ];
	$x->ColCaption = ['Tipo costo', 'Descripcion', ];
	$x->ColFieldName = ['tipo_costo', 'descripcion', ];
	$x->ColNumber  = [2, 3, ];

	// template paths below are based on the app main directory
	$x->Template = 'templates/tipo_costo_templateTV.html';
	$x->SelectedTemplate = 'templates/tipo_costo_templateTVS.html';
	$x->TemplateDV = 'templates/tipo_costo_templateDV.html';
	$x->TemplateDVP = 'templates/tipo_costo_templateDVP.html';

	$x->ShowTableHeader = 1;
	$x->TVClasses = "";
	$x->DVClasses = "";
	$x->HasCalculatedFields = false;
	$x->AllowConsoleLog = false;
	$x->AllowDVNavigation = true;

	// hook: tipo_costo_init
	$render = true;
	if(function_exists('tipo_costo_init')) {
		$args = [];
		$render = tipo_costo_init($x, getMemberInfo(), $args);
	}

	if($render) $x->Render();

	// hook: tipo_costo_header
	$headerCode = '';
	if(function_exists('tipo_costo_header')) {
		$args = [];
		$headerCode = tipo_costo_header($x->ContentType, getMemberInfo(), $args);
	}

	if(!$headerCode) {
		include_once("{$currDir}/header.php"); 
	} else {
		ob_start();
		include_once("{$currDir}/header.php");
		echo str_replace('<%%HEADER%%>', ob_get_clean(), $headerCode);
	}

	echo $x->HTML;

	// hook: tipo_costo_footer
	$footerCode = '';
	if(function_exists('tipo_costo_footer')) {
		$args = [];
		$footerCode = tipo_costo_footer($x->ContentType, getMemberInfo(), $args);
	}

	if(!$footerCode) {
		include_once("{$currDir}/footer.php"); 
	} else {
		ob_start();
		include_once("{$currDir}/footer.php");
		echo str_replace('<%%FOOTER%%>', ob_get_clean(), $footerCode);
	}
