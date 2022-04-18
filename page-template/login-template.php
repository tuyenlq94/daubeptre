<?php

/**
 * Template name: Login Page
 * @author : Hy Hý
 */
if( is_user_logged_in(  ) ) {
    if( isset( $_GET['redirect']) ) {
        wp_redirect( $_GET['redirect'] );exit;
    }
    wp_redirect( home_url(  ) );exit;
}
get_header();
while (have_posts()) :
    the_post();
?> 
            <main class="main main-auth main-auth-login">
				<section class="auth sec-60" data-aos="fade">
					<div class="container">
						<div class="auth-nav --mb-50">
							<?php get_template_part( 'patch/auth' , 'nav' ) ?>
						</div>
						<div class="auth-title --mb-50">
							<h2 class="main-title tt-40 --s-cl" data-aos="fade-up">
								<?php the_title() ?>
							</h2>
							<div class="desc mona-content" data-aos="fade-up" data-aos-delay="100">
                                <?php the_content(  ) ?>
							</div>
						</div>
						<div class="auth-form">
							<form action="#" id="mona-login-form">
								<div class="auth-form-grid --mb-30">
									<div class="f-group" data-aos="fade-up" data-aos-delay="150">
										<label for="#">
											Tài khoản <span class="--s-cl">*</span>
										</label>
										<input type="text" class="f-control" placeholder="Nhập email, số điện thoại hoặc tên tài khoản ..." name="user_name"/>
									</div>
									<div class="f-group" data-aos="fade-up" data-aos-delay="150">
										<label for="#">
											Mật khẩu <span class="--s-cl">*</span>
										</label>
										<input type="password" class="f-control" placeholder="Nhập mật khẩu" name="user_pass"/>
									</div>
								</div>
								<div
									class="auth-remember --mb-30"
									data-aos="fade-up"
									data-aos-delay="200" >
									<label for="remember" class="custom-checkbox">
										<input type="checkbox" id="remember"  name="user_remember"/>
										<span class="checkmark"></span>
										<p>Ghi nhớ tài khoản</p>
									</label>
								</div>
								<div class="f-submit" data-aos="fade-up" data-aos-delay="200">
									<button type="submit" class="main-btn main-btn-ajax">Đăng nhập</button>
								</div>
                                <div id="response-login"></div>
							</form>
						</div>
					</div>
					<div class="auth-bg">
						<img src="<?php echo site_url('template') ?>/images/bg-login.png" alt="" />
					</div>
				</section>
			</main>
<?php
endwhile;
get_footer();
?>