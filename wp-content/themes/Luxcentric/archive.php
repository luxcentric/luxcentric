<?php get_header(); ?>

			<div id="content">

				<div id="inner-content" class="wrap cf">

						<div id="main" class="m-all t-all d-all cf" role="main">

							<?php if (is_category()) { ?>
								<h1 class="archive-title h2">
									<span><?php _e( 'Posts Categorized:', 'bonestheme' ); ?></span> <?php single_cat_title(); ?>
								</h1>

							<?php } elseif (is_tag()) { ?>
								<h1 class="archive-title h2">
									<span><?php _e( 'Posts Tagged:', 'bonestheme' ); ?></span> <?php single_tag_title(); ?>
								</h1>

							<?php } elseif (is_author()) {
								global $post;
								$author_id = $post->post_author;
							?>
								<h1 class="archive-title h2">

									<span><?php _e( 'Posts By:', 'bonestheme' ); ?></span> <?php the_author_meta('display_name', $author_id); ?>

								</h1>
							<?php } elseif (is_day()) { ?>
								<h1 class="archive-title h2">
									<span><?php _e( 'Daily Archives:', 'bonestheme' ); ?></span> <?php the_time('l, F j, Y'); ?>
								</h1>

							<?php } elseif (is_month()) { ?>
									<h1 class="archive-title h2">
										<span><?php _e( 'Monthly Archives:', 'bonestheme' ); ?></span> <?php the_time('F Y'); ?>
									</h1>

							<?php } elseif (is_year()) { ?>
									<h1 class="archive-title h2">
										<span><?php _e( 'Yearly Archives:', 'bonestheme' ); ?></span> <?php the_time('Y'); ?>
									</h1>
							<?php } ?>

							<div class="flex-container">
							
							<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

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
												<p><?php _e( 'This is the error message in the archive.php template.', 'bonestheme' ); ?></p>
										</footer>
									</article>

							<?php endif; ?>

						</div>

				</div>

			</div>

<?php get_footer(); ?>
