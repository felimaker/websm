<?php
// This script and data application were generated by AppGini 5.97
// Download AppGini for free from https://bigprof.com/appgini/download/

	$currDir = dirname(__FILE__);
	include_once("{$currDir}/lib.php");
	@include_once("{$currDir}/hooks/movi_recepcion.php");
	include_once("{$currDir}/movi_recepcion_dml.php");

	// mm: can the current member access this page?
	$perm = getTablePermissions('movi_recepcion');
	if(!$perm['access']) {
		echo error_message($Translation['tableAccessDenied']);
		exit;
	}

	$x = new DataList;
	$x->TableName = 'movi_recepcion';

	// Fields that can be displayed in the table view
	$x->QueryFieldsTV = [
		"`movi_recepcion`.`id`" => "id",
		"IF(    CHAR_LENGTH(`movimientos1`.`id_movi`), CONCAT_WS('',   `movimientos1`.`id_movi`), '') /* Id movi */" => "id_movi",
		"if(`movi_recepcion`.`fecha_recepcion`,date_format(`movi_recepcion`.`fecha_recepcion`,'%d/%m/%Y'),'')" => "fecha_recepcion",
		"IF(    CHAR_LENGTH(`unidades1`.`nombre`) || CHAR_LENGTH(`unidades1`.`abreviado`), CONCAT_WS('',   `unidades1`.`nombre`, ' | ', `unidades1`.`abreviado`), '') /* Destino final */" => "destino",
		"IF(    CHAR_LENGTH(`unidades1`.`direccion`), CONCAT_WS('',   `unidades1`.`direccion`), '') /* Direccion */" => "o_direccion",
		"IF(    CHAR_LENGTH(`ciudades1`.`ciudad`), CONCAT_WS('',   `ciudades1`.`ciudad`), '') /* Ciudad */" => "ciudad",
		"concat('<i class=\"glyphicon glyphicon-', if(`movi_recepcion`.`verificado`, 'check', 'unchecked'), '\"></i>')" => "verificado",
		"IF(    CHAR_LENGTH(`contactos1`.`nombre`), CONCAT_WS('',   `contactos1`.`nombre`), '') /* Recibido por */" => "nombre",
		"IF(    CHAR_LENGTH(`contactos1`.`telefono`), CONCAT_WS('',   `contactos1`.`telefono`), '') /* Telefono */" => "telefono",
		"`movi_recepcion`.`detalles`" => "detalles",
		"if(`movi_recepcion`.`creado`,date_format(`movi_recepcion`.`creado`,'%d/%m/%Y %h:%i %p'),'')" => "creado",
		"`movi_recepcion`.`creado_por`" => "creado_por",
		"if(`movi_recepcion`.`editado`,date_format(`movi_recepcion`.`editado`,'%d/%m/%Y %h:%i %p'),'')" => "editado",
		"`movi_recepcion`.`editado_por`" => "editado_por",
	];
	// mapping incoming sort by requests to actual query fields
	$x->SortFields = [
		1 => '`movi_recepcion`.`id`',
		2 => '`movimientos1`.`id_movi`',
		3 => '`movi_recepcion`.`fecha_recepcion`',
		4 => 4,
		5 => '`unidades1`.`direccion`',
		6 => 6,
		7 => 7,
		8 => '`contactos1`.`nombre`',
		9 => '`contactos1`.`telefono`',
		10 => 10,
		11 => '`movi_recepcion`.`creado`',
		12 => 12,
		13 => '`movi_recepcion`.`editado`',
		14 => 14,
	];

	// Fields that can be displayed in the csv file
	$x->QueryFieldsCSV = [
		"`movi_recepcion`.`id`" => "id",
		"IF(    CHAR_LENGTH(`movimientos1`.`id_movi`), CONCAT_WS('',   `movimientos1`.`id_movi`), '') /* Id movi */" => "id_movi",
		"if(`movi_recepcion`.`fecha_recepcion`,date_format(`movi_recepcion`.`fecha_recepcion`,'%d/%m/%Y'),'')" => "fecha_recepcion",
		"IF(    CHAR_LENGTH(`unidades1`.`nombre`) || CHAR_LENGTH(`unidades1`.`abreviado`), CONCAT_WS('',   `unidades1`.`nombre`, ' | ', `unidades1`.`abreviado`), '') /* Destino final */" => "destino",
		"IF(    CHAR_LENGTH(`unidades1`.`direccion`), CONCAT_WS('',   `unidades1`.`direccion`), '') /* Direccion */" => "o_direccion",
		"IF(    CHAR_LENGTH(`ciudades1`.`ciudad`), CONCAT_WS('',   `ciudades1`.`ciudad`), '') /* Ciudad */" => "ciudad",
		"`movi_recepcion`.`verificado`" => "verificado",
		"IF(    CHAR_LENGTH(`contactos1`.`nombre`), CONCAT_WS('',   `contactos1`.`nombre`), '') /* Recibido por */" => "nombre",
		"IF(    CHAR_LENGTH(`contactos1`.`telefono`), CONCAT_WS('',   `contactos1`.`telefono`), '') /* Telefono */" => "telefono",
		"`movi_recepcion`.`detalles`" => "detalles",
		"if(`movi_recepcion`.`creado`,date_format(`movi_recepcion`.`creado`,'%d/%m/%Y %h:%i %p'),'')" => "creado",
		"`movi_recepcion`.`creado_por`" => "creado_por",
		"if(`movi_recepcion`.`editado`,date_format(`movi_recepcion`.`editado`,'%d/%m/%Y %h:%i %p'),'')" => "editado",
		"`movi_recepcion`.`editado_por`" => "editado_por",
	];
	// Fields that can be filtered
	$x->QueryFieldsFilters = [
		"`movi_recepcion`.`id`" => "ID",
		"IF(    CHAR_LENGTH(`movimientos1`.`id_movi`), CONCAT_WS('',   `movimientos1`.`id_movi`), '') /* Id movi */" => "Id movi",
		"`movi_recepcion`.`fecha_recepcion`" => "Fecha de recepcion",
		"IF(    CHAR_LENGTH(`unidades1`.`nombre`) || CHAR_LENGTH(`unidades1`.`abreviado`), CONCAT_WS('',   `unidades1`.`nombre`, ' | ', `unidades1`.`abreviado`), '') /* Destino final */" => "Destino final",
		"IF(    CHAR_LENGTH(`unidades1`.`direccion`), CONCAT_WS('',   `unidades1`.`direccion`), '') /* Direccion */" => "Direccion",
		"IF(    CHAR_LENGTH(`ciudades1`.`ciudad`), CONCAT_WS('',   `ciudades1`.`ciudad`), '') /* Ciudad */" => "Ciudad",
		"`movi_recepcion`.`verificado`" => "He recibido satisfactoriamente",
		"IF(    CHAR_LENGTH(`contactos1`.`nombre`), CONCAT_WS('',   `contactos1`.`nombre`), '') /* Recibido por */" => "Recibido por",
		"IF(    CHAR_LENGTH(`contactos1`.`telefono`), CONCAT_WS('',   `contactos1`.`telefono`), '') /* Telefono */" => "Telefono",
		"`movi_recepcion`.`detalles`" => "Dettalles del recepcion",
		"`movi_recepcion`.`creado`" => "Creado",
		"`movi_recepcion`.`creado_por`" => "Creado por",
		"`movi_recepcion`.`editado`" => "Editado",
		"`movi_recepcion`.`editado_por`" => "Editado por",
	];

	// Fields that can be quick searched
	$x->QueryFieldsQS = [
		"`movi_recepcion`.`id`" => "id",
		"IF(    CHAR_LENGTH(`movimientos1`.`id_movi`), CONCAT_WS('',   `movimientos1`.`id_movi`), '') /* Id movi */" => "id_movi",
		"if(`movi_recepcion`.`fecha_recepcion`,date_format(`movi_recepcion`.`fecha_recepcion`,'%d/%m/%Y'),'')" => "fecha_recepcion",
		"IF(    CHAR_LENGTH(`unidades1`.`nombre`) || CHAR_LENGTH(`unidades1`.`abreviado`), CONCAT_WS('',   `unidades1`.`nombre`, ' | ', `unidades1`.`abreviado`), '') /* Destino final */" => "destino",
		"IF(    CHAR_LENGTH(`unidades1`.`direccion`), CONCAT_WS('',   `unidades1`.`direccion`), '') /* Direccion */" => "o_direccion",
		"IF(    CHAR_LENGTH(`ciudades1`.`ciudad`), CONCAT_WS('',   `ciudades1`.`ciudad`), '') /* Ciudad */" => "ciudad",
		"concat('<i class=\"glyphicon glyphicon-', if(`movi_recepcion`.`verificado`, 'check', 'unchecked'), '\"></i>')" => "verificado",
		"IF(    CHAR_LENGTH(`contactos1`.`nombre`), CONCAT_WS('',   `contactos1`.`nombre`), '') /* Recibido por */" => "nombre",
		"IF(    CHAR_LENGTH(`contactos1`.`telefono`), CONCAT_WS('',   `contactos1`.`telefono`), '') /* Telefono */" => "telefono",
		"`movi_recepcion`.`detalles`" => "detalles",
		"if(`movi_recepcion`.`creado`,date_format(`movi_recepcion`.`creado`,'%d/%m/%Y %h:%i %p'),'')" => "creado",
		"`movi_recepcion`.`creado_por`" => "creado_por",
		"if(`movi_recepcion`.`editado`,date_format(`movi_recepcion`.`editado`,'%d/%m/%Y %h:%i %p'),'')" => "editado",
		"`movi_recepcion`.`editado_por`" => "editado_por",
	];

	// Lookup fields that can be used as filterers
	$x->filterers = ['id_movi' => 'Id movi', 'destino' => 'Destino final', 'nombre' => 'Recibido por', ];

	$x->QueryFrom = "`movi_recepcion` LEFT JOIN `movimientos` as movimientos1 ON `movimientos1`.`id_movi`=`movi_recepcion`.`id_movi` LEFT JOIN `unidades` as unidades1 ON `unidades1`.`id_unidades`=`movi_recepcion`.`destino` LEFT JOIN `contactos` as contactos1 ON `contactos1`.`id_contactos`=`movi_recepcion`.`nombre` LEFT JOIN `ciudades` as ciudades1 ON `ciudades1`.`id_ciudad`=`unidades1`.`ciudad` ";
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
	$x->ScriptFileName = 'movi_recepcion_view.php';
	$x->RedirectAfterInsert = 'movi_recepcion_view.php?SelectedID=#ID#';
	$x->TableTitle = 'Recepcion';
	$x->TableIcon = 'resources/table_icons/arrow_refresh.png';
	$x->PrimaryKey = '`movi_recepcion`.`id`';
	$x->DefaultSortField = '`movi_recepcion`.`creado`';
	$x->DefaultSortDirection = 'desc';

	$x->ColWidth = [150, 150, 150, 150, 150, 150, 150, 150, 150, ];
	$x->ColCaption = ['Fecha de recepcion', 'Destino final', 'Direccion', 'Ciudad', 'He recibido satisfactoriamente', 'Recibido por', 'Telefono', 'Dettalles del recepcion', 'Creado', ];
	$x->ColFieldName = ['fecha_recepcion', 'destino', 'o_direccion', 'ciudad', 'verificado', 'nombre', 'telefono', 'detalles', 'creado', ];
	$x->ColNumber  = [3, 4, 5, 6, 7, 8, 9, 10, 11, ];

	// template paths below are based on the app main directory
	$x->Template = 'templates/movi_recepcion_templateTV.html';
	$x->SelectedTemplate = 'templates/movi_recepcion_templateTVS.html';
	$x->TemplateDV = 'templates/movi_recepcion_templateDV.html';
	$x->TemplateDVP = 'templates/movi_recepcion_templateDVP.html';

	$x->ShowTableHeader = 1;
	$x->TVClasses = "";
	$x->DVClasses = "";
	$x->HasCalculatedFields = false;
	$x->AllowConsoleLog = false;
	$x->AllowDVNavigation = true;

	// hook: movi_recepcion_init
	$render = true;
	if(function_exists('movi_recepcion_init')) {
		$args = [];
		$render = movi_recepcion_init($x, getMemberInfo(), $args);
	}

	if($render) $x->Render();

	// hook: movi_recepcion_header
	$headerCode = '';
	if(function_exists('movi_recepcion_header')) {
		$args = [];
		$headerCode = movi_recepcion_header($x->ContentType, getMemberInfo(), $args);
	}

	if(!$headerCode) {
		include_once("{$currDir}/header.php"); 
	} else {
		ob_start();
		include_once("{$currDir}/header.php");
		echo str_replace('<%%HEADER%%>', ob_get_clean(), $headerCode);
	}

	echo $x->HTML;

	// hook: movi_recepcion_footer
	$footerCode = '';
	if(function_exists('movi_recepcion_footer')) {
		$args = [];
		$footerCode = movi_recepcion_footer($x->ContentType, getMemberInfo(), $args);
	}

	if(!$footerCode) {
		include_once("{$currDir}/footer.php"); 
	} else {
		ob_start();
		include_once("{$currDir}/footer.php");
		echo str_replace('<%%FOOTER%%>', ob_get_clean(), $footerCode);
	}
