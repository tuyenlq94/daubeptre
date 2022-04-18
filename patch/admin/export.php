<style>
    @import url("<?php echo site_url('template/') ?>/js/libs/Font-awesome-4.7.0/css/font-awesome.min.css");

    html {
        box-sizing: border-box;
    }

    .hide {
        display: none;
    }

    .button {
        position: relative;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        width: 12.5rem;
        margin: 0;
        padding: 1.5rem 3.125rem;
        background-color: #3498db;
        border: none;
        border-radius: 0.3125rem;
        box-shadow: 0 12px 24px 0 rgba(0, 0, 0, 0.2);
        color: white;
        font-weight: 300;
        text-transform: uppercase;
        overflow: hidden;
    }

    .button:before {
        position: absolute;
        content: '';
        bottom: 0;
        left: 0;
        width: 0%;
        height: 100%;
        background-color: #54d98c;
    }

    .button span {
        position: absolute;
        line-height: 0;
    }

    .button span i {
        transform-origin: center center;
    }

    .button span:nth-of-type(1) {
        top: 50%;
        transform: translate(-50%, -50%);
        left: 50%;
    }

    .button span:nth-of-type(2) {
        top: 100%;
        transform: translateY(0%);
        font-size: 24px;
    }

    .button span:nth-of-type(3) {
        display: none;
    }

    .active {
        background-color: #2ecc71;
    }

    .active:before {
        width: 100%;
        transition: width 3s linear;
    }

    .active span:nth-of-type(1) {
        top: -100%;
        transform: translateY(-50%);
    }

    .active span:nth-of-type(2) {
        top: 50%;
        transform: translateY(-50%);
    }

    .active span:nth-of-type(2) i {
        animation: loading 500ms linear infinite;
    }

    .active span:nth-of-type(3) {
        display: none;
    }

    .finished {
        background-color: #54d98c;
    }

    .finished .submit {
        display: none;
    }

    .finished .loading {
        display: none;
    }

    .finished .check {
        display: block !important;
        font-size: 24px;
        animation: scale 0.5s linear;
    }

    .finished .check i {
        transform-origin: center center;
    }

    @keyframes loading {
        100% {
            transform: rotate(360deg);
        }
    }

    @keyframes scale {
        0% {
            transform: scale(10);
        }

        50% {
            transform: scale(0.2);
        }

        70% {
            transform: scale(1.2);
        }

        90% {
            transform: scale(0.7);
        }

        100% {
            transform: scale(1);
        }
    }
</style>
<div class="wrap">

    <h1><?php echo esc_html(get_admin_page_title()); ?></h1>

    <div>

        <div id="universal-message-container">
            <h2>Xuất Data Nhóm</h2>
            <div class="options">
                <a href="#" class="button export-data-teams">
                    <span class="submit">Export</span>
                    <span class="loading"><i class="fa fa-refresh"></i></span>
                    <span class="check"><i class="fa fa-check"></i></span>
                </a>
            </div>
        </div>
        <div id="universal-message-container">
            <h2>Xuất Data Học sinh</h2>
            <div class="options">
                <a href="#" class="button export-data-user">
                    <span class="submit">Export</span>
                    <span class="loading"><i class="fa fa-refresh"></i></span>
                    <span class="check"><i class="fa fa-check"></i></span>
                </a>
            </div>
        </div>
    </div>

</div>
<script>
    (function($) {
        $('.export-data-teams').on('click', function(e) {
            let $loading = $(this);
            e.preventDefault();
            $.ajax({
                url: ajaxurl,
                type: 'post',
                data: {
                    action: 'm_a_export_teams',
                },
                error: function(error) {
                    $loading.removeClass('active');
                },
                beforeSend: function(data) {
                    $loading.addClass('active');
                },
                success: function(result) {
                    var filename = "Danh sách Nhóm.csv";
                    export_file(result, filename);
                    $loading.removeClass('active');
                    $loading.addClass('finished');
                    setTimeout(() => {
                        $loading.removeClass('finished');
                    }, 5000);
                },
            });
        })
        $('.export-data-user').on('click', function(e) {
            let $loading = $(this);
            e.preventDefault();
            $.ajax({
                url: ajaxurl,
                type: 'post',
                data: {
                    action: 'm_a_export_users',
                },
                error: function(error) {
                    $loading.removeClass('active');
                },
                beforeSend: function(data) {
                    $loading.addClass('active');
                },
                success: function(result) {
                    var filename = "Danh sách tất cả học sinh.csv";
                    export_file(result, filename);
                    $loading.removeClass('active');
                    $loading.addClass('finished');
                    setTimeout(() => {
                        $loading.removeClass('finished');
                    }, 5000);
                },
            });
        });

        function export_file(result, filename) {
            var BOM = new Uint8Array([0xEF, 0xBB, 0xBF]);

            var type = "text/plain;charset=UTF-8";
            var blob = new Blob([BOM, result], {
                encoding: "UTF-8",
                type: type
            }); // 

            if (typeof window.navigator.msSaveBlob !== 'undefined') {
                // IE workaround for "HTML7007: One or more blob URLs were revoked by closing the blob for which they were created. These URLs will no longer resolve as the data backing the URL has been freed."
                window.navigator.msSaveBlob(blob, filename);
            } else {
                var URL = window.URL || window.webkitURL;
                var downloadUrl = URL.createObjectURL(blob);

                if (filename) {
                    // use HTML5 a[download] attribute to specify filename
                    var a = document.createElement("a");
                    // safari doesn't support this yet
                    if (typeof a.download === 'undefined') {
                        window.location = downloadUrl;
                    } else {
                        a.href = downloadUrl;
                        a.download = filename;
                        document.body.appendChild(a);
                        a.click();
                    }
                } else {
                    window.location = downloadUrl;
                }

                setTimeout(function() {
                    URL.revokeObjectURL(downloadUrl);
                }, 100); // cleanup
            }
        }
    })(jQuery); 
</script>