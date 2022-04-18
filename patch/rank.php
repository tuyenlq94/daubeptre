        <?php $RankClass = new MonaRankClass();
        $TeamClass = new MonaTeamsClass();
        $UserClass = new MonaUserClass();
        $totalTeams = $RankClass->count_teams();
        $totalTurn = $RankClass->total_turn_test();
        // var_dump($totalTurn);
        ?>
        <section class="rank sec-60 --pt-0" data-aos="fade">
            <div class="container">
                <div class="cols">
                    <div class="col">
                        <div class="rank-count">
                            <div class="count-item counter" data-aos="fade-right">
                                <p class="num f-oswald" data-num="<?php echo $totalTeams ?>"><?php echo $totalTeams ?></p>
                                <p class="desc f-uppercase tt-20">Đội thi đã tham dự</p>
                            </div>
                            <div class="count-item counter" data-aos="fade-right" data-aos-delay="200">
                                
                                <p class="num f-oswald" data-num="<?php echo $totalTurn ?>"><?php echo  $totalTurn  ?></p>
                                <p class="desc f-uppercase tt-20">
                                    tổng số lượt thi <br />đã được trả lời
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="rank-list-wrap">
                            <h2 class="main-title tt-40 --s-cl --mb-40" data-aos="fade-left">
                                Xếp hạng
                            </h2>
                            <div class="rank-list">
                                <?php $args = [
                                    'post_type' => 'mona_teams',
                                    'posts_per_page' => 5, 
                                    'meta_query' => [
                                        'relation' => 'AND',
                                        'point' => [
                                            'key' => '_point_total_team',  
                                            'compare' => 'EXISTS', 
                                            'type' => 'NUMERIC'
                                        ],
                                        'time' => [
                                            'key' => '_time_total_team', 
                                            'compare' => 'EXISTS', 
                                            'type' => 'NUMERIC'
                                        ]
                                    ],
                                    'orderby' => [
                                        'point' => 'DESC',
                                        'time' => 'ASC',
                                    ],
                                    // 'orderby' => 'point',
                                    // 'order' => "DESC",
                                ];
                                $queryRank = new WP_Query($args);
                                $index = 1; 
                                while( $queryRank->have_posts() ) { 
                                    $queryRank->the_post(); 

                                    
                                    $teamId = get_the_ID(); 
                                    $userIds = get_post_meta( $teamId, '_list_user_team', true );
                                    $totalPoint = get_post_meta( $teamId, '_point_total_team', true );
                                
                                    $totalTime = $TeamClass->total_time( $teamId );
                                    // $TeamClass->update_total_time_team( $teamId );
                                    ?>
                                <div class="rank-item" data-aos="fade-up">
                                    <p class="stt f-oswald">0<?php echo $index ?>.</p>
                                    <div class="content">
                                        <p class="tt"><?php the_title() ?></p>
                                        <div class="desc">
                                            <div class="ifbox">
                                                <p class="iflb tt-14">Tổng điểm</p>
                                                <p class="ifct f-oswald tt-24"><?php echo $totalPoint ?></p>
                                            </div>
                                            <div class="ifbox">
                                                <p class="iflb tt-14">Tổng thời gian</p>
                                                <p class="ifct f-oswald tt-24 test-time-format"><?php echo $totalTime  ?></p>
                                            </div>
                                        </div>
                                    </div>
                                    <a href="#popup-rank-<?php echo $index ?>" class="main-btn btn-yellow open-popup-btn">Xem chi tiết</a>
                                    <div class="popup-wrap" id="popup-rank-<?php echo $index ?>">
                                        <div class="pu-rank">
                                            <button class="pu-close mfp-btn-close">
                                            <img src="<?php echo site_url(); ?>/template/images/pu-close.png" alt="" />
                                            </button>
                                            <h3 class="main-title tt-30 --mb-25">
                                            <?php the_title( ) ?>
                                            </h3>
                                            <div class="pu-rank-table">
                                            <table>
                                                <thead> 
                                                <tr>
                                                    <td></td>
                                                    <td>Tổng điểm:</td>
                                                    <td>Tổng thời gian:</td>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php 
                                                if( is_array( $userIds ) ) { 
                                                    foreach( $userIds as $key => $userId ) { 
                                                        $dataUser = $UserClass->get_data_user($userId);
                                                        if(!$dataUser) continue;

                                                        ?>
                                                <tr>
                                                    <td><?php echo $dataUser['name'] ?></td>
                                                    <td><?php echo $TeamClass->get_total_point_user($userId) ; ?></td>
                                                    <td class="test-time-format"><?php echo $TeamClass->get_total_time_user($userId ) ?></td>
                                                </tr>
                                                        <?php    
                                                    }
                                                } ?> 
                                                </tbody>
                                            </table>
                                            </div>
                                        </div>
                                        </div>
                                </div>    
                                    <?php 
                                    $index++;
                                }wp_reset_query(  ); ?>
                                
                                <!-- <div class="rank-item" data-aos="fade-up">
                                    <p class="stt f-oswald">02.</p>
                                    <div class="content">
                                        <p class="tt">Tên đội gì đó tên đội gì đó nhé</p>
                                        <div class="desc">
                                            <div class="ifbox">
                                                <p class="iflb tt-14">Tổng điểm</p>
                                                <p class="ifct f-oswald tt-24">150</p>
                                            </div>
                                            <div class="ifbox">
                                                <p class="iflb tt-14">Tổng thời gian</p>
                                                <p class="ifct f-oswald tt-24">24:05</p>
                                            </div>
                                        </div>
                                    </div>
                                    <a href="#popup-rank" class="main-btn btn-yellow open-popup-btn">Xem chi tiết</a>
                                </div>
                                <div class="rank-item" data-aos="fade-up">
                                    <p class="stt f-oswald">03.</p>
                                    <div class="content">
                                        <p class="tt">Tên đội gì đó tên đội gì đó nhé</p>
                                        <div class="desc">
                                            <div class="ifbox">
                                                <p class="iflb tt-14">Tổng điểm</p>
                                                <p class="ifct f-oswald tt-24">150</p>
                                            </div>
                                            <div class="ifbox">
                                                <p class="iflb tt-14">Tổng thời gian</p>
                                                <p class="ifct f-oswald tt-24">24:05</p>
                                            </div>
                                        </div>
                                    </div>
                                    <a href="#popup-rank" class="main-btn btn-yellow open-popup-btn">Xem chi tiết</a>
                                </div>
                                <div class="rank-item" data-aos="fade-up">
                                    <p class="stt f-oswald">04.</p>
                                    <div class="content">
                                        <p class="tt">Tên đội gì đó tên đội gì đó nhé</p>
                                        <div class="desc">
                                            <div class="ifbox">
                                                <p class="iflb tt-14">Tổng điểm</p>
                                                <p class="ifct f-oswald tt-24">150</p>
                                            </div>
                                            <div class="ifbox">
                                                <p class="iflb tt-14">Tổng thời gian</p>
                                                <p class="ifct f-oswald tt-24">24:05</p>
                                            </div>
                                        </div>
                                    </div>
                                    <a href="#popup-rank" class="main-btn btn-yellow open-popup-btn">Xem chi tiết</a>
                                </div>
                                <div class="rank-item" data-aos="fade-up">
                                    <p class="stt f-oswald">05.</p>
                                    <div class="content">
                                        <p class="tt">Tên đội gì đó tên đội gì đó nhé</p>
                                        <div class="desc">
                                            <div class="ifbox">
                                                <p class="iflb tt-14">Tổng điểm</p>
                                                <p class="ifct f-oswald tt-24">150</p>
                                            </div>
                                            <div class="ifbox">
                                                <p class="iflb tt-14">Tổng thời gian</p>
                                                <p class="ifct f-oswald tt-24">24:05</p>
                                            </div>
                                        </div>
                                    </div>
                                    <a href="#popup-rank" class="main-btn btn-yellow open-popup-btn">Xem chi tiết</a>
                                </div> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>