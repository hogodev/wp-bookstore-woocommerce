<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

?>

<table class="td" cellspacing="0" cellpadding="6" style="width: 100%; font-family: 'Helvetica Neue', Helvetica, Roboto, Arial, sans-serif;" border="1">
    <thead>
        <tr>
            <th class="td" scope="col" style="text-align:left;"><?php _e( 'Product', 'woocommerce' ); ?></th>
            <th class="td" scope="col" style="text-align:left;"><?php _e( 'Link', 'woocommerce' ); ?></th>
        </tr>
    </thead>
    <tbody>
        <?php $body = $order->download_link();
            foreach ( $body as $item ) {?>
            <tr>
                <td class="td" style="text-align:left; vertical-align:middle; border: 1px solid #eee; font-family: 'Helvetica Neue', Helvetica, Roboto, Arial, sans-serif; word-wrap:break-word;">

                    <?php echo $item['title'] ?>
                
                </td>
                <td class="td" style="text-align:left; vertical-align:middle; border: 1px solid #eee; font-family: 'Helvetica Neue', Helvetica, Roboto, Arial, sans-serif;">
                 <a href="<?php echo $item['download_link'] ?>">Download Link</a>
                </td>
            </tr>
        <?php }?>
    </tbody>
</table>