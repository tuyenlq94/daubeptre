export default function User() {
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

        $('#mona-register-form').on('submit',async function ( e ) {
            e.preventDefault() ;
            let $this = $(this) , 
                $loading = $this.find('.main-btn-ajax'),  
                $response = $this.find('#response-messenger'),
                $data = $this.serialize();
            if( !$loading.hasClass('loading') ) {
                $response.html('');
                $response.attr('class' , '' );
                try {
                    $loading.addClass('loading');
                    const result = await sendAjaxPromise(mona_ajax_url.ajaxURL, 'post', {
                        action: 'm_a_register',
                        data: $data, 
                    });
                    $loading.removeClass('loading');
                    let $result = JSON.parse(result); 
                    if( $result.status == 'success' ) {
                        $response.addClass( 'green' ) ;
                        $response.text( 'Tạo tài khoản thành công' );
                        window.location.reload();
                    }else{
                        $response.addClass( 'red' ) ; 
                        let $error = $result.mess;
                        $response.html('<ul></ul>');
                        $.each( $error , function(i , e) {
                            
                            $response.find('ul').append(`<li>${e}</li>`)
                        })
                    }
                } catch(e) {
                    console.log(e);
                    $loading.removeClass('loading');
                } 
            }
        });
        $('.m-action-save-user-info').on('click',function (e) {
            e.preventDefault();
            $('#m-edit-user').submit();
        });

        $('#m-edit-user').on('submit',async function(e) {
            e.preventDefault();
            let $dataForm = $(this).serialize(), 
                $response = $(this).find( '#response-messenger'),
                $loading = $('.m-action-save-user-info');
                
            try {
                $loading.addClass('loading');
                const result = await sendAjaxPromise(mona_ajax_url.ajaxURL, 'post', {
                    action: 'm_a_edit_data',
                    data: $dataForm, 
                });
                $loading.removeClass('loading');
                let $result = JSON.parse(result); 
                if( $result.status == 'success' ) {
                    $response.addClass( 'green' ) ;
                    $response.text( 'Chỉnh sửa thông tin thành công' ); 
                    window.location.href = window.location.href.split('?')[0]; 
                }else{
                    $response.addClass( 'red' ) ; 
                    let $error = $result.mess;
                    $response.html('<ul></ul>');
                    $.each( $error , function(i , e) { 
                        $response.find('ul').append(`<li>${e}</li>`)
                    })
                }
            } catch(e) {
                console.log(e);
                $loading.removeClass('loading');
            } 
        })
        
    } )(jQuery);
} 