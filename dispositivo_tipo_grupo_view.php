<?php
// This script and data application were generated by AppGini 5.97
// Download AppGini for free from https://bigprof.com/appgini/download/

	$currDir = dirname(__FILE__);
	include_once("{$currDir}/lib.php");
	@include_once("{$currDir}/hooks/dispositivo_tipo_grupo.php");
	include_once("{$currDir}/dispositivo_tipo_grupo_dml.php");

	// mm: can the current member access this page?
	$perm = getTablePermissions('dispositivo_tipo_grupo');
	if(!$perm['access']) {
		echo error_message($Translation['tableAccessDenied']);
		exit;
	}

	$x = new DataList;
	$x->TableName = 'dispositivo_tipo_grupo';

	// Fields that can be displayed in the table view
	$x->QueryFieldsTV = [
		"`dispositivo_tipo_grupo`.`id`" => "id",
		"`dispositivo_tipo_grupo`.`grupo`" => "grupo",
		"`dispositivo_tipo_grupo`.`descripcion`" => "descripcion",
	];
	// mapping incoming sort by requests to actual query fields
	$x->SortFields = [
		1 => '`dispositivo_tipo_grupo`.`id`',
		2 => 2,
		3 => 3,
	];

	// Fields that can be displayed in the csv file
	$x->QueryFieldsCSV = [
		"`dispositivo_tipo_grupo`.`id`" => "id",
		"`dispositivo_tipo_grupo`.`grupo`" => "grupo",
		"`dispositivo_tipo_grupo`.`descripcion`" => "descripcion",
	];
	// Fields that can be filtered
	$x->QueryFieldsFilters = [
		"`dispositivo_tipo_grupo`.`id`" => "ID",
		"`dispositivo_tipo_grupo`.`grupo`" => "Grupo del dispositivo",
		"`dispositivo_tipo_grupo`.`descripcion`" => "Descripcion",
	];

	// Fields that can be quick searched
	$x->QueryFieldsQS = [
		"`dispositivo_tipo_grupo`.`id`" => "id",
		"`dispositivo_tipo_grupo`.`grupo`" => "grupo",
		"`dispositivo_tipo_grupo`.`descripcion`" => "descripcion",
	];

	// Lookup fields that can be used as filterers
	$x->filterers = [];

	$x->QueryFrom = "`dispositivo_tipo_grupo` ";
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
	$x->AllowFilters = (getLoggedAdmin() !== false);
	$x->AllowSavingFilters = (getLoggedAdmin() !== false);
	$x->AllowSorting = 1;
	$x->AllowNavigation = 1;
	$x->AllowPrinting = 1;
	$x->AllowPrintingDV = 1;
	$x->AllowCSV = 1;
	$x->RecordsPerPage = 10;
	$x->QuickSearch = 1;
	$x->QuickSearchText = $Translation['quick search'];
	$x->ScriptFileName = 'dispositivo_tipo_grupo_view.php';
	$x->RedirectAfterInsert = 'dispositivo_tipo_grupo_view.php?SelectedID=#ID#';
	$x->TableTitle = 'Grupo del dispositivo';
	$x->TableIcon = 'resources/table_icons/cog_add.png';
	$x->PrimaryKey = '`dispositivo_tipo_grupo`.`id`';

	$x->ColWidth = [150, 150, ];
	$x->ColCaption = ['Grupo del dispositivo', 'Descripcion', ];
	$x->ColFieldName = ['grupo', 'descripcion', ];
	$x->ColNumber  = [2, 3, ];

	// template paths below are based on the app main directory
	$x->Template = 'templates/dispositivo_tipo_grupo_templateTV.html';
	$x->SelectedTemplate = 'templates/dispositivo_tipo_grupo_templateTVS.html';
	$x->TemplateDV = 'templates/dispositivo_tipo_grupo_templateDV.html';
	$x->TemplateDVP = 'templates/dispositivo_tipo_grupo_templateDVP.html';

	$x->ShowTableHeader = 1;
	$x->TVClasses = "";
	$x->DVClasses = "";
	$x->HasCalculatedFields = false;
	$x->AllowConsoleLog = false;
	$x->AllowDVNavigation = true;

	// hook: dispositivo_tipo_grupo_init
	$render = true;
	if(function_exists('dispositivo_tipo_grupo_init')) {
		$args = [];
		$render = dispositivo_tipo_grupo_init($x, getMemberInfo(), $args);
	}

	if($render) $x->Render();

	// hook: dispositivo_tipo_grupo_header
	$headerCode = '';
	if(function_exists('dispositivo_tipo_grupo_header')) {
		$args = [];
		$headerCode = dispositivo_tipo_grupo_header($x->ContentType, getMemberInfo(), $args);
	}

	if(!$headerCode) {
		include_once("{$currDir}/header.php"); 
	} else {
		ob_start();
		include_once("{$currDir}/header.php");
		echo str_replace('<%%HEADER%%>', ob_get_clean(), $headerCode);
	}

	echo $x->HTML;

	// hook: dispositivo_tipo_grupo_footer
	$footerCode = '';
	if(function_exists('dispositivo_tipo_grupo_footer')) {
		$args = [];
		$footerCode = dispositivo_tipo_grupo_footer($x->ContentType, getMemberInfo(), $args);
	}

	if(!$footerCode) {
		include_once("{$currDir}/footer.php"); 
	} else {
		ob_start();
		include_once("{$currDir}/footer.php");
		echo str_replace('<%%FOOTER%%>', ob_get_clean(), $footerCode);
	}
