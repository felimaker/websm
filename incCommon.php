<?php

	#########################################################
	/*
	~~~~~~ LIST OF FUNCTIONS ~~~~~~
		getTableList() -- returns an associative array (tableName => tableData, tableData is array(tableCaption, tableDescription, tableIcon)) of tables accessible by current user
		get_table_groups() -- returns an associative array (table_group => tables_array)
		logInMember() -- checks POST login. If not valid, redirects to index.php, else returns TRUE
		getTablePermissions($tn) -- returns an array of permissions allowed for logged member to given table (allowAccess, allowInsert, allowView, allowEdit, allowDelete) -- allowAccess is set to true if any access level is allowed
		get_sql_fields($tn) -- returns the SELECT part of the table view query
		get_sql_from($tn[, true, [, false]]) -- returns the FROM part of the table view query, with full joins (unless third paramaeter is set to true), optionally skipping permissions if true passed as 2nd param.
		get_joined_record($table, $id[, true]) -- returns assoc array of record values for given PK value of given table, with full joins, optionally skipping permissions if true passed as 3rd param.
		get_defaults($table) -- returns assoc array of table fields as array keys and default values (or empty), excluding automatic values as array values
		htmlUserBar() -- returns html code for displaying user login status to be used on top of pages.
		showNotifications($msg, $class) -- returns html code for displaying a notification. If no parameters provided, processes the GET request for possible notifications.
		parseMySQLDate(a, b) -- returns a if valid mysql date, or b if valid mysql date, or today if b is true, or empty if b is false.
		parseCode(code) -- calculates and returns special values to be inserted in automatic fields.
		addFilter(i, filterAnd, filterField, filterOperator, filterValue) -- enforce a filter over data
		clearFilters() -- clear all filters
		loadView($view, $data) -- passes $data to templates/{$view}.php and returns the output
		loadTable($table, $data) -- loads table template, passing $data to it
		filterDropdownBy($filterable, $filterers, $parentFilterers, $parentPKField, $parentCaption, $parentTable, &$filterableCombo) -- applies cascading drop-downs for a lookup field, returns js code to be inserted into the page
		br2nl($text) -- replaces all variations of HTML <br> tags with a new line character
		htmlspecialchars_decode($text) -- inverse of htmlspecialchars()
		entitiesToUTF8($text) -- convert unicode entities (e.g. &#1234;) to actual UTF8 characters, requires multibyte string PHP extension
		func_get_args_byref() -- returns an array of arguments passed to a function, by reference
		permissions_sql($table, $level) -- returns an array containing the FROM and WHERE additions for applying permissions to an SQL query
		error_message($msg[, $back_url]) -- returns html code for a styled error message .. pass explicit false in second param to suppress back button
		toMySQLDate($formattedDate, $sep = datalist_date_separator, $ord = datalist_date_format)
		reIndex(&$arr) -- returns a copy of the given array, with keys replaced by 1-based numeric indices, and values replaced by original keys
		get_embed($provider, $url[, $width, $height, $retrieve]) -- returns embed code for a given url (supported providers: youtube, googlemap)
		check_record_permission($table, $id, $perm = 'view') -- returns true if current user has the specified permission $perm ('view', 'edit' or 'delete') for the given recors, false otherwise
		NavMenus($options) -- returns the HTML code for the top navigation menus. $options is not implemented currently.
		StyleSheet() -- returns the HTML code for included style sheet files to be placed in the <head> section.
		getUploadDir($dir) -- if dir is empty, returns upload dir configured in defaultLang.php, else returns $dir.
		PrepareUploadedFile($FieldName, $MaxSize, $FileTypes='jpg|jpeg|gif|png', $NoRename=false, $dir="") -- validates and moves uploaded file for given $FieldName into the given $dir (or the default one if empty)
		get_home_links($homeLinks, $default_classes, $tgroup) -- process $homeLinks array and return custom links for homepage. Applies $default_classes to links if links have classes defined, and filters links by $tgroup (using '*' matches all table_group values)
		quick_search_html($search_term, $label, $separate_dv = true) -- returns HTML code for the quick search box.
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
	*/

	#########################################################

	function getTableList($skip_authentication = false) {
		$arrAccessTables = [];
		$arrTables = [
			/* 'table_name' => ['table caption', 'homepage description', 'icon', 'table group name'] */   
			'dispositivos' => ['Dispositivos Biomedicos', 'Dispositivos digitales biomedicos y accesorios dentro de la unidad<br><br>Ingrese el NUMERO del codigo sin prefijo segun corresponda<br><br>HOLTER (101 - 200)<br>ECOGRAFOS (201 - 229)<br>TERMOHIGROMETROS (230 - 250)<br>TRANSDUCTORES (251 - 300)<br>ECG (301 - 319)<br>BASCULAS (320 - 350)<br>CABLES (351 - 400)<br>DIGITALIZADORES (401 - 450)<br>DESFIBRILADORES (451 - 500)<br>BOMBAS DE INFUSION (501 - 525)<br>APIRADORES (526 - 549)<br>MAPAS (550 - 600)<br>COMPUTADORES (601 - 700)<br>BANDA TROTADORA (701 - 730)<br>TERMOMETROS (731 - 750)<br>STRESS TEST (751 - 780)<br>REGULADORES DE O2 (781 - 800)<br>DISPONIBLE (801 - 999)', 'resources/table_icons/application_view_icons.png', 'BIOMEDICOS'],
			'mobiliario' => ['Mobiliario', 'Inventario del mobiliario para cada unidad', 'resources/table_icons/brick_add.png', 'ARTICULOS'],
			'contactos' => ['Contactos', 'Proveedores, Clientes, Socios y Apoyo', 'resources/table_icons/ceo.png', 'PERSONAS'],
			'contactos_tipo_contacto' => ['Tipo de contacto', '', 'resources/table_icons/cog_add.png', 'TIPOS'],
			'movimientos' => ['Movimientos', 'Registro de movimientos de dispositivos', 'resources/table_icons/arrow_branch.png', 'BIOMEDICOS'],
			'documentos' => ['Documentos del dispositivo', 'Carga de documentos por dispositivo', 'resources/table_icons/page_add.png', 'BIOMEDICOS'],
			'mantenimientos' => ['Mantenimientos', 'Registro de mantenimientos a equipos biomedicos', 'resources/table_icons/book_add.png', 'BIOMEDICOS'],
			'calibraciones' => ['Calibraciones', 'Registro de calibraciones a equipos biomedicos', 'resources/table_icons/document_next.png', 'BIOMEDICOS'],
			'unidades' => ['Unidades Medicas', 'Informacion de las unidades medicas', 'resources/table_icons/building_add.png', 'INVENTARIO'],
			'marcas' => ['Marcas', '', 'resources/table_icons/ebay.png', 'INVENTARIO'],
			'marca_modelo' => ['Marca y Modelo', 'Marca y Modelo del dispositivo', 'resources/table_icons/ebay.png', 'INVENTARIO'],
			'accesorios' => ['Accesorios', '', 'resources/table_icons/basket_add.png', 'INVENTARIO'],
			'ciudades' => ['Ciudades', '', 'resources/table_icons/domain_template.png', 'CONFIG'],
			'verificacion' => ['Verificacion', 'Con esta verificacion actualizas automaticamente el lugar donde se encuentra ubicado el dispositivo', 'resources/table_icons/accept.png', 'BIOMEDICOS'],
			'hojadevida' => ['Hoja de vida', 'Hoja de vida en linea', 'resources/table_icons/application_view_list.png', 'BIOMEDICOS'],
			'financiero' => ['Financiero D', 'Financiero de Dispositivos', 'resources/table_icons/coins.png', 'INVENTARIO'],
			'financiero_mobiliario' => ['Financiero M', 'Financiero de Mobiliario', 'resources/table_icons/coins.png', 'ARTICULOS'],
			'prestador' => ['Prestador', '', 'resources/table_icons/award_star_add.png', 'CONFIG'],
			'docu_modelo' => ['Documentos del modelo', '', 'resources/table_icons/document_import.png', 'BIOMEDICOS'],
			'facturas' => ['Facturas', '', 'resources/table_icons/application_form_add.png', 'BIOMEDICOS'],
			'formatos' => ['Formatos', '', 'resources/table_icons/align_right.png', 'BIOMEDICOS'],
			'dispo_fuera' => ['Dispositivos da Baja', 'Reporte de equipos y dispositivos dados de baja', 'resources/table_icons/mail-trash.png', 'INVENTARIO'],
			'dispositivo_tipo_grupo' => ['Grupo del dispositivo', '', 'resources/table_icons/cog_add.png', 'TIPOS'],
			'tipo_relacion' => ['Tipo de relacion', '', 'resources/table_icons/cog_add.png', 'TIPOS'],
			'tipo_dispositivo' => ['Tipo de dispositivo', '', 'resources/table_icons/cog_add.png', 'TIPOS'],
			'tipo_documento' => ['Tipo de documento', '', 'resources/table_icons/cog_add.png', 'TIPOS'],
			'tipo_iden' => ['Tipo de identificacion', '', 'resources/table_icons/cog_add.png', 'TIPOS'],
			'tipo_razon_social' => ['Tipo de razon social', '', 'resources/table_icons/cog_add.png', 'TIPOS'],
			'tipo_mobiliario' => ['Tipo de Mobiliario', '', 'resources/table_icons/cog_add.png', 'TIPOS'],
			'tipo_grupo_mobilia' => ['Tipo grupo mobiliario', 'Tipos de grupo en mobiliario de la unidad', 'resources/table_icons/cog_add.png', 'TIPOS'],
			'tipo_estado_dispo' => ['Estado del dispositivo', 'Estado del dispositivo', 'resources/table_icons/cog_add.png', 'TIPOS'],
			'tipo_movimiento' => ['Tipo de movimiento', '', 'resources/table_icons/cog_add.png', 'TIPOS'],
			'tipo_estado_movi' => ['Estado del movimiento', '', 'resources/table_icons/cog_add.png', 'TIPOS'],
			'tipo_estado_verifica' => ['Tipo estado de verificacion', '', 'resources/table_icons/cog_add.png', 'TIPOS'],
			'tipo_mtto' => ['Tipo de mantenimiento', '', 'resources/table_icons/cog_add.png', 'TIPOS'],
			'tipo_calibracion' => ['Tipo calibracion', '', 'resources/table_icons/cog_add.png', 'TIPOS'],
			'tipo_accesorio' => ['Tipo accesorio', '', 'resources/table_icons/cog_add.png', 'TIPOS'],
			'tipo_formatos' => ['Tipo formatos', '', 'resources/table_icons/cog_add.png', 'TIPOS'],
			'dispo_detalles_tecnicos' => ['Detalles tecnicos', 'Detalles tecnicos del dispositivo', 'resources/table_icons/application_view_detail.png', 'BIOMEDICOS'],
			'tipo_estado_observaciones' => ['Tipo estado observaciones', '', 'resources/table_icons/cog_add.png', 'TIPOS'],
			'movi_envio' => ['Envio', '', 'resources/table_icons/arrow_right.png', 'BIOMEDICOS'],
			'movi_recepcion' => ['Recepcion', '', 'resources/table_icons/arrow_refresh.png', 'BIOMEDICOS'],
			'tipo_fuera_servicio' => ['Tipo fuera servicio', '', 'resources/table_icons/cog_add.png', 'TIPOS'],
			'tipo_documento_ss' => ['Tipo de documento', '', 'resources/table_icons/cog_add.png', 'TIPOS'],
			'tipo_parentesco' => ['Tipo de parentesco', '', 'resources/table_icons/cog_add.png', 'TIPOS'],
			'tipo_rh' => ['Tipo rh', '', 'resources/table_icons/cog_add.png', 'TIPOS'],
			'accesorio_dispo_relacion' => ['Dispositivo relacionado', '', 'resources/table_icons/nokia_s60.png', 'BIOMEDICOS'],
			'observaciones' => ['Observaciones', '', 'resources/table_icons/radioactivity.png', 'INVENTARIO'],
			'foto_observacion' => ['Fotos Observaciones', '', 'resources/table_icons/pictures.png', 'INVENTARIO'],
			'progreso' => ['Progreso', 'Progreso de las observaciones', 'resources/table_icons/progressbar.png', 'INVENTARIO'],
			'tipo_estado_observa' => ['Tipo estado observa', '', 'resources/table_icons/cog_add.png', 'TIPOS'],
			'acceso_remoto' => ['Acceso remoto', 'Ingreso remoto AnyDesk y Teamviewer', 'resources/table_icons/dns.png', 'BIOMEDICOS'],
			'tipo_periodicidad' => ['Tipo periodicidad', '', 'resources/table_icons/cog_add.png', 'TIPOS'],
			'perfil' => ['Perfil', '', 'resources/table_icons/user.png', 'PERSONAS'],
			'consentimieto' => ['Consentimieto', '', 'resources/table_icons/document_next.png', 'PERSONAS'],
			'perfil_familia' => ['Familia', '', 'resources/table_icons/client_account_template.png', 'PERSONAS'],
			'perfil_soportes' => ['Soportes Perfil', '', 'resources/table_icons/education.png', 'PERSONAS'],
			'seguridad_social' => ['Soportes SS', '', 'resources/table_icons/document_inspector.png', 'PERSONAS'],
			'costos_mtto' => ['Costos en mantenimiento', '', 'resources/table_icons/coins_add.png', 'BIOMEDICOS'],
			'tipo_costo' => ['Tipo costo', '', 'resources/table_icons/cog_add.png', 'TIPOS'],
			'doc_mtto' => ['Doc mtto', '', 'resources/table_icons/attributes_display.png', 'BIOMEDICOS'],
			'biomedicos' => ['Biomedicos', '', 'resources/table_icons/administrator.png', 'PERSONAS'],
			'tipo_clasifica_riesgo' => ['Tipo clasifica riesgo', 'Deacuerdo al ABC de dispositivos medicos.', 'resources/table_icons/cog_add.png', 'TIPOS'],
			'programa_mtto' => ['Programa mtto', '', 'resources/table_icons/book_add.png', 'BIOMEDICOS'],
			'cronograma_mtto' => ['Cronograma mtto', '', 'resources/table_icons/application_form_add.png', 'BIOMEDICOS'],
			'compras' => ['Ingreso / Salida', 'Registro de ingreso y salida', 'resources/table_icons/accept.png', 'COMPRAS'],
			'tipo_estado_compra' => ['Tipo estado compra', 'Aceptado, Rechazado, En proceso', 'resources/table_icons/cog_add.png', 'COMPRAS'],
			'cantidad_dispomedico' => ['Dispositivos Biomedicos Nuevos', 'Toda clase de dispositivos biomedicos que midan o se instalen al paciente', 'resources/table_icons/basket_add.png', 'COMPRAS'],
			'cantidad_articulos' => ['Articulos Nuevos', 'Cantidad de articulos', 'resources/table_icons/cart_add.png', 'COMPRAS'],
			'cantidad_mobiliario' => ['Mobiliario Nuevo', '', 'resources/table_icons/brick_add.png', 'COMPRAS'],
			'compra_dispo' => ['Dispo Biomedicos Comprados', 'Dispositivos medicos comprados', 'resources/table_icons/computer_add.png', 'COMPRAS'],
			'articulos' => ['Articulos', 'Toda clase de articulos dispositivos y equipos que no son equipos biomedicos.', 'resources/table_icons/monitor_add.png', 'ARTICULOS'],
			'cofig' => ['CONFIG', 'Configuraciones de filtros en listas', 'resources/table_icons/cog_add.png', 'CONFIG'],
			'marca_presetacion' => ['Marca presetacion', '', 'resources/table_icons/cog_add.png', 'ARTICULOS'],
			'tipo_document_grupo' => ['Tipo grupo documento', '', 'resources/table_icons/cog_add.png', 'TIPOS'],
			'tipo_pago' => ['Tipo pago', '', 'resources/table_icons/cog_add.png', 'TIPOS'],
			'tipo_compra' => ['Tipo compra', 'Orden de compra, Ingreso de compra', 'resources/table_icons/cog_add.png', 'TIPOS'],
			'articulos_familia' => ['Articulos familia', '', 'resources/table_icons/cog_add.png', 'ARTICULOS'],
			'articulo_codigo_proveedor' => ['Articulo codigo proveedor', '', 'resources/table_icons/cog_add.png', 'ARTICULOS'],
			'tipo_unidad_medida' => ['Tipo unidad medida', '', 'resources/table_icons/cog_add.png', 'TIPOS'],
			'genera_documentos' => ['Genera documentos', '', 'resources/table_icons/cog_add.png', 'BIOMEDICOS'],
			'verificacion_articulos' => ['Verificacion', 'Con esta verificacion actualizas automaticamente el lugar donde se encuentra ubicado el dispositivo', 'resources/table_icons/accept.png', 'ARTICULOS'],
			'movimientos_articulos' => ['Movimientos', 'Registro de movimientos de articulos', 'resources/table_icons/arrow_branch.png', 'ARTICULOS'],
			'movi_envio_articulo' => ['Envio', '', 'resources/table_icons/arrow_right.png', 'ARTICULOS'],
			'movi_recepcion_articulos' => ['Recepcion', '', 'resources/table_icons/arrow_refresh.png', 'ARTICULOS'],
			'ubicacion_articulo' => ['Ubicacion articulo', '', 'table.gif', 'ARTICULOS'],
			'ubicacion_mobiliario' => ['Ubicacion mobiliario', '', 'table.gif', 'BIOMEDICOS'],
			'precio_dispo_medico' => ['Precio dispo medico', '', 'table.gif', 'BIOMEDICOS'],
			'precio_articulo' => ['Precio articulo', '', 'resources/table_icons/coins_add.png', 'ARTICULOS'],
			'precio_mobiliario' => ['Precio mobiliario', '', 'resources/table_icons/coins_add.png', 'ARTICULOS'],
		];
		if($skip_authentication || getLoggedAdmin()) return $arrTables;

		if(is_array($arrTables)) {
			foreach($arrTables as $tn => $tc) {
				$arrPerm = getTablePermissions($tn);
				if($arrPerm['access']) $arrAccessTables[$tn] = $tc;
			}
		}

		return $arrAccessTables;
	}

	#########################################################

	function get_table_groups($skip_authentication = false) {
		$tables = getTableList($skip_authentication);
		$all_groups = ['BIOMEDICOS', 'ARTICULOS', 'INVENTARIO', 'PERSONAS', 'TIPOS', 'COMPRAS', 'CONFIG'];

		$groups = [];
		foreach($all_groups as $grp) {
			foreach($tables as $tn => $td) {
				if($td[3] && $td[3] == $grp) $groups[$grp][] = $tn;
				if(!$td[3]) $groups[0][] = $tn;
			}
		}

		return $groups;
	}

	#########################################################

	function getTablePermissions($tn) {
		static $table_permissions = [];
		if(isset($table_permissions[$tn])) return $table_permissions[$tn];

		$groupID = getLoggedGroupID();
		$memberID = makeSafe(getLoggedMemberID());
		$res_group = sql("SELECT `tableName`, `allowInsert`, `allowView`, `allowEdit`, `allowDelete` FROM `membership_grouppermissions` WHERE `groupID`='{$groupID}'", $eo);
		$res_user  = sql("SELECT `tableName`, `allowInsert`, `allowView`, `allowEdit`, `allowDelete` FROM `membership_userpermissions`  WHERE LCASE(`memberID`)='{$memberID}'", $eo);

		while($row = db_fetch_assoc($res_group)) {
			$table_permissions[$row['tableName']] = [
				1 => intval($row['allowInsert']),
				2 => intval($row['allowView']),
				3 => intval($row['allowEdit']),
				4 => intval($row['allowDelete']),
				'insert' => intval($row['allowInsert']),
				'view' => intval($row['allowView']),
				'edit' => intval($row['allowEdit']),
				'delete' => intval($row['allowDelete'])
			];
		}

		// user-specific permissions, if specified, overwrite his group permissions
		while($row = db_fetch_assoc($res_user)) {
			$table_permissions[$row['tableName']] = [
				1 => intval($row['allowInsert']),
				2 => intval($row['allowView']),
				3 => intval($row['allowEdit']),
				4 => intval($row['allowDelete']),
				'insert' => intval($row['allowInsert']),
				'view' => intval($row['allowView']),
				'edit' => intval($row['allowEdit']),
				'delete' => intval($row['allowDelete'])
			];
		}

		// if user has any type of access, set 'access' flag
		foreach($table_permissions as $t => $p) {
			$table_permissions[$t]['access'] = $table_permissions[$t][0] = false;

			if($p['insert'] || $p['view'] || $p['edit'] || $p['delete']) {
				$table_permissions[$t]['access'] = $table_permissions[$t][0] = true;
			}
		}

		return $table_permissions[$tn];
	}

	#########################################################

	function get_sql_fields($table_name) {
		$sql_fields = [
			'dispositivos' => "`dispositivos`.`codigo` as 'codigo', `dispositivos`.`id_dispo` as 'id_dispo', IF(    CHAR_LENGTH(`marca_modelo1`.`img`), CONCAT_WS('',   `marca_modelo1`.`img`), '') as 'foto', `dispositivos`.`code` as 'code', `dispositivos`.`serial` as 'serial', IF(    CHAR_LENGTH(`tipo_dispositivo1`.`tipo_dispositivo`), CONCAT_WS('',   `tipo_dispositivo1`.`tipo_dispositivo`), '') as 'tipo_dispositivo', IF(    CHAR_LENGTH(`marcas1`.`marca`), CONCAT_WS('',   `marcas1`.`marca`), '') as 'marca', IF(    CHAR_LENGTH(`marca_modelo1`.`modelo`), CONCAT_WS('',   `marca_modelo1`.`modelo`), '') as 'modelo', IF(    CHAR_LENGTH(`unidades1`.`nombre`), CONCAT_WS('',   `unidades1`.`nombre`), '') as 'ubicacion', IF(    CHAR_LENGTH(`unidades1`.`abreviado`) || CHAR_LENGTH(`ciudades1`.`ciudad`), CONCAT_WS('',   `unidades1`.`abreviado`, ' - ', `ciudades1`.`ciudad`), '') as 'ubicacion_abre', if(`dispositivos`.`fecha_ingreso`,date_format(`dispositivos`.`fecha_ingreso`,'%d/%m/%Y'),'') as 'fecha_ingreso', IF(    CHAR_LENGTH(`tipo_clasifica_riesgo1`.`clase`), CONCAT_WS('',   `tipo_clasifica_riesgo1`.`clase`), '') as 'clasificacion_riesgo', IF(    CHAR_LENGTH(`tipo_estado_dispo1`.`estado_dispo`), CONCAT_WS('',   `tipo_estado_dispo1`.`estado_dispo`), '') as 'estado', `dispositivos`.`precio` as 'precio', if(`dispositivos`.`creado`,date_format(`dispositivos`.`creado`,'%d/%m/%Y %h:%i %p'),'') as 'creado', `dispositivos`.`creado_por` as 'creado_por', if(`dispositivos`.`editado`,date_format(`dispositivos`.`editado`,'%d/%m/%Y %h:%i %p'),'') as 'editado', `dispositivos`.`editado_por` as 'editado_por', IF(    CHAR_LENGTH(`compra_dispo1`.`id`), CONCAT_WS('',   `compra_dispo1`.`id`), '') as 'id_compra_ingreso'",
			'mobiliario' => "`mobiliario`.`id_mobiliario` as 'id_mobiliario', `mobiliario`.`codigo` as 'codigo', `mobiliario`.`nombre` as 'nombre', IF(    CHAR_LENGTH(`tipo_grupo_mobilia1`.`grupo`), CONCAT_WS('',   `tipo_grupo_mobilia1`.`grupo`), '') as 'grupo', IF(    CHAR_LENGTH(`tipo_mobiliario1`.`tipo_mobiliario`), CONCAT_WS('',   `tipo_mobiliario1`.`tipo_mobiliario`), '') as 'tipo_mobiliario', `mobiliario`.`descripcion` as 'descripcion', if(`mobiliario`.`fecha_ingreso`,date_format(`mobiliario`.`fecha_ingreso`,'%d/%m/%Y'),'') as 'fecha_ingreso', `mobiliario`.`accesorios` as 'accesorios', `mobiliario`.`foto` as 'foto', IF(    CHAR_LENGTH(`unidades1`.`nombre`), CONCAT_WS('',   `unidades1`.`nombre`), '') as 'unidad', IF(    CHAR_LENGTH(`unidades1`.`abreviado`), CONCAT_WS('',   `unidades1`.`abreviado`), '') as 'uni_abreviado', if(`mobiliario`.`creado`,date_format(`mobiliario`.`creado`,'%d/%m/%Y %h:%i %p'),'') as 'creado', `mobiliario`.`creado_por` as 'creado_por', `mobiliario`.`editado` as 'editado', `mobiliario`.`editado_por` as 'editado_por', `mobiliario`.`id_compra` as 'id_compra'",
			'contactos' => "`contactos`.`id_contactos` as 'id_contactos', IF(    CHAR_LENGTH(`contactos_tipo_contacto1`.`tipo_contacto`), CONCAT_WS('',   `contactos_tipo_contacto1`.`tipo_contacto`), '') as 'tipo_contacto', IF(    CHAR_LENGTH(`tipo_iden1`.`tipo_iden_abre`), CONCAT_WS('',   `tipo_iden1`.`tipo_iden_abre`), '') as 'tipo_iden', `contactos`.`identificacion` as 'identificacion', `contactos`.`nombre` as 'nombre', IF(    CHAR_LENGTH(`ciudades1`.`ciudad`), CONCAT_WS('',   `ciudades1`.`ciudad`), '') as 'ciudad', `contactos`.`telefono` as 'telefono', `contactos`.`direccion` as 'direccion', IF(    CHAR_LENGTH(`tipo_relacion1`.`tipo_relac`), CONCAT_WS('',   `tipo_relacion1`.`tipo_relac`), '') as 'tipo_relacion', `contactos`.`nota` as 'nota', if(`contactos`.`reg_creado`,date_format(`contactos`.`reg_creado`,'%d/%m/%Y %h:%i %p'),'') as 'reg_creado', if(`contactos`.`creado`,date_format(`contactos`.`creado`,'%d/%m/%Y %h:%i %p'),'') as 'creado', `contactos`.`creado_por` as 'creado_por', if(`contactos`.`editado`,date_format(`contactos`.`editado`,'%d/%m/%Y %h:%i %p'),'') as 'editado', `contactos`.`editado_por` as 'editado_por'",
			'contactos_tipo_contacto' => "`contactos_tipo_contacto`.`id_tipo_contacto` as 'id_tipo_contacto', `contactos_tipo_contacto`.`tipo_contacto` as 'tipo_contacto', `contactos_tipo_contacto`.`descripcion` as 'descripcion'",
			'movimientos' => "`movimientos`.`id_movi` as 'id_movi', `movimientos`.`img` as 'img', IF(    CHAR_LENGTH(`tipo_dispositivo1`.`tipo_dispositivo`), CONCAT_WS('',   `tipo_dispositivo1`.`tipo_dispositivo`), '') as 'tipo_dispo', IF(    CHAR_LENGTH(`dispositivos1`.`code`), CONCAT_WS('',   `dispositivos1`.`code`), '') as 'codigo_dispo', IF(    CHAR_LENGTH(`dispositivos1`.`serial`), CONCAT_WS('',   `dispositivos1`.`serial`), '') as 'serial_dispo', IF(    CHAR_LENGTH(`tipo_estado_movi1`.`estado_movi`), CONCAT_WS('',   `tipo_estado_movi1`.`estado_movi`), '') as 'estado_movi', `movimientos`.`origen` as 'origen', `movimientos`.`destino` as 'destino', if(`movimientos`.`creado`,date_format(`movimientos`.`creado`,'%d/%m/%Y %h:%i %p'),'') as 'creado', `movimientos`.`creado_por` as 'creado_por', if(`movimientos`.`editado`,date_format(`movimientos`.`editado`,'%d/%m/%Y %h:%i %p'),'') as 'editado', `movimientos`.`editado_por` as 'editado_por'",
			'documentos' => "`documentos`.`id` as 'id', IF(    CHAR_LENGTH(`dispositivos1`.`code`), CONCAT_WS('',   `dispositivos1`.`code`), '') as 'dispo_codigo', IF(    CHAR_LENGTH(`dispositivos1`.`serial`), CONCAT_WS('',   `dispositivos1`.`serial`), '') as 'dispo_serial', IF(    CHAR_LENGTH(`tipo_documento1`.`tipo_doc`), CONCAT_WS('',   `tipo_documento1`.`tipo_doc`), '') as 'tipo_docu', `documentos`.`enlace` as 'enlace', `documentos`.`descripcion` as 'descripcion', `documentos`.`fecha_carga` as 'fecha_carga', if(`documentos`.`creado`,date_format(`documentos`.`creado`,'%d/%m/%Y %h:%i %p'),'') as 'creado', `documentos`.`creado_por` as 'creado_por', if(`documentos`.`editado`,date_format(`documentos`.`editado`,'%d/%m/%Y %h:%i %p'),'') as 'editado', `documentos`.`editado_por` as 'editado_por'",
			'mantenimientos' => "`mantenimientos`.`id_mtto` as 'id_mtto', IF(    CHAR_LENGTH(`dispositivos1`.`code`), CONCAT_WS('',   `dispositivos1`.`code`), '') as 'codigo', IF(    CHAR_LENGTH(`dispositivos1`.`serial`), CONCAT_WS('',   `dispositivos1`.`serial`), '') as 'serial', IF(    CHAR_LENGTH(`tipo_dispositivo1`.`tipo_dispositivo`), CONCAT_WS('',   `tipo_dispositivo1`.`tipo_dispositivo`), '') as 'tipo_dispo', if(`mantenimientos`.`fecha_mtto`,date_format(`mantenimientos`.`fecha_mtto`,'%d/%m/%Y'),'') as 'fecha_mtto', IF(    CHAR_LENGTH(`tipo_mtto1`.`tipo_mtto`), CONCAT_WS('',   `tipo_mtto1`.`tipo_mtto`), '') as 'tipo_mtto', IF(    CHAR_LENGTH(`contactos1`.`nombre`), CONCAT_WS('',   `contactos1`.`nombre`), '') as 'responsable', IF(    CHAR_LENGTH(`contactos1`.`identificacion`), CONCAT_WS('',   `contactos1`.`identificacion`), '') as 'id_responsable', `mantenimientos`.`documento` as 'documento', `mantenimientos`.`documento_drive` as 'documento_drive', IF(    CHAR_LENGTH(`unidades1`.`nombre`), CONCAT_WS('',   `unidades1`.`nombre`), '') as 'unidad', IF(    CHAR_LENGTH(`unidades1`.`abreviado`) || CHAR_LENGTH(`ciudades1`.`ciudad`), CONCAT_WS('',   `unidades1`.`abreviado`, ' - ', `ciudades1`.`ciudad`), '') as 'unidad_abreviado', `mantenimientos`.`descripcion` as 'descripcion', IF(    CHAR_LENGTH(`tipo_estado_dispo1`.`estado_dispo`), CONCAT_WS('',   `tipo_estado_dispo1`.`estado_dispo`), '') as 'estado_final', `mantenimientos`.`creado_por` as 'creado_por', `mantenimientos`.`editado_por` as 'editado_por', if(`mantenimientos`.`creado`,date_format(`mantenimientos`.`creado`,'%d/%m/%Y %h:%i %p'),'') as 'creado', if(`mantenimientos`.`editado`,date_format(`mantenimientos`.`editado`,'%d/%m/%Y %h:%i %p'),'') as 'editado'",
			'calibraciones' => "`calibraciones`.`id` as 'id', IF(    CHAR_LENGTH(`dispositivos1`.`code`), CONCAT_WS('',   `dispositivos1`.`code`), '') as 'codigo', IF(    CHAR_LENGTH(`dispositivos1`.`serial`), CONCAT_WS('',   `dispositivos1`.`serial`), '') as 'serial', IF(    CHAR_LENGTH(`tipo_calibracion1`.`tipo_calibracion`), CONCAT_WS('',   `tipo_calibracion1`.`tipo_calibracion`), '') as 'tipo_calibracion', `calibraciones`.`no_documento` as 'no_documento', if(`calibraciones`.`fecha_calibra`,date_format(`calibraciones`.`fecha_calibra`,'%d/%m/%Y'),'') as 'fecha_calibra', if(`calibraciones`.`fecha_expiracion`,date_format(`calibraciones`.`fecha_expiracion`,'%d/%m/%Y'),'') as 'fecha_expiracion', IF(    CHAR_LENGTH(`contactos1`.`nombre`), CONCAT_WS('',   `contactos1`.`nombre`), '') as 'empresa', IF(    CHAR_LENGTH(`contactos1`.`telefono`), CONCAT_WS('',   `contactos1`.`telefono`), '') as 'telefono', `calibraciones`.`documento` as 'documento', `calibraciones`.`descripcion` as 'descripcion', if(`calibraciones`.`creado`,date_format(`calibraciones`.`creado`,'%d/%m/%Y %h:%i %p'),'') as 'creado', `calibraciones`.`creado_por` as 'creado_por', if(`calibraciones`.`editado`,date_format(`calibraciones`.`editado`,'%d/%m/%Y %h:%i %p'),'') as 'editado', `calibraciones`.`editado_por` as 'editado_por'",
			'unidades' => "`unidades`.`id_unidades` as 'id_unidades', `unidades`.`nombre` as 'nombre', `unidades`.`abreviado` as 'abreviado', IF(    CHAR_LENGTH(`ciudades1`.`ciudad`), CONCAT_WS('',   `ciudades1`.`ciudad`), '') as 'ciudad', `unidades`.`telefono` as 'telefono', `unidades`.`direccion` as 'direccion', `unidades`.`ubicacion` as 'ubicacion', IF(    CHAR_LENGTH(`prestador1`.`nombre`) || CHAR_LENGTH(`prestador1`.`nit`), CONCAT_WS('',   `prestador1`.`nombre`, ' | ', `prestador1`.`nit`), '') as 'prestador', `unidades`.`logo` as 'logo', `unidades`.`dispositivos_costo` as 'dispositivos_costo', `unidades`.`mobiliario_costo` as 'mobiliario_costo', `unidades`.`costo_total` as 'costo_total'",
			'marcas' => "`marcas`.`id_marca` as 'id_marca', `marcas`.`marca` as 'marca', `marcas`.`descripcion` as 'descripcion'",
			'marca_modelo' => "`marca_modelo`.`id_mmodelo` as 'id_mmodelo', IF(    CHAR_LENGTH(`marcas1`.`marca`), CONCAT_WS('',   `marcas1`.`marca`), '') as 'marca', `marca_modelo`.`modelo` as 'modelo', `marca_modelo`.`img` as 'img', `marca_modelo`.`fabricante` as 'fabricante', `marca_modelo`.`descripcion` as 'descripcion', if(`marca_modelo`.`creado`,date_format(`marca_modelo`.`creado`,'%d/%m/%Y %h:%i %p'),'') as 'creado', `marca_modelo`.`creado_por` as 'creado_por'",
			'accesorios' => "`accesorios`.`id` as 'id', `accesorios`.`codigo_accesorio` as 'codigo_accesorio', IF(    CHAR_LENGTH(`tipo_accesorio1`.`tipo_accesorio`), CONCAT_WS('',   `tipo_accesorio1`.`tipo_accesorio`), '') as 'tipo_accesorio', `accesorios`.`nombre_accesorio` as 'nombre_accesorio', `accesorios`.`descripcion` as 'descripcion', IF(    CHAR_LENGTH(`dispositivos1`.`codigo`), CONCAT_WS('',   `dispositivos1`.`codigo`), '') as 'id_dispo', if(`accesorios`.`creado`,date_format(`accesorios`.`creado`,'%d/%m/%Y %h:%i %p'),'') as 'creado', `accesorios`.`creado_por` as 'creado_por'",
			'ciudades' => "`ciudades`.`id_ciudad` as 'id_ciudad', `ciudades`.`ciudad` as 'ciudad', `ciudades`.`descripcion` as 'descripcion'",
			'verificacion' => "`verificacion`.`id` as 'id', IF(    CHAR_LENGTH(`dispositivos1`.`code`), CONCAT_WS('',   `dispositivos1`.`code`), '') as 'codigo', IF(    CHAR_LENGTH(`tipo_dispositivo1`.`tipo_dispositivo`), CONCAT_WS('',   `tipo_dispositivo1`.`tipo_dispositivo`), '') as 'tipo_dispo', IF(    CHAR_LENGTH(`dispositivos1`.`serial`), CONCAT_WS('',   `dispositivos1`.`serial`), '') as 'serial', IF(    CHAR_LENGTH(`unidades1`.`nombre`), CONCAT_WS('',   `unidades1`.`nombre`), '') as 'ubicacion', IF(    CHAR_LENGTH(`unidades1`.`abreviado`) || CHAR_LENGTH(`ciudades1`.`ciudad`), CONCAT_WS('',   `unidades1`.`abreviado`, ' - ', `ciudades1`.`ciudad`), '') as 'abreviado', `verificacion`.`verificacion` as 'verificacion', `verificacion`.`comentario` as 'comentario', if(`verificacion`.`fecha_verifi`,date_format(`verificacion`.`fecha_verifi`,'%d/%m/%Y %h:%i %p'),'') as 'fecha_verifi', `verificacion`.`verifi_por` as 'verifi_por'",
			'hojadevida' => "`hojadevida`.`id` as 'id', IF(    CHAR_LENGTH(`dispositivos1`.`code`), CONCAT_WS('',   `dispositivos1`.`code`), '') as 'dispo_codigo', IF(    CHAR_LENGTH(`dispositivos1`.`serial`), CONCAT_WS('',   `dispositivos1`.`serial`), '') as 'dispo_serial', `hojadevida`.`hardware` as 'hardware', `hojadevida`.`software` as 'software', `hojadevida`.`carga` as 'carga', if(`hojadevida`.`creado`,date_format(`hojadevida`.`creado`,'%d/%m/%Y %h:%i %p'),'') as 'creado', `hojadevida`.`creado_por` as 'creado_por', if(`hojadevida`.`editado`,date_format(`hojadevida`.`editado`,'%d/%m/%Y %h:%i %p'),'') as 'editado', `hojadevida`.`editado_por` as 'editado_por'",
			'financiero' => "`financiero`.`id` as 'id', IF(    CHAR_LENGTH(`dispositivos1`.`id_dispo`), CONCAT_WS('',   `dispositivos1`.`id_dispo`), '') as 'id_dispo', `financiero`.`precio` as 'precio', IF(    CHAR_LENGTH(`unidades1`.`nombre`), CONCAT_WS('',   `unidades1`.`nombre`), '') as 'unidad', `financiero`.`enlace` as 'enlace', if(`financiero`.`creado`,date_format(`financiero`.`creado`,'%d/%m/%Y %h:%i %p'),'') as 'creado', `financiero`.`creado_por` as 'creado_por', if(`financiero`.`editado`,date_format(`financiero`.`editado`,'%d/%m/%Y %h:%i %p'),'') as 'editado', `financiero`.`editado_por` as 'editado_por'",
			'financiero_mobiliario' => "`financiero_mobiliario`.`id` as 'id', IF(    CHAR_LENGTH(`mobiliario1`.`id_mobiliario`), CONCAT_WS('',   `mobiliario1`.`id_mobiliario`), '') as 'id_dispo', `financiero_mobiliario`.`precio` as 'precio', IF(    CHAR_LENGTH(`unidades1`.`nombre`), CONCAT_WS('',   `unidades1`.`nombre`), '') as 'unidad', `financiero_mobiliario`.`enlace` as 'enlace', if(`financiero_mobiliario`.`creado`,date_format(`financiero_mobiliario`.`creado`,'%d/%m/%Y %h:%i %p'),'') as 'creado', `financiero_mobiliario`.`creado_por` as 'creado_por', if(`financiero_mobiliario`.`editado`,date_format(`financiero_mobiliario`.`editado`,'%d/%m/%Y %h:%i %p'),'') as 'editado', `financiero_mobiliario`.`editado_por` as 'editado_por'",
			'prestador' => "`prestador`.`id` as 'id', `prestador`.`nombre` as 'nombre', IF(    CHAR_LENGTH(`tipo_razon_social1`.`razon_social`), CONCAT_WS('',   `tipo_razon_social1`.`razon_social`), '') as 'razon_social', IF(    CHAR_LENGTH(`tipo_razon_social1`.`nit`), CONCAT_WS('',   `tipo_razon_social1`.`nit`), '') as 'nit', `prestador`.`descripcion` as 'descripcion'",
			'docu_modelo' => "`docu_modelo`.`id` as 'id', IF(    CHAR_LENGTH(`tipo_dispositivo1`.`tipo_dispositivo`), CONCAT_WS('',   `tipo_dispositivo1`.`tipo_dispositivo`), '') as 'tipo_dispo', IF(    CHAR_LENGTH(`marcas1`.`marca`), CONCAT_WS('',   `marcas1`.`marca`), '') as 'marca', IF(    CHAR_LENGTH(`marca_modelo1`.`modelo`), CONCAT_WS('',   `marca_modelo1`.`modelo`), '') as 'modelo', IF(    CHAR_LENGTH(`tipo_documento1`.`tipo_doc`), CONCAT_WS('',   `tipo_documento1`.`tipo_doc`), '') as 'tipo_documento', `docu_modelo`.`enlace` as 'enlace', `docu_modelo`.`descripcion` as 'descripcion', if(`docu_modelo`.`creado`,date_format(`docu_modelo`.`creado`,'%d/%m/%Y %h:%i %p'),'') as 'creado', `docu_modelo`.`creado_por` as 'creado_por', if(`docu_modelo`.`editado`,date_format(`docu_modelo`.`editado`,'%d/%m/%Y %h:%i %p'),'') as 'editado', `docu_modelo`.`editado_por` as 'editado_por'",
			'facturas' => "`facturas`.`id` as 'id', IF(    CHAR_LENGTH(`dispositivos1`.`id_dispo`), CONCAT_WS('',   `dispositivos1`.`id_dispo`), '') as 'id_dispo', `facturas`.`no_factura` as 'no_factura', `facturas`.`fecha_factura` as 'fecha_factura', IF(    CHAR_LENGTH(`contactos1`.`nombre`), CONCAT_WS('',   `contactos1`.`nombre`), '') as 'proveedor', IF(    CHAR_LENGTH(`contactos1`.`identificacion`), CONCAT_WS('',   `contactos1`.`identificacion`), '') as 'identificacion', `facturas`.`enlace_doc` as 'enlace_doc', if(`facturas`.`creado`,date_format(`facturas`.`creado`,'%d/%m/%Y %h:%i %p'),'') as 'creado', `facturas`.`creado_por` as 'creado_por', if(`facturas`.`editado`,date_format(`facturas`.`editado`,'%d/%m/%Y %h:%i %p'),'') as 'editado', `facturas`.`editado_por` as 'editado_por', IF(    CHAR_LENGTH(`compras1`.`id`), CONCAT_WS('',   `compras1`.`id`), '') as 'id_compras'",
			'formatos' => "`formatos`.`id` as 'id', IF(    CHAR_LENGTH(`tipo_formatos1`.`tipo_formato`), CONCAT_WS('',   `tipo_formatos1`.`tipo_formato`), '') as 'tipo_formato', IF(    CHAR_LENGTH(`tipo_dispositivo1`.`tipo_dispositivo`), CONCAT_WS('',   `tipo_dispositivo1`.`tipo_dispositivo`), '') as 'tipo_dispositivo', `formatos`.`nombre_formato` as 'nombre_formato', `formatos`.`formato` as 'formato', `formatos`.`descripcion` as 'descripcion', if(`formatos`.`creado`,date_format(`formatos`.`creado`,'%d/%m/%Y %h:%i %p'),'') as 'creado'",
			'dispo_fuera' => "`dispo_fuera`.`id` as 'id', IF(    CHAR_LENGTH(`dispositivos1`.`foto`), CONCAT_WS('',   `dispositivos1`.`foto`), '') as 'img', IF(    CHAR_LENGTH(`dispositivos1`.`code`), CONCAT_WS('',   `dispositivos1`.`code`), '') as 'codigo', IF(    CHAR_LENGTH(`dispositivos1`.`serial`), CONCAT_WS('',   `dispositivos1`.`serial`), '') as 'serial', IF(    CHAR_LENGTH(`dispositivos1`.`ubicacion_abre`) || CHAR_LENGTH(`unidades1`.`nombre`), CONCAT_WS('',   `dispositivos1`.`ubicacion_abre`, ' | ', `unidades1`.`nombre`), '') as 'ubicacion_final', IF(    CHAR_LENGTH(`tipo_fuera_servicio1`.`tipo_fuera_servicio`), CONCAT_WS('',   `tipo_fuera_servicio1`.`tipo_fuera_servicio`), '') as 'tipo_fuera_servicio', if(`dispo_fuera`.`fecha_reporte`,date_format(`dispo_fuera`.`fecha_reporte`,'%d/%m/%Y'),'') as 'fecha_reporte', `dispo_fuera`.`descripcion` as 'descripcion', if(`dispo_fuera`.`creado`,date_format(`dispo_fuera`.`creado`,'%d/%m/%Y %h:%i %p'),'') as 'creado', `dispo_fuera`.`creado_por` as 'creado_por', if(`dispo_fuera`.`editado`,date_format(`dispo_fuera`.`editado`,'%d/%m/%Y %h:%i %p'),'') as 'editado', `dispo_fuera`.`edtado_por` as 'edtado_por'",
			'dispositivo_tipo_grupo' => "`dispositivo_tipo_grupo`.`id` as 'id', `dispositivo_tipo_grupo`.`grupo` as 'grupo', `dispositivo_tipo_grupo`.`descripcion` as 'descripcion'",
			'tipo_relacion' => "`tipo_relacion`.`id_tiporelac` as 'id_tiporelac', `tipo_relacion`.`tipo_relac` as 'tipo_relac', `tipo_relacion`.`descripcion` as 'descripcion', if(`tipo_relacion`.`creado`,date_format(`tipo_relacion`.`creado`,'%d/%m/%Y %h:%i %p'),'') as 'creado'",
			'tipo_dispositivo' => "`tipo_dispositivo`.`id_tipodispo` as 'id_tipodispo', `tipo_dispositivo`.`tipo_dispositivo` as 'tipo_dispositivo', IF(    CHAR_LENGTH(`dispositivo_tipo_grupo1`.`grupo`), CONCAT_WS('',   `dispositivo_tipo_grupo1`.`grupo`), '') as 'grupo_dispo', `tipo_dispositivo`.`prefijo` as 'prefijo', `tipo_dispositivo`.`descripcion` as 'descripcion'",
			'tipo_documento' => "`tipo_documento`.`id_tipodoc` as 'id_tipodoc', `tipo_documento`.`tipo_doc` as 'tipo_doc', IF(    CHAR_LENGTH(`tipo_document_grupo1`.`grupo`), CONCAT_WS('',   `tipo_document_grupo1`.`grupo`), '') as 'grupo', `tipo_documento`.`descripcion` as 'descripcion'",
			'tipo_iden' => "`tipo_iden`.`id_iden` as 'id_iden', `tipo_iden`.`tipo_iden` as 'tipo_iden', `tipo_iden`.`tipo_iden_abre` as 'tipo_iden_abre'",
			'tipo_razon_social' => "`tipo_razon_social`.`id` as 'id', `tipo_razon_social`.`razon_social` as 'razon_social', `tipo_razon_social`.`nit` as 'nit', `tipo_razon_social`.`descripcion` as 'descripcion'",
			'tipo_mobiliario' => "`tipo_mobiliario`.`id` as 'id', IF(    CHAR_LENGTH(`tipo_grupo_mobilia1`.`grupo`), CONCAT_WS('',   `tipo_grupo_mobilia1`.`grupo`), '') as 'grupo_mobi', `tipo_mobiliario`.`tipo_mobiliario` as 'tipo_mobiliario', `tipo_mobiliario`.`caracteristicas` as 'caracteristicas'",
			'tipo_grupo_mobilia' => "`tipo_grupo_mobilia`.`id_gru_mo` as 'id_gru_mo', `tipo_grupo_mobilia`.`grupo` as 'grupo', `tipo_grupo_mobilia`.`prefijo` as 'prefijo', `tipo_grupo_mobilia`.`descripcion` as 'descripcion'",
			'tipo_estado_dispo' => "`tipo_estado_dispo`.`id` as 'id', `tipo_estado_dispo`.`estado_dispo` as 'estado_dispo', `tipo_estado_dispo`.`descripcion` as 'descripcion'",
			'tipo_movimiento' => "`tipo_movimiento`.`id` as 'id', `tipo_movimiento`.`tipo_movimiento` as 'tipo_movimiento', `tipo_movimiento`.`descripcion` as 'descripcion'",
			'tipo_estado_movi' => "`tipo_estado_movi`.`id` as 'id', `tipo_estado_movi`.`estado_movi` as 'estado_movi', `tipo_estado_movi`.`descripcion` as 'descripcion'",
			'tipo_estado_verifica' => "`tipo_estado_verifica`.`id` as 'id', `tipo_estado_verifica`.`estado_verificado` as 'estado_verificado', `tipo_estado_verifica`.`descripcion` as 'descripcion'",
			'tipo_mtto' => "`tipo_mtto`.`id` as 'id', `tipo_mtto`.`tipo_mtto` as 'tipo_mtto', `tipo_mtto`.`descripcion` as 'descripcion'",
			'tipo_calibracion' => "`tipo_calibracion`.`id` as 'id', `tipo_calibracion`.`tipo_calibracion` as 'tipo_calibracion', `tipo_calibracion`.`descripcion` as 'descripcion'",
			'tipo_accesorio' => "`tipo_accesorio`.`id` as 'id', `tipo_accesorio`.`tipo_accesorio` as 'tipo_accesorio', `tipo_accesorio`.`prefijo` as 'prefijo', `tipo_accesorio`.`descripcion` as 'descripcion'",
			'tipo_formatos' => "`tipo_formatos`.`id` as 'id', `tipo_formatos`.`tipo_formato` as 'tipo_formato', `tipo_formatos`.`descripcion` as 'descripcion'",
			'dispo_detalles_tecnicos' => "`dispo_detalles_tecnicos`.`id` as 'id', IF(    CHAR_LENGTH(`dispositivos1`.`code`), CONCAT_WS('',   `dispositivos1`.`code`), '') as 'id_dispo', `dispo_detalles_tecnicos`.`detalles` as 'detalles', if(`dispo_detalles_tecnicos`.`creado`,date_format(`dispo_detalles_tecnicos`.`creado`,'%d/%m/%Y %h:%i %p'),'') as 'creado'",
			'tipo_estado_observaciones' => "`tipo_estado_observaciones`.`id` as 'id', `tipo_estado_observaciones`.`estado_observa` as 'estado_observa', `tipo_estado_observaciones`.`descripcion` as 'descripcion'",
			'movi_envio' => "`movi_envio`.`id` as 'id', IF(    CHAR_LENGTH(`movimientos1`.`id_movi`), CONCAT_WS('',   `movimientos1`.`id_movi`), '') as 'id_movi', if(`movi_envio`.`fecha_envio`,date_format(`movi_envio`.`fecha_envio`,'%d/%m/%Y'),'') as 'fecha_envio', IF(    CHAR_LENGTH(`unidades1`.`nombre`), CONCAT_WS('',   `unidades1`.`nombre`), '') as 'origen', IF(    CHAR_LENGTH(`unidades1`.`direccion`), CONCAT_WS('',   `unidades1`.`direccion`), '') as 'ubicacion', `movi_envio`.`destino` as 'destino', `movi_envio`.`d_direccion` as 'd_direccion', IF(    CHAR_LENGTH(`ciudades1`.`ciudad`), CONCAT_WS('',   `ciudades1`.`ciudad`), '') as 'ciudad', IF(    CHAR_LENGTH(`contactos1`.`nombre`), CONCAT_WS('',   `contactos1`.`nombre`), '') as 'nombre', IF(    CHAR_LENGTH(`contactos1`.`telefono`), CONCAT_WS('',   `contactos1`.`telefono`), '') as 'telefono', `movi_envio`.`detalles` as 'detalles', if(`movi_envio`.`creado`,date_format(`movi_envio`.`creado`,'%d/%m/%Y %h:%i %p'),'') as 'creado', `movi_envio`.`creado_por` as 'creado_por', if(`movi_envio`.`editado`,date_format(`movi_envio`.`editado`,'%d/%m/%Y %h:%i %p'),'') as 'editado', `movi_envio`.`editado_por` as 'editado_por'",
			'movi_recepcion' => "`movi_recepcion`.`id` as 'id', IF(    CHAR_LENGTH(`movimientos1`.`id_movi`), CONCAT_WS('',   `movimientos1`.`id_movi`), '') as 'id_movi', if(`movi_recepcion`.`fecha_recepcion`,date_format(`movi_recepcion`.`fecha_recepcion`,'%d/%m/%Y'),'') as 'fecha_recepcion', IF(    CHAR_LENGTH(`unidades1`.`nombre`) || CHAR_LENGTH(`unidades1`.`abreviado`), CONCAT_WS('',   `unidades1`.`nombre`, ' | ', `unidades1`.`abreviado`), '') as 'destino', IF(    CHAR_LENGTH(`unidades1`.`direccion`), CONCAT_WS('',   `unidades1`.`direccion`), '') as 'o_direccion', IF(    CHAR_LENGTH(`ciudades1`.`ciudad`), CONCAT_WS('',   `ciudades1`.`ciudad`), '') as 'ciudad', `movi_recepcion`.`verificado` as 'verificado', IF(    CHAR_LENGTH(`contactos1`.`nombre`), CONCAT_WS('',   `contactos1`.`nombre`), '') as 'nombre', IF(    CHAR_LENGTH(`contactos1`.`telefono`), CONCAT_WS('',   `contactos1`.`telefono`), '') as 'telefono', `movi_recepcion`.`detalles` as 'detalles', if(`movi_recepcion`.`creado`,date_format(`movi_recepcion`.`creado`,'%d/%m/%Y %h:%i %p'),'') as 'creado', `movi_recepcion`.`creado_por` as 'creado_por', if(`movi_recepcion`.`editado`,date_format(`movi_recepcion`.`editado`,'%d/%m/%Y %h:%i %p'),'') as 'editado', `movi_recepcion`.`editado_por` as 'editado_por'",
			'tipo_fuera_servicio' => "`tipo_fuera_servicio`.`id` as 'id', `tipo_fuera_servicio`.`tipo_fuera_servicio` as 'tipo_fuera_servicio', `tipo_fuera_servicio`.`descripcion` as 'descripcion'",
			'tipo_documento_ss' => "`tipo_documento_ss`.`id_tipodoc` as 'id_tipodoc', `tipo_documento_ss`.`tipo_doc` as 'tipo_doc', `tipo_documento_ss`.`descripcion` as 'descripcion'",
			'tipo_parentesco' => "`tipo_parentesco`.`id` as 'id', `tipo_parentesco`.`parentesco` as 'parentesco', `tipo_parentesco`.`descripcion` as 'descripcion'",
			'tipo_rh' => "`tipo_rh`.`id` as 'id', `tipo_rh`.`tipo_rh` as 'tipo_rh'",
			'accesorio_dispo_relacion' => "`accesorio_dispo_relacion`.`id` as 'id', IF(    CHAR_LENGTH(`dispositivos1`.`code`), CONCAT_WS('',   `dispositivos1`.`code`), '') as 'id_dispo', IF(    CHAR_LENGTH(`dispositivos2`.`code`), CONCAT_WS('',   `dispositivos2`.`code`, ' '), '') as 'id_accesorio', IF(    CHAR_LENGTH(`tipo_dispositivo1`.`tipo_dispositivo`), CONCAT_WS('',   `tipo_dispositivo1`.`tipo_dispositivo`), '') as 'tipo_dispo', IF(    CHAR_LENGTH(`dispositivos1`.`serial`), CONCAT_WS('',   `dispositivos1`.`serial`), '') as 'serial', IF(    CHAR_LENGTH(`marcas1`.`marca`) || CHAR_LENGTH(`marca_modelo1`.`modelo`), CONCAT_WS('',   `marcas1`.`marca`, ' - ', `marca_modelo1`.`modelo`), '') as 'marca_modelo', if(`accesorio_dispo_relacion`.`creado`,date_format(`accesorio_dispo_relacion`.`creado`,'%d/%m/%Y %h:%i %p'),'') as 'creado', `accesorio_dispo_relacion`.`creado_por` as 'creado_por'",
			'observaciones' => "`observaciones`.`id` as 'id', IF(    CHAR_LENGTH(`tipo_estado_observa1`.`tipo_estado_observa`), CONCAT_WS('',   `tipo_estado_observa1`.`tipo_estado_observa`), '') as 'estado_observacion', IF(    CHAR_LENGTH(`tipo_estado_observaciones1`.`estado_observa`), CONCAT_WS('',   `tipo_estado_observaciones1`.`estado_observa`), '') as 'estado', IF(    CHAR_LENGTH(`dispositivos1`.`code`), CONCAT_WS('',   `dispositivos1`.`code`), '') as 'codigo', IF(    CHAR_LENGTH(`tipo_dispositivo1`.`tipo_dispositivo`), CONCAT_WS('',   `tipo_dispositivo1`.`tipo_dispositivo`), '') as 'tipo_dispo', IF(    CHAR_LENGTH(`dispositivos1`.`serial`), CONCAT_WS('',   `dispositivos1`.`serial`), '') as 'serial', IF(    CHAR_LENGTH(`unidades1`.`nombre`) || CHAR_LENGTH(`unidades1`.`abreviado`), CONCAT_WS('',   `unidades1`.`nombre`, ' - ', `unidades1`.`abreviado`), '') as 'unidad', `observaciones`.`observacion` as 'observacion', if(`observaciones`.`creado`,date_format(`observaciones`.`creado`,'%d/%m/%Y %h:%i %p'),'') as 'creado', `observaciones`.`creado_por` as 'creado_por'",
			'foto_observacion' => "`foto_observacion`.`id` as 'id', IF(    CHAR_LENGTH(`observaciones1`.`id`), CONCAT_WS('',   `observaciones1`.`id`), '') as 'id_observacion', `foto_observacion`.`foto` as 'foto', `foto_observacion`.`descripcion` as 'descripcion', if(`foto_observacion`.`creado`,date_format(`foto_observacion`.`creado`,'%d/%m/%Y %h:%i %p'),'') as 'creado', `foto_observacion`.`creado_por` as 'creado_por'",
			'progreso' => "`progreso`.`id` as 'id', IF(    CHAR_LENGTH(`observaciones1`.`id`), CONCAT_WS('',   `observaciones1`.`id`), '') as 'id_observacion', IF(    CHAR_LENGTH(`tipo_estado_observaciones1`.`estado_observa`), CONCAT_WS('',   `tipo_estado_observaciones1`.`estado_observa`), '') as 'estado_seguimiento', `progreso`.`descripcion` as 'descripcion', if(`progreso`.`credo`,date_format(`progreso`.`credo`,'%d/%m/%Y %h:%i %p'),'') as 'credo', `progreso`.`creado_por` as 'creado_por'",
			'tipo_estado_observa' => "`tipo_estado_observa`.`id` as 'id', `tipo_estado_observa`.`tipo_estado_observa` as 'tipo_estado_observa', `tipo_estado_observa`.`descripcion` as 'descripcion'",
			'acceso_remoto' => "`acceso_remoto`.`id` as 'id', IF(    CHAR_LENGTH(`unidades1`.`nombre`), CONCAT_WS('',   `unidades1`.`nombre`), '') as 'unidad', IF(    CHAR_LENGTH(`ciudades1`.`ciudad`), CONCAT_WS('',   `ciudades1`.`ciudad`), '') as 'ciudad', `acceso_remoto`.`servicio` as 'servicio', `acceso_remoto`.`anydesk` as 'anydesk', `acceso_remoto`.`acceso` as 'acceso', `acceso_remoto`.`teamviewer` as 'teamviewer', `acceso_remoto`.`acceso2` as 'acceso2', IF(    CHAR_LENGTH(`dispositivos1`.`code`), CONCAT_WS('',   `dispositivos1`.`code`), '') as 'codigo_equipo', IF(    CHAR_LENGTH(`marcas1`.`marca`) || CHAR_LENGTH(`marca_modelo1`.`modelo`), CONCAT_WS('',   `marcas1`.`marca`, ' - ', `marca_modelo1`.`modelo`), '') as 'equipo', if(`acceso_remoto`.`ultima_verifica`,date_format(`acceso_remoto`.`ultima_verifica`,'%d/%m/%Y'),'') as 'ultima_verifica', `acceso_remoto`.`comentario` as 'comentario', if(`acceso_remoto`.`creado`,date_format(`acceso_remoto`.`creado`,'%d/%m/%Y %h:%i %p'),'') as 'creado', `acceso_remoto`.`creado_por` as 'creado_por', if(`acceso_remoto`.`editado`,date_format(`acceso_remoto`.`editado`,'%d/%m/%Y %h:%i %p'),'') as 'editado', `acceso_remoto`.`editado_por` as 'editado_por'",
			'tipo_periodicidad' => "`tipo_periodicidad`.`id` as 'id', `tipo_periodicidad`.`periodicidad` as 'periodicidad', `tipo_periodicidad`.`descripcion` as 'descripcion'",
			'perfil' => "`perfil`.`id` as 'id', `perfil`.`usuario` as 'usuario', `perfil`.`nombre` as 'nombre', `perfil`.`apellidos` as 'apellidos', IF(    CHAR_LENGTH(`tipo_iden1`.`tipo_iden_abre`), CONCAT_WS('',   `tipo_iden1`.`tipo_iden_abre`), '') as 'tipo_id', `perfil`.`numero_id` as 'numero_id', `perfil`.`dato2` as 'dato2', if(`perfil`.`fecha_nacimiento`,date_format(`perfil`.`fecha_nacimiento`,'%d/%m/%Y'),'') as 'fecha_nacimiento', `perfil`.`telefono` as 'telefono', `perfil`.`celular` as 'celular', IF(    CHAR_LENGTH(`tipo_rh1`.`tipo_rh`), CONCAT_WS('',   `tipo_rh1`.`tipo_rh`), '') as 'rh', `perfil`.`foto_perfil` as 'foto_perfil', `perfil`.`estado_civil` as 'estado_civil', `perfil`.`direccion` as 'direccion', `perfil`.`optimo` as 'optimo', if(`perfil`.`creado`,date_format(`perfil`.`creado`,'%d/%m/%Y %h:%i %p'),'') as 'creado', `perfil`.`creado_por` as 'creado_por', `perfil`.`grupo` as 'grupo', `perfil`.`estado` as 'estado'",
			'consentimieto' => "`consentimieto`.`id` as 'id', IF(    CHAR_LENGTH(`perfil1`.`nombre`) || CHAR_LENGTH(`perfil1`.`apellidos`), CONCAT_WS('',   `perfil1`.`nombre`, ' ', `perfil1`.`apellidos`), '') as 'id_perfil', IF(    CHAR_LENGTH(`tipo_iden1`.`tipo_iden_abre`) || CHAR_LENGTH(`perfil1`.`numero_id`), CONCAT_WS('',   `tipo_iden1`.`tipo_iden_abre`, ' ', `perfil1`.`numero_id`), '') as 'identificacion', `consentimieto`.`acepto` as 'acepto', if(`consentimieto`.`creado`,date_format(`consentimieto`.`creado`,'%d/%m/%Y %h:%i %p'),'') as 'creado', `consentimieto`.`creado_por` as 'creado_por'",
			'perfil_familia' => "`perfil_familia`.`id` as 'id', IF(    CHAR_LENGTH(`perfil1`.`id`) || CHAR_LENGTH(`perfil1`.`apellidos`), CONCAT_WS('',   `perfil1`.`id`, ' ', `perfil1`.`apellidos`), '') as 'id_perfil', IF(    CHAR_LENGTH(`tipo_iden1`.`tipo_iden_abre`) || CHAR_LENGTH(`perfil1`.`numero_id`), CONCAT_WS('',   `tipo_iden1`.`tipo_iden_abre`, ' ', `perfil1`.`numero_id`), '') as 'identificacion', IF(    CHAR_LENGTH(`tipo_parentesco1`.`parentesco`), CONCAT_WS('',   `tipo_parentesco1`.`parentesco`), '') as 'parentesco', `perfil_familia`.`nombre` as 'nombre', `perfil_familia`.`telefono` as 'telefono', `perfil_familia`.`direccion` as 'direccion', if(`perfil_familia`.`creado`,date_format(`perfil_familia`.`creado`,'%d/%m/%Y %h:%i %p'),'') as 'creado', `perfil_familia`.`creado_por` as 'creado_por'",
			'perfil_soportes' => "`perfil_soportes`.`id` as 'id', IF(    CHAR_LENGTH(`perfil1`.`nombre`) || CHAR_LENGTH(`perfil1`.`apellidos`), CONCAT_WS('',   `perfil1`.`nombre`, ' ', `perfil1`.`apellidos`), '') as 'id_perfil', IF(    CHAR_LENGTH(`tipo_documento1`.`tipo_doc`), CONCAT_WS('',   `tipo_documento1`.`tipo_doc`), '') as 'tipo_documento', `perfil_soportes`.`nombre_documento` as 'nombre_documento', `perfil_soportes`.`docuemento` as 'docuemento', if(`perfil_soportes`.`creado`,date_format(`perfil_soportes`.`creado`,'%d/%m/%Y %h:%i %p'),'') as 'creado', `perfil_soportes`.`creado_por` as 'creado_por'",
			'seguridad_social' => "`seguridad_social`.`id` as 'id', IF(    CHAR_LENGTH(`perfil1`.`nombre`) || CHAR_LENGTH(`perfil1`.`apellidos`), CONCAT_WS('',   `perfil1`.`nombre`, ' ', `perfil1`.`apellidos`), '') as 'id_perfil', IF(    CHAR_LENGTH(`tipo_documento_ss1`.`tipo_doc`), CONCAT_WS('',   `tipo_documento_ss1`.`tipo_doc`), '') as 'tipo_documento', `seguridad_social`.`docuemento` as 'docuemento', `seguridad_social`.`descripcion` as 'descripcion', if(`seguridad_social`.`creado`,date_format(`seguridad_social`.`creado`,'%d/%m/%Y %h:%i %p'),'') as 'creado', `seguridad_social`.`creado_por` as 'creado_por'",
			'costos_mtto' => "`costos_mtto`.`id` as 'id', IF(    CHAR_LENGTH(`mantenimientos1`.`id_mtto`), CONCAT_WS('',   `mantenimientos1`.`id_mtto`), '') as 'id_mtto', IF(    CHAR_LENGTH(`tipo_costo1`.`tipo_costo`), CONCAT_WS('',   `tipo_costo1`.`tipo_costo`), '') as 'tipo_costo', `costos_mtto`.`precio` as 'precio', `costos_mtto`.`cantidad` as 'cantidad', `costos_mtto`.`descripcion` as 'descripcion', if(`costos_mtto`.`creado`,date_format(`costos_mtto`.`creado`,'%d/%m/%Y %h:%i %p'),'') as 'creado', `costos_mtto`.`creado_por` as 'creado_por'",
			'tipo_costo' => "`tipo_costo`.`id` as 'id', `tipo_costo`.`tipo_costo` as 'tipo_costo', `tipo_costo`.`descripcion` as 'descripcion'",
			'doc_mtto' => "`doc_mtto`.`id_doc` as 'id_doc', `doc_mtto`.`doc` as 'doc', IF(    CHAR_LENGTH(`mantenimientos1`.`id_mtto`), CONCAT_WS('',   `mantenimientos1`.`id_mtto`), '') as 'id_mtto', IF(    CHAR_LENGTH(`tipo_mtto1`.`tipo_mtto`), CONCAT_WS('',   `tipo_mtto1`.`tipo_mtto`), '') as 'tipo_mtto', IF(    CHAR_LENGTH(`mantenimientos1`.`descripcion`), CONCAT_WS('',   `mantenimientos1`.`descripcion`), '') as 'mtto', `doc_mtto`.`observaciones` as 'observaciones', IF(    CHAR_LENGTH(`biomedicos1`.`nombre`), CONCAT_WS('',   `biomedicos1`.`nombre`), '') as 'nombre_biomedico', IF(    CHAR_LENGTH(`biomedicos1`.`registro_invima`), CONCAT_WS('',   `biomedicos1`.`registro_invima`), '') as 'registro_invima', IF(    CHAR_LENGTH(`biomedicos1`.`firma`), CONCAT_WS('',   `biomedicos1`.`firma`), '') as 'firma_biomedico', if(`doc_mtto`.`creado`,date_format(`doc_mtto`.`creado`,'%d/%m/%Y %h:%i %p'),'') as 'creado', `doc_mtto`.`creado_por` as 'creado_por'",
			'biomedicos' => "`biomedicos`.`id` as 'id', IF(    CHAR_LENGTH(`contactos1`.`identificacion`), CONCAT_WS('',   `contactos1`.`identificacion`), '') as 'id_contacto', IF(    CHAR_LENGTH(`contactos1`.`nombre`), CONCAT_WS('',   `contactos1`.`nombre`), '') as 'nombre', `biomedicos`.`registro_invima` as 'registro_invima', `biomedicos`.`nota` as 'nota', `biomedicos`.`firma` as 'firma'",
			'tipo_clasifica_riesgo' => "`tipo_clasifica_riesgo`.`id` as 'id', `tipo_clasifica_riesgo`.`clase` as 'clase', `tipo_clasifica_riesgo`.`nivel_riesgo` as 'nivel_riesgo', `tipo_clasifica_riesgo`.`ejemplo` as 'ejemplo', `tipo_clasifica_riesgo`.`nota` as 'nota'",
			'programa_mtto' => "`programa_mtto`.`id` as 'id', IF(    CHAR_LENGTH(`unidades1`.`nombre`), CONCAT_WS('',   `unidades1`.`nombre`), '') as 'unidad', `programa_mtto`.`ano` as 'ano', `programa_mtto`.`descripcion` as 'descripcion', `programa_mtto`.`enlace` as 'enlace', `programa_mtto`.`archivo` as 'archivo', if(`programa_mtto`.`creado`,date_format(`programa_mtto`.`creado`,'%d/%m/%Y %h:%i %p'),'') as 'creado', `programa_mtto`.`creado_por` as 'creado_por'",
			'cronograma_mtto' => "`cronograma_mtto`.`id` as 'id', IF(    CHAR_LENGTH(`unidades1`.`nombre`), CONCAT_WS('',   `unidades1`.`nombre`), '') as 'id_programa', IF(    CHAR_LENGTH(`programa_mtto1`.`ano`), CONCAT_WS('',   `programa_mtto1`.`ano`), '') as 'ano', IF(    CHAR_LENGTH(`dispositivos1`.`code`), CONCAT_WS('',   `dispositivos1`.`code`), '') as 'codigo', IF(    CHAR_LENGTH(`tipo_dispositivo1`.`tipo_dispositivo`), CONCAT_WS('',   `tipo_dispositivo1`.`tipo_dispositivo`), '') as 'tipo_dispo', IF(    CHAR_LENGTH(`marcas1`.`marca`), CONCAT_WS('',   `marcas1`.`marca`), '') as 'marca', IF(    CHAR_LENGTH(`marca_modelo1`.`modelo`), CONCAT_WS('',   `marca_modelo1`.`modelo`), '') as 'modelo', IF(    CHAR_LENGTH(`tipo_periodicidad1`.`periodicidad`), CONCAT_WS('',   `tipo_periodicidad1`.`periodicidad`), '') as 'periodicidad', `cronograma_mtto`.`meses` as 'meses', `cronograma_mtto`.`biomedico` as 'biomedico', `cronograma_mtto`.`actividades` as 'actividades', if(`cronograma_mtto`.`creado`,date_format(`cronograma_mtto`.`creado`,'%d/%m/%Y %h:%i %p'),'') as 'creado', `cronograma_mtto`.`creado_por` as 'creado_por'",
			'compras' => "`compras`.`id` as 'id', IF(    CHAR_LENGTH(`tipo_compra1`.`tipo_compra`), CONCAT_WS('',   `tipo_compra1`.`tipo_compra`), '') as 'tipo_compra', if(`compras`.`fecha_compra`,date_format(`compras`.`fecha_compra`,'%d/%m/%Y'),'') as 'fecha_compra', `compras`.`comprador` as 'comprador', `compras`.`resumen` as 'resumen', IF(    CHAR_LENGTH(`tipo_estado_compra1`.`tipo_estado_compra`), CONCAT_WS('',   `tipo_estado_compra1`.`tipo_estado_compra`), '') as 'estado', if(`compras`.`creado`,date_format(`compras`.`creado`,'%d/%m/%Y %h:%i %p'),'') as 'creado', `compras`.`creado_por` as 'creado_por'",
			'tipo_estado_compra' => "`tipo_estado_compra`.`id` as 'id', `tipo_estado_compra`.`tipo_estado_compra` as 'tipo_estado_compra', `tipo_estado_compra`.`descripcion` as 'descripcion'",
			'cantidad_dispomedico' => "`cantidad_dispomedico`.`id` as 'id', IF(    CHAR_LENGTH(`compra_dispo1`.`nombre`), CONCAT_WS('',   `compra_dispo1`.`nombre`), '') as 'nombre_dispo', IF(    CHAR_LENGTH(`compra_dispo1`.`serial`), CONCAT_WS('',   `compra_dispo1`.`serial`), '') as 'serial', IF(    CHAR_LENGTH(`marcas1`.`marca`) || CHAR_LENGTH(`marca_modelo1`.`modelo`), CONCAT_WS('',   `marcas1`.`marca`, ' ', `marca_modelo1`.`modelo`), '') as 'marca_modelo', IF(    CHAR_LENGTH(`compra_dispo1`.`caracteristicas`) || CHAR_LENGTH(`marca_modelo2`.`modelo`), CONCAT_WS('',   `compra_dispo1`.`caracteristicas`, ' ', `marca_modelo2`.`modelo`), '') as 'descripcion', `cantidad_dispomedico`.`uso` as 'uso', IF(    CHAR_LENGTH(`tipo_estado_compra1`.`tipo_estado_compra`), CONCAT_WS('',   `tipo_estado_compra1`.`tipo_estado_compra`), '') as 'estado', IF(    CHAR_LENGTH(`compras1`.`id`), CONCAT_WS('',   `compras1`.`id`), '') as 'id_compra', if(`cantidad_dispomedico`.`creado`,date_format(`cantidad_dispomedico`.`creado`,'%d/%m/%Y %h:%i %p'),'') as 'creado', `cantidad_dispomedico`.`creado_por` as 'creado_por'",
			'cantidad_articulos' => "`cantidad_articulos`.`id` as 'id', IF(    CHAR_LENGTH(`articulos1`.`nombre_unico`), CONCAT_WS('',   `articulos1`.`nombre_unico`), '') as 'nombre_articulo', IF(    CHAR_LENGTH(`marcas1`.`marca`) || CHAR_LENGTH(`marca_presetacion1`.`presentacion`) || CHAR_LENGTH(`tipo_unidad_medida1`.`unidad`), CONCAT_WS('',   `marcas1`.`marca`, `marca_presetacion1`.`presentacion`, ' ', `tipo_unidad_medida1`.`unidad`), '') as 'presentacion', IF(    CHAR_LENGTH(`articulos1`.`caracteristicas`) || CHAR_LENGTH(`articulos1`.`nota`), CONCAT_WS('',   `articulos1`.`caracteristicas`, '-', `articulos1`.`nota`), '') as 'descripcion', IF(    CHAR_LENGTH(`articulos1`.`serial`) || CHAR_LENGTH(`articulos1`.`referencia`), CONCAT_WS('',   `articulos1`.`serial`, ' ', `articulos1`.`referencia`), '') as 'serial', `cantidad_articulos`.`cantidad` as 'cantidad', IF(    CHAR_LENGTH(`tipo_estado_compra1`.`tipo_estado_compra`), CONCAT_WS('',   `tipo_estado_compra1`.`tipo_estado_compra`), '') as 'estado', IF(    CHAR_LENGTH(`compras1`.`id`), CONCAT_WS('',   `compras1`.`id`), '') as 'id_compras', if(`cantidad_articulos`.`creado`,date_format(`cantidad_articulos`.`creado`,'%d/%m/%Y %h:%i %p'),'') as 'creado', IF(    CHAR_LENGTH(`tipo_compra1`.`tipo_compra`), CONCAT_WS('',   `tipo_compra1`.`tipo_compra`), '') as 'tipo_compra', `cantidad_articulos`.`creado_por` as 'creado_por'",
			'cantidad_mobiliario' => "`cantidad_mobiliario`.`id` as 'id', IF(    CHAR_LENGTH(`tipo_grupo_mobilia1`.`grupo`) || CHAR_LENGTH(`tipo_mobiliario1`.`tipo_mobiliario`), CONCAT_WS('',   `tipo_grupo_mobilia1`.`grupo`, ' - ', `tipo_mobiliario1`.`tipo_mobiliario`), '') as 'nombre_mobiliario', IF(    CHAR_LENGTH(`mobiliario1`.`descripcion`), CONCAT_WS('',   `mobiliario1`.`descripcion`), '') as 'descripcion', IF(    CHAR_LENGTH(`tipo_estado_compra1`.`tipo_estado_compra`), CONCAT_WS('',   `tipo_estado_compra1`.`tipo_estado_compra`), '') as 'estado', IF(    CHAR_LENGTH(`compras1`.`id`), CONCAT_WS('',   `compras1`.`id`), '') as 'id_compra', if(`cantidad_mobiliario`.`creado`,date_format(`cantidad_mobiliario`.`creado`,'%d/%m/%Y %h:%i %p'),'') as 'creado', `cantidad_mobiliario`.`creado_por` as 'creado_por'",
			'compra_dispo' => "`compra_dispo`.`id` as 'id', IF(    CHAR_LENGTH(`marca_modelo1`.`img`), CONCAT_WS('',   `marca_modelo1`.`img`), '') as 'foto', `compra_dispo`.`nombre` as 'nombre', `compra_dispo`.`serial` as 'serial', IF(    CHAR_LENGTH(`tipo_dispositivo1`.`tipo_dispositivo`), CONCAT_WS('',   `tipo_dispositivo1`.`tipo_dispositivo`), '') as 'tipo_dispositivo', IF(    CHAR_LENGTH(`marcas1`.`marca`), CONCAT_WS('',   `marcas1`.`marca`), '') as 'marca', IF(    CHAR_LENGTH(`marca_modelo1`.`modelo`), CONCAT_WS('',   `marca_modelo1`.`modelo`), '') as 'modelo', `compra_dispo`.`caracteristicas` as 'caracteristicas', IF(    CHAR_LENGTH(`tipo_estado_dispo1`.`estado_dispo`), CONCAT_WS('',   `tipo_estado_dispo1`.`estado_dispo`), '') as 'estado', IF(    CHAR_LENGTH(`tipo_clasifica_riesgo1`.`clase`) || CHAR_LENGTH(`tipo_clasifica_riesgo1`.`nivel_riesgo`), CONCAT_WS('',   `tipo_clasifica_riesgo1`.`clase`, ' - ', `tipo_clasifica_riesgo1`.`nivel_riesgo`), '') as 'riesgo', `compra_dispo`.`precio` as 'precio', if(`compra_dispo`.`creado`,date_format(`compra_dispo`.`creado`,'%d/%m/%Y %h:%i %p'),'') as 'creado', `compra_dispo`.`creado_por` as 'creado_por'",
			'articulos' => "`articulos`.`id` as 'id', `articulos`.`nombre_unico` as 'nombre_unico', IF(    CHAR_LENGTH(`tipo_dispositivo1`.`tipo_dispositivo`), CONCAT_WS('',   `tipo_dispositivo1`.`tipo_dispositivo`), '') as 'tipo_dispo', IF(    CHAR_LENGTH(`marcas1`.`marca`), CONCAT_WS('',   `marcas1`.`marca`), '') as 'marca', IF(    CHAR_LENGTH(`marca_modelo1`.`modelo`), CONCAT_WS('',   `marca_modelo1`.`modelo`), '') as 'modelo', IF(    CHAR_LENGTH(`marca_presetacion1`.`presentacion`) || CHAR_LENGTH(`tipo_unidad_medida1`.`unidad`), CONCAT_WS('',   `marca_presetacion1`.`presentacion`, ' ', `tipo_unidad_medida1`.`unidad`), '') as 'presentacion', `articulos`.`serial` as 'serial', `articulos`.`referencia` as 'referencia', IF(    CHAR_LENGTH(`articulos_familia1`.`familia`) || CHAR_LENGTH(`articulos_familia1`.`familia`), CONCAT_WS('',   `articulos_familia1`.`familia`, '-', `articulos_familia1`.`familia`), '') as 'familia', IF(    CHAR_LENGTH(`articulos_familia1`.`codigo`) || CHAR_LENGTH(`articulos_familia1`.`proveedor`), CONCAT_WS('',   `articulos_familia1`.`codigo`, '-', `articulos_familia1`.`proveedor`), '') as 'codigo_proveedor', `articulos`.`caracteristicas` as 'caracteristicas', `articulos`.`nota` as 'nota', IF(    CHAR_LENGTH(`marca_modelo1`.`img`), CONCAT_WS('',   `marca_modelo1`.`img`), '') as 'imagen', IF(    CHAR_LENGTH(`tipo_estado_dispo1`.`estado_dispo`), CONCAT_WS('',   `tipo_estado_dispo1`.`estado_dispo`), '') as 'estado', if(`articulos`.`creado`,date_format(`articulos`.`creado`,'%d/%m/%Y %h:%i %p'),'') as 'creado', `articulos`.`creado_por` as 'creado_por'",
			'cofig' => "`cofig`.`id` as 'id', `cofig`.`dato1` as 'dato1', `cofig`.`dato2` as 'dato2', `cofig`.`descripcion` as 'descripcion'",
			'marca_presetacion' => "`marca_presetacion`.`id` as 'id', IF(    CHAR_LENGTH(`marcas1`.`marca`), CONCAT_WS('',   `marcas1`.`marca`), '') as 'marca', IF(    CHAR_LENGTH(`tipo_unidad_medida1`.`unidad`), CONCAT_WS('',   `tipo_unidad_medida1`.`unidad`), '') as 'unidad_medida', `marca_presetacion`.`presentacion` as 'presentacion'",
			'tipo_document_grupo' => "`tipo_document_grupo`.`id` as 'id', `tipo_document_grupo`.`grupo` as 'grupo', `tipo_document_grupo`.`descripcion` as 'descripcion'",
			'tipo_pago' => "`tipo_pago`.`id` as 'id', `tipo_pago`.`tipo_pago` as 'tipo_pago', `tipo_pago`.`descripcion` as 'descripcion'",
			'tipo_compra' => "`tipo_compra`.`id` as 'id', `tipo_compra`.`tipo_compra` as 'tipo_compra', `tipo_compra`.`descripcion` as 'descripcion'",
			'articulos_familia' => "`articulos_familia`.`id` as 'id', `articulos_familia`.`codigo` as 'codigo', `articulos_familia`.`familia` as 'familia', `articulos_familia`.`proveedor` as 'proveedor'",
			'articulo_codigo_proveedor' => "`articulo_codigo_proveedor`.`id` as 'id', IF(    CHAR_LENGTH(`articulos_familia1`.`codigo`) || CHAR_LENGTH(`articulos_familia1`.`familia`), CONCAT_WS('',   `articulos_familia1`.`codigo`, '-', `articulos_familia1`.`familia`), '') as 'familia', `articulo_codigo_proveedor`.`codigo` as 'codigo', `articulo_codigo_proveedor`.`proveedor` as 'proveedor'",
			'tipo_unidad_medida' => "`tipo_unidad_medida`.`id` as 'id', `tipo_unidad_medida`.`unidad` as 'unidad', `tipo_unidad_medida`.`nota` as 'nota'",
			'genera_documentos' => "`genera_documentos`.`id` as 'id', `genera_documentos`.`tipo_documento_entrega` as 'tipo_documento_entrega', IF(    CHAR_LENGTH(`ciudades1`.`ciudad`), CONCAT_WS('',   `ciudades1`.`ciudad`), '') as 'ciudad', if(`genera_documentos`.`fecha`,date_format(`genera_documentos`.`fecha`,'%d/%m/%Y'),'') as 'fecha', IF(    CHAR_LENGTH(`unidades1`.`nombre`) || CHAR_LENGTH(`unidades1`.`abreviado`), CONCAT_WS('',   `unidades1`.`nombre`, ' - ', `unidades1`.`abreviado`), '') as 'entidad', `genera_documentos`.`referencia` as 'referencia', `genera_documentos`.`descripcion` as 'descripcion', `genera_documentos`.`conslusion` as 'conslusion', if(`genera_documentos`.`creado`,date_format(`genera_documentos`.`creado`,'%d/%m/%Y'),'') as 'creado', `genera_documentos`.`creado_por` as 'creado_por'",
			'verificacion_articulos' => "`verificacion_articulos`.`id` as 'id', IF(    CHAR_LENGTH(`articulos1`.`id`), CONCAT_WS('',   `articulos1`.`id`), '') as 'codigo', IF(    CHAR_LENGTH(`tipo_dispositivo1`.`tipo_dispositivo`), CONCAT_WS('',   `tipo_dispositivo1`.`tipo_dispositivo`), '') as 'tipo_dispo', IF(    CHAR_LENGTH(`articulos1`.`nombre_unico`), CONCAT_WS('',   `articulos1`.`nombre_unico`), '') as 'nombre', IF(    CHAR_LENGTH(`articulos1`.`serial`), CONCAT_WS('',   `articulos1`.`serial`), '') as 'serial', IF(    CHAR_LENGTH(`unidades1`.`nombre`), CONCAT_WS('',   `unidades1`.`nombre`), '') as 'ubicacion', IF(    CHAR_LENGTH(`unidades1`.`abreviado`) || CHAR_LENGTH(`ciudades1`.`ciudad`), CONCAT_WS('',   `unidades1`.`abreviado`, ' - ', `ciudades1`.`ciudad`), '') as 'abreviado', `verificacion_articulos`.`verificacion` as 'verificacion', `verificacion_articulos`.`comentario` as 'comentario', if(`verificacion_articulos`.`fecha_verifi`,date_format(`verificacion_articulos`.`fecha_verifi`,'%d/%m/%Y %h:%i %p'),'') as 'fecha_verifi', `verificacion_articulos`.`verifi_por` as 'verifi_por'",
			'movimientos_articulos' => "`movimientos_articulos`.`id_movi` as 'id_movi', `movimientos_articulos`.`img` as 'img', IF(    CHAR_LENGTH(`tipo_dispositivo1`.`tipo_dispositivo`), CONCAT_WS('',   `tipo_dispositivo1`.`tipo_dispositivo`), '') as 'tipo_dispo', IF(    CHAR_LENGTH(`articulos1`.`nombre_unico`), CONCAT_WS('',   `articulos1`.`nombre_unico`), '') as 'nombre', IF(    CHAR_LENGTH(`articulos1`.`serial`), CONCAT_WS('',   `articulos1`.`serial`), '') as 'serial_dispo', IF(    CHAR_LENGTH(`tipo_estado_movi1`.`estado_movi`), CONCAT_WS('',   `tipo_estado_movi1`.`estado_movi`), '') as 'estado_movi', `movimientos_articulos`.`origen` as 'origen', `movimientos_articulos`.`destino` as 'destino', if(`movimientos_articulos`.`creado`,date_format(`movimientos_articulos`.`creado`,'%d/%m/%Y %h:%i %p'),'') as 'creado', `movimientos_articulos`.`creado_por` as 'creado_por', if(`movimientos_articulos`.`editado`,date_format(`movimientos_articulos`.`editado`,'%d/%m/%Y %h:%i %p'),'') as 'editado', `movimientos_articulos`.`editado_por` as 'editado_por'",
			'movi_envio_articulo' => "`movi_envio_articulo`.`id` as 'id', IF(    CHAR_LENGTH(`movimientos_articulos1`.`id_movi`), CONCAT_WS('',   `movimientos_articulos1`.`id_movi`), '') as 'id_movi', if(`movi_envio_articulo`.`fecha_envio`,date_format(`movi_envio_articulo`.`fecha_envio`,'%d/%m/%Y'),'') as 'fecha_envio', IF(    CHAR_LENGTH(`unidades1`.`nombre`), CONCAT_WS('',   `unidades1`.`nombre`), '') as 'origen', IF(    CHAR_LENGTH(`unidades1`.`direccion`), CONCAT_WS('',   `unidades1`.`direccion`), '') as 'ubicacion', `movi_envio_articulo`.`destino` as 'destino', `movi_envio_articulo`.`d_direccion` as 'd_direccion', IF(    CHAR_LENGTH(`ciudades1`.`ciudad`), CONCAT_WS('',   `ciudades1`.`ciudad`), '') as 'ciudad', IF(    CHAR_LENGTH(`contactos1`.`nombre`), CONCAT_WS('',   `contactos1`.`nombre`), '') as 'nombre', IF(    CHAR_LENGTH(`contactos1`.`telefono`), CONCAT_WS('',   `contactos1`.`telefono`), '') as 'telefono', `movi_envio_articulo`.`detalles` as 'detalles', if(`movi_envio_articulo`.`creado`,date_format(`movi_envio_articulo`.`creado`,'%d/%m/%Y %h:%i %p'),'') as 'creado', `movi_envio_articulo`.`creado_por` as 'creado_por', if(`movi_envio_articulo`.`editado`,date_format(`movi_envio_articulo`.`editado`,'%d/%m/%Y %h:%i %p'),'') as 'editado', `movi_envio_articulo`.`editado_por` as 'editado_por'",
			'movi_recepcion_articulos' => "`movi_recepcion_articulos`.`id` as 'id', IF(    CHAR_LENGTH(`movimientos_articulos1`.`id_movi`), CONCAT_WS('',   `movimientos_articulos1`.`id_movi`), '') as 'id_movi', if(`movi_recepcion_articulos`.`fecha_recepcion`,date_format(`movi_recepcion_articulos`.`fecha_recepcion`,'%d/%m/%Y'),'') as 'fecha_recepcion', IF(    CHAR_LENGTH(`unidades1`.`nombre`) || CHAR_LENGTH(`unidades1`.`abreviado`), CONCAT_WS('',   `unidades1`.`nombre`, ' | ', `unidades1`.`abreviado`), '') as 'destino', IF(    CHAR_LENGTH(`unidades1`.`direccion`), CONCAT_WS('',   `unidades1`.`direccion`), '') as 'o_direccion', IF(    CHAR_LENGTH(`ciudades1`.`ciudad`), CONCAT_WS('',   `ciudades1`.`ciudad`), '') as 'ciudad', `movi_recepcion_articulos`.`verificado` as 'verificado', IF(    CHAR_LENGTH(`contactos1`.`nombre`), CONCAT_WS('',   `contactos1`.`nombre`), '') as 'nombre', IF(    CHAR_LENGTH(`contactos1`.`telefono`), CONCAT_WS('',   `contactos1`.`telefono`), '') as 'telefono', `movi_recepcion_articulos`.`detalles` as 'detalles', if(`movi_recepcion_articulos`.`creado`,date_format(`movi_recepcion_articulos`.`creado`,'%d/%m/%Y %h:%i %p'),'') as 'creado', `movi_recepcion_articulos`.`creado_por` as 'creado_por', if(`movi_recepcion_articulos`.`editado`,date_format(`movi_recepcion_articulos`.`editado`,'%d/%m/%Y %h:%i %p'),'') as 'editado', `movi_recepcion_articulos`.`editado_por` as 'editado_por'",
			'ubicacion_articulo' => "`ubicacion_articulo`.`id` as 'id', IF(    CHAR_LENGTH(`tipo_dispositivo1`.`tipo_dispositivo`) || CHAR_LENGTH(`marcas1`.`marca`), CONCAT_WS('',   `tipo_dispositivo1`.`tipo_dispositivo`, ' ', `marcas1`.`marca`), '') as 'id_articulo', IF(    CHAR_LENGTH(`unidades1`.`nombre`), CONCAT_WS('',   `unidades1`.`nombre`), '') as 'ubicacion', if(`ubicacion_articulo`.`creado`,date_format(`ubicacion_articulo`.`creado`,'%d/%m/%Y %h:%i %p'),'') as 'creado', `ubicacion_articulo`.`creado_por` as 'creado_por'",
			'ubicacion_mobiliario' => "`ubicacion_mobiliario`.`id` as 'id', IF(    CHAR_LENGTH(`tipo_grupo_mobilia1`.`grupo`) || CHAR_LENGTH(`tipo_mobiliario1`.`tipo_mobiliario`), CONCAT_WS('',   `tipo_grupo_mobilia1`.`grupo`, ' ', `tipo_mobiliario1`.`tipo_mobiliario`), '') as 'id_mobiliario', IF(    CHAR_LENGTH(`unidades1`.`nombre`) || CHAR_LENGTH(`unidades1`.`abreviado`), CONCAT_WS('',   `unidades1`.`nombre`, ' ', `unidades1`.`abreviado`), '') as 'ubicacion', if(`ubicacion_mobiliario`.`creado`,date_format(`ubicacion_mobiliario`.`creado`,'%d/%m/%Y %h:%i %p'),'') as 'creado', `ubicacion_mobiliario`.`creado_por` as 'creado_por'",
			'precio_dispo_medico' => "`precio_dispo_medico`.`id` as 'id', IF(    CHAR_LENGTH(`compra_dispo1`.`id`), CONCAT_WS('',   `compra_dispo1`.`id`), '') as 'dispo_medico', `precio_dispo_medico`.`precio` as 'precio', `precio_dispo_medico`.`proveedor` as 'proveedor'",
			'precio_articulo' => "`precio_articulo`.`id` as 'id', `precio_articulo`.`articulo` as 'articulo', `precio_articulo`.`precio` as 'precio', `precio_articulo`.`proveedor` as 'proveedor'",
			'precio_mobiliario' => "`precio_mobiliario`.`id` as 'id', `precio_mobiliario`.`mobiliario` as 'mobiliario', `precio_mobiliario`.`precio` as 'precio', `precio_mobiliario`.`proveedor` as 'proveedor'",
		];

		if(isset($sql_fields[$table_name])) return $sql_fields[$table_name];

		return false;
	}

	#########################################################

	function get_sql_from($table_name, $skip_permissions = false, $skip_joins = false, $lower_permissions = false) {
		$sql_from = [
			'dispositivos' => "`dispositivos` LEFT JOIN `tipo_dispositivo` as tipo_dispositivo1 ON `tipo_dispositivo1`.`id_tipodispo`=`dispositivos`.`tipo_dispositivo` LEFT JOIN `marcas` as marcas1 ON `marcas1`.`id_marca`=`dispositivos`.`marca` LEFT JOIN `marca_modelo` as marca_modelo1 ON `marca_modelo1`.`id_mmodelo`=`dispositivos`.`modelo` LEFT JOIN `unidades` as unidades1 ON `unidades1`.`id_unidades`=`dispositivos`.`ubicacion` LEFT JOIN `tipo_clasifica_riesgo` as tipo_clasifica_riesgo1 ON `tipo_clasifica_riesgo1`.`id`=`dispositivos`.`clasificacion_riesgo` LEFT JOIN `tipo_estado_dispo` as tipo_estado_dispo1 ON `tipo_estado_dispo1`.`id`=`dispositivos`.`estado` LEFT JOIN `compra_dispo` as compra_dispo1 ON `compra_dispo1`.`id`=`dispositivos`.`id_compra_ingreso` LEFT JOIN `ciudades` as ciudades1 ON `ciudades1`.`id_ciudad`=`unidades1`.`ciudad` ",
			'mobiliario' => "`mobiliario` LEFT JOIN `tipo_grupo_mobilia` as tipo_grupo_mobilia1 ON `tipo_grupo_mobilia1`.`id_gru_mo`=`mobiliario`.`grupo` LEFT JOIN `tipo_mobiliario` as tipo_mobiliario1 ON `tipo_mobiliario1`.`id`=`mobiliario`.`tipo_mobiliario` LEFT JOIN `unidades` as unidades1 ON `unidades1`.`id_unidades`=`mobiliario`.`unidad` ",
			'contactos' => "`contactos` LEFT JOIN `contactos_tipo_contacto` as contactos_tipo_contacto1 ON `contactos_tipo_contacto1`.`id_tipo_contacto`=`contactos`.`tipo_contacto` LEFT JOIN `tipo_iden` as tipo_iden1 ON `tipo_iden1`.`id_iden`=`contactos`.`tipo_iden` LEFT JOIN `ciudades` as ciudades1 ON `ciudades1`.`id_ciudad`=`contactos`.`ciudad` LEFT JOIN `tipo_relacion` as tipo_relacion1 ON `tipo_relacion1`.`id_tiporelac`=`contactos`.`tipo_relacion` ",
			'contactos_tipo_contacto' => "`contactos_tipo_contacto` ",
			'movimientos' => "`movimientos` LEFT JOIN `dispositivos` as dispositivos1 ON `dispositivos1`.`id_dispo`=`movimientos`.`codigo_dispo` LEFT JOIN `tipo_estado_movi` as tipo_estado_movi1 ON `tipo_estado_movi1`.`id`=`movimientos`.`estado_movi` LEFT JOIN `tipo_dispositivo` as tipo_dispositivo1 ON `tipo_dispositivo1`.`id_tipodispo`=`dispositivos1`.`tipo_dispositivo` ",
			'documentos' => "`documentos` LEFT JOIN `dispositivos` as dispositivos1 ON `dispositivos1`.`id_dispo`=`documentos`.`dispo_codigo` LEFT JOIN `tipo_documento` as tipo_documento1 ON `tipo_documento1`.`id_tipodoc`=`documentos`.`tipo_docu` ",
			'mantenimientos' => "`mantenimientos` LEFT JOIN `dispositivos` as dispositivos1 ON `dispositivos1`.`id_dispo`=`mantenimientos`.`codigo` LEFT JOIN `tipo_mtto` as tipo_mtto1 ON `tipo_mtto1`.`id`=`mantenimientos`.`tipo_mtto` LEFT JOIN `contactos` as contactos1 ON `contactos1`.`id_contactos`=`mantenimientos`.`responsable` LEFT JOIN `unidades` as unidades1 ON `unidades1`.`id_unidades`=`mantenimientos`.`unidad` LEFT JOIN `tipo_estado_dispo` as tipo_estado_dispo1 ON `tipo_estado_dispo1`.`id`=`mantenimientos`.`estado_final` LEFT JOIN `tipo_dispositivo` as tipo_dispositivo1 ON `tipo_dispositivo1`.`id_tipodispo`=`dispositivos1`.`tipo_dispositivo` LEFT JOIN `ciudades` as ciudades1 ON `ciudades1`.`id_ciudad`=`unidades1`.`ciudad` ",
			'calibraciones' => "`calibraciones` LEFT JOIN `dispositivos` as dispositivos1 ON `dispositivos1`.`id_dispo`=`calibraciones`.`codigo` LEFT JOIN `tipo_calibracion` as tipo_calibracion1 ON `tipo_calibracion1`.`id`=`calibraciones`.`tipo_calibracion` LEFT JOIN `contactos` as contactos1 ON `contactos1`.`id_contactos`=`calibraciones`.`empresa` ",
			'unidades' => "`unidades` LEFT JOIN `ciudades` as ciudades1 ON `ciudades1`.`id_ciudad`=`unidades`.`ciudad` LEFT JOIN `prestador` as prestador1 ON `prestador1`.`id`=`unidades`.`prestador` ",
			'marcas' => "`marcas` ",
			'marca_modelo' => "`marca_modelo` LEFT JOIN `marcas` as marcas1 ON `marcas1`.`id_marca`=`marca_modelo`.`marca` ",
			'accesorios' => "`accesorios` LEFT JOIN `tipo_accesorio` as tipo_accesorio1 ON `tipo_accesorio1`.`id`=`accesorios`.`tipo_accesorio` LEFT JOIN `dispositivos` as dispositivos1 ON `dispositivos1`.`id_dispo`=`accesorios`.`id_dispo` ",
			'ciudades' => "`ciudades` ",
			'verificacion' => "`verificacion` LEFT JOIN `dispositivos` as dispositivos1 ON `dispositivos1`.`id_dispo`=`verificacion`.`codigo` LEFT JOIN `unidades` as unidades1 ON `unidades1`.`id_unidades`=`verificacion`.`ubicacion` LEFT JOIN `tipo_dispositivo` as tipo_dispositivo1 ON `tipo_dispositivo1`.`id_tipodispo`=`dispositivos1`.`tipo_dispositivo` LEFT JOIN `ciudades` as ciudades1 ON `ciudades1`.`id_ciudad`=`unidades1`.`ciudad` ",
			'hojadevida' => "`hojadevida` LEFT JOIN `dispositivos` as dispositivos1 ON `dispositivos1`.`id_dispo`=`hojadevida`.`dispo_codigo` ",
			'financiero' => "`financiero` LEFT JOIN `dispositivos` as dispositivos1 ON `dispositivos1`.`id_dispo`=`financiero`.`id_dispo` LEFT JOIN `unidades` as unidades1 ON `unidades1`.`id_unidades`=`dispositivos1`.`ubicacion` ",
			'financiero_mobiliario' => "`financiero_mobiliario` LEFT JOIN `mobiliario` as mobiliario1 ON `mobiliario1`.`id_mobiliario`=`financiero_mobiliario`.`id_dispo` LEFT JOIN `unidades` as unidades1 ON `unidades1`.`id_unidades`=`mobiliario1`.`unidad` ",
			'prestador' => "`prestador` LEFT JOIN `tipo_razon_social` as tipo_razon_social1 ON `tipo_razon_social1`.`id`=`prestador`.`razon_social` ",
			'docu_modelo' => "`docu_modelo` LEFT JOIN `tipo_dispositivo` as tipo_dispositivo1 ON `tipo_dispositivo1`.`id_tipodispo`=`docu_modelo`.`tipo_dispo` LEFT JOIN `marcas` as marcas1 ON `marcas1`.`id_marca`=`docu_modelo`.`marca` LEFT JOIN `marca_modelo` as marca_modelo1 ON `marca_modelo1`.`id_mmodelo`=`docu_modelo`.`modelo` LEFT JOIN `tipo_documento` as tipo_documento1 ON `tipo_documento1`.`id_tipodoc`=`docu_modelo`.`tipo_documento` ",
			'facturas' => "`facturas` LEFT JOIN `dispositivos` as dispositivos1 ON `dispositivos1`.`id_dispo`=`facturas`.`id_dispo` LEFT JOIN `contactos` as contactos1 ON `contactos1`.`id_contactos`=`facturas`.`proveedor` LEFT JOIN `compras` as compras1 ON `compras1`.`id`=`facturas`.`id_compras` ",
			'formatos' => "`formatos` LEFT JOIN `tipo_formatos` as tipo_formatos1 ON `tipo_formatos1`.`id`=`formatos`.`tipo_formato` LEFT JOIN `tipo_dispositivo` as tipo_dispositivo1 ON `tipo_dispositivo1`.`id_tipodispo`=`formatos`.`tipo_dispositivo` ",
			'dispo_fuera' => "`dispo_fuera` LEFT JOIN `dispositivos` as dispositivos1 ON `dispositivos1`.`id_dispo`=`dispo_fuera`.`codigo` LEFT JOIN `tipo_fuera_servicio` as tipo_fuera_servicio1 ON `tipo_fuera_servicio1`.`id`=`dispo_fuera`.`tipo_fuera_servicio` LEFT JOIN `unidades` as unidades1 ON `unidades1`.`id_unidades`=`dispositivos1`.`ubicacion` ",
			'dispositivo_tipo_grupo' => "`dispositivo_tipo_grupo` ",
			'tipo_relacion' => "`tipo_relacion` ",
			'tipo_dispositivo' => "`tipo_dispositivo` LEFT JOIN `dispositivo_tipo_grupo` as dispositivo_tipo_grupo1 ON `dispositivo_tipo_grupo1`.`id`=`tipo_dispositivo`.`grupo_dispo` ",
			'tipo_documento' => "`tipo_documento` LEFT JOIN `tipo_document_grupo` as tipo_document_grupo1 ON `tipo_document_grupo1`.`id`=`tipo_documento`.`grupo` ",
			'tipo_iden' => "`tipo_iden` ",
			'tipo_razon_social' => "`tipo_razon_social` ",
			'tipo_mobiliario' => "`tipo_mobiliario` LEFT JOIN `tipo_grupo_mobilia` as tipo_grupo_mobilia1 ON `tipo_grupo_mobilia1`.`id_gru_mo`=`tipo_mobiliario`.`grupo_mobi` ",
			'tipo_grupo_mobilia' => "`tipo_grupo_mobilia` ",
			'tipo_estado_dispo' => "`tipo_estado_dispo` ",
			'tipo_movimiento' => "`tipo_movimiento` ",
			'tipo_estado_movi' => "`tipo_estado_movi` ",
			'tipo_estado_verifica' => "`tipo_estado_verifica` ",
			'tipo_mtto' => "`tipo_mtto` ",
			'tipo_calibracion' => "`tipo_calibracion` ",
			'tipo_accesorio' => "`tipo_accesorio` ",
			'tipo_formatos' => "`tipo_formatos` ",
			'dispo_detalles_tecnicos' => "`dispo_detalles_tecnicos` LEFT JOIN `dispositivos` as dispositivos1 ON `dispositivos1`.`id_dispo`=`dispo_detalles_tecnicos`.`id_dispo` ",
			'tipo_estado_observaciones' => "`tipo_estado_observaciones` ",
			'movi_envio' => "`movi_envio` LEFT JOIN `movimientos` as movimientos1 ON `movimientos1`.`id_movi`=`movi_envio`.`id_movi` LEFT JOIN `unidades` as unidades1 ON `unidades1`.`id_unidades`=`movi_envio`.`origen` LEFT JOIN `ciudades` as ciudades1 ON `ciudades1`.`id_ciudad`=`movi_envio`.`ciudad` LEFT JOIN `contactos` as contactos1 ON `contactos1`.`id_contactos`=`movi_envio`.`nombre` ",
			'movi_recepcion' => "`movi_recepcion` LEFT JOIN `movimientos` as movimientos1 ON `movimientos1`.`id_movi`=`movi_recepcion`.`id_movi` LEFT JOIN `unidades` as unidades1 ON `unidades1`.`id_unidades`=`movi_recepcion`.`destino` LEFT JOIN `contactos` as contactos1 ON `contactos1`.`id_contactos`=`movi_recepcion`.`nombre` LEFT JOIN `ciudades` as ciudades1 ON `ciudades1`.`id_ciudad`=`unidades1`.`ciudad` ",
			'tipo_fuera_servicio' => "`tipo_fuera_servicio` ",
			'tipo_documento_ss' => "`tipo_documento_ss` ",
			'tipo_parentesco' => "`tipo_parentesco` ",
			'tipo_rh' => "`tipo_rh` ",
			'accesorio_dispo_relacion' => "`accesorio_dispo_relacion` LEFT JOIN `dispositivos` as dispositivos1 ON `dispositivos1`.`id_dispo`=`accesorio_dispo_relacion`.`id_dispo` LEFT JOIN `dispositivos` as dispositivos2 ON `dispositivos2`.`id_dispo`=`accesorio_dispo_relacion`.`id_accesorio` LEFT JOIN `tipo_dispositivo` as tipo_dispositivo1 ON `tipo_dispositivo1`.`id_tipodispo`=`dispositivos1`.`tipo_dispositivo` LEFT JOIN `marcas` as marcas1 ON `marcas1`.`id_marca`=`dispositivos1`.`marca` LEFT JOIN `marca_modelo` as marca_modelo1 ON `marca_modelo1`.`id_mmodelo`=`dispositivos1`.`modelo` ",
			'observaciones' => "`observaciones` LEFT JOIN `tipo_estado_observa` as tipo_estado_observa1 ON `tipo_estado_observa1`.`id`=`observaciones`.`estado_observacion` LEFT JOIN `tipo_estado_observaciones` as tipo_estado_observaciones1 ON `tipo_estado_observaciones1`.`id`=`observaciones`.`estado` LEFT JOIN `dispositivos` as dispositivos1 ON `dispositivos1`.`id_dispo`=`observaciones`.`codigo` LEFT JOIN `unidades` as unidades1 ON `unidades1`.`id_unidades`=`observaciones`.`unidad` LEFT JOIN `tipo_dispositivo` as tipo_dispositivo1 ON `tipo_dispositivo1`.`id_tipodispo`=`dispositivos1`.`tipo_dispositivo` ",
			'foto_observacion' => "`foto_observacion` LEFT JOIN `observaciones` as observaciones1 ON `observaciones1`.`id`=`foto_observacion`.`id_observacion` ",
			'progreso' => "`progreso` LEFT JOIN `observaciones` as observaciones1 ON `observaciones1`.`id`=`progreso`.`id_observacion` LEFT JOIN `tipo_estado_observaciones` as tipo_estado_observaciones1 ON `tipo_estado_observaciones1`.`id`=`progreso`.`estado_seguimiento` ",
			'tipo_estado_observa' => "`tipo_estado_observa` ",
			'acceso_remoto' => "`acceso_remoto` LEFT JOIN `unidades` as unidades1 ON `unidades1`.`id_unidades`=`acceso_remoto`.`unidad` LEFT JOIN `dispositivos` as dispositivos1 ON `dispositivos1`.`id_dispo`=`acceso_remoto`.`codigo_equipo` LEFT JOIN `ciudades` as ciudades1 ON `ciudades1`.`id_ciudad`=`unidades1`.`ciudad` LEFT JOIN `marcas` as marcas1 ON `marcas1`.`id_marca`=`dispositivos1`.`marca` LEFT JOIN `marca_modelo` as marca_modelo1 ON `marca_modelo1`.`id_mmodelo`=`dispositivos1`.`modelo` ",
			'tipo_periodicidad' => "`tipo_periodicidad` ",
			'perfil' => "`perfil` LEFT JOIN `tipo_iden` as tipo_iden1 ON `tipo_iden1`.`id_iden`=`perfil`.`tipo_id` LEFT JOIN `tipo_rh` as tipo_rh1 ON `tipo_rh1`.`id`=`perfil`.`rh` ",
			'consentimieto' => "`consentimieto` LEFT JOIN `perfil` as perfil1 ON `perfil1`.`id`=`consentimieto`.`id_perfil` LEFT JOIN `tipo_iden` as tipo_iden1 ON `tipo_iden1`.`id_iden`=`perfil1`.`tipo_id` ",
			'perfil_familia' => "`perfil_familia` LEFT JOIN `perfil` as perfil1 ON `perfil1`.`id`=`perfil_familia`.`id_perfil` LEFT JOIN `tipo_parentesco` as tipo_parentesco1 ON `tipo_parentesco1`.`id`=`perfil_familia`.`parentesco` LEFT JOIN `tipo_iden` as tipo_iden1 ON `tipo_iden1`.`id_iden`=`perfil1`.`tipo_id` ",
			'perfil_soportes' => "`perfil_soportes` LEFT JOIN `perfil` as perfil1 ON `perfil1`.`id`=`perfil_soportes`.`id_perfil` LEFT JOIN `tipo_documento` as tipo_documento1 ON `tipo_documento1`.`id_tipodoc`=`perfil_soportes`.`tipo_documento` ",
			'seguridad_social' => "`seguridad_social` LEFT JOIN `perfil` as perfil1 ON `perfil1`.`id`=`seguridad_social`.`id_perfil` LEFT JOIN `tipo_documento_ss` as tipo_documento_ss1 ON `tipo_documento_ss1`.`id_tipodoc`=`seguridad_social`.`tipo_documento` ",
			'costos_mtto' => "`costos_mtto` LEFT JOIN `mantenimientos` as mantenimientos1 ON `mantenimientos1`.`id_mtto`=`costos_mtto`.`id_mtto` LEFT JOIN `tipo_costo` as tipo_costo1 ON `tipo_costo1`.`id`=`costos_mtto`.`tipo_costo` ",
			'tipo_costo' => "`tipo_costo` ",
			'doc_mtto' => "`doc_mtto` LEFT JOIN `mantenimientos` as mantenimientos1 ON `mantenimientos1`.`id_mtto`=`doc_mtto`.`id_mtto` LEFT JOIN `biomedicos` as biomedicos1 ON `biomedicos1`.`id`=`doc_mtto`.`nombre_biomedico` LEFT JOIN `tipo_mtto` as tipo_mtto1 ON `tipo_mtto1`.`id`=`mantenimientos1`.`tipo_mtto` ",
			'biomedicos' => "`biomedicos` LEFT JOIN `contactos` as contactos1 ON `contactos1`.`id_contactos`=`biomedicos`.`id_contacto` ",
			'tipo_clasifica_riesgo' => "`tipo_clasifica_riesgo` ",
			'programa_mtto' => "`programa_mtto` LEFT JOIN `unidades` as unidades1 ON `unidades1`.`id_unidades`=`programa_mtto`.`unidad` ",
			'cronograma_mtto' => "`cronograma_mtto` LEFT JOIN `programa_mtto` as programa_mtto1 ON `programa_mtto1`.`id`=`cronograma_mtto`.`id_programa` LEFT JOIN `unidades` as unidades1 ON `unidades1`.`id_unidades`=`programa_mtto1`.`unidad` LEFT JOIN `dispositivos` as dispositivos1 ON `dispositivos1`.`id_dispo`=`cronograma_mtto`.`codigo` LEFT JOIN `marcas` as marcas1 ON `marcas1`.`id_marca`=`cronograma_mtto`.`marca` LEFT JOIN `tipo_periodicidad` as tipo_periodicidad1 ON `tipo_periodicidad1`.`id`=`cronograma_mtto`.`periodicidad` LEFT JOIN `tipo_dispositivo` as tipo_dispositivo1 ON `tipo_dispositivo1`.`id_tipodispo`=`dispositivos1`.`tipo_dispositivo` LEFT JOIN `marca_modelo` as marca_modelo1 ON `marca_modelo1`.`id_mmodelo`=`dispositivos1`.`modelo` ",
			'compras' => "`compras` LEFT JOIN `tipo_compra` as tipo_compra1 ON `tipo_compra1`.`id`=`compras`.`tipo_compra` LEFT JOIN `tipo_estado_compra` as tipo_estado_compra1 ON `tipo_estado_compra1`.`id`=`compras`.`estado` ",
			'tipo_estado_compra' => "`tipo_estado_compra` ",
			'cantidad_dispomedico' => "`cantidad_dispomedico` LEFT JOIN `compra_dispo` as compra_dispo1 ON `compra_dispo1`.`id`=`cantidad_dispomedico`.`nombre_dispo` LEFT JOIN `tipo_estado_compra` as tipo_estado_compra1 ON `tipo_estado_compra1`.`id`=`cantidad_dispomedico`.`estado` LEFT JOIN `compras` as compras1 ON `compras1`.`id`=`cantidad_dispomedico`.`id_compra` LEFT JOIN `marcas` as marcas1 ON `marcas1`.`id_marca`=`compra_dispo1`.`marca` LEFT JOIN `marca_modelo` as marca_modelo1 ON `marca_modelo1`.`id_mmodelo`=`compra_dispo1`.`modelo` LEFT JOIN `marca_modelo` as marca_modelo2 ON `marca_modelo2`.`id_mmodelo`=`compra_dispo1`.`modelo` ",
			'cantidad_articulos' => "`cantidad_articulos` LEFT JOIN `articulos` as articulos1 ON `articulos1`.`id`=`cantidad_articulos`.`nombre_articulo` LEFT JOIN `tipo_estado_compra` as tipo_estado_compra1 ON `tipo_estado_compra1`.`id`=`cantidad_articulos`.`estado` LEFT JOIN `compras` as compras1 ON `compras1`.`id`=`cantidad_articulos`.`id_compras` LEFT JOIN `marcas` as marcas1 ON `marcas1`.`id_marca`=`articulos1`.`marca` LEFT JOIN `marca_presetacion` as marca_presetacion1 ON `marca_presetacion1`.`id`=`articulos1`.`presentacion` LEFT JOIN `tipo_unidad_medida` as tipo_unidad_medida1 ON `tipo_unidad_medida1`.`id`=`marca_presetacion1`.`unidad_medida` LEFT JOIN `tipo_compra` as tipo_compra1 ON `tipo_compra1`.`id`=`compras1`.`tipo_compra` ",
			'cantidad_mobiliario' => "`cantidad_mobiliario` LEFT JOIN `mobiliario` as mobiliario1 ON `mobiliario1`.`id_mobiliario`=`cantidad_mobiliario`.`nombre_mobiliario` LEFT JOIN `tipo_grupo_mobilia` as tipo_grupo_mobilia1 ON `tipo_grupo_mobilia1`.`id_gru_mo`=`mobiliario1`.`grupo` LEFT JOIN `tipo_mobiliario` as tipo_mobiliario1 ON `tipo_mobiliario1`.`id`=`mobiliario1`.`tipo_mobiliario` LEFT JOIN `tipo_estado_compra` as tipo_estado_compra1 ON `tipo_estado_compra1`.`id`=`cantidad_mobiliario`.`estado` LEFT JOIN `compras` as compras1 ON `compras1`.`id`=`cantidad_mobiliario`.`id_compra` ",
			'compra_dispo' => "`compra_dispo` LEFT JOIN `tipo_dispositivo` as tipo_dispositivo1 ON `tipo_dispositivo1`.`id_tipodispo`=`compra_dispo`.`tipo_dispositivo` LEFT JOIN `marcas` as marcas1 ON `marcas1`.`id_marca`=`compra_dispo`.`marca` LEFT JOIN `marca_modelo` as marca_modelo1 ON `marca_modelo1`.`id_mmodelo`=`compra_dispo`.`modelo` LEFT JOIN `tipo_estado_dispo` as tipo_estado_dispo1 ON `tipo_estado_dispo1`.`id`=`compra_dispo`.`estado` LEFT JOIN `tipo_clasifica_riesgo` as tipo_clasifica_riesgo1 ON `tipo_clasifica_riesgo1`.`id`=`compra_dispo`.`riesgo` ",
			'articulos' => "`articulos` LEFT JOIN `tipo_dispositivo` as tipo_dispositivo1 ON `tipo_dispositivo1`.`id_tipodispo`=`articulos`.`tipo_dispo` LEFT JOIN `marcas` as marcas1 ON `marcas1`.`id_marca`=`articulos`.`marca` LEFT JOIN `marca_modelo` as marca_modelo1 ON `marca_modelo1`.`id_mmodelo`=`articulos`.`modelo` LEFT JOIN `marca_presetacion` as marca_presetacion1 ON `marca_presetacion1`.`id`=`articulos`.`presentacion` LEFT JOIN `tipo_unidad_medida` as tipo_unidad_medida1 ON `tipo_unidad_medida1`.`id`=`marca_presetacion1`.`unidad_medida` LEFT JOIN `articulos_familia` as articulos_familia1 ON `articulos_familia1`.`id`=`articulos`.`familia` LEFT JOIN `tipo_estado_dispo` as tipo_estado_dispo1 ON `tipo_estado_dispo1`.`id`=`articulos`.`estado` ",
			'cofig' => "`cofig` ",
			'marca_presetacion' => "`marca_presetacion` LEFT JOIN `marcas` as marcas1 ON `marcas1`.`id_marca`=`marca_presetacion`.`marca` LEFT JOIN `tipo_unidad_medida` as tipo_unidad_medida1 ON `tipo_unidad_medida1`.`id`=`marca_presetacion`.`unidad_medida` ",
			'tipo_document_grupo' => "`tipo_document_grupo` ",
			'tipo_pago' => "`tipo_pago` ",
			'tipo_compra' => "`tipo_compra` ",
			'articulos_familia' => "`articulos_familia` ",
			'articulo_codigo_proveedor' => "`articulo_codigo_proveedor` LEFT JOIN `articulos_familia` as articulos_familia1 ON `articulos_familia1`.`id`=`articulo_codigo_proveedor`.`familia` ",
			'tipo_unidad_medida' => "`tipo_unidad_medida` ",
			'genera_documentos' => "`genera_documentos` LEFT JOIN `ciudades` as ciudades1 ON `ciudades1`.`id_ciudad`=`genera_documentos`.`ciudad` LEFT JOIN `unidades` as unidades1 ON `unidades1`.`id_unidades`=`genera_documentos`.`entidad` ",
			'verificacion_articulos' => "`verificacion_articulos` LEFT JOIN `articulos` as articulos1 ON `articulos1`.`id`=`verificacion_articulos`.`codigo` LEFT JOIN `unidades` as unidades1 ON `unidades1`.`id_unidades`=`verificacion_articulos`.`ubicacion` LEFT JOIN `tipo_dispositivo` as tipo_dispositivo1 ON `tipo_dispositivo1`.`id_tipodispo`=`articulos1`.`tipo_dispo` LEFT JOIN `ciudades` as ciudades1 ON `ciudades1`.`id_ciudad`=`unidades1`.`ciudad` ",
			'movimientos_articulos' => "`movimientos_articulos` LEFT JOIN `articulos` as articulos1 ON `articulos1`.`id`=`movimientos_articulos`.`nombre` LEFT JOIN `tipo_estado_movi` as tipo_estado_movi1 ON `tipo_estado_movi1`.`id`=`movimientos_articulos`.`estado_movi` LEFT JOIN `tipo_dispositivo` as tipo_dispositivo1 ON `tipo_dispositivo1`.`id_tipodispo`=`articulos1`.`tipo_dispo` ",
			'movi_envio_articulo' => "`movi_envio_articulo` LEFT JOIN `movimientos_articulos` as movimientos_articulos1 ON `movimientos_articulos1`.`id_movi`=`movi_envio_articulo`.`id_movi` LEFT JOIN `unidades` as unidades1 ON `unidades1`.`id_unidades`=`movi_envio_articulo`.`origen` LEFT JOIN `ciudades` as ciudades1 ON `ciudades1`.`id_ciudad`=`movi_envio_articulo`.`ciudad` LEFT JOIN `contactos` as contactos1 ON `contactos1`.`id_contactos`=`movi_envio_articulo`.`nombre` ",
			'movi_recepcion_articulos' => "`movi_recepcion_articulos` LEFT JOIN `movimientos_articulos` as movimientos_articulos1 ON `movimientos_articulos1`.`id_movi`=`movi_recepcion_articulos`.`id_movi` LEFT JOIN `unidades` as unidades1 ON `unidades1`.`id_unidades`=`movi_recepcion_articulos`.`destino` LEFT JOIN `contactos` as contactos1 ON `contactos1`.`id_contactos`=`movi_recepcion_articulos`.`nombre` LEFT JOIN `ciudades` as ciudades1 ON `ciudades1`.`id_ciudad`=`unidades1`.`ciudad` ",
			'ubicacion_articulo' => "`ubicacion_articulo` LEFT JOIN `articulos` as articulos1 ON `articulos1`.`id`=`ubicacion_articulo`.`id_articulo` LEFT JOIN `tipo_dispositivo` as tipo_dispositivo1 ON `tipo_dispositivo1`.`id_tipodispo`=`articulos1`.`tipo_dispo` LEFT JOIN `marcas` as marcas1 ON `marcas1`.`id_marca`=`articulos1`.`marca` LEFT JOIN `unidades` as unidades1 ON `unidades1`.`id_unidades`=`ubicacion_articulo`.`ubicacion` ",
			'ubicacion_mobiliario' => "`ubicacion_mobiliario` LEFT JOIN `mobiliario` as mobiliario1 ON `mobiliario1`.`id_mobiliario`=`ubicacion_mobiliario`.`id_mobiliario` LEFT JOIN `tipo_grupo_mobilia` as tipo_grupo_mobilia1 ON `tipo_grupo_mobilia1`.`id_gru_mo`=`mobiliario1`.`grupo` LEFT JOIN `tipo_mobiliario` as tipo_mobiliario1 ON `tipo_mobiliario1`.`id`=`mobiliario1`.`tipo_mobiliario` LEFT JOIN `unidades` as unidades1 ON `unidades1`.`id_unidades`=`ubicacion_mobiliario`.`ubicacion` ",
			'precio_dispo_medico' => "`precio_dispo_medico` LEFT JOIN `compra_dispo` as compra_dispo1 ON `compra_dispo1`.`id`=`precio_dispo_medico`.`dispo_medico` ",
			'precio_articulo' => "`precio_articulo` ",
			'precio_mobiliario' => "`precio_mobiliario` ",
		];

		$pkey = [
			'dispositivos' => 'id_dispo',
			'mobiliario' => 'id_mobiliario',
			'contactos' => 'id_contactos',
			'contactos_tipo_contacto' => 'id_tipo_contacto',
			'movimientos' => 'id_movi',
			'documentos' => 'id',
			'mantenimientos' => 'id_mtto',
			'calibraciones' => 'id',
			'unidades' => 'id_unidades',
			'marcas' => 'id_marca',
			'marca_modelo' => 'id_mmodelo',
			'accesorios' => 'id',
			'ciudades' => 'id_ciudad',
			'verificacion' => 'id',
			'hojadevida' => 'id',
			'financiero' => 'id',
			'financiero_mobiliario' => 'id',
			'prestador' => 'id',
			'docu_modelo' => 'id',
			'facturas' => 'id',
			'formatos' => 'id',
			'dispo_fuera' => 'id',
			'dispositivo_tipo_grupo' => 'id',
			'tipo_relacion' => 'id_tiporelac',
			'tipo_dispositivo' => 'id_tipodispo',
			'tipo_documento' => 'id_tipodoc',
			'tipo_iden' => 'id_iden',
			'tipo_razon_social' => 'id',
			'tipo_mobiliario' => 'id',
			'tipo_grupo_mobilia' => 'id_gru_mo',
			'tipo_estado_dispo' => 'id',
			'tipo_movimiento' => 'id',
			'tipo_estado_movi' => 'id',
			'tipo_estado_verifica' => 'id',
			'tipo_mtto' => 'id',
			'tipo_calibracion' => 'id',
			'tipo_accesorio' => 'id',
			'tipo_formatos' => 'id',
			'dispo_detalles_tecnicos' => 'id',
			'tipo_estado_observaciones' => 'id',
			'movi_envio' => 'id',
			'movi_recepcion' => 'id',
			'tipo_fuera_servicio' => 'id',
			'tipo_documento_ss' => 'id_tipodoc',
			'tipo_parentesco' => 'id',
			'tipo_rh' => 'id',
			'accesorio_dispo_relacion' => 'id',
			'observaciones' => 'id',
			'foto_observacion' => 'id',
			'progreso' => 'id',
			'tipo_estado_observa' => 'id',
			'acceso_remoto' => 'id',
			'tipo_periodicidad' => 'id',
			'perfil' => 'id',
			'consentimieto' => 'id',
			'perfil_familia' => 'id',
			'perfil_soportes' => 'id',
			'seguridad_social' => 'id',
			'costos_mtto' => 'id',
			'tipo_costo' => 'id',
			'doc_mtto' => 'id_doc',
			'biomedicos' => 'id',
			'tipo_clasifica_riesgo' => 'id',
			'programa_mtto' => 'id',
			'cronograma_mtto' => 'id',
			'compras' => 'id',
			'tipo_estado_compra' => 'id',
			'cantidad_dispomedico' => 'id',
			'cantidad_articulos' => 'id',
			'cantidad_mobiliario' => 'id',
			'compra_dispo' => 'id',
			'articulos' => 'id',
			'cofig' => 'id',
			'marca_presetacion' => 'id',
			'tipo_document_grupo' => 'id',
			'tipo_pago' => 'id',
			'tipo_compra' => 'id',
			'articulos_familia' => 'id',
			'articulo_codigo_proveedor' => 'id',
			'tipo_unidad_medida' => 'id',
			'genera_documentos' => 'id',
			'verificacion_articulos' => 'id',
			'movimientos_articulos' => 'id_movi',
			'movi_envio_articulo' => 'id',
			'movi_recepcion_articulos' => 'id',
			'ubicacion_articulo' => 'id',
			'ubicacion_mobiliario' => 'id',
			'precio_dispo_medico' => 'id',
			'precio_articulo' => 'id',
			'precio_mobiliario' => 'id',
		];

		if(!isset($sql_from[$table_name])) return false;

		$from = ($skip_joins ? "`{$table_name}`" : $sql_from[$table_name]);

		if($skip_permissions) return $from . ' WHERE 1=1';

		// mm: build the query based on current member's permissions
		// allowing lower permissions if $lower_permissions set to 'user' or 'group'
		$perm = getTablePermissions($table_name);
		if($perm['view'] == 1 || ($perm['view'] > 1 && $lower_permissions == 'user')) { // view owner only
			$from .= ", `membership_userrecords` WHERE `{$table_name}`.`{$pkey[$table_name]}`=`membership_userrecords`.`pkValue` AND `membership_userrecords`.`tableName`='{$table_name}' AND LCASE(`membership_userrecords`.`memberID`)='" . getLoggedMemberID() . "'";
		} elseif($perm['view'] == 2 || ($perm['view'] > 2 && $lower_permissions == 'group')) { // view group only
			$from .= ", `membership_userrecords` WHERE `{$table_name}`.`{$pkey[$table_name]}`=`membership_userrecords`.`pkValue` AND `membership_userrecords`.`tableName`='{$table_name}' AND `membership_userrecords`.`groupID`='" . getLoggedGroupID() . "'";
		} elseif($perm['view'] == 3) { // view all
			$from .= ' WHERE 1=1';
		} else { // view none
			return false;
		}

		return $from;
	}

	#########################################################

	function get_joined_record($table, $id, $skip_permissions = false) {
		$sql_fields = get_sql_fields($table);
		$sql_from = get_sql_from($table, $skip_permissions);

		if(!$sql_fields || !$sql_from) return false;

		$pk = getPKFieldName($table);
		if(!$pk) return false;

		$safe_id = makeSafe($id, false);
		$sql = "SELECT {$sql_fields} FROM {$sql_from} AND `{$table}`.`{$pk}`='{$safe_id}'";
		$eo['silentErrors'] = true;
		$res = sql($sql, $eo);
		if($row = db_fetch_assoc($res)) return $row;

		return false;
	}

	#########################################################

	function get_defaults($table) {
		/* array of tables and their fields, with default values (or empty), excluding automatic values */
		$defaults = [
			'dispositivos' => [
				'codigo' => '',
				'id_dispo' => '',
				'foto' => '',
				'code' => '',
				'serial' => '',
				'tipo_dispositivo' => '',
				'marca' => '',
				'modelo' => '',
				'ubicacion' => '',
				'ubicacion_abre' => '',
				'fecha_ingreso' => '',
				'clasificacion_riesgo' => '',
				'estado' => '',
				'precio' => '',
				'creado' => '',
				'creado_por' => '',
				'editado' => '',
				'editado_por' => '',
				'id_compra_ingreso' => '',
			],
			'mobiliario' => [
				'id_mobiliario' => '',
				'codigo' => '',
				'nombre' => '',
				'grupo' => '',
				'tipo_mobiliario' => '',
				'descripcion' => '',
				'fecha_ingreso' => '',
				'accesorios' => '',
				'foto' => '',
				'unidad' => '',
				'uni_abreviado' => '',
				'creado' => '',
				'creado_por' => '',
				'editado' => '',
				'editado_por' => '',
				'id_compra' => '',
			],
			'contactos' => [
				'id_contactos' => '',
				'tipo_contacto' => '',
				'tipo_iden' => '',
				'identificacion' => '',
				'nombre' => '',
				'ciudad' => '',
				'telefono' => '',
				'direccion' => '',
				'tipo_relacion' => '',
				'nota' => '',
				'reg_creado' => '',
				'creado' => '',
				'creado_por' => '',
				'editado' => '',
				'editado_por' => '',
			],
			'contactos_tipo_contacto' => [
				'id_tipo_contacto' => '',
				'tipo_contacto' => '',
				'descripcion' => '',
			],
			'movimientos' => [
				'id_movi' => '',
				'img' => '',
				'tipo_dispo' => '',
				'codigo_dispo' => '',
				'serial_dispo' => '',
				'estado_movi' => '',
				'origen' => '',
				'destino' => '',
				'creado' => '',
				'creado_por' => '',
				'editado' => '',
				'editado_por' => '',
			],
			'documentos' => [
				'id' => '',
				'dispo_codigo' => '',
				'dispo_serial' => '',
				'tipo_docu' => '',
				'enlace' => '',
				'descripcion' => '',
				'fecha_carga' => '',
				'creado' => '',
				'creado_por' => '',
				'editado' => '',
				'editado_por' => '',
			],
			'mantenimientos' => [
				'id_mtto' => '',
				'codigo' => '',
				'serial' => '',
				'tipo_dispo' => '',
				'fecha_mtto' => '',
				'tipo_mtto' => '',
				'responsable' => '',
				'id_responsable' => '',
				'documento' => '',
				'documento_drive' => '',
				'unidad' => '',
				'unidad_abreviado' => '',
				'descripcion' => '',
				'estado_final' => '',
				'creado_por' => '',
				'editado_por' => '',
				'creado' => '',
				'editado' => '',
			],
			'calibraciones' => [
				'id' => '',
				'codigo' => '',
				'serial' => '',
				'tipo_calibracion' => '',
				'no_documento' => '',
				'fecha_calibra' => '',
				'fecha_expiracion' => '',
				'empresa' => '',
				'telefono' => '',
				'documento' => '',
				'descripcion' => '',
				'creado' => '',
				'creado_por' => '',
				'editado' => '',
				'editado_por' => '',
			],
			'unidades' => [
				'id_unidades' => '',
				'nombre' => '',
				'abreviado' => '',
				'ciudad' => '',
				'telefono' => '',
				'direccion' => '',
				'ubicacion' => '',
				'prestador' => '',
				'logo' => '',
				'dispositivos_costo' => '',
				'mobiliario_costo' => '',
				'costo_total' => '',
			],
			'marcas' => [
				'id_marca' => '',
				'marca' => '',
				'descripcion' => '',
			],
			'marca_modelo' => [
				'id_mmodelo' => '',
				'marca' => '',
				'modelo' => '',
				'img' => '',
				'fabricante' => '',
				'descripcion' => '',
				'creado' => '',
				'creado_por' => '',
			],
			'accesorios' => [
				'id' => '',
				'codigo_accesorio' => '',
				'tipo_accesorio' => '',
				'nombre_accesorio' => '',
				'descripcion' => '',
				'id_dispo' => '',
				'creado' => '',
				'creado_por' => '',
			],
			'ciudades' => [
				'id_ciudad' => '',
				'ciudad' => '',
				'descripcion' => '',
			],
			'verificacion' => [
				'id' => '',
				'codigo' => '',
				'tipo_dispo' => '',
				'serial' => '',
				'ubicacion' => '',
				'abreviado' => '',
				'verificacion' => '',
				'comentario' => '',
				'fecha_verifi' => '',
				'verifi_por' => '',
			],
			'hojadevida' => [
				'id' => '',
				'dispo_codigo' => '',
				'dispo_serial' => '',
				'hardware' => '',
				'software' => '',
				'carga' => '',
				'creado' => '',
				'creado_por' => '',
				'editado' => '',
				'editado_por' => '',
			],
			'financiero' => [
				'id' => '',
				'id_dispo' => '',
				'precio' => '',
				'unidad' => '',
				'enlace' => '',
				'creado' => '',
				'creado_por' => '',
				'editado' => '',
				'editado_por' => '',
			],
			'financiero_mobiliario' => [
				'id' => '',
				'id_dispo' => '',
				'precio' => '',
				'unidad' => '',
				'enlace' => '',
				'creado' => '',
				'creado_por' => '',
				'editado' => '',
				'editado_por' => '',
			],
			'prestador' => [
				'id' => '',
				'nombre' => '',
				'razon_social' => '',
				'nit' => '',
				'descripcion' => '',
			],
			'docu_modelo' => [
				'id' => '',
				'tipo_dispo' => '',
				'marca' => '',
				'modelo' => '',
				'tipo_documento' => '',
				'enlace' => '',
				'descripcion' => '',
				'creado' => '',
				'creado_por' => '',
				'editado' => '',
				'editado_por' => '',
			],
			'facturas' => [
				'id' => '',
				'id_dispo' => '',
				'no_factura' => '',
				'fecha_factura' => '',
				'proveedor' => '',
				'identificacion' => '',
				'enlace_doc' => '',
				'creado' => '',
				'creado_por' => '',
				'editado' => '',
				'editado_por' => '',
				'id_compras' => '',
			],
			'formatos' => [
				'id' => '',
				'tipo_formato' => '',
				'tipo_dispositivo' => '',
				'nombre_formato' => '',
				'formato' => '',
				'descripcion' => '',
				'creado' => '',
			],
			'dispo_fuera' => [
				'id' => '',
				'img' => '',
				'codigo' => '',
				'serial' => '',
				'ubicacion_final' => '',
				'tipo_fuera_servicio' => '',
				'fecha_reporte' => '',
				'descripcion' => '',
				'creado' => '',
				'creado_por' => '',
				'editado' => '',
				'edtado_por' => '',
			],
			'dispositivo_tipo_grupo' => [
				'id' => '',
				'grupo' => '',
				'descripcion' => '',
			],
			'tipo_relacion' => [
				'id_tiporelac' => '',
				'tipo_relac' => '',
				'descripcion' => '',
				'creado' => '',
			],
			'tipo_dispositivo' => [
				'id_tipodispo' => '',
				'tipo_dispositivo' => '',
				'grupo_dispo' => '',
				'prefijo' => '',
				'descripcion' => '',
			],
			'tipo_documento' => [
				'id_tipodoc' => '',
				'tipo_doc' => '',
				'grupo' => '',
				'descripcion' => '',
			],
			'tipo_iden' => [
				'id_iden' => '',
				'tipo_iden' => '',
				'tipo_iden_abre' => '',
			],
			'tipo_razon_social' => [
				'id' => '',
				'razon_social' => '',
				'nit' => '',
				'descripcion' => '',
			],
			'tipo_mobiliario' => [
				'id' => '',
				'grupo_mobi' => '',
				'tipo_mobiliario' => '',
				'caracteristicas' => '',
			],
			'tipo_grupo_mobilia' => [
				'id_gru_mo' => '',
				'grupo' => '',
				'prefijo' => '',
				'descripcion' => '',
			],
			'tipo_estado_dispo' => [
				'id' => '',
				'estado_dispo' => '',
				'descripcion' => '',
			],
			'tipo_movimiento' => [
				'id' => '',
				'tipo_movimiento' => '',
				'descripcion' => '',
			],
			'tipo_estado_movi' => [
				'id' => '',
				'estado_movi' => '',
				'descripcion' => '',
			],
			'tipo_estado_verifica' => [
				'id' => '',
				'estado_verificado' => '',
				'descripcion' => '',
			],
			'tipo_mtto' => [
				'id' => '',
				'tipo_mtto' => '',
				'descripcion' => '',
			],
			'tipo_calibracion' => [
				'id' => '',
				'tipo_calibracion' => '',
				'descripcion' => '',
			],
			'tipo_accesorio' => [
				'id' => '',
				'tipo_accesorio' => '',
				'prefijo' => '',
				'descripcion' => '',
			],
			'tipo_formatos' => [
				'id' => '',
				'tipo_formato' => '',
				'descripcion' => '',
			],
			'dispo_detalles_tecnicos' => [
				'id' => '',
				'id_dispo' => '',
				'detalles' => '',
				'creado' => '',
			],
			'tipo_estado_observaciones' => [
				'id' => '',
				'estado_observa' => '',
				'descripcion' => '',
			],
			'movi_envio' => [
				'id' => '',
				'id_movi' => '',
				'fecha_envio' => '',
				'origen' => '',
				'ubicacion' => '',
				'destino' => '',
				'd_direccion' => '',
				'ciudad' => '',
				'nombre' => '',
				'telefono' => '',
				'detalles' => '',
				'creado' => '',
				'creado_por' => '',
				'editado' => '',
				'editado_por' => '',
			],
			'movi_recepcion' => [
				'id' => '',
				'id_movi' => '',
				'fecha_recepcion' => '',
				'destino' => '',
				'o_direccion' => '',
				'ciudad' => '',
				'verificado' => '',
				'nombre' => '',
				'telefono' => '',
				'detalles' => '',
				'creado' => '',
				'creado_por' => '',
				'editado' => '',
				'editado_por' => '',
			],
			'tipo_fuera_servicio' => [
				'id' => '',
				'tipo_fuera_servicio' => '',
				'descripcion' => '',
			],
			'tipo_documento_ss' => [
				'id_tipodoc' => '',
				'tipo_doc' => '',
				'descripcion' => '',
			],
			'tipo_parentesco' => [
				'id' => '',
				'parentesco' => '',
				'descripcion' => '',
			],
			'tipo_rh' => [
				'id' => '',
				'tipo_rh' => '',
			],
			'accesorio_dispo_relacion' => [
				'id' => '',
				'id_dispo' => '',
				'id_accesorio' => '',
				'tipo_dispo' => '',
				'serial' => '',
				'marca_modelo' => '',
				'creado' => '',
				'creado_por' => '',
			],
			'observaciones' => [
				'id' => '',
				'estado_observacion' => '',
				'estado' => '',
				'codigo' => '',
				'tipo_dispo' => '',
				'serial' => '',
				'unidad' => '',
				'observacion' => '',
				'creado' => '',
				'creado_por' => '',
			],
			'foto_observacion' => [
				'id' => '',
				'id_observacion' => '',
				'foto' => '',
				'descripcion' => '',
				'creado' => '',
				'creado_por' => '',
			],
			'progreso' => [
				'id' => '',
				'id_observacion' => '',
				'estado_seguimiento' => '',
				'descripcion' => '',
				'credo' => '',
				'creado_por' => '',
			],
			'tipo_estado_observa' => [
				'id' => '',
				'tipo_estado_observa' => '',
				'descripcion' => '',
			],
			'acceso_remoto' => [
				'id' => '',
				'unidad' => '',
				'ciudad' => '',
				'servicio' => '',
				'anydesk' => '',
				'acceso' => '',
				'teamviewer' => '',
				'acceso2' => '',
				'codigo_equipo' => '',
				'equipo' => '',
				'ultima_verifica' => '',
				'comentario' => '',
				'creado' => '',
				'creado_por' => '',
				'editado' => '',
				'editado_por' => '',
			],
			'tipo_periodicidad' => [
				'id' => '',
				'periodicidad' => '',
				'descripcion' => '',
			],
			'perfil' => [
				'id' => '',
				'usuario' => '',
				'nombre' => '',
				'apellidos' => '',
				'tipo_id' => '',
				'numero_id' => '',
				'dato2' => '',
				'fecha_nacimiento' => '',
				'telefono' => '',
				'celular' => '',
				'rh' => '',
				'foto_perfil' => '',
				'estado_civil' => '',
				'direccion' => '',
				'optimo' => '',
				'creado' => '',
				'creado_por' => '',
				'grupo' => '',
				'estado' => '',
			],
			'consentimieto' => [
				'id' => '',
				'id_perfil' => '',
				'identificacion' => '',
				'acepto' => '',
				'creado' => '',
				'creado_por' => '',
			],
			'perfil_familia' => [
				'id' => '',
				'id_perfil' => '',
				'identificacion' => '',
				'parentesco' => '',
				'nombre' => '',
				'telefono' => '',
				'direccion' => '',
				'creado' => '',
				'creado_por' => '',
			],
			'perfil_soportes' => [
				'id' => '',
				'id_perfil' => '',
				'tipo_documento' => '',
				'nombre_documento' => '',
				'docuemento' => '',
				'creado' => '',
				'creado_por' => '',
			],
			'seguridad_social' => [
				'id' => '',
				'id_perfil' => '',
				'tipo_documento' => '',
				'docuemento' => '',
				'descripcion' => '',
				'creado' => '',
				'creado_por' => '',
			],
			'costos_mtto' => [
				'id' => '',
				'id_mtto' => '',
				'tipo_costo' => '',
				'precio' => '',
				'cantidad' => '',
				'descripcion' => '',
				'creado' => '',
				'creado_por' => '',
			],
			'tipo_costo' => [
				'id' => '',
				'tipo_costo' => '',
				'descripcion' => '',
			],
			'doc_mtto' => [
				'id_doc' => '',
				'doc' => '',
				'id_mtto' => '',
				'tipo_mtto' => '',
				'mtto' => '',
				'observaciones' => '',
				'nombre_biomedico' => '',
				'registro_invima' => '',
				'firma_biomedico' => '',
				'creado' => '',
				'creado_por' => '',
			],
			'biomedicos' => [
				'id' => '',
				'id_contacto' => '',
				'nombre' => '',
				'registro_invima' => '',
				'nota' => '',
				'firma' => '',
			],
			'tipo_clasifica_riesgo' => [
				'id' => '',
				'clase' => '',
				'nivel_riesgo' => '',
				'ejemplo' => '',
				'nota' => '',
			],
			'programa_mtto' => [
				'id' => '',
				'unidad' => '',
				'ano' => '',
				'descripcion' => '',
				'enlace' => '',
				'archivo' => '',
				'creado' => '',
				'creado_por' => '',
			],
			'cronograma_mtto' => [
				'id' => '',
				'id_programa' => '',
				'ano' => '',
				'codigo' => '',
				'tipo_dispo' => '',
				'marca' => '',
				'modelo' => '',
				'periodicidad' => '',
				'meses' => '',
				'biomedico' => '',
				'actividades' => '',
				'creado' => '',
				'creado_por' => '',
			],
			'compras' => [
				'id' => '',
				'tipo_compra' => '',
				'fecha_compra' => '',
				'comprador' => '',
				'resumen' => '',
				'estado' => '',
				'creado' => '',
				'creado_por' => '',
			],
			'tipo_estado_compra' => [
				'id' => '',
				'tipo_estado_compra' => '',
				'descripcion' => '',
			],
			'cantidad_dispomedico' => [
				'id' => '',
				'nombre_dispo' => '',
				'serial' => '',
				'marca_modelo' => '',
				'descripcion' => '',
				'uso' => '',
				'estado' => '',
				'id_compra' => '',
				'creado' => '',
				'creado_por' => '',
			],
			'cantidad_articulos' => [
				'id' => '',
				'nombre_articulo' => '',
				'presentacion' => '',
				'descripcion' => '',
				'serial' => '',
				'cantidad' => '',
				'estado' => '',
				'id_compras' => '',
				'creado' => '',
				'tipo_compra' => '',
				'creado_por' => '',
			],
			'cantidad_mobiliario' => [
				'id' => '',
				'nombre_mobiliario' => '',
				'descripcion' => '',
				'estado' => '',
				'id_compra' => '',
				'creado' => '',
				'creado_por' => '',
			],
			'compra_dispo' => [
				'id' => '',
				'foto' => '',
				'nombre' => '',
				'serial' => '',
				'tipo_dispositivo' => '',
				'marca' => '',
				'modelo' => '',
				'caracteristicas' => '',
				'estado' => '',
				'riesgo' => '',
				'precio' => '',
				'creado' => '',
				'creado_por' => '',
			],
			'articulos' => [
				'id' => '',
				'nombre_unico' => '',
				'tipo_dispo' => '',
				'marca' => '',
				'modelo' => '',
				'presentacion' => '',
				'serial' => '',
				'referencia' => '',
				'familia' => '',
				'codigo_proveedor' => '',
				'caracteristicas' => '',
				'nota' => '',
				'imagen' => '',
				'estado' => '',
				'creado' => '',
				'creado_por' => '',
			],
			'cofig' => [
				'id' => '',
				'dato1' => '',
				'dato2' => '',
				'descripcion' => '',
			],
			'marca_presetacion' => [
				'id' => '',
				'marca' => '',
				'unidad_medida' => '',
				'presentacion' => '',
			],
			'tipo_document_grupo' => [
				'id' => '',
				'grupo' => '',
				'descripcion' => '',
			],
			'tipo_pago' => [
				'id' => '',
				'tipo_pago' => '',
				'descripcion' => '',
			],
			'tipo_compra' => [
				'id' => '',
				'tipo_compra' => '',
				'descripcion' => '',
			],
			'articulos_familia' => [
				'id' => '',
				'codigo' => '',
				'familia' => '',
				'proveedor' => '',
			],
			'articulo_codigo_proveedor' => [
				'id' => '',
				'familia' => '',
				'codigo' => '',
				'proveedor' => '',
			],
			'tipo_unidad_medida' => [
				'id' => '',
				'unidad' => '',
				'nota' => '',
			],
			'genera_documentos' => [
				'id' => '',
				'tipo_documento_entrega' => '',
				'ciudad' => '',
				'fecha' => '',
				'entidad' => '',
				'referencia' => '',
				'descripcion' => '',
				'conslusion' => '',
				'creado' => '',
				'creado_por' => '',
			],
			'verificacion_articulos' => [
				'id' => '',
				'codigo' => '',
				'tipo_dispo' => '',
				'nombre' => '',
				'serial' => '',
				'ubicacion' => '',
				'abreviado' => '',
				'verificacion' => '',
				'comentario' => '',
				'fecha_verifi' => '',
				'verifi_por' => '',
			],
			'movimientos_articulos' => [
				'id_movi' => '',
				'img' => '',
				'tipo_dispo' => '',
				'nombre' => '',
				'serial_dispo' => '',
				'estado_movi' => '',
				'origen' => '',
				'destino' => '',
				'creado' => '',
				'creado_por' => '',
				'editado' => '',
				'editado_por' => '',
			],
			'movi_envio_articulo' => [
				'id' => '',
				'id_movi' => '',
				'fecha_envio' => '',
				'origen' => '',
				'ubicacion' => '',
				'destino' => '',
				'd_direccion' => '',
				'ciudad' => '',
				'nombre' => '',
				'telefono' => '',
				'detalles' => '',
				'creado' => '',
				'creado_por' => '',
				'editado' => '',
				'editado_por' => '',
			],
			'movi_recepcion_articulos' => [
				'id' => '',
				'id_movi' => '',
				'fecha_recepcion' => '',
				'destino' => '',
				'o_direccion' => '',
				'ciudad' => '',
				'verificado' => '',
				'nombre' => '',
				'telefono' => '',
				'detalles' => '',
				'creado' => '',
				'creado_por' => '',
				'editado' => '',
				'editado_por' => '',
			],
			'ubicacion_articulo' => [
				'id' => '',
				'id_articulo' => '',
				'ubicacion' => '',
				'creado' => '',
				'creado_por' => '',
			],
			'ubicacion_mobiliario' => [
				'id' => '',
				'id_mobiliario' => '',
				'ubicacion' => '',
				'creado' => '',
				'creado_por' => '',
			],
			'precio_dispo_medico' => [
				'id' => '',
				'dispo_medico' => '',
				'precio' => '',
				'proveedor' => '',
			],
			'precio_articulo' => [
				'id' => '',
				'articulo' => '',
				'precio' => '',
				'proveedor' => '',
			],
			'precio_mobiliario' => [
				'id' => '',
				'mobiliario' => '',
				'precio' => '',
				'proveedor' => '',
			],
		];

		return isset($defaults[$table]) ? $defaults[$table] : [];
	}

	#########################################################

	function logInMember() {
		$redir = 'index.php';
		if($_POST['signIn'] != '') {
			if($_POST['username'] != '' && $_POST['password'] != '') {
				$username = makeSafe(strtolower($_POST['username']));
				$hash = sqlValue("select passMD5 from membership_users where lcase(memberID)='{$username}' and isApproved=1 and isBanned=0");
				$password = $_POST['password'];

				if(password_match($password, $hash)) {
					$_SESSION['memberID'] = $username;
					$_SESSION['memberGroupID'] = sqlValue("SELECT `groupID` FROM `membership_users` WHERE LCASE(`memberID`)='{$username}'");

					if($_POST['rememberMe'] == 1) {
						RememberMe::login($username);
					} else {
						RememberMe::delete();
					}

					// harden user's password hash
					password_harden($username, $password, $hash);

					// hook: login_ok
					if(function_exists('login_ok')) {
						$args = [];
						if(!$redir = login_ok(getMemberInfo(), $args)) {
							$redir = 'index.php';
						}
					}

					redirect($redir);
					exit;
				}
			}

			// hook: login_failed
			if(function_exists('login_failed')) {
				$args = [];
				login_failed([
					'username' => $_POST['username'],
					'password' => $_POST['password'],
					'IP' => $_SERVER['REMOTE_ADDR']
				], $args);
			}

			if(!headers_sent()) header('HTTP/1.0 403 Forbidden');
			redirect("index.php?loginFailed=1");
			exit;
		}

		/* do we have a JWT auth header? */
		jwt_check_login();

		if(!empty($_SESSION['memberID']) && !empty($_SESSION['memberGroupID'])) return;

		/* check if a rememberMe cookie exists and sign in user if so */
		if(RememberMe::check()) {
			$username = makeSafe(strtolower(RememberMe::user()));
			$_SESSION['memberID'] = $username;
			$_SESSION['memberGroupID'] = sqlValue("SELECT `groupID` FROM `membership_users` WHERE LCASE(`memberID`)='{$username}'");
		}
	}

	#########################################################

	function htmlUserBar() {
		global $Translation;
		if(!defined('PREPEND_PATH')) define('PREPEND_PATH', '');

		$mi = getMemberInfo();
		$adminConfig = config('adminConfig');
		$home_page = (basename($_SERVER['PHP_SELF']) == 'index.php');
		ob_start();

		?>
		<nav class="navbar navbar-default navbar-fixed-top hidden-print" role="navigation">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<!-- application title is obtained from the name besides the yellow database icon in AppGini, use underscores for spaces -->
				<a class="navbar-brand" href="<?php echo PREPEND_PATH; ?>index.php"><i class="glyphicon glyphicon-home"></i> STARMEDICA</a>
			</div>
			<div class="collapse navbar-collapse">
				<ul class="nav navbar-nav"><?php echo ($home_page ? '' : NavMenus()); ?></ul>

				<?php if(userCanImport()){ ?>
					<ul class="nav navbar-nav">
						<a href="<?php echo PREPEND_PATH; ?>import-csv.php" class="btn btn-default navbar-btn hidden-xs btn-import-csv" title="<?php echo html_attr($Translation['import csv file']); ?>"><i class="glyphicon glyphicon-th"></i> <?php echo $Translation['import CSV']; ?></a>
						<a href="<?php echo PREPEND_PATH; ?>import-csv.php" class="btn btn-default navbar-btn visible-xs btn-lg btn-import-csv" title="<?php echo html_attr($Translation['import csv file']); ?>"><i class="glyphicon glyphicon-th"></i> <?php echo $Translation['import CSV']; ?></a>
					</ul>
				<?php } ?>

				<?php if(getLoggedAdmin() !== false) { ?>
					<ul class="nav navbar-nav">
						<a href="<?php echo PREPEND_PATH; ?>admin/pageHome.php" class="btn btn-danger navbar-btn hidden-xs" title="<?php echo html_attr($Translation['admin area']); ?>"><i class="glyphicon glyphicon-cog"></i> <?php echo $Translation['admin area']; ?></a>
						<a href="<?php echo PREPEND_PATH; ?>admin/pageHome.php" class="btn btn-danger navbar-btn visible-xs btn-lg" title="<?php echo html_attr($Translation['admin area']); ?>"><i class="glyphicon glyphicon-cog"></i> <?php echo $Translation['admin area']; ?></a>
					</ul>
				<?php } ?>

				<?php if(!$_GET['signIn'] && !$_GET['loginFailed']) { ?>
					<?php if(!$mi['username'] || $mi['username'] == $adminConfig['anonymousMember']) { ?>
						<p class="navbar-text navbar-right">&nbsp;</p>
						<a href="<?php echo PREPEND_PATH; ?>index.php?signIn=1" class="btn btn-success navbar-btn navbar-right"><?php echo $Translation['sign in']; ?></a>
						<p class="navbar-text navbar-right">
							<?php echo $Translation['not signed in']; ?>
						</p>
					<?php } else { ?>
						<ul class="nav navbar-nav navbar-right hidden-xs" style="min-width: 330px;">
							<a class="btn navbar-btn btn-default" href="<?php echo PREPEND_PATH; ?>index.php?signOut=1"><i class="glyphicon glyphicon-log-out"></i> <?php echo $Translation['sign out']; ?></a>

							<p class="navbar-text signed-in-as">
								<?php echo $Translation['signed as']; ?> <strong><a href="<?php echo PREPEND_PATH; ?>membership_profile.php" class="navbar-link username"><?php echo $mi['username']; ?></a></strong>
							</p>
						</ul>
						<ul class="nav navbar-nav visible-xs">
							<a class="btn navbar-btn btn-default btn-lg visible-xs" href="<?php echo PREPEND_PATH; ?>index.php?signOut=1"><i class="glyphicon glyphicon-log-out"></i> <?php echo $Translation['sign out']; ?></a>
							<p class="navbar-text text-center signed-in-as">
								<?php echo $Translation['signed as']; ?> <strong><a href="<?php echo PREPEND_PATH; ?>membership_profile.php" class="navbar-link username"><?php echo $mi['username']; ?></a></strong>
							</p>
						</ul>
						<script>
							/* periodically check if user is still signed in */
							setInterval(function() {
								$j.ajax({
									url: '<?php echo PREPEND_PATH; ?>ajax_check_login.php',
									success: function(username) {
										if(!username.length) window.location = '<?php echo PREPEND_PATH; ?>index.php?signIn=1';
									}
								});
							}, 60000);
						</script>
					<?php } ?>
				<?php } ?>

				<p class="navbar-text navbar-right help-shortcuts-launcher-container hidden-xs">
					<img
						class="help-shortcuts-launcher" 
						src="<?php echo PREPEND_PATH; ?>resources/images/keyboard.png" 
						title="<?php echo html_attr($Translation['keyboard shortcuts']); ?>">
				</p>
			</div>
		</nav>
		<?php

		$html = ob_get_contents();
		ob_end_clean();

		return $html;
	}

	#########################################################

	function showNotifications($msg = '', $class = '', $fadeout = true) {
		global $Translation;
		if($error_message = strip_tags($_REQUEST['error_message']))
			$error_message = '<div class="text-bold">' . $error_message . '</div>';

		if(!$msg) { // if no msg, use url to detect message to display
			if($_REQUEST['record-added-ok'] != '') {
				$msg = $Translation['new record saved'];
				$class = 'alert-success';
			} elseif($_REQUEST['record-added-error'] != '') {
				$msg = $Translation['Couldn\'t save the new record'] . $error_message;
				$class = 'alert-danger';
				$fadeout = false;
			} elseif($_REQUEST['record-updated-ok'] != '') {
				$msg = $Translation['record updated'];
				$class = 'alert-success';
			} elseif($_REQUEST['record-updated-error'] != '') {
				$msg = $Translation['Couldn\'t save changes to the record'] . $error_message;
				$class = 'alert-danger';
				$fadeout = false;
			} elseif($_REQUEST['record-deleted-ok'] != '') {
				$msg = $Translation['The record has been deleted successfully'];
				$class = 'alert-success';
			} elseif($_REQUEST['record-deleted-error'] != '') {
				$msg = $Translation['Couldn\'t delete this record'] . $error_message;
				$class = 'alert-danger';
				$fadeout = false;
			} else {
				return '';
			}
		}
		$id = 'notification-' . rand();

		ob_start();
		// notification template
		?>
		<div id="%%ID%%" class="alert alert-dismissable %%CLASS%%" style="opacity: 1; padding-top: 6px; padding-bottom: 6px; animation: fadeIn 1.5s ease-out;">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			%%MSG%%
		</div>
		<script>
			$j(function() {
				var autoDismiss = <?php echo $fadeout ? 'true' : 'false'; ?>,
					embedded = !$j('nav').length,
					messageDelay = 10, fadeDelay = 1.5;

				if(!autoDismiss) {
					if(embedded)
						$j('#%%ID%%').before('<div style="height: 2rem;"></div>');
					else
						$j('#%%ID%%').css({ margin: '0 0 1rem' });

					return;
				}

				// below code runs only in case of autoDismiss

				if(embedded)
					$j('#%%ID%%').css({ margin: '1rem 0 -1rem' });
				else
					$j('#%%ID%%').css({ margin: '-15px 0 -20px' });

				setTimeout(function() {
					$j('#%%ID%%').css({    animation: 'fadeOut ' + fadeDelay + 's ease-out' });
				}, messageDelay * 1000);

				setTimeout(function() {
					$j('#%%ID%%').css({    visibility: 'hidden' });
				}, (messageDelay + fadeDelay) * 1000);
			})
		</script>
		<style>
			@keyframes fadeIn {
				0%   { opacity: 0; }
				100% { opacity: 1; }
			}
			@keyframes fadeOut {
				0%   { opacity: 1; }
				100% { opacity: 0; }
			}
		</style>

		<?php
		$out = ob_get_clean();

		$out = str_replace('%%ID%%', $id, $out);
		$out = str_replace('%%MSG%%', $msg, $out);
		$out = str_replace('%%CLASS%%', $class, $out);

		return $out;
	}

	#########################################################

	function parseMySQLDate($date, $altDate) {
		// is $date valid?
		if(preg_match("/^\d{4}-\d{1,2}-\d{1,2}$/", trim($date))) {
			return trim($date);
		}

		if($date != '--' && preg_match("/^\d{4}-\d{1,2}-\d{1,2}$/", trim($altDate))) {
			return trim($altDate);
		}

		if($date != '--' && $altDate && intval($altDate)==$altDate) {
			return @date('Y-m-d', @time() + ($altDate >= 1 ? $altDate - 1 : $altDate) * 86400);
		}

		return '';
	}

	#########################################################

	function parseCode($code, $isInsert = true, $rawData = false) {
		if($isInsert) {
			$arrCodes = [
				'<%%creatorusername%%>' => $_SESSION['memberID'],
				'<%%creatorgroupid%%>' => $_SESSION['memberGroupID'],
				'<%%creatorip%%>' => $_SERVER['REMOTE_ADDR'],
				'<%%creatorgroup%%>' => sqlValue("SELECT `name` FROM `membership_groups` WHERE `groupID`='{$_SESSION['memberGroupID']}'"),

				'<%%creationdate%%>' => ($rawData ? @date('Y-m-d') : @date('j/n/Y')),
				'<%%creationtime%%>' => ($rawData ? @date('H:i:s') : @date('h:i:s a')),
				'<%%creationdatetime%%>' => ($rawData ? @date('Y-m-d H:i:s') : @date('j/n/Y h:i:s a')),
				'<%%creationtimestamp%%>' => ($rawData ? @date('Y-m-d H:i:s') : @time())
			];
		} else {
			$arrCodes = [
				'<%%editorusername%%>' => $_SESSION['memberID'],
				'<%%editorgroupid%%>' => $_SESSION['memberGroupID'],
				'<%%editorip%%>' => $_SERVER['REMOTE_ADDR'],
				'<%%editorgroup%%>' => sqlValue("SELECT `name` FROM `membership_groups` WHERE `groupID`='{$_SESSION['memberGroupID']}'"),

				'<%%editingdate%%>' => ($rawData ? @date('Y-m-d') : @date('j/n/Y')),
				'<%%editingtime%%>' => ($rawData ? @date('H:i:s') : @date('h:i:s a')),
				'<%%editingdatetime%%>' => ($rawData ? @date('Y-m-d H:i:s') : @date('j/n/Y h:i:s a')),
				'<%%editingtimestamp%%>' => ($rawData ? @date('Y-m-d H:i:s') : @time())
			];
		}

		$pc = str_ireplace(array_keys($arrCodes), array_values($arrCodes), $code);

		return $pc;
	}

	#########################################################

	function addFilter($index, $filterAnd, $filterField, $filterOperator, $filterValue) {
		// validate input
		if($index < 1 || $index > 80 || !is_int($index)) return false;
		if($filterAnd != 'or')   $filterAnd = 'and';
		$filterField = intval($filterField);

		/* backward compatibility */
		if(in_array($filterOperator, $GLOBALS['filter_operators'])) {
			$filterOperator = array_search($filterOperator, $GLOBALS['filter_operators']);
		}

		if(!in_array($filterOperator, array_keys($GLOBALS['filter_operators']))) {
			$filterOperator = 'like';
		}

		if(!$filterField) {
			$filterOperator = '';
			$filterValue = '';
		}

		$_REQUEST['FilterAnd'][$index] = $filterAnd;
		$_REQUEST['FilterField'][$index] = $filterField;
		$_REQUEST['FilterOperator'][$index] = $filterOperator;
		$_REQUEST['FilterValue'][$index] = $filterValue;

		return true;
	}

	#########################################################

	function clearFilters() {
		for($i=1; $i<=80; $i++) {
			addFilter($i, '', 0, '', '');
		}
	}

	#########################################################

	if(!function_exists('str_ireplace')) {
		function str_ireplace($search, $replace, $subject) {
			$ret=$subject;
			if(is_array($search)) {
				for($i=0; $i<count($search); $i++) {
					$ret=str_ireplace($search[$i], $replace[$i], $ret);
				}
			} else {
				$ret=preg_replace('/'.preg_quote($search, '/').'/i', $replace, $ret);
			}

			return $ret;
		} 
	} 

	#########################################################

	/**
	* Loads a given view from the templates folder, passing the given data to it
	* @param $view the name of a php file (without extension) to be loaded from the 'templates' folder
	* @param $the_data_to_pass_to_the_view (optional) associative array containing the data to pass to the view
	* @return the output of the parsed view as a string
	*/
	function loadView($view, $the_data_to_pass_to_the_view=false) {
		global $Translation;

		$view = dirname(__FILE__)."/templates/$view.php";
		if(!is_file($view)) return false;

		if(is_array($the_data_to_pass_to_the_view)) {
			foreach($the_data_to_pass_to_the_view as $k => $v)
				$$k = $v;
		}
		unset($the_data_to_pass_to_the_view, $k, $v);

		ob_start();
		@include($view);
		$out=ob_get_contents();
		ob_end_clean();

		return $out;
	}

	#########################################################

	/**
	* Loads a table template from the templates folder, passing the given data to it
	* @param $table_name the name of the table whose template is to be loaded from the 'templates' folder
	* @param $the_data_to_pass_to_the_table associative array containing the data to pass to the table template
	* @return the output of the parsed table template as a string
	*/
	function loadTable($table_name, $the_data_to_pass_to_the_table = []) {
		$dont_load_header = $the_data_to_pass_to_the_table['dont_load_header'];
		$dont_load_footer = $the_data_to_pass_to_the_table['dont_load_footer'];

		$header = $table = $footer = '';

		if(!$dont_load_header) {
			// try to load tablename-header
			if(!($header = loadView("{$table_name}-header", $the_data_to_pass_to_the_table))) {
				$header = loadView('table-common-header', $the_data_to_pass_to_the_table);
			}
		}

		$table = loadView($table_name, $the_data_to_pass_to_the_table);

		if(!$dont_load_footer) {
			// try to load tablename-footer
			if(!($footer = loadView("{$table_name}-footer", $the_data_to_pass_to_the_table))) {
				$footer = loadView('table-common-footer', $the_data_to_pass_to_the_table);
			}
		}

		return "{$header}{$table}{$footer}";
	}

	#########################################################

	function filterDropdownBy($filterable, $filterers, $parentFilterers, $parentPKField, $parentCaption, $parentTable, &$filterableCombo) {
		$filterersArray = explode(',', $filterers);
		$parentFilterersArray = explode(',', $parentFilterers);
		$parentFiltererList = '`' . implode('`, `', $parentFilterersArray) . '`';
		$res=sql("SELECT `$parentPKField`, $parentCaption, $parentFiltererList FROM `$parentTable` ORDER BY 2", $eo);
		$filterableData = [];
		while($row=db_fetch_row($res)) {
			$filterableData[$row[0]] = $row[1];
			$filtererIndex = 0;
			foreach($filterersArray as $filterer) {
				$filterableDataByFilterer[$filterer][$row[$filtererIndex + 2]][$row[0]] = $row[1];
				$filtererIndex++;
			}
			$row[0] = addslashes($row[0]);
			$row[1] = addslashes($row[1]);
			$jsonFilterableData .= "\"{$row[0]}\":\"{$row[1]}\",";
		}
		$jsonFilterableData .= '}';
		$jsonFilterableData = '{'.str_replace(',}', '}', $jsonFilterableData);     
		$filterJS = "\nvar {$filterable}_data = $jsonFilterableData;";

		foreach($filterersArray as $filterer) {
			if(is_array($filterableDataByFilterer[$filterer])) foreach($filterableDataByFilterer[$filterer] as $filtererItem => $filterableItem) {
				$jsonFilterableDataByFilterer[$filterer] .= '"'.addslashes($filtererItem).'":{';
				foreach($filterableItem as $filterableItemID => $filterableItemData) {
					$jsonFilterableDataByFilterer[$filterer] .= '"'.addslashes($filterableItemID).'":"'.addslashes($filterableItemData).'",';
				}
				$jsonFilterableDataByFilterer[$filterer] .= '},';
			}
			$jsonFilterableDataByFilterer[$filterer] .= '}';
			$jsonFilterableDataByFilterer[$filterer] = '{'.str_replace(',}', '}', $jsonFilterableDataByFilterer[$filterer]);

			$filterJS.="\n\n// code for filtering {$filterable} by {$filterer}\n";
			$filterJS.="\nvar {$filterable}_data_by_{$filterer} = {$jsonFilterableDataByFilterer[$filterer]}; ";
			$filterJS.="\nvar selected_{$filterable} = \$j('#{$filterable}').val();";
			$filterJS.="\nvar {$filterable}_change_by_{$filterer} = function() {";
			$filterJS.="\n\t$('{$filterable}').options.length=0;";
			$filterJS.="\n\t$('{$filterable}').options[0] = new Option();";
			$filterJS.="\n\tif(\$j('#{$filterer}').val()) {";
			$filterJS.="\n\t\tfor({$filterable}_item in {$filterable}_data_by_{$filterer}[\$j('#{$filterer}').val()]) {";
			$filterJS.="\n\t\t\t$('{$filterable}').options[$('{$filterable}').options.length] = new Option(";
			$filterJS.="\n\t\t\t\t{$filterable}_data_by_{$filterer}[\$j('#{$filterer}').val()][{$filterable}_item],";
			$filterJS.="\n\t\t\t\t{$filterable}_item,";
			$filterJS.="\n\t\t\t\t({$filterable}_item == selected_{$filterable} ? true : false),";
			$filterJS.="\n\t\t\t\t({$filterable}_item == selected_{$filterable} ? true : false)";
			$filterJS.="\n\t\t\t);";
			$filterJS.="\n\t\t}";
			$filterJS.="\n\t} else {";
			$filterJS.="\n\t\tfor({$filterable}_item in {$filterable}_data) {";
			$filterJS.="\n\t\t\t$('{$filterable}').options[$('{$filterable}').options.length] = new Option(";
			$filterJS.="\n\t\t\t\t{$filterable}_data[{$filterable}_item],";
			$filterJS.="\n\t\t\t\t{$filterable}_item,";
			$filterJS.="\n\t\t\t\t({$filterable}_item == selected_{$filterable} ? true : false),";
			$filterJS.="\n\t\t\t\t({$filterable}_item == selected_{$filterable} ? true : false)";
			$filterJS.="\n\t\t\t);";
			$filterJS.="\n\t\t}";
			$filterJS.="\n\t\tif(selected_{$filterable} && selected_{$filterable} == \$j('#{$filterable}').val()) {";
			$filterJS.="\n\t\t\tfor({$filterer}_item in {$filterable}_data_by_{$filterer}) {";
			$filterJS.="\n\t\t\t\tfor({$filterable}_item in {$filterable}_data_by_{$filterer}[{$filterer}_item]) {";
			$filterJS.="\n\t\t\t\t\tif({$filterable}_item == selected_{$filterable}) {";
			$filterJS.="\n\t\t\t\t\t\t$('{$filterer}').value = {$filterer}_item;";
			$filterJS.="\n\t\t\t\t\t\tbreak;";
			$filterJS.="\n\t\t\t\t\t}";
			$filterJS.="\n\t\t\t\t}";
			$filterJS.="\n\t\t\t\tif({$filterable}_item == selected_{$filterable}) break;";
			$filterJS.="\n\t\t\t}";
			$filterJS.="\n\t\t}";
			$filterJS.="\n\t}";
			$filterJS.="\n\t$('{$filterable}').highlight();";
			$filterJS.="\n};";
			$filterJS.="\n$('{$filterer}').observe('change', function() { window.setTimeout({$filterable}_change_by_{$filterer}, 25); });";
			$filterJS.="\n";
		}

		$filterableCombo = new Combo;
		$filterableCombo->ListType = 0;
		$filterableCombo->ListItem = array_slice(array_values($filterableData), 0, 10);
		$filterableCombo->ListData = array_slice(array_keys($filterableData), 0, 10);
		$filterableCombo->SelectName = $filterable;
		$filterableCombo->AllowNull = true;

		return $filterJS;
	}

	#########################################################
	function br2nl($text) {
		return  preg_replace('/\<br(\s*)?\/?\>/i', "\n", $text);
	}

	#########################################################

	if(!function_exists('htmlspecialchars_decode')) {
		function htmlspecialchars_decode($string, $quote_style = ENT_COMPAT) {
			return strtr($string, array_flip(get_html_translation_table(HTML_SPECIALCHARS, $quote_style)));
		}
	}

	#########################################################

	function entitiesToUTF8($input) {
		return preg_replace_callback('/(&#[0-9]+;)/', '_toUTF8', $input);
	}

	function _toUTF8($m) {
		if(function_exists('mb_convert_encoding')) {
			return mb_convert_encoding($m[1], "UTF-8", "HTML-ENTITIES");
		} else {
			return $m[1];
		}
	}

	#########################################################

	function func_get_args_byref() {
		if(!function_exists('debug_backtrace')) return false;

		$trace = debug_backtrace();
		return $trace[1]['args'];
	}

	#########################################################

	function permissions_sql($table, $level = 'all') {
		if(!in_array($level, ['user', 'group'])) { $level = 'all'; }
		$perm = getTablePermissions($table);
		$from = '';
		$where = '';
		$pk = getPKFieldName($table);

		if($perm['view'] == 1 || ($perm['view'] > 1 && $level == 'user')) { // view owner only
			$from = 'membership_userrecords';
			$where = "(`$table`.`$pk`=membership_userrecords.pkValue and membership_userrecords.tableName='$table' and lcase(membership_userrecords.memberID)='" . getLoggedMemberID() . "')";
		} elseif($perm['view'] == 2 || ($perm['view'] > 2 && $level == 'group')) { // view group only
			$from = 'membership_userrecords';
			$where = "(`$table`.`$pk`=membership_userrecords.pkValue and membership_userrecords.tableName='$table' and membership_userrecords.groupID='" . getLoggedGroupID() . "')";
		} elseif($perm['view'] == 3) { // view all
			// no further action
		} elseif($perm['view'] == 0) { // view none
			return false;
		}

		return ['where' => $where, 'from' => $from, 0 => $where, 1 => $from];
	}

	#########################################################

	function error_message($msg, $back_url = '', $full_page = true) {
		$curr_dir = dirname(__FILE__);
		global $Translation;

		ob_start();

		if($full_page) include($curr_dir . '/header.php');

		echo '<div class="panel panel-danger">';
			echo '<div class="panel-heading"><h3 class="panel-title">' . $Translation['error:'] . '</h3></div>';
			echo '<div class="panel-body"><p class="text-danger">' . $msg . '</p>';
			if($back_url !== false) { // explicitly passing false suppresses the back link completely
				echo '<div class="text-center">';
				if($back_url) {
					echo '<a href="' . $back_url . '" class="btn btn-danger btn-lg vspacer-lg"><i class="glyphicon glyphicon-chevron-left"></i> ' . $Translation['< back'] . '</a>';
				} else {
					echo '<a href="#" class="btn btn-danger btn-lg vspacer-lg" onclick="history.go(-1); return false;"><i class="glyphicon glyphicon-chevron-left"></i> ' . $Translation['< back'] . '</a>';
				}
				echo '</div>';
			}
			echo '</div>';
		echo '</div>';

		if($full_page) include($curr_dir . '/footer.php');

		return ob_get_clean();
	}

	#########################################################

	function toMySQLDate($formattedDate, $sep = datalist_date_separator, $ord = datalist_date_format) {
		// extract date elements
		$de=explode($sep, $formattedDate);
		$mySQLDate=intval($de[strpos($ord, 'Y')]).'-'.intval($de[strpos($ord, 'm')]).'-'.intval($de[strpos($ord, 'd')]);
		return $mySQLDate;
	}

	#########################################################

	function reIndex(&$arr) {
		$i=1;
		foreach($arr as $n=>$v) {
			$arr2[$i]=$n;
			$i++;
		}
		return $arr2;
	}

	#########################################################

	function get_embed($provider, $url, $max_width = '', $max_height = '', $retrieve = 'html') {
		global $Translation;
		if(!$url) return '';

		$providers = [
			'youtube' => ['oembed' => 'https://www.youtube.com/oembed?'],
			'googlemap' => ['oembed' => '', 'regex' => '/^http.*\.google\..*maps/i'],
		];

		if(!isset($providers[$provider])) {
			return '<div class="text-danger">' . $Translation['invalid provider'] . '</div>';
		}

		if(isset($providers[$provider]['regex']) && !preg_match($providers[$provider]['regex'], $url)) {
			return '<div class="text-danger">' . $Translation['invalid url'] . '</div>';
		}

		if($providers[$provider]['oembed']) {
			$oembed = $providers[$provider]['oembed'] . 'url=' . urlencode($url) . "&amp;maxwidth={$max_width}&amp;maxheight={$max_height}&amp;format=json";
			$data_json = request_cache($oembed);

			$data = json_decode($data_json, true);
			if($data === null) {
				/* an error was returned rather than a json string */
				if($retrieve == 'html') return "<div class=\"text-danger\">{$data_json}\n<!-- {$oembed} --></div>";
				return '';
			}

			return (isset($data[$retrieve]) ? $data[$retrieve] : $data['html']);
		}

		/* special cases (where there is no oEmbed provider) */
		if($provider == 'googlemap') return get_embed_googlemap($url, $max_width, $max_height, $retrieve);

		return '<div class="text-danger">Invalid provider!</div>';
	}

	#########################################################

	function get_embed_googlemap($url, $max_width = '', $max_height = '', $retrieve = 'html') {
		global $Translation;
		$url_parts = parse_url($url);
		$coords_regex = '/-?\d+(\.\d+)?[,+]-?\d+(\.\d+)?(,\d{1,2}z)?/'; /* https://stackoverflow.com/questions/2660201 */

		if(preg_match($coords_regex, $url_parts['path'] . '?' . $url_parts['query'], $m)) {
			list($lat, $long, $zoom) = explode(',', $m[0]);
			$zoom = intval($zoom);
			if(!$zoom) $zoom = 10; /* default zoom */
			if(!$max_height) $max_height = 360;
			if(!$max_width) $max_width = 480;

			$api_key = config('adminConfig')['googleAPIKey'];
			$embed_url = "https://www.google.com/maps/embed/v1/view?key={$api_key}&amp;center={$lat},{$long}&amp;zoom={$zoom}&amp;maptype=roadmap";
			$thumbnail_url = "https://maps.googleapis.com/maps/api/staticmap?key={$api_key}&amp;center={$lat},{$long}&amp;zoom={$zoom}&amp;maptype=roadmap&amp;size={$max_width}x{$max_height}";

			if($retrieve == 'html') {
				return "<iframe width=\"{$max_width}\" height=\"{$max_height}\" frameborder=\"0\" style=\"border:0\" src=\"{$embed_url}\"></iframe>";
			} else {
				return $thumbnail_url;
			}
		} else {
			return '<div class="text-danger">' . $Translation['cant retrieve coordinates from url'] . '</div>';
		}
	}

	#########################################################

	function request_cache($request, $force_fetch = false) {
		$max_cache_lifetime = 7 * 86400; /* max cache lifetime in seconds before refreshing from source */

		/* membership_cache table exists? if not, create it */
		static $cache_table_exists = false;
		if(!$cache_table_exists && !$force_fetch) {
			$te = sqlValue("show tables like 'membership_cache'");
			if(!$te) {
				if(!sql("CREATE TABLE `membership_cache` (`request` VARCHAR(100) NOT NULL, `request_ts` INT, `response` TEXT NOT NULL, PRIMARY KEY (`request`))", $eo)) {
					/* table can't be created, so force fetching request */
					return request_cache($request, true);
				}
			}
			$cache_table_exists = true;
		}

		/* retrieve response from cache if exists */
		if(!$force_fetch) {
			$res = sql("select response, request_ts from membership_cache where request='" . md5($request) . "'", $eo);
			if(!$row = db_fetch_array($res)) return request_cache($request, true);

			$response = $row[0];
			$response_ts = $row[1];
			if($response_ts < time() - $max_cache_lifetime) return request_cache($request, true);
		}

		/* if no response in cache, issue a request */
		if(!$response || $force_fetch) {
			$response = @file_get_contents($request);
			if($response === false) {
				$error = error_get_last();
				$error_message = preg_replace('/.*: (.*)/', '$1', $error['message']);
				return $error_message;
			} elseif($cache_table_exists) {
				/* store response in cache */
				$ts = time();
				sql("replace into membership_cache set request='" . md5($request) . "', request_ts='{$ts}', response='" . makeSafe($response, false) . "'", $eo);
			}
		}

		return $response;
	}

	#########################################################

	function check_record_permission($table, $id, $perm = 'view') {
		if($perm != 'edit' && $perm != 'delete') $perm = 'view';

		$perms = getTablePermissions($table);
		if(!$perms[$perm]) return false;

		$safe_id = makeSafe($id);
		$safe_table = makeSafe($table);

		if($perms[$perm] == 1) { // own records only
			$username = getLoggedMemberID();
			$owner = sqlValue("select memberID from membership_userrecords where tableName='{$safe_table}' and pkValue='{$safe_id}'");
			if($owner == $username) return true;
		} elseif($perms[$perm] == 2) { // group records
			$group_id = getLoggedGroupID();
			$owner_group_id = sqlValue("select groupID from membership_userrecords where tableName='{$safe_table}' and pkValue='{$safe_id}'");
			if($owner_group_id == $group_id) return true;
		} elseif($perms[$perm] == 3) { // all records
			return true;
		}

		return false;
	}

	#########################################################

	function NavMenus($options = []) {
		if(!defined('PREPEND_PATH')) define('PREPEND_PATH', '');
		global $Translation;
		$prepend_path = PREPEND_PATH;

		/* default options */
		if(empty($options)) {
			$options = ['tabs' => 7];
		}

		$table_group_name = array_keys(get_table_groups()); /* 0 => group1, 1 => group2 .. */
		/* if only one group named 'None', set to translation of 'select a table' */
		if((count($table_group_name) == 1 && $table_group_name[0] == 'None') || count($table_group_name) < 1) $table_group_name[0] = $Translation['select a table'];
		$table_group_index = array_flip($table_group_name); /* group1 => 0, group2 => 1 .. */
		$menu = array_fill(0, count($table_group_name), '');

		$t = time();
		$arrTables = getTableList();
		if(is_array($arrTables)) {
			foreach($arrTables as $tn => $tc) {
				/* ---- list of tables where hide link in nav menu is set ---- */
				$tChkHL = array_search($tn, ['marcas','accesorios','financiero','financiero_mobiliario','dispo_detalles_tecnicos','ubicacion_articulo','ubicacion_mobiliario']);

				/* ---- list of tables where filter first is set ---- */
				$tChkFF = array_search($tn, []);
				if($tChkFF !== false && $tChkFF !== null) {
					$searchFirst = '&Filter_x=1';
				} else {
					$searchFirst = '';
				}

				/* when no groups defined, $table_group_index['None'] is NULL, so $menu_index is still set to 0 */
				$menu_index = intval($table_group_index[$tc[3]]);
				if(!$tChkHL && $tChkHL !== 0) $menu[$menu_index] .= "<li><a href=\"{$prepend_path}{$tn}_view.php?t={$t}{$searchFirst}\"><img src=\"{$prepend_path}" . ($tc[2] ? $tc[2] : 'blank.gif') . "\" height=\"32\"> {$tc[0]}</a></li>";
			}
		}

		// custom nav links, as defined in "hooks/links-navmenu.php" 
		global $navLinks;
		if(is_array($navLinks)) {
			$memberInfo = getMemberInfo();
			$links_added = [];
			foreach($navLinks as $link) {
				if(!isset($link['url']) || !isset($link['title'])) continue;
				if(getLoggedAdmin() !== false || @in_array($memberInfo['group'], $link['groups']) || @in_array('*', $link['groups'])) {
					$menu_index = intval($link['table_group']);
					if(!$links_added[$menu_index]) $menu[$menu_index] .= '<li class="divider"></li>';

					/* add prepend_path to custom links if they aren't absolute links */
					if(!preg_match('/^(http|\/\/)/i', $link['url'])) $link['url'] = $prepend_path . $link['url'];
					if(!preg_match('/^(http|\/\/)/i', $link['icon']) && $link['icon']) $link['icon'] = $prepend_path . $link['icon'];

					$menu[$menu_index] .= "<li><a href=\"{$link['url']}\"><img src=\"" . ($link['icon'] ? $link['icon'] : "{$prepend_path}blank.gif") . "\" height=\"32\"> {$link['title']}</a></li>";
					$links_added[$menu_index]++;
				}
			}
		}

		$menu_wrapper = '';
		for($i = 0; $i < count($menu); $i++) {
			$menu_wrapper .= <<<EOT
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">{$table_group_name[$i]} <b class="caret"></b></a>
					<ul class="dropdown-menu" role="menu">{$menu[$i]}</ul>
				</li>
EOT;
		}

		return $menu_wrapper;
	}

	#########################################################

	function StyleSheet() {
		if(!defined('PREPEND_PATH')) define('PREPEND_PATH', '');
		$prepend_path = PREPEND_PATH;

		$css_links = <<<EOT

			<link rel="stylesheet" href="{$prepend_path}resources/initializr/css/bootstrap.css">
			<link rel="stylesheet" href="{$prepend_path}resources/lightbox/css/lightbox.css" media="screen">
			<link rel="stylesheet" href="{$prepend_path}resources/select2/select2.css" media="screen">
			<link rel="stylesheet" href="{$prepend_path}resources/timepicker/bootstrap-timepicker.min.css" media="screen">
			<link rel="stylesheet" href="{$prepend_path}dynamic.css">
EOT;

		return $css_links;
	}

	#########################################################

	function PrepareUploadedFile($FieldName, $MaxSize, $FileTypes = 'jpg|jpeg|gif|png', $NoRename = false, $dir = '') {
		global $Translation;
		$f = $_FILES[$FieldName];
		if($f['error'] == 4 || !$f['name']) return '';

		$dir = getUploadDir($dir);

		/* get php.ini upload_max_filesize in bytes */
		$php_upload_size_limit = trim(ini_get('upload_max_filesize'));
		$last = strtolower($php_upload_size_limit[strlen($php_upload_size_limit) - 1]);
		switch($last) {
			case 'g':
				$php_upload_size_limit *= 1024;
			case 'm':
				$php_upload_size_limit *= 1024;
			case 'k':
				$php_upload_size_limit *= 1024;
		}

		$MaxSize = min($MaxSize, $php_upload_size_limit);

		if($f['size'] > $MaxSize || $f['error']) {
			echo error_message(str_replace(['<MaxSize>', '{MaxSize}'], intval($MaxSize / 1024), $Translation['file too large']));
			exit;
		}
		if(!preg_match('/\.(' . $FileTypes . ')$/i', $f['name'], $ft)) {
			echo error_message(str_replace(['<FileTypes>', '{FileTypes}'], str_replace('|', ', ', $FileTypes), $Translation['invalid file type']));
			exit;
		}

		$name = str_replace(' ', '_', $f['name']);
		if(!$NoRename) $name = substr(md5(microtime() . rand(0, 100000)), -17) . $ft[0];

		if(!file_exists($dir)) @mkdir($dir, 0777);

		if(!@move_uploaded_file($f['tmp_name'], $dir . $name)) {
			echo error_message("Couldn't save the uploaded file. Try chmoding the upload folder '{$dir}' to 777.");
			exit;
		}

		@chmod($dir . $name, 0666);
		return $name;
	}

	#########################################################

	function get_home_links($homeLinks, $default_classes, $tgroup = '') {
		if(!is_array($homeLinks) || !count($homeLinks)) return '';

		$memberInfo = getMemberInfo();

		ob_start();
		foreach($homeLinks as $link) {
			if(!isset($link['url']) || !isset($link['title'])) continue;
			if($tgroup != $link['table_group'] && $tgroup != '*') continue;

			/* fall-back classes if none defined */
			if(!$link['grid_column_classes']) $link['grid_column_classes'] = $default_classes['grid_column'];
			if(!$link['panel_classes']) $link['panel_classes'] = $default_classes['panel'];
			if(!$link['link_classes']) $link['link_classes'] = $default_classes['link'];

			if(getLoggedAdmin() !== false || @in_array($memberInfo['group'], $link['groups']) || @in_array('*', $link['groups'])) {
				?>
				<div class="col-xs-12 <?php echo $link['grid_column_classes']; ?>">
					<div class="panel <?php echo $link['panel_classes']; ?>">
						<div class="panel-body">
							<a class="btn btn-block btn-lg <?php echo $link['link_classes']; ?>" title="<?php echo preg_replace("/&amp;(#[0-9]+|[a-z]+);/i", "&$1;", html_attr(strip_tags($link['description']))); ?>" href="<?php echo $link['url']; ?>"><?php echo ($link['icon'] ? '<img src="' . $link['icon'] . '">' : ''); ?><strong><?php echo $link['title']; ?></strong></a>
							<div class="panel-body-description"><?php echo $link['description']; ?></div>
						</div>
					</div>
				</div>
				<?php
			}
		}

		$html = ob_get_contents();
		ob_end_clean();

		return $html;
	}

	#########################################################

	function quick_search_html($search_term, $label, $separate_dv = true) {
		global $Translation;

		$safe_search = html_attr($search_term);
		$safe_label = html_attr($label);
		$safe_clear_label = html_attr($Translation['Reset Filters']);

		if($separate_dv) {
			$reset_selection = "document.myform.SelectedID.value = '';";
		} else {
			$reset_selection = "document.myform.writeAttribute('novalidate', 'novalidate');";
		}
		$reset_selection .= ' document.myform.NoDV.value=1; return true;';

		$html = <<<EOT
		<div class="input-group" id="quick-search">
			<input type="text" id="SearchString" name="SearchString" value="{$safe_search}" class="form-control" placeholder="{$safe_label}">
			<span class="input-group-btn">
				<button name="Search_x" value="1" id="Search" type="submit" onClick="{$reset_selection}" class="btn btn-default" title="{$safe_label}"><i class="glyphicon glyphicon-search"></i></button>
				<button name="ClearQuickSearch" value="1" id="ClearQuickSearch" type="submit" onClick="\$j('#SearchString').val(''); {$reset_selection}" class="btn btn-default" title="{$safe_clear_label}"><i class="glyphicon glyphicon-remove-circle"></i></button>
			</span>
		</div>
EOT;
		return $html;
	}

	#########################################################

