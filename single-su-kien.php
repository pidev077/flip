<?php
/**
 * Template for displaying single "Sự kiện" posts
 */
get_header();

while (have_posts()) : the_post();

    $terms       = get_the_terms(get_the_ID(), 'danh-muc-su-kien');
    $badge       = ($terms && !is_wp_error($terms)) ? $terms[0]->name : '';
    $event_date  = get_field('event_date');
    $event_time  = get_field('event_time');
    $event_loc   = get_field('event_location');
    $reg_link    = get_field('register_link');

    $su_kien_page = get_page_by_path('su-kien');
    $su_kien_url  = $su_kien_page ? get_permalink($su_kien_page) : home_url('/su-kien');
?>

<main id="primary" class="site-main page-su-kien psk-single">

    <div class="psk-crumb container">
        <a href="<?= esc_url(home_url('/')) ?>">Trang chủ</a>
        <svg width="10" height="10" viewBox="0 0 24 24" fill="none"><path d="M9 18l6-6-6-6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
        <a href="<?= esc_url($su_kien_url) ?>">Sự kiện</a>
        <svg width="10" height="10" viewBox="0 0 24 24" fill="none"><path d="M9 18l6-6-6-6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
        <span><?= wp_trim_words(get_the_title(), 8, '...') ?></span>
    </div>

    <section class="psk-single-hero container">
        <?php if (has_post_thumbnail()) : ?>
        <div class="psk-single-hero__img">
            <?php the_post_thumbnail('large'); ?>
            <?php if ($badge) : ?><span class="psk-tag"><?= esc_html($badge) ?></span><?php endif; ?>
        </div>
        <?php endif; ?>

        <div class="psk-single-hero__body">
            <?php if ($badge) : ?><span class="psk-status-chip"><?= esc_html($badge) ?></span><?php endif; ?>

            <h1 class="psk-single-hero__title"><?php the_title(); ?></h1>

            <?php if ($event_date || $event_time || $event_loc) : ?>
            <p class="psk-meta">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                    <rect x="3" y="4" width="18" height="18" rx="2" stroke="currentColor" stroke-width="1.8"/>
                    <path d="M16 2v4M8 2v4M3 10h18" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
                </svg>
                <?= esc_html($event_date) ?><?= $event_time ? ' · ' . esc_html($event_time) : '' ?>
                <?php if ($event_loc) : ?><span class="psk-meta__sep">·</span> <?= esc_html($event_loc) ?><?php endif; ?>
            </p>
            <?php endif; ?>

            <div class="psk-single-hero__content">
                <?php the_content(); ?>
            </div>

            <?php if ($reg_link) : ?>
            <a href="<?= esc_url($reg_link['url']) ?>"
               class="psk-featured__btn psk-single-cta"
               <?= !empty($reg_link['target']) ? 'target="' . esc_attr($reg_link['target']) . '"' : '' ?>>
                <?= esc_html($reg_link['title'] ?: 'Đăng ký tham dự') ?>
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M5 12h14M13 6l6 6-6 6" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
            </a>
            <?php endif; ?>

            <a href="<?= esc_url($su_kien_url) ?>" class="psk-btn-outline psk-single-back">
                ← Xem tất cả sự kiện
            </a>
        </div>
    </section>

</main>

<?php endwhile; ?>

<?php get_footer(); ?>
