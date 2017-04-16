<?php
/*
 Template Name: Featured Workshop Page
 *
 * This is your featured workshop page template. You can create as many of these as you need.
 * Simply name is "page-whatever.php" and in add the "Template Name" title at the
 * top, the same way it is here.
 *
 * When you create your page, you can just select the template and viola, you have
 * a custom page template to call your very own. Your mother would be so proud.
 *
 * For more info: http://codex.wordpress.org/Page_Templates
*/

?>
<?php get_header(); ?>

			<div id="content">

				<div id="inner-content" class="wrap cf">

						<div id="main" class="m-all t-2of3 d-5of7 cf" role="main">

							<?php
							// Ensure the global $post variable is in scope
							global $post;						

							$args = array(
								'numberposts' => 1,
								'orderby' => 'date',
								'post_type' => 'tribe_events',
								'tribe_events_cat' => 'featured',
								'post_status' => 'publish'
							);

							$featured_events = get_posts( $args );

							foreach( $featured_events as $post ) :	
								setup_postdata($post);
							?>

								<article id="post-<?php the_ID(); ?>" <?php post_class( 'cf' ); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">

									<header class="article-header">
									</header> <?php // end article header ?>

									<section class="entry-content cf featured-workshop" itemprop="articleBody">

										<figure>
											<div class="feat-image"><?php echo get_the_post_thumbnail( $post->ID, 'large' ); ?></div>

											<figcaption>
												<h3 class="event-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
												<h5>
													<?php echo tribe_get_start_date( $post->ID, false, 'F j Y' ); ?>
													<span> @ </span>
													<?php echo tribe_get_start_date( $post->ID, false, 'g:i a' ); ?>
													<span> - </span>
													<?php echo tribe_get_end_date( $post->ID, false, 'g:i a' ); ?>
												</h5>
											</figcaption>
										</figure>

										<div class="event-content">
											<?php the_content(); ?>
										</div>
									</section>

									<footer class="article-footer cf">
									</footer>

								</article>

							<?php
							endforeach;

							wp_reset_postdata(); 
							do_action( 'tribe_events_after_the_content' );
							?>

						</div>

						<?php get_sidebar(); ?>
				</div>

			</div>

<?php get_footer(); ?>
