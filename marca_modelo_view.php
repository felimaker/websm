<?php
// This script and data application were generated by AppGini 5.97
// Download AppGini for free from https://bigprof.com/appgini/download/

	$currDir = dirname(__FILE__);
	include_once("{$currDir}/lib.php");
	@include_once("{$currDir}/hooks/marca_modelo.php");
	include_once("{$currDir}/marca_modelo_dml.php");

	// mm: can the current member access this page?
	$perm = getTablePermissions('marca_modelo');
	if(!$perm['access']) {
		echo error_message($Translation['tableAccessDenied']);
		exit;
	}

	$x = new DataList;
	$x->TableName = 'marca_modelo';

	// Fields that can be displayed in the table view
	$x->QueryFieldsTV = [
		"`marca_modelo`.`id_mmodelo`" => "id_mmodelo",
		"IF(    CHAR_LENGTH(`marcas1`.`marca`), CONCAT_WS('',   `marcas1`.`marca`), '') /* Marca */" => "marca",
		"`marca_modelo`.`modelo`" => "modelo",
		"`marca_modelo`.`img`" => "img",
		"`marca_modelo`.`fabricante`" => "fabricante",
		"`marca_modelo`.`descripcion`" => "descripcion",
		"if(`marca_modelo`.`creado`,date_format(`marca_modelo`.`creado`,'%d/%m/%Y %h:%i %p'),'')" => "creado",
		"`marca_modelo`.`creado_por`" => "creado_por",
	];
	// mapping incoming sort by requests to actual query fields
	$x->SortFields = [
		1 => '`marca_modelo`.`id_mmodelo`',
		2 => '`marcas1`.`marca`',
		3 => 3,
		4 => 4,
		5 => 5,
		6 => 6,
		7 => '`marca_modelo`.`creado`',
		8 => 8,
	];

	// Fields that can be displayed in the csv file
	$x->QueryFieldsCSV = [
		"`marca_modelo`.`id_mmodelo`" => "id_mmodelo",
		"IF(    CHAR_LENGTH(`marcas1`.`marca`), CONCAT_WS('',   `marcas1`.`marca`), '') /* Marca */" => "marca",
		"`marca_modelo`.`modelo`" => "modelo",
		"`marca_modelo`.`img`" => "img",
		"`marca_modelo`.`fabricante`" => "fabricante",
		"`marca_modelo`.`descripcion`" => "descripcion",
		"if(`marca_modelo`.`creado`,date_format(`marca_modelo`.`creado`,'%d/%m/%Y %h:%i %p'),'')" => "creado",
		"`marca_modelo`.`creado_por`" => "creado_por",
	];
	// Fields that can be filtered
	$x->QueryFieldsFilters = [
		"`marca_modelo`.`id_mmodelo`" => "ID",
		"IF(    CHAR_LENGTH(`marcas1`.`marca`), CONCAT_WS('',   `marcas1`.`marca`), '') /* Marca */" => "Marca",
		"`marca_modelo`.`modelo`" => "Modelo",
		"`marca_modelo`.`fabricante`" => "Fabricante",
		"`marca_modelo`.`descripcion`" => "Descripcion",
		"`marca_modelo`.`creado`" => "Creado",
		"`marca_modelo`.`creado_por`" => "Creado por",
	];

	// Fields that can be quick searched
	$x->QueryFieldsQS = [
		"`marca_modelo`.`id_mmodelo`" => "id_mmodelo",
		"IF(    CHAR_LENGTH(`marcas1`.`marca`), CONCAT_WS('',   `marcas1`.`marca`), '') /* Marca */" => "marca",
		"`marca_modelo`.`modelo`" => "modelo",
		"`marca_modelo`.`fabricante`" => "fabricante",
		"`marca_modelo`.`descripcion`" => "descripcion",
		"if(`marca_modelo`.`creado`,date_format(`marca_modelo`.`creado`,'%d/%m/%Y %h:%i %p'),'')" => "creado",
		"`marca_modelo`.`creado_por`" => "creado_por",
	];

	// Lookup fields that can be used as filterers
	$x->filterers = ['marca' => 'Marca', ];

	$x->QueryFrom = "`marca_modelo` LEFT JOIN `marcas` as marcas1 ON `marcas1`.`id_marca`=`marca_modelo`.`marca` ";
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
	$x->AllowCSV = (getLoggedAdmin() !== false);
	$x->RecordsPerPage = 10;
	$x->QuickSearch = 1;
	$x->QuickSearchText = $Translation['quick search'];
	$x->ScriptFileName = 'marca_modelo_view.php';
	$x->RedirectAfterInsert = 'marca_modelo_view.php?SelectedID=#ID#';
	$x->TableTitle = 'Marca y Modelo';
	$x->TableIcon = 'resources/table_icons/ebay.png';
	$x->PrimaryKey = '`marca_modelo`.`id_mmodelo`';
	$x->DefaultSortField = '`marca_modelo`.`creado`';
	$x->DefaultSortDirection = 'desc';

	$x->ColWidth = [150, 150, 150, 150, 150, 150, ];
	$x->ColCaption = ['Marca', 'Modelo', 'Imagen', 'Fabricante', 'Descripcion', 'Creado', ];
	$x->ColFieldName = ['marca', 'modelo', 'img', 'fabricante', 'descripcion', 'creado', ];
	$x->ColNumber  = [2, 3, 4, 5, 6, 7, ];

	// template paths below are based on the app main directory
	$x->Template = 'templates/marca_modelo_templateTV.html';
	$x->SelectedTemplate = 'templates/marca_modelo_templateTVS.html';
	$x->TemplateDV = 'templates/marca_modelo_templateDV.html';
	$x->TemplateDVP = 'templates/marca_modelo_templateDVP.html';

	$x->ShowTableHeader = 1;
	$x->TVClasses = "";
	$x->DVClasses = "";
	$x->HasCalculatedFields = false;
	$x->AllowConsoleLog = false;
	$x->AllowDVNavigation = true;

	// hook: marca_modelo_init
	$render = true;
	if(function_exists('marca_modelo_init')) {
		$args = [];
		$render = marca_modelo_init($x, getMemberInfo(), $args);
	}

	if($render) $x->Render();

	// hook: marca_modelo_header
	$headerCode = '';
	if(function_exists('marca_modelo_header')) {
		$args = [];
		$headerCode = marca_modelo_header($x->ContentType, getMemberInfo(), $args);
	}

	if(!$headerCode) {
		include_once("{$currDir}/header.php"); 
	} else {
		ob_start();
		include_once("{$currDir}/header.php");
		echo str_replace('<%%HEADER%%>', ob_get_clean(), $headerCode);
	}

	echo $x->HTML;

	// hook: marca_modelo_footer
	$footerCode = '';
	if(function_exists('marca_modelo_footer')) {
		$args = [];
		$footerCode = marca_modelo_footer($x->ContentType, getMemberInfo(), $args);
	}

	if(!$footerCode) {
		include_once("{$currDir}/footer.php"); 
	} else {
		ob_start();
		include_once("{$currDir}/footer.php");
		echo str_replace('<%%FOOTER%%>', ob_get_clean(), $footerCode);
	}
