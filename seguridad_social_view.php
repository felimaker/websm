<?php
// This script and data application were generated by AppGini 5.97
// Download AppGini for free from https://bigprof.com/appgini/download/

	$currDir = dirname(__FILE__);
	include_once("{$currDir}/lib.php");
	@include_once("{$currDir}/hooks/seguridad_social.php");
	include_once("{$currDir}/seguridad_social_dml.php");

	// mm: can the current member access this page?
	$perm = getTablePermissions('seguridad_social');
	if(!$perm['access']) {
		echo error_message($Translation['tableAccessDenied']);
		exit;
	}

	$x = new DataList;
	$x->TableName = 'seguridad_social';

	// Fields that can be displayed in the table view
	$x->QueryFieldsTV = [
		"`seguridad_social`.`id`" => "id",
		"IF(    CHAR_LENGTH(`perfil1`.`nombre`) || CHAR_LENGTH(`perfil1`.`apellidos`), CONCAT_WS('',   `perfil1`.`nombre`, ' ', `perfil1`.`apellidos`), '') /* Usuario */" => "id_perfil",
		"IF(    CHAR_LENGTH(`tipo_documento_ss1`.`tipo_doc`), CONCAT_WS('',   `tipo_documento_ss1`.`tipo_doc`), '') /* Tipo documento */" => "tipo_documento",
		"`seguridad_social`.`docuemento`" => "docuemento",
		"`seguridad_social`.`descripcion`" => "descripcion",
		"if(`seguridad_social`.`creado`,date_format(`seguridad_social`.`creado`,'%d/%m/%Y %h:%i %p'),'')" => "creado",
		"`seguridad_social`.`creado_por`" => "creado_por",
	];
	// mapping incoming sort by requests to actual query fields
	$x->SortFields = [
		1 => '`seguridad_social`.`id`',
		2 => 2,
		3 => '`tipo_documento_ss1`.`tipo_doc`',
		4 => 4,
		5 => 5,
		6 => '`seguridad_social`.`creado`',
		7 => 7,
	];

	// Fields that can be displayed in the csv file
	$x->QueryFieldsCSV = [
		"`seguridad_social`.`id`" => "id",
		"IF(    CHAR_LENGTH(`perfil1`.`nombre`) || CHAR_LENGTH(`perfil1`.`apellidos`), CONCAT_WS('',   `perfil1`.`nombre`, ' ', `perfil1`.`apellidos`), '') /* Usuario */" => "id_perfil",
		"IF(    CHAR_LENGTH(`tipo_documento_ss1`.`tipo_doc`), CONCAT_WS('',   `tipo_documento_ss1`.`tipo_doc`), '') /* Tipo documento */" => "tipo_documento",
		"`seguridad_social`.`docuemento`" => "docuemento",
		"`seguridad_social`.`descripcion`" => "descripcion",
		"if(`seguridad_social`.`creado`,date_format(`seguridad_social`.`creado`,'%d/%m/%Y %h:%i %p'),'')" => "creado",
		"`seguridad_social`.`creado_por`" => "creado_por",
	];
	// Fields that can be filtered
	$x->QueryFieldsFilters = [
		"`seguridad_social`.`id`" => "ID",
		"IF(    CHAR_LENGTH(`perfil1`.`nombre`) || CHAR_LENGTH(`perfil1`.`apellidos`), CONCAT_WS('',   `perfil1`.`nombre`, ' ', `perfil1`.`apellidos`), '') /* Usuario */" => "Usuario",
		"IF(    CHAR_LENGTH(`tipo_documento_ss1`.`tipo_doc`), CONCAT_WS('',   `tipo_documento_ss1`.`tipo_doc`), '') /* Tipo documento */" => "Tipo documento",
		"`seguridad_social`.`docuemento`" => "Docuemento",
		"`seguridad_social`.`descripcion`" => "Nombre documento",
		"`seguridad_social`.`creado`" => "Creado",
		"`seguridad_social`.`creado_por`" => "Creado por",
	];

	// Fields that can be quick searched
	$x->QueryFieldsQS = [
		"`seguridad_social`.`id`" => "id",
		"IF(    CHAR_LENGTH(`perfil1`.`nombre`) || CHAR_LENGTH(`perfil1`.`apellidos`), CONCAT_WS('',   `perfil1`.`nombre`, ' ', `perfil1`.`apellidos`), '') /* Usuario */" => "id_perfil",
		"IF(    CHAR_LENGTH(`tipo_documento_ss1`.`tipo_doc`), CONCAT_WS('',   `tipo_documento_ss1`.`tipo_doc`), '') /* Tipo documento */" => "tipo_documento",
		"`seguridad_social`.`docuemento`" => "docuemento",
		"`seguridad_social`.`descripcion`" => "descripcion",
		"if(`seguridad_social`.`creado`,date_format(`seguridad_social`.`creado`,'%d/%m/%Y %h:%i %p'),'')" => "creado",
		"`seguridad_social`.`creado_por`" => "creado_por",
	];

	// Lookup fields that can be used as filterers
	$x->filterers = ['id_perfil' => 'Usuario', 'tipo_documento' => 'Tipo documento', ];

	$x->QueryFrom = "`seguridad_social` LEFT JOIN `perfil` as perfil1 ON `perfil1`.`id`=`seguridad_social`.`id_perfil` LEFT JOIN `tipo_documento_ss` as tipo_documento_ss1 ON `tipo_documento_ss1`.`id_tipodoc`=`seguridad_social`.`tipo_documento` ";
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
	$x->ScriptFileName = 'seguridad_social_view.php';
	$x->RedirectAfterInsert = 'seguridad_social_view.php?SelectedID=#ID#';
	$x->TableTitle = 'Soportes SS';
	$x->TableIcon = 'resources/table_icons/document_inspector.png';
	$x->PrimaryKey = '`seguridad_social`.`id`';

	$x->ColWidth = [150, 150, 150, 150, 150, 150, ];
	$x->ColCaption = ['Usuario', 'Tipo documento', 'Docuemento', 'Nombre documento', 'Creado', 'Creado por', ];
	$x->ColFieldName = ['id_perfil', 'tipo_documento', 'docuemento', 'descripcion', 'creado', 'creado_por', ];
	$x->ColNumber  = [2, 3, 4, 5, 6, 7, ];

	// template paths below are based on the app main directory
	$x->Template = 'templates/seguridad_social_templateTV.html';
	$x->SelectedTemplate = 'templates/seguridad_social_templateTVS.html';
	$x->TemplateDV = 'templates/seguridad_social_templateDV.html';
	$x->TemplateDVP = 'templates/seguridad_social_templateDVP.html';

	$x->ShowTableHeader = 1;
	$x->TVClasses = "";
	$x->DVClasses = "";
	$x->HasCalculatedFields = false;
	$x->AllowConsoleLog = false;
	$x->AllowDVNavigation = true;

	// hook: seguridad_social_init
	$render = true;
	if(function_exists('seguridad_social_init')) {
		$args = [];
		$render = seguridad_social_init($x, getMemberInfo(), $args);
	}

	if($render) $x->Render();

	// hook: seguridad_social_header
	$headerCode = '';
	if(function_exists('seguridad_social_header')) {
		$args = [];
		$headerCode = seguridad_social_header($x->ContentType, getMemberInfo(), $args);
	}

	if(!$headerCode) {
		include_once("{$currDir}/header.php"); 
	} else {
		ob_start();
		include_once("{$currDir}/header.php");
		echo str_replace('<%%HEADER%%>', ob_get_clean(), $headerCode);
	}

	echo $x->HTML;

	// hook: seguridad_social_footer
	$footerCode = '';
	if(function_exists('seguridad_social_footer')) {
		$args = [];
		$footerCode = seguridad_social_footer($x->ContentType, getMemberInfo(), $args);
	}

	if(!$footerCode) {
		include_once("{$currDir}/footer.php"); 
	} else {
		ob_start();
		include_once("{$currDir}/footer.php");
		echo str_replace('<%%FOOTER%%>', ob_get_clean(), $footerCode);
	}
