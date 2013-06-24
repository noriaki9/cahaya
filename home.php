<?php get_header() ?>
<?php $sticky = get_option( 'sticky_posts' ); ?>
	<div class="row collapse white">
		<div class="small-12 columns ">
			<div class="row collapse slideshow">
				<div class="small-8 columns">
				<?php
				$query = new WP_Query( array( 'post_type' => 'cahaya_slideshow', 'ignore_sticky_posts' => 1 )); 

				if ( $query->have_posts() ) {
					echo '<ul class="rslides">';
					while ( $query->have_posts() ) {
						$query->the_post();
						$image_src = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'slideshow-image' )[0];

						echo '<li class="slide"><img src="'.$image_src.'" /><div class="overlay"></div></li>';
					}
					echo '</ul>';
				}
				?>
				</div>
				<div class="small-4 columns news">
				<?php
					$query = new WP_Query( array(
						'post__not_in' => $sticky,
						'ignore_sticky_posts' => 1,
						'cat' => '1' 
					));
					while ( $query->have_posts() ) {
						$query->the_post();
						echo '<h4>'.get_the_title().'</h4>';
						the_excerpt();
					}
				?>
				</div>
			</div>
		</div>
	</div>
	<div class="row home-social white">
		<div class="small-6 columns">
			<?php
				$args = array(
					'posts_per_page' => 2,
					'post__in'  => $sticky,
					'ignore_sticky_posts' => 0
				);
				$query = new WP_Query( $args );
				if ( count($sticky) > 0 ) {
					while ( $query->have_posts() ) {
						$query->the_post();
						
						echo '<div class="small-5 columns image-border">';
							the_post_thumbnail('home-featured');
						echo '</div>';
						echo '<div class="small-7 columns"><h4>'.get_the_title().'</h4>';
							the_excerpt();
							echo '<a href="'.get_permalink().'" class="small button">Read more</a>';
						echo '</div>';
					}
				}
			?>
		</div>
		<div class="small-6 columns">
				<a class="twitter-timeline"  href="https://twitter.com/search?q=%23ocwcglobal" data-widget-id="251736808315043840">Tweets about "#ocwcglobal"</a>	
			<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
		</div>
	</div>
	<div class="row white">
		<?php get_template_part('logos'); ?>
	</div>	
	<div class="row white insights">
		<div class="small-5 columns"><hr /></div>
		<div class="small-2 columns">
			<i class="icon-search"></i> insights
		</div>
		<div class="small-5 columns"><hr /></div>
	</div>

	<div class="row white home-pages-featured">
		<?php dynamic_sidebar('home-pages-thumbnails'); ?>
	</div>
	<div class="row white home-pages-featured thumbnails blue-bottom">
		<?php dynamic_sidebar('home-pages'); ?>
	</div>
	
<?php get_footer() ?>