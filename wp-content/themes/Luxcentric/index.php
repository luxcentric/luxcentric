<?php get_header(); ?>

			<div id="content">

				<div id="inner-content" class="wrap cf">

					<div class="featured-blog">
						<?php 
						// get featured blog
						$args1 = array(
							'post_type' => 'post',
							'posts_per_page' => '1',
							'category_name' => 'featured',
						);

						$query1 = new WP_Query( $args1 );

						if ( $query1->have_posts() ) :
							while ( $query1->have_posts() ) : $query1->the_post(); ?>
								<?php if ( has_post_thumbnail() ) { ?>
									<?php $feat_image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), array(320,320) ); ?>
									<div class="feat-thumb">
										<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
											<?php echo '<div class="circular-lg" style="background: url(' . $feat_image[0] . ');"></div>'; ?>
											<!--<div class="circular-lg">-->
												<!--<img src="<?php echo $feat_image[0]; ?>" alt="feat image" />-->
												<?php //the_post_thumbnail() ?>
											 <!--</div>-->
										</a>
									</div>
								<?php } else { ?>
									<div class="feat-thumb">
										<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
											<?php $default_image_url = get_template_directory_uri() . '/library/images/assets/blank.png'; ?>
											<?php echo '<div class="circular-lg" style="background: url(' . $default_image_url . ');"></div>'; ?>

											<!--<div class="circular-lg">
												<img src="<?php //echo get_template_directory_uri(); ?>/library/images/assets/blank.png" alt="feat image" />
											 </div>-->
										</a>
									</div>

								<?php } ?>	

								<div class="feat-txt">
									<div id="feat-content-txt">
										<h1 class="h2 entry-title"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">FEATURED:&nbsp;<?php the_title(); ?></a></h1>

										<?php the_excerpt(); ?>
									</div>
								</div>
							<?php endwhile;
						endif;
						wp_reset_postdata();
						?>
					</div>

			<!-- dropdown list - exclude featured category -->
			<div class="blog-cat-dd cf">
				<?php
				$ddargs = array(
					'show_option_all' => 'All Categories',
					'orderby' => 'name', 
					'hide_empty' => 0,
					'exclude' => '9',
				);

				wp_dropdown_categories( $ddargs );
				?>

				<script type="text/javascript">
					<!--
					var dropdown = document.getElementById("cat");
					function onCatChange() {
						if ( dropdown.options[dropdown.selectedIndex].value > 0 ) {
							location.href = "<?php echo esc_url( home_url( '/' ) ); ?>?cat="+dropdown.options[dropdown.selectedIndex].value;
						} else {
							location.href = "<?php echo esc_url( home_url( '/' ) ); ?>blog";
						}
					}
					dropdown.onchange = onCatChange;
					-->
				</script>	
			</div>

					<div id="main" class="m-all t-all d-all" role="main">

						<!-- exclude Featured category(9) -->
						<?php 
						$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

						$query2 = new WP_Query( array( 'cat' => '-9', 'posts_per_page' => 6, 'paged' => $paged ) ); 
						
						if ($query2->have_posts()) : ?>
							<div class="flex-container">

								<?php while ($query2->have_posts()) : $query2->the_post(); ?>
									<div class="flex-item-2 flex-pad">

										<article id="post-<?php the_ID(); ?>" <?php post_class( 'cf' ); ?> role="article">

											<section class="entry-content cf">
												<?php if ( has_post_thumbnail() ) { ?>
													<?php $feat_image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), array(320, 320) ); ?>
													<div class="blog-thumb">
													<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
															<?php echo '<div class="circular-sm" style="background: url(' . $feat_image[0] . ');"></div>'; ?>

														<!--<div class="circular-sm">
															<?php //the_post_thumbnail() ?>
														 </div>-->
													</a>
													</div>
												<?php } else { ?>
													<div class="blog-thumb">
														<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
															<?php $default_image_url = get_template_directory_uri() . '/library/images/assets/blank.png'; ?>
																<?php echo '<div class="circular-sm" style="background: url(' . $default_image_url . ');"></div>'; ?>

															<!--<div class="circular-sm">
																<img src="<?php //echo get_template_directory_uri(); ?>/library/images/assets/blank.png" alt="feat image" />
															 </div>-->
														</a>
													</div>

												<?php } ?>	

												<div class="blog-contents">
													<h1 class="h2 entry-title"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h1>

													<?php the_excerpt(); ?>
												</div>
											</section>

										</article>
									</div>

								<?php endwhile; ?>
							</div>

							<?php bones_page_navi(); ?>

						<?php else : ?>

								<article id="post-not-found" class="hentry cf">
										<header class="article-header">
											<h1><?php _e( 'Oops, Post Not Found!', 'bonestheme' ); ?></h1>
									</header>
										<section class="entry-content">
											<p><?php _e( 'Uh Oh. Something is missing. Try double checking things.', 'bonestheme' ); ?></p>
									</section>
									<footer class="article-footer">
											<p><?php _e( 'This is the error message in the index.php template.', 'bonestheme' ); ?></p>
									</footer>
								</article>

						<?php endif; ?>

				</div>

			</div>


<?php get_footer(); ?>
