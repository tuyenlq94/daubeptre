<?php 
# auto require file .class.php 
$classFiles = glob(get_template_directory()  . '/includes/controller/*.class.php');
foreach ($classFiles as $key => $url ) {
    require_once( $url );
}
