<?php
// This script and data application were generated by AppGini 5.97
// Download AppGini for free from https://bigprof.com/appgini/download/

	$currDir = dirname(__FILE__);
	include_once("$currDir/lib.php");

	handle_maintenance();

	header('Content-type: text/javascript; charset=' . datalist_db_encoding);

	$table_perms = getTablePermissions('dispo_fuera');
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
				$j('#img<?php echo $rnd1; ?>').html('&nbsp;');
				$j('#serial<?php echo $rnd1; ?>').html('&nbsp;');
				$j('#ubicacion_final<?php echo $rnd1; ?>').html('&nbsp;');
				<?php
				break;
			}
			$res = sql("SELECT `dispositivos`.`codigo` as 'codigo', `dispositivos`.`id_dispo` as 'id_dispo', IF(    CHAR_LENGTH(`marca_modelo1`.`img`), CONCAT_WS('',   `marca_modelo1`.`img`), '') as 'foto', `dispositivos`.`code` as 'code', `dispositivos`.`serial` as 'serial', IF(    CHAR_LENGTH(`tipo_dispositivo1`.`tipo_dispositivo`), CONCAT_WS('',   `tipo_dispositivo1`.`tipo_dispositivo`), '') as 'tipo_dispositivo', IF(    CHAR_LENGTH(`marcas1`.`marca`), CONCAT_WS('',   `marcas1`.`marca`), '') as 'marca', IF(    CHAR_LENGTH(`marca_modelo1`.`modelo`), CONCAT_WS('',   `marca_modelo1`.`modelo`), '') as 'modelo', IF(    CHAR_LENGTH(`unidades1`.`nombre`), CONCAT_WS('',   `unidades1`.`nombre`), '') as 'ubicacion', IF(    CHAR_LENGTH(`unidades1`.`abreviado`) || CHAR_LENGTH(`ciudades1`.`ciudad`), CONCAT_WS('',   `unidades1`.`abreviado`, ' - ', `ciudades1`.`ciudad`), '') as 'ubicacion_abre', if(`dispositivos`.`fecha_ingreso`,date_format(`dispositivos`.`fecha_ingreso`,'%d/%m/%Y'),'') as 'fecha_ingreso', IF(    CHAR_LENGTH(`tipo_clasifica_riesgo1`.`clase`), CONCAT_WS('',   `tipo_clasifica_riesgo1`.`clase`), '') as 'clasificacion_riesgo', IF(    CHAR_LENGTH(`tipo_estado_dispo1`.`estado_dispo`), CONCAT_WS('',   `tipo_estado_dispo1`.`estado_dispo`), '') as 'estado', `dispositivos`.`precio` as 'precio', if(`dispositivos`.`creado`,date_format(`dispositivos`.`creado`,'%d/%m/%Y %h:%i %p'),'') as 'creado', `dispositivos`.`creado_por` as 'creado_por', if(`dispositivos`.`editado`,date_format(`dispositivos`.`editado`,'%d/%m/%Y %h:%i %p'),'') as 'editado', `dispositivos`.`editado_por` as 'editado_por', IF(    CHAR_LENGTH(`compra_dispo1`.`id`), CONCAT_WS('',   `compra_dispo1`.`id`), '') as 'id_compra_ingreso' FROM `dispositivos` LEFT JOIN `tipo_dispositivo` as tipo_dispositivo1 ON `tipo_dispositivo1`.`id_tipodispo`=`dispositivos`.`tipo_dispositivo` LEFT JOIN `marcas` as marcas1 ON `marcas1`.`id_marca`=`dispositivos`.`marca` LEFT JOIN `marca_modelo` as marca_modelo1 ON `marca_modelo1`.`id_mmodelo`=`dispositivos`.`modelo` LEFT JOIN `unidades` as unidades1 ON `unidades1`.`id_unidades`=`dispositivos`.`ubicacion` LEFT JOIN `tipo_clasifica_riesgo` as tipo_clasifica_riesgo1 ON `tipo_clasifica_riesgo1`.`id`=`dispositivos`.`clasificacion_riesgo` LEFT JOIN `tipo_estado_dispo` as tipo_estado_dispo1 ON `tipo_estado_dispo1`.`id`=`dispositivos`.`estado` LEFT JOIN `compra_dispo` as compra_dispo1 ON `compra_dispo1`.`id`=`dispositivos`.`id_compra_ingreso` LEFT JOIN `ciudades` as ciudades1 ON `ciudades1`.`id_ciudad`=`unidades1`.`ciudad`  WHERE `dispositivos`.`id_dispo`='{$id}' limit 1", $eo);
			$row = db_fetch_assoc($res);
			?>
			$j('#img<?php echo $rnd1; ?>').html('<?php echo addslashes(str_replace(array("\r", "\n"), '', nl2br($row['foto']))); ?>&nbsp;');
			$j('#serial<?php echo $rnd1; ?>').html('<?php echo addslashes(str_replace(array("\r", "\n"), '', nl2br($row['serial']))); ?>&nbsp;');
			$j('#ubicacion_final<?php echo $rnd1; ?>').html('<?php echo addslashes(str_replace(array("\r", "\n"), '', nl2br($row['ubicacion_abre'].' | '.$row['ubicacion']))); ?>&nbsp;');
			<?php
			break;


	}

?>