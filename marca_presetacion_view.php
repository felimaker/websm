<?php
// This script and data application were generated by AppGini 5.97
// Download AppGini for free from https://bigprof.com/appgini/download/

	$currDir = dirname(__FILE__);
	include_once("{$currDir}/lib.php");
	@include_once("{$currDir}/hooks/marca_presetacion.php");
	include_once("{$currDir}/marca_presetacion_dml.php");

	// mm: can the current member access this page?
	$perm = getTablePermissions('marca_presetacion');
	if(!$perm['access']) {
		echo error_message($Translation['tableAccessDenied']);
		exit;
	}

	$x = new DataList;
	$x->TableName = 'marca_presetacion';

	// Fields that can be displayed in the table view
	$x->QueryFieldsTV = [
		"`marca_presetacion`.`id`" => "id",
		"IF(    CHAR_LENGTH(`marcas1`.`marca`), CONCAT_WS('',   `marcas1`.`marca`), '') /* Marca */" => "marca",
		"IF(    CHAR_LENGTH(`tipo_unidad_medida1`.`unidad`), CONCAT_WS('',   `tipo_unidad_medida1`.`unidad`), '') /* Unidad medida */" => "unidad_medida",
		"`marca_presetacion`.`presentacion`" => "presentacion",
	];
	// mapping incoming sort by requests to actual query fields
	$x->SortFields = [
		1 => '`marca_presetacion`.`id`',
		2 => '`marcas1`.`marca`',
		3 => '`tipo_unidad_medida1`.`unidad`',
		4 => 4,
	];

	// Fields that can be displayed in the csv file
	$x->QueryFieldsCSV = [
		"`marca_presetacion`.`id`" => "id",
		"IF(    CHAR_LENGTH(`marcas1`.`marca`), CONCAT_WS('',   `marcas1`.`marca`), '') /* Marca */" => "marca",
		"IF(    CHAR_LENGTH(`tipo_unidad_medida1`.`unidad`), CONCAT_WS('',   `tipo_unidad_medida1`.`unidad`), '') /* Unidad medida */" => "unidad_medida",
		"`marca_presetacion`.`presentacion`" => "presentacion",
	];
	// Fields that can be filtered
	$x->QueryFieldsFilters = [
		"`marca_presetacion`.`id`" => "ID",
		"IF(    CHAR_LENGTH(`marcas1`.`marca`), CONCAT_WS('',   `marcas1`.`marca`), '') /* Marca */" => "Marca",
		"IF(    CHAR_LENGTH(`tipo_unidad_medida1`.`unidad`), CONCAT_WS('',   `tipo_unidad_medida1`.`unidad`), '') /* Unidad medida */" => "Unidad medida",
		"`marca_presetacion`.`presentacion`" => "Presentacion",
	];

	// Fields that can be quick searched
	$x->QueryFieldsQS = [
		"`marca_presetacion`.`id`" => "id",
		"IF(    CHAR_LENGTH(`marcas1`.`marca`), CONCAT_WS('',   `marcas1`.`marca`), '') /* Marca */" => "marca",
		"IF(    CHAR_LENGTH(`tipo_unidad_medida1`.`unidad`), CONCAT_WS('',   `tipo_unidad_medida1`.`unidad`), '') /* Unidad medida */" => "unidad_medida",
		"`marca_presetacion`.`presentacion`" => "presentacion",
	];

	// Lookup fields that can be used as filterers
	$x->filterers = ['marca' => 'Marca', 'unidad_medida' => 'Unidad medida', ];

	$x->QueryFrom = "`marca_presetacion` LEFT JOIN `marcas` as marcas1 ON `marcas1`.`id_marca`=`marca_presetacion`.`marca` LEFT JOIN `tipo_unidad_medida` as tipo_unidad_medida1 ON `tipo_unidad_medida1`.`id`=`marca_presetacion`.`unidad_medida` ";
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
	$x->ScriptFileName = 'marca_presetacion_view.php';
	$x->RedirectAfterInsert = 'marca_presetacion_view.php?SelectedID=#ID#';
	$x->TableTitle = 'Marca presetacion';
	$x->TableIcon = 'resources/table_icons/cog_add.png';
	$x->PrimaryKey = '`marca_presetacion`.`id`';

	$x->ColWidth = [150, 150, 150, ];
	$x->ColCaption = ['Marca', 'Unidad medida', 'Presentacion', ];
	$x->ColFieldName = ['marca', 'unidad_medida', 'presentacion', ];
	$x->ColNumber  = [2, 3, 4, ];

	// template paths below are based on the app main directory
	$x->Template = 'templates/marca_presetacion_templateTV.html';
	$x->SelectedTemplate = 'templates/marca_presetacion_templateTVS.html';
	$x->TemplateDV = 'templates/marca_presetacion_templateDV.html';
	$x->TemplateDVP = 'templates/marca_presetacion_templateDVP.html';

	$x->ShowTableHeader = 1;
	$x->TVClasses = "";
	$x->DVClasses = "";
	$x->HasCalculatedFields = false;
	$x->AllowConsoleLog = false;
	$x->AllowDVNavigation = true;

	// hook: marca_presetacion_init
	$render = true;
	if(function_exists('marca_presetacion_init')) {
		$args = [];
		$render = marca_presetacion_init($x, getMemberInfo(), $args);
	}

	if($render) $x->Render();

	// hook: marca_presetacion_header
	$headerCode = '';
	if(function_exists('marca_presetacion_header')) {
		$args = [];
		$headerCode = marca_presetacion_header($x->ContentType, getMemberInfo(), $args);
	}

	if(!$headerCode) {
		include_once("{$currDir}/header.php"); 
	} else {
		ob_start();
		include_once("{$currDir}/header.php");
		echo str_replace('<%%HEADER%%>', ob_get_clean(), $headerCode);
	}

	echo $x->HTML;

	// hook: marca_presetacion_footer
	$footerCode = '';
	if(function_exists('marca_presetacion_footer')) {
		$args = [];
		$footerCode = marca_presetacion_footer($x->ContentType, getMemberInfo(), $args);
	}

	if(!$footerCode) {
		include_once("{$currDir}/footer.php"); 
	} else {
		ob_start();
		include_once("{$currDir}/footer.php");
		echo str_replace('<%%FOOTER%%>', ob_get_clean(), $footerCode);
	}
