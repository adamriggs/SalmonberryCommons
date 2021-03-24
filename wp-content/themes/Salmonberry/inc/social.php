<?php
    $social = get_field('social_links', 'option');
?>

<div class="social">
    <?php 
        if($social) {
            foreach($social as $item) {
    ?>
            <a class="social__item" href="<?php echo $item['link']['url']; ?>" target="_blank">
                <img class="svg-inline" title="<?php echo $item['link']['name']; ?>" src="<?php echo $item['link']['icon']['url']; ?>"/>
            </a>

    <?php
            }
        }
    ?>
</div>