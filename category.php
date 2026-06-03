<?php
/**
 * Category archive template
 */

get_header();

$term    = get_queried_object();
$title   = $term ? $term->name        : 'Danh mục';
$desc    = $term && $term->description ? $term->description : 'Click vào bất kỳ bài viết nào để xem chi tiết.';
$bg      = $term ? get_term_meta($term->term_id, 'bg_category', true) : '';
$bg      = $bg ?: '#799852';
?>

<main id="primary" class="site-main page-archive">

    <!-- ── Hero ──────────────────────────────────────────── -->
    <section class="container arc-hero">
        <div class="arc-hero__left">
            <span class="arc-hero__eyebrow">Tin tức &amp; Sự kiện</span>
            <h1 class="arc-hero__title"><em><?php echo esc_html($title); ?></em></h1>
             <p class="arc-hero__desc"><?php echo esc_html($desc); ?></p>
        </div>
    </section>

    <!-- ── Grid ──────────────────────────────────────────── -->
    <section class="container arc-grid-wrap">

        <?php if (have_posts()) : ?>
        <div class="pbt-grid">
            <?php while (have_posts()) : the_post();
                $cats  = get_the_category();
                $c     = $cats[0] ?? null;
                $cbg   = $c ? get_term_meta($c->term_id, 'bg_category', true) : $bg;
                $cbg   = $cbg ?: $bg;
            ?>
            <a href="<?php echo esc_url(get_permalink()); ?>" class="pbt-card">
                <div class="pbt-card__img">
                    <?php if (has_post_thumbnail()) the_post_thumbnail('medium_large'); ?>
                </div>
                <div class="pbt-card__body">
                    <div class="pbt-card__meta">
                        <?php if ($c) : ?>
                        <span class="pbt-badge" style="background:<?php echo esc_attr($cbg); ?>"><?php echo esc_html($c->name); ?></span>
                        <?php endif; ?>
                        <span class="pbt-card__date"><?php echo get_the_date('d.m.Y'); ?></span>
                    </div>
                    <h2 class="pbt-card__title"><?php the_title(); ?></h2>
                    <p class="pbt-card__excerpt"><?php echo wp_trim_words(get_the_excerpt(), 18, '...'); ?></p>
                </div>
            </a>
            <?php endwhile; ?>
        </div>

        <div class="arc-pagination">
            <?php the_posts_pagination([
                'mid_size'  => 2,
                'prev_text' => '← Trước',
                'next_text' => 'Tiếp →',
            ]); ?>
        </div>

        <?php else : ?>
        <p class="arc-empty">Chưa có bài viết nào trong chuyên mục này.</p>
        <?php endif; ?>
    </section>

</main>

<?php get_footer(); ?>
