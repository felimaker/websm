<?php
// This script and data application were generated by AppGini 5.97
// Download AppGini for free from https://bigprof.com/appgini/download/

	$currDir = dirname(__FILE__);
	include_once("{$currDir}/lib.php");
	@include_once("{$currDir}/hooks/progreso.php");
	include_once("{$currDir}/progreso_dml.php");

	// mm: can the current member access this page?
	$perm = getTablePermissions('progreso');
	if(!$perm['access']) {
		echo error_message($Translation['tableAccessDenied']);
		exit;
	}

	$x = new DataList;
	$x->TableName = 'progreso';

	// Fields that can be displayed in the table view
	$x->QueryFieldsTV = [
		"`progreso`.`id`" => "id",
		"IF(    CHAR_LENGTH(`observaciones1`.`id`), CONCAT_WS('',   `observaciones1`.`id`), '') /* Id observacion */" => "id_observacion",
		"IF(    CHAR_LENGTH(`tipo_estado_observaciones1`.`estado_observa`), CONCAT_WS('',   `tipo_estado_observaciones1`.`estado_observa`), '') /* Estado seguimiento */" => "estado_seguimiento",
		"`progreso`.`descripcion`" => "descripcion",
		"if(`progreso`.`credo`,date_format(`progreso`.`credo`,'%d/%m/%Y %h:%i %p'),'')" => "credo",
		"`progreso`.`creado_por`" => "creado_por",
	];
	// mapping incoming sort by requests to actual query fields
	$x->SortFields = [
		1 => '`progreso`.`id`',
		2 => '`observaciones1`.`id`',
		3 => '`tipo_estado_observaciones1`.`estado_observa`',
		4 => 4,
		5 => '`progreso`.`credo`',
		6 => 6,
	];

	// Fields that can be displayed in the csv file
	$x->QueryFieldsCSV = [
		"`progreso`.`id`" => "id",
		"IF(    CHAR_LENGTH(`observaciones1`.`id`), CONCAT_WS('',   `observaciones1`.`id`), '') /* Id observacion */" => "id_observacion",
		"IF(    CHAR_LENGTH(`tipo_estado_observaciones1`.`estado_observa`), CONCAT_WS('',   `tipo_estado_observaciones1`.`estado_observa`), '') /* Estado seguimiento */" => "estado_seguimiento",
		"`progreso`.`descripcion`" => "descripcion",
		"if(`progreso`.`credo`,date_format(`progreso`.`credo`,'%d/%m/%Y %h:%i %p'),'')" => "credo",
		"`progreso`.`creado_por`" => "creado_por",
	];
	// Fields that can be filtered
	$x->QueryFieldsFilters = [
		"`progreso`.`id`" => "ID",
		"IF(    CHAR_LENGTH(`observaciones1`.`id`), CONCAT_WS('',   `observaciones1`.`id`), '') /* Id observacion */" => "Id observacion",
		"IF(    CHAR_LENGTH(`tipo_estado_observaciones1`.`estado_observa`), CONCAT_WS('',   `tipo_estado_observaciones1`.`estado_observa`), '') /* Estado seguimiento */" => "Estado seguimiento",
		"`progreso`.`descripcion`" => "Descripcion",
		"`progreso`.`credo`" => "Credo",
		"`progreso`.`creado_por`" => "Creado por",
	];

	// Fields that can be quick searched
	$x->QueryFieldsQS = [
		"`progreso`.`id`" => "id",
		"IF(    CHAR_LENGTH(`observaciones1`.`id`), CONCAT_WS('',   `observaciones1`.`id`), '') /* Id observacion */" => "id_observacion",
		"IF(    CHAR_LENGTH(`tipo_estado_observaciones1`.`estado_observa`), CONCAT_WS('',   `tipo_estado_observaciones1`.`estado_observa`), '') /* Estado seguimiento */" => "estado_seguimiento",
		"`progreso`.`descripcion`" => "descripcion",
		"if(`progreso`.`credo`,date_format(`progreso`.`credo`,'%d/%m/%Y %h:%i %p'),'')" => "credo",
		"`progreso`.`creado_por`" => "creado_por",
	];

	// Lookup fields that can be used as filterers
	$x->filterers = ['id_observacion' => 'Id observacion', 'estado_seguimiento' => 'Estado seguimiento', ];

	$x->QueryFrom = "`progreso` LEFT JOIN `observaciones` as observaciones1 ON `observaciones1`.`id`=`progreso`.`id_observacion` LEFT JOIN `tipo_estado_observaciones` as tipo_estado_observaciones1 ON `tipo_estado_observaciones1`.`id`=`progreso`.`estado_seguimiento` ";
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
	$x->ScriptFileName = 'progreso_view.php';
	$x->RedirectAfterInsert = 'progreso_view.php?SelectedID=#ID#';
	$x->TableTitle = 'Progreso';
	$x->TableIcon = 'resources/table_icons/progressbar.png';
	$x->PrimaryKey = '`progreso`.`id`';
	$x->DefaultSortField = '`progreso`.`credo`';
	$x->DefaultSortDirection = 'desc';

	$x->ColWidth = [150, 150, 150, ];
	$x->ColCaption = ['Id observacion', 'Estado seguimiento', 'Descripcion', ];
	$x->ColFieldName = ['id_observacion', 'estado_seguimiento', 'descripcion', ];
	$x->ColNumber  = [2, 3, 4, ];

	// template paths below are based on the app main directory
	$x->Template = 'templates/progreso_templateTV.html';
	$x->SelectedTemplate = 'templates/progreso_templateTVS.html';
	$x->TemplateDV = 'templates/progreso_templateDV.html';
	$x->TemplateDVP = 'templates/progreso_templateDVP.html';

	$x->ShowTableHeader = 1;
	$x->TVClasses = "";
	$x->DVClasses = "";
	$x->HasCalculatedFields = false;
	$x->AllowConsoleLog = false;
	$x->AllowDVNavigation = true;

	// hook: progreso_init
	$render = true;
	if(function_exists('progreso_init')) {
		$args = [];
		$render = progreso_init($x, getMemberInfo(), $args);
	}

	if($render) $x->Render();

	// hook: progreso_header
	$headerCode = '';
	if(function_exists('progreso_header')) {
		$args = [];
		$headerCode = progreso_header($x->ContentType, getMemberInfo(), $args);
	}

	if(!$headerCode) {
		include_once("{$currDir}/header.php"); 
	} else {
		ob_start();
		include_once("{$currDir}/header.php");
		echo str_replace('<%%HEADER%%>', ob_get_clean(), $headerCode);
	}

	echo $x->HTML;

	// hook: progreso_footer
	$footerCode = '';
	if(function_exists('progreso_footer')) {
		$args = [];
		$footerCode = progreso_footer($x->ContentType, getMemberInfo(), $args);
	}

	if(!$footerCode) {
		include_once("{$currDir}/footer.php"); 
	} else {
		ob_start();
		include_once("{$currDir}/footer.php");
		echo str_replace('<%%FOOTER%%>', ob_get_clean(), $footerCode);
	}
