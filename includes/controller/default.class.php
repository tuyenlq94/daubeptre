<?php  

class MonaDefaultClass {
    /**
     * Notify error function 
     * @param string $mess
     * @return array 
     */
    public function error_mess($mess){
        return ['status'=>'error','mess'=>$mess];
    }
    /**
     * Notify success function 
     * @param string $mess
     * @return array 
     */
    public function success_mess($mess){
        return ['status'=>'success','mess'=>$mess];
    } 
}