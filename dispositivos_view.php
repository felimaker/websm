<?php
// This script and data application were generated by AppGini 5.97
// Download AppGini for free from https://bigprof.com/appgini/download/

	$currDir = dirname(__FILE__);
	include_once("{$currDir}/lib.php");
	@include_once("{$currDir}/hooks/dispositivos.php");
	include_once("{$currDir}/dispositivos_dml.php");

	// mm: can the current member access this page?
	$perm = getTablePermissions('dispositivos');
	if(!$perm['access']) {
		echo error_message($Translation['tableAccessDenied']);
		exit;
	}

	$x = new DataList;
	$x->TableName = 'dispositivos';

	// Fields that can be displayed in the table view
	$x->QueryFieldsTV = [
		"`dispositivos`.`codigo`" => "codigo",
		"`dispositivos`.`id_dispo`" => "id_dispo",
		"IF(    CHAR_LENGTH(`marca_modelo1`.`img`), CONCAT_WS('',   `marca_modelo1`.`img`), '') /* Foto */" => "foto",
		"`dispositivos`.`code`" => "code",
		"`dispositivos`.`serial`" => "serial",
		"IF(    CHAR_LENGTH(`tipo_dispositivo1`.`tipo_dispositivo`), CONCAT_WS('',   `tipo_dispositivo1`.`tipo_dispositivo`), '') /* Nombre del equipo */" => "tipo_dispositivo",
		"IF(    CHAR_LENGTH(`marcas1`.`marca`), CONCAT_WS('',   `marcas1`.`marca`), '') /* Marca */" => "marca",
		"IF(    CHAR_LENGTH(`marca_modelo1`.`modelo`), CONCAT_WS('',   `marca_modelo1`.`modelo`), '') /* Modelo */" => "modelo",
		"IF(    CHAR_LENGTH(`unidades1`.`nombre`), CONCAT_WS('',   `unidades1`.`nombre`), '') /* Ubicacion */" => "ubicacion",
		"IF(    CHAR_LENGTH(`unidades1`.`abreviado`) || CHAR_LENGTH(`ciudades1`.`ciudad`), CONCAT_WS('',   `unidades1`.`abreviado`, ' - ', `ciudades1`.`ciudad`), '') /* Unidad */" => "ubicacion_abre",
		"if(`dispositivos`.`fecha_ingreso`,date_format(`dispositivos`.`fecha_ingreso`,'%d/%m/%Y'),'')" => "fecha_ingreso",
		"IF(    CHAR_LENGTH(`tipo_clasifica_riesgo1`.`clase`), CONCAT_WS('',   `tipo_clasifica_riesgo1`.`clase`), '') /* Riesgo */" => "clasificacion_riesgo",
		"IF(    CHAR_LENGTH(`tipo_estado_dispo1`.`estado_dispo`), CONCAT_WS('',   `tipo_estado_dispo1`.`estado_dispo`), '') /* Estado */" => "estado",
		"`dispositivos`.`precio`" => "precio",
		"if(`dispositivos`.`creado`,date_format(`dispositivos`.`creado`,'%d/%m/%Y %h:%i %p'),'')" => "creado",
		"`dispositivos`.`creado_por`" => "creado_por",
		"if(`dispositivos`.`editado`,date_format(`dispositivos`.`editado`,'%d/%m/%Y %h:%i %p'),'')" => "editado",
		"`dispositivos`.`editado_por`" => "editado_por",
		"IF(    CHAR_LENGTH(`compra_dispo1`.`id`), CONCAT_WS('',   `compra_dispo1`.`id`), '') /* Id compra */" => "id_compra_ingreso",
	];
	// mapping incoming sort by requests to actual query fields
	$x->SortFields = [
		1 => 1,
		2 => '`dispositivos`.`id_dispo`',
		3 => '`marca_modelo1`.`img`',
		4 => 4,
		5 => 5,
		6 => '`tipo_dispositivo1`.`tipo_dispositivo`',
		7 => '`marcas1`.`marca`',
		8 => '`marca_modelo1`.`modelo`',
		9 => '`unidades1`.`nombre`',
		10 => 10,
		11 => '`dispositivos`.`fecha_ingreso`',
		12 => '`tipo_clasifica_riesgo1`.`clase`',
		13 => '`tipo_estado_dispo1`.`estado_dispo`',
		14 => '`dispositivos`.`precio`',
		15 => '`dispositivos`.`creado`',
		16 => 16,
		17 => '`dispositivos`.`editado`',
		18 => 18,
		19 => '`compra_dispo1`.`id`',
	];

	// Fields that can be displayed in the csv file
	$x->QueryFieldsCSV = [
		"`dispositivos`.`codigo`" => "codigo",
		"`dispositivos`.`id_dispo`" => "id_dispo",
		"IF(    CHAR_LENGTH(`marca_modelo1`.`img`), CONCAT_WS('',   `marca_modelo1`.`img`), '') /* Foto */" => "foto",
		"`dispositivos`.`code`" => "code",
		"`dispositivos`.`serial`" => "serial",
		"IF(    CHAR_LENGTH(`tipo_dispositivo1`.`tipo_dispositivo`), CONCAT_WS('',   `tipo_dispositivo1`.`tipo_dispositivo`), '') /* Nombre del equipo */" => "tipo_dispositivo",
		"IF(    CHAR_LENGTH(`marcas1`.`marca`), CONCAT_WS('',   `marcas1`.`marca`), '') /* Marca */" => "marca",
		"IF(    CHAR_LENGTH(`marca_modelo1`.`modelo`), CONCAT_WS('',   `marca_modelo1`.`modelo`), '') /* Modelo */" => "modelo",
		"IF(    CHAR_LENGTH(`unidades1`.`nombre`), CONCAT_WS('',   `unidades1`.`nombre`), '') /* Ubicacion */" => "ubicacion",
		"IF(    CHAR_LENGTH(`unidades1`.`abreviado`) || CHAR_LENGTH(`ciudades1`.`ciudad`), CONCAT_WS('',   `unidades1`.`abreviado`, ' - ', `ciudades1`.`ciudad`), '') /* Unidad */" => "ubicacion_abre",
		"if(`dispositivos`.`fecha_ingreso`,date_format(`dispositivos`.`fecha_ingreso`,'%d/%m/%Y'),'')" => "fecha_ingreso",
		"IF(    CHAR_LENGTH(`tipo_clasifica_riesgo1`.`clase`), CONCAT_WS('',   `tipo_clasifica_riesgo1`.`clase`), '') /* Riesgo */" => "clasificacion_riesgo",
		"IF(    CHAR_LENGTH(`tipo_estado_dispo1`.`estado_dispo`), CONCAT_WS('',   `tipo_estado_dispo1`.`estado_dispo`), '') /* Estado */" => "estado",
		"`dispositivos`.`precio`" => "precio",
		"if(`dispositivos`.`creado`,date_format(`dispositivos`.`creado`,'%d/%m/%Y %h:%i %p'),'')" => "creado",
		"`dispositivos`.`creado_por`" => "creado_por",
		"if(`dispositivos`.`editado`,date_format(`dispositivos`.`editado`,'%d/%m/%Y %h:%i %p'),'')" => "editado",
		"`dispositivos`.`editado_por`" => "editado_por",
		"IF(    CHAR_LENGTH(`compra_dispo1`.`id`), CONCAT_WS('',   `compra_dispo1`.`id`), '') /* Id compra */" => "id_compra_ingreso",
	];
	// Fields that can be filtered
	$x->QueryFieldsFilters = [
		"`dispositivos`.`codigo`" => "No.",
		"`dispositivos`.`id_dispo`" => "ID",
		"IF(    CHAR_LENGTH(`marca_modelo1`.`img`), CONCAT_WS('',   `marca_modelo1`.`img`), '') /* Foto */" => "Foto",
		"`dispositivos`.`code`" => "C&#211;DIGO",
		"`dispositivos`.`serial`" => "Serial",
		"IF(    CHAR_LENGTH(`tipo_dispositivo1`.`tipo_dispositivo`), CONCAT_WS('',   `tipo_dispositivo1`.`tipo_dispositivo`), '') /* Nombre del equipo */" => "Nombre del equipo",
		"IF(    CHAR_LENGTH(`marcas1`.`marca`), CONCAT_WS('',   `marcas1`.`marca`), '') /* Marca */" => "Marca",
		"IF(    CHAR_LENGTH(`marca_modelo1`.`modelo`), CONCAT_WS('',   `marca_modelo1`.`modelo`), '') /* Modelo */" => "Modelo",
		"IF(    CHAR_LENGTH(`unidades1`.`nombre`), CONCAT_WS('',   `unidades1`.`nombre`), '') /* Ubicacion */" => "Ubicacion",
		"IF(    CHAR_LENGTH(`unidades1`.`abreviado`) || CHAR_LENGTH(`ciudades1`.`ciudad`), CONCAT_WS('',   `unidades1`.`abreviado`, ' - ', `ciudades1`.`ciudad`), '') /* Unidad */" => "Unidad",
		"`dispositivos`.`fecha_ingreso`" => "Fecha de ingreso",
		"IF(    CHAR_LENGTH(`tipo_clasifica_riesgo1`.`clase`), CONCAT_WS('',   `tipo_clasifica_riesgo1`.`clase`), '') /* Riesgo */" => "Riesgo",
		"IF(    CHAR_LENGTH(`tipo_estado_dispo1`.`estado_dispo`), CONCAT_WS('',   `tipo_estado_dispo1`.`estado_dispo`), '') /* Estado */" => "Estado",
		"`dispositivos`.`precio`" => "Precio",
		"`dispositivos`.`creado`" => "Creado",
		"`dispositivos`.`creado_por`" => "Creado por",
		"`dispositivos`.`editado`" => "Editado",
		"`dispositivos`.`editado_por`" => "Editado por",
		"IF(    CHAR_LENGTH(`compra_dispo1`.`id`), CONCAT_WS('',   `compra_dispo1`.`id`), '') /* Id compra */" => "Id compra",
	];

	// Fields that can be quick searched
	$x->QueryFieldsQS = [
		"`dispositivos`.`codigo`" => "codigo",
		"`dispositivos`.`id_dispo`" => "id_dispo",
		"IF(    CHAR_LENGTH(`marca_modelo1`.`img`), CONCAT_WS('',   `marca_modelo1`.`img`), '') /* Foto */" => "foto",
		"`dispositivos`.`code`" => "code",
		"`dispositivos`.`serial`" => "serial",
		"IF(    CHAR_LENGTH(`tipo_dispositivo1`.`tipo_dispositivo`), CONCAT_WS('',   `tipo_dispositivo1`.`tipo_dispositivo`), '') /* Nombre del equipo */" => "tipo_dispositivo",
		"IF(    CHAR_LENGTH(`marcas1`.`marca`), CONCAT_WS('',   `marcas1`.`marca`), '') /* Marca */" => "marca",
		"IF(    CHAR_LENGTH(`marca_modelo1`.`modelo`), CONCAT_WS('',   `marca_modelo1`.`modelo`), '') /* Modelo */" => "modelo",
		"IF(    CHAR_LENGTH(`unidades1`.`nombre`), CONCAT_WS('',   `unidades1`.`nombre`), '') /* Ubicacion */" => "ubicacion",
		"IF(    CHAR_LENGTH(`unidades1`.`abreviado`) || CHAR_LENGTH(`ciudades1`.`ciudad`), CONCAT_WS('',   `unidades1`.`abreviado`, ' - ', `ciudades1`.`ciudad`), '') /* Unidad */" => "ubicacion_abre",
		"if(`dispositivos`.`fecha_ingreso`,date_format(`dispositivos`.`fecha_ingreso`,'%d/%m/%Y'),'')" => "fecha_ingreso",
		"IF(    CHAR_LENGTH(`tipo_clasifica_riesgo1`.`clase`), CONCAT_WS('',   `tipo_clasifica_riesgo1`.`clase`), '') /* Riesgo */" => "clasificacion_riesgo",
		"IF(    CHAR_LENGTH(`tipo_estado_dispo1`.`estado_dispo`), CONCAT_WS('',   `tipo_estado_dispo1`.`estado_dispo`), '') /* Estado */" => "estado",
		"`dispositivos`.`precio`" => "precio",
		"if(`dispositivos`.`creado`,date_format(`dispositivos`.`creado`,'%d/%m/%Y %h:%i %p'),'')" => "creado",
		"`dispositivos`.`creado_por`" => "creado_por",
		"if(`dispositivos`.`editado`,date_format(`dispositivos`.`editado`,'%d/%m/%Y %h:%i %p'),'')" => "editado",
		"`dispositivos`.`editado_por`" => "editado_por",
		"IF(    CHAR_LENGTH(`compra_dispo1`.`id`), CONCAT_WS('',   `compra_dispo1`.`id`), '') /* Id compra */" => "id_compra_ingreso",
	];

	// Lookup fields that can be used as filterers
	$x->filterers = ['tipo_dispositivo' => 'Nombre del equipo', 'marca' => 'Marca', 'modelo' => 'Modelo', 'ubicacion' => 'Ubicacion', 'clasificacion_riesgo' => 'Riesgo', 'estado' => 'Estado', 'id_compra_ingreso' => 'Id compra', ];

	$x->QueryFrom = "`dispositivos` LEFT JOIN `tipo_dispositivo` as tipo_dispositivo1 ON `tipo_dispositivo1`.`id_tipodispo`=`dispositivos`.`tipo_dispositivo` LEFT JOIN `marcas` as marcas1 ON `marcas1`.`id_marca`=`dispositivos`.`marca` LEFT JOIN `marca_modelo` as marca_modelo1 ON `marca_modelo1`.`id_mmodelo`=`dispositivos`.`modelo` LEFT JOIN `unidades` as unidades1 ON `unidades1`.`id_unidades`=`dispositivos`.`ubicacion` LEFT JOIN `tipo_clasifica_riesgo` as tipo_clasifica_riesgo1 ON `tipo_clasifica_riesgo1`.`id`=`dispositivos`.`clasificacion_riesgo` LEFT JOIN `tipo_estado_dispo` as tipo_estado_dispo1 ON `tipo_estado_dispo1`.`id`=`dispositivos`.`estado` LEFT JOIN `compra_dispo` as compra_dispo1 ON `compra_dispo1`.`id`=`dispositivos`.`id_compra_ingreso` LEFT JOIN `ciudades` as ciudades1 ON `ciudades1`.`id_ciudad`=`unidades1`.`ciudad` ";
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
	$x->RecordsPerPage = 50;
	$x->QuickSearch = 1;
	$x->QuickSearchText = $Translation['quick search'];
	$x->ScriptFileName = 'dispositivos_view.php';
	$x->RedirectAfterInsert = 'dispositivos_view.php?SelectedID=#ID#';
	$x->TableTitle = 'Dispositivos Biomedicos';
	$x->TableIcon = 'resources/table_icons/application_view_icons.png';
	$x->PrimaryKey = '`dispositivos`.`id_dispo`';
	$x->DefaultSortField = '`dispositivos`.`creado`';
	$x->DefaultSortDirection = 'desc';

	$x->ColWidth = [150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, ];
	$x->ColCaption = ['No.', 'Foto', 'C&#211;DIGO', 'Serial', 'Nombre del equipo', 'Marca', 'Modelo', 'Ubicacion', 'Fecha de ingreso', 'Riesgo', 'Estado', ];
	$x->ColFieldName = ['codigo', 'foto', 'code', 'serial', 'tipo_dispositivo', 'marca', 'modelo', 'ubicacion', 'fecha_ingreso', 'clasificacion_riesgo', 'estado', ];
	$x->ColNumber  = [1, 3, 4, 5, 6, 7, 8, 9, 11, 12, 13, ];

	// template paths below are based on the app main directory
	$x->Template = 'templates/dispositivos_templateTV.html';
	$x->SelectedTemplate = 'templates/dispositivos_templateTVS.html';
	$x->TemplateDV = 'templates/dispositivos_templateDV.html';
	$x->TemplateDVP = 'templates/dispositivos_templateDVP.html';

	$x->ShowTableHeader = 1;
	$x->TVClasses = "";
	$x->DVClasses = "";
	$x->HasCalculatedFields = true;
	$x->AllowConsoleLog = false;
	$x->AllowDVNavigation = true;

	// hook: dispositivos_init
	$render = true;
	if(function_exists('dispositivos_init')) {
		$args = [];
		$render = dispositivos_init($x, getMemberInfo(), $args);
	}

	if($render) $x->Render();

	// hook: dispositivos_header
	$headerCode = '';
	if(function_exists('dispositivos_header')) {
		$args = [];
		$headerCode = dispositivos_header($x->ContentType, getMemberInfo(), $args);
	}

	if(!$headerCode) {
		include_once("{$currDir}/header.php"); 
	} else {
		ob_start();
		include_once("{$currDir}/header.php");
		echo str_replace('<%%HEADER%%>', ob_get_clean(), $headerCode);
	}

	echo $x->HTML;

	// hook: dispositivos_footer
	$footerCode = '';
	if(function_exists('dispositivos_footer')) {
		$args = [];
		$footerCode = dispositivos_footer($x->ContentType, getMemberInfo(), $args);
	}

	if(!$footerCode) {
		include_once("{$currDir}/footer.php"); 
	} else {
		ob_start();
		include_once("{$currDir}/footer.php");
		echo str_replace('<%%FOOTER%%>', ob_get_clean(), $footerCode);
	}
