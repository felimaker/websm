<?php
// This script and data application were generated by AppGini 5.97
// Download AppGini for free from https://bigprof.com/appgini/download/

	$currDir = dirname(__FILE__);
	include_once("{$currDir}/lib.php");
	@include_once("{$currDir}/hooks/dispo_fuera.php");
	include_once("{$currDir}/dispo_fuera_dml.php");

	// mm: can the current member access this page?
	$perm = getTablePermissions('dispo_fuera');
	if(!$perm['access']) {
		echo error_message($Translation['tableAccessDenied']);
		exit;
	}

	$x = new DataList;
	$x->TableName = 'dispo_fuera';

	// Fields that can be displayed in the table view
	$x->QueryFieldsTV = [
		"`dispo_fuera`.`id`" => "id",
		"IF(    CHAR_LENGTH(`dispositivos1`.`foto`), CONCAT_WS('',   `dispositivos1`.`foto`), '') /* Img */" => "img",
		"IF(    CHAR_LENGTH(`dispositivos1`.`code`), CONCAT_WS('',   `dispositivos1`.`code`), '') /* Dispositivo */" => "codigo",
		"IF(    CHAR_LENGTH(`dispositivos1`.`serial`), CONCAT_WS('',   `dispositivos1`.`serial`), '') /* Serial */" => "serial",
		"IF(    CHAR_LENGTH(`dispositivos1`.`ubicacion_abre`) || CHAR_LENGTH(`unidades1`.`nombre`), CONCAT_WS('',   `dispositivos1`.`ubicacion_abre`, ' | ', `unidades1`.`nombre`), '') /* Ubicacion final */" => "ubicacion_final",
		"IF(    CHAR_LENGTH(`tipo_fuera_servicio1`.`tipo_fuera_servicio`), CONCAT_WS('',   `tipo_fuera_servicio1`.`tipo_fuera_servicio`), '') /* Tipo fuera servicio */" => "tipo_fuera_servicio",
		"if(`dispo_fuera`.`fecha_reporte`,date_format(`dispo_fuera`.`fecha_reporte`,'%d/%m/%Y'),'')" => "fecha_reporte",
		"`dispo_fuera`.`descripcion`" => "descripcion",
		"if(`dispo_fuera`.`creado`,date_format(`dispo_fuera`.`creado`,'%d/%m/%Y %h:%i %p'),'')" => "creado",
		"`dispo_fuera`.`creado_por`" => "creado_por",
		"if(`dispo_fuera`.`editado`,date_format(`dispo_fuera`.`editado`,'%d/%m/%Y %h:%i %p'),'')" => "editado",
		"`dispo_fuera`.`edtado_por`" => "edtado_por",
	];
	// mapping incoming sort by requests to actual query fields
	$x->SortFields = [
		1 => '`dispo_fuera`.`id`',
		2 => 2,
		3 => '`dispositivos1`.`code`',
		4 => '`dispositivos1`.`serial`',
		5 => 5,
		6 => '`tipo_fuera_servicio1`.`tipo_fuera_servicio`',
		7 => '`dispo_fuera`.`fecha_reporte`',
		8 => 8,
		9 => '`dispo_fuera`.`creado`',
		10 => 10,
		11 => '`dispo_fuera`.`editado`',
		12 => 12,
	];

	// Fields that can be displayed in the csv file
	$x->QueryFieldsCSV = [
		"`dispo_fuera`.`id`" => "id",
		"IF(    CHAR_LENGTH(`dispositivos1`.`foto`), CONCAT_WS('',   `dispositivos1`.`foto`), '') /* Img */" => "img",
		"IF(    CHAR_LENGTH(`dispositivos1`.`code`), CONCAT_WS('',   `dispositivos1`.`code`), '') /* Dispositivo */" => "codigo",
		"IF(    CHAR_LENGTH(`dispositivos1`.`serial`), CONCAT_WS('',   `dispositivos1`.`serial`), '') /* Serial */" => "serial",
		"IF(    CHAR_LENGTH(`dispositivos1`.`ubicacion_abre`) || CHAR_LENGTH(`unidades1`.`nombre`), CONCAT_WS('',   `dispositivos1`.`ubicacion_abre`, ' | ', `unidades1`.`nombre`), '') /* Ubicacion final */" => "ubicacion_final",
		"IF(    CHAR_LENGTH(`tipo_fuera_servicio1`.`tipo_fuera_servicio`), CONCAT_WS('',   `tipo_fuera_servicio1`.`tipo_fuera_servicio`), '') /* Tipo fuera servicio */" => "tipo_fuera_servicio",
		"if(`dispo_fuera`.`fecha_reporte`,date_format(`dispo_fuera`.`fecha_reporte`,'%d/%m/%Y'),'')" => "fecha_reporte",
		"`dispo_fuera`.`descripcion`" => "descripcion",
		"if(`dispo_fuera`.`creado`,date_format(`dispo_fuera`.`creado`,'%d/%m/%Y %h:%i %p'),'')" => "creado",
		"`dispo_fuera`.`creado_por`" => "creado_por",
		"if(`dispo_fuera`.`editado`,date_format(`dispo_fuera`.`editado`,'%d/%m/%Y %h:%i %p'),'')" => "editado",
		"`dispo_fuera`.`edtado_por`" => "edtado_por",
	];
	// Fields that can be filtered
	$x->QueryFieldsFilters = [
		"`dispo_fuera`.`id`" => "ID",
		"IF(    CHAR_LENGTH(`dispositivos1`.`foto`), CONCAT_WS('',   `dispositivos1`.`foto`), '') /* Img */" => "Img",
		"IF(    CHAR_LENGTH(`dispositivos1`.`code`), CONCAT_WS('',   `dispositivos1`.`code`), '') /* Dispositivo */" => "Dispositivo",
		"IF(    CHAR_LENGTH(`dispositivos1`.`serial`), CONCAT_WS('',   `dispositivos1`.`serial`), '') /* Serial */" => "Serial",
		"IF(    CHAR_LENGTH(`dispositivos1`.`ubicacion_abre`) || CHAR_LENGTH(`unidades1`.`nombre`), CONCAT_WS('',   `dispositivos1`.`ubicacion_abre`, ' | ', `unidades1`.`nombre`), '') /* Ubicacion final */" => "Ubicacion final",
		"IF(    CHAR_LENGTH(`tipo_fuera_servicio1`.`tipo_fuera_servicio`), CONCAT_WS('',   `tipo_fuera_servicio1`.`tipo_fuera_servicio`), '') /* Tipo fuera servicio */" => "Tipo fuera servicio",
		"`dispo_fuera`.`fecha_reporte`" => "Fecha de reporte",
		"`dispo_fuera`.`descripcion`" => "Descripcion",
		"`dispo_fuera`.`creado`" => "Creado",
		"`dispo_fuera`.`creado_por`" => "Creado por",
		"`dispo_fuera`.`editado`" => "Editado",
		"`dispo_fuera`.`edtado_por`" => "Edtado por",
	];

	// Fields that can be quick searched
	$x->QueryFieldsQS = [
		"`dispo_fuera`.`id`" => "id",
		"IF(    CHAR_LENGTH(`dispositivos1`.`foto`), CONCAT_WS('',   `dispositivos1`.`foto`), '') /* Img */" => "img",
		"IF(    CHAR_LENGTH(`dispositivos1`.`code`), CONCAT_WS('',   `dispositivos1`.`code`), '') /* Dispositivo */" => "codigo",
		"IF(    CHAR_LENGTH(`dispositivos1`.`serial`), CONCAT_WS('',   `dispositivos1`.`serial`), '') /* Serial */" => "serial",
		"IF(    CHAR_LENGTH(`dispositivos1`.`ubicacion_abre`) || CHAR_LENGTH(`unidades1`.`nombre`), CONCAT_WS('',   `dispositivos1`.`ubicacion_abre`, ' | ', `unidades1`.`nombre`), '') /* Ubicacion final */" => "ubicacion_final",
		"IF(    CHAR_LENGTH(`tipo_fuera_servicio1`.`tipo_fuera_servicio`), CONCAT_WS('',   `tipo_fuera_servicio1`.`tipo_fuera_servicio`), '') /* Tipo fuera servicio */" => "tipo_fuera_servicio",
		"if(`dispo_fuera`.`fecha_reporte`,date_format(`dispo_fuera`.`fecha_reporte`,'%d/%m/%Y'),'')" => "fecha_reporte",
		"`dispo_fuera`.`descripcion`" => "descripcion",
		"if(`dispo_fuera`.`creado`,date_format(`dispo_fuera`.`creado`,'%d/%m/%Y %h:%i %p'),'')" => "creado",
		"`dispo_fuera`.`creado_por`" => "creado_por",
		"if(`dispo_fuera`.`editado`,date_format(`dispo_fuera`.`editado`,'%d/%m/%Y %h:%i %p'),'')" => "editado",
		"`dispo_fuera`.`edtado_por`" => "edtado_por",
	];

	// Lookup fields that can be used as filterers
	$x->filterers = ['codigo' => 'Dispositivo', 'tipo_fuera_servicio' => 'Tipo fuera servicio', ];

	$x->QueryFrom = "`dispo_fuera` LEFT JOIN `dispositivos` as dispositivos1 ON `dispositivos1`.`id_dispo`=`dispo_fuera`.`codigo` LEFT JOIN `tipo_fuera_servicio` as tipo_fuera_servicio1 ON `tipo_fuera_servicio1`.`id`=`dispo_fuera`.`tipo_fuera_servicio` LEFT JOIN `unidades` as unidades1 ON `unidades1`.`id_unidades`=`dispositivos1`.`ubicacion` ";
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
	$x->ScriptFileName = 'dispo_fuera_view.php';
	$x->RedirectAfterInsert = 'dispo_fuera_view.php?SelectedID=#ID#';
	$x->TableTitle = 'Dispositivos da Baja';
	$x->TableIcon = 'resources/table_icons/mail-trash.png';
	$x->PrimaryKey = '`dispo_fuera`.`id`';
	$x->DefaultSortField = '`dispo_fuera`.`creado`';
	$x->DefaultSortDirection = 'desc';

	$x->ColWidth = [150, 150, 150, 150, 150, 150, 150, 150, 150, ];
	$x->ColCaption = ['Img', 'Dispositivo', 'Serial', 'Ubicacion final', 'Tipo fuera servicio', 'Fecha de reporte', 'Descripcion', 'Creado', 'Creado por', ];
	$x->ColFieldName = ['img', 'codigo', 'serial', 'ubicacion_final', 'tipo_fuera_servicio', 'fecha_reporte', 'descripcion', 'creado', 'creado_por', ];
	$x->ColNumber  = [2, 3, 4, 5, 6, 7, 8, 9, 10, ];

	// template paths below are based on the app main directory
	$x->Template = 'templates/dispo_fuera_templateTV.html';
	$x->SelectedTemplate = 'templates/dispo_fuera_templateTVS.html';
	$x->TemplateDV = 'templates/dispo_fuera_templateDV.html';
	$x->TemplateDVP = 'templates/dispo_fuera_templateDVP.html';

	$x->ShowTableHeader = 1;
	$x->TVClasses = "";
	$x->DVClasses = "";
	$x->HasCalculatedFields = false;
	$x->AllowConsoleLog = false;
	$x->AllowDVNavigation = true;

	// hook: dispo_fuera_init
	$render = true;
	if(function_exists('dispo_fuera_init')) {
		$args = [];
		$render = dispo_fuera_init($x, getMemberInfo(), $args);
	}

	if($render) $x->Render();

	// hook: dispo_fuera_header
	$headerCode = '';
	if(function_exists('dispo_fuera_header')) {
		$args = [];
		$headerCode = dispo_fuera_header($x->ContentType, getMemberInfo(), $args);
	}

	if(!$headerCode) {
		include_once("{$currDir}/header.php"); 
	} else {
		ob_start();
		include_once("{$currDir}/header.php");
		echo str_replace('<%%HEADER%%>', ob_get_clean(), $headerCode);
	}

	echo $x->HTML;

	// hook: dispo_fuera_footer
	$footerCode = '';
	if(function_exists('dispo_fuera_footer')) {
		$args = [];
		$footerCode = dispo_fuera_footer($x->ContentType, getMemberInfo(), $args);
	}

	if(!$footerCode) {
		include_once("{$currDir}/footer.php"); 
	} else {
		ob_start();
		include_once("{$currDir}/footer.php");
		echo str_replace('<%%FOOTER%%>', ob_get_clean(), $footerCode);
	}
