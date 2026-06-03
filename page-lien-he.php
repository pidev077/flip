<?php
/**
 * Template Name: Liên Hệ
 */

get_header();

$fb_link   = get_field('link_facebook', 'option')  ?: '#';
$ig_link   = get_field('link_instagram', 'option') ?: '#';
$tt_link   = get_field('link_tiktok', 'option')    ?: '#';
$zalo_link = get_field('link_zalo', 'option')       ?: '#';

$info      = get_field('info_group', 'option') ?: [];
$phone     = $info['phone_number'] ?? null;
$hotline   = $phone ? esc_html($phone['title']) : '0964.202.040';
$hotline_url = $phone ? esc_url($phone['url']) : 'tel:0964202040';

$form_id   = get_option('tamya_contact_form_id');
?>

<main id="primary" class="site-main page-lien-he">

    <!-- ── Hero ──────────────────────────────────────────── -->
    <section class="ct-hero">
        <div class="container ct-hero__inner">
            <span class="ct-hero__eyebrow">LIÊN HỆ</span>
            <h1 class="ct-hero__title">Hãy để Tamya<br><em>đồng hành.</em></h1>
            <p class="ct-hero__desc">Mọi cuộc tư vấn đều miễn phí và bảo mật.<br>Chuyên gia sẽ liên hệ lại trong vòng 2 giờ làm việc.</p>
        </div>
    </section>

    <!-- ── Form Section ──────────────────────────────────── -->
    <section class="ct-form-section">
        <div class="container ct-form-section__inner">

            <hr class="ct-divider">
            <p class="ct-section-label">GỬI TIN NHẮN</p>

            <?php if ($form_id) : ?>
                <?php echo do_shortcode('[contact-form-7 id="' . intval($form_id) . '" title="Tamya – Liên Hệ"]'); ?>
            <?php else : ?>
                <p style="text-align:center;padding:2rem 0;color:#888;">Form đang khởi tạo. Vui lòng tải lại trang sau vài giây.</p>
            <?php endif; ?>

        </div>
    </section>

    <!-- ── Hotline ───────────────────────────────────────── -->
    <section class="ct-hotline-section">
        <div class="container ct-hotline-section__inner">

            <hr class="ct-divider">
            <p class="ct-section-label">HOTLINE</p>

            <a href="<?= $hotline_url ?>" class="ct-hotline">
                <p class="ct-hotline__label">GỌI NGAY ĐỂ ĐƯỢC TƯ VẤN MIỄN PHÍ</p>
                <div class="ct-hotline__number"><?= $hotline ?></div>
                <p class="ct-hotline__hours">Thứ 2 – Thứ 7 &nbsp;&nbsp; 08:00 – 19:00</p>
            </a>

        </div>
    </section>

    <!-- ── Chi Nhánh ─────────────────────────────────────── -->
    <section class="ct-branch-section">
        <div class="container">
            <hr class="ct-divider">
            <p class="ct-section-label">CHI NHÁNH</p>

            <div class="ct-map-nav">
                <button class="ct-map-nav__btn is-active" data-map="hcm" data-card="card-hcm">
                    <span class="ct-map-nav__dot"></span>Hồ Chí Minh
                </button>
                <button class="ct-map-nav__btn" data-map="hn" data-card="card-hn">
                    <span class="ct-map-nav__dot"></span>Hà Nội
                </button>
            </div>
        </div>

        <!-- Full-width map -->
        <div class="ct-map-wrap">
            <div class="ct-map-pane is-active" id="map-hcm">
                <iframe
                    src="https://maps.google.com/maps?q=Aqua+4+Vinhomes+Ba+Son+Quan+1+Ho+Chi+Minh&t=&z=16&ie=UTF8&iwloc=&output=embed"
                    width="100%" height="440" style="border:0;display:block;"
                    allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
                </iframe>
            </div>
            <div class="ct-map-pane" id="map-hn">
                <iframe
                    src="https://maps.google.com/maps?q=456+Kim+Nguu+Vinh+Tuy+Hai+Ba+Trung+Ha+Noi&t=&z=16&ie=UTF8&iwloc=&output=embed"
                    width="100%" height="440" style="border:0;display:block;"
                    allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
                </iframe>
            </div>
        </div>

        <!-- Branch cards -->
        <div class="container">
            <div class="ct-branch-cards">

                <div class="ct-branch-card is-active" id="card-hcm">
                    <div class="ct-branch-card__pin">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5S10.62 6.5 12 6.5s2.5 1.12 2.5 2.5S13.38 11.5 12 11.5z"/>
                        </svg>
                    </div>
                    <div class="ct-branch-card__body">
                        <span class="ct-branch-card__city">HỒ CHÍ MINH</span>
                        <strong class="ct-branch-card__name">Tamya Clinic HCM</strong>
                        <p class="ct-branch-card__addr">Aqua 4, Vinhomes Ba Son – Quận 1, TP. HCM</p>
                        <div class="ct-branch-card__meta">
                            <span>☎ <?= $hotline ?></span>
                            <span>T2–17 : 08:00–19:00</span>
                        </div>
                    </div>
                </div>

                <div class="ct-branch-card" id="card-hn">
                    <div class="ct-branch-card__pin">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5S10.62 6.5 12 6.5s2.5 1.12 2.5 2.5S13.38 11.5 12 11.5z"/>
                        </svg>
                    </div>
                    <div class="ct-branch-card__body">
                        <span class="ct-branch-card__city">HÀ NỘI</span>
                        <strong class="ct-branch-card__name">Tamya Clinic Hà Nội</strong>
                        <p class="ct-branch-card__addr">456 Kim Ngưu – Phường Vĩnh Tuy, Hai Bà Trưng, Hà Nội</p>
                        <div class="ct-branch-card__meta">
                            <span>☎ <?= $hotline ?></span>
                            <span>T2–17 : 08:00–19:00</span>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- ── Mạng Xã Hội ───────────────────────────────────── -->
    <section class="ct-social-section">
        <div class="container ct-social-section__inner">

            <hr class="ct-divider ct-divider--wide">
            <p class="ct-section-label">MẠNG XÃ HỘI</p>

            <div class="ct-social-links">
                <a href="<?= esc_url($fb_link) ?>" class="ct-social-link" target="_blank" rel="noopener">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg"><path d="M24 12.073C24 5.403 18.627 0 12 0S0 5.403 0 12.073C0 18.1 4.388 23.094 10.125 24v-8.437H7.078v-3.49h3.047V9.41c0-3.025 1.792-4.697 4.533-4.697 1.312 0 2.686.236 2.686.236v2.97h-1.513c-1.491 0-1.956.93-1.956 1.886v2.267h3.328l-.532 3.49h-2.796V24C19.612 23.094 24 18.1 24 12.073z"/></svg>
                    FACEBOOK
                </a>
                <a href="<?= esc_url($ig_link) ?>" class="ct-social-link" target="_blank" rel="noopener">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                    INSTAGRAM
                </a>
                <a href="<?= esc_url($tt_link) ?>" class="ct-social-link" target="_blank" rel="noopener">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg"><path d="M19.59 6.69a4.83 4.83 0 01-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 01-2.88 2.5 2.89 2.89 0 01-2.89-2.89 2.89 2.89 0 012.89-2.89c.28 0 .54.04.79.1V9.01a6.33 6.33 0 00-.79-.05 6.34 6.34 0 00-6.34 6.34 6.34 6.34 0 006.34 6.34 6.34 6.34 0 006.33-6.34V8.75a8.24 8.24 0 004.84 1.55V6.85a4.85 4.85 0 01-1.07-.16z"/></svg>
                    TIKTOK
                </a>
                <a href="<?= esc_url($zalo_link) ?>" class="ct-social-link" target="_blank" rel="noopener">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><text x="50%" y="56%" dominant-baseline="middle" text-anchor="middle" font-family="Arial,sans-serif" font-weight="bold" font-size="11" fill="currentColor">Za</text></svg>
                    ZALO
                </a>
            </div>

        </div>
    </section>

    <!-- ── Câu Hỏi Thường Gặp ────────────────────────────── -->
    <section class="ct-faq-section">
        <div class="container ct-faq-section__inner">

            <hr class="ct-divider ct-divider--wide">
            <p class="ct-section-label">CÂU HỎI THƯỜNG GẶP</p>

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

    function initMapTabs() {
        var tabs  = document.querySelectorAll('.ct-map-nav__btn');
        var panes = document.querySelectorAll('.ct-map-pane');
        var cards = document.querySelectorAll('.ct-branch-card');

        tabs.forEach(function (tab) {
            tab.addEventListener('click', function () {
                var target = tab.dataset.map;
                var cardId = tab.dataset.card;

                tabs.forEach(function (t) { t.classList.remove('is-active'); });
                tab.classList.add('is-active');

                panes.forEach(function (p) { p.classList.remove('is-active'); });
                var pane = document.getElementById('map-' + target);
                if (pane) pane.classList.add('is-active');

                cards.forEach(function (c) { c.classList.remove('is-active'); });
                var card = document.getElementById(cardId);
                if (card) card.classList.add('is-active');
            });
        });
    }

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

    function initSelect() {
        var selects = document.querySelectorAll('.page-lien-he select');
        selects.forEach(function (sel) {
            function update() { sel.classList.toggle('has-value', sel.selectedIndex > 0); }
            update();
            sel.addEventListener('change', update);
        });
    }

    function initBranchToggle() {
        var btns   = document.querySelectorAll('.page-lien-he .ct-branch-btn');
        var hidden = document.querySelector('.page-lien-he input[name="chi-nhanh"]');
        btns.forEach(function (btn) {
            btn.addEventListener('click', function () {
                btns.forEach(function (b) { b.classList.remove('is-active'); });
                btn.classList.add('is-active');
                if (hidden) hidden.value = btn.dataset.value;
            });
        });
    }

    function init() {
        initMapTabs();
        initFaq();
        initSelect();
        initBranchToggle();
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
