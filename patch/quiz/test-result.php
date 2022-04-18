        <?php $index = get_query_var( 'm_index', 0);
            $dataAnd = get_query_var( 'data_ans', [] );
       
        ?> 
        <div class="test-item" data-id-qs="<?php echo $index ?>">
            <div class="qs-wrap">
                <div class="qs">
                    <div class="qs-num">Câu <?php echo $index ?>:</div>
                    <p class="desc">
                        <?php the_title() ?>
                    </p>
                </div>
            </div>
            <div class="ans">
                <div class="ans-list">
                    <?php $ans = get_field('mona_answer_question');
                    if( is_array( $ans ) ) {
                        $kIndex = 0;
                        foreach( $ans as $key => $item ) { 
                            $kIndex++ ;
                            $value=$kIndex;
                            $id = "qs-" . $index . '-' . $kIndex;
                            $name = 'ans-qs-' . $index;
                            $checked = '';
                            if( is_array( $dataAnd  ) ) { 
                                foreach( $dataAnd  as $keyAns => $itemAns ) { 
                                    if($keyAns == $name and $itemAns == $value) {
                                        $checked = 'checked';
                                    }
                                }
                            }
                            ?>
                    <div class="ans-item disabled-input-check"> 
                        <label class="custom-radio <?php echo ($item['right_answer'] ? 'this-ans' : '') ?> <?php echo $checked ?>" for="<?php echo $id ?>"  >
                            <input <?php echo $checked ?> type="radio" id="<?php echo $id ?>" name="<?php echo $name ?>" value="<?php echo $value ?>" />
                            <span class="checkmark"></span>
                            <span><?php echo str_replace('|' , "<br>" ,$item['title'])  ?></span>  
                        </label>
                    </div>        
                            <?php
                        }
                    }
                    ?> 
                </div>
            </div>
        </div>