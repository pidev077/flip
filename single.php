<?php
/**
 * Template for displaying single posts – Tamya Blog
 */
get_header();

while (have_posts()) : the_post();

$categories   = get_the_category();
$primary_cat  = !empty($categories) ? $categories[0] : null;
$word_count   = str_word_count(wp_strip_all_tags(get_the_content()));
$reading_time = max(1, ceil($word_count / 200));

$author_name = get_field('author_name') ?: 'Chuyên gia Tamya';

// Bài viết liên quan — mỗi chuyên mục lấy 1 bài mới nhất (không tính bài đang xem), tối đa 3 bài
$related_cat_slugs = ['kien-thuc-lam-dep', 'trend', 'phong-cach-song'];
$related_ids = [];
foreach ($related_cat_slugs as $rslug) {
    if (count($related_ids) >= 3) break;
    $rq = new WP_Query([
        'post_type'      => 'post',
        'posts_per_page' => 1,
        'post__not_in'   => array_merge([get_the_ID()], $related_ids),
        'tax_query'      => [[
            'taxonomy' => 'category',
            'field'    => 'slug',
            'terms'    => $rslug,
        ]],
    ]);
    if ($rq->have_posts()) {
        $related_ids[] = $rq->posts[0]->ID;
    }
}
$related_query = $related_ids ? new WP_Query([
    'post_type'      => 'post',
    'post__in'       => $related_ids,
    'orderby'        => 'post__in',
    'posts_per_page' => 3,
]) : null;
?>

<main id="primary" class="site-main sp-single">

    <!-- ── Tiêu đề bài viết ───────────────────────────────────── -->
    <header class="sp-article-hero container container--860">
        <?php if ($primary_cat) : ?>
        <a href="<?= esc_url(get_category_link($primary_cat->term_id)) ?>" class="sp-badge"><?= esc_html($primary_cat->name) ?></a>
        <?php endif; ?>
        <h1 class="sp-article-hero__title"><?php the_title(); ?></h1>
        <p class="sp-article-hero__meta">
            <?= esc_html($author_name) ?>
            <span class="sp-meta__sep">·</span>
            <?= get_the_date('d.m.Y') ?>
            <span class="sp-meta__sep">·</span>
            <?= $reading_time ?> phút đọc
        </p>
    </header>

    <!-- ── Ảnh đại diện ───────────────────────────────────────── -->
    <?php if (has_post_thumbnail()) : ?>
    <div class="sp-article-hero__img container container--1200">
        <?php the_post_thumbnail('large'); ?>
    </div>
    <?php endif; ?>

    <!-- ── Nội dung bài viết ──────────────────────────────────── -->
    <article class="sp-article container container--720">
        <div class="sp-content entry-content">
            <?php the_content(); ?>
        </div>
    </article>

    <!-- ── Bài viết liên quan ─────────────────────────────────── -->
    <?php if ($related_query && $related_query->have_posts()) : ?>
    <section class="sp-related container">
        <h2 class="sp-related__title">Bài viết liên quan</h2>
        <div class="sp-related__grid">
            <?php while ($related_query->have_posts()) : $related_query->the_post();
                $r_cats  = get_the_category();
                $r_cat   = $r_cats[0] ?? null;
                $r_author = get_field('author_name') ?: 'Chuyên gia Tamya';
            ?>
            <a href="<?= esc_url(get_permalink()) ?>" class="sp-related-card">
                <div class="sp-related-card__img">
                    <?php if (has_post_thumbnail()) the_post_thumbnail('medium_large'); ?>
                </div>
                <div class="sp-related-card__body">
                    <?php if ($r_cat) : ?><span class="sp-badge"><?= esc_html($r_cat->name) ?></span><?php endif; ?>
                    <h3 class="sp-related-card__title"><?php the_title(); ?></h3>
                    <p class="sp-related-card__meta"><?= esc_html($r_author) ?> <span class="sp-meta__sep">·</span> <?= get_the_date('d.m.Y') ?></p>
                </div>
            </a>
            <?php endwhile; wp_reset_postdata(); ?>
        </div>
    </section>
    <?php endif; ?>

</main>

<?php endwhile; ?>
<?php get_footer(); ?>
