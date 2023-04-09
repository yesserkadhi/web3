<?php
if (!defined('WPINC')) {
    die;
}

$this->meta_form->buy_pro(
    array(
        'status'  => LGX_PARALLAX_PLUGIN_META_FIELD_PRO,
        'link' => 'https://logichunt.com/product/wp-parallax-scroll/',
    )
);


$this->meta_form->text(
    array(
        'label'     => __( 'Section Top Padding', $this->plugin_name ),
        'desc'      => __( 'Add section top padding value with your desired unit. For example : 15px or, 15rem.', $this->plugin_name ),
        'name'      => 'post_meta_lgx_parallax_generator[lgx_padding_top]',
        'id'        => 'lgx_padding_top',
        'default' => '50px',        
    )
);


$this->meta_form->text(
    array(
        'label'     => __( 'Section Bottom Padding', $this->plugin_name ),
        'desc'      => __( 'Add section bottom padding value with your desired unit. For example : 15px or, 15rem.', $this->plugin_name ),
        'name'      => 'post_meta_lgx_parallax_generator[lgx_padding_bottom]',
        'id'        => 'lgx_padding_bottom',
        'default' => '50px',        
    )
);



$this->meta_form->text(
    array(
        'label'     => __( 'Section Left Padding', $this->plugin_name ),
        'desc'      => __( 'Add section left padding value with your desired unit. For example : 15px or, 15rem.', $this->plugin_name ),
        'name'      => 'post_meta_lgx_parallax_generator[lgx_padding_left]',
        'id'        => 'lgx_padding_left',
        'default' => '0px',        
    )
);



$this->meta_form->text(
    array(
        'label'     => __( 'Section Right Padding', $this->plugin_name ),
        'desc'      => __( 'Add section right padding value with your desired unit. For example : 15px or, 15rem.', $this->plugin_name ),
        'name'      => 'post_meta_lgx_parallax_generator[lgx_padding_right]',
        'id'        => 'lgx_padding_right',
        'default' => '0px',        
    )
);