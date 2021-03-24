<form class="search__form row" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
    <input type="text" class="search__form__input" name="s" placeholder="Search" value="<?php echo get_search_query(); ?>">
    <input class="search__form__submit background__image" type="submit" value="">
</form>