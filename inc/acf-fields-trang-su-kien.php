<?php
/**
 * ACF fields cho trang Sự Kiện (page template: page-su-kien.php)
 */
add_action('acf/init', function () {
    if (!function_exists('acf_add_local_field_group')) return;

    acf_add_local_field_group([
        'key'   => 'group_trang_su_kien',
        'title' => 'Sự Kiện – Nội dung trang',
        'fields' => [

            [
                'key'         => 'field_sktr_hero_title',
                'label'       => 'Tiêu đề banner',
                'name'        => 'hero_title',
                'type'        => 'text',
                'placeholder' => 'Sự kiện tại Tamya',
            ],
            [
                'key'         => 'field_sktr_hero_desc',
                'label'       => 'Mô tả banner',
                'name'        => 'hero_desc',
                'type'        => 'textarea',
                'rows'        => 3,
                'placeholder' => 'Workshop, talkshow chuyên gia, lễ ra mắt và những hoạt động vì cộng đồng — nơi Tamya kết nối và lan tỏa hành trình chữa lành.',
            ],
            [
                'key'          => 'field_sktr_featured_events',
                'label'        => 'Sự kiện nổi bật (tối đa 2)',
                'name'         => 'featured_events',
                'type'         => 'relationship',
                'post_type'    => ['su-kien'],
                'filters'      => ['search'],
                'min'          => 0,
                'max'          => 2,
                'return_format'=> 'object',
                'instructions' => 'Chọn tối đa 2 sự kiện hiển thị dạng thẻ ngang lớn trong mục "Sự kiện nổi bật".',
            ],

        ],
        'location' => [
            [
                [
                    'param'    => 'page_template',
                    'operator' => '==',
                    'value'    => 'page-su-kien.php',
                ],
            ],
        ],
        'menu_order'      => 10,
        'position'        => 'normal',
        'style'           => 'default',
        'label_placement' => 'top',
    ]);
});
