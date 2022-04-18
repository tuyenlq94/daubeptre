<?php

/**
 * Template name: Chọn đồng đội Page
 * @author : Hy Hý
 */
if (!is_user_logged_in()) {
    wp_redirect(get_permalink(M_P_LOGIN) . '?redirect=' . get_permalink());
    exit;
}
get_header();
while (have_posts()) :
    the_post();
    $UserClass= new MonaUserClass();
    $TeamClass = new MonaTeamsClass ();
    $page =  max(1, get_query_var('paged')); 
    $userAll = $UserClass->get_all_user_cus( $page , @$_GET['search-user']) ;
 
?>
 	<main class="main main-search">
        <section class="search frame sec-60" data-aos="fade">
            <div class="container">
                <div class="frame-title --mb-40">
                    <h2
                        class="main-title tt-30 --s-cl t-capitalize"
                        data-aos="fade-up"
                    >
                        Chọn đồng đội
                    </h2>
                </div>
                <div class="frame-content">
                    <div class="search-frame">
                        <div
                            class="search-form --mb-30"
                            data-aos="zoom-out"
                            data-aos-delay="100"
                        >
                            <form action="<?php echo get_permalink( M_P_CHOOSE_TEAM ) ?>">
                                <input
                                    type="text"
                                    class="f-control" name="search-user"  value="<?php echo @$_GET['search-user'] ?>"
                                    placeholder="Nhập ID, email hoặc tên đồng đội ...."
                                />
                                <button type="submit" class="sm">
                                    <i class="fa fa-search" aria-hidden="true"></i>
                                </button>
                            </form>
                        </div>
                        <div class="search-result">
                            <div class="cols">
                                <?php if( is_array( $userAll ) ) { 
                                    foreach( $userAll as $key => $userId ) { 
                                        $userData = $UserClass->get_data_user ( $userId );
                                        $urlViewInfo = $UserClass->url_view_info_user($userId);
                                        ?>
                                <!-- item loop -->
                                <div class="col" data-aos="zoom-out" data-aos-delay="100">
                                    <div class="c-account">
                                        <div class="c-account__img">
                                            <a href="<?php echo $urlViewInfo ?>">
                                                <?php if( $userData['_avatar'] == '') { 
                                                    echo wp_get_attachment_image( M_AVATAR_USER_DEFAULT , '200x200' );
                                                }else {
                                                    echo wp_get_attachment_image( $userData['_avatar'] , '200x200' );
                                                } ?>
                                                
                                            </a>
                                        </div>
                                        <div class="c-account__content">
                                            <p class="name"><?php echo $userData['name'] ?></p>
                                            <p class="id">ID: <?php echo $userId ?></p>
                                            <p class="id">Lớp: <?php echo $userData['_class'] ?></p>
                                            <p class="id">Trường: <?php echo $userData['_school'] ?></p>
                                            <a href="<?php echo $urlViewInfo ?>">Xem trang cá nhân</a>
                                        </div> 
                                        <?php $checkStatusUser = $TeamClass->check_status_user_team( get_current_user_id() , $userId);
                                        if( $checkStatusUser == 1)  { 
                                            echo '
                                            <div class="tag red">
                                                Đã mời
                                            </div>';
                                        }else if( $checkStatusUser == 2)  {
                                            echo '
                                            <div class="tag">
                                                Đồng đội
                                            </div>'; 
                                        }else if($checkStatusUser == 3) {
                                            echo '
                                            <div class="tag green">
                                                Đã có đội
                                            </div>'; 
                                        } else{
                                            ?>
                                        <div class="c-account__btn-add">
                                            <a href="#" data-userId="<?php echo $userId ?>" class="main-btn-ajax m-invite-team">
                                                <img src="<?php echo site_url('template') ?>/images/icon-plus.png" alt="" /> 
                                            </a>
                                        </div>
                                            <?php   
                                        }
                                        ?> 
                                    </div>
                                </div>
                                 <!-- end item loop -->
                                        <?php  
                                    }
                                } ?> 
                            </div>
                        </div> 
                        <div id="response-messenger"></div>
                        <?php 
                        $total = $UserClass->get_count_page_all_user_sub( @$_GET['search-user'] ); 
                        
                        $page =  max(1, get_query_var('paged')); 
                        $UserClass->pagination_users(  $total , $page  );  ?>
                    </div>
                    <div class="frame-btn">
                        <a
                            href="<?php echo home_url(  ) ?>"
                            class="main-btn btn-green"
                            data-aos="fade-up"
                            data-aos-delay="200"
                            >Hoàn tất</a
                        >
                    </div>
                </div>
                <div class="frame-bg">
                    <img src="<?php echo site_url('template') ?>/images/bg-child.png" alt="" />
                </div>
            </div>
        </section>
    </main>
<?php
endwhile;
get_footer(); 
?>