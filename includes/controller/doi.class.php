<?php 
class MonaUserDoi extends MonaDefaultClass {
    public function danh_saoi_doi( $userId ) {
        $data = [];
        $user = get_userdata( $userId ) ;
        $userData = $user->data; 
       
        $data['name'] = $userData->display_name;
        $data['id'] = $userData->ID;
        
        $dataField = $this->get_array_user( );
        foreach ( $dataField as $key => $title ) {
            $data[$key] = get_user_meta( $userId , $key , true );
        }
        return $data;
    }
    public function get_array_user( ) {
        $array  = [
            '_link' => 'Xem trang cá nhân',
        ];
        return $array;
      
    }
    }