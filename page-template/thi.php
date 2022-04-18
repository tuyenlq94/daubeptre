<?php

/**
 * Template name:  Thi  Page
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
	$TeamClass = new MonaTeamsClass();
	$QuizClass = new MonaQuizClass();
	$checkTime = get_field( 'time_end_test' );
	$userId    = get_current_user_id();
	$postId    = get_the_ID();
	$checkTurn = $UserClass->check_user_has_thi( $userId, $postId );

	// check team

	$listMyTeam = $TeamClass->list_my_team( $userId );
	if ( is_array( $listMyTeam ) and count( $listMyTeam ) == 3 ) {
		if ( $QuizClass->check_time_test( $postId ) == 3 ) { // đang diễn ra
			if ( $checkTurn ) { // chưa thi
				get_template_part( 'patch/test/main' );
			} elseif ( @$_GET['action'] == 'xem-ket-qua' ) {
				get_template_part( 'patch/test/main', 'result' );
			} else { // thi rồi
				get_template_part( 'patch/test/main', 'done' );
			}
		} else { // hết hạn
			if ( $checkTurn ) { // chưa thi
				get_template_part( 'patch/test/main', 'done' );
			} elseif ( @$_GET['action'] == 'xem-ket-qua' ) { // thi rồi
				get_template_part( 'patch/test/main', 'result' );
			} else {
				get_template_part( 'patch/test/main', 'done' );
			}
		}
	} else {
		get_template_part( 'patch/test/main', 'done' );
	}

endwhile;
get_footer();

