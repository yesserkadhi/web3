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


$this->meta_form->select(
    array(
        'label'     => __( 'Background Type', $this->plugin_name ),
        'desc'      => __( 'Select Background Attachment Type. Parallax effect is not supported by some ios or mobile browser. It is not a bug. you can use media queries to turn off the effect on mobile devices. ', $this->plugin_name ),
        'name'      => 'post_meta_lgx_parallax_generator[lgx_bg_img_attachment]',
        'id'        => 'lgx_bg_img_attachment',
        'default'   => 'fixed',
        'options'   => array(
            'initial' => __( 'Initial', $this->plugin_name ),
            'fixed' => __( 'Parallax', $this->plugin_name )
        )
    )
);

$this->meta_form->select(
    array(
        'label'     => __( 'Background Size Type', $this->plugin_name ),
        'desc'      => __( 'Set Background Size Type for background image.', $this->plugin_name ),
        'name'      => 'post_meta_lgx_parallax_generator[lgx_bg_img_size_type]',
        'id'        => 'lgx_bg_img_size_type',
        'status'  => LGX_PARALLAX_PLUGIN_META_FIELD_PRO,
        'default'   => 'cover',
        'options'   => array(
            'cover' => __( 'Cover', $this->plugin_name ),
            'contain' => __( 'Contain', $this->plugin_name ),
            'auto' => __( 'Auto', $this->plugin_name ),
            'custom' => __( 'Custom', $this->plugin_name )
        )
    )
);


$this->meta_form->text(
    array(
        'label'     => __( 'Custom Background Size', $this->plugin_name ),
        'desc'      => __( 'You can use a custom background size. You can use  your desired unit. For example :  50% or, 600px. <br> <span style="color: #e31919">Note: To use this, please select "Background Size Type" as "Custom".</span>', $this->plugin_name ),
        'name'      => 'post_meta_lgx_parallax_generator[lgx_bg_img_size_custom]',
        'id'        => 'lgx_bg_img_size_custom',
        'status'  => LGX_PARALLAX_PLUGIN_META_FIELD_PRO,
        'default' => '50%',        
    )
);


$this->meta_form->select(
    array(
        'label'     => __( 'Background Repeat Type', $this->plugin_name ),
        'desc'      => __( 'Set Background Size Type for background image.', $this->plugin_name ),
        'name'      => 'post_meta_lgx_parallax_generator[lgx_bg_img_repeat_type]',
        'id'        => 'lgx_bg_img_repeat_type',
        'default'   => 'no-repeat',
        'options'   => array(
            'no-repeat' => __( 'No Repeat', $this->plugin_name ),
            'repeat' => __( 'Repeat', $this->plugin_name ),
            'space' => __( 'Space', $this->plugin_name ),
            'repeat-x' => __( ' Repeat X;', $this->plugin_name ),
            'repeat-y' => __( 'Repeat Y', $this->plugin_name ),
            'round' => __( 'Space', $this->plugin_name ),
        )
    )
);


/*
$this->meta_form->switch(
    array(
        'label' => __( 'Disable Parallax Effect Mobile', $this->plugin_name ),
        'yes_label' => __( 'Yes', $this->plugin_name ),
        'no_label' => __( 'No', $this->plugin_name ),
        'desc' => __( 'Enable this option if you would rather the parallax effect not display at all on mobile devices.', $this->plugin_name ),
        'name' => 'post_meta_lgx_parallax_generator[lgx_parallax_dis_mobile]',
        'id' => 'lgx_parallax_dis_mobile',
        'default' => 'no'
    )
);
*/