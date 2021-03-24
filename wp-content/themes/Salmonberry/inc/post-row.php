<?php
    $category_object = get_category_by_slug($category_slug);
    $category_name = $category_object->name;
    $category_id = $category_object->term_id;
    $category_name_words = explode(' ', $category_name);
    $button_name = array_pop($category_name_words);
    $args = array(
        'numberposts'   => '3',
        'category_name' => $category_slug
    );
    $posts = get_posts($args);
?>

<div class="post__row mobile__break row between">
    <div class="row">
        <h4 class="col-6 middle"><?php echo $category_name; ?></h4>
        <a class="col-6 end" href="<?php echo get_category_link($category_id); ?>"><button>More <?php echo $button_name; ?></button></a>
    </div>
    <?php
        foreach($posts as $tmp) {

    ?>
            <div class="post__tile__container col-3">
                <?php
                    global $post;
                    $post = $tmp;
                    setup_postdata($post);
                    include get_template_directory() . '/inc/post-tile.php';
                    wp_reset_postdata();
                ?>
            </div>
    <?php
        }
    ?>
</div>