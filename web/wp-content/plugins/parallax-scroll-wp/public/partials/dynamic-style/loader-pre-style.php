<?php
if (!defined('WPINC')) {
    die;
}
?>
<style type="text/css">
    #lgx_lsw_preloader_<?php echo esc_attr($lgx_app_id);?> {
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        background: <?php echo esc_attr($lgx_preloader_bg_color);?>;
        z-index: 9999;
        position: absolute;
        left: 0;
        top: 0;
        height: 100%;
        width: 100%;
    }
</style>