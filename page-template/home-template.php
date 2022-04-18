<?php

/**
 * Template name: Home Page
 * @author : Hy Hý
 */
get_header();
while ( have_posts() ) :
	the_post();
	?>

	<main class="main main-home">
		<section class="banner" data-aos="fade">
			<div class="banner-wrap">
				<div class="container">
					<div class="banner-content">
						<div class="banner-logo" data-aos="zoom-in">
							<?php
							$image = get_field( 'banner_logo_home' );
							$size  = 'full';
							echo wp_get_attachment_image( $image, $size )
							?>
						</div>
						<div class="banner-img-list">
							<div class="banner-img banner-img-1" data-aos="zoom-out" data-aos-delay="100">
								<?php
								$image = get_field( 'banner_thi_tai_1' );
								$size  = 'full';
								echo wp_get_attachment_image( $image, $size )
								?>
							</div>
							<div class="banner-img banner-img-2" data-aos="zoom-out" data-aos-delay="150">
								<?php
								$image = get_field( 'banner_thi_tai_2' );
								$size  = 'full';
								echo wp_get_attachment_image( $image, $size )
								?>
							</div>
							<div class="banner-img banner-img-3" data-aos="zoom-out" data-aos-delay="200">
								<?php
								$image = get_field( 'banner_thi_tai_3' );
								$size  = 'full';
								echo wp_get_attachment_image( $image, $size )
								?>
							</div>
							<div class="banner-img banner-img-4" data-aos="zoom-out" data-aos-delay="250">
								<?php
								$image = get_field( 'banner_thi_tai_4' );
								$size  = 'full';
								echo wp_get_attachment_image( $image, $size )
								?>
							</div>
						</div>
						<div class="scrolldown-btn">
							<a class="custom-scroll" href="#scrolldown-here">
								<i class="fa fa-angle-down" aria-hidden="true"></i>
							</a>
						</div>
						<div class="content" data-aos="fade-up" data-aos-delay="100">
							<h2 class="main-title tt-40 --s-cl"><?php echo get_field( 'tieu_de_dau_bep_tre' ) ?></h2>
							<p class="desc">
							   <?php echo get_field( 'noi_dung_cap_bep_tre' ) ?>
							</p>
						</div>
					</div>
				</div>
			</div>
			<div class="banner-decor" data-aos="zoom-in">
				<img src="<?php echo site_url(); ?>/template/images/bg-home-2.png" alt="" />
			</div>
		</section>
		<section id="scrolldown-here" class="progress" data-aos="fade">
			<div class="container">
				<div class="is-slider-mobile --auto --swiper-pag">
					<div class="swiper-container">
						<div class="progress-track">
							<img src="<?php echo site_url(); ?>/template/images/progress-track.png" alt="" data-aos="zoom-in" />
						</div>
						<div class="swiper-wrapper">
						<?php
						$list_cot_moc_cuoc_thi = get_field( 'cot_moc_cuoc_thi_home', get_the_ID() );
						if ( $list_cot_moc_cuoc_thi ) {
							foreach ( $list_cot_moc_cuoc_thi as $key => $item_cot ) {
								?>
									 <div class="swiper-slide" data-aos="<?php echo ( $key % 2 == 0 ? 'fade-down' : 'fade-up' ) ?>">
										<div class="c-progress">
											<div class="c-progress__content">
												<h3 class="main-title t-uppercase"><?php echo $item_cot['tieu_de_cot_moc_home'] ?></h3>
												<p class="desc">
											   <?php echo $item_cot['noi_dung_cot_moc'] ?>
												</p>
											</div>
											<div class="c-progress__dot"></div>
											<div class="c-progress__date">
												<p class="main-title tt-60 f-oswald"><?php echo $item_cot['ngay_bat_dau_thi'] ?></p>
												<div class="month t-uppercase"><?php echo $item_cot['thang_thi'] ?></div>
											</div>
										</div>
									</div>
									<?php
							}
						}
						?>
						</div>
						<div class="swiper-pagination"></div>
					</div>
					<div class="swiper-button-wrap">
						<div class="swiper-button-prev"></div>
						<div class="swiper-button-next"></div>
					</div>
				</div>
			</div>
		</section>
		<section class="competition" data-aos="fade">
			<div class="container">
				<div class="competition-wrap">
					<h2 class="main-title tt-40 --s-cl --mb-30" data-aos="fade-left">
						Đếm ngược các vòng thi
					</h2>
					<div class="competition-list">
						<?php
						$ids       = get_field( 'choose_page_ki_thi' );
						$args      = [
							'post_type' => 'page',
							'post__in'  => $ids,
							'orderby'   => 'post__in',
						];
						$testQuery = new WP_Query( $args );
						$QuizClass = new MonaQuizClass();
						$img       = 1;
						while ( $testQuery->have_posts() ) {
							$testQuery->the_post();
							$checkTime = $QuizClass->check_time_test( get_the_ID() );
							?>
								<div class="c-competition --mb-30" data-aos="fade-up">
									<div class="c-competition__img">
										<?php the_post_thumbnail( '600x370' ) ?>
									</div>
									<div class="c-competition__content">
										<?php $time = get_field( 'time_end_test' ) ?>
										<div class="countdown cd__time --mb-25" data-end-time="<?php echo $time ?> 23:59:59">
											<div class="countdown-item" data-aos="zoom-in" data-aos-delay="100">
												<div class="num day f-oswald">0</div>
												<p class="tt">Ngày</p>
											</div>
											<span class="dc" data-aos="zoom-in" data-aos-delay="100">:</span>
											<div class="countdown-item" data-aos="zoom-in" data-aos-delay="150">
												<div class="num hours f-oswald">0</div>
												<p class="tt">Giờ</p>
											</div>
											<span class="dc" data-aos="zoom-in" data-aos-delay="150">:</span>
											<div class="countdown-item" data-aos="zoom-in" data-aos-delay="200">
												<div class="num minutes f-oswald">0</div>
												<p class="tt">Phút</p>
											</div>
										</div>
										<div class="content" data-aos="fade-up" data-aos-delay="250">
											<p class="title"><?php the_title() ?></p>
											<div class="desc --mb-25">
												<?php the_excerpt() ?>
											</div>
											<?php
											$now = strtotime( 'now' );
											if ( $checkTime == 4 ) {
												echo '<p class="main-btn btn-yellow">Đã kết thúc</p>';
											} else {
												echo '<a href="' . get_permalink( M_P_THELE ) . '" class="main-btn btn-yellow">Tham gia</a>';
											}
											?>
										</div>
										<img src="<?php echo site_url(); ?>/template/images/c-competition-decor-<?php echo ( $img % 2 == 0 ? '2' : '1' ) ?>.png" class="decor" alt="" />
									</div>
								</div>
							<?php

							$img++;
						}wp_reset_query();
						?>

					</div>
				</div>
			</div>
			<div class="competition-decor">
				<img src="<?php echo site_url(); ?>/template/images/bg-competition-2.png" alt="" />
			</div>
		</section>
		<?php get_template_part( 'patch/rank' ) ?>

		<?php
		 $page            = max( 1, get_query_var( 'paged' ) );
				$ofset    = ( $page - 1 ) * 6;
				$args     = array(
					'post_type'      => 'post',
					'posts_per_page' => 6,
					'page'           => $page,
					'offset'         => $ofset,
				);
				$my_query = new WP_Query( $args );
				?>
		<section class="review" style="display:none" data-aos="fade">
			<div class="review-item">
				<div class="review-img">
					<?php
					$image = get_field( 'hinh_anh_tin_tuc_1_home' );
					$size  = 'full';
					echo wp_get_attachment_image( $image, $size )
					?>
				</div>
				<div class="review-apso" data-aos="zoom-out" data-aos-delay="100">
					<div class="container">
					<?php
					$count = 0;
					while ( $my_query->have_posts() && $count < 1 ) {
						$my_query->the_post();
						?>
						<div class="review-content">
							<div class="content">
								<h2 class="main-title tt-30">
								   <?php the_title() ?>
								</h2>
								<p class="date t-uppercase">
								<?php
									$timeago = vi_human_time_diff( get_the_time( 'U' ), current_time( 'timestamp' ) );
								if ( $timeago == false ) {
									the_time( 'd/m/Y' );
								} else {
									echo $timeago . ' trước';
								}
								?>
								</p>
								<a href="<?php the_permalink() ?>" class="readmore-btn"><?php echo __( 'Xem thêm', 'monamedia' ) ?></a>
							</div>
						</div>
						<?php
						 $count++; }
						wp_reset_query()
					?>
					</div>
				</div>
			</div>
		</section>
		<section class="sec-100 sec-homenews" style="display:none">
			<div class="container">
				<div class="cols">
					<div class="col">
						<div class="homenews-infobox">
							<h2 class="main-title tt-40 --s-cl --mb-30" data-aos="fade-right">
							<?php echo get_field( 'title_tin_tuc' ) ?>
							</h2>
							<p class="--mb-30" data-aos="fade-right" data-aos-delay="100">
								<?php echo get_field( 'title_tin_cap_nhap' ) ?>
							</p>
							<a href="<?php echo get_the_permalink( MONA_POSTS ) ?>" class="main-btn btn-border" data-aos="fade-right " data-aos-delay="150"><?php echo __( 'Xem tất cả tin', 'monamedia' ) ?></a>
						</div>
					</div>
					<div class="col">
						<div class="homenews-slider-wrap">
							<div class="is-slider is-slider-common --swiper-navigate --loop">
								<div class="swiper-container">
									<div class="swiper-wrapper">
										<?php
										$time_tin_tuc = 0;
										while ( $my_query->have_posts() ) {
											$time_tin_tuc += 100;
											$my_query->the_post();
											?>
											<div class="swiper-slide" data-aos="fade-up" data-aos-delay="100">
												<div class="newsbox">
													<a href="<?php the_permalink() ?>" class="img"><?php the_post_thumbnail( '360x235' ) ?></a>
													<div class="cont">
														<p class="times">
														<?php
															$timeago = vi_human_time_diff( get_the_time( 'U' ), current_time( 'timestamp' ) );
														if ( $timeago == false ) {
															the_time( 'd/m/Y' );
														} else {
															echo $timeago . ' trước';
														}
														?>
														</p>
														<p class="title">
															<a href="<?php the_permalink() ?>">
															   <?php the_title() ?></a>
														</p>
														<a href="<?php the_permalink() ?>" class="readmore-btn"><?php echo __( 'Xem thêm', 'monamedia' ) ?></a>
													</div>
												</div>
											</div>

											<?php
										}
										$time_tin_tuc++;
										wp_reset_query()
										?>
									</div>
									<div class="swiper-pagination"></div>
								</div>
								<div class="swiper-button-wrap" data-aos="flip-left">
									<div class="swiper-button-prev"></div>
									<div class="swiper-button-next"></div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
	</main>
	<?php
endwhile;
get_footer();
?>
