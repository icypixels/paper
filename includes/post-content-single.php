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
} 
    $post_array = array();
    $post_array = array(
        'post-wrapper',
        $intro,
    );
?>
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

                    <div class="nav-prev">
                        <?php previous_post_link(__('%link', 'framework'), '<i class="fa fa-chevron-left"></i>' . __('Previous', 'framework')); ?>
                    </div>
            
                    <div class="nav-next">
                        <?php next_post_link(__('%link', 'framework'), '<span class="meta-separator">&times;</span>' . __('Newer', 'framework') . '<span><i class="fa fa-chevron-right"></i></span>'); ?>
                    </div>     
                                                
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

        <div class="entry-meta-single">
            <div class="entry">
                <h5><?php _e('Share', 'framework'); ?></h5>
                <ul>
                <?php 
                $thumb_id = get_post_thumbnail_id();
                $thumb_url_array = wp_get_attachment_image_src($thumb_id, 'thumbnail-blog', true);
                $thumb_url = $thumb_url_array[0];
                ?>
                    <li><a onclick="window.open('http://twitter.com/home?status=<?php echo rawurlencode(get_the_title()); ?>%20-%20<?php the_permalink(); ?>','twitter','width=450,height=300,left='+(screen.availWidth/2-375)+',top='+(screen.availHeight/2-150)+'');return false;" href="http://twitter.com/home?status=<?php echo rawurlencode(get_the_title()); ?>%20-%20<?php the_permalink(); ?>" title="<?php the_title(); ?>" target="blank" class="icy-social icon twitter"><?php _e('Twitter', 'framework'); ?></a>
                    <li><a onclick="window.open('http://www.facebook.com/sharer.php?s=100&amp;p[title]=<?php the_permalink(); ?>&amp;p[images][0]=<?php echo $thumb_url; ?>&amp;p[url]=<?php the_permalink(); ?>','facebook','width=450,height=300,left='+(screen.availWidth/2-375)+',top='+(screen.availHeight/2-150)+'');return false;" href="http://www.facebook.com/sharer.php?s=100&amp;p[title]=<?php the_permalink(); ?>&amp;p[images][0]=<?php echo $thumb_url; ?>&amp;p[url]=<?php the_permalink(); ?>" title="<?php the_title(); ?>" target="blank" class="icy-social icon facebook"><?php _e('Facebook', 'framework'); ?></a>
                    <li><a href="https://plus.google.com/share?url=<?php the_permalink(); ?>" onclick="window.open('https://plus.google.com/share?url=<?php the_permalink(); ?>','gplusshare','width=450,height=300,left='+(screen.availWidth/2-375)+',top='+(screen.availHeight/2-150)+'');return false;" class="icy-social icon googleplus"><?php _e('Google+', 'framework'); ?></a>
                    <li>
                    <?php $pinterestimage ='';
                    $pinterestimage = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' ); ?>
                    <a href="http://pinterest.com/pin/create/link/?url=<?php the_permalink(); ?>&amp;media=<?php echo $pinterestimage[0]; ?>&amp;description=<?php the_title(); ?>" onclick="window.open('http://pinterest.com/pin/create/link/?url=<?php the_permalink(); ?>&amp;media=<?php echo $pinterestimage[0]; ?>&amp;description=<?php the_title(); ?>','pinterest','width=450,height=300,left='+(screen.availWidth/2-375)+',top='+(screen.availHeight/2-150)+'');return false;"><?php _e('Pinterest', 'framework'); ?></a>
                </ul>
            </div>            
            <?php if( has_tag() ) { ?>
            <div class="entry">
                <h5><?php _e('Tags', 'framework'); ?></h5>
                <?php the_tags('<ul><li>','</li><li>','</li></ul>'); ?>
            </div>
            <?php } ?>             
            <div class="entry">
                <h5><?php _e('Category', 'framework'); ?></h5>
                <ul><li><?php the_category('<li>'); ?></ul>
            </div>
            <?php if( function_exists('zilla_likes') ) { ?>
            <div class="float-right">
                
                    <?php zilla_likes(); ?>
            
            </div>
            <?php } ?>
            
        </div>

        <div class="author-bio-box">
        <h3><?php _e('About the author', 'framework') ?></h3>
            <figure class="author-avatar">
                <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>" title="<?php the_author_meta( 'display_name' ); ?>">
                    <?php echo get_avatar( get_the_author_meta( 'ID' ), 64 ); ?>
                </a>
            </figure>
            <div class="description">
                <h4 class="author-name"><?php the_author_posts_link(); ?></h4>
                <?php the_author_meta('description'); ?>
            </div>
        </div>

        <div class="row-fluid comments-wrapper">
            <?php comments_template('', true); ?>           
        </div>

    </section>

</section>