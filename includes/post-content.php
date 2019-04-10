<?php 

/**
 * The Post Content Template part
 *
 * @package     Icy Framework
 * @copyright   Copyright (c) 2013, Paul Roman | Icy Pixels
 * @license     http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU General Public License, v2 (or newer)
 * @author      Paul Roman
 *
 * @since       Icy Framework 1.0
 */

/**
 * Outputs all the data regarding a blog post. 
 * Helper template part. Doesn't overcrowd other files with this piece of code.
 *
 * @return  string HTML
 * @uses get_template_part();
 * @uses get_post_format();
 */

?>
<!--BEGIN .post -->
<?php if (function_exists('rwmb_meta')) {
    $intro = '';
    $intro = rwmb_meta( 'icy_intro_styling' );
    $post_array = array();
    $post_array = array(
        'post-wrapper',
        $intro,
    );

    } 
?>
<section <?php if (function_exists('rwmb_meta')) { post_class($post_array); } else { post_class(); } ?> id="post-<?php the_ID(); ?>">

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
                <div class="meta-info">
                    <span class="information"><?php the_time('F d, Y'); ?></span>
                    <span class="meta-separator">&times;</span>
                    <span class="information">
                        <?php 
                            $author_id = $post->post_author;
                            $nicename = the_author_meta( 'display_name' );

                            echo $nicename;
                        ?>
                    </span>
                    <span class="meta-separator">&times;</span>
                    <span class="information"><?php the_category(', '); ?></span>
                </div>

                <!--BEGIN .navigation-->
                <div class="navigation-posts">              

                    <div class="nav-prev"><?php next_posts_link('<i class="fa fa-chevron-left"></i>' . __('Older', 'framework')) ?></div>
                    <div class="nav-next">
                    <?php previous_posts_link( '<span class="meta-separator">&times;</span>' . __('Newer', 'framework') . '<span><i class="fa fa-chevron-right"></i></span>'); ?></div>     
                                                
                <!--END .navigation-->
                </div>
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

                 <?php 
                    $format = get_post_format();
                    if( false === $format ) { $format = 'standard'; }
                ?>                 

                <!-- Post Format Element-->
                <?php get_template_part( 'post', $format ); ?>      
                      
                <?php the_content(__('Read More &raquo; ', 'framework')); ?>

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
            </article>      
        </div>

    </section>

</section>