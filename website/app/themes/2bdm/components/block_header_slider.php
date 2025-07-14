<?php if (have_rows('header_slider')) : the_row() ?>
    <?php
        $featured_posts = get_field('header_slider');
        $cta = get_field('call_to_action')
        ?><div class="slider"><?php
            foreach( $featured_posts as $index => $feat_post):
                ?><div class="slide" data-index="<?= $index ?>"><?php
                    $post = $feat_post['slide'][0];
                    // Setup this post for WP functions (variable must be named $post).
                    setup_postdata($post);
                    $banner = get_field('header_banner', $post->ID);
                    $banner['call_to_action'] = $cta;
                    get_template_part("components/block_header_banner", args: [
                        'banner' => $banner,
                        'permalink' => get_permalink(),
                        'extraClasses' => ['hb-slider-active'],
                        'slider' => true,
                    ]);
                ?></div><?php
            endforeach;
        ?></div>
<?php endif ?>

