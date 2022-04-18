    <?php 
    $userId = get_current_user_id(  );
    $queryNotification = new WP_Query( [
        'post_type' => 'mona_notification' , 
        'posts_per_page' => -1 , 
        'post_status' => ['publish'],
        'meta_query' => [
            'relation' => "AND" , 
            [
                'key' => 'mona_user_take_notification', 
                'value' => $userId, 
                'type' => 'NUMERIC',
                'compare' => '=',
            ]
        ]
    ]); 
    $TeamClass = new MonaTeamsClass();
    $checkHasTeam = $TeamClass->check_user_has_team( $userId );
        ?>
    <p class="num"><?php echo $queryNotification->found_posts ?></p>
    <img src="<?php echo site_url(); ?>/template/images/icon-notti.png" alt="" />
    <div class="header-noti-content">
        <?php  if( $queryNotification->have_posts()) { ?>
        <ul class="box-has-ajax">
            <?php while( $queryNotification->have_posts() ) { 
                $queryNotification->the_post(); 
                ?>
            <li>
                <div class="content">
                   <?php the_content() ?>
                </div>
                <?php 
                $tus = get_post_meta( get_the_ID(),'_status_noti', true );
                if($tus == '_alert_test' ) {
                    ?>
                <div class="btn"> 
                    <a href="<?php echo get_permalink( M_P_THELE ) ?>" class="thi-btn">Thi</a>
                </div>      
                    <?php
                }else if(!$checkHasTeam){
                    ?>
                <div class="btn" data-id="<?php the_ID() ?>">
                    <a href="#" class="remove-btn">Xóa</a> |
                    <a href="#" class="accept-btn">Đồng ý vào đội</a>
                </div>    
                    <?php
                }
                ?>
                
            </li>    
                <?php 
            }wp_reset_query(  ); ?>
            
             
        </ul>
        <?php
    }else {

        echo "<p class='noti-null'>Không có thông báo</p>";
    }
    ?>
   
        
       
    </div>
       