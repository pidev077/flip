<?php
/**
 * Template Name: Đặt Hẹn
 */

get_header();

$fb_link   = get_field('link_facebook', 'option')  ?: '#';
$zalo_link = get_field('link_zalo', 'option')       ?: '#';
$form_id   = get_option('tamya_booking_form_id');
?>

<main id="primary" class="site-main page-booking">

    <!-- ── Hero ──────────────────────────────────────────── -->
    <section class="bk-hero">
        <div class="container bk-hero__inner">

            <span class="bk-hero__eyebrow">ĐẶT HẸN</span>
            <h1 class="bk-hero__title">Bắt đầu hành trình<br><em>chăm sóc da.</em></h1>
            <p class="bk-hero__desc">Điền thông tin bên dưới – đội ngũ Tamya sẽ gọi xác nhận<br class="d-none d-md-block"> và tư vấn chi tiết trước khi bạn đến.</p>

            <div class="bk-hero__badges">
                <div class="bk-badge">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5S10.62 6.5 12 6.5s2.5 1.12 2.5 2.5S13.38 11.5 12 11.5z" fill="currentColor"/></svg>
                    <span>Tư vấn miễn phí</span>
                </div>
                <div class="bk-badge">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M12 1L3 5v6c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V5l-9-4zm0 10.99h7c-.53 4.12-3.28 7.79-7 8.94V12H5V6.3l7-3.11v8.8z" fill="currentColor"/></svg>
                    <span>Bảo mật thông tin</span>
                </div>
                <div class="bk-badge">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-6h2v6zm0-8h-2V7h2v2z" fill="currentColor"/></svg>
                    <span>Không áp lực</span>
                </div>
            </div>

        </div>
    </section>

    <!-- ── Form Section ──────────────────────────────────── -->
    <section class="bk-form-section">
        <div class="container bk-form-section__inner">

            <hr class="bk-divider">
            <p class="bk-section-label">THÔNG TIN ĐẶT HẸN</p>

            <?php if ($form_id) : ?>
                <?php echo do_shortcode('[contact-form-7 id="' . intval($form_id) . '" title="Tamya – Đặt Hẹn"]'); ?>
            <?php else : ?>
                <p style="text-align:center;padding:2rem 0;color:#888;">Form đang khởi tạo. Vui lòng tải lại trang sau vài giây.</p>
            <?php endif; ?>

            <hr class="bk-divider bk-divider--social">

            <!-- Social CTA -->
            <div class="bk-social">
                <p class="bk-social__label">HOẶC TƯ VẤN NGAY QUA</p>

                <a href="<?= esc_url($fb_link) ?>" class="bk-social__link" target="_blank" rel="noopener">
                    <span class="bk-social__icon bk-social__icon--fb">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="white" xmlns="http://www.w3.org/2000/svg"><path d="M24 12.073C24 5.403 18.627 0 12 0S0 5.403 0 12.073C0 18.1 4.388 23.094 10.125 24v-8.437H7.078v-3.49h3.047V9.41c0-3.025 1.792-4.697 4.533-4.697 1.312 0 2.686.236 2.686.236v2.97h-1.513c-1.491 0-1.956.93-1.956 1.886v2.267h3.328l-.532 3.49h-2.796V24C19.612 23.094 24 18.1 24 12.073z"/></svg>
                    </span>
                    <div class="bk-social__text">
                        <strong>Nhắn tin Fanpage</strong>
                        <small>Phản hồi trong vài phút</small>
                    </div>
                    <svg class="bk-social__arrow" width="20" height="20" viewBox="0 0 24 24" fill="none"><path d="M5 12h14M13 6l6 6-6 6" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
                </a>

                <a href="<?= esc_url($zalo_link) ?>" class="bk-social__link" target="_blank" rel="noopener">
                    <span class="bk-social__icon bk-social__icon--zalo">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><text x="50%" y="56%" dominant-baseline="middle" text-anchor="middle" font-family="Arial,sans-serif" font-weight="bold" font-size="10" fill="white">Za</text></svg>
                    </span>
                    <div class="bk-social__text">
                        <strong>Nhắn tin Zalo</strong>
                        <small>Tư vấn trực tiếp với chuyên gia</small>
                    </div>
                    <svg class="bk-social__arrow" width="20" height="20" viewBox="0 0 24 24" fill="none"><path d="M5 12h14M13 6l6 6-6 6" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
                </a>
            </div>

        </div>
    </section>

</main>

<script>
(function () {
    function initBranch() {
        var btns = document.querySelectorAll('.bk-branch-btn');
        var hidden = document.querySelector('.page-booking input[name="chi-nhanh"]');
        btns.forEach(function (btn) {
            btn.addEventListener('click', function () {
                btns.forEach(function (b) { b.classList.remove('is-active'); });
                btn.classList.add('is-active');
                if (hidden) hidden.value = btn.dataset.value;
            });
        });
    }

    function initTimeSlots() {
        var btns = document.querySelectorAll('.bk-slot-btn');
        var hidden = document.querySelector('.page-booking input[name="khung-gio"]');
        btns.forEach(function (btn) {
            btn.addEventListener('click', function () {
                btns.forEach(function (b) { b.classList.remove('is-active'); });
                btn.classList.add('is-active');
                if (hidden) hidden.value = btn.dataset.value;
            });
        });
    }

    function initSelect() {
        var selects = document.querySelectorAll('.page-booking select');
        selects.forEach(function (sel) {
            function update() {
                sel.classList.toggle('has-value', sel.selectedIndex > 0);
            }
            update();
            sel.addEventListener('change', update);
        });
    }

    function init() {
        initBranch();
        initTimeSlots();
        initSelect();
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
    } else {
        init();
    }

    document.addEventListener('wpcf7mailsent', function () {
        window.location.href = '<?php echo esc_js(home_url('/cam-on')); ?>';
    });
})();
</script>

<?php get_footer(); ?>
