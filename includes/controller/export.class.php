<?php

class MonaExportClass extends MonaDefaultClass {

	public function __construct() {

	}
	public function __call_hook() {
		add_action( 'wp_ajax_m_a_export_teams', [ $this, 'ajax_export_teams' ] );
		add_action( 'wp_ajax_m_a_export_users', [ $this, 'ajax_export_users' ] );
		add_action( 'admin_menu', [ $this, 'create_menu_export' ], 999, 1 );

	}
	/***
	 * 1 nhóm 1 column
	 */
	public function _export_all_teams() {
		$TeamClass = new MonaTeamsClass();
		$allTeams  = $TeamClass->list_all_teams_query();
		$data      = [
			[ 'Nhóm', 'Trường', 'Điểm Tuần 1', 'Thời gian', 'Điểm Tuần 2', 'Thời gian', 'Điểm Tuần 3', 'Thời gian', 'Thời gian lập nhóm' ],
		];
		while ( $allTeams->have_posts() ) {
			$allTeams->the_post();

			$TeamId = get_the_ID();

			$authorId     = get_post_field( 'post_author', $TeamId );
			$authorSchool = get_the_author_meta( '_school', $authorId );

			$listIdUsers = get_post_meta( $TeamId, '_list_user_team', true );
			$testIds     = get_field( 'choose_page_ki_thi', M_P_HOME );
			$testPoint   = [];
			$testTime    = [];
			foreach ( $testIds as $key => $testId ) {
				$point = 0;
				$time  = 0;
				if ( is_array( $listIdUsers ) ) {
					foreach ( $listIdUsers as $k => $userId ) {
						$time  += get_post_meta( $testId, '_time_done_user_test_' . $userId, true );
						$point += get_user_meta( $userId, '_point_test_' . $testId, true );
					}
				}
				$testPoint[] = $point;
				$testTime[]  = $time;
			}

			$school     = $authorSchool;
			$time       = get_the_time( 'H:i:s d/m/Y' );
			$dataColumn = [
				get_the_title(), // tên nhóm.
				$school,
				@$testPoint[0],
				gmdate( 'H:i:s', @$testTime[0] ),
				@$testPoint[1],
				gmdate( 'H:i:s', @$testTime[1] ),
				@$testPoint[2],
				gmdate( 'H:i:s', @$testTime[2] ),
				$time,
			];
			$data[]     = $dataColumn;
		}wp_reset_query();
		return $data;
	}
	public function _export_all_user() {
		$data      = [
			[
				'Tên',
				'Lớp',
				'Trường',
				'Quận',
				'Ngày sinh',
				'Số điện thoại',
				'Email',
				'Địa chỉ nhà',
				'Nhóm',
				'Điểm tuần 1',
				'Giời gian',
				'Điểm tuần 2',
				'Giời gian',
				'Điểm tuần 3',
				'Giời gian',
				'Ngày đăng ký',
			],
		];
		$UserClass = new MonaUserClass();
		$userAll   = $UserClass->get_all_user();
		foreach ( $userAll as $key => $userId ) {
			$userData        = $UserClass->get_data_user( $userId );
			$userDataWp      = get_userdata( $userId );
			$teamId          = get_user_meta( $userId, '_team_id', true );
			$titleTeam       = get_the_title( $teamId );
			$registered_date = date( 'd/m/Y', strtotime( $userDataWp->user_registered ) );
			// point and time
			$testIds = get_field( 'choose_page_ki_thi', M_P_HOME );
			$time    = 0;
			$point   = 0;
			$timeArr = $pointArr = [];
			foreach ( $testIds as $key => $testId ) {
				$time  = (int) get_post_meta( $testId, '_time_done_user_test_' . $userId, true );
				$point = (int) get_user_meta( $userId, '_point_test_' . $testId, true );

				$timeArr[]  = $time;
				$pointArr[] = $point;
			}

			$dataColumn = [
				@$userData['name'],
				@$userData['_class'],
				@$userData['_school'],
				@$userData['_block'],
				@$userData['_birthday'],
				@$userData['_phone'],
				@$userData['email'],
				@$userData['_address'],
				$titleTeam,
				@$pointArr[0],
				gmdate( 'H:i:s', @$timeArr[0] ),
				@$pointArr[1],
				gmdate( 'H:i:s', @$timeArr[1] ),
				@$pointArr[2],
				gmdate( 'H:i:s', @$timeArr[2] ),
				$registered_date,
			];
			$data[]     = $dataColumn;
		}
		return $data;
	}
	public function html_page_export() {
		get_template_part( 'patch/admin/export' );
	}
	public function create_menu_export() {
		$urlImage = get_template_directory_uri() . '/images/export-2.png';
		add_menu_page( 'Custom Export', 'Custom Export', 'manage_options', 'mona-export-data', [ $this, 'html_page_export' ], $urlImage, 3 );
		?>
		<style>
			.wp-menu-image.dashicons-before img{
				max-width: 20px;
			}
		</style>
		<?php
	}
	public function ajax_export_teams() {
		$data = $this->_export_all_teams();

		if ( is_array( $data ) ) {

			foreach ( $data as $key => $column ) {

				$column = str_replace( ',', '/', $column );

				echo ( implode( ',', array_values( $column ) ) ) . "\n";

			}
		}
		exit;
	}
	public function ajax_export_users() {
		$data = $this->_export_all_user();

		if ( is_array( $data ) ) {

			foreach ( $data as $key => $column ) {

				$column = str_replace( ',', '/', $column );

				echo ( implode( ',', array_values( $column ) ) ) . "\n";

			}
		}
		exit;
	}
}
( new MonaExportClass() )->__call_hook();
