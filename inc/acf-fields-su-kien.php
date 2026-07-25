<?php
/**
 * ACF field group cho custom post type "su-kien" (Sự kiện)
 * Đăng ký bằng code — không cần file JSON.
 */
add_action('acf/init', function () {
    if (!function_exists('acf_add_local_field_group')) return;

    acf_add_local_field_group([
        'key'    => 'group_su_kien',
        'title'  => 'Thông tin sự kiện',
        'fields' => [

            [
                'key'           => 'field_sk_event_date',
                'label'         => 'Ngày diễn ra',
                'name'          => 'event_date',
                'type'          => 'date_picker',
                'display_format'=> 'd.m.Y',
                'return_format' => 'd.m.Y',
                'first_day'     => 1,
            ],
            [
                'key'          => 'field_sk_event_time',
                'label'        => 'Khung giờ',
                'name'         => 'event_time',
                'type'         => 'text',
                'placeholder'  => '09:00 – 12:00',
            ],
            [
                'key'          => 'field_sk_event_location',
                'label'        => 'Địa điểm',
                'name'         => 'event_location',
                'type'         => 'text',
                'placeholder'  => 'Aqua 4, Vinhomes Ba Son, Quận 1',
            ],
            [
                'key'           => 'field_sk_register_link',
                'label'         => 'Nút đăng ký',
                'name'          => 'register_link',
                'type'          => 'link',
                'return_format' => 'array',
            ],

        ],
        'location' => [
            [
                [
                    'param'    => 'post_type',
                    'operator' => '==',
                    'value'    => 'su-kien',
                ],
            ],
        ],
        'menu_order'      => 0,
        'position'        => 'side',
        'style'           => 'default',
        'label_placement' => 'top',
    ]);
});

/**
 * Màu nhãn riêng cho từng danh mục sự kiện (hiển thị trên thẻ ở trang Sự Kiện).
 * Để trống thì dùng màu mặc định trong flip_su_kien_badge_color() (xanh / vàng đồng).
 */
add_action('acf/init', function () {
    if (!function_exists('acf_add_local_field_group')) return;

    acf_add_local_field_group([
        'key'    => 'group_danh_muc_su_kien_mau',
        'title'  => 'Màu nhãn',
        'fields' => [
            [
                'key'          => 'field_dmsk_tag_color',
                'label'        => 'Màu nhãn',
                'name'         => 'tag_color',
                'type'         => 'color_picker',
                'instructions' => 'Để trống sẽ dùng màu mặc định (xanh cho Lễ ra mắt/Talkshow, vàng đồng cho Vì Cộng đồng/Tri ân/Nội bộ).',
            ],
            [
                'key'          => 'field_dmsk_tag_text_color',
                'label'        => 'Màu chữ nhãn (chỉ áp dụng ở khối "Sự kiện nổi bật")',
                'name'         => 'tag_text_color',
                'type'         => 'color_picker',
                'instructions' => 'Để trống sẽ dùng màu chữ mặc định (trắng).',
            ],
        ],
        'location' => [
            [
                [
                    'param'    => 'taxonomy',
                    'operator' => '==',
                    'value'    => 'danh-muc-su-kien',
                ],
            ],
        ],
    ]);
});
