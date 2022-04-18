<?php

class MonaNotification extends MonaDefaultClass {
    
    public function __construct()
    {
        
    }
    public function __call_hook( ) { 
        add_action( 'wp_ajax_m_a_remove_noti', [$this , 'm_a_remove_noti'] ); # co dang nhap 
        add_action( 'wp_ajax_m_a_reload_noti', [$this , 'm_a_reload_noti'] ); # co dang nhap 
        add_action( 'wp_ajax_m_a_accept_noti', [$this , 'm_a_accept_noti'] ); # co dang nhap 
    }
    public function create_notification($userSend , $userTake )  {

        $userDataSendName = m_get_display_name( $userSend ) ;

        $content = 'Bạn nhận được thông báo mời vào đội từ <b> ' . $userDataSendName .'</b>';

        $postArr = [
            'post_title' => 'Thông báo mời vào đội', 
            'post_content' => $content,
            'post_status' => 'publish',
            'post_type' => 'mona_notification'
        ];
 
        $insert = wp_insert_post( $postArr );
        
        if( $insert ) {
            update_post_meta( $insert , 'mona_user_send_notification', $userSend );
            update_post_meta( $insert , 'mona_user_take_notification', $userTake );
            return $this->success_mess( 'Mời thành công');
        }
        return $this->error_mess('Mời thất bại');
    }

    public function remove_notification ( $notificationId )  {
        $postArr = [
            'ID' => $notificationId,
            'post_status' => 'draft',
        ];
        $remove = wp_update_post( $postArr );
        if( $remove ) {
            return $this->success_mess( "Xóa thành công") ;
        }
        return $this->error_mess("Xóa thất bại");
    }

    public function check_show_notification () {
        
    }

    public function accept_join( $notificationId ) {
        $userSend = get_post_meta( $notificationId , 'mona_user_send_notification' ,true );
        $userTake = get_post_meta( $notificationId , 'mona_user_take_notification' ,true );

        $TeamClass = new MonaTeamsClass();
        # check user take 
        $checkHasTeam = $TeamClass->check_user_has_team( $userTake );
        if( $checkHasTeam ) { 
            return $this->error_mess('Bạn đã có nhóm');
        } 
        # check user send 
        $checkHasTeam = $TeamClass->check_user_has_team( $userSend );
        if( $checkHasTeam ) { 
            $checkTeamFull =  $TeamClass->check_team_full( $checkHasTeam );
            if( $checkTeamFull ) {
                return $this->error_mess('Nhóm đã đầy');
            }  
            # join vô nhóm đã có 
            $TeamClass->join_team( $userTake , $checkHasTeam );
            $this->alert_all_team( $userTake );
            $result = $this->success_mess('Vào nhóm thành công! Nhóm bạn đã đủ người, hãy bắt đầu ngay');
            $result['urlBtn'] = get_permalink( M_P_THELE );
            $result['urlBtn_2'] ='';
            return $result;
        }
        # create team 
        $create = $TeamClass->create_team( $userSend , $userTake );
        if ( $create ) {
            $result = $this->success_mess('Lập nhóm thành công, thêm 1 người nữa để bắt đầu nhé'); // urlBtn_2
            $result['urlBtn_2'] = get_permalink( M_P_CHOOSE_TEAM );
            $result['urlBtn'] = '';
            return $result;
        }
        return $this->error_mess('Lập nhóm thất bại');
    }

    public function m_a_remove_noti () {
        $notiId = $_POST['NotiId'];
        $result = $this->remove_notification ( $notiId ) ;
        echo json_encode( $result );
        exit;
    }
    public function m_a_reload_noti() {
        get_template_part( 'patch/notification/main' );
        exit;
    }
    public function m_a_accept_noti( ) {
        $notiId = $_POST['NotiId'];
        $result = $this->accept_join( $notiId ) ;
        echo json_encode( $result );
        exit;
    }
    public function alert_all_team( $userId ) {
        $teamId = get_user_meta($userId, '_team_id', true );
        $dataUserTeam = get_post_meta( $teamId, '_list_user_team', true );
        foreach( $dataUserTeam as $key => $itemId) {

            if( $userId == $itemId ) continue; # không cần thông báo cho nó nữa

            $content = 'Đội của bạn đã đủ người, hãy vào thi ngay'; 
            $postArr = [
                'post_title' => 'Thông báo đủ người', 
                'post_content' => $content,
                'post_status' => 'publish',
                'post_type' => 'mona_notification'
            ]; 
            $insert = wp_insert_post( $postArr );
            if ($insert ) {
                update_post_meta( $insert , 'mona_user_take_notification', $itemId );
                update_post_meta( $insert , '_status_noti', '_alert_test' ); 
            }
        } 
    }
}
(new MonaNotification())->__call_hook();