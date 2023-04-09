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


$this->meta_form->text(
    array(
        'label'     => __( 'Parallax Area Max Width', $this->plugin_name ),
        'desc'      => __( 'Add parallax area maximum width with unit. For example: 100% or 1160px', $this->plugin_name ),
        'name'      => 'post_meta_lgx_parallax_generator[lgx_section_width]',
        'id'        => 'lgx_section_width',
        'default'   => '100%'
    )
);


$this->meta_form->select(
    array(
        'label'     => __( 'Parallax Content Container Type', $this->plugin_name ),
        'desc'      => __( 'Select Showcase Container Type.', $this->plugin_name ),
        'name'      => 'post_meta_lgx_parallax_generator[lgx_section_container]',
        'id'        => 'lgx_section_container',
        'default'   => 'container-fluid',
        'options'   => array(
            'container-fluid' => __( 'Container Fluid', $this->plugin_name ),
            'container' => __( 'Container', $this->plugin_name ),
        )
    )
);



$this->meta_form->switch(
    array(
        'label'   => __( 'Enable Background Overlay Color', $this->plugin_name ),
        'yes_label' => __( 'Enabled', $this->plugin_name ),
        'no_label' => __( 'Disabled', $this->plugin_name ),
        'desc'    => __( 'Enable background or image Overlay Color for parallax section. You use as a background color.', $this->plugin_name ),
        'name'    => 'post_meta_lgx_parallax_generator[lgx_section_bg_color_en]',
        'id'      => 'lgx_section_bg_color_en',
        'default' => 'no'
    )
);


$this->meta_form->color(
    array(
        'label'   => __( 'Background Overlay Color', $this->plugin_name ),
        'desc'    => __( 'Choose background/ overlay Color for showcase section.', $this->plugin_name ),
        'name'    => 'post_meta_lgx_parallax_generator[lgx_section_bg_color]',
        'id'      => 'lgx_section_bg_color',
        'default' => 'rgba(0,0,0,0.5)'
    )
);


$this->meta_form->select(
    array(
        'label' => __( ' Content Vertical Alignment', $this->plugin_name ),
        'desc' => __( 'Set Content vertical alignment (Align).', $this->plugin_name ),
        'name' => 'post_meta_lgx_parallax_generator[lgx_align_items]',
        'id' => 'lgx_align_items',
        'default'   => 'center',
        'options'   => array(
            'flex-start' => __( 'Top', $this->plugin_name ),
            'center' => __( 'Vertically Middle', $this->plugin_name ),
            'flex-end' => __( 'Bottom', $this->plugin_name ),
        )
    )
);


$this->meta_form->select(
    array(
        'label' => __( 'Content Horizontal Alignment', $this->plugin_name ),
        'desc' => __( 'Set flexible items horizontal alignment ( Justify ).', $this->plugin_name ),
        'name' => 'post_meta_lgx_parallax_generator[lgx_justify_content]',
        'id' => 'lgx_justify_content',
        'default'   => 'center',
        'options'   => array(
            'flex-start' => __( 'Left', $this->plugin_name ),
            'center' => __( ' Center', $this->plugin_name ),
            'flex-end' => __( 'Right', $this->plugin_name ),
        )
    )
);

