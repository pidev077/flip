<?php
/**
 * Auto-create Contact Form 7 contact/message form for Tamya.
 * Runs once per environment (keyed by version number).
 * Bump $version to force-update the form body.
 */
add_action('init', function () {
    if (!class_exists('WPCF7_ContactForm')) return;

    $version = 1;
    $form_id = get_option('tamya_contact_form_id');
    $db_ver  = (int) get_option('tamya_contact_form_version', 0);

    if ($form_id && $db_ver >= $version) return;

    $form_body = '
<div class="ct-row">
  <div class="ct-col">
    <label class="ct-label">HỌ VÀ TÊN</label>
    [text* your-name placeholder "Nguyễn Minh Anh"]
  </div>
  <div class="ct-col">
    <label class="ct-label">SỐ ĐIỆN THOẠI</label>
    [tel* your-phone placeholder "0901 234 567"]
  </div>
</div>

<div class="ct-field">
  <label class="ct-label">DỊCH VỤ QUAN TÂM</label>
  [select dich-vu "Chọn dịch vụ..." "Trẻ hóa da" "Điều trị mụn" "Nâng cơ" "Xóa nám tàn nhang" "Chăm sóc da cơ bản" "Điều trị nám" "Làm trắng da" "Peel da" "RF Nâng cơ"]
</div>

<div class="ct-field">
  <label class="ct-label">CHI NHÁNH</label>
  <div class="ct-branch-wrap">
    <button type="button" class="ct-branch-btn is-active" data-value="Hồ Chí Minh">Hồ Chí Minh</button>
    <button type="button" class="ct-branch-btn" data-value="Hà Nội">Hà Nội</button>
  </div>
  [hidden chi-nhanh "Hồ Chí Minh"]
</div>

<div class="ct-field ct-field--last">
  <label class="ct-label">LỜI NHẮN <span class="ct-optional">(Tùy chọn)</span></label>
  [textarea loi-nhan placeholder "Mô tả ngắn tình trạng da hoặc câu hỏi của bạn..."]
</div>

<div class="ct-submit-wrap">
  [submit "GỬI TIN NHẮN →"]
  <p class="ct-submit-note">🔒 Thông tin bảo mật hoàn toàn, không chia sẻ với bên thứ ba.</p>
</div>
';

    $mail = [
        'subject'            => 'Tin nhắn mới từ [your-name] – Tamya Liên Hệ',
        'sender'             => 'Tamya Clinic <wordpressuser@' . parse_url(home_url(), PHP_URL_HOST) . '>',
        'body'               => "Tin nhắn mới từ website:\n\nHọ tên: [your-name]\nSố ĐT: [your-phone]\nDịch vụ: [dich-vu]\nChi nhánh: [chi-nhanh]\nLời nhắn: [loi-nhan]",
        'recipient'          => get_option('admin_email'),
        'additional_headers' => '',
        'attachments'        => '',
        'use_html'           => 0,
        'exclude_blank'      => 0,
    ];

    $messages = [
        'mail_sent_ok'             => 'Tamya đã nhận tin nhắn của bạn. Chuyên gia sẽ liên hệ lại trong vòng 2 giờ làm việc.',
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
        update_option('tamya_contact_form_version', $version);
        return;
    }

    $post_id = wp_insert_post([
        'post_type'   => 'wpcf7_contact_form',
        'post_title'  => 'Tamya – Liên Hệ',
        'post_status' => 'publish',
        'post_name'   => 'tamya-lien-he',
    ]);

    if ($post_id && !is_wp_error($post_id)) {
        update_post_meta($post_id, '_form', $form_body);
        update_post_meta($post_id, '_mail', $mail);
        update_post_meta($post_id, '_mail_2', ['active' => false, 'subject' => '', 'sender' => '', 'body' => '', 'recipient' => '', 'additional_headers' => '', 'attachments' => '', 'use_html' => 0, 'exclude_blank' => 0]);
        update_post_meta($post_id, '_messages', $messages);
        update_post_meta($post_id, '_additional_settings', '');
        update_option('tamya_contact_form_id', $post_id);
        update_option('tamya_contact_form_version', $version);
    }
}, 20);
