<?php

/**
 * Template Name: Sự Kiện
 */

get_header();

$hero_title = get_field('hero_title') ?: 'Sự kiện tại Tamya';
$hero_desc  = get_field('hero_desc')  ?: 'Workshop, talkshow chuyên gia, lễ ra mắt và những hoạt động vì cộng đồng — nơi Tamya kết nối và lan tỏa hành trình chữa lành.';

// Sự kiện nổi bật hiển thị trong khối hero — lấy sự kiện có ngày gần nhất
$hero_query = new WP_Query([
    'post_type'      => 'su-kien',
    'posts_per_page' => 1,
    'meta_key'       => 'event_date',
    'orderby'        => 'meta_value',
    'order'          => 'ASC',
]);
$hero_event_id = $hero_query->have_posts() ? $hero_query->posts[0]->ID : 0;

// Toàn bộ sự kiện còn lại cho lưới + tab lọc
$events_query = new WP_Query([
    'post_type'      => 'su-kien',
    'posts_per_page' => -1,
    'post__not_in'   => $hero_event_id ? [$hero_event_id] : [],
    'meta_key'       => 'event_date',
    'orderby'        => 'meta_value',
    'order'          => 'ASC',
]);

$tabs = [
    ''             => 'Tất cả',
    'sap-dien-ra'  => 'Sắp diễn ra',
    'da-dien-ra'   => 'Đã diễn ra',
    'noi-bo'       => 'Nội bộ',
    'vi-cong-dong' => 'Vì Cộng đồng',
];

$featured_events = get_field('featured_events') ?: [];

$visible_count = 5; // Số thẻ hiển thị trước khi bấm "Xem thêm sự kiện"
?>

<main id="primary" class="site-main page-su-kien">

    <!-- ── Hero ─────────────────────────────────────────────── -->
    <section class="psk-hero">
        <div class="container psk-hero__inner">

            <div class="psk-hero__body">
                <p class="psk-eyebrow">Sự Kiện</p>
                <h1 class="psk-hero__title"><?= esc_html($hero_title) ?></h1>
                <p class="psk-hero__desc"><?= esc_html($hero_desc) ?></p>
            </div>

            <?php if ($hero_event_id) :
                $terms      = get_the_terms($hero_event_id, 'danh-muc-su-kien');
                $badge      = ($terms && !is_wp_error($terms)) ? $terms[0]->name : '';
                $ev_date    = get_field('event_date', $hero_event_id);
                $ev_time    = get_field('event_time', $hero_event_id);
                $ev_loc     = get_field('event_location', $hero_event_id);
                $reg_link   = get_field('register_link', $hero_event_id);
                $date_badge = flip_event_date_badge($ev_date);
            ?>
            <a href="<?= esc_url(get_permalink($hero_event_id)) ?>" class="psk-hero-card">
                <div class="psk-hero-card__img">
                    <?php if (has_post_thumbnail($hero_event_id)) : ?>
                        <?= get_the_post_thumbnail($hero_event_id, 'large') ?>
                    <?php endif; ?>
                    <?php if ($date_badge) : ?>
                    <span class="psk-date-badge">
                        <span class="psk-date-badge__day"><?= esc_html($date_badge['day']) ?></span>
                        <span class="psk-date-badge__month"><?= esc_html($date_badge['month']) ?></span>
                    </span>
                    <?php endif; ?>
                </div>
                <div class="psk-hero-card__body">
                    <?php if ($badge) : ?><span class="psk-status-chip"><?= esc_html($badge) ?></span><?php endif; ?>
                    <h2 class="psk-hero-card__title"><?= esc_html(get_the_title($hero_event_id)) ?></h2>
                    <?php if ($ev_loc || $ev_time || $ev_date) : ?>
                    <p class="psk-meta">
                        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M12 21s-7-6.1-7-11.5A7 7 0 0 1 19 9.5C19 14.9 12 21 12 21Z" stroke="currentColor" stroke-width="1.8"/><circle cx="12" cy="9.5" r="2.3" stroke="currentColor" stroke-width="1.8"/></svg>
                        <?= esc_html($ev_loc) ?>
                        <?php if ($ev_time || $ev_date) : ?><span class="psk-meta__sep">·</span>
                        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" aria-hidden="true"><rect x="3" y="4" width="18" height="18" rx="2" stroke="currentColor" stroke-width="1.8"/><path d="M16 2v4M8 2v4M3 10h18" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg>
                        <?= esc_html($ev_time) ?><?= ($ev_time && $ev_date) ? ', ' : '' ?><?= esc_html($ev_date) ?>
                        <?php endif; ?>
                    </p>
                    <?php endif; ?>
                    <span class="psk-hero-card__btn">
                        Đăng ký tham gia
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M5 12h14M13 6l6 6-6 6" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
                    </span>
                </div>
            </a>
            <?php endif; ?>

        </div>
    </section>

    <!-- ── Tabs lọc ─────────────────────────────────────────── -->
    <section class="psk-tabs">
        <div class="container">
            <ul class="psk-tabs__list" data-psk-tabs>
                <?php foreach ($tabs as $slug => $label) : ?>
                <li>
                    <button type="button" class="psk-tab <?= $slug === '' ? 'is-active' : '' ?>" data-filter="<?= esc_attr($slug) ?>">
                        <?= esc_html($label) ?>
                    </button>
                </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </section>

    <!-- ── Lưới sự kiện (custom post type: su-kien) ──────────── -->
    <section class="psk-grid-section">
        <div class="container">

            <?php if ($events_query->have_posts()) : ?>
            <div class="psk-grid" data-psk-grid>
                <?php
                $i = 0;
                while ($events_query->have_posts()) : $events_query->the_post();
                    $i++;
                    $ev_terms   = get_the_terms(get_the_ID(), 'danh-muc-su-kien');
                    $cat_slugs  = ($ev_terms && !is_wp_error($ev_terms)) ? wp_list_pluck($ev_terms, 'slug') : [];
                    $ev_badge     = flip_su_kien_type_badge(get_the_ID());
                    $badge_color  = $ev_badge ? flip_su_kien_badge_color($ev_badge->slug) : 'green';
                    $badge_custom = $ev_badge ? flip_su_kien_tag_color($ev_badge) : '';
                    $ev_date    = get_field('event_date');
                    $ev_loc     = get_field('event_location');
                    $date_badge = flip_event_date_badge($ev_date);
                ?>
                <article class="psk-card<?= $i > $visible_count ? ' is-hidden' : '' ?>" data-cats="<?= esc_attr(implode(' ', $cat_slugs)) ?>">
                    <a href="<?= esc_url(get_permalink()) ?>" class="psk-card__media">
                        <?php if (has_post_thumbnail()) the_post_thumbnail('medium_large'); ?>
                        <span class="psk-card__gradient"></span>

                        <?php if ($date_badge) : ?>
                        <span class="psk-date-badge">
                            <span class="psk-date-badge__day"><?= esc_html($date_badge['day']) ?></span>
                            <span class="psk-date-badge__month"><?= esc_html($date_badge['month']) ?></span>
                        </span>
                        <?php endif; ?>

                        <div class="psk-card__content">
                            <?php if ($ev_badge) : ?>
                            <span class="psk-tag psk-tag--<?= esc_attr($badge_color) ?>"<?= $badge_custom ? ' style="background:' . esc_attr($badge_custom) . '"' : '' ?>>
                                <?= esc_html($ev_badge->name) ?>
                            </span>
                            <?php endif; ?>
                            <h3 class="psk-card__title"><?php the_title(); ?></h3>
                            <?php if ($ev_loc || $ev_date) : ?>
                            <p class="psk-card__meta">
                                <span class="psk-card__dot"></span>
                                <?= esc_html($ev_loc) ?><?= ($ev_loc && $ev_date) ? ' · ' : '' ?><?= esc_html($ev_date) ?>
                            </p>
                            <?php endif; ?>
                        </div>
                    </a>
                </article>
                <?php endwhile; wp_reset_postdata(); ?>
            </div>
            <?php endif; ?>

        </div>
    </section>

    <!-- ── Sự kiện nổi bật (chọn tay qua ACF) ────────────────── -->
    <?php if (!empty($featured_events)) : ?>
    <section class="psk-featured">
        <div class="container">

            <div class="psk-featured__head">
                <p class="psk-eyebrow">Sắp diễn ra</p>
                <h2 class="psk-featured__title">Sự kiện nổi bật</h2>
            </div>

            <div class="psk-featured__list">
                <?php foreach ($featured_events as $event) :
                    $eid          = $event->ID;
                    $badge        = flip_su_kien_type_badge($eid);
                    $badge_color  = $badge ? flip_su_kien_badge_color($badge->slug) : 'green';
                    $badge_custom = $badge ? flip_su_kien_tag_color($badge) : '';
                    $badge_text_color = $badge ? flip_su_kien_tag_text_color($badge) : '';
                    $ev_date   = get_field('event_date', $eid);
                    $ev_time   = get_field('event_time', $eid);
                    $ev_loc    = get_field('event_location', $eid);
                    $reg_link  = get_field('register_link', $eid);
                ?>
                <article class="psk-featured__item">
                    <a href="<?= esc_url(get_permalink($eid)) ?>" class="psk-featured__img">
                        <?php if (has_post_thumbnail($eid)) : ?>
                            <?= get_the_post_thumbnail($eid, 'medium_large') ?>
                        <?php endif; ?>
                    </a>
                    <div class="psk-featured__body">
                        <?php
                        $badge_style = [];
                        if ($badge_custom) $badge_style[] = 'background:' . $badge_custom;
                        if ($badge_text_color) $badge_style[] = 'color:' . $badge_text_color;
                        ?>
                        <?php if ($badge) : ?>
                        <span class="psk-tag psk-featured__tag psk-tag--<?= esc_attr($badge_color) ?>"<?= $badge_style ? ' style="' . esc_attr(implode(';', $badge_style)) . '"' : '' ?>>
                            <?= esc_html($badge->name) ?>
                        </span>
                        <?php endif; ?>
                        <h3 class="psk-featured__title-item">
                            <a href="<?= esc_url(get_permalink($eid)) ?>"><?= esc_html(get_the_title($eid)) ?></a>
                        </h3>
                        <?php if ($ev_date || $ev_time || $ev_loc) : ?>
                        <p class="psk-meta psk-featured__meta">
                            <?= esc_html($ev_date) ?>
                            <?php if ($ev_time) : ?><span class="psk-meta__sep">·</span> <?= esc_html($ev_time) ?><?php endif; ?>
                            <?php if ($ev_loc) : ?><span class="psk-meta__sep">·</span> <?= esc_html($ev_loc) ?><?php endif; ?>
                        </p>
                        <?php endif; ?>
                        <p class="psk-featured__desc"><?= wp_trim_words(get_the_excerpt($eid), 24, '...') ?></p>
                        <a href="<?= $reg_link ? esc_url($reg_link['url']) : get_permalink($eid) ?>"
                           class="psk-featured__btn"
                           <?= ($reg_link && !empty($reg_link['target'])) ? 'target="' . esc_attr($reg_link['target']) . '"' : '' ?>>
                            <?= esc_html(($reg_link && $reg_link['title']) ? $reg_link['title'] : 'Đăng ký tham dự') ?>
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M5 12h14M13 6l6 6-6 6" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
                        </a>
                    </div>
                </article>
                <?php endforeach; ?>
            </div>

        </div>
    </section>
    <?php endif; ?>

    <!-- ── Xem thêm sự kiện (load thêm thẻ đã ẩn trong lưới) ─── -->
    <?php if ($i > 0) : ?>
    <div class="psk-loadmore">
        <button type="button" class="psk-btn-outline" data-psk-loadmore>Xem thêm sự kiện</button>
    </div>
    <?php endif; ?>

</main>

<script>
document.addEventListener('DOMContentLoaded', function () {
    var grid       = document.querySelector('[data-psk-grid]');
    var tabsList   = document.querySelector('[data-psk-tabs]');
    var loadMoreBtn = document.querySelector('[data-psk-loadmore]');
    if (!grid || !tabsList) return;

    var cards = Array.prototype.slice.call(grid.querySelectorAll('.psk-card'));

    tabsList.addEventListener('click', function (e) {
        var btn = e.target.closest('.psk-tab');
        if (!btn) return;

        tabsList.querySelectorAll('.psk-tab').forEach(function (t) { t.classList.remove('is-active'); });
        btn.classList.add('is-active');

        var filter = btn.getAttribute('data-filter');

        cards.forEach(function (card) {
            var cats = (card.getAttribute('data-cats') || '').split(' ');
            var match = !filter || cats.indexOf(filter) !== -1;
            card.classList.toggle('is-filtered-out', !match);
        });

        // Bấm vào 1 tab lọc thì hiện toàn bộ kết quả khớp, bỏ giới hạn "Xem thêm"
        if (filter) {
            cards.forEach(function (card) { card.classList.remove('is-hidden'); });
            if (loadMoreBtn) loadMoreBtn.style.display = 'none';
        } else if (loadMoreBtn) {
            loadMoreBtn.style.display = '';
        }
    });

    if (loadMoreBtn) {
        loadMoreBtn.addEventListener('click', function () {
            cards.forEach(function (card) { card.classList.remove('is-hidden'); });
            loadMoreBtn.style.display = 'none';
        });
    }
});
</script>

<?php get_footer(); ?>
