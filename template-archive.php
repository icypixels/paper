<?php 
/*
	Template Name: Archive
*/?>

<?php
/**
 * File: template-archive.php
 * This file is used to display a page with archive posts
 *
 * @package		Icy Framework
 * @copyright	Copyright (c) 2013, Paul Roman | Icy Pixels
 * @license		http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU General Public License, v2 (or newer)
 * @author		Paul Roman 
 *
 * @since		Icy Framework 1.0
 */
?>


<?php get_header(); ?>	

		<?php 			          
    	if (have_posts()) : while (have_posts()) : the_post(); ?>
        
			<section <?php post_class($post_array); ?> id="post-<?php the_ID(); ?>">

			    <section class="left-side">             

			        <figure class="featured-content">
			            <?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'thumbnail-blog' ); ?>
			            <div class="custom-background" style="background-image: url('<?php echo $image[0]; ?>')">

			            <div class="overlay"></div>
			        </figure>               

			        <div class="container">

			            <div class="entry-title">
			                <a class="article-link" href="<?php the_permalink(); ?>">
			                    <?php the_title(); ?>
			                </a>
			            </div>

			            <div class="entry-meta">

			            </div>

			        </div><!--END .container -->

			    </section>

			    <section class="right-side content" role="main">  
			        <div class="menu-container">
			            <button type="button" role="button" aria-label="Toggle Navigation" class="menu-button lines-button x">
			                <span class="lines"></span>
			            </button>   
			        </div>

			        <div class="container">
			            <article class="post-content">  

			            	<?php the_content(__('Read More &raquo; ', 'framework')); ?>

							<section class="row-fluid">
				            	
								<div class="span6">
									<h3><?php _e('Recent Posts', 'framework'); ?></h3>
									<ul class="archive-list">
										<?php wp_get_archives('type=postbypost&limit=20'); ?>
									</ul>
									<h3><?php _e('Authors', 'framework'); ?></h3>
									<ul class="archive-list">
										<?php wp_list_authors('show_fullname=1&optioncount=1&orderby=post_count&order=DESC'); ?>
									</ul>
									
									<h3><?php _e('Pages', 'framework'); ?></h3>
									<ul class="archive-list">
										<?php wp_list_pages('sort_column=menu_order&title_li='); ?>
									</ul>
									
									<h3><?php _e('Categories', 'framework'); ?></h3>
									<ul class="archive-list">
										<?php wp_list_categories('orderby=name&title_li='); ?> 
									</ul>
								</div>

				            	<div class="span6">
									<h3><?php _e('By Day', 'framework'); ?></h3>
									<ul class="archive-list">
										<?php wp_get_archives('type=daily&limit=15'); ?>
									</ul>	
									<h3><?php _e('By Month', 'framework'); ?></h3>
									<ul class="archive-list">
										<?php wp_get_archives('type=monthly&limit=12'); ?>
									</ul>
									
									<h3><?php _e('By Year', 'framework'); ?></h3>
									<ul class="archive-list">
										<?php wp_get_archives('type=yearly&limit=12'); ?>
									</ul>
								</div>
								
							</section>					
			                      			                
			                <?php
			                $args = array(
			                    'before'           => '<p class="pagenavi"><span class="desc">' . __( 'Pages:' ) . '</span>',
			                    'after'            => '</p>',
			                    'link_before'      => '',
			                    'link_after'       => '',
			                    'next_or_number'   => 'number',
			                    'separator'        => '</span><span>',
			                    'nextpagelink'     => __( 'Next page' ),
			                    'previouspagelink' => __( 'Previous page' ),
			                    'pagelink'         => '%',
			                    'echo'             => 1
			                );
			                 wp_link_pages($args); ?>

			                <?php
								// Display the Comment form
								comment_form(); 
							?>
			            </article>      
			        </div>

			    </section>

			</section>        
	                        
	         
			<?php endwhile; ?>			

			<?php else : ?>

			<!--BEGIN #post-0-->
			<div id="post-404" <?php post_class(); ?>>
			
				<h2 class="entry-title"><?php _e('Error 404 - Not Found', 'framework') ?></h2>
			
				<!--BEGIN .entry-content-->
				<div class="entry-content">
					<p><?php _e("Sorry, but you are looking for something that isn't here.", "framework") ?></p>
				<!--END .entry-content-->
				</div>
			
			<!--END #post-0-->
			</div>

			</article>
			<?php endif; ?>
		<!-- END .content -->
		</section>

	<!-- END .primary -->
	</section>	

<?php //get_sidebar(); ?>  	

<?php get_footer(); ?>