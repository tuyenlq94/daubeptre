<?php  

class MonaQuizClass extends MonaDefaultClass {

    protected $_idTermExam; # term id
    protected $_countQuizExam;


    public function __construct() {
        $this->_idTermExam = 5; 
        $this->_countQuizExam = 30; 
        $this->_countQuiz = 30; 
    }

    public function get_list_test_exam( ) {
        $args = [
            'post_type' => 'mona_question',
            'posts_per_page' => $this->_countQuizExam, 
            'orderby' => "rand",
            'tax_query' => [
                'relation' => "and" , 
                [
                    'taxonomy' => 'mona_category_question', 
                    'field' => 'id', 
                    'terms' => array( $this->_idTermExam ),
                    'include_children' => true,
                    'operator' => 'IN',
                ]
            ]
        ];
        $quizQuery = new WP_Query( $args ) ;
        return $quizQuery;
    }

    public function get_result_test( $quizQuery ) {
        $arrayResult = [];
        $index = 0;
        while( $quizQuery->have_posts() ) { 
            $quizQuery->the_post(); 
            $index++;
            $ans = get_field( 'mona_answer_question');
            $ansCheck = 0;
            if( is_array( $ans ) ) { 
                foreach( $ans as $key => $item ) { 
                    $key=$key+1;
                    if( $item['right_answer'] == true){ 
                        $ansCheck = $key;
                    }
                }
            }
            $arrayResult[] = [
                'id' => $index, 
                'correctAnswer' => $ansCheck,
            ];
        }wp_reset_query(  );
        return $arrayResult;  
    }

    public function get_list_test( ) {
        $args = array(
            'post_type' => 'mona_question',
            'posts_per_page' => $this->_countQuiz, 
            'order' => 'DESC',
            'orderby' => 'rand', 
        ); 
        $quizQuery = new WP_Query( $args ) ;
        return $quizQuery;
    }
    /**
     * 2 => chưa bắt đầu
     * 3 => đang diễn ra
     * 4 => đã kết thúc
    */
    public function check_time_test( $postId ){
        $checkTimeEnd = strtotime(get_field('time_end_test' , $postId) . '23:59:59' );
        $checkTimeStart = strtotime( get_field('time_start_test' , $postId) . '00:00:00' );
        // var_dump(date('Ymd H:i:s' , $checkTimeStart));
        $now = current_time( 'timestamp' ) ;// ( 'now' );
         
        if ($checkTimeStart < $now and $checkTimeEnd > $now ) {
            return 3;
        }else if( $checkTimeStart > $now ) {
            return 2;
        }else if( $checkTimeEnd < $now){
            return 4;
        }
    }
    public function get_test_now() {
        $now =  date("Ymd", current_time( 'timestamp' )); 
        $args = [
            'post_type' => 'page' , 
            'posts_per_page' => 1, 
            'meta_query' => [
                'relation' => 'and',
                [
                    'key' => 'time_end_test', 
                    'value' => $now,   
                    'type' => 'DATE',  
                    'compare' => '>=',
                ],
                [
                    'key' => 'time_start_test', 
                    'value' => $now,   
                    'type' => 'DATE',  
                    'compare' => '<=',
                ],
            ]
        ];
        $queryQuizNow = new WP_Query($args); 
        $post_ids = wp_list_pluck( $queryQuizNow->posts, 'ID' ); # save  
        if( is_array($post_ids) and count($post_ids) > 0) {
            return $post_ids[0];
        }
        return false;
    }
}
// const demoJsonTest = [
//     {
//         id: 1, 
//         correctAnswer: 1,
//     }, 
// ];