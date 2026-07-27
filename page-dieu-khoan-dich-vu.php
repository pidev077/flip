<?php
/**
 * Template Name: Điều Khoản Dịch Vụ
 */

get_header();

$info    = get_field('info_group', 'option') ?: [];
$phone   = $info['phone_number'] ?? null;
$hotline = $phone ? esc_html($phone['title']) : '0964 202 040';
$hotline_url = $phone ? esc_url($phone['url']) : 'tel:0964202040';
$email   = get_field('email', 'option') ?: 'cskh@tamya.com.vn';
?>

<main id="primary" class="site-main page-terms">

    <!-- ── Hero ──────────────────────────────────────────── -->
    <section class="lp-hero">
        <div class="container container--860">
            <span class="lp-hero__eyebrow">PHÁP LÝ</span>
            <h1 class="lp-hero__title">Điều khoản &amp; chính sách dịch vụ</h1>
            <p class="lp-hero__meta">Cập nhật lần cuối: 24.06.2026</p>
            <p class="lp-hero__desc">Các điều khoản dưới đây áp dụng khi bạn truy cập website và sử dụng dịch vụ tư vấn, chăm sóc da tại Tamya. Vui lòng đọc kỹ trước khi đặt lịch và sử dụng dịch vụ.</p>
        </div>
    </section>

    <!-- ── Body: TOC + Content ───────────────────────────── -->
    <section class="lp-body">
        <div class="container container--1000 lp-body__wrap">

            <!-- Table of Contents -->
            <aside class="lp-toc">
                <p class="lp-toc__label">MỤC LỤC</p>
                <ol class="lp-toc__list">
                    <li><a href="#lp-s1" class="is-active">01. Giới thiệu &amp; phạm vi áp dụng</a></li>
                    <li><a href="#lp-s2">02. Dịch vụ &amp; tư vấn</a></li>
                    <li><a href="#lp-s3">03. Đặt lịch, thay đổi &amp; hủy lịch</a></li>
                    <li><a href="#lp-s4">04. Chi phí &amp; thanh toán</a></li>
                    <li><a href="#lp-s5">05. Cam kết của Tamya</a></li>
                    <li><a href="#lp-s6">06. Trách nhiệm của khách hàng</a></li>
                    <li><a href="#lp-s7">07. Quyền sở hữu nội dung</a></li>
                </ol>
            </aside>

            <!-- Content -->
            <div class="lp-content">

                <!-- 01 -->
                <article class="lp-section" id="lp-s1">
                    <div class="lp-section__head">
                        <span class="lp-section__num">01</span>
                        <h2 class="lp-section__title">Giới thiệu &amp; phạm vi áp dụng</h2>
                    </div>
                    <div class="lp-section__body">
                        <p>Các điều khoản này áp dụng cho việc bạn truy cập website và sử dụng dịch vụ của Tamya. Khi đặt lịch hoặc sử dụng dịch vụ, bạn được xem là đã đồng ý với các điều khoản dưới đây.</p>
                    </div>
                </article>

                <!-- 02 -->
                <article class="lp-section" id="lp-s2">
                    <div class="lp-section__head">
                        <span class="lp-section__num">02</span>
                        <h2 class="lp-section__title">Dịch vụ &amp; tư vấn</h2>
                    </div>
                    <div class="lp-section__body">
                        <p>Tamya cung cấp dịch vụ chăm sóc da chuyên sâu và tư vấn bởi đội ngũ chuyên gia. Thông tin trên website mang tính tham khảo, không thay thế cho thăm khám chuyên môn trực tiếp.</p>
                        <ul>
                            <li>Phác đồ được cá nhân hóa theo tình trạng da thực tế.</li>
                            <li>Kết quả có thể khác nhau tùy cơ địa mỗi người.</li>
                        </ul>
                    </div>
                </article>

                <!-- 03 -->
                <article class="lp-section" id="lp-s3">
                    <div class="lp-section__head">
                        <span class="lp-section__num">03</span>
                        <h2 class="lp-section__title">Đặt lịch, thay đổi &amp; hủy lịch</h2>
                    </div>
                    <div class="lp-section__body">
                        <p>Bạn có thể đặt lịch qua website, hotline hoặc các kênh mạng xã hội của Tamya. Vui lòng thông báo trước ít nhất 24 giờ nếu cần thay đổi hoặc hủy lịch để chúng tôi sắp xếp phù hợp.</p>
                    </div>
                </article>

                <!-- 04 -->
                <article class="lp-section" id="lp-s4">
                    <div class="lp-section__head">
                        <span class="lp-section__num">04</span>
                        <h2 class="lp-section__title">Chi phí &amp; thanh toán</h2>
                    </div>
                    <div class="lp-section__body">
                        <p>Chi phí dịch vụ được tư vấn minh bạch trước khi thực hiện. Buổi tư vấn ban đầu hoàn toàn miễn phí và không có áp lực mua liệu trình.</p>
                    </div>
                </article>

                <!-- 05 -->
                <article class="lp-section" id="lp-s5">
                    <div class="lp-section__head">
                        <span class="lp-section__num">05</span>
                        <h2 class="lp-section__title">Cam kết của Tamya</h2>
                    </div>
                    <div class="lp-section__body">
                        <p>Tamya cam kết minh bạch, an toàn và tôn trọng quyết định của bạn. Chúng tôi không sử dụng các tuyên bố phóng đại về hiệu quả và luôn ưu tiên sự an tâm của khách hàng.</p>
                    </div>
                </article>

                <!-- 06 -->
                <article class="lp-section" id="lp-s6">
                    <div class="lp-section__head">
                        <span class="lp-section__num">06</span>
                        <h2 class="lp-section__title">Trách nhiệm của khách hàng</h2>
                    </div>
                    <div class="lp-section__body">
                        <p>Để đảm bảo an toàn và hiệu quả, bạn vui lòng:</p>
                        <ul>
                            <li>Cung cấp thông tin chính xác về tình trạng da và tiền sử.</li>
                            <li>Tuân thủ hướng dẫn chăm sóc trước và sau liệu trình.</li>
                            <li>Thông báo kịp thời nếu có phản ứng bất thường.</li>
                        </ul>
                    </div>
                </article>

                <!-- 07 -->
                <article class="lp-section" id="lp-s7">
                    <div class="lp-section__head">
                        <span class="lp-section__num">07</span>
                        <h2 class="lp-section__title">Quyền sở hữu nội dung</h2>
                    </div>
                    <div class="lp-section__body">
                        <p>Toàn bộ nội dung, hình ảnh và thương hiệu trên website thuộc quyền sở hữu của Tamya. Vui lòng không sao chép hoặc sử dụng lại khi chưa có sự đồng ý bằng văn bản.</p>
                    </div>
                </article>

            </div><!-- .lp-content -->
        </div><!-- .lp-body__wrap -->
    </section>

    <!-- ── CTA ─────────────────────────────────────────────── -->
    <section class="lp-cta-section">
        <div class="container container--1000">
            <div class="lp-cta">
                <p class="lp-cta__label">CẦN HỖ TRỢ?</p>
                <h2 class="lp-cta__title">Còn thắc mắc về điều khoản?</h2>
                <p class="lp-cta__text">Liên hệ Tamya qua Email <a href="mailto:<?= esc_attr($email) ?>"><?= esc_html($email) ?></a> hoặc Hotline <a href="<?= esc_url($hotline_url) ?>"><?= esc_html($hotline) ?></a> để được giải đáp.</p>
            </div>
        </div>
    </section>

</main>

<script>
(function () {
    var tocLinks = document.querySelectorAll('.lp-toc__list a');
    var sections = document.querySelectorAll('.lp-section');

    function onScroll() {
        var scrollY = window.scrollY + 140;
        var current = '';
        sections.forEach(function (sec) {
            if (sec.offsetTop <= scrollY) current = sec.id;
        });
        tocLinks.forEach(function (link) {
            link.classList.toggle('is-active', link.getAttribute('href') === '#' + current);
        });
    }

    tocLinks.forEach(function (link) {
        link.addEventListener('click', function (e) {
            e.preventDefault();
            var target = document.querySelector(link.getAttribute('href'));
            if (target) window.scrollTo({ top: target.offsetTop - 100, behavior: 'smooth' });
        });
    });

    window.addEventListener('scroll', onScroll, { passive: true });
    onScroll();
})();
</script>

<?php get_footer(); ?>
