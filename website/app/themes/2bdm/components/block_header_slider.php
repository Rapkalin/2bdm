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

                    if (have_rows('header_banner')) : the_row();
                         get_template_part("components/block_header_banner", args: [
                            'banner' => [
                                'title' => nl2br(get_sub_field('title', false)),
                                'description' => get_sub_field('description', false),
                                'image' => get_sub_field('image'),
                                'call_to_action' => $cta
                            ],
                            'permalink' => get_permalink(),
                            'extraClasses' => ['hb-slider-active'],
                            'slider' => true,
                        ]);
                    endif;
                ?></div><?php
            endforeach;
        ?></div>
<?php endif ?>

