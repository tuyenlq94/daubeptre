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

        $(document).on('click' , '.m-save-point',async function(e) {
            e.preventDefault( );
            let $dataId = $(this).attr('data-testId'),
                $loading = $(this),
                $dataForm = $('.test-form').serialize(),
                $dataRequest = $('#data-request').val();
            try {
                $loading.addClass('loading');
                const result = await sendAjaxPromise(mona_ajax_url.ajaxURL, 'post', {
                    action: 'm_a_save_result_test',
                    dataTestId: $dataId, 
                    dataForm: $dataForm, 
                    dataRequest: $dataRequest, 
                });
                $loading.removeClass('loading');
                
                 
            } catch(e) {
                console.log(e);
                $loading.removeClass('loading');
            }   
        });
        $('#point-user').on('change' ,async function(e) {
            e.preventDefault( )
            let $value = $(this).val() , 
                $testId = $(this).attr('data-testID') ,
                $timeDone = $(this).attr('data-timeDone'), 
                $loading = $(this).closest('.box-has-ajax');

            try { 
                $loading.addClass('loading');
                const result = await sendAjaxPromise(mona_ajax_url.ajaxURL, 'post', {
                    action: 'm_a_save_point',
                    point: $value,  
                    testId: $testId,  
                    timeDone: $timeDone,  
                }); 
                $loading.removeClass('loading');
            } catch(e) {
                console.log(e); 
                $loading.removeClass('loading');
            }   
        });

        if( $('.ans-item.disabled-input-check').length ) {
            $('.ans-item.disabled-input-check').each( function (e, i) {
                $(this).find('input').attr('disabled' , true);
            })
        }

        $('#f-send-url-video').on('submit', async function(e){
            e.preventDefault();
            let $dataForm = $(this).serialize( ) ,
                $response = $(this).find('.response-messenger'),
                $loading = $(this).find('.main-btn-ajax');
            try { 
                $loading.addClass('loading');
                const result = await sendAjaxPromise(mona_ajax_url.ajaxURL, 'post', {
                    action: 'm_a_save_url',
                    dataForm: $dataForm,   
                }); 
                $loading.removeClass('loading');
                let $result = JSON.parse( result ) ;
                if( $result.status == 'success') { 
                    $response.css('color', 'green');
                } else {
                    $response.css('color', 'red');                  
                }
                $response.html($result.mess);
            } catch(e) {
                console.log(e); 
                $loading.removeClass('loading');
            }   

        })
        
    } )(jQuery);
} 