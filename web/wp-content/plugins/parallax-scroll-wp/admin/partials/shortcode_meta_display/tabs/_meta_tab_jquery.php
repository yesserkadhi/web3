<?php
if (!defined('WPINC')) {
    die;
}

$this->meta_form->buy_pro(
    array(
        'status'  => LGX_PARALLAX_PLUGIN_META_FIELD_PRO,
        'link' => 'https://logichunt.com/product/wp-parallax-scroll',
    )
);

$this->meta_form->number(
    array(
        'label'     => __( 'Speed', $this->plugin_name ),
        'desc'      => __( 'The speed at which the parallax effect runs. <br> <span style="color: #e31919">Note: Use numbers from -1.0 to 2.0</span>', $this->plugin_name ),
        'name'      => 'post_meta_lgx_parallax_generator[lgx_parallax_jquery_speed]',
        'id'        => 'lgx_parallax_jquery_speed',
        'min'       => -1.0,
        'max'       => 2.0,
        'default'   => 0.2,
    )
);
