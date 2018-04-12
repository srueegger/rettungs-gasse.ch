	<div id="footer" class="text-white bg-primary">
		<div class="container">
			<div class="row">
				<div class="col-12 col-md-6 footer-widget-container">
					<?php dynamic_sidebar( 'footer-sidebar-1' ); ?>
				</div>
				<div class="col-12 col-md-6 footer-widget-container">
					<?php dynamic_sidebar( 'footer-sidebar-3' ); ?>
				</div>
			</div>
			<div class="row">
				<div class="col-12">
					<p><i class="fa fa-copyright" aria-hidden="true"></i> <?php echo date('Y'); ?> <?php the_field('footer_text', 'option'); ?> </p>
				</div>
			</div>
		</div>
	</div>
	<?php wp_footer(); ?>
	</body>
</html>