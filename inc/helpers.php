<?php

/**
 * Helpers
 */

function dump($data)
{
	print "<pre style=' background: rgba(0, 0, 0, 0.1); margin-bottom: 1.618em; padding: 1.618em; overflow: auto; max-width: 100%; '>==========================\n";
	if (is_array($data)) {
		print_r($data);
	} elseif (is_object($data)) {
		var_dump($data);
	} else {
		var_dump($data);
	}
	print "===========================</pre>";
}


if (!function_exists('flip_svg_icon')) {

	/**
	 * @param $icon
	 *
	 * @return mixed|string
	 */
	function flip_svg_icon($icon)
	{
		$icons = require(__DIR__ . '/svg.php');
		return isset($icons[$icon]) ? $icons[$icon] : '';
	}
}

if (!function_exists('flip_the_posts_navigation')) {
	function flip_the_posts_navigation($args = array(), $base = false, $query = false)
	{
		$args = wp_parse_args($args, array(
			'prev_text' => __('Older posts'),
			'next_text' => __('Newer posts'),
			'screen_reader_text' => __('Posts navigation'),
			'aria_label' => __('Posts'),
			'class' => 'posts-navigation',
		));

		$wp_query = $query ? $query : $GLOBALS['wp_query'];

		// Don't print empty markup if there's only one page.
		if ($wp_query->max_num_pages < 2) {
			return;
		}
		$paged = get_query_var('paged') ? intval(get_query_var('paged')) : 1;
		$pagenum_link = html_entity_decode(get_pagenum_link());
		if ($base) {
			$orig_req_uri = $_SERVER['REQUEST_URI'];
			$_SERVER['REQUEST_URI'] = $base;
			$pagenum_link = get_pagenum_link($paged - 1);
			$_SERVER['REQUEST_URI'] = $orig_req_uri;
		}

		$query_args = array();
		$url_parts = explode('?', $pagenum_link);
		if (isset($url_parts[1])) {
			wp_parse_str($url_parts[1], $query_args);
		}

		$pagenum_link = remove_query_arg(array_keys($query_args), $pagenum_link);
		$pagenum_link = trailingslashit($pagenum_link) . '%_%';
		$format = $GLOBALS['wp_rewrite']->using_index_permalinks() && !strpos($pagenum_link, 'index.php') ? 'index.php/' : '';
		$format .= $GLOBALS['wp_rewrite']->using_permalinks() ? user_trailingslashit('page/%#%', 'paged') : '?paged=%#%';

		// Set up paginated links.
		$links = paginate_links(array(
			'base' => $pagenum_link,
			'format' => $format,
			'total' => $wp_query->max_num_pages,
			'current' => $paged,
			'mid_size' => 1,
			// 'add_args'  => array_map('urlencode', $query_args),
			'prev_text' => $args['prev_text'],
			'next_text' => $args['next_text'],
		));

		if ($links): ?>
			<nav class="navigation paging-navigation">
				<span class="screen-reader-text"><?= $args['screen_reader_text']; ?></span>
				<?php echo '<div class="pagination loop-pagination">' . $links . '</div><!-- .pagination -->' ?>
			</nav><!-- .navigation -->
			<?php
		endif;
	}
}

if (!function_exists('__get_field')) {
	function __get_field($selector, $post_id = false, $format_value = true)
	{
		if (function_exists('__get_field')) {
			return get_field($selector, $post_id, $format_value);
		}

		return false;
	}
}
if (!function_exists('flip_event_date_badge')) {
	/**
	 * Chuyển ngày dạng "d.m.Y" (ACF date_picker) thành mảng ['day' => '28', 'month' => 'THG 6']
	 * dùng cho khối ngày/tháng đè lên ảnh sự kiện.
	 */
	function flip_event_date_badge($date_dmY)
	{
		if (empty($date_dmY)) {
			return null;
		}

		$dt = DateTime::createFromFormat('d.m.Y', $date_dmY);
		if (!$dt) {
			return null;
		}

		return [
			'day'   => $dt->format('d'),
			'month' => 'THG ' . (int) $dt->format('n'),
		];
	}
}

if (!function_exists('flip_su_kien_type_badge')) {
	/**
	 * Lấy danh mục dùng làm nhãn hiển thị trên thẻ sự kiện (VD: "Lễ ra mắt", "Vì Cộng đồng").
	 * Ưu tiên danh mục loại sự kiện, bỏ qua "Sắp diễn ra" / "Đã diễn ra" vì 2 nhãn đó chỉ dùng cho tab lọc.
	 */
	function flip_su_kien_type_badge($post_id)
	{
		$terms = get_the_terms($post_id, 'danh-muc-su-kien');
		if (!$terms || is_wp_error($terms)) {
			return null;
		}

		$status_slugs = ['sap-dien-ra', 'da-dien-ra'];
		foreach ($terms as $term) {
			if (!in_array($term->slug, $status_slugs, true)) {
				return $term;
			}
		}

		return $terms[0];
	}
}

if (!function_exists('flip_su_kien_badge_color')) {
	// Nhãn "Lễ ra mắt" / "Talkshow" dùng tông xanh, các nhãn còn lại (Vì Cộng đồng / Tri ân / Nội bộ) dùng tông vàng đồng.
	// Đây chỉ là màu mặc định — admin có thể ghi đè riêng cho từng danh mục qua flip_su_kien_tag_color().
	function flip_su_kien_badge_color($slug)
	{
		$gold_slugs = ['vi-cong-dong', 'tri-an', 'noi-bo'];
		return in_array($slug, $gold_slugs, true) ? 'gold' : 'green';
	}
}

if (!function_exists('flip_su_kien_tag_color')) {
	// Màu tuỳ chỉnh admin đặt riêng cho 1 danh mục (field "tag_color" trên trang sửa Term).
	// Trả về '' nếu admin chưa chọn màu — khi đó dùng fallback flip_su_kien_badge_color().
	function flip_su_kien_tag_color($term)
	{
		if (!$term || !function_exists('get_field')) {
			return '';
		}

		$color = get_field('tag_color', $term->taxonomy . '_' . $term->term_id);
		return $color ?: '';
	}
}

if (!function_exists('flip_su_kien_tag_text_color')) {
	// Màu chữ tuỳ chỉnh cho nhãn — chỉ dùng ở khối "Sự kiện nổi bật" (field "tag_text_color" trên trang sửa Term).
	// Trả về '' nếu admin chưa chọn màu — khi đó dùng màu chữ mặc định (trắng).
	function flip_su_kien_tag_text_color($term)
	{
		if (!$term || !function_exists('get_field')) {
			return '';
		}

		$color = get_field('tag_text_color', $term->taxonomy . '_' . $term->term_id);
		return $color ?: '';
	}
}

if (!function_exists('__get_fields')) {
	function __get_fields($post_id = false, $format_value = true)
	{
		if (function_exists('__get_fields')) {
			return get_fields($post_id, $format_value);
		}

		return [];
	}
}


