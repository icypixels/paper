<?php 

/**
 * File: archive.php
 * This file is used to display an archive of the posts.
 *
 * @package		Icy Framework
 * @copyright	Copyright (c) 2013, Paul Roman | Icy Pixels
 * @license		http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU General Public License, v2 (or newer)
 * @author		Paul Roman
 *
 * @since		Icy Framework 1.0
 */
?>  

<?php get_header(); 
wp_reset_query();			
?>			
        
			<section <?php post_class('post-wrapper'); ?> id="post-<?php the_ID(); ?>">

			    <section class="left-side">             

			        <figure class="featured-content">
			            <?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'thumbnail-blog' ); ?>
			            <div class="custom-background" style="background-image: url('<?php echo $image[0]; ?>')">

			            <div class="overlay"></div>
			        </figure>                         

			        <div class="container">

			            <div class="entry-title">
			                <a class="article-link" href="<?php the_permalink(); ?>">
 			                    <?php 
		                            $author_id = $post->post_author;
		                            $nicename = the_author_meta( 'display_name' );

		                            echo $nicename;
		                        ?>
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
			            	<div class="search-related">
								<ol class="posts-listing">
					            <?php 			          
		    					if (have_posts()) : while (have_posts()) : the_post(); ?>

					            	<li><a class="article-link" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>

								<?php endwhile; ?>		
								</ol>	

								<?php else : ?>
			                
				                    <h2><?php _e('Error 404 - Not Found', 'framework') ?></h2>
				                    <p><?php _e("Sorry, but you are looking for something that isn't here.", "framework") ?></p>
				                
								<?php endif; ?>
							</div>
			            </article>      
			        </div>

			    </section>

			</section>        			

<?php //get_sidebar(); ?>  	

<?php get_footer(); ?>