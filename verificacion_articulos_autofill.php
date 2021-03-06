<?php
// This script and data application were generated by AppGini 5.97
// Download AppGini for free from https://bigprof.com/appgini/download/

	$currDir = dirname(__FILE__);
	include_once("$currDir/lib.php");

	handle_maintenance();

	header('Content-type: text/javascript; charset=' . datalist_db_encoding);

	$table_perms = getTablePermissions('verificacion_articulos');
	if(!$table_perms['access']) die('// Access denied!');

	$mfk = $_GET['mfk'];
	$id = makeSafe($_GET['id']);
	$rnd1 = intval($_GET['rnd1']); if(!$rnd1) $rnd1 = '';

	if(!$mfk) {
		die('// No js code available!');
	}

	switch($mfk) {

		case 'codigo':
			if(!$id) {
				?>
				$j('#tipo_dispo<?php echo $rnd1; ?>').html('&nbsp;');
				$j('#nombre<?php echo $rnd1; ?>').html('&nbsp;');
				$j('#serial<?php echo $rnd1; ?>').html('&nbsp;');
				<?php
				break;
			}
			$res = sql("SELECT `articulos`.`id` as 'id', `articulos`.`codigo` as 'codigo', `articulos`.`nombre_unico` as 'nombre_unico', IF(    CHAR_LENGTH(`tipo_dispositivo1`.`tipo_dispositivo`), CONCAT_WS('',   `tipo_dispositivo1`.`tipo_dispositivo`), '') as 'tipo_dispo', IF(    CHAR_LENGTH(`marcas1`.`marca`), CONCAT_WS('',   `marcas1`.`marca`), '') as 'marca', IF(    CHAR_LENGTH(`marca_modelo1`.`modelo`), CONCAT_WS('',   `marca_modelo1`.`modelo`), '') as 'modelo', IF(    CHAR_LENGTH(`marca_presetacion1`.`presentacion`) || CHAR_LENGTH(`tipo_unidad_medida1`.`unidad`), CONCAT_WS('',   `marca_presetacion1`.`presentacion`, ' ', `tipo_unidad_medida1`.`unidad`), '') as 'presentacion', `articulos`.`serial` as 'serial', `articulos`.`referencia` as 'referencia', IF(    CHAR_LENGTH(`articulos_familia1`.`familia`) || CHAR_LENGTH(`articulos_familia1`.`familia`), CONCAT_WS('',   `articulos_familia1`.`familia`, '-', `articulos_familia1`.`familia`), '') as 'familia', IF(    CHAR_LENGTH(`articulos_familia1`.`codigo`) || CHAR_LENGTH(`articulos_familia1`.`proveedor`), CONCAT_WS('',   `articulos_familia1`.`codigo`, '-', `articulos_familia1`.`proveedor`), '') as 'codigo_proveedor', `articulos`.`caracteristicas` as 'caracteristicas', `articulos`.`nota` as 'nota', IF(    CHAR_LENGTH(`unidades1`.`nombre`), CONCAT_WS('',   `unidades1`.`nombre`), '') as 'ubicacion', IF(    CHAR_LENGTH(`unidades1`.`abreviado`), CONCAT_WS('',   `unidades1`.`abreviado`), '') as 'ubicacion_abreviado', IF(    CHAR_LENGTH(`marca_modelo1`.`img`), CONCAT_WS('',   `marca_modelo1`.`img`), '') as 'imagen', IF(    CHAR_LENGTH(`tipo_estado_dispo1`.`estado_dispo`), CONCAT_WS('',   `tipo_estado_dispo1`.`estado_dispo`), '') as 'estado', if(`articulos`.`creado`,date_format(`articulos`.`creado`,'%d/%m/%Y %h:%i %p'),'') as 'creado', `articulos`.`creado_por` as 'creado_por' FROM `articulos` LEFT JOIN `tipo_dispositivo` as tipo_dispositivo1 ON `tipo_dispositivo1`.`id_tipodispo`=`articulos`.`tipo_dispo` LEFT JOIN `marcas` as marcas1 ON `marcas1`.`id_marca`=`articulos`.`marca` LEFT JOIN `marca_modelo` as marca_modelo1 ON `marca_modelo1`.`id_mmodelo`=`articulos`.`modelo` LEFT JOIN `marca_presetacion` as marca_presetacion1 ON `marca_presetacion1`.`id`=`articulos`.`presentacion` LEFT JOIN `tipo_unidad_medida` as tipo_unidad_medida1 ON `tipo_unidad_medida1`.`id`=`marca_presetacion1`.`unidad_medida` LEFT JOIN `articulos_familia` as articulos_familia1 ON `articulos_familia1`.`id`=`articulos`.`familia` LEFT JOIN `unidades` as unidades1 ON `unidades1`.`id_unidades`=`articulos`.`ubicacion` LEFT JOIN `tipo_estado_dispo` as tipo_estado_dispo1 ON `tipo_estado_dispo1`.`id`=`articulos`.`estado`  WHERE `articulos`.`id`='{$id}' limit 1", $eo);
			$row = db_fetch_assoc($res);
			?>
			$j('#tipo_dispo<?php echo $rnd1; ?>').html('<?php echo addslashes(str_replace(array("\r", "\n"), '', nl2br($row['tipo_dispo']))); ?>&nbsp;');
			$j('#nombre<?php echo $rnd1; ?>').html('<?php echo addslashes(str_replace(array("\r", "\n"), '', nl2br($row['nombre_unico']))); ?>&nbsp;');
			$j('#serial<?php echo $rnd1; ?>').html('<?php echo addslashes(str_replace(array("\r", "\n"), '', nl2br($row['serial']))); ?>&nbsp;');
			<?php
			break;

		case 'ubicacion':
			if(!$id) {
				?>
				$j('#abreviado<?php echo $rnd1; ?>').html('&nbsp;');
				<?php
				break;
			}
			$res = sql("SELECT `unidades`.`id_unidades` as 'id_unidades', `unidades`.`nombre` as 'nombre', `unidades`.`abreviado` as 'abreviado', IF(    CHAR_LENGTH(`ciudades1`.`ciudad`), CONCAT_WS('',   `ciudades1`.`ciudad`), '') as 'ciudad', `unidades`.`telefono` as 'telefono', `unidades`.`direccion` as 'direccion', `unidades`.`ubicacion` as 'ubicacion', IF(    CHAR_LENGTH(`prestador1`.`nombre`) || CHAR_LENGTH(`prestador1`.`nit`), CONCAT_WS('',   `prestador1`.`nombre`, ' | ', `prestador1`.`nit`), '') as 'prestador', `unidades`.`logo` as 'logo', `unidades`.`dispositivos_costo` as 'dispositivos_costo', `unidades`.`mobiliario_costo` as 'mobiliario_costo', `unidades`.`costo_total` as 'costo_total' FROM `unidades` LEFT JOIN `ciudades` as ciudades1 ON `ciudades1`.`id_ciudad`=`unidades`.`ciudad` LEFT JOIN `prestador` as prestador1 ON `prestador1`.`id`=`unidades`.`prestador`  WHERE `unidades`.`id_unidades`='{$id}' limit 1", $eo);
			$row = db_fetch_assoc($res);
			?>
			$j('#abreviado<?php echo $rnd1; ?>').html('<?php echo addslashes(str_replace(array("\r", "\n"), '', nl2br($row['abreviado'].' - '.$row['ciudad']))); ?>&nbsp;');
			<?php
			break;


	}

?>