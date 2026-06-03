<?php
/**
 * Template Name: Cảm Ơn
 */

get_header();

$fb_link   = get_field('link_facebook', 'option')  ?: '#';
$zalo_link = get_field('link_zalo', 'option')       ?: '#';

$info      = get_field('info_group', 'option') ?: [];
$phone     = $info['phone_number'] ?? null;
$hotline   = $phone ? esc_html($phone['title']) : '0964.202.040';
$hotline_url = $phone ? esc_url($phone['url']) : 'tel:0964202040';
?>

<main id="primary" class="site-main page-thanks">
    <section class="tk-section">
        <div class="container">
            <div class="tk-wrap">

                <!-- Checkmark icon -->
                <div class="tk-icon" aria-hidden="true">
                    <svg width="28" height="28" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M5 12.5L9.5 17L19 7" stroke="white" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </div>

                <p class="tk-label">ĐÃ NHẬN THÔNG TIN</p>

                <h1 class="tk-title">Tamya sẽ liên hệ<br>với bạn sớm nhất.</h1>

                <p class="tk-desc">
                    Đội ngũ tư vấn của chúng tôi sẽ gọi điện xác nhận<br class="d-none d-sm-block">
                    trong vòng <strong>2 giờ làm việc</strong>.
                </p>

                <div class="tk-divider"></div>

                <!-- Info card -->
                <div class="tk-info-card">
                    <div class="tk-info-row">
                        <span class="tk-info-label">Bước tiếp theo</span>
                        <span class="tk-info-value tk-info-value--accent">Tamya sẽ gọi cho bạn</span>
                    </div>
                    <div class="tk-info-row">
                        <span class="tk-info-label">Hotline</span>
                        <a class="tk-info-value" href="<?php echo $hotline_url; ?>"><?php echo $hotline; ?></a>
                    </div>
                    <div class="tk-info-row">
                        <span class="tk-info-label">Giờ làm việc</span>
                        <span class="tk-info-value">T2–T7 · 08:00–19:00</span>
                    </div>
                </div>

                <!-- Buttons -->
                <a class="tk-btn tk-btn--primary" href="<?php echo esc_url(home_url('/lieu-trinh')); ?>">
                    KHÁM PHÁ LIỆU TRÌNH →
                </a>
                <a class="tk-btn tk-btn--secondary" href="<?php echo esc_url(home_url('/')); ?>">
                    Về trang chủ
                </a>

                <!-- Social note -->
                <p class="tk-social-note">
                    Muốn tư vấn ngay? Nhắn tin qua
                    <a href="<?php echo esc_url($fb_link); ?>" target="_blank" rel="noopener">Fanpage</a>
                    hoặc
                    <a href="<?php echo esc_url($zalo_link); ?>" target="_blank" rel="noopener">Zalo</a>
                    của Tamya.
                </p>

            </div>
        </div>
    </section>
</main>

<?php get_footer(); ?>
