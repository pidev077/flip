<?php
/**
 * ACF fields cho trang Chuyên Mục (page template: page-chuyen-muc.php)
 */
add_action('acf/init', function () {
    if (!function_exists('acf_add_local_field_group')) return;

    acf_add_local_field_group([
        'key'   => 'group_trang_chuyen_muc',
        'title' => 'Chuyên Mục – Nội dung trang',
        'fields' => [

            [
                'key'         => 'field_tcm_hero_title',
                'label'       => 'Tiêu đề banner',
                'name'        => 'hero_title',
                'type'        => 'text',
                'placeholder' => 'Kiến thức & Cảm hứng',
            ],
            [
                'key'         => 'field_tcm_hero_desc',
                'label'       => 'Mô tả banner',
                'name'        => 'hero_desc',
                'type'        => 'textarea',
                'rows'        => 3,
                'placeholder' => 'Góc chia sẻ của Tamya về chăm sóc da, xu hướng làm đẹp và lối sống cân bằng — để hành trình chữa lành tiếp nối mỗi ngày.',
            ],

        ],
        'location' => [
            [
                [
                    'param'    => 'page_template',
                    'operator' => '==',
                    'value'    => 'page-chuyen-muc.php',
                ],
            ],
        ],
        'menu_order'      => 10,
        'position'        => 'normal',
        'style'           => 'default',
        'label_placement' => 'top',
    ]);
});
