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

$gallery_items = get_field('gallery_items');

// Sự kiện đào tạo sắp diễn ra — sắp xếp theo ngày diễn ra gần nhất
$events_query = new WP_Query([
    'post_type'      => 'su-kien-dao-tao',
    'posts_per_page' => 3,
    'meta_key'       => 'event_date',
    'orderby'        => 'meta_value',
    'order'          => 'ASC',
]);
?>

<main id="primary" class="site-main page-daotao">

    <!-- ── Zoom Training Định Kỳ ───────────────────────────── -->
    <section class="pdt-zoom">
        <div class="container pdt-zoom__inner">

            <div class="pdt-zoom__img-wrap">
                <?php if (!empty($zoom_img)) : ?>
                    <img src="<?= esc_url($zoom_img['url']) ?>"
                         alt="<?= esc_attr($zoom_img['alt'] ?: $zoom_title) ?>">
                <?php endif; ?>
            </div>

            <div class="pdt-zoom__body">
                <p class="pdt-eyebrow"><span class="pdt-dot"></span>Trực Tuyến</p>

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

        </div>
    </section>

    <!-- ── Sự kiện đào tạo (Custom Post Type: su-kien-dao-tao) ─ -->
    <section class="pdt-events">
        <div class="container">

            <div class="pdt-workshop__head">
                <p class="pdt-eyebrow pdt-eyebrow--center">Lịch Đào Tạo</p>
                <h2 class="pdt-workshop__title">Sự kiện đào tạo nổi bật sắp diễn ra</h2>
                <p class="pdt-workshop__desc">Các lớp đào tạo chuyên sâu cùng chuyên gia trong và ngoài nước — cập nhật công nghệ, kỹ thuật và tư duy chữa lành làn da.</p>
            </div>

            <?php if ($events_query->have_posts()) : ?>
            <div class="pdt-events__grid">
                <?php while ($events_query->have_posts()) : $events_query->the_post();
                    $ev_terms   = get_the_terms(get_the_ID(), 'loai-su-kien');
                    $ev_badge   = ($ev_terms && !is_wp_error($ev_terms)) ? $ev_terms[0]->name : '';
                    $ev_date    = get_field('event_date');
                    $ev_time    = get_field('event_time');
                    $ev_price   = get_field('price_type') ?: 'co_phi';
                    $ev_price_label = $ev_price === 'mien_phi' ? 'Miễn phí' : 'Có phí';
                ?>
                <article class="pdt-event-card">
                    <a href="<?= esc_url(get_permalink()) ?>" class="pdt-event-card__img">
                        <?php if (has_post_thumbnail()) the_post_thumbnail('medium_large'); ?>
                        <?php if ($ev_badge) : ?><span class="pdt-badge"><?= esc_html($ev_badge) ?></span><?php endif; ?>
                    </a>
                    <div class="pdt-event-card__body">
                        <?php if ($ev_date || $ev_time) : ?>
                        <p class="pdt-event-card__meta"><span class="meta-space"></span>
                            <?= esc_html($ev_date) ?><?= $ev_time ? ' · ' . esc_html($ev_time) : '' ?>
                        </p>
                        <?php endif; ?>
                        <h3 class="pdt-event-card__title">
                            <a href="<?= esc_url(get_permalink()) ?>"><?php the_title(); ?></a>
                        </h3>
                        <p class="pdt-event-card__desc"><?= wp_trim_words(get_the_excerpt(), 20, '...') ?></p>
                        <div class="pdt-event-card__foot">
                            <span class="pdt-event-card__price pdt-event-card__price--<?= esc_attr($ev_price) ?>"><?= esc_html($ev_price_label) ?></span>
                            <a href="<?= esc_url(get_permalink()) ?>" class="pdt-event-card__btn">Xem chi tiết</a>
                        </div>
                    </div>
                </article>
                <?php endwhile; wp_reset_postdata(); ?>
            </div>
            <?php endif; ?>

        </div>
    </section>

    <!-- ── Hình ảnh đào tạo (bento gallery) ─────────────────── -->
    <section class="pdt-gallery">
        <div class="container">

            <div class="pdt-workshop__head">
                <p class="pdt-eyebrow pdt-eyebrow--center">Hình Ảnh Đào Tạo</p>
                <h2 class="pdt-workshop__title">Khoảnh khắc đào tạo nổi bật</h2>
                <p class="pdt-workshop__desc">Liên tục đào tạo và cải tiến là giá trị cốt lõi của Tamya.</p>
            </div>

            <?php if (!empty($gallery_items)) : ?>
            <div class="pdt-bento">
                <?php foreach ($gallery_items as $item) :
                    $img     = $item['image']   ?? null;
                    $caption = $item['caption'] ?? '';
                    $link    = $item['link']    ?? '';
                    $tag     = $link ? 'a' : 'div';
                ?>
                <<?= $tag ?> <?= $link ? 'href="' . esc_url($link) . '"' : '' ?> class="pdt-bento__item">
                    <?php if ($img) : ?>
                        <img src="<?= esc_url($img['url']) ?>" alt="<?= esc_attr($img['alt'] ?: $caption) ?>">
                    <?php endif; ?>
                    <?php if ($caption) : ?>
                    <span class="pdt-bento__caption"><?= esc_html($caption) ?></span>
                    <?php endif; ?>
                </<?= $tag ?>>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>

        </div>
    </section>

</main>

<?php get_footer(); ?>
