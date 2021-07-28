<?php
	define('PREPEND_PATH', '');
	$app_dir = dirname(__FILE__);
	include_once("{$app_dir}/lib.php");

	// accept a record as an assoc array, return transformed row ready to insert to table
	$transformFunctions = [
		'dispositivos' => function($data, $options = []) {
			if(isset($data['tipo_dispositivo'])) $data['tipo_dispositivo'] = pkGivenLookupText($data['tipo_dispositivo'], 'dispositivos', 'tipo_dispositivo');
			if(isset($data['marca'])) $data['marca'] = pkGivenLookupText($data['marca'], 'dispositivos', 'marca');
			if(isset($data['modelo'])) $data['modelo'] = pkGivenLookupText($data['modelo'], 'dispositivos', 'modelo');
			if(isset($data['ubicacion'])) $data['ubicacion'] = pkGivenLookupText($data['ubicacion'], 'dispositivos', 'ubicacion');
			if(isset($data['fecha_ingreso'])) $data['fecha_ingreso'] = guessMySQLDateTime($data['fecha_ingreso']);
			if(isset($data['clasificacion_riesgo'])) $data['clasificacion_riesgo'] = pkGivenLookupText($data['clasificacion_riesgo'], 'dispositivos', 'clasificacion_riesgo');
			if(isset($data['estado'])) $data['estado'] = pkGivenLookupText($data['estado'], 'dispositivos', 'estado');
			if(isset($data['creado'])) $data['creado'] = guessMySQLDateTime($data['creado']);
			if(isset($data['editado'])) $data['editado'] = guessMySQLDateTime($data['editado']);
			if(isset($data['id_compra_ingreso'])) $data['id_compra_ingreso'] = pkGivenLookupText($data['id_compra_ingreso'], 'dispositivos', 'id_compra_ingreso');
			if(isset($data['foto'])) $data['foto'] = thisOr($data['modelo'], pkGivenLookupText($data['foto'], 'dispositivos', 'foto'));
			if(isset($data['ubicacion_abre'])) $data['ubicacion_abre'] = thisOr($data['ubicacion'], pkGivenLookupText($data['ubicacion_abre'], 'dispositivos', 'ubicacion_abre'));

			return $data;
		},
		'mobiliario' => function($data, $options = []) {
			if(isset($data['grupo'])) $data['grupo'] = pkGivenLookupText($data['grupo'], 'mobiliario', 'grupo');
			if(isset($data['tipo_mobiliario'])) $data['tipo_mobiliario'] = pkGivenLookupText($data['tipo_mobiliario'], 'mobiliario', 'tipo_mobiliario');
			if(isset($data['fecha_ingreso'])) $data['fecha_ingreso'] = guessMySQLDateTime($data['fecha_ingreso']);
			if(isset($data['unidad'])) $data['unidad'] = pkGivenLookupText($data['unidad'], 'mobiliario', 'unidad');
			if(isset($data['creado'])) $data['creado'] = guessMySQLDateTime($data['creado']);
			if(isset($data['uni_abreviado'])) $data['uni_abreviado'] = thisOr($data['unidad'], pkGivenLookupText($data['uni_abreviado'], 'mobiliario', 'uni_abreviado'));

			return $data;
		},
		'contactos' => function($data, $options = []) {
			if(isset($data['tipo_contacto'])) $data['tipo_contacto'] = pkGivenLookupText($data['tipo_contacto'], 'contactos', 'tipo_contacto');
			if(isset($data['tipo_iden'])) $data['tipo_iden'] = pkGivenLookupText($data['tipo_iden'], 'contactos', 'tipo_iden');
			if(isset($data['ciudad'])) $data['ciudad'] = pkGivenLookupText($data['ciudad'], 'contactos', 'ciudad');
			if(isset($data['tipo_relacion'])) $data['tipo_relacion'] = pkGivenLookupText($data['tipo_relacion'], 'contactos', 'tipo_relacion');
			if(isset($data['reg_creado'])) $data['reg_creado'] = guessMySQLDateTime($data['reg_creado']);
			if(isset($data['creado'])) $data['creado'] = guessMySQLDateTime($data['creado']);
			if(isset($data['editado'])) $data['editado'] = guessMySQLDateTime($data['editado']);

			return $data;
		},
		'contactos_tipo_contacto' => function($data, $options = []) {

			return $data;
		},
		'movimientos' => function($data, $options = []) {
			if(isset($data['codigo_dispo'])) $data['codigo_dispo'] = pkGivenLookupText($data['codigo_dispo'], 'movimientos', 'codigo_dispo');
			if(isset($data['estado_movi'])) $data['estado_movi'] = pkGivenLookupText($data['estado_movi'], 'movimientos', 'estado_movi');
			if(isset($data['creado'])) $data['creado'] = guessMySQLDateTime($data['creado']);
			if(isset($data['editado'])) $data['editado'] = guessMySQLDateTime($data['editado']);
			if(isset($data['tipo_dispo'])) $data['tipo_dispo'] = thisOr($data['codigo_dispo'], pkGivenLookupText($data['tipo_dispo'], 'movimientos', 'tipo_dispo'));
			if(isset($data['serial_dispo'])) $data['serial_dispo'] = thisOr($data['codigo_dispo'], pkGivenLookupText($data['serial_dispo'], 'movimientos', 'serial_dispo'));

			return $data;
		},
		'documentos' => function($data, $options = []) {
			if(isset($data['dispo_codigo'])) $data['dispo_codigo'] = pkGivenLookupText($data['dispo_codigo'], 'documentos', 'dispo_codigo');
			if(isset($data['tipo_docu'])) $data['tipo_docu'] = pkGivenLookupText($data['tipo_docu'], 'documentos', 'tipo_docu');
			if(isset($data['creado'])) $data['creado'] = guessMySQLDateTime($data['creado']);
			if(isset($data['editado'])) $data['editado'] = guessMySQLDateTime($data['editado']);
			if(isset($data['dispo_serial'])) $data['dispo_serial'] = thisOr($data['dispo_codigo'], pkGivenLookupText($data['dispo_serial'], 'documentos', 'dispo_serial'));

			return $data;
		},
		'mantenimientos' => function($data, $options = []) {
			if(isset($data['codigo'])) $data['codigo'] = pkGivenLookupText($data['codigo'], 'mantenimientos', 'codigo');
			if(isset($data['fecha_mtto'])) $data['fecha_mtto'] = guessMySQLDateTime($data['fecha_mtto']);
			if(isset($data['tipo_mtto'])) $data['tipo_mtto'] = pkGivenLookupText($data['tipo_mtto'], 'mantenimientos', 'tipo_mtto');
			if(isset($data['responsable'])) $data['responsable'] = pkGivenLookupText($data['responsable'], 'mantenimientos', 'responsable');
			if(isset($data['unidad'])) $data['unidad'] = pkGivenLookupText($data['unidad'], 'mantenimientos', 'unidad');
			if(isset($data['estado_final'])) $data['estado_final'] = pkGivenLookupText($data['estado_final'], 'mantenimientos', 'estado_final');
			if(isset($data['creado'])) $data['creado'] = guessMySQLDateTime($data['creado']);
			if(isset($data['editado'])) $data['editado'] = guessMySQLDateTime($data['editado']);
			if(isset($data['serial'])) $data['serial'] = thisOr($data['codigo'], pkGivenLookupText($data['serial'], 'mantenimientos', 'serial'));
			if(isset($data['tipo_dispo'])) $data['tipo_dispo'] = thisOr($data['codigo'], pkGivenLookupText($data['tipo_dispo'], 'mantenimientos', 'tipo_dispo'));
			if(isset($data['id_responsable'])) $data['id_responsable'] = thisOr($data['responsable'], pkGivenLookupText($data['id_responsable'], 'mantenimientos', 'id_responsable'));
			if(isset($data['unidad_abreviado'])) $data['unidad_abreviado'] = thisOr($data['unidad'], pkGivenLookupText($data['unidad_abreviado'], 'mantenimientos', 'unidad_abreviado'));

			return $data;
		},
		'calibraciones' => function($data, $options = []) {
			if(isset($data['codigo'])) $data['codigo'] = pkGivenLookupText($data['codigo'], 'calibraciones', 'codigo');
			if(isset($data['tipo_calibracion'])) $data['tipo_calibracion'] = pkGivenLookupText($data['tipo_calibracion'], 'calibraciones', 'tipo_calibracion');
			if(isset($data['fecha_calibra'])) $data['fecha_calibra'] = guessMySQLDateTime($data['fecha_calibra']);
			if(isset($data['fecha_expiracion'])) $data['fecha_expiracion'] = guessMySQLDateTime($data['fecha_expiracion']);
			if(isset($data['empresa'])) $data['empresa'] = pkGivenLookupText($data['empresa'], 'calibraciones', 'empresa');
			if(isset($data['creado'])) $data['creado'] = guessMySQLDateTime($data['creado']);
			if(isset($data['editado'])) $data['editado'] = guessMySQLDateTime($data['editado']);
			if(isset($data['serial'])) $data['serial'] = thisOr($data['codigo'], pkGivenLookupText($data['serial'], 'calibraciones', 'serial'));
			if(isset($data['telefono'])) $data['telefono'] = thisOr($data['empresa'], pkGivenLookupText($data['telefono'], 'calibraciones', 'telefono'));

			return $data;
		},
		'unidades' => function($data, $options = []) {
			if(isset($data['ciudad'])) $data['ciudad'] = pkGivenLookupText($data['ciudad'], 'unidades', 'ciudad');
			if(isset($data['prestador'])) $data['prestador'] = pkGivenLookupText($data['prestador'], 'unidades', 'prestador');

			return $data;
		},
		'marcas' => function($data, $options = []) {

			return $data;
		},
		'marca_modelo' => function($data, $options = []) {
			if(isset($data['marca'])) $data['marca'] = pkGivenLookupText($data['marca'], 'marca_modelo', 'marca');
			if(isset($data['creado'])) $data['creado'] = guessMySQLDateTime($data['creado']);

			return $data;
		},
		'accesorios' => function($data, $options = []) {
			if(isset($data['tipo_accesorio'])) $data['tipo_accesorio'] = pkGivenLookupText($data['tipo_accesorio'], 'accesorios', 'tipo_accesorio');
			if(isset($data['id_dispo'])) $data['id_dispo'] = pkGivenLookupText($data['id_dispo'], 'accesorios', 'id_dispo');
			if(isset($data['creado'])) $data['creado'] = guessMySQLDateTime($data['creado']);

			return $data;
		},
		'ciudades' => function($data, $options = []) {

			return $data;
		},
		'verificacion' => function($data, $options = []) {
			if(isset($data['codigo'])) $data['codigo'] = pkGivenLookupText($data['codigo'], 'verificacion', 'codigo');
			if(isset($data['ubicacion'])) $data['ubicacion'] = pkGivenLookupText($data['ubicacion'], 'verificacion', 'ubicacion');
			if(isset($data['fecha_verifi'])) $data['fecha_verifi'] = guessMySQLDateTime($data['fecha_verifi']);
			if(isset($data['tipo_dispo'])) $data['tipo_dispo'] = thisOr($data['codigo'], pkGivenLookupText($data['tipo_dispo'], 'verificacion', 'tipo_dispo'));
			if(isset($data['serial'])) $data['serial'] = thisOr($data['codigo'], pkGivenLookupText($data['serial'], 'verificacion', 'serial'));
			if(isset($data['abreviado'])) $data['abreviado'] = thisOr($data['ubicacion'], pkGivenLookupText($data['abreviado'], 'verificacion', 'abreviado'));

			return $data;
		},
		'hojadevida' => function($data, $options = []) {
			if(isset($data['dispo_codigo'])) $data['dispo_codigo'] = pkGivenLookupText($data['dispo_codigo'], 'hojadevida', 'dispo_codigo');
			if(isset($data['creado'])) $data['creado'] = guessMySQLDateTime($data['creado']);
			if(isset($data['editado'])) $data['editado'] = guessMySQLDateTime($data['editado']);
			if(isset($data['dispo_serial'])) $data['dispo_serial'] = thisOr($data['dispo_codigo'], pkGivenLookupText($data['dispo_serial'], 'hojadevida', 'dispo_serial'));

			return $data;
		},
		'financiero' => function($data, $options = []) {
			if(isset($data['id_dispo'])) $data['id_dispo'] = pkGivenLookupText($data['id_dispo'], 'financiero', 'id_dispo');
			if(isset($data['creado'])) $data['creado'] = guessMySQLDateTime($data['creado']);
			if(isset($data['editado'])) $data['editado'] = guessMySQLDateTime($data['editado']);
			if(isset($data['unidad'])) $data['unidad'] = thisOr($data['id_dispo'], pkGivenLookupText($data['unidad'], 'financiero', 'unidad'));

			return $data;
		},
		'financiero_mobiliario' => function($data, $options = []) {
			if(isset($data['id_dispo'])) $data['id_dispo'] = pkGivenLookupText($data['id_dispo'], 'financiero_mobiliario', 'id_dispo');
			if(isset($data['creado'])) $data['creado'] = guessMySQLDateTime($data['creado']);
			if(isset($data['editado'])) $data['editado'] = guessMySQLDateTime($data['editado']);
			if(isset($data['unidad'])) $data['unidad'] = thisOr($data['id_dispo'], pkGivenLookupText($data['unidad'], 'financiero_mobiliario', 'unidad'));

			return $data;
		},
		'prestador' => function($data, $options = []) {
			if(isset($data['razon_social'])) $data['razon_social'] = pkGivenLookupText($data['razon_social'], 'prestador', 'razon_social');
			if(isset($data['nit'])) $data['nit'] = thisOr($data['razon_social'], pkGivenLookupText($data['nit'], 'prestador', 'nit'));

			return $data;
		},
		'docu_modelo' => function($data, $options = []) {
			if(isset($data['tipo_dispo'])) $data['tipo_dispo'] = pkGivenLookupText($data['tipo_dispo'], 'docu_modelo', 'tipo_dispo');
			if(isset($data['marca'])) $data['marca'] = pkGivenLookupText($data['marca'], 'docu_modelo', 'marca');
			if(isset($data['modelo'])) $data['modelo'] = pkGivenLookupText($data['modelo'], 'docu_modelo', 'modelo');
			if(isset($data['tipo_documento'])) $data['tipo_documento'] = pkGivenLookupText($data['tipo_documento'], 'docu_modelo', 'tipo_documento');
			if(isset($data['creado'])) $data['creado'] = guessMySQLDateTime($data['creado']);
			if(isset($data['editado'])) $data['editado'] = guessMySQLDateTime($data['editado']);

			return $data;
		},
		'facturas' => function($data, $options = []) {
			if(isset($data['id_dispo'])) $data['id_dispo'] = pkGivenLookupText($data['id_dispo'], 'facturas', 'id_dispo');
			if(isset($data['proveedor'])) $data['proveedor'] = pkGivenLookupText($data['proveedor'], 'facturas', 'proveedor');
			if(isset($data['creado'])) $data['creado'] = guessMySQLDateTime($data['creado']);
			if(isset($data['editado'])) $data['editado'] = guessMySQLDateTime($data['editado']);
			if(isset($data['id_compras'])) $data['id_compras'] = pkGivenLookupText($data['id_compras'], 'facturas', 'id_compras');
			if(isset($data['identificacion'])) $data['identificacion'] = thisOr($data['proveedor'], pkGivenLookupText($data['identificacion'], 'facturas', 'identificacion'));

			return $data;
		},
		'formatos' => function($data, $options = []) {
			if(isset($data['tipo_formato'])) $data['tipo_formato'] = pkGivenLookupText($data['tipo_formato'], 'formatos', 'tipo_formato');
			if(isset($data['tipo_dispositivo'])) $data['tipo_dispositivo'] = pkGivenLookupText($data['tipo_dispositivo'], 'formatos', 'tipo_dispositivo');
			if(isset($data['creado'])) $data['creado'] = guessMySQLDateTime($data['creado']);

			return $data;
		},
		'dispo_fuera' => function($data, $options = []) {
			if(isset($data['codigo'])) $data['codigo'] = pkGivenLookupText($data['codigo'], 'dispo_fuera', 'codigo');
			if(isset($data['tipo_fuera_servicio'])) $data['tipo_fuera_servicio'] = pkGivenLookupText($data['tipo_fuera_servicio'], 'dispo_fuera', 'tipo_fuera_servicio');
			if(isset($data['fecha_reporte'])) $data['fecha_reporte'] = guessMySQLDateTime($data['fecha_reporte']);
			if(isset($data['creado'])) $data['creado'] = guessMySQLDateTime($data['creado']);
			if(isset($data['editado'])) $data['editado'] = guessMySQLDateTime($data['editado']);
			if(isset($data['img'])) $data['img'] = thisOr($data['codigo'], pkGivenLookupText($data['img'], 'dispo_fuera', 'img'));
			if(isset($data['serial'])) $data['serial'] = thisOr($data['codigo'], pkGivenLookupText($data['serial'], 'dispo_fuera', 'serial'));
			if(isset($data['ubicacion_final'])) $data['ubicacion_final'] = thisOr($data['codigo'], pkGivenLookupText($data['ubicacion_final'], 'dispo_fuera', 'ubicacion_final'));

			return $data;
		},
		'dispositivo_tipo_grupo' => function($data, $options = []) {

			return $data;
		},
		'tipo_relacion' => function($data, $options = []) {
			if(isset($data['creado'])) $data['creado'] = guessMySQLDateTime($data['creado']);

			return $data;
		},
		'tipo_dispositivo' => function($data, $options = []) {
			if(isset($data['grupo_dispo'])) $data['grupo_dispo'] = pkGivenLookupText($data['grupo_dispo'], 'tipo_dispositivo', 'grupo_dispo');

			return $data;
		},
		'tipo_documento' => function($data, $options = []) {
			if(isset($data['grupo'])) $data['grupo'] = pkGivenLookupText($data['grupo'], 'tipo_documento', 'grupo');

			return $data;
		},
		'tipo_iden' => function($data, $options = []) {

			return $data;
		},
		'tipo_razon_social' => function($data, $options = []) {

			return $data;
		},
		'tipo_mobiliario' => function($data, $options = []) {
			if(isset($data['grupo_mobi'])) $data['grupo_mobi'] = pkGivenLookupText($data['grupo_mobi'], 'tipo_mobiliario', 'grupo_mobi');

			return $data;
		},
		'tipo_grupo_mobilia' => function($data, $options = []) {

			return $data;
		},
		'tipo_estado_dispo' => function($data, $options = []) {

			return $data;
		},
		'tipo_movimiento' => function($data, $options = []) {

			return $data;
		},
		'tipo_estado_movi' => function($data, $options = []) {

			return $data;
		},
		'tipo_estado_verifica' => function($data, $options = []) {

			return $data;
		},
		'tipo_mtto' => function($data, $options = []) {

			return $data;
		},
		'tipo_calibracion' => function($data, $options = []) {

			return $data;
		},
		'tipo_accesorio' => function($data, $options = []) {

			return $data;
		},
		'tipo_formatos' => function($data, $options = []) {

			return $data;
		},
		'dispo_detalles_tecnicos' => function($data, $options = []) {
			if(isset($data['id_dispo'])) $data['id_dispo'] = pkGivenLookupText($data['id_dispo'], 'dispo_detalles_tecnicos', 'id_dispo');
			if(isset($data['creado'])) $data['creado'] = guessMySQLDateTime($data['creado']);

			return $data;
		},
		'tipo_estado_observaciones' => function($data, $options = []) {

			return $data;
		},
		'movi_envio' => function($data, $options = []) {
			if(isset($data['id_movi'])) $data['id_movi'] = pkGivenLookupText($data['id_movi'], 'movi_envio', 'id_movi');
			if(isset($data['fecha_envio'])) $data['fecha_envio'] = guessMySQLDateTime($data['fecha_envio']);
			if(isset($data['origen'])) $data['origen'] = pkGivenLookupText($data['origen'], 'movi_envio', 'origen');
			if(isset($data['ciudad'])) $data['ciudad'] = pkGivenLookupText($data['ciudad'], 'movi_envio', 'ciudad');
			if(isset($data['nombre'])) $data['nombre'] = pkGivenLookupText($data['nombre'], 'movi_envio', 'nombre');
			if(isset($data['creado'])) $data['creado'] = guessMySQLDateTime($data['creado']);
			if(isset($data['editado'])) $data['editado'] = guessMySQLDateTime($data['editado']);
			if(isset($data['ubicacion'])) $data['ubicacion'] = thisOr($data['origen'], pkGivenLookupText($data['ubicacion'], 'movi_envio', 'ubicacion'));
			if(isset($data['telefono'])) $data['telefono'] = thisOr($data['nombre'], pkGivenLookupText($data['telefono'], 'movi_envio', 'telefono'));

			return $data;
		},
		'movi_recepcion' => function($data, $options = []) {
			if(isset($data['id_movi'])) $data['id_movi'] = pkGivenLookupText($data['id_movi'], 'movi_recepcion', 'id_movi');
			if(isset($data['fecha_recepcion'])) $data['fecha_recepcion'] = guessMySQLDateTime($data['fecha_recepcion']);
			if(isset($data['destino'])) $data['destino'] = pkGivenLookupText($data['destino'], 'movi_recepcion', 'destino');
			if(isset($data['nombre'])) $data['nombre'] = pkGivenLookupText($data['nombre'], 'movi_recepcion', 'nombre');
			if(isset($data['creado'])) $data['creado'] = guessMySQLDateTime($data['creado']);
			if(isset($data['editado'])) $data['editado'] = guessMySQLDateTime($data['editado']);
			if(isset($data['o_direccion'])) $data['o_direccion'] = thisOr($data['destino'], pkGivenLookupText($data['o_direccion'], 'movi_recepcion', 'o_direccion'));
			if(isset($data['ciudad'])) $data['ciudad'] = thisOr($data['destino'], pkGivenLookupText($data['ciudad'], 'movi_recepcion', 'ciudad'));
			if(isset($data['telefono'])) $data['telefono'] = thisOr($data['nombre'], pkGivenLookupText($data['telefono'], 'movi_recepcion', 'telefono'));

			return $data;
		},
		'tipo_fuera_servicio' => function($data, $options = []) {

			return $data;
		},
		'tipo_documento_ss' => function($data, $options = []) {

			return $data;
		},
		'tipo_parentesco' => function($data, $options = []) {

			return $data;
		},
		'tipo_rh' => function($data, $options = []) {

			return $data;
		},
		'accesorio_dispo_relacion' => function($data, $options = []) {
			if(isset($data['id_dispo'])) $data['id_dispo'] = pkGivenLookupText($data['id_dispo'], 'accesorio_dispo_relacion', 'id_dispo');
			if(isset($data['id_accesorio'])) $data['id_accesorio'] = pkGivenLookupText($data['id_accesorio'], 'accesorio_dispo_relacion', 'id_accesorio');
			if(isset($data['creado'])) $data['creado'] = guessMySQLDateTime($data['creado']);
			if(isset($data['tipo_dispo'])) $data['tipo_dispo'] = thisOr($data['id_dispo'], pkGivenLookupText($data['tipo_dispo'], 'accesorio_dispo_relacion', 'tipo_dispo'));
			if(isset($data['serial'])) $data['serial'] = thisOr($data['id_dispo'], pkGivenLookupText($data['serial'], 'accesorio_dispo_relacion', 'serial'));
			if(isset($data['marca_modelo'])) $data['marca_modelo'] = thisOr($data['id_dispo'], pkGivenLookupText($data['marca_modelo'], 'accesorio_dispo_relacion', 'marca_modelo'));

			return $data;
		},
		'observaciones' => function($data, $options = []) {
			if(isset($data['estado_observacion'])) $data['estado_observacion'] = pkGivenLookupText($data['estado_observacion'], 'observaciones', 'estado_observacion');
			if(isset($data['estado'])) $data['estado'] = pkGivenLookupText($data['estado'], 'observaciones', 'estado');
			if(isset($data['codigo'])) $data['codigo'] = pkGivenLookupText($data['codigo'], 'observaciones', 'codigo');
			if(isset($data['unidad'])) $data['unidad'] = pkGivenLookupText($data['unidad'], 'observaciones', 'unidad');
			if(isset($data['creado'])) $data['creado'] = guessMySQLDateTime($data['creado']);
			if(isset($data['tipo_dispo'])) $data['tipo_dispo'] = thisOr($data['codigo'], pkGivenLookupText($data['tipo_dispo'], 'observaciones', 'tipo_dispo'));
			if(isset($data['serial'])) $data['serial'] = thisOr($data['codigo'], pkGivenLookupText($data['serial'], 'observaciones', 'serial'));

			return $data;
		},
		'foto_observacion' => function($data, $options = []) {
			if(isset($data['id_observacion'])) $data['id_observacion'] = pkGivenLookupText($data['id_observacion'], 'foto_observacion', 'id_observacion');
			if(isset($data['creado'])) $data['creado'] = guessMySQLDateTime($data['creado']);

			return $data;
		},
		'progreso' => function($data, $options = []) {
			if(isset($data['id_observacion'])) $data['id_observacion'] = pkGivenLookupText($data['id_observacion'], 'progreso', 'id_observacion');
			if(isset($data['estado_seguimiento'])) $data['estado_seguimiento'] = pkGivenLookupText($data['estado_seguimiento'], 'progreso', 'estado_seguimiento');
			if(isset($data['credo'])) $data['credo'] = guessMySQLDateTime($data['credo']);

			return $data;
		},
		'tipo_estado_observa' => function($data, $options = []) {

			return $data;
		},
		'acceso_remoto' => function($data, $options = []) {
			if(isset($data['unidad'])) $data['unidad'] = pkGivenLookupText($data['unidad'], 'acceso_remoto', 'unidad');
			if(isset($data['codigo_equipo'])) $data['codigo_equipo'] = pkGivenLookupText($data['codigo_equipo'], 'acceso_remoto', 'codigo_equipo');
			if(isset($data['ultima_verifica'])) $data['ultima_verifica'] = guessMySQLDateTime($data['ultima_verifica']);
			if(isset($data['creado'])) $data['creado'] = guessMySQLDateTime($data['creado']);
			if(isset($data['editado'])) $data['editado'] = guessMySQLDateTime($data['editado']);
			if(isset($data['ciudad'])) $data['ciudad'] = thisOr($data['unidad'], pkGivenLookupText($data['ciudad'], 'acceso_remoto', 'ciudad'));
			if(isset($data['equipo'])) $data['equipo'] = thisOr($data['codigo_equipo'], pkGivenLookupText($data['equipo'], 'acceso_remoto', 'equipo'));

			return $data;
		},
		'tipo_periodicidad' => function($data, $options = []) {

			return $data;
		},
		'perfil' => function($data, $options = []) {
			if(isset($data['tipo_id'])) $data['tipo_id'] = pkGivenLookupText($data['tipo_id'], 'perfil', 'tipo_id');
			if(isset($data['fecha_nacimiento'])) $data['fecha_nacimiento'] = guessMySQLDateTime($data['fecha_nacimiento']);
			if(isset($data['rh'])) $data['rh'] = pkGivenLookupText($data['rh'], 'perfil', 'rh');
			if(isset($data['creado'])) $data['creado'] = guessMySQLDateTime($data['creado']);

			return $data;
		},
		'consentimieto' => function($data, $options = []) {
			if(isset($data['id_perfil'])) $data['id_perfil'] = pkGivenLookupText($data['id_perfil'], 'consentimieto', 'id_perfil');
			if(isset($data['creado'])) $data['creado'] = guessMySQLDateTime($data['creado']);
			if(isset($data['identificacion'])) $data['identificacion'] = thisOr($data['id_perfil'], pkGivenLookupText($data['identificacion'], 'consentimieto', 'identificacion'));

			return $data;
		},
		'perfil_familia' => function($data, $options = []) {
			if(isset($data['id_perfil'])) $data['id_perfil'] = pkGivenLookupText($data['id_perfil'], 'perfil_familia', 'id_perfil');
			if(isset($data['parentesco'])) $data['parentesco'] = pkGivenLookupText($data['parentesco'], 'perfil_familia', 'parentesco');
			if(isset($data['creado'])) $data['creado'] = guessMySQLDateTime($data['creado']);
			if(isset($data['identificacion'])) $data['identificacion'] = thisOr($data['id_perfil'], pkGivenLookupText($data['identificacion'], 'perfil_familia', 'identificacion'));

			return $data;
		},
		'perfil_soportes' => function($data, $options = []) {
			if(isset($data['id_perfil'])) $data['id_perfil'] = pkGivenLookupText($data['id_perfil'], 'perfil_soportes', 'id_perfil');
			if(isset($data['tipo_documento'])) $data['tipo_documento'] = pkGivenLookupText($data['tipo_documento'], 'perfil_soportes', 'tipo_documento');
			if(isset($data['creado'])) $data['creado'] = guessMySQLDateTime($data['creado']);

			return $data;
		},
		'seguridad_social' => function($data, $options = []) {
			if(isset($data['id_perfil'])) $data['id_perfil'] = pkGivenLookupText($data['id_perfil'], 'seguridad_social', 'id_perfil');
			if(isset($data['tipo_documento'])) $data['tipo_documento'] = pkGivenLookupText($data['tipo_documento'], 'seguridad_social', 'tipo_documento');
			if(isset($data['creado'])) $data['creado'] = guessMySQLDateTime($data['creado']);

			return $data;
		},
		'costos_mtto' => function($data, $options = []) {
			if(isset($data['id_mtto'])) $data['id_mtto'] = pkGivenLookupText($data['id_mtto'], 'costos_mtto', 'id_mtto');
			if(isset($data['tipo_costo'])) $data['tipo_costo'] = pkGivenLookupText($data['tipo_costo'], 'costos_mtto', 'tipo_costo');
			if(isset($data['creado'])) $data['creado'] = guessMySQLDateTime($data['creado']);

			return $data;
		},
		'tipo_costo' => function($data, $options = []) {

			return $data;
		},
		'doc_mtto' => function($data, $options = []) {
			if(isset($data['id_mtto'])) $data['id_mtto'] = pkGivenLookupText($data['id_mtto'], 'doc_mtto', 'id_mtto');
			if(isset($data['nombre_biomedico'])) $data['nombre_biomedico'] = pkGivenLookupText($data['nombre_biomedico'], 'doc_mtto', 'nombre_biomedico');
			if(isset($data['creado'])) $data['creado'] = guessMySQLDateTime($data['creado']);
			if(isset($data['tipo_mtto'])) $data['tipo_mtto'] = thisOr($data['id_mtto'], pkGivenLookupText($data['tipo_mtto'], 'doc_mtto', 'tipo_mtto'));
			if(isset($data['mtto'])) $data['mtto'] = thisOr($data['id_mtto'], pkGivenLookupText($data['mtto'], 'doc_mtto', 'mtto'));
			if(isset($data['registro_invima'])) $data['registro_invima'] = thisOr($data['nombre_biomedico'], pkGivenLookupText($data['registro_invima'], 'doc_mtto', 'registro_invima'));
			if(isset($data['firma_biomedico'])) $data['firma_biomedico'] = thisOr($data['nombre_biomedico'], pkGivenLookupText($data['firma_biomedico'], 'doc_mtto', 'firma_biomedico'));

			return $data;
		},
		'biomedicos' => function($data, $options = []) {
			if(isset($data['id_contacto'])) $data['id_contacto'] = pkGivenLookupText($data['id_contacto'], 'biomedicos', 'id_contacto');
			if(isset($data['nombre'])) $data['nombre'] = thisOr($data['id_contacto'], pkGivenLookupText($data['nombre'], 'biomedicos', 'nombre'));

			return $data;
		},
		'tipo_clasifica_riesgo' => function($data, $options = []) {

			return $data;
		},
		'programa_mtto' => function($data, $options = []) {
			if(isset($data['unidad'])) $data['unidad'] = pkGivenLookupText($data['unidad'], 'programa_mtto', 'unidad');
			if(isset($data['creado'])) $data['creado'] = guessMySQLDateTime($data['creado']);

			return $data;
		},
		'cronograma_mtto' => function($data, $options = []) {
			if(isset($data['id_programa'])) $data['id_programa'] = pkGivenLookupText($data['id_programa'], 'cronograma_mtto', 'id_programa');
			if(isset($data['codigo'])) $data['codigo'] = pkGivenLookupText($data['codigo'], 'cronograma_mtto', 'codigo');
			if(isset($data['marca'])) $data['marca'] = pkGivenLookupText($data['marca'], 'cronograma_mtto', 'marca');
			if(isset($data['periodicidad'])) $data['periodicidad'] = pkGivenLookupText($data['periodicidad'], 'cronograma_mtto', 'periodicidad');
			if(isset($data['creado'])) $data['creado'] = guessMySQLDateTime($data['creado']);
			if(isset($data['ano'])) $data['ano'] = thisOr($data['id_programa'], pkGivenLookupText($data['ano'], 'cronograma_mtto', 'ano'));
			if(isset($data['tipo_dispo'])) $data['tipo_dispo'] = thisOr($data['codigo'], pkGivenLookupText($data['tipo_dispo'], 'cronograma_mtto', 'tipo_dispo'));
			if(isset($data['modelo'])) $data['modelo'] = thisOr($data['codigo'], pkGivenLookupText($data['modelo'], 'cronograma_mtto', 'modelo'));

			return $data;
		},
		'compras' => function($data, $options = []) {
			if(isset($data['tipo_compra'])) $data['tipo_compra'] = pkGivenLookupText($data['tipo_compra'], 'compras', 'tipo_compra');
			if(isset($data['fecha_compra'])) $data['fecha_compra'] = guessMySQLDateTime($data['fecha_compra']);
			if(isset($data['estado'])) $data['estado'] = pkGivenLookupText($data['estado'], 'compras', 'estado');
			if(isset($data['creado'])) $data['creado'] = guessMySQLDateTime($data['creado']);

			return $data;
		},
		'tipo_estado_compra' => function($data, $options = []) {

			return $data;
		},
		'cantidad_dispomedico' => function($data, $options = []) {
			if(isset($data['nombre_dispo'])) $data['nombre_dispo'] = pkGivenLookupText($data['nombre_dispo'], 'cantidad_dispomedico', 'nombre_dispo');
			if(isset($data['estado'])) $data['estado'] = pkGivenLookupText($data['estado'], 'cantidad_dispomedico', 'estado');
			if(isset($data['id_compra'])) $data['id_compra'] = pkGivenLookupText($data['id_compra'], 'cantidad_dispomedico', 'id_compra');
			if(isset($data['creado'])) $data['creado'] = guessMySQLDateTime($data['creado']);
			if(isset($data['serial'])) $data['serial'] = thisOr($data['nombre_dispo'], pkGivenLookupText($data['serial'], 'cantidad_dispomedico', 'serial'));
			if(isset($data['marca_modelo'])) $data['marca_modelo'] = thisOr($data['nombre_dispo'], pkGivenLookupText($data['marca_modelo'], 'cantidad_dispomedico', 'marca_modelo'));
			if(isset($data['descripcion'])) $data['descripcion'] = thisOr($data['nombre_dispo'], pkGivenLookupText($data['descripcion'], 'cantidad_dispomedico', 'descripcion'));

			return $data;
		},
		'cantidad_articulos' => function($data, $options = []) {
			if(isset($data['nombre_articulo'])) $data['nombre_articulo'] = pkGivenLookupText($data['nombre_articulo'], 'cantidad_articulos', 'nombre_articulo');
			if(isset($data['estado'])) $data['estado'] = pkGivenLookupText($data['estado'], 'cantidad_articulos', 'estado');
			if(isset($data['id_compras'])) $data['id_compras'] = pkGivenLookupText($data['id_compras'], 'cantidad_articulos', 'id_compras');
			if(isset($data['creado'])) $data['creado'] = guessMySQLDateTime($data['creado']);
			if(isset($data['presentacion'])) $data['presentacion'] = thisOr($data['nombre_articulo'], pkGivenLookupText($data['presentacion'], 'cantidad_articulos', 'presentacion'));
			if(isset($data['descripcion'])) $data['descripcion'] = thisOr($data['nombre_articulo'], pkGivenLookupText($data['descripcion'], 'cantidad_articulos', 'descripcion'));
			if(isset($data['serial'])) $data['serial'] = thisOr($data['nombre_articulo'], pkGivenLookupText($data['serial'], 'cantidad_articulos', 'serial'));
			if(isset($data['tipo_compra'])) $data['tipo_compra'] = thisOr($data['id_compras'], pkGivenLookupText($data['tipo_compra'], 'cantidad_articulos', 'tipo_compra'));

			return $data;
		},
		'cantidad_mobiliario' => function($data, $options = []) {
			if(isset($data['nombre_mobiliario'])) $data['nombre_mobiliario'] = pkGivenLookupText($data['nombre_mobiliario'], 'cantidad_mobiliario', 'nombre_mobiliario');
			if(isset($data['estado'])) $data['estado'] = pkGivenLookupText($data['estado'], 'cantidad_mobiliario', 'estado');
			if(isset($data['id_compra'])) $data['id_compra'] = pkGivenLookupText($data['id_compra'], 'cantidad_mobiliario', 'id_compra');
			if(isset($data['creado'])) $data['creado'] = guessMySQLDateTime($data['creado']);
			if(isset($data['descripcion'])) $data['descripcion'] = thisOr($data['nombre_mobiliario'], pkGivenLookupText($data['descripcion'], 'cantidad_mobiliario', 'descripcion'));

			return $data;
		},
		'compra_dispo' => function($data, $options = []) {
			if(isset($data['tipo_dispositivo'])) $data['tipo_dispositivo'] = pkGivenLookupText($data['tipo_dispositivo'], 'compra_dispo', 'tipo_dispositivo');
			if(isset($data['marca'])) $data['marca'] = pkGivenLookupText($data['marca'], 'compra_dispo', 'marca');
			if(isset($data['modelo'])) $data['modelo'] = pkGivenLookupText($data['modelo'], 'compra_dispo', 'modelo');
			if(isset($data['estado'])) $data['estado'] = pkGivenLookupText($data['estado'], 'compra_dispo', 'estado');
			if(isset($data['riesgo'])) $data['riesgo'] = pkGivenLookupText($data['riesgo'], 'compra_dispo', 'riesgo');
			if(isset($data['creado'])) $data['creado'] = guessMySQLDateTime($data['creado']);
			if(isset($data['foto'])) $data['foto'] = thisOr($data['modelo'], pkGivenLookupText($data['foto'], 'compra_dispo', 'foto'));

			return $data;
		},
		'articulos' => function($data, $options = []) {
			if(isset($data['tipo_dispo'])) $data['tipo_dispo'] = pkGivenLookupText($data['tipo_dispo'], 'articulos', 'tipo_dispo');
			if(isset($data['marca'])) $data['marca'] = pkGivenLookupText($data['marca'], 'articulos', 'marca');
			if(isset($data['modelo'])) $data['modelo'] = pkGivenLookupText($data['modelo'], 'articulos', 'modelo');
			if(isset($data['presentacion'])) $data['presentacion'] = pkGivenLookupText($data['presentacion'], 'articulos', 'presentacion');
			if(isset($data['familia'])) $data['familia'] = pkGivenLookupText($data['familia'], 'articulos', 'familia');
			if(isset($data['estado'])) $data['estado'] = pkGivenLookupText($data['estado'], 'articulos', 'estado');
			if(isset($data['creado'])) $data['creado'] = guessMySQLDateTime($data['creado']);
			if(isset($data['codigo_proveedor'])) $data['codigo_proveedor'] = thisOr($data['familia'], pkGivenLookupText($data['codigo_proveedor'], 'articulos', 'codigo_proveedor'));
			if(isset($data['imagen'])) $data['imagen'] = thisOr($data['modelo'], pkGivenLookupText($data['imagen'], 'articulos', 'imagen'));

			return $data;
		},
		'cofig' => function($data, $options = []) {

			return $data;
		},
		'marca_presetacion' => function($data, $options = []) {
			if(isset($data['marca'])) $data['marca'] = pkGivenLookupText($data['marca'], 'marca_presetacion', 'marca');
			if(isset($data['unidad_medida'])) $data['unidad_medida'] = pkGivenLookupText($data['unidad_medida'], 'marca_presetacion', 'unidad_medida');

			return $data;
		},
		'tipo_document_grupo' => function($data, $options = []) {

			return $data;
		},
		'tipo_pago' => function($data, $options = []) {

			return $data;
		},
		'tipo_compra' => function($data, $options = []) {

			return $data;
		},
		'articulos_familia' => function($data, $options = []) {

			return $data;
		},
		'articulo_codigo_proveedor' => function($data, $options = []) {
			if(isset($data['familia'])) $data['familia'] = pkGivenLookupText($data['familia'], 'articulo_codigo_proveedor', 'familia');

			return $data;
		},
		'tipo_unidad_medida' => function($data, $options = []) {

			return $data;
		},
		'genera_documentos' => function($data, $options = []) {
			if(isset($data['ciudad'])) $data['ciudad'] = pkGivenLookupText($data['ciudad'], 'genera_documentos', 'ciudad');
			if(isset($data['fecha'])) $data['fecha'] = guessMySQLDateTime($data['fecha']);
			if(isset($data['entidad'])) $data['entidad'] = pkGivenLookupText($data['entidad'], 'genera_documentos', 'entidad');
			if(isset($data['creado'])) $data['creado'] = guessMySQLDateTime($data['creado']);

			return $data;
		},
		'verificacion_articulos' => function($data, $options = []) {
			if(isset($data['codigo'])) $data['codigo'] = pkGivenLookupText($data['codigo'], 'verificacion_articulos', 'codigo');
			if(isset($data['ubicacion'])) $data['ubicacion'] = pkGivenLookupText($data['ubicacion'], 'verificacion_articulos', 'ubicacion');
			if(isset($data['fecha_verifi'])) $data['fecha_verifi'] = guessMySQLDateTime($data['fecha_verifi']);
			if(isset($data['tipo_dispo'])) $data['tipo_dispo'] = thisOr($data['codigo'], pkGivenLookupText($data['tipo_dispo'], 'verificacion_articulos', 'tipo_dispo'));
			if(isset($data['nombre'])) $data['nombre'] = thisOr($data['codigo'], pkGivenLookupText($data['nombre'], 'verificacion_articulos', 'nombre'));
			if(isset($data['serial'])) $data['serial'] = thisOr($data['codigo'], pkGivenLookupText($data['serial'], 'verificacion_articulos', 'serial'));
			if(isset($data['abreviado'])) $data['abreviado'] = thisOr($data['ubicacion'], pkGivenLookupText($data['abreviado'], 'verificacion_articulos', 'abreviado'));

			return $data;
		},
		'movimientos_articulos' => function($data, $options = []) {
			if(isset($data['nombre'])) $data['nombre'] = pkGivenLookupText($data['nombre'], 'movimientos_articulos', 'nombre');
			if(isset($data['estado_movi'])) $data['estado_movi'] = pkGivenLookupText($data['estado_movi'], 'movimientos_articulos', 'estado_movi');
			if(isset($data['creado'])) $data['creado'] = guessMySQLDateTime($data['creado']);
			if(isset($data['editado'])) $data['editado'] = guessMySQLDateTime($data['editado']);
			if(isset($data['tipo_dispo'])) $data['tipo_dispo'] = thisOr($data['nombre'], pkGivenLookupText($data['tipo_dispo'], 'movimientos_articulos', 'tipo_dispo'));
			if(isset($data['serial_dispo'])) $data['serial_dispo'] = thisOr($data['nombre'], pkGivenLookupText($data['serial_dispo'], 'movimientos_articulos', 'serial_dispo'));

			return $data;
		},
		'movi_envio_articulo' => function($data, $options = []) {
			if(isset($data['id_movi'])) $data['id_movi'] = pkGivenLookupText($data['id_movi'], 'movi_envio_articulo', 'id_movi');
			if(isset($data['fecha_envio'])) $data['fecha_envio'] = guessMySQLDateTime($data['fecha_envio']);
			if(isset($data['origen'])) $data['origen'] = pkGivenLookupText($data['origen'], 'movi_envio_articulo', 'origen');
			if(isset($data['ciudad'])) $data['ciudad'] = pkGivenLookupText($data['ciudad'], 'movi_envio_articulo', 'ciudad');
			if(isset($data['nombre'])) $data['nombre'] = pkGivenLookupText($data['nombre'], 'movi_envio_articulo', 'nombre');
			if(isset($data['creado'])) $data['creado'] = guessMySQLDateTime($data['creado']);
			if(isset($data['editado'])) $data['editado'] = guessMySQLDateTime($data['editado']);
			if(isset($data['ubicacion'])) $data['ubicacion'] = thisOr($data['origen'], pkGivenLookupText($data['ubicacion'], 'movi_envio_articulo', 'ubicacion'));
			if(isset($data['telefono'])) $data['telefono'] = thisOr($data['nombre'], pkGivenLookupText($data['telefono'], 'movi_envio_articulo', 'telefono'));

			return $data;
		},
		'movi_recepcion_articulos' => function($data, $options = []) {
			if(isset($data['id_movi'])) $data['id_movi'] = pkGivenLookupText($data['id_movi'], 'movi_recepcion_articulos', 'id_movi');
			if(isset($data['fecha_recepcion'])) $data['fecha_recepcion'] = guessMySQLDateTime($data['fecha_recepcion']);
			if(isset($data['destino'])) $data['destino'] = pkGivenLookupText($data['destino'], 'movi_recepcion_articulos', 'destino');
			if(isset($data['nombre'])) $data['nombre'] = pkGivenLookupText($data['nombre'], 'movi_recepcion_articulos', 'nombre');
			if(isset($data['creado'])) $data['creado'] = guessMySQLDateTime($data['creado']);
			if(isset($data['editado'])) $data['editado'] = guessMySQLDateTime($data['editado']);
			if(isset($data['o_direccion'])) $data['o_direccion'] = thisOr($data['destino'], pkGivenLookupText($data['o_direccion'], 'movi_recepcion_articulos', 'o_direccion'));
			if(isset($data['ciudad'])) $data['ciudad'] = thisOr($data['destino'], pkGivenLookupText($data['ciudad'], 'movi_recepcion_articulos', 'ciudad'));
			if(isset($data['telefono'])) $data['telefono'] = thisOr($data['nombre'], pkGivenLookupText($data['telefono'], 'movi_recepcion_articulos', 'telefono'));

			return $data;
		},
		'ubicacion_articulo' => function($data, $options = []) {
			if(isset($data['id_articulo'])) $data['id_articulo'] = pkGivenLookupText($data['id_articulo'], 'ubicacion_articulo', 'id_articulo');
			if(isset($data['ubicacion'])) $data['ubicacion'] = pkGivenLookupText($data['ubicacion'], 'ubicacion_articulo', 'ubicacion');
			if(isset($data['creado'])) $data['creado'] = guessMySQLDateTime($data['creado']);

			return $data;
		},
		'ubicacion_mobiliario' => function($data, $options = []) {
			if(isset($data['id_mobiliario'])) $data['id_mobiliario'] = pkGivenLookupText($data['id_mobiliario'], 'ubicacion_mobiliario', 'id_mobiliario');
			if(isset($data['ubicacion'])) $data['ubicacion'] = pkGivenLookupText($data['ubicacion'], 'ubicacion_mobiliario', 'ubicacion');
			if(isset($data['creado'])) $data['creado'] = guessMySQLDateTime($data['creado']);

			return $data;
		},
		'precio_dispo_medico' => function($data, $options = []) {
			if(isset($data['dispo_medico'])) $data['dispo_medico'] = pkGivenLookupText($data['dispo_medico'], 'precio_dispo_medico', 'dispo_medico');

			return $data;
		},
		'precio_articulo' => function($data, $options = []) {

			return $data;
		},
		'precio_mobiliario' => function($data, $options = []) {

			return $data;
		},
	];

	// accept a record as an assoc array, return a boolean indicating whether to import or skip record
	$filterFunctions = [
		'dispositivos' => function($data, $options = []) { return true; },
		'mobiliario' => function($data, $options = []) { return true; },
		'contactos' => function($data, $options = []) { return true; },
		'contactos_tipo_contacto' => function($data, $options = []) { return true; },
		'movimientos' => function($data, $options = []) { return true; },
		'documentos' => function($data, $options = []) { return true; },
		'mantenimientos' => function($data, $options = []) { return true; },
		'calibraciones' => function($data, $options = []) { return true; },
		'unidades' => function($data, $options = []) { return true; },
		'marcas' => function($data, $options = []) { return true; },
		'marca_modelo' => function($data, $options = []) { return true; },
		'accesorios' => function($data, $options = []) { return true; },
		'ciudades' => function($data, $options = []) { return true; },
		'verificacion' => function($data, $options = []) { return true; },
		'hojadevida' => function($data, $options = []) { return true; },
		'financiero' => function($data, $options = []) { return true; },
		'financiero_mobiliario' => function($data, $options = []) { return true; },
		'prestador' => function($data, $options = []) { return true; },
		'docu_modelo' => function($data, $options = []) { return true; },
		'facturas' => function($data, $options = []) { return true; },
		'formatos' => function($data, $options = []) { return true; },
		'dispo_fuera' => function($data, $options = []) { return true; },
		'dispositivo_tipo_grupo' => function($data, $options = []) { return true; },
		'tipo_relacion' => function($data, $options = []) { return true; },
		'tipo_dispositivo' => function($data, $options = []) { return true; },
		'tipo_documento' => function($data, $options = []) { return true; },
		'tipo_iden' => function($data, $options = []) { return true; },
		'tipo_razon_social' => function($data, $options = []) { return true; },
		'tipo_mobiliario' => function($data, $options = []) { return true; },
		'tipo_grupo_mobilia' => function($data, $options = []) { return true; },
		'tipo_estado_dispo' => function($data, $options = []) { return true; },
		'tipo_movimiento' => function($data, $options = []) { return true; },
		'tipo_estado_movi' => function($data, $options = []) { return true; },
		'tipo_estado_verifica' => function($data, $options = []) { return true; },
		'tipo_mtto' => function($data, $options = []) { return true; },
		'tipo_calibracion' => function($data, $options = []) { return true; },
		'tipo_accesorio' => function($data, $options = []) { return true; },
		'tipo_formatos' => function($data, $options = []) { return true; },
		'dispo_detalles_tecnicos' => function($data, $options = []) { return true; },
		'tipo_estado_observaciones' => function($data, $options = []) { return true; },
		'movi_envio' => function($data, $options = []) { return true; },
		'movi_recepcion' => function($data, $options = []) { return true; },
		'tipo_fuera_servicio' => function($data, $options = []) { return true; },
		'tipo_documento_ss' => function($data, $options = []) { return true; },
		'tipo_parentesco' => function($data, $options = []) { return true; },
		'tipo_rh' => function($data, $options = []) { return true; },
		'accesorio_dispo_relacion' => function($data, $options = []) { return true; },
		'observaciones' => function($data, $options = []) { return true; },
		'foto_observacion' => function($data, $options = []) { return true; },
		'progreso' => function($data, $options = []) { return true; },
		'tipo_estado_observa' => function($data, $options = []) { return true; },
		'acceso_remoto' => function($data, $options = []) { return true; },
		'tipo_periodicidad' => function($data, $options = []) { return true; },
		'perfil' => function($data, $options = []) { return true; },
		'consentimieto' => function($data, $options = []) { return true; },
		'perfil_familia' => function($data, $options = []) { return true; },
		'perfil_soportes' => function($data, $options = []) { return true; },
		'seguridad_social' => function($data, $options = []) { return true; },
		'costos_mtto' => function($data, $options = []) { return true; },
		'tipo_costo' => function($data, $options = []) { return true; },
		'doc_mtto' => function($data, $options = []) { return true; },
		'biomedicos' => function($data, $options = []) { return true; },
		'tipo_clasifica_riesgo' => function($data, $options = []) { return true; },
		'programa_mtto' => function($data, $options = []) { return true; },
		'cronograma_mtto' => function($data, $options = []) { return true; },
		'compras' => function($data, $options = []) { return true; },
		'tipo_estado_compra' => function($data, $options = []) { return true; },
		'cantidad_dispomedico' => function($data, $options = []) { return true; },
		'cantidad_articulos' => function($data, $options = []) { return true; },
		'cantidad_mobiliario' => function($data, $options = []) { return true; },
		'compra_dispo' => function($data, $options = []) { return true; },
		'articulos' => function($data, $options = []) { return true; },
		'cofig' => function($data, $options = []) { return true; },
		'marca_presetacion' => function($data, $options = []) { return true; },
		'tipo_document_grupo' => function($data, $options = []) { return true; },
		'tipo_pago' => function($data, $options = []) { return true; },
		'tipo_compra' => function($data, $options = []) { return true; },
		'articulos_familia' => function($data, $options = []) { return true; },
		'articulo_codigo_proveedor' => function($data, $options = []) { return true; },
		'tipo_unidad_medida' => function($data, $options = []) { return true; },
		'genera_documentos' => function($data, $options = []) { return true; },
		'verificacion_articulos' => function($data, $options = []) { return true; },
		'movimientos_articulos' => function($data, $options = []) { return true; },
		'movi_envio_articulo' => function($data, $options = []) { return true; },
		'movi_recepcion_articulos' => function($data, $options = []) { return true; },
		'ubicacion_articulo' => function($data, $options = []) { return true; },
		'ubicacion_mobiliario' => function($data, $options = []) { return true; },
		'precio_dispo_medico' => function($data, $options = []) { return true; },
		'precio_articulo' => function($data, $options = []) { return true; },
		'precio_mobiliario' => function($data, $options = []) { return true; },
	];

	/*
	Hook file for overwriting/amending $transformFunctions and $filterFunctions:
	hooks/import-csv.php
	If found, it's included below

	The way this works is by either completely overwriting any of the above 2 arrays,
	or, more commonly, overwriting a single function, for example:
		$transformFunctions['tablename'] = function($data, $options = []) {
			// new definition here
			// then you must return transformed data
			return $data;
		};

	Another scenario is transforming a specific field and leaving other fields to the default
	transformation. One possible way of doing this is to store the original transformation function
	in GLOBALS array, calling it inside the custom transformation function, then modifying the
	specific field:
		$GLOBALS['originalTransformationFunction'] = $transformFunctions['tablename'];
		$transformFunctions['tablename'] = function($data, $options = []) {
			$data = call_user_func_array($GLOBALS['originalTransformationFunction'], [$data, $options]);
			$data['fieldname'] = 'transformed value';
			return $data;
		};
	*/

	@include("{$app_dir}/hooks/import-csv.php");

	$ui = new CSVImportUI($transformFunctions, $filterFunctions);
