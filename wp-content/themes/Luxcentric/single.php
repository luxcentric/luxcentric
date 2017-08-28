<?php get_header(); ?>

			<div id="content">

				<div id="inner-content" class="wrap cf">

					<div id="main" role="main">

						<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

			            	<article id="post-<?php the_ID(); ?>" <?php post_class('cf'); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">

				                <header class="article-header">
				                </header> <?php // end article header ?>

				                <section class="entry-content cf" itemprop="articleBody">
				                  <?php
				                  		if ( has_post_thumbnail() ) :
											$feat_image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), array(320, 320) ); ?>
											<div class="feat-thumb">
												<?php echo '<div class="circular-lg" style="background: url(' . $feat_image[0] . ');"></div>'; ?>
												<!--<div class="circular-lg"><img src="<?php echo $feat_image[0]; ?>" alt="feat image" /></div>-->
											</div>
										<?php endif; ?>

										

				                    <h1 class="entry-title single-title" itemprop="headline"><?php the_title(); ?></h1>
									<?php
				                    // the content (pretty self explanatory huh)
				                    the_content();

				                    /*
				                     * Link Pages is used in case you have posts that are set to break into
				                     * multiple pages. You can remove this if you don't plan on doing that.
				                     *
				                     * Also, breaking content up into multiple pages is a horrible experience,
				                     * so don't do it. While there are SOME edge cases where this is useful, it's
				                     * mostly used for people to get more ad views. It's up to you but if you want
				                     * to do it, you're wrong and I hate you. (Ok, I still love you but just not as much)
				                     *
				                     * http://gizmodo.com/5841121/google-wants-to-help-you-avoid-stupid-annoying-multiple-page-articles
				                     *
				                    */
				                    wp_link_pages( array(
				                      'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'bonestheme' ) . '</span>',
				                      'after'       => '</div>',
				                      'link_before' => '<span>',
				                      'link_after'  => '</span>',
				                    ) );
				                  ?>
				                </section> <?php // end article section ?>

				                <footer class="article-footer">
									<div class="social-share social-icons"><?php dynamic_sidebar('sidebar4'); ?></div>				              
				                </footer> <?php // end article footer ?>

				                <?php comments_template(); ?>

				            	</article> <?php // end article ?>							

							<?php endwhile; ?>

						<?php else : ?>

							<article id="post-not-found" class="hentry cf">
									<header class="article-header">
										<h1><?php _e( 'Oops, Post Not Found!', 'bonestheme' ); ?></h1>
									</header>
									<section class="entry-content">
										<p><?php _e( 'Uh Oh. Something is missing. Try double checking things.', 'bonestheme' ); ?></p>
									</section>
									<footer class="article-footer">
											<p><?php _e( 'This is the error message in the single.php template.', 'bonestheme' ); ?></p>
									</footer>
							</article>

						<?php endif; ?>

					</div>

				</div>

			</div>

<?php get_footer(); ?>
