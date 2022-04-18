<?php

/**
 * Template name: trang cá nhân Page
 * @author : Hy Hý
 */
if ( ! is_user_logged_in() ) {
	wp_redirect( get_permalink( M_P_LOGIN ) . '?redirect=' . get_permalink() );
	exit;
}
get_header();
while ( have_posts() ) :
	the_post();
	$userId       = get_current_user_id();
	$UserClass    = new MonaUserClass();
	$UserDoiclass = new MonaUserDoi();
	$TeamClass    = new MonaTeamsClass();
	$userData     = $UserClass->get_data_user( $userId );
	$userDoi      = $UserDoiclass->danh_saoi_doi( $userId );
	$dataMyTeam   = $TeamClass->list_my_team( $userId );
	$checkTeam    = ( ! is_array( $dataMyTeam ) or count( $dataMyTeam ) < 3 );
	$teamId       = get_user_meta( $userId, '_team_id', true );

	?>
	<style>
		.frame-table tr {
			height: 5rem;
			border-bottom: 1px solid #d6d6d6;
		}
	</style>
	<main class="main main-account">
		<section class="account frame sec-60">
			<div class="container">
				<div class="frame-title --mb-40">
					<h2 class="main-title tt-30 --s-cl t-capitalize" data-aos="fade-up">
						<?php the_title() ?>
					</h2>
				</div>
				<div class="frame-content">
					<div class="account-wrap" data-aos="zoom-out" data-aos-delay="100">
						<div class="cols">
							<div class="col left">
								<div class="account-main">
									<div class="account-title">
										<ul class="tabs">
											<li class="tab-link --active" data-tabs="#tab-content-1">
												<?php echo __( 'Thông tin chung', 'monamedia' ) ?>
											</li>
											<li class="tab-link" data-tabs="#tab-content-2">
												<?php echo __( 'Điểm thi', 'monamedia' ) ?>
											</li>
										</ul>
									</div>
									<div class="account-tab-content">
										<div class="tab-content --active" id="tab-content-1">
											<div class="frame-table">
												<table>
													<tbody>

														<?php
														$noidung_Array = [
															'name' => 'Họ và Tên',
															'_birthday' => 'Ngày tháng năm sinh',
															'_class' => 'Lớp',
															'_block' => 'Quận',
															'_school' => 'Trường',
															'_phone' => 'Số điện thoại',
															'_address' => 'Địa chỉ nhà',
															'email' => 'Email',
														];
														foreach ( $noidung_Array as $key => $value_item ) {
															?>
															<tr>
																<td>
																	<?php echo $value_item ?> <span class="--s-cl">*</span>
																</td>
																<td><?php echo ( $userData[ $key ] != '' ? $userData[ $key ] : 'N/A' ) ?>
																</td>
															</tr>
															<?php
														}
														?>
															<tr>
																<td>
																   ID <span class="--s-cl">*</span>
																</td>
																<td> <b><?php echo $userId ?></b> </td>
															</tr>
													</tbody>
												</table>
											</div>
										</div>
										<div class="tab-content" id="tab-content-2">
											<div class="sub-tabs --mb-30 --pt-20">
												<ul class="tabs">
													<li class="tab-link --active" data-tabs="#sub-tab-content-2">
														<?php echo __( 'Điểm thi trắc nghiệm', 'monamedia' ) ?>
													</li>
													<li class="tab-link" data-tabs="#sub-tab-content-3">
														<?php echo __( 'Điểm thi tranh tài' ) ?>
													</li>
												</ul>
											</div>
											<div class="sub-tab-content">
												<div class="tab-content --active" id="sub-tab-content-2">
													<div class="frame-table">
														<table>
															<thead>
																<tr>
																	<td><?php echo __( 'tuần', 'monamedia' ) ?></td>
																	<td><?php echo __( 'điểm', 'monamedia' ) ?></td>
																	<td><?php echo __( 'thời gian', 'monamedia' ) ?></td>
																</tr>
															</thead>
															<tbody>
																<?php
																if ( get_current_user_id() == 1 ) {
																	echo get_post_meta( $teamId, '_time_total_team', true );
																}
																$ids     = get_field( 'choose_page_ki_thi', M_P_HOME );
																$args    = [
																	'post_type' => 'page',
																	'post__in' => $ids,
																];
																$pageThi = new WP_Query( $args );
																$count   = 1;
																while ( $pageThi->have_posts() ) {
																	$pageThi->the_post();
																	$point    = get_user_meta( $userId, '_point_test_' . get_the_id(), true );
																	$timeDone = get_post_meta( get_the_id(), '_time_done_user_test_' . $userId, true );
																	if ( $point == '' and $timeDone == '' ) {
																		continue;
																	}
																	?>
																<tr>
																	<td><?php echo $count ?>. <?php the_title() ?> - <a class="thi-btn" href="<?php echo get_permalink() ?>?action=xem-ket-qua">Xem chi tiết</a></td>
																	<td><?php echo $point ?></td>
																	<td> <p class="test-time-format"><?php echo ( $timeDone == '' ? '0' : $timeDone ) ?></p></td>
																</tr>
																	<?php
																	$count++;
																} wp_reset_query();
																?>
															</tbody>
														</table>
													</div>
												</div>
												<div class="tab-content" id="sub-tab-content-3">
													<div class="frame-table">
														<table>
															<thead>
																<tr>
																	<td>tuần</td>
																	<td>Link liên kết</td>
																	<td>Điểm</td>
																</tr>
															</thead>
															<tbody>
																<tr>
																	<td><?php echo 1 ?></td>
																	<td>
																		<?php $url = get_post_meta( $teamId, '_url_test_video', true ) ?>
																		<p class="account-open-video" data-mfp-src="<?php echo $url ?>">
																			<?php echo ( $url == '' ? 'Chưa nộp' : $url ) ?>
																		</p>
																		<p class="short-link account-open-video" data-mfp-src="<?php echo $url ?>">
																			Link rút gọn
																		</p>
																	</td>
																	<td><?php echo 'Chưa chấm ..' ?></td>

																</tr>
															</tbody>
														</table>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col right">
								<div class="account-team">
									<h3 class="main-title tt-18 t-uppercase --mb-20">
										<?php echo __( 'Danh sách đội', 'monamedia' ) ?>
									</h3>
									<?php

									if ( $teamId != '' ) {
										$nameTeam = get_the_title( $teamId );
										?>
									<div class="account-form search-form">
										<form action="#" id="edit-name-team">
											<input type="hidden" name="team-id" value="<?php echo $teamId ?>">
											<input type="text" class="f-control" name="team-name"  value="<?php echo $nameTeam ?>" />
											<button type="submit " class="sm main-btn-ajax">
												<i class="fa fa-pencil" aria-hidden="true"></i>
											</button>

										</form>
									</div>
									<p id="response-messenger"> </p>
										<?php
									}
									?>
									<div class="account-team-list --mb-20">
										<?php
										if ( is_array( $dataMyTeam ) ) {
											foreach ( $dataMyTeam as $key => $teamUserId ) {
												$userData = $UserClass->get_data_user( $teamUserId );
												if ( ! $userData ) {
													continue;
												}
												$urlViewInfo = $UserClass->url_view_info_user( $teamUserId );
												?>
												<div class="c-account">
													<div class="c-account__img">
														<a href="<?php echo $urlViewInfo ?>">
															<?php
															if ( $userData['_avatar'] == '' ) {
																// echo '<img src="'.site_url('template').'/images/account-avatar.png" alt="" />';
																echo wp_get_attachment_image( M_AVATAR_USER_DEFAULT, '200x200' );
															} else {
																echo wp_get_attachment_image( $userData['_avatar'], '200x200' );
															}
															?>
														</a>
													</div>
													<div class="c-account__content">
														<p class="name"><?php echo $userData['name'] ?></p>
														<p class="id">ID: <?php echo $teamUserId ?></p>
														<a href="<?php echo $urlViewInfo ?>">Xem trang cá nhân</a>

													</div>
													<!-- <div class="c-account__btn">x</div> -->
												</div>
												<?php
											}
										}
										?>
									</div>
									<?php
									if ( $checkTeam ) {
										?>
									<div class="account-btn">
										<div class="account-add --mb-20 t-center">
											<a href="<?php echo get_permalink( M_P_CHOOSE_TEAM ) ?>" class="main-btn btn-border">
												+ Thêm đồng đội
											</a>
										</div>
										<!-- <div class="account-update t-center">
											<a href="#" class="main-btn btn-green"> Cập nhật </a>
										</div> -->
									</div>
										<?php
									}
									?>

								</div>
							</div>
						</div>
					</div>
					<div class="frame-btn">
						<a href="<?php echo get_permalink( M_P_ACCOUNT ) ?>?action=edit" class="main-btn btn-red" data-aos="fade-up" data-aos-delay="150">Sửa thông tin</a>
						<a href="#" class="main-btn btn-green mona-logout-action main-btn-ajax" data-aos="fade-up" data-aos-delay="150">Đăng xuất</a>
					</div>
				</div>
				<div class="frame-bg">
					<img src="<?php echo site_url(); ?>/template/images/bg-child.png" alt="" />
				</div>
			</div>
		</section>
	</main>
	<?php
endwhile;
get_footer(); ?>
