<?php
/**
 * Template for displaying single "Sự kiện đào tạo" posts
 */
get_header();

while (have_posts()) : the_post();

    $terms       = get_the_terms(get_the_ID(), 'loai-su-kien');
    $badge       = ($terms && !is_wp_error($terms)) ? $terms[0]->name : '';
    $event_date  = get_field('event_date');
    $event_time  = get_field('event_time');
    $price_type  = get_field('price_type') ?: 'co_phi';
    $price_label = $price_type === 'mien_phi' ? 'Miễn phí' : 'Có phí';

    $daotao_page = get_page_by_path('dao-tao');
    $daotao_url  = $daotao_page ? get_permalink($daotao_page) : home_url('/dao-tao');
?>

<main id="primary" class="site-main page-daotao skdt-single">

    <div class="skdt-crumb container">
        <a href="<?= esc_url(home_url('/')) ?>">Trang chủ</a>
        <svg width="10" height="10" viewBox="0 0 24 24" fill="none"><path d="M9 18l6-6-6-6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
        <a href="<?= esc_url($daotao_url) ?>">Đào tạo</a>
        <svg width="10" height="10" viewBox="0 0 24 24" fill="none"><path d="M9 18l6-6-6-6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
        <span><?= wp_trim_words(get_the_title(), 8, '...') ?></span>
    </div>

    <section class="skdt-hero container">
        <?php if (has_post_thumbnail()) : ?>
        <div class="skdt-hero__img">
            <?php the_post_thumbnail('large'); ?>
            <?php if ($badge) : ?><span class="pdt-badge"><?= esc_html($badge) ?></span><?php endif; ?>
        </div>
        <?php endif; ?>

        <div class="skdt-hero__body">
            <?php if ($event_date || $event_time) : ?>
            <p class="skdt-hero__meta">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                    <rect x="3" y="4" width="18" height="18" rx="2" stroke="currentColor" stroke-width="1.8"/>
                    <path d="M16 2v4M8 2v4M3 10h18" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
                </svg>
                <?= esc_html($event_date) ?><?= $event_time ? ' · ' . esc_html($event_time) : '' ?>
            </p>
            <?php endif; ?>

            <h1 class="skdt-hero__title"><?php the_title(); ?></h1>

            <span class="pdt-event-card__price pdt-event-card__price--<?= esc_attr($price_type) ?>">
                <?= esc_html($price_label) ?>
            </span>

            <div class="skdt-hero__content">
                <?php the_content(); ?>
            </div>

            <a href="<?= esc_url($daotao_url) ?>" class="pdt-btn-outline skdt-back">
                ← Xem tất cả sự kiện đào tạo
            </a>
        </div>
    </section>

</main>

<?php endwhile; ?>

<?php get_footer(); ?>
