<?php
/**
 * Template Name: Đào Tạo & Workshop
 */

get_header();

$zoom_img   = get_field('zoom_banner_image');
$zoom_title = get_field('zoom_title')        ?: 'Zoom Training Định Kỳ';
$zoom_desc  = get_field('zoom_description')  ?: 'Tham gia buổi đào tạo chuyên sâu cùng đội ngũ chuyên gia da liễu của Tamya. Cập nhật kiến thức mới nhất về công nghệ thẩm mỹ, kỹ thuật điều trị và chăm sóc da chuyên nghiệp.';
$zoom_sched = get_field('zoom_schedule')     ?: 'Thứ 5 hàng tuần';
$zoom_time  = get_field('zoom_time')         ?: '20:00 – 21:30 (GMT+7)';
$zoom_price = get_field('zoom_price')        ?: 'MIỄN PHÍ';
$zoom_link  = get_field('zoom_register_link');
$zoom_note  = get_field('zoom_note')         ?: 'Thông tin Zoom sẽ được gửi qua email sau khi đăng ký';

$workshop_items = get_field('workshop_items');
?>

<main id="primary" class="site-main page-daotao">

    <!-- ── Zoom Training Định Kỳ ───────────────────────────── -->
    <section class="pdt-zoom">

        <div class="pdt-zoom__img-wrap">
            <?php if (!empty($zoom_img)) : ?>
                <img src="<?= esc_url($zoom_img['url']) ?>"
                     alt="<?= esc_attr($zoom_img['alt'] ?: $zoom_title) ?>">
            <?php endif; ?>
        </div>

        <div class="pdt-zoom__body">
            <p class="pdt-eyebrow"><span class="pdt-dot"></span>Đào Tạo Trực Tuyến</p>

            <h1 class="pdt-zoom__title"><?= esc_html($zoom_title) ?></h1>
            <p class="pdt-zoom__desc"><?= wp_kses_post($zoom_desc) ?></p>

            <div class="pdt-schedule">
                <p class="pdt-schedule__label">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                        <rect x="3" y="4" width="18" height="18" rx="2" stroke="currentColor" stroke-width="1.8"/>
                        <path d="M16 2v4M8 2v4M3 10h18" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
                    </svg>
                    Lịch Cố Định
                </p>
                <p class="pdt-schedule__day"><?= esc_html($zoom_sched) ?></p>
                <p class="pdt-schedule__time"><?= esc_html($zoom_time) ?></p>
            </div>

            <div class="pdt-zoom__actions">
                <span class="pdt-tag-free"><?= esc_html($zoom_price) ?></span>
                <a class="pdt-btn-cta"
                   href="<?= $zoom_link ? esc_url($zoom_link['url']) : '#' ?>"
                   <?= ($zoom_link && $zoom_link['target']) ? 'target="' . esc_attr($zoom_link['target']) . '"' : '' ?>>
                    <?= esc_html(($zoom_link && $zoom_link['title']) ? $zoom_link['title'] : 'Đăng Ký Ngay') ?>
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                        <path d="M5 12h14M13 6l6 6-6 6" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                    </svg>
                </a>
            </div>

            <p class="pdt-zoom__note"><?= esc_html($zoom_note) ?></p>
        </div>

    </section>

    <!-- ── Workshop Offline ─────────────────────────────────── -->
    <section class="pdt-workshop">

        <div class="pdt-workshop__head">
            <p class="pdt-eyebrow pdt-eyebrow--center"><span class="pdt-dot"></span>Học Tập Trực Tiếp</p>
            <h2 class="pdt-workshop__title">Workshop Offline</h2>
            <p class="pdt-workshop__desc">Trải nghiệm thực tế các kỹ thuật tiên tiến, thực hành trên mô hình và nhận feedback trực tiếp từ chuyên gia.</p>
        </div>

        <?php if (!empty($workshop_items)) : ?>
        <div class="pdt-ws-grid">
            <?php foreach ($workshop_items as $item) :
                $img   = $item['image'] ?? null;
                $title = $item['title'] ?? '';
                $link  = $item['link']  ?? '';
            ?>
            <<?= $link ? 'a href="' . esc_url($link) . '"' : 'div' ?> class="pdt-ws-card">
                <div class="pdt-ws-card__img">
                    <?php if ($img) : ?>
                        <img src="<?= esc_url($img['url']) ?>" alt="<?= esc_attr($img['alt'] ?: $title) ?>">
                    <?php endif; ?>
                </div>
                <?php if ($title) : ?>
                <p class="pdt-ws-card__name"><?= esc_html($title) ?></p>
                <?php endif; ?>
            </<?= $link ? 'a' : 'div' ?>>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>

    </section>

</main>

<?php get_footer(); ?>
