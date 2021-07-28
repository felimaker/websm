<?php
	$script_name = basename($_SERVER['PHP_SELF']);
	if($script_name == 'index.php' && isset($_GET['signIn'])){
		?>
		<style>
			body{
				background: url("images/fondo2.jpg") no-repeat fixed center center / cover;
			}
		</style>
		
		<div class="alert alert-success" id="benefits">
			** INVENTARIO DE DISPOSITIVOS **
		</div>
		
		<script>
			$j(function(){
				$j('#benefits').appendTo('#login_splash');
			})
		</script>
		<?php
	}
?>

<script>
	function get_date(date_field){
		var y = $j('#' + date_field).val();
		var m = $j('#' + date_field + '-mm').val();
		var d = $j('#' + date_field + '-dd').val();
		
		var date_object = new Date(y, m - 1, d);
		
		if(!y) return false;
		
		return date_object;
	}
</script>