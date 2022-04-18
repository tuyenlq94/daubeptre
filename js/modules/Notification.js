export default function MonaNotification() {
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
        
        $(document).on('click','.remove-btn' ,async function(e) {
            e.preventDefault();
            let NotificationId = $(this).closest('.btn').attr('data-id'), 
                $loading = $(this).closest('.box-has-ajax');
           
            try {
                $loading.addClass('loading');
                const result = await sendAjaxPromise(mona_ajax_url.ajaxURL, 'post', {
                    action: 'm_a_remove_noti',
                    NotiId: NotificationId, 
                });
                $loading.removeClass('loading');
                reloadNoti();
                 
            } catch(e) {
                console.log(e);
                $loading.removeClass('loading');
            } 
        });
        $(document).on('click','.accept-btn', async function (e) {
            e.preventDefault();
            let NotificationId = $(this).closest('.btn').attr('data-id'), 
                $loading = $(this).closest('.box-has-ajax');
            try {
                $loading.addClass('loading');
                const result = await sendAjaxPromise(mona_ajax_url.ajaxURL, 'post', {
                    action: 'm_a_accept_noti',
                    NotiId: NotificationId, 
                });
                $loading.removeClass('loading');
                let $result = JSON.parse( result ); 
                if( $result.status == 'success') { 
                    if( $result.urlBtn != '') {
                        Swal.fire({
                            title: 'Thành công!',
                            text: $result.mess,
                            icon: 'success',
                            showDenyButton: true, 
                            confirmButtonText: `Bắt đầu`,
                            denyButtonText: `Không`,
                        }).then((result) => { 
                            if (result.isConfirmed) {
                               location.href = $result.urlBtn;
                            }      
                        });
                    }
                    if( $result.urlBtn_2 != '') {
                        Swal.fire({
                            title: 'Thành công!',
                            text: $result.mess,
                            icon: 'success',
                            showDenyButton: true, 
                            confirmButtonText: `Mời thêm`,
                            denyButtonText: `Không`,
                        }).then((result) => { 
                            if (result.isConfirmed) {
                               location.href = $result.urlBtn_2;
                            }      
                        });
                    } 
                }   
                if( $result.status =='error')  {
                    Swal.fire(
                        'Thất bại',
                        $result.mess,
                        'info'
                    );
                }
                
                
            } catch(e) {
                console.log(e);
                $loading.removeClass('loading');
            } 
        })
        async function reloadNoti() {
            let $loading = $('.header-noti-content .box-has-ajax');
            try {
                $loading.addClass('loading');
                const result = await sendAjaxPromise(mona_ajax_url.ajaxURL, 'post', {
                    action: 'm_a_reload_noti', 
                });
                $loading.removeClass('loading');
                $('.header-noti').html( result );
                 
            } catch(e) {
                console.log(e);
                $loading.removeClass('loading');
            } 
        }  
    } )(jQuery);
} 