
	<main class="main main-test">
		<section class="test frame sec-60" data-aos="fade">
			<div class="container">
				<div class="frame-title --mb-40">
					<h2 class="main-title tt-30 --s-cl t-capitalize" data-aos="fade-up">
						<?php
						$UserClass = new MonaUserClass();
						$TeamClass = new MonaTeamsClass();
						$userId    = get_current_user_id();
						// check team
						$listMyTeam = $TeamClass->list_my_team( $userId );
						// var_dump( $listMyTeam );
						if ( is_array( $listMyTeam ) and count( $listMyTeam ) == 3 ) {
							$checkTurn = $UserClass->check_user_has_thi( $userId, get_the_ID() );
							// var_dump( $checkTurn );
							$QuizClass = new MonaQuizClass();
							$postId    = get_the_ID();
							$checkTime = $QuizClass->check_time_test( $postId );

							if ( ! $checkTurn ) { // đã thi
								echo __( 'Bạn chỉ được thi 1 lần <br>', 'monamedia' );
								echo ' <a href="' . get_permalink() . '?action=xem-ket-qua" class="main-btn">xem kết quả</a>';
							} elseif ( $checkTime == 2 ) {
								echo __( 'Kì thi vẫn chưa diễn ra', 'monamedia' );
							} elseif ( $checkTime == 4 ) {
								echo __( 'Kì thi đã kết thúc', 'monamedia' );
							}
						} else {
							echo __( 'Nhóm bạn chưa đủ người <br>', 'monamedia' );
							echo ' <a href="' . get_permalink( M_P_CHOOSE_TEAM ) . '" class="main-btn">Thêm đồng đội</a>';
						}
						?>
					</h2>
				</div>
				<div class="frame-bg">
					<img src="<?php echo site_url(); ?>/template/images/bg-child.png" alt="#" />
				</div>
			</div>
		</section>
	</main>
