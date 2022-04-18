<?php

class Mona_hook {

    public function __construct() {
        add_filter('pre_get_posts', [$this, 'prefix_limit_post_types_in_search']);
        add_filter('wpcf7_autop_or_not', '__return_false');
    }

    public function prefix_limit_post_types_in_search($query) {
        if (!is_admin()) {
            $query->set('ignore_sticky_posts', true);
        }

        return $query;
    }

}

new Mona_hook();
