
<?php

// Este archivo va en raiz

$currDir = dirname(__FILE__);
include("$currDir/defaultLang.php");
include("$currDir/language.php");
include("$currDir/lib.php");
include_once("$currDir/header.php");

/* grant access to all users who have access to the orders table */
$AGENDA_from = get_sql_from('mantenimientos');
if(!$AGENDA_from) exit(error_message('Acceso denegado a DB!', false));

/* get invoice */
$AGENDA_id = intval($_REQUEST['id_mtto']);
if(!$AGENDA_id) exit(error_message('ID Invalido!', false));

$AGENDA_fields = get_sql_fields('mantenimientos');
$res = sql("select {$AGENDA_fields} from {$AGENDA_from} and id_mtto={$AGENDA_id}", $eo);
if(!($AGENDA = db_fetch_assoc($res))) exit(error_message('Registro no encontrado!', false));
?>	
<div class="row">
    <div>
        <p><img src="images/HROB.png" alt="" width="85" height="79" />&nbsp;<img src="images/starmedica-2.png" alt="" width="163" height="60" /></p>
        <h4><strong>PROGRAMACI&Oacute;N DE CITA</strong>&nbsp;&nbsp;&nbsp;&nbsp;<button type="button" id="print" onclick="window.print();" title="Print" class="btn btn-primary"><i class="glyphicon glyphicon-print"></i> Imprimir</button></h4> 
        <table style="border-collapse: collapse; width: 100%;">
        <tbody>
        <tr style="height: 21px;">
        <td style="width: 20%; height: 21px;"><strong>**Codigo:</strong> <?php echo $AGENDA['codigo']?></td>
        <td style="width: 30%; height: 21px;"><strong>**Serial:</strong> <?php echo $AGENDA['serial']?></td>
        </tr>
        <tr style="height: 21px;">
        <td style="width: 20%; height: 21px;"><strong>IDENTIFICACI&Oacute;N:</strong> <?php echo $AGENDA['tipo_identi']?>. <?php echo $AGENDA['identificacion']?></td>
        <td style="width: 30%; height: 21px;"><strong>HORA:</strong> <?php echo $AGENDA['time']?></td>
        </tr>
        <tr style="height: 21px;">
        <td style="width: 20%; height: 21px;"><strong>MEDICO:</strong> <?php echo $AGENDA['medico']?></td>
        <td style="width: 30%; height: 21px;">TIPO: <?php echo $AGENDA['tipo_agenda']?></td>
        </tr>
        </tbody>
        </table>
        <table border="0" style="border-collapse: collapse; width: 100%;">
        <tbody>
        <tr style="height: 21px;">
        <td style="width: 30%; height: 21px;"><strong>PROCEDIMIENTO:</strong> <?php echo $AGENDA['procedimiento']?></td>
        </tr>
        <tr style="height: 21px;">
        <td style="width: 30%; height: 21px;"><strong>PREPARACI&Oacute;N:</strong> <?php echo $AGENDA['preparacion']?></td>
        </tr>
        </tbody>
        </table>
        <p><strong>**FACTURAR 2 HORAS&nbsp;ANTES&nbsp;DE SU CITA.</strong> </p>
    </div>

</div>
<?php	
include_once("$currDir/footer.php");
?>