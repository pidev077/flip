<?php
/**
 * ACF field group cho custom post type "su-kien-dao-tao" (Sự kiện đào tạo)
 * Đăng ký bằng code — không cần file JSON.
 */
add_action('acf/init', function () {
    if (!function_exists('acf_add_local_field_group')) return;

    acf_add_local_field_group([
        'key'    => 'group_su_kien_dao_tao',
        'title'  => 'Thông tin sự kiện đào tạo',
        'fields' => [

            [
                'key'           => 'field_skdt_event_date',
                'label'         => 'Ngày diễn ra',
                'name'          => 'event_date',
                'type'          => 'date_picker',
                'display_format'=> 'd.m.Y',
                'return_format' => 'd.m.Y',
                'first_day'     => 1,
            ],
            [
                'key'          => 'field_skdt_event_time',
                'label'        => 'Khung giờ',
                'name'         => 'event_time',
                'type'         => 'text',
                'placeholder'  => '19:30 – 21:00',
            ],
            [
                'key'           => 'field_skdt_price_type',
                'label'         => 'Loại giá',
                'name'          => 'price_type',
                'type'          => 'select',
                'choices'       => [
                    'mien_phi' => 'Miễn phí',
                    'co_phi'   => 'Có phí',
                ],
                'default_value' => 'co_phi',
                'allow_null'    => 0,
                'ui'            => 1,
            ],

        ],
        'location' => [
            [
                [
                    'param'    => 'post_type',
                    'operator' => '==',
                    'value'    => 'su-kien-dao-tao',
                ],
            ],
        ],
        'menu_order'      => 0,
        'position'        => 'side',
        'style'           => 'default',
        'label_placement' => 'top',
    ]);
});
