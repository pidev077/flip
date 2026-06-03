<?php
/**
 * ACF field group for posts – thông tin tác giả bài viết
 */
add_action('acf/init', function () {
    if (!function_exists('acf_add_local_field_group')) return;

    acf_add_local_field_group([
        'key'      => 'group_post_author',
        'title'    => 'Thông tin tác giả',
        'fields'   => [

            [
                'key'           => 'field_author_avatar',
                'label'         => 'Ảnh đại diện tác giả',
                'name'          => 'author_avatar',
                'type'          => 'image',
                'return_format' => 'array',
                'preview_size'  => 'thumbnail',
                'instructions'  => 'Ảnh vuông, khuyến nghị 200×200px.',
            ],

            [
                'key'          => 'field_author_name',
                'label'        => 'Tên tác giả',
                'name'         => 'author_name',
                'type'         => 'text',
                'placeholder'  => 'VD: Dr. Nguyễn Minh Tâm',
                'instructions' => 'Hiển thị trên hero và dải tác giả.',
            ],

            [
                'key'          => 'field_author_role',
                'label'        => 'Vị trí / Chức danh',
                'name'         => 'author_role',
                'type'         => 'text',
                'placeholder'  => 'VD: Bác sĩ da liễu · Tamya Clinic',
                'instructions' => 'Dòng mô tả ngắn bên dưới tên tác giả.',
            ],

            [
                'key'          => 'field_author_bio',
                'label'        => 'Giới thiệu tác giả',
                'name'         => 'author_bio',
                'type'         => 'textarea',
                'rows'         => 3,
                'placeholder'  => 'Vài dòng giới thiệu ngắn về tác giả...',
                'instructions' => 'Hiển thị trong khung tác giả cuối bài.',
            ],

        ],
        'location' => [
            [
                [
                    'param'    => 'post_type',
                    'operator' => '==',
                    'value'    => 'post',
                ],
            ],
        ],
        'menu_order'     => 10,
        'position'       => 'normal',
        'style'          => 'seamless',
        'label_placement'=> 'top',
    ]);
});
