<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
$body = $order->download_link();
foreach ( $body as $item ) {

    echo $item['title']; 
    echo $item['download_link'];
    
}
?>