 
export default function Upload() {
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
         
 
        $('#js-upload-image-preview').on('load', function (e) {
            let $base64 = $(this).attr('src');  
            if($base64.startsWith("data")){
                $('.image-custom-user').css('z-index' , '-1');
                ajax_upload_img($base64) ;
            }  
        });

        async function ajax_upload_img($file) {
            let $loading = $('.mona-upload-loading .main-btn-ajax') 
            try {
                $loading.addClass('loading');
                const result = await sendAjaxPromise(mona_ajax_url.ajaxURL, 'post', {
                    action: 'mona_ajax_upload_post_img',
                    data: $file, 
                });
                $loading.removeClass('loading');
                let $result = JSON.parse(result);
                // $('#id-file-img').val($result.file_id);
                if( $result.status == 'success' ) {
                    $('.avatar-upload-info-desc').text($result.messenger);
                    $('.avatar-upload-info-desc').css('color' , 'green');
                }
            } catch(e) {
                console.log(e);
                $loading.removeClass('loading');
            } 
        }  
        
        const input_image = document.getElementById('js-upload-image-btn')
        const text_alert = document.getElementsByClassName('avatar-upload-info-desc')[0]
        if(input_image  && text_alert ) {
            input_image.addEventListener('change', (event) => {

                if (text_alert.classList.contains('warning')) {
                    text_alert.classList.remove("warning");
                } 
                const target = event.target
                if (target.files && target.files[0]) {
            
                    const maxAllowedSize = 2 * 1024 * 1024;
                    if (target.files[0].size > maxAllowedSize) {
                        text_alert.classList.add("warning");
                        // Here you can ask your users to load correct file
                        console.log('anh bu qua ban oi')
                        target.value = ''
                    } 
                } else {
                    text_alert.classList.add("warning");
                }
            });
        } 

        if (document.getElementById('js-upload-image-btn') && document.getElementById('js-upload-image-preview')) {
            const inputFile = document.getElementById('js-upload-image-btn');
            const previewImage = document.getElementById('js-upload-image-preview');
            uploadImage(inputFile, previewImage);
        }

        function uploadImage(inputFile, previewImage) {
            inputFile.addEventListener('change', function() {
                const file = this.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.addEventListener('load', function() {
                        previewImage.setAttribute('src', this.result);
                    });
                    reader.readAsDataURL(file);
                }
            });
        }
    } )(jQuery);
}