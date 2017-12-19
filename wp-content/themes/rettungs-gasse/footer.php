	<div id="footer" class="text-white bg-primary">
		<div class="container">
			<div class="row">
				<div class="p-5 col-12 col-md-3">
					<?php dynamic_sidebar( 'footer-sidebar-1' ); ?>
				</div>
				<div class="p-5 col-12 col-md-4">
					<?php dynamic_sidebar( 'footer-sidebar-2' ); ?>
				</div>
				<div class="p-5 col-12 col-md-5">
					<?php dynamic_sidebar( 'footer-sidebar-3' ); ?>
				</div>
			</div>
			<div class="row">
				<div class="col-12 col-md-6">
					<p><i class="fa fa-copyright" aria-hidden="true"></i> <?php echo date('Y'); ?> <?php the_field('footer_text', 'option'); ?> </p>
				</div>
				<div class="col-12 col-md-6">
					<p class="text-right">SOCIAL MEDIA ICONS</p>
				</div>
			</div>
		</div>
	</div>
	<?php wp_footer(); ?>
	</body>
</html>