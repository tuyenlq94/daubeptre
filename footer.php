<footer class="footer">
	<div class="container">
		<div class="footer-top">
			<div class="cols">
				<div class="col">
					<div class="logo">
						<?php
						$footer_logo = mona_get_option( 'mona_footer_logo' );
						if ( isset( $footer_logo ) && $footer_logo != '' ) {
							echo '<a href="' . get_home_url() . '"><img src="' . $footer_logo . '" alt=""></a>';
						}
						?>
					</div>
				</div>
				<div class="col">
					<div class="footer-register">
						<?php
						if ( is_active_sidebar( 'footer-dang-ky-nhan-tin' ) ) {
							dynamic_sidebar( 'footer-dang-ky-nhan-tin' );
						}
						?>
						<p class="desc --mb-25">
							<?php echo __( 'Đăng ký nhân thông tin và sự kiện mới nhất từ chúng tôi thông qua email', 'monamedia' ) ?>
						</p>
						<?php echo do_shortcode( '[contact-form-7 id="64" title="Form newsletter"]' ) ?>

					</div>
				</div>
				<div class="col">
					<div class="footer-info">
						<p class="title tt-20 f-bold"><?php echo __( 'Thông tin liên hệ', 'monamedia' ) ?></p>
						<div class="--mb-30">
							<?php
							if ( is_active_sidebar( 'footer-thong-tin-lienhe' ) ) {
								dynamic_sidebar( 'footer-thong-tin-lienhe' );
							}
							?>
						</div>
						<ul class="social-mobile">
							<?php
							get_template_part( 'patch/social', 'icon' );
							?>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
</footer>
<!-- scroll-top  -->
<div id="scroll-top" class="scroll-top">
	<i class="fa fa-chevron-up icon-awesome"></i>
</div>
<!-- popup thể lệ thi   -->
<div class="popup-wrap" id="popup-tranh-tai">
	<div class="pu-baodanh t-center">
		<button class="pu-close mfp-btn-close">
			<img src="<?php echo site_url(); ?>/template/images/pu-close.png" alt="" />
		</button>
		<h3 class="main-title tt-24 --mb-20">
			Cuộc thi tranh tài
		</h3>
		<div class="pu-baodanh-btn">
			<form action="#" class="m-form-tranhtai" id="f-send-url-video" data-aos="fade-up" data-aos-delay="100">
				<?php
				$userId = get_current_user_id();
				$teamId = get_user_meta( $userId, '_team_id', true );
				?>
				<p class="description">
					* Gửi link video phần thi của nhóm<br>
					Mỗi nhóm chỉ được nộp 1 lần và không thể sửa.
				</p>
				<div class="wrap-messenger">
					<input type="hidden" name="team-id" value="<?php echo $teamId ?>">
					<textarea placeholder="Nội dung" class="f-control" name="url" id="" cols="30" rows="5"></textarea>
				</div>
				<div class="f-submit">
					<button type="submit" class="main-btn main-btn-ajax">Gửi</button>
				</div>
				<div class="response-messenger"> </div>
			</form>
		</div>
	</div>
</div>
<!-- popup báo danh  -->
<div class="popup-wrap" id="popup-baodanh">
	<div class="pu-baodanh t-center">
		<button class="pu-close mfp-btn-close">
			<img src="<?php echo site_url(); ?>/template/images/pu-close.png" alt="" />
		</button>
		<h3 class="main-title tt-24 --mb-20">
			Cuộc thi sắp bắt đầu rồi. Mau mau tham gia thôi nào.
		</h3>
		<div class="pu-baodanh-btn">
			<?php
			$QuizClass = new MonaQuizClass();
			$postId    = $QuizClass->get_test_now();
			?>
			<a href="<?php echo get_permalink( $postId ) ?>" class="main-btn btn-green">Tham gia</a>
			<a href="#" class="main-btn mfp-btn-close">Hủy</a>
		</div>
	</div>
</div>
<div class="popup-wrap" id="popup-before-submit">
	<div class="pu-before-submit t-center">
		<button class="pu-close mfp-btn-close">
			<img src="<?php echo site_url( 'template' ) ?>/images/pu-close.png" alt="" />
		</button>
		<h3 class="main-title tt-24 --mb-20">Xác nhận nộp bài</h3>
		<div class="--mb-20">
			<p>
				Bạn vừa hoàn thành
				<span class="count-qs tt-20 f-bold">0</span>/<span class="total-qs tt-20 f-bold">10</span>
				câu hỏi
			</p>
			<p>Bạn có chắc chắn muốn nộp bài hay không?</p>
		</div>
		<div class="pu-baodanh-btn">
			<a href="#" data-testId="<?php the_ID() ?>" class="main-btn btn-green submit-btn m-save-point main-btn-ajax">
				Nộp bài
			</a>
			<a href="#" class="main-btn mfp-btn-close">Hủy</a>
		</div>
	</div>
</div>
<div class="popup-wrap" id="popup-test-finish">
	<div class="pu-test-finish t-center box-has-ajax">
		<!-- <button class="pu-close mfp-btn-close">
			<img src="images/pu-close.png" alt="" />
		</button> -->
		<h3 class="main-title tt-24 --mb-20">Nộp bài thành công</h3>
		<div class="--mb-20">
			<input type="hidden" id="point-user" data-testId="<?php the_ID() ?>" data-timeDone="" data-totalAns="">
			<p>Số điểm mà bạn đạt được là:</p>
			<p>
				<span class="score f-bold tt-20">0</span>/<span class="total-score f-bold tt-20">0</span> điểm - <span class="submit-ans f-bold tt-20">0</span>/<span class="total-submit-ans f-bold tt-20">0</span> câu
			</p>
		</div>
		<div class="pu-test-finish-btn">
			<a href="<?php echo home_url() ?>" class="main-btn btn-border">Trở về trang chủ</a>
			<?php
			if ( get_the_ID() != M_P_TEST_EXAM ) {
				$urlView = get_permalink() . '?action=xem-ket-qua';
				echo '<a href="' . $urlView . '" class="main-btn btn-green">Xem lại kết quả</a>';
			}
			?>
		</div>
	</div>
</div>


<!-- JQUERY -->
<script src="<?php echo site_url(); ?>/template/js/libs/jquery-1.12.4.min.js"></script>
<!-- JQUERY - END-->
<!-- SWIPER -->
<script src="<?php echo site_url(); ?>/template/js/libs/swiper/swiper.min.js"></script>
<!-- SWIPER - END -->
<!-- LIGHT GALLERY -->
<script src="<?php echo site_url(); ?>/template/js/libs/light-gallery/lightgallery-all.min.js"></script>
<!-- LIGHT GALLERY - END-->
<!-- MFP -->
<script src="<?php echo site_url(); ?>/template/js/libs/magnific-popup/jquery.magnific-popup.min.js"></script>
<!-- MFP - END-->
<!-- COUNTER -->
<script src="<?php echo site_url(); ?>/template/js/libs//counter-waypoint/counter.js"></script>
<!-- COUNTER - END -->
<!-- AOS -->
<script src="<?php echo site_url(); ?>/template/js/libs/aos/aos.js"></script>
<!-- AOS - END -->
<script src="<?php echo site_url( 'template' ); ?>/js/libs/flatpickr/flatpickr.js"></script>
<script src="https://npmcdn.com/flatpickr/dist/l10n/vn.js"></script>

<!-- MAIN -->
<script src="<?php echo site_url(); ?>/template/js/main.js" type="module" defer></script>

<?php wp_footer(); ?>
</body>

</html>
