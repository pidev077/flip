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

$eyebrow     = get_field('eyebrow') ?: 'PHÁP LÝ';
$updated     = get_the_modified_date('d.m.Y');
$description = get_field('description') ?: 'Các điều khoản dưới đây áp dụng khi bạn truy cập website và sử dụng dịch vụ tư vấn, chăm sóc da tại Tamya. Vui lòng đọc kỹ trước khi đặt lịch và sử dụng dịch vụ.';
$sections    = flip_parse_legal_content(apply_filters('the_content', $post->post_content));
$toc_items   = array_values(array_filter($sections, fn($s) => $s['id'] !== ''));
?>

<main id="primary" class="site-main page-terms">

    <!-- ── Hero ──────────────────────────────────────────── -->
    <section class="lp-hero">
        <div class="container container--860">
            <span class="lp-hero__eyebrow"><?= esc_html($eyebrow) ?></span>
            <h1 class="lp-hero__title"><?= esc_html(get_the_title()) ?></h1>
            <p class="lp-hero__meta">Cập nhật lần cuối: <?= esc_html($updated) ?></p>
            <p class="lp-hero__desc"><?= esc_html($description) ?></p>
        </div>
    </section>

    <!-- ── Body: TOC + Content ───────────────────────────── -->
    <?php if ($sections): ?>
    <section class="lp-body">
        <div class="container container--1000 lp-body__wrap">

            <!-- Table of Contents: tự tạo từ các thẻ <h2> trong nội dung -->
            <?php if ($toc_items): ?>
            <aside class="lp-toc">
                <p class="lp-toc__label">MỤC LỤC</p>
                <ol class="lp-toc__list">
                    <?php foreach ($toc_items as $i => $s): ?>
                        <li><a href="#<?= esc_attr($s['id']) ?>"<?= $i === 0 ? ' class="is-active"' : '' ?>><?= sprintf('%02d', $i + 1) ?>. <?= esc_html($s['title']) ?></a></li>
                    <?php endforeach; ?>
                </ol>
            </aside>
            <?php endif; ?>

            <!-- Content -->
            <div class="lp-content">
                <?php $num = 0; foreach ($sections as $s): ?>
                    <?php if ($s['id'] === ''): ?>
                        <div class="lp-section lp-section--intro">
                            <div class="lp-section__body"><?= $s['body'] ?></div>
                        </div>
                    <?php else: $num++; ?>
                        <article class="lp-section" id="<?= esc_attr($s['id']) ?>">
                            <div class="lp-section__head">
                                <span class="lp-section__num"><?= sprintf('%02d', $num) ?></span>
                                <h2 class="lp-section__title"><?= esc_html($s['title']) ?></h2>
                            </div>
                            <div class="lp-section__body"><?= $s['body'] ?></div>
                        </article>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div><!-- .lp-content -->
        </div><!-- .lp-body__wrap -->
    </section>
    <?php endif; ?>

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
            if (sec.id && sec.offsetTop <= scrollY) current = sec.id;
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
