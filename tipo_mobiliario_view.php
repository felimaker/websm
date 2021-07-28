<?php
// This script and data application were generated by AppGini 5.97
// Download AppGini for free from https://bigprof.com/appgini/download/

	$currDir = dirname(__FILE__);
	include_once("{$currDir}/lib.php");
	@include_once("{$currDir}/hooks/tipo_mobiliario.php");
	include_once("{$currDir}/tipo_mobiliario_dml.php");

	// mm: can the current member access this page?
	$perm = getTablePermissions('tipo_mobiliario');
	if(!$perm['access']) {
		echo error_message($Translation['tableAccessDenied']);
		exit;
	}

	$x = new DataList;
	$x->TableName = 'tipo_mobiliario';

	// Fields that can be displayed in the table view
	$x->QueryFieldsTV = [
		"`tipo_mobiliario`.`id`" => "id",
		"IF(    CHAR_LENGTH(`tipo_grupo_mobilia1`.`grupo`), CONCAT_WS('',   `tipo_grupo_mobilia1`.`grupo`), '') /* Grupo mobiliario */" => "grupo_mobi",
		"`tipo_mobiliario`.`tipo_mobiliario`" => "tipo_mobiliario",
		"`tipo_mobiliario`.`caracteristicas`" => "caracteristicas",
	];
	// mapping incoming sort by requests to actual query fields
	$x->SortFields = [
		1 => '`tipo_mobiliario`.`id`',
		2 => '`tipo_grupo_mobilia1`.`grupo`',
		3 => 3,
		4 => 4,
	];

	// Fields that can be displayed in the csv file
	$x->QueryFieldsCSV = [
		"`tipo_mobiliario`.`id`" => "id",
		"IF(    CHAR_LENGTH(`tipo_grupo_mobilia1`.`grupo`), CONCAT_WS('',   `tipo_grupo_mobilia1`.`grupo`), '') /* Grupo mobiliario */" => "grupo_mobi",
		"`tipo_mobiliario`.`tipo_mobiliario`" => "tipo_mobiliario",
		"`tipo_mobiliario`.`caracteristicas`" => "caracteristicas",
	];
	// Fields that can be filtered
	$x->QueryFieldsFilters = [
		"`tipo_mobiliario`.`id`" => "ID",
		"IF(    CHAR_LENGTH(`tipo_grupo_mobilia1`.`grupo`), CONCAT_WS('',   `tipo_grupo_mobilia1`.`grupo`), '') /* Grupo mobiliario */" => "Grupo mobiliario",
		"`tipo_mobiliario`.`tipo_mobiliario`" => "Tipo de mobiliario",
		"`tipo_mobiliario`.`caracteristicas`" => "Caracteristicas",
	];

	// Fields that can be quick searched
	$x->QueryFieldsQS = [
		"`tipo_mobiliario`.`id`" => "id",
		"IF(    CHAR_LENGTH(`tipo_grupo_mobilia1`.`grupo`), CONCAT_WS('',   `tipo_grupo_mobilia1`.`grupo`), '') /* Grupo mobiliario */" => "grupo_mobi",
		"`tipo_mobiliario`.`tipo_mobiliario`" => "tipo_mobiliario",
		"`tipo_mobiliario`.`caracteristicas`" => "caracteristicas",
	];

	// Lookup fields that can be used as filterers
	$x->filterers = ['grupo_mobi' => 'Grupo mobiliario', ];

	$x->QueryFrom = "`tipo_mobiliario` LEFT JOIN `tipo_grupo_mobilia` as tipo_grupo_mobilia1 ON `tipo_grupo_mobilia1`.`id_gru_mo`=`tipo_mobiliario`.`grupo_mobi` ";
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
	$x->ScriptFileName = 'tipo_mobiliario_view.php';
	$x->RedirectAfterInsert = 'tipo_mobiliario_view.php?SelectedID=#ID#';
	$x->TableTitle = 'Tipo de Mobiliario';
	$x->TableIcon = 'resources/table_icons/cog_add.png';
	$x->PrimaryKey = '`tipo_mobiliario`.`id`';

	$x->ColWidth = [150, 150, 150, ];
	$x->ColCaption = ['Grupo mobiliario', 'Tipo de mobiliario', 'Caracteristicas', ];
	$x->ColFieldName = ['grupo_mobi', 'tipo_mobiliario', 'caracteristicas', ];
	$x->ColNumber  = [2, 3, 4, ];

	// template paths below are based on the app main directory
	$x->Template = 'templates/tipo_mobiliario_templateTV.html';
	$x->SelectedTemplate = 'templates/tipo_mobiliario_templateTVS.html';
	$x->TemplateDV = 'templates/tipo_mobiliario_templateDV.html';
	$x->TemplateDVP = 'templates/tipo_mobiliario_templateDVP.html';

	$x->ShowTableHeader = 1;
	$x->TVClasses = "";
	$x->DVClasses = "";
	$x->HasCalculatedFields = false;
	$x->AllowConsoleLog = false;
	$x->AllowDVNavigation = true;

	// hook: tipo_mobiliario_init
	$render = true;
	if(function_exists('tipo_mobiliario_init')) {
		$args = [];
		$render = tipo_mobiliario_init($x, getMemberInfo(), $args);
	}

	if($render) $x->Render();

	// hook: tipo_mobiliario_header
	$headerCode = '';
	if(function_exists('tipo_mobiliario_header')) {
		$args = [];
		$headerCode = tipo_mobiliario_header($x->ContentType, getMemberInfo(), $args);
	}

	if(!$headerCode) {
		include_once("{$currDir}/header.php"); 
	} else {
		ob_start();
		include_once("{$currDir}/header.php");
		echo str_replace('<%%HEADER%%>', ob_get_clean(), $headerCode);
	}

	echo $x->HTML;

	// hook: tipo_mobiliario_footer
	$footerCode = '';
	if(function_exists('tipo_mobiliario_footer')) {
		$args = [];
		$footerCode = tipo_mobiliario_footer($x->ContentType, getMemberInfo(), $args);
	}

	if(!$footerCode) {
		include_once("{$currDir}/footer.php"); 
	} else {
		ob_start();
		include_once("{$currDir}/footer.php");
		echo str_replace('<%%FOOTER%%>', ob_get_clean(), $footerCode);
	}
