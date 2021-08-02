<?php
	########################################################################
	/*
	~~~~~~ LIST OF FUNCTIONS ~~~~~~
		set_headers() -- sets HTTP headers (encoding, same-origin frame policy, .. etc)
		getTableList() -- returns an associative array of all tables in this application in the format tableName=>tableCaption
		getThumbnailSpecs($tableName, $fieldName, $view) -- returns an associative array specifying the width, height and identifier of the thumbnail file.
		createThumbnail($img, $specs) -- $specs is an array as returned by getThumbnailSpecs(). Returns true on success, false on failure.
		makeSafe($string)
		checkPermissionVal($pvn)
		sql($statement, $o)
		sqlValue($statement)
		getLoggedAdmin()
		checkUser($username, $password)
		logOutUser()
		getPKFieldName($tn)
		getCSVData($tn, $pkValue, $stripTag=true)
		errorMsg($msg)
		redirect($URL, $absolute=FALSE)
		htmlRadioGroup($name, $arrValue, $arrCaption, $selectedValue, $selClass="", $class="", $separator="<br>")
		htmlSelect($name, $arrValue, $arrCaption, $selectedValue, $class="", $selectedClass="")
		htmlSQLSelect($name, $sql, $selectedValue, $class="", $selectedClass="")
		isEmail($email) -- returns $email if valid or false otherwise.
		notifyMemberApproval($memberID) -- send an email to member acknowledging his approval by admin, returns false if no mail is sent
		setupMembership() -- check if membership tables exist or not. If not, create them.
		thisOr($this_val, $or) -- return $this_val if it has a value, or $or if not.
		getUploadedFile($FieldName, $MaxSize=0, $FileTypes='csv|txt', $NoRename=false, $dir='')
		toBytes($val)
		convertLegacyOptions($CSVList)
		getValueGivenCaption($query, $caption)
		time24($t) -- return time in 24h format
		time12($t) -- return time in 12h format
		application_url($page) -- return absolute URL of provided page
		is_ajax() -- return true if this is an ajax request, false otherwise
		array_trim($arr) -- recursively trim provided value/array
		is_allowed_username($username, $exception = false) -- returns username if valid and unique, or false otherwise (if exception is provided and same as username, no uniqueness check is performed)
		csrf_token($validate) -- csrf-proof a form
		get_plugins() -- scans for installed plugins and returns them in an array ('name', 'title', 'icon' or 'glyphicon', 'admin_path')
		maintenance_mode($new_status = '') -- retrieves (and optionally sets) maintenance mode status
		html_attr($str) -- prepare $str to be placed inside an HTML attribute
		html_attr_tags_ok($str) -- same as html_attr, but allowing HTML tags
		Notification() -- class for providing a standardized html notifications functionality
		sendmail($mail) -- sends an email using PHPMailer as specified in the assoc array $mail( ['to', 'name', 'subject', 'message', 'debug'] ) and returns true on success or an error message on failure
		safe_html($str, $noBr = false) -- sanitize HTML strings, and apply nl2br() to non-HTML ones (unless optional 2nd param is passed as true)
		get_tables_info($skip_authentication = false) -- retrieves table properties as a 2D assoc array ['table_name' => ['prop1' => 'val', ..], ..]
		getLoggedMemberID() -- returns memberID of logged member. If no login, returns anonymous memberID
		getLoggedGroupID() -- returns groupID of logged member, or anonymous groupID
		getMemberInfo() -- returns an array containing the currently signed-in member's info
		get_group_id($user = '') -- returns groupID of given user, or current one if empty
		prepare_sql_set($set_array, $glue = ', ') -- Prepares data for a SET or WHERE clause, to be used in an INSERT/UPDATE query
		insert($tn, $set_array) -- Inserts a record specified by $set_array to the given table $tn
		update($tn, $set_array, $where_array) -- Updates a record identified by $where_array to date specified by $set_array in the given table $tn
		set_record_owner($tn, $pk, $user) -- Set/update the owner of given record
		app_datetime_format($destination = 'php', $datetime = 'd') -- get date/time format string for use with one of these: 'php' (see date function), 'mysql', 'moment'. $datetime: 'd' = date, 't' = time, 'dt' = both
		mysql_datetime($app_datetime) -- converts $app_datetime to mysql-formatted datetime, 'yyyy-mm-dd H:i:s', or empty string on error
		app_datetime($mysql_datetime, $datetime = 'd') -- converts $mysql_datetime to app-formatted datetime (if 2nd param is 'dt'), or empty string on error
		to_utf8($str) -- converts string from app-configured encoding to utf8
		from_utf8($str) -- converts string from utf8 to app-configured encoding
		membership_table_functions() -- returns a list of update_membership_* functions
		configure_anonymous_group() -- sets up anonymous group and guest user if necessary
		configure_admin_group() -- sets up admins group and super admin user if necessary
		get_table_keys($tn) -- returns keys (indexes) of given table
		get_table_fields($tn) -- returns fields spec for given table
		update_membership_{tn}() -- sets up membership table tn and its indexes if necessary
		test($subject, $test) -- perform a test and return results
		invoke_method($object, $methodName, $param_array) -- invoke a private/protected method of a given object
		invoke_static_method($class, $methodName, $param_array) -- invoke a private/protected method of a given class statically
		get_parent_tables($tn) -- returns parents of given table: ['parent table' => [main lookup fields in child], ..]
		backtick_keys_once($data) -- wraps keys of given array with backticks ` if not already wrapped. Useful for use with fieldnames passed to update() and insert()
		calculated_fields() -- returns calculated fields config array: [table => [field => query, ..], ..]
		update_calc_fields($table, $id, $formulas, $mi = false) -- updates record of given $id in given $table according to given $formulas on behalf of user specified in given info array (or current user if false)
		latest_jquery() -- detects and returns the name of the latest jQuery file found in resources/jquery/js
		existing_value($tn, $fn, $id, $cache = true) -- returns (cached) value of field $fn of record having $id in table $tn. Set $cache to false to bypass caching.
		checkAppRequirements() -- if PHP doesn't meet app requirements, outputs error and exits
		getRecord($table, $id) -- return the record having a PK of $id from $table as an associative array, falsy value on error/not found
		guessMySQLDateTime($dt) -- if $dt is not already a mysql date/datetime, use mysql_datetime() to convert then return mysql date/datetime. Returns false if $dt invalid or couldn't be detected.
		pkGivenLookupText($val, $tn, $lookupField, $falseIfNotFound) -- returns corresponding PK value for given $val which is the textual lookup value for given $lookupField in given $tn table. If $val has no corresponding PK value, $val is returned as-is, unless $falseIfNotFound is set to true, in which case false is returned.
		userCanImport() -- returns true if user (or his group) can import CSV files (through the permission set in the group page in the admin area).
		bgStyleToClass($html) -- replaces bg color 'style' attr with a class to prevent style loss on xss cleanup.
		assocArrFilter($arr, $func) -- filters provided array using provided callback function. The callback receives 2 params ($key, $value) and should return a boolean.
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
	*/
	########################################################################
	function set_headers() {
		@header('Content-Type: text/html; charset=' . datalist_db_encoding);
		@header('X-Frame-Options: SAMEORIGIN'); // prevent iframing by other sites to prevent clickjacking
	}
	########################################################################
	function get_tables_info($skip_authentication = false) {
		static $all_tables = [], $accessible_tables = [];

		/* return cached results, if found */
		if(($skip_authentication || getLoggedAdmin()) && count($all_tables)) return $all_tables;
		if(!$skip_authentication && count($accessible_tables)) return $accessible_tables;

		/* table groups */
		$tg = array(
			'BIOMEDICOS',
			'ARTICULOS',
			'INVENTARIO',
			'PERSONAS',
			'TIPOS',
			'COMPRAS',
			'CONFIG'
		);

		$all_tables = array(
			/* ['table_name' => [table props assoc array] */   
				'dispositivos' => array(
					'Caption' => 'Dispositivos Biomedicos',
					'Description' => 'Dispositivos digitales biomedicos y accesorios dentro de la unidad<br><br>Ingrese el NUMERO del codigo sin prefijo segun corresponda<br><br>HOLTER (101 - 200)<br>ECOGRAFOS (201 - 229)<br>TERMOHIGROMETROS (230 - 250)<br>TRANSDUCTORES (251 - 300)<br>ECG (301 - 319)<br>BASCULAS (320 - 350)<br>CABLES (351 - 400)<br>DIGITALIZADORES (401 - 450)<br>DESFIBRILADORES (451 - 500)<br>BOMBAS DE INFUSION (501 - 525)<br>APIRADORES (526 - 549)<br>MAPAS (550 - 600)<br>COMPUTADORES (601 - 700)<br>BANDA TROTADORA (701 - 730)<br>TERMOMETROS (731 - 750)<br>STRESS TEST (751 - 780)<br>REGULADORES DE O2 (781 - 800)<br>DISPONIBLE (801 - 999)',
					'tableIcon' => 'resources/table_icons/application_view_icons.png',
					'group' => $tg[0],
					'homepageShowCount' => 0
				),
				'mobiliario' => array(
					'Caption' => 'Mobiliario',
					'Description' => 'Inventario del mobiliario para cada unidad',
					'tableIcon' => 'resources/table_icons/brick_add.png',
					'group' => $tg[1],
					'homepageShowCount' => 1
				),
				'contactos' => array(
					'Caption' => 'Contactos',
					'Description' => 'Proveedores, Clientes, Socios y Apoyo',
					'tableIcon' => 'resources/table_icons/ceo.png',
					'group' => $tg[3],
					'homepageShowCount' => 0
				),
				'contactos_tipo_contacto' => array(
					'Caption' => 'Tipo de contacto',
					'Description' => '',
					'tableIcon' => 'resources/table_icons/cog_add.png',
					'group' => $tg[4],
					'homepageShowCount' => 0
				),
				'movimientos' => array(
					'Caption' => 'Movimientos',
					'Description' => 'Registro de movimientos de dispositivos',
					'tableIcon' => 'resources/table_icons/arrow_branch.png',
					'group' => $tg[0],
					'homepageShowCount' => 0
				),
				'documentos' => array(
					'Caption' => 'Documentos del dispositivo',
					'Description' => 'Carga de documentos por dispositivo',
					'tableIcon' => 'resources/table_icons/page_add.png',
					'group' => $tg[0],
					'homepageShowCount' => 0
				),
				'mantenimientos' => array(
					'Caption' => 'Mantenimientos',
					'Description' => 'Registro de mantenimientos a equipos biomedicos',
					'tableIcon' => 'resources/table_icons/book_add.png',
					'group' => $tg[0],
					'homepageShowCount' => 0
				),
				'calibraciones' => array(
					'Caption' => 'Calibraciones',
					'Description' => 'Registro de calibraciones a equipos biomedicos',
					'tableIcon' => 'resources/table_icons/document_next.png',
					'group' => $tg[0],
					'homepageShowCount' => 0
				),
				'unidades' => array(
					'Caption' => 'Unidades Medicas',
					'Description' => 'Informacion de las unidades medicas',
					'tableIcon' => 'resources/table_icons/building_add.png',
					'group' => $tg[2],
					'homepageShowCount' => 0
				),
				'marcas' => array(
					'Caption' => 'Marcas',
					'Description' => '',
					'tableIcon' => 'resources/table_icons/ebay.png',
					'group' => $tg[2],
					'homepageShowCount' => 0
				),
				'marca_modelo' => array(
					'Caption' => 'Marca y Modelo',
					'Description' => 'Marca y Modelo del dispositivo',
					'tableIcon' => 'resources/table_icons/ebay.png',
					'group' => $tg[2],
					'homepageShowCount' => 0
				),
				'accesorios' => array(
					'Caption' => 'Accesorios',
					'Description' => '',
					'tableIcon' => 'resources/table_icons/basket_add.png',
					'group' => $tg[2],
					'homepageShowCount' => 0
				),
				'ciudades' => array(
					'Caption' => 'Ciudades',
					'Description' => '',
					'tableIcon' => 'resources/table_icons/domain_template.png',
					'group' => $tg[6],
					'homepageShowCount' => 0
				),
				'verificacion' => array(
					'Caption' => 'Verificacion',
					'Description' => 'Con esta verificacion actualizas automaticamente el lugar donde se encuentra ubicado el dispositivo',
					'tableIcon' => 'resources/table_icons/accept.png',
					'group' => $tg[0],
					'homepageShowCount' => 0
				),
				'hojadevida' => array(
					'Caption' => 'Hoja de vida',
					'Description' => 'Hoja de vida en linea',
					'tableIcon' => 'resources/table_icons/application_view_list.png',
					'group' => $tg[0],
					'homepageShowCount' => 0
				),
				'financiero' => array(
					'Caption' => 'Financiero D',
					'Description' => 'Financiero de Dispositivos',
					'tableIcon' => 'resources/table_icons/coins.png',
					'group' => $tg[2],
					'homepageShowCount' => 0
				),
				'financiero_mobiliario' => array(
					'Caption' => 'Financiero M',
					'Description' => 'Financiero de Mobiliario',
					'tableIcon' => 'resources/table_icons/coins.png',
					'group' => $tg[1],
					'homepageShowCount' => 0
				),
				'prestador' => array(
					'Caption' => 'Prestador',
					'Description' => '',
					'tableIcon' => 'resources/table_icons/award_star_add.png',
					'group' => $tg[6],
					'homepageShowCount' => 0
				),
				'docu_modelo' => array(
					'Caption' => 'Documentos del modelo',
					'Description' => '',
					'tableIcon' => 'resources/table_icons/document_import.png',
					'group' => $tg[0],
					'homepageShowCount' => 0
				),
				'facturas' => array(
					'Caption' => 'Facturas',
					'Description' => '',
					'tableIcon' => 'resources/table_icons/application_form_add.png',
					'group' => $tg[0],
					'homepageShowCount' => 0
				),
				'formatos' => array(
					'Caption' => 'Formatos',
					'Description' => '',
					'tableIcon' => 'resources/table_icons/align_right.png',
					'group' => $tg[0],
					'homepageShowCount' => 0
				),
				'dispo_fuera' => array(
					'Caption' => 'Dispositivos da Baja',
					'Description' => 'Reporte de equipos y dispositivos dados de baja',
					'tableIcon' => 'resources/table_icons/mail-trash.png',
					'group' => $tg[2],
					'homepageShowCount' => 0
				),
				'dispositivo_tipo_grupo' => array(
					'Caption' => 'Grupo del dispositivo',
					'Description' => '',
					'tableIcon' => 'resources/table_icons/cog_add.png',
					'group' => $tg[4],
					'homepageShowCount' => 0
				),
				'tipo_relacion' => array(
					'Caption' => 'Tipo de relacion',
					'Description' => '',
					'tableIcon' => 'resources/table_icons/cog_add.png',
					'group' => $tg[4],
					'homepageShowCount' => 0
				),
				'tipo_dispositivo' => array(
					'Caption' => 'Tipo de dispositivo',
					'Description' => '',
					'tableIcon' => 'resources/table_icons/cog_add.png',
					'group' => $tg[4],
					'homepageShowCount' => 0
				),
				'tipo_documento' => array(
					'Caption' => 'Tipo de documento',
					'Description' => '',
					'tableIcon' => 'resources/table_icons/cog_add.png',
					'group' => $tg[4],
					'homepageShowCount' => 0
				),
				'tipo_iden' => array(
					'Caption' => 'Tipo de identificacion',
					'Description' => '',
					'tableIcon' => 'resources/table_icons/cog_add.png',
					'group' => $tg[4],
					'homepageShowCount' => 0
				),
				'tipo_razon_social' => array(
					'Caption' => 'Tipo de razon social',
					'Description' => '',
					'tableIcon' => 'resources/table_icons/cog_add.png',
					'group' => $tg[4],
					'homepageShowCount' => 0
				),
				'tipo_mobiliario' => array(
					'Caption' => 'Tipo de Mobiliario',
					'Description' => '',
					'tableIcon' => 'resources/table_icons/cog_add.png',
					'group' => $tg[4],
					'homepageShowCount' => 0
				),
				'tipo_grupo_mobilia' => array(
					'Caption' => 'Tipo grupo mobiliario',
					'Description' => 'Tipos de grupo en mobiliario de la unidad',
					'tableIcon' => 'resources/table_icons/cog_add.png',
					'group' => $tg[4],
					'homepageShowCount' => 0
				),
				'tipo_estado_dispo' => array(
					'Caption' => 'Estado del dispositivo',
					'Description' => 'Estado del dispositivo',
					'tableIcon' => 'resources/table_icons/cog_add.png',
					'group' => $tg[4],
					'homepageShowCount' => 0
				),
				'tipo_movimiento' => array(
					'Caption' => 'Tipo de movimiento',
					'Description' => '',
					'tableIcon' => 'resources/table_icons/cog_add.png',
					'group' => $tg[4],
					'homepageShowCount' => 0
				),
				'tipo_estado_movi' => array(
					'Caption' => 'Estado del movimiento',
					'Description' => '',
					'tableIcon' => 'resources/table_icons/cog_add.png',
					'group' => $tg[4],
					'homepageShowCount' => 0
				),
				'tipo_estado_verifica' => array(
					'Caption' => 'Tipo estado de verificacion',
					'Description' => '',
					'tableIcon' => 'resources/table_icons/cog_add.png',
					'group' => $tg[4],
					'homepageShowCount' => 0
				),
				'tipo_mtto' => array(
					'Caption' => 'Tipo de mantenimiento',
					'Description' => '',
					'tableIcon' => 'resources/table_icons/cog_add.png',
					'group' => $tg[4],
					'homepageShowCount' => 0
				),
				'tipo_calibracion' => array(
					'Caption' => 'Tipo calibracion',
					'Description' => '',
					'tableIcon' => 'resources/table_icons/cog_add.png',
					'group' => $tg[4],
					'homepageShowCount' => 0
				),
				'tipo_accesorio' => array(
					'Caption' => 'Tipo accesorio',
					'Description' => '',
					'tableIcon' => 'resources/table_icons/cog_add.png',
					'group' => $tg[4],
					'homepageShowCount' => 0
				),
				'tipo_formatos' => array(
					'Caption' => 'Tipo formatos',
					'Description' => '',
					'tableIcon' => 'resources/table_icons/cog_add.png',
					'group' => $tg[4],
					'homepageShowCount' => 0
				),
				'dispo_detalles_tecnicos' => array(
					'Caption' => 'Detalles tecnicos',
					'Description' => 'Detalles tecnicos del dispositivo',
					'tableIcon' => 'resources/table_icons/application_view_detail.png',
					'group' => $tg[0],
					'homepageShowCount' => 0
				),
				'tipo_estado_observaciones' => array(
					'Caption' => 'Tipo estado observaciones',
					'Description' => '',
					'tableIcon' => 'resources/table_icons/cog_add.png',
					'group' => $tg[4],
					'homepageShowCount' => 0
				),
				'movi_envio' => array(
					'Caption' => 'Envio',
					'Description' => '',
					'tableIcon' => 'resources/table_icons/arrow_right.png',
					'group' => $tg[0],
					'homepageShowCount' => 0
				),
				'movi_recepcion' => array(
					'Caption' => 'Recepcion',
					'Description' => '',
					'tableIcon' => 'resources/table_icons/arrow_refresh.png',
					'group' => $tg[0],
					'homepageShowCount' => 0
				),
				'tipo_fuera_servicio' => array(
					'Caption' => 'Tipo fuera servicio',
					'Description' => '',
					'tableIcon' => 'resources/table_icons/cog_add.png',
					'group' => $tg[4],
					'homepageShowCount' => 0
				),
				'tipo_documento_ss' => array(
					'Caption' => 'Tipo de documento',
					'Description' => '',
					'tableIcon' => 'resources/table_icons/cog_add.png',
					'group' => $tg[4],
					'homepageShowCount' => 0
				),
				'tipo_parentesco' => array(
					'Caption' => 'Tipo de parentesco',
					'Description' => '',
					'tableIcon' => 'resources/table_icons/cog_add.png',
					'group' => $tg[4],
					'homepageShowCount' => 0
				),
				'tipo_rh' => array(
					'Caption' => 'Tipo rh',
					'Description' => '',
					'tableIcon' => 'resources/table_icons/cog_add.png',
					'group' => $tg[4],
					'homepageShowCount' => 0
				),
				'accesorio_dispo_relacion' => array(
					'Caption' => 'Dispositivo relacionado',
					'Description' => '',
					'tableIcon' => 'resources/table_icons/nokia_s60.png',
					'group' => $tg[0],
					'homepageShowCount' => 0
				),
				'observaciones' => array(
					'Caption' => 'Observaciones',
					'Description' => '',
					'tableIcon' => 'resources/table_icons/radioactivity.png',
					'group' => $tg[2],
					'homepageShowCount' => 0
				),
				'foto_observacion' => array(
					'Caption' => 'Fotos Observaciones',
					'Description' => '',
					'tableIcon' => 'resources/table_icons/pictures.png',
					'group' => $tg[2],
					'homepageShowCount' => 0
				),
				'progreso' => array(
					'Caption' => 'Progreso',
					'Description' => 'Progreso de las observaciones',
					'tableIcon' => 'resources/table_icons/progressbar.png',
					'group' => $tg[2],
					'homepageShowCount' => 0
				),
				'tipo_estado_observa' => array(
					'Caption' => 'Tipo estado observa',
					'Description' => '',
					'tableIcon' => 'resources/table_icons/cog_add.png',
					'group' => $tg[4],
					'homepageShowCount' => 0
				),
				'acceso_remoto' => array(
					'Caption' => 'Acceso remoto',
					'Description' => 'Ingreso remoto AnyDesk y Teamviewer',
					'tableIcon' => 'resources/table_icons/dns.png',
					'group' => $tg[0],
					'homepageShowCount' => 0
				),
				'tipo_periodicidad' => array(
					'Caption' => 'Tipo periodicidad',
					'Description' => '',
					'tableIcon' => 'resources/table_icons/cog_add.png',
					'group' => $tg[4],
					'homepageShowCount' => 0
				),
				'perfil' => array(
					'Caption' => 'Perfil',
					'Description' => '',
					'tableIcon' => 'resources/table_icons/user.png',
					'group' => $tg[3],
					'homepageShowCount' => 0
				),
				'consentimieto' => array(
					'Caption' => 'Consentimieto',
					'Description' => '',
					'tableIcon' => 'resources/table_icons/document_next.png',
					'group' => $tg[3],
					'homepageShowCount' => 0
				),
				'perfil_familia' => array(
					'Caption' => 'Familia',
					'Description' => '',
					'tableIcon' => 'resources/table_icons/client_account_template.png',
					'group' => $tg[3],
					'homepageShowCount' => 0
				),
				'perfil_soportes' => array(
					'Caption' => 'Soportes Perfil',
					'Description' => '',
					'tableIcon' => 'resources/table_icons/education.png',
					'group' => $tg[3],
					'homepageShowCount' => 0
				),
				'seguridad_social' => array(
					'Caption' => 'Soportes SS',
					'Description' => '',
					'tableIcon' => 'resources/table_icons/document_inspector.png',
					'group' => $tg[3],
					'homepageShowCount' => 0
				),
				'costos_mtto' => array(
					'Caption' => 'Costos en mantenimiento',
					'Description' => '',
					'tableIcon' => 'resources/table_icons/coins_add.png',
					'group' => $tg[0],
					'homepageShowCount' => 0
				),
				'tipo_costo' => array(
					'Caption' => 'Tipo costo',
					'Description' => '',
					'tableIcon' => 'resources/table_icons/cog_add.png',
					'group' => $tg[4],
					'homepageShowCount' => 0
				),
				'doc_mtto' => array(
					'Caption' => 'Doc mtto',
					'Description' => '',
					'tableIcon' => 'resources/table_icons/attributes_display.png',
					'group' => $tg[0],
					'homepageShowCount' => 0
				),
				'biomedicos' => array(
					'Caption' => 'Biomedicos',
					'Description' => '',
					'tableIcon' => 'resources/table_icons/administrator.png',
					'group' => $tg[3],
					'homepageShowCount' => 0
				),
				'tipo_clasifica_riesgo' => array(
					'Caption' => 'Tipo clasifica riesgo',
					'Description' => 'Deacuerdo al ABC de dispositivos medicos.',
					'tableIcon' => 'resources/table_icons/cog_add.png',
					'group' => $tg[4],
					'homepageShowCount' => 0
				),
				'programa_mtto' => array(
					'Caption' => 'Programa mtto',
					'Description' => '',
					'tableIcon' => 'resources/table_icons/book_add.png',
					'group' => $tg[0],
					'homepageShowCount' => 0
				),
				'cronograma_mtto' => array(
					'Caption' => 'Cronograma mtto',
					'Description' => '',
					'tableIcon' => 'resources/table_icons/application_form_add.png',
					'group' => $tg[0],
					'homepageShowCount' => 0
				),
				'compras' => array(
					'Caption' => 'Ingreso / Salida',
					'Description' => 'Registro de ingreso y salida',
					'tableIcon' => 'resources/table_icons/accept.png',
					'group' => $tg[5],
					'homepageShowCount' => 0
				),
				'tipo_estado_compra' => array(
					'Caption' => 'Tipo estado compra',
					'Description' => 'Aceptado, Rechazado, En proceso',
					'tableIcon' => 'resources/table_icons/cog_add.png',
					'group' => $tg[5],
					'homepageShowCount' => 0
				),
				'cantidad_dispomedico' => array(
					'Caption' => 'Dispositivos Biomedicos Nuevos',
					'Description' => 'Toda clase de dispositivos biomedicos que midan o se instalen al paciente',
					'tableIcon' => 'resources/table_icons/basket_add.png',
					'group' => $tg[5],
					'homepageShowCount' => 0
				),
				'cantidad_articulos' => array(
					'Caption' => 'Articulos Nuevos',
					'Description' => 'Cantidad de articulos',
					'tableIcon' => 'resources/table_icons/cart_add.png',
					'group' => $tg[5],
					'homepageShowCount' => 0
				),
				'cantidad_mobiliario' => array(
					'Caption' => 'Mobiliario Nuevo',
					'Description' => '',
					'tableIcon' => 'resources/table_icons/brick_add.png',
					'group' => $tg[5],
					'homepageShowCount' => 0
				),
				'compra_dispo' => array(
					'Caption' => 'Dispo Biomedicos Comprados',
					'Description' => 'Dispositivos medicos comprados',
					'tableIcon' => 'resources/table_icons/computer_add.png',
					'group' => $tg[5],
					'homepageShowCount' => 0
				),
				'articulos' => array(
					'Caption' => 'Articulos',
					'Description' => 'Toda clase de articulos dispositivos y equipos que no son equipos biomedicos.',
					'tableIcon' => 'resources/table_icons/monitor_add.png',
					'group' => $tg[1],
					'homepageShowCount' => 0
				),
				'cofig' => array(
					'Caption' => 'CONFIG',
					'Description' => 'Configuraciones de filtros en listas',
					'tableIcon' => 'resources/table_icons/cog_add.png',
					'group' => $tg[6],
					'homepageShowCount' => 0
				),
				'marca_presetacion' => array(
					'Caption' => 'Marca presetacion',
					'Description' => '',
					'tableIcon' => 'resources/table_icons/cog_add.png',
					'group' => $tg[1],
					'homepageShowCount' => 0
				),
				'tipo_document_grupo' => array(
					'Caption' => 'Tipo grupo documento',
					'Description' => '',
					'tableIcon' => 'resources/table_icons/cog_add.png',
					'group' => $tg[4],
					'homepageShowCount' => 0
				),
				'tipo_pago' => array(
					'Caption' => 'Tipo pago',
					'Description' => '',
					'tableIcon' => 'resources/table_icons/cog_add.png',
					'group' => $tg[4],
					'homepageShowCount' => 0
				),
				'tipo_compra' => array(
					'Caption' => 'Tipo compra',
					'Description' => 'Orden de compra, Ingreso de compra',
					'tableIcon' => 'resources/table_icons/cog_add.png',
					'group' => $tg[4],
					'homepageShowCount' => 0
				),
				'articulos_familia' => array(
					'Caption' => 'Articulos familia',
					'Description' => '',
					'tableIcon' => 'resources/table_icons/cog_add.png',
					'group' => $tg[1],
					'homepageShowCount' => 0
				),
				'articulo_codigo_proveedor' => array(
					'Caption' => 'Articulo codigo proveedor',
					'Description' => '',
					'tableIcon' => 'resources/table_icons/cog_add.png',
					'group' => $tg[1],
					'homepageShowCount' => 0
				),
				'tipo_unidad_medida' => array(
					'Caption' => 'Tipo unidad medida',
					'Description' => '',
					'tableIcon' => 'resources/table_icons/cog_add.png',
					'group' => $tg[4],
					'homepageShowCount' => 0
				),
				'genera_documentos' => array(
					'Caption' => 'Genera documentos',
					'Description' => '',
					'tableIcon' => 'resources/table_icons/cog_add.png',
					'group' => $tg[0],
					'homepageShowCount' => 0
				),
				'verificacion_articulos' => array(
					'Caption' => 'Verificacion',
					'Description' => 'Con esta verificacion actualizas automaticamente el lugar donde se encuentra ubicado el dispositivo',
					'tableIcon' => 'resources/table_icons/accept.png',
					'group' => $tg[1],
					'homepageShowCount' => 0
				),
				'movimientos_articulos' => array(
					'Caption' => 'Movimientos',
					'Description' => 'Registro de movimientos de articulos',
					'tableIcon' => 'resources/table_icons/arrow_branch.png',
					'group' => $tg[1],
					'homepageShowCount' => 0
				),
				'movi_envio_articulo' => array(
					'Caption' => 'Envio',
					'Description' => '',
					'tableIcon' => 'resources/table_icons/arrow_right.png',
					'group' => $tg[1],
					'homepageShowCount' => 0
				),
				'movi_recepcion_articulos' => array(
					'Caption' => 'Recepcion',
					'Description' => '',
					'tableIcon' => 'resources/table_icons/arrow_refresh.png',
					'group' => $tg[1],
					'homepageShowCount' => 0
				),
				'ubicacion_articulo' => array(
					'Caption' => 'Ubicacion articulo',
					'Description' => '',
					'tableIcon' => 'resources/table_icons/building.png',
					'group' => $tg[1],
					'homepageShowCount' => 0
				),
				'ubicacion_mobiliario' => array(
					'Caption' => 'Ubicacion mobiliario',
					'Description' => '',
					'tableIcon' => 'table.gif',
					'group' => $tg[0],
					'homepageShowCount' => 0
				),
				'precio_dispo_medico' => array(
					'Caption' => 'Precio dispo medico',
					'Description' => '',
					'tableIcon' => 'table.gif',
					'group' => $tg[0],
					'homepageShowCount' => 0
				),
				'precio_articulo' => array(
					'Caption' => 'Precio articulo',
					'Description' => '',
					'tableIcon' => 'resources/table_icons/coins_add.png',
					'group' => $tg[1],
					'homepageShowCount' => 0
				),
				'precio_mobiliario' => array(
					'Caption' => 'Precio mobiliario',
					'Description' => '',
					'tableIcon' => 'resources/table_icons/coins_add.png',
					'group' => $tg[1],
					'homepageShowCount' => 0
				),
		);

		if($skip_authentication || getLoggedAdmin()) return $all_tables;

		foreach($all_tables as $tn => $ti) {
			$arrPerm = getTablePermissions($tn);
			if($arrPerm['access']) $accessible_tables[$tn] = $ti;
		}

		return $accessible_tables;
	}
	#########################################################
	if(!function_exists('getTableList')) {
		function getTableList($skip_authentication = false) {
			$arrTables = array(
				'dispositivos' => 'Dispositivos Biomedicos',
				'mobiliario' => 'Mobiliario',
				'contactos' => 'Contactos',
				'contactos_tipo_contacto' => 'Tipo de contacto',
				'movimientos' => 'Movimientos',
				'documentos' => 'Documentos del dispositivo',
				'mantenimientos' => 'Mantenimientos',
				'calibraciones' => 'Calibraciones',
				'unidades' => 'Unidades Medicas',
				'marcas' => 'Marcas',
				'marca_modelo' => 'Marca y Modelo',
				'accesorios' => 'Accesorios',
				'ciudades' => 'Ciudades',
				'verificacion' => 'Verificacion',
				'hojadevida' => 'Hoja de vida',
				'financiero' => 'Financiero D',
				'financiero_mobiliario' => 'Financiero M',
				'prestador' => 'Prestador',
				'docu_modelo' => 'Documentos del modelo',
				'facturas' => 'Facturas',
				'formatos' => 'Formatos',
				'dispo_fuera' => 'Dispositivos da Baja',
				'dispositivo_tipo_grupo' => 'Grupo del dispositivo',
				'tipo_relacion' => 'Tipo de relacion',
				'tipo_dispositivo' => 'Tipo de dispositivo',
				'tipo_documento' => 'Tipo de documento',
				'tipo_iden' => 'Tipo de identificacion',
				'tipo_razon_social' => 'Tipo de razon social',
				'tipo_mobiliario' => 'Tipo de Mobiliario',
				'tipo_grupo_mobilia' => 'Tipo grupo mobiliario',
				'tipo_estado_dispo' => 'Estado del dispositivo',
				'tipo_movimiento' => 'Tipo de movimiento',
				'tipo_estado_movi' => 'Estado del movimiento',
				'tipo_estado_verifica' => 'Tipo estado de verificacion',
				'tipo_mtto' => 'Tipo de mantenimiento',
				'tipo_calibracion' => 'Tipo calibracion',
				'tipo_accesorio' => 'Tipo accesorio',
				'tipo_formatos' => 'Tipo formatos',
				'dispo_detalles_tecnicos' => 'Detalles tecnicos',
				'tipo_estado_observaciones' => 'Tipo estado observaciones',
				'movi_envio' => 'Envio',
				'movi_recepcion' => 'Recepcion',
				'tipo_fuera_servicio' => 'Tipo fuera servicio',
				'tipo_documento_ss' => 'Tipo de documento',
				'tipo_parentesco' => 'Tipo de parentesco',
				'tipo_rh' => 'Tipo rh',
				'accesorio_dispo_relacion' => 'Dispositivo relacionado',
				'observaciones' => 'Observaciones',
				'foto_observacion' => 'Fotos Observaciones',
				'progreso' => 'Progreso',
				'tipo_estado_observa' => 'Tipo estado observa',
				'acceso_remoto' => 'Acceso remoto',
				'tipo_periodicidad' => 'Tipo periodicidad',
				'perfil' => 'Perfil',
				'consentimieto' => 'Consentimieto',
				'perfil_familia' => 'Familia',
				'perfil_soportes' => 'Soportes Perfil',
				'seguridad_social' => 'Soportes SS',
				'costos_mtto' => 'Costos en mantenimiento',
				'tipo_costo' => 'Tipo costo',
				'doc_mtto' => 'Doc mtto',
				'biomedicos' => 'Biomedicos',
				'tipo_clasifica_riesgo' => 'Tipo clasifica riesgo',
				'programa_mtto' => 'Programa mtto',
				'cronograma_mtto' => 'Cronograma mtto',
				'compras' => 'Ingreso / Salida',
				'tipo_estado_compra' => 'Tipo estado compra',
				'cantidad_dispomedico' => 'Dispositivos Biomedicos Nuevos',
				'cantidad_articulos' => 'Articulos Nuevos',
				'cantidad_mobiliario' => 'Mobiliario Nuevo',
				'compra_dispo' => 'Dispo Biomedicos Comprados',
				'articulos' => 'Articulos',
				'cofig' => 'CONFIG',
				'marca_presetacion' => 'Marca presetacion',
				'tipo_document_grupo' => 'Tipo grupo documento',
				'tipo_pago' => 'Tipo pago',
				'tipo_compra' => 'Tipo compra',
				'articulos_familia' => 'Articulos familia',
				'articulo_codigo_proveedor' => 'Articulo codigo proveedor',
				'tipo_unidad_medida' => 'Tipo unidad medida',
				'genera_documentos' => 'Genera documentos',
				'verificacion_articulos' => 'Verificacion',
				'movimientos_articulos' => 'Movimientos',
				'movi_envio_articulo' => 'Envio',
				'movi_recepcion_articulos' => 'Recepcion',
				'ubicacion_articulo' => 'Ubicacion articulo',
				'ubicacion_mobiliario' => 'Ubicacion mobiliario',
				'precio_dispo_medico' => 'Precio dispo medico',
				'precio_articulo' => 'Precio articulo',
				'precio_mobiliario' => 'Precio mobiliario',
			);

			return $arrTables;
		}
	}
	########################################################################
	function getThumbnailSpecs($tableName, $fieldName, $view) {
		if($tableName=='mobiliario' && $fieldName=='foto' && $view=='tv')
			return array('width'=>50, 'height'=>50, 'identifier'=>'_tv');
		elseif($tableName=='mobiliario' && $fieldName=='foto' && $view=='dv')
			return array('width'=>250, 'height'=>250, 'identifier'=>'_dv');
		elseif($tableName=='unidades' && $fieldName=='logo' && $view=='tv')
			return array('width'=>50, 'height'=>50, 'identifier'=>'_tv');
		elseif($tableName=='unidades' && $fieldName=='logo' && $view=='dv')
			return array('width'=>150, 'height'=>150, 'identifier'=>'_dv');
		elseif($tableName=='marca_modelo' && $fieldName=='img' && $view=='tv')
			return array('width'=>50, 'height'=>50, 'identifier'=>'_tv');
		elseif($tableName=='marca_modelo' && $fieldName=='img' && $view=='dv')
			return array('width'=>250, 'height'=>250, 'identifier'=>'_dv');
		elseif($tableName=='foto_observacion' && $fieldName=='foto' && $view=='tv')
			return array('width'=>50, 'height'=>50, 'identifier'=>'_tv');
		elseif($tableName=='foto_observacion' && $fieldName=='foto' && $view=='dv')
			return array('width'=>250, 'height'=>250, 'identifier'=>'_dv');
		elseif($tableName=='perfil' && $fieldName=='foto_perfil' && $view=='tv')
			return array('width'=>50, 'height'=>50, 'identifier'=>'_tv');
		elseif($tableName=='perfil' && $fieldName=='foto_perfil' && $view=='dv')
			return array('width'=>250, 'height'=>250, 'identifier'=>'_dv');
		elseif($tableName=='biomedicos' && $fieldName=='firma' && $view=='tv')
			return array('width'=>50, 'height'=>100, 'identifier'=>'_tv');
		return FALSE;
	}
	########################################################################
	function createThumbnail($img, $specs) {
		$w = $specs['width'];
		$h = $specs['height'];
		$id = $specs['identifier'];
		$path = dirname($img);

		// image doesn't exist or inaccessible?
		if(!$size = @getimagesize($img)) return false;

		// calculate thumbnail size to maintain aspect ratio
		$ow = $size[0]; // original image width
		$oh = $size[1]; // original image height
		$twbh = $h / $oh * $ow; // calculated thumbnail width based on given height
		$thbw = $w / $ow * $oh; // calculated thumbnail height based on given width
		if($w && $h) {
			if($twbh > $w) $h = $thbw;
			if($thbw > $h) $w = $twbh;
		} elseif($w) {
			$h = $thbw;
		} elseif($h) {
			$w = $twbh;
		} else {
			return false;
		}

		// dir not writeable?
		if(!is_writable($path)) return false;

		// GD lib not loaded?
		if(!function_exists('gd_info')) return false;
		$gd = gd_info();

		// GD lib older than 2.0?
		preg_match('/\d/', $gd['GD Version'], $gdm);
		if($gdm[0] < 2) return false;

		// get file extension
		preg_match('/\.[a-zA-Z]{3,4}$/U', $img, $matches);
		$ext = strtolower($matches[0]);

		// check if supplied image is supported and specify actions based on file type
		if($ext == '.gif') {
			if(!$gd['GIF Create Support']) return false;
			$thumbFunc = 'imagegif';
		} elseif($ext == '.png') {
			if(!$gd['PNG Support'])  return false;
			$thumbFunc = 'imagepng';
		} elseif($ext == '.jpg' || $ext == '.jpe' || $ext == '.jpeg') {
			if(!$gd['JPG Support'] && !$gd['JPEG Support'])  return false;
			$thumbFunc = 'imagejpeg';
		} else {
			return false;
		}

		// determine thumbnail file name
		$ext = $matches[0];
		$thumb = substr($img, 0, -5) . str_replace($ext, $id . $ext, substr($img, -5));

		// if the original image smaller than thumb, then just copy it to thumb
		if($h > $oh && $w > $ow) {
			return (@copy($img, $thumb) ? true : false);
		}

		// get image data
		if(!$imgData = imagecreatefromstring(implode('', file($img)))) return false;

		// finally, create thumbnail
		$thumbData = imagecreatetruecolor($w, $h);

		//preserve transparency of png and gif images
		if($thumbFunc == 'imagepng') {
			if(($clr = @imagecolorallocate($thumbData, 0, 0, 0)) != -1) {
				@imagecolortransparent($thumbData, $clr);
				@imagealphablending($thumbData, false);
				@imagesavealpha($thumbData, true);
			}
		} elseif($thumbFunc == 'imagegif') {
			@imagealphablending($thumbData, false);
			$transIndex = imagecolortransparent($imgData);
			if($transIndex >= 0) {
				$transClr = imagecolorsforindex($imgData, $transIndex);
				$transIndex = imagecolorallocatealpha($thumbData, $transClr['red'], $transClr['green'], $transClr['blue'], 127);
				imagefill($thumbData, 0, 0, $transIndex);
			}
		}

		// resize original image into thumbnail
		if(!imagecopyresampled($thumbData, $imgData, 0, 0 , 0, 0, $w, $h, $ow, $oh)) return false;
		unset($imgData);

		// gif transparency
		if($thumbFunc == 'imagegif' && $transIndex >= 0) {
			imagecolortransparent($thumbData, $transIndex);
			for($y = 0; $y < $h; ++$y)
				for($x = 0; $x < $w; ++$x)
					if(((imagecolorat($thumbData, $x, $y) >> 24) & 0x7F) >= 100) imagesetpixel($thumbData, $x, $y, $transIndex);
			imagetruecolortopalette($thumbData, true, 255);
			imagesavealpha($thumbData, false);
		}

		if(!$thumbFunc($thumbData, $thumb)) return false;
		unset($thumbData);

		return true;
	}
	########################################################################
	function makeSafe($string, $is_gpc = true) {
		static $cached = []; /* str => escaped_str */

		if(!strlen($string)) return '';

		if(!db_link()) sql("SELECT 1+1", $eo);

		// if this is a previously escaped string, return from cached
		// checking both keys and values
		if(isset($cached[$string])) return $cached[$string];
		$key = array_search($string, $cached);
		if($key !== false) return $string; // already an escaped string

		$cached[$string] = db_escape($string);
		return $cached[$string];
	}
	########################################################################
	function checkPermissionVal($pvn) {
		// fn to make sure the value in the given POST variable is 0, 1, 2 or 3
		// if the value is invalid, it default to 0
		$pvn=intval($_POST[$pvn]);
		if($pvn!=1 && $pvn!=2 && $pvn!=3) {
			return 0;
		} else {
			return $pvn;
		}
	}
	########################################################################
	function dieErrorPage($error) {
		global $Translation;

		$header = (defined('ADMIN_AREA') ? __DIR__ . '/incHeader.php' : __DIR__ . '/../header.php');
		$footer = (defined('ADMIN_AREA') ? __DIR__ . '/incFooter.php' : __DIR__ . '/../footer.php');

		ob_start();

		@include_once($header);
		echo Notification::placeholder();
		echo Notification::show([
			'message' => $error,
			'class' => 'danger',
			'dismiss_seconds' => 7200
		]);
		@include_once($footer);

		echo ob_get_clean();
		exit;
	}
	########################################################################
	function openDBConnection(&$o) {
		static $connected = false, $db_link;

		$dbServer = config('dbServer');
		$dbUsername = config('dbUsername');
		$dbPassword = config('dbPassword');
		$dbDatabase = config('dbDatabase');

		if($connected) return $db_link;

		/****** Check that MySQL module is enabled ******/
		if(!extension_loaded('mysql') && !extension_loaded('mysqli')) {
			$o['error'] = 'PHP is not configured to connect to MySQL on this machine. Please see <a href="https://www.php.net/manual/en/ref.mysql.php">this page</a> for help on how to configure MySQL.';
			if($o['silentErrors']) return false;

			dieErrorPage($o['error']);
		}

		/****** Connect to MySQL ******/
		if(!($db_link = @db_connect($dbServer, $dbUsername, $dbPassword))) {
			$o['error'] = db_error($db_link, true);
			if($o['silentErrors']) return false;

			dieErrorPage($o['error']);
		}

		/****** Select DB ********/
		if(!db_select_db($dbDatabase, $db_link)) {
			$o['error'] = db_error($db_link);
			if($o['silentErrors']) return false;

			dieErrorPage($o['error']);
		}

		$connected = true;
		return $db_link;
	}
	########################################################################
	function sql($statement, &$o) {

		/*
			Supported options that can be passed in $o options array (as array keys):
			'silentErrors': If true, errors will be returned in $o['error'] rather than displaying them on screen and exiting.
			'noSlowQueryLog': don't log slow query if true
			'noErrorQueryLog': don't log error query if true
		*/

		global $Translation;

		$db_link = openDBConnection($o);

		/*
		 if openDBConnection() fails, it would abort execution unless 'silentErrors' is true,
		 in which case, we should return false from sql() without further action since
		 $o['error'] would be already set by openDBConnection()
		*/
		if(!$db_link) return false;

		$t0 = microtime(true);

		if(!$result = @db_query($statement, $db_link)) {
			if(!stristr($statement, "show columns")) {
				// retrieve error codes
				$errorNum = db_errno($db_link);
				$o['error'] = htmlspecialchars(db_error($db_link));

				if(empty($o['noErrorQueryLog']))
					logErrorQuery($statement, $o['error']);

				if(getLoggedAdmin())
					$o['error'] .= "<pre class=\"ltr\">{$Translation['query:']}\n" . htmlspecialchars($statement) . "</pre><p><i class=\"text-right\">{$Translation['admin-only info']}</i></p><p>{$Translation['try rebuild fields']}</p>";

				if($o['silentErrors']) return false;

				dieErrorPage($o['error']);
			}
		}

		/* log slow queries that take more than 1 sec */
		$t1 = microtime(true);
		if($t1 - $t0 > 1.0 && empty($o['noSlowQueryLog']))
			logSlowQuery($statement, $t1 - $t0);

		return $result;
	}
	########################################################################
	function logSlowQuery($statement, $duration) {
		if(!createQueryLogTable()) return;

		$o = [
			'silentErrors' => true,
			'noSlowQueryLog' => true,
			'noErrorQueryLog' => true
		];
		$statement = makeSafe($statement);
		$duration = floatval($duration);
		$memberID = makeSafe(getLoggedMemberID());
		$uri = makeSafe($_SERVER['REQUEST_URI']);

		sql("INSERT INTO `appgini_query_log` SET
			`statement`='$statement',
			`duration`=$duration,
			`memberID`='$memberID',
			`uri`='$uri'
		", $o);
	}
	########################################################################
	function logErrorQuery($statement, $error) {
		if(!createQueryLogTable()) return;

		$o = [
			'silentErrors' => true,
			'noSlowQueryLog' => true,
			'noErrorQueryLog' => true
		];
		$statement = makeSafe($statement);
		$error = makeSafe($error);
		$memberID = makeSafe(getLoggedMemberID());
		$uri = makeSafe($_SERVER['REQUEST_URI']);

		sql("INSERT INTO `appgini_query_log` SET
			`statement`='$statement',
			`error`='$error',
			`memberID`='$memberID',
			`uri`='$uri'
		", $o);
	}

	########################################################################
	function createQueryLogTable() {
		static $created = false;
		if($created) return true;

		$o = [
			'silentErrors' => true,
			'noSlowQueryLog' => true,
			'noErrorQueryLog' => true
		];

		sql("CREATE TABLE IF NOT EXISTS `appgini_query_log` (
			`datetime` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
			`statement` LONGTEXT,
			`duration` DECIMAL(10,2) UNSIGNED DEFAULT 0.0,
			`error` TEXT,
			`memberID` VARCHAR(200),
			`uri` VARCHAR(200)
		) CHARSET " . mysql_charset, $o);

		// check if table created
		//$o2 = $o;
		//$o2['error'] = '';
		//sql("SELECT COUNT(1) FROM 'appgini_query_log'", $o2);

		//$created = empty($o2['error']);

		$created = true;
		return $created;
	}

	########################################################################
	function sqlValue($statement, &$error = NULL) {
		// executes a statement that retreives a single data value and returns the value retrieved
		$eo = ['silentErrors' => true];
		if(!$res = sql($statement, $eo)) { $error = $eo['error']; return false; }
		if(!$row = db_fetch_row($res)) return false;
		return $row[0];
	}
	########################################################################
	function getLoggedAdmin() {
		// checks session variables to see whether the admin is logged or not
		// if not, it returns false
		// if logged, it returns the user id

		$adminConfig = config('adminConfig');
		if(empty($_SESSION['memberID'])) return false;
		if($_SESSION['memberID'] == $adminConfig['adminUsername']) {
			$_SESSION['adminUsername'] = $_SESSION['memberID'];
			return $_SESSION['adminUsername'];
		}

		unset($_SESSION['adminUsername']);
		return false;
	}
	########################################################################
	function checkUser($username, $password) {
		// checks given username and password for validity
		// if valid, registers the username in a session and returns true
		// else, returns false and destroys session

		$adminConfig = config('adminConfig');
		if($username != $adminConfig['adminUsername'] || !password_match($password, $adminConfig['adminPassword'])) {
			return false;
		}

		$_SESSION['adminUsername'] = $username;
		$_SESSION['memberGroupID'] = sqlValue("select groupID from membership_users where memberID='" . makeSafe($username) ."'");
		$_SESSION['memberID'] = $username;
		return true;
	}
	########################################################################
	function initSession() {
		$sh = @ini_get('session.save_handler');

		$options = [
			'name' => 'STARMEDICA',
			'save_handler' => stripos($sh, 'memcache') === false ? 'files' : $sh,
			'serialize_handler' => 'php',
			'cookie_lifetime' => '0',
			'cookie_path' => '/' . trim(config('appURI'), '/'),
			'cookie_httponly' => '1',
			'use_strict_mode' => '1',
			'use_cookies' => '1',
			'use_only_cookies' => '1',
			'cache_limiter' => $_SERVER['REQUEST_METHOD'] == 'POST' ? 'private' : 'nocache',
			'cache_expire' => '2',
		];

		// hook: session_options(), if defined, $options is passed to it by reference
		// to override default session behavior.
		// should be defined in hooks/bootstrap.php
		if(function_exists('session_options')) session_options($options);

		// check sessions config
		$noPathCheck = true; // set to false for debugging session issues
		$arrPath = explode(';', ini_get('session.save_path'));
		$save_path = $arrPath[count($arrPath) - 1];
		if(!$noPathCheck && !is_dir($save_path)) die('Invalid session.save_path in php.ini');

		if(session_id()) { session_write_close(); }

		foreach($options as $key => $value)
			@ini_set("session.{$key}", $value);

		session_start();
	}
	########################################################################
	function jwt_key() {
		$config_file = dirname(__FILE__) . '/../config.php';
		if(!is_file($config_file)) return false;
		return md5_file($config_file);
	}
	########################################################################
	function jwt_token($user = false) {
		if($user === false) $user = $_SESSION['memberID'];
		$key = jwt_key();
		if($key === false) return false;
		return JWT::encode(array('user' => $user), $key);
	}
	########################################################################
	function jwt_header() {
		/* adapted from https://stackoverflow.com/a/40582472/1945185 */
		$auth_header = null;
		if(isset($_SERVER['Authorization'])) {
			$auth_header = trim($_SERVER['Authorization']);
		} elseif(isset($_SERVER['HTTP_AUTHORIZATION'])) { //Nginx or fast CGI
			$auth_header = trim($_SERVER['HTTP_AUTHORIZATION']);
		} elseif(isset($_SERVER['HTTP_X_AUTHORIZATION'])) { //hack if all else fails
			$auth_header = trim($_SERVER['HTTP_X_AUTHORIZATION']);
		} elseif(function_exists('apache_request_headers')) {
			$rh = apache_request_headers();
			// Server-side fix for bug in old Android versions (a nice side-effect of this fix means we don't care about capitalization for Authorization)
			$rh = array_combine(array_map('ucwords', array_keys($rh)), array_values($rh));
			if(isset($rh['Authorization'])) {
				$auth_header = trim($rh['Authorization']);
			} elseif(isset($rh['X-Authorization'])) {
				$auth_header = trim($rh['X-Authorization']);
			}
		}

		if(!empty($auth_header)) {
			if(preg_match('/Bearer\s(\S+)/', $auth_header, $matches)) return $matches[1];
		}

		return null;
	}
	########################################################################
	function jwt_check_login() {
		// do we have an Authorization Bearer header?
		$token = jwt_header();
		if(!$token) return false;

		$key = jwt_key();
		if($key === false) return false;

		$error = '';
		$payload = JWT::decode($token, $key, $error);
		if(empty($payload['user'])) return false;

		$_SESSION['memberID'] = $payload['user'];
		$safe_user = makeSafe($payload['user']);
		$_SESSION['memberGroupID'] = sqlValue(
			"SELECT `groupID` FROM `membership_users` WHERE `memberID`='{$safe_user}'" 
		);

		// for API calls that just trigger an action and then close connection, 
		// we need to continue running
		@ignore_user_abort(true);
		@set_time_limit(120);

		return true;
	}
	########################################################################
	function curl_insert_handler($table, $data) {
		if(!function_exists('curl_init')) return false;
		$ch = curl_init();

		$payload = $data;
		$payload['insert_x'] = 1;

		$url = (isset($_SERVER['HTTPS']) ? 'https://' : 'http://') . config('host') . '/' . application_uri("{$table}_view.php");
		$token = jwt_token();
		$options = array(
			CURLOPT_URL => $url,
			CURLOPT_POST => true,
			CURLOPT_POSTFIELDS => http_build_query($payload),
			CURLOPT_HTTPHEADER => array(
				"User-Agent: {$_SERVER['HTTP_USER_AGENT']}",
				"Accept: {$_SERVER['HTTP_ACCEPT']}",
				"Authorization: Bearer " . $token,
				"X-Authorization: Bearer " . $token,
			),
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_RETURNTRANSFER => true,

			/* this is a localhost request so need to verify SSL */
			CURLOPT_SSL_VERIFYPEER => false,

			// the following option allows sending request and then 
			// closing the connection without waiting for response
			// see https://stackoverflow.com/a/10895361/1945185
			CURLOPT_TIMEOUT => 8,
		);

		if(defined('CURLOPT_TCP_FASTOPEN')) $options[CURLOPT_TCP_FASTOPEN] = true;
		if(defined('CURLOPT_SAFE_UPLOAD'))
			$options[CURLOPT_SAFE_UPLOAD] = function_exists('curl_file_create');

		// this is safe to use as we're sending a local request
		if(defined('CURLOPT_UNRESTRICTED_AUTH')) $options[CURLOPT_UNRESTRICTED_AUTH] = 1;

		curl_setopt_array($ch, $options);

		return $ch;
	}
########################################################################
	function curl_batch($handlers) {
		if(!function_exists('curl_init')) return false;
		if(!is_array($handlers)) return false;
		if(!count($handlers)) return false;

		$mh = curl_multi_init();
		if(function_exists('curl_multi_setopt')) {
			curl_multi_setopt($mh, CURLMOPT_PIPELINING, 1);
			curl_multi_setopt($mh, CURLMOPT_MAXCONNECTS, min(20, count($handlers)));
		}

		foreach($handlers as $ch) {
			@curl_multi_add_handle($mh, $ch);
		}

		$active = false;
		do {
			@curl_multi_exec($mh, $active);
			usleep(2000);
		} while($active > 0);
	}
	########################################################################
	function logOutUser() {
		RememberMe::logout();
	}
	########################################################################
	function getPKFieldName($tn) {
		// get pk field name of given table
		static $pk = [];
		if(isset($pk[$tn])) return $pk[$tn];

		$stn = makeSafe($tn, false);
		$eo = ['silentErrors' => true];
		if(!$res = sql("SHOW FIELDS FROM `$stn`", $eo)) return $pk[$tn] = false;

		while($row = db_fetch_assoc($res))
			if($row['Key'] == 'PRI') return $pk[$tn] = $row['Field'];

		return $pk[$tn] = false;
	}
	########################################################################
	function getCSVData($tn, $pkValue, $stripTags=true) {
		// get pk field name for given table
		if(!$pkField=getPKFieldName($tn)) {
			return "";
		}

		// get a concat string to produce a csv list of field values for given table record
		if(!$res=sql("show fields from `$tn`", $eo)) {
			return "";
		}
		while($row=db_fetch_assoc($res)) {
			$csvFieldList.="`{$row['Field']}`,";
		}
		$csvFieldList=substr($csvFieldList, 0, -1);

		$csvData=sqlValue("select CONCAT_WS(', ', $csvFieldList) from `$tn` where `$pkField`='" . makeSafe($pkValue, false) . "'");

		return ($stripTags ? strip_tags($csvData) : $csvData);
	}
	########################################################################
	function errorMsg($msg) {
		echo "<div class=\"alert alert-danger\">{$msg}</div>";
	}
	########################################################################
	function redirect($url, $absolute = false) {
		$fullURL = ($absolute ? $url : application_url($url));
		if(!headers_sent()) header("Location: {$fullURL}");

		echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"0;url={$fullURL}\">";
		echo "<br><br><a href=\"{$fullURL}\">Click here</a> if you aren't automatically redirected.";
		exit;
	}
	########################################################################
	function htmlRadioGroup($name, $arrValue, $arrCaption, $selectedValue, $selClass = 'text-primary', $class = '', $separator = '<br>') {
		if(!is_array($arrValue)) return '';

		ob_start();
		?>
		<div class="radio %%CLASS%%"><label>
			<input type="radio" name="%%NAME%%" id="%%ID%%" value="%%VALUE%%" %%CHECKED%%> %%LABEL%%
		</label></div>
		<?php
		$template = ob_get_contents();
		ob_end_clean();

		$out = '';
		for($i = 0; $i < count($arrValue); $i++) {
			$replacements = array(
				'%%CLASS%%' => html_attr($arrValue[$i] == $selectedValue ? $selClass :$class),
				'%%NAME%%' => html_attr($name),
				'%%ID%%' => html_attr($name . $i),
				'%%VALUE%%' => html_attr($arrValue[$i]),
				'%%LABEL%%' => $arrCaption[$i],
				'%%CHECKED%%' => ($arrValue[$i]==$selectedValue ? " checked" : "")
			);
			$out .= str_replace(array_keys($replacements), array_values($replacements), $template);
		}

		return $out;
	}
	########################################################################
	function htmlSelect($name, $arrValue, $arrCaption, $selectedValue, $class = '', $selectedClass = '') {
		if($selectedClass == '') {
			$selectedClass=$class;
		}
		if(is_array($arrValue)) {
			$out="<select name=\"$name\" id=\"$name\">";
			for($i = 0; $i < count($arrValue); $i++) {
				$out .= '<option value="' . $arrValue[$i] . '"' . ($arrValue[$i] == $selectedValue ? " selected class=\"$class\"" : " class=\"$selectedClass\"") . '>' . $arrCaption[$i] . '</option>';
			}
			$out .= '</select>';
		}
		return $out;
	}
	########################################################################
	function htmlSQLSelect($name, $sql, $selectedValue, $class = '', $selectedClass = '') {
		$arrVal[] = '';
		$arrCap[] = '';
		if($res = sql($sql, $eo)) {
			while($row = db_fetch_row($res)) {
				$arrVal[] = $row[0];
				$arrCap[] = $row[1];
			}
			return htmlSelect($name, $arrVal, $arrCap, $selectedValue, $class, $selectedClass);
		} else {
			return "";
		}
	}
	########################################################################
	function bootstrapSelect($name, $arrValue, $arrCaption, $selectedValue, $class = '', $selectedClass = '') {
		if($selectedClass == '') $selectedClass = $class;

		$out = "<select class=\"form-control\" name=\"{$name}\" id=\"{$name}\">";
		if(is_array($arrValue)) {
			for($i = 0; $i < count($arrValue); $i++) {
				$selected = "class=\"{$class}\"";
				if($arrValue[$i] == $selectedValue) $selected = "selected class=\"{$selectedClass}\"";
				$out .= "<option value=\"{$arrValue[$i]}\" {$selected}>{$arrCaption[$i]}</option>";
			}
		}
		$out .= '</select>';

		return $out;
	}
	########################################################################
	function bootstrapSQLSelect($name, $sql, $selectedValue, $class = '', $selectedClass = '') {
		$arrVal[] = '';
		$arrCap[] = '';
		if($res = sql($sql, $eo)) {
			while($row = db_fetch_row($res)) {
				$arrVal[] = $row[0];
				$arrCap[] = $row[1];
			}
			return bootstrapSelect($name, $arrVal, $arrCap, $selectedValue, $class, $selectedClass);
		}

		return '';
	}
	########################################################################
	function isEmail($email) {
		return filter_var(trim($email), FILTER_VALIDATE_EMAIL);
	}
	########################################################################
	function notifyMemberApproval($memberID) {
		$adminConfig = config('adminConfig');
		$memberID = strtolower($memberID);

		$email = sqlValue("select email from membership_users where lcase(memberID)='{$memberID}'");

		return sendmail(array(
			'to' => $email,
			'name' => $memberID,
			'subject' => $adminConfig['approvalSubject'],
			'message' => nl2br($adminConfig['approvalMessage'])
		));
	}
	########################################################################
	function setupMembership() {
		// run once per session, but force proceeding if not all mem tables created
		$res = sql("show tables like 'membership_%'", $eo);
		$num_mem_tables = db_num_rows($res);
		$mem_update_fn = membership_table_functions();
		if(isset($_SESSION['setupMembership']) && $num_mem_tables >= count($mem_update_fn)) return;

		/* abort if current page is one of the following exceptions */
		if(in_array(basename($_SERVER['PHP_SELF']), array(
			'pageEditMember.php', 
			'membership_passwordReset.php', 
			'membership_profile.php', 
			'membership_signup.php', 
			'pageChangeMemberStatus.php', 
			'pageDeleteGroup.php', 
			'pageDeleteMember.php', 
			'pageEditGroup.php', 
			'pageEditMemberPermissions.php', 
			'pageRebuildFields.php', 
			'pageSettings.php',
			'ajax_check_login.php'
		))) return;

		// call each update_membership function
		foreach($mem_update_fn as $mem_fn) {
			$mem_fn();
		}

		configure_anonymous_group();
		configure_admin_group();

		$_SESSION['setupMembership'] = time();
	}
	########################################################################
	function membership_table_functions() {
		// returns a list of update_membership_* functions
		$arr = get_defined_functions();
		return array_filter($arr['user'], function($f) {
			return (strpos($f, 'update_membership_') !== false);
		});
	}
	########################################################################
	function configure_anonymous_group() {
		$eo = ['silentErrors' => true];

		$adminConfig = config('adminConfig');
		$today = @date('Y-m-d');

		$anon_group_safe = makeSafe($adminConfig['anonymousGroup']);
		$anon_user = strtolower($adminConfig['anonymousMember']);
		$anon_user_safe = makeSafe($anon_user);

		/* create anonymous group if not there and get its ID */
		$same_fields = "`allowSignup`=0, `needsApproval`=0";
		sql("INSERT INTO `membership_groups` SET 
				`name`='{$anon_group_safe}', {$same_fields}, 
				`description`='Anonymous group created automatically on {$today}'
			ON DUPLICATE KEY UPDATE {$same_fields}", 
		$eo);

		$anon_group_id = sqlValue("SELECT `groupID` FROM `membership_groups` WHERE `name`='{$anon_group_safe}'");
		if(!$anon_group_id) return;

		/* create guest user if not there or if guest name in config differs from that in db */
		$anon_user_db = sqlValue("SELECT LCASE(`memberID`) FROM `membership_users` 
			WHERE `groupID`='{$anon_group_id}'");
		if(!$anon_user_db || $anon_user_db != $anon_user) {
			sql("DELETE FROM `membership_users` WHERE `groupID`='{$anon_group_id}'", $eo);
			sql("INSERT INTO `membership_users` SET 
			`memberID`='{$anon_user_safe}', 
				`signUpDate`='{$today}', 
				`groupID`='{$anon_group_id}', 
				`isBanned`=0, 
				`isApproved`=1, 
				`comments`='Anonymous member created automatically on {$today}'", 
			$eo);
		}
	}
	########################################################################
	function configure_admin_group() {
		$eo = ['silentErrors' => true];

		$adminConfig = config('adminConfig');
		$today = @date('Y-m-d');
		$admin_group_safe = 'Admins';
		$admin_user_safe = makeSafe(strtolower($adminConfig['adminUsername']));
		$admin_hash_safe = makeSafe($adminConfig['adminPassword']);
		$admin_email_safe = makeSafe($adminConfig['senderEmail']);

		/* create admin group if not there and get its ID */
		$same_fields = "`allowSignup`=0, `needsApproval`=1";
		sql("INSERT INTO `membership_groups` SET 
				`name`='{$admin_group_safe}', {$same_fields}, 
				`description`='Admin group created automatically on {$today}'
			ON DUPLICATE KEY UPDATE {$same_fields}", 
		$eo);
		$admin_group_id = sqlValue("SELECT `groupID` FROM `membership_groups` WHERE `name`='{$admin_group_safe}'");
		if(!$admin_group_id) return;

		/* create super-admin user if not there (if exists, query would abort with suppressed error) */
		sql("INSERT INTO `membership_users` SET 
			`memberID`='{$admin_user_safe}', 
			`passMD5`='{$admin_hash_safe}', 
			`email`='{$admin_email_safe}', 
			`signUpDate`='{$today}', 
			`groupID`='{$admin_group_id}', 
			`isBanned`=0, 
			`isApproved`=1, 
			`comments`='Admin member created automatically on {$today}'", 
		$eo);

		/* insert/update admin group permissions to allow full access to all tables */
		$tables = getTableList(true);
		foreach($tables as $tn => $ignore) {
			$same_fields = '`allowInsert`=1,`allowView`=3,`allowEdit`=3,`allowDelete`=3';
			sql("INSERT INTO `membership_grouppermissions` SET
					`groupID`='{$admin_group_id}',
					`tableName`='{$tn}',
					{$same_fields}
				ON DUPLICATE KEY UPDATE {$same_fields}",
			$eo);
		}
	}
	########################################################################
	function get_table_keys($tn) {
		$keys = [];
		$res = sql("SHOW KEYS FROM `{$tn}`", $eo);
		while($row = db_fetch_assoc($res))
			$keys[$row['Key_name']][$row['Seq_in_index']] = $row;

		return $keys;
	}
	########################################################################
	function get_table_fields($tn = null) {
		static $schema = null;
		if($schema === null) {
			/* application schema as created in AppGini */
			$schema = [
				'dispositivos' => [
					'codigo' => ['appgini' => "VARCHAR(4) NULL UNIQUE"],
					'id_dispo' => ['appgini' => "INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT"],
					'foto' => ['appgini' => "INT UNSIGNED NULL"],
					'code' => ['appgini' => "VARCHAR(40) NULL"],
					'serial' => ['appgini' => "VARCHAR(40) NOT NULL UNIQUE"],
					'tipo_dispositivo' => ['appgini' => "INT UNSIGNED NOT NULL"],
					'marca' => ['appgini' => "INT UNSIGNED NOT NULL"],
					'modelo' => ['appgini' => "INT UNSIGNED NOT NULL"],
					'ubicacion' => ['appgini' => "INT UNSIGNED NULL"],
					'ubicacion_abre' => ['appgini' => "INT UNSIGNED NULL"],
					'fecha_ingreso' => ['appgini' => "DATE NOT NULL"],
					'clasificacion_riesgo' => ['appgini' => "INT UNSIGNED NOT NULL"],
					'estado' => ['appgini' => "INT UNSIGNED NOT NULL"],
					'precio' => ['appgini' => "DOUBLE(10,2) NULL"],
					'creado' => ['appgini' => "DATETIME NULL"],
					'creado_por' => ['appgini' => "VARCHAR(40) NULL"],
					'editado' => ['appgini' => "DATETIME NULL"],
					'editado_por' => ['appgini' => "VARCHAR(40) NULL"],
					'id_compra_ingreso' => ['appgini' => "INT UNSIGNED NULL"],
				],
				'mobiliario' => [
					'id_mobiliario' => ['appgini' => "INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT"],
					'codigo' => ['appgini' => "VARCHAR(50) NULL"],
					'nombre' => ['appgini' => "VARCHAR(40) NULL"],
					'grupo' => ['appgini' => "INT UNSIGNED NULL"],
					'tipo_mobiliario' => ['appgini' => "INT UNSIGNED NOT NULL"],
					'descripcion' => ['appgini' => "TEXT NULL"],
					'fecha_ingreso' => ['appgini' => "DATE NOT NULL"],
					'ubicacion' => ['appgini' => "INT UNSIGNED NULL"],
					'ubicacion_abreviado' => ['appgini' => "INT UNSIGNED NULL"],
					'accesorios' => ['appgini' => "TEXT NULL"],
					'foto' => ['appgini' => "VARCHAR(40) NULL"],
					'unidad' => ['appgini' => "INT UNSIGNED NULL"],
					'uni_abreviado' => ['appgini' => "INT UNSIGNED NULL"],
					'creado' => ['appgini' => "DATETIME NULL"],
					'creado_por' => ['appgini' => "VARCHAR(40) NULL"],
					'editado' => ['appgini' => "VARCHAR(40) NULL"],
					'editado_por' => ['appgini' => "VARCHAR(40) NULL"],
					'id_compra' => ['appgini' => "VARCHAR(40) NULL"],
				],
				'contactos' => [
					'id_contactos' => ['appgini' => "INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT"],
					'tipo_contacto' => ['appgini' => "INT UNSIGNED NOT NULL"],
					'tipo_iden' => ['appgini' => "INT UNSIGNED NOT NULL"],
					'identificacion' => ['appgini' => "VARCHAR(40) NOT NULL UNIQUE"],
					'nombre' => ['appgini' => "VARCHAR(40) NOT NULL"],
					'ciudad' => ['appgini' => "INT UNSIGNED NOT NULL"],
					'telefono' => ['appgini' => "VARCHAR(30) NOT NULL"],
					'direccion' => ['appgini' => "TEXT NULL"],
					'tipo_relacion' => ['appgini' => "INT UNSIGNED NOT NULL"],
					'nota' => ['appgini' => "TEXT NOT NULL"],
					'reg_creado' => ['appgini' => "DATETIME NULL"],
					'creado' => ['appgini' => "DATETIME NULL"],
					'creado_por' => ['appgini' => "VARCHAR(40) NULL"],
					'editado' => ['appgini' => "DATETIME NULL"],
					'editado_por' => ['appgini' => "VARCHAR(40) NULL"],
				],
				'contactos_tipo_contacto' => [
					'id_tipo_contacto' => ['appgini' => "INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT"],
					'tipo_contacto' => ['appgini' => "VARCHAR(40) NOT NULL UNIQUE"],
					'descripcion' => ['appgini' => "TEXT NULL"],
				],
				'movimientos' => [
					'id_movi' => ['appgini' => "INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT"],
					'img' => ['appgini' => "INT UNSIGNED NULL"],
					'tipo_dispo' => ['appgini' => "INT UNSIGNED NULL"],
					'codigo_dispo' => ['appgini' => "INT UNSIGNED NOT NULL"],
					'serial_dispo' => ['appgini' => "INT UNSIGNED NULL"],
					'estado_movi' => ['appgini' => "INT UNSIGNED NULL"],
					'origen' => ['appgini' => "VARCHAR(40) NULL"],
					'destino' => ['appgini' => "VARCHAR(40) NULL"],
					'creado' => ['appgini' => "DATETIME NULL"],
					'creado_por' => ['appgini' => "VARCHAR(40) NULL"],
					'editado' => ['appgini' => "DATETIME NULL"],
					'editado_por' => ['appgini' => "VARCHAR(40) NULL"],
				],
				'documentos' => [
					'id' => ['appgini' => "INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT"],
					'dispo_codigo' => ['appgini' => "INT UNSIGNED NOT NULL"],
					'dispo_serial' => ['appgini' => "INT UNSIGNED NULL"],
					'tipo_docu' => ['appgini' => "INT UNSIGNED NOT NULL"],
					'enlace' => ['appgini' => "TEXT NULL"],
					'descripcion' => ['appgini' => "TEXT NOT NULL"],
					'fecha_carga' => ['appgini' => "VARCHAR(40) NULL"],
					'creado' => ['appgini' => "DATETIME NULL"],
					'creado_por' => ['appgini' => "VARCHAR(40) NULL"],
					'editado' => ['appgini' => "DATETIME NULL"],
					'editado_por' => ['appgini' => "VARCHAR(40) NULL"],
				],
				'mantenimientos' => [
					'id_mtto' => ['appgini' => "INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT"],
					'codigo' => ['appgini' => "INT UNSIGNED NOT NULL"],
					'serial' => ['appgini' => "INT UNSIGNED NULL"],
					'tipo_dispo' => ['appgini' => "INT UNSIGNED NULL"],
					'fecha_mtto' => ['appgini' => "DATE NOT NULL"],
					'tipo_mtto' => ['appgini' => "INT UNSIGNED NOT NULL"],
					'responsable' => ['appgini' => "INT UNSIGNED NOT NULL"],
					'id_responsable' => ['appgini' => "INT UNSIGNED NULL"],
					'documento' => ['appgini' => "VARCHAR(100) NULL"],
					'documento_drive' => ['appgini' => "TEXT NULL"],
					'unidad' => ['appgini' => "INT UNSIGNED NOT NULL"],
					'unidad_abreviado' => ['appgini' => "INT UNSIGNED NULL"],
					'descripcion' => ['appgini' => "TEXT NOT NULL"],
					'estado_final' => ['appgini' => "INT UNSIGNED NOT NULL"],
					'creado_por' => ['appgini' => "VARCHAR(40) NULL"],
					'editado_por' => ['appgini' => "VARCHAR(40) NULL"],
					'creado' => ['appgini' => "DATETIME NULL"],
					'editado' => ['appgini' => "DATETIME NULL"],
				],
				'calibraciones' => [
					'id' => ['appgini' => "INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT"],
					'codigo' => ['appgini' => "INT UNSIGNED NOT NULL"],
					'serial' => ['appgini' => "INT UNSIGNED NULL"],
					'tipo_calibracion' => ['appgini' => "INT UNSIGNED NOT NULL"],
					'no_documento' => ['appgini' => "VARCHAR(40) NULL"],
					'fecha_calibra' => ['appgini' => "DATE NOT NULL"],
					'fecha_expiracion' => ['appgini' => "DATE NOT NULL"],
					'empresa' => ['appgini' => "INT UNSIGNED NOT NULL"],
					'telefono' => ['appgini' => "INT UNSIGNED NULL"],
					'documento' => ['appgini' => "VARCHAR(40) NOT NULL"],
					'descripcion' => ['appgini' => "TEXT NULL"],
					'creado' => ['appgini' => "DATETIME NULL"],
					'creado_por' => ['appgini' => "VARCHAR(40) NULL"],
					'editado' => ['appgini' => "DATETIME NULL"],
					'editado_por' => ['appgini' => "VARCHAR(40) NULL"],
				],
				'unidades' => [
					'id_unidades' => ['appgini' => "INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT"],
					'nombre' => ['appgini' => "VARCHAR(40) NOT NULL UNIQUE"],
					'abreviado' => ['appgini' => "VARCHAR(40) NOT NULL UNIQUE"],
					'ciudad' => ['appgini' => "INT UNSIGNED NULL"],
					'telefono' => ['appgini' => "VARCHAR(40) NOT NULL"],
					'direccion' => ['appgini' => "TEXT NOT NULL"],
					'ubicacion' => ['appgini' => "VARCHAR(60) NULL"],
					'prestador' => ['appgini' => "INT UNSIGNED NULL"],
					'logo' => ['appgini' => "VARCHAR(40) NULL"],
					'dispositivos_costo' => ['appgini' => "DECIMAL(10,0) NULL"],
					'mobiliario_costo' => ['appgini' => "DECIMAL(10,2) NULL"],
					'costo_total' => ['appgini' => "DECIMAL(10,2) NULL"],
				],
				'marcas' => [
					'id_marca' => ['appgini' => "INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT"],
					'marca' => ['appgini' => "VARCHAR(40) NOT NULL UNIQUE"],
					'descripcion' => ['appgini' => "TEXT NULL"],
				],
				'marca_modelo' => [
					'id_mmodelo' => ['appgini' => "INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT"],
					'marca' => ['appgini' => "INT UNSIGNED NOT NULL"],
					'modelo' => ['appgini' => "VARCHAR(40) NOT NULL UNIQUE"],
					'img' => ['appgini' => "VARCHAR(40) NOT NULL"],
					'fabricante' => ['appgini' => "VARCHAR(40) NULL"],
					'descripcion' => ['appgini' => "TEXT NULL"],
					'creado' => ['appgini' => "DATETIME NULL"],
					'creado_por' => ['appgini' => "VARCHAR(40) NULL"],
				],
				'accesorios' => [
					'id' => ['appgini' => "INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT"],
					'codigo_accesorio' => ['appgini' => "VARCHAR(40) NULL"],
					'tipo_accesorio' => ['appgini' => "INT UNSIGNED NULL"],
					'nombre_accesorio' => ['appgini' => "VARCHAR(60) NOT NULL"],
					'descripcion' => ['appgini' => "TEXT NULL"],
					'id_dispo' => ['appgini' => "INT UNSIGNED NULL"],
					'creado' => ['appgini' => "DATETIME NULL"],
					'creado_por' => ['appgini' => "VARCHAR(40) NULL"],
				],
				'ciudades' => [
					'id_ciudad' => ['appgini' => "INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT"],
					'ciudad' => ['appgini' => "VARCHAR(40) NOT NULL UNIQUE"],
					'descripcion' => ['appgini' => "TEXT NULL"],
				],
				'verificacion' => [
					'id' => ['appgini' => "INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT"],
					'codigo' => ['appgini' => "INT UNSIGNED NULL"],
					'tipo_dispo' => ['appgini' => "INT UNSIGNED NULL"],
					'serial' => ['appgini' => "INT UNSIGNED NULL"],
					'ubicacion' => ['appgini' => "INT UNSIGNED NOT NULL"],
					'abreviado' => ['appgini' => "INT UNSIGNED NULL"],
					'verificacion' => ['appgini' => "VARCHAR(40) NOT NULL"],
					'comentario' => ['appgini' => "TEXT NULL"],
					'fecha_verifi' => ['appgini' => "DATETIME NULL"],
					'verifi_por' => ['appgini' => "VARCHAR(40) NULL"],
				],
				'hojadevida' => [
					'id' => ['appgini' => "INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT"],
					'dispo_codigo' => ['appgini' => "INT UNSIGNED NOT NULL"],
					'dispo_serial' => ['appgini' => "INT UNSIGNED NULL"],
					'hardware' => ['appgini' => "INT UNSIGNED NULL"],
					'software' => ['appgini' => "TEXT NULL"],
					'carga' => ['appgini' => "VARCHAR(40) NULL"],
					'creado' => ['appgini' => "DATETIME NULL"],
					'creado_por' => ['appgini' => "VARCHAR(40) NULL"],
					'editado' => ['appgini' => "DATETIME NULL"],
					'editado_por' => ['appgini' => "VARCHAR(40) NULL"],
				],
				'financiero' => [
					'id' => ['appgini' => "INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT"],
					'id_dispo' => ['appgini' => "INT UNSIGNED NULL"],
					'precio' => ['appgini' => "DECIMAL(10,0) NOT NULL"],
					'unidad' => ['appgini' => "INT UNSIGNED NULL"],
					'enlace' => ['appgini' => "TEXT NULL"],
					'creado' => ['appgini' => "DATETIME NULL"],
					'creado_por' => ['appgini' => "VARCHAR(40) NULL"],
					'editado' => ['appgini' => "DATETIME NULL"],
					'editado_por' => ['appgini' => "VARCHAR(40) NULL"],
				],
				'financiero_mobiliario' => [
					'id' => ['appgini' => "INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT"],
					'id_dispo' => ['appgini' => "INT UNSIGNED NULL"],
					'precio' => ['appgini' => "DECIMAL(10,0) NOT NULL"],
					'unidad' => ['appgini' => "INT UNSIGNED NULL"],
					'enlace' => ['appgini' => "TEXT NULL"],
					'creado' => ['appgini' => "DATETIME NULL"],
					'creado_por' => ['appgini' => "VARCHAR(40) NULL"],
					'editado' => ['appgini' => "DATETIME NULL"],
					'editado_por' => ['appgini' => "VARCHAR(40) NULL"],
				],
				'prestador' => [
					'id' => ['appgini' => "INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT"],
					'nombre' => ['appgini' => "VARCHAR(40) NOT NULL"],
					'razon_social' => ['appgini' => "INT UNSIGNED NOT NULL"],
					'nit' => ['appgini' => "INT UNSIGNED NULL"],
					'descripcion' => ['appgini' => "TEXT NULL"],
				],
				'docu_modelo' => [
					'id' => ['appgini' => "INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT"],
					'tipo_dispo' => ['appgini' => "INT UNSIGNED NULL"],
					'marca' => ['appgini' => "INT UNSIGNED NULL"],
					'modelo' => ['appgini' => "INT UNSIGNED NULL"],
					'tipo_documento' => ['appgini' => "INT UNSIGNED NULL"],
					'enlace' => ['appgini' => "VARCHAR(40) NULL"],
					'descripcion' => ['appgini' => "TEXT NULL"],
					'creado' => ['appgini' => "DATETIME NULL"],
					'creado_por' => ['appgini' => "VARCHAR(40) NULL"],
					'editado' => ['appgini' => "DATETIME NULL"],
					'editado_por' => ['appgini' => "VARCHAR(40) NULL"],
				],
				'facturas' => [
					'id' => ['appgini' => "INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT"],
					'id_dispo' => ['appgini' => "INT UNSIGNED NULL"],
					'no_factura' => ['appgini' => "VARCHAR(40) NOT NULL UNIQUE"],
					'fecha_factura' => ['appgini' => "VARCHAR(40) NOT NULL"],
					'proveedor' => ['appgini' => "INT UNSIGNED NULL"],
					'identificacion' => ['appgini' => "INT UNSIGNED NULL"],
					'enlace_doc' => ['appgini' => "TEXT NULL"],
					'creado' => ['appgini' => "DATETIME NULL"],
					'creado_por' => ['appgini' => "VARCHAR(40) NULL"],
					'editado' => ['appgini' => "DATETIME NULL"],
					'editado_por' => ['appgini' => "VARCHAR(40) NULL"],
					'id_compras' => ['appgini' => "INT UNSIGNED NULL"],
				],
				'formatos' => [
					'id' => ['appgini' => "INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT"],
					'tipo_formato' => ['appgini' => "INT UNSIGNED NOT NULL"],
					'tipo_dispositivo' => ['appgini' => "INT UNSIGNED NOT NULL"],
					'nombre_formato' => ['appgini' => "VARCHAR(50) NOT NULL"],
					'formato' => ['appgini' => "TEXT NULL"],
					'descripcion' => ['appgini' => "TEXT NULL"],
					'creado' => ['appgini' => "DATETIME NULL"],
				],
				'dispo_fuera' => [
					'id' => ['appgini' => "INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT"],
					'img' => ['appgini' => "INT UNSIGNED NULL"],
					'codigo' => ['appgini' => "INT UNSIGNED NULL"],
					'serial' => ['appgini' => "INT UNSIGNED NULL"],
					'ubicacion_final' => ['appgini' => "INT UNSIGNED NULL"],
					'tipo_fuera_servicio' => ['appgini' => "INT UNSIGNED NOT NULL"],
					'fecha_reporte' => ['appgini' => "DATE NOT NULL"],
					'descripcion' => ['appgini' => "TEXT NULL"],
					'creado' => ['appgini' => "DATETIME NULL"],
					'creado_por' => ['appgini' => "VARCHAR(40) NULL"],
					'editado' => ['appgini' => "DATETIME NULL"],
					'edtado_por' => ['appgini' => "VARCHAR(40) NULL"],
				],
				'dispositivo_tipo_grupo' => [
					'id' => ['appgini' => "INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT"],
					'grupo' => ['appgini' => "VARCHAR(40) NOT NULL UNIQUE"],
					'descripcion' => ['appgini' => "TEXT NULL"],
				],
				'tipo_relacion' => [
					'id_tiporelac' => ['appgini' => "INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT"],
					'tipo_relac' => ['appgini' => "VARCHAR(40) NOT NULL UNIQUE"],
					'descripcion' => ['appgini' => "TEXT NULL"],
					'creado' => ['appgini' => "DATETIME NULL"],
				],
				'tipo_dispositivo' => [
					'id_tipodispo' => ['appgini' => "INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT"],
					'tipo_dispositivo' => ['appgini' => "VARCHAR(40) NOT NULL UNIQUE"],
					'grupo_dispo' => ['appgini' => "INT UNSIGNED NOT NULL"],
					'prefijo' => ['appgini' => "VARCHAR(40) NOT NULL"],
					'descripcion' => ['appgini' => "TEXT NULL"],
				],
				'tipo_documento' => [
					'id_tipodoc' => ['appgini' => "INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT"],
					'tipo_doc' => ['appgini' => "VARCHAR(40) NOT NULL UNIQUE"],
					'grupo' => ['appgini' => "INT UNSIGNED NULL"],
					'descripcion' => ['appgini' => "TEXT NULL"],
				],
				'tipo_iden' => [
					'id_iden' => ['appgini' => "INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT"],
					'tipo_iden' => ['appgini' => "VARCHAR(40) NOT NULL UNIQUE"],
					'tipo_iden_abre' => ['appgini' => "VARCHAR(40) NOT NULL UNIQUE"],
				],
				'tipo_razon_social' => [
					'id' => ['appgini' => "INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT"],
					'razon_social' => ['appgini' => "VARCHAR(40) NOT NULL UNIQUE"],
					'nit' => ['appgini' => "VARCHAR(40) NULL"],
					'descripcion' => ['appgini' => "TEXT NULL"],
				],
				'tipo_mobiliario' => [
					'id' => ['appgini' => "INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT"],
					'grupo_mobi' => ['appgini' => "INT UNSIGNED NULL"],
					'tipo_mobiliario' => ['appgini' => "VARCHAR(40) NOT NULL"],
					'caracteristicas' => ['appgini' => "TEXT NULL"],
				],
				'tipo_grupo_mobilia' => [
					'id_gru_mo' => ['appgini' => "INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT"],
					'grupo' => ['appgini' => "VARCHAR(40) NOT NULL"],
					'prefijo' => ['appgini' => "VARCHAR(40) NULL"],
					'descripcion' => ['appgini' => "TEXT NULL"],
				],
				'tipo_estado_dispo' => [
					'id' => ['appgini' => "INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT"],
					'estado_dispo' => ['appgini' => "VARCHAR(40) NOT NULL"],
					'descripcion' => ['appgini' => "TEXT NULL"],
				],
				'tipo_movimiento' => [
					'id' => ['appgini' => "INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT"],
					'tipo_movimiento' => ['appgini' => "VARCHAR(40) NOT NULL UNIQUE"],
					'descripcion' => ['appgini' => "TEXT NULL"],
				],
				'tipo_estado_movi' => [
					'id' => ['appgini' => "INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT"],
					'estado_movi' => ['appgini' => "VARCHAR(40) NOT NULL UNIQUE"],
					'descripcion' => ['appgini' => "TEXT NULL"],
				],
				'tipo_estado_verifica' => [
					'id' => ['appgini' => "INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT"],
					'estado_verificado' => ['appgini' => "VARCHAR(40) NOT NULL UNIQUE"],
					'descripcion' => ['appgini' => "TEXT NULL"],
				],
				'tipo_mtto' => [
					'id' => ['appgini' => "INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT"],
					'tipo_mtto' => ['appgini' => "VARCHAR(40) NOT NULL UNIQUE"],
					'descripcion' => ['appgini' => "TEXT NULL"],
				],
				'tipo_calibracion' => [
					'id' => ['appgini' => "INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT"],
					'tipo_calibracion' => ['appgini' => "VARCHAR(40) NOT NULL UNIQUE"],
					'descripcion' => ['appgini' => "TEXT NULL"],
				],
				'tipo_accesorio' => [
					'id' => ['appgini' => "INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT"],
					'tipo_accesorio' => ['appgini' => "VARCHAR(40) NOT NULL"],
					'prefijo' => ['appgini' => "VARCHAR(40) NULL"],
					'descripcion' => ['appgini' => "TEXT NULL"],
				],
				'tipo_formatos' => [
					'id' => ['appgini' => "INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT"],
					'tipo_formato' => ['appgini' => "VARCHAR(60) NOT NULL"],
					'descripcion' => ['appgini' => "TEXT NULL"],
				],
				'dispo_detalles_tecnicos' => [
					'id' => ['appgini' => "INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT"],
					'id_dispo' => ['appgini' => "INT UNSIGNED NULL"],
					'detalles' => ['appgini' => "TEXT NULL"],
					'creado' => ['appgini' => "DATETIME NULL"],
				],
				'tipo_estado_observaciones' => [
					'id' => ['appgini' => "INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT"],
					'estado_observa' => ['appgini' => "VARCHAR(40) NOT NULL"],
					'descripcion' => ['appgini' => "TEXT NOT NULL"],
				],
				'movi_envio' => [
					'id' => ['appgini' => "INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT"],
					'id_movi' => ['appgini' => "INT UNSIGNED NULL"],
					'fecha_envio' => ['appgini' => "DATE NOT NULL"],
					'origen' => ['appgini' => "INT UNSIGNED NULL"],
					'ubicacion' => ['appgini' => "INT UNSIGNED NULL"],
					'destino' => ['appgini' => "VARCHAR(100) NOT NULL"],
					'd_direccion' => ['appgini' => "TEXT NULL"],
					'ciudad' => ['appgini' => "INT UNSIGNED NOT NULL"],
					'nombre' => ['appgini' => "INT UNSIGNED NOT NULL"],
					'telefono' => ['appgini' => "INT UNSIGNED NULL"],
					'detalles' => ['appgini' => "TEXT NULL"],
					'creado' => ['appgini' => "DATETIME NULL"],
					'creado_por' => ['appgini' => "VARCHAR(40) NULL"],
					'editado' => ['appgini' => "DATETIME NULL"],
					'editado_por' => ['appgini' => "VARCHAR(40) NULL"],
				],
				'movi_recepcion' => [
					'id' => ['appgini' => "INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT"],
					'id_movi' => ['appgini' => "INT UNSIGNED NULL"],
					'fecha_recepcion' => ['appgini' => "DATE NOT NULL"],
					'destino' => ['appgini' => "INT UNSIGNED NOT NULL"],
					'o_direccion' => ['appgini' => "INT UNSIGNED NULL"],
					'ciudad' => ['appgini' => "INT UNSIGNED NULL"],
					'verificado' => ['appgini' => "TEXT NOT NULL"],
					'nombre' => ['appgini' => "INT UNSIGNED NOT NULL"],
					'telefono' => ['appgini' => "INT UNSIGNED NULL"],
					'detalles' => ['appgini' => "TEXT NULL"],
					'creado' => ['appgini' => "DATETIME NULL"],
					'creado_por' => ['appgini' => "VARCHAR(40) NULL"],
					'editado' => ['appgini' => "DATETIME NULL"],
					'editado_por' => ['appgini' => "VARCHAR(40) NULL"],
				],
				'tipo_fuera_servicio' => [
					'id' => ['appgini' => "INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT"],
					'tipo_fuera_servicio' => ['appgini' => "VARCHAR(40) NOT NULL"],
					'descripcion' => ['appgini' => "TEXT NULL"],
				],
				'tipo_documento_ss' => [
					'id_tipodoc' => ['appgini' => "INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT"],
					'tipo_doc' => ['appgini' => "VARCHAR(40) NOT NULL UNIQUE"],
					'descripcion' => ['appgini' => "TEXT NULL"],
				],
				'tipo_parentesco' => [
					'id' => ['appgini' => "INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT"],
					'parentesco' => ['appgini' => "VARCHAR(40) NOT NULL"],
					'descripcion' => ['appgini' => "VARCHAR(40) NULL"],
				],
				'tipo_rh' => [
					'id' => ['appgini' => "INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT"],
					'tipo_rh' => ['appgini' => "VARCHAR(40) NULL"],
				],
				'accesorio_dispo_relacion' => [
					'id' => ['appgini' => "INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT"],
					'id_dispo' => ['appgini' => "INT UNSIGNED NULL"],
					'id_accesorio' => ['appgini' => "INT UNSIGNED NULL"],
					'tipo_dispo' => ['appgini' => "INT UNSIGNED NULL"],
					'serial' => ['appgini' => "INT UNSIGNED NULL"],
					'marca_modelo' => ['appgini' => "INT UNSIGNED NULL"],
					'creado' => ['appgini' => "DATETIME NULL"],
					'creado_por' => ['appgini' => "VARCHAR(40) NULL"],
				],
				'observaciones' => [
					'id' => ['appgini' => "INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT"],
					'estado_observacion' => ['appgini' => "INT UNSIGNED NULL"],
					'estado' => ['appgini' => "INT UNSIGNED NOT NULL"],
					'codigo' => ['appgini' => "INT UNSIGNED NULL"],
					'tipo_dispo' => ['appgini' => "INT UNSIGNED NULL"],
					'serial' => ['appgini' => "INT UNSIGNED NULL"],
					'unidad' => ['appgini' => "INT UNSIGNED NOT NULL"],
					'observacion' => ['appgini' => "TEXT NOT NULL"],
					'creado' => ['appgini' => "DATETIME NULL"],
					'creado_por' => ['appgini' => "VARCHAR(40) NULL"],
				],
				'foto_observacion' => [
					'id' => ['appgini' => "INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT"],
					'id_observacion' => ['appgini' => "INT UNSIGNED NULL"],
					'foto' => ['appgini' => "VARCHAR(40) NOT NULL"],
					'descripcion' => ['appgini' => "TEXT NOT NULL"],
					'creado' => ['appgini' => "DATETIME NULL"],
					'creado_por' => ['appgini' => "VARCHAR(40) NULL"],
				],
				'progreso' => [
					'id' => ['appgini' => "INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT"],
					'id_observacion' => ['appgini' => "INT UNSIGNED NULL"],
					'estado_seguimiento' => ['appgini' => "INT UNSIGNED NOT NULL"],
					'descripcion' => ['appgini' => "TEXT NOT NULL"],
					'credo' => ['appgini' => "DATETIME NULL"],
					'creado_por' => ['appgini' => "VARCHAR(40) NULL"],
				],
				'tipo_estado_observa' => [
					'id' => ['appgini' => "INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT"],
					'tipo_estado_observa' => ['appgini' => "VARCHAR(40) NULL"],
					'descripcion' => ['appgini' => "VARCHAR(40) NULL"],
				],
				'acceso_remoto' => [
					'id' => ['appgini' => "INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT"],
					'unidad' => ['appgini' => "INT UNSIGNED NOT NULL"],
					'ciudad' => ['appgini' => "INT UNSIGNED NULL"],
					'servicio' => ['appgini' => "TEXT NULL"],
					'anydesk' => ['appgini' => "VARCHAR(40) NOT NULL UNIQUE"],
					'acceso' => ['appgini' => "VARCHAR(40) NOT NULL"],
					'teamviewer' => ['appgini' => "VARCHAR(40) NULL"],
					'acceso2' => ['appgini' => "VARCHAR(40) NULL"],
					'codigo_equipo' => ['appgini' => "INT UNSIGNED NULL"],
					'equipo' => ['appgini' => "INT UNSIGNED NULL"],
					'ultima_verifica' => ['appgini' => "DATE NOT NULL"],
					'comentario' => ['appgini' => "TEXT NULL"],
					'creado' => ['appgini' => "DATETIME NULL"],
					'creado_por' => ['appgini' => "VARCHAR(40) NULL"],
					'editado' => ['appgini' => "DATETIME NULL"],
					'editado_por' => ['appgini' => "VARCHAR(40) NULL"],
				],
				'tipo_periodicidad' => [
					'id' => ['appgini' => "INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT"],
					'periodicidad' => ['appgini' => "VARCHAR(40) NOT NULL"],
					'descripcion' => ['appgini' => "VARCHAR(40) NULL"],
				],
				'perfil' => [
					'id' => ['appgini' => "INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT"],
					'usuario' => ['appgini' => "VARCHAR(40) NULL"],
					'nombre' => ['appgini' => "VARCHAR(40) NOT NULL"],
					'apellidos' => ['appgini' => "VARCHAR(40) NOT NULL"],
					'tipo_id' => ['appgini' => "INT UNSIGNED NOT NULL"],
					'numero_id' => ['appgini' => "VARCHAR(40) NOT NULL UNIQUE"],
					'dato2' => ['appgini' => "VARCHAR(40) NULL"],
					'fecha_nacimiento' => ['appgini' => "DATE NOT NULL"],
					'telefono' => ['appgini' => "VARCHAR(40) NOT NULL"],
					'celular' => ['appgini' => "VARCHAR(40) NOT NULL"],
					'rh' => ['appgini' => "INT UNSIGNED NULL"],
					'foto_perfil' => ['appgini' => "VARCHAR(40) NULL"],
					'estado_civil' => ['appgini' => "VARCHAR(40) NULL"],
					'direccion' => ['appgini' => "TEXT NULL"],
					'optimo' => ['appgini' => "VARCHAR(40) NULL"],
					'creado' => ['appgini' => "DATETIME NULL"],
					'creado_por' => ['appgini' => "VARCHAR(40) NULL"],
					'grupo' => ['appgini' => "VARCHAR(40) NULL"],
					'estado' => ['appgini' => "VARCHAR(40) NULL"],
				],
				'consentimieto' => [
					'id' => ['appgini' => "INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT"],
					'id_perfil' => ['appgini' => "INT UNSIGNED NULL"],
					'identificacion' => ['appgini' => "INT UNSIGNED NULL"],
					'acepto' => ['appgini' => "VARCHAR(40) NOT NULL"],
					'creado' => ['appgini' => "DATETIME NULL"],
					'creado_por' => ['appgini' => "VARCHAR(40) NULL"],
				],
				'perfil_familia' => [
					'id' => ['appgini' => "INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT"],
					'id_perfil' => ['appgini' => "INT UNSIGNED NULL"],
					'identificacion' => ['appgini' => "INT UNSIGNED NULL"],
					'parentesco' => ['appgini' => "INT UNSIGNED NULL"],
					'nombre' => ['appgini' => "VARCHAR(40) NOT NULL"],
					'telefono' => ['appgini' => "VARCHAR(40) NOT NULL"],
					'direccion' => ['appgini' => "TEXT NULL"],
					'creado' => ['appgini' => "DATETIME NULL"],
					'creado_por' => ['appgini' => "VARCHAR(40) NULL"],
				],
				'perfil_soportes' => [
					'id' => ['appgini' => "INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT"],
					'id_perfil' => ['appgini' => "INT UNSIGNED NULL"],
					'tipo_documento' => ['appgini' => "INT UNSIGNED NULL"],
					'nombre_documento' => ['appgini' => "VARCHAR(40) NULL"],
					'docuemento' => ['appgini' => "VARCHAR(40) NULL"],
					'creado' => ['appgini' => "DATETIME NULL"],
					'creado_por' => ['appgini' => "VARCHAR(40) NULL"],
				],
				'seguridad_social' => [
					'id' => ['appgini' => "INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT"],
					'id_perfil' => ['appgini' => "INT UNSIGNED NULL"],
					'tipo_documento' => ['appgini' => "INT UNSIGNED NULL"],
					'docuemento' => ['appgini' => "VARCHAR(40) NULL"],
					'descripcion' => ['appgini' => "TEXT NULL"],
					'creado' => ['appgini' => "DATETIME NULL"],
					'creado_por' => ['appgini' => "VARCHAR(40) NULL"],
				],
				'costos_mtto' => [
					'id' => ['appgini' => "INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT"],
					'id_mtto' => ['appgini' => "INT UNSIGNED NULL"],
					'tipo_costo' => ['appgini' => "INT UNSIGNED NULL"],
					'precio' => ['appgini' => "DECIMAL(10,2) NOT NULL"],
					'cantidad' => ['appgini' => "INT NOT NULL"],
					'descripcion' => ['appgini' => "TEXT NOT NULL"],
					'creado' => ['appgini' => "DATETIME NULL"],
					'creado_por' => ['appgini' => "VARCHAR(40) NULL"],
				],
				'tipo_costo' => [
					'id' => ['appgini' => "INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT"],
					'tipo_costo' => ['appgini' => "VARCHAR(40) NOT NULL"],
					'descripcion' => ['appgini' => "VARCHAR(40) NULL"],
				],
				'doc_mtto' => [
					'id_doc' => ['appgini' => "INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT"],
					'doc' => ['appgini' => "TEXT NULL"],
					'id_mtto' => ['appgini' => "INT UNSIGNED NULL"],
					'tipo_mtto' => ['appgini' => "INT UNSIGNED NULL"],
					'mtto' => ['appgini' => "INT UNSIGNED NULL"],
					'observaciones' => ['appgini' => "VARCHAR(40) NULL"],
					'nombre_biomedico' => ['appgini' => "INT UNSIGNED NULL"],
					'registro_invima' => ['appgini' => "INT UNSIGNED NULL"],
					'firma_biomedico' => ['appgini' => "INT UNSIGNED NULL"],
					'creado' => ['appgini' => "DATETIME NULL"],
					'creado_por' => ['appgini' => "VARCHAR(40) NULL"],
				],
				'biomedicos' => [
					'id' => ['appgini' => "INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT"],
					'id_contacto' => ['appgini' => "INT UNSIGNED NULL"],
					'nombre' => ['appgini' => "INT UNSIGNED NULL"],
					'registro_invima' => ['appgini' => "VARCHAR(40) NULL"],
					'nota' => ['appgini' => "TEXT NULL"],
					'firma' => ['appgini' => "VARCHAR(40) NULL"],
				],
				'tipo_clasifica_riesgo' => [
					'id' => ['appgini' => "INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT"],
					'clase' => ['appgini' => "VARCHAR(40) NOT NULL"],
					'nivel_riesgo' => ['appgini' => "VARCHAR(40) NOT NULL"],
					'ejemplo' => ['appgini' => "TEXT NULL"],
					'nota' => ['appgini' => "VARCHAR(40) NULL"],
				],
				'programa_mtto' => [
					'id' => ['appgini' => "INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT"],
					'unidad' => ['appgini' => "INT UNSIGNED NULL"],
					'ano' => ['appgini' => "INT NULL"],
					'descripcion' => ['appgini' => "TEXT NULL"],
					'enlace' => ['appgini' => "TEXT NULL"],
					'archivo' => ['appgini' => "VARCHAR(40) NULL"],
					'creado' => ['appgini' => "DATETIME NULL"],
					'creado_por' => ['appgini' => "VARCHAR(40) NULL"],
				],
				'cronograma_mtto' => [
					'id' => ['appgini' => "INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT"],
					'id_programa' => ['appgini' => "INT UNSIGNED NULL"],
					'ano' => ['appgini' => "INT UNSIGNED NULL"],
					'codigo' => ['appgini' => "INT UNSIGNED NULL"],
					'tipo_dispo' => ['appgini' => "INT UNSIGNED NULL"],
					'marca' => ['appgini' => "INT UNSIGNED NULL"],
					'modelo' => ['appgini' => "INT UNSIGNED NULL"],
					'periodicidad' => ['appgini' => "INT UNSIGNED NULL"],
					'meses' => ['appgini' => "TEXT NOT NULL"],
					'biomedico' => ['appgini' => "VARCHAR(40) NULL"],
					'actividades' => ['appgini' => "VARCHAR(40) NULL"],
					'creado' => ['appgini' => "DATETIME NULL"],
					'creado_por' => ['appgini' => "VARCHAR(40) NULL"],
				],
				'compras' => [
					'id' => ['appgini' => "INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT"],
					'tipo_compra' => ['appgini' => "INT UNSIGNED NOT NULL"],
					'fecha_compra' => ['appgini' => "DATE NOT NULL"],
					'comprador' => ['appgini' => "VARCHAR(40) NULL"],
					'resumen' => ['appgini' => "TEXT NULL"],
					'estado' => ['appgini' => "INT UNSIGNED NULL"],
					'creado' => ['appgini' => "DATETIME NULL"],
					'creado_por' => ['appgini' => "VARCHAR(40) NULL"],
				],
				'tipo_estado_compra' => [
					'id' => ['appgini' => "INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT"],
					'tipo_estado_compra' => ['appgini' => "VARCHAR(40) NULL"],
					'descripcion' => ['appgini' => "VARCHAR(40) NULL"],
				],
				'cantidad_dispomedico' => [
					'id' => ['appgini' => "INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT"],
					'nombre_dispo' => ['appgini' => "INT UNSIGNED NOT NULL"],
					'serial' => ['appgini' => "INT UNSIGNED NULL"],
					'marca_modelo' => ['appgini' => "INT UNSIGNED NULL"],
					'descripcion' => ['appgini' => "INT UNSIGNED NULL"],
					'uso' => ['appgini' => "TEXT NULL"],
					'estado' => ['appgini' => "INT UNSIGNED NULL"],
					'id_compra' => ['appgini' => "INT UNSIGNED NULL"],
					'creado' => ['appgini' => "DATETIME NULL"],
					'creado_por' => ['appgini' => "VARCHAR(40) NULL"],
				],
				'cantidad_articulos' => [
					'id' => ['appgini' => "INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT"],
					'nombre_articulo' => ['appgini' => "INT UNSIGNED NOT NULL"],
					'presentacion' => ['appgini' => "INT UNSIGNED NULL"],
					'descripcion' => ['appgini' => "INT UNSIGNED NULL"],
					'serial' => ['appgini' => "INT UNSIGNED NULL"],
					'cantidad' => ['appgini' => "INT NOT NULL"],
					'estado' => ['appgini' => "INT UNSIGNED NULL"],
					'id_compras' => ['appgini' => "INT UNSIGNED NULL"],
					'creado' => ['appgini' => "DATETIME NULL"],
					'tipo_compra' => ['appgini' => "INT UNSIGNED NULL"],
					'creado_por' => ['appgini' => "VARCHAR(40) NULL"],
				],
				'cantidad_mobiliario' => [
					'id' => ['appgini' => "INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT"],
					'nombre_mobiliario' => ['appgini' => "INT UNSIGNED NOT NULL"],
					'descripcion' => ['appgini' => "INT UNSIGNED NULL"],
					'estado' => ['appgini' => "INT UNSIGNED NULL"],
					'id_compra' => ['appgini' => "INT UNSIGNED NULL"],
					'creado' => ['appgini' => "DATETIME NULL"],
					'creado_por' => ['appgini' => "VARCHAR(40) NULL"],
				],
				'compra_dispo' => [
					'id' => ['appgini' => "INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT"],
					'foto' => ['appgini' => "INT UNSIGNED NULL"],
					'nombre' => ['appgini' => "VARCHAR(40) NULL"],
					'serial' => ['appgini' => "VARCHAR(40) NOT NULL UNIQUE"],
					'tipo_dispositivo' => ['appgini' => "INT UNSIGNED NOT NULL"],
					'marca' => ['appgini' => "INT UNSIGNED NOT NULL"],
					'modelo' => ['appgini' => "INT UNSIGNED NOT NULL"],
					'caracteristicas' => ['appgini' => "VARCHAR(40) NULL"],
					'estado' => ['appgini' => "INT UNSIGNED NOT NULL"],
					'riesgo' => ['appgini' => "INT UNSIGNED NULL"],
					'precio' => ['appgini' => "DOUBLE(10,2) NULL"],
					'creado' => ['appgini' => "DATETIME NULL"],
					'creado_por' => ['appgini' => "VARCHAR(40) NULL"],
				],
				'articulos' => [
					'id' => ['appgini' => "INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT"],
					'codigo' => ['appgini' => "VARCHAR(50) NULL"],
					'nombre_unico' => ['appgini' => "VARCHAR(40) NULL"],
					'tipo_dispo' => ['appgini' => "INT UNSIGNED NULL"],
					'marca' => ['appgini' => "INT UNSIGNED NULL"],
					'modelo' => ['appgini' => "INT UNSIGNED NULL"],
					'presentacion' => ['appgini' => "INT UNSIGNED NOT NULL"],
					'serial' => ['appgini' => "VARCHAR(40) NULL UNIQUE"],
					'referencia' => ['appgini' => "VARCHAR(40) NULL UNIQUE"],
					'familia' => ['appgini' => "INT UNSIGNED NULL"],
					'codigo_proveedor' => ['appgini' => "INT UNSIGNED NULL"],
					'caracteristicas' => ['appgini' => "TEXT NULL"],
					'nota' => ['appgini' => "VARCHAR(40) NULL"],
					'ubicacion' => ['appgini' => "INT UNSIGNED NULL"],
					'ubicacion_abreviado' => ['appgini' => "INT UNSIGNED NULL"],
					'imagen' => ['appgini' => "INT UNSIGNED NULL"],
					'estado' => ['appgini' => "INT UNSIGNED NULL"],
					'creado' => ['appgini' => "DATETIME NULL"],
					'creado_por' => ['appgini' => "VARCHAR(40) NULL"],
				],
				'cofig' => [
					'id' => ['appgini' => "INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT"],
					'dato1' => ['appgini' => "VARCHAR(40) NULL"],
					'dato2' => ['appgini' => "VARCHAR(40) NULL"],
					'descripcion' => ['appgini' => "TEXT NULL"],
				],
				'marca_presetacion' => [
					'id' => ['appgini' => "INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT"],
					'marca' => ['appgini' => "INT UNSIGNED NULL"],
					'unidad_medida' => ['appgini' => "INT UNSIGNED NULL"],
					'presentacion' => ['appgini' => "VARCHAR(40) NOT NULL"],
				],
				'tipo_document_grupo' => [
					'id' => ['appgini' => "INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT"],
					'grupo' => ['appgini' => "VARCHAR(40) NULL"],
					'descripcion' => ['appgini' => "VARCHAR(40) NULL"],
				],
				'tipo_pago' => [
					'id' => ['appgini' => "INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT"],
					'tipo_pago' => ['appgini' => "VARCHAR(40) NULL"],
					'descripcion' => ['appgini' => "VARCHAR(40) NULL"],
				],
				'tipo_compra' => [
					'id' => ['appgini' => "INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT"],
					'tipo_compra' => ['appgini' => "VARCHAR(40) NULL"],
					'descripcion' => ['appgini' => "VARCHAR(40) NULL"],
				],
				'articulos_familia' => [
					'id' => ['appgini' => "INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT"],
					'codigo' => ['appgini' => "VARCHAR(40) NULL"],
					'familia' => ['appgini' => "VARCHAR(40) NULL"],
					'proveedor' => ['appgini' => "VARCHAR(40) NULL"],
				],
				'articulo_codigo_proveedor' => [
					'id' => ['appgini' => "INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT"],
					'familia' => ['appgini' => "INT UNSIGNED NULL"],
					'codigo' => ['appgini' => "VARCHAR(40) NULL"],
					'proveedor' => ['appgini' => "VARCHAR(40) NULL"],
				],
				'tipo_unidad_medida' => [
					'id' => ['appgini' => "INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT"],
					'unidad' => ['appgini' => "VARCHAR(40) NULL"],
					'nota' => ['appgini' => "VARCHAR(40) NULL"],
				],
				'genera_documentos' => [
					'id' => ['appgini' => "INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT"],
					'tipo_documento_entrega' => ['appgini' => "VARCHAR(40) NULL"],
					'ciudad' => ['appgini' => "INT UNSIGNED NULL"],
					'fecha' => ['appgini' => "DATE NOT NULL"],
					'entidad' => ['appgini' => "INT UNSIGNED NULL"],
					'referencia' => ['appgini' => "VARCHAR(40) NULL"],
					'descripcion' => ['appgini' => "TEXT NULL"],
					'conslusion' => ['appgini' => "TEXT NULL"],
					'creado' => ['appgini' => "DATE NULL"],
					'creado_por' => ['appgini' => "VARCHAR(40) NULL"],
				],
				'verificacion_articulos' => [
					'id' => ['appgini' => "INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT"],
					'codigo' => ['appgini' => "INT UNSIGNED NULL"],
					'tipo_dispo' => ['appgini' => "INT UNSIGNED NULL"],
					'nombre' => ['appgini' => "INT UNSIGNED NULL"],
					'serial' => ['appgini' => "INT UNSIGNED NULL"],
					'ubicacion' => ['appgini' => "INT UNSIGNED NOT NULL"],
					'abreviado' => ['appgini' => "INT UNSIGNED NULL"],
					'verificacion' => ['appgini' => "VARCHAR(40) NOT NULL"],
					'comentario' => ['appgini' => "TEXT NULL"],
					'fecha_verifi' => ['appgini' => "DATETIME NULL"],
					'verifi_por' => ['appgini' => "VARCHAR(40) NULL"],
				],
				'movimientos_articulos' => [
					'id_movi' => ['appgini' => "INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT"],
					'img' => ['appgini' => "INT UNSIGNED NULL"],
					'tipo_dispo' => ['appgini' => "INT UNSIGNED NULL"],
					'nombre' => ['appgini' => "INT UNSIGNED NOT NULL"],
					'serial_dispo' => ['appgini' => "INT UNSIGNED NULL"],
					'estado_movi' => ['appgini' => "INT UNSIGNED NULL"],
					'origen' => ['appgini' => "VARCHAR(40) NULL"],
					'destino' => ['appgini' => "VARCHAR(40) NULL"],
					'creado' => ['appgini' => "DATETIME NULL"],
					'creado_por' => ['appgini' => "VARCHAR(40) NULL"],
					'editado' => ['appgini' => "DATETIME NULL"],
					'editado_por' => ['appgini' => "VARCHAR(40) NULL"],
				],
				'movi_envio_articulo' => [
					'id' => ['appgini' => "INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT"],
					'id_movi' => ['appgini' => "INT UNSIGNED NULL"],
					'fecha_envio' => ['appgini' => "DATE NOT NULL"],
					'origen' => ['appgini' => "INT UNSIGNED NULL"],
					'ubicacion' => ['appgini' => "INT UNSIGNED NULL"],
					'destino' => ['appgini' => "VARCHAR(100) NOT NULL"],
					'd_direccion' => ['appgini' => "TEXT NULL"],
					'ciudad' => ['appgini' => "INT UNSIGNED NOT NULL"],
					'nombre' => ['appgini' => "INT UNSIGNED NOT NULL"],
					'telefono' => ['appgini' => "INT UNSIGNED NULL"],
					'detalles' => ['appgini' => "TEXT NULL"],
					'creado' => ['appgini' => "DATETIME NULL"],
					'creado_por' => ['appgini' => "VARCHAR(40) NULL"],
					'editado' => ['appgini' => "DATETIME NULL"],
					'editado_por' => ['appgini' => "VARCHAR(40) NULL"],
				],
				'movi_recepcion_articulos' => [
					'id' => ['appgini' => "INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT"],
					'id_movi' => ['appgini' => "INT UNSIGNED NULL"],
					'fecha_recepcion' => ['appgini' => "DATE NOT NULL"],
					'destino' => ['appgini' => "INT UNSIGNED NOT NULL"],
					'o_direccion' => ['appgini' => "INT UNSIGNED NULL"],
					'ciudad' => ['appgini' => "INT UNSIGNED NULL"],
					'verificado' => ['appgini' => "TEXT NOT NULL"],
					'nombre' => ['appgini' => "INT UNSIGNED NOT NULL"],
					'telefono' => ['appgini' => "INT UNSIGNED NULL"],
					'detalles' => ['appgini' => "TEXT NULL"],
					'creado' => ['appgini' => "DATETIME NULL"],
					'creado_por' => ['appgini' => "VARCHAR(40) NULL"],
					'editado' => ['appgini' => "DATETIME NULL"],
					'editado_por' => ['appgini' => "VARCHAR(40) NULL"],
				],
				'ubicacion_articulo' => [
					'id' => ['appgini' => "INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT"],
					'id_articulo' => ['appgini' => "INT UNSIGNED NULL"],
					'ubicacion' => ['appgini' => "INT UNSIGNED NOT NULL"],
					'nota' => ['appgini' => "TEXT NULL"],
					'creado' => ['appgini' => "DATETIME NULL"],
					'creado_por' => ['appgini' => "VARCHAR(40) NULL"],
				],
				'ubicacion_mobiliario' => [
					'id' => ['appgini' => "INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT"],
					'id_mobiliario' => ['appgini' => "INT UNSIGNED NULL"],
					'ubicacion' => ['appgini' => "INT UNSIGNED NOT NULL"],
					'creado' => ['appgini' => "DATETIME NULL"],
					'creado_por' => ['appgini' => "VARCHAR(40) NULL"],
					'nota' => ['appgini' => "TEXT NULL"],
				],
				'precio_dispo_medico' => [
					'id' => ['appgini' => "INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT"],
					'dispo_medico' => ['appgini' => "INT UNSIGNED NULL"],
					'precio' => ['appgini' => "VARCHAR(40) NULL"],
					'proveedor' => ['appgini' => "VARCHAR(40) NULL"],
				],
				'precio_articulo' => [
					'id' => ['appgini' => "INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT"],
					'articulo' => ['appgini' => "VARCHAR(40) NULL"],
					'precio' => ['appgini' => "VARCHAR(40) NULL"],
					'proveedor' => ['appgini' => "VARCHAR(40) NULL"],
				],
				'precio_mobiliario' => [
					'id' => ['appgini' => "INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT"],
					'mobiliario' => ['appgini' => "VARCHAR(40) NULL"],
					'precio' => ['appgini' => "VARCHAR(40) NULL"],
					'proveedor' => ['appgini' => "VARCHAR(40) NULL"],
				],
			];
		}

		if($tn === null) return $schema;

		return isset($schema[$tn]) ? $schema[$tn] : [];
	}
	########################################################################
	function update_membership_groups() {
		$tn = 'membership_groups';
		$eo = ['silentErrors' => true];

		sql(
			"CREATE TABLE IF NOT EXISTS `{$tn}` (
				`groupID` INT UNSIGNED NOT NULL AUTO_INCREMENT,
				`name` varchar(100) NOT NULL,
				`description` TEXT,
				`allowSignup` TINYINT,
				`needsApproval` TINYINT,
				`allowCSVImport` TINYINT NOT NULL DEFAULT '0',
				PRIMARY KEY (`groupID`)
			) CHARSET " . mysql_charset,
		$eo);

		sql("ALTER TABLE `{$tn}` CHANGE COLUMN `name` `name` VARCHAR(100) NOT NULL", $eo);
		sql("ALTER TABLE `{$tn}` ADD UNIQUE INDEX `name` (`name`)", $eo);
		sql("ALTER TABLE `{$tn}` ADD COLUMN `allowCSVImport` TINYINT NOT NULL DEFAULT '0'", $eo);
	}
	########################################################################
	function update_membership_users() {
		$tn = 'membership_users';
		$eo = ['silentErrors' => true];

		sql(
			"CREATE TABLE IF NOT EXISTS `{$tn}` (
				`memberID` VARCHAR(100) NOT NULL, 
				`passMD5` VARCHAR(255), 
				`email` VARCHAR(100), 
				`signupDate` DATE, 
				`groupID` INT UNSIGNED, 
				`isBanned` TINYINT, 
				`isApproved` TINYINT, 
				`custom1` TEXT, 
				`custom2` TEXT, 
				`custom3` TEXT, 
				`custom4` TEXT, 
				`comments` TEXT, 
				`pass_reset_key` VARCHAR(100),
				`pass_reset_expiry` INT UNSIGNED,
				`allowCSVImport` TINYINT NOT NULL DEFAULT '0', 
				PRIMARY KEY (`memberID`),
				INDEX `groupID` (`groupID`)
			) CHARSET " . mysql_charset,
		$eo);

		sql("ALTER TABLE `{$tn}` ADD COLUMN `pass_reset_key` VARCHAR(100)", $eo);
		sql("ALTER TABLE `{$tn}` ADD COLUMN `pass_reset_expiry` INT UNSIGNED", $eo);
		sql("ALTER TABLE `{$tn}` CHANGE COLUMN `passMD5` `passMD5` VARCHAR(255)", $eo);
		sql("ALTER TABLE `{$tn}` CHANGE COLUMN `memberID` `memberID` VARCHAR(100) NOT NULL", $eo);
		sql("ALTER TABLE `{$tn}` ADD INDEX `groupID` (`groupID`)", $eo);
		sql("ALTER TABLE `{$tn}` ADD COLUMN `flags` TEXT", $eo);
		sql("ALTER TABLE `{$tn}` ADD COLUMN `allowCSVImport` TINYINT NOT NULL DEFAULT '0'", $eo);
	}
	########################################################################
	function update_membership_userrecords() {
		$tn = 'membership_userrecords';
		$eo = ['silentErrors' => true];

		sql(
			"CREATE TABLE IF NOT EXISTS `{$tn}` (
				`recID` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT, 
				`tableName` VARCHAR(100), 
				`pkValue` VARCHAR(255), 
				`memberID` VARCHAR(100), 
				`dateAdded` BIGINT UNSIGNED, 
				`dateUpdated` BIGINT UNSIGNED, 
				`groupID` INT UNSIGNED, 
				PRIMARY KEY (`recID`),
				UNIQUE INDEX `tableName_pkValue` (`tableName`, `pkValue`(150)),
				INDEX `pkValue` (`pkValue`),
				INDEX `tableName` (`tableName`),
				INDEX `memberID` (`memberID`),
				INDEX `groupID` (`groupID`)
			) CHARSET " . mysql_charset,
		$eo);

		sql("ALTER TABLE `{$tn}` ADD UNIQUE INDEX `tableName_pkValue` (`tableName`, `pkValue`(150))", $eo);
		sql("ALTER TABLE `{$tn}` ADD INDEX `pkValue` (`pkValue`)", $eo);
		sql("ALTER TABLE `{$tn}` ADD INDEX `tableName` (`tableName`)", $eo);
		sql("ALTER TABLE `{$tn}` ADD INDEX `memberID` (`memberID`)", $eo);
		sql("ALTER TABLE `{$tn}` ADD INDEX `groupID` (`groupID`)", $eo);
		sql("ALTER TABLE `{$tn}` CHANGE COLUMN `memberID` `memberID` VARCHAR(100)", $eo);
	}
	########################################################################
	function update_membership_grouppermissions() {
		$tn = 'membership_grouppermissions';
		$eo = ['silentErrors' => true];

		sql(
			"CREATE TABLE IF NOT EXISTS `{$tn}` (
				`permissionID` INT UNSIGNED NOT NULL AUTO_INCREMENT,
				`groupID` INT UNSIGNED,
				`tableName` VARCHAR(100),
				`allowInsert` TINYINT NOT NULL DEFAULT '0',
				`allowView` TINYINT NOT NULL DEFAULT '0',
				`allowEdit` TINYINT NOT NULL DEFAULT '0',
				`allowDelete` TINYINT NOT NULL DEFAULT '0',
				PRIMARY KEY (`permissionID`)
			) CHARSET " . mysql_charset,
		$eo);

		sql("ALTER TABLE `{$tn}` ADD UNIQUE INDEX `groupID_tableName` (`groupID`, `tableName`)", $eo);
	}
	########################################################################
	function update_membership_userpermissions() {
		$tn = 'membership_userpermissions';
		$eo = ['silentErrors' => true];

		sql(
			"CREATE TABLE IF NOT EXISTS `{$tn}` (
				`permissionID` INT UNSIGNED NOT NULL AUTO_INCREMENT,
				`memberID` VARCHAR(100) NOT NULL,
				`tableName` VARCHAR(100),
				`allowInsert` TINYINT NOT NULL DEFAULT '0',
				`allowView` TINYINT NOT NULL DEFAULT '0',
				`allowEdit` TINYINT NOT NULL DEFAULT '0',
				`allowDelete` TINYINT NOT NULL DEFAULT '0',
				PRIMARY KEY (`permissionID`)
			) CHARSET " . mysql_charset,
		$eo);

		sql("ALTER TABLE `{$tn}` CHANGE COLUMN `memberID` `memberID` VARCHAR(100) NOT NULL", $eo);
		sql("ALTER TABLE `{$tn}` ADD UNIQUE INDEX `memberID_tableName` (`memberID`, `tableName`)", $eo);
	}
	########################################################################
	function update_membership_usersessions() {
		$tn = 'membership_usersessions';
		$eo = ['silentErrors' => true];

		sql(
			"CREATE TABLE IF NOT EXISTS `membership_usersessions` (
				`memberID` VARCHAR(100) NOT NULL,
				`token` VARCHAR(100) NOT NULL,
				`agent` VARCHAR(100) NOT NULL,
				`expiry_ts` INT(10) UNSIGNED NOT NULL,
				UNIQUE INDEX `memberID_token_agent` (`memberID`, `token`, `agent`),
				INDEX `memberID` (`memberID`),
				INDEX `expiry_ts` (`expiry_ts`)
			) CHARSET " . mysql_charset,
		$eo);
	}
	########################################################################
	function thisOr($this_val, $or = '&nbsp;') {
		return ($this_val != '' ? $this_val : $or);
	}
	########################################################################
	function getUploadedFile($FieldName, $MaxSize=0, $FileTypes='csv|txt', $NoRename=false, $dir='') {
		$currDir=dirname(__FILE__);
		if(is_array($_FILES)) {
			$f = $_FILES[$FieldName];
		} else {
			return 'Your php settings don\'t allow file uploads.';
		}

		if(!$MaxSize) {
			$MaxSize=toBytes(ini_get('upload_max_filesize'));
		}

		if(!is_dir("$currDir/csv")) {
			@mkdir("$currDir/csv");
		}

		$dir=(is_dir($dir) && is_writable($dir) ? $dir : "$currDir/csv/");

		if($f['error']!=4 && $f['name']!='') {
			if($f['size']>$MaxSize || $f['error']) {
				return 'File size exceeds maximum allowed of '.intval($MaxSize / 1024).'KB';
			}
			if(!preg_match('/\.('.$FileTypes.')$/i', $f['name'], $ft)) {
				return 'File type not allowed. Only these file types are allowed: '.str_replace('|', ', ', $FileTypes);
			}

			if($NoRename) {
				$n  = str_replace(' ', '_', $f['name']);
			} else {
				$n  = microtime();
				$n  = str_replace(' ', '_', $n);
				$n  = str_replace('0.', '', $n);
				$n .= $ft[0];
			}

			if(!@move_uploaded_file($f['tmp_name'], $dir . $n)) {
				return 'Couldn\'t save the uploaded file. Try chmoding the upload folder "'.$dir.'" to 777.';
			} else {
				@chmod($dir.$n, 0666);
				return $dir.$n;
			}
		}
		return 'An error occured while uploading the file. Please try again.';
	}
	########################################################################
	function toBytes($val) {
		$val = trim($val);
		$last = strtolower($val[strlen($val)-1]);
		switch($last) {
			 // The 'G' modifier is available since PHP 5.1.0
			 case 'g':
					$val *= 1024;
			 case 'm':
					$val *= 1024;
			 case 'k':
					$val *= 1024;
		}

		return $val;
	}
	########################################################################
	function convertLegacyOptions($CSVList) {
		$CSVList=str_replace(';;;', ';||', $CSVList);
		$CSVList=str_replace(';;', '||', $CSVList);
		return trim($CSVList, '|');
	}
	########################################################################
	function getValueGivenCaption($query, $caption) {
		if(!preg_match('/select\s+(.*?)\s*,\s*(.*?)\s+from\s+(.*?)\s+order by.*/i', $query, $m)) {
			if(!preg_match('/select\s+(.*?)\s*,\s*(.*?)\s+from\s+(.*)/i', $query, $m)) {
				return '';
			}
		}

		// get where clause if present
		if(preg_match('/\s+from\s+(.*?)\s+where\s+(.*?)\s+order by.*/i', $query, $mw)) {
			$where = "where ({$mw[2]}) AND";
			$m[3] = $mw[1];
		} else {
			$where = 'where';
		}

		$caption = makeSafe($caption);
		return sqlValue("SELECT {$m[1]} FROM {$m[3]} {$where} {$m[2]}='{$caption}'");
	}
	########################################################################
	function time24($t = false) {
		if($t === false) $t = date('Y-m-d H:i:s'); // time now if $t not passed
		elseif(!$t) return ''; // empty string if $t empty
		return date('H:i:s', strtotime($t));
	}
	########################################################################
	function time12($t = false) {
		if($t === false) $t = date('Y-m-d H:i:s'); // time now if $t not passed
		elseif(!$t) return ''; // empty string if $t empty
		return date('h:i:s A', strtotime($t));
	}
	########################################################################
	function normalize_path($path) {
		// Adapted from https://developer.wordpress.org/reference/functions/wp_normalize_path/

		// Standardise all paths to use /
		$path = str_replace('\\', '/', $path);

		// Replace multiple slashes down to a singular, allowing for network shares having two slashes.
		$path = preg_replace('|(?<=.)/+|', '/', $path);

		// Windows paths should uppercase the drive letter
		if(':' === substr($path, 1, 1)) {
			$path = ucfirst($path);
		}

		return $path;
	}
	########################################################################
	function application_url($page = '', $s = false) {
		if($s === false) $s = $_SERVER;
		$ssl = (!empty($s['HTTPS']) && strtolower($s['HTTPS']) != 'off');
		$http = ($ssl ? 'https:' : 'http:');
		$port = $s['SERVER_PORT'];
		$port = ($port == '80' || $port == '443' || !$port) ? '' : ':' . $port;
		// HTTP_HOST already includes server port if not standard, but SERVER_NAME doesn't
		$host = (isset($s['HTTP_HOST']) ? $s['HTTP_HOST'] : $s['SERVER_NAME'] . $port);

		$uri = config('appURI');
		if(!$uri) $uri = '/';

		// uri must begin and end with /, but not be '//'
		if($uri != '/' && $uri[0] != '/') $uri = "/{$uri}";
		if($uri != '/' && $uri[strlen($uri) - 1] != '/') $uri = "{$uri}/";

		return "{$http}//{$host}{$uri}{$page}";
	}
	########################################################################
	function application_uri($page = '') {
		$url = application_url($page);
		return trim(parse_url($url, PHP_URL_PATH), '/');
	}
	########################################################################
	function is_ajax() {
		return (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest');
	}
	########################################################################
	function array_trim($arr) {
		if(!is_array($arr)) return trim($arr);
		return array_map('array_trim', $arr);
	}
	########################################################################
	function is_allowed_username($username, $exception = false) {
		$username = trim(strtolower($username));
		if(!preg_match('/^[a-z0-9][a-z0-9 _.@]{3,100}$/', $username) || preg_match('/(@@|  |\.\.|___)/', $username)) return false;

		if($username == $exception) return $username;

		if(sqlValue("select count(1) from membership_users where lcase(memberID)='{$username}'")) return false;
		return $username;
	}
	########################################################################
	/*
		if called without parameters, looks for a non-expired token in the user's session (or creates one if
		none found) and returns html code to insert into the form to be protected.

		if set to true, validates token sent in $_REQUEST against that stored in the session
		and returns true if valid or false if invalid, absent or expired.

		usage:
			1. in a new form that needs csrf proofing: echo csrf_token();
			   >> in case of ajax requests and similar, retrieve token directly
			      by calling csrf_token(false, true);
			2. when validating a submitted form: if(!csrf_token(true)) { reject_submission_somehow(); }
	*/
	function csrf_token($validate = false, $token_only = false) {
		$token_age = 60 * 60;
		/* retrieve token from session */
		$csrf_token = (isset($_SESSION['csrf_token']) ? $_SESSION['csrf_token'] : false);
		$csrf_token_expiry = (isset($_SESSION['csrf_token_expiry']) ? $_SESSION['csrf_token_expiry'] : false);

		if(!$validate) {
			/* create a new token if necessary */
			if($csrf_token_expiry < time() || !$csrf_token) {
				$csrf_token = md5(uniqid(rand(), true));
				$csrf_token_expiry = time() + $token_age;
				$_SESSION['csrf_token'] = $csrf_token;
				$_SESSION['csrf_token_expiry'] = $csrf_token_expiry;
			}

			if($token_only) return $csrf_token;
			return '<input type="hidden" id="csrf_token" name="csrf_token" value="' . $csrf_token . '">';
		}

		/* validate submitted token */
		$user_token = (isset($_REQUEST['csrf_token']) ? $_REQUEST['csrf_token'] : false);
		if($csrf_token_expiry < time() || !$user_token || $user_token != $csrf_token) {
			return false;
		}

		return true;
	}
	########################################################################
	function get_plugins() {
		$plugins = [];
		$plugins_path = dirname(__FILE__) . '/../plugins/';

		if(!is_dir($plugins_path)) return $plugins;

		$pd = dir($plugins_path);
		while(false !== ($plugin = $pd->read())) {
			if(!is_dir($plugins_path . $plugin) || in_array($plugin, array('projects', 'plugins-resources', '.', '..'))) continue;

			$info_file = "{$plugins_path}{$plugin}/plugin-info.json";
			if(!is_file($info_file)) continue;

			$plugins[] = json_decode(file_get_contents($info_file), true);
			$plugins[count($plugins) - 1]['admin_path'] = "../plugins/{$plugin}";
		}
		$pd->close();

		return $plugins;
	}
	########################################################################
	function maintenance_mode($new_status = '') {
		$maintenance_file = dirname(__FILE__) . '/.maintenance';

		if($new_status === true) {
			/* turn on maintenance mode */
			@touch($maintenance_file);
		} elseif($new_status === false) {
			/* turn off maintenance mode */
			@unlink($maintenance_file);
		}

		/* return current maintenance mode status */
		return is_file($maintenance_file);
	}
	########################################################################
	function handle_maintenance($echo = false) {
		if(!maintenance_mode()) return;

		global $Translation;
		$adminConfig = config('adminConfig');

		$admin = getLoggedAdmin();
		if($admin) {
			return ($echo ? '<div class="alert alert-danger" style="margin: 5em auto -5em;"><b>' . $Translation['maintenance mode admin notification'] . '</b></div>' : '');
		}

		if(!$echo) exit;

		exit('<div class="alert alert-danger" style="margin-top: 5em; font-size: 2em;"><i class="glyphicon glyphicon-exclamation-sign"></i> ' . $adminConfig['maintenance_mode_message'] . '</div>');
	}
	#########################################################
	function html_attr($str) {
		if(version_compare(PHP_VERSION, '5.2.3') >= 0) return htmlspecialchars($str, ENT_QUOTES, datalist_db_encoding, false);
		return htmlspecialchars($str, ENT_QUOTES, datalist_db_encoding);
	}
	#########################################################
	function html_attr_tags_ok($str) {
		// use this instead of html_attr() if you don't want html tags to be escaped
		$new_str = html_attr($str);
		return str_replace(array('&lt;', '&gt;'), array('<', '>'), $new_str);
	}
	#########################################################
	class Notification{
		/*
			Usage:
			* in the main document, initiate notifications support using this PHP code:
				echo Notification::placeholder();

			* whenever you want to show a notifcation, use this PHP code:
				echo Notification::show(array(
					'message' => 'Notification text to display',
					'class' => 'danger', // or other bootstrap state cues, 'default' if not provided
					'dismiss_seconds' => 5, // optional auto-dismiss after x seconds
					'dismiss_days' => 7, // optional dismiss for x days if closed by user -- must provide an id
					'id' => 'xyz' // optional string to identify the notification -- must use for 'dismiss_days' to work
				));
		*/
		protected static $placeholder_id; /* to force a single notifcation placeholder */

		protected function __construct() {} /* to prevent initialization */

		public static function placeholder() {
			if(self::$placeholder_id) return ''; // output placeholder code only once

			self::$placeholder_id = 'notifcation-placeholder-' . rand(10000000, 99999999);

			ob_start();
			?>

			<div class="notifcation-placeholder" id="<?php echo self::$placeholder_id; ?>"></div>
			<script>
				$j(function() {
					if(window.show_notification != undefined) return;

					window.show_notification = function(options) {
						var dismiss_class = '';
						var dismiss_icon = '';
						var cookie_name = 'hide_notification_' + options.id;
						var notif_id = 'notifcation-' + Math.ceil(Math.random() * 1000000);

						/* apply provided notficiation id if unique in page */
						if(options.id != undefined) {
							if(!$j('#' + options.id).length) notif_id = options.id;
						}

						/* notifcation should be hidden? */
						if(localStorage.getItem(cookie_name) != undefined) return;

						/* notification should be dismissable? */
						if(options.dismiss_seconds > 0 || options.dismiss_days > 0) {
							dismiss_class = ' alert-dismissible';
							dismiss_icon = '<button type="button" class="close" data-dismiss="alert">&times;</button>';
						}

						/* remove old dismissed notficiations */
						$j('.alert-dismissible.invisible').remove();

						/* append notification to notifications container */
						$j(
							'<div class="alert alert-' + options['class'] + dismiss_class + '" id="' + notif_id + '">' + 
								dismiss_icon +
								options.message + 
							'</div>'
						).appendTo('#<?php echo self::$placeholder_id; ?>');

						var this_notif = $j('#' + notif_id);

						/* dismiss after x seconds if requested */
						if(options.dismiss_seconds > 0) {
							setTimeout(function() { this_notif.addClass('invisible'); }, options.dismiss_seconds * 1000);
						}

						/* dismiss for x days if requested and user dismisses it */
						if(options.dismiss_days > 0) {
							var ex_days = options.dismiss_days;
							this_notif.on('closed.bs.alert', function() {
								/* set a cookie not to show this alert for ex_days */
								localStorage.setItem(cookie_name, '1');
							});
						}
					}
				})
			</script>

			<?php
			$html = ob_get_contents();
			ob_end_clean();

			return $html;            
		}

		protected static function default_options(&$options) {
			if(!isset($options['message'])) $options['message'] = 'Notification::show() called without a message!';

			if(!isset($options['class'])) $options['class'] = 'default';

			if(!isset($options['dismiss_seconds']) || isset($options['dismiss_days'])) $options['dismiss_seconds'] = 0;

			if(!isset($options['dismiss_days'])) $options['dismiss_days'] = 0;
			if(!isset($options['id'])) {
				$options['id'] = 0;
				$options['dismiss_days'] = 0;
			}
		}

		/**
		 *  @brief Notification::show($options) displays a notification
		 *  
		 *  @param $options assoc array
		 *  
		 *  @return html code for displaying the notifcation
		 */
		public static function show($options = []) {
			self::default_options($options);

			ob_start();
			?>
			<script>
				$j(function() {
					show_notification(<?php echo json_encode($options); ?>);
				})
			</script>
			<?php
			$html = ob_get_contents();
			ob_end_clean();

			return $html;
		}
	}
	#########################################################
	function addMailRecipients(&$pm, $recipients, $type = 'to') {
		if(empty($recipients)) return;

		switch(strtolower($type)) {
			case 'cc':
				$func = [$pm, 'addCC'];
				break;
			case 'bcc':
				$func = [$pm, 'addBCC'];
				break;
			case 'to':
				$func = [$pm, 'addAddress'];
				break;
		}

		// if recipients is a str, arrayify it!
		if(is_string($recipients)) $recipients = [[$recipients]];
		if(!is_array($recipients)) return;

		// if recipients is an array, loop thru and add emails/names
		foreach ($recipients as $rcpt) {
			// if rcpt is string, add as email
			if(is_string($rcpt) && isEmail($rcpt))
				call_user_func_array($func, [$rcpt]);

			// else if rcpt is array [email, name], or just [email]
			elseif(is_array($rcpt) && isEmail($rcpt[0]))
				call_user_func_array($func, [$rcpt[0], empty($rcpt[1]) ? '' : $rcpt[1]]);
		}
	}
	#########################################################
	function sendmail($mail) {
		if(empty($mail['to'])) return 'No recipient defined';

		// convert legacy 'to' and 'name' to new format [[to, name]]
		if(is_string($mail['to']))
			$mail['to'] = [
				[
					$mail['to'], 
					empty($mail['name']) ? '' : $mail['name']
				]
			];

		if(!isEmail($mail['to'][0][0])) return 'Invalid recipient email';

		$cfg = config('adminConfig');
		$smtp = ($cfg['mail_function'] == 'smtp');

		if(!class_exists('PHPMailer', false)) {
			$curr_dir = dirname(__FILE__);
			include_once("{$curr_dir}/../resources/PHPMailer/class.phpmailer.php");
			if($smtp) include_once("{$curr_dir}/../resources/PHPMailer/class.smtp.php");
		}

		$pm = new PHPMailer;
		$pm->CharSet = datalist_db_encoding;

		if($smtp) {
			$pm->isSMTP();
			$pm->SMTPDebug = isset($mail['debug']) ? min(4, max(0, intval($mail['debug']))) : 0;
			$pm->Debugoutput = 'html';
			$pm->Host = $cfg['smtp_server'];
			$pm->Port = $cfg['smtp_port'];
			$pm->SMTPAuth = true;
			$pm->SMTPSecure = $cfg['smtp_encryption'];
			$pm->Username = $cfg['smtp_user'];
			$pm->Password = $cfg['smtp_pass'];
		}

		$pm->setFrom($cfg['senderEmail'], $cfg['senderName']);
		$pm->Subject = isset($mail['subject']) ? $mail['subject'] : '';

		// handle recipients
		addMailRecipients($pm, $mail['to']);
		if(!empty($mail['cc'])) addMailRecipients($pm, $mail['cc'], 'cc');
		if(!empty($mail['bcc'])) addMailRecipients($pm, $mail['bcc'], 'bcc');

		/* if message already contains html tags, don't apply nl2br */
		$mail['message'] = isset($mail['message']) ? $mail['message'] : '';
		if($mail['message'] == strip_tags($mail['message']))
			$mail['message'] = nl2br($mail['message']);

		$pm->msgHTML($mail['message'], realpath("{$curr_dir}/.."));

		/*
		 * pass 'tag' as-is if provided in $mail .. 
		 * this is useful for passing any desired values to sendmail_handler
		 */
		if(!empty($mail['tag'])) $pm->tag = $mail['tag'];

		/* if sendmail_handler(&$pm) is defined (in hooks/__global.php) */
		if(function_exists('sendmail_handler')) sendmail_handler($pm);

		if(!$pm->send()) return $pm->ErrorInfo;

		return true;
	}
	#########################################################
	function safe_html($str, $noBr = false) {
		/* if $str has no HTML tags, apply nl2br */
		if($str == strip_tags($str)) return $noBr ? $str : nl2br($str);

		$hc = new CI_Input(datalist_db_encoding);
		return $hc->xss_clean(bgStyleToClass($str));
	}
	#########################################################
	function getLoggedGroupID() {
		if($_SESSION['memberGroupID'] != '') {
			return $_SESSION['memberGroupID'];
		} else {
			if(!setAnonymousAccess()) return false;
			return getLoggedGroupID();
		}
	}
	#########################################################
	function getLoggedMemberID() {
		if($_SESSION['memberID']!='') {
			return strtolower($_SESSION['memberID']);
		} else {
			if(!setAnonymousAccess()) return false;
			return getLoggedMemberID();
		}
	}
	#########################################################
	function setAnonymousAccess() {
		$adminConfig = config('adminConfig');
		$anon_group_safe = addslashes($adminConfig['anonymousGroup']);
		$anon_user_safe = strtolower(addslashes($adminConfig['anonymousMember']));

		$eo = ['silentErrors' => true];

		$res = sql("select groupID from membership_groups where name='{$anon_group_safe}'", $eo);
		if(!$res) { return false; }
		$row = db_fetch_array($res); $anonGroupID = $row[0];

		$_SESSION['memberGroupID'] = ($anonGroupID ? $anonGroupID : 0);

		$res = sql("select lcase(memberID) from membership_users where lcase(memberID)='{$anon_user_safe}' and groupID='{$anonGroupID}'", $eo);
		if(!$res) { return false; }
		$row = db_fetch_array($res); $anonMemberID = $row[0];

		$_SESSION['memberID'] = ($anonMemberID ? $anonMemberID : 0);

		return true;
	}
	#########################################################
	function getMemberInfo($memberID = '') {
		static $member_info = [];

		if(!$memberID) {
			$memberID = getLoggedMemberID();
		}

		// return cached results, if present
		if(isset($member_info[$memberID])) return $member_info[$memberID];

		$adminConfig = config('adminConfig');
		$mi = [];

		if($memberID) {
			$res = sql("select * from membership_users where memberID='" . makeSafe($memberID) . "'", $eo);
			if($row = db_fetch_assoc($res)) {
				$mi = array(
					'username' => $memberID,
					'groupID' => $row['groupID'],
					'group' => sqlValue("select name from membership_groups where groupID='{$row['groupID']}'"),
					'admin' => ($adminConfig['adminUsername'] == $memberID ? true : false),
					'email' => $row['email'],
					'custom' => array(
						$row['custom1'], 
						$row['custom2'], 
						$row['custom3'], 
						$row['custom4']
					),
					'banned' => ($row['isBanned'] ? true : false),
					'approved' => ($row['isApproved'] ? true : false),
					'signupDate' => @date('n/j/Y', @strtotime($row['signupDate'])),
					'comments' => $row['comments'],
					'IP' => $_SERVER['REMOTE_ADDR']
				);

				// cache results
				$member_info[$memberID] = $mi;
			}
		}

		return $mi;
	}
	#########################################################
	function get_group_id($user = '') {
		$mi = getMemberInfo($user);
		return $mi['groupID'];
	}
	#########################################################
	/**
	 *  @brief Prepares data for a SET or WHERE clause, to be used in an INSERT/UPDATE query
	 *  
	 *  @param [in] $set_array Assoc array of field names => values
	 *  @param [in] $glue optional glue. Set to ' AND ' or ' OR ' if preparing a WHERE clause
	 *  @return SET string
	 */
	function prepare_sql_set($set_array, $glue = ', ') {
		$fnvs = [];
		foreach($set_array as $fn => $fv) {
			if($fv === null) { $fnvs[] = "{$fn}=NULL"; continue; }

			$sfv = makeSafe($fv);
			$fnvs[] = "{$fn}='{$sfv}'";
		}
		return implode($glue, $fnvs);
	}
	#########################################################
	/**
	 *  @brief Inserts a record to the database
	 *  
	 *  @param [in] $tn table name where the record would be inserted
	 *  @param [in] $set_array Assoc array of field names => values to be inserted
	 *  @param [out] $error optional string containing error message if insert fails
	 *  @return boolean indicating success/failure
	 */
	function insert($tn, $set_array, &$error = '') {
		$set = prepare_sql_set($set_array);
		if(!$set) return false;

		$eo = ['silentErrors' => true];
		$res = sql("INSERT INTO `{$tn}` SET {$set}", $eo);
		if($res) return true;

		$error = $eo['error'];
		return false;
	}
	#########################################################
	/**
	 *  @brief Updates a record in the database
	 *  
	 *  @param [in] $tn table name where the record would be updated
	 *  @param [in] $set_array Assoc array of field names => values to be updated
	 *  @param [in] $where_array Assoc array of field names => values used to build the WHERE clause
	 *  @param [out] $error optional string containing error message if insert fails
	 *  @return boolean indicating success/failure
	 */
	function update($tn, $set_array, $where_array, &$error = '') {
		$set = prepare_sql_set($set_array);
		if(!$set) return false;

		$where = prepare_sql_set($where_array, ' AND ');
		if(!$where) $where = '1=1';

		$eo = ['silentErrors' => true];
		$res = sql("UPDATE `{$tn}` SET {$set} WHERE {$where}", $eo);
		if($res) return true;

		$error = $eo['error'];
		return false;
	}
	#########################################################
	/**
	 *  @brief Set/update the owner of given record
	 *  
	 *  @param [in] $tn name of table
	 *  @param [in] $pk primary key value
	 *  @param [in] $user username to set as owner. If not provided (or false), update dateUpdated only
	 *  @return boolean indicating success/failure
	 */
	function set_record_owner($tn, $pk, $user = false) {
		$fields = [
			'memberID' => strtolower($user),
			'dateUpdated' => time(),
			'groupID' => get_group_id($user)
		];

		// don't update user if false
		if($user === false) unset($fields['memberID'], $fields['groupID']);

		$where_array = ['tableName' => $tn, 'pkValue' => $pk];
		$where = prepare_sql_set($where_array, ' AND ');
		if(!$where) return false;

		/* do we have an existing ownership record? */
		$res = sql("SELECT * FROM `membership_userrecords` WHERE {$where}", $eo);
		if($row = db_fetch_assoc($res)) {
			if($row['memberID'] == $user) return true; // owner already set to $user

			/* update owner and/or dateUpdated */
			$res = update('membership_userrecords', backtick_keys_once($fields), $where_array);
			return ($res ? true : false);
		}

		/* add new ownership record */
		$fields = array_merge($fields, $where_array, ['dateAdded' => time()]);
		$res = insert('membership_userrecords', backtick_keys_once($fields));
		return ($res ? true : false);
	}
	#########################################################
	/**
	 *  @brief get date/time format string for use in different cases.
	 *  
	 *  @param [in] $destination string, one of these: 'php' (see date function), 'mysql', 'moment'
	 *  @param [in] $datetime string, one of these: 'd' = date, 't' = time, 'dt' = both
	 *  @return string
	 */
	function app_datetime_format($destination = 'php', $datetime = 'd') {
		switch(strtolower($destination)) {
			case 'mysql':
				$date = '%d/%m/%Y';
				$time = '%h:%i:%s %p';
				break;
			case 'moment':
				$date = 'DD/MM/YYYY';
				$time = 'hh:mm:ss A';
				break;
			default: // php
				$date = 'd/m/Y';
				$time = 'h:i:s A';
		}

		$datetime = strtolower($datetime);
		if($datetime == 'dt' || $datetime == 'td') return "{$date} {$time}";
		if($datetime == 't') return $time;
		return $date;
	}
	#########################################################
	/**
	 *  @brief perform a test and return results
	 *  
	 *  @param [in] $subject string used as title of test
	 *  @param [in] $test callable function containing the test to be performed, should return true on success, false or a log string on error
	 *  @return test result
	 */
	function test($subject, $test) {
		ob_start();
		$result = $test();
		if($result === true) {
			echo "<div class=\"alert alert-success vspacer-sm\" style=\"padding: 0.2em;\"><i class=\"glyphicon glyphicon-ok hspacer-lg\"></i> {$subject}</div>";
			return ob_get_clean();
		}

		$log = '';
		if($result !== false) $log = "<pre style=\"margin-left: 2em; padding: 0.2em;\">{$result}</pre>";
		echo "<div class=\"alert alert-danger vspacer-sm\" style=\"padding: 0.2em;\"><i class=\"glyphicon glyphicon-remove hspacer-lg\"></i> <span class=\"text-bold\">{$subject}</span>{$log}</div>";
		return ob_get_clean();
	}
	#########################################################
	/**
	 *  @brief invoke a method of an object -- useful to call private/protected methods
	 *  
	 *  @param [in] $object instance of object containing the method
	 *  @param [in] $methodName string name of method to invoke
	 *  @param [in] $parameters array of parameters to pass to the method
	 *  @return the returned value from the invoked method
	 */
	function invoke_method(&$object, $methodName, array $parameters = []) {
		$reflection = new ReflectionClass(get_class($object));
		$method = $reflection->getMethod($methodName);
		$method->setAccessible(true);

		return $method->invokeArgs($object, $parameters);
	}
	#########################################################
	/**
	 *  @brief retrieve the value of a property of an object -- useful to retrieve private/protected props
	 *  
	 *  @param [in] $object instance of object containing the method
	 *  @param [in] $propName string name of property to retrieve
	 *  @return the returned value of the given property, or null if property doesn't exist
	 */
	function get_property(&$object, $propName) {
		$reflection = new ReflectionClass(get_class($object));
		try {
			$prop = $reflection->getProperty($propName);
		} catch(Exception $e) {
			return null;
		}

		$prop->setAccessible(true);

		return $prop->getValue($object);
	}

	#########################################################
	/**
	 *  @brief invoke a method of a static class -- useful to call private/protected methods
	 *  
	 *  @param [in] $class string name of the class containing the method
	 *  @param [in] $methodName string name of method to invoke
	 *  @param [in] $parameters array of parameters to pass to the method
	 *  @return the returned value from the invoked method
	 */
	function invoke_static_method($class, $methodName, array $parameters = []) {
		$reflection = new ReflectionClass($class);
		$method = $reflection->getMethod($methodName);
		$method->setAccessible(true);

		return $method->invokeArgs(null, $parameters);
	}
	#########################################################
	/**
	 *  @param [in] $app_datetime string, a datetime formatted in app-specific format
	 *  @return string, mysql-formatted datetime, 'yyyy-mm-dd H:i:s', or empty string on error
	 */
	function mysql_datetime($app_datetime, $date_format = null, $time_format = null) {
		$app_datetime = trim($app_datetime);

		if($date_format === null) $date_format = app_datetime_format('php', 'd');
		$date_separator = $date_format[1];
		if($time_format === null) $time_format = app_datetime_format('php', 't');
		$time24 = (strpos($time_format, 'H') !== false); // true if $time_format is 24hr rather than 12

		$date_regex = str_replace(
			array('Y', 'm', 'd', '/', '.'),
			array('([0-9]{4})', '(1[012]|0?[1-9])', '([12][0-9]|3[01]|0?[1-9])', '\/', '\.'),
			$date_format
		);

		$time_regex = str_replace(
			array('H', 'h', ':i', ':s'),
			array(
				'(1[0-9]|2[0-3]|0?[0-9])', 
				'(1[012]|0?[0-9])', 
				'(:([1-5][0-9]|0?[0-9]))', 
				'(:([1-5][0-9]|0?[0-9]))?'
			),
			$time_format
		);
		if(stripos($time_regex, ' a'))
			$time_regex = str_replace(array(' a', ' A'), '\s*(am|pm|a|p)?', $time_regex);
		else
			$time_regex = str_replace(array('a', 'A'), '\s*(am|pm|a|p)?', $time_regex);

		// extract date and time
		$time = '';
		$mat = [];
		$regex = "/^({$date_regex})(\s+{$time_regex})?$/i";
		$valid_dt = preg_match($regex, $app_datetime, $mat);
		if(!$valid_dt || count($mat) < 5) return ''; // invlaid datetime
		// if we have a time, get it and change 'a' or 'p' at the end to 'am'/'pm'
		if(count($mat) >= 8) $time = preg_replace('/(a|p)$/i', '$1m', trim($mat[5]));

		// extract date elements from regex match, given 1st 2 items are full string and full date
		$date_order = str_replace($date_separator, '', $date_format);
		$day = $mat[stripos($date_order, 'd') + 2];
		$month = $mat[stripos($date_order, 'm') + 2];
		$year = $mat[stripos($date_order, 'y') + 2];

		// convert time to 24hr format if necessary
		if($time && !$time24) $time = date('H:i:s', strtotime("2000-01-01 {$time}"));

		$mysql_datetime = trim("{$year}-{$month}-{$day} {$time}");

		// strtotime handles dates between 1902 and 2037 only
		// so we need another test date for dates outside this range ...
		$test = $mysql_datetime;
		if($year < 1902 || $year > 2037) $test = str_replace($year, '2000', $mysql_datetime);

		return (strtotime($test) ? $mysql_datetime : '');
	}
	#########################################################
	/**
	 *  @param [in] $mysql_datetime string, Mysql-formatted datetime
	 *  @param [in] $datetime string, one of these: 'd' = date, 't' = time, 'dt' = both
	 *  @return string, app-formatted datetime, or empty string on error
	 *  
	 *  @details works for formatting date, time and datetime, based on 2nd param
	 */  
	function app_datetime($mysql_datetime, $datetime = 'd') {
		$pyear = $myear = substr($mysql_datetime, 0, 4);

		// if date is 0 (0000-00-00) return empty string
		if(!$mysql_datetime || substr($mysql_datetime, 0, 10) == '0000-00-00') return '';

		// strtotime handles dates between 1902 and 2037 only
		// so we need a temp date for dates outside this range ...
		if($myear < 1902 || $myear > 2037) $pyear = 2000;
		$mysql_datetime = str_replace($myear, $pyear, $mysql_datetime);

		$ts = strtotime($mysql_datetime);
		if(!$ts) return '';

		$pdate = date(app_datetime_format('php', $datetime), $ts);
		return str_replace($pyear, $myear, $pdate);
	}
	#########################################################
	/**
	 *  @brief converts string from app-configured encoding to utf8
	 *  
	 *  @param [in] $str string to convert to utf8
	 *  @return utf8-encoded string
	 *  
	 *  @details if the constant 'datalist_db_encoding' is not defined, original string is returned
	 */
	function to_utf8($str) {
		if(!defined('datalist_db_encoding')) return $str;
		if(datalist_db_encoding == 'UTF-8') return $str;
		return iconv(datalist_db_encoding, 'UTF-8', $str);
	}
	#########################################################
	/**
	 *  @brief converts string from utf8 to app-configured encoding
	 *  
	 *  @param [in] $str string to convert from utf8
	 *  @return utf8-decoded string
	 *  
	 *  @details if the constant 'datalist_db_encoding' is not defined, original string is returned
	 */
	function from_utf8($str) {
		if(!defined('datalist_db_encoding')) return $str;
		if(datalist_db_encoding == 'UTF-8') return $str;
		return iconv('UTF-8', datalist_db_encoding, $str);
	}
	#########################################################
	function get_parent_tables($table) {
		/* parents array:
		 * 'child table' => [parents], ...
		 *         where parents array:
		 *             'parent table' => [main lookup fields in child]
		 */
		$parents = [
			'dispositivos' => [
				'tipo_dispositivo' => ['tipo_dispositivo'],
				'marcas' => ['marca'],
				'marca_modelo' => ['modelo'],
				'unidades' => ['ubicacion'],
				'tipo_clasifica_riesgo' => ['clasificacion_riesgo'],
				'tipo_estado_dispo' => ['estado'],
				'compra_dispo' => ['id_compra_ingreso'],
			],
			'mobiliario' => [
				'tipo_grupo_mobilia' => ['grupo'],
				'tipo_mobiliario' => ['tipo_mobiliario'],
				'unidades' => ['unidad', 'ubicacion'],
			],
			'contactos' => [
				'contactos_tipo_contacto' => ['tipo_contacto'],
				'tipo_iden' => ['tipo_iden'],
				'ciudades' => ['ciudad'],
				'tipo_relacion' => ['tipo_relacion'],
			],
			'movimientos' => [
				'dispositivos' => ['codigo_dispo'],
				'tipo_estado_movi' => ['estado_movi'],
			],
			'documentos' => [
				'dispositivos' => ['dispo_codigo'],
				'tipo_documento' => ['tipo_docu'],
			],
			'mantenimientos' => [
				'dispositivos' => ['codigo'],
				'tipo_mtto' => ['tipo_mtto'],
				'contactos' => ['responsable'],
				'unidades' => ['unidad'],
				'tipo_estado_dispo' => ['estado_final'],
			],
			'calibraciones' => [
				'dispositivos' => ['codigo'],
				'tipo_calibracion' => ['tipo_calibracion'],
				'contactos' => ['empresa'],
			],
			'unidades' => [
				'ciudades' => ['ciudad'],
				'prestador' => ['prestador'],
			],
			'marca_modelo' => [
				'marcas' => ['marca'],
			],
			'accesorios' => [
				'tipo_accesorio' => ['tipo_accesorio'],
				'dispositivos' => ['id_dispo'],
			],
			'verificacion' => [
				'dispositivos' => ['codigo'],
				'unidades' => ['ubicacion'],
			],
			'hojadevida' => [
				'dispositivos' => ['dispo_codigo'],
			],
			'financiero' => [
				'dispositivos' => ['id_dispo'],
			],
			'financiero_mobiliario' => [
				'mobiliario' => ['id_dispo'],
			],
			'prestador' => [
				'tipo_razon_social' => ['razon_social'],
			],
			'docu_modelo' => [
				'tipo_dispositivo' => ['tipo_dispo'],
				'marcas' => ['marca'],
				'marca_modelo' => ['modelo'],
				'tipo_documento' => ['tipo_documento'],
			],
			'facturas' => [
				'dispositivos' => ['id_dispo'],
				'contactos' => ['proveedor'],
				'compras' => ['id_compras'],
			],
			'formatos' => [
				'tipo_formatos' => ['tipo_formato'],
				'tipo_dispositivo' => ['tipo_dispositivo'],
			],
			'dispo_fuera' => [
				'dispositivos' => ['codigo'],
				'tipo_fuera_servicio' => ['tipo_fuera_servicio'],
			],
			'tipo_dispositivo' => [
				'dispositivo_tipo_grupo' => ['grupo_dispo'],
			],
			'tipo_documento' => [
				'tipo_document_grupo' => ['grupo'],
			],
			'tipo_mobiliario' => [
				'tipo_grupo_mobilia' => ['grupo_mobi'],
			],
			'dispo_detalles_tecnicos' => [
				'dispositivos' => ['id_dispo'],
			],
			'movi_envio' => [
				'movimientos' => ['id_movi'],
				'unidades' => ['origen'],
				'ciudades' => ['ciudad'],
				'contactos' => ['nombre'],
			],
			'movi_recepcion' => [
				'movimientos' => ['id_movi'],
				'unidades' => ['destino'],
				'contactos' => ['nombre'],
			],
			'accesorio_dispo_relacion' => [
				'dispositivos' => ['id_accesorio', 'id_dispo'],
			],
			'observaciones' => [
				'tipo_estado_observa' => ['estado_observacion'],
				'tipo_estado_observaciones' => ['estado'],
				'dispositivos' => ['codigo'],
				'unidades' => ['unidad'],
			],
			'foto_observacion' => [
				'observaciones' => ['id_observacion'],
			],
			'progreso' => [
				'observaciones' => ['id_observacion'],
				'tipo_estado_observaciones' => ['estado_seguimiento'],
			],
			'acceso_remoto' => [
				'unidades' => ['unidad'],
				'dispositivos' => ['codigo_equipo'],
			],
			'perfil' => [
				'tipo_iden' => ['tipo_id'],
				'tipo_rh' => ['rh'],
			],
			'consentimieto' => [
				'perfil' => ['id_perfil'],
			],
			'perfil_familia' => [
				'perfil' => ['id_perfil'],
				'tipo_parentesco' => ['parentesco'],
			],
			'perfil_soportes' => [
				'perfil' => ['id_perfil'],
				'tipo_documento' => ['tipo_documento'],
			],
			'seguridad_social' => [
				'perfil' => ['id_perfil'],
				'tipo_documento_ss' => ['tipo_documento'],
			],
			'costos_mtto' => [
				'mantenimientos' => ['id_mtto'],
				'tipo_costo' => ['tipo_costo'],
			],
			'doc_mtto' => [
				'mantenimientos' => ['id_mtto'],
				'biomedicos' => ['nombre_biomedico'],
			],
			'biomedicos' => [
				'contactos' => ['id_contacto'],
			],
			'programa_mtto' => [
				'unidades' => ['unidad'],
			],
			'cronograma_mtto' => [
				'programa_mtto' => ['id_programa'],
				'dispositivos' => ['codigo'],
				'marcas' => ['marca'],
				'tipo_periodicidad' => ['periodicidad'],
			],
			'compras' => [
				'tipo_compra' => ['tipo_compra'],
				'tipo_estado_compra' => ['estado'],
			],
			'cantidad_dispomedico' => [
				'compra_dispo' => ['nombre_dispo'],
				'tipo_estado_compra' => ['estado'],
				'compras' => ['id_compra'],
			],
			'cantidad_articulos' => [
				'articulos' => ['nombre_articulo'],
				'tipo_estado_compra' => ['estado'],
				'compras' => ['id_compras'],
			],
			'cantidad_mobiliario' => [
				'mobiliario' => ['nombre_mobiliario'],
				'tipo_estado_compra' => ['estado'],
				'compras' => ['id_compra'],
			],
			'compra_dispo' => [
				'tipo_dispositivo' => ['tipo_dispositivo'],
				'marcas' => ['marca'],
				'marca_modelo' => ['modelo'],
				'tipo_estado_dispo' => ['estado'],
				'tipo_clasifica_riesgo' => ['riesgo'],
			],
			'articulos' => [
				'tipo_dispositivo' => ['tipo_dispo'],
				'marcas' => ['marca'],
				'marca_modelo' => ['modelo'],
				'marca_presetacion' => ['presentacion'],
				'articulos_familia' => ['familia'],
				'unidades' => ['ubicacion'],
				'tipo_estado_dispo' => ['estado'],
			],
			'marca_presetacion' => [
				'marcas' => ['marca'],
				'tipo_unidad_medida' => ['unidad_medida'],
			],
			'articulo_codigo_proveedor' => [
				'articulos_familia' => ['familia'],
			],
			'genera_documentos' => [
				'ciudades' => ['ciudad'],
				'unidades' => ['entidad'],
			],
			'verificacion_articulos' => [
				'articulos' => ['codigo'],
				'unidades' => ['ubicacion'],
			],
			'movimientos_articulos' => [
				'articulos' => ['nombre'],
				'tipo_estado_movi' => ['estado_movi'],
			],
			'movi_envio_articulo' => [
				'movimientos_articulos' => ['id_movi'],
				'unidades' => ['origen'],
				'ciudades' => ['ciudad'],
				'contactos' => ['nombre'],
			],
			'movi_recepcion_articulos' => [
				'movimientos_articulos' => ['id_movi'],
				'unidades' => ['destino'],
				'contactos' => ['nombre'],
			],
			'ubicacion_articulo' => [
				'articulos' => ['id_articulo'],
				'unidades' => ['ubicacion'],
			],
			'ubicacion_mobiliario' => [
				'mobiliario' => ['id_mobiliario'],
				'unidades' => ['ubicacion'],
			],
			'precio_dispo_medico' => [
				'compra_dispo' => ['dispo_medico'],
			],
		];

		return isset($parents[$table]) ? $parents[$table] : [];
	}
	#########################################################
	function backtick_keys_once($arr_data) {
		return array_combine(
			/* add backticks to keys */
			array_map(
				function($e) { return '`' . trim($e, '`') . '`'; }, 
				array_keys($arr_data)
			), 
			/* and combine with values */
			array_values($arr_data)
		);
	}
	#########################################################
	function calculated_fields() {
		/*
		 * calculated fields configuration array, $calc:
		 *         table => [calculated fields], ..
		 *         where calculated fields:
		 *             field => query, ...
		 */
		return array(
			'dispositivos' => array(
				'code' => 'SELECT CONCAT(`tipo_dispositivo`.`prefijo`, " ", `dispositivos`.`codigo`)
FROM `dispositivos`
INNER JOIN `tipo_dispositivo`
ON `tipo_dispositivo`.`id_tipodispo` = `dispositivos`.`tipo_dispositivo`
WHERE `dispositivos`.`id_dispo`=\'%ID%\'',
				'precio' => 'SELECT `financiero`.`precio` FROM `financiero`
WHERE `financiero`.`id_dispo`=\'%ID%\'',
			),
			'mobiliario' => array(
				'codigo' => 'SELECT CONCAT("MO-", `tipo_grupo_mobilia`.`prefijo`, "-0", `mobiliario`.`id_mobiliario`)
FROM `mobiliario`
INNER JOIN `tipo_grupo_mobilia`
ON `mobiliario`.`grupo` = `tipo_grupo_mobilia`.`id_gru_mo`
WHERE `mobiliario`.`id_mobiliario`=%ID%',
				'nombre' => 'SELECT CONCAT(`tipo_grupo_mobilia`.`grupo`,\' \',`tipo_mobiliario`.`tipo_mobiliario`, \' \',`mobiliario`.`id_mobiliario`)
FROM `mobiliario` 
INNER JOIN `tipo_grupo_mobilia`
ON `mobiliario`.`grupo` = `tipo_grupo_mobilia`.`id_gru_mo`
INNER JOIN `tipo_mobiliario`
ON `mobiliario`.`tipo_mobiliario` = `tipo_mobiliario`.`id`
WHERE `mobiliario`.`id_mobiliario`= %ID%',
			),
			'contactos' => array(
			),
			'contactos_tipo_contacto' => array(
			),
			'movimientos' => array(
				'img' => 'SELECT `marca_modelo`.`img` FROM `movimientos`
LEFT JOIN `dispositivos` ON `dispositivos`.`id_dispo`=`movimientos`.`codigo_dispo` 
LEFT JOIN `marca_modelo` ON `marca_modelo`.`id_mmodelo`=`dispositivos`.`foto`
WHERE `movimientos`.`id_movi`=\'%ID%\'',
				'origen' => 'SELECT `unidades`.`nombre` FROM `unidades`
INNER JOIN `movi_envio` ON `movi_envio`.`origen` = `unidades`.`id_unidades`
WHERE `movi_envio`.`id_movi` = %ID%',
				'destino' => 'SELECT `unidades`.`nombre` FROM `unidades`
INNER JOIN `movi_recepcion` ON `movi_recepcion`.`destino` = `unidades`.`id_unidades`
WHERE `movi_recepcion`.`id_movi` = %ID%',
			),
			'documentos' => array(
			),
			'mantenimientos' => array(
			),
			'calibraciones' => array(
			),
			'unidades' => array(
				'dispositivos_costo' => 'SELECT SUM(`dispositivos`.`precio`) FROM `dispositivos` WHERE `dispositivos`.`ubicacion` = \'%ID%\'',
				'mobiliario_costo' => 'SELECT `financiero_mobiliario`.`precio` FROM `financiero_mobiliario` WHERE `financiero_mobiliario`.`unidad` = \'%ID%\'',
				'costo_total' => 'SELECT `unidades`.`dispositivos_costo` + `unidades`.`mobiliario_costo` FROM `unidades` 
WHERE `unidades`.`id_unidades` = \'%ID%\'',
			),
			'marcas' => array(
			),
			'marca_modelo' => array(
			),
			'accesorios' => array(
				'codigo_accesorio' => 'SELECT CONCAT(`tipo_dispositivo`.`prefijo`, " ", `accesorios`.`id`)
FROM `accesorios`
INNER JOIN `tipo_dispositivo`
ON `tipo_dispositivo`.`id_tipodispo` = `dispositivos`.`tipo_dispositivo`
WHERE `dispositivos`.`id_dispo`=\'%ID%\'',
			),
			'ciudades' => array(
			),
			'verificacion' => array(
			),
			'hojadevida' => array(
			),
			'financiero' => array(
			),
			'financiero_mobiliario' => array(
			),
			'prestador' => array(
			),
			'docu_modelo' => array(
			),
			'facturas' => array(
			),
			'formatos' => array(
			),
			'dispo_fuera' => array(
			),
			'dispositivo_tipo_grupo' => array(
			),
			'tipo_relacion' => array(
			),
			'tipo_dispositivo' => array(
			),
			'tipo_documento' => array(
			),
			'tipo_iden' => array(
			),
			'tipo_razon_social' => array(
			),
			'tipo_mobiliario' => array(
			),
			'tipo_grupo_mobilia' => array(
			),
			'tipo_estado_dispo' => array(
			),
			'tipo_movimiento' => array(
			),
			'tipo_estado_movi' => array(
			),
			'tipo_estado_verifica' => array(
			),
			'tipo_mtto' => array(
			),
			'tipo_calibracion' => array(
			),
			'tipo_accesorio' => array(
			),
			'tipo_formatos' => array(
			),
			'dispo_detalles_tecnicos' => array(
			),
			'tipo_estado_observaciones' => array(
			),
			'movi_envio' => array(
			),
			'movi_recepcion' => array(
			),
			'tipo_fuera_servicio' => array(
			),
			'tipo_documento_ss' => array(
			),
			'tipo_parentesco' => array(
			),
			'tipo_rh' => array(
			),
			'accesorio_dispo_relacion' => array(
			),
			'observaciones' => array(
			),
			'foto_observacion' => array(
			),
			'progreso' => array(
			),
			'tipo_estado_observa' => array(
			),
			'acceso_remoto' => array(
			),
			'tipo_periodicidad' => array(
			),
			'perfil' => array(
				'usuario' => 'SELECT `memberID`  FROM `membership_users` 
WHERE `memberID`=\'%USERNAME%\'',
				'dato2' => 'SELECT `email` FROM `membership_users` WHERE `memberID`=\'%USERNAME%\'',
				'grupo' => 'SELECT `name` FROM `membership_groups` a
INNER JOIN membership_users b ON a.`groupID` = b.`groupID`
WHERE `memberID` = `%USERNAME%`',
			),
			'consentimieto' => array(
			),
			'perfil_familia' => array(
			),
			'perfil_soportes' => array(
			),
			'seguridad_social' => array(
			),
			'costos_mtto' => array(
			),
			'tipo_costo' => array(
			),
			'doc_mtto' => array(
			),
			'biomedicos' => array(
			),
			'tipo_clasifica_riesgo' => array(
			),
			'programa_mtto' => array(
			),
			'cronograma_mtto' => array(
			),
			'compras' => array(
			),
			'tipo_estado_compra' => array(
			),
			'cantidad_dispomedico' => array(
			),
			'cantidad_articulos' => array(
			),
			'cantidad_mobiliario' => array(
			),
			'compra_dispo' => array(
				'nombre' => 'SELECT CONCAT(`tipo_dispositivo`.`tipo_dispositivo`, \' \',`marcas`.`marca`, \' \',`marca_modelo`.`modelo`,\' \',`compra_dispo`.`serial`)
FROM `compra_dispo` 
INNER JOIN `tipo_dispositivo`
ON `compra_dispo`.`tipo_dispositivo` = `tipo_dispositivo`.`id_tipodispo`
INNER JOIN `marcas`
ON `compra_dispo`.`marca` = `marcas`.`id_marca`
INNER JOIN `marca_modelo`
ON `compra_dispo`.`modelo` = `marca_modelo`.`id_mmodelo`
WHERE `compra_dispo`.`id`=%ID%',
				'precio' => 'SELECT `financiero`.`precio` FROM `financiero`
WHERE `financiero`.`id_dispo`=\'%ID%\'',
			),
			'articulos' => array(
				'codigo' => 'SELECT CONCAT("D-",`tipo_dispositivo`.`prefijo`, "-0", `articulos`.`id`)
FROM `articulos`
INNER JOIN `tipo_dispositivo`
ON `articulos`.`tipo_dispo` = `tipo_dispositivo`.`id_tipodispo`
WHERE `articulos`.`id`=%ID%',
				'nombre_unico' => 'SELECT CONCAT(`tipo_dispositivo`.`tipo_dispositivo`, \' \',`marcas`.`marca`, \' \',`marca_modelo`.`modelo`,\' \',`marca_presetacion`.`presentacion`)
FROM `articulos` 
INNER JOIN `tipo_dispositivo`
ON `articulos`.`tipo_dispo` = `tipo_dispositivo`.`id_tipodispo`
INNER JOIN `marcas`
ON `articulos`.`marca` = `marcas`.`id_marca`
INNER JOIN `marca_presetacion`
ON `articulos`.`presentacion` = `marca_presetacion`.`id`
INNER JOIN `marca_modelo`
ON `articulos`.`modelo` = `marca_modelo`.`id_mmodelo`
WHERE `articulos`.`id`=%ID%',
			),
			'cofig' => array(
			),
			'marca_presetacion' => array(
			),
			'tipo_document_grupo' => array(
			),
			'tipo_pago' => array(
			),
			'tipo_compra' => array(
			),
			'articulos_familia' => array(
			),
			'articulo_codigo_proveedor' => array(
			),
			'tipo_unidad_medida' => array(
			),
			'genera_documentos' => array(
			),
			'verificacion_articulos' => array(
			),
			'movimientos_articulos' => array(
				'img' => 'SELECT `marca_modelo`.`img` FROM `movimientos`
LEFT JOIN `dispositivos` ON `dispositivos`.`id_dispo`=`movimientos`.`codigo_dispo` 
LEFT JOIN `marca_modelo` ON `marca_modelo`.`id_mmodelo`=`dispositivos`.`foto`
WHERE `movimientos`.`id_movi`=\'%ID%\'',
				'origen' => 'SELECT `unidades`.`nombre` FROM `unidades`
INNER JOIN `movi_envio` ON `movi_envio`.`origen` = `unidades`.`id_unidades`
WHERE `movi_envio`.`id_movi` = %ID%',
				'destino' => 'SELECT `unidades`.`nombre` FROM `unidades`
INNER JOIN `movi_recepcion` ON `movi_recepcion`.`destino` = `unidades`.`id_unidades`
WHERE `movi_recepcion`.`id_movi` = %ID%',
			),
			'movi_envio_articulo' => array(
			),
			'movi_recepcion_articulos' => array(
			),
			'ubicacion_articulo' => array(
			),
			'ubicacion_mobiliario' => array(
			),
			'precio_dispo_medico' => array(
			),
			'precio_articulo' => array(
			),
			'precio_mobiliario' => array(
			),
		);
	}
	#########################################################
	function update_calc_fields($table, $id, $formulas, $mi = false) {
		if($mi === false) $mi = getMemberInfo();
		$pk = getPKFieldName($table);
		$safe_id = makeSafe($id);
		$eo = ['silentErrors' => true];
		$caluclations_made = [];
		$replace = array(
			'%ID%' => $safe_id,
			'%USERNAME%' => makeSafe($mi['username']),
			'%GROUPID%' => makeSafe($mi['groupID']),
			'%GROUP%' => makeSafe($mi['group']),
			'%TABLENAME%' => makeSafe($table),
			'%PKFIELD%' => makeSafe($pk),
		);

		foreach($formulas as $field => $query) {
			// for queries that include unicode entities, replace them with actual unicode characters
			if(preg_match('/&#\d{2,5};/', $query)) $query = entitiesToUTF8($query);

			$query = str_replace(array_keys($replace), array_values($replace), $query);
			$calc_value = sqlValue($query);
			if($calc_value  === false) continue;

			// update calculated field
			$safe_calc_value = makeSafe($calc_value);
			$update_query = "UPDATE `{$table}` SET `{$field}`='{$safe_calc_value}' " .
				"WHERE `{$pk}`='{$safe_id}'";
			$res = sql($update_query, $eo);
			if($res) $caluclations_made[] = array(
				'table' => $table,
				'id' => $id,
				'field' => $field,
				'value' => $calc_value
			);
		}

		return $caluclations_made;
	}
	#########################################################
	function latest_jquery() {
		$jquery_dir = dirname(__FILE__) . '/../resources/jquery/js';

		$files = scandir($jquery_dir, SCANDIR_SORT_DESCENDING);
		foreach($files as $entry) {
			if(preg_match('/^jquery[-0-9\.]*\.min\.js$/i', $entry))
				return $entry;
		}

		return '';
	}
	#########################################################
	function existing_value($tn, $fn, $id, $cache = true) {
		/* cache results in records[tablename][id] */
		static $record = [];

		if($cache && !empty($record[$tn][$id])) return $record[$tn][$id][$fn];
		if(!$pk = getPKFieldName($tn)) return false;

		$sid = makeSafe($id);
		$eo = ['silentErrors' => true];
		$res = sql("SELECT * FROM `{$tn}` WHERE `{$pk}`='{$sid}'", $eo);
		$record[$tn][$id] = db_fetch_assoc($res);

		return $record[$tn][$id][$fn];
	}
	#########################################################
	function checkAppRequirements() {
		global $Translation;

		$reqErrors = [];
		$minPHP = '5.6.0';

		if(version_compare(PHP_VERSION, $minPHP) == -1)
			$reqErrors[] = str_replace(
				['<PHP_VERSION>', '<minPHP>'], 
				[PHP_VERSION, $minPHP], 
				$Translation['old php version']
			);

		if(!function_exists('mysqli_connect'))
			$reqErrors[] = str_replace('<EXTENSION>', 'mysqli', $Translation['extension not enabled']);

		if(!function_exists('mb_convert_encoding'))
			$reqErrors[] = str_replace('<EXTENSION>', 'mbstring', $Translation['extension not enabled']);

		// end of checks

		if(!count($reqErrors)) return;

		exit(
			'<div style="padding: 3em; font-size: 1.5em; color: #A94442; line-height: 150%; font-family: arial; text-rendering: optimizelegibility; text-shadow: 0px 0px 1px;">' .
				'<ul><li>' .
				implode('</li><li>', $reqErrors) .
				'</li><ul>' .
			'</div>'
		);
	}
	#########################################################
	function getRecord($table, $id) {
		// get PK fieldname
		if(!$pk = getPKFieldName($table)) return false;

		$safeId = makeSafe($id);
		$eo = ['silentErrors' => true];
		$res = sql("SELECT * FROM `{$table}` WHERE `{$pk}`='{$safeId}'", $eo);
		return db_fetch_assoc($res);
	}
	#########################################################
	function guessMySQLDateTime($dt) {
		// extract date and time, assuming a space separator
		list($date, $time, $ampm) = preg_split('/\s+/', trim($dt));

		// if date is not already in mysql format, try mysql_datetime
		if(!(preg_match('/^[0-9]{4}-(0?[1-9]|1[0-2])-([1-2][0-9]|30|31|0?[1-9])$/', $date) && strtotime($date)))
			if(!$date = mysql_datetime($date)) return false;

		// if time 
		if($t = time12(trim("$time $ampm")))
			$time = time24($t);
		elseif($t = time24($time))
			$time = $t;
		else
			$time = '';

		return trim("$date $time");
	}
	#########################################################
	function lookupQuery($tn, $lookupField) {
		/* 
			This is the query accessible from the 'Advanced' window under the 'Lookup field' tab in AppGini.
			For auto-fill lookups, this is the same as the query of the main lookup field, except the second
			column is replaced by the caption of the auto-fill lookup field.
		*/
		$lookupQuery = [
			'dispositivos' => [
				'foto' => 'SELECT `marca_modelo`.`id_mmodelo`, `marca_modelo`.`img` FROM `marca_modelo` LEFT JOIN `marcas` as marcas1 ON `marcas1`.`id_marca`=`marca_modelo`.`marca` ORDER BY 2',
				'tipo_dispositivo' => 'SELECT `tipo_dispositivo`.`id_tipodispo`, `tipo_dispositivo`.`tipo_dispositivo` FROM `tipo_dispositivo` LEFT JOIN `dispositivo_tipo_grupo` as dispositivo_tipo_grupo1 ON `dispositivo_tipo_grupo1`.`id`=`tipo_dispositivo`.`grupo_dispo` WHERE `tipo_dispositivo`.`grupo_dispo` = 3 ORDER BY 2',
				'marca' => 'SELECT `marcas`.`id_marca`, `marcas`.`marca` FROM `marcas` ORDER BY 2',
				'modelo' => 'SELECT `marca_modelo`.`id_mmodelo`, `marca_modelo`.`modelo` FROM `marca_modelo` LEFT JOIN `marcas` as marcas1 ON `marcas1`.`id_marca`=`marca_modelo`.`marca` ORDER BY 2',
				'ubicacion' => 'SELECT `unidades`.`id_unidades`, `unidades`.`nombre` FROM `unidades` LEFT JOIN `ciudades` as ciudades1 ON `ciudades1`.`id_ciudad`=`unidades`.`ciudad` LEFT JOIN `prestador` as prestador1 ON `prestador1`.`id`=`unidades`.`prestador` ORDER BY 2',
				'ubicacion_abre' => 'SELECT `unidades`.`id_unidades`, IF(CHAR_LENGTH(`unidades`.`abreviado`) || CHAR_LENGTH(`unidades`.`ciudad`), CONCAT_WS(\'\', `unidades`.`abreviado`, \' - \', IF(    CHAR_LENGTH(`ciudades1`.`ciudad`), CONCAT_WS(\'\',   `ciudades1`.`ciudad`), \'\')), \'\') FROM `unidades` LEFT JOIN `ciudades` as ciudades1 ON `ciudades1`.`id_ciudad`=`unidades`.`ciudad` LEFT JOIN `prestador` as prestador1 ON `prestador1`.`id`=`unidades`.`prestador` ORDER BY 2',
				'clasificacion_riesgo' => 'SELECT `tipo_clasifica_riesgo`.`id`, `tipo_clasifica_riesgo`.`clase` FROM `tipo_clasifica_riesgo` ORDER BY 2',
				'estado' => 'SELECT `tipo_estado_dispo`.`id`, `tipo_estado_dispo`.`estado_dispo` FROM `tipo_estado_dispo` ORDER BY 2',
				'id_compra_ingreso' => 'SELECT `compra_dispo`.`id`, `compra_dispo`.`id` FROM `compra_dispo` LEFT JOIN `tipo_dispositivo` as tipo_dispositivo1 ON `tipo_dispositivo1`.`id_tipodispo`=`compra_dispo`.`tipo_dispositivo` LEFT JOIN `marcas` as marcas1 ON `marcas1`.`id_marca`=`compra_dispo`.`marca` LEFT JOIN `marca_modelo` as marca_modelo1 ON `marca_modelo1`.`id_mmodelo`=`compra_dispo`.`modelo` LEFT JOIN `tipo_estado_dispo` as tipo_estado_dispo1 ON `tipo_estado_dispo1`.`id`=`compra_dispo`.`estado` LEFT JOIN `tipo_clasifica_riesgo` as tipo_clasifica_riesgo1 ON `tipo_clasifica_riesgo1`.`id`=`compra_dispo`.`riesgo` ORDER BY 2',
			],
			'mobiliario' => [
				'grupo' => 'SELECT `tipo_grupo_mobilia`.`id_gru_mo`, `tipo_grupo_mobilia`.`grupo` FROM `tipo_grupo_mobilia` ORDER BY 2',
				'tipo_mobiliario' => 'SELECT `tipo_mobiliario`.`id`, `tipo_mobiliario`.`tipo_mobiliario` FROM `tipo_mobiliario` LEFT JOIN `tipo_grupo_mobilia` as tipo_grupo_mobilia1 ON `tipo_grupo_mobilia1`.`id_gru_mo`=`tipo_mobiliario`.`grupo_mobi` ORDER BY 2',
				'ubicacion' => 'SELECT `unidades`.`id_unidades`, `unidades`.`nombre` FROM `unidades` LEFT JOIN `ciudades` as ciudades1 ON `ciudades1`.`id_ciudad`=`unidades`.`ciudad` LEFT JOIN `prestador` as prestador1 ON `prestador1`.`id`=`unidades`.`prestador` ORDER BY 2',
				'ubicacion_abreviado' => 'SELECT `unidades`.`id_unidades`, `unidades`.`abreviado` FROM `unidades` LEFT JOIN `ciudades` as ciudades1 ON `ciudades1`.`id_ciudad`=`unidades`.`ciudad` LEFT JOIN `prestador` as prestador1 ON `prestador1`.`id`=`unidades`.`prestador` ORDER BY 2',
				'unidad' => 'SELECT `unidades`.`id_unidades`, `unidades`.`nombre` FROM `unidades` LEFT JOIN `ciudades` as ciudades1 ON `ciudades1`.`id_ciudad`=`unidades`.`ciudad` LEFT JOIN `prestador` as prestador1 ON `prestador1`.`id`=`unidades`.`prestador` ORDER BY 2',
				'uni_abreviado' => 'SELECT `unidades`.`id_unidades`, `unidades`.`abreviado` FROM `unidades` LEFT JOIN `ciudades` as ciudades1 ON `ciudades1`.`id_ciudad`=`unidades`.`ciudad` LEFT JOIN `prestador` as prestador1 ON `prestador1`.`id`=`unidades`.`prestador` ORDER BY 2',
			],
			'contactos' => [
				'tipo_contacto' => 'SELECT `contactos_tipo_contacto`.`id_tipo_contacto`, `contactos_tipo_contacto`.`tipo_contacto` FROM `contactos_tipo_contacto` ORDER BY 2',
				'tipo_iden' => 'SELECT `tipo_iden`.`id_iden`, `tipo_iden`.`tipo_iden_abre` FROM `tipo_iden` ORDER BY 2',
				'ciudad' => 'SELECT `ciudades`.`id_ciudad`, `ciudades`.`ciudad` FROM `ciudades` ORDER BY 2',
				'tipo_relacion' => 'SELECT `tipo_relacion`.`id_tiporelac`, `tipo_relacion`.`tipo_relac` FROM `tipo_relacion` ORDER BY 2',
			],
			'contactos_tipo_contacto' => [
			],
			'movimientos' => [
				'tipo_dispo' => 'SELECT `dispositivos`.`id_dispo`, IF(    CHAR_LENGTH(`tipo_dispositivo1`.`tipo_dispositivo`), CONCAT_WS(\'\',   `tipo_dispositivo1`.`tipo_dispositivo`), \'\') FROM `dispositivos` LEFT JOIN `tipo_dispositivo` as tipo_dispositivo1 ON `tipo_dispositivo1`.`id_tipodispo`=`dispositivos`.`tipo_dispositivo` LEFT JOIN `marcas` as marcas1 ON `marcas1`.`id_marca`=`dispositivos`.`marca` LEFT JOIN `marca_modelo` as marca_modelo1 ON `marca_modelo1`.`id_mmodelo`=`dispositivos`.`modelo` LEFT JOIN `unidades` as unidades1 ON `unidades1`.`id_unidades`=`dispositivos`.`ubicacion` LEFT JOIN `tipo_clasifica_riesgo` as tipo_clasifica_riesgo1 ON `tipo_clasifica_riesgo1`.`id`=`dispositivos`.`clasificacion_riesgo` LEFT JOIN `tipo_estado_dispo` as tipo_estado_dispo1 ON `tipo_estado_dispo1`.`id`=`dispositivos`.`estado` LEFT JOIN `compra_dispo` as compra_dispo1 ON `compra_dispo1`.`id`=`dispositivos`.`id_compra_ingreso` LEFT JOIN `ciudades` as ciudades1 ON `ciudades1`.`id_ciudad`=`unidades1`.`ciudad` ORDER BY 2',
				'codigo_dispo' => 'SELECT `dispositivos`.`id_dispo`, `dispositivos`.`code` FROM `dispositivos` LEFT JOIN `tipo_dispositivo` as tipo_dispositivo1 ON `tipo_dispositivo1`.`id_tipodispo`=`dispositivos`.`tipo_dispositivo` LEFT JOIN `marcas` as marcas1 ON `marcas1`.`id_marca`=`dispositivos`.`marca` LEFT JOIN `marca_modelo` as marca_modelo1 ON `marca_modelo1`.`id_mmodelo`=`dispositivos`.`modelo` LEFT JOIN `unidades` as unidades1 ON `unidades1`.`id_unidades`=`dispositivos`.`ubicacion` LEFT JOIN `tipo_clasifica_riesgo` as tipo_clasifica_riesgo1 ON `tipo_clasifica_riesgo1`.`id`=`dispositivos`.`clasificacion_riesgo` LEFT JOIN `tipo_estado_dispo` as tipo_estado_dispo1 ON `tipo_estado_dispo1`.`id`=`dispositivos`.`estado` LEFT JOIN `compra_dispo` as compra_dispo1 ON `compra_dispo1`.`id`=`dispositivos`.`id_compra_ingreso` LEFT JOIN `ciudades` as ciudades1 ON `ciudades1`.`id_ciudad`=`unidades1`.`ciudad` ORDER BY 2',
				'serial_dispo' => 'SELECT `dispositivos`.`id_dispo`, `dispositivos`.`serial` FROM `dispositivos` LEFT JOIN `tipo_dispositivo` as tipo_dispositivo1 ON `tipo_dispositivo1`.`id_tipodispo`=`dispositivos`.`tipo_dispositivo` LEFT JOIN `marcas` as marcas1 ON `marcas1`.`id_marca`=`dispositivos`.`marca` LEFT JOIN `marca_modelo` as marca_modelo1 ON `marca_modelo1`.`id_mmodelo`=`dispositivos`.`modelo` LEFT JOIN `unidades` as unidades1 ON `unidades1`.`id_unidades`=`dispositivos`.`ubicacion` LEFT JOIN `tipo_clasifica_riesgo` as tipo_clasifica_riesgo1 ON `tipo_clasifica_riesgo1`.`id`=`dispositivos`.`clasificacion_riesgo` LEFT JOIN `tipo_estado_dispo` as tipo_estado_dispo1 ON `tipo_estado_dispo1`.`id`=`dispositivos`.`estado` LEFT JOIN `compra_dispo` as compra_dispo1 ON `compra_dispo1`.`id`=`dispositivos`.`id_compra_ingreso` LEFT JOIN `ciudades` as ciudades1 ON `ciudades1`.`id_ciudad`=`unidades1`.`ciudad` ORDER BY 2',
				'estado_movi' => 'SELECT `tipo_estado_movi`.`id`, `tipo_estado_movi`.`estado_movi` FROM `tipo_estado_movi` ORDER BY 2',
			],
			'documentos' => [
				'dispo_codigo' => 'SELECT `dispositivos`.`id_dispo`, `dispositivos`.`code` FROM `dispositivos` LEFT JOIN `tipo_dispositivo` as tipo_dispositivo1 ON `tipo_dispositivo1`.`id_tipodispo`=`dispositivos`.`tipo_dispositivo` LEFT JOIN `marcas` as marcas1 ON `marcas1`.`id_marca`=`dispositivos`.`marca` LEFT JOIN `marca_modelo` as marca_modelo1 ON `marca_modelo1`.`id_mmodelo`=`dispositivos`.`modelo` LEFT JOIN `unidades` as unidades1 ON `unidades1`.`id_unidades`=`dispositivos`.`ubicacion` LEFT JOIN `tipo_clasifica_riesgo` as tipo_clasifica_riesgo1 ON `tipo_clasifica_riesgo1`.`id`=`dispositivos`.`clasificacion_riesgo` LEFT JOIN `tipo_estado_dispo` as tipo_estado_dispo1 ON `tipo_estado_dispo1`.`id`=`dispositivos`.`estado` LEFT JOIN `compra_dispo` as compra_dispo1 ON `compra_dispo1`.`id`=`dispositivos`.`id_compra_ingreso` LEFT JOIN `ciudades` as ciudades1 ON `ciudades1`.`id_ciudad`=`unidades1`.`ciudad` ORDER BY 2',
				'dispo_serial' => 'SELECT `dispositivos`.`id_dispo`, `dispositivos`.`serial` FROM `dispositivos` LEFT JOIN `tipo_dispositivo` as tipo_dispositivo1 ON `tipo_dispositivo1`.`id_tipodispo`=`dispositivos`.`tipo_dispositivo` LEFT JOIN `marcas` as marcas1 ON `marcas1`.`id_marca`=`dispositivos`.`marca` LEFT JOIN `marca_modelo` as marca_modelo1 ON `marca_modelo1`.`id_mmodelo`=`dispositivos`.`modelo` LEFT JOIN `unidades` as unidades1 ON `unidades1`.`id_unidades`=`dispositivos`.`ubicacion` LEFT JOIN `tipo_clasifica_riesgo` as tipo_clasifica_riesgo1 ON `tipo_clasifica_riesgo1`.`id`=`dispositivos`.`clasificacion_riesgo` LEFT JOIN `tipo_estado_dispo` as tipo_estado_dispo1 ON `tipo_estado_dispo1`.`id`=`dispositivos`.`estado` LEFT JOIN `compra_dispo` as compra_dispo1 ON `compra_dispo1`.`id`=`dispositivos`.`id_compra_ingreso` LEFT JOIN `ciudades` as ciudades1 ON `ciudades1`.`id_ciudad`=`unidades1`.`ciudad` ORDER BY 2',
				'tipo_docu' => 'SELECT `tipo_documento`.`id_tipodoc`, `tipo_documento`.`tipo_doc` FROM `tipo_documento` LEFT JOIN `tipo_document_grupo` as tipo_document_grupo1 ON `tipo_document_grupo1`.`id`=`tipo_documento`.`grupo` ORDER BY 2',
			],
			'mantenimientos' => [
				'codigo' => 'SELECT `dispositivos`.`id_dispo`, `dispositivos`.`code` FROM `dispositivos` LEFT JOIN `tipo_dispositivo` as tipo_dispositivo1 ON `tipo_dispositivo1`.`id_tipodispo`=`dispositivos`.`tipo_dispositivo` LEFT JOIN `marcas` as marcas1 ON `marcas1`.`id_marca`=`dispositivos`.`marca` LEFT JOIN `marca_modelo` as marca_modelo1 ON `marca_modelo1`.`id_mmodelo`=`dispositivos`.`modelo` LEFT JOIN `unidades` as unidades1 ON `unidades1`.`id_unidades`=`dispositivos`.`ubicacion` LEFT JOIN `tipo_clasifica_riesgo` as tipo_clasifica_riesgo1 ON `tipo_clasifica_riesgo1`.`id`=`dispositivos`.`clasificacion_riesgo` LEFT JOIN `tipo_estado_dispo` as tipo_estado_dispo1 ON `tipo_estado_dispo1`.`id`=`dispositivos`.`estado` LEFT JOIN `compra_dispo` as compra_dispo1 ON `compra_dispo1`.`id`=`dispositivos`.`id_compra_ingreso` LEFT JOIN `ciudades` as ciudades1 ON `ciudades1`.`id_ciudad`=`unidades1`.`ciudad` ORDER BY 2',
				'serial' => 'SELECT `dispositivos`.`id_dispo`, `dispositivos`.`serial` FROM `dispositivos` LEFT JOIN `tipo_dispositivo` as tipo_dispositivo1 ON `tipo_dispositivo1`.`id_tipodispo`=`dispositivos`.`tipo_dispositivo` LEFT JOIN `marcas` as marcas1 ON `marcas1`.`id_marca`=`dispositivos`.`marca` LEFT JOIN `marca_modelo` as marca_modelo1 ON `marca_modelo1`.`id_mmodelo`=`dispositivos`.`modelo` LEFT JOIN `unidades` as unidades1 ON `unidades1`.`id_unidades`=`dispositivos`.`ubicacion` LEFT JOIN `tipo_clasifica_riesgo` as tipo_clasifica_riesgo1 ON `tipo_clasifica_riesgo1`.`id`=`dispositivos`.`clasificacion_riesgo` LEFT JOIN `tipo_estado_dispo` as tipo_estado_dispo1 ON `tipo_estado_dispo1`.`id`=`dispositivos`.`estado` LEFT JOIN `compra_dispo` as compra_dispo1 ON `compra_dispo1`.`id`=`dispositivos`.`id_compra_ingreso` LEFT JOIN `ciudades` as ciudades1 ON `ciudades1`.`id_ciudad`=`unidades1`.`ciudad` ORDER BY 2',
				'tipo_dispo' => 'SELECT `dispositivos`.`id_dispo`, IF(    CHAR_LENGTH(`tipo_dispositivo1`.`tipo_dispositivo`), CONCAT_WS(\'\',   `tipo_dispositivo1`.`tipo_dispositivo`), \'\') FROM `dispositivos` LEFT JOIN `tipo_dispositivo` as tipo_dispositivo1 ON `tipo_dispositivo1`.`id_tipodispo`=`dispositivos`.`tipo_dispositivo` LEFT JOIN `marcas` as marcas1 ON `marcas1`.`id_marca`=`dispositivos`.`marca` LEFT JOIN `marca_modelo` as marca_modelo1 ON `marca_modelo1`.`id_mmodelo`=`dispositivos`.`modelo` LEFT JOIN `unidades` as unidades1 ON `unidades1`.`id_unidades`=`dispositivos`.`ubicacion` LEFT JOIN `tipo_clasifica_riesgo` as tipo_clasifica_riesgo1 ON `tipo_clasifica_riesgo1`.`id`=`dispositivos`.`clasificacion_riesgo` LEFT JOIN `tipo_estado_dispo` as tipo_estado_dispo1 ON `tipo_estado_dispo1`.`id`=`dispositivos`.`estado` LEFT JOIN `compra_dispo` as compra_dispo1 ON `compra_dispo1`.`id`=`dispositivos`.`id_compra_ingreso` LEFT JOIN `ciudades` as ciudades1 ON `ciudades1`.`id_ciudad`=`unidades1`.`ciudad` ORDER BY 2',
				'tipo_mtto' => 'SELECT `tipo_mtto`.`id`, `tipo_mtto`.`tipo_mtto` FROM `tipo_mtto` ORDER BY 2',
				'responsable' => 'SELECT `contactos`.`id_contactos`, `contactos`.`nombre` FROM `contactos` LEFT JOIN `contactos_tipo_contacto` as contactos_tipo_contacto1 ON `contactos_tipo_contacto1`.`id_tipo_contacto`=`contactos`.`tipo_contacto` LEFT JOIN `tipo_iden` as tipo_iden1 ON `tipo_iden1`.`id_iden`=`contactos`.`tipo_iden` LEFT JOIN `ciudades` as ciudades1 ON `ciudades1`.`id_ciudad`=`contactos`.`ciudad` LEFT JOIN `tipo_relacion` as tipo_relacion1 ON `tipo_relacion1`.`id_tiporelac`=`contactos`.`tipo_relacion` ORDER BY 2',
				'id_responsable' => 'SELECT `contactos`.`id_contactos`, `contactos`.`identificacion` FROM `contactos` LEFT JOIN `contactos_tipo_contacto` as contactos_tipo_contacto1 ON `contactos_tipo_contacto1`.`id_tipo_contacto`=`contactos`.`tipo_contacto` LEFT JOIN `tipo_iden` as tipo_iden1 ON `tipo_iden1`.`id_iden`=`contactos`.`tipo_iden` LEFT JOIN `ciudades` as ciudades1 ON `ciudades1`.`id_ciudad`=`contactos`.`ciudad` LEFT JOIN `tipo_relacion` as tipo_relacion1 ON `tipo_relacion1`.`id_tiporelac`=`contactos`.`tipo_relacion` ORDER BY 2',
				'unidad' => 'SELECT `unidades`.`id_unidades`, `unidades`.`nombre` FROM `unidades` LEFT JOIN `ciudades` as ciudades1 ON `ciudades1`.`id_ciudad`=`unidades`.`ciudad` LEFT JOIN `prestador` as prestador1 ON `prestador1`.`id`=`unidades`.`prestador` ORDER BY 2',
				'unidad_abreviado' => 'SELECT `unidades`.`id_unidades`, IF(CHAR_LENGTH(`unidades`.`abreviado`) || CHAR_LENGTH(`unidades`.`ciudad`), CONCAT_WS(\'\', `unidades`.`abreviado`, \' - \', IF(    CHAR_LENGTH(`ciudades1`.`ciudad`), CONCAT_WS(\'\',   `ciudades1`.`ciudad`), \'\')), \'\') FROM `unidades` LEFT JOIN `ciudades` as ciudades1 ON `ciudades1`.`id_ciudad`=`unidades`.`ciudad` LEFT JOIN `prestador` as prestador1 ON `prestador1`.`id`=`unidades`.`prestador` ORDER BY 2',
				'estado_final' => 'SELECT `tipo_estado_dispo`.`id`, `tipo_estado_dispo`.`estado_dispo` FROM `tipo_estado_dispo` ORDER BY 2',
			],
			'calibraciones' => [
				'codigo' => 'SELECT `dispositivos`.`id_dispo`, `dispositivos`.`code` FROM `dispositivos` LEFT JOIN `tipo_dispositivo` as tipo_dispositivo1 ON `tipo_dispositivo1`.`id_tipodispo`=`dispositivos`.`tipo_dispositivo` LEFT JOIN `marcas` as marcas1 ON `marcas1`.`id_marca`=`dispositivos`.`marca` LEFT JOIN `marca_modelo` as marca_modelo1 ON `marca_modelo1`.`id_mmodelo`=`dispositivos`.`modelo` LEFT JOIN `unidades` as unidades1 ON `unidades1`.`id_unidades`=`dispositivos`.`ubicacion` LEFT JOIN `tipo_clasifica_riesgo` as tipo_clasifica_riesgo1 ON `tipo_clasifica_riesgo1`.`id`=`dispositivos`.`clasificacion_riesgo` LEFT JOIN `tipo_estado_dispo` as tipo_estado_dispo1 ON `tipo_estado_dispo1`.`id`=`dispositivos`.`estado` LEFT JOIN `compra_dispo` as compra_dispo1 ON `compra_dispo1`.`id`=`dispositivos`.`id_compra_ingreso` LEFT JOIN `ciudades` as ciudades1 ON `ciudades1`.`id_ciudad`=`unidades1`.`ciudad` ORDER BY 2',
				'serial' => 'SELECT `dispositivos`.`id_dispo`, `dispositivos`.`serial` FROM `dispositivos` LEFT JOIN `tipo_dispositivo` as tipo_dispositivo1 ON `tipo_dispositivo1`.`id_tipodispo`=`dispositivos`.`tipo_dispositivo` LEFT JOIN `marcas` as marcas1 ON `marcas1`.`id_marca`=`dispositivos`.`marca` LEFT JOIN `marca_modelo` as marca_modelo1 ON `marca_modelo1`.`id_mmodelo`=`dispositivos`.`modelo` LEFT JOIN `unidades` as unidades1 ON `unidades1`.`id_unidades`=`dispositivos`.`ubicacion` LEFT JOIN `tipo_clasifica_riesgo` as tipo_clasifica_riesgo1 ON `tipo_clasifica_riesgo1`.`id`=`dispositivos`.`clasificacion_riesgo` LEFT JOIN `tipo_estado_dispo` as tipo_estado_dispo1 ON `tipo_estado_dispo1`.`id`=`dispositivos`.`estado` LEFT JOIN `compra_dispo` as compra_dispo1 ON `compra_dispo1`.`id`=`dispositivos`.`id_compra_ingreso` LEFT JOIN `ciudades` as ciudades1 ON `ciudades1`.`id_ciudad`=`unidades1`.`ciudad` ORDER BY 2',
				'tipo_calibracion' => 'SELECT `tipo_calibracion`.`id`, `tipo_calibracion`.`tipo_calibracion` FROM `tipo_calibracion` ORDER BY 2',
				'empresa' => 'SELECT `contactos`.`id_contactos`, `contactos`.`nombre` FROM `contactos` LEFT JOIN `contactos_tipo_contacto` as contactos_tipo_contacto1 ON `contactos_tipo_contacto1`.`id_tipo_contacto`=`contactos`.`tipo_contacto` LEFT JOIN `tipo_iden` as tipo_iden1 ON `tipo_iden1`.`id_iden`=`contactos`.`tipo_iden` LEFT JOIN `ciudades` as ciudades1 ON `ciudades1`.`id_ciudad`=`contactos`.`ciudad` LEFT JOIN `tipo_relacion` as tipo_relacion1 ON `tipo_relacion1`.`id_tiporelac`=`contactos`.`tipo_relacion` ORDER BY 2',
				'telefono' => 'SELECT `contactos`.`id_contactos`, `contactos`.`telefono` FROM `contactos` LEFT JOIN `contactos_tipo_contacto` as contactos_tipo_contacto1 ON `contactos_tipo_contacto1`.`id_tipo_contacto`=`contactos`.`tipo_contacto` LEFT JOIN `tipo_iden` as tipo_iden1 ON `tipo_iden1`.`id_iden`=`contactos`.`tipo_iden` LEFT JOIN `ciudades` as ciudades1 ON `ciudades1`.`id_ciudad`=`contactos`.`ciudad` LEFT JOIN `tipo_relacion` as tipo_relacion1 ON `tipo_relacion1`.`id_tiporelac`=`contactos`.`tipo_relacion` ORDER BY 2',
			],
			'unidades' => [
				'ciudad' => 'SELECT `ciudades`.`id_ciudad`, `ciudades`.`ciudad` FROM `ciudades` ORDER BY 2',
				'prestador' => 'SELECT `prestador`.`id`, IF(CHAR_LENGTH(`prestador`.`nombre`) || CHAR_LENGTH(`prestador`.`nit`), CONCAT_WS(\'\', `prestador`.`nombre`, \' | \', IF(    CHAR_LENGTH(`tipo_razon_social1`.`nit`), CONCAT_WS(\'\',   `tipo_razon_social1`.`nit`), \'\')), \'\') FROM `prestador` LEFT JOIN `tipo_razon_social` as tipo_razon_social1 ON `tipo_razon_social1`.`id`=`prestador`.`razon_social` ORDER BY 2',
			],
			'marcas' => [
			],
			'marca_modelo' => [
				'marca' => 'SELECT `marcas`.`id_marca`, `marcas`.`marca` FROM `marcas` ORDER BY 2',
			],
			'accesorios' => [
				'tipo_accesorio' => 'SELECT `tipo_accesorio`.`id`, `tipo_accesorio`.`tipo_accesorio` FROM `tipo_accesorio` ORDER BY 2',
				'id_dispo' => 'SELECT `dispositivos`.`id_dispo`, `dispositivos`.`codigo` FROM `dispositivos` LEFT JOIN `tipo_dispositivo` as tipo_dispositivo1 ON `tipo_dispositivo1`.`id_tipodispo`=`dispositivos`.`tipo_dispositivo` LEFT JOIN `marcas` as marcas1 ON `marcas1`.`id_marca`=`dispositivos`.`marca` LEFT JOIN `marca_modelo` as marca_modelo1 ON `marca_modelo1`.`id_mmodelo`=`dispositivos`.`modelo` LEFT JOIN `unidades` as unidades1 ON `unidades1`.`id_unidades`=`dispositivos`.`ubicacion` LEFT JOIN `tipo_clasifica_riesgo` as tipo_clasifica_riesgo1 ON `tipo_clasifica_riesgo1`.`id`=`dispositivos`.`clasificacion_riesgo` LEFT JOIN `tipo_estado_dispo` as tipo_estado_dispo1 ON `tipo_estado_dispo1`.`id`=`dispositivos`.`estado` LEFT JOIN `compra_dispo` as compra_dispo1 ON `compra_dispo1`.`id`=`dispositivos`.`id_compra_ingreso` LEFT JOIN `ciudades` as ciudades1 ON `ciudades1`.`id_ciudad`=`unidades1`.`ciudad` ORDER BY 2',
			],
			'ciudades' => [
			],
			'verificacion' => [
				'codigo' => 'SELECT `dispositivos`.`id_dispo`, `dispositivos`.`code` FROM `dispositivos` LEFT JOIN `tipo_dispositivo` as tipo_dispositivo1 ON `tipo_dispositivo1`.`id_tipodispo`=`dispositivos`.`tipo_dispositivo` LEFT JOIN `marcas` as marcas1 ON `marcas1`.`id_marca`=`dispositivos`.`marca` LEFT JOIN `marca_modelo` as marca_modelo1 ON `marca_modelo1`.`id_mmodelo`=`dispositivos`.`modelo` LEFT JOIN `unidades` as unidades1 ON `unidades1`.`id_unidades`=`dispositivos`.`ubicacion` LEFT JOIN `tipo_clasifica_riesgo` as tipo_clasifica_riesgo1 ON `tipo_clasifica_riesgo1`.`id`=`dispositivos`.`clasificacion_riesgo` LEFT JOIN `tipo_estado_dispo` as tipo_estado_dispo1 ON `tipo_estado_dispo1`.`id`=`dispositivos`.`estado` LEFT JOIN `compra_dispo` as compra_dispo1 ON `compra_dispo1`.`id`=`dispositivos`.`id_compra_ingreso` LEFT JOIN `ciudades` as ciudades1 ON `ciudades1`.`id_ciudad`=`unidades1`.`ciudad` ORDER BY 2',
				'tipo_dispo' => 'SELECT `dispositivos`.`id_dispo`, IF(    CHAR_LENGTH(`tipo_dispositivo1`.`tipo_dispositivo`), CONCAT_WS(\'\',   `tipo_dispositivo1`.`tipo_dispositivo`), \'\') FROM `dispositivos` LEFT JOIN `tipo_dispositivo` as tipo_dispositivo1 ON `tipo_dispositivo1`.`id_tipodispo`=`dispositivos`.`tipo_dispositivo` LEFT JOIN `marcas` as marcas1 ON `marcas1`.`id_marca`=`dispositivos`.`marca` LEFT JOIN `marca_modelo` as marca_modelo1 ON `marca_modelo1`.`id_mmodelo`=`dispositivos`.`modelo` LEFT JOIN `unidades` as unidades1 ON `unidades1`.`id_unidades`=`dispositivos`.`ubicacion` LEFT JOIN `tipo_clasifica_riesgo` as tipo_clasifica_riesgo1 ON `tipo_clasifica_riesgo1`.`id`=`dispositivos`.`clasificacion_riesgo` LEFT JOIN `tipo_estado_dispo` as tipo_estado_dispo1 ON `tipo_estado_dispo1`.`id`=`dispositivos`.`estado` LEFT JOIN `compra_dispo` as compra_dispo1 ON `compra_dispo1`.`id`=`dispositivos`.`id_compra_ingreso` LEFT JOIN `ciudades` as ciudades1 ON `ciudades1`.`id_ciudad`=`unidades1`.`ciudad` ORDER BY 2',
				'serial' => 'SELECT `dispositivos`.`id_dispo`, `dispositivos`.`serial` FROM `dispositivos` LEFT JOIN `tipo_dispositivo` as tipo_dispositivo1 ON `tipo_dispositivo1`.`id_tipodispo`=`dispositivos`.`tipo_dispositivo` LEFT JOIN `marcas` as marcas1 ON `marcas1`.`id_marca`=`dispositivos`.`marca` LEFT JOIN `marca_modelo` as marca_modelo1 ON `marca_modelo1`.`id_mmodelo`=`dispositivos`.`modelo` LEFT JOIN `unidades` as unidades1 ON `unidades1`.`id_unidades`=`dispositivos`.`ubicacion` LEFT JOIN `tipo_clasifica_riesgo` as tipo_clasifica_riesgo1 ON `tipo_clasifica_riesgo1`.`id`=`dispositivos`.`clasificacion_riesgo` LEFT JOIN `tipo_estado_dispo` as tipo_estado_dispo1 ON `tipo_estado_dispo1`.`id`=`dispositivos`.`estado` LEFT JOIN `compra_dispo` as compra_dispo1 ON `compra_dispo1`.`id`=`dispositivos`.`id_compra_ingreso` LEFT JOIN `ciudades` as ciudades1 ON `ciudades1`.`id_ciudad`=`unidades1`.`ciudad` ORDER BY 2',
				'ubicacion' => 'SELECT `unidades`.`id_unidades`, `unidades`.`nombre` FROM `unidades` LEFT JOIN `ciudades` as ciudades1 ON `ciudades1`.`id_ciudad`=`unidades`.`ciudad` LEFT JOIN `prestador` as prestador1 ON `prestador1`.`id`=`unidades`.`prestador` ORDER BY 2',
				'abreviado' => 'SELECT `unidades`.`id_unidades`, IF(CHAR_LENGTH(`unidades`.`abreviado`) || CHAR_LENGTH(`unidades`.`ciudad`), CONCAT_WS(\'\', `unidades`.`abreviado`, \' - \', IF(    CHAR_LENGTH(`ciudades1`.`ciudad`), CONCAT_WS(\'\',   `ciudades1`.`ciudad`), \'\')), \'\') FROM `unidades` LEFT JOIN `ciudades` as ciudades1 ON `ciudades1`.`id_ciudad`=`unidades`.`ciudad` LEFT JOIN `prestador` as prestador1 ON `prestador1`.`id`=`unidades`.`prestador` ORDER BY 2',
			],
			'hojadevida' => [
				'dispo_codigo' => 'SELECT `dispositivos`.`id_dispo`, `dispositivos`.`code` FROM `dispositivos` LEFT JOIN `tipo_dispositivo` as tipo_dispositivo1 ON `tipo_dispositivo1`.`id_tipodispo`=`dispositivos`.`tipo_dispositivo` LEFT JOIN `marcas` as marcas1 ON `marcas1`.`id_marca`=`dispositivos`.`marca` LEFT JOIN `marca_modelo` as marca_modelo1 ON `marca_modelo1`.`id_mmodelo`=`dispositivos`.`modelo` LEFT JOIN `unidades` as unidades1 ON `unidades1`.`id_unidades`=`dispositivos`.`ubicacion` LEFT JOIN `tipo_clasifica_riesgo` as tipo_clasifica_riesgo1 ON `tipo_clasifica_riesgo1`.`id`=`dispositivos`.`clasificacion_riesgo` LEFT JOIN `tipo_estado_dispo` as tipo_estado_dispo1 ON `tipo_estado_dispo1`.`id`=`dispositivos`.`estado` LEFT JOIN `compra_dispo` as compra_dispo1 ON `compra_dispo1`.`id`=`dispositivos`.`id_compra_ingreso` LEFT JOIN `ciudades` as ciudades1 ON `ciudades1`.`id_ciudad`=`unidades1`.`ciudad` ORDER BY 2',
				'dispo_serial' => 'SELECT `dispositivos`.`id_dispo`, `dispositivos`.`serial` FROM `dispositivos` LEFT JOIN `tipo_dispositivo` as tipo_dispositivo1 ON `tipo_dispositivo1`.`id_tipodispo`=`dispositivos`.`tipo_dispositivo` LEFT JOIN `marcas` as marcas1 ON `marcas1`.`id_marca`=`dispositivos`.`marca` LEFT JOIN `marca_modelo` as marca_modelo1 ON `marca_modelo1`.`id_mmodelo`=`dispositivos`.`modelo` LEFT JOIN `unidades` as unidades1 ON `unidades1`.`id_unidades`=`dispositivos`.`ubicacion` LEFT JOIN `tipo_clasifica_riesgo` as tipo_clasifica_riesgo1 ON `tipo_clasifica_riesgo1`.`id`=`dispositivos`.`clasificacion_riesgo` LEFT JOIN `tipo_estado_dispo` as tipo_estado_dispo1 ON `tipo_estado_dispo1`.`id`=`dispositivos`.`estado` LEFT JOIN `compra_dispo` as compra_dispo1 ON `compra_dispo1`.`id`=`dispositivos`.`id_compra_ingreso` LEFT JOIN `ciudades` as ciudades1 ON `ciudades1`.`id_ciudad`=`unidades1`.`ciudad` ORDER BY 2',
			],
			'financiero' => [
				'id_dispo' => 'SELECT `dispositivos`.`id_dispo`, `dispositivos`.`id_dispo` FROM `dispositivos` LEFT JOIN `tipo_dispositivo` as tipo_dispositivo1 ON `tipo_dispositivo1`.`id_tipodispo`=`dispositivos`.`tipo_dispositivo` LEFT JOIN `marcas` as marcas1 ON `marcas1`.`id_marca`=`dispositivos`.`marca` LEFT JOIN `marca_modelo` as marca_modelo1 ON `marca_modelo1`.`id_mmodelo`=`dispositivos`.`modelo` LEFT JOIN `unidades` as unidades1 ON `unidades1`.`id_unidades`=`dispositivos`.`ubicacion` LEFT JOIN `tipo_clasifica_riesgo` as tipo_clasifica_riesgo1 ON `tipo_clasifica_riesgo1`.`id`=`dispositivos`.`clasificacion_riesgo` LEFT JOIN `tipo_estado_dispo` as tipo_estado_dispo1 ON `tipo_estado_dispo1`.`id`=`dispositivos`.`estado` LEFT JOIN `compra_dispo` as compra_dispo1 ON `compra_dispo1`.`id`=`dispositivos`.`id_compra_ingreso` LEFT JOIN `ciudades` as ciudades1 ON `ciudades1`.`id_ciudad`=`unidades1`.`ciudad` ORDER BY 2',
				'unidad' => 'SELECT `dispositivos`.`id_dispo`, IF(    CHAR_LENGTH(`unidades1`.`nombre`), CONCAT_WS(\'\',   `unidades1`.`nombre`), \'\') FROM `dispositivos` LEFT JOIN `tipo_dispositivo` as tipo_dispositivo1 ON `tipo_dispositivo1`.`id_tipodispo`=`dispositivos`.`tipo_dispositivo` LEFT JOIN `marcas` as marcas1 ON `marcas1`.`id_marca`=`dispositivos`.`marca` LEFT JOIN `marca_modelo` as marca_modelo1 ON `marca_modelo1`.`id_mmodelo`=`dispositivos`.`modelo` LEFT JOIN `unidades` as unidades1 ON `unidades1`.`id_unidades`=`dispositivos`.`ubicacion` LEFT JOIN `tipo_clasifica_riesgo` as tipo_clasifica_riesgo1 ON `tipo_clasifica_riesgo1`.`id`=`dispositivos`.`clasificacion_riesgo` LEFT JOIN `tipo_estado_dispo` as tipo_estado_dispo1 ON `tipo_estado_dispo1`.`id`=`dispositivos`.`estado` LEFT JOIN `compra_dispo` as compra_dispo1 ON `compra_dispo1`.`id`=`dispositivos`.`id_compra_ingreso` LEFT JOIN `ciudades` as ciudades1 ON `ciudades1`.`id_ciudad`=`unidades1`.`ciudad` ORDER BY 2',
			],
			'financiero_mobiliario' => [
				'id_dispo' => 'SELECT `mobiliario`.`id_mobiliario`, `mobiliario`.`id_mobiliario` FROM `mobiliario` LEFT JOIN `tipo_grupo_mobilia` as tipo_grupo_mobilia1 ON `tipo_grupo_mobilia1`.`id_gru_mo`=`mobiliario`.`grupo` LEFT JOIN `tipo_mobiliario` as tipo_mobiliario1 ON `tipo_mobiliario1`.`id`=`mobiliario`.`tipo_mobiliario` LEFT JOIN `unidades` as unidades1 ON `unidades1`.`id_unidades`=`mobiliario`.`ubicacion` LEFT JOIN `unidades` as unidades2 ON `unidades2`.`id_unidades`=`mobiliario`.`unidad` ORDER BY 2',
				'unidad' => 'SELECT `mobiliario`.`id_mobiliario`, IF(CHAR_LENGTH(`mobiliario`.`unidad`), CONCAT_WS(\'\', IF(    CHAR_LENGTH(`unidades2`.`nombre`), CONCAT_WS(\'\',   `unidades2`.`nombre`), \'\'), \' - \'), \'\') FROM `mobiliario` LEFT JOIN `tipo_grupo_mobilia` as tipo_grupo_mobilia1 ON `tipo_grupo_mobilia1`.`id_gru_mo`=`mobiliario`.`grupo` LEFT JOIN `tipo_mobiliario` as tipo_mobiliario1 ON `tipo_mobiliario1`.`id`=`mobiliario`.`tipo_mobiliario` LEFT JOIN `unidades` as unidades1 ON `unidades1`.`id_unidades`=`mobiliario`.`ubicacion` LEFT JOIN `unidades` as unidades2 ON `unidades2`.`id_unidades`=`mobiliario`.`unidad` ORDER BY 2',
			],
			'prestador' => [
				'razon_social' => 'SELECT `tipo_razon_social`.`id`, `tipo_razon_social`.`razon_social` FROM `tipo_razon_social` ORDER BY 2',
				'nit' => 'SELECT `tipo_razon_social`.`id`, `tipo_razon_social`.`nit` FROM `tipo_razon_social` ORDER BY 2',
			],
			'docu_modelo' => [
				'tipo_dispo' => 'SELECT `tipo_dispositivo`.`id_tipodispo`, `tipo_dispositivo`.`tipo_dispositivo` FROM `tipo_dispositivo` LEFT JOIN `dispositivo_tipo_grupo` as dispositivo_tipo_grupo1 ON `dispositivo_tipo_grupo1`.`id`=`tipo_dispositivo`.`grupo_dispo` ORDER BY 2',
				'marca' => 'SELECT `marcas`.`id_marca`, `marcas`.`marca` FROM `marcas` ORDER BY 2',
				'modelo' => 'SELECT `marca_modelo`.`id_mmodelo`, `marca_modelo`.`modelo` FROM `marca_modelo` LEFT JOIN `marcas` as marcas1 ON `marcas1`.`id_marca`=`marca_modelo`.`marca` ORDER BY 2',
				'tipo_documento' => 'SELECT `tipo_documento`.`id_tipodoc`, `tipo_documento`.`tipo_doc` FROM `tipo_documento` LEFT JOIN `tipo_document_grupo` as tipo_document_grupo1 ON `tipo_document_grupo1`.`id`=`tipo_documento`.`grupo` ORDER BY 2',
			],
			'facturas' => [
				'id_dispo' => 'SELECT `dispositivos`.`id_dispo`, `dispositivos`.`id_dispo` FROM `dispositivos` LEFT JOIN `tipo_dispositivo` as tipo_dispositivo1 ON `tipo_dispositivo1`.`id_tipodispo`=`dispositivos`.`tipo_dispositivo` LEFT JOIN `marcas` as marcas1 ON `marcas1`.`id_marca`=`dispositivos`.`marca` LEFT JOIN `marca_modelo` as marca_modelo1 ON `marca_modelo1`.`id_mmodelo`=`dispositivos`.`modelo` LEFT JOIN `unidades` as unidades1 ON `unidades1`.`id_unidades`=`dispositivos`.`ubicacion` LEFT JOIN `tipo_clasifica_riesgo` as tipo_clasifica_riesgo1 ON `tipo_clasifica_riesgo1`.`id`=`dispositivos`.`clasificacion_riesgo` LEFT JOIN `tipo_estado_dispo` as tipo_estado_dispo1 ON `tipo_estado_dispo1`.`id`=`dispositivos`.`estado` LEFT JOIN `compra_dispo` as compra_dispo1 ON `compra_dispo1`.`id`=`dispositivos`.`id_compra_ingreso` LEFT JOIN `ciudades` as ciudades1 ON `ciudades1`.`id_ciudad`=`unidades1`.`ciudad` ORDER BY 2',
				'proveedor' => 'SELECT `contactos`.`id_contactos`, `contactos`.`nombre` FROM `contactos` LEFT JOIN `contactos_tipo_contacto` as contactos_tipo_contacto1 ON `contactos_tipo_contacto1`.`id_tipo_contacto`=`contactos`.`tipo_contacto` LEFT JOIN `tipo_iden` as tipo_iden1 ON `tipo_iden1`.`id_iden`=`contactos`.`tipo_iden` LEFT JOIN `ciudades` as ciudades1 ON `ciudades1`.`id_ciudad`=`contactos`.`ciudad` LEFT JOIN `tipo_relacion` as tipo_relacion1 ON `tipo_relacion1`.`id_tiporelac`=`contactos`.`tipo_relacion` ORDER BY 2',
				'identificacion' => 'SELECT `contactos`.`id_contactos`, `contactos`.`identificacion` FROM `contactos` LEFT JOIN `contactos_tipo_contacto` as contactos_tipo_contacto1 ON `contactos_tipo_contacto1`.`id_tipo_contacto`=`contactos`.`tipo_contacto` LEFT JOIN `tipo_iden` as tipo_iden1 ON `tipo_iden1`.`id_iden`=`contactos`.`tipo_iden` LEFT JOIN `ciudades` as ciudades1 ON `ciudades1`.`id_ciudad`=`contactos`.`ciudad` LEFT JOIN `tipo_relacion` as tipo_relacion1 ON `tipo_relacion1`.`id_tiporelac`=`contactos`.`tipo_relacion` ORDER BY 2',
				'id_compras' => 'SELECT `compras`.`id`, `compras`.`id` FROM `compras` LEFT JOIN `tipo_compra` as tipo_compra1 ON `tipo_compra1`.`id`=`compras`.`tipo_compra` LEFT JOIN `tipo_estado_compra` as tipo_estado_compra1 ON `tipo_estado_compra1`.`id`=`compras`.`estado` ORDER BY 2',
			],
			'formatos' => [
				'tipo_formato' => 'SELECT `tipo_formatos`.`id`, `tipo_formatos`.`tipo_formato` FROM `tipo_formatos` ORDER BY 2',
				'tipo_dispositivo' => 'SELECT `tipo_dispositivo`.`id_tipodispo`, `tipo_dispositivo`.`tipo_dispositivo` FROM `tipo_dispositivo` LEFT JOIN `dispositivo_tipo_grupo` as dispositivo_tipo_grupo1 ON `dispositivo_tipo_grupo1`.`id`=`tipo_dispositivo`.`grupo_dispo` ORDER BY 2',
			],
			'dispo_fuera' => [
				'img' => 'SELECT `dispositivos`.`id_dispo`, IF(    CHAR_LENGTH(`marca_modelo1`.`img`), CONCAT_WS(\'\',   `marca_modelo1`.`img`), \'\') FROM `dispositivos` LEFT JOIN `tipo_dispositivo` as tipo_dispositivo1 ON `tipo_dispositivo1`.`id_tipodispo`=`dispositivos`.`tipo_dispositivo` LEFT JOIN `marcas` as marcas1 ON `marcas1`.`id_marca`=`dispositivos`.`marca` LEFT JOIN `marca_modelo` as marca_modelo1 ON `marca_modelo1`.`id_mmodelo`=`dispositivos`.`modelo` LEFT JOIN `unidades` as unidades1 ON `unidades1`.`id_unidades`=`dispositivos`.`ubicacion` LEFT JOIN `tipo_clasifica_riesgo` as tipo_clasifica_riesgo1 ON `tipo_clasifica_riesgo1`.`id`=`dispositivos`.`clasificacion_riesgo` LEFT JOIN `tipo_estado_dispo` as tipo_estado_dispo1 ON `tipo_estado_dispo1`.`id`=`dispositivos`.`estado` LEFT JOIN `compra_dispo` as compra_dispo1 ON `compra_dispo1`.`id`=`dispositivos`.`id_compra_ingreso` LEFT JOIN `ciudades` as ciudades1 ON `ciudades1`.`id_ciudad`=`unidades1`.`ciudad` ORDER BY 2',
				'codigo' => 'SELECT `dispositivos`.`id_dispo`, `dispositivos`.`code` FROM `dispositivos` LEFT JOIN `tipo_dispositivo` as tipo_dispositivo1 ON `tipo_dispositivo1`.`id_tipodispo`=`dispositivos`.`tipo_dispositivo` LEFT JOIN `marcas` as marcas1 ON `marcas1`.`id_marca`=`dispositivos`.`marca` LEFT JOIN `marca_modelo` as marca_modelo1 ON `marca_modelo1`.`id_mmodelo`=`dispositivos`.`modelo` LEFT JOIN `unidades` as unidades1 ON `unidades1`.`id_unidades`=`dispositivos`.`ubicacion` LEFT JOIN `tipo_clasifica_riesgo` as tipo_clasifica_riesgo1 ON `tipo_clasifica_riesgo1`.`id`=`dispositivos`.`clasificacion_riesgo` LEFT JOIN `tipo_estado_dispo` as tipo_estado_dispo1 ON `tipo_estado_dispo1`.`id`=`dispositivos`.`estado` LEFT JOIN `compra_dispo` as compra_dispo1 ON `compra_dispo1`.`id`=`dispositivos`.`id_compra_ingreso` LEFT JOIN `ciudades` as ciudades1 ON `ciudades1`.`id_ciudad`=`unidades1`.`ciudad` ORDER BY 2',
				'serial' => 'SELECT `dispositivos`.`id_dispo`, `dispositivos`.`serial` FROM `dispositivos` LEFT JOIN `tipo_dispositivo` as tipo_dispositivo1 ON `tipo_dispositivo1`.`id_tipodispo`=`dispositivos`.`tipo_dispositivo` LEFT JOIN `marcas` as marcas1 ON `marcas1`.`id_marca`=`dispositivos`.`marca` LEFT JOIN `marca_modelo` as marca_modelo1 ON `marca_modelo1`.`id_mmodelo`=`dispositivos`.`modelo` LEFT JOIN `unidades` as unidades1 ON `unidades1`.`id_unidades`=`dispositivos`.`ubicacion` LEFT JOIN `tipo_clasifica_riesgo` as tipo_clasifica_riesgo1 ON `tipo_clasifica_riesgo1`.`id`=`dispositivos`.`clasificacion_riesgo` LEFT JOIN `tipo_estado_dispo` as tipo_estado_dispo1 ON `tipo_estado_dispo1`.`id`=`dispositivos`.`estado` LEFT JOIN `compra_dispo` as compra_dispo1 ON `compra_dispo1`.`id`=`dispositivos`.`id_compra_ingreso` LEFT JOIN `ciudades` as ciudades1 ON `ciudades1`.`id_ciudad`=`unidades1`.`ciudad` ORDER BY 2',
				'ubicacion_final' => 'SELECT `dispositivos`.`id_dispo`, IF(CHAR_LENGTH(`dispositivos`.`ubicacion_abre`) || CHAR_LENGTH(`dispositivos`.`ubicacion`), CONCAT_WS(\'\', IF(    CHAR_LENGTH(`unidades1`.`abreviado`) || CHAR_LENGTH(`ciudades1`.`ciudad`), CONCAT_WS(\'\',   `unidades1`.`abreviado`, \' - \', `ciudades1`.`ciudad`), \'\'), \' | \', IF(    CHAR_LENGTH(`unidades1`.`nombre`), CONCAT_WS(\'\',   `unidades1`.`nombre`), \'\')), \'\') FROM `dispositivos` LEFT JOIN `tipo_dispositivo` as tipo_dispositivo1 ON `tipo_dispositivo1`.`id_tipodispo`=`dispositivos`.`tipo_dispositivo` LEFT JOIN `marcas` as marcas1 ON `marcas1`.`id_marca`=`dispositivos`.`marca` LEFT JOIN `marca_modelo` as marca_modelo1 ON `marca_modelo1`.`id_mmodelo`=`dispositivos`.`modelo` LEFT JOIN `unidades` as unidades1 ON `unidades1`.`id_unidades`=`dispositivos`.`ubicacion` LEFT JOIN `tipo_clasifica_riesgo` as tipo_clasifica_riesgo1 ON `tipo_clasifica_riesgo1`.`id`=`dispositivos`.`clasificacion_riesgo` LEFT JOIN `tipo_estado_dispo` as tipo_estado_dispo1 ON `tipo_estado_dispo1`.`id`=`dispositivos`.`estado` LEFT JOIN `compra_dispo` as compra_dispo1 ON `compra_dispo1`.`id`=`dispositivos`.`id_compra_ingreso` LEFT JOIN `ciudades` as ciudades1 ON `ciudades1`.`id_ciudad`=`unidades1`.`ciudad` ORDER BY 2',
				'tipo_fuera_servicio' => 'SELECT `tipo_fuera_servicio`.`id`, `tipo_fuera_servicio`.`tipo_fuera_servicio` FROM `tipo_fuera_servicio` ORDER BY 2',
			],
			'dispositivo_tipo_grupo' => [
			],
			'tipo_relacion' => [
			],
			'tipo_dispositivo' => [
				'grupo_dispo' => 'SELECT `dispositivo_tipo_grupo`.`id`, `dispositivo_tipo_grupo`.`grupo` FROM `dispositivo_tipo_grupo` ORDER BY 2',
			],
			'tipo_documento' => [
				'grupo' => 'SELECT `tipo_document_grupo`.`id`, `tipo_document_grupo`.`grupo` FROM `tipo_document_grupo` ORDER BY 2',
			],
			'tipo_iden' => [
			],
			'tipo_razon_social' => [
			],
			'tipo_mobiliario' => [
				'grupo_mobi' => 'SELECT `tipo_grupo_mobilia`.`id_gru_mo`, `tipo_grupo_mobilia`.`grupo` FROM `tipo_grupo_mobilia` ORDER BY 2',
			],
			'tipo_grupo_mobilia' => [
			],
			'tipo_estado_dispo' => [
			],
			'tipo_movimiento' => [
			],
			'tipo_estado_movi' => [
			],
			'tipo_estado_verifica' => [
			],
			'tipo_mtto' => [
			],
			'tipo_calibracion' => [
			],
			'tipo_accesorio' => [
			],
			'tipo_formatos' => [
			],
			'dispo_detalles_tecnicos' => [
				'id_dispo' => 'SELECT `dispositivos`.`id_dispo`, `dispositivos`.`code` FROM `dispositivos` LEFT JOIN `tipo_dispositivo` as tipo_dispositivo1 ON `tipo_dispositivo1`.`id_tipodispo`=`dispositivos`.`tipo_dispositivo` LEFT JOIN `marcas` as marcas1 ON `marcas1`.`id_marca`=`dispositivos`.`marca` LEFT JOIN `marca_modelo` as marca_modelo1 ON `marca_modelo1`.`id_mmodelo`=`dispositivos`.`modelo` LEFT JOIN `unidades` as unidades1 ON `unidades1`.`id_unidades`=`dispositivos`.`ubicacion` LEFT JOIN `tipo_clasifica_riesgo` as tipo_clasifica_riesgo1 ON `tipo_clasifica_riesgo1`.`id`=`dispositivos`.`clasificacion_riesgo` LEFT JOIN `tipo_estado_dispo` as tipo_estado_dispo1 ON `tipo_estado_dispo1`.`id`=`dispositivos`.`estado` LEFT JOIN `compra_dispo` as compra_dispo1 ON `compra_dispo1`.`id`=`dispositivos`.`id_compra_ingreso` LEFT JOIN `ciudades` as ciudades1 ON `ciudades1`.`id_ciudad`=`unidades1`.`ciudad` ORDER BY 2',
			],
			'tipo_estado_observaciones' => [
			],
			'movi_envio' => [
				'id_movi' => 'SELECT `movimientos`.`id_movi`, `movimientos`.`id_movi` FROM `movimientos` LEFT JOIN `dispositivos` as dispositivos1 ON `dispositivos1`.`id_dispo`=`movimientos`.`codigo_dispo` LEFT JOIN `tipo_estado_movi` as tipo_estado_movi1 ON `tipo_estado_movi1`.`id`=`movimientos`.`estado_movi` LEFT JOIN `tipo_dispositivo` as tipo_dispositivo1 ON `tipo_dispositivo1`.`id_tipodispo`=`dispositivos1`.`tipo_dispositivo` ORDER BY 2',
				'origen' => 'SELECT `unidades`.`id_unidades`, `unidades`.`nombre` FROM `unidades` LEFT JOIN `ciudades` as ciudades1 ON `ciudades1`.`id_ciudad`=`unidades`.`ciudad` LEFT JOIN `prestador` as prestador1 ON `prestador1`.`id`=`unidades`.`prestador` ORDER BY 2',
				'ubicacion' => 'SELECT `unidades`.`id_unidades`, `unidades`.`direccion` FROM `unidades` LEFT JOIN `ciudades` as ciudades1 ON `ciudades1`.`id_ciudad`=`unidades`.`ciudad` LEFT JOIN `prestador` as prestador1 ON `prestador1`.`id`=`unidades`.`prestador` ORDER BY 2',
				'ciudad' => 'SELECT `ciudades`.`id_ciudad`, `ciudades`.`ciudad` FROM `ciudades` ORDER BY 2',
				'nombre' => 'SELECT `contactos`.`id_contactos`, `contactos`.`nombre` FROM `contactos` LEFT JOIN `contactos_tipo_contacto` as contactos_tipo_contacto1 ON `contactos_tipo_contacto1`.`id_tipo_contacto`=`contactos`.`tipo_contacto` LEFT JOIN `tipo_iden` as tipo_iden1 ON `tipo_iden1`.`id_iden`=`contactos`.`tipo_iden` LEFT JOIN `ciudades` as ciudades1 ON `ciudades1`.`id_ciudad`=`contactos`.`ciudad` LEFT JOIN `tipo_relacion` as tipo_relacion1 ON `tipo_relacion1`.`id_tiporelac`=`contactos`.`tipo_relacion` ORDER BY 2',
				'telefono' => 'SELECT `contactos`.`id_contactos`, `contactos`.`telefono` FROM `contactos` LEFT JOIN `contactos_tipo_contacto` as contactos_tipo_contacto1 ON `contactos_tipo_contacto1`.`id_tipo_contacto`=`contactos`.`tipo_contacto` LEFT JOIN `tipo_iden` as tipo_iden1 ON `tipo_iden1`.`id_iden`=`contactos`.`tipo_iden` LEFT JOIN `ciudades` as ciudades1 ON `ciudades1`.`id_ciudad`=`contactos`.`ciudad` LEFT JOIN `tipo_relacion` as tipo_relacion1 ON `tipo_relacion1`.`id_tiporelac`=`contactos`.`tipo_relacion` ORDER BY 2',
			],
			'movi_recepcion' => [
				'id_movi' => 'SELECT `movimientos`.`id_movi`, `movimientos`.`id_movi` FROM `movimientos` LEFT JOIN `dispositivos` as dispositivos1 ON `dispositivos1`.`id_dispo`=`movimientos`.`codigo_dispo` LEFT JOIN `tipo_estado_movi` as tipo_estado_movi1 ON `tipo_estado_movi1`.`id`=`movimientos`.`estado_movi` LEFT JOIN `tipo_dispositivo` as tipo_dispositivo1 ON `tipo_dispositivo1`.`id_tipodispo`=`dispositivos1`.`tipo_dispositivo` ORDER BY 2',
				'destino' => 'SELECT `unidades`.`id_unidades`, IF(CHAR_LENGTH(`unidades`.`nombre`) || CHAR_LENGTH(`unidades`.`abreviado`), CONCAT_WS(\'\', `unidades`.`nombre`, \' | \', `unidades`.`abreviado`), \'\') FROM `unidades` LEFT JOIN `ciudades` as ciudades1 ON `ciudades1`.`id_ciudad`=`unidades`.`ciudad` LEFT JOIN `prestador` as prestador1 ON `prestador1`.`id`=`unidades`.`prestador` ORDER BY 2',
				'o_direccion' => 'SELECT `unidades`.`id_unidades`, `unidades`.`direccion` FROM `unidades` LEFT JOIN `ciudades` as ciudades1 ON `ciudades1`.`id_ciudad`=`unidades`.`ciudad` LEFT JOIN `prestador` as prestador1 ON `prestador1`.`id`=`unidades`.`prestador` ORDER BY 2',
				'ciudad' => 'SELECT `unidades`.`id_unidades`, IF(    CHAR_LENGTH(`ciudades1`.`ciudad`), CONCAT_WS(\'\',   `ciudades1`.`ciudad`), \'\') FROM `unidades` LEFT JOIN `ciudades` as ciudades1 ON `ciudades1`.`id_ciudad`=`unidades`.`ciudad` LEFT JOIN `prestador` as prestador1 ON `prestador1`.`id`=`unidades`.`prestador` ORDER BY 2',
				'nombre' => 'SELECT `contactos`.`id_contactos`, `contactos`.`nombre` FROM `contactos` LEFT JOIN `contactos_tipo_contacto` as contactos_tipo_contacto1 ON `contactos_tipo_contacto1`.`id_tipo_contacto`=`contactos`.`tipo_contacto` LEFT JOIN `tipo_iden` as tipo_iden1 ON `tipo_iden1`.`id_iden`=`contactos`.`tipo_iden` LEFT JOIN `ciudades` as ciudades1 ON `ciudades1`.`id_ciudad`=`contactos`.`ciudad` LEFT JOIN `tipo_relacion` as tipo_relacion1 ON `tipo_relacion1`.`id_tiporelac`=`contactos`.`tipo_relacion` ORDER BY 2',
				'telefono' => 'SELECT `contactos`.`id_contactos`, `contactos`.`telefono` FROM `contactos` LEFT JOIN `contactos_tipo_contacto` as contactos_tipo_contacto1 ON `contactos_tipo_contacto1`.`id_tipo_contacto`=`contactos`.`tipo_contacto` LEFT JOIN `tipo_iden` as tipo_iden1 ON `tipo_iden1`.`id_iden`=`contactos`.`tipo_iden` LEFT JOIN `ciudades` as ciudades1 ON `ciudades1`.`id_ciudad`=`contactos`.`ciudad` LEFT JOIN `tipo_relacion` as tipo_relacion1 ON `tipo_relacion1`.`id_tiporelac`=`contactos`.`tipo_relacion` ORDER BY 2',
			],
			'tipo_fuera_servicio' => [
			],
			'tipo_documento_ss' => [
			],
			'tipo_parentesco' => [
			],
			'tipo_rh' => [
			],
			'accesorio_dispo_relacion' => [
				'id_dispo' => 'SELECT `dispositivos`.`id_dispo`, `dispositivos`.`code` FROM `dispositivos` LEFT JOIN `tipo_dispositivo` as tipo_dispositivo1 ON `tipo_dispositivo1`.`id_tipodispo`=`dispositivos`.`tipo_dispositivo` LEFT JOIN `marcas` as marcas1 ON `marcas1`.`id_marca`=`dispositivos`.`marca` LEFT JOIN `marca_modelo` as marca_modelo1 ON `marca_modelo1`.`id_mmodelo`=`dispositivos`.`modelo` LEFT JOIN `unidades` as unidades1 ON `unidades1`.`id_unidades`=`dispositivos`.`ubicacion` LEFT JOIN `tipo_clasifica_riesgo` as tipo_clasifica_riesgo1 ON `tipo_clasifica_riesgo1`.`id`=`dispositivos`.`clasificacion_riesgo` LEFT JOIN `tipo_estado_dispo` as tipo_estado_dispo1 ON `tipo_estado_dispo1`.`id`=`dispositivos`.`estado` LEFT JOIN `compra_dispo` as compra_dispo1 ON `compra_dispo1`.`id`=`dispositivos`.`id_compra_ingreso` LEFT JOIN `ciudades` as ciudades1 ON `ciudades1`.`id_ciudad`=`unidades1`.`ciudad` ORDER BY 2',
				'id_accesorio' => 'SELECT `dispositivos`.`id_dispo`, IF(CHAR_LENGTH(`dispositivos`.`code`), CONCAT_WS(\'\', `dispositivos`.`code`, \' \'), \'\') FROM `dispositivos` LEFT JOIN `tipo_dispositivo` as tipo_dispositivo1 ON `tipo_dispositivo1`.`id_tipodispo`=`dispositivos`.`tipo_dispositivo` LEFT JOIN `marcas` as marcas1 ON `marcas1`.`id_marca`=`dispositivos`.`marca` LEFT JOIN `marca_modelo` as marca_modelo1 ON `marca_modelo1`.`id_mmodelo`=`dispositivos`.`modelo` LEFT JOIN `unidades` as unidades1 ON `unidades1`.`id_unidades`=`dispositivos`.`ubicacion` LEFT JOIN `tipo_clasifica_riesgo` as tipo_clasifica_riesgo1 ON `tipo_clasifica_riesgo1`.`id`=`dispositivos`.`clasificacion_riesgo` LEFT JOIN `tipo_estado_dispo` as tipo_estado_dispo1 ON `tipo_estado_dispo1`.`id`=`dispositivos`.`estado` LEFT JOIN `compra_dispo` as compra_dispo1 ON `compra_dispo1`.`id`=`dispositivos`.`id_compra_ingreso` LEFT JOIN `ciudades` as ciudades1 ON `ciudades1`.`id_ciudad`=`unidades1`.`ciudad` ORDER BY 2',
				'tipo_dispo' => 'SELECT `dispositivos`.`id_dispo`, IF(    CHAR_LENGTH(`tipo_dispositivo1`.`tipo_dispositivo`), CONCAT_WS(\'\',   `tipo_dispositivo1`.`tipo_dispositivo`), \'\') FROM `dispositivos` LEFT JOIN `tipo_dispositivo` as tipo_dispositivo1 ON `tipo_dispositivo1`.`id_tipodispo`=`dispositivos`.`tipo_dispositivo` LEFT JOIN `marcas` as marcas1 ON `marcas1`.`id_marca`=`dispositivos`.`marca` LEFT JOIN `marca_modelo` as marca_modelo1 ON `marca_modelo1`.`id_mmodelo`=`dispositivos`.`modelo` LEFT JOIN `unidades` as unidades1 ON `unidades1`.`id_unidades`=`dispositivos`.`ubicacion` LEFT JOIN `tipo_clasifica_riesgo` as tipo_clasifica_riesgo1 ON `tipo_clasifica_riesgo1`.`id`=`dispositivos`.`clasificacion_riesgo` LEFT JOIN `tipo_estado_dispo` as tipo_estado_dispo1 ON `tipo_estado_dispo1`.`id`=`dispositivos`.`estado` LEFT JOIN `compra_dispo` as compra_dispo1 ON `compra_dispo1`.`id`=`dispositivos`.`id_compra_ingreso` LEFT JOIN `ciudades` as ciudades1 ON `ciudades1`.`id_ciudad`=`unidades1`.`ciudad` ORDER BY 2',
				'serial' => 'SELECT `dispositivos`.`id_dispo`, `dispositivos`.`serial` FROM `dispositivos` LEFT JOIN `tipo_dispositivo` as tipo_dispositivo1 ON `tipo_dispositivo1`.`id_tipodispo`=`dispositivos`.`tipo_dispositivo` LEFT JOIN `marcas` as marcas1 ON `marcas1`.`id_marca`=`dispositivos`.`marca` LEFT JOIN `marca_modelo` as marca_modelo1 ON `marca_modelo1`.`id_mmodelo`=`dispositivos`.`modelo` LEFT JOIN `unidades` as unidades1 ON `unidades1`.`id_unidades`=`dispositivos`.`ubicacion` LEFT JOIN `tipo_clasifica_riesgo` as tipo_clasifica_riesgo1 ON `tipo_clasifica_riesgo1`.`id`=`dispositivos`.`clasificacion_riesgo` LEFT JOIN `tipo_estado_dispo` as tipo_estado_dispo1 ON `tipo_estado_dispo1`.`id`=`dispositivos`.`estado` LEFT JOIN `compra_dispo` as compra_dispo1 ON `compra_dispo1`.`id`=`dispositivos`.`id_compra_ingreso` LEFT JOIN `ciudades` as ciudades1 ON `ciudades1`.`id_ciudad`=`unidades1`.`ciudad` ORDER BY 2',
				'marca_modelo' => 'SELECT `dispositivos`.`id_dispo`, IF(CHAR_LENGTH(`dispositivos`.`marca`) || CHAR_LENGTH(`dispositivos`.`modelo`), CONCAT_WS(\'\', IF(    CHAR_LENGTH(`marcas1`.`marca`), CONCAT_WS(\'\',   `marcas1`.`marca`), \'\'), \' - \', IF(    CHAR_LENGTH(`marca_modelo1`.`modelo`), CONCAT_WS(\'\',   `marca_modelo1`.`modelo`), \'\')), \'\') FROM `dispositivos` LEFT JOIN `tipo_dispositivo` as tipo_dispositivo1 ON `tipo_dispositivo1`.`id_tipodispo`=`dispositivos`.`tipo_dispositivo` LEFT JOIN `marcas` as marcas1 ON `marcas1`.`id_marca`=`dispositivos`.`marca` LEFT JOIN `marca_modelo` as marca_modelo1 ON `marca_modelo1`.`id_mmodelo`=`dispositivos`.`modelo` LEFT JOIN `unidades` as unidades1 ON `unidades1`.`id_unidades`=`dispositivos`.`ubicacion` LEFT JOIN `tipo_clasifica_riesgo` as tipo_clasifica_riesgo1 ON `tipo_clasifica_riesgo1`.`id`=`dispositivos`.`clasificacion_riesgo` LEFT JOIN `tipo_estado_dispo` as tipo_estado_dispo1 ON `tipo_estado_dispo1`.`id`=`dispositivos`.`estado` LEFT JOIN `compra_dispo` as compra_dispo1 ON `compra_dispo1`.`id`=`dispositivos`.`id_compra_ingreso` LEFT JOIN `ciudades` as ciudades1 ON `ciudades1`.`id_ciudad`=`unidades1`.`ciudad` ORDER BY 2',
			],
			'observaciones' => [
				'estado_observacion' => 'SELECT `tipo_estado_observa`.`id`, `tipo_estado_observa`.`tipo_estado_observa` FROM `tipo_estado_observa` ORDER BY 2',
				'estado' => 'SELECT `tipo_estado_observaciones`.`id`, `tipo_estado_observaciones`.`estado_observa` FROM `tipo_estado_observaciones` ORDER BY 2',
				'codigo' => 'SELECT `dispositivos`.`id_dispo`, `dispositivos`.`code` FROM `dispositivos` LEFT JOIN `tipo_dispositivo` as tipo_dispositivo1 ON `tipo_dispositivo1`.`id_tipodispo`=`dispositivos`.`tipo_dispositivo` LEFT JOIN `marcas` as marcas1 ON `marcas1`.`id_marca`=`dispositivos`.`marca` LEFT JOIN `marca_modelo` as marca_modelo1 ON `marca_modelo1`.`id_mmodelo`=`dispositivos`.`modelo` LEFT JOIN `unidades` as unidades1 ON `unidades1`.`id_unidades`=`dispositivos`.`ubicacion` LEFT JOIN `tipo_clasifica_riesgo` as tipo_clasifica_riesgo1 ON `tipo_clasifica_riesgo1`.`id`=`dispositivos`.`clasificacion_riesgo` LEFT JOIN `tipo_estado_dispo` as tipo_estado_dispo1 ON `tipo_estado_dispo1`.`id`=`dispositivos`.`estado` LEFT JOIN `compra_dispo` as compra_dispo1 ON `compra_dispo1`.`id`=`dispositivos`.`id_compra_ingreso` LEFT JOIN `ciudades` as ciudades1 ON `ciudades1`.`id_ciudad`=`unidades1`.`ciudad` ORDER BY 2',
				'tipo_dispo' => 'SELECT `dispositivos`.`id_dispo`, IF(    CHAR_LENGTH(`tipo_dispositivo1`.`tipo_dispositivo`), CONCAT_WS(\'\',   `tipo_dispositivo1`.`tipo_dispositivo`), \'\') FROM `dispositivos` LEFT JOIN `tipo_dispositivo` as tipo_dispositivo1 ON `tipo_dispositivo1`.`id_tipodispo`=`dispositivos`.`tipo_dispositivo` LEFT JOIN `marcas` as marcas1 ON `marcas1`.`id_marca`=`dispositivos`.`marca` LEFT JOIN `marca_modelo` as marca_modelo1 ON `marca_modelo1`.`id_mmodelo`=`dispositivos`.`modelo` LEFT JOIN `unidades` as unidades1 ON `unidades1`.`id_unidades`=`dispositivos`.`ubicacion` LEFT JOIN `tipo_clasifica_riesgo` as tipo_clasifica_riesgo1 ON `tipo_clasifica_riesgo1`.`id`=`dispositivos`.`clasificacion_riesgo` LEFT JOIN `tipo_estado_dispo` as tipo_estado_dispo1 ON `tipo_estado_dispo1`.`id`=`dispositivos`.`estado` LEFT JOIN `compra_dispo` as compra_dispo1 ON `compra_dispo1`.`id`=`dispositivos`.`id_compra_ingreso` LEFT JOIN `ciudades` as ciudades1 ON `ciudades1`.`id_ciudad`=`unidades1`.`ciudad` ORDER BY 2',
				'serial' => 'SELECT `dispositivos`.`id_dispo`, `dispositivos`.`serial` FROM `dispositivos` LEFT JOIN `tipo_dispositivo` as tipo_dispositivo1 ON `tipo_dispositivo1`.`id_tipodispo`=`dispositivos`.`tipo_dispositivo` LEFT JOIN `marcas` as marcas1 ON `marcas1`.`id_marca`=`dispositivos`.`marca` LEFT JOIN `marca_modelo` as marca_modelo1 ON `marca_modelo1`.`id_mmodelo`=`dispositivos`.`modelo` LEFT JOIN `unidades` as unidades1 ON `unidades1`.`id_unidades`=`dispositivos`.`ubicacion` LEFT JOIN `tipo_clasifica_riesgo` as tipo_clasifica_riesgo1 ON `tipo_clasifica_riesgo1`.`id`=`dispositivos`.`clasificacion_riesgo` LEFT JOIN `tipo_estado_dispo` as tipo_estado_dispo1 ON `tipo_estado_dispo1`.`id`=`dispositivos`.`estado` LEFT JOIN `compra_dispo` as compra_dispo1 ON `compra_dispo1`.`id`=`dispositivos`.`id_compra_ingreso` LEFT JOIN `ciudades` as ciudades1 ON `ciudades1`.`id_ciudad`=`unidades1`.`ciudad` ORDER BY 2',
				'unidad' => 'SELECT `unidades`.`id_unidades`, IF(CHAR_LENGTH(`unidades`.`nombre`) || CHAR_LENGTH(`unidades`.`abreviado`), CONCAT_WS(\'\', `unidades`.`nombre`, \' - \', `unidades`.`abreviado`), \'\') FROM `unidades` LEFT JOIN `ciudades` as ciudades1 ON `ciudades1`.`id_ciudad`=`unidades`.`ciudad` LEFT JOIN `prestador` as prestador1 ON `prestador1`.`id`=`unidades`.`prestador` ORDER BY 2',
			],
			'foto_observacion' => [
				'id_observacion' => 'SELECT `observaciones`.`id`, `observaciones`.`id` FROM `observaciones` LEFT JOIN `tipo_estado_observa` as tipo_estado_observa1 ON `tipo_estado_observa1`.`id`=`observaciones`.`estado_observacion` LEFT JOIN `tipo_estado_observaciones` as tipo_estado_observaciones1 ON `tipo_estado_observaciones1`.`id`=`observaciones`.`estado` LEFT JOIN `dispositivos` as dispositivos1 ON `dispositivos1`.`id_dispo`=`observaciones`.`codigo` LEFT JOIN `unidades` as unidades1 ON `unidades1`.`id_unidades`=`observaciones`.`unidad` LEFT JOIN `tipo_dispositivo` as tipo_dispositivo1 ON `tipo_dispositivo1`.`id_tipodispo`=`dispositivos1`.`tipo_dispositivo` ORDER BY 2',
			],
			'progreso' => [
				'id_observacion' => 'SELECT `observaciones`.`id`, `observaciones`.`id` FROM `observaciones` LEFT JOIN `tipo_estado_observa` as tipo_estado_observa1 ON `tipo_estado_observa1`.`id`=`observaciones`.`estado_observacion` LEFT JOIN `tipo_estado_observaciones` as tipo_estado_observaciones1 ON `tipo_estado_observaciones1`.`id`=`observaciones`.`estado` LEFT JOIN `dispositivos` as dispositivos1 ON `dispositivos1`.`id_dispo`=`observaciones`.`codigo` LEFT JOIN `unidades` as unidades1 ON `unidades1`.`id_unidades`=`observaciones`.`unidad` LEFT JOIN `tipo_dispositivo` as tipo_dispositivo1 ON `tipo_dispositivo1`.`id_tipodispo`=`dispositivos1`.`tipo_dispositivo` ORDER BY 2',
				'estado_seguimiento' => 'SELECT `tipo_estado_observaciones`.`id`, `tipo_estado_observaciones`.`estado_observa` FROM `tipo_estado_observaciones` ORDER BY 2',
			],
			'tipo_estado_observa' => [
			],
			'acceso_remoto' => [
				'unidad' => 'SELECT `unidades`.`id_unidades`, `unidades`.`nombre` FROM `unidades` LEFT JOIN `ciudades` as ciudades1 ON `ciudades1`.`id_ciudad`=`unidades`.`ciudad` LEFT JOIN `prestador` as prestador1 ON `prestador1`.`id`=`unidades`.`prestador` ORDER BY 2',
				'ciudad' => 'SELECT `unidades`.`id_unidades`, IF(    CHAR_LENGTH(`ciudades1`.`ciudad`), CONCAT_WS(\'\',   `ciudades1`.`ciudad`), \'\') FROM `unidades` LEFT JOIN `ciudades` as ciudades1 ON `ciudades1`.`id_ciudad`=`unidades`.`ciudad` LEFT JOIN `prestador` as prestador1 ON `prestador1`.`id`=`unidades`.`prestador` ORDER BY 2',
				'codigo_equipo' => 'SELECT `dispositivos`.`id_dispo`, `dispositivos`.`code` FROM `dispositivos` LEFT JOIN `tipo_dispositivo` as tipo_dispositivo1 ON `tipo_dispositivo1`.`id_tipodispo`=`dispositivos`.`tipo_dispositivo` LEFT JOIN `marcas` as marcas1 ON `marcas1`.`id_marca`=`dispositivos`.`marca` LEFT JOIN `marca_modelo` as marca_modelo1 ON `marca_modelo1`.`id_mmodelo`=`dispositivos`.`modelo` LEFT JOIN `unidades` as unidades1 ON `unidades1`.`id_unidades`=`dispositivos`.`ubicacion` LEFT JOIN `tipo_clasifica_riesgo` as tipo_clasifica_riesgo1 ON `tipo_clasifica_riesgo1`.`id`=`dispositivos`.`clasificacion_riesgo` LEFT JOIN `tipo_estado_dispo` as tipo_estado_dispo1 ON `tipo_estado_dispo1`.`id`=`dispositivos`.`estado` LEFT JOIN `compra_dispo` as compra_dispo1 ON `compra_dispo1`.`id`=`dispositivos`.`id_compra_ingreso` LEFT JOIN `ciudades` as ciudades1 ON `ciudades1`.`id_ciudad`=`unidades1`.`ciudad` ORDER BY 2',
				'equipo' => 'SELECT `dispositivos`.`id_dispo`, IF(CHAR_LENGTH(`dispositivos`.`marca`) || CHAR_LENGTH(`dispositivos`.`modelo`), CONCAT_WS(\'\', IF(    CHAR_LENGTH(`marcas1`.`marca`), CONCAT_WS(\'\',   `marcas1`.`marca`), \'\'), \' - \', IF(    CHAR_LENGTH(`marca_modelo1`.`modelo`), CONCAT_WS(\'\',   `marca_modelo1`.`modelo`), \'\')), \'\') FROM `dispositivos` LEFT JOIN `tipo_dispositivo` as tipo_dispositivo1 ON `tipo_dispositivo1`.`id_tipodispo`=`dispositivos`.`tipo_dispositivo` LEFT JOIN `marcas` as marcas1 ON `marcas1`.`id_marca`=`dispositivos`.`marca` LEFT JOIN `marca_modelo` as marca_modelo1 ON `marca_modelo1`.`id_mmodelo`=`dispositivos`.`modelo` LEFT JOIN `unidades` as unidades1 ON `unidades1`.`id_unidades`=`dispositivos`.`ubicacion` LEFT JOIN `tipo_clasifica_riesgo` as tipo_clasifica_riesgo1 ON `tipo_clasifica_riesgo1`.`id`=`dispositivos`.`clasificacion_riesgo` LEFT JOIN `tipo_estado_dispo` as tipo_estado_dispo1 ON `tipo_estado_dispo1`.`id`=`dispositivos`.`estado` LEFT JOIN `compra_dispo` as compra_dispo1 ON `compra_dispo1`.`id`=`dispositivos`.`id_compra_ingreso` LEFT JOIN `ciudades` as ciudades1 ON `ciudades1`.`id_ciudad`=`unidades1`.`ciudad` ORDER BY 2',
			],
			'tipo_periodicidad' => [
			],
			'perfil' => [
				'tipo_id' => 'SELECT `tipo_iden`.`id_iden`, `tipo_iden`.`tipo_iden_abre` FROM `tipo_iden` ORDER BY 2',
				'rh' => 'SELECT `tipo_rh`.`id`, `tipo_rh`.`tipo_rh` FROM `tipo_rh` ORDER BY 2',
			],
			'consentimieto' => [
				'id_perfil' => 'SELECT `perfil`.`id`, IF(CHAR_LENGTH(`perfil`.`nombre`) || CHAR_LENGTH(`perfil`.`apellidos`), CONCAT_WS(\'\', `perfil`.`nombre`, \' \', `perfil`.`apellidos`), \'\') FROM `perfil` LEFT JOIN `tipo_iden` as tipo_iden1 ON `tipo_iden1`.`id_iden`=`perfil`.`tipo_id` LEFT JOIN `tipo_rh` as tipo_rh1 ON `tipo_rh1`.`id`=`perfil`.`rh` ORDER BY 2',
				'identificacion' => 'SELECT `perfil`.`id`, IF(CHAR_LENGTH(`perfil`.`tipo_id`) || CHAR_LENGTH(`perfil`.`numero_id`), CONCAT_WS(\'\', IF(    CHAR_LENGTH(`tipo_iden1`.`tipo_iden_abre`), CONCAT_WS(\'\',   `tipo_iden1`.`tipo_iden_abre`), \'\'), \' \', `perfil`.`numero_id`), \'\') FROM `perfil` LEFT JOIN `tipo_iden` as tipo_iden1 ON `tipo_iden1`.`id_iden`=`perfil`.`tipo_id` LEFT JOIN `tipo_rh` as tipo_rh1 ON `tipo_rh1`.`id`=`perfil`.`rh` ORDER BY 2',
			],
			'perfil_familia' => [
				'id_perfil' => 'SELECT `perfil`.`id`, IF(CHAR_LENGTH(`perfil`.`id`) || CHAR_LENGTH(`perfil`.`apellidos`), CONCAT_WS(\'\', `perfil`.`id`, \' \', `perfil`.`apellidos`), \'\') FROM `perfil` LEFT JOIN `tipo_iden` as tipo_iden1 ON `tipo_iden1`.`id_iden`=`perfil`.`tipo_id` LEFT JOIN `tipo_rh` as tipo_rh1 ON `tipo_rh1`.`id`=`perfil`.`rh` ORDER BY 2',
				'identificacion' => 'SELECT `perfil`.`id`, IF(CHAR_LENGTH(`perfil`.`tipo_id`) || CHAR_LENGTH(`perfil`.`numero_id`), CONCAT_WS(\'\', IF(    CHAR_LENGTH(`tipo_iden1`.`tipo_iden_abre`), CONCAT_WS(\'\',   `tipo_iden1`.`tipo_iden_abre`), \'\'), \' \', `perfil`.`numero_id`), \'\') FROM `perfil` LEFT JOIN `tipo_iden` as tipo_iden1 ON `tipo_iden1`.`id_iden`=`perfil`.`tipo_id` LEFT JOIN `tipo_rh` as tipo_rh1 ON `tipo_rh1`.`id`=`perfil`.`rh` ORDER BY 2',
				'parentesco' => 'SELECT `tipo_parentesco`.`id`, `tipo_parentesco`.`parentesco` FROM `tipo_parentesco` ORDER BY 2',
			],
			'perfil_soportes' => [
				'id_perfil' => 'SELECT `perfil`.`id`, IF(CHAR_LENGTH(`perfil`.`nombre`) || CHAR_LENGTH(`perfil`.`apellidos`), CONCAT_WS(\'\', `perfil`.`nombre`, \' \', `perfil`.`apellidos`), \'\') FROM `perfil` LEFT JOIN `tipo_iden` as tipo_iden1 ON `tipo_iden1`.`id_iden`=`perfil`.`tipo_id` LEFT JOIN `tipo_rh` as tipo_rh1 ON `tipo_rh1`.`id`=`perfil`.`rh` ORDER BY 2',
				'tipo_documento' => 'SELECT `tipo_documento`.`id_tipodoc`, `tipo_documento`.`tipo_doc` FROM `tipo_documento` LEFT JOIN `tipo_document_grupo` as tipo_document_grupo1 ON `tipo_document_grupo1`.`id`=`tipo_documento`.`grupo` ORDER BY 2',
			],
			'seguridad_social' => [
				'id_perfil' => 'SELECT `perfil`.`id`, IF(CHAR_LENGTH(`perfil`.`nombre`) || CHAR_LENGTH(`perfil`.`apellidos`), CONCAT_WS(\'\', `perfil`.`nombre`, \' \', `perfil`.`apellidos`), \'\') FROM `perfil` LEFT JOIN `tipo_iden` as tipo_iden1 ON `tipo_iden1`.`id_iden`=`perfil`.`tipo_id` LEFT JOIN `tipo_rh` as tipo_rh1 ON `tipo_rh1`.`id`=`perfil`.`rh` ORDER BY 2',
				'tipo_documento' => 'SELECT `tipo_documento_ss`.`id_tipodoc`, `tipo_documento_ss`.`tipo_doc` FROM `tipo_documento_ss` ORDER BY 2',
			],
			'costos_mtto' => [
				'id_mtto' => 'SELECT `mantenimientos`.`id_mtto`, `mantenimientos`.`id_mtto` FROM `mantenimientos` LEFT JOIN `dispositivos` as dispositivos1 ON `dispositivos1`.`id_dispo`=`mantenimientos`.`codigo` LEFT JOIN `tipo_mtto` as tipo_mtto1 ON `tipo_mtto1`.`id`=`mantenimientos`.`tipo_mtto` LEFT JOIN `contactos` as contactos1 ON `contactos1`.`id_contactos`=`mantenimientos`.`responsable` LEFT JOIN `unidades` as unidades1 ON `unidades1`.`id_unidades`=`mantenimientos`.`unidad` LEFT JOIN `tipo_estado_dispo` as tipo_estado_dispo1 ON `tipo_estado_dispo1`.`id`=`mantenimientos`.`estado_final` LEFT JOIN `tipo_dispositivo` as tipo_dispositivo1 ON `tipo_dispositivo1`.`id_tipodispo`=`dispositivos1`.`tipo_dispositivo` LEFT JOIN `ciudades` as ciudades1 ON `ciudades1`.`id_ciudad`=`unidades1`.`ciudad` ORDER BY 2',
				'tipo_costo' => 'SELECT `tipo_costo`.`id`, `tipo_costo`.`tipo_costo` FROM `tipo_costo` ORDER BY 2',
			],
			'tipo_costo' => [
			],
			'doc_mtto' => [
				'id_mtto' => 'SELECT `mantenimientos`.`id_mtto`, `mantenimientos`.`id_mtto` FROM `mantenimientos` LEFT JOIN `dispositivos` as dispositivos1 ON `dispositivos1`.`id_dispo`=`mantenimientos`.`codigo` LEFT JOIN `tipo_mtto` as tipo_mtto1 ON `tipo_mtto1`.`id`=`mantenimientos`.`tipo_mtto` LEFT JOIN `contactos` as contactos1 ON `contactos1`.`id_contactos`=`mantenimientos`.`responsable` LEFT JOIN `unidades` as unidades1 ON `unidades1`.`id_unidades`=`mantenimientos`.`unidad` LEFT JOIN `tipo_estado_dispo` as tipo_estado_dispo1 ON `tipo_estado_dispo1`.`id`=`mantenimientos`.`estado_final` LEFT JOIN `tipo_dispositivo` as tipo_dispositivo1 ON `tipo_dispositivo1`.`id_tipodispo`=`dispositivos1`.`tipo_dispositivo` LEFT JOIN `ciudades` as ciudades1 ON `ciudades1`.`id_ciudad`=`unidades1`.`ciudad` ORDER BY 2',
				'tipo_mtto' => 'SELECT `mantenimientos`.`id_mtto`, IF(    CHAR_LENGTH(`tipo_mtto1`.`tipo_mtto`), CONCAT_WS(\'\',   `tipo_mtto1`.`tipo_mtto`), \'\') FROM `mantenimientos` LEFT JOIN `dispositivos` as dispositivos1 ON `dispositivos1`.`id_dispo`=`mantenimientos`.`codigo` LEFT JOIN `tipo_mtto` as tipo_mtto1 ON `tipo_mtto1`.`id`=`mantenimientos`.`tipo_mtto` LEFT JOIN `contactos` as contactos1 ON `contactos1`.`id_contactos`=`mantenimientos`.`responsable` LEFT JOIN `unidades` as unidades1 ON `unidades1`.`id_unidades`=`mantenimientos`.`unidad` LEFT JOIN `tipo_estado_dispo` as tipo_estado_dispo1 ON `tipo_estado_dispo1`.`id`=`mantenimientos`.`estado_final` LEFT JOIN `tipo_dispositivo` as tipo_dispositivo1 ON `tipo_dispositivo1`.`id_tipodispo`=`dispositivos1`.`tipo_dispositivo` LEFT JOIN `ciudades` as ciudades1 ON `ciudades1`.`id_ciudad`=`unidades1`.`ciudad` ORDER BY 2',
				'mtto' => 'SELECT `mantenimientos`.`id_mtto`, `mantenimientos`.`descripcion` FROM `mantenimientos` LEFT JOIN `dispositivos` as dispositivos1 ON `dispositivos1`.`id_dispo`=`mantenimientos`.`codigo` LEFT JOIN `tipo_mtto` as tipo_mtto1 ON `tipo_mtto1`.`id`=`mantenimientos`.`tipo_mtto` LEFT JOIN `contactos` as contactos1 ON `contactos1`.`id_contactos`=`mantenimientos`.`responsable` LEFT JOIN `unidades` as unidades1 ON `unidades1`.`id_unidades`=`mantenimientos`.`unidad` LEFT JOIN `tipo_estado_dispo` as tipo_estado_dispo1 ON `tipo_estado_dispo1`.`id`=`mantenimientos`.`estado_final` LEFT JOIN `tipo_dispositivo` as tipo_dispositivo1 ON `tipo_dispositivo1`.`id_tipodispo`=`dispositivos1`.`tipo_dispositivo` LEFT JOIN `ciudades` as ciudades1 ON `ciudades1`.`id_ciudad`=`unidades1`.`ciudad` ORDER BY 2',
				'nombre_biomedico' => 'SELECT `biomedicos`.`id`, IF(    CHAR_LENGTH(`contactos1`.`nombre`), CONCAT_WS(\'\',   `contactos1`.`nombre`), \'\') FROM `biomedicos` LEFT JOIN `contactos` as contactos1 ON `contactos1`.`id_contactos`=`biomedicos`.`id_contacto` ORDER BY 2',
				'registro_invima' => 'SELECT `biomedicos`.`id`, `biomedicos`.`registro_invima` FROM `biomedicos` LEFT JOIN `contactos` as contactos1 ON `contactos1`.`id_contactos`=`biomedicos`.`id_contacto` ORDER BY 2',
				'firma_biomedico' => 'SELECT `biomedicos`.`id`, `biomedicos`.`firma` FROM `biomedicos` LEFT JOIN `contactos` as contactos1 ON `contactos1`.`id_contactos`=`biomedicos`.`id_contacto` ORDER BY 2',
			],
			'biomedicos' => [
				'id_contacto' => 'SELECT `contactos`.`id_contactos`, `contactos`.`identificacion` FROM `contactos` LEFT JOIN `contactos_tipo_contacto` as contactos_tipo_contacto1 ON `contactos_tipo_contacto1`.`id_tipo_contacto`=`contactos`.`tipo_contacto` LEFT JOIN `tipo_iden` as tipo_iden1 ON `tipo_iden1`.`id_iden`=`contactos`.`tipo_iden` LEFT JOIN `ciudades` as ciudades1 ON `ciudades1`.`id_ciudad`=`contactos`.`ciudad` LEFT JOIN `tipo_relacion` as tipo_relacion1 ON `tipo_relacion1`.`id_tiporelac`=`contactos`.`tipo_relacion` ORDER BY 2',
				'nombre' => 'SELECT `contactos`.`id_contactos`, `contactos`.`nombre` FROM `contactos` LEFT JOIN `contactos_tipo_contacto` as contactos_tipo_contacto1 ON `contactos_tipo_contacto1`.`id_tipo_contacto`=`contactos`.`tipo_contacto` LEFT JOIN `tipo_iden` as tipo_iden1 ON `tipo_iden1`.`id_iden`=`contactos`.`tipo_iden` LEFT JOIN `ciudades` as ciudades1 ON `ciudades1`.`id_ciudad`=`contactos`.`ciudad` LEFT JOIN `tipo_relacion` as tipo_relacion1 ON `tipo_relacion1`.`id_tiporelac`=`contactos`.`tipo_relacion` ORDER BY 2',
			],
			'tipo_clasifica_riesgo' => [
			],
			'programa_mtto' => [
				'unidad' => 'SELECT `unidades`.`id_unidades`, `unidades`.`nombre` FROM `unidades` LEFT JOIN `ciudades` as ciudades1 ON `ciudades1`.`id_ciudad`=`unidades`.`ciudad` LEFT JOIN `prestador` as prestador1 ON `prestador1`.`id`=`unidades`.`prestador` ORDER BY 2',
			],
			'cronograma_mtto' => [
				'id_programa' => 'SELECT `programa_mtto`.`id`, IF(    CHAR_LENGTH(`unidades1`.`nombre`), CONCAT_WS(\'\',   `unidades1`.`nombre`), \'\') FROM `programa_mtto` LEFT JOIN `unidades` as unidades1 ON `unidades1`.`id_unidades`=`programa_mtto`.`unidad` ORDER BY 2',
				'ano' => 'SELECT `programa_mtto`.`id`, `programa_mtto`.`ano` FROM `programa_mtto` LEFT JOIN `unidades` as unidades1 ON `unidades1`.`id_unidades`=`programa_mtto`.`unidad` ORDER BY 2',
				'codigo' => 'SELECT `dispositivos`.`id_dispo`, `dispositivos`.`code` FROM `dispositivos` LEFT JOIN `tipo_dispositivo` as tipo_dispositivo1 ON `tipo_dispositivo1`.`id_tipodispo`=`dispositivos`.`tipo_dispositivo` LEFT JOIN `marcas` as marcas1 ON `marcas1`.`id_marca`=`dispositivos`.`marca` LEFT JOIN `marca_modelo` as marca_modelo1 ON `marca_modelo1`.`id_mmodelo`=`dispositivos`.`modelo` LEFT JOIN `unidades` as unidades1 ON `unidades1`.`id_unidades`=`dispositivos`.`ubicacion` LEFT JOIN `tipo_clasifica_riesgo` as tipo_clasifica_riesgo1 ON `tipo_clasifica_riesgo1`.`id`=`dispositivos`.`clasificacion_riesgo` LEFT JOIN `tipo_estado_dispo` as tipo_estado_dispo1 ON `tipo_estado_dispo1`.`id`=`dispositivos`.`estado` LEFT JOIN `compra_dispo` as compra_dispo1 ON `compra_dispo1`.`id`=`dispositivos`.`id_compra_ingreso` LEFT JOIN `ciudades` as ciudades1 ON `ciudades1`.`id_ciudad`=`unidades1`.`ciudad` ORDER BY 2',
				'tipo_dispo' => 'SELECT `dispositivos`.`id_dispo`, IF(    CHAR_LENGTH(`tipo_dispositivo1`.`tipo_dispositivo`), CONCAT_WS(\'\',   `tipo_dispositivo1`.`tipo_dispositivo`), \'\') FROM `dispositivos` LEFT JOIN `tipo_dispositivo` as tipo_dispositivo1 ON `tipo_dispositivo1`.`id_tipodispo`=`dispositivos`.`tipo_dispositivo` LEFT JOIN `marcas` as marcas1 ON `marcas1`.`id_marca`=`dispositivos`.`marca` LEFT JOIN `marca_modelo` as marca_modelo1 ON `marca_modelo1`.`id_mmodelo`=`dispositivos`.`modelo` LEFT JOIN `unidades` as unidades1 ON `unidades1`.`id_unidades`=`dispositivos`.`ubicacion` LEFT JOIN `tipo_clasifica_riesgo` as tipo_clasifica_riesgo1 ON `tipo_clasifica_riesgo1`.`id`=`dispositivos`.`clasificacion_riesgo` LEFT JOIN `tipo_estado_dispo` as tipo_estado_dispo1 ON `tipo_estado_dispo1`.`id`=`dispositivos`.`estado` LEFT JOIN `compra_dispo` as compra_dispo1 ON `compra_dispo1`.`id`=`dispositivos`.`id_compra_ingreso` LEFT JOIN `ciudades` as ciudades1 ON `ciudades1`.`id_ciudad`=`unidades1`.`ciudad` ORDER BY 2',
				'marca' => 'SELECT `marcas`.`id_marca`, `marcas`.`marca` FROM `marcas` ORDER BY 2',
				'modelo' => 'SELECT `dispositivos`.`id_dispo`, IF(    CHAR_LENGTH(`marca_modelo1`.`modelo`), CONCAT_WS(\'\',   `marca_modelo1`.`modelo`), \'\') FROM `dispositivos` LEFT JOIN `tipo_dispositivo` as tipo_dispositivo1 ON `tipo_dispositivo1`.`id_tipodispo`=`dispositivos`.`tipo_dispositivo` LEFT JOIN `marcas` as marcas1 ON `marcas1`.`id_marca`=`dispositivos`.`marca` LEFT JOIN `marca_modelo` as marca_modelo1 ON `marca_modelo1`.`id_mmodelo`=`dispositivos`.`modelo` LEFT JOIN `unidades` as unidades1 ON `unidades1`.`id_unidades`=`dispositivos`.`ubicacion` LEFT JOIN `tipo_clasifica_riesgo` as tipo_clasifica_riesgo1 ON `tipo_clasifica_riesgo1`.`id`=`dispositivos`.`clasificacion_riesgo` LEFT JOIN `tipo_estado_dispo` as tipo_estado_dispo1 ON `tipo_estado_dispo1`.`id`=`dispositivos`.`estado` LEFT JOIN `compra_dispo` as compra_dispo1 ON `compra_dispo1`.`id`=`dispositivos`.`id_compra_ingreso` LEFT JOIN `ciudades` as ciudades1 ON `ciudades1`.`id_ciudad`=`unidades1`.`ciudad` ORDER BY 2',
				'periodicidad' => 'SELECT `tipo_periodicidad`.`id`, `tipo_periodicidad`.`periodicidad` FROM `tipo_periodicidad` ORDER BY 2',
			],
			'compras' => [
				'tipo_compra' => 'SELECT `tipo_compra`.`id`, `tipo_compra`.`tipo_compra` FROM `tipo_compra` ORDER BY 2',
				'estado' => 'SELECT `tipo_estado_compra`.`id`, `tipo_estado_compra`.`tipo_estado_compra` FROM `tipo_estado_compra` ORDER BY 2',
			],
			'tipo_estado_compra' => [
			],
			'cantidad_dispomedico' => [
				'nombre_dispo' => 'SELECT `compra_dispo`.`id`, `compra_dispo`.`nombre` FROM `compra_dispo` LEFT JOIN `tipo_dispositivo` as tipo_dispositivo1 ON `tipo_dispositivo1`.`id_tipodispo`=`compra_dispo`.`tipo_dispositivo` LEFT JOIN `marcas` as marcas1 ON `marcas1`.`id_marca`=`compra_dispo`.`marca` LEFT JOIN `marca_modelo` as marca_modelo1 ON `marca_modelo1`.`id_mmodelo`=`compra_dispo`.`modelo` LEFT JOIN `tipo_estado_dispo` as tipo_estado_dispo1 ON `tipo_estado_dispo1`.`id`=`compra_dispo`.`estado` LEFT JOIN `tipo_clasifica_riesgo` as tipo_clasifica_riesgo1 ON `tipo_clasifica_riesgo1`.`id`=`compra_dispo`.`riesgo` ORDER BY 2',
				'serial' => 'SELECT `compra_dispo`.`id`, `compra_dispo`.`serial` FROM `compra_dispo` LEFT JOIN `tipo_dispositivo` as tipo_dispositivo1 ON `tipo_dispositivo1`.`id_tipodispo`=`compra_dispo`.`tipo_dispositivo` LEFT JOIN `marcas` as marcas1 ON `marcas1`.`id_marca`=`compra_dispo`.`marca` LEFT JOIN `marca_modelo` as marca_modelo1 ON `marca_modelo1`.`id_mmodelo`=`compra_dispo`.`modelo` LEFT JOIN `tipo_estado_dispo` as tipo_estado_dispo1 ON `tipo_estado_dispo1`.`id`=`compra_dispo`.`estado` LEFT JOIN `tipo_clasifica_riesgo` as tipo_clasifica_riesgo1 ON `tipo_clasifica_riesgo1`.`id`=`compra_dispo`.`riesgo` ORDER BY 2',
				'marca_modelo' => 'SELECT `compra_dispo`.`id`, IF(CHAR_LENGTH(`compra_dispo`.`marca`) || CHAR_LENGTH(`compra_dispo`.`modelo`), CONCAT_WS(\'\', IF(    CHAR_LENGTH(`marcas1`.`marca`), CONCAT_WS(\'\',   `marcas1`.`marca`), \'\'), \' \', IF(    CHAR_LENGTH(`marca_modelo1`.`modelo`), CONCAT_WS(\'\',   `marca_modelo1`.`modelo`), \'\')), \'\') FROM `compra_dispo` LEFT JOIN `tipo_dispositivo` as tipo_dispositivo1 ON `tipo_dispositivo1`.`id_tipodispo`=`compra_dispo`.`tipo_dispositivo` LEFT JOIN `marcas` as marcas1 ON `marcas1`.`id_marca`=`compra_dispo`.`marca` LEFT JOIN `marca_modelo` as marca_modelo1 ON `marca_modelo1`.`id_mmodelo`=`compra_dispo`.`modelo` LEFT JOIN `tipo_estado_dispo` as tipo_estado_dispo1 ON `tipo_estado_dispo1`.`id`=`compra_dispo`.`estado` LEFT JOIN `tipo_clasifica_riesgo` as tipo_clasifica_riesgo1 ON `tipo_clasifica_riesgo1`.`id`=`compra_dispo`.`riesgo` ORDER BY 2',
				'descripcion' => 'SELECT `compra_dispo`.`id`, IF(CHAR_LENGTH(`compra_dispo`.`caracteristicas`) || CHAR_LENGTH(`compra_dispo`.`modelo`), CONCAT_WS(\'\', `compra_dispo`.`caracteristicas`, \' \', IF(    CHAR_LENGTH(`marca_modelo1`.`modelo`), CONCAT_WS(\'\',   `marca_modelo1`.`modelo`), \'\')), \'\') FROM `compra_dispo` LEFT JOIN `tipo_dispositivo` as tipo_dispositivo1 ON `tipo_dispositivo1`.`id_tipodispo`=`compra_dispo`.`tipo_dispositivo` LEFT JOIN `marcas` as marcas1 ON `marcas1`.`id_marca`=`compra_dispo`.`marca` LEFT JOIN `marca_modelo` as marca_modelo1 ON `marca_modelo1`.`id_mmodelo`=`compra_dispo`.`modelo` LEFT JOIN `tipo_estado_dispo` as tipo_estado_dispo1 ON `tipo_estado_dispo1`.`id`=`compra_dispo`.`estado` LEFT JOIN `tipo_clasifica_riesgo` as tipo_clasifica_riesgo1 ON `tipo_clasifica_riesgo1`.`id`=`compra_dispo`.`riesgo` ORDER BY 2',
				'estado' => 'SELECT `tipo_estado_compra`.`id`, `tipo_estado_compra`.`tipo_estado_compra` FROM `tipo_estado_compra` ORDER BY 2',
				'id_compra' => 'SELECT `compras`.`id`, `compras`.`id` FROM `compras` LEFT JOIN `tipo_compra` as tipo_compra1 ON `tipo_compra1`.`id`=`compras`.`tipo_compra` LEFT JOIN `tipo_estado_compra` as tipo_estado_compra1 ON `tipo_estado_compra1`.`id`=`compras`.`estado` ORDER BY 2',
			],
			'cantidad_articulos' => [
				'nombre_articulo' => 'SELECT `articulos`.`id`, `articulos`.`nombre_unico` FROM `articulos` LEFT JOIN `tipo_dispositivo` as tipo_dispositivo1 ON `tipo_dispositivo1`.`id_tipodispo`=`articulos`.`tipo_dispo` LEFT JOIN `marcas` as marcas1 ON `marcas1`.`id_marca`=`articulos`.`marca` LEFT JOIN `marca_modelo` as marca_modelo1 ON `marca_modelo1`.`id_mmodelo`=`articulos`.`modelo` LEFT JOIN `marca_presetacion` as marca_presetacion1 ON `marca_presetacion1`.`id`=`articulos`.`presentacion` LEFT JOIN `tipo_unidad_medida` as tipo_unidad_medida1 ON `tipo_unidad_medida1`.`id`=`marca_presetacion1`.`unidad_medida` LEFT JOIN `articulos_familia` as articulos_familia1 ON `articulos_familia1`.`id`=`articulos`.`familia` LEFT JOIN `unidades` as unidades1 ON `unidades1`.`id_unidades`=`articulos`.`ubicacion` LEFT JOIN `tipo_estado_dispo` as tipo_estado_dispo1 ON `tipo_estado_dispo1`.`id`=`articulos`.`estado` ORDER BY 2',
				'presentacion' => 'SELECT `articulos`.`id`, IF(CHAR_LENGTH(`articulos`.`marca`) || CHAR_LENGTH(`articulos`.`presentacion`), CONCAT_WS(\'\', IF(    CHAR_LENGTH(`marcas1`.`marca`), CONCAT_WS(\'\',   `marcas1`.`marca`), \'\'), \' - \', IF(    CHAR_LENGTH(`marca_presetacion1`.`presentacion`) || CHAR_LENGTH(`tipo_unidad_medida1`.`unidad`), CONCAT_WS(\'\',   `marca_presetacion1`.`presentacion`, \' \', `tipo_unidad_medida1`.`unidad`), \'\')), \'\') FROM `articulos` LEFT JOIN `tipo_dispositivo` as tipo_dispositivo1 ON `tipo_dispositivo1`.`id_tipodispo`=`articulos`.`tipo_dispo` LEFT JOIN `marcas` as marcas1 ON `marcas1`.`id_marca`=`articulos`.`marca` LEFT JOIN `marca_modelo` as marca_modelo1 ON `marca_modelo1`.`id_mmodelo`=`articulos`.`modelo` LEFT JOIN `marca_presetacion` as marca_presetacion1 ON `marca_presetacion1`.`id`=`articulos`.`presentacion` LEFT JOIN `tipo_unidad_medida` as tipo_unidad_medida1 ON `tipo_unidad_medida1`.`id`=`marca_presetacion1`.`unidad_medida` LEFT JOIN `articulos_familia` as articulos_familia1 ON `articulos_familia1`.`id`=`articulos`.`familia` LEFT JOIN `unidades` as unidades1 ON `unidades1`.`id_unidades`=`articulos`.`ubicacion` LEFT JOIN `tipo_estado_dispo` as tipo_estado_dispo1 ON `tipo_estado_dispo1`.`id`=`articulos`.`estado` ORDER BY 2',
				'descripcion' => 'SELECT `articulos`.`id`, IF(CHAR_LENGTH(`articulos`.`caracteristicas`) || CHAR_LENGTH(`articulos`.`nota`), CONCAT_WS(\'\', `articulos`.`caracteristicas`, \'-\', `articulos`.`nota`), \'\') FROM `articulos` LEFT JOIN `tipo_dispositivo` as tipo_dispositivo1 ON `tipo_dispositivo1`.`id_tipodispo`=`articulos`.`tipo_dispo` LEFT JOIN `marcas` as marcas1 ON `marcas1`.`id_marca`=`articulos`.`marca` LEFT JOIN `marca_modelo` as marca_modelo1 ON `marca_modelo1`.`id_mmodelo`=`articulos`.`modelo` LEFT JOIN `marca_presetacion` as marca_presetacion1 ON `marca_presetacion1`.`id`=`articulos`.`presentacion` LEFT JOIN `tipo_unidad_medida` as tipo_unidad_medida1 ON `tipo_unidad_medida1`.`id`=`marca_presetacion1`.`unidad_medida` LEFT JOIN `articulos_familia` as articulos_familia1 ON `articulos_familia1`.`id`=`articulos`.`familia` LEFT JOIN `unidades` as unidades1 ON `unidades1`.`id_unidades`=`articulos`.`ubicacion` LEFT JOIN `tipo_estado_dispo` as tipo_estado_dispo1 ON `tipo_estado_dispo1`.`id`=`articulos`.`estado` ORDER BY 2',
				'serial' => 'SELECT `articulos`.`id`, IF(CHAR_LENGTH(`articulos`.`serial`) || CHAR_LENGTH(`articulos`.`referencia`), CONCAT_WS(\'\', `articulos`.`serial`, \' \', `articulos`.`referencia`), \'\') FROM `articulos` LEFT JOIN `tipo_dispositivo` as tipo_dispositivo1 ON `tipo_dispositivo1`.`id_tipodispo`=`articulos`.`tipo_dispo` LEFT JOIN `marcas` as marcas1 ON `marcas1`.`id_marca`=`articulos`.`marca` LEFT JOIN `marca_modelo` as marca_modelo1 ON `marca_modelo1`.`id_mmodelo`=`articulos`.`modelo` LEFT JOIN `marca_presetacion` as marca_presetacion1 ON `marca_presetacion1`.`id`=`articulos`.`presentacion` LEFT JOIN `tipo_unidad_medida` as tipo_unidad_medida1 ON `tipo_unidad_medida1`.`id`=`marca_presetacion1`.`unidad_medida` LEFT JOIN `articulos_familia` as articulos_familia1 ON `articulos_familia1`.`id`=`articulos`.`familia` LEFT JOIN `unidades` as unidades1 ON `unidades1`.`id_unidades`=`articulos`.`ubicacion` LEFT JOIN `tipo_estado_dispo` as tipo_estado_dispo1 ON `tipo_estado_dispo1`.`id`=`articulos`.`estado` ORDER BY 2',
				'estado' => 'SELECT `tipo_estado_compra`.`id`, `tipo_estado_compra`.`tipo_estado_compra` FROM `tipo_estado_compra` ORDER BY 2',
				'id_compras' => 'SELECT `compras`.`id`, `compras`.`id` FROM `compras` LEFT JOIN `tipo_compra` as tipo_compra1 ON `tipo_compra1`.`id`=`compras`.`tipo_compra` LEFT JOIN `tipo_estado_compra` as tipo_estado_compra1 ON `tipo_estado_compra1`.`id`=`compras`.`estado` ORDER BY 2',
				'tipo_compra' => 'SELECT `compras`.`id`, IF(    CHAR_LENGTH(`tipo_compra1`.`tipo_compra`), CONCAT_WS(\'\',   `tipo_compra1`.`tipo_compra`), \'\') FROM `compras` LEFT JOIN `tipo_compra` as tipo_compra1 ON `tipo_compra1`.`id`=`compras`.`tipo_compra` LEFT JOIN `tipo_estado_compra` as tipo_estado_compra1 ON `tipo_estado_compra1`.`id`=`compras`.`estado` ORDER BY 2',
			],
			'cantidad_mobiliario' => [
				'nombre_mobiliario' => 'SELECT `mobiliario`.`id_mobiliario`, IF(CHAR_LENGTH(`mobiliario`.`grupo`) || CHAR_LENGTH(`mobiliario`.`tipo_mobiliario`), CONCAT_WS(\'\', IF(    CHAR_LENGTH(`tipo_grupo_mobilia1`.`grupo`), CONCAT_WS(\'\',   `tipo_grupo_mobilia1`.`grupo`), \'\'), \' - \', IF(    CHAR_LENGTH(`tipo_mobiliario1`.`tipo_mobiliario`), CONCAT_WS(\'\',   `tipo_mobiliario1`.`tipo_mobiliario`), \'\')), \'\') FROM `mobiliario` LEFT JOIN `tipo_grupo_mobilia` as tipo_grupo_mobilia1 ON `tipo_grupo_mobilia1`.`id_gru_mo`=`mobiliario`.`grupo` LEFT JOIN `tipo_mobiliario` as tipo_mobiliario1 ON `tipo_mobiliario1`.`id`=`mobiliario`.`tipo_mobiliario` LEFT JOIN `unidades` as unidades1 ON `unidades1`.`id_unidades`=`mobiliario`.`ubicacion` LEFT JOIN `unidades` as unidades2 ON `unidades2`.`id_unidades`=`mobiliario`.`unidad` ORDER BY 2',
				'descripcion' => 'SELECT `mobiliario`.`id_mobiliario`, `mobiliario`.`descripcion` FROM `mobiliario` LEFT JOIN `tipo_grupo_mobilia` as tipo_grupo_mobilia1 ON `tipo_grupo_mobilia1`.`id_gru_mo`=`mobiliario`.`grupo` LEFT JOIN `tipo_mobiliario` as tipo_mobiliario1 ON `tipo_mobiliario1`.`id`=`mobiliario`.`tipo_mobiliario` LEFT JOIN `unidades` as unidades1 ON `unidades1`.`id_unidades`=`mobiliario`.`ubicacion` LEFT JOIN `unidades` as unidades2 ON `unidades2`.`id_unidades`=`mobiliario`.`unidad` ORDER BY 2',
				'estado' => 'SELECT `tipo_estado_compra`.`id`, `tipo_estado_compra`.`tipo_estado_compra` FROM `tipo_estado_compra` ORDER BY 2',
				'id_compra' => 'SELECT `compras`.`id`, `compras`.`id` FROM `compras` LEFT JOIN `tipo_compra` as tipo_compra1 ON `tipo_compra1`.`id`=`compras`.`tipo_compra` LEFT JOIN `tipo_estado_compra` as tipo_estado_compra1 ON `tipo_estado_compra1`.`id`=`compras`.`estado` ORDER BY 2',
			],
			'compra_dispo' => [
				'foto' => 'SELECT `marca_modelo`.`id_mmodelo`, `marca_modelo`.`img` FROM `marca_modelo` LEFT JOIN `marcas` as marcas1 ON `marcas1`.`id_marca`=`marca_modelo`.`marca` ORDER BY 2',
				'tipo_dispositivo' => 'SELECT `tipo_dispositivo`.`id_tipodispo`, `tipo_dispositivo`.`tipo_dispositivo` FROM `tipo_dispositivo` LEFT JOIN `dispositivo_tipo_grupo` as dispositivo_tipo_grupo1 ON `dispositivo_tipo_grupo1`.`id`=`tipo_dispositivo`.`grupo_dispo` WHERE `tipo_dispositivo`.`grupo_dispo` = 3 ORDER BY 2',
				'marca' => 'SELECT `marcas`.`id_marca`, `marcas`.`marca` FROM `marcas` ORDER BY 2',
				'modelo' => 'SELECT `marca_modelo`.`id_mmodelo`, `marca_modelo`.`modelo` FROM `marca_modelo` LEFT JOIN `marcas` as marcas1 ON `marcas1`.`id_marca`=`marca_modelo`.`marca` ORDER BY 2',
				'estado' => 'SELECT `tipo_estado_dispo`.`id`, `tipo_estado_dispo`.`estado_dispo` FROM `tipo_estado_dispo` ORDER BY 2',
				'riesgo' => 'SELECT `tipo_clasifica_riesgo`.`id`, IF(CHAR_LENGTH(`tipo_clasifica_riesgo`.`clase`) || CHAR_LENGTH(`tipo_clasifica_riesgo`.`nivel_riesgo`), CONCAT_WS(\'\', `tipo_clasifica_riesgo`.`clase`, \' - \', `tipo_clasifica_riesgo`.`nivel_riesgo`), \'\') FROM `tipo_clasifica_riesgo` ORDER BY 2',
			],
			'articulos' => [
				'tipo_dispo' => 'SELECT `tipo_dispositivo`.`id_tipodispo`, `tipo_dispositivo`.`tipo_dispositivo` FROM `tipo_dispositivo` LEFT JOIN `dispositivo_tipo_grupo` as dispositivo_tipo_grupo1 ON `dispositivo_tipo_grupo1`.`id`=`tipo_dispositivo`.`grupo_dispo` WHERE `tipo_dispositivo`.`grupo_dispo` = 1 ORDER BY 2',
				'marca' => 'SELECT `marcas`.`id_marca`, `marcas`.`marca` FROM `marcas` ORDER BY 2',
				'modelo' => 'SELECT `marca_modelo`.`id_mmodelo`, `marca_modelo`.`modelo` FROM `marca_modelo` LEFT JOIN `marcas` as marcas1 ON `marcas1`.`id_marca`=`marca_modelo`.`marca` ORDER BY 2',
				'presentacion' => 'SELECT `marca_presetacion`.`id`, IF(CHAR_LENGTH(`marca_presetacion`.`presentacion`) || CHAR_LENGTH(`marca_presetacion`.`unidad_medida`), CONCAT_WS(\'\', `marca_presetacion`.`presentacion`, \' \', IF(    CHAR_LENGTH(`tipo_unidad_medida1`.`unidad`), CONCAT_WS(\'\',   `tipo_unidad_medida1`.`unidad`), \'\')), \'\') FROM `marca_presetacion` LEFT JOIN `marcas` as marcas1 ON `marcas1`.`id_marca`=`marca_presetacion`.`marca` LEFT JOIN `tipo_unidad_medida` as tipo_unidad_medida1 ON `tipo_unidad_medida1`.`id`=`marca_presetacion`.`unidad_medida` ORDER BY 2',
				'familia' => 'SELECT `articulos_familia`.`id`, IF(CHAR_LENGTH(`articulos_familia`.`familia`) || CHAR_LENGTH(`articulos_familia`.`familia`), CONCAT_WS(\'\', `articulos_familia`.`familia`, \'-\', `articulos_familia`.`familia`), \'\') FROM `articulos_familia` ORDER BY 2',
				'codigo_proveedor' => 'SELECT `articulos_familia`.`id`, IF(CHAR_LENGTH(`articulos_familia`.`codigo`) || CHAR_LENGTH(`articulos_familia`.`proveedor`), CONCAT_WS(\'\', `articulos_familia`.`codigo`, \'-\', `articulos_familia`.`proveedor`), \'\') FROM `articulos_familia` ORDER BY 2',
				'ubicacion' => 'SELECT `unidades`.`id_unidades`, `unidades`.`nombre` FROM `unidades` LEFT JOIN `ciudades` as ciudades1 ON `ciudades1`.`id_ciudad`=`unidades`.`ciudad` LEFT JOIN `prestador` as prestador1 ON `prestador1`.`id`=`unidades`.`prestador` ORDER BY 2',
				'ubicacion_abreviado' => 'SELECT `unidades`.`id_unidades`, `unidades`.`abreviado` FROM `unidades` LEFT JOIN `ciudades` as ciudades1 ON `ciudades1`.`id_ciudad`=`unidades`.`ciudad` LEFT JOIN `prestador` as prestador1 ON `prestador1`.`id`=`unidades`.`prestador` ORDER BY 2',
				'imagen' => 'SELECT `marca_modelo`.`id_mmodelo`, `marca_modelo`.`img` FROM `marca_modelo` LEFT JOIN `marcas` as marcas1 ON `marcas1`.`id_marca`=`marca_modelo`.`marca` ORDER BY 2',
				'estado' => 'SELECT `tipo_estado_dispo`.`id`, `tipo_estado_dispo`.`estado_dispo` FROM `tipo_estado_dispo` ORDER BY 2',
			],
			'cofig' => [
			],
			'marca_presetacion' => [
				'marca' => 'SELECT `marcas`.`id_marca`, `marcas`.`marca` FROM `marcas` ORDER BY 2',
				'unidad_medida' => 'SELECT `tipo_unidad_medida`.`id`, `tipo_unidad_medida`.`unidad` FROM `tipo_unidad_medida` ORDER BY 2',
			],
			'tipo_document_grupo' => [
			],
			'tipo_pago' => [
			],
			'tipo_compra' => [
			],
			'articulos_familia' => [
			],
			'articulo_codigo_proveedor' => [
				'familia' => 'SELECT `articulos_familia`.`id`, IF(CHAR_LENGTH(`articulos_familia`.`codigo`) || CHAR_LENGTH(`articulos_familia`.`familia`), CONCAT_WS(\'\', `articulos_familia`.`codigo`, \'-\', `articulos_familia`.`familia`), \'\') FROM `articulos_familia` ORDER BY 2',
			],
			'tipo_unidad_medida' => [
			],
			'genera_documentos' => [
				'ciudad' => 'SELECT `ciudades`.`id_ciudad`, `ciudades`.`ciudad` FROM `ciudades` ORDER BY 2',
				'entidad' => 'SELECT `unidades`.`id_unidades`, IF(CHAR_LENGTH(`unidades`.`nombre`) || CHAR_LENGTH(`unidades`.`abreviado`), CONCAT_WS(\'\', `unidades`.`nombre`, \' - \', `unidades`.`abreviado`), \'\') FROM `unidades` LEFT JOIN `ciudades` as ciudades1 ON `ciudades1`.`id_ciudad`=`unidades`.`ciudad` LEFT JOIN `prestador` as prestador1 ON `prestador1`.`id`=`unidades`.`prestador` ORDER BY 2',
			],
			'verificacion_articulos' => [
				'codigo' => 'SELECT `articulos`.`id`, `articulos`.`id` FROM `articulos` LEFT JOIN `tipo_dispositivo` as tipo_dispositivo1 ON `tipo_dispositivo1`.`id_tipodispo`=`articulos`.`tipo_dispo` LEFT JOIN `marcas` as marcas1 ON `marcas1`.`id_marca`=`articulos`.`marca` LEFT JOIN `marca_modelo` as marca_modelo1 ON `marca_modelo1`.`id_mmodelo`=`articulos`.`modelo` LEFT JOIN `marca_presetacion` as marca_presetacion1 ON `marca_presetacion1`.`id`=`articulos`.`presentacion` LEFT JOIN `tipo_unidad_medida` as tipo_unidad_medida1 ON `tipo_unidad_medida1`.`id`=`marca_presetacion1`.`unidad_medida` LEFT JOIN `articulos_familia` as articulos_familia1 ON `articulos_familia1`.`id`=`articulos`.`familia` LEFT JOIN `unidades` as unidades1 ON `unidades1`.`id_unidades`=`articulos`.`ubicacion` LEFT JOIN `tipo_estado_dispo` as tipo_estado_dispo1 ON `tipo_estado_dispo1`.`id`=`articulos`.`estado` ORDER BY 2',
				'tipo_dispo' => 'SELECT `articulos`.`id`, IF(    CHAR_LENGTH(`tipo_dispositivo1`.`tipo_dispositivo`), CONCAT_WS(\'\',   `tipo_dispositivo1`.`tipo_dispositivo`), \'\') FROM `articulos` LEFT JOIN `tipo_dispositivo` as tipo_dispositivo1 ON `tipo_dispositivo1`.`id_tipodispo`=`articulos`.`tipo_dispo` LEFT JOIN `marcas` as marcas1 ON `marcas1`.`id_marca`=`articulos`.`marca` LEFT JOIN `marca_modelo` as marca_modelo1 ON `marca_modelo1`.`id_mmodelo`=`articulos`.`modelo` LEFT JOIN `marca_presetacion` as marca_presetacion1 ON `marca_presetacion1`.`id`=`articulos`.`presentacion` LEFT JOIN `tipo_unidad_medida` as tipo_unidad_medida1 ON `tipo_unidad_medida1`.`id`=`marca_presetacion1`.`unidad_medida` LEFT JOIN `articulos_familia` as articulos_familia1 ON `articulos_familia1`.`id`=`articulos`.`familia` LEFT JOIN `unidades` as unidades1 ON `unidades1`.`id_unidades`=`articulos`.`ubicacion` LEFT JOIN `tipo_estado_dispo` as tipo_estado_dispo1 ON `tipo_estado_dispo1`.`id`=`articulos`.`estado` ORDER BY 2',
				'nombre' => 'SELECT `articulos`.`id`, `articulos`.`nombre_unico` FROM `articulos` LEFT JOIN `tipo_dispositivo` as tipo_dispositivo1 ON `tipo_dispositivo1`.`id_tipodispo`=`articulos`.`tipo_dispo` LEFT JOIN `marcas` as marcas1 ON `marcas1`.`id_marca`=`articulos`.`marca` LEFT JOIN `marca_modelo` as marca_modelo1 ON `marca_modelo1`.`id_mmodelo`=`articulos`.`modelo` LEFT JOIN `marca_presetacion` as marca_presetacion1 ON `marca_presetacion1`.`id`=`articulos`.`presentacion` LEFT JOIN `tipo_unidad_medida` as tipo_unidad_medida1 ON `tipo_unidad_medida1`.`id`=`marca_presetacion1`.`unidad_medida` LEFT JOIN `articulos_familia` as articulos_familia1 ON `articulos_familia1`.`id`=`articulos`.`familia` LEFT JOIN `unidades` as unidades1 ON `unidades1`.`id_unidades`=`articulos`.`ubicacion` LEFT JOIN `tipo_estado_dispo` as tipo_estado_dispo1 ON `tipo_estado_dispo1`.`id`=`articulos`.`estado` ORDER BY 2',
				'serial' => 'SELECT `articulos`.`id`, `articulos`.`serial` FROM `articulos` LEFT JOIN `tipo_dispositivo` as tipo_dispositivo1 ON `tipo_dispositivo1`.`id_tipodispo`=`articulos`.`tipo_dispo` LEFT JOIN `marcas` as marcas1 ON `marcas1`.`id_marca`=`articulos`.`marca` LEFT JOIN `marca_modelo` as marca_modelo1 ON `marca_modelo1`.`id_mmodelo`=`articulos`.`modelo` LEFT JOIN `marca_presetacion` as marca_presetacion1 ON `marca_presetacion1`.`id`=`articulos`.`presentacion` LEFT JOIN `tipo_unidad_medida` as tipo_unidad_medida1 ON `tipo_unidad_medida1`.`id`=`marca_presetacion1`.`unidad_medida` LEFT JOIN `articulos_familia` as articulos_familia1 ON `articulos_familia1`.`id`=`articulos`.`familia` LEFT JOIN `unidades` as unidades1 ON `unidades1`.`id_unidades`=`articulos`.`ubicacion` LEFT JOIN `tipo_estado_dispo` as tipo_estado_dispo1 ON `tipo_estado_dispo1`.`id`=`articulos`.`estado` ORDER BY 2',
				'ubicacion' => 'SELECT `unidades`.`id_unidades`, `unidades`.`nombre` FROM `unidades` LEFT JOIN `ciudades` as ciudades1 ON `ciudades1`.`id_ciudad`=`unidades`.`ciudad` LEFT JOIN `prestador` as prestador1 ON `prestador1`.`id`=`unidades`.`prestador` ORDER BY 2',
				'abreviado' => 'SELECT `unidades`.`id_unidades`, IF(CHAR_LENGTH(`unidades`.`abreviado`) || CHAR_LENGTH(`unidades`.`ciudad`), CONCAT_WS(\'\', `unidades`.`abreviado`, \' - \', IF(    CHAR_LENGTH(`ciudades1`.`ciudad`), CONCAT_WS(\'\',   `ciudades1`.`ciudad`), \'\')), \'\') FROM `unidades` LEFT JOIN `ciudades` as ciudades1 ON `ciudades1`.`id_ciudad`=`unidades`.`ciudad` LEFT JOIN `prestador` as prestador1 ON `prestador1`.`id`=`unidades`.`prestador` ORDER BY 2',
			],
			'movimientos_articulos' => [
				'tipo_dispo' => 'SELECT `articulos`.`id`, IF(    CHAR_LENGTH(`tipo_dispositivo1`.`tipo_dispositivo`), CONCAT_WS(\'\',   `tipo_dispositivo1`.`tipo_dispositivo`), \'\') FROM `articulos` LEFT JOIN `tipo_dispositivo` as tipo_dispositivo1 ON `tipo_dispositivo1`.`id_tipodispo`=`articulos`.`tipo_dispo` LEFT JOIN `marcas` as marcas1 ON `marcas1`.`id_marca`=`articulos`.`marca` LEFT JOIN `marca_modelo` as marca_modelo1 ON `marca_modelo1`.`id_mmodelo`=`articulos`.`modelo` LEFT JOIN `marca_presetacion` as marca_presetacion1 ON `marca_presetacion1`.`id`=`articulos`.`presentacion` LEFT JOIN `tipo_unidad_medida` as tipo_unidad_medida1 ON `tipo_unidad_medida1`.`id`=`marca_presetacion1`.`unidad_medida` LEFT JOIN `articulos_familia` as articulos_familia1 ON `articulos_familia1`.`id`=`articulos`.`familia` LEFT JOIN `unidades` as unidades1 ON `unidades1`.`id_unidades`=`articulos`.`ubicacion` LEFT JOIN `tipo_estado_dispo` as tipo_estado_dispo1 ON `tipo_estado_dispo1`.`id`=`articulos`.`estado` ORDER BY 2',
				'nombre' => 'SELECT `articulos`.`id`, `articulos`.`nombre_unico` FROM `articulos` LEFT JOIN `tipo_dispositivo` as tipo_dispositivo1 ON `tipo_dispositivo1`.`id_tipodispo`=`articulos`.`tipo_dispo` LEFT JOIN `marcas` as marcas1 ON `marcas1`.`id_marca`=`articulos`.`marca` LEFT JOIN `marca_modelo` as marca_modelo1 ON `marca_modelo1`.`id_mmodelo`=`articulos`.`modelo` LEFT JOIN `marca_presetacion` as marca_presetacion1 ON `marca_presetacion1`.`id`=`articulos`.`presentacion` LEFT JOIN `tipo_unidad_medida` as tipo_unidad_medida1 ON `tipo_unidad_medida1`.`id`=`marca_presetacion1`.`unidad_medida` LEFT JOIN `articulos_familia` as articulos_familia1 ON `articulos_familia1`.`id`=`articulos`.`familia` LEFT JOIN `unidades` as unidades1 ON `unidades1`.`id_unidades`=`articulos`.`ubicacion` LEFT JOIN `tipo_estado_dispo` as tipo_estado_dispo1 ON `tipo_estado_dispo1`.`id`=`articulos`.`estado` ORDER BY 2',
				'serial_dispo' => 'SELECT `articulos`.`id`, `articulos`.`serial` FROM `articulos` LEFT JOIN `tipo_dispositivo` as tipo_dispositivo1 ON `tipo_dispositivo1`.`id_tipodispo`=`articulos`.`tipo_dispo` LEFT JOIN `marcas` as marcas1 ON `marcas1`.`id_marca`=`articulos`.`marca` LEFT JOIN `marca_modelo` as marca_modelo1 ON `marca_modelo1`.`id_mmodelo`=`articulos`.`modelo` LEFT JOIN `marca_presetacion` as marca_presetacion1 ON `marca_presetacion1`.`id`=`articulos`.`presentacion` LEFT JOIN `tipo_unidad_medida` as tipo_unidad_medida1 ON `tipo_unidad_medida1`.`id`=`marca_presetacion1`.`unidad_medida` LEFT JOIN `articulos_familia` as articulos_familia1 ON `articulos_familia1`.`id`=`articulos`.`familia` LEFT JOIN `unidades` as unidades1 ON `unidades1`.`id_unidades`=`articulos`.`ubicacion` LEFT JOIN `tipo_estado_dispo` as tipo_estado_dispo1 ON `tipo_estado_dispo1`.`id`=`articulos`.`estado` ORDER BY 2',
				'estado_movi' => 'SELECT `tipo_estado_movi`.`id`, `tipo_estado_movi`.`estado_movi` FROM `tipo_estado_movi` ORDER BY 2',
			],
			'movi_envio_articulo' => [
				'id_movi' => 'SELECT `movimientos_articulos`.`id_movi`, `movimientos_articulos`.`id_movi` FROM `movimientos_articulos` LEFT JOIN `articulos` as articulos1 ON `articulos1`.`id`=`movimientos_articulos`.`nombre` LEFT JOIN `tipo_estado_movi` as tipo_estado_movi1 ON `tipo_estado_movi1`.`id`=`movimientos_articulos`.`estado_movi` LEFT JOIN `tipo_dispositivo` as tipo_dispositivo1 ON `tipo_dispositivo1`.`id_tipodispo`=`articulos1`.`tipo_dispo` ORDER BY 2',
				'origen' => 'SELECT `unidades`.`id_unidades`, `unidades`.`nombre` FROM `unidades` LEFT JOIN `ciudades` as ciudades1 ON `ciudades1`.`id_ciudad`=`unidades`.`ciudad` LEFT JOIN `prestador` as prestador1 ON `prestador1`.`id`=`unidades`.`prestador` ORDER BY 2',
				'ubicacion' => 'SELECT `unidades`.`id_unidades`, `unidades`.`direccion` FROM `unidades` LEFT JOIN `ciudades` as ciudades1 ON `ciudades1`.`id_ciudad`=`unidades`.`ciudad` LEFT JOIN `prestador` as prestador1 ON `prestador1`.`id`=`unidades`.`prestador` ORDER BY 2',
				'ciudad' => 'SELECT `ciudades`.`id_ciudad`, `ciudades`.`ciudad` FROM `ciudades` ORDER BY 2',
				'nombre' => 'SELECT `contactos`.`id_contactos`, `contactos`.`nombre` FROM `contactos` LEFT JOIN `contactos_tipo_contacto` as contactos_tipo_contacto1 ON `contactos_tipo_contacto1`.`id_tipo_contacto`=`contactos`.`tipo_contacto` LEFT JOIN `tipo_iden` as tipo_iden1 ON `tipo_iden1`.`id_iden`=`contactos`.`tipo_iden` LEFT JOIN `ciudades` as ciudades1 ON `ciudades1`.`id_ciudad`=`contactos`.`ciudad` LEFT JOIN `tipo_relacion` as tipo_relacion1 ON `tipo_relacion1`.`id_tiporelac`=`contactos`.`tipo_relacion` ORDER BY 2',
				'telefono' => 'SELECT `contactos`.`id_contactos`, `contactos`.`telefono` FROM `contactos` LEFT JOIN `contactos_tipo_contacto` as contactos_tipo_contacto1 ON `contactos_tipo_contacto1`.`id_tipo_contacto`=`contactos`.`tipo_contacto` LEFT JOIN `tipo_iden` as tipo_iden1 ON `tipo_iden1`.`id_iden`=`contactos`.`tipo_iden` LEFT JOIN `ciudades` as ciudades1 ON `ciudades1`.`id_ciudad`=`contactos`.`ciudad` LEFT JOIN `tipo_relacion` as tipo_relacion1 ON `tipo_relacion1`.`id_tiporelac`=`contactos`.`tipo_relacion` ORDER BY 2',
			],
			'movi_recepcion_articulos' => [
				'id_movi' => 'SELECT `movimientos_articulos`.`id_movi`, `movimientos_articulos`.`id_movi` FROM `movimientos_articulos` LEFT JOIN `articulos` as articulos1 ON `articulos1`.`id`=`movimientos_articulos`.`nombre` LEFT JOIN `tipo_estado_movi` as tipo_estado_movi1 ON `tipo_estado_movi1`.`id`=`movimientos_articulos`.`estado_movi` LEFT JOIN `tipo_dispositivo` as tipo_dispositivo1 ON `tipo_dispositivo1`.`id_tipodispo`=`articulos1`.`tipo_dispo` ORDER BY 2',
				'destino' => 'SELECT `unidades`.`id_unidades`, IF(CHAR_LENGTH(`unidades`.`nombre`) || CHAR_LENGTH(`unidades`.`abreviado`), CONCAT_WS(\'\', `unidades`.`nombre`, \' | \', `unidades`.`abreviado`), \'\') FROM `unidades` LEFT JOIN `ciudades` as ciudades1 ON `ciudades1`.`id_ciudad`=`unidades`.`ciudad` LEFT JOIN `prestador` as prestador1 ON `prestador1`.`id`=`unidades`.`prestador` ORDER BY 2',
				'o_direccion' => 'SELECT `unidades`.`id_unidades`, `unidades`.`direccion` FROM `unidades` LEFT JOIN `ciudades` as ciudades1 ON `ciudades1`.`id_ciudad`=`unidades`.`ciudad` LEFT JOIN `prestador` as prestador1 ON `prestador1`.`id`=`unidades`.`prestador` ORDER BY 2',
				'ciudad' => 'SELECT `unidades`.`id_unidades`, IF(    CHAR_LENGTH(`ciudades1`.`ciudad`), CONCAT_WS(\'\',   `ciudades1`.`ciudad`), \'\') FROM `unidades` LEFT JOIN `ciudades` as ciudades1 ON `ciudades1`.`id_ciudad`=`unidades`.`ciudad` LEFT JOIN `prestador` as prestador1 ON `prestador1`.`id`=`unidades`.`prestador` ORDER BY 2',
				'nombre' => 'SELECT `contactos`.`id_contactos`, `contactos`.`nombre` FROM `contactos` LEFT JOIN `contactos_tipo_contacto` as contactos_tipo_contacto1 ON `contactos_tipo_contacto1`.`id_tipo_contacto`=`contactos`.`tipo_contacto` LEFT JOIN `tipo_iden` as tipo_iden1 ON `tipo_iden1`.`id_iden`=`contactos`.`tipo_iden` LEFT JOIN `ciudades` as ciudades1 ON `ciudades1`.`id_ciudad`=`contactos`.`ciudad` LEFT JOIN `tipo_relacion` as tipo_relacion1 ON `tipo_relacion1`.`id_tiporelac`=`contactos`.`tipo_relacion` ORDER BY 2',
				'telefono' => 'SELECT `contactos`.`id_contactos`, `contactos`.`telefono` FROM `contactos` LEFT JOIN `contactos_tipo_contacto` as contactos_tipo_contacto1 ON `contactos_tipo_contacto1`.`id_tipo_contacto`=`contactos`.`tipo_contacto` LEFT JOIN `tipo_iden` as tipo_iden1 ON `tipo_iden1`.`id_iden`=`contactos`.`tipo_iden` LEFT JOIN `ciudades` as ciudades1 ON `ciudades1`.`id_ciudad`=`contactos`.`ciudad` LEFT JOIN `tipo_relacion` as tipo_relacion1 ON `tipo_relacion1`.`id_tiporelac`=`contactos`.`tipo_relacion` ORDER BY 2',
			],
			'ubicacion_articulo' => [
				'id_articulo' => 'SELECT `articulos`.`id`, IF(CHAR_LENGTH(`articulos`.`nombre_unico`) || CHAR_LENGTH(`articulos`.`marca`), CONCAT_WS(\'\', `articulos`.`nombre_unico`, \' \', IF(    CHAR_LENGTH(`marcas1`.`marca`), CONCAT_WS(\'\',   `marcas1`.`marca`), \'\')), \'\') FROM `articulos` LEFT JOIN `tipo_dispositivo` as tipo_dispositivo1 ON `tipo_dispositivo1`.`id_tipodispo`=`articulos`.`tipo_dispo` LEFT JOIN `marcas` as marcas1 ON `marcas1`.`id_marca`=`articulos`.`marca` LEFT JOIN `marca_modelo` as marca_modelo1 ON `marca_modelo1`.`id_mmodelo`=`articulos`.`modelo` LEFT JOIN `marca_presetacion` as marca_presetacion1 ON `marca_presetacion1`.`id`=`articulos`.`presentacion` LEFT JOIN `tipo_unidad_medida` as tipo_unidad_medida1 ON `tipo_unidad_medida1`.`id`=`marca_presetacion1`.`unidad_medida` LEFT JOIN `articulos_familia` as articulos_familia1 ON `articulos_familia1`.`id`=`articulos`.`familia` LEFT JOIN `unidades` as unidades1 ON `unidades1`.`id_unidades`=`articulos`.`ubicacion` LEFT JOIN `tipo_estado_dispo` as tipo_estado_dispo1 ON `tipo_estado_dispo1`.`id`=`articulos`.`estado` ORDER BY 2',
				'ubicacion' => 'SELECT `unidades`.`id_unidades`, `unidades`.`nombre` FROM `unidades` LEFT JOIN `ciudades` as ciudades1 ON `ciudades1`.`id_ciudad`=`unidades`.`ciudad` LEFT JOIN `prestador` as prestador1 ON `prestador1`.`id`=`unidades`.`prestador` ORDER BY 2',
			],
			'ubicacion_mobiliario' => [
				'id_mobiliario' => 'SELECT `mobiliario`.`id_mobiliario`, IF(CHAR_LENGTH(`mobiliario`.`nombre`) || CHAR_LENGTH(`mobiliario`.`tipo_mobiliario`), CONCAT_WS(\'\', `mobiliario`.`nombre`, \' \', IF(    CHAR_LENGTH(`tipo_mobiliario1`.`tipo_mobiliario`), CONCAT_WS(\'\',   `tipo_mobiliario1`.`tipo_mobiliario`), \'\')), \'\') FROM `mobiliario` LEFT JOIN `tipo_grupo_mobilia` as tipo_grupo_mobilia1 ON `tipo_grupo_mobilia1`.`id_gru_mo`=`mobiliario`.`grupo` LEFT JOIN `tipo_mobiliario` as tipo_mobiliario1 ON `tipo_mobiliario1`.`id`=`mobiliario`.`tipo_mobiliario` LEFT JOIN `unidades` as unidades1 ON `unidades1`.`id_unidades`=`mobiliario`.`ubicacion` LEFT JOIN `unidades` as unidades2 ON `unidades2`.`id_unidades`=`mobiliario`.`unidad` ORDER BY 2',
				'ubicacion' => 'SELECT `unidades`.`id_unidades`, IF(CHAR_LENGTH(`unidades`.`nombre`) || CHAR_LENGTH(`unidades`.`abreviado`), CONCAT_WS(\'\', `unidades`.`nombre`, \' \', `unidades`.`abreviado`), \'\') FROM `unidades` LEFT JOIN `ciudades` as ciudades1 ON `ciudades1`.`id_ciudad`=`unidades`.`ciudad` LEFT JOIN `prestador` as prestador1 ON `prestador1`.`id`=`unidades`.`prestador` ORDER BY 2',
			],
			'precio_dispo_medico' => [
				'dispo_medico' => 'SELECT `compra_dispo`.`id`, `compra_dispo`.`id` FROM `compra_dispo` LEFT JOIN `tipo_dispositivo` as tipo_dispositivo1 ON `tipo_dispositivo1`.`id_tipodispo`=`compra_dispo`.`tipo_dispositivo` LEFT JOIN `marcas` as marcas1 ON `marcas1`.`id_marca`=`compra_dispo`.`marca` LEFT JOIN `marca_modelo` as marca_modelo1 ON `marca_modelo1`.`id_mmodelo`=`compra_dispo`.`modelo` LEFT JOIN `tipo_estado_dispo` as tipo_estado_dispo1 ON `tipo_estado_dispo1`.`id`=`compra_dispo`.`estado` LEFT JOIN `tipo_clasifica_riesgo` as tipo_clasifica_riesgo1 ON `tipo_clasifica_riesgo1`.`id`=`compra_dispo`.`riesgo` ORDER BY 2',
			],
			'precio_articulo' => [
			],
			'precio_mobiliario' => [
			],
		];

		return $lookupQuery[$tn][$lookupField];
	}

	#########################################################
	function pkGivenLookupText($val, $tn, $lookupField, $falseIfNotFound = false) {
		static $cache = [];
		if(isset($cache[$tn][$lookupField][$val])) return $cache[$tn][$lookupField][$val];

		if(!$lookupQuery = lookupQuery($tn, $lookupField)) {
			$cache[$tn][$lookupField][$val] = false;
			return false;
		}

		$m = [];

		// quit if query can't be parsed
		if(!preg_match('/select\s+(.*?),\s+(.*?)\s+from\s+(.*)/i', $lookupQuery, $m)) {
			$cache[$tn][$lookupField][$val] = false;
			return false;
		}

		list($all, $pkField, $lookupField, $from) = $m;
		$from = preg_replace('/\s+order\s+by.*$/i', '', $from);
		if(!$lookupField || !$from) {
			$cache[$tn][$lookupField][$val] = false;
			return false;
		}

		// append WHERE if not already there
		if(!preg_match('/\s+where\s+/i', $from)) $from .= ' WHERE 1=1 AND';

		$safeVal = makeSafe($val);
		$id = sqlValue("SELECT {$pkField} FROM {$from} {$lookupField}='{$safeVal}'");
		if($id !== false) {
			$cache[$tn][$lookupField][$val] = $id;
			return $id;
		}

		// no corresponding PK value found
		if($falseIfNotFound) {
			$cache[$tn][$lookupField][$val] = false;
			return false;
		} else {
			$cache[$tn][$lookupField][$val] = $val;
			return $val;
		}
	}
	#########################################################
	function userCanImport() {
		$mi = getMemberInfo();
		$safeUser = makeSafe($mi['username']);
		$groupID = intval($mi['groupID']);

		// admins can always import
		if($mi['group'] == 'Admins') return true;

		// anonymous users can never import
		if($mi['group'] == config('adminConfig')['anonymousGroup']) return false;

		// specific user can import?
		if(sqlValue("SELECT COUNT(1) FROM `membership_users` WHERE `memberID`='{$safeUser}' AND `allowCSVImport`='1'")) return true;

		// user's group can import?
		if(sqlValue("SELECT COUNT(1) FROM `membership_groups` WHERE `groupID`='{$groupID}' AND `allowCSVImport`='1'")) return true;

		return false;
	}
	#########################################################
	function parseTemplate($template) {
		if(trim($template) == '') return $template;

		global $Translation;
		foreach($Translation as $symbol => $trans)
			$template = str_replace("<%%TRANSLATION($symbol)%%>", $trans, $template);

		// Correct <MaxSize> and <FileTypes> to prevent invalid HTML
		$template = str_replace(['<MaxSize>', '<FileTypes>'], ['{MaxSize}', '{FileTypes}'], $template);
		$template = str_replace('<%%BASE_UPLOAD_PATH%%>', getUploadDir(''), $template);

		return $template;
	}
	#########################################################
	function getUploadDir($dir) {
		if($dir == '') $dir = config('adminConfig')['baseUploadPath'];

		return rtrim($dir, '\\/') . '/';
	}
	#########################################################
	function bgStyleToClass($html) {
		return preg_replace(
			'/ style="background-color: rgb\((\d+), (\d+), (\d+)\);"/',
			' class="nicedit-bg" data-nicedit_r="$1" data-nicedit_g="$2" data-nicedit_b="$3"',
			$html
		);
	}
	#########################################################
	function assocArrFilter($arr, $func) {
		if(!is_array($arr) || !count($arr)) return $arr;
		if(!is_callable($func)) return false;

		$filtered = [];
		foreach ($arr as $key => $value)
			if(call_user_func_array($func, [$key, $value]) === true)
				$filtered[$key] = $value;

		return $filtered;
	}
