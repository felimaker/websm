<?php
// This script and data application were generated by AppGini 5.97
// Download AppGini for free from https://bigprof.com/appgini/download/

	$currDir = dirname(__FILE__);
	include_once("$currDir/lib.php");

	handle_maintenance();

	header('Content-type: text/javascript; charset=' . datalist_db_encoding);

	$table_perms = getTablePermissions('doc_mtto');
	if(!$table_perms['access']) die('// Access denied!');

	$mfk = $_GET['mfk'];
	$id = makeSafe($_GET['id']);
	$rnd1 = intval($_GET['rnd1']); if(!$rnd1) $rnd1 = '';

	if(!$mfk) {
		die('// No js code available!');
	}

	switch($mfk) {

		case 'id_mtto':
			if(!$id) {
				?>
				$j('#tipo_mtto<?php echo $rnd1; ?>').html('&nbsp;');
				$j('#mtto<?php echo $rnd1; ?>').html('&nbsp;');
				<?php
				break;
			}
			$res = sql("SELECT `mantenimientos`.`id_mtto` as 'id_mtto', IF(    CHAR_LENGTH(`dispositivos1`.`code`), CONCAT_WS('',   `dispositivos1`.`code`), '') as 'codigo', IF(    CHAR_LENGTH(`dispositivos1`.`serial`), CONCAT_WS('',   `dispositivos1`.`serial`), '') as 'serial', IF(    CHAR_LENGTH(`tipo_dispositivo1`.`tipo_dispositivo`), CONCAT_WS('',   `tipo_dispositivo1`.`tipo_dispositivo`), '') as 'tipo_dispo', if(`mantenimientos`.`fecha_mtto`,date_format(`mantenimientos`.`fecha_mtto`,'%d/%m/%Y'),'') as 'fecha_mtto', IF(    CHAR_LENGTH(`tipo_mtto1`.`tipo_mtto`), CONCAT_WS('',   `tipo_mtto1`.`tipo_mtto`), '') as 'tipo_mtto', IF(    CHAR_LENGTH(`contactos1`.`nombre`), CONCAT_WS('',   `contactos1`.`nombre`), '') as 'responsable', IF(    CHAR_LENGTH(`contactos1`.`identificacion`), CONCAT_WS('',   `contactos1`.`identificacion`), '') as 'id_responsable', `mantenimientos`.`documento` as 'documento', `mantenimientos`.`documento_drive` as 'documento_drive', IF(    CHAR_LENGTH(`unidades1`.`nombre`), CONCAT_WS('',   `unidades1`.`nombre`), '') as 'unidad', IF(    CHAR_LENGTH(`unidades1`.`abreviado`) || CHAR_LENGTH(`ciudades1`.`ciudad`), CONCAT_WS('',   `unidades1`.`abreviado`, ' - ', `ciudades1`.`ciudad`), '') as 'unidad_abreviado', `mantenimientos`.`descripcion` as 'descripcion', IF(    CHAR_LENGTH(`tipo_estado_dispo1`.`estado_dispo`), CONCAT_WS('',   `tipo_estado_dispo1`.`estado_dispo`), '') as 'estado_final', `mantenimientos`.`creado_por` as 'creado_por', `mantenimientos`.`editado_por` as 'editado_por', if(`mantenimientos`.`creado`,date_format(`mantenimientos`.`creado`,'%d/%m/%Y %h:%i %p'),'') as 'creado', if(`mantenimientos`.`editado`,date_format(`mantenimientos`.`editado`,'%d/%m/%Y %h:%i %p'),'') as 'editado' FROM `mantenimientos` LEFT JOIN `dispositivos` as dispositivos1 ON `dispositivos1`.`id_dispo`=`mantenimientos`.`codigo` LEFT JOIN `tipo_mtto` as tipo_mtto1 ON `tipo_mtto1`.`id`=`mantenimientos`.`tipo_mtto` LEFT JOIN `contactos` as contactos1 ON `contactos1`.`id_contactos`=`mantenimientos`.`responsable` LEFT JOIN `unidades` as unidades1 ON `unidades1`.`id_unidades`=`mantenimientos`.`unidad` LEFT JOIN `tipo_estado_dispo` as tipo_estado_dispo1 ON `tipo_estado_dispo1`.`id`=`mantenimientos`.`estado_final` LEFT JOIN `tipo_dispositivo` as tipo_dispositivo1 ON `tipo_dispositivo1`.`id_tipodispo`=`dispositivos1`.`tipo_dispositivo` LEFT JOIN `ciudades` as ciudades1 ON `ciudades1`.`id_ciudad`=`unidades1`.`ciudad`  WHERE `mantenimientos`.`id_mtto`='{$id}' limit 1", $eo);
			$row = db_fetch_assoc($res);
			?>
			$j('#tipo_mtto<?php echo $rnd1; ?>').html('<?php echo addslashes(str_replace(array("\r", "\n"), '', nl2br($row['tipo_mtto']))); ?>&nbsp;');
			$j('#mtto<?php echo $rnd1; ?>').html('<?php echo addslashes(str_replace(array("\r", "\n"), '', nl2br($row['descripcion']))); ?>&nbsp;');
			<?php
			break;

		case 'nombre_biomedico':
			if(!$id) {
				?>
				$j('#registro_invima<?php echo $rnd1; ?>').html('&nbsp;');
				$j('#firma_biomedico<?php echo $rnd1; ?>').html('&nbsp;');
				<?php
				break;
			}
			$res = sql("SELECT `biomedicos`.`id` as 'id', IF(    CHAR_LENGTH(`contactos1`.`identificacion`), CONCAT_WS('',   `contactos1`.`identificacion`), '') as 'id_contacto', IF(    CHAR_LENGTH(`contactos1`.`nombre`), CONCAT_WS('',   `contactos1`.`nombre`), '') as 'nombre', `biomedicos`.`registro_invima` as 'registro_invima', `biomedicos`.`nota` as 'nota', `biomedicos`.`firma` as 'firma' FROM `biomedicos` LEFT JOIN `contactos` as contactos1 ON `contactos1`.`id_contactos`=`biomedicos`.`id_contacto`  WHERE `biomedicos`.`id`='{$id}' limit 1", $eo);
			$row = db_fetch_assoc($res);
			?>
			$j('#registro_invima<?php echo $rnd1; ?>').html('<?php echo addslashes(str_replace(array("\r", "\n"), '', nl2br($row['registro_invima']))); ?>&nbsp;');
			$j('#firma_biomedico<?php echo $rnd1; ?>').html('<img src="thumbnail.php?i=<?php echo urlencode($row['firma']); ?>&t=biomedicos&f=firma&v=dv" class="img-thumbnail">');
			<?php
			break;


	}

?>