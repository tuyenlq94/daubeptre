        <?php $index = get_query_var( 'm_index', 0); ?>
        <div class="test-item" data-id-qs="<?php echo $index ?>">
            <div class="qs-wrap">
                <div class="qs">
                    <div class="qs-num">Câu <?php echo $index ?>:</div>
                    <p class="desc">
                        <?php echo  str_replace('|' , "<br>" , get_the_title())  ?>
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
                            ?>
                    <div class="ans-item"> 
                        <label class="custom-radio" for="<?php echo $id ?>">
                            <input type="radio" id="<?php echo $id ?>" name="<?php echo $name ?>" value="<?php echo $value ?>" />
                            <span class="checkmark"></span>
                            <span><?php echo $item['title'] ?></span>  
                        </label>
                    </div>        
                            <?php
                        }
                    }
                    ?> 
                </div>
            </div>
        </div>