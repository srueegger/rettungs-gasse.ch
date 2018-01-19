<?php
if(!empty($_GET['get_file']) && !empty($_GET['post_id'])):
	$post_id = $_GET['post_id'];
	$file = $_GET['get_file'];
	$count = (int) get_field('count_downloads', $post_id);
	$count++;
	update_field('count_downloads', $count, $post_id);
	header("Content-Disposition: attachment; filename=\"$file\"");
	header("Pragma: public");
	header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
	exit;
endif;
get_header();
?>
<main <?php post_class(); ?>>
	<div id="downloads-list" class="container">
		<div class="row">
			<?php
			$term_id = get_queried_object()->term_id;
			$args = array(
				'numberposts' => -1,
				'post_type' => 'downloads',
				'post_status' => 'publish',
				'orderby' => 'menu_order',
				'order' => 'ASC',
				'tax_query' => array(
					array(
					'taxonomy' => 'downloads_categories',
					'field' => 'term_id',
					'terms' => $term_id,
					)
				)
			);
			$posts = get_posts($args);
			global $post;
			foreach($posts as $post):
				setup_postdata( $post );
				$image = get_field('download_image');
				$file = get_field('download_datei');
				?>
				<div class="col-12 col-md-6 col-lg-5 bg-image">
					<img src="<?php echo $image['sizes']['download-image']; ?>" alt="<?php the_title(); ?>" class="img-fluid">
				</div>
				<div class="col-12 col-md-6 col-lg-7">
					<?php
					the_title('<h3>', '</h3>');
					global $wp;
					?>
					<p><a href="<?php echo home_url($wp->request ); ?>?get_file=<?php echo $file['url']; ?>&post_id=<?php the_ID(); ?>" class="btn btn-primary" target="_blank">Datei herunterladen</a></p>
				</div>
				<?php
			endforeach;
			wp_reset_postdata();
			?>
		</div>
	</div>
</main>
<?php
get_footer();