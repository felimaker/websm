<?php
	// check this file's MD5 to make sure it wasn't called before
	$prevMD5 = @file_get_contents(dirname(__FILE__) . '/setup.md5');
	$thisMD5 = md5(@file_get_contents(dirname(__FILE__) . '/updateDB.php'));

	// check if setup already run
	if($thisMD5 != $prevMD5) {
		// $silent is set if this file is included from setup.php
		if(!isset($silent)) $silent = true;

		// set up tables
		setupTable(
			'dispositivos', " 
			CREATE TABLE IF NOT EXISTS `dispositivos` ( 
				`codigo` VARCHAR(4) NULL,
				UNIQUE `codigo_unique` (`codigo`),
				`id_dispo` INT UNSIGNED NOT NULL AUTO_INCREMENT,
				PRIMARY KEY (`id_dispo`),
				`foto` INT UNSIGNED NULL,
				`code` VARCHAR(40) NULL,
				`serial` VARCHAR(40) NOT NULL,
				UNIQUE `serial_unique` (`serial`),
				`tipo_dispositivo` INT UNSIGNED NOT NULL,
				`marca` INT UNSIGNED NOT NULL,
				`modelo` INT UNSIGNED NOT NULL,
				`ubicacion` INT UNSIGNED NULL,
				`ubicacion_abre` INT UNSIGNED NULL,
				`fecha_ingreso` DATE NOT NULL,
				`clasificacion_riesgo` INT UNSIGNED NOT NULL,
				`estado` INT UNSIGNED NOT NULL,
				`precio` DOUBLE(10,2) NULL,
				`creado` DATETIME NULL,
				`creado_por` VARCHAR(40) NULL,
				`editado` DATETIME NULL,
				`editado_por` VARCHAR(40) NULL,
				`id_compra_ingreso` INT UNSIGNED NULL
			) CHARSET utf8",
			$silent
		);
		setupIndexes('dispositivos', ['tipo_dispositivo','marca','modelo','ubicacion','clasificacion_riesgo','estado','id_compra_ingreso',]);

		setupTable(
			'mobiliario', " 
			CREATE TABLE IF NOT EXISTS `mobiliario` ( 
				`id_mobiliario` INT UNSIGNED NOT NULL AUTO_INCREMENT,
				PRIMARY KEY (`id_mobiliario`),
				`codigo` VARCHAR(40) NULL,
				`nombre` VARCHAR(40) NULL,
				`grupo` INT UNSIGNED NULL,
				`tipo_mobiliario` INT UNSIGNED NOT NULL,
				`descripcion` TEXT NULL,
				`fecha_ingreso` DATE NOT NULL,
				`accesorios` TEXT NULL,
				`foto` VARCHAR(40) NULL,
				`unidad` INT UNSIGNED NULL,
				`uni_abreviado` INT UNSIGNED NULL,
				`creado` DATETIME NULL,
				`creado_por` VARCHAR(40) NULL,
				`editado` VARCHAR(40) NULL,
				`editado_por` VARCHAR(40) NULL,
				`id_compra` VARCHAR(40) NULL
			) CHARSET utf8",
			$silent
		);
		setupIndexes('mobiliario', ['grupo','tipo_mobiliario','unidad',]);

		setupTable(
			'contactos', " 
			CREATE TABLE IF NOT EXISTS `contactos` ( 
				`id_contactos` INT UNSIGNED NOT NULL AUTO_INCREMENT,
				PRIMARY KEY (`id_contactos`),
				`tipo_contacto` INT UNSIGNED NOT NULL,
				`tipo_iden` INT UNSIGNED NOT NULL,
				`identificacion` VARCHAR(40) NOT NULL,
				UNIQUE `identificacion_unique` (`identificacion`),
				`nombre` VARCHAR(40) NOT NULL,
				`ciudad` INT UNSIGNED NOT NULL,
				`telefono` VARCHAR(30) NOT NULL,
				`direccion` TEXT NULL,
				`tipo_relacion` INT UNSIGNED NOT NULL,
				`nota` TEXT NOT NULL,
				`reg_creado` DATETIME NULL,
				`creado` DATETIME NULL,
				`creado_por` VARCHAR(40) NULL,
				`editado` DATETIME NULL,
				`editado_por` VARCHAR(40) NULL
			) CHARSET utf8",
			$silent
		);
		setupIndexes('contactos', ['tipo_contacto','tipo_iden','ciudad','tipo_relacion',]);

		setupTable(
			'contactos_tipo_contacto', " 
			CREATE TABLE IF NOT EXISTS `contactos_tipo_contacto` ( 
				`id_tipo_contacto` INT UNSIGNED NOT NULL AUTO_INCREMENT,
				PRIMARY KEY (`id_tipo_contacto`),
				`tipo_contacto` VARCHAR(40) NOT NULL,
				UNIQUE `tipo_contacto_unique` (`tipo_contacto`),
				`descripcion` TEXT NULL
			) CHARSET utf8",
			$silent
		);

		setupTable(
			'movimientos', " 
			CREATE TABLE IF NOT EXISTS `movimientos` ( 
				`id_movi` INT UNSIGNED NOT NULL AUTO_INCREMENT,
				PRIMARY KEY (`id_movi`),
				`img` INT UNSIGNED NULL,
				`tipo_dispo` INT UNSIGNED NULL,
				`codigo_dispo` INT UNSIGNED NOT NULL,
				`serial_dispo` INT UNSIGNED NULL,
				`estado_movi` INT UNSIGNED NULL,
				`origen` VARCHAR(40) NULL,
				`destino` VARCHAR(40) NULL,
				`creado` DATETIME NULL,
				`creado_por` VARCHAR(40) NULL,
				`editado` DATETIME NULL,
				`editado_por` VARCHAR(40) NULL
			) CHARSET utf8",
			$silent
		);
		setupIndexes('movimientos', ['codigo_dispo','estado_movi',]);

		setupTable(
			'documentos', " 
			CREATE TABLE IF NOT EXISTS `documentos` ( 
				`id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
				PRIMARY KEY (`id`),
				`dispo_codigo` INT UNSIGNED NOT NULL,
				`dispo_serial` INT UNSIGNED NULL,
				`tipo_docu` INT UNSIGNED NOT NULL,
				`enlace` TEXT NULL,
				`descripcion` TEXT NOT NULL,
				`fecha_carga` VARCHAR(40) NULL,
				`creado` DATETIME NULL,
				`creado_por` VARCHAR(40) NULL,
				`editado` DATETIME NULL,
				`editado_por` VARCHAR(40) NULL
			) CHARSET utf8",
			$silent
		);
		setupIndexes('documentos', ['dispo_codigo','tipo_docu',]);

		setupTable(
			'mantenimientos', " 
			CREATE TABLE IF NOT EXISTS `mantenimientos` ( 
				`id_mtto` INT UNSIGNED NOT NULL AUTO_INCREMENT,
				PRIMARY KEY (`id_mtto`),
				`codigo` INT UNSIGNED NOT NULL,
				`serial` INT UNSIGNED NULL,
				`tipo_dispo` INT UNSIGNED NULL,
				`fecha_mtto` DATE NOT NULL,
				`tipo_mtto` INT UNSIGNED NOT NULL,
				`responsable` INT UNSIGNED NOT NULL,
				`id_responsable` INT UNSIGNED NULL,
				`documento` VARCHAR(100) NULL,
				`documento_drive` TEXT NULL,
				`unidad` INT UNSIGNED NOT NULL,
				`unidad_abreviado` INT UNSIGNED NULL,
				`descripcion` TEXT NOT NULL,
				`estado_final` INT UNSIGNED NOT NULL,
				`creado_por` VARCHAR(40) NULL,
				`editado_por` VARCHAR(40) NULL,
				`creado` DATETIME NULL,
				`editado` DATETIME NULL
			) CHARSET utf8",
			$silent
		);
		setupIndexes('mantenimientos', ['codigo','tipo_mtto','responsable','unidad','estado_final',]);

		setupTable(
			'calibraciones', " 
			CREATE TABLE IF NOT EXISTS `calibraciones` ( 
				`id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
				PRIMARY KEY (`id`),
				`codigo` INT UNSIGNED NOT NULL,
				`serial` INT UNSIGNED NULL,
				`tipo_calibracion` INT UNSIGNED NOT NULL,
				`no_documento` VARCHAR(40) NULL,
				`fecha_calibra` DATE NOT NULL,
				`fecha_expiracion` DATE NOT NULL,
				`empresa` INT UNSIGNED NOT NULL,
				`telefono` INT UNSIGNED NULL,
				`documento` VARCHAR(40) NOT NULL,
				`descripcion` TEXT NULL,
				`creado` DATETIME NULL,
				`creado_por` VARCHAR(40) NULL,
				`editado` DATETIME NULL,
				`editado_por` VARCHAR(40) NULL
			) CHARSET utf8",
			$silent
		);
		setupIndexes('calibraciones', ['codigo','tipo_calibracion','empresa',]);

		setupTable(
			'unidades', " 
			CREATE TABLE IF NOT EXISTS `unidades` ( 
				`id_unidades` INT UNSIGNED NOT NULL AUTO_INCREMENT,
				PRIMARY KEY (`id_unidades`),
				`nombre` VARCHAR(40) NOT NULL,
				UNIQUE `nombre_unique` (`nombre`),
				`abreviado` VARCHAR(40) NOT NULL,
				UNIQUE `abreviado_unique` (`abreviado`),
				`ciudad` INT UNSIGNED NULL,
				`telefono` VARCHAR(40) NOT NULL,
				`direccion` TEXT NOT NULL,
				`ubicacion` VARCHAR(60) NULL,
				`prestador` INT UNSIGNED NULL,
				`logo` VARCHAR(40) NULL,
				`dispositivos_costo` DECIMAL(10,0) NULL,
				`mobiliario_costo` DECIMAL(10,2) NULL,
				`costo_total` DECIMAL(10,2) NULL
			) CHARSET utf8",
			$silent
		);
		setupIndexes('unidades', ['ciudad','prestador',]);

		setupTable(
			'marcas', " 
			CREATE TABLE IF NOT EXISTS `marcas` ( 
				`id_marca` INT UNSIGNED NOT NULL AUTO_INCREMENT,
				PRIMARY KEY (`id_marca`),
				`marca` VARCHAR(40) NOT NULL,
				UNIQUE `marca_unique` (`marca`),
				`descripcion` TEXT NULL
			) CHARSET utf8",
			$silent
		);

		setupTable(
			'marca_modelo', " 
			CREATE TABLE IF NOT EXISTS `marca_modelo` ( 
				`id_mmodelo` INT UNSIGNED NOT NULL AUTO_INCREMENT,
				PRIMARY KEY (`id_mmodelo`),
				`marca` INT UNSIGNED NOT NULL,
				`modelo` VARCHAR(40) NOT NULL,
				UNIQUE `modelo_unique` (`modelo`),
				`img` VARCHAR(40) NOT NULL,
				`fabricante` VARCHAR(40) NULL,
				`descripcion` TEXT NULL,
				`creado` DATETIME NULL,
				`creado_por` VARCHAR(40) NULL
			) CHARSET utf8",
			$silent
		);
		setupIndexes('marca_modelo', ['marca',]);

		setupTable(
			'accesorios', " 
			CREATE TABLE IF NOT EXISTS `accesorios` ( 
				`id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
				PRIMARY KEY (`id`),
				`codigo_accesorio` VARCHAR(40) NULL,
				`tipo_accesorio` INT UNSIGNED NULL,
				`nombre_accesorio` VARCHAR(60) NOT NULL,
				`descripcion` TEXT NULL,
				`id_dispo` INT UNSIGNED NULL,
				`creado` DATETIME NULL,
				`creado_por` VARCHAR(40) NULL
			) CHARSET utf8",
			$silent
		);
		setupIndexes('accesorios', ['tipo_accesorio','id_dispo',]);

		setupTable(
			'ciudades', " 
			CREATE TABLE IF NOT EXISTS `ciudades` ( 
				`id_ciudad` INT UNSIGNED NOT NULL AUTO_INCREMENT,
				PRIMARY KEY (`id_ciudad`),
				`ciudad` VARCHAR(40) NOT NULL,
				UNIQUE `ciudad_unique` (`ciudad`),
				`descripcion` TEXT NULL
			) CHARSET utf8",
			$silent
		);

		setupTable(
			'verificacion', " 
			CREATE TABLE IF NOT EXISTS `verificacion` ( 
				`id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
				PRIMARY KEY (`id`),
				`codigo` INT UNSIGNED NULL,
				`tipo_dispo` INT UNSIGNED NULL,
				`serial` INT UNSIGNED NULL,
				`ubicacion` INT UNSIGNED NOT NULL,
				`abreviado` INT UNSIGNED NULL,
				`verificacion` VARCHAR(40) NOT NULL,
				`comentario` TEXT NULL,
				`fecha_verifi` DATETIME NULL,
				`verifi_por` VARCHAR(40) NULL
			) CHARSET utf8",
			$silent
		);
		setupIndexes('verificacion', ['codigo','ubicacion',]);

		setupTable(
			'hojadevida', " 
			CREATE TABLE IF NOT EXISTS `hojadevida` ( 
				`id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
				PRIMARY KEY (`id`),
				`dispo_codigo` INT UNSIGNED NOT NULL,
				`dispo_serial` INT UNSIGNED NULL,
				`hardware` INT UNSIGNED NULL,
				`software` TEXT NULL,
				`carga` VARCHAR(40) NULL,
				`creado` DATETIME NULL,
				`creado_por` VARCHAR(40) NULL,
				`editado` DATETIME NULL,
				`editado_por` VARCHAR(40) NULL
			) CHARSET utf8",
			$silent
		);
		setupIndexes('hojadevida', ['dispo_codigo',]);

		setupTable(
			'financiero', " 
			CREATE TABLE IF NOT EXISTS `financiero` ( 
				`id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
				PRIMARY KEY (`id`),
				`id_dispo` INT UNSIGNED NULL,
				`precio` DECIMAL(10,0) NOT NULL,
				`unidad` INT UNSIGNED NULL,
				`enlace` TEXT NULL,
				`creado` DATETIME NULL,
				`creado_por` VARCHAR(40) NULL,
				`editado` DATETIME NULL,
				`editado_por` VARCHAR(40) NULL
			) CHARSET utf8",
			$silent
		);
		setupIndexes('financiero', ['id_dispo',]);

		setupTable(
			'financiero_mobiliario', " 
			CREATE TABLE IF NOT EXISTS `financiero_mobiliario` ( 
				`id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
				PRIMARY KEY (`id`),
				`id_dispo` INT UNSIGNED NULL,
				`precio` DECIMAL(10,0) NOT NULL,
				`unidad` INT UNSIGNED NULL,
				`enlace` TEXT NULL,
				`creado` DATETIME NULL,
				`creado_por` VARCHAR(40) NULL,
				`editado` DATETIME NULL,
				`editado_por` VARCHAR(40) NULL
			) CHARSET utf8",
			$silent
		);
		setupIndexes('financiero_mobiliario', ['id_dispo',]);

		setupTable(
			'prestador', " 
			CREATE TABLE IF NOT EXISTS `prestador` ( 
				`id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
				PRIMARY KEY (`id`),
				`nombre` VARCHAR(40) NOT NULL,
				`razon_social` INT UNSIGNED NOT NULL,
				`nit` INT UNSIGNED NULL,
				`descripcion` TEXT NULL
			) CHARSET utf8",
			$silent
		);
		setupIndexes('prestador', ['razon_social',]);

		setupTable(
			'docu_modelo', " 
			CREATE TABLE IF NOT EXISTS `docu_modelo` ( 
				`id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
				PRIMARY KEY (`id`),
				`tipo_dispo` INT UNSIGNED NULL,
				`marca` INT UNSIGNED NULL,
				`modelo` INT UNSIGNED NULL,
				`tipo_documento` INT UNSIGNED NULL,
				`enlace` VARCHAR(40) NULL,
				`descripcion` TEXT NULL,
				`creado` DATETIME NULL,
				`creado_por` VARCHAR(40) NULL,
				`editado` DATETIME NULL,
				`editado_por` VARCHAR(40) NULL
			) CHARSET utf8",
			$silent
		);
		setupIndexes('docu_modelo', ['tipo_dispo','marca','modelo','tipo_documento',]);

		setupTable(
			'facturas', " 
			CREATE TABLE IF NOT EXISTS `facturas` ( 
				`id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
				PRIMARY KEY (`id`),
				`id_dispo` INT UNSIGNED NULL,
				`no_factura` VARCHAR(40) NOT NULL,
				UNIQUE `no_factura_unique` (`no_factura`),
				`fecha_factura` VARCHAR(40) NOT NULL,
				`proveedor` INT UNSIGNED NULL,
				`identificacion` INT UNSIGNED NULL,
				`enlace_doc` TEXT NULL,
				`creado` DATETIME NULL,
				`creado_por` VARCHAR(40) NULL,
				`editado` DATETIME NULL,
				`editado_por` VARCHAR(40) NULL,
				`id_compras` INT UNSIGNED NULL
			) CHARSET utf8",
			$silent
		);
		setupIndexes('facturas', ['id_dispo','proveedor','id_compras',]);

		setupTable(
			'formatos', " 
			CREATE TABLE IF NOT EXISTS `formatos` ( 
				`id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
				PRIMARY KEY (`id`),
				`tipo_formato` INT UNSIGNED NOT NULL,
				`tipo_dispositivo` INT UNSIGNED NOT NULL,
				`nombre_formato` VARCHAR(50) NOT NULL,
				`formato` TEXT NULL,
				`descripcion` TEXT NULL,
				`creado` DATETIME NULL
			) CHARSET utf8",
			$silent
		);
		setupIndexes('formatos', ['tipo_formato','tipo_dispositivo',]);

		setupTable(
			'dispo_fuera', " 
			CREATE TABLE IF NOT EXISTS `dispo_fuera` ( 
				`id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
				PRIMARY KEY (`id`),
				`img` INT UNSIGNED NULL,
				`codigo` INT UNSIGNED NULL,
				`serial` INT UNSIGNED NULL,
				`ubicacion_final` INT UNSIGNED NULL,
				`tipo_fuera_servicio` INT UNSIGNED NOT NULL,
				`fecha_reporte` DATE NOT NULL,
				`descripcion` TEXT NULL,
				`creado` DATETIME NULL,
				`creado_por` VARCHAR(40) NULL,
				`editado` DATETIME NULL,
				`edtado_por` VARCHAR(40) NULL
			) CHARSET utf8",
			$silent
		);
		setupIndexes('dispo_fuera', ['codigo','tipo_fuera_servicio',]);

		setupTable(
			'dispositivo_tipo_grupo', " 
			CREATE TABLE IF NOT EXISTS `dispositivo_tipo_grupo` ( 
				`id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
				PRIMARY KEY (`id`),
				`grupo` VARCHAR(40) NOT NULL,
				UNIQUE `grupo_unique` (`grupo`),
				`descripcion` TEXT NULL
			) CHARSET utf8",
			$silent
		);

		setupTable(
			'tipo_relacion', " 
			CREATE TABLE IF NOT EXISTS `tipo_relacion` ( 
				`id_tiporelac` INT UNSIGNED NOT NULL AUTO_INCREMENT,
				PRIMARY KEY (`id_tiporelac`),
				`tipo_relac` VARCHAR(40) NOT NULL,
				UNIQUE `tipo_relac_unique` (`tipo_relac`),
				`descripcion` TEXT NULL,
				`creado` DATETIME NULL
			) CHARSET utf8",
			$silent
		);

		setupTable(
			'tipo_dispositivo', " 
			CREATE TABLE IF NOT EXISTS `tipo_dispositivo` ( 
				`id_tipodispo` INT UNSIGNED NOT NULL AUTO_INCREMENT,
				PRIMARY KEY (`id_tipodispo`),
				`tipo_dispositivo` VARCHAR(40) NOT NULL,
				UNIQUE `tipo_dispositivo_unique` (`tipo_dispositivo`),
				`grupo_dispo` INT UNSIGNED NOT NULL,
				`prefijo` VARCHAR(40) NOT NULL,
				`descripcion` TEXT NULL
			) CHARSET utf8",
			$silent
		);
		setupIndexes('tipo_dispositivo', ['grupo_dispo',]);

		setupTable(
			'tipo_documento', " 
			CREATE TABLE IF NOT EXISTS `tipo_documento` ( 
				`id_tipodoc` INT UNSIGNED NOT NULL AUTO_INCREMENT,
				PRIMARY KEY (`id_tipodoc`),
				`tipo_doc` VARCHAR(40) NOT NULL,
				UNIQUE `tipo_doc_unique` (`tipo_doc`),
				`grupo` INT UNSIGNED NULL,
				`descripcion` TEXT NULL
			) CHARSET utf8",
			$silent
		);
		setupIndexes('tipo_documento', ['grupo',]);

		setupTable(
			'tipo_iden', " 
			CREATE TABLE IF NOT EXISTS `tipo_iden` ( 
				`id_iden` INT UNSIGNED NOT NULL AUTO_INCREMENT,
				PRIMARY KEY (`id_iden`),
				`tipo_iden` VARCHAR(40) NOT NULL,
				UNIQUE `tipo_iden_unique` (`tipo_iden`),
				`tipo_iden_abre` VARCHAR(40) NOT NULL,
				UNIQUE `tipo_iden_abre_unique` (`tipo_iden_abre`)
			) CHARSET utf8",
			$silent
		);

		setupTable(
			'tipo_razon_social', " 
			CREATE TABLE IF NOT EXISTS `tipo_razon_social` ( 
				`id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
				PRIMARY KEY (`id`),
				`razon_social` VARCHAR(40) NOT NULL,
				UNIQUE `razon_social_unique` (`razon_social`),
				`nit` VARCHAR(40) NULL,
				`descripcion` TEXT NULL
			) CHARSET utf8",
			$silent
		);

		setupTable(
			'tipo_mobiliario', " 
			CREATE TABLE IF NOT EXISTS `tipo_mobiliario` ( 
				`id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
				PRIMARY KEY (`id`),
				`grupo_mobi` INT UNSIGNED NULL,
				`tipo_mobiliario` VARCHAR(40) NOT NULL,
				`caracteristicas` TEXT NULL
			) CHARSET utf8",
			$silent
		);
		setupIndexes('tipo_mobiliario', ['grupo_mobi',]);

		setupTable(
			'tipo_grupo_mobilia', " 
			CREATE TABLE IF NOT EXISTS `tipo_grupo_mobilia` ( 
				`id_gru_mo` INT UNSIGNED NOT NULL AUTO_INCREMENT,
				PRIMARY KEY (`id_gru_mo`),
				`grupo` VARCHAR(40) NOT NULL,
				`prefijo` VARCHAR(40) NULL,
				`descripcion` TEXT NULL
			) CHARSET utf8",
			$silent
		);

		setupTable(
			'tipo_estado_dispo', " 
			CREATE TABLE IF NOT EXISTS `tipo_estado_dispo` ( 
				`id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
				PRIMARY KEY (`id`),
				`estado_dispo` VARCHAR(40) NOT NULL,
				`descripcion` TEXT NULL
			) CHARSET utf8",
			$silent
		);

		setupTable(
			'tipo_movimiento', " 
			CREATE TABLE IF NOT EXISTS `tipo_movimiento` ( 
				`id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
				PRIMARY KEY (`id`),
				`tipo_movimiento` VARCHAR(40) NOT NULL,
				UNIQUE `tipo_movimiento_unique` (`tipo_movimiento`),
				`descripcion` TEXT NULL
			) CHARSET utf8",
			$silent
		);

		setupTable(
			'tipo_estado_movi', " 
			CREATE TABLE IF NOT EXISTS `tipo_estado_movi` ( 
				`id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
				PRIMARY KEY (`id`),
				`estado_movi` VARCHAR(40) NOT NULL,
				UNIQUE `estado_movi_unique` (`estado_movi`),
				`descripcion` TEXT NULL
			) CHARSET utf8",
			$silent
		);

		setupTable(
			'tipo_estado_verifica', " 
			CREATE TABLE IF NOT EXISTS `tipo_estado_verifica` ( 
				`id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
				PRIMARY KEY (`id`),
				`estado_verificado` VARCHAR(40) NOT NULL,
				UNIQUE `estado_verificado_unique` (`estado_verificado`),
				`descripcion` TEXT NULL
			) CHARSET utf8",
			$silent
		);

		setupTable(
			'tipo_mtto', " 
			CREATE TABLE IF NOT EXISTS `tipo_mtto` ( 
				`id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
				PRIMARY KEY (`id`),
				`tipo_mtto` VARCHAR(40) NOT NULL,
				UNIQUE `tipo_mtto_unique` (`tipo_mtto`),
				`descripcion` TEXT NULL
			) CHARSET utf8",
			$silent
		);

		setupTable(
			'tipo_calibracion', " 
			CREATE TABLE IF NOT EXISTS `tipo_calibracion` ( 
				`id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
				PRIMARY KEY (`id`),
				`tipo_calibracion` VARCHAR(40) NOT NULL,
				UNIQUE `tipo_calibracion_unique` (`tipo_calibracion`),
				`descripcion` TEXT NULL
			) CHARSET utf8",
			$silent
		);

		setupTable(
			'tipo_accesorio', " 
			CREATE TABLE IF NOT EXISTS `tipo_accesorio` ( 
				`id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
				PRIMARY KEY (`id`),
				`tipo_accesorio` VARCHAR(40) NOT NULL,
				`prefijo` VARCHAR(40) NULL,
				`descripcion` TEXT NULL
			) CHARSET utf8",
			$silent
		);

		setupTable(
			'tipo_formatos', " 
			CREATE TABLE IF NOT EXISTS `tipo_formatos` ( 
				`id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
				PRIMARY KEY (`id`),
				`tipo_formato` VARCHAR(60) NOT NULL,
				`descripcion` TEXT NULL
			) CHARSET utf8",
			$silent
		);

		setupTable(
			'dispo_detalles_tecnicos', " 
			CREATE TABLE IF NOT EXISTS `dispo_detalles_tecnicos` ( 
				`id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
				PRIMARY KEY (`id`),
				`id_dispo` INT UNSIGNED NULL,
				`detalles` TEXT NULL,
				`creado` DATETIME NULL
			) CHARSET utf8",
			$silent
		);
		setupIndexes('dispo_detalles_tecnicos', ['id_dispo',]);

		setupTable(
			'tipo_estado_observaciones', " 
			CREATE TABLE IF NOT EXISTS `tipo_estado_observaciones` ( 
				`id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
				PRIMARY KEY (`id`),
				`estado_observa` VARCHAR(40) NOT NULL,
				`descripcion` TEXT NOT NULL
			) CHARSET utf8",
			$silent
		);

		setupTable(
			'movi_envio', " 
			CREATE TABLE IF NOT EXISTS `movi_envio` ( 
				`id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
				PRIMARY KEY (`id`),
				`id_movi` INT UNSIGNED NULL,
				`fecha_envio` DATE NOT NULL,
				`origen` INT UNSIGNED NULL,
				`ubicacion` INT UNSIGNED NULL,
				`destino` VARCHAR(100) NOT NULL,
				`d_direccion` TEXT NULL,
				`ciudad` INT UNSIGNED NOT NULL,
				`nombre` INT UNSIGNED NOT NULL,
				`telefono` INT UNSIGNED NULL,
				`detalles` TEXT NULL,
				`creado` DATETIME NULL,
				`creado_por` VARCHAR(40) NULL,
				`editado` DATETIME NULL,
				`editado_por` VARCHAR(40) NULL
			) CHARSET utf8",
			$silent
		);
		setupIndexes('movi_envio', ['id_movi','origen','ciudad','nombre',]);

		setupTable(
			'movi_recepcion', " 
			CREATE TABLE IF NOT EXISTS `movi_recepcion` ( 
				`id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
				PRIMARY KEY (`id`),
				`id_movi` INT UNSIGNED NULL,
				`fecha_recepcion` DATE NOT NULL,
				`destino` INT UNSIGNED NOT NULL,
				`o_direccion` INT UNSIGNED NULL,
				`ciudad` INT UNSIGNED NULL,
				`verificado` TEXT NOT NULL,
				`nombre` INT UNSIGNED NOT NULL,
				`telefono` INT UNSIGNED NULL,
				`detalles` TEXT NULL,
				`creado` DATETIME NULL,
				`creado_por` VARCHAR(40) NULL,
				`editado` DATETIME NULL,
				`editado_por` VARCHAR(40) NULL
			) CHARSET utf8",
			$silent
		);
		setupIndexes('movi_recepcion', ['id_movi','destino','nombre',]);

		setupTable(
			'tipo_fuera_servicio', " 
			CREATE TABLE IF NOT EXISTS `tipo_fuera_servicio` ( 
				`id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
				PRIMARY KEY (`id`),
				`tipo_fuera_servicio` VARCHAR(40) NOT NULL,
				`descripcion` TEXT NULL
			) CHARSET utf8",
			$silent
		);

		setupTable(
			'tipo_documento_ss', " 
			CREATE TABLE IF NOT EXISTS `tipo_documento_ss` ( 
				`id_tipodoc` INT UNSIGNED NOT NULL AUTO_INCREMENT,
				PRIMARY KEY (`id_tipodoc`),
				`tipo_doc` VARCHAR(40) NOT NULL,
				UNIQUE `tipo_doc_unique` (`tipo_doc`),
				`descripcion` TEXT NULL
			) CHARSET utf8",
			$silent
		);

		setupTable(
			'tipo_parentesco', " 
			CREATE TABLE IF NOT EXISTS `tipo_parentesco` ( 
				`id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
				PRIMARY KEY (`id`),
				`parentesco` VARCHAR(40) NOT NULL,
				`descripcion` VARCHAR(40) NULL
			) CHARSET utf8",
			$silent
		);

		setupTable(
			'tipo_rh', " 
			CREATE TABLE IF NOT EXISTS `tipo_rh` ( 
				`id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
				PRIMARY KEY (`id`),
				`tipo_rh` VARCHAR(40) NULL
			) CHARSET utf8",
			$silent
		);

		setupTable(
			'accesorio_dispo_relacion', " 
			CREATE TABLE IF NOT EXISTS `accesorio_dispo_relacion` ( 
				`id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
				PRIMARY KEY (`id`),
				`id_dispo` INT UNSIGNED NULL,
				`id_accesorio` INT UNSIGNED NULL,
				`tipo_dispo` INT UNSIGNED NULL,
				`serial` INT UNSIGNED NULL,
				`marca_modelo` INT UNSIGNED NULL,
				`creado` DATETIME NULL,
				`creado_por` VARCHAR(40) NULL
			) CHARSET utf8",
			$silent
		);
		setupIndexes('accesorio_dispo_relacion', ['id_dispo','id_accesorio',]);

		setupTable(
			'observaciones', " 
			CREATE TABLE IF NOT EXISTS `observaciones` ( 
				`id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
				PRIMARY KEY (`id`),
				`estado_observacion` INT UNSIGNED NULL,
				`estado` INT UNSIGNED NOT NULL,
				`codigo` INT UNSIGNED NULL,
				`tipo_dispo` INT UNSIGNED NULL,
				`serial` INT UNSIGNED NULL,
				`unidad` INT UNSIGNED NOT NULL,
				`observacion` TEXT NOT NULL,
				`creado` DATETIME NULL,
				`creado_por` VARCHAR(40) NULL
			) CHARSET utf8",
			$silent
		);
		setupIndexes('observaciones', ['estado_observacion','estado','codigo','unidad',]);

		setupTable(
			'foto_observacion', " 
			CREATE TABLE IF NOT EXISTS `foto_observacion` ( 
				`id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
				PRIMARY KEY (`id`),
				`id_observacion` INT UNSIGNED NULL,
				`foto` VARCHAR(40) NOT NULL,
				`descripcion` TEXT NOT NULL,
				`creado` DATETIME NULL,
				`creado_por` VARCHAR(40) NULL
			) CHARSET utf8",
			$silent
		);
		setupIndexes('foto_observacion', ['id_observacion',]);

		setupTable(
			'progreso', " 
			CREATE TABLE IF NOT EXISTS `progreso` ( 
				`id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
				PRIMARY KEY (`id`),
				`id_observacion` INT UNSIGNED NULL,
				`estado_seguimiento` INT UNSIGNED NOT NULL,
				`descripcion` TEXT NOT NULL,
				`credo` DATETIME NULL,
				`creado_por` VARCHAR(40) NULL
			) CHARSET utf8",
			$silent
		);
		setupIndexes('progreso', ['id_observacion','estado_seguimiento',]);

		setupTable(
			'tipo_estado_observa', " 
			CREATE TABLE IF NOT EXISTS `tipo_estado_observa` ( 
				`id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
				PRIMARY KEY (`id`),
				`tipo_estado_observa` VARCHAR(40) NULL,
				`descripcion` VARCHAR(40) NULL
			) CHARSET utf8",
			$silent
		);

		setupTable(
			'acceso_remoto', " 
			CREATE TABLE IF NOT EXISTS `acceso_remoto` ( 
				`id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
				PRIMARY KEY (`id`),
				`unidad` INT UNSIGNED NOT NULL,
				`ciudad` INT UNSIGNED NULL,
				`servicio` TEXT NULL,
				`anydesk` VARCHAR(40) NOT NULL,
				UNIQUE `anydesk_unique` (`anydesk`),
				`acceso` VARCHAR(40) NOT NULL,
				`teamviewer` VARCHAR(40) NULL,
				`acceso2` VARCHAR(40) NULL,
				`codigo_equipo` INT UNSIGNED NULL,
				`equipo` INT UNSIGNED NULL,
				`ultima_verifica` DATE NOT NULL,
				`comentario` TEXT NULL,
				`creado` DATETIME NULL,
				`creado_por` VARCHAR(40) NULL,
				`editado` DATETIME NULL,
				`editado_por` VARCHAR(40) NULL
			) CHARSET utf8",
			$silent
		);
		setupIndexes('acceso_remoto', ['unidad','codigo_equipo',]);

		setupTable(
			'tipo_periodicidad', " 
			CREATE TABLE IF NOT EXISTS `tipo_periodicidad` ( 
				`id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
				PRIMARY KEY (`id`),
				`periodicidad` VARCHAR(40) NOT NULL,
				`descripcion` VARCHAR(40) NULL
			) CHARSET utf8",
			$silent
		);

		setupTable(
			'perfil', " 
			CREATE TABLE IF NOT EXISTS `perfil` ( 
				`id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
				PRIMARY KEY (`id`),
				`usuario` VARCHAR(40) NULL,
				`nombre` VARCHAR(40) NOT NULL,
				`apellidos` VARCHAR(40) NOT NULL,
				`tipo_id` INT UNSIGNED NOT NULL,
				`numero_id` VARCHAR(40) NOT NULL,
				UNIQUE `numero_id_unique` (`numero_id`),
				`dato2` VARCHAR(40) NULL,
				`fecha_nacimiento` DATE NOT NULL,
				`telefono` VARCHAR(40) NOT NULL,
				`celular` VARCHAR(40) NOT NULL,
				`rh` INT UNSIGNED NULL,
				`foto_perfil` VARCHAR(40) NULL,
				`estado_civil` VARCHAR(40) NULL,
				`direccion` TEXT NULL,
				`optimo` VARCHAR(40) NULL,
				`creado` DATETIME NULL,
				`creado_por` VARCHAR(40) NULL,
				`grupo` VARCHAR(40) NULL,
				`estado` VARCHAR(40) NULL
			) CHARSET utf8",
			$silent
		);
		setupIndexes('perfil', ['tipo_id','rh',]);

		setupTable(
			'consentimieto', " 
			CREATE TABLE IF NOT EXISTS `consentimieto` ( 
				`id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
				PRIMARY KEY (`id`),
				`id_perfil` INT UNSIGNED NULL,
				`identificacion` INT UNSIGNED NULL,
				`acepto` VARCHAR(40) NOT NULL,
				`creado` DATETIME NULL,
				`creado_por` VARCHAR(40) NULL
			) CHARSET utf8",
			$silent
		);
		setupIndexes('consentimieto', ['id_perfil',]);

		setupTable(
			'perfil_familia', " 
			CREATE TABLE IF NOT EXISTS `perfil_familia` ( 
				`id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
				PRIMARY KEY (`id`),
				`id_perfil` INT UNSIGNED NULL,
				`identificacion` INT UNSIGNED NULL,
				`parentesco` INT UNSIGNED NULL,
				`nombre` VARCHAR(40) NOT NULL,
				`telefono` VARCHAR(40) NOT NULL,
				`direccion` TEXT NULL,
				`creado` DATETIME NULL,
				`creado_por` VARCHAR(40) NULL
			) CHARSET utf8",
			$silent
		);
		setupIndexes('perfil_familia', ['id_perfil','parentesco',]);

		setupTable(
			'perfil_soportes', " 
			CREATE TABLE IF NOT EXISTS `perfil_soportes` ( 
				`id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
				PRIMARY KEY (`id`),
				`id_perfil` INT UNSIGNED NULL,
				`tipo_documento` INT UNSIGNED NULL,
				`nombre_documento` VARCHAR(40) NULL,
				`docuemento` VARCHAR(40) NULL,
				`creado` DATETIME NULL,
				`creado_por` VARCHAR(40) NULL
			) CHARSET utf8",
			$silent
		);
		setupIndexes('perfil_soportes', ['id_perfil','tipo_documento',]);

		setupTable(
			'seguridad_social', " 
			CREATE TABLE IF NOT EXISTS `seguridad_social` ( 
				`id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
				PRIMARY KEY (`id`),
				`id_perfil` INT UNSIGNED NULL,
				`tipo_documento` INT UNSIGNED NULL,
				`docuemento` VARCHAR(40) NULL,
				`descripcion` TEXT NULL,
				`creado` DATETIME NULL,
				`creado_por` VARCHAR(40) NULL
			) CHARSET utf8",
			$silent
		);
		setupIndexes('seguridad_social', ['id_perfil','tipo_documento',]);

		setupTable(
			'costos_mtto', " 
			CREATE TABLE IF NOT EXISTS `costos_mtto` ( 
				`id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
				PRIMARY KEY (`id`),
				`id_mtto` INT UNSIGNED NULL,
				`tipo_costo` INT UNSIGNED NULL,
				`precio` DECIMAL(10,2) NOT NULL,
				`cantidad` INT NOT NULL,
				`descripcion` TEXT NOT NULL,
				`creado` DATETIME NULL,
				`creado_por` VARCHAR(40) NULL
			) CHARSET utf8",
			$silent
		);
		setupIndexes('costos_mtto', ['id_mtto','tipo_costo',]);

		setupTable(
			'tipo_costo', " 
			CREATE TABLE IF NOT EXISTS `tipo_costo` ( 
				`id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
				PRIMARY KEY (`id`),
				`tipo_costo` VARCHAR(40) NOT NULL,
				`descripcion` VARCHAR(40) NULL
			) CHARSET utf8",
			$silent
		);

		setupTable(
			'doc_mtto', " 
			CREATE TABLE IF NOT EXISTS `doc_mtto` ( 
				`id_doc` INT UNSIGNED NOT NULL AUTO_INCREMENT,
				PRIMARY KEY (`id_doc`),
				`doc` TEXT NULL,
				`id_mtto` INT UNSIGNED NULL,
				`tipo_mtto` INT UNSIGNED NULL,
				`mtto` INT UNSIGNED NULL,
				`observaciones` VARCHAR(40) NULL,
				`nombre_biomedico` INT UNSIGNED NULL,
				`registro_invima` INT UNSIGNED NULL,
				`firma_biomedico` INT UNSIGNED NULL,
				`creado` DATETIME NULL,
				`creado_por` VARCHAR(40) NULL
			) CHARSET utf8",
			$silent
		);
		setupIndexes('doc_mtto', ['id_mtto','nombre_biomedico',]);

		setupTable(
			'biomedicos', " 
			CREATE TABLE IF NOT EXISTS `biomedicos` ( 
				`id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
				PRIMARY KEY (`id`),
				`id_contacto` INT UNSIGNED NULL,
				`nombre` INT UNSIGNED NULL,
				`registro_invima` VARCHAR(40) NULL,
				`nota` TEXT NULL,
				`firma` VARCHAR(40) NULL
			) CHARSET utf8",
			$silent
		);
		setupIndexes('biomedicos', ['id_contacto',]);

		setupTable(
			'tipo_clasifica_riesgo', " 
			CREATE TABLE IF NOT EXISTS `tipo_clasifica_riesgo` ( 
				`id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
				PRIMARY KEY (`id`),
				`clase` VARCHAR(40) NOT NULL,
				`nivel_riesgo` VARCHAR(40) NOT NULL,
				`ejemplo` TEXT NULL,
				`nota` VARCHAR(40) NULL
			) CHARSET utf8",
			$silent
		);

		setupTable(
			'programa_mtto', " 
			CREATE TABLE IF NOT EXISTS `programa_mtto` ( 
				`id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
				PRIMARY KEY (`id`),
				`unidad` INT UNSIGNED NULL,
				`ano` INT NULL,
				`descripcion` TEXT NULL,
				`enlace` TEXT NULL,
				`archivo` VARCHAR(40) NULL,
				`creado` DATETIME NULL,
				`creado_por` VARCHAR(40) NULL
			) CHARSET utf8",
			$silent
		);
		setupIndexes('programa_mtto', ['unidad',]);

		setupTable(
			'cronograma_mtto', " 
			CREATE TABLE IF NOT EXISTS `cronograma_mtto` ( 
				`id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
				PRIMARY KEY (`id`),
				`id_programa` INT UNSIGNED NULL,
				`ano` INT UNSIGNED NULL,
				`codigo` INT UNSIGNED NULL,
				`tipo_dispo` INT UNSIGNED NULL,
				`marca` INT UNSIGNED NULL,
				`modelo` INT UNSIGNED NULL,
				`periodicidad` INT UNSIGNED NULL,
				`meses` TEXT NOT NULL,
				`biomedico` VARCHAR(40) NULL,
				`actividades` VARCHAR(40) NULL,
				`creado` DATETIME NULL,
				`creado_por` VARCHAR(40) NULL
			) CHARSET utf8",
			$silent
		);
		setupIndexes('cronograma_mtto', ['id_programa','codigo','marca','periodicidad',]);

		setupTable(
			'compras', " 
			CREATE TABLE IF NOT EXISTS `compras` ( 
				`id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
				PRIMARY KEY (`id`),
				`tipo_compra` INT UNSIGNED NOT NULL,
				`fecha_compra` DATE NOT NULL,
				`comprador` VARCHAR(40) NULL,
				`resumen` TEXT NULL,
				`estado` INT UNSIGNED NULL,
				`creado` DATETIME NULL,
				`creado_por` VARCHAR(40) NULL
			) CHARSET utf8",
			$silent
		);
		setupIndexes('compras', ['tipo_compra','estado',]);

		setupTable(
			'tipo_estado_compra', " 
			CREATE TABLE IF NOT EXISTS `tipo_estado_compra` ( 
				`id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
				PRIMARY KEY (`id`),
				`tipo_estado_compra` VARCHAR(40) NULL,
				`descripcion` VARCHAR(40) NULL
			) CHARSET utf8",
			$silent
		);

		setupTable(
			'cantidad_dispomedico', " 
			CREATE TABLE IF NOT EXISTS `cantidad_dispomedico` ( 
				`id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
				PRIMARY KEY (`id`),
				`nombre_dispo` INT UNSIGNED NOT NULL,
				`serial` INT UNSIGNED NULL,
				`marca_modelo` INT UNSIGNED NULL,
				`descripcion` INT UNSIGNED NULL,
				`uso` TEXT NULL,
				`estado` INT UNSIGNED NULL,
				`id_compra` INT UNSIGNED NULL,
				`creado` DATETIME NULL,
				`creado_por` VARCHAR(40) NULL
			) CHARSET utf8",
			$silent
		);
		setupIndexes('cantidad_dispomedico', ['nombre_dispo','estado','id_compra',]);

		setupTable(
			'cantidad_articulos', " 
			CREATE TABLE IF NOT EXISTS `cantidad_articulos` ( 
				`id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
				PRIMARY KEY (`id`),
				`nombre_articulo` INT UNSIGNED NOT NULL,
				`presentacion` INT UNSIGNED NULL,
				`descripcion` INT UNSIGNED NULL,
				`serial` INT UNSIGNED NULL,
				`cantidad` INT NULL,
				`estado` INT UNSIGNED NULL,
				`id_compras` INT UNSIGNED NULL,
				`creado` DATETIME NULL,
				`tipo_compra` INT UNSIGNED NULL,
				`creado_por` VARCHAR(40) NULL
			) CHARSET utf8",
			$silent
		);
		setupIndexes('cantidad_articulos', ['nombre_articulo','estado','id_compras',]);

		setupTable(
			'cantidad_mobiliario', " 
			CREATE TABLE IF NOT EXISTS `cantidad_mobiliario` ( 
				`id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
				PRIMARY KEY (`id`),
				`nombre_mobiliario` INT UNSIGNED NOT NULL,
				`descripcion` INT UNSIGNED NULL,
				`estado` INT UNSIGNED NULL,
				`id_compra` INT UNSIGNED NULL,
				`creado` DATETIME NULL,
				`creado_por` VARCHAR(40) NULL
			) CHARSET utf8",
			$silent
		);
		setupIndexes('cantidad_mobiliario', ['nombre_mobiliario','estado','id_compra',]);

		setupTable(
			'compra_dispo', " 
			CREATE TABLE IF NOT EXISTS `compra_dispo` ( 
				`id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
				PRIMARY KEY (`id`),
				`foto` INT UNSIGNED NULL,
				`nombre` VARCHAR(40) NULL,
				`serial` VARCHAR(40) NOT NULL,
				UNIQUE `serial_unique` (`serial`),
				`tipo_dispositivo` INT UNSIGNED NOT NULL,
				`marca` INT UNSIGNED NOT NULL,
				`modelo` INT UNSIGNED NOT NULL,
				`caracteristicas` VARCHAR(40) NULL,
				`estado` INT UNSIGNED NOT NULL,
				`riesgo` INT UNSIGNED NULL,
				`precio` DOUBLE(10,2) NULL,
				`creado` DATETIME NULL,
				`creado_por` VARCHAR(40) NULL
			) CHARSET utf8",
			$silent
		);
		setupIndexes('compra_dispo', ['tipo_dispositivo','marca','modelo','estado','riesgo',]);

		setupTable(
			'articulos', " 
			CREATE TABLE IF NOT EXISTS `articulos` ( 
				`id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
				PRIMARY KEY (`id`),
				`nombre_unico` VARCHAR(40) NULL,
				`tipo_dispo` INT UNSIGNED NULL,
				`marca` INT UNSIGNED NULL,
				`modelo` INT UNSIGNED NULL,
				`presentacion` INT UNSIGNED NULL,
				`serial` VARCHAR(40) NULL,
				`referencia` VARCHAR(40) NULL,
				`familia` INT UNSIGNED NULL,
				`codigo_proveedor` INT UNSIGNED NULL,
				`caracteristicas` TEXT NULL,
				`nota` VARCHAR(40) NULL,
				`imagen` INT UNSIGNED NULL,
				`estado` INT UNSIGNED NULL,
				`creado` DATETIME NULL,
				`creado_por` VARCHAR(40) NULL
			) CHARSET utf8",
			$silent
		);
		setupIndexes('articulos', ['tipo_dispo','marca','modelo','presentacion','familia','estado',]);

		setupTable(
			'cofig', " 
			CREATE TABLE IF NOT EXISTS `cofig` ( 
				`id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
				PRIMARY KEY (`id`),
				`dato1` VARCHAR(40) NULL,
				`dato2` VARCHAR(40) NULL,
				`descripcion` TEXT NULL
			) CHARSET utf8",
			$silent
		);

		setupTable(
			'marca_presetacion', " 
			CREATE TABLE IF NOT EXISTS `marca_presetacion` ( 
				`id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
				PRIMARY KEY (`id`),
				`marca` INT UNSIGNED NULL,
				`unidad_medida` INT UNSIGNED NULL,
				`presentacion` VARCHAR(40) NOT NULL
			) CHARSET utf8",
			$silent
		);
		setupIndexes('marca_presetacion', ['marca','unidad_medida',]);

		setupTable(
			'tipo_document_grupo', " 
			CREATE TABLE IF NOT EXISTS `tipo_document_grupo` ( 
				`id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
				PRIMARY KEY (`id`),
				`grupo` VARCHAR(40) NULL,
				`descripcion` VARCHAR(40) NULL
			) CHARSET utf8",
			$silent
		);

		setupTable(
			'tipo_pago', " 
			CREATE TABLE IF NOT EXISTS `tipo_pago` ( 
				`id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
				PRIMARY KEY (`id`),
				`tipo_pago` VARCHAR(40) NULL,
				`descripcion` VARCHAR(40) NULL
			) CHARSET utf8",
			$silent
		);

		setupTable(
			'tipo_compra', " 
			CREATE TABLE IF NOT EXISTS `tipo_compra` ( 
				`id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
				PRIMARY KEY (`id`),
				`tipo_compra` VARCHAR(40) NULL,
				`descripcion` VARCHAR(40) NULL
			) CHARSET utf8",
			$silent
		);

		setupTable(
			'articulos_familia', " 
			CREATE TABLE IF NOT EXISTS `articulos_familia` ( 
				`id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
				PRIMARY KEY (`id`),
				`codigo` VARCHAR(40) NULL,
				`familia` VARCHAR(40) NULL,
				`proveedor` VARCHAR(40) NULL
			) CHARSET utf8",
			$silent
		);

		setupTable(
			'articulo_codigo_proveedor', " 
			CREATE TABLE IF NOT EXISTS `articulo_codigo_proveedor` ( 
				`id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
				PRIMARY KEY (`id`),
				`familia` INT UNSIGNED NULL,
				`codigo` VARCHAR(40) NULL,
				`proveedor` VARCHAR(40) NULL
			) CHARSET utf8",
			$silent
		);
		setupIndexes('articulo_codigo_proveedor', ['familia',]);

		setupTable(
			'tipo_unidad_medida', " 
			CREATE TABLE IF NOT EXISTS `tipo_unidad_medida` ( 
				`id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
				PRIMARY KEY (`id`),
				`unidad` VARCHAR(40) NULL,
				`nota` VARCHAR(40) NULL
			) CHARSET utf8",
			$silent
		);

		setupTable(
			'genera_documentos', " 
			CREATE TABLE IF NOT EXISTS `genera_documentos` ( 
				`id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
				PRIMARY KEY (`id`),
				`tipo_documento_entrega` VARCHAR(40) NULL,
				`ciudad` INT UNSIGNED NULL,
				`fecha` DATE NOT NULL,
				`entidad` INT UNSIGNED NULL,
				`referencia` VARCHAR(40) NULL,
				`descripcion` TEXT NULL,
				`conslusion` TEXT NULL,
				`creado` DATE NULL,
				`creado_por` VARCHAR(40) NULL
			) CHARSET utf8",
			$silent
		);
		setupIndexes('genera_documentos', ['ciudad','entidad',]);

		setupTable(
			'verificacion_articulos', " 
			CREATE TABLE IF NOT EXISTS `verificacion_articulos` ( 
				`id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
				PRIMARY KEY (`id`),
				`codigo` INT UNSIGNED NULL,
				`tipo_dispo` INT UNSIGNED NULL,
				`nombre` INT UNSIGNED NULL,
				`serial` INT UNSIGNED NULL,
				`ubicacion` INT UNSIGNED NOT NULL,
				`abreviado` INT UNSIGNED NULL,
				`verificacion` VARCHAR(40) NOT NULL,
				`comentario` TEXT NULL,
				`fecha_verifi` DATETIME NULL,
				`verifi_por` VARCHAR(40) NULL
			) CHARSET utf8",
			$silent
		);
		setupIndexes('verificacion_articulos', ['codigo','ubicacion',]);

		setupTable(
			'movimientos_articulos', " 
			CREATE TABLE IF NOT EXISTS `movimientos_articulos` ( 
				`id_movi` INT UNSIGNED NOT NULL AUTO_INCREMENT,
				PRIMARY KEY (`id_movi`),
				`img` INT UNSIGNED NULL,
				`tipo_dispo` INT UNSIGNED NULL,
				`nombre` INT UNSIGNED NOT NULL,
				`serial_dispo` INT UNSIGNED NULL,
				`estado_movi` INT UNSIGNED NULL,
				`origen` VARCHAR(40) NULL,
				`destino` VARCHAR(40) NULL,
				`creado` DATETIME NULL,
				`creado_por` VARCHAR(40) NULL,
				`editado` DATETIME NULL,
				`editado_por` VARCHAR(40) NULL
			) CHARSET utf8",
			$silent
		);
		setupIndexes('movimientos_articulos', ['nombre','estado_movi',]);

		setupTable(
			'movi_envio_articulo', " 
			CREATE TABLE IF NOT EXISTS `movi_envio_articulo` ( 
				`id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
				PRIMARY KEY (`id`),
				`id_movi` INT UNSIGNED NULL,
				`fecha_envio` DATE NOT NULL,
				`origen` INT UNSIGNED NULL,
				`ubicacion` INT UNSIGNED NULL,
				`destino` VARCHAR(100) NOT NULL,
				`d_direccion` TEXT NULL,
				`ciudad` INT UNSIGNED NOT NULL,
				`nombre` INT UNSIGNED NOT NULL,
				`telefono` INT UNSIGNED NULL,
				`detalles` TEXT NULL,
				`creado` DATETIME NULL,
				`creado_por` VARCHAR(40) NULL,
				`editado` DATETIME NULL,
				`editado_por` VARCHAR(40) NULL
			) CHARSET utf8",
			$silent
		);
		setupIndexes('movi_envio_articulo', ['id_movi','origen','ciudad','nombre',]);

		setupTable(
			'movi_recepcion_articulos', " 
			CREATE TABLE IF NOT EXISTS `movi_recepcion_articulos` ( 
				`id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
				PRIMARY KEY (`id`),
				`id_movi` INT UNSIGNED NULL,
				`fecha_recepcion` DATE NOT NULL,
				`destino` INT UNSIGNED NOT NULL,
				`o_direccion` INT UNSIGNED NULL,
				`ciudad` INT UNSIGNED NULL,
				`verificado` TEXT NOT NULL,
				`nombre` INT UNSIGNED NOT NULL,
				`telefono` INT UNSIGNED NULL,
				`detalles` TEXT NULL,
				`creado` DATETIME NULL,
				`creado_por` VARCHAR(40) NULL,
				`editado` DATETIME NULL,
				`editado_por` VARCHAR(40) NULL
			) CHARSET utf8",
			$silent
		);
		setupIndexes('movi_recepcion_articulos', ['id_movi','destino','nombre',]);

		setupTable(
			'ubicacion_articulo', " 
			CREATE TABLE IF NOT EXISTS `ubicacion_articulo` ( 
				`id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
				PRIMARY KEY (`id`),
				`id_articulo` INT UNSIGNED NULL,
				`ubicacion` INT UNSIGNED NOT NULL,
				`creado` DATETIME NULL,
				`creado_por` VARCHAR(40) NULL
			) CHARSET utf8",
			$silent
		);
		setupIndexes('ubicacion_articulo', ['id_articulo','ubicacion',]);

		setupTable(
			'ubicacion_mobiliario', " 
			CREATE TABLE IF NOT EXISTS `ubicacion_mobiliario` ( 
				`id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
				PRIMARY KEY (`id`),
				`id_mobiliario` INT UNSIGNED NULL,
				`ubicacion` INT UNSIGNED NOT NULL,
				`creado` DATETIME NULL,
				`creado_por` VARCHAR(40) NULL
			) CHARSET utf8",
			$silent
		);
		setupIndexes('ubicacion_mobiliario', ['id_mobiliario','ubicacion',]);

		setupTable(
			'precio_dispo_medico', " 
			CREATE TABLE IF NOT EXISTS `precio_dispo_medico` ( 
				`id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
				PRIMARY KEY (`id`),
				`dispo_medico` INT UNSIGNED NULL,
				`precio` VARCHAR(40) NULL,
				`proveedor` VARCHAR(40) NULL
			) CHARSET utf8",
			$silent
		);
		setupIndexes('precio_dispo_medico', ['dispo_medico',]);

		setupTable(
			'precio_articulo', " 
			CREATE TABLE IF NOT EXISTS `precio_articulo` ( 
				`id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
				PRIMARY KEY (`id`),
				`articulo` VARCHAR(40) NULL,
				`precio` VARCHAR(40) NULL,
				`proveedor` VARCHAR(40) NULL
			) CHARSET utf8",
			$silent
		);

		setupTable(
			'precio_mobiliario', " 
			CREATE TABLE IF NOT EXISTS `precio_mobiliario` ( 
				`id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
				PRIMARY KEY (`id`),
				`mobiliario` VARCHAR(40) NULL,
				`precio` VARCHAR(40) NULL,
				`proveedor` VARCHAR(40) NULL
			) CHARSET utf8",
			$silent
		);



		// save MD5
		@file_put_contents(dirname(__FILE__) . '/setup.md5', $thisMD5);
	}


	function setupIndexes($tableName, $arrFields) {
		if(!is_array($arrFields) || !count($arrFields)) return false;

		foreach($arrFields as $fieldName) {
			if(!$res = @db_query("SHOW COLUMNS FROM `$tableName` like '$fieldName'")) continue;
			if(!$row = @db_fetch_assoc($res)) continue;
			if($row['Key']) continue;

			@db_query("ALTER TABLE `$tableName` ADD INDEX `$fieldName` (`$fieldName`)");
		}
	}


	function setupTable($tableName, $createSQL = '', $silent = true, $arrAlter = '') {
		global $Translation;
		$oldTableName = '';
		ob_start();

		echo '<div style="padding: 5px; border-bottom:solid 1px silver; font-family: verdana, arial; font-size: 10px;">';

		// is there a table rename query?
		if(is_array($arrAlter)) {
			$matches = [];
			if(preg_match("/ALTER TABLE `(.*)` RENAME `$tableName`/i", $arrAlter[0], $matches)) {
				$oldTableName = $matches[1];
			}
		}

		if($res = @db_query("SELECT COUNT(1) FROM `$tableName`")) { // table already exists
			if($row = @db_fetch_array($res)) {
				echo str_replace(['<TableName>', '<NumRecords>'], [$tableName, $row[0]], $Translation['table exists']);
				if(is_array($arrAlter)) {
					echo '<br>';
					foreach($arrAlter as $alter) {
						if($alter != '') {
							echo "$alter ... ";
							if(!@db_query($alter)) {
								echo '<span class="label label-danger">' . $Translation['failed'] . '</span>';
								echo '<div class="text-danger">' . $Translation['mysql said'] . ' ' . db_error(db_link()) . '</div>';
							} else {
								echo '<span class="label label-success">' . $Translation['ok'] . '</span>';
							}
						}
					}
				} else {
					echo $Translation['table uptodate'];
				}
			} else {
				echo str_replace('<TableName>', $tableName, $Translation['couldnt count']);
			}
		} else { // given tableName doesn't exist

			if($oldTableName != '') { // if we have a table rename query
				if($ro = @db_query("SELECT COUNT(1) FROM `$oldTableName`")) { // if old table exists, rename it.
					$renameQuery = array_shift($arrAlter); // get and remove rename query

					echo "$renameQuery ... ";
					if(!@db_query($renameQuery)) {
						echo '<span class="label label-danger">' . $Translation['failed'] . '</span>';
						echo '<div class="text-danger">' . $Translation['mysql said'] . ' ' . db_error(db_link()) . '</div>';
					} else {
						echo '<span class="label label-success">' . $Translation['ok'] . '</span>';
					}

					if(is_array($arrAlter)) setupTable($tableName, $createSQL, false, $arrAlter); // execute Alter queries on renamed table ...
				} else { // if old tableName doesn't exist (nor the new one since we're here), then just create the table.
					setupTable($tableName, $createSQL, false); // no Alter queries passed ...
				}
			} else { // tableName doesn't exist and no rename, so just create the table
				echo str_replace("<TableName>", $tableName, $Translation["creating table"]);
				if(!@db_query($createSQL)) {
					echo '<span class="label label-danger">' . $Translation['failed'] . '</span>';
					echo '<div class="text-danger">' . $Translation['mysql said'] . db_error(db_link()) . '</div>';
				} else {
					echo '<span class="label label-success">' . $Translation['ok'] . '</span>';
				}
			}
		}

		echo '</div>';

		$out = ob_get_clean();
		if(!$silent) echo $out;
	}
