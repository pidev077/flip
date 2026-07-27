<?php
/**
 * ACF fields cho trang Liên Hệ (page template: page-lien-he.php)
 */
add_action('acf/init', function () {
    if (!function_exists('acf_add_local_field_group')) return;

    acf_add_local_field_group([
        'key'   => 'group_lien_he',
        'title' => 'Liên Hệ – Nội dung trang',
        'fields' => [

            // ── FAQ ───────────────────────────────────────────
            [
                'key'          => 'field_lien_he_faq_items',
                'label'        => 'Câu hỏi thường gặp',
                'name'         => 'faq_items',
                'type'         => 'repeater',
                'layout'       => 'block',
                'button_label' => 'Thêm câu hỏi',
                'collapsed'    => 'field_lien_he_faq_question',
                'min'          => 0,
                'max'          => 0,
                'sub_fields'   => [
                    [
                        'key'      => 'field_lien_he_faq_question',
                        'label'    => 'Câu hỏi',
                        'name'     => 'question',
                        'type'     => 'text',
                        'required' => 1,
                    ],
                    [
                        'key'      => 'field_lien_he_faq_answer',
                        'label'    => 'Câu trả lời',
                        'name'     => 'answer',
                        'type'     => 'textarea',
                        'rows'     => 3,
                        'required' => 1,
                        'instructions' => 'Dùng {hotline} trong câu trả lời nếu muốn chèn số hotline tổng.',
                    ],
                ],
            ],

        ],
        'location' => [
            [
                [
                    'param'    => 'page_template',
                    'operator' => '==',
                    'value'    => 'page-lien-he.php',
                ],
            ],
        ],
        'menu_order'      => 10,
        'position'        => 'normal',
        'style'           => 'default',
        'label_placement' => 'top',
    ]);
});
