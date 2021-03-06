<?php
// This script and data application were generated by AppGini 5.97
// Download AppGini for free from https://bigprof.com/appgini/download/

	$currDir = dirname(__FILE__);
	include_once("{$currDir}/lib.php");
	@include_once("{$currDir}/hooks/facturas.php");
	include_once("{$currDir}/facturas_dml.php");

	// mm: can the current member access this page?
	$perm = getTablePermissions('facturas');
	if(!$perm['access']) {
		echo error_message($Translation['tableAccessDenied']);
		exit;
	}

	$x = new DataList;
	$x->TableName = 'facturas';

	// Fields that can be displayed in the table view
	$x->QueryFieldsTV = [
		"`facturas`.`id`" => "id",
		"IF(    CHAR_LENGTH(`dispositivos1`.`id_dispo`), CONCAT_WS('',   `dispositivos1`.`id_dispo`), '') /* Id dispo */" => "id_dispo",
		"`facturas`.`no_factura`" => "no_factura",
		"`facturas`.`fecha_factura`" => "fecha_factura",
		"IF(    CHAR_LENGTH(`contactos1`.`nombre`), CONCAT_WS('',   `contactos1`.`nombre`), '') /* Proveedor */" => "proveedor",
		"IF(    CHAR_LENGTH(`contactos1`.`identificacion`), CONCAT_WS('',   `contactos1`.`identificacion`), '') /* Identificacion */" => "identificacion",
		"`facturas`.`enlace_doc`" => "enlace_doc",
		"if(`facturas`.`creado`,date_format(`facturas`.`creado`,'%d/%m/%Y %h:%i %p'),'')" => "creado",
		"`facturas`.`creado_por`" => "creado_por",
		"if(`facturas`.`editado`,date_format(`facturas`.`editado`,'%d/%m/%Y %h:%i %p'),'')" => "editado",
		"`facturas`.`editado_por`" => "editado_por",
		"IF(    CHAR_LENGTH(`compras1`.`id`), CONCAT_WS('',   `compras1`.`id`), '') /* Id compras */" => "id_compras",
	];
	// mapping incoming sort by requests to actual query fields
	$x->SortFields = [
		1 => '`facturas`.`id`',
		2 => '`dispositivos1`.`id_dispo`',
		3 => 3,
		4 => 4,
		5 => '`contactos1`.`nombre`',
		6 => '`contactos1`.`identificacion`',
		7 => 7,
		8 => '`facturas`.`creado`',
		9 => 9,
		10 => '`facturas`.`editado`',
		11 => 11,
		12 => '`compras1`.`id`',
	];

	// Fields that can be displayed in the csv file
	$x->QueryFieldsCSV = [
		"`facturas`.`id`" => "id",
		"IF(    CHAR_LENGTH(`dispositivos1`.`id_dispo`), CONCAT_WS('',   `dispositivos1`.`id_dispo`), '') /* Id dispo */" => "id_dispo",
		"`facturas`.`no_factura`" => "no_factura",
		"`facturas`.`fecha_factura`" => "fecha_factura",
		"IF(    CHAR_LENGTH(`contactos1`.`nombre`), CONCAT_WS('',   `contactos1`.`nombre`), '') /* Proveedor */" => "proveedor",
		"IF(    CHAR_LENGTH(`contactos1`.`identificacion`), CONCAT_WS('',   `contactos1`.`identificacion`), '') /* Identificacion */" => "identificacion",
		"`facturas`.`enlace_doc`" => "enlace_doc",
		"if(`facturas`.`creado`,date_format(`facturas`.`creado`,'%d/%m/%Y %h:%i %p'),'')" => "creado",
		"`facturas`.`creado_por`" => "creado_por",
		"if(`facturas`.`editado`,date_format(`facturas`.`editado`,'%d/%m/%Y %h:%i %p'),'')" => "editado",
		"`facturas`.`editado_por`" => "editado_por",
		"IF(    CHAR_LENGTH(`compras1`.`id`), CONCAT_WS('',   `compras1`.`id`), '') /* Id compras */" => "id_compras",
	];
	// Fields that can be filtered
	$x->QueryFieldsFilters = [
		"`facturas`.`id`" => "ID",
		"IF(    CHAR_LENGTH(`dispositivos1`.`id_dispo`), CONCAT_WS('',   `dispositivos1`.`id_dispo`), '') /* Id dispo */" => "Id dispo",
		"`facturas`.`no_factura`" => "No. Factura",
		"`facturas`.`fecha_factura`" => "Fecha de factura",
		"IF(    CHAR_LENGTH(`contactos1`.`nombre`), CONCAT_WS('',   `contactos1`.`nombre`), '') /* Proveedor */" => "Proveedor",
		"IF(    CHAR_LENGTH(`contactos1`.`identificacion`), CONCAT_WS('',   `contactos1`.`identificacion`), '') /* Identificacion */" => "Identificacion",
		"`facturas`.`enlace_doc`" => "Enlace doc",
		"`facturas`.`creado`" => "Creado",
		"`facturas`.`creado_por`" => "Creado por",
		"`facturas`.`editado`" => "Editado",
		"`facturas`.`editado_por`" => "Editado por",
		"IF(    CHAR_LENGTH(`compras1`.`id`), CONCAT_WS('',   `compras1`.`id`), '') /* Id compras */" => "Id compras",
	];

	// Fields that can be quick searched
	$x->QueryFieldsQS = [
		"`facturas`.`id`" => "id",
		"IF(    CHAR_LENGTH(`dispositivos1`.`id_dispo`), CONCAT_WS('',   `dispositivos1`.`id_dispo`), '') /* Id dispo */" => "id_dispo",
		"`facturas`.`no_factura`" => "no_factura",
		"`facturas`.`fecha_factura`" => "fecha_factura",
		"IF(    CHAR_LENGTH(`contactos1`.`nombre`), CONCAT_WS('',   `contactos1`.`nombre`), '') /* Proveedor */" => "proveedor",
		"IF(    CHAR_LENGTH(`contactos1`.`identificacion`), CONCAT_WS('',   `contactos1`.`identificacion`), '') /* Identificacion */" => "identificacion",
		"`facturas`.`enlace_doc`" => "enlace_doc",
		"if(`facturas`.`creado`,date_format(`facturas`.`creado`,'%d/%m/%Y %h:%i %p'),'')" => "creado",
		"`facturas`.`creado_por`" => "creado_por",
		"if(`facturas`.`editado`,date_format(`facturas`.`editado`,'%d/%m/%Y %h:%i %p'),'')" => "editado",
		"`facturas`.`editado_por`" => "editado_por",
		"IF(    CHAR_LENGTH(`compras1`.`id`), CONCAT_WS('',   `compras1`.`id`), '') /* Id compras */" => "id_compras",
	];

	// Lookup fields that can be used as filterers
	$x->filterers = ['id_dispo' => 'Id dispo', 'proveedor' => 'Proveedor', 'id_compras' => 'Id compras', ];

	$x->QueryFrom = "`facturas` LEFT JOIN `dispositivos` as dispositivos1 ON `dispositivos1`.`id_dispo`=`facturas`.`id_dispo` LEFT JOIN `contactos` as contactos1 ON `contactos1`.`id_contactos`=`facturas`.`proveedor` LEFT JOIN `compras` as compras1 ON `compras1`.`id`=`facturas`.`id_compras` ";
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
	$x->ScriptFileName = 'facturas_view.php';
	$x->RedirectAfterInsert = 'facturas_view.php?SelectedID=#ID#';
	$x->TableTitle = 'Facturas';
	$x->TableIcon = 'resources/table_icons/application_form_add.png';
	$x->PrimaryKey = '`facturas`.`id`';
	$x->DefaultSortField = '`facturas`.`creado`';
	$x->DefaultSortDirection = 'desc';

	$x->ColWidth = [150, 150, 150, 150, 150, 150, 150, ];
	$x->ColCaption = ['Id dispo', 'No. Factura', 'Fecha de factura', 'Proveedor', 'Identificacion', 'Enlace doc', 'Id compras', ];
	$x->ColFieldName = ['id_dispo', 'no_factura', 'fecha_factura', 'proveedor', 'identificacion', 'enlace_doc', 'id_compras', ];
	$x->ColNumber  = [2, 3, 4, 5, 6, 7, 12, ];

	// template paths below are based on the app main directory
	$x->Template = 'templates/facturas_templateTV.html';
	$x->SelectedTemplate = 'templates/facturas_templateTVS.html';
	$x->TemplateDV = 'templates/facturas_templateDV.html';
	$x->TemplateDVP = 'templates/facturas_templateDVP.html';

	$x->ShowTableHeader = 1;
	$x->TVClasses = "";
	$x->DVClasses = "";
	$x->HasCalculatedFields = false;
	$x->AllowConsoleLog = false;
	$x->AllowDVNavigation = true;

	// hook: facturas_init
	$render = true;
	if(function_exists('facturas_init')) {
		$args = [];
		$render = facturas_init($x, getMemberInfo(), $args);
	}

	if($render) $x->Render();

	// hook: facturas_header
	$headerCode = '';
	if(function_exists('facturas_header')) {
		$args = [];
		$headerCode = facturas_header($x->ContentType, getMemberInfo(), $args);
	}

	if(!$headerCode) {
		include_once("{$currDir}/header.php"); 
	} else {
		ob_start();
		include_once("{$currDir}/header.php");
		echo str_replace('<%%HEADER%%>', ob_get_clean(), $headerCode);
	}

	echo $x->HTML;

	// hook: facturas_footer
	$footerCode = '';
	if(function_exists('facturas_footer')) {
		$args = [];
		$footerCode = facturas_footer($x->ContentType, getMemberInfo(), $args);
	}

	if(!$footerCode) {
		include_once("{$currDir}/footer.php"); 
	} else {
		ob_start();
		include_once("{$currDir}/footer.php");
		echo str_replace('<%%FOOTER%%>', ob_get_clean(), $footerCode);
	}
