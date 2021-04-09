<?php
    
?>
    <footer class="row">

        <div class="footer__border hr"></div>

        <section class="footer__container row middle">
            <div class="col-6">
                <div class="row middle">
                    <div class="col-4 start footer__get"><h2>Get To Know</h2></div>
                    <div class="col-6 middle">
                        <?php wp_nav_menu(array(
                            'menu' => 'info',
                            'container' => 'nav',
                            'container_class' => 'menu',
                            'container_id' => '',
                            'menu_class' => 'row between footer__info'
                        )); ?>
                        
                    </div>
                    <div class="col-12 footer__row2 footer__longtext start"><h2>Salmonberry Commons</h2></div>
                </div>
            </div>

            <div class="col-6">
                <div class="row middle">
                    <div class="col-2 start"><h2>Help</h2></div>
                    <div class="col-4 row middle"><img class="footer__arrow arrow__right center" src="<?php echo get_template_directory_uri() . '/images/arrow-right.svg' ?>"></div>
                    <div class="footer__email col-6 end"><a href="mailto:hello@salmonberrycommons.com">Customer service: hello@salmonberrycommons.com</a></div>
                    <div class="menu row middle footer__row2">
                        <div class="col-10">
                            <?php 
                                // wp_nav_menu(array(
                                //     'menu' => 'questions',
                                //     'container' => 'nav',
                                //     'container_class' => 'menu',
                                //     'container_id' => '',
                                //     'menu_class' => 'row between'
                                // )); 
                            ?>
                            <div class="newsletter__signup">
                            <!-- Begin Mailchimp Signup Form -->
                                <link href="//cdn-images.mailchimp.com/embedcode/classic-10_7.css" rel="stylesheet" type="text/css">
                                <style type="text/css">
                                    #mc_embed_signup{background:#fff; clear:left; font:14px Helvetica,Arial,sans-serif; }
                                    /* Add your own Mailchimp form style overrides in your site stylesheet or in this style block.
                                       We recommend moving this block and the preceding CSS link to the HEAD of your HTML file. */
                                </style>
                                <div id="mc_embed_signup">
                                    <form action="https://salmonberrysaloon.us19.list-manage.com/subscribe/post?u=013fa9f40719be3f26827be31&amp;id=a94c8cc5eb" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
                                        <div id="mc_embed_signup_scroll">
                                        
                                            <div class="mc-field-group col-6">
                                                <input type="email" value="" name="EMAIL" class="email" id="mce-EMAIL" placeholder="Newsletter Signup">
                                            </div>

                                            <div id="mce-responses" class="clear">
                                                <div class="response" id="mce-error-response" style="display:none"></div>
                                                <div class="response" id="mce-success-response" style="display:none"></div>
                                            </div>    <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->

                                            <div class="" style="position: absolute; left: -5000px;" aria-hidden="true"><input type="text" name="b_013fa9f40719be3f26827be31_a94c8cc5eb" tabindex="-1" value=""></div>

                                            <div class="clear col-4"><input type="submit" value="Subscribe" name="subscribe" id="mc-embedded-subscribe" class="button"></div>
                                        </div>
                                    </form>
                                </div>
                                <script type='text/javascript' src='//s3.amazonaws.com/downloads.mailchimp.com/js/mc-validate.js'></script><script type='text/javascript'>(function($) {window.fnames = new Array(); window.ftypes = new Array();fnames[0]='EMAIL';ftypes[0]='email';fnames[1]='FNAME';ftypes[1]='text';fnames[2]='LNAME';ftypes[2]='text';fnames[3]='ADDRESS';ftypes[3]='address';fnames[4]='PHONE';ftypes[4]='phone';fnames[5]='BIRTHDAY';ftypes[5]='birthday'; }(jQuery));var $mcj = jQuery.noConflict(true);</script>
                            <!--End mc_embed_signup-->

                        </div>
                        </div>
                        <div class="col-2 end">
                            <?php include get_template_directory() . '/inc/social.php'; ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="footer__breadcrumb row center middle">
            <a href="https://basicwebsiteagency.com" target="_blank"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 96.09 76.02"><defs><style>.cls-1{fill:#f38134;}.cls-2,.cls-3{fill:#f38134;font-size:12px;font-family:Kanit-Bold, Kanit;font-weight:700;}.cls-2{fill:#f38134;}</style></defs><g id="Layer_2" data-name="Layer 2"><g id="INDEX"><path class="cls-1" d="M0,52.86v-34H11.5q6,0,9.37,2.33a8,8,0,0,1,3.36,7A7.33,7.33,0,0,1,23,32.38a7.49,7.49,0,0,1-3.63,2.79A7.21,7.21,0,0,1,23.94,38a8.35,8.35,0,0,1,1.53,5q0,4.89-3.22,7.4t-9.14,2.51ZM6.82,33.09h4.91A6.83,6.83,0,0,0,15.94,32a3.87,3.87,0,0,0,1.47-3.27,4.1,4.1,0,0,0-1.48-3.48A7.29,7.29,0,0,0,11.5,24.1H6.82Zm0,4.72V47.6h6.29a6.38,6.38,0,0,0,4.14-1.17,4.27,4.27,0,0,0,1.42-3.49,5.43,5.43,0,0,0-1.21-3.81,5,5,0,0,0-3.84-1.32Z"/><path class="cls-1" d="M30.37,45.15,31,50.5h.14l2.29-5.35,12-26.31h1.41l4.06,26.31.66,5.35h.14L68.6,18.84h1.48l-18,34H50.63L46.45,24.49l-.61-3.36-.14,0-1.59,3.39L31.36,52.86H29.93l-4.09-34h1.4Z"/><path class="cls-1" d="M77.48,46.25h-10l-3.24,6.61H56l17.91-34h8.87l3.51,34H78Zm-7-6.08h6.56l-.79-11.38-.15,0Z"/><path class="cls-1" d="M85.91,23.32c0-2.79,2.28-4.57,5.09-4.57s5.09,1.78,5.09,4.57S93.8,27.88,91,27.88,85.91,26.11,85.91,23.32Zm8.94,0c0-2.13-1.71-3.39-3.85-3.39s-3.86,1.26-3.86,3.39S88.87,26.7,91,26.7,94.85,25.44,94.85,23.32Zm-6.28,0a2.41,2.41,0,0,1,2.55-2.52,2.29,2.29,0,0,1,2.31,1.5l-1.55.56a.78.78,0,0,0-.76-.65c-.66,0-.9.59-.9,1.11s.22,1.08.9,1.08a.79.79,0,0,0,.77-.63l1.47.54a2.24,2.24,0,0,1-2.23,1.5A2.41,2.41,0,0,1,88.57,23.33Z"/><text class="cls-2" transform="translate(42.88 10.28)">A</text><text class="cls-3" transform="translate(24.53 71.49)">WEBSITE</text></g></g></svg></a>
        </section>
	</footer>
	<?php wp_footer(); ?>
</body>
</html>
