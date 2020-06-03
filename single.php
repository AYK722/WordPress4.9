<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

get_header(); ?>

<div class="wrap">
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<?php
			/* Start the Loop */
			while ( have_posts() ) : the_post();

				get_template_part( 'template-parts/post/content', get_post_format() );

				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;

				the_post_navigation( array(
					'prev_text' => '<span class="screen-reader-text">' . __( 'Previous Post', 'twentyseventeen' ) . '</span><span aria-hidden="true" class="nav-subtitle">' . __( 'Previous', 'twentyseventeen' ) . '</span> <span class="nav-title"><span class="nav-title-icon-wrapper">' . twentyseventeen_get_svg( array( 'icon' => 'arrow-left' ) ) . '</span>%title</span>',
					'next_text' => '<span class="screen-reader-text">' . __( 'Next Post', 'twentyseventeen' ) . '</span><span aria-hidden="true" class="nav-subtitle">' . __( 'Next', 'twentyseventeen' ) . '</span> <span class="nav-title">%title<span class="nav-title-icon-wrapper">' . twentyseventeen_get_svg( array( 'icon' => 'arrow-right' ) ) . '</span></span>',
				) );

			endwhile; // End of the loop.
?>


            <!-- 柔軟コンテンツ -->
            <?php
                $rows = get_field('flex');
                if($rows) {
                    foreach ($rows as $row) {
                        $set_type = $row['acf_fc_layout'];
                        if ($set_type === 'flex_img') {
                            $val1 = $row['flex_img_img'];
                            $val2 = $row['flex_img_cap'];
                            if ($val1 && $val2) {
                                //var_dump($val1);
                                echo '<img src="'.$val1[url].'">' . '<br>';
                                echo $val2 . '<br>';
                            }
                        } elseif ($set_type === 'flex_txtimg') {
                            $val3 = $row['flex_txtimg_txt'];
                            $val4 = $row['flex_txtimg_img'];
                            if ($val3 && $val4) {
                                //var_dump($val1);
                                echo '<img src="'.$val4[url].'">' . '<br>';
                                echo $val3 . '<br>';
                            }
                        }
                    }
                }
            ?>

            <!-- 繰り返しフィールド -->
            <?php
                $rows = get_field('page_faq_item');
                if($rows) {
                    foreach ($rows as $row) {
                        echo $row['page_faq_q'];
                        echo $row['page_faq_a'];
                    }
                }
            ?>

            <!-- グループ -->
            <?php
                $rows = get_field('shop_info');
                if($rows) {
                    echo $rows['shop_name'] . '<br>';
                    echo $rows['shop_number'] . '<br>';
                    echo $rows['shop_address'];
                }
            ?>




		</main><!-- #main -->
	</div><!-- #primary -->
	<?php get_sidebar(); ?>
</div><!-- .wrap -->

<?php get_footer();
