<?php if (have_rows('header_slider')) : the_row()?>
    <?php
        $featured_posts = get_field('header_slider');
        foreach( $featured_posts as $feat_post):
            $post = $feat_post['slide'][0];
            // Setup this post for WP functions (variable must be named $post).
            setup_postdata($post);
            $banner = get_field('header_banner', $post->ID);
            get_template_part("components/block_header_banner", args: [
                'banner' => $banner,
                'permalink' => get_permalink(),
                'slider' => true,
            ]);
        endforeach;

        // get all projects
        $query = new WP_Query(array(
            'post_type' => 'projects',
            'post_status' => 'publish',
            'posts_per_page' => -1
        ));

        while ($query->have_posts()): $query->the_post();
            if (have_rows('header_banner')) : the_row(); ?>
                <div class="next-project-wrapper main-wrapper">
                    <?php
                        $image = get_sub_field('image');
                        $srcset = wp_get_attachment_image_srcset( $image['ID']);
                    ?>
                    <div class="next-project-container">
                        <a href="<?php  the_permalink(); ?>">
                            <h2><?= the_title() ?></h2>
                            <ul>
                                <li><?= get_the_excerpt() ?></li>
                            </ul>
                            <div class="next-project-img">
                                <img
                                    src="<?= $image['url']; ?>"
                                    srcset="<?php echo esc_attr( $srcset ); ?>"
                                    alt="<?= $image['image']['title']; ?>"
                                    height="<?= $image['height']; ?>"
                                    width="<?= $image['width']; ?>"
                                >
                                <div class="next-project-button">
                                    <button class="classic-button">
                                        Voir le projet
                                        <span class="svg-arrow-right-up-diag"><?php get_template_part("components/svg-arrow-right-up-diag"); ?></span>
                                    </button>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            <?php endif;
        endwhile;
        wp_reset_query();
    ?>
<?php endif ?>

