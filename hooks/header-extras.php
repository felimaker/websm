<?php	
if (isset($_SESSION['custom_err_msg'])) {
	$customError ='<div id="customErrorMessage" class="custmErrMsg alert alert-dismissable alert-danger">'.$_SESSION['custom_err_msg'].'</div>';
	echo $customError;			
	if ($_SESSION['custom_err_shown'] == 1){
		unset($_SESSION['custom_err_msg']);
		$_SESSION['custom_err_shown'] = 0;
	} 
	else {
		$_SESSION['custom_err_shown'] = 1;
	}				
}

$script_name = basename($_SERVER['PHP_SELF']);
if($script_name == 'index.php' && isset($_GET['signIn'])){
	?>
	<style>
		body{
			background: url("images/fondo2.jpg") no-repeat fixed center center / cover;
		}
	</style>

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