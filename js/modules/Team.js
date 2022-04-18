export default function Team() {
    ( function($){  

        const sendAjaxPromise = (url, type, data) => new Promise((resolve, reject) => { 
            $.ajax({
                url: url,
                type: type,
                data: data, 
                success: function (result) {
                    resolve(result);
                },
                error: function (error) {
                    reject(error);
                }
            });
        }); 
        
        $('.m-invite-team').on('click',async function( e) {
            e.preventDefault( ) ;
            let $this = $(this) , $loading = $this, $response = $('#response-messenger') ,
                $dataId = $this.attr('data-userId') ;
            try {
                $loading.addClass('loading');
                const result = await sendAjaxPromise(mona_ajax_url.ajaxURL, 'post', {
                    action: 'm_a_invite_team',
                    data: $dataId, 
                });
                $loading.removeClass('loading');
                let $result = JSON.parse(result); 
                if( $result.status == 'success' ) {
                    // $response.addClass( 'green' ) ;
                    // $response.text( 'Mời thành công' );   
                    $(this).closest('.c-account').append( `<div class="tag red"> Đã mời </div>`);
                    $(this).closest('.c-account__btn-add').remove();
                }else{
                    $response.addClass( 'red' ) ; 
                    let $error = $result.mess;
                    $response.text( $error );  
                }
            } catch(e) {
                console.log(e);
                $loading.removeClass('loading');
            }  
        });
        $('#edit-name-team').on('submit' ,async function(e) {
            e.preventDefault();
            let $this = $(this),
                $data = $(this).serialize(),
                $loading = $(this).find('button');
            try {
                $loading.addClass('loading');
                const result = await sendAjaxPromise(mona_ajax_url.ajaxURL, 'post', {
                    action: 'm_a_edit_name',
                    data: $data, 
                });
                $loading.removeClass('loading');
                let $result = JSON.parse(result); 
                if( $result.status == 'success' ) {  
                    $('#response-messenger').css('color' , 'green') ;
                }else{
                    $('#response-messenger').css('color' , 'red') ; 
                }
                $('#response-messenger').text( $result.mess) ;
            } catch(e) {
                console.log(e);
                $loading.removeClass('loading');
            }  
        })
    } )(jQuery);
} 