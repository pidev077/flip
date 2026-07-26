<?php
/**
 * "Sự kiện đào tạo" không còn trang single riêng — chi tiết hiển thị
 * qua popup trên trang danh sách đào tạo. Điều hướng mọi link cũ
 * (và crawler) về trang đó.
 */

$daotao_page = get_page_by_path('dao-tao');
$daotao_url  = $daotao_page ? get_permalink($daotao_page) : home_url('/dao-tao');

wp_redirect($daotao_url, 301);
exit;
