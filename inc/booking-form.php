<?php
/**
 * Auto-create Contact Form 7 booking form for Tamya.
 * Runs once per environment (keyed by version number).
 * Safe to keep in codebase — does nothing after first successful run.
 * Bump $version to force-update the form body everywhere.
 */
add_action('init', function () {
    if (!class_exists('WPCF7_ContactForm')) return;

    $version = 2;
    $form_id = get_option('tamya_booking_form_id');
    $db_ver  = (int) get_option('tamya_booking_form_version', 0);

    if ($form_id && $db_ver >= $version) return;

    $form_body = '
<div class="bk-row">
  <div class="bk-col">
    <label class="bk-label">HỌ VÀ TÊN</label>
    [text* your-name placeholder "Nguyễn Minh Anh"]
  </div>
  <div class="bk-col">
    <label class="bk-label">SỐ ĐIỆN THOẠI</label>
    [tel* your-phone placeholder "0901 234 567"]
  </div>
</div>

<div class="bk-field">
  <label class="bk-label">DỊCH VỤ QUAN TÂM</label>
  [select* dich-vu "Chọn dịch vụ..." "Trẻ hóa da" "Điều trị mụn" "Nâng cơ" "Xóa nám tàn nhang" "Chăm sóc da cơ bản" "Điều trị nám" "Làm trắng da" "Peel da" "RF Nâng cơ"]
</div>

<div class="bk-field">
  <label class="bk-label">CHI NHÁNH</label>
  <div class="bk-branch-wrap">
    <button type="button" class="bk-branch-btn is-active" data-value="Hồ Chí Minh">Hồ Chí Minh</button>
    <button type="button" class="bk-branch-btn" data-value="Hà Nội">Hà Nội</button>
  </div>
  [hidden chi-nhanh "Hồ Chí Minh"]
</div>

<div class="bk-field">
  <label class="bk-label">NGÀY MONG MUỐN</label>
  [date* ngay-hen]
</div>

<div class="bk-field">
  <label class="bk-label">KHUNG GIỜ</label>
  <div class="bk-timeslot-wrap">
    <button type="button" class="bk-slot-btn" data-value="08:00 - 09:00">08:00 – 09:00</button>
    <button type="button" class="bk-slot-btn" data-value="09:00 - 10:00">09:00 – 10:00</button>
    <button type="button" class="bk-slot-btn" data-value="10:00 - 11:00">10:00 – 11:00</button>
    <button type="button" class="bk-slot-btn" data-value="13:00 - 14:00">13:00 – 14:00</button>
    <button type="button" class="bk-slot-btn" data-value="14:00 - 15:00">14:00 – 15:00</button>
    <button type="button" class="bk-slot-btn" data-value="15:00 - 16:00">15:00 – 16:00</button>
    <button type="button" class="bk-slot-btn" data-value="16:00 - 17:00">16:00 – 17:00</button>
    <button type="button" class="bk-slot-btn" data-value="17:00 - 18:00">17:00 – 18:00</button>
    <button type="button" class="bk-slot-btn" data-value="18:00 - 19:00">18:00 – 19:00</button>
  </div>
  [hidden khung-gio ""]
</div>

<div class="bk-field bk-field--last">
  <label class="bk-label">GHI CHÚ THÊM <span class="bk-optional">(Tùy chọn)</span></label>
  [textarea ghi-chu placeholder "Tình trạng da, câu hỏi, hoặc yêu cầu đặc biệt...."]
</div>

<div class="bk-submit-wrap">
  [submit "GỬI YÊU CẦU ĐẶT HẸN →"]
  <p class="bk-submit-note">Tamya sẽ gọi xác nhận lịch hẹn trong vòng <strong>2 giờ làm việc.</strong></p>
</div>
';

    $mail = [
        'subject'            => 'Đặt hẹn mới từ [your-name] – [ngay-hen]',
        'sender'             => 'Tamya Clinic <wordpressuser@' . parse_url(home_url(), PHP_URL_HOST) . '>',
        'body'               => "Có yêu cầu đặt hẹn mới:\n\nHọ tên: [your-name]\nSố ĐT: [your-phone]\nDịch vụ: [dich-vu]\nChi nhánh: [chi-nhanh]\nNgày: [ngay-hen]\nKhung giờ: [khung-gio]\nGhi chú: [ghi-chu]",
        'recipient'          => get_option('admin_email'),
        'additional_headers' => '',
        'attachments'        => '',
        'use_html'           => 0,
        'exclude_blank'      => 0,
    ];

    $messages = [
        'mail_sent_ok'             => 'Tamya đã nhận yêu cầu đặt hẹn của bạn. Chúng tôi sẽ gọi xác nhận trong vòng 2 giờ làm việc.',
        'mail_sent_ng'             => 'Có lỗi xảy ra. Vui lòng thử lại sau.',
        'validation_error'         => 'Vui lòng kiểm tra lại thông tin.',
        'spam'                     => 'Có lỗi xảy ra.',
        'accept_terms'             => '',
        'invalid_required'         => 'Vui lòng điền trường này.',
        'invalid_too_long'         => 'Nội dung quá dài.',
        'invalid_too_short'        => 'Nội dung quá ngắn.',
        'invalid_date'             => 'Ngày không hợp lệ.',
        'date_too_early'           => 'Ngày không được sớm hơn %date%.',
        'date_too_late'            => 'Ngày không được muộn hơn %date%.',
        'upload_failed'            => 'Tải file thất bại.',
        'upload_file_type_invalid' => 'Loại file không được phép.',
        'upload_file_too_large'    => 'File quá lớn.',
        'upload_failed_php_error'  => 'Tải file thất bại.',
        'invalid_number'           => 'Số không hợp lệ.',
        'number_too_small'         => 'Số quá nhỏ.',
        'number_too_large'         => 'Số quá lớn.',
        'quiz_answer_not_correct'  => 'Câu trả lời không đúng.',
        'invalid_email'            => 'Email không hợp lệ.',
        'invalid_url'              => 'URL không hợp lệ.',
        'invalid_tel'              => 'Số điện thoại không hợp lệ.',
    ];

    if ($form_id) {
        update_post_meta($form_id, '_form', $form_body);
        update_option('tamya_booking_form_version', $version);
        return;
    }

    $post_id = wp_insert_post([
        'post_type'   => 'wpcf7_contact_form',
        'post_title'  => 'Tamya – Đặt Hẹn',
        'post_status' => 'publish',
        'post_name'   => 'tamya-dat-hen',
    ]);

    if ($post_id && !is_wp_error($post_id)) {
        update_post_meta($post_id, '_form', $form_body);
        update_post_meta($post_id, '_mail', $mail);
        update_post_meta($post_id, '_mail_2', ['active' => false, 'subject' => '', 'sender' => '', 'body' => '', 'recipient' => '', 'additional_headers' => '', 'attachments' => '', 'use_html' => 0, 'exclude_blank' => 0]);
        update_post_meta($post_id, '_messages', $messages);
        update_post_meta($post_id, '_additional_settings', '');
        update_option('tamya_booking_form_id', $post_id);
        update_option('tamya_booking_form_version', $version);
    }
}, 20);
