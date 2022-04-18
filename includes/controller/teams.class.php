<?php  

class MonaTeamsClass extends MonaDefaultClass {
     
    public function __construct() {
        
    }
    public function __call_action() {
        add_action( 'wp_ajax_m_a_invite_team', [$this , 'ajax_invite_team'] ); # co dang nhap 
        add_action( 'wp_ajax_m_a_edit_name', [$this , 'm_a_edit_name'] ); # co dang nhap 
        add_action( 'wp_ajax_m_a_save_url', [$this , 'm_a_save_url'] ); # co dang nhap 
        // add_action( 'init' , [$this , 'mona_update_time_team']);
    }

    public function mona_update_time_team( ) {
        if( isset( $_GET['mona-update-time-team'])) {
            $allTeams = $this->list_all_teams_query();
            while( $allTeams->have_posts() ) { 
                $allTeams->the_post(); 
                echo $this->update_total_time_team( get_the_ID() ); echo '<br>';     
            }wp_reset_query(  );
            
            exit;
        }
    }

    public function show_list_student( ) {

    }

    public function check_student_free( ) {

    }

    public function add_student_team( ) {

    }

    public function list_my_team( $userId ) {
        $teamId = get_user_meta( $userId, '_team_id', true);
        if( get_post_type( $teamId ) != 'mona_teams' or get_post_status( $teamId ) != 'publish') 
            return;
        $teamUserIds = get_post_meta( $teamId , '_list_user_team' , true );
        if(is_array($teamUserIds) ) {
            return $teamUserIds;
        }
        return false;
    }
    public function check_user_has_team( $userId ) {
        $teamId = get_user_meta( $userId, '_team_id', true );
        if ( get_post_type( $teamId ) == 'mona_teams' and get_post_status( $teamId ) == 'publish') {
            return $teamId;
        }
        return false;
    }

    public function check_team_full( $teamId ) {
        $dataUserTeam = get_post_meta( $teamId, '_list_user_team', true );
        if( is_array( $dataUserTeam ) and count( $dataUserTeam) >= 3 ) {
            return true; 
        }
        return false;
    }
    public function join_team( $userId , $teamId ) {
        update_user_meta( $userId , '_team_id' , $teamId );
        $teamUserIds = get_post_meta( $teamId , '_list_user_team' , true );
        $teamUserIds[] =  $userId;
        update_post_meta( $teamId, '_list_user_team' , $teamUserIds ); 
    }

    public function create_team( $userSend , $userTake ) { # join từ notification
        $nameTeam = 'Nhóm ' . m_get_display_name( $userSend );
        $content = '';
        $postArr = [
            'post_title' => $nameTeam, 
            'post_content' =>  $content,
            'post_type' => 'mona_teams' ,
            'post_status' => 'publish'
        ];
        $ins = wp_insert_post(  $postArr );
        if ( $ins ) {
            $userIds = [$userSend , $userTake];
            update_post_meta( $ins, '_list_user_team', $userIds  );
            update_user_meta(  $userSend , '_team_id' , $ins );
            update_user_meta(  $userTake , '_team_id' , $ins );
            return true;
        }
        return false;
    }
    public function ajax_invite_team() {
        $userIdInvited = $_POST['data'];
        $userIdInvite = get_current_user_id(  );
        
        $NotiClass = new MonaNotification( ); 
        $result = $NotiClass->create_notification($userIdInvite , $userIdInvited );
        echo json_encode($result);
        exit;
    } 
    /**
     * 0 => méo liên quan
     * 1 => đã mời
     * 2 => my team
     * 3 => đã có team 
    */
    public function check_status_user_team($userId , $userTake) {
       
        #check my team 
        $teamId = get_user_meta( $userId, '_team_id', true );
        if($teamId != '') { # đã có team 
            $arrIdTeam = (array) get_post_meta( $teamId, '_list_user_team', true );
            if(in_array( $userTake , $arrIdTeam )){
                return 2;
            }
        }
        $teamTakeUser = get_user_meta( $userTake , '_team_id',true );
        if( $teamTakeUser != '' ) {
            return 3;
        }
        # check đã mời chưa
        $args = [
            'post_type' => 'mona_notification' , 
            'posts_per_page' => 1, 
            'meta_query' => [
                'relation' => 'AND' , 
                [
                    'key' => 'mona_user_send_notification',
                    'value' => $userId , 
                    'compare' => '=', 
                ],
                [
                    'key' => 'mona_user_take_notification',
                    'value' => $userTake , 
                    'compare' => '=', 
                ],
            ]
        ];
        $queryNoti = new WP_Query($args);
        if( $queryNoti->have_posts() ) {
            return 1;
        }
        return 0;
    }
    public function m_a_edit_name () {
        $dataForm = [];
        parse_str($_POST['data'] , $dataForm);

        $teamId = strip_tags($dataForm['team-id']) ;
        $name = strip_tags($dataForm['team-name']);

        $postArr = [
            'post_title' => $name,
            'ID' => $teamId,
        ];
        
        $upd = wp_update_post( $postArr ,true );
 
        if( $upd ) {
            echo json_encode($this->success_mess('Sửa tên thành công'));
            exit;
        } 
        echo json_encode($this->error_mess('Sửa tên thất bại'));
        exit; 
    }
    public function list_all_teams_query() {
        $args= [
            'post_type' =>'mona_teams',
            'posts_per_page' => -1, 
        ];
        $teamQuery = new WP_Query($args);
        if( $teamQuery ->have_posts()) {
            return $teamQuery;
        }

        return false;
    }
    public function update_point_team($userId ){
        $teamId = get_user_meta( $userId, '_team_id', true );
        $userIds = get_post_meta($teamId , '_list_user_team', true );
   
        $testIds = get_field('choose_page_ki_thi' , M_P_HOME);
        $point = 0;
        if( is_array( $userIds ) ) { 
            foreach( $userIds as $key => $id ) { 

                if( is_array( $testIds  ) ) { 
                    foreach( $testIds as $key => $testId ) { 
                        $point += (int) get_user_meta( $id, '_point_test_' . $testId, true );
                    }
                }
            }
        } 
        update_post_meta($teamId , '_point_total_team' , $point );
    }
    public function update_time_team ($userId) {
        $teamId = get_user_meta( $userId, '_team_id', true );
        $userIds = get_post_meta($teamId , '_list_user_team', true );
        $testIds = get_field('choose_page_ki_thi' , M_P_HOME);
        $time = 0;
        if( is_array( $userIds ) ) { 
            foreach( $userIds as $key => $id ) { 

                if( is_array( $testIds  ) ) { 
                    foreach( $testIds as $key => $testId ) { 
                        $time += (int) get_post_meta( $testId, '_time_done_user_test_' . $id, true );
                    }
                }
            }
        } 
        update_post_meta($teamId, '_time_total_team' ,$time );
    }
    public function total_time ( $teamId ) {
        $userIds = get_post_meta($teamId , '_list_user_team', true );
        $testIds = get_field('choose_page_ki_thi' , M_P_HOME);
        $time = 0;
        if( is_array( $userIds ) ) { 
            foreach( $userIds as $key => $id ) { 

                if( is_array( $testIds  ) ) { 
                    foreach( $testIds as $key => $testId ) { 
                        $time += (int) get_post_meta( $testId, '_time_done_user_test_' . $id, true ); 
                    }
                }
            }
        } 
        return $time;
    }
    public function get_total_point_user($userId) {
        $testIds = get_field('choose_page_ki_thi' , M_P_HOME);
        $point = 0;
        if( is_array( $testIds ) ) { 
            foreach( $testIds as $key => $testId ) { 
                $point+= (int) get_user_meta( $userId, '_point_test_' . $testId, true );
            }
        }   
        return $point;
    }
    public function get_total_time_user ( $userId) {
        $testIds = get_field('choose_page_ki_thi' , M_P_HOME); 
        $time  = 0;
        if( is_array( $testIds ) ) { 
            foreach( $testIds as $key => $testId ) { 
                $time += (int) get_post_meta( $testId, '_time_done_user_test_' . $userId, true ); 
            }
        }   
        return $time;
    }
    public function m_a_save_url( ) {
        $dataForm = [];
        parse_str( $_POST['dataForm'] , $dataForm );
        $teamId = $dataForm['team-id'];
        $url = $dataForm['url'];
        $urlOld  = get_post_meta( $teamId, '_url_test_video', true );
        if ( $teamId == '') {
            echo json_encode( $this->error_mess('Bạn vẫn chưa có nhóm') );
            exit();
        }
        if( $urlOld != '') {
            echo json_encode( $this->error_mess('Nhóm bạn đã nộp bài thi rồi') );
            exit();
        }
        update_post_meta( $teamId, '_url_test_video', $url );
        echo json_encode($this->success_mess('Nộp bài thành công'));
        exit;
    }
    public function update_total_time_team( $teamId ) {
        $userIds = get_post_meta($teamId , '_list_user_team', true );
        $testIds = get_field('choose_page_ki_thi' , M_P_HOME);
        $time = 0;
        if( is_array( $userIds ) ) { 
            foreach( $userIds as $key => $id ) { 

                if( is_array( $testIds  ) ) { 
                    foreach( $testIds as $key => $testId ) { 
                        $time += (int) get_post_meta( $testId, '_time_done_user_test_' . $id, true ); 
                    }
                }
            }
        } 
        update_post_meta($teamId, '_time_total_team' ,$time );
    }
    
}
(new MonaTeamsClass() )->__call_action();