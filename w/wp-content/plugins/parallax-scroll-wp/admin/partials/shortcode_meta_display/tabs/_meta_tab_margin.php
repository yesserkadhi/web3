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
        'label'     => __( 'Section Top Margin', $this->plugin_name ),
        'desc'      => __( 'Add section top margin value with your desired unit. For example : 15px or, 15rem.', $this->plugin_name ),
        'name'      => 'post_meta_lgx_parallax_generator[lgx_margin_top]',
        'id'        => 'lgx_margin_top',
        'default' => '0px',        
    )
);


$this->meta_form->text(
    array(
        'label'     => __( 'Section Bottom Margin', $this->plugin_name ),
        'desc'      => __( 'Add section bottom margin value with your desired unit. For example : 15px or, 15rem.', $this->plugin_name ),
        'name'      => 'post_meta_lgx_parallax_generator[lgx_margin_bottom]',
        'id'        => 'lgx_margin_bottom',
        'default' => '0px',        
    )
);



$this->meta_form->text(
    array(
        'label'     => __( 'Section Left Margin', $this->plugin_name ),
        'desc'      => __( 'Add section left margin value with your desired unit. For example : 15px or, 15rem.', $this->plugin_name ),
        'name'      => 'post_meta_lgx_parallax_generator[lgx_margin_left]',
        'id'        => 'lgx_margin_left',
        'default' => '0px',        
    )
);



$this->meta_form->text(
    array(
        'label'     => __( 'Section Right Margin', $this->plugin_name ),
        'desc'      => __( 'Add section right margin value with your desired unit. For example : 15px or, 15rem.', $this->plugin_name ),
        'name'      => 'post_meta_lgx_parallax_generator[lgx_margin_right]',
        'id'        => 'lgx_margin_right',
        'default' => '0px',        
    )
);