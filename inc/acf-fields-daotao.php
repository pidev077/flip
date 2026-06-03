<?php
/**
 * ACF fields cho trang Đào Tạo (page template: page-daotao.php)
 */
add_action('acf/init', function () {
    if (!function_exists('acf_add_local_field_group')) return;

    acf_add_local_field_group([
        'key'   => 'group_daotao',
        'title' => 'Đào Tạo – Nội dung trang',
        'fields' => [

            // ── Zoom Training ────────────────────────────────────
            [
                'key'           => 'field_zoom_banner_image',
                'label'         => 'Ảnh banner Zoom Training',
                'name'          => 'zoom_banner_image',
                'type'          => 'image',
                'return_format' => 'array',
                'preview_size'  => 'medium',
                'instructions'  => 'Poster sự kiện, tỉ lệ 3:4 hoặc 4:5.',
            ],
            [
                'key'          => 'field_zoom_title',
                'label'        => 'Tiêu đề',
                'name'         => 'zoom_title',
                'type'         => 'text',
                'placeholder'  => 'Zoom Training Định Kỳ',
            ],
            [
                'key'          => 'field_zoom_description',
                'label'        => 'Mô tả',
                'name'         => 'zoom_description',
                'type'         => 'textarea',
                'rows'         => 3,
            ],
            [
                'key'          => 'field_zoom_schedule',
                'label'        => 'Lịch cố định',
                'name'         => 'zoom_schedule',
                'type'         => 'text',
                'placeholder'  => 'Thứ 5 hàng tuần',
            ],
            [
                'key'          => 'field_zoom_time',
                'label'        => 'Giờ',
                'name'         => 'zoom_time',
                'type'         => 'text',
                'placeholder'  => '20:00 – 21:30 (GMT+7)',
            ],
            [
                'key'          => 'field_zoom_price',
                'label'        => 'Giá / Tag',
                'name'         => 'zoom_price',
                'type'         => 'text',
                'placeholder'  => 'MIỄN PHÍ',
            ],
            [
                'key'           => 'field_zoom_register_link',
                'label'         => 'Nút Đăng Ký',
                'name'          => 'zoom_register_link',
                'type'          => 'link',
                'return_format' => 'array',
            ],
            [
                'key'          => 'field_zoom_note',
                'label'        => 'Ghi chú nhỏ',
                'name'         => 'zoom_note',
                'type'         => 'text',
                'placeholder'  => 'Thông tin Zoom sẽ được gửi qua email sau khi đăng ký',
            ],

            // ── Workshop images ──────────────────────────────────
            [
                'key'          => 'field_workshop_items',
                'label'        => 'Workshop Offline – Danh sách ảnh',
                'name'         => 'workshop_items',
                'type'         => 'repeater',
                'layout'       => 'block',
                'button_label' => 'Thêm workshop',
                'sub_fields'   => [
                    [
                        'key'           => 'field_ws_image',
                        'label'         => 'Ảnh',
                        'name'          => 'image',
                        'type'          => 'image',
                        'return_format' => 'array',
                        'preview_size'  => 'medium',
                        'instructions'  => 'Tỉ lệ 4:3 hoặc vuông.',
                    ],
                    [
                        'key'         => 'field_ws_title',
                        'label'       => 'Tên (tuỳ chọn)',
                        'name'        => 'title',
                        'type'        => 'text',
                        'placeholder' => 'VD: Workshop Trị Nám',
                    ],
                    [
                        'key'   => 'field_ws_link',
                        'label' => 'Link (tuỳ chọn)',
                        'name'  => 'link',
                        'type'  => 'url',
                    ],
                ],
            ],

        ],
        'location' => [
            [
                [
                    'param'    => 'page_template',
                    'operator' => '==',
                    'value'    => 'page-daotao.php',
                ],
            ],
        ],
        'menu_order'      => 10,
        'position'        => 'normal',
        'style'           => 'default',
        'label_placement' => 'top',
    ]);
});
