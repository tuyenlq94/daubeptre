<ul>
    <?php $data = [
        M_P_REGISTER => 'Đăng ký', 
        M_P_LOGIN => 'Đăng nhập', 
        M_P_LOST_PASSWORD => 'Quên mật khẩu',  
    ]; 
    foreach ( $data as $k => $name ) {
        $active = '';
        if( $k == get_the_ID() ) 
            $active = 'active';
        $url = get_permalink( $k );
        if( isset( $_GET['redirect'] ) and $_GET['redirect'] != '' ){
            $url = get_permalink( $k ). '?redirect=' .$_GET['redirect'] ;
        } 
        echo '<li class="--'.$active.'" data-aos="zoom-out"><a href="'.$url.'">'.$name.'</a></li>';
    } 
    ?>
    
   
</ul>