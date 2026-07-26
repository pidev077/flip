<?php
/**
 * Template Name: Liên Hệ
 */

get_header();

$fb_link   = get_field('link_facebook', 'option')  ?: '#';
$tt_link   = get_field('link_tiktok', 'option')    ?: '#';
$zalo_link = get_field('link_zalo', 'option')       ?: '#';

$info      = get_field('info_group', 'option') ?: [];
$phone     = $info['phone_number'] ?? null;
$hotline   = $phone ? esc_html($phone['title']) : '0964 202 040';
$hotline_url = $phone ? esc_url($phone['url']) : 'tel:0964202040';

$email       = get_field('email', 'option') ?: 'cskh@tamya.com.vn';
$hours_value = get_field('hours_value', 'option') ?: '08:30 – 17:30 (T2–CN)';

$form_id   = get_option('tamya_contact_form_id');

// Flatten footer's branch groups (region + locations) into a single list of clinic cards.
$branch_groups = get_field('branch_groups', 'option') ?: [];
$clinics = [];
foreach ($branch_groups as $group) {
    foreach ($group['locations'] ?? [] as $loc) {
        if (empty($loc['name'])) continue;
        $clinics[] = $loc;
    }
}
?>

<main id="primary" class="site-main page-lien-he">

    <!-- ── Hero ──────────────────────────────────────────── -->
    <section class="ct-hero">
        <div class="container ct-hero__inner">
            <span class="ct-hero__eyebrow">LIÊN HỆ</span>
            <h1 class="ct-hero__title">Hãy để Tamya đồng hành</h1>
            <p class="ct-hero__desc">Mọi cuộc tư vấn đều miễn phí và bảo mật. Chuyên gia sẽ liên hệ lại trong vòng 2 giờ làm việc.</p>
        </div>
    </section>

    <!-- ── Đăng ký tư vấn + Hotline ──────────────────────── -->
    <section class="ct-contact-section">
        <div class="container ct-contact-grid">

            <!-- Form card -->
            <div class="ct-form-card">
                <p class="ct-section-label">ĐĂNG KÝ TƯ VẤN NHANH</p>
                <p class="ct-form-card__desc">Để lại thông tin, Tamya sẽ gọi lại trong 2 giờ làm việc.</p>

                <?php if ($form_id) : ?>
                    <?php echo do_shortcode('[contact-form-7 id="' . intval($form_id) . '" title="Tamya – Liên Hệ"]'); ?>
                <?php else : ?>
                    <p style="text-align:center;padding:2rem 0;color:#888;">Form đang khởi tạo. Vui lòng tải lại trang sau vài giây.</p>
                <?php endif; ?>
            </div>

            <!-- Hotline card -->
            <div class="ct-hotline-card">
                <p class="ct-hotline-card__label">HOTLINE TỔNG</p>
                <a href="<?= $hotline_url ?>" class="ct-hotline-card__number"><?= $hotline ?></a>
                <p class="ct-hotline-card__hours">Đặt hẹn &amp; tư vấn · <?= esc_html($hours_value) ?></p>

                <hr class="ct-hotline-card__divider">

                <p class="ct-hotline-card__label">EMAIL</p>
                <a href="mailto:<?= esc_attr($email) ?>" class="ct-hotline-card__email"><?= esc_html($email) ?></a>

                <hr class="ct-hotline-card__divider">

                <p class="ct-hotline-card__label">KẾT NỐI VỚI TAMYA</p>
                <div class="ct-social-pills">
                    <a href="<?= esc_url($fb_link) ?>" class="ct-social-pill" target="_blank" rel="noopener">
                        <span class="ct-social-pill__icon">F</span>Fanpage
                    </a>
                    <a href="<?= esc_url($tt_link) ?>" class="ct-social-pill" target="_blank" rel="noopener">
                        <span class="ct-social-pill__icon">T</span>TikTok
                    </a>
                    <a href="<?= esc_url($zalo_link) ?>" class="ct-social-pill" target="_blank" rel="noopener">
                        <span class="ct-social-pill__icon">Z</span>Zalo
                    </a>
                </div>
            </div>

        </div>
    </section>

    <!-- ── Chi Nhánh ─────────────────────────────────────── -->
    <?php if ($clinics) : ?>
    <section class="ct-branch-section">
        <div class="container ct-branch-section__inner">
            <p class="ct-section-label">CHI NHÁNH</p>
            <h2 class="ct-branch-section__title">Hệ thống Tamya Clinic</h2>

            <div class="ct-clinic-cards">
                <?php foreach ($clinics as $clinic) :
                    $name    = $clinic['name'] ?? '';
                    $address = trim(str_replace(["\r\n", "\n"], ' ', $clinic['address'] ?? ''));
                    $c_hotline_label = $clinic['hotline_label'] ?: 'Hotline chi nhánh';
                    $c_hotline = ($clinic['hotline'] && $clinic['hotline']['url']) ? $clinic['hotline'] : ['title' => $hotline, 'url' => $hotline_url];
                    $directions_url = $address ? 'https://www.google.com/maps/search/?api=1&query=' . rawurlencode($name . ' ' . $address) : '#';
                    ?>
                    <div class="ct-clinic-card">
                        <div class="ct-clinic-card__image"></div>
                        <div class="ct-clinic-card__body">
                            <strong class="ct-clinic-card__name"><?= esc_html($name) ?></strong>
                            <?php if ($address) : ?>
                                <p class="ct-clinic-card__addr"><?= esc_html($address) ?></p>
                            <?php endif; ?>

                            <?php if ($c_hotline && $c_hotline['url']) : ?>
                                <p class="ct-clinic-card__meta-label"><?= esc_html($c_hotline_label) ?></p>
                                <a class="ct-clinic-card__hotline" href="<?= esc_url($c_hotline['url']) ?>"><?= esc_html($c_hotline['title']) ?></a>
                            <?php endif; ?>

                            <p class="ct-clinic-card__hours">Giờ mở cửa: <?= esc_html($hours_value) ?></p>

                            <a class="ct-clinic-card__directions" href="<?= esc_url($directions_url) ?>" target="_blank" rel="noopener">Chỉ đường →</a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
    <?php endif; ?>

    <!-- ── Câu Hỏi Thường Gặp ────────────────────────────── -->
    <section class="ct-faq-section">
        <div class="container ct-faq-section__inner">

            <p class="ct-section-label">GIẢI ĐÁP</p>
            <h2 class="ct-faq-section__title">Câu hỏi thường gặp</h2>

            <div class="ct-faq">

                <div class="ct-faq-item">
                    <button class="ct-faq-toggle" aria-expanded="false">
                        <span>Tôi có cần đặt lịch trước không?</span>
                        <span class="ct-faq-icon">+</span>
                    </button>
                    <div class="ct-faq-content">
                        <p>Bạn nên đặt lịch trước để được phục vụ nhanh chóng và đúng giờ. Tamya cũng nhận khách không hẹn tùy theo tình hình lịch của phòng khám.</p>
                    </div>
                </div>

                <div class="ct-faq-item">
                    <button class="ct-faq-toggle" aria-expanded="false">
                        <span>Buổi tư vấn đầu tiên có mất phí không?</span>
                        <span class="ct-faq-icon">+</span>
                    </button>
                    <div class="ct-faq-content">
                        <p>Hoàn toàn miễn phí. Buổi tư vấn đầu tiên tại Tamya là cơ hội để chuyên gia đánh giá tình trạng da và tư vấn phác đồ phù hợp nhất cho bạn.</p>
                    </div>
                </div>

                <div class="ct-faq-item">
                    <button class="ct-faq-toggle" aria-expanded="false">
                        <span>Tôi cần chuẩn bị gì trước khi đến?</span>
                        <span class="ct-faq-icon">+</span>
                    </button>
                    <div class="ct-faq-content">
                        <p>Bạn không cần chuẩn bị gì đặc biệt. Nếu da bạn đang sử dụng sản phẩm nào đó, hãy ghi chú lại để chia sẻ với chuyên gia khi tư vấn.</p>
                    </div>
                </div>

                <div class="ct-faq-item">
                    <button class="ct-faq-toggle" aria-expanded="false">
                        <span>Tamya có hỗ trợ tư vấn online không?</span>
                        <span class="ct-faq-icon">+</span>
                    </button>
                    <div class="ct-faq-content">
                        <p>Có. Bạn có thể nhắn tin qua Fanpage Facebook hoặc Zalo của Tamya để được tư vấn sơ bộ. Tuy nhiên, để được đánh giá chính xác nhất, nên đến trực tiếp phòng khám.</p>
                    </div>
                </div>

                <div class="ct-faq-item">
                    <button class="ct-faq-toggle" aria-expanded="false">
                        <span>Tôi có thể đổi hoặc hủy lịch như thế nào?</span>
                        <span class="ct-faq-icon">+</span>
                    </button>
                    <div class="ct-faq-content">
                        <p>Bạn vui lòng thông báo trước ít nhất 2 giờ qua hotline <?= $hotline ?> hoặc nhắn tin Zalo để chúng tôi sắp xếp lại lịch cho bạn.</p>
                    </div>
                </div>

            </div>

        </div>
    </section>

</main>

<script>
(function () {

    function initFaq() {
        var items = document.querySelectorAll('.ct-faq-toggle');
        items.forEach(function (btn) {
            btn.addEventListener('click', function () {
                var item    = btn.closest('.ct-faq-item');
                var content = item.querySelector('.ct-faq-content');
                var icon    = btn.querySelector('.ct-faq-icon');
                var isOpen  = btn.getAttribute('aria-expanded') === 'true';

                document.querySelectorAll('.ct-faq-item').forEach(function (el) {
                    el.querySelector('.ct-faq-toggle').setAttribute('aria-expanded', 'false');
                    el.querySelector('.ct-faq-icon').textContent = '+';
                    el.querySelector('.ct-faq-content').style.maxHeight = '';
                    el.classList.remove('is-open');
                });

                if (!isOpen) {
                    btn.setAttribute('aria-expanded', 'true');
                    icon.textContent = '−';
                    content.style.maxHeight = content.scrollHeight + 'px';
                    item.classList.add('is-open');
                }
            });
        });
    }

    function init() {
        initFaq();
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
