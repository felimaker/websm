			<!-- Add footer template above here -->
			<div class="clearfix"></div>
			<?php if(!$_REQUEST['Embedded']){ ?>
				<div style="height: 70px;" class="hidden-print"></div>
			<?php } ?>

			<?php if(!$_REQUEST['Embedded']){ ?>
				<!-- AppGini powered by notice -->
				<div style="height: 60px;" class="hidden-print"></div>
				<nav class="navbar navbar-default navbar-fixed-bottom" role="navigation">
					<p class="navbar-text"><small>
						Creado por <a class="navbar-link" href="http://www.felicoach.com" target="_blank">FLM</a>
					</small></p>
				</nav>
			<?php } ?>

		</div> <!-- /div class="container" -->
		<?php if(!defined('APPGINI_SETUP') && is_file(dirname(__FILE__) . '/hooks/footer-extras.php')){ include(dirname(__FILE__).'/hooks/footer-extras.php'); } ?>
		<script src="<?php echo PREPEND_PATH; ?>resources/lightbox/js/lightbox.min.js"></script>
	</body>
</html>