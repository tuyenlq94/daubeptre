<?php

class MonaImportClass extends MonaDefaultClass {
    
    public function __construct()
    {
        
    }
    public function __call_hook( ) {  
        add_action( 'wp_ajax_m_a_import_quiz', [$this , 'import_quiz'] ); # co dang nhap 
    }
     
    public function import_quiz() {
        $row = $_POST['row'];
        $stt = $row[0];
        $content = $this->map_content ( $row[1]); 
      
        $ans = $row[2];

        $postArr = [
            'post_type' => 'mona_question', 
            'post_status' => 'publish', 
            'post_title' =>  $content[0],  
        ];
        $dataArr = [];
        // $ins = 1;
        $ins = wp_insert_post( $postArr ); 
        if ( $ins )  {
            if( is_array( $content[1]  ) ) { 
                foreach( $content[1]  as $key  => $value ) { 
                    $thisAns = false;
                    if ($key+1 == $ans) {
                        $thisAns =true ;
                    } 
                    $data = [
                        'title' => $value ,
                        'right_answer' => $thisAns,
                    ];
                    $dataArr[] = $data;
                }
            }  
            update_post_meta( $ins , '_stt_file_' , $stt); 
            
            $update =  update_field( 'mona_answer_question' ,$dataArr , $ins ); 
        
            echo json_encode($this->success_mess(get_the_title( $ins ) . $update ));
            exit;
        }
        echo json_encode($this->error_mess("thất bại r"));
        exit;
    }
    /**
     * return array 
     * 0 => content 
     * 1 => [array đáp án] 
     * */ 
    public function map_content ($content) {

        $arrData = [];
        $contentArr = explode("\r", $content); 
        $title = $contentArr[0];
        unset( $contentArr[0]) ;
        foreach( $contentArr as $k => $item ) {
            $text = trim( explode('. ' , $item)[1] );
            $arrData[] = $text;
        }
        return [
            $title , 
            $arrData, 
        ];
    }
} 
(new MonaImportClass())->__call_hook();