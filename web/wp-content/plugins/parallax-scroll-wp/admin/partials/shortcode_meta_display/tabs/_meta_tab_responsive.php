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



/********************************************************************************/
$this->meta_form->header_spacer_light(
    array(
        'label'     => __( 'Large Desktops Devices (1200px and Up)', $this->plugin_name ),
    )
);
/********************************************************************************/


$this->meta_form->text(
    array(
        'label'     => __( 'Large Desktop Section Height', $this->plugin_name ),
        'desc'      => __( 'Add minimum section height with your desired unit. For example : 550px or, 55rem.', $this->plugin_name ),
        'name'      => 'post_meta_lgx_parallax_generator[lgx_sec_height_large_desktop]',
        'id'        => 'lgx_sec_height_large_desktop',
        'default'   => '550px'
    )
);

/********************************************************************************/
$this->meta_form->header_spacer_light(
    array(
        'label'     => __( 'Desktops Devices (Desktops 992px and Up).', $this->plugin_name ),
    )
);
/********************************************************************************/

$this->meta_form->text(
    array(
        'label'     => __( 'Desktop Section Height', $this->plugin_name ),
        'desc'      => __( 'Add minimum section height with your desired unit. For example : 500px or, 50rem.', $this->plugin_name ),
        'name'      => 'post_meta_lgx_parallax_generator[lgx_sec_height_desktop]',
        'id'        => 'lgx_sec_height_desktop',
        'default'   => '500px'
    )
);


/********************************************************************************/
$this->meta_form->header_spacer_light(
    array(
        'label'     => __( 'Tablets Devices (768px and Up)', $this->plugin_name ),
    )
);
/********************************************************************************/

$this->meta_form->text(
    array(
        'label'     => __( 'Tablet Section Height', $this->plugin_name ),
        'desc'      => __( 'Add minimum section height with your desired unit. For example : 450px or, 45rem.', $this->plugin_name ),
        'name'      => 'post_meta_lgx_parallax_generator[lgx_sec_height_tablet]',
        'id'        => 'lgx_sec_height_tablet',
        'default'   => '450px'
    )
);


/********************************************************************************/
$this->meta_form->header_spacer_light(
    array(
        'label'     => __( 'Mobile Devices (Less than 768px).', $this->plugin_name ),
    )
);
/********************************************************************************/

$this->meta_form->text(
    array(
        'label'     => __( 'Mobile Section Height', $this->plugin_name ),
        'desc'      => __( 'Add minimum section height with your desired unit. For example : 400px or, 40rem.', $this->plugin_name ),
        'name'      => 'post_meta_lgx_parallax_generator[lgx_sec_height_mobile]',
        'id'        => 'lgx_sec_height_mobile',
        'default'   => '400px'
    )
);
