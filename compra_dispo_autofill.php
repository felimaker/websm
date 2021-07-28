<?php
// This script and data application were generated by AppGini 5.97
// Download AppGini for free from https://bigprof.com/appgini/download/

	$currDir = dirname(__FILE__);
	include_once("$currDir/lib.php");

	handle_maintenance();

	header('Content-type: text/javascript; charset=' . datalist_db_encoding);

	$table_perms = getTablePermissions('compra_dispo');
	if(!$table_perms['access']) die('// Access denied!');

	$mfk = $_GET['mfk'];
	$id = makeSafe($_GET['id']);
	$rnd1 = intval($_GET['rnd1']); if(!$rnd1) $rnd1 = '';

	if(!$mfk) {
		die('// No js code available!');
	}

	switch($mfk) {

		case 'modelo':
			if(!$id) {
				?>
				$j('#foto<?php echo $rnd1; ?>').html('&nbsp;');
				<?php
				break;
			}
			$res = sql("SELECT `marca_modelo`.`id_mmodelo` as 'id_mmodelo', IF(    CHAR_LENGTH(`marcas1`.`marca`), CONCAT_WS('',   `marcas1`.`marca`), '') as 'marca', `marca_modelo`.`modelo` as 'modelo', `marca_modelo`.`img` as 'img', `marca_modelo`.`fabricante` as 'fabricante', `marca_modelo`.`descripcion` as 'descripcion', if(`marca_modelo`.`creado`,date_format(`marca_modelo`.`creado`,'%d/%m/%Y %h:%i %p'),'') as 'creado', `marca_modelo`.`creado_por` as 'creado_por' FROM `marca_modelo` LEFT JOIN `marcas` as marcas1 ON `marcas1`.`id_marca`=`marca_modelo`.`marca`  WHERE `marca_modelo`.`id_mmodelo`='{$id}' limit 1", $eo);
			$row = db_fetch_assoc($res);
			?>
			<?php if($row['img']) { ?> 
				$j('#foto<?php echo $rnd1; ?>').html('<a href="<?php echo getUploadDir('') . addslashes(str_replace(["\r", "\n"], '', $row['img'])); ?>" data-lightbox="compra_dispo_dv"><img src="thumbnail.php?i=<?php echo urlencode($row['img']); ?>&t=marca_modelo&f=img&v=dv" class="img-thumbnail"></a>');
			<?php } else { ?>
				$j('#foto<?php echo $rnd1; ?>').html('<img src="thumbnail.php?i=&t=marca_modelo&f=img&v=dv" class="img-thumbnail">');
			<?php } ?>
			<?php
			break;


	}

?>