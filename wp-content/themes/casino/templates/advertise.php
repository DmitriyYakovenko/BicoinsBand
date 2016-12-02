<?php
/**
 * Template name: Advertise
 */
?>
<?php get_header(); ?>
    <div class="wrapper contakt">
        <div class="container">
            <div class="row">
                <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9">
                    <div class="forma forma2">
                        <h1><?php
                            if(ICL_LANGUAGE_CODE == 'ru') {
                                echo 'Связаться';
                            }
                            else {
                                echo 'Advertise With Us';
                            }
                            ?></h1>
                        <form id="client-request2">
					<span class="input input--madoka">
					<input class="input__field input__field--madoka" type="text" name="name" id="input-31" />
					<label class="input__label input__label--madoka" name="" for="input-31">
                        <svg class="graphic graphic--madoka" width="100%" height="100%" viewBox="0 0 404 77" preserveAspectRatio="none">
                            <path d="m0,0l404,0l0,77l-404,0l0,-77z"/>
                        </svg>
                        <span class="input__label-content input__label-content--madoka"><?php
                            if(ICL_LANGUAGE_CODE == 'ru') {
                                echo '*Ваше имя';
                            }
                            else {
                                echo 'Your Name (required)';
                            }
                            ?></a></span>
                    </label>
				</span>
				<span class="input input--madoka">
					<input class="input__field input__field--madoka" type="text" id="input-32" name="email" />
					<label class="input__label input__label--madoka" for="input-32">
                        <svg class="graphic graphic--madoka" width="100%" height="100%" viewBox="0 0 404 77" preserveAspectRatio="none">
                            <path d="m0,0l404,0l0,77l-404,0l0,-77z"/>
                        </svg>
                        <span class="input__label-content input__label-content--madoka"><?php
                            if(ICL_LANGUAGE_CODE == 'ru') {
                                echo '*Ваша почта';
                            }
                            else {
                                echo 'Your Email (required)';
                            }
                            ?></span>
                    </label>
				</span>
				<span class="input input--madoka">
					<input class="input__field input__field--madoka" type="text" id="input-33" name="subject" />
					<label class="input__label input__label--madoka" for="input-33">
                        <svg class="graphic graphic--madoka" width="100%" height="100%" viewBox="0 0 404 77" preserveAspectRatio="none">
                            <path d="m0,0l404,0l0,77l-404,0l0,-77z"/>
                        </svg>
                        <span class="input__label-content input__label-content--madoka"><?php
                            if(ICL_LANGUAGE_CODE == 'ru') {
                                echo 'Тема';
                            }
                            else {
                                echo 'Subject';
                            }
                            ?></span>
                    </label>
				</span>
					<span class="input input--madoka">
					<input class="input__field input__field--madoka" type="text" id="input-34" name="website" />
					<label class="input__label input__label--madoka" for="input-34">
                        <svg class="graphic graphic--madoka" width="100%" height="100%" viewBox="0 0 404 77" preserveAspectRatio="none">
                            <path d="m0,0l404,0l0,77l-404,0l0,-77z"/>
                        </svg>
                        <span class="input__label-content input__label-content--madoka"><?php
                            if(ICL_LANGUAGE_CODE == 'ru') {
                                echo 'Сайт';
                            }
                            else {
                                echo 'Website';
                            }
                            ?></span>
                    </label>
				</span>
					<span class="input input--madoka">
					<input class="input__field input__field--madoka" type="text" id="input-35" name="message" />
					<label class="input__label input__label--madoka" for="input-35">
                        <svg class="graphic graphic--madoka" width="100%" height="100%" viewBox="0 0 404 77" preserveAspectRatio="none">
                            <path d="m0,0l404,0l0,77l-404,0l0,-77z"/>
                        </svg>
                        <span class="input__label-content input__label-content--madoka"><?php
                            if(ICL_LANGUAGE_CODE == 'ru') {
                                echo 'Сообщение';
                            }
                            else {
                                echo 'Your Message';
                            }
                            ?></span>
                    </label>
				</span>

                            <input type="submit" value="<?php
                            if(ICL_LANGUAGE_CODE == 'ru') {
                                echo 'Отправить';
                            }
                            else {
                                echo 'SEND';
                            }
                            ?>" class="button-red button-send">
                            <div class="response"></div>
                        </form>
                        <div class="soc soc-2">
                            <ul>
                                <li><a href="https://www.facebook.com/BitcoinsBand/<?php echo $options['facebook']; ?>" target=blanc class="fb fb-2"></a></li>
                                <li><a href="https://twitter.com/BitcoinsBand<?php echo $options['twitter']; ?>" target=blanc class="tw tw-2"></a></li>
                            </ul>
                        </div>
                    </div>
					
                    <div class="about-as">
					
                        <?php if(have_posts()) {
                            while(have_posts()) {
                                the_post();
                                the_content();
                            }
                        } ?>
                    </div>
                </div>
				
                <?php get_sidebar(); ?>
            </div>
           </div> 
    </div>


<?php get_footer(); ?>