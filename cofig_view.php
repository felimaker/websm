<?php
// This script and data application were generated by AppGini 5.97
// Download AppGini for free from https://bigprof.com/appgini/download/

	$currDir = dirname(__FILE__);
	include_once("{$currDir}/lib.php");
	@include_once("{$currDir}/hooks/cofig.php");
	include_once("{$currDir}/cofig_dml.php");

	// mm: can the current member access this page?
	$perm = getTablePermissions('cofig');
	if(!$perm['access']) {
		echo error_message($Translation['tableAccessDenied']);
		exit;
	}

	$x = new DataList;
	$x->TableName = 'cofig';

	// Fields that can be displayed in the table view
	$x->QueryFieldsTV = [
		"`cofig`.`id`" => "id",
		"`cofig`.`dato1`" => "dato1",
		"`cofig`.`dato2`" => "dato2",
		"`cofig`.`descripcion`" => "descripcion",
	];
	// mapping incoming sort by requests to actual query fields
	$x->SortFields = [
		1 => '`cofig`.`id`',
		2 => 2,
		3 => 3,
		4 => 4,
	];

	// Fields that can be displayed in the csv file
	$x->QueryFieldsCSV = [
		"`cofig`.`id`" => "id",
		"`cofig`.`dato1`" => "dato1",
		"`cofig`.`dato2`" => "dato2",
		"`cofig`.`descripcion`" => "descripcion",
	];
	// Fields that can be filtered
	$x->QueryFieldsFilters = [
		"`cofig`.`id`" => "ID",
		"`cofig`.`dato1`" => "Dato1",
		"`cofig`.`dato2`" => "dato2",
		"`cofig`.`descripcion`" => "Descripcion",
	];

	// Fields that can be quick searched
	$x->QueryFieldsQS = [
		"`cofig`.`id`" => "id",
		"`cofig`.`dato1`" => "dato1",
		"`cofig`.`dato2`" => "dato2",
		"`cofig`.`descripcion`" => "descripcion",
	];

	// Lookup fields that can be used as filterers
	$x->filterers = [];

	$x->QueryFrom = "`cofig` ";
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
	$x->ScriptFileName = 'cofig_view.php';
	$x->RedirectAfterInsert = 'cofig_view.php?SelectedID=#ID#';
	$x->TableTitle = 'CONFIG';
	$x->TableIcon = 'resources/table_icons/cog_add.png';
	$x->PrimaryKey = '`cofig`.`id`';

	$x->ColWidth = [150, 150, 150, ];
	$x->ColCaption = ['Dato1', 'dato2', 'Descripcion', ];
	$x->ColFieldName = ['dato1', 'dato2', 'descripcion', ];
	$x->ColNumber  = [2, 3, 4, ];

	// template paths below are based on the app main directory
	$x->Template = 'templates/cofig_templateTV.html';
	$x->SelectedTemplate = 'templates/cofig_templateTVS.html';
	$x->TemplateDV = 'templates/cofig_templateDV.html';
	$x->TemplateDVP = 'templates/cofig_templateDVP.html';

	$x->ShowTableHeader = 1;
	$x->TVClasses = "";
	$x->DVClasses = "";
	$x->HasCalculatedFields = false;
	$x->AllowConsoleLog = false;
	$x->AllowDVNavigation = true;

	// hook: cofig_init
	$render = true;
	if(function_exists('cofig_init')) {
		$args = [];
		$render = cofig_init($x, getMemberInfo(), $args);
	}

	if($render) $x->Render();

	// hook: cofig_header
	$headerCode = '';
	if(function_exists('cofig_header')) {
		$args = [];
		$headerCode = cofig_header($x->ContentType, getMemberInfo(), $args);
	}

	if(!$headerCode) {
		include_once("{$currDir}/header.php"); 
	} else {
		ob_start();
		include_once("{$currDir}/header.php");
		echo str_replace('<%%HEADER%%>', ob_get_clean(), $headerCode);
	}

	echo $x->HTML;

	// hook: cofig_footer
	$footerCode = '';
	if(function_exists('cofig_footer')) {
		$args = [];
		$footerCode = cofig_footer($x->ContentType, getMemberInfo(), $args);
	}

	if(!$footerCode) {
		include_once("{$currDir}/footer.php"); 
	} else {
		ob_start();
		include_once("{$currDir}/footer.php");
		echo str_replace('<%%FOOTER%%>', ob_get_clean(), $footerCode);
	}
