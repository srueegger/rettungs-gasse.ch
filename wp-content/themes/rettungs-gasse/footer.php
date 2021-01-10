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
	<?php
	if(get_field( 'page_has_modal', 'option' )) {
		?>
		<!-- Modal -->
		<div class="modal fade" id="rgModal" tabindex="-1" aria-labelledby="rgModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="rgModalLabel"><?php the_field( 'page_modal_title', 'option' ); ?></h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<?php the_field( 'page_modal_content', 'option' ); ?>
					</div>
				</div>
			</div>
		</div>
		<?php
	}
	wp_footer();
	?>
	</body>
</html>