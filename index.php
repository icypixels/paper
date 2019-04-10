<?php
/**
 * File: index.php
 * This file is used to display the regular blog.
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

	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

		<?php get_template_part( 'includes/post', 'content' ); ?>

		<?php endwhile; 
			wp_reset_query();
		?>
	

		<?php else :

			wp_reset_query();
			?>

			<section <?php post_class('post-wrapper'); ?> id="post-<?php the_ID(); ?>">

			    <section class="left-side">             

			        <figure class="featured-content">
			            <?php the_post_thumbnail('thumbnail-blog'); ?>
			            <div class="overlay"></div>
			        </figure>               

			        <div class="container">

			            <div class="entry-title">
			                <a class="article-link" href="<?php the_permalink(); ?>">
			                    <?php _e('Error 404 - Not Found', 'framework') ?>
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
			                      
			                <?php _e("Sorry, but you are looking for something that isn't here.", "framework") ?>
			                
			            </article>      
			        </div>

			    </section>

			</section>        
		<?php endif; ?>		

<?php get_footer(); ?>