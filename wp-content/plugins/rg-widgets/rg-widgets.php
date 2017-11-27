<?php
/*
Plugin Name: Widgets für rettungs-gasse.ch
Plugin URI: https://rueegger.me
Description: Erstellt diverse Widgets für die Rettungsgasse Webseite
Version: 1.0.0
Author: Samuel Rüegger
Author URI: https://rueegger.me */

//Newest News
class rg_widget_new_posts extends WP_Widget {
	public function __construct() {
		$widget_ops = array(
			'classname' => 'rg_widget_new_posts',
			'description' => 'Zeigt die neusten Newsbeiträge an.',
		);
		parent::__construct( 'rg_widget_new_posts', 'Rettungsgasse: Neueste Beiträge', $widget_ops );
	}
	public function widget( $args, $instance ) {
		echo $args['before_widget'];
		if ( !empty($instance['title']) ){
			echo $args['before_title'];
			echo $instance['title'];
			echo $args['after_title'];
		}
		$widget_id = 'widget_' . $args['widget_id'];
		$count_item = get_field('count_items', $widget_id);
		$post_type = get_field('select_posttype', $widget_id);
		$args_post = array(
			'posts_per_page' => $count_item,
			'orderby' => 'date',
			'order' => 'DESC',
			'post_type' => 'post',
			'post_status' => 'publish',
			'suppress_filters' => false
		);
		$posts = get_posts($args_post);
		global $post;
		foreach($posts as $post):
			setup_postdata($post);
			the_title('<h4 class="my-4"><a href="'.get_the_permalink().'">', '</a></h4>');
			the_excerpt();
		endforeach;
		wp_reset_postdata();
		echo $args['after_widget'];
	}
	public function form( $instance ) {
		if ( isset($instance['title']) ) {
			$title = $instance['title'];
		}else {
			$title = __( 'New title', 'text_domain' );
		}
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
		<?php
	}
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		return $instance;
	}
}

//Social Media Menu
class rg_widget_sm_menu extends WP_Widget {
	public function __construct() {
		$widget_ops = array(
			'classname' => 'rg_widget_sm_menu',
			'description' => 'Zeigt das Social Media Menü an',
		);
		parent::__construct( 'rg_widget_sm_menu', 'Rettungsgasse: Social Media Menü', $widget_ops );
	}
	public function widget( $args, $instance ) {
		echo $args['before_widget'];
		if ( !empty($instance['title']) ){
			echo $args['before_title'];
			echo $instance['title'];
			echo $args['after_title'];
		}
		$widget_id = 'widget_' . $args['widget_id'];
		$menuID = get_field('menu', $widget_id);
		$menus = wp_get_nav_menu_items($menuID);
		echo '<ul class="list-inline">';
		foreach($menus as $menu):
			$classes = implode(' ', $menu->classes);
			$target = '_blank';
			if(empty($menu->target)):
				$target = '_self;';
			endif;
			$icon = get_field('icon', $menu);
			echo '<li class="list-inline-item"><a href="'.$menu->url.'" class="'.$classes.'" target="'.$target.'"><i class="fa '.$icon.' fa-2x mr-3" aria-hidden="true"></i></a></li>';
		endforeach;
		echo '</ul>';
		echo $args['after_widget'];
	}
	public function form( $instance ) {
		if ( isset($instance['title']) ) {
			$title = $instance['title'];
		}else {
			$title = __( 'New title', 'text_domain' );
		}
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
		<?php
	}
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		return $instance;
	}
}



function register_rg_widgets(){
	register_widget( 'rg_widget_new_posts' );
	register_widget( 'rg_widget_sm_menu' );
}
add_action( 'widgets_init', 'register_rg_widgets' );