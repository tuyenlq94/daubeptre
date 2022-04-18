<?php

class MonaUserClass extends MonaDefaultClass {

	protected $_users_per_page;
	public function __construct() {
		$this->_users_per_page = 9;
	}

	public function __call_hook() {
		add_action( 'wp_ajax_nopriv_m_a_register', [ $this, 'm_a_register' ] ); // k co dang nhap
		add_action( 'wp_ajax_m_a_edit_data', [ $this, 'm_a_edit_data' ] ); // co dang nhap

		add_action( 'wp_ajax_mona_ajax_upload_post_img', [ $this, 'upload_post_img' ] ); // co dang nhap
		add_action( 'wp_ajax_m_a_save_result_test', [ $this, 'save_result_test' ] ); // co dang nhap
		add_action( 'wp_ajax_m_a_save_point', [ $this, 'save_point' ] ); // co dang nhap
		add_action( 'wp_ajax_m_a_clear_point', [ $this, 'm_a_clear_point' ] ); // co dang nhap
		add_action( 'show_user_profile', [ $this, 'user_profile_fields' ], 10, 1 );
		add_action( 'edit_user_profile', [ $this, 'user_profile_fields' ], 10, 1 );
		add_action( 'personal_options_update', [ $this, 'save_extra_user_profile_fields' ], 10, 1 );
		add_action( 'edit_user_profile_update', [ $this, 'save_extra_user_profile_fields' ], 10, 1 );

		add_action( 'add_meta_boxes', [ $this, 'mona_add_meta_boxes_page' ] );
	}
	/**
	 * ajax
	 */
	public function m_a_register() {
		$form = $error = [];
		parse_str( $_POST['data'], $form );
		if ( is_array( $form ) ) {
			foreach ( $form as $key   => $value ) {
				$form[ $key ] = strip_tags( $value );
			}
		}
				$user = get_user_by( 'email', $form['user-name'] );
		if ( $user ) {
			$error[] = 'Email đã có người đăng ký';
		}
		$user = get_user_by( 'login', $form['user-name'] );
		if ( $user ) {
			$error[] = 'Tên đăng nhập đã tồn tại';
		}
		// check phone
		$argsPhone = [
			'meta_key'   => '_phone',
			'meta_value' => $form['number-phone'],
		];
		$user      = get_users( $argsPhone );
		if ( $user ) {
			$error[] = 'Số điện thoại đã có người đăng ký';
		}
		if ( strlen( $form['password'] ) < 6 ) {
			$error[] = 'Mật khẩu phải có ít nhất 6 ký tự';
		}
		if ( $form['password'] == '' || $form['password'] != $form['password-confirm'] ) {
			$error[] = 'Mật khẩu và xác nhận mật khẩu không trùng khớp';
		}

		if ( count( $error ) > 0 ) {
			echo json_encode( $this->error_mess( $error ) );
			exit;
		}

		$args = array(
			'user_login'    => $form['user-name'],
			'user_email'    => $form['user-name'],
			'user_pass'     => $form['password'],
			'user_nicename' => $form['full-name'],
			'display_name'  => $form['full-name'],
			'nickname'      => $form['user-name'],
		);
		$ins  = wp_insert_user( $args );
		if ( is_wp_error( $ins ) ) {
			echo json_encode( $this->error_mess( $ins->get_error_message() ) );
			exit;
		}
		$args = array(
			'user_login'    => $form['user-name'],
			'user_password' => @$form['password'],
		);
		$on   = wp_signon( $args );

		update_user_meta( $ins, '_phone', $form['number-phone'] );
		update_user_meta( $ins, '_birthday', $form['birthday'] );
		update_user_meta( $ins, '_class', $form['class'] );
		update_user_meta( $ins, '_block', $form['block'] );
		update_user_meta( $ins, '_school', $form['school'] );

		echo json_encode( $this->success_mess( '' ) );
		exit;
	}
	/**
	 * add field user
	 * action 1 : show_user_profile
	 * action 2 : edit_user_profile
	 */
	public function user_profile_fields( $user ) { ?>
		<h3><?php _e( 'Extra profile information', 'blank' ); ?></h3>

		<table class="form-table">
			<?php
			$array = $this->get_array_field_extra_user();
			foreach ( $array as $key => $item ) {
				?>
			<tr>
				<th><label for="<?php echo $key ?>"><?php echo $item ?></label></th>
				<td>
					<?php
					if ( $key == '_avatar' ) {
						$imgId = get_user_meta( $user->ID, $key, true );
						if ( $imgId != '' ) {
							echo wp_get_attachment_image( $imgId, '200x200' );
						}
					} else {
						?>
						<input type="text" name="m-<?php echo $key ?>" id="<?php echo $key ?>"
						value="<?php echo esc_attr( get_the_author_meta( $key, $user->ID ) ); ?>" class="regular-text" /><br />
						<?php
					}
					?>

				</td>
			</tr>
				<?php
			}
			?>
		</table>
		<?php
	}
	public function save_extra_user_profile_fields( $user_id ) {
		if ( empty( $_POST['_wpnonce'] ) || ! wp_verify_nonce( $_POST['_wpnonce'], 'update-user_' . $user_id ) ) {
			return;
		}

		if ( ! current_user_can( 'edit_user', $user_id ) ) {
			return false;
		}

		$arrayField = $this->get_array_field_extra_user();
		foreach ( $arrayField as $key => $item ) {
			$k = 'm-' . $key;
			update_user_meta( $user_id, $key, $_POST[ $k ] );
		}

	}

	public function get_array_field_extra_user() {
		$array = [
			'_phone'    => 'Số điện thoại',
			'_birthday' => 'Sinh nhật',
			'_class'    => 'Lớp',
			'_block'    => 'Quận',
			'_school'   => 'Trường',
			'_avatar'   => 'Ảnh đại diện',
		];
		return $array;

	}
	public function get_data_user( $userId ) {
		$data = [];
		$user = get_userdata( $userId );
		if ( $user ) {
			$userData = $user->data;

			$data['name']          = $userData->display_name;
			$data['email']         = $userData->user_email;
			$dataField             = $this->get_array_field_extra_user();
			$dataField['_address'] = 'Địa chỉ nhà';
			foreach ( $dataField as $key => $title ) {
				$data[ $key ] = get_user_meta( $userId, $key, true );
			}
			return $data;
		}
		return false;

	}

	public function m_a_edit_data() {
		$data   = [];
		$userId = get_current_user_id();
		parse_str( $_POST['data'], $data );
		foreach ( $data as $key => $value ) {
			if ( $key == 'name' ) {
				wp_update_user( [
					'ID'           => $userId,
					'display_name' => $value,
				]
				);
			} else {
				update_user_meta( $userId, $key, $value );
			}
		}
		echo json_encode( $this->success_mess( '' ) );
		exit;
	}
	public function get_display_name( $userId ) {

		if ( ! $user = get_userdata( $userId ) ) {
			return false;
		}
		return $user->data->display_name;

	}

	public function upload_post_img() {
		$f = $_POST['data'];

		$data = getimagesize( $f );

		$file = array(
			'name' => 'user-upload-' . rand() . '.' . explode( '/', $data['mime'] )[1],
			'base' => $f,
			'type' => $data['mime'],
			'size' => $data['bits'],
		);
		$up   = ( new Mona_upload() )->mona_upload_image_base64( $file );

		$output = array(
			'file_id'   => $up,
			'url'       => wp_get_attachment_image_url( $up, 'full' ),
			'status'    => 'success',
			'messenger' => __( 'Thay đổi thành công', 'monamedia' ),
		);
		if ( $up != '' ) {
			update_user_meta( get_current_user_id(), '_avatar', $up );
		}
		echo json_encode( $output );
		wp_die();
	}
	/**
	 * lấy hết id học sinh ra
	 */
	public function get_all_user_cus( $page, $search = '' ) {
		$result = [];
		$count  = $this->_users_per_page;
		$page   = $page;
		$offset = $offset = ( $page - 1 ) * $count;
		$args   = [
			'role__in'    => array( 'subscriber' ),
			'paged'       => $page,
			'offset'      => $offset,
			'number'      => $count,
			'count_total' => false,
			'fields'      => 'ID',
			'exclude'     => [ get_current_user_id() ],
			'meta_query'  => [
				'relation' => 'OR', // Optional, defaults to "AND"
				array(
					'key'     => '_team_id',
					'compare' => 'Not Exists',
				),
				'm-sort'   => array(
					'key'     => '_team_id',
					'compare' => 'Exists',
				),
			],
			'orderby'     => 'm-sort',
			'order'       => 'DESC',
		];

		if ( $search != '' ) {
			$args['search']         = $search;
			$args['search_columns'] = [ 'ID', 'user_login', 'user_email', 'display_name' ];
		}
		$students = get_users( $args );
		if ( is_array( $students ) ) {
			foreach ( $students as $key => $userItem ) {
				$result[] = $userItem;
			}
		}
		return $result;
	}
	public function get_count_page_all_user_sub( $search = '' ) {
		$args = [
			'role__in'    => array( 'subscriber' ),
			'count_total' => true,
			'fields'      => 'ID',
			'exclude'     => [ get_current_user_id() ],
			'meta_query'  => [
				'relation' => 'OR', // Optional, defaults to "AND"
				array(
					'key'     => '_team_id',
					'compare' => 'Not Exists',
				),
				'm-sort'   => array(
					'key'     => '_team_id',
					'compare' => 'Exists',
				),
			],
			'orderby'     => 'm-sort',
			'order'       => 'DESC',
		];
		if ( $search != '' ) {
			$args['search']         = $search;
			$args['search_columns'] = [ 'ID', 'user_login', 'user_email', 'display_name' ];
		}
		$students = get_users( $args );

		return ceil( count( $students ) / $this->_users_per_page );
	}
	public function pagination_users( $total, $page ) {
		$bignum = 99999;
		$url    = str_replace( $bignum, '%#%', esc_url( get_pagenum_link( $bignum ) ) );
		echo '<nav class="pagination">';
		echo paginate_links(array(
			'base'      => $url,
			'format'    => '',
			'current'   => $page,
			'total'     => $total,
			'prev_text' => '&larr;',
			'next_text' => '&rarr;',
			'type'      => 'list',
			'end_size'  => 3,
			'mid_size'  => 3,
		));
		echo '</nav>';
	}
	/**
	 * check exists user
	 */
	public function user_id_exists( $userId ) {

		global $wpdb;

		$count = $wpdb->get_var( $wpdb->prepare( "SELECT COUNT(*) FROM $wpdb->users WHERE ID = %d", $userId ) );

		if ( $count == 1 ) {
			return true;
		} else {
			return false; }

	}
	public function url_view_info_user( $userId ) {
		return get_permalink( M_P_ACCOUNT ) . '?view-user=' . $userId;
	}
	/**
	 * true => chưa thi
	 * false => thi rồi
	 */
	public function check_user_has_thi( $userId, $pageTestId ) {
		if ( $userId == 1 ) {
			return true;
		}
		$point = get_user_meta( $userId, '_point_test_' . $pageTestId, true );
		if ( $point === 0 or $point != '' ) {
			return false;
		}
		return true;
	}

	public function save_result_test() {
		$dataTestId  = $_POST['dataTestId'];
		$dataRequest = $_POST['dataRequest'];
		$dataForm    = [];
		parse_str( $_POST['dataForm'], $dataForm );
		$userId   = get_current_user_id();
		$checkHas = get_user_meta( $userId, '_check_has_thi_' . $dataTestId, true );
		if ( $checkHas != 'ok' ) {
			update_user_meta( $userId, '_request_test_' . $dataTestId, $dataRequest );
			update_user_meta( $userId, '_data_form_ans_' . $dataTestId, $dataForm );

			$RankClass = new MonaRankClass();
			$RankClass->count_turn_test();
		}
		exit;

	}
	public function save_point() {
		$point    = $_POST['point'];
		$testId   = $_POST['testId'];
		$timeDone = $_POST['timeDone'];
		$userId   = get_current_user_id();
		$checkHas = get_user_meta( $userId, '_check_has_thi_' . $testId, true );
		if ( $checkHas != 'ok' ) {
			update_user_meta( $userId, '_point_test_' . $testId, $point );
			update_user_meta( $userId, '_check_has_thi_' . $testId, 'ok' );
			update_post_meta( $testId, '_point_user_test_' . $userId, $point );
			update_post_meta( $testId, '_time_done_user_test_' . $userId, $timeDone );

			$TeamClass = new MonaTeamsClass();
			$TeamClass->update_point_team( $userId );
			$TeamClass->update_time_team( $userId );
		}
		exit;
	}
	public function get_all_user() {
		$args     = [
			'role__in'    => array( 'subscriber' ),
			'count_total' => false,
			'fields'      => 'ID',
		];
		$students = get_users( $args );
		return $students;
	}
	public function mona_add_meta_boxes_page() {
		$screen = 'mona_teams';
		add_meta_box(
			'mona_box_list_user_team',
			'Danh sách học sinh của nhóm',
			[ $this, 'mona_custom_box_html' ],
			$screen
		);
	}
	public function mona_custom_box_html( $post ) {
		$teamIds = get_post_meta( $post->ID, '_list_user_team', true );
		echo '<table class="wp-list-table widefat fixed striped posts">';
		?>
		<tr>
			<th class="check-column">ID</th> <!--  -->
			<th>Tên</th>
			<th>Trường</th>
		</tr>
		<?php
		if ( is_array( $teamIds ) ) {
			foreach ( $teamIds as $key => $userId ) {
				$dataUser = $this->get_data_user( $userId );
				$name     = $dataUser['name'];
				$school   = $dataUser['_school'];
				echo '<tr>';
					echo "<td class='check-column' style='padding-left:3px'>$userId</td>";
					echo "<td>$name</td>";
					echo "<td>$school</td>";
				echo '</tr>';
			}
		}

		echo '</table>';

	}
	public function m_a_clear_point() {
		$userId = $_POST['userId'];
		$testId = $_POST['testId'];
		$key    = '_point_test_' . $testId;
		update_user_meta( $userId, $key, '' );
		update_post_meta( $testId, '_point_user_test_' . $userId, '' );
		echo 'Đã xóa kết quả, thí này có thêm 1 lượt thi';
		exit;
	}
}
// call ajax
( new MonaUserClass() )->__call_hook();
