<?php 
define('THE_LE_THI', 74);
function vi_human_time_diff($from, $to = '') {
    if (empty($to))
        $to = time();
    $diff = (int) abs($to - $from);
    if ($diff > 259200)
        return false;
    if ($diff < HOUR_IN_SECONDS) {
        $mins = round($diff / MINUTE_IN_SECONDS);
        if ($mins <= 1)
            $mins = 1;
        /* translators: min=minute */
        $since = sprintf(_n('%s phút', '%s phút', $mins), $mins);
    } elseif ($diff < DAY_IN_SECONDS && $diff >= HOUR_IN_SECONDS) {
        $hours = round($diff / HOUR_IN_SECONDS);
        if ($hours <= 1)
            $hours = 1;
        $since = sprintf(_n('%s giờ', '%s giờ', $hours), $hours);
    } elseif ($diff < WEEK_IN_SECONDS && $diff >= DAY_IN_SECONDS) {
        $days = round($diff / DAY_IN_SECONDS);
        if ($days <= 1)
            $days = 1;
        $since = sprintf(_n('%s ngày', '%s ngày', $days), $days);
    } elseif ($diff < 30 * DAY_IN_SECONDS && $diff >= WEEK_IN_SECONDS) {
        $weeks = round($diff / WEEK_IN_SECONDS);
        if ($weeks <= 1)
            $weeks = 1;
        $since = sprintf(_n('%s tuần', '%s tuần', $weeks), $weeks);
    } elseif ($diff < YEAR_IN_SECONDS && $diff >= 30 * DAY_IN_SECONDS) {
        $months = round($diff / (30 * DAY_IN_SECONDS));
        if ($months <= 1) $months = 1; $since = sprintf(_n('%s tháng', '%s tháng', $months), $months); } elseif ($diff >= YEAR_IN_SECONDS) {
        $years = round($diff / YEAR_IN_SECONDS);
        if ($years <= 1)
            $years = 1;
        $since = sprintf(_n('%s năm', '%s năm', $years), $years);
    }
    return $since;
}
define('MONA_POSTS', get_option('page_for_posts'));

function mona_register_sidebars_1() {
    require_once(get_template_directory() . '/widgets/hinh-anh-footer.php');
    register_widget('contact_widget'); 
}

add_action('widgets_init', 'mona_register_sidebars_1');