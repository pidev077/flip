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
            [
                'key'   => 'field_skdt_cost_label',
                'label' => 'Chi phí (hiển thị)',
                'name'  => 'cost_label',
                'type'  => 'text',
                'placeholder' => '500.000đ',
            ],
            [
                'key'   => 'field_skdt_expert_name',
                'label' => 'Tên chuyên gia',
                'name'  => 'expert_name',
                'type'  => 'text',
                'placeholder' => 'Kim Ji-woo',
            ],
            [
                'key'   => 'field_skdt_expert_role',
                'label' => 'Vai trò / địa điểm chuyên gia',
                'name'  => 'expert_role',
                'type'  => 'text',
                'placeholder' => 'Chuyên gia da liễu — Seoul, Hàn Quốc',
            ],
            [
                'key'   => 'field_skdt_format',
                'label' => 'Hình thức',
                'name'  => 'format',
                'type'  => 'text',
                'placeholder' => 'Trực tuyến (Zoom)',
            ],
            [
                'key'   => 'field_skdt_duration',
                'label' => 'Thời lượng',
                'name'  => 'duration',
                'type'  => 'text',
                'placeholder' => '90 phút',
            ],
            [
                'key'     => 'field_skdt_benefits',
                'label'   => 'Lợi ích khi tham gia',
                'name'    => 'benefits',
                'type'    => 'wysiwyg',
                'tabs'    => 'text',
                'toolbar' => 'basic',
                'media_upload' => 0,
            ],
            [
                'key'   => 'field_skdt_register_link',
                'label' => 'Link đăng ký',
                'name'  => 'register_link',
                'type'  => 'link',
            ],
            [
                'key'   => 'field_skdt_register_note',
                'label' => 'Ghi chú sau khi đăng ký',
                'name'  => 'register_note',
                'type'  => 'text',
                'placeholder' => 'Sau khi đăng ký, chuyên viên Tamya sẽ liên hệ xác nhận suất tham gia và gửi link phòng học qua email.',
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
