<?php
// Template Name: Sprache wählen
get_header('language');
if ( have_posts() ) : while ( have_posts() ):
	the_post();
	$bg_image = get_field('lng_bg_image');
	?>
	<main <?php post_class('lng-page'); ?> style="background-image: url('<?php echo $bg_image['sizes']['fullwidth-image']; ?>');">
		<div class="container-fluid">
			<div class="row">
				<div class="col-12 lng-content">
					<?php
					the_title('<h2 class="mb-4">', '</h2>');
					the_content();
					$languages = icl_get_languages();
					$lng = array();
					$lng['de'] = 'Deutsch';
					$lng['fr'] = 'Französisch';
					$lng['it'] = 'Italienisch';
					$count_languages = count($languages);
					$counter = 1;
					echo '<div class="lng-choose-buttons mt-5">';
					foreach($languages as $language):
						$addclass = ' mr-3';
						if($counter >= $count_languages):
							$addclass = '';
						endif;
						echo '<a href="/'.$language['code'].'" class="btn btn-primary btn-lg'.$addclass.'">'.$lng[$language['code']].'</a>';
						$counter++;
					endforeach;
					echo '</div>';
					?>
				</div>
			</div>
		</div>
	</main>
	<?php
endwhile; endif;
get_footer('language');

