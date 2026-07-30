<?php
/**
 * ACF fields cho trang Chính Sách Bảo Mật (page template: page-chinh-sach-bao-mat.php)
 */
add_action('acf/init', function () {
	if (!function_exists('acf_add_local_field_group')) return;

	acf_add_local_field_group([
		'key'    => 'group_chinh_sach_bao_mat',
		'title'  => 'Chính Sách Bảo Mật – Nội dung trang',
		'fields' => [

			[
				'key'     => 'field_csbm_content_note',
				'label'   => '',
				'name'    => '',
				'type'    => 'message',
				'message' => 'Nội dung các mục chính sách nhập ngay trong khung "Nội dung" (block editor) của trang. Mỗi mục dùng khối <strong>Heading</strong>, chọn cấp độ <strong>H2</strong> — số thứ tự (01, 02...), id neo và mục lục bên trái sẽ tự tạo theo đúng thứ tự các khối H2 này.',
			],
			[
				'key'           => 'field_csbm_eyebrow',
				'label'         => 'Nhãn nhỏ trên tiêu đề',
				'name'          => 'eyebrow',
				'type'          => 'text',
				'default_value' => 'BẢO MẬT',
			],
			[
				'key'           => 'field_csbm_description',
				'label'         => 'Mô tả ngắn dưới tiêu đề',
				'name'          => 'description',
				'type'          => 'textarea',
				'rows'          => 3,
				'default_value' => 'Tamya tôn trọng và cam kết bảo vệ thông tin cá nhân của bạn. Trang này giải thích cách chúng tôi thu thập, sử dụng và bảo vệ dữ liệu khi bạn liên hệ và sử dụng dịch vụ của Tamya.',
			],

		],
		'location' => [
			[
				[
					'param'    => 'page_template',
					'operator' => '==',
					'value'    => 'page-chinh-sach-bao-mat.php',
				],
			],
		],
		'menu_order'      => 10,
		'position'        => 'normal',
		'style'           => 'default',
		'label_placement' => 'top',
	]);
});
