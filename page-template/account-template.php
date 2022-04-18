<?php

/**
 * Template name: Info user Page
 * @author : Hy Hý
 */
if ( ! is_user_logged_in() ) {
	wp_redirect( get_permalink( M_P_LOGIN ) . '?redirect=' . get_permalink() );
	exit;
}
get_header();
while ( have_posts() ) :
	the_post();
	$UserClass = new MonaUserClass();
	$userId    = get_current_user_id();
	if ( isset( $_GET['view-user'] ) and $_GET['view-user'] != '' and $UserClass->user_id_exists( $userId ) ) {
		$userId = $_GET['view-user'];
	}
	$userData = $UserClass->get_data_user( $userId );
	?>
	<main class="main main-info">
		<section class="info frame sec-60" data-aos="fade">
			<div class="container">
				<div class="frame-title --mb-40">
					<h2 class="main-title tt-30 --s-cl t-capitalize" data-aos="fade-up">
						Bảng Báo Danh
					</h2>
				</div>
				<div class="frame-content">
					<div class="frame-content-wrap">
						<div class="frame-table" data-aos="zoom-out" data-aos-delay="100">
							<?php
							$dataArray = [
								'_avatar'   => 'Ảnh đại diện',
								'name'      => 'Họ và tên',
								'_birthday' => 'Ngày tháng năm sinh',
								'_class'    => 'Lớp',
								'_block'    => 'Quận',
								'_school'   => 'Trường',
								'_phone'    => 'Số điện thoại',
								'_address'  => 'Địa chỉ nhà',
								'email'     => 'Email',
							];
							if ( isset( $_GET['action'] ) and $_GET['action'] == 'edit' ) { // edit
								?>
								<form action="" id="m-edit-user">
									<div class="wrap-columns">
										<?php
										foreach ( $dataArray as $key => $title ) {
											?>
											<div class="column">
												<label for="id-form-<?php echo $key ?>">
													<?php echo $title ?> <span class="--s-cl">*</span>
												</label>
												<?php
												$value  = ( $userData[ $key ] != '' ? $userData[ $key ] : '' );
												$status = 'name="' . $key . '"';
												if ( $key == '_phone' or $key == 'email' ) {
													$status = 'readonly';
												}

												$type = ( $key == '_birthday' ? 'date' : 'text' );

												if ( $key == '_block' ) {
													$blocks = [ 'Quận 1', 'Quận 2', 'Quận 3', 'Quận 4', 'Quận 5', 'Quận 6', 'Quận 7', 'Quận 8', 'Quận 9', 'Quận 10', 'Quận 11', 'Quận 12', 'Quận Bình Thạnh', 'Quận Gò Vấp', 'Quận Phú Nhuận', 'Quận Tân Bình', 'TP. Thủ Đức', 'Huyện Bình Chánh', 'Huyện Cần Giờ', 'Huyện Củ Chi', 'Huyện Hóc Môn', 'Huyện Nhà Bè', 'Quận Tân Phú', 'Quận Bình Tân' ];
													?>
													<select  required name="_block" id="" class="f-control">
														<option value="">Chọn Quận</option>
														<?php
														foreach ( $blocks as $bTitle ) {
															$selected = '';
															if ( $bTitle == $value ) {
																$selected = 'selected';
															}
															echo '<option ' . $selected . ' value="' . $bTitle . '">' . $bTitle . '</option>';
														}
														?>
													</select>

														<?php
												} elseif ( $key == '_avatar' ) {
													if ( $value == '' ) {
														$value = M_AVATAR_USER_DEFAULT;
													}
													?>
													<div class="avatar-upload">
														<div class="avatar-upload-img mona-upload-loading">
															<div class="ratio-box main-btn-ajax">
																<img src="" alt="" id="js-upload-image-preview">
																<?php
																	echo wp_get_attachment_image( $value, '', false, array( 'class' => 'image-custom-user' ) );
																?>
															</div>
														</div>
														<div class="avatar-upload-info">
															<h4 class="avatar-upload-info-title"><?php echo __( 'Chọn hình ảnh khác', 'monamedia' ) ?></h4>
															<label for="js-upload-image-btn" class="upload-btn"><i class="fa fa-upload" aria-hidden="true"></i> <?php echo __( 'Tải ảnh lên', 'monamedia' ) ?></label>
															<input type="file" name="file-img" id="js-upload-image-btn" hidden>
															<input type="text" value="" id="id-file-img" name="id-file-img" hidden>
															<p class="avatar-upload-info-desc"><?php echo __( 'Chấp nhận jpg, png, gif và ảnh chỉ <= 2.0M Size', 'monamedia' ) ?></p>
														</div>
													</div>
														<?php
												} elseif ( $key == '_phone' or $key == 'email' ) {
														echo '<p>' . $value . '</p>';
												} else {
													?>
													<input type="<?php echo $type ?>" class="f-control"  <?php echo $status ?> id="id-form-<?php echo $key ?>" value="<?php echo $value ?>">
													<?php
												}
												?>
											</div>
											<?php
										}
										?>
										<div id="response-messenger"> </div>
									</div>
								</form>
								<?php
							} else { // show
								?>
								<table>
									<tbody>
										<tr>
											<td>ID <span class="--s-cl">*</span></td>
											<td><b> <?php echo $userId ?></b></td>
										</tr>
										<?php
										foreach ( $dataArray as $key => $value ) {
											?>
											<tr>
												<td><?php echo $value ?> <span class="--s-cl">*</span></td>
												<?php
												if ( $key == '_avatar' ) {
													echo '<td><div class="wrap-img">' . wp_get_attachment_image( $userData[ $key ], '200x200' ) . '</div></td>';
												} elseif ( $key == '_phone' ) {
													?>
												<td><?php echo ( $userData[ $key ] != '' ? '*******' . substr( $userData[ $key ], -3 ) : 'N/A' ) ?></td>
													<?php
												} else {
													?>
												<td><?php echo ( $userData[ $key ] != '' ? $userData[ $key ] : 'N/A' ) ?></td>
													<?php
												}
												?>
											</tr>
											<?php
										}
										?>
									</tbody>
								</table>
								<?php
							}
							?>
						</div>
					</div>
					<div class="frame-btn">
						<?php
						if ( ! isset( $_GET['view-user'] ) ) {
							if ( isset( $_GET['action'] ) and $_GET['action'] == 'edit' ) {
								echo '<a href="#" class="main-btn btn-red m-action-save-user-info main-btn-ajax"
                                data-aos="fade-up" data-aos-delay="150">Lưu</a>';
							} else {
								?>
								<a href="#popup-baodanh" class="main-btn btn-green open-popup-btn" data-aos="fade-up" data-aos-delay="150">
									Bắt đầu thi
								</a>
								<a href="?action=edit" class="main-btn btn-red" data-aos="fade-up" data-aos-delay="150">
									Chỉnh sửa
								</a>
								<?php
							}
						} else {
							?>
							<!-- <a href="#" class="main-btn btn-red main-btn-ajax m-invite-team"
							data-userId=<?php // echo $_GET['view-user'] ?> data-aos="fade-up" data-aos-delay="150">
								Mời vào đội
							</a> -->
							<?php
						}
						?>
					</div>
				</div>
				<div class="frame-bg">
					<img src="<?php echo site_url( 'template' ) ?>/images/bg-child.png" alt="" />
				</div>
			</div>
		</section>
	</main>
	<?php
endwhile;
get_footer();
?>
