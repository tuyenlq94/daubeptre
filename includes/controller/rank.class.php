<?php

class MonaRankClass extends MonaDefaultClass
{

    public function __construct()
    {
    }
    public function __call_action()
    {
        add_action('add_meta_boxes_page', [$this, 'mona_add_meta_boxes_page']);
    }
    public function count_teams()
    {
        $args = [
            'post_type' => 'mona_teams',
            'posts_per_page' => -1,
        ];
        $countQuery = new WP_Query($args);
        if ($countQuery->have_posts()) {
            return $countQuery->found_posts;
        }
        return 0;
    }
    public function total_turn_test()
    {
        return mona_get_option('mona_count_turn_test', 0);
    }
    public function count_turn_test()
    {
        $turn = (int) mona_get_option('mona_count_turn_test', 0);

        $turn = $turn + 1;
        set_theme_mod('mona_count_turn_test', $turn);
    }
    function mona_add_meta_boxes_page()
    {
        global $post;
        if ('page-template/thi.php' == get_post_meta($post->ID, '_wp_page_template', true)) { // and get_current_user_id(  ) == 1
            $screen = 'page';
            add_meta_box(
                'mona_box_list_point_user',
                'Danh sách học sinh thi',
                [$this, 'mona_custom_box_html'],
                $screen
            );
        }
    }
    public function mona_custom_box_html($post)
    {
?>
        <style>
            .widefat td,
            .widefat th {
                border: 1px solid #000;
            }
        </style>
        <?php
        $testId = $post->ID;
        $UserClass = new MonaUserClass();

        echo '<table class="wp-list-table widefat fixed striped posts">';
        ?>
        <tr>
            <th>Tên đội</th>
            <th class="check-column">ID</th> <!--  -->
            <th>Tên</th>
            <th>Điểm</th>
        </tr>
        <?php
        $TeamClass = new MonaTeamsClass(); //
        $allTeams =  $TeamClass->list_all_teams_query();
        if ($allTeams) {
            while ($allTeams->have_posts()) {
                $allTeams->the_post();
                $titleTeam = get_the_title();
                $teamId = get_the_ID();
                $userTeamIds = get_post_meta($teamId, '_list_user_team', true);
                if (is_array($userTeamIds)) {
                    $check = true;
                    foreach ($userTeamIds as $key => $userId) {
                        $dataUser = $UserClass->get_data_user($userId);
                        echo '<tr>';
                        if ($check) {
                            echo '<td rowspan="' . count($userTeamIds) . '" style="padding-top: 5%;">' . $titleTeam . '</td>';
                        }
                        echo '<td class="check-column" style="padding-left:3px"> ';
                        echo $userId;
                        echo '</td>';
                        echo '<td>';
                        echo  $dataUser['name'];
                        echo '</td>';
                        echo '<td>';
                        $point = get_post_meta($testId, '_point_user_test_' . $userId, true);
                        if ($point == '') {
                            echo 'Chưa thi';
                        } else {
                            echo $point . '<br>';
                            echo '<a href="#" data-userId="' . $userId . '" class="mona-clear-point" data-testId="' . $testId . '"
                                    title="Xóa kết quả của học sinh này về bài thi">Xóa kết quả</a>';
                        }
                        echo '</td>';
                        echo '</tr>';
                        $check = false;
                    }
                }
            }
            wp_reset_query();
        }
        echo '</table>';
        ?>
        <script>
            (function($) {

                const sendAjaxPromise = (url, type, data) => new Promise((resolve, reject) => {
                    $.ajax({
                        url: url,
                        type: type,
                        data: data,
                        success: function(result) {
                            resolve(result);
                        },
                        error: function(error) {
                            reject(error);
                        }
                    });
                });
                $('.mona-clear-point').on('click', async function(e){
                    e.preventDefault();
                    alert( 'Bạn có chắc muốn xóa hết quả này' );
                    let userId = $(this).attr('data-userId'),
                        $loading =  $(this),
                        testId = $(this).attr('data-testId');
                        try {
                        $loading.addClass('loading');
                        const result = await sendAjaxPromise(ajaxurl, 'post', {
                            action: 'm_a_clear_point',
                            userId: userId, 
                            testId: testId, 
                        });
                        $loading.removeClass('loading');
                        alert( result );
                        window.location.reload();
                    } catch(e) {
                        console.log(e);
                        $loading.removeClass('loading');
                    } 
                })
            })(jQuery);
        </script>

<?php
    }
}
(new MonaRankClass())->__call_action();
