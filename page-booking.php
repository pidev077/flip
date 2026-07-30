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
        <div class="container container--860 bk-hero__inner">

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
        <div class="container container--860 bk-form-section__inner">

            <div class="bk-form-card">
                <p class="bk-section-label">THÔNG TIN ĐẶT HẸN</p>
                <p class="bk-form-card__desc">Điền đầy đủ thông tin bên dưới, Tamya sẽ gọi xác nhận lịch hẹn trong vòng 2 giờ làm việc.</p>

                <?php if ($form_id) : ?>
                    <?php echo do_shortcode('[contact-form-7 id="' . intval($form_id) . '" title="Tamya – Đặt Hẹn"]'); ?>
                <?php else : ?>
                    <p style="text-align:center;padding:2rem 0;color:#888;">Form đang khởi tạo. Vui lòng tải lại trang sau vài giây.</p>
                <?php endif; ?>
            </div>

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
                    <span class="bk-social__icon bk-social__icon--zalo" style="background:transparent;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="38" height="38" viewBox="0 0 50 50" fill="none">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M22.782 0.166016H27.199C33.2653 0.166016 36.8103 1.05701 39.9572 2.74421C43.1041 4.4314 45.5875 6.89585 47.2557 10.0428C48.9429 13.1897 49.8339 16.7347 49.8339 22.801V27.1991C49.8339 33.2654 48.9429 36.8104 47.2557 39.9573C45.5685 43.1042 43.1041 45.5877 39.9572 47.2559C36.8103 48.9431 33.2653 49.8341 27.199 49.8341H22.8009C16.7346 49.8341 13.1896 48.9431 10.0427 47.2559C6.89583 45.5687 4.41243 43.1042 2.7442 39.9573C1.057 36.8104 0.166016 33.2654 0.166016 27.1991V22.801C0.166016 16.7347 1.057 13.1897 2.7442 10.0428C4.43139 6.89585 6.89583 4.41245 10.0427 2.74421C13.1707 1.05701 16.7346 0.166016 22.782 0.166016Z" fill="#0068FF"/>
                            <path opacity="0.12" fill-rule="evenodd" clip-rule="evenodd" d="M49.8336 26.4736V27.1994C49.8336 33.2657 48.9427 36.8107 47.2555 39.9576C45.5683 43.1045 43.1038 45.5879 39.9569 47.2562C36.81 48.9434 33.265 49.8344 27.1987 49.8344H22.8007C17.8369 49.8344 14.5612 49.2378 11.8104 48.0966L7.27539 43.4267L49.8336 26.4736Z" fill="#001A33"/>
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M7.779 43.5892C10.1019 43.846 13.0061 43.1836 15.0682 42.1825C24.0225 47.1318 38.0197 46.8954 46.4923 41.4732C46.8209 40.9803 47.1279 40.4677 47.4128 39.9363C49.1062 36.7779 50.0004 33.22 50.0004 27.1316V22.7175C50.0004 16.629 49.1062 13.0711 47.4128 9.91273C45.7385 6.75436 43.2461 4.28093 40.0877 2.58758C36.9293 0.894239 33.3714 0 27.283 0H22.8499C17.6644 0 14.2982 0.652754 11.4699 1.89893C11.3153 2.03737 11.1636 2.17818 11.0151 2.32135C2.71734 10.3203 2.08658 27.6593 9.12279 37.0782C9.13064 37.0921 9.13933 37.1061 9.14889 37.1203C10.2334 38.7185 9.18694 41.5154 7.55068 43.1516C7.28431 43.399 7.37944 43.5512 7.779 43.5892Z" fill="white"/>
                            <path d="M20.5632 17H10.8382V19.0853H17.5869L10.9329 27.3317C10.7244 27.635 10.5728 27.9194 10.5728 28.5639V29.0947H19.748C20.203 29.0947 20.5822 28.7156 20.5822 28.2606V27.1421H13.4922L19.748 19.2938C19.8428 19.1801 20.0134 18.9716 20.0893 18.8768L20.1272 18.8199C20.4874 18.2891 20.5632 17.8341 20.5632 17.2844V17Z" fill="#0068FF"/>
                            <path d="M32.9416 29.0947H34.3255V17H32.2402V28.3933C32.2402 28.7725 32.5435 29.0947 32.9416 29.0947Z" fill="#0068FF"/>
                            <path d="M25.814 19.6924C23.1979 19.6924 21.0747 21.8156 21.0747 24.4317C21.0747 27.0478 23.1979 29.171 25.814 29.171C28.4301 29.171 30.5533 27.0478 30.5533 24.4317C30.5723 21.8156 28.4491 19.6924 25.814 19.6924ZM25.814 27.2184C24.2785 27.2184 23.0273 25.9672 23.0273 24.4317C23.0273 22.8962 24.2785 21.645 25.814 21.645C27.3495 21.645 28.6007 22.8962 28.6007 24.4317C28.6007 25.9672 27.3685 27.2184 25.814 27.2184Z" fill="#0068FF"/>
                            <path d="M40.4867 19.6162C37.8516 19.6162 35.7095 21.7584 35.7095 24.3934C35.7095 27.0285 37.8516 29.1707 40.4867 29.1707C43.1217 29.1707 45.2639 27.0285 45.2639 24.3934C45.2639 21.7584 43.1217 19.6162 40.4867 19.6162ZM40.4867 27.2181C38.9322 27.2181 37.681 25.9669 37.681 24.4124C37.681 22.8579 38.9322 21.6067 40.4867 21.6067C42.0412 21.6067 43.2924 22.8579 43.2924 24.4124C43.2924 25.9669 42.0412 27.2181 40.4867 27.2181Z" fill="#0068FF"/>
                            <path d="M29.4562 29.0944H30.5747V19.957H28.6221V28.2793C28.6221 28.7153 29.0012 29.0944 29.4562 29.0944Z" fill="#0068FF"/>
                        </svg>
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
