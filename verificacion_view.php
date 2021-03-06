<?php
// This script and data application were generated by AppGini 5.97
// Download AppGini for free from https://bigprof.com/appgini/download/

	$currDir = dirname(__FILE__);
	include_once("{$currDir}/lib.php");
	@include_once("{$currDir}/hooks/verificacion.php");
	include_once("{$currDir}/verificacion_dml.php");

	// mm: can the current member access this page?
	$perm = getTablePermissions('verificacion');
	if(!$perm['access']) {
		echo error_message($Translation['tableAccessDenied']);
		exit;
	}

	$x = new DataList;
	$x->TableName = 'verificacion';

	// Fields that can be displayed in the table view
	$x->QueryFieldsTV = [
		"`verificacion`.`id`" => "id",
		"IF(    CHAR_LENGTH(`dispositivos1`.`code`), CONCAT_WS('',   `dispositivos1`.`code`), '') /* Codigo */" => "codigo",
		"IF(    CHAR_LENGTH(`tipo_dispositivo1`.`tipo_dispositivo`), CONCAT_WS('',   `tipo_dispositivo1`.`tipo_dispositivo`), '') /* Tipo de dispositivo */" => "tipo_dispo",
		"IF(    CHAR_LENGTH(`dispositivos1`.`serial`), CONCAT_WS('',   `dispositivos1`.`serial`), '') /* Serial */" => "serial",
		"IF(    CHAR_LENGTH(`unidades1`.`nombre`), CONCAT_WS('',   `unidades1`.`nombre`), '') /* Ubicacion */" => "ubicacion",
		"IF(    CHAR_LENGTH(`unidades1`.`abreviado`) || CHAR_LENGTH(`ciudades1`.`ciudad`), CONCAT_WS('',   `unidades1`.`abreviado`, ' - ', `ciudades1`.`ciudad`), '') /* Abreviado */" => "abreviado",
		"concat('<i class=\"glyphicon glyphicon-', if(`verificacion`.`verificacion`, 'check', 'unchecked'), '\"></i>')" => "verificacion",
		"`verificacion`.`comentario`" => "comentario",
		"if(`verificacion`.`fecha_verifi`,date_format(`verificacion`.`fecha_verifi`,'%d/%m/%Y %h:%i %p'),'')" => "fecha_verifi",
		"`verificacion`.`verifi_por`" => "verifi_por",
	];
	// mapping incoming sort by requests to actual query fields
	$x->SortFields = [
		1 => '`verificacion`.`id`',
		2 => '`dispositivos1`.`code`',
		3 => 3,
		4 => '`dispositivos1`.`serial`',
		5 => '`unidades1`.`nombre`',
		6 => 6,
		7 => 7,
		8 => 8,
		9 => '`verificacion`.`fecha_verifi`',
		10 => 10,
	];

	// Fields that can be displayed in the csv file
	$x->QueryFieldsCSV = [
		"`verificacion`.`id`" => "id",
		"IF(    CHAR_LENGTH(`dispositivos1`.`code`), CONCAT_WS('',   `dispositivos1`.`code`), '') /* Codigo */" => "codigo",
		"IF(    CHAR_LENGTH(`tipo_dispositivo1`.`tipo_dispositivo`), CONCAT_WS('',   `tipo_dispositivo1`.`tipo_dispositivo`), '') /* Tipo de dispositivo */" => "tipo_dispo",
		"IF(    CHAR_LENGTH(`dispositivos1`.`serial`), CONCAT_WS('',   `dispositivos1`.`serial`), '') /* Serial */" => "serial",
		"IF(    CHAR_LENGTH(`unidades1`.`nombre`), CONCAT_WS('',   `unidades1`.`nombre`), '') /* Ubicacion */" => "ubicacion",
		"IF(    CHAR_LENGTH(`unidades1`.`abreviado`) || CHAR_LENGTH(`ciudades1`.`ciudad`), CONCAT_WS('',   `unidades1`.`abreviado`, ' - ', `ciudades1`.`ciudad`), '') /* Abreviado */" => "abreviado",
		"`verificacion`.`verificacion`" => "verificacion",
		"`verificacion`.`comentario`" => "comentario",
		"if(`verificacion`.`fecha_verifi`,date_format(`verificacion`.`fecha_verifi`,'%d/%m/%Y %h:%i %p'),'')" => "fecha_verifi",
		"`verificacion`.`verifi_por`" => "verifi_por",
	];
	// Fields that can be filtered
	$x->QueryFieldsFilters = [
		"`verificacion`.`id`" => "ID",
		"IF(    CHAR_LENGTH(`dispositivos1`.`code`), CONCAT_WS('',   `dispositivos1`.`code`), '') /* Codigo */" => "Codigo",
		"IF(    CHAR_LENGTH(`tipo_dispositivo1`.`tipo_dispositivo`), CONCAT_WS('',   `tipo_dispositivo1`.`tipo_dispositivo`), '') /* Tipo de dispositivo */" => "Tipo de dispositivo",
		"IF(    CHAR_LENGTH(`dispositivos1`.`serial`), CONCAT_WS('',   `dispositivos1`.`serial`), '') /* Serial */" => "Serial",
		"IF(    CHAR_LENGTH(`unidades1`.`nombre`), CONCAT_WS('',   `unidades1`.`nombre`), '') /* Ubicacion */" => "Ubicacion",
		"IF(    CHAR_LENGTH(`unidades1`.`abreviado`) || CHAR_LENGTH(`ciudades1`.`ciudad`), CONCAT_WS('',   `unidades1`.`abreviado`, ' - ', `ciudades1`.`ciudad`), '') /* Abreviado */" => "Abreviado",
		"`verificacion`.`verificacion`" => "Verificado",
		"`verificacion`.`comentario`" => "Comentario",
		"`verificacion`.`fecha_verifi`" => "Fecha de verificado",
		"`verificacion`.`verifi_por`" => "Verificado por",
	];

	// Fields that can be quick searched
	$x->QueryFieldsQS = [
		"`verificacion`.`id`" => "id",
		"IF(    CHAR_LENGTH(`dispositivos1`.`code`), CONCAT_WS('',   `dispositivos1`.`code`), '') /* Codigo */" => "codigo",
		"IF(    CHAR_LENGTH(`tipo_dispositivo1`.`tipo_dispositivo`), CONCAT_WS('',   `tipo_dispositivo1`.`tipo_dispositivo`), '') /* Tipo de dispositivo */" => "tipo_dispo",
		"IF(    CHAR_LENGTH(`dispositivos1`.`serial`), CONCAT_WS('',   `dispositivos1`.`serial`), '') /* Serial */" => "serial",
		"IF(    CHAR_LENGTH(`unidades1`.`nombre`), CONCAT_WS('',   `unidades1`.`nombre`), '') /* Ubicacion */" => "ubicacion",
		"IF(    CHAR_LENGTH(`unidades1`.`abreviado`) || CHAR_LENGTH(`ciudades1`.`ciudad`), CONCAT_WS('',   `unidades1`.`abreviado`, ' - ', `ciudades1`.`ciudad`), '') /* Abreviado */" => "abreviado",
		"concat('<i class=\"glyphicon glyphicon-', if(`verificacion`.`verificacion`, 'check', 'unchecked'), '\"></i>')" => "verificacion",
		"`verificacion`.`comentario`" => "comentario",
		"if(`verificacion`.`fecha_verifi`,date_format(`verificacion`.`fecha_verifi`,'%d/%m/%Y %h:%i %p'),'')" => "fecha_verifi",
		"`verificacion`.`verifi_por`" => "verifi_por",
	];

	// Lookup fields that can be used as filterers
	$x->filterers = ['codigo' => 'Codigo', 'ubicacion' => 'Ubicacion', ];

	$x->QueryFrom = "`verificacion` LEFT JOIN `dispositivos` as dispositivos1 ON `dispositivos1`.`id_dispo`=`verificacion`.`codigo` LEFT JOIN `unidades` as unidades1 ON `unidades1`.`id_unidades`=`verificacion`.`ubicacion` LEFT JOIN `tipo_dispositivo` as tipo_dispositivo1 ON `tipo_dispositivo1`.`id_tipodispo`=`dispositivos1`.`tipo_dispositivo` LEFT JOIN `ciudades` as ciudades1 ON `ciudades1`.`id_ciudad`=`unidades1`.`ciudad` ";
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
	$x->ScriptFileName = 'verificacion_view.php';
	$x->RedirectAfterInsert = 'verificacion_view.php?SelectedID=#ID#';
	$x->TableTitle = 'Verificacion';
	$x->TableIcon = 'resources/table_icons/accept.png';
	$x->PrimaryKey = '`verificacion`.`id`';
	$x->DefaultSortField = '`verificacion`.`fecha_verifi`';
	$x->DefaultSortDirection = 'desc';

	$x->ColWidth = [150, 150, 150, 150, 150, 150, 150, 150, 150, ];
	$x->ColCaption = ['Codigo', 'Tipo de dispositivo', 'Serial', 'Ubicacion', 'Abreviado', 'Verificado', 'Comentario', 'Fecha de verificado', 'Verificado por', ];
	$x->ColFieldName = ['codigo', 'tipo_dispo', 'serial', 'ubicacion', 'abreviado', 'verificacion', 'comentario', 'fecha_verifi', 'verifi_por', ];
	$x->ColNumber  = [2, 3, 4, 5, 6, 7, 8, 9, 10, ];

	// template paths below are based on the app main directory
	$x->Template = 'templates/verificacion_templateTV.html';
	$x->SelectedTemplate = 'templates/verificacion_templateTVS.html';
	$x->TemplateDV = 'templates/verificacion_templateDV.html';
	$x->TemplateDVP = 'templates/verificacion_templateDVP.html';

	$x->ShowTableHeader = 1;
	$x->TVClasses = "";
	$x->DVClasses = "";
	$x->HasCalculatedFields = false;
	$x->AllowConsoleLog = false;
	$x->AllowDVNavigation = true;

	// hook: verificacion_init
	$render = true;
	if(function_exists('verificacion_init')) {
		$args = [];
		$render = verificacion_init($x, getMemberInfo(), $args);
	}

	if($render) $x->Render();

	// hook: verificacion_header
	$headerCode = '';
	if(function_exists('verificacion_header')) {
		$args = [];
		$headerCode = verificacion_header($x->ContentType, getMemberInfo(), $args);
	}

	if(!$headerCode) {
		include_once("{$currDir}/header.php"); 
	} else {
		ob_start();
		include_once("{$currDir}/header.php");
		echo str_replace('<%%HEADER%%>', ob_get_clean(), $headerCode);
	}

	echo $x->HTML;

	// hook: verificacion_footer
	$footerCode = '';
	if(function_exists('verificacion_footer')) {
		$args = [];
		$footerCode = verificacion_footer($x->ContentType, getMemberInfo(), $args);
	}

	if(!$footerCode) {
		include_once("{$currDir}/footer.php"); 
	} else {
		ob_start();
		include_once("{$currDir}/footer.php");
		echo str_replace('<%%FOOTER%%>', ob_get_clean(), $footerCode);
	}
