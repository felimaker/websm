<?php
// This script and data application were generated by AppGini 5.97
// Download AppGini for free from https://bigprof.com/appgini/download/

	$currDir = dirname(__FILE__);
	include_once("$currDir/lib.php");

	handle_maintenance();

	header('Content-type: text/javascript; charset=' . datalist_db_encoding);

	$table_perms = getTablePermissions('financiero_mobiliario');
	if(!$table_perms['access']) die('// Access denied!');

	$mfk = $_GET['mfk'];
	$id = makeSafe($_GET['id']);
	$rnd1 = intval($_GET['rnd1']); if(!$rnd1) $rnd1 = '';

	if(!$mfk) {
		die('// No js code available!');
	}

	switch($mfk) {

		case 'id_dispo':
			if(!$id) {
				?>
				$j('#unidad<?php echo $rnd1; ?>').html('&nbsp;');
				<?php
				break;
			}
			$res = sql("SELECT `mobiliario`.`id_mobiliario` as 'id_mobiliario', `mobiliario`.`codigo` as 'codigo', `mobiliario`.`nombre` as 'nombre', IF(    CHAR_LENGTH(`tipo_grupo_mobilia1`.`grupo`), CONCAT_WS('',   `tipo_grupo_mobilia1`.`grupo`), '') as 'grupo', IF(    CHAR_LENGTH(`tipo_mobiliario1`.`tipo_mobiliario`), CONCAT_WS('',   `tipo_mobiliario1`.`tipo_mobiliario`), '') as 'tipo_mobiliario', `mobiliario`.`descripcion` as 'descripcion', if(`mobiliario`.`fecha_ingreso`,date_format(`mobiliario`.`fecha_ingreso`,'%d/%m/%Y'),'') as 'fecha_ingreso', IF(    CHAR_LENGTH(`unidades1`.`nombre`), CONCAT_WS('',   `unidades1`.`nombre`), '') as 'ubicacion', IF(    CHAR_LENGTH(`unidades1`.`abreviado`), CONCAT_WS('',   `unidades1`.`abreviado`), '') as 'ubicacion_abreviado', `mobiliario`.`accesorios` as 'accesorios', `mobiliario`.`foto` as 'foto', IF(    CHAR_LENGTH(`unidades2`.`nombre`), CONCAT_WS('',   `unidades2`.`nombre`), '') as 'unidad', IF(    CHAR_LENGTH(`unidades1`.`abreviado`), CONCAT_WS('',   `unidades1`.`abreviado`), '') as 'uni_abreviado', if(`mobiliario`.`creado`,date_format(`mobiliario`.`creado`,'%d/%m/%Y %h:%i %p'),'') as 'creado', `mobiliario`.`creado_por` as 'creado_por', `mobiliario`.`editado` as 'editado', `mobiliario`.`editado_por` as 'editado_por', `mobiliario`.`id_compra` as 'id_compra' FROM `mobiliario` LEFT JOIN `tipo_grupo_mobilia` as tipo_grupo_mobilia1 ON `tipo_grupo_mobilia1`.`id_gru_mo`=`mobiliario`.`grupo` LEFT JOIN `tipo_mobiliario` as tipo_mobiliario1 ON `tipo_mobiliario1`.`id`=`mobiliario`.`tipo_mobiliario` LEFT JOIN `unidades` as unidades1 ON `unidades1`.`id_unidades`=`mobiliario`.`ubicacion` LEFT JOIN `unidades` as unidades2 ON `unidades2`.`id_unidades`=`mobiliario`.`unidad`  WHERE `mobiliario`.`id_mobiliario`='{$id}' limit 1", $eo);
			$row = db_fetch_assoc($res);
			?>
			$j('#unidad<?php echo $rnd1; ?>').html('<?php echo addslashes(str_replace(array("\r", "\n"), '', nl2br($row['unidad']))); ?>&nbsp;');
			<?php
			break;


	}

?>